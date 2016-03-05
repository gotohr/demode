<?php

namespace Modeling\Build\Elements;

use Modeling\Build\Element;
use Modeling\Entity;
use Modeling\Property;

class View extends Element {

    /** @var Entity */ protected $entity = null;

    public function build() {
//        $this->addCreatePathTask('view ' . $this->getName(), '.php');
    }

    /**
     * @return Entity
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     * @return static
     */
    public function setEntity($entity) {
        $this->entity = $entity;
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