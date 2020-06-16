<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
require_once __DIR__.'/../controller/productController.php';

if(isset($_POST['deletepr'])) {
    $id = str_replace(array(':', '-', '/', '*', '<', '>'), '',  $_POST['prId']);
    $productController = new ProductController();
    
    if(empty($id)) {
        header("Location: ../view/adminManageProducts.php?error=emptyid");
        exit();
    } else {
        $productController->deleteProduct($id);
        header("Location: ../view/adminManageProducts.php?deletearticle=success");
		exit();
    }

} else {
    header("Location: ../view/adminManageProducts.php");
	exit();
}