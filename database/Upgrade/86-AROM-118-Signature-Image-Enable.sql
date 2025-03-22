-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 July, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


INSERT INTO `global_configuration` (`id`, `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES (NULL, 'Signature Image', 'SignatureImage', '-', '1', '0', 'use to add signature in pdf ', '1', CURRENT_TIMESTAMP, '');
INSERT INTO `global_configuration` (`id`, `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES (NULL, 'Signature Image Enable', 'SignatureImageEnable', 'No', '1', '0', 'use to signature image enable in pdf', '1', CURRENT_TIMESTAMP, '');
COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('86-AROM-118-Signature-Image-Enable.sql', CURRENT_TIMESTAMP);

COMMIT;

