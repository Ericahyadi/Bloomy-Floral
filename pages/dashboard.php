<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    <title>Dashboard - Bloomy Floral</title>
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
        
        .welcome-section {
            background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .welcome-section h1 {
            color: #e75480;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .welcome-section p {
            color: #666;
            font-size: 1.1rem;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .dashboard-card {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .dashboard-card h3 {
            color: #e75480;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .order-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .order-info {
            flex: 1;
        }
        
        .order-info strong {
            display: block;
            margin-bottom: 0.3rem;
        }
        
        .order-info small {
            color: #666;
        }
        
        .status {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cce5ff; color: #004085; }
        .status.shipped { background: #d4edda; color: #155724; }
        .status.delivered { background: #d1ecf1; color: #0c5460; }
        
        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #e75480;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.9rem;
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
        
        .profile-info {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .profile-info p {
            margin-bottom: 0.5rem;
        }
        
        .profile-info strong {
            color: #e75480;
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
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="../process/logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="welcome-section">
            <h1>Selamat Datang, <?php echo htmlspecialchars($user['nama']); ?>!</h1>
            <p>Kelola pesanan dan profil Anda di sini</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Informasi Profil</h3>
                <div class="profile-info">
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($user['nama']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Member sejak:</strong> <?php echo date('d M Y', strtotime($user['created_at'])); ?></p>
                </div>
                <a href="profile.php" class="btn">Edit Profil</a>
            </div>

            <div class="dashboard-card">
                <h3>Pesanan Terbaru</h3>
                <?php
                $sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY tanggal DESC LIMIT 5";
                $result = mysqli_query($conn, $sql);
                
                if($result && mysqli_num_rows($result) > 0):
                    while($order = mysqli_fetch_assoc($result)):
                ?>
                    <div class="order-item">
                        <div class="order-info">
                            <strong>Order #<?php echo $order['id']; ?></strong>
                            <small><?php echo date('d M Y', strtotime($order['tanggal'])); ?></small>
                        </div>
                        <div>
                            <span class="status <?php echo strtolower($order['status']); ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </div>
                        <div>
                            <strong>Rp<?php echo number_format($order['total'],0,',','.'); ?></strong>
                        </div>
                        <div>
                            <a href="order_detail.php?id=<?php echo $order['id']; ?>" class="btn">Detail</a>
                        </div>
                    </div>
                <?php 
                    endwhile;
                else:
                ?>
                    <p>Belum ada pesanan.</p>
                <?php endif; ?>
                
                <div style="margin-top: 1rem;">
                    <a href="orders.php" class="btn btn-secondary">Lihat Semua Pesanan</a>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <h3>Aksi Cepat</h3>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="products.php" class="btn">Belanja Produk</a>
                <a href="cart.php" class="btn">Lihat Keranjang</a>
                <a href="orders.php" class="btn btn-secondary">Riwayat Pesanan</a>
                <?php if($_SESSION['user_email'] === 'admin@bloomy.com'): ?>
                    <a href="admin_add_user.php" class="btn btn-secondary">Tambah User</a>
                <?php endif; ?>
                <a href="../process/logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html>
