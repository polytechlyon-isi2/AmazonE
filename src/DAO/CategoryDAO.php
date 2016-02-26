<?php

namespace AmazonE\DAO;

use AmazonE\Domain\Category;

class CategoryDAO extends DAO
{
    /**
     * Return a list of all categories.
     *
     * @return array A list of all categories.
     */
    public function findAll() {
        $sql = "select * from t_categories";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categoryId = $row['cat_id'];
            $categories[$categoryId] = $this->buildDomainObject($row);
        }
        return $categories;
    }

    /**
     * Returns a category matching the supplied id.
     *
     * @param integer $id
     *
     * @return \AmazonE\Domain\Category|throws an exception if no matching category is found
     */
    public function find($id) {
        $sql = "select * from t_categories where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }

    /**
     * Saves a category into the database.
     *
     * @param \AmazonE\Domain\Category $category The category to save
     */
    public function save(Category $category) {
        $categoryData = array(
            'cat_label' => $category->getLabel(),
            'cat_description' => $category->getDescription(),
            );

        if ($category->getId()) {
            // The category has already been saved : update it
            $this->getDb()->update('t_categories', $categoryData, array('cat_id' => $category->getId()));
        } else {
            // The category has never been saved : insert it
            $this->getDb()->insert('t_categories', $categoryData);
            // Get the id of the newly created category and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $category->setId($id);
        }
    }

    /**
     * Removes a category from the database.
     *
     * @param integer $id The category id.
     */
    public function delete($id) {
        // Delete the category
        $this->getDb()->delete('t_categories', array('cat_id' => $id));
    }

    /**
     * Creates a Category object based on a DB row.
     *
     * @param array $row The DB row containing Category data.
     * @return \AmazonE\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setId($row['cat_id']);
        $category->setLabel($row['cat_label']);
        $category->setDescription($row['cat_description']);
        return $category;
    }
}