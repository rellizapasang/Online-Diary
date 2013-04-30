-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2013 at 06:19 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diary`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `username` varchar(50) NOT NULL,
  `date_posted` date NOT NULL,
  `post_content` varchar(3000) NOT NULL,
  `post_type` varchar(10) NOT NULL,
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_privacy` varchar(7) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`username`, `date_posted`, `post_content`, `post_type`, `post_id`, `post_privacy`) VALUES
('AthanPandi', '2013-04-30', 'PUBLIC POST', 'text', 230, 'public'),
('AthanPandi', '2013-04-30', 'SECRET POST', 'text', 229, 'private');
