<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bloomy_floral';

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
