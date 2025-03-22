SELECT d.id, d.molding_productionKy,d.rejection_reasonKy,d.rejection_qty,r.name 
		FROM mold_production_rejection_details d, reject_remark r 
		where d.molding_productionKy = 10 AND r.id = d.rejection_reasonKy


SELECT c.customer_name,cp.part_number,
		cp.part_description FROM customer_part cp, customer c WHERE cp.id = 4 AND cp.customer_id =  c.id


SELECT p.date, m.name, s.shift_type, s.name as shift_name
		from machine m, shifts s, molding_production p where m.id = p.machine_id AND s.id = p.shift_id AND p.id = 10 


SELECT *
FROM `reject_remark`
ORDER BY `id` DESC



--------------------------
molding_production:
	machine_id
	operator_id
	rejection_qty
	
customer_part_details
molding_prod_details

rejection_details

Rejection Reason	Rejection QTY	Customer	Customer Part no/description	Date/shift		Machine		Operator
									
									
c.customer_name

select p.customer_part_id, 
-- c.customer_name, cp.part_number , 
p.date as prod_date, 
m.name as machine_name, s.shift_type, s.name as shift_name
FROM molding_production p, machine m, shifts s
-- , customer_part cp, customer c
WHERE p.id = 10 
AND p.machine_id = m.id 
AND p.shift_id = s.id 
-- AND p.customer_part_id = cp.customer_id
order by p.customer_part_id asc;
									
									
SELECT d.rejection_reasonKy, d.rejection_qty, c.customer_name, cp.part_number, 
		FROM mold_production_rejection_details d, reject_remark r, customer_part cp, customer c
		where d.molding_productionKy = 10 AND r.id = d.rejection_reasonKy
		AND cp.id = 4 AND cp.customer_id =  c.id
		
		
---- Rejection report Query ---
select 
c.customer_name, cp.part_number , r.name as rejection_reason, d.rejection_qty,
p.date as prod_date, s.shift_type, s.name as shift_name, 
m.name as machine_name, o.name as operator_name
FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
, customer_part cp, customer c, operator o
WHERE d.molding_productionKy = p.id
AND r.id = d.rejection_reasonKy
AND p.customer_part_id = cp.id
AND c.id =  cp.customer_id
AND p.machine_id = m.id 
AND p.shift_id = s.id
AND p.operator_id = o.id 
order by c.customer_name asc, r.name asc;


-- Total Rejection Qty
select sum(d.rejection_qty),
FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
, customer_part cp, customer c, operator o
WHERE d.molding_productionKy = p.id
AND r.id = d.rejection_reasonKy
AND p.customer_part_id = cp.id
AND c.id =  cp.customer_id
AND p.machine_id = m.id 
AND p.shift_id = s.id
AND p.operator_id = o.id 
group by p.customer_part_id;


-- Total Rejection Qty by reason
select r.name, sum(d.rejection_qty) as total_rejection_qty
FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
, customer_part cp, customer c, operator o
WHERE d.molding_productionKy = p.id
AND r.id = d.rejection_reasonKy
AND p.customer_part_id = cp.id
AND c.id =  cp.customer_id
AND p.machine_id = m.id 
AND p.shift_id = s.id
AND p.operator_id = o.id 
group by r.name
order by total_rejection_qty desc;

-- Total Rejection Qty by Operator
select o.name, r.name, sum(d.rejection_qty) as total_rejection_qty
FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
, customer_part cp, customer c, operator o
WHERE d.molding_productionKy = p.id
AND r.id = d.rejection_reasonKy
AND p.customer_part_id = cp.id
AND c.id =  cp.customer_id
AND p.machine_id = m.id 
AND p.shift_id = s.id
AND p.operator_id = o.id 
group by r.name, o.name
order by total_rejection_qty desc

-- Total Machine Qty by Operator
select o.name, r.name, sum(d.rejection_qty) as total_rejection_qty
FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
, customer_part cp, customer c, operator o
WHERE d.molding_productionKy = p.id
AND r.id = d.rejection_reasonKy
AND p.customer_part_id = cp.id
AND c.id =  cp.customer_id
AND p.machine_id = m.id 
AND p.shift_id = s.id
AND p.operator_id = o.id 
group by r.name, o.name
order by total_rejection_qty desc


report_prod_rejection.php
report_prod_rejection
P_Molding
header.php

max_rejection_reason
operator_analysis
total_rejection