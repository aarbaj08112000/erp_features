-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 07:05 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------
INSERT INTO `global_configuration`(
  `id`, `displayLabel`, `config_name`, 
  `config_value`, `isActive`, `ARMUserOnly`, 
  `note`, `canModify`, `updatedttm`, 
  `updated_user`
) 
VALUES 
  (
    null, 'SMTP User Name', 'SMTPUserName', 
    '', 1, 1, 'use smtp username', 1, now(), 
    'Admin'
  ), 
  (
    null, 'SMTP User Password', 'SMTPUserPassword', 
    '', 1, 1, 'use smtp password', 1, now(), 
    'Admin'
  ), 
  (
    null, 'Sales Report Send Emails', 
    'SalesReportSenderEmail', '', 
    1, 1, 'user email to send sales report', 1, now(), 
    'Admin'
  ), 
  (
    null, 'Send Sales Report Email Enable', 
    'EnableSalesReportEmail', 'Yes', 
    1, 1, 'use smtp username', 1, now(), 
    'Admin'
  );


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('90-AROM-59A-Daily-Sales-Mail-To-User.sql', CURRENT_TIMESTAMP);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
