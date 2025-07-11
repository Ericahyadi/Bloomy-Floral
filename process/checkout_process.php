<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: ../pages/cart.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $nama_penerima = mysqli_real_escape_string($conn, $_POST['nama_penerima']);
    $alamat_pengiriman = mysqli_real_escape_string($conn, $_POST['alamat_pengiriman']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    
    // Hitung total
    $total = 0;
    foreach($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT harga FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $total += $product['harga'] * $quantity;
        }
    }
    
    // Insert order
    $sql = "INSERT INTO orders (user_id, total, alamat_pengiriman, status) 
            VALUES ($user_id, $total, '$alamat_pengiriman', 'pending')";
    
    if(mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);
        
        // Insert order items
        $success = true;
        foreach($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT harga FROM products WHERE id = $product_id";
            $result = mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0) {
                $product = mysqli_fetch_assoc($result);
                $harga = $product['harga'];
                
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, harga) 
                        VALUES ($order_id, $product_id, $quantity, $harga)";
                
                if(!mysqli_query($conn, $sql)) {
                    $success = false;
                    break;
                }
            }
        }
        
        if($success) {
            // Kosongkan keranjang
            unset($_SESSION['cart']);
        
            // Simpan order_id ke session untuk QRIS
            $_SESSION['last_order_id'] = $order_id;
        
            // Redirect ke halaman QRIS
            header("Location: ../pages/qris_payment.php");
            exit();
        
        } else {
            // Hapus order jika insert items gagal
            mysqli_query($conn, "DELETE FROM orders WHERE id = $order_id");
            header("Location: ../pages/checkout.php?error=Gagal memproses pesanan");
            exit();
        }
    } else {
        header("Location: ../pages/checkout.php?error=Gagal membuat pesanan");
        exit();
    }
} else {
    header("Location: ../pages/checkout.php");
    exit();
}
?>
