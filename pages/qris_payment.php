<?php
session_start();
if (!isset($_SESSION['last_order_id'])) {
    header("Location: checkout.php");
    exit();
}
$order_id = $_SESSION['last_order_id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran QRIS - Bloomy Floral</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        .navbar a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .navbar a:hover {
            color: #e75480;
        }
        .logo {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            color: #e75480;
            margin-bottom: 1rem;
        }
        .container {
            max-width: 500px;
            margin: 3rem auto 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            text-align: center;
        }
        .qris-img {
            width: 260px;
            height: 260px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            border: 2px solid #e1e1e1;
            background: #fafafa;
            box-shadow: 0 1px 6px rgba(231,84,128,0.08);
        }
        .desc {
            color: #666;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .btn {
            width: 100%;
            padding: 1rem;
            background: #e75480;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-top: 1rem;
            box-shadow: 0 2px 8px rgba(231,84,128,0.08);
        }
        .btn:hover {
            background: #d13b6b;
            transform: translateY(-2px) scale(1.03);
        }
        .footer {
            text-align: center;
            padding: 2rem;
            color: #666;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Bloomy Floral</div>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="products.php">Produk</a></li>
            <li><a href="cart.php">Keranjang</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="../process/logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2 style="color:#e75480; margin-bottom:0.5rem;">Pembayaran QRIS</h2>
        <div class="desc">
            Silakan scan barcode QRIS di bawah ini menggunakan aplikasi pembayaran favorit Anda.<br>
            Setelah melakukan pembayaran, klik tombol <b>Sudah Membayar</b> untuk melanjutkan.
        </div>
        <img src="../assets/images/qris-barcode.png" alt="QRIS" class="qris-img">
        <form action="../process/payment_success.php" method="POST">
    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
    <button type="submit" class="btn">Sudah Membayar</button>
</form>
    </div>
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html>