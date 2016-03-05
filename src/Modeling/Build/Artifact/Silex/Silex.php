<?php

namespace Modeling\Build\Artifact\Silex;


use Modeling\Build\Artifact;
use Modeling\Build\Elements\Application;
use Modeling\Build\Elements\Display;
use Modeling\Build\Elements\View;
use Modeling\Build\StaticCreate;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Silex extends Artifact {

    public function getArtifactFolder() { return __DIR__; }
    public function getArtifactNamespace() { return __NAMESPACE__; }

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
            && mkdir includes
        ");
//            && composer.phar install

        $this->getLogger()->info("Silex installed");

//      shell_exec("cd {$this->getPath()} && composer.phar require silex/silex \"~1.3\"");
    }

}