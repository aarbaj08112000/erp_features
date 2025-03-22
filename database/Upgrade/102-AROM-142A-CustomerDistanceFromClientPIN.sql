-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Nov, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28
-- this can be added as default script
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- 'Distance of customer PIN from Client1 PIN';
ALTER TABLE `customer` ADD `distncFrmClnt1` DECIMAL(10) NOT NULL DEFAULT '0' COMMENT 'Distance of customer PIN from Client1 PIN' AFTER `discountType`;

ALTER TABLE `customer` ADD `distncFrmClnt2` DECIMAL(10) NOT NULL DEFAULT '0' COMMENT 'Distance of customer PIN from Client2 PIN' AFTER `distncFrmClnt1`;

ALTER TABLE `customer` ADD `distncFrmClnt3` DECIMAL(10) NOT NULL DEFAULT '0' COMMENT 'Distance of customer PIN from Client2 PIN' AFTER `distncFrmClnt2`;

COMMIT;

ALTER TABLE `consignee` 
ADD `distncFrmClnt1` DECIMAL(10) NOT NULL DEFAULT '0' COMMENT 'Distance of customer PIN from Client1 PIN' AFTER `address_id`, 
ADD `distncFrmClnt2` DECIMAL(10) NOT NULL DEFAULT '0' COMMENT 'Distance of customer PIN from Client2 PIN' AFTER `distncFrmClnt1`, 
ADD `distncFrmClnt3` DECIMAL(10) NOT NULL DEFAULT '0' COMMENT 'Distance of customer PIN from Client3 PIN' AFTER `distncFrmClnt2`;

COMMIT;

INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('102-AROM-142A-CustomerDistanceFromClientPIN.sql'
            , CURRENT_TIMESTAMP
       )
;

COMMIT;