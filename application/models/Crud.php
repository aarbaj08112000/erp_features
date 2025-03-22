<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Model
{

	const isSQLTriageEnabled = false;
	const logQueryTime = false;
	
	/**
	 * Get stock or production db column name
	 */
	public function getStockDBColumnName($fieldName) {
		return $fieldName;

		/*$clientUnit = $this->session->userdata['clientUnit'];
		$fieldNameDBName = $fieldName;
		if ($clientUnit > 1) {
			$fieldNameDBName = $fieldNameDBName . $clientUnit;
		}
		return $fieldNameDBName;
		*/
	}
	
	public function getStockColNmForClientUnit($unitId='') {
		$stock_column_name = "stock"; //Need to get stock value from appropriate column...
		return $stock_column_name;

		/* if(empty($unitId)){
			$currentUnit = $this->session->userdata['clientUnit'];
			if($currentUnit > 1){
				$stock_column_name = "stock".$currentUnit; 
			}
		}else{
			if($unitId > 1){
				$stock_column_name = "stock".$unitId;
			}
		}
        return $stock_column_name;*/
	}

	public function getProdColNmForClientUnit($unitId='') {
		$stock_column_name = "production_qty"; //Need to get stock value from appropriate column...
		return $stock_column_name;
		/*if(empty($unitId)){
			$currentUnit = $this->session->userdata['clientUnit'];
			if($currentUnit > 1){
				$stock_column_name = "production_qty".$currentUnit; 
			}
		}else{
			if($unitId > 1){
				$stock_column_name = "production_qty".$unitId;
			}
		}
        return $stock_column_name;*/
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
	
	
	public function record_count($table) {
		$dateTime = time();
		$result = $this->db->count_all($table);
		$this->logSQLExecuted($dateTime);
		return $result;
   }

    public function update_data($table_name, $array, $id)
    {	
		if ($this->db->field_exists('date', $table_name) && $table_name != "p_q") {
			$array["date"]= $this->getSQLDateFormatToStore();
		}
		if ($this->db->field_exists('time', $table_name)) {
			$array["time"] = $this->current_time;
		}

        $dateTime = time();
		$this->db->where("id", $id);

		if ($this->db->field_exists('clientId', $table_name)) {
			$clientId = $this->Unit->getSessionClientId();
			$this->db->where("clientId", $clientId);
		}

		$result = false;
		if ($this->db->update($table_name, $array)) {
            $result = true;
        }else {
			$error = $this->db->error(); 
			$code = $error["code"];
			$message = $error["message"];
			if($code == 1062){
				$_SESSION['alert_message'] = "Record already exists.";
				$_SESSION['alert_type']='danger';
				$_SESSION['alert_code']='1062';
			}
		}
		// pr($this->db->last_query(),1);
		$this->logSQLExecuted($dateTime);
		return $result;
    }
	
    public function insert_data($table_name, $array,$clientWiseEntry = false)    {
		$dateTime = time();
		$data = $this->getDBCriteria($table_name, $array,false);//for insert we don't want to insert with admin_approval as accept.
		
		if ($this->db->insert($table_name, $data)) {
			$this->logSQLExecuted($dateTime);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
        } else {
			$error = $this->db->error(); 
			$code = $error["code"];
			$message = $error["message"];
			if($code == 1062){
				$_SESSION['alert_message'] = "Record already exists.";
				$_SESSION['alert_type']='danger';
				$_SESSION['alert_code']='1062';
			}
            return false;
        }
    }
    public function get_data_by_id_multiple_condition($table_name, $array)
    {	
	
        $this->db->order_by("id", "desc");
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
            $query = $this->db->get_where($table_name, $array)->result();
	    } else {
            $query = $this->db->get_where($table_name, $array)->result();
	    }
		$this->logSQLExecuted($dateTime);
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_data_by_id_multiple_condition_without($table_name, $array)
    {
        $this->db->order_by("id", "desc");
		$dateTime = time();
        if (false) {
            $query = $this->db->get_where($table_name, array("admin_approve" => "accept"))->result();
	    } else {
            $query = $this->db->get_where($table_name, $array)->result();
	    }
		$this->logSQLExecuted($dateTime);
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
    public function read_data($table_name) {
		
		$this->db->order_by("id", "desc");
		$dateTime = time();
		$data = $this->getDBCriteria($table_name,$data);	
		
		if(!empty($data)){
		 	$query_data = $this->db->get_where($table_name, $data)->result();
		}else {
            $query_data = $this->db->get($table_name)->result();
	    }
		$this->logSQLExecuted($dateTime);
	    if ($query_data) {
            return $query_data;
        } else {
            return false;
        }

    }
	
    public function read_data_acc($table_name)
    {
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
            $query_data = $this->db->get_where($table_name, array("admin_approve" => "accept"))->result();
        } else {
            $query_data = $this->db->get($table_name)->result();
        }
		$this->logSQLExecuted($dateTime);
		
        if ($query_data) {
            return $query_data;
        } else {
            return false;
        }
        // $data['machine_list'] = $this->db->get("machine")->result();
    }
	
    public function read_data_with_admin($table_name)
    {
		$dateTime = time();
		$query_data = $this->db->get($table_name)->result();
		$this->logSQLExecuted($dateTime);
        if ($query_data) {
	        return $query_data;
        } else {
            return false;
        }
        // $data['machine_list'] = $this->db->get("machine")->result();
    }
	
    public function read_data_num($table_name)
    {
		$dateTime = time();
        $query_data = $this->db->get($table_name)->num_rows();
		$this->logSQLExecuted($dateTime);
        if ($query_data) {
            return $query_data;
        } else {
            return false;
        }
    }
	
    public function read_data_where($table_name, $data, $clientFetch=false)
    {
		$data = $this->getDBCriteria($table_name, $data,$clientFetch);

		$dateTime = time();
        $query_data = $this->db->get_where($table_name, $data)->num_rows();
		$this->logSQLExecuted($dateTime);
        if ($query_data) {
            return $query_data;
        } else {
            return 0;
        }
    }
    public function read_data_where_result($table_name, $data)
    {
		$dateTime = time();
        $query_data = $this->db->get_where($table_name, $data);
		$this->logSQLExecuted($dateTime);
        if ($query_data) {
            return $query_data;
        } else {
            return false;
        }
    }

	public function delete_data($table_name, $array)
    {
		$dateTime = time();
        $this->db->where($array);
        $query_delete = $this->db->delete($table_name, $array);
		$this->logSQLExecuted($dateTime);
        if ($query_delete) {
            return true;
        } else {
            return false;
        }
    }
    public function update_data_column($table_name, $array, $id, $column_name, $clientId=false)
    {
		if ($this->db->field_exists('date', $table_name)) {
			$array["date"]= $this->getSQLDateFormatToStore();
		}
		if ($this->db->field_exists('time', $table_name)) {
			$array["time"] = $this->current_time;
		}

		$dateTime = time();
        $this->db->where($column_name, $id);

		if(empty($clientId)) { 
			$clientId = $this->Unit->getSessionClientId();
		}

		if ($this->db->field_exists('clientId', $table_name)) {
				$this->db->where("clientId", $clientId);
		}
		
		$result = $this->db->update($table_name, $array);
		//echo "update qury:";
		$this->logSQLExecuted($dateTime);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

	public function get_data_by_id_desc($table_name, $id)
    {	
		$this->db->order_by("id", "desc");
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
            $query = $this->db->get_where($table_name, array("id" => $id, "admin_approve" => "accept"))->result();
	    } else {
            $query = $this->db->get_where($table_name, array("id" => $id))->result();
	    }
		$this->logSQLExecuted($dateTime);
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

	public function getDBCriteria($table_name,$data, $admin_approve = true){
		$criteria = false;

		if ($this->db->field_exists('clientId', $table_name)) {
			$data["clientId"] = $this->Unit->getSessionClientId();
			$criteria = true;
		}
		
		if ($this->db->field_exists('deleted', $table_name)) {
			$data["deleted"] = 0;
		}

		if($admin_approve == true){
			if ($this->db->field_exists('admin_approve', $table_name)) {
				$data["admin_approve"] = "accept";
				$criteria = true;
			}
		}

		return $data;
	}

    public function get_data_by_id($table_name, $id, $column_name)
    {	
		
		$this->db->order_by("id", "desc");
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
            $query = $this->db->get_where($table_name, array($column_name => $id, "admin_approve" => "accept"))->result();
	    } else {
            $query = $this->db->get_where($table_name, array($column_name => $id))->result();
	    }
		$this->logSQLExecuted($dateTime);
		
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
	
    public function get_data_by_id_asc($table_name, $id, $column_name)
    {
        $this->db->order_by("id", "asc");
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
            $query = $this->db->get_where($table_name, array($column_name => $id, "admin_approve" => "accept"))->result();
	    } else {
            $query = $this->db->get_where($table_name, array($column_name => $id))->result();
	    }
		$this->logSQLExecuted($dateTime);
    
		if ($query) {
            return $query;
        } else {
            return false;
        }
    }
    public function get_data_by_id_multiple($table_name, $array)
    {
		$dateTime = time();
        $query = $this->db->get_where($table_name, $array);
		$this->logSQLExecuted($dateTime);
        if ($query) {
	        return $query->result();
        } else {
            return false;
        }
    }
	
	public function get_data_by_id_order_by_specific($table_name, $id, $column_name, $order_by)
    {
        $this->db->order_by("hsn_code", "asc");
		$dateTime = time();
		if ($this->db->field_exists('admin_approve', $table_name)) {
            $query = $this->db->get_where($table_name, array($column_name => $id, "admin_approve" => "accept"))->result();
        } else {
            $query = $this->db->get_where($table_name, array($column_name => $id))->result();
        }
		$this->logSQLExecuted($dateTime);
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
	
	// Function to sort the array based on the values of a specific column
	public function sort_by_column(&$array, $column, $direction = 'asc') {
		$sort_col = array();
		foreach ($array as $key => $row) {
			$sort_col[$key] = $row[$column];
		}
		array_multisort($sort_col, $direction === 'desc' ? SORT_DESC : SORT_ASC, $array);
		
		return $array;
	
	}
	
	public function where_not_condition($table_name, $key, $value)
    {
		$this->db->order_by("id", "desc");
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
            $query = $this->db->where_not_in($table_name, array($key => $value, "admin_approve" => "accept"));
        } else {
			$this->db->from($table_name);
            $this->db->where_not_in($key, $value);
			$query = $this->db->get()->result();
		}
		$this->logSQLExecuted($dateTime);
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
	   
    }
		
	public function read_data_with_limit($table_name,$limit,$start) {
        $this->db->order_by("id", "desc");
		
        // $query_data = $this->db->get($table_name)->result();
		$dateTime = time();
        if ($this->db->field_exists('admin_approve', $table_name)) {
    		$this->db->limit($limit, $start);
            $query = $this->db->get_where($table_name, array("admin_approve" => "accept"));
			//$query_data = $query->result();
        } else {
			$this->db->limit($limit, $start);
			$query = $this->db->get($table_name);
           // $query_data = $query->result();
        }
		$this->logSQLExecuted($dateTime);
		
		if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $query_data[] = $row;
           }
           return $query_data;
        }
	   
        if ($query_data) {
            return $query_data;
        } else {
            return false;
        }
        // $data['machine_list'] = $this->db->get("machine")->result();
    }
	
	public function customQuery($customQuery){
		$dateTime = time();
		if($this->db->query($customQuery)){
			$queryResult = $this->db->query($customQuery)->result();
			$this->logSQLExecuted($dateTime);
			if ($queryResult) {
				return $queryResult;
			} else {
				return false;
			}
		}
		
		$this->logSQLExecuted($dateTime);
		return false;
   }
   public function customQueryUpdate($customQuery){
		$dateTime = time();
		if($this->db->query($customQuery)){
			$queryResult = $this->db->query($customQuery);
			$this->logSQLExecuted($dateTime);
			if ($queryResult) {
				return $queryResult;
			} else {
				return false;
			}
		}
		$this->logSQLExecuted($dateTime);
		return false;
   }
	
	/* 
	Tips 
	
	1) 
	The second and third parameters enable you to set a limit and offset clause:
	$query = $this->db->get('mytable', 10, 20);
	
	
	2) Know the query executed .
	
	//echo '<pre>';  //to preserve formatting
	//die($this->db->last_query()); 

	3)
	Permits you to write the SELECT portion of your query:

	$this->db->select('title, content, date');
	$query = $this->db->get('mytable');


	4) 
	$this->db->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid', FALSE);
	$query = $this->db->get('mytable');
	
	5)Join
	$this->db->select('*');
	$this->db->from('blogs');
	$this->db->join('comments', 'comments.id = blogs.id');
	$query = $this->db->get();

	// Produces:
	// SELECT * FROM blogs JOIN comments ON comments.id = blogs.id
	
	$this->db->join('comments', 'comments.id = blogs.id', 'left');
	// Produces: LEFT JOIN comments ON comments.id = blogs.id

	6) Where
	$this->db->where('name !=', $name);
	$this->db->where('id <', $id); // Produces: WHERE name != 'Joe' AND id < 45
	
	$array = array('name' => $name, 'title' => $title, 'status' => $status);
	$this->db->where($array);
	// Produces: WHERE name = 'Joe' AND title = 'boss' AND status = 'active'

	7)
	You can write your own clauses manually:
	$where = "name='Joe' AND status='boss' OR status='active'";
	$this->db->where($where);

	8)
	$this->db->distinct();
	$this->db->get('table'); // Produces: SELECT DISTINCT * FROM table
	
	9) Limits
	$this->db->limit(10);  // Produces: LIMIT 10
	$this->db->limit(10, 20);  // Produces: LIMIT 20, 10 (in MySQL.  Other databases have slightly different syntax)
	
	10) Query binding
	
	$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
	$this->db->query($sql, array(3, 'live', 'Rick'));

	
	11) CUSTOM QUERY :
	$query = $this->db->query('select * from userinfo where type not in ("AROM_ADMIN") LIMIT 5');
	$query->result();
	
	$sql = "SELECT * FROM userinfo WHERE type not in(?) AND user_role not in (?) ";
	$query = $this->db->query($sql, array('AROM_ADMIN','Admin'));
		
	$data = $query->result();

	//$criteria = array('AROM_ADMIN',"Admin");

		//$query = $this->db->query('select * from userinfo where type not in ("AROM_ADMIN") LIMIT 5');
		
		//echo $query->result();
		
		//$criteria = array('AROM_ADMIN');
		//$query = $this->db->get('userinfo', 10, 20);
		
		//echo '<pre>';  //to preserve formatting
		//die($this->db->last_query()); 
		
		//$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?"; 
		//$this->db->query($sql, array(3, 'live', 'Rick'));

		//$query = $this->db->query('select * from userinfo where type not in ("AROM_ADMIN")');
		$sql = "SELECT * FROM userinfo WHERE type not in(?) AND user_role not in (?) ";
		$query = $this->db->query($sql, array('AROM_ADMIN','Admin'));
		
		$data['user_info']  = $query->result();
		
		
		//transaction manager code - need to check how it works OR need to test once.
		echo $this->db->trans_enabled;
		$this->db->trans_begin();
		
			$sql = "Update uom set uom_description='Cum2=' WHERE uom_name='Cum'";
			$result = $this->db->query($sql);
			
		$this->db->trans_complete();
		echo "<br>status: ".$this->db->trans_status();
		
		if ($this->db->trans_status() === FALSE) {
			echo "rollbacked ";
			$this->db->trans_rollback();
		}else{
			echo "<br>Committed";
			$this->db->trans_commit();
		}
	
		exit();
		
	*/
	
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


	public function getDateByFormat($dateTime,$format=null){
	//	$dateString = '2024-03-16'; // Example date string
		// Create a DateTime object from the date string
		$date = new DateTime($dateTime);
		// Define a date format using a formatter
		$dateFormat = 'd-m-Y'; // Format as Day-Month-Year (e.g., 16-03-2024)
		if(!empty($format)){
			$dateFormat = $format;
		}
		// Format the date using the defined format
		$formattedDate = $date->format($dateFormat);
		return $formattedDate; // Output: Formatted Date: 16-03-2024

	}

	public function getSQLDateFormatToStore() {
		$original_date = $this->current_date; //'16-05-2024';

		// Create a DateTime object from the original date
		$date_object = DateTime::createFromFormat('d-m-Y', $original_date);

		// Convert the date to YYYY-MM-DD format
		$formatted_date = $date_object->format('Y-m-d');
		return $formatted_date;
	}
	/**
	 * Stock report updates
	 */
	public function stock_report($part_number_from, $part_number_to, $from, $to, $transfer_stock, $actual_stock) {
		$data = array(
			"part_number_from" => $part_number_from,
			"part_number_to" => $part_number_to,
			"from" => $from,
			"to" => $to,
			"transfer_stock" => $transfer_stock,
			"actual_stock" => $actual_stock,
			"updated_by" => $this->user_id,
			"updated_time" => $this->current_date,
			"updated_date" => $this->current_time,
			"clientId" => $this->Unit->getSessionClientId()
		);

		$result = $this->Crud->insert_data("stock_report", $data);
		/* if (!$result) {
			$this->addErrorMessage('Failed to audit the stock transfer for stock report.');
		} */
	}
	/**
	 * Get overall amount with tax
	 */
	public function tax_calcuation($gst_structure, $subTotal, $discountAmt){
		$final_basic_total = $subTotal;
		$cgst_amount = number_format((($final_basic_total * $gst_structure->cgst) / 100), 2, '.', '');
		$sgst_amount = number_format((($final_basic_total * $gst_structure->sgst) / 100), 2, '.', '');
		$igst_amount = number_format((($final_basic_total * $gst_structure->igst) / 100), 2, '.', '');

		if ($gst_structure->tcs_on_tax == "no") {
			$tcs_amount = number_format((($final_basic_total * $gst_structure->tcs) / 100), 2, '.', '');
		} else {
			$tcs_amount = number_format(((($cgst_amount + $sgst_amount + $igst_amount + $final_basic_total) * $gst_structure->tcs) / 100), 2, '.', '');
		}
		$gst_amount = $cgst_amount + $sgst_amount + $igst_amount;
		$sales_total["bfre_disc_sub_total"] = round($subTotal,2);
		$sales_total["sales_sub_total"] = round($final_basic_total,2);
		$sales_total["sales_total"] = round($final_basic_total + $cgst_amount + $sgst_amount + $igst_amount+ $tcs_amount,2);
		$sales_total["sales_gst"] = round($cgst_amount + $sgst_amount + $igst_amount,2);
		$sales_total["sales_cgst"] = round($cgst_amount,2);
		$sales_total["sales_sgst"] = round($sgst_amount,2);
		$sales_total["sales_igst"] = round($igst_amount,2);
		$sales_total["sales_tcs"] = round($tcs_amount,2);
		$sales_total["sales_discount"] = round($discountAmt,2);

		return $sales_total;
	}
}