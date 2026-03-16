<?php
// Include file koneksi
include_once 'koneksi.php';

// Query untuk mengambil data dari tabel data_user
$sql = "SELECT no, username, email, no_telpon, password FROM user";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>
        <link rel="stylesheet" href="../css/user.css">
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
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 ">
                            <h2>User</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No Telpon</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        $no = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $no++ . "</td>
                                                    <td>" . htmlspecialchars($row['username']) . "</td>
                                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                                    <td>" . htmlspecialchars($row['no_telpon']) . "</td>
                                                    <td>" . htmlspecialchars($row['password']) . "</td>
                                                    <td>
                                                        <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal" . $row['no'] . "'>Edit</button>
                                                        <a href='delete_user.php?id=" . $row['no'] . "' class='btn btn-danger' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a>
                                                    </td>
                                                    </tr>";

                                            // Modal for Editing User
                                            echo "
                                            <div class='modal fade' id='editModal" . $row['no'] . "' tabindex='-1' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Edit User</h5>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                                        </div>
                                                        <form action='update_user.php' method='POST'>
                                                            <div class='modal-body'>
                                                                <input type='hidden' name='id' value='" . $row['no'] . "'>
                                                                <div class='mb-3'>
                                                                    <label class='form-label'>Username</label>
                                                                    <input type='text' class='form-control' name='username' value='" . htmlspecialchars($row['username']) . "' required>
                                                                </div>
                                                                <div class='mb-3'>
                                                                    <label class='form-label'>Email</label>
                                                                    <input type='email' class='form-control' name='email' value='" . htmlspecialchars($row['email']) . "' required>
                                                                </div>
                                                                <div class='mb-3'>
                                                                    <label class='form-label'>No Telpon</label>
                                                                    <input type='tel' class='form-control' name='no_telpon' value='" . htmlspecialchars($row['no_telpon']) . "' required>
                                                                </div>
                                                                <div class='mb-3'>
                                                                    <label class='form-label'>Password Baru</label>
                                                                    <input type='password' class='form-control' name='password' placeholder='Isi jika ingin mengubah password'>
                                                                </div>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                                                                <button type='submit' class='btn btn-primary'>Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </body>
</html>
