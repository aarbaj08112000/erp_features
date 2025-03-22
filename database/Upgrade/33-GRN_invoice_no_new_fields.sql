-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 06:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

ALTER TABLE `inwarding` 
ADD `created_dttm` DATETIME NULL DEFAULT NULL AFTER `grn_number`, 
ADD `vehicle_number` VARCHAR(50) NULL DEFAULT NULL AFTER `created_dttm`, 
ADD `transporter` VARCHAR(50) NULL DEFAULT NULL AFTER `vehicle_number`;

/* 
	No migration script is added as of now for existing data.
	If needed that can be added based on client's response.
*/

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('33-GRN_invoice_no_new_fields.sql', CURRENT_TIMESTAMP);

COMMIT;
