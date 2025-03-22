-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

-- ACTUAL STOCK not sure what it is so set to null by default as of now
ALTER TABLE `stock_report` CHANGE `actual_stock` `actual_stock` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

-- FG STOCK UNIT WISE SUPPORT
ALTER TABLE `customer_parts_master` ADD `fg_stock2` FLOAT NOT NULL DEFAULT '0' AFTER `fg_stock`, ADD `fg_stock3` FLOAT NOT NULL DEFAULT '0' AFTER `fg_stock2`;


COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('58-MU-Store-SupplierStock-27.sql', CURRENT_TIMESTAMP);

COMMIT;


