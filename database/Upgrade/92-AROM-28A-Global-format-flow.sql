-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 05:24 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `global_formate_configuration`
--

CREATE TABLE `global_formate_configuration` (
  `id` int NOT NULL,
  `display_label` varchar(255) NOT NULL,
  `config_name` varchar(255) NOT NULL,
  `is_year_enable` enum('Yes','No') NOT NULL,
  `count_start_from` int NOT NULL,
  `formate` varchar(255) NOT NULL,
  `formate_structure` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `arom_user_only` int NOT NULL,
  `acces_to_modify` int NOT NULL,
  `added_by` int NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `global_formate_configuration`
--
ALTER TABLE `global_formate_configuration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `global_formate_configuration`
--
ALTER TABLE `global_formate_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;



INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('92-AROM-28A-Global-format-flow.sql', CURRENT_TIMESTAMP);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;