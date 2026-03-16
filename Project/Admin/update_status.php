<?php
// Koneksi ke database
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkinID = $_POST['id']; // Primary key dari pesanan
    $status = $_POST['status']; // Status baru (checked_in)

    // Query untuk memperbarui status di database
    $sql = "UPDATE status_checkin SET status = ? WHERE checkinID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $checkinID);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>
                alert('Status berhasil diperbarui menjadi Checked In!');
                window.location.href = 'transaksi.php';
                </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui status!');
                window.location.href = 'transaksi.php';
                </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('Permintaan tidak valid!');
            window.location.href = 'transaksi.php';
            </script>";
}
?>
