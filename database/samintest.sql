-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2021 at 04:02 AM
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
-- Database: `samintest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `pass`) VALUES
('admin2@admin2.admin2', 'admin2'),
('admin@admin.admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentId` int(11) NOT NULL,
  `agentName` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `openBalance` int(11) NOT NULL,
  `agentType` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatePerson` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentId`, `agentName`, `company`, `openBalance`, `agentType`, `address`, `country`, `city`, `phone`, `email`, `status`, `updatePerson`, `updatedOn`) VALUES
(1, 'Samin', 'ABC', 30000, '1', 'Shamoli', 'BD', 'Dhaka', '0173150', 'seaum@seaum.seaum', 1, 'admin@admin.admin', '2021-01-31'),
(4, 'Samin Test', 'ABC Test', 120, '1', 'Shamoli', 'BD', 'Dhaka', '0173150', 'seaum@seaum.seaum', 1, 'admin2@admin2.admin2', '2021-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `agenttype`
--

CREATE TABLE `agenttype` (
  `agentTypeId` int(11) NOT NULL,
  `agentType` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatePerson` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenttype`
--

INSERT INTO `agenttype` (`agentTypeId`, `agentType`, `status`, `updatePerson`, `updatedOn`) VALUES
(1, 'IT', 1, 'admin@admin.admin', '2021-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchId` int(11) NOT NULL,
  `branchName` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchId`, `branchName`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(2, 'New Branch 2', 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(3, 'New Branch 3', 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(4, 'New Branch 4', 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(5, 'New Branch 5', 1, 'admin@admin.admin', '2021-02-04', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candidateId` int(11) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `fathName` varchar(255) NOT NULL,
  `mob` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(255) NOT NULL,
  `profId` int(11) NOT NULL,
  `addrs` varchar(255) NOT NULL,
  `count` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidateId`, `fName`, `lName`, `fathName`, `mob`, `dob`, `pob`, `profId`, `addrs`, `count`, `state`, `city`) VALUES
(4, 'Test', 'Two Changed', 'Father 02', '0215646', '2021-02-01', 'Cumilla', 3, 'New Link Town', 'Bangladesh', 'Dhaka', 'Dhaka'),
(5, 'Test', 'Two', 'Father 02', '0202', '2021-02-01', 'Cumilla', 3, 'New Sahbag', 'Bangladesh', 'Dhaka', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyId` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyId`, `companyName`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(1, '1 company updated', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing'),
(2, '2 company', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing'),
(4, '3 company', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing'),
(5, '4 company updated', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentId` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `departmentDesc` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentId`, `departmentName`, `departmentDesc`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(1, 'IT', '', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing'),
(2, 'Finance', '', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing'),
(4, 'Social Media', '', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing'),
(5, 'R&D', '', 1, 'admin2@admin2.admin2', '2021-02-03', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designationId` int(11) NOT NULL,
  `designationName` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designationId`, `designationName`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(1, 'CEO', 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(2, 'COO', 1, 'admin@admin.admin', '2021-02-04', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `emigration`
--

CREATE TABLE `emigration` (
  `emigId` int(11) NOT NULL,
  `visaId` int(11) NOT NULL,
  `approval` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeId` int(11) NOT NULL,
  `employeeName` varchar(255) NOT NULL,
  `companyId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL,
  `professionId` int(11) NOT NULL,
  `designationId` int(11) NOT NULL,
  `DOJ` date NOT NULL,
  `DOB` date NOT NULL,
  `DOL` date NOT NULL,
  `salary` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeId`, `employeeName`, `companyId`, `departmentId`, `professionId`, `designationId`, `DOJ`, `DOB`, `DOL`, `salary`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(1, 'First Employee', 1, 2, 0, 2, '2010-01-01', '2021-01-31', '0000-00-00', 3, 1, 'admin2@admin2.admin2', '0000-00-00', ''),
(2, 'Second Employee', 1, 1, 0, 2, '2021-02-03', '2020-08-30', '0000-00-00', 2, 1, 'admin@admin.admin', '0000-00-00', ''),
(3, 'Third Employee', 2, 2, 0, 2, '1999-01-03', '1994-02-01', '0000-00-00', 3, 1, 'admin2@admin2.admin2', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expenseId` int(11) NOT NULL,
  `expenseheadId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paymode` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expenseId`, `expenseheadId`, `amount`, `paymode`, `date`, `remark`) VALUES
(2, 3, 1500000, 'Cash', '2021-01-01', 'This is a test 2'),
(3, 1, 150000, 'Cheque', '2021-01-22', 'This is test 3 fixed'),
(4, 1, 120000, 'Cash', '2021-01-01', 'No'),
(5, 3, 50000, 'Cash', '2019-01-01', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `expenseheader`
--

CREATE TABLE `expenseheader` (
  `expenseheadId` int(11) NOT NULL,
  `expenseName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenseheader`
--

INSERT INTO `expenseheader` (`expenseheadId`, `expenseName`) VALUES
(1, 'Gold Updated'),
(2, 'Accomodation'),
(3, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `hasbranch`
--

CREATE TABLE `hasbranch` (
  `branchId` int(11) NOT NULL,
  `companyId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasbranch`
--

INSERT INTO `hasbranch` (`branchId`, `companyId`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(2, 1, 1, 'admin2@admin2.admin2', '2021-02-05', ''),
(5, 2, 1, 'admin2@admin2.admin2', '2021-02-05', '');

-- --------------------------------------------------------

--
-- Table structure for table `hasdepartment`
--

CREATE TABLE `hasdepartment` (
  `departmentId` int(11) NOT NULL,
  `companyId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasdepartment`
--

INSERT INTO `hasdepartment` (`departmentId`, `companyId`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(1, 1, 1, 'admin@admin.admin', '2021-02-04', ''),
(2, 1, 1, 'admin@admin.admin', '2021-02-04', ''),
(1, 2, 1, 'admin2@admin2.admin2', '2021-02-04', ''),
(2, 2, 1, 'admin2@admin2.admin2', '2021-02-04', '');

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

CREATE TABLE `medical` (
  `mediId` int(11) NOT NULL,
  `visaId` int(11) NOT NULL,
  `mediStage` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passport`
--

CREATE TABLE `passport` (
  `passNo` varchar(255) NOT NULL,
  `issuPlace` varchar(255) NOT NULL,
  `issuDate` date NOT NULL,
  `expDate` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `candidateId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passport`
--

INSERT INTO `passport` (`passNo`, `issuPlace`, `issuDate`, `expDate`, `type`, `candidateId`) VALUES
('ThisIsANewPassportThree', 'Europe', '2021-02-01', '2021-02-27', 'E - passpo', 5),
('ThisIsANewPassportTwo', 'Europe', '2021-02-02', '2021-02-19', 'E - passpo', 4);

-- --------------------------------------------------------

--
-- Table structure for table `profession`
--

CREATE TABLE `profession` (
  `professionId` int(11) NOT NULL,
  `professionName` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`professionId`, `professionName`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(1, 'Doctor', 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(3, 'Student', 1, 'admin2@admin2.admin2', '2021-02-05', 'testing'),
(4, 'Lawyer', 1, 'admin2@admin2.admin2', '2021-02-05', 'testing'),
(5, 'Police', 1, 'admin2@admin2.admin2', '2021-02-05', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salaryId` int(11) NOT NULL,
  `salaryAmount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salaryId`, `salaryAmount`, `status`, `updatedBy`, `updatedOn`, `remark`) VALUES
(2, 25000, 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(3, 45000, 1, 'admin@admin.admin', '2021-02-04', 'testing'),
(4, 90000, 1, 'admin@admin.admin', '2021-02-04', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsorId` int(11) NOT NULL,
  `sponsorName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsorId`, `sponsorName`, `address`, `country`, `city`, `phone`, `email`, `status`, `updatedBy`, `updatedOn`) VALUES
(1, 'Sponsor Updated', 'Shamoli', 'BD', 'Dhaka', '01731501509208', 'seaum@seaum.seaum', 1, 'admin@admin.admin', '2021-01-31'),
(2, 'Seaum Test Update', 'Shamoli', 'BD', 'Dhaka', '0173150', 'seaum@seaum.seaum', 1, 'admin2@admin2.admin2', '2021-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `stamping`
--

CREATE TABLE `stamping` (
  `stampId` int(11) NOT NULL,
  `visaId` int(11) NOT NULL,
  `stampStage` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int(11) NOT NULL,
  `passportNum` varchar(255) NOT NULL,
  `airplane` varchar(255) NOT NULL,
  `agent` int(11) NOT NULL,
  `flightNo` varchar(255) NOT NULL,
  `flightDate` date NOT NULL,
  `flightTime` time NOT NULL,
  `fromPlace` varchar(255) NOT NULL,
  `toPlace` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `updatedOn` date NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `terminal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketId`, `passportNum`, `airplane`, `agent`, `flightNo`, `flightDate`, `flightTime`, `fromPlace`, `toPlace`, `amount`, `paid`, `updatedOn`, `updatedBy`, `departure`, `terminal`) VALUES
(1, 'ThisIsANewPassportTwo', 'New Airways', 4, '2233', '2021-01-31', '06:14:00', 'Dhaka', 'Iceland', 1200000, 0, '2021-02-06', 'admin2@admin2.admin2', 'International Airport', '4 terminal'),
(2, 'ThisIsANewPassportTwo', 'New Airways', 1, '007', '2021-01-31', '05:15:00', 'Dhaka', 'Jakarta', 52000, 12000, '2021-02-06', 'admin2@admin2.admin2', 'International Airport', '7 terminal');

-- --------------------------------------------------------

--
-- Table structure for table `visainfo`
--

CREATE TABLE `visainfo` (
  `visaId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `position` varchar(255) NOT NULL,
  `bSalary` int(11) NOT NULL,
  `tSalary` int(11) NOT NULL,
  `visaIssuAgent` int(11) NOT NULL,
  `visaSponsorId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `visaFee` int(11) NOT NULL,
  `visaFeeDate` date DEFAULT NULL,
  `visaFeeStage` varchar(10) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` varchar(255) NOT NULL,
  `passNo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visainfo`
--

INSERT INTO `visainfo` (`visaId`, `name`, `date`, `type`, `position`, `bSalary`, `tSalary`, `visaIssuAgent`, `visaSponsorId`, `status`, `visaFee`, `visaFeeDate`, `visaFeeStage`, `updatedBy`, `updatedOn`, `passNo`) VALUES
(1, 'New Visa', '2021-02-07', 'Student', 'Student', 100000, 1200000, 1, 1, 1, 250, '2021-02-15', 'Paid', 'admin2@admin2.admin2', '2021-02-07', 'ThisIsANewPassportTwo'),
(2, 'New Test Visa 2', '2021-02-07', 'Student', 'Student', 100000, 1200000, 4, 1, 1, 150, '2021-01-31', 'Paid', 'admin2@admin2.admin2', '2021-02-07', 'ThisIsANewPassportTwo');

-- --------------------------------------------------------

--
-- Table structure for table `visapayment`
--

CREATE TABLE `visapayment` (
  `visaPayId` int(11) NOT NULL,
  `visaId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paidAmount` int(11) NOT NULL,
  `agentId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updatedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visapayment`
--

INSERT INTO `visapayment` (`visaPayId`, `visaId`, `amount`, `paidAmount`, `agentId`, `status`, `updatedBy`, `updatedOn`) VALUES
(1, 12, 1700, 0, 4, 1, 'admin2@admin2.admin2', '2021-02-06'),
(2, 13, 1500, 300, 4, 1, 'admin2@admin2.admin2', '2021-02-06'),
(3, 15, 3000, 0, 4, 1, 'admin2@admin2.admin2', '2021-02-06'),
(4, 6, 1750, 0, 1, 1, 'admin2@admin2.admin2', '2021-02-06'),
(5, 7, 2500, 0, 1, 1, 'admin2@admin2.admin2', '2021-02-06'),
(6, 11, 3500, 0, 1, 1, 'admin2@admin2.admin2', '2021-02-06'),
(7, 14, 1020, 0, 1, 1, 'admin2@admin2.admin2', '2021-02-06'),
(8, 16, 250, 0, 4, 1, 'admin2@admin2.admin2', '2021-02-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentId`);

--
-- Indexes for table `agenttype`
--
ALTER TABLE `agenttype`
  ADD PRIMARY KEY (`agentTypeId`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchId`) USING BTREE;

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidateId`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyId`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentId`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designationId`);

--
-- Indexes for table `emigration`
--
ALTER TABLE `emigration`
  ADD PRIMARY KEY (`emigId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeId`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expenseId`),
  ADD KEY `expenseheadId` (`expenseheadId`);

--
-- Indexes for table `expenseheader`
--
ALTER TABLE `expenseheader`
  ADD PRIMARY KEY (`expenseheadId`);

--
-- Indexes for table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`mediId`);

--
-- Indexes for table `passport`
--
ALTER TABLE `passport`
  ADD PRIMARY KEY (`passNo`),
  ADD KEY `candidateId` (`candidateId`);

--
-- Indexes for table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`professionId`) USING BTREE;

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salaryId`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsorId`);

--
-- Indexes for table `stamping`
--
ALTER TABLE `stamping`
  ADD PRIMARY KEY (`stampId`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `visainfo`
--
ALTER TABLE `visainfo`
  ADD PRIMARY KEY (`visaId`);

--
-- Indexes for table `visapayment`
--
ALTER TABLE `visapayment`
  ADD PRIMARY KEY (`visaPayId`),
  ADD KEY `visaId` (`visaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agenttype`
--
ALTER TABLE `agenttype`
  MODIFY `agentTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emigration`
--
ALTER TABLE `emigration`
  MODIFY `emigId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenseheader`
--
ALTER TABLE `expenseheader`
  MODIFY `expenseheadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medical`
--
ALTER TABLE `medical`
  MODIFY `mediId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profession`
--
ALTER TABLE `profession`
  MODIFY `professionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salaryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `sponsorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stamping`
--
ALTER TABLE `stamping`
  MODIFY `stampId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visainfo`
--
ALTER TABLE `visainfo`
  MODIFY `visaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visapayment`
--
ALTER TABLE `visapayment`
  MODIFY `visaPayId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`expenseheadId`) REFERENCES `expenseheader` (`expenseheadId`) ON DELETE CASCADE;

--
-- Constraints for table `passport`
--
ALTER TABLE `passport`
  ADD CONSTRAINT `passport_ibfk_1` FOREIGN KEY (`candidateId`) REFERENCES `candidate` (`candidateId`) ON DELETE CASCADE;

--
-- Constraints for table `visapayment`
--
ALTER TABLE `visapayment`
  ADD CONSTRAINT `visapayment_ibfk_1` FOREIGN KEY (`visaId`) REFERENCES `visainfo` (`visaId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
