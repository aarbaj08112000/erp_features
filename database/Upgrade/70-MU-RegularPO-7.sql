-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `new_po` ADD `clientId` INT(11) NOT NULL AFTER `id`;

COMMIT;

-- Migrate existing data to default clientId
UPDATE new_po
SET clientId = 1
WHERE clientId = 0;

COMMIT;


-- Changing amount type to decimal from float
ALTER TABLE `new_po` 
CHANGE `loading_unloading` `loading_unloading` DECIMAL(15,2) NULL DEFAULT NULL, 
CHANGE `freight_amount` `freight_amount` DECIMAL(15,2) NULL DEFAULT NULL, 
CHANGE `final_amount` `final_amount` DECIMAL(15,2) NULL DEFAULT NULL;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('70-MU-RegularPO-7.sql', CURRENT_TIMESTAMP);

COMMIT;
