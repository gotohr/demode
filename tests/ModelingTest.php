<?php

use Domain\General\Model\Group;
use Domain\General\Model\Person;
use Domain\General\Model\User;

class ModelingTest extends PHPUnit_Framework_TestCase {

    public function _testPersonCreation() {
        $person = new Person();
        $person
            ->setFirstName('Hello')
            ->setLastName('World')
        ;

        $person2 = new Person();
        $person2
            ->setFirstName('qwe')
            ->setLastName('asdasd')
        ;

        echo "$person2" . PHP_EOL;
    }

    public function _testComposition() {
        $user = new User();
        $user
            ->setUsername("usr")
            ->setPassword('pwd')
            ->addEmail("test@some.com")
            ->getPerson()
                ->setFirstName("qwe")
                ->setLastName("asd")
            //->setPerson($person)
        ;
        echo "$user" . PHP_EOL;
    }

    public function testCollectionWithEntity() {
        $user = User::create()
            ->setUsername("usr")
            ->setPassword('pwd')
            ->addEmail("test@some.com")
        ;
        $user->getPerson()
                ->setFirstName("qwe")
                ->setLastName("asd")
            //->setPerson($person)
        ;

        $group = new Group();
        $group
            ->setName('testgroup')
        ;
        $group->addUser($user);

        echo "$group" . PHP_EOL;

        print_r($group);
    }

}