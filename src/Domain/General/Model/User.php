<?php

namespace Domain\General\Model;

use Modeling\CollectionProperty;
use Modeling\Entity;
use Modeling\Property;

/**
 * @method \Domain\General\Model\User setUsername($username)
 * @method string getUsername()
 * @method \Domain\General\Model\User setPassword($password)
 * @method string getPassword()
 * @method \Domain\General\Model\User setPerson(Person $person)
 * @method \Domain\General\Model\Person getPerson()
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
            ->add(CollectionProperty::create('email'))
        ;
    }

    public function __toString() {
        return "{$this->getUsername()}:{$this->getPassword()} ({$this->getPerson()})";
    }
}