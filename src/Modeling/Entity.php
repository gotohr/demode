<?php

namespace Modeling;

abstract class Entity {

    /** @var Properties */ protected $properties;

    public function __construct() {
        $this->properties = new Properties();
        $this->_build();
    }

    abstract protected function _build();

    /**
     * @param Properties $properties
     * @return Entity
     */
    protected function setProperties(Properties $properties) {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @return Properties
     */
    protected function getProperties() {
        return $this->properties;
    }

    public function __call($name, $args) {
        $propertyName = lcfirst(substr($name, 3));
        $property = $this->properties->getProperty($propertyName);
        $prefix = substr($name, 0, 3);
        if ($property) {
            if ($prefix === 'get') {
                return $property->getValue();
            } elseif ($prefix === 'set') {
                $property->setValue($args[0]);
                return $this;
            }
        }
    }
} 