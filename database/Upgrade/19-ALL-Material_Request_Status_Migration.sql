-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17st Aug, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Migration script for update status for completed child part machine requests.

UPDATE machine_request
SET status = 'completed'
WHERE id not in (
	SELECT machine_request_id 
	FROM machine_request_parts 
	WHERE status!='completed'
);


UPDATE machine_request
SET status = 'Completed'
WHERE status = 'completed';


UPDATE machine_request_parts
SET status = 'Completed'
WHERE status = 'completed';

COMMIT;
