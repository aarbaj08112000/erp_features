-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2nd June, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `molding_production` ADD `clientId` INT(11) NOT NULL AFTER `id`;

COMMIT;

UPDATE molding_production
SET clientId = 1
WHERE clientId = 0;

COMMIT;

ALTER TABLE `molding_stock_transfer` ADD `clientId` INT(11) NOT NULL AFTER `id`;

COMMIT;

UPDATE molding_stock_transfer
SET clientId = 1
WHERE clientId = 0;

COMMIT;

ALTER TABLE `final_inspection_request` ADD `clientId` INT(11) NOT NULL AFTER `id`;

UPDATE molding_stock_transfer
SET clientId = 1
WHERE clientId = 0;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('78-MU-Plastic-MoldingProduction.sql', CURRENT_TIMESTAMP);

COMMIT;