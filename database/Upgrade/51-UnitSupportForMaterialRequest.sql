-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 March, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `machine_request` ADD `delivery_unit` INT(11) NULL DEFAULT NULL AFTER `customer_parts_master_id`;

-- Data migration
-- IMP : ONE TIME MIGRATION --
UPDATE `machine_request`
SET `delivery_unit` = ( SELECT id 
FROM client
ORDER BY id asc limit 1);

ALTER TABLE `machine_request` 
ADD CONSTRAINT `FK_deliveryUnit` 
FOREIGN KEY (`delivery_unit`) REFERENCES `client`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;



INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('51-UnitSupportForMaterialRequest.sql', CURRENT_TIMESTAMP);


COMMIT;


