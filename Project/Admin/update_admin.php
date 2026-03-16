<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telpon = $_POST['no_telpon'];
    $password = isset($_POST['password']) ? $_POST['password'] : null; // Ambil password jika ada

    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'hotel');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Logika update dengan atau tanpa password
    if (!empty($password)) {
        // Jika password baru diisi
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET username = ?, email = ?, no_telpon = ?, password = ? WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $email, $no_telpon, $hashedPassword, $id);
    } else {
        // Jika password baru tidak diisi
        $sql = "UPDATE admin SET username = ?, email = ?, no_telpon = ? WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $no_telpon, $id);
    }

    if ($stmt->execute()) {
        // Redirect kembali ke halaman admin dengan pesan sukses
        header("Location: admin.php?success=Data berhasil diubah!");
    } else {
        // Tampilkan error jika query gagal
        header("Location: admin.php?error=" . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: admin.php?error=Request tidak valid!");
}
?>
