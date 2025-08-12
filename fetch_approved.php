<?php
// Mengimpor konfigurasi database
include 'config.php'; // Pastikan config.php ada dan benar

// Mengatur header agar response berupa JSON
header('Content-Type: application/json');

// Mengambil data booking dari database yang statusnya "Approved"
$sql = "SELECT * FROM bookings WHERE status = 'Approved'";
$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    // Mengambil setiap baris hasil query dan memasukkannya ke array
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// Mengirim data booking yang sudah disetujui dalam format JSON
echo json_encode($bookings);

// Menutup koneksi database
$conn->close();
?>
