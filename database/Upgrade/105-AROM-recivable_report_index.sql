-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 Nov, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28
-- this can be added as default script
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `sales_parts` ADD INDEX(`sales_id`);
ALTER TABLE `receivable_report` ADD INDEX(`sales_number`);
ALTER TABLE `sales_parts` ADD INDEX(`customer_id`);
ALTER TABLE `sales_parts` ADD INDEX(`sales_number`);

INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('105-AROM-recivable_report_index.sql'
            , CURRENT_TIMESTAMP
       )
;

COMMIT;