-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 03:27 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl1b_deaapriani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(100) DEFAULT NULL,
  `jadwal_tayang` datetime DEFAULT NULL,
  `jumlah_kursi` int DEFAULT NULL,
  `harga_dasar_tiket` int DEFAULT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') DEFAULT NULL,
  `tipe_audio` varchar(100) DEFAULT NULL,
  `lokasi_baris` varchar(50) DEFAULT NULL,
  `kacamata_3d_id` varchar(50) DEFAULT NULL,
  `efek_gerak_fitur` varchar(100) DEFAULT NULL,
  `bantal_selimut_pack` varchar(100) DEFAULT NULL,
  `layanan_butler` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers Endgame', '2026-07-01 13:00:00', 2, 50000, 'Regular', 'Dolby Atmos', 'A1', NULL, NULL, NULL, NULL),
(2, 'Spider Man No Way Home', '2026-07-01 15:00:00', 3, 50000, 'Regular', 'Dolby Atmos', 'B2', NULL, NULL, NULL, NULL),
(3, 'Interstellar', '2026-07-02 14:00:00', 1, 50000, 'Regular', 'Stereo', 'A3', NULL, NULL, NULL, NULL),
(4, 'Joker', '2026-07-02 17:00:00', 2, 50000, 'Regular', 'Stereo', 'C1', NULL, NULL, NULL, NULL),
(5, 'The Batman', '2026-07-03 13:00:00', 4, 50000, 'Regular', 'Dolby Atmos', 'B3', NULL, NULL, NULL, NULL),
(6, 'Inception', '2026-07-03 19:00:00', 2, 50000, 'Regular', 'Stereo', 'A2', NULL, NULL, NULL, NULL),
(7, 'Frozen II', '2026-07-04 12:00:00', 3, 50000, 'Regular', 'Dolby Atmos', 'D1', NULL, NULL, NULL, NULL),
(8, 'Avatar 2', '2026-07-01 18:00:00', 2, 75000, 'IMAX', NULL, NULL, '3D001', 'Motion Seat', NULL, NULL),
(9, 'Dune Part Two', '2026-07-02 20:00:00', 3, 75000, 'IMAX', NULL, NULL, '3D002', 'Motion Seat', NULL, NULL),
(10, 'Transformers', '2026-07-03 15:00:00', 1, 75000, 'IMAX', NULL, NULL, '3D003', 'Vibration', NULL, NULL),
(11, 'Godzilla x Kong', '2026-07-04 17:00:00', 2, 75000, 'IMAX', NULL, NULL, '3D004', 'Motion Seat', NULL, NULL),
(12, 'Top Gun Maverick', '2026-07-05 14:00:00', 4, 75000, 'IMAX', NULL, NULL, '3D005', 'Vibration', NULL, NULL),
(13, 'Doctor Strange', '2026-07-06 16:00:00', 2, 75000, 'IMAX', NULL, NULL, '3D006', 'Motion Seat', NULL, NULL),
(14, 'Aquaman', '2026-07-06 19:00:00', 3, 75000, 'IMAX', NULL, NULL, '3D007', 'Motion Seat', NULL, NULL),
(15, 'Titanic', '2026-07-01 19:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium Pack', 'Yes'),
(16, 'La La Land', '2026-07-02 20:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium Pack', 'Yes'),
(17, 'The Notebook', '2026-07-03 18:00:00', 3, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium Pack', 'Yes'),
(18, 'Me Before You', '2026-07-04 19:00:00', 1, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium Pack', 'Yes'),
(19, 'Five Feet Apart', '2026-07-05 20:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium Pack', 'Yes'),
(20, 'The Fault in Our Stars', '2026-07-06 17:00:00', 3, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium Pack', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
