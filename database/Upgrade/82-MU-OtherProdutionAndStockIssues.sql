-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `child_part` CHANGE `sub_con_stock` `old_sub_con_stock` FLOAT NULL DEFAULT NULL;

COMMIT;

ALTER TABLE `inhouse_parts` CHANGE `stock` `old_stock` FLOAT NOT NULL, CHANGE `onhold_stock` `old_onhold_stock` FLOAT NOT NULL, CHANGE `sub_con_stock` `old_sub_con_stock` FLOAT NULL DEFAULT NULL, CHANGE `rejection_stock` `old_rejection_stock` FLOAT NULL DEFAULT NULL, CHANGE `machine_mold_issue_stock` `old_machine_mold_issue_stock` INT(11) NULL DEFAULT NULL;

COMMIT;

/* 
SELECT * FROM `customer_parts_master` WHERE `part_number` in ('production_rejection', 'production_scrap');
SELECT * FROM `customer_parts_master_stock` WHERE `customer_parts_master_id` IN (241,242);
*/


INSERT INTO `customer_parts_master` (`part_number`, `part_description`, `old_fg_stock`, `old_fg_stock2`, `old_fg_stock3`, `fg_rate`, `molding_production_qty`, `production_rejection`, `production_scrap`, `semi_finished_location`, `deflashing_assembly_location`, `final_inspection_location`) 
VALUES ('production_rejection', 'production_rejection', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'), 
('production_scrap', 'production_scrap', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('82-MU-OtherProductionAndStockIssues.sql', CURRENT_TIMESTAMP);

COMMIT;


