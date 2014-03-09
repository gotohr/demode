<?php

namespace Domain\General;

use Modeling\Entity;
use Modeling\Property;

/**
 * @method \Domain\General\Person setFirstName($firstName)
 * @method string getFirstName()
 * @method \Domain\General\Person setLastName($lastName)
 * @method string getLastName()
 */
class Person extends Entity {

    protected function _build() {
        $this->getProperties()
            ->addProperty(Property::create('firstName'))
            ->addProperty(Property::create('lastName'))
        ;
    }

    public function __toString() {
        return $this->getFirstName() . " " . $this->getLastName();
    }
} 