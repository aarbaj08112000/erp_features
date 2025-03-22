-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28th Sept, 2023 at 06:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------------------------------------
-- Add new table for molding production rejections

CREATE TABLE `mold_production_rejection_details` 
( `molding_productionKy` INT(11) NOT NULL , 
`rejection_reasonKy` INT(11) NOT NULL ,
`rejection_qty` FLOAT NOT NULL , 
`updatedttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP 
) ENGINE = InnoDB;


ALTER TABLE `mold_production_rejection_details` ADD `id` INT NOT NULL FIRST;

ALTER TABLE `mold_production_rejection_details` ADD PRIMARY KEY (`id`);

ALTER TABLE `mold_production_rejection_details` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `mold_production_rejection_details` 
ADD CONSTRAINT `molding_prod_fk` 
FOREIGN KEY (`molding_productionKy`) REFERENCES `molding_production`(`id`) 
ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `mold_production_rejection_details` 
ADD CONSTRAINT `rejection_reasonKy` 
FOREIGN KEY (`rejection_reasonKy`) REFERENCES `reject_remark`(`id`) 
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `mold_production_rejection_details` ADD UNIQUE `rejection_unique` (`molding_productionKy`, `rejection_reasonKy`);

INSERT INTO `DB_Upgrade` (`id`, `Script_name`, `updated_time`) VALUES ('25', '25-Plastic_MoldProduction_multipleRejections.sql', CURRENT_TIMESTAMP);

COMMIT;


-- migration --
/* insert into mold_production_rejection_details
select mp.id, mp.rejection_qty, rr.id ,mp.created_date
from molding_production mp, reject_remark rr
WHERE mp.rejection_reason = rr.name;
*/

/*insert into mold_production_rejection_details(molding_productionKy,rejection_reasonKy,rejection_qty,updatedttm)
(select mp.id, mp.rejection_qty, rr.id ,mp.created_date
from molding_production mp, reject_remark rr
WHERE mp.rejection_reason = rr.name); */
