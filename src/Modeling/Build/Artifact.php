<?php

namespace Modeling\Build;

use Modeling\Build\Elements\Application;
use Modeling\Build\Elements\Display;
use Modeling\Build\Elements\View;

abstract class Artifact {
    use StaticCreate;

    /** @var Application */ protected $application;

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

    abstract public function provision($element);
    abstract public function provisionFn($element);

    /**
     * @return \Twig_Environment
     */
    abstract public function getTwig();

    public function __invoke() {
        $this->install();
    }
}