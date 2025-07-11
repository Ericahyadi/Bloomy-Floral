<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Bloomy Floral</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f8f8fa;
            color: #333;
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
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            color: #e75480;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .form-section {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }
        
        .form-section h3 {
            color: #e75480;
            margin-bottom: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: bold;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #e75480;
        }
        
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        
        .order-summary {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }
        
        .order-summary h3 {
            color: #e75480;
            margin-bottom: 1rem;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e1e1e1;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 1rem;
        }
        
        .order-item-info {
            flex: 1;
        }
        
        .order-item-info h4 {
            color: #333;
            margin-bottom: 0.3rem;
        }
        
        .order-item-info small {
            color: #666;
        }
        
        .order-item-price {
            color: #e75480;
            font-weight: bold;
        }
        
        .order-total {
            background: #e75480;
            color: #fff;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            background: #e75480;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 1rem;
        }
        
        .btn:hover {
            background: #d13b6b;
        }
        
        .btn-secondary {
            background: #6c757d;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .error {
            background: #ffe6e6;
            color: #d63031;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .footer {
            text-align: center;
            padding: 2rem;
            color: #666;
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
        <div class="page-header">
            <h1>Checkout</h1>
            <p>Lengkapi informasi pengiriman untuk menyelesaikan pesanan</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        
        <form action="../process/checkout_process.php" method="POST">
            <div class="checkout-grid">
                <div class="form-section">
                    <h3>Informasi Pengiriman</h3>
                    
                    <div class="form-group">
                        <label for="nama_penerima">Nama Penerima</label>
                        <input type="text" id="nama_penerima" name="nama_penerima" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat_pengiriman">Alamat Pengiriman</label>
                        <textarea id="alamat_pengiriman" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap pengiriman" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" id="telepon" name="telepon" placeholder="081234567890" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea id="catatan" name="catatan" placeholder="Catatan tambahan untuk pesanan"></textarea>
                    </div>
                </div>
                
                <div class="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    
                    <?php
                    $total = 0;
                    foreach($_SESSION['cart'] as $product_id => $quantity):
                        $sql = "SELECT * FROM products WHERE id = $product_id";
                        $result = mysqli_query($conn, $sql);
                        if($result && mysqli_num_rows($result) > 0):
                            $product = mysqli_fetch_assoc($result);
                            $subtotal = $product['harga'] * $quantity;
                            $total += $subtotal;
                    ?>
                        <div class="order-item">
                            <img src="../assets/images/<?php echo htmlspecialchars($product['gambar']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['nama']); ?>">
                            <div class="order-item-info">
                                <h4><?php echo htmlspecialchars($product['nama']); ?></h4>
                                <small>Qty: <?php echo $quantity; ?></small>
                            </div>
                            <div class="order-item-price">
                                Rp<?php echo number_format($subtotal,0,',','.'); ?>
                            </div>
                        </div>
                    <?php 
                        endif;
                    endforeach;
                    ?>
                    
                    <div class="order-total">
                        Total: Rp<?php echo number_format($total,0,',','.'); ?>
                    </div>
                    
                    <button type="submit" class="btn">Konfirmasi Pesanan</button>
                    
                    <a href="cart.php" class="btn btn-secondary">Kembali ke Keranjang</a>
                </div>
            </div>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html>
