-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 09:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `sales_category`
--

CREATE TABLE `sales_category` (
  `sales_category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updatedttm` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Defines tally categories, for sales tally export ';

--
-- Indexes for table `sales_category`
--
ALTER TABLE `sales_category`
  ADD PRIMARY KEY (`sales_category_id`),
  ADD UNIQUE KEY `sales_category_UI` (`category_name`);
COMMIT;

--
-- AUTO_INCREMENT for table `sales_category`
--
ALTER TABLE `sales_category`
  MODIFY `sales_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

ALTER TABLE `new_sales` 
ADD `tally_category` INT NULL DEFAULT NULL 
COMMENT 'Tally sales category' AFTER `distance`;

COMMIT;

ALTER TABLE `new_sales` 
ADD CONSTRAINT `new_sales_fk5` FOREIGN KEY (`tally_category`) REFERENCES `sales_category`(`sales_category_id`) 
ON DELETE RESTRICT ON UPDATE RESTRICT;

COMMIT;

-- --------------------------------------------------------------
INSERT INTO `DB_Upgrade`(`Script_name`, `updated_time`)
       VALUES('104-AROM-140A-Tally-Sales-Category.sql', CURRENT_TIMESTAMP);
	   
COMMIT;	   
