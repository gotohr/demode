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

        $person2 = new Person();
        $person2
            ->setFirstName('qwe')
            ->setLastName('asdasd')
        ;

        echo "$person2" . PHP_EOL;
    }

    public function testComposition() {
//        $person = new Person();
//        $person
//            ->setFirstName('Hello')
//            ->setLastName('World')
//        ;

        for ($i=0; $i<10000; $i++) {
            $user = new User();
            $user
                ->setUsername("$i usr")
                ->setPassword('pwd')
                ->addEmail("$i ljubo@canic.com")
                ->getPerson()
                    ->setFirstName("qwe")
                    ->setLastName("asd")
                //->setPerson($person)
            ;
//            echo "$user" . PHP_EOL;
        }

//        print_r($user->getEmail());
    }

} 