<?php

namespace Modeling\Build\Artifact\Silex\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Silex\Provision;
use Modeling\Build\Elements\View as ViewElement;

class View extends Provision {

    public function provision(ViewElement $el) {
        $this->template(
            'view', $el,
            function($silex, ViewElement $el) {
                return ['name' => $el->getName()];
            }
        );
    }


}