-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2021 at 03:27 AM
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
-- Table structure for table `advance`
--

CREATE TABLE `advance` (
  `advanceId` int(11) NOT NULL,
  `advanceAmount` int(11) NOT NULL,
  `payDate` date NOT NULL,
  `advancePayMode` varchar(10) NOT NULL,
  `comissionId` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advance`
--

INSERT INTO `advance` (`advanceId`, `advanceAmount`, `payDate`, `advancePayMode`, `comissionId`, `updatedBy`, `updatedOn`) VALUES
(30, 10000, '2021-03-05', 'Bkash', 7, 'a@a.a', '2021-03-06');

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
('seaum5656@seaum.seaum', 'Johura Khatun Updated', '48615645682', 'uploads/agent/agentPhoto/photo_seaum5656@seaum.seaum.jpg', 'uploads/agent/agentPassport/passport_seaum5656@seaum.seaum.jpg', 'uploads/agent/agentPolice/police_seaum5656@seaum.seaum.jpg', 'This is test', 'a@a.a', '2021-03-06', '2021-03-06 03:02:13'),
('seaum@seaum.seaum', 'Samin Yeasar', '48615645682', 'uploads/agent/agentPhoto/photo_seaum@seaum.seaum.png', 'uploads/agent/agentPassport/passport_seaum@seaum.seaum.png', 'uploads/agent/agentPolice/police_seaum@seaum.seaum.png', 'This is test', 'a@a.a', '2021-03-05', '2021-03-05 06:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `agentcomission`
--

CREATE TABLE `agentcomission` (
  `comissionId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payMode` varchar(10) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agentcomission`
--

INSERT INTO `agentcomission` (`comissionId`, `amount`, `payMode`, `passportNum`, `agentEmail`, `comment`, `creationDate`, `updatedBy`, `updatedOn`) VALUES
(7, 50000, '', 'BX0078911', 'seaum5656@seaum.seaum', '', '2021-03-06 03:21:30', 'a@a.a', '2021-03-06');

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
(35, 15000, 0, '0000-00-00', 'Test Medical', 'Cash', 'BX0078911', '', 'seaum5656@seaum.seaum', '2021-03-06 03:11:19', 'a@a.a', '2021-03-06', ''),
(36, 9500, 0, '0000-00-00', 'Final Medical', 'Bkash', 'BX0078911', '', 'seaum5656@seaum.seaum', '2021-03-06 03:12:07', 'a@a.a', '2021-03-06', ''),
(37, 5000, 0, '0000-00-00', 'MUFA', 'Cash', 'BX0078911', '', 'seaum5656@seaum.seaum', '2021-03-06 03:13:07', 'a@a.a', '2021-03-06', ''),
(38, 9780, 0, '0000-00-00', 'Manpower', 'Cash', 'BX0078911', '', 'seaum5656@seaum.seaum', '2021-03-06 03:13:40', 'a@a.a', '2021-03-06', '');

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
(10, 'RAWAIE', 'OMAN', 'OMAN', 'HOUSEMAID RECRUITMENT', '2021-03-03 07:10:55', 'admin2@admin2.admin2', '2021-03-03', ''),
(11, 'DEMO DELEGATE', 'BD', 'Uttora', 'DEMO OFFICE', '2021-03-06 03:50:02', 'a@a.a', '2021-03-06', 'This is test');

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
(33, 'Waiter', 'a@a.a', '0000-00-00', '2021-03-04 00:34:21'),
(34, 'Cleaner', 'a@a.a', '0000-00-00', '2021-03-05 18:30:12'),
(35, 'Teacher', 'a@a.a', '0000-00-00', '2021-03-06 03:06:03');

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
('BX0078911', 'Test', 'Candidate', '45564556512', '1994-04-04', 'Female', '2021-02-28', 5, '0000-00-00', '0000-00-00', '0000-00-00', 35, 'yes', 'uploads/policeVerification/policeVerification-BX0078911.png', 'BD', 'yes', 'uploads/trainingCard/trainingCard_BX0078911.jpg', '', '', 'no', '', 'uploads/passport/passport_BX0078911.png', 'seaum5656@seaum.seaum', '', 'SENDER TRADE INTERNATIONAL', 'yes', 'uploads/medical/testMedical_BX0078911.jpg', 'yes', 'uploads/medical/finalMedical_BX0078911.jpg', 'no', '', 'no', '', 'no', '', 0, '', 'a@a.a', '2021-03-06 03:07:06', '2021-03-06 03:07:06');

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
(22, 'BX0078911', 'demo_three', 'yes', 'yes', 'yes', 'uploads/okala/okala_BX0078911_demo_one.png', 'yes', 'uploads/okala/mufa_BX0078911_demo_one.png', 'yes', 'yes', '2021-03-06', 'uploads/visa/visaFile_BX0078911_demo_one.png', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_BX0078911_demo_one.png', 'a@a.a', '2021-03-06', '2021-03-06 06:12:32', '');

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
('8745615645645', 'Sponsor Updated', 'This is test', 10, 'a@a.a', '2021-03-06', '2021-03-06 06:03:12'),
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
('demo_one', '1442-07-21', 12, 'female', 32, '8745615645645', '', 'a@a.a', '2021-03-06'),
('demo_three', '1442-07-14', 4, 'female', 35, '324234234', '', 'a@a.a', '2021-03-06');

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

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketId`, `flightDate`, `transit`, `ticketPrice`, `flightNo`, `flightFrom`, `flightTo`, `airline`, `passportNum`, `ticketCopy`, `comment`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
(22, '2021-03-05', 2.00, 50000, '2233', '', 'Jakarta', 'New Airways', 'BX0078911', 'uploads/ticket/ticket_BX0078911.jpg', '', 'a@a.a', '2021-03-06', '2021-03-06 03:14:14');

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
-- Indexes for table `advance`
--
ALTER TABLE `advance`
  ADD PRIMARY KEY (`advanceId`),
  ADD KEY `comissionId` (`comissionId`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentEmail`);

--
-- Indexes for table `agentcomission`
--
ALTER TABLE `agentcomission`
  ADD PRIMARY KEY (`comissionId`),
  ADD KEY `agentEmail` (`agentEmail`),
  ADD KEY `passportNum` (`passportNum`);

--
-- Indexes for table `agentexpense`
--
ALTER TABLE `agentexpense`
  ADD PRIMARY KEY (`agentExpenseId`),
  ADD KEY `agentexpense_ibfk_1` (`agentEmail`);

--
-- Indexes for table `candidateexpense`
--
ALTER TABLE `candidateexpense`
  ADD PRIMARY KEY (`expenseId`),
  ADD KEY `passportNum` (`passportNum`),
  ADD KEY `agentEmail` (`agentEmail`);

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
  ADD KEY `processing_ibfk_1` (`passportNum`),
  ADD KEY `processing_ibfk_2` (`sponsorVisa`);

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
  ADD KEY `ticket_ibfk_1` (`passportNum`);

--
-- Indexes for table `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`visaNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance`
--
ALTER TABLE `advance`
  MODIFY `advanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `agentcomission`
--
ALTER TABLE `agentcomission`
  MODIFY `comissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agentexpense`
--
ALTER TABLE `agentexpense`
  MODIFY `agentExpenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `candidateexpense`
--
ALTER TABLE `candidateexpense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `delegate`
--
ALTER TABLE `delegate`
  MODIFY `delegateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `privateprocessing`
--
ALTER TABLE `privateprocessing`
  MODIFY `privateProcessId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `processing`
--
ALTER TABLE `processing`
  MODIFY `processingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance`
--
ALTER TABLE `advance`
  ADD CONSTRAINT `advance_ibfk_1` FOREIGN KEY (`comissionId`) REFERENCES `agentcomission` (`comissionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agentcomission`
--
ALTER TABLE `agentcomission`
  ADD CONSTRAINT `agentcomission_ibfk_1` FOREIGN KEY (`agentEmail`) REFERENCES `agent` (`agentEmail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agentcomission_ibfk_2` FOREIGN KEY (`passportNum`) REFERENCES `passport` (`passportNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agentexpense`
--
ALTER TABLE `agentexpense`
  ADD CONSTRAINT `agentexpense_ibfk_1` FOREIGN KEY (`agentEmail`) REFERENCES `agent` (`agentEmail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidateexpense`
--
ALTER TABLE `candidateexpense`
  ADD CONSTRAINT `candidateexpense_ibfk_1` FOREIGN KEY (`passportNum`) REFERENCES `passport` (`passportNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidateexpense_ibfk_2` FOREIGN KEY (`agentEmail`) REFERENCES `agent` (`agentEmail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `processing`
--
ALTER TABLE `processing`
  ADD CONSTRAINT `processing_ibfk_1` FOREIGN KEY (`passportNum`) REFERENCES `passport` (`passportNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `processing_ibfk_2` FOREIGN KEY (`sponsorVisa`) REFERENCES `sponsorvisalist` (`sponsorVisa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`delegateId`) REFERENCES `delegate` (`delegateId`) ON DELETE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`passportNum`) REFERENCES `passport` (`passportNum`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
