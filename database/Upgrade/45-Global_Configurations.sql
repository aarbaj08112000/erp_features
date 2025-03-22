-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2024 at 04:26 AM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `global_configuration`
--

CREATE TABLE `global_configuration` (
  `id` int(11) NOT NULL,
  `displayLabel` varchar(100) NOT NULL DEFAULT 'TempLabel',
  `config_name` varchar(100) NOT NULL DEFAULT 'field_name',
  `config_value` text NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `ARMUserOnly` tinyint(1) NOT NULL DEFAULT '0',
  `note` text,
  `canModify` tinyint(1) NOT NULL DEFAULT '0',
  `updatedttm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `global_configuration` (`id`, `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES
(1, 'Customer Prefix', 'customerPrefix', 'AROMP', 1, 1, 'CustomerPrefix - Don\'t change without knowledge', 0, '2024-01-28 11:08:40', 'AROM'),
(2, 'Customer Name', 'customerNameDetails', 'AROM PLASTIC', 1, 0, 'Display name for invoices, reports etc.', 1, '2024-01-28 11:08:40', 'arom'),
(3, 'CUSTOMER TYPE', 'AROMCustomerName', 'COMMON_PLASTIC', 1, 1, 'Configure current customer type Don\'t change without knowing', 0, '2024-01-28 11:08:40', 'AROM'),
(4, 'Enable PDI Random Generator', 'isPDIRandomGeneratorEnabled', 'true', 1, 0, 'Config value should be true or false only', 1, '2024-01-28 04:16:27', 'arom'),
(5, 'PDI Revision No', 'PDIRevision', '1.0', 1, 0, 'Revision No', 1, '2024-01-28 04:17:01', 'arom'),
(6, 'PDI Revision Date', 'PDIRevDate', '15/10/2023', 1, 0, 'PDI Revision Date', 1, '2024-01-28 04:19:44', 'arom');

--
-- Indexes for table `global_configuration`
--
ALTER TABLE `global_configuration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_config_name` (`config_name`);

--
-- AUTO_INCREMENT for table `global_configuration`
--
ALTER TABLE `global_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;


INSERT INTO `userinfo` (`id`, `user_email`, `type`, `user_role`, `user_name`, `user_password`, `date`, `time`, `timestamp`, `deleted`, `drawing_download`, `drawing_upload`) VALUES (NULL, 'arom@infotech.com', 'Admin', 'AROM', 'arom', 'arom321', NULL, NULL, current_timestamp(), NULL, 'yes', 'yes');
	
	
INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('45-Global_Configurations', CURRENT_TIMESTAMP);

COMMIT;
