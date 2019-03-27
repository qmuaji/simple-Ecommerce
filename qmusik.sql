-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.5.39 - MySQL Community Server (GPL)
-- OS Server:                    Win32
-- HeidiSQL Versi:               8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table qmusik.bank
CREATE TABLE IF NOT EXISTS `bank` (
  `bankID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `norek` char(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bankID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.bank: ~3 rows (approximately)
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` (`bankID`, `nama`, `norek`) VALUES
	(1, 'Mandiri', '123-321-123'),
	(2, 'BAC', '234-432-234'),
	(3, 'BNI', '432-543-543');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;


-- Dumping structure for table qmusik.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `brgID` int(11) NOT NULL AUTO_INCREMENT,
  `kategoriID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hrg` int(10) unsigned NOT NULL,
  `berat` int(11) unsigned NOT NULL,
  `stok` int(11) unsigned NOT NULL,
  `desk` text NOT NULL,
  `images_name` varchar(255) NOT NULL,
  PRIMARY KEY (`brgID`),
  UNIQUE KEY `nama` (`nama`),
  KEY `FK_barang_kategori` (`kategoriID`),
  CONSTRAINT `FK_barang_kategori` FOREIGN KEY (`kategoriID`) REFERENCES `kategori` (`kategoriID`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.barang: ~10 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`brgID`, `kategoriID`, `nama`, `hrg`, `berat`, `stok`, `desk`, `images_name`) VALUES
	(1, 19, 'PickUp P bass (Symor Ducan)', 200000, 4, 12, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', 'DSPB3.jpg'),
	(56, 18, 'Stombox BB', 400000, 4, 16, 'Stombox for blues guitar Recomended', 'be1.jpg'),
	(57, 18, 'Multi Stombox Zoom', 450000, 4, 11, 'Multi Stomp Zoom dari zoom , Stereo Output', 'be2.jpg'),
	(58, 20, 'Ludwig Drum', 5000000, 8, 13, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', 'd1.jpg'),
	(61, 17, 'Gibson GA 341', 2500000, 3, 10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', 'ga1.jpg'),
	(62, 17, 'Taylor CW03', 2000000, 7, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', 'ga3.jpg'),
	(63, 19, 'Ibanez Sound Gear x2', 4000000, 3, 5, 'Ibanez Siund Gear For Your Performance', 'geb1.jpg'),
	(64, 27, 'Focusrite Scarlet i2i Pack', 3000000, 2, 11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', 'sc1.jpg'),
	(65, 17, 'Yamaha AC 0dx3', 150000, 2, 10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', 'ga4.jpg'),
	(67, 21, 'Yamaha 606 Live', 450000, 4, 22, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam fugit maiores voluptate a beatae similique ullam provident magnam illum maxime corporis doloremque ipsam, architecto aspernatur dignissimos sint est natus.', '65060_l.jpg');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;


-- Dumping structure for table qmusik.buku_tamu
CREATE TABLE IF NOT EXISTS `buku_tamu` (
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buku_tamuID` int(11) NOT NULL AUTO_INCREMENT,
  `view` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`buku_tamuID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.buku_tamu: ~6 rows (approximately)
/*!40000 ALTER TABLE `buku_tamu` DISABLE KEYS */;
INSERT INTO `buku_tamu` (`nama`, `email`, `komentar`, `tanggal`, `buku_tamuID`, `view`) VALUES
	('Setya Prana', 'muasi@muaji.com', 'Testing komentar di Qmusik Shop', '2015-06-29 01:10:12', 1, 'N'),
	('Setya Prana', 'muasi@muaji.com', 'komentar lagi ah', '2015-06-29 01:10:52', 2, 'Y'),
	('Dudung', 'dudung@gmail.com', 'keren lah lumayan', '2015-06-29 01:30:55', 3, 'Y'),
	('muaji', 'risky@gmail.co.id', 'ada souncard 2jt an ga ?', '2015-06-29 23:29:00', 4, 'N'),
	('dono', 'sadasd@asd.com', 'tetsetststs', '2015-07-01 03:02:03', 5, 'Y'),
	('dono', 'sadasd@asd.com', 'tesssssssttt', '2015-07-01 03:02:41', 6, 'Y');
/*!40000 ALTER TABLE `buku_tamu` ENABLE KEYS */;


-- Dumping structure for table qmusik.jenisbarang
CREATE TABLE IF NOT EXISTS `jenisbarang` (
  `jenisID` int(10) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `desc` text,
  `images_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jenisID`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.jenisbarang: ~4 rows (approximately)
/*!40000 ALTER TABLE `jenisbarang` DISABLE KEYS */;
INSERT INTO `jenisbarang` (`jenisID`, `nama`, `desc`, `images_name`) VALUES
	(1, 'Gitar', NULL, '1429317154670px-Make-an-Acoustic-Guitar-Sound-Like-an-Electric-Guitar-Step-4.jpg'),
	(2, 'Bass', NULL, 'acoustic 4.jpeg'),
	(3, 'Drum', NULL, 'd4.jpg'),
	(4, 'Accessory', NULL, 'I_IJXB150B_bass_accessories.jpg');
/*!40000 ALTER TABLE `jenisbarang` ENABLE KEYS */;


-- Dumping structure for table qmusik.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `kategoriID` int(100) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) NOT NULL,
  `jenisID` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kategoriID`),
  UNIQUE KEY `kategori` (`kategori`),
  KEY `FK_kategori_jenisbarang` (`jenisID`),
  CONSTRAINT `FK_kategori_jenisbarang` FOREIGN KEY (`jenisID`) REFERENCES `jenisbarang` (`jenisID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.kategori: ~8 rows (approximately)
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`kategoriID`, `kategori`, `jenisID`) VALUES
	(17, 'Acoustic Guitar', 1),
	(18, 'Electrict Guitar', 1),
	(19, 'Electrict Bass', 2),
	(20, 'Acoustic Drum', 3),
	(21, 'Mixer', 4),
	(22, 'Acoustic Bass', 2),
	(25, 'Electrict Drum', 3),
	(27, 'Sound Card', 4);
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;


-- Dumping structure for table qmusik.komentar
CREATE TABLE IF NOT EXISTS `komentar` (
  `transaksi_detailID` char(50) NOT NULL,
  `komentar` text,
  `user` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `FK_komentar_transaksi` (`transaksi_detailID`),
  CONSTRAINT `FK_komentar_transaksi` FOREIGN KEY (`transaksi_detailID`) REFERENCES `transaksi` (`transaksi_detailID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.komentar: ~0 rows (approximately)
/*!40000 ALTER TABLE `komentar` DISABLE KEYS */;
/*!40000 ALTER TABLE `komentar` ENABLE KEYS */;


-- Dumping structure for table qmusik.konfirmasi
CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `konfirmasiID` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_detailID` char(10) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `bank_pengirim` char(50) NOT NULL,
  `bank_tujuan` char(50) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `jumlah_transfer` int(10) unsigned NOT NULL,
  `catatan` text NOT NULL,
  PRIMARY KEY (`konfirmasiID`),
  KEY `FK_konfirmasi_transaksi_detail` (`transaksi_detailID`),
  CONSTRAINT `FK_konfirmasi_transaksi_detail` FOREIGN KEY (`transaksi_detailID`) REFERENCES `transaksi_detail` (`transaksi_detailID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.konfirmasi: ~4 rows (approximately)
/*!40000 ALTER TABLE `konfirmasi` DISABLE KEYS */;
INSERT INTO `konfirmasi` (`konfirmasiID`, `transaksi_detailID`, `nama_pengirim`, `bank_pengirim`, `bank_tujuan`, `tanggal_transfer`, `jumlah_transfer`, `catatan`) VALUES
	(17, '0907150001', 'asdasd', 'Mandiri', 'BAC 234-432-234', '2015-07-04', 4000000, ''),
	(19, '1207150001', 'Mulyadi', 'Mandiri', 'BAC 234-432-234', '2015-07-01', 2530001, ''),
	(20, '1207150002', 'Mamah erlan', 'Mandiri', 'BAC 234-432-234', '2015-07-12', 4110002, ''),
	(21, '1207150003', 'mamah erlan', 'Mandiri 3432-536346-32', 'BAC 234-432-234', '2015-07-12', 500000, '');
/*!40000 ALTER TABLE `konfirmasi` ENABLE KEYS */;


-- Dumping structure for table qmusik.kota_kab
CREATE TABLE IF NOT EXISTS `kota_kab` (
  `kokabID` int(10) NOT NULL AUTO_INCREMENT,
  `kokab_nama` varchar(30) DEFAULT NULL,
  `provinsi_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`kokabID`),
  KEY `FK_kota_kab_master_provinsi` (`provinsi_id`),
  CONSTRAINT `FK_kota_kab_master_provinsi` FOREIGN KEY (`provinsi_id`) REFERENCES `master_provinsi` (`provinsi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=503 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.kota_kab: ~388 rows (approximately)
/*!40000 ALTER TABLE `kota_kab` DISABLE KEYS */;
INSERT INTO `kota_kab` (`kokabID`, `kokab_nama`, `provinsi_id`) VALUES
	(1, 'Kabupaten Aceh Barat', 1),
	(2, 'Kabupaten Aceh Barat Daya', 1),
	(3, 'Kabupaten Aceh Besar', 1),
	(4, 'Kabupaten Aceh Jaya', 1),
	(5, 'Kabupaten Aceh Selatan', 1),
	(6, 'Kabupaten Aceh Singkil', 1),
	(7, 'Kabupaten Aceh Tamiang', 1),
	(8, 'Kabupaten Aceh Tengah', 1),
	(9, 'Kabupaten Aceh Tenggara', 1),
	(10, 'Kabupaten Aceh Timur', 1),
	(11, 'Kabupaten Aceh Utara', 1),
	(12, 'Kabupaten Bener Meriah', 1),
	(13, 'Kabupaten Bireuen', 1),
	(14, 'Kabupaten Gayo Luwes', 1),
	(15, 'Kabupaten Nagan Raya', 1),
	(16, 'Kabupaten Pidie', 1),
	(17, 'Kabupaten Pidie Jaya', 1),
	(18, 'Kabupaten Simeulue', 1),
	(19, 'Kota Banda Aceh', 1),
	(20, 'Kota Langsa', 1),
	(21, 'Kota Lhokseumawe', 1),
	(22, 'Kota Sabang', 1),
	(23, 'Kota Subulussalam', 1),
	(24, 'Kabupaten Asahan', 2),
	(25, 'Kabupaten Batubara', 2),
	(26, 'Kabupaten Dairi', 2),
	(27, 'Kabupaten Deli Serdang', 2),
	(28, 'Kabupaten Humbang Hasundutan', 2),
	(29, 'Kabupaten Karo', 2),
	(30, 'Kabupaten Labuhan Batu', 2),
	(31, 'Kabupaten Labuhanbatu Selatan', 2),
	(32, 'Kabupaten Labuhanbatu Utara', 2),
	(33, 'Kabupaten Langkat', 2),
	(34, 'Kabupaten Mandailing Natal', 2),
	(35, 'Kabupaten Nias', 2),
	(36, 'Kabupaten Nias Barat', 2),
	(37, 'Kabupaten Nias Selatan', 2),
	(38, 'Kabupaten Nias Utara', 2),
	(39, 'Kabupaten Padang Lawas', 2),
	(40, 'Kabupaten Padang Lawas Utara', 2),
	(41, 'Kabupaten Pakpak Barat', 2),
	(42, 'Kabupaten Samosir', 2),
	(43, 'Kabupaten Serdang Bedagai', 2),
	(44, 'Kabupaten Simalungun', 2),
	(45, 'Kabupaten Tapanuli Selatan', 2),
	(46, 'Kabupaten Tapanuli Tengah', 2),
	(47, 'Kabupaten Tapanuli Utara', 2),
	(48, 'Kabupaten Toba Samosir', 2),
	(49, 'Kota Binjai', 2),
	(50, 'Kota Gunung Sitoli', 2),
	(51, 'Kota Medan', 2),
	(52, 'Kota Padangsidempuan', 2),
	(53, 'Kota Pematang Siantar', 2),
	(54, 'Kota Sibolga', 2),
	(55, 'Kota Tanjung Balai', 2),
	(56, 'Kota Tebing Tinggi', 2),
	(57, 'Kabupaten Agam', 3),
	(58, 'Kabupaten Dharmas Raya', 3),
	(59, 'Kabupaten Kepulauan Mentawai', 3),
	(60, 'Kabupaten Lima Puluh Kota', 3),
	(61, 'Kabupaten Padang Pariaman', 3),
	(62, 'Kabupaten Pasaman', 3),
	(63, 'Kabupaten Pasaman Barat', 3),
	(64, 'Kabupaten Pesisir Selatan', 3),
	(65, 'Kabupaten Sijunjung', 3),
	(66, 'Kabupaten Solok', 3),
	(67, 'Kabupaten Solok Selatan', 3),
	(68, 'Kabupaten Tanah Datar', 3),
	(69, 'Kota Bukittinggi', 3),
	(70, 'Kota Padang', 3),
	(71, 'Kota Padang Panjang', 3),
	(72, 'Kota Pariaman', 3),
	(73, 'Kota Payakumbuh', 3),
	(74, 'Kota Sawah Lunto', 3),
	(75, 'Kota Solok', 3),
	(76, 'Kabupaten Bengkalis', 4),
	(77, 'Kabupaten Indragiri Hilir', 4),
	(78, 'Kabupaten Indragiri Hulu', 4),
	(79, 'Kabupaten Kampar', 4),
	(80, 'Kabupaten Kuantan Singingi', 4),
	(81, 'Kabupaten Meranti', 4),
	(82, 'Kabupaten Pelalawan', 4),
	(83, 'Kabupaten Rokan Hilir', 4),
	(84, 'Kabupaten Rokan Hulu', 4),
	(85, 'Kabupaten Siak', 4),
	(86, 'Kota Dumai', 4),
	(87, 'Kota Pekanbaru', 4),
	(88, 'Kabupaten Bintan', 5),
	(89, 'Kabupaten Karimun', 5),
	(90, 'Kabupaten Kepulauan Anambas', 5),
	(91, 'Kabupaten Lingga', 5),
	(92, 'Kabupaten Natuna', 5),
	(93, 'Kota Batam', 5),
	(94, 'Kota Tanjung Pinang', 5),
	(95, 'Kabupaten Bangka', 6),
	(96, 'Kabupaten Bangka Barat', 6),
	(97, 'Kabupaten Bangka Selatan', 6),
	(98, 'Kabupaten Bangka Tengah', 6),
	(99, 'Kabupaten Belitung', 6),
	(100, 'Kabupaten Belitung Timur', 6),
	(101, 'Kota Pangkal Pinang', 6),
	(102, 'Kabupaten Kerinci', 7),
	(103, 'Kabupaten Merangin', 7),
	(104, 'Kabupaten Sarolangun', 7),
	(105, 'Kabupaten Batang Hari', 7),
	(106, 'Kabupaten Muaro Jambi', 7),
	(107, 'Kabupaten Tanjung Jabung Timur', 7),
	(108, 'Kabupaten Tanjung Jabung Barat', 7),
	(109, 'Kabupaten Tebo', 7),
	(110, 'Kabupaten Bungo', 7),
	(111, 'Kota Jambi', 7),
	(112, 'Kota Sungai Penuh', 7),
	(113, 'Kabupaten Bengkulu Selatan', 8),
	(114, 'Kabupaten Bengkulu Tengah', 8),
	(115, 'Kabupaten Bengkulu Utara', 8),
	(116, 'Kabupaten Kaur', 8),
	(117, 'Kabupaten Kepahiang', 8),
	(118, 'Kabupaten Lebong', 8),
	(119, 'Kabupaten Mukomuko', 8),
	(120, 'Kabupaten Rejang Lebong', 8),
	(121, 'Kabupaten Seluma', 8),
	(122, 'Kota Bengkulu', 8),
	(123, 'Kabupaten Banyuasin', 9),
	(124, 'Kabupaten Empat Lawang', 9),
	(125, 'Kabupaten Lahat', 9),
	(126, 'Kabupaten Muara Enim', 9),
	(127, 'Kabupaten Musi Banyu Asin', 9),
	(128, 'Kabupaten Musi Rawas', 9),
	(129, 'Kabupaten Ogan Ilir', 9),
	(130, 'Kabupaten Ogan Komering Ilir', 9),
	(131, 'Kabupaten Ogan Komering Ulu', 9),
	(132, 'Kabupaten Ogan Komering Ulu Se', 9),
	(133, 'Kabupaten Ogan Komering Ulu Ti', 9),
	(134, 'Kota Lubuklinggau', 9),
	(135, 'Kota Pagar Alam', 9),
	(136, 'Kota Palembang', 9),
	(137, 'Kota Prabumulih', 9),
	(138, 'Kabupaten Lampung Barat', 10),
	(139, 'Kabupaten Lampung Selatan', 10),
	(140, 'Kabupaten Lampung Tengah', 10),
	(141, 'Kabupaten Lampung Timur', 10),
	(142, 'Kabupaten Lampung Utara', 10),
	(143, 'Kabupaten Mesuji', 10),
	(144, 'Kabupaten Pesawaran', 10),
	(145, 'Kabupaten Pringsewu', 10),
	(146, 'Kabupaten Tanggamus', 10),
	(147, 'Kabupaten Tulang Bawang', 10),
	(148, 'Kabupaten Tulang Bawang Barat', 10),
	(149, 'Kabupaten Way Kanan', 10),
	(150, 'Kota Bandar Lampung', 10),
	(151, 'Kota Metro', 10),
	(152, 'Kabupaten Lebak', 11),
	(153, 'Kabupaten Pandeglang', 11),
	(154, 'Kabupaten Serang', 11),
	(155, 'Kabupaten Tangerang', 11),
	(156, 'Kota Cilegon', 11),
	(157, 'Kota Serang', 11),
	(158, 'Kota Tangerang', 11),
	(159, 'Kota Tangerang Selatan', 11),
	(160, 'Kabupaten Adm. Kepulauan Serib', 12),
	(161, 'Kota Jakarta Barat', 12),
	(162, 'Kota Jakarta Pusat', 12),
	(163, 'Kota Jakarta Selatan', 12),
	(164, 'Kota Jakarta Timur', 12),
	(165, 'Kota Jakarta Utara', 12),
	(166, 'Kabupaten Bandung', 13),
	(167, 'Kabupaten Bandung Barat', 13),
	(168, 'Kabupaten Bekasi', 13),
	(169, 'Kabupaten Bogor', 13),
	(170, 'Kabupaten Ciamis', 13),
	(171, 'Kabupaten Cianjur', 13),
	(172, 'Kabupaten Cirebon', 13),
	(173, 'Kabupaten Garut', 13),
	(174, 'Kabupaten Indramayu', 13),
	(175, 'Kabupaten Karawang', 13),
	(176, 'Kabupaten Kuningan', 13),
	(177, 'Kabupaten Majalengka', 13),
	(178, 'Kabupaten Purwakarta', 13),
	(179, 'Kabupaten Subang', 13),
	(180, 'Kabupaten Sukabumi', 13),
	(181, 'Kabupaten Sumedang', 13),
	(182, 'Kabupaten Tasikmalaya', 13),
	(183, 'Kota Bandung', 13),
	(184, 'Kota Banjar', 13),
	(185, 'Kota Bekasi', 13),
	(186, 'Kota Bogor', 13),
	(187, 'Kota Cimahi', 13),
	(188, 'Kota Cirebon', 13),
	(189, 'Kota Depok', 13),
	(190, 'Kota Sukabumi', 13),
	(191, 'Kota Tasikmalaya', 13),
	(192, 'Kabupaten Banjarnegara', 14),
	(193, 'Kabupaten Banyumas', 14),
	(194, 'Kabupaten Batang', 14),
	(195, 'Kabupaten Blora', 14),
	(196, 'Kabupaten Boyolali', 14),
	(197, 'Kabupaten Brebes', 14),
	(198, 'Kabupaten Cilacap', 14),
	(199, 'Kabupaten Demak', 14),
	(200, 'Kabupaten Grobogan', 14),
	(201, 'Kabupaten Jepara', 14),
	(202, 'Kabupaten Karanganyar', 14),
	(203, 'Kabupaten Kebumen', 14),
	(204, 'Kabupaten Kendal', 14),
	(205, 'Kabupaten Klaten', 14),
	(206, 'Kabupaten Kota Tegal', 14),
	(207, 'Kabupaten Kudus', 14),
	(208, 'Kabupaten Magelang', 14),
	(209, 'Kabupaten Pati', 14),
	(210, 'Kabupaten Pekalongan', 14),
	(211, 'Kabupaten Pemalang', 14),
	(212, 'Kabupaten Purbalingga', 14),
	(213, 'Kabupaten Purworejo', 14),
	(214, 'Kabupaten Rembang', 14),
	(215, 'Kabupaten Semarang', 14),
	(216, 'Kabupaten Sragen', 14),
	(217, 'Kabupaten Sukoharjo', 14),
	(218, 'Kabupaten Temanggung', 14),
	(219, 'Kabupaten Wonogiri', 14),
	(220, 'Kabupaten Wonosobo', 14),
	(221, 'Kota Magelang', 14),
	(222, 'Kota Pekalongan', 14),
	(223, 'Kota Salatiga', 14),
	(224, 'Kota Semarang', 14),
	(225, 'Kota Surakarta', 14),
	(226, 'Kota Tegal', 14),
	(227, 'Kabupaten Bantul', 15),
	(228, 'Kabupaten Gunung Kidul', 15),
	(229, 'Kabupaten Kulon Progo', 15),
	(230, 'Kabupaten Sleman', 15),
	(231, 'Kota Yogyakarta', 15),
	(232, 'Kabupaten Bangkalan', 16),
	(233, 'Kabupaten Banyuwangi', 16),
	(234, 'Kabupaten Blitar', 16),
	(235, 'Kabupaten Bojonegoro', 16),
	(236, 'Kabupaten Bondowoso', 16),
	(237, 'Kabupaten Gresik', 16),
	(238, 'Kabupaten Jember', 16),
	(239, 'Kabupaten Jombang', 16),
	(240, 'Kabupaten Kediri', 16),
	(241, 'Kabupaten Lamongan', 16),
	(242, 'Kabupaten Lumajang', 16),
	(243, 'Kabupaten Madiun', 16),
	(244, 'Kabupaten Magetan', 16),
	(245, 'Kabupaten Malang', 16),
	(246, 'Kabupaten Mojokerto', 16),
	(247, 'Kabupaten Nganjuk', 16),
	(248, 'Kabupaten Ngawi', 16),
	(249, 'Kabupaten Pacitan', 16),
	(250, 'Kabupaten Pamekasan', 16),
	(251, 'Kabupaten Pasuruan', 16),
	(252, 'Kabupaten Ponorogo', 16),
	(253, 'Kabupaten Probolinggo', 16),
	(254, 'Kabupaten Sampang', 16),
	(255, 'Kabupaten Sidoarjo', 16),
	(256, 'Kabupaten Situbondo', 16),
	(257, 'Kabupaten Sumenep', 16),
	(258, 'Kabupaten Trenggalek', 16),
	(259, 'Kabupaten Tuban', 16),
	(260, 'Kabupaten Tulungagung', 16),
	(261, 'Kota Batu', 16),
	(262, 'Kota Blitar', 16),
	(263, 'Kota Kediri', 16),
	(264, 'Kota Madiun', 16),
	(265, 'Kota Malang', 16),
	(266, 'Kota Mojokerto', 16),
	(267, 'Kota Pasuruan', 16),
	(268, 'Kota Probolinggo', 16),
	(269, 'Kota Surabaya', 16),
	(270, 'Kabupaten Badung', 17),
	(271, 'Kabupaten Bangli', 17),
	(272, 'Kabupaten Buleleng', 17),
	(273, 'Kabupaten Gianyar', 17),
	(274, 'Kabupaten Jembrana', 17),
	(275, 'Kabupaten Karang Asem', 17),
	(276, 'Kabupaten Klungkung', 17),
	(277, 'Kabupaten Tabanan', 17),
	(278, 'Kota Denpasar', 17),
	(279, 'Kabupaten Bima', 18),
	(280, 'Kabupaten Dompu', 18),
	(281, 'Kabupaten Lombok Barat', 18),
	(282, 'Kabupaten Lombok Tengah', 18),
	(283, 'Kabupaten Lombok Timur', 18),
	(284, 'Kabupaten Lombok Utara', 18),
	(285, 'Kabupaten Sumbawa', 18),
	(286, 'Kabupaten Sumbawa Barat', 18),
	(287, 'Kota Bima', 18),
	(288, 'Kota Mataram', 18),
	(289, 'Kabupaten Alor', 19),
	(290, 'Kabupaten Belu', 19),
	(291, 'Kabupaten Ende', 19),
	(292, 'Kabupaten Flores Timur', 19),
	(293, 'Kabupaten Kupang', 19),
	(294, 'Kabupaten Lembata', 19),
	(295, 'Kabupaten Manggarai', 19),
	(296, 'Kabupaten Manggarai Barat', 19),
	(297, 'Kabupaten Manggarai Timur', 19),
	(298, 'Kabupaten Nagekeo', 19),
	(299, 'Kabupaten Ngada', 19),
	(300, 'Kabupaten Rote Ndao', 19),
	(301, 'Kabupaten Sabu Raijua', 19),
	(302, 'Kabupaten Sikka', 19),
	(303, 'Kabupaten Sumba Barat', 19),
	(304, 'Kabupaten Sumba Barat Daya', 19),
	(305, 'Kabupaten Sumba Tengah', 19),
	(306, 'Kabupaten Sumba Timur', 19),
	(307, 'Kabupaten Timor Tengah Selatan', 19),
	(308, 'Kabupaten Timor Tengah Utara', 19),
	(309, 'Kota Kupang', 19),
	(310, 'Kabupaten Bengkayang', 20),
	(311, 'Kabupaten Kapuas Hulu', 20),
	(312, 'Kabupaten Kayong Utara', 20),
	(313, 'Kabupaten Ketapang', 20),
	(314, 'Kabupaten Kubu Raya', 20),
	(315, 'Kabupaten Landak', 20),
	(316, 'Kabupaten Melawi', 20),
	(317, 'Kabupaten Pontianak', 20),
	(318, 'Kabupaten Sambas', 20),
	(319, 'Kabupaten Sanggau', 20),
	(320, 'Kabupaten Sekadau', 20),
	(321, 'Kabupaten Sintang', 20),
	(322, 'Kota Pontianak', 20),
	(323, 'Kota Singkawang', 20),
	(324, 'Kabupaten Barito Selatan', 21),
	(325, 'Kabupaten Barito Timur', 21),
	(326, 'Kabupaten Barito Utara', 21),
	(327, 'Kabupaten Gunung Mas', 21),
	(328, 'Kabupaten Kapuas', 21),
	(329, 'Kabupaten Katingan', 21),
	(330, 'Kabupaten Kotawaringin Barat', 21),
	(331, 'Kabupaten Kotawaringin Timur', 21),
	(332, 'Kabupaten Lamandau', 21),
	(333, 'Kabupaten Murung Raya', 21),
	(334, 'Kabupaten Pulang Pisau', 21),
	(335, 'Kabupaten Seruyan', 21),
	(336, 'Kabupaten Sukamara', 21),
	(337, 'Kota Palangkaraya', 21),
	(338, 'Kabupaten Balangan', 22),
	(339, 'Kabupaten Banjar', 22),
	(340, 'Kabupaten Barito Kuala', 22),
	(341, 'Kabupaten Hulu Sungai Selatan', 22),
	(342, 'Kabupaten Hulu Sungai Tengah', 22),
	(343, 'Kabupaten Hulu Sungai Utara', 22),
	(344, 'Kabupaten Kota Baru', 22),
	(345, 'Kabupaten Tabalong', 22),
	(346, 'Kabupaten Tanah Bumbu', 22),
	(347, 'Kabupaten Tanah Laut', 22),
	(348, 'Kabupaten Tapin', 22),
	(349, 'Kota Banjar Baru', 22),
	(350, 'Kota Banjarmasin', 22),
	(351, 'Kabupaten Berau', 23),
	(352, 'Kabupaten Bulongan', 23),
	(353, 'Kabupaten Kutai Barat', 23),
	(354, 'Kabupaten Kutai Kartanegara', 23),
	(355, 'Kabupaten Kutai Timur', 23),
	(356, 'Kabupaten Malinau', 23),
	(357, 'Kabupaten Nunukan', 23),
	(358, 'Kabupaten Paser', 23),
	(359, 'Kabupaten Penajam Paser Utara', 23),
	(360, 'Kabupaten Tana Tidung', 23),
	(361, 'Kota Balikpapan', 23),
	(362, 'Kota Bontang', 23),
	(363, 'Kota Samarinda', 23),
	(364, 'Kota Tarakan', 23),
	(365, 'Kabupaten Boalemo', 24),
	(366, 'Kabupaten Bone Bolango', 24),
	(367, 'Kabupaten Gorontalo', 24),
	(368, 'Kabupaten Gorontalo Utara', 24),
	(369, 'Kabupaten Pohuwato', 24),
	(370, 'Kota Gorontalo', 24),
	(371, 'Kabupaten Bantaeng', 25),
	(372, 'Kabupaten Barru', 25),
	(373, 'Kabupaten Bone', 25),
	(374, 'Kabupaten Bulukumba', 25),
	(375, 'Kabupaten Enrekang', 25),
	(376, 'Kabupaten Gowa', 25),
	(377, 'Kabupaten Jeneponto', 25),
	(378, 'Kabupaten Luwu', 25),
	(379, 'Kabupaten Luwu Timur', 25),
	(380, 'Kabupaten Luwu Utara', 25),
	(381, 'Kabupaten Maros', 25),
	(382, 'Kabupaten Pangkajene Kepulauan', 25),
	(383, 'Kabupaten Pinrang', 25),
	(384, 'Kabupaten Selayar', 25),
	(385, 'Kabupaten Sidenreng Rappang', 25),
	(386, 'Kabupaten Sinjai', 25),
	(387, 'Kabupaten Soppeng', 25),
	(388, 'Kabupaten Takalar', 25),
	(389, 'Kabupaten Tana Toraja', 25),
	(390, 'Kabupaten Toraja Utara', 25),
	(391, 'Kabupaten Wajo', 25),
	(392, 'Kota Makassar', 25),
	(393, 'Kota Palopo', 25),
	(394, 'Kota Pare-pare', 25),
	(395, 'Kabupaten Bombana', 26),
	(396, 'Kabupaten Buton', 26),
	(397, 'Kabupaten Buton Utara', 26),
	(398, 'Kabupaten Kolaka', 26),
	(399, 'Kabupaten Kolaka Utara', 26),
	(400, 'Kabupaten Konawe', 26),
	(401, 'Kabupaten Konawe Selatan', 26),
	(402, 'Kabupaten Konawe Utara', 26),
	(403, 'Kabupaten Muna', 26),
	(404, 'Kabupaten Wakatobi', 26),
	(405, 'Kota Bau-bau', 26),
	(406, 'Kota Kendari', 26),
	(407, 'Kabupaten Banggai', 27),
	(408, 'Kabupaten Banggai Kepulauan', 27),
	(409, 'Kabupaten Buol', 27),
	(410, 'Kabupaten Donggala', 27),
	(411, 'Kabupaten Morowali', 27),
	(412, 'Kabupaten Parigi Moutong', 27),
	(413, 'Kabupaten Poso', 27),
	(414, 'Kabupaten Sigi', 27),
	(415, 'Kabupaten Tojo Una-Una', 27),
	(416, 'Kabupaten Toli Toli', 27),
	(417, 'Kota Palu', 27),
	(418, 'Kabupaten Bolaang Mangondow', 28),
	(419, 'Kabupaten Bolaang Mangondow Se', 28),
	(420, 'Kabupaten Bolaang Mangondow Ti', 28),
	(421, 'Kabupaten Bolaang Mangondow Ut', 28),
	(422, 'Kabupaten Kepulauan Sangihe', 28),
	(423, 'Kabupaten Kepulauan Siau Tagul', 28),
	(424, 'Kabupaten Kepulauan Talaud', 28),
	(425, 'Kabupaten Minahasa', 28),
	(426, 'Kabupaten Minahasa Selatan', 28),
	(427, 'Kabupaten Minahasa Tenggara', 28),
	(428, 'Kabupaten Minahasa Utara', 28),
	(429, 'Kota Bitung', 28),
	(430, 'Kota Kotamobagu', 28),
	(431, 'Kota Manado', 28),
	(432, 'Kota Tomohon', 28),
	(433, 'Kabupaten Majene', 29),
	(434, 'Kabupaten Mamasa', 29),
	(435, 'Kabupaten Mamuju', 29),
	(436, 'Kabupaten Mamuju Utara', 29),
	(437, 'Kabupaten Polewali Mandar', 29),
	(438, 'Kabupaten Buru', 30),
	(439, 'Kabupaten Buru Selatan', 30),
	(440, 'Kabupaten Kepulauan Aru', 30),
	(441, 'Kabupaten Maluku Barat Daya', 30),
	(442, 'Kabupaten Maluku Tengah', 30),
	(443, 'Kabupaten Maluku Tenggara', 30),
	(444, 'Kabupaten Maluku Tenggara Bara', 30),
	(445, 'Kabupaten Seram Bagian Barat', 30),
	(446, 'Kabupaten Seram Bagian Timur', 30),
	(447, 'Kota Ambon', 30),
	(448, 'Kota Tual', 30),
	(449, 'Kabupaten Halmahera Barat', 31),
	(450, 'Kabupaten Halmahera Selatan', 31),
	(451, 'Kabupaten Halmahera Tengah', 31),
	(452, 'Kabupaten Halmahera Timur', 31),
	(453, 'Kabupaten Halmahera Utara', 31),
	(454, 'Kabupaten Kepulauan Sula', 31),
	(455, 'Kabupaten Pulau Morotai', 31),
	(456, 'Kota Ternate', 31),
	(457, 'Kota Tidore Kepulauan', 31),
	(458, 'Kabupaten Fakfak', 32),
	(459, 'Kabupaten Kaimana', 32),
	(460, 'Kabupaten Manokwari', 32),
	(461, 'Kabupaten Maybrat', 32),
	(462, 'Kabupaten Raja Ampat', 32),
	(463, 'Kabupaten Sorong', 32),
	(464, 'Kabupaten Sorong Selatan', 32),
	(465, 'Kabupaten Tambrauw', 32),
	(466, 'Kabupaten Teluk Bintuni', 32),
	(467, 'Kabupaten Teluk Wondama', 32),
	(468, 'Kota Sorong', 32),
	(469, 'Kabupaten Merauke', 33),
	(470, 'Kabupaten Jayawijaya', 33),
	(471, 'Kabupaten Nabire', 33),
	(472, 'Kabupaten Kepulauan Yapen', 33),
	(473, 'Kabupaten Biak Numfor', 33),
	(474, 'Kabupaten Paniai', 33),
	(475, 'Kabupaten Puncak Jaya', 33),
	(476, 'Kabupaten Mimika', 33),
	(477, 'Kabupaten Boven Digoel', 33),
	(478, 'Kabupaten Mappi', 33),
	(479, 'Kabupaten Asmat', 33),
	(480, 'Kabupaten Yahukimo', 33),
	(481, 'Kabupaten Pegunungan Bintang', 33),
	(482, 'Kabupaten Tolikara', 33),
	(483, 'Kabupaten Sarmi', 33),
	(484, 'Kabupaten Keerom', 33),
	(485, 'Kabupaten Waropen', 33),
	(486, 'Kabupaten Jayapura', 33),
	(487, 'Kabupaten Deiyai', 33),
	(488, 'Kabupaten Dogiyai', 33),
	(489, 'Kabupaten Intan Jaya', 33),
	(490, 'Kabupaten Lanny Jaya', 33),
	(491, 'Kabupaten Mamberamo Raya', 33),
	(492, 'Kabupaten Mamberamo Tengah', 33),
	(493, 'Kabupaten Nduga', 33),
	(494, 'Kabupaten Puncak', 33),
	(495, 'Kabupaten Supiori', 33),
	(496, 'Kabupaten Yalimo', 33),
	(497, 'Kota Jayapura', 33),
	(498, 'Kabupaten Bulungan', 34),
	(499, 'Kabupaten Malinau', 34),
	(500, 'Kabupaten Nunukan', 34),
	(501, 'Kabupaten Tana Tidung', 34),
	(502, 'Kota Tarakan', 34);
/*!40000 ALTER TABLE `kota_kab` ENABLE KEYS */;


-- Dumping structure for table qmusik.master_provinsi
CREATE TABLE IF NOT EXISTS `master_provinsi` (
  `provinsi_id` int(10) NOT NULL AUTO_INCREMENT,
  `provinsi_nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`provinsi_id`),
  UNIQUE KEY `provinsi_nama` (`provinsi_nama`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.master_provinsi: ~34 rows (approximately)
/*!40000 ALTER TABLE `master_provinsi` DISABLE KEYS */;
INSERT INTO `master_provinsi` (`provinsi_id`, `provinsi_nama`) VALUES
	(17, 'Bali'),
	(11, 'Banten'),
	(8, 'Bengkulu'),
	(15, 'Daerah Istimewa Yogyakarta  '),
	(12, 'DKI Jakarta'),
	(24, 'Gorontalo'),
	(7, 'Jambi'),
	(13, 'Jawa Barat'),
	(14, 'Jawa Tengah'),
	(16, 'Jawa Timur'),
	(20, 'Kalimantan Barat'),
	(22, 'Kalimantan Selatan'),
	(21, 'Kalimantan Tengah'),
	(23, 'Kalimantan Timur'),
	(34, 'Kalimantan Utara'),
	(6, 'Kepulauan Bangka-Belitung'),
	(5, 'Kepulauan Riau'),
	(10, 'Lampung'),
	(30, 'Maluku'),
	(31, 'Maluku Utara'),
	(1, 'Nanggroe Aceh Darussalam'),
	(18, 'Nusa Tenggara Barat'),
	(19, 'Nusa Tenggara Timur'),
	(33, 'Papua'),
	(32, 'Papua Barat'),
	(4, 'Riau'),
	(29, 'Sulawesi Barat'),
	(25, 'Sulawesi Selatan'),
	(27, 'Sulawesi Tengah'),
	(26, 'Sulawesi Tenggara'),
	(28, 'Sulawesi Utara'),
	(3, 'Sumatera Barat'),
	(9, 'Sumatera Selatan'),
	(2, 'Sumatera Utara');
/*!40000 ALTER TABLE `master_provinsi` ENABLE KEYS */;


-- Dumping structure for table qmusik.ongkir
CREATE TABLE IF NOT EXISTS `ongkir` (
  `ongkirID` int(11) NOT NULL AUTO_INCREMENT,
  `harga` int(11) NOT NULL DEFAULT '10000',
  PRIMARY KEY (`ongkirID`),
  CONSTRAINT `FK_ongkir_kota_kab_2` FOREIGN KEY (`ongkirID`) REFERENCES `kota_kab` (`kokabID`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.ongkir: ~23 rows (approximately)
/*!40000 ALTER TABLE `ongkir` DISABLE KEYS */;
INSERT INTO `ongkir` (`ongkirID`, `harga`) VALUES
	(62, 20000),
	(152, 20000),
	(154, 15000),
	(161, 10000),
	(166, 11000),
	(167, 20000),
	(168, 20000),
	(169, 5000),
	(170, 15000),
	(173, 16000),
	(175, 20000),
	(177, 15000),
	(178, 10000),
	(179, 15000),
	(181, 10000),
	(182, 15000),
	(183, 5000),
	(186, 15000),
	(189, 20000),
	(190, 5000),
	(192, 20000),
	(233, 15000),
	(237, 20000);
/*!40000 ALTER TABLE `ongkir` ENABLE KEYS */;


-- Dumping structure for table qmusik.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `pelangganID` char(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` char(50) NOT NULL,
  `nama_lengkap` char(50) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Alamat` tinytext NOT NULL,
  `kokabID` int(10) NOT NULL,
  `tlp` char(32) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`pelangganID`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_pelanggan_kota_kab` (`kokabID`),
  CONSTRAINT `FK_pelanggan_kota_kab` FOREIGN KEY (`kokabID`) REFERENCES `kota_kab` (`kokabID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.pelanggan: ~9 rows (approximately)
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`pelangganID`, `password`, `email`, `nama_lengkap`, `jk`, `tgl_daftar`, `Alamat`, `kokabID`, `tlp`, `status`) VALUES
	('asdasd', 'password', 'aa@aa.com', 'asdasd', 'Laki-laki', '2015-07-24 14:50:06', 'asdasdasdasd', 96, 'asdasd', 'N'),
	('dodol', 'risky', 'a.a@a.com', 'ajana', 'Laki-laki', '2015-07-02 02:51:47', 'Jl babakan tengah', 499, '+5634293455', 'N'),
	('ERLAN', 'erlan', 'erlanpermana21@gmail.com', 'erlan', 'Laki-laki', '2015-07-08 10:15:45', 'sukabumi rt.03 rt.10', 190, '08997598351', 'Y'),
	('muaji1', 'risky', 'muaji1@gmail.com', 'Risky Muaji Setya', 'Perempuan', '2015-03-11 17:00:00', 'Benteng Babakan', 186, '0876234131', 'Y'),
	('muaji2', 'risky', 'muaji@muaji.com', 'Risky Muajis', 'Perempuan', '2015-04-21 05:41:32', 'Jl caringin Ngumbang Benteng Warudoyong Rt 04/10', 24, '234234234', 'Y'),
	('muaji3', 'risky', 'muasi@muaji.com', 'Setya Prana', 'Laki-laki', '2015-04-21 06:35:04', 'Jl Caringin Ngumbang', 161, '085722442265', 'Y'),
	('muaji4', 'risky', 'risky@gmail.co.id', 'Muaji Risky', 'Laki-laki', '2015-06-28 22:35:30', 'Jl Pemuda Siliwangi Bogor Rt05/39', 162, '08573243212', 'Y'),
	('risky', 'risky', 'aa.mua@gmail.com', 'Risky S', 'Laki-laki', '2015-04-27 13:02:45', 'JL Bandung Selatan Rt06/44 Cikole ', 161, '1232213', 'Y'),
	('robitea', 'risky', 'robi@tea.com', 'Robi Saja', 'Laki-laki', '2015-06-22 09:30:22', 'JL bandung selatan rt04/32 gg Mesjid', 183, '085722442265', 'Y');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;


-- Dumping structure for table qmusik.pengelola
CREATE TABLE IF NOT EXISTS `pengelola` (
  `pengelolaID` char(20) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `nama_lengkap` char(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `level` set('admin','boss') NOT NULL,
  PRIMARY KEY (`pengelolaID`),
  UNIQUE KEY `nama_lengkap` (`nama_lengkap`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.pengelola: ~2 rows (approximately)
/*!40000 ALTER TABLE `pengelola` DISABLE KEYS */;
INSERT INTO `pengelola` (`pengelolaID`, `pass`, `nama_lengkap`, `last_login`, `level`) VALUES
	('Admin', 'admin', 'Risky Muaji', '2015-04-17 12:59:44', 'admin'),
	('Boss', 'boss', 'Setya Prana', '2015-04-17 12:59:48', 'boss');
/*!40000 ALTER TABLE `pengelola` ENABLE KEYS */;


-- Dumping structure for table qmusik.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `pesanID` int(11) NOT NULL AUTO_INCREMENT,
  `pengelolaID` char(32) NOT NULL,
  `tanggal` date NOT NULL,
  `transaksi_detailID` char(10) NOT NULL,
  `PelangganID` char(32) NOT NULL,
  `alamatKirim` text NOT NULL,
  `tglKirim` date NOT NULL,
  `totalOngkir` int(5) NOT NULL,
  `totalBayar` int(11) NOT NULL,
  `transfer` enum('SUDAH','BELUM') NOT NULL DEFAULT 'BELUM',
  `status2` enum('PENDING','PROCESS','COMPLETED') NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`pesanID`),
  KEY `FK_transaksi_pengelola` (`pengelolaID`),
  KEY `FK_transaksi_transaksi_detail` (`transaksi_detailID`),
  KEY `FK_transaksi_pelanggan` (`PelangganID`),
  CONSTRAINT `FK_transaksi_pelanggan` FOREIGN KEY (`PelangganID`) REFERENCES `pelanggan` (`pelangganID`),
  CONSTRAINT `FK_transaksi_pengelola` FOREIGN KEY (`pengelolaID`) REFERENCES `pengelola` (`pengelolaID`),
  CONSTRAINT `FK_transaksi_transaksi_detail` FOREIGN KEY (`transaksi_detailID`) REFERENCES `transaksi_detail` (`transaksi_detailID`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.transaksi: ~6 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`pesanID`, `pengelolaID`, `tanggal`, `transaksi_detailID`, `PelangganID`, `alamatKirim`, `tglKirim`, `totalOngkir`, `totalBayar`, `transfer`, `status2`) VALUES
	(88, 'admin', '2015-07-09', '0907150001', 'risky', 'JL Bandung Selatan Rt06/44 Cikole  Kota Jakarta Barat - DKI Jakarta', '2015-07-11', 20000, 3020001, 'SUDAH', 'COMPLETED'),
	(90, 'admin', '2015-07-12', '1207150001', 'risky', 'JL Bandung Selatan Rt06/44 Cikole  Kota Jakarta Barat - DKI Jakarta', '2015-07-14', 30000, 2530001, 'SUDAH', 'COMPLETED'),
	(91, 'admin', '2015-07-12', '1207150002', 'ERLAN', 'sukabumi rt.03 rt.10 Kota Sukabumi - Jawa Barat', '2015-07-14', 60000, 4110002, 'BELUM', 'PENDING'),
	(92, 'admin', '2015-07-12', '1207150003', 'ERLAN', 'sukabumi rt.03 rt.10 Kota Sukabumi - Jawa Barat', '2015-07-14', 20000, 470003, 'SUDAH', 'COMPLETED'),
	(93, 'admin', '2015-07-24', '2407150001', 'ERLAN', 'sukabumi rt.03 rt.10 Kota Sukabumi - Jawa Barat', '2015-07-26', 10000, 3010001, 'SUDAH', 'COMPLETED'),
	(94, 'admin', '2015-07-24', '2407150002', 'ERLAN', 'sukabumi rt.03 rt.10 Kota Sukabumi - Jawa Barat', '2015-07-26', 10000, 3010002, 'SUDAH', 'COMPLETED');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;


-- Dumping structure for table qmusik.transaksi_detail
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_detailID` char(10) DEFAULT NULL,
  `brgID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartID` (`transaksi_detailID`),
  KEY `FK_transaksi_detail_barang` (`brgID`),
  CONSTRAINT `FK_transaksi_detail_barang` FOREIGN KEY (`brgID`) REFERENCES `barang` (`brgID`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- Dumping data for table qmusik.transaksi_detail: ~10 rows (approximately)
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
INSERT INTO `transaksi_detail` (`id`, `transaksi_detailID`, `brgID`, `qty`) VALUES
	(89, '0907150001', 64, 1),
	(90, '1107150001', 56, 1),
	(91, '1107150001', 57, 1),
	(92, '1207150001', 61, 1),
	(93, '1207150002', 64, 1),
	(94, '1207150002', 65, 1),
	(95, '1207150002', 57, 2),
	(96, '1207150003', 67, 1),
	(97, '2407150001', 64, 1),
	(98, '2407150002', 64, 1);
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
