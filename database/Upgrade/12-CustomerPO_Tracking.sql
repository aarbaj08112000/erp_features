-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/

-- Generation Time: May 27, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `bsperp`
--
-- Future scope : May need to change status value from closed to Closed
-- Future scope : May need to change status value from pending to In-Process/In-Progress

ALTER TABLE `customer_po_tracking` ADD `uploadedDoc` TEXT NULL DEFAULT NULL AFTER `po_amendment_date`;

ALTER TABLE `customer_po_tracking` ADD `remark` VARCHAR(50) NULL DEFAULT NULL AFTER `uploadedDoc`, ADD `reason` VARCHAR(10) NULL DEFAULT NULL AFTER `remark`;

COMMIT;
