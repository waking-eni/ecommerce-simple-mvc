<?php

require_once __DIR__.'/modelController.php';

class ProductController {

    public function getController() {
        $controller = new ModelController();
        return $controller;
    }

    /* select all products from the database */
    public function fetchProducts($offset, $total_records_per_page) {
        $controller = $this->getController();
        $sql = "SELECT id, name, price, quantity, category, image FROM product 
                ORDER BY name DESC LIMIT $offset, $total_records_per_page ;";
        $result = $controller->fetchRecords($sql);
        return $result;
    }

    /* select product */
    public function selectProduct($id) {
        $controller = $this->getController();
        $sql = "SELECT id, name, price, quantity, image, image_large, category FROM product
                WHERE id = ? ;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert product */
    public function insertProduct($values) {
        $controller = $this->getController();
        $sql = "INSERT INTO product (name, price, quantity, image, image_large, category) 
                VALUES (?, ?, ?, ?, ?, ?);";
        $type = 'ssssss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update product */
    public function updateProduct($values) {
        $controller = $this->getController();
        $sql = "UPDATE product SET name = ?, price = ? quantity = ?, image = ?, image_large = ?, 
                category = ? WHERE id = ?;";
        $type = 'sssssss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete product */
    public function deleteProduct($id) {
        $controller = $this->getController();
        $sql = "DELETE FROM product WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }

    /* get the number of products */
    public function getNumOfProducts() {
        $controller = $this->getController();
        $sql = "SELECT id FROM product ;";
        $result = $controller->numRows($sql);
        return $result;
    }

    /* select product by category */
    public function selectProductByCat($cat, $offset, $total_records_per_page) {
        $controller = $this->getController();
        $sql = "SELECT id, name, price, image FROM product 
                WHERE category = ? ;";
        $result = $controller->oneParamRecord($sql, $cat);
        return $result;
    }
}