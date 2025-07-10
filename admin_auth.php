<?php
session_start();

if ($_POST['username'] !== $admin_user) {
    echo "<script>alert('Username salah!'); window.location.href='admin_login.php';</script>";
    exit();
}

if ($_POST['password'] !== $admin_pass) {
    echo "<script>alert('Password salah!'); window.location.href='admin_login.php';</script>";
    exit();
}

$_SESSION['admin_logged_in'] = true;
header('Location: admin.html');
exit();
?>
