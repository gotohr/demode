<?php

namespace Modeling\Build;

trait StaticCreate {

    /**
     * @return static
     */
    public static function create() {
        return new static;
    }
}