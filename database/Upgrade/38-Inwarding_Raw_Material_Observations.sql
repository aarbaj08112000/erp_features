-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Dec, 2023 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `raw_material_inspection_report` 
ADD `observation2` VARCHAR(255) NULL DEFAULT NULL AFTER `observation`, 
ADD `observation3` VARCHAR(255) NULL DEFAULT NULL AFTER `observation2`, 
ADD `observation4` VARCHAR(255) NULL DEFAULT NULL AFTER `observation3`, 
ADD `observation5` VARCHAR(255) NULL DEFAULT NULL AFTER `observation4`;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('38-Inwarding_Raw_Material_Observations.sql', CURRENT_TIMESTAMP);


COMMIT;