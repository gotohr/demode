<?php

namespace Modeling\Build;

use Doctrine\Common\Collections\ArrayCollection;
use Modeling\Build\Artifact\Provision;
use Modeling\Build\Elements\Application;

abstract class Artifact {
    use StaticCreate;

    protected $templater;
    /** @var Application        */ protected $application;
    /** @var ArrayCollection    */ protected $provisions;

    public function __construct() {
        $this->provisions = new ArrayCollection();
        foreach (new \DirectoryIterator($this->getArtifactFolder() . '/Provisions') as $fileInfo) {
            if($fileInfo->isDot()) continue;
            $className = $fileInfo->getBasename('.php');
            $fqcn = $this->getArtifactNamespace() . '\\Provisions\\' . $className;
            $provision = new $fqcn;
            $provision->setArtifact($this);
            $this->provisions->set($className, $provision);
        }
    }

    abstract public function getArtifactFolder();
    abstract public function getArtifactNamespace();

    public function getTemplater() {
        if (!$this->templater) {
            $this->templater = new \League\Plates\Engine(null, 'tpl');
        }
        return $this->templater;
    }

    /**
     * @return Application
     */
    public function getApplication() {
        return $this->application;
    }

    /**
     * @param Application $application
     * @return static
     */
    public function setApplication($application) {
        $this->application = $application;
        return $this;
    }

    /**
     * @return \Monolog\Logger
     */
    public function getLogger() {
        return $this->getApplication()->getBuildEnvironment()->getLogger();
    }

    abstract public function install();

    public function provision($element) {
        $fqcn = get_class($element);
        $split = explode('\\', $fqcn);
        $provisionName = array_pop($split);
        /** @var Provision $provision */
        $provision = $this->provisions->get($provisionName);
        if ($provision) {
            $provision($element);
        }
    }

    public function provisionFn($element) {
        return function () use($element) {
            $this->provision($element);
        };
    }


    public function __invoke() {
        $this->install();
    }
}