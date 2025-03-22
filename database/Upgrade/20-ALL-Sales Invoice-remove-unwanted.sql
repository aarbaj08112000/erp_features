-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26st Aug, 2023 at 08:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Remove unwanted columns


ALTER TABLE `new_sales`
  DROP `po_date`,
  DROP `expiry_po_date`,
  DROP `po_number`,
  DROP `e_invoice_number`;
  

COMMIT;
