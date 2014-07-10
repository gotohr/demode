<?php

namespace Modeling;

class Service {

    /**
     * @return Service
     */
    public static function create() {
        return new self();
    }
}