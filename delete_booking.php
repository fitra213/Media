<?php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'media_center_booking';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// SQL query to delete the booking
$sql = "DELETE FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No booking found with given ID']);
    }
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$stmt->close();
$conn->close();
?>