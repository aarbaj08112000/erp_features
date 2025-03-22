-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 July, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


UPDATE `widget` SET `status` = 'Inactive' WHERE `widget`.`widget_id` = 34;
INSERT INTO `widget` (`widget_id`, `tab_name`, `widget_name`, `widget_type`, `widget_funtion`, `status`) VALUES (NULL, 'BusinessAnalytics', 'TODAY_SALES_BA', 'Block', 'get_today_sales', 'Active'), (NULL, 'BusinessAnalytics', 'YESTERDAYS_SALES_BA', 'Block', 'get_yesterdays_sales', 'Active'), (NULL, 'BusinessAnalytics', 'CURRENT_MONTH_SALE_BA', 'Block', 'get_current_month_sale', 'Active'), (NULL, 'BusinessAnalytics', 'FY_TOTAL_SALES_BA', 'Block', 'get_fy_total_sales', 'Active');
INSERT INTO `widget` (`widget_id`, `tab_name`, `widget_name`, `widget_type`, `widget_funtion`, `status`) VALUES (NULL, 'BusinessAnalytics', 'PURCHASE_STOCK_AMOUNT_BA', 'Block', 'get_purchase_stock_amount', 'Active'), (NULL, 'BusinessAnalytics', 'IN_HOUSE_PARTS_STOCK_BA', 'Block', 'get_in_house_parts_stock', 'Active'), (NULL, 'BusinessAnalytics', 'FG_STOCK_BA', 'Block', 'get_fg_stock', 'Active'), (NULL, 'BusinessAnalytics', 'SUBCON_STOCK_BA', 'Block', 'get_store_subcon_stock', 'Active');
INSERT INTO `widget` (`widget_id`, `tab_name`, `widget_name`, `widget_type`, `widget_funtion`, `status`) VALUES (NULL, 'BusinessAnalytics', 'PRODUCTION_BA', 'Spline', 'get_production_data', 'Active');
COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('84-Dashboard-Account-Widget-Add.sql', CURRENT_TIMESTAMP);

COMMIT;

