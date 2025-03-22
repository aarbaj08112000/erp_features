-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Jan, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `machine_request` ADD `customer_parts_master_id` INT(11) NULL COMMENT 'Added for migration purpose only' AFTER `created_by`;


UPDATE `machine_request`
SET customer_parts_master_id = customer_part_id;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('44-Material_Request_Data_Migration', CURRENT_TIMESTAMP);

COMMIT;