-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `challan_subcon` ADD `clientId` INT(11) NOT NULL AFTER `id`;

COMMIT;

UPDATE `challan_subcon` 
SET `clientId` = 1
WHERE `clientId` = 0;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('73-MU-Challan-SubCon-23.sql', CURRENT_TIMESTAMP);

COMMIT;
