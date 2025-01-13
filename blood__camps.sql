-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 06:27 AM
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
-- Table structure for table `blood__camps`
--

CREATE TABLE `blood__camps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Donar_name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `hospital` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `blood_grp` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `is_success` varchar(1) DEFAULT NULL COMMENT 'S=Success,R=Reject,N=Not updated',
  `reason` varchar(255) DEFAULT NULL,
  `gainer` tinyint(1) NOT NULL DEFAULT 0,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood__camps`
--

INSERT INTO `blood__camps` (`id`, `Donar_name`, `mobile_no`, `address`, `hospital`, `gender`, `DOB`, `weight`, `product`, `blood_grp`, `occupation`, `reference`, `is_success`, `reason`, `gainer`, `is_delete`, `added_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'Pranay Test', '8652897550', 'Thane', NULL, 'M', '1998-08-17', '64', NULL, 'O+', 'Student 1', NULL, 'N', NULL, 0, 0, '1', '1', '2024-08-17 04:52:06', '2025-01-06 03:08:06'),
(2, 'Arjun', '7896545212', 'testet', NULL, 'M', '1999-05-17', '63', NULL, 'A-', 'Student', NULL, 'S', NULL, 0, 0, '1', '1', '2024-08-17 07:03:06', '2024-08-20 00:33:20'),
(3, 'Lohit', '7896545212', NULL, NULL, 'F', '1999-11-06', NULL, NULL, 'B+', NULL, NULL, 'S', NULL, 0, 0, '1', '1', '2024-08-17 07:20:05', '2024-08-19 00:12:53'),
(4, 'Lohit', '785452123', 'Thane', NULL, 'M', '2000-08-06', NULL, NULL, 'AB+', NULL, NULL, 'S', NULL, 0, 0, '1', '1', '2024-08-18 22:23:21', '2024-08-19 00:37:03'),
(5, 'Nishanr', '785452123', 'tretstet', NULL, 'M', '1996-11-11', NULL, NULL, NULL, NULL, NULL, 'R', NULL, 0, 0, '1', '1', '2024-08-18 22:23:41', '2024-08-19 01:16:09'),
(6, 'Amar', '7854521256', 'fga', NULL, 'F', '2000-01-16', NULL, NULL, 'B-', NULL, NULL, 'S', NULL, 0, 0, '1', '1', '2024-08-18 22:24:01', '2024-08-20 07:16:34'),
(7, 'Aadi', '785459652', 'tyfghgaysdh', NULL, 'M', NULL, NULL, NULL, 'AB-', NULL, NULL, 'N', NULL, 0, 1, '1', '1', '2024-08-18 22:24:19', '2024-08-19 01:15:59'),
(8, 'Testing', '1548797881', NULL, NULL, 'F', '1989-11-06', NULL, NULL, NULL, NULL, NULL, 'N', NULL, 0, 1, '1', '1', '2024-08-19 01:30:31', '2024-08-21 04:28:25'),
(9, 'Ram Kumar yadav', '8652897550', 'Sant Dnyaneshwar nagar wagle esate tahe', NULL, 'M', '1994-08-11', '65', NULL, 'O+', 'Bussiness', NULL, 'S', NULL, 0, 0, '1', '1', '2024-08-21 00:30:00', '2024-08-21 07:58:11'),
(10, 'Ankit', '7854565231', 'Sant Dnyaneshwar nagar wagle esate tahe', NULL, 'M', '2001-01-15', '63', NULL, 'AB+', NULL, NULL, 'S', NULL, 0, 0, '1', '1', '2024-08-21 04:27:02', '2025-01-06 04:31:24'),
(11, 'Mahavir', '7589564521', 'Testing', NULL, 'M', '2002-08-15', '85', NULL, NULL, NULL, NULL, 'N', NULL, 1, 1, '1', '1', '2024-08-22 01:44:30', '2024-09-24 02:30:30'),
(12, 'Test', '7854569854', NULL, 'Thane', 'M', NULL, NULL, 'csv 123', 'O+', NULL, 'sadsaf', NULL, NULL, 1, 1, '1', '1', '2024-08-29 01:04:25', '2024-09-24 02:30:28'),
(13, 'Test', '07854569854', NULL, NULL, 'M', '1968-05-06', NULL, NULL, 'O+', NULL, NULL, 'S', NULL, 0, 0, '1', NULL, '2024-08-29 01:35:46', '2024-08-29 01:35:46'),
(14, 'Arjun', '7896545213', NULL, 'Mukund', 'M', NULL, NULL, '2 PSV', 'A+', NULL, 'Pranay', NULL, NULL, 1, 1, '1', '1', '2024-08-30 08:02:27', '2024-09-24 02:30:23'),
(15, 'Nasreen Choudhary', '9967003978', NULL, 'Prime criticare hosp mumbra', 'M', '2024-09-04', NULL, 'B+ 2 bag FFP 2 bag', 'B+', NULL, NULL, NULL, NULL, 1, 0, '1', '1', '2024-09-24 02:33:11', '2024-09-24 02:46:53'),
(16, 'Ranjana Kadam', '9987303908', NULL, 'Wellam Hosp', 'F', '2024-09-05', NULL, 'A postive 4 bag FFP 2 bag', 'A+', NULL, NULL, NULL, NULL, 1, 0, '1', NULL, '2024-09-24 02:37:48', '2024-09-24 02:37:48'),
(17, 'Anita', '8879091075', NULL, 'Kem Hospital', 'F', '2024-09-08', NULL, 'A+ 2 bag', 'A+', NULL, NULL, NULL, NULL, 1, 0, '1', NULL, '2024-09-24 02:38:48', '2024-09-24 02:38:48'),
(18, 'Amit Suryawanshi', '9833459001', NULL, 'Lifecare hospital', 'M', '2024-09-15', NULL, 'A+ 3 bag', 'A+', NULL, NULL, NULL, NULL, 1, 0, '1', '1', '2024-09-24 02:39:43', '2024-09-24 02:40:02'),
(19, 'Deepak C', '9167606416', NULL, NULL, 'M', '2024-09-19', NULL, 'O+ 2 bag', 'O+', NULL, NULL, NULL, NULL, 1, 0, '1', NULL, '2024-09-24 02:41:19', '2024-09-24 02:41:19'),
(20, 'Chaya Jadhav', '9892290824', NULL, 'Pragati Hospital', 'F', '2024-09-19', NULL, 'A+ 1 bag', 'A+', NULL, NULL, NULL, NULL, 1, 0, '1', NULL, '2024-09-24 02:42:07', '2024-09-24 02:42:07'),
(21, 'Rekha Choudhary', '9702949105', NULL, 'Trupti Hospital', 'F', '2024-10-16', NULL, '3 bag', 'O+', NULL, NULL, NULL, NULL, 1, 0, '1', NULL, '2024-10-17 05:13:13', '2024-10-17 05:13:13'),
(22, 'Suraj mishra (Badrinath Jaiswar )', '9702661539', NULL, 'Kem  Hospital', 'M', '2024-11-03', NULL, '2 bag', 'B+', NULL, 'Pranay', NULL, NULL, 1, 0, '1', '1', '2024-11-11 03:01:06', '2024-11-11 03:04:44'),
(23, 'Sehzad', '9819625998', NULL, 'Matrix hospital', 'M', '2024-11-08', NULL, '1 bag , sdp 1 bag', 'O+', NULL, NULL, NULL, NULL, 1, 0, '1', NULL, '2024-11-11 03:02:34', '2024-11-11 03:02:34'),
(24, 'Pranay Test', '8652897550', 'Thane', NULL, 'M', '1998-08-17', '64', NULL, 'O+', 'Student123', NULL, 'S', NULL, 0, 0, '1', NULL, '2025-01-06 03:07:30', '2025-01-06 03:07:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood__camps`
--
ALTER TABLE `blood__camps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood__camps`
--
ALTER TABLE `blood__camps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
