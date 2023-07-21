-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2022 at 07:33 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nursery_mgt_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `color` varchar(100) NOT NULL,
  `text_color` varchar(100) NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `image`, `color`, `text_color`, `icon`) VALUES
(1, 'Bank Islam', 'Bank-Islam.png', '#C70B46', 'white', 'unnamed.png'),
(2, 'CIMB', 'R.jpg', '#EC1F25', 'white', 'CIMB-512.webp'),
(3, 'BSN', 'BSN-New-Logo.jpg', '#009CBB', 'white', 'unnamed.jpg'),
(4, 'Mybank', 'Maybank-Logo.jpg', '#FFC700', 'black', 'R (2).jpg'),
(5, 'Bank Rakyat', 'OIP.jpg', '#0072BB', 'white', 'R (3).jpg'),
(6, 'AmBank', 'R (1).jpg', '#DF132C', 'white', 'ambank.png'),
(7, 'Hong Leong Bank', 'R.png', '#0C2D83', 'white', 'hong-leong-bank-logo-250x250.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
