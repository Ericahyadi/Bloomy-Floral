<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<?php
if(!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
if(!isset($_GET['id'])) { echo '<div class="error-message"><p>Pesanan tidak ditemukan.</p></div>'; include '../includes/footer.php'; exit; }
$order_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE id=$order_id AND user_id=$user_id";
$result = mysqli_query($conn, $sql);
if(!$order = mysqli_fetch_assoc($result)) { echo '<div class="error-message"><p>Pesanan tidak ditemukan.</p></div>'; include '../includes/footer.php'; exit; }
?>

<div class="order-detail-container">
    <div class="order-detail-header">
        <div class="header-content">
            <h1>Detail Pesanan</h1>
            <p>Order ID: #<?php echo $order['id']; ?></p>
        </div>
        <div class="order-status-badge <?php echo strtolower($order['status']); ?>">
            <?php echo $order['status']; ?>
        </div>
    </div>

    <div class="order-detail-content">
        <div class="order-info-section">
            <div class="info-card">
                <h3>Informasi Pesanan</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Tanggal Pesanan:</span>
                        <span class="info-value"><?php echo date('d M Y H:i', strtotime($order['tanggal'])); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value status-value <?php echo strtolower($order['status']); ?>">
                            <?php echo $order['status']; ?>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Pembayaran:</span>
                        <span class="info-value total-amount">Rp<?php echo number_format($order['total'],0,',','.'); ?></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3>Alamat Pengiriman</h3>
                <div class="address-content">
                    <p><?php echo nl2br(htmlspecialchars($order['alamat_pengiriman'])); ?></p>
                </div>
            </div>
        </div>

        <div class="order-items-section">
            <div class="items-header">
                <h3>Detail Produk</h3>
                <span class="items-count">
                    <?php
                    $count_sql = "SELECT COUNT(*) as total FROM order_items WHERE order_id=$order_id";
                    $count_result = mysqli_query($conn, $count_sql);
                    $count_row = mysqli_fetch_assoc($count_result);
                    echo $count_row['total'] . ' produk';
                    ?>
                </span>
            </div>

            <div class="items-list">
    <?php
                $sql = "SELECT oi.*, p.nama, p.gambar FROM order_items oi 
                        JOIN products p ON oi.product_id=p.id 
                        WHERE oi.order_id=$order_id";
    $result = mysqli_query($conn, $sql);
                
                $total_items = 0;
                while($row = mysqli_fetch_assoc($result)):
        $subtotal = $row['harga'] * $row['quantity'];
                    $total_items += $row['quantity'];
                ?>
                    <div class="item-card">
                        <div class="item-image">
                            <img src="../assets/images/<?php echo htmlspecialchars($row['gambar']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['nama']); ?>">
                        </div>
                        <div class="item-details">
                            <h4><?php echo htmlspecialchars($row['nama']); ?></h4>
                            <div class="item-meta">
                                <span class="item-price">Rp<?php echo number_format($row['harga'],0,',','.'); ?></span>
                                <span class="item-qty">× <?php echo $row['quantity']; ?></span>
                            </div>
                        </div>
                        <div class="item-subtotal">
                            <span class="subtotal-label">Subtotal</span>
                            <span class="subtotal-amount">Rp<?php echo number_format($subtotal,0,',','.'); ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="order-summary">
                <div class="summary-item">
                    <span class="summary-label">Total Item:</span>
                    <span class="summary-value"><?php echo $total_items; ?> item</span>
                </div>
                <div class="summary-item total">
                    <span class="summary-label">Total Pembayaran:</span>
                    <span class="summary-value">Rp<?php echo number_format($order['total'],0,',','.'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="order-actions">
        <a href="orders.php" class="btn-secondary">
            <span class="btn-icon">←</span>
            Kembali ke Pesanan
        </a>
        <a href="products.php" class="btn-primary">
            <span class="btn-icon">🛍️</span>
            Belanja Lagi
        </a>
    </div>
</div>

<style>
.order-detail-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

.order-detail-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
    padding: 2rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(231,84,128,0.1);
}

.header-content h1 {
    color: #e75480;
    font-size: 2.2rem;
    margin: 0 0 0.5rem 0;
    font-weight: 600;
}

.header-content p {
    color: #666;
    margin: 0;
    font-size: 1rem;
}

.order-status-badge {
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.order-status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.order-status-badge.processing {
    background: #cce5ff;
    color: #004085;
}

.order-status-badge.shipped {
    background: #d4edda;
    color: #155724;
}

.order-status-badge.delivered {
    background: #d1ecf1;
    color: #0c5460;
}

.order-status-badge.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.order-detail-content {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.order-info-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-card {
    background: #fff;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border-left: 4px solid #e75480;
}

.info-card h3 {
    color: #333;
    font-size: 1.3rem;
    margin: 0 0 1rem 0;
    font-weight: 600;
}

.info-grid {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.info-value {
    color: #333;
    font-weight: 600;
}

.status-value {
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    text-transform: uppercase;
}

.status-value.pending {
    background: #fff3cd;
    color: #856404;
}

.status-value.processing {
    background: #cce5ff;
    color: #004085;
}

.status-value.shipped {
    background: #d4edda;
    color: #155724;
}

.status-value.delivered {
    background: #d1ecf1;
    color: #0c5460;
}

.status-value.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.total-amount {
    color: #e75480;
    font-size: 1.1rem;
}

.address-content {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 3px solid #e75480;
}

.address-content p {
    margin: 0;
    color: #333;
    line-height: 1.5;
}

.order-items-section {
    background: #fff;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.items-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.items-header h3 {
    color: #333;
    font-size: 1.3rem;
    margin: 0;
    font-weight: 600;
}

.items-count {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.items-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.item-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.item-card:hover {
    background: #f0f0f0;
    transform: translateX(5px);
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details {
    flex: 1;
}

.item-details h4 {
    color: #333;
    font-size: 1.1rem;
    margin: 0 0 0.5rem 0;
    font-weight: 600;
}

.item-meta {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.item-price {
    color: #e75480;
    font-weight: 600;
    font-size: 1rem;
}

.item-qty {
    color: #666;
    font-size: 0.9rem;
    background: #e75480;
    color: #fff;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.item-subtotal {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.subtotal-label {
    color: #666;
    font-size: 0.8rem;
    margin-bottom: 0.2rem;
}

.subtotal-amount {
    color: #e75480;
    font-weight: 700;
    font-size: 1.1rem;
}

.order-summary {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    border-top: 3px solid #e75480;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
}

.summary-item.total {
    border-top: 2px solid #e75480;
    margin-top: 0.5rem;
    padding-top: 1rem;
    font-size: 1.2rem;
    font-weight: 700;
}

.summary-label {
    color: #333;
    font-weight: 600;
}

.summary-value {
    color: #e75480;
    font-weight: 700;
}

.order-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn-secondary, .btn-primary {
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-secondary {
    background: #fff;
    color: #e75480;
    border: 2px solid #e75480;
}

.btn-secondary:hover {
    background: #e75480;
    color: #fff;
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, #e75480 0%, #ff6b9d 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(231,84,128,0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231,84,128,0.4);
}

.btn-icon {
    font-size: 1.1rem;
}

.error-message {
    text-align: center;
    padding: 3rem;
    color: #dc3545;
    background: #f8d7da;
    border-radius: 12px;
    margin: 2rem;
}

@media (max-width: 768px) {
    .order-detail-container {
        padding: 1rem;
    }
    
    .order-detail-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .header-content h1 {
        font-size: 1.8rem;
    }
    
    .order-detail-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .item-card {
        flex-direction: column;
        text-align: center;
        gap: 0.8rem;
    }
    
    .item-subtotal {
        text-align: center;
        align-items: center;
    }
    
    .order-actions {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .order-detail-header {
        padding: 1.5rem;
    }
    
    .header-content h1 {
        font-size: 1.5rem;
    }
    
    .info-card, .order-items-section {
        padding: 1rem;
    }
    
    .item-image {
        width: 60px;
        height: 60px;
    }
}
</style>

<?php include '../includes/footer.php'; ?> 