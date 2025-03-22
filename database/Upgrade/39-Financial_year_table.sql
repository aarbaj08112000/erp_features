-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 Dec, 2023 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `financialyear` (
`id` SMALLINT NOT NULL AUTO_INCREMENT , 
`startYear` SMALLINT(4) NOT NULL , 
`endYear` SMALLINT NOT NULL , 
`displayName` VARCHAR(15) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO 
`financialyear` (`startYear`, `endYear`, `displayName`) 
VALUES 
('2022', '2023', 'FY-2022'), 
('2023', '2024', 'FY-2023'),
('2024', '2025', 'FY-2024');

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('39-Financial_year_table.sql', CURRENT_TIMESTAMP);


COMMIT;