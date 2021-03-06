<?php

namespace Modeling\Build\Artifact\Bootstrap\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Provision;
use Modeling\Build\Elements\View as ViewElement;

class View extends Provision {

    public function provision(ViewElement $el) {

        $this->template(
            'view', $el,
            function($artifact, ViewElement $el) {
                $props = $el->getEntity()
                    ? $el->getEntity()->getProperties()->map(function ($prop) {
                        return $prop->getName();
                    })
                    : [];
                return [
                    'name' => $el->getName(),
                    'props' => $props
                ];
            },
            '/views/' . $el->getName() . '.twig', ''
        );
    }


}