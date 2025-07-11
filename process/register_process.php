<?php
session_start();
include '../includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validasi password
    if($password !== $confirm_password) {
        header("Location: ../pages/register.php?error=Konfirmasi password tidak cocok");
        exit();
    }
    
    // Cek apakah email sudah terdaftar
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        header("Location: ../pages/register.php?error=Email sudah terdaftar");
        exit();
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user baru (tanpa alamat dan telepon)
    $sql = "INSERT INTO users (nama, email, password) 
            VALUES ('$nama', '$email', '$hashed_password')";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: ../pages/login.php?success=Registrasi berhasil! Silakan login");
        exit();
    } else {
        header("Location: ../pages/register.php?error=Gagal mendaftar. Silakan coba lagi");
        exit();
    }
} else {
    header("Location: ../pages/register.php");
    exit();
}
?>
