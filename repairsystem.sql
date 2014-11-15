-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2014 at 05:36 PM
-- Server version: 5.5.40-36.1
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `repairstatus`
--
CREATE DATABASE `repairstatus` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `repairstatus`;

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE IF NOT EXISTS `repairs` (
  `invid` int(11) NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `tech` text COLLATE utf8_unicode_ci NOT NULL,
  `rpdate` text COLLATE utf8_unicode_ci NOT NULL,
  `rptime` text COLLATE utf8_unicode_ci NOT NULL,
  `exdate` text COLLATE utf8_unicode_ci NOT NULL,
  `extime` text COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `delivertype` text COLLATE utf8_unicode_ci NOT NULL,
  `delivertime` text COLLATE utf8_unicode_ci NOT NULL,
  `pincode` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`invid`, `status`, `tech`, `rpdate`, `rptime`, `exdate`, `extime`, `comments`, `delivertype`, `delivertime`, `pincode`) VALUES
(12345, 'COMPLETED', '1759 J. DOE', '2014-11-03', '15:30', '', '', 'Virus Service recommended.', 'DELIVER TO CUSTOMER', '17:00', '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
