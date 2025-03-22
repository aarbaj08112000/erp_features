-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 02:13 PM
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

--
-- Database: `demo-plastic`
--

ALTER TABLE `new_po` ADD `po_discount_type` ENUM('N/A','PO Level','Part Level') NOT NULL  DEFAULT 'N/A';
ALTER TABLE `new_po` ADD `discount_type` ENUM('Percentage', 'Number', '') NOT NULL DEFAULT '' AFTER `po_discount_type`,
ADD `discount` DECIMAL(10, 2) NULL DEFAULT 0 AFTER `discount_type`;
ALTER TABLE `po_parts` ADD `discount` DECIMAL(10,2) NOT NULL DEFAULT '0' AFTER `complete_process`;
ALTER TABLE `new_po` CHANGE `po_discount_type` `po_discount_type` ENUM('N/A','PO Level','Part Level') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'N/A';

-- category changes ---

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `added_by` int NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB;

-- add current category which already use in system by below query
INSERT INTO category (category_id, parent_id, category_name, added_by, added_date) VALUES
(1, 0, 'Regular grn', 3, '2024-10-03 22:37:57'),
(2, 0, 'Subcon grn', 3, '2024-10-03 22:38:06'),
(3, 0, 'consumable', 3, '2024-10-03 22:39:59'),
(4, 0, 'asset', 3, '2024-10-03 22:40:06'),
(5, 0, 'customer_bom', 3, '2024-10-03 22:41:17');


--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);
  
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

-- category changes ----

ALTER TABLE `child_part` ADD `sub_category` VARCHAR(255) NULL DEFAULT NULL AFTER `deflashing_stock`;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('96-AROM-89,119,121A,97-DISCOUNT-CASE.sql', CURRENT_TIMESTAMP);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;