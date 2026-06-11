-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2026 at 03:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi-user`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `id_daftar` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `status_periksa` enum('menunggu','selesai','batal') DEFAULT 'menunggu',
  `waktu_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar`
--

INSERT INTO `daftar` (`id_daftar`, `id_pasien`, `id_dokter`, `tanggal_periksa`, `nomor_antrian`, `status_periksa`, `waktu_daftar`) VALUES
(1, 1, 10, '2026-06-02', 1, 'menunggu', '2026-06-02 12:34:02'),
(2, 1, 10, '2026-06-02', 2, 'menunggu', '2026-06-02 12:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(10) NOT NULL,
  `nama_dokter` varchar(75) NOT NULL,
  `foto_dokter` varchar(255) DEFAULT NULL,
  `alamat_dokter` varchar(150) NOT NULL,
  `nohp_dokter` varchar(12) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `keterangan_dokter` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `foto_dokter`, `alamat_dokter`, `nohp_dokter`, `id_poli`, `keterangan_dokter`) VALUES
(10, 'andika', 'dokter-2.png', 'ajbdiawvavha', '0817262727', 3, 'Ada');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `alamat_pasien` varchar(255) DEFAULT NULL,
  `noktp_pasien` varchar(20) DEFAULT NULL,
  `nohp_pasien` varchar(20) DEFAULT NULL,
  `norm_pasien` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `alamat_pasien`, `noktp_pasien`, `nohp_pasien`, `norm_pasien`) VALUES
(1, 'pasien', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id_poli` int(10) NOT NULL,
  `nama_poli` varchar(75) NOT NULL,
  `keterangan_poli` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id_poli`, `nama_poli`, `keterangan_poli`) VALUES
(1, 'Poli Umum', 'Melayani pemeriksaan kesehatan umum'),
(2, 'Poli Gigi', 'Melayani pemeriksaan dan perawatan gigi'),
(3, 'Poli Anak', 'Melayani kesehatan dan pemeriksaan anak'),
(4, 'Poli Kandungan', 'Melayani pemeriksaan ibu hamil dan kandungan'),
(5, 'Poli THT', 'Melayani pemeriksaan telinga hidung tenggorokan'),
(6, 'Poli Mata', 'Melayani pemeriksaan kesehatan mata'),
(7, 'Poli Jantung', 'Melayani pemeriksaan spesialis jantung'),
(8, 'Poli Saraf', 'Melayani pemeriksaan sistem saraf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(5, 'admin', 'admin', 'admin', 'admin'),
(6, 'dokter', 'dokter', 'dokter', 'dokter'),
(7, 'pasien', 'pasien', 'pasien', 'pasien'),
(8, 'aaa', 'aaa', 'aaa', 'admin'),
(9, 'a', 'a', 'a', 'admin'),
(11, 'andika', 'c', 'c', 'dokter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar`
--
ALTER TABLE `daftar`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id_poli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id_poli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
