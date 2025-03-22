-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 12:01 PM
-- Server version: 8.0.40-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------
ALTER TABLE `global_configuration` ADD `category` ENUM('Sales', 'Customer', 'PO') NOT NULL AFTER `updated_user`, ADD `type` ENUM('radio', 'input', 'file') NOT NULL AFTER `category`;

INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('113-AROM-Global-Configration-category-changes.sql'
            , CURRENT_TIMESTAMP
       )
;

