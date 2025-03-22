-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 06:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

CREATE TABLE `cust_part_inspection_report` (
  `id` int(11) NOT NULL,
  `cust_part_inspection_masterKy` int(11) NOT NULL,
  `sales_partky` int(11) NOT NULL,
  `customer_partKy` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `specification` text NOT NULL,
  `evalution_mesaurement_technique` text NOT NULL,
  `lower_spec_limit` FLOAT NULL DEFAULT NULL,
  `upper_spec_limit` FLOAT NULL DEFAULT NULL,
  `critical_parm` text DEFAULT NULL,
  `observation1` FLOAT NULL DEFAULT NULL,
  `observation2` FLOAT NULL DEFAULT NULL,
  `observation3` FLOAT NULL DEFAULT NULL,
  `observation4` FLOAT NULL DEFAULT NULL,
  `observation5` FLOAT NULL DEFAULT NULL,
  `remark` text NULL DEFAULT NULL,
  `isManualLogObsrvtn` SMALLINT(1) NULL DEFAULT '0',
  `updatedttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cust_part_inspection_report`
ADD PRIMARY KEY (`id`);

ALTER TABLE `cust_part_inspection_report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
/* 
Removed as we would like to use the records from report even if master is not there.
ALTER TABLE `cust_part_inspection_report` 
ADD CONSTRAINT `cust_part_inspection_master_fk` 
FOREIGN KEY (`cust_part_inspection_masterKy`) REFERENCES `cust_part_inspection_master`(`id`) 
ON DELETE NO ACTION ON UPDATE NO ACTION;
*/
ALTER TABLE `cust_part_inspection_report` 
ADD CONSTRAINT `sales_part_fk` 
FOREIGN KEY (`sales_partky`) REFERENCES `sales_parts`(`id`) 
ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `cust_part_inspection_report` 
ADD CONSTRAINT `customer_part_fk1` FOREIGN KEY (`customer_partKy`) REFERENCES `customer_part`(`id`) 
ON DELETE CASCADE ON UPDATE CASCADE;

-- ensure limits are correctly set --
ALTER TABLE `cust_part_inspection_report`
ADD CONSTRAINT check_upper_greater_lower CHECK (upper_spec_limit > lower_spec_limit);

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('28-Sales_PDI_report_observation.sql', CURRENT_TIMESTAMP);

COMMIT;