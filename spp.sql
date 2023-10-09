-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 05:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji_karyawan`
--

CREATE TABLE `gaji_karyawan` (
  `id_gaji` int(4) NOT NULL,
  `id_guru_gaji` int(4) NOT NULL,
  `deskripsi_gaji` varchar(100) NOT NULL,
  `tanggal_gaji` date NOT NULL DEFAULT current_timestamp(),
  `jumlah_gaji` varchar(1000) NOT NULL,
  `status_gaji` varchar(50) NOT NULL,
  `maker_gaji` int(4) NOT NULL,
  `tgl_tgl` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji_karyawan`
--

INSERT INTO `gaji_karyawan` (`id_gaji`, `id_guru_gaji`, `deskripsi_gaji`, `tanggal_gaji`, `jumlah_gaji`, `status_gaji`, `maker_gaji`, `tgl_tgl`) VALUES
(30, 4, 'Gaji', '2023-09-01', '4000000', 'Lunas', 29, '2023-08-30 19:35:23'),
(31, 3, 'Gaji', '2023-09-01', '2000000', 'Lunas', 29, '2023-08-30 20:09:31'),
(32, 5, 'Gaji', '2023-09-01', '150000', 'Lunas', 29, '2023-08-30 20:24:16'),
(33, 5, 'Gaji', '2023-08-01', '100000', 'Lunas', 29, '2023-08-31 09:40:24'),
(35, 3, 'Gaji', '0000-00-00', '11', 'Lunas', 29, '2023-09-02 16:02:19'),
(36, 3, 'Gaji', '2023-09-14', '1', 'Lunas', 29, '2023-09-14 22:40:29'),
(37, 3, 'Gaji', '2023-09-01', '1000000', 'Lunas', 29, '2023-09-16 09:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(4) NOT NULL,
  `id_user_guru` int(4) NOT NULL,
  `nama_guru` varchar(1000) NOT NULL,
  `jk_guru` varchar(20) NOT NULL,
  `ttl_guru` varchar(1000) NOT NULL,
  `nik` int(16) NOT NULL,
  `email_guru` varchar(1000) NOT NULL,
  `tanggal_guru` datetime NOT NULL DEFAULT current_timestamp(),
  `maker_guru` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `id_user_guru`, `nama_guru`, `jk_guru`, `ttl_guru`, `nik`, `email_guru`, `tanggal_guru`, `maker_guru`) VALUES
(3, 28, 'Ray Fathurozi Hariri', 'Male', 'Batam, 01 january 2005', 2147483647, 'ray_fathurzi_hariri9@gmail.com', '2023-08-28 17:48:17', 28),
(4, 29, 'Miftahul Ilmi', 'Male', 'belakang padang, 01 january 2023', 28050711, 'Miftahul_Ilmi@gmail.com', '2023-08-28 17:51:52', 28),
(5, 30, 'oktarianto pacarnya diva', 'Male', 'Medan, 01 january 2000', 28050789, 'okta@gmail.com', '2023-08-28 18:15:39', 28);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(4) NOT NULL,
  `nama_jurusan` varchar(1000) NOT NULL,
  `jurusan_lengkap` varchar(100) NOT NULL,
  `tanggal_jurusan` datetime NOT NULL DEFAULT current_timestamp(),
  `maker_jurusan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `jurusan_lengkap`, `tanggal_jurusan`, `maker_jurusan`) VALUES
(2, 'rpl', 'rekayasa perangkat lunak', '2023-08-28 12:22:47', 28),
(3, 'bdp', 'bisnis daring pemasaran', '2023-08-28 18:16:50', 28),
(4, 'akl', 'Akuntansi dan Keuangan Lembaga', '2023-08-28 18:17:16', 28),
(7, 'ti', 'tekni informatikaa', '2023-09-07 11:05:48', 28);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(4) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `tanggal_kelas` datetime NOT NULL DEFAULT current_timestamp(),
  `maker_kelas` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tanggal_kelas`, `maker_kelas`) VALUES
(2, 'SMK XII', '2023-08-28 12:21:25', 28),
(10, 'SD I', '2023-09-07 11:05:00', 28),
(11, 'SMK X', '2023-09-16 09:46:14', 28);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(4) NOT NULL,
  `id_user_log` int(4) NOT NULL,
  `aktifitas` varchar(1000) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `id_user_log`, `aktifitas`, `waktu`) VALUES
(3, 28, 'Menambah Data Kelas SMK XI', '2023-08-30 23:30:39'),
(4, 28, 'Mengedit Data Kelas SD I Dengan ID 8', '2023-08-30 23:36:06'),
(5, 28, 'Menambah Akun Guru Pranses Simanullang', '2023-08-30 23:47:59'),
(7, 28, 'Mengedit Akun Guru Pranses Simanullang Dengan ID 39', '2023-08-30 23:51:17'),
(8, 28, 'Menghapus Akun Guru Array', '2023-08-30 23:51:33'),
(9, 28, 'Menambah Akun Guru Pranses Simanullang', '2023-08-30 23:53:02'),
(10, 28, 'Menghapus Akun Guru 40', '2023-08-30 23:53:07'),
(11, 28, 'Menambah Akun Guru 11', '2023-08-30 23:53:39'),
(12, 28, 'Menghapus Akun Guru Dengan ID 41', '2023-08-30 23:53:43'),
(13, 28, 'Mereset Password Pada Akun Guru  Dengan ID 30', '2023-08-30 23:56:37'),
(15, 28, 'Menambah Akun Siswa jilian', '2023-08-31 00:02:22'),
(17, 28, 'Mengedit Akun Siswa jilian Dengan ID 43', '2023-08-31 00:06:02'),
(18, 28, 'Mereser Password Pada Akun Siswa Dengan ID 43', '2023-08-31 00:06:06'),
(19, 28, 'Menghapus Akun Siswa Dengan ID 43', '2023-08-31 00:06:35'),
(20, 28, 'Menghapus Data Kelas Dengan ID 8', '2023-08-31 00:08:07'),
(21, 28, 'Menambah Data Kelas SD I', '2023-08-31 00:08:10'),
(22, 28, 'Mengedit Data Kelas SD II Dengan ID 9', '2023-08-31 00:08:15'),
(23, 28, 'Menghapus Data Kelas Dengan ID 9', '2023-08-31 00:08:17'),
(24, 28, 'Menambah Data Jurusan 1', '2023-08-31 00:10:38'),
(25, 28, 'Mengedit Data Jurusan 11 Dengan ID 6', '2023-08-31 00:10:43'),
(26, 28, 'Menghapus Data Jurusan 6', '2023-08-31 00:10:45'),
(27, 28, 'Menambah Data Rombel 1', '2023-08-31 00:13:48'),
(28, 28, 'Mengedit Data Rombel 111 Dengan ID 20', '2023-08-31 00:13:53'),
(29, 28, 'Menghapus Data Rombel Dengan ID 20', '2023-08-31 00:13:55'),
(30, 28, 'Menambah Data Paket 1', '2023-08-31 00:15:44'),
(31, 28, 'Mengedit Data Paket 11 Dengan ID 8', '2023-08-31 00:15:49'),
(32, 28, 'Menghapus Data Paket Dengan ID 8', '2023-08-31 00:15:51'),
(33, 29, 'Menambah Data SPP 2', '2023-08-31 00:28:43'),
(34, 29, 'Menambah Data Denda Pada ID 2', '2023-08-31 00:29:42'),
(35, 29, 'Status Lunas Dengan ID 97', '2023-08-31 00:32:30'),
(36, 29, 'Mengedit Data SPP Dengan ID Siswa ', '2023-08-31 00:34:21'),
(37, 29, 'Mengedit Data SPP Dengan ID Siswa 2', '2023-08-31 00:34:49'),
(38, 29, 'Menghapus Data SPP Dengan ID Siswa 98', '2023-08-31 00:35:28'),
(39, 29, 'Menghapus Data SPP Dengan ID Siswa 97', '2023-08-31 00:43:52'),
(40, 29, 'Menambah Data Gaji Karyawan Dengan ID 3', '2023-08-31 00:48:07'),
(41, 29, 'Mengedit Data Gaji Karyawan Dengan ID 3', '2023-08-31 00:48:13'),
(42, 29, 'Status Gaji Karyawan Lunas Dengan ID 34', '2023-08-31 00:48:21'),
(43, 29, 'Menghapus Data Gaji Karyawan Dengan ID 34', '2023-08-31 00:48:24'),
(44, 29, 'Menampilkan Laporan SPP Dalam Format Print', '2023-08-31 00:52:10'),
(45, 29, 'Menampilkan Laporan SPP Dalam Format PDF', '2023-08-31 00:53:05'),
(46, 29, 'Menampilkan Laporan SPP Dalam Format Excel', '2023-08-31 00:53:40'),
(47, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format Print', '2023-08-31 00:54:55'),
(48, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format PDF', '2023-08-31 00:54:59'),
(49, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format Excel', '2023-08-31 00:55:01'),
(50, 29, 'Menambah Data SPP Dengan ID Siswa 2', '2023-08-31 00:58:02'),
(51, 29, 'Menghapus Data SPP Dengan ID Siswa 96', '2023-08-31 01:01:34'),
(52, 30, 'Menampilkan Laporan Gaji Karyawan Dalam Format Print', '2023-08-31 01:02:24'),
(53, 30, 'Menampilkan Laporan Gaji Karyawan Dalam Format PDF', '2023-08-31 01:02:27'),
(54, 30, 'Menampilkan Laporan Gaji Karyawan Dalam Format Excel', '2023-08-31 01:02:30'),
(55, 32, 'Membayar SPP Dengan ID99', '2023-08-31 01:04:16'),
(56, 29, 'Membayar SPP Dengan ID 99', '2023-08-31 01:05:55'),
(57, 29, 'Menambah Data Denda Pada ID Siswa 2', '2023-09-01 03:21:33'),
(58, 29, 'Menambah Data SPP Dengan ID Siswa 2', '2023-09-01 03:21:54'),
(59, 32, 'Membayar SPP Dengan ID 101', '2023-09-01 03:22:51'),
(60, 32, 'Membayar SPP Dengan ID 100', '2023-09-01 04:06:16'),
(61, 29, 'Status Lunas Dengan ID Siswa 100', '2023-09-01 04:06:43'),
(62, 29, 'Menambah Data Denda Pada ID Siswa 2', '2023-09-01 04:13:41'),
(63, 32, 'Membayar SPP Dengan ID 102', '2023-09-01 04:21:12'),
(64, 29, 'Status Lunas Dengan ID Siswa 102', '2023-09-01 04:21:21'),
(65, 29, 'Menambah Data Denda Pada ID Siswa 2', '2023-09-01 04:26:05'),
(66, 32, 'Membayar SPP Dengan ID 99', '2023-09-01 05:07:37'),
(67, 32, 'Membayar SPP Dengan ID 99', '2023-09-01 05:08:14'),
(68, 32, 'Membayar SPP Dengan ID 103', '2023-09-01 05:17:02'),
(69, 28, 'Mengedit Website SPP - Sekolah Permata Harapanku', '2023-09-02 03:29:58'),
(70, 28, 'Mengedit Profile Ray Fathurozi Hariri', '2023-09-02 03:32:42'),
(71, 28, 'Mengedit Password Dengan ID 28', '2023-09-02 03:34:59'),
(72, 32, 'Mengedit Profile ong yan da', '2023-09-02 03:42:43'),
(73, 32, 'Mengganti Password Dengan ID 32', '2023-09-02 03:43:05'),
(74, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 03:47:35'),
(75, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 03:52:51'),
(76, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-02 03:53:29'),
(77, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 03:54:58'),
(78, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 03:59:46'),
(79, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 04:00:52'),
(80, 29, 'Membayar SPP Dengan ID 103', '2023-09-02 04:01:16'),
(81, 29, 'Mengedit Data SPP Dengan ID Siswa 2', '2023-09-02 04:01:39'),
(82, 29, 'Status Lunas Dengan ID Siswa 95', '2023-09-02 04:02:01'),
(83, 29, 'Menambah Data Gaji Karyawan Dengan ID 3', '2023-09-02 04:02:19'),
(84, 29, 'Mengedit Data Gaji Karyawan Dengan ID 3', '2023-09-02 04:02:24'),
(85, 29, 'Status Gaji Karyawan Lunas Dengan ID 35', '2023-09-02 04:02:41'),
(86, 29, 'Menampilkan Laporan SPP Dalam Format Print', '2023-09-02 04:02:55'),
(87, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format PDF', '2023-09-02 04:03:07'),
(88, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-02 04:03:22'),
(89, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-02 04:22:00'),
(90, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 21:06:12'),
(91, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 21:11:00'),
(92, 28, 'Anda Login Pada Sistem Dengan ID Array', '2023-09-02 21:11:04'),
(93, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 21:12:00'),
(94, 28, 'Anda Login Pada Sistem Dengan username super admin', '2023-09-02 21:12:03'),
(95, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 21:13:48'),
(96, 28, 'Login Pada Sistem Dengan username 28', '2023-09-02 21:13:52'),
(97, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 21:14:22'),
(98, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-02 21:14:25'),
(99, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-02 21:14:44'),
(100, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-02 21:25:07'),
(101, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-02 23:24:50'),
(102, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-02 23:24:53'),
(103, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-02 23:26:14'),
(104, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-02 23:36:17'),
(105, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-03 01:16:13'),
(106, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-03 01:16:19'),
(107, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-03 01:16:23'),
(108, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-03 01:18:49'),
(109, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-03 01:20:30'),
(110, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-03 01:36:57'),
(111, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-03 01:53:28'),
(112, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-03 01:59:33'),
(113, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-03 01:59:38'),
(114, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-03 02:16:20'),
(115, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-03 20:51:29'),
(116, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-03 22:53:37'),
(117, 28, 'Menambah Akun Siswa oktarianto pacarnya diva', '2023-09-03 22:59:00'),
(118, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-03 23:01:40'),
(119, 30, 'Login Pada Sistem Dengan Akun ID 30', '2023-09-03 23:02:04'),
(120, 30, 'Mengedit Profile oktarianto pacarnya diva', '2023-09-03 23:02:35'),
(121, 30, 'Logout Dari Sistem Dengan Akun ID 30', '2023-09-03 23:02:44'),
(122, 30, 'Login Pada Sistem Dengan Akun ID 30', '2023-09-03 23:03:07'),
(123, 30, 'Menampilkan Laporan Gaji Karyawan Dalam Format PDF', '2023-09-03 23:03:33'),
(124, 30, 'Menampilkan Laporan Gaji Karyawan Dalam Format Excel', '2023-09-03 23:03:59'),
(125, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-03 23:06:07'),
(126, 30, 'Logout Dari Sistem Dengan Akun ID 30', '2023-09-03 23:21:16'),
(127, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-03 23:21:29'),
(128, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-04 19:35:33'),
(129, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-04 19:35:56'),
(130, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-04 19:41:20'),
(131, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-04 19:41:54'),
(132, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-04 22:08:38'),
(133, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-04 22:20:53'),
(134, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-06 22:47:58'),
(135, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-06 22:48:17'),
(136, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-06 22:48:23'),
(137, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-06 22:49:06'),
(138, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-06 22:49:13'),
(139, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-06 22:59:01'),
(140, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-06 23:03:35'),
(141, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-06 23:04:06'),
(142, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-06 23:04:17'),
(143, 28, 'Menambah Data Kelas SMK XI', '2023-09-06 23:05:00'),
(144, 28, 'Menambah Data Jurusan ti', '2023-09-06 23:05:48'),
(145, 28, 'Menambah Data Rombel q', '2023-09-06 23:07:14'),
(146, 28, 'Menambah Data Paket spp 2023 (beasiswa pak if)', '2023-09-06 23:08:39'),
(147, 28, 'Menambah Akun Siswa test', '2023-09-06 23:10:02'),
(148, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-06 23:11:58'),
(149, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-06 23:12:09'),
(150, 29, 'Menambah Data SPP Dengan ID Siswa 11', '2023-09-06 23:12:49'),
(151, 46, 'Login Pada Sistem Dengan Akun ID 46', '2023-09-06 23:13:29'),
(152, 46, 'Membayar SPP Dengan ID 104', '2023-09-06 23:14:48'),
(153, 29, 'Menambah Data SPP Dengan ID Siswa 2', '2023-09-06 23:15:37'),
(154, 29, 'Status Lunas Dengan ID Siswa 104', '2023-09-06 23:17:07'),
(155, 29, 'Menampilkan Laporan SPP Dalam Format Print', '2023-09-06 23:17:52'),
(156, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format Print', '2023-09-06 23:18:24'),
(157, 46, 'Logout Dari Sistem Dengan Akun ID 46', '2023-09-06 23:24:51'),
(158, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-06 23:34:59'),
(159, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-07 02:00:31'),
(160, 28, 'Menambah Data Jurusan 1', '2023-09-07 03:02:03'),
(161, 28, 'Menghapus Data Jurusan 8', '2023-09-07 03:02:06'),
(162, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-07 05:57:24'),
(163, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-07 05:58:21'),
(164, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-07 05:58:37'),
(165, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-07 06:06:15'),
(166, 32, 'Membayar SPP Dengan ID 103', '2023-09-07 06:06:32'),
(167, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-07 06:16:36'),
(168, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-07 06:47:49'),
(169, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-07 07:04:51'),
(170, 29, 'Membayar SPP Dengan ID 99', '2023-09-07 07:26:46'),
(171, 29, 'Membayar SPP Dengan ID 99', '2023-09-07 07:28:38'),
(172, 29, 'Status Lunas Dengan ID Siswa 99', '2023-09-07 07:37:02'),
(173, 29, 'Membayar SPP Dengan ID 103', '2023-09-07 07:37:25'),
(174, 29, 'Status Lunas Dengan ID Siswa 103', '2023-09-07 07:37:39'),
(175, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-07 07:42:58'),
(176, 32, 'Membayar SPP Dengan ID 105', '2023-09-07 07:46:01'),
(177, 29, 'Status Lunas Dengan ID Siswa 105', '2023-09-07 07:46:17'),
(178, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-07 07:56:10'),
(179, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-07 07:59:47'),
(180, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-07 08:37:11'),
(181, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-07 08:49:41'),
(182, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-07 08:57:39'),
(183, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-07 08:59:38'),
(184, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-07 09:06:56'),
(185, 29, 'Membayar SPP Dengan ID 101', '2023-09-07 09:08:45'),
(186, 29, 'Menambah Data Denda Pada ID Siswa 2', '2023-09-07 09:09:02'),
(187, 29, 'Mengedit Data SPP Dengan ID Siswa 2', '2023-09-07 09:09:17'),
(188, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-07 22:30:06'),
(189, 32, 'Logout Dari Sistem Dengan Akun ID 32', '2023-09-07 22:30:22'),
(190, 32, 'Login Pada Sistem Dengan Akun ID 32', '2023-09-07 22:55:46'),
(191, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-08 09:06:32'),
(192, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-09 05:51:00'),
(193, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-09 05:51:11'),
(194, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-09 05:51:17'),
(195, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-09 05:54:58'),
(196, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-09 05:55:02'),
(197, 28, 'Menambah Akun Guru 1', '2023-09-09 06:02:12'),
(198, 28, 'Menghapus Akun Guru Dengan ID 47', '2023-09-09 06:02:17'),
(199, 28, 'Mengedit Data Kelas SD I Dengan ID 10', '2023-09-09 06:11:58'),
(200, 28, 'Mengedit Data Jurusan ti Dengan ID 7', '2023-09-09 06:16:56'),
(201, 28, 'Menambah Data Rombel 1', '2023-09-09 06:19:27'),
(202, 28, 'Menghapus Data Rombel Dengan ID 18', '2023-09-09 06:19:32'),
(203, 28, 'Mengedit Data Rombel z Dengan ID 21', '2023-09-09 06:19:41'),
(204, 28, 'Menghapus Data Paket Dengan ID 9', '2023-09-09 06:21:45'),
(205, 28, 'Mengedit Data Paket denda telat bayar spp1 Dengan ID 6', '2023-09-09 06:21:52'),
(206, 28, 'Mengedit Data Paket denda telat bayar spp Dengan ID 6', '2023-09-09 06:21:56'),
(207, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-09 06:24:56'),
(208, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-09 06:25:05'),
(209, 29, 'Menambah Data SPP Dengan ID Siswa 2', '2023-09-09 06:42:58'),
(210, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-09 06:47:36'),
(211, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-13 09:19:23'),
(212, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-13 09:19:50'),
(213, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-13 09:19:57'),
(214, 28, 'Menambah Akun Siswa 1212121', '2023-09-13 09:37:08'),
(215, 28, 'Mengedit Akun Siswa 1212121 Dengan ID 48', '2023-09-13 09:40:39'),
(216, 28, 'Menghapus Akun Siswa Dengan ID 48', '2023-09-13 09:40:43'),
(217, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-13 09:40:46'),
(218, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-13 09:41:06'),
(219, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-13 22:51:35'),
(220, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-13 22:52:27'),
(221, 28, 'Menghapus Akun Siswa Dengan ID 46', '2023-09-13 22:52:41'),
(222, 28, 'Menambah Akun Siswa testing', '2023-09-13 22:53:06'),
(223, 28, 'Menambah Akun Siswa Testing', '2023-09-13 22:54:22'),
(224, 28, 'Menambah Akun Siswa siswa', '2023-09-13 23:04:16'),
(225, 28, 'Menambah Akun Siswa tes', '2023-09-13 23:04:50'),
(226, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-13 23:14:27'),
(227, 28, 'Menambah Akun Siswa testt', '2023-09-13 23:15:14'),
(228, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-13 23:16:14'),
(229, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-13 23:16:59'),
(230, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-13 23:20:55'),
(231, 28, 'Menambah Akun Siswa 22', '2023-09-13 23:21:32'),
(232, 28, 'Menambah Akun Siswa sada', '2023-09-13 23:27:09'),
(233, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:27:35'),
(234, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:27:50'),
(235, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-13 23:28:08'),
(236, 33, 'Login Pada Sistem Dengan Akun ID 33', '2023-09-13 23:28:33'),
(237, 33, 'Membayar SPP Dengan ID 144', '2023-09-13 23:28:45'),
(238, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:33:15'),
(239, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:34:28'),
(240, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:34:56'),
(241, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:35:28'),
(242, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:36:33'),
(243, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:37:32'),
(244, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:38:04'),
(245, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:40:35'),
(246, 29, 'Membayar SPP Dengan ID 144', '2023-09-13 23:41:27'),
(247, 33, 'Membayar SPP Dengan ID 145', '2023-09-13 23:44:57'),
(248, 29, 'Membayar SPP Dengan ID 146', '2023-09-13 23:45:40'),
(249, 29, 'Membayar SPP Dengan ID 147', '2023-09-13 23:50:19'),
(250, 29, 'Membayar SPP Dengan ID 148', '2023-09-13 23:50:33'),
(251, 33, 'Membayar SPP Dengan ID 149', '2023-09-13 23:51:37'),
(252, 29, 'Status Lunas Dengan ID Siswa 144', '2023-09-13 23:52:10'),
(253, 29, 'Status Lunas Dengan ID Siswa 147', '2023-09-13 23:52:10'),
(254, 29, 'Status Lunas Dengan ID Siswa 147', '2023-09-13 23:52:45'),
(255, 29, 'Status Lunas Dengan ID Siswa 148', '2023-09-13 23:52:45'),
(256, 29, 'Status Lunas Dengan ID Siswa 148', '2023-09-13 23:52:58'),
(257, 29, 'Status Lunas Dengan ID Siswa 149', '2023-09-13 23:52:58'),
(258, 29, 'Menampilkan Laporan SPP Dalam Format Print', '2023-09-13 23:53:24'),
(259, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-14 07:45:45'),
(260, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-14 07:45:56'),
(261, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-14 10:39:58'),
(262, 29, 'Menambah Data Gaji Karyawan Dengan ID 3', '2023-09-14 10:40:29'),
(263, 29, 'Status Gaji Karyawan Lunas Dengan ID 36', '2023-09-14 10:40:34'),
(264, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format Print', '2023-09-14 10:40:48'),
(265, 29, 'Status Lunas Dengan ID Siswa 149', '2023-09-14 10:41:07'),
(266, 29, 'Membayar SPP Dengan ID 150', '2023-09-14 10:41:15'),
(267, 29, 'Menambah Data Denda Pada ID Siswa 2', '2023-09-14 10:51:29'),
(268, 29, 'Menambah Data SPP Dengan ID Siswa 2', '2023-09-14 10:52:24'),
(269, 29, 'Menambah Data Denda Pada ID Siswa 2', '2023-09-14 10:52:40'),
(270, 29, 'Menampilkan Laporan SPP Dalam Format Print', '2023-09-14 10:52:55'),
(271, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-14 10:53:00'),
(272, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-14 10:53:17'),
(273, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-14 10:53:36'),
(274, 33, 'Login Pada Sistem Dengan Akun ID 33', '2023-09-14 10:54:11'),
(275, 33, 'Membayar SPP Dengan ID 151', '2023-09-14 10:54:24'),
(276, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-14 10:55:05'),
(277, 29, 'Status Lunas Dengan ID Siswa 150', '2023-09-14 10:55:17'),
(278, 29, 'Status Lunas Dengan ID Siswa 151', '2023-09-14 10:55:17'),
(279, 29, 'Status Lunas Dengan ID Siswa 151', '2023-09-14 10:55:23'),
(280, 33, 'Logout Dari Sistem Dengan Akun ID 33', '2023-09-14 10:55:38'),
(281, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-09-15 21:43:39'),
(282, 28, 'Menambah Akun Siswa test', '2023-09-15 21:45:38'),
(283, 28, 'Mengedit Akun Siswa test Dengan ID 34', '2023-09-15 21:45:55'),
(284, 28, 'Menambah Data Kelas SMK X', '2023-09-15 21:46:14'),
(285, 28, 'Menambah Data Rombel a', '2023-09-15 21:47:57'),
(286, 28, 'Menambah Data Paket spp 2024', '2023-09-15 21:48:41'),
(287, 28, 'Logout Dari Sistem Dengan Akun ID 28', '2023-09-15 21:50:30'),
(288, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-15 21:50:37'),
(289, 29, 'Membayar SPP Dengan ID 158', '2023-09-15 21:52:28'),
(290, 29, 'Status Lunas Dengan ID Siswa 158', '2023-09-15 21:53:31'),
(291, 29, 'Menambah Data Gaji Karyawan Dengan ID 3', '2023-09-15 21:53:58'),
(292, 29, 'Status Gaji Karyawan Lunas Dengan ID 37', '2023-09-15 21:54:08'),
(293, 29, 'Menampilkan Laporan SPP Dalam Format Print', '2023-09-15 21:54:25'),
(294, 29, 'Menampilkan Laporan Gaji Karyawan Dalam Format Print', '2023-09-15 21:54:46'),
(295, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-15 21:55:19'),
(296, 34, 'Login Pada Sistem Dengan Akun ID 34', '2023-09-15 21:55:29'),
(297, 34, 'Membayar SPP Dengan ID 159', '2023-09-15 21:56:05'),
(298, 34, 'Logout Dari Sistem Dengan Akun ID 34', '2023-09-15 21:56:17'),
(299, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-15 21:56:23'),
(300, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-15 21:56:45'),
(301, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-15 21:56:55'),
(302, 29, 'Status Lunas Dengan ID Siswa 159', '2023-09-15 21:57:12'),
(303, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-15 21:57:19'),
(304, 34, 'Login Pada Sistem Dengan Akun ID 34', '2023-09-15 21:57:26'),
(305, 34, 'Logout Dari Sistem Dengan Akun ID 34', '2023-09-15 21:58:19'),
(306, 31, 'Login Pada Sistem Dengan Akun ID 31', '2023-09-15 21:58:25'),
(307, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-09-18 05:57:24'),
(308, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-09-18 05:59:02'),
(309, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-10-03 07:06:59'),
(310, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-10-03 07:07:16'),
(311, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-10-03 07:07:24'),
(312, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-10-03 21:35:05'),
(313, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-10-03 21:35:18'),
(314, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-10-03 21:35:23'),
(315, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-10-03 21:54:32'),
(316, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-10-04 21:35:31'),
(317, 29, 'Membayar SPP Dengan ID 153', '2023-10-04 21:35:45'),
(318, 29, 'Status Lunas Dengan ID Siswa 153', '2023-10-04 21:35:53'),
(319, 29, 'Login Pada Sistem Dengan Akun ID 29', '2023-10-05 21:45:51'),
(320, 29, 'Logout Dari Sistem Dengan Akun ID 29', '2023-10-05 21:46:07'),
(321, 28, 'Login Pada Sistem Dengan Akun ID 28', '2023-10-05 21:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(4) NOT NULL,
  `nama_paket` text NOT NULL,
  `harga_paket` text NOT NULL,
  `tanggal_paket` datetime NOT NULL DEFAULT current_timestamp(),
  `maker_paket` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`, `tanggal_paket`, `maker_paket`) VALUES
(1, 'SPP', '600000', '2023-08-30 11:23:53', 28),
(3, 'Uang Tahunan', '1000000', '2023-08-30 18:49:36', 28),
(4, 'uang buku', '2000000', '2023-08-30 18:51:07', 28),
(5, 'seragam', '1400000', '2023-08-30 18:51:44', 28),
(6, 'denda telat bayar spp', '100000', '2023-08-30 18:53:01', 28),
(10, 'spp 2024', '1000000', '2023-09-16 09:48:41', 28);

-- --------------------------------------------------------

--
-- Table structure for table `rombel`
--

CREATE TABLE `rombel` (
  `id_rombel` int(4) NOT NULL,
  `id_jurusan_rombel` int(4) NOT NULL,
  `id_kelas_rombel` int(4) NOT NULL,
  `id_guru_rombel` varchar(4) NOT NULL,
  `nama_rombel` varchar(50) NOT NULL,
  `tanggal_rombel` datetime NOT NULL DEFAULT current_timestamp(),
  `maker_rombel` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rombel`
--

INSERT INTO `rombel` (`id_rombel`, `id_jurusan_rombel`, `id_kelas_rombel`, `id_guru_rombel`, `nama_rombel`, `tanggal_rombel`, `maker_rombel`) VALUES
(17, 2, 2, '4', 'b', '2023-08-28 18:18:12', 28),
(21, 7, 2, '5', 'z', '2023-09-07 11:07:14', 28),
(23, 3, 11, '3', 'a', '2023-09-16 09:47:57', 28);

-- --------------------------------------------------------

--
-- Table structure for table `settings_website`
--

CREATE TABLE `settings_website` (
  `id_settings` int(4) NOT NULL,
  `foto` text NOT NULL,
  `text` text NOT NULL,
  `login` text NOT NULL,
  `nama_website` varchar(1000) NOT NULL,
  `dipakai` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings_website`
--

INSERT INTO `settings_website` (`id_settings`, `foto`, `text`, `login`, `nama_website`, `dipakai`) VALUES
(2, '1693643251_a27ab1a0b777296d6a55.png', '1693643251_c603668655ce9319926e.png', '1693643251_170d7e1d43690f2a4abf.jpg', 'SPP - Sekolah Permata Harapanku', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(4) NOT NULL,
  `id_user_siswa` int(4) NOT NULL,
  `id_kelas_siswa` int(4) NOT NULL,
  `id_jurusan_siswa` int(4) NOT NULL,
  `id_rombel_siswa` int(4) NOT NULL,
  `id_paket_siswa` int(4) NOT NULL,
  `nama_siswa` varchar(1000) NOT NULL,
  `jk_siswa` varchar(20) NOT NULL,
  `ttl_siswa` varchar(1000) NOT NULL,
  `nis` int(10) NOT NULL,
  `email_siswa` varchar(1000) NOT NULL,
  `tanggal_siswa` datetime NOT NULL DEFAULT current_timestamp(),
  `maker_siswa` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_user_siswa`, `id_kelas_siswa`, `id_jurusan_siswa`, `id_rombel_siswa`, `id_paket_siswa`, `nama_siswa`, `jk_siswa`, `ttl_siswa`, `nis`, `email_siswa`, `tanggal_siswa`, `maker_siswa`) VALUES
(2, 32, 2, 2, 18, 1, 'ong yan da', 'Male', 'singapore, 28 maret 2003', 2147483611, 'ong_yan_da99@gmail.com', '2023-08-28 18:59:23', 28),
(5, 36, 2, 2, 18, 1, 'norman ang', 'Female', 'Batam, 28 oktober 2006', 281028106, 'norman_ang.28@gmail.com', '2023-08-30 18:46:44', 28),
(14, 31, 2, 2, 17, 1, 'testt', 'Male', 'Testt', 98784326, 'siswa@gmail.com', '2023-09-14 11:15:14', 28),
(15, 32, 2, 2, 17, 1, '22', 'Male', '22', 22, '222@gmail.com', '2023-09-14 11:21:32', 28),
(16, 33, 2, 2, 17, 1, 'sada', 'Male', 'ewqe312q4', 111, 'dsadasda@gmail.com', '2023-09-14 11:27:09', 28),
(17, 34, 2, 2, 17, 1, 'test', 'Male', 'Batam, 29 oktober 2006', 12123456, 'test@gmail.com', '2023-09-16 09:45:38', 28);

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `tambah_uangkas` AFTER INSERT ON `siswa` FOR EACH ROW INSERT INTO spp(id_siswa_spp, id_paket_spp, deskripsi, tgl_jatuh_tempo, status)
VALUES
(new.id_siswa, new.id_paket_siswa, "SPP JANUARY 2024", "2024-01-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP FEBRUARY 2024", "2024-02-29 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP MARET 2024", "2024-03-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP APRIL 2024", "2024-04-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP MEI 2024", "2024-05-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JUNI 2024", "2024-06-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JULY 2024", "2024-07-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP AGUSTUS 2024", "2024-08-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP SEPTEMBER 2024", "2024-09-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP OCTOBER 2024", "2024-10-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP NOVEMBER 2024", "2024-11-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP DECEMBER 2024", "2024-12-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JANUARY 2025", "2025-01-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP FEBRUARY 2025", "2025-02-29 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP MARET 2025", "2025-03-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP APRIL 2025", "2025-04-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP MEI 2025", "2025-05-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JUNI 2025", "2025-06-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JULY 2025", "2025-07-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP AGUSTUS 2025", "2025-08-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP SEPTEMBER 2025", "2025-09-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP OCTOBER 2025", "2025-10-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP NOVEMBER 2025", "2025-11-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP DECEMBER 2025", "2025-12-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JANUARY 2026", "2026-01-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP FEBRUARY 2026", "2026-02-29 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP MARET 2026", "2026-03-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP APRIL 2026", "2026-04-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP MEI 2026", "2026-05-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JUNI 2026", "2026-06-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP JULY 2026", "2026-07-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP AGUSTUS 2026", "2026-08-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP SEPTEMBER 2026", "2026-09-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP OCTOBER 2026", "2026-10-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP NOVEMBER 2026", "2026-11-30 00:00:00", "Belum Lunas"),
(new.id_siswa, new.id_paket_siswa, "SPP DECEMBER 2026", "2026-12-30 00:00:00", "Belum Lunas")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(4) NOT NULL,
  `id_siswa_spp` int(4) NOT NULL,
  `id_paket_spp` int(4) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_spp` date NOT NULL DEFAULT current_timestamp(),
  `tgl_jatuh_tempo` datetime NOT NULL DEFAULT '2023-01-01 01:00:00' ON UPDATE current_timestamp(),
  `tanggal_spp` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `foto_bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `id_siswa_spp`, `id_paket_spp`, `deskripsi`, `tgl_spp`, `tgl_jatuh_tempo`, `tanggal_spp`, `status`, `metode_pembayaran`, `foto_bukti`) VALUES
(144, 16, 1, 'SPP JANUARY 2024', '2023-09-14', '2023-09-14 11:52:10', '2023-09-14', 'Lunas', '', ''),
(145, 33, 1, 'SPP FEBRUARY 2024', '2023-09-14', '2023-09-14 11:44:57', '2023-09-14', 'Proses', 'Virtual Account (VA)', ''),
(153, 16, 1, 'SPP OCTOBER 2024', '2023-09-14', '2023-10-05 09:35:53', '2023-09-14', 'Lunas', 'Virtual Account (VA)', ''),
(169, 17, 1, 'SPP DECEMBER 2024', '2023-09-16', '2024-12-30 00:00:00', '2023-09-16', 'Belum Lunas', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `tanggal_user` date NOT NULL DEFAULT current_timestamp(),
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `tanggal_user`, `foto`) VALUES
(28, 'Super Admin', '3dcf34a6023633a0d92521ec9c8d5ae4', 1, '2023-08-28', '1693228006_5125336c41bf1155694b.jpg'),
(29, 'Admin', '3dcf34a6023633a0d92521ec9c8d5ae4', 2, '2023-08-28', ''),
(31, 'Testt', '3dcf34a6023633a0d92521ec9c8d5ae4', 4, '2023-09-14', ''),
(32, '22', '3dcf34a6023633a0d92521ec9c8d5ae4', 3, '2023-09-14', ''),
(33, 'ewq21341231', '3dcf34a6023633a0d92521ec9c8d5ae4', 3, '2023-09-14', ''),
(34, 'test', '3dcf34a6023633a0d92521ec9c8d5ae4', 3, '2023-09-16', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `NK` (`nik`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD UNIQUE KEY `JURUSAN_LENGKAP` (`jurusan_lengkap`),
  ADD UNIQUE KEY `JURUSAN` (`nama_jurusan`) USING HASH;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `KELAS` (`nama_kelas`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `rombel`
--
ALTER TABLE `rombel`
  ADD PRIMARY KEY (`id_rombel`),
  ADD UNIQUE KEY `WALKEL` (`id_guru_rombel`);

--
-- Indexes for table `settings_website`
--
ALTER TABLE `settings_website`
  ADD PRIMARY KEY (`id_settings`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `NIS` (`nis`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `USERNAME` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  MODIFY `id_gaji` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id_rombel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `settings_website`
--
ALTER TABLE `settings_website`
  MODIFY `id_settings` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
