<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['order_id'])) {
    header("Location: ../pages/checkout.php");
    exit();
}

$order_id = intval($_POST['order_id']);
$user_id = $_SESSION['user_id'];

// Update status pesanan
$sql = "UPDATE orders SET status='processing' WHERE id=$order_id AND user_id=$user_id";
mysqli_query($conn, $sql);

// Redirect ke detail pesanan
header("Location: ../pages/order_detail.php?id=$order_id&paid=1");
exit();
?>