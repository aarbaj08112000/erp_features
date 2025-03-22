-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2024 at 04:26 AM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `cust_part_inspection_master` CHANGE `lower_spec_limit` `lower_spec_limit` VARCHAR(50) NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_master` CHANGE `upper_spec_limit` `upper_spec_limit` VARCHAR(50) NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `lower_spec_limit` `lower_spec_limit` VARCHAR(50) NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `upper_spec_limit` `upper_spec_limit` VARCHAR(50) NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `observation1` `observation1` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `observation2` `observation2` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `observation3` `observation3` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `observation4` `observation4` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `observation5` `observation5` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `cust_part_inspection_report` CHANGE `observation1` `observation1` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('46-PDI_Improvements.sql', CURRENT_TIMESTAMP);

COMMIT;
