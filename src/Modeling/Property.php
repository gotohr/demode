<?php

namespace Modeling;

class Property {

    protected $name;
    protected $value;
    protected $fqcn = null;
    protected $lazy = false;

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

} 