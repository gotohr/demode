<?php

namespace Modeling\Build\Artifact\Bootstrap;


use Modeling\Build\Artifact;
use Modeling\Build\Elements\Application;
use Modeling\Build\Elements\Display;
use Modeling\Build\Elements\View;
use Modeling\Build\StaticCreate;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Bootstrap extends Artifact {

    public function getArtifactFolder() { return __DIR__; }
    public function getArtifactNamespace() { return __NAMESPACE__; }

    public function install() {
        $this->getLogger()->info("installing Bootstrap from artefact");

        $path = $this->getApplication()->getBuildEnvironment()->getPath()->getPath();
        $bootstrap_zip = "bootstrap-3.3.6-dist.zip";
        $zip = "{$path}/../../artifacts/{$bootstrap_zip}";
        shell_exec(
            "cd {$this->getApplication()->getPath()}/web \\
            && cp $zip . \\
            && unzip $bootstrap_zip \\
            && mv bootstrap-3.3.6-dist bootstrap \\
            && rm $bootstrap_zip
        ");

        $this->getLogger()->info("Bootstrap installed");
    }

}