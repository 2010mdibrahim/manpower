-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 01:47 PM
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
(53, 10500, '2021-03-15', 'Cash', 33, 'a@a.a', '2021-03-15'),
(54, 5000, '2021-03-01', 'Bkash', 33, 'a@a.a', '2021-03-15');

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
  `payDate` date NOT NULL,
  `paidAmount` int(11) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `passportCreationDate` datetime NOT NULL,
  `agentEmail` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agentcomission`
--

INSERT INTO `agentcomission` (`comissionId`, `amount`, `payMode`, `payDate`, `paidAmount`, `passportNum`, `passportCreationDate`, `agentEmail`, `comment`, `creationDate`, `updatedBy`, `updatedOn`) VALUES
(31, 55000, 'Cash', '2021-03-15', 9550, 'BB0078911', '2021-03-15 08:27:03', 'seaum@seaum.seaum', '', '2021-03-15 08:27:03', 'a@a.a', '2021-03-15'),
(32, 95000, 'Cash', '2021-03-15', 80000, 'BA0078911', '2021-03-15 08:26:07', 'seaum@seaum.seaum', '', '2021-03-15 14:01:16', 'a@a.a', '2021-03-15'),
(33, 95000, 'Cash', '2021-03-15', 55470, 'BT0078911', '2021-03-15 11:52:09', 'seaum@seaum.seaum', '', '2021-03-15 11:52:09', 'a@a.a', '2021-03-15');

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

--
-- Dumping data for table `agentexpense`
--

INSERT INTO `agentexpense` (`agentExpenseId`, `expensePurposeAgent`, `expenseMode`, `fullAmount`, `paidAmount`, `payDate`, `agentEmail`, `comment`, `creationDate`, `updatedBy`, `updatedNo`) VALUES
(11, 'Processing', 'Bkash', 5000, 0, '2021-03-07', 'seaum5656@seaum.seaum', '', '2021-03-07 21:26:14', 'a@a.a', '2021-03-07'),
(12, 'for test', 'Cash', 250, 0, '2021-03-14', 'seaum5656@seaum.seaum', '', '2021-03-07 21:27:02', 'a@a.a', '2021-03-07'),
(13, 'Processing', 'Cash', 5000, 0, '2021-03-15', 'seaum5656@seaum.seaum', '', '2021-03-15 08:46:56', 'a@a.a', '2021-03-15');

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
  `passportCreationDate` datetime NOT NULL,
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

INSERT INTO `candidateexpense` (`expenseId`, `amount`, `advance`, `payDate`, `purpose`, `payMode`, `passportNum`, `passportCreationDate`, `sponsorVisa`, `agentEmail`, `creationDate`, `updatedBy`, `updatedOn`, `comment`) VALUES
(61, 450, 0, '0000-00-00', 'Test Medical', 'Cash', 'BB0078911', '2021-03-15 08:27:03', '', 'seaum@seaum.seaum', '2021-03-15 08:45:10', 'a@a.a', '2021-03-15', ''),
(62, 1000, 0, '0000-00-00', 'Test Medical', 'Cash', 'BT0078911', '2021-03-15 11:52:09', '', 'seaum@seaum.seaum', '2021-03-15 11:52:30', 'a@a.a', '2021-03-15', ''),
(63, 1600, 0, '0000-00-00', 'Final Medical', 'Bkash', 'BT0078911', '2021-03-15 11:52:09', '', 'seaum@seaum.seaum', '2021-03-15 11:53:27', 'a@a.a', '2021-03-15', ''),
(64, 2500, 0, '0000-00-00', 'Police Clearance', 'Bkash', 'BT0078911', '2021-03-15 11:52:09', '', 'seaum@seaum.seaum', '2021-03-15 11:54:05', 'a@a.a', '2021-03-15', ''),
(66, 4500, 0, '0000-00-00', 'Okala', 'Cash', 'BT0078911', '2021-03-15 11:52:09', '', 'seaum@seaum.seaum', '2021-03-15 12:11:40', 'a@a.a', '2021-03-15', ''),
(67, 1200, 0, '0000-00-00', 'MUFA', 'Cash', 'BT0078911', '2021-03-15 11:52:09', '', 'seaum@seaum.seaum', '2021-03-15 12:12:16', 'a@a.a', '2021-03-15', ''),
(68, 1230, 0, '0000-00-00', 'Manpower', 'Cash', 'BT0078911', '2021-03-15 11:52:09', '', 'seaum@seaum.seaum', '2021-03-15 12:17:49', 'a@a.a', '2021-03-15', '');

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
-- Table structure for table `delegateexpense`
--

CREATE TABLE `delegateexpense` (
  `delegateExpenseId` int(11) NOT NULL,
  `delegateId` int(11) NOT NULL,
  `candidateNumber` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payDate` date NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delegateexpense`
--

INSERT INTO `delegateexpense` (`delegateExpenseId`, `delegateId`, `candidateNumber`, `amount`, `payDate`, `comment`, `updatedBy`, `updatedOn`) VALUES
(1, 8, 5, 500000, '2021-03-08', '', 'a@a.a', '2021-03-08'),
(2, 8, 5, 8500000, '2021-03-08', '', 'a@a.a', '2021-03-08'),
(3, 8, 9, 120000, '2021-03-08', '', 'a@a.a', '2021-03-08'),
(4, 8, 9, 120000, '2021-03-08', '', 'a@a.a', '2021-03-08'),
(5, 8, 12, 1200000, '2021-03-08', '', 'a@a.a', '2021-03-08'),
(8, 8, 45, 4500000, '2021-03-08', '', 'a@a.a', '2021-03-08'),
(11, 11, 12, 1200000, '2021-03-15', '', 'a@a.a', '2021-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `delegateofficeexpense`
--

CREATE TABLE `delegateofficeexpense` (
  `expenseId` int(11) NOT NULL,
  `manpowerOfficeId` int(11) NOT NULL,
  `officeReceipt` varchar(255) NOT NULL,
  `delegateId` int(11) NOT NULL,
  `delegateReceipt` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delegateofficeexpense`
--

INSERT INTO `delegateofficeexpense` (`expenseId`, `manpowerOfficeId`, `officeReceipt`, `delegateId`, `delegateReceipt`, `amount`, `date`, `updatedBy`, `updatedOn`, `comment`) VALUES
(6, 3, 'uploads/delegateOfficeExpense/officeReceipt_1615803926_3.jpg', 9, 'uploads/delegateOfficeExpense/delegateReceipt_1615803926_9.jpg', 120500, '2021-03-15', 'a@a.a', '2021-03-15', ''),
(7, 3, 'uploads/delegateOfficeExpense/officeReceipt_1615804401_3.png', 9, 'uploads/delegateOfficeExpense/delegateReceipt_1615804401_10.png', 55000, '2021-03-15', 'a@a.a', '2021-03-15', ''),
(8, 4, 'uploads/delegateOfficeExpense/officeReceipt_1615804427_4.jpg', 9, 'uploads/delegateOfficeExpense/delegateReceipt_1615804427_9.png', 88000, '2021-03-09', 'a@a.a', '2021-03-15', '');

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
  `manpowerOfficeId` int(11) NOT NULL,
  `manpowerOfficeName` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manpoweroffice`
--

INSERT INTO `manpoweroffice` (`manpowerOfficeId`, `manpowerOfficeName`, `comment`, `updatedBy`, `updatedOn`) VALUES
(1, 'SENDER TRADE INTERNATIONAL ', 'R.L 541', 'admin2@admin2.admin2', '2021-03-03'),
(2, 'MUSCOT INTERNATIONAL', 'R.L 315', 'admin2@admin2.admin2', '2021-03-03'),
(3, 'WESTLINE OVERSEAS ', 'R.L 1392', 'admin2@admin2.admin2', '2021-03-03'),
(4, 'RUNWAY INTERNATIONAL', '', 'admin2@admin2.admin2', '2021-03-03');

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
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passportcompleted`
--

CREATE TABLE `passportcompleted` (
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
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passportcompleted`
--

INSERT INTO `passportcompleted` (`passportNum`, `fName`, `lName`, `mobNum`, `dob`, `gender`, `issueDate`, `validity`, `expiryDate`, `departureDate`, `arrivalDate`, `jobId`, `policeClearance`, `policeClearanceFile`, `country`, `trainingCard`, `trainingCardFile`, `musanadReady`, `musanadEntry`, `passportPhoto`, `passportPhotoFile`, `passportScannedCopy`, `agentEmail`, `office`, `manpowerOfficeName`, `testMedical`, `testMedicalFile`, `finalMedical`, `finalMedicalFile`, `oldVisa`, `oldVisaFile`, `departureSeal`, `departureSealFile`, `arrivalSeal`, `arrivalSealFile`, `sponsorVisaAmountId`, `comment`, `updatedBy`, `updatedOn`, `creationDate`) VALUES
('BA0078911', 'Test', 'Candidate 1', '45564556512', '1994-07-04', 'Female', '2019-04-07', 5, '0000-00-00', '0000-00-00', '0000-00-00', 34, 'yes', 'uploads/policeVerification/policeVerification_BA0078911_2021-03-15 082607.jpg', 'OMAN', 'yes', 'uploads/trainingCard/trainingCard_BA0078911_2021-03-15 082607.jpg', '', '', 'no', '', 'uploads/passport/passport_BA0078911_2021-03-15 082607.jpg', 'seaum@seaum.seaum', '', 'MUSCOT INTERNATIONAL', 'yes', 'uploads/medical/testMedical_BA0078911_2021-03-15 082607.jpg', 'yes', 'uploads/medical/finalMedical_BA0078911_2021-03-15 082607.jpg', 'no', '', 'no', '', 'no', '', 0, '', 'a@a.a', '2021-03-15', '2021-03-15 08:26:07'),
('BB0078911', 'Test', 'Candidate 2', '54545454544', '1994-01-04', 'Female', '2021-03-15', 5, '0000-00-00', '0000-00-00', '0000-00-00', 34, 'yes', 'uploads/policeVerification/policeVerification_BB0078911_2021-03-15 082703.jpg', 'OMAN', 'yes', 'uploads/trainingCard/trainingCard_BB0078911_2021-03-15 082703.png', '', '', 'no', '', 'uploads/passport/passport_BB0078911_2021-03-15 082703.png', 'seaum@seaum.seaum', '', 'MUSCOT INTERNATIONAL', 'yes', 'uploads/medical/testMedical_BB0078911_2021-03-15 082703.jpg', 'yes', 'uploads/medical/finalMedical_BB0078911_2021-03-15 082703.jpg', 'no', '', 'no', '', 'no', '', 0, '', 'a@a.a', '2021-03-15', '2021-03-15 08:27:03'),
('BT0078911', 'Test', 'Candidate', '45564556511', '1995-03-06', 'Female', '2021-03-15', 5, '0000-00-00', '2015-05-01', '2021-03-01', 34, 'yes', 'uploads/policeVerification/policeVerification_BT0078911_2021-03-15 115209.jpg', 'BD', 'no', '', '', '', 'no', '', 'uploads/passport/passport_BT0078911_2021-03-15 115209.png', 'seaum@seaum.seaum', '', 'MUSCOT INTERNATIONAL', 'yes', 'uploads/medical/testMedical_BT0078911_2021-03-15 115209.jpg', 'yes', 'uploads/medical/finalMedical_BT0078911_2021-03-15 115209.jpg', 'yes', 'uploads/oldVisa/oldVisa_BT0078911.jpg', 'yes', 'uploads/departureSeal/departureSeal_BT0078911_2021-03-15 115209.jpg', 'yes', 'uploads/arrivalSeal/arrivalSeal_BT0078911_2021-03-15 115209.jpg', 0, '', 'a@a.a', '0000-00-00', '2021-03-15 11:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `paymentMode` varchar(50) NOT NULL,
  `creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`paymentMode`, `creationDate`) VALUES
('Bkash', '2021-03-08'),
('Cash', '2021-03-08'),
('Check', '2021-03-08');

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
  `passportCreationDate` datetime NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `processingcompleted`
--

CREATE TABLE `processingcompleted` (
  `processingId` int(11) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `passportCreationDate` datetime NOT NULL,
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
-- Dumping data for table `processingcompleted`
--

INSERT INTO `processingcompleted` (`processingId`, `passportNum`, `passportCreationDate`, `sponsorVisa`, `empRqst`, `foreignMole`, `okala`, `okalaFile`, `mufa`, `mufaFile`, `medicalUpdate`, `visaStamping`, `visaStampingDate`, `visaFile`, `finger`, `trainingCard`, `trainingCardFile`, `manpowerCard`, `manpowerCardFile`, `updatedBy`, `updatedOn`, `creationDate`, `comment`) VALUES
(33, 'BA0078911', '2019-03-09 00:32:21', 'demo_nine', 'yes', 'yes', 'yes', 'uploads/okala/okala_33.png', 'yes', 'uploads/okala/mufa_33.jpg', 'yes', 'yes', '2021-03-08', '', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_BA0078911_demo_nine.jpg', 'a@a.a', '2021-03-09', '2021-03-09 01:37:35', ''),
(38, 'BD0078911', '2021-03-15 05:11:32', 'demo_seven', 'yes', 'yes', 'yes', 'uploads/okala/okala_38.png', 'yes', 'uploads/okala/mufa_38.png', 'yes', 'yes', '2021-03-15', '', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_38.jpg', 'a@a.a', '2021-03-15', '2021-03-15 06:35:40', ''),
(41, 'BT0078911', '2021-03-15 08:11:51', 'demo_five', 'yes', 'yes', 'yes', 'uploads/okala/okala_41.jpg', 'yes', 'uploads/okala/mufa_41.jpg', 'yes', 'yes', '2021-03-15', '', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_41.jpg', 'a@a.a', '2021-03-15', '2021-03-15 08:12:31', ''),
(42, 'BA0078911', '2021-03-15 08:26:07', 'demo_five', 'yes', 'yes', 'yes', 'uploads/okala/okala_42.jpg', 'yes', 'uploads/okala/mufa_42.jpg', 'yes', 'yes', '2021-03-15', '', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_42.jpg', 'a@a.a', '2021-03-15', '2021-03-15 08:27:28', ''),
(43, 'BB0078911', '2021-03-15 08:27:03', 'demo_five', 'yes', 'yes', 'yes', 'uploads/okala/okala_43.jpg', 'yes', 'uploads/okala/mufa_43.jpg', 'yes', 'yes', '2021-03-15', '', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_43.jpg', 'a@a.a', '2021-03-15', '2021-03-15 09:03:06', ''),
(44, 'BT0078911', '2021-03-15 11:52:09', 'demo_eight', 'yes', 'yes', 'yes', 'uploads/okala/okala_44.jpg', 'yes', 'uploads/okala/mufa_44.jpg', 'yes', 'yes', '2021-03-14', '', 'yes', 'no', '', 'yes', 'uploads/trainingCard/manpower_44.jpg', 'a@a.a', '2021-03-15', '2021-03-15 12:07:39', '');

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
('8455615645645', 'Arif Abedin', '', 11, 'a@a.a', '2021-03-15', '2021-03-15 03:06:48'),
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
('demo_eight', '1442-08-02', 44, 'female', 34, '8455615645645', '', 'a@a.a', '2021-03-15'),
('demo_five', '1442-08-02', 40, 'female', 34, '8745615645645', '', 'a@a.a', '2021-03-15'),
('demo_nine', '1442-07-24', 47, 'female', 34, 'DEMO_NID', '', 'a@a.a', '2021-03-09'),
('demo_one', '1442-07-21', 59, 'female', 32, '8745615645645', '', 'a@a.a', '2021-03-06'),
('demo_seven', '1442-08-02', 44, 'female', 32, '324234234', '', 'a@a.a', '2021-03-15'),
('demo_six', '1442-07-24', 45, 'female', 34, '324234234', '', 'a@a.a', '2021-03-08'),
('demo_three', '1442-07-14', 0, 'female', 35, '324234234', '', 'a@a.a', '2021-03-06');

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
  `passportCreationDate` datetime NOT NULL,
  `ticketCopy` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `creationDate` datetime NOT NULL,
  `notified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketId`, `flightDate`, `transit`, `ticketPrice`, `flightNo`, `flightFrom`, `flightTo`, `airline`, `passportNum`, `passportCreationDate`, `ticketCopy`, `comment`, `updatedBy`, `updatedOn`, `creationDate`, `notified`) VALUES
(38, '2021-03-15', 0.00, 15000, '2233', '', 'jakarta', 'new airways', 'BA0078911', '2021-03-15 08:26:07', 'uploads/ticket/ticket_BA0078911.png', '', 'a@a.a', '2021-03-15', '2021-03-15 13:35:48', ''),
(39, '2021-03-15', 0.00, 45000, '2233', '', 'Jakarta', 'New Airways', 'BB0078911', '2021-03-15 08:27:03', 'uploads/ticket/ticket_BB0078911.png', '', 'a@a.a', '2021-03-15', '2021-03-15 09:03:54', 'yes'),
(40, '2021-03-16', 9.00, 12000, '2233', '', 'Jakarta', 'New Airways', 'BT0078911', '2021-03-15 11:52:09', 'uploads/ticket/ticket_BT0078911.png', '', 'a@a.a', '2021-03-15', '2021-03-15 12:18:24', 'yes');

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

-- --------------------------------------------------------

--
-- Table structure for table `visafile`
--

CREATE TABLE `visafile` (
  `visaFileId` int(11) NOT NULL,
  `visaFile` varchar(255) NOT NULL,
  `processingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visafile`
--

INSERT INTO `visafile` (`visaFileId`, `visaFile`, `processingId`) VALUES
(22, 'uploads/visa/visaFile_0_33_.jpg', 33),
(23, 'uploads/visa/visaFile_1_33_.jpg', 33),
(24, 'uploads/visa/visaFile_2_33_.png', 33),
(25, 'uploads/visa/visaFile_0_34_.jpg', 34),
(26, 'uploads/visa/visaFile_0_37_.jpg', 37),
(27, 'uploads/visa/visaFile_0_38_.jpg', 38),
(28, 'uploads/visa/visaFile_0_39_.jpg', 39),
(29, 'uploads/visa/visaFile_1_39_.jpg', 39),
(30, 'uploads/visa/visaFile_2_39_.jpg', 39),
(31, 'uploads/visa/visaFile_0_40_.jpg', 40),
(32, 'uploads/visa/visaFile_1_40_.jpg', 40),
(33, 'uploads/visa/visaFile_2_40_.jpg', 40),
(34, 'uploads/visa/visaFile_0_41_.jpg', 41),
(35, 'uploads/visa/visaFile_1_41_.jpg', 41),
(36, 'uploads/visa/visaFile_2_41_.jpg', 41),
(37, 'uploads/visa/visaFile_0_42_.jpg', 42),
(38, 'uploads/visa/visaFile_1_42_.jpg', 42),
(39, 'uploads/visa/visaFile_2_42_.jpg', 42),
(40, 'uploads/visa/visaFile_0_43_.jpg', 43),
(41, 'uploads/visa/visaFile_1_43_.jpg', 43),
(42, 'uploads/visa/visaFile_2_43_.jpg', 43),
(43, 'uploads/visa/visaFile_0_44_.jpg', 44),
(44, 'uploads/visa/visaFile_1_44_.jpg', 44),
(45, 'uploads/visa/visaFile_2_44_.jpg', 44);

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
  ADD KEY `agentcomission_ibfk_1` (`agentEmail`),
  ADD KEY `agentcomission_ibfk_2` (`passportNum`);

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
  ADD KEY `candidateexpense_ibfk_1` (`passportNum`),
  ADD KEY `candidateexpense_ibfk_2` (`agentEmail`);

--
-- Indexes for table `delegate`
--
ALTER TABLE `delegate`
  ADD PRIMARY KEY (`delegateId`);

--
-- Indexes for table `delegateexpense`
--
ALTER TABLE `delegateexpense`
  ADD PRIMARY KEY (`delegateExpenseId`),
  ADD KEY `delegateId` (`delegateId`);

--
-- Indexes for table `delegateofficeexpense`
--
ALTER TABLE `delegateofficeexpense`
  ADD PRIMARY KEY (`expenseId`);

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
-- Indexes for table `manpoweroffice`
--
ALTER TABLE `manpoweroffice`
  ADD PRIMARY KEY (`manpowerOfficeId`);

--
-- Indexes for table `passport`
--
ALTER TABLE `passport`
  ADD PRIMARY KEY (`passportNum`,`creationDate`);

--
-- Indexes for table `passportcompleted`
--
ALTER TABLE `passportcompleted`
  ADD PRIMARY KEY (`passportNum`,`creationDate`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`paymentMode`);

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
-- Indexes for table `processingcompleted`
--
ALTER TABLE `processingcompleted`
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
-- Indexes for table `visafile`
--
ALTER TABLE `visafile`
  ADD PRIMARY KEY (`visaFileId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance`
--
ALTER TABLE `advance`
  MODIFY `advanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `agentcomission`
--
ALTER TABLE `agentcomission`
  MODIFY `comissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `agentexpense`
--
ALTER TABLE `agentexpense`
  MODIFY `agentExpenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `candidateexpense`
--
ALTER TABLE `candidateexpense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `delegate`
--
ALTER TABLE `delegate`
  MODIFY `delegateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `delegateexpense`
--
ALTER TABLE `delegateexpense`
  MODIFY `delegateExpenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `delegateofficeexpense`
--
ALTER TABLE `delegateofficeexpense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `manpoweroffice`
--
ALTER TABLE `manpoweroffice`
  MODIFY `manpowerOfficeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `privateprocessing`
--
ALTER TABLE `privateprocessing`
  MODIFY `privateProcessId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `processing`
--
ALTER TABLE `processing`
  MODIFY `processingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `processingcompleted`
--
ALTER TABLE `processingcompleted`
  MODIFY `processingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `visafile`
--
ALTER TABLE `visafile`
  MODIFY `visaFileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance`
--
ALTER TABLE `advance`
  ADD CONSTRAINT `advance_ibfk_1` FOREIGN KEY (`comissionId`) REFERENCES `agentcomission` (`comissionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agentexpense`
--
ALTER TABLE `agentexpense`
  ADD CONSTRAINT `agentexpense_ibfk_1` FOREIGN KEY (`agentEmail`) REFERENCES `agent` (`agentEmail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delegateexpense`
--
ALTER TABLE `delegateexpense`
  ADD CONSTRAINT `delegateexpense_ibfk_1` FOREIGN KEY (`delegateId`) REFERENCES `delegate` (`delegateId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
