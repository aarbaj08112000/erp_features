<?php
class ExportSalesInvoiceModel extends CI_Model
 {
	 
    public function insertExportPackingSlip($packing_data){
        $this->db->insert('export_packing_slip',$packing_data);
        return $this->db->insert_id(); 
    }
    public function insertExportPackingSlipPart($packing_parts_data){
        $this->db->insert_batch('export_packing_slip_parts',$packing_parts_data);
    }
    public function updateExportPackingSlip($update_data= array(),$export_packing_slip_id){
        $this->db->where('export_packing_slip_id', $export_packing_slip_id);
        $this->db->update('export_packing_slip', $update_data);
        $this->db->affected_rows();
        $affected_rows = $this->db->affected_rows() == 0 ? 1 : $this->db->affected_rows();
        return $affected_rows;
    }
    public function deleteExportPackingSlipPart($export_sales_id){
        $this->db->where('export_packing_slip_id', $export_sales_id);
        $this->db->delete("export_packing_slip_parts");
    }
    public function exportPackingSlip($sales_id = '') {
        $this->db->select('s.*');
        $this->db->from('export_packing_slip as s');
        $this->db->where("s.export_sales_id",$sales_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function exportPackingSlipParts($export_packing_slip_id = '') {
        $this->db->select('s.*');
        $this->db->from('export_packing_slip_parts as s');
        $this->db->where("s.export_packing_slip_id",$export_packing_slip_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function exportPackingSlipCount() {
        $this->db->select('count(s.export_packing_slip_id) as count');
        $this->db->from('export_packing_slip as s');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
	
}
?>