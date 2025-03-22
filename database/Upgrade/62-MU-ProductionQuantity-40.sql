-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

-- TO-DO NEED UNIQUENESS ----
ALTER TABLE `sharing_issue_request` ADD `clientId` INT NOT NULL AFTER `id`;

UPDATE `sharing_issue_request`
SET clientId = 1
WHERE clientId = 0;

COMMIT;

-- Need to update column to zero
UPDATE `child_part`
SET deleted = 0
WHERE deleted is NULL;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('62-MU-ProductionQuantity-40.sql', CURRENT_TIMESTAMP);

COMMIT;


