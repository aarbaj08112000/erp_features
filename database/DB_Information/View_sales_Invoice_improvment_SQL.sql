SELECT parts.* FROM `sales_parts` as parts, `new_sales` as sales 
WHERE sales.id = parts.sales_id 
AND parts.created_month = ' . $created_month . ' 
AND parts.created_year = ' . $created_year . ' 
AND sales.status = 'lock' ORDER BY parts.id DESC
	

SELECT total_rate, cgst_amount, sgst_amount, igst_amount, tcs_amount, gst_amount, tax.cgst, tax.sgst,	tax.igst, tax.tcs, tax.tcs_on_tax
FROM  sales_parts as parts, gst_structure tax
WHERE parts.sales_id =  1546
AND parts.tax_id = tax.id


CREATE VIEW sales_invoice AS

SELECT parts.sales_id, parts.sales_number, customer_name, ROUND(sum(total_rate),2) as Total, ROUND(sum(cgst_amount),2) as CGST_AMT, ROUND(sum(sgst_amount),2) as SGST_AMT, ROUND(sum(igst_amount),2) as IGST_AMT ,ROUND(sum(tcs_amount),2) as TCS_AMT, ROUND(sum(gst_amount),2) as GST_AMT, tax.cgst, tax.sgst, tax.igst, tax.tcs, tax.tcs_on_tax
FROM  sales_parts as parts, new_sales as sales, gst_structure tax, customer
WHERE sales.status = 'lock'
AND parts.sales_id =  sales.id
AND parts.tax_id = tax.id
AND customer.id = parts.customer_id
GROUP BY parts.sales_id

CREATE VIEW my_view AS
SELECT column1, column2
FROM my_table
WHERE condition;


created_date

array(1) { [0]=> object(stdClass)#37 (14) { ["sales_id"]=> string(4) "1546" ["sales_number"]=> string(13) "BSP/23-24/114" ["customer_name"]=> string(35) "Daebu Automotive Seat India Pvt Ltd" ["Total"]=> string(6) "868.15" ["CGST_AMT"]=> string(5) "94.95" ["SGST_AMT"]=> string(5) "94.95" ["IGST_AMT"]=> string(4) "0.00" ["TCS_AMT"]=> string(4) "0.00" ["GST_AMT"]=> string(6) "189.91" ["cgst"]=> string(2) "14" ["sgst"]=> string(2) "14" ["igst"]=> string(1) "0" ["tcs"]=> NULL ["tcs_on_tax"]=> string(2) "na" } }