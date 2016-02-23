<?php

namespace Modeling\Build\Elements;

use Doctrine\Common\Collections\ArrayCollection;
use Modeling\Build\Builder;
use Modeling\Build\Artifact;
use Modeling\Build\Element;

class Application extends Element {

    /** @var BuildEnvironment   */ protected $buildEnvironment;
    /** @var Artifact          */ protected $basedOn;
    /** @var ArrayCollection    */ protected $tasks;

    public function __construct($name = null) {
        parent::__construct($name);
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTasks() {
        return $this->tasks;
    }

    public function execute() {
        $this->getTasks()->map(function ($task) {
            $task();
        });
    }

    public function getApplication() {
        return $this;
    }

    /**
     * @return Artifact
     */
    public function getBasedOn() {
        return $this->basedOn;
    }

    /**
     * @param Artifact $basedOn
     * @return static
     */
    public function setBasedOn($basedOn) {
        $this->basedOn = $basedOn;
        $this->basedOn->setApplication($this);
        return $this;
    }

    /**
     * @return BuildEnvironment
     */
    public function getBuildEnvironment() {
        return $this->buildEnvironment;
    }

    /**
     * @param BuildEnvironment $buildEnvironment
     * @return static
     */
    public function setBuildEnvironment($buildEnvironment) {
        $this->buildEnvironment = $buildEnvironment;
        $this->buildEnvironment->setApplication($this);
        return $this;
    }

    /**
     * @return Application
     */
    public function show() {
        return $this;
    }

    /**
     * @return Element
     */
    public function getContainer() {
        return $this->getBuildEnvironment();
    }

    /**
     * @return Application
     */
    public function build() {
        $this->getTasks()->add(function() {
            $this->getBuildEnvironment()->getLogger()->info("BUILDING " . $this->getName());
            $this->createPath('app root folder');
        });
        $this->getTasks()->add($this->getBasedOn() ?: function() {});
        return $this;
    }

    public function describe() {
        return "brand new app! :) ";
    }
} 