<?php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'media_center_booking';
$sql = "SELECT * FROM bookings";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch booking data
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// Close connection
$conn->close();

// Output data as JSON
echo json_encode($bookings);
?>
