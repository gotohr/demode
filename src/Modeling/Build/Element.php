<?php

namespace Modeling\Build;


use Doctrine\Common\Collections\ArrayCollection;
use Modeling\Build\Elements\Application;

abstract class Element {
    use StaticCreate;

    /** @var \SplFileInfo       */ protected $path;
    /** @var string             */ protected $name;
    /** @var Application        */ protected $application;
    /** @var Element            */ protected $container;
    /** @var ArrayCollection    */ protected $elements;

    public function __construct($name = null) {
        $this->setName($name);
    }

    public function traverse(Application $app, \Closure $apply = null) {
        if ($apply) $apply($this);
        $elements = $this->getElements();
        if ($elements) array_map(function (Element $element) use ($app, $apply) {
            $thisClass = array_pop(explode('\\', get_class($this)));
            $elementClass = array_pop(explode('\\', get_class($element)));
            $app->getBuildEnvironment()->getLogger()->info($thisClass . ' : ' . $this->getName() . " has $elementClass : " . $element->getName());
            $element
                ->setApplication($app)
                ->setContainer($this)
                ->traverse($app, $apply);
        }, $elements->getValues());
    }

    /**
     * @return \SplFileInfo
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param string $path
     * @return static
     */
    public function setPath($path) {
        $this->path = new \SplFileInfo($path);
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return static
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
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
     * @return Element
     */
    public function getContainer() {
        return $this->container;
    }

    /**
     * @param Element $container
     * @return static
     */
    public function setContainer($container) {
        $this->container = $container;
        return $this;
    }

    /**
     * @return static
     */
    public function setElements() {
        $this->elements = new ArrayCollection(func_get_args());
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getElements() {
        return $this->elements;
    }

    public function createPath($description, $extension = '') {
        $be = $this->getApplication()->getBuildEnvironment();
        $this->setPath(
                $this->getContainer()->getPath()
            .   DIRECTORY_SEPARATOR
            .   $this->getName()
            .   $extension
        );
        if ($extension) {
            $be->getLogger()->info('creating file ' . $this->getName());
            touch($this->getPath());
        } else {
            $be->makeFolder($this->getPath(), $description);
        }

    }

    abstract public function build();
}