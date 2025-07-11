<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];
    
    if(isset($_SESSION['cart'][$product_id])) {
        if($_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    
    header("Location: ../pages/cart.php");
    exit();
} else {
    header("Location: ../pages/cart.php");
    exit();
}
?> 