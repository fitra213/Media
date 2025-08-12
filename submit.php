<?php
// Mengimpor konfigurasi database
include 'config.php'; 

// Mengambil data dari form yang dikirimkan user
$user = $_POST['user'];
$date = $_POST['date'];
$start_time = $_POST['start-time'];
$end_time = $_POST['end-time'];
$whatsapp = $_POST['whatsapp'];
$upload_file = isset($_FILES['upload-file']) ? $_FILES['upload-file']['name'] : NULL;
$keterangan = $_POST['keterangan'];

// Validasi input form, semua field wajib diisi
if (empty($user) || empty($date) || empty($start_time) || empty($end_time) || empty($whatsapp) || empty($keterangan)) {
    echo "<script>alert('Error: Semua form wajib diisi.'); window.location.href='index.html';</script>";
    exit();
}

// Menangani upload file jika ada
if ($upload_file) {
    $target_dir = "uploads/";
    $allowed_types = array('pdf', 'doc', 'docx');
    $file_extension = strtolower(pathinfo($_FILES["upload-file"]["name"], PATHINFO_EXTENSION));

    // Generate nama file unik dengan timestamp
    $new_filename = time() . '_' . basename($_FILES["upload-file"]["name"]);
    $target_file = $target_dir . $new_filename;

    // Validasi tipe file yang diizinkan
    if (!in_array($file_extension, $allowed_types)) {
        echo "<script>alert('Error: Tipe file tidak diizinkan.'); window.location.href='index.html';</script>";
        exit();
    }

    // Membuat direktori upload jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Memindahkan file yang diupload ke folder uploads
    if (move_uploaded_file($_FILES["upload-file"]["tmp_name"], $target_file)) {
        $upload_file = $target_file;
    } else {
        echo "<script>alert('Error: Gagal mengupload file.'); window.location.href='index.html';</script>";
        exit();
    }
}

// Validasi ketersediaan jadwal agar tidak bentrok dengan booking lain
$check_sql = "SELECT * FROM bookings WHERE date = ? AND ((start_time <= ? AND end_time > ?) OR (start_time < ? AND end_time >= ?))";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("sssss", $date, $start_time, $start_time, $end_time, $end_time);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Jika jadwal bentrok, tampilkan pesan error
    echo "<script>alert('Error: Waktu bertabrakan dengan jadwal lain. Silakan pilih waktu lain.'); window.location.href='index.html';</script>";
    exit();
}

$check_stmt->close();

// Menyimpan data booking ke database
$sql = "INSERT INTO bookings (user, date, start_time, end_time, whatsapp, upload_file, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $user, $date, $start_time, $end_time, $whatsapp, $upload_file, $keterangan);

if ($stmt->execute()) {
    // Jika berhasil, redirect ke halaman sukses
    header("Location: success.php");
    exit();
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>