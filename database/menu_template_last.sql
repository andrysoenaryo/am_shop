-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2016 at 07:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menu_template`
--
CREATE DATABASE IF NOT EXISTS `menu_template` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `menu_template`;

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
(38, 24, 'Change Password', 'admin/user_change_password.php', 4, 2, 0, 'images/menu/security_f2.png', ''),
(39, 24, 'Reset Password User', 'admin/reset_password.php', 5, 2, 0, 'images/menu/1351745751_application-pgp-signature.png', ''),
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
(4, 'Admin Toko'),
(5, 'Officer');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `template_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `folder` text NOT NULL,
  `image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `nama`, `folder`, `image`) VALUES
(1, 'Tema 1', 'template/tema1', 'images/template/tema1.jpg'),
(2, 'Tema 2', 'template/tema2', 'images/template/tema2.jpg');

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
('TKO002', 'Ade M T-Shirt', 'N', 'ademuhid');

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
  `no_hp` int(11) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `status_trx` enum('success','cancel','refund','process') NOT NULL DEFAULT 'process',
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `tgl_trx`, `toko_id`, `inv_trx`, `nama`, `alamat`, `no_hp`, `no_resi`, `status_trx`, `username`) VALUES
('TRX001', '2016-10-16', '', 'sdvsdvs', 'sdvsdvs', 'alamat mana aja', 2147483647, '', 'success', 'superuser');

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

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_detail_id`, `transaksi_id`, `product`, `supplier`, `harga_supplier`, `harga_jual`, `qty`, `harga_refund`) VALUES
(12, 'TRX001', 'aaaaaa', 'bbbbb', 5000, 6000, 10, 0),
(13, 'TRX001', 'Kunci Gantungan', 'toko siapa', 10000, 12000, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trx_template`
--

DROP TABLE IF EXISTS `trx_template`;
CREATE TABLE `trx_template` (
  `trx_template_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `template_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_template`
--

INSERT INTO `trx_template` (`trx_template_id`, `username`, `template_id`, `datetime`) VALUES
(1, 'superuser', 2, '2013-01-29 22:57:36'),
(2, 'andry', 1, '2013-01-29 22:57:55'),
(3, 'superuser', 1, '2013-01-30 00:33:43'),
(4, 'superuser', 2, '2013-01-30 00:34:58'),
(5, 'superuser', 1, '2013-01-30 00:37:23'),
(6, 'superuser', 2, '2013-01-30 00:37:57'),
(7, 'superuser', 2, '2013-01-30 00:38:02'),
(8, 'superuser', 2, '2013-01-30 00:38:06'),
(9, 'superuser', 1, '2013-01-30 00:38:35'),
(10, 'superuser', 1, '2013-01-30 00:38:39'),
(11, 'superuser', 2, '2013-01-30 00:41:59'),
(12, 'superuser', 2, '2013-01-30 00:42:02'),
(13, 'superuser', 1, '2013-01-30 00:42:26'),
(14, 'superuser', 2, '2013-01-30 00:43:10'),
(15, 'superuser', 1, '2013-01-30 00:43:24'),
(16, 'superuser', 2, '2013-01-30 00:44:12'),
(17, 'superuser', 1, '2013-01-30 20:15:00'),
(18, 'superuser', 2, '2013-01-30 20:47:37'),
(19, 'superuser', 1, '2013-01-30 20:47:49'),
(20, 'superuser', 2, '2013-02-11 22:26:25'),
(21, 'superuser', 1, '2013-02-11 22:29:46'),
(22, 'superuser', 1, '2013-04-15 23:17:23'),
(23, 'superuser', 2, '2013-10-02 00:24:01'),
(24, 'superuser', 1, '2013-10-02 00:24:16'),
(25, 'superuser', 2, '2014-05-04 01:42:28'),
(26, 'superuser', 1, '2014-05-04 01:42:43'),
(27, 'superuser', 2, '2014-05-12 23:44:18'),
(28, 'superuser', 1, '2014-05-12 23:44:37'),
(29, 'superuser', 1, '2014-05-16 00:29:36'),
(30, 'superuser', 2, '2014-05-16 00:29:48'),
(31, 'superuser', 1, '2014-05-16 00:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `username` varchar(30) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `nama_lengkap` varchar(50) NOT NULL DEFAULT '0',
  `provinsi` varchar(5) DEFAULT '0',
  `kabupaten` varchar(5) DEFAULT '0',
  `upk` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`username`, `password`, `nama_lengkap`, `provinsi`, `kabupaten`, `upk`) VALUES
('andry', '1fd07199cca4ff81d01dca373c6e03a9', 'andry', '31', '3171', '0'),
('eko', 'e5ea9b6d71086dfef3a15f726abcc5bf', 'eko', '31', '3171', 'P3171050201'),
('ademuhid', 'a562cfa07c2b1213b3a5c99b756fc206', 'Ade Muhid', '0', '0', '0'),
('superuser', 'ac43724f16e9241d990427ab7c8f4228', 'Super User', '0', '0', '0');

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
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`);

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
-- Indexes for table `trx_template`
--
ALTER TABLE `trx_template`
  ADD PRIMARY KEY (`trx_template_id`);

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
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `transaksi_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `trx_template`
--
ALTER TABLE `trx_template`
  MODIFY `trx_template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;