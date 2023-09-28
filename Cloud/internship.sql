-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 04:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `committeeID` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`committeeID`, `name`, `email`, `password`) VALUES
('COM001', 'Ali', 'alli@gmail.com', 'pass123');

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `internshipID` varchar(100) NOT NULL,
  `companyName` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL,
  `startDate` varchar(100) NOT NULL,
  `endDate` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `studentID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship`
--

INSERT INTO `internship` (`internshipID`, `companyName`, `location`, `startDate`, `endDate`, `status`, `studentID`) VALUES
('ITP001', 'ABC Sdn. Bhd.', 'Batu Kawan, Pulau Pinang', '11/02/2024', '01/08/2023', 'pending', 'STD001');

-- --------------------------------------------------------

--
-- Table structure for table `progressreport`
--

CREATE TABLE `progressreport` (
  `progressID` varchar(100) NOT NULL,
  `progressReport` varchar(100) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `submissionDate` varchar(10) DEFAULT NULL,
  `studentID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `supervisorID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `name`, `email`, `password`, `course`, `supervisorID`) VALUES
('STD001', 'EeeLee', 'eee@gmail.com', 'pass123', 'Bachelor of Computer Science', 'SPV001'),
('SDT002', 'Kai Xian Oo', 'ookx-pm20@student.tarc.edu.my', 'pass123', 'Bachelors of Software Engineering', 'SPV001');

-- --------------------------------------------------------

--
-- Table structure for table `studentreport`
--

CREATE TABLE `studentreport` (
  `reportID` varchar(100) NOT NULL,
  `indemnityReport` varchar(100) DEFAULT NULL,
  `companyAccLetter` varchar(100) DEFAULT NULL,
  `parentAck` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `studentID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentreport`
--

INSERT INTO `studentreport` (`reportID`, `indemnityReport`, `companyAccLetter`, `parentAck`, `status`, `studentID`) VALUES
('R001', 'uploads/University Support Letter_OoKaiXian.pdf', '', '', '', 'STD001');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `supervisorID` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`supervisorID`, `name`, `email`, `password`, `position`, `department`) VALUES
('SPV001', 'Desmund Chau Guan Hin', 'chauguanhin@tarc.edu.my', 'pass123', 'Lecturer', 'Faculty of Computing and Information');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
