<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class LogonDashboard extends CommonController
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Kolkata');

		// $this->current_date = date('Y-m-d');
		// $this->current_time = date('h:i:s');

		$this->user_name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
		$this->current_date = date('d-m-Y');
		$this->current_time = date('h:i:s');

		$date = new DateTime($this->current_date);

		$date->modify('-1 day');
		$this->yesterday_date = $date->format('d-m-Y');
		$this->yesterday_date_new = $date->format('Y-m-d');
		$d = date_parse_from_format("d-m-Y", $this->current_date);
		$this->date = $d["day"];
		$this->month = $d["month"];
		$this->year = $d["year"];
		$this->load->model('SupplierParts');	
		$this->load->model('CustomerPart');
		$this->load->model('GlobalConfigModel');
	}
	
	private function getPage($viewPage,$viewData){
        //$this->loadView($this->getPath().$viewPage,$viewData);
		$this->loadView($viewPage,$viewData);
	}

	public function login()
	{
		unset($_SESSION["userdata"]);
		session_destroy();
		$data['client_list'] = $this->Crud->read_data_acc("client");
		$data['isMultipleClientUnits'] = $this->isMultiClientSupport();
		// $this->load->view('login', $data);
		$this->loadView('login', $data,"No","No");
	}
	
	public function logout()
	{

		$user_data = array(
			'user_id' => '',
			'user_email' => '',
			'user_login' => '',
			'user_name' => '',
			'AROMCustomerType' => '',
			'entitlements' => '',
			'type' => '',
			'role' => '',
			'isMultipleClientUnits' => '',
			'noOfClients' => ''
		);
		$this->session->set_userdata($user_data);
		unset($_SESSION["userdata"]);
		session_destroy();
		redirect('login');
	}

	public function signin()
	{
		// pr($_POST,1);
		// $data['userInfo'] = $this->Crud->read_data("userInfo");
		$this->form_validation->set_rules('email', ' Email', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', ' Password', 'trim|required|min_length[3]');

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$clientUnit = $this->input->post('clientUnit');
		$arr = array(
			'user_email' => $email,
			'user_password' => $password
		);
		$result = $this->Crud->get_data_by_id_multiple("userinfo", $arr);
		$redirect_url = "";
		if (empty($result)) {
			$success = 0;
			$messages = "Email and Password Invalid.";
		} else {
			$goups = explode(",",$result[0]->unit_ids);
			//End clear the session values
			$session_keys = array('user_id', 'user_email', 'user_login','user_name','AROMCustomerType','entitlements','type','role','isMultipleClientUnits','noOfClients','groups');
			$this->session->unset_userdata($user_data);
			if(!in_array($clientUnit, $goups)){
				$success = 0;
				$messages = "You are not authorized to access this unit.";
			}else if ($result) {
				$entitlements = $this->getEntitlements();
				$user_data = array(
					'user_id' => $result[0]->id,
					'user_email' => $result[0]->user_email,
					'user_login' => true,
					'user_name' => $result[0]->user_name,
					'type' => $result[0]->type,
					'role' => $result[0]->user_role,
					'groups' => $result[0]->groups
					//	'businessType' => 'SMALL'
				);
				$this->session->set_userdata($user_data);
				$this->session->set_userdata('entitlements',$entitlements);
				
				if(empty($clientUnit)){
					$clientUnit = 1;
				}

				$group_rights = $this->GlobalConfigModel->getGroupRightData($result[0]->groups,"");
				$this->session->set_userdata('group_rights_arr', base64_encode(json_encode($group_rights)));
				$this->session->set_userdata('clientUnit', $clientUnit);
				$clientDetails = $this->getClientUnitDetails($clientUnit);
				$this->session->set_userdata('clientUnitName', $clientDetails[0]->client_unit); //set the clientUnit to session..
				$this->session->set_userdata('isMultipleClientUnits',$this->isMultiClientSupport()); //Update client unit for session.
				$this->session->set_userdata('noOfClients',$this->getNoOfClients()); //Total no of client in DB
				$this->session->set_userdata('AROMCustomerType', $this->getAROMCustomerName());
				$this->session->set_flashdata('login', 'success');
				if(checkGroupAccess("dashboard","list","No")){
					$redirect_url = "dashboard";
				}else{
					$redirect_url = "sitemap";
				}
				// redirect('index');
				// pr($this->session->userdata,1);
				$success = 1;
				$messages = "User Login successfully";
			}
		}
		$return_arr['redirect_url']=$redirect_url;
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
	}

	public function index(){
		$clientUnit = $this->session->userdata['clientUnit'];
		
		$data['total_sales_value_today'] = $this->Crud->customQuery('SELECT SUM(ROUND(parts.total_rate,2)) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND clientid = '.$clientUnit. ' AND parts.created_date = "' . $this->current_date . '" ');
		$data['total_sales_value_yesterday'] = $this->Crud->customQuery('SELECT SUM(ROUND(parts.total_rate,2)) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND clientid = '.$clientUnit. ' AND parts.created_date = "' . $this->yesterday_date . '" ');
		$data['total_sales_value_month'] = $this->Crud->customQuery('SELECT SUM(ROUND(parts.total_rate,2)) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND clientid = '.$clientUnit. ' AND parts.created_month = ' . $this->month . ' AND parts.created_year = ' . $this->year);

		$this->getPage('index', $data);
	}

	public function dashboard()
	{
		
		$total_value = 0;
		$child_part_info = $this->SupplierParts->readSupplierParts();
		if ($child_part_info) {
			foreach ($child_part_info as $child_part) {
				if (!$child_part->stock || $child_part->stock == 0 || !$child_part->store_stock_rate) {
					continue;
				}
				$total_value += ($child_part->stock) * ($child_part->store_stock_rate);
			}
		}
		$data['total_value'] = $total_value;

		$isMultipleClientUnits = $this->session->userdata['isMultipleClientUnits'];
		if($isMultipleClientUnits == "true") {
				$total_value_unit2 = 0;
				$child_part_info2 = $this->SupplierParts->readSupplierParts();
				if ($child_part_info2) {
					foreach ($child_part_info2 as $child_part) {
						if (!$child_part->stock2 || $child_part->stock2 == 0 || !$child_part->store_stock_rate) {
							continue;
						}
						$total_value_unit2 += ($child_part->stock2) * ($child_part->store_stock_rate);
					}
				}
				$data['total_value_unit2'] = $total_value_unit2;
		}

		$total_value_fg = 0;
		$customer_parts_master = $this->CustomerPart->readCustomerParts();
		if ($customer_parts_master) {
			foreach ($customer_parts_master as $part) {
					$rate = $part->fg_rate;
					$total_value_fg += ($part->fg_stock) * ($rate);
				}
			}
		$data['total_value_fg'] = $total_value_fg;
		$data['yesterday_date'] = $this->yesterday_date_new;

		$clientUnit = $this->session->userdata['clientUnit'];
		
		$data['grn_value_month'] = $this->Crud->customQuery('SELECT SUM(verfified_price) as MAINSUM FROM `grn_details` WHERE created_month = '  . $this->month . ' AND created_year = ' . $this->year . '   ');
		$data['total_sales_value_yesterday'] = $this->Crud->customQuery('SELECT SUM(ROUND(parts.total_rate,2)) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND clientid = '.$clientUnit. ' AND parts.created_date = "' . $this->yesterday_date . '" ');
		$data['total_sales_value_month'] = $this->Crud->customQuery('SELECT SUM(ROUND(parts.total_rate,2)) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND clientid = '.$clientUnit. ' AND parts.created_month = ' . $this->month . ' AND parts.created_year = ' . $this->year);

		// customer PPM Last Month block
			$current_date = date('d-m-Y');
			$d = date_parse_from_format("d-m-Y", $current_date);
	        $date = $d["day"];
	        $month = $d["month"];
	        $year = $d["year"];
	        if ($month == 1) {
	        	$last_month = 12;
	            $year = $year - 1;
	        } else {
	        	$last_month = $month - 1;
	        }
        	$current_year = $year;
            $rejection_sum_qty_data_month = $this->Crud->customQuery('SELECT SUM(accepted_qty) as rejection_sum FROM `parts_rejection_sales_invoice` WHERE  created_month = ' . $last_month . ' AND created_year = '.$current_year);
                                    //$rejection_sum_qty_data_month  = $child_part_list_month->result();
            $rejection_qty = 0;
            if ($rejection_sum_qty) {
            	$rejection_qty = $rejection_sum_qty[0]->rejection_sum;
			}
            $sales_sum_data = $this->Crud->customQuery('SELECT SUM(qty) as sales_sum FROM `sales_parts` WHERE  created_month = ' . $last_month . ' AND created_year = '.$current_year);
                                    //$sales_sum_data  = $child_part_list_monthsales_sum->result();
                $sales_sum = 0;
			if ($sales_sum_data) {
                $sales_sum = $sales_sum_data[0]->sales_sum;
			}
			if ($sales_sum != 0) {
                $last_monnth_ppl = ($rejection_qty / $sales_sum) * 1000000;
			} else {
            	$last_monnth_ppl = 0;
            }
        $data['customer_ppm_last_month'] = $last_monnth_ppl;

        // Subcon challan stock value block
        	$main_value_qty=0;
			$challan_parts = $this->Crud->customQuery('SELECT * FROM challan_parts');
                                    //$challan_parts = $role_management_data->result();
            if ($challan_parts) {
            	foreach ($challan_parts as $c) {
                	$challan_data = $this->Crud->get_data_by_id("challan", $c->challan_id, "id");	
                		$supplier_id = $challan_data[0]->supplier_id;
                        $array_main = array(
                        				"supplier_id" => $supplier_id,
                                        "child_part_id" => $c->part_id,
                                        );
                       	$value_qty = 0;
                       	$value_qty_remaning = 0;
                        $child_part_master_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array_main);
                        if ($child_part_master_data) {
                        	$value_qty = $c->qty * $child_part_master_data[0]->part_rate;
                            $value_qty_remaning = $c->remaning_qty * $child_part_master_data[0]->part_rate;
                        }
                        $main_value_qty = $main_value_qty + $value_qty;
                    }
            }
        $data['subcon_challan_stock'] = number_format($main_value_qty,2);

        // Customer PPM FY Block
			$current_date = date('d-m-Y');
            $d = date_parse_from_format("d-m-Y", $current_date);
            $date = $d["day"];
            $month = $d["month"];
            $year = $d["year"];
            if ($month == 1) {
             	$last_month = 12;
                $year = $year - 1;
            } else {
            	$last_month = $month - 1;
           	}
            $current_year = $year;
            $rejection_sum_qty_data_month = $this->Crud->customQuery('SELECT SUM(accepted_qty) as rejection_sum FROM `parts_rejection_sales_invoice` WHERE  created_year = ' . $year . '');
            // echo 'SELECT SUM(qty) as rejection_sum FROM `new_sales_rejection` WHERE  created_year = ' . $year . '';
            //$rejection_sum_qty_data_month  = $child_part_list_month->result();
            $rejection_qty = 0;
            if ($rejection_sum_qty_data_month) {
            	$rejection_qty = $rejection_sum_qty_data_month[0]->rejection_sum;
            }
            $sales_sum_data = $this->Crud->customQuery('SELECT SUM(qty) as sales_sum FROM `sales_parts` WHERE  created_year = ' . $year . '');
            //$sales_sum_data  = $child_part_list_monthsales_sum->result();
            $sales_sum = 0;
			if ($sales_sum_data) {
            	$sales_sum = $sales_sum_data[0]->sales_sum;
            }
            if ($sales_sum != 0) {
            	$last_monnth_ppl = ($rejection_qty / $sales_sum) * 1000000;
           	} else {
            	$last_monnth_ppl = 0;
            }
        $data['customer_ppm_fy'] = number_format($last_monnth_ppl,2);

        // Receivable Due Amount block
        $sales_parts = $this->Crud->customQuery('SELECT *, SUM(gst_amount) as gst, SUM(total_rate) as ttlrt, SUM(gst_amount) as gstamnt, SUM(tcs_amount) as tcsamnt FROM `sales_parts` GROUP BY sales_number ORDER BY id DESC');
		//$sales_parts = $role_management_data->result();
		// $total_subtotal = 0; // Initialize total subtotal variable
        $total_amntreceivetotal = 0; // Initialize total subtotal variable
       	foreach ($sales_parts as $po) {
        	$customer_data = $this->Crud->get_data_by_id("customer", $po->customer_id, "id");
            $receivable_report_data = $this->Crud->get_data_by_id("receivable_report", $po->sales_number, "sales_number");
            $new_sale_data = $this->Crud->get_data_by_id("new_sales", $po->sales_id, "id");
            // Your existing code
            // $subtotal = round($po->ttlrt - $po->gstamnt, 2);
            // $subtotal = round($po->ttlrt - $po->gstamnt, 2);
            $subtotal = $row_total - $receivable_report_data[0]->amount_received;
            // Accumulate subtotals to get the total
            $total_amntreceivetotal += $subtotal;
		}

		$data['total_amntreceivetotal'] = $total_amntreceivetotal >0 ? number_format($total_amntreceivetotal,2) : 0;

		// Total Amount with GST Block
		$sales_parts = $this->Crud->customQuery('SELECT *, SUM(gst_amount) as gst, SUM(total_rate) as ttlrt, SUM(gst_amount) as gstamnt, SUM(tcs_amount) as tcsamnt FROM `sales_parts` GROUP BY sales_number ORDER BY id DESC');
		//$sales_parts = $role_management_data->result();
        $total_gsttotal = 0; // Initialize total subtotal variable
        foreach ($sales_parts as $po) {
        	// Your existing code
            $subgsttotal = round($po->ttlrt,2) + round($po->tcsamnt,2);
            // Accumulate subtotals to get the total
            $total_gsttotal += $subgsttotal;
        }
        $data['total_gsttotal'] = $total_gsttotal >0 ? number_format($total_gsttotal,2) : 0;


        $shifts = $this->Crud->read_data_acc("shifts");
        $data['shifts'] = $shifts;
       
                                    
		$this->getPage('dashboard', $data);
	}
	
	public function home_2()
	{
		$selected_year  = strtotime($this->input->post("selected_year"));
		if (empty($selected_year)) {
			$selected_year = $this->year;
		}
	
		$data['selected_year']  = $selected_year;

		$this->getPage('chart', $data);
	}

	public function sitemap(){
		$data['sitemap'] = true;
		$this->loadView('admin/sitemap', $data,"Yes","Yes");
	}
	public function phpinfo(){
		$get_data = $this->uri->segment(2);
		if($get_data == "AROM949296"){
			echo phpinfo();
		}else{
			echo "sorry!";
		}		
	}
}