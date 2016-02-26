<?php

namespace AmazonE\DAO;

use AmazonE\Domain\Item;
use AmazonE\Domain\SubCategory;

class ItemDAO extends DAO
{
    /**
     * @var \AmazonE\DAO\SubCategoryDAO
     */
    private $subCategoryDAO;

    public function setSubCategoryDAO(SubCategoryDAO $subCategoryDAO) {
        $this->subCategoryDAO = $subCategoryDAO;
    }

    /**
     * Return a list of all items.
     *
     * @return array A list of all items.
     */
    public function findAll() {
        $sql = "select * from t_items";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $items = array();
        foreach ($result as $row) {
            $itemId = $row['it_id'];
            $items[$itemId] = $this->buildDomainObject($row);
        }
        return $items;
    }

    /**
     * Returns an item matching the supplied id.
     *
     * @param integer $id
     *
     * @return \AmazonE\Domain\Item|throws an exception if no matching item is found
     */
    public function find($id) {
        $sql = "select * from t_items where it_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No item matching id " . $id);
    }

    /**
     * Returns a list of all items matching the supplied sub category id.
     *
     * @param integer $id
     *
     * @return A list of all items.
     */
    public function findBySubCategory($id) {
        $sql = "select * from t_items where subcat_id=?";
        $result = $this->getDb()->fetchAll($sql, array($id));

        // Convert query result to an array of domain objects
        $items = array();
        foreach ($result as $row) {
            $itemId = $row['it_id'];
            $items[$itemId] = $this->buildDomainObject($row);
        }
        return $items;
    }

    /**
     * Saves an item into the database.
     *
     * @param \AmazonE\Domain\Item $item The item to save
     */
    public function save(Item $item) {
        $itemData = array(
            'it_name' => $item->getName(),
            'it_description' => $item->getDescription(),
            'it_price' => $item->getPrice(),
            'it_image' => $item->getImage(),
            'subcat_id' => $item->getSubCategory()->getId(),
            );

        if ($item->getId()) {
            // The item has already been saved : update it
            $this->getDb()->update('t_items', $itemData, array('it_id' => $item->getId()));
        } else {
            // The item has never been saved : insert it
            $this->getDb()->insert('t_items', $itemData);
            // Get the id of the newly created item and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $item->setId($id);
        }
    }

    /**
     * Removes an item from the database.
     *
     * @param integer $id The item id.
     */
    public function delete($id) {
        // Delete the item
        $this->getDb()->delete('t_items', array('it_id' => $id));
    }

    /**
     * Creates an Item object based on a DB row.
     *
     * @param array $row The DB row containing Item data.
     * @return \AmazonE\Domain\Item
     */
    protected function buildDomainObject($row) {
        $subCategoryId = $row['subcat_id'];
        $subCategory = $this->subCategoryDAO->find($subCategoryId);

        $item = new Item();
        $item->setId($row['it_id']);
        $item->setName($row['it_name']);
        $item->setDescription($row['it_description']);
        $item->setPrice($row['it_price']);
        $item->setImage($row['it_image']);
        $item->setSubCategory($subCategory);
        return $item;
    }
}