<?php include '../includes/header.php'; ?>

<div class="about-container">
    <div class="about-hero">
        <div class="hero-content">
            <h1>Tentang Bloomy Floral</h1>
            <p>Membuat momen spesial Anda lebih berkesan dengan rangkaian bunga terindah</p>
        </div>
    </div>

    <div class="about-content">
        <div class="story-section">
            <div class="story-text">
                <h2>Cerita Kami</h2>
                <p>Bloomy Floral didirikan pada tahun 2020 dengan visi untuk menghadirkan rangkaian bunga terindah untuk setiap momen spesial dalam hidup Anda. Kami percaya bahwa bunga memiliki kekuatan untuk menyampaikan emosi dan membuat momen menjadi lebih berkesan.</p>
                <p>Dengan tim florist profesional yang berpengalaman, kami berkomitmen untuk memberikan kualitas terbaik dalam setiap rangkaian bunga yang kami buat. Setiap bunga dipilih dengan teliti untuk memastikan kesegaran dan keindahannya.</p>
            </div>
            <div class="story-image">
                <div class="image-placeholder">
                    <span class="flower-icon">🌸</span>
                    <p>Bloomy Floral Studio</p>
                </div>
            </div>
        </div>

        <div class="values-section">
            <h2>Nilai-Nilai Kami</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">🌱</div>
                    <h3>Kualitas Terbaik</h3>
                    <p>Kami hanya menggunakan bunga segar berkualitas tinggi yang dipetik langsung dari kebun terpercaya.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🎨</div>
                    <h3>Design Kreatif</h3>
                    <p>Setiap rangkaian dibuat dengan kreativitas dan keahlian oleh florist profesional kami.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💝</div>
                    <h3>Pelayanan Prima</h3>
                    <p>Kami berkomitmen memberikan pelayanan terbaik dan pengalaman berbelanja yang menyenangkan.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🚚</div>
                    <h3>Pengiriman Cepat</h3>
                    <p>Same day delivery untuk area tertentu dan pengiriman yang aman untuk menjaga kesegaran bunga.</p>
                </div>
            </div>
        </div>

        <div class="team-section">
            <h2>Tim Kami</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-avatar">
                        <span class="avatar-icon">👩‍🎨</span>
                    </div>
                    <h3>Sarah Johnson</h3>
                    <p class="member-role">Head Florist</p>
                    <p class="member-desc">Berpengalaman 8 tahun dalam industri florist dengan spesialisasi rangkaian wedding dan event.</p>
                </div>
                <div class="team-member">
                    <div class="member-avatar">
                        <span class="avatar-icon">👨‍🌾</span>
                    </div>
                    <h3>Michael Chen</h3>
                    <p class="member-role">Garden Manager</p>
                    <p class="member-desc">Bertanggung jawab atas pemilihan dan pengelolaan kualitas bunga dari kebun kami.</p>
                </div>
                <div class="team-member">
                    <div class="member-avatar">
                        <span class="avatar-icon">👩‍💼</span>
                    </div>
                    <h3>Diana Putri</h3>
                    <p class="member-role">Customer Service</p>
                    <p class="member-desc">Siap membantu Anda dengan pelayanan terbaik dan saran rangkaian yang tepat.</p>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <h2>Hubungi Kami</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <div class="contact-details">
                            <h4>Alamat</h4>
                            <p>Jl. Bunga Indah No. 123<br>Jakarta Selatan, 12345</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <div class="contact-details">
                            <h4>Telepon</h4>
                            <p>+62 812-3456-7890<br>+62 21-1234-5678</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">✉️</span>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p>info@bloomy.com<br>order@bloomy.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">🕒</span>
                        <div class="contact-details">
                            <h4>Jam Operasional</h4>
                            <p>Senin - Sabtu: 08:00 - 20:00<br>Minggu: 09:00 - 18:00</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Kirim Pesan</h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.about-hero {
    background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
    padding: 4rem 2rem;
    border-radius: 20px;
    margin-bottom: 3rem;
    text-align: center;
    box-shadow: 0 8px 30px rgba(231,84,128,0.15);
}

.about-hero h1 {
    color: #e75480;
    font-size: 3rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.about-hero p {
    color: #666;
    font-size: 1.2rem;
    margin: 0;
}

.about-content {
    display: flex;
    flex-direction: column;
    gap: 4rem;
}

.story-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.story-text h2 {
    color: #e75480;
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.story-text p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.story-image {
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-placeholder {
    background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
    width: 300px;
    height: 300px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 8px 25px rgba(231,84,128,0.15);
}

.flower-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.image-placeholder p {
    color: #e75480;
    font-weight: 600;
    font-size: 1.1rem;
    margin: 0;
}

.values-section {
    text-align: center;
}

.values-section h2 {
    color: #e75480;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    font-weight: 600;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.value-card {
    background: #fff;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-top: 4px solid #e75480;
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(231,84,128,0.15);
}

.value-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

.value-card h3 {
    color: #333;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.value-card p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.team-section {
    text-align: center;
}

.team-section h2 {
    color: #e75480;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    font-weight: 600;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.team-member {
    background: #fff;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.team-member:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(231,84,128,0.15);
}

.member-avatar {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #fce4ec 0%, #fff3e0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 4px 15px rgba(231,84,128,0.2);
}

.avatar-icon {
    font-size: 3rem;
}

.team-member h3 {
    color: #333;
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.member-role {
    color: #e75480;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.member-desc {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.contact-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    padding: 3rem;
    border-radius: 20px;
}

.contact-section h2 {
    color: #e75480;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-align: center;
    font-weight: 600;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.contact-icon {
    font-size: 2rem;
    margin-top: 0.5rem;
}

.contact-details h4 {
    color: #333;
    font-size: 1.2rem;
    margin: 0 0 0.5rem 0;
    font-weight: 600;
}

.contact-details p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.contact-form {
    background: #fff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.contact-form h3 {
    color: #e75480;
    font-size: 1.5rem;
    margin-bottom: 2rem;
    font-weight: 600;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    color: #333;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.8rem;
    border: 2px solid #f0f0f0;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #e75480;
}

.btn-submit {
    background: linear-gradient(135deg, #e75480 0%, #ff6b9d 100%);
    color: #fff;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    box-shadow: 0 4px 15px rgba(231,84,128,0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231,84,128,0.4);
}

@media (max-width: 768px) {
    .about-container {
        padding: 1rem;
    }
    
    .about-hero h1 {
        font-size: 2.5rem;
    }
    
    .story-section {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .values-grid,
    .team-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .about-hero {
        padding: 2rem 1rem;
    }
    
    .about-hero h1 {
        font-size: 2rem;
    }
    
    .contact-section {
        padding: 2rem 1rem;
    }
    
    .image-placeholder {
        width: 250px;
        height: 250px;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
