-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: APRIL 10, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bsp`
--

--
-- Table structure for table `transporter`
--

CREATE TABLE `transporter` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `transporter_id` varchar(15) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indexes for table `transporter`
--
ALTER TABLE `transporter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `transporter`
--
ALTER TABLE `transporter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;


-- --------------- Update new_sales table for transporter_id  --------------------

ALTER TABLE `new_sales` 
ADD `transporter_id` INT(15) NULL AFTER `transporter`;

commit;

-- Need migration script for moving old data

-- --------------- Ends Update new_sales table  ------------------------- --------


-- --------------------- UPDATE einvoice_res for Eway bill update field ------------

ALTER TABLE `einvoice_res` 
ADD `e_way_bill_remark` VARCHAR(50) NULL DEFAULT NULL AFTER `EwbDt`, 
ADD `transporter_id` INT(50) NULL DEFAULT NULL AFTER `e_way_bill_remark`;

COMMIT;

-- --------------------- End einvoice_res for Eway bill update field ------------




