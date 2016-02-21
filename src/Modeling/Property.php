<?php

namespace Modeling;

class Property {

    protected $name;
    protected $value;
    protected $fqcn = null;
    protected $lazy = false;
    protected $tags = array();

    public function __construct($name, $fqcn = null, $lazy = false) {
        $this->name = $name;
        $this->fqcn = $fqcn;
        $this->lazy = $lazy;
    }

    /**
     * @param $name
     * @return Property
     */
    public static function create($name) {
        return new static($name);
    }

    /**
     * @param $tag
     * @return bool
     */
    public function hasTag($tag) {
        return in_array($tag, $this->tags);
    }

    /**
     * @param null $fqcn
     * @return Property
     */
    public function setFqcn($fqcn) {
        $this->fqcn = $fqcn;
        return $this;
    }

    /**
     * @return null
     */
    public function getFqcn() {
        return $this->fqcn;
    }

    /**
     * @param boolean $lazy
     * @return Property
     */
    public function setLazy($lazy) {
        $this->lazy = $lazy;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getLazy() {
        return $this->lazy;
    }

    /**
     * @param mixed $name
     * @return Property
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $value
     * @throws \Exception
     * @return Property
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        if ($this->lazy && !$this->value) {
            $fqcn = $this->getFqcn();
            $this->setValue(new $fqcn);
        }
        return $this->value;
    }

    /**
     * @param $tag
     * @return Property
     */
    public function addTag($tag) {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @param $value
     * @throws \Exception
     */
    public function checkType($value) {
        if ($value instanceof Entity) {
            $fqcn = $value->getFqcn();
            if ($fqcn && get_class($value) != $this->getFqcn()) {
                throw new \Exception("$fqcn wrong type for {$this->getFqcn()}::$this field!");
            }
        }
    }

    public function __toString() {
        return $this->getName();
    }

} 