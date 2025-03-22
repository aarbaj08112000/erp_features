-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 1 Dec, 2023 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- ALTER TABLE `planing_data` 
-- ADD CONSTRAINT `fk_planning` FOREIGN KEY (`planing_id`) REFERENCES `planing`(`id`) 
-- ON DELETE RESTRICT ON UPDATE NO ACTION;


CREATE TABLE `planning_shop_order` (
  `id` int(11) NOT NULL,
  `shop_no` VARCHAR(10) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `shop_date` DATETIME NOT NULL,
  `shop_month` INT(2) NOT NULL, 
  `shop_year` INT(4) NOT NULL,
  `scheduleQty` float NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `planning_shop_order`
--
ALTER TABLE `planning_shop_order`
  ADD PRIMARY KEY (`id`);

--
ALTER TABLE `planning_shop_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

ALTER TABLE `planning_shop_order` ADD UNIQUE `unique_shopNumber` (`shop_no`);

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('35-Planning-shop-order.sql', CURRENT_TIMESTAMP);

COMMIT;