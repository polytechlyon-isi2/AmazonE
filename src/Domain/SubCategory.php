<?php

namespace AmazonE\Domain;

class SubCategory
{
    /**
     * Sub category id.
     *
     * @var integer
     */
    private $id;

    /**
     * Sub category label.
     *
     * @var string
     */
    private $label;

    /**
     * Sub category category.
     *
     * @var \AmazonE\Domain\Category
     */
    private $category;

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

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
    }
}