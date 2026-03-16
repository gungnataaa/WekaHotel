<?php
// Konfigurasi database
$host = 'localhost'; // Sesuaikan dengan host Anda
$dbname = 'hotel'; // Nama database
$username = 'root'; // Username database
$password = ''; // Password database

try {
    // Membuat koneksi database menggunakan PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Mengambil data dari form login
$user = $_POST['username']; // Ganti ke POST untuk keamanan lebih baik
$pass = $_POST['password'];

try {
    // Query untuk mengambil data pengguna berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Memvalidasi password
    if ($admin && password_verify($pass, $admin['password'])) {
        session_start();
        $_SESSION['username'] = $admin['username']; // Simpan username dalam sesi
        $_SESSION['role'] = $admin['action']; // Simpan role/action jika diperlukan
        header("Location: hadmin.php"); // Redirect ke dashboard admin
        exit();
    } else {
        // Jika login gagal
        echo "<script>alert('Username atau Password salah!'); window.location.href = './login.php';</script>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
