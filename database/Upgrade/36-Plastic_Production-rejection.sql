-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 4 Dec, 2023 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `mold_production_rejection_details` ADD `cavity` VARCHAR(50) NULL DEFAULT NULL AFTER `rejection_qty`;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('36-Plastic_Production-rejection.sql', CURRENT_TIMESTAMP);

COMMIT;