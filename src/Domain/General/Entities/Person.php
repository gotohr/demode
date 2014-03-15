<?php

namespace Domain\General\Entities;

use Domain\General\string;
use Modeling\Entity;
use Modeling\Property;

/**
 * @method \Domain\General\Entities\Person setFirstName($firstName)
 * @method string getFirstName()
 * @method \Domain\General\Entities\Person setLastName($lastName)
 * @method string getLastName()
 */
class Person extends Entity {

    protected function _build() {
        $this->getProperties()
            ->add(Property::create('firstName'))
            ->add(Property::create('lastName'))
        ;
    }

    public function __toString() {
        return $this->getFirstName() . " " . $this->getLastName();
    }
} 