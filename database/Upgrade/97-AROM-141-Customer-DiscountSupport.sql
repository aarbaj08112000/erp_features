-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sept 17, 2024 at 02:13 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

ALTER TABLE `new_sales` 
ADD `total_sales_amount` DECIMAL(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Total sales amount including GST and discount' AFTER `vehicle_number`,
ADD `total_gst_amount` DECIMAL(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Total sales gst amount' AFTER `total_sales_amount`;

COMMIT;

ALTER TABLE `customer` 
ADD `discount` DECIMAL(15,2) NOT NULL DEFAULT '0' AFTER `pin`, 
ADD `discountType` ENUM('NA','Amount','Percentage') NOT NULL DEFAULT 'NA' AFTER `discount`;

COMMIT;

ALTER TABLE `new_sales` 
ADD `discount_amount` DECIMAL(15,2) NOT NULL DEFAULT '0' AFTER `vehicle_number`, 
ADD `discount` DECIMAL(15,2) NOT NULL DEFAULT '0' AFTER `discount_amount`, 
ADD `discountType` ENUM('NA','Amount','Percentage') NOT NULL DEFAULT 'NA' AFTER `discount`;

COMMIT;

-- Update new sales for existing data which was without discount
UPDATE new_sales sales
JOIN (
    SELECT 
        sales_id,
        SUM(total_rate) AS total_rate,
        SUM(gst_amount) AS gst_amount
    FROM sales_parts
    GROUP BY sales_id
) AS sp ON sales.id = sp.sales_id
SET sales.total_sales_amount = sp.total_rate,
	sales.total_gst_amount = sp.gst_amount;
	
COMMIT;
	
INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('97-AROM-141-Customer-DiscountSupport.sql', CURRENT_TIMESTAMP);



COMMIT;
