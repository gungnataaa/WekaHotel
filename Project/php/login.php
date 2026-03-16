<?php
require 'koneksi.php'; // Pastikan file koneksi sesuai

$message = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    // Validasi input
    if (!$username || !$password) {
        $message = "Harap isi semua bidang!";
    } else {
        // Query untuk memeriksa username di database
        $query_sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query_sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Login berhasil
                session_start();
                $_SESSION['username'] = $user['username'];
                header("Location: ../html/dashboarduser.php"); // Path ke dashboard
                exit();
            } else {
                $message = "Password salah!";
            }
        } else {
            $message = "Username tidak ditemukan!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Weka Hotel</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login User</h1>
        <!-- Tampilkan pesan error -->
        <?php if (!empty($message)): ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p class="message">Belum punya akun? <a href="signup.html">Sign Up</a></p>
        </form>
    </div>
</body>
</html>
