<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan</title>
        <link rel="stylesheet" href="../css/laporan.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="../java/akun.js" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script>
            function deleteReport(id) {
                if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
                    window.location.href = `delete_laporan.php?id=${id}`;
                }
            }

            function downloadReport(id) {
                window.location.href = `download_laporan.php?id=${id}`;
            }
        </script>
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
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-3 mt-3">
                                <div class="col-6">
                                    <h2>Laporan</h2>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLaporanModal">
                                        Tambah Laporan
                                    </button>                                  
                                </div>
                            </div>        
                            <table class="table table-bordered" style="border-color: black;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Jumlah Transaksi</th>
                                        <th>Total Pendapatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Konfigurasi database
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "hotel"; // Ganti dengan nama database Anda

                                    // Membuat koneksi
                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Periksa koneksi
                                    if ($conn->connect_error) {
                                        die("Koneksi gagal: " . $conn->connect_error);
                                    }

                                    // Ambil data dari tabel laporan
                                    $sql = "SELECT * FROM laporan";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $no = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td>" . $row['bulan'] . "</td>";
                                            echo "<td>" . $row['tahun'] . "</td>";
                                            echo "<td>" . $row['jumlah_transaksi'] . "</td>";
                                            echo "<td>" . $row['pendapatan'] . "</td>";
                                            echo "<td><button class='btn btn-danger btn-sm' onclick='deleteReport(" . $row['no'] . ")'>Hapus</button> <button class='btn btn-success btn-sm' onclick='downloadReport(" . $row['no'] . ")'>Download</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
            <!-- Modal -->
            <div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="tambahLaporanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahLaporanModalLabel">Tambah Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="tambahLaporanForm" method="POST" action="tambah_laporan.php" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="bulanLaporan" class="form-label">Bulan</label>
                                    <input type="text" class="form-control" id="bulanLaporan" name="bulan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tahunLaporan" class="form-label">Tahun</label>
                                    <input type="number" class="form-control" id="tahunLaporan" name="tahun" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahTransaksi" class="form-label">Jumlah Transaksi</label>
                                    <input type="number" class="form-control" id="jumlahTransaksi" name="jumlah_transaksi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="totalPendapatan" class="form-label">Total Pendapatan</label>
                                    <input type="number" class="form-control" id="totalPendapatan" name="pendapatan" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
