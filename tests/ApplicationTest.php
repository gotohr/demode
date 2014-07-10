<?php

use Modeling\Application;
use Modeling\Display;
use Modeling\View;

class ApplicationTest extends PHPUnit_Framework_TestCase {

    public function testApplicationCreation() {
        Application::create()
            ->has(
                Display::create()
                    ->layout('center')
                    ->show(
                        View::create()
                            ->from(\Domain\General\Model\User::create())
                            ->asDataEntry()
                    )
                    ->handlePost()
            )
        ;

        // app displays login screen where we can enter login data (username and password)
        // login screen verifies data against service
    }

}