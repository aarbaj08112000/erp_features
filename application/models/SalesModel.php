<?php
class SalesModel extends CI_Model {
    // public function __construct() {
        
    // }

    public function getSalesReportData($condition_arr = [],$search_params = ''){
        
    }

    public function getSalesReportViewCount(
        $condition_arr = [],
        $search_params = ""
    ) {
        $clientId = $this->Unit->getSessionClientId();
        $this->db->select(
            'COUNT(sales.sales_number) as total_record'
        );
        // s
        $this->db->from('new_sales AS sales');
        $this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
        $this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
        $this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');
        $this->db->where('sales.clientId', $clientId);
        $this->db->where('sales.sales_number NOT LIKE', 'TEMP%');
        $this->db->where_not_in('sales.status', ['pending','unlocked']);
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["date_range"] != "") {
                $date_filter =  explode((" - "),$search_params["date_range"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
            }
           
        }
        
            
        if (isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                'cp.part_number',
                'cp.part_description',
                'c.customer_name',
                'sales.status',
                'sales.sales_number',
                'sales.created_date',
                'parts.invoice_number',
                'parts.po_number',
                'parts.hsn_code',
                // Add more columns as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }

        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];

        // pr($this->db->last_query(),1);
        return $ret_data;
    }

    public function getSalesReportViewData($condition_arr = [], $search_params = "") {
        $clientId = $this->Unit->getSessionClientId();
        $this->db->select('cp.part_number, cp.part_description, c.customer_name, sales.status, sales.sales_number as salesNumber, sales.created_date AS sales_date, parts.*,sales.discount as sales_discount');
        $this->db->from('new_sales AS sales');
        $this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
        $this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
        $this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');
        $this->db->where('sales.clientId', $clientId);
        $this->db->where('sales.sales_number NOT LIKE', 'TEMP%');
        $this->db->where_not_in('sales.status', ['pending','unlocked']);
        
        // Apply conditions based on $condition_arr
        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
    
        // Apply additional search conditions
        if (is_array($search_params) && count($search_params) > 0) {
            // if ($search_params["month_number"] != "") {
            //     $this->db->where("sales.created_month", $search_params["month_number"]);
            // }
            // if ($search_params["year"] != "") {
            //     $this->db->where("sales.created_year", $search_params["year"]);
            // }
            if ($search_params["date_range"] != "") {
                $date_filter =  explode((" - "),$search_params["date_range"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
            }
            
            // Apply LIKE conditions if a keyword is provided
            if (isset($search_params["value"]) && $search_params["value"] != "") {
                $keyword = $search_params["value"];
                // Group OR conditions within a WHERE block
                $this->db->group_start();
                $fields = [
                    'cp.part_number',
                    'cp.part_description',
                    'c.customer_name',
                    'sales.status',
                    'sales.sales_number',
                    'sales.created_date',
                    'parts.invoice_number',
                    'parts.po_number',
                    'parts.hsn_code',
                    // Add more columns as needed
                ];
                
                foreach ($fields as $field) {
                    $this->db->or_like($field, $keyword);
                }
                $this->db->group_end(); // End the group of OR conditions
            }
        }
    
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        
        // Debugging: print the last executed query
        // pr($this->db->last_query(),1);
        
        return $ret_data;
    }
    public function getHsnReportViewCount($condition_arr = [], $search_params = "") {
        $clientId = $this->Unit->getSessionClientId();
        $this->db->select('cp.part_number, cp.part_description, c.customer_name, sales.status, sales.sales_number as salesNumber, sales.created_date AS sales_date, parts.*,SUM(parts.basic_total) as basic_total,SUM(parts.total_rate) as total_rate,SUM(parts.igst_amount) as igst_amount,SUM(parts.sgst_amount) as sgst_amount,SUM(parts.cgst_amount) as cgst_amount,SUM(parts.gst_amount) as gst_amount,SUM(parts.part_price) as part_price,SUM(parts.qty) as qty,SUM(parts.tcs_amount) as tcs_amount,SUM(sales.discount) as sales_discount');
        $this->db->from('new_sales AS sales');
        $this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
        $this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
        $this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');
        $this->db->where('sales.clientId', $clientId);
        $this->db->where('sales.sales_number NOT LIKE', 'TEMP%');
        $this->db->where_not_in('sales.status', ['pending','unlocked','Cancelled']);
        
        
        // Apply additional search conditions
        if (is_array($search_params) && count($search_params) > 0) {
            // if ($search_params["customer"] != "") {
            //     $this->db->where("parts.customer_id", $search_params["customer"]);
            // }
            if ($search_params["hsn_code"] != "") {
                $this->db->where("parts.hsn_code", $search_params["hsn_code"]);
            }
            if ($search_params["date_range"] != "") {
                $date_filter =  explode((" - "),$search_params["date_range"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
            }
            // Apply LIKE conditions if a keyword is provided
            if (isset($search_params["value"]) && $search_params["value"] != "") {
                $keyword = $search_params["value"];
                // Group OR conditions within a WHERE block
                $this->db->group_start();
                $fields = [
                    'c.customer_name',
                    'parts.hsn_code',
                    // Add more columns as needed
                ];
                
                foreach ($fields as $field) {
                    $this->db->or_like($field, $keyword);
                }
                $this->db->group_end(); // End the group of OR conditions
            }
        }
        $this->db->group_by('parts.hsn_code');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        
        // Debugging: print the last executed query
        // pr($this->db->last_query(),1);
        
        return $ret_data;
    }

    public function getHsnReportViewData($condition_arr = [], $search_params = "") {
        $clientId = $this->Unit->getSessionClientId();
        $this->db->select('cp.part_number, cp.part_description, c.customer_name, sales.status, sales.sales_number as salesNumber, sales.created_date AS sales_date, parts.*,SUM(parts.basic_total) as basic_total,SUM(parts.total_rate) as total_rate,SUM(parts.igst_amount) as igst_amount,SUM(parts.sgst_amount) as sgst_amount,SUM(parts.cgst_amount) as cgst_amount,SUM(parts.gst_amount) as gst_amount,SUM(parts.part_price) as part_price,SUM(parts.qty) as qty,SUM(parts.tcs_amount) as tcs_amount,SUM(sales.discount) as sales_discount');
        $this->db->from('new_sales AS sales');
        $this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
        $this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
        $this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');
        $this->db->where('sales.clientId', $clientId);
        $this->db->where('sales.sales_number NOT LIKE', 'TEMP%');
        $this->db->where_not_in('sales.status', ['pending','unlocked','Cancelled']);
        
        // Apply conditions based on $condition_arr
        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
    
        // Apply additional search conditions
        if (is_array($search_params) && count($search_params) > 0) {
            // if ($search_params["customer"] != "") {
            //     $this->db->where("parts.customer_id", $search_params["customer"]);
            // }
            if ($search_params["hsn_code"] != "") {
                $this->db->where("parts.hsn_code", $search_params["hsn_code"]);
            }
            if ($search_params["date_range"] != "") {
                $date_filter =  explode((" - "),$search_params["date_range"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
            }
            
            // Apply LIKE conditions if a keyword is provided
            if (isset($search_params["value"]) && $search_params["value"] != "") {
                $keyword = $search_params["value"];
                // Group OR conditions within a WHERE block
                $this->db->group_start();
                $fields = [
                    'c.customer_name',
                    'parts.hsn_code',
                    // Add more columns as needed
                ];
                
                foreach ($fields as $field) {
                    $this->db->or_like($field, $keyword);
                }
                $this->db->group_end(); // End the group of OR conditions
            }
        }
        $this->db->group_by('parts.hsn_code');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        
        // Debugging: print the last executed query
        // pr($this->db->last_query(),1);
        
        return $ret_data;
    }
    

    public function getReceivableReportView($condition_arr = [],$search_params = ""){
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
            n.created_date as created_date_val,
           rrp.tds_amount as tds_amount,
            rrp.remark as remark_val,
            ROUND(SUM(
                IF(s.total_rate > 0,s.total_rate,0) + IF(s.tcs_amount > 0,s.tcs_amount,0)) - IF(rrp.amount_received > 0,rrp.amount_received,0) - IF(rrp.tds_amount > 0,rrp.tds_amount,0), 
                2) AS bal_amnt,
            s.sales_id as sales_id_val');
        
        $this->db->from('sales_parts s');
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" AND n.clientId = ' . $this->Unit->getSessionClientId(), 'inner');
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        if(is_valid_array($search_params) && $search_params['customer_part_id'] > 0){
            $this->db->where('s.customer_id', $search_params['customer_part_id']);
        }
        $this->db->group_by('s.sales_number');
        // pr($condition_arr,1);
        if($condition_arr["order_by"] == ''){    
            $this->db->order_by('s.id', 'DESC');
        }
        
        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_valid_array($search_params) && $search_params["status"] != "") {
                if($search_params["status"] == "Pending"){
                    $this->db->having('bal_amnt >=', 0);
                }else{
                    $this->db->having('bal_amnt <', 0);
                }
        }
        if ($search_params["date_range"] != "") {
                $date_filter =  explode((" - "),$search_params["date_range"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
               $this->db->where("STR_TO_DATE(n.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }

        if (is_valid_array($search_params) && isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                's.sales_number',
                'cus.customer_name',
                'rrp.transaction_details',
                'n.created_date',
                'rrp.payment_receipt_date',
                's.created_date'
                // Add other fields to search as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }

       

        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        // pr($ret_data,1);
        return $ret_data;
    }

    public function getReceivableReportCount( $condition_arr = [],$search_params = ""){
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
                IF(s.total_rate > 0,s.total_rate,0) + 
                IF(s.tcs_amount > 0,s.tcs_amount,0)) - IF(rrp.amount_received > 0,rrp.amount_received,0) - 
                IF(rrp.tds_amount > 0,rrp.tds_amount,0), 
                2) AS bal_amnt,
            s.sales_id as sales_id_val');
        
        $this->db->from('sales_parts s');
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" AND n.clientId = ' . $this->Unit->getSessionClientId(), 'inner');
        $this->db->join('new_sales ns', 'ns.id = s.sales_id', 'left');
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        if(is_valid_array($search_params) && $search_params['customer_part_id'] > 0){
            $this->db->where('s.customer_id', $search_params['customer_part_id']);
        }
        $this->db->group_by('s.sales_number');
        if (is_valid_array($search_params) && $search_params["status"] != "") {
                if($search_params["status"] == "Pending"){
                    $this->db->having('bal_amnt >', 0);
                }else{
                    $this->db->having('bal_amnt <=', 0);
                }
        }
        if ($search_params["date_range"] != "") {
                $date_filter =  explode((" - "),$search_params["date_range"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
               $this->db->where("STR_TO_DATE(n.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }

        if (is_valid_array($search_params) && isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                's.sales_number',
                'cus.customer_name',
                'rrp.transaction_details',
                'n.created_date',
                'rrp.payment_receipt_date',
                's.created_date'
                // Add other fields to search as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }

       

        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        // pr($ret_data,1);
        return $ret_data;
    }


    public function getOutstandingReportView($condition_arr = [],$search_params = ""){
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
            n.created_date as created_date_val,
           rrp.tds_amount as tds_amount,
            rrp.remark as remark_val,
            ROUND(SUM(
                IF(s.total_rate > 0,s.total_rate,0) + IF(s.tcs_amount > 0,s.tcs_amount,0)) - IF(rrp.amount_received > 0,rrp.amount_received,0) - IF(rrp.tds_amount > 0,rrp.tds_amount,0), 
                2) AS bal_amnt,
            s.sales_id as sales_id_val');
        
        $this->db->from('sales_parts s');
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" AND n.clientId = ' . $this->Unit->getSessionClientId(), 'inner');  
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        if(is_valid_array($search_params) && $search_params['customer_id'] > 0){
            $this->db->where('s.customer_id', $search_params['customer_id']);
        }
        $this->db->group_by('s.sales_number');
        // pr($condition_arr,1);
        if($condition_arr["order_by"] == ''){    
            $this->db->order_by('s.id', 'DESC');
        }
        
        if (count($condition_arr) > 0) {
            // $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }


        $current_year = (int) date("Y");
        if(!((int) date("m") > 3)){
            $current_year--;
        }

        $date_filter =  explode((" - "),$search_params["date_range"]);
        $start_date = date("$current_year/04/01");
        $end_date = date(($current_year+1)."/03/31");
        $data['end_date'] = $date_filter[1];
        $this->db->where("STR_TO_DATE(n.created_date, '%d/%m/%Y') BETWEEN '".$start_date."' AND '".$end_date."'");


       if (is_valid_array($search_params) && isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                'cus.customer_name',
                // Add other fields to search as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }
        if (is_valid_array($search_params) && isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                'cus.customer_name'
                // Add other fields to search as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }

       
        $this->db->having('bal_amnt >', 0);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        // pr($ret_data,1);
        return $ret_data;



    }

    public function getOutstandingReportViewCount($condition_arr = [],$search_params = ""){
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
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" AND n.clientId = ' . $this->Unit->getSessionClientId(), 'inner');
        $this->db->join('new_sales ns', 'ns.id = s.sales_id', 'left');
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        if(is_valid_array($search_params) && $search_params['customer_id'] > 0){
            $this->db->where('s.customer_id', $search_params['customer_id']);
        }
        $this->db->group_by('s.sales_number');
        // pr($condition_arr,1);
        if($condition_arr["order_by"] == ''){    
            $this->db->order_by('s.id', 'DESC');
        }


        $current_year = (int) date("Y");
        if(!((int) date("m") > 3)){
            $current_year--;
        }

        $date_filter =  explode((" - "),$search_params["date_range"]);
        $start_date = date("$current_year/04/01");
        $end_date = date(($current_year+1)."/03/31");
        $data['end_date'] = $date_filter[1];
        $this->db->where("STR_TO_DATE(n.created_date, '%d/%m/%Y') BETWEEN '".$start_date."' AND '".$end_date."'");
        
       if (is_valid_array($search_params) && isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                'cus.customer_name',
                // Add other fields to search as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }
        if (is_valid_array($search_params) && isset($search_params["value"]) && $search_params["value"] != "") {
            $keyword = $search_params["value"];
            
            // Group OR conditions within a WHERE block
            $this->db->group_start();
            $fields = [
                'cus.customer_name'
                // Add other fields to search as needed
            ];
            
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
            $this->db->group_end(); // End the group of OR conditions
        }

       
         $this->db->having('bal_amnt >', 0);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        // pr($ret_data,1);
        return $ret_data;
    }

    
    public function getOutstandingPayableReportView($condition_arr = [],$search_params = ""){
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
            's.supplier_name as customer_name',
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
            // $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        if (is_array($search_params) && count($search_params) > 0) {
            if ($search_params["supplier_id"] != "") {
                $this->db->where("s.id", $search_params["supplier_id"]);
            }

            if (isset($search_params["value"]) && $search_params["value"] != "") {
                $keyword = $search_params["value"];
                $this->db->group_start();
                $fields = [
                    's.supplier_name'
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
    public function getOutstandingPayableReportViewCount($condition_arr = [],$search_params = ""){
        
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

    public function getOutstandingReportData($date = ''){
        $this->db->select('s.*,s.sales_number as invoice_number, 
            SUM(s.gst_amount) as gst, 
            SUM(s.total_rate) as ttlrt, 
            SUM(s.gst_amount) as gstamnt, 
            SUM(s.tcs_amount) as tcsamnt, 
            cus.customer_name as party_name, 
            cus.payment_terms, 
            rrp.payment_receipt_date,
            rrp.amount_received as amount_received, 
            rrp.transaction_details, 
            ns.created_date as created_date_val,
           rrp.tds_amount as tds_amount,
            rrp.remark as remark_val,
            cus.billing_address as billing_address,
            ROUND(SUM(
                IF(s.total_rate > 0,s.total_rate,0) + IF(s.tcs_amount > 0,s.tcs_amount,0)) - IF(rrp.amount_received > 0,rrp.amount_received,0) - IF(rrp.tds_amount > 0,rrp.tds_amount,0), 
                2) AS bal_amnt,
            s.sales_id as sales_id_val');
        
        $this->db->from('sales_parts s');
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" AND n.clientId = ' . $this->Unit->getSessionClientId(), 'inner');
        $this->db->join('new_sales ns', 'ns.id = s.sales_id', 'left');
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        if ($date != "") {
                $date_filter =  explode((" - "),$date);
               $this->db->where("STR_TO_DATE(n.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
    
        $this->db->group_by('s.sales_number');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        // pr($ret_data,1);
        return $ret_data;
    }
    public function getOutstandingPayableReportData($date = ""){
        $this->db->select([
            's.supplier_name as party_name',
            'pr.*',
            's.id',
            's.mobile_no as mobile_no',
            'inward.created_date as created_date_val',
            'SUM(ROUND(
                IF(((grn.accept_qty * po_parts.rate * tax.cgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.cgst) / 100,0) + 
                IF(((grn.accept_qty * po_parts.rate * tax.sgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.sgst) / 100,0) + 
                IF(((grn.accept_qty * po_parts.rate * tax.tcs) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.tcs) / 100,0) + 
                IF(((grn.accept_qty * po_parts.rate * tax.igst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.igst) / 100,0) + 
                IF((grn.accept_qty * po_parts.rate) > 0,(grn.accept_qty * po_parts.rate),0), 
                2)) AS pending_total',
                'SUM(ROUND(
                IF(pr.amount_received > 0,pr.amount_received,0) + 
                IF(pr.tds_amount > 0,pr.tds_amount,0), 
                2)) AS receiving_total',
                'SUM(ROUND(grn.accept_qty, 2)) AS total_accept_qty',
            'SUM(ROUND(
                IF(((grn.accept_qty * po_parts.rate * tax.cgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.cgst) / 100,0) + 
                IF(((grn.accept_qty * po_parts.rate * tax.sgst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.sgst) / 100,0) + 
                IF(((grn.accept_qty * po_parts.rate * tax.tcs) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.tcs) / 100,0) + 
                IF(((grn.accept_qty * po_parts.rate * tax.igst) / 100) > 0,(grn.accept_qty * po_parts.rate * tax.igst) / 100,0) + 
                ROUND(IF((grn.accept_qty * po_parts.rate) > 0,(grn.accept_qty * po_parts.rate),0), 2) - 
                IF(pr.amount_received > 0,pr.amount_received,0) - 
                IF(pr.tds_amount > 0,pr.tds_amount,0), 
                2)) AS bal_amnta',
            'SUM(ROUND(grn.accept_qty * po_parts.rate, 2)) AS base_amount',
            'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.cgst) / 100, 2)) AS cgst_amount',
            'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.sgst) / 100, 2)) AS sgst_amount',
            'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.tcs) / 100, 2)) AS tcs_amount',
            'SUM(ROUND((grn.accept_qty * po_parts.rate * tax.igst) / 100, 2)) AS igst_amount',
            'inward.grn_number as invoice_number',
            'grn.remark as remarks','s.location as billing_address,','s.payment_days as payment_days',
        ]);

        $this->db->from('grn_details grn');
        $this->db->join('inwarding inward', 'inward.id = grn.inwarding_id',
        'inner');
        $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'inner');
        $this->db->join('new_po po', 'po.id = grn.po_number', 'inner');
        $this->db->join('child_part part', 'part.id = po_parts.part_id', 'inner');
        $this->db->join('uom u', 'u.id = po_parts.uom_id', 'inner');
        $this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id', 'inner');
        $this->db->join('supplier s', 's.id = po.supplier_id', 'inner');
        $this->db->join('payable_report pr', 'inward.grn_number = pr.grn_number', 'left');

        $this->db->where('po.clientId', $this->Unit->getSessionClientId());
        $this->db->where('inward.grn_number !=', '');
        // $this->db->where("s.id", "13");
        $this->db->group_by("inward.grn_number");
        $this->db->having('bal_amnta >', 0);
        if ($date != "") {
                $date_filter =  explode((" - "),$date);
               $this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
        $this->db->order_by("grn.id","DESC");
        $result_obj = $this->db->get();
                
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }


    /* global export */
    public function getSalesReportExportData($search_params = []) {
        // $clientId = $this->Unit->getSessionClientId();
        $this->db->select('cp.part_number, cp.part_description, c.customer_name, sales.status, sales.sales_number as salesNumber, sales.created_date AS sales_date, parts.*,sales.discount as sales_discount,cl.client_unit as client_name');
        $this->db->from('new_sales AS sales');
        $this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
        $this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
        $this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');
         $this->db->join('client AS cl', 'cl.id = sales.clientId', 'inner');
        if($search_params['client'] > 0){
            $this->db->where('sales.clientId', $search_params['client']);
        }
        $this->db->where('sales.sales_number NOT LIKE', 'TEMP%');
        $this->db->where_not_in('sales.status', ['pending','unlocked']);
        
        // $this->db->limit(20,0);
        $this->db->order_by("salesNumber","DESC");
        if ($search_params["date"] != "") {
                $date_filter =  explode((" - "),$search_params["date"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
    
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        
        // Debugging: print the last executed query
        // pr($this->db->last_query(),1);
        
        return $ret_data;
    }
     public function getGNRepotExportData($search_params = []){
        $clientId = $this->Unit->getSessionClientId();
        $this->db->select('
            grn.inwarding_id, 
            inward.grn_number, 
            grn.po_part_id, 
            grn.po_number, 
            grn.created_date as grn_created_date,
            grn.invoice_number, 
            inward.invoice_date, 
            po.supplier_id, 
            grn.qty as po_qty, 
            po.po_number as poNumber, 
            s.supplier_name, 
            po.po_date, 
            part.part_number, 
            part.part_description, 
            part.hsn_code, 
            u.uom_name,
            po_parts.tax_id, 
            po_parts.part_id, 
            po_parts.rate, 
            po_parts.discount,
            grn.accept_qty as total_accept_qty,
            tax.igst, 
            tax.sgst, 
            tax.cgst, 
            tax.tcs, 
            tax.tcs_on_tax,
            ROUND((grn.accept_qty * po_parts.rate), 2) as base_amount, 
            ROUND(((grn.accept_qty * po_parts.rate) * tax.cgst) / 100, 2) as cgst_amount, 
            ROUND(((grn.accept_qty * po_parts.rate) * tax.sgst) / 100, 2) as sgst_amount,
            ROUND(((grn.accept_qty * po_parts.rate) * tax.tcs) / 100, 2) as tcs_amount,
            ROUND(((grn.accept_qty * po_parts.rate) * tax.igst) / 100, 2) as igst_amount,
            po.loading_unloading, 
            po.loading_unloading_gst, 
            po.freight_amount, 
            po.freight_amount_gst,
            cl.client_unit as client_name
        ');
        $this->db->from('grn_details grn');
        $this->db->join('inwarding inward', 'inward.id = grn.inwarding_id', 'inner');
        $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id', 'inner');
        $this->db->join('new_po po', 'po.id = grn.po_number', 'inner');
        $this->db->join('child_part part', 'part.id = po_parts.part_id', 'inner');
        $this->db->join('uom u', 'u.id = po_parts.uom_id', 'inner');
        $this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id', 'inner');
        $this->db->join('supplier s', 's.id = po.supplier_id', 'inner');
        $this->db->join('client AS cl', 'cl.id = po.clientId', 'inner');
        // $this->db->order_by('grn.id', 'DESC');
        if($search_params['client'] > 0){
            $this->db->where('po.clientId', $search_params['client']);
        }
        if ($search_params["date"] != "") {
                $date_filter =  explode((" - "),$search_params["date"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
               $this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }

        // $this->db->limit(20,0);
        $this->db->order_by("grn_number","DESC");
        $query = $this->db->get();
        $result = is_object($query) ? $query->result_array() : [];
        // pr($this->db->last_query(),1);
        return $result;
    }
    public function getSalesSummaryRepotExportData($search_params = []){
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
            sales.vehicle_number,
            cl.client_unit as client_name
            ");

        $this->db->from('new_sales AS sales');
        $this->db->join('sales_parts AS parts', 'sales.id = parts.sales_id', 'inner');
        $this->db->join('customer AS c', 'parts.customer_id = c.id', 'inner');
        $this->db->join('customer_part AS cp', 'parts.part_id = cp.id', 'inner');
        $this->db->join('client AS cl', 'cl.id = sales.clientId', 'inner');
        // Apply conditions
        if($search_params['client'] > 0){
            $this->db->where('sales.clientId', $search_params['client']);
        }
        $this->db->where("sales.sales_number NOT LIKE 'TEMP%'", NULL, FALSE);
        $this->db->where_not_in('sales.status', ['pending','unlocked']);
        if ($search_params["date"] != "") {
                $date_filter =  explode((" - "),$search_params["date"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(sales.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
        $this->db->group_by('sales.sales_number');
        $this->db->order_by("sales.id","DESC");

        $result_obj = $this->db->get();
                
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getGrnSummaryReportExportData($search_params = ""){
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
            SUM(po.freight_amount_gst) as freight_amount_gst,
            cl.client_unit as client_name
        ');

        $this->db->from('grn_details grn');
        $this->db->join('inwarding inward', 'inward.id = grn.inwarding_id');
        $this->db->join('po_parts po_parts', 'po_parts.id = grn.po_part_id');
        $this->db->join('new_po po', 'po.id = grn.po_number');
        $this->db->join('child_part part', 'part.id = po_parts.part_id');
        $this->db->join('uom u', 'u.id = po_parts.uom_id');
        $this->db->join('gst_structure tax', 'tax.id = po_parts.tax_id');
        $this->db->join('supplier s', 's.id = po.supplier_id');
        $this->db->join('client AS cl', 'cl.id = po.clientId', 'inner');
        if($search_params['client'] > 0){
            $this->db->where('po.clientId', $search_params['client']);
        }
        if ($search_params["date"] != "") {
                $date_filter =  explode((" - "),$search_params["date"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
        $this->db->group_by('inward.grn_number');
        $this->db->order_by("grn_number","DESC");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getPayableReportExportData($search_params = ""){
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
            'grn.remark as remarks',
            'cl.client_unit as client_name'
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
        $this->db->join('client AS cl', 'cl.id = po.clientId', 'inner');
        
        $this->db->where('inward.grn_number !=', '');
        if($search_params['client'] > 0){
            $this->db->where('po.clientId', $search_params['client']);
        }
        if ($search_params["date"] != "") {
                $date_filter =  explode((" - "),$search_params["date"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
                $this->db->where("STR_TO_DATE(grn.created_date, '%d-%m-%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
        
        $this->db->group_by("inward.grn_number");
        $this->db->order_by("s.supplier_name","asc");
        $result_obj = $this->db->get();
                // pr($this->db->last_query(),1);
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }

    public function getReceivableReportExportData($search_params = ""){
        $where = "";
        if($search_params['client'] > 0){
            $where = 'AND n.clientId = ' . $search_params['client'];
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
            n.created_date as created_date_val,
           rrp.tds_amount as tds_amount,
            rrp.remark as remark_val,
            ROUND(SUM(
                IF(s.total_rate > 0,s.total_rate,0) + IF(s.tcs_amount > 0,s.tcs_amount,0)) - IF(rrp.amount_received > 0,rrp.amount_received,0) - IF(rrp.tds_amount > 0,rrp.tds_amount,0), 
                2) AS bal_amnt,
            s.sales_id as sales_id_val,cl.client_unit as client_name');
        
        $this->db->from('sales_parts s');
        
        $this->db->join('new_sales n', 's.sales_id = n.id AND n.status != "unlocked" '.$where, 'inner');
        $this->db->join('receivable_report rrp', 'rrp.sales_number = s.sales_number', 'left');
        $this->db->join('customer cus', 's.customer_id = cus.id', 'left');
        $this->db->join('client AS cl', 'cl.id = n.clientId', 'inner');
        $this->db->group_by('s.sales_number');
        if ($search_params["date"] != "") {
                $date_filter =  explode((" - "),$search_params["date"]);
                $data['start_date'] = $date_filter[0];
                $data['end_date'] = $date_filter[1];
               $this->db->where("STR_TO_DATE(n.created_date, '%d/%m/%Y') BETWEEN '".$date_filter[0]."' AND '".$date_filter[1]."'");
        }
       
        $this->db->order_by('s.id', 'DESC');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        // pr($ret_data,1);
        return $ret_data;
    }
} 