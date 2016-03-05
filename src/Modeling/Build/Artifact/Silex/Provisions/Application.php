<?php

namespace Modeling\Build\Artifact\Silex\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Provision;
use Modeling\Build\Elements\Application as ApplicationElement;

class Application extends Provision {

    public function provision(ApplicationElement $el) {
        $this->template(
            'index', $el,
            function($artifact, ApplicationElement $el) {
                return [];
            },
            '/web/index.php'
        );
    }

}