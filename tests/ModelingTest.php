<?php

class ModelingTest extends PHPUnit_Framework_TestCase {

    public function _testPersonCreation() {
        $person = new \Domain\General\Entities\Person();
        $person
            ->setFirstName('Hello')
            ->setLastName('World')
        ;

        echo "$person" . PHP_EOL;
    }

    public function testComposition() {
        $person = new \Domain\General\Entities\Person();
        $person
            ->setFirstName('Hello')
            ->setLastName('World')
        ;

        $user = new \Domain\General\Entities\User();

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