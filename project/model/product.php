<?php

/* product table */

class Product {

    /* table fields */
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $image;
    public $imageLarge;
    public $category;

    /* set default value with constructor */
    function __construct()
    {
        $this->id = 0;
        $this->name = "";
        $this->price = "";
        $this->quantity = "";
        $this->image = "";
        $this->imageLarge = "";
        $this->category = "";
    }
}