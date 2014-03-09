<?php

class PersonTest extends PHPUnit_Framework_TestCase {

    public function testPersonCreation() {
        $person = new \Domain\General\Person();
        $person
            ->setFirstName('Hello')
            ->setLastName('World')
        ;

        echo "$person" . PHP_EOL;
    }
} 