-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bangkit
CREATE DATABASE IF NOT EXISTS `bangkit` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bangkit`;

-- Dumping structure for table bangkit.komentar
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `laptop_id` int unsigned DEFAULT NULL,
  `nama` varchar(100) COLLATE armscii8_bin DEFAULT NULL,
  `isi` text COLLATE armscii8_bin,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_komentar_laptop` (`laptop_id`),
  CONSTRAINT `fk_komentar_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table bangkit.komentar: ~9 rows (approximately)
DELETE FROM `komentar`;
INSERT INTO `komentar` (`id`, `laptop_id`, `nama`, `isi`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Dita', 'laptonya bagus\r\n', '2025-06-24 01:01:43', '2025-06-24 08:01:43'),
	(2, 1, 'rafa', 'bintang 5!!', '2025-06-24 01:01:55', '2025-06-24 08:01:55'),
	(3, 1, 'muhammad', 'laptopnya b aja', '2025-06-24 01:09:21', '2025-06-24 08:09:21'),
	(4, 1, 'Rina Mulyani', 'Saya sudah menggunakan laptop ini selama hampir 3 bulan dan sejauh ini sangat puas! Performanya sangat baik untuk harga yang ditawarkan. Booting sangat cepat karena sudah menggunakan SSD, multitasking lancar berkat RAM 8GB, dan layarnya cukup tajam untuk kebutuhan desain ringan maupun menonton film. Keyboard-nya juga nyaman dipakai mengetik dalam waktu lama, cocok untuk kerja remote seperti saya. Baterai tahan lama, bisa sampai 5-6 jam pemakaian normal.\r\n\r\nSelain itu, body-nya cukup ringan dan tipis, jadi gampang dibawa ke kafe atau kampus. Tidak terlalu panas meskipun digunakan lama. Saya juga sangat suka dengan garansi dan pelayanan dari Bangkit Computer yang sangat cepat tanggap saat saya bertanya. Recommended banget untuk pelajar, mahasiswa, atau pekerja kantoran yang butuh laptop handal tapi tetap ramah di kantong.', '2025-06-24 01:10:47', '2025-06-24 08:10:47'),
	(5, 1, 'dwi', 'anjay\r\n', '2025-06-24 01:36:23', '2025-06-24 08:36:23'),
	(6, 2, 'Dede Irawan', 'saya kasih nilai 100!', '2025-06-24 01:59:19', '2025-06-24 08:59:19'),
	(7, 2, 'Dika', 'Recommended banget laptopnya', '2025-06-24 01:59:39', '2025-06-24 08:59:39'),
	(8, 2, 'fani', 'anjoyy', '2025-06-25 00:06:29', '2025-06-25 07:06:29'),
	(9, 8, 'Dita Perawati', 'baguss banget laptopnyaa', '2025-06-26 14:34:24', '2025-06-26 21:34:24');

-- Dumping structure for table bangkit.laptops
CREATE TABLE IF NOT EXISTS `laptops` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `spesifikasi` text COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bangkit.laptops: ~9 rows (approximately)
DELETE FROM `laptops`;
INSERT INTO `laptops` (`id`, `nama`, `spesifikasi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 'Asus E203M', 'Intel N3350 RAM 2 GB SSD 128 GBLayar 11.6” Intel HD 500', 1500000, 'e203m.jpg', 4, NULL, NULL),
	(2, 'Asus E210M', 'Intel N4020RAM 4 GBSSD 256 GBLayar 11.6”Intel UHD 600', 1900000, 'e210m.jpg', 2, NULL, NULL),
	(3, 'Dell 5450', 'Intel Core i7 5600uRAM 8 GBSSD 256 GBLayar 14”Intel HD 5500', 3100000, '5450I7.jpg', 3, NULL, NULL),
	(4, 'Dell 7490', 'Intel Core i5 8350uRAM 8 GBSSD 256 GBLayar 14” FHDIntel UHD 620Keyboard Backlit', 3800000, 'DELL7490.jpg', 2, NULL, NULL),
	(5, 'Dell 7490 Touchscreen', 'Intel Core i5 8350uRAM 16 GBSSD 256 GBLayar 14” FHD TouchscreenIntel UHD 620Keyboard Backlit', 4300000, 'DELL7490TouchScreen.jpg', 3, NULL, NULL),
	(6, 'Lenovo 14ibr', 'Intel N3060RAM 4 GBSSD 256 GBLayar 14”Intel HD Graphic', 2300000, '14ibr.jpg', 3, NULL, NULL),
	(7, 'Lenovo T460', 'Intel Core i5 6300uRAM 16 GBSSD 256 GBLayar 14”Intel HD 520', 3600000, 't460.jpg', 3, NULL, NULL),
	(8, 'Lenovo X260', 'Intel Core i7 6600uRAM 8 GBSSD 256 GBLayar 12.5”Intel HD 520', 3300000, 'X260I7.jpg', 2, NULL, NULL),
	(9, 'Lenovo X280', 'Intel Core i5 8350uRAM 8 GBSSD 256 GBLayar 12.5”Intel UHD 620Keyboard Backlit', 3600000, 'x280.jpg', 1, NULL, NULL);

-- Dumping structure for table bangkit.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bangkit.migrations: ~2 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2025-06-01-075115', 'App\\Database\\Migrations\\CreateLaptops', 'default', 'App', 1748848787, 1),
	(2, '2025-06-01-093859', 'App\\Database\\Migrations\\CreatePenjualan', 'default', 'App', 1748848787, 1);

-- Dumping structure for table bangkit.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `laptop_id` int unsigned NOT NULL,
  `nama_laptop` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `total_harga` int NOT NULL,
  `status` enum('menunggu','dikirim','ditolak','selesai') COLLATE utf8mb4_general_ci DEFAULT 'menunggu',
  `metode_pembayaran` enum('cash','transfer') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cash',
  PRIMARY KEY (`id`),
  KEY `fk_penjualan_user` (`user_id`),
  KEY `fk_penjualan_laptop` (`laptop_id`),
  CONSTRAINT `fk_penjualan_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_penjualan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bangkit.penjualan: ~64 rows (approximately)
DELETE FROM `penjualan`;
INSERT INTO `penjualan` (`id`, `user_id`, `laptop_id`, `nama_laptop`, `harga`, `tanggal`, `jumlah`, `total_harga`, `status`, `metode_pembayaran`) VALUES
	(1, NULL, 1, 'Asus E203M', 1500000, '2025-06-02 07:20:58', 1, 1500000, 'menunggu', 'cash'),
	(2, NULL, 1, 'Asus E203M', 1500000, '2025-06-02 07:22:06', 1, 1500000, 'menunggu', 'cash'),
	(3, NULL, 5, 'Dell 7490 Touchscreen', 4300000, '2025-06-10 11:10:44', 1, 4300000, 'menunggu', 'cash'),
	(4, NULL, 1, 'Asus E203M', 1500000, '2025-06-10 11:13:43', 1, 1500000, 'menunggu', 'cash'),
	(5, NULL, 1, 'Asus E203M', 1500000, '2025-06-11 10:19:46', 1, 1500000, 'menunggu', 'cash'),
	(6, NULL, 1, 'Asus E203M', 1500000, '2025-06-11 10:19:52', 1, 1500000, 'menunggu', 'cash'),
	(7, NULL, 9, 'Lenovo X280', 3600000, '2025-06-11 12:13:13', 1, 3600000, 'menunggu', 'cash'),
	(8, NULL, 9, 'Lenovo X280', 3600000, '2025-06-11 12:15:39', 1, 3600000, 'menunggu', 'cash'),
	(9, NULL, 2, 'Asus E210M', 1900000, '2025-06-11 12:23:25', 1, 1900000, 'menunggu', 'cash'),
	(10, NULL, 8, 'Lenovo X260', 3300000, '2025-06-11 12:26:00', 1, 3300000, 'menunggu', 'cash'),
	(11, NULL, 3, 'Dell 5450', 3100000, '2025-06-13 10:13:38', 1, 3100000, 'menunggu', 'cash'),
	(12, NULL, 8, 'Lenovo X260', 3300000, '2025-06-14 07:11:22', 1, 3300000, 'menunggu', 'cash'),
	(13, NULL, 2, 'Asus E210M', 1900000, '2025-06-15 12:05:01', 1, 1900000, 'menunggu', 'cash'),
	(14, NULL, 5, 'Dell 7490 Touchscreen', 4300000, '2025-06-15 12:34:33', 1, 4300000, 'menunggu', 'cash'),
	(15, NULL, 1, 'Asus E203M', 1500000, '2025-06-16 06:47:18', 1, 1500000, 'menunggu', 'cash'),
	(16, NULL, 1, 'Asus E203M', 1500000, '2025-06-16 07:48:47', 1, 1500000, 'menunggu', 'cash'),
	(17, NULL, 2, 'Asus E210M', 1900000, '2025-06-16 07:49:16', 1, 1900000, 'menunggu', 'cash'),
	(18, NULL, 1, 'Asus E203M', 1500000, '2025-06-16 08:01:01', 1, 1500000, 'menunggu', 'cash'),
	(19, NULL, 2, 'Asus E210M', 1900000, '2025-06-17 07:32:40', 1, 1900000, 'menunggu', 'cash'),
	(20, NULL, 1, 'Asus E203M', 1500000, '2025-06-18 05:01:35', 1, 1500000, 'menunggu', 'cash'),
	(21, NULL, 1, 'Asus E203M', 1500000, '2025-06-18 05:28:52', 1, 1500000, 'menunggu', 'cash'),
	(22, NULL, 1, 'Asus E203M', 1500000, '2025-06-18 05:30:13', 1, 1500000, 'menunggu', 'cash'),
	(23, NULL, 2, 'Asus E210M', 1900000, '2025-06-25 06:19:15', 1, 1900000, 'menunggu', 'cash'),
	(24, NULL, 2, 'Asus E210M', 1900000, '2025-06-25 06:19:21', 1, 1900000, 'menunggu', 'cash'),
	(25, NULL, 1, 'Asus E203M', 1500000, '2025-06-25 06:19:42', 1, 1500000, 'menunggu', 'cash'),
	(26, NULL, 3, 'Dell 5450', 3100000, '2025-06-25 06:24:32', 3, 9300000, 'menunggu', 'cash'),
	(27, NULL, 6, 'Lenovo 14ibr', 2300000, '2025-06-25 06:31:21', 2, 4600000, 'menunggu', 'cash'),
	(28, NULL, 5, 'Dell 7490 Touchscreen', 4300000, '2025-06-25 07:07:02', 2, 8600000, 'menunggu', 'cash'),
	(29, NULL, 5, 'Dell 7490 Touchscreen', 4300000, '2025-06-25 07:07:48', 1, 4300000, 'menunggu', 'cash'),
	(30, NULL, 5, 'Dell 7490 Touchscreen', 4300000, '2025-06-25 07:07:52', 1, 4300000, 'menunggu', 'cash'),
	(31, NULL, 2, 'Asus E210M', 1900000, '2025-06-25 07:14:52', 1, 1900000, 'menunggu', 'cash'),
	(32, NULL, 2, 'Asus E210M', 1900000, '2025-06-25 07:15:51', 1, 1900000, 'menunggu', 'cash'),
	(33, 8, 3, 'Dell 5450', 3100000, '2025-06-25 08:59:26', 1, 3100000, 'selesai', 'cash'),
	(34, 7, 1, 'Asus E203M', 1500000, '2025-06-25 09:38:19', 1, 1500000, 'selesai', 'cash'),
	(35, 8, 2, 'Asus E210M', 1900000, '2025-06-25 09:40:16', 2, 3800000, 'selesai', 'cash'),
	(36, 8, 4, 'Dell 7490', 3800000, '2025-06-25 09:45:26', 2, 7600000, 'selesai', 'cash'),
	(37, 9, 2, 'Asus E210M', 1900000, '2025-06-25 09:47:40', 1, 1900000, 'selesai', 'cash'),
	(38, 8, 2, 'Asus E210M', 1900000, '2025-06-25 10:16:56', 1, 1900000, 'selesai', 'cash'),
	(39, 8, 3, 'Dell 5450', 3100000, '2025-06-25 10:19:39', 1, 3100000, 'selesai', 'cash'),
	(40, 8, 1, 'Asus E203M', 1500000, '2025-06-25 10:20:00', 2, 3000000, 'selesai', 'cash'),
	(41, 8, 3, 'Dell 5450', 3100000, '2025-06-25 10:27:26', 1, 3100000, 'selesai', 'cash'),
	(42, 8, 3, 'Dell 5450', 3100000, '2025-06-25 10:28:43', 2, 6200000, 'selesai', 'cash'),
	(43, 8, 9, 'Lenovo X280', 3600000, '2025-06-25 10:32:28', 1, 3600000, 'selesai', 'cash'),
	(44, 9, 1, 'Asus E203M', 1500000, '2025-06-25 10:36:57', 1, 1500000, 'selesai', 'transfer'),
	(45, 5, 1, 'Asus E203M', 1500000, '2025-06-26 02:12:29', 1, 1500000, 'selesai', 'cash'),
	(46, 7, 2, 'Asus E210M', 1900000, '2025-06-26 04:18:18', 1, 1900000, 'selesai', 'transfer'),
	(47, 7, 2, 'Asus E210M', 1900000, '2025-06-26 04:38:55', 1, 1900000, 'selesai', 'transfer'),
	(48, 7, 2, 'Asus E210M', 1900000, '2025-06-26 04:39:08', 1, 1900000, 'selesai', 'transfer'),
	(49, 5, 1, 'Asus E203M', 1500000, '2025-06-26 05:11:30', 1, 1500000, 'selesai', 'cash'),
	(50, 5, 3, 'Dell 5450', 3100000, '2025-06-26 14:44:44', 1, 3100000, 'selesai', 'cash'),
	(51, 7, 4, 'Dell 7490', 3800000, '2025-06-26 14:47:11', 1, 3800000, 'selesai', 'cash'),
	(52, 9, 1, 'Asus E203M', 1500000, '2025-06-26 15:11:04', 1, 1500000, 'selesai', 'transfer'),
	(53, 7, 8, 'Lenovo X260', 3300000, '2025-06-26 21:31:02', 1, 3300000, 'selesai', 'transfer'),
	(54, 7, 3, 'Dell 5450', 3100000, '2025-06-27 16:19:21', 1, 3100000, 'selesai', 'transfer'),
	(55, 9, 1, 'Asus E203M', 1500000, '2025-06-27 16:21:42', 1, 1500000, 'selesai', 'cash'),
	(56, 8, 2, 'Asus E210M', 1900000, '2025-06-27 16:24:05', 1, 1900000, 'selesai', 'transfer'),
	(57, 8, 1, 'Asus E203M', 1500000, '2025-06-27 16:25:52', 1, 1500000, 'selesai', 'cash'),
	(58, 9, 3, 'Dell 5450', 3100000, '2025-06-27 16:36:08', 1, 3100000, 'selesai', 'transfer'),
	(59, 7, 2, 'Asus E210M', 1900000, '2025-06-27 16:49:50', 1, 1900000, 'selesai', 'cash'),
	(60, 7, 2, 'Asus E210M', 1900000, '2025-06-28 12:28:59', 2, 3800000, 'dikirim', 'transfer'),
	(61, 9, 2, 'Asus E210M', 1900000, '2025-06-28 12:29:45', 4, 7600000, 'selesai', 'cash'),
	(62, 9, 2, 'Asus E210M', 1900000, '2025-06-28 12:31:57', 1, 1900000, 'selesai', 'cash'),
	(63, 9, 2, 'Asus E210M', 1900000, '2025-06-28 12:32:09', 4, 7600000, 'menunggu', 'cash'),
	(64, 10, 9, 'Lenovo X280', 3600000, '2025-06-28 15:31:36', 2, 7200000, 'selesai', 'transfer');

-- Dumping structure for table bangkit.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) COLLATE armscii8_bin NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table bangkit.users: ~6 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
	(5, 'customer', '$2y$10$nyS0zVfRFcTcV/fAXUUeheceU.KdzuWHiqWJCFYE7rnUPUFo4T7RG', 0),
	(6, 'admin', '$2y$10$qXFv2/CcGK56EO8xkR6KuelplYrBIVagkO5JnOT/.YBXG.GoYE91W', 1),
	(7, 'dita', '$2y$10$xjoEb.2O0toK2d.cejbq2uSw781gZYBQJKe2RyV/Nk17SEaKJFkCy', 0),
	(8, 'muh', '$2y$10$moh8IhV.VswqTNeTJfx1a.X3/xb5CxLEMfAvrbNJOXOFWRMGVEDTu', 0),
	(9, 'rafa', '$2y$10$a74lPR3zETi54EJu7p6GJOpVGTiB/z.z8sr109HD0WLu8xNBk0jky', 0),
	(10, 'dede', '$2y$10$M5n4Dq0PZma6a9v/cpGfZ.34xJMNE9d81vO0cy/9KjXAo5h6wMfZ.', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
