<?php

namespace Modeling\Build;

trait StaticCreate {

    /**
     * @param null|string $name
     * @return static
     */
    public static function create($name = null) {
        return new static($name);
    }
}