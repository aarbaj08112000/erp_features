-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2nd Oct, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------------------------------------
ALTER TABLE `molding_production` CHANGE `rejection_reason` `rejection_reason` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `molding_production` CHANGE `downtime_reason` `downtime_reason` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Add new table for molding production downtime details

CREATE TABLE `mold_production_downtime_details` 
( 
`molding_productionKy` INT(11) NOT NULL ,
`downtime_reasonKy` INT(11) NOT NULL ,
`downtime` INT(11) NOT NULL ,
`updatedttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

ALTER TABLE `mold_production_downtime_details` ADD `id` INT NOT NULL FIRST;

ALTER TABLE `mold_production_downtime_details` ADD PRIMARY KEY (`id`);

ALTER TABLE `mold_production_downtime_details` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `mold_production_downtime_details`
ADD CONSTRAINT `molding_production_downtime_fk`
FOREIGN KEY (`molding_productionKy`) REFERENCES `molding_production`(`id`)
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `mold_production_downtime_details`
ADD CONSTRAINT `downtime_reasonKy`
FOREIGN KEY (`downtime_reasonKy`) REFERENCES `downtime_master`(`id`) 
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `mold_production_downtime_details` ADD UNIQUE `downtime_unique` (`molding_productionKy`, `downtime_reasonKy`);

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('26', '26-Plastic_MoldProduction_Downtime.sql', CURRENT_TIMESTAMP);

COMMIT;


-- migration --
/* insert into mold_production_downtime_details
select mp.id, mp.rejection_qty, rr.id ,mp.created_date
from molding_production mp, reject_remark rr
WHERE mp.rejection_reason = rr.name;
*/

/* 
	insert into mold_production_downtime_details(molding_productionKy,rejection_reasonKy,rejection_qty,updatedttm)
	(select mp.id, mp.rejection_qty, rr.id ,mp.created_date
	from molding_production mp, reject_remark rr
	WHERE mp.rejection_reason = rr.name);
	
*/