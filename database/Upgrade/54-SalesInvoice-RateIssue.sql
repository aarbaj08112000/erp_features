-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01 April, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- ------------------------------
-- ---- Master table for Address

ALTER TABLE `sales_parts` CHANGE `total_rate` `total_rate` DOUBLE NULL DEFAULT NULL;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('54-SalesInvoice-RateIssue.sql', CURRENT_TIMESTAMP);

COMMIT;