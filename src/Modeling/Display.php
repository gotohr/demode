<?php

namespace Modeling;

class Display {

    /**
     * @return Display
     */
    public static function create() {
        return new self();
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