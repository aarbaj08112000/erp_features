-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 06:24 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_challan_part_return`
--

CREATE TABLE `customer_challan_part_return` (
  `customer_challan_part_return_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `client_id` int NOT NULL,
  `grn_code` varchar(255) NOT NULL,
  `customer_challan_no` varchar(255) DEFAULT NULL,
  `transportor_id` int DEFAULT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Lock') NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `customer_challan_part_return_part`
--

CREATE TABLE `customer_challan_part_return_part` (
  `customer_challan_part_return_part_id` int NOT NULL,
  `customer_challan_part_return_id` int NOT NULL,
  `part_id` int NOT NULL,
  `qty` float NOT NULL,
  `customer_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `part_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `basic_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_rate` decimal(15,2) NOT NULL DEFAULT '0.00',
  `cgst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `sgst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `igst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tcs_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `gst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `updated_by` int DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `customer_challan_return`
--

CREATE TABLE `customer_challan_return` (
  `customer_challan_return_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `client_id` int NOT NULL,
  `grn_code` varchar(255) NOT NULL,
  `customer_challan_no` varchar(255) NOT NULL,
  `customer_challan_data` date NOT NULL,
  `type` enum('returnable','non_returnable') NOT NULL,
  `status` enum('Pending','Lock') NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `customer_challan_return_part`
--

CREATE TABLE `customer_challan_return_part` (
  `customer_challan_return_part_id` int NOT NULL,
  `customer_challan_return_id` int NOT NULL,
  `part_id` int NOT NULL,
  `qty` float NOT NULL,
  `customer_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `part_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `basic_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_rate` decimal(15,2) NOT NULL DEFAULT '0.00',
  `cgst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `sgst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `igst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tcs_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `gst_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `updated_by` int DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indexes for table `customer_challan_part_return`
--
ALTER TABLE `customer_challan_part_return`
  ADD PRIMARY KEY (`customer_challan_part_return_id`);

--
-- Indexes for table `customer_challan_part_return_part`
--
ALTER TABLE `customer_challan_part_return_part`
  ADD PRIMARY KEY (`customer_challan_part_return_part_id`);

--
-- Indexes for table `customer_challan_return`
--
ALTER TABLE `customer_challan_return`
  ADD PRIMARY KEY (`customer_challan_return_id`);

--
-- Indexes for table `customer_challan_return_part`
--
ALTER TABLE `customer_challan_return_part`
  ADD PRIMARY KEY (`customer_challan_return_part_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_challan_part_return`
--
ALTER TABLE `customer_challan_part_return`
  MODIFY `customer_challan_part_return_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_challan_part_return_part`
--
ALTER TABLE `customer_challan_part_return_part`
  MODIFY `customer_challan_part_return_part_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_challan_return`
--
ALTER TABLE `customer_challan_return`
  MODIFY `customer_challan_return_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_challan_return_part`
--
ALTER TABLE `customer_challan_return_part`
  MODIFY `customer_challan_return_part_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('91-AROM-28-Challan-Return-Flow.sql', CURRENT_TIMESTAMP);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;