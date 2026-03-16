<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $bulan = $conn->real_escape_string($_POST['bulan']);
    $tahun = $conn->real_escape_string($_POST['tahun']);
    $jumlah_transaksi = $conn->real_escape_string($_POST['jumlah_transaksi']);
    $pendapatan = $conn->real_escape_string($_POST['pendapatan']);

    // SQL untuk menyimpan data ke database tanpa file
    $sql = "INSERT INTO laporan (bulan, tahun, jumlah_transaksi, pendapatan) 
            VALUES ('$bulan', '$tahun', '$jumlah_transaksi', '$pendapatan')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman laporan.php setelah berhasil menyimpan data
        header("Location: laporan.php?message=success");
        exit(); // Pastikan script berhenti setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
