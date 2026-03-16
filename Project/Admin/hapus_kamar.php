<?php
// Sambungkan ke database
include 'koneksi.php';

// Periksa apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['no'])) {
    $no = intval($_POST['no']);

    // Query untuk menghapus data kamar berdasarkan no
    $sql = "DELETE FROM kamar WHERE no = $no";

    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman utama dengan pesan sukses
        header("Location: kamar.php?message=delete_success");
        exit();
    } else {
        // Redirect ke halaman utama dengan pesan error
        header("Location: kamar.php?message=delete_error");
        exit();
    }
} else {
    // Redirect jika permintaan tidak valid
    header("Location: kamar.php?message=invalid_request");
    exit();
}
?>
