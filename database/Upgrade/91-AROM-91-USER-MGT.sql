-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 11:43 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `group_master`
--

CREATE TABLE `group_master` (
  `group_master_id` int NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_code` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB;

--
-- Dumping data for table `group_master`
--

INSERT INTO `group_master` (`group_master_id`, `group_name`, `group_code`, `status`) VALUES
(1, 'Admin', 'Admin', 'Active'),
(2, 'AROM', 'AROM', 'Active'),
(5, 'Purchase', 'purchase', 'Active'),
(6, 'Sales', 'sales', 'Active'),
(7, 'Quality', 'quality', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `group_rights`
--

CREATE TABLE `group_rights` (
  `group_rights_id` int NOT NULL,
  `group_master_id` int NOT NULL,
  `menu_master_id` int NOT NULL,
  `list` enum('Yes','No') CHARACTER SET utf8mb4 NOT NULL DEFAULT 'No',
  `add` enum('Yes','No') NOT NULL DEFAULT 'No',
  `update` enum('Yes','No') NOT NULL DEFAULT 'No',
  `delete` enum('Yes','No') NOT NULL DEFAULT 'No',
  `export` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB;

--
-- Dumping data for table `group_rights`
--

INSERT INTO `group_rights` (`group_rights_id`, `group_master_id`, `menu_master_id`, `list`, `add`, `update`, `delete`, `export`) VALUES
(18, 2, 2, 'No', 'Yes', 'Yes', 'No', 'No'),
(19, 2, 3, 'No', 'Yes', 'No', 'No', 'No'),
(46, 6, 1, 'No', 'Yes', 'No', 'No', 'No'),
(47, 7, 1, 'Yes', 'Yes', 'No', 'No', 'No'),
(48, 7, 3, 'Yes', 'No', 'No', 'No', 'No'),
(115, 5, 1, 'Yes', 'No', 'No', 'No', 'No'),
(116, 5, 4, 'Yes', 'No', 'No', 'No', 'No'),
(117, 5, 5, 'Yes', 'Yes', 'No', 'No', 'No'),
(118, 5, 11, 'Yes', 'No', 'No', 'No', 'No'),
(119, 5, 12, 'Yes', 'No', 'No', 'No', 'No'),
(120, 5, 13, 'Yes', 'No', 'No', 'No', 'No'),
(121, 5, 14, 'Yes', 'No', 'No', 'No', 'No'),
(122, 1, 1, 'Yes', 'No', 'No', 'No', 'No'),
(123, 1, 2, 'No', 'Yes', 'No', 'No', 'No'),
(124, 1, 3, 'Yes', 'Yes', 'Yes', 'No', 'No'),
(125, 1, 5, 'No', 'No', 'Yes', 'No', 'Yes'),
(126, 1, 6, 'Yes', 'No', 'No', 'No', 'No'),
(127, 1, 10, 'Yes', 'No', 'No', 'No', 'No'),
(128, 1, 17, 'Yes', 'Yes', 'Yes', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `menu_master`
--

CREATE TABLE `menu_master` (
  `menu_master_id` int NOT NULL,
  `diaplay_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`menu_master_id`, `diaplay_name`, `url`, `status`) VALUES
(1, 'Item Master', 'child_part_view', 'Active'),
(2, 'Supplier Parts', 'child_part_supplier_view', 'Active'),
(3, 'Supplier', 'approved_supplier', 'Active'),
(4, 'Dashboard', 'dashboard', 'Active'),
(5, 'User', 'erp_users', 'Active'),
(6, 'Dashboard BA', 'dashboard_ba', 'Active'),
(7, 'Dashboard Sales', 'dashboard_sales', 'Active'),
(8, 'Dashboard Account', 'dashboard_account', 'Active'),
(10, 'Dashboard Store', 'dashboard_store', 'Active'),
(11, 'Dashboard Subcon', 'dashboard_subcon', 'Active'),
(12, 'Dashboard Production', 'dashboard_production', 'Active'),
(13, 'Dashboard Quality', 'dashboard_quality', 'Active'),
(14, 'Dashboard Purchase Grn', 'dashboard_purchase_grn', 'Active'),
(15, 'Purchase Order', 'new_po', 'Active'),
(16, 'Subcon PO', 'new_po_sub', 'Active'),
(17, 'Supplierwise PO List', 'new_po_list_supplier', 'Active'),
(18, 'Item Master', 'child_part_view', 'Active'),
(19, 'Purchase Parts Price', 'child_part_supplier_view', 'Active'),
(20, 'Supplier', 'approved_supplier', 'Active'),
(21, 'Subcon routing', 'routing', 'Active'),
(22, 'customer subcon routing', 'routing_customer', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_master`
--
ALTER TABLE `group_master`
  ADD PRIMARY KEY (`group_master_id`);

--
-- Indexes for table `group_rights`
--
ALTER TABLE `group_rights`
  ADD PRIMARY KEY (`group_rights_id`);

--
-- Indexes for table `menu_master`
--
ALTER TABLE `menu_master`
  ADD PRIMARY KEY (`menu_master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_master`
--
ALTER TABLE `group_master`
  MODIFY `group_master_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group_rights`
--
ALTER TABLE `group_rights`
  MODIFY `group_rights_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `menu_master`
--
ALTER TABLE `menu_master`
  MODIFY `menu_master_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

-- 

ALTER TABLE `userinfo` ADD `unit_ids` VARCHAR(255) NOT NULL AFTER `drawing_upload`;
ALTER TABLE `userinfo` ADD `groups` VARCHAR(255) NOT NULL AFTER `unit_ids`;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`)  VALUES ('91-AROM-91-USER-MGT.sql', CURRENT_TIMESTAMP);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;