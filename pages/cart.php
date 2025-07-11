<?php
session_start();
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Bloomy Floral</title>
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
            max-width: 1000px;
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
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            margin-bottom: 1rem;
            background: #fff;
        }
        
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 1.5rem;
        }
        
        .cart-item-info {
            flex: 1;
        }
        
        .cart-item-info h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .cart-item-price {
            color: #e75480;
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .quantity-btn {
            padding: 0.5rem 1rem;
            background: #e75480;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .quantity-btn:hover {
            background: #d13b6b;
        }
        
        .quantity-input {
            width: 60px;
            padding: 0.5rem;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .cart-item-total {
            font-weight: bold;
            font-size: 1.2rem;
            color: #e75480;
        }
        
        .remove-btn {
            padding: 0.5rem 1rem;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .remove-btn:hover {
            background: #c82333;
        }
        
        .cart-summary {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }
        
        .cart-summary h3 {
            color: #333;
            margin-bottom: 1rem;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .summary-total {
            font-size: 1.3rem;
            font-weight: bold;
            color: #e75480;
            border-top: 2px solid #e75480;
            padding-top: 1rem;
            margin-top: 1rem;
        }
        
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: #e75480;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn:hover {
            background: #d13b6b;
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        
        .empty-cart h3 {
            margin-bottom: 1rem;
            color: #333;
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
            <li><a href="../pages/index.php">Home</a></li>
            <li><a href="products.php">Produk</a></li>
            <li><a href="cart.php">Keranjang</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="../process/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Keranjang Belanja</h1>
        </div>

        <?php
        $cart_items = array();
        $total = 0;
        
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
            foreach($_SESSION['cart'] as $product_id => $quantity):
                $sql = "SELECT * FROM products WHERE id = $product_id";
                $result = mysqli_query($conn, $sql);
                if($result && mysqli_num_rows($result) > 0):
                    $product = mysqli_fetch_assoc($result);
                    $subtotal = $product['harga'] * $quantity;
                    $total += $subtotal;
        ?>
                <div class="cart-item">
                    <img src="../assets/images/<?php echo htmlspecialchars($product['gambar']); ?>" 
                         alt="<?php echo htmlspecialchars($product['nama']); ?>">
                    
                    <div class="cart-item-info">
                        <h3><?php echo htmlspecialchars($product['nama']); ?></h3>
                        <div class="cart-item-price">Rp<?php echo number_format($product['harga'],0,',','.'); ?></div>
                        
                        <div class="cart-item-quantity">
                            <form action="../process/remove_from_cart.php" method="POST" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" class="quantity-btn">-</button>
                            </form>
                            
                            <span class="quantity-input"><?php echo $quantity; ?></span>
                            
                            <form action="../process/add_to_cart.php" method="POST" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" class="quantity-btn">+</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="cart-item-total">
                        Rp<?php echo number_format($subtotal,0,',','.'); ?>
                    </div>
                    
                    <form action="../process/remove_from_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <button type="submit" class="remove-btn">Hapus</button>
                    </form>
                </div>
        <?php 
                endif;
            endforeach;
        ?>
        
        <div class="cart-summary">
            <h3>Ringkasan Belanja</h3>
            <div class="summary-row">
                <span>Total Item:</span>
                <span><?php echo array_sum($_SESSION['cart']); ?></span>
            </div>
            <div class="summary-row">
                <span>Total Harga:</span>
                <span>Rp<?php echo number_format($total,0,',','.'); ?></span>
            </div>
            <div class="summary-total">
                <span>Total Pembayaran:</span>
                <span>Rp<?php echo number_format($total,0,',','.'); ?></span>
            </div>
            
            <div style="margin-top: 2rem; text-align: center;">
                <a href="products.php" class="btn btn-secondary">Lanjut Belanja</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="checkout.php" class="btn">Checkout</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Login untuk Checkout</a>
                <?php endif; ?>
            </div>
        </div>
        
        <?php else: ?>
        <div class="empty-cart">
            <h3>Keranjang Belanja Kosong</h3>
            <p>Belum ada produk di keranjang belanja Anda.</p>
            <a href="products.php" class="btn">Mulai Belanja</a>
        </div>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html>
