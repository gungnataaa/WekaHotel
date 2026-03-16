<?php
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - Weka Hotel</title>
    <link rel="stylesheet" href="../css/confirmation.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  </head>
  <body>
    <div class="hotel-image">
      <img src="../img/hotel.jpg" alt="Weka Hotel">
    </div>
    
    <main>
      <section class="confirmation-section">
        <h2>Konfirmasi Pemesanan</h2>
        <p>Terima kasih telah memesan kamar di Weka Hotel. Berikut detail pemesanan Anda:</p>

        <?php
        // Koneksi database
        $conn = new mysqli('localhost', 'root', '', 'hotel');

        if ($conn->connect_error) {
            die("<p class='text-danger'>Koneksi gagal: " . htmlspecialchars($conn->connect_error) . "</p>");
        }

        // Mengambil ID terbaru dari tabel status_checkin
        $sql = "SELECT MAX(checkinID) AS latestID FROM status_checkin";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $latestID = $row['latestID'];
        } else {
            echo "<p class='text-warning'>Tidak ada data tersedia di tabel status_checkin.</p>";
            $conn->close();
            exit();
        }

        // Mengambil detail berdasarkan ID terbaru
        $sql = "SELECT roomType, fullName, email, phone, checkIn, checkOut, status FROM status_checkin WHERE checkinID = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $latestID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $roomType = htmlspecialchars($row['roomType']);
                $fullName = htmlspecialchars($row['fullName']);
                $email = htmlspecialchars($row['email']);
                $phone = htmlspecialchars($row['phone']);
                $checkIn = htmlspecialchars($row['checkIn']);
                $checkOut = htmlspecialchars($row['checkOut']);
                $status = htmlspecialchars($row['status']);
            } else {
                echo "<p class='text-warning'>Data pemesanan tidak ditemukan.</p>";
                $stmt->close();
                $conn->close();
                exit();
            }

            $stmt->close();
        } else {
            echo "<p class='text-danger'>Kesalahan dalam query: " . htmlspecialchars($conn->error) . "</p>";
        }

        $conn->close();
        ?>

        <div class="booking-details">
          <p><strong>Jenis Kamar:</strong> <?php echo $roomType; ?></p>
          <p><strong>Nama Lengkap:</strong> <?php echo $fullName; ?></p>
          <p><strong>Email:</strong> <?php echo $email; ?></p>
          <p><strong>Nomor Telepon:</strong> <?php echo $phone; ?></p>
          <p><strong>Tanggal Check-In:</strong> <?php echo $checkIn; ?></p>
          <p><strong>Tanggal Check-Out:</strong> <?php echo $checkOut; ?></p>
          <p><strong>Status Pemesanan:</strong> <?php echo $status; ?></p>
        </div>

        <div class="confirmation-actions">
          <a href="../html/dashboarduser.php" class="btn btn-primary">Kembali ke Beranda</a>
          <a href="../html/halamanpemesanan.php" class="btn btn-secondary">Pesan Lagi</a>
        </div>
      </section>
    </main>
        <?php include 'footer.php'; ?>
  </body>
</html>
