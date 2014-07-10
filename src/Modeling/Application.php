<?php

namespace Modeling;

class Application {

    /**
     * @return static
     */
    public static function create() {
        return new self();
    }

    /**
     * @return Application
     */
    public function has() {
        return $this;
    }

    /**
     * @return Application
     */
    public function show() {
        return $this;
    }

    /**
     * @return Application
     */
    public function build() {
        return $this;
    }

    public function describe() {
        return "brand new app! :) ";
    }
} 