<?php
$host = 'localhost'; // Host database
$user = 'root'; // Username MySQL
$password = ''; // Password MySQL
$database = 'hotel'; // Nama database

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
