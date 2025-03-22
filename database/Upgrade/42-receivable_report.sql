-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2024 at 08:43 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `receivable_report`
--

CREATE TABLE `receivable_report` (
  `id` int(11) NOT NULL,
  `sales_number` varchar(255) NOT NULL,
  `payment_receipt_date` varchar(255) NOT NULL,
  `amount_received` varchar(255) NOT NULL,
  `transaction_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB;

COMMIT;

--
-- Indexes for table `receivable_report`
--
ALTER TABLE `receivable_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `receivable_report`
--

ALTER TABLE `receivable_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('42-receivable_report.sql', CURRENT_TIMESTAMP);

COMMIT;
