<?php

namespace AmazonE\DAO;

use AmazonE\Domain\Category;
use AmazonE\Domain\SubCategory;

class SubCategoryDAO extends DAO
{
    /**
     * @var \AmazonE\DAO\CategoryDAO
     */
    private $categoryDAO;

    public function setCategoryDAO(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }

    /**
     * Return a list of all sub categories.
     *
     * @return array A list of all sub categories.
     */
    public function findAll() {
        $sql = "select * from t_subcategories";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $subCategories = array();
        foreach ($result as $row) {
            $subCategoryId = $row['subcat_id'];
            $subCategories[$subCategoryId] = $this->buildDomainObject($row);
        }
        return $subCategories;
    }

    /**
     * Returns a sub category matching the supplied id.
     *
     * @param integer $id
     *
     * @return \AmazonE\Domain\SubCategory|throws an exception if no matching sub category is found
     */
    public function find($id) {
        $sql = "select * from t_subcategories where subcat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No sub category matching id " . $id);
    }

    /**
     * Returns a list of all sub categories matching the supplied category id.
     *
     * @param integer $id
     *
     * @return A list of all sub categories.
     */
    public function findByCategory($id) {
        $sql = "select * from t_subcategories where cat_id=?";
        $result = $this->getDb()->fetchAll($sql, array($id));

        // Convert query result to an array of domain objects
        $subCategories = array();
        foreach ($result as $row) {
            $subCategoryId = $row['subcat_id'];
            $subCategories[$subCategoryId] = $this->buildDomainObject($row);
        }
        return $subCategories;
    }

    /**
     * Saves a sub category into the database.
     *
     * @param \AmazonE\Domain\SubCategory $subCategory The sub category to save
     */
    public function save(SubCategory $subCategory) {
        $subCategoryData = array(
            'subcat_label' => $subCategory->getLabel(),
            'cat_id' => $subCategory->getCategory()->getId(),
            );

        if ($subCategory->getId()) {
            // The sub category has already been saved : update it
            $this->getDb()->update('t_subcategories', $subCategoryData, array('subcat_id' => $subCategory->getId()));
        } else {
            // The sub category has never been saved : insert it
            $this->getDb()->insert('t_subcategories', $subCategoryData);
            // Get the id of the newly created sub category and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $subCategory->setId($id);
        }
    }

    /**
     * Removes a sub category from the database.
     *
     * @param integer $id The sub category id.
     */
    public function delete($id) {
        // Delete the sub category
        $this->getDb()->delete('t_subcategories', array('subcat_id' => $id));
    }

    /**
     * Creates a SubCategory object based on a DB row.
     *
     * @param array $row The DB row containing SubCategory data.
     * @return \AmazonE\Domain\SubCategory
     */
    protected function buildDomainObject($row) {
        $categoryId = $row['cat_id'];
        $category = $this->categoryDAO->find($categoryId);

        $subCategory = new SubCategory();
        $subCategory->setId($row['subcat_id']);
        $subCategory->setLabel($row['subcat_label']);
        $subCategory->setCategory($category);
        return $subCategory;
    }
}