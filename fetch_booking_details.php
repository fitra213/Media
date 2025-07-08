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

// Get the ID from the GET request
$id = $_GET['id'];

// SQL query to fetch booking details by ID
$sql = "SELECT date, start_time, end_time FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();
    echo json_encode($booking);
} else {
    echo json_encode(['error' => 'Booking not found']);
}

$stmt->close();
$conn->close();
?>