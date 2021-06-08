-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 11:57 AM
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
-- Table structure for table `delegateaccount`
--

CREATE TABLE `delegateaccount` (
  `delegateAccountId` int(11) NOT NULL,
  `delegateId` int(11) NOT NULL,
  `particular` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `typeOfTransaction` varchar(10) NOT NULL,
  `dateOfTransaction` date NOT NULL,
  `purpose` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedAt` date NOT NULL,
  `updatedBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delegateaccount`
--
ALTER TABLE `delegateaccount`
  ADD PRIMARY KEY (`delegateAccountId`),
  ADD KEY `delegateId` (`delegateId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delegateaccount`
--
ALTER TABLE `delegateaccount`
  MODIFY `delegateAccountId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delegateaccount`
--
ALTER TABLE `delegateaccount`
  ADD CONSTRAINT `delegateaccount_ibfk_1` FOREIGN KEY (`delegateId`) REFERENCES `delegate` (`delegateId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
