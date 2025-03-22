-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14 Dec, 2023 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

UPDATE `grn_details`
SET grn_number = '';

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('43-GRN_Number-uniqueness', CURRENT_TIMESTAMP);

COMMIT;