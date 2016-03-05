<?php

namespace Modeling\Build\Artifact;

use Modeling\Build\Artifact;

class Provision {

    /** @var Artifact  */ protected $artifact;

    /**
     * @return Artifact
     */
    public function getArtifact() {
        return $this->artifact;
    }

    /**
     * @param Artifact $artifact
     * @return static
     */
    public function setArtifact($artifact) {
        $this->artifact = $artifact;
        return $this;
    }

    public function provision($element) {}

    public function template($tpl, $el, \Closure $work, $targetPath = null, $prefix = '<' . '?php') {
        $artifact = $this->getArtifact();
        $artifactName = array_pop(explode('\\', get_class($artifact)));
        $elClass = get_class($el);
        $artifact->getLogger()->info("$artifactName provisioning. Applying resource tpl [$tpl] on [$elClass] named [{$el->getName()}]");
        $tplx = $artifact->getTemplater();
        $tplx->setDirectory($artifact->getArtifactFolder() . '/resources/');
        $content = $tplx->render($tpl, $work($artifact, $el));
        $tp = $targetPath ?: "/includes/{$el->getName()}.php";
        $filePath = $artifact->getApplication()->getPath() . $tp;
        file_put_contents($filePath, $prefix . PHP_EOL . $content);
    }

    public function __invoke($element) {
        $this->provision($element);
    }

}