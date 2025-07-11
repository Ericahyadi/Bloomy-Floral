<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if(!isset($_GET['id'])) { 
    echo '<div class="error-message"><p>Produk tidak ditemukan.</p></div>'; 
    include '../includes/footer.php'; 
    exit; 
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM products WHERE id=$id";
$result = mysqli_query($conn, $sql);

if(!$row = mysqli_fetch_assoc($result)) { 
    echo '<div class="error-message"><p>Produk tidak ditemukan.</p></div>'; 
    include '../includes/footer.php'; 
    exit; 
}
?>

<div class="product-detail-container">
    <div class="product-detail-content">
        <div class="product-image-section">
            <div class="product-image-wrapper">
                <img src="../assets/images/<?php echo htmlspecialchars($row['gambar']); ?>" 
                     alt="<?php echo htmlspecialchars($row['nama']); ?>" 
                     class="product-detail-image">
            </div>
        </div>
        
        <div class="product-info-section">
            <div class="product-header">
                <h1><?php echo htmlspecialchars($row['nama']); ?></h1>
                <div class="product-price-large">
                    Rp<?php echo number_format($row['harga'],0,',','.'); ?>
                </div>
            </div>
            
            <div class="product-description">
                <h3>Deskripsi Produk</h3>
                <p><?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?></p>
            </div>
            
            <div class="product-meta">
                <div class="meta-item">
                    <span class="meta-label">Stok Tersedia:</span>
                    <span class="meta-value <?php echo $row['stok'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                        <?php echo $row['stok']; ?> unit
                    </span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label">Status:</span>
                    <span class="meta-value <?php echo $row['stok'] > 0 ? 'available' : 'unavailable'; ?>">
                        <?php echo $row['stok'] > 0 ? 'Tersedia' : 'Habis'; ?>
                    </span>
                </div>
            </div>
            
            <?php if($row['stok'] > 0): ?>
            <div class="product-actions">
                <form action="../process/add_to_cart.php" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    
                    <div class="quantity-selector">
                        <label for="qty">Jumlah:</label>
                        <div class="quantity-controls">
                            <button type="button" class="qty-btn" onclick="changeQty(-1)">-</button>
                            <input type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $row['stok']; ?>" required>
                            <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-add-to-cart">
                        <span class="btn-icon">🛒</span>
                        Tambah ke Keranjang
                    </button>
                </form>
                
                <div class="action-buttons">
                    <a href="products.php" class="btn-secondary">← Kembali ke Produk</a>
                    <a href="cart.php" class="btn-view-cart">Lihat Keranjang</a>
                </div>
            </div>
            <?php else: ?>
            <div class="out-of-stock-message">
                <p>Maaf, produk ini sedang tidak tersedia.</p>
                <a href="products.php" class="btn-secondary">Lihat Produk Lain</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.product-detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.product-detail-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    background: #fff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.product-image-section {
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image-wrapper {
    width: 100%;
    max-width: 400px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.product-detail-image {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.product-detail-image:hover {
    transform: scale(1.02);
}

.product-info-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.product-header h1 {
    color: #333;
    font-size: 2.2rem;
    margin: 0 0 1rem 0;
    font-weight: 600;
    line-height: 1.2;
}

.product-price-large {
    color: #e75480;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.product-description h3 {
    color: #333;
    font-size: 1.3rem;
    margin: 0 0 0.8rem 0;
    font-weight: 600;
}

.product-description p {
    color: #666;
    line-height: 1.6;
    margin: 0;
    font-size: 1rem;
}

.product-meta {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 4px solid #e75480;
}

.meta-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.meta-label {
    font-weight: 600;
    color: #333;
}

.meta-value {
    font-weight: 600;
}

.in-stock, .available {
    color: #28a745;
}

.out-of-stock, .unavailable {
    color: #dc3545;
}

.product-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.add-to-cart-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.quantity-selector {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.quantity-selector label {
    font-weight: 600;
    color: #333;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    max-width: 150px;
}

.qty-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #e75480;
    background: #fff;
    color: #e75480;
    border-radius: 8px;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.qty-btn:hover {
    background: #e75480;
    color: #fff;
}

.quantity-controls input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 2px solid #e75480;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
}

.btn-add-to-cart {
    background: linear-gradient(135deg, #e75480 0%, #ff6b9d 100%);
    color: #fff;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(231,84,128,0.3);
}

.btn-add-to-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231,84,128,0.4);
}

.btn-icon {
    font-size: 1.2rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn-secondary, .btn-view-cart {
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-align: center;
    flex: 1;
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

.btn-view-cart {
    background: #e75480;
    color: #fff;
}

.btn-view-cart:hover {
    background: #d13b6b;
    transform: translateY(-2px);
}

.out-of-stock-message {
    text-align: center;
    padding: 2rem;
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 12px;
    color: #856404;
}

.out-of-stock-message p {
    margin: 0 0 1rem 0;
    font-size: 1.1rem;
    font-weight: 600;
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
    .product-detail-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 1.5rem;
    }
    
    .product-header h1 {
        font-size: 1.8rem;
    }
    
    .product-price-large {
        font-size: 1.6rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .product-detail-container {
        padding: 1rem;
    }
    
    .product-detail-content {
        padding: 1rem;
    }
    
    .product-header h1 {
        font-size: 1.5rem;
    }
    
    .product-price-large {
        font-size: 1.4rem;
    }
}
</style>

<script>
function changeQty(change) {
    const qtyInput = document.getElementById('qty');
    const currentValue = parseInt(qtyInput.value);
    const maxValue = parseInt(qtyInput.max);
    const newValue = currentValue + change;
    
    if (newValue >= 1 && newValue <= maxValue) {
        qtyInput.value = newValue;
    }
}
</script>

<?php include '../includes/footer.php'; ?> 