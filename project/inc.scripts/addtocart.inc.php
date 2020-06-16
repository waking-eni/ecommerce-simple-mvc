<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

if(isset($_POST['addtocart'])) {

    $quantity = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['quantity']);
    $total = $_SESSION['prPrice'] * $quantity;
    $productId = $_SESSION['prId'];
    $prName = $_SESSION['prName'];

    if($quantity===null || $total===null || $productId===null || $prName===null) {
        header("Location: ../view/index.php?error=noproduct");
        exit();
    } else {
        $_SESSION['cart'] = array();
        $a = array($productId, $prName, $quantity, $total);
        array_push($_SESSION['cart'], $a);

        header("Location: ../view/cart.php");
        exit();
    }

} else {
    header("Location: ../view/index.php");
	exit();
}