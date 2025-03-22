-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sept 30, 2024 at 02:13 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.0.33-75+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `sales_parts` ADD `discounted_amount` DECIMAL(15,2) NOT NULL AFTER `gst_amount`;

COMMIT;

UPDATE sales_parts sp
				JOIN gst_structure gs ON gs.id = sp.tax_id
				JOIN new_sales ns ON ns.id = sp.sales_id
				SET
					sp.discounted_amount = round(((sp.part_price * qty) * ns.discount / 100),2),
					sp.cgst_amount = round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2),
					sp.sgst_amount = round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2),
					sp.igst_amount = round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2),
					sp.tcs_amount = CASE
						WHEN gs.tcs_on_tax = 'no' THEN
							round(((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.tcs) / 100),2)
						ELSE
							round((((
							round(((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2)) * gs.tcs) / 100),2)
						END,
					sp.gst_amount = 
							(round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2)),
					sp.total_rate = (
									round(((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)),2) +
									round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2)+
									round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2) +
									round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2)
								),
					sp.basic_total = round(((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)),2);
					
					
					

COMMIT;
	
INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('99-SalesInvoice-Discount.sql', CURRENT_TIMESTAMP);

COMMIT;