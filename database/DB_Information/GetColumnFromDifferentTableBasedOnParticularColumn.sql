--- GET the results from different queries based on particular column read
 here we are checking whether the record is present in a column customer_parts_master_id if yes then get the column value 
 for part_master.part_number else we need to get column value of part.part_number as part_no or part_description
--- 
SELECT 
    m_req.id as id, 
    m.name as machine_name, 
    o.name as operator_name, 
    COALESCE(part_master.part_number, part.part_number) as part_no, 
	COALESCE(part_master.part_description, part.part_description) as part_description, 
    child.part_number as child_part_no, 
    child.part_description as child_desc, 
    u.uom_name, 
    req_parts.qty, 
    child.machine_mold_issue_stock, 
    req_parts.status, 
    req_parts.accepted_qty, 
    req_parts.remark, 
    m_req.created_date, 
    m_req.created_time, 
    m_req.status
FROM 
    machine_request m_req
JOIN 
    machine m ON m_req.machine_id = m.id
JOIN 
    operator o ON m_req.operator_id = o.id
LEFT JOIN 
    customer_parts_master part_master ON m_req.customer_parts_master_id = part_master.id
LEFT JOIN 
    customer_part part ON m_req.customer_part_id = part.id
JOIN 
    machine_request_parts req_parts ON m_req.id = req_parts.machine_request_id
JOIN 
    child_part child ON req_parts.child_part_id = child.id
JOIN 
    uom u ON child.uom_id = u.id
ORDER BY 
    m_req.id DESC;

========================================================================================
	
SELECT 
		m_req.id as id, m.name as machine_name, o.name as operator_name, 
		COALESCE(part_master.part_number, part.part_number) as part_no, 
		COALESCE(part_master.part_description, part.part_description) as part_description, child.part_number as child_part_no, 
		child.part_description as child_desc, u.uom_name, req_parts.qty, child.machine_mold_issue_stock, req_parts.status, 
		req_parts.accepted_qty, req_parts.remark, m_req.created_date, m_req.created_time, m_req.status
		FROM machine_request m_req
		JOIN machine m ON m_req.machine_id = m.id
		JOIN operator o ON m_req.operator_id = o.id
		LEFT JOIN customer_parts_master part_master ON m_req.customer_parts_master_id = part_master.id
		LEFT JOIN customer_part part ON m_req.customer_part_id = part.id
		JOIN machine_request_parts req_parts ON m_req.id = req_parts.machine_request_id
		JOIN child_part child ON req_parts.child_part_id = child.id
		JOIN uom u ON child.uom_id = u.id
		WHERE m_req.status = pending 
		ORDER BY m_req.id DESC
	
