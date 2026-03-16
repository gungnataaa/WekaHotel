<?php
// Memasukkan file koneksi database
require 'koneksi.php'; // Pastikan path ke koneksi.php benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form signup
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $no_telpon = $_POST['no_telpon'] ?? null;
    $password = $_POST['password'] ?? null;

    // Validasi sederhana
    if (!$username || !$email || !$no_telpon || !$password) {
        echo "<script>
                alert('Semua bidang harus diisi!');
                window.history.back();
              </script>";
        exit;
    }

    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Query untuk menyimpan data ke tabel user
    $query_sql = "INSERT INTO user (username, email, no_telpon, password) 
                  VALUES ('$username', '$email', '$no_telpon', '$hashed_password')";

    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($conn, $query_sql)) {
        // Jika berhasil, arahkan ke halaman login
        echo "<script>
                alert('Akun berhasil didaftarkan! Silakan login.');
                window.location.href = '../html/login.html';
              </script>";
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>
                alert('Pendaftaran gagal: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
        exit();
    }
}
?>
