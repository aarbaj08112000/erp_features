-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 09:34 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsperp`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bill_tracking`
--

CREATE TABLE `bill_tracking` (
  `id` int(11) NOT NULL,
  `c_po_so_id` int(11) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `invoice_date` varchar(20) NOT NULL,
  `invoice_amount` varchar(10) NOT NULL,
  `tds_amount` varchar(12) NOT NULL,
  `less_tds_amount` varchar(12) NOT NULL,
  `stv_number` varchar(15) NOT NULL,
  `stv_amount` varchar(15) NOT NULL,
  `balance_amount` varchar(20) DEFAULT NULL,
  `date` varchar(15) NOT NULL,
  `statement_booking_amount` varchar(15) NOT NULL,
  `payment_due_date_mk` varchar(20) NOT NULL,
  `payment_due_date_customer` varchar(20) DEFAULT NULL,
  `date_added` date NOT NULL,
  `time` time NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `id` int(11) NOT NULL,
  `customer_part_id` int(30) NOT NULL,
  `child_part_id` int(30) NOT NULL,
  `quantity` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challan`
--

CREATE TABLE `challan` (
  `id` int(11) NOT NULL,
  `sub_po_id` int(11) DEFAULT NULL,
  `challan_number` text DEFAULT NULL,
  `staus` varchar(20) DEFAULT 'Pending',
  `supplier_id` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `vechical_number` varchar(20) DEFAULT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `mode` varchar(20) DEFAULT NULL,
  `transpoter` varchar(20) DEFAULT NULL,
  `l_r_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challan_parts`
--

CREATE TABLE `challan_parts` (
  `id` int(11) NOT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `challan_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `remaning_qty` float NOT NULL,
  `process` text NOT NULL,
  `hsn` text NOT NULL,
  `value` float NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challan_parts_history`
--

CREATE TABLE `challan_parts_history` (
  `id` int(11) NOT NULL,
  `challan_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `supplier_challan_number` varchar(200) DEFAULT NULL,
  `qty` float NOT NULL,
  `reject_qty` int(11) DEFAULT NULL,
  `accepeted_qty` int(11) DEFAULT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'pending',
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challan_parts_subcon`
--

CREATE TABLE `challan_parts_subcon` (
  `id` int(11) NOT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `challan_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `remaning_qty` float NOT NULL,
  `process` text NOT NULL,
  `hsn` text NOT NULL,
  `value` float NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challan_subcon`
--

CREATE TABLE `challan_subcon` (
  `id` int(11) NOT NULL,
  `sub_po_id` int(11) DEFAULT NULL,
  `challan_number` text DEFAULT NULL,
  `staus` varchar(20) DEFAULT 'Pending',
  `customer_id` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `vechical_number` varchar(20) DEFAULT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `mode` varchar(20) DEFAULT NULL,
  `transpoter` varchar(20) DEFAULT NULL,
  `l_r_number` varchar(20) DEFAULT NULL,
  `customer_challan_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `child_part`
--

CREATE TABLE `child_part` (
  `id` int(11) NOT NULL,
  `stock` float NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(250) NOT NULL,
  `supplier_id` int(30) DEFAULT NULL,
  `part_rate` int(11) DEFAULT NULL,
  `revision_date` varchar(50) DEFAULT NULL,
  `revision_no` varchar(50) DEFAULT NULL,
  `revision_remark` varchar(20) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `child_part_id` int(255) DEFAULT NULL,
  `store_rack_location` varchar(255) DEFAULT NULL,
  `store_stock_rate` float DEFAULT NULL,
  `safty_buffer_stk` varchar(255) DEFAULT NULL,
  `diagram` varchar(50) DEFAULT NULL,
  `quote` varchar(50) DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `part_drawing` text DEFAULT NULL,
  `ppap_document` text DEFAULT NULL,
  `modal_document` text DEFAULT NULL,
  `cad_file` text DEFAULT NULL,
  `a_d` text NOT NULL,
  `q_d` text NOT NULL,
  `c_d` text NOT NULL,
  `quotation_document` varchar(20) DEFAULT NULL,
  `gst_id` int(11) DEFAULT NULL,
  `sub_type` text DEFAULT NULL,
  `max_uom` float DEFAULT NULL,
  `min_uom` float DEFAULT NULL,
  `onhold_stock` float NOT NULL,
  `production_qty` float NOT NULL,
  `rejection_prodcution_qty` float NOT NULL,
  `weight` float DEFAULT NULL,
  `size` text DEFAULT NULL,
  `thickness` text DEFAULT NULL,
  `sub_con_stock` float DEFAULT NULL,
  `rejection_stock` float DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `sharing_qty` float NOT NULL DEFAULT 0,
  `machine_mold_issue_stock` int(11) NOT NULL DEFAULT 0,
  `production_scrap` int(11) NOT NULL DEFAULT 0,
  `production_rejection` int(11) NOT NULL DEFAULT 0,
  `deflashing_stock` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_part`
--

INSERT INTO `child_part` (`id`, `stock`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `store_rack_location`, `store_stock_rate`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `gst_id`, `sub_type`, `max_uom`, `min_uom`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `weight`, `size`, `thickness`, `sub_con_stock`, `rejection_stock`, `grade`, `sharing_qty`, `machine_mold_issue_stock`, `production_scrap`, `production_rejection`, `deflashing_stock`) VALUES
(1, 12164, 'D8MS-24403', 'TOP TETHER MOUNTING BRACKET', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 1.43, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-29 08:39:57', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 200000, NULL, 0, 5771, 0, 0, '0', '0', 166, NULL, '0', 0, 0, 0, 0, 0),
(2, 2792, 'D8MS-24404', 'TOP TETHER WIRE', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 1.91, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-26 12:23:43', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '0', '0', 7113, NULL, '', 0, 0, 0, 0, 0),
(3, 197, 'D7TM-30117', 'LOWER TRACK J HOOK IB 60P', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 05:34:08', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 598, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(4, 1047, 'D7TM-30119', 'REAR MOUNTING BRACKET IB 60P', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 05:34:29', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 1230, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(5, 0, 'D7TM-11140', 'FRONT SEAT REAR MOUNTING WASHER', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 1, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-25 04:11:57', NULL, '7318', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 200000, NULL, 0, 960, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(6, 0, 'D7TM-30367', 'TRACK SUPPORTING BRACKET 40P', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '2023-03-26 06:44:19', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 195, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(7, 0, 'D7TM-30692', 'BOTTOM PLASTIC COVER ATTACHMENT WIRE', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 4.67, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-21 06:11:12', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 50000, NULL, 0, 1826, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(8, 7100, 'D7TM-30464', 'NUT - SQ WELD M6', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 0.5, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 13:32:43', NULL, '7318', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 205000, NULL, 0, 35, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(9, 1133, 'D7TM-30544', 'TUMBLE LATCH CABLE ATTACHMENT BRACKET', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, 2.52, '500', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(10, 0, 'D7TM-89821', 'PLATE BASE RH', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 0, '', NULL, NULL, 3, '7/8/2022', '', '2023-02-21 11:39:44', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 217, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(11, 2846, 'D7TM-89731', 'Q5020 HOLDER, LH', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 17.32, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-28 09:24:07', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 25000, NULL, 0, 387, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(12, 4147, '89712-Q5020', 'SHAFT LATCH', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 9.92, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-28 09:24:07', NULL, '7318', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 105000, NULL, 0, 911, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(13, 1, 'D7TM-30236', 'BOTTOM PLASTIC COVER  REAR ATTACHMENT', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, 2.75, '500', NULL, NULL, 3, '7/8/2022', '', '2023-02-15 08:11:15', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 5410, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(14, 0, 'D7TM-30487', 'SPRING STOPPER PIN', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 2.5, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-27 12:41:48', NULL, '7318', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 100000, NULL, 0, 4202, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(15, 0, 'D6TH-41073', 'NORTON BUSHING', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(16, 0, 'D6TH-41133', 'PIVOT BUSH', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(17, 736, 'D7TM-30382', 'OUTBOARD TUMBLE  BRACKET', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 05:42:56', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(18, 0, 'D7TM-30906', 'PIVOT BUSH-Dia.18.05', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(19, 0, 'D7TM-30372', 'FRONT MOUNTING BRACKET IB 40P', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, NULL, NULL, '500', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(20, 2500, 'D7TM-30675', 'TUMBLE STOPPER PIN IB', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 2.9, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-29 08:50:40', NULL, '7318', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 4520, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(21, 0, 'D7TM-30115', 'TRACK LOCATOR PIN', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 2.35, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-27 08:59:06', NULL, '7318', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 150000, NULL, 0, 2016, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(22, 0, 'D7TM-30386', 'FRONT MOUNTING BRACKET OB 40P', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 0, '', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(24, 3000, 'D7TM-30674', 'TUMBLE STOPPER PIN OB', NULL, NULL, '9/18/2021', 'na', 'new part', 1, 1, 'NA', 3.72, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-27 08:58:16', NULL, 'NA', '', '', '', '', '', '', '', NULL, 1, 'Subcon grn', 1000000, NULL, 0, 186, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(26, 1070, 'D7TM-30545', '40P LATCH STOPPER BRACKET IB', NULL, NULL, '9/24/2021', 'NA', 'New part added', 1, 1, 'NA', 1, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-28 09:12:01', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, '', 1000000, NULL, 0, 748, 0, 0, '0', '0', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(27, 2002, 'D7TM-30546', '40P LATCH STOPPER BRACKET OB', NULL, NULL, '9/24/2021', 'NA', 'New part added', 1, 1, 'NA', 7.03, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-25 04:05:58', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 25000, NULL, 0, 1968, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(28, 3920, '234844', 'COVER PLATE', NULL, NULL, '10/1/2021', 'NA', 'New part added', 1, 3, 'NA', 32.67, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-28 04:06:55', NULL, '87089900', '1)_234844_COVER_UPDATED_Export.pdf', '', '', '', '', '', '', NULL, 3, 'Subcon grn', 100000, NULL, 0, 3050, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(29, 0, 'D7TM-30481', 'TRACK SUPPORTING BRACKET', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 6.99, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-21 06:11:12', NULL, '72092620', 'D7TM-30481_P2_29OCT2018.pdf', '', '', '', '', '', '', NULL, 3, 'Regular grn', 25000, NULL, 0, 881, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(30, 0, '363228214', 'REINF JACKING POINT RR RH', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, NULL, NULL, '2000', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(31, 0, 'SCS004450A15', 'SMALL BRACKET-LHS', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 3, 'NA', 0.28, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-26 10:22:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Subcon grn', 25000, NULL, 0, 335, 0, 0, '0', '0', NULL, NULL, 'N/A', 0, 0, 0, 0, 0),
(32, 3148, 'D7TM-30234', 'PLASTIC MTG REAR 40P', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 1.98, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-28 09:12:01', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 60000, NULL, 0, 2979, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(33, 0, 'D7TM-30884', 'TUMBLE STOPPER BKT OB', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 1, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-27 08:58:16', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, '', 1000000, NULL, 0, 106, 0, 0, '0', '0', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(34, 54817, 'D8MS24630OP20', 'BACK PANEL 40P_CO2 WELDING ASSLY', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 1, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-06 09:27:49', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, '', 1000000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(35, 15578, 'BSL002049703NCPAC', 'STOPPER PLATE', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 2.02, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 04:30:12', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 180000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(36, 10303, 'BSL002027942NCPAD', 'BRACKET FERROUS CABLE PLASTIC ATTACHMENT RH', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 2.18, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-27 04:38:35', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 2000000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(37, 0, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 0, '', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(38, 0, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 0, '', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(39, 0, 'D7TM-30120', 'FRONT MOUNTING BRACKET IB 60P', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 13.12, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-20 06:38:22', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 25000, NULL, 0, 1878, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(40, 0, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 0, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-15 09:24:39', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(41, 609, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 0, '', NULL, NULL, 3, '7/8/2022', '', '2023-01-18 06:10:40', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(42, 0, 'D7TM-30374', 'INBOARD TUMBLE BRACKET', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 2.5, '', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 40000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(43, 0, 'D7TM-30108', 'REAR MOUNTING BRACKET OB 60P', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(44, 566, 'D7TM-89831', 'HOLDER IB LATCH', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 17.32, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 05:37:22', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 25000, NULL, 0, 1830, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(45, 0, 'D7TM-89721', 'PLATE BASE LH', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 18.9, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-25 04:05:58', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 25000, NULL, 0, 1929, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(46, 2900, '1000530567', 'FOAM RUBBER GASKET CS1412', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 12.5, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 04:30:35', NULL, '39199090', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 110000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(47, 0, 'SCS004450A18', 'CLUTCH CLAMP', NULL, NULL, '10/10/2021', '0', 'New part added', 1, 1, 'NA', 1.19, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-26 10:22:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 25000, NULL, 0, 6688, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(49, 0, 'HR-E34-2.5X172X1250', 'HR SHEET-2.5mmX172mmX1250mm E34 GRADE', NULL, NULL, '10/23/2021', 'NA', 'New part added', 2, 1, NULL, NULL, '-', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '72082540', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(50, 0, 'HR-E34-2.5X150X1250', 'HR SHEET-2.5mmX150mmX1250mm E34 Grade', NULL, NULL, '10/23/2021', '0', 'New part added', 2, 1, NULL, NULL, '-', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '72082540', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(51, 0, 'CR-D513-1.0X178X320', 'CR SHEET 1.0mmX178mmX320mm D513 GRADE', NULL, NULL, '10/23/2021', '0', 'New part added', 2, 1, NULL, NULL, '-', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '72082540', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(52, 0, 'HR-E34-3.0X125X1250', 'HR SHEET-3.0mmX125mmX1250mm D513 GRADE', NULL, NULL, '10/23/2021', '0', 'New part added', 2, 1, NULL, NULL, '-', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '72082540', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(55, 45, 'WIRE SPOOL', '1.2 MM WIRE', NULL, NULL, '10/24/2021', 'NA', 'NA', 2, 2, NULL, 95, '10', NULL, NULL, 3, '7/8/2022', '', '2023-01-13 07:58:28', NULL, '', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(56, 165, 'WIRE SPOOL 0.8 MM', '0.8 MM WIRE', NULL, NULL, '10/24/2021', 'NA', 'NA', 2, 2, NULL, 95, '10', NULL, NULL, 3, '7/8/2022', '', '2023-01-13 08:05:14', NULL, '', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 240, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(57, 0, '42X42X36', 'WOODEN BOX', NULL, NULL, '10/24/2021', 'NA', 'NA', 1, 2, NULL, NULL, '2', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(58, 0, 'BSL002020808NCP', 'BACK RECLINER MOUNTING LOWER RH', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, NULL, '1000', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '9401', 'L002020809NCP_and_808.pdf', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(59, 0, 'BSL002020809NCP', 'BACK RECLINER MOUNTING LOWER LH', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, NULL, '1000', NULL, NULL, 3, '7/8/2022', '', '2023-03-21 05:43:14', NULL, '9401', 'L002020809NCP_and_8081.pdf', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 1924, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(62, 0, 'D8MS-24401', 'BACK PANEL 60P', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, NULL, '1000', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(63, 1000, 'SCS004450A17', 'STOPPER CUP', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '2023-03-21 10:47:02', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(64, 0, 'SCS004450A16', 'SIDE LEG', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '2023-03-18 11:47:15', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 585, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(65, 166, 'SCS004450A14', 'L BRACKET', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, NULL, '1000', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 06:05:23', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(66, 2000, 'SCS004440B18', 'LEG', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, NULL, 0, '1000', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(67, 1822, 'SCS02430-12', 'TOP PLATE LH', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, 'NA', 39.09, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-29 08:35:32', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 100000, NULL, 0, 418, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(68, 1822, 'SCS02429-12', 'TOP PLATE RH', NULL, NULL, '11/1/2021', '0', 'New part added', 1, 1, 'NA', 39.09, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 04:29:19', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 3189, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(70, 0, 'Q348402', 'SS HEX WELD NUT M6', NULL, NULL, '11/26/2021', '0', 'New part added', 1, 1, 'NA', 1.75, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-21 05:45:44', NULL, '7318', 'Q348402_Rev_F.pdf', '', '', '', '', '', '', NULL, 1, 'Regular grn', 60000, NULL, 0, 776, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(71, 4595, 'Q348403', 'SS HEX WELD NUT M8', NULL, NULL, '11/26/2021', '0', 'New part added', 1, 1, 'NA', 3.5, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 06:17:10', NULL, '7318', 'Q348403.pdf', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(72, 80, 'D7TM-30649', 'Lower Track J Hook Assly.', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '2023-03-11 11:29:18', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(73, 8, 'D7TM-30420', 'Track Supporting cross member Bkt. 40P', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '2023-03-11 12:42:54', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(75, 0, 'D7TM-30647', 'Base plate Assy. IB Latch', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(76, 0, 'D7TM-30648', 'Base plate Assy. OB Latch', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(77, 0, 'D7TM-30693', 'Holder Assy. OB Latch', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(78, 0, 'D7TM-30373', 'Tumble Bkt. with Norglide Bush Assy. IB 40P', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(79, 0, 'D7TM-30381', 'Outboard Tumble Bkt. with Norglide Bush Assy. 40P', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(81, 3, 'D7TM-30383', 'Front Mtg. Bkt. Assy.With Sleeve OB 40P', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, NULL, NULL, '700', NULL, NULL, 3, '7/8/2022', '', '2023-03-20 04:40:49', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(82, 0, 'D7TM-30114(30105)', 'Front Mtg Bkt OB 60P', NULL, NULL, '26-12-2021', '0', 'New part added', 1, 3, 'NA', 22.27, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-20 06:35:38', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 124, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(84, 6418, 'CBB0004', 'BACK PLATE CLUTCH MTG BKT', NULL, NULL, '29-12-2021', '0', 'New part added', 1, 1, 'NA', 12.61, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 04:31:17', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 1000000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(85, 2104, 'CBS0004', 'BRACKET STOPPER CLUTCH PEDAL', NULL, NULL, '29-12-2021', '0', 'New part added', 1, 1, 'NA', 7.89, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 04:30:58', NULL, '87089900', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 1000000, NULL, 0, 0, 0, 0, '0', '0', 1645, NULL, '', 0, 0, 0, 0, 0),
(86, 90000, 'BSL002213407NCP', 'M10 X 1.5 WELD NUT', NULL, NULL, '31-12-2021', '0', 'New part added', 1, 2, 'NA', 1.35, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-29 08:59:40', NULL, '7318', '0000029807_StPARKanYnYveC.pdf', '', '', '', '', '', '', NULL, 1, 'Regular grn', 350000, NULL, 0, 28776, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(88, 5803, 'B1', '3.2 X 1250 X 2500 HRPO QSTE 5OOTM', NULL, NULL, '31-12-2021', '0', 'New part added', 2, 1, 'NA', 72, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-20 06:23:52', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'RM', 500000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 1563, 0, 0, 0, 0),
(90, 11719, 'B4', '3 X 1250 X 2500 HRPO S550MC', NULL, NULL, '31-12-2021', '0', 'New part added', 2, 1, NULL, 72, '3500', NULL, NULL, 3, '7/8/2022', '', '2023-03-17 07:26:15', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'RM', 500000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(91, 2453.13, 'B2', '2 X 1250 X 2500 HRPO QSTE 500TM', NULL, NULL, '31-12-2021', '0', 'New part added', 2, 1, NULL, 72, '200', NULL, NULL, 3, '7/8/2022', '', '2023-03-03 05:22:42', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'RM', 500000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 4, 0, 0, 0, 0),
(92, 0, 'B3', '2 X 1250 X 2500 HRPO QSTE 340LA', NULL, NULL, '31-12-2021', '0', 'New part added', 2, 1, NULL, 72, '500', NULL, NULL, 3, '7/8/2022', '', '2023-03-15 09:03:00', NULL, '9401', '', '', '', '', '', '', '', NULL, 1, 'RM', 500000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 10, 0, 0, 0, 0),
(93, 0, 'SH4000700360920', 'IFHS400-0.7X360X920 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 81.9, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-29 06:37:05', NULL, '7208', '', '', '', '', '', '', '', NULL, 1, 'RM', 300000, NULL, 0, 5631.18, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(94, 0, 'RM00STK35', 'SPFC400-690X630X0.5 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 67.2, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-08 11:53:23', NULL, '7209', '', '', '', '', '', '', '', NULL, 1, 'RM', 250000, NULL, 0, 680.3, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(95, 0, 'RM00STK34', 'SPFC400-890X690X0.5 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 67.2, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-26 04:50:31', NULL, '7209', '', '', '', '', '', '', '', NULL, 1, 'RM', 250000, NULL, 0, 201.01, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(96, 0, 'DASRM_43', 'E34 3X1250X2500', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 47.01, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-21 06:40:41', NULL, '7208', '', '', '', '', '', '', '', NULL, 1, 'RM', 250000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 704, 0, 0, 0, 0),
(97, 2211, 'DASRM_46', 'E34 2.5X1250X2500 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 47.01, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-27 08:15:13', NULL, 'NA', '', '', '', '', '', '', '', NULL, 1, 'RM', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, 480, 0, 0, 0, 0),
(98, 2431, 'DASRM.', 'SHEET SPFH590 2.5X1250X2500 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 48.45, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-27 13:12:50', NULL, '72082730', '', '', '', '', '', '', '', NULL, 1, 'RM', 250000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 443, 0, 0, 0, 0),
(100, 0, 'ST000017', 'HRPO HSLA355 SIZE-2.5X1250X2500 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 64.5, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-12 07:14:32', NULL, '72082540', '', '', '', '', '', '', '', NULL, 1, 'RM', 50000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, 'E34', 60, 0, 0, 0, 0),
(102, 3010, 'ST000040', 'HRPO HR FE410 SIZE-6.0X1250X2500 MM', NULL, NULL, '1/1/2022', '0', 'New part added', 2, 1, 'NA', 64.2, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-19 07:18:49', NULL, '7208', '', '', '', '', '', '', '', NULL, 1, 'RM', 120000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, 'FE410', 1303, 0, 0, 0, 0),
(103, 3000, 'SCS02430-12.1', 'DOWEL PIN DIA 8.5', NULL, NULL, '1/1/2022', '0', 'New part added', 1, 1, 'NA', 1.85, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-29 08:35:32', NULL, '87141090', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 50000, NULL, 0, 744, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(104, 3000, 'SCS02430-12.2', 'METAL INSERT M12X1.75', NULL, NULL, '1/1/2022', '0', 'New part added', 1, 1, 'NA', 14.5, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-29 08:35:32', NULL, '87141090', '', '', '', '', '', '', '', NULL, 3, 'Regular grn', 50000, NULL, 0, 744, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(106, 3550, 'DASRM_26', 'HR SHEET 550 LA-2.5x1250X2500 MM', NULL, NULL, '5/1/2022', '0', 'New part added', 2, 1, NULL, 71, '1500', NULL, NULL, 3, '7/8/2022', '', '2023-02-14 12:10:38', NULL, '7208', '', '', '', '', '', '', '', NULL, 1, 'RM', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', -1290, 0, 0, 0, 0),
(108, 0, 'CM000453', 'Bottom Plate LH', NULL, NULL, '2/2/2022', '0', 'New part added', 1, 1, 'NA', 60.54, '', NULL, NULL, 3, '7/8/2022', '', '2023-03-20 10:36:16', NULL, '87089900', '', '', '', '', '', '', '', NULL, 1, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(109, 0, 'CM000451', 'Bottom Plate RH', NULL, NULL, '2/2/2022', '0', 'New part added', 1, 1, 'NA', 36.99, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-20 10:48:30', NULL, 'NA', '', '', '', '', '', '', '', NULL, 1, '', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(110, 0, 'DUPLICATE PART D7TM30105OP20', 'DUPLICATE PART', NULL, NULL, '8/2/2022', '0', 'New part added', 1, 3, 'NA', 3.8, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-18 07:50:47', NULL, 'NA', '', '', '', '', '', '', '', NULL, 1, '', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(111, 0, 'A062R391', 'Spacer', NULL, NULL, '7/3/2022', '0', 'New part added', 1, 1, 'NA', 10.5, NULL, NULL, NULL, 3, '7/8/2022', '', '2023-03-26 06:13:18', NULL, 'NA', 'A062R391_Rev_B.pdf', '', '', '', '', '', '', NULL, 1, '', 1000000, NULL, 0, 1425, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(112, 0, '1000699234', 'SHIFTER MOUNTING PLATE', NULL, NULL, '5/1/2022', '0', 'New part added', 1, 1, '', 0, '50', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(113, 0, 'PTML253422107125-V', 'LIFTING HOOK FRONT', NULL, NULL, '5/1/2022', '0', 'New part added', 1, 1, '', 0, '-', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(114, 0, 'B4.2000480', 'bracket', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'A1', 11, '100', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, 'HSN01', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 1.5, '2.5', '3.4', NULL, NULL, '', 0, 0, 0, 0, 0),
(115, 0, 'Packaging Materials for Bearing Support Assy ', 'Packaging Materials for Bearing Support Assy -Part No. - 5781509-01 ', NULL, NULL, NULL, NULL, NULL, 5, NULL, '', 3415, '1', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '4819', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(116, 0, 'BSP000001', 'Packaging Materials for Bearing Support Assy -Part No. - 5781509-01 ', NULL, NULL, NULL, NULL, NULL, 5, NULL, '', 3415, '1', NULL, NULL, 3, '7/8/2022', '', '0000-00-00 00:00:00', NULL, '4819', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(117, 22218, 'SBT00800B42', 'LUG-U301', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 9.1, '5000', NULL, NULL, 3, '8/8/2022', '', '2023-03-29 06:32:53', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 1894, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(118, 4311, 'BSL002020815', 'BRACKET FERROUS,RECLINER 3RS UPPER RH', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 38.92, '3000', NULL, NULL, 3, '8/8/2022', '', '2023-03-21 08:16:01', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(119, 0, 'DASRM_ /CR SHEET 0.6X1050X1800 MM', 'DASRM_ /CR SHEET 0.6X1050X1800 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 67.2, '', NULL, NULL, 3, '21-08-2022', '', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 250000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(120, 0, 'DASRM_ /CR SHEET SPFC440- 0.6X1050X1890 MM', 'DASRM_ /CR SHEET SPFC440- 0.6X1050X1890 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 67.2, '', NULL, NULL, 3, '21-08-2022', '', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 250000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(121, 0, 'DASRM_ /HR SHEET-2.5X208X1250 MM', 'DASRM_ /HR SHEET-2.5X208X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 71, '', NULL, NULL, 3, '21-08-2022', '', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 250000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(122, 0, 'DASRM_/SHEET', 'SPFH590- 2.5X1250X2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 48.45, '', NULL, NULL, 3, '24-08-2022', '', '0000-00-00 00:00:00', NULL, '72082730', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 300000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(123, 825, 'DASRM_62', 'E-34 2X1500X2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 47.01, '', NULL, NULL, 3, '24-08-2022', '', '2023-03-14 08:41:54', NULL, '72082730', '', '', '', '', '', '', '', NULL, NULL, 'RM', 300000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(124, 0, 'D7TM30117OP05', 'D7TM30117OP05-SHEARING', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 11, '100', NULL, NULL, 3, '23-09-2022', '7:22:54', '2023-03-29 06:06:52', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 109.17, 0, 2, '', '1.5', NULL, NULL, 'ss', 0, 0, 0, 0, 0),
(125, 940, 'D7TM30119OP05', 'D7TM30119OP05-SHEARING', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 22, '100', NULL, NULL, 3, '23-09-2022', '7:32:19', '2023-03-21 06:18:39', NULL, 'HSN01', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0.4, 0, 3, '', '1.5', NULL, NULL, 'dd', 0, 0, 0, 0, 0),
(126, 0, 'OFFCUT SHEET / SPFH590- 2.5X250X500 MM', 'OFFCUT SHEET / SPFH590- 2.5X250X500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 8, '100', NULL, NULL, 3, '23-09-2022', '7:38:39', '2023-01-16 09:07:33', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 2, '', '2.5', NULL, NULL, 'ss', 0, 0, 0, 0, 0),
(127, 0, 'D9MS-20879', 'Lumbar Attachment Bracket', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1.2, '5000', NULL, NULL, 3, '5/11/2022', '4:01:55', '2023-03-29 09:03:16', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 600000, NULL, 0, 5253, 0, 0, '', '', NULL, NULL, 'na', 0, 0, 0, 0, 0),
(128, 0, 'DASRM_36', 'CR SHEET_DP590_1.6X1305X2500', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 97, 'NA', NULL, NULL, 3, '5/11/2022', '4:44:50', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'RM', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'DP590', 0, 0, 0, 0, 0),
(129, 0, 'DASRM_70', 'SPRC440_0.6X1250X2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 95, 'NA', NULL, NULL, 3, '5/11/2022', '4:46:44', '2023-02-10 11:52:30', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'RM', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'SPRC440', 654, 0, 0, 0, 0),
(130, 0, 'DASRM_71', 'CR SHEET_SPFC590_1.6X1250X2500', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'na', 41.4, NULL, NULL, NULL, 3, '5/11/2022', '4:50:32', '2023-03-07 13:54:16', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'RM', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(131, 0, 'DASRM_60', 'CR SHEET DP590_1.2X548X1250', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 70.9, '5000', NULL, NULL, 3, '5/11/2022', '4:54:50', '2023-03-27 07:16:06', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'RM', 10000000, NULL, 0, 6344.15, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(132, 325, 'DASRM_33', 'E34_1.6X55X458 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 64.01, 'NA', NULL, NULL, 3, '5/11/2022', '5:22:22', '2023-03-27 08:40:16', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'RM', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(133, 0, 'DASRM_63', 'E34_1.6X1250X2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 64.01, 'NA', NULL, NULL, 3, '5/11/2022', '5:23:45', '2023-03-15 09:02:20', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'RM', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(134, 0, 'DASRM_59', 'CR SHEET JSC270C_1.2X548X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 70.9, 'NA', NULL, NULL, 3, '5/11/2022', '5:25:23', '2023-03-24 12:08:10', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'RM', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'JSC270C', 0, 0, 0, 0, 0),
(135, 0, 'D8MS24630OP10', 'D8MS24630OP10-DRAW', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(136, 327, 'D7TM30649OP30', 'D7TM-30649-Lower Track J Hook Assly.-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 9.32, NULL, NULL, NULL, 3, '14-11-2022', '3:19:31', '2023-03-29 12:34:23', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(137, 406, 'D7TM30420OP30', 'D7TM-30420-Track Supporting Bkt. 40P -CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 10.51, NULL, NULL, NULL, 3, '14-11-2022', '3:20:20', '2023-03-28 04:11:57', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(138, 375, 'D7TM30646OP20', 'D7TM-30646-Holder Assy. IB Latch-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2.86, NULL, NULL, NULL, 3, '14-11-2022', '3:22:49', '2023-03-27 12:12:58', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(139, 200, 'D7TM30647OP20', 'D7TM-30647-Base plate Assy. IB Latch-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 5.89, NULL, NULL, NULL, 3, '14-11-2022', '3:23:22', '2023-03-27 04:40:37', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(140, 177, 'D7TM30648OP20', ' D7TM-30648-Base plate Assy. OB Latch-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 4.4, NULL, NULL, NULL, 3, '14-11-2022', '3:23:54', '2023-03-27 04:40:29', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(141, 100, 'D7TM30693OP20', 'D7TM-30693-Holder Assy. OB Latch-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2.97, NULL, NULL, NULL, 3, '14-11-2022', '3:24:22', '2023-03-27 04:40:21', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(142, 299, 'D7TM30373OP20', 'D7TM-30373-Tumble Bkt. wth Norglide Bush Assy. IB 40P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 4.57, NULL, NULL, NULL, 3, '14-11-2022', '3:24:49', '2023-03-29 12:32:57', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(143, 180, 'D7TM30381OP20', 'D7TM-30381-Outboard Tumble Bkt. with Norglide Bush Assy. 40P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 4.25, NULL, NULL, NULL, 3, '14-11-2022', '3:25:16', '2023-03-29 12:31:54', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(144, 417, 'D7TM30371OP30', 'D7TM-30371-FRONT ASSLY BKT. ASSLY. WITH SLEEVE IB 40P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 6.28, NULL, NULL, NULL, 3, '14-11-2022', '3:25:44', '2023-03-29 12:19:12', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(145, 409, 'D7TM30383OP30', 'D7TM-30383-FRONT MTG. BKT. ASSLY. WITH SLEEVE OB 40P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 8.77, NULL, NULL, NULL, 3, '14-11-2022', '3:26:16', '2023-03-29 12:29:01', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(146, 1516, 'BSL002055836OP70', 'FRM ARMRESET MTG BKT-BSL002055836-FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 72.51, NULL, NULL, NULL, 3, '14-11-2022', '3:26:41', '2023-03-29 07:28:44', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 1500000, NULL, 0, 0, 0, 0, '', '', 1010, NULL, NULL, 0, 0, 0, 0, 0),
(147, 0, 'D7TM30109OP20', 'D7TM-30109-TRACK STOPPER BRACKET LOWER OB 60P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0.76, NULL, NULL, NULL, 3, '14-11-2022', '3:27:06', '2023-03-25 06:06:03', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(148, 200, 'D7TM30108OP70', 'CED Coating', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 37.32, NULL, NULL, NULL, 3, '14-11-2022', '3:27:39', '2023-03-27 04:33:51', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 150000, NULL, 0, 0, 0, 0, '', '', 39, NULL, NULL, 0, 0, 0, 0, 0),
(149, 200, 'D7TM30105OP20', 'D7TM-30105-FRONT MTG. BKT. RIVETTED ASSEMBLY OB 60P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 3.8, NULL, NULL, NULL, 3, '14-11-2022', '3:28:09', '2023-03-28 04:11:38', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(150, 0, 'D7TM30122OP20', 'D7TM-30122-FRONT MTG BRACKET RIVETTED ASSY. IB 60P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2.14, NULL, NULL, NULL, 3, '14-11-2022', '3:28:35', '2023-03-19 13:01:21', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(151, 0, 'D7TM30367OP05', 'SHEARING E34-3X407X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:12:58', '2023-03-20 12:45:48', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 235, 0, 0, '407X1250', '3', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(152, 595, 'D7TM30481OP05', 'SHEARING E34-2.5X108X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:29:11', '2023-03-27 08:18:12', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '108X1250', '2.5', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(153, 1000, 'SCS004450A17', 'FINAL INSPECTION-STOPPER CUP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, NULL, NULL, NULL, 3, '15-11-2022', '7:30:13', '2023-03-21 10:47:02', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 0, 0, 0, 'NA', '0', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(154, 0, 'D7TM30544OP05', 'SHEARING', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:30:51', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '102X1250', '2.5', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(155, 0, 'SCS004450A15OP20', 'SMALL BRACKET-LHS-FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, NULL, NULL, NULL, 3, '15-11-2022', '7:31:29', '2023-03-19 06:25:59', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '0', '0', 0, NULL, NULL, 0, 0, 0, 0, 0),
(156, 0, 'D7TM89821OP05', 'SHEARING SPFFH590-2.6X179X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:32:15', '2023-03-29 06:03:22', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 33.788, 0, 0, '179X1250', '2.6', NULL, NULL, 'SPFFH590', 0, 0, 0, 0, 0),
(157, 352, 'D7TM30545OP05', 'SHEARING E34-2.5X170X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:33:01', '2023-03-27 08:18:26', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '170X1250', '2.5', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(158, 0, 'D7TM30234OP05', 'SHEARING E34-2X85X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:33:33', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '85X1250', '2', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(159, 0, 'D7TM89721OP05', 'SHEARING', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 1, '100', NULL, NULL, 3, '15-11-2022', '7:34:13', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(160, 0, 'D7TM30546OP05', 'SHEARING E34-2.5X150X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:34:51', '2023-03-25 12:02:49', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '150X1250', '2.5', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(161, 0, 'D7TM89731OP05', 'SHEARING SPFFH59-2.6X161X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:35:24', '2023-03-25 12:06:12', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 802, 0, 0, '161X1250', '2.6', NULL, NULL, 'SPFFH59', 0, 0, 0, 0, 0),
(162, 1690, 'D7TM30374OP05', 'SHEARING E34-3X201X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:36:07', '2023-03-21 06:19:20', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 14.8, 0, 0, '201X1250', '3', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(163, 142, 'CM000303OP10', 'ENG MTG BKT LH-S101-WELDING ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 228.37, NULL, NULL, NULL, 3, '15-11-2022', '7:36:36', '2023-03-27 10:22:35', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, 'NA', 'NA', 35, NULL, NULL, 0, 0, 0, 0, 0),
(164, 0, 'D7TM30372OP05', 'SHEARING E34-3X253X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:37:15', '2023-02-12 05:55:05', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 119, 0, 0, '253X1250', '3', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(165, 0, 'D7TM30386OP05', 'SHEARING E34-3X244X1250', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:37:50', '2023-03-27 07:07:12', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 315.1, 0, 0, '244X1250', '3', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(166, 0, 'D7TM30884OP05', 'SHEARING E34X-3X70X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:38:17', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '70X1250', '3', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(167, 1526, 'D7TM30114OP05', 'SHEARING E34-2.5X159X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:38:46', '2023-03-27 04:23:56', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '159X1250', '2.5', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(168, 0, 'D7TM30120OP05', 'SHEARING E34-2.5X100X1250', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:39:13', '2023-03-25 12:08:19', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '100X1250', '2.5', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(169, 0, 'D5MS40129OP05', 'SHEARING E34-3X136X1250', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 1, NULL, NULL, NULL, 3, '15-11-2022', '7:39:41', '2023-03-27 06:40:54', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 25.24, 0, 0, '136X1250', '3', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(170, 0, '235766OP30', 'FINAL INSPECTION BEFORE PLATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 12.39, NULL, NULL, NULL, 3, '16-11-2022', '8:02:11', '2023-03-19 12:08:29', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, 0, 0, 0, 0),
(171, 62, 'D7TM30649OP20', 'CO2 ASSEMBLY (30117 AND 30119)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 112.83, '100', NULL, NULL, 3, '19-11-2022', '5:47:28', '2023-03-29 07:27:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 0, NULL, '', 0, 0, 0, 0, 0),
(173, 33, 'D7TM30420OP20', 'CO2 ASSEMBLY (30367,30481 and 30692)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 97.71, '100', NULL, NULL, 3, '22-11-2022', '6:18:32', '2023-03-27 10:20:18', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 250, NULL, '', 0, 0, 0, 0, 0),
(174, 544, 'D7TM30646OP10', 'D7TM-30646-Holder Assy. IB Latch   ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 47.86, '100', NULL, NULL, 3, '22-11-2022', '6:20:03', '2023-03-27 10:20:44', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 159, NULL, '', 0, 0, 0, 0, 0),
(175, 243, 'D7TM30647OP10', 'CO2 ASSEMBLY (89731,30234,30545 and 89712)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 93.3, '100', NULL, NULL, 3, '22-11-2022', '6:21:00', '2023-03-29 07:01:34', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 325, NULL, '', 0, 0, 0, 0, 0);
INSERT INTO `child_part` (`id`, `stock`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `store_rack_location`, `store_stock_rate`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `gst_id`, `sub_type`, `max_uom`, `min_uom`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `weight`, `size`, `thickness`, `sub_con_stock`, `rejection_stock`, `grade`, `sharing_qty`, `machine_mold_issue_stock`, `production_scrap`, `production_rejection`, `deflashing_stock`) VALUES
(176, 390, 'D7TM30648OP10', 'CO2 ASSEMBLY (89721,30234,30546)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 59.64, '100', NULL, NULL, 3, '22-11-2022', '6:21:53', '2023-03-26 12:22:27', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 177, NULL, '', 0, 0, 0, 0, 0),
(177, 605, 'D7TM30693OP10', 'CO2 ASSEMBLY (89731,30236 and 89712)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 65.52, '100', NULL, NULL, 3, '22-11-2022', '6:22:33', '2023-03-28 09:28:30', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 188, NULL, '', 0, 0, 0, 0, 0),
(178, 720, 'D7TM30373OP10', 'CO2 ASSEMBLY (30374and 30487)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, '100', NULL, NULL, 3, '22-11-2022', '6:23:07', '2023-03-29 07:26:37', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 270, NULL, '', 0, 0, 0, 0, 0),
(179, 58, 'D7TM30381OP10', 'CO2 ASSEMBLY (30382 and 30487)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '22-11-2022', '6:23:42', '2023-03-29 07:26:10', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 0, NULL, '', 0, 0, 0, 0, 0),
(180, 563, 'D7TM30371OP20', 'Rivetting (30371 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 60.62, '100', NULL, NULL, 3, '22-11-2022', '6:24:32', '2023-03-29 07:28:15', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 196, NULL, '', 0, 0, 0, 0, 0),
(181, 430, 'D7TM30383OP20', 'Rivetting (30386 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 113.04, '100', NULL, NULL, 3, '22-11-2022', '6:25:07', '2023-03-29 07:22:36', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 107, NULL, '', 0, 0, 0, 0, 0),
(182, 789, 'D7TM30108OP60', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 34.57, '100', NULL, NULL, 3, '22-11-2022', '6:29:13', '2023-03-26 04:28:03', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 600, NULL, '', 0, 0, 0, 0, 0),
(183, 50, 'D7TM30105OP10', 'Rivetting (30114 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 36.99, '100', NULL, NULL, 3, '22-11-2022', '6:29:47', '2023-03-18 05:28:56', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', 741, NULL, '', 0, 0, 0, 0, 0),
(184, 0, 'L0020208080P05', 'SHEARING HSLA500-3.2X176X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '27-11-2022', '11:16:57', '2023-03-17 08:01:01', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 758.96, 0, 0, '', '', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(185, 0, 'L0020208090P05', 'SHEARING HSLA500-3.2X176X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '27-11-2022', '11:18:14', '2023-03-22 05:44:20', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 1301.08, 0, 0, '176X1250', '3.2', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(186, 0, 'BSL002020815P05', 'SHEARING HSLA500-3.2X316X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 0, NULL, NULL, NULL, 3, '27-11-2022', '11:19:09', '2023-03-18 04:48:46', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 2500000, NULL, 0, 21.2, 0, 0, 'NA', 'NA', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(187, 3825.2, 'BSL002020816P05', 'SHEARING HSLA500-3.2X316X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:19:43', '2023-03-18 04:43:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 471.7, 0, 0, '', '', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(188, 0, 'BSL002049703OP05', 'SHEARING HSLA500-3X50X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '27-11-2022', '11:20:34', '2023-03-25 12:09:13', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(189, 0, 'BSL002027942OP05', 'SHEARING HSLA340-2X55X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '27-11-2022', '11:21:22', '2023-03-25 12:05:08', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'HSLA340', 0, 0, 0, 0, 0),
(190, 472, 'BSL002020814OP05', 'SHEARING HSLA500-2X37X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '27-11-2022', '11:22:13', '2023-02-10 12:21:44', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '', '2.0MM', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(191, 0, 'BSL002055836OP05', 'SHEARING HSLA500-3.0X324X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 0, NULL, NULL, NULL, 3, '27-11-2022', '11:23:44', '2023-03-18 04:54:29', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 615.374, 0, 0, 'NA', '3.0 MM', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(192, 0, 'BSL002230976_1007_OP05', 'SHEARING HC340-1.5X125X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:25:00', '2023-03-25 12:09:41', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '', '1.5MM', NULL, NULL, 'HC340', 0, 0, 0, 0, 0),
(193, 0, 'SCS02429_30OP05', 'SHEARING FE410-6.0X178X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '6000', NULL, NULL, 3, '30-11-2022', '1:51:45', '2023-03-25 12:10:37', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'FE410/E250', 0, 0, 0, 0, 0),
(194, 0, 'SBT000050141OP05', 'SHEARING E34-2.0X215X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '1:54:34', '2023-03-19 05:32:55', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 305.8, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(195, 0, 'SCS004440B18OP05', 'SHEARING E34-4.5X208X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '1:56:50', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 30000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(196, 0, 'SCS004450A18OP05', 'SHEARING E34-1.6X52X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '30-11-2022', '1:58:10', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(197, 0, 'SCS004450A14OP05', 'SHEARING E34-3.5X198X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '1:58:52', '2023-03-21 05:38:12', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0.68, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(198, 296, 'SCS004450A16OP05', 'SHEARING E34-3.0X67X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '1:59:43', '2023-03-21 06:40:50', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 15000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(199, 0, 'SCS004450A17OP05', 'SHEARING E34-2.5X200X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '2:00:49', '2023-03-14 08:48:02', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 66, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(200, 116, 'SCS004450A15OP05', 'SHEARING E34-3.0X79X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '2:01:54', '2023-03-21 06:28:26', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(201, 0, 'CBB0004OP05', 'SHEARING E34-2X155X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '30-11-2022', '2:03:55', '2023-03-25 12:03:48', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(203, 2381, '234844OP05', 'SHEARING D513-1X178X310MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '2000', NULL, NULL, 3, '30-11-2022', '2:05:27', '2023-03-27 03:58:26', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 70000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(204, 0, '235766OP05', 'SHEARING E34-4X81X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '0', NULL, NULL, 3, '30-11-2022', '2:06:28', '2023-03-14 09:34:36', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 3000, NULL, 0, 3.53, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(205, 0, '1000699234OP05', 'SHEARING HR2-5X198X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '0', NULL, NULL, 3, '30-11-2022', '2:07:16', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'HR2', 0, 0, 0, 0, 0),
(206, 249, 'CM000096OP10', 'U301_OUTER COVER ASSY LHS_CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 108.6, NULL, NULL, NULL, 3, '30-11-2022', '2:08:12', '2023-03-24 09:27:45', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 300000, NULL, 0, 0, 0, 0, '0', '0', 0, NULL, NULL, 0, 0, 0, 0, 0),
(207, 0, 'A061K571OP05', 'SHEARING E34-3X335X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '30-11-2022', '2:09:15', '2023-03-12 05:49:57', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 917.2, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(208, 0, 'A061Y103OP05', 'SHEARING E34-3X345X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '30-11-2022', '2:10:07', '0000-00-00 00:00:00', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(209, 7853, 'BSP_RM01', 'CR SHEET_1.0X1250X2180 MM D513 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 68.5, '1000', NULL, NULL, 3, '30-11-2022', '3:54:32', '2023-03-27 03:58:13', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 4, 0, 0, 0, 0),
(210, 6, 'BSP_RM02', 'HRPO_2.0X1250X2500 MM E34 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '30-11-2022', '4:56:46', '2023-03-11 12:49:13', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 1566, 0, 0, 0, 0),
(211, 524, 'BSP_RM03', 'HRPO_3.0X1250X2500 MM E34 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '30-11-2022', '4:57:47', '2023-03-28 04:06:29', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 876, 0, 0, 0, 0),
(212, 698, 'BSP_RM05', 'HRPO_4.0X1250X2500 MM E34 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '0', NULL, NULL, 3, '30-11-2022', '4:58:39', '2023-03-28 04:06:20', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 5000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(213, 0, 'BSP_RM06', 'HRPO_4.5X1250X2500 MM E34 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '30-11-2022', '4:59:52', '0000-00-00 00:00:00', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 40000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(214, 1000, 'BSP_RM07', 'HRPO_5.0X1250X2500 MM HR2 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 60.5, '0', NULL, NULL, 3, '30-11-2022', '5:00:57', '2023-03-28 04:05:59', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 10000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'HR2', 0, 0, 0, 0, 0),
(215, 2488, 'ST000019', 'HRPO HSLA355 SIZE 3.5*1250*2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 67.5, '500', NULL, NULL, 3, '30-11-2022', '5:03:13', '2023-03-20 04:16:35', NULL, '72082540', '', '', '', '', '', '', '', NULL, NULL, 'RM', 20000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 68, 0, 0, 0, 0),
(216, 184, 'ST000020', 'HRPO HSLA355 SIZE 4*1250*2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 64.5, '3000', NULL, NULL, 3, '30-11-2022', '5:05:02', '2023-03-04 09:51:36', NULL, '72082540', '', '', '', '', '', '', '', NULL, NULL, 'RM', 130000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 206, 0, 0, 0, 0),
(217, 0, 'BSP_RM04', 'HRPO_1.6X1250X2500 MM E34 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '0', NULL, NULL, 3, '30-11-2022', '5:09:42', '0000-00-00 00:00:00', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, 'RM', 5000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(218, 9155, 'ST000015', 'HRPO HSLA355 SIZE 2*1250*2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 65, '3000', NULL, NULL, 3, '30-11-2022', '5:25:18', '2023-03-27 08:42:49', NULL, '72082540', '', '', '', '', '', '', '', NULL, NULL, 'RM', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 105, 0, 0, 0, 0),
(219, 0, 'ST000018', 'HRPO HSLA355 SIZE 3*1250*2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 67.5, '0', NULL, NULL, 3, '30-11-2022', '5:27:30', '0000-00-00 00:00:00', NULL, '72082540', '', '', '', '', '', '', '', NULL, NULL, 'RM', 10000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(220, 0, 'SCS004450A17OP30', 'STOPPER CUP_DRAW AND RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 4.5, NULL, NULL, NULL, 3, '30-11-2022', '9:32:24', '2023-03-29 06:49:18', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(221, 2, 'D9MS20879OP05', 'SHEARING E34-1.6X46X1250 MM ', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '2/12/2022', '6:05:23', '2023-03-25 12:01:48', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 40000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(222, 191, 'D8MS24403OP05', 'SHEARING E34-2.0X68X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '3000', NULL, NULL, 3, '2/12/2022', '6:06:33', '2023-03-27 08:27:12', NULL, '7208', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(223, 1040, 'BSL002055836OP80', 'FRM ARMRESET MTG BKT-BSL002055836NCPAA-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 4.7, NULL, NULL, NULL, 3, '4/12/2022', '5:31:13', '2023-03-29 12:36:53', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 100000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(224, 24756, 'BSL002230976OP10', 'IR LONG VALANCE BKT LH SK216-BSL002230976NCPAA', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 5.66, '3000', NULL, NULL, 3, '4/12/2022', '5:38:10', '2023-03-19 07:13:09', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', 13988, NULL, 'NA', 0, 0, 0, 0, 0),
(225, 0, 'BSL002230976OP20', 'IR LONG VALANCE BKT LH SK216-BSL002230976-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 2.25, '3000', NULL, NULL, 3, '4/12/2022', '5:40:24', '2023-03-14 11:41:37', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(226, 0, 'BSL002231007OP20', 'LONG VALANCE BKT RH SK216-BSL002231007NCPAA-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 2.25, '3000', NULL, NULL, 3, '4/12/2022', '5:42:53', '2023-03-14 11:42:05', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(227, 27557, 'BSL002231007OP10', 'LONG VALANCE BKT RH SK216-BSL002231007NCPAA', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 5.66, '3000', NULL, NULL, 3, '4/12/2022', '5:46:09', '2023-03-19 07:13:33', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', 11147, NULL, 'NA', 0, 0, 0, 0, 0),
(228, 0, 'SCS004450A15OP30', 'SMALL BRACKET-LHS-PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '4/12/2022', '7:01:44', '0000-00-00 00:00:00', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 12000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(229, 352, 'CM000303OP20', 'ENG MTG BKT LH-S101-CED COATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 10.5, '100', NULL, NULL, 3, '4/12/2022', '7:23:39', '2023-03-27 12:15:12', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 15000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(230, 155, 'CM000304OP20', 'CM000304-ENG MTG BKT RH-S101_CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 7.5, '200', NULL, NULL, 3, '5/12/2022', '12:25:00', '2023-03-27 12:14:42', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 15000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(231, 500, 'D7TM30542OP20', 'D7TM30542-TRACK STOPPER BRACKET OB REAR_CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0.85, '1000', NULL, NULL, 3, '5/12/2022', '2:22:00', '2023-03-27 04:33:29', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 1500000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(232, 2481, 'D7TM30542OP10', 'D7TM30542-TRACK STOPPER BRACKET OB REAR TRACK STOPPER BRACKET OB REAR', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 5.44, NULL, NULL, NULL, 3, '5/12/2022', '2:32:22', '2023-03-27 08:57:37', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 1500000, NULL, 0, 0, 0, 0, '0', '0', 681, NULL, 'NA', 0, 0, 0, 0, 0),
(233, 1746, 'D7TM30109OP10', 'D7TM30109-TRACK STOPPER BRACKET LOWER OB 60P', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 5.04, '3000', NULL, NULL, 3, '5/12/2022', '2:33:43', '2023-03-27 08:57:50', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 1500000, NULL, 0, 0, 0, 0, '', '', 772, NULL, 'NA', 0, 0, 0, 0, 0),
(234, 49, 'CM000304OP10', 'CM000304-ENG MTG BKT RH-S101_WELDING ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 182.4, '300', NULL, NULL, 3, '5/12/2022', '2:38:09', '2023-03-27 10:22:56', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', 5, NULL, NULL, 0, 0, 0, 0, 0),
(235, 0, 'D8MS-24404CED', 'TOP TETHER WIRE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 2, '5000', NULL, NULL, 3, '9/12/2022', '5:28:36', '2023-03-29 08:39:57', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, 'Subcon grn', 120000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(236, 0, 'BSL002020815NCPAG', 'BRACKET FERROUS,RECLINER 3RS UPPER RH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 69.23, '3000', NULL, NULL, 3, '11/12/2022', '1:22:40', '0000-00-00 00:00:00', NULL, '9401', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(238, 0, 'SBT000050141OP30', 'UPPER LIMIT_U301 (DRAW I & DRAW II)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, '3000', NULL, NULL, 3, '11/12/2022', '2:06:32', '0000-00-00 00:00:00', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Subcon grn', 300000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(239, 0, 'SBT000050141', 'UPPER LIMIT_TURNING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 2.5, '3000', NULL, NULL, 3, '11/12/2022', '2:18:36', '2023-03-29 06:32:53', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 300000, NULL, 0, 4935, 0, 0, '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(240, 0, 'CM000096OP20', 'U301_OUTER COVER ASSY LHS-COATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 6, NULL, NULL, NULL, 3, '11/12/2022', '2:54:58', '2023-03-25 06:04:04', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Subcon grn', 300000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(241, 0, 'SCS02429_12', 'TOP PLATE RH                       ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 39.09, '500', NULL, NULL, 3, '11/12/2022', '5:00:38', '2023-03-12 07:07:53', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 36000, NULL, 0, 86, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(242, 0, 'DASRM_36.', 'E34- 1.6X250X2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 64.01, '1000', NULL, NULL, 3, '12/12/2022', '5:48:56', '0000-00-00 00:00:00', NULL, '72092620', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 0, '250', '1.6', NULL, NULL, '0', 0, 0, 0, 0, 0),
(243, 2499, 'B5', '1.5 X 1250 X 2500 MM CR HC-340LA', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 77, '1000', NULL, NULL, 3, '13-12-2022', '2:15:17', '2023-03-20 06:25:04', NULL, '72082540', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 150000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(244, 33111, '234844OP10', 'COVER PLATE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 8.5, '2000', NULL, NULL, 3, '18-12-2022', '4:43:59', '2023-03-27 11:33:43', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'NULL', 150000, NULL, 0, 0, 0, 0, '', '', 4406, NULL, '0', 0, 0, 0, 0, 0),
(245, 0, 'SBT00800B42OP05', 'SHEARING E34-4.0X143X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '6000', NULL, NULL, 3, '22-12-2022', '2:43:55', '2023-03-25 12:08:50', NULL, '72082540', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 200000, NULL, 0, 0, 0, 5.612, '143x1250mm', '4mm', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(246, 1, 'SBT000050141OP10', 'UPPER LIMIT_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '6000', NULL, NULL, 3, '22-12-2022', '3:39:14', '2023-03-08 11:59:55', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 300000, NULL, 0, 0, 0, 0, '', '', 9599, NULL, 'NA', 0, 0, 0, 0, 0),
(247, 0, 'DASRM_49', 'E-34 2X1500X2500 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 47.01, '500', NULL, NULL, 3, '22-12-2022', '4:47:56', '2023-03-05 09:09:45', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 30000, NULL, 0, 0, 0, 49.06, '1250X2500 MM', '2.0MM', NULL, NULL, 'E34', 23, 0, 0, 0, 0),
(248, 0, 'CBS0004OP05', 'SHEARING E34-3X125X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 74, '1000', NULL, NULL, 3, '22-12-2022', '5:52:54', '0000-00-00 00:00:00', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 240000, NULL, 0, 0, 0, 3.68, '125x1250 mm', '3.0 MM', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(249, 0, 'CBS0004OP05', 'SHEARING E34-3X125X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 74, '1000', NULL, NULL, 3, '22-12-2022', '5:56:58', '2023-03-25 12:04:44', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, NULL, 240000, NULL, 0, 0, 0, 3.68, '125x1250 mm', '3.0 MM', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(250, 2274, 'D7TM30108OP05', 'SHEARING E34-2.5X235X1250mm', NULL, NULL, NULL, NULL, '1st', 2, 17, 'NA', 47.01, NULL, NULL, NULL, 3, '22-12-2022', '6:09:42', '2023-02-11 08:30:59', NULL, '72082730', NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', 1000000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(251, 0, 'D7TM89831OP05', 'SHEARING SPFFH590-2.6X177X1250', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 48.45, '3000', NULL, NULL, 3, '22-12-2022', '7:13:52', '2023-03-25 12:05:51', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 15000, NULL, 0, 0, 0, 4.52, '177x1250 mm', '2.6mm', NULL, NULL, 'SPFFH590', 0, 0, 0, 0, 0),
(252, 2042, '235766OP40', 'Angle L Bkt-ZINC BLUE PLATING', NULL, NULL, NULL, NULL, '1st', 1, NULL, 'NA', 1, '500', NULL, NULL, 3, '25-12-2022', '11:36:01', '2023-03-28 04:10:11', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Subcon grn', 2000000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(253, 14988, 'SBT000050141OP50', 'UPPER LIMIT_PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 106.1, '3000', NULL, NULL, 3, '25-12-2022', '11:37:40', '2023-03-18 09:39:05', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 300000, NULL, 0, 0, 0, 0, '0', '0', 41, NULL, '0', 0, 0, 0, 0, 0),
(254, 0, 'MS Block-14x40x70mm', 'MS Block-14x40x70mm', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '25-12-2022', '11:59:12', '0000-00-00 00:00:00', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 6000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'MS', 0, 0, 0, 0, 0),
(255, 0, '1000699234OP70', 'Shifter Mounting Plate Ultra Rhd-ZINC BLUE PLATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 11.25, '500', NULL, NULL, 3, '25-12-2022', '12:02:07', '2023-03-14 12:06:50', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Subcon grn', 180000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(256, 185, '1000699234OP60', 'Shifter Mounting Plate Ultra Rhd-Machining', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '25-12-2022', '12:02:51', '2023-03-27 13:30:45', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'NULL', 180000, NULL, 0, 0, 0, 0, '', '', 585, NULL, 'NA', 0, 0, 0, 0, 0),
(257, 0, 'W05161903462', 'HR BLANK-EGP-BRACKET MOUNTING-4X374X5..', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '25-12-2022', '12:14:14', '0000-00-00 00:00:00', NULL, '8433', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 180000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(258, 160, '1000699234OP50', 'C02 welding', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 146.71, '5000', NULL, NULL, 3, '25-12-2022', '1:37:27', '2023-03-27 13:24:06', NULL, '9401', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '0', '0', 85, NULL, '0', 0, 0, 0, 0, 0),
(259, 10200, 'BSP_RM08', 'HRPO_6.0X1250X3000 MM HR GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 65, '1000', NULL, NULL, 3, '27-12-2022', '2:23:35', '2023-02-10 06:18:10', NULL, '720837', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(260, 0, 'BSP_RM09', 'HRPO_8.0X1500X3000 MM HR GRADE E350C', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 62, '1000', NULL, NULL, 3, '27-12-2022', '2:24:48', '0000-00-00 00:00:00', NULL, '720837', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(261, 0, 'BSP_RM10', 'HRPO_10.0X1500X3000 MM HR GRADE E350 C', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 62, '1000', NULL, NULL, 3, '27-12-2022', '2:31:03', '0000-00-00 00:00:00', NULL, '720837', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(262, 0, 'BSP_RM11', 'HRPO_12.0X1500X3000 MM HR GRADE E350  C', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 62, '1000', NULL, NULL, 3, '27-12-2022', '2:32:20', '0000-00-00 00:00:00', NULL, '720837', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(263, 0, 'BSP_RM12', 'HRPO_15.0X1500X3000 MM HR GRADE E350 C', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 64.5, '1000', NULL, NULL, 3, '27-12-2022', '2:33:28', '0000-00-00 00:00:00', NULL, '720836', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(264, 0, 'BSP_RM13', 'HRPO_16.0X1250X3000 MM HR GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 0, '1000', NULL, NULL, 3, '27-12-2022', '2:34:24', '0000-00-00 00:00:00', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(265, 0, 'D7TM30382OP05', 'SHEARING E34-3X183X1250', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 1, '100', NULL, NULL, 3, '09-01-2023', '08:57:20', '2023-03-27 07:17:04', NULL, 'NA', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 12.8, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(266, 0, 'D7TM-30904', 'DAMPER PIN ARRESTER SPACER', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '1000', NULL, NULL, 3, '11-01-2023', '11:47:26', '2023-03-27 08:58:16', NULL, '8708', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 67, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(267, 300, '87531-T1N00', 'RIVET- LINK BKT HINGE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 20, '1000', NULL, NULL, 3, '11-01-2023', '04:57:42', '2023-03-03 05:55:43', NULL, '73181500', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 300, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(268, 143, '4X16\"', 'BUFFING WHEEL ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 24, '100', NULL, NULL, 3, '13-01-2023', '09:37:38', '2023-01-13 08:03:20', NULL, '68051010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 8, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(269, 6, '1X16\"', 'CUTTING WHEEL ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 15, '50', NULL, NULL, 3, '13-01-2023', '09:39:03', '2023-01-13 11:37:02', NULL, '6805', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 15, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(270, 54, '4X16X100\"', 'GRINDING WHEEL ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 24, '100', NULL, NULL, 3, '13-01-2023', '09:40:02', '2023-01-13 08:02:15', NULL, '68042290', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 5, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(271, 448, 'GAS', 'ACM GAS-T', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 67, '140', NULL, NULL, 3, '13-01-2023', '09:49:41', '2023-01-17 13:34:37', NULL, '28042100', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 10000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(272, 14, 'GAS-T', 'OXYGEN GAS-T', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 30, '50', NULL, NULL, 3, '13-01-2023', '09:52:46', '2023-01-13 08:00:58', NULL, '28044090', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 7, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(273, 0, 'A061L285OP05', 'SHEARING E34-3X330X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 47.01, '500', NULL, NULL, 3, '14-01-2023', '04:49:56', '2023-03-12 06:37:14', NULL, '72083890', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 495.24, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(274, 0, '55500860358', 'NITROGEN GAS  CYL', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 45, '25', NULL, NULL, 3, '16-01-2023', '10:25:54', '2023-01-16 04:55:54', NULL, '28043000', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(275, 0, '55500860153', 'CO2 LIQUID GAS', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 12, '250', NULL, NULL, 3, '16-01-2023', '10:29:09', '2023-01-16 04:59:09', NULL, '28112190', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 2500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(276, 0, 'GAS- HL', 'HELIUM GAS CYL', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 2100, '25', NULL, NULL, 3, '16-01-2023', '10:30:28', '2023-01-16 05:00:28', NULL, '28042910', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(277, 0, 'GAS- NT', 'NITROGEN LIQUID GAS', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 16, '250', NULL, NULL, 3, '16-01-2023', '10:35:11', '2023-01-16 05:05:11', NULL, '28043000', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 2500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(278, 0, 'GAS- O2', 'OXIGEN LIQUID GAS', NULL, NULL, NULL, NULL, NULL, 6, NULL, 'NA', 16, '250', NULL, NULL, 3, '16-01-2023', '10:36:50', '2023-01-16 05:06:50', NULL, '2804', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 2500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(279, 0, '3M ', '3M EAR PLUG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 9, '50', NULL, NULL, 3, '16-01-2023', '03:14:37', '2023-01-16 09:44:37', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(280, 0, '3M SC', '3M SCOTCH BRITE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 18, '50', NULL, NULL, 3, '16-01-2023', '03:15:44', '2023-01-16 09:45:44', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(281, 0, 'SPATGUARD', 'ANTI-SPATTER SOLUTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 80, '5', NULL, NULL, 3, '16-01-2023', '03:16:39', '2023-01-16 09:46:39', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(282, 0, 'WIRE', 'BINDING WIRE', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 90, '25', NULL, NULL, 3, '16-01-2023', '03:17:41', '2023-01-16 09:47:41', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(283, 0, '39 BS', 'BLACK SPRAY (MAT)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 180, '25', NULL, NULL, 3, '16-01-2023', '03:18:33', '2023-01-16 09:48:33', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(284, 0, 'TVS-500', 'BRAKE OIL', NULL, NULL, NULL, NULL, NULL, 4, NULL, 'NA', 255, '5', NULL, NULL, 3, '16-01-2023', '03:19:28', '2023-01-16 09:49:28', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(285, 0, 'LPT0120', 'BREAKWAY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2400, '50', NULL, NULL, 3, '16-01-2023', '03:34:50', '2023-01-16 10:04:50', NULL, '84669390', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(286, 0, 'LPT0102', 'NOZZLE- 1.0MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 190, '25', NULL, NULL, 3, '16-01-2023', '03:35:44', '2023-01-16 10:05:44', NULL, '84669390', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(287, 0, 'LPTF0064', 'NOZZLE HD-1.4 MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 190, '25', NULL, NULL, 3, '16-01-2023', '03:36:32', '2023-01-16 10:06:32', NULL, '84669390', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(288, 0, '48 MM X 40 MTR 2\"', 'BOPP TAPE BROWN', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 17, '250', NULL, NULL, 3, '16-01-2023', '03:38:22', '2023-01-16 10:08:22', NULL, '39199090', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 2500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(289, 0, '48 MM X 40 MTR 2\" TR', 'BOPP TAPE TRANS', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 17, '125', NULL, NULL, 3, '16-01-2023', '03:39:39', '2023-01-16 10:09:39', NULL, '39199090', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 1250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(290, 0, '300 MM X 75  MIC', 'POLY ROLL FOR CUP ONE SIDE CUT', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 125, '50', NULL, NULL, 3, '16-01-2023', '03:40:56', '2023-01-16 10:10:56', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(291, 0, '50 MM X 50 MIC-4\"', 'RAPPING ROLL- 4 \"STRECH FILM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 135, '50', NULL, NULL, 3, '16-01-2023', '03:43:46', '2023-01-16 10:13:46', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(292, 0, '100 MM X 50 MIC-12\"', 'RAPPING ROLL- 12\"STRECH FILM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 135, '50', NULL, NULL, 3, '16-01-2023', '03:44:55', '2023-01-16 10:14:55', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(293, 0, '100 MM X 50 MIC- 4\"', 'WRAPPING ROLL- STRECH FILM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 140, '50', NULL, NULL, 3, '16-01-2023', '03:50:50', '2023-01-16 10:20:50', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(294, 0, '250 MM X 50 MIC-12\"', 'WRAPPING ROLL- STRECH FILM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 135, '50', NULL, NULL, 3, '16-01-2023', '03:51:32', '2023-01-16 10:21:32', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(295, 0, '500 MM X 50 MIC-20\"', 'WRAPPING ROLL- STRECH FILM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 135, '50', NULL, NULL, 3, '16-01-2023', '03:52:19', '2023-01-16 10:22:19', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(296, 0, '600 MM X 50 MIC-24\"', 'WRAPPING ROLL- STRECH FILM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 135, '50', NULL, NULL, 3, '16-01-2023', '03:53:10', '2023-01-16 10:23:10', NULL, '39201012', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(297, 0, 'TEFFLON TAPE', 'CENTERING TAPE', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 10, '25', NULL, NULL, 3, '16-01-2023', '03:54:30', '2023-01-16 10:24:30', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(298, 0, 'POLYBAG- 200 X 200 ', 'FOR -0407/2621/3881/3885/1217/6029/6134/8316/4721', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1.4, '500', NULL, NULL, 3, '17-01-2023', '11:49:09', '2023-01-17 06:19:09', NULL, '39232990', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(299, 0, 'POLYBAG- 200 X 400', 'FOR - 1166/5580', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1.4, '500', NULL, NULL, 3, '17-01-2023', '11:50:22', '2023-01-17 06:20:22', NULL, '39232990', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(300, 0, 'POLYBAG- 200 X 510', 'FOR - 1509', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1.4, '250', NULL, NULL, 3, '17-01-2023', '11:52:01', '2023-01-17 06:22:01', NULL, '39232990', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(301, 0, 'POLYBAG- 350X480X225G', 'TRANS-14X19  (COVER PLATE)', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 135, '50', NULL, NULL, 3, '17-01-2023', '11:56:18', '2023-01-17 06:26:18', NULL, '39232100', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(302, 0, '5 PLY- 360X270X180 MM', 'CC BOX-FOR COVER PLATE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 25, '50', NULL, NULL, 3, '17-01-2023', '12:25:12', '2023-01-17 06:55:12', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(303, 0, '88923T1NOP05', 'SHEARING -SPRC440-0.6X635X1250 MM ', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '17-01-2023', '03:00:14', '2023-03-03 13:30:12', NULL, '72083890', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 1.25, 0, 0, '', '', NULL, NULL, 'SPRC440', 0, 0, 0, 0, 0),
(304, 0, '87651_87551-T1NOP05', 'SHEARING-SPFC590-1.6X515X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '18-01-2023', '02:14:52', '2023-03-12 06:28:34', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 110.6, 0, 0, '', '', NULL, NULL, 'SPFC590', 0, 0, 0, 0, 0),
(305, 0, '87870-T1N00', 'Recliner Spring Stopper Bracket', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '18-01-2023', '03:06:33', '2023-02-13 11:21:58', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 300, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(306, 3000, 'DASRM00SPFH-03 ', 'HRPO_ 2.0X1250X2500 MM SPFH 590P', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 84, '1000', NULL, NULL, 3, '20-01-2023', '10:30:50', '2023-03-24 09:54:39', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(307, 0, '24 KD', 'CONNECTOR CO2 TIP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 30, '25', NULL, NULL, 3, '20-01-2023', '12:15:01', '2023-01-20 06:45:01', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(308, 0, '36 KD', 'CONNECTOR CO2 TIP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 35, '25', NULL, NULL, 3, '20-01-2023', '12:15:40', '2023-01-20 06:45:40', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(309, 0, '0.80 MM LONG', 'CONTACT TIP 0.80- LONG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 35, '25', NULL, NULL, 3, '20-01-2023', '12:16:41', '2023-01-20 06:46:41', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(310, 0, '0.80 MM- M6*25 E-CU', 'CONTACT TIP 0.80- SMALL', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 20, '50', NULL, NULL, 3, '20-01-2023', '12:17:20', '2023-01-20 06:47:20', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(311, 0, '0.80 MM- M8*30 E-CU', 'CONTACT TIP 0.80- WIDTH', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 35, '50', NULL, NULL, 3, '20-01-2023', '12:17:59', '2023-01-20 06:47:59', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(312, 0, '1.20 MM- M6*25 E-CU', 'CONTACT TIP 1.20 - SMALL', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 20, '25', NULL, NULL, 3, '20-01-2023', '12:18:42', '2023-01-20 06:48:42', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(313, 0, '1.20 MM LONG', 'CONTACT TIP 1.20 LASER- LONG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 35, '25', NULL, NULL, 3, '20-01-2023', '12:19:25', '2023-01-20 06:49:25', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(314, 0, '1.20 MM- M8*30 E-CU', 'CONTACT TIP 1.20 LASER- WIDTH', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 35, '25', NULL, NULL, 3, '20-01-2023', '12:20:12', '2023-01-20 06:50:12', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(315, 0, '50GM BLUE', 'KNITTED HANDGLOVES 50GM BLUE', NULL, NULL, NULL, NULL, NULL, 7, NULL, 'NA', 6.2, '1000', NULL, NULL, 3, '20-01-2023', '12:25:44', '2023-01-20 06:55:44', NULL, '61169990', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(316, 0, 'JEANS COTTON', 'JEANS HANDGLOVES', NULL, NULL, NULL, NULL, NULL, 7, NULL, 'NA', 12.5, '250', NULL, NULL, 3, '20-01-2023', '12:27:37', '2023-01-20 06:57:37', NULL, '61169990', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(317, 0, 'COTTON REGULAR', 'COTTON WASTAGE', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 40, '50', NULL, NULL, 3, '20-01-2023', '12:29:27', '2023-01-20 06:59:27', NULL, '61169990', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(318, 0, 'CC BOX- 920 x 1300 x 1110', 'FOR- 5888896-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 5198, '5', NULL, NULL, 3, '20-01-2023', '12:37:04', '2023-01-20 07:07:04', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(319, 0, 'CC BOX- 760 X 760 X 950', 'FOR- 5780407-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 3228, '5', NULL, NULL, 3, '20-01-2023', '12:37:56', '2023-01-20 07:07:56', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(320, 0, 'CC BOX- 580 X 810 X 970', 'FOR- 5442621-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2900, '5', NULL, NULL, 3, '20-01-2023', '12:38:46', '2023-01-20 07:08:46', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(321, 0, 'CC BOX- 480 X 930 X 690', 'FOR- 5226029-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1744, '5', NULL, NULL, 3, '20-01-2023', '12:39:39', '2023-01-20 07:09:39', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(322, 0, 'CC BOX- 830 X 980 X 1010', 'FOR- 5231166-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 4300, '5', NULL, NULL, 3, '20-01-2023', '12:41:17', '2023-01-20 07:11:17', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(323, 0, 'CC BOX- 1030 X 1000 X 680', 'FOR- 5781509-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 3415, '5', NULL, NULL, 3, '20-01-2023', '12:42:16', '2023-01-20 07:12:16', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(324, 0, 'CC BOX- 390 X 630 X 740', 'FOR- 5441217-01', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2366, '5', NULL, NULL, 3, '20-01-2023', '12:43:18', '2023-01-20 07:13:18', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(325, 0, 'CC BOX- 330 X 1040 X 800', 'FOR- 5443881-01 BRACKET', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1148, '5', NULL, NULL, 3, '20-01-2023', '12:44:16', '2023-01-20 07:14:16', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(326, 0, '36 KD GD', 'GAS DISPOSER BIG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 19, '25', NULL, NULL, 3, '20-01-2023', '01:20:40', '2023-01-20 07:50:40', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(327, 0, '24 KD GD', 'GAS DISPOSER SMALL', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 10, '50', NULL, NULL, 3, '20-01-2023', '01:21:36', '2023-01-20 07:51:36', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(328, 0, 'SILICON PAPER', 'POLISH PAPER WATER PROOF  G80', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 20, '50', NULL, NULL, 3, '20-01-2023', '01:23:22', '2023-01-20 07:53:22', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(329, 0, '50 X 2000 MM', 'GRINDING BELT- G36', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 80, '25', NULL, NULL, 3, '20-01-2023', '01:24:13', '2023-01-20 07:54:13', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(330, 0, 'GREEN PAINT', 'PAINT MARKER- GREEN', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 50, '50', NULL, NULL, 3, '20-01-2023', '01:25:37', '2023-01-20 07:55:37', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(331, 0, 'WHITE PAINT', 'PAINT MARKER- WHITE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 50, '50', NULL, NULL, 3, '20-01-2023', '01:27:07', '2023-01-20 07:57:07', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(332, 0, 'YELLOW PAINT', 'PAINT MARKER- YELLOW', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 50, '50', NULL, NULL, 3, '20-01-2023', '01:28:08', '2023-01-20 07:58:08', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(333, 0, 'XEROX', 'PAPER RIM A4', NULL, NULL, NULL, NULL, NULL, 8, NULL, 'NA', 280, '25', NULL, NULL, 3, '20-01-2023', '01:30:26', '2023-01-20 08:00:26', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(334, 0, 'GREEN PERMANENT', 'PARMANENT MARKER- GREEN', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 20, '50', NULL, NULL, 3, '20-01-2023', '01:32:42', '2023-01-20 08:02:42', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0);
INSERT INTO `child_part` (`id`, `stock`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `store_rack_location`, `store_stock_rate`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `gst_id`, `sub_type`, `max_uom`, `min_uom`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `weight`, `size`, `thickness`, `sub_con_stock`, `rejection_stock`, `grade`, `sharing_qty`, `machine_mold_issue_stock`, `production_scrap`, `production_rejection`, `deflashing_stock`) VALUES
(335, 0, '25 MM WHEEL', 'PENCIL WHEEL GRINDER BIG', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 28, '25', NULL, NULL, 3, '20-01-2023', '01:33:38', '2023-01-20 08:03:38', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(336, 0, '10 MM WHEEL', 'PENCIL WHEEL GRINDER SMALL', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 14, '50', NULL, NULL, 3, '20-01-2023', '01:34:19', '2023-01-20 08:04:19', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(337, 1003, 'D7TM30122OP10', 'FRONT MTG BRACKET RIVETTED ASSY. IB 60P(D7TM-30120)', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '20-01-2023', '03:47:53', '2023-03-19 06:36:47', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'NULL', 50000, NULL, 0, 0, 0, 0, '', '', 0, NULL, 'NA', 0, 0, 0, 0, 0),
(338, 0, 'M10 REG NUT', 'ELECTROD CAP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 330, '5', NULL, NULL, 3, '22-01-2023', '11:19:08', '2023-01-22 05:49:08', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(339, 0, 'M10 BOTTOM', 'PROJECTION ELECROD BOTTOM COPPER', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1250, '5', NULL, NULL, 3, '22-01-2023', '11:20:15', '2023-01-22 05:50:15', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(340, 0, '3227- M10', 'SPOT ELECTORD TIP- M10', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 240, '5', NULL, NULL, 3, '22-01-2023', '11:21:16', '2023-01-22 05:51:16', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(341, 0, 'M10- PIN', 'SS PIN M10', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 120, '5', NULL, NULL, 3, '22-01-2023', '11:22:16', '2023-01-22 05:52:16', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(342, 0, 'M6 REG NUT', 'ELECTROD CAP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 305, '5', NULL, NULL, 3, '22-01-2023', '11:22:56', '2023-01-22 05:52:56', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(343, 0, 'M6  BOTTOM', 'PROJECTION ELECROD BOTTOM COPPER M6', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1250, '5', NULL, NULL, 3, '22-01-2023', '11:23:44', '2023-01-22 05:53:44', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(344, 0, '3227- M6', 'SPOT ELECTORD TIP- M6', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 240, '5', NULL, NULL, 3, '22-01-2023', '11:24:25', '2023-01-22 05:54:25', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(345, 0, 'M6- PIN', 'SS PIN M6', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 120, '5', NULL, NULL, 3, '22-01-2023', '11:25:10', '2023-01-22 05:55:10', NULL, '8311', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(346, 0, 'GUM TAPE', 'INSULATION TAPE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 10, '10', NULL, NULL, 3, '22-01-2023', '11:26:34', '2023-01-22 05:56:34', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(347, 0, 'KR 350A', 'INSULATOR KR350A', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 55, '5', NULL, NULL, 3, '22-01-2023', '11:27:07', '2023-01-22 05:57:07', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(348, 0, 'APPRON- CHEST', 'LEATHER APPRON CHEST', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 375, '5', NULL, NULL, 3, '22-01-2023', '11:27:59', '2023-01-22 05:57:59', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(349, 0, 'APPRON- HAND', 'LEATHER APPRON HAND', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 70, '20', NULL, NULL, 3, '22-01-2023', '11:28:52', '2023-01-22 05:58:52', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 200, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(350, 0, '24 KD LINEAR', 'LINEAR -0.80 MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 210, '5', NULL, NULL, 3, '22-01-2023', '11:29:56', '2023-01-22 05:59:56', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(351, 0, '36 KD LINEAR', 'LINEAR -1.20 MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 210, '5', NULL, NULL, 3, '22-01-2023', '11:30:38', '2023-01-22 06:00:38', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(352, 0, 'SCWOBG2-5', 'OIL LUBRICUNT 4000 HRS', NULL, NULL, NULL, NULL, NULL, 4, NULL, 'NA', 1017.6, '5', NULL, NULL, 3, '22-01-2023', '11:32:53', '2023-01-22 06:02:53', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(353, 0, 'KS2-BE102C', 'NC.- RED 10A', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 40, '5', NULL, NULL, 3, '22-01-2023', '11:34:45', '2023-01-22 06:04:45', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(354, 0, 'KS2-BE101C', 'NO.- GREEN 10A', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 40, '5', NULL, NULL, 3, '22-01-2023', '11:35:35', '2023-01-22 06:05:35', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(355, 0, '8\"-1/4', 'PU CONNECTOR- IRON', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 35, '5', NULL, NULL, 3, '22-01-2023', '11:36:48', '2023-01-22 06:06:48', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(356, 0, '12\"-3/8', 'PU CONNECTOR- IRON', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 55, '5', NULL, NULL, 3, '22-01-2023', '11:37:23', '2023-01-22 06:07:23', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(357, 0, '12X12\"', 'PU CONNECTOR- PLASTIC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 45, '5', NULL, NULL, 3, '22-01-2023', '11:38:18', '2023-01-22 06:08:18', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(358, 0, '8X12\"', 'PU CONNECTOR- PLASTIC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 40, '5', NULL, NULL, 3, '22-01-2023', '11:42:53', '2023-01-22 06:12:53', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(359, 0, '6X6\"', 'PU CONNECTOR- PLASTIC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 25, '5', NULL, NULL, 3, '22-01-2023', '11:43:29', '2023-01-22 06:13:29', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(360, 0, '10X10\"', 'PU CONNECTOR- PLASTIC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 40, '5', NULL, NULL, 3, '22-01-2023', '11:44:05', '2023-01-22 06:14:05', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(361, 0, '8X8\"', 'PU CONNECTOR- T JOINT PLASTIC', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 48, '5', NULL, NULL, 3, '22-01-2023', '11:44:47', '2023-01-22 06:14:47', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '', 0, 0, 0, 0, 0),
(362, 0, '12\"- 12\"', 'PU ONNECTOR- T JOINT', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 60, '15', NULL, NULL, 3, '22-01-2023', '11:45:58', '2023-01-22 06:15:58', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(363, 0, '8X12\" PIPE', 'PU PIPE', NULL, NULL, NULL, NULL, NULL, 3, NULL, 'NA', 18, '5', NULL, NULL, 3, '22-01-2023', '11:47:01', '2023-01-22 06:17:01', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(364, 0, 'RESTOLENE', 'RUSTY OIL', NULL, NULL, NULL, NULL, NULL, 4, NULL, 'NA', 350, '5', NULL, NULL, 3, '22-01-2023', '11:48:25', '2023-01-22 06:18:25', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(365, 0, '10 MM SMALL', 'STAPLER PIN', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 10, '10', NULL, NULL, 3, '22-01-2023', '11:51:03', '2023-01-22 06:21:03', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(366, 0, 'GREEN STICKER', 'STICKER LH U301 CUP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0.35, '5000', NULL, NULL, 3, '22-01-2023', '11:53:04', '2023-01-22 06:23:04', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(367, 0, 'WHITE STICKER', 'RM /BOP STICKER WHITE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1.3, '2000', NULL, NULL, 3, '22-01-2023', '11:54:55', '2023-01-22 06:24:55', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 5000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(368, 0, 'GREEN- 500ML', 'PARMANANT MARKER GREEN- INK', NULL, NULL, NULL, NULL, NULL, 4, NULL, 'NA', 700, '1', NULL, NULL, 3, '22-01-2023', '11:56:24', '2023-01-22 06:26:24', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 10, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(369, 0, '870X650X1050 MM', 'CC BOX WITH PALLET COVER PLATE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 2250, '5', NULL, NULL, 3, '22-01-2023', '11:57:16', '2023-01-22 06:27:16', NULL, '48191010', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(370, 0, '36 KD NECK', 'SWAN NECK- 1.2 MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 400, '5', NULL, NULL, 3, '22-01-2023', '11:58:17', '2023-01-22 06:28:17', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(371, 0, '24 KD NECK', 'SWAN NECK- 0.80 MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 375, '5', NULL, NULL, 3, '22-01-2023', '11:58:57', '2023-01-22 06:28:57', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(372, 0, '350A 12X1', 'TIP HOLDER 0.80MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 70, '5', NULL, NULL, 3, '22-01-2023', '12:01:54', '2023-01-22 06:31:54', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(373, 0, 'GUARD BIG', 'WEILDING SCREEN GUARD', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 260, '5', NULL, NULL, 3, '22-01-2023', '12:05:31', '2023-01-22 06:35:31', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(374, 0, 'E6013- 3.15X 350 MM', 'WELDING ELECTRODES', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 3.35, '180', NULL, NULL, 3, '22-01-2023', '12:06:56', '2023-01-22 06:36:56', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 1800, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(375, 0, 'ATHERMAL GS0196 CE', 'WELDING GLASS- BLACK', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 25, '20', NULL, NULL, 3, '22-01-2023', '12:08:29', '2023-01-22 06:38:29', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 200, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(376, 0, 'WHITE GLASS', 'WELDING GLASS PLAIN WHITE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 5, '50', NULL, NULL, 3, '22-01-2023', '12:10:32', '2023-01-22 06:40:32', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 500, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(377, 0, 'WHITE GOGGLE', 'WELDING GOGGLE WHITE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 40, '25', NULL, NULL, 3, '22-01-2023', '12:11:18', '2023-01-22 06:41:18', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(378, 0, 'X- BLADE SMALL', 'X- BLADE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 10, '5', NULL, NULL, 3, '22-01-2023', '12:12:04', '2023-01-22 06:42:04', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(379, 0, 'X- BLADE BIG', 'X- BLADE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 15, '5', NULL, NULL, 3, '22-01-2023', '12:12:38', '2023-01-22 06:42:38', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(380, 0, '350A PINK', 'LPT0115 CERAMIC HOLDER', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 22, '5', NULL, NULL, 3, '22-01-2023', '12:13:34', '2023-01-22 06:43:34', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(381, 0, '3MM/5MM', 'MEASURING TAPE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 75, '5', NULL, NULL, 3, '22-01-2023', '12:14:19', '2023-01-22 06:44:19', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 15, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(382, 0, 'LPT0101 NOZZLE 0.80 MM', '24 KD NOZZLE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 66, '5', NULL, NULL, 3, '22-01-2023', '12:15:53', '2023-01-22 06:45:53', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(383, 0, 'LPT0103 NOZZLE 1.2 MM', '36 KD NOZZLE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 90, '5', NULL, NULL, 3, '22-01-2023', '12:16:30', '2023-01-22 06:46:30', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(384, 0, 'LR44-1.5V', 'MAXELL CELL- SMALL', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 40, '5', NULL, NULL, 3, '22-01-2023', '12:17:17', '2023-01-22 06:47:17', NULL, '4817', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(385, 0, 'BSL002020816OP20', 'BRACKET FERROUS,RECLINER 3RS UPPER LH_2 STAGE FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '3000', NULL, NULL, 3, '01-02-2023', '08:58:06', '2023-02-01 03:28:06', NULL, '9401', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'HSLA500', 0, 0, 0, 0, 0),
(386, 0, 'D6MS-52123', 'TUBE HSLA1-19.05X1.6X310 MM', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '500', NULL, NULL, 3, '05-02-2023', '03:02:21', '2023-02-05 09:32:21', NULL, '7306901', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(387, 1508, 'BSL002020815OP10', 'BRACKET FERROUS,RECLINER 3RS UPPER RH-BLANK', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 0, NULL, NULL, NULL, 3, '10-02-2023', '04:49:44', '2023-03-04 07:03:23', NULL, '72092620', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 50000, NULL, 0, 0, 0, 39.25, '0', '0', NULL, NULL, 'SPFC590', 5, 0, 0, 0, 0),
(388, 0, '87870T1NOP05', 'SHEARING E34-3X120X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '12:35:18', '2023-02-14 08:15:36', NULL, '72083890', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 25000, NULL, 0, 1.2, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(389, 0, 'DASRM00SPFH-3', 'SHEET SPFH-590P 2.0X1150X2570 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '13-02-2023', '01:35:27', '2023-02-13 08:21:40', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 350000, NULL, 0, 0, 0, 46.4, '', '', NULL, NULL, 'SPFH-590', 3, 0, 0, 0, 0),
(390, 0, '88336_88436T1NOP05', 'SHEARING-SPFH590-2.0X512X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '13-02-2023', '01:50:31', '2023-03-27 06:43:33', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 250000, NULL, 0, 104.97, 0, 0, '', '', NULL, NULL, 'SPFH-590', 0, 0, 0, 0, 0),
(391, 2066, '88877-T1N00', 'T1N COVER ATTACHMENT WIRE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 3.18, '1000', NULL, NULL, 3, '14-02-2023', '12:31:56', '2023-03-06 09:34:22', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 15000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(392, 0, 'D7TM89821OP30', 'FLANGE & RESTRIKE OPERATION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '22-02-2023', '12:37:13', '2023-02-22 07:07:13', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(393, 0, 'BSL002055836OP50', 'FORMING 3 OPERATIONS', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '22-02-2023', '12:39:46', '2023-02-22 07:09:46', NULL, '9401', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(394, 0, 'L002020809OP10', 'BLANK JOB', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '22-02-2023', '02:01:18', '2023-02-22 08:31:18', NULL, '9401', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 350000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(395, 241, 'D7TM30542_109OP05', 'SHEARING E34-2.5X136X1250 ', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '02-03-2023', '03:29:53', '2023-03-27 08:18:00', NULL, '72083890', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(396, 250, '88966-T1N00', 'T1N FR LINK BRKT NORMAL', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '02-03-2023', '03:36:36', '2023-03-06 09:34:09', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(397, 0, '88211-T1N00', 'STD. WELD NUT M10 WITH PILOT GRADE 8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '2000', NULL, NULL, 3, '02-03-2023', '07:18:56', '2023-03-02 13:48:56', NULL, '7318', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 350000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(398, 0, '88222-T1N00', 'HEX WELD NUT M6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '02-03-2023', '08:06:44', '2023-03-02 14:36:44', NULL, '7318', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 350000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'NA', 0, 0, 0, 0, 0),
(399, 0, 'D7TM30236OP05', 'SHEARING E34-2X68X1250 mm', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '200', NULL, NULL, 3, '05-03-2023', '02:45:27', '2023-03-18 06:54:21', NULL, '72083890', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 69.001, 0, 0, '', '', NULL, NULL, 'E34', 0, 0, 0, 0, 0),
(400, 0, 'CM000117OP20', 'U301_OUTER COVER ASSY RHS_POWDER COATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '10-03-2023', '05:31:27', '2023-03-25 06:08:28', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Subcon grn', 350000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, '', 0, 0, 0, 0, 0),
(401, 0, 'D6MS-50258', 'TOWEL BAR PIVOT PIN', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1.75, '500', NULL, NULL, 3, '17-03-2023', '01:47:47', '2023-03-17 08:17:47', NULL, '87089900', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, '0', 0, 0, 0, 0, 0),
(402, 82, 'CM000117OP10', 'U301OUTER COVER ASSY BKT RHS', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 102.6, '500', NULL, NULL, 3, '18-03-2023', '10:18:43', '2023-03-24 05:50:14', NULL, '998898', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '0', '0', 198, NULL, '0', 0, 0, 0, 0, 0),
(403, 0, '88840_88940-T1NOP05', 'SHEARING-SPFH590-2.6X440X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '18-03-2023', '01:44:08', '2023-03-18 08:14:08', NULL, '72083890', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'SPFH-590', 0, 0, 0, 0, 0),
(404, 223, 'SCS004450A17OP10', 'STOPPER CUP_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'R1', 37.32, '100', NULL, NULL, 3, '18-03-2023', '03:34:35', '2023-03-28 10:07:39', NULL, '9401', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 150000, NULL, 0, 0, 0, 0, '', '', 1616, NULL, '', 0, 0, 0, 0, 0),
(405, 0, 'DASRM_69', 'SPFH590 2.0X1150X2570', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '25-03-2023', '11:04:44', '2023-03-27 03:51:27', NULL, '72082730', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 10000000, NULL, 0, 0, 0, 46.4, '', '', NULL, NULL, 'SPFH590', 435, 0, 0, 0, 0),
(406, 0, '73209044', 'SWITCH OFF PLATE CRADLE UH TYPE 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5', NULL, NULL, 3, '26-03-2023', '04:07:51', '2023-03-26 10:37:51', NULL, '8456', '', NULL, '', '', '', '', '', NULL, NULL, 'Subcon grn', 500, NULL, 0, 0, 0, 0, '', '12', NULL, NULL, 'E 350', 0, 0, 0, 0, 0),
(407, 0, 'BSP_RM15', 'HR_2.0X1250X2500 MM E250 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:37:53', '2023-03-26 11:07:53', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 49.6, '', '', NULL, NULL, 'E 250', 0, 0, 0, 0, 0),
(408, 0, 'BSP_RM16', 'HR_2.0X1250X3000 MM E250 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:39:27', '2023-03-26 11:09:27', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 58.88, '', '2', NULL, NULL, 'E 250', 0, 0, 0, 0, 0),
(409, 0, ' BSP_RM17', 'HR_2.0X1500X2500 MM E250 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:40:25', '2023-03-26 11:10:25', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 58.88, '', '2', NULL, NULL, 'E 250', 0, 0, 0, 0, 0),
(410, 0, 'BSP_RM18', 'HR_2.0X1500X3000 MM E250 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:41:12', '2023-03-26 11:11:12', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 70.65, '', '2', NULL, NULL, 'E 250', 0, 0, 0, 0, 0),
(411, 0, 'BSP_RM19', 'HR_3.0X1250X2500 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:42:05', '2023-03-26 11:12:05', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 73.59, '', '3', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(412, 0, 'BSP_RM20', 'HR_3.0X1250X3000 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:44:16', '2023-03-26 11:14:16', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 88.31, '', '3', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(413, 0, 'BSP_RM21', 'HR_3.0X1500X2500 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:48:44', '2023-03-26 11:18:44', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 88.31, '', '3', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(414, 0, 'BSP_RM22', 'HR_3.0X1500X3000 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:49:59', '2023-03-26 11:19:59', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 10000, NULL, 0, 0, 0, 105.98, '', '3', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(415, 0, 'BSP_RM23', 'HR_3.0X1250X2500 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:51:27', '2023-03-26 11:21:27', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 10000, NULL, 0, 0, 0, 73.59, '', '3', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(416, 0, 'BSP_RM24', 'HR_3.0X1250X3000 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:52:12', '2023-03-26 11:22:12', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 88.31, '', '3', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(417, 0, 'BSP_RM25', 'HR_3.0X1500X2500 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:52:49', '2023-03-26 11:22:49', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 88.31, '', '3', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(418, 0, 'BSP_RM26', 'HR_3.0X1500X3000 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '500', NULL, NULL, 3, '26-03-2023', '04:53:28', '2023-03-26 11:23:28', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 105.98, '', '3', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(419, 0, 'BSP_RM27', 'HR_4.0X1250X2500 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:54:19', '2023-03-26 11:24:19', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 98.13, '', '4', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(420, 0, 'BSP_RM28', 'HR_4.0X1250X3000 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:54:56', '2023-03-26 11:24:56', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 117.75, '', '4', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(421, 0, 'BSP_RM29', 'HR_4.0X1500X2500 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:55:43', '2023-03-26 11:25:43', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 117.75, '', '4', NULL, NULL, 'ST 52', 0, 0, 0, 0, 0),
(422, 0, 'BSP_RM30', 'HR_4.0X1500X3000 MM ST 52 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:56:22', '2023-03-26 11:26:22', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 141.3, '', '4', NULL, NULL, '', 0, 0, 0, 0, 0),
(423, 1100, 'BSP_RM31', 'HR_4.0X1250X2500 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:57:20', '2023-03-28 04:06:10', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 98.13, '', '4', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(424, 0, 'BSP_RM32', 'HR_4.0X1250X3000 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:58:17', '2023-03-26 11:28:17', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 117.75, '', '4', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(425, 0, 'BSP_RM33', 'HR_4.0X1500X2500 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:59:00', '2023-03-26 11:29:00', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 117.75, '', '4', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(426, 0, 'BSP_RM34', 'HR_4.0X1500X3000 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '800', NULL, NULL, 3, '26-03-2023', '04:59:40', '2023-03-26 11:29:40', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 100000, NULL, 0, 0, 0, 141.3, '', '4', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(427, 0, 'BSP_RM35', 'HR_5.0X1250X2500 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '26-03-2023', '05:00:16', '2023-03-26 11:30:16', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 12000, NULL, 0, 0, 0, 122.66, '', '5', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(428, 0, 'BSP_RM36', 'HR_5.0X1250X3000 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '26-03-2023', '05:00:53', '2023-03-26 11:30:53', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 120000, NULL, 0, 0, 0, 147.19, '', '5', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(429, 0, 'BSP_RM37', 'HR_5.0X1500X2500 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '26-03-2023', '05:01:32', '2023-03-26 11:31:32', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 1200000, NULL, 0, 0, 0, 147.19, '', '5', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(430, 0, 'BSP_RM38', 'HR_5.0X1500X3000 MM DD 1079 GRADE', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 0, '1000', NULL, NULL, 3, '26-03-2023', '05:02:06', '2023-03-26 11:32:06', NULL, '7208', '', NULL, '', '', '', '', '', NULL, NULL, 'RM', 120000, NULL, 0, 0, 0, 176.63, '', '5', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(431, 0, '5781509-01', 'BEARING SUPPORT', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '100', NULL, NULL, 3, '28-03-2023', '04:01:35', '2023-03-28 10:31:35', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0),
(432, 0, '5780407-01', 'LINK', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '28-03-2023', '04:03:09', '2023-03-28 10:33:09', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, 'Regular grn', 100000, NULL, 0, 0, 0, 0, '', '4', NULL, NULL, 'DD 1079', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `child_part_master`
--

CREATE TABLE `child_part_master` (
  `id` int(11) NOT NULL,
  `stock` float NOT NULL,
  `onhold_stock` float NOT NULL,
  `production_qty` float NOT NULL,
  `rejection_prodcution_qty` float NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(200) NOT NULL,
  `supplier_id` int(30) DEFAULT NULL,
  `part_rate` float DEFAULT NULL,
  `revision_date` varchar(50) NOT NULL,
  `revision_no` varchar(50) NOT NULL,
  `revision_remark` varchar(20) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `child_part_id` int(255) NOT NULL,
  `safty_buffer_stk` varchar(255) NOT NULL,
  `diagram` varchar(50) DEFAULT NULL,
  `quote` varchar(50) DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `part_drawing` varchar(50) DEFAULT NULL,
  `ppap_document` varchar(20) DEFAULT NULL,
  `modal_document` varchar(20) DEFAULT NULL,
  `cad_file` varchar(20) DEFAULT NULL,
  `a_d` varchar(20) DEFAULT NULL,
  `q_d` varchar(20) DEFAULT NULL,
  `c_d` varchar(20) DEFAULT NULL,
  `quotation_document` varchar(20) DEFAULT NULL,
  `with_in_state` varchar(10) DEFAULT 'no',
  `gst_id` int(11) DEFAULT NULL,
  `admin_approve` varchar(20) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_part_master`
--

INSERT INTO `child_part_master` (`id`, `stock`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `with_in_state`, `gst_id`, `admin_approve`) VALUES
(1, 0, 0, 0, 0, 'D6TH-41073', 'NORTON BUSHING', 4, 2.5, '9/18/2021', '1', 'first', 1, 15, '', NULL, NULL, 3, '9/18/2021', '4:56:25', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(2, 2736, 0, 0, 0, 'D7TM-30545', '40P LATCH STOPPER BRACKET IB', 37, 10.78, '9/24/2021', '1', 'first', 1, 26, '', NULL, NULL, 3, '9/24/2021', '6:30:43', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 1, 'accept'),
(3, 864, 0, 0, 0, 'D7TM-30546', '40P LATCH STOPPER BRACKET OB', 37, 7.03, '9/24/2021', '1', 'first', 1, 27, '', NULL, NULL, 3, '9/24/2021', '6:42:46', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 1, 'accept'),
(4, 0, 0, 0, 0, '234844', 'COVER PLATE', 47, 10, '10/1/2021', '1', 'first', 1, 28, '', NULL, NULL, 3, '10/1/2021', '11:56:57', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Rate_of_Cover_Plate_', '3', 1, 'accept'),
(5, 0, 0, 0, 0, '234844', 'COVER PLATE', 104, 8.5, '10/1/2021', '1', 'first', 1, 28, '', NULL, NULL, 3, '10/1/2021', '11:57:48', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 7, 'accept'),
(6, 0, 0, 0, 0, 'D7TM-30115', 'TRACK LOCATOR PIN', 4, 2.35, '10/10/2021', '1', 'first', 1, 21, '', NULL, NULL, 3, '10/10/2021', '1:54:07', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(7, 1323, 0, 0, 0, 'D7TM-30487', 'SPRING STOPPER PIN', 4, 2.5, '10/10/2021', '1', 'first', 1, 14, '', NULL, NULL, 3, '10/10/2021', '1:54:53', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(8, 1704, 0, 0, 0, 'D7TM-30674', 'TUMBLE STOPPER PIN OB', 4, 2.5, '10/10/2021', '1', 'first', 1, 24, '', NULL, NULL, 3, '10/10/2021', '1:55:38', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(9, 593, 0, 0, 0, 'D7TM-30675', 'TUMBLE STOPPER PIN IB', 4, 2.9, '10/10/2021', '1', 'first', 1, 20, '', NULL, NULL, 3, '10/10/2021', '1:56:48', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(10, 3598, 0, 0, 0, '89712-Q5020', 'SHAFT LATCH', 62, 9.92, '10/10/2021', '1', 'first', 1, 12, '', NULL, NULL, 3, '10/10/2021', '2:10:09', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 3, 'accept'),
(11, 850, 0, 0, 0, 'D7TM-30692', 'BOTTOM PLASTIC COVER ATTACHMENT WIRE', 65, 2.97, '10/10/2021', '1', 'first', 1, 7, '', NULL, NULL, 3, '10/10/2021', '2:11:26', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(12, 3595, 1500, 0, 0, 'D8MS-24404', 'TOP TETHER WIRE', 65, 1.53, '10/10/2021', '1', 'first', 1, 2, '', NULL, NULL, 3, '10/10/2021', '2:21:19', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(13, 3004, 0, 0, 0, 'D7TM-11140', 'FRONT SEAT REAR MOUNTING WASHER', 27, 1, '10/10/2021', '1', 'first', 1, 5, '', NULL, NULL, 3, '10/10/2021', '2:22:11', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(14, 7484, 3000, 0, 0, 'D8MS-24403', 'TOP TETHER MOUNTING BRACKET', 67, 1.43, '10/10/2021', '1', 'first', 1, 1, '', NULL, NULL, 3, '10/10/2021', '2:24:20', '2022-12-23 10:39:07', NULL, NULL, '', '', '', '', '', '', '', '', '1', 3, 'accept'),
(15, 540, 0, 0, 0, 'D7TM-30481', 'TRACK SUPPORTING BRACKET', 67, 6.99, '10/10/2021', '1', 'first', 1, 29, '', NULL, NULL, 3, '10/10/2021', '2:29:22', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(16, 3142, 0, 0, 0, 'D7TM-30481', 'TRACK SUPPORTING BRACKET', 67, 6.99, '10/10/2021', '0', 'New part added', 1, 29, '', NULL, NULL, 3, '10/10/2021', '2:30:35', '2022-12-23 10:46:10', NULL, NULL, '', '', '', '', '', '', '', 'Nitin_Ind._costing_3', '3', 3, 'accept'),
(17, 0, 0, 0, 0, '363228214', 'REINF JACKING POINT RR RH', 37, 6.65, '10/10/2021', '1', 'first', 1, 30, '', NULL, NULL, 3, '10/10/2021', '2:40:17', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(18, 4213, 0, 0, 0, '234844', 'COVER PLATE', 37, 31.67, '10/10/2021', '1', 'first', 1, 28, '', NULL, NULL, 3, '10/10/2021', '2:43:54', '2022-12-23 06:45:16', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 1, 'accept'),
(19, 732, 0, 0, 0, 'SCS004450A15', 'SMALL BRACKET', 37, 0.28, '10/10/2021', '1', 'first', 1, 31, '', NULL, NULL, 3, '10/10/2021', '3:12:25', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(20, 1382, 0, 0, 0, 'D7TM-30234', 'PLASTIC MTG REAR 40P', 96, 1.98, '10/10/2021', '1', 'first', 1, 32, '', NULL, NULL, 3, '10/10/2021', '3:38:34', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind.xlsx', '1', 3, 'accept'),
(21, 5500, 0, 0, 0, 'D7TM-30884', 'TUMBLE STOPPER BKT OB', 96, 2.89, '10/10/2021', '1', 'first', 1, 33, '', NULL, NULL, 3, '10/10/2021', '3:44:28', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind1.xlsx', '1', 3, 'accept'),
(22, 0, 0, 0, 0, 'BSL002020814NCPAD', 'BRACKET FERROUS CABLE MOUNTING', 96, 1.05, '10/10/2021', '1', 'first', 1, 34, '', NULL, NULL, 3, '10/10/2021', '3:45:29', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind2.xlsx', '1', 1, 'accept'),
(23, 2476, 0, 0, 0, 'BSL002049703NCPAC', 'STOPPER PLATE', 96, 2.02, '10/10/2021', '1', 'first', 1, 35, '', NULL, NULL, 3, '10/10/2021', '3:46:14', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind3.xlsx', '1', 1, 'accept'),
(24, 1271, 0, 0, 0, 'BSL002027942NCPAD', 'BRACKET FERROUS CABLE PLASTIC ATTACHMENT RH', 96, 2.11, '10/10/2021', '1', 'first', 1, 36, '', NULL, NULL, 3, '10/10/2021', '3:46:58', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind4.xlsx', '1', 1, 'accept'),
(25, 4370, 0, 0, 0, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', 96, 5.66, '10/10/2021', '1', 'first', 1, 37, '', NULL, NULL, 3, '10/10/2021', '3:47:38', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind5.xlsx', '1', 1, 'accept'),
(26, 5284, 0, 0, 0, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', 96, 5.66, '10/10/2021', '1', 'first', 1, 38, '', NULL, NULL, 3, '10/10/2021', '3:48:09', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Shubh_Ind6.xlsx', '1', 1, 'accept'),
(27, 3072, 0, 0, 0, 'D7TM-30120', 'FRONT MOUNTING BRACKET IB 60P', 127, 13.12, '10/10/2021', '1', 'first', 1, 39, '', NULL, NULL, 3, '10/10/2021', '4:20:59', '2023-01-10 05:46:34', NULL, NULL, '', '', '', '', '', '', '', 'Om_Technokrat_costin', '3', 3, 'accept'),
(28, 0, 0, 0, 0, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', 127, 5.47, '10/10/2021', '1', 'first', 1, 41, '', NULL, NULL, 3, '10/10/2021', '4:21:40', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Om_Technokrat_costin', '3', 1, 'accept'),
(29, 641, 0, 0, 0, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', 127, 5.05, '10/10/2021', '1', 'first', 1, 40, '', NULL, NULL, 3, '10/10/2021', '4:22:21', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Om_Technokrat_costin', '3', 1, 'accept'),
(30, 540, 0, 0, 0, 'D7TM-30374', 'INBOARD TUMBLE BRACKET', 128, 29.46, '10/10/2021', '1', 'first', 1, 42, '', NULL, NULL, 3, '10/10/2021', '4:29:51', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Kiran_Entp._costing.', '1', 1, 'accept'),
(31, 0, 0, 0, 0, 'D7TM-30374', 'INBOARD TUMBLE BRACKET', 128, 29.46, '10/10/2021', '0', 'New part added', 1, 42, '', NULL, NULL, 3, '10/10/2021', '4:31:20', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Kiran_Entp._costing1', '1', 1, 'accept'),
(32, 1750, 0, 0, 0, '1000530567', 'FOAM RUBBER GASKET CS1412', 24, 10.5, '10/10/2021', '1', 'first', 1, 46, '', NULL, NULL, 3, '10/10/2021', '4:37:46', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(33, 5142, 0, 0, 0, 'SCS004450A18', 'CLUTCH CLAMP', 37, 1.19, '10/10/2021', '1', 'first', 1, 47, '', NULL, NULL, 3, '10/10/2021', '5:06:47', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(34, 20499, 0, 0, 0, 'D7TM-30464', 'NUT - SQ WELD M6', 27, 0.5, '10/10/2021', '1', 'first', 1, 8, '', NULL, NULL, 3, '10/10/2021', '6:12:34', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(35, 1230, 0, 0, 0, 'Q348402', 'SS HEX WELD NUT M6', 129, 1.75, '11/26/2021', '1', 'first', 1, 70, '', NULL, NULL, 3, '11/26/2021', '1:50:52', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(36, 3000, 0, 0, 0, 'Q348403', 'SS HEX WELD NUT M8', 129, 3.5, '11/26/2021', '1', 'first', 1, 71, '', NULL, NULL, 3, '11/26/2021', '1:51:30', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(37, 0, 0, 0, 0, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', 130, 0.88, '26-12-2021', '1', 'first', 1, 41, '', NULL, NULL, 3, '26-12-2021', '11:01:44', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 7, 'accept'),
(38, 0, 0, 0, 0, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', 130, 0.79, '26-12-2021', '1', 'first', 1, 40, '', NULL, NULL, 3, '26-12-2021', '11:02:28', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(39, 0, 0, 0, 0, 'D7TM-30120', 'FRONT MOUNTING BRACKET IB 60P', 130, 2.22, '26-12-2021', '1', 'first', 1, 39, '', NULL, NULL, 3, '26-12-2021', '11:04:47', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(40, 0, 0, 0, 0, 'D7TM-30108', 'REAR MOUNTING BRACKET OB 60P', 130, 3.86, '26-12-2021', '1', 'first', 1, 43, '', NULL, NULL, 3, '26-12-2021', '11:16:52', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(42, 57, 0, 0, 0, 'D7TM-30114(30105)', 'Front Mtg Bkt OB 60P', 130, 3.94, '26-12-2021', '1', 'first', 1, 82, '', NULL, NULL, 3, '26-12-2021', '11:43:02', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 7, 'accept'),
(43, 93, 0, 0, 0, 'D7TM-30420', 'Track Supporting cross member Bkt. 40P', 130, 10.9, '26-12-2021', '1', 'first', 1, 73, '', NULL, NULL, 3, '26-12-2021', '11:43:42', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(44, 257, 0, 0, 0, 'D7TM-30649', 'Lower Track J Hook Assly.', 130, 9.67, '26-12-2021', '1', 'first', 1, 72, '', NULL, NULL, 3, '26-12-2021', '11:44:14', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(45, 258, 0, 0, 0, 'D7TM-30371', 'Front Assy. Bkt Assy. with sleeve IB 40P', 130, 6.51, '26-12-2021', '1', 'first', 1, 80, '', NULL, NULL, 3, '26-12-2021', '11:44:45', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(46, 365, 0, 0, 0, 'D7TM-30373', 'Tumble Bkt. with Norglide Bush Assy. IB 40P', 130, 7.74, '26-12-2021', '1', 'first', 1, 78, '', NULL, NULL, 3, '26-12-2021', '11:45:19', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(47, 0, 0, 0, 0, 'D7TM-30381', 'Outboard Tumble Bkt. with Norglide Bush Assy. 40P', 130, 4.41, '26-12-2021', '1', 'first', 1, 79, '', NULL, NULL, 3, '26-12-2021', '11:45:52', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(48, 56, 0, 0, 0, 'D7TM-30383', 'Front Mtg. Bkt. Assy.With Sleeve OB 40P', 130, 9.1, '26-12-2021', '1', 'first', 1, 81, '', NULL, NULL, 3, '26-12-2021', '11:46:29', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(49, 1064, 0, 0, 0, 'D7TM-30693', 'Holder Assy. OB Latch', 130, 3.08, '26-12-2021', '1', 'first', 1, 77, '', NULL, NULL, 3, '26-12-2021', '11:46:59', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(50, 0, 0, 0, 0, 'D7TM-30646', 'Holder Assy. IB Latch', 130, 2.97, '26-12-2021', '1', 'first', 1, 74, '', NULL, NULL, 3, '26-12-2021', '11:47:28', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(51, 370, 0, 0, 0, 'D7TM-30647', 'Base plate Assy. IB Latch', 130, 6.11, '26-12-2021', '1', 'first', 1, 75, '', NULL, NULL, 3, '26-12-2021', '11:47:58', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(52, 0, 0, 0, 0, 'D7TM-30648', 'Base plate Assy. OB Latch', 130, 4.57, '26-12-2021', '1', 'first', 1, 76, '', NULL, NULL, 3, '26-12-2021', '11:48:27', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(53, 782, 0, 0, 0, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', 37, 5.44, '29-12-2021', '1', 'first', 1, 41, '', NULL, NULL, 3, '29-12-2021', '2:38:08', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 1, 'accept'),
(54, 0, 0, 0, 0, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', 37, 5.04, '29-12-2021', '1', 'first', 1, 40, '', NULL, NULL, 3, '29-12-2021', '2:38:52', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 1, 'accept'),
(55, 0, 0, 0, 0, 'BSL002027942NCPAD', 'BRACKET FERROUS CABLE PLASTIC ATTACHMENT RH', 37, 2.18, '29-12-2021', '1', 'first', 1, 36, '', NULL, NULL, 3, '29-12-2021', '2:55:19', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '1', 1, 'accept'),
(56, 2052, 0, 0, 0, 'CBB0004', 'BACK PLATE CLUTCH MTG BKT', 37, 13.01, '29-12-2021', '1', 'first', 1, 84, '', NULL, NULL, 3, '29-12-2021', '2:58:50', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 3, 'accept'),
(57, 5035, 0, 0, 0, 'CBS0004', 'BRACKET STOPPER CLUTCH PEDAL', 37, 7.89, '29-12-2021', '1', 'first', 1, 85, '', NULL, NULL, 3, '29-12-2021', '2:59:27', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Hammer_RR_Working_sh', '3', 1, 'accept'),
(58, 0, 0, 0, 0, '234844', 'COVER PLATE', 131, 8.5, '29-12-2021', '1', 'first', 1, 28, '', NULL, NULL, 3, '29-12-2021', '3:21:22', '2023-01-16 08:13:06', NULL, NULL, '', '', '', '', '', '', '', '', '4', 7, 'accept'),
(59, 0, 0, 0, 0, '234844', 'COVER PLATE', 132, 7, '31-12-2021', '1', 'first', 1, 28, '', NULL, NULL, 3, '31-12-2021', '1:06:32', '2023-01-16 08:13:48', NULL, NULL, '', '', '', '', '', '', '', '', '3', 7, 'accept'),
(60, 11000, 0, 0, 0, 'BSL002213407NCP', 'M10 X 1.5 WELD NUT', 133, 1.15, '31-12-2021', '1', 'first', 1, 86, '', NULL, NULL, 3, '31-12-2021', '4:50:16', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(61, 45233, 0, 0, 0, 'B1', '3.2 X 1250 X 2500 HRPO QSTE 5OOTM', 69, 72, '31-12-2021', '1', 'first', 2, 88, '', NULL, NULL, 3, '31-12-2021', '5:49:33', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Costing_Sheet_VW_and', '1', 9, 'accept'),
(62, 2257, 0, 0, 0, 'B2', '2 X 1250 X 2500 HRPO QSTE 500TM', 69, 72, '31-12-2021', '1', 'first', 2, 91, '', NULL, NULL, 3, '31-12-2021', '5:50:26', '2022-12-13 08:54:11', NULL, NULL, '', '', '', '', '', '', '', 'Costing_Sheet_VW_and', '1', 9, 'accept'),
(63, 982, 0, 0, 0, 'B3', '2 X 1250 X 2500 HRPO QSTE 340LA', 69, 72, '31-12-2021', '1', 'first', 2, 92, '', NULL, NULL, 3, '31-12-2021', '5:51:00', '2022-12-13 08:54:29', NULL, NULL, '', '', '', '', '', '', '', 'Costing_Sheet_VW_and', '1', 9, 'accept'),
(64, 23129, 0, 0, 0, 'B4', '3 X 1250 X 2500 HRPO S550MC', 69, 72, '31-12-2021', '1', 'first', 2, 90, '', NULL, NULL, 3, '31-12-2021', '5:51:34', '2022-12-13 08:54:50', NULL, NULL, '', '', '', '', '', '', '', 'Costing_Sheet_VW_and', '1', 9, 'accept'),
(65, 2760, 0, 0, 0, 'B5', '1.5 X 1250X 2500 CR HC 340LA', 69, 77, '31-12-2021', '1', 'first', 2, 89, '', NULL, NULL, 3, '31-12-2021', '5:52:28', '2022-12-13 08:55:02', NULL, NULL, '', '', '', '', '', '', '', 'Costing_Sheet_VW_and', '1', 9, 'accept'),
(66, 3560, 2565, 0, 0, 'RM00STK35', 'SPFC400-690X630X0.5 MM', 27, 67.2, '1/1/2022', '1', 'first', 2, 94, '', NULL, NULL, 3, '1/1/2022', '1:48:21', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 8, 'accept'),
(67, 0, 0, 0, 0, 'RM00STK34', 'SPFC400-890X690X0.5 MM', 27, 67.2, '1/1/2022', '1', 'first', 2, 95, '', NULL, NULL, 3, '1/1/2022', '1:48:48', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 8, 'accept'),
(68, 12952, 0, 0, 0, 'DASRM_43', 'E34 3X1250X2500', 27, 47.01, '1/1/2022', '1', 'first', 2, 96, '', NULL, NULL, 3, '1/1/2022', '1:50:35', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 8, 'accept'),
(69, 0, 0, 0, 0, 'DASRM_46', 'E34 2.5X1250X2500 MM', 27, 47.01, '1/1/2022', '1', 'first', 2, 97, '', NULL, NULL, 3, '1/1/2022', '1:51:19', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 8, 'accept'),
(70, 552, 0, 0, 0, 'DASRM.', 'SHEET SPFH590 2.5X1250X2500 MM', 27, 48.45, '1/1/2022', '1', 'first', 2, 98, '', NULL, NULL, 3, '1/1/2022', '1:51:52', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(71, 0, 0, 0, 0, 'DASRM_49', 'SHEET E34  2.0X1250X2500 MM', 27, 47.01, '1/1/2022', '1', 'first', 2, 99, '', NULL, NULL, 3, '1/1/2022', '1:52:18', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(72, 0, 0, 0, 0, 'ST000017', 'HRPO HSLA355 SIZE-2.5X1250X2500 MM', 134, 67.584, '1/1/2022', '1', 'first', 2, 100, '', NULL, NULL, 3, '1/1/2022', '2:03:37', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(73, 0, 0, 0, 0, 'ST000031', 'HRPO HSLA460 SIZE-6.0X1250X2500 MM', 134, 69.084, '1/1/2022', '1', 'first', 2, 101, '', NULL, NULL, 3, '1/1/2022', '2:04:10', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(74, 8978, 0, 0, 0, 'ST000040', 'HRPO HR FE410 SIZE-6.0X1250X2500 MM', 134, 66.454, '1/1/2022', '1', 'first', 2, 102, '', NULL, NULL, 3, '1/1/2022', '2:04:40', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(75, 1260, 0, 0, 0, 'SCS02430-12.1', 'DOWEL PIN DIA 8.5', 103, 1.85, '1/1/2022', '1', 'first', 1, 103, '', NULL, NULL, 3, '1/1/2022', '2:38:15', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(76, 630, 0, 0, 0, 'SCS02430-12.2', 'METAL INSERT M12X1.75', 103, 14.5, '1/1/2022', '1', 'first', 1, 104, '', NULL, NULL, 3, '1/1/2022', '2:39:02', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(77, 0, 0, 0, 0, 'SH4000700360920', 'IFHS400-0.7X360X920 MM', 135, 62.14, '4/1/2022', '1', 'first', 2, 93, '', NULL, NULL, 3, '4/1/2022', '7:33:26', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(78, 0, 0, 0, 0, 'DASRM_26', 'HR SHEET 550 LA-2.5x1250X2500 MM', 27, 71, '5/1/2022', '1', 'first', 2, 106, '', NULL, NULL, 3, '5/1/2022', '3:50:43', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(79, 2390, 0, 0, 0, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', 130, 2.75, '9/1/2022', '1', 'first', 1, 37, '', NULL, NULL, 3, '9/1/2022', '10:57:19', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 7, 'accept'),
(80, 2430, 0, 0, 0, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', 130, 2.75, '9/1/2022', '1', 'first', 1, 38, '', NULL, NULL, 3, '9/1/2022', '10:57:44', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 7, 'accept'),
(81, 214, 0, 0, 0, 'BSL002055836NCPAA', 'FRM ARMRESET MTG BKT', 130, 5.75, '9/1/2022', '1', 'first', 1, 107, '', NULL, NULL, 3, '9/1/2022', '11:01:47', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 7, 'accept'),
(82, 1557, 0, 0, 0, 'D7TM-30119', 'REAR MOUNTING BRACKET IB 60P', 136, 39.46, '2/2/2022', '1', 'first', 1, 4, '', NULL, NULL, 3, '2/2/2022', '4:21:31', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 1, 'accept'),
(83, 0, 0, 0, 0, 'D7TM-30114(30105)', 'Front Mtg Bkt OB 60P', 136, 22.27, '2/2/2022', '1', 'first', 1, 82, '', NULL, NULL, 3, '2/2/2022', '4:36:50', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(84, 315, 0, 0, 0, 'SCS02430-12', 'TOP PLATE LH', 136, 39.09, '2/2/2022', '1', 'first', 1, 67, '', NULL, NULL, 3, '2/2/2022', '4:44:46', '2022-12-21 11:27:15', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(85, 315, 0, 0, 0, 'SCS02429-12', 'TOP PLATE RH', 136, 39.09, '2/2/2022', '1', 'first', 1, 68, '', NULL, NULL, 3, '2/2/2022', '4:45:42', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(86, 1779, 0, 0, 0, 'CM000453', 'Bottom Plate LH', 136, 60.54, '2/2/2022', '1', 'first', 1, 108, '', NULL, NULL, 3, '2/2/2022', '4:47:50', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(87, 595, 0, 0, 0, 'CM000451', 'Bottom Plate RH', 136, 60.54, '2/2/2022', '1', 'first', 1, 109, '', NULL, NULL, 3, '2/2/2022', '4:48:19', '2023-01-16 05:58:13', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(88, 0, 0, 0, 0, '235766', 'ANGLE-L BRACKET ', 131, 1, '8/2/2022', '1', 'first', 1, 110, '', NULL, NULL, 3, '8/2/2022', '3:21:43', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(89, -1500, 1500, 0, 0, 'D8MS-24404', 'TOP TETHER WIRE', 137, 2, '16-02-2022', '1', 'first', 1, 2, '', NULL, NULL, 3, '16-02-2022', '5:15:42', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 7, 'accept'),
(90, 0, 0, 0, 0, 'A062R391', 'Spacer', 72, 13, '7/3/2022', '1', 'first', 1, 111, '', NULL, NULL, 3, '7/3/2022', '12:41:48', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(91, 1568, 0, 0, 0, 'D7TM-89821', 'PLATE BASE RH', 136, 20.95, '22-03-2022', '1', 'first', 1, 10, '', NULL, NULL, 3, '22-03-2022', '3:09:53', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(92, 0, 0, 0, 0, 'D7TM-30108', 'REAR MOUNTING BRACKET OB 60P', 136, 17.98, '22-03-2022', '1', 'first', 1, 43, '', NULL, NULL, 3, '22-03-2022', '3:12:41', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 1, 'accept'),
(93, 502, 0, 0, 0, 'D7TM-30386', 'FRONT MOUNTING BRACKET OB 40P', 136, 2.59, '22-03-2022', '1', 'first', 1, 22, '', NULL, NULL, 3, '22-03-2022', '3:13:20', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 1, 'accept'),
(94, 0, 0, 0, 0, '234844', 'COVER PLATE', 138, 8.5, '23-03-2022', '1', 'first', 1, 28, '', NULL, NULL, 3, '23-03-2022', '9:38:28', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '3', 1, 'accept'),
(95, 0, 0, 0, 0, 'D7TM-30374', 'INBOARD TUMBLE BRACKET', 136, 27.36, '19-04-2022', '1', 'first', 1, 42, '', NULL, NULL, 3, '19-04-2022', '7:01:48', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'Yogita_Stamping_25.1', '1', 3, 'accept'),
(96, 0, 0, 0, 0, 'D7TM-89831', 'HOLDER IB LATCH', 46, 16.76, '19-04-2022', '1', 'first', 1, 44, '', NULL, NULL, 3, '19-04-2022', '7:42:56', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'KB_costing_.xlsx', '1', 1, 'accept'),
(97, 0, 0, 0, 0, 'D7TM-89721', 'PLATE BASE LH', 46, 18.68, '19-04-2022', '1', 'first', 1, 45, '', NULL, NULL, 3, '19-04-2022', '7:43:44', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'KB_costing_1.xlsx', '1', 1, 'accept'),
(98, 0, 0, 0, 0, 'D7TM-89731', 'Q5020 HOLDER, LH', 46, 16.36, '19-04-2022', '1', 'first', 1, 11, '', NULL, NULL, 3, '19-04-2022', '7:44:28', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', 'KB_costing_2.xlsx', '1', 1, 'accept'),
(99, 0, 0, 0, 0, 'D7TM-30115', 'TRACK LOCATOR PIN', 4, 2.75, '4/20/2022', '1', 'rate Revised', 1, 21, '', NULL, NULL, 3, '20-04-2022', '6:44:09', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(100, 0, 0, 0, 0, '235766', 'ANGLE-L BRACKET ', 132, 1, '20-04-2022', '1', 'first', 1, 110, '', NULL, NULL, 3, '20-04-2022', '7:27:10', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(101, 0, 0, 0, 0, 'BSL002213407NCP', 'M10 X 1.5 WELD NUT', 133, 1.35, '5/3/2022', '1', 'Part Price increase', 1, 86, '', NULL, NULL, 3, '3/5/2022', '9:57:30', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(102, 0, 0, 0, 0, 'BSL002213407NCP', 'M10 X 1.5 WELD NUT', 129, 1.4, '5/5/2022', '1', 'first', 1, 87, '', NULL, NULL, 3, '5/5/2022', '1:57:50', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(103, 300, 0, 0, 0, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', 102, 0.85, '15-05-2022', '1', 'first', 1, 41, '', NULL, NULL, 3, '15-05-2022', '6:14:20', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(104, 300, 0, 0, 0, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', 102, 0.76, '15-05-2022', '1', 'first', 1, 40, '', NULL, NULL, 3, '15-05-2022', '6:18:34', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(105, 0, 0, 0, 0, 'D7TM-30120(30122)', 'Front Mtg Bkt IB 60P', 102, 2.14, '16-05-2022', '1', 'first', 1, 83, '', NULL, NULL, 3, '16-05-2022', '10:43:36', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(106, 0, 0, 0, 0, 'D7TM-30114(30105)', 'Front Mtg Bkt OB 60P', 102, 3.8, '16-05-2022', '1', 'first', 1, 82, '', NULL, NULL, 3, '16-05-2022', '10:50:14', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 7, 'accept'),
(107, 200, 0, 0, 0, 'D7TM-30108', 'REAR MOUNTING BRACKET OB 60P', 102, 3.72, '16-05-2022', '1', 'first', 1, 43, '', NULL, NULL, 3, '16-05-2022', '10:51:24', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(108, 0, 0, 0, 0, 'D7TM-30420', 'Track Supporting cross member Bkt. 40P', 102, 10.51, '16-05-2022', '1', 'first', 1, 73, '', NULL, NULL, 3, '16-05-2022', '10:52:39', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(109, 0, 0, 0, 0, 'D7TM-30649', 'Lower Track J Hook Assly.', 102, 9.32, '16-05-2022', '1', 'first', 1, 72, '', NULL, NULL, 3, '16-05-2022', '10:53:27', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(110, 0, 0, 0, 0, 'D7TM-30371', 'Front Assy. Bkt Assy. with sleeve IB 40P', 102, 6.28, '16-05-2022', '1', 'first', 1, 80, '', NULL, NULL, 3, '16-05-2022', '10:54:16', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(111, 0, 0, 0, 0, 'D7TM-30373', 'Tumble Bkt. with Norglide Bush Assy. IB 40P', 102, 4.57, '16-05-2022', '1', 'first', 1, 78, '', NULL, NULL, 3, '16-05-2022', '10:55:58', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(112, 0, 0, 0, 0, 'D7TM-30381', 'Outboard Tumble Bkt. with Norglide Bush Assy. 40P', 102, 4.25, '16-05-2022', '1', 'first', 1, 79, '', NULL, NULL, 3, '16-05-2022', '10:57:01', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(113, 100, 0, 0, 0, 'D7TM-30383', 'Front Mtg. Bkt. Assy.With Sleeve OB 40P', 102, 8.77, '16-05-2022', '1', 'first', 1, 81, '', NULL, NULL, 3, '16-05-2022', '10:58:07', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(114, 200, 0, 0, 0, 'D7TM-30693', 'Holder Assy. OB Latch', 102, 2.97, '16-05-2022', '1', 'first', 1, 77, '', NULL, NULL, 3, '16-05-2022', '10:59:38', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(115, 0, 0, 0, 0, 'D7TM-30646', 'Holder Assy. IB Latch', 102, 2.86, '16-05-2022', '1', 'first', 1, 74, '', NULL, NULL, 3, '16-05-2022', '11:00:26', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(116, 317, 0, 0, 0, 'D7TM-30647', 'Base plate Assy. IB Latch', 102, 5.89, '16-05-2022', '1', 'first', 1, 75, '', NULL, NULL, 3, '16-05-2022', '11:01:23', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(117, 0, 0, 0, 0, 'D7TM-30648', 'Base plate Assy. OB Latch', 102, 4.4, '16-05-2022', '1', 'first', 1, 76, '', NULL, NULL, 3, '16-05-2022', '11:02:13', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(118, 0, 0, 0, 0, 'BSL002055836NCPAA', 'FRM ARMRESET MTG BKT', 102, 4.7, '17-05-2022', '1', 'first', 1, 107, '', NULL, NULL, 3, '17-05-2022', '12:48:03', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 7, 'accept'),
(119, 0, 0, 0, 0, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', 102, 2.25, '17-05-2022', '1', 'first', 1, 37, '', NULL, NULL, 3, '17-05-2022', '12:48:37', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(120, 0, 0, 0, 0, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', 102, 2.25, '17-05-2022', '1', 'first', 1, 38, '', NULL, NULL, 3, '17-05-2022', '12:49:12', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '4', 1, 'accept'),
(121, 0, 0, 0, 0, '1000699234', 'SHIFTER MOUNTING PLATE', 132, 6.156, '30-05-2022', '1', 'first', 1, 112, '', NULL, NULL, 3, '30-05-2022', '1:58:06', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(122, 0, 0, 0, 0, 'PTML253422107125-V', 'LIFTING HOOK FRONT', 132, 13.09, '30-05-2022', '1', 'first', 1, 113, '', NULL, NULL, 3, '30-05-2022', '2:04:33', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(123, 2244, 0, 0, 0, 'D7TM-89831', 'HOLDER IB LATCH', 46, 17.32, '6/1/2022', '0', 'New part added', 1, 44, '', NULL, NULL, 3, '1/6/2022', '12:31:09', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(124, 450, 0, 0, 0, 'D7TM-89721', 'PLATE BASE LH', 46, 18.9, '6/1/2022', '0', 'New part added', 1, 45, '', NULL, NULL, 3, '1/6/2022', '12:31:35', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(125, 0, 0, 0, 0, 'D7TM-89731', 'Q5020 HOLDER, LH', 46, 16.59, '6/1/2022', '0', 'New part added', 1, 11, '', NULL, NULL, 3, '1/6/2022', '12:32:07', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(126, 0, 0, 0, 0, '1000530567', 'FOAM RUBBER GASKET CS1412', 139, 12, '3/6/2022', '1', 'first', 1, 46, '', NULL, NULL, 3, '3/6/2022', '10:58:39', '0000-00-00 00:00:00', NULL, NULL, '', '', '', '', '', '', '', '', '1', 1, 'accept'),
(127, 0, 0, 0, 0, 'SCS02430-12.2', 'METAL INSERT M12X1.75', 134, 14.5, '13-06-2022', '1', 'first', 1, 104, '', NULL, NULL, 3, '13-06-2022', '3:30:27', '2023-03-27 05:07:28', NULL, NULL, '', '', '', '', '', '', '', '', '3', 3, 'accept'),
(128, 0, 0, 0, 0, 'SCS02430-12.1', 'DOWEL PIN DIA 8.5', 134, 1.85, '13-06-2022', '1', 'first', 1, 103, '', NULL, NULL, 3, '13-06-2022', '3:33:21', '2023-03-27 05:07:04', NULL, NULL, '', '', '', '', '', '', '', '', '3', 3, 'accept'),
(129, 0, 0, 0, 0, 'B4.2000480', 'bracket', 1, 13, '22-07-2022', '1', 'new part', 1, 114, '', NULL, NULL, 3, '22-07-2022', '7:47:29', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(130, 0, 0, 0, 0, 'B4.2000480', 'bracket', 1, 14, '7/22/2022', '2', 'test rev', 1, 114, '', NULL, NULL, 3, '22-07-2022', '7:54:08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(131, 0, 0, 0, 0, 'BSP000001', 'Packaging Materials for Bearing Support Assy -Part No. - 5781509-01 ', 82, 3415, '23-07-2022', '1', 'new part', 5, 116, '', NULL, NULL, 3, '23-07-2022', '3:36:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(132, 0, 0, 0, 0, '1000530567', 'FOAM RUBBER GASKET CS1412', 24, 12.5, '8/8/2022', '1', 'Part Price increase', 1, 46, '', NULL, NULL, 3, '8/8/2022', '10:51:14', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(133, 0, 0, 0, 0, 'SBT00800B42', 'LUG-U301', 96, 9.1, '8/8/2022', '1', 'New part added', 1, 117, '', NULL, NULL, 3, '8/8/2022', '4:19:23', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shubh_Ind_costing.xl', NULL, 3, 'accept'),
(134, 0, 0, 0, 0, 'BSL002020815', 'BRACKET FERROUS,RECLINER 3RS UPPER RH', 136, 38.92, '8/8/2022', '1', 'New part added', 1, 118, '', NULL, NULL, 3, '8/8/2022', '4:49:44', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yogita_Stamping_25.1', NULL, 1, 'accept'),
(135, 0, 0, 0, 0, 'D8MS-24404', 'TOP TETHER WIRE', 65, 1.91, '8/12/2022', '1', 'Part Price increase', 1, 2, '', NULL, NULL, 3, '12/8/2022', '10:19:26', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSP-S201_31-03-22_da', NULL, 3, 'accept'),
(136, 0, 0, 0, 0, 'D7TM-30692', 'BOTTOM PLASTIC COVER ATTACHMENT WIRE', 65, 4.67, '8/12/2022', '1', 'Part Price increase', 1, 7, '', NULL, NULL, 3, '12/8/2022', '10:20:43', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSP-S201_31-03-22_da', NULL, 3, 'accept'),
(137, 0, 0, 0, 0, 'DASRM_ /CR SHEET 0.6X1050X1800 MM', 'DASRM_ /CR SHEET 0.6X1050X1800 MM', 27, 67.2, '21-08-2022', '1', '1', 2, 119, '', NULL, NULL, 3, '21-08-2022', '1:39:12', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no 2', NULL, 8, 'accept'),
(138, 0, 0, 0, 0, 'DASRM_ /CR SHEET SPFC440- 0.6X1050X1890 MM', 'DASRM_ /CR SHEET SPFC440- 0.6X1050X1890 MM', 27, 67.2, '21-08-2022', '1', '1', 2, 120, '', NULL, NULL, 3, '21-08-2022', '1:40:41', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no 2', NULL, 8, 'accept'),
(139, 0, 0, 0, 0, 'DASRM_ /HR SHEET-2.5X208X1250 MM', 'DASRM_ /HR SHEET-2.5X208X1250 MM', 27, 71, '21-08-2022', '1', '1', 2, 121, '', NULL, NULL, 3, '21-08-2022', '1:41:45', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no 2', NULL, 8, 'accept'),
(140, 0, 0, 0, 0, 'SH4000700360920', 'IFHS400-0.7X360X920 MM', 135, 81.9, '8/23/2022', '2', 'RM PRISE INCREASE', 2, 93, '', NULL, NULL, 3, '23-08-2022', '2:13:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(141, 0, 0, 0, 0, 'DASRM_62', 'E-34 2X1500X2500 MM', 27, 47.01, '24-08-2022', '1', 'JW', 2, 123, '', NULL, NULL, 3, '24-08-2022', '1:59:54', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no 2', NULL, 8, 'accept'),
(142, 0, 0, 0, 0, '89712-Q5020', 'SHAFT LATCH', 62, 9.92, '8/28/2022', '1', '1', 1, 12, '', NULL, NULL, 3, '28-08-2022', '11:09:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(143, 0, 0, 0, 0, 'CBB0004', 'BACK PLATE CLUTCH MTG BKT', 37, 12.61, '8/28/2022', '1', 'PART PRICE REVISED A', 1, 84, '', NULL, NULL, 3, '28-08-2022', '1:20:37', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hammer_RR_Working_sh', NULL, 1, 'accept'),
(144, 0, 0, 0, 0, 'D7TM-30464', 'NUT - SQ WELD M6', 27, 0.5, '8/28/2022', '1', '1', 1, 8, '', NULL, NULL, 3, '28-08-2022', '5:06:05', '2022-12-13 09:24:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(145, 0, 0, 0, 0, 'D7TM-11140', 'FRONT SEAT REAR MOUNTING WASHER', 27, 1, '8/28/2022', '1', '1', 1, 5, '', NULL, NULL, 3, '28-08-2022', '5:07:33', '2022-12-13 09:25:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(146, 0, 0, 0, 0, 'DASRM.', 'SHEET SPFH590 2.5X1250X2500 MM', 27, 48.45, '8/28/2022', '1', '1', 2, 98, '', NULL, NULL, 3, '28-08-2022', '5:10:06', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(147, 0, 0, 0, 0, 'DASRM_49', 'SHEET E34  2.0X1250X2500 MM', 27, 47.01, '8/28/2022', '1', '1', 2, 99, '', NULL, NULL, 3, '28-08-2022', '5:12:36', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(148, 0, 0, 0, 0, 'DASRM_26', 'HR SHEET 550 LA-2.5x1250X2500 MM', 27, 71, '8/28/2022', '1', '1', 2, 106, '', NULL, NULL, 3, '28-08-2022', '5:13:36', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(149, 0, 0, 0, 0, 'DASRM_62', 'E-34 2X1500X2500 MM', 27, 47.01, '8/28/2022', '1', '1', 2, 123, '', NULL, NULL, 3, '28-08-2022', '5:14:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(150, 0, 0, 0, 0, 'SCS02430-12.2', 'METAL INSERT M12X1.75', 141, 14.5, '18-09-2022', '1', 'Initial', 1, 104, '', NULL, NULL, 3, '18-09-2022', '11:11:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no 2', NULL, 3, 'accept'),
(151, 0, 0, 0, 0, 'SCS02430-12.1', 'DOWEL PIN DIA 8.5', 141, 1.85, '18-09-2022', '1', 'Initial', 1, 103, '', NULL, NULL, 3, '18-09-2022', '11:12:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no 2', NULL, 3, 'accept'),
(152, 0, 0, 0, 0, 'BSL002213407NCP', 'M10 X 1.5 WELD NUT', 129, 1.5, '9/19/2022', '1', 'Part Price increase', 1, 87, '', NULL, NULL, 3, '19-09-2022', '11:20:55', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(153, 0, 0, 0, 0, 'BSL002055836NCPAA', 'FRM ARMRESET MTG BKT', 142, 4.7, '2/10/2022', '1', 'Initial', 1, 107, '', NULL, NULL, 3, '2/10/2022', '12:31:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(154, 0, 0, 0, 0, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', 142, 2.25, '2/10/2022', '1', 'Initial', 1, 37, '', NULL, NULL, 3, '2/10/2022', '12:31:55', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(155, 0, 0, 0, 0, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', 142, 2.25, '2/10/2022', '1', 'Initial', 1, 38, '', NULL, NULL, 3, '2/10/2022', '12:32:36', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(156, 0, 0, 0, 0, 'D9MS-20879', 'Lumbar Attachment Bracket', 37, 1.2, '5/11/2022', '1', 'Initial', 1, 127, '', NULL, NULL, 3, '5/11/2022', '4:07:58', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hammer_RR_Working_sh', NULL, 1, 'accept'),
(157, 0, 0, 0, 0, 'DASRM_33', 'E34_1.6X55X458 MM', 27, 64.01, '5/11/2022', '1', 'Initial', 2, 132, '', NULL, NULL, 3, '5/11/2022', '5:27:04', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(158, 0, 0, 0, 0, 'DASRM_63', 'E34_1.6X1250X2500 MM', 27, 64.01, '5/11/2022', '1', 'Initial', 2, 133, '', NULL, NULL, 3, '5/11/2022', '5:28:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(159, 0, 0, 0, 0, 'DASRM_59', 'CR SHEET JSC270C_1.2X548X1250 MM', 27, 70.9, '5/11/2022', '1', 'Initial', 2, 134, '', NULL, NULL, 3, '5/11/2022', '5:38:52', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(160, 0, 0, 0, 0, 'DASRM_36', 'CR SHEET_DP590_1.6X1305X2500', 27, 97, '5/11/2022', '1', 'Initial', 2, 128, '', NULL, NULL, 3, '5/11/2022', '5:39:39', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(161, 0, 0, 0, 0, 'DASRM_70', 'SPRC440_0.6X1250X2500 MM', 27, 95, '5/11/2022', '1', 'Initial', 2, 129, '', NULL, NULL, 3, '5/11/2022', '5:40:19', '2023-01-20 10:39:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(162, 0, 0, 0, 0, 'DASRM_71', 'CR SHEET_SPFC590_1.6X1250X2500', 27, 97, '5/11/2022', '1', 'New part added', 2, 130, '', NULL, NULL, 3, '5/11/2022', '5:40:59', '2023-03-04 07:03:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(163, 0, 0, 0, 0, 'DASRM_60', 'CR SHEET DP590_1.2X548X1250', 27, 70.9, '5/11/2022', '1', 'New part added', 2, 131, '', NULL, NULL, 3, '5/11/2022', '5:41:42', '2022-12-20 12:03:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(164, 0, 0, 0, 0, 'A062R391', 'Spacer', 143, 10.5, '7/11/2022', '1', 'Initial', 1, 111, '', NULL, NULL, 3, '7/11/2022', '4:19:12', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(165, 0, 0, 0, 0, 'D7TM30649OP30', 'CED Coating', 102, 9.32, '14-11-2022', '1', 'new part defined', 7, 136, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(166, 0, 0, 0, 0, 'D7TM30420OP30', 'CED Coating', 102, 10.51, '14-11-2022', '1', 'new part defined', 7, 137, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(167, 0, 0, 0, 0, 'D7TM30646OP20', 'CED Coating', 102, 2.86, '14-11-2022', '1', 'new part defined', 7, 138, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(168, 0, 0, 0, 0, 'D7TM30647OP20', 'CED Coating', 102, 5.89, '14-11-2022', '1', 'new part defined', 7, 139, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(169, 0, 0, 0, 0, 'D7TM30648OP20', 'CED Coating', 102, 4.4, '14-11-2022', '1', 'new part defined', 7, 140, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(170, 0, 0, 0, 0, 'D7TM30693OP20', 'CED Coating', 102, 2.97, '14-11-2022', '1', 'new part defined', 7, 141, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(171, 0, 0, 0, 0, 'D7TM30373OP20', 'CED Coating', 102, 4.57, '14-11-2022', '1', 'new part defined', 7, 142, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(172, 0, 0, 0, 0, 'D7TM30381OP20', 'CED Coating', 102, 4.25, '14-11-2022', '1', 'new part defined', 7, 143, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(173, 0, 0, 0, 0, 'D7TM30371OP30', 'CED Coating', 102, 6.28, '14-11-2022', '1', 'new part defined', 7, 144, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(174, 0, 0, 0, 0, 'D7TM30383OP30', 'CED Coating', 102, 8.77, '14-11-2022', '1', 'new part defined', 7, 145, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(175, 0, 0, 0, 0, 'D7TM30542OP20', 'CED Coating', 102, 0.85, '14-11-2022', '1', 'new part defined', 7, 231, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-07 11:34:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(176, 0, 0, 0, 0, 'D7TM30109OP20', 'CED Coating', 102, 0.76, '14-11-2022', '1', 'new part defined', 7, 147, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(177, 0, 0, 0, 0, 'D7TM30108OP70', 'CED Coating', 102, 3.72, '14-11-2022', '1', 'new part defined', 7, 148, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(178, 0, 0, 0, 0, 'D7TM30105OP20', 'CED Coating', 102, 3.8, '14-11-2022', '1', 'new part defined', 7, 149, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(179, 0, 0, 0, 0, 'D7TM30122OP20', 'CED Coating', 102, 2.14, '14-11-2022', '1', 'new part defined', 7, 150, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(180, 0, 0, 0, 0, 'D7TM30649OP30', 'CED Coating', 130, 9.67, '14-11-2022', '1', 'new part defined', 7, 136, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:06:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(181, 0, 0, 0, 0, 'D7TM30420OP30', 'CED Coating', 130, 10.9, '14-11-2022', '1', 'new part defined', 7, 137, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:04:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(182, 0, 0, 0, 0, 'D7TM30646OP20', 'CED Coating', 130, 2.97, '14-11-2022', '1', 'new part defined', 7, 138, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:05:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(183, 0, 0, 0, 0, 'D7TM30647OP20', 'CED Coating', 130, 6.11, '14-11-2022', '1', 'new part defined', 7, 139, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:05:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(184, 0, 0, 0, 0, 'D7TM30648OP20', 'CED Coating', 130, 4.57, '14-11-2022', '1', 'new part defined', 7, 140, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:05:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(185, 0, 0, 0, 0, 'D7TM30693OP20', 'CED Coating', 130, 3.08, '14-11-2022', '1', 'new part defined', 7, 141, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:06:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(186, 0, 0, 0, 0, 'D7TM30373OP20', 'CED Coating', 130, 7.74, '14-11-2022', '1', 'new part defined', 7, 142, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:03:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(187, 0, 0, 0, 0, 'D7TM30381OP20', 'CED Coating', 130, 4.41, '14-11-2022', '1', 'new part defined', 7, 143, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:04:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(188, 0, 0, 0, 0, 'D7TM30371OP30', 'CED Coating', 130, 6.51, '14-11-2022', '1', 'new part defined', 7, 144, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:03:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(189, 0, 0, 0, 0, 'D7TM30383OP30', 'CED Coating', 130, 9.1, '14-11-2022', '1', 'new part defined', 7, 145, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:04:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(190, 0, 0, 0, 0, 'D7TM30542OP20', 'CED Coating', 130, 0.88, '14-11-2022', '1', 'new part defined', 7, 231, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:05:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(191, 0, 0, 0, 0, 'D7TM30109OP20', 'CED Coating', 130, 0.79, '14-11-2022', '1', 'new part defined', 7, 147, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:02:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(192, 0, 0, 0, 0, 'D7TM30108OP70', 'CED Coating', 130, 3.86, '14-11-2022', '1', 'new part defined', 7, 148, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:01:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(193, 0, 0, 0, 0, 'D7TM30105OP20', 'CED Coating', 130, 3.94, '14-11-2022', '1', 'new part defined', 7, 149, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:00:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(194, 0, 0, 0, 0, 'D7TM30122OP20', 'CED Coating', 130, 2.22, '14-11-2022', '1', 'new part defined', 7, 150, '', NULL, NULL, 3, '14-11-2022', '3:37:53', '2022-12-11 11:02:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(195, 0, 0, 0, 0, 'D7TM30649OP20', 'CO2 ASSEMBLY (30117 AND 30119)', 102, 8.1, '19-11-2022', '1', 'new part defined', 1, 171, '', NULL, NULL, 3, '19-11-2022', '05:48:46', '2022-11-19 12:18:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(196, 0, 0, 0, 0, '24404AC-CED coated', 'CED coated TOP TETHER WIRE', 102, 2, '22-11-2022', '1', 'new part defined', 1, 172, '', NULL, NULL, 3, '22-11-2022', '03:53:35', '2022-11-22 10:23:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(197, 0, 0, 0, 0, 'BSP_RM01', 'CR SHEET_1.0X1250X2180 MM D513 GRADE', 99, 68.5, '03-12-2022', '1', 'Initial', 2, 209, '', NULL, NULL, 3, '03-12-2022', '04:58:25', '2022-12-03 11:29:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(198, 0, 0, 0, 0, 'BSL002230976OP20', 'IR LONG VALANCE BKT LH SK216-BSL002230976-CED', 142, 2.25, '04-12-2022', '1', 'Initial', 1, 225, '', NULL, NULL, 3, '04-12-2022', '07:48:16', '2022-12-05 06:56:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(199, 0, 0, 0, 0, 'BSL002231007OP20', 'LONG VALANCE BKT RH SK216-BSL002231007NCPAA-CED', 142, 2.25, '04-12-2022', '1', 'Initial', 1, 226, '', NULL, NULL, 3, '04-12-2022', '07:48:47', '2022-12-05 06:56:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(200, 0, 0, 0, 0, 'BSL002055836OP80', 'FRM ARMRESET MTG BKT-BSL002055836NCPAA-CED', 142, 4.7, '04-12-2022', '1', 'Initial', 1, 223, '', NULL, NULL, 3, '04-12-2022', '07:49:33', '2022-12-05 06:56:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(201, 0, 0, 0, 0, 'D7TM30649OP30', 'D7TM-30649-Lower Track J Hook Assly.-CED', 142, 9.32, '04-12-2022', '1', 'Initial', 1, 136, '', NULL, NULL, 3, '04-12-2022', '08:00:18', '2022-12-05 06:57:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Q_502_POWDER_COATING', NULL, 1, 'accept');
INSERT INTO `child_part_master` (`id`, `stock`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `with_in_state`, `gst_id`, `admin_approve`) VALUES
(202, 0, 0, 0, 0, 'D7TM30420OP30', 'D7TM-30420-Track Supporting Bkt. 40P -CED', 142, 10.51, '05-12-2022', '1', 'Initial', 1, 137, '', NULL, NULL, 3, '05-12-2022', '12:02:31', '2022-12-05 06:57:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(203, 0, 0, 0, 0, 'D7TM30646OP20', 'D7TM-30646-Holder Assy. IB Latch-CED', 142, 2.86, '05-12-2022', '1', 'Initial', 1, 138, '', NULL, NULL, 3, '05-12-2022', '12:03:35', '2022-12-05 06:57:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(204, 0, 0, 0, 0, 'D7TM30647OP20', 'D7TM-30647-Base plate Assy. IB Latch-CED', 142, 5.89, '05-12-2022', '1', 'Initial', 1, 139, '', NULL, NULL, 3, '05-12-2022', '12:04:38', '2022-12-05 06:57:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(205, 0, 0, 0, 0, 'D7TM30648OP20', ' D7TM-30648-Base plate Assy. OB Latch-CED', 142, 4.4, '05-12-2022', '1', 'Initial', 1, 140, '', NULL, NULL, 3, '05-12-2022', '12:05:48', '2022-12-05 06:57:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(206, 0, 0, 0, 0, 'D7TM30693OP20', 'D7TM-30693-Holder Assy. OB Latch-CED', 142, 2.97, '05-12-2022', '1', 'Initial', 5, 141, '', NULL, NULL, 3, '05-12-2022', '12:10:14', '2022-12-05 06:58:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(207, 0, 0, 0, 0, 'D7TM30373OP20', 'D7TM-30373-Tumble Bkt. wth Norglide Bush Assy. IB 40P-CED', 142, 4.57, '05-12-2022', '1', 'Initial', 1, 142, '', NULL, NULL, 3, '05-12-2022', '12:11:07', '2022-12-05 06:58:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(208, 0, 0, 0, 0, 'D7TM30381OP20', 'D7TM-30381-Outboard Tumble Bkt. with Norglide Bush Assy. 40P-CED', 142, 4.25, '05-12-2022', '1', 'Initial', 5, 143, '', NULL, NULL, 3, '05-12-2022', '12:12:12', '2022-12-05 06:58:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(209, 0, 0, 0, 0, 'D7TM30371OP30', 'D7TM-30371-FRONT ASSLY BKT. ASSLY. WITH SLEEVE IB 40P-CED', 143, 6.28, '05-12-2022', '1', 'Initial', 1, 144, '', NULL, NULL, 3, '05-12-2022', '12:13:12', '2022-12-05 06:58:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(210, 0, 0, 0, 0, 'D7TM30383OP30', 'D7TM-30383-FRONT MTG. BKT. ASSLY. WITH SLEEVE OB 40P-CED', 142, 8.77, '05-12-2022', '1', 'Initial', 1, 145, '', NULL, NULL, 3, '05-12-2022', '12:14:39', '2022-12-05 06:58:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(211, 0, 0, 0, 0, 'D7TM30542OP20', 'D7TM-30542-TRACK STOPPER BRACKET OB REAR-CED', 142, 0.85, '05-12-2022', '1', 'Initial', 1, 231, '', NULL, NULL, 3, '05-12-2022', '12:16:48', '2022-12-07 11:34:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(212, 0, 0, 0, 0, 'D7TM30109OP20', 'D7TM-30109-TRACK STOPPER BRACKET LOWER OB 60P-CED', 142, 0.76, '05-12-2022', '1', 'Initial', 1, 147, '', NULL, NULL, 3, '05-12-2022', '12:17:46', '2022-12-05 06:59:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(213, 0, 0, 0, 0, 'D7TM30108OP70', 'D7TM-30108-Rear Mtg Bkt OB 60P-CED', 142, 3.72, '05-12-2022', '1', '0', 1, 148, '', NULL, NULL, 3, '05-12-2022', '12:18:41', '2022-12-05 06:59:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(214, 0, 0, 0, 0, 'D7TM30105OP20', 'D7TM-30105-FRONT MTG. BKT. RIVETTED ASSEMBLY OB 60P-CED', 142, 3.8, '05-12-2022', '1', 'Initial', 1, 149, '', NULL, NULL, 3, '05-12-2022', '12:19:32', '2022-12-05 06:59:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(215, 0, 0, 0, 0, 'D7TM30122OP20', 'D7TM-30122-FRONT MTG BRACKET RIVETTED ASSY. IB 60P-CED', 142, 2.14, '05-12-2022', '1', 'Initial', 1, 150, '', NULL, NULL, 3, '05-12-2022', '12:20:23', '2022-12-05 07:00:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(216, 0, 0, 0, 0, 'CM000303OP20', 'ENG MTG BKT LH-S101-CED COATING', 142, 10.5, '05-12-2022', '1', 'Initial', 1, 229, '', NULL, NULL, 3, '05-12-2022', '12:23:28', '2022-12-05 07:00:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(217, 0, 0, 0, 0, 'CM000304OP20', 'CM000304-ENG MTG BKT RH-S101_CED', 142, 7.5, '05-12-2022', '1', 'Initial', 1, 230, '', NULL, NULL, 3, '05-12-2022', '12:25:39', '2022-12-05 06:59:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(218, 0, 0, 0, 0, 'D7TM30371OP30', 'D7TM-30371-FRONT ASSLY BKT. ASSLY. WITH SLEEVE IB 40P-CED', 142, 6.28, '05-12-2022', '1', 'Initial', 1, 144, '', NULL, NULL, 3, '05-12-2022', '02:18:41', '2022-12-05 08:53:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(219, 0, 0, 0, 0, 'ST000019', 'HRPO HSLA355 SIZE 3.5*1250*2500 MM', 134, 64.6, '06-12-2022', '1', 'Initial', 2, 215, '', NULL, NULL, 3, '06-12-2022', '06:51:54', '2022-12-06 13:22:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(220, 0, 0, 0, 0, 'D8MS-24404CED', 'TOP TETHER WIRE', 102, 2, '09-12-2022', '1', 'Initial', 1, 235, '', NULL, NULL, 3, '09-12-2022', '05:32:14', '2022-12-11 06:14:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(221, 0, 0, 0, 0, 'D7TM-30115', 'TRACK LOCATOR PIN', 4, 2.35, '2022-12-11', '1', '1', 1, 21, '', NULL, NULL, 3, '11-12-2022', '11:32:07', '2022-12-11 06:14:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(222, 0, 0, 0, 0, 'BSL002055836OP80', 'FRM ARMRESET MTG BKT-BSL002055836NCPAA-CED', 102, 4.7, '11-12-2022', '1', '1', 1, 223, '', NULL, NULL, 3, '11-12-2022', '02:09:15', '2022-12-11 09:12:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(223, 0, 0, 0, 0, 'BSL002230976OP20', 'IR LONG VALANCE BKT LH SK216-BSL002230976-CED', 102, 2.25, '11-12-2022', '1', '1', 1, 225, '', NULL, NULL, 3, '11-12-2022', '02:10:07', '2022-12-11 09:13:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(224, 0, 0, 0, 0, 'BSL002231007OP20', 'LONG VALANCE BKT RH SK216-BSL002231007NCPAA-CED', 102, 2.25, '11-12-2022', '1', '1', 1, 226, '', NULL, NULL, 3, '11-12-2022', '02:10:51', '2022-12-11 09:13:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(225, 0, 0, 0, 0, 'CM000303OP20', 'ENG MTG BKT LH-S101-CED COATING', 102, 10.5, '11-12-2022', '1', '1', 1, 229, '', NULL, NULL, 3, '11-12-2022', '02:15:12', '2022-12-11 09:13:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(226, 0, 0, 0, 0, 'CM000304OP20', 'CM000304-ENG MTG BKT RH-S101_CED', 102, 7.5, '11-12-2022', '1', '1', 1, 230, '', NULL, NULL, 3, '11-12-2022', '02:15:53', '2022-12-11 09:13:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(227, 0, 0, 0, 0, 'CM000096OP20', 'U301_OUTER COVER ASSY LHS-COATING', 102, 6, '11-12-2022', '1', '1', 1, 240, '', NULL, NULL, 3, '11-12-2022', '03:30:01', '2022-12-11 10:00:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(228, 0, 0, 0, 0, 'BSL002055836OP80', 'FRM ARMRESET MTG BKT-BSL002055836NCPAA-CED', 130, 5.75, '11-12-2022', '1', '1', 1, 223, '', NULL, NULL, 3, '11-12-2022', '03:53:49', '2022-12-11 10:37:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(229, 0, 0, 0, 0, 'BSL002230976OP20', 'IR LONG VALANCE BKT LH SK216-BSL002230976-CED', 130, 2.75, '11-12-2022', '1', '1', 1, 225, '', NULL, NULL, 3, '11-12-2022', '03:54:34', '2022-12-11 10:37:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(230, 0, 0, 0, 0, 'BSL002231007OP20', 'LONG VALANCE BKT RH SK216-BSL002231007NCPAA-CED', 130, 2.75, '11-12-2022', '1', '1', 1, 226, '', NULL, NULL, 3, '11-12-2022', '03:55:05', '2022-12-11 10:38:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(231, 0, 0, 0, 0, 'D8MS-24404CED', 'TOP TETHER WIRE', 130, 2, '11-12-2022', '1', '1', 1, 235, '', NULL, NULL, 3, '11-12-2022', '04:20:36', '2022-12-11 10:50:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(232, 0, 0, 0, 0, 'BSP_RM06', 'HRPO_4.5X1250X2500 MM E34 GRADE', 99, 56.5, '11-12-2022', '1', 'Initial', 2, 213, '', NULL, NULL, 3, '11-12-2022', '06:01:38', '2022-12-11 12:31:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(233, 0, 0, 0, 0, 'D8MS-24404', 'TOP TETHER WIRE', 65, 1.53, '2022-12-12', '1', '1', 1, 2, '', NULL, NULL, 3, '12-12-2022', '05:35:20', '2022-12-12 12:07:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(234, 0, 0, 0, 0, 'DASRM_36.', 'E34- 1.6X250X2500 MM', 27, 64.01, '12-12-2022', '1', '1', 2, 242, '', NULL, NULL, 3, '12-12-2022', '05:50:07', '2022-12-12 12:20:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 8, 'accept'),
(235, 0, 0, 0, 0, 'ST000015', 'HRPO HSLA355 SIZE 2*1250*2500 MM', 134, 65, '18-12-2022', '1', '1', 2, 218, '', NULL, NULL, 3, '18-12-2022', '12:28:31', '2022-12-18 07:11:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(236, 0, 0, 0, 0, 'ST000018', 'HRPO HSLA355 SIZE 3*1250*2500 MM', 143, 67.5, '18-12-2022', '1', '1', 2, 219, '', NULL, NULL, 3, '18-12-2022', '12:31:51', '2022-12-18 07:11:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(237, 0, 0, 0, 0, 'ST000020', 'HRPO HSLA355 SIZE 4*1250*2500 MM', 134, 65, '18-12-2022', '1', '1', 2, 216, '', NULL, NULL, 3, '18-12-2022', '12:37:57', '2022-12-18 07:12:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(238, 0, 0, 0, 0, 'ST000017', 'HRPO HSLA355 SIZE-2.5X1250X2500 MM', 134, 64.5, '2022-12-10', '1', '1', 2, 100, '', NULL, NULL, 3, '18-12-2022', '12:48:10', '2022-12-18 07:19:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(239, 0, 0, 0, 0, 'ST000020', 'HRPO HSLA355 SIZE 4*1250*2500 MM', 134, 64.5, '2022-12-21', '1', '1', 2, 216, '', NULL, NULL, 3, '21-12-2022', '02:46:42', '2022-12-21 09:16:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(240, 0, 0, 0, 0, '234844OP10', 'COVER PLATE', 37, 31.67, '21-12-2022', '1', '1', 1, 244, '', NULL, NULL, 3, '21-12-2022', '03:04:24', '2022-12-22 09:38:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(241, 0, 0, 0, 0, 'D7TM30542OP10', 'D7TM30542-TRACK STOPPER BRACKET OB REAR TRACK STOPPER BRACKET OB REAR', 37, 5.44, '21-12-2022', '1', '1', 1, 232, '', NULL, NULL, 3, '21-12-2022', '03:07:10', '2022-12-21 09:47:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(242, 0, 0, 0, 0, 'D7TM30109OP10', 'D7TM30109-TRACK STOPPER BRACKET LOWER OB 60P', 37, 5.04, '21-12-2022', '1', '1', 1, 233, '', NULL, NULL, 3, '21-12-2022', '03:08:00', '2022-12-21 09:48:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(243, 0, 0, 0, 0, 'BSL002230976OP10', 'IR LONG VALANCE BKT LH SK216-BSL002230976NCPAA', 96, 5.66, '21-12-2022', '1', '1', 1, 224, '', NULL, NULL, 3, '21-12-2022', '03:17:06', '2022-12-21 09:48:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(244, 0, 0, 0, 0, 'BSL002231007OP10', 'LONG VALANCE BKT RH SK216-BSL002231007NCPAA', 96, 5.66, '21-12-2022', '1', '1', 1, 227, '', NULL, NULL, 3, '21-12-2022', '03:17:35', '2022-12-21 09:48:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(245, 0, 0, 0, 0, 'SBT000050141OP30', 'UPPER LIMIT_U301 (DRAW I & DRAW II)', 59, 6, '22-12-2022', '1', '1', 5, 238, '', NULL, NULL, 3, '22-12-2022', '12:36:42', '2022-12-22 07:15:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(246, 0, 0, 0, 0, 'SBT000050141', 'UPPER LIMIT_TURNING', 72, 2.5, '22-12-2022', '1', '1', 1, 239, '', NULL, NULL, 3, '22-12-2022', '12:38:08', '2022-12-22 07:15:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(247, 0, 0, 0, 0, '234844OP10', 'COVER PLATE', 131, 8.5, '22-12-2022', '1', '1', 1, 244, '', NULL, NULL, 3, '22-12-2022', '12:39:29', '2022-12-22 07:15:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(248, 0, 0, 0, 0, '234844OP10', 'COVER PLATE', 132, 7, '22-12-2022', '1', '1', 1, 244, '', NULL, NULL, 3, '22-12-2022', '12:40:22', '2022-12-22 07:15:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(249, 0, 0, 0, 0, '234844OP10', 'COVER PLATE', 104, 8.5, '22-12-2022', '1', '1', 1, 244, '', NULL, NULL, 3, '22-12-2022', '12:41:25', '2022-12-22 07:15:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(250, 0, 0, 0, 0, 'SCS004450A15OP20', 'SMALL BRACKET-LHS-FORMING', 37, 0.28, '22-12-2022', '1', 'new part defined', 1, 155, '', NULL, NULL, 3, '22-12-2022', '04:41:09', '2022-12-22 11:12:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(251, 0, 0, 0, 0, 'CM000096OP20', 'U301_OUTER COVER ASSY LHS-COATING', 140, 6, '23-12-2022', '1', '1', 1, 240, '', NULL, NULL, 3, '23-12-2022', '11:51:31', '2022-12-23 06:22:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(252, 0, 0, 0, 0, 'SCS004450A17OP30', 'STOPPER CUP_DRAW AND RESTRIKE', 145, 4.5, '25-12-2022', '1', 'New part added', 1, 220, '', NULL, NULL, 3, '25-12-2022', '10:37:22', '2022-12-25 05:07:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(253, 0, 0, 0, 0, '235766OP40', 'Angle L Bkt-ZINC BLUE PLATING', 131, 12.39, '25-12-2022', '1', 'New part added', 1, 252, '', NULL, NULL, 3, '25-12-2022', '11:44:23', '2022-12-25 06:16:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(254, 0, 0, 0, 0, '1000699234OP70', 'Shifter Mounting Plate Ultra Rhd-ZINC BLUE PLATING', 131, 11.25, '25-12-2022', '1', 'New part added', 1, 255, '', NULL, NULL, 3, '25-12-2022', '12:20:07', '2022-12-25 06:51:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(255, 0, 0, 0, 0, '1000699234OP70', 'Shifter Mounting Plate Ultra Rhd-ZINC BLUE PLATING', 104, 11.25, '25-12-2022', '1', 'New part added', 1, 255, '', NULL, NULL, 3, '25-12-2022', '12:21:07', '2022-12-25 06:51:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(256, 0, 0, 0, 0, '235766OP40', 'Angle L Bkt-ZINC BLUE PLATING', 131, 1, '2022-12-25', '01', 'New part added', 1, 252, '', NULL, NULL, 3, '25-12-2022', '12:39:44', '2022-12-25 07:10:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(257, 0, 0, 0, 0, '1000699234OP60', 'Shifter Mounting Plate Ultra Rhd-Machining', 146, 70, '26-12-2022', '1', '1', 1, 256, '', NULL, NULL, 3, '26-12-2022', '02:01:30', '2023-03-05 05:30:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(258, 0, 0, 0, 0, '89712-Q5020', 'SHAFT LATCH', 147, 7.25, '26-12-2022', '1', '1', 1, 12, '', NULL, NULL, 3, '26-12-2022', '02:10:51', '2022-12-26 08:43:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(259, 0, 0, 0, 0, 'BSP_RM08', 'HRPO_6.0X1250X3000 MM HR GRADE', 55, 65, '28-12-2022', '1', '1', 2, 259, '', NULL, NULL, 3, '28-12-2022', '10:57:14', '2022-12-28 05:37:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(260, 0, 0, 0, 0, 'BSP_RM12', 'HRPO_15.0X1500X3000 MM HR GRADE E350 C', 55, 62, '28-12-2022', '1', '1', 2, 263, '', NULL, NULL, 3, '28-12-2022', '10:57:44', '2022-12-28 05:38:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(261, 0, 0, 0, 0, 'BSP_RM11', 'HRPO_12.0X1500X3000 MM HR GRADE E350  C', 55, 62, '28-12-2022', '1', '1', 2, 262, '', NULL, NULL, 3, '28-12-2022', '11:12:47', '2022-12-28 05:43:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(262, 0, 0, 0, 0, 'BSP_RM07', 'HRPO_5.0X1250X2500 MM HR2 GRADE', 149, 60.5, '28-12-2022', '1', '1', 2, 214, '', NULL, NULL, 3, '28-12-2022', '11:26:25', '2022-12-28 06:10:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(263, 0, 0, 0, 0, 'BSP_RM12', 'HRPO_15.0X1500X3000 MM HR GRADE E350 C', 55, 64.5, '2022-12-28', '1', '1', 2, 263, '', NULL, NULL, 3, '28-12-2022', '11:49:25', '2022-12-28 06:19:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(264, 0, 0, 0, 0, 'BSP_RM01', 'CR SHEET_1.0X1250X2180 MM D513 GRADE', 148, 64.5, '30-12-2022', '1', '1', 2, 209, '', NULL, NULL, 3, '30-12-2022', '11:14:34', '2022-12-30 05:44:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(265, 0, 0, 0, 0, '87531-T1N00', 'RIVET- LINK BKT HINGE', 27, 20, '11-01-2023', '1', '1', 1, 267, '', NULL, NULL, 3, '11-01-2023', '04:59:08', '2023-01-11 11:29:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(266, 0, 0, 0, 0, 'GAS-T', 'OXYGEN GAS-T', 153, 30, '13-01-2023', '1', '0', 6, 272, '', NULL, NULL, 3, '13-01-2023', '09:53:49', '2023-01-13 04:24:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(267, 0, 0, 0, 0, 'GAS', 'ACM GAS-T', 153, 67, '13-01-2023', '1', '0', 6, 271, '', NULL, NULL, 3, '13-01-2023', '09:54:14', '2023-01-13 04:24:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(268, 0, 0, 0, 0, '4X16\"', 'BUFFING WHEEL ', 152, 24, '13-01-2023', '1', '0', 1, 268, '', NULL, NULL, 3, '13-01-2023', '09:57:11', '2023-01-13 04:28:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(269, 0, 0, 0, 0, '1X16\"', 'CUTTING WHEEL ', 152, 15, '13-01-2023', '1', '0', 1, 269, '', NULL, NULL, 3, '13-01-2023', '09:57:37', '2023-01-13 04:28:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(270, 0, 0, 0, 0, '4X16X100\"', 'GRINDING WHEEL ', 152, 24, '13-01-2023', '1', '0', 1, 270, '', NULL, NULL, 3, '13-01-2023', '09:58:04', '2023-01-13 04:28:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(271, 0, 0, 0, 0, 'WIRE SPOOL 0.8 MM', '0.8 MM WIRE', 154, 95, '13-01-2023', '1', '0', 1, 56, '', NULL, NULL, 3, '13-01-2023', '01:22:41', '2023-01-13 07:53:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(272, 0, 0, 0, 0, 'WIRE SPOOL', '1.2 MM WIRE', 154, 95, '13-01-2023', '1', '0', 1, 55, '', NULL, NULL, 3, '13-01-2023', '01:23:04', '2023-01-13 07:53:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(273, 0, 0, 0, 0, 'GAS- HL', 'HELIUM GAS CYL', 83, 2100, '16-01-2023', '1', '1', 6, 276, '', NULL, NULL, 3, '16-01-2023', '10:45:23', '2023-01-16 05:20:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(274, 0, 0, 0, 0, '55500860358', 'NITROGEN GAS  CYL', 83, 45, '16-01-2023', '1', '0', 6, 274, '', NULL, NULL, 3, '16-01-2023', '10:47:47', '2023-01-16 05:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(275, 0, 0, 0, 0, 'GAS- O2', 'OXIGEN LIQUID GAS', 83, 17, '16-01-2023', '1', '1', 6, 278, '', NULL, NULL, 3, '16-01-2023', '10:48:32', '2023-01-16 05:20:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(276, 0, 0, 0, 0, '55500860153', 'CO2 LIQUID GAS', 83, 12, '16-01-2023', '1', '1', 6, 275, '', NULL, NULL, 3, '16-01-2023', '10:49:17', '2023-01-16 05:20:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(277, 0, 0, 0, 0, 'GAS- NT', 'NITROGEN LIQUID GAS', 83, 16, '16-01-2023', '1', '1', 6, 277, '', NULL, NULL, 3, '16-01-2023', '10:49:52', '2023-01-16 05:20:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(278, 0, 0, 0, 0, '235766OP40', 'Angle L Bkt-ZINC BLUE PLATING', 104, 1, '16-01-2023', '1', '0', 1, 252, '', NULL, NULL, 3, '16-01-2023', '11:33:02', '2023-01-16 08:12:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(279, 0, 0, 0, 0, 'ST000015', 'HRPO HSLA355 SIZE 2*1250*2500 MM', 134, 62, '2023-01-18', '2', 'RATE CHANGE', 2, 218, '', NULL, NULL, 3, '18-01-2023', '01:43:57', '2023-01-18 08:14:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(280, 0, 0, 0, 0, 'DASRM00SPFH-03 ', 'HRPO_ 2.0X1250X2500 MM SPFH 590P', 27, 84, '20-01-2023', '1', '1', 2, 306, '', NULL, NULL, 3, '20-01-2023', '10:31:57', '2023-01-20 05:03:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(281, 0, 0, 0, 0, 'M10 REG NUT', 'ELECTROD CAP', 151, 330, '22-01-2023', '1', '1', 1, 338, '', NULL, NULL, 3, '22-01-2023', '12:58:06', '2023-01-22 07:32:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(282, 0, 0, 0, 0, 'M6  BOTTOM', 'PROJECTION ELECROD BOTTOM COPPER M6', 151, 1250, '22-01-2023', '1', '1', 1, 343, '', NULL, NULL, 3, '22-01-2023', '12:58:45', '2023-01-22 07:32:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(283, 0, 0, 0, 0, 'M10 BOTTOM', 'PROJECTION ELECROD BOTTOM COPPER', 151, 1250, '22-01-2023', '1', '1', 1, 339, '', NULL, NULL, 3, '22-01-2023', '12:59:16', '2023-01-22 07:32:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(284, 0, 0, 0, 0, '3227- M6', 'SPOT ELECTORD TIP- M6', 151, 240, '22-01-2023', '1', '1', 1, 344, '', NULL, NULL, 3, '22-01-2023', '12:59:47', '2023-01-22 07:32:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(285, 0, 0, 0, 0, '3227- M10', 'SPOT ELECTORD TIP- M10', 151, 240, '22-01-2023', '1', '1', 1, 340, '', NULL, NULL, 3, '22-01-2023', '01:00:17', '2023-01-22 07:32:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(286, 0, 0, 0, 0, 'M6 REG NUT', 'ELECTROD CAP', 151, 305, '22-01-2023', '1', '1', 1, 342, '', NULL, NULL, 3, '22-01-2023', '01:00:58', '2023-01-22 07:32:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(287, 0, 0, 0, 0, 'M10- PIN', 'SS PIN M10', 151, 120, '22-01-2023', '1', '1', 1, 341, '', NULL, NULL, 3, '22-01-2023', '01:01:32', '2023-01-22 07:32:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(288, 0, 0, 0, 0, 'M6- PIN', 'SS PIN M6', 151, 120, '22-01-2023', '1', '1', 1, 345, '', NULL, NULL, 3, '22-01-2023', '01:02:02', '2023-01-22 07:32:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(289, 0, 0, 0, 0, 'SH4000700360920', 'IFHS400-0.7X360X920 MM', 135, 71.4, '2023-01-31', '2', 'RATE CHANGE', 2, 93, '', NULL, NULL, 3, '31-01-2023', '12:42:01', '2023-01-31 07:12:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(290, 0, 0, 0, 0, 'BSL002020816OP20', 'BRACKET FERROUS,RECLINER 3RS UPPER LH_2 STAGE FORMING', 136, 52.65, '01-02-2023', '1', 'INITIAL', 1, 385, '', NULL, NULL, 3, '01-02-2023', '08:59:34', '2023-02-01 03:31:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yogita_Stamping_25.1', NULL, 1, 'accept'),
(291, 0, 0, 0, 0, 'D6MS-52123', 'TUBE HSLA1-19.05X1.6X310 MM', 27, 1, '05-02-2023', '1', '0', 1, 386, '', NULL, NULL, 3, '05-02-2023', '03:03:41', '2023-02-05 09:33:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(292, 0, 0, 0, 0, 'BSP_RM01', 'CR SHEET_1.0X1250X2180 MM D513 GRADE', 99, 71, '2023-02-07', '2', 'RATE CHANGE', 2, 209, '', NULL, NULL, 3, '07-02-2023', '11:32:44', '2023-02-07 06:03:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(293, 0, 0, 0, 0, 'ST000040', 'HRPO HR FE410 SIZE-6.0X1250X2500 MM', 134, 64.25, '2023-02-07', '2', 'RATE CHANGE', 2, 102, '', NULL, NULL, 3, '07-02-2023', '11:56:51', '2023-02-07 06:27:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(294, 0, 0, 0, 0, 'BSP_RM08', 'HRPO_6.0X1250X3000 MM HR GRADE', 156, 64, '08-02-2023', '1', '1', 2, 259, '', NULL, NULL, 3, '08-02-2023', '05:18:11', '2023-02-08 11:48:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(295, 0, 0, 0, 0, 'BSP_RM05', 'HRPO_4.0X1250X2500 MM E34 GRADE', 149, 67.5, '13-02-2023', '1', '1', 2, 212, '', NULL, NULL, 3, '13-02-2023', '12:33:26', '2023-02-13 07:03:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(296, 0, 0, 0, 0, 'BSP_RM07', 'HRPO_5.0X1250X2500 MM HR2 GRADE', 149, 64.5, '2023-02-13', '1', 'RATE CHANGE', 2, 214, '', NULL, NULL, 3, '13-02-2023', '12:34:45', '2023-02-13 07:05:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(297, 0, 0, 0, 0, 'BSP_RM05', 'HRPO_4.0X1250X2500 MM E34 GRADE', 149, 67.5, '2023-02-13', '1', 'RATE CHANGE', 2, 212, '', NULL, NULL, 3, '13-02-2023', '12:37:27', '2023-02-13 07:07:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(298, 0, 0, 0, 0, 'DASRM00SPFH-3', 'SHEET SPFH-590P 2.0X1150X2570 MM', 27, 84, '13-02-2023', '1', 'INITIAL', 2, 389, '', NULL, NULL, 3, '13-02-2023', '01:36:39', '2023-02-13 08:06:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(299, 0, 0, 0, 0, '88877-T1N00', 'T1N COVER ATTACHMENT WIRE', 27, 3.18, '14-02-2023', '1', 'BOP', 1, 391, '', NULL, NULL, 3, '14-02-2023', '12:32:47', '2023-02-14 07:02:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(300, 0, 0, 0, 0, 'BSP_RM03', 'HRPO_3.0X1250X2500 MM E34 GRADE', 99, 69, '15-02-2023', '1', '0', 2, 211, '', NULL, NULL, 3, '15-02-2023', '11:48:31', '2023-02-15 06:19:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(301, 0, 0, 0, 0, '234844', 'COVER PLATE', 157, 8.5, '18-02-2023', '1', '1', 1, 28, '', NULL, NULL, 3, '18-02-2023', '11:46:31', '2023-02-18 06:16:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(302, 0, 0, 0, 0, 'BSP_RM02', 'HRPO_2.0X1250X2500 MM E34 GRADE', 149, 69.5, '19-02-2023', '1', '0', 2, 210, '', NULL, NULL, 3, '19-02-2023', '09:35:21', '2023-02-19 04:05:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(303, 0, 0, 0, 0, 'D7TM-89821', 'PLATE BASE RH', 150, 20.71, '22-02-2023', '1', 'INITIAL', 1, 10, '', NULL, NULL, 3, '22-02-2023', '12:34:16', '2023-02-22 08:34:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.23.xl', NULL, 3, 'accept'),
(304, 0, 0, 0, 0, 'D7TM-30367', 'TRACK SUPPORTING BRACKET 40P', 150, 45.09, '22-02-2023', '1', 'INITIAL', 1, 6, '', NULL, NULL, 3, '22-02-2023', '12:35:27', '2023-02-22 08:34:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.231.x', NULL, 3, 'accept'),
(305, 0, 0, 0, 0, 'D7TM89821OP30', 'FLANGE & RESTRIKE OPERATION', 150, 21.44, '22-02-2023', '1', 'INITIAL', 1, 392, '', NULL, NULL, 3, '22-02-2023', '12:38:26', '2023-02-22 08:34:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.232.x', NULL, 3, 'accept'),
(306, 0, 0, 0, 0, 'BSL002055836OP50', 'FORMING 3 OPERATIONS', 150, 48.28, '22-02-2023', '1', 'INITIAL', 1, 393, '', NULL, NULL, 3, '22-02-2023', '12:41:46', '2023-02-22 08:34:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.233.x', NULL, 1, 'accept'),
(307, 0, 0, 0, 0, 'D7TM30108OP60', 'FINAL INSPECTION', 150, 20.12, '22-02-2023', '1', 'INITIAL', 1, 182, '', NULL, NULL, 3, '22-02-2023', '12:50:17', '2023-02-22 08:34:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.234.x', NULL, 3, 'accept'),
(308, 0, 0, 0, 0, 'L002020809OP10', 'BLANK JOB', 150, 1.1, '22-02-2023', '1', 'INITIAL', 1, 394, '', NULL, NULL, 3, '22-02-2023', '02:02:13', '2023-02-22 08:34:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(309, 0, 0, 0, 0, '88966-T1N00', 'T1N FR LINK BRKT NORMAL', 27, 23.91, '02-03-2023', '1', 'INITIAL', 1, 396, '', NULL, NULL, 3, '02-03-2023', '03:41:21', '2023-03-02 10:11:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DAS_BOP_Inv-T1N_02-M', NULL, 3, 'accept'),
(310, 0, 0, 0, 0, 'ST000015', 'HRPO HSLA355 SIZE 2*1250*2500 MM', 134, 66.75, '2023-03-03', '3', 'RATE CHANGE', 2, 218, '', NULL, NULL, 3, '03-03-2023', '03:28:04', '2023-03-03 10:01:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(311, 0, 0, 0, 0, 'ST000020', 'HRPO HSLA355 SIZE 4*1250*2500 MM', 134, 65.75, '2023-03-03', '3', 'RATE CHANGE', 2, 216, '', NULL, NULL, 3, '03-03-2023', '03:29:39', '2023-03-03 10:01:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(312, 0, 0, 0, 0, 'ST000040', 'HRPO HR FE410 SIZE-6.0X1250X2500 MM', 134, 66, '2023-03-03', '3', 'RATE CHANGE', 2, 102, '', NULL, NULL, 3, '03-03-2023', '03:30:15', '2023-03-03 10:01:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(313, 0, 0, 0, 0, 'SBT000050141', 'UPPER LIMIT_TURNING', 146, 2.5, '05-03-2023', '1', '0', 1, 239, '', NULL, NULL, 3, '05-03-2023', '10:15:08', '2023-03-05 04:46:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(314, 0, 0, 0, 0, 'SBT000050141OP50', 'UPPER LIMIT_PIERCING', 150, 31.09, '06-03-2023', '1', 'INITIAL', 1, 253, '', NULL, NULL, 3, '06-03-2023', '07:15:28', '2023-03-06 13:46:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.235.x', NULL, 3, 'accept'),
(315, 0, 0, 0, 0, 'SBT000050141', 'UPPER LIMIT_TURNING', 150, 34.31, '06-03-2023', '1', 'INITIAL', 1, 239, '', NULL, NULL, 3, '06-03-2023', '07:16:18', '2023-03-07 11:43:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sahyadri_22.02.236.x', NULL, 3, 'accept'),
(316, 0, 0, 0, 0, 'BSP_RM01', 'CR SHEET_1.0X1250X2180 MM D513 GRADE', 99, 70, '2023-03-15', '3', 'RATE CHANGE', 2, 209, '', NULL, NULL, 3, '15-03-2023', '06:13:09', '2023-03-15 12:43:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(317, 0, 0, 0, 0, 'D6MS-50258', 'TOWEL BAR PIVOT PIN', 27, 1.75, '17-03-2023', '1', 'NEW PART', 1, 401, '', NULL, NULL, 3, '17-03-2023', '01:48:33', '2023-03-17 11:37:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 3, 'accept'),
(318, 0, 0, 0, 0, '235766OP40', 'Angle L Bkt-ZINC BLUE PLATING', 157, 1, '17-03-2023', '1', 'INITIAL', 1, 252, '', NULL, NULL, 3, '17-03-2023', '05:06:55', '2023-03-19 12:18:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(320, 0, 0, 0, 0, 'CM000117OP10', 'U301OUTER COVER ASSY BKT RHS', 102, 6, '18-03-2023', '1', '0', 1, 402, '', NULL, NULL, 3, '18-03-2023', '10:24:43', '2023-03-18 04:54:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(321, 0, 0, 0, 0, 'CM000096OP20', 'U301_OUTER COVER ASSY LHS-COATING', 88, 6.5, '21-03-2023', '1', '0', 1, 240, '', NULL, NULL, 3, '21-03-2023', '10:13:18', '2023-03-21 04:44:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(322, 0, 0, 0, 0, 'CM000117OP20', 'U301_OUTER COVER ASSY RHS_POWDER COATING', 88, 6.5, '21-03-2023', '1', '0', 1, 400, '', NULL, NULL, 3, '21-03-2023', '10:14:09', '2023-03-21 04:44:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(323, 0, 0, 0, 0, '1000699234OP70', 'Shifter Mounting Plate Ultra Rhd-ZINC BLUE PLATING', 157, 11.25, '21-03-2023', '1', '0', 1, 255, '', NULL, NULL, 3, '21-03-2023', '11:45:13', '2023-03-21 06:15:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(324, 0, 0, 0, 0, 'DASRM_69', 'SPFH590 2.0X1150X2570', 27, 84, '25-03-2023', '1', 'INITIAL', 2, 405, '', NULL, NULL, 3, '25-03-2023', '11:08:10', '2023-03-25 05:41:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSP_-_SPFH590_2_mm.p', NULL, 8, 'accept'),
(325, 0, 0, 0, 0, '73209044', 'SWITCH OFF PLATE CRADLE UH TYPE 1', 158, 33.91, '26-03-2023', '1', 'INITIAL', 1, 406, '', NULL, NULL, 3, '26-03-2023', '04:10:03', '2023-03-26 10:40:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'accept'),
(326, 0, 0, 0, 0, 'BSP_RM31', 'HR_4.0X1250X2500 MM DD 1079 GRADE', 149, 64.5, '27-03-2023', '1', '0', 2, 423, '', NULL, NULL, 3, '27-03-2023', '10:19:14', '2023-03-27 04:52:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(327, 0, 0, 0, 0, 'BSP_RM05', 'HRPO_4.0X1250X2500 MM E34 GRADE', 149, 69, '2023-03-27', '1', 'RATE CHANGE', 2, 212, '', NULL, NULL, 3, '27-03-2023', '10:21:29', '2023-03-27 04:52:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(328, 0, 0, 0, 0, 'BSP_RM03', 'HRPO_3.0X1250X2500 MM E34 GRADE', 149, 69, '27-03-2023', '1', 'RATE CHANGE', 2, 211, '', NULL, NULL, 3, '27-03-2023', '10:22:35', '2023-03-27 04:52:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(329, 0, 0, 0, 0, 'BSP_RM03', 'HRPO_3.0X1250X2500 MM E34 GRADE', 99, 67, '2023-03-27', '3', 'RATE CHANGE', 2, 211, '', NULL, NULL, 3, '27-03-2023', '10:25:26', '2023-03-27 04:55:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'accept'),
(330, 0, 0, 0, 0, '5780407-01', 'LINK', 158, 6.96, '28-03-2023', '1', 'INITIAL', 1, 432, '', NULL, NULL, 3, '28-03-2023', '04:04:25', '2023-03-28 10:34:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 7, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `child_part_variance`
--

CREATE TABLE `child_part_variance` (
  `id` int(11) NOT NULL,
  `stock` float NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(250) NOT NULL,
  `supplier_id` int(30) DEFAULT NULL,
  `part_rate` int(11) DEFAULT NULL,
  `revision_date` varchar(50) DEFAULT NULL,
  `revision_no` varchar(50) DEFAULT NULL,
  `revision_remark` varchar(20) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `child_part_id` int(255) NOT NULL,
  `store_rack_location` varchar(255) DEFAULT NULL,
  `store_stock_rate` float DEFAULT NULL,
  `safty_buffer_stk` varchar(255) NOT NULL,
  `diagram` varchar(50) DEFAULT NULL,
  `quote` varchar(50) DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `part_drawing` text DEFAULT NULL,
  `ppap_document` text NOT NULL,
  `modal_document` text NOT NULL,
  `cad_file` text NOT NULL,
  `a_d` text NOT NULL,
  `q_d` text NOT NULL,
  `c_d` text NOT NULL,
  `quotation_document` varchar(20) DEFAULT NULL,
  `gst_id` int(11) DEFAULT NULL,
  `sub_type` text DEFAULT NULL,
  `max_uom` float DEFAULT NULL,
  `min_uom` float DEFAULT NULL,
  `onhold_stock` float NOT NULL,
  `production_qty` float NOT NULL,
  `rejection_prodcution_qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `contact_person` varchar(30) NOT NULL,
  `pan_no` varchar(20) NOT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `shifting_address` varchar(255) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `gst_number` varchar(50) NOT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0,
  `state` varchar(20) NOT NULL,
  `state_no` varchar(200) NOT NULL,
  `bank_details` text NOT NULL,
  `address1` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `pin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_name`, `contact_person`, `pan_no`, `billing_address`, `shifting_address`, `phone_no`, `gst_number`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `state`, `state_no`, `bank_details`, `address1`, `location`, `pin`) VALUES
(1, 'BSP METATECH LLP', 'Pravin Mali', 'AAFFL7327N', 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405 Email: pravinmali@bspmetatech.com', 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 </br>Contact: 9545512405 Email: pravinmali@bspmetatech.com', '9545512405', '27AAFFL7327N1ZT', 3, '31-03-2023', '11:44:47', '2021-12-09 15:35:05', 0, 'Maharashtra', '27', 'A/C Name: BSP METATECH LLP, A/C No: 2919008700011910, IFSC Code: PUNB0291900, Bank Name: PUNJAB NATIONAL BANK', 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN', 'PUNE', '410501');

-- --------------------------------------------------------

--
-- Table structure for table `consumable_item`
--

CREATE TABLE `consumable_item` (
  `id` int(11) NOT NULL,
  `part_number` varchar(30) NOT NULL,
  `part_description` varchar(30) NOT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_code` varchar(30) NOT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `shifting_address` varchar(255) NOT NULL,
  `payment_terms` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `gst_number` varchar(50) NOT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0,
  `vendor_code` varchar(20) DEFAULT NULL,
  `pan_no` varchar(20) NOT NULL,
  `state_no` varchar(20) NOT NULL,
  `bank_details` text NOT NULL,
  `customer_challan_number` varchar(20) DEFAULT NULL,
  `pos` varchar(10) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `pin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `customer_code`, `billing_address`, `shifting_address`, `payment_terms`, `state`, `gst_number`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `vendor_code`, `pan_no`, `state_no`, `bank_details`, `customer_challan_number`, `pos`, `address1`, `location`, `pin`) VALUES
(1, 'Automotive Stampings and Assemblies Ltd', 'BSPC1001', 'Gat No.427,Medankarwadi,, Chakan,Tal-Khed,Pune.', 'Gat No.427,Medankarwadi,, Chakan,Tal-Khed,Pune.', '60', 'Maharashtra', '27AAACJ2116M1ZN', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACJ2116M', '27', '                                                                                                                                                                                ', NULL, '27', 'Gat No.427,Medankarwadi,, Chakan,Tal-Khed,Pune.', 'Pune', '410505'),
(2, 'Daebu Automotive Seat India Pvt Ltd', 'BSPC1002', 'Plot No-01 Midc Chakan Industrial Estate, Area Village Bhamboli, Phase-II , Taluka -Khed , Dist -Pune', 'Plot No-01 Midc Chakan Industrial Estate, Area Village Bhamboli, Phase-II , Taluka -Khed , Dist -Pune', '60', 'Maharashtra', '27AACCD4599E1ZH', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACCD4599E', '27', '', NULL, '27', 'Plot No-01 Midc Chakan Industrial Estate, Area Village Bhamboli, Phase-II , Taluka -Khed , Dist -Pun', 'Pune', '410505'),
(3, 'Daechang India Seat Compnay Pvt Ltd -P3', 'BSPC1003', 'Gat No -98/3 , Ambhetan Village, Behind Prakash Packeging Ltd, Chakan Khed Pune -410501', 'Gat No -98/3 , Ambhetan Village, Behind Prakash Packeging Ltd, Chakan Khed Pune -410501', '60', 'Maharashtra', '27AACCD3176F1ZS', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACCD3176F', '27', '', NULL, '27', 'Gat No -98/3 , Ambhetan Village, Behind Prakash Packeging Ltd, Chakan Khed Pune -410501', 'Pune', '410501'),
(4, 'Forbes Marshall Pvt Ltd', 'BSPC1004', '885 Phase-III, Chakan Ind Estate, Sawardari Chakan', '885 Phase-III, Chakan Ind Estate, Sawardari Chakan', '60', 'Maharashtra', '27AAACF2630E1Z5', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACF2630E', '27', '', NULL, '27', '885 Phase-III, Chakan Ind Estate, Sawardari Chakan', 'Pune', '410501'),
(5, 'Hammer Enterprises-Sales', 'BSPC1005', 'J Block 131 , Midc Bhosari, Pune-411026', 'J Block 131 , Midc Bhosari, Pune-411026', '60', 'Maharashtra', '27AHOPT6169L1ZB', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AHOPT6169L', '27', '', NULL, '27', 'J Block 131 , Midc Bhosari, Pune-411026', 'Pune', '411026'),
(6, 'Hyva India Pvt Ltd-Mumbai', 'BSPC1006', 'Plot No. EL215, MIDC, Mahape,, Navi Mumbai.', 'Plot No. EL215, MIDC, Mahape,, Navi Mumbai.', '60', 'Maharashtra', '27AAACH2006C1ZD', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACH2006C', '27', '', NULL, '27', 'Plot No. EL215, MIDC, Mahape,, Navi Mumbai.', 'Mumbai', '400710'),
(7, 'Hywa India Pvt Ltd-Pune', 'BSPC1007', 'Global Raosoni Industrial Park, Gat No Part -185&186 Fulgoan Haveli, Pune-412216', 'Global Raosoni Industrial Park, Gat No Part -185&186 Fulgoan Haveli, Pune-412216', '60', 'Maharashtra', '27AAACH2006C1ZD', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACH2006C', '27', '', NULL, '27', 'Global Raosoni Industrial Park, Gat No Part -185&186 Fulgoan Haveli, Pune-412216', 'Pune', '412216'),
(8, 'JCB India Ltd', 'BSPC1008', 'Plot No-A&B, Talegoan Forticulture & Industrial, Park ,Vil , Ambi Navlakh Umbre , Tal-Maval,, Pune-410507', 'Plot No-A&B, Talegoan Forticulture & Industrial, Park ,Vil , Ambi Navlakh Umbre , Tal-Maval,, Pune-410507', '60', 'Maharashtra', '27AAACE0078P1ZD', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACE0078P', '27', '', NULL, '27', 'Plot No-A&B, Talegoan Forticulture & Industrial, Park ,Vil , Ambi Navlakh Umbre , Tal-Maval,, Pune-4', 'Pune', '410507'),
(9, 'Jiteen Automobiles Private Limited', 'BSPC1009', 'G No-343/2 Mahalunge Ingale, Chakan Pune-410501', 'G No-343/2 Mahalunge Ingale, Chakan Pune-410501', '60', 'Maharashtra', '27AADCJ9828R1ZL', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AADCJ9828R', '27', '', NULL, '27', 'G No-343/2 Mahalunge Ingale, Chakan Pune-410501', 'Pune', '410501'),
(10, 'Jiteen Engineering Works', 'BSPC1010', '681/1 , Landewadi , Bhosari , Pune-411039', '681/1 , Landewadi , Bhosari , Pune-411039', '60', 'Maharashtra', '27AAHPN3756F1ZK', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAHPN3756F', '27', '', NULL, '27', '681/1 , Landewadi , Bhosari , Pune-411039', 'Pune', '411039'),
(11, 'J.N.Traders', 'BSPC1011', 'Gat No..197/198,, Dehu Alandi Road,, Chickli.', 'Gat No..197/198,, Dehu Alandi Road,, Chickli.', '60', 'Maharashtra', '27AACFJ1692H1ZB', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACFJ1692H', '27', '', NULL, '27', 'Gat No..197/198,, Dehu Alandi Road,, Chickli.', 'Pune', '412105'),
(12, 'Kabira Mobility LLP', 'BSPC1012', 'Plot No-L-148 & 149, Verna Ind Estate Verna, Goa-403722', 'Plot No-L-148 & 149, Verna Ind Estate Verna, Goa-403722', '60', 'Goa', '30AAVFK5226F1ZE', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAVFK5226F', '30', '', NULL, '30', 'Plot No-L-148 & 149, Verna Ind Estate Verna, Goa-403722', 'Goa', '403722'),
(13, 'K and B Industries-Sale', 'BSPC1013', 'Bld Afl C/60 Sr No-150,151,152, Mahada Pimpri Pune-411010', 'Bld Afl C/60 Sr No-150,151,152, Mahada Pimpri Pune-411010', '60', 'Maharashtra', '27AAUFK2696J1ZH', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAUFK2696J', '27', '', NULL, '27', 'Bld Afl C/60 Sr No-150,151,152, Mahada Pimpri Pune-411010', 'Pune', '411010'),
(14, 'KBR Manufacturing Pvt Ltd', 'BSPC1014', 'Plot No-Pap-G-17-3, Ph-3,, Nighoje Midc Chakan', 'Plot No-Pap-G-17-3, Ph-3,, Nighoje Midc Chakan', '60', 'Maharashtra', '27AAHCK3375N1ZY', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAHCK3375N', '27', '', NULL, '27', 'Plot No-Pap-G-17-3, Ph-3,, Nighoje Midc Chakan', 'Pune', '410501'),
(15, 'Kelvion India Pvt Ltd', 'BSPC1015', 'A-31/32 Ph-Iv,Chakan Midc, Nighoje Taluka-Khed, Pune-410501', 'A-31/32 Ph-Iv,Chakan Midc, Nighoje Taluka-Khed, Pune-410501', '60', 'Maharashtra', '27AACCG3264H1ZO', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACCG3264H', '27', '', NULL, '27', 'A-31/32 Ph-Iv,Chakan Midc, Nighoje Taluka-Khed, Pune-410501', 'Pune', '410501'),
(16, 'Kiran Enterprises -Sales', 'BSPC1016', '18/87 Jyoyibhanagar Talawade, Pune-412114', '18/87 Jyoyibhanagar Talawade, Pune-412114', '60', 'Maharashtra', '27AALFK0803G1ZK', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AALFK0803G', '27', '', NULL, '27', '18/87 Jyoyibhanagar Talawade, Pune-412114', 'Pune', '412114'),
(17, 'Kongsberg Automotive (INDIA) Pvt. Ltd. Delhi', 'BSPC1017', '48 KM Milestone,Delhi,, Mathura Road,, Sector-10,Prithla,Dist.:Palwal', '48 KM Milestone,Delhi,, Mathura Road,, Sector-10,Prithla,Dist.:Palwal', '60', 'Haryana', '06AADCK3180H2ZN', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AADCK3180H', '6', '', NULL, '6', '48 KM Milestone,Delhi,, Mathura Road,, Sector-10,Prithla,Dist.:Palwal', 'Prithla', '121102'),
(18, 'Krishna Tool Room', 'BSPC1018', 'Gat No-613/1, Plot No-24 , Kuruli ,, Tal-Khed -Chakan Pune', 'Gat No-613/1, Plot No-24 , Kuruli ,, Tal-Khed -Chakan Pune', '60', 'Maharashtra', '27AUNPR1798R1ZA', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AUNPR1798R', '27', '', NULL, '27', 'Gat No-613/1, Plot No-24 , Kuruli ,, Tal-Khed -Chakan Pune', 'Pune', '410501'),
(19, 'Kuber Stampings LLP- Sales', 'BSPC1019', 'Gat No-796 , Pawarwasti Kudalwadi ,, Chikhli , Pune', 'Gat No-796 , Pawarwasti Kudalwadi ,, Chikhli , Pune', '60', 'Maharashtra', '27AARFK7864R1Z0', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AARFK7864R', '27', '', NULL, '27', 'Gat No-796 , Pawarwasti Kudalwadi ,, Chikhli , Pune', 'Pune', '412105'),
(20, 'Matchwell Engineering Pvt Ltd-Unit.II', 'BSPC1020', 'Gat No-1605,Dehu Alandi Road,Opp Shivshakti, Garden Dhaba,Shelarwadi,Chikali Pune', 'Gat No-1605,Dehu Alandi Road,Opp Shivshakti, Garden Dhaba,Shelarwadi,Chikali Pune', '60', 'Maharashtra', '27AAACM2890D1ZM', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACM2890D', '27', '', NULL, '27', 'Gat No-1605,Dehu Alandi Road,Opp Shivshakti, Garden Dhaba,Shelarwadi,Chikali Pune', 'Pune', '412105'),
(21, 'MK Tron Autoparts Pvt Ltd', 'BSPC1021', 'Plot No-A19,Talegaon Industrial Area, Navlakhumbre Maval Pune', 'Plot No-A19,Talegaon Industrial Area, Navlakhumbre Maval Pune', '60', 'Maharashtra', '27AACCD5858L1Z6', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACCD5858L', '27', '', NULL, '27', 'Plot No-A19,Talegaon Industrial Area, Navlakhumbre Maval Pune', 'Pune', '410506'),
(22, 'Moraya Die Caster', 'BSPC1022', 'Gat No-1516 Patil Nagar Chikali Pune', 'Gat No-1516 Patil Nagar Chikali Pune', '60', 'Maharashtra', '27ASDPT8019P1ZY', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'ASDPT8019P', '27', '', NULL, '27', 'Gat No-1516 Patil Nagar Chikali Pune', 'Pune', '412105'),
(23, 'Morya Machine Tools', 'BSPC1023', 'Sai Park Near Rodey Hospital, Dighi Pune-411015', 'Sai Park Near Rodey Hospital, Dighi Pune-411015', '60', 'Maharashtra', '27AMSPB7696M1Z2', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AMSPB7696M', '27', '', NULL, '27', 'Sai Park Near Rodey Hospital, Dighi Pune-411015', 'Pune', '411015'),
(24, 'M Plus Cnc Tech Pvt Ltd', 'BSPC1024', 'G-16 Phase-III Midc Chakan, Nighoje Tal-Khed Pune', 'G-16 Phase-III Midc Chakan, Nighoje Tal-Khed Pune', '60', 'Maharashtra', '27AAECM0256D1ZU', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAECM0256D', '27', '', NULL, '27', 'G-16 Phase-III Midc Chakan, Nighoje Tal-Khed Pune', 'Pune', '410501'),
(25, 'Msc Metal Buisness', 'BSPC1025', 'Sr No-25 Gat No-686 Jadhavwadi Chikali', 'Sr No-25 Gat No-686 Jadhavwadi Chikali', '60', 'Maharashtra', '27BBQPC8111C1ZY', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'BBQPC8111C', '27', '', NULL, '27', 'Sr No-25 Gat No-686 Jadhavwadi Chikali', 'Pune', '412105'),
(26, 'Nexteer Automotive India Private Limited Banglore', 'BSPC1026', 'Plot No 98A, Phase II,KIADB Industrial Area,, Jigani, Bengaluru, INDIA', 'Plot No 98A, Phase II,KIADB Industrial Area,, Jigani, Bengaluru, INDIA', '60', 'Karnataka', '29AADCR9139D1Z6', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AADCR9139D', '29', '', NULL, '29', 'Plot No 98A, Phase II,KIADB Industrial Area,, Jigani, Bengaluru, INDIA', 'Bengaluru', '560105'),
(27, 'Nexteer Automotive India Pvt Ltd', 'BSPC1027', 'Ltd., Phase 1, KHED,Plot No B-17/1,, Chakan Industrial Area,Pune', 'Ltd., Phase 1, KHED,Plot No B-17/1,, Chakan Industrial Area,Pune', '60', 'Maharashtra', '27AADCR9139D1ZA', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AADCR9139D', '27', '', NULL, '27', 'Ltd., Phase 1, KHED,Plot No B-17/1,, Chakan Industrial Area,Pune', 'Pune', '410501'),
(28, 'Nitin Indutries-Sales', 'BSPC1028', 'Sr No-42,43 Swapnil Industrial Estate, Gulve Vasti Near Swami Samarth School, Indryani Nagar', 'Sr No-42,43 Swapnil Industrial Estate, Gulve Vasti Near Swami Samarth School, Indryani Nagar', '60', 'Maharashtra', '27AASFN0489N1ZD', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AASFN0489N', '27', '', NULL, '27', 'Sr No-42,43 Swapnil Industrial Estate, Gulve Vasti Near Swami Samarth School, Indryani Nagar', 'Pune', '411026'),
(29, 'Om Techno-Crat Pvt Ltd Unit-II', 'BSPC1029', 'Gala No.1,Near Mercedez Benz,, Gat No.197,Chakan MIDC,Nighoje,, Village-Khed, Pune', 'Gala No.1,Near Mercedez Benz,, Gat No.197,Chakan MIDC,Nighoje,, Village-Khed, Pune', '60', 'Maharashtra', '27AAACO3277G1ZF', 3, '10/28/2021', '12:57:06', NULL, 0, 'SB001', 'AAACO3277G', '27', '', NULL, '27', 'Gala No.1,Near Mercedez Benz,, Gat No.197,Chakan MIDC,Nighoje,, Village-Khed, Pune', 'Pune', '410501'),
(30, 'Om Technokrats', 'BSPC1030', 'Plot No-357/56, Waghjaingar, Kharabwadi Chakan', 'Plot No-357/56, Waghjaingar, Kharabwadi Chakan', '60', 'Maharashtra', '27AADFO0865E1ZE', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AADFO0865E', '27', '', NULL, '27', 'Plot No-357/56, Waghjaingar, Kharabwadi Chakan', 'Pune', '410501'),
(31, 'Onkar Testing Machines and Services', 'BSPC1031', 'Plot No-9a/p Ratnatray Colony, Near New Maharastra School Kupwad Road, Laxmi Mandir', 'Plot No-9a/p Ratnatray Colony, Near New Maharastra School Kupwad Road, Laxmi Mandir', '60', 'Maharashtra', '27AJSPG1490M1ZN', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AJSPG1490M', '27', '', NULL, '27', 'Plot No-9a/p Ratnatray Colony, Near New Maharastra School Kupwad Road, Laxmi Mandir', 'Sangli', '416436'),
(32, 'Pentagon Industries Pvt Ltd', 'BSPC1032', 'PLOT NO -J-18/1 MIDC KUPWAD, SANGLI -416436', 'PLOT NO -J-18/1 MIDC KUPWAD, SANGLI -416436', '60', 'Maharashtra', '27AAFCP1038D1ZS', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAFCP1038D', '27', '', NULL, '27', 'PLOT NO -J-18/1 MIDC KUPWAD, SANGLI -416436', 'Sangli', '416436'),
(33, 'Pentanen Engineering Pvt. Ltd.', 'BSPC1033', 'Works: Plot No. C-11,CHAKAN INDL AREA,, MIDC,MAHALUNGE,TAL-KHED DIST-PUNE 410501, MAHARASHTRA, INDIA', 'Works: Plot No. C-11,CHAKAN INDL AREA,, MIDC,MAHALUNGE,TAL-KHED DIST-PUNE 410501, MAHARASHTRA, INDIA', '60', 'Maharashtra', '27AAICP1262C1ZP', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAICP1262C', '27', '', NULL, '27', 'Works: Plot No. C-11,CHAKAN INDL AREA,, MIDC,MAHALUNGE,TAL-KHED DIST-PUNE 410501, MAHARASHTRA, INDIA', 'Pune', '410501'),
(34, 'Profive Engineering Pvt Ltd', 'BSPC1034', 'Gat No-457,Milkat No-2680,, Kuruli Nighoje Road, Khed-410501', 'Gat No-457,Milkat No-2680,, Kuruli Nighoje Road, Khed-410501', '60', 'Maharashtra', '27AAFCP5087J1ZY', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAFCP5087J', '27', '', NULL, '27', 'Gat No-457,Milkat No-2680,, Kuruli Nighoje Road, Khed-410501', 'Pune', '410501'),
(35, 'Putzmeister Concrete Machine Pvt Ltd', 'BSPC1035', 'Plot No -N 4 Phase Iv Venrna Industrial', 'Plot No -N 4 Phase Iv Venrna Industrial', '60', 'Goa', '30AACCD2090G1Z8', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACCD2090G', '30', '', NULL, '30', 'Plot No -N 4 Phase Iv Venrna Industrial', 'Goa', '403722'),
(36, 'Ramelex Pvt Ltd', 'BSPC1036', 'S No-82/4 Near Vidyut Control, Dangat Ind Estate Shivane, Haveli-411023', 'S No-82/4 Near Vidyut Control, Dangat Ind Estate Shivane, Haveli-411023', '60', 'Maharashtra', '27AACCR4612E1ZP', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AACCR4612E', '27', '', NULL, '27', 'S No-82/4 Near Vidyut Control, Dangat Ind Estate Shivane, Haveli-411023', 'Pune', '411023'),
(37, 'Rimmi Industries-Sales', 'BSPC1037', 'Gat No-78 Jyotibanagar, Talawade Pune', 'Gat No-78 Jyotibanagar, Talawade Pune', '60', 'Maharashtra', '27AJKPC9516E2Z8', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AJKPC9516E', '27', '', NULL, '27', 'Gat No-78 Jyotibanagar, Talawade Pune', 'Pune', '411062'),
(38, 'R R Engineering', 'BSPC1038', 'Gat No-613/9 Plot-14, Near Mercedezbenz Road Chakan Midc Road, Pune-410501', 'Gat No-613/9 Plot-14, Near Mercedezbenz Road Chakan Midc Road, Pune-410501', '60', 'Maharashtra', '27AAZFR5944F1ZH', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAZFR5944F', '27', '', NULL, '27', 'Gat No-613/9 Plot-14, Near Mercedezbenz Road Chakan Midc Road, Pune-410501', 'Pune', '410501'),
(39, 'Sahyadri Industries-Sales', 'BSPC1039', 'Plot No-G24 Midc Chakan Phase-III, Village Nighoje Tal-Khed', 'Plot No-G24 Midc Chakan Phase-III, Village Nighoje Tal-Khed', '60', 'Maharashtra', '27ACSFS0995E1ZK', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'ACSFS0995E', '27', '', NULL, '27', 'Plot No-G24 Midc Chakan Phase-III, Village Nighoje Tal-Khed', 'Pune', '410501'),
(40, 'Sai Industries -Dr', 'BSPC1040', 'W-225 S Block Pune-411026, 8007771121', 'W-225 S Block Pune-411026, 8007771121', '60', 'Maharashtra', '27ABGPK1621E1Z4', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'ABGPK1621E', '27', '', NULL, '27', 'W-225 S Block Pune-411026, 8007771121', 'Pune', '411026'),
(41, 'Sany Heavy Industry India Pvt Ltd', 'BSPC1041', 'Plot No-E 4 Chakan Industrial Area, Phase-III, Kuruli ,Tal -Khed ,, Pune-410501', 'Plot No-E 4 Chakan Industrial Area, Phase-III, Kuruli ,Tal -Khed ,, Pune-410501', '60', 'Maharashtra', '27AAGCS7754L1ZO', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAGCS7754L', '27', '', NULL, '27', 'Plot No-E 4 Chakan Industrial Area, Phase-III, Kuruli ,Tal -Khed ,, Pune-410501', 'Pune', '410501'),
(42, 'Sattyam Engineers - Sale', 'BSPC1042', 'Gat No. 275/1, Deshing, Tal. Kavthe-Mahankal,, Dist. Sangli', 'Gat No. 275/1, Deshing, Tal. Kavthe-Mahankal,, Dist. Sangli', '60', 'Maharashtra', '27ALRPP1484H1ZK', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'ALRPP1484H', '27', '', NULL, '27', 'Gat No. 275/1, Deshing, Tal. Kavthe-Mahankal,, Dist. Sangli', 'Sangli', '416405'),
(43, 'Shubh Industries-Sales', 'BSPC1043', 'Sr No-15/1 Gulve Vasti, Opposite Hindustan Pressing Work, Bhosari Pune-411026', 'Sr No-15/1 Gulve Vasti, Opposite Hindustan Pressing Work, Bhosari Pune-411026', '60', 'Maharashtra', '27AMQPC4938D1ZZ', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AMQPC4938D', '27', '', NULL, '27', 'Sr No-15/1 Gulve Vasti, Opposite Hindustan Pressing Work, Bhosari Pune-411026', 'Pune', '411026'),
(44, 'Sujan Contitech AVS Pvt Ltd', 'BSPC1044', 'Plot No. F-11, Phase -III, MIDC, Chakan, Kharabwadi, Tal. Khed, Dist. Pune.', 'Plot No. F-11, Phase -III, MIDC, Chakan, Kharabwadi, Tal. Khed, Dist. Pune.', '60', 'Maharashtra', '27AAMCS2867C1Z5', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAMCS2867C', '27', '', NULL, '27', 'Plot No. F-11, Phase -III, MIDC, Chakan, Kharabwadi, Tal. Khed, Dist. Pune.', 'Pune', '410501'),
(45, 'Tata Autocomp Systems Ltd', 'BSPC1045', 'TACO HOUSE DHAMLE PETH ,, OFF LAWA COLLAGE ROAD ,, PUNE-411004', 'TACO HOUSE DHAMLE PETH ,, OFF LAWA COLLAGE ROAD ,, PUNE-411004', '60', 'Maharashtra', '27AAACT1848E1ZH', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACT1848E', '27', '', NULL, '27', 'TACO HOUSE DHAMLE PETH ,, OFF LAWA COLLAGE ROAD ,, PUNE-411004', 'Pune', '411004'),
(46, 'Technico Industries Ltd', 'BSPC1046', 'PLOT NO-PAP-V-1/2 MIDC PHASE-II, CHAKAN PUNE-, 911242841300', 'PLOT NO-PAP-V-1/2 MIDC PHASE-II, CHAKAN PUNE-, 911242841300', '60', 'Maharashtra', '27AAACT4445P1ZV', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACT4445P', '27', '', NULL, '27', 'PLOT NO-PAP-V-1/2 MIDC PHASE-II, CHAKAN PUNE-, 911242841300', 'Pune', '410501'),
(47, 'Technosys Equipment Pvt Ltd', 'BSPC1047', 'Plot No-144 Sector-10 Pcndta, Near Vishweshwar Chock ,Bhosari, Pune-411026', 'Plot No-144 Sector-10 Pcndta, Near Vishweshwar Chock ,Bhosari, Pune-411026', '60', 'Maharashtra', '27AAFCT0213J1ZK', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAFCT0213J', '27', '', NULL, '27', 'Plot No-144 Sector-10 Pcndta, Near Vishweshwar Chock ,Bhosari, Pune-411026', 'Pune', '411026'),
(48, 'Teerham Industries', 'BSPC1048', 'Gat No.463,Kuruli Gaon,, Village Kuruli,Tal.:Khed,, Dist.:Pune.', 'Gat No.463,Kuruli Gaon,, Village Kuruli,Tal.:Khed,, Dist.:Pune.', '60', 'Maharashtra', '27AALFT1651P1ZK', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AALFT1651P', '27', '', NULL, '27', 'Gat No.463,Kuruli Gaon,, Village Kuruli,Tal.:Khed,, Dist.:Pune.', 'Pune', '410501'),
(49, 'Tengco', 'BSPC1049', '711 WEST BOONESLICK ROAD, JONESBURG ,MISSOURI,63351 USA', '711 WEST BOONESLICK ROAD, JONESBURG ,MISSOURI,63351 USA', '60', 'Maharashtra', 'NA', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'NA', '27', '', NULL, '27', '711 WEST BOONESLICK ROAD, JONESBURG ,MISSOURI,63351 USA', 'Missouri, USA', '63351'),
(50, 'Track Components Ltd. Sales', 'BSPC1050', 'Plot No. A-1/4, Phase IV, MVML Vendor Park, Chakan, Pune', 'Plot No. A-1/4, Phase IV, MVML Vendor Park, Chakan, Pune', '60', 'Maharashtra', '27AABCT2865J1Z2', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AABCT2865J', '27', '                                                                                                                                                                                ', NULL, '27', 'Plot No. A-1/4, Phase IV, MVML Vendor Park, Chakan, Pune', 'Pune', '410501'),
(51, 'Treadfit Technologies Pvt Ltd', 'BSPC1051', 'Attic Space Symboisis 5th Floor, No-268, 100feet Road 7th Cross, Defeence Colony Indryaninagar Banglore, Ka-560058', 'Attic Space Symboisis 5th Floor, No-268, 100feet Road 7th Cross, Defeence Colony Indryaninagar Banglore, Ka-560058', '60', 'BANGALORE', '29AAHCT9172E1ZX', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAHCT9172E', '80', '                                                                                                                                                                                ', NULL, '80', 'Attic Space Symboisis 5th Floor, No-268, 100feet Road 7th Cross, Defeence Colony Indryaninagar Bangl', 'Banglore', '560058'),
(52, 'Triovision Composite Technologies Pvt Ltd', 'BSPC1052', 'Plot No-176 Kopparthy Mega Industrial Park, Ambevaram Kadapa -516293, Andra Pardesh India', 'Plot No-176 Kopparthy Mega Industrial Park, Ambevaram Kadapa -516293, Andra Pardesh India', '60', 'Andhra Pradesh', '37AAFCT4716N1ZV', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAFCT4716N', '37', '                                                                                                                                                                                ', NULL, '37', 'Plot No-176 Kopparthy Mega Industrial Park, Ambevaram Kadapa -516293, Andra Pardesh India', 'Ambevaram Kadapa', '516293'),
(53, 'Unique Pressing', 'BSPC1053', 'G18/1, Phase - III, MIDC, Chakan,, Pune- 410501.', 'G18/1, Phase - III, MIDC, Chakan,, Pune- 410501.', '60', 'Maharashtra', '27AABFU7887N1Z7', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AABFU7887N', '27', '', NULL, '27', 'G18/1, Phase - III, MIDC, Chakan,, Pune- 410501.', 'Pune', '410501'),
(54, 'Weimar India LLP', 'BSPC1054', '2,Bramha Nest,(Plot.11),New Rajstan Society ,, Mangalwadi,Off Sb Road,Pune-411016', '2,Bramha Nest,(Plot.11),New Rajstan Society ,, Mangalwadi,Off Sb Road,Pune-411016', '60', 'Maharashtra', '27AATFM0731D2ZC', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AATFM0731D', '27', '                                                                                                                                                                                ', NULL, '27', '2,Bramha Nest,(Plot.11),New Rajstan Society ,, Mangalwadi,Off Sb Road,Pune-411016', 'Pune', '411016'),
(55, 'Willams Controls India', 'BSPC1055', 'J1,S BLOCK MIDC BHOSARI, PUNE-410026', 'J1,S BLOCK MIDC BHOSARI, PUNE-410026', '60', 'Maharashtra', '27AAACW7655C1Z9', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AAACW7655C', '27', '                                                                                                                                                                                ', NULL, '27', 'J1,S BLOCK MIDC BHOSARI, PUNE-410026', 'Pune', '410026'),
(56, 'Yogesh Enterprises -Sales', 'BSPC1056', '17/1A,GANESH NAGAR, DHAWADEWASTI, BHOSARI, PUNE. 39', '17/1A,GANESH NAGAR, DHAWADEWASTI, BHOSARI, PUNE. 39', '60', 'Maharashtra', '27AROPG7293E1ZF', 3, '10/28/2021', '12:57:06', NULL, 0, '1', 'AROPG7293E', '27', '                                                                                                                                                                                ', NULL, '27', '17/1A,GANESH NAGAR, DHAWADEWASTI, BHOSARI, PUNE. 39', 'Pune', '411039'),
(57, 'SCRAP CUSTOMER', 'scrap customer1', 'Chinchwad', 'Chinchwad', '77', 'Maharashtra', 'A01234G', 3, '27-09-2022', '06:08:08', '0000-00-00 00:00:00', 0, 'NA', 'AIMPD2000', '27', '                                                                                                                                                                                ', NULL, '27', 'Chinchwad', 'Pune', '410506'),
(58, 'internal', 'inertnal1', 'inertnal1', 'inertnal1', '2', 'Maharashtra', '2', 3, '08-12-2022', '04:50:20', '0000-00-00 00:00:00', 0, '2', '2', '2', '                                                                                                                                                                                ', NULL, '2', 'inertnal1', 'Pune', '2'),
(59, 'YOGITA STAMPING', 'NA', 'EL-33, J BLOCK,OPPOSITE OERLIKON BALZERS,MIDC BHOSARI, PUNE-411026', 'EL-33, J BLOCK,OPPOSITE OERLIKON BALZERS,MIDC BHOSARI, PUNE-411026', '60', 'MAHARASHTRA', '27FOJPP5933M1Z4', 3, '31-01-2023', '12:30:08', '0000-00-00 00:00:00', 0, 'NA', 'FOJPP5933M1', '27', '                                                                                                                                                                                ', NULL, '27', 'EL-33, J BLOCK,OPPOSITE OERLIKON BALZERS,MIDC BHOSARI, PUNE-411026', 'Pune', '411026');

-- --------------------------------------------------------

--
-- Table structure for table `customer_part`
--

CREATE TABLE `customer_part` (
  `id` int(11) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(200) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `revision_date` varchar(50) DEFAULT NULL,
  `customer_part_id` int(11) DEFAULT NULL,
  `revision_no` varchar(255) DEFAULT NULL,
  `diagram` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `part_family` varchar(200) NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `revision_remark` varchar(100) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `uom` varchar(20) NOT NULL,
  `safety_stock` varchar(20) NOT NULL,
  `fg_stock` float NOT NULL,
  `gst_id` int(11) NOT NULL DEFAULT 1,
  `hold_stock` float DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `sharing_qty` float DEFAULT NULL,
  `gross_weight` float DEFAULT NULL,
  `finish_weight` float DEFAULT NULL,
  `runner_weight` float DEFAULT NULL,
  `cycyle_time` float DEFAULT NULL,
  `production_target_per_shift` float DEFAULT NULL,
  `rm_grade` text DEFAULT NULL,
  `molding_production_qty` int(11) NOT NULL DEFAULT 0,
  `production_rejection` float NOT NULL DEFAULT 0,
  `production_scrap` float NOT NULL DEFAULT 0,
  `semi_finished_location` float NOT NULL,
  `deflashing_assembly_location` float NOT NULL,
  `final_inspection_location` float NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'standard_po',
  `customer_parts_master_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_part`
--

INSERT INTO `customer_part` (`id`, `part_number`, `part_description`, `customer_id`, `revision_date`, `customer_part_id`, `revision_no`, `diagram`, `model`, `part_family`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `revision_remark`, `hsn_code`, `uom`, `safety_stock`, `fg_stock`, `gst_id`, `hold_stock`, `grade`, `sharing_qty`, `gross_weight`, `finish_weight`, `runner_weight`, `cycyle_time`, `production_target_per_shift`, `rm_grade`, `molding_production_qty`, `production_rejection`, `production_scrap`, `semi_finished_location`, `deflashing_assembly_location`, `final_inspection_location`, `type`, `customer_parts_master_id`) VALUES
(1, '365100162', 'Assy Bkt-Stiffener Roof-Winger', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(2, '363208288', 'REINF SIDE WALL RH-X104', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(3, '36B075749', 'WINDSHIELD PILLAR CONNECTION  BRACKET RH', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(4, '36B075750', 'WINDSHIELD PILLAR CONNECTION BRACKET LH', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(5, '365208208', 'BRACKET ROOF LAMP MTG', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(6, '363228214', 'RENIF JACKING POINT RR RH', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(7, '3632Q8246', 'BRACKET SEAT BACK MTG LH-Q501', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(8, '3632Q8247', 'BRACKET SEAT BACK MTG RH-Q501', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(9, '354128256', 'GUSSET ROOF BOW REAR RH-Q501', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(10, '354128257', 'GUSSET ROOF BOW REAR LH-Q501', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(11, '372208209', 'BRACKET SCUFF PLATE FRONT LH(RHD)', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84099990\r\n\r\n\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(12, '372208210', 'BRACKET SCUFF PLATE FRONT RH(LHD)', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84099990\r\n\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(13, 'D7TM-30108', 'REAR MTG. BKT. OB 60P', 2, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '300', 21, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(14, 'D7TM-30105(30114)', 'FRONT MTG. BKT. RIVETTED ASSEMBLY OB 60P', 2, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 81, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(15, 'D7TM-30648', 'BASE PLATE ASSLY. OB LATCH', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 26, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(16, 'D7TM-30693', 'HOLDER ASSLY. OB LATCH', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 85, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(17, 'D7TM-30381', 'OUTBOARD TUMBLE BKT. WITH NORGLIDE BUSH ASSY 40P', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 17, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(18, 'D7TM-30383', 'FRONT MTG. BKT. ASSLY. WITH SLEEVE OB 40P', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 13, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(19, 'D7TM-30647', 'BASE PLATE ASSLY. IB LATCH', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 11, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(20, 'D7TM-30373', 'TUMBLE BKT. WITH NORGLIDE BUSH ASSLY IB 40P', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(21, 'D7TM-30371', 'FRONT ASSLY BKT. ASSLY. WITH SLEEVE IB 40P(30370)', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 52, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(22, 'D7TM-30649', 'REAR IB MTG. BKT. WITH WASHER AND J HOOK WELDED ASSLY.', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 101, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(23, 'D8MS-26400', 'BACK SINGLE WELDED ASSEMBLY 60P H/M/B', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 371, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(24, 'D8MS-24630', 'BACK SINGLE WELDED ASSEMBLY 40P B/M/H/H-O', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 518, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(25, 'D7TM-30122(30120)', 'FRONT MTG BRACKET RIVETTED ASSY. IB 60P', 2, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 223, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(26, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', 2, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 122, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(27, 'D7TM-30420', 'TRACK SUPPORTING CROSS MEMBER ASSLY.', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 182, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(28, 'D7TM-30646', 'HOLDER ASSLY. IB LATCH', 2, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 135, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(29, 'D7TM-30840', 'TUMBLE SPRING WASHER', 2, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84099990', 'NOS', '700', 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(30, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', 2, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84099990', 'NOS', '700', 77, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(31, 'L0419321', 'BRACKET - FERROUS, BACK SIDE MEMBER LH', 3, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(32, 'L0419330', 'BRACKET - FERROUS, BACK SIDE MEMBER RH', 3, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(33, 'CR SHEET 0.8X105X205 D513 GRADE', 'CR SHEET 0.8X105X205 D513 GRADE', 5, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72092620\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(34, 'CR SHEET 1.0X178X320 MM D513 GRADE', 'CR SHEET 1.0X178X320 MM D513 GRADE', 5, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72082540', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(35, 'HR SHEET 2.5X82X1250 E34 GRADE', 'HR SHEET 2.5X82X1250 E34 GRADE', 5, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72092620\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(36, 'HR SHEET 2.5X172X1250 E34 GRADE', 'HR SHEET 2.5X172X1250 E34 GRADE', 5, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72092620\r\n', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(37, '5710103008', 'CYL MTG PLT-5710103008', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(38, '571LR04011', 'TAIL DOOR HINGE PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(39, '571LR04020', 'TAIL DOOR PLATE 2', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(40, '57GC98A397', 'LEVER ASSEMBLY BIG', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(41, '571CR04101', 'POS.1 OF DOUBLE HINGE ASSEMBLY', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87082900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(42, '73106130', 'SWITCH OFF PLATE USB 149', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(43, '73106150', 'SWITCH OFF PLATE UMB 191', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84879000', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(44, '73105015', 'UCB BRACKET PLATE D50', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(45, '73105020', 'UCB 077-093-110 CLOSING PLATE', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(46, '73105026', 'UCB CRADLE AND BRACKET 191 PLATE', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(47, '73105022', 'UCB CRADLE 129-149 CLOSING PLATE', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(48, '73105024', 'UMB CRADLE 169 PLATE', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(49, '73105050', 'BRACKET KNOCK OFF UCB', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(50, '1000530573', 'COVER PLATE WITH GASKET ASSY(DOMESTIC)', 17, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 825, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(51, 'W05161903463', 'PRESSING-EGP-BRACKET,MOUNTING-4X374X558-A062Z273', 20, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '998898', 'NOS', '0', 0, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(52, 'W05161903464', 'PRESSING-EGP-BRACKET,MOUNTING-4X374X558-A062Z274', 20, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '998898', 'NOS', '0', 246, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(54, '38254567', 'RING DEFLECTOR Y1K MT', 27, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87080000', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(55, '26113549', 'SLINGER, INTERMEDIATE SHAFT', 27, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(56, '26099921', 'SLINGER, INTERMEDIATE SHAFT', 27, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(57, '38254570', 'RING DEFLECTOR Y1K AMT', 27, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87080000', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(58, 'BSL002020815NCPAG', 'BRACKET FERROUS,RECLINER 3RS UPPER RH', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 641, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(59, 'BSL002020816NCPAG', 'BRACKET FERROUS RECLINER 3RS UPPER LH', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 4567, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(60, 'BSL002021471NCPAI', 'BRACKET FERROUS BACK RECLINER MOUNTING LOWER RH', 29, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 1502, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(61, 'BSL002021477NCPAI', 'BRACKET FERROUS BACK RECLINER MOUNTING LOWER LH', 29, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 2944, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(62, 'BSL002027942NCPAD', 'BRACKET FERROUS CABLE PLASTIC ATTACHMENT RH', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 200, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(63, 'BSL002055836NCPAA', 'FRM ARMRESET MTG BKT', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 160, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(64, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 9420, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(65, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 9225, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(66, 'BSL002049703NCPAC', 'STOPPER PLATE', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 11560, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(67, 'BSL002020814NCPAD', 'BRACKET FERROUS CABLE MOUNTING', 29, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '9401', 'NOS', '700', 4282, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(68, 'HR SHEET 2.0X37X1250 HSLA500 GRADE', 'HR SHEET 2.0X37X1250 HSLA500 GRADE', 43, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72082540', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(69, 'HR SHEET 2.0X60X1250 HSLA340 GRADE', 'HR SHEET 2.0X60X1250 HSLA340 GRADE', 43, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72092620', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(70, 'CR SHEET 1.5X125X1250 HC340 GRADE', 'CR SHEET 1.5X125X1250 HC340 GRADE', 43, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72092620', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(71, 'CM000452', 'SCS02429_12 TOP PLATE RH', 44, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 477, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(72, 'CM000303', 'ENG MTG BKT LH-S101_SCS04450A60', 44, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 23, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(73, 'CM000304', 'ENG MTG BKT RH-S101_SCS00440A20', 44, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 24, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(74, 'CM000451', 'SCS02429-11 BOTTOM PLATE RH', 44, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 178, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(75, 'CM000453', 'SCS02430_11 BOTTOM PLATE LH', 44, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(76, 'CM000454', 'SCS02430_12 TOP PLATE LH', 44, NULL, 2, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 564, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(77, '5226029-01', '5226029-01 BELT TENSIONER', 45, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(78, '5231166-02', '5231166-02 LEVER', 45, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(79, '5888896-01', '5888896-01 HOOK', 45, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(80, '5442621-01', '5442621-01 BRACKET', 45, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(81, '5045580-01', '5045580-01 LEVER', 45, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(82, '5228316-01', '5228316-01 BRACKET', 45, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(83, 'CBB004-BACK PLATE', 'BACK PLATE CLUTCH MTG BKT-CBB0004', 46, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 2262, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(84, 'CBS0004-BRACKET STOPPER', 'BRACKET STOPPER CLUTCH PEDAL', 46, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(85, 'CR SHEET 1.0X165X1250 D513 GRADE', 'CR SHEET 1.0X165X1250 D513 GRADE', 56, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '14-12-2021', '5:03:55', '2023-03-31 07:29:21', NULL, '', '72092620', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(86, '365103311', 'Nut Retainer-Winger My-16-28456510331', 1, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '15-12-2021', '1:32:42', '2023-03-31 07:29:21', NULL, '', '87081090', 'NOS', '700', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(87, '5712118001', 'HINGE PLT', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:28:55', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(88, '571GV00015', 'TAILDOOR STOPPER PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:31:40', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(89, '571GV04012', 'TAILDOOR HINGE PLATE OUTER', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:32:41', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(90, '571GV04201', 'DOUBLE HINGE SIDE PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:33:26', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(91, '57GC98D454', 'WA LEVER ASSY RC-08', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:41:20', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(92, '57GC982573', 'LEVER WELD BUSH', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:43:04', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(93, '57GC988059', 'LEVER PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:43:59', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(94, '5721704004', 'TAILDOOR HINGE PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:45:36', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(95, '571NN04005', 'TAILDOOR HINGE PLATE INNER', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:46:43', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(96, '571CR04111', 'STOPPER', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:47:25', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(97, '57GC989902', 'WASHER OD ????40, ID ????22, 2 THK', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:48:46', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(98, '57GC989859', 'WASHER OD ????45, ID ????27, 2 THK', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:49:27', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(99, '57GC989820', 'BODY LOCK PIN BOLTING PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:50:35', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(100, '57GC989608', '5-HOLE CLAMP SUPPORT', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:57:50', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(101, '57GC983797', 'WASHER', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:58:20', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(102, '57GC98E479', 'WA LEVR ASSY RC-08-RH', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '2:59:07', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(103, '57GC989832', 'LEVER PLATE', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '3:00:41', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(104, '57GC986852', 'LEVER BIG', 7, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '1/1/2022', '3:01:08', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(105, '73106120', 'SWITCH OFF PLATE UMB 129', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:10:35', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '20', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(106, '73106121', 'SWITCH OFF LEVER UMB 149', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:11:27', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(107, '73105123', 'BRACKET PN KNOCK OFF UMB 129', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:12:36', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(108, '73106141', 'SWITCH OFF LEVER UMB 169', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:14:45', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(109, '73106151', 'SWITCH OFF LEVER UMB 191', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:15:22', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(110, '73106140', 'SWITCH OFF PLATE UMB 169', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:17:44', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(111, '73105014', 'USB BRACKET PLAT D40', 6, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '11:19:59', '2023-03-31 07:29:21', NULL, '', '84312090', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(112, 'PS3065A-LH', 'Plate for Frame Left', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:47:36', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(113, 'PS3066A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:48:46', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(114, 'PS3067-LH', 'Plate for Frame Left', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:49:49', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(115, 'PS3098-LH', 'Plate for Frame right', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:50:28', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(116, 'PS3103-LH', 'Bended Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:50:54', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(117, 'PS3068-LH', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:51:23', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(118, 'PS3078A-LH', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:52:00', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(119, 'PS3077A-LH', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:52:26', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(120, 'PS3096A-LH', 'Bended Plate RH', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:53:02', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(121, 'PS3069-LH', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '12:54:00', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(122, 'PS3070-LH', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:44:25', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(123, 'PS3811-LH', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:45:08', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(124, 'PS3810-LH', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:45:37', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(125, 'PS2348-LH', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:47:59', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(126, 'PS3114A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:48:33', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(127, 'PS3116A-LH', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:49:01', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(128, 'PS3118A-LH', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:49:30', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(129, 'PS3119A-LH', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:50:02', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(130, 'PS3310A-LH', 'Frame Plate Left', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:50:42', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(131, 'PS3101B-LH', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:53:41', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(132, 'PS3108-LH', 'LH RIB', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:54:15', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(133, 'PS6176A-LH-1	', 'LH Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:54:43', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(134, 'PS3089B-LH', 'LH Bended Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:55:07', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(135, 'PS3091B-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:55:34', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(136, 'PS3092A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:55:58', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(137, 'PS3086A-LH-2', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:56:28', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(138, 'PS3093A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:57:00', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(139, 'PS3110A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:57:41', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(140, 'PS6176A-LH', 'LH Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:58:26', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(141, 'PS3085A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:58:53', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(142, 'PS3094A-LH', 'LH Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:59:18', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(143, 'PS3087A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '1:59:52', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(144, 'PS3086A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:00:23', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(145, 'PS3505-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:00:57', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(146, 'PS3111A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:01:22', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(147, 'PS3107A-LH', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:02:17', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(148, 'PS3076-LH', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:02:46', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(149, 'PS3073-LH', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:05:04', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(150, 'PS3079A', 'Plate for Frame Left', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:05:57', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(151, 'PS3066A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '2/1/2022', '2:06:34', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(152, 'PS3067	', 'Plate for Frame Left', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '2/1/2022', '2:14:24', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(153, 'PS3098	', 'Plate for Frame right', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:34:51', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(154, 'PS3103', 'Bended Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:35:31', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(155, 'PS3068', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:36:13', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(156, 'PS3078A', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:36:48', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(157, 'PS3077A', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Sheet Metal', 3, '3/1/2022', '9:38:39', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(158, 'PS3095A', 'Bended Plate RH', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:41:39', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(159, 'PS3069	', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:42:37', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(160, 'PS3070	', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:43:14', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(161, 'PS2348', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:44:43', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(162, 'PS3114A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:45:20', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(163, 'PS3117A', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:46:16', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(164, 'PS3118A', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '9:47:22', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(165, 'PS3120A', 'Bended Plate LH', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:18:47', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(166, 'PS3311A', 'Frame Plate Left', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:19:22', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(167, 'PS3101B', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:20:11', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(168, 'PS3109', 'LH RIB', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:20:56', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(169, 'PS6177A-1', 'LH Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:21:58', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(170, 'PS3090B', 'LH Bended Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:25:54', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(171, 'PS5530', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:34:24', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(172, 'PS3092A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:36:02', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(173, 'PS3086A-1', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:36:55', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(174, 'PS3093A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:37:26', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(175, 'PS3110A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:38:06', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(176, 'PS6177A', 'LH Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:38:36', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(177, 'PS3112A', 'LH Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:46:50', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(178, 'PS3087A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:47:22', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(179, 'PS3086A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:58:54', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(180, 'PS3505	', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '10:59:35', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(181, 'PS3111A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:00:05', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0);
INSERT INTO `customer_part` (`id`, `part_number`, `part_description`, `customer_id`, `revision_date`, `customer_part_id`, `revision_no`, `diagram`, `model`, `part_family`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `revision_remark`, `hsn_code`, `uom`, `safety_stock`, `fg_stock`, `gst_id`, `hold_stock`, `grade`, `sharing_qty`, `gross_weight`, `finish_weight`, `runner_weight`, `cycyle_time`, `production_target_per_shift`, `rm_grade`, `molding_production_qty`, `production_rejection`, `production_scrap`, `semi_finished_location`, `deflashing_assembly_location`, `final_inspection_location`, `type`, `customer_parts_master_id`) VALUES
(182, 'PS3107A', 'Plate For Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:01:01', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(183, 'LH1107', 'Hexagon Head Cap Screw M8 * 15', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:02:33', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(184, 'PS423', 'Plate for Frame', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:03:02', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(185, 'PS3304A-1', 'SQ.BAR - 40 X 35- 380 MM', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:03:42', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(186, 'PS3305A-1', 'SQ.BAR - 40 X 35- 380 MM', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:04:18', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(187, 'PS3306A-1', 'SQ.BAR - 40 X 35- 210 MM', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:04:50', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(188, 'PS3076-1', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:10:14', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(189, 'PS3073-1', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:11:17', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(190, 'PS4811', 'Plate From Frame Left', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:14:23', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(191, 'PS4820', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:17:01', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(192, 'PS4818', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:17:35', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(193, 'PS4817', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:18:19', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(194, 'PS4819', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:18:49', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(195, 'PS4821', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:19:51', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(196, 'PS4815', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:20:38', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(197, 'PS4814', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '11:21:54', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(198, 'PS4813	', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:43:06', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(199, 'PS4823', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:43:37', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(200, 'PS4825', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:44:14', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(201, 'PS4824', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:44:55', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(202, 'PS4816	', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:45:30', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(203, 'LK652', 'M 8 NUT', 33, NULL, 1, NULL, NULL, NULL, 'Other', 3, '3/1/2022', '12:46:20', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(204, 'PS4803', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:46:52', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(205, 'PS4802', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:49:19', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(206, 'PS4805', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:50:08', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(207, 'PS4826', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:50:41', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(208, 'PS4807', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:52:10', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(209, 'PS4809', 'Plate', 33, NULL, 1, NULL, NULL, NULL, 'Laser Cutting', 3, '3/1/2022', '12:56:33', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '10', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(211, 'CM000096', 'U301_OUTER COVER ASSY LHS', 44, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '24-07-2022', '11:08:27', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 1674, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(212, ' PACKAGEING BOX', 'COROGATED PACKAGEING BOX FOR COVER PLATE DISPATCH', 17, NULL, NULL, NULL, NULL, NULL, 'Bracket', 3, '24-07-2022', '3:15:16', '2023-03-31 07:29:21', NULL, '', '4819', 'NOS', '1', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(213, '84B542471P1', 'SHIM', 33, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '25-07-2022', '11:51:34', '2023-03-31 07:29:21', NULL, '', '86079100', 'NOS', '5', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(214, 'MS SCRAP - CR ', 'MS SCRAP- CR RAW MATERIAL SHEET', 11, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '27-07-2022', '11:19:38', '2023-03-31 07:33:15', NULL, '', '72043000', 'KGS', '0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(215, 'scrap1', 'scrap', 57, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '27-09-2022', '6:09:40', '2023-03-31 07:33:15', NULL, '', 'HSN01', 'KGS', '1', 0, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(217, 'D6MS-50113', 'Back Side Member OB RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '6/11/2022', '5:08:33', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 9199, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(218, 'D6MS-50115', 'Back Side Member IB RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '6/11/2022', '5:09:13', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '700', 183, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(219, 'D5MS-40129', 'Recliner Stopper Bracket RH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '6/11/2022', '5:09:56', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 2765, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(221, 'B03160201099', 'BRACKET MOUNTING-A061Y103(A063K880)', 20, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '30-11-2022', '2:51:45', '2023-03-31 07:29:21', NULL, '', '84314930', 'NOS', '100', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(222, 'B03160201098', 'BRACKET MOUNTING-A061K571', 20, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '30-11-2022', '2:53:20', '2023-03-31 07:29:21', NULL, '', '84314930', 'NOS', '100', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(223, 'B03160201097', 'BRACKET MOUNTING-A063K893', 20, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '30-11-2022', '2:54:32', '2023-03-31 07:29:21', NULL, '', '84314930', 'NOS', '0', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(224, '1000699234', 'Shifter Mounting Plate ', 17, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '30-11-2022', '3:12:42', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '0', 15999, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(225, '235766', 'ANGLE-L BRACKET', 17, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '30-11-2022', '3:15:36', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '0', 0, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(226, '544563608237', 'PANEL TAIL GATE', 21, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '30-11-2022', '3:18:33', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '0', 1529, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(227, 'D9MS-20970', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT IB RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '2/12/2022', '6:43:26', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 587, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(228, 'D9MS-20971', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT OB RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '2/12/2022', '6:46:49', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 300, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(229, 'D9MS-20972', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT IB RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '2/12/2022', '6:51:23', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 50, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(230, 'D9MS-20973', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT OB LHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '2/12/2022', '6:52:06', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '0', 440, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(231, 'production_rejection', 'production_rejection', 58, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '8/12/2022', '4:52:55', '2023-03-31 07:33:25', NULL, '', '2', 'SET', '2', 0, 11, NULL, NULL, NULL, 2, 2, 2, 2, 2, '2', 0, 0.812, 0, 0, 0, 0, 'standard_po', 0),
(232, 'production_scrap', 'production_scrap', 58, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '8/12/2022', '4:55:22', '2023-03-31 07:33:25', NULL, '', 'production_scrap', 'SET', '2', 0, 11, NULL, NULL, NULL, 2, 2, 2, 2, 2, '2', 0, 0, 73008, 0, 0, 0, 'standard_po', 0),
(233, 'D6MS-50112', 'DRIVER BACK OB SIDE MEMBERWITH REC STOP ASSY RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '11/12/2022', '1:52:31', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(234, 'D6MS-50120', 'CO DRIVER BACK OB SIDE MEMBERWITH ASSY RHD', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '11/12/2022', '1:53:38', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(235, 'CBB0004OP05', 'SHEARING E34-2X155X1250MM', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '25-12-2022', '11:11:14', '2023-03-31 07:33:15', NULL, '', '72082730', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'E34', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(236, 'CBS0004OP05', 'SHEARING E34-3X125X1250MM', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '25-12-2022', '11:16:47', '2023-03-31 07:33:15', NULL, '', '72082730', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'E34', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(237, '234844OP05', 'SHEARING D513-1X178X310MM', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '25-12-2022', '11:19:32', '2023-03-31 07:33:15', NULL, '', '72082730', 'KGS', '2000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'D513', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(238, '88923-T1N00', 'T1N CUSHION PAN', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '17-01-2023', '02:39:17', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 461, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(239, '87680-T1N00', 'BACK SIDE BRKT ASSLY OUTER RH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '18-01-2023', '03:01:32', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(240, '87652-T1N00', 'SIDE BRKT. RIVET WELDED ASSLY INR RH ', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '18-01-2023', '03:02:22', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(241, '87580-T1N00', 'BACK SIDE BRKT ASSLY OUTER LH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '18-01-2023', '03:03:08', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(242, '87752-T1N00', 'SIDE BRKT. RIVET WELDED ASSLY INR LH ', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '18-01-2023', '03:03:47', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '100', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(243, '87651-T1N00', 'BACK SIDE BRKT, RH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '20-01-2023', '01:49:00', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '500', 50, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(244, '87551-T1N00', 'BACK SIDE BRKT, LH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '20-01-2023', '01:49:43', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '500', 50, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(245, 'SCS004450A18OP05', 'SHEARING E34-1.6X52X1250MM', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '11:36:21', '2023-03-31 07:33:15', NULL, '', '72083890', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(246, 'D7TM30546OP05', 'SHEARING E34-2.5X150X1250', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '11:38:28', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '500', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(247, 'D7TM30545OP05', 'SHEARING E34-2.5X170X1250', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '11:39:16', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '500', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(248, 'D7TM30542/109OP05', 'SHEARING E34-2.5X136X1250 ', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '11:41:56', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '0', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(249, 'BSL002027942OP05', 'SHEARING HSLA340-2X55X1250MM', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '11:46:50', '2023-03-31 07:33:15', NULL, '', '9401', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(250, 'D9MS20879OP05', 'SHEARING E34-1.6X46X1250 MM ', 5, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '11:47:57', '2023-03-31 07:33:15', NULL, '', '72092620', 'KGS', '500', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(251, 'SBT00800B42OP05', 'SHEARING E34-4.0X143X1250MM', 43, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:04:40', '2023-03-31 07:33:15', NULL, '', '72082540', 'KGS', '3000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(252, 'D7TM30234OP05', 'SHEARING E34-2X85X1250 MM', 43, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:05:35', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(253, 'D7TM30884OP05', 'SHEARING E34-3X70X1250', 43, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:06:26', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(254, 'BSL002230976_1007_OP05', 'SHEARING HC340-1.5X125X1250MM', 43, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:07:18', '2023-03-31 07:33:15', NULL, '', '9401', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(255, 'BSL002020814OP05', 'SHEARING HSLA500-2X37X1250MM', 43, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:08:08', '2023-03-31 07:33:15', NULL, '', '9401', 'KGS', '200', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(256, 'BSL002049703OP05', 'SHEARING HSLA500-3X50X1250MM', 43, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:08:51', '2023-03-31 07:33:15', NULL, '', '9401', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(257, 'BSL002020815OP10', 'BRACKET FERROUS,RECLINER 3RS UPPER RH_BLANK', 59, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:31:50', '2023-03-31 07:33:15', NULL, '', '9401', 'KGS', '3000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(258, 'D7TM30114OP05', 'SHEARING E34-2.5X159X1250', 59, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:48:30', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '500', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(259, 'SCS02429_30OP05', 'SHEARING FE410-6.0X178X1250MM', 59, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:49:20', '2023-03-31 07:33:15', NULL, '', '72082540', 'KGS', '3000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(260, 'D7TM89831OP05', 'SHEARING SPFFH590-2.6X177X1250', 13, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:53:14', '2023-03-31 07:33:15', NULL, '', '72082730', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(261, 'D7TM89821OP05', 'SHEARING SPFFH590-2.6X179X1250', 13, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:54:08', '2023-03-31 07:33:15', NULL, '', '72082730', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(262, 'D7TM89731OP05', 'SHEARING SPFFH59-2.6X161X1250', 13, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:55:12', '2023-03-31 07:33:15', NULL, '', '72082730', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(263, 'D7TM30120OP05', 'SHEARING E34-2.5X100X1250', 30, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '12:58:39', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(264, 'D8MS24403OP05', 'SHEARING E34-2.0X68X1250 MM', 28, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '01:01:17', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(265, 'D7TM30481OP05', 'SHEARING E34-2.5X108X1250', 28, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '01:01:57', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(266, 'D7TM30367OP05', 'SHEARING E34-3X407X1250', 39, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '01:06:02', '2023-03-31 07:33:15', NULL, '', '72091620', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(267, 'BSL002055836OP05', 'SHEARING HSLA500-3X324X1250MM', 39, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '31-01-2023', '01:06:50', '2023-03-31 07:33:15', NULL, '', '9401', 'KGS', '5000', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(268, '88336-T1N00', 'PLATE BASE MNL LH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '06-02-2023', '02:34:42', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(269, '88436-T1N00', 'PLATE BASE MNL RH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '06-02-2023', '02:36:36', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(270, 'D8MS-24631', 'BACK PANEL 40P', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '12-02-2023', '08:22:13', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 1620, 3, NULL, NULL, NULL, 1.71, 0.9, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(271, 'D8MS-24401', 'BACK PANEL 60P', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '12-02-2023', '08:23:27', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 4439, 3, NULL, NULL, NULL, 2.41, 1.45, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(272, 'D8MS-24402', 'TOP TETHER WELDED ASSLY.', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '12-02-2023', '08:24:30', '2023-03-31 07:29:21', NULL, '', '87', 'NOS', '2000', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(273, '87870-T1N00', 'Recliner Spring Stopper Bracket', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '13-02-2023', '12:26:32', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '200', 570, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(274, '88375-T1N00', 'PLATE BASE WELDED ASSY. LH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '02-03-2023', '06:34:11', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '300', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(275, '88475-T1N00', 'PLATE BASE WELDED ASSY. RH	88475-T1N00 	 	', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '02-03-2023', '06:34:47', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '300', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(276, '88675-T1N00', 'PLATE BASE M6 WELD NUTHA ASSY. RH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '02-03-2023', '06:35:26', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '300', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(277, '88575-T1N00', 'PLATE BASE M6 WELD NUTHA ASSY. LH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '02-03-2023', '06:36:46', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '300', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(278, '88280-T1N00', 'PLATE BASE WITH LINK SUB ASSY. NORM. RH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '02-03-2023', '06:37:20', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '300', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(279, '88180-T1N00', 'PLATE BASE WITH LINK SUB ASSY. NORM. LH', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '02-03-2023', '06:37:51', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '0', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 0),
(280, 'CM000117', 'U301_OUTER COVER ASSY RHS', 44, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '10-03-2023', '05:25:16', '2023-03-31 07:29:21', NULL, '', '87089900', 'NOS', '1000', 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 280),
(281, 'PACKAGEING BOX', 'COROGATED PACKAGEING BOX-SMALL', 17, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '15-03-2023', '03:06:21', '2023-03-31 07:29:21', NULL, '', '4819', 'NOS', '50', 0, 2, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 281),
(282, 'D6MS-52123', 'LUGGAGE RETENTION SUPPORT TUBE', 2, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '15-03-2023', '03:22:20', '2023-03-31 07:29:21', NULL, '', '998898', 'NOS', '300', 0, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 'standard_po', 282),
(283, 'SBT000050141OP10', 'UPPER LIMIT_BLANKING', 39, NULL, NULL, NULL, NULL, NULL, 'Sheet Metal', 3, '17-03-2023', '06:57:37', '2023-03-31 07:33:15', NULL, '', '72082540', 'KGS', '1000', 0, 1, NULL, NULL, NULL, 0.53, 0.47, 0, 0, 0, 'E34', 0, 0, 0, 0, 0, 0, 'standard_po', 283);

-- --------------------------------------------------------

--
-- Table structure for table `customer_parts_master`
--

CREATE TABLE `customer_parts_master` (
  `id` int(11) NOT NULL,
  `part_number` varchar(200) NOT NULL,
  `part_description` text NOT NULL,
  `fg_stock` float NOT NULL DEFAULT 0,
  `molding_production_qty` float NOT NULL DEFAULT 0,
  `production_rejection` float NOT NULL DEFAULT 0,
  `production_scrap` float NOT NULL DEFAULT 0,
  `semi_finished_location` float NOT NULL DEFAULT 0,
  `deflashing_assembly_location` float NOT NULL DEFAULT 0,
  `final_inspection_location` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_parts_master`
--

INSERT INTO `customer_parts_master` (`id`, `part_number`, `part_description`, `fg_stock`, `molding_production_qty`, `production_rejection`, `production_scrap`, `semi_finished_location`, `deflashing_assembly_location`, `final_inspection_location`) VALUES
(1, '365100162', 'Assy Bkt-Stiffener Roof-Winger', 0, 0, 0, 0, 0, 0, 0),
(2, '363208288', 'REINF SIDE WALL RH-X104', 0, 0, 0, 0, 0, 0, 0),
(3, '36B075749', 'WINDSHIELD PILLAR CONNECTION  BRACKET RH', 0, 0, 0, 0, 0, 0, 0),
(4, '36B075750', 'WINDSHIELD PILLAR CONNECTION BRACKET LH', 0, 0, 0, 0, 0, 0, 0),
(5, '365208208', 'BRACKET ROOF LAMP MTG', 0, 0, 0, 0, 0, 0, 0),
(6, '363228214', 'RENIF JACKING POINT RR RH', 0, 0, 0, 0, 0, 0, 0),
(7, '3632Q8246', 'BRACKET SEAT BACK MTG LH-Q501', 0, 0, 0, 0, 0, 0, 0),
(8, '3632Q8247', 'BRACKET SEAT BACK MTG RH-Q501', 0, 0, 0, 0, 0, 0, 0),
(9, '354128256', 'GUSSET ROOF BOW REAR RH-Q501', 0, 0, 0, 0, 0, 0, 0),
(10, '354128257', 'GUSSET ROOF BOW REAR LH-Q501', 0, 0, 0, 0, 0, 0, 0),
(11, '372208209', 'BRACKET SCUFF PLATE FRONT LH(RHD)', 0, 0, 0, 0, 0, 0, 0),
(12, '372208210', 'BRACKET SCUFF PLATE FRONT RH(LHD)', 0, 0, 0, 0, 0, 0, 0),
(13, 'D7TM-30108', 'REAR MTG. BKT. OB 60P', 651, 0, 0, 0, 0, 0, 0),
(14, 'D7TM-30105(30114)', 'FRONT MTG. BKT. RIVETTED ASSEMBLY OB 60P', 81, 0, 0, 0, 0, 0, 0),
(15, 'D7TM-30648', 'BASE PLATE ASSLY. OB LATCH', 304, 0, 0, 0, 0, 0, 0),
(16, 'D7TM-30693', 'HOLDER ASSLY. OB LATCH', 474, 0, 0, 0, 0, 0, 0),
(17, 'D7TM-30381', 'OUTBOARD TUMBLE BKT. WITH NORGLIDE BUSH ASSY 40P', 234, 0, 0, 0, 0, 0, 0),
(18, 'D7TM-30383', 'FRONT MTG. BKT. ASSLY. WITH SLEEVE OB 40P', 1725, 0, 0, 0, 0, 0, 0),
(19, 'D7TM-30647', 'BASE PLATE ASSLY. IB LATCH', 490, 0, 0, 0, 0, 0, 0),
(20, 'D7TM-30373', 'TUMBLE BKT. WITH NORGLIDE BUSH ASSLY IB 40P', 44, 0, 0, 0, 0, 0, 0),
(21, 'D7TM-30371', 'FRONT ASSLY BKT. ASSLY. WITH SLEEVE IB 40P(30370)', 186, 0, 0, 0, 0, 0, 0),
(22, 'D7TM-30649', 'REAR IB MTG. BKT. WITH WASHER AND J HOOK WELDED ASSLY.', 195, 0, 0, 0, 0, 0, 0),
(23, 'D8MS-26400', 'BACK SINGLE WELDED ASSEMBLY 60P H/M/B', 2618, 0, 0, 0, 0, 0, 0),
(24, 'D8MS-24630', 'BACK SINGLE WELDED ASSEMBLY 40P B/M/H/H-O', 2866, 0, 0, 0, 0, 0, 0),
(25, 'D7TM-30122(30120)', 'FRONT MTG BRACKET RIVETTED ASSY. IB 60P', 101, 0, 0, 0, 0, 0, 0),
(26, 'D7TM-30542', 'TRACK STOPPER BRACKET OB REAR', 478, 0, 0, 0, 0, 0, 0),
(27, 'D7TM-30420', 'TRACK SUPPORTING CROSS MEMBER ASSLY.', 440, 0, 0, 0, 0, 0, 0),
(28, 'D7TM-30646', 'HOLDER ASSLY. IB LATCH', 35, 0, 0, 0, 0, 0, 0),
(29, 'D7TM-30840', 'TUMBLE SPRING WASHER', 0, 0, 0, 0, 0, 0, 0),
(30, 'D7TM-30109', 'TRACK STOPPER BRACKET LOWER OB 60P', 881, 0, 0, 0, 0, 0, 0),
(31, 'L0419321', 'BRACKET - FERROUS, BACK SIDE MEMBER LH', 0, 0, 0, 0, 0, 0, 0),
(32, 'L0419330', 'BRACKET - FERROUS, BACK SIDE MEMBER RH', 0, 0, 0, 0, 0, 0, 0),
(33, 'CR SHEET 0.8X105X205 D513 GRADE', 'CR SHEET 0.8X105X205 D513 GRADE', 0, 0, 0, 0, 0, 0, 0),
(34, 'CR SHEET 1.0X178X320 MM D513 GRADE', 'CR SHEET 1.0X178X320 MM D513 GRADE', 0, 0, 0, 0, 0, 0, 0),
(35, 'HR SHEET 2.5X82X1250 E34 GRADE', 'HR SHEET 2.5X82X1250 E34 GRADE', 0, 0, 0, 0, 0, 0, 0),
(36, 'HR SHEET 2.5X172X1250 E34 GRADE', 'HR SHEET 2.5X172X1250 E34 GRADE', 0, 0, 0, 0, 0, 0, 0),
(37, '5710103008', 'CYL MTG PLT-5710103008', 0, 0, 0, 0, 0, 0, 0),
(38, '571LR04011', 'TAIL DOOR HINGE PLATE', 0, 0, 0, 0, 0, 0, 0),
(39, '571LR04020', 'TAIL DOOR PLATE 2', 0, 0, 0, 0, 0, 0, 0),
(40, '57GC98A397', 'LEVER ASSEMBLY BIG', 0, 0, 0, 0, 0, 0, 0),
(41, '571CR04101', 'POS.1 OF DOUBLE HINGE ASSEMBLY', 0, 0, 0, 0, 0, 0, 0),
(42, '73106130', 'SWITCH OFF PLATE USB 149', 0, 0, 0, 0, 0, 0, 0),
(43, '73106150', 'SWITCH OFF PLATE UMB 191', 0, 0, 0, 0, 0, 0, 0),
(44, '73105015', 'UCB BRACKET PLATE D50', 0, 0, 0, 0, 0, 0, 0),
(45, '73105020', 'UCB 077-093-110 CLOSING PLATE', 0, 0, 0, 0, 0, 0, 0),
(46, '73105026', 'UCB CRADLE AND BRACKET 191 PLATE', 0, 0, 0, 0, 0, 0, 0),
(47, '73105022', 'UCB CRADLE 129-149 CLOSING PLATE', 0, 0, 0, 0, 0, 0, 0),
(48, '73105024', 'UMB CRADLE 169 PLATE', 0, 0, 0, 0, 0, 0, 0),
(49, '73105050', 'BRACKET KNOCK OFF UCB', 0, 0, 0, 0, 0, 0, 0),
(50, '1000530573', 'COVER PLATE WITH GASKET ASSY(DOMESTIC)', 4980, 0, 0, 0, 0, 0, 0),
(51, 'W05161903463', 'PRESSING-EGP-BRACKET,MOUNTING-4X374X558-A062Z273', 0, 0, 0, 0, 0, 0, 0),
(52, 'W05161903464', 'PRESSING-EGP-BRACKET,MOUNTING-4X374X558-A062Z274', 246, 0, 0, 0, 0, 0, 0),
(54, '38254567', 'RING DEFLECTOR Y1K MT', 0, 0, 0, 0, 0, 0, 0),
(55, '26113549', 'SLINGER, INTERMEDIATE SHAFT', 0, 0, 0, 0, 0, 0, 0),
(56, '26099921', 'SLINGER, INTERMEDIATE SHAFT', 0, 0, 0, 0, 0, 0, 0),
(57, '38254570', 'RING DEFLECTOR Y1K AMT', 0, 0, 0, 0, 0, 0, 0),
(58, 'BSL002020815NCPAG', 'BRACKET FERROUS,RECLINER 3RS UPPER RH', 19153, 0, 0, 0, 0, 0, 0),
(59, 'BSL002020816NCPAG', 'BRACKET FERROUS RECLINER 3RS UPPER LH', 1627, 0, 0, 0, 0, 0, 0),
(60, 'BSL002021471NCPAI', 'BRACKET FERROUS BACK RECLINER MOUNTING LOWER RH', 5768, 0, 0, 0, 0, 0, 0),
(61, 'BSL002021477NCPAI', 'BRACKET FERROUS BACK RECLINER MOUNTING LOWER LH', 5556, 0, 0, 0, 0, 0, 0),
(62, 'BSL002027942NCPAD', 'BRACKET FERROUS CABLE PLASTIC ATTACHMENT RH', 29200, 0, 0, 0, 0, 0, 0),
(63, 'BSL002055836NCPAA', 'FRM ARMRESET MTG BKT', 977, 0, 0, 0, 0, 0, 0),
(64, 'BSL002230976NCPAA', 'IR LONG VALANCE BKT LH SK216 RH', 5717, 0, 0, 0, 0, 0, 0),
(65, 'BSL002231007NCPAA', 'LONG VALANCE BKT RHSK216 LH', 5522, 0, 0, 0, 0, 0, 0),
(66, 'BSL002049703NCPAC', 'STOPPER PLATE', 3060, 0, 0, 0, 0, 0, 0),
(67, 'BSL002020814NCPAD', 'BRACKET FERROUS CABLE MOUNTING', 718, 0, 0, 0, 0, 0, 0),
(68, 'HR SHEET 2.0X37X1250 HSLA500 GRADE', 'HR SHEET 2.0X37X1250 HSLA500 GRADE', 0, 0, 0, 0, 0, 0, 0),
(69, 'HR SHEET 2.0X60X1250 HSLA340 GRADE', 'HR SHEET 2.0X60X1250 HSLA340 GRADE', 0, 0, 0, 0, 0, 0, 0),
(70, 'CR SHEET 1.5X125X1250 HC340 GRADE', 'CR SHEET 1.5X125X1250 HC340 GRADE', 0, 0, 0, 0, 0, 0, 0),
(71, 'CM000452', 'SCS02429_12 TOP PLATE RH', 162, 0, 0, 0, 0, 0, 0),
(72, 'CM000303', 'ENG MTG BKT LH-S101_SCS04450A60', 63, 0, 0, 0, 0, 0, 0),
(73, 'CM000304', 'ENG MTG BKT RH-S101_SCS00440A20', 14, 0, 0, 0, 0, 0, 0),
(74, 'CM000451', 'SCS02429-11 BOTTOM PLATE RH', 3352, 0, 0, 0, 0, 0, 0),
(75, 'CM000453', 'SCS02430_11 BOTTOM PLATE LH', 2867, 0, 0, 0, 0, 0, 0),
(76, 'CM000454', 'SCS02430_12 TOP PLATE LH', 281, 0, 0, 0, 0, 0, 0),
(77, '5226029-01', '5226029-01 BELT TENSIONER', 0, 0, 0, 0, 0, 0, 0),
(78, '5231166-02', '5231166-02 LEVER', 0, 0, 0, 0, 0, 0, 0),
(79, '5888896-01', '5888896-01 HOOK', 0, 0, 0, 0, 0, 0, 0),
(80, '5442621-01', '5442621-01 BRACKET', 0, 0, 0, 0, 0, 0, 0),
(81, '5045580-01', '5045580-01 LEVER', 0, 0, 0, 0, 0, 0, 0),
(82, '5228316-01', '5228316-01 BRACKET', 0, 0, 0, 0, 0, 0, 0),
(83, 'CBB004-BACK PLATE', 'BACK PLATE CLUTCH MTG BKT-CBB0004', 2262, 0, 0, 0, 0, 0, 0),
(84, 'CBS0004-BRACKET STOPPER', 'BRACKET STOPPER CLUTCH PEDAL', 0, 0, 0, 0, 0, 0, 0),
(85, 'CR SHEET 1.0X165X1250 D513 GRADE', 'CR SHEET 1.0X165X1250 D513 GRADE', 0, 0, 0, 0, 0, 0, 0),
(86, '365103311', 'Nut Retainer-Winger My-16-28456510331', 0, 0, 0, 0, 0, 0, 0),
(87, '5712118001', 'HINGE PLT', 0, 0, 0, 0, 0, 0, 0),
(88, '571GV00015', 'TAILDOOR STOPPER PLATE', 0, 0, 0, 0, 0, 0, 0),
(89, '571GV04012', 'TAILDOOR HINGE PLATE OUTER', 0, 0, 0, 0, 0, 0, 0),
(90, '571GV04201', 'DOUBLE HINGE SIDE PLATE', 0, 0, 0, 0, 0, 0, 0),
(91, '57GC98D454', 'WA LEVER ASSY RC-08', 0, 0, 0, 0, 0, 0, 0),
(92, '57GC982573', 'LEVER WELD BUSH', 0, 0, 0, 0, 0, 0, 0),
(93, '57GC988059', 'LEVER PLATE', 0, 0, 0, 0, 0, 0, 0),
(94, '5721704004', 'TAILDOOR HINGE PLATE', 0, 0, 0, 0, 0, 0, 0),
(95, '571NN04005', 'TAILDOOR HINGE PLATE INNER', 0, 0, 0, 0, 0, 0, 0),
(96, '571CR04111', 'STOPPER', 0, 0, 0, 0, 0, 0, 0),
(97, '57GC989902', 'WASHER OD ????40, ID ????22, 2 THK', 0, 0, 0, 0, 0, 0, 0),
(98, '57GC989859', 'WASHER OD ????45, ID ????27, 2 THK', 0, 0, 0, 0, 0, 0, 0),
(99, '57GC989820', 'BODY LOCK PIN BOLTING PLATE', 0, 0, 0, 0, 0, 0, 0),
(100, '57GC989608', '5-HOLE CLAMP SUPPORT', 0, 0, 0, 0, 0, 0, 0),
(101, '57GC983797', 'WASHER', 0, 0, 0, 0, 0, 0, 0),
(102, '57GC98E479', 'WA LEVR ASSY RC-08-RH', 0, 0, 0, 0, 0, 0, 0),
(103, '57GC989832', 'LEVER PLATE', 0, 0, 0, 0, 0, 0, 0),
(104, '57GC986852', 'LEVER BIG', 0, 0, 0, 0, 0, 0, 0),
(105, '73106120', 'SWITCH OFF PLATE UMB 129', 0, 0, 0, 0, 0, 0, 0),
(106, '73106121', 'SWITCH OFF LEVER UMB 149', 0, 0, 0, 0, 0, 0, 0),
(107, '73105123', 'BRACKET PN KNOCK OFF UMB 129', 0, 0, 0, 0, 0, 0, 0),
(108, '73106141', 'SWITCH OFF LEVER UMB 169', 0, 0, 0, 0, 0, 0, 0),
(109, '73106151', 'SWITCH OFF LEVER UMB 191', 0, 0, 0, 0, 0, 0, 0),
(110, '73106140', 'SWITCH OFF PLATE UMB 169', 0, 0, 0, 0, 0, 0, 0),
(111, '73105014', 'USB BRACKET PLAT D40', 0, 0, 0, 0, 0, 0, 0),
(112, 'PS3065A-LH', 'Plate for Frame Left', 0, 0, 0, 0, 0, 0, 0),
(113, 'PS3066A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(114, 'PS3067-LH', 'Plate for Frame Left', 0, 0, 0, 0, 0, 0, 0),
(115, 'PS3098-LH', 'Plate for Frame right', 0, 0, 0, 0, 0, 0, 0),
(116, 'PS3103-LH', 'Bended Plate', 0, 0, 0, 0, 0, 0, 0),
(117, 'PS3068-LH', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(118, 'PS3078A-LH', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(119, 'PS3077A-LH', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(120, 'PS3096A-LH', 'Bended Plate RH', 0, 0, 0, 0, 0, 0, 0),
(121, 'PS3069-LH', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(122, 'PS3070-LH', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(123, 'PS3811-LH', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(124, 'PS3810-LH', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(125, 'PS2348-LH', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(126, 'PS3114A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(127, 'PS3116A-LH', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(128, 'PS3118A-LH', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(129, 'PS3119A-LH', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(130, 'PS3310A-LH', 'Frame Plate Left', 0, 0, 0, 0, 0, 0, 0),
(131, 'PS3101B-LH', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(132, 'PS3108-LH', 'LH RIB', 0, 0, 0, 0, 0, 0, 0),
(133, 'PS6176A-LH-1	', 'LH Plate', 0, 0, 0, 0, 0, 0, 0),
(134, 'PS3089B-LH', 'LH Bended Plate', 0, 0, 0, 0, 0, 0, 0),
(135, 'PS3091B-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(136, 'PS3092A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(137, 'PS3086A-LH-2', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(138, 'PS3093A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(139, 'PS3110A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(140, 'PS6176A-LH', 'LH Plate', 0, 0, 0, 0, 0, 0, 0),
(141, 'PS3085A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(142, 'PS3094A-LH', 'LH Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(143, 'PS3087A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(144, 'PS3086A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(145, 'PS3505-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(146, 'PS3111A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(147, 'PS3107A-LH', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(148, 'PS3076-LH', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(149, 'PS3073-LH', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(150, 'PS3079A', 'Plate for Frame Left', 0, 0, 0, 0, 0, 0, 0),
(151, 'PS3066A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(152, 'PS3067	', 'Plate for Frame Left', 0, 0, 0, 0, 0, 0, 0),
(153, 'PS3098	', 'Plate for Frame right', 0, 0, 0, 0, 0, 0, 0),
(154, 'PS3103', 'Bended Plate', 0, 0, 0, 0, 0, 0, 0),
(155, 'PS3068', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(156, 'PS3078A', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(157, 'PS3077A', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(158, 'PS3095A', 'Bended Plate RH', 0, 0, 0, 0, 0, 0, 0),
(159, 'PS3069	', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(160, 'PS3070	', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(161, 'PS2348', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(162, 'PS3114A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(163, 'PS3117A', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(164, 'PS3118A', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(165, 'PS3120A', 'Bended Plate LH', 0, 0, 0, 0, 0, 0, 0),
(166, 'PS3311A', 'Frame Plate Left', 0, 0, 0, 0, 0, 0, 0),
(167, 'PS3101B', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(168, 'PS3109', 'LH RIB', 0, 0, 0, 0, 0, 0, 0),
(169, 'PS6177A-1', 'LH Plate', 0, 0, 0, 0, 0, 0, 0),
(170, 'PS3090B', 'LH Bended Plate', 0, 0, 0, 0, 0, 0, 0),
(171, 'PS5530', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(172, 'PS3092A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(173, 'PS3086A-1', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(174, 'PS3093A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(175, 'PS3110A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(176, 'PS6177A', 'LH Plate', 0, 0, 0, 0, 0, 0, 0),
(177, 'PS3112A', 'LH Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(178, 'PS3087A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(179, 'PS3086A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(180, 'PS3505	', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(181, 'PS3111A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(182, 'PS3107A', 'Plate For Frame', 0, 0, 0, 0, 0, 0, 0),
(183, 'LH1107', 'Hexagon Head Cap Screw M8 * 15', 0, 0, 0, 0, 0, 0, 0),
(184, 'PS423', 'Plate for Frame', 0, 0, 0, 0, 0, 0, 0),
(185, 'PS3304A-1', 'SQ.BAR - 40 X 35- 380 MM', 0, 0, 0, 0, 0, 0, 0),
(186, 'PS3305A-1', 'SQ.BAR - 40 X 35- 380 MM', 0, 0, 0, 0, 0, 0, 0),
(187, 'PS3306A-1', 'SQ.BAR - 40 X 35- 210 MM', 0, 0, 0, 0, 0, 0, 0),
(188, 'PS3076-1', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(189, 'PS3073-1', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(190, 'PS4811', 'Plate From Frame Left', 0, 0, 0, 0, 0, 0, 0),
(191, 'PS4820', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(192, 'PS4818', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(193, 'PS4817', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(194, 'PS4819', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(195, 'PS4821', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(196, 'PS4815', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(197, 'PS4814', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(198, 'PS4813	', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(199, 'PS4823', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(200, 'PS4825', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(201, 'PS4824', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(202, 'PS4816	', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(203, 'LK652', 'M 8 NUT', 0, 0, 0, 0, 0, 0, 0),
(204, 'PS4803', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(205, 'PS4802', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(206, 'PS4805', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(207, 'PS4826', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(208, 'PS4807', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(209, 'PS4809', 'Plate', 0, 0, 0, 0, 0, 0, 0),
(211, 'CM000096', 'U301_OUTER COVER ASSY LHS', -4586, 0, 0, 0, 0, 0, 0),
(212, ' PACKAGEING BOX', 'COROGATED PACKAGEING BOX FOR COVER PLATE DISPATCH', 0, 0, 0, 0, 0, 0, 0),
(213, '84B542471P1', 'SHIM', 0, 0, 0, 0, 0, 0, 0),
(214, 'MS SCRAP - CR ', 'MS SCRAP- CR RAW MATERIAL SHEET', 0, 0, 0, 0, 0, 0, 0),
(215, 'scrap1', 'scrap', 0, 0, 0, 0, 0, 0, 0),
(217, 'D6MS-50113', 'Back Side Member OB RHD', 12375, 0, 0, 0, 0, 0, 0),
(218, 'D6MS-50115', 'Back Side Member IB RHD', 183, 0, 0, 0, 0, 0, 0),
(219, 'D5MS-40129', 'Recliner Stopper Bracket RH', 4123, 0, 0, 0, 0, 0, 0),
(221, 'B03160201099', 'BRACKET MOUNTING-A061Y103(A063K880)', 0, 0, 0, 0, 0, 0, 0),
(222, 'B03160201098', 'BRACKET MOUNTING-A061K571', 150, 0, 0, 0, 0, 0, 0),
(223, 'B03160201097', 'BRACKET MOUNTING-A063K893', 0, 0, 0, 0, 0, 0, 0),
(224, '1000699234', 'Shifter Mounting Plate ', 31917, 0, 0, 0, 0, 0, 0),
(225, '235766', 'ANGLE-L BRACKET', 0, 0, 0, 0, 0, 0, 0),
(226, '544563608237', 'PANEL TAIL GATE', 15813, 0, 0, 0, 0, 0, 0),
(227, 'D9MS-20970', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT IB RHD', 1822, 0, 0, 0, 0, 0, 0),
(228, 'D9MS-20971', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT OB RHD', 3788, 0, 0, 0, 0, 0, 0),
(229, 'D9MS-20972', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT IB RHD', 174, 0, 0, 0, 0, 0, 0),
(230, 'D9MS-20973', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT OB LHD', 5377, 0, 0, 0, 0, 0, 0),
(231, 'production_rejection', 'production_rejection', 0, 0, 0, 0, 0, 0, 0),
(232, 'production_scrap', 'production_scrap', 0, 0, 0, 22976, 0, 0, 0),
(233, 'D6MS-50112', 'DRIVER BACK OB SIDE MEMBERWITH REC STOP ASSY RHD', 500, 0, 0, 0, 0, 0, 0),
(234, 'D6MS-50120', 'CO DRIVER BACK OB SIDE MEMBERWITH ASSY RHD', 0, 0, 0, 0, 0, 0, 0),
(235, 'CBB0004OP05', 'SHEARING E34-2X155X1250MM', 3021, 0, 0, 0, 0, 0, 0),
(236, 'CBS0004OP05', 'SHEARING E34-3X125X1250MM', 2532, 0, 0, 0, 0, 0, 0),
(237, '234844OP05', 'SHEARING D513-1X178X310MM', 10498, 0, 0, 0, 0, 0, 0),
(238, '88923-T1N00', 'T1N CUSHION PAN', 1461, 0, 0, 0, 0, 0, 0),
(239, '87680-T1N00', 'BACK SIDE BRKT ASSLY OUTER RH', 0, 0, 0, 0, 0, 0, 0),
(240, '87652-T1N00', 'SIDE BRKT. RIVET WELDED ASSLY INR RH ', 0, 0, 0, 0, 0, 0, 0),
(241, '87580-T1N00', 'BACK SIDE BRKT ASSLY OUTER LH', 0, 0, 0, 0, 0, 0, 0),
(242, '87752-T1N00', 'SIDE BRKT. RIVET WELDED ASSLY INR LH ', 0, 0, 0, 0, 0, 0, 0),
(243, '87651-T1N00', 'BACK SIDE BRKT, RH', 400, 0, 0, 0, 0, 0, 0),
(244, '87551-T1N00', 'BACK SIDE BRKT, LH', 50, 0, 0, 0, 0, 0, 0),
(245, 'SCS004450A18OP05', 'SHEARING E34-1.6X52X1250MM', 0, 0, 0, 0, 0, 0, 0),
(246, 'D7TM30546OP05', 'SHEARING E34-2.5X150X1250', 354, 0, 0, 0, 0, 0, 0),
(247, 'D7TM30545OP05', 'SHEARING E34-2.5X170X1250', 710, 0, 0, 0, 0, 0, 0),
(248, 'D7TM30542/109OP05', 'SHEARING E34-2.5X136X1250 ', 477, 0, 0, 0, 0, 0, 0),
(249, 'BSL002027942OP05', 'SHEARING HSLA340-2X55X1250MM', 480, 0, 0, 0, 0, 0, 0),
(250, 'D9MS20879OP05', 'SHEARING E34-1.6X46X1250 MM ', 97, 0, 0, 0, 0, 0, 0),
(251, 'SBT00800B42OP05', 'SHEARING E34-4.0X143X1250MM', -3242, 0, 0, 0, 0, 0, 0),
(252, 'D7TM30234OP05', 'SHEARING E34-2X85X1250 MM', 0, 0, 0, 0, 0, 0, 0),
(253, 'D7TM30884OP05', 'SHEARING E34-3X70X1250', 0, 0, 0, 0, 0, 0, 0),
(254, 'BSL002230976_1007_OP05', 'SHEARING HC340-1.5X125X1250MM', 2527, 0, 0, 0, 0, 0, 0),
(255, 'BSL002020814OP05', 'SHEARING HSLA500-2X37X1250MM', 0, 0, 0, 0, 0, 0, 0),
(256, 'BSL002049703OP05', 'SHEARING HSLA500-3X50X1250MM', 318, 0, 0, 0, 0, 0, 0),
(257, 'BSL002020815OP10', 'BRACKET FERROUS,RECLINER 3RS UPPER RH_BLANK', 0, 0, 0, 0, 0, 0, 0),
(258, 'D7TM30114OP05', 'SHEARING E34-2.5X159X1250', 0, 0, 0, 0, 0, 0, 0),
(259, 'SCS02429_30OP05', 'SHEARING FE410-6.0X178X1250MM', 8784, 0, 0, 0, 0, 0, 0),
(260, 'D7TM89831OP05', 'SHEARING SPFFH590-2.6X177X1250', 586, 0, 0, 0, 0, 0, 0),
(261, 'D7TM89821OP05', 'SHEARING SPFFH590-2.6X179X1250', 570, 0, 0, 0, 0, 0, 0),
(262, 'D7TM89731OP05', 'SHEARING SPFFH59-2.6X161X1250', 15, 0, 0, 0, 0, 0, 0),
(263, 'D7TM30120OP05', 'SHEARING E34-2.5X100X1250', 267, 0, 0, 0, 0, 0, 0),
(264, 'D8MS24403OP05', 'SHEARING E34-2.0X68X1250 MM', 425, 0, 0, 0, 0, 0, 0),
(265, 'D7TM30481OP05', 'SHEARING E34-2.5X108X1250', 0, 0, 0, 0, 0, 0, 0),
(266, 'D7TM30367OP05', 'SHEARING E34-3X407X1250', 0, 0, 0, 0, 0, 0, 0),
(267, 'BSL002055836OP05', 'SHEARING HSLA500-3X324X1250MM', 0, 0, 0, 0, 0, 0, 0),
(268, '88336-T1N00', 'PLATE BASE MNL LH', 350, 0, 0, 0, 0, 0, 0),
(269, '88436-T1N00', 'PLATE BASE MNL RH', 0, 0, 0, 0, 0, 0, 0),
(270, 'D8MS-24631', 'BACK PANEL 40P', 1620, 0, 0, 0, 0, 0, 0),
(271, 'D8MS-24401', 'BACK PANEL 60P', 4439, 0, 0, 0, 0, 0, 0),
(272, 'D8MS-24402', 'TOP TETHER WELDED ASSLY.', 0, 0, 0, 0, 0, 0, 0),
(273, '87870-T1N00', 'Recliner Spring Stopper Bracket', 570, 0, 0, 0, 0, 0, 0),
(274, '88375-T1N00', 'PLATE BASE WELDED ASSY. LH', 0, 0, 0, 0, 0, 0, 0),
(275, '88475-T1N00', 'PLATE BASE WELDED ASSY. RH	88475-T1N00 	 	', 0, 0, 0, 0, 0, 0, 0),
(276, '88675-T1N00', 'PLATE BASE M6 WELD NUTHA ASSY. RH', 0, 0, 0, 0, 0, 0, 0),
(277, '88575-T1N00', 'PLATE BASE M6 WELD NUTHA ASSY. LH', 0, 0, 0, 0, 0, 0, 0),
(278, '88280-T1N00', 'PLATE BASE WITH LINK SUB ASSY. NORM. RH', 0, 0, 0, 0, 0, 0, 0),
(279, '88180-T1N00', 'PLATE BASE WITH LINK SUB ASSY. NORM. LH', 0, 0, 0, 0, 0, 0, 0),
(280, 'CM000117', 'U301_OUTER COVER ASSY RHS', -670, 0, 0, 0, 0, 0, 0),
(281, 'PACKAGEING BOX', 'COROGATED PACKAGEING BOX-SMALL', 0, 0, 0, 0, 0, 0, 0),
(282, 'D6MS-52123', 'LUGGAGE RETENTION SUPPORT TUBE', 0, 0, 0, 0, 0, 0, 0),
(283, 'SBT000050141OP10', 'UPPER LIMIT_BLANKING', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_part_documents`
--

CREATE TABLE `customer_part_documents` (
  `id` int(11) NOT NULL,
  `customer_master_id` int(11) NOT NULL,
  `revision_number` int(11) DEFAULT NULL,
  `customer_id` int(30) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `document_name` text NOT NULL,
  `document` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_part_drawing`
--

CREATE TABLE `customer_part_drawing` (
  `id` int(11) NOT NULL,
  `customer_master_id` varchar(255) NOT NULL,
  `revision_date` varchar(50) NOT NULL,
  `revision_no` varchar(255) NOT NULL,
  `uploading_document` text DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `revision_remark` varchar(100) DEFAULT NULL,
  `customer_part_id` int(11) NOT NULL,
  `drawing` text NOT NULL,
  `cad` text DEFAULT NULL,
  `model` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_part_operation`
--

CREATE TABLE `customer_part_operation` (
  `id` int(11) NOT NULL,
  `customer_master_id` varchar(255) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `mfg` text DEFAULT NULL,
  `revision_date` varchar(50) NOT NULL,
  `revision_no` varchar(255) NOT NULL,
  `uploading_document` text DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `revision_remark` varchar(100) DEFAULT NULL,
  `customer_part_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_part_operation_data`
--

CREATE TABLE `customer_part_operation_data` (
  `id` int(11) NOT NULL,
  `customer_part_operation_id` int(11) NOT NULL,
  `operation_name` varchar(20) DEFAULT NULL,
  `product` text NOT NULL,
  `process` text NOT NULL,
  `specification_tolerance` text NOT NULL,
  `evalution` text NOT NULL,
  `size` text NOT NULL,
  `frequency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_part_rate`
--

CREATE TABLE `customer_part_rate` (
  `id` int(11) NOT NULL,
  `customer_master_id` varchar(255) NOT NULL,
  `rate` float DEFAULT NULL,
  `revision_date` varchar(50) NOT NULL,
  `revision_no` varchar(255) NOT NULL,
  `uploading_document` text DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `revision_remark` varchar(100) DEFAULT NULL,
  `customer_part_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_part_rate`
--

INSERT INTO `customer_part_rate` (`id`, `customer_master_id`, `rate`, `revision_date`, `revision_no`, `uploading_document`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `revision_remark`, `customer_part_id`) VALUES
(1, '1', 550.5, '2021-12-31', '01', '', 3, '09-12-2021', '09:20:21', '2021-12-09 15:50:21', NULL, 'new part', 0),
(2, '59', 69.23, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.21.xlsx', 3, '31-12-2021', '03:44:08', '2021-12-31 10:14:08', NULL, 'New part added', 0),
(3, '58', 69.23, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.211.xlsx', 3, '31-12-2021', '03:44:53', '2021-12-31 10:14:53', NULL, 'New part added', 0),
(4, '60', 48.6, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.212.xlsx', 3, '31-12-2021', '03:45:52', '2021-12-31 10:15:52', NULL, 'New part added', 0),
(5, '61', 48.6, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.213.xlsx', 3, '31-12-2021', '03:46:31', '2021-12-31 10:16:31', NULL, 'New part added', 0),
(6, '62', 2.9, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.214.xlsx', 3, '31-12-2021', '03:47:23', '2021-12-31 10:17:24', NULL, 'New part added', 0),
(7, '67', 1.25, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.215.xlsx', 3, '31-12-2021', '03:48:11', '2021-12-31 10:18:11', NULL, 'New part added', 0),
(8, '66', 2.47, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.216.xlsx', 3, '31-12-2021', '03:48:56', '2021-12-31 10:18:56', NULL, 'New part added', 0),
(9, '63', 72.51, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.217.xlsx', 3, '31-12-2021', '03:49:30', '2021-12-31 10:19:30', NULL, 'New part added', 0),
(10, '64', 10.79, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.218.xlsx', 3, '31-12-2021', '03:50:08', '2021-12-31 10:20:09', NULL, 'New part added', 0),
(11, '65', 10.79, '2021-09-11', '0', 'Costing_Sheet_VW_and_W601_11.09.219.xlsx', 3, '31-12-2021', '03:50:35', '2021-12-31 10:20:35', NULL, 'New part added', 0),
(12, '13', 37.05, '2022-01-01', '0', '', 3, '05-01-2022', '11:34:40', '2022-01-05 06:04:40', NULL, 'New part added', 0),
(13, '14', 40.63, '2022-01-01', '0', '', 3, '05-01-2022', '11:35:15', '2022-01-05 06:05:15', NULL, 'New part added', 0),
(14, '15', 67.41, '2022-01-01', '0', '', 3, '05-01-2022', '11:35:45', '2022-01-05 06:05:45', NULL, 'New part added', 0),
(15, '16', 67.99, '2022-01-01', '0', '', 3, '05-01-2022', '11:36:17', '2022-01-05 06:06:17', NULL, 'New part added', 0),
(16, '17', 51.78, '2022-01-01', '0', '', 3, '05-01-2022', '11:37:14', '2022-01-05 06:07:14', NULL, 'New part added', 0),
(17, '18', 124.84, '2022-01-01', '0', '', 3, '05-01-2022', '11:37:44', '2022-01-05 06:07:44', NULL, 'New part added', 0),
(18, '19', 100.32, '2022-01-01', '0', '', 3, '05-01-2022', '11:38:25', '2022-01-05 06:08:25', NULL, 'New part added', 0),
(19, '20', 66.56, '2022-01-01', '0', '', 3, '05-01-2022', '11:38:57', '2022-01-05 06:08:57', NULL, 'New part added', 0),
(20, '21', 70.92, '2022-01-01', '0', '', 3, '05-01-2022', '11:39:28', '2022-01-05 06:09:28', NULL, 'New part added', 0),
(21, '22', 121.62, '2022-01-01', '0', '', 3, '05-01-2022', '11:40:12', '2022-01-05 06:10:12', NULL, 'New part added', 0),
(22, '23', 178.68, '2022-01-01', '0', '', 3, '05-01-2022', '11:41:05', '2022-01-05 06:11:05', NULL, 'New part added', 0),
(23, '24', 130.53, '2022-01-01', '0', '', 3, '05-01-2022', '11:41:59', '2022-01-05 06:11:59', NULL, 'New part added', 0),
(24, '25', 24.15, '2022-01-01', '0', '', 3, '05-01-2022', '11:42:50', '2022-01-05 06:12:50', NULL, 'New part added', 0),
(25, '26', 12.9, '2022-01-01', '0', '', 3, '05-01-2022', '11:43:38', '2022-01-05 06:13:38', NULL, 'New part added', 0),
(26, '27', 102.07, '2022-01-01', '0', '', 3, '05-01-2022', '11:44:23', '2022-01-05 06:14:23', NULL, 'New part added', 0),
(27, '28', 52.47, '2022-01-01', '0', '', 3, '05-01-2022', '11:44:57', '2022-01-05 06:14:57', NULL, 'New part added', 0),
(28, '29', 5, '2022-01-01', '0', '', 3, '05-01-2022', '11:45:31', '2022-01-05 06:15:31', NULL, 'New part added', 0),
(29, '30', 12.15, '2022-01-01', '0', '', 3, '05-01-2022', '11:46:05', '2022-01-05 06:16:05', NULL, 'New part added', 0),
(30, '31', 74.98, '2022-01-01', '0', '', 3, '23-07-2022', '01:40:39', '2022-07-23 08:10:39', NULL, 'New part added', 0),
(31, '32', 74.98, '2022-01-01', '0', '', 3, '23-07-2022', '01:42:18', '2022-07-23 08:12:18', NULL, 'New part added', 0),
(32, '33', 66.58, '2022-01-01', '0', '', 3, '23-07-2022', '01:49:30', '2022-07-23 08:19:30', NULL, 'New part added', 0),
(33, '34', 77, '2022-01-01', '0', '', 3, '23-07-2022', '01:51:12', '2022-07-23 08:21:12', NULL, 'New part added', 0),
(34, '35', 61.82, '2022-01-01', '0', '', 3, '23-07-2022', '01:52:35', '2022-07-23 08:22:35', NULL, 'New part added', 0),
(35, '36', 47.01, '2022-01-01', '0', '', 3, '23-07-2022', '01:53:41', '2022-07-23 08:23:41', NULL, 'New part added', 0),
(36, '50', 71.78, '2022-07-24', '1', '', 3, '24-07-2022', '03:36:14', '2022-07-24 10:06:14', NULL, 'new part', 0),
(37, '213', 4, '2022-01-01', '0', '', 3, '25-07-2022', '11:53:29', '2022-07-25 06:23:29', NULL, 'New part added', 0),
(38, '214', 44.75, '2022-01-01', '0', '', 3, '27-07-2022', '11:22:09', '2022-07-27 05:52:09', NULL, ' MS SCRAP MATERIAL', 0),
(39, '215', 30, '2022-12-30', '1', '', 3, '27-09-2022', '06:10:10', '2022-09-27 12:40:10', NULL, 'scrap testing', 0),
(40, '217', 59.08, '2022-11-01', '0', 'BSP_Working_Side_Mbr_offer_to_BSP_25_july.xls.xlsx', 3, '29-11-2022', '02:58:25', '2022-11-29 09:28:25', NULL, 'Initial', 0),
(41, '218', 59.08, '2022-11-01', '0', 'BSP_Working_Side_Mbr_offer_to_BSP_25_july.xls1.xlsx', 3, '29-11-2022', '02:59:03', '2022-11-29 09:29:03', NULL, 'Initial', 0),
(42, '226', 190.54, '2022-06-04', '00', '', 3, '17-01-2023', '11:14:42', '2023-01-17 05:44:42', NULL, 'INITIAL', 0),
(43, '235', 74, '2023-01-31', '00', '', 3, '31-01-2023', '11:56:02', '2023-01-31 06:26:02', NULL, 'INITIAL', 0),
(44, '236', 74, '2023-01-31', '00', '', 3, '31-01-2023', '11:56:34', '2023-01-31 06:26:34', NULL, 'INITIAL', 0),
(45, '237', 77, '2023-01-31', '00', '', 3, '31-01-2023', '11:57:03', '2023-01-31 06:27:03', NULL, 'INITIAL', 0),
(46, '245', 46.97, '2023-01-31', '00', '', 3, '31-01-2023', '11:57:36', '2023-01-31 06:27:36', NULL, 'INITIAL', 0),
(47, '246', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '11:58:29', '2023-01-31 06:28:29', NULL, 'INITIAL', 0),
(48, '246', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '11:58:29', '2023-01-31 06:28:29', NULL, 'INITIAL', 0),
(49, '247', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '11:58:52', '2023-01-31 06:28:52', NULL, 'INITIAL', 0),
(50, '248', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '11:59:21', '2023-01-31 06:29:21', NULL, 'INITIAL', 0),
(51, '250', 64.01, '2023-01-31', '00', '', 3, '31-01-2023', '11:59:52', '2023-01-31 06:29:52', NULL, 'INITIAL', 0),
(52, '249', 72, '2023-01-31', '00', '', 3, '31-01-2023', '12:00:24', '2023-01-31 06:30:24', NULL, 'INITIAL', 0),
(53, '251', 62.79, '2023-01-31', '00', '', 3, '31-01-2023', '12:10:07', '2023-01-31 06:40:07', NULL, 'INITIAL', 0),
(54, '252', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '12:10:36', '2023-01-31 06:40:36', NULL, 'INITIAL', 0),
(55, '253', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '12:11:02', '2023-01-31 06:41:02', NULL, 'INITIAL', 0),
(56, '254', 77, '2023-01-31', '00', '', 3, '31-01-2023', '12:12:02', '2023-01-31 06:42:02', NULL, 'INITIAL', 0),
(57, '255', 72, '2023-01-31', '00', '', 3, '31-01-2023', '12:12:27', '2023-01-31 06:42:27', NULL, 'INITIAL', 0),
(58, '256', 72, '2023-01-31', '00', '', 3, '31-01-2023', '12:12:56', '2023-01-31 06:42:56', NULL, 'INITIAL', 0),
(59, '257', 72, '2023-01-31', '00', '', 3, '31-01-2023', '12:50:14', '2023-01-31 07:20:14', NULL, 'INITIAL', 0),
(60, '258', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '12:50:39', '2023-01-31 07:20:39', NULL, 'INITIAL', 0),
(61, '259', 66.45, '2023-01-31', '00', '', 3, '31-01-2023', '12:51:01', '2023-01-31 07:21:01', NULL, 'INITIAL', 0),
(62, '262', 48.45, '2023-01-31', '00', '', 3, '31-01-2023', '12:56:18', '2023-01-31 07:26:18', NULL, 'INITIAL', 0),
(63, '261', 48.45, '2023-01-31', '00', '', 3, '31-01-2023', '12:56:52', '2023-01-31 07:26:52', NULL, 'INITIAL', 0),
(64, '260', 48.45, '2023-01-31', '00', '', 3, '31-01-2023', '12:57:26', '2023-01-31 07:27:26', NULL, 'INITIAL', 0),
(65, '263', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '12:59:08', '2023-01-31 07:29:08', NULL, 'INITIAL', 0),
(66, '265', 47.01, '2023-01-31', '0', '', 3, '31-01-2023', '01:02:37', '2023-01-31 07:32:37', NULL, 'INITIAL', 0),
(67, '264', 45.1, '2023-03-31', '00', '', 3, '31-01-2023', '01:03:04', '2023-01-31 07:33:04', NULL, 'INITIAL', 0),
(68, '267', 72, '2023-01-31', '00', '', 3, '31-01-2023', '01:07:17', '2023-01-31 07:37:17', NULL, 'INITIAL', 0),
(69, '266', 47.01, '2023-01-31', '00', '', 3, '31-01-2023', '01:07:47', '2023-01-31 07:37:47', NULL, 'INITIAL', 0),
(70, '279', 36.99, '2022-08-22', '1', '', 3, '11-03-2023', '01:15:50', '2023-03-11 07:45:50', NULL, 'RATE CHANGE', 0),
(71, '13', 34.57, '2022-08-22', '1', '', 3, '11-03-2023', '01:16:50', '2023-03-11 07:46:50', NULL, 'RATE CHANGE', 0),
(72, '30', 11.2, '2022-08-22', '1', '', 3, '11-03-2023', '01:17:31', '2023-03-11 07:47:31', NULL, 'RATE CHANGE', 0),
(73, '25', 22.29, '2022-08-22', '1', '', 3, '11-03-2023', '01:18:09', '2023-03-11 07:48:09', NULL, 'RATE CHANGE', 0),
(74, '21', 60.62, '2022-08-22', '1', '', 3, '11-03-2023', '01:18:51', '2023-03-11 07:48:51', NULL, 'RATE CHANGE', 0),
(75, '20', 58.96, '2022-08-22', '1', '', 3, '11-03-2023', '01:19:26', '2023-03-11 07:49:26', NULL, 'RATE CHANGE', 0),
(76, '17', 48.14, '2022-08-22', '1', '', 3, '11-03-2023', '01:20:00', '2023-03-11 07:50:00', NULL, 'RATE CHANGE', 0),
(77, '18', 113.04, '2022-08-22', '1', '', 3, '11-03-2023', '01:20:29', '2023-03-11 07:50:29', NULL, 'RATE CHANGE', 0),
(78, '27', 97.71, '2022-08-22', '1', '', 3, '11-03-2023', '01:21:09', '2023-03-11 07:51:09', NULL, 'RATE CHANGE', 0),
(79, '26', 11.9, '2022-08-22', '1', '', 3, '11-03-2023', '01:21:43', '2023-03-11 07:51:43', NULL, 'RATE CHANGE', 0),
(80, '28', 47.86, '2022-08-22', '1', '', 3, '11-03-2023', '01:22:15', '2023-03-11 07:52:15', NULL, 'RATE CHANGE', 0),
(81, '19', 93.3, '2022-08-22', '1', '', 3, '11-03-2023', '01:22:44', '2023-03-11 07:52:44', NULL, 'RATE CHANGE', 0),
(82, '15', 59.64, '2022-08-22', '1', '', 3, '11-03-2023', '01:23:18', '2023-03-11 07:53:18', NULL, 'RATE CHANGE', 0),
(83, '22', 112.83, '2022-08-22', '1', '', 3, '11-03-2023', '01:24:07', '2023-03-11 07:54:07', NULL, 'RATE CHANGE', 0),
(84, '16', 65.52, '2022-08-22', '1', '', 3, '11-03-2023', '01:24:40', '2023-03-11 07:54:40', NULL, 'RATE CHANGE', 0),
(85, '24', 117.04, '2022-08-22', '1', '', 3, '11-03-2023', '01:25:13', '2023-03-11 07:55:13', NULL, 'RATE CHANGE', 0),
(86, '23', 162.57, '2022-08-22', '1', '', 3, '11-03-2023', '01:25:44', '2023-03-11 07:55:44', NULL, 'RATE CHANGE', 0),
(87, '50', 73.78, '2022-08-01', '1', '', 3, '11-03-2023', '01:27:38', '2023-03-11 07:57:38', NULL, 'RATE CHANGE', 0),
(88, '233', 67.53, '2022-08-22', '1', '', 3, '11-03-2023', '01:38:17', '2023-03-11 08:08:17', NULL, 'NEW PART', 0),
(89, '227', 64.61, '2022-08-22', '1', '', 3, '11-03-2023', '01:39:55', '2023-03-11 08:09:55', NULL, 'NEW PART', 0),
(90, '228', 69.53, '2022-08-22', '1', '', 3, '11-03-2023', '01:40:24', '2023-03-11 08:10:24', NULL, 'NEW PART', 0),
(91, '229', 64.61, '2022-08-22', '1', '', 3, '11-03-2023', '01:40:56', '2023-03-11 08:10:56', NULL, 'NEW PART', 0),
(92, '230', 69.53, '2022-08-22', '1', '', 3, '11-03-2023', '01:41:26', '2023-03-11 08:11:26', NULL, 'NEW PART', 0),
(93, '241', 75.25, '2022-09-21', '1', '', 3, '11-03-2023', '01:42:32', '2023-03-11 08:12:32', NULL, 'NEW PART', 0),
(94, '240', 75.25, '2022-09-21', '1', '', 3, '11-03-2023', '01:43:02', '2023-03-11 08:13:02', NULL, 'NEW PART', 0),
(95, '239', 75.25, '2022-09-21', '1', '', 3, '11-03-2023', '01:43:34', '2023-03-11 08:13:34', NULL, 'NEW PART', 0),
(96, '242', 75.25, '2022-09-21', '1', '', 3, '11-03-2023', '01:44:03', '2023-03-11 08:14:03', NULL, 'NEW PART', 0),
(97, '279', 74.68, '2022-09-21', '1', '', 3, '11-03-2023', '01:44:35', '2023-03-11 08:14:35', NULL, 'NEW PART', 0),
(98, '278', 74.68, '2022-09-21', '1', '', 3, '11-03-2023', '01:45:06', '2023-03-11 08:15:06', NULL, 'NEW PART', 0),
(99, '274', 74.68, '2022-09-21', '1', '', 3, '11-03-2023', '01:45:35', '2023-03-11 08:15:35', NULL, 'NEW PART', 0),
(100, '275', 74.68, '2022-09-21', '1', '', 3, '11-03-2023', '01:46:08', '2023-03-11 08:16:08', NULL, 'NEW PART', 0),
(101, '276', 74.68, '2022-09-21', '1', '', 3, '11-03-2023', '01:47:02', '2023-03-11 08:17:02', NULL, 'NEW PART', 0),
(102, '238', 79.14, '2022-09-21', '1', '', 3, '11-03-2023', '01:47:32', '2023-03-11 08:17:32', NULL, 'NEW PART', 0),
(103, '223', 135.27, '2022-04-01', '1', '', 3, '11-03-2023', '01:50:32', '2023-03-11 08:20:32', NULL, '0', 0),
(104, '222', 104.76, '2022-04-01', '1', '', 3, '11-03-2023', '01:51:14', '2023-03-11 08:21:14', NULL, '0', 0),
(105, '221', 147.21, '2022-04-01', '1', '', 3, '11-03-2023', '01:51:47', '2023-03-11 08:21:47', NULL, '0', 0),
(106, '51', 11.5, '2022-04-01', '1', '', 3, '11-03-2023', '01:52:24', '2023-03-11 08:22:24', NULL, '0', 0),
(107, '52', 13.8, '2022-04-01', '1', '', 3, '11-03-2023', '01:52:55', '2023-03-11 08:22:55', NULL, '0', 0),
(108, '211', 108.6, '2022-10-01', '1', '', 3, '11-03-2023', '01:59:14', '2023-03-11 08:29:14', NULL, 'RATE CHANGE', 0),
(109, '280', 108.6, '2022-10-01', '1', '', 3, '11-03-2023', '02:00:00', '2023-03-11 08:30:00', NULL, 'RATE CHANGE', 0),
(110, '72', 228.37, '2022-10-01', '1', '', 3, '11-03-2023', '02:00:34', '2023-03-11 08:30:34', NULL, 'RATE CHANGE', 0),
(111, '73', 182.4, '2022-10-01', '1', '', 3, '11-03-2023', '02:01:10', '2023-03-11 08:31:10', NULL, 'RATE CHANGE', 0),
(112, '74', 78.13, '2022-10-01', '1', '', 3, '11-03-2023', '02:01:42', '2023-03-11 08:31:42', NULL, 'RATE CHANGE', 0),
(113, '71', 85.67, '2022-10-01', '1', '', 3, '11-03-2023', '02:02:22', '2023-03-11 08:32:22', NULL, 'RATE CHANGE', 0),
(114, '75', 78.13, '2022-10-01', '1', '', 3, '11-03-2023', '02:02:59', '2023-03-11 08:32:59', NULL, 'RATE CHANGE', 0),
(115, '76', 85.67, '2022-10-01', '1', '', 3, '11-03-2023', '02:03:34', '2023-03-11 08:33:34', NULL, 'RATE CHANGE', 0),
(116, '212', 2500, '2023-03-01', '0', '', 3, '15-03-2023', '03:01:17', '2023-03-15 09:31:17', NULL, 'INITIAL', 0),
(117, '225', 12.39, '2023-03-01', '00', '', 3, '15-03-2023', '03:02:15', '2023-03-15 09:32:15', NULL, 'INITIAL', 0),
(118, '224', 227.96, '2023-03-01', '00', '', 3, '15-03-2023', '03:03:04', '2023-03-15 09:33:04', NULL, 'INITIAL', 0),
(119, '281', 75, '2023-03-01', '0', '', 3, '15-03-2023', '03:07:22', '2023-03-15 09:37:22', NULL, 'INITIAL', 0),
(120, '282', 0.84, '2023-03-01', '0', '', 3, '15-03-2023', '03:27:18', '2023-03-15 09:57:18', NULL, 'INITIAL', 0),
(121, '283', 47.01, '2023-03-01', '0', 'Sahyadri_22.02.237.xlsx', 3, '17-03-2023', '06:58:16', '2023-03-17 13:28:16', NULL, '00', 0),
(122, '76', 79.12, '2023-02-21', '01', '', 3, '17-03-2023', '07:26:58', '2023-03-17 13:56:58', NULL, 'RM RATE REVISION', 0),
(123, '75', 69.07, '2023-02-21', '02', '', 3, '17-03-2023', '07:28:14', '2023-03-17 13:58:14', NULL, 'RM RATE REVISION', 0),
(124, '71', 79.12, '2023-02-21', '02', '', 3, '17-03-2023', '07:28:45', '2023-03-17 13:58:45', NULL, 'RM RATE REVISION', 0),
(125, '74', 69.07, '2023-02-21', '02', '', 3, '17-03-2023', '07:29:16', '2023-03-17 13:59:16', NULL, 'RM RATE REVISION', 0),
(126, '73', 158.2, '2023-02-21', '02', '', 3, '17-03-2023', '07:30:02', '2023-03-17 14:00:02', NULL, 'RM RATE REVISION', 0),
(127, '72', 198.71, '2023-02-21', '02', '', 3, '17-03-2023', '07:30:35', '2023-03-17 14:00:35', NULL, 'RM RATE REVISION', 0),
(128, '280', 94.3, '2023-02-20', '03', '', 3, '17-03-2023', '07:39:00', '2023-03-17 14:09:00', NULL, 'RM RATE REVISION', 0),
(129, '84', 9.8, '2023-03-01', '0', '', 3, '19-03-2023', '12:56:19', '2023-03-19 07:26:19', NULL, '0', 0),
(130, '83', 17.1, '2023-03-01', '0', '', 3, '19-03-2023', '12:56:41', '2023-03-19 07:26:41', NULL, '0', 0),
(131, '211', 94.3, '2023-02-21', '04', '', 3, '21-03-2023', '11:37:45', '2023-03-21 06:07:45', NULL, 'RM RATE REVISION', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_part_type`
--

CREATE TABLE `customer_part_type` (
  `id` int(11) NOT NULL,
  `customer_type_name` varchar(50) NOT NULL,
  `contractor_code` varchar(30) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_po_tracking`
--

CREATE TABLE `customer_po_tracking` (
  `id` int(11) NOT NULL,
  `po_start_date` varchar(20) NOT NULL,
  `po_end_date` varchar(20) NOT NULL,
  `po_number` varchar(20) NOT NULL,
  `po_amedment_number` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `po_amendment_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_po_tracking`
--

INSERT INTO `customer_po_tracking` (`id`, `po_start_date`, `po_end_date`, `po_number`, `po_amedment_number`, `status`, `created_by`, `created_time`, `created_date`, `created_day`, `created_month`, `created_year`, `customer_id`, `po_amendment_date`) VALUES
(10, '2022-09-21', '2023-03-31', 'SA22230070', '01', 'pending', 15, '04:49:18', '15-01-2023', 15, 1, 2023, 2, NULL),
(11, '2022-06-04', '2023-03-31', 'UDPO222300487', '0', 'pending', 17, '11:11:53', '17-01-2023', 17, 1, 2023, 21, NULL),
(12, '2022-10-01', '2023-03-31', 'SA22230056', '0', 'pending', 17, '11:25:14', '17-01-2023', 17, 1, 2023, 2, NULL),
(13, '2022-08-22', '2023-03-31', 'SA22230064', '0', 'pending', 17, '11:42:56', '17-01-2023', 17, 1, 2023, 2, NULL),
(14, '2022-04-01', '2023-03-31', 'R00003', '0', 'pending', 17, '11:51:40', '17-01-2023', 17, 1, 2023, 29, NULL),
(15, '2022-04-01', '2023-03-31', 'RM419-20/31', '0', 'pending', 17, '11:57:57', '17-01-2023', 17, 1, 2023, 46, NULL),
(16, '2022-04-01', '2023-03-31', 'RM22-23/03/00', '00', 'pending', 17, '12:00:04', '17-01-2023', 17, 1, 2023, 17, NULL),
(17, '2022-04-01', '2023-03-31', 'Open / RM / CGS / 20', '0', 'pending', 17, '12:02:14', '17-01-2023', 17, 1, 2023, 17, NULL),
(18, '2023-01-01', '2023-03-31', 'PO/22-23/3/02398', '0', 'pending', 17, '12:09:09', '17-01-2023', 17, 1, 2023, 20, NULL),
(19, '2023-01-31', '2023-03-31', 'RMPO_SAHYADRI_01', '0', 'pending', 31, '01:15:56', '31-01-2023', 31, 1, 2023, 39, NULL),
(20, '2023-01-31', '2023-03-31', 'RMPO_NITIN_O1', '0', 'pending', 31, '01:22:19', '31-01-2023', 31, 1, 2023, 28, NULL),
(21, '2023-01-31', '2023-03-31', 'RMPO_OM_01', '0', 'pending', 31, '01:23:27', '31-01-2023', 31, 1, 2023, 30, NULL),
(22, '2023-01-31', '2023-03-31', 'RMPO_K&B_01', '0', 'pending', 31, '01:24:03', '31-01-2023', 31, 1, 2023, 13, NULL),
(23, '2023-01-31', '2023-03-31', 'RMPO_YOGITA_01', '00', 'pending', 31, '01:25:10', '31-01-2023', 31, 1, 2023, 59, NULL),
(24, '2023-01-31', '2023-03-31', 'RMPO_SHUBH_01', '00', 'pending', 31, '01:30:30', '31-01-2023', 31, 1, 2023, 43, NULL),
(25, '2023-01-31', '2023-03-31', 'RMPO_HAMMER_01', '00', 'pending', 31, '01:34:24', '31-01-2023', 31, 1, 2023, 5, NULL),
(26, '2023-03-13', '2023-03-31', 'SUJAN 5500002035', '01', 'pending', 13, '03:32:03', '13-03-2023', 13, 3, 2023, 44, '2022-04-20'),
(27, '2023-03-01', '2023-03-31', 'SAHYADRI-RMPO-01', '0', 'pending', 17, '07:00:00', '17-03-2023', 17, 3, 2023, 39, '');

-- --------------------------------------------------------

--
-- Table structure for table `c_po_so`
--

CREATE TABLE `c_po_so` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `so_line` varchar(50) NOT NULL,
  `so_number` varchar(30) NOT NULL,
  `so_amt` varchar(30) NOT NULL,
  `so_desc` text NOT NULL,
  `advance_amt` varchar(10) DEFAULT NULL,
  `mode_of_payment` varchar(20) DEFAULT NULL,
  `bank_name` varchar(60) DEFAULT NULL,
  `cheque_rtgs_number` varchar(20) DEFAULT NULL,
  `date_of_cheque_rtgs` varchar(20) DEFAULT NULL,
  `amount_paid` varchar(20) DEFAULT NULL,
  `mode_payment_final` varchar(20) DEFAULT NULL,
  `bank_name_final_payment` varchar(50) DEFAULT NULL,
  `cheque_rtgs_number_final_pay` varchar(30) DEFAULT NULL,
  `date_of_cheque_rtgs_final_pay` varchar(30) DEFAULT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deflashing_bom`
--

CREATE TABLE `deflashing_bom` (
  `id` int(11) NOT NULL,
  `customer_part_id` int(30) NOT NULL,
  `child_part_id` int(30) NOT NULL,
  `quantity` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deflashing_operation`
--

CREATE TABLE `deflashing_operation` (
  `id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `production_trg_qty` int(11) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `production_hours` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deflashing_production`
--

CREATE TABLE `deflashing_production` (
  `id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `output_part_id` int(11) NOT NULL,
  `output_part_table_name` varchar(20) NOT NULL,
  `accepted_qty` float DEFAULT 0,
  `rejected_qty` float DEFAULT 0,
  `onhold_qty` float NOT NULL,
  `rejection_reason` text DEFAULT NULL,
  `rejection_remark` varchar(50) DEFAULT NULL,
  `scrap_factor` float DEFAULT NULL,
  `customer_part_id` int(11) NOT NULL,
  `setup_time_in_min` float NOT NULL,
  `deflashing_operation_id` int(11) NOT NULL,
  `production_hours` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deflashing_rqeust`
--

CREATE TABLE `deflashing_rqeust` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `customer_part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `accepted_qty` float DEFAULT NULL,
  `sharing_strip` text NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_tracking`
--

CREATE TABLE `dispatch_tracking` (
  `id` int(11) NOT NULL,
  `c_po_so_id` int(11) NOT NULL,
  `completed_date` varchar(15) DEFAULT NULL,
  `weight` varchar(8) DEFAULT NULL,
  `transporter_name` varchar(50) DEFAULT NULL,
  `vehicle_number` varchar(20) DEFAULT NULL,
  `lr_number` varchar(20) DEFAULT NULL,
  `dispatch_date` varchar(15) DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `downtime_master`
--

CREATE TABLE `downtime_master` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

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
  `SignedQRCode` text DEFAULT NULL,
  `AckNo` varchar(100) DEFAULT NULL,
  `SignedInvoice` varchar(100) DEFAULT NULL,
  `info` varchar(100) DEFAULT NULL,
  `statuscode` varchar(100) DEFAULT NULL,
  `CancelRemark` varchar(100) DEFAULT NULL,
  `CancelReason` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `final_inspection_request`
--

CREATE TABLE `final_inspection_request` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `customer_part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `accepted_qty` float DEFAULT NULL,
  `sharing_strip` text NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grn_details`
--

CREATE TABLE `grn_details` (
  `id` int(11) NOT NULL,
  `inwarding_id` int(11) NOT NULL,
  `po_number` varchar(20) NOT NULL,
  `grn_number` varchar(30) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `part_id` int(11) NOT NULL,
  `inwarding_price` double NOT NULL,
  `po_part_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `verified_qty` float NOT NULL,
  `accept_qty` float NOT NULL,
  `reject_qty` float NOT NULL,
  `verfified_price` float NOT NULL,
  `verified_status` varchar(20) NOT NULL DEFAULT 'pending',
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gst_structure`
--

CREATE TABLE `gst_structure` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` varchar(10) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `tcs` float DEFAULT NULL,
  `tcs_on_tax` varchar(20) NOT NULL DEFAULT 'yes',
  `with_in_state` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gst_structure`
--

INSERT INTO `gst_structure` (`id`, `code`, `cgst`, `sgst`, `igst`, `created_by`, `created_date`, `deleted`, `tcs`, `tcs_on_tax`, `with_in_state`) VALUES
(1, 'S9C9I0', 9, 9, 0, 1, '9/17/2021', 0, NULL, 'na', 'yes'),
(2, 'S0C0I18', 0, 0, 18, 1, '9/17/2021', 0, NULL, 'na', 'no'),
(3, 'S14C14I0', 14, 14, 0, 1, '9/17/2021', 0, NULL, 'na', 'yes'),
(6, 'S0C0I28', 0, 0, 28, 3, '24-07-2022', 0, 0, 'no', 'no'),
(7, 'S6C6I0', 6, 6, 0, 3, '25-07-2022', 0, 0, 'NA', 'yes'),
(8, 'S9C9I0T0.1T', 9, 9, 0, 3, '20-08-2022', 0, 0.1, 'yes', 'yes'),
(9, 'C9S9I0.075T', 9, 9, 0, 3, '28-08-2022', 0, 0.075, 'yes', 'yes'),
(10, 'S2.5C2.5I0', 2.5, 2.5, 0, 3, '14-09-2022', 0, 0, 'NA', 'yes'),
(11, 'S0C0I12', 0, 0, 12, 3, '14-09-2022', 0, 0, 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_parts`
--

CREATE TABLE `inhouse_parts` (
  `id` int(11) NOT NULL,
  `stock` float NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(250) NOT NULL,
  `supplier_id` int(30) DEFAULT NULL,
  `part_rate` int(11) DEFAULT NULL,
  `revision_date` varchar(50) DEFAULT NULL,
  `revision_no` varchar(50) DEFAULT NULL,
  `revision_remark` varchar(20) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `child_part_id` int(255) DEFAULT NULL,
  `store_rack_location` varchar(255) DEFAULT NULL,
  `store_stock_rate` float DEFAULT NULL,
  `safty_buffer_stk` varchar(255) DEFAULT NULL,
  `diagram` varchar(50) DEFAULT NULL,
  `quote` varchar(50) DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `part_drawing` text DEFAULT NULL,
  `ppap_document` text NOT NULL,
  `modal_document` text NOT NULL,
  `cad_file` text NOT NULL,
  `a_d` text NOT NULL,
  `q_d` text NOT NULL,
  `c_d` text NOT NULL,
  `quotation_document` varchar(20) DEFAULT NULL,
  `gst_id` int(11) DEFAULT NULL,
  `sub_type` text DEFAULT NULL,
  `max_uom` float DEFAULT NULL,
  `min_uom` float DEFAULT NULL,
  `onhold_stock` float NOT NULL,
  `production_qty` float NOT NULL,
  `rejection_prodcution_qty` float NOT NULL,
  `weight` float DEFAULT NULL,
  `size` text DEFAULT NULL,
  `thickness` text DEFAULT NULL,
  `sub_con_stock` float DEFAULT NULL,
  `rejection_stock` float DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `sharing_qty` float DEFAULT NULL,
  `machine_mold_issue_stock` int(11) DEFAULT NULL,
  `production_scrap` int(11) NOT NULL DEFAULT 0,
  `production_rejection` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inhouse_parts`
--

INSERT INTO `inhouse_parts` (`id`, `stock`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `store_rack_location`, `store_stock_rate`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `gst_id`, `sub_type`, `max_uom`, `min_uom`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `weight`, `size`, `thickness`, `sub_con_stock`, `rejection_stock`, `grade`, `sharing_qty`, `machine_mold_issue_stock`, `production_scrap`, `production_rejection`) VALUES
(1, 0, 'D6MS50115OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:38:46', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 0, 'D6MS50115OP20', 'PRE-PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:39:33', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, 0, 'D6MS50115OP30', 'FORMING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:40:18', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, 0, 'D6MS50115OP40', 'FORMING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:41:53', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(5, 0, 'D6MS50115OP50', 'PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:50:27', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 3704, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(6, 0, 'D6MS50115OP60', 'PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:51:08', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 150, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(7, 0, 'D6MS50115OP70', 'FOLDING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 09:02:55', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(8, 0, 'D6MS50115OP80', 'FOLDING2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 09:03:16', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 147, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(9, 0, 'D6MS50113OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 05:23:47', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(10, 0, 'D6MS50113OP20', 'PRE-PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 05:24:46', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(11, 0, 'D6MS50113OP30', 'FORMING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 05:48:26', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(12, 0, 'D6MS50113OP40', 'FORMING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 06:05:57', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(13, 0, 'D6MS50113OP50', 'PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 06:06:42', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(14, 0, 'D6MS50113OP60', 'PIERCING2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:09:16', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(15, 0, 'D6MS50113OP70', 'FOLDING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:26:55', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(16, 0, 'D6MS50113OP80', 'FOLDING2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:35:03', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 5200, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(17, 0, 'D7TM30108OP05', 'SHEARING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(18, 0, 'D7TM30108OP10', 'BLANKING & PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(19, 0, 'D7TM30108OP20', 'FORM 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(20, 0, 'D7TM30108OP30', 'FORM 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(21, 0, 'D7TM30108OP40', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(22, 0, 'D7TM30108OP50', 'CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-13 09:35:41', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 436, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(23, 0, 'D7TM30108OP60', 'REAR MOUNTING BRACKET OB 60P-FSTP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 34.57, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-07 05:21:22', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 10000000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(24, 0, 'D7TM30108OP70', 'D7TM-30108-Rear Mtg Bkt OB 60P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(25, 0, 'D8MS26400OP10', 'BACK PANEL 60P_SPOT WELDING ASSLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:53:53', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 162, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(26, 0, 'D8MS26400OP20', 'BACK PANEL 60P_CO2 WELDING ASSLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:54:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 1530, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(27, 0, 'D8MS26400OP30', 'Notching', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(28, 0, 'D8MS26400OP40', 'Forming', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 3609, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(29, 0, 'D8MS26400OP50', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 714, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(30, 0, 'D8MS26400OP60', 'CO2 ASSEMBLY (Wire-24404 and Bkt-24403)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(31, 0, 'D8MS26400OP70', 'Spot Welding (Panel 60P and Wire assly)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(32, 0, 'D8MS26400OP80', 'CO2 Welding ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(33, 0, 'D8MS24630OP10', 'BACK PANEL 40P_SPOT WELDING ASSLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:37:54', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 537, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(34, 0, 'D8MS24630OP20', 'BACK PANEL 40P_CO2 WELDING ASSLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:32:51', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 990, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(35, 0, 'D8MS24630OP30', 'Notching', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-07 12:02:34', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 1764, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(36, 0, 'D8MS24630OP40', 'Forming', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 3240, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(37, 0, 'D8MS24630OP50', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 1932, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(38, 0, 'D8MS24630OP60', 'CO2 ASSEMBLY (Wire-24404 and Bkt-24403)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(39, 0, 'D8MS24630OP70', 'Spot Welding (OP50 and OP60)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(40, 0, 'D8MS24630OP80', 'CO2 Welding ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(41, 0, 'D7TM30117OP10', 'BLANKING & PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:07:29', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(42, 0, 'D7TM30117OP20', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:08:06', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(43, 0, 'D7TM30117OP30', 'PRE BENDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:27:56', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 10, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(44, 0, 'D7TM30117OP40', 'FINAL BENDING & RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:28:03', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 1640, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(45, 0, 'D7TM-30117', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:34:36', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 597, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(46, 0, 'D7TM30119OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-02-19 09:09:55', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(47, 0, 'D7TM30119OP20', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-02-19 09:10:28', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(48, 0, 'D7TM30119OP30', 'FLANGE & RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-02-19 09:21:23', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(49, 0, 'D7TM30119OP40', '2 STAGE PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-02-19 09:23:08', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 12, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(50, 0, 'D7TM30119OP50', 'CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-25 04:11:16', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(51, 0, 'D7TM-30119', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-25 04:11:57', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 2, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(52, 0, 'D7TM30649OP10', 'Spot Welding (30119 and Washer)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:34:36', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 314, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(53, 0, 'D7TM30649OP20', 'CO2 ASSEMBLY (30117 AND 30119)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 112.83, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:34:46', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 226, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(54, 0, 'D7TM30649OP30', 'D7TM-30649-Lower Track J Hook Assly.\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 05:51:56', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(55, 0, 'D7TM30367OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 12:47:25', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(56, 0, 'D7TM30367OP20', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 12:47:59', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(57, 0, 'D7TM30367OP30', ' FORMING & RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 12:48:28', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(58, 0, 'D7TM30367OP40', 'PIERCING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 12:48:58', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(59, 0, 'D7TM-30367', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 12:42:55', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 634, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(60, 0, 'D7TM30420OP10', 'Nut Projection Welding (D7TM-30367 AND D7TM-30464)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 06:44:36', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 605, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(61, 0, 'D7TM30420OP20', 'CO2 ASSEMBLY (30367,30481 and 30692)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 97.71, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-25 04:22:17', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 1268, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(62, 0, 'D7TM30420OP30', 'D7TM-30420-Track Supporting Bkt. 40P    \r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(63, 0, 'D5MS40129OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:27:59', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(64, 0, 'D5MS40129OP20', 'FORMING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:52:48', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 6742, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(65, 1800, 'D5MS40129OP30', 'Part off and cam piercing', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 09:00:43', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 837, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(66, 0, 'D7TM30386OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:18:44', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(67, 0, 'D7TM30386OP20', 'Top Piercing ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:19:32', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(68, 0, 'D7TM30386OP30', 'FORMING I', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:20:24', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(69, 0, 'D7TM30386OP40', ' FORMING II', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:21:49', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(70, 0, 'D7TM30386OP50', 'Embossing', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:19:37', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(71, 0, 'D7TM30386OP60', 'Horn Piercing ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:19:52', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 2112, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(72, 0, 'D7TM-30386', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 08:58:16', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 84, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(73, 0, 'D7TM30383OP10', 'CO2 ASSEMBLY (30386,30884,30674 and 30904)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 08:59:06', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(74, 0, 'D7TM30383OP20', 'Rivetting (30386 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 113.04, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 09:02:30', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(75, 0, 'D7TM30383OP30', 'D7TM-30383-FRONT MTG. BKT. ASSLY. WITH SLEEVE OB 40P\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 04:47:11', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(76, 0, 'D7TM30544OP10', 'PROGRESSIVE BLANKING AND FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(77, 0, 'D7TM-30544', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(78, 0, 'D7TM30236OP10', 'PROGRESSIVE BLANKING AND FORMING', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-18 06:54:28', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 3000, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(79, 0, 'D7TM-30236', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-28 09:24:07', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 1374, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(80, 0, 'D7TM30646OP10', 'CO2 ASSEMBLY (89831,30236,30544)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 47.86, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-07 12:08:01', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 1362, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(81, 0, 'D7TM30646OP20', 'D7TM-30646-Holder Assy. IB Latch   \r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(82, 0, 'D7TM30372OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 8, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(83, 0, 'D7TM30372OP20', 'FORMING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(84, 0, 'D7TM30372OP30', 'FORMING- II', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(85, 0, 'D7TM30372OP40', 'EMBOSSING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:48:56', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(86, 0, 'D7TM30372OP50', 'CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:50:12', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(87, 0, 'D7TM-30372', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:50:40', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 1036, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(88, 0, 'D7TM30371OP10', 'CO2 ASSEMBLY (30372 and 30675)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 08:50:47', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 800, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(89, 0, 'D7TM30371OP20', 'Rivetting (30371 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 60.62, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-26 06:55:02', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 200, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(90, 0, 'D7TM30371OP30', 'D7TM-30371-FRONT ASSLY BKT. ASSLY. WITH SLEEVE IB 40P\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-19 12:42:38', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(91, 0, 'D7TM30382OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:24:06', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 2, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(92, 0, 'D7TM30382OP20', 'Top Piercing ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:24:46', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(93, 0, 'D7TM30382OP30', 'FORMING I', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 07:25:28', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(94, 0, 'D7TM30382OP40', ' FORMING II', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:11:25', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(95, 0, 'D7TM30382OP50', 'Horn Piercing ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-29 06:11:45', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 1950, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(96, 0, 'D7TM-30382', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 12:41:48', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 824, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(97, 0, 'D7TM30381OP10', 'CO2 ASSEMBLY (30382 and 30487)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 48.14, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-27 12:41:56', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 338, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(98, 0, 'D7TM30381OP20', 'D7TM-30381-Outboard Tumble Bkt. with Norglide Bush Assy. 40P\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(99, 0, 'D7TM30647OP10', 'D7TM-30647_CO2 WELDED ASSEMBLY ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 93.3, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-28 09:12:10', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 1000, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(100, 0, 'D7TM30647OP20', 'D7TM-30647-Base plate Assy. IB Latch\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-06 09:10:47', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(101, 0, 'D7TM30648OP10', 'CO2 ASSEMBLY (89721,30234,30546)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 59.64, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-25 04:06:46', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 376, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(102, 0, 'D7TM30648OP20', ' D7TM-30648-Base plate Assy. OB Latch  \r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(105, 0, 'D7TM30693OP10', 'CO2 ASSEMBLY (89731,30236 and 89712)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 65.52, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-28 09:24:21', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 150, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(106, 0, 'D7TM30693OP20', 'D7TM-30693-Holder Assy. OB Latch \r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(107, 0, 'D7TM30373OP10', 'CO2 ASSEMBLY (30374and 30487)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-19 04:45:54', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(108, 0, 'D7TM30373OP20', 'D7TM-30373-Tumble Bkt. wth Norglide Bush Assy. IB 40P\r\n', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(109, 0, 'D7TM30105OP10', 'Rivetting (30114 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 36.99, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 06:35:47', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 600, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(110, 0, 'D7TM30105OP20', 'D7TM-30105-FRONT MTG. BKT. RIVETTED ASSEMBLY OB 60P-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(111, 0, 'D7TM30122OP10', 'Rivetting (30120 and 30115)', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 22.29, NULL, NULL, NULL, 3, '7/11/2022', '6:45:38', '2023-03-20 06:38:36', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, '', 1000000, NULL, 0, 900, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(112, 0, 'D7TM30122OP20', 'CED COATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '7/11/2022', '6:45:38', '0000-00-00 00:00:00', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 1000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(113, 0, 'L002020808OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 42.52, '3000', NULL, NULL, 3, '26-11-2022', '5:25:28', '2023-03-17 08:01:11', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 180000, NULL, 0, 1730, 0, 0.406, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(114, 0, 'L002020808OP20', '2 STAGE FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:31:06', '2023-03-17 08:00:31', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(115, 0, 'L002020808OP30', 'RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:31:49', '2023-03-26 05:21:24', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(116, 0, 'L002020808OP40', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:32:27', '2023-03-26 05:22:01', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 164, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(117, 0, 'L002020808OP50', 'L002020808OP50	SEMI-PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:32:56', '2023-03-26 05:22:25', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 5046, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(118, 0, 'L002020808NCP', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:33:41', '2023-03-22 06:13:41', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 5321, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(119, 0, 'BSL002021471OP10', 'PROJECTION WELDING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:34:21', '2023-03-29 08:56:21', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 328, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(120, 0, 'BSL002021471OP20', 'CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:02', '2023-03-29 08:56:28', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 11033, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(121, 0, 'BSL002021471NCPAI', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(122, 0, 'L002020809OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 04:44:48', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(123, 0, 'L002020809OP20', '2 STAGE FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 04:48:19', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(124, 0, 'L002020809OP30', 'RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 06:09:25', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(125, 0, 'L002020809OP40', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:45:43', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(126, 0, 'L002020809OP50', 'SEMI-PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 08:59:01', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 8314, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(127, 0, 'L002020809NCP', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 08:59:40', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 3000, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(128, 0, 'BSL002021477OP10', 'PROJECTION WELDING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 09:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 1864, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(129, 0, 'BSL002021477OP20', 'CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 09:00:09', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 7714, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(130, 0, 'BSL002020815OP10', 'BRACKET FERROUS,RECLINER 3RS UPPER RH-BLANK', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'na', 41.4, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 04:48:54', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 29734, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(131, 0, 'BSL002020815OP20', '2 STAGE FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(132, 0, 'BSL002020815OP30', 'RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(133, 0, 'BSL002020815OP40', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(134, 0, 'BSL002020815OP50', 'NOTCHING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(135, 0, 'BSL002020816OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 04:43:41', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 3, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(136, 0, 'BSL002020816OP20', '2 STAGE FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 04:44:07', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(137, 0, 'BSL002020816OP30', 'RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 05:34:58', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(138, 0, 'BSL002020816OP40', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 05:56:10', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(139, 0, 'BSL002020816OP50', 'NOTCHING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-21 05:17:26', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 6450, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(140, 0, 'BSL002055836OP10', 'BLANKING & PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 04:56:48', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 783, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(141, 0, 'BSL002055836OP20', 'FORMING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 05:00:55', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(142, 0, 'BSL002055836OP30', 'PIERCING & NOTCHING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 05:01:34', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 1991, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(143, 0, 'BSL002055836OP40', 'FORMING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 05:02:18', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(144, 0, 'BSL002055836OP50', 'FORMING 3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:46:56', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 4528, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(145, 0, 'BSL002055836OP60', 'CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:47:27', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 14350, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(146, 0, 'BSL002055836OP70', 'FRM ARMRESET MTG BKT-BSL002055836-FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 72.51, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-28 09:26:53', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 1500000, NULL, 0, 1500, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(147, 0, 'BSL002055836OP80', 'FRM ARMRESET MTG BKT-BSL002055836NCPAA-CED', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 06:17:22', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(148, 495, 'SCS004450A17OP10', 'STOPPER CUP_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 37.32, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-18 10:09:28', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(149, 0, 'SCS004450A17OP40', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:49:51', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 247, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(150, 0, 'SCS004450A17OP50', 'NOTCHING-2 STAGE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:52:33', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 153, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(151, 0, 'SCS004450A17OP60', 'TRIMMING-2 STAGE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:52:45', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 474, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(152, 0, 'SCS004450A17OP70', 'CHAMPHERING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(153, 0, 'SCS004450A17', 'FINAL INSPECTION-STOPPER CUP', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 10:22:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 79, 0, 0, 'NA', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(154, 0, 'SCS004450A15OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(155, 0, 'SCS004450A15OP20', 'SMALL BRACKET-LHS-FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 05:50:39', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 0, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(156, 0, 'SCS004450A16OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(157, 0, 'SCS004450A16OP20', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(158, 0, 'SCS004450A16', 'FINAL INSPECTION-SIDE LEG', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 10:22:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 318, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(159, 0, 'SCS004450A14OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 05:45:50', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 359, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(160, 0, 'SCS004450A14OP20', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 05:46:32', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(161, 0, 'SCS004450A14OP30', 'BENDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 05:46:41', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 1325, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(162, 0, 'SCS004450A14', 'FINAL INSPECTION-L BRACKET', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 10:22:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 101, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(163, 0, 'CM000303OP10', 'ENG MTG BKT LH-S101-WELDING ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 228.37, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-27 09:32:20', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 0, 0, 0, 'NA', 'NA', NULL, NULL, NULL, NULL, NULL, 0, 0),
(164, 0, 'CM000303OP20', 'CED COATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(165, 0, '544563608237OP10', 'DRAW ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-29 06:37:14', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 8104, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(166, 0, '5.45E+11', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(167, 0, '1000530573OP10', 'GASKET ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 08:08:33', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(168, 0, '235766OP10', 'BLANKING & PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-17 07:05:37', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `inhouse_parts` (`id`, `stock`, `part_number`, `part_description`, `supplier_id`, `part_rate`, `revision_date`, `revision_no`, `revision_remark`, `uom_id`, `child_part_id`, `store_rack_location`, `store_stock_rate`, `safty_buffer_stk`, `diagram`, `quote`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `hsn_code`, `part_drawing`, `ppap_document`, `modal_document`, `cad_file`, `a_d`, `q_d`, `c_d`, `quotation_document`, `gst_id`, `sub_type`, `max_uom`, `min_uom`, `onhold_stock`, `production_qty`, `rejection_prodcution_qty`, `weight`, `size`, `thickness`, `sub_con_stock`, `rejection_stock`, `grade`, `sharing_qty`, `machine_mold_issue_stock`, `production_scrap`, `production_rejection`) VALUES
(169, 0, '235766OP20', 'BENDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-17 07:05:58', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 41, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(170, 0, '235766OP30', 'FINAL INSPECTION BEFORE PLATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 12.39, NULL, NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 05:56:33', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 1196, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(171, 0, '1000699234OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(172, 0, '1000699234OP20', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(173, 0, '1000699234OP30', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(174, 0, '1000699234OP40', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(175, 262, '1000699234OP50', 'C02 welding', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-07 13:02:01', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(176, 0, 'A061L285OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-14 09:14:07', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 1, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(177, 0, 'A061L285OP20', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 05:29:16', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(178, 0, 'A061L285OP30', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-19 05:29:26', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 535, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(179, 0, 'A061L285', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-21 05:45:44', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(180, 0, 'A063K893OP10', 'PROJECTION WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 06:13:18', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(181, 0, 'A063K893OP20', 'CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-26 06:13:32', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 286, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(182, 0, 'A061K571OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-12 05:50:06', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 504, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(183, 0, 'A061K571OP20', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-03 14:25:39', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(184, 0, 'A061K571OP30', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '2023-03-03 14:25:47', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 504, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(185, 0, 'A061K571', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(186, 0, 'A061K874OP10', 'PROJECTION WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(187, 0, 'A061K874OP20', 'CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(188, 0, 'A061Y103OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(189, 0, 'A061Y103OP20', 'PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(190, 0, 'A061Y103OP30', 'FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(191, 0, 'A061Y103', 'FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(192, 0, 'A063K880OP10', 'PROJECTION WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(193, 0, 'A063K880OP20', 'CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(194, 0, 'A062Z273OP10', 'PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(195, 0, 'A062Z273OP20', 'PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(196, 0, 'A062Z273OP30', 'EMBOSSING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(197, 0, 'A062Z274OP10', 'EMBOSSING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(198, 0, 'A062Z274OP20', 'PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(199, 0, 'A062Z274OP30', 'PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(200, 0, 'A062Z274OP40', 'EMBOSSING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '5000', NULL, NULL, 3, '27-11-2022', '11:35:31', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(201, 0, 'CM000303OP30', 'FINAL INSPECTION-ENG MTG BKT LH-S101', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '4/12/2022', '7:32:06', '0000-00-00 00:00:00', NULL, '9401', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(202, 0, 'CM000304OP10', 'CM000304-ENG MTG BKT RH-S101_WELDING ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 182.4, NULL, NULL, NULL, 3, '5/12/2022', '2:38:09', '2023-03-20 04:21:52', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, '', 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(203, 0, 'SCS004440B18OP10', 'LEG-BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '7/12/2022', '5:40:56', '2023-03-07 12:34:41', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 9682, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(204, 0, 'BSL002230976OP10', 'IR LONG VALANCE BKT LH SK216', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 8.54, '1000', NULL, NULL, 3, '10/12/2022', '2:27:08', '0000-00-00 00:00:00', NULL, '8708', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(205, 0, 'BSL002231007OP10', 'LONG VALANCE BKT RH SK216', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 8.54, '1000', NULL, NULL, 3, '10/12/2022', '2:28:52', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(206, 0, 'CM000096OP10', 'U301_OUTER COVER ASSY LHS_CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 108.6, NULL, NULL, NULL, 3, '10/12/2022', '2:30:07', '2023-03-29 06:33:30', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, '', 300000, NULL, 0, 500, 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, 0, 0),
(207, 0, 'D7TM30374OP10', 'BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '10/12/2022', '4:04:59', '2023-03-19 04:39:09', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(208, 0, 'D7TM30374OP20', 'FORMING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '10/12/2022', '4:05:33', '2023-03-19 04:40:10', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(209, 0, 'D7TM30374OP30', 'FORMING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '10/12/2022', '4:06:03', '2023-03-19 04:40:54', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(210, 0, 'D7TM30374OP40', 'CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '10/12/2022', '4:06:27', '2023-03-19 04:41:38', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(211, 0, 'D7TM30374', 'Tumble Bkt. wth Norglide Bush Assy. IB 40P-FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 1, '100', NULL, NULL, 3, '10/12/2022', '4:07:11', '2023-03-19 04:44:53', NULL, 'NA', '', '', '', '', '', '', '', NULL, NULL, NULL, 100000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(212, 0, 'D9MS20970OP10', 'CO2 WELDING ASSEMBLY WITH D6MS-50115 AND D9MS-20879', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 64.61, '1000', NULL, NULL, 3, '10/12/2022', '8:16:38', '2023-03-29 09:03:39', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 3720, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(213, 0, 'D9MS20970OP20', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT IB RHD_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 64.61, '1000', NULL, NULL, 3, '10/12/2022', '8:17:48', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(214, 0, 'D9MS20972OP10', 'CO2 WELDING ASSEMBLY WITH D6MS-50113 AND D9MS-20879', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 64.61, '1000', NULL, NULL, 3, '10/12/2022', '8:19:21', '2023-03-29 09:00:43', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 2824, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(215, 0, 'D9MS20972OP20', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT IB RHD_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 64.61, '1000', NULL, NULL, 3, '10/12/2022', '8:22:49', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 549, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(216, 0, 'D9MS20971OP10', 'CO2 WELDING ASSEMBLY WITH D9MS-20972 AND D5MS-40129', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 69.53, '500', NULL, NULL, 3, '10/12/2022', '8:34:26', '2023-03-29 09:00:51', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 4526, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(217, 0, 'D9MS20971OP20', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT OB RHD_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 69.53, '500', NULL, NULL, 3, '10/12/2022', '8:35:28', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 251, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(218, 0, 'D9MS20973OP10', 'CO2 WELDING ASSEMBLY WITH D9MS-20970 AND D5MS-40129', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 69.53, '500', NULL, NULL, 3, '10/12/2022', '8:36:45', '2023-03-29 08:55:36', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 3275, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(219, 0, 'D9MS20973OP20', 'BACK SIDE MEMBER WITH LUMBER ATTACHMENT OB LHD_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 69.53, '500', NULL, NULL, 3, '10/12/2022', '8:38:29', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(220, 0, 'D6MS50112OP10', 'CO2 WELDING ASSEMBLY WITH D6MS-50113 AND D5MS-40129', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 67.53, '100', NULL, NULL, 3, '10/12/2022', '8:40:15', '2023-03-19 13:28:08', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(221, 0, 'D6MS50112OP20', 'DRIVER BACK OB SIDE MEMBERWITH REC STOP ASSY RHD_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 67.53, '100', NULL, NULL, 3, '10/12/2022', '8:41:16', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(222, 0, 'D6MS50120OP10', 'CO2 WELDING ASSEMBLY WITH D6MS-50115 AND D5MS-40129', NULL, NULL, NULL, NULL, NULL, 1, NULL, '67.53', 0, '100', NULL, NULL, 3, '10/12/2022', '8:42:15', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(223, 0, 'D6MS50120OP20', 'CO DRIVER BACK OB SIDE MEMBERWITH ASSY RHD_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 67.53, '100', NULL, NULL, 3, '10/12/2022', '8:43:11', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(224, 0, 'SBT000050141OP10', 'UPPER LIMIT_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, '3000', NULL, NULL, 3, '11/12/2022', '2:04:18', '2023-03-08 11:01:23', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, NULL, 3000000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(225, 0, 'SBT000050141OP30', 'UPPER LIMIT_U301 (DRAW I & DRAW II)', NULL, NULL, NULL, NULL, NULL, 5, NULL, 'NA', 0, '3000', NULL, NULL, 3, '11/12/2022', '2:06:32', '0000-00-00 00:00:00', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, NULL, 300000, NULL, 0, 9026, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(226, 0, 'SBT000050141OP40', 'UPPER LIMIT_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, '3000', NULL, NULL, 3, '11/12/2022', '2:14:54', '2023-03-18 05:30:05', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 300000, NULL, 0, 4622, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(227, 0, 'SBT000050141OP50', 'UPPER LIMIT_PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '3000', NULL, NULL, 3, '11/12/2022', '2:16:44', '2023-03-18 05:53:24', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 300000, NULL, 0, 1150, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(228, 0, 'SBT000050141', 'UPPER LIMIT_TURNING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '3000', NULL, NULL, 3, '11/12/2022', '2:18:36', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 300000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(229, 0, 'CM000096OP20', 'U301_OUTER COVER ASSY LHS-COATING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 84.7, '1000', NULL, NULL, 3, '11/12/2022', '2:54:58', '0000-00-00 00:00:00', NULL, '998898', '', '', '', '', '', '', '', NULL, NULL, NULL, 300000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(230, 0, 'CM000096', 'U301_OUTER COVER ASSY LHS_FINAL INSPECTION ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 108.6, '1000', NULL, NULL, 3, '11/12/2022', '3:10:05', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 350000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(231, 0, 'SCS004440B18OP20', 'LEG_FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '11/12/2022', '3:18:31', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(232, 0, 'SCS004440B18OP30', 'LEG_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '11/12/2022', '3:19:25', '2023-03-07 12:36:17', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 5790, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(233, 0, 'SCS004440B18OP40', 'LEG_TRIMMING & PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '11/12/2022', '3:19:54', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 1240, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(234, 0, 'D7TM-89821\r\n', 'LEG_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '11/12/2022', '3:30:26', '2023-03-19 06:21:40', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 3492, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(235, 0, 'CM000454OP10', 'TOP PLATE LH_CO2 WELDING ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 85.67, '500', NULL, NULL, 3, '11/12/2022', '4:47:12', '2023-03-29 08:35:48', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 1305, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(236, 0, 'CM000452OP10', ' TOP PLATE RH_CO2 WELDING ASSEMBLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 85.67, '500', NULL, NULL, 3, '11/12/2022', '4:48:15', '2023-03-15 09:14:47', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(237, 0, 'D7TM89821OP10', 'BLANKING AND PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '11/12/2022', '5:16:22', '2023-03-29 06:24:37', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 36000, NULL, 0, 68, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(238, 0, 'D7TM89821OP20', 'FORMING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '11/12/2022', '5:17:09', '2023-03-29 06:25:50', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 36000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(239, 0, 'D7TM89821OP30', 'FLANGE & RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '11/12/2022', '5:17:46', '2023-03-29 06:25:58', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 36000, NULL, 0, 940, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(240, 0, 'D7TM89821OP40', 'PIERCING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '11/12/2022', '5:18:24', '2023-03-20 13:51:13', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 36000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(241, 0, 'D7TM89821OP50', 'Top Piercing ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '11/12/2022', '5:19:06', '2023-03-20 13:52:06', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 36000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(242, 468, 'D7TM-89821', 'PLATE BASE RH-FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '1000', NULL, NULL, 3, '11/12/2022', '5:19:46', '2023-03-28 09:12:01', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 36000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(243, 0, 'CBS0004OP05', 'SHEARING E34-3X125X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 74, '1000', NULL, NULL, 3, '22-12-2022', '5:56:58', '0000-00-00 00:00:00', NULL, '72082730', '', '', '', '', '', '', '', NULL, NULL, NULL, 240000, NULL, 0, 0, 0, 3.68, '125x1250 mm', '3.0 MM', NULL, NULL, NULL, NULL, NULL, 0, 0),
(244, 0, 'SBT00800B42OP05', 'SHEARING E34-4.0X143X1250MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 62.79, '6000', NULL, NULL, 3, '22-12-2022', '7:01:49', '0000-00-00 00:00:00', NULL, '72082540', '', '', '', '', '', '', '', NULL, NULL, NULL, 200000, NULL, 0, 0, 0, 5.61, '143x1250mm', '4mm', NULL, NULL, NULL, NULL, NULL, 0, 0),
(245, 0, 'D7TM89831OP05', 'SHEARING SPFFH590-2.6X177X1250', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 48.45, '3000', NULL, NULL, 3, '22-12-2022', '7:13:57', '0000-00-00 00:00:00', NULL, '72082730', '', '', '', '', '', '', '', NULL, NULL, NULL, 15000, NULL, 0, 0, 0, 4.52, '177x1250 mm', '2.6mm', NULL, NULL, NULL, NULL, NULL, 0, 0),
(246, 0, '88923T1NOP05', 'SHEARING -SPRC440-0.6X635X1250 MM ', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', 72, '500', NULL, NULL, 3, '17-01-2023', '2:42:30', '0000-00-00 00:00:00', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 3.738, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(247, 0, '88923T1NOP10', 'T1N CUSHION PAN-BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, '0', NULL, NULL, 3, '17-01-2023', '2:43:40', '2023-03-07 12:38:28', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 915, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(248, 0, '88923T1NOP20', 'T1N CUSHION PAN-DRAW', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '17-01-2023', '2:44:18', '2023-03-03 14:29:28', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(249, 0, '88923T1NOP30', 'T1N CUSHION PAN-RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, 'NA', NULL, NULL, 3, '17-01-2023', '2:44:56', '2023-03-03 14:30:26', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(250, 0, '88923T1NOP40', 'T1N CUSHION PAN-TRIMMING 1 & PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, 'NA', NULL, NULL, 3, '17-01-2023', '2:45:46', '2023-03-03 14:30:58', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(251, 0, '88923T1NOP50', 'T1N CUSHION PAN-TRIMMING 2 & NOTCHING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, 'NA', NULL, NULL, 3, '17-01-2023', '2:46:19', '2023-03-04 10:03:15', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(252, 0, '88923T1NOP60', 'T1N CUSHION PAN-FLANGE FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, 'NA', NULL, NULL, 3, '17-01-2023', '2:46:47', '2023-03-04 10:04:32', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(253, 0, '88923T1NOP70', 'T1N CUSHION PAN-PRE HEMMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '17-01-2023', '2:49:09', '2023-03-04 10:05:11', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(254, 0, '88923T1NOP80', 'T1N CUSHION PAN-FINAL HEMMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '17-01-2023', '2:49:42', '2023-03-04 10:06:08', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(255, 0, '88923T1NOP90', 'T1N CUSHION PAN-FINAL PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, 'NA', NULL, NULL, 3, '17-01-2023', '2:50:19', '2023-03-04 10:06:17', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 911, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(256, 0, '87651T1NOP10', 'BACK SIDE BRKT. RH_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-01-2023', '2:15:34', '2023-03-26 05:17:35', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(257, 0, '87651T1NOP20', 'BACK SIDE BRKT. RH_PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:16:11', '2023-03-26 07:02:28', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 150, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(258, 0, '87651T1NOP30', 'BACK SIDE BRKT. RH_FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:16:40', '2023-03-26 07:04:07', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(259, 0, '87651T1NOP40', 'BACK SIDE BRKT. RH_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:18:38', '2023-03-26 07:04:42', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(260, 0, '87651T1NOP50', 'BACK SIDE BRKT. RH_PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:19:19', '2023-03-26 07:04:53', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 600, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(261, 0, '87651T1NOP60', 'BACK SIDE BRKT. RH_PIERCING 3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:19:44', '2023-03-12 06:35:48', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(262, 0, '87651T1NOP70', 'BACK SIDE BRKT. RH_HORN BENDING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:20:27', '2023-03-12 06:45:18', NULL, '72083890', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(263, 0, '87651T1NOP80', 'BACK SIDE BRKT. RH_HORN BENDING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:20:57', '2023-03-17 13:56:46', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 300, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(264, 0, '87651T1NOP90', 'BACK SIDE BRKT. RH_FLATENING & EMBOSSING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:21:27', '2023-03-17 13:57:24', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(265, 0, '87651-T1N00', 'BACK SIDE BRKT. RH_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-01-2023', '2:21:55', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(266, 0, '87551T1NOP10', 'BACK SIDE BRKT. LH_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:23:05', '2023-03-26 05:16:07', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(267, 0, '87551T1NOP20', 'BACK SIDE BRKT. LH_PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:23:58', '2023-03-26 07:01:57', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 225, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(268, 0, '87551T1NOP30', 'BACK SIDE BRKT. LH_FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:24:27', '2023-03-26 07:03:19', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 15, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(269, 0, '87551T1NOP40', 'BACK SIDE BRKT. LH_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:24:53', '2023-03-26 07:03:49', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(270, 0, '87551T1NOP50', 'BACK SIDE BRKT. LH_PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:25:23', '2023-03-26 07:04:15', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 600, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(271, 0, '87551T1NOP60', 'BACK SIDE BRKT. LH_PIERCING 3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:25:51', '2023-02-13 05:21:54', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(272, 0, '87551T1NOP70', 'BACK SIDE BRKT. LH_HORN BENDING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:26:20', '2023-02-14 08:30:52', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(273, 0, '87551T1NOP80', 'BACK SIDE BRKT. LH_HORN BENDING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:26:48', '2023-02-14 08:38:33', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(274, 0, '87551T1NOP90', 'BACK SIDE BRKT. LH_FLATENING & EMBOSSING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:27:13', '2023-03-22 05:37:11', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 249, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(275, 0, '87551-T1N00', 'BACK SIDE BRKT. LH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '18-01-2023', '2:27:53', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(276, 0, '87752T1NOP10', 'SIDE BRKT. RIVET WELDED ASSLY INR LH_CO2 WELDING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '200', NULL, NULL, 3, '20-01-2023', '2:24:20', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(277, 0, '87580T1NOP10', 'BACK SIDE BRKT ASSLY OUTER LH_CO2 WELDING ASSLY WITH BRACKET', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '200', NULL, NULL, 3, '20-01-2023', '2:25:22', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(278, 0, '87652T1NOP10', 'SIDE BRKT. RIVET WELDED ASSLY INR RH_CO2 WELDING ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '200', NULL, NULL, 3, '20-01-2023', '2:25:57', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(279, 0, '87680T1NOP10', 'BACK SIDE BRKT ASSLY OUTER RH_CO2 WELDING ASSLY WITH BRACKET', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '200', NULL, NULL, 3, '20-01-2023', '2:26:25', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(280, 0, '88336_88436T1NOP05', 'SHEARING-SPFH590-2.0X512X1250 MM', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'NA', 0, '500', NULL, NULL, 3, '6/2/2023', '2:22:14', '0000-00-00 00:00:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 250000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(281, 0, '88336T1NOP10', 'PLATE BASE MNL LH_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:24:12', '2023-03-27 06:44:36', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 5, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(282, 0, '88336T1NOP20', 'PLATE BASE MNL LH_FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:28:52', '2023-03-27 06:47:01', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(283, 0, '88336T1NOP30', 'PLATE BASE MNL LH_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:29:29', '2023-03-27 06:51:42', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 224, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(284, 0, '88336T1NOP40', 'PLATE BASE MNL LH_PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:30:39', '2023-03-27 06:54:56', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(285, 0, '88336T1NOP50', 'PLATE BASE MNL LH_PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:31:06', '2023-03-27 06:58:07', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(286, 0, '88336T1NOP60', 'PLATE BASE MNL LH_CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:31:47', '2023-03-27 06:59:01', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(287, 0, '88336T1NOP70', 'PLATE BASE MNL LH_FLARING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:32:36', '2023-03-27 06:59:08', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 2674, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(288, 0, '88436T1NOP10', 'PLATE BASE MNL RH_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:39:08', '2023-03-27 06:45:16', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 50, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(289, 0, '88436T1NOP20', 'PLATE BASE MNL RH_FORMING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:39:39', '2023-03-27 06:48:03', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(290, 0, '88436T1NOP30', 'PLATE BASE MNL RH_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:40:17', '2023-03-27 06:52:17', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(291, 0, '88436T1NOP40', 'PLATE BASE MNL RH_PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:40:53', '2023-03-27 06:55:34', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(292, 0, '88436T1NOP50', '88436T1NOP50	PLATE BASE MNL RH_PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:41:24', '2023-03-27 06:57:26', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(293, 0, '88436T1NOP60', 'PLATE BASE MNL RH_CAM PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:41:59', '2023-03-27 06:59:37', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(294, 0, '88436T1NOP70', 'PLATE BASE MNL RH_FLARING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '6/2/2023', '2:42:30', '2023-03-27 07:00:04', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 1674, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(295, 0, 'D8MS24631OP10', 'BACK PANEL 40P_DRAW', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '12-02-2023', '08:25:49', '2023-03-08 11:54:03', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 40, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(296, 0, 'D8MS24631OP20', 'BACK PANEL 40P_TRIM', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '12-02-2023', '08:26:20', '2023-03-08 11:54:42', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 140, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(297, 0, 'D8MS24631OP30', 'BACK PANEL 40P_NOTCHING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '12-02-2023', '08:26:49', '2023-03-13 11:15:17', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 1828, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(298, 0, 'D8MS24631OP40', 'BACK PANEL 40P_FLANGING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '12-02-2023', '08:27:27', '2023-03-29 08:37:46', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 1030, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(299, 0, 'D8MS24402', 'TOP TETHER WELDED ASSLY.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '2000', NULL, NULL, 3, '12-02-2023', '09:04:49', '2023-03-29 08:40:16', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 100000, NULL, 0, 833, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(300, 0, 'D8MS24401OP10', 'BACK PANEL 60P_DRAW', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '10:37:32', '2023-03-26 04:50:58', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(301, 0, 'D8MS24401OP20', 'BACK PANEL 60P_TRIM', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '10:38:01', '2023-03-26 04:51:47', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(302, 0, 'D8MS24401OP30', 'BACK PANEL 60P_NOTCHING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '10:38:28', '2023-03-26 04:52:27', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(303, 0, 'D8MS24401OP40', 'BACK PANEL 60P_FLANGING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '10:38:58', '2023-03-29 08:40:16', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 3400, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(304, 0, '87870T1NOP10', 'Recliner Spring Stopper Bracket_Blanking', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '12:28:57', '2023-02-14 08:16:14', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(305, 0, '87870T1NOP20', 'Recliner Spring Stopper Bracket_Forming', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '12:29:55', '2023-02-14 08:16:50', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(306, 0, '87870T1NOP30', 'Recliner Spring Stopper Bracket_Part off', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '12:31:16', '2023-02-14 08:18:26', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(307, 0, '87870T1NOP40', 'Recliner Spring Stopper Bracket_Piercing', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '0', NULL, NULL, 3, '13-02-2023', '12:32:11', '2023-02-27 12:23:51', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 25000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(309, 0, '88336-T1N00', 'PLATE BASE MNL LH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '02-03-2023', '06:31:36', '2023-03-02 13:01:36', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(310, 0, '88436-T1N00', 'PLATE BASE MNL RH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '02-03-2023', '06:32:15', '2023-03-02 13:02:15', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(311, 0, '88375T1N00OP10', 'PLATE BASE WELDED ASSY. LH_PROJ. WELD.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '07:33:08', '2023-03-02 14:03:08', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(312, 0, '88375T1N00OP20', 'PLATE BASE WELDED ASSY. LH_CO2 ASSLY', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '07:33:43', '2023-03-02 14:03:43', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(313, 0, '88475T1N00OP10', 'PLATE BASE WELDED ASSY. RH_PROJ. WELD.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '07:38:45', '2023-03-02 14:08:45', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(314, 0, '88475T1N00OP20', 'PLATE BASE WELDED ASSY. RH_CO2 ASSY.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '07:39:10', '2023-03-02 14:09:10', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(315, 0, '88675T1N00OP10', 'PLATE BASE M6 WELD NUTHA ASSY. RH_PROJ. WELD.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '08:01:30', '2023-03-02 14:31:30', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(316, 0, '88675T1N00OP20', 'PLATE BASE M6 WELD NUTHA ASSY. RH_C02 ASSY.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '08:01:55', '2023-03-02 14:31:55', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(317, 0, '88575T1N00OP10', 'PLATE BASE M6 WELD NUTHA ASSY. LH_PROJ. WELD.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '08:02:23', '2023-03-02 14:32:23', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(318, 0, '88575T1N00OP20', 'PLATE BASE M6 WELD NUTHA ASSY. LH_C02 ASSY.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '08:03:00', '2023-03-02 14:33:00', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(319, 0, '88280T1N00OP10', 'PLATE BASE WITH LINK SUB ASSY. NORM. RH_CO2 ASSY.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '08:03:54', '2023-03-02 14:33:54', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(320, 0, '88180T1N00OP10', 'PLATE BASE WITH LINK SUB ASSY. NORM. LH_CO2 ASSY.', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '300', NULL, NULL, 3, '02-03-2023', '08:04:23', '2023-03-02 14:34:23', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(321, 0, 'CM000117OP10', 'U301_OUTER COVER ASSY RHS_CO2 WELDING', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'NA', 0, '500', NULL, NULL, 3, '10-03-2023', '05:27:36', '2023-03-21 07:03:37', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 150000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(322, 0, '88840T1NOP10', 'SET BRKT, INR RH_BLANKING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '10:19:00', '2023-03-18 04:49:00', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 250000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(323, 0, '88840T1NOP20', 'SET BRKT, INR RH_FORMING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '10:19:34', '2023-03-18 04:49:34', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 250000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(324, 0, '88840T1NOP30', 'SET BRKT, INR RH_FORMING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '10:20:05', '2023-03-18 04:50:05', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 250000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(325, 0, '88840T1NOP40', 'SET BRKT, INR RH_RESTRIKE', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '01:34:46', '2023-03-18 08:04:46', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(326, 0, '88840T1NOP50', 'SET BRKT, INR RH_PIERCING 1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '01:35:28', '2023-03-18 08:05:28', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(327, 0, '88840T1NOP60', 'SET BRKT, INR RH_PIERCING 2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '01:35:51', '2023-03-18 08:05:51', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(328, 0, '88840T1NOP70', 'SET BRKT, INR RH_PIERCING 3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '01:36:14', '2023-03-18 08:06:14', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(329, 0, '88840T1NOP80', 'SET BRKT, INR RH_COMMON PIERCING', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '01:36:40', '2023-03-18 08:06:40', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0),
(330, 0, '88840-T1N00', 'SET BRKT, INR RH_FINAL INSPECTION', NULL, NULL, NULL, NULL, NULL, 1, NULL, '', 0, '500', NULL, NULL, 3, '18-03-2023', '01:40:42', '2023-03-18 08:10:42', NULL, '87089900', '', '', '', '', '', '', '', NULL, NULL, NULL, 50000, NULL, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inwarding`
--

CREATE TABLE `inwarding` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `invoice_number` varchar(200) NOT NULL,
  `invoice_date` varchar(20) NOT NULL,
  `grn_date` varchar(20) DEFAULT NULL,
  `invoice_amount` double NOT NULL,
  `invoice_amount_status` varchar(20) NOT NULL DEFAULT 'pending',
  `grn_number` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(11) NOT NULL,
  `slip_details` varchar(50) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `part_id` int(11) DEFAULT NULL,
  `oc_id` int(11) NOT NULL,
  `wbs_id` varchar(5) NOT NULL,
  `hus_id` varchar(5) NOT NULL,
  `item_quantity` varchar(12) NOT NULL,
  `issue_date` varchar(20) DEFAULT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_card`
--

CREATE TABLE `job_card` (
  `id` int(11) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `req_qty` float NOT NULL,
  `production_qty` float NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `operation_id` int(11) NOT NULL DEFAULT 1,
  `location` varchar(20) NOT NULL,
  `grn` varchar(20) NOT NULL,
  `house_make` varchar(20) NOT NULL,
  `issue_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_card_details`
--

CREATE TABLE `job_card_details` (
  `id` int(11) NOT NULL,
  `item_number` varchar(50) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `child_part_id` int(11) NOT NULL,
  `item_description` varchar(50) NOT NULL,
  `store_location` varchar(20) DEFAULT NULL,
  `bom_qty` float NOT NULL,
  `uom` varchar(20) NOT NULL,
  `grn` varchar(20) NOT NULL,
  `mgf` varchar(20) NOT NULL,
  `job_card_id` varchar(20) NOT NULL,
  `accept_qty` varchar(20) NOT NULL,
  `reject_qty` varchar(20) NOT NULL,
  `return_qty` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `store_reject_qty` float NOT NULL,
  `store_return_qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_card_details_operations`
--

CREATE TABLE `job_card_details_operations` (
  `id` int(11) NOT NULL,
  `job_card_details_id` int(11) NOT NULL,
  `job_card_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `accept_qty` float NOT NULL,
  `reject_qty` float NOT NULL,
  `return_qty` float NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `rejection_remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_card_prod_qty`
--

CREATE TABLE `job_card_prod_qty` (
  `id` int(11) NOT NULL,
  `job_card_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `production_qty` float NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loading_user`
--

CREATE TABLE `loading_user` (
  `id` int(11) NOT NULL,
  `po_number` varchar(20) NOT NULL,
  `so_number` varchar(30) NOT NULL,
  `contractor` varchar(20) NOT NULL,
  `project_number` varchar(20) NOT NULL,
  `start_date` varchar(15) NOT NULL,
  `target_date` varchar(15) NOT NULL,
  `completed_date` varchar(15) DEFAULT NULL,
  `wbs_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `name`) VALUES
(3, '500T PNEUMATIC-BLP02'),
(4, '500T HYDRAULIC-BLHYD'),
(5, '250T PNEUMATIC-BLP01'),
(6, '300T PNEUMATIC-BLP03'),
(7, '100T PNEUMATIC-BLP04'),
(8, '150T PNEUMATIC-BLP05'),
(9, 'FINAL INSPECTION'),
(10, 'SHEARING MACHINE'),
(11, 'CO2 Welding Machine'),
(12, 'Spot_Projection Weld'),
(13, 'Riveting M/C'),
(14, 'B_PR_CO2WD-1'),
(15, 'B_PR_CO2WD-2'),
(16, 'B_PR_CO2WD-3'),
(17, 'MANUAL ASSEMBLY');

-- --------------------------------------------------------

--
-- Table structure for table `machine_mold`
--

CREATE TABLE `machine_mold` (
  `id` int(11) NOT NULL,
  `mold_maintenance_id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `machine_request`
--

CREATE TABLE `machine_request` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `machine_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL,
  `customer_part_id` int(11) DEFAULT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `machine_request_parts`
--

CREATE TABLE `machine_request_parts` (
  `id` int(11) NOT NULL,
  `machine_request_id` int(11) NOT NULL,
  `child_part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `accepted_qty` float NOT NULL,
  `rejected_qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `molding_production`
--

CREATE TABLE `molding_production` (
  `id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `output_part_id` int(11) NOT NULL,
  `output_part_table_name` varchar(20) NOT NULL,
  `accepted_qty` float DEFAULT 0,
  `rejected_qty` float DEFAULT 0,
  `onhold_qty` float NOT NULL,
  `rejection_reason` text DEFAULT NULL,
  `rejection_remark` varchar(50) DEFAULT NULL,
  `scrap_factor` float DEFAULT NULL,
  `mold_id` int(11) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `production_hours` float NOT NULL,
  `downtime_in_min` float NOT NULL,
  `setup_time_in_min` float NOT NULL,
  `cycle_time` float NOT NULL,
  `finish_part_weight` float NOT NULL,
  `remark` text NOT NULL,
  `downtime_reason` text NOT NULL,
  `wastage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `molding_stock_transfer`
--

CREATE TABLE `molding_stock_transfer` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `customer_part_id` int(11) NOT NULL,
  `semi_finished_location` float NOT NULL DEFAULT 0,
  `accepted_qty` float DEFAULT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deflashing_assembly_location` float NOT NULL DEFAULT 0,
  `final_inspection_location` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mold_maintenance`
--

CREATE TABLE `mold_maintenance` (
  `id` int(11) NOT NULL,
  `no_of_cavity` int(11) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `target_life` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_po`
--

CREATE TABLE `new_po` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_date` varchar(10) NOT NULL,
  `expiry_po_date` varchar(20) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `process_id` int(11) DEFAULT NULL,
  `amendment_no` text DEFAULT NULL,
  `amendment_date` varchar(20) DEFAULT NULL,
  `loading_unloading` float DEFAULT NULL,
  `loading_unloading_gst` int(11) DEFAULT NULL,
  `freight_amount` float DEFAULT NULL,
  `freight_amount_gst` varchar(20) DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `closed_remark` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `final_amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_po_sub`
--

CREATE TABLE `new_po_sub` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_date` varchar(10) NOT NULL,
  `expiry_po_date` varchar(20) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `process_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_sales`
--

CREATE TABLE `new_sales` (
  `id` int(11) NOT NULL,
  `sales_number` varchar(50) NOT NULL,
  `customer_part_id` int(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `po_date` varchar(10) DEFAULT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `transporter` varchar(100) DEFAULT NULL,
  `vehicle_number` varchar(100) DEFAULT NULL,
  `lr_number` varchar(100) DEFAULT NULL,
  `expiry_po_date` varchar(20) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `po_number` varchar(50) DEFAULT NULL,
  `e_invoice_number` varchar(50) DEFAULT NULL,
  `distance` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_sales_rejection`
--

CREATE TABLE `new_sales_rejection` (
  `id` int(11) NOT NULL,
  `sales_number` varchar(50) NOT NULL,
  `part_number` varchar(200) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `transporter` varchar(100) DEFAULT NULL,
  `vehicle_number` varchar(100) DEFAULT NULL,
  `lr_number` varchar(100) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `price` float DEFAULT NULL,
  `hsn_code` text DEFAULT NULL,
  `qty` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_sales_subcon`
--

CREATE TABLE `new_sales_subcon` (
  `id` int(11) NOT NULL,
  `sales_number` varchar(50) NOT NULL,
  `customer_part_id` int(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `po_date` varchar(10) NOT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `transporter` varchar(100) DEFAULT NULL,
  `vehicle_number` varchar(100) DEFAULT NULL,
  `lr_number` varchar(100) DEFAULT NULL,
  `expiry_po_date` varchar(20) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(12) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` varchar(20) NOT NULL,
  `created_year` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `deleted` int(11) NOT NULL DEFAULT 0,
  `po_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operations_bom`
--

CREATE TABLE `operations_bom` (
  `id` int(11) NOT NULL,
  `customer_part_number` text NOT NULL,
  `output_part_id` int(11) NOT NULL,
  `output_part_table_name` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `scrap_factor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operations_bom`
--

INSERT INTO `operations_bom` (`id`, `customer_part_number`, `output_part_id`, `output_part_table_name`, `customer_id`, `created_date`, `created_time`, `day`, `month`, `year`, `created_id`, `scrap_factor`) VALUES
(53, 'D7TM-30646', 76, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0.037),
(55, 'D7TM-30646', 77, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(57, 'D7TM-30646', 78, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0.02),
(59, 'D7TM-30646', 79, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(61, 'D7TM-30646', 80, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(63, 'D7TM-30646', 28, 'customer_part', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(73, 'D7TM-30693', 105, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(75, 'D7TM-30693', 16, 'customer_part', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(81, 'D7TM-30381', 91, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(83, 'D7TM-30381', 92, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(85, 'D7TM-30381', 93, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(87, 'D7TM-30381', 94, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(89, 'D7TM-30381', 95, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0.188),
(91, 'D7TM-30381', 96, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(93, 'D7TM-30381', 97, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(95, 'D7TM-30381', 17, 'customer_part', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(97, 'D7TM-30371', 82, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(99, 'D7TM-30371', 83, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(101, 'D7TM-30371', 84, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(103, 'D7TM-30371', 85, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(105, 'D7TM-30371', 86, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0.458),
(107, 'D7TM-30371', 87, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(109, 'D7TM-30371', 88, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(111, 'D7TM-30371', 89, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(113, 'D7TM-30371', 21, 'customer_part', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(167, 'D6MS-50115', 1, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(169, 'D6MS-50115', 2, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(171, 'D6MS-50115', 3, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(173, 'D6MS-50115', 4, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(175, 'D6MS-50115', 5, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(177, 'D6MS-50115', 6, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(179, 'D6MS-50115', 7, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(181, 'D6MS-50115', 8, 'inhouse_parts', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0.245),
(183, 'D6MS-50115', 218, 'customer_part', 2, '9/11/2022', 5, 9, 11, 2022, 3, 0),
(200, 'D7TM-30648', 101, 'inhouse_parts', 2, '15-11-2022', 3, 15, 11, 2022, 3, 0),
(201, 'D7TM-30648', 15, 'customer_part', 2, '15-11-2022', 3, 15, 11, 2022, 3, 0),
(202, 'D7TM-30105(30114)', 109, 'inhouse_parts', 2, '15-11-2022', 3, 15, 11, 2022, 3, 0),
(203, 'D7TM-30105(30114)', 14, 'customer_part', 2, '15-11-2022', 3, 15, 11, 2022, 3, 0),
(204, 'D7TM-30122(30120)', 111, 'inhouse_parts', 2, '15-11-2022', 4, 15, 11, 2022, 3, 0),
(205, 'D7TM-30122(30120)', 25, 'customer_part', 2, '15-11-2022', 4, 15, 11, 2022, 3, 0),
(206, 'BSL002021471NCPAI', 113, 'inhouse_parts', 29, '26-11-2022', 5, 26, 11, 2022, 3, 0),
(207, 'BSL002021471NCPAI', 60, 'customer_part', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(208, 'BSL002021471NCPAI', 114, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(209, 'BSL002021471NCPAI', 115, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(210, 'BSL002021471NCPAI', 116, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(211, 'BSL002021471NCPAI', 117, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0.154),
(212, 'BSL002021471NCPAI', 118, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(213, 'BSL002021471NCPAI', 119, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(214, 'BSL002021471NCPAI', 120, 'inhouse_parts', 29, '27-11-2022', 11, 27, 11, 2022, 3, 0),
(215, 'BSL002021477NCPAI', 61, 'customer_part', 29, '29-11-2022', 12, 29, 11, 2022, 3, 0),
(216, 'BSL002021477NCPAI', 122, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(217, 'BSL002021477NCPAI', 123, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(218, 'BSL002021477NCPAI', 124, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(219, 'BSL002021477NCPAI', 125, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(220, 'BSL002021477NCPAI', 126, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0.154),
(222, 'BSL002021477NCPAI', 129, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(223, 'BSL002020816NCPAG', 135, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(224, 'BSL002020816NCPAG', 136, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(225, 'BSL002020816NCPAG', 137, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(226, 'BSL002020816NCPAG', 138, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(227, 'BSL002020816NCPAG', 139, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0.455),
(228, 'BSL002020816NCPAG', 59, 'customer_part', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(229, 'BSL002055836NCPAA', 140, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(230, 'BSL002055836NCPAA', 141, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(231, 'BSL002055836NCPAA', 142, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(232, 'BSL002055836NCPAA', 143, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(233, 'BSL002055836NCPAA', 144, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(234, 'BSL002055836NCPAA', 145, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0.253),
(235, 'BSL002055836NCPAA', 146, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(236, 'BSL002055836NCPAA', 147, 'inhouse_parts', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(237, 'BSL002055836NCPAA', 63, 'customer_part', 29, '29-11-2022', 5, 29, 11, 2022, 3, 0),
(238, 'BSL002021477NCPAI', 127, 'inhouse_parts', 29, '30-11-2022', 4, 30, 11, 2022, 3, 0),
(239, 'BSL002021477NCPAI', 128, 'inhouse_parts', 29, '30-11-2022', 4, 30, 11, 2022, 3, 0),
(240, 'BSL002020815NCPAG', 130, 'inhouse_parts', 29, '30-11-2022', 4, 30, 11, 2022, 3, 0),
(241, 'CM000303', 148, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(242, 'CM000303', 149, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(243, 'CM000303', 150, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(244, 'CM000303', 151, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(245, 'CM000303', 152, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0.337),
(246, 'CM000303', 153, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(247, 'CM000303', 154, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(248, 'CM000303', 155, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0.043),
(249, 'CM000303', 156, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(250, 'CM000303', 157, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0.017),
(251, 'CM000303', 158, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(252, 'CM000303', 159, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(253, 'CM000303', 160, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(254, 'CM000303', 161, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0.415),
(255, 'CM000303', 162, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(256, 'CM000303', 163, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(257, 'CM000303', 164, 'inhouse_parts', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(258, 'CM000303', 72, 'customer_part', 44, '30-11-2022', 11, 30, 11, 2022, 3, 0),
(259, '5.45E+11', 165, 'inhouse_parts', 21, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(260, '1000530573', 167, 'inhouse_parts', 17, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(261, '1000530573', 50, 'customer_part', 17, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(262, 'W05161903464', 197, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(263, 'W05161903464', 198, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(264, 'W05161903464', 199, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(265, 'W05161903464', 200, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(266, 'W05161903464', 52, 'customer_part', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(267, 'W05161903463', 194, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(268, 'W05161903463', 195, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(269, 'W05161903463', 196, 'inhouse_parts', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(270, 'W05161903463', 51, 'customer_part', 20, '30-11-2022', 1, 30, 11, 2022, 3, 0),
(271, 'BSL002230976NCPAA', 64, 'customer_part', 29, '04-12-2022', 6, 4, 12, 2022, 3, 0),
(272, 'BSL002231007NCPAA', 65, 'customer_part', 29, '04-12-2022', 6, 4, 12, 2022, 3, 0),
(273, 'CM000303', 201, 'inhouse_parts', 44, '04-12-2022', 7, 4, 12, 2022, 3, 0),
(274, '544563608237', 165, 'inhouse_parts', 21, '06-12-2022', 6, 6, 12, 2022, 3, 0),
(275, '544563608237', 226, 'customer_part', 21, '06-12-2022', 6, 6, 12, 2022, 3, 0),
(284, 'D7TM-30122(30120)', 112, 'inhouse_parts', 2, '11-12-2022', 10, 11, 12, 2022, 3, 0),
(285, 'D7TM-30648', 102, 'inhouse_parts', 2, '11-12-2022', 10, 11, 12, 2022, 3, 0),
(286, 'D7TM-30105(30114)', 110, 'inhouse_parts', 2, '11-12-2022', 11, 11, 12, 2022, 3, 0),
(288, 'D9MS-20970', 212, 'inhouse_parts', 2, '11-12-2022', 1, 11, 12, 2022, 3, 0),
(289, 'D9MS-20970', 227, 'customer_part', 2, '11-12-2022', 1, 11, 12, 2022, 3, 0),
(290, 'D9MS-20972', 214, 'inhouse_parts', 2, '11-12-2022', 1, 11, 12, 2022, 3, 0),
(291, 'D9MS-20972', 229, 'customer_part', 2, '11-12-2022', 1, 11, 12, 2022, 3, 0),
(292, 'D9MS-20971', 216, 'inhouse_parts', 2, '11-12-2022', 1, 11, 12, 2022, 3, 0),
(293, 'D9MS-20971', 228, 'customer_part', 2, '11-12-2022', 1, 11, 12, 2022, 3, 0),
(294, 'D9MS-20973', 218, 'inhouse_parts', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(295, 'D9MS-20973', 230, 'customer_part', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(296, 'D6MS-50112', 220, 'inhouse_parts', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(297, 'D6MS-50112', 233, 'customer_part', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(298, 'D6MS-50120', 222, 'inhouse_parts', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(299, 'D6MS-50120', 234, 'customer_part', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(300, 'D7TM-30109', 26, 'customer_part', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(301, 'D7TM-30542', 26, 'customer_part', 2, '11-12-2022', 2, 11, 12, 2022, 3, 0),
(302, 'CM000304', 203, 'inhouse_parts', 44, '11-12-2022', 3, 11, 12, 2022, 3, 0),
(303, 'CM000304', 231, 'inhouse_parts', 44, '11-12-2022', 3, 11, 12, 2022, 3, 0),
(304, 'CM000304', 232, 'inhouse_parts', 44, '11-12-2022', 3, 11, 12, 2022, 3, 0),
(305, 'CM000304', 233, 'inhouse_parts', 44, '11-12-2022', 3, 11, 12, 2022, 3, 0),
(306, 'CM000304', 234, 'inhouse_parts', 44, '11-12-2022', 3, 11, 12, 2022, 3, 0),
(307, 'CM000304', 202, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(308, 'CM000304', 73, 'customer_part', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(309, 'CM000096', 224, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(310, 'CM000096', 226, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(311, 'CM000096', 227, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(312, 'CM000096', 206, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(313, 'CM000096', 211, 'customer_part', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(314, 'CM000454', 235, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(315, 'CM000454', 76, 'customer_part', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(316, 'CM000452', 236, 'inhouse_parts', 44, '11-12-2022', 4, 11, 12, 2022, 3, 0),
(317, 'CM000452', 71, 'customer_part', 44, '11-12-2022', 5, 11, 12, 2022, 3, 0),
(326, 'D6MS-50113', 9, 'inhouse_parts', 2, '13-12-2022', 6, 13, 12, 2022, 3, 0),
(327, 'D6MS-50113', 10, 'inhouse_parts', 2, '13-12-2022', 6, 13, 12, 2022, 3, 0),
(328, 'D6MS-50113', 11, 'inhouse_parts', 2, '13-12-2022', 6, 13, 12, 2022, 3, 0),
(329, 'D6MS-50113', 12, 'inhouse_parts', 2, '13-12-2022', 6, 13, 12, 2022, 3, 0),
(330, 'D6MS-50113', 13, 'inhouse_parts', 2, '13-12-2022', 6, 13, 12, 2022, 3, 0),
(331, 'D6MS-50113', 14, 'inhouse_parts', 2, '13-12-2022', 7, 13, 12, 2022, 3, 0),
(332, 'D6MS-50113', 15, 'inhouse_parts', 2, '13-12-2022', 7, 13, 12, 2022, 3, 0),
(333, 'D6MS-50113', 16, 'inhouse_parts', 2, '13-12-2022', 7, 13, 12, 2022, 3, 0.245),
(334, 'D6MS-50113', 217, 'customer_part', 2, '13-12-2022', 7, 13, 12, 2022, 3, 0),
(344, '235766', 168, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(345, '235766', 169, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0.025),
(346, '235766', 170, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(347, '235766', 225, 'customer_part', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(348, '1000699234', 171, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(349, '1000699234', 172, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0.11),
(350, '1000699234', 173, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(351, '1000699234', 174, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(352, '1000699234', 175, 'inhouse_parts', 17, '25-12-2022', 11, 25, 12, 2022, 3, 0),
(353, '1000699234', 224, 'customer_part', 17, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(354, 'B03160201099', 188, 'inhouse_parts', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(355, 'B03160201099', 189, 'inhouse_parts', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0.63),
(356, 'B03160201099', 190, 'inhouse_parts', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(357, 'B03160201099', 191, 'inhouse_parts', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(358, 'B03160201099', 192, 'inhouse_parts', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(359, 'B03160201099', 193, 'inhouse_parts', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(360, 'B03160201099', 221, 'customer_part', 20, '25-12-2022', 12, 25, 12, 2022, 3, 0),
(361, 'D5MS-40129', 63, 'inhouse_parts', 2, '27-12-2022', 2, 27, 12, 2022, 3, 0),
(362, 'D5MS-40129', 64, 'inhouse_parts', 2, '27-12-2022', 2, 27, 12, 2022, 3, 0),
(363, 'D5MS-40129', 65, 'inhouse_parts', 2, '27-12-2022', 2, 27, 12, 2022, 3, 0.04),
(364, 'D5MS-40129', 219, 'customer_part', 2, '27-12-2022', 2, 27, 12, 2022, 3, 0),
(365, 'D7TM-30108', 18, 'inhouse_parts', 2, '28-12-2022', 12, 28, 12, 2022, 3, 0),
(366, 'D7TM-30108', 19, 'inhouse_parts', 2, '28-12-2022', 12, 28, 12, 2022, 3, 0),
(367, 'D7TM-30108', 20, 'inhouse_parts', 2, '28-12-2022', 12, 28, 12, 2022, 3, 0),
(368, 'D7TM-30108', 21, 'inhouse_parts', 2, '28-12-2022', 12, 28, 12, 2022, 3, 0),
(369, 'D7TM-30108', 22, 'inhouse_parts', 2, '28-12-2022', 12, 28, 12, 2022, 3, 0.115),
(370, 'D7TM-30108', 23, 'inhouse_parts', 2, '28-12-2022', 12, 28, 12, 2022, 3, 0),
(371, 'B03160201097', 176, 'inhouse_parts', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0),
(372, 'B03160201097', 177, 'inhouse_parts', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0.29),
(373, 'B03160201097', 178, 'inhouse_parts', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0),
(374, 'B03160201097', 179, 'inhouse_parts', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0),
(375, 'B03160201097', 180, 'inhouse_parts', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0),
(376, 'B03160201097', 181, 'inhouse_parts', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0),
(377, 'B03160201097', 223, 'customer_part', 20, '14-01-2023', 4, 14, 1, 2023, 3, 0),
(378, 'B03160201098', 182, 'inhouse_parts', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0),
(379, 'B03160201098', 183, 'inhouse_parts', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0),
(380, 'B03160201098', 184, 'inhouse_parts', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0.19),
(381, 'B03160201098', 185, 'inhouse_parts', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0),
(382, 'B03160201098', 186, 'inhouse_parts', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0),
(383, 'B03160201098', 187, 'inhouse_parts', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0),
(384, 'B03160201098', 222, 'customer_part', 20, '17-01-2023', 10, 17, 1, 2023, 3, 0),
(385, '88923-T1N00', 247, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(386, '88923-T1N00', 248, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(387, '88923-T1N00', 249, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(388, '88923-T1N00', 250, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(389, '88923-T1N00', 251, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(390, '88923-T1N00', 252, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(391, '88923-T1N00', 253, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(392, '88923-T1N00', 254, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(393, '88923-T1N00', 255, 'inhouse_parts', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0.66),
(394, '88923-T1N00', 238, 'customer_part', 2, '17-01-2023', 2, 17, 1, 2023, 3, 0),
(395, '87651-T1N00', 256, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(396, '87651-T1N00', 257, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(397, '87651-T1N00', 258, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(398, '87651-T1N00', 259, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(399, '87651-T1N00', 260, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(400, '87651-T1N00', 261, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(401, '87651-T1N00', 262, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(402, '87651-T1N00', 263, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(403, '87651-T1N00', 264, 'inhouse_parts', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0.44),
(404, '87651-T1N00', 243, 'customer_part', 2, '20-01-2023', 1, 20, 1, 2023, 3, 0),
(415, '87752-T1N00', 276, 'inhouse_parts', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(416, '87752-T1N00', 242, 'customer_part', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(417, '87652-T1N00', 278, 'inhouse_parts', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(418, '87652-T1N00', 240, 'customer_part', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(419, '87680-T1N00', 279, 'inhouse_parts', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(420, '87680-T1N00', 239, 'customer_part', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(421, '87580-T1N00', 277, 'inhouse_parts', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(422, '87580-T1N00', 241, 'customer_part', 2, '20-01-2023', 2, 20, 1, 2023, 3, 0),
(423, '88336-T1N00', 281, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(424, '88336-T1N00', 282, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(425, '88336-T1N00', 283, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(426, '88336-T1N00', 284, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(427, '88336-T1N00', 285, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(428, '88436-T1N00', 288, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(429, '88436-T1N00', 289, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(430, '88436-T1N00', 290, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(431, '88436-T1N00', 291, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(432, '88436-T1N00', 292, 'inhouse_parts', 2, '06-02-2023', 3, 6, 2, 2023, 3, 0),
(433, 'D7TM-30383', 66, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(434, 'D7TM-30383', 67, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(435, 'D7TM-30383', 68, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(436, 'D7TM-30383', 69, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(437, 'D7TM-30383', 70, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(438, 'D7TM-30383', 71, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(439, 'D7TM-30383', 72, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(440, 'D7TM-30383', 73, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 1.43),
(441, 'D7TM-30383', 74, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(442, 'D7TM-30383', 75, 'inhouse_parts', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(443, 'D7TM-30383', 18, 'customer_part', 2, '12-02-2023', 12, 12, 2, 2023, 3, 0),
(444, 'D8MS-24402', 299, 'inhouse_parts', 2, '12-02-2023', 9, 12, 2, 2023, 3, 0),
(445, 'D8MS-24631', 295, 'inhouse_parts', 2, '12-02-2023', 9, 12, 2, 2023, 3, 0),
(446, 'D8MS-24631', 296, 'inhouse_parts', 2, '12-02-2023', 9, 12, 2, 2023, 3, 0),
(447, 'D8MS-24631', 297, 'inhouse_parts', 2, '12-02-2023', 9, 12, 2, 2023, 3, 0.81),
(448, 'D8MS-24631', 298, 'inhouse_parts', 2, '12-02-2023', 9, 12, 2, 2023, 3, 0),
(449, 'D8MS-24631', 270, 'customer_part', 2, '12-02-2023', 9, 12, 2, 2023, 3, 0),
(450, 'D8MS-24401', 300, 'inhouse_parts', 2, '13-02-2023', 10, 13, 2, 2023, 3, 0),
(451, 'D8MS-24401', 301, 'inhouse_parts', 2, '13-02-2023', 10, 13, 2, 2023, 3, 0),
(452, 'D8MS-24401', 302, 'inhouse_parts', 2, '13-02-2023', 10, 13, 2, 2023, 3, 0.96),
(453, 'D8MS-24401', 303, 'inhouse_parts', 2, '13-02-2023', 10, 13, 2, 2023, 3, 0),
(454, 'D8MS-24401', 271, 'customer_part', 2, '13-02-2023', 10, 13, 2, 2023, 3, 0),
(455, '87870-T1N00', 304, 'inhouse_parts', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0),
(456, '87870-T1N00', 305, 'inhouse_parts', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0),
(457, '87870-T1N00', 306, 'inhouse_parts', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0),
(458, '87870-T1N00', 307, 'inhouse_parts', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0.099),
(459, '87870-T1N00', 273, 'customer_part', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0),
(460, '88336-T1N00', 286, 'inhouse_parts', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0.575),
(461, '88336-T1N00', 287, 'inhouse_parts', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0),
(462, '88336-T1N00', 268, 'customer_part', 2, '13-02-2023', 12, 13, 2, 2023, 3, 0),
(463, '88436-T1N00', 293, 'inhouse_parts', 2, '13-02-2023', 1, 13, 2, 2023, 3, 0.575),
(464, '88436-T1N00', 294, 'inhouse_parts', 2, '13-02-2023', 1, 13, 2, 2023, 3, 0),
(465, '88436-T1N00', 269, 'customer_part', 2, '13-02-2023', 1, 13, 2, 2023, 3, 0),
(466, 'D8MS-24630', 33, 'inhouse_parts', 2, '15-02-2023', 5, 15, 2, 2023, 3, 0),
(467, 'D8MS-24630', 34, 'inhouse_parts', 2, '15-02-2023', 5, 15, 2, 2023, 3, 0),
(468, 'D8MS-24630', 24, 'customer_part', 2, '15-02-2023', 5, 15, 2, 2023, 3, 0),
(469, 'D8MS-26400', 25, 'inhouse_parts', 2, '15-02-2023', 6, 15, 2, 2023, 3, 0),
(470, 'D8MS-26400', 26, 'inhouse_parts', 2, '15-02-2023', 6, 15, 2, 2023, 3, 0),
(471, 'D8MS-26400', 23, 'customer_part', 2, '15-02-2023', 6, 15, 2, 2023, 3, 0),
(472, '88375-T1N00', 311, 'inhouse_parts', 2, '02-03-2023', 7, 2, 3, 2023, 3, 0),
(473, '88375-T1N00', 312, 'inhouse_parts', 2, '02-03-2023', 7, 2, 3, 2023, 3, 0),
(474, '88375-T1N00', 274, 'customer_part', 2, '02-03-2023', 7, 2, 3, 2023, 3, 0),
(475, '88475-T1N00', 313, 'inhouse_parts', 2, '02-03-2023', 7, 2, 3, 2023, 3, 0),
(476, '88475-T1N00', 314, 'inhouse_parts', 2, '02-03-2023', 7, 2, 3, 2023, 3, 0),
(477, '88475-T1N00', 275, 'customer_part', 2, '02-03-2023', 7, 2, 3, 2023, 3, 0),
(478, '88675-T1N00', 315, 'inhouse_parts', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(479, '88675-T1N00', 316, 'inhouse_parts', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(480, '88675-T1N00', 276, 'customer_part', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(481, '88575-T1N00', 317, 'inhouse_parts', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(482, '88575-T1N00', 318, 'inhouse_parts', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(483, '88575-T1N00', 277, 'customer_part', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(484, '88280-T1N00', 319, 'inhouse_parts', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(485, '88280-T1N00', 278, 'customer_part', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(486, '88180-T1N00', 320, 'inhouse_parts', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(487, '88180-T1N00', 279, 'customer_part', 2, '02-03-2023', 8, 2, 3, 2023, 3, 0),
(488, 'CM000117', 321, 'inhouse_parts', 44, '10-03-2023', 5, 10, 3, 2023, 3, 0),
(489, 'CM000117', 280, 'customer_part', 44, '10-03-2023', 5, 10, 3, 2023, 3, 0),
(490, 'D7TM-30647', 237, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(491, 'D7TM-30647', 238, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(492, 'D7TM-30647', 239, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(493, 'D7TM-30647', 240, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(494, 'D7TM-30647', 241, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0.269),
(495, 'D7TM-30647', 242, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(496, 'D7TM-30647', 99, 'inhouse_parts', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(497, 'D7TM-30647', 19, 'customer_part', 2, '20-03-2023', 7, 20, 3, 2023, 3, 0),
(498, 'D7TM-30649', 330, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(499, 'D7TM-30649', 42, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(500, 'D7TM-30649', 41, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(501, 'D7TM-30420', 55, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(502, 'D7TM-30420', 56, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(503, 'D7TM-30420', 57, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(504, 'D7TM-30420', 58, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(505, 'D7TM-30420', 59, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0.22),
(506, 'D7TM-30420', 60, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(507, 'D7TM-30420', 61, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(508, 'D7TM-30420', 27, 'customer_part', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(509, 'D7TM-30373', 207, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(510, 'D7TM-30373', 208, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(511, 'D7TM-30373', 209, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(512, 'D7TM-30373', 210, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(513, 'D7TM-30373', 211, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0.421),
(514, 'D7TM-30373', 107, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(515, 'D7TM-30373', 20, 'customer_part', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(516, 'D7TM-30649', 43, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(517, 'D7TM-30649', 44, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0),
(518, 'D7TM-30649', 45, 'inhouse_parts', 2, '21-03-2023', 10, 21, 3, 2023, 3, 0.19),
(519, 'D7TM-30649', 46, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(520, 'D7TM-30649', 47, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(521, 'D7TM-30649', 48, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(522, 'D7TM-30649', 49, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(523, 'D7TM-30649', 50, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(524, 'D7TM-30649', 51, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0.25),
(525, 'D7TM-30649', 52, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(526, 'D7TM-30649', 53, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(527, 'D7TM-30649', 22, 'customer_part', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(528, '87551-T1N00', 266, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(529, '87551-T1N00', 267, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(530, '87551-T1N00', 268, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(531, '87551-T1N00', 269, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(532, '87551-T1N00', 270, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(533, '87551-T1N00', 271, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(534, '87551-T1N00', 272, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(535, '87551-T1N00', 273, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0),
(536, '87551-T1N00', 274, 'inhouse_parts', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0.44),
(537, '87551-T1N00', 244, 'customer_part', 2, '21-03-2023', 11, 21, 3, 2023, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `operations_bom_inputs`
--

CREATE TABLE `operations_bom_inputs` (
  `id` int(11) NOT NULL,
  `operations_bom_id` int(11) NOT NULL,
  `input_part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `input_part_table_name` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `operation_number` varchar(200) DEFAULT NULL,
  `operation_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operations_bom_inputs`
--

INSERT INTO `operations_bom_inputs` (`id`, `operations_bom_id`, `input_part_id`, `qty`, `input_part_table_name`, `created_date`, `created_time`, `day`, `month`, `year`, `created_id`, `operation_number`, `operation_description`) VALUES
(1, 1, 94, 1.71, 'child_part', '09-11-2022', 3, 9, 11, 2022, 3, 'OP-10', 'Draw'),
(2, 2, 33, 1, 'inhouse_parts', '09-11-2022', 3, 9, 11, 2022, 3, 'OP-20', 'Trim'),
(3, 3, 34, 1, 'inhouse_parts', '09-11-2022', 3, 9, 11, 2022, 3, 'OP-30', 'Notching'),
(4, 4, 35, 1, 'inhouse_parts', '09-11-2022', 3, 9, 11, 2022, 3, 'OP-40', 'Forming'),
(5, 5, 36, 1, 'inhouse_parts', '09-11-2022', 3, 9, 11, 2022, 3, 'OP-50', 'FINAL INSPECTION'),
(6, 6, 1, 2, 'child_part', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-60', 'CO2 ASSEMBLY'),
(7, 6, 172, 1, 'child_part', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-60', 'CO2 ASSEMBLY'),
(8, 7, 37, 1, 'inhouse_parts', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-70', 'SPOT WELDING'),
(9, 7, 38, 1, 'inhouse_parts', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-70', 'SPOT WELDING'),
(19, 16, 29, 1, 'inhouse_parts', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-70', 'SPOT WELDING'),
(20, 16, 38, 1, 'inhouse_parts', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-70', 'SPOT WELDING'),
(21, 17, 31, 1, 'inhouse_parts', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-80', 'CO2 WELDING'),
(22, 18, 32, 1, 'inhouse_parts', '09-11-2022', 4, 9, 11, 2022, 3, 'OP-90', 'FINAL INSPECTION'),
(23, 19, 10, 1, 'child_part', '09-11-2022', 5, 9, 11, 2022, 3, 'OP-10', 'CO2 ASSEMBLY'),
(24, 19, 26, 1, 'child_part', '09-11-2022', 5, 9, 11, 2022, 3, 'OP-10', 'CO2 ASSEMBLY'),
(25, 19, 32, 1, 'child_part', '09-11-2022', 5, 9, 11, 2022, 3, 'OP-10', 'CO2 ASSEMBLY'),
(26, 19, 12, 2, 'child_part', '09-11-2022', 5, 9, 11, 2022, 3, 'OP-10', 'CO2 ASSEMBLY'),
(27, 23, 124, 0.71, 'child_part', '15-11-2022', 5, 15, 11, 2022, 3, 'OP10', 'BLANKING & PIERCING'),
(28, 25, 41, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP20', 'FORMING'),
(29, 27, 42, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP30', 'PRE BENDING'),
(30, 29, 43, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP40', 'FINAL BENDING & RESTRIKE'),
(31, 31, 44, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(32, 33, 125, 0.64, 'child_part', '15-11-2022', 5, 15, 11, 2022, 3, 'OP10', 'BLANKING'),
(33, 35, 46, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP20', 'FORMING'),
(34, 37, 47, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP30', 'FLANGE & RESTRIKE'),
(35, 39, 48, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP40', '2 STAGE PIERCING'),
(36, 41, 49, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP50', 'CAM PIERCING'),
(37, 43, 50, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(38, 45, 51, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP10', 'Spot Welding (30119 and Washer)'),
(39, 45, 5, 1, 'child_part', '15-11-2022', 5, 15, 11, 2022, 3, 'OP10', 'Spot Welding (30119 and Washer)'),
(40, 47, 52, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP20', 'CO2 ASSEMBLY (30117 AND 30119)'),
(41, 47, 45, 1, 'inhouse_parts', '15-11-2022', 5, 15, 11, 2022, 3, 'OP20', 'CO2 ASSEMBLY (30117 AND 30119)'),
(42, 51, 136, 1, 'child_part', '15-11-2022', 5, 15, 11, 2022, 3, 'OP40', 'FINAL INSPECTION'),
(43, 192, 151, 1, 'child_part', '15-11-2022', 7, 15, 11, 2022, 3, 'OP10', 'BLANKING'),
(44, 193, 55, 1, 'inhouse_parts', '15-11-2022', 7, 15, 11, 2022, 3, 'OP20', 'FORMING'),
(45, 194, 56, 1, 'inhouse_parts', '15-11-2022', 7, 15, 11, 2022, 3, 'OP30', ' FORMING & RESTRIKE'),
(46, 195, 57, 1, 'inhouse_parts', '15-11-2022', 7, 15, 11, 2022, 3, 'OP40', 'PIERCING '),
(47, 196, 58, 1, 'inhouse_parts', '15-11-2022', 7, 15, 11, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(49, 197, 8, 3, 'child_part', '15-11-2022', 7, 15, 11, 2022, 3, 'OP10', 'Nut Projection Welding (D7TM-30367 AND D7TM-30464)'),
(50, 198, 60, 1, 'inhouse_parts', '15-11-2022', 7, 15, 11, 2022, 3, 'OP20', 'CO2 ASSEMBLY (30367,30481 and 30692)'),
(51, 198, 29, 1, 'child_part', '15-11-2022', 7, 15, 11, 2022, 3, 'OP20', 'CO2 ASSEMBLY (30367,30481 and 30692)'),
(52, 198, 7, 1, 'child_part', '15-11-2022', 7, 15, 11, 2022, 3, 'OP20', 'CO2 ASSEMBLY (30367,30481 and 30692)'),
(53, 199, 137, 1, 'child_part', '15-11-2022', 7, 15, 11, 2022, 3, 'OP40', 'FINAL INSPECTION'),
(54, 53, 154, 1, 'child_part', '15-11-2022', 8, 15, 11, 2022, 3, 'OP10', 'PROGRESSIVE BLANKING AND FORMING'),
(55, 55, 76, 1, 'inhouse_parts', '15-11-2022', 8, 15, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(56, 57, 399, 0.047, 'child_part', '15-11-2022', 9, 15, 11, 2022, 3, 'OP10', 'PROGRESSIVE BLANKING AND FORMING'),
(57, 59, 78, 1, 'inhouse_parts', '15-11-2022', 9, 15, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(58, 61, 77, 1, 'inhouse_parts', '15-11-2022', 9, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89831,30236,30544)'),
(59, 61, 79, 1, 'inhouse_parts', '15-11-2022', 9, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89831,30236,30544)'),
(60, 61, 44, 1, 'child_part', '15-11-2022', 9, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89831,30236,30544)'),
(61, 63, 138, 1, 'child_part', '15-11-2022', 9, 15, 11, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(62, 200, 45, 1, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89721,30234,30546)'),
(63, 200, 27, 1, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89721,30234,30546)'),
(64, 200, 32, 1, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89721,30234,30546)'),
(65, 201, 140, 1, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(66, 69, 155, 1, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'PROGRESSIVE BLANKING AND FORMING'),
(67, 71, 78, 1, 'inhouse_parts', '15-11-2022', 10, 15, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(68, 73, 79, 1, 'inhouse_parts', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89731,30236 and 89712)'),
(69, 73, 11, 1, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89731,30236 and 89712)'),
(70, 73, 12, 2, 'child_part', '15-11-2022', 10, 15, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (89731,30236 and 89712)'),
(71, 75, 106, 1, 'inhouse_parts', '15-11-2022', 10, 15, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(75, 81, 265, 0.54, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'BLANKING'),
(76, 83, 91, 1, 'inhouse_parts', '16-11-2022', 5, 16, 11, 2022, 3, 'OP20', 'Top Piercing '),
(77, 85, 92, 1, 'inhouse_parts', '16-11-2022', 5, 16, 11, 2022, 3, 'OP30', 'FORMING I'),
(78, 87, 93, 1, 'inhouse_parts', '16-11-2022', 5, 16, 11, 2022, 3, 'OP40', ' FORMING II'),
(79, 89, 94, 1, 'inhouse_parts', '16-11-2022', 5, 16, 11, 2022, 3, 'OP50', 'Horn Piercing '),
(80, 91, 95, 1, 'inhouse_parts', '16-11-2022', 5, 16, 11, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(81, 93, 96, 1, 'inhouse_parts', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (30382 and 30487)'),
(82, 93, 14, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (30382 and 30487)'),
(83, 95, 143, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(84, 204, 39, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'Rivetting (30120 and 30115)'),
(85, 204, 21, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'Rivetting (30120 and 30115)'),
(86, 205, 150, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(91, 202, 82, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'Rivetting (30114 and 30115)'),
(92, 202, 21, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP10', 'Rivetting (30114 and 30115)'),
(93, 203, 149, 1, 'child_part', '16-11-2022', 5, 16, 11, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(94, 97, 164, 1, 'child_part', '16-11-2022', 7, 16, 11, 2022, 3, 'OP10', 'BLANKING'),
(95, 99, 82, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP20', 'FORMING'),
(96, 101, 83, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP30', 'FORMING'),
(97, 103, 84, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP40', 'FORMING'),
(99, 107, 86, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(100, 109, 87, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (30372 and 30675)'),
(101, 109, 20, 1, 'child_part', '16-11-2022', 7, 16, 11, 2022, 3, 'OP10', 'CO2 ASSEMBLY (30372 and 30675)'),
(102, 111, 88, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP20', 'Rivetting (30371 and 30115)'),
(103, 111, 21, 1, 'child_part', '16-11-2022', 7, 16, 11, 2022, 3, 'OP20', 'Rivetting (30371 and 30115)'),
(104, 113, 144, 1, 'child_part', '16-11-2022', 7, 16, 11, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(105, 167, 131, 0.81, 'child_part', '16-11-2022', 7, 16, 11, 2022, 3, 'OP10', 'BLANKING'),
(106, 169, 1, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP20', 'PRE-PIERCING'),
(107, 171, 2, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP30', 'FORMING'),
(108, 173, 3, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP40', 'FORMING'),
(109, 175, 4, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP50', 'FORMING'),
(110, 177, 5, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP60', 'PIERCING '),
(111, 179, 6, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP70', 'FOLDING'),
(112, 181, 7, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP80', 'FOLDING'),
(113, 183, 8, 1, 'inhouse_parts', '16-11-2022', 7, 16, 11, 2022, 3, 'OP90', 'FINAL INSPECTION'),
(120, 147, 148, 1, 'child_part', '16-11-2022', 8, 16, 11, 2022, 3, 'op70', 'FINAL INSPECTION'),
(121, 115, 165, 1.43, 'child_part', '16-11-2022', 8, 16, 11, 2022, 3, 'OP10', 'BLANKING'),
(122, 117, 66, 1, 'inhouse_parts', '16-11-2022', 8, 16, 11, 2022, 3, 'OP20', 'Top Piercing '),
(144, 206, 184, 0.56, 'child_part', '27-11-2022', 11, 27, 11, 2022, 3, '10', 'BLANKING'),
(145, 207, 120, 1, 'inhouse_parts', '27-11-2022', 11, 27, 11, 2022, 3, '', 'FINAL INSPECTION'),
(146, 208, 113, 1, 'inhouse_parts', '29-11-2022', 12, 29, 11, 2022, 3, 'OP20', '2 STAGE FORMING'),
(147, 209, 114, 1, 'inhouse_parts', '29-11-2022', 12, 29, 11, 2022, 3, 'OP30', 'RESTRIKE'),
(148, 210, 115, 1, 'inhouse_parts', '29-11-2022', 6, 29, 11, 2022, 3, 'OP40', 'PIERCING '),
(149, 211, 116, 1, 'inhouse_parts', '29-11-2022', 6, 29, 11, 2022, 3, 'OP50', 'SEMI-PIERCING'),
(150, 212, 117, 1, 'inhouse_parts', '29-11-2022', 6, 29, 11, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(151, 213, 118, 1, 'inhouse_parts', '29-11-2022', 6, 29, 11, 2022, 3, 'OP10', 'PROJECTION WELDING '),
(152, 213, 86, 2, 'child_part', '29-11-2022', 6, 29, 11, 2022, 3, 'OP10', 'PROJECTION WELDING '),
(153, 214, 119, 1, 'inhouse_parts', '29-11-2022', 6, 29, 11, 2022, 3, 'OP20', 'CO2 WELDING'),
(154, 216, 185, 0.56, 'child_part', '29-11-2022', 7, 29, 11, 2022, 3, 'OP10', 'BLANKING'),
(155, 217, 122, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP20', '2 STAGE FORMING'),
(156, 218, 123, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP30', 'RESTRIKE'),
(157, 219, 124, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP40', 'PIERCING'),
(158, 220, 125, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP50', 'SEMI-PIERCING'),
(159, 238, 126, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(160, 239, 127, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP10', 'PROJECTION WELDING '),
(161, 239, 86, 2, 'child_part', '30-11-2022', 4, 30, 11, 2022, 3, 'OP10', 'PROJECTION WELDING '),
(162, 222, 128, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP20', 'CO2 WELDING'),
(163, 215, 129, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(164, 240, 186, 0.9, 'child_part', '30-11-2022', 4, 30, 11, 2022, 3, 'OP10', 'BLANKING'),
(165, 223, 187, 0.9, 'child_part', '30-11-2022', 4, 30, 11, 2022, 3, 'OP10', 'BLANKING'),
(166, 224, 135, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP20', '2 STAGE FORMING'),
(167, 225, 136, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP30', 'RESTRIKE'),
(168, 226, 137, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP40', 'PIERCING'),
(169, 227, 138, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP50', 'NOTCHING'),
(170, 228, 139, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(171, 237, 147, 1, 'child_part', '30-11-2022', 4, 30, 11, 2022, 3, 'OP10', 'BLANKING & PIERCING'),
(172, 230, 140, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP20', 'FORMING 1'),
(173, 231, 141, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP30', 'PIERCING & NOTCHING'),
(174, 232, 142, 1, 'inhouse_parts', '30-11-2022', 4, 30, 11, 2022, 3, 'OP40', 'FORMING 2'),
(175, 233, 143, 1, 'inhouse_parts', '30-11-2022', 5, 30, 11, 2022, 3, 'OP50', 'FORMING 3'),
(176, 234, 144, 1, 'inhouse_parts', '30-11-2022', 5, 30, 11, 2022, 3, 'OP60', 'CAM PIERCING'),
(177, 235, 145, 1, 'inhouse_parts', '30-11-2022', 5, 30, 11, 2022, 3, 'OP70', 'FINAL INSPECTION'),
(178, 241, 199, 0.82, 'child_part', '30-11-2022', 9, 30, 11, 2022, 3, 'OP10', 'BLANKING'),
(179, 242, 220, 1, 'child_part', '30-11-2022', 9, 30, 11, 2022, 3, 'OP40', 'PIERCING'),
(180, 243, 149, 1, 'inhouse_parts', '30-11-2022', 9, 30, 11, 2022, 3, 'OP50', 'NOTCHING-2 STAGE'),
(181, 244, 150, 1, 'inhouse_parts', '30-11-2022', 9, 30, 11, 2022, 3, 'OP60', 'TRIMMING-2 STAGE'),
(182, 245, 151, 1, 'inhouse_parts', '30-11-2022', 9, 30, 11, 2022, 3, 'OP70', 'CHAMPHERING'),
(183, 246, 152, 1, 'inhouse_parts', '30-11-2022', 9, 30, 11, 2022, 3, 'OP80', 'FINAL INSPECTION'),
(184, 247, 200, 0.15, 'child_part', '01-12-2022', 7, 1, 12, 2022, 3, 'OP10', 'BLANKING'),
(185, 248, 154, 1, 'inhouse_parts', '01-12-2022', 7, 1, 12, 2022, 3, 'OP20', 'FORMING'),
(186, 249, 198, 0.1, 'child_part', '01-12-2022', 7, 1, 12, 2022, 3, 'OP10', 'BLANKING'),
(187, 250, 156, 1, 'inhouse_parts', '01-12-2022', 7, 1, 12, 2022, 3, 'OP20', 'FORMING'),
(188, 251, 157, 1, 'inhouse_parts', '01-12-2022', 7, 1, 12, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(189, 252, 197, 0.98, 'child_part', '01-12-2022', 7, 1, 12, 2022, 3, 'OP10', 'BLANKING'),
(190, 253, 159, 1, 'inhouse_parts', '01-12-2022', 7, 1, 12, 2022, 3, 'OP20', 'PIERCING '),
(191, 254, 160, 1, 'inhouse_parts', '01-12-2022', 7, 1, 12, 2022, 3, 'OP30', 'BENDING'),
(192, 255, 161, 1, 'inhouse_parts', '01-12-2022', 7, 1, 12, 2022, 3, 'OP40', 'FINAL INSPECTION'),
(193, 236, 146, 1, 'inhouse_parts', '04-12-2022', 6, 4, 12, 2022, 3, 'OP80', 'CED COATING'),
(194, 229, 191, 0.791, 'child_part', '04-12-2022', 6, 4, 12, 2022, 3, 'OP05', 'SHEARING'),
(195, 271, 225, 1, 'child_part', '04-12-2022', 6, 4, 12, 2022, 3, 'OP20', 'CED COATING'),
(196, 272, 226, 1, 'child_part', '04-12-2022', 6, 4, 12, 2022, 3, 'OP20', 'CED COATING'),
(197, 256, 153, 1, 'inhouse_parts', '04-12-2022', 7, 4, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(198, 256, 158, 1, 'inhouse_parts', '04-12-2022', 7, 4, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(199, 256, 162, 1, 'inhouse_parts', '04-12-2022', 7, 4, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(200, 256, 31, 1, 'child_part', '04-12-2022', 7, 4, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(201, 256, 47, 1, 'child_part', '04-12-2022', 7, 4, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(202, 273, 229, 1, 'child_part', '04-12-2022', 7, 4, 12, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(203, 274, 93, 1.56, 'child_part', '06-12-2022', 6, 6, 12, 2022, 3, 'OP10', 'DRAW'),
(204, 275, 165, 1, 'inhouse_parts', '06-12-2022', 6, 6, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(205, 276, 162, 0.85, 'child_part', '10-12-2022', 4, 10, 12, 2022, 3, 'OP10', 'BLANKING'),
(206, 277, 207, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP20', 'FORMING'),
(207, 278, 208, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP30', 'FORMING'),
(208, 279, 209, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP40', 'CAM PIERCING'),
(209, 280, 210, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(210, 281, 211, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP10', 'CO2 ASSEMBLY (30374and 30487)'),
(211, 281, 14, 1, 'child_part', '10-12-2022', 4, 10, 12, 2022, 3, 'OP10', 'CO2 ASSEMBLY (30374and 30487)'),
(212, 282, 107, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP20', 'Tumble Bkt. wth Norglide Bush Assy. IB 40P -CED'),
(213, 283, 108, 1, 'inhouse_parts', '10-12-2022', 4, 10, 12, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(214, 284, 111, 1, 'inhouse_parts', '11-12-2022', 10, 11, 12, 2022, 3, 'OP20', 'CED COATING'),
(215, 285, 101, 1, 'inhouse_parts', '11-12-2022', 10, 11, 12, 2022, 3, 'OP20', 'CED COATING'),
(216, 286, 109, 1, 'inhouse_parts', '11-12-2022', 11, 11, 12, 2022, 3, 'OP20', 'CED COATING'),
(217, 287, 23, 1, 'inhouse_parts', '11-12-2022', 11, 11, 12, 2022, 3, 'OP70', 'CED COATING'),
(218, 288, 8, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(219, 289, 212, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(220, 288, 127, 2, 'child_part', '11-12-2022', 1, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(221, 290, 16, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(222, 290, 127, 2, 'child_part', '11-12-2022', 1, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(223, 291, 214, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(224, 292, 214, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(225, 292, 65, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(226, 293, 216, 1, 'inhouse_parts', '11-12-2022', 1, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(227, 294, 212, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(228, 294, 65, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(229, 295, 218, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(230, 296, 16, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(231, 296, 65, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(232, 297, 220, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(233, 298, 8, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(234, 298, 65, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(235, 299, 222, 1, 'inhouse_parts', '11-12-2022', 2, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(236, 300, 231, 1, 'child_part', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'FINAL INSPECTION'),
(237, 301, 231, 1, 'child_part', '11-12-2022', 2, 11, 12, 2022, 3, 'OP10', 'FINAL INSPECTION'),
(238, 308, 230, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(239, 307, 153, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(240, 307, 234, 2, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(241, 306, 233, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(242, 305, 232, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP40', 'TRIM AND PIERCE'),
(243, 304, 231, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP30', 'RESTRIKE'),
(244, 303, 203, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP20', 'FORMING'),
(245, 302, 195, 0.48, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'BLANKING'),
(246, 309, 194, 0.7, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'BLANKING'),
(247, 310, 238, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP40', 'RESTRIKE'),
(248, 311, 226, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP50', 'PIERCING'),
(249, 312, 239, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(250, 312, 117, 2, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(251, 313, 240, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(252, 314, 67, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(253, 314, 103, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(254, 314, 104, 1, 'child_part', '11-12-2022', 4, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(255, 315, 235, 1, 'inhouse_parts', '11-12-2022', 4, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(256, 316, 241, 1, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(257, 316, 103, 1, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(258, 316, 104, 1, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(259, 317, 236, 1, 'inhouse_parts', '11-12-2022', 5, 11, 12, 2022, 3, 'OP20', 'FINAL INSPECTION'),
(260, 318, 156, 0.589, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP10', 'BLANKING'),
(261, 319, 237, 1, 'inhouse_parts', '11-12-2022', 5, 11, 12, 2022, 3, 'OP20', 'FORMING'),
(262, 320, 238, 1, 'inhouse_parts', '11-12-2022', 5, 11, 12, 2022, 3, 'OP30', 'FLANGE & RESTRIKE'),
(263, 321, 239, 1, 'inhouse_parts', '11-12-2022', 5, 11, 12, 2022, 3, 'OP40', 'PIERCING'),
(264, 322, 240, 1, 'inhouse_parts', '11-12-2022', 5, 11, 12, 2022, 3, 'OP50', 'TOP PIERCING'),
(265, 323, 241, 1, 'inhouse_parts', '11-12-2022', 5, 11, 12, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(267, 324, 32, 1, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(268, 324, 12, 2, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(269, 325, 139, 1, 'child_part', '11-12-2022', 5, 11, 12, 2022, 3, 'OP30', 'FINAL INSPECTION'),
(270, 326, 131, 0.81, 'child_part', '13-12-2022', 6, 13, 12, 2022, 3, 'OP10', 'BLANKING'),
(271, 327, 9, 1, 'inhouse_parts', '13-12-2022', 6, 13, 12, 2022, 3, 'OP20', 'PRE-PIERCING'),
(272, 328, 10, 1, 'inhouse_parts', '13-12-2022', 6, 13, 12, 2022, 3, 'OP30', 'FORMING 1'),
(273, 329, 11, 1, 'inhouse_parts', '13-12-2022', 6, 13, 12, 2022, 3, 'OP40', 'FORMING 2'),
(274, 330, 12, 1, 'inhouse_parts', '13-12-2022', 7, 13, 12, 2022, 3, 'OP50', 'PIERCING 1'),
(275, 331, 13, 1, 'inhouse_parts', '13-12-2022', 7, 13, 12, 2022, 3, 'OP60', 'PIERCING2'),
(276, 332, 14, 1, 'inhouse_parts', '13-12-2022', 7, 13, 12, 2022, 3, 'OP70', 'FOLDING 1'),
(277, 333, 15, 1, 'inhouse_parts', '13-12-2022', 7, 13, 12, 2022, 3, 'OP80', 'FOLDING2'),
(278, 334, 16, 1, 'inhouse_parts', '13-12-2022', 7, 13, 12, 2022, 3, 'OP90', 'FINAL INSPECTION'),
(279, 335, 95, 2.41, 'child_part', '17-12-2022', 9, 17, 12, 2022, 3, 'OP10', 'BLANKING'),
(280, 336, 25, 1, 'inhouse_parts', '17-12-2022', 9, 17, 12, 2022, 3, 'OP20', 'TRIMMING'),
(281, 337, 26, 1, 'inhouse_parts', '17-12-2022', 9, 17, 12, 2022, 3, 'OP30', 'Notching'),
(282, 338, 27, 1, 'inhouse_parts', '17-12-2022', 9, 17, 12, 2022, 3, 'OP40', 'Forming'),
(283, 339, 28, 1, 'inhouse_parts', '17-12-2022', 9, 17, 12, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(284, 340, 1, 2, 'child_part', '23-12-2022', 4, 23, 12, 2022, 3, 'OP60', 'WIRE ASSEMBLY'),
(285, 340, 172, 1, 'child_part', '23-12-2022', 4, 23, 12, 2022, 3, 'OP60', 'WIRE ASSEMBLY'),
(286, 341, 29, 1, 'inhouse_parts', '23-12-2022', 4, 23, 12, 2022, 3, 'OP70', 'SPOT WELDING'),
(287, 341, 30, 1, 'inhouse_parts', '23-12-2022', 4, 23, 12, 2022, 3, 'OP70', 'SPOT WELDING'),
(288, 342, 31, 1, 'inhouse_parts', '23-12-2022', 4, 23, 12, 2022, 3, 'OP80', 'CO2 WELDING ASSEMBLY'),
(289, 343, 32, 1, 'inhouse_parts', '23-12-2022', 4, 23, 12, 2022, 3, 'OP90', 'FINAL INSPECTION'),
(290, 8, 39, 1, 'inhouse_parts', '23-12-2022', 4, 23, 12, 2022, 3, 'OP80', 'CO2 WELDING ASSEMBLY'),
(291, 9, 40, 1, 'inhouse_parts', '23-12-2022', 4, 23, 12, 2022, 3, 'OP90', 'FINAL INSPECTION'),
(292, 344, 204, 0.09, 'child_part', '25-12-2022', 11, 25, 12, 2022, 3, 'OP10', 'BLANKING'),
(293, 345, 168, 1, 'inhouse_parts', '25-12-2022', 11, 25, 12, 2022, 3, 'OP20', 'BENDING'),
(294, 346, 169, 1, 'inhouse_parts', '25-12-2022', 11, 25, 12, 2022, 3, 'OP30', 'INSPECTION BEFORE PLATING'),
(295, 347, 252, 1, 'child_part', '25-12-2022', 11, 25, 12, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(296, 348, 205, 1.21, 'child_part', '25-12-2022', 11, 25, 12, 2022, 3, 'OP10', 'BLANKING'),
(297, 350, 172, 1, 'inhouse_parts', '25-12-2022', 11, 25, 12, 2022, 3, 'OP30', 'FORMING'),
(298, 351, 173, 1, 'inhouse_parts', '25-12-2022', 11, 25, 12, 2022, 3, 'OP40', 'INSPECTION BEFORE WELDING'),
(299, 352, 174, 1, 'inhouse_parts', '25-12-2022', 11, 25, 12, 2022, 3, 'OP50', 'CO2 WELDING ASSEMBLY'),
(300, 352, 254, 1, 'child_part', '25-12-2022', 11, 25, 12, 2022, 3, 'OP50', 'CO2 WELDING ASSEMBLY'),
(301, 353, 255, 1, 'child_part', '25-12-2022', 12, 25, 12, 2022, 3, 'OP80', 'FINAL INSPECTION(PDI)'),
(302, 267, 257, 1, 'child_part', '25-12-2022', 12, 25, 12, 2022, 3, 'OP10', 'PIERCING 1'),
(303, 268, 194, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP20', 'PIERCING 2'),
(304, 269, 195, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP30', 'EMBOSSING'),
(305, 270, 196, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP40', 'FINAL INSPECTION(PDI)'),
(306, 262, 257, 1, 'child_part', '25-12-2022', 12, 25, 12, 2022, 3, 'OP10', 'EMBOSS 1'),
(307, 263, 197, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP20', 'PIERCING 1'),
(308, 264, 198, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP30', 'PIERCING 2'),
(309, 265, 199, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP40', 'EMBOSSING 2'),
(310, 266, 200, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP50', 'FINAL INSPECTION'),
(311, 354, 208, 1.69, 'child_part', '25-12-2022', 12, 25, 12, 2022, 3, 'OP10', 'BLANKING '),
(312, 355, 188, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP20', 'PIERCING'),
(313, 356, 189, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP30', 'FORMING'),
(314, 357, 190, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP40', 'FINAL INSPECTION'),
(315, 358, 191, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP50', 'NUT PROJECTION WELDING'),
(316, 358, 71, 3, 'child_part', '25-12-2022', 12, 25, 12, 2022, 3, 'OP50', 'NUT PROJECTION WELDING'),
(317, 359, 192, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP60', 'CO2 WELDING'),
(318, 360, 193, 1, 'inhouse_parts', '25-12-2022', 12, 25, 12, 2022, 3, 'OP70', 'FINAL INSPECTION(PDI)'),
(321, 361, 169, 0.09, 'child_part', '27-12-2022', 2, 27, 12, 2022, 3, 'OP10', 'BLANKING'),
(322, 362, 63, 1, 'inhouse_parts', '27-12-2022', 2, 27, 12, 2022, 3, 'OP20', 'FORMING'),
(323, 363, 64, 1, 'inhouse_parts', '27-12-2022', 2, 27, 12, 2022, 3, 'OP30', 'Part off and cam piercing'),
(324, 364, 65, 1, 'inhouse_parts', '27-12-2022', 2, 27, 12, 2022, 3, 'OP40', 'FINAL INSPECTION'),
(325, 365, 250, 0.48, 'child_part', '28-12-2022', 12, 28, 12, 2022, 3, 'OP10', 'BLANKING & PIERCING'),
(326, 366, 18, 1, 'inhouse_parts', '28-12-2022', 12, 28, 12, 2022, 3, 'OP20', 'FORM 1'),
(327, 367, 19, 1, 'inhouse_parts', '28-12-2022', 12, 28, 12, 2022, 3, 'OP30', 'FORM 2'),
(328, 368, 20, 1, 'inhouse_parts', '28-12-2022', 12, 28, 12, 2022, 3, 'D7TM30108OP40', 'PIERCING '),
(329, 369, 21, 1, 'inhouse_parts', '28-12-2022', 12, 28, 12, 2022, 3, 'OP50', 'CAM PIERCING'),
(330, 370, 22, 1, 'inhouse_parts', '28-12-2022', 12, 28, 12, 2022, 3, 'OP60', 'FINAL INSPECTION'),
(331, 371, 273, 0.88, 'child_part', '14-01-2023', 4, 14, 1, 2023, 3, 'OP10', 'BLANKING'),
(332, 372, 176, 1, 'inhouse_parts', '14-01-2023', 5, 14, 1, 2023, 3, 'OP20', 'PIERCING'),
(333, 373, 177, 1, 'inhouse_parts', '14-01-2023', 5, 14, 1, 2023, 3, 'OP30', 'FORMING'),
(334, 374, 178, 1, 'inhouse_parts', '14-01-2023', 5, 14, 1, 2023, 3, 'OP40', 'FINAL INSPECTION'),
(335, 375, 179, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(336, 375, 70, 6, 'child_part', '17-01-2023', 10, 17, 1, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(337, 376, 180, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(338, 376, 111, 3, 'child_part', '17-01-2023', 10, 17, 1, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(339, 377, 181, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(340, 378, 207, 1.1, 'child_part', '17-01-2023', 10, 17, 1, 2023, 3, 'OP10', 'BLANKING'),
(343, 379, 182, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP20', 'PIERCING'),
(344, 380, 183, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP30', 'FORMING'),
(345, 381, 184, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP40', 'FINAL INSPECTION'),
(346, 382, 185, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(347, 382, 70, 2, 'child_part', '17-01-2023', 10, 17, 1, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(348, 383, 186, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(349, 384, 187, 1, 'inhouse_parts', '17-01-2023', 10, 17, 1, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(350, 385, 303, 1.25, 'child_part', '17-01-2023', 3, 17, 1, 2023, 3, 'OP10', 'BLANKING'),
(351, 386, 247, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP20', 'DRAW'),
(352, 387, 248, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP30', 'RESTRIKE'),
(353, 388, 249, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP40', 'TRIMMING 1 & PIERCING'),
(354, 389, 250, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP50', 'TRIMMING 2 & NOTCHING'),
(355, 390, 251, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP60', 'FLANGE FORMING'),
(356, 391, 252, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP70', 'PRE HEMMING'),
(357, 392, 253, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP80', 'FINAL HEMMING'),
(358, 393, 254, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP90', 'FINAL PIERCING'),
(359, 394, 255, 1, 'inhouse_parts', '17-01-2023', 3, 17, 1, 2023, 3, 'OP100', 'FINAL INSPECTION(PDI)'),
(360, 395, 304, 1.16, 'child_part', '20-01-2023', 1, 20, 1, 2023, 3, 'OP10', 'BLANKING'),
(361, 396, 256, 1, 'inhouse_parts', '20-01-2023', 1, 20, 1, 2023, 3, 'OP20', 'PIERCING 1'),
(362, 397, 257, 1, 'inhouse_parts', '20-01-2023', 1, 20, 1, 2023, 3, 'OP30', 'FORMING'),
(363, 398, 258, 1, 'inhouse_parts', '20-01-2023', 1, 20, 1, 2023, 3, 'OP40', 'RESTRIKE'),
(364, 399, 259, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP50', 'PIERCING 2'),
(365, 400, 260, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'op60', 'PIERCING 3'),
(366, 401, 261, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'op70', 'HORN BENDING 1'),
(367, 402, 262, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP80', 'HORN BENDING 2'),
(368, 403, 263, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP90', 'FLATENING & EMBOSSING'),
(369, 404, 264, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP100', 'FINAL INSPECTION'),
(370, 405, 304, 1.16, 'child_part', '20-01-2023', 2, 20, 1, 2023, 3, 'OP10', 'BLANKING'),
(372, 406, 266, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP20', 'PIERCING 1'),
(373, 407, 267, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP30', 'FORMING'),
(374, 408, 268, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP40', 'RESTRIKE'),
(375, 409, 269, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP50', 'PIERCING 2'),
(376, 410, 270, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP60', 'PIERCING 3'),
(377, 411, 271, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP70', 'HORN BENDING 1'),
(378, 412, 272, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP80', 'HORN BENDING 2'),
(379, 413, 273, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP90', 'FLATENING & EMBOSSING'),
(380, 414, 274, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP90', 'FINAL INSPECTION'),
(382, 415, 267, 1, 'child_part', '20-01-2023', 2, 20, 1, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(383, 416, 276, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP20', 'FINAL INSPECTION(PDI)'),
(385, 417, 267, 1, 'child_part', '20-01-2023', 2, 20, 1, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(386, 418, 278, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP20', 'FINAL INSPECTION'),
(387, 420, 279, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP20', 'FINAL INSPECTION(PDI)'),
(389, 419, 305, 1, 'child_part', '20-01-2023', 2, 20, 1, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(391, 421, 305, 1, 'child_part', '20-01-2023', 2, 20, 1, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(392, 422, 277, 1, 'inhouse_parts', '20-01-2023', 2, 20, 1, 2023, 3, 'OP20', 'FINAL INSPECTION(PDI)'),
(393, 433, 165, 1.43, 'child_part', '12-02-2023', 12, 12, 2, 2023, 3, '10', 'BANKING '),
(394, 434, 66, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, '20', 'TOP PIERCING'),
(395, 435, 67, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, '30', 'FORMING 1'),
(396, 436, 68, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, '40', 'FORMING 2'),
(397, 437, 69, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, '50', 'EMBOSSING'),
(398, 438, 70, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, '60', 'HORN PIERCING'),
(399, 439, 71, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, '70', 'FINAL INSPECTION'),
(400, 440, 72, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(401, 440, 33, 1, 'child_part', '12-02-2023', 12, 12, 2, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(402, 440, 24, 2, 'child_part', '12-02-2023', 12, 12, 2, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(403, 440, 266, 1, 'child_part', '12-02-2023', 12, 12, 2, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(404, 441, 73, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, 'OP20', 'RIVETTING'),
(405, 441, 21, 1, 'child_part', '12-02-2023', 12, 12, 2, 2023, 3, 'OP20', 'RIVETTING'),
(406, 443, 145, 1, 'child_part', '12-02-2023', 12, 12, 2, 2023, 3, '', 'FINAL INSPECTION(PDI)'),
(407, 442, 74, 1, 'inhouse_parts', '12-02-2023', 12, 12, 2, 2023, 3, 'OP30', 'CED COATING'),
(408, 444, 1, 2, 'child_part', '12-02-2023', 9, 12, 2, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(409, 444, 235, 1, 'child_part', '12-02-2023', 9, 12, 2, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(411, 445, 94, 1.71, 'child_part', '12-02-2023', 9, 12, 2, 2023, 3, 'OP10', 'DRAW'),
(412, 446, 295, 1, 'inhouse_parts', '12-02-2023', 9, 12, 2, 2023, 3, 'OP20', 'TRIMING'),
(413, 447, 296, 1, 'inhouse_parts', '12-02-2023', 9, 12, 2, 2023, 3, 'OP30', 'NOTCHING'),
(414, 448, 297, 1, 'inhouse_parts', '12-02-2023', 9, 12, 2, 2023, 3, 'OP40', 'FORMING'),
(415, 450, 95, 2.41, 'child_part', '13-02-2023', 10, 13, 2, 2023, 3, 'OP10', 'DRAW'),
(416, 451, 300, 1, 'inhouse_parts', '13-02-2023', 10, 13, 2, 2023, 3, 'OP20', 'TRIMING'),
(417, 452, 301, 1, 'inhouse_parts', '13-02-2023', 10, 13, 2, 2023, 3, 'OP30', 'NOTCHING'),
(418, 453, 302, 1, 'inhouse_parts', '13-02-2023', 10, 13, 2, 2023, 3, 'OP40', 'FLANGE FORMING'),
(420, 455, 388, 0.14, 'child_part', '13-02-2023', 12, 13, 2, 2023, 3, 'OP10', 'BLANKING'),
(421, 456, 304, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP20', 'FORMING'),
(422, 457, 305, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP30', 'PART-OFF'),
(423, 458, 306, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP40', 'PIERCING '),
(424, 459, 307, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP50', 'FINAL INSPECTION'),
(426, 424, 281, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP20', 'FORMING'),
(427, 425, 282, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP30', 'RESTRIKE'),
(428, 426, 283, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP40', 'PIERCING 1'),
(429, 427, 284, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP50', 'PIERCING 2'),
(430, 460, 285, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP60', 'CAM-PIERCING'),
(431, 461, 286, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP70', 'FLARING'),
(432, 462, 287, 1, 'inhouse_parts', '13-02-2023', 12, 13, 2, 2023, 3, 'OP80', 'FINAL INSPECTION'),
(434, 429, 288, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP20', 'FORMING'),
(435, 430, 289, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP30', 'RESTRIKE'),
(436, 431, 290, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP40', 'PIERCING 1'),
(437, 432, 291, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP50', 'PIERCING 2'),
(438, 463, 292, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP60', 'CAM-PIERCING'),
(439, 464, 293, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP70', 'FLARING'),
(440, 465, 294, 1, 'inhouse_parts', '13-02-2023', 1, 13, 2, 2023, 3, 'OP80', 'FINAL INSPECTION'),
(441, 428, 390, 1.01, 'child_part', '13-02-2023', 4, 13, 2, 2023, 3, 'OP10', 'BLANKING'),
(442, 423, 390, 1.01, 'child_part', '13-02-2023', 4, 13, 2, 2023, 3, 'OP10', 'BLANKING'),
(443, 466, 298, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP10', 'SPOT WELDING'),
(444, 466, 299, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP10', 'SPOT WELDING'),
(445, 467, 33, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP20', 'CO2 WELDING'),
(446, 468, 34, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(447, 469, 303, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP10', 'SPOT WELDING'),
(448, 469, 299, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP10', 'SPOT WELDING'),
(449, 470, 25, 1, 'inhouse_parts', '17-02-2023', 12, 17, 2, 2023, 3, 'OP20', 'CO2 WELDING'),
(450, 471, 26, 1, 'inhouse_parts', '17-02-2023', 1, 17, 2, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(451, 324, 242, 1, 'inhouse_parts', '21-02-2023', 4, 21, 2, 2023, 3, 'OP10', 'CO2 WELDING'),
(452, 324, 26, 1, 'child_part', '21-02-2023', 4, 21, 2, 2023, 3, 'OP10', 'CO2 WELDING'),
(453, 472, 309, 1, 'inhouse_parts', '02-03-2023', 7, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(454, 472, 397, 2, 'child_part', '02-03-2023', 7, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(455, 473, 311, 1, 'inhouse_parts', '02-03-2023', 7, 2, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(456, 473, 391, 1, 'child_part', '02-03-2023', 7, 2, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(457, 474, 312, 1, 'inhouse_parts', '02-03-2023', 7, 2, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(458, 475, 310, 1, 'inhouse_parts', '02-03-2023', 7, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(459, 475, 397, 2, 'child_part', '02-03-2023', 7, 2, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(460, 476, 313, 1, 'inhouse_parts', '02-03-2023', 7, 2, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(461, 476, 391, 1, 'child_part', '02-03-2023', 7, 2, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(462, 477, 314, 1, 'inhouse_parts', '02-03-2023', 7, 2, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(463, 478, 314, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(464, 478, 398, 3, 'child_part', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(465, 479, 315, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP20', 'CO2 TACK WELDING'),
(466, 480, 316, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(467, 481, 312, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(468, 481, 398, 3, 'child_part', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(469, 482, 317, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP20', 'CO2 TACK WELDING'),
(470, 483, 318, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(471, 484, 314, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(472, 484, 396, 1, 'child_part', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(473, 485, 319, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP20', 'FINAL INSPECTION(PDI)'),
(474, 487, 320, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP20', 'FINAL INSPECTION(PDI)'),
(475, 486, 312, 1, 'inhouse_parts', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(476, 486, 396, 1, 'child_part', '02-03-2023', 8, 2, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(478, 488, 117, 2, 'child_part', '10-03-2023', 5, 10, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(479, 489, 400, 1, 'child_part', '10-03-2023', 5, 10, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(480, 260, 28, 1, 'child_part', '15-03-2023', 2, 15, 3, 2023, 3, 'OP10', 'GASKET ASSLY'),
(481, 260, 46, 1, 'child_part', '15-03-2023', 2, 15, 3, 2023, 3, 'OP10', 'GASKET ASSLY'),
(482, 261, 167, 1, 'inhouse_parts', '15-03-2023', 2, 15, 3, 2023, 3, 'OP20', 'FINAL INSPECTION'),
(483, 488, 239, 1, 'child_part', '17-03-2023', 6, 17, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(485, 490, 156, 0.589, 'child_part', '20-03-2023', 7, 20, 3, 2023, 3, 'OP10', 'BLANKING'),
(486, 491, 237, 1, 'inhouse_parts', '20-03-2023', 7, 20, 3, 2023, 3, 'OP20', 'FORMING'),
(487, 492, 238, 1, 'inhouse_parts', '20-03-2023', 7, 20, 3, 2023, 3, 'OP30', 'FLANGE & RESTRIKE'),
(488, 493, 239, 1, 'inhouse_parts', '20-03-2023', 7, 20, 3, 2023, 3, 'OP40', 'PIERCING'),
(489, 494, 240, 1, 'inhouse_parts', '20-03-2023', 7, 20, 3, 2023, 3, 'OP50', 'TOP PIERCING'),
(490, 495, 241, 1, 'inhouse_parts', '20-03-2023', 7, 20, 3, 2023, 3, 'OP60', 'FINAL INSPECTION'),
(491, 496, 242, 1, 'inhouse_parts', '20-03-2023', 7, 20, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(492, 496, 26, 1, 'child_part', '20-03-2023', 7, 20, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(493, 496, 32, 1, 'child_part', '20-03-2023', 7, 20, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(494, 496, 12, 2, 'child_part', '20-03-2023', 7, 20, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(495, 497, 139, 1, 'child_part', '20-03-2023', 7, 20, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(496, 197, 6, 1, 'child_part', '20-03-2023', 7, 20, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(497, 506, 6, 1, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(498, 506, 8, 3, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP10', 'PROJECTION WELDING'),
(499, 507, 60, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(500, 507, 29, 1, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(501, 507, 7, 1, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(502, 508, 137, 1, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP40', 'FINAL INSPECTION(PDI)'),
(503, 509, 162, 0.85, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP10', 'BLANKING'),
(504, 510, 207, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP20', 'FORMING 1'),
(505, 511, 208, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP30', 'FORMING 2'),
(506, 512, 209, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP40', 'CAM-PIERCING'),
(507, 513, 210, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP50', 'FINAL INSPECTION'),
(508, 514, 211, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(509, 514, 14, 1, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(510, 515, 142, 1, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP30', 'FINAL INSPECTION(PDI)'),
(511, 500, 124, 0.71, 'child_part', '21-03-2023', 10, 21, 3, 2023, 3, 'OP10', 'BLANKING'),
(512, 499, 41, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP20', 'FORMING 1'),
(513, 516, 42, 1, 'inhouse_parts', '21-03-2023', 10, 21, 3, 2023, 3, 'OP30', 'PRE BENDING'),
(514, 517, 43, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP40', 'FINAL BENDING & RESTRIKE'),
(515, 518, 44, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP50', 'FINAL INSPECTION'),
(516, 527, 136, 1, 'child_part', '21-03-2023', 11, 21, 3, 2023, 3, 'OP40', 'FINAL INSPECTION(PDI)'),
(517, 526, 52, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(518, 526, 45, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP20', 'CO2 WELDING ASSEMBLY'),
(519, 525, 51, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'SPOT WELDING'),
(520, 525, 5, 1, 'child_part', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'SPOT WELDING'),
(521, 519, 125, 0.64, 'child_part', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'BLANKING'),
(522, 520, 46, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP20', 'FORMING'),
(523, 521, 47, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP30', 'FLANGE & RESTRIKE'),
(524, 522, 48, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP40', '2 STAGE PIERCING'),
(525, 523, 49, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP50', 'CAM PIERCING'),
(526, 524, 50, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP60', 'FINAL INSPECTION'),
(527, 421, 274, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(528, 415, 274, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(529, 417, 264, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(530, 419, 264, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'CO2 WELDING ASSEMBLY'),
(531, 528, 304, 1.16, 'child_part', '21-03-2023', 11, 21, 3, 2023, 3, 'OP10', 'BLANKING'),
(532, 529, 266, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP20', 'PIERCING 1'),
(533, 530, 267, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP30', 'FORMING'),
(534, 531, 268, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP40', 'RESTRIKE'),
(535, 532, 269, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP50', 'PIERCING 2'),
(536, 533, 270, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP60', 'PIERCING 3'),
(537, 534, 271, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP70', 'HORN BENDING 1'),
(538, 535, 272, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP80', 'HORN BENDING 2'),
(539, 536, 273, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP90', 'FLATENING & EMBOSSING'),
(540, 537, 274, 1, 'inhouse_parts', '21-03-2023', 11, 21, 3, 2023, 3, 'OP100', 'FINAL INSPECTION'),
(541, 349, 171, 1, 'inhouse_parts', '21-03-2023', 12, 21, 3, 2023, 3, 'OP20', 'PIERCING'),
(542, 105, 85, 1, 'inhouse_parts', '28-03-2023', 4, 28, 3, 2023, 3, 'OP50', 'CAM-PIERCING');

-- --------------------------------------------------------

--
-- Table structure for table `operation_data`
--

CREATE TABLE `operation_data` (
  `id` int(11) NOT NULL,
  `operation_name` varchar(100) DEFAULT NULL,
  `product` text NOT NULL,
  `process` text NOT NULL,
  `specification_tolerance` text NOT NULL,
  `evalution` text NOT NULL,
  `size` text NOT NULL,
  `frequency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `other_data`
--

CREATE TABLE `other_data` (
  `id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `type` varchar(15) NOT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parts_customer_trackings`
--

CREATE TABLE `parts_customer_trackings` (
  `id` int(11) NOT NULL,
  `customer_po_tracking_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `approval_date` varchar(20) DEFAULT NULL,
  `approval_by` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `accepted_qty` float DEFAULT NULL,
  `rejected_qty` float DEFAULT NULL,
  `rejection_reason` varchar(20) DEFAULT NULL,
  `rejection_remark` varchar(20) DEFAULT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts_customer_trackings`
--

INSERT INTO `parts_customer_trackings` (`id`, `customer_po_tracking_id`, `part_id`, `qty`, `remark`, `status`, `approval_date`, `approval_by`, `customer_id`, `created_by`, `created_date`, `created_time`, `accepted_qty`, `rejected_qty`, `rejection_reason`, `rejection_remark`, `created_day`, `created_month`, `created_year`) VALUES
(11, 11, 226, 99999, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:12:55', NULL, NULL, NULL, NULL, 17, 1, 2023),
(12, 12, 28, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:27:46', NULL, NULL, NULL, NULL, 17, 1, 2023),
(13, 12, 19, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:28:03', NULL, NULL, NULL, NULL, 17, 1, 2023),
(14, 12, 15, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:28:18', NULL, NULL, NULL, NULL, 17, 1, 2023),
(15, 12, 16, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:28:33', NULL, NULL, NULL, NULL, 17, 1, 2023),
(16, 12, 27, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:28:52', NULL, NULL, NULL, NULL, 17, 1, 2023),
(17, 12, 21, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:29:16', NULL, NULL, NULL, NULL, 17, 1, 2023),
(18, 12, 20, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:29:42', NULL, NULL, NULL, NULL, 17, 1, 2023),
(19, 12, 18, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:30:07', NULL, NULL, NULL, NULL, 17, 1, 2023),
(20, 12, 17, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:30:22', NULL, NULL, NULL, NULL, 17, 1, 2023),
(21, 12, 14, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:30:37', NULL, NULL, NULL, NULL, 17, 1, 2023),
(22, 12, 13, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:31:00', NULL, NULL, NULL, NULL, 17, 1, 2023),
(23, 12, 30, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:31:19', NULL, NULL, NULL, NULL, 17, 1, 2023),
(24, 12, 26, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:31:34', NULL, NULL, NULL, NULL, 17, 1, 2023),
(25, 12, 25, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:32:02', NULL, NULL, NULL, NULL, 17, 1, 2023),
(26, 12, 22, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:32:25', NULL, NULL, NULL, NULL, 17, 1, 2023),
(27, 12, 29, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:32:49', NULL, NULL, NULL, NULL, 17, 1, 2023),
(28, 12, 24, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:33:07', NULL, NULL, NULL, NULL, 17, 1, 2023),
(29, 12, 23, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:33:23', NULL, NULL, NULL, NULL, 17, 1, 2023),
(30, 13, 217, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:43:22', NULL, NULL, NULL, NULL, 17, 1, 2023),
(31, 13, 218, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:43:33', NULL, NULL, NULL, NULL, 17, 1, 2023),
(32, 13, 234, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:43:43', NULL, NULL, NULL, NULL, 17, 1, 2023),
(33, 13, 233, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:44:04', NULL, NULL, NULL, NULL, 17, 1, 2023),
(34, 13, 228, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:44:15', NULL, NULL, NULL, NULL, 17, 1, 2023),
(35, 13, 230, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:44:31', NULL, NULL, NULL, NULL, 17, 1, 2023),
(36, 13, 227, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:44:46', NULL, NULL, NULL, NULL, 17, 1, 2023),
(37, 13, 229, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:45:05', NULL, NULL, NULL, NULL, 17, 1, 2023),
(38, 14, 67, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:53:10', NULL, NULL, NULL, NULL, 17, 1, 2023),
(39, 14, 66, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:53:21', NULL, NULL, NULL, NULL, 17, 1, 2023),
(40, 14, 62, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:53:33', NULL, NULL, NULL, NULL, 17, 1, 2023),
(41, 14, 61, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:53:45', NULL, NULL, NULL, NULL, 17, 1, 2023),
(42, 14, 60, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:53:55', NULL, NULL, NULL, NULL, 17, 1, 2023),
(43, 14, 58, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:54:07', NULL, NULL, NULL, NULL, 17, 1, 2023),
(44, 14, 59, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:54:26', NULL, NULL, NULL, NULL, 17, 1, 2023),
(45, 14, 65, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:55:06', NULL, NULL, NULL, NULL, 17, 1, 2023),
(46, 14, 64, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:55:15', NULL, NULL, NULL, NULL, 17, 1, 2023),
(47, 14, 63, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:55:27', NULL, NULL, NULL, NULL, 17, 1, 2023),
(48, 15, 84, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:58:12', NULL, NULL, NULL, NULL, 17, 1, 2023),
(49, 15, 83, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '11:58:21', NULL, NULL, NULL, NULL, 17, 1, 2023),
(50, 16, 50, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '12:00:47', NULL, NULL, NULL, NULL, 17, 1, 2023),
(51, 16, 212, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '12:01:13', NULL, NULL, NULL, NULL, 17, 1, 2023),
(52, 17, 225, 1000000, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '12:02:24', NULL, NULL, NULL, NULL, 17, 1, 2023),
(53, 18, 223, 545, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '12:09:46', NULL, NULL, NULL, NULL, 17, 1, 2023),
(54, 18, 222, 350, NULL, 'pending', NULL, NULL, 0, 3, '17-01-2023', '12:10:04', NULL, NULL, NULL, NULL, 17, 1, 2023),
(55, 19, 267, 60000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:17:51', NULL, NULL, NULL, NULL, 31, 1, 2023),
(56, 19, 266, 6000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:18:55', NULL, NULL, NULL, NULL, 31, 1, 2023),
(57, 20, 265, 6000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:22:40', NULL, NULL, NULL, NULL, 31, 1, 2023),
(58, 20, 264, 6000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:22:49', NULL, NULL, NULL, NULL, 31, 1, 2023),
(59, 21, 263, 6000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:23:34', NULL, NULL, NULL, NULL, 31, 1, 2023),
(60, 22, 262, 10000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:24:20', NULL, NULL, NULL, NULL, 31, 1, 2023),
(61, 22, 261, 10000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:24:28', NULL, NULL, NULL, NULL, 31, 1, 2023),
(62, 22, 260, 10000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:24:38', NULL, NULL, NULL, NULL, 31, 1, 2023),
(63, 23, 258, 6000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:25:21', NULL, NULL, NULL, NULL, 31, 1, 2023),
(64, 23, 257, 50000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:26:16', NULL, NULL, NULL, NULL, 31, 1, 2023),
(65, 23, 259, 50000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:26:41', NULL, NULL, NULL, NULL, 31, 1, 2023),
(66, 24, 256, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:31:03', NULL, NULL, NULL, NULL, 31, 1, 2023),
(67, 24, 255, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:31:27', NULL, NULL, NULL, NULL, 31, 1, 2023),
(68, 24, 254, 10000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:31:57', NULL, NULL, NULL, NULL, 31, 1, 2023),
(69, 24, 253, 1000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:32:20', NULL, NULL, NULL, NULL, 31, 1, 2023),
(70, 24, 252, 2000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:32:35', NULL, NULL, NULL, NULL, 31, 1, 2023),
(71, 24, 251, 50000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:33:07', NULL, NULL, NULL, NULL, 31, 1, 2023),
(72, 25, 250, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:35:10', NULL, NULL, NULL, NULL, 31, 1, 2023),
(73, 25, 249, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:35:18', NULL, NULL, NULL, NULL, 31, 1, 2023),
(74, 25, 248, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:35:28', NULL, NULL, NULL, NULL, 31, 1, 2023),
(75, 25, 247, 2000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:35:37', NULL, NULL, NULL, NULL, 31, 1, 2023),
(76, 25, 246, 2000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:35:47', NULL, NULL, NULL, NULL, 31, 1, 2023),
(77, 25, 245, 1000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:36:00', NULL, NULL, NULL, NULL, 31, 1, 2023),
(78, 25, 237, 30000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:36:27', NULL, NULL, NULL, NULL, 31, 1, 2023),
(79, 25, 236, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:36:42', NULL, NULL, NULL, NULL, 31, 1, 2023),
(80, 25, 235, 3000, NULL, 'pending', NULL, NULL, 0, 3, '31-01-2023', '01:36:58', NULL, NULL, NULL, NULL, 31, 1, 2023),
(81, 26, 280, 99999, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:32:21', NULL, NULL, NULL, NULL, 13, 3, 2023),
(82, 26, 211, 99999, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:32:30', NULL, NULL, NULL, NULL, 13, 3, 2023),
(83, 26, 76, 99999, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:32:37', NULL, NULL, NULL, NULL, 13, 3, 2023),
(84, 26, 75, 99999, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:32:49', NULL, NULL, NULL, NULL, 13, 3, 2023),
(85, 26, 74, 500000, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:33:03', NULL, NULL, NULL, NULL, 13, 3, 2023),
(86, 26, 73, 500000, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:33:14', NULL, NULL, NULL, NULL, 13, 3, 2023),
(87, 26, 72, 500000, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:33:24', NULL, NULL, NULL, NULL, 13, 3, 2023),
(88, 26, 71, 500000, NULL, 'pending', NULL, NULL, 0, 3, '13-03-2023', '03:33:33', NULL, NULL, NULL, NULL, 13, 3, 2023),
(89, 17, 281, 10000, NULL, 'pending', NULL, NULL, 0, 3, '17-03-2023', '02:02:54', NULL, NULL, NULL, NULL, 17, 3, 2023),
(90, 17, 224, 100000, NULL, 'pending', NULL, NULL, 0, 3, '17-03-2023', '02:03:08', NULL, NULL, NULL, NULL, 17, 3, 2023),
(91, 17, 50, 360000, NULL, 'pending', NULL, NULL, 0, 3, '17-03-2023', '02:03:20', NULL, NULL, NULL, NULL, 17, 3, 2023),
(92, 27, 283, 200000, NULL, 'pending', NULL, NULL, 0, 3, '17-03-2023', '07:00:42', NULL, NULL, NULL, NULL, 17, 3, 2023),
(93, 16, 281, 100, NULL, 'pending', NULL, NULL, 0, 3, '19-03-2023', '01:50:48', NULL, NULL, NULL, NULL, 19, 3, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `parts_rejection_sales_invoice`
--

CREATE TABLE `parts_rejection_sales_invoice` (
  `id` int(11) NOT NULL,
  `rejection_sales_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `approval_date` varchar(20) DEFAULT NULL,
  `approval_by` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `accepted_qty` float DEFAULT NULL,
  `rejected_qty` float DEFAULT NULL,
  `rejection_reason` varchar(20) DEFAULT NULL,
  `rejection_remark` varchar(20) DEFAULT NULL,
  `created_month` int(10) DEFAULT NULL,
  `created_year` int(10) DEFAULT NULL,
  `created_day` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_creation`
--

CREATE TABLE `part_creation` (
  `id` int(11) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_description` varchar(255) NOT NULL,
  `internal_part_number` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sub_group_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `part_drawing` text NOT NULL,
  `ppap_document` text DEFAULT NULL,
  `modal_document` text DEFAULT NULL,
  `cad_file` text DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `revision_number` varchar(20) DEFAULT NULL,
  `size_id` varchar(200) DEFAULT NULL,
  `revision_date` varchar(10) DEFAULT NULL,
  `revision_remark` varchar(20) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `a_d` text DEFAULT NULL,
  `q_d` text DEFAULT NULL,
  `c_d` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_family`
--

CREATE TABLE `part_family` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_family`
--

INSERT INTO `part_family` (`id`, `name`) VALUES
(1, 'Sheet Metal');

-- --------------------------------------------------------

--
-- Table structure for table `part_operations`
--

CREATE TABLE `part_operations` (
  `id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `operation_description` varchar(30) DEFAULT NULL,
  `drawing` text NOT NULL,
  `revision_number` varchar(20) NOT NULL,
  `revision_remark` varchar(20) NOT NULL,
  `revision_date` varchar(20) NOT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `created_time` varchar(20) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_type`
--

CREATE TABLE `part_type` (
  `id` int(11) NOT NULL,
  `part_type_name` varchar(50) NOT NULL,
  `contractor_code` varchar(30) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `planing`
--

CREATE TABLE `planing` (
  `id` int(11) NOT NULL,
  `financial_year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `customer_part_id` int(11) NOT NULL,
  `shortage_qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `planing_data`
--

CREATE TABLE `planing_data` (
  `id` int(11) NOT NULL,
  `planing_id` int(11) NOT NULL,
  `child_part_id` int(11) NOT NULL,
  `bom_qty` float NOT NULL,
  `schedule_qty` float NOT NULL,
  `required_qty` float NOT NULL,
  `actual_stock` float NOT NULL,
  `shortage_qty` float NOT NULL,
  `schedule_qty_2` float NOT NULL,
  `financial_year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_details`
--

CREATE TABLE `po_details` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `po_number` varchar(30) NOT NULL,
  `type_of_sale` varchar(20) NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_parts`
--

CREATE TABLE `po_parts` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `delivery_date` varchar(10) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `qty` float NOT NULL,
  `pending_qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `invoice_number` varchar(100) DEFAULT NULL,
  `new_po_qty` float DEFAULT NULL,
  `po_approved_updated` varchar(20) NOT NULL,
  `po_a_number` varchar(20) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `rate` float NOT NULL,
  `process` varchar(20) DEFAULT NULL,
  `complete_process` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_parts_sub`
--

CREATE TABLE `po_parts_sub` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `uom_id` int(11) NOT NULL,
  `delivery_date` varchar(10) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `qty` float NOT NULL,
  `pending_qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `invoice_number` varchar(100) DEFAULT NULL,
  `new_po_qty` float DEFAULT NULL,
  `po_approved_updated` varchar(20) NOT NULL,
  `po_a_number` varchar(20) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `name`) VALUES
(1, 'CED Coating'),
(2, 'POWDER COATING'),
(3, 'ZINC BLUE PLATING'),
(4, 'ZINC TRIVALLENT YELLOW PLATING'),
(5, 'MACHINING');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `part_id` varchar(15) DEFAULT NULL,
  `supplier_id` varchar(50) NOT NULL,
  `uom_id` varchar(50) DEFAULT NULL,
  `quantity` varchar(20) DEFAULT NULL,
  `delivery_date` varchar(20) DEFAULT NULL,
  `shipping_method` varchar(15) DEFAULT NULL,
  `part_type_id` varchar(255) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `po_validity_date` varchar(50) NOT NULL,
  `cgst_id` varchar(50) NOT NULL,
  `igst_id` varchar(50) NOT NULL,
  `sgst_id` varchar(50) NOT NULL,
  `created_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `p_q`
--

CREATE TABLE `p_q` (
  `id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `output_part_id` int(11) NOT NULL,
  `output_part_table_name` varchar(20) NOT NULL,
  `accepted_qty` float DEFAULT 0,
  `rejected_qty` float DEFAULT 0,
  `onhold_qty` float NOT NULL,
  `rejection_reason` text DEFAULT NULL,
  `rejection_remark` varchar(50) DEFAULT NULL,
  `scrap_factor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `p_q_history`
--

CREATE TABLE `p_q_history` (
  `id` int(11) NOT NULL,
  `p_q_id` int(11) NOT NULL,
  `input_part_number` int(11) NOT NULL,
  `input_part_number_table_name` varchar(20) NOT NULL,
  `req_qty` float NOT NULL,
  `previous_stock` int(11) NOT NULL,
  `new_stock` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_inspection_master`
--

CREATE TABLE `raw_material_inspection_master` (
  `id` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `specification` text NOT NULL,
  `evalution_mesaurement_technique` text NOT NULL,
  `child_part_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raw_material_inspection_master`
--

INSERT INTO `raw_material_inspection_master` (`id`, `parameter`, `specification`, `evalution_mesaurement_technique`, `child_part_id`) VALUES
(1, 'Hole Diameter', '6+ 0.2 mm', 'DVC', 1),
(2, 'Visual Inspection ', 'No burr, crack , hole oblong', 'Visual', 1),
(3, 'Hole Diameter', '12 -0.02/-0.08 mm', 'SNAP GAUGE', 12),
(4, 'Visual Inspection ', 'DENT,DAMAGE,CRACK,RUST,BURR.', 'Visual', 12),
(5, 'Thickness', '1.6', 'micrometer', 234),
(6, 'Free from rusty, waviness', 'Free from rusty, waviness', 'Visual', 234),
(7, 'Thickness', '1.6±0.1', 'MICROMETER', 132),
(8, 'Visual Inspection ', 'Free from dust, dirt, damage ', 'Visual', 132),
(9, 'thickness', '3±0.2', 'DVC', 23),
(10, 'LENGTH', '2500±10', 'MEASURING TAPE', 243),
(11, 'thickness', '1.6±0.2', 'DVC', 156),
(12, 'HOLE ID', '10±0.5', 'DVC', 156),
(13, 'WIDTH', '20±0.5', 'DVC', 156),
(14, 'LENGTH', '26±0.2', 'DVC', 156),
(15, 'OD', '12-0.2/-0.8', 'DVC', 258),
(16, 'HOLE ID', '8.5±0.1', 'DVC', 2),
(17, 'HOLE ID', '7±0.1', 'DVC', 2),
(18, 'SLOT DIMENSION', '15X5±0.2', 'DVC', 2),
(19, 'DIMENSION', '33.9±0.5', 'DHG', 2),
(20, 'DIMENSION', '47±0.5', 'DHG', 2),
(21, 'HIGHT', '39.8±0.3', 'DHG', 125),
(22, 'DIMENSION', '1.2±0.1', 'DHG', 125),
(23, 'EMBOSS HEIGHT', '0.5±0.1', 'DHG', 125),
(24, 'HOLE ID', '2X9.5±0.1', 'DVC', 125),
(25, 'THICKNESS', '2.6±0.1', 'MICROMETER', 125),
(26, 'HOLE ID', '2X4.4±0.2', 'DVC', 125),
(27, 'HOLE ID', '6±0.2', 'DVC', 125),
(28, 'CD', '42.2±0.2', 'DVC', 125),
(29, 'HIGHT', '82.4±0.5', 'DHG', 125),
(30, 'HOLE ID', '7±0.1', 'DVC', 125),
(31, 'HOLE ID', '8.2±0.1', 'DVC', 125),
(32, 'CD', '83±0.1', 'DVC', 125),
(33, 'VISUAL', 'BURR,DENT ,DAMAGE,CRACK,RUST', 'VISUAL', 125),
(34, 'THICKNESS', '0.7±0.1', 'MICROMETER', 289),
(35, 'LENGTH', '920±5', 'MEASURING TAPE', 289),
(36, 'WIDTH', '360±1.5', 'MEASURING TAPE,DVC', 289),
(37, 'THICKNESS', '1±0.1', 'MICROMETER', 292),
(38, 'LENGTH', '1250±5', 'MEASURING TAPE', 292),
(39, 'WIDTH', '180±1.5', 'DVC', 292),
(40, 'THICKNESS', '1.2±0.1', 'MICROMETER', 159),
(41, 'WIDTH', '548±1.5', 'MEASURING TAPE', 159),
(42, 'LENGTH', '1250±5', 'MEASURING TAPE', 159),
(43, 'THICKNESS', '2.5±0.1', 'MICROMETER', 69),
(44, 'LENGTH', '2500±10', 'MEASURING TAPE', 69),
(45, 'WIDTH', '1250±5', 'MEASURING TAPE', 69),
(46, 'HOLE ID', '8±0.5', 'DVC', 68),
(47, 'HOLE ID', '20±0.5', 'DVC', 68),
(48, 'LENGTH', '103.8±0.5', 'DHG  ', 68),
(49, 'THICKNESS', '6±0.2', 'MICROMETER', 294),
(50, 'WIDTH', '1250±5', 'MEASURING TAPE', 294),
(51, 'LENGTH', '3000±10', 'MEASURING TAPE', 294),
(52, 'HOLE ID', '7±0.2', 'DVC', 57),
(53, 'WIDTH', '73.8-0.4', 'DHG', 57),
(54, 'DIMENSION', '38±0.3', 'DVC', 57),
(55, 'DIMENSION', '25±0.2', 'DVC', 57),
(56, 'HIGHT', '29.5±0.5', 'DHG', 23),
(57, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 23),
(58, 'HOLE ID', '5.5±0.2', 'DVC', 244),
(59, 'HOLE ID', '6.5±0.2', 'DVC', 244),
(60, 'THICKNESS', '1.5±0.1', 'MICROMETER', 244),
(61, 'WIDTH', '1250±5', 'MEASURING TAPE', 243),
(62, 'THICKNESS', '1.5±0.1', 'MICROMETER', 243),
(63, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 57),
(64, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 294),
(65, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 68),
(66, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 69),
(67, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 292),
(68, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 289),
(69, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 149),
(70, 'coating colour', 'black', 'VISUAL', 149),
(71, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 149),
(72, 'THICKNESS', '0.5±0.1', 'MICROMETER', 66),
(73, 'WIDTH', '630±5', 'MEASURING TAPE', 66),
(74, 'LENGTH', '690±5', 'MEASURING TAPE', 66),
(75, 'HOLE ID', '8±0.5', 'DVC', 67),
(76, 'HOLE ID', '20±0.5', 'DVC', 67),
(77, 'LENGTH', '103.8±0.5', 'DHG', 67),
(78, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 67),
(79, 'VISUAL', 'black', 'VISUAL', 143),
(80, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 143),
(81, 'coating colour', 'black', 'VISUAL', 143),
(82, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 143),
(83, 'VISUAL', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 143),
(84, 'HOLE ID', '2x6.5±0.2', 'DVC', 265),
(85, 'CD', '25.2±0.2', 'DVC', 265),
(86, 'LENGTH', '37.7±0.3', 'DVC', 265),
(87, 'HIGHT', '21.5±0.3', 'DHG', 265),
(88, 'DIMENSION', '13+0.5', 'DVC', 265),
(89, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 265),
(90, 'WIDTH', '18±0.5', 'DVC', 55),
(91, 'HIGHT', '16.77±0.5', 'DHG', 55),
(92, 'HOLE ID', '6.6+0.2', 'DVC', 55),
(93, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 55),
(94, 'THICKNESS', '2-3mm', 'MICROMETER', 126),
(95, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 126),
(96, 'DIMENSION', 'm10x1.5', 'TPG GAUGE M10X1.5 -6H', 101),
(97, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 101),
(98, 'HOLE ID', '7.1±0.1', 'DVC', 83),
(99, 'HOLE ID', '8.2±0.1', 'D', 83),
(100, 'HOLE ID', '14.1±0.1', 'DVC', 83),
(101, 'SLOT DIMENSION', '21X6±0.1', 'DVC', 83),
(102, 'WALL THICKNESS', '2.5+0.2', 'DVC', 83),
(103, 'HIGHT', '54±0.2', 'DHG', 83),
(104, 'DIMENSION', '86.5±0.3', 'DHG', 83),
(105, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 83),
(106, 'HIGHT', '42.5±0.5', 'DHG', 124),
(107, 'DIMENSION', '1.2±0.1', 'DHG', 124),
(108, 'CHECK FOR MATAING ASSYMBLY', 'NO GAP ALLOWED', 'VISUAL', 124),
(109, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 124),
(110, 'HIGHT', '39.8±0.3', 'DHG', 123),
(111, 'DIMENSION', '1.2±0.1', 'DHG', 123),
(112, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 123),
(113, 'CHECK FOR MATAING ASSYMBLY', 'NO GAP ALLOWED', 'VISUAL', 123),
(114, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 123),
(115, 'THICKNESS', '2.5±0.2', 'MICROMETER', 148),
(116, 'WIDTH', '1250±5', 'MEASURING TAPE', 148),
(117, 'LENGTH', '2500±10', 'MEASURING TAPE', 148),
(118, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 148),
(119, 'THICKNESS', '3±0.2', 'MICROMETER', 300),
(120, 'WIDTH', '1250±5', 'MEASURING TAPE', 300),
(121, 'LENGTH', '2500±10', 'MEASURING TAPE', 300),
(122, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 300),
(123, 'THICKNESS', '3±0.1', 'MICROMETER', 64),
(124, 'WIDTH', '1250±5', 'MEASURING TAPE', 64),
(125, 'LENGTH', '2500±10', 'MEASURING TAPE', 64),
(126, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 64),
(127, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 61),
(128, 'THICKNESS', '3.2±0.1', 'MICROMETER', 61),
(129, 'WIDTH', '1250±5', 'MEASURING TAPE', 61),
(130, 'LENGTH', '2500±10', 'MEASURING TAPE', 61),
(131, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 243),
(132, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 134),
(133, 'HOLE ID', '12±0.2', 'DVC', 134),
(134, 'Hole Diameter', '6.7+0.2', 'd', 134),
(135, 'Hole Diameter', '6.7+0.2', 'd', 134),
(136, 'Hole Diameter', '21+0.2', 'DVC', 134),
(137, 'Hole Diameter', '2x11+/-0.2', 'DVC', 134),
(138, 'Hole Diameter', '6.4x17+/-0.3', 'dvc', 134),
(139, 'coating colour', 'black', 'VISUAL', 136),
(140, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 136),
(141, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 136),
(142, 'VISUALN INSPETION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 233),
(143, 'OD', '6±1', 'DVC', 233),
(144, 'LENGTH', '127±1', 'DHG', 233),
(145, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 240),
(146, 'COATING THICKNESS', '50-70MIC', 'DFT METER', 240),
(147, 'coating colour', 'black', 'VISUAL', 240),
(148, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 240),
(149, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 258),
(150, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 127),
(151, 'HOLE ID', '10 + 0.2', 'DVC', 127),
(152, 'HIGHT', '26 +/- 0.5', 'DVC', 127),
(153, 'WIDTH', '20 +/- 0.5 ', 'DVC', 127),
(154, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 239),
(155, 'CUP HIGHT', '95±0.5', 'DHG', 239),
(156, 'VISUAL', 'DENT,DAMAGE,CRACK,RUST,SCORRING,BURR', 'VISUAL', 117),
(157, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 45),
(158, 'DIMENSION', '1.2±0.1', 'DHG', 45),
(159, 'HIGHT', '42.5±0.5', 'DVC', 45),
(160, 'CHECK FOR MATTING ASSEMBLY', 'NO GAP ALLOWED', 'VISUAL', 45),
(161, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST,SCORRING,BURR, WATER MARK.', 'VISUAL', 28),
(162, 'DFT', '8-12 MIC', 'DFT METER', 28),
(163, 'ZINC PLATING ', 'TRIVELENT YELLOW', 'VISUAL', 28),
(164, 'SST', '300 HRS MIN NO RED RUST', 'THIRD PARTY REPORT ONCE IN YEAR SUBBMITTED BY SUPPLIER', 28),
(165, 'DIMENSION', '123.3±1', 'DVC', 108),
(166, 'HOLE ID', '17±0.2', 'DVC', 108),
(167, 'HOLE ID', '10±0.5', 'DVC', 108),
(168, 'CD', '34±0.5', 'DVC', 108),
(169, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 108),
(170, 'DIMENSION', '123.3±1', 'DVC', 237),
(171, 'HOLE ID', '17±0.2', 'DVC', 237),
(172, 'HOLE ID', '10±0.5', 'DVC', 237),
(173, 'CD', '34±0.5', 'DVC', 237),
(174, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 237),
(175, 'DIMENSION', '123.3±1', 'DVC', 109),
(176, 'HOLE ID', '17±0.2', 'DVC', 109),
(177, 'HOLE ID', '10±0.5', 'DVC', 109),
(178, 'CD', '34±0.5', 'DVC', 109),
(179, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 109),
(180, 'LENGTH', '21.5±0.2', 'DVC', 1),
(181, 'LENGTH', '76.5+1', 'DVC', 20),
(182, 'HEAD STEP', '2.5±0.1', 'DVC', 20),
(183, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 20),
(184, 'LENGTH', '62.5+1', 'DVC', 24),
(185, 'HEAD STEP', '2.5±0.1', 'DVC', 24),
(186, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 24),
(187, 'DIAMETER', '8-0.2', 'DVC', 14),
(188, 'DIAMETER', '12±0.2', 'DVC', 14),
(189, 'STEP HEIGHT', '2.5+0.2', 'DHG', 14),
(190, 'DIMENSION', '25±0.2', 'DVC', 14),
(191, 'DIMENSION', '5.6±0.2', 'DVC', 14),
(192, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 14),
(193, 'LENGTH', '7.9+0.5', 'DVC', 21),
(194, 'DIAMETER', '10.5-0.2', 'DVC', 21),
(195, 'DIAMETER', '7±0.1', 'DVC', 21),
(196, 'LENGTH', '14.6+0.2', 'DVC', 21),
(197, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST,CHAMFER', 'VISUAL', 21),
(198, 'coating colour', 'black', 'VISUAL', 223),
(199, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 223),
(200, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 223),
(201, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 223),
(202, 'coating colour', 'black', 'VISUAL', 145),
(203, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 145),
(204, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 145),
(205, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 145),
(206, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 136),
(207, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 229),
(208, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 229),
(209, 'coating colour', 'black', 'VISUAL', 229),
(210, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 229),
(211, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 230),
(212, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 230),
(213, 'coating colour', 'black', 'VISUAL', 230),
(214, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 230),
(215, 'forming height', '16.77±0.5', 'DVC', 36),
(216, 'WIDTH', '18±0.5', 'DVC', 36),
(217, 'HOLE ID', '6.6+0.2', 'DVC', 36),
(218, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 36),
(219, 'HOLE ID', '2x8.5±0.1', 'DVC', 26),
(220, 'HOLE ID', '7±0.1', 'DVC', 26),
(221, 'LENGTH', '142±0.2', 'DVC', 26),
(222, 'CD', '100±0.2', 'DVC', 26),
(223, 'SLOT DIMENSION', '2x15x5±0.2', 'DVC', 26),
(224, 'WIDTH', '33.9±0.5', 'DHG', 26),
(225, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 26),
(226, 'HOLE ID', '2x12±0.2', 'DVC', 118),
(227, 'HOLE ID', '11±0.2', 'DVC', 118),
(228, 'HOLE ID', '6.7±0.2', 'DVC', 118),
(229, 'HOLE ID', '21±0.2', 'DVC', 118),
(230, 'SLOT DIMENSION', '17x6.4±0.2', 'DVC', 118),
(231, 'DIMENSION', '11.9±0.3', 'DVC', 118),
(232, 'DIMENSION', '14.4±0.3', 'DVC', 118),
(233, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST,SCORRING,BURR', 'VISUAL', 118),
(234, 'coating colour', 'black', 'VISUAL', 140),
(235, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 140),
(236, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 140),
(237, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 140),
(238, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 142),
(239, 'coating colour', 'black', 'VISUAL', 142),
(240, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 142),
(241, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 142),
(242, 'coating colour', 'black', 'VISUAL', 144),
(243, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 144),
(244, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 144),
(245, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 144),
(246, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 139),
(247, 'coating colour', 'black', 'VISUAL', 139),
(248, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 139),
(249, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 139),
(250, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK, non stickness,cut mark', 'VISUAL', 46),
(251, 'THICKNESS', '3±1', 'DVC', 46),
(252, 'HOLE ID', '9±0.2', 'DVC', 84),
(253, 'SLOT DIMENSION', '9x11±0.2', 'DVC', 84),
(254, 'CD', '120±0.2', 'DVC', 84),
(255, 'LENGTH', '144.6±0.2', 'DVC', 84),
(256, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 84),
(257, 'OD', '16-0.02/-0.12', 'SNAP GAUGE', 12),
(258, 'OD', '9.5-0.03/0.13', 'MICROMETER', 12),
(259, 'STEP HEIGHT', '5±0.1', 'DHG', 12),
(260, 'STEP HEIGHT', '7.1±0.1', 'DHG', 12),
(261, 'STEP HEIGHT', '6.75±0.1', 'DHG', 12),
(262, 'STEP HEIGHT', '5.6±0.1', 'DHG', 12),
(263, 'PAINT PEEL UP', 'NOT ALLOWED', 'VISUAL', 235),
(264, 'coating colour', 'black', 'VISUAL', 235),
(265, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 235),
(266, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 235),
(267, 'WIDTH', '55±5', 'DVC', 132),
(268, 'LENGTH', '458±5', 'MEASURING TAPE', 132),
(269, 'DIAMETER', '8-0.2', 'DVC', 103),
(270, 'LENGTH', '22±0.5', 'DVC', 103),
(271, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 103),
(272, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 104),
(273, 'DIAMETER', '20±0.5', 'DVC', 104),
(274, 'DIAMETER', '25±0.2', 'DVC', 104),
(275, 'HIGHT', '2±0.2', 'DVC', 104),
(276, 'LENGTH', '35±0.3', 'DVC', 104),
(277, 'TPG', 'M12X1.75', 'TPG GAUGE', 104),
(278, 'WIDTH', '1250±5', 'MEASURING TAPE', 214),
(279, 'THICKNESS', '5.0±0.2', 'MICROMETER', 214),
(280, 'LENGTH', '2500±10', 'MEASURING TAPE', 214),
(281, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 214),
(282, 'THICKNESS', '4mm', 'MICROMETER', 423),
(283, 'LENGTH', '2500±10', 'MEASURING TAPE', 423),
(284, 'WIDTH', '1250±5', 'MEASURING TAPE', 423),
(285, 'VISUAL INSPECTION', 'DENT,DAMAGE,CRACK,RUST', 'VISUAL', 423),
(286, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 149),
(287, 'PAINT PEEL UP', 'NOT ALLOWED', 'SCRACTH TEST', 137),
(288, 'coating colour', 'black', 'VISUAL', 137),
(289, 'COATING THICKNESS', '15-25 MIC', 'DFT METER', 137),
(290, 'VISUAL INSPECTION', 'DENT,DAMAGE,PAINT CRACK,BLISTERS.', 'VISUAL', 137);

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_inspection_report`
--

CREATE TABLE `raw_material_inspection_report` (
  `id` int(11) NOT NULL,
  `raw_material_inspection_master_id` int(11) NOT NULL,
  `child_part_id` int(11) NOT NULL,
  `observation` text NOT NULL,
  `remark` text NOT NULL,
  `lot_qty` float DEFAULT NULL,
  `rej_qty` int(11) NOT NULL,
  `invoice_date` varchar(50) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `accepted_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rejection_flow`
--

CREATE TABLE `rejection_flow` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `part_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `reason` varchar(20) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `debit_note` text NOT NULL,
  `qty` float NOT NULL,
  `on_that_qty` float DEFAULT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `created_user` int(11) NOT NULL,
  `rate` float DEFAULT NULL,
  `cgst` float DEFAULT NULL,
  `sgst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `tcs` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `grandtotal` float DEFAULT NULL,
  `rejection_lock` varchar(20) NOT NULL DEFAULT 'Pending',
  `approval` varchar(20) NOT NULL DEFAULT 'pending',
  `po_number` varchar(100) DEFAULT NULL,
  `po_date` varchar(200) DEFAULT NULL,
  `invoice_number` varchar(200) DEFAULT NULL,
  `grn_number` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rejection_sales_invoice`
--

CREATE TABLE `rejection_sales_invoice` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sales_invoice_number` varchar(20) DEFAULT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `document_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reject_remark`
--

CREATE TABLE `reject_remark` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reject_remark`
--

INSERT INTO `reject_remark` (`id`, `name`, `created_by`, `created_date`, `created_time`, `deleted`) VALUES
(1, 'Dent', 3, '16-11-2022', '12:28:28', 0),
(2, 'Damage', 3, '16-11-2022', '12:39:46', 0),
(3, 'offcut', 3, '16-11-2022', '03:21:43', 0),
(4, 'Plating Issue', 3, '12-12-2022', '04:18:32', 0),
(5, 'Dimensional Issue', 3, '12-12-2022', '04:18:51', 0),
(6, 'CRACK', 3, '18-01-2023', '11:49:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `routing`
--

CREATE TABLE `routing` (
  `id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `routing_part_id` int(11) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routing`
--

INSERT INTO `routing` (`id`, `part_id`, `routing_part_id`, `qty`) VALUES
(1, 136, 171, 1),
(2, 172, 2, 1),
(3, 137, 173, 1),
(4, 138, 174, 1),
(5, 139, 175, 1),
(6, 140, 176, 1),
(7, 141, 177, 1),
(8, 142, 178, 1),
(9, 143, 179, 1),
(10, 144, 180, 1),
(11, 145, 181, 1),
(12, 148, 182, 1),
(13, 149, 183, 1),
(14, 225, 224, 1),
(15, 226, 227, 1),
(16, 223, 146, 1),
(17, 150, 337, 1),
(18, 231, 232, 1),
(19, 147, 233, 1),
(20, 229, 163, 1),
(21, 230, 234, 1),
(22, 240, 206, 1),
(24, 235, 2, 1),
(25, 228, 31, 1),
(26, 31, 155, 1),
(27, 220, 404, 1),
(28, 238, 246, 1),
(29, 244, 203, 1),
(30, 239, 253, 1),
(31, 256, 258, 1),
(32, 255, 256, 1),
(33, 252, 170, 1),
(34, 28, 244, 1),
(35, 400, 402, 1);

-- --------------------------------------------------------

--
-- Table structure for table `routing_subcon`
--

CREATE TABLE `routing_subcon` (
  `id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `routing_part_id` int(11) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_parts`
--

CREATE TABLE `sales_parts` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `sales_number` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `uom_id` varchar(20) NOT NULL,
  `delivery_date` varchar(10) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `pending_qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `invoice_number` varchar(200) DEFAULT NULL,
  `total_rate` float DEFAULT NULL,
  `cgst_amount` float DEFAULT NULL,
  `sgst_amount` float DEFAULT NULL,
  `igst_amount` float DEFAULT NULL,
  `tcs_amount` float DEFAULT NULL,
  `gst_amount` float DEFAULT NULL,
  `po_number` varchar(100) NOT NULL,
  `po_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_parts`
--

INSERT INTO `sales_parts` (`id`, `sales_id`, `sales_number`, `customer_id`, `part_id`, `tax_id`, `uom_id`, `delivery_date`, `expiry_date`, `qty`, `pending_qty`, `created_by`, `created_date`, `created_time`, `created_day`, `created_month`, `created_year`, `deleted`, `invoice_number`, `total_rate`, `cgst_amount`, `sgst_amount`, `igst_amount`, `tcs_amount`, `gst_amount`, `po_number`, `po_date`) VALUES
(1, 1, 'BSP/23-24/1', 2, 229, 3, 'Number', NULL, NULL, 5, 5, 3, '31-03-2023', '12:49:32', 31, 3, 2023, 0, NULL, 413.504, 45.227, 45.227, 0, 0, 90.454, 'SA22230064', '17-01-2023'),
(2, 1, 'BSP/23-24/1', 2, 227, 3, 'Number', NULL, NULL, 4, 4, 3, '31-03-2023', '12:49:46', 31, 3, 2023, 0, NULL, 330.803, 36.1816, 36.1816, 0, 0, 72.3632, 'SA22230064', '17-01-2023');

-- --------------------------------------------------------

--
-- Table structure for table `sales_parts_subcon`
--

CREATE TABLE `sales_parts_subcon` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `sales_number` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `uom_id` varchar(20) NOT NULL,
  `delivery_date` varchar(10) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `pending_qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `created_day` int(11) NOT NULL,
  `created_month` int(11) NOT NULL,
  `created_year` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `invoice_number` varchar(200) DEFAULT NULL,
  `total_rate` float DEFAULT NULL,
  `cgst_amount` float DEFAULT NULL,
  `sgst_amount` float DEFAULT NULL,
  `igst_amount` float DEFAULT NULL,
  `tcs_amount` float DEFAULT NULL,
  `gst_amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sharing_bom`
--

CREATE TABLE `sharing_bom` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `qty` float NOT NULL,
  `output_part_id` int(11) NOT NULL,
  `output_part_table_name` varchar(20) NOT NULL,
  `input_part_id` int(11) NOT NULL,
  `input_part_table_name` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `scrap_factor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sharing_issue_request`
--

CREATE TABLE `sharing_issue_request` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `child_part_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `accepted_qty` float DEFAULT NULL,
  `sharing_strip` text NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sharing_p_q`
--

CREATE TABLE `sharing_p_q` (
  `id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `qty` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sharing_p_q_history`
--

CREATE TABLE `sharing_p_q_history` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `output_part_id` int(11) NOT NULL,
  `input_part_id` float DEFAULT NULL,
  `input_part_table_name` varchar(20) DEFAULT NULL,
  `output_part_table_name` varchar(20) NOT NULL,
  `accepted_qty` float DEFAULT 0,
  `rejected_qty` float DEFAULT 0,
  `onhold_qty` float NOT NULL,
  `rejection_reason` text DEFAULT NULL,
  `rejection_remark` varchar(50) DEFAULT NULL,
  `scrap_factor` float DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `qty_in_kg` float DEFAULT 0,
  `sharing_p_q_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `shift_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `deleted`, `start_time`, `end_time`, `shift_type`) VALUES
(1, '12', 0, '08:30', '20:30', '1<sup>st</sup>'),
(2, '12', 0, '20:30', '08:30', '2<sup>nd</sup>');

-- --------------------------------------------------------

--
-- Table structure for table `stock_changes`
--

CREATE TABLE `stock_changes` (
  `id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `uploading_document` text NOT NULL,
  `qty` float NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `type` varchar(20) NOT NULL DEFAULT 'addition'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_invoice_number` varchar(30) NOT NULL,
  `part_id` varchar(5) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  `rate` varchar(12) NOT NULL,
  `invoice_amount` varchar(12) NOT NULL,
  `grn_number` varchar(30) NOT NULL,
  `entered_date` varchar(20) DEFAULT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcon_bom`
--

CREATE TABLE `subcon_bom` (
  `id` int(11) NOT NULL,
  `customer_part_id` int(30) NOT NULL,
  `child_part_id` int(30) NOT NULL,
  `quantity` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcon_po_inwarding`
--

CREATE TABLE `subcon_po_inwarding` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `po_id` int(11) NOT NULL,
  `inwarding_qty` int(11) NOT NULL,
  `main_sub_con_part_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '''pending''	',
  `invoice_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcon_po_inwarding_history`
--

CREATE TABLE `subcon_po_inwarding_history` (
  `id` int(11) NOT NULL,
  `subcon_po_inwarding_parts_id` int(11) NOT NULL,
  `challan_id` int(11) NOT NULL,
  `challan_part_id` int(11) NOT NULL,
  `previous_qty` float NOT NULL,
  `new_qty` float NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '''minus''',
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `po_id` text DEFAULT NULL,
  `invoice_number` text DEFAULT NULL,
  `grn_number` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcon_po_inwarding_history_subcon`
--

CREATE TABLE `subcon_po_inwarding_history_subcon` (
  `id` int(11) NOT NULL,
  `subcon_po_inwarding_parts_id` int(11) NOT NULL,
  `challan_id` int(11) NOT NULL,
  `challan_part_id` int(11) NOT NULL,
  `previous_qty` float NOT NULL,
  `new_qty` float NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '''minus''',
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `po_id` text DEFAULT NULL,
  `invoice_number` text DEFAULT NULL,
  `grn_number` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcon_po_inwarding_parts`
--

CREATE TABLE `subcon_po_inwarding_parts` (
  `id` int(11) NOT NULL,
  `subcon_po_inwarding_id` int(11) NOT NULL,
  `inwarding_qty` int(11) NOT NULL,
  `main_sub_con_part_id` int(11) NOT NULL,
  `input_part_id` int(11) NOT NULL,
  `input_part_req_qty` float NOT NULL,
  `recevied_req_qty` float NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT '''pending'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(50) DEFAULT NULL,
  `supplier_number` varchar(30) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `gst_number` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `payment_terms` varchar(255) NOT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL DEFAULT 0,
  `nda_document` text DEFAULT NULL,
  `registration_document` text DEFAULT NULL,
  `other_document_1` text DEFAULT NULL,
  `other_document_2` text DEFAULT NULL,
  `other_document_3` text DEFAULT NULL,
  `admin_approve` varchar(20) NOT NULL DEFAULT 'pending',
  `with_in_state` varchar(20) NOT NULL DEFAULT 'no',
  `pan` text DEFAULT NULL,
  `pan_card` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `supplier_number`, `mobile_no`, `email`, `location`, `gst_number`, `state`, `payment_terms`, `created_id`, `date`, `time`, `timestamp`, `deleted`, `nda_document`, `registration_document`, `other_document_1`, `other_document_2`, `other_document_3`, `admin_approve`, `with_in_state`, `pan`, `pan_card`) VALUES
(1, 'Aadhiraj IT Soluction', 'BSP0001', '704021664', 'sanjit@bspmetatech.com ', 'A16 Akshay Palace, Warje Flyower Chock, Warje', '27AHDPK2974K1Z0', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(2, 'A A Enterprises', 'BSP0002', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-1590 Flat No-404 Sai Vaikunth Alandi Road, Chikali Pune-411062', '27AMQPL4300C1ZC', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(4, 'Acube Fasteners', 'BSP0004', '704021664', 'sanjit@bspmetatech.com ', 'Plot No-165/1/12 Priyadarshani  Mahila Swayarojgar, Ind . T  Block Midc Bhosari', '27APTPS1418Q1ZY', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(5, 'Adroit Corporation', 'BSP0005', '704021664', 'Adrocorp1@gmail.Com', 'E-7, GMC Park, Plot 109, Purna Nagar, Chinchwad, Pune, ', '27ANHPK8679B1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(6, 'Air Liquide India Holding Private Limited', 'BSP0006', '704021664', 'mugdha.chavan-sc@airliquide.com', 'Plot No -B1 Chakan Industrial Area Phase II, Village Sawardari Tal-Khed, Pune-410501', '27AAACA9121F1Z0', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(7, 'Akshay Transport', 'BSP0007', '704021664', 'sanjit@bspmetatech.com ', 'Gat, No. 89, Chakhali Road, Jyotibanagar,, Talawade, Pune. 412114', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(8, 'Alankar Furniture & Electricals', 'BSP0008', '704021664', 'sanjit@bspmetatech.com ', 'Opp Vaibhav  Shah Petrol Pump  Mutkewadi, Pune Nashik Road  Tal Khed, ', '27ASEPC1152D1ZF', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(9, 'Ams Logistics', 'BSP0009', '704021664', 'sanjit@bspmetatech.com ', '2nd Phase Ring Road Jigni Industrial Area, Jigni Anekal Taluk Banglore -560105', '29AXEPK1640D2ZR', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(10, 'Anil M Deshpande', 'BSP0010', '704021664', 'sanjit@bspmetatech.com ', 'Pune', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(11, 'Anmol Hr Solutions Pvt Ltd', 'BSP0011', '704021664', 'Amolhrsolutionspvtltd.5555@gmail.Com', '902 Ajit Petrol Pump Kon Kalyan Bhwanidi Road, Konegaon Tal-Bhiwandi  Dist-Thane, ', '27AAUCA8524C1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(12, 'Arcon Metals', 'BSP0012', '704021664', 'sanjit@bspmetatech.com ', 'J-372,MIDC,Bhosari,, Pune', '27AIRPG1841N1ZT', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(13, 'Aryan Electrical & Hardware', 'BSP0013', '704021664', 'sanjit@bspmetatech.com ', 'Gat. No.88, Jyotibanagar, Bhaiekar Chwk,, Talawade,Pune. 412114.', '27CRRPK8625F1ZA', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(14, 'Ascent Autocomp', 'BSP0014', '704021664', 'Ascentautocomp@gmail.Com', 'Gat No-357,Plot No-6A Waghjainagar ,, Kharabwadi,  Chakan Tal-Khed, ', '27BGKPS2696M1ZF', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(15, 'Asia Steel Center', 'BSP0015', '704021664', 'sanjit@bspmetatech.com ', 'GAT NO -198 DEHU ALANDI ROAD, CHIKALI PUNE-412114', '27AANPC2212R1ZJ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(16, 'Astrim', 'BSP0016', '704021664', 'Astrimoss@gmail.Com', 'Ap-Midc Bhirdawadi Chakan Ambethan Road,  ', '27GHPPS9428N1Z1', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(17, 'Astrum Packtech', 'BSP0017', '704021664', 'sanjit@bspmetatech.com ', 'Sr No36/2/1 Shed No-2 Near Bhagwati Hotel, Narhe Dayari Road Narhe, Ak@rustoppers.Com', '27ABEFA6610P1Z7', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(18, 'Automotive Stampings and Assemblies Ltd Purchase', 'BSP0018', '704021664', 'sanjit@bspmetatech.com ', 'Pune', '27AAACJ2116M1ZN', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(19, 'Barspell Technologies India Pvt Ltd', 'BSP0019', '704021664', 'sanjit@bspmetatech.com ', 'Office No-7ganeshgarden, Phase-III Mumbai Pune Highway, Dapodi-411012', '27AAFCB9337D1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(20, 'Basava Engineering', 'BSP0020', '704021664', 'Basvaengg2010@gmail.Com', 'Gat No-169/ Barge Vasti Chikali Tal-Khed, Dist Pune-412105', '27ADTPH3181M1ZY', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(21, 'Bharat Iron Syndicate', 'BSP0021', '704021664', 'sanjit@bspmetatech.com ', 'Plot No.162,Sector No.10,PCNTDA,, MIDC, Bhosari, Pune.', '27AAAFB5946N1Z3', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(22, 'Bhiravnath Enterprises', 'BSP0022', '704021664', 'Bhiravnath.Enterprises222@gmail.Com', 'At Post Urawade Ambegaon Tal -Mulshi', '27ASFPD5760P2Z9', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(23, 'Bsi Group India Pvt Ltd', 'BSP0023', '704021664', 'sanjit@bspmetatech.com ', '301,3, Floor , Samarpan Complex,, New Link Road , Chakala, Andheri East  Mumbai-400099', '27AABCB3790L1ZE', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(24, 'BTSL Automotive India Pvt.Ltd.', 'BSP0024', '704021664', 'sanjit@bspmetatech.com ', 'Gat No.492/493/494,, Koregaon Bhima, Tal.:Shirur,, Dist.:Pune', '27AAECB5416E1ZZ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(25, 'Capro Enterprises', 'BSP0025', '704021664', 'caproenterprises@gmail.Com', 'No. 8, Burhani Complex, Gat No.214/1,, Nanekarwadi, Pune Nashik Highway, Chakan,, Tal- Khed, Pune - 410501,  ', '27AAKFC7498Q1ZB', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(26, 'C H Robinson Worldwide Freight India Pvt Ltd', 'BSP0026', '704021664', 'sanjit@bspmetatech.com ', '77 Nungambakkam High Road Pottipatti, Plaza Nungambakkam Chennei -600034 India', '27AACCC9617L1ZA', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(27, 'Daebu Automotive Seat India Pvt Ltd-Purchases', 'BSP0027', '704021664', 'sanjit@bspmetatech.com ', 'PLOT NO-D-1-Bhambholi Village, Midc Chakan , Chakan Ind Area Phase-Ii, Khed Pune-410501', '27AACCD4599E1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(28, 'Daechang India Seat Compnay Pvt Ltd -P3-Purchases', 'BSP0028', '704021664', 'sanjit@bspmetatech.com ', 'Pune', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(29, 'Devansh Industrial Services', 'BSP0029', '704021664', 'sanjit@bspmetatech.com ', 'Pune', '27APZPG7850A1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(30, 'Dev Gauges & Instruments', 'BSP0030', '704021664', 'Devgauges@gmail.Com', 'Dighi Road Sr No-224/3/1 ,, Bhosari Pune-411039, ', '27AITPH6146B1Z7', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(31, 'Devil Sales Corpration', 'BSP0031', '704021664', 'Divilsales@gmail.Com', '6 Rachana Industrial Complex  Telco Road Midc, Bhosari Pune-411026,  ', '27AANPC2179H1ZM', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(32, 'Dharamraj Steel', 'BSP0032', '704021664', 'sanjit@bspmetatech.com ', 'Gat No 675 Opp Kalyani Lemerz, Pune Nashik Highway, Kuruli Chakan Pune -410504, Dharamrajsteel42@gmail.Com, 9881074242/9850204200', '27BVIPM4025R1ZZ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(33, 'Dharmaraj Transport', 'BSP0033', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-675 Opp Kalyani  Lemarz Pune Nashik, Kuruli Chakan, ', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(34, 'Divekar Fabrication', 'BSP0034', '704021664', 'sanjit@bspmetatech.com ', 'Sr. No 186/1, Ekta Colony, Chakrapani Vasahat, Bhosari Pune', '27AHIPD9025D1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(35, 'Excellent Tool  Tech', 'BSP0035', '704021664', 'sanjit@bspmetatech.com ', 'W238 J Block Midc Bhosari, Pune-411026, ', '27AACFE9000C1Z0', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(36, 'Gurudatta Crane Services', 'BSP0036', '704021664', 'sanjit@bspmetatech.com ', 'A/P-NIGHOJE TAL-KHED PUNE', '27AFJPY1135L1ZZ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(37, 'Hammer Enterprises', 'BSP0037', '704021664', 'sanjit@bspmetatech.com ', 'J Block 131 , Midc Bhosari, Pune-411026,', '27AHOPT6169L1ZB', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(38, 'Hari Om Computer', 'BSP0038', '704021664', 'HARIOMCOMPUTERPUNE@GMAIL.COM', 'SHOP NO-1 BIZA COMPLEX INDRYAN BANK, MANIK CHOK CHAKAN,  ', '27AIBPH0047B1Z1', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(39, 'Hemant Tool Pvt Ltd', 'BSP0039', '704021664', 'Info@hemanttools.Co.in', 'C-01/4008,CITY MALL A WING SECTOR-19, VASHI TUMBRE SANPADA NAVI MUMBAI-400705, ', '27AAACH1034L1ZS', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(40, 'Icon Systems', 'BSP0040', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-169 Shop No-5 Prasad Ind Complex, Opp Sonigara Height ,Talawade Road Rupee Nagar, Pune-412114', '27AHXPM7456J1ZD', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(41, 'Impact Technology', 'BSP0041', '704021664', 'Impacttrchnology27@gmail.Com', 'Sr No-7 Plot No-2 Pcntda  Bhosari Pune-411062', '27CFCPP7350F1ZD', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(42, 'Indtech Automation and Engineering Solutions', 'BSP0042', '704021664', 'sanjit@bspmetatech.com ', 'Plot No-47/b,Yashwant Nagar , Opp, Mobile Towar Pimpri Pune-411018, Pune-39', '27AAHFI0808B1ZV', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(43, 'Jagadaguru Narendracharyaji Enterprises', 'BSP0043', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-256borhadewadi , Opp Modern Collage Moshi ,, Moshi Dehu Road Pune-412105', '27AAHPT6005F1ZQ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(44, 'Jaikal Enterprises', 'BSP0044', '704021664', 'Jaikalenterprises@gmail.Com', 'Shop No-01&02, Gat No-613, Alandi Phata,, Kuruli Chakan-Pune-410501', '27AAOFJ2988C1Z0', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(45, 'J.J.ARC CONTROL SYSTEM', 'BSP0045', '704021664', 'Jjarccontrolsys@gmail.Com', 'Sector No.10, Plot No.281,, PCNTDA,Pradhikaran,, Bhosari,Pune', '27AHRPM2850Q1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(46, 'K and B Industries', 'BSP0046', '704021664', 'sanjit@bspmetatech.com ', 'Sr No-24 Hiraman Lande Peth, Shop No-22 Near Swami Samarth School, Indryani Nagar Bhosari', '27AAUFK2696J1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(47, 'Kolte Industries', 'BSP0047', '704021664', ' Kolteindustries001@gmail.Com', 'Plot No-S214 Midc Bhosari, Pune-411026', '27AALFK0929M1ZW', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(48, 'Kumar Coaters', 'BSP0048', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-123 Near Mayur Hotel Moi Road, Kuruli Chakan -410501', '27AAMPW8765G1ZT', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(49, 'Marina Engineering Corporation', 'BSP0049', '704021664', ' Marinaengg@yahoo.in', '101/2,Mahadev Apartment, Shop No.2,, Main Road,Neharunagar,Pimpri, Pune. 18.,', '27ACPPT4547C1Z9', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(50, 'Mataji Hardware & Electricals Stores', 'BSP0050', '704021664', 'sanjit@bspmetatech.com ', 'Main Chock Kad Vasti, Kuruli, Tal -Khed Dist-Pune', '27AEGPC4174H1ZM', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(51, 'Matchwell Engineering Pvt Ltd-Unit.II.Purchases', 'BSP0051', '704021664', 'sanjit@bspmetatech.com ', 'Pune', '27AAACM2890D1ZM', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(52, 'Mauli Enterprises-Job Work', 'BSP0052', '704021664', ' Mauli Enterprises1699@gmail.Com', 'House No-126/12/02 Padmavati Road Near, Charathe Maharaj Math Alendi Dewachi,', '27AYMPM9391C1ZY', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(53, 'Metprotect Technologies Pvt Ltd', 'BSP0053', '704021664', ' Metprotect@rediffmail.Com', 'Gat No-347/1/d, Behind Suvarna Fibrotech Pvt Ltd, Mahlunge Chakan,', '27AAHCM8203D1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(54, 'Miss. K.A. Deshpande', 'BSP0054', '704021664', 'sanjit@bspmetatech.com ', 'Nashik', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(55, 'Mittal Agencies', 'BSP0055', '704021664', 'sanjit@bspmetatech.com ', 'Survey No -81/3, Shivane Tal-Haveli, Dist-Pune -711023', '27AAFFM5327F1ZD', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(56, 'Monisha Corp Pvt Ltd', 'BSP0056', '704021664', 'sanjit@bspmetatech.com ', 'C S MORYA HOUSE, PLOT NO B 66/67, VEER INDUSTRIAL ESTATE NEAR INFINTY MALL, OFF LINK ROAD ANDHERI WEST MUMBAI -400053', '27AACCM4288R1ZN', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(57, 'Morya Enterprises', 'BSP0057', '704021664', ' Moryaent2016@gmail.Com,', 'Near Grampachyat Kuruli ,Padurang Krupa, Opp Vitthal Mandir Tal-Khed-Dist-Pune-410501,', '27AYRPM5565D1ZZ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(58, 'Ms Sales and Services', 'BSP0058', '704021664', 'sanjit@bspmetatech.com ', 'E305 SANJUDA COMPLEX NEAR LITTLE FLOWER SCHOOL, PPADE VASTI BHEKARI NAGAR FURSUNGI PUNE-412308, MS.2019@REDIFFMAIL.COM', '27BMZPS2732R1ZS', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(59, 'Namkala Solutions', 'BSP0059', '704021664', ' Namkalasolutioni@gmail.Com', 'Gat No-77 Behind Unique Circle Engg P L, Jyotibanagar Talawade Pune-411062,', '27BVJPM7478P1ZF', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(60, 'Natra Sales & Services', 'BSP0060', '704021664', 'sanjit@bspmetatech.com ', 'Pune', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(61, 'Ndt Metal Solution Laboratory', 'BSP0061', '704021664', 'sanjit@bspmetatech.com ', '9, Naveena , Telco Road ,Near, M LA  Sales Corp ,Pimpri, Chichwad, Pune', '27AXKPS1832R1ZN', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(62, 'Neelanchal Engineering', 'BSP0062', '704021664', ' Neelachalengineering4212@gmail.Com', 'Plot No-632 Shop No-1 Sr Industrial Estate, Wadachamala Jadhav Wadi, Chikali Pune, ', '27CWRPP7871H1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(63, 'Netra Sales & Services', 'BSP0063', '704021664', 'sanjit@bspmetatech.com ', 'Shri Swamismarth Nagari, Sr.216, Omsai, Park Chowk, Bhosari, Pune- 411 039', '27AXAPK3390A1ZV', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(64, 'N.G. Sales', 'BSP0064', '704021664', 'sanjit@bspmetatech.com ', 'PUNE NASHIK HIGHWAY, AT POST KRULI, GAT NO-155, CHAKAN-410501,', '27AAGFN3284R1ZI', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(65, 'Nira Industries', 'BSP0065', '704021664', 'Development@niraind.Com', 'Work Plot-3 Gat No-1434, Sonawane Wasti ,, Chikali,', '27AAOFN7801L1ZR', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(66, 'Nirmal Engineers', 'BSP0066', '704021664', 'Nirmalengineers@yahoo.Co.on, ', '56/2 D-II , Block Midc Near Mohannagar Police, Chinchwad Pune-411019, ', '27AHNPA6793J1ZT', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(67, 'Nitin Indutries', 'BSP0067', '704021664', 'sanjit@bspmetatech.com ', 'Sr No-24 Shop No-42 Swapnil Ind Estate, Near Swamy School Indryani Nagar Bhosari, ', '27AASFN0489N1ZD', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(68, 'Om Chaitanya Enterprise', 'BSP0068', '704021664', 'sanjit@bspmetatech.com ', 'At-Post Kuruli Near Siddhi Enterprises Tal-Khed, Dist-Pune-410501', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(69, 'OM TECHNOCART PVT LTD UNIT II Purchase', 'BSP0069', '704021664', 'sanjit@bspmetatech.com ', 'Gala No.1,Near Mercedez Benz,, Gat No.197,Chakan MIDC,Nighoje,, Village-Khed, Pune', '27AAACO3277G1ZF', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(70, 'Om Techno-Crat Pvt Ltd Purchase', 'BSP0070', '704021664', 'sanjit@bspmetatech.com ', 'Plot No D 44/ 1 , M I D C  ,Ambad   Nashik', '27AAACO3277G1ZF', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(71, 'Orchid Industries', 'BSP0071', '704021664', 'sanjit@bspmetatech.com ', 'H.O.P.A. P-J-75,Indrayani Nagar Road,, Near Swami Samarth Weigh Bridge,, MIDC Bhosari,Pune-411026', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(72, 'Pandit Engineering Works', 'BSP0072', '8956136039', 'pew3609@gmail.com', '681/1 Ghavane Ind Estate Landevadi Bhosari, Adhinathnagar', '27ABNPP0050F1ZT', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(73, 'Paras Enterprises', 'BSP0073', '704021664', 'sanjit@bspmetatech.com ', 'At Post-Chimbali Near R Engg, Pune Nashik Highway', '27AJKPT6390F1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(74, 'Pavan Rathi and Associates Company Secretaries', 'BSP0074', '704021664', 'sanjit@bspmetatech.com ', 'Office No-212 Ganga Collidium Market Yard, Pune-37, ', '27AJJPR6448R1Z3', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(75, 'Pentanen Engineering Pvt. Ltd. Purchase', 'BSP0075', '704021664', ' Accounts@pebtabeb.Com', 'Plot No. C11, MIDC, Chakan, Pune - 410501,', '27AAICP1262C1ZP', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(76, 'Plasma Tek', 'BSP0076', '704021664', 'sanjit@bspmetatech.com ', 'Shop No -9 Shiv Corner Sr No -103 Opp Santoshi Maa, Mandir Neharunagar Pimpri Pune-411018', '27BEOPM4476F1Z2', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(77, 'Praj Metallugical Laboratory', 'BSP0077', '704021664', 'sanjit@bspmetatech.com ', 'B38 India Shankar Nagari, Paud Road Near Kothrud, ', '27AAXPB0729N1Z8', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(78, 'Praxair India Private Limited', 'BSP0078', '704021664', 'sanjit@bspmetatech.com ', 'Plot No-4 Gat NO-627/2 VIllage Kuruli, Taluka Khed , Chakan, PUne', '27AAACP9993J1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(79, 'Precisemake Industries', 'BSP0079', '704021664', 'Precisemake24ind@gmail.Com', 'Gat No-1403,Mahalaxmi Ind Estate, Chikali Pune, ', '27AAMPV5392A1ZD', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(80, 'Radical Engineering', 'BSP0080', '704021664', 'sanjit@bspmetatech.com ', 'First Floor Flat No-105, Shubh Arcade Spine Road, Sector-13 Chikhali Pradhikaran Chinchwad-East', '27BPAPD1670K1Z1', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(81, 'Rimmi  Industries', 'BSP0081', '704021664', ' Rimmiindustries@gmail.Com', 'Gat No-78 Jyotibanagar Talawade Pune, ', '27AJKPC9516E2Z8', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(82, 'R R Industrial Packaging Pvt Ltd', 'BSP0082', '704021664', 'sanjit@bspmetatech.com ', '03 Ground Floor Sagar Height Kasarwadi, Pune-411034', '27AAHCR1069A1ZN', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(83, 'Sahani Gas Industries', 'BSP0083', '704021664', 'sanjit@bspmetatech.com ', 'Sector No-7 Plot No-296, Pradhikaran Bhosari Midc, ', '27ABFFS4527E1Z7', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(84, 'Sahyadri Industries', 'BSP0084', '704021664', 'sanjit@bspmetatech.com ', 'Plot No-G24 Midc Chakan Phase-III, Village Nighoje Tal-Khed', '27ACSFS0995E1ZK', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(85, 'Sanjay Enterprises', 'BSP0085', '704021664', 'sanjit@bspmetatech.com ', 'W1 S Block Midc Bhosari', '27BDIPK4246G2ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(86, 'SB Industries', 'BSP0086', '704021664', 'Sbindpune@gmail.Com', 'Gat No-189 Behind Jyotiba Mangal Karyala, Talawade Pune-411062, ', '27ADGFS9627L1ZC', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(87, 'Sharda Motor Industries Ltd - Purchase', 'BSP0087', '704021664', 'sanjit@bspmetatech.com ', 'Pune', '27AAACS6855J1ZY', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(88, 'Shiv Enterprises', 'BSP0088', '704021664', 'sanjit@bspmetatech.com ', 'Gala No-3 Gat No-197/1 Near Tulja Bhawani Hotel, Opp Mercedez Benz Village Nighoje -Tal-Khed, Pune-410501,', '27AEJFS2381F1ZV', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(89, 'Shiv Shakti Industries', 'BSP0089', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-59 Ward No-2 Chimbali Phata, Tal-Khed , Dist-Pune-410501, ', '27ACXFS7235E1ZK', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(90, 'Shree Coating\'s', 'BSP0090', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-357/85,Waghjainagar Opp Metils India P L, Kharabwadi Tal-Khed Dist-Pune', '27AEBFS1458M1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(91, 'Shree Ganesh Weigh Bridge', 'BSP0091', '704021664', 'sanjit@bspmetatech.com ', 'Near Hotel Mauli Krupa Jp School, Kuruli Village Nighoje Chakan', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(92, 'Shree Mahalaxmi Enterprises', 'BSP0092', '704021664', 'sanjit@bspmetatech.com ', 'S No-912 Hargude Wasti , Near Gharukul Chikali Pune, Pune-412114, ', '27AGGPG6409B1ZS', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(93, 'Shreram Industries', 'BSP0093', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-255/b Jyotiba Nagar , Plot No-56/57 Talawade, Pune, ', '27ADUFS3251J1ZI', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(94, 'Shri Ganesh Enterprises', 'BSP0094', '704021664', 'Shri_ganesh@rediffmail.Com', 'Plot No.26(A),Gut No.43,Ranjangaon(S.P.), Behind Siemens Co.MIDC, Walunj,, Aurangabad., 431136, ', '27AXMPS3634F1Z6', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(95, 'Shri Ganesh Enterprises -Chakan', 'BSP0095', '704021664', 'Shreeganeshent123@gmail.Com', 'Plot No -12 Gate No-227, Near Koras Foundry Chakan, ', '27CMYPK3162K1ZC', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(96, 'Shubh Industries', 'BSP0096', '704021664', 'sanjit@bspmetatech.com ', 'Sr No-15/1 Gulve Vasti, Bhosari Pune-411026,', '27AMQPC4938D1ZZ', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(97, 'Shyama Shyam Industries', 'BSP0097', '704021664', 'sanjit@bspmetatech.com ', '347/1k Behind Suvarna  Fibrotech Co, A/p-Mahalunge Tal-Khed', '27BXMPM0097H1Z4', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(98, 'Siddhivinayak Enterprises', 'BSP0098', '704021664', 'Vishal_mungase@rediffmail.Com', 'Gat. No.76(A), At- Kelgaon, Post -Alandi Devachi,, Tal- Khed, Dist - Pune., ', 'to be added', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(99, 'SKM Steels Limited', 'BSP0099', '704021664', 'sanjit@bspmetatech.com ', '12, SKM House, Khetwadi, 6th Lane, SV Road, Mumbai', '27AADCS7801F1ZG', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(100, 'S.Mahipal Steel', 'BSP0100', '704021664', 'sanjit@bspmetatech.com ', 'J7, J Block, MIDC Bhosari,Pune- 411026', '27AJPPM1766K1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(101, 'S S Enterprises-Box', 'BSP0101', '704021664', ' Spatil1972@yahoo.Com', 'Sr No 243,6th Floor Vidhyasagar Hight Garud Ganpati, Narayan Peth Laxmi Road Pune,', '27ABSFS4437J1ZI', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(102, 'Star Powder Coating', 'BSP0102', '704021664', 'sanjit@bspmetatech.com ', 'Midc Bidawadi Near Telephone Exchange Off, Ambhethan Road Chakan Tal -Khed, ', '27AZSPA4425G1ZD', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(103, 'Starways Precisions Pvt Ltd', 'BSP0103', '704021664', 'sanjit@bspmetatech.com ', 'Plot No-A-18 Midc Chakan Village Mahalunge, Maharastra Pune-410501', '27AAJCS5382B1ZA', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(104, 'Super Auto Electroplating', 'BSP0104', '704021664', 'sanjit@bspmetatech.com', 'S.No 15/2, Near Good Will  Chemicals , Gulvewasti ,Bhosari Pun', '27APXPK0741G1ZN', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(105, 'Super Punches', 'BSP0105', '704021664', 'sanjit@bspmetatech.com ', 'Shop No.6 Rajmata Industries Premises, T-58 M I D C, Near Anucool Ind, Aids Pvt Ltd Bhosari Pune', '27AGDPG4395D1ZI', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(106, 'S V Packaging', 'BSP0106', '704021664', 'sanjit@bspmetatech.com ', 'Rh1 Shivam Residency Ambethan Road, Chakan Tal-Khed-410501, ', '27AKVPG9942N1Z3', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(107, 'The Parshwanath Metal Processors(I)Pvt.Ltd.', 'BSP0107', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-244,246,247, Plot No 9 Indl Area, Nanekarwadi, Chakan Pune-410501.', '27AAACP9733A1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(108, 'The Parshwanath Metal Processors(I)Pvt.Ltd.-Bhosar', 'BSP0108', '704021664', 'Ss.Parshwa@rediffmail.Com', 'S Block W-79, Midc  Bhosari , Pune-411026, 27119250, ', '27AAACP9733A1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(109, 'Thirumalai Enterprises', 'BSP0109', '704021664', ' Thirumlaienterprises104@gmail.Com', 'Plot-104, Sector -7, Pcntda Bhosari Pune,', '27ADHPN2256M1Z6', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(110, 'Trimurti Enterprises-Manpower  Supplier', 'BSP0110', '704021664', 'Trimurtienterprises008@gmil.Com', 'H No-1218, A/p-Kuruli, Tal-Khed Pune-410501', '27AACTK5945N1Z0', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(111, 'Triple Protective Facilities India Pvt Ltd', 'BSP0111', '704021664', 'sanjit@bspmetatech.com ', 'Balaji Smruti , Chakan Talegoan Road, Near Indian Oil Petrol Pump Kharbwadi Chakan,', '27AAHCT4544J1Z0', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(112, 'Trumpf India Pvt Ltd', 'BSP0112', '704021664', 'sanjit@bspmetatech.com ', 'SI NO-276 Hissa No -1 Raisoni Industrial Park, Village Mann Taluka Mulashi  Pune-411057', '27AACCT8008J1Z6', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(113, 'TURAKHAI METAL FROMS PVT. LTD.', 'BSP0113', '704021664', 'sanjit@bspmetatech.com ', '304/5, Kamala Ashish Tower, Mahavirnagar,, Dhanukarwadi, Kandivli(W),, Mumbai- 400067', '27AAACT9823B1ZG', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(114, 'Unique Laser Cutting', 'BSP0114', '704021664', ' Info@uniquelaser.in', 'Gat No. 463/2,Village-Kuruli, Tal. Khed, Dist. Pune, 410501,', '27AAFFU6174L1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(115, 'Urja Metallurgical Services', 'BSP0115', '704021664', ' Urjametallugrical@gmail.Com', 'J/p-15 Telco Bhosari Road, Opposite to Reliance Communication, Pune-26,', '27AADPP3668E1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(116, 'Vaibhava Traders', 'BSP0116', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-67/2/3,D-406 Kushal Swarnali Kharabwadi Pune', '27AKEPA2673F1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(117, 'Vaishnavi Auto Parts Industries', 'BSP0117', '704021664', 'sanjit@bspmetatech.com ', 'Gat No -766 S No-179 Pawar Wast Kudalwadi, Chikali Pune -412114, ', '27ADLPT0803E1ZO', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(118, 'Vector Ups Battery Solutions Pvt Ltd', 'BSP0118', '704021664', 'Info@vectorsups.Com', 'S No-83/2+3+4/2 Tuljai Classic Buliding, Swami Vivekandn Hsg Soc Chinchwad Pune', '27AAHCV2203J1ZE', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(119, 'Vibgyor Packwell Systems Pvt Ltd', 'BSP0119', '704021664', ' Vibgyor_art@vsnl.Net', 'PLOT NO- G -10 MIDC NIGHOJ CHAKAN T, TAL -KHED,', '27AAECV0733G1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(120, 'Vibhava Traders', 'BSP0120', '704021664', 'sanjit@bspmetatech.com ', 'Gat No-67/2/3, Kushal Swarnali ,Khrabwadi, Pune-410501', '27AKEPA2673F1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(121, 'Vinod N Nikam & Co', 'BSP0121', '704021664', 'sanjit@bspmetatech.com ', 'Pune', '27AHGPN5310H1ZH', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(122, 'Vishal Fabricators & Engineering Works', 'BSP0122', '704021664', 'sanjit@bspmetatech.com ', 'Plot No. 105, Sector No. 10, PCNTDA, Bhosari,, Pune - 411 026.', '27ARJPK3872C1ZR', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(123, 'VISHWANATHA ENTERPRISES', 'BSP0123', '704021664', 'VISHWANATHENT50@GMAIL.COM', 'TALAWADE, PUNE, 9762835310, ', '27BLCPD4636F1ZE', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(124, 'Water Treatment Enterprises', 'BSP0124', '704021664', 'sanjit@bspmetatech.com ', 'J-427 MIDC , Bhosari Pune-411026', '27AADFW0115F1ZL', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(125, 'Yogesh Enterprises', 'BSP0125', '704021664', 'sanjit@bspmetatech.com ', '17/1A,GANESH NAGAR, DHAWADEWASTI,, BHOSARI, PUNE. 39', '27AROPG7293E1ZF', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(126, 'Zincpro Technology', 'BSP0126', '704021664', ' Zincprotechnology@gmail.Com', 'Gat No, 357/85, Waghjainagar, Kharabwadi,, Chakan, Pune,', '27AACFZ4606R1ZI', 'Maharashtra', '60', 3, '9/7/2021', '3:03:31', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(127, 'OM TECHNOKRATS', 'BSP0127', '8318203341', 'omtechnokrats@gmail.com', 'PLOT NO 357/56, WAGHJAINAGAR, KHARABWADI, CHAKAN, PUNE-410501', '27AADFO0865E1ZE', 'MAHARASHTRA', '60', 3, '10/10/2021', '3:55:41', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(128, 'KIRAN ENTERPRISES', 'BSP0128', '9922502728', 'kiranent29@gmail.com', '18/87, JYOTIBANAGAR, TALAWADE, PUNE-412114', '27AALFK0803G1ZK', 'MAHARASHTRA', '60', 3, '10/10/2021', '4:28:18', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(129, 'Sujoy Enterprises', 'BSP0129', '9325072554', 'sujoyenterprises@gmail.com', 'JP-114, Jayratna Complex, Shop No.-8, Indrayani Nagar, Bhosari, Pune-411026', '27AGSPM1715A1ZL', 'MAHARASHTRA', '60', 3, '11/26/2021', '1:39:50', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(130, 'MARS FINE CHEMICALS', 'BSP0130', '9028098163', 'marsfine02@gmail.com', 'Plot No-24, WMDC Industrial Estate, Ambethan Road, Chakan, Khed, Pune-410501', '21AAHPN3787C1ZJ', 'MAHARASHTRA', '60', 3, '26-12-2021', '10:58:16', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(131, 'PRECOAT INDUSTRIES', 'BSP0131', '8208551736', 'precoat.industries@yahoo.com', 'G-95, PHASEIII, MIDC CHAKAN, KURULI, KHED, PUNE-410501', '27AQZPA3293N1Z1', 'MAHARASHTRA', '60', 3, '29-12-2021', '3:19:15', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(132, 'Shree Samarth Industries', 'BSP0132', '7066305979', 'office.shreesamarth@gmail.com', 'GAT NO-197/1, CHAKAN INDUSTRIAL AREA, PHASE-III, NIGHOJE, PUNE-410501', '27ADNFS7041K1ZJ', 'MAHARASHTRA', '60', 3, '31-12-2021', '1:05:48', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(133, 'MAHALAXMI ENTERPRISES', 'BSP0133', '9271816457', 'mahalaxmi.enterprises2018@yahoo.com', 'FLAT NO. 6, NARAYAN RESIDENCY APT. PATHARADI PHATA, NASHIK-422010', '27ADYPR9230J1ZN', 'MAHARASHTRA', '60', 3, '31-12-2021', '4:47:47', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(134, 'Sujan Contitech AVS Pvt Ltd-Purchase', 'BSP0134', '', '', 'Plot No. F-11, Phase -III, MIDC, Chakan, Kharabwadi, Tal. Khed, Dist. Pune.', '27AAMCS2867C1Z5', 'MAHARASHTRA', '60', 3, '1/1/2022', '1:55:30', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(135, 'MK TRON AUTOPARTS PVT. LTD.-PURCHASE', 'BSP0135', '2114306000', '', 'PLOT NO. A19, TALEGAON INDUSTRIAL AREA, NAVLAKHUMBRE, PUNE, MAHARASHTRA-410507', '27AACCD5858L1Z6', 'MAHARASHTRA', '60', 3, '4/1/2022', '7:30:51', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(136, 'YOGITA STAMPING', 'BSP0136', '7719966469', 'abhijeetpokh58@gmail.com', 'EL-33, J BLOCK,OPPOSITE OERLIKON BALZERS,MIDC BHOSARI, PUNE-411026', '27FOJPP5933M1Z4', 'MAHARASHTRA', '60', 3, '2/2/2022', '4:14:35', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(137, 'SAI CED COATING', 'BSP0137', '9890881516', 'saicedcoating@gmail.com', 'PLOT NO-57/6, SECTOR NO-10, PCNTDA, BHOSARI, PUNE-411026', '27ACGFS8558K1ZC', 'MAHARASHTRA', '60', 3, '16-02-2022', '5:14:39', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(138, 'HITEK METAL PROCESSORS', 'BSP0138', '9373001575', '', 'T-71/1A/4, BG BLOCK, MIDC, BHOSARI, PUNE-411026', '27AABFP3849B1ZF', 'MAHARASHTRA', '60', 3, '23-03-2022', '9:36:42', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'yes', NULL, NULL),
(139, 'JYOTI RUBBER INDUSTRIES', 'BSP0139', '9818816334', 'jyotirubber1992@gmail.com', 'Plot No 187, Sector No7, IMT Manesar, Gurgaon, HR-122050', '06ABPPA8945E1ZK', 'HARYANA', '60', 3, '3/6/2022', '10:54:04', '0000-00-00 00:00:00', 0, '0', '0', NULL, NULL, NULL, 'accept', 'no', NULL, NULL),
(140, 'UNIVERSAL POWDER COATING ', 'BSP0140', '8408043433', 'universal_coating@rediffmail.com', 'GAT NO-62 ,BEHIND ARK LIGHT,KHARABWADI,CHAKAN TALEGAON ROAD ', '27AEKPA6764K1Z5', 'MAHARASTRA', '60', 3, '31-07-2022', '3:33:47', '0000-00-00 00:00:00', 0, '', '', '', '', '', 'accept', 'yes', NULL, NULL),
(141, 'PRAGATI ENGINEERING', 'BSP0141', '9139592919', 'pragatiengg20@gmail.com', 'Gat No-873,Bhaurav More Udyog, Kudalwadi, Chikhali, Pune', '27ASBPD1178K1ZS', 'MAHARASHTRA', '60 DAYS', 3, '18-09-2022', '11:05:06', '2022-09-18 05:35:06', 0, '', '', '', '', '', 'accept', 'yes', NULL, NULL),
(142, 'AS COATING EXPERTS', 'BSP0142', '7709808585', 'accounts@asgrouppune.com', 'Shop no. 3, Gate No. 357/85, Waghjai Nagar, Chakan-Talegaon Road, Kharabwadi, Pune-410501', '27ABYFA1656R1ZF', 'MAHARASHTRA', '60', 3, '02-10-2022', '12:26:46', '2022-10-02 06:56:46', 0, '', '', '', '', '', 'accept', 'yes', NULL, NULL),
(143, 'Vaishnavi Enterprises', 'BSP0143', '8087435757', 'rohitpandhare@rocketmail.com', 'Sr. No.-7/2, Shantinagar, Landewadi, Bhosari, Pune-411039', '27CHAPP3443B1ZP', 'MAHARASHTRA', '60', 3, '07-11-2022', '04:14:13', '2022-11-07 10:44:13', 0, '', '', '', '', '', 'accept', 'yes', NULL, ''),
(145, 'M S ENTERPRISES', 'BSP0144', '9823702904', 'sahilshaikh78620@gmail.com', 'GAT NO- 707, KUDALWADI, CHIKHALI, TAL- HAVELI, DIST- PUNE 411 062', '27ENZPS6909A1ZB', 'MAHARASHTRA', '60 DAYS', 3, '25-12-2022', '10:29:21', '2022-12-25 04:59:21', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'ENZPS6909A'),
(146, 'OMKAR ENGINEERING WORKS', 'BSP0145', '9921808543', 'omkar.engineeringbalaji@gmail.com', 'FLAT NO-301, C-12, PRAGATI HOUSING SOCIETY, CHIKHALI, PCNTDA, CHINCHWAD, PUNE-412 114.', '27BEIPK7979F2ZV', 'MAHARASHTRA', '60 DAYS', 3, '25-12-2022', '03:07:18', '2022-12-25 09:37:18', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'BEIPK7979F2'),
(147, 'MAYURESH  ENGINEERING', 'BSP0146', '9881096501', '', 'GAT NO-710,  NEAR BHAIRAVANATH MANDIR,  KUDHALWADI, PUNE- 411 062', '27DALPA3218J1ZS', 'MAHARASHTRA', '60 DAYS', 3, '26-12-2022', '10:07:22', '2022-12-26 04:37:22', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'DALPA3218J'),
(148, 'RPG STEEL', 'BSP0147', '9850821784', 'rpgsteelcompany@gmail.com', 'J-Block, Plot No. PAP-132, MIDC, Bhosari, Pune – 411 026.', '27AXVP8751G1Z1', 'MAHARASHTRA', '60 DAYS', 3, '28-12-2022', '11:05:09', '2022-12-28 05:35:09', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'AXVP8751G'),
(149, 'V.V. Alloys & Mild Steels', 'BSP0148', '0', 'vvalloys@yahoo.com', 'PLOT NO- J406, J BLOCK, MIDC, BHOSARI, PUNE-411 026.', '27AAOPA7131Q1ZA', 'MAHARASHTRA', '60 DAYS', 3, '28-12-2022', '11:24:09', '2022-12-28 05:54:09', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'AAOPA7131Q'),
(150, 'SAHYADRI INDUSTRIES ', 'BSP0149', '9850626307', 'sahyadriindustries1@gmail.com', 'Plot No-G24, Phase III, MIDC Chakan, Nighoje, Khed, Pune-410501', '27ACSFS0995E1ZK', 'MAHARASHTRA', '60 DAYS', 3, '07-01-2023', '07:19:46', '2023-01-07 13:49:46', 0, '', '', '', '', '', 'accept', 'yes', NULL, ''),
(151, 'SAGAR ENGINEERING', 'BSP0150', '9960794925', 'sagarengineering380@rediffmail.com', 'GALA NO.30/1, PLOT NO.134/135, SECTOR 7,  PCNTDA, BHOSARI- 411 026.', '27ATIPM3120EZ1', 'MAHARASHTRA', '10 DAYS', 3, '11-01-2023', '10:50:36', '2023-01-11 05:20:36', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'ATIPM3120E'),
(153, 'TRIPTI GASES PVT LTD', 'BSP0151', '9765992172', 'dispatch_pune@triptigases.com', 'GAT NO-312/04, OPP VEENA IND.  NANEKARWADI, CHAKAN- 410 501.', '27AABCT0071G1ZN', 'MAHARASHTRA', '60 DAYS', 3, '11-01-2023', '11:05:28', '2023-01-11 05:35:28', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'AABCT0071G'),
(154, 'LAXMI ENGINEERING INDUSTRIES', 'BSP0152', '9011890845', 'accounts@weldspark.com', 'BARSHI CO. OP. IND. ESTATE NO-1, PLOT NO-13/14, BARSHI-413 401.', '27AAAFL5473A1ZM', 'MAHARASHTRA', '60 DAYS', 3, '13-01-2023', '12:06:50', '2023-01-13 06:36:50', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'AAAFL5473A'),
(155, 'K K INDUSTRIAL SERVICES', 'BSP0153', '9881401112', 'infokkindustrialservices@gmail.com', 'SR NO-95/2, GAT NO-22, LANDGE NAGAR, BHOSARI- 411 039.', '27BGOPK3077J1ZW', 'MAHARASHTRA', '60 DAYS', 3, '20-01-2023', '05:59:49', '2023-01-20 12:29:49', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'BGOPK3077J'),
(156, 'NAMRATA STEEL', 'BSP0154', '02266362611', 'sales@namratasteel.com', 'OFFICE NO-5, 26 DURGADEVI STREET, MUMBAI-400004', '27ALBPS4709G1Z1', 'MAHARASHTRA', '60 DAYS', 3, '08-02-2023', '05:16:31', '2023-02-08 11:46:31', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'ALBPS4709G'),
(157, 'VIRANSH ELECTROPLATERS', 'BSP0155', '7709808585', 'accounts@asgrouppune.com', 'NARMADA PARK, FIRST FLOOR, B/103, NANDINI APARTMENT, PUNE NASHIK HIGHIWAY, KHED, Chakan, Pune, Maharashtra, 410 501', ' 27BOIPK9241Q1Z5', 'MAHARASHTRA', '60 DAYS', 3, '18-02-2023', '10:43:14', '2023-02-18 05:13:14', 0, '', '', '', '', '', 'accept', 'yes', NULL, 'BOIPK9241Q'),
(158, 'TRUFAB TECHNOLOGIES INDIA PVT. LTD.', 'BSP0156', '9922386956', 'trufab.pune@gmail.com', 'GAT NO- 8 , KRISHNA INDUSTRIAL COMPLEX, JYOTIBA NAGAR, TALAWADE', '27AAJCT3162E1ZD', 'Maharashtra', '60', 3, '26-03-2023', '04:01:27', '2023-03-26 10:31:27', 0, '', '', '', '', '', 'accept', 'yes', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `uom_name` varchar(50) NOT NULL,
  `uom_description` varchar(100) NOT NULL,
  `contractor_code` varchar(30) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `uom_name`, `uom_description`, `contractor_code`, `created_id`, `date`, `time`, `timestamp`, `deleted`) VALUES
(1, 'NOS', 'Number', NULL, 3, '09-12-2021', '09:05:47', '2021-12-09 15:35:47', 0),
(2, 'KGS', 'Kgs', NULL, 3, '09-12-2021', '09:05:52', '2021-12-09 15:35:52', 0),
(3, 'Meter', 'Meter', NULL, 3, '09-12-2021', '09:05:57', '2021-12-09 15:35:57', 0),
(4, 'Litre', 'Litre', NULL, 3, '09-12-2021', '09:06:02', '2021-12-09 15:36:02', 0),
(5, 'SET', 'Set', NULL, 3, '23-07-2022', '02:49:38', '2022-07-23 09:19:38', 0),
(6, 'Cum', 'Cum', NULL, 3, '13-01-2023', '09:35:42', '2023-01-13 04:05:42', 0),
(7, 'PRS', 'Pairs', NULL, 3, '20-01-2023', '12:24:37', '2023-01-20 06:54:37', 0),
(8, 'Rim', 'Rim', NULL, 3, '20-01-2023', '01:29:36', '2023-01-20 07:59:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `user_email` text DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `user_role` text DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `date` text DEFAULT NULL,
  `time` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` text DEFAULT NULL,
  `drawing_download` varchar(20) DEFAULT 'yes',
  `drawing_upload` varchar(20) DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `user_email`, `type`, `user_role`, `user_name`, `user_password`, `date`, `time`, `timestamp`, `deleted`, `drawing_download`, `drawing_upload`) VALUES
(3, 'admin@admin.com', 'Admin', 'Admin', 'Admin', 'admin@2023', NULL, NULL, '2021-02-03 05:51:21', NULL, 'yes', 'yes'),
(4, 'purchase@admin.com', 'Purchase', NULL, 'Purchase', 'purchase@da', NULL, NULL, '2021-07-24 09:39:25', NULL, 'yes', 'yes'),
(5, 'approver@admin.com', 'Approver', NULL, 'Approver', 'admin', NULL, NULL, '2021-07-24 09:39:59', NULL, 'yes', 'yes'),
(6, 'inward_stores@admin.com', 'inward_stores', NULL, 'Inward Stores', 'admin', NULL, NULL, '2021-07-24 09:40:53', NULL, 'yes', 'yes'),
(7, 'inward_quality@admin.com', 'inward_quality ', NULL, 'Inward Quality', 'admin', NULL, NULL, '2021-07-24 09:41:28', NULL, 'yes', 'yes'),
(8, 'stores@admin.com', 'stores', NULL, 'stores', 'stores@890', NULL, NULL, '2021-07-24 09:41:49', NULL, 'yes', 'yes'),
(9, 'production@admin.com', 'production', NULL, 'production', 'production@pro', NULL, NULL, '2021-07-24 09:42:16', NULL, 'yes', 'yes'),
(10, 'FG_stores@admin.com', 'FG_stores', NULL, 'FG Stores', 'admin', NULL, NULL, '2021-07-24 09:42:46', NULL, 'yes', 'yes'),
(11, 'marketing@admin.com', 'Marketing', NULL, 'Marketing', 'admin', NULL, NULL, '2021-07-24 09:43:10', NULL, 'yes', 'yes'),
(14, 'development@admin.com', 'Development', NULL, 'Development', 'admin', NULL, NULL, '2022-03-14 05:56:33', NULL, 'yes', 'yes'),
(15, 'quality@admin.com', 'Quality', NULL, 'Quality', 'quality@44', NULL, NULL, '2023-03-22 12:58:39', NULL, 'yes', 'yes'),
(16, 'sales@admin.com', 'Sales', NULL, 'Sales', 'sales@111', NULL, NULL, '2023-03-22 13:14:15', NULL, 'yes', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_tracking`
--
ALTER TABLE `bill_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challan`
--
ALTER TABLE `challan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challan_parts`
--
ALTER TABLE `challan_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challan_parts_history`
--
ALTER TABLE `challan_parts_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challan_parts_subcon`
--
ALTER TABLE `challan_parts_subcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challan_subcon`
--
ALTER TABLE `challan_subcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_part`
--
ALTER TABLE `child_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_part_master`
--
ALTER TABLE `child_part_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_part_variance`
--
ALTER TABLE `child_part_variance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumable_item`
--
ALTER TABLE `consumable_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part`
--
ALTER TABLE `customer_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_parts_master`
--
ALTER TABLE `customer_parts_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part_documents`
--
ALTER TABLE `customer_part_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part_drawing`
--
ALTER TABLE `customer_part_drawing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part_operation`
--
ALTER TABLE `customer_part_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part_operation_data`
--
ALTER TABLE `customer_part_operation_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part_rate`
--
ALTER TABLE `customer_part_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_part_type`
--
ALTER TABLE `customer_part_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_po_tracking`
--
ALTER TABLE `customer_po_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_po_so`
--
ALTER TABLE `c_po_so`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deflashing_bom`
--
ALTER TABLE `deflashing_bom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deflashing_operation`
--
ALTER TABLE `deflashing_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deflashing_production`
--
ALTER TABLE `deflashing_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deflashing_rqeust`
--
ALTER TABLE `deflashing_rqeust`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_tracking`
--
ALTER TABLE `dispatch_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downtime_master`
--
ALTER TABLE `downtime_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `einvoice_res`
--
ALTER TABLE `einvoice_res`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_inspection_request`
--
ALTER TABLE `final_inspection_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grn_details`
--
ALTER TABLE `grn_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst_structure`
--
ALTER TABLE `gst_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inhouse_parts`
--
ALTER TABLE `inhouse_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inwarding`
--
ALTER TABLE `inwarding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_card`
--
ALTER TABLE `job_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_card_details`
--
ALTER TABLE `job_card_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_card_details_operations`
--
ALTER TABLE `job_card_details_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_card_prod_qty`
--
ALTER TABLE `job_card_prod_qty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loading_user`
--
ALTER TABLE `loading_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_mold`
--
ALTER TABLE `machine_mold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_request`
--
ALTER TABLE `machine_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_request_parts`
--
ALTER TABLE `machine_request_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `molding_production`
--
ALTER TABLE `molding_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `molding_stock_transfer`
--
ALTER TABLE `molding_stock_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mold_maintenance`
--
ALTER TABLE `mold_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_po`
--
ALTER TABLE `new_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_po_sub`
--
ALTER TABLE `new_po_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_sales`
--
ALTER TABLE `new_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_sales_rejection`
--
ALTER TABLE `new_sales_rejection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_sales_subcon`
--
ALTER TABLE `new_sales_subcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations_bom`
--
ALTER TABLE `operations_bom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations_bom_inputs`
--
ALTER TABLE `operations_bom_inputs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation_data`
--
ALTER TABLE `operation_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_data`
--
ALTER TABLE `other_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts_customer_trackings`
--
ALTER TABLE `parts_customer_trackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts_rejection_sales_invoice`
--
ALTER TABLE `parts_rejection_sales_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_creation`
--
ALTER TABLE `part_creation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_family`
--
ALTER TABLE `part_family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_operations`
--
ALTER TABLE `part_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_type`
--
ALTER TABLE `part_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planing`
--
ALTER TABLE `planing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planing_data`
--
ALTER TABLE `planing_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_details`
--
ALTER TABLE `po_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_parts`
--
ALTER TABLE `po_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_parts_sub`
--
ALTER TABLE `po_parts_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_q`
--
ALTER TABLE `p_q`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_q_history`
--
ALTER TABLE `p_q_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_inspection_master`
--
ALTER TABLE `raw_material_inspection_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_inspection_report`
--
ALTER TABLE `raw_material_inspection_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejection_flow`
--
ALTER TABLE `rejection_flow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejection_sales_invoice`
--
ALTER TABLE `rejection_sales_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reject_remark`
--
ALTER TABLE `reject_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routing`
--
ALTER TABLE `routing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routing_subcon`
--
ALTER TABLE `routing_subcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_parts`
--
ALTER TABLE `sales_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_parts_subcon`
--
ALTER TABLE `sales_parts_subcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharing_bom`
--
ALTER TABLE `sharing_bom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharing_issue_request`
--
ALTER TABLE `sharing_issue_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharing_p_q`
--
ALTER TABLE `sharing_p_q`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharing_p_q_history`
--
ALTER TABLE `sharing_p_q_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_changes`
--
ALTER TABLE `stock_changes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcon_bom`
--
ALTER TABLE `subcon_bom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcon_po_inwarding`
--
ALTER TABLE `subcon_po_inwarding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcon_po_inwarding_history`
--
ALTER TABLE `subcon_po_inwarding_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcon_po_inwarding_history_subcon`
--
ALTER TABLE `subcon_po_inwarding_history_subcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcon_po_inwarding_parts`
--
ALTER TABLE `subcon_po_inwarding_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_tracking`
--
ALTER TABLE `bill_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challan`
--
ALTER TABLE `challan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challan_parts`
--
ALTER TABLE `challan_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challan_parts_history`
--
ALTER TABLE `challan_parts_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challan_parts_subcon`
--
ALTER TABLE `challan_parts_subcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challan_subcon`
--
ALTER TABLE `challan_subcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `child_part`
--
ALTER TABLE `child_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;

--
-- AUTO_INCREMENT for table `child_part_master`
--
ALTER TABLE `child_part_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `child_part_variance`
--
ALTER TABLE `child_part_variance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consumable_item`
--
ALTER TABLE `consumable_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `customer_part`
--
ALTER TABLE `customer_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `customer_parts_master`
--
ALTER TABLE `customer_parts_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `customer_part_documents`
--
ALTER TABLE `customer_part_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_part_drawing`
--
ALTER TABLE `customer_part_drawing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_part_operation`
--
ALTER TABLE `customer_part_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_part_operation_data`
--
ALTER TABLE `customer_part_operation_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_part_rate`
--
ALTER TABLE `customer_part_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `customer_part_type`
--
ALTER TABLE `customer_part_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_po_tracking`
--
ALTER TABLE `customer_po_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `c_po_so`
--
ALTER TABLE `c_po_so`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deflashing_bom`
--
ALTER TABLE `deflashing_bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deflashing_operation`
--
ALTER TABLE `deflashing_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deflashing_production`
--
ALTER TABLE `deflashing_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deflashing_rqeust`
--
ALTER TABLE `deflashing_rqeust`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispatch_tracking`
--
ALTER TABLE `dispatch_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downtime_master`
--
ALTER TABLE `downtime_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `einvoice_res`
--
ALTER TABLE `einvoice_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_inspection_request`
--
ALTER TABLE `final_inspection_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grn_details`
--
ALTER TABLE `grn_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gst_structure`
--
ALTER TABLE `gst_structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inhouse_parts`
--
ALTER TABLE `inhouse_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `inwarding`
--
ALTER TABLE `inwarding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card`
--
ALTER TABLE `job_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card_details`
--
ALTER TABLE `job_card_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card_details_operations`
--
ALTER TABLE `job_card_details_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card_prod_qty`
--
ALTER TABLE `job_card_prod_qty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loading_user`
--
ALTER TABLE `loading_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `machine_mold`
--
ALTER TABLE `machine_mold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine_request`
--
ALTER TABLE `machine_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine_request_parts`
--
ALTER TABLE `machine_request_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `molding_production`
--
ALTER TABLE `molding_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `molding_stock_transfer`
--
ALTER TABLE `molding_stock_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mold_maintenance`
--
ALTER TABLE `mold_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_po`
--
ALTER TABLE `new_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_po_sub`
--
ALTER TABLE `new_po_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_sales`
--
ALTER TABLE `new_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `new_sales_rejection`
--
ALTER TABLE `new_sales_rejection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_sales_subcon`
--
ALTER TABLE `new_sales_subcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operations_bom`
--
ALTER TABLE `operations_bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT for table `operations_bom_inputs`
--
ALTER TABLE `operations_bom_inputs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;

--
-- AUTO_INCREMENT for table `operation_data`
--
ALTER TABLE `operation_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_data`
--
ALTER TABLE `other_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts_customer_trackings`
--
ALTER TABLE `parts_customer_trackings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `parts_rejection_sales_invoice`
--
ALTER TABLE `parts_rejection_sales_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `part_creation`
--
ALTER TABLE `part_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `part_family`
--
ALTER TABLE `part_family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `part_operations`
--
ALTER TABLE `part_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `part_type`
--
ALTER TABLE `part_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planing`
--
ALTER TABLE `planing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planing_data`
--
ALTER TABLE `planing_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_details`
--
ALTER TABLE `po_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_parts`
--
ALTER TABLE `po_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_parts_sub`
--
ALTER TABLE `po_parts_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_q`
--
ALTER TABLE `p_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_q_history`
--
ALTER TABLE `p_q_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_material_inspection_master`
--
ALTER TABLE `raw_material_inspection_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `raw_material_inspection_report`
--
ALTER TABLE `raw_material_inspection_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejection_flow`
--
ALTER TABLE `rejection_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejection_sales_invoice`
--
ALTER TABLE `rejection_sales_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reject_remark`
--
ALTER TABLE `reject_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `routing`
--
ALTER TABLE `routing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `routing_subcon`
--
ALTER TABLE `routing_subcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_parts`
--
ALTER TABLE `sales_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_parts_subcon`
--
ALTER TABLE `sales_parts_subcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sharing_bom`
--
ALTER TABLE `sharing_bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sharing_issue_request`
--
ALTER TABLE `sharing_issue_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sharing_p_q`
--
ALTER TABLE `sharing_p_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sharing_p_q_history`
--
ALTER TABLE `sharing_p_q_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_changes`
--
ALTER TABLE `stock_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcon_bom`
--
ALTER TABLE `subcon_bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcon_po_inwarding`
--
ALTER TABLE `subcon_po_inwarding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcon_po_inwarding_history`
--
ALTER TABLE `subcon_po_inwarding_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcon_po_inwarding_history_subcon`
--
ALTER TABLE `subcon_po_inwarding_history_subcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcon_po_inwarding_parts`
--
ALTER TABLE `subcon_po_inwarding_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
