-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2017 at 07:36 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `CLASS_ID` int(11) NOT NULL,
  `CLASS_NAME` varchar(50) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`CLASS_ID`, `CLASS_NAME`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(1, 'XII', 'hemant', '2017-09-03 03:53:37', 1),
(5, 'VII', 'hemant', '2017-09-03 03:54:21', 1),
(8, 'V', 'hemant', '2017-09-03 03:54:29', 1),
(13, 'X', 'hemant', '2017-11-21 10:23:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes_in_session`
--

CREATE TABLE `classes_in_session` (
  `CLASS_SESSION_ID` int(11) NOT NULL,
  `CLASS_ID` int(11) NOT NULL,
  `SESSION_ID` varchar(7) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes_in_session`
--

INSERT INTO `classes_in_session` (`CLASS_SESSION_ID`, `CLASS_ID`, `SESSION_ID`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(1, 8, '2017-18', 'hemant', '2003-09-17 03:53:00', 1),
(2, 5, '2017-18', 'hemant', '2003-09-17 03:53:00', 1),
(3, 1, '2017-18', 'hemant', '2003-09-17 03:53:00', 1),
(4, 1, '2015-16', 'hemant', '2017-12-02 15:46:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_wise_students`
--

CREATE TABLE `class_wise_students` (
  `CLASS_WISE_SESSION_ID` int(11) NOT NULL,
  `CLASS_SESSION_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_wise_students`
--

INSERT INTO `class_wise_students` (`CLASS_WISE_SESSION_ID`, `CLASS_SESSION_ID`, `STUDENT_ID`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(1, 1, 1, 'hemant', '2017-11-30 09:50:03', 1),
(2, 1, 2, 'hemant', '2017-11-30 09:50:03', 1),
(3, 1, 3, 'hemant', '2017-11-30 09:50:03', 1),
(4, 1, 4, 'hemant', '2017-11-30 09:50:03', 1),
(5, 1, 5, 'hemant', '2017-11-30 09:50:03', 1),
(6, 1, 6, 'hemant', '2017-11-30 09:50:03', 1),
(7, 1, 7, 'hemant', '2017-11-30 09:50:03', 1),
(8, 1, 8, 'hemant', '2017-11-30 09:50:03', 1),
(9, 1, 9, 'hemant', '2017-11-30 09:50:03', 1),
(10, 1, 10, 'hemant', '2017-11-30 09:50:03', 1),
(11, 2, 11, 'hemant', '2017-11-30 09:53:13', 1),
(12, 2, 12, 'hemant', '2017-11-30 09:55:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_flexible_heads`
--

CREATE TABLE `fee_flexible_heads` (
  `FLEXIBLE_HEAD_ID` int(11) NOT NULL,
  `FLEXIBLE_HEAD_NAME` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fee_flexible_heads`
--

INSERT INTO `fee_flexible_heads` (`FLEXIBLE_HEAD_ID`, `FLEXIBLE_HEAD_NAME`, `DESCRIPTION`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(1, 'C.C.A. Fee', 'The fee to be paid for co-curricular activities.', 'user', '2017-09-03 04:01:43', 1),
(2, 'Mess Fee', 'The fee to be paid for meals at the school mess.', 'user', '2017-09-03 03:59:47', 1),
(3, 'Bus Fee', 'The fee to be paid for availing transportation facilities.', 'user', '2017-10-04 16:32:02', 1),
(5, 'Hostel Fee', 'The Fee to be paid for availing hostel.', 'karan', '2017-11-19 07:52:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_static_heads`
--

CREATE TABLE `fee_static_heads` (
  `STATIC_HEAD_ID` int(11) NOT NULL,
  `STATIC_HEAD_NAME` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fee_static_heads`
--

INSERT INTO `fee_static_heads` (`STATIC_HEAD_ID`, `STATIC_HEAD_NAME`, `DESCRIPTION`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(1, 'Admission Fee', 'The fee to be paid for admission.', 'user', '2017-09-03 04:02:27', 1),
(2, 'Registration Fee', 'The fee to be paid for registration.', 'user', '2017-09-03 04:02:50', 1),
(3, 'Tuition Fee', 'The fee to be paid for tuition.', 'user', '2017-09-03 04:03:11', 1),
(4, 'Examination Fee', 'The fee to be paid for examination.', 'karan', '2017-11-28 09:52:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flexible_to_students`
--

CREATE TABLE `flexible_to_students` (
  `ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `CLASS_SESSION_ID` int(11) NOT NULL,
  `FLEXIBLE_HEAD_ID` int(11) NOT NULL,
  `FLEXIBLE_HEAD_AMOUNT` int(11) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flexible_to_students`
--

INSERT INTO `flexible_to_students` (`ID`, `STUDENT_ID`, `CLASS_SESSION_ID`, `FLEXIBLE_HEAD_ID`, `FLEXIBLE_HEAD_AMOUNT`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(1, 1, 1, 1, 1500, 'hemant', '2004-10-17 16:32:00', 1),
(2, 1, 1, 2, 6000, 'hemant', '2004-10-17 16:32:00', 1),
(3, 2, 1, 3, 4000, 'hemant', '2005-10-17 16:32:00', 1),
(4, 2, 1, 2, 6000, 'hemant', '2006-10-17 16:32:00', 1),
(6, 3, 1, 1, 3000, 'hemant', '2008-10-17 16:32:00', 1),
(7, 4, 1, 3, 3000, 'hemant', '2009-10-17 16:32:00', 1),
(8, 5, 1, 2, 6000, 'hemant', '2010-10-17 16:32:00', 1),
(9, 7, 1, 2, 6000, 'hemant', '2011-10-17 16:32:00', 1),
(10, 8, 1, 1, 1500, 'hemant', '2012-10-17 16:32:00', 1),
(11, 9, 1, 3, 5000, 'hemant', '2013-10-17 16:32:00', 1),
(12, 10, 1, 3, 5000, 'hemant', '2014-10-17 16:32:00', 1),
(15, 8, 1, 2, 5000, 'hemant', '2017-11-02 06:16:19', 1),
(16, 9, 1, 2, 2, 'Hemant Singh Bathyal', '2017-11-16 15:01:42', 1),
(17, 2, 1, 1, 5050, 'Hemant Singh Bathyal', '2017-11-16 15:01:57', 1),
(19, 10, 1, 1, 2000, 'Karan Sati', '2017-11-18 04:39:24', 1),
(20, 9, 1, 1, 2000, 'karan', '2017-11-18 04:43:43', 1),
(21, 1, 1, 3, 3000, 'karan', '2017-11-18 15:57:14', 1),
(22, 5, 1, 1, 2500, 'karan', '2017-11-18 16:07:41', 1),
(23, 11, 2, 1, 500, 'karan', '2017-11-30 09:56:46', 1),
(24, 12, 2, 5, 4500, 'karan', '2017-11-30 09:57:10', 1),
(25, 12, 2, 2, 3000, 'karan', '2017-11-30 09:57:35', 1),
(26, 12, 2, 3, 2000, 'karan', '2017-12-01 10:13:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL,
  `CLASS_SESSION_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `STATIC_HEADS` varchar(200) NOT NULL,
  `FLEXIBLE_HEADS` varchar(200) NOT NULL,
  `STATIC_SPLIT_AMOUNT` int(11) NOT NULL,
  `FLEXIBLE_SPLIT_AMOUNT` int(11) NOT NULL,
  `ACTUAL_AMOUNT` int(11) NOT NULL,
  `PREVIOUS_DUES` int(11) NOT NULL,
  `MONTH_FROM` varchar(20) NOT NULL,
  `YEAR_FROM` varchar(4) NOT NULL,
  `MONTH_TO` varchar(20) NOT NULL,
  `YEAR_TO` varchar(4) NOT NULL,
  `NUMBER_OF_MONTHS` int(2) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`INVOICE_ID`, `CLASS_SESSION_ID`, `STUDENT_ID`, `STATIC_HEADS`, `FLEXIBLE_HEADS`, `STATIC_SPLIT_AMOUNT`, `FLEXIBLE_SPLIT_AMOUNT`, `ACTUAL_AMOUNT`, `PREVIOUS_DUES`, `MONTH_FROM`, `YEAR_FROM`, `MONTH_TO`, `YEAR_TO`, `NUMBER_OF_MONTHS`, `DESCRIPTION`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(421, 1, 1, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee, Mess Fee, Bus Fee', 8700, 10500, 19200, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:15', 1),
(422, 1, 2, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, Mess Fee, C.C.A. Fee', 8700, 15050, 23750, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:15', 1),
(423, 1, 3, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee', 8700, 3000, 10000, 0, 'April', '2017', 'May', '2017', 1, '-', 'karan', '2017-12-01 16:19:15', 1),
(424, 1, 4, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee', 8700, 3000, 11700, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:15', 1),
(425, 1, 5, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Mess Fee, C.C.A. Fee', 8700, 8500, 17200, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:15', 1),
(426, 1, 6, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', '-', 8700, 0, 8700, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:15', 1),
(427, 1, 7, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Mess Fee', 8700, 6000, 14700, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:15', 1),
(428, 1, 8, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee, Mess Fee', 8700, 6500, 15200, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:16', 1),
(429, 1, 9, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, Mess Fee, C.C.A. Fee', 8700, 7002, 15702, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:16', 1),
(430, 1, 10, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, C.C.A. Fee', 8700, 7000, 15700, 0, 'April', '2017', 'May', '2017', 1, 'No dues.', 'karan', '2017-12-01 16:19:16', 1),
(431, 1, 1, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee, Mess Fee, Bus Fee', 8700, 10500, 19200, 19200, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(432, 1, 2, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, Mess Fee, C.C.A. Fee', 8700, 15050, 23750, 23750, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(433, 1, 3, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee', 8700, 3000, 11700, 10000, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(434, 1, 4, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee', 8700, 3000, 11700, 11700, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(435, 1, 5, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Mess Fee, C.C.A. Fee', 8700, 8500, 0, 0, 'May', '2017', 'June', '2017', 1, '-', 'karan', '2017-12-01 16:58:10', 1),
(436, 1, 6, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', '-', 8700, 0, 8700, 8700, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(437, 1, 7, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Mess Fee', 8700, 6000, 0, 0, 'May', '2017', 'June', '2017', 1, '-', 'karan', '2017-12-01 16:58:10', 1),
(438, 1, 8, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee, Mess Fee', 8700, 6500, 15200, 15200, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(439, 1, 9, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, Mess Fee, C.C.A. Fee', 8700, 7002, 15702, 15702, 'May', '2017', 'June', '2017', 1, 'Remaining dues.', 'karan', '2017-12-01 16:58:10', 1),
(440, 1, 10, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, C.C.A. Fee', 8700, 7000, 8300, 15700, 'May', '2017', 'June', '2017', 1, '-', 'karan', '2017-12-01 16:58:10', 1),
(441, 2, 11, 'Admission Fee, Registration Fee, Tuition Fee', 'C.C.A. Fee', 20000, 2000, 17000, 0, 'April', '2017', 'August', '2017', 4, '-', 'karan', '2017-12-01 18:05:05', 1),
(442, 2, 12, 'Admission Fee, Registration Fee, Tuition Fee', 'Hostel Fee, Mess Fee, Bus Fee', 20000, 38000, 0, 0, 'April', '2017', 'August', '2017', 4, '-', 'karan', '2017-12-01 18:05:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `RECEIPT_ID` int(11) NOT NULL,
  `INVOICE_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `CLASS_SESSION_ID` int(11) NOT NULL,
  `STATIC_HEADS` varchar(200) NOT NULL,
  `FLEXIBLE_HEADS` varchar(200) NOT NULL,
  `DISCOUNT` varchar(10) NOT NULL,
  `DISCOUNT_AMOUNT` int(11) NOT NULL,
  `FINE` varchar(10) NOT NULL,
  `FINE_AMOUNT` int(11) NOT NULL,
  `ACTUAL_PAID_AMOUNT` int(11) NOT NULL,
  `MODE_OF_PAYMENT` varchar(20) NOT NULL,
  `DD_CHEQUE_NUMBER` varchar(20) NOT NULL,
  `DD_CHEQUE_DATE` varchar(10) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`RECEIPT_ID`, `INVOICE_ID`, `STUDENT_ID`, `CLASS_SESSION_ID`, `STATIC_HEADS`, `FLEXIBLE_HEADS`, `DISCOUNT`, `DISCOUNT_AMOUNT`, `FINE`, `FINE_AMOUNT`, `ACTUAL_PAID_AMOUNT`, `MODE_OF_PAYMENT`, `DD_CHEQUE_NUMBER`, `DD_CHEQUE_DATE`, `DESCRIPTION`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(16, 423, 3, 1, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'C.C.A. Fee', 'No', 0, 'No', 0, 1700, 'Cash', '-', '-', '-', 'karan', '2017-12-01 16:19:53', 1),
(17, 442, 12, 2, 'Admission Fee, Registration Fee, Tuition Fee', 'Hostel Fee, Mess Fee, Bus Fee', 'No', 0, 'No', 0, 58000, 'Cash', '-', '-', '-', 'karan', '2017-12-01 18:05:23', 1),
(18, 441, 11, 2, 'Admission Fee, Registration Fee, Tuition Fee', 'C.C.A. Fee', 'No', 0, 'No', 0, 5000, 'Cash', '-', '-', '-', 'karan', '2017-12-01 18:05:39', 1),
(19, 435, 5, 1, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Mess Fee, C.C.A. Fee', 'No', 0, 'No', 0, 34400, 'Cash', '-', '-', '-', 'karan', '2017-12-01 18:09:14', 1),
(20, 437, 7, 1, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Mess Fee', 'No', 0, 'No', 0, 29400, 'Cash', '-', '-', '-', 'karan', '2017-12-02 15:57:30', 1),
(21, 440, 10, 1, 'Registration Fee, Tuition Fee, Admission Fee, Examination Fee', 'Bus Fee, C.C.A. Fee', 'Yes', 5000, 'Yes', 600, 7400, 'Cash', '-', '-', '-', 'karan', '2017-12-04 18:05:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SESSION_ID` varchar(7) NOT NULL,
  `START_DATE` varchar(20) NOT NULL,
  `END_DATE` varchar(20) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`SESSION_ID`, `START_DATE`, `END_DATE`, `USER_ID`, `DATE_`, `STATUS`) VALUES
('2015-16', '01-04-2015', '31-03-2016', 'hemant', '2017-10-04 16:35:41', 0),
('2016-17', '01-04-2016', '31-03-2017', 'hemant', '2017-10-04 16:35:41', 0),
('2017-18', '01-04-2017', '31-03-2018', 'hemant', '2017-10-04 16:35:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `static_to_classes`
--

CREATE TABLE `static_to_classes` (
  `ID` int(11) NOT NULL,
  `CLASS_SESSION_ID` int(11) NOT NULL,
  `STATIC_HEAD_ID` int(11) NOT NULL,
  `STATIC_HEAD_AMOUNT` int(11) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `static_to_classes`
--

INSERT INTO `static_to_classes` (`ID`, `CLASS_SESSION_ID`, `STATIC_HEAD_ID`, `STATIC_HEAD_AMOUNT`, `USER_ID`, `DATE_`, `STATUS`) VALUES
(2, 1, 2, 2000, 'hemant', '2004-10-17 16:35:00', 1),
(3, 1, 3, 2000, 'hemant', '2004-10-17 16:35:00', 1),
(4, 2, 1, 1500, 'hemant', '2017-10-25 17:16:28', 1),
(17, 5, 1, 3000, 'Karan Sati', '2017-11-16 10:51:49', 1),
(19, 1, 1, 4500, 'Karan Sati', '2017-11-16 11:06:34', 1),
(21, 4, 1, 700, 'Karan Sati', '2017-11-16 14:56:26', 1),
(22, 3, 2, 2000, 'Karan Sati', '2017-11-17 08:38:18', 1),
(23, 2, 2, 2000, 'karan', '2017-11-18 07:54:42', 1),
(24, 1, 4, 200, 'karan', '2017-11-28 09:53:10', 1),
(25, 2, 3, 1500, 'karan', '2017-12-01 10:13:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `STUDENT_ID` int(11) NOT NULL,
  `STUDENT_NAME` varchar(50) NOT NULL,
  `FATHER_NAME` varchar(50) NOT NULL,
  `MOTHER_NAME` varchar(50) NOT NULL,
  `D_O_B` varchar(10) NOT NULL,
  `GENDER` varchar(1) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `CONTACT_NUMBER` varchar(10) NOT NULL,
  `DATE_OF_ADMISSION` varchar(10) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_ID` varchar(50) NOT NULL,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`STUDENT_ID`, `STUDENT_NAME`, `FATHER_NAME`, `MOTHER_NAME`, `D_O_B`, `GENDER`, `ADDRESS`, `CONTACT_NUMBER`, `DATE_OF_ADMISSION`, `DATE_`, `USER_ID`, `STATUS`) VALUES
(1, 'HOSHIYAR SINGH', 'DIVYANSH KUMAR', 'NEETA SINGH', '21-02-2006', 'M', 'Flat F/35, Durga Colony, Ramnagar', '9637532581', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(2, 'MANISHA NEGI', 'DIVYANSH KUMAR', 'NEETA SINGH', '14-01-2006', 'F', 'House Number 23, Modern Enclave, Nainital', '9637532582', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(3, 'BABITA NEGI', 'DIVYANSH KUMAR', 'NEETA SINGH', '14-01-2006', 'F', 'P 30/35 Anand Vihar, Haldwani', '9637532583', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(4, 'BHAWANA JOSHI', 'DIVYANSH KUMAR', 'NEETA SINGH', '02-04-2006', 'F', 'Flat A/32, C-Wing, Paradise Villas, Bhimtal', '9637532584', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(5, 'MANJU RANA', 'DIVYANSH KUMAR', 'NEETA SINGH', '01-06-2006', 'F', 'Maa Bhadra Kali Society, Haldwani', '9637532585', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(6, 'ROHIT SINGH MEHRA', 'DIVYANSH KUMAR', 'NEETA SINGH', '02-10-2016', 'M', 'House Number 32, Amba Nagar, Kathgodam', '9637532586', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(7, 'PRIYANSHU RANA', 'DIVYANSH KUMAR', 'NEETA SINGH', '23-03-2016', 'M', 'House Number 121, Faiz Colony, Haldwani', '9637532587', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(8, 'TANIYA NEGI', 'DIVYANSH KUMAR', 'NEETA SINGH', '01-03-2006', 'F', 'Flat Number 12, Indra Cottages, Kathgodam', '9637532588', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(9, 'MANOJ SINGH', 'DIVYANSH KUMAR', 'NEETA SINGH', '25-11-2005', 'M', 'House Number 74, New Society, Haldwani', '9637532589', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(10, 'NEHA MARTOLIYA', 'DIVYANSH KUMAR', 'NEETA SINGH', '25-09-2006', 'F', 'Krishna Kunj, Nainital', '9637532590', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(11, 'NISHA', 'DIVYANSH KUMAR', 'NEETA SINGH', '28-09-2006', 'F', 'Lake View Colony, Bhimtal', '9637532590', '01-04-2017', '2029-04-17 10:43:00', 'hemant', 1),
(12, 'VISHAL KUMAR', 'DIVYANSH KUMAR', 'NEETA SINGH', '28-08-2006', 'M', 'Flat F/31, Divine Colony, Ramnagar', '9637532581', '01-04-2017', '2017-11-30 09:41:54', 'hemant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` varchar(50) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `USER_STATUS_ID` int(11) NOT NULL,
  `THUMBNAIL` varchar(150) DEFAULT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `PASSWORD`, `USER_STATUS_ID`, `THUMBNAIL`, `DATE_`, `STATUS`) VALUES
('chandan', 'Chandan', ' Singh Khani', 'chandan', 2, 'http://localhost/fms/img/users/chandan5a25a241a54215.62077237.jpg', '2017-08-25 13:58:05', 1),
('hemant', 'Hemant', 'Singh Bathyal', 'hemant', 1, 'http://localhost/fms/img/users/hemant5a25a1ed384d31.25718289.jpg', '2017-08-25 13:58:05', 1),
('karan', 'Karan', 'Sati', 'karan', 3, 'http://localhost/fms/img/users/karan5a25a2238d69a0.91494289.jpg', '2017-08-25 13:58:05', 1),
('mahendrasinghbora', 'Mahendra', 'Singh Bora', 'mahendra', 1, 'http://localhost/fms/img/users/mahendrasinghbora5a25a263d40728.53754533.jpg', '2017-11-11 08:17:26', 1),
('mahinder', 'Mahinder', 'Singh Bagdwal', '123456', 3, 'http://localhost/fms/img/users/mahinder5a25a3a22c39b7.86551679.jpg', '2017-12-04 19:35:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `LOG_ID` int(11) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `LOG_IN_TIME` timestamp NOT NULL,
  `LOG_OUT_TIME` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`LOG_ID`, `USER_ID`, `LOG_IN_TIME`, `LOG_OUT_TIME`) VALUES
(2, 'hemant', '2017-12-02 12:25:35', '2017-12-02 12:25:46'),
(3, 'hemant', '2017-12-02 14:33:51', '2017-12-02 14:35:24'),
(4, 'karan', '2017-12-02 14:42:47', '2017-12-02 15:58:18'),
(5, 'hemant', '2017-12-02 15:12:05', '2017-12-02 15:12:22'),
(6, 'hemant', '2017-12-02 15:38:11', '2017-12-02 15:48:17'),
(7, 'hemant', '2017-12-02 15:49:10', '2017-12-02 15:51:41'),
(8, 'hemant', '2017-12-02 15:51:49', '2017-12-02 15:53:22'),
(9, 'hemant', '2017-12-02 15:53:32', '2017-12-02 15:53:47'),
(10, 'hemant', '2017-12-02 15:53:54', '2017-12-02 15:53:59'),
(11, 'hemant', '2017-12-02 15:54:05', '2017-12-03 14:06:58'),
(12, 'karan', '2017-12-02 15:54:55', '2017-12-02 15:58:18'),
(13, 'chandan', '2017-12-02 15:58:26', '2017-12-03 07:16:52'),
(14, 'chandan', '2017-12-03 06:55:39', '2017-12-03 07:16:52'),
(15, 'chandan', '2017-12-03 07:17:58', '2017-12-03 07:21:16'),
(16, 'karan', '2017-12-03 07:25:50', '2017-12-03 07:42:33'),
(17, 'karan', '2017-12-03 07:26:30', '2017-12-03 07:42:33'),
(18, 'karan', '2017-12-03 07:27:26', '2017-12-03 07:42:33'),
(19, 'karan', '2017-12-03 07:56:59', '2017-12-03 14:23:09'),
(20, 'hemant', '2017-12-03 12:58:26', '2017-12-03 14:06:58'),
(21, 'karan', '2017-12-03 14:07:05', '2017-12-03 14:23:09'),
(22, 'karan', '2017-12-03 14:23:16', '2017-12-03 14:57:28'),
(23, 'karan', '2017-12-03 14:57:34', '2017-12-03 15:11:48'),
(24, 'karan', '2017-12-03 15:11:54', '2017-12-03 17:10:56'),
(25, 'hemant', '2017-12-03 15:50:58', '2017-12-03 15:55:29'),
(26, 'hemant', '2017-12-03 15:55:36', '2017-12-03 15:57:11'),
(27, 'hemant', '2017-12-03 15:57:17', '2017-12-03 15:59:22'),
(28, 'hemant', '2017-12-03 15:58:37', '2017-12-03 15:59:22'),
(29, 'hemant', '2017-12-03 15:59:28', '2017-12-03 16:00:26'),
(30, 'hemant', '2017-12-03 16:00:34', '2017-12-03 16:04:35'),
(31, 'hemant', '2017-12-03 16:04:20', '2017-12-03 16:04:35'),
(32, 'hemant', '2017-12-03 16:04:41', '2017-12-03 16:05:32'),
(33, 'hemant', '2017-12-03 16:05:38', '2017-12-03 16:07:55'),
(34, 'hemant', '2017-12-03 16:08:03', '2017-12-03 16:08:08'),
(35, 'hemant', '2017-12-03 16:14:22', '2017-12-03 16:33:01'),
(36, 'hemant', '2017-12-03 16:22:17', '2017-12-03 16:33:01'),
(37, 'hemant', '2017-12-03 16:33:07', '2017-12-03 16:38:25'),
(38, 'hemant', '2017-12-03 16:38:30', '2017-12-03 16:38:36'),
(39, 'hemant', '2017-12-03 16:38:46', '2017-12-03 17:07:09'),
(40, 'hemant', '2017-12-03 17:01:37', '2017-12-03 17:07:09'),
(41, 'hemant', '2017-12-03 17:07:15', '2017-12-03 17:11:09'),
(42, 'karan', '2017-12-03 17:10:25', '2017-12-03 17:10:56'),
(43, 'karan', '2017-12-03 17:11:02', '2017-12-03 19:34:08'),
(44, 'karan', '2017-12-03 17:11:15', '2017-12-03 19:34:08'),
(45, 'karan', '2017-12-03 17:18:24', '2017-12-03 19:34:08'),
(46, 'chandan', '2017-12-03 17:34:46', '2017-12-03 19:35:11'),
(47, 'chandan', '2017-12-03 17:37:15', '2017-12-03 19:35:11'),
(48, 'chandan', '2017-12-03 17:38:55', '2017-12-03 19:35:11'),
(49, 'hemant', '2017-12-03 17:41:49', '2017-12-03 19:34:39'),
(50, 'karan', '2017-12-03 17:45:12', '2017-12-03 19:34:08'),
(51, 'hemant', '2017-12-03 17:46:33', '2017-12-03 19:34:39'),
(52, 'hemant', '2017-12-03 17:58:40', '2017-12-03 19:34:39'),
(53, 'karan', '2017-12-03 18:04:04', '2017-12-03 19:34:08'),
(54, 'karan', '2017-12-03 18:06:22', '2017-12-03 19:34:08'),
(55, 'hemant', '2017-12-03 18:35:42', '2017-12-03 19:34:39'),
(56, 'hemant', '2017-12-03 19:34:14', '2017-12-03 19:34:39'),
(57, 'chandan', '2017-12-03 19:34:46', '2017-12-03 19:35:11'),
(58, 'hemant', '2017-12-03 19:39:02', '2017-12-03 19:43:01'),
(59, 'ajay', '2017-12-03 19:43:08', '2017-12-03 19:53:16'),
(60, 'hemant', '2017-12-03 19:46:54', '2017-12-03 19:47:16'),
(61, 'ajay', '2017-12-03 19:47:41', '2017-12-03 19:53:16'),
(62, 'ajay', '2017-12-03 19:53:21', '2017-12-03 19:54:07'),
(63, 'chandan', '2017-12-03 19:54:22', '2017-12-03 19:55:10'),
(64, 'ajay', '2017-12-03 19:55:18', '2017-12-03 19:57:38'),
(65, 'hemant', '2017-12-03 19:57:45', '2017-12-03 19:58:32'),
(66, 'mahinder', '2017-12-03 19:58:40', '2017-12-03 20:01:36'),
(67, 'mahinder', '2017-12-03 20:01:43', '2017-12-03 20:02:03'),
(68, 'ajay', '2017-12-03 20:02:10', '2017-12-03 20:02:31'),
(69, 'ajay', '2017-12-03 20:02:36', '2017-12-03 20:02:53'),
(70, 'mahinder', '2017-12-03 20:03:03', '2017-12-03 20:04:41'),
(71, 'mahinder', '2017-12-03 20:04:17', '2017-12-03 20:04:41'),
(72, 'hemant', '2017-12-03 20:04:47', '2017-12-03 20:05:40'),
(73, 'karan', '2017-12-03 20:06:16', '2017-12-03 20:12:46'),
(74, 'chandan', '2017-12-03 20:12:57', '2017-12-03 21:00:01'),
(75, 'hemant', '2017-12-04 07:16:41', '2017-12-04 08:03:38'),
(76, 'karan', '2017-12-04 08:03:52', '2017-12-04 08:22:37'),
(77, 'chandan', '2017-12-04 08:22:44', '2017-12-04 09:33:07'),
(78, 'chandan', '2017-12-04 17:52:29', '2017-12-04 17:56:46'),
(79, 'hemant', '2017-12-04 17:56:52', '2017-12-04 17:57:16'),
(80, 'hemant', '2017-12-04 17:58:59', '2017-12-04 18:01:02'),
(81, 'karan', '2017-12-04 18:01:09', '2017-12-04 19:13:19'),
(82, 'hemant', '2017-12-04 19:13:38', '2017-12-04 19:14:22'),
(83, 'chandan', '2017-12-04 19:14:30', '2017-12-04 19:20:40'),
(84, 'hemant', '2017-12-04 19:20:46', '2017-12-04 19:28:50'),
(85, 'karan', '2017-12-04 19:28:59', '2017-12-04 19:29:48'),
(86, 'chandan', '2017-12-04 19:29:57', '2017-12-04 19:30:20'),
(87, 'mahendrasinghbora', '2017-12-04 19:30:29', '2017-12-04 19:35:40'),
(88, 'mahinder', '2017-12-04 19:35:48', '2017-12-04 19:36:22'),
(89, 'chandan', '2017-12-04 19:36:29', '2017-12-04 19:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `USER_STATUS_ID` int(11) NOT NULL,
  `USER_TYPE` varchar(20) NOT NULL,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`USER_STATUS_ID`, `USER_TYPE`, `STATUS`) VALUES
(1, 'ADMIN', 1),
(2, 'MANAGEMENT', 1),
(3, 'ACCOUNTS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`CLASS_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `classes_in_session`
--
ALTER TABLE `classes_in_session`
  ADD PRIMARY KEY (`CLASS_SESSION_ID`),
  ADD KEY `CLASS_ID` (`CLASS_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `class_wise_students`
--
ALTER TABLE `class_wise_students`
  ADD PRIMARY KEY (`CLASS_WISE_SESSION_ID`),
  ADD KEY `CLASS_SESSION_ID` (`CLASS_SESSION_ID`),
  ADD KEY `STUDENT_ID` (`STUDENT_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `fee_flexible_heads`
--
ALTER TABLE `fee_flexible_heads`
  ADD PRIMARY KEY (`FLEXIBLE_HEAD_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `fee_static_heads`
--
ALTER TABLE `fee_static_heads`
  ADD PRIMARY KEY (`STATIC_HEAD_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `flexible_to_students`
--
ALTER TABLE `flexible_to_students`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLASS_SESSION_ID` (`CLASS_SESSION_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `FLEXIBLE_HEAD_ID` (`FLEXIBLE_HEAD_ID`),
  ADD KEY `STUDENT_ID` (`STUDENT_ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`INVOICE_ID`),
  ADD KEY `CLASS_SESSION_ID` (`CLASS_SESSION_ID`),
  ADD KEY `STUDENT_ID` (`STUDENT_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`RECEIPT_ID`),
  ADD KEY `INVOICE_ID` (`INVOICE_ID`),
  ADD KEY `STUDENT_ID` (`STUDENT_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SESSION_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `static_to_classes`
--
ALTER TABLE `static_to_classes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLASS_SESSION_ID` (`CLASS_SESSION_ID`),
  ADD KEY `STATIC_HEAD_ID` (`STATIC_HEAD_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`STUDENT_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`LOG_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `USER_ID_2` (`USER_ID`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`USER_STATUS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `classes_in_session`
--
ALTER TABLE `classes_in_session`
  MODIFY `CLASS_SESSION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class_wise_students`
--
ALTER TABLE `class_wise_students`
  MODIFY `CLASS_WISE_SESSION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `fee_flexible_heads`
--
ALTER TABLE `fee_flexible_heads`
  MODIFY `FLEXIBLE_HEAD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fee_static_heads`
--
ALTER TABLE `fee_static_heads`
  MODIFY `STATIC_HEAD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `flexible_to_students`
--
ALTER TABLE `flexible_to_students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `RECEIPT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `static_to_classes`
--
ALTER TABLE `static_to_classes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `LOG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `USER_STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
