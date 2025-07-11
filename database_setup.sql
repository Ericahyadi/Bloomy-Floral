-- Database setup untuk Bloomy Floral
-- Buat database
CREATE DATABASE IF NOT EXISTS bloomy_floral;
USE bloomy_floral;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    harga DECIMAL(10,2) NOT NULL,
    stok INT DEFAULT 0,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    alamat_pengiriman TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabel order_items
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Insert sample data untuk products
INSERT INTO products (nama, deskripsi, harga, stok, gambar) VALUES
('Bouquet Mawar Merah', 'Rangkaian mawar merah segar dengan 12 tangkai, cocok untuk acara romantis', 150000, 20, 'rose.jpeg'),
('Bouquet Lily Putih', 'Rangkaian lily putih elegan dengan 8 tangkai, sempurna untuk acara formal', 180000, 15, 'lily.jpeg'),
('Bouquet Sunflower', 'Rangkaian bunga matahari cerah dengan 10 tangkai, membawa keceriaan', 120000, 25, 'sunflower.jpeg'),
('Bouquet Peony', 'Rangkaian bunga peony yang sangat eksotis dan indah', 200000, 10, 'peony.jpeg'),
('Bouquet Mawar Pink', 'Rangkaian mawar pink lembut dengan 15 tangkai', 175000, 18, 'pinkrose.jpeg'),
('Bouquet Orchid', 'Rangkaian anggrek ungu yang eksotis', 250000, 8, 'orchid.jpeg');

-- Insert sample user (password: 123456)
INSERT INTO users (nama, email, password, alamat, telepon) VALUES
('Admin Bloomy', 'admin@bloomy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jl. Bunga No. 123, Jakarta', '081234567890'),
('Test User', 'test@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jl. Test No. 456, Bandung', '081234567891');

-- Insert sample orders
INSERT INTO orders (user_id, total, status, alamat_pengiriman) VALUES
(1, 150000, 'delivered', 'Jl. Bunga No. 123, Jakarta'),
(1, 300000, 'shipped', 'Jl. Bunga No. 123, Jakarta'),
(2, 200000, 'processing', 'Jl. Test No. 456, Bandung');

-- Insert sample order_items
INSERT INTO order_items (order_id, product_id, quantity, harga) VALUES
(1, 1, 1, 150000),
(2, 2, 1, 180000),
(2, 3, 1, 120000),
(3, 4, 1, 200000);

-- Buat index untuk optimasi query
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_product_name ON products(nama);
CREATE INDEX idx_order_user ON orders(user_id);
CREATE INDEX idx_order_status ON orders(status);
CREATE INDEX idx_order_items_order ON order_items(order_id); 