-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 03:46 AM
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
('a@a.a', 'a', 'test Admin', 'me', '2021-02-22'),
('admin2@admin2.admin2', 'admin', 'test_admin', 'root', '2021-02-18'),
('admin@admin.admin', 'admin', 'Root Admin', 'root', '2021-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentEmail` varchar(255) NOT NULL,
  `agentName` varchar(255) NOT NULL,
  `agentPhone` varchar(255) NOT NULL,
  `agentPhoto` varchar(255) NOT NULL,
  `agentPassport` varchar(255) NOT NULL,
  `agentPoliceClearance` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentEmail`, `agentName`, `agentPhone`, `agentPhoto`, `agentPassport`, `agentPoliceClearance`, `comment`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
('netcall24@gmail.com', 'ABDUR RAHMAN', '01934839360', 'uploads/agent/agentPhoto/photo_netcall24@gmail.com.jpg', 'uploads/agent/agentPassport/passport_netcall24@gmail.com.png', 'uploads/agent/agentPolice/police_netcall24@gmail.com.png', '', 'a@a.a', '2021-03-03', '2021-03-03 07:31:54'),
('ruhulenterprice@gmail.com', 'APPLE MAHMUD', '01791074126', 'uploads/agent/agentPhoto/photo_ruhulenterprice@gmail.com.png', 'uploads/agent/agentPassport/passport_ruhulenterprice@gmail.com.png', 'uploads/agent/agentPolice/police_ruhulenterprice@gmail.com.png', '', 'a@a.a', '2021-03-03', '2021-03-03 07:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `agentexpense`
--

CREATE TABLE `agentexpense` (
  `agentExpenseId` int(11) NOT NULL,
  `expensePurposeAgent` varchar(255) NOT NULL,
  `expenseMode` varchar(10) NOT NULL,
  `fullAmount` int(11) NOT NULL,
  `paidAmount` int(11) NOT NULL,
  `payDate` date NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedNo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidateexpense`
--

CREATE TABLE `candidateexpense` (
  `expenseId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `payDate` date NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `payMode` varchar(10) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `sponsorVisa` varchar(255) NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidateexpense`
--

INSERT INTO `candidateexpense` (`expenseId`, `amount`, `advance`, `payDate`, `purpose`, `payMode`, `passportNum`, `sponsorVisa`, `agentEmail`, `creationDate`, `updatedBy`, `updatedOn`, `comment`) VALUES
(3, 5000, 1000, '2021-03-03', 'testMedical', 'Bkash', 'test_passport_eight_two_adg', '', 'netcall24@gmail.com', '2021-03-04 02:38:43', 'a@a.a', '2021-03-04', ''),
(4, 4000, 1000, '2021-03-03', 'testMedical', 'Bkash', 'test_passport_eight_two_adg', '', 'netcall24@gmail.com', '2021-03-04 02:40:31', 'a@a.a', '2021-03-04', ''),
(5, 5000, 0, '0000-00-00', 'finalMedical', 'Bkash', 'test_passport_eight_two_adg', '', 'netcall24@gmail.com', '2021-03-04 03:14:44', 'a@a.a', '2021-03-04', ''),
(6, 1200, 0, '0000-00-00', 'policeClearance', 'Bkash', 'test_passport_eight_two_adg', '', 'netcall24@gmail.com', '2021-03-04 03:30:02', 'a@a.a', '2021-03-04', ''),
(7, 700, 0, '0000-00-00', 'trainingCard', 'Cash', 'test_passport_eight_two_adg', '', 'netcall24@gmail.com', '2021-03-04 03:30:09', 'a@a.a', '2021-03-04', '');

-- --------------------------------------------------------

--
-- Table structure for table `delegate`
--

CREATE TABLE `delegate` (
  `delegateId` int(11) NOT NULL,
  `delegateName` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `delegateState` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delegate`
--

INSERT INTO `delegate` (`delegateId`, `delegateName`, `country`, `delegateState`, `office`, `creationDate`, `updatedBy`, `updatedOn`, `comment`) VALUES
(8, 'MR.MAHEER', 'SAUDI ARABIA', 'DAMMAM', 'OSUS,INTERNATIONAL NEGOTIATOR,DIPLOMATIC', '2021-03-03 07:42:19', 'admin2@admin2.admin2', '2021-03-03', ''),
(9, 'AHMED SALAMAT', 'JORDAN', 'AMMAN', 'JAKARTA ', '2021-03-03 07:04:54', 'admin2@admin2.admin2', '2021-03-03', ''),
(10, 'RAWAIE', 'OMAN', 'OMAN', 'HOUSEMAID RECRUITMENT', '2021-03-03 07:10:55', 'admin2@admin2.admin2', '2021-03-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expenseId` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `payDate` date NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foreignoffice`
--

CREATE TABLE `foreignoffice` (
  `officeName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobId` int(11) NOT NULL,
  `jobType` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobId`, `jobType`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
(32, 'House Keep', 'a@a.a', '0000-00-00', '2021-03-04 00:34:14'),
(33, 'Waiter', 'a@a.a', '0000-00-00', '2021-03-04 00:34:21');

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
('SENDER TRADE INTERNATIONAL ', 'R.L 541', 'admin2@admin2.admin2', '2021-03-03'),
('MUSCOT INTERNATIONAL', 'R.L 315', 'admin2@admin2.admin2', '2021-03-03'),
('WESTLINE OVERSEAS ', 'R.L 1392', 'admin2@admin2.admin2', '2021-03-03'),
('RUNWAY INTERNATIONAL', '', 'admin2@admin2.admin2', '2021-03-03');

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
  `validity` int(11) NOT NULL,
  `expiryDate` date NOT NULL,
  `departureDate` date NOT NULL,
  `arrivalDate` date NOT NULL,
  `jobId` int(11) NOT NULL,
  `policeClearance` varchar(10) NOT NULL,
  `policeClearanceFile` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `trainingCard` varchar(10) NOT NULL,
  `trainingCardFile` varchar(255) NOT NULL,
  `musanadReady` varchar(10) NOT NULL,
  `musanadEntry` varchar(10) NOT NULL,
  `passportPhoto` varchar(10) NOT NULL,
  `passportPhotoFile` varchar(255) NOT NULL,
  `passportScannedCopy` varchar(255) NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `manpowerOfficeName` varchar(255) NOT NULL,
  `testMedical` varchar(10) NOT NULL,
  `testMedicalFile` varchar(255) NOT NULL,
  `finalMedical` varchar(10) NOT NULL,
  `finalMedicalFile` varchar(255) NOT NULL,
  `oldVisa` varchar(10) NOT NULL,
  `oldVisaFile` varchar(255) NOT NULL,
  `departureSeal` varchar(10) NOT NULL,
  `departureSealFile` varchar(255) NOT NULL,
  `arrivalSeal` varchar(10) NOT NULL,
  `arrivalSealFile` varchar(255) NOT NULL,
  `sponsorVisaAmountId` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` datetime NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passport`
--

INSERT INTO `passport` (`passportNum`, `fName`, `lName`, `mobNum`, `dob`, `gender`, `issueDate`, `validity`, `expiryDate`, `departureDate`, `arrivalDate`, `jobId`, `policeClearance`, `policeClearanceFile`, `country`, `trainingCard`, `trainingCardFile`, `musanadReady`, `musanadEntry`, `passportPhoto`, `passportPhotoFile`, `passportScannedCopy`, `agentEmail`, `office`, `manpowerOfficeName`, `testMedical`, `testMedicalFile`, `finalMedical`, `finalMedicalFile`, `oldVisa`, `oldVisaFile`, `departureSeal`, `departureSealFile`, `arrivalSeal`, `arrivalSealFile`, `sponsorVisaAmountId`, `comment`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
('test_passport_eight_fice', 'Test', 'Candidate', '45564556512', '2021-03-03', 'Female', '2021-03-03', 5, '0000-00-00', '2021-03-03', '2021-03-11', 32, 'no', '', 'OMAN', 'no', '', '', '', 'yes', 'uploads/photo/photo_test_passport_eight_fice.png', 'uploads/passport/passport_test_passport_eight_fice.png', 'netcall24@gmail.com', '', 'SENDER TRADE INTERNATIONAL', 'yes', 'uploads/medical/testMedical_test_passport_eight_fice.jpg', 'yes', 'uploads/medical/finalMedical_test_passport_eight_fice.png', 'yes', 'uploads/passport/oldVisa_test_passport_eight_fice.png', 'yes', 'uploads/passport/departureSeal_test_passport_eight_fice.png', 'yes', 'uploads/passport/arrivalSeal_test_passport_eight_fice.png', 0, '', 'a@a.a', '2021-03-03 16:45:48', '2021-03-03 16:45:48'),
('test_passport_eight_one', 'Test', 'Candidate', '45564556511', '2021-03-03', 'Female', '2021-03-03', 5, '0000-00-00', '0000-00-00', '0000-00-00', 33, 'no', '', 'SAUDI ARABIA', 'yes', 'uploads/trainingCard/trainingCard_test_passport_eight_one.jpg', '', '', 'no', '', 'uploads/passport/passport_test_passport_eight_one.png', 'netcall24@gmail.com', '', 'SENDER TRADE INTERNATIONAL', '', '', '', '', 'no', '', 'no', '', 'no', '', 0, '', 'a@a.a', '2021-03-03 16:04:30', '2021-03-03 16:04:30'),
('test_passport_eight_tea', 'Test', 'Candidate', '45564556511', '2021-03-24', 'Male', '2021-03-03', 5, '0000-00-00', '0000-00-00', '0000-00-00', 33, 'no', '', 'OMAN', '', '', '', '', 'no', '', 'uploads/passport/passport_test_passport_eight_tea.jpg', 'netcall24@gmail.com', '', 'MUSCOT INTERNATIONAL', '', '', '', '', '', '', '', '', '', '', 0, '', 'a@a.a', '2021-03-03 14:03:42', '2021-03-03 14:03:42'),
('test_passport_eight_two', 'Test', 'Candidate', '45564556514', '2021-03-03', 'Female', '2021-03-03', 5, '0000-00-00', '2021-03-03', '2021-03-11', 32, 'no', '', 'SAUDI ARABIA', 'no', '', '', '', 'no', '', 'uploads/passport/passport_test_passport_eight_two.jpg', 'netcall24@gmail.com', '', 'RUNWAY INTERNATIONAL', '', '', '', '', 'yes', 'uploads/passport/oldVisa_test_passport_eight_two.jpg', 'yes', 'uploads/passport/departureSeal_test_passport_eight_two.jpg', 'yes', 'uploads/passport/arrivalSeal_test_passport_eight_two.jpg', 0, '', 'a@a.a', '2021-03-03 16:06:36', '2021-03-03 16:06:36'),
('test_passport_eight_two_adg', 'Test', 'Candidate', '45564556515', '2021-03-03', 'Male', '2021-03-03', 5, '0000-00-00', '2021-03-03', '2021-03-17', 33, 'yes', 'uploads/policeVerification/policeVerification-test_passport_eight_two_adg.png', 'SAUDI ARABIA', 'yes', 'uploads/trainingCard/trainingCard_test_passport_eight_two_adg.png', '', '', 'yes', 'uploads/photo/photo_test_passport_eight_two_adg.png', 'uploads/passport/passport_test_passport_eight_two_adg.jpg', 'netcall24@gmail.com', '', 'MUSCOT INTERNATIONAL', 'yes', 'uploads/medical/testMedical_test_passport_eight_two_adg.png', 'yes', 'uploads/medical/finalMedical_test_passport_eight_two_adg.png', 'yes', 'uploads/oldVisa/oldVisa_test_passport_eight_two_adg.png', 'yes', 'uploads/departureSeal/departureSeal_test_passport_eight_two_adg.png', 'yes', 'uploads/arrivalSeal/arrivalSeal_test_passport_eight_two_adg.png', 0, '', 'a@a.a', '2021-03-03 16:50:20', '2021-03-03 16:50:20'),
('test_passport_one', 'Test', 'Candidate', '45564556511', '1996-11-23', 'Female', '2021-03-03', 5, '0000-00-00', '0000-00-00', '0000-00-00', 33, 'yes', 'uploads/policeVerification/policeVerification-test_passport_one.jpg', 'SAUDI ARABIA', 'yes', 'uploads/trainingCard/trainingCard_test_passport_one.png', '', '', 'no', '', 'uploads/passport/passport_test_passport_one.jpg', 'netcall24@gmail.com', '', 'MUSCOT INTERNATIONAL', 'yes', 'uploads/medical/testMedical_test_passport_one.jpg', 'yes', 'uploads/medical/finalMedical_test_passport_one.jpg', '', '', '', '', '', '', 0, '', 'a@a.a', '2021-03-03 12:37:12', '2021-03-03 12:37:12');

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
-- Table structure for table `processing`
--

CREATE TABLE `processing` (
  `processingId` int(11) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `sponsorVisa` varchar(255) NOT NULL,
  `empRqst` varchar(10) NOT NULL,
  `foreignMole` varchar(10) NOT NULL,
  `okala` varchar(10) NOT NULL,
  `okalaFile` varchar(255) NOT NULL,
  `mufa` varchar(10) NOT NULL,
  `mufaFile` varchar(255) NOT NULL,
  `medicalUpdate` varchar(10) NOT NULL,
  `visaStamping` varchar(10) NOT NULL,
  `visaStampingDate` date NOT NULL,
  `visaFile` varchar(255) NOT NULL,
  `finger` varchar(10) NOT NULL,
  `trainingCard` varchar(10) NOT NULL,
  `trainingCardFile` varchar(255) NOT NULL,
  `manpowerCard` varchar(10) NOT NULL,
  `manpowerCardFile` varchar(255) NOT NULL,
  `updatedBy` varchar(10) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `processing`
--

INSERT INTO `processing` (`processingId`, `passportNum`, `sponsorVisa`, `empRqst`, `foreignMole`, `okala`, `okalaFile`, `mufa`, `mufaFile`, `medicalUpdate`, `visaStamping`, `visaStampingDate`, `visaFile`, `finger`, `trainingCard`, `trainingCardFile`, `manpowerCard`, `manpowerCardFile`, `updatedBy`, `updatedOn`, `creationDate`, `comment`) VALUES
(19, 'test_passport_one', 'demo_two', '', '', 'no', '', 'no', '', 'no', 'no', '0000-00-00', '', 'no', 'no', '', 'no', '', 'a@a.a', '2021-03-03', '2021-03-04 01:18:11', ''),
(20, 'test_passport_eight_two_adg', 'demo_five', '', '', 'no', '', 'no', '', 'no', 'no', '0000-00-00', '', 'no', 'no', '', 'no', '', 'a@a.a', '2021-03-04', '2021-03-04 05:50:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsorNID` varchar(255) NOT NULL,
  `sponsorName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `delegateId` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsorNID`, `sponsorName`, `comment`, `delegateId`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
('324234234', 'Ibrahim', '', 8, 'admin2@admin2.admin2', '2021-03-03', '2021-03-03 10:49:58'),
('DEMO_NID', 'Samin Yeasar', '', 8, 'a@a.a', '2021-03-03', '2021-03-03 12:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorvisalist`
--

CREATE TABLE `sponsorvisalist` (
  `sponsorVisa` varchar(255) NOT NULL,
  `issueDate` date NOT NULL,
  `visaAmount` int(11) NOT NULL,
  `visaGenderType` varchar(10) NOT NULL,
  `jobId` int(11) NOT NULL,
  `sponsorNID` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsorvisalist`
--

INSERT INTO `sponsorvisalist` (`sponsorVisa`, `issueDate`, `visaAmount`, `visaGenderType`, `jobId`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES
('demo_five', '1442-07-19', 4, 'male', 32, 'DEMO_NID', '', 'a@a.a', '2021-03-04'),
('demo_four', '1442-07-19', 4, 'female', 32, 'DEMO_NID', '', 'a@a.a', '2021-03-03'),
('demo_one', '1442-07-19', 5, 'female', 32, '324234234', '', 'a@a.a', '2021-03-03'),
('demo_three', '1442-07-19', 5, 'female', 33, 'DEMO_NID', '', 'a@a.a', '2021-03-03'),
('demo_two', '1442-07-19', 5, 'female', 33, '324234234', '', 'a@a.a', '2021-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int(11) NOT NULL,
  `flightDate` date NOT NULL,
  `transit` float(4,2) NOT NULL,
  `ticketPrice` int(11) NOT NULL,
  `flightNo` varchar(255) NOT NULL,
  `flightFrom` varchar(255) NOT NULL,
  `flightTo` varchar(255) NOT NULL,
  `airline` varchar(255) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `ticketCopy` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
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
  `testMedicalFile` varchar(255) NOT NULL,
  `finalMedical` varchar(10) NOT NULL,
  `finalMedicalFile` varchar(255) NOT NULL,
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

INSERT INTO `visa` (`visaNo`, `jobId`, `jobType`, `entry`, `empRqst`, `foreignMole`, `okala`, `mufa`, `testMedical`, `testMedicalFile`, `finalMedical`, `finalMedicalFile`, `visaStamping`, `finger`, `manpowerOffice`, `passportNum`, `sponsorName`, `comment`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
('asdfasdfasdfasdfasdfasdf', 'asdffasdfasdf', 'cleaner', '', '', '', '', '', '', '', '', '', '', '', 'Test Manpower', 'test_passport_eighteen', 'kfc', 'This is test', 'a@a.a', '2021-02-23', '2021-02-23 01:08:45'),
('hioasdjiojiopsdfa', 'jioassdfgjiosdagjiasdgasdgsdg', 'waiter', '', '', '', '', '', '', '', '', '', '', '', 'Test Manpower Two', 'test_passport_fifteen', 'starbucks', 'This is test', 'a@a.a', '2021-02-23', '2021-02-23 01:11:29'),
('hioasdjiojiopsdfafgdfgasdg', 'jioassdfgjiosdagjiasdgasdgsdg', 'housekeep', '', 'no', 'no', 'no', 'no', 'yes', 'uploads/medical/testMedical-hioasdjiojiopsdfafgdfgasdg.jpg', 'yes', 'uploads/medical/finalMedical-hioasdjiojiopsdfafgdfgasdg.jpg', 'no', 'no', 'Test Manpower Three', 'test_passport_five', 'red lobster', '', 'admin2@admin2.admin2', '2021-02-20', '2021-02-20 02:31:53'),
('hioasdjiojiopsdfafgdfgasdgasdfasfasd', 'asdfasfasfdasfd', 'cleaner', '', '', '', '', '', '', '', '', '', '', '', 'Test Manpower Two', 'test_passport_eighteen', 'kfc', 'This is test', 'a@a.a', '2021-02-23', '2021-02-23 01:10:42'),
('hioasdjiojiopsdfafgdfgasdgasdfasfdasdfasdfasdf', 'asdf', 'cleaner', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'uploads/medical/testMedical-hioasdjiojiopsdfafgdfgasdgasdfasfdasdfasdfasdf.jpg', 'yes', 'uploads/medical/finalMedical-hioasdjiojiopsdfafgdfgasdgasdfasfdasdfasdfasdf.jpg', 'no', 'no', 'Test Manpower Three', 'test_passport_eighteen', 'kfc', 'this is test', 'a@a.a', '2021-02-23', '2021-02-23 01:16:30'),
('hioasdjiojiopsdfafgdfgasdgdsfasdf', 'jioassdfgjiosdagji', 'cleaner', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'uploads/medical/testMedical-hioasdjiojiopsdfafgdfgasdgdsfasdf.jpg', '', '', '', '', 'Test Manpower Four', 'test_passport_eighteen', 'kfc', 'this is test', 'a@a.a', '2021-02-23', '2021-02-23 01:16:08'),
('jioarjidfjpagsjoppodasg', 'dsagpjiaiopsdgp', 'cleaner', '', '', '', '', '', '', '', '', '', '', '', 'Test Manpower Three', 'test_passport_eighteen', 'kfc', 'This is test', 'a@a.a', '2021-02-23', '2021-02-23 01:01:04'),
('test_visa_one', 'test_job_id', 'waiter', '', '', '', '', '', '', '', '', '', '', '', 'Test Manpower Three', 'test_passport_fifteen', 'starbucks', 'This is test', 'admin2@admin2.admin2', '2021-02-22', '2021-02-22 18:25:21');

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
  ADD PRIMARY KEY (`agentExpenseId`),
  ADD KEY `agentEmail` (`agentEmail`);

--
-- Indexes for table `candidateexpense`
--
ALTER TABLE `candidateexpense`
  ADD PRIMARY KEY (`expenseId`);

--
-- Indexes for table `delegate`
--
ALTER TABLE `delegate`
  ADD PRIMARY KEY (`delegateId`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expenseId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobId`);

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
-- Indexes for table `processing`
--
ALTER TABLE `processing`
  ADD PRIMARY KEY (`processingId`),
  ADD KEY `passportNum` (`passportNum`),
  ADD KEY `sponsorVisa` (`sponsorVisa`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsorNID`),
  ADD KEY `delegateId` (`delegateId`);

--
-- Indexes for table `sponsorvisalist`
--
ALTER TABLE `sponsorvisalist`
  ADD PRIMARY KEY (`sponsorVisa`),
  ADD KEY `sponsorName` (`sponsorNID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`),
  ADD KEY `passportNum` (`passportNum`);

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
  MODIFY `agentExpenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `candidateexpense`
--
ALTER TABLE `candidateexpense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delegate`
--
ALTER TABLE `delegate`
  MODIFY `delegateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `privateprocessing`
--
ALTER TABLE `privateprocessing`
  MODIFY `privateProcessId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `processing`
--
ALTER TABLE `processing`
  MODIFY `processingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agentexpense`
--
ALTER TABLE `agentexpense`
  ADD CONSTRAINT `agentexpense_ibfk_1` FOREIGN KEY (`agentEmail`) REFERENCES `agent` (`agentEmail`) ON DELETE CASCADE;

--
-- Constraints for table `processing`
--
ALTER TABLE `processing`
  ADD CONSTRAINT `processing_ibfk_1` FOREIGN KEY (`passportNum`) REFERENCES `passport` (`passportNum`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `processing_ibfk_2` FOREIGN KEY (`sponsorVisa`) REFERENCES `sponsorvisalist` (`sponsorVisa`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`delegateId`) REFERENCES `delegate` (`delegateId`) ON DELETE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`passportNum`) REFERENCES `passport` (`passportNum`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
