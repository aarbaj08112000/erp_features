-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 02:13 PM
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
-- Database: `demo-plastic`
--

-- --------------------------------------------------------

--
-- Table structure for table `payable_report`
--

CREATE TABLE `payable_report` (
  `id` int NOT NULL,
  `clientId` int NOT NULL,
  `grn_number` varchar(255) NOT NULL,
  `payment_receipt_date` varchar(255) NOT NULL,
  `amount_received` varchar(255) NOT NULL,
  `transaction_details` varchar(255) DEFAULT NULL,
  `tds_amount` double(10,2) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `payable_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payable_report`
--
ALTER TABLE `payable_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `receivable_report` ADD `tds_amount` DOUBLE(10,2) NULL AFTER `transaction_details`, ADD `remark` VARCHAR(255) NULL AFTER `tds_amount`;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('93-AROM-92-Reports-flow.sql', CURRENT_TIMESTAMP);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;