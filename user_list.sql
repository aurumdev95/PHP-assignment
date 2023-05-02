-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 10:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, '', '', 'admin@gmail.com', '$2y$10$HL0hEHr73WMcaknVN53g0eASt.tmZBC7LDUmkHHy7OwfAXiAI5n9e'),
(5, 'admin', 'Ishimwe Mugisha', 'admin2@gmail.com', '$2y$10$eXGIdJMmlozcSZI55SkUWeF0CbT7Fz35bhdCXSLJAZIX/0yVPEqdG'),
(6, 'admin', 'Ishimwe Mugisha', 'admin@example.com', '$2y$10$Qphng4fyi7rzPD9vYobzBu4n3612sxug2JRW7XYTl3a0cHYrE6nIa'),
(7, 'asxasxsaxasx', 'Ishimwe Mugisha', 'admin111@example.com', '$2y$10$J8ha2OaeM599Iazk3h4e5.Zm4lGCMkhnzHUjpsZ6hl/1pp7rDvWa6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `gender`, `password`, `first_name`, `last_name`) VALUES
(10, 'kalijmv@gmail.com', '0788564321', 'male', '$2y$10$eZwMOjDlvj1FbamgAxZztu8h9zbJ3zCrHH4bYewt13VPAUoYgFKx6', 'Kalisa', 'JMV'),
(11, 'jeandam@gmail.com', '0743412133', 'male', '$2y$10$MGVO1grbSosDcUPYthrc.Ozc3tFKsEymJrYwCNupeC/q0/zzBhoyS', 'jean', 'damour');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
