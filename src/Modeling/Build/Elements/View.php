<?php

namespace Modeling\Build\Elements;

use Modeling\Build\Element;

class View extends Element {

    public function build() {
        $this->createPath('view ' . $this->getName(), '.php');
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

    /**
     * @param $string
     * @return View
     */
    public function useTag($string) {
        return $this;
    }

    /**
     * @return View
     */
    public function asTable() {
        return $this;
    }

    /**
     * @return View
     */
    public function handlePost() {
        return $this;
    }
}