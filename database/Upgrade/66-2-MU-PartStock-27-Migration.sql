-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 02:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

COMMIT;

-- -------------------- CHILD PART (SupplierPart) MIGRATION  ------------------------
-- FIND out missing entries for different client
/* 
SELECT DISTINCT stock1.childPartId
		FROM child_part_stock stock1
		WHERE NOT EXISTS (
			SELECT 1
			FROM child_part_stock stock2
			WHERE stock2.childPartId = stock1.childPartId
			AND stock2.clientId = 1
		);
*/

INSERT INTO child_part_stock (childPartId, clientId, created_id, date, time, timestamp)
SELECT cp.childPartId, c.id, cp.created_id, cp.date, cp.time, cp.timestamp
FROM (SELECT DISTINCT childPartId, created_id, date, time, timestamp FROM child_part_stock) cp
CROSS JOIN client c
LEFT JOIN child_part_stock stock
ON cp.childPartId = stock.childPartId
AND c.id = stock.clientId
WHERE stock.childPartId IS NULL;

COMMIT;

-- for specific part id ----
/* 
INSERT INTO child_part_stock (childPartId, clientId, created_id, date, time, timestamp)
SELECT cp.childPartId, c.id, cp.created_id, cp.date, cp.time, cp.timestamp
FROM (SELECT DISTINCT childPartId, created_id, date, time, timestamp FROM child_part_stock) cp
CROSS JOIN client c
LEFT JOIN child_part_stock stock 
ON cp.childPartId = stock.childPartId 
AND c.id = stock.clientId
WHERE stock.childPartId IS NULL AND cp.childPartId = 289;

*/

-- -------------------- INHOUSE PART ITEM MIGRATION  ------------------------
-- FIND out missing entries for different client
/* 
SELECT DISTINCT stock1.inhouse_parts_id
		FROM inhouse_parts_stock stock1
		WHERE NOT EXISTS (
			SELECT 1
			FROM inhouse_parts_stock stock2
			WHERE stock2.inhouse_parts_id = stock1.inhouse_parts_id
			AND stock2.clientId = 1
		);
*/

INSERT INTO inhouse_parts_stock (inhouse_parts_id, clientId, created_id, date, time, timestamp)
SELECT ip.inhouse_parts_id, c.id, ip.created_id, ip.date, ip.time, ip.timestamp
FROM (SELECT DISTINCT inhouse_parts_id, created_id, date, time, timestamp FROM inhouse_parts_stock) ip
CROSS JOIN client c
LEFT JOIN inhouse_parts_stock stock
ON ip.inhouse_parts_id = stock.inhouse_parts_id
AND c.id = stock.clientId
WHERE stock.inhouse_parts_id IS NULL;

-- for specific part id ----
/*
INSERT INTO inhouse_parts_stock (inhouse_parts_id, clientId, created_id, date, time, timestamp)
SELECT ip.inhouse_parts_id, c.id, ip.created_id, ip.date, ip.time, ip.timestamp
FROM (SELECT DISTINCT inhouse_parts_id, created_id, date, time, timestamp FROM inhouse_parts_stock) ip
CROSS JOIN client c
LEFT JOIN inhouse_parts_stock stock
ON ip.inhouse_parts_id = stock.inhouse_parts_id
AND c.id = stock.clientId
WHERE stock.inhouse_parts_id IS NULL AND ip.inhouse_parts_id = 289;
*/

COMMIT;


-- -------------------- CUSTOMER PART ITEM MIGRATION  -------------------------------

-- FIND out missing entries for different client for customer part
/* 

SELECT DISTINCT stock1.customer_parts_master_id
		FROM customer_parts_master_stock stock1
		WHERE NOT EXISTS (
			SELECT 1
			FROM customer_parts_master_stock stock2
			WHERE stock2.customer_parts_master_id = stock1.customer_parts_master_id
			AND stock2.clientId = 1
		);
*/
		
INSERT INTO customer_parts_master_stock (customer_parts_master_id, clientId, created_id, date, time, timestamp)
SELECT cp.customer_parts_master_id, c.id, cp.created_id, cp.date, cp.time, cp.timestamp
FROM (SELECT DISTINCT customer_parts_master_id, created_id, date, time, timestamp FROM customer_parts_master_stock) cp
CROSS JOIN client c
LEFT JOIN customer_parts_master_stock stock
ON cp.customer_parts_master_id = stock.customer_parts_master_id
AND c.id = stock.clientId
WHERE stock.customer_parts_master_id IS NULL;

-- for specific part id ----
/*
INSERT INTO inhouse_parts_stock (inhouse_parts_id, clientId, created_id, date, time, timestamp)
SELECT cp.customer_parts_master_id, c.id, cp.created_id, cp.date, cp.time, cp.timestamp
FROM (SELECT DISTINCT customer_parts_master_id, created_id, date, time, timestamp FROM customer_parts_master_stock) cp
CROSS JOIN client c
LEFT JOIN customer_parts_master_stock stock
ON cp.customer_parts_master_id = stock.customer_parts_master_id
AND c.id = stock.clientId
WHERE stock.customer_parts_master_id IS NULL AND cp.customer_parts_master_id = 289;
*/

COMMIT;


-- ADD ON FOR REFERENCE ONLY -----------------

-- Check incorrect clientId entries

-- set clientId = 2 where clientId = 0

-- ------------ Migration of existing stock for 1st Unit ------------
-- Get list of all those missing entries for 1st clientID
/*
		SELECT DISTINCT stock1.childPartId
		FROM child_part_stock stock1
		WHERE NOT EXISTS (
			SELECT 1
			FROM child_part_stock stock2
			WHERE stock2.childPartId = stock1.childPartId
			AND stock2.clientId = 1
		);
*/

-- Add stock entry for clientId =2 where clientid part is with clientID=2 is missing
/* INSERT INTO child_part_stock (childPartId, clientId, created_id, date, time, timestamp)
SELECT DISTINCT stock1.childPartId, 1 AS clientId, stock1.created_id, stock1.date, stock1.time, stock1.timestamp
FROM child_part_stock stock1
LEFT JOIN child_part_stock stock2
ON stock1.childPartId = stock2.childPartId AND stock2.clientId = 1
WHERE stock2.childPartId IS NULL AND stock1.clientId = 2;

COMMIT;

*/


-- ------------ Migration of existing stock for 2nd Unit ------------
-- Get list of all those missing entries for 2nd clientID
/* 
		SELECT DISTINCT stock1.childPartId
		FROM child_part_stock stock1
		WHERE NOT EXISTS (
			SELECT 1
			FROM child_part_stock stock2
			WHERE stock2.childPartId = stock1.childPartId
			AND stock2.clientId = 2
		);
*/

-- Add stock entry for clientId =2 where clientid part is with clientID=2 is missing

/* 

INSERT INTO child_part_stock (childPartId, clientId, created_id, date, time, timestamp)
SELECT DISTINCT stock1.childPartId, 2 AS clientId, stock1.created_id, stock1.date, stock1.time, stock1.timestamp
FROM child_part_stock stock1
LEFT JOIN child_part_stock stock2
ON stock1.childPartId = stock2.childPartId AND stock2.clientId = 2
WHERE stock2.childPartId IS NULL AND stock1.clientId = 1;

COMMIT;

*/
 
INSERT INTO `DB_Upgrade` (`Script_name`, `updated_time`) 
VALUES ('66-2-MU-PartStock-27-Migration.sql', CURRENT_TIMESTAMP);

COMMIT;