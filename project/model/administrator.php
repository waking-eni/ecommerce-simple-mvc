<?php

/* administrator table */

class Administrator {

    /* table fields */
    public $id;
    public $name;
    public $surname;
    public $username;
    public $email;
    public $password;

    /* set default value with constructor */
    function __construct()
    {
        $this->id = 0;
        $this->name = "";
        $this->surname = "";
        $this->username = "";
        $this->email = "";
        $this->password = "";
    }
}