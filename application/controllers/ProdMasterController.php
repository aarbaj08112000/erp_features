<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class ProdMasterController extends CommonController {

	function __construct() {
		parent::__construct();
	}
	
	public function shifts()
	{
		checkGroupAccess("shifts","list","Yes");
		$data['shifts'] = $this->Crud->read_data("shifts",true);
		$this->loadView('admin/shifts', $data);
	}


	public function addShift()
	{
		$name = $this->input->post('shiftName');
		$start_time = $this->input->post('shiftStart');
		$end_time = $this->input->post('end_time');
		$shift_type = $this->input->post('shiftType');
		$end_time = $this->input->post('shiftEnd');
		$ppt = $this->input->post('ppt');

		$clientId = $this->Unit->getSessionClientId();

		/*$data = array(
			"name" => "xyyyyyz",
		);*/
		//$check = $this->Crud->read_data_where("shifts", $data);
		/*if ($check != 0) {
			echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {*/
			$data = array(
				//"clientId" => $clientId,
				"name" => $name,
				"start_time" => $start_time,
				"end_time" => $end_time,
				"shift_type" => $shift_type,
				"ppt" => $ppt
			);

			$result = $this->Crud->insert_data("shifts", $data, true);
			if ($result) {
				echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		//}
	}

	/**
	 * Operator 
	 */
	public function operator()
	{
		checkGroupAccess("operator","list","Yes");
		$data['operator'] = $this->Crud->read_data("operator",true);
		$this->loadView('admin/operator', $data);
	}

	public function add_operator()
	{
		$ret_arr = [];
		$msg = '';
		$success = 1;
		$clientId = $this->Unit->getSessionClientId();
		$data = array(
			'name' => $this->input->post('namess'),
		);

		$check = $this->Crud->read_data_where("operator", $data, true);
		if ($check != 0) {
			$msg = 'Record already exists';
			$success = 0;
			// echo "<script>alert('Record already exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			// exit();
		}

		$inser_query = $this->Crud->insert_data("operator", $data, true);

		if ($inser_query) {
			if ($inser_query) {
				// echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				$msg = 'Operator Added Successfully';
			} else {
				// echo "<script>alert('Error while Adding ,try again');document.location='erp_users'</script>";
				$msg = 'Error while Adding ,try again';
				$success = 0;
			}
		} else {
			$msg = 'Unable to add operator ,try again';
			$success = 0;
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
	}


	public function machine()
	{
		checkGroupAccess("machine","list","Yes");
		$data['machine'] = $this->Crud->read_data("machine",true);
		$this->loadView('admin/machine', $data);	
	}

	public function add_machine()
	{
		$clientId = $this->Unit->getSessionClientId();
		$data = array(
			'name' => $this->input->post('namess'),
		);
		$ret_arr = [];
		$msg = '';
		$success = 1;
		$check = $this->Crud->read_data_where("machine", $data, true);
		if ($check != 0) {
			// echo "<script>alert('Record already exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			// exit();
			$msg = 'Record already exists';
			$success = 0;
		}

		$inser_query = $this->Crud->insert_data("machine", $data, true);

		if ($inser_query) {
			if ($inser_query) {
				// echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				$msg = 'Machine added successfully';
			} else {
				// echo "<script>alert('Error while Adding ,try again');document.location='erp_users'</script>";
				$msg = 'Machine added successfully';
				$success = 0;
			}
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
	}
	

	
}