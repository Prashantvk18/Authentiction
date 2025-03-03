-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 03:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authentication`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticekt_trackers`
--

CREATE TABLE `ticekt_trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create_by` varchar(10) DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `assign_by` varchar(255) NOT NULL DEFAULT '0',
  `assign_to` varchar(255) NOT NULL DEFAULT '0',
  `assign_date` date DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'P',
  `is_delete` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticekt_trackers`
--

INSERT INTO `ticekt_trackers` (`id`, `create_by`, `subject`, `description`, `assign_by`, `assign_to`, `assign_date`, `submit_date`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '0', 'Tst', 'asdfasfdas', '1', '1', '2025-03-03', NULL, 'D', '0', '2025-03-03 06:12:31', '2025-03-03 06:12:31'),
(2, '0', 'Testihg', 'yes yes', '1', '2', '2025-03-03', NULL, 'D', '0', '2025-03-03 06:30:55', '2025-03-03 06:30:55'),
(3, '0', 'Home page', 'Create', '1', '1', '2025-03-03', NULL, 'P', '0', '2025-03-03 07:57:10', '2025-03-03 07:57:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticekt_trackers`
--
ALTER TABLE `ticekt_trackers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticekt_trackers`
--
ALTER TABLE `ticekt_trackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
