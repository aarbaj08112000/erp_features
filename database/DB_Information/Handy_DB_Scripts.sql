Handy queries:
===================

1) FIND All the tables and related fields where we have data type as float/double

 
SAMPLE QUERY:
====================================================
	SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE 
	FROM INFORMATION_SCHEMA.COLUMNS 
	WHERE TABLE_SCHEMA = 'your_database_name' 
	AND DATA_TYPE IN ('float', 'double');

WITH SPECIFIC DATABASE:
====================================================
	SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE 
	FROM INFORMATION_SCHEMA.COLUMNS 
	WHERE TABLE_SCHEMA = 'uitest-sheetmetal' 
	AND DATA_TYPE IN ('float', 'double');

******* TAKE THE BACKUP BEFORE DOING ALL THESE *******

Update the table field to use decimal for value
=====================================================
ALTER TABLE child_part_master MODIFY COLUMN part_rate DECIMAL(15,2);
