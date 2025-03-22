-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 06:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- There was an issue in BSP where sales no were incorrect due to sequence of sales invoice lock.


ALTER TABLE `new_sales` ADD UNIQUE `SALES_NO_UNIQUE` (`sales_number`);

ALTER TABLE `new_sales` ADD `actualSalesNo` INT(11) NOT NULL AFTER `sales_number`;

Update `new_sales`
SET  actualSalesNo = substring_index(sales_number, '/', -1);

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('29', '29-Prod-Issue-Sales-invoice-series.sql', CURRENT_TIMESTAMP);

COMMIT;

-- 
/* Any migration or data correction script if needed.

Need to ensure new code is in place and also indexing etc.
If needed any migration to update incorrect data then it can be done using below:

SELECT * FROM `new_sales` a, `new_sales` b WHERE a.sales_number = b.sales_number and a.id <> b.id

UPDATE `new_sales` 
SET `sales_number` = 'BSP/23-24/1867-1', `actualSalesNo` = -3 
WHERE `id` = '1903'

UPDATE `sales_parts` SET `sales_number` = 'BSP/23-24/1867-1' WHERE `sales_id` = '1903'

UPDATE `new_sales` 
SET `sales_number` = 'BSP/23-24/1866-1' , `actualSalesNo` = -2 
WHERE `id` = '1902'

UPDATE `sales_parts` SET `sales_number` = 'BSP/23-24/1866-1' WHERE `sales_id` = '1902'

UPDATE `new_sales` 
SET `sales_number` = 'BSP/23-24/1863-1', `actualSalesNo` = -1 
WHERE `id` = '1899'

UPDATE `sales_parts` SET `sales_number` = 'BSP/23-24/1863-1' WHERE `sales_id` = '1899'

SELECT actualSalesNo FROM new_sales WHERE sales_number like 'BSP/23-24/%' order by actualSalesNo  desc LIMIT 1

*/