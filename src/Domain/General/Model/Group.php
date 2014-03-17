<?php

namespace Domain\General\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Modeling\CollectionProperty;
use Modeling\Entity;
use Modeling\Property;

/**
 * @method \Domain\General\Model\Group setName($name)
 * @method string getName()
 * @method \Domain\General\Model\User addUser(\Domain\General\Model\User $user)
 * @method ArrayCollection getUser()
 */
class Group extends Entity {

    /**
     * @return Group
     */
    public static function create() {
        return new static();
    }

    protected function _build() {
        $this->getProperties()
            ->add(Property::create('name'))
            ->add(CollectionProperty::create('user')->setFqcn(User::getFQCN()))
        ;
    }

    public function __toString() {
        return $this->getName();
    }
}