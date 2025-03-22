<?php
class Reports_model extends CI_Model {
    
    public function __construct() {
    }

    public function getPayableReportView($condition_arr = [],$search_params = ""){
        $this->db->select([
		    'grn.inwarding_id',
		    'grn.po_part_id',
		    'grn.po_number',
		    'grn.created_date AS grn_created_date',
		    'grn.invoice_number',
		    'inward.invoice_date',
		    'po.supplier_id',
		    'SUM(grn.qty) AS po_qty',
		    'po.po_number AS poNumber',
		    's.supplier_name',
		    'po.po_date',
		    'part.part_number',
		    'part.part_description',
		    'part.hsn_code',
		    'u.uom_name',
		    'po_parts.tax_id',
		    'po_parts.part_id',
		    'po_parts.rate',
		    'tax.igst',
		    'tax.sgst',
		    'tax.cgst',
		    'tax.tcs',
		    'tax.tcs_on_tax',
		    's.*',
		    'SUM(ROUND(grn.accept_qty, 2)) AS total_accept_qty',
		    'SUM(ROUND(grn.accept_qty * po_parts.rate, 2)) AS base_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.cgst) / 100, 2)) AS cgst_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.sgst) / 100, 2)) AS sgst_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.tcs) / 100, 2)) AS tcs_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.igst) / 100, 2)) AS igst_amount',
		    'SUM(ROUND(
		        IF(((grn.accept_qty * po_parts.rate * tax.cgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.cgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.sgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.sgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.tcs) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.tcs) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.igst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.igst) / 100,0) + 
		        ROUND(IF((grn.accept_qty * po_parts.rate) > 0,(grn.accept_qty * po_parts.rate),0), 2) - 
		        IF(pr.amount_received > 0,pr.amount_received,0) - 
		        IF(pr.tds_amount > 0,pr.tds_amount,0), 
		        2)) AS bal_amnt',
		    'po.loading_unloading',
		    'po.loading_unloading_gst',
		    'po.freight_amount',
		    'po.freight_amount_gst',
		    'pr.*',
		    'inward.grn_number',
		    'grn.remark as remarks'
		]);

		$this->db->from('grn_details grn');
		$this->db->join('inwarding inward', 'inward.id = grn.inwarding_id', 'inner');
		$this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'inner');
		$this->db->join('new_po po', 'po.id = grn.po_number', 'inner');
		$this->db->join('child_part part', 'part.id = po_parts.part_id', 'inner');
		$this->db->join('uom u', 'u.id = po_parts.uom_id', 'inner');
		$this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id', 'inner');
		$this->db->join('supplier s', 's.id = po.supplier_id', 'inner');
		$this->db->join('payable_report pr', 'inward.grn_number = pr.grn_number', 'left');

		$this->db->where('po.clientId', $this->Unit->getSessionClientId());
		$this->db->where('inward.grn_number !=', '');
		if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["supplier_part_id"] != "") {
                $this->db->where("s.id", $search_params["supplier_part_id"]);
            }
            if ($search_params["status"] != "") {
            	if($search_params["status"] == "Received"){
            		$this->db->having('bal_amnt', 0);
            	}else{
            		$this->db->having('bal_amnt >', 0);
            	}
            }
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                's.supplier_name',
	                'inward.grn_number',
	                'grn.created_date',
	                'grn.invoice_number',
	                'inward.invoice_date',
	                'pr.payment_receipt_date',
	                'pr.transaction_details',
	                'grn.remark',
	                'pr.amount_received'
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }
        
        $this->db->group_by("inward.grn_number");

		$result_obj = $this->db->get();
				
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }

    public function getReceivableReportCount( $condition_arr = [],$search_params = ""){
        $this->db->select([
		    'grn.inwarding_id',
		    'grn.po_part_id',
		    'grn.po_number',
		    'grn.created_date AS grn_created_date',
		    'grn.invoice_number',
		    'inward.invoice_date',
		    'po.supplier_id',
		    'SUM(grn.qty) AS po_qty',
		    'po.po_number AS poNumber',
		    's.supplier_name',
		    'po.po_date',
		    'part.part_number',
		    'part.part_description',
		    'part.hsn_code',
		    'u.uom_name',
		    'po_parts.tax_id',
		    'po_parts.part_id',
		    'po_parts.rate',
		    'tax.igst',
		    'tax.sgst',
		    'tax.cgst',
		    'tax.tcs',
		    'tax.tcs_on_tax',
		    's.*',
		    'SUM(ROUND(grn.accept_qty, 2)) AS total_accept_qty',
		    'SUM(ROUND(grn.accept_qty * po_parts.rate, 2)) AS base_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.cgst) / 100, 2)) AS cgst_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.sgst) / 100, 2)) AS sgst_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.tcs) / 100, 2)) AS tcs_amount',
		    'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.igst) / 100, 2)) AS igst_amount',
		    'SUM(ROUND(
		        IF(((grn.accept_qty * po_parts.rate * tax.cgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.cgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.sgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.sgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.tcs) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.tcs) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.igst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.igst) / 100,0) + 
		        ROUND(IF((grn.accept_qty * po_parts.rate) > 0,(grn.accept_qty * po_parts.rate),0), 2) - 
		        IF(pr.amount_received > 0,pr.amount_received,0) - 
		        IF(pr.tds_amount > 0,pr.tds_amount,0), 
		        2)) AS bal_amnt',
		    'po.loading_unloading',
		    'po.loading_unloading_gst',
		    'po.freight_amount',
		    'po.freight_amount_gst',
		    'pr.*',
		    'inward.grn_number',
		    'grn.remark as remarks'
		]);

		$this->db->from('grn_details grn');
		$this->db->join('inwarding inward', 'inward.id = grn.inwarding_id', 'inner');
		$this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'inner');
		$this->db->join('new_po po', 'po.id = grn.po_number', 'inner');
		$this->db->join('child_part part', 'part.id = po_parts.part_id', 'inner');
		$this->db->join('uom u', 'u.id = po_parts.uom_id', 'inner');
		$this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id', 'inner');
		$this->db->join('supplier s', 's.id = po.supplier_id', 'inner');
		$this->db->join('payable_report pr', 'inward.grn_number = pr.grn_number', 'left');

		$this->db->where('po.clientId', $this->Unit->getSessionClientId());
		$this->db->where('inward.grn_number !=', '');
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["supplier_part_id"] != "") {
                $this->db->where("s.id", $search_params["supplier_part_id"]);
            }
            if ($search_params["status"] != "") {
            	if($search_params["status"] == "Received"){
            		$this->db->having('bal_amnt ', 0);
            	}else{
            		$this->db->having('bal_amnt >', 0);
            	}
            }
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                's.supplier_name',
	                'inward.grn_number',
	                'grn.created_date',
	                'grn.invoice_number',
	                'inward.invoice_date',
	                'pr.payment_receipt_date',
	                'pr.transaction_details',
	                'grn.remark',
	                'pr.amount_received'
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }
        
        $this->db->group_by("inward.grn_number");

		$result_obj = $this->db->get();
				
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }


    public function getSalesSummaryReportView($condition_arr = [],$search_params = ""){
        $this->db->select("
			cp.part_number,
			cp.part_description,
			c.customer_name,
			sales.status,
			sales.sales_number as salesNumber,
			sales.created_date AS sales_date,
			SUM(parts.basic_total) as basic_total,
			SUM(parts.total_rate) as total_rate,
			SUM(parts.tcs_amount) as tcs_amount,
			SUM(parts.sgst_amount) as sgst_amount,
			SUM(parts.cgst_amount) as cgst_amount,
			SUM(parts.igst_amount) as igst_amount,
			SUM(parts.gst_amount) as gst_amount,
			sales.total_sales_amount as total_sales_amount,
			sales.total_gst_amount as total_gst_amount,
			sales.discount_amount as total_discount_amount,
			sales.discountType as discountType,
			SUM(parts.qty) as qty,
			parts.tax_id as taxid,
			parts.po_number,
			parts.hsn_code,
			sales.id as sales_id,
			sales.vehicle_number
			");

		$this->db->from('new_sales AS sales');
		$this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
		$this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
		$this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');

		// Apply conditions
		$this->db->where('sales.clientId', $this->Unit->getSessionClientId());
		$this->db->where("sales.sales_number NOT LIKE 'TEMP%'", NULL, FALSE);
		$this->db->where_not_in('sales.status', ['pending','unlocked']);
		if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["customer_part_id"] != "") {
                $this->db->where("c.id", $search_params["customer_part_id"]);
            }
            if ($search_params["hsn_code"] != "") {
                // $this->db->where("parts.hsn_code", $search_params["hsn_code"]);
            }
   
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                'c.customer_name',
	                'parts.po_number',
	                'sales.sales_number',
	                'sales.created_date',
	                'sales.status',
	                'parts.qty',
	                'sales.discount_amount',
	                'sales.vehicle_number'
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }
			

		$this->db->group_by('sales.sales_number');

		$result_obj = $this->db->get();
				
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }

    public function getSalesSummaryReportCount( $condition_arr = [],$search_params = ""){
        $this->db->select("
			cp.part_number,
			cp.part_description,
			c.customer_name,
			sales.status,
			sales.sales_number as salesNumber,
			sales.created_date AS sales_date,
			SUM(parts.basic_total) as basic_total,
			SUM(parts.total_rate) as total_rate,
			SUM(parts.tcs_amount) as tcs_amount,
			SUM(parts.sgst_amount) as sgst_amount,
			SUM(parts.cgst_amount) as cgst_amount,
			SUM(parts.igst_amount) as igst_amount,
			SUM(parts.gst_amount) as gst_amount,
			sales.total_sales_amount as total_sales_amount,
			sales.total_gst_amount as total_gst_amount,
			sales.discount_amount as total_discount_amount,
			sales.discountType as discountType,
			SUM(parts.qty) as qty,
			parts.tax_id as taxid,
			parts.po_number,
			parts.hsn_code
			");

			$this->db->from('new_sales AS sales');
			$this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
			$this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
			$this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');

			// Apply conditions
			$this->db->where('sales.clientId', $this->Unit->getSessionClientId());
			$this->db->where("sales.sales_number NOT LIKE 'TEMP%'", NULL, FALSE);
			$this->db->where_not_in('sales.status', ['pending','unlocked']);

		if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["customer_part_id"] != "") {
                $this->db->where("c.id", $search_params["customer_part_id"]);
            }
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
   			if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                'c.customer_name',
	                'parts.po_number',
	                'sales.sales_number',
	                'sales.created_date',
	                'sales.status',
	                'parts.qty',
	                'sales.discount_amount',
	                'sales.vehicle_number'
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }

			$this->db->group_by('sales.sales_number');

		$result_obj = $this->db->get();
				
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getGrnSummaryReportView($condition_arr = [],$search_params = ""){
        $this->db->select('
		    grn.inwarding_id,
		    inward.grn_number,
		    grn.po_part_id,
		    grn.po_number,
		    grn.created_date AS grn_created_date,
		    grn.invoice_number,
		    inward.invoice_date,
		    po.supplier_id,
		    SUM(grn.qty) AS po_qty,
		    po.po_number AS poNumber,
		    s.supplier_name,
		    po.po_date,
		    part.part_number,
		    part.part_description,
		    part.hsn_code,
		    u.uom_name,
		    po_parts.tax_id,
		    po_parts.part_id,
		    SUM(po_parts.rate) as rate,
		    SUM(grn.accept_qty) as accept_qty,
		    SUM(tax.igst) as igst,
		    SUM(tax.sgst) as sgst,
		    SUM(tax.cgst) as cgst,
		    SUM(tax.tcs) as tcs,
		    SUM(tax.tcs_on_tax) as tcs_on_tax,
		    SUM(ROUND((grn.accept_qty * po_parts.rate), 2)) AS base_amount,
		    SUM(ROUND(((grn.accept_qty * po_parts.rate) * tax.cgst) / 100, 2)) AS cgst_amount,
		    SUM(ROUND(((grn.accept_qty * po_parts.rate) * tax.sgst) / 100, 2)) AS sgst_amount,
		    SUM(ROUND(IF((((grn.accept_qty * po_parts.rate) * tax.tcs) / 100)>0,(((grn.accept_qty * po_parts.rate) * tax.tcs) / 100),0),2)) AS tcs_amount,
		    SUM(ROUND(((grn.accept_qty * po_parts.rate) * tax.igst) / 100, 2)) AS igst_amount,
		    SUM(ROUND(
		        IF(((grn.accept_qty * po_parts.rate * tax.cgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.cgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.sgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.sgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.tcs) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.tcs) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.igst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.igst) / 100,0), 
		        2)) AS gst_amount,
		    po.loading_unloading,
		    po.loading_unloading_gst,
		    SUM(po.freight_amount) as freight_amount,
		    SUM(po.freight_amount_gst) as freight_amount_gst
		');

		$this->db->from('grn_details grn');
		$this->db->join('inwarding inward', 'inward.id = grn.inwarding_id');
		$this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id');
		$this->db->join('new_po po', 'po.id = grn.po_number');
		$this->db->join('child_part part', 'part.id = po_parts.part_id');
		$this->db->join('uom u', 'u.id = po_parts.uom_id');
		$this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id');
		$this->db->join('supplier s', 's.id = po.supplier_id');
		$this->db->where('po.clientId', $this->Unit->getSessionClientId());
		if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["supplier_id"] != "") {
                $this->db->where("s.id", $search_params["supplier_id"]);
            }
            if ($search_params["hsn_code"] != "") {
                // $this->db->where("parts.hsn_code", $search_params["hsn_code"]);
            }
   
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                's.supplier_name',
	                'po.po_number',
	                'po.po_date',
	                'inward.grn_number',
	                'grn.created_date ',
	                'grn.invoice_number',
	                'inward.invoice_date',
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }
		$this->db->group_by('inward.grn_number');

		$result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getGrnSummaryReportCount($condition_arr = [],$search_params = ""){
        $this->db->select('
		    grn.inwarding_id,
		    inward.grn_number,
		    grn.po_part_id,
		    grn.po_number,
		    grn.created_date AS grn_created_date,
		    grn.invoice_number,
		    inward.invoice_date,
		    po.supplier_id,
		    SUM(grn.qty) AS po_qty,
		    po.po_number AS poNumber,
		    s.supplier_name,
		    po.po_date,
		    part.part_number,
		    part.part_description,
		    part.hsn_code,
		    u.uom_name,
		    po_parts.tax_id,
		    po_parts.part_id,
		    SUM(po_parts.rate) as rate,
		    SUM(grn.accept_qty) as accept_qty,
		    SUM(tax.igst) as igst,
		    SUM(tax.sgst) as sgst,
		    SUM(tax.cgst) as cgst,
		    SUM(tax.tcs) as tcs,
		    SUM(tax.tcs_on_tax) as tcs_on_tax,
		    SUM(ROUND((grn.accept_qty * po_parts.rate), 2)) AS base_amount,
		    SUM(ROUND(((grn.accept_qty * po_parts.rate) * tax.cgst) / 100, 2)) AS cgst_amount,
		    SUM(ROUND(((grn.accept_qty * po_parts.rate) * tax.sgst) / 100, 2)) AS sgst_amount,
		    SUM(ROUND(IF((((grn.accept_qty * po_parts.rate) * tax.tcs) / 100)>0,(((grn.accept_qty * po_parts.rate) * tax.tcs) / 100),0),2)) AS tcs_amount,
		    SUM(ROUND(((grn.accept_qty * po_parts.rate) * tax.igst) / 100, 2)) AS igst_amount,
		    SUM(ROUND(
		        IF(((grn.accept_qty * po_parts.rate * tax.cgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.cgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.sgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.sgst) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.tcs) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.tcs) / 100,0) + 
		        IF(((grn.accept_qty * po_parts.rate * tax.igst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.igst) / 100,0), 
		        2)) AS gst_amount,
		    po.loading_unloading,
		    po.loading_unloading_gst,
		    SUM(po.freight_amount) as freight_amount,
		    SUM(po.freight_amount_gst) as freight_amount_gst
		');

		$this->db->from('grn_details grn');
		$this->db->join('inwarding inward', 'inward.id = grn.inwarding_id');
		$this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id');
		$this->db->join('new_po po', 'po.id = grn.po_number');
		$this->db->join('child_part part', 'part.id = po_parts.part_id');
		$this->db->join('uom u', 'u.id = po_parts.uom_id');
		$this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id');
		$this->db->join('supplier s', 's.id = po.supplier_id');

		$this->db->where('po.clientId', $this->Unit->getSessionClientId());
		 if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["supplier_id"] != "") {
                $this->db->where("s.id", $search_params["supplier_id"]);
            }
            if ($search_params["hsn_code"] != "") {
                // $this->db->where("parts.hsn_code", $search_params["hsn_code"]);
            }
   
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                's.supplier_name',
	                'po.po_number',
	                'po.po_date',
	                'inward.grn_number',
	                'grn.created_date ',
	                'grn.invoice_number',
	                'inward.invoice_date',
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }
		$this->db->group_by('inward.grn_number');

		$result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }


    /* daily stock report */
    public function checkStockEntry($data){
        $this->db->select("d.*");
        $this->db->from("daily_stock as d");
        $this->db->where("d.stock_date", $data);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;

    }
    public function getClient(){
        $this->db->select("c.*");
        $this->db->from("client as c");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;

    }

    /* scrap report data */
    public function getScrapReportData(){
        $this->db->select("SUM(pq.scrap_factor) as scrap_stock,sc.scrap_category,sc.scrap_category_master_id");
        $this->db->from("p_q as pq");
        $this->db->join('operations_bom ob', 'ob.output_part_id = pq.output_part_id AND ob.output_part_table_name = "inhouse_parts"','inner');
        $this->db->join('customer_parts_master  cp', 'cp.part_number = ob.customer_part_number AND cp.scrap_category_id >0','inner');
        $this->db->join('scrap_category_master sc', 'sc.scrap_category_master_id = cp.scrap_category_id
WHERE pq.output_part_table_name = "inhouse_parts"','inner');
        $this->db->where("pq.output_part_table_name", "inhouse_parts");
        $this->db->group_by("cp.scrap_category_id");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;

    }
   
   	public function getScrapTransferData(){
        $this->db->select("SUM(s.stock) as scrap_stock,s.scrap_category_id");
        $this->db->from("scrap_transfer_stock as s");
        $this->db->group_by("s.scrap_category_id");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;

    }


    public function getProductionScrapReportDataView($condition_arr = [],$search_params = ""){
    	$this->db->select('pq.scrap_factor AS scrap_qty, sc.scrap_category, pq.date, in.part_number as operation_part_no, in.part_description as operation_part_name, CONCAT(s.shift_type,"/",s.name,"/",s.start_time,"/",s.end_time) AS shift,CONCAT("JO-",pq.id) as job_no,u.uom_name as uom_name');
		$this->db->from('p_q AS pq');
		$this->db->join('operations_bom AS ob', 'ob.output_part_id = pq.output_part_id AND ob.output_part_table_name = "inhouse_parts"', 'inner');
		$this->db->join('inhouse_parts AS in', 'in.id = pq.output_part_id', 'inner');
		$this->db->join('uom AS u', 'u.id = in.uom_id', 'inner');
		$this->db->join('shifts AS s', 's.id = pq.shift_id', 'inner');
		$this->db->join('customer_parts_master AS cp', 'cp.part_number = ob.customer_part_number AND cp.scrap_category_id > 0', 'inner');
		$this->db->join('scrap_category_master AS sc', 'sc.scrap_category_master_id = cp.scrap_category_id', 'inner');
		$this->db->where('pq.output_part_table_name', 'inhouse_parts');
		// $this->db->where('po.clientId', $this->Unit->getSessionClientId());
		if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["scrap_category"] != "") {
                $this->db->where("cp.scrap_category_id", $search_params["scrap_category"]);
            }
   
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(pq.date, '%Y-%m-%d') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                'pq.scrap_factor',
	                'sc.scrap_category',
	                'pq.date',
	                'in.part_number',
	                'in.part_description ',
	                's.shift_type',
	                's.start_time',
	                's.end_time',
	                'pq.id',
	                'u.uom_name'
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }

		$result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }
    public function getProductionScrapReportDataCount($condition_arr = [],$search_params = ""){
    	$this->db->select('pq.id as job_no');
		$this->db->from('p_q AS pq');
		$this->db->join('operations_bom AS ob', 'ob.output_part_id = pq.output_part_id AND ob.output_part_table_name = "inhouse_parts"', 'inner');
		$this->db->join('inhouse_parts AS in', 'in.id = pq.output_part_id', 'inner');
		$this->db->join('uom AS u', 'u.id = in.uom_id', 'inner');
		$this->db->join('shifts AS s', 's.id = pq.shift_id', 'inner');
		$this->db->join('customer_parts_master AS cp', 'cp.part_number = ob.customer_part_number AND cp.scrap_category_id > 0', 'inner');
		$this->db->join('scrap_category_master AS sc', 'sc.scrap_category_master_id = cp.scrap_category_id', 'inner');
		$this->db->where('pq.output_part_table_name', 'inhouse_parts');
		// $this->db->where('po.clientId', $this->Unit->getSessionClientId());
		
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["scrap_category"] != "") {
                $this->db->where("cp.scrap_category_id", $search_params["scrap_category"]);
            }
   			if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(pq.date, '%Y-%m-%d') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
   			if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                'pq.scrap_factor',
	                'sc.scrap_category',
	                'pq.date',
	                'in.part_number',
	                'in.part_description ',
	                's.shift_type',
	                's.start_time',
	                's.end_time',
	                'pq.id',
	                'u.uom_name'
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }

		$result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }

    public function getProductionScrapTransferDataView($condition_arr = [],$search_params = ""){
    	$this->db->select('st.*,cp.part_number,cp.part_description,sm.scrap_category');
		$this->db->from('scrap_transfer_stock AS st');
		$this->db->join('customer_parts_master AS cp', 'cp.id = st.customer_part_id', 'inner');
		$this->db->join('scrap_category_master AS sm', 'sm.scrap_category_master_id = st.scrap_category_id', 'inner');
		if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["scrap_product"] != "") {
                $this->db->where("st.customer_part_id", $search_params["scrap_product"]);
            }
   
            if ($search_params["date_range"] != "") {
	            $date_filter =  explode((" - "),$search_params["date_range"]);
				$data['start_date'] = $date_filter[0];
				$data['end_date'] = $date_filter[1];
				$this->db->where("STR_TO_DATE(st.added_date, '%Y-%m-%d') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
			}
            
            if (isset($search_params["value"]) && $search_params["value"] != "") {
	            $keyword = $search_params["value"];
	            $this->db->group_start();
	            $fields = [
	                'cp.part_number',
	                'cp.part_description',
	                // Add other fields to search as needed
	            ];
	            
	            foreach ($fields as $field) {
	                $this->db->or_like($field, $keyword);
	            }
	            $this->db->group_end(); // End the group of OR conditions
	        }
        }

		$result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }




}
?>