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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $jumlah_transaksi = $_POST['jumlah_transaksi'];
    $pendapatan = $_POST['pendapatan'];

    $sql = "UPDATE laporan SET bulan='$bulan', tahun='$tahun', jumlah_transaksi='$jumlah_transaksi', pendapatan='$pendapatan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
