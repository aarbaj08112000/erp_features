-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 Feb, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `global_configuration` (`displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES
('Inward Inspection Doc Number', 'inwardDocNumber', 'QA-F-01', 1, 0, 'Inward Inspection Doc Number', 1, '2024-02-20 17:06:11', 'arom'),
('Inward Inspection Doc Date', 'inwardDocDate', '3/3/2017', 1, 0, 'Inward Inspection Doc Date', 1, '2024-02-20 17:06:47', 'arom'),
('Inward Inspection Doc Revision', 'inwardDocRevision', '00', 1, 0, 'Inward Inspection Doc Revision', 1, '2024-02-20 17:08:50', 'arom'),
('Show document details on different flows', 'showDocRequestDetails', 'false', 1, 1, 'Show document details on different flowsm values - true or false', 1, '2024-02-20 17:08:50', 'arom');


INSERT INTO `global_configuration` (`id`, `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES (NULL, 'PDIFormat', 'PDIFormat', 'QA-F-03', '1', '0', 'PDIFormat', '1', CURRENT_TIMESTAMP, 'arom');


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('48-GlobalConfigForFormatNos.sql', CURRENT_TIMESTAMP);


COMMIT;


