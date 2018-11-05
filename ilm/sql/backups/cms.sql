-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 09:54 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_type` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `opening_balance` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_name`, `account_type`, `description`, `opening_balance`, `parent_id`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_active`) VALUES
(11, 'Assets', 1, 'Assets Acc.', '5000', 0, '2018-10-14 18:44:08', 5, '2018-10-14 23:51:20', 5, 0),
(12, 'Expense', 1, 'Expense Acc.', '5000', 0, '2018-10-14 18:44:19', 5, '2018-10-14 18:44:19', 0, 0),
(13, 'Income', 1, 'Income Acc.', '5000', 0, '2018-10-14 18:44:35', 5, '2018-10-14 18:44:35', 0, 0),
(14, 'Capital', 1, 'Capital Acc.', '5000', 0, '2018-10-14 18:45:01', 5, '2018-10-14 18:45:01', 0, 0),
(15, 'Liabilities', 1, 'Liabilities Acc.', '5000', 0, '2018-10-14 18:45:15', 5, '2018-10-14 18:45:15', 0, 0),
(16, 'Fee', 1, 'Fee Acc.', '5000', 13, '2018-10-14 18:47:56', 5, '2018-10-14 18:47:56', 0, 0),
(17, 'Cash', 1, 'Cash Acc', '5000', 0, '2018-10-14 18:48:56', 5, '2018-10-14 18:48:56', 0, 0),
(18, 'Fine', 1, 'Fines Account', '0', 13, '2018-10-23 22:34:21', 5, '2018-10-23 22:34:21', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address_type` int(11) NOT NULL COMMENT '0 = present, 1 = permenant'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `enrollment_id`, `city`, `district`, `country`, `address`, `address_type`) VALUES
(1, 1, 'Gujranwala', 'Punjab', 'Pakistan', ' Mohallah faisalabad street # 1', 0),
(2, 1, 'Gujranwala', 'Punjab', 'Pakistan', 'Mohallah faisalabad street # 1', 1),
(3, 2, 'Gujranwala', 'Punjab', 'Pakistan', '  people colony', 0),
(4, 2, 'Gujranwala', 'Punjab', 'Pakistan', ' people colony', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`, `program_id`) VALUES
(1, 'part-I', 2),
(2, 'part-II', 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `study_medium` int(11) NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `pic` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = old, 1 = active, 2 = suspend, 3 = leave'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `enrollment_date`, `class_id`, `section_id`, `study_medium`, `roll_no`, `pic`, `created_at`, `updated_at`, `created_by`, `edited_by`, `status`) VALUES
(1, '2018-10-17 19:00:00', 2, 1, 1, '345234', '5bc8fae5bc576_simple_cropped.jpg', '2018-10-18 21:27:50', '2018-10-18 06:28:05', 5, 5, 1),
(2, '2018-10-23 19:00:00', 1, 1, 1, '123', '5bd0ccae0b706_IMG_20180915_150755.jpg', '2018-10-24 19:49:02', '2018-10-24 04:49:48', 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `family_information`
--

CREATE TABLE `family_information` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_cnic` varchar(50) NOT NULL,
  `guardian` int(11) NOT NULL COMMENT '0 = father, 1 = mother, 2 = other',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `office_address` text NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family_information`
--

INSERT INTO `family_information` (`id`, `enrollment_id`, `father_name`, `father_cnic`, `guardian`, `first_name`, `last_name`, `profession`, `designation`, `organization_name`, `office_address`, `telephone`, `mobile_no`, `email`) VALUES
(1, 1, 'ghulam haider', '34101-1236547-9', 0, 'ghulam', 'haider', '', '', '', '', '', '', ''),
(2, 2, 'Mohammad', 'Afzal', 0, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fee_info`
--

CREATE TABLE `fee_info` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `adm_fee` float NOT NULL,
  `fee_package` float NOT NULL,
  `tuition_fee` float NOT NULL,
  `boardUniReg_fee` float NOT NULL,
  `library_fee` float NOT NULL,
  `miscellaneous_fee` float NOT NULL,
  `others` float NOT NULL,
  `total_fee` float NOT NULL,
  `discount` int(11) NOT NULL,
  `grand_total` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_info`
--

INSERT INTO `fee_info` (`id`, `enrollment_id`, `adm_fee`, `fee_package`, `tuition_fee`, `boardUniReg_fee`, `library_fee`, `miscellaneous_fee`, `others`, `total_fee`, `discount`, `grand_total`, `status`) VALUES
(1, 1, 5000, 20000, 10000, 2000, 1000, 2000, 1000, 38000, 0, 41000, 1),
(2, 2, 5000, 20000, 5000, 5000, 2000, 2000, 1000, 40000, 2000, 38000, 0),
(3, 2, 5000, 20000, 5000, 5000, 2000, 2000, 1000, 40000, 1000, 39000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_pkg_history`
--

CREATE TABLE `fee_pkg_history` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `fee_pkg_id` int(11) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_pkg_history`
--

INSERT INTO `fee_pkg_history` (`id`, `enrollment_id`, `fee_pkg_id`, `modification_date`, `modified_by`) VALUES
(1, 2, 2, '2018-10-24 19:49:49', 5);

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `id` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`id`, `classId`, `sectionId`, `fine`) VALUES
(1, 1, 1, 50),
(2, 2, 1, 70),
(3, 1, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `paid_fee`
--

CREATE TABLE `paid_fee` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  `installment_no` int(11) NOT NULL,
  `fee_amount` decimal(13,2) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0= unpaid, 1 = paid, 2 = wave off',
  `installment_date` date NOT NULL,
  `pay_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edited_by` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = not_deleted, 1 = soft_deleted',
  `group_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paid_fee`
--

INSERT INTO `paid_fee` (`id`, `enrollment_id`, `classId`, `sectionId`, `installment_no`, `fee_amount`, `status`, `installment_date`, `pay_date`, `created_by`, `created_at`, `modified_at`, `edited_by`, `delete_status`, `group_id`) VALUES
(59, 1, 2, 1, 1, '11000.00', 1, '2018-10-19', '2018-10-18 23:53:19', 5, '2018-10-18 23:53:19', '0000-00-00 00:00:00', 5, 1, '5bc91cef524dd'),
(60, 1, 2, 1, 2, '30000.00', 0, '2018-11-18', '0000-00-00 00:00:00', 5, '2018-10-18 23:53:19', '0000-00-00 00:00:00', 5, 1, '5bc91cef524dd'),
(61, 1, 2, 1, 1, '11000.00', 1, '2018-10-23', '2018-10-23 16:59:10', 5, '2018-10-23 16:59:10', '0000-00-00 00:00:00', 5, 1, '5bcf535ea93b9'),
(62, 1, 2, 1, 2, '10000.00', 1, '2018-10-20', '2018-10-24 07:39:46', 5, '2018-10-23 16:59:10', '0000-00-00 00:00:00', 5, 1, '5bcf535ea93b9'),
(63, 1, 2, 1, 3, '10000.00', 0, '2018-11-12', '0000-00-00 00:00:00', 5, '2018-10-23 16:59:10', '0000-00-00 00:00:00', 5, 1, '5bcf535ea93b9'),
(64, 1, 2, 1, 4, '10000.00', 0, '2018-11-22', '0000-00-00 00:00:00', 5, '2018-10-23 16:59:10', '0000-00-00 00:00:00', 5, 1, '5bcf535ea93b9'),
(65, 1, 2, 1, 1, '11000.00', 1, '2018-10-24', '2018-10-24 19:12:04', 5, '2018-10-24 19:12:04', '0000-00-00 00:00:00', 0, 0, '5bd0c404c1ad9'),
(66, 1, 2, 1, 2, '10000.00', 1, '2018-10-20', '0000-00-00 00:00:00', 5, '2018-10-24 19:12:04', '0000-00-00 00:00:00', 0, 0, '5bd0c404c1ad9'),
(67, 1, 2, 1, 3, '15000.00', 0, '2018-11-12', '0000-00-00 00:00:00', 5, '2018-10-24 19:12:04', '0000-00-00 00:00:00', 0, 0, '5bd0c404c1ad9'),
(68, 1, 2, 1, 4, '5000.00', 2, '2018-11-22', '2018-10-24 04:22:05', 5, '2018-10-24 19:12:05', '0000-00-00 00:00:00', 0, 0, '5bd0c404c1ad9');

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `dob` date NOT NULL,
  `religion` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `caste` varchar(50) NOT NULL,
  `bform_or_cnic_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `enrollment_id`, `first_name`, `last_name`, `gender`, `dob`, `religion`, `blood_group`, `caste`, `bform_or_cnic_no`) VALUES
(1, 1, 'Asad', 'Ullah', 1, '1995-01-09', 1, '3', 'Ansari', '341013552959'),
(2, 2, 'umer', 'farooq', 1, '1995-01-09', 1, '1', 'Mughal', '341013552959');

-- --------------------------------------------------------

--
-- Table structure for table `previous_examination_types`
--

CREATE TABLE `previous_examination_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previous_examination_types`
--

INSERT INTO `previous_examination_types` (`id`, `title`) VALUES
(1, 'Matric'),
(2, 'Intermediate'),
(3, 'Graduation');

-- --------------------------------------------------------

--
-- Table structure for table `previous_institution_details`
--

CREATE TABLE `previous_institution_details` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `exam_year` int(11) NOT NULL,
  `p_roll_no` varchar(255) NOT NULL,
  `board_university` varchar(255) NOT NULL,
  `obt_marks` float NOT NULL,
  `total_marks` float NOT NULL,
  `grade` varchar(10) NOT NULL,
  `subjects` text NOT NULL,
  `institute_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previous_institution_details`
--

INSERT INTO `previous_institution_details` (`id`, `enrollment_id`, `exam_type`, `exam_year`, `p_roll_no`, `board_university`, `obt_marks`, `total_marks`, `grade`, `subjects`, `institute_name`) VALUES
(3, 1, '1', 2010, '132132', 'Gujranwala Board', 812, 1050, 'A', 'Math', 'Al-Rehman School'),
(4, 1, '2', 2012, '345', 'Gujranwala Board', 567, 1050, 'C', 'Math', 'Govt. Clg'),
(6, 2, '1', 0, '', '', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`) VALUES
(1, 'M.BA'),
(2, 'B.A'),
(3, 'F.Sc'),
(4, 'F.A');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`, `class_id`) VALUES
(1, 'boys', 1),
(2, 'girls', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

CREATE TABLE `student_status` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '1 = true, 0 = false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_no` int(11) NOT NULL,
  `title` text NOT NULL,
  `book_reference` varchar(255) DEFAULT NULL,
  `debit_account` int(11) NOT NULL,
  `credit_account` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_no`, `title`, `book_reference`, `debit_account`, `credit_account`, `description`, `amount`, `created_by`, `created_at`, `modified_at`, `modified_by`, `is_active`) VALUES
(1, 0, 'electricity repair', '12', 12, 17, 'electricity repair', '1000', 5, '2018-10-16 23:15:20', '0000-00-00', 0, 0),
(2, 0, '2nd transaction', 'asdf234', 11, 15, 'asdf transaction', '1000', 5, '2018-10-16 23:18:47', '0000-00-00', 0, 0),
(4, 0, '3rd transaction', '12', 11, 17, 'asdf transaction', '2000', 5, '2018-10-17 00:09:55', '0000-00-00', 0, 0),
(5, 0, 'fee received', '12', 17, 16, 'fee received', '5000', 5, '2018-10-17 00:17:19', '0000-00-00', 0, 0),
(21, 0, 'Fee Recevied From: Asad Ullah, Class: part-II', NULL, 17, 16, 'Fee Recevied From: Asad Ullah, Class: part-II', '11000', 5, '2018-10-18 23:53:19', '0000-00-00', 0, 0),
(22, 0, 'Fee Recevied From: Asad Ullah, Class: part-II', NULL, 17, 16, 'Fee Recevied From: Asad Ullah, Class: part-II', '10280', 5, '2018-10-23 22:39:46', '0000-00-00', 0, 0),
(23, 0, 'Fine Recevied From: Asad Ullah, Class: part-II', NULL, 17, 18, 'Fee Recevied From: Asad Ullah, Class: part-II', '200', 5, '2018-10-23 22:39:46', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `cnic` varchar(30) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '0 = admin, 1 = clerk, 2 = accountant',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` int(11) NOT NULL COMMENT '1 = true, 0 = false',
  `is_approved` int(11) NOT NULL DEFAULT '0' COMMENT '1 = true, 0 = false',
  `image_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `address`, `phone_no`, `dob`, `cnic`, `qualification`, `role_id`, `created_by`, `modified_by`, `created_at`, `modified_at`, `is_active`, `is_approved`, `image_url`) VALUES
(2, 'Zeeshan', 'Ahmad', 'Zeeshan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Shaheenabad, Gujranwala', '03086440945', '2018-09-18', '341015017985', 'F.Sc', 0, 2, 5, '2018-09-13 04:11:12', '2018-10-15 00:37:16', 0, 1, './uploaded_images/3111.jpg'),
(3, 'Ali', 'Hamza', 'alihamza446014@gmail.com', '9b7141a49138bf8291db51cc6ee158d6', 'male', 'Shaheenabad, Gujranwala,', '03059042500', '1997-05-04', '3410122179850', 'F.Sc', 0, 2, 5, '2018-09-14 04:11:12', '2018-10-07 04:19:35', 0, 1, './uploaded_images/3112.jpg'),
(4, 'Hafiz', 'Waseem', 'waseem@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Vnext solution gujranwala', '030356842', '2018-09-12', '34101257481', 'F.A', 2, 5, 5, '2018-09-15 04:11:12', '2018-09-18 00:09:30', 0, 0, './uploaded_images/32.jpg'),
(5, 'Asad', 'ullah', 'king.master127@gmail.com', 'f5de9352cba612589e4b749a58cc9188', 'male', 'Model Town, Gujranwala', '03053020152', '1997-09-10', '34101564513', 'B.A', 0, 3, 3, '2018-09-13 04:11:12', '2018-09-19 05:59:23', 1, 1, './uploaded_images/blured.jpg'),
(6, 'Muzammal', 'Ali', 'muzammal@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Rustam Kotli, Gujranwala', '03086440945', '2018-09-04', '34101257481', 'B.Sc', 2, 5, 5, '2018-09-18 04:11:12', '2018-09-19 06:00:10', 0, 0, './uploaded_images/index21.jpg'),
(7, 'hhfs', 'shfdsgsf', 'gfsgsgf@gmil.com', '123456', 'female', 'fgfgs', '15252554', '2018-09-19', 'y575765', 'hfdg', 2, 2, 2, '2018-09-18 04:11:12', '2018-09-19 05:59:33', 0, 0, ''),
(8, 'Awais', 'Ali', 'awais@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'fdsjhhdahfjhagf', '03006440956', '2018-08-28', '3410122179850', 'B.Sc', 1, 5, 3, '2018-09-18 12:24:46', '2018-09-19 05:59:29', 0, 0, './uploaded_images/3110.jpg'),
(9, 'fhgfdhg', 'fhggfdhd', 'hggfdhgfh@gmil.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0000-00-00', '', '', 2, 3, 0, '2018-09-19 06:02:49', '0000-00-00 00:00:00', 0, 0, ''),
(10, 'asad', 'asad', 'king.master121@gmail.com', 'f5de9352cba612589e4b749a58cc9188', 'male', 'Model Town.', '03225569112', '2018-10-17', '3410135552959', 'MS', 1, 0, 0, '2018-10-23 18:22:54', '0000-00-00 00:00:00', 0, 0, './uploaded_images/blured_sepia_copy.jpg'),
(11, 'hamza', 'ali', 'hamza.ali@gmail.com', '6bb99182a784ddd791dc5ffa4386ae60', '', '', '', '0000-00-00', '', '', 2, 0, 5, '2018-10-23 18:30:20', '2018-10-23 06:42:19', 0, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign key` (`program_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_information`
--
ALTER TABLE `family_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_info`
--
ALTER TABLE `fee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_pkg_history`
--
ALTER TABLE `fee_pkg_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_fee`
--
ALTER TABLE `paid_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previous_examination_types`
--
ALTER TABLE `previous_examination_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previous_institution_details`
--
ALTER TABLE `previous_institution_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `family_information`
--
ALTER TABLE `family_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fee_info`
--
ALTER TABLE `fee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fee_pkg_history`
--
ALTER TABLE `fee_pkg_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paid_fee`
--
ALTER TABLE `paid_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `previous_examination_types`
--
ALTER TABLE `previous_examination_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `previous_institution_details`
--
ALTER TABLE `previous_institution_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);

--
-- Constraints for table `student_status`
--
ALTER TABLE `student_status`
  ADD CONSTRAINT `student_status_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
