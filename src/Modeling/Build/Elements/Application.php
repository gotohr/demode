<?php

namespace Modeling\Build\Elements;

use Doctrine\Common\Collections\ArrayCollection;
use Modeling\Build\Builder;
use Modeling\Build\Element;

class Application extends Element {

    /** @var BuildEnvironment   */ protected $buildEnvironment;
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
            $this->getBuildEnvironment()
                ->getLogger()->info("BUILDING " . $this->getName());
            $this->createPath('app root folder');
        });
        return $this;
    }

    public function describe() {
        return "brand new app! :) ";
    }
} 