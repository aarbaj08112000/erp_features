-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 March, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


INSERT INTO `global_configuration` (`displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES
('Enable Stock Update', 'enableStockUpdate', 'false', 1, 1, 'Enable Stock Update For Child Part, Inhouse parts, Customer Part Stock', 1, '2024-03-10 09:39:23', 'arom');

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('50-GlobalConfig-StockUpdate.sql', CURRENT_TIMESTAMP);


COMMIT;


