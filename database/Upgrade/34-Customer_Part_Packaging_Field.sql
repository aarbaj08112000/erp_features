-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 06:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

ALTER TABLE `customer_part` 
ADD `packaging_qty` INT(10) NULL DEFAULT '1' 
AFTER `uom`;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('34-Customer_Part_Packaging_Field.sql', CURRENT_TIMESTAMP);


COMMIT;
