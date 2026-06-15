-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2026 at 06:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_ti1c_jhozyretnosari`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(255) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(100) DEFAULT NULL,
  `lokasi_baris` varchar(10) DEFAULT NULL,
  `kacamata_3d_id` varchar(50) DEFAULT NULL,
  `efek_gerak_fitur` tinyint(1) DEFAULT NULL,
  `bantal_selimut_pack` tinyint(1) DEFAULT NULL,
  `layanan_butler` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Spider-Man: Beyond', '2026-06-15 13:00:00', 120, '45000.00', 'Regular', 'Dolby Digital', 'F', NULL, NULL, NULL, NULL),
(2, 'Spider-Man: Beyond', '2026-06-15 15:30:00', 120, '45000.00', 'Regular', 'Dolby Digital', 'G', NULL, NULL, NULL, NULL),
(3, 'Fast X: Part 2', '2026-06-15 12:00:00', 150, '45000.00', 'Regular', 'Dolby Surround', 'H', NULL, NULL, NULL, NULL),
(4, 'Fast X: Part 2', '2026-06-15 14:30:00', 150, '45000.00', 'Regular', 'Dolby Surround', 'A', NULL, NULL, NULL, NULL),
(5, 'The Batman 2', '2026-06-16 18:00:00', 100, '50000.00', 'Regular', 'Dolby Atmos', 'C', NULL, NULL, NULL, NULL),
(6, 'The Batman 2', '2026-06-16 20:30:00', 100, '50000.00', 'Regular', 'Dolby Atmos', 'D', NULL, NULL, NULL, NULL),
(7, 'Inside Out 2', '2026-06-17 10:00:00', 80, '40000.00', 'Regular', 'Standard', 'E', NULL, NULL, NULL, NULL),
(8, 'Inside Out 2', '2026-06-17 12:30:00', 80, '40000.00', 'Regular', 'Standard', 'B', NULL, NULL, NULL, NULL),
(9, 'Dune: Part Three', '2026-06-18 14:00:00', 250, '85000.00', 'IMAX', 'IMAX 12-Track', 'J', 'GLS-3D-001', 1, NULL, NULL),
(10, 'Dune: Part Three', '2026-06-18 17:00:00', 250, '85000.00', 'IMAX', 'IMAX 12-Track', 'K', 'GLS-3D-002', 1, NULL, NULL),
(11, 'Avatar 3', '2026-06-19 13:00:00', 300, '95000.00', 'IMAX', 'IMAX Immersive', 'L', 'GLS-3D-105', 0, NULL, NULL),
(12, 'Avatar 3', '2026-06-19 16:30:00', 300, '95000.00', 'IMAX', 'IMAX Immersive', 'M', 'GLS-3D-106', 0, NULL, NULL),
(13, 'Avengers: Secret Wars', '2026-06-20 18:00:00', 280, '90000.00', 'IMAX', 'IMAX 12-Track', 'I', 'GLS-3D-201', 1, NULL, NULL),
(14, 'Avengers: Secret Wars', '2026-06-20 21:30:00', 280, '90000.00', 'IMAX', 'IMAX 12-Track', 'H', 'GLS-3D-202', 1, NULL, NULL),
(15, 'Romeo & Juliet', '2026-06-21 19:00:00', 40, '150000.00', 'Velvet', 'Dolby Atmos', 'A', NULL, NULL, 1, 1),
(16, 'Romeo & Juliet', '2026-06-21 21:30:00', 40, '150000.00', 'Velvet', 'Dolby Atmos', 'B', NULL, NULL, 1, 1),
(17, 'The Great Gatsby', '2026-06-22 18:30:00', 30, '160000.00', 'Velvet', 'Dolby Surround 7.1', 'C', NULL, NULL, 1, 1),
(18, 'The Great Gatsby', '2026-06-22 21:00:00', 30, '160000.00', 'Velvet', 'Dolby Surround 7.1', 'D', NULL, NULL, 1, 1),
(19, 'Titanic: Remastered', '2026-06-23 16:00:00', 50, '140000.00', 'Velvet', 'Dolby Atmos', 'E', NULL, NULL, 1, 1),
(20, 'Titanic: Remastered', '2026-06-23 19:30:00', 50, '140000.00', 'Velvet', 'Dolby Atmos', 'F', NULL, NULL, 1, 1);

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
