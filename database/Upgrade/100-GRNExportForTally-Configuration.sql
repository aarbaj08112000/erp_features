-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 4 Oct, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


INSERT INTO `global_configuration` (`displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES ('Do you need inventory details in GRN Export', 'isGrnExportWithInventory' ,'Yes', '1', '0', 'Tally integration with inventory details \n Supported Values: Yes / No. If No then GRN will be exported with Voucher type.', '1', CURRENT_TIMESTAMP, 'Admin');


COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('100-GRNExportForTally-Configuration.sql', CURRENT_TIMESTAMP);

COMMIT;

