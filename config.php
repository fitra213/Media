<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";         
$password = "";            
$dbname = "media_center_booking";

// Membuat koneksi ke database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengatur karakter encoding agar mendukung karakter khusus/UTF-8
$conn->set_charset("utf8mb4");

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika gagal, tampilkan pesan error
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengatur zona waktu ke Asia/Jakarta (opsional)
date_default_timezone_set('Asia/Jakarta');
?>
