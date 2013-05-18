-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2013 at 08:54 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diary`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_content` varchar(300) NOT NULL,
  `status` varchar(8) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `like_table`
--

CREATE TABLE IF NOT EXISTS `like_table` (
  `post_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_table`
--

INSERT INTO `like_table` (`post_id`, `username`) VALUES
(0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mypeekers`
--

CREATE TABLE IF NOT EXISTS `mypeekers` (
  `username` varchar(100) DEFAULT NULL,
  `peekers` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mypeeks`
--

CREATE TABLE IF NOT EXISTS `mypeeks` (
  `username` varchar(100) DEFAULT NULL,
  `peeks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `username` varchar(50) NOT NULL,
  `date_posted` datetime NOT NULL,
  `paper_color` varchar(20) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=465 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email_add` varchar(100) NOT NULL,
  `profile_pic` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
