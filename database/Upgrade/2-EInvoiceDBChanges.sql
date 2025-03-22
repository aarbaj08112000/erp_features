-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 07:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Have needful changes for BSP to support EINVOICE ---

--
-- Table structure for table `einvoice_res`
--

CREATE TABLE `einvoice_res` (
  `id` int(11) NOT NULL,
  `new_sales_id` int(11) NOT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `EwbNo` varchar(100) DEFAULT NULL,
  `ack_date` varchar(100) DEFAULT NULL,
  `SellerGstin` varchar(100) DEFAULT NULL,
  `BuyerGstin` varchar(100) DEFAULT NULL,
  `DocNo` varchar(100) DEFAULT NULL,
  `DocTyp` varchar(100) DEFAULT NULL,
  `DocDt` varchar(100) DEFAULT NULL,
  `TotInvVal` varchar(100) DEFAULT NULL,
  `ItemCnt` varchar(100) DEFAULT NULL,
  `MainHsnCode` varchar(100) DEFAULT NULL,
  `AckDt` varchar(100) DEFAULT NULL,
  `IrnDt` varchar(100) DEFAULT NULL,
  `iss` varchar(100) DEFAULT NULL,
  `EwbDt` varchar(100) DEFAULT NULL,
  `Irn` varchar(100) DEFAULT NULL,
  `EwbValidTill` varchar(100) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `SignedQRCode` text,
  `AckNo` varchar(100) DEFAULT NULL,
  `SignedInvoice` varchar(100) DEFAULT NULL,
  `info` varchar(100) DEFAULT NULL,
  `statuscode` varchar(100) DEFAULT NULL,
  `CancelRemark` varchar(100),
  `CancelReason` int(11),
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indexes for table `einvoice_res`
--
ALTER TABLE `einvoice_res`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `einvoice_res`
--
ALTER TABLE `einvoice_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



-- --------------- Update client (Supplier) table for address details --------------------
ALTER TABLE `client`
ADD `address1` varchar(100) NOT NULL,
ADD `location` varchar(50) NOT NULL,
ADD `pin` varchar(10) NOT NULL;

commit;

-- -------------- Update customer (Buyer) table for address details --------------------
ALTER TABLE `customer`
ADD `pos` varchar(10) NOT NULL,
ADD `address1` varchar(100) NOT NULL,
ADD `location` varchar(50) NOT NULL,
ADD `pin` varchar(10) NOT NULL;

commit;

-- --------------- Update new_sales table for distance details --------------------------
ALTER TABLE `new_sales`
ADD `distance` varchar(20) NOT NULL;

commit;

/* 

IMPORTANT : This is already done through Vanila DB copy but kept for reference for using it to other customers.
-- --------------- Update uom table ------------------------- --------------------------------------
ALTER TABLE `uom`
ADD `uom_description` varchar(100) NOT NULL;

commit;

UPDATE `uom`
SET uom_description = 'Number', uom_name = 'NOS'
WHERE `uom_name` = 'Number';

UPDATE `uom`
SET uom_description = 'Kgs', uom_name = 'KGS'
WHERE `uom_name` = 'Kgs';

UPDATE `uom`
SET uom_description = 'Set', uom_name = 'SET'
WHERE `uom_name` = 'Set';

UPDATE `uom`
SET `uom_description` = 'Pairs', uom_name = 'PRS'
WHERE `uom_name` = 'Pairs';
*/
commit;