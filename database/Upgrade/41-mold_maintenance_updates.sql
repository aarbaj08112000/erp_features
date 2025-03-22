-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2024 at 08:43 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


ALTER TABLE `mold_maintenance` 
ADD `mold_name` VARCHAR(255) NOT NULL AFTER `target_life`, 
ADD `doc` VARCHAR(255) NULL DEFAULT NULL AFTER `target_over_life`, 
ADD `pm_date` VARCHAR(255) NULL DEFAULT NULL AFTER `doc`, 
ADD `current_molding_prod_qty` INT(11) NULL DEFAULT NULL AFTER `pm_date`;

COMMIT;

ALTER TABLE `mold_maintenance` 
ADD `ownership` ENUM('Customer','Client') NOT NULL AFTER `mold_name`;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('41-mold_maintenance_updates.sql', CURRENT_TIMESTAMP);

COMMIT;

