<?php

namespace Modeling\Build\Artifact\Silex\Provisions;

use Modeling\Build\Artifact;
use Modeling\Build\Artifact\Silex\Provision;
use Modeling\Build\Elements\Application as ApplicationElement;

class Application extends Provision {

    public function provision(ApplicationElement $el) {
        $this->template(
            'index', $el,
            function($silex, ApplicationElement $el) {
                return [];
            },
            '/web/index.php'
        );
    }

}