-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2017 at 10:31 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nzowasco`
--

-- --------------------------------------------------------

--
-- Table structure for table `readings`
--

CREATE TABLE IF NOT EXISTS `readings` (
  `seq` double NOT NULL AUTO_INCREMENT,
  `billid` double NOT NULL,
  `yr` int(4) NOT NULL,
  `mon` int(2) NOT NULL,
  `cread` int(8) DEFAULT NULL,
  `pread` int(8) DEFAULT NULL,
  `cons` int(8) NOT NULL,
  `typ` varchar(10) NOT NULL,
  `accno` varchar(12) NOT NULL,
  `reg` varchar(12) NOT NULL,
  `tim` time NOT NULL,
  `dat` date NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=536878 ;
