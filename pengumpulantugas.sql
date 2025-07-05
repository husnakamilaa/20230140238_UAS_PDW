-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2025 at 05:27 PM
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
-- Database: `pengumpulantugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `file_laporan` varchar(255) NOT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp(),
  `nilai` int(11) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `status` enum('Belum Dinilai','Sudah Dinilai') DEFAULT 'Belum Dinilai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `id_users`, `id_modul`, `file_laporan`, `tanggal_upload`, `nilai`, `feedback`, `status`) VALUES
(5, 2, 1, '1751553843_08. Perhitungan Backpropagation.pdf', '2025-07-03 16:44:03', NULL, NULL, 'Belum Dinilai'),
(6, 2, 4, '1751554469_08. Perhitungan Backpropagation.pdf', '2025-07-03 16:54:29', NULL, NULL, 'Belum Dinilai');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp(),
  `id_praktikum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `judul`, `deskripsi`, `file`, `uploaded_at`, `id_praktikum`) VALUES
(1, 'modul 1', 'computer vission make yolo untuk IoT 1', '1751527427_Chapter 11.pdf', '2025-07-03 03:48:42', 6),
(4, 'modul 1', 'cara menentukan ipv4', '1751527391_Kurikulum Berbasis OBE dan MBKM Prodi TI.pdf', '2025-07-03 14:23:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `mahasiswa_id`, `id_praktikum`, `tanggal_daftar`) VALUES
(2, 2, 1, '2025-07-02 22:18:42'),
(3, 2, 3, '2025-07-02 22:18:48'),
(4, 2, 2, '2025-07-02 22:33:36'),
(5, 2, 15, '2025-07-03 02:07:47'),
(6, 2, 7, '2025-07-03 03:01:54'),
(7, 2, 6, '2025-07-03 13:48:24'),
(8, 2, 4, '2025-07-03 21:41:21'),
(9, 2, 13, '2025-07-03 21:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE `praktikum` (
  `id_praktikum` int(11) NOT NULL,
  `nama_praktikum` varchar(100) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `praktikum`
--

INSERT INTO `praktikum` (`id_praktikum`, `nama_praktikum`, `deskripsi`, `semester`, `image`) VALUES
(1, 'Praktikum Jaringan Komputer', 'Praktikum ini membahas simulasi jaringan lokal (LAN), pengalamatan IP, serta konfigurasi dasar router dan switch menggunakan Cisco Packet Tracer.', 2, ''),
(2, 'Praktikum Pemrograman Desain Web', 'Mahasiswa akan belajar membuat antarmuka website menggunakan HTML, CSS, dan JavaScript serta menerapkannya dalam proyek desain web responsif.', 4, NULL),
(3, 'Praktikum Keamanan Siber', 'Fokus pada pengenalan konsep keamanan jaringan, enkripsi data, ethical hacking, dan cara mengamankan sistem dari serangan siber.', 5, NULL),
(4, 'Praktikum Implementasi Basis Data', 'Praktikum ini mencakup implementasi database menggunakan MySQL, relasi antar tabel, serta integrasi database dengan aplikasi berbasis web.', 3, NULL),
(5, 'Praktikum Machine Learning', 'Mahasiswa akan mempelajari dasar-dasar machine learning seperti supervised learning, klasifikasi, regresi, dan membuat model prediksi menggunakan Python.', 6, NULL),
(6, 'Praktikum Robotika', 'Mempelajari dasar-dasar robotika, pemrograman mikrokontroler, dan aktuator.', 1, ''),
(7, 'Praktikum Kecerdasan Buatan', 'Eksperimen dengan algoritma AI dasar seperti decision tree, KNN, dan regresi.', 5, NULL),
(8, 'Praktikum Data Mining', 'Pengolahan dan analisis data dalam jumlah besar menggunakan metode klasifikasi dan clustering.', 3, NULL),
(9, 'Praktikum Mobile Programming', 'Pembuatan aplikasi Android menggunakan Kotlin/Java dan Android Studio.', 4, NULL),
(12, 'Praktikum Keamanan Jaringan', 'Simulasi serangan siber, pengamanan jaringan, dan analisis log keamanan.', 2, NULL),
(13, 'Praktikum Rekayasa Perangkat Lunak', 'Penerapan prinsip RPL: analisis kebutuhan, desain, implementasi, dan pengujian.', 2, NULL),
(14, 'Praktikum Cloud Computing', 'Dasar penggunaan layanan cloud seperti AWS, Azure, serta deployment aplikasi.', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('mahasiswa','asisten') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'superadmin', 'superadmin@admin.com', '$2y$10$.lrzwpCa4OjE6EccVCc6fu7fvouWmxJPqgosbAgzNGcG.Yq2a3Lzi', 'asisten', '2025-07-02 13:58:26'),
(2, 'user1', 'user1@gmail.com', '$2y$10$7PUYFdmejLw92yQLGb9akuYu6b6zfONnBILXszAzlOdWkUXeUWTZK', 'mahasiswa', '2025-07-02 14:00:01'),
(3, 'user2', 'user2@gmail.com', '$2y$10$7/fak.1QijEHXmUwIcSlyODUlUAK4A9ZE/Hp/k8.krhpWFUnksPIy', 'mahasiswa', '2025-07-02 18:08:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_modul` (`id_modul`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_praktikum` (`id_praktikum`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD PRIMARY KEY (`id_praktikum`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id_praktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`);

--
-- Constraints for table `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `fk_praktikum` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
