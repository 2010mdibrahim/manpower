-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 03:13 PM
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
-- Table structure for table `passportexperiencedcountry`
--

CREATE TABLE `passportexperiencedcountry` (
  `expCountryId` int(11) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `passportCreationDate` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passportexperiencedcountry`
--

INSERT INTO `passportexperiencedcountry` (`expCountryId`, `passportNum`, `passportCreationDate`, `country`) VALUES
(1, 'BE00789113', '2021-03-31 08:30:09', ''),
(2, 'BE00789112', '2021-03-31 08:35:48', 'japan'),
(3, 'BE00789112', '2021-03-31 08:35:48', 'italy'),
(4, 'BE00789112', '2021-03-31 08:35:48', 'nepal'),
(5, 'BE00789112', '2021-03-31 08:35:48', 'vutan'),
(6, 'BE0078911112', '2021-03-31 09:53:14', 'japan'),
(7, 'BE0078911', '2021-03-31 14:30:44', 'japan'),
(8, 'BE0078911', '2021-03-31 14:30:44', 'italy'),
(9, 'BX0078911', '2021-03-31 14:32:40', ''),
(10, 'BT0078911', '2021-03-31 14:40:10', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passportexperiencedcountry`
--
ALTER TABLE `passportexperiencedcountry`
  ADD PRIMARY KEY (`expCountryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passportexperiencedcountry`
--
ALTER TABLE `passportexperiencedcountry`
  MODIFY `expCountryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
