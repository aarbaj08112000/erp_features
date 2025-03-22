-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: APRIL 10, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";

--
-- Database: `bsp`
--

-- --------------- Update customer_part table for address details --------------------
ALTER TABLE `customer_part` 
ADD `isservice` ENUM('N','Y') NOT NULL DEFAULT 'N' 
AFTER `customer_parts_master_id`;

commit;

-- --------------- Update customer_part table Ends ------------------------- --------------------------