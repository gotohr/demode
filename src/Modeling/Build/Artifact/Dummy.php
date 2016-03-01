<?php

namespace Modeling\Build\Artifact;

use Modeling\Build\Artifact;
use Modeling\Build\Elements\View;

class Dummy extends Artifact {

    public function install() {
        // TODO: Implement install() method.
    }

    public function provision($element) {
        // TODO: Implement provision() method.
    }

    public function provisionFn($element) {
        return function() {};
    }

    public function getTwig() {
        // TODO: Implement getTwig() method.
    }

}