-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 4 Jan, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `client` ADD `client_unit` VARCHAR(50) NULL DEFAULT NULL AFTER `id`;

ALTER TABLE `child_part` ADD `stock2` FLOAT NULL AFTER `stock`, ADD `stock3` FLOAT NULL AFTER `stock2`;

ALTER TABLE `child_part` ADD `production_qty2` FLOAT NULL AFTER `production_qty`, ADD `production_qty3` FLOAT NULL AFTER `production_qty2`;

-- Inwarding changes for delivery location
ALTER TABLE `inwarding` ADD `delivery_unit` VARCHAR(30) NULL AFTER `transporter`;

-- Migration script 
-- Migrate all the existing inwardings to default client i.e. first client created in system.
-- This shouldn't be run multiple times
Update `inwarding`
SET `delivery_unit` = (SELECT `client_unit` from `client` order by id asc limit 1)
WHERE `delivery_unit` is null;

Update `inwarding` 
SET `delivery_unit` = (SELECT `client_unit` from `client` order by id asc limit 1) 
WHERE `delivery_unit` not in (SELECT `client_unit` from `client`);


-- CREATE TABLE `part_unit_stock` (`id` INT NOT NULL , `client_id` INT NOT NULL , `child_part_id` INT NOT NULL , `stock` INT NOT NULL );
-- ALTER TABLE `part_unit_stock` ADD PRIMARY KEY (`id`);
-- ALTER TABLE `part_unit_stock` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
-- ADD UNIQUE `client_unit_uq` (`client_unit`(50));
-- ALTER TABLE `child_part` ADD `client_unit` INT(11) NULL DEFAULT NULL AFTER `id`;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('40-Multiple Unit Support.sql', CURRENT_TIMESTAMP);


COMMIT;