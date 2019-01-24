-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2019 at 09:40 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(20) NOT NULL,
  `isbn` varchar(12) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `year` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `publisher`, `year`, `price`) VALUES
(1, 'Java Programming', 'Bloggs', '123456789012', 'Java Press', 2011, '21.98'),
(2, 'PHP Programming', 'Hughes', '234567890123', 'PHP Press', 2009, '19.99'),
(3, 'JavaScript Programming', 'Jones', '345678901234', 'JS Press', 2010, '23.00'),
(4, 'Game Programming', 'Kelly', '456789012345', 'Game Press', 2006, '33.99'),
(5, 'Android Game Programming', 'Jones', '098765432109', 'Big Game Books', 2012, '12.99'),
(6, 'iOS Game Programming', 'Kavanagh', '098765432109', 'Garage Software', 2012, '56.99');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
