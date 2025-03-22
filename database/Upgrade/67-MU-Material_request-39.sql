-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `stock_changes` 
CHANGE `fromUnit` `fromStockType` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, 
CHANGE `toUnit` `toStockType` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;


ALTER TABLE `stock_changes` ADD `fromUnit` INT(11) NOT NULL AFTER `fromStockType`;
ALTER TABLE `stock_changes` ADD `toUnit` INT(11) NOT NULL AFTER `toStockType`;


COMMIT;

UPDATE stock_changes
SET fromUnit = 1
WHERE fromStockType = 'stock';


UPDATE stock_changes
SET fromUnit = 2
WHERE fromStockType = 'stock2';


UPDATE stock_changes
SET toUnit = 1
WHERE toStockType = 'production_qty';


UPDATE stock_changes
SET toUnit = 2
WHERE toStockType = 'production_qty2';


COMMIT;

UPDATE stock_changes
SET toUnit = 2
WHERE toStockType = 'stock2';

UPDATE stock_changes
SET toUnit = 1
WHERE toStockType = 'stock';


COMMIT;

-- OLD RECORD MIGRATION

UPDATE stock_changes
SET fromUnit = 1
WHERE fromStockType IS NULL;

UPDATE stock_changes
SET toUnit = 1
WHERE toStockType IS NULL;


COMMIT;
-- default 

UPDATE stock_changes
SET fromStockType = 'stock'
WHERE fromStockType IS NULL;


UPDATE stock_changes
SET toStockType = 'production_qty'
WHERE toStockType IS NULL;


COMMIT;

-- old migration --
UPDATE stock_changes
SET fromStockType = 'stock'
WHERE fromStockType = 'stock2';

UPDATE stock_changes
SET toStockType = 'stock'
WHERE toStockType = 'stock2';

UPDATE stock_changes
SET toStockType = 'production_qty'
WHERE toStockType = 'production_qty2';


COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('67-MU-Material_request-39.sql', CURRENT_TIMESTAMP);

COMMIT;
