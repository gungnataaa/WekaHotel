<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telpon'];
    $password = $_POST['password'];

    // Hash password untuk keamanan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'hotel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert ke tabel admin
    $sql = "INSERT INTO admin (username, email, no_telpon, password, action) VALUES (?, ?, ?, ?, 'Admin')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $no_telepon, $hashedPassword);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman admin.php dengan pesan sukses
        header("Location: admin.php?success=1");
    } else {
        // Redirect dengan pesan error
        header("Location: admin.php?error=" . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request!</p>";
}
?>
