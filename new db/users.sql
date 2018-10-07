-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2018 at 04:26 AM
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
(3, 'Ali', 'Hamza', 'alihamza446014@gmail.com', '9b7141a49138bf8291db51cc6ee158d6', 'male', 'Shaheenabad, Gujranwala,', '03059042500', '1997-05-04', '3410122179850', 'F.Sc', 0, 2, 2, '2018-09-14 04:11:12', '2018-09-18 00:02:02', 0, 1, './uploaded_images/3112.jpg'),
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
