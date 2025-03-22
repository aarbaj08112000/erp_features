-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 12:01 PM
-- Server version: 8.0.40-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `scrap_category_master`
--

CREATE TABLE `scrap_category_master` (
  `scrap_category_master_id` int NOT NULL,
  `scrap_category` varchar(255) NOT NULL,
  `added_by` int NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


--
-- Table structure for table `scrap_transfer_stock`
--

CREATE TABLE `scrap_transfer_stock` (
  `scrap_transfer_stock_id` int NOT NULL,
  `scrap_category_id` int NOT NULL,
  `customer_part_id` int NOT NULL,
  `stock` double(10,2) NOT NULL,
  `added_by` int NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scrap_category_master`
--
ALTER TABLE `scrap_category_master`
  ADD PRIMARY KEY (`scrap_category_master_id`);

--
-- Indexes for table `scrap_transfer_stock`
--
ALTER TABLE `scrap_transfer_stock`
  ADD PRIMARY KEY (`scrap_transfer_stock_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scrap_category_master`
--
ALTER TABLE `scrap_category_master`
  MODIFY `scrap_category_master_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scrap_transfer_stock`
--
ALTER TABLE `scrap_transfer_stock`
  MODIFY `scrap_transfer_stock_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


ALTER TABLE `customer_parts_master` ADD `part_type` ENUM('non_scrap','scrap') NOT NULL DEFAULT 'non_scrap' AFTER `timestamp`, ADD `scrap_category_id` INT NULL DEFAULT '0' AFTER `part_type`;
INSERT INTO `menu_master` (`diaplay_name`, `url`, `menu_category_id`, `status`) VALUES
('Scarp Category', 'scrap_category', 8, 'Active'),
('Scarp Report', 'scrap_report', 7, 'Active'),
('Production Scrap Report', 'production_scrap_report', 7, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

COMMIT;

INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('108-AROM-72-ScrapReport.sql'
            , CURRENT_TIMESTAMP
       )
;

COMMIT;

/*added remark in transfer scrap stock */
ALTER TABLE `scrap_transfer_stock` ADD `remark` VARCHAR(255) NULL AFTER `stock`;

/*added menu for new report transfer scrap stock */;
INSERT INTO `menu_master` (`diaplay_name`, `url`,`menu_category_id`, `status`) VALUES ('Production Scrap Transfer Report', 'production_scrap_transfer_report',7,'Active')