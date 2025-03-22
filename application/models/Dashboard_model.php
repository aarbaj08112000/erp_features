<?php
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_unit($tab_name = '',$widget_name = '')
	{
	    $this->db->select('c.id as id,c.client_unit as val');
	    $this->db->from('client as c');
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

    public function get_widgets($tab_name = '',$widget_name = '')
	{
		
	    $this->db->select('w.*');
	    $this->db->from('widget as w');
	    $this->db->where('w.tab_name',$tab_name);
	    if($widget_name != '' && $widget_name != null){
	    	$this->db->where('w.widget_name',$widget_name);
	    }
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}


	// Sales tab

	// pie chart - customer sales amount
	public function get_customer_sales($year = '',$month_arr = '')
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('SUM(sp.basic_total) as basic_total, SUM(ns.discount_amount) as total_discount, c.customer_name as customer');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    $this->db->join('customer as c', 'c.id = sp.customer_id', 'left');
	    $this->db->group_by('c.id');
	    if($date != ""){
	    	$this->db->where("sp.created_date",$date);
	    }
	    if($month != ""){
	    	$this->db->where("sp.created_month",$month);
	    }
	    if($year != ""){
	    	if(array_key_exists("year", $month_arr)){
	    		$this->db->where("sp.created_year = ".$month_arr['year']." AND sp.created_month = ".$month_arr['month']."");
	    	}else{
	    		$this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
		    	$this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");	
	    	}
	   	}
		//$this->db->group_by('ns.id');

	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    //pr($this->db->last_query(),1);
	    return $ret_data;
	}

	// Manoj block data including discount
	public function get_sales_sum($date = '',$month = '',$year = '',$month_arr = '')
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('SUM(sp.basic_total) as basic_total, SUM(sp.gst_amount) as gst_amount, SUM(DISTINCT ns.discount_amount) as total_discount,  
				SUM(DISTINCT `ns`.`total_sales_amount`) as total_sales_amount , sp.created_date as created_date');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    if($date != ""){
	    	$this->db->where("sp.created_date",$date);
	    }
	    if($month != ""){
	    	$this->db->where("sp.created_month",$month);
	    	$this->db->where("sp.created_year",date("Y"));
	    }
	    if($year != ""){
			$this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
			$this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
		}
		$this->db->group_by('ns.id');

	    $result_obj = $this->db->get();
		// pr($this->db->last_query(), 1);

	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($ret_data,1);
	    return $ret_data;
	}

	// block data
	public function get_sales_block_count($date = '',$month = '',$year = '',$month_arr = '')
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('sp.basic_total as basic_total,sp.gst_amount as gst_amount, ns.discount_amount as total_discount, sp.created_date as created_date');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    if($date != ""){
	    	$this->db->where("sp.created_date",$date);
	    }
	    if($month != ""){
	    	$this->db->where("sp.created_month",$month);
	    	$this->db->where("sp.created_year",date("Y"));
	    }
	    if($year != ""){
	    $this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
	   	}
	    $result_obj = $this->db->get();
		//pr($this->db->last_query(), 1);

	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_sales_block($year = '',$month_arr = '')
	{
		
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('sp.basic_total as basic_total, ns.discount_amount as total_discount, sp.created_date as created_date,c.id as customer_id,c.customer_name as customer_name');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    $this->db->join('customer as c', 'c.id = sp.customer_id', 'left');
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("sp.created_year = ".$month_arr['year']." AND sp.created_month = ".$month_arr['month']."");
	    }else{
		    $this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
		}

	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_paln_sales_data($month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND pl.clientId = $this->unit";
		}
	    $this->db->select('(cpr.rate * pd.schedule_qty) as total_amount,pl.month as month');
	    $this->db->from('planing as pl');
	    $this->db->join('planing_data as pd', 'pd.planing_id = pl.id');
	    $this->db->join('customer_part_rate as cpr', 'pl.customer_part_id = cpr.customer_master_id');
	    $this->db->where("pl.financial_year = '".$month_arr['start_year']."' AND pl.month IN ('".implode("', '", $month_arr['start_month'])."')");
	    $this->db->or_where("pl.financial_year = '".$month_arr['end_year']."' AND pl.month IN ('".implode("', '", $month_arr['end_month'])."')");
	    if($this->unit > 0){
	    	$this->db->where("pl.clientId",$this->unit);
		}
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_current_month_plan($month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND pl.clientId = $this->unit";
		}
	    $this->db->select('(cpr.rate * pd.schedule_qty) as total_amount');
	    $this->db->from('planing as pl');
	    $this->db->join('planing_data as pd', 'pd.planing_id = pl.id');
	    $this->db->join('customer_part_rate as cpr', 'pl.customer_part_id = cpr.customer_master_id');
	    $this->db->where("pl.financial_year = '".$month_arr['year']."' AND pl.month = '".$month_arr['month']."'".$unit_condition);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	   // pr($this->db->last_query(),1);
	    return $ret_data;
	}


	// Business Analytics tab
    public function get_receivable_due_data($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('sp.basic_total as basic_total,sp.sales_number as sales_number');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    $this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	//sales_vs_purchase_grn
	public function get_sales_purchase_grn($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('SUM(sp.basic_total) as basic_total, sp.created_date as created_date, SUM(distinct ns.discount_amount) as total_discount'); 
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    $this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
		$this->db->group_by("sp.created_month");

	    $result_obj = $this->db->get();
		//pr($this->db->last_query(), 1);
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_purchase_grn_data($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND po.clientId = $this->unit";
		}
	    $this->db->select('(grn.accept_qty * po_parts.rate) as base_amount,grn.created_date as created_date');
	    $this->db->from('grn_details as grn');
	    $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'left');
	    $this->db->join('new_po po', 'po.id = grn.po_number '.$unit_condition);
	    $this->db->where("grn.created_year = ".$month_arr['start_year']." AND grn.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("grn.created_year = ".$month_arr['end_year']." AND grn.created_month <= ".$month_arr['end_month']."");
	    
	   	// $this->db->where('po.clientId',$year);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_material_request_data($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND cps.clientId = $this->unit";
		}
	    $this->db->select('mr.created_date as created_date,(mrp.accepted_qty * cp.store_stock_rate) as total_amount');
	    $this->db->from('machine_request as mr');
	    $this->db->join('machine_request_parts as mrp', 'mrp.machine_request_id = mr.id AND mrp.status="Completed"', 'left');
	    $this->db->join('child_part as cp', 'cp.id = mrp.child_part_id', 'left');
	    $this->db->join('child_part_stock as cps', 'cps.childPartId = mrp.child_part_id '.$unit_condition);
	    $this->db->where("mr.year = ".$month_arr['start_year']." AND mr.month >= ".$month_arr['start_month']."");
	    $this->db->or_where("mr.year = ".$month_arr['end_year']." AND mr.month <= ".$month_arr['end_month']."");
	    $this->db->where('mr.status','Completed');
	   	// $this->db->where('po.clientId',$year);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query());
	    return $ret_data;
	}
	public function get_material_request_data_sheet_metal($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND sc.clientId = $this->unit";
		}
	    $this->db->select('(sc.qty*cp.store_stock_rate) as total_amount,sc.created_date as created_date ');
	    $this->db->from('stock_changes as sc');
	    $this->db->join('child_part as cp', 'cp.id = sc.part_id', 'left');
	    $this->db->where("sc.status = 'stock_transfered'".$unit_condition);
	    $this->db->where("YEAR(STR_TO_DATE(sc.created_date, '%d-%m-%Y')) = ".$month_arr['start_year']." AND MONTH(STR_TO_DATE(sc.created_date, '%d-%m-%Y')) >= ".$month_arr['start_month']."");
	    $this->db->or_where("YEAR(STR_TO_DATE(sc.created_date, '%d-%m-%Y')) = ".$month_arr['end_year']." AND MONTH(STR_TO_DATE(sc.created_date, '%d-%m-%Y')) <= ".$month_arr['end_month']."");
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query());
	    return $ret_data;
	}

	/* account tab */

	public function get_total_receivable_due_gst($year = '',$month_arr = ''){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND n.clientId = $this->unit";
		}
        $this->db->select('s.*, 
            SUM(s.gst_amount) as gst, 
            SUM(s.total_rate) as ttlrt, 
            SUM(s.gst_amount) as gstamnt, 
            SUM(s.tcs_amount) as tcsamnt, 
            cus.customer_name, 
            cus.payment_terms, 
            rrp.payment_receipt_date,
            rrp.amount_received as amount_received, 
            rrp.transaction_details, 
            ns.created_date as created_date_val,
           rrp.tds_amount as tds_amount,
            rrp.remark as remark_val,
            ROUND(SUM(
                IF(s.total_rate > 0,s.total_rate,0) + IF(s.tcs_amount > 0,s.tcs_amount,0)) - IF(rrp.amount_received > 0,rrp.amount_received,0) - IF(rrp.tds_amount > 0,rrp.tds_amount,0), 
                2) AS bal_amnt,
            s.sales_id as sales_id_val');
        
        $this->db->from('sales_parts s');
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" '.$unit_condition, 'inner');
        $this->db->join('new_sales ns', 'ns.id = s.sales_id', 'left');
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        
        $this->db->group_by('s.sales_number');
        
        
        if($year != ""){
	    	if(array_key_exists("year", $month_arr)){
	    		$this->db->where("s.created_year = ".$month_arr['year']." AND s.created_month = ".$month_arr['month']."");
	    	}else{
			    $this->db->where("s.created_year = ".$month_arr['start_year']." AND s.created_month >= ".$month_arr['start_month']."");
			    $this->db->or_where("s.created_year = ".$month_arr['end_year']." AND s.created_month <= ".$month_arr['end_month']."");
		   	}
	   	}
	   	$this->db->having('bal_amnt >', 0);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }
	public function get_total_receivable_paid($year = '',$month_arr = '')
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND rr.clientId = $this->unit";
		}
	    $this->db->select('rr.amount_received as amount_received,sp.created_date as created_date,c.customer_name as customer');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales n', 'sp.sales_id = n.id AND n.status != "unlocked"', 'inner');
	    $this->db->join('receivable_report as rr', 'rr.sales_number = sp.sales_number '.$unit_condition);
	    $this->db->join('customer as c', 'c.id = sp.customer_id', 'left');
	    if($date != ""){
	    	$this->db->where("sp.created_date",$date);
	    }
	    if($month != ""){
	    	$this->db->where("sp.created_month",$month);
	    }
	    if($year != ""){
	    	if(array_key_exists("year", $month_arr)){
	    		$this->db->where("sp.created_year = ".$month_arr['year']." AND sp.created_month = ".$month_arr['month']."");
	    	}else{
			    $this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
			    $this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
		   	}
	   	}
	   	$this->db->group_by('sp.sales_number');
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_sales_purchase_grn_gst($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ns.clientId = $this->unit";
		}
	    $this->db->select('ns.total_gst_amount as total_gst_amount, sp.created_date as created_date');
	    $this->db->from('sales_parts as sp');
	    $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
	    $this->db->where("sp.created_year = ".$month_arr['start_year']." AND sp.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("sp.created_year = ".$month_arr['end_year']." AND sp.created_month <= ".$month_arr['end_month']."");
		$this->db->group_by('ns.id');
	    $result_obj = $this->db->get();
		//pr($this->db->last_query(),1);
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_purchase_grn_gst_data($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND po.clientId = $this->unit";
		}
	    $this->db->select('
	    	ROUND(((grn.accept_qty * po_parts.rate) * tax.cgst) / 100, 2) as cgst_amount, 
			ROUND(((grn.accept_qty * po_parts.rate) * tax.sgst) / 100, 2 ) as sgst_amount,
			ROUND(((grn.accept_qty * po_parts.rate) * tax.tcs) / 100, 2) as tcs_amount,
			ROUND(((grn.accept_qty * po_parts.rate) * tax.igst) / 100, 2) as igst_amount,grn.created_date as created_date');
	    $this->db->from('grn_details as grn');
	    $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'left');
	    $this->db->join('new_po po', 'po.id = grn.po_number '.$unit_condition);
	    $this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id', 'left');
	    $this->db->where("grn.created_year = ".$month_arr['start_year']." AND grn.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("grn.created_year = ".$month_arr['end_year']." AND grn.created_month <= ".$month_arr['end_month']."");
	    
	   	// $this->db->where('po.clientId',$year);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}



	public function get_caterory_purchse_amount($year = '',$month_arr = [])
	{
	    $unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND po.clientId = $this->unit";
		}
	    $this->db->select('(grn.accept_qty * po_parts.rate) as base_amount,cp.sub_type as sub_type');
	    $this->db->from('grn_details as grn');
	    $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'left');
	    $this->db->join('new_po po', 'po.id = grn.po_number '.$unit_condition);
	    $this->db->join('child_part cp', 'cp.id = po_parts.part_id', 'left');
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("grn.created_year = ".$month_arr['year']." AND grn.created_month = ".$month_arr['month']."");
	    }else{
		    $this->db->where("grn.created_year = ".$month_arr['start_year']." AND grn.created_month >= ".$month_arr['start_month']."");
		    $this->db->or_where("grn.created_year = ".$month_arr['end_year']." AND grn.created_month <= ".$month_arr['end_month']."");
		}
	    $this->db->group_by('cp.sub_type');
	   	// $this->db->where('po.clientId',$year);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_purchase_grn_details($year = '',$month_arr = [])
	{
	    $unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND po.clientId = $this->unit";
		}
	    $this->db->select('(grn.accept_qty * po_parts.rate) as base_amount,grn.created_date as created_date');
	    $this->db->from('grn_details as grn');
	    $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'left');
	    $this->db->join('new_po po', 'po.id = grn.po_number '.$unit_condition);
	    $this->db->where("grn.created_year = ".$month_arr['start_year']." AND grn.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("grn.created_year = ".$month_arr['end_year']." AND grn.created_month <= ".$month_arr['end_month']."");
	    
	   	// $this->db->where('po.clientId',$year);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	// store tab

	public function get_purchase_stock($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND cps.clientId = $this->unit";
		}
		$this->db->select('cps.*,(cp.store_stock_rate * cps.stock) as total_stock_amount');
	    $this->db->from('child_part_stock as cps');
	    $this->db->join('child_part as cp', ' cp.id = cps.childPartId', 'left');
	    $this->db->where("cps.stock > 0 ".$unit_condition);
	    $this->db->where("YEAR(cps.timestamp) = ".$month_arr['start_year']." AND MONTH(cps.timestamp) >= ".$month_arr['start_month']."");
	    $this->db->or_where("YEAR(cps.timestamp) = ".$month_arr['end_year']." AND MONTH(cps.timestamp) <= ".$month_arr['end_month']."");
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_in_house_parts($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND ips.clientId = $this->unit";
		}
		$this->db->select('ips.*,(ip.store_stock_rate * ips.stock) as total_stock_amount');
	    $this->db->from('inhouse_parts_stock as ips');
	    $this->db->join('inhouse_parts as ip', ' ip.id = ips.inhouse_parts_id', 'left');
	    $this->db->where("ips.stock > 0 ".$unit_condition);
	    $this->db->where("YEAR(ips.timestamp) = ".$month_arr['start_year']." AND MONTH(ips.timestamp) >= ".$month_arr['start_month']."");
	    $this->db->or_where("YEAR(ips.timestamp) = ".$month_arr['end_year']." AND MONTH(ips.timestamp) <= ".$month_arr['end_month']."");
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_fg_stock($year = '',$month_arr = [])
	{
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND cpms.clientId = $this->unit";
		}
		$this->db->select('cpms.*,(cpms.fg_stock * cpms.fg_rate) as total_stock_amount');
	    $this->db->from('customer_parts_master_stock as cpms');
	    $this->db->join('customer_parts_master as cm', ' cm.id = cpms.customer_parts_master_id', 'left');
	    $this->db->where("cpms.fg_stock > 0 ".$unit_condition);
	    $this->db->where("YEAR(cpms.timestamp) = ".$month_arr['start_year']." AND MONTH(cpms.timestamp) >= ".$month_arr['start_month']."");
	    $this->db->or_where("YEAR(cpms.timestamp) = ".$month_arr['end_year']." AND MONTH(cpms.timestamp) <= ".$month_arr['end_month']."");
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_store_purchase_grn_data($year = '',$month_arr = [])
	{
	    $unit_condition = '';
		if($this->unit > 0){
			$unit_condition = "AND po.clientId = $this->unit";
		}
	    $this->db->select('(grn.accept_qty * po_parts.rate) as base_amount,grn.created_date as created_date');
	    $this->db->from('grn_details as grn');
	    $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'left');
	    $this->db->join('new_po po', 'po.id = grn.po_number '.$unit_condition);
	    $this->db->where("grn.created_year = ".$month_arr['start_year']." AND grn.created_month >= ".$month_arr['start_month']."");
	    $this->db->or_where("grn.created_year = ".$month_arr['end_year']." AND grn.created_month <= ".$month_arr['end_month']."");
	    
	   	// $this->db->where('po.clientId',$year);
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_store_subcon_stock($year = '',$month_arr = [])
	{
	    $unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND c.clientId = $this->unit";
		}
	    $this->db->select('(cp.remaning_qty * cpp.store_stock_rate) as base_amount,cp.created_date as created_date');
	    $this->db->from('challan_parts as cp');
	    $this->db->join('child_part as cpp', 'cpp.id = cp.part_id ', 'left');
	    $this->db->join('challan as c', 'c.id = cp.challan_id'.$unit_condition, 'inner');
	    $this->db->where("cp.year = ".$month_arr['start_year']." AND cp.month >= ".$month_arr['start_month']."");
	    $this->db->or_where("cp.year = ".$month_arr['end_year']." AND cp.month <= ".$month_arr['end_month']."");
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	/* subcon */
	public function get_supplier_subcon_stocks($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND c.clientId = $this->unit";
		}
		$this->db->select('s.supplier_name as supplier_name,SUM((parts.remaning_qty * cp.store_stock_rate )) as remaning_qty_amount');
	    $this->db->from('challan_parts as parts');
	    $this->db->join('challan as c', ' c.id = parts.challan_id'.$unit_condition, 'inner');
	    $this->db->join('child_part as cp', ' cp.id = parts.part_id', 'left');
	    $this->db->join('supplier as s', ' s.id = c.supplier_id', 'left');
	    if($year != ""){
	    	if(array_key_exists("year", $month_arr)){
	    		$this->db->where("c.year = ".$month_arr['year']." AND c.month = ".$month_arr['month']."");
	    	}else{
	    		$this->db->where("c.year = ".$month_arr['start_year']." AND c.month >= ".$month_arr['start_month']."");
	    		$this->db->or_where("c.year = ".$month_arr['end_year']." AND c.month <= ".$month_arr['end_month']."");
	    	}
	    }
	    $this->db->group_by('c.supplier_id');
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_supplier_subcon_stocks_new($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND np.clientId = $this->unit";
		}
		$this->db->select('iw.invoice_amount as invoice_amount,spip.input_part_req_qty as required_qty,cp.store_stock_rate as store_stock_rate,SUM(gd.inwarding_price) as inwarding_price');
	    $this->db->from('inwarding as iw');
	    $this->db->join('subcon_po_inwarding as spi', 'spi.po_id = iw.po_id AND spi.invoice_number= iw.invoice_number', 'left');
	    $this->db->join('subcon_po_inwarding_parts as spip', ' spip.id = spi.id ', 'left');
	    $this->db->join('child_part as cp', ' cp.id = spip.input_part_id ', 'left');
	    $this->db->join('grn_details as gd', 'gd.inwarding_id = iw.id AND gd.invoice_number = iw.invoice_number');
	    $this->db->join('new_po as np', 'np.id = iw.po_id '.$unit_condition);

	    if($year != ""){
	    	if(array_key_exists("year", $month_arr)){
	    		$this->db->where("iw.created_year = ".$month_arr['year']." AND iw.created_month = ".$month_arr['month']."");
	    	}else{
	    		$this->db->where("iw.created_year = ".$month_arr['start_year']." AND iw.created_month >= ".$month_arr['start_month']."");
	    		$this->db->or_where("iw.created_year = ".$month_arr['end_year']." AND iw.created_month <= ".$month_arr['end_month']."");
	    	}
	    }
	    $this->db->group_by('gd.inwarding_id');
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_supplier_subcon_month_wise($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND c.clientId = $this->unit";
		}
		$this->db->select('(parts.remaning_qty * cp.store_stock_rate ) as remaning_qty_amount,c.created_date as created_date');
	    $this->db->from('challan_parts as parts');
	    $this->db->join('challan as c', ' c.id = parts.challan_id'.$unit_condition, 'inner');
	    $this->db->join('child_part as cp', ' cp.id = parts.part_id', 'left');
	    // $this->db->where("c.status ='pending'");
	    $this->db->where("c.year = ".$month_arr['start_year']." AND c.month >= ".$month_arr['start_month']."");
	    $this->db->or_where("c.year = ".$month_arr['end_year']." AND c.month <= ".$month_arr['end_month']."");
	    
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query(),1);
	    return $ret_data;
	}

	/* Production Tab */
	public function get_production_data($year = '',$month_arr = [],$date = ''){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('mp.* ,stock.fg_rate  as part_stock_rate,s.ppt as ppt,CONCAT(s.shift_type,"(",s.name,")") as shift_type');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	     $this->db->join('customer_parts_master as stock', ' stock.id = cp.customer_parts_master_id', 'left');
	    $this->db->join('shifts as s', ' s.id = mp.shift_id', 'left');
	    $this->db->where("mp.status ='completed' AND mp.shift_id >0".$unit_condition);
	    /* added for feedback */
	 //    if(array_key_exists("year", $month_arr)){
	 //    		$this->db->where("mp.year = ".$month_arr['year']." AND mp.month = ".$month_arr['month']."");
	 //    }else{
		//     $this->db->where("mp.year = ".$month_arr['start_year']." AND mp.month >= ".$month_arr['start_month']."");
		//     $this->db->or_where("mp.year = ".$month_arr['end_year']." AND mp.month <= ".$month_arr['end_month']."");
		// }
	    /* added for feedback */
	    if($date != ""){
	    	$this->db->where("STR_TO_DATE(mp.date, '%Y-%m-%d') = '$date'");
	    }
		
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query(),1);
	    return $ret_data;
	}
	public function get_molding_production_data($date = ''){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('SUM(mp.qty * stock.fg_rate ) as qty_amount');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', 'cp.customer_parts_master_id = stock.id ', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	    $this->db->where("STR_TO_DATE(mp.date, '%Y-%m-%d') = '$date'");
	    
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query());
	    return $ret_data;

	}
	public function get_yeaster_day_rejection_data($date = ''){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('SUM((mp.rejected_qty+mp.rejection_qty) * stock.fg_rate ) as qty_amount');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', 'cp.customer_parts_master_id = stock.id ', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	    $this->db->where("STR_TO_DATE(mp.date, '%Y-%m-%d') = '$date'");
	    
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;

	}
	public function get_yesterday_molding_data($date = ''){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('mp.* ,stock.fg_rate  as part_stock_rate,s.ppt as ppt');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', 'cp.customer_parts_master_id = stock.id ', 'left');
	    $this->db->join('shifts as s', ' s.id = mp.shift_id', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	    $this->db->where("STR_TO_DATE(mp.date, '%Y-%m-%d') = '$date'");

	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_yesterday_oee_data($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('mp.* ,stock.fg_rate  as part_stock_rate,s.ppt as ppt');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', 'cp.customer_parts_master_id = stock.id ', 'left');
	    $this->db->join('shifts as s', ' s.id = mp.shift_id', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("YEAR(STR_TO_DATE(mp.date, '%Y-%m-%d')) = ".$month_arr['year']." AND MONTH(STR_TO_DATE(mp.date, '%Y-%m-%d')) = ".$month_arr['month']."");
	    }else{
		    $this->db->where("YEAR(STR_TO_DATE(mp.date, '%Y-%m-%d')) = ".$month_arr['start_year']." AND MONTH(STR_TO_DATE(mp.date, '%Y-%m-%d')) >= ".$month_arr['start_month']."");
		    $this->db->or_where("YEAR(STR_TO_DATE(mp.date, '%Y-%m-%d')) = ".$month_arr['end_year']." AND MONTH(STR_TO_DATE(mp.date, '%Y-%m-%d')) <= ".$month_arr['end_month']."");
		}
	    
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}

	public function get_rejection_data_data($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('mp.* ,stock.fg_rate  as part_stock_rate,s.ppt as ppt');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', 'cp.customer_parts_master_id = stock.id ', 'left');
	    $this->db->join('shifts as s', ' s.id = mp.shift_id', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("mp.year = ".$month_arr['year']." AND mp.month = ".$month_arr['month']."");
	    }else{
		    $this->db->where("mp.year = ".$month_arr['start_year']." AND mp.month >= ".$month_arr['start_month']."");
		    $this->db->or_where("mp.year = ".$month_arr['end_year']." AND mp.month <= ".$month_arr['end_month']."");
		}
	    
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr("ok",1);
	    return $ret_data;
	}

	public function get_machine_wise_oee($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('mp.* ,stock.fg_rate as part_stock_rate,s.ppt as ppt,m.name as machine_name');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', 'cp.customer_parts_master_id = stock.id ', 'left');
	    $this->db->join('shifts as s', ' s.id = mp.shift_id', 'left');
	    $this->db->join('machine as m', ' m.id = mp.machine_id', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("mp.year = ".$month_arr['year']." AND mp.month = ".$month_arr['month']."");
	    }else{
		    $this->db->where("mp.year = ".$month_arr['start_year']." AND mp.month >= ".$month_arr['start_month']."");
		    $this->db->or_where("mp.year = ".$month_arr['end_year']." AND mp.month <= ".$month_arr['end_month']."");
		}
	    
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query(),1);
	    return $ret_data;

	}

	/* Quality Tab */
	public function get_rejection_invoice_data($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND rsi.clientId = $this->unit";
		}
		$this->db->select('pr.*,c.customer_name as customer_name');
	    $this->db->from('parts_rejection_sales_invoice as pr');
	    $this->db->join('customer as c', 'c.id = pr.customer_id', 'inner');
	    $this->db->join('rejection_sales_invoice as rsi', 'rsi.id = pr.rejection_sales_id'.$unit_condition, 'inner');
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("pr.created_year = ".$month_arr['year']." AND pr.created_month = ".$month_arr['month']."");
	    }else{
		    $this->db->where("pr.created_year = ".$month_arr['start_year']." AND pr.created_month >= ".$month_arr['start_month']."");
			$this->db->or_where("pr.created_year = ".$month_arr['end_year']." AND pr.created_month <= ".$month_arr['end_month']."");
		}
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    // pr($this->db->last_query(),1);
	    return $ret_data;

	}
	public function get_sales_quality_data($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND ns.clientId = $this->unit";
		}
		$this->db->select('ns.*,sp.*,c.id as customer_id_val,c.customer_name as customer_name');
	    $this->db->from('new_sales as ns');
	    $this->db->join('sales_parts as sp', 'ns.id = sp.sales_id', 'inner');
	    $this->db->join('customer as c', 'c.id = sp.customer_id', 'inner');
	    $this->db->where("ns.sales_number NOT LIKE 'TEMP%' AND ns.status NOT IN ('pending')".$unit_condition);
	    if(array_key_exists("year", $month_arr)){
	    		$this->db->where("ns.created_year = ".$month_arr['year']." AND ns.created_month = ".$month_arr['month']."");
	    }else{
		    $this->db->where("ns.created_year = ".$month_arr['start_year']." AND ns.created_month >= ".$month_arr['start_month']."");
			$this->db->or_where("ns.created_year = ".$month_arr['end_year']." AND ns.created_month <= ".$month_arr['end_month']."");
		}
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;

	}

	public function get_cutomer_rejection_quality($year = '',$month_arr = []){
		$unit_condition = '';
		// if($this->unit > 0){
		// 	$unit_condition = " AND ri.clientId = $this->unit";
		// }
		$this->db->select('ri.*,c.*');
	    $this->db->from('rejection_sales_invoice as ri');
	    $this->db->join('customer as c', 'c.id = ri.customer_id', 'inner');
	    if($this->unit > 0){
			$this->db->where("ri.clientId",$this->unit);
		}
		$this->db->where("YEAR(STR_TO_DATE(ri.created_date, '%d-%m-%Y')) = ".$month_arr['start_year']." AND MONTH(STR_TO_DATE(ri.created_date, '%d-%m-%Y')) >= ".$month_arr['start_month']."");
		$this->db->or_where("YEAR(STR_TO_DATE(ri.created_date, '%d-%m-%Y')) = ".$month_arr['end_year']." AND MONTH(STR_TO_DATE(ri.created_date, '%d-%m-%Y')) <= ".$month_arr['end_month']."");
		
	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_in_house_ppm($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND mp.clientId = $this->unit";
		}
		$this->db->select('mp.* ,stock.fg_rate  as part_stock_rate,s.ppt as ppt');
	    $this->db->from('molding_production as mp');
	    $this->db->join('customer_part as cp', ' cp.id = mp.customer_part_id', 'left');
	    $this->db->join('customer_parts_master as stock', ' stock.id = cp.customer_parts_master_id', 'left');
	    $this->db->join('shifts as s', ' s.id = mp.shift_id', 'left');
	    $this->db->where("mp.status ='completed'".$unit_condition);
	   	$this->db->where("mp.year = ".$month_arr['start_year']." AND mp.month >= ".$month_arr['start_month']."");
		$this->db->or_where("mp.year = ".$month_arr['end_year']." AND mp.month <= ".$month_arr['end_month']."");

	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_inward_inspection_ppm($year = '',$month_arr = []){
		$unit_condition = '';
		if($this->unit > 0){
			$unit_condition = " AND np.clientId = $this->unit";
		}
		$this->db->select('gd.*,np.clientId as clientId');
	    $this->db->from('grn_details as gd');
	    $this->db->join('inwarding as iw', ' iw.id = gd.inwarding_id AND iw.status != "pending"', 'inner');
	    $this->db->join('new_po as np', ' np.id = gd.po_number'.$unit_condition, 'inner');
	   	$this->db->where("gd.created_year = ".$month_arr['start_year']." AND gd.created_month >= ".$month_arr['start_month']."");
		$this->db->or_where("gd.created_year = ".$month_arr['end_year']." AND gd.created_month <= ".$month_arr['end_month']."");

	    $result_obj = $this->db->get();
	    $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
	    return $ret_data;
	}
	public function get_payable_report($year = '',$month_arr = []){
	   // pr($year,1);
       $start_date = date("$year/04/01");
       $end_date = date(($year+1)."/03/31");
       $data['end_date'] = $date_filter[1];
       $this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$start_date."' AND '".$end_date."'");
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
            if ($search_params["supplier_id"] != "") {
                $this->db->where("s.id", $search_params["supplier_id"]);
            }
            if (isset($search_params["value"]) && $search_params["value"] != "") {
                $keyword = $search_params["value"];
                $this->db->group_start();
                $fields = [
                    's.supplier_name'
                    // Add other fields to search as needed
                ];
                
                foreach ($fields as $field) {
                    $this->db->or_like($field, $keyword);
                }
                $this->db->group_end(); // End the group of OR conditions
            }
        }


        $current_year = (int) date("Y");
        if(!((int) date("m") > 3)){
            $current_year--;
        }
        $this->db->having('bal_amnt >', 0);

        $date_filter =  explode((" - "),$search_params["date_range"]);
        $start_date = date("$current_year/04/01");
        $end_date = date(($current_year+1)."/03/31");
        $data['end_date'] = $date_filter[1];
        $this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$start_date."' AND '".$end_date."'");
        
        $this->db->group_by("inward.grn_number");

        $result_obj = $this->db->get();
                
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;

    }
}

?>
