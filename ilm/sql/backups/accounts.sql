-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2018 at 03:03 AM
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

INSERT INTO `accounts` (`id`, `account_name`, `account_type`, `description`, `parent_id`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_active`) VALUES
(1, 'Expense', 1, 'dummy description', 0, '2018-09-17 19:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(2, 'Revenue', 0, '', 1, '2018-09-28 19:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(3, 'dummy', 1, 'dummy description', 0, '2018-09-28 19:00:00', 2, '0000-00-00 00:00:00', 0, 0),
(4, 'temp', 1, 'temp account', 2, '2018-10-08 22:37:00', 0, '2018-10-08 22:37:00', 0, 0),
(5, 'temp 2', 0, 'temp 2 account', 1, '2018-10-08 22:37:28', 0, '2018-10-08 22:37:28', 0, 0),
(6, 'hello world', 1, 'descr', 1, '2018-10-10 00:47:09', 5, '2018-10-10 00:47:09', 0, 0),
(7, 'cash', 0, 'descr', 2, '2018-10-10 00:59:09', 5, '2018-10-10 00:59:09', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
