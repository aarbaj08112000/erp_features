-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 July, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


ALTER TABLE `rejection_sales_invoice`  
ADD `mode` INT NOT NULL  AFTER `remark`,  
ADD `transporter_id` INT NOT NULL  AFTER `mode`,  
ADD `vehicle_number` VARCHAR(255) NOT NULL AFTER `transporter_id`,  
ADD `lr_number` VARCHAR(255) NOT NULL  AFTER `vehicle_number`,  
ADD `freight_charges` DOUBLE(10,2) NOT NULL  AFTER `lr_number`;

COMMIT;

ALTER TABLE `parts_rejection_sales_invoice`  
ADD `part_price` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `created_day`,  
ADD `basic_total` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `part_price`,  
ADD `total_rate` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `basic_total`,  
ADD `cgst_amount` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `total_rate`,  
ADD `sgst_amount` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `cgst_amount`, 
ADD `igst_amount` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `sgst_amount`,  
ADD `tcs_amount` DECIMAL(15,2) NOT NULL DEFAULT '0'  AFTER `igst_amount`;

COMMIT;
 
ALTER TABLE `parts_rejection_sales_invoice` 
ADD `gst_amount` DECIMAL(15,2) NOT NULL DEFAULT '0' AFTER `tcs_amount`;

ALTER TABLE `rejection_sales_invoice` 
ADD `type` ENUM('CreditNote','DebitNote','ProformaInvoice') NOT NULL AFTER `freight_charges`;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('87-AROM-100-Credit-Note.sql', CURRENT_TIMESTAMP);

COMMIT;