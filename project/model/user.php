<?php

/* user table */

class User {

    /* table fields */
    public $id;
    public $username;
    public $email;
    public $password;

    /* set default value with constructor */
    function __construct()
    {
        $this->id = 0;
        $this->username = "";
        $this->email = "";
        $this->password = "";
    }
}