-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 1st Aug, 2023 at 10:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- FG Stock report - dashboard 

ALTER TABLE `customer_parts_master` ADD `fg_rate` FLOAT NULL DEFAULT '0' COMMENT 'Per Unit rate for FG stock report' AFTER `fg_stock`;

COMMIT;
