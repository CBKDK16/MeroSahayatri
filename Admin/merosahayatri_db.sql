-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 04:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merosahayatri_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `PASSWORD` varchar(200) DEFAULT NULL,
  `gender` char(4) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `username`, `email`, `PASSWORD`, `gender`, `country`, `phone`, `image`) VALUES
('manish', 'manishkha', 'manish@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'nepal', 2147483647, 'IMG-62b6c20a933804.52787208.jpg'),
('manish', 'manishkhad', 'manish@gmail.com', '392cbd9d8a28cf9', 'M', 'nepal', 2147483647, 'IMG-62b4cf384abfb8.28680750.jpg'),
('manish', 'qwertyuio', 'manish@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'nepal', 2147483647, 'IMG-62b4d0c5537ee4.53724857.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `checkpoint_tbl`
--

CREATE TABLE `checkpoint_tbl` (
  `CHECKPOINT_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkpoint_tbl`
--

INSERT INTO `checkpoint_tbl` (`CHECKPOINT_id`, `route_id`, `location_id`) VALUES
(37, 13, 187),
(38, 13, 184),
(39, 13, 200),
(40, 14, 184),
(41, 14, 187),
(42, 14, 200);

-- --------------------------------------------------------

--
-- Table structure for table `location_tbl`
--

CREATE TABLE `location_tbl` (
  `Location_id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Latitude` varchar(100) DEFAULT NULL,
  `Longitute` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_tbl`
--

INSERT INTO `location_tbl` (`Location_id`, `Name`, `Latitude`, `Longitute`) VALUES
(184, 'Chapagau', '3', '3'),
(187, 'lagankhel', '', '45.25896'),
(200, 'koteshwor', '27.6644011', '98,90');

-- --------------------------------------------------------

--
-- Table structure for table `routes_tbl`
--

CREATE TABLE `routes_tbl` (
  `Route_id` int(11) NOT NULL,
  `Vehicle_id` int(11) DEFAULT NULL,
  `From_id` int(11) DEFAULT NULL,
  `To_id` int(11) DEFAULT NULL,
  `Distance` decimal(10,2) DEFAULT NULL,
  `Duration` varchar(100) DEFAULT NULL,
  `Fare` int(11) DEFAULT NULL,
  `Available` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routes_tbl`
--

INSERT INTO `routes_tbl` (`Route_id`, `Vehicle_id`, `From_id`, `To_id`, `Distance`, `Duration`, `Fare`, `Available`) VALUES
(13, 1, 184, 187, NULL, '30min', 50, '6am7pm'),
(14, 3, 184, 200, NULL, '30min', 50, '6am7pm');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `gender` char(4) NOT NULL,
  `country` varchar(25) NOT NULL,
  `phone` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `PASSWORD`, `gender`, `country`, `phone`, `image`, `status`) VALUES
(1, 'manish', 'manishkha', 'manish@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'nepal', 2147483647, 'IMG-62b71042081434.44617458.jpg', 0),
(2, 'manish', 'manishkhad', 'manish@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'nepal', 2147483647, 'IMG-62b710695839a9.72585774.jpg', 0),
(3, 'Sajha', 'ramkrishna', 'manish@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'india', 2147483647, 'IMG-62b7121f14ef17.52323846.jpg', 0),
(9, 'manishkhadkaa', 'qwertyuio', 'domainapple123@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'china', 2147483647, 'IMG-62b7133c5e0d16.16027695.jpg', 1),
(10, 'manishkhadkaa', 'asdfghjkl', 'domainapple123@gmail.com', '392cbd9d8a28cf9be1a9941e55e650f2', 'M', 'india', 2147483647, 'IMG-62b71465ab87b1.95256885.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(16) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `status`) VALUES
('o', 'o', 'o', 1),
('l', 'l', 'l', 0),
('k', 'k', 'k', 1),
('e', 'e', 'e', 0),
('', '', '', 1),
('j', 'j', 'j', 0),
('man', 'man', 'man', 0),
('bibek', 'bibek', 'bibek', 1),
('ram', 'ram', 'ram', 0),
('p', 'p', 'p', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `username`, `email`, `password`, `status`) VALUES
(1, 'manish', 'manish', 'manish', 0),
(2, 'anish', 'anish', 'anish', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype_tbl`
--

CREATE TABLE `vehicletype_tbl` (
  `Vehicle_id` int(11) NOT NULL,
  `Type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicletype_tbl`
--

INSERT INTO `vehicletype_tbl` (`Vehicle_id`, `Type`) VALUES
(1, 'micro'),
(2, 'bus'),
(3, 'Tampo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `checkpoint_tbl`
--
ALTER TABLE `checkpoint_tbl`
  ADD PRIMARY KEY (`CHECKPOINT_id`),
  ADD KEY `fk_route` (`route_id`),
  ADD KEY `fk_location` (`location_id`);

--
-- Indexes for table `location_tbl`
--
ALTER TABLE `location_tbl`
  ADD PRIMARY KEY (`Location_id`);

--
-- Indexes for table `routes_tbl`
--
ALTER TABLE `routes_tbl`
  ADD PRIMARY KEY (`Route_id`),
  ADD KEY `fk_vehicle` (`Vehicle_id`),
  ADD KEY `fk_fromlocation` (`From_id`),
  ADD KEY `fk_tolocation` (`To_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicletype_tbl`
--
ALTER TABLE `vehicletype_tbl`
  ADD PRIMARY KEY (`Vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkpoint_tbl`
--
ALTER TABLE `checkpoint_tbl`
  MODIFY `CHECKPOINT_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `location_tbl`
--
ALTER TABLE `location_tbl`
  MODIFY `Location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `routes_tbl`
--
ALTER TABLE `routes_tbl`
  MODIFY `Route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicletype_tbl`
--
ALTER TABLE `vehicletype_tbl`
  MODIFY `Vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkpoint_tbl`
--
ALTER TABLE `checkpoint_tbl`
  ADD CONSTRAINT `fk_location` FOREIGN KEY (`location_id`) REFERENCES `location_tbl` (`Location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `routes_tbl` (`Route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `routes_tbl`
--
ALTER TABLE `routes_tbl`
  ADD CONSTRAINT `fk_fromlocation` FOREIGN KEY (`From_id`) REFERENCES `location_tbl` (`Location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tolocation` FOREIGN KEY (`To_id`) REFERENCES `location_tbl` (`Location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehicle` FOREIGN KEY (`Vehicle_id`) REFERENCES `vehicletype_tbl` (`Vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
