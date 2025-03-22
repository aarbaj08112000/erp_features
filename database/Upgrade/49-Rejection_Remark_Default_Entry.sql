-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 Feb, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `reject_remark` (`id`, `name`, `created_by`, `created_date`, `created_time`, `deleted`) VALUES (-1, 'NA', '3', '02-10-2023', '07:10:00', '0');

ALTER TABLE `rejection_sales_invoice` ADD UNIQUE `rejection_sales_invoice_unique` (`rejection_invoice_no`(20));

ALTER TABLE `mold_production_rejection_details` DROP INDEX `rejection_unique`;

ALTER TABLE `mold_production_rejection_details` ADD UNIQUE `rejection_unique` (`molding_productionKy`, `rejection_reasonKy`, `cavity`);

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('49-Rejection_Remark_Default_Entry.sql', CURRENT_TIMESTAMP);


COMMIT;


