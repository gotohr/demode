<?php

namespace Modeling;

use Doctrine\Common\Collections\ArrayCollection;

class Properties extends ArrayCollection {

    /**
     * @param Property $property
     * @return Properties
     */
    public function add($property) {
        $this->set($property->getName(), $property);
        return $this;
    }

    /**
     * @param $name
     * @param Property $property
     * @return Properties
     */
    public function set($name, $property) {
        parent::set($name, $property);
        return $this;
    }
}