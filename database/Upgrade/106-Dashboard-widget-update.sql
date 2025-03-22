-- Generation Time: Jan 20, 2025

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


UPDATE `widget` SET `widget_funtion` = 'get_payable_due_data' WHERE `widget`.`widget_name` = "TOTAL_PAYABLE_DUE";

COMMIT;

INSERT INTO `DB_Upgrade`
       (`Script_name`
            , `updated_time`
       )
       VALUES
       ('106-Dashboard-widget-update.sql'
            , CURRENT_TIMESTAMP
       )
;

COMMIT;
