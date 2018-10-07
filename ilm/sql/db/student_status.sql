-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2018 at 04:21 AM
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

--
-- Dumping data for table `student_status`
--

INSERT INTO `student_status` (`id`, `enrollment_id`, `reason`, `status_id`, `created_at`, `created_by`, `is_active`) VALUES
(1, 1, 'This is dummy text', 2, '2018-09-11', 0, 1),
(2, 1, 'This is dummy text 2', 3, '2018-10-14', 0, 1),
(3, 1, 'This is dummy text 3', 2, '2018-11-18', 0, 1),
(4, 1, 'This is dummy text 4', 2, '2018-09-25', 0, 1),
(5, 1, 'This is dummy text 5', 3, '2019-01-16', 0, 1),
(6, 1, 'This is dummy text 6', 2, '2018-06-04', 0, 1),
(7, 3, 'This is dummy text 7', 3, '2018-09-11', 0, 1),
(8, 3, 'This is dummy text 8', 3, '2018-12-22', 0, 1),
(17, 1, 'the student is leave now', 2, '2018-09-28', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_status`
--
ALTER TABLE `student_status`
  ADD CONSTRAINT `student_status_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
