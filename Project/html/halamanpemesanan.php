<?php
include '../html/header.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Room - Weka Hotel</title>
    <link rel="stylesheet" href="../css/halamanpemesanan.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  </head>
  <body>
    <main>
      <section class="booking-section">
        <h2>Pesan Kamar Anda</h2>
        <p>Pilih kamar yang sesuai dengan kebutuhan Anda dan lihat detail fasilitasnya.</p>

        <!-- Regular Room -->
        <div class="room-card">
          <h3>Regular Room</h3>
          <img src="../img/Reguler.jpg" alt="Regular Room">
          <ul>
            <li>Sarapan gratis</li>
            <li>WiFi kecepatan tinggi</li>
            <li>1 tempat tidur ukuran queen</li>
            <li>Kamar mandi pribadi</li>
          </ul>
          <p>Harga: 1jt/night</p>
        </div>

        <!-- VIP Room -->
        <div class="room-card">
          <h3>VIP Room</h3>
          <img src="../img/VIP.JPG" alt="VIP Room">
          <ul>
            <li>Sarapan gratis</li>
            <li>WiFi premium</li>
            <li>1 tempat tidur ukuran king</li>
            <li>Pemandangan laut</li>
            <li>Akses lounge VIP</li>
          </ul>
          <p>Harga: 2jt/night</p>
        </div>

        <!-- Executive Room -->
        <div class="room-card">
          <h3>Executive Room</h3>
          <img src="../img/Executive.jpg" alt="Executive Room">
          <ul>
            <li>Sarapan eksklusif</li>
            <li>WiFi premium</li>
            <li>2 tempat tidur ukuran king</li>
            <li>Pemandangan kota</li>
            <li>Layanan butler pribadi</li>
          </ul>
          <p>Harga: 3jt/night</p>
        </div>
      </section>

      <section class="booking-form">
        <h2>Pesan Kamar Anda</h2>
        <p>Isi detail di bawah ini untuk melanjutkan pemesanan.</p>

        <!-- Formulir pemesanan -->
        <form action="checkin.php" method="POST" id="bookingForm">
          <!-- Pilihan Kamar -->
          <label for="roomType">Jenis Kamar:</label>
          <select id="roomType" name="roomType" required>
            <option value="Regular">Regular Room - 1jt/night</option>
            <option value="VIP">VIP Room - 2jt/night</option>
            <option value="Executive">Executive Room - 3jt/night</option>
          </select>

          <!-- Nama Lengkap -->
          <label for="fullName">Nama Lengkap:</label>
          <input type="text" id="fullName" name="fullName" placeholder="Masukkan nama Anda" required>

          <!-- Email -->
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>

          <!-- Nomor Telepon -->
          <label for="phone">Nomor Telepon:</label>
          <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" required>

          <!-- Tanggal Check-In -->
          <label for="checkIn">Tanggal Check-In:</label>
          <input type="date" id="checkIn" name="checkIn" required>

          <!-- Tanggal Check-Out -->
          <label for="checkOut">Tanggal Check-Out:</label>
          <input type="date" id="checkOut" name="checkOut" required>

          <!-- Tombol Kirim -->
          <button type="submit" class="btn-submit">Pesan Sekarang</button>
        </form>
      </section>
    </main>
    <?php include 'footer.php'; ?>
  </body>
</html>
