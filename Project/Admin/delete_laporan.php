<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah ID (no) diterima dari parameter URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID adalah angka untuk menghindari SQL Injection

    // Query untuk menghapus laporan berdasarkan ID
    $sql = "DELETE FROM laporan WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman laporan
        header("Location: laporan.php?message=success");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Gagal menghapus laporan: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID laporan tidak ditemukan.";
}

$conn->close();
?>
