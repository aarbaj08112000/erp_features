-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sept 23, 2024 at 02:13 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `customer_part` 
ADD `itemCode` TEXT NULL DEFAULT NULL 
COMMENT 'Item code mainly used by Budhale' AFTER `passivationType`;
	
COMMIT;
	
INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('98-Customization-ItemCode.sql', CURRENT_TIMESTAMP);

COMMIT;