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

ALTER TABLE grn_details
ADD CONSTRAINT unique_grn_details UNIQUE (inwarding_id,po_number,grn_number,invoice_number,part_id);

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('37-GRN_Details-uniqueness.sql', CURRENT_TIMESTAMP);


COMMIT;