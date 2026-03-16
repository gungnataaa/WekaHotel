<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'hotel');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data admin berdasarkan ID
    $sql = "SELECT * FROM admin WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        header("Location: admin.php?error=Data admin tidak ditemukan!");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: admin.php?error=ID tidak valid!");
    exit();
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $id = intval($_POST['id']);

    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'hotel');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update data admin
    $sql = "UPDATE admin SET username = ?, email = ?, no_telepon = ? WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $no_telepon, $id);

    if ($stmt->execute()) {
        header("Location: admin.php?success=Data berhasil diubah!");
    } else {
        header("Location: admin.php?error=" . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Admin</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <form action="edit_admin.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['no']); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telpon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?php echo htmlspecialchars($data['no_telpon']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="admin.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
