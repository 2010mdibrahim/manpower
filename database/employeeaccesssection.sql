-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 08:06 AM
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
-- Table structure for table `employeeaccesssection`
--

CREATE TABLE `employeeaccesssection` (
  `sectionId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeaccesssection`
--
ALTER TABLE `employeeaccesssection`
  ADD KEY `employeeId` (`employeeId`),
  ADD KEY `sectionId` (`sectionId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeeaccesssection`
--
ALTER TABLE `employeeaccesssection`
  ADD CONSTRAINT `employeeaccesssection_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `employee` (`employeeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employeeaccesssection_ibfk_2` FOREIGN KEY (`sectionId`) REFERENCES `sections` (`sectionId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
