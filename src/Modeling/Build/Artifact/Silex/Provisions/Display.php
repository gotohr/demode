<?php

namespace Modeling\Build\Artifact\Silex\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Silex\Provision;
use Modeling\Build\Elements\Display as DisplayElement;

class Display extends Provision {

    public function provision(DisplayElement $el) {
        $this->template(
            'display', $el,
            function($silex, DisplayElement $el) {
                return ['name' => $el->getName()];
            }
        );
    }

}