-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 03:09 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
(1, 1, 'GRW', 'GRW', 'Pakistan', ' Shaheenabad', 0),
(2, 1, 'Sawat', 'KPK', 'Pakistan', ' Gul Gushat Colony', 1),
(3, 2, 'dummy', 'dummy', 'Pakistan', ' dummy', 0),
(4, 2, 'dummy', 'dummy', 'Pakistan', ' dummy', 1);

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
(2, 'part-II', 3),
(4, 'part-I', 4),
(6, 'part-I', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `enrollment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `study_medium` int(11) NOT NULL,
  `roll_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `enrollment_date`, `class_id`, `section_id`, `study_medium`, `roll_no`) VALUES
(1, '2018-09-08 00:00:00', 1, 1, 1, '1'),
(2, '2018-09-08 00:00:00', 2, 2, 1, '22');

-- --------------------------------------------------------

--
-- Table structure for table `family_information`
--

CREATE TABLE `family_information` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
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

INSERT INTO `family_information` (`id`, `enrollment_id`, `guardian`, `first_name`, `last_name`, `profession`, `designation`, `organization_name`, `office_address`, `telephone`, `mobile_no`, `email`) VALUES
(1, 1, 0, 'Muhammad', 'Arshad', 'profession', 'Designation', 'VNext', 'GRW', '123456', '03059042500', 'email@gmail.com'),
(2, 2, 1, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', '123', '123', 'dummy');

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
  `grand_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_info`
--

INSERT INTO `fee_info` (`id`, `enrollment_id`, `adm_fee`, `fee_package`, `tuition_fee`, `boardUniReg_fee`, `library_fee`, `miscellaneous_fee`, `others`, `total_fee`, `grand_total`) VALUES
(1, 1, 4000, 11000, 24000, 2000, 2000, 2000, 2000, 47000, 47000),
(2, 2, 1000, 1000, 1000, 1000, 1000, 1000, 1000, 7000, 7000);

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
  `caste` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `enrollment_id`, `first_name`, `last_name`, `gender`, `dob`, `religion`, `blood_group`, `caste`) VALUES
(1, 1, 'Ali', 'Hamza', 1, '0000-00-00', 1, '4', 'Mughal'),
(2, 2, 'dummy', 'dummy', 2, '0000-00-00', 1, '7', 'dummy');

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
(1, 1, '1', 2014, '446014', 'BISE GRW', 927, 1100, 'A', 'Physics, Chemistry, Math, Bio', 'Govt. Public High School, GRW'),
(2, 1, '2', 2016, '321760', 'BISE GRW', 864, 1100, 'A', 'Physics, Chemistry, Math', 'Superior Science College, grw'),
(3, 2, '2', 2016, '256845', 'GRW', 888, 1100, 'B', 'Phy, Chem, Bio', 'Dummy Name'),
(4, 2, '3', 2018, '558942', 'GRW Board', 600, 900, 'B', 'English, Journalism', 'University of Punjab');

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
(2, 'Zeeshan', 'Ahmad', 'Zeeshan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Shaheenabad, Gujranwala', '03086440945', '2018-09-18', '341015017985', 'F.Sc', 0, 2, 3, '2018-09-13 04:11:12', '2018-09-19 05:59:12', 0, 1, './uploaded_images/3111.jpg'),
(3, 'Ali', 'Hamza', 'alihamza446014@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Shaheenabad, Gujranwala,', '03059042500', '1997-05-04', '3410122179850', 'F.Sc', 0, 2, 2, '2018-09-14 04:11:12', '2018-09-18 00:02:02', 0, 1, './uploaded_images/3112.jpg'),
(4, 'Hafiz', 'Waseem', 'waseem@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Vnext solution gujranwala', '030356842', '2018-09-12', '34101257481', 'F.A', 2, 5, 5, '2018-09-15 04:11:12', '2018-09-18 00:09:30', 0, 0, './uploaded_images/32.jpg'),
(5, 'Asad', 'ullah', 'king.master127@gmail.com', 'f5de9352cba612589e4b749a58cc9188', 'male', 'Model Town, Gujranwala', '03053020152', '1997-09-10', '34101564513', 'B.A', 0, 3, 3, '2018-09-13 04:11:12', '2018-09-19 05:59:23', 1, 1, './uploaded_images/815.jpg'),
(6, 'Muzammal', 'Ali', 'muzammal@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'Rustam Kotli, Gujranwala', '03086440945', '2018-09-04', '34101257481', 'B.Sc', 2, 5, 5, '2018-09-18 04:11:12', '2018-09-19 06:00:10', 0, 0, './uploaded_images/index21.jpg'),
(7, 'hhfs', 'shfdsgsf', 'gfsgsgf@gmil.com', '123456', 'female', 'fgfgs', '15252554', '2018-09-19', 'y575765', 'hfdg', 2, 2, 2, '2018-09-18 04:11:12', '2018-09-19 05:59:33', 0, 0, ''),
(8, 'Awais', 'Ali', 'awais@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'fdsjhhdahfjhagf', '03006440956', '2018-08-28', '3410122179850', 'B.Sc', 1, 5, 3, '2018-09-18 12:24:46', '2018-09-19 05:59:29', 0, 0, './uploaded_images/3110.jpg'),
(9, 'fhgfdhg', 'fhggfdhd', 'hggfdhgfh@gmil.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0000-00-00', '', '', 2, 3, 0, '2018-09-19 06:02:49', '0000-00-00 00:00:00', 0, 0, '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `previous_institution_details`
--
ALTER TABLE `previous_institution_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
