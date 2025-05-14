-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 02:37 PM
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
-- Database: `pbweb_mp`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `gambar` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga_produk`, `gambar`) VALUES
(1, 'Kabel Charger Type-C', 'Kabel pengisian daya dan transfer data dengan konektor Type C', 77000, NULL),
(2, 'Kabel Charger MicroUSB', 'Kabel untuk perangkat dengan port MicroUSB', 32000, NULL),
(3, 'Kabel Charger Lightning', 'Kabel untuk perangkat apple dengan port lightning', 12500, NULL),
(4, 'Softcase Silikon', 'Casing fleksibel yang ringan dan mudah dipasang', 48000, NULL),
(5, 'Hardcase Armor', 'Casing kokoh dengan desain rugged dan memberikan perlindungan ekstra', 93000, NULL),
(6, 'Earphone Buddy Cable', 'Perangkat audio kecil dan ringan untuk aktivitas sehari-hari', 32000, NULL),
(7, 'Earphone Sumsing Bluetooth', 'Perangkat audio kecil dan ringan dengan bluetooth', 41000, NULL),
(8, 'Headset Gaming', 'Headset kualitas tinggi untuk gaming', 178000, NULL),
(9, 'Gantungan Kunci HP Aesthetic Korean', 'Aksesoris gantungan kunci aesthetic korean', 10000, NULL),
(10, 'Gantungan Kunci HP Liontin', 'Aksesoris gantungan kunci liontin', 3000, NULL),
(11, 'Powerbank 10.000 mAh', 'Kapasitas 10.000 mAh', 248000, NULL),
(12, 'Powerbank 30.000 mAh', 'Kapasitas 30.000 mAh', 525000, NULL),
(13, 'PopSocket', 'Penyangga atau pegangan ponsel', 43000, NULL),
(14, 'Holder Mobil', 'Penyangga ponsel untuk mobil', 68000, NULL),
(15, 'Tempered Glass', 'Pelindung layar (keras) dan kuat', 40000, NULL),
(16, 'Matte Glass', 'Pelindung layar matte yang dapat mengurangi pantulan cahaya dan sidik jari', 67000, NULL),
(17, 'Hydrogel', 'Pelindung layar fleksibel dan menyesuaikan kontur layar lengkung', 32000, NULL),
(18, 'Matte Hydrogel', 'Kombinasi hydrogel dan permukaan matte dengan memberikan kenyamanan visual', 46000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `total`) VALUES
(5, '2025-05-13 15:17:13', 166500),
(6, '2025-05-13 15:19:09', 35000),
(7, '2025-05-14 10:40:43', 231000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_produk`, `nama_produk`, `harga`, `qty`, `subtotal`) VALUES
(3, 5, 1, 'Kabel Charger Type-C', 77000, 2, 154000),
(4, 5, 3, 'Kabel Charger Lightning', 12500, 1, 12500),
(5, 6, 2, 'Kabel Charger MicroUSB', 32000, 1, 32000),
(6, 6, 10, 'Gantungan Kunci HP Liontin', 3000, 1, 3000),
(7, 7, 1, 'Kabel Charger Type-C', 77000, 3, 231000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
