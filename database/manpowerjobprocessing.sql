-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 10:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samin_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `manpowerjobprocessing`
--

CREATE TABLE `manpowerjobprocessing` (
  `manpowerJobProcessingId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `processingCost` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manpowerjobprocessing`
--
ALTER TABLE `manpowerjobprocessing`
  ADD PRIMARY KEY (`manpowerJobProcessingId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manpowerjobprocessing`
--
ALTER TABLE `manpowerjobprocessing`
  MODIFY `manpowerJobProcessingId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
