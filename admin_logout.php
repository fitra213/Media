<?php
// Memulai sesi PHP
session_start();
// Menghancurkan semua data sesi (logout)
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Tombol untuk kembali ke halaman login admin setelah logout -->
    <button class="btn log-in" onclick="window.location.href='admin_login.php'">Masuk</button>
</body>
</html>