<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Jika sesi login tidak ditemukan, arahkan ke halaman login
    header("Location: login.html?error=not_logged_in");
    exit();
}

// Pastikan koneksi ke database
require '../php/koneksi.php';

include '../html/header.php';

// Ambil data pengguna berdasarkan sesi username
$username = $_SESSION['username'];
$query = "SELECT username FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Cek apakah data ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result); // Simpan data pengguna dalam array $user
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weka Hotel</title>
    <link rel="stylesheet" href="../css/dashboarduser.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <script src="../java/kamar.js" defer></script>
  </head>
  <body>

    <section id="home" class="hero" >
      <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
      <div class="hero-content" style="position: relative; z-index: 2;">
        <h2>Liburan Mewah Menanti Anda!</h2>
        <p>Rasakan pengalaman menginap yang tak terlupakan dengan layanan terbaik dan suasana yang menenangkan. Pesan sekarang untuk pengalaman yang luar biasa!</p>
        <h3 style="color: #cccccc ;"><strong>Selamat Datang, <?php echo htmlspecialchars($user['username']); ?>!</strong></h3>
        <a href="../html/halamanpemesanan.php" class="btn">Pesan Sekarang</a>
      </div>
    </section>
    <section id="rooms">
      <h2>Book Your Room</h2>
      <p>Choose your room and enjoy your stay.</p>
      <div class="room-list">
        <!-- Konten kamar di sini -->
      </div>
    </section>

    <section id="restaurant-bar" class="restaurant-bar-section">
        <h2>Resto & Bar</h2>
        <p>Discover the finest dining and refreshing beverages at our Resto & Bar.</p>
      <div class="restaurant-bar-container">
        <div class="restaurant-item">
          <img src="../img/restaurant.jpg" alt="Restaurant">
          <div class="info-box">
            <h4>OUR RESTAURANT</h4>
            <h2>Restaurant</h2>
            <p>
              Selamat datang di restoran kami, di mana cita rasa bertemu dengan kehangatan pelayanan. Kami menawarkan pengalaman bersantap yang luar biasa dengan menu yang terinspirasi oleh masakan lokal dan internasional, disiapkan dengan bahan-bahan segar dan berkualitas tinggi.
            </p>
            <a href="../html/detailresto.php" class="learn-more-btn">Lebih lanjut</a>
          </div>
        </div>
        <div class="bar-item">
          <img src="../img/bar.jpg" alt="Bar">
          <div class="info-box">
            <h4>OUR BAR</h4>
            <h2>Bar</h2>
            <p>
              Selamat datang di bar kami, tempat di mana suasana yang hidup bertemu dengan pilihan minuman yang luar biasa. Di sini, Anda dapat menikmati berbagai macam koktail yang diracik dengan tangan oleh bartender kami yang berpengalaman, serta pilihan anggur dan spirit yang telah dipilih dengan cermat untuk memuaskan selera Anda.
            </p>
            <a href="../html/detailbar.php" class="learn-more-btn">Lebih Lanjut</a>
          </div>
        </div>
      </div>
    </section>
    <?php include 'footer.php'; ?>
  </body>
</html>
