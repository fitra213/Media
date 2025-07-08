<?php
session_start();

// Ganti username dan password sesuai kebutuhan
$admin_user = 'admin';
$admin_pass = 'admin123';

if ($_POST['username'] !== $admin_user) {
    echo "<script>alert('Username salah!'); window.location.href='admin_login.php';</script>";
    exit();
}

if ($_POST['password'] !== $admin_pass) {
    echo "<script>alert('Password salah!'); window.location.href='admin_login.php';</script>";
    exit();
}

$_SESSION['admin_logged_in'] = true;
header('Location: admin.html');
exit();
?>