<?php
// Sambungkan ke database
include 'koneksi.php';

// Cek apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_kamar = mysqli_real_escape_string($conn, $_POST['jenis_kamar']);
    $harga_kamar = mysqli_real_escape_string($conn, $_POST['harga_kamar']);
    $jumlah_kamar = mysqli_real_escape_string($conn, $_POST['jumlah_kamar']);
    $kamar_tersedia = mysqli_real_escape_string($conn, $_POST['kamar_tersedia']);

    // Query untuk menambahkan data ke tabel kamar
    $sql = "INSERT INTO kamar (jenis_kamar, harga_kamar, jumlah_kamar, kamar_tersedia) VALUES ('$jenis_kamar', '$harga_kamar', '$jumlah_kamar', '$kamar_tersedia')";

    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman utama dengan pesan sukses
        header("Location: kamar.php?message=add_success");
        exit();
    } else {
        // Redirect ke halaman utama dengan pesan error
        header("Location: kamar.php?message=add_error");
        exit();
    }
} else {
    // Redirect jika permintaan tidak valid
    header("Location: kamar.php?message=invalid_request");
    exit();
}
?>
