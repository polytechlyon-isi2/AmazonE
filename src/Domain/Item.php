<?php

namespace AmazonE\Domain;

class Item 
{
    /**
     * Item id.
     *
     * @var integer
     */
    private $id;

    /**
     * Item name.
     *
     * @var string
     */
    private $name;

    /**
     * Item description.
     *
     * @var string
     */
    private $description;

    /**
     * Item price.
     *
     * @var float
     */
    private $price;

    /**
     * Item image.
     *
     * @var string
     */
    private $image;

    /**
     * Item sub category.
     *
     * @var \AmazonE\Domain\SubCategory
     */
    private $subCategory;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getSubCategory() {
        return $this->subCategory;
    }

    public function setSubCategory(SubCategory $subCategory) {
        $this->subCategory = $subCategory;
    }
}