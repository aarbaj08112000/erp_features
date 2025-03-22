-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 March, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- ------------------------------
-- ---- Master table for Address

COMMIT;

-- Unit can be of float
ALTER TABLE `sales_parts` CHANGE `qty` `qty` FLOAT(11) NOT NULL;


ALTER TABLE `new_sales` ADD `clientId` INT(11) NULL AFTER `id`;


-- migrate existing sales invoices to first client unit.
UPDATE `new_sales`
SET `clientId` = (SELECT ID FROM `client` ORDER BY id asc LIMIT 1);


ALTER TABLE `new_sales` ADD CONSTRAINT `fk_sales_client` 
FOREIGN KEY (`clientId`) REFERENCES `client`(`id`) 
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `new_sales` ADD `shipping_addressType` ENUM('customer','consignee') NULL DEFAULT NULL AFTER `customer_id`;

-- migrate existing sales invoices shipping address type with customer.
UPDATE `new_sales`
SET `shipping_addressType` = 'customer';


ALTER TABLE `new_sales` 
ADD `consignee_id` INT(11) NULL DEFAULT NULL 
COMMENT 'Consignee address ID if shipping address type is consignee' AFTER `shipping_addressType`;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('53-Multiple-Unit-Sales.sql', CURRENT_TIMESTAMP);

COMMIT;