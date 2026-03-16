<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Sambungkan ke database
require '../php/koneksi.php';


// Ambil data pengguna berdasarkan username
$username = $_SESSION['username'];
$query = "SELECT username, email, no_telpon FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['no_telpon'] = $user['no_telpon'];
} else {
    $_SESSION['username'] = 'Guest';
    $_SESSION['email'] = 'Tidak tersedia';
    $_SESSION['no_telpon'] = 'Tidak tersedia';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weka Hotel</title>
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  </head>
  <body>
    <header>
      <div class="navbar">
        <h1>Weka Hotel</h1>
        <nav>
          <ul>
            <li><a href="../html/dashboarduser.php">Home</a></li>
            <li><a href="../html/confirmation.php">Confirmation</a></li>
            <li><a href="../html/dashboarduser.php#rooms">Rooms</a></li>
            <li><a href="../html/dashboarduser.php#restaurant-bar">Resto & Bar</a></li>
            <li><a href="#contact">Contact</a></li>
            <li>
              <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fa fa-user-o" aria-hidden="true"></i>
              </button>            
            </li> 
          </ul>
        </nav>
      </div>
    </header>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Akun</h5>
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
            <button type="button" onclick="location.href='../php/logout.php'" class="btn btn-primary" style="background-color: #f4a226; border: none;">Keluar</button>
        </div>
    </div>
  </body>
</html>
