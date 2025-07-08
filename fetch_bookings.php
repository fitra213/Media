<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "media_center_bookongs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select approved bookings
$sql = "SELECT user, tanggal, start_time, end_time FROM bookings WHERE status = 'setuju'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["user"] . "</td>
                <td>" . $row["tanggal"] . "</td>
                <td>" . $row["start_time"] . "</td>
                <td>" . $row["end_time"] . "</td>
                <td>" . $row["keterangan"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No bookings approved yet</td></tr>";
}

$conn->close();
?>
