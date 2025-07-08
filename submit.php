<?php
include 'config.php'; // Pastikan config.php ada dan benar

// Mengambil data dari form
$user = $_POST['user'];
$date = $_POST['date'];
$start_time = $_POST['start-time'];
$end_time = $_POST['end-time'];
$whatsapp = $_POST['whatsapp'];
$upload_file = isset($_FILES['upload-file']) ? $_FILES['upload-file']['name'] : NULL;
$keterangan = $_POST['keterangan'];

// Validasi input form
if (empty($user) || empty($date) || empty($start_time) || empty($end_time) || empty($whatsapp) || empty($keterangan)) {
    echo "<script>alert('Error: Semua form wajib diisi.'); window.location.href='index.html';</script>";
    exit();
}

// Menangani upload file
if ($upload_file) {
    $target_dir = "uploads/";
    $allowed_types = array('pdf', 'doc', 'docx');
    $file_extension = strtolower(pathinfo($_FILES["upload-file"]["name"], PATHINFO_EXTENSION));

    // Generate nama file unik dengan timestamp
    $new_filename = time() . '_' . basename($_FILES["upload-file"]["name"]);
    $target_file = $target_dir . $new_filename;

    // Validasi tipe file
    if (!in_array($file_extension, $allowed_types)) {
        echo "<script>alert('Error: Tipe file tidak diizinkan.'); window.location.href='index.html';</script>";
        exit();
    }

    // Buat direktori upload jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["upload-file"]["tmp_name"], $target_file)) {
        $upload_file = $target_file;
    } else {
        echo "<script>alert('Error: Gagal mengupload file.'); window.location.href='index.html';</script>";
        exit();
    }
}

// Validasi ketersediaan jadwal
$check_sql = "SELECT * FROM bookings WHERE date = ? AND ((start_time <= ? AND end_time > ?) OR (start_time < ? AND end_time >= ?))";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("sssss", $date, $start_time, $start_time, $end_time, $end_time);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo "<script>alert('Error: Waktu bertabrakan dengan jadwal lain. Silakan pilih waktu lain.'); window.location.href='index.html';</script>";
    exit();
}

$check_stmt->close();

// Menyimpan data ke database
$sql = "INSERT INTO bookings (user, date, start_time, end_time, whatsapp, upload_file, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $user, $date, $start_time, $end_time, $whatsapp, $upload_file, $keterangan);

if ($stmt->execute()) {
    header("Location: success.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>