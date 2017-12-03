-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2017 at 06:48 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projector`
--
CREATE DATABASE IF NOT EXISTS `projector` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projector`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `username`, `password`, `created`) VALUES
(1, 'admin', 'r40tXLqSv9m/peVnAhDM+o7JSqE0qbz7S04PNk3qTi4=', '2017-07-01 04:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `projector`
--

CREATE TABLE `projector` (
  `bookid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bookdate` date NOT NULL,
  `bookday` varchar(10) NOT NULL,
  `hour1` varchar(50) NOT NULL,
  `hour2` varchar(50) NOT NULL,
  `hour3` varchar(50) NOT NULL,
  `hour4` varchar(50) NOT NULL,
  `hour5` varchar(50) NOT NULL,
  `hour6` varchar(50) NOT NULL,
  `hour7` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seminarhall`
--

CREATE TABLE `seminarhall` (
  `bookid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bookdate` date NOT NULL,
  `bookday` varchar(10) NOT NULL,
  `hour1` varchar(50) NOT NULL,
  `hour2` varchar(50) NOT NULL,
  `hour3` varchar(50) NOT NULL,
  `hour4` varchar(50) NOT NULL,
  `hour5` varchar(50) NOT NULL,
  `hour6` varchar(50) NOT NULL,
  `hour7` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `staffid` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `Name`, `email`, `username`, `password`, `staffid`, `created`) VALUES
(1, 'Matheswaaran', 'mat@mat.com', 'mat', 'r40tXLqSv9m/peVnAhDM+o7JSqE0qbz7S04PNk3qTi4=', '123', '2016-09-26 17:40:23'),
(2, 'Rockin', 'rockin@mat.com', 'rockin', 'r40tXLqSv9m/peVnAhDM+o7JSqE0qbz7S04PNk3qTi4=', '9213', '2016-09-27 07:53:26'),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;