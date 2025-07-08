<?php
include 'config.php'; // Pastikan config.php ada dan benar

header('Content-Type: application/json');

// Mengambil data dari database yang statusnya "Approved"
$sql = "SELECT * FROM bookings WHERE status = 'Approved'";
$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

echo json_encode($bookings);

$conn->close();
?>
