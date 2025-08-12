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

// Mengambil ID booking dari request GET
$id = $_GET['id'];

// Query SQL untuk mengambil detail booking berdasarkan ID
$sql = "SELECT date, start_time, end_time FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika data ditemukan, kirim detail booking dalam format JSON
    $booking = $result->fetch_assoc();
    echo json_encode($booking);
} else {
    // Jika data tidak ditemukan, kirim pesan error
    echo json_encode(['error' => 'Booking not found']);
}

// Menutup statement dan koneksi database
$stmt->close();
$conn->close();
?>