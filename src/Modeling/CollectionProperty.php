<?php

namespace Modeling;

use Doctrine\Common\Collections\ArrayCollection;

class CollectionProperty extends Property {

    private $collection;

    public function __construct($name, $fqcn = null) {
        parent::__construct($name, $fqcn);
        $this->collection = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getValue() {
        return $this->collection;
    }
}