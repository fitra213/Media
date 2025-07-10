<?php
$servername = "localhost";
$username = "root";         
$password = "";           
$dbname = "media_center_booking";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengatur karakter encoding
$conn->set_charset("utf8mb4");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Jakarta');
?>
