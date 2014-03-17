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
     * @param mixed $name
     * @param Property $property
     * @return Properties
     */
    public function set($name, $property) {
        parent::set($name, $property);
        return $this;
    }

    public function __clone() {
        $collProps = $this->filter(function($item) {
            return $item instanceof CollectionProperty;
        });

        /** @var CollectionProperty $prop */
        foreach ($collProps as $prop) {
            $this->set(
                $prop->getName(),
                CollectionProperty::create($prop->getName())
                    ->setFqcn($prop->getFqcn())
            );
        }
    }
}