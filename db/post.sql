-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2013 at 09:27 AM
-- Server version: 5.1.67
-- PHP Version: 5.3.2-1ubuntu4.19

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
  `date_posted` datetime NOT NULL,
  `post_title` varchar(500) NOT NULL,
  `text_post` varchar(3000) NOT NULL,
  `image_caption` varchar(500) NOT NULL,
  `image_post` varchar(100) NOT NULL,
  `quote_author` varchar(100) NOT NULL,
  `quote_post` varchar(1000) NOT NULL,
  `link_name` varchar(500) NOT NULL,
  `link_source` varchar(500) NOT NULL,
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_privacy` varchar(7) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=338 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`username`, `date_posted`, `post_title`, `text_post`, `image_caption`, `image_post`, `quote_author`, `quote_post`, `link_name`, `link_source`, `post_id`, `post_privacy`) VALUES
('rellizapasang', '2013-05-02 16:27:07', '', 'Sample Text', '', 'lala', '', '', '', '', 337, 'private');
