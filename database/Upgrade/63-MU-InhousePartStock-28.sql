-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;


--
-- Table structure for table `inhouse_parts_stock`
--

CREATE TABLE `inhouse_parts_stock` (
  `inhousePartStockId` int(11) NOT NULL,
  `inhouse_parts_id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `stock` DECIMAL(15,2) NOT NULL,
  `safty_buffer_stk` DECIMAL(15,2) NOT NULL,    -- CURRENTLY NOT USED FROM HERE BUT FROM MASTER inhouse_parts
  `onhold_stock` DECIMAL(15,2) NOT NULL,
  `production_qty` DECIMAL(15,2) NOT NULL,
  `rejection_prodcution_qty` DECIMAL(15,2) NOT NULL,
  `sub_con_stock` DECIMAL(15,2) DEFAULT NULL,
  `rejection_stock` DECIMAL(15,2) DEFAULT NULL,
  `sharing_qty` DECIMAL(15,2) DEFAULT NULL,
  `machine_mold_issue_stock` DECIMAL(15,2) DEFAULT NULL,
  `production_scrap` DECIMAL(15,2) NOT NULL DEFAULT 0,
  `production_rejection` DECIMAL(15,2) NOT NULL DEFAULT 0,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
);



ALTER TABLE `inhouse_parts_stock`
  ADD PRIMARY KEY (`inhousePartStockId`);

ALTER TABLE `inhouse_parts_stock`
  MODIFY `inhousePartStockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
ALTER TABLE `inhouse_parts_stock` 
ADD UNIQUE `unique_inhouse_parts_stock` (`inhouse_parts_id`, `clientId`);

COMMIT;

-- Migration of existing stock
INSERT INTO inhouse_parts_stock (clientId,inhouse_parts_id, stock, safty_buffer_stk, onhold_stock,production_qty ,rejection_prodcution_qty ,sub_con_stock  ,rejection_stock  ,sharing_qty ,machine_mold_issue_stock ,production_scrap  ,production_rejection, created_id, date, time, timestamp)
SELECT 1, id, stock, safty_buffer_stk, onhold_stock,production_qty ,rejection_prodcution_qty, sub_con_stock, rejection_stock, sharing_qty,machine_mold_issue_stock, production_scrap, production_rejection, created_id, date, time, timestamp
FROM inhouse_parts

COMMIT;

ALTER TABLE `inhouse_parts` 
CHANGE `ppap_document` `ppap_document` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `modal_document` `modal_document` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `cad_file` `cad_file` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `a_d` `a_d` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `q_d` `q_d` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `c_d` `c_d` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('63-MU-InhousePartStock-28.sql', CURRENT_TIMESTAMP);

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