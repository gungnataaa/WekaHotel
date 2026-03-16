<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="../css/transaksi.css">
    <script src="../java/akun.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <div class="col-2">
            <div class="d-flex">
                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item" style="background-color: #343a40;">
                            <h2 class="accordion-header">
                                <button class="accordion-button" style="background-color: #343a40;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                Master
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="col-12 mb-2">
                                        <button type="button" onclick="location.href='./transaksi.php'" class="btn">Transaksi</button>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <button type="button" onclick="location.href='./kamar.php'" class="btn">Kamar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="background-color: #343a40;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" style="background-color: #343a40;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Laporan
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="col-12 mb-2">
                                        <button type="button" onclick="location.href='./laporan.php'" class="btn">Laporan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="background-color: #343a40;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" style="background-color: #343a40;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Pengguna
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="col-12 mb-2">
                                        <button type="button" onclick="location.href='./user.php'" class="btn">Pengguna</button>    
                                    </div>
                                    <div class="col-12 mb-2">
                                        <button type="button" onclick="location.href='./admin.php'" class="btn">Admin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- Main Content -->
        <div class="col-10">
            <div id="akun-container"></div>
            <div class="flex-grow-1">
                <h2>Transaksi</h2>
                <?php
                // Konfigurasi database
                $servername = "localhost";
                $username = "root"; // Sesuaikan dengan username Anda
                $password = ""; // Sesuaikan dengan password Anda
                $dbname = "hotel"; // Nama database Anda
                
                // Koneksi ke database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Query data
                $sql = "SELECT * FROM status_checkin";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered' style='border-color: black;'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Email</th>
                                    <th>No Telpon</th>
                                    <th>Jenis Kamar</th>
                                    <th>Tanggal Check-In</th>
                                    <th>Tanggal Check-Out</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row['fullName'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phone'] . "</td>
                                <td>" . $row['roomType'] . "</td>
                                <td>" . $row['checkIn'] . "</td>
                                <td>" . $row['checkOut'] . "</td>
                                <td>" . $row['status'] . "</td>
                                <td>
                                    <form action='update_status.php' method='POST' onsubmit=\"return confirm('Apakah Anda yakin ingin mengubah status menjadi Checked In?');\">
                                        <input type='hidden' name='id' value='" . $row['checkinID'] . "'>
                                        <input type='hidden' name='status' value='checked_in'>
                                        <button type='submit' class='btn btn-success' " . ($row['status'] === 'checked_in' ? 'disabled' : '') . ">Konfirmasi</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>Tidak ada data.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>    
    </div>
</body>
</html>
