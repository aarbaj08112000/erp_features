-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/

-- Generation Time: June 25, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bsperp`
--

ALTER TABLE `parts_customer_trackings` 
	ADD `warehouse` VARCHAR(20) NULL DEFAULT NULL AFTER `status`, ADD `due_date` VARCHAR(20) NULL DEFAULT NULL AFTER `warehouse`;
	
ALTER TABLE `parts_customer_trackings` ADD `imported_price` FLOAT NULL DEFAULT NULL AFTER `status`;

ALTER TABLE `customer_part` ADD `thickness` FLOAT NULL DEFAULT '0';

ALTER TABLE `customer_part` ADD `passivationType` VARCHAR(50) NULL DEFAULT NULL AFTER `thickness`;

COMMIT;

