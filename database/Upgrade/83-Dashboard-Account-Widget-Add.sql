-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 June, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


INSERT INTO `widget` (`tab_name`, `widget_name`, `widget_type`, `widget_funtion`, `status`) VALUES 
('Account', 'TOTAL_RECEIVABLES_DUE_GST', 'Block', 'get_total_receivable_due_gst', 'Active'),
('BusinessAnalytics', 'TOTAL_RECEIVABLES_PAID_BA', 'Block', 'get_total_receivable_paid', 'Active'), 
('BusinessAnalytics', 'TOTAL_RECEIVABLES_DUE_GST_BA', 'Block', 'get_total_receivable_due_gst', 'Active');
COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('83-Dashboard-Account-Widget-Add.sql', CURRENT_TIMESTAMP);

COMMIT;

