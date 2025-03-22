-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 09:01 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
