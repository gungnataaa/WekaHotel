<?php
// Koneksi ke database
include 'koneksi.php';

// Pastikan data diterima dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkinID'])) {
    $checkinID = $_POST['checkinID'];
    $roomType = $_POST['roomType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    // Menghindari SQL Injection dengan prepared statements
    $sql = "UPDATE status_checkin SET roomType = ?, fullName = ?, email = ?, phone = ?, status = ? WHERE checkinID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssi', $roomType, $fullName, $email, $phone, $status, $checkinID);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Redirect dengan pesan sukses
        header("Location: kamar.php?message=update_success");
    } else {
        // Redirect dengan pesan error
        header("Location: kamar.php?message=update_error");
    }
    // Menutup statement
    mysqli_stmt_close($stmt);
} else {
    // Jika request tidak valid
    header("Location: kamar.php?message=invalid_request");
}
?>
