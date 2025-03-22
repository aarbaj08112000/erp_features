-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 Nov, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28
-- this can be added as default script
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


ALTER TABLE `customer` ADD `emailId` TEXT NULL DEFAULT NULL AFTER `pin`;

COMMIT;

ALTER TABLE `client` ADD `emailId` TEXT NULL DEFAULT NULL AFTER `pin`;

COMMIT;

INSERT INTO `global_configuration`
       (`id`
            , `displayLabel`
            , `config_name`
            , `config_value`
            , `isActive`
            , `ARMUserOnly`
            , `note`
            , `canModify`
            , `updatedttm`
            , `updated_user`
       )
       VALUES
       (NULL
            , 'Sales Invoice CC email addresses.'
            , 'SalesInvoiceCCEmailAddress'
            , ''
            , '1'
            , '1'
            , 'Sales team group email addresses which will be added in CC for sales invoice emails to customers. Comma separated list for multiple email addresses.'
            , '1'
            , '2024-11-16 16:49:55'
            , 'Admin'
       );
         
COMMIT;

INSERT INTO `global_configuration` (`id`, `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`) VALUES (NULL, 'Enable Email notification', 'enable_email_notification', 'No', '1', '1', 'Enable email notifications across different workflows e.g. Sales Invoice\r\nSupport Values : Yes/No', '1', '2024-11-16 10:40:24', 'Admin');

COMMIT;

INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('101-AROM-22-SalesInvoiceEmailAsAttachment.sql'
            , CURRENT_TIMESTAMP
       )
;

COMMIT;