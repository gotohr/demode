<?php

namespace Modeling;

class Properties {

    /** @var Property[] */ protected $property;

    public function __construct() {
        $this->property = array();
    }

    /**
     * @param Property $property
     * @return Properties
     */
    public function add(Property $property) {
        $this->setProperty($property->getName(), $property);
        return $this;
    }

    /**
     * @param $name
     * @param Property $property
     * @return Properties
     */
    public function setProperty($name, Property $property) {
        $this->property[$name] = $property;
        return $this;
    }

    /**
     * @param $name
     * @return Property
     */
    public function getProperty($name) {
        return $this->property[$name];
    }
}