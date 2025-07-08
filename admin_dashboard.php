<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
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
    <h2>Selamat datang, Admin!</h2>
    <a href="admin_logout.php">Logout</a>
    <!-- Tambahkan fitur admin di sini -->
</body>
</html>