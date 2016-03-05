<?php

namespace Modeling\Build\Artifact\Bootstrap\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Provision;
use Modeling\Build\Elements\Display as DisplayElement;

class Display extends Provision {

    public function provision(DisplayElement $el) {
        $this->template(
            'layout', $el,
            function($artifact, DisplayElement $el) {
                return [];
            },
            '/' . $el->getName() . '/layout.twig', ''
        );
    }

}