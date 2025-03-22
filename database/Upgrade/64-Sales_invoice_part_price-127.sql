-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `sales_parts` ADD `part_price` FLOAT NOT NULL AFTER `expiry_date`;

ALTER TABLE `sales_parts` ADD `basic_total` FLOAT NOT NULL AFTER `invoice_number`;


ALTER TABLE `sales_parts` CHANGE `part_price` `part_price` DECIMAL(15,2) NOT NULL, 
CHANGE `basic_total` `basic_total` DECIMAL(15,2) NOT NULL,
CHANGE `qty` `qty` DECIMAL(15,2) NOT NULL, 
CHANGE `total_rate` `total_rate` DECIMAL(15,2) NULL, 
CHANGE `cgst_amount` `cgst_amount` DECIMAL(15,2) NULL, 
CHANGE `sgst_amount` `sgst_amount` DECIMAL(15,2) NULL, 
CHANGE `igst_amount` `igst_amount` DECIMAL(15,2) NULL, 
CHANGE `tcs_amount` `tcs_amount` DECIMAL(15,2) NULL, 
CHANGE `gst_amount` `gst_amount` DECIMAL(15,2) NULL,
CHANGE `pending_qty` `pending_qty` DECIMAL(15,2) NOT NULL;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('64-Sales_invoice_part_price-127.sql', CURRENT_TIMESTAMP);

COMMIT;