<?php
header('Content-Type: application/json');

// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'media_center_booking';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari request POST
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$status = $data['status'];

// Update status booking di database
if ($stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?")) {
    $stmt->bind_param("si", $status, $id);

    // Eksekusi query update
    if ($stmt->execute()) {
        $success = true;
    } else {
        $success = false;
        $error = $stmt->error;
    }

    $stmt->close();
} else {
    $success = false;
    $error = $conn->error;
}

$conn->close();

// Kirim response dalam format JSON
if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $error]);
}
?>
