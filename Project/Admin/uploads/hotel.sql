-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 11:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `no` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`no`, `username`, `email`, `no_telpon`, `password`, `action`) VALUES
(8, 'dimas', 'masaji@gmail.com', '111', '$2y$10$pm4061hZScMbm6swVFDOL.32IjNsnJAX.6kSzv30Mbus8bxASSj22', 'Admin'),
(9, 'bayu', 'bayu@gmail.com', '12345', '$2y$10$S28hcHOtE2oftA.yXqia1.D0YvupOhZL/kz/1P4mJx4WOmtgWyzVy', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `no` int(11) NOT NULL,
  `jenis_kamar` varchar(50) NOT NULL,
  `harga_kamar` decimal(10,2) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `kamar_tersedia` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`no`, `jenis_kamar`, `harga_kamar`, `jumlah_kamar`, `kamar_tersedia`, `action`) VALUES
(1, 'Regular Room', 1000000.00, 10, 10, NULL),
(2, 'VIP Room', 2000000.00, 10, 10, NULL),
(3, 'Executive Room', 3000000.00, 10, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `no` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `pendapatan` decimal(15,2) NOT NULL,
  `action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_checkin`
--

CREATE TABLE `status_checkin` (
  `checkinID` int(11) NOT NULL,
  `roomType` varchar(50) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('checked_in','checked_out','pending','konfirmasi') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_checkin`
--

INSERT INTO `status_checkin` (`checkinID`, `roomType`, `fullName`, `email`, `phone`, `checkIn`, `checkOut`, `createdAt`, `status`) VALUES
(21, 'Executive', 'aji', 'yxkata7@gmail.com', '089699980706', '2025-01-11', '2025-01-14', '2025-01-11 09:32:08', 'checked_in');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `jenis_kamar` varchar(50) NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `konfirmasi_pesanan` varchar(20) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no`, `username`, `email`, `no_telpon`, `password`, `action`) VALUES
(8, 'teja', 'dimasajis43@gmail.com', '111', '$2y$10$ui9Xdj/cAVnrw6n7Sr96A...NxDsRncWMGeZ0qbWHTPqUjRchdkK2', NULL),
(9, 'dimas', 'dimasajis43@gmail.com', '12345', '$2y$10$8qcmDZ3Ke1vzSpcaMq4/EuYg8LHbI6yZ5MHHvjBJ5fuuF25AdEJ1u', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `status_checkin`
--
ALTER TABLE `status_checkin`
  ADD PRIMARY KEY (`checkinID`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_checkin`
--
ALTER TABLE `status_checkin`
  MODIFY `checkinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
