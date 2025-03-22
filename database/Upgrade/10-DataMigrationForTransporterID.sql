-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: APRIL 25, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bsp`
--

-- SQL : SELECT DISTINCT `transporter` FROM `new_sales`

insert into `transporter`(`name`, `transporter_id`, `created_by`, `created_date`, `created_time`, `deleted`) 
select DISTINCT `transporter`,`transporter`,3, '26-04-2023','00:09:00', 0 FROM `new_sales`;

COMMIT;

-- Update transport entries into new_sales table --

update `new_sales`, `transporter` set `new_sales`.`transporter_id` = `transporter`.`id` 
where `new_sales`.`transporter` = `transporter`.`transporter_id`;

COMMIT;