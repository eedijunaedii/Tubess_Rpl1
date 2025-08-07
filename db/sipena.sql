-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2025 at 02:13 PM
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
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id_bayar` bigint(50) NOT NULL,
  `nominal_uang` bigint(50) NOT NULL,
  `total_bayar` bigint(50) NOT NULL,
  `waktu_bayar` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
(2506231806967, 4800000, 4300000, '2025-06-27 01:40:18.000000'),
(2506231810611, 235000, 230000, '2025-08-06 04:50:57.526529'),
(2506231813114, 3600000, 3500000, '2025-06-27 01:42:21.103489'),
(2506231816792, 50000, 40000, '0000-00-00 00:00:00.000000'),
(2506241732425, 800000, 700000, '0000-00-00 00:00:00.000000'),
(2506241843110, 1200000, 115000, '0000-00-00 00:00:00.000000'),
(2506270850186, 43215000, 43210000, '2025-06-27 02:01:12.837518'),
(2506271249529, 1201000, 1200000, '2025-06-27 05:50:36.992438'),
(2506271328334, 1000000, 960000, '2025-08-06 04:41:16.428973'),
(2507030813931, 850000, 820000, '2025-07-03 01:14:14.189429'),
(2507080700993, 22000, 20000, '2025-08-06 04:37:33.455616'),
(2508061135670, 121000, 120000, '2025-08-06 04:36:30.835050'),
(2508061229687, 400000, 360000, '2025-08-06 05:32:29.876257'),
(2508061245539, 1000000, 960000, '2025-08-06 05:48:52.076167');

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

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id_kat_menu` int(11) NOT NULL,
  `jenis_menu` int(1) NOT NULL,
  `kategori_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_kat_menu`, `jenis_menu`, `kategori_menu`) VALUES
(2, 1, 'Es'),
(3, 2, 'Herbal'),
(4, 2, 'Tradisional'),
(5, 2, 'Kopi'),
(10, 1, 'Nasi'),
(11, 1, 'Sayuran'),
(12, 1, 'Lauk Pauk'),
(13, 1, 'Cemilan');

-- --------------------------------------------------------

--
-- Table structure for table `list_order`
--

CREATE TABLE `list_order` (
  `id_list_order` int(10) NOT NULL,
  `menu` int(10) NOT NULL,
  `kode_order` bigint(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `catatan` varchar(1000) NOT NULL,
  `status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_order`
--

INSERT INTO `list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `catatan`, `status`) VALUES
(7, 35, 2506231816792, 2, 'sasasas', 2),
(8, 34, 2506231816792, 2, 'sdsdsdsd', 2),
(10, 38, 2506231806967, 1, 'fsfsfsf', 2),
(11, 39, 2506231806967, 2, 'sdsdadsad', 2),
(12, 37, 2506231806967, 4, 'dfsdsfdfssdffd', 2),
(14, 39, 2506231813114, 10, 'asadsads', 2),
(17, 39, 2506241732425, 2, 'sdsdsdsd', 2),
(18, 35, 2506241843110, 4, 'ddfdf', 2),
(19, 37, 2506241843110, 3, 'sdfsdf', 2),
(20, 31, 2506270850186, 8, 'KITA INI NEGARA BESARRRR', 0),
(21, 37, 2506270850186, 10, 'yang garing bosss', 1),
(22, 38, 2506270850186, 12, 'mantap', 1),
(24, 31, 2506271249529, 10, 'dfsffdsffd', 0),
(25, 31, 2506271328334, 8, 'jjjj', 0),
(26, 39, 2507030813931, 2, 'asdfgg', 0),
(27, 31, 2507030813931, 1, 'asdsff', 0),
(28, 35, 2507080700993, 2, 'aaa', 0),
(29, 36, 2508061135670, 2, 'yang mantap', 0),
(30, 35, 2508061135670, 2, 'cendolll', 0),
(31, 35, 2506231810611, 23, 'asdsa', 2),
(32, 35, 2508061229687, 12, 'awwwww', 0),
(33, 31, 2508061229687, 2, 'asdd', 0),
(34, 31, 2508061245539, 8, 'bakar kering ya', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepuasan_pelanggan`
--

CREATE TABLE `tb_kepuasan_pelanggan` (
  `id` int(11) NOT NULL,
  `kode_order` bigint(50) NOT NULL,
  `rating_makanan` int(11) NOT NULL,
  `rating_pelayanan` int(11) NOT NULL,
  `komentar` varchar(500) NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kepuasan_pelanggan`
--

INSERT INTO `tb_kepuasan_pelanggan` (`id`, `kode_order`, `rating_makanan`, `rating_pelayanan`, `komentar`, `waktu_submit`) VALUES
(1, 2507030813931, 5, 4, 'mantap', '2025-07-03 01:14:26'),
(2, 2506231810611, 5, 5, 'mantapppp', '2025-08-06 04:51:06'),
(3, 2508061229687, 5, 5, 'jossss\r\n', '2025-08-06 05:32:41'),
(4, 2508061245539, 5, 5, 'bagusss', '2025-08-06 05:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` bigint(50) NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `meja` int(10) NOT NULL,
  `pelayan` int(100) NOT NULL,
  `waktu_order` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `pelanggan`, `meja`, `pelayan`, `waktu_order`) VALUES
(2506231806967, 'dono lino', 29, 2, '2025-06-26 01:51:06.44274'),
(2506231810611, 'sdsds metronomsddddd', 22, 2, '2025-06-24 11:47:44.78954'),
(2506231811722, 'ddsdsdsds', 122, 2, '2025-06-23 23:13:01.31186'),
(2506231813114, 'sdaasdasd', 129, 2, '2025-06-23 23:13:01.31186'),
(2506231816792, 'asdasdasd', 78, 2, '2025-06-23 23:13:01.31186'),
(2506241732425, 'dongo', 333, 2, '2025-06-24 10:32:28.74311'),
(2506241843110, 'dfdf', 44, 2, '2025-06-24 11:44:31.02715'),
(2506270850186, 'samsul suryono 1', 1111, 2, '2025-06-27 01:56:55.34700'),
(2506271249529, 'jomet', 1999, 2, '2025-06-27 05:50:00.39996'),
(2506271328334, 'ari', 22, 3, '2025-06-27 06:28:54.91005'),
(2507030813931, 'mario', 123, 1, '2025-07-03 01:13:41.66665'),
(2507080700993, 'asdf', 2, 2, '2025-07-08 00:00:56.67322'),
(2508061135670, 'mail', 14, 2, '2025-08-06 04:35:34.70302'),
(2508061229687, 'joni', 12, 3, '2025-08-06 05:29:43.47432'),
(2508061245539, 'patricio', 99, 3, '2025-08-06 05:46:31.41195');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(1) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `nama`, `nohp`, `alamat`) VALUES
(1, 'abcada5@abc.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'abc ada5', '1234567891011', 'jalan wakwaw ceria no.18'),
(2, 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'BahlilIreng', '0895339601933', 'uganda bagian tengah timur barat\r\n'),
(3, 'abc2@abc.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 'abc2', '1234567891011', ''),
(4, 'abc3@abc.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, 'abc3', '1234567891011', ''),
(16, 'mamat@mat.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 'mamat', '0898983423', 'dsdvdvsdvsddvs'),
(17, 'dududu@duu.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 'adsad', '083403432434', '23 street'),
(19, 'dududu@duu.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 'adsad', '083403432434', '23 street');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori_menu` (`kategori`);

--
-- Indexes for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id_kat_menu`);

--
-- Indexes for table `list_order`
--
ALTER TABLE `list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `FKMenu` (`menu`),
  ADD KEY `FKOrder` (`kode_order`);

--
-- Indexes for table `tb_kepuasan_pelanggan`
--
ALTER TABLE `tb_kepuasan_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kep_pelanggan` (`kode_order`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK1` (`pelayan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_kat_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `list_order`
--
ALTER TABLE `list_order`
  MODIFY `id_list_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_kepuasan_pelanggan`
--
ALTER TABLE `tb_kepuasan_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  ADD CONSTRAINT `fk_kategori_menu` FOREIGN KEY (`kategori`) REFERENCES `kategori_menu` (`id_kat_menu`) ON UPDATE CASCADE;

--
-- Constraints for table `list_order`
--
ALTER TABLE `list_order`
  ADD CONSTRAINT `FKMenu` FOREIGN KEY (`menu`) REFERENCES `daftar_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FKOrder` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_kepuasan_pelanggan`
--
ALTER TABLE `tb_kepuasan_pelanggan`
  ADD CONSTRAINT `fk_kep_pelanggan` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`pelayan`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
