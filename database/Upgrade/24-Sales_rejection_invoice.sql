-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25th Sept, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------------------------------------
-- Add new fields for Rejection Invoices

ALTER TABLE `rejection_sales_invoice`  
CHANGE `document_number` `document_number` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `customer_id`;

ALTER TABLE `rejection_sales_invoice` 
ADD `debit_note_date` VARCHAR(20) NOT NULL AFTER `sales_invoice_number`, 
ADD `client_invoice_date` VARCHAR(20) NOT NULL AFTER `debit_note_date`, 
ADD `debit_basic_amt` FLOAT NOT NULL AFTER `client_invoice_date`, 
ADD `debit_gst_amt` FLOAT NOT NULL AFTER `debit_basic_amt`, 
ADD `rejection_reasonky` INT(11) NOT NULL AFTER `debit_gst_amt`;

ALTER TABLE `rejection_sales_invoice` 
CHANGE `sales_invoice_number` `sales_invoice_number` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `debit_note_date`;

ALTER TABLE `rejection_sales_invoice` 
ADD `rejection_invoice_no` VARCHAR(20) NOT NULL AFTER `id`;

-- In case there is any existing DATABASE then use below query to insert right data.
-- INSERT INTO `reject_remark` 
-- (`id`, `name`, `created_by`, `created_date`, `created_time`, `deleted`) VALUES ('7', 'NA', '3', CURRENT_DATE(), CURRENT_DATE(), '0');

-- UPDATE `rejection_sales_invoice`
-- SET rejection_reasonky = 7
-- WHERE rejection_reasonky =0;

ALTER TABLE `rejection_sales_invoice` 
ADD CONSTRAINT `rejection_remark_fk` FOREIGN KEY (`rejection_reasonky`) REFERENCES `reject_remark`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `rejection_sales_invoice` CHANGE `remark` `remark` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('24', '24-Sales_rejection_invoice.sql', CURRENT_TIMESTAMP);

COMMIT;
