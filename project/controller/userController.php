<?php

require_once __DIR__.'/modelController.php';

class UserController {

    public function getController() {
        $controller = new ModelController();
        return $controller;
    }

    /* select all users from the database */
    public function fetchUsers($offset, $total_records_per_page) {
        $controller = $this->getController();
        $sql = "SELECT id, username, email, password FROM user
        ORDER BY id DESC LIMIT $offset, $total_records_per_page;";
        $result = $controller->fetchRecords($sql);
        return $result;
    }

    /* select user */
    public function selectUser($id) {
        $controller = $this->getController();
        $sql = "SELECT id, username, email FROM user WHERE id = ?;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert user */
    public function insertUser($values) {
        $controller = $this->getController();
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?);";
        $type = 'sss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update user */
    public function updateUser($values) {
        $controller = $this->getController();
        $sql = "UPDATE user SET username = ?, password = ? email = ?  WHERE id = ?;";
        $type = 'sss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete user */
    public function deleteUser($id) {
        $controller = $this->getController();
        $sql = "DELETE FROM user WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }

    /* check username */
    public function checkUsername($username) {
        $controller = $this->getController();
        $sql = "SELECT id, username, password FROM user WHERE username = ?;";
        $result = $controller->oneParamRecord($sql, $username);
        return $result;
    }

    /* login check */
    public function checkLogin($values) {
        $controller = $this->getController();
        $sql = "SELECT id, username, password FROM user WHERE username = ? OR email = ? ;";
        $type = 'ss';
        $result = $controller->arrayParamRecord($sql, $values, $type);
        return $result;
    }

    /* get the number of users */
    public function getNumOfUsers() {
        $controller = $this->getController();
        $sql = "SELECT id FROM user ;";
        $result = $controller->numRows($sql);
        return $result;
    }

}