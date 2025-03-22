-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14th Oct, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------------------------------------
-- Update Debit Note date field to optional 

ALTER TABLE `rejection_sales_invoice` CHANGE `debit_note_date` `debit_note_date` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('31-Rejection_Invoice_OptionalFields', CURRENT_TIMESTAMP);

COMMIT;
