<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloomy Floral</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    /* Fallback styles jika CSS tidak load */
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    .navbar { background: #fff; padding: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .navbar ul { list-style: none; display: flex; gap: 1rem; margin: 0; padding: 0; }
    .navbar a { text-decoration: none; color: #333; }
    .main-container { max-width: 1200px; margin: 2rem auto; padding: 1rem; }
    </style>
</head>
<?php $body_class = isset($page_login) && $page_login ? 'login-page' : ''; ?>
<body class="<?php echo $body_class; ?>">
<?php if (!isset($page_login) || !$page_login): ?>
    <header>
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
    </header>
    <main class="main-container">
<?php endif; ?>

</body>
</html>
