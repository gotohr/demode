<?php

namespace Modeling\Build\Elements;

use Modeling\Build\Element;
use Modeling\Entity;
use Modeling\Property;

class View extends Element {

    /** @var \Closure */ protected $from = null;

    public function build() {
        $this->addCreatePathTask('view ' . $this->getName(), '.php');
        $this->getApplication()->getTasks()->add($this->from ?: function() {});
    }

    /**
     * @param Entity $entity
     * @return View
     */
    public function from(Entity $entity) {
        $this->from = function () use ($entity) {
            $file = $this->getPath()->openFile('w');
            $props = $entity->getProperties()->map(function (Property $prop) {
                return $prop->getName();
            });
//            print_r();
            $file->fwrite(implode(', ', $props->toArray()));
            $file = null;
        };
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