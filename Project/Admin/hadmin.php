<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../css/hadmin.css">
        <script src="../java/akun.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <?php
        session_start();
        include 'koneksi.php'; // Pastikan koneksi ke database

        // Periksa apakah pengguna sudah login
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }

        // Ambil username dari sesi
        $username = $_SESSION['username'];

        // Ambil data admin berdasarkan username
        $query = "SELECT username FROM admin WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $namaAdmin = $admin['username'];
        } else {
            $namaAdmin = "Admin";
        }

        // Query untuk menghitung total pengguna
        $queryTotalPengguna = "SELECT COUNT(*) AS total FROM user";
        $resultTotalPengguna = $conn->query($queryTotalPengguna);

        if ($resultTotalPengguna->num_rows > 0) {
            $rowTotalPengguna = $resultTotalPengguna->fetch_assoc();
            $totalPengguna = $rowTotalPengguna['total'];
        } else {
            $totalPengguna = 0;
        }

        // Query untuk menghitung total kamar berdasarkan jumlah_kamar
        $queryTotalKamar = "SELECT SUM(jumlah_kamar) AS total FROM kamar";
        $resultTotalKamar = $conn->query($queryTotalKamar);

        if ($resultTotalKamar->num_rows > 0) {
            $rowTotalKamar = $resultTotalKamar->fetch_assoc();
            $totalKamar = $rowTotalKamar['total'];
        } else {
            $totalKamar = 0;
        }

        // Query untuk menghitung total transaksi dari status_checkin
        $queryTotalTransaksi = "SELECT COUNT(*) AS total FROM status_checkin";
        $resultTotalTransaksi = $conn->query($queryTotalTransaksi);

        if ($resultTotalTransaksi->num_rows > 0) {
            $rowTotalTransaksi = $resultTotalTransaksi->fetch_assoc();
            $totalTransaksi = $rowTotalTransaksi['total'];
        } else {
            $totalTransaksi = 0;
        }

        // Query untuk menghitung total laporan
        $queryTotalLaporan = "SELECT COUNT(*) AS total FROM laporan";
        $resultTotalLaporan = $conn->query($queryTotalLaporan);

        if ($resultTotalLaporan->num_rows > 0) {
            $rowTotalLaporan = $resultTotalLaporan->fetch_assoc();
            $totalLaporan = $rowTotalLaporan['total'];
        } else {
            $totalLaporan = 0;
        }
        ?>
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
                    <h2>Dashboard</h2>
                    <div class="alert alert-success" role="alert">
                        Selamat datang <strong><?php echo htmlspecialchars($namaAdmin); ?></strong>, Anda berhasil login
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="card-title"><strong>Total Pengguna</strong></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="card-text mb-1"><?php echo $totalPengguna; ?></p>
                                            <p class="card-text">Pengguna</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                        <div class="col-3">
                            <div class="card text-bg-info mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="card-title"><strong>Total Kamar</strong></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="card-text mb-1"><?php echo $totalKamar; ?></p>
                                            <p class="card-text">Kamar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                        <div class="col-3">
                            <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="card-title"><strong>Total Transaksi</strong></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="card-text mb-1"><?php echo $totalTransaksi; ?></p>
                                            <p class="card-text">Transaksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                        <div class="col-3">
                            <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="card-title"><strong>Total Laporan</strong></p>
                                        </div>
                                        <div class="col-5">
                                            <p class="card-text mb-1"><?php echo $totalLaporan; ?></p>
                                            <p class="card-text">Laporan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
