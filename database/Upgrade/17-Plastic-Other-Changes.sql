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
-- Plastic issues  & improvements - add rejection_qty, shift ppt

ALTER TABLE `molding_production` ADD `rejection_qty` FLOAT NOT NULL DEFAULT '0' COMMENT 'Rejection Quantity' AFTER `qty`;

ALTER TABLE `shifts` ADD `ppt` DECIMAL(10,0) NOT NULL DEFAULT '0' COMMENT 'Planned Production time' AFTER `shift_type`;

COMMIT;
