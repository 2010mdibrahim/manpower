-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 03:06 PM
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
-- Table structure for table `outsideticket`
--

CREATE TABLE `outsideticket` (
  `ticketId` int(11) NOT NULL,
  `flightDate` date NOT NULL,
  `transit` float(4,2) NOT NULL,
  `ticketPrice` int(11) NOT NULL,
  `flightNo` varchar(255) NOT NULL,
  `outsidePassportId` int(11) DEFAULT NULL,
  `flightTo` varchar(255) NOT NULL,
  `airline` varchar(255) NOT NULL,
  `ticketCopy` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL,
  `notified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outsideticket`
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `outsideticket`
--
ALTER TABLE `outsideticket`
  ADD PRIMARY KEY (`ticketId`),
  ADD KEY `outsidePassportId` (`outsidePassportId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `outsideticket`
--
ALTER TABLE `outsideticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `outsideticket`
--
ALTER TABLE `outsideticket`
  ADD CONSTRAINT `outsideticket_ibfk_1` FOREIGN KEY (`outsidePassportId`) REFERENCES `outsidepassport` (`outsidePassportId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
