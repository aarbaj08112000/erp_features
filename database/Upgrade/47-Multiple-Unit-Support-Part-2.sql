-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Feb, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `global_configuration` (`id`, `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES (NULL, 'Multiple Unit Support', 'isMultipleClientUnits', 'No', '1', '1', 'Supporting Multiple client units, Supported values = true or false', '1', current_timestamp(), 'arom'), (NULL, 'TempLabel', 'field_name', '', '1', '0', NULL, '0', current_timestamp(), '');

ALTER TABLE `stock_changes` ADD `fromUnit` VARCHAR(50) NULL DEFAULT NULL AFTER `qty`, ADD `toUnit` VARCHAR(50) NULL DEFAULT NULL AFTER `fromUnit`;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('47-Multiple-Unit-Support-Part-2.sql', CURRENT_TIMESTAMP);


COMMIT;


