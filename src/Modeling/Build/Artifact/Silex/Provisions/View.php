<?php

namespace Modeling\Build\Artifact\Silex\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Provision;
use Modeling\Build\Elements\View as ViewElement;

class View extends Provision {

    public function provision(ViewElement $el) {
        $this->template(
            'view', $el,
            function($artifact, ViewElement $el) {
                return ['name' => $el->getName()];
            }
        );
    }


}