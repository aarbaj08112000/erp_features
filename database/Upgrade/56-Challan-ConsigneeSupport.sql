-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 April, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `challan` 
ADD `shipping_addressType` ENUM('supplier','consignee') NOT NULL DEFAULT 'supplier' AFTER `supplier_id`;

ALTER TABLE `challan` 
ADD `consignee_id` INT(11) NULL COMMENT 'Consignee address ID if shipping address type is consignee' AFTER `shipping_addressType`;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('56-Challan-ConsigneeSupport.sql', CURRENT_TIMESTAMP);

COMMIT;


