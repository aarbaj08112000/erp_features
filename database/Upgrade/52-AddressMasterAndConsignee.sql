-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 March, 2024 at 02:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

-- this can be added as default script 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- ------------------------------
-- ---- Master table for Address

CREATE TABLE `address_master`
             (
                          `id`       INT(11) NOT NULL
                        , `address`  VARCHAR(250) NULL DEFAULT NULL
                        , `location` VARCHAR(50) NOT NULL
                        , `state`    VARCHAR(20) NOT NULL
                        , `state_no` VARCHAR(20) NOT NULL
                        , `pin_code` VARCHAR(10) NOT NULL
                        , `addressType` ENUM('client','customer','supplier','consignee') NULL DEFAULT NULL
                        , `created_dttm` DATETIME NOT NULL
                        , `updatedttm`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
                        , `updated_user` VARCHAR(255) NULL
             )
             ENGINE = InnoDB
;

ALTER TABLE `address_master` ADD PRIMARY KEY (`id`);

ALTER TABLE `address_master` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `consignee`
--

CREATE TABLE `consignee`
             (
                          `id`             INT(11) NOT NULL AUTO_INCREMENT
                        , `consignee_name` VARCHAR(100) NOT NULL
                        , `pan_no`         VARCHAR(20) NOT NULL
                        , `phone_no`       VARCHAR(50) NOT NULL
                        , `gst_number`     VARCHAR(50) NOT NULL
                        , `address_id`     INT(11) NOT NULL
                        , `deleted`        INT(2) NOT NULL
                        , `created_dttm`   DATETIME NOT NULL
                        , `updatedttm`     DATETIME NOT NULL
                        , `updated_user`   VARCHAR(255) NOT NULL
                        , PRIMARY KEY (`id`)
             )
             ENGINE = InnoDB
;

ALTER TABLE `consignee` ADD `location` VARCHAR(50) NOT NULL AFTER `consignee_name`;

ALTER TABLE `consignee` 
ADD CONSTRAINT `fk_consignee_address` FOREIGN KEY (`address_id`) 
REFERENCES `address_master`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `consignee` ADD UNIQUE `unique_consignee` (`consignee_name`, `location`);

COMMIT;


INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) VALUES ('52-AddressMasterAndConsignee.sql', CURRENT_TIMESTAMP);

COMMIT;