<?php

class Common_admin_model extends CI_Model
{


	const isSQLTriageEnabled = false;
	const logQueryTime = false;
	

	//login
	public function login_user($mobile, $password)
	{

		$this->db->where(['email' => $mobile]);
		$this->db->where(['password' => $password]);
		$result = $this->db->get('user');

		if ($result->num_rows() == 1) {

			return $result->result();
		} else {
			return $result->num_rows();
		}
	}
	public function get_month($get_month)
	{
		if ($get_month == 1) {
			return "JAN";
		} else if ($get_month == 2) {
			return "FEB";
		} else if ($get_month == 3) {
			return "MAR";
		} else if ($get_month == 4) {
			return "APR";
		} else if ($get_month == 5) {
			return "MAY";
		} else if ($get_month == 6) {
			return "JUN";
		} else if ($get_month == 7) {
			return "JUL";
		} else if ($get_month == 8) {
			return "AUG";
		} else if ($get_month == 9) {
			return "SEP";
		} else if ($get_month == 10) {
			return "OCT";
		} else if ($get_month == 11) {
			return "NOV";
		} else if ($get_month == 12) {
			return "DEC";
		}
	}

	public function getFinancialYears(){
		$fyears = $this->get_all_data_asc("financialyear");
		return $fyears;
	}
	public function get_month_number($get_month)
	{
		if ($get_month == "APR") {
			return 4;
		} else if ($get_month == "MAY") {
			return 5;
		} else if ($get_month == "JUN") {
			return 6;
		} else if ($get_month == "JUL") {
			return 7;
		} else if ($get_month == "AUG") {
			return 8;
		} else if ($get_month == "SEP") {
			return 9;
		} else if ($get_month == "OCT") {
			return 10;
		} else if ($get_month == "NOV") {
			return 11;
		} else if ($get_month == "DEC") {
			return 12;
		} else if ($get_month == "JAN") {
			return 1;
		} else if ($get_month == "FEB") {
			return 2;
		} else if ($get_month == "MAR") {
			return 3;
		}
	}

	public function login_user_admin($mobile, $password)
	{
		$this->db->where(['user_email' => $mobile]);
		$this->db->where(['user_password' => $password]);
		$result = $this->db->get('admin_user');

		if ($result->num_rows() == 1) {
			return $result->result();
		} else {
			return $result->num_rows();
		}
	}


	public  function get_all_data_asc($table_name)
	{
		$this->db->order_by("id", "asc");
		return $this->db->get($table_name)->result();
	}

	public  function get_all_data($table_name)
	{
		if ($this->db->field_exists('priority', $table_name)) {
			$this->db->order_by("priority", "ASC");
		}
		if ($this->db->field_exists('deleted', $table_name)) {
			$this->db->where("deleted", 0);
		} else {
			$this->db->order_by("id", "desc");
		}

		return $this->db->get($table_name)->result();
	}
	public  function get_all_data_without_delete($table_name)
	{
		$this->db->order_by("id", "desc");

		return $this->db->get($table_name)->result();
	}
	public  function get_all_data_array($table_name)
	{
		$this->db->order_by("id", "desc");
		$this->db->where("deleted", 0);

		return $this->db->get($table_name)->result_array();
	}

	public function row_delete($column_name, $value, $table_name)
	{
		$this->db->where($column_name, $value);

		if ($this->db->delete($table_name)) {
			return true;
		} else {
			return false;
		}
	}


	public  function get_all_data_count($table_name)
	{
		$this->db->order_by("id", "desc");
		$this->db->where("deleted", 0);
		return $this->db->get($table_name)->num_rows();
	}
	public  function get_all_data_count_without_delete($table_name)
	{
		$this->db->order_by("id", "desc");
		return $this->db->get($table_name)->num_rows();
	}



	public function insert($table_name, $data)
	{
		if ($this->db->insert($table_name, $data)) {
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		} else {
			return false;
		}
	}

	public function update($table_name, $data, $where_column, $where_id)
	{

		$this->db->where($where_column, $where_id);
		if ($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function get_data_by_id_count($table_name, $id, $column_name)
	{
		$query = $this->db->get_where($table_name, array($column_name => $id))->num_rows();
		$this->logSQLExecuted($dateTime);
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}
	
	public function get_product_info_new($product_id)
	{
		$this->db->select('*');
		$this->db->from('order_items q');
		$this->db->join('product p', 'q.product_id   = p.id', 'left');
		$this->db->order_by('q.created_at', 'ASC');
		$this->db->where('p.id', $product_id);

		$query = $this->db->get();
		$this->logSQLExecuted($dateTime);
		return $query->result();
	}

	public function get_data_by_id($table_name, $id, $column_name)
	{
		$this->db->order_by("id", "desc");
		$query = $this->db->get_where($table_name, array($column_name => $id, "admin_approve" => "accept"))->result();
		$this->logSQLExecuted($dateTime);

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function get_data_by_idd($table_name, $id, $column_name)
	{
		$query = $this->db->get_where($table_name, array($column_name => $id))->result_array();
		$this->logSQLExecuted($dateTime);

		if ($query) {
			return $query;
		} else {
			return false;
		}
		
	}

	public function get_data_by_id_multiple_condition($table_name, $array)
	{
		$this->db->order_by("id", "desc");
		$this->db->order_by("id", "desc");

		if ($this->db->field_exists('admin_approve', $table_name)) {
			// some code...
			$query = $this->db->get_where($table_name, $array)->result();
			// $query_data = $this->db->get_where($table_name, array("admin_approve" => "accept"))->result();
		} else {
			$query = $this->db->get_where($table_name, $array)->result();
			// $query_data = $this->db->get($table_name)->result();
		}
		$this->logSQLExecuted($dateTime);
		
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function get_data_by_full_outer_join($table_name1, $table_name2, $table_name1_id, $table_name2_id)
	{
		$query = $this->db->get_where($table_name, $array)->result();
		$this->logSQLExecuted($dateTime);
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}
	public function get_data_by_id_multiple_condition_count($table_name, $array)
	{
		$query = $this->db->get_where($table_name, $array)->num_rows();
		if ($query) {
            return $query;
        } else {
            return false;
        }

	}
	public function get_data_by_id_multiple_condition_count_new($table_name, $array)
	{
		$query = $this->db->get_where($table_name, $array)->num_rows();
		$this->logSQLExecuted($dateTime);
		if ($query) {
            return $query;
        } else {
            return 0;
        }
	}

	public function delete_user_by_id($table_name, $column_name, $id)
	{
		if ($this->db->delete($table_name, array($column_name => $id))) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Calculate sticker quantity as multiple of default qty
	 */
	function calculateAllFactorsForSticker($requiredQty, $defaultQty) {
		if($defaultQty==0){
			$defaultQty = 1;
		}
			$factors = array($defaultQty);
			$result = array();
			foreach ($factors as $factor) {
				$count = intdiv($requiredQty, $factor);
				if($count > 0){
					$dataSets[] = array(
						'factor' =>  $defaultQty,
						'count' => $count
					);
				}
				$requiredQty -= $count * $factor;
				if($requiredQty>0) { //If no reminder then we don't need to add further
					$dataSets[] = array(
						'factor' => $requiredQty,
						'count'	 => 1
					);
				}
			}
			return $dataSets;
		}


		private function logSQLExecuted($startDateTime){
			if(self::isSQLTriageEnabled){
				$timeTakenForQuery = time() - $startDateTime;
				$this->logQueries($this->db->last_query());
				if(self::logQueryTime) {
					$this->logQueries("\t Time for Query in milliseconds: ".$timeTakenForQuery);
				}
				$this->logQueries("\n");
				//echo '<pre>';
				//echo "<br>".$this->db->last_query(); 
			}
		 }

		 private function logQueryTime(){
			if(self::logQueryTime){
				$dateTime = time();
				$this->logQueries($dateTime);
				return $dateTime;
				//echo '<pre>';
				//echo "<br>".$this->db->last_query(); 
			}
		 }

		 function logQueries($log_msg) {
			$log_filename = $_SERVER['DOCUMENT_ROOT']."/query_log";
			if (!file_exists($log_filename)) 
			{
				// create directory/folder uploads.
				mkdir($log_filename, 0777, true);
			}else{
			}
			$log_file_data = $log_filename.'/query_log_' . date('d-M-Y') . '.log';
			// if you don't add `FILE_APPEND`, the file will be erased each time you add a log
			file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
		} 

}