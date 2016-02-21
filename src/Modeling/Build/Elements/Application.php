<?php

namespace Modeling\Build\Elements;

use Modeling\Build\Element;

class Application extends Element {

    /** @var BuildEnvironment */ protected $buildEnvironment;

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
        $this->getBuildEnvironment()
            ->getLogger()->info("BUILDING " . $this->getName());
        $this->createPath('app root folder');
        return $this;
    }

    public function describe() {
        return "brand new app! :) ";
    }
} 