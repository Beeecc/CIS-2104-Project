-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 09:03 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_t`
--

CREATE TABLE `admin_t` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(24) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `apartment_t`
--

CREATE TABLE `apartment_t` (
  `apartment_no` int(11) NOT NULL,
  `rental_fee` decimal(10,2) NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_t`
--

CREATE TABLE `complaint_t` (
  `complaint_id` int(11) NOT NULL,
  `date_received` datetime NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `tenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manager_t`
--

CREATE TABLE `manager_t` (
  `manager_id` int(11) NOT NULL,
  `fname` varchar(24) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_t`
--

CREATE TABLE `payment_t` (
  `tenant_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('online payment','check','cash') NOT NULL,
  `date_paid` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `repairman_t`
--

CREATE TABLE `repairman_t` (
  `repairman_id` int(11) NOT NULL,
  `fname` varchar(24) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `schedule` datetime NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_t`
--

CREATE TABLE `tenant_t` (
  `tenant_id` int(11) NOT NULL,
  `fname` varchar(24) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `apartment_no` int(11) NOT NULL,
  `contract_start` date NOT NULL,
  `contract_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_t`
--
ALTER TABLE `admin_t`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `apartment_t`
--
ALTER TABLE `apartment_t`
  ADD PRIMARY KEY (`apartment_no`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `complaint_t`
--
ALTER TABLE `complaint_t`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `manager_t`
--
ALTER TABLE `manager_t`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `payment_t`
--
ALTER TABLE `payment_t`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `repairman_t`
--
ALTER TABLE `repairman_t`
  ADD PRIMARY KEY (`repairman_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `tenant_t`
--
ALTER TABLE `tenant_t`
  ADD PRIMARY KEY (`tenant_id`),
  ADD KEY `apartment_no` (`apartment_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_t`
--
ALTER TABLE `admin_t`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apartment_t`
--
ALTER TABLE `apartment_t`
  MODIFY `apartment_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_t`
--
ALTER TABLE `complaint_t`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager_t`
--
ALTER TABLE `manager_t`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_t`
--
ALTER TABLE `payment_t`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repairman_t`
--
ALTER TABLE `repairman_t`
  MODIFY `repairman_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenant_t`
--
ALTER TABLE `tenant_t`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_t`
--
ALTER TABLE `admin_t`
  ADD CONSTRAINT `adminFK1` FOREIGN KEY (`manager_id`) REFERENCES `manager_t` (`manager_id`);

--
-- Constraints for table `apartment_t`
--
ALTER TABLE `apartment_t`
  ADD CONSTRAINT `apartmentFK1` FOREIGN KEY (`manager_id`) REFERENCES `manager_t` (`manager_id`);

--
-- Constraints for table `complaint_t`
--
ALTER TABLE `complaint_t`
  ADD CONSTRAINT `complaintFK1` FOREIGN KEY (`tenant_id`) REFERENCES `tenant_t` (`tenant_id`);

--
-- Constraints for table `payment_t`
--
ALTER TABLE `payment_t`
  ADD CONSTRAINT `paymentFK1` FOREIGN KEY (`tenant_id`) REFERENCES `tenant_t` (`tenant_id`);

--
-- Constraints for table `repairman_t`
--
ALTER TABLE `repairman_t`
  ADD CONSTRAINT `repairmanFK1` FOREIGN KEY (`manager_id`) REFERENCES `manager_t` (`manager_id`);

--
-- Constraints for table `tenant_t`
--
ALTER TABLE `tenant_t`
  ADD CONSTRAINT `tenantFK1` FOREIGN KEY (`apartment_no`) REFERENCES `apartment_t` (`apartment_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
