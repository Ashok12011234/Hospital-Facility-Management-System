-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 02:46 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hfms`
--

-- --------------------------------------------------------

--
-- Table structure for table `blooddetail`
--

CREATE TABLE `blooddetail` (
  `BloodRecordId` int(10) NOT NULL,
  `HospitalId` int(10) NOT NULL,
  `AplusAvailability` char(3) DEFAULT NULL,
  `AminusAvailability` char(3) DEFAULT NULL,
  `BplusAvailability` char(3) DEFAULT NULL,
  `BminusAvailability` char(3) DEFAULT NULL,
  `OplusAvailability` char(3) DEFAULT NULL,
  `OminusAvailability` char(3) DEFAULT NULL,
  `ABplusAvailability` char(3) DEFAULT NULL,
  `ABminusAvailability` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blooddetail`
--

INSERT INTO `blooddetail` (`BloodRecordId`, `HospitalId`, `AplusAvailability`, `AminusAvailability`, `BplusAvailability`, `BminusAvailability`, `OplusAvailability`, `OminusAvailability`, `ABplusAvailability`, `ABminusAvailability`) VALUES
(0, 1, 'NO', 'NO', 'YES', 'YES', 'NO', 'NO', 'NO', 'NO'),
(0, 3, 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES'),
(0, 5, 'NO', 'NO', 'YES', 'YES', 'NO', 'NO', 'YES', 'NO'),
(0, 7, 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `DonationId` int(10) NOT NULL,
  `HospitalId` int(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `executive`
--

CREATE TABLE `executive` (
  `ExecutiveId` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `executive`
--

INSERT INTO `executive` (`ExecutiveId`, `UserName`, `Password`) VALUES
(1, 'admin', 'ad@nike76');

-- --------------------------------------------------------

--
-- Table structure for table `hhrequest`
--

CREATE TABLE `hhrequest` (
  `RequestId` int(11) NOT NULL,
  `ProviderId` int(11) NOT NULL,
  `HospitalId` int(11) NOT NULL,
  `State` enum('REQUESTED','ACCEPTED','DECLINED','TRANSPORTING','EXCHANGE_COMPLETED','CANCELLED') NOT NULL DEFAULT 'REQUESTED',
  `Equipment` varchar(20) NOT NULL,
  `Quantity` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hhrequest`
--

INSERT INTO `hhrequest` (`RequestId`, `ProviderId`, `HospitalId`, `State`, `Equipment`, `Quantity`) VALUES
(1, 3, 1, 'EXCHANGE_COMPLETED', 'Medium Ceylinder', '5'),
(2, 1, 3, 'REQUESTED', 'Sinopharm', '40 ml'),
(3, 1, 7, 'TRANSPORTING', 'Normal Bed', '4'),
(4, 1, 7, 'ACCEPTED', 'ICU Bed', '4'),
(5, 3, 7, 'REQUESTED', 'ICU Bed', '4'),
(6, 3, 7, 'REQUESTED', 'Small Ceylinder', '20'),
(7, 5, 7, 'REQUESTED', 'Sinopharm', '200 ml'),
(8, 5, 7, 'REQUESTED', 'Phizer', '200 ml');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `HospitalId` int(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `TelephoneNo` varchar(25) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Profile` varchar(256) NOT NULL DEFAULT 'assets/documents/DatabaseFiles/Hospital/Profile/defaultH.jpg',
  `Website` varchar(100) DEFAULT NULL,
  `BankName` varchar(20) NOT NULL,
  `AccountNumber` varchar(20) NOT NULL,
  `staredHospital` varchar(512) NOT NULL DEFAULT 'a:0:{}',
  `staredProvider` varchar(512) NOT NULL DEFAULT 'a:0:{}',
  `State` enum('NEW','INITIATED') NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`HospitalId`, `UserName`, `Email`, `Password`, `Name`, `TelephoneNo`, `Address`, `Profile`, `Website`, `BankName`, `AccountNumber`, `staredHospital`, `staredProvider`, `State`) VALUES
(1, 'Hospital.01@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Hospital.01@hfms', '0211111111', 'Location-01', 'assets/documents/DatabaseFiles/Hospital/Profile/1.jpg', '', 'BOC', '1122334455', 'a:2:{i:0;s:1:\"3\";i:1;s:1:\"7\";}', 'a:2:{i:0;s:1:\"2\";i:1;s:1:\"4\";}', 'INITIATED'),
(3, 'Hospital.02@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Hospital.02@hfms', '0212222222', 'Location-02', 'assets/documents/DatabaseFiles/Hospital/Profile/defaultH.jpg', '', 'PEOPLE', '112233445500', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(5, 'Hospital.03@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Hospital.03@hfms', '0213333333', 'Location-03', 'assets/documents/DatabaseFiles/Hospital/Profile/defaultH.jpg', '', 'HNB', '223344550011', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(7, 'Hospital.04@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Hospital.04@hfms', '0214444444', 'Location-04', 'assets/documents/DatabaseFiles/Hospital/Profile/defaultH.jpg', '', 'COMMERCIAL', '887766554433', 'a:0:{}', 'a:0:{}', 'INITIATED');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalbeddetail`
--

CREATE TABLE `hospitalbeddetail` (
  `HospitalBedRecordId` int(10) NOT NULL,
  `HospitalId` int(10) NOT NULL,
  `NormalAvailability` char(3) DEFAULT NULL,
  `ICUAvailability` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitalbeddetail`
--

INSERT INTO `hospitalbeddetail` (`HospitalBedRecordId`, `HospitalId`, `NormalAvailability`, `ICUAvailability`) VALUES
(0, 1, 'YES', 'YES'),
(0, 3, 'YES', 'YES'),
(0, 5, 'YES', 'YES'),
(0, 7, 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalcylinderdetail`
--

CREATE TABLE `hospitalcylinderdetail` (
  `HospitalCylinderRecordId` int(10) NOT NULL,
  `HospitalId` int(10) NOT NULL,
  `SmallAvailability` char(3) DEFAULT NULL,
  `MediumAvailability` char(3) DEFAULT NULL,
  `LargeAvailability` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitalcylinderdetail`
--

INSERT INTO `hospitalcylinderdetail` (`HospitalCylinderRecordId`, `HospitalId`, `SmallAvailability`, `MediumAvailability`, `LargeAvailability`) VALUES
(0, 1, 'YES', 'NO', 'NO'),
(0, 3, 'YES', 'NO', 'YES'),
(0, 5, 'NO', 'NO', 'NO'),
(0, 7, 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `hprequest`
--

CREATE TABLE `hprequest` (
  `RequestId` int(11) NOT NULL,
  `ProviderId` int(11) NOT NULL,
  `HospitalId` int(11) NOT NULL,
  `State` enum('REQUESTED','ACCEPTED','DECLINED','TRANSPORTING','EXCHANGE_COMPLETED','CANCELLED') NOT NULL DEFAULT 'REQUESTED',
  `Equipment` varchar(20) NOT NULL,
  `Quantity` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hprequest`
--

INSERT INTO `hprequest` (`RequestId`, `ProviderId`, `HospitalId`, `State`, `Equipment`, `Quantity`) VALUES
(1, 2, 1, 'REQUESTED', 'ICU Bed', '2'),
(2, 2, 3, 'REQUESTED', 'ICU Bed', '2'),
(3, 6, 3, 'DECLINED', 'Normal Bed', '20'),
(4, 4, 1, 'REQUESTED', 'Large Ceylinder', '10'),
(5, 2, 1, 'REQUESTED', 'Large Ceylinder', '10'),
(6, 2, 7, 'REQUESTED', 'Small Ceylinder', '20'),
(7, 2, 7, 'REQUESTED', 'Medium Ceylinder', '20');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MessageId` int(11) NOT NULL,
  `RequestType` enum('HH','HP') NOT NULL,
  `RequestId` int(11) NOT NULL,
  `SenderType` enum('HOSPITAL','PROVIDER') NOT NULL,
  `SenderId` int(11) NOT NULL,
  `ReceiverId` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageId`, `RequestType`, `RequestId`, `SenderType`, `SenderId`, `ReceiverId`, `Message`, `Time`) VALUES
(1, 'HH', 1, 'HOSPITAL', 1, 3, 'Hi', '2022-01-20 12:28:13'),
(2, 'HH', 1, 'HOSPITAL', 1, 3, 'please respond immediately', '2022-01-20 12:28:59'),
(3, 'HH', 1, 'HOSPITAL', 3, 1, 'Hi', '2022-01-20 12:30:47'),
(4, 'HH', 1, 'HOSPITAL', 3, 1, 'We haven\'t extra 12 medium size cylinders', '2022-01-20 12:32:30'),
(5, 'HH', 1, 'HOSPITAL', 1, 3, 'Then how much can you provide?', '2022-01-20 12:38:52'),
(6, 'HH', 1, 'HOSPITAL', 3, 1, 'Just 5', '2022-01-20 12:39:30'),
(7, 'HH', 1, 'HOSPITAL', 1, 3, 'Ok\r\nSend.....', '2022-01-20 12:40:23'),
(8, 'HP', 3, 'PROVIDER', 6, 3, 'I can\'t provide', '2022-01-20 13:05:39'),
(9, 'HH', 3, 'HOSPITAL', 1, 7, 'we can provide only 2', '2022-01-20 13:31:24'),
(10, 'HH', 3, 'HOSPITAL', 7, 1, 'it\'s ok', '2022-01-20 13:31:50'),
(11, 'HH', 4, 'HOSPITAL', 1, 7, 'please share your location with us to transport the ICU beds', '2022-01-20 13:33:45'),
(12, 'HH', 3, 'HOSPITAL', 7, 1, 'we are waiting', '2022-01-20 13:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `newaccount`
--

CREATE TABLE `newaccount` (
  `NewAccountID` int(10) NOT NULL,
  `UserName` varchar(16) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `AccountType` enum('HOSPITAL','PROVIDER') NOT NULL,
  `BankName` enum('BOC','PEOPLE','HNB','COMMERCIAL','NSB') DEFAULT NULL,
  `AccountNumber` varchar(20) DEFAULT NULL,
  `BankEvidence` varchar(255) DEFAULT NULL,
  `InstituteEvidence` varchar(255) NOT NULL,
  `Status` enum('NEW','PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'NEW',
  `Doc_Status` enum('Correct','False','Not Vertified') NOT NULL DEFAULT 'Not Vertified',
  `Bank_Status` enum('Correct','False','Not Vertified') NOT NULL DEFAULT 'Not Vertified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newaccount`
--

INSERT INTO `newaccount` (`NewAccountID`, `UserName`, `Password`, `Email`, `AccountType`, `BankName`, `AccountNumber`, `BankEvidence`, `InstituteEvidence`, `Status`, `Doc_Status`, `Bank_Status`) VALUES
(1, 'Hospital.01@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'BOC', '1122334455', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.01@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.01@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(2, 'Provider.01@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.01@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(3, 'Hospital.02@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'PEOPLE', '112233445500', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.02@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.02@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(4, 'Provider.02@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.02@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(5, 'Hospital.03@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'HNB', '223344550011', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.03@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.03@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(6, 'Provider.03@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.03@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(7, 'Hospital.04@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'COMMERCIAL', '887766554433', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.04@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.04@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(8, 'Provider.04@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.04@hfms.pdf', 'APPROVED', 'Correct', 'Correct'),
(9, 'Hospital.05@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'NSB', '998877005544', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.05@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.05@hfms.pdf', 'PENDING', 'Correct', 'False'),
(10, 'Provider.05@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.05@hfms.pdf', 'PENDING', 'False', 'Not Vertified'),
(11, 'Hospital.06@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'HNB', '9876543211', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.06@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.06@hfms.pdf', 'PENDING', 'False', 'Not Vertified'),
(12, 'Provider.06@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.06@hfms.pdf', 'PENDING', 'False', 'Not Vertified'),
(13, 'Hospital.07@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'PEOPLE', '6677889955', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.07@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.07@hfms.pdf', 'PENDING', 'Correct', 'Not Vertified'),
(14, 'Provider.07@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.07@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified'),
(15, 'Hospital.08@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'HNB', '7865789000', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.08@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.08@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified'),
(16, 'Provider.08@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.08@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified'),
(17, 'Hospital.09@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'NSB', '675758599000', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.09@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.09@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified'),
(18, 'Provider.09@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.09@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified'),
(19, 'Hospital.10@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'HOSPITAL', 'BOC', '776688995544', 'assets/documents/DatabaseFiles/NewAccount/BankEvidence/Hospital.10@hfms.pdf', 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Hospital.10@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified'),
(20, 'Provider.10@hfms', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'assignmentoneoop@gmail.com', 'PROVIDER', NULL, NULL, NULL, 'assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/Provider.10@hfms.pdf', 'NEW', 'Not Vertified', 'Not Vertified');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `ProviderId` int(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `TelephoneNo` varchar(25) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Profile` varchar(256) NOT NULL DEFAULT 'assets/documents/DatabaseFiles/Provider/Profile/defaultP.jpg',
  `Website` varchar(100) DEFAULT NULL,
  `BankName` varchar(20) NOT NULL,
  `AccountNumber` varchar(20) NOT NULL,
  `staredHospital` varchar(512) NOT NULL DEFAULT 'a:0:{}',
  `staredProvider` varchar(512) NOT NULL DEFAULT 'a:0:{}',
  `State` enum('NEW','INITIATED') NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`ProviderId`, `UserName`, `Email`, `Password`, `Name`, `TelephoneNo`, `Address`, `Profile`, `Website`, `BankName`, `AccountNumber`, `staredHospital`, `staredProvider`, `State`) VALUES
(2, 'Provider.01@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Provider.01@hfms', '0711111111', 'location-01', 'assets/documents/DatabaseFiles/Provider/Profile/2.jpg', '', '', '', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(4, 'Provider.02@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Provider.02@hfms', '0712222222', 'location-02', 'assets/documents/DatabaseFiles/Provider/Profile/defaultP.jpg', '', '', '', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(6, 'Provider.03@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Provider.03@hfms', '0713333333', 'location-03', 'assets/documents/DatabaseFiles/Provider/Profile/defaultP.jpg', '', '', '', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(8, 'Provider.04@hfms', 'assignmentoneoop@gmail.com', '&$86&$115&$112&$111&$93&$114&$107&$124&$111&$45&$59&$62&$', 'Provider.04@hfms', '0714444444', 'location-04', 'assets/documents/DatabaseFiles/Provider/Profile/defaultP.jpg', '', '', '', 'a:0:{}', 'a:0:{}', 'INITIATED');

-- --------------------------------------------------------

--
-- Table structure for table `providerbeddetail`
--

CREATE TABLE `providerbeddetail` (
  `ProviderBedRecordId` int(10) NOT NULL,
  `ProviderId` int(10) NOT NULL,
  `NormalAvailability` char(3) DEFAULT NULL,
  `ICUAvailability` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `providerbeddetail`
--

INSERT INTO `providerbeddetail` (`ProviderBedRecordId`, `ProviderId`, `NormalAvailability`, `ICUAvailability`) VALUES
(0, 2, 'YES', 'YES'),
(0, 4, 'NO', 'NO'),
(0, 6, 'YES', 'NO'),
(0, 8, 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `providercylinderdetail`
--

CREATE TABLE `providercylinderdetail` (
  `ProviderCylinderRecordId` int(10) NOT NULL,
  `ProviderId` int(10) NOT NULL,
  `SmallAvailability` char(3) DEFAULT NULL,
  `MediumAvailability` char(3) DEFAULT NULL,
  `LargeAvailability` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `providercylinderdetail`
--

INSERT INTO `providercylinderdetail` (`ProviderCylinderRecordId`, `ProviderId`, `SmallAvailability`, `MediumAvailability`, `LargeAvailability`) VALUES
(0, 2, 'YES', 'YES', 'YES'),
(0, 4, 'YES', 'YES', 'YES'),
(0, 6, 'YES', 'YES', 'NO'),
(0, 8, 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinedetail`
--

CREATE TABLE `vaccinedetail` (
  `VaccineRecordId` int(10) NOT NULL,
  `HospitalId` int(10) NOT NULL,
  `OxfordAvailability` char(3) DEFAULT NULL,
  `PfizerAvailability` char(3) DEFAULT NULL,
  `ModernalAvailability` char(3) DEFAULT NULL,
  `SinopharmAvailability` char(3) DEFAULT NULL,
  `SputnikAvailability` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccinedetail`
--

INSERT INTO `vaccinedetail` (`VaccineRecordId`, `HospitalId`, `OxfordAvailability`, `PfizerAvailability`, `ModernalAvailability`, `SinopharmAvailability`, `SputnikAvailability`) VALUES
(0, 1, 'NO', 'YES', 'NO', 'YES', 'NO'),
(0, 3, 'NO', 'NO', 'NO', 'NO', 'NO'),
(0, 5, 'NO', 'YES', 'YES', 'YES', 'YES'),
(0, 7, 'NO', 'NO', 'NO', 'NO', 'NO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blooddetail`
--
ALTER TABLE `blooddetail`
  ADD PRIMARY KEY (`BloodRecordId`,`HospitalId`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`DonationId`);

--
-- Indexes for table `executive`
--
ALTER TABLE `executive`
  ADD PRIMARY KEY (`ExecutiveId`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `hhrequest`
--
ALTER TABLE `hhrequest`
  ADD PRIMARY KEY (`RequestId`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`HospitalId`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `hospitalbeddetail`
--
ALTER TABLE `hospitalbeddetail`
  ADD PRIMARY KEY (`HospitalBedRecordId`,`HospitalId`);

--
-- Indexes for table `hospitalcylinderdetail`
--
ALTER TABLE `hospitalcylinderdetail`
  ADD PRIMARY KEY (`HospitalCylinderRecordId`,`HospitalId`);

--
-- Indexes for table `hprequest`
--
ALTER TABLE `hprequest`
  ADD PRIMARY KEY (`RequestId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageId`);

--
-- Indexes for table `newaccount`
--
ALTER TABLE `newaccount`
  ADD PRIMARY KEY (`NewAccountID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`ProviderId`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `providerbeddetail`
--
ALTER TABLE `providerbeddetail`
  ADD PRIMARY KEY (`ProviderBedRecordId`,`ProviderId`);

--
-- Indexes for table `providercylinderdetail`
--
ALTER TABLE `providercylinderdetail`
  ADD PRIMARY KEY (`ProviderCylinderRecordId`,`ProviderId`);

--
-- Indexes for table `vaccinedetail`
--
ALTER TABLE `vaccinedetail`
  ADD PRIMARY KEY (`VaccineRecordId`,`HospitalId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `DonationId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `executive`
--
ALTER TABLE `executive`
  MODIFY `ExecutiveId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hhrequest`
--
ALTER TABLE `hhrequest`
  MODIFY `RequestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `HospitalId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hprequest`
--
ALTER TABLE `hprequest`
  MODIFY `RequestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newaccount`
--
ALTER TABLE `newaccount`
  MODIFY `NewAccountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `ProviderId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
