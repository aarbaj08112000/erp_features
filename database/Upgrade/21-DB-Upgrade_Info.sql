-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04th Sept, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- DB Upgrade TABLE


CREATE TABLE `DB_Upgrade` ( `id` INT NOT NULL , `Script_name` VARCHAR(50) NOT NULL , `updated_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('21', '21-DB-Upgrade_Info', CURRENT_TIMESTAMP);

COMMIT;
