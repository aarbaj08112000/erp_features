ALTER TABLE `customer_part_rate` ADD `org_rate` FLOAT NOT NULL AFTER `rate`;
UPDATE `customer_part_rate` SET org_rate = rate;
ALTER TABLE `customer_part_rate` CHANGE `rate` `rate` DECIMAL(15,2) NULL DEFAULT NULL;

SELECT * FROM `customer_part_rate` WHERE org_rate <> rate;


======================= REPLACE DB DATA =================


----------------- USER INFO UPDATES -------------------------
-- replace client specific email to arom
UPDATE userinfo
SET user_email = REPLACE(user_email, 'superpolymers.co.in', 'arom.com')
WHERE user_email LIKE '%superpolymers.co.in%';

-- replace arom specific email to admin
UPDATE userinfo
SET user_email = REPLACE(user_email, 'admin.com', 'arom.com')
WHERE user_email LIKE '%admin.com%';

-- replace user names
UPDATE userinfo
SET user_name = SUBSTRING_INDEX(user_email, '@', 1)
WHERE user_email LIKE '%@%';

-- update password for everyone to password
UPDATE userinfo
SET user_password = 'password';


 ----------------- CLIENT UPDATES -------------------------
 

UPDATE client
SET client_name = 'AROM INFOTECH',
client_unit = 'AROM',
contact_person = 'Raghunath Dinage',
phone_no = '9124511378',
pan_no = 'AABAC4512R',
gst_number= '27AABAC4512R1ZZ';

UPDATE client
SET bank_details = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(bank_details, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE bank_details IS NOT NULL;

UPDATE client
SET address1 = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(address1, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE address1 IS NOT NULL;

UPDATE client
SET emailId = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(emailId, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE emailId IS NOT NULL;

UPDATE client
SET billing_address = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(billing_address, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE billing_address IS NOT NULL;

UPDATE client
SET shifting_address = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(shifting_address, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE shifting_address IS NOT NULL;


-------------- CUSTOMER DATBASE -------------
UPDATE customer
SET bank_details = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(bank_details, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE bank_details IS NOT NULL;


UPDATE customer
SET customer_name = CONCAT('TATA MOTORS','-',id),
pan_no = 'AAABB111AA',
gst_number= '27AAABB111AZZ';

UPDATE customer
SET billing_address = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(billing_address, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE billing_address IS NOT NULL;


UPDATE customer
SET shifting_address = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(shifting_address, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE shifting_address IS NOT NULL;

UPDATE customer
SET address1 = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(address1, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE address1 IS NOT NULL;

UPDATE customer
SET emailId = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(emailId, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE emailId IS NOT NULL;


------------------- supplier UPDATES ----------------------
UPDATE supplier
SET supplier_name = CONCAT('SUPPLIER TATA','-',id),
mobile_no = '9122211777',
gst_number = '27AAAVV111VVV',
pan_card = 'AAAVV111VV';

UPDATE supplier
SET location = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(location, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE location IS NOT NULL;

UPDATE supplier
SET email = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(email, 'A', 'E'), 'B', 'F'), 'C', 'G'), 'S', 'A'), 'T', 'B'), 'L', 'M'), 'M', 'B'), 'R', 'O'), 'G', 'A')
WHERE email IS NOT NULL;
 
 
