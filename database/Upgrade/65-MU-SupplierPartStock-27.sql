-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 02:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Table structure for table `child_part_stock`
--
CREATE TABLE `child_part_stock` (
  `childPartStockId` int(11) NOT NULL,
  `childPartId` int(11) NOT NULL COMMENT "Reference to Child_Part ID",
  `clientId` int(11) NOT NULL,
  `stock` DECIMAL(15,2) NOT NULL,
  `store_stock_rate` DECIMAL(15,2) DEFAULT NULL, 
  `safty_buffer_stk` varchar(255) DEFAULT NULL,   -- CURRENTLY NOT USED FROM HERE BUT FROM MASTER child_part
  `onhold_stock` DECIMAL(15,2) NOT NULL,
  `production_qty` DECIMAL(15,2) NOT NULL,
  `rejection_prodcution_qty` DECIMAL(15,2) NOT NULL,
  `sub_con_stock` DECIMAL(15,2) DEFAULT NULL,
  `rejection_stock` DECIMAL(15,2) DEFAULT NULL,
  `sharing_qty` DECIMAL(15,2) NOT NULL DEFAULT 0,
  `machine_mold_issue_stock` DECIMAL(15,2) NOT NULL DEFAULT 0,
  `production_scrap` int(11) NOT NULL DEFAULT 0,
  `production_rejection` int(11) NOT NULL DEFAULT 0,
  `deflashing_stock` DECIMAL(15,2) NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
 );
  
  
COMMIT;

-- Indexes for table `child_part_stock`
--
ALTER TABLE `child_part_stock`
  ADD PRIMARY KEY (`childPartStockId`);

--
-- AUTO_INCREMENT for table `child_part_stock`
--
ALTER TABLE `child_part_stock`
  MODIFY `childPartStockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

ALTER TABLE `child_part_stock` 
ADD UNIQUE `unique_child_part_stock` (`childPartId`, `clientId`);

COMMIT;

  
/* CREATE TABLE `child_part` (
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
  `diagram` varchar(50) DEFAULT NULL,
  `quote` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `part_drawing` text DEFAULT NULL,
  `ppap_document` text DEFAULT NULL,
  `modal_document` text DEFAULT NULL,
  `cad_file` text DEFAULT NULL,
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
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
); */


ALTER TABLE `child_part` 
CHANGE `a_d` `a_d` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `q_d` `q_d` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, 
CHANGE `c_d` `c_d` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

COMMIT;

-- Migration of existing stock
INSERT INTO child_part_stock (clientId,`childPartId`,`stock`,`store_stock_rate`,`safty_buffer_stk`,`onhold_stock`,`production_qty`,`rejection_prodcution_qty`,`sub_con_stock`,`rejection_stock`,`sharing_qty` ,`machine_mold_issue_stock`,`production_scrap`,`production_rejection`,`deflashing_stock`, created_id, date, time, timestamp)
SELECT 1,`id`,`stock`,`store_stock_rate`,`safty_buffer_stk`,`onhold_stock`,`production_qty`,`rejection_prodcution_qty`,`sub_con_stock`,`rejection_stock`,`sharing_qty` ,`machine_mold_issue_stock`,`production_scrap`,`production_rejection`,
`deflashing_stock`, created_id, date, time, timestamp
FROM child_part

COMMIT;

-- Migration of existing stock for 2nd Unit
/* INSERT INTO child_part_stock (clientId,`childPartId`,`stock`,`store_stock_rate`,`safty_buffer_stk`,`onhold_stock`,`production_qty`,`rejection_prodcution_qty`,`sub_con_stock`,`rejection_stock`,`sharing_qty` ,`machine_mold_issue_stock`,`production_scrap`,`production_rejection`,`deflashing_stock`, created_id, date, time, timestamp)
SELECT 2, `id`,`stock2`,`store_stock_rate`,`safty_buffer_stk`,`onhold_stock`,`production_qty2`,`rejection_prodcution_qty`,`sub_con_stock`,`rejection_stock`,`sharing_qty` ,`machine_mold_issue_stock2`,`production_scrap`,`production_rejection`,
`deflashing_stock`, created_id, date, time, timestamp
FROM child_part
*/

COMMIT;


ALTER TABLE `child_part` CHANGE `stock` `old_stock` FLOAT NOT NULL, CHANGE `stock2` `old_stock2` FLOAT NOT NULL, CHANGE `stock3` `old_stock3` FLOAT NOT NULL, CHANGE `production_qty` `old_production_qty` FLOAT NOT NULL, CHANGE `production_qty2` `old_production_qty2` FLOAT NOT NULL, CHANGE `production_qty3` `old_production_qty3` FLOAT NOT NULL, CHANGE `machine_mold_issue_stock` `old_machine_mold_issue_stock` FLOAT NOT NULL DEFAULT '0', CHANGE `machine_mold_issue_stock2` `old_machine_mold_issue_stock2` FLOAT NOT NULL DEFAULT '0', CHANGE `machine_mold_issue_stock3` `old_machine_mold_issue_stock3` FLOAT NOT NULL DEFAULT '0';

COMMIT;

-- removed this field to avoid confusion as of now.
ALTER TABLE `child_part_stock`
DROP `store_stock_rate`;

COMMIT;
  
  
INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('65-MU-SupplierPartStock-27.sql', CURRENT_TIMESTAMP);

COMMIT;