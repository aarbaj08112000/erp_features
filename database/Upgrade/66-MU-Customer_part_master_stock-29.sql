-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;


--
-- Table structure for table `customer_parts_master_stock`
--

CREATE TABLE `customer_parts_master_stock` (
  `customer_partStockId` int(11) NOT NULL,
  `customer_parts_master_id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `fg_stock` DECIMAL(15,2) NOT NULL,
  `fg_rate` DECIMAL(15,2) NOT NULL,
  `molding_production_qty` DECIMAL(15,2) NOT NULL,
  `production_rejection` DECIMAL(15,2) NOT NULL,
  `production_scrap` DECIMAL(15,2) NOT NULL,
  `semi_finished_location` DECIMAL(15,2) DEFAULT NULL,
  `deflashing_assembly_location` DECIMAL(15,2) DEFAULT NULL,
  `final_inspection_location` DECIMAL(15,2) DEFAULT NULL,
  `created_id` INT(11) NOT NULL,
  `date` varchar(255) NULL,
  `time` varchar(255) NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
);


ALTER TABLE `customer_parts_master_stock`
  ADD PRIMARY KEY (`customer_partStockId`);

ALTER TABLE `customer_parts_master_stock`
  MODIFY `customer_partStockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
ALTER TABLE `customer_parts_master_stock` 
ADD UNIQUE `unique_customer_parts_master_stock` (`customer_parts_master_id`, `clientId`);

COMMIT;

-- Migration of existing stock
INSERT INTO customer_parts_master_stock (clientId, customer_parts_master_id, fg_stock, fg_rate, molding_production_qty, production_rejection ,production_scrap  ,semi_finished_location  ,deflashing_assembly_location ,final_inspection_location)
SELECT 1, id,fg_stock, fg_rate, molding_production_qty, production_rejection ,production_scrap  ,semi_finished_location  ,deflashing_assembly_location ,final_inspection_location
FROM customer_parts_master;

COMMIT;

-- Migration of existing stock to second unit
/*INSERT INTO customer_parts_master_stock (clientId, customer_parts_master_id, fg_stock, fg_rate, molding_production_qty, production_rejection ,production_scrap  ,semi_finished_location  ,deflashing_assembly_location ,final_inspection_location)
SELECT 2, id,fg_stock2, fg_rate, molding_production_qty, production_rejection ,production_scrap  ,semi_finished_location  ,deflashing_assembly_location ,final_inspection_location
FROM customer_parts_master;
*/

COMMIT;

ALTER TABLE `customer_parts_master` CHANGE `fg_stock` `old_fg_stock` FLOAT NOT NULL DEFAULT '0', CHANGE `fg_stock2` `old_fg_stock2` FLOAT NOT NULL DEFAULT '0', CHANGE `fg_stock3` `old_fg_stock3` FLOAT NOT NULL DEFAULT '0';

COMMIT;

ALTER TABLE `customer_parts_master` 
ADD `created_id` INT NOT NULL AFTER `final_inspection_location`, 
ADD `date` VARCHAR(255) NULL DEFAULT NULL AFTER `created_id`, 
ADD `time` VARCHAR(255) NULL DEFAULT NULL AFTER `date`,
ADD `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `time`;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('66-MU-Customer_part_master_stock-29.sql', CURRENT_TIMESTAMP);

COMMIT;

-- Just keep below item in table rest are not applicable so it can be remvoed 
 
/* CREATE TABLE `inhouse_parts` (
  `id` int(11) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(250) NOT NULL,
  `supplier_id` int(30) DEFAULT NULL,                 
  `part_rate` int(11) DEFAULT NULL,                    
  `revision_date` varchar(50) DEFAULT NULL,                
  `revision_no` varchar(50) DEFAULT NULL,
  `revision_remark` varchar(20) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `child_part_id` int(255) DEFAULT NULL,
  `store_rack_location` varchar(255) DEFAULT NULL,
  `store_stock_rate` float DEFAULT NULL,
  `diagram` varchar(50) DEFAULT NULL,
  `quote` varchar(50) DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `part_drawing` text DEFAULT NULL,
  `ppap_document` text NOT NULL,
  `modal_document` text NOT NULL,
  `cad_file` text NOT NULL,
  `a_d` text NOT NULL,
  `q_d` text NOT NULL,
  `c_d` text NOT NULL,
  `quotation_document` varchar(20) DEFAULT NULL,
  `gst_id` int(11) DEFAULT NULL,
  `sub_type` text DEFAULT NULL,
  `max_uom` float DEFAULT NULL,
  `min_uom` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `size` text DEFAULT NULL,
  `thickness` text DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
) */