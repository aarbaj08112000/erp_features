-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 July, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Script for updating default entry as per latest code check for deleted column

UPDATE customer_part
SET deleted = 0
WHERE deleted is null;

ALTER TABLE `customer_part` CHANGE `deleted` `deleted` INT(11) NULL DEFAULT '0';

COMMIT;

ALTER TABLE `child_part` CHANGE `deleted` `deleted` INT(11) NULL DEFAULT '0';

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('85-UpdateCustomerPartTable.sql', CURRENT_TIMESTAMP);

COMMIT;