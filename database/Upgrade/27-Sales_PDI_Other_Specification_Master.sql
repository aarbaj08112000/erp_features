-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 05:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- --------------------------------------------------------
--
-- Table structure for table `cust_part_inspection_master`
--

CREATE TABLE `cust_part_inspection_master` (
  `id` int(11) NOT NULL,
  `customer_partKy` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `specification` text NOT NULL,
  `evalution_mesaurement_technique` text NOT NULL,
  `lower_spec_limit` FLOAT NULL DEFAULT NULL,
  `upper_spec_limit` FLOAT NULL DEFAULT NULL,
  `critical_parm` text DEFAULT NULL,
  `is_PDI` BOOLEAN NOT NULL DEFAULT FALSE, 
  `is_setup` BOOLEAN NOT NULL DEFAULT FALSE, 
  `is_layout` BOOLEAN NOT NULL DEFAULT FALSE, 
  `is_inprocess_inspection` BOOLEAN NOT NULL DEFAULT FALSE,
  `updatedttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cust_part_inspection_master`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cust_part_inspection_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `cust_part_inspection_master` 
ADD CONSTRAINT `customer_part_fk` FOREIGN KEY (`customer_partKy`) REFERENCES `customer_part`(`id`) 
ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `cust_part_inspection_master`
ADD CONSTRAINT check_upper_greater_lower CHECK (upper_spec_limit > lower_spec_limit);

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('27-Sales_PDI_Other_Specification_Master.sql', CURRENT_TIMESTAMP);

COMMIT;
