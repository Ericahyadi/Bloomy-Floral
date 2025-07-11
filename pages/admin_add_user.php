<?php
session_start();
include '../includes/db.php';

// Cek apakah user adalah admin (email admin@bloomy.com)
if(!isset($_SESSION['user_id']) || $_SESSION['user_email'] !== 'admin@bloomy.com') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin Bloomy Floral</title>
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
            max-width: 600px;
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
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #e75480;
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
        
        .error {
            background: #ffe6e6;
            color: #d63031;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .success {
            background: #e6ffe6;
            color: #00b894;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .users-list {
            margin-top: 3rem;
        }
        
        .user-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .user-info h4 {
            color: #333;
            margin-bottom: 0.3rem;
        }
        
        .user-info small {
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
        <div class="logo">Bloomy Floral - Admin</div>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="products.php">Produk</a></li>
            <li><a href="admin_add_user.php">Tambah User</a></li>
            <li><a href="../process/logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Tambah User Pembeli</h1>
            <p>Tambahkan user baru sebagai pembeli</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        
        <form action="../process/admin_add_user_process.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn">Tambah User</button>
        </form>
        
        <div class="users-list">
            <h3>Daftar User</h3>
            <?php
            $sql = "SELECT * FROM users ORDER BY created_at DESC";
            $result = mysqli_query($conn, $sql);
            
            if($result && mysqli_num_rows($result) > 0):
                while($user = mysqli_fetch_assoc($result)):
            ?>
                <div class="user-item">
                    <div class="user-info">
                        <h4><?php echo htmlspecialchars($user['nama']); ?></h4>
                        <small><?php echo htmlspecialchars($user['email']); ?> - <?php echo date('d M Y', strtotime($user['created_at'])); ?></small>
                    </div>
                    <div>
                        <a href="admin_edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary">Edit</a>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <p>Tidak ada user tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Bloomy Floral. All rights reserved.</p>
    </footer>
</body>
</html> 