-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2021 at 03:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kode_kecamatan` varchar(10) NOT NULL,
  `nama_kecamatan` varchar(30) NOT NULL,
  `deskripsi_kecamatan` text NOT NULL,
  `id_status_idm` varchar(30) NOT NULL,
  `sarana_pendidikan` enum('Mudah','Sulit') NOT NULL,
  `lembaga_pendidikan` varchar(150) NOT NULL,
  `geojson_kecamatan` varchar(255) NOT NULL,
  `warna_kecamatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`id_kecamatan`, `kode_kecamatan`, `nama_kecamatan`, `deskripsi_kecamatan`, `id_status_idm`, `sarana_pendidikan`, `lembaga_pendidikan`, `geojson_kecamatan`, `warna_kecamatan`) VALUES
(1, '35.73.05', 'Lowokwaru', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '1', 'Mudah', 'SD,SMP', 'Lowokwaru42_08.11.21.geojson', '#009900'),
(2, '35.73.04', 'Sukun', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years', '1', 'Sulit', 'SMP', 'Sukun17_08.11.21.geojson', '#0033ff'),
(3, '35.73.01', 'Blimbing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout', '2', 'Mudah', 'SMA', 'Blimbing9_08.11.21.geojson', '#880000'),
(4, '35.73.03', 'Kedungkandang', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable', '3', 'Sulit', 'PT', 'Kedungkandang38_08.11.21.geojson', '#ff00dd'),
(5, '35.73.02', 'Klojen', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '1', 'Mudah', 'TK,SD,SMP,SMA', 'Klojen88_08.11.21.geojson', '#dd9900');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User',
  `kata_sandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `level`, `kata_sandi`) VALUES
(1, 'admin', 'Admin', '$2y$10$FkawwpB7JM/EZ/5o0CFItOU4OTUk36uTmdqMcc4euIkYJL72b3R0S'),
(2, 'user', 'User', '$2y$10$wYBfuIPP8QNajX7c4L6eVuHQdVkHfecLLOgLOA9HzB7YqH.IW1I72');

-- --------------------------------------------------------

--
-- Table structure for table `status_idm`
--

CREATE TABLE `status_idm` (
  `id_status_idm` int(11) NOT NULL,
  `kategori_idm` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_idm`
--

INSERT INTO `status_idm` (`id_status_idm`, `kategori_idm`) VALUES
(1, 'Mandiri'),
(2, 'Maju'),
(3, 'Berkembang'),
(4, 'Tertinggal'),
(5, 'Sangat Tertinggal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `status_idm`
--
ALTER TABLE `status_idm`
  ADD PRIMARY KEY (`id_status_idm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_idm`
--
ALTER TABLE `status_idm`
  MODIFY `id_status_idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
