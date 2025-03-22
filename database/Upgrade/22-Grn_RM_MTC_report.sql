-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04th Sept, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- DB Upgrade TABLE

ALTER TABLE `grn_details` ADD `rm_batch_no` VARCHAR(50) 
NULL DEFAULT NULL AFTER `reject_qty`, ADD `mtc_report` TEXT NULL DEFAULT NULL AFTER `rm_batch_no`;

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('22', '22-Grn_RM_MTC_report.sql', CURRENT_TIMESTAMP);

COMMIT;
