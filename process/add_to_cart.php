<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if(isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    header("Location: ../pages/cart.php");
    exit();
} else {
    header("Location: ../pages/products.php");
    exit();
}
?>
