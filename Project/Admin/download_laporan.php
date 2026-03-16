<?php
// Sertakan file library FPDF
require(__DIR__ . '/libs/fpdf.php'); // Pastikan path ini sesuai dengan lokasi file fpdf.php Anda

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

// Periksa apakah ID (no) diterima dari parameter URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID adalah angka

    // Query untuk mendapatkan laporan berdasarkan ID
    $sql = "SELECT * FROM laporan WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Buat instance FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Tambahkan header
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(33, 37, 41); // Warna teks hitam
        $pdf->Cell(0, 10, 'Laporan Transaksi', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'WEKA Hotel', 0, 1, 'C');
        $pdf->Ln(10);

        // Tambahkan garis pemisah
        $pdf->SetDrawColor(50, 50, 50); // Warna garis abu-abu gelap
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10, 30, 200, 30);
        $pdf->Ln(10);

        // Tambahkan informasi laporan dengan tata letak tabel
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(230, 230, 230); // Warna latar abu-abu terang
        $pdf->Cell(50, 10, 'Nomor Laporan:', 1, 0, 'L', true);
        $pdf->Cell(130, 10, $row['no'], 1, 1, 'L');
        $pdf->Cell(50, 10, 'Bulan:', 1, 0, 'L', true);
        $pdf->Cell(130, 10, $row['bulan'], 1, 1, 'L');
        $pdf->Cell(50, 10, 'Tahun:', 1, 0, 'L', true);
        $pdf->Cell(130, 10, $row['tahun'], 1, 1, 'L');
        $pdf->Cell(50, 10, 'Jumlah Transaksi:', 1, 0, 'L', true);
        $pdf->Cell(130, 10, $row['jumlah_transaksi'], 1, 1, 'L');
        $pdf->Cell(50, 10, 'Total Pendapatan:', 1, 0, 'L', true);
        $pdf->Cell(130, 10, 'Rp ' . number_format($row['pendapatan'], 2, ',', '.'), 1, 1, 'L');

        // Tambahkan footer
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetTextColor(100, 100, 100); // Warna teks abu-abu
        $pdf->Cell(0, 10, 'Generated on: ' . date('d-m-Y H:i:s'), 0, 1, 'R');

        // Output file PDF
        $filename = "laporan_" . $row['bulan'] . "_" . $row['tahun'] . ".pdf";
        $pdf->Output('D', $filename); // 'D' untuk mengunduh file langsung
    } else {
        echo "Laporan tidak ditemukan.";
    }

    $stmt->close();
} else {
    echo "ID laporan tidak ditemukan.";
}

$conn->close();
?>
