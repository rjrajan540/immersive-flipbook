-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 08:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `immersive-flipbook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_pages`
--

CREATE TABLE `book_pages` (
  `id` int(11) NOT NULL,
  `page_no` int(11) NOT NULL,
  `content_type` varchar(50) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `file_src` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_pages`
--

INSERT INTO `book_pages` (`id`, `page_no`, `content_type`, `title`, `file_src`, `duration`, `active`, `created_on`) VALUES
(1, 10, 'text', 'This is test file to upload', 'phy-1.txt', 6, 1, '2025-08-02 16:57:34'),
(2, 18, 'video', 'This is also test file for video', 'vid-3.mp4', 10, 1, '2025-08-02 17:01:07'),
(3, 36, 'image', 'This  is image file', '4.jfif', 6, 1, '2025-08-02 17:02:10'),
(4, 999, 'video', 'This is another test file of video', 'vid-2.mp4', 4, 1, '2025-08-02 17:02:45'),
(5, 1, 'text', 'Test for ayush', 'multilang-2.txt', 5, 1, '2025-08-02 17:06:34'),
(6, 2, 'image', 'Test two for ayush', '3.jfif', 7, 1, '2025-08-02 17:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_trigger`
--

CREATE TABLE `user_trigger` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `page_range` varchar(50) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_trigger`
--

INSERT INTO `user_trigger` (`id`, `session_id`, `page_range`, `page_id`, `created_on`) VALUES
(1, '0026', '10', 10, '2025-08-02 17:00:11'),
(2, '0027', '10-18', 10, '2025-08-02 17:01:12'),
(3, '0028', '10-18', 10, '2025-08-02 17:02:59'),
(4, '0028', '36-999', 36, '2025-08-02 17:03:05'),
(5, '0029', '10-18', 10, '2025-08-02 17:04:04'),
(6, '0029', '36-999', 36, '2025-08-02 17:04:22'),
(7, '0030', '1-2', 1, '2025-08-02 17:07:48'),
(8, '0030', '10-18', 10, '2025-08-02 17:08:00'),
(9, '0031', '36-999', 36, '2025-08-02 17:08:16'),
(10, '0032', '1-2', 1, '2025-08-02 17:09:22'),
(11, '0032', '10-18', 10, '2025-08-02 17:09:27'),
(12, '0032', '36-999', 36, '2025-08-02 17:09:29'),
(13, '0032', '10-18', 10, '2025-08-02 17:09:31'),
(14, '0032', '1-2', 1, '2025-08-02 17:09:32'),
(15, '0032', '10-18', 10, '2025-08-02 17:09:37'),
(16, '0032', '1-2', 1, '2025-08-02 17:09:39'),
(17, '0033', '10-18', 10, '2025-08-02 17:09:45'),
(18, '0033', '1-2', 1, '2025-08-02 17:09:47'),
(19, '0033', '10-18', 10, '2025-08-02 17:09:59'),
(20, '0034', '36-999', 36, '2025-08-02 17:10:15'),
(21, '0035', '1-2', 1, '2025-08-02 17:13:58'),
(22, '0035', '10-18', 10, '2025-08-02 17:14:09'),
(23, '0035', '36-999', 36, '2025-08-02 17:14:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_pages`
--
ALTER TABLE `book_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_trigger`
--
ALTER TABLE `user_trigger`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_pages`
--
ALTER TABLE `book_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
