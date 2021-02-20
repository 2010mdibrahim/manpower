-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2021 at 02:53 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminEmail`, `adminPass`, `adminName`, `updatedBy`, `updatedOn`) VALUES
('admin2@admin2.admin2', 'admin', 'test_admin', 'root', '2021-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentEmail` varchar(255) NOT NULL,
  `agentName` varchar(255) NOT NULL,
  `agentPhone` varchar(255) NOT NULL,
  `agentPhoto` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentEmail`, `agentName`, `agentPhone`, `agentPhoto`, `comment`, `updatedBy`, `updatedOn`) VALUES
('seaum2@seaum2.seaum2', 'Samin Test One', '4861564568', 'uploads/seaum2@seaum2.seaum2.jpg', 'No', 'admin2@admin2.admin2', '2021-02-18'),
('seaum@seaum.seaum', 'Samin Test Two', '4861564568', 'uploads/seaum@seaum.seaum.jpg', 'No', 'admin2@admin2.admin2', '2021-02-18'),
('seaum@seaum.seaumasdf', 'Samin Test Three', '4861564568', 'uploads/seaum@seaum.seaumasdf.jpg', 'No', 'admin2@admin2.admin2', '2021-02-18'),
('seaumtest@seaum.seaum', 'Samin Test Four', '4861564568', 'uploads/seaumtest@seaum.seaum.jpg', 'No', 'admin2@admin2.admin2', '2021-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `agentexpense`
--

CREATE TABLE `agentexpense` (
  `agentExpenseId` int(11) NOT NULL,
  `expensePurposeAgent` varchar(255) NOT NULL,
  `fullAmount` int(11) NOT NULL,
  `paidAmount` int(11) NOT NULL,
  `payDate` date NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedNo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agentexpense`
--

INSERT INTO `agentexpense` (`agentExpenseId`, `expensePurposeAgent`, `fullAmount`, `paidAmount`, `payDate`, `agentEmail`, `comment`, `creationDate`, `updatedBy`, `updatedNo`) VALUES
(1, 'test', 1500, 0, '0000-00-00', 'seaum2@seaum2.seaum2', 'This is test', '0000-00-00 00:00:00', 'admin2@admin2.admin2', '2021-02-19'),
(2, '', 0, 0, '0000-00-00', '--- Select Agent ---', '', '0000-00-00 00:00:00', 'admin2@admin2.admin2', '2021-02-19'),
(3, 'for test', 15000, 0, '0000-00-00', 'seaum@seaum.seaum', 'This is test', '2021-02-19 23:30:59', 'admin2@admin2.admin2', '2021-02-19'),
(4, 'for test', 1700, 0, '0000-00-00', 'seaum@seaum.seaumasdf', 'This is test', '2021-02-19 23:32:19', 'admin2@admin2.admin2', '2021-02-19'),
(5, 'for test', 7800, 800, '2021-02-01', 'seaum2@seaum2.seaum2', 'This is test', '2021-02-19 23:33:11', 'admin2@admin2.admin2', '2021-02-20'),
(6, 'for test', 9800, 540, '2021-02-01', 'seaum@seaum.seaum', 'This is test', '2021-02-19 23:34:17', 'admin2@admin2.admin2', '2021-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `manpoweroffice`
--

CREATE TABLE `manpoweroffice` (
  `manpowerOfficeName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manpoweroffice`
--

INSERT INTO `manpoweroffice` (`manpowerOfficeName`, `comment`, `updatedBy`, `updatedOn`) VALUES
('Test Manpower', 'This is test', 'admin2@admin2.admin2', '2021-02-19'),
('Test Manpower Two', 'This is test', 'admin2@admin2.admin2', '2021-02-19'),
('Test Manpower Three', 'this is test', 'admin2@admin2.admin2', '2021-02-19'),
('Test Manpower Four', 'This is test ', 'admin2@admin2.admin2', '2021-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `officeName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passport`
--

CREATE TABLE `passport` (
  `passportNum` varchar(255) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `mobNum` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `issueDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `departureDate` date NOT NULL,
  `arrivalDate` date NOT NULL,
  `policeClearance` varchar(10) NOT NULL,
  `country` varchar(255) NOT NULL,
  `trainingCard` varchar(10) NOT NULL,
  `musanadReady` varchar(10) NOT NULL,
  `musanadEntry` varchar(10) NOT NULL,
  `passportPhoto` varchar(10) NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passport`
--

INSERT INTO `passport` (`passportNum`, `fName`, `lName`, `mobNum`, `dob`, `gender`, `issueDate`, `expiryDate`, `departureDate`, `arrivalDate`, `policeClearance`, `country`, `trainingCard`, `musanadReady`, `musanadEntry`, `passportPhoto`, `agentEmail`, `comment`, `updatedBy`, `updatedOn`) VALUES
('test_passport_five', 'Test', 'Candidate', '4556455651', '1996-02-01', 'Female', '2021-01-31', '2024-12-19', '2021-01-31', '2021-05-31', 'yes', 'Bangladesh', 'yes', 'ready', 'submitted', 'yes', 'seaum2@seaum2.seaum2', 'This is test', 'admin2@admin2.admin2', '2021-02-19 00:00:00'),
('test_passport_four', 'Test', 'Candidate', '4556455651', '1996-01-28', 'Male', '2021-01-31', '2036-06-17', '2019-01-18', '2021-02-18', 'yes', 'Bangladesh', '', 'ready', 'no', 'yes', 'seaum@seaum.seaumasdf', 'This is test ', 'admin2@admin2.admin2', '2021-02-19 00:00:00'),
('test_passport_one', 'Samin', 'Test Updated', '4556455651', '1996-02-18', 'Male', '2019-01-01', '2029-01-01', '2021-02-01', '2021-06-30', 'yes', 'Bangladesh', 'yes', 'ready', 'no', 'yes', 'seaum2@seaum2.seaum2', 'This is test', 'admin2@admin2.admin2', '2021-02-18 00:00:00'),
('test_passport_six', 'Test', 'Candidate', '4556455651', '1996-02-06', 'Male', '2021-01-31', '2030-06-12', '2021-02-01', '2022-09-30', 'yes', 'Bangladesh', '', 'ready', 'submitted', 'yes', 'seaumtest@seaum.seaum', 'This is test', 'admin2@admin2.admin2', '2021-02-19 20:32:15'),
('test_passport_two', 'Samin', 'Test Two', '4556455651', '1996-01-28', 'Female', '2021-01-31', '2031-01-31', '2017-01-01', '2019-01-01', 'yes', 'BD', '', 'ready', 'no', 'yes', 'seaum@seaum.seaumasdf', 'This is test', 'admin2@admin2.admin2', '2021-02-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `privateprocessing`
--

CREATE TABLE `privateprocessing` (
  `privateProcessId` int(11) NOT NULL,
  `officeName` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsorName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsorName`, `comment`, `updatedBy`, `updatedOn`) VALUES
('kfc', 'This is test', 'admin2@admin2.admin2', '2021-02-19'),
('red lobster', 'this is test', 'admin2@admin2.admin2', '2021-02-19'),
('starbucks', 'This is test ', 'admin2@admin2.admin2', '2021-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorvisalist`
--

CREATE TABLE `sponsorvisalist` (
  `sponsorVisaAmountId` int(11) NOT NULL,
  `visaAmount` int(11) NOT NULL,
  `visaGenderType` varchar(10) NOT NULL,
  `jobType` varchar(255) NOT NULL,
  `sponsorName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsorvisalist`
--

INSERT INTO `sponsorvisalist` (`sponsorVisaAmountId`, `visaAmount`, `visaGenderType`, `jobType`, `sponsorName`, `comment`, `updatedBy`, `updatedOn`) VALUES
(0, 45, 'female', 'housekeep', 'red lobster', 'This is test', 'admin2@admin2.admin2', '2021-02-19'),
(0, 789, 'female', 'housekeep', 'starbucks', 'this is test', 'admin2@admin2.admin2', '2021-02-19'),
(0, 90, 'male', 'cleaner', 'kfc', 'This is test', 'admin2@admin2.admin2', '2021-02-19'),
(0, 200, 'male', 'waiter', 'starbucks', 'This is test', 'admin2@admin2.admin2', '2021-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int(11) NOT NULL,
  `flightDate` date NOT NULL,
  `ticketPrice` int(11) NOT NULL,
  `passporNum` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visa`
--

CREATE TABLE `visa` (
  `visaNo` varchar(255) NOT NULL,
  `jobId` varchar(255) NOT NULL,
  `jobType` varchar(255) NOT NULL,
  `entry` varchar(10) NOT NULL,
  `empRqst` varchar(10) NOT NULL,
  `foreignMole` varchar(10) NOT NULL,
  `okala` varchar(10) NOT NULL,
  `mufa` varchar(10) NOT NULL,
  `testMedical` varchar(10) NOT NULL,
  `finalMedical` varchar(10) NOT NULL,
  `visaStamping` varchar(10) NOT NULL,
  `finger` varchar(10) NOT NULL,
  `manpowerOffice` varchar(255) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `sponsorName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visa`
--

INSERT INTO `visa` (`visaNo`, `jobId`, `jobType`, `entry`, `empRqst`, `foreignMole`, `okala`, `mufa`, `testMedical`, `finalMedical`, `visaStamping`, `finger`, `manpowerOffice`, `passportNum`, `sponsorName`, `comment`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
('hioasdjiojiopsdfafgdfgasdg', 'jioassdfgjiosdagjiasdgasdgsdg', 'housekeep', '', '', '', '', '', '', '', '', '', 'Test Manpower Three', 'test_passport_five', 'red lobster', '', 'admin2@admin2.admin2', '2021-02-20', '2021-02-20 02:31:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminEmail`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentEmail`);

--
-- Indexes for table `agentexpense`
--
ALTER TABLE `agentexpense`
  ADD PRIMARY KEY (`agentExpenseId`);

--
-- Indexes for table `passport`
--
ALTER TABLE `passport`
  ADD PRIMARY KEY (`passportNum`);

--
-- Indexes for table `privateprocessing`
--
ALTER TABLE `privateprocessing`
  ADD PRIMARY KEY (`privateProcessId`);

--
-- Indexes for table `sponsorvisalist`
--
ALTER TABLE `sponsorvisalist`
  ADD PRIMARY KEY (`visaGenderType`,`jobType`,`sponsorName`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`visaNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agentexpense`
--
ALTER TABLE `agentexpense`
  MODIFY `agentExpenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `privateprocessing`
--
ALTER TABLE `privateprocessing`
  MODIFY `privateProcessId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
