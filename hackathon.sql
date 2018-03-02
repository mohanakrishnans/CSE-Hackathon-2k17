-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2017 at 02:00 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `staffdetails`
--

CREATE TABLE `staffdetails` (
  `StaffID` varchar(8) DEFAULT NULL,
  `StaffName` varchar(30) DEFAULT NULL,
  `StaffDept` varchar(10) DEFAULT NULL,
  `Designation` varchar(10) DEFAULT NULL,
  `from_stud` varchar(8) DEFAULT NULL,
  `to_stud` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`StaffID`, `StaffName`, `StaffDept`, `Designation`, `from_stud`, `to_stud`) VALUES
('1234567', 'Anitha', 'CSE', 'Mentor', '14CSA01', '14CSA20'),
('1357986', 'Saranya', 'CSE', 'Mentor', '14CSA21', '14CSA40'),
('7654321', 'Lanitha', 'CSE', 'HOD', NULL, NULL),
('9876543', 'Govindharajalu', NULL, 'Prinicipal', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staffleave`
--

CREATE TABLE `staffleave` (
  `S.No.` int(4) NOT NULL,
  `StaffID` varchar(8) NOT NULL,
  `StaffName` varchar(15) NOT NULL,
  `StaffDept` varchar(15) NOT NULL,
  `Role` varchar(15) NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `Reason` varchar(100) NOT NULL,
  `LeaveType` varchar(3) NOT NULL,
  `AlteredFaculty` varchar(15) NOT NULL,
  `AppliedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Hod_Approval` varchar(10) NOT NULL DEFAULT 'Pending',
  `Principal_Approval` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffleave`
--

INSERT INTO `staffleave` (`S.No.`, `StaffID`, `StaffName`, `StaffDept`, `Role`, `FromDate`, `ToDate`, `Reason`, `LeaveType`, `AlteredFaculty`, `AppliedOn`, `Hod_Approval`, `Principal_Approval`) VALUES
(1, '1234567', 'Anitha', 'CSE', 'Mentor', '2017-03-17', '2017-03-20', 'Students Torture', 'CL', 'Aruna', '2017-03-08 13:41:46', 'Approved', 'Rejected'),
(2, '1234567', 'Anitha', 'CSE', 'Mentor', '2017-03-25', '2017-03-26', 'asdfg', 'LOP', 'yes', '2017-03-09 10:27:17', 'Approved', 'Rejected'),
(3, '7654321', 'Lanitha', 'CSE', 'HOD', '2017-03-25', '2017-03-26', 'Visiting Seminar', 'CL', 'Yes', '2017-03-09 12:56:03', 'Pending', 'Rejected'),
(4, '1357986', 'Saranya', 'CSE', 'Mentor', '2017-03-17', '2017-03-22', 'Going to Tempe', 'LOP', 'Yes', '2017-03-10 14:30:48', 'Rejected', 'Pending'),
(5, '1234567', 'Anitha', 'CSE', 'Mentor', '2017-03-17', '2017-03-18', 'Sem', 'CL', 'yes', '2017-03-11 12:33:07', 'Approved', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `StudentID` varchar(8) DEFAULT NULL,
  `StudentName` varchar(30) DEFAULT NULL,
  `StudentDept` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`StudentID`, `StudentName`, `StudentDept`) VALUES
('14CSA19', 'Ganesh M', 'CSE'),
('14CSA33', 'MohanaKrishnan S', 'CSE'),
('14ECA02', 'Ajith S', 'ECE'),
('14ECA22', 'Ranjith', 'ECE'),
('15CSB24', 'Martin J', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `studentleave`
--

CREATE TABLE `studentleave` (
  `S.No.` int(4) NOT NULL,
  `StudentID` varchar(8) NOT NULL,
  `StudentName` varchar(15) NOT NULL,
  `StudentDept` varchar(15) NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `Reason` varchar(100) NOT NULL,
  `AppliedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Mentor_Approval` varchar(10) NOT NULL DEFAULT 'Pending',
  `Mentor_Name` varchar(15) DEFAULT NULL,
  `Hod_Approval` varchar(10) NOT NULL DEFAULT 'Pending',
  `Principal_Approval` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentleave`
--

INSERT INTO `studentleave` (`S.No.`, `StudentID`, `StudentName`, `StudentDept`, `FromDate`, `ToDate`, `Reason`, `AppliedOn`, `Mentor_Approval`, `Mentor_Name`, `Hod_Approval`, `Principal_Approval`) VALUES
(1, '14CSA19', 'Ganesh', 'CSE', '2017-03-11', '2017-03-13', 'Sister Marriage', '2017-03-10 14:14:18', 'Approved', 'Anitha', 'Approved', 'Rejected'),
(2, '14CSA33', 'Mohan', 'CSE', '2017-03-23', '2017-03-24', 'Going to temple', '2017-03-10 14:15:10', 'Rejected', NULL, 'Pending', 'Pending'),
(3, '14CSA19', 'Ganesh', 'CSE', '2017-03-17', '2017-03-19', 'feeling sick', '2017-03-11 06:06:40', 'Approved', 'Anitha', 'Approved', 'Approved'),
(4, '14CSA33', 'Mohan', 'CSE', '0000-00-00', '2017-03-11', 'test', '2017-03-11 09:54:09', 'Rejected', NULL, 'Pending', 'Pending'),
(5, '14CSA33', 'Mohan', 'CSE', '0000-00-00', '0000-00-00', '', '2017-03-11 10:02:32', 'Rejected', NULL, 'Pending', 'Pending'),
(6, '14CSA33', 'Mohan', 'CSE', '0000-00-00', '0000-00-00', '', '2017-03-11 10:03:31', 'Rejected', NULL, 'Pending', 'Pending'),
(7, '14CSA33', 'Mohan', 'CSE', '0000-00-00', '0000-00-00', '', '2017-03-11 10:04:26', 'Rejected', NULL, 'Pending', 'Pending'),
(8, '14CSA19', 'Ganesh', 'CSE', '2017-03-14', '2017-03-15', 'fgggg', '2017-03-11 12:14:06', 'Approved', 'Anitha', 'Approved', 'Approved'),
(9, '14CSA19', 'Ganesh', 'CSE', '2017-03-24', '2017-03-25', 'dfgvbnm,', '2017-03-11 12:24:24', 'Approved', 'Anitha', 'Approved', 'Approved'),
(10, '14CSA19', 'Ganesh', 'CSE', '2017-03-14', '2017-03-15', 'sick', '2017-03-11 12:31:42', 'Approved', 'Anitha', 'Pending', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `UserID` varchar(8) NOT NULL,
  `UserName` varchar(15) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`UserID`, `UserName`, `Password`, `Role`) VALUES
('1234567', 'Anitha', 'Anith@', 'Mentor'),
('1357986', 'Saranya', 's@ranya', 'Mentor'),
('14CSA19', 'Ganesh', 'Gre@t35', 'Student'),
('14CSA33', 'Mohan', 'Moh@n', 'Student'),
('14ECA02', 'Ajith', '@jith', 'Student'),
('14ECA22', 'Ranjith', 'r@njith', 'Student'),
('15CSB24', 'Martin', 'm@rtin', 'Student'),
('7654321', 'Lanitha', 'L@nitha', 'HOD'),
('9876543', 'Govindharajalu', 'princip@l', 'Principal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staffdetails`
--
ALTER TABLE `staffdetails`
  ADD KEY `StaffID` (`StaffID`);

--
-- Indexes for table `staffleave`
--
ALTER TABLE `staffleave`
  ADD PRIMARY KEY (`S.No.`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `studentleave`
--
ALTER TABLE `studentleave`
  ADD PRIMARY KEY (`S.No.`),
  ADD KEY `studentleave_ibfk_1` (`StudentID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staffleave`
--
ALTER TABLE `staffleave`
  MODIFY `S.No.` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `studentleave`
--
ALTER TABLE `studentleave`
  MODIFY `S.No.` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `staffdetails`
--
ALTER TABLE `staffdetails`
  ADD CONSTRAINT `staffdetails_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `userlogin` (`UserID`);

--
-- Constraints for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD CONSTRAINT `studentdetails_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `userlogin` (`UserID`);

--
-- Constraints for table `studentleave`
--
ALTER TABLE `studentleave`
  ADD CONSTRAINT `studentleave_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `userlogin` (`UserID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
