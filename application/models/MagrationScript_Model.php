<?php
class MagrationScript_Model extends CI_Model {
    
    public function __construct() {
    }
    public function getCurrentStockData(){
        $this->db->select("u.uom_name as uom_name,c.part_number as part_number,c.part_description as part_description,c.store_stock_rate as store_stock_rate,cps.stock as stock,cps.clientId as clientId,cps.production_qty as production_qty,cps.machine_mold_issue_stock as machine_mold_issue_stock");
        $this->db->from("child_part as c");
        $this->db->join('child_part_stock as cps','cps.childPartId = c.id','left');
        $this->db->join('uom as u','u.id = c.uom_id','left');
        // $this->db->where("ea.attendance_id", $attendance_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function checkStockEntry($data){
        $this->db->select("d.*");
        $this->db->from("daily_stock as d");
        $this->db->where("d.stock_date", $data);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;

    }
    public function insertDailyStock($insert_arr = []){
        $this->db->insert('daily_stock', $insert_arr);
        return $this->db->insert_id();
    }
    public function get_sales($date = '')
    {
        $unit_condition = '';
        // if($this->unit > 0){
        //     $unit_condition = "AND ns.clientId = $this->unit";
        // }
        $this->db->select('SUM(sp.basic_total) as basic_total,c.customer_name as customer_name,sp.customer_id');
        $this->db->from('sales_parts as sp');
        $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
        $this->db->join('customer as c', 'c.id = sp.customer_id', 'left');
        $this->db->where("ns.created_date",$date);
        $this->db->group_by('ns.customer_id');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query());
        return $ret_data;
    }
    public function get_current_month_sales_block($month = '')
    {
        $unit_condition = '';
        // if($this->unit > 0){
        //     $unit_condition = "AND ns.clientId = $this->unit";
        // }
        $this->db->select('SUM(sp.basic_total) as basic_total,c.customer_name as customer_name,sp.customer_id');
        $this->db->from('sales_parts as sp');
        $this->db->join('new_sales as ns', 'ns.id = sp.sales_id AND ns.status = "lock" AND ns.sales_number != "%TEMP%" '.$unit_condition);
        $this->db->join('customer as c', 'c.id = sp.customer_id', 'left');
        $this->db->where("ns.created_month",$month);
        $this->db->where("ns.created_year",date("Y"));
        $this->db->group_by('sp.customer_id');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query());
        return $ret_data;
    }
    public function getSupplierPaymetTermsData(){
        $this->db->select("s.*");
        $this->db->from("supplier as s");
       
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;

    }
    public function UpdateSupplierPaymetDaysData($update_arr = array()){
        $this->db->update_batch('supplier',$update_arr, 'id');
        return $this->db->affected_rows(); 
    }
    



}
?>