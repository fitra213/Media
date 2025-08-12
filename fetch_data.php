<?php
// Mengatur header agar response berupa JSON
header('Content-Type: application/json');

// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'media_center_booking';

// Membuat koneksi ke database MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika gagal, tampilkan pesan error
    die("Connection failed: " . $conn->connect_error);
}

// Query SQL untuk mengambil semua data booking
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    // Mengambil setiap baris hasil query dan memasukkannya ke array
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// Menutup koneksi database
$conn->close();

// Mengirim data booking dalam format JSON
echo json_encode($bookings);
?>
