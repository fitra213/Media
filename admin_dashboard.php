<?php
// Memulai sesi PHP
session_start();
// Mengecek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    // Jika belum login, redirect ke halaman login admin
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Pesan selamat datang untuk admin -->
    <h2>Selamat datang, Admin!</h2>
    <!-- Tombol logout untuk keluar dari sesi admin -->
    <a href="admin_logout.php">Logout</a>
    <!-- Tambahkan fitur admin di sini -->
</body>
</html>