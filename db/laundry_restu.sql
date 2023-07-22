-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 07:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_restu`
--

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'lebak bulus', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(2, 'Umayah 2', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(3, 'Adhyaksa', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(4, 'Mangga 2', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(5, 'PGA', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(6, 'Sukapura', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(7, 'Sukabirus', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(8, 'PBB', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(9, 'belakang ivi futsal', '2023-07-10 10:57:31', '2023-07-10 10:57:31'),
(10, 'belakang tenis', '2023-07-10 10:57:31', '2023-07-10 10:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laundry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laundry`
--

CREATE TABLE `jenis_laundry` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `jenis_laundry` varchar(255) DEFAULT NULL,
  `tipe_laundry` enum('laundry berat','laundry tetap') DEFAULT NULL,
  `harga` float(16,2) DEFAULT NULL,
  `lama` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `craeted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_laundry`
--

INSERT INTO `jenis_laundry` (`id`, `jenis_laundry`, `tipe_laundry`, `harga`, `lama`, `deskripsi`, `craeted_at`, `updated_at`) VALUES
(1, 'Self-service', 'laundry berat', 5000.00, '2 Jam', NULL, '2023-07-10 10:43:00', '2023-07-10 10:43:00'),
(2, 'Express Laundry', 'laundry berat', 12000.00, '2 jam', NULL, '2023-07-10 10:43:00', '2023-07-10 10:43:00'),
(3, 'Next day', 'laundry berat', 8000.00, '1 Hari', NULL, '2023-07-10 10:43:00', '2023-07-10 10:43:00'),
(4, 'Regular', 'laundry berat', 4000.00, '2 Hari', NULL, '2023-07-10 10:43:00', '2023-07-10 10:43:00'),
(5, 'Laundry Karpet', 'laundry tetap', 35000.00, '4 Hari', NULL, '2023-07-10 10:43:00', '2023-07-10 10:43:00'),
(6, 'Laundry Sepatu', 'laundry tetap', 25000.00, '2 Hari', NULL, '2023-07-10 10:44:22', '2023-07-10 10:44:22'),
(7, 'Laundry Selimut', 'laundry tetap', 15000.00, '2 Hari', NULL, '2023-07-10 10:44:22', '2023-07-10 10:44:22'),
(8, 'Premium', 'laundry tetap', 0.00, '2 Hari', NULL, '2023-07-10 11:06:29', '2023-07-10 11:06:29'),
(9, 'Platinum', 'laundry tetap', 0.00, '1 Hari', NULL, '2023-07-10 11:07:15', '2023-07-10 11:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id`, `user_id`, `foto_ktp`, `no_ktp`, `created_at`, `updated_at`) VALUES
(1, 3, 'kurir/ktp_kurir.jpg', '3215151802990002', '2023-07-10 11:33:52', '2023-07-10 11:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

CREATE TABLE `laundry` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pengantaran` enum('drop off','pick up') DEFAULT NULL,
  `kurir_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_laundry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `berat` double(5,2) DEFAULT NULL,
  `harga` float(16,2) DEFAULT NULL,
  `pembayaran` timestamp NULL DEFAULT NULL,
  `status` enum('menunggu pengambilan','proses','batal','selesai','diantar','diambil') DEFAULT NULL,
  `testimoni` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundry`
--

INSERT INTO `laundry` (`id`, `member_id`, `pengantaran`, `kurir_id`, `jenis_laundry_id`, `berat`, `harga`, `pembayaran`, `status`, `testimoni`, `created_at`, `updated_at`) VALUES
(1, 1, 'pick up', 1, 8, 10.00, 0.00, NULL, 'diambil', 'makaseeh', '2023-07-14 16:12:35', '23:12:35'),
(2, 1, 'pick up', NULL, 8, 10.00, 0.00, NULL, 'diambil', NULL, '2023-07-22 05:24:13', '12:24:13'),
(3, 1, 'pick up', NULL, NULL, NULL, NULL, NULL, 'menunggu pengambilan', NULL, '2023-07-22 05:24:20', '12:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `daerah_id` bigint(10) UNSIGNED DEFAULT NULL,
  `nama_kost` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kadaluarsa_paket` date DEFAULT NULL,
  `craeted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `user_id`, `daerah_id`, `nama_kost`, `alamat`, `paket_id`, `kadaluarsa_paket`, `craeted_at`, `updated_at`) VALUES
(1, 2, 1, 'Griya Mustika', 'Bandung', 2, '2023-08-20', '2023-07-10 11:28:13', '2023-07-10 11:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `harga` float(16,2) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `paket`, `harga`, `deskripsi`, `lama`, `created_at`, `updated_at`) VALUES
(1, 'Reguler', 0.00, 'Member non paket.  Harga Kiloan', 'Tidak ada batas waktu', '2023-07-10 11:05:05', '2023-07-10 11:05:05'),
(2, 'Premium', 100000.00, 'Paket Bulanan Laundry 2 Hari beres', '1 Bulan', '2023-07-10 11:05:05', '2023-07-10 11:05:05'),
(3, 'Platinum', 1500000.00, 'Paket Bulanan Laundry Besok beres', '1 Bulan', '2023-07-10 11:08:00', '2023-07-10 11:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` varchar(128) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `gender`, `birthday`, `phone_number`, `address`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'administrator', 'Admin', 'admin@gmail.com', 'Perempuan', '1999-02-18', '081214222446', 'Jl. Bandung ', 'profile/administrator.png', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 1, 1, 1614472317),
(2, 'member1', 'Member', 'member@gmail.com', 'Perempuan', '2002-06-12', '082114832111', 'Bandung', 'profile/member.png', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 2, 1, 1614472317),
(3, 'kurir1', 'Kurir', 'kurir@gmail.com', 'Laki-laki', '1970-10-22', '081234567890', 'Bandung', 'profile/kurir.png', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 3, 1, 1614472317);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `role_id` bigint(11) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 1, 6),
(6, 2, 2),
(7, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `menu` varchar(128) DEFAULT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `active`) VALUES
(1, 'Admin', 1),
(2, 'User', 1),
(3, 'Menu', 1),
(4, 'Member', 1),
(5, 'Laundry', 1),
(6, 'DataMaster', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'member'),
(3, 'kurir');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/', 'box', 1),
(2, 1, 'Role Management', 'admin/role', 'users', 1),
(3, 1, 'Data User', 'admin/dataUser/', 'users', 1),
(4, 3, 'Menu Management', 'menu/', 'list', 1),
(5, 3, 'Submenu Management', 'menu/subMenu', 'list', 1),
(6, 2, 'Change Password', 'user/changePassword', 'key', 1),
(7, 2, 'Beranda', 'user/', 'box', 1),
(8, 2, 'Edit Profile', 'user/edit', 'user', 1),
(9, 5, 'Data Laundry', 'Laundry/Laundry', 'box', 1),
(10, 5, 'Data Member', 'Laundry/Member', 'box', 1),
(11, 5, 'Data Kurir', 'Laundry/Kurir', 'box', 1),
(12, 6, 'Data Jenis Laundry', 'DataMaster/JenisLaundry', 'box', 1),
(13, 6, 'Data Paket', 'DataMaster/Paket', 'box', 1),
(14, 6, 'Data Daerah', 'DataMaster/Daerah', 'box', 1),
(15, 4, 'Laundry', 'Member/Laundry', 'box', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laundry_id` (`laundry_id`);

--
-- Indexes for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kurir_ibfk_1` (`user_id`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `kurir_id` (`kurir_id`),
  ADD KEY `jenis_laundry_id` (`jenis_laundry_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `daerah_id` (`daerah_id`),
  ADD KEY `paket_id` (`paket_id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`laundry_id`) REFERENCES `laundry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kurir`
--
ALTER TABLE `kurir`
  ADD CONSTRAINT `kurir_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laundry`
--
ALTER TABLE `laundry`
  ADD CONSTRAINT `laundry_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `laundry_ibfk_2` FOREIGN KEY (`kurir_id`) REFERENCES `kurir` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `laundry_ibfk_3` FOREIGN KEY (`jenis_laundry_id`) REFERENCES `jenis_laundry` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`daerah_id`) REFERENCES `daerah` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_3` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
