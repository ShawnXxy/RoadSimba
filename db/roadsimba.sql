-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2018 at 02:48 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roadsimba`
--

-- --------------------------------------------------------

--
-- Table structure for table `dispcarr`
--

CREATE TABLE `dispcarr` (
  `dc_ID` int(11) NOT NULL,
  `dispatcher_ID` int(11) NOT NULL,
  `carrier_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispcarr`
--

INSERT INTO `dispcarr` (`dc_ID`, `dispatcher_ID`, `carrier_ID`) VALUES
(11, 1, 37);

-- --------------------------------------------------------

--
-- Table structure for table `loads`
--

CREATE TABLE `loads` (
  `load_ID` int(11) NOT NULL,
  `post_by_ID` int(11) NOT NULL,
  `date_post` int(11) NOT NULL,
  `date_exp` int(11) NOT NULL,
  `date_pickup` int(11) NOT NULL,
  `date_delivery` int(11) NOT NULL,
  `addr_pickup` varchar(255) NOT NULL,
  `city_pickup` varchar(11) NOT NULL,
  `state_pickup` varchar(11) NOT NULL,
  `zip_pickup` varchar(11) NOT NULL,
  `country_pickup` int(8) DEFAULT NULL,
  `addr_delivery` varchar(255) NOT NULL,
  `city_delivery` varchar(11) NOT NULL,
  `state_delivery` varchar(11) NOT NULL,
  `zip_delivery` varchar(11) NOT NULL,
  `country_delivery` int(8) DEFAULT NULL,
  `load_type` int(8) NOT NULL,
  `vehicle_size` int(8) NOT NULL,
  `miles` int(8) NOT NULL,
  `pieces` int(8) NOT NULL,
  `load_weight` int(8) NOT NULL,
  `budget` int(8) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loads`
--

INSERT INTO `loads` (`load_ID`, `post_by_ID`, `date_post`, `date_exp`, `date_pickup`, `date_delivery`, `addr_pickup`, `city_pickup`, `state_pickup`, `zip_pickup`, `country_pickup`, `addr_delivery`, `city_delivery`, `state_delivery`, `zip_delivery`, `country_delivery`, `load_type`, `vehicle_size`, `miles`, `pieces`, `load_weight`, `budget`, `note`) VALUES
(2, 1, 1535716800, 1535716800, 1526040000, 1535716800, '600 PARK', 'HAYS', 'Kansas', '67601', NULL, '715 MONTANA ST', 'MONROVIA', 'CA', '91016', NULL, 0, 123, 2000, 123, 123, 99999, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `load_ID` int(11) NOT NULL,
  `dispatcher_ID` int(11) NOT NULL,
  `carrier_ID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(8) NOT NULL,
  `vehicle_ID` int(11) DEFAULT NULL,
  `note` text,
  `date_updated` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstname` varchar(48) NOT NULL,
  `lastname` varchar(48) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `role` int(3) NOT NULL,
  `mc_num` varchar(15) NOT NULL,
  `date_registration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `email`, `password`, `firstname`, `lastname`, `phone`, `role`, `mc_num`, `date_registration`) VALUES
(1, 'shawnxxy@hotmail.com', 'f43093d060058b338ab9c8e07aad78ae', 'X', 'X', '123456789', 1, '', 1524438057),
(2, 'x_xiao2_bnu@mail.fhsu.edu', 'f43093d060058b338ab9c8e07aad78ae', 'Shawn', 'Xx', '7854982948', 2, '', 1524446147),
(4, 'admin@admin', 'f43093d060058b338ab9c8e07aad78ae', 'Admin', 'Admin', '1234567890', 0, '', 1524450661),
(37, 'fleet@fleet', '', 'test', 'test', '7854989248', 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `v_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `size` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`v_ID`, `user_ID`, `size`) VALUES
(3, 37, 123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dispcarr`
--
ALTER TABLE `dispcarr`
  ADD PRIMARY KEY (`dc_ID`);

--
-- Indexes for table `loads`
--
ALTER TABLE `loads`
  ADD PRIMARY KEY (`load_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`v_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispcarr`
--
ALTER TABLE `dispcarr`
  MODIFY `dc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `load_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `v_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
