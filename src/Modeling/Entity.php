<?php

namespace Modeling;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Entity {

    protected static $_properties = array();

    /** @var Properties */ protected $properties;

    public function __construct() {
        $this->properties = new Properties();
        $this->__build();
    }

    public static function getFQCN() {
        return get_called_class();
    }

    private function __build() {
        if (!isset(self::$_properties[$this->getFQCN()])) {
            $this->_build();
            self::$_properties[$this->getFQCN()] = clone ($this->properties);
        } else {
            $this->properties = clone (self::$_properties[$this->getFQCN()]);
        }
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

    /**
     * @param $name
     * @param $args
     * @return $this
     * @throws \Exception
     */
    public function __call($name, $args) {
        $propertyName = lcfirst(substr($name, 3));
        $property = $this->properties->get($propertyName);
        if (!$property) {
            throw new \Exception(static::getFQCN() . " has no $property defined.");
        }
        $prefix = substr($name, 0, 3);
        if ($property) {
            if ($prefix === 'get') {
                return $property->getValue();
            } elseif ($prefix === 'set') {
                $property->setValue($args[0]);
                return $this;
            } elseif ($prefix === 'add') {
                $property->getValue()->add($args[0]);
                return $this;
            }
        }
    }
} 