<?php

require_once __DIR__.'/modelController.php';

class AdminController {

    public function getController() {
        $controller = new ModelController();
        return $controller;
    }

    /* login check */
    public function checkLogin($values) {
        $controller = $this->getController();
        $sql = "SELECT id, username, password FROM admin WHERE username = ? OR email = ? ;";
        $type = 'ss';
        $result = $controller->arrayParamRecord($sql, $values, $type);
        return $result;
    }

}