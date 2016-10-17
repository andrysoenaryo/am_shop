-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2016 at 10:21 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `am_shop`
--
CREATE DATABASE IF NOT EXISTS `am_shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `am_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `icon`
--

DROP TABLE IF EXISTS `icon`;
CREATE TABLE `icon` (
  `id_icon` int(11) NOT NULL,
  `nama_icon` varchar(30) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `icon`
--

INSERT INTO `icon` (`id_icon`, `nama_icon`, `class`) VALUES
(1, 'Report', 'fa fa-file-text-o'),
(2, 'Master', 'glyphicon glyphicon-folder-close'),
(3, 'Setup', 'fa fa-cogs'),
(4, 'Menu Report', 'fa fa-paste'),
(5, 'User Account', 'fa fa-users'),
(6, 'Transaction', 'fa fa-cart-plus'),
(7, 'Shopping Bag', 'fa fa-shopping-bag'),
(8, 'Toko', 'fa fa-fort-awesome'),
(9, 'Laptop', 'fa fa-laptop');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `menu_order` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `level` int(11) DEFAULT '1',
  `status` smallint(1) NOT NULL DEFAULT '0',
  `images` varchar(255) NOT NULL DEFAULT 'images/menu/nonimage.png',
  `class_images` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `level`, `status`, `images`, `class_images`) VALUES
(1, 0, 'Home', '', 1, 1, 0, 'images/menu/1351745017_local_network.png', 'fa fa-home'),
(2, 0, 'Master', '', 2, 1, 0, 'images/menu/Personal16.png', 'glyphicon glyphicon-folder-close'),
(3, 0, 'Transaksi', '', 3, 1, 0, 'images/menu/Satellite.png', 'fa fa-cart-plus'),
(8, 0, 'Laporan', '', 4, 1, 0, 'images/menu/Layers.png', 'fa fa-paste'),
(9, 8, 'Lap. Penjualan', 'laporan/views/lap_penjualan.php', 1, 2, 0, 'images/menu/nonimage.png', 'fa fa-file-text-o'),
(24, 0, 'Setup', '', 8, 1, 0, 'images/menu/1351744929_Service Manager.png', 'fa fa-cogs'),
(25, 24, 'Menu Editor', 'admin/views/menu.php', 1, 2, 0, 'images/menu/page3-img5.png', ''),
(36, 24, 'Role', 'admin/views/role.php', 2, 2, 0, 'images/menu/1351745811_people.png', ''),
(37, 24, 'User Account', 'admin/views/user_account.php', 3, 2, 0, 'images/menu/gender16.png', 'fa fa-users'),
(42, 24, 'Icons', 'admin/views/icon.php', 0, 1, 0, 'images/menu/nonimage.png', ''),
(45, 2, 'Toko', 'admin_toko/views/toko.php', 0, 1, 0, 'images/menu/nonimage.png', 'fa fa-fort-awesome'),
(43, 24, 'Menu Privilege', 'admin/views/menu_privilege.php', 0, 1, 0, 'images/menu/nonimage.png', ''),
(44, 24, 'User Role', 'admin/views/user_role.php', 0, 1, 0, 'images/menu/nonimage.png', ''),
(46, 3, 'Penjualan', 'transaksi/views/transaksi_jual.php', 0, 1, 0, 'images/menu/nonimage.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role` (
  `id_menu` int(11) NOT NULL DEFAULT '0',
  `id_role` int(11) NOT NULL DEFAULT '0',
  `ubah` enum('Y','N') DEFAULT 'Y',
  `hapus` enum('Y','N') NOT NULL DEFAULT 'Y',
  `tambah` enum('Y','N') NOT NULL DEFAULT 'Y',
  `tampil` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`id_menu`, `id_role`, `ubah`, `hapus`, `tambah`, `tampil`) VALUES
(1, 1, 'Y', 'Y', 'Y', 'Y'),
(2, 1, 'Y', 'Y', 'Y', 'Y'),
(3, 1, 'Y', 'Y', 'Y', 'Y'),
(4, 1, 'Y', 'Y', 'Y', 'Y'),
(5, 1, 'Y', 'Y', 'Y', 'Y'),
(6, 1, 'Y', 'Y', 'Y', 'Y'),
(7, 1, 'Y', 'Y', 'Y', 'Y'),
(8, 1, 'Y', 'Y', 'Y', 'Y'),
(9, 1, 'Y', 'Y', 'Y', 'Y'),
(10, 1, 'Y', 'Y', 'Y', 'Y'),
(11, 1, 'Y', 'Y', 'Y', 'Y'),
(12, 1, 'Y', 'Y', 'Y', 'Y'),
(13, 1, 'Y', 'Y', 'Y', 'Y'),
(14, 1, 'Y', 'Y', 'Y', 'Y'),
(15, 1, 'Y', 'Y', 'Y', 'Y'),
(16, 1, 'Y', 'Y', 'Y', 'Y'),
(17, 1, 'Y', 'Y', 'Y', 'Y'),
(18, 1, 'Y', 'Y', 'Y', 'Y'),
(19, 1, 'Y', 'Y', 'Y', 'Y'),
(20, 1, 'Y', 'Y', 'Y', 'Y'),
(21, 1, 'Y', 'Y', 'Y', 'Y'),
(22, 1, 'Y', 'Y', 'Y', 'Y'),
(23, 1, 'Y', 'Y', 'Y', 'Y'),
(24, 1, 'Y', 'Y', 'Y', 'Y'),
(25, 1, 'Y', 'Y', 'Y', 'Y'),
(26, 1, 'Y', 'Y', 'Y', 'Y'),
(27, 1, 'Y', 'Y', 'Y', 'Y'),
(28, 1, 'Y', 'Y', 'Y', 'Y'),
(29, 1, 'Y', 'Y', 'Y', 'Y'),
(30, 1, 'Y', 'Y', 'Y', 'Y'),
(31, 1, 'Y', 'Y', 'Y', 'Y'),
(32, 1, 'Y', 'Y', 'Y', 'Y'),
(33, 1, 'Y', 'Y', 'Y', 'Y'),
(34, 1, 'Y', 'Y', 'Y', 'Y'),
(35, 1, 'Y', 'Y', 'Y', 'Y'),
(36, 1, 'Y', 'Y', 'Y', 'Y'),
(37, 1, 'Y', 'Y', 'Y', 'Y'),
(38, 1, 'Y', 'Y', 'Y', 'Y'),
(39, 1, 'Y', 'Y', 'Y', 'Y'),
(40, 1, 'Y', 'Y', 'Y', 'Y'),
(41, 1, 'Y', 'Y', 'Y', 'Y'),
(9, 4, 'Y', 'Y', 'Y', 'Y'),
(2, 4, 'Y', 'Y', 'Y', 'Y'),
(45, 4, 'Y', 'Y', 'Y', 'Y'),
(1, 4, 'Y', 'Y', 'Y', 'Y'),
(3, 4, 'Y', 'Y', 'Y', 'Y'),
(8, 4, 'Y', 'Y', 'Y', 'Y'),
(46, 4, 'Y', 'Y', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Superuser'),
(2, 'Administrator'),
(3, 'Admin'),
(4, 'Admin Toko');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko` (
  `toko_id` varchar(6) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `isactive` enum('Y','N') NOT NULL DEFAULT 'Y',
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`toko_id`, `nama_toko`, `isactive`, `username`) VALUES
('TKO001', 'Ade M Shop', 'Y', 'ademuhid'),
('TKO002', 'Ade M T-Shirt', 'Y', 'ademuhid');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `transaksi_id` varchar(7) NOT NULL,
  `tgl_trx` date NOT NULL,
  `toko_id` varchar(6) NOT NULL,
  `inv_trx` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `status_trx` enum('success','cancel','refund','process') NOT NULL DEFAULT 'process',
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE `transaksi_detail` (
  `transaksi_detail_id` int(11) NOT NULL,
  `transaksi_id` varchar(6) NOT NULL,
  `product` varchar(255) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `harga_supplier` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_refund` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `username` varchar(30) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `nama_lengkap` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`username`, `password`, `nama_lengkap`) VALUES
('administrator', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Administrator'),
('ademuhid', '8277de32db525886b5252ee278dcfe4d', 'Ade Muhid'),
('superuser', 'ac43724f16e9241d990427ab7c8f4228', 'Super User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `username` varchar(30) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`username`, `id_role`) VALUES
('ademuhid', 4),
('administrator', 2),
('andry', 3),
('eko', 2),
('RSSubdit', 2),
('superuser', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `icon`
--
ALTER TABLE `icon`
  ADD PRIMARY KEY (`id_icon`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id_menu`,`id_role`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`toko_id`),
  ADD KEY `index` (`nama_toko`,`username`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `index` (`toko_id`,`nama`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_detail_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`username`,`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `icon`
--
ALTER TABLE `icon`
  MODIFY `id_icon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `transaksi_detail_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
