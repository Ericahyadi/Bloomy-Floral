<?php
session_start();
include '../includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nama'] = $user['nama'];
            $_SESSION['user_email'] = $user['email'];
            
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            header("Location: ../pages/login.php?error=Password salah");
            exit();
        }
    } else {
        header("Location: ../pages/login.php?error=Email tidak ditemukan");
        exit();
    }
} else {
    header("Location: ../pages/login.php");
    exit();
}
?>
