<?php

/* Database handler */

define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('database', 'ecommerce-simple');
define('port', '3308');

Class ModelController {

    private $con = null;

    public function __construct() {
        try {
            $this->con = new mysqli(host, user, pass, database, port);
        } catch (Exception $e) {
            die ('Unable to connect to the database.');
        }
    }

    public function __destruct() {
        if($this->con) {
            $this->con->close();
        }
    }

    public function fetchRecords($sql) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    public function oneParamRecord($sql, $id) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("s", $id);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    // values is an array, so call_user_func_array is used to bind parameters
    public function arrayParamRecord($sql, $values, $type) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $values));
            $stmt->execute();
        }
    }

    //count the number of rows found matching a specific query
    public function numRows($sql) {
        $numRows = $this->con->query($sql);
        return $numRows->num_rows;
    }

}
