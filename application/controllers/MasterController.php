<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class MasterController extends CommonController {

	function __construct() {
		parent::__construct();
		$this->load->model('UomModel');
	}
	
	public function users() {
		$data['user_info'] = $this->Crud->read_data("userinfo");
		$this->load->view('header');
		$this->load->view('users', $data);
		$this->load->view('footer');
		
	}
	
	public function client()
	{
		checkGroupAccess("client","list","Yes");
		$data['client_list'] = $this->Crud->read_data_acc("client");
		$session_client_unit = $this->session->userdata('clientUnit');
		$data['filter_client'] = $session_client_unit;
		$data['isMultiClient'] = $this->session->userdata['isMultipleClientUnits'];
		$data['noOfClients'] = $this->session->userdata['noOfClients'];
		// $this->load->view('header');
		$this->loadView('admin/client', $data);
		// $this->load->view('footer');
		
	}


	public function addClient()
	{	
    
		$clientUnit = trim($this->input->post('clientUnit'));
		$clientName = trim($this->input->post('clientName'));
		$contactPerson = trim($this->input->post('contactPerson'));
		$clientSaddress = trim($this->input->post('clientSaddress'));
		$clientBaddress = trim($this->input->post('clientBaddress'));
		$pan_no = trim($this->input->post('pan_no'));
		$gst_no = trim($this->input->post('gst_no'));
		$phone_no = trim($this->input->post('phone_no'));
		$state = trim($this->input->post('state'));
		$state_no = trim($this->input->post('state_no'));
		$bank_details = trim($this->input->post('bank_details'));
		$bank_name = trim($this->input->post('bank_name'));
		$bank_account_no = trim($this->input->post('bank_account_no'));
		$account_name = trim($this->input->post('account_name'));
		$ifsc_code = trim($this->input->post('ifsc_code'));
		$swift_code = trim($this->input->post('swift_code'));
		$micr_code = trim($this->input->post('micr_code'));
		$lut_no = trim($this->input->post('lut_no'));
		$lut_date = trim($this->input->post('lut_date'));
		$ad_no = trim($this->input->post('ad_no'));
		$address1 = trim($this->input->post('address1'));
		$location = trim($this->input->post('location'));
		$pin = trim($this->input->post('pin'));
		$email = trim($this->input->post('emailId'));

		$data = array(
			"client_unit" => $clientUnit,
			"client_name" => $clientName,
			"gst_number" => $gst_no
		);

		$check = $this->Crud->read_data_where("client", $data);
		if ($check != 0) {
			$msg = 'Record already exists.';
				$success = 0;
			// $this->addWarningMessage('Record already exists.');
			// $this->redirectToParent();
		} else {
			$data = array(
				"client_unit" => $clientUnit,
				"client_name" => $clientName,
				"contact_person" => $contactPerson,
				"billing_address" => $clientBaddress,
				"shifting_address" => $clientSaddress,
				"gst_number" => $gst_no,
				"phone_no" => $phone_no,
				"pan_no" => $pan_no,
				"state" => $state,
				"state_no" => $state_no,
				"bank_details" => $bank_details,
				"bank_name" => $bank_name,
				"bank_account_no" => $bank_account_no,
				"account_name" => $account_name,
				"ifsc_code" => $ifsc_code,
				"swift_code" => $swift_code,
				"micr_code" => $micr_code,
				"lut_no" => $lut_no,
				"lut_date" => $lut_date,
				"ad_no" => $ad_no,
				"address1" => $address1,
				"location" => $location,
				"pin" => $pin,
				"emailId" => $email,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);
			$result = $this->Crud->insert_data("client", $data);
			if ($result) {
				$msg = 'Client added successfully.';
				$success = 1;
			} else {
				// $this->addErrorMessage('Failed to add client');
				$msg = 'Failed to add or similar data exists.';
				$success = 0;
			}
		}
		$ret_arr['msg'] = $msg;
			$ret_arr['success'] = $success;
			echo json_encode($ret_arr);
			exit();
	}
	
	
	public function updateClient()
	{
		
		$ret_arr = [];
		$msg = '';
		$success = 1;
		$clientUnit = trim($this->input->post('uclientUnit'));
		$clientName = trim($this->input->post('uclientName'));
		$contactPerson = trim($this->input->post('ucontactPerson'));
		$clientSaddress = trim($this->input->post('uclientSaddress'));
		$clientBaddress = trim($this->input->post('uclientBaddress'));
		$gst_no = trim($this->input->post('ugst_no'));
		$phone_no = trim($this->input->post('uphone_no'));
		$pan_no = trim($this->input->post('pan_no'));

		$id = trim($this->input->post('id'));
		$state = trim($this->input->post('state'));
		$state_no = trim($this->input->post('state_no'));
		$bank_details = trim($this->input->post('bank_details'));
		$bank_name = trim($this->input->post('bank_name'));
		$bank_account_no = trim($this->input->post('bank_account_no'));
		$account_name = trim($this->input->post('account_name'));
		$ifsc_code = trim($this->input->post('ifsc_code'));
		$swift_code = trim($this->input->post('swift_code'));
		$micr_code = trim($this->input->post('micr_code'));
		$lut_no = trim($this->input->post('lut_no'));
		$lut_date = trim($this->input->post('lut_date'));
		$ad_no = trim($this->input->post('ad_no'));
		$address1 = trim($this->input->post('address1'));
		$location = trim($this->input->post('location'));
		$pin = trim($this->input->post('pin'));
		$email = trim($this->input->post('email'));

		$data = array(
				"client_unit" => $clientUnit,
				"client_name " => $clientName,
				"contact_person" => $contactPerson,
				"billing_address" => $clientBaddress,
				"shifting_address" => $clientSaddress,
				"gst_number" => $gst_no,
				"phone_no" => $phone_no,
				"pan_no" => $pan_no,
				"state" => $state,
				"state_no" => $state_no,
				"bank_details" => $bank_details,
				"bank_name" => $bank_name,
				"bank_account_no" => $bank_account_no,
				"account_name" => $account_name,
				"ifsc_code" => $ifsc_code,
				"swift_code" => $swift_code,
				"micr_code" => $micr_code,
				"lut_no" => $lut_no,
				"lut_date" => $lut_date,
				"ad_no" => $ad_no,
				"address1" => $address1,
				"location" => $location,
				"pin" => $pin,
				"emailId" => $email,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);
			
			$result = $this->Crud->update_data("client", $data, $id);
			if ($result) {
				// $this->addSuccessMessage('Client updated');
				$msg = 'Client updated successfully.';
				$success = 1;
			} else {
				// $this->addErrorMessage('Failed to update or similar data exists.');
				$msg = 'Failed to update or similar data exists.';
				$success = 0;
			}
			// $this->redirectToParent();
			$ret_arr['msg'] = $msg;
			$ret_arr['success'] = $success;
			echo json_encode($ret_arr);
			exit();
	}

	public function update_session_unit() {
		$clientUnitID = $this->input->post('clientUnit');
		$this->session->set_userdata('clientUnit',$clientUnitID); //set the clientUnit to session..
		$clientDetails = $this->getClientUnitDetails($clientUnitID);
		$this->session->set_userdata('clientUnitName',$clientDetails[0]->client_unit ); //set the clientUnit to session..
		$this->addSuccessMessage('Session updated successfully.');
		$this->redirectToParent();
	}

	/*
	 UOM Workflows
	*/
	public function uom()
	{
		checkGroupAccess("uom","list","Yes");
		$data['uom'] = $this->UomModel->getAllUOM();
		// $this->load->view('header');
		$this->loadView('admin/uom', $data);
		// $this->load->view('footer');
	}
	
	public function adduom()
	{
		$name = $this->input->post('uomName');
		$description = $this->input->post('uomDescription');
		$ret_arr = [];
		$msg = '';
		$success = 1;
		$data = array(
			"uom_name" => $name
		);

		if ($this->UomModel->isRecordExists($data)) {
			$this->addWarningMessage('UOM already exists.');
			$this->redirectToParent();
		} else {
			$data = array(
				"uom_name" => $name,
				"uom_description" => $description,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);

			$result = $this->UomModel->createUOM($data);
			if ($result>0) {
				// $this->addSuccessMessage('UOM created');
				$msg = 'UOM added successfully.';
			} else {
				// $this->addErrorMessage('Failed to create UOM');
				$msg = 'Failed to create UOM.';
				$success = 0;
			}
			// $this->redirectToParent();
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
		
	}
	
	public function updateuom()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('uuomName');
		$description = $this->input->post('uomDescription');
		$ret_arr = [];
		$msg = '';
		$success = 1;

		$data = array(
			"uom_name" => $name,
			"uom_description" => $description
		);
		
		if ($this->UomModel->isRecordExists($data)) {
			// $this->addErrorMessage('UOM already exists');
			// $this->redirectToParent();
			$msg = 'UOM already exists';
			$success = 0;
		} else {
			if ($this->UomModel->updateUOM($data, $id)) {
				// $this->addSuccessMessage('UOM Updated');
				$msg = 'UOM Updated';
				
			} else {
				$this->addErrorMessage('Failed to update UOM');
				$msg = 'Failed to update UOM';
				$success = 0;
			}
			// $this->redirectToParent();
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
	}
	
	
	// TAX Structure
	
	public function tax()
	{
		$data['gst'] = $this->Crud->read_data_by_column("gst_structure","gst_structureky");
		$this->load->view('header');
		$this->load->view('tax', $data);
		$this->load->view('footer');
	}
	
	public function add_tax()
	{
		$code = $this->input->post('code');
		$cgst = $this->input->post('cgst');
		$sgst = $this->input->post('sgst');
		$igst = $this->input->post('igst');
		$tcs = $this->input->post('tcs');
		$tcs_on_tax = $this->input->post('tcs_on_tax');
		$with_in_state = $this->input->post('with_in_state');
		$data = array(
			"code" => $code,
		);
		$check = $this->Crud->read_data_where("gst_structure", $data);
		if ($check != 0) {
			$this->addMessage('Tax code already exists');
			$this->redirectToParent();
		} else {
			$data = array(
				"code" => $code,
				"cgst" => $cgst,
				"sgst" => $sgst,
				"igst" => $igst,
				"tcs" => $tcs,
				"tcs_on_tax" => $tcs_on_tax,
				"in_state" => $with_in_state,
				"created_by" => $this->user_id,
//				"created_dttm" => $this->current_date,
			);

			$result = $this->Crud->insert_data("gst_structure", $data);
			if ($result) {
				$this->addMessage('Tax structure added',1);
			} else {
				$this->addMessage('Error while adding tax structure',2);
			}
			$this->redirectToParent();
		}
	}
	
	
	public function update_tax() {
		$code = $this->input->post('code');
		$cgst = $this->input->post('cgst');
		$sgst = $this->input->post('sgst');
		$igst = $this->input->post('igst');
		$tcs = $this->input->post('tcs');
		$with_in_state = $this->input->post('with_in_state');
		$tcs_on_tax = $this->input->post('tcs_on_tax');
		
		$data = array(
			"cgst" => $cgst,
			"sgst" => $sgst,
			"igst" => $igst,
			"tcs" => $tcs,
			"tcs_on_tax" => $tcs_on_tax,
			"in_state" => $with_in_state,
		);

		$query = $this->Common_admin_model->update("gst_structure", $data, "code", $code);

		if ($query) {
			$this->addMessage('Tax structure updated',1);
		} else {
			$this->addMessage('Error while updating tax structure',2);
		}
		$this->redirectToParent();
	}
	
	/*
	 * Transporter
	*/
	
	public function transporter()
	{
		
		$data['transporter'] = $this->Common_admin_model->get_all_data("transporter");
		$this->load->view('header.php');
		$this->load->view('transporter.php', $data);
		$this->load->view('footer.php');
	}
	
	public function add_transporter()
	{
// 		$transporter_count = $this->Common_admin_model->get_data_by_id_count("transporter", $this->input->post('name'), "name");
// 		if ($customer_count > 0) {
// 			echo "<script>alert('Transporter already Present!!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
// 		} else {
	
		$data = array(
				'name' => $this->input->post('name'),
				'transporter_id' => $this->input->post('transporter_id'),
				'created_by' => $this->user_id
			);
			$insert = $this->Common_admin_model->insert('transporter', $data);
			if ($insert) {
				$this->addSuccessMessage('Transporter added');
			} else {
				$this->addSuccessMessage('Error while updating transporter');
			}
		$this->redirectToParent();
	}
	
	public function update_transporter()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$transporterId = $this->input->post('transporter_id');
		
		$data = array(
			"name" => $name,
			"transporter_id" => $transporterId
			
		);
		$check = $this->Crud->read_data_where("transporter", $data);
		if ($check != 0) {
			$this->addErrorMessage('Transporter already exists');
		} else {
			$result = $this->Crud->update_data("transporter", $data, $id);
			if ($result) {
				$this->addSuccessMessage('Transporter updated');
			} else {
				$this->addErrorMessage('Failed to update transporter');
			}
		}
		$this->redirectToParent();	
	}




	public function consignee()
	{
		checkGroupAccess("consignee","list","Yes");
		$data['consignee_list'] = $this->Crud->CustomQuery("SELECT c.id as c_id, c.*,a.* FROM consignee c, 
			address_master a where c.address_id = a.id");
		// $this->load->view('header');
		
		foreach ($data['consignee_list'] as $key => $value) {
			$data['consignee_list'][$key]->encode_data = base64_encode(json_encode($value));
		}
		 $data['currentUnit'] = $this->Unit->getNoOfClients();
		$this->loadView('customer/consignee', $data);	
		// $this->load->view('footer');
		
	}
	
	
	public function add_consignee()
	{
		$consignee_name = trim($this->input->post('cconsignee_name'));
		$location = trim($this->input->post('clocation'));
		$address = trim($this->input->post('caddress'));
		$state = trim($this->input->post('cstate'));
		$state_no = trim($this->input->post('cstate_no'));
		$pin_code = trim($this->input->post('cpin_code'));
		$gst_number = trim($this->input->post('gst_number'));
		$pan_no = trim($this->input->post('cpan_no'));
		$phone_no = trim($this->input->post('cphone_no'));
		$distance1 = trim($this->input->post('distncFrmClnt1'));
        $distance2 = trim($this->input->post('distncFrmClnt2'));
        $distance3 = trim($this->input->post('distncFrmClnt3'));


		$data = array(
			"consignee_name" => $consignee_name,
			"location" => $location
		);
		$ret_arr = [];
		$msg = '';
		$sucess = 1;
		$check = $this->Crud->read_data_where("consignee", $data);

		
			if ($check != 0) {
				// $this->addWarningMessage('Record already exists with Consignee Name and Location');
				// $this->redirectToParent();
				$sucess = 0;
				$msg = 'Record already exists with Consignee Name and Location. Can not add duplicate entry.';
			} else {
				$data = array(
					"gst_number" => $gst_number
				);
				$check = $this->Crud->read_data_where("consignee", $data);

				if($check == 0){
					$address_data = array(
						"address" => $address,
						"location" => $location,
						"state" => $state,
						"state_no" => $state_no,
						"pin_code" => $pin_code,
						"addressType" => 'consignee',
						"created_dttm" => $this->current_dttm,
						"updated_user" => $this->user_name
					);
					$result = $this->Crud->insert_data("address_master", $address_data);
					if ($result) {
						$consignee_data = array(
							"address_id" => $result,
							"location" => $location,
							"consignee_name" => $consignee_name,
							"pan_no" => $pan_no,
							"phone_no" => $phone_no,
							"gst_number" => $gst_number,
							"distncFrmClnt1"=> $distance1,
						    "distncFrmClnt2"=> $distance2,
						    "distncFrmClnt3"=> $distance3,
							"deleted" => 0,
							"created_dttm" => $this->current_dttm,
							"updated_user" => $this->user_name,
						);
					
						$result = $this->Crud->insert_data("consignee", $consignee_data);
						if ($result) {
							// $this->addSuccessMessage('Consignee added successfully.');
							$sucess = 1;
							$msg = 'Consignee added successfully.';
						} else {
							//$this->addErrorMessage('Failed to add Consignee. Please try again.');
							$sucess = 1;
							$msg = 'Failed to add Consignee. Please try again.';
						}
					} else {
						// $this->addErrorMessage('Failed to add Consignee. Please try again.');
						$sucess = 1;
						$msg = 'Failed to add Consignee. Please try again.';
						
					}
				}else{
					$sucess = 0;
					$msg = 'GST number already exist.';
				}
				// $this->redirectToParent();
			}
		
		$ret_arr['msg'] = $msg;
		$ret_arr['sucess'] = $sucess;
		echo json_encode($ret_arr);
	}
	
	
	public function update_consignee()
	{
		$id = $this->input->post('consignee_id');
		$address_id = $this->input->post('address_id');

		$consignee_name = trim($this->input->post('uconsignee_name'));
		$location = trim($this->input->post('ulocation'));
		$address = trim($this->input->post('uaddress'));
		$state = trim($this->input->post('ustate'));
		$state_no = trim($this->input->post('ustate_no'));
		$pin_code = trim($this->input->post('upin_code'));
		$gst_number = trim($this->input->post('ugst_number'));
		$pan_no = trim($this->input->post('upan_no'));
		$phone_no = trim($this->input->post('uphone_no'));
		$distance1 = trim($this->input->post('distncFrmClnt1'));
        $distance2 = trim($this->input->post('distncFrmClnt2'));
        $distance3 = trim($this->input->post('distncFrmClnt3'));

		$data = array(
			"consignee_name" => $consignee_name,
			"location" => $location
		);
		$ret_arr = [];
		$msg = '';
		$sucess = 1;

		$data_result = $this->Crud->read_data_where_result("consignee", $data)->result();
		
		if(!empty($data_result) && $data_result[0]->id != $id) {
			// $this->addWarningMessage('Record already exists with Consignee Name and Location. Can not add duplicate entry.');
			// $this->redirectToParent();
			$sucess = 0;
			$msg = 'Record already exists with Consignee Name and Location. Can not add duplicate entry.';
		} else {

			$address_data = array(
				"address" => $address,
				"location" => $location,
				"state" => $state,
				"state_no" => $state_no,
				"pin_code" => $pin_code,
				"updated_user" => $this->user_name
			);

			$result = $this->Crud->update_data("address_master", $address_data, $address_id);
			if ($result) {
				$consignee_data = array(
					"consignee_name" => $consignee_name,
					"location" => $location,
					"pan_no" => $pan_no,
					"phone_no" => $phone_no,
					"gst_number" => $gst_number,
					"distncFrmClnt1"=> $distance1,
						    "distncFrmClnt2"=> $distance2,
						    "distncFrmClnt3"=> $distance3,
					"created_dttm" => $this->current_dttm,
					"updated_user" => $this->user_name,
				);

				$result = $this->Crud->update_data("consignee", $consignee_data, $id);
				if ($result) {
					// $this->addSuccessMessage('Consignee updated successfully.');
					$sucess = 1;
					$msg = 'Consignee updated successfully.';
				} else {
					// $this->addErrorMessage('Failed to update. Please try again.');
					$sucess = 0;
					$msg = 'Failed to update. Please try again.';
				}
			} else {
				// $this->addErrorMessage('Failed to update. Please try again.');
				$sucess = 0;
				$msg = 'Failed to update. Please try again.';
			}
			// $this->redirectToParent();
			
			
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['sucess'] = $sucess;
		echo json_encode($ret_arr);
	}

	// ------------------------ Country Master ------------------------ 

public function country()
	{
		checkGroupAccess("country","list","Yes");
		$data['country_list'] = $this->Crud->read_data_acc("country_master");
		// $this->load->view('header');
		$this->loadView('admin/country', $data);
		// $this->load->view('footer');
		
	}
public function addCountry(){
	// pr($_POST,1);
	$name = trim($this->input->post('name'));

		$data = array(
			"name" => $name,
			
		);

		$check = $this->Crud->read_data_where("country_master", $data);
		if ($check != 0) {
			$msg = 'Record already exists.';
				$success = 0;
			// $this->addWarningMessage('Record already exists.');
			// $this->redirectToParent();
		} else {
			$data = array(
				"name" => $name,
				"created_on" => date("Y-m-d H:i:s"),
				"created_by" => $this->user_id,
			
			);
			$result = $this->Crud->insert_data("country_master", $data);
			if ($result) {
				$msg = 'Country added successfully.';
				$success = 1;
			} else {
				// $this->addErrorMessage('Failed to add client');
				$msg = 'Failed to add or similar data exists.';
				$success = 0;
			}
		}
		$ret_arr['msg'] = $msg;
			$ret_arr['success'] = $success;
			echo json_encode($ret_arr);
			exit();

}
public function updateCountry()
	{
	
		$name = trim($this->input->post('name'));
		$id = trim($this->input->post('id'));

		$data = array(
				"name" => $name,
				"updated_by" => $this->user_id,
				"updated_on" => date("Y-m-d H:i:s"),
				
			);
			
			$result = $this->Crud->update_data("country_master", $data, $id);
			if ($result) {
				// $this->addSuccessMessage('Client updated');
				$msg = 'Country updated successfully.';
				$success = 1;
			} else {
				// $this->addErrorMessage('Failed to update or similar data exists.');
				$msg = 'Failed to update or similar data exists.';
				$success = 0;
			}
			// $this->redirectToParent();
			$ret_arr['msg'] = $msg;
			$ret_arr['success'] = $success;
			echo json_encode($ret_arr);
			exit();
		
	}

	// ------------------------ Port Master ------------------------ 
	public function port()
	{
		checkGroupAccess("port","list","Yes");
		$data['port_list'] = $this->Crud->read_data_acc("port_master");
		// $this->load->view('header');
		$this->loadView('admin/port', $data);
		// $this->load->view('footer');
		
	}
public function addPort(){
	
	$name = trim($this->input->post('name'));

		$data = array(
			"name" => $name,
			
		);

		$check = $this->Crud->read_data_where("port_master", $data);
		if ($check != 0) {
			$msg = 'Record already exists.';
				$success = 0;
			
		} else {
			$data = array(
				"name" => $name,
				"created_on" => date("Y-m-d H:i:s"),
				"created_by" => $this->user_id,
			
			);
			$result = $this->Crud->insert_data("port_master", $data);
			if ($result) {
				$msg = 'Port added successfully.';
				$success = 1;
			} else {
				
				$msg = 'Failed to add or similar data exists.';
				$success = 0;
			}
		}
		$ret_arr['msg'] = $msg;
			$ret_arr['success'] = $success;
			
			echo json_encode($ret_arr);
			exit();

}
public function updatePort()
	{
	
		$name = trim($this->input->post('name'));
		$id = trim($this->input->post('id'));

		$data = array(
				"name" => $name,
				"updated_by" => $this->user_id,
				"updated_on" => date("Y-m-d H:i:s"),
				
			);
			
			$result = $this->Crud->update_data("port_master", $data, $id);
			if ($result) {
				
				$msg = 'Port updated successfully.';
				$success = 1;
			} else {
				
				$msg = 'Failed to update or similar data exists.';
				$success = 0;
			}
			
			$ret_arr['msg'] = $msg;
			$ret_arr['success'] = $success;
			echo json_encode($ret_arr);
			exit();
		
	}

	// ------------------------ currency Master ------------------------ 
	public function currency()
	{
		checkGroupAccess("currency","list","Yes");
		$data['currency_list'] = $this->Crud->read_data_acc("currency_master");
		// $this->load->view('header');
		$this->loadView('admin/currency', $data);
		// $this->load->view('footer');
		
	}
	public function addCurrency(){
		
		$name = trim($this->input->post('name'));

			$data = array(
				"name" => $name,
				
			);

			$check = $this->Crud->read_data_where("currency_master", $data);
			if ($check != 0) {
				$msg = 'Record already exists.';
					$success = 0;
				
			} else {
				$data = array(
					"name" => $name,
					"created_on" => date("Y-m-d H:i:s"),
					"created_by" => $this->user_id,
				
				);
				$result = $this->Crud->insert_data("currency_master", $data);
				if ($result) {
					$msg = 'Currency added successfully.';
					$success = 1;
				} else {
					
					$msg = 'Failed to add or similar data exists.';
					$success = 0;
				}
			}
			$ret_arr['msg'] = $msg;
				$ret_arr['success'] = $success;
				
				echo json_encode($ret_arr);
				exit();

	}
	public function updateCurrency()
		{
		
			$name = trim($this->input->post('name'));
			$id = trim($this->input->post('id'));

			$data = array(
					"name" => $name,
					"updated_by" => $this->user_id,
					"updated_on" => date("Y-m-d H:i:s"),
					
				);
				
				$result = $this->Crud->update_data("currency_master", $data, $id);
				if ($result) {
					
					$msg = 'Currency updated successfully.';
					$success = 1;
				} else {
					
					$msg = 'Failed to update or similar data exists.';
					$success = 0;
				}
				
				$ret_arr['msg'] = $msg;
				$ret_arr['success'] = $success;
				echo json_encode($ret_arr);
				exit();
			
		}
	    
	    
}