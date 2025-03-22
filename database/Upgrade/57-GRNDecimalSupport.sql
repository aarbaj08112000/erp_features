-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 April, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

COMMIT;

ALTER TABLE `grn_details` CHANGE `qty` `qty` FLOAT(11) NOT NULL;

ALTER TABLE `subcon_po_inwarding_parts` CHANGE `inwarding_qty` `inwarding_qty` FLOAT(11) NOT NULL;

ALTER TABLE `subcon_po_inwarding` CHANGE `inwarding_qty` `inwarding_qty` FLOAT(11) NOT NULL;

COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('57-GRNDecimalSupport.sql', CURRENT_TIMESTAMP);

COMMIT;


