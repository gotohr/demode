<?php

use Domain\General\Model\Person;
use Domain\General\Model\User;

class ModelingTest extends PHPUnit_Framework_TestCase {

    public function _testPersonCreation() {
        $person = new Person();
        $person
            ->setFirstName('Hello')
            ->setLastName('World')
        ;

        echo "$person" . PHP_EOL;
    }

    public function testComposition() {
        $person = new Person();
        $person
            ->setFirstName('Hello')
            ->setLastName('World')
        ;

        $user = new User();

        $user
            ->setUsername('usr')
            ->setPassword('pwd')
            ->getPerson()
                ->setFirstName("qwe")
                ->setLastName("asd")
            //->setPerson($person)
        ;

        echo "$user" . PHP_EOL;
    }
} 