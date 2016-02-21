<?php

namespace Domain\General\Model;

use Doctrine\Common\Collections\ArrayCollection;
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
 * @method \Domain\General\Model\User addEmail($email)
 * @method ArrayCollection getEmail()
 */
class User extends Entity {

    /**
     * @return User
     */
    public static function create() {
        return new static();
    }

    protected function _build() {
        $this->getProperties()
            ->add(Property::create('username')->addTag('login'))
            ->add(Property::create('password')->addTag('login'))
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