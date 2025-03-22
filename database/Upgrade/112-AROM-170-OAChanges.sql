-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 12:01 PM
-- Server version: 8.0.40-0ubuntu0.20.04.1
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

/* OA export */
ALTER TABLE `customer_po_tracking` ADD `acceptance_number` VARCHAR(255) NULL DEFAULT NULL AFTER `reason`;

INSERT INTO `global_configuration`(
    `displayLabel`,
    `config_name`,
    `config_value`,
    `isActive`,
    `ARMUserOnly`,
    `note`,
    `canModify`,
    `updatedttm`,
    `updated_user`
)
VALUES(
    'Order Acceptance Enable',
    'order_acceptance_enable',
    'Yes',
    1,
    1,
    'Order Acceptance Enable/Disable',
    1,
   CURRENT_TIMESTAMP,
    'arom'
);

/* export invoice */
ALTER TABLE customer_part 
ADD drg_no VARCHAR(255) NULL AFTER isservice, 
ADD rev_no VARCHAR(255) NULL AFTER drg_no, 
ADD moc VARCHAR(255) NULL AFTER rev_no;

ALTER TABLE parts_customer_trackings 
ADD drg_no VARCHAR(255) NULL AFTER rejection_remark, 
ADD rev_no VARCHAR(255) NULL AFTER drg_no, 
ADD moc VARCHAR(255) NULL AFTER rev_no, 
ADD item_no VARCHAR(255) NULL AFTER moc;

INSERT INTO `global_configuration`( `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user` ) 
VALUES( 'Export Sales Invoice', 'exportSalesInvoive', 'Yes', 1, 1, 'Export Sales Invoice', 1, '2024-01-28 11:08:40', 'AROM');

INSERT INTO `menu_master` (`menu_master_id`, `diaplay_name`, `url`, `menu_category_id`, `status`) 
VALUES  (NULL, 'View Export Invoice\r\n', 'export_invoice_released', '8', 'Active'), 
		(NULL, 'Country', 'country', '8', 'Active'), 
		(NULL, 'Port', 'port', '8', 'Active'), 
		(NULL, 'Currency', 'currency', '8', 'Active');


CREATE TABLE `export_sales` (
  `id` int NOT NULL,
  `clientId` int DEFAULT NULL,
  `sales_number` varchar(50)  NOT NULL,
  `actualSalesNo` int NOT NULL,
  `customer_id` int NOT NULL,
  `shipping_addressType` enum('customer','consignee') CHARACTER SET utf8mb4  DEFAULT NULL,
  `consignee_id` int DEFAULT NULL COMMENT 'Consignee address ID if shipping address type is consignee',
  `total_sales_amount` decimal(15,2) NOT NULL,
  `total_gst_amount` decimal(15,2) NOT NULL,
  `currency` int NOT NULL,
  `country_of_origin` int NOT NULL,
  `port_of_loading` int NOT NULL,
  `country_of_discharge` int NOT NULL,
  `port_of_discharge` int NOT NULL,
  `country_of_destination` int NOT NULL,
  `final_destination` int NOT NULL,
  `precarriage_by` varchar(20)  DEFAULT NULL,
  `container_no` varchar(20)  DEFAULT NULL,
  `checked_in` varchar(20)  DEFAULT NULL,
  `packed_in` varchar(20)  DEFAULT NULL,
  `total_boxes` int DEFAULT NULL,
  `transporter` int DEFAULT NULL,
  `net_weight` decimal(10,3) DEFAULT NULL,
  `gross_weight` decimal(10,3) DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 ,
  `note` text CHARACTER SET utf8mb4  NOT NULL,
  `created_by` int NOT NULL,
  `created_date` date NOT NULL,
  `created_time` varchar(12) CHARACTER SET utf8mb4  NOT NULL,
  `created_day` int NOT NULL,
  `created_month` varchar(20) CHARACTER SET utf8mb4  NOT NULL,
  `created_year` varchar(20) CHARACTER SET utf8mb4  NOT NULL,
  `status` enum('Pending','Lock','Cancelled') CHARACTER SET utf8mb4  NOT NULL DEFAULT 'Pending',
  `deleted` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `export_sales_parts` (
  `id` int NOT NULL,
  `sales_id` int NOT NULL,
  `sales_number` varchar(50) CHARACTER SET utf8mb4  NOT NULL,
  `customer_id` int NOT NULL,
  `part_id` int NOT NULL,
  `tax_id` int NOT NULL,
  `uom_id` varchar(20) CHARACTER SET utf8mb4  NOT NULL,
  `delivery_date` varchar(10) CHARACTER SET utf8mb4  DEFAULT NULL,
  `expiry_date` varchar(20) CHARACTER SET utf8mb4  DEFAULT NULL,
  `part_price` decimal(15,2) NOT NULL,
  `qty` decimal(15,2) NOT NULL,
  `pending_qty` decimal(15,2) NOT NULL,
  `heat_no` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_date` varchar(10) CHARACTER SET utf8mb4  NOT NULL,
  `created_time` varchar(10) CHARACTER SET utf8mb4  NOT NULL,
  `created_day` int NOT NULL,
  `created_month` int NOT NULL,
  `created_year` int NOT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  `invoice_number` varchar(200) CHARACTER SET utf8mb4  DEFAULT NULL,
  `basic_total` decimal(15,2) NOT NULL,
  `po_number` varchar(100) CHARACTER SET utf8mb4  NOT NULL,
  `po_date` varchar(10) CHARACTER SET utf8mb4  NOT NULL,
  `hsn_code` varchar(20) CHARACTER SET utf8mb4  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

COMMIT;

ALTER TABLE export_sales
  ADD PRIMARY KEY (id);


ALTER TABLE export_sales
  MODIFY id int NOT NULL AUTO_INCREMENT;
  
COMMIT;

ALTER TABLE export_sales_parts
  ADD PRIMARY KEY (id);

ALTER TABLE export_sales_parts
  MODIFY id int NOT NULL AUTO_INCREMENT;
  
COMMIT;

CREATE TABLE country_master (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) DEFAULT NULL,
    created_on DATETIME DEFAULT NULL,
    created_by INT DEFAULT NULL,
    updated_on DATETIME DEFAULT NULL,
    updated_by INT DEFAULT NULL,
    status ENUM('Active','Deactive') NOT NULL DEFAULT 'Active'
);



CREATE TABLE port_master (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) DEFAULT NULL,
    created_on DATETIME DEFAULT NULL,
    created_by INT DEFAULT NULL,
    updated_on DATETIME DEFAULT NULL,
    updated_by INT DEFAULT NULL,
    status ENUM('Active','Deactive') NOT NULL DEFAULT 'Active'
);



CREATE TABLE currency_master (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) DEFAULT NULL,
    created_on DATETIME DEFAULT NULL,
    created_by INT DEFAULT NULL,
    updated_on DATETIME DEFAULT NULL,
    updated_by INT DEFAULT NULL,
    status ENUM('Active','Deactive') NOT NULL DEFAULT 'Active'
);

ALTER TABLE client 
ADD bank_name VARCHAR(255) NULL AFTER bank_details, 
ADD bank_account_no VARCHAR(255) NULL AFTER bank_name, 
ADD account_name VARCHAR(255) NULL AFTER bank_account_no, 
ADD ifsc_code VARCHAR(255) NULL AFTER account_name;

ALTER TABLE client 
ADD swift_code VARCHAR(255) NULL AFTER ifsc_code, 
ADD micr_code VARCHAR(255) NULL AFTER swift_code, 
ADD lut_no VARCHAR(255) NULL AFTER micr_code, 
ADD lut_date VARCHAR(255) NULL AFTER lut_no,
ADD ad_no VARCHAR(255) NULL AFTER lut_date;

ALTER TABLE `customer` 
ADD `customerType` ENUM('Domestic','Expoter') NOT NULL DEFAULT 'Domestic' AFTER `distncFrmClnt3`;


ALTER TABLE `export_sales_parts`
  DROP `heat_no`;

INSERT INTO `global_configuration`( `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`, `category`, `type` ) VALUES( 'Export ICL Logo', 'ExportICLLogo', '', 1, 1, 'Export ICL Logo', 1, CURRENT_TIMESTAMP, 'Admin', 'Sales', 'file' );


ALTER TABLE `export_sales` 
ADD `place_receipt_by_precarrier` VARCHAR(255) NULL AFTER `final_destination`;

ALTER TABLE `export_sales` 
ADD `mode_of_shipment` ENUM('Road','Rail','Air','Ship') NOT NULL AFTER `final_destination`;

INSERT INTO `global_configuration`( `displayLabel`, `config_name`, `config_value`, `isActive`, `ARMUserOnly`, `note`, `canModify`, `updatedttm`, `updated_user`, `category`, `type` ) VALUES( 'Export TUV Logo', 'ExportTUVLogo', '', 1, 1, 'Export TUV Logo', 1, CURRENT_TIMESTAMP, 'arom', 'Sales', 'file' );


CREATE TABLE `export_packing_slip` (
  `export_packing_slip_id` int NOT NULL,
  `export_sales_id` int NOT NULL,
  `packing_number` varchar(255) NOT NULL,
  `packing_date` datetime NOT NULL,
  `contents` varchar(255) NOT NULL,
  `material_used` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Indexes for table `export_packing_slip`
--
ALTER TABLE `export_packing_slip`
  ADD PRIMARY KEY (`export_packing_slip_id`);

--
-- AUTO_INCREMENT for table `export_packing_slip`
--
ALTER TABLE `export_packing_slip`
  MODIFY `export_packing_slip_id` int NOT NULL AUTO_INCREMENT;
  
COMMIT;

CREATE TABLE `export_packing_slip_parts` (
  `export_packing_slip_parts_id` int NOT NULL,
  `export_packing_slip_id` int NOT NULL,
  `package_no` varchar(255) NOT NULL,
  `package_size` varchar(255) NOT NULL,
  `part_id` int NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `net_weight` decimal(10,2) NOT NULL
) ENGINE=InnoDB;

--
-- Indexes for table `export_packing_slip_parts`
--
ALTER TABLE `export_packing_slip_parts`
  ADD PRIMARY KEY (`export_packing_slip_parts_id`);

--
-- AUTO_INCREMENT for table `export_packing_slip_parts`
--
ALTER TABLE `export_packing_slip_parts`
  MODIFY `export_packing_slip_parts_id` int NOT NULL AUTO_INCREMENT;

COMMIT;


INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('112-AROM-170-OAChanges.sql'
            , CURRENT_TIMESTAMP
       )
;

