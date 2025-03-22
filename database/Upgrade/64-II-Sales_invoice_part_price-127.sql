-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

UPDATE `sales_parts` 
SET `basic_total` = (`total_rate` - `gst_amount`)
WHERE `basic_total` is NULL or `basic_total` = 0;

/*
SELECT (`total_rate` - `gst_amount`) as basic_total 
FROM `sales_parts` order by id desc

SELECT ((`total_rate` - `gst_amount`) / `qty`)  as part_price, basic_total/qty as new_part_price
FROM `sales_parts` order by id desc 
*/

UPDATE `sales_parts` 
SET part_price = (basic_total/qty)
WHERE part_price is NULl or part_price = 0 ;


COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('64-II-Sales_invoice_part_price-127.sql', CURRENT_TIMESTAMP);

COMMIT;