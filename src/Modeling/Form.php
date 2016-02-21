<?php

namespace Modeling;

use Modeling\Elements\View;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;

class Form {

    protected  $builder;

    public function __construct() {
        $this->builder = new FormBuilder(
            'newform',
            null,
            new EventDispatcher()
        );
    }

    /**
     * @return Form
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