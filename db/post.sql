-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2013 at 06:34 AM
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
  `status` varchar(6) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=192 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`username`, `date_posted`, `post_content`, `post_type`, `post_id`, `status`) VALUES
('rellizapasang', '2013-04-25', '&quot;sadd&quot;-me', 'quote', 178, ''),
('rellizapasang', '2013-04-25', 'sdfsdf', 'link', 179, ''),
('rellizapasang', '2013-04-28', 'dasfdsdf', 'text', 183, 'like'),
('rellizapasang', '2013-04-28', 'dlfs;ldjfksdf', 'text', 184, 'like'),
('rellizapasang', '2013-04-28', 'dsf.dfs;''\r\ndfs', 'text', 185, 'like'),
('rellizapasang', '2013-04-28', 'dfsdfsdf', 'text', 186, 'like'),
('rellizapasang', '2013-04-28', 'sdas', 'text', 187, 'like'),
('rellizapasang', '2013-04-28', 'dads', 'text', 188, 'like'),
('rellizapasang', '2013-04-28', 'lks;lda;l', 'text', 189, 'like'),
('rellizapasang', '2013-04-28', '&quot;alskd;las&quot;-lksjldak', 'quote', 190, 'like'),
('rellizapasang', '2013-04-28', 'Untitled.png', 'image', 191, 'like');
