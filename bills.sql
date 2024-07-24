-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 09:36 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bills`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'chukschibyke92@gmail.com', '07d5c105cc69826a68e230dff76f4b85a6da591c');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `createddate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `userid`, `ref`, `package`, `amount`, `createddate`) VALUES
(1, '1', '4455yyhu7yddd', 'GOTV Joli', '4800', '2024-07-23 21:53:08'),
(2, '1', 'dsjjs7s77734h4h4h', 'MTN Data', '1200', '2024-07-23 21:53:08'),
(3, '2', 'yyd6d6s6s6s6ss', 'Startimes', '4600', '2024-07-23 21:53:08'),
(4, '2', '884u4u484848rur', 'DSTV 32', '11000', '2024-07-23 21:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actbal` double NOT NULL DEFAULT '0',
  `rflink` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `createddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `uname`, `email`, `phone`, `password`, `actbal`, `rflink`, `active`, `createddate`) VALUES
(1, 'Chucky', 'Cheese', 'Chuckycheese', 'chukschibyke92@gmail.com', '+2348162216532', '07d5c105cc69826a68e230dff76f4b85a6da591c', 40, 'https://www.YuzTech.com/register?ref=1320259870', 1, '2024-07-23 21:53:08'),
(2, 'Zlatan', 'Kit', 'Kit', 'kit@gmail.com', '0902727626', '07d5c105cc69826a68e230dff76f4b85a6da591c', 0, 'https://www.YuzTech.com/register?ref=3031531064', 1, '2024-07-24 18:26:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
