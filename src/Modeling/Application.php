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
} 