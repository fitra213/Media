<?php
// Memulai sesi PHP
session_start();

// Mendefinisikan username dan password admin (bisa diganti sesuai kebutuhan)
$admin_user = 'admin';
$admin_pass = 'admin123';

// Mengecek apakah username yang dimasukkan sesuai
if ($_POST['username'] !== $admin_user) {
    // Jika salah, tampilkan alert dan kembali ke halaman login
    echo "<script>alert('Username salah!'); window.location.href='admin_login.php';</script>";
    exit();
}

// Mengecek apakah password yang dimasukkan sesuai
if ($_POST['password'] !== $admin_pass) {
    // Jika salah, tampilkan alert dan kembali ke halaman login
    echo "<script>alert('Password salah!'); window.location.href='admin_login.php';</script>";
    exit();
}

// Jika username dan password benar, set session login admin
$_SESSION['admin_logged_in'] = true;
// Redirect ke halaman admin.html
header('Location: admin.html');
exit();
?>