<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('ConfigController.php');


class CommonController extends ConfigController {

function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Kolkata');
		// $this->current_date = date('Y-m-d');
		// $this->current_time = date('h:i:s');

		$this->user_name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
		$this->current_date = date('d-m-Y');
		$this->current_time = date('h:i:s');
		$this->current_date_time = $this->current_date."-".date('h:i');

		$date = new DateTime($this->current_date);

		$date->modify('-1 day');
		$this->yesterday_date = $date->format('d-m-Y');
		$this->yesterday_date_new = $date->format('Y-m-d');
		$d = date_parse_from_format("d-m-Y", $this->current_date);
		$this->date = $d["day"];
		$this->month = $d["month"];
		$this->year = $d["year"];

		$this->current_dttm = date('Y-m-d H:i:s');
	}

	public function getTime($dateTime){
		$hour = $dateTime->format('H'); // Hour in 24-hour format
		$minute = $dateTime->format('i'); // Minute
		$second = $dateTime->format('s'); // Second

		return $hour.':'.$minute.':'.$second;
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
	
	public function loadView($viewPage,$viewData,$header = 'Yes',$footer ='Yes'){
        $head_data = $this->getHeaderPage();
		// $this->load->view($viewPage,$viewData);
		// exit();

		$data = $viewData;
		$data['head_data'] = $head_data;
		$data['session_data'] = $this->session->userdata;
		$data['viewPage'] = $viewPage;
		$data['base_url'] = base_url('');
		$header = $header == 'No' ? 'No' : "Yes";
		$footer = ($footer == 'No') ? 'No' : "Yes";
		$this->smarty->loadView($viewPage.".tpl",$data,$header,$footer);

	}

	public function getHeaderPage() {
		/* 
			$this -> load-> model('RoleManagment');
			$this-> RoleManagment -> isProduction();
	
			$entitlements = array(
				"po_import_export"=>true,
				"isGrade"=>false,
				"isPLMEnabled" =>true
			);
		*/
		$global_configuration = $this->Crud->read_data("global_configuration");
		$global_configuration = array_column($global_configuration,"config_value","config_name");
		$config_data = $this->config;
		$config_data = array_merge($config_data->config,$global_configuration);
		$data['session_data'] = $this->session->userdata;
		$data['entitlements'] = $this->getEntitlements();
		$data['config_data'] = $config_data;
		return $data;
		// $this->load->view('header.php',$data);
		$this->smarty->view("header.tpl",$data);
	}
	
	public function redirectToParent(){
		echo "<script>document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	}
	
	public function redirectMessage($page=''){
		if($page==''){
			echo "<script>document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}else{
			echo "<script>document.location='" . base_url($page)."'</script>";
		}
	}
	

	public function isValidUploadFileType($field_name ="uploadedDoc"){
		$targetDir = "documents/";  // Directory where the uploaded files will be stored
		$targetFile = $targetDir . basename($_FILES[$field_name]["name"]);  // Full path of the uploaded file
		
		// Check if the file is an Excel sheet
		$fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
		if ($fileType !== "xls" && $fileType !== "xlsx" && $fileType !== "csv") {
			//echo "Only Excel sheets are allowed.";
			return "false";
		}
		return "true";
	}

	
	public function addMessage($message,$messageType){
		$_SESSION['alert_message']=$message;
		if($messageType==1){ //Success
			$_SESSION['alert_type']='success';
		}else if($messageType==2){ //Error
			$_SESSION['alert_type']='danger';
		}else if($messageType==3){ //Warning
			$_SESSION['alert_type']='warning';
		}else { //Info
			$_SESSION['alert_type']='info';
		}	
	}
	
	public function addSuccessMessage($message){
		$_SESSION['alert_message']=$message;
		$_SESSION['alert_type']='success';
	}
	
	public function addWarningMessage($message){
		$_SESSION['alert_message']=$message;
		$_SESSION['alert_type']='warning';
	}
	
	public function addErrorMessage($message){
		$_SESSION['alert_message']=$message;
		$_SESSION['alert_type']='danger';
	}

	public function checkNoDuplicateEntryError() {
		$alert_code = $_SESSION['alert_code'];
		if($alert_code == 1062) {
			return false;
		}else{
			return true;
		}
	}

	/**
	 * Get the shipping details for sales invoice or supplier based on address type configured
	 * i.e. either Customer or Consignee
	 */
	public function getShippingDetails($new_sales_data , $data) {
		$shipping_data = null;
		if ($new_sales_data[0]->shipping_addressType == "customer") {
				$shipping_data = array(
					"shipping_name" => $data[0]->customer_name,
					"ship_address" => $data[0]->shifting_address,
					"location" => $data[0]->location,
					"state" => $data[0]->state,
					"state_no" => $data[0]->state_no,
					"pin_code" => $data[0]->pin,
					"gst_number" => $data[0]->gst_number,
					"pan_no" => $data[0]->pan_no,
					"phone_no" => ""
				);
		} else if($new_sales_data[0]->shipping_addressType == "supplier") {
					$shipping_data = array(
						"shipping_name" => $data[0]->supplier_name,
						"ship_address" => $data[0]->location,
						"location" => $data[0]->location,
						"state" => $data[0]->state,
						"state_no" => $data[0]->state_no,
						"pin_code" => $data[0]->pin,
						"gst_number" => $data[0]->gst_number,
						"pan_no" => $data[0]->pan_no,
						"phone_no" => $data[0]->mobile_no
					);
		} else {
			$consignee_data = $this->Crud->CustomQuery("SELECT * FROM consignee c, address_master a WHERE
						c.address_id = a.id AND a.addressType ='consignee' AND c.id =" . $new_sales_data[0]->consignee_id);
				$shipping_data = array(
					"shipping_name" => $consignee_data[0]->consignee_name,
					"ship_address" => $consignee_data[0]->address,
					"location" => $consignee_data[0]->location,
					"state" => $consignee_data[0]->state,
					"state_no" => $consignee_data[0]->state_no,
					"pin_code" => $consignee_data[0]->pin_code,
					"gst_number" => $consignee_data[0]->gst_number,
					"pan_no" => $consignee_data[0]->pan_no,
					"phone_no" => $consignee_data[0]->phone_no,
				);
		}
		return $shipping_data;
	}
	

	
	
}