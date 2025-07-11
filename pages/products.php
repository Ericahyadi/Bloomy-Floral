<?php
session_start();
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Bloomy Floral</title>
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
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .page-header h1 {
            color: #e75480;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .page-header p {
            color: #666;
            font-size: 1.1rem;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        
        .product-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            height: 250px;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info {
            padding: 1.5rem;
        }
        
        .product-info h3 {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .product-price {
            color: #e75480;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .product-stock {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .product-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            flex: 1;
            text-align: center;
        }
        
        .btn-primary {
            background: #e75480;
            color: #fff;
        }
        
        .btn-primary:hover {
            background: #d13b6b;
        }
        
        .btn-secondary {
            background: #fff;
            color: #e75480;
            border: 2px solid #e75480;
        }
        
        .btn-secondary:hover {
            background: #e75480;
            color: #fff;
        }
        
        .no-products {
            text-align: center;
            padding: 3rem;
            color: #666;
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
            <li><a href="..//pages/index.php">Home</a></li>
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
            <h1>Katalog Produk Bunga</h1>
            <p>Temukan rangkaian bunga terindah untuk momen spesial Anda</p>
        </div>

        <div class="products-grid">
            <?php
            $sql = "SELECT * FROM products ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            
            if($result && mysqli_num_rows($result) > 0):
                while($row = mysqli_fetch_assoc($result)):
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="../assets/images/<?php echo htmlspecialchars($row['gambar']); ?>" 
                             alt="<?php echo htmlspecialchars($row['nama']); ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                        <div class="product-price">Rp<?php echo number_format($row['harga'],0,',','.'); ?></div>
                        <div class="product-stock">Stok: <?php echo $row['stok']; ?> tersedia</div>
                        <div class="product-actions">
                            <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Detail</a>
                            <form action="../process/add_to_cart.php" method="POST" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-secondary">+ Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="no-products">
                    <p>Tidak ada produk tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html>
