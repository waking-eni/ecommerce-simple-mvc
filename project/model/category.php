<?php

/* category table */

class Category {

    /* table fields */
    public $id;
    public $name;

    /* set default value with constructor */
    function __construct()
    {
        $this->id = 0;
        $this->name = "";
    }
}