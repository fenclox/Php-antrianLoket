-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2020 at 06:16 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whms_`
--

-- --------------------------------------------------------

--
-- Table structure for table `ex_antrian`
--

CREATE TABLE `ex_antrian` (
  `id` bigint(20) NOT NULL,
  `no_urut` tinyint(4) NOT NULL,
  `tanggal_ins` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ex_antrian`
--

INSERT INTO `ex_antrian` (`id`, `no_urut`, `tanggal_ins`) VALUES
(1, 1, '2020-09-23 14:03:43'),
(2, 2, '2020-09-23 14:25:52'),
(3, 3, '2020-09-23 14:25:52'),
(4, 1, '2020-09-24 14:34:36'),
(5, 2, '2020-09-24 14:34:36'),
(6, 3, '2020-09-24 16:17:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ex_antrian`
--
ALTER TABLE `ex_antrian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ex_antrian`
--
ALTER TABLE `ex_antrian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
