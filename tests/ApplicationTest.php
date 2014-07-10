<?php

use Modeling\Application;
use Modeling\Display;
use Modeling\View;

class ApplicationTest extends PHPUnit_Framework_TestCase {

    public function testApplicationCreation() {
        $app = Application::create()
            ->has(
                $dashboard = Display::create(),
                $login = Display::create()
                    ->layout('center')
                    ->show(
                        View::create()
                            ->from(\Domain\General\Model\User::create())
                            ->asDataEntry()
                    )
                    ->handlePost(
                        function($data) use (&$app, $dashboard) {
                            /** @var Application $app */
                            /** @var \Domain\General\Model\User $data */
                            $isAuthenticated = $app->getService('authenticate', $data);
                            if ($isAuthenticated) {
                                $app->show($dashboard);
                            }
                        }
                    )
            )
            ->show($login)
            ->build();
        ;

        echo $app->describe();
        // app displays login screen where we can enter login data (username and password)
        // login screen verifies data against service
    }

}