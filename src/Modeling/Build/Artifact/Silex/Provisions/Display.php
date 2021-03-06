<?php

namespace Modeling\Build\Artifact\Silex\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Provision;
use Modeling\Build\Elements\Display as DisplayElement;

class Display extends Provision {

    public function provision(DisplayElement $el) {
        $this->template(
            'display', $el,
            function($artifact, DisplayElement $el) {
                return ['name' => $el->getName()];
            }
        );
    }

}