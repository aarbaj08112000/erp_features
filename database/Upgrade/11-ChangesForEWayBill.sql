-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: APRIL 28, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bsperp`
--

ALTER TABLE `einvoice_res` CHANGE `e_way_bill_remark` `EwbUpdateRemark` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `einvoice_res` CHANGE `Remarks` `EwbUpdateReason` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `einvoice_res` CHANGE `EwbNo` `EwbNo` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `CancelReason`;

ALTER TABLE `einvoice_res` CHANGE `EwbDt` `EwbDt` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `EwbNo`;

ALTER TABLE `einvoice_res` CHANGE `EwbUpdateRemark` `EwbUpdateRemark` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `EwbDt`;

ALTER TABLE `einvoice_res` CHANGE `EwbValidTill` `EwbValidTill` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `EwbDt`;

ALTER TABLE `einvoice_res` CHANGE `EwbUpdateReason` `EwbUpdateReason` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `EwbValidTill`;

ALTER TABLE `einvoice_res` ADD `EwbCancelReason` VARCHAR(50) NULL DEFAULT NULL AFTER `EwbUpdateRemark`, ADD `EwbCancelRemark` VARCHAR(50) NULL DEFAULT NULL AFTER `EwbCancelReason`;

ALTER TABLE `einvoice_res` ADD `EwbVehUpdDate` VARCHAR(100) NULL DEFAULT NULL AFTER `EwbValidTill`;

ALTER TABLE `einvoice_res` ADD `EwbStatus` VARCHAR(50) NULL DEFAULT NULL AFTER `EwbCancelRemark`;

ALTER TABLE `einvoice_res` ADD `updatedDttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_date`;

COMMIT;


-- Need to work on migration strategy here for existing records ---- specially
update einvoice_res
set EwbStatus = 'ACTIVE'
where EwbNo is not null;

COMMIT;


-- SELECT * FROM `einvoice_res` WHERE `EwbNo` IS NULL