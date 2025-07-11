<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<?php if(!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<div class="orders-container">
    <div class="orders-header">
        <h1>Riwayat Pesanan</h1>
        <p>Lihat semua pesanan yang telah Anda buat</p>
    </div>

    <div class="orders-content">
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM orders WHERE user_id=$user_id ORDER BY tanggal DESC";
    $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0):
        ?>
            <div class="orders-grid">
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">
                                <span class="order-label">Order ID:</span>
                                <span class="order-number">#<?php echo $row['id']; ?></span>
                            </div>
                            <div class="order-status <?php echo strtolower($row['status']); ?>">
                                <?php echo $row['status']; ?>
                            </div>
                        </div>
                        
                        <div class="order-details">
                            <div class="order-info">
                                <div class="info-item">
                                    <span class="info-label">Tanggal:</span>
                                    <span class="info-value"><?php echo date('d M Y H:i', strtotime($row['tanggal'])); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Total:</span>
                                    <span class="info-value total-price">Rp<?php echo number_format($row['total'],0,',','.'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Alamat:</span>
                                    <span class="info-value address"><?php echo htmlspecialchars($row['alamat_pengiriman']); ?></span>
                                </div>
                            </div>
                            
                            <div class="order-actions">
                                <a href="order_detail.php?id=<?php echo $row['id']; ?>" class="btn-view-detail">
                                    <span class="btn-icon">👁️</span>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-orders">
                <div class="no-orders-icon">📦</div>
                <h3>Belum Ada Pesanan</h3>
                <p>Anda belum memiliki riwayat pesanan. Mulai berbelanja sekarang!</p>
                <a href="products.php" class="btn-shop-now">Mulai Belanja</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.orders-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

.orders-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem;
    background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(231,84,128,0.1);
}

.orders-header h1 {
    color: #e75480;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.orders-header p {
    color: #666;
    font-size: 1.1rem;
    margin: 0;
}

.orders-content {
    margin-top: 2rem;
}

.orders-grid {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.order-card {
    background: #fff;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-left: 4px solid #e75480;
}

.order-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(231,84,128,0.15);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f0f0f0;
}

.order-id {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.order-label {
    color: #666;
    font-size: 0.9rem;
}

.order-number {
    color: #e75480;
    font-weight: 700;
    font-size: 1.1rem;
}

.order-status {
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
}

.order-status.pending {
    background: #fff3cd;
    color: #856404;
}

.order-status.processing {
    background: #cce5ff;
    color: #004085;
}

.order-status.shipped {
    background: #d4edda;
    color: #155724;
}

.order-status.delivered {
    background: #d1ecf1;
    color: #0c5460;
}

.order-status.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.order-details {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}

.order-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.info-label {
    color: #666;
    font-size: 0.9rem;
    min-width: 80px;
}

.info-value {
    color: #333;
    font-weight: 500;
}

.total-price {
    color: #e75480;
    font-weight: 700;
    font-size: 1.1rem;
}

.address {
    max-width: 300px;
    word-wrap: break-word;
}

.order-actions {
    display: flex;
    align-items: center;
}

.btn-view-detail {
    background: linear-gradient(135deg, #e75480 0%, #ff6b9d 100%);
    color: #fff;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 10px rgba(231,84,128,0.3);
}

.btn-view-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231,84,128,0.4);
}

.btn-icon {
    font-size: 1rem;
}

.no-orders {
    text-align: center;
    padding: 4rem 2rem;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.no-orders-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.no-orders h3 {
    color: #333;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.no-orders p {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1rem;
}

.btn-shop-now {
    background: linear-gradient(135deg, #e75480 0%, #ff6b9d 100%);
    color: #fff;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(231,84,128,0.3);
}

.btn-shop-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231,84,128,0.4);
}

@media (max-width: 768px) {
    .orders-container {
        padding: 1rem;
    }
    
    .orders-header h1 {
        font-size: 2rem;
    }
    
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .order-details {
        flex-direction: column;
        gap: 1rem;
    }
    
    .order-actions {
        width: 100%;
    }
    
    .btn-view-detail {
        width: 100%;
        justify-content: center;
    }
    
    .address {
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    .order-card {
        padding: 1rem;
    }
    
    .orders-header {
        padding: 1.5rem;
    }
    
    .orders-header h1 {
        font-size: 1.8rem;
    }
}
</style>

<?php include '../includes/footer.php'; ?> 