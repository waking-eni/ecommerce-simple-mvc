<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
require_once __DIR__.'/../controller/productController.php';
require_once __DIR__.'/../model/product.php';

if(isset($_POST['add-product'])) {
    $productController = new ProductController();
    $productTable = new Product();

    $productTable->name = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['name']);
    $productTable->price = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['price']);
    $productTable->category = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['category']);
    $productTable->quantity = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['quantity']);

    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['chooseimg']['tmp_name'])) {
            $image = addslashes(file_get_contents($_FILES['chooseimg']['tmp_name']));
            $productTable->image = $_FILES['chooseimg']['name'];
        }
        if(is_uploaded_file($_FILES['chooseimgl']['tmp_name'])) {
            $imagel = addslashes(file_get_contents($_FILES['chooseimgl']['tmp_name']));
            $productTable->imageLarge = $_FILES['chooseimgl']['name'];
        }
        $target = "../images/products-small/".basename($image);
        $targetl = "../images/products-original/".basename($imagel);
        move_uploaded_file($image, $target);
        move_uploaded_file($imagel, $targetl);
    } else {
        $image = null;
        $imagel = null;
    }


    if(empty($name) || empty($price) || empty($category)  || empty($quantity)) {
        header("Location: ../view/adminAddProducts.php?error=emptyfields");
        exit();
    } else {
        $productController->insertProduct($productTable);
        header("Location: ../view/adminAddProducts.php?add=success");
        exit();
    }

} else {
    header("Location: ../view/adminAddProducts.php");
    exit();
}