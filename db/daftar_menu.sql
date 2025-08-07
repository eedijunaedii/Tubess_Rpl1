-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2025 at 02:24 PM
-- Server version: 11.4.7-MariaDB-cll-lve
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipc8746_db_pak_resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_menu`
--

CREATE TABLE `daftar_menu` (
  `id` int(10) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nama_menu` varchar(2000) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `kategori` int(5) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `stok` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_menu`
--

INSERT INTO `daftar_menu` (`id`, `foto`, `nama_menu`, `keterangan`, `kategori`, `harga`, `stok`) VALUES
(31, '64934-ayam.jpg', 'Ayam Bakar', 'Ayam Bakar Uganda lezat tiada lawan', 12, '120000', 12),
(34, '15715-bandrek.jpeg', 'Bandrek ', 'Bandrek Penghangat Dikala Hujan', 3, '10000', 100),
(35, '10178-cendol.jpg', 'Cendol ', 'Cendol Segar dan Legit', 4, '10000', 111),
(36, '49948-liwet.jpg', 'Nasi Liwet Boboko', 'Nasi Liwet Boboko Dengan Citarasa Khas Sunda', 10, '50000', 122),
(37, '38671-51633-nila.jpeg', 'Ikan Nila Goreng', 'Nila Garing Dengan Bumbu Khas', 12, '25000', 12),
(38, '33949-44840-paket_bancakan.jpg', 'Liwet Paket Botram', 'Liwet Paket Botram bisa untuk 10 orang', 10, '600000', 121),
(39, '86493-paket_keluarga.png', 'Liwet Paket Keluarga', 'Paket Keluarga Cemara bisa untuk 4-5 orang', 10, '350000', 1222),
(41, '86642-gehu.jpg', 'Gehu', 'Gehu adalah tahu dengan isian sayur-sayuran, tersedia varian pedas dan original', 13, '2500', 100),
(42, '93438-cirengg.jpg', 'Cireng', 'Aci digoreng, jajanan khas yang renyah di luar dan kenyal di dalam. Disajikan dengan bumbu rujak pedas manis.', 13, '2500', 100),
(43, '75959-pisgor.jpg', 'Pisang Goreng Keju', 'Pisang goreng hangat dengan taburan keju parut dan susu kental manis, cemilan manis yang cocok untuk sore hari.', 13, '15000', 100),
(44, '86074-cincauijo.jpg', 'Es Cincau Hijau', 'Potongan cincau hijau lembut disajikan dengan santan dan gula merah cair, sangat menyegarkan.', 2, '15000', 100),
(45, '92654-kelapa.jpg', 'Es Kelapa', 'Potongan kelapa muda segar dengan airnya, disajikan dengan sedikit gula. Minuman pelepas dahaga yang alami.', 2, '15000', 100),
(46, '53799-karedok.jpg', 'Karedok', 'Salad khas Sunda yang terdiri dari sayuran mentah segar disiram dengan bumbu kacang yang gurih.', 11, '20000', 15),
(47, '46477-gepuk.jpg', 'Gepuk', 'Daging sapi iris tipis yang diungkep dengan bumbu manis gurih, digoreng hingga kering namun tetap empuk.', 12, '25000', 100),
(48, '22906-22027-bandrek.jpeg', 'bandrek tess', 'bandrek tess', 3, '20000', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori_menu` (`kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  ADD CONSTRAINT `fk_kategori_menu` FOREIGN KEY (`kategori`) REFERENCES `kategori_menu` (`id_kat_menu`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
