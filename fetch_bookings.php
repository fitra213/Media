<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "media_center_bookings";

// Membuat koneksi ke database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika gagal, tampilkan pesan error
    die("Connection failed: " . $conn->connect_error);
}

// Query SQL untuk mengambil data booking yang sudah disetujui
$sql = "SELECT user, tanggal, start_time, end_time FROM bookings WHERE status = 'setuju'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika ada data, tampilkan setiap baris dalam bentuk tabel HTML
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
    // Jika tidak ada data booking yang disetujui
    echo "<tr><td colspan='4'>No bookings approved yet</td></tr>";
}

// Menutup koneksi database
$conn->close();
?>
