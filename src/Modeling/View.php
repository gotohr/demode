<?php

namespace Modeling;

class View {

    /**
     * @return View
     */
    public static function create() {
        return new self();
    }

    /**
     * @return View
     */
    public function from() {
        return $this;
    }

    /**
     * @return View
     */
    public function asDataEntry() {
        return $this;
    }
}