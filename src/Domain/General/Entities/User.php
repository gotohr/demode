<?php

namespace Domain\General\Entities;

use Domain\General\Entities\Person;
use Domain\General\string;
use Modeling\Entity;
use Modeling\Property;

/**
 * @method \Domain\General\Entities\User setUsername($username)
 * @method string getUsername()
 * @method \Domain\General\Entities\User setPassword($password)
 * @method string getPassword()
 * @method \Domain\General\Entities\User setPerson(Person $person)
 * @method \Domain\General\Entities\Person getPerson()
 */
class User extends Entity {

    protected function _build() {
        $this->getProperties()
            ->add(Property::create('username'))
            ->add(Property::create('password'))
            ->add(
                Property::create('person')
                    ->setFqcn(Person::getFQCN())
                    ->setLazy(true)
            )
        ;
    }

    public function __toString() {
        return "{$this->getUsername()}:{$this->getPassword()} ({$this->getPerson()})";
    }
}