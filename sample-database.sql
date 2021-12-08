-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 09:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(220) NOT NULL,
  `author_surname` varchar(220) NOT NULL,
  `author_rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `author_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `author_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `author_surname`, `author_rating`, `author_updated`, `author_created`) VALUES
(1, 'Brian', 'Klaas', '2.54', '2021-12-08 22:23:07', '2021-12-08 22:23:07'),
(2, 'Augustine', 'Sedgewick', '3.21', '2021-12-08 22:23:07', '2021-12-08 22:23:07'),
(3, 'Jenn', 'Lim', '2.30', '2021-12-08 22:23:45', '2021-12-08 22:23:45'),
(4, 'Nadia', 'Wassef', '1.12', '2021-12-08 22:23:45', '2021-12-08 22:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(550) NOT NULL,
  `book_image` varchar(110) NOT NULL,
  `book_author_id` int(11) NOT NULL,
  `book_ISBN` varchar(17) NOT NULL COMMENT 'This 10 or 13-digit number identifies a specific book. Maximum 17 Chars with dashes',
  `book_created` datetime NOT NULL DEFAULT current_timestamp(),
  `book_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `book_remove_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `book_image`, `book_author_id`, `book_ISBN`, `book_created`, `book_updated`, `book_remove_status`) VALUES
(1, 'Corruptible: Who Gets Power and How It Changes Us', 'book1.jpg', 1, '978-0-3777-1416-8', '2021-12-08 22:24:55', '2021-12-08 22:24:55', 0),
(2, 'Coffeeland: One Man\'s Dark Empire and the Making of Our Favorite Drug', 'book2.jpg', 2, '978-0-3777-1416-9', '2021-12-08 22:24:55', '2021-12-08 22:24:55', 1),
(3, 'Beyond Happiness: How Authentic Leaders Prioritize Purpose', 'book3.jpg', 3, '978-0-3777-1416-1', '2021-12-08 22:25:23', '2021-12-08 22:25:23', 0),
(4, 'Shelf Life: Chronicles of a Cairo Bookseller', 'book4.jpg', 4, '978-0-1976-6486-2', '2021-12-08 22:25:23', '2021-12-08 22:25:23', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
