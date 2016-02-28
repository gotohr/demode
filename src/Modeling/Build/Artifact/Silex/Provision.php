<?php

namespace Modeling\Build\Artifact\Silex;

use Modeling\Build\StaticCreate;

class Provision {

    /** @var Silex  */ protected $silex;

    /**
     * @return Silex
     */
    public function getSilex() {
        return $this->silex;
    }

    /**
     * @param Silex $silex
     * @return static
     */
    public function setSilex($silex) {
        $this->silex = $silex;
        return $this;
    }

    public function provision($element) {}

    public function template($tpl, $el, \Closure $work, $targetPath = null) {
        $silex = $this->getSilex();
        $elClass = get_class($el);
        $silex->getLogger()->info("Silex provisioning. Applying resource tpl [$tpl] on [$elClass] named [{$el->getName()}]");
        $content = $silex->getTwig()->render("$tpl.twig", $work($this->getSilex(), $el));
        $tp = $targetPath ?: "/includes/_{$el->getName()}.php";
        $filePath = $silex->getApplication()->getPath() . $tp;
        file_put_contents($filePath, $content);
    }

    public function __invoke($element) {
        $this->provision($element);
    }

}