<?php
// Koneksi ke database
include_once 'koneksi.php';

// Cek apakah ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM user WHERE no = ?";

    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman user.php
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'user.php';
                </script>";
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href = 'user.php';
                </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika ID tidak tersedia, arahkan kembali ke halaman user.php
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'user.php';
            </script>";
}
?>
