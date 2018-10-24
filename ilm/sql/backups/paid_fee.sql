-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2018 at 07:57 PM
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
-- Table structure for table `paid_fee`
--

CREATE TABLE `paid_fee` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `programId` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `installment_no` int(11) NOT NULL,
  `fee_amount` decimal(13,2) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0= unpaid, 1 = paid',
  `installment_date` date NOT NULL,
  `pay_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = not_deleted, 1 = soft_deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paid_fee`
--

INSERT INTO `paid_fee` (`id`, `enrollment_id`, `programId`, `classId`, `installment_no`, `fee_amount`, `status`, `installment_date`, `pay_date`, `created_by`, `edited_by`, `delete_status`) VALUES
(1, 1, 1, 1, 1, '22000.00', 1, '2018-09-25', '2018-09-25 20:39:23', 0, 0, 0),
(19, 2, 1, 1, 1, '1000.00', 1, '2018-09-26', '2018-09-26 18:47:22', 2, 2, 1),
(20, 2, 1, 1, 2, '2000.00', 1, '2018-10-05', '0000-00-00 00:00:00', 2, 2, 1),
(21, 2, 1, 1, 3, '1340.00', 0, '2018-10-05', '0000-00-00 00:00:00', 2, 2, 1),
(22, 2, 1, 1, 4, '1330.00', 0, '2018-10-15', '0000-00-00 00:00:00', 2, 2, 1),
(23, 2, 1, 1, 5, '1330.00', 0, '2018-10-25', '0000-00-00 00:00:00', 2, 2, 1),
(24, 2, 1, 1, 1, '1000.00', 1, '2018-09-26', '2018-09-26 18:54:14', 2, 0, 0),
(25, 2, 1, 1, 2, '2000.00', 1, '2018-10-05', '0000-00-00 00:00:00', 2, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paid_fee`
--
ALTER TABLE `paid_fee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paid_fee`
--
ALTER TABLE `paid_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
