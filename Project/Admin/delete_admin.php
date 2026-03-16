<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'hotel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hapus data dari tabel admin berdasarkan ID
    $sql = "DELETE FROM admin WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect ke halaman admin dengan pesan sukses
        header("Location: admin.php?success=Data berhasil dihapus!");
    } else {
        // Redirect ke halaman admin dengan pesan error
        header("Location: admin.php?error=" . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: admin.php?error=ID tidak valid!");
}
?>
