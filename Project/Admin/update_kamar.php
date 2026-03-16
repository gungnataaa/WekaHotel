<?php
include 'koneksi.php'; // Pastikan file koneksi.php sesuai dengan koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kamar = $_POST['no'];
    $action = $_POST['action'];

    if ($action === 'tambah') {
        $sql = "UPDATE kamar SET kamar_tersedia = kamar_tersedia + 1 WHERE no = ?";
    } elseif ($action === 'kurang') {
        $sql = "UPDATE kamar SET kamar_tersedia = kamar_tersedia - 1 WHERE no = ? AND kamar_tersedia > 0";
    } else {
        die("Aksi tidak valid.");
    }

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_kamar);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect ke halaman kamar.php tanpa notifikasi
        header('Location: kamar.php');
        exit();
    } else {
        // Redirect ke halaman kamar.php tanpa notifikasi jika terjadi kesalahan
        header('Location: kamar.php');
        exit();
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
