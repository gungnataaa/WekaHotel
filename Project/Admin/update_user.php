<?php
// Koneksi ke database
include_once 'koneksi.php';

// Cek apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telpon = $_POST['no_telpon'];
    $password = $_POST['password'];

    // Validasi input
    if (!empty($id) && !empty($username) && !empty($email) && !empty($no_telpon)) {
        // Jika password diisi, maka update password juga
        if (!empty($password)) {
            $sql = "UPDATE user SET username = ?, email = ?, no_telpon = ?, password = ? WHERE no = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $username, $email, $no_telpon, $password, $id);
        } else {
            // Jika password kosong, update data kecuali password
            $sql = "UPDATE user SET username = ?, email = ?, no_telpon = ? WHERE no = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $username, $email, $no_telpon, $id);
        }

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>
                    alert('Data berhasil diperbarui!');
                    window.location.href = 'user.php';
                    </script>";
        } else {
            echo "<script>
                    alert('Gagal memperbarui data!');
                    window.location.href = 'user.php';
                    </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location.href = 'user.php';
                </script>";
    }
    $conn->close();
} else {
    echo "<script>
            alert('Metode tidak valid!');
            window.location.href = 'user.php';
            </script>";
}
?>
