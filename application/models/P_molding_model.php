<?php
class P_molding_model extends CI_Model {
    	
	public function __construct() {

	}
	public function get_down_time_data($date_filer = []){
		$this->db->select('mp.date as date,mp.machine_id as machine_id,mpdd.*,s.shift_type as shift_type,s.name as name,m.name as machine_name,r.name as reason');
        $this->db->from('molding_production as mp');
        $this->db->join('mold_production_downtime_details as mpdd','mpdd.molding_productionKy = mp.id');
        $this->db->join('shifts as s','s.id = mp.shift_id','left');
        $this->db->join('machine as m','m.id = mp.machine_id','left');
        $this->db->join('downtime_master as r','r.id = mpdd.downtime_reasonKy','left');
        // $this->db->where('page_scripts.iPageId', $id);
        if(is_array($date_filer) && count($date_filer) > 0){
            $this->db->where("STR_TO_DATE(mp.date, '%Y-%m-%d') >= '".$date_filer['start_date']."' AND STR_TO_DATE(mp.date, '%Y-%m-%d') <= '".$date_filer['end_date']."'");
        }
        $this->db->order_by("mpdd.downtime",'DESC');
        $data = $this->db->get();
        $res = $data->result_array();
        // pr($this->db->last_query(),1);
        return $res;
	}
  
}
?>