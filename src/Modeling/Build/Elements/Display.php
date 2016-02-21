<?php

namespace Modeling\Build\Elements;

use Modeling\Build\Element;

class Display extends Element {

    public function build() {
        $this->createPath('display ' . $this->getName() . ' folder ');
    }


    /**
     * @return Display
     */
    public function layout() {
        return $this;
    }

    /**
     * @return Display
     */
    public function show() {
        return $this;
    }

} 