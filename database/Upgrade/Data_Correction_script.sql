Error 405: Supplier With In state and Tax Strucutre With In State Does Not Matched, Please select another tax Strucutre

select * from supplier where lower(with_in_state) = 'yes'; --> 60
select * from supplier where lower(with_in_state) = 'no';  --> 4


update supplier SET with_in_state = 'yes' WHERE lower(with_in_state) = 'yes'
update supplier SET with_in_state = 'no' WHERE lower(with_in_state) = 'no';


-- 1st July 2024
-- For single unit we need to update the existing DATABASE with default unit name.
select * from inwarding where delivery_unit not in (select client_unit from client);


For single unit  --->
Update inwarding SET delivery_unit = (select client_unit from client)

--- Build 26 STARTS -----------
-- AIM
Update inwarding SET delivery_unit = 'AIM PLAST';

-- No changes for annu

-- MAYURESH
Update inwarding SET delivery_unit = 'MAYURESH';

-- TUSHAR
Update inwarding SET delivery_unit = 'CHINCHWAD';

-- NO records for SAIS

-- SPERP
Update inwarding SET delivery_unit = 'CHAKAN';

-- Build 26 ENDS ---------------

-- Default data ---
UPDATE customer
SET billing_address = 'Gat No.111, Vikrant Nagar, Chakan,Pune.',
shifting_address = 'Gat No.111, Vikrant Nagar, Chakan,Pune.',
address1 = 'Gat No.111, Vikrant Nagar, Chakan,Pune.',
gst_number = '27AAABA1111A1AA',
pan_no =  'AAAAA1111A',
pin = 410500

-- ---- MONTHLY STOCK UPDATES START ---
UPDATE child_part_stock
SET child_part_stock.stock = child_part.old_stock
FROM child_part_stock
JOIN child_part ON child_part_stock.childPartId = child_part.Id
WHERE child_part.id = 1
AND child_part_stock.clientId = 1
AND child_part.id = 1


SELECT child_part_stock.stock, child_part_stock.clientId, child_part_stock.childPartId
FROM child_part_stock
JOIN child_part ON child_part_stock.childPartId = child_part.Id
WHERE child_part_stock.childPartId IS NOT NULL
AND child_part_stock.clientId = 1
AND child_part.id = 1


UPDATE child_part_stock cps
JOIN child_part cp ON cps.childPartId = cp.Id
SET cps.stock = cp.old_stock
WHERE cp.id = 1 and cps.clientId = 1

---- 1st unit 
UPDATE child_part_stock cps
JOIN child_part cp ON cps.childPartId = cp.Id
SET cps.stock = cp.old_stock
WHERE cps.clientId = 1;

-- 2nd unit
UPDATE child_part_stock cps
JOIN child_part cp ON cps.childPartId = cp.Id
SET cps.stock = cp.old_stock2
WHERE cps.clientId = 2;


UPDATE child_part_stock cps
SET cps.production_qty = 0

-- ---- MONTHLY STOCK UPDATES ENDS ---



clientId in below tables
=============================
new_sales
machine
operator
shifts
stock_changes
sharing_issue_request
stock_report
rejection_flow
new_po
challan
challan_subcon
rejection_sales_invoice
planing_shop_order
receivable_report
planing
molding_production
molding_stock_transfer
final_inspection_request
