<?php

use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Modeling\Build\Artifact;
use Modeling\Build\Element;
use Modeling\Build\Elements\Application;
use Modeling\Build\Elements\BuildEnvironment;
use Modeling\Build\Elements\Display;
use Modeling\Build\Elements\View;

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
        $logger->pushHandler(new ErrorLogHandler());
        return $logger;
    }

    public function testApplicationCreation() {

        $be = BuildEnvironment::create('test')
            ->setLogger($this->getLogger())
            ->setPath('../target/')
        ;

        $app = Application::create('testapp')
            ->setWith(
                Artifact\Silex\Silex::create(),
                Artifact\Bootstrap\Bootstrap::create()
            )
            ->setBuildEnvironment($be)
            ->setElements(
                Display::create('views')
                    ->setElements(
                        $dashboard = View::create('dashboard'),
                        View::create('users')
                            ->setEntity(\Domain\General\Model\User::create())
                            ->useTag('list')
                            ->asTable(), //->withPagination(50)
                        View::create('login')
                            ->setEntity(\Domain\General\Model\User::create())
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

        $app->traverse($app, function(Element $el) use ($app) {
            $el->build();
            $el->addProvisionTask();
        });

        echo $app->execute();

    }


}