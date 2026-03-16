<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan</title>
        <link rel="stylesheet" href="../css/kamar.css">
        <script src="../java/akun.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script>
            function confirmDeletion() {
                return confirm("Apakah Anda yakin ingin menghapus data ini?");
            }
        </script>
    </head>
    <body>
        <?php
        include 'koneksi.php'; // Pastikan file koneksi.php berada dalam direktori yang sesuai

        // Notifikasi pesan
        if (isset($_GET['message'])) {
            $message = $_GET['message'];

            if ($message === 'delete_success') {
                echo "<script>alert('Data berhasil dihapus. Data berhasil diperbarui.');</script>";
            } elseif ($message === 'delete_error') {
                echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
            } elseif ($message === 'invalid_request') {
                echo "<script>alert('Permintaan tidak valid.');</script>";
            } elseif ($message === 'add_success') {
                echo "<script>alert('Data kamar berhasil ditambahkan.');</script>";
            } elseif ($message === 'add_error') {
                echo "<script>alert('Terjadi kesalahan saat menambahkan data kamar.');</script>";
            }
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
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-3 mt-3">
                                <div class="col-6">
                                    <h2>Kamar</h2>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKamar">
                                        Tambah Kamar
                                    </button>                                  
                                </div>
                            </div>        
                            <table class="table table-bordered" style="border-color: black;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kamar</th>
                                        <th>Harga Kamar</th>
                                        <th>Jumlah Kamar</th>
                                        <th>Kamar Tersedia</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM kamar";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td>" . htmlspecialchars($row['jenis_kamar']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['harga_kamar']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['jumlah_kamar']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['kamar_tersedia']) . "</td>";
                                            echo "<td>
                                                    <form method='post' action='update_kamar.php' style='display:inline;'>
                                                        <input type='hidden' name='no' value='" . htmlspecialchars($row['no']) . "'>
                                                        <button type='submit' name='action' value='tambah' class='btn btn-warning'>Tambah</button>
                                                    </form>
                                                    <form method='post' action='update_kamar.php' style='display:inline;'>
                                                        <input type='hidden' name='no' value='" . htmlspecialchars($row['no']) . "'>
                                                        <button type='submit' name='action' value='kurang' class='btn btn-danger'>Kurang</button>
                                                    </form>
                                                    <form method='post' action='hapus_kamar.php' style='display:inline;' onsubmit='return confirmDeletion();'>
                                                        <input type='hidden' name='no' value='" . htmlspecialchars($row['no']) . "'>
                                                        <button type='submit' class='btn btn-danger'>Hapus</button>
                                                    </form>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <h2>Status</h2>
                        <table class="table table-bordered" style="border-color: black;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Kamar</th>
                                    <th>Nama Pemesan</th>
                                    <th>Email</th>
                                    <th>No Telpon</th>
                                    <th>Status Kamar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM status_checkin"; 
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['roomType']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['fullName']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                        echo "<td>                                                
                                                <!-- Tombol untuk membuka modal -->
                                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal" . htmlspecialchars($row['checkinID']) . "'>
                                                    Ubah
                                                </button>
                                                <form method='post' action='delete_kamar.php' style='display:inline;' onsubmit='return confirmDeletion()'>
                                                    <input type='hidden' name='checkinID' value='" . htmlspecialchars($row['checkinID']) . "'>
                                                    <button type='submit' name='action' value='delete' class='btn btn-danger'>Hapus</button>
                                                </form>

                                                </td>";
                                              // Modal untuk mengedit data status
                                                echo "
                                                <div class='modal fade' id='editModal" . htmlspecialchars($row['checkinID']) . "' tabindex='-1' aria-labelledby='editModalLabel" . htmlspecialchars($row['checkinID']) . "' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title' id='editModalLabel" . htmlspecialchars($row['checkinID']) . "'>Edit Data</h5>
                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <form method='post' action='update_status_checkin.php'>
                                                                    <input type='hidden' name='checkinID' value='" . htmlspecialchars($row['checkinID']) . "'>
                                                                    <div class='mb-3'>
                                                                        <label for='roomType' class='form-label'>Jenis Kamar</label>
                                                                        <input type='text' class='form-control' id='roomType' name='roomType' value='" . htmlspecialchars($row['roomType']) . "'>
                                                                    </div>
                                                                    <div class='mb-3'>
                                                                        <label for='fullName' class='form-label'>Nama Pemesan</label>
                                                                        <input type='text' class='form-control' id='fullName' name='fullName' value='" . htmlspecialchars($row['fullName']) . "'>
                                                                    </div>
                                                                    <div class='mb-3'>
                                                                        <label for='email' class='form-label'>Email</label>
                                                                        <input type='email' class='form-control' id='email' name='email' value='" . htmlspecialchars($row['email']) . "'>
                                                                    </div>
                                                                    <div class='mb-3'>
                                                                        <label for='phone' class='form-label'>No Telpon</label>
                                                                        <input type='text' class='form-control' id='phone' name='phone' value='" . htmlspecialchars($row['phone']) . "'>
                                                                    </div>
                                                                    <div class='mb-3'>
                                                                        <label for='status' class='form-label'>Status Kamar</label>
                                                                        <input type='text' class='form-control' id='status' name='status' value='" . htmlspecialchars($row['status']) . "'>
                                                                    </div>
                                                                    <button type='submit' name='action' value='update' class='btn btn-primary'>Simpan Perubahan</button>
                                                                </form>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
            <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kamar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <h2>Tambah Kamar</h2>
                                <form action="add_kamar.php" method="post">
                                    <div class="mb-3">
                                        <label for="jenisKamar" class="form-label">Jenis Kamar</label>
                                        <input type="text" class="form-control" id="jenisKamar" name="jenis_kamar" placeholder="Masukkan Jenis Kamar" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hargaKamar" class="form-label">Harga Kamar</label>
                                        <input type="number" class="form-control" id="hargaKamar" name="harga_kamar" placeholder="Masukkan Harga Kamar" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlahKamar" class="form-label">Jumlah Kamar</label>
                                        <input type="number" class="form-control" id="jumlahKamar" name="jumlah_kamar" placeholder="Masukkan Jumlah Kamar" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kamarTersedia" class="form-label">Kamar Tersedia</label>
                                        <input type="number" class="form-control" id="kamarTersedia" name="kamar_tersedia" placeholder="Masukkan Kamar Tersedia" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah Kamar</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>
