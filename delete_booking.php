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

// Mengambil ID booking dari request POST (format JSON)
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Query SQL untuk menghapus booking berdasarkan ID
$sql = "DELETE FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Mengeksekusi query dan mengirim response ke client
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // Jika data berhasil dihapus
        echo json_encode(['success' => true]);
    } else {
        // Jika tidak ada data dengan ID tersebut
        echo json_encode(['success' => false, 'message' => 'No booking found with given ID']);
    }
} else {
    // Jika query gagal dieksekusi
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Menutup statement dan koneksi database
$stmt->close();
$conn->close();
?>