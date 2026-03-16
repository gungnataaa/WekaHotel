<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Sambungkan ke database
require '../php/koneksi.php';

// Ambil data pengguna berdasarkan username dari tabel admin
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT username, email, no_telpon FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'] ?? 'Tidak tersedia';
        $_SESSION['no_telpon'] = $user['no_telpon'] ?? 'Tidak tersedia';
    } else {
        $_SESSION['username'] = 'Guest';
        $_SESSION['email'] = 'Tidak tersedia';
        $_SESSION['no_telpon'] = 'Tidak tersedia';
    }
} else {
    $_SESSION['username'] = 'Guest';
    $_SESSION['email'] = 'Tidak tersedia';
    $_SESSION['no_telpon'] = 'Tidak tersedia';
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tampilan Akun Admin</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg  fixed-top p-0" style="background-color: #343a40;">
            <div class="container-fluid">
                <h4 class="navbar-brand"><a href="../Admin/hadmin.php" style="text-decoration: none; color:#ffffff;">Weka Hotel</a></h4>
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn mt-2 me-4" style="border: none; border-radius: 100%;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa fa-user-circle" aria-hidden="true" style="font-size: 1.5em; color:#ffff;"></i>
                    </button>
                </div>
            </div>
        </nav>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
                <div class="offcanvas-body">
                <label>Nama:</label>
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                <label>Email:</label>
                <p><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <label>Telepon:</label>
                <p><?php echo htmlspecialchars($_SESSION['no_telpon']); ?></p>
                <br>
                <button type="button" onclick="location.href='./login.php'" class="btn btn-primary">Keluar</button>
            </div>
    </body>
</html>
