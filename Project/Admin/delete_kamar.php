<?php
// Include file koneksi
include 'koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkinID'])) {
    // Ambil ID dari form
    $checkinID = mysqli_real_escape_string($conn, $_POST['checkinID']);

    // Query untuk menghapus data
    $sql = "DELETE FROM status_checkin WHERE checkinID = '$checkinID'";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, arahkan kembali ke halaman kamar.php dengan pesan sukses
        header('Location: kamar.php?message=success');
        exit();
    } else {
        // Jika gagal, arahkan kembali dengan pesan error
        header('Location: kamar.php?message=error');
        exit();
    }
} else {
    // Jika permintaan tidak valid, arahkan kembali dengan pesan error
    header('Location: kamar.php?message=invalid_request');
    exit();
}

// Tutup koneksi
mysqli_close($conn);
?>
