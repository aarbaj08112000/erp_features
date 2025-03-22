-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2024 at 10:20 PM
-- Server version: 8.0.36-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-68+ubuntu20.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

INSERT INTO `global_configuration` ( `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updated_user`) VALUES
('Digital Signature Url', 'digital_signature_url', 'https://usgwstage.truecopy.in/api/tsm/v3/signpdfdoc', 1, 1, 'Digital signature URL', 0, 'Admin'),
('Digital Signature Signer', 'signer', 'helpdesk+pocarominfotechapiuser@truecopy.com', 1, 1, 'Digital signature details', 0, 'Admin'),
('Digital Signature Certificate Password', 'certpwd', 'Tc%9pxL7qYeGXW/KjN7GpkofKy22PQ==', 1, 1, 'Digital signature credentails', 0, 'Admin'),
('Digital Signature Certificate Id', 'certid', 'john_doe_test_2_gcp', 1, 1, 'Digital signature certificate', 0, 'Admin'),
('Digital Signature', 'digitalSignature', 'No', 1, 1, 'Enable/disable Digital signature. Config value should be Yes or No only.', 0, 'Admin'),
('Company Logo Enable', 'companyLogoEnable', 'Yes', 1, 0, 'Enable logo for invoice.\r\nConfig value should be Yes or No only.', 0, 'Admin'),
('Company Logo', 'companyLogo', 'favicona3.png', 1, 0, 'Logo details for invoice', 1, 'Admin');
COMMIT;

INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('79-Sales_invoice-LogoAndDigitalSignature.sql', CURRENT_TIMESTAMP);
COMMIT;