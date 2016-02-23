<?php

namespace Modeling\Build\Artifact\Silex;


use Modeling\Build\Artifact;
use Modeling\Build\Elements\Application;
use Modeling\Build\Elements\View;
use Modeling\Build\StaticCreate;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Silex extends Artifact {

    /** @var Twig_Environment */ protected $twig;

    public function getTwig() {
        if (!$this->twig) {
            $loader = new Twig_Loader_Filesystem(__DIR__ . '/resources');
            $this->twig = new Twig_Environment($loader, array(
//                'cache' => '/path/to/compilation_cache',
            ));
        }
        return $this->twig;
    }

    public function install() {
        $this->getLogger()->info("installing Silex from artefact");

        $path = $this->getApplication()->getBuildEnvironment()->getPath()->getPath();
//        $silex_zip = "silex_fat.zip";
        $silex_zip = "silex_fat_repackaged.zip";
        $zip = "{$path}/../artifacts/{$silex_zip}";
        shell_exec(
            "cd {$this->getApplication()->getPath()} \\
            && cp $zip . \\
            && unzip $silex_zip \\
            && mv silex/* . && rm -rf silex \\
            && rm $silex_zip \\
            && mkdir controllers
        ");
//            && composer.phar install

        $this->getLogger()->info("Silex installed");

//      shell_exec("cd {$this->getPath()} && composer.phar require silex/silex \"~1.3\"");
    }

    public function provision() {
    }

    public function provisionApplication() {
        $this->getLogger()->info('Silex provisioning new web/index.php for Application: ' . $this->getApplication()->getName());
        $content = $this->getTwig()->render('index.twig');
        $filePath = $this->getApplication()->getPath() . '/web/index.php';
        file_put_contents($filePath, $content);
    }


    public function provisionView(View $view) {
        $this->getLogger()->info('Silex provisioning controller for View: ' . $view->getName());
        $content = $this->getTwig()->render('view.twig', ['name' => $view->getName()]);
        $filePath = $this->getApplication()->getPath() . "/controllers/{$view->getName()}.php";
        file_put_contents($filePath, $content);
    }


}