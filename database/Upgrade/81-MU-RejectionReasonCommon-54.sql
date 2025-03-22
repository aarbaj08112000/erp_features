-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 May, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `reject_remark`
  DROP `clientId`;

COMMIT;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('81-MU-RejectionReasonCommon-54.sql', CURRENT_TIMESTAMP);

COMMIT;


