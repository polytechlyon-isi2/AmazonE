<?php

namespace AmazonE\Domain;

class Category 
{
    /**
     * Category id.
     *
     * @var integer
     */
    private $id;

    /**
     * Category label.
     *
     * @var string
     */
    private $label;

    /**
     * Category description.
     *
     * @var string
     */
    private $description;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}