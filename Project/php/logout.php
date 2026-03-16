<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi
header("Location: ../html/login.html"); // Arahkan ke halaman login
exit();
?>
