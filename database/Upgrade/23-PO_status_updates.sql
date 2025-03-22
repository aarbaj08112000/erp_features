-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08th Sept, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------------------------------------
-- Update PO table to correct the status spelling mistake - This need has code changes too

select count(*) from `new_po` where status ='accpet';

update `new_po`
set status ='accept'
where status ='accpet';

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('23', '23-PO_status_updates.sql', CURRENT_TIMESTAMP);

COMMIT;
