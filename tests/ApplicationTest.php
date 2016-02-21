<?php

use Modeling\Build\Element;
use Modeling\Build\Elements\Application;
use Modeling\Build\Elements\BuildEnvironment;
use Modeling\Build\Elements\Display;
use Modeling\Build\Elements\View;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ApplicationTest extends PHPUnit_Framework_TestCase {

    protected function getLogger() {
        $logger = new Logger("demode");
        $logFilePath = "../logs/app.log";
        $f = @fopen($logFilePath, "r+");
        if ($f !== false) {
            ftruncate($f, 0);
            fclose($f);
        }
        $logger->pushHandler(new StreamHandler($logFilePath));
        return $logger;
    }

    public function testApplicationCreation() {
        $be = BuildEnvironment::create()
            ->setName('test')
            ->setLogger($this->getLogger())
            ->setPath('../target/')
        ;

        $app = Application::create()->setName("testapp")
            ->setBuildEnvironment($be)
            ->setElements(
                Display::create()->setName('browser')
                    ->setElements(
                        $dashboard = View::create()->setName('dashboard'),
                        View::create()->setName('users')
                            ->from(\Domain\General\Model\User::create())
                            ->useTag('list')
                            ->asTable(), //->withPagination(50)
                        View::create()->setName('login')
                            ->from(\Domain\General\Model\User::create())
                            ->useTag('login')
                            ->asDataEntry()
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
            )
        ;

        $app->traverse($app, function(Element $el) {
            $el->build();
        });

        echo $app->describe();

        // app displays login screen where we can enter login data (username and password)
        // login screen verifies data against service
    }


}