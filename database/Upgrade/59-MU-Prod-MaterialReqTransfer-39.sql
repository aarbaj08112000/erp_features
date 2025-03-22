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

-- New Material Request - Sheet metal Production 
-- Client ID support
ALTER TABLE `stock_changes` ADD `clientId` INT NOT NULL AFTER `id`;

-- may need to check if there is any data with other than client one say stock2 or production_qty2 etc.
UPDATE `stock_changes`
SET clientId = 1
WHERE clientId is NULL;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('59-MU-Prod-MaterialReqTransfer-39.sql', CURRENT_TIMESTAMP);

COMMIT;


