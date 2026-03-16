<?php
require 'koneksi.php'; // Pastikan file ini sudah dibuat

// Query untuk mengambil data pengguna
$sql = "SELECT id, username, email, phone, password FROM users";
$result = $conn->query($sql);

// Buat array untuk menyimpan data
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
