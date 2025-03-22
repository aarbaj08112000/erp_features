-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: April 25, 2023 at 09:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bsperp`
--

-- changes for sales report

ALTER TABLE `sales_parts` 
ADD `hsn_code` VARCHAR(20) DEFAULT NULL
AFTER `po_date`;

COMMIT;

-- Migrate customer_part HSNCode to Sales Part new filed

UPDATE `sales_parts` , `customer_part` 
set `sales_parts`.hsn_code = `customer_part`.hsn_code 
where `sales_parts`.part_id = `customer_part`.id;

COMMIT;

-- check for non numberic HSN code ---
/* SELECT *
FROM sales_parts 
WHERE `sales_parts`.hsn_code NOT REGEXP '^[0-9]+$';
*/

-- check data ---
/*  select distinct sales_parts.hsn_code as S_HSN, customer_part.hsn_code as C_HSN, sales_parts.part_id as part_id 
	FROM sales_parts, customer_part 
	where `sales_parts`.part_id = `customer_part`.id;
*/

COMMIT;