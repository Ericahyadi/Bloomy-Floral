<?php
session_start();
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloomy Floral</title>
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
        
        .hero {
            text-align: center;
            padding: 3rem;
            background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
            border-radius: 15px;
            margin-bottom: 2rem;
        }
        
        .hero h1 {
            color: #e75480;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .hero p {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: #e75480;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 0.5rem;
        }
        
        .btn:hover {
            background: #d13b6b;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .product-card {
            background: #fff;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .product-card h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .product-card .price {
            color: #e75480;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .reviews-section {
            margin-top: 3rem;
        }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .review-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 15px;
            border-left: 4px solid #e75480;
        }
        
        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .review-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e75480;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            margin-right: 1rem;
        }
        
        .review-info h4 {
            color: #333;
            margin-bottom: 0.3rem;
        }
        
        .review-date {
            color: #666;
            font-size: 0.9rem;
        }
        
        .review-stars {
            color: #ffd700;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .review-text {
            color: #555;
            line-height: 1.6;
            font-style: italic;
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
            <li><a href="index.php">Home</a></li>
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
        <div class="hero">
            <h1>Bloomy Floral</h1>
            <p>Membuat momen spesial Anda lebih berkesan dengan rangkaian bunga terindah</p>
            <a href="products.php" class="btn">Lihat Produk</a>
            <a href="about.php" class="btn">Tentang Kami</a>
        </div>

        <h2>Produk Unggulan</h2>
        <div class="products-grid">
            <?php
            $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);
            
            if($result && mysqli_num_rows($result) > 0):
                while($row = mysqli_fetch_assoc($result)):
            ?>
                <div class="product-card">
                    <img src="../assets/images/<?php echo htmlspecialchars($row['gambar']); ?>" 
                         alt="<?php echo htmlspecialchars($row['nama']); ?>">
                    <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                    <div class="price">Rp<?php echo number_format($row['harga'],0,',','.'); ?></div>
                    <a href="pages/product_detail.php?id=<?php echo $row['id']; ?>" class="btn">Detail</a>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <p>Tidak ada produk tersedia.</p>
            <?php endif; ?>
        </div>

        <div class="reviews-section">
            <h2>Review Customer</h2>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">S</div>
                        <div class="review-info">
                            <h4>Sarah Amanda</h4>
                            <div class="review-date">2 hari yang lalu</div>
                        </div>
                    </div>
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">
                        "Bouquet mawar merahnya sangat cantik! Bunganya segar dan tahan lama. 
                        Pengiriman cepat dan pelayanan ramah. Sangat puas dengan pembelian ini!"
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">M</div>
                        <div class="review-info">
                            <h4>Michael Chen</h4>
                            <div class="review-date">1 minggu yang lalu</div>
                        </div>
                    </div>
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">
                        "Pesan untuk anniversary istri. Bouquet lily putihnya elegan sekali! 
                        Istri sangat suka dan terharu. Terima kasih Bloomy Floral!"
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">D</div>
                        <div class="review-info">
                            <h4>Diana Putri</h4>
                            <div class="review-date">3 hari yang lalu</div>
                        </div>
                    </div>
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">
                        "Bouquet sunflower yang cerah! Cocok untuk hadiah ulang tahun teman. 
                        Harganya terjangkau tapi kualitasnya premium. Recommended!"
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">R</div>
                        <div class="review-info">
                            <h4>Rizki Pratama</h4>
                            <div class="review-date">5 hari yang lalu</div>
                        </div>
                    </div>
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">
                        "Bouquet campuran untuk acara kantor. Semua kolega suka! 
                        Warna-warnanya harmonis dan tahan lama. Akan pesan lagi nanti."
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">A</div>
                        <div class="review-info">
                            <h4>Anisa Sari</h4>
                            <div class="review-date">1 minggu yang lalu</div>
                        </div>
                    </div>
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">
                        "Bouquet mawar pink untuk valentine. Romantis sekali! 
                        Pacar sangat terharu. Pengiriman tepat waktu dan bunga masih segar."
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">B</div>
                        <div class="review-info">
                            <h4>Budi Santoso</h4>
                            <div class="review-date">2 minggu yang lalu</div>
                        </div>
                    </div>
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">
                        "Bouquet orchid untuk ibu. Sangat eksotis dan elegan! 
                        Ibu sangat suka dan bangga. Kualitas bunga sangat bagus."
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html> 