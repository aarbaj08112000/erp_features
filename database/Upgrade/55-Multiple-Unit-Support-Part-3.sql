-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 April, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `child_part` CHANGE `machine_mold_issue_stock` `machine_mold_issue_stock` FLOAT NOT NULL DEFAULT '0';

ALTER TABLE `child_part` 
ADD `machine_mold_issue_stock2` FLOAT NOT NULL DEFAULT '0' AFTER `machine_mold_issue_stock`, 
ADD `machine_mold_issue_stock3` FLOAT NOT NULL DEFAULT '0' AFTER `machine_mold_issue_stock2`;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('55-Multiple-Unit-Support-Part-3.sql', CURRENT_TIMESTAMP);

COMMIT;