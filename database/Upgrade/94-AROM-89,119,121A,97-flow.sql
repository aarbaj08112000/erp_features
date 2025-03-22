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
ALTER TABLE `new_po` ADD `is_unlock` ENUM('Yes','No') NOT NULL DEFAULT 'No' AFTER `final_amount`;
ALTER TABLE `supplier` ADD `payment_days` INT(15) NULL AFTER `payment_terms`;
ALTER TABLE `supplier` ADD `discount` FLOAT NULL AFTER `pan_card`;
ALTER TABLE `supplier` ADD `discount_type` ENUM('Percentage','Number') NULL AFTER `discount`;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('94-AROM-89,119,121A,97-flow.sql', CURRENT_TIMESTAMP);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;