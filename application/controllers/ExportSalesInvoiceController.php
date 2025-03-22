<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');
require_once APPPATH . 'libraries/Pdf1.php';
class ExportSalesInvoiceController extends CommonController {

	function _construct()
    {
        parent::_construct();
        $this->load->model('CustomerPart');
		$this->load->model('SalesModel');
		$this->load->model("ExportSalesInvoiceModel");
		
    }
    public function new_sales($reused_sales_no=null)
	{
		checkGroupAccess("export_invoice_released","add","Yes");
		if(!empty($reused_sales_no)){
			$data['reused_sales_no'] = $reused_sales_no;
		}else{
			$data['reused_sales_no'] = $this->input->post('reused_sales_no');
		}

		$data['id'] = $this->uri->segment('2');
		// $data['customer'] = $this->Crud->read_data("customer");
		$customer = $this->db->query("
			SELECT *
			from customer 
			WHERE  customerType = 'Expoter'");
		$data['customer'] = $customer->result();
		$data['transporter'] = $this->Crud->read_data("transporter");
		$data['country_master'] = $this->Crud->read_data("country_master");
		$data['currency_master'] = $this->Crud->read_data("currency_master");
		$data['port_master'] = $this->Crud->read_data("port_master");

		$data['distanceCol'] = $this->Unit->getClientToCustomerDistanceTbColName();
		$data['consignee_list'] = $this->Crud->read_data_acc("consignee");
		// pr($data,1);
		$this->loadView('sales/new_export_sales', $data);
	}

	public function generate_new_export_sales()
	{
		
		$post_data = $this->input->post();
		
	
		$cretd_dt = date('Y/m/d');
		$customer_data = $this->Crud->get_data_by_id("customer", $customer_id, "id");
		$clientUnit = $this->Unit->getSessionClientId();
		

		if(date("m") < 4){
       		$start_year = substr(date("Y", strtotime("-1 year")), -2);
       		$start_year_val = date("Y", strtotime("-1 year"));
        	$end_year = substr(date("Y"), -2);
        	$end_year_val = date("Y");
       	}else{
       		$start_year = substr(date("Y"), -2);
       		$start_year_val = date("Y");
        	$end_year = substr(date("Y", strtotime("+1 year")), -2);
        	$end_year_val = date("Y", strtotime("+1 year"));
       	}
       	$role_management_data = $this->db->query('
			SELECT COUNT(cpt.id) as total_record
			FROM `export_sales` as cpt
			WHERE ((cpt.created_year = '.$start_year_val.' AND cpt.created_month >= 5) OR (cpt.created_year = '.$end_year_val.' AND cpt.created_month <= 4)) AND cpt.sales_number LIKE "TEMP%"
			ORDER BY `id` DESC
		');
		$export_sales = $role_management_data->result();
		
		$total_records = $export_sales[0]->total_record+1;
		$sales_num = "TEMP/".$start_year."-".$end_year."/".$total_records;
		// pr($clientUnit,1);
		$data = array(
			"clientId" => $clientUnit,
			"sales_number" => $sales_num,
			"customer_id" => $post_data['customer_id'],
			"consignee_id" => $post_data['consignee'],
			"shipping_addressType" => $post_data['ship_addressType'],
			"remark" => $post_data['remark'],
			"note" => $post_data['note'],
			"currency" => $post_data['currency'],
			"country_of_origin" => $post_data['country_of_origin'],
			"port_of_loading" => $post_data['port_of_loadinga'],
			"country_of_discharge" => $post_data['country_of_discharge'],
			"port_of_discharge" => $post_data['port_of_discharge'],
			"country_of_destination" => $post_data['country_of_destination'],
			"final_destination" => $post_data['final_destination'],
			"place_receipt_by_precarrier"=>$post_data['place_receipt_by_precarrier'],
			"precarriage_by" => $post_data['precarriage_by'],
			"container_no" => $post_data['container_no'],
			"checked_in" => $post_data['checked_in'],
			"packed_in" => $post_data['packed_in'],
			"total_boxes" => $post_data['total_boxes'],
			"transporter" => $post_data['transporter'],
			"net_weight" => $post_data['net_weight'],
			"gross_weight" => $post_data['gross_weight'],
			"created_by" => $this->user_id,
			"created_date" => $cretd_dt,
			"created_time" => $this->current_time,
			"created_by" => $this->current_date,
			"created_day" => $this->date,
			"created_month" => $this->month,
			"created_year" => $this->year
		);

		$result = $this->Crud->insert_data("export_sales", $data);
		if ($result) {
			$new_sales_id = $result;
		}

		if ($new_sales_id) {
			// $this->addSuccessMessage('Sales invoice created.');
			// $this->redirectMessage('view_new_sales_by_id/' . $result);
			$ret_arr['url'] = 'view_export_sales_by_id/' . $new_sales_id;
			$ret_arr['sucess'] = 1;
		} else {
			$ret_arr['sucess'] = 0;
		}
		echo json_encode($ret_arr);
	}
	public function update_export_invoice_update()
	{
		
		$post_data = $this->input->post();
		$data = array(
			"remark" => $post_data['remark'],
			"note" => $post_data['note'],
			"currency" => $post_data['currency'],
			"country_of_origin" => $post_data['country_of_origin'],
			"port_of_loading" => $post_data['port_of_loadinga'],
			"country_of_discharge" => $post_data['country_of_discharge'],
			"port_of_discharge" => $post_data['port_of_discharge'],
			"country_of_destination" => $post_data['country_of_destination'],
			"final_destination" => $post_data['final_destination'],
			"precarriage_by" => $post_data['precarriage_by'],
			"container_no" => $post_data['container_no'],
			"checked_in" => $post_data['checked_in'],
			"packed_in" => $post_data['packed_in'],
			"total_boxes" => $post_data['total_boxes'],
			"transporter" => $post_data['transporter'],
			"net_weight" => $post_data['net_weight'],
			"gross_weight" => $post_data['gross_weight'],
		);


		$update_result = $this->Crud->update_data("export_sales", $data, $post_data['sales_id']);
		if ($update_result) {
			$success = 1;
			$messages = "Successfully added.";
		} else {
			$success = 0;
			$messages = "Something went wrong.";
		}
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;

	}
	public function sales_invoice_released()
	{
		
	    checkGroupAccess("export_invoice_released","list","Yes");
		$created_month = $this->input->post('created_month');
		$created_year = $this->input->post('created_year');

		if (empty($created_month)) {
			$created_month = $this->month;
		}

		if (empty($created_year)) {
			$created_year = $this->year;
		}

		$data['customer_part'] = $this->Crud->read_data("customer_part");

		$sql = "SELECT cus.customer_name,es.*  FROM export_sales as es 
		left join customer cus on es.customer_id = cus.id
		WHERE es.clientId = ".$this->Unit->getSessionClientId()." AND es.created_month = " . $created_month . " AND es.created_year = " . $created_year . " order by es.id desc";
		$data['new_sales']  = $this->Crud->customQuery($sql);
		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;
		
		// $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
		// $data['customer_part_list'] = $role_management_data->result();

		

		
		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
		$this->loadView('sales/export_sales_invoices', $data);
	}
	public function cancel_sale_invoice()
	{

		$sales_id = $this->input->post('sales_id');
		$sales_number = $this->input->post('sales_number');
		$status = $this->input->post('status');

		$sales_part_data = array(
			"basic_total" => 0,
			"total_rate" => 0,
			"cgst_amount" => 0,
			"sgst_amount" => 0,
			"igst_amount" => 0,
			"tcs_amount" => 0,
			"gst_amount" => 0
			
		);

		$cancel_parts = $this->Crud->update_data_column("export_sales_parts", $sales_part_data, $sales_id,"sales_id");
		$messages = "Something went wrong.";
		$success = 0;
		if($cancel_parts){
			$cancel_data = array(
				"status" => 'Cancelled',
				"total_sales_amount" => 0,
				"total_gst_amount" => 0
			);

			$result = $this->Crud->update_data("export_sales", $cancel_data, $sales_id);
			//check if transaction status TRUE or FALSE
			if ($result) {
				if ($status == 'lock') {
					$success = 1;
					$messages = 'Sales invoice ' . $sales_number . ' cancelled. <br> Note: Please update FG Stock manually.';
					// $this->addSuccessMessage('Sales invoice ' . $sales_number . ' cancelled. <br> Note: Please update FG Stock manually.');
				} else {
					$success = 1;
					$messages = 'Sales invoice ' . $sales_number . ' cancelled.';
					// $this->addSuccessMessage('Sales invoice ' . $sales_number . ' cancelled.');
				}
			} else {
				$messages = 'Failed to cancel Sales invoice ' . $sales_number;
				// $this->addErrorMessage('Failed to cancel Sales invoice ' . $sales_number);
			}
		} else {
			$messages = 'Failed to cancel Sales invoice ' . $sales_number;
			// $this->addErrorMessage('Failed to cancel Sales invoice ' . $sales_number);
		}	
		// $this->redirectMessage('sales_invoice_released');
		$ret_arr['messages'] = $messages;
		$ret_arr['success'] = $success;
		$ret_arr['redirect_url'] = base_url("sales_invoice_released");
		
		echo json_encode($ret_arr);
		exit();
	}


	/*
		Delete sales invoice which are pending only
	*/
	public function delete_sale_invoice()
	{
		
		$sales_id = $this->input->post('sales_id');
		$status = $this->input->post('status');

		$sales_part_data = array(
			"sales_id" => $sales_id,
		);

		$data = array(
			"id" => $sales_id,
			"status" => 'pending'
		);
		$messages = "Something went wrong!.";
		$success =0;
		//transaction management - as of now not working
		$this->db->trans_start();
		$result = $this->Crud->delete_data("export_sales_parts", $sales_part_data);
		$result = $this->Crud->delete_data("export_sales", $data);
		$this->db->trans_complete();

		//check if transaction status TRUE or FALSE
		if ($this->db->trans_status() === FALSE) {
			//if something went wrong, rollback everything
			$this->db->trans_rollback();
			$messages = 'Failed to delete Sales invoice ' . $sales_number;
			// $this->addErrorMessage('Failed to delete Sales invoice ' . $sales_number);
			// $this->redirectMessage('sales_invoice_released');
		} else {
			//if everything went right, commit the data to the database
			$this->db->trans_commit();
			$messages = 'Sales invoice ' . $sales_number . ' deleted.';
			$success = 1;
			// $this->addSuccessMessage('Sales invoice ' . $sales_number . ' deleted.');
			// $this->redirectMessage('sales_invoice_released');
		}
		$ret_arr['messages'] = $messages;
		$ret_arr['success'] = $success;
		$ret_arr['redirect_url'] = base_url("export_sales_invoice_released");
		
		echo json_encode($ret_arr);
	}
	public function view_export_sales_by_id()
	{
		$sales_id = $this->uri->segment('2');
		$data['uri_segment_2'] = $sales_id;
		$data['new_sales'] = $this->Crud->get_data_by_id("export_sales", $sales_id, "id");
		
		$data['customer'] = $customer = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		$data['customer_part_details'] = $this->Crud->get_data_by_id("customer_part", $data['new_sales'][0]->customer_part_id, "id");
		$data['session_type'] = $this->session->userdata['type'];
		//$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		//$data['uom'] = $this->Crud->read_data("uom");
		$data['customer_tracking'] = $this->Crud->customQuery('SELECT DISTINCT po.* FROM customer_po_tracking as po, 
		parts_customer_trackings as po_parts 
		WHERE po.po_end_date >= CURDATE() AND po.status = "pending" AND po.customer_id =' . $data['new_sales'][0]->customer_id . '
		 AND po.id = po_parts.customer_po_tracking_id');

		
		$data['po_parts'] = $this->Crud->get_data_by_id("export_sales_parts", $sales_id, "sales_id");
		
		$data['child_part'] = $this->Crud->get_data_by_id("customer_part", $data['new_sales'][0]->customer_id, "customer_id");
		$data['transporter'] = $transporter= $this->Crud->read_data("transporter");
		foreach ($transporter as $key => $value) {
			$data['transporter_key_wise'][$value->id] = $value->name."-".$value->transporter_id;
		}
		
		
		$data['country_master'] = $country_master = $this->Crud->read_data("country_master");
		$data['country_key_wise'] = array_column($country_master, "name" ,"id");
		$data['currency_master'] = $currency_master = $this->Crud->read_data("currency_master");
		$data['currency_key_wise'] = array_column($currency_master, "name" ,"id");
		$data['port_master'] = $port_master = $this->Crud->read_data("port_master");
		$data['port_key_wise'] = array_column($port_master, "name" ,"id");

		
		foreach ($data['po_parts']  as $p) {
			$data['child_part_data'][$p->part_id] = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
			$data['gst_structure2'][$p->part_id] = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
		}
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration", $criteria);
		$data['configuration'] = array_column($configuration, "config_value", "config_name");
		
		// pr($data,1);
		$this->load->model("ExportSalesInvoiceModel");
		$data['export_packing_slip'] = $this->ExportSalesInvoiceModel->exportPackingSlip($sales_id);
		$this->loadView('sales/view_export_sales_by_id', $data);
	}
	public function add_export_sales_parts()
	{
		$customer_id = $this->input->post('customer_id');
		$po_id = $this->input->post('po_id');
		$sales_id = $this->input->post('sales_id');
		$po_number = $this->input->post('po_number');
		$part_id = $this->input->post('part_id');
		$sales_number = $this->input->post('sales_number');
		$qty = $this->input->post('qty');
		$discountType = $this->input->post('discountType');
		$discount = $this->input->post('discount');
		$salesdata = $this->db->query('SELECT * FROM `export_sales_parts` where sales_id = ' . $sales_id . ' ');
		$salesdata_result = $salesdata->result();
		$added_saled_count = count($salesdata_result);
		$ret_arr = [];
		$sucess = 0;
		$msg = "Something went wrong";
		if ($added_saled_count == '7') {
			$msg = "Already 7 Parts Added.";
			// echo "<script>alert('Already 7 Parts Added.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$config_data = $this->Crud->read_data("global_configuration");
		$config_data = array_column($config_data,"config_value","config_name");
		// if(isset($config_data['salesPdfSetup'])){
		// 	if($config_data['salesPdfSetup'] == "Single" && $added_saled_count >= 5){
		// 		$msg = "Already 5 Parts Added.";
		// 		$ret_arr['msg'] = $msg;
		// 		$ret_arr['sucess'] = $sucess;
		// 		echo json_encode($ret_arr);
		// 		exit();
		// 	}
		// }
		// pr($config_data,1);
		
		$data = array(
			"part_id" => $part_id,
			"sales_number" => $sales_number,
		);
		$check = $this->Crud->read_data_where("export_sales_parts", $data);
		if ($check) {
				$msg = "Part Already Exists To This Invoice Number , Enter Different Part";
				// $this->addErrorMessage("Part Already Exists To This Invoice Number , Enter Different Part");
				// $this->redirectMessage();
				// exit();
			} else {
			
			$customer_part = $this->Crud->get_data_by_id("customer_part", $part_id, "id");
			// if($added_saled_count > 0){
			// 	$tax_val = $salesdata_result[0]->tax_id;
			// 	if($customer_part[0]->gst_id != $tax_val){
			// 		$msg = "Part tax structure should be same.";
			// 		$sucess = 0;
			// 		$ret_arr['msg'] = $msg;
			// 		$ret_arr['sucess'] = $sucess;
					
			// 		echo json_encode($ret_arr);
			// 		exit();
			// 	}
			// 	// pr($tax_val,1);
			// }
			$customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($customer_part[0]->part_number);
			$job_card_data = $this->Crud->get_data_by_id("job_card", $part_id, "customer_part_id");

			
			/**
			 * PO Balance qty should be more than requested qty to be added.
			 */
			$po_part_criteria = array(
				'customer_po_tracking_id' => $po_id,
				'part_id' => $part_id
			);

			$po_part_details = $this->Crud->get_data_by_id_multiple_condition("parts_customer_trackings", $po_part_criteria);
			// pr($po_part_criteria,1);
			$customer_po_tracking_data = $this->Crud->get_data_by_id("customer_po_tracking", $po_id, "id");
			$role_management_data = $this->db->query("SELECT SUM(parts.qty) AS MAINSUM from `export_sales_parts`as parts , 
				export_sales as sales WHERE  parts.part_id = ".$part_id." 
				AND parts.po_number = '".$customer_po_tracking_data[0]->po_number."' 
				AND parts.sales_id = sales.id");
			$used_qty = $role_management_data->row();
			$used_qty = $used_qty->MAINSUM > 0 ? $used_qty->MAINSUM  : 0;
			$role_management_data = $this->db->query("SELECT SUM(parts.qty) AS MAINSUM from `sales_parts`as parts , 
				new_sales as sales WHERE  parts.part_id = ".$part_id." 
				AND parts.po_number = '".$customer_po_tracking_data[0]->po_number."' 
				AND parts.sales_id = sales.id");
			$used_sales_qty = $role_management_data->row();
			$used_sales_qty = $used_sales_qty->MAINSUM > 0 ? $used_sales_qty->MAINSUM  : 0;
			$total_available_qty = $po_part_details[0]->qty - ($used_qty + $used_sales_qty);
			$falg = 0;
			if ($qty > $total_available_qty) {
				$msg = "Insufficient Sales Order balance qty. Sales Order balance qty is " . $total_available_qty;
				// $this->addErrorMessage("Insufficient PO Part balance qty. PO Part balance qty is " . $po_part_details[0]->qty);
				// $this->redirectMessage();
				// exit();
				$falg = 1;
			}

			if($falg == 0){
				// $prod_qty_new = 0;
				// if ($job_card_data) {
				// 	foreach ($job_card_data as $j) {
				// 		$job_card_prod_qty_ = $this->db->query('SELECT DISTINCT operation_id FROM `job_card_prod_qty` where job_card_id = ' . $j->id . ' ORDER BY operation_id ASC ');
				// 		$job_card_prod_qty_data = $job_card_prod_qty_->result();
				// 		if ($job_card_prod_qty_data) {
				// 			$array_count = count($job_card_prod_qty_data);

				// 			$operation_id_prod = $job_card_prod_qty_data[$array_count - 1]->operation_id;
				// 			$array_main = array(
				// 				"operation_id" => $operation_id_prod,
				// 				"job_card_id" => $j->id,
				// 			);

				// 			$job_card_prod_qty_prod = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $array_main);

				// 			if ($job_card_prod_qty_prod) {
				// 				foreach ($job_card_prod_qty_prod as $jcp) {
				// 					$prod_qty_new = $prod_qty_new + $jcp->production_qty;
				// 				}
				// 			}
						
				// 		} 
				// 	}
				// }
				
				if ($qty > $customer_parts_master_data[0]->fg_stock) {
					// $this->addErrorMessage("Please check FG stock");
					// $this->redirectMessage();
					// exit();
					$msg = "Please check FG stock";
				} else {
					$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $part_id, "customer_master_id");
					$total_rate_old = $customer_part_rate[0]->rate * $qty;
					$this->load->model('Sales');
					// $discountValue = $this->Sales->isSalesItemDiscount($total_rate_old, $discountType, $discount);
					// if($discountValue > 0) {
					// 	$total_rate_old = $total_rate_old - $discountValue;
					// }
					// $gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $customer_part[0]->gst_id, "id");
					// $taxData = $this->Sales->getSalesPartTaxDetails($total_rate_old, $gst_structure2[0]);
					
					$customer_po_tracking_data = $this->Crud->get_data_by_id("customer_po_tracking", $po_id, "id");

					$data = array(
						"sales_id" => $sales_id,
						"sales_number" => $sales_number,
						"customer_id" => $customer_id,
						"part_id" => $part_id,
						"tax_id" => $customer_part[0]->gst_id,
						"uom_id" => $customer_part[0]->uom,
						"hsn_code" => $customer_part[0]->hsn_code,
						"part_price" => $customer_part_rate[0]->rate,
						"basic_total" => $total_rate_old,
						// "total_rate" => $taxData['total_rate'],
						// "gst_amount" => $taxData['gst_amount'],
						// "tcs_amount" => $taxData['tcs_amount'],
						// "cgst_amount" => $taxData['cgst_amount'],
						// "sgst_amount" => $taxData['sgst_amount'],
						// "igst_amount" => $taxData['igst_amount'],
						"qty" => $this->input->post('qty'),
						"pending_qty" => $this->input->post('qty'),
						// "heat_no" => $this->input->post('heat_no'),
						"invoice_number" => $this->input->post('invoice_number'),
						"created_by" => $this->user_id,
						"created_date" => $this->current_date,
						"created_time" => $this->current_time,
						"created_day" => $this->date,
						"created_month" => $this->month,
						"created_year" => $this->year,
						"po_number" => $customer_po_tracking_data[0]->po_number,
						"po_date" => $customer_po_tracking_data[0]->po_start_date,

					);
					$result = $this->Crud->insert_data("export_sales_parts", $data);
					if ($result) {
						$msg = "Part added successfully.";
						$sucess = 1;
						// $this->addSuccessMessage("Part added successfully.");
					} else {
						$msg = "Unable to add part. Please try again.";
						// $this->addErrorMessage("Unable to add part. Please try again.");
					}
					// $this->redirectMessage();
				}
			}
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['sucess'] = $sucess;
		
		echo json_encode($ret_arr);
		exit();
	}
	public function export_packing_slip(){
		$this->load->model("ExportSalesInvoiceModel");
		$sales_id = $data['sales_id'] = $this->uri->segment('2');
		$data['new_sales'] = $this->Crud->get_data_by_id("export_sales", $sales_id, "id");
		// pr($data['new_sales'],1);
		$data['country_master'] = $country_master = $this->Crud->read_data("country_master");
		$data['country_key_wise'] = array_column($country_master, "name" ,"id");
		$data['currency_master'] = $currency_master = $this->Crud->read_data("currency_master");
		$data['currency_key_wise'] = array_column($currency_master, "name" ,"id");
		$data['port_master'] = $port_master = $this->Crud->read_data("port_master");
		$data['port_key_wise'] = array_column($port_master, "name" ,"id");
		$data['customer'] = $customer = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		$data['po_parts'] = $po_parts = $this->Crud->get_data_by_id("export_sales_parts", $sales_id, "sales_id");
		$data['total_qty'] = array_sum(array_column($data['po_parts'],"qty"));
		$data['export_sales_parts'] = $export_sales_parts = $this->Crud->customQuery('
			SELECT ex.*,cp.part_number,cp.part_description
			FROM `export_sales_parts` as ex
			LEFT JOIN customer_part as cp ON cp.id = ex.part_id
			WHERE `sales_id` = "'.$sales_id.'"
		');
		$export_sales_parts_html = "<option value=''>Select Part</option>";
		foreach ($export_sales_parts as $key => $value) {
			$export_sales_parts_html .= "<option value='".$value->part_id."'>".$value->part_number."/".$value->part_description."</option>";
		}
		$data['export_sales_parts_html'] = $export_sales_parts_html;

		$data['export_packing_slip'] = $this->ExportSalesInvoiceModel->exportPackingSlip($sales_id);
		$data['export_packing_slip_parts'] = [];
		if(count($data['export_packing_slip']) > 0){
			$export_packing_slip_parts = $this->ExportSalesInvoiceModel->exportPackingSlipParts($data['export_packing_slip']['export_packing_slip_id']);
			$packing_part_data = [];
			$packing_details_data = [];
			foreach ($export_packing_slip_parts as $key => $value) {
				$packing_part_data[$value['package_no']][] = $value;
				if(!in_array($value['package_no'],$packing_details_data)){
					$packing_details_data[$value['package_no']] = $value['package_size'];
				}
			}
			$data['export_packing_slip_parts'] = $packing_part_data;
			$data['packing_details_data'] = $packing_details_data;
		}

		
		$this->loadView('sales/export_sales_packing_slip', $data);

	}
	public function add_export_packing_slip(){
		$post_data = $this->input->post();
		$sales_id = $post_data['sales_id'];
		$material_used = $post_data['material_used'];
		$content = $post_data['content'];
		$packing_parts = $post_data['packing_parts'];
		$this->load->model("ExportSalesInvoiceModel");
		$msg = "Something went wrong";
		$success = 0;
		if($post_data['mode'] == "Add"){
			$packing_count = $this->ExportSalesInvoiceModel->exportPackingSlipCount();
			$packing_count = $packing_count['count']+1;
			$year = date("y");
			if(date(n) < 4){
				$year--;
			}
			$packing_number = "PK/".$year."-".($year+1)."/".$packing_count;
			$packing_data = [
				"export_sales_id" => $sales_id,
				"packing_number" => $packing_number,
				"packing_date" => date("Y-m-d H:i:s"),
				"contents" => $content,
				"material_used" => $material_used,
			];
			$insert_id = $this->ExportSalesInvoiceModel->insertExportPackingSlip($packing_data);
			if($insert_id > 0){
				$msg = "Packing Slip data added successfully";
				$success = 1;
			}
		}else{
			$packing_data = [
				"contents" => $content,
				"material_used" => $material_used,
			];
			$affected_row = $this->ExportSalesInvoiceModel->updateExportPackingSlip($packing_data,$post_data['export_packing_slip_id']);
			$insert_id = $affected_row > 0 ? $post_data['export_packing_slip_id'] : 0;
			if($insert_id > 0){
				$msg = "Packing Slip data updated successfully";
				$success = 1;
			}
			
		}
		
		if($insert_id > 0){
			$this->ExportSalesInvoiceModel->deleteExportPackingSlipPart($insert_id);
			$packing_part = [];
			foreach ($packing_parts as $key => $value) {
				$packing_part[] = [
					"export_packing_slip_id" => $insert_id,
					"package_no" => $value['packing_no'],
					"package_size" => $value['packing_size'],
					"part_id" => $value['part_id'],
					"qty" => $value['part_qty'],
					"net_weight" => $value['part_net_weight']	
				];
			}
			$insert_id = $this->ExportSalesInvoiceModel->insertExportPackingSlipPart($packing_part);
		}
		$ret_arr['messages'] = $msg;
		$ret_arr['success'] = $success;
		
		echo json_encode($ret_arr);
		exit();
		
	}
	public function lock_invoice()
	{

		
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$po_parts  = $this->Crud->get_data_by_id("export_sales_parts", $id, "sales_id");
		$discount_amount = $this->input->post('discount_amount');
		$total_sales_amount = $this->input->post('sales_amount');
		$total_gst_amount = $this->input->post('sales_gst_amount');			
		
		$isLocked = false;

		if (!isset($id) || !isset($po_parts[0]->sales_number)) {
			$isLocked = true;
		}

		//avoid double post so check whether the lock status is there before locking...
		if (strpos($po_parts[0]->sales_number, 'TEMP') === false) {
			// if (strpos($po_parts[0]->sales_number, $this->getSalesNoFormat(false,false)) !== false) {
				$new_sales_number = $po_parts[0]->sales_number;
				$sales_data = $this->Crud->get_data_by_id("export_sales", $po_parts[0]->sales_number, "sales_number");
				if ($sales_data[0]->status == 'lock') {
					$isLocked = true;
				} 
			// } 
		}
		$messages = "Something went wrong!.";
		$success =0;
		if ($isLocked == false && $isUnLocked == false) {
			if(date("m") < 4){
	       		$start_year = substr(date("Y", strtotime("-1 year")), -2);
	       		$start_year_val = date("Y", strtotime("-1 year"));
	        	$end_year = substr(date("Y"), -2);
	        	$end_year_val = date("Y");
	       	}else{
	       		$start_year = substr(date("Y"), -2);
	       		$start_year_val = date("Y");
	        	$end_year = substr(date("Y", strtotime("+1 year")), -2);
	        	$end_year_val = date("Y", strtotime("+1 year"));
	       	}
			$role_management_data = $this->db->query('
				SELECT COUNT(cpt.id) as total_record
				FROM `export_sales` as cpt
				WHERE ((cpt.created_year = '.$start_year_val.' AND cpt.created_month >= 5) OR (cpt.created_year = '.$end_year_val.' AND cpt.created_month <= 4)) AND cpt.sales_number LIKE "EX%"
				ORDER BY `id` DESC
			');
			$export_sales = $role_management_data->result();
			
			$total_records = $export_sales[0]->total_record+1;
			$new_sales_number = $this->getLockExportSalesNumber($total_records);
			//updated created date when the invoice is locked..
			$cretd_dt = date('Y-m-d', strtotime($this->current_date));
			$data = array(
				"actualSalesNo" => $total_records,
				"status" => $status,
				"total_sales_amount" => $total_sales_amount,
				"total_gst_amount" => $total_gst_amount,
				"sales_number" => $new_sales_number,
				"created_date" => $cretd_dt
			);
			//transaction management - as of now not working
			$this->db->trans_start();
			$result = $this->Crud->update_data("export_sales", $data, $id);
			$sale_part_data = array(
				"sales_number" => $new_sales_number,
				"created_date" => $this->current_date
			);
			if ($result) {
				//update sales_parts with new sales number 
				$result = $this->Crud->update_data_column("export_sales_parts", $sale_part_data, $id, "sales_id");
			}
			$this->db->trans_complete();

			//check if transaction status TRUE or FALSE
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$messages = "Error 410 :  Not Updated";
			} else {
				$this->db->trans_commit();
				if ($po_parts) {
					foreach ($po_parts as $p) {
						$customer_part_id = $p->part_id;
						$customer_part_data  = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
						$customer_parts_master_data  = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_data[0]->part_number);
						$old_fg_stock = $customer_parts_master_data[0]->fg_stock;

						$new_fg_stock = $old_fg_stock - ($p->qty);

						$data_update = array(
							"fg_stock" => $new_fg_stock,
						);
						$result2 = $this->CustomerPart->updateStockById($data_update, $customer_parts_master_data[0]->id);
					}
				}
				$messages = "Updated Sucessfully";
				$success = 1;
				// $this->addSuccessMessage('Updated Sucessfully');
				// $this->redirectMessage();
			}
		} else {
			// $this->addWarningMessage('Invoice already locked.');
			// $this->redirectMessage("sales_invoice_released");
			$messages = "Invoice already locked.";
		}
		$ret_arr['messages'] = $messages;
		$ret_arr['success'] = $success;
		
		echo json_encode($ret_arr);
		exit();
	}
	public function view_original_sales_invoice()
    {
        $new_sales_id = $this->uri->segment('2');
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
        $html_content_full = $this->for_print_download_generate_sales_invoice("ORIGINAL_FOR_RECIPIENT", $new_sales_id, $configuration);
        $filename = $this->generatePdf($html_content_full['middle_Content'],$html_content_full['heder_content'],$html_content_full['footer_content'],"ORIGINAL_FOR_RECIPIENT","I",$html_content_full['extra_condition']);

        $copy = "export_invoive_ORIGINAL_FOR_RECIPIENT";
        $fileName = "dist/uploads/sales_invoice_print/".$copy.".pdf";
        $fileAbsolutePath = FCPATH.$fileName;
        $fileDownloadPath = base_url().$fileName;
        header("Location: ".$fileDownloadPath);
                    
    }
	public function print_sales_invoice()
    {
        $action = $_POST['action'];
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        
        $new_sales_id = $this->uri->segment('2');
        if (isset($_POST['interests']) && is_array($_POST['interests'])) {
            $selectedInterests = $_POST['interests'];
            if (count($selectedInterests) === 0) {
                echo "No options selected.";
            } else {
                $html_content_full = [];
                $html_content_full_html = "";
                    $isEinvoicePresent = false;
                    $new_sales_data = $this->Crud->get_data_by_id("export_sales", $new_sales_id, "id");
                   
                    $file_names = [];
                    foreach ($selectedInterests as $interest) {
                        
                        $html_content_full_data = $html_content_full[] = $this->for_print_download_generate_sales_invoice($interest, $new_sales_id,$configuration);
                        $file_names[] = $this->generatePdf($html_content_full_data['middle_Content'],$html_content_full_data['heder_content'],$html_content_full_data['footer_content'],$interest,"",$html_content_full_data['extra_condition']);
                        
                    }
                   
                    require_once FCPATH.'fpdf/fpdf.php';
                    require_once  FCPATH.'fpdi/FPDI-2.3.7/src/autoload.php';
                    require_once  FCPATH.'fpdi/FPDI-2.3.7/src/Fpdi.php';

                    // pr(FCPATH,1);
                    // Create new FPDI instance
                    $pdf = new FPDI();

                    foreach ($file_names as $key => $value) {
                        $pageCount = $pdf->setSourceFile($value);
                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                            $templateId = $pdf->importPage($pageNo);
                            $size = $pdf->getTemplateSize($templateId);

                            $pdf->AddPage($size['orientation'], $size);
                            $pdf->useTemplate($templateId);
                        }
                    }
                    $copy = "exportInvoicePrint";
                    $folderPath = "dist/uploads/export_invoice_print";
		        	if (!is_dir($folderPath) && $folderPath != "") {
				        mkdir($folderPath, 0777, true);
				    }
                    $fileName = $folderPath."/export_invoice.pdf";

                    $fileAbsolutePath = FCPATH.$fileName;
                    
                    // Output the new PDF
                    $pdf->Output('F', $fileAbsolutePath);

                    $fileDownloadPath = base_url().$fileName;
                    if($action == "download"){
                        $pdf_content = file_get_contents($fileDownloadPath);
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: attachment; filename=export_invoice.pdf");
                        header("Content-Length: " . strlen($pdf_content));
                        echo $pdf_content;
                        exit();
                    }else if($action == ""){
                        header("Location: ".$fileDownloadPath);
                    }
                    if($action === "email" && $configuration['enable_email_notification'] == 'Yes'){
                        $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
                        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");
                        $emailAddr = $customer_data[0]->emailId;
                            if(empty($emailAddr)){
                                echo "Please add email address to Customer.";
                                die;
                            }

                        $filePath = $fileName;
                        $fileName = $copy.".pdf";
                        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");
                        
                        $toEmailAddr = $customer_data[0]->emailId;
                        $data['sales_number'] = $new_sales_data[0]->sales_number;
                        $this->email_sender($data, $toEmailAddr, $configuration, $filePath, $fileName);
                    }else{
                        echo "Something went wrong";
                    }
                    
            }
        } else {
            echo "No Options Selected.";
        }
    }

    public function for_print_download_generate_sales_invoice($copy = null, $new_sales_id = null,$configuration = [])
    {
    	
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration", $criteria);
		$configuration= array_column($configuration, "config_value", "config_name");
        $new_sales_data = $this->Crud->get_data_by_id("export_sales", $new_sales_id, "id");
        // pr($new_sales_data,1);
        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

        //get client data based on unit selection
        $client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
         // pr($client_data[0]->address1,1);
        //get shipping details based on new sales data like customer or consignee address..
        $shipping_data = $this->getShippingDetails($new_sales_data, $customer_data);
        

        $transporter_data = $this->Crud->get_data_by_id("transporter", $new_sales_data[0]->transporter, "id");

        $po_parts_data = $this->Crud->get_data_by_id("export_sales_parts", $new_sales_id, "sales_id");
        
        $parts_html = '<style>
		   .page-break { page-break-before: always; }
		   body {
		   line-height: 70px; /* Adjust this value for desired line spacing */
		   }
		</style><table cellspacing="0" cellpadding="1"   border="1">
        <tbody>';

        $i = 1;
        $page_count = 4;
        $page_row_count = 1;
        // pr($po_parts_data,1);
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];

        $total_amount = 0;
        $total_qty_row = 0;
        $total_amount_row = 0;
        $last_page_row = "";
        foreach ($po_parts_data as $p) {
            $child_part_data = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
            $customer_tracking = $this->Crud->customQuery('
            	SELECT po.*,po_parts.*
				FROM customer_po_tracking AS po
				JOIN parts_customer_trackings AS po_parts  
				    ON po_parts.customer_po_tracking_id = po.id 
				    AND po_parts.part_id = '.$p->part_id.'
				WHERE po.po_number = "'.$p->po_number.'"'
			 );
            $height_of_each_row = "68px";
            $parts_html .= '
		        <tr style="font-size:10.5px;text-align:center;" width="100%">
		          <td width="3.5%" style="line-height:5;"><b>'.$i.'</b></td>
		          <td width="11%" style=""><br><br>'.$p->po_number.'</td>
		          <td width="5%" style="line-height:5;"><b>'.$customer_tracking[0]->item_no.'</b></td>
		          <td width="30.5%" style="text-align:left;height:'.$height_of_each_row.'px;font-size:10.5px;"> 
			         <table cellpadding="0">
			                <tr>
			                <td>'.$child_part_data[0]->part_number .'<br>' .$child_part_data[0]->part_description .' '.$custItemCd.'<b><br>MOC-</b>'.$customer_tracking[0]->moc.' <b>&nbsp;DRG NO.-</b>'.$customer_tracking[0]->drg_no.' <div><b>Rev NO.-</b>'.$customer_tracking[0]->rev_no.'</div>
			                </td>
			                </tr>
			                </table>
			      </td>
		          
		          <td width="9.66%" style="line-height:5;">'.$child_part_data[0]->hsn_code.' </td>
		          <td width="7%" style="line-height:5;">'.$child_part_data[0]->uom.'</td>
		          <td width="8.33%" style="line-height:5;">'.$p->qty.'</td>
		          <td width="12.5%" style="line-height:5;">'.$p->part_price.'</td>
		          <td width="12.6%" style="line-height:5;">'.$p->basic_total.'</td>
	        	</tr>
		    ';
     	 $total_qty_row  += $p->qty;
     	 $total_amount_row  += $p->basic_total;
		 $total_amount += $p->basic_total;
         if(count($po_parts_data) < $page_row_count+1 ){
            $parts_html .='</tbody></table><table cellspacing="0" cellpadding="1"   border="1">
            <tbody>';
            $last_page_row = '<tr style="font-size:12.5px;text-align:center;" width="100%">
		          <td width="50%" style="" colspan="2">&nbsp;</td>
		          <td width="16.66%" style="line-height:1.6;"><b>Total QTY</b></td>
		          <td width="8.33%" style="">'.$total_qty_row.'</td>
		          <td width="12.5%" style="height:20px;line-height:1.6;"><b>Total Amount</b></td>
		          <td width="12.6%" style="">'.$total_amount_row.'</td>
	        	</tr>';
	        	$total_qty_row = 0;
            $total_amount_row = 0;
         }else if($page_row_count%$page_count == 0 || count($po_parts_data) == $page_row_count){
                $parts_html .='<tr style="font-size:12.5px;text-align:center;" width="100%">
		          <td width="50%" style="" colspan="2">&nbsp;</td>
		          <td width="16.66%" style="line-height:1.6;"><b>Total QTY</b></td>
		          <td width="8.33%" style="">'.$total_qty_row.'</td>
		          <td width="12.5%" style="height:20px;line-height:1.6;"><b>Total Amount</b></td>
		          <td width="12.6%" style="">'.$total_amount_row.'</td>
	        	</tr></tbody></table><br pagebreak="true"/><table cellspacing="0" cellpadding="1"   border="1">
            <tbody>';
            $total_qty_row = 0;
            $total_amount_row = 0;
               
            }
         $page_row_count++;
         $i++;
        
        }
         $remaining_row = $page_count - count($po_parts_data) % $page_count;
       
        if( $remaining_row != 0 && (count($po_parts_data) % $page_count != 0)){
            switch ($remaining_row) {
                    case '6':
                       $height = 259.4;
                        break;
                    case '5':
                       $height = 216;
                        break;
                    case '4':
                       $height = 210;
                        break;
                    case '3':
                       $height = 204;
                        break;
                    case '2':
                       $height = 136.5;
                        break;
                    case '1':
                       $height = 69;
                        break;
                    
                    default:
                        # code...
                        break;
            }

            // pr($type_pdf,1);
 
            $parts_html .='<tr style="font-size:10.5px;" class="part-box"><td style="height:'.$height.'px;">&nbsp;</td>
            </tr>'.$last_page_row;
            $parts_html .= '</tbody></table>';
        }else{
        	$parts_html .=''.$last_page_row;
            $parts_html .= '</tbody></table>';
        }

        // pr($parts_html,1);

        // $remaining_row = $page_count - count($po_parts_data) % $page_count;
       
       	$country_master = $this->Crud->read_data("country_master");
		$country_key_wise = array_column($country_master, "name" ,"id");
		$currency_master = $this->Crud->read_data("currency_master");
		$currency_key_wise = array_column($currency_master, "name" ,"id");
		$port_master = $this->Crud->read_data("port_master");
		$port_key_wise = array_column($port_master, "name" ,"id");


		$country_of_origin = $country_key_wise[$new_sales_data[0]->country_of_origin];
		$port_of_loading = $port_key_wise[$new_sales_data[0]->port_of_loading];
		$country_of_discharge = $country_key_wise[$new_sales_data[0]->country_of_discharge];
		$port_of_discharge = $port_key_wise[$new_sales_data[0]->port_of_discharge];
		$country_of_destination = $country_key_wise[$new_sales_data[0]->country_of_destination];
		$final_destination = $port_key_wise[$new_sales_data[0]->final_destination];
		$currency = $currency_key_wise[$new_sales_data[0]->currency];

        // pr($configuration,1);
		$company_logo_url = "";
		if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                $company_logo_url = base_url('/dist/img/company_logo/').$configuration['companyLogo'];
            }
        }
		$icl_logo_url = "";
		if(isset($configuration['ExportICLLogo'])){
            if($configuration['ExportICLLogo'] != ''){
                $icl_logo_url = base_url('/dist/img/config_img/').$configuration['ExportICLLogo'];
            }
        }
		$image_html = "";
		if($company_logo_url != "" && $icl_logo_url != ""){
			$image_html = '<tr>
	           <th style="text-align:center; font-size:13px;padding:6px;" rowspan="2" width="20%">
	              <img src="'.$company_logo_url.'"  style="width: 60px;padding: 0px;height:50px;max-height:50px;">
	           </th>
			   <th style="text-align:center; font-size:13px;padding:6px;" width="60%">
	              <b>Export Sales INVOICE</b>
	           </th>
			    <th style="text-align:center; font-size:13px;padding:6px;" rowspan="2" width="20%">
	              <img src="'.$icl_logo_url.'"  style="width: 60px;padding: 0px;height:50px;">
	           </th>
	        </tr>';
		}else if($company_logo_url != ""){
			$image_html = '<tr>
	           <th style="text-align:center; font-size:13px;padding:6px;" rowspan="2" width="20%">
	              <img src="'.$company_logo_url.'"  style="width: 60px;padding: 0px;height:50px;max-height:50px;">
	           </th>
			   <th style="text-align:center; font-size:13px;padding:6px;" width="80%">
	              <b>Export Sales INVOICE</b>
	           </th>
	        </tr>';
		}else if($icl_logo_url != ""){
			$image_html = '<tr>
			   <th style="text-align:center; font-size:13px;padding:6px;" width="80%">
	              <b>Export Sales INVOICE</b>
	           </th>
			    <th style="text-align:center; font-size:13px;padding:6px;" rowspan="2" width="20%">
	              <img src="'.$icl_logo_url.'"  style="width: 60px;padding: 0px;height:50px;">
	           </th>
	        </tr>';
		}else{
			$image_html = '<tr>
			   <th style="text-align:center; font-size:13px;padding:6px;" width="100%">
	              <b>Export Sales INVOICE</b>
	           </th>
	        </tr>';
		}
		
        $html_content ='
        	        <style>
             
            .main th, .main td ,b{ 
                font-family: "Poppins", sans-serif;
                line-height: 1.8;
                padding: 10px;
                margin: 10px;
            }
            table {
                padding: 0px;
            }

           </style>
		    <table cellspacing="0" cellpadding="1" border="1">
	        <tbody>
	        '.$image_html.'
	        <tr>
	           <!-- Company Details -->
	           <th style="font-size:9.4px;text-align:center;padding:5pxwidth:20%;border-top: 0px solid white;border-bottom: 1px solid black;line-height:2.2;" >
	              <b style="font-size:16px;margin-top:-100px;">'.$client_data[0]->client_name.'</b>
	           </th>
	        </tr>
			</table>
	        <table cellspacing="0" cellpadding="1" border="1" class="main">
	        <tbody>
	        <tr style="font-size:10.59px; ">
	        <td width="50%" style="line-height:1.5;height:45px;">
	          <b style="font-size:11.59px; ">EXPORTER : </b> 
	          '.$client_data[0]->client_name.'<br>  '.$client_data[0]->address1.'
	        </td>
	        <td width="50%" style="line-height:1.5;font-size:13px;">
	          <span style=""><b>INVOICE NO :&nbsp;&nbsp;'.$new_sales_data[0]->sales_number.'</b></span><br>
	          <b>INVOICE DATE :</b>  '.defaultDateFormat($new_sales_data[0]->created_date).'
	        </td>
	        </tr>
	        <tr style="font-size:11.59px; ">
	        <td width="50%" style="line-height:1.5;">
	          <b>IEC CODE : </b> '.$client_data[0]->micr_code.'<br>
	          <b>AD CODE : </b>'.$client_data[0]->ad_no.'
	        </td>
	        <td width="50%" style="line-height:1.5;">
	         <b>BANK NAME : </b> '.$client_data[0]->bank_name.'<br>
	          <b>ACCOUNT NAME : </b>'.$client_data[0]->account_name.'
	        </td>
	        </tr>
	        <tr style="font-size:11.59px; ">
	        <td width="50%" style="line-height:1.5;">
	          <b>LUT NO :</b> '.$client_data[0]->lut_no.'<br>
	          <b>LUT DATE : </b>'.defaultDateFormat($client_data[0]->lut_date).'
	        </td>
	        <td width="50%" style="line-height:1.5;">
	         <b>ACCOUNT NO : </b> '.$client_data[0]->bank_account_no.'<br>
	          <b>IFSC CODE : </b>'.$client_data[0]->ifsc_code.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>SWIFT CODE : </b>'.$client_data[0]->swift_code.'
	        </td>
	        </tr>
	        <tr style="font-size:10.59px; " >
	            <td width="50%" style="padding-top: 4px;height:99px;">
	            <table cellspacing="0" cellpadding="0"   border="0" >
	                <tr>
	                <td style="padding-top: 4px;line-height:1.5;"><b style="font-size:11px; ">Details of Receiver (Billed To)</b><br><b>'. $customer_data[0]->customer_name .'</b><br>' . $customer_data[0]->billing_address . '
	                </td>
	                </tr>
	            </table>
	            </td>
	            <td width="50%" style="padding-top: 4px;height:50px;">
	            <table cellspacing="0" cellpadding="0"   border="0" >
	                <tr>
	                <td style="padding-top: 4px;line-height:1.5;"><b style="font-size:11px;">Details of Consignee (Shipped to)</b><br><b>' . $shipping_data['shipping_name'] . '</b><br>' . $shipping_data['ship_address'] . '
	                </td>
	                </tr>
	            </table>
	            </td>
	         </tr>
	         
	         </tbody>
	        </table>
	       <table cellspacing="0" cellpadding="0" border="1" class="main">
		    <tbody>
		        <tr style="font-size:11.59px;">
		        	<td colspan="3" style="text-align:left;" width="25%;">
		            	<b>COUNTRY OF ORIGIN</b>
		            	<br>
		            	'.$country_of_origin.'
		            </td>
		            <td colspan="3" style="text-align:left;" width="25%;">
		            	<b>PORT OF LOADING</b>
		            	<br>
		            	'.$port_of_loading.'
		            </td>
		            
		            <td colspan="3" style="text-align:left;" width="25%;">
		            	<b>PRECARRIAGE BY</b>
		            	<br>
		            	'.$new_sales_data[0]->precarriage_by.'
		            </td>
		            <td colspan="2" style="text-align:left" width="25%">
		            	<b>Container No</b>
		            	<br>
		            	'.$new_sales_data[0]->container_no.'
		            </td>
		        </tr>
		        <tr style="font-size:11.5px">
		        	<td colspan="3" style="text-align:left;" width="25%;">
		            	<b>COUNTRY OF DISCHARGE</b>
		            	<br>
		            	'.$country_of_discharge.'
		            </td>
		            <td colspan="3" style="text-align:left;" width="25%;">
		            	<b>PORT OF DISCHARGE</b>
		            	<br>
		            	'.$port_of_discharge.'
		            </td>
		            <td colspan="3" style="text-align:left;margin-left:10px;">
		            	<b>PACKED IN</b>
		            	<br>
		            	'.$new_sales_data[0]->packed_in.'
		            </td>
		            <td colspan="2" style="text-align:left">
		            	<b>TOTAL BOXES</b>
		            	<br>
		            	'.$new_sales_data[0]->total_boxes.'
		            </td>
		        </tr>
		         <tr style="font-size:11.5px">
		         	<td colspan="3" style="text-align:left;" width="25%;">
		            	<b>COUNTRY OF DESTINATION</b>
		            	<br>
		            	'.$country_of_destination.'
		            </td>
		            <td colspan="3" style="text-align:left;" width="25%;">
		            	<b>FINAL DESTINATION</b>
		            	<br>
		            	'.$final_destination.'
		            </td>
		            <td colspan="3" style="text-align:left;margin-left:10px;">
		            	<b>NET WEIGHT (Kg)</b>
		            	<br>
		            	'.$new_sales_data[0]->net_weight.'
		            </td>
		            <td colspan="2" style="text-align:left">
		            	<b>CHECKED IN</b>
		            	<br>
		            	'.$new_sales_data[0]->checked_in.'
		            </td>
		        </tr>
		         <tr style="font-size:11.5px">
		            <td colspan="3" style="text-align:left;margin-left:10px;" width="25%;">
		            	<b>GROSS WEIGHT (Kg)</b>
		            </td>
		            <td colspan="3" style="text-align:left;margin-left:10px;" width="25%;">
		            	'.$new_sales_data[0]->gross_weight.'
		            </td>
		            <td colspan="2" style="text-align:left;font-size:9.8px" width="25%;">
		            	<b style="text-align:left;font-size:11.5px">TRANSPORTER DETAILS</b>
		            </td>
		            <td colspan="3" style="text-align:left;margin-left:10px;font-size:10px" width="25%;">
		            	'.$transporter_data[0]->name.'
		            </td>
		        </tr>

		         <tr style="font-size:10.5px;text-align:center;" width="100%">
		          <td width="3.5%"><b>Sr No</b></td>
		          <td width="11%" style=""><b>PO <br>DETAILS</b></td>
		          <td width="5%"><b>ITEM No</b></td>
		          <td width="30.5%" style="text-align:center;line-height:3.5;"><b>&nbsp;Part Description</b></td>
		          <td width="9.66%" style="line-height:3.5;"><b>HSN / SAC</b> </td>
		          <td width="7%" style="line-height:3.5;"><b>UOM</b></td>
		          <td width="8.33%" style="line-height:3.5;"><b>QTY</b></td>
		          <td width="12.5%" ><b>Rate<br>('.$currency.')</b></td>
		          <td width="12.6%" style="line-height:3.5;"><b>Amount (Rs)</b></td>
	        </tr>
		    </tbody>
		</table>
         
        ' ;
        
        $heder_html = $html_content;
        


        
        $footer_content = '
         <table cellspacing="0" cellpadding="4" border="1" class="main">
	        <tbody>
	        <tr>
	           <th style="text-align:left;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> TOTAL INVOICE VALUE (in figure) :</b> '.$currency.' '.$total_amount.'
	           </th>
	        </tr>
	        <tr>
	           <th style="text-align:left;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> TOTAL INVOICE VALUE (in words):</b> '.$currency.' '.numberToWords($total_amount).'
	           </th>
	        </tr>
	        <tr>
	           <th style="text-align:left;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> PAYMENT TERMS :</b> '.$customer_data[0]->payment_terms.' Days
	           </th>
	        </tr>
	        <tr>
	           <th style="text-align:left;font-size:12px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> Remark :</b> '.$new_sales_data[0]->remark.' <br> <b>Note :</b> '.$new_sales_data[0]->note.'
	           </th>
	        </tr>
	        <tr>
	           <th style="text-align:left;font-size:10px;padding:0px;border-bottom: 1px solid black;" colspan="2">We declare all the information contained in this invoice to be true and correct to my knowledge The exporter INREXABEFS0669JDG031 of the products covered by this document
declares that, except where otherwise clarity indicated, these products are of Indian preferential origin according to rules of the Generalized System of preferences of the European
Union and that the Origin criterion met is P8413EU cumulation.
	           </th>
	        </tr>
	        <tr>
	           <td style="text-align:center; font-size:13px;padding:6px;border-bottom: 0px solid black;line-height:2.2" >
	              <br>
	              <br>
	              <br>
	              Receivers Name & SIgnature
	           </td>
	           <td style="text-align:center; font-size:13px;padding:6px;line-height:2.2" >
	              <b>For, '.$client_data[0]->client_name.'</b>
	              <br>
	              <br>
	              Authorised Signatory
	           </td>
	        </tr>
	       <tbody>
	    </table>
        ';
        $return_arr = [
            "heder_content" => $heder_html,
            "footer_content" => $footer_content,
            "middle_Content" => $parts_html
        ];
        return $return_arr;
        
        
    }
    public function generatePdf($html_content = "",$header="",$footer="",$type="",$pdf_download_type="",$extra_condition ="normal"){
        $meddle_content =138.7;
        $footer_content =-75.5;
        $top_margin = 6.8;
        // pr("ok",1);
        // $header = $this->smarty->fetch('sales/sales_pdf_generate.tpl', $data, TRUE);
            // pr($html_content,1);
            // $pdf = new Pdf1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false,'',$header,$footer,$top_margin, $footer_content);

            $pdf->SetMargins(10, $meddle_content, 8, 5);

        // set document information

        $pdf->SetCreator(PDF_CREATOR);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        // $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT,0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        // set some text to print
        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

        // output the HTML content
        $pdf->writeHTML($html_content, true, false, true, false, '');

        if($pdf_download_type == "I"){
            $pdf->Output($fileAbsolutePath, 'I');
             ob_end_flush();
        }else{
            //Close and output PDF document
            $folderPath = "dist/uploads/export_invoice_print";
		    if (!is_dir($folderPath) && $folderPath != "") {
				mkdir($folderPath, 0777, true);
			}
            $fileName = $folderPath."/export_invoice_".$type.".pdf";
            $fileAbsolutePath = FCPATH.$fileName;
            $pdf->Output($fileAbsolutePath, 'F');
             ob_end_flush();
            return $fileAbsolutePath;
        }
        
       
    } 

    
     public function export_packing_slip_download()
    {
		$this->load->model("ExportSalesInvoiceModel");
		$new_sales_id = $this->uri->segment('2');
    	$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration", $criteria);
		$configuration= array_column($configuration, "config_value", "config_name");
       
        $new_sales_data = $this->Crud->get_data_by_id("export_sales", $new_sales_id, "id");
		$packing_slip = $this->ExportSalesInvoiceModel->exportPackingSlip($new_sales_id);
		$consignee = [];
		$consignee_address = [];
		if($new_sales_data[0]->consignee_id > 0){
			$consignee = $this->Crud->get_data_by_id("consignee", $new_sales_data[0]->consignee_id, "id");
			$consignee_address = $this->Crud->get_data_by_id("address_master", $consignee[0]->address_id, "id");
		}
        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

        //get client data based on unit selection
        $client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
        //  pr($packing_slip_data,1);
        //get shipping details based on new sales data like customer or consignee address..
        $shipping_data = $this->getShippingDetails($new_sales_data, $customer_data);
        

        $transporter_data = $this->Crud->get_data_by_id("transporter", $new_sales_data[0]->transporter, "id");

        $po_parts_data = $this->Crud->get_data_by_id("export_sales_parts", $new_sales_id, "sales_id");
        
        $parts_html = '<style>
		   .page-break { page-break-before: always; }
		   body {
		   line-height: 70px; /* Adjust this value for desired line spacing */
		   }
		</style><table cellspacing="0" cellpadding="3"   border="1">
        <tbody>';

        $i = 1;
        $page_count = 5;
        $page_row_count = 1;
        // pr($po_parts_data,1);
        $po_parts_data[] = $po_parts_data[0];

        

        $total_amount = 0;
        $total_qty_row = 0;
        $total_amount_row = 0;
        $last_page_row = "";
		$total_net_weight_row = 0;
		
		$po_parts_data_id_wise = [];
		foreach ($po_parts_data as $key => $value) {
			$po_parts_data_id_wise[$value->part_id] = (array)$value;
		}
		
		$packing_slip_data = $this->ExportSalesInvoiceModel->exportPackingSlipParts($packing_slip['export_packing_slip_id']);
		$packing_slip_boxes = array_unique(array_column($packing_slip_data,"package_no"));
		$packing_slip_data[] = $packing_slip_data[0];
		$packing_slip_data[] = $packing_slip_data[0];
        foreach ($packing_slip_data as $p) {
			// pr($p['net_weight'],1);
            $child_part_data = $this->Crud->get_data_by_id("customer_part", $p['part_id'], "id");
			$po_part_data = $po_parts_data_id_wise[$p['part_id']];
			// pr($po_part_data,1);
            $customer_tracking = $this->Crud->customQuery('
            	SELECT po.*,po_parts.*
				FROM customer_po_tracking AS po
				JOIN parts_customer_trackings AS po_parts  
				    ON po_parts.customer_po_tracking_id = po.id 
				    AND po_parts.part_id = '.$p['part_id'].'
				WHERE po.po_number = "'.$po_part_data['po_number'].'"'
			 );
            $height_of_each_row = "68px";
            $parts_html .= '
		        <tr style="font-size:10.5px;;" width="100%">
		          <td width="12%" style="height:75px;">'.$p['package_no'].'/'.$new_sales_data[0]->packed_in.'/'.$p['package_size'].'</td>
		          <td width="3.5%" style="text-align:center;line-height:3.5;">'.$i.'</td>
		          <td width="16%" style="line-height:3.5;text-align:center;">'.$po_part_data['po_number'].'</td>
		          <td width="5%" style="text-align:center;line-height:3.5;">'.$customer_tracking[0]->item_no.'</td>
		          <td width="37.7%"style="height:53.4px;" ><table cellpadding="4">
			                <tr>
			                <td>'.$child_part_data[0]->part_number .'<br>' .$child_part_data[0]->part_description .'
			                </td>
			                </tr>
			                </table></td>
		          <td width="8.33%" style="line-height:3.5;text-align:center;">'.$p['qty'].'</td>
		          <td width="7%" style="line-height:3.5;text-align:center;">'.$child_part_data[0]->uom.'</td>
		          <td width="10.5%" style="line-height:3.5;text-align:center;">'.$p['net_weight'].'</td>
	        	</tr>
		    ';
     	 $total_qty_row  += $p['qty'];
		 $total_net_weight_row  += $p['net_weight'];
     	 $total_amount_row  += $p->basic_total;
		 $total_amount += $p->basic_total;
         if(count($packing_slip_data) < $page_row_count+1 ){
            $parts_html .='</tbody></table><table cellspacing="0" cellpadding="3"   border="1">
            <tbody>';
            $last_page_row = '<tr style="font-size:12.5px;text-align:center;" width="100%">
		          <td width="36.5%" style="text-align:left;line-height:1.6;" colspan="2">&nbsp;&nbsp;<b>Total Boxes :</b>  '.$total_qty_row.'</td>
		          <td width="37.7%" style="line-height:1.6;text-align:right;"><b>Total&nbsp;&nbsp;</b></td>
		          <td width="8.33%" style="line-height:1.6">'.$total_qty_row.'</td>
		          <td width="7%" style="height:20px;line-height:1.6;"><b>Total</b></td>
		          <td width="10.5%" style="line-height:1.6">'.$total_net_weight_row.'</td>
	        	</tr>';
	        	$total_qty_row = 0;
            $total_amount_row = 0;
			$total_net_weight_row = 0;
         }else if($page_row_count%$page_count == 0 || count($packing_slip_data) == $page_row_count){
                $parts_html .='<tr style="font-size:12.5px;text-align:center;" width="100%">
		          <td width="36.5%" style="text-align:left;line-height:1.6;" colspan="2">&nbsp;&nbsp;<b>Total Boxes :</b>  '.$total_qty_row.'</td>
		          <td width="37.7%" style="line-height:1.6;text-align:right;"><b>3Total&nbsp;&nbsp;</b></td>
		          <td width="8.33%" style="line-height:1.6">'.$total_qty_row.'</td>
		          <td width="7%" style="height:20px;line-height:1.6;"><b>Total</b></td>
		          <td width="10.5%" style="line-height:1.6">'.$total_net_weight_row.'</td>
	        	</tr></tbody></table><br pagebreak="true"/><table cellspacing="0" cellpadding="3"   border="1">
            <tbody>';
            $total_qty_row = 0;
            $total_amount_row = 0;
            $total_net_weight_row = 0;
            }
         $page_row_count++;
         $i++;
        
        }
        $remaining_row = $page_count - count($packing_slip_data) % $page_count;
        if( $remaining_row != 0 && (count($packing_slip_data) % $page_count != 0)){
            switch ($remaining_row) {
                    case '6':
                       $height = 320.9;
                        break;
                    case '5':
                       $height = 267.5;
                        break;
                    case '4':
                       $height = 300;
                        break;
                    case '3':
                       $height = 225;
                        break;
                    case '2':
                       $height = 150;
                        break;
                    case '1':
                       $height = 75;
                        break;
            }

            // pr($type_pdf,1);
 
            $parts_html .='<tr style="font-size:10.5px;" class="part-box"><td style="height:'.$height.'px;">&nbsp;</td>
            </tr>'.$last_page_row;
            $parts_html .= '</tbody></table>';
        }else{
        	$parts_html .=''.$last_page_row;
            $parts_html .= '</tbody></table>';
        }

        // pr($parts_html,1);

        // $remaining_row = $page_count - count($po_parts_data) % $page_count;
       
       	$country_master = $this->Crud->read_data("country_master");
		$country_key_wise = array_column($country_master, "name" ,"id");
		$currency_master = $this->Crud->read_data("currency_master");
		$currency_key_wise = array_column($currency_master, "name" ,"id");
		$port_master = $this->Crud->read_data("port_master");
		$port_key_wise = array_column($port_master, "name" ,"id");


		$country_of_origin = $country_key_wise[$new_sales_data[0]->country_of_origin];
		$port_of_loading = $port_key_wise[$new_sales_data[0]->port_of_loading];
		$country_of_discharge = $country_key_wise[$new_sales_data[0]->country_of_discharge];
		$port_of_discharge = $port_key_wise[$new_sales_data[0]->port_of_discharge];
		$country_of_destination = $country_key_wise[$new_sales_data[0]->country_of_destination];
		$final_destination = $port_key_wise[$new_sales_data[0]->final_destination];
		$currency = $currency_key_wise[$new_sales_data[0]->currency];


		$herder_html = '
			<td width="100%" style="line-height:1.5;" colspan="2">
		        <table>	
		        	<tr>
		        		<td><b>PACKING LIST</b></td>
		        	</tr>
		        </table>
		    </td>';
        if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
               $company_logo = $configuration['companyLogo'];
           $logo_url = base_url("/dist/img/company_logo/").$company_logo;
           $herder_html = '
           		   <td width="20%" style="line-height:1.5; text-align:center;">
			          <img src="'.$logo_url.'" style="width: 100px;padding: 0px;height:60px;" />
			       </td>
		           <td width="80%" style="line-height:1.5;text-align:center;" >
				        <table cellpadding="15">	
				        	<tr>
				        		<td style="font-size:18px;"><b>PACKING LIST</b></td>
				        	</tr>
				        </table>
				    </td>';
            }
        }
		
		$company_logo_url = "";
		if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                $company_logo_url = base_url('/dist/img/company_logo/').$configuration['companyLogo'];
            }
        }
		$tuv_logo_url = "";
		if(isset($configuration['ExportTUVLogo'])){
            if($configuration['ExportTUVLogo'] != ''){
                $tuv_logo_url = base_url('/dist/img/config_img/').$configuration['ExportTUVLogo'];
            }
        }

		$image_html = "";
		if($company_logo_url != "" && $tuv_logo_url != ""){
			$image_html = '<td width="20%" style="line-height:1.5; text-align:center;">
				
			          <img src="'.$company_logo_url.'" style="width: 100px;padding: 0px;height:60px;" />
			       </td>
		           <td width="60%" style="line-height:1.5;text-align:center;" >
				        <table cellpadding="15">	
				        	<tr>
				        		<td style="font-size:18px;"><b>PACKING LIST</b></td>
				        	</tr>
				        </table>
				    </td>
					<td width="20%" style="line-height:1.5; text-align:center;">
			          <img src="'.$tuv_logo_url.'" style="width: 100px;padding: 0px;height:60px;" />
			       </td>';
		}else if($company_logo_url != ""){
			$image_html = '<td width="20%" style="line-height:1.5; text-align:center;">
			          <img src="'.$company_logo_url.'" style="width: 100px;padding: 0px;height:60px;" />
			       </td>
		           <td width="80%" style="line-height:1.5;text-align:center;" >
				        <table cellpadding="15">	
				        	<tr>
				        		<td style="font-size:18px;"><b>PACKING LIST</b></td>
				        	</tr>
				        </table>
				    </td>';
		}else if($tuv_logo_url != ""){
			$image_html = '
		           <td width="80%" style="line-height:1.5;text-align:center;" >
				        <table cellpadding="15">	
				        	<tr>
				        		<td style="font-size:18px;"><b>PACKING LIST</b></td>
				        	</tr>
				        </table>
				    </td>
					<td width="20%" style="line-height:1.5; text-align:center;">
			          <img src="'.$tuv_logo_url.'" style="width: 100px;padding: 0px;height:60px;" />
			       </td>';
		}else{
			$image_html = '<td width="100%" style="line-height:1.6;text-align:center;" >
				        <table cellpadding="16">	
				        	<tr>
				        		<td style="font-size:18px;"><b>PACKING LIST</b></td>
				        	</tr>
				        </table>
				    </td>';
		}
    //    pr($image_html,1);
        $html_content ='
        	        <style>
             
            th, td ,b{ 
                font-family: "Poppins", sans-serif;
                line-height: 1.8;
                padding: 10px;
                margin: 10px;
            }
            table {
                padding: 0px;
            }

           </style>
	        <table cellspacing="0" cellpadding="1.3" border="1">
	        <tbody>
			<tr>
	        '.$image_html.'
			</tr>
	      	
	        <tr style="font-size:10.59px; ">
	        <td width="50%" style="line-height:1;height:103px;">
	        	<table cellpadding="">	
				        	<tr>
				        		<td style="line-height:1.5;"><b style="font-size:11.59px; ">EXPORTER : </b><br>'.$client_data[0]->client_name.'<br>'.$client_data[0]->billing_address.''.$client_data[0]->billing_address.'
				        		</td>
				        	</tr>
				</table>
	         
	        </td>
	        <td width="50%" style="line-height:1.5;font-size:13px;">
	       		<table cellpadding="">	
				        	<tr>
				        		<td  width="37%"><b>Packing List No.</b></td>
				        		<td  width="70%"><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;'.$packing_slip['packing_number'].'</td>
				        	</tr>
				        	<tr>
				        		<td ><b>Packing List Date</b></td>
				        		<td ><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;'.getDefaultDateTime($packing_slip['packing_date']).'</td>
				        	</tr>
				        	<tr>
				        		<td ><b>Invoice No.</b></td>
				        		<td ><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;'.$new_sales_data[0]->sales_number.'</td>
				        	</tr>
				        	<tr>
				        		<td ><b>Invoice Date</b></td>
				        		<td ><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;'.defaultDateFormat($new_sales_data[0]->created_date).'</td>
				        	</tr>
				</table>
	         
	        </td>
	        </tr>
	       
	       
	        <tr style="font-size:11.59px; " >
	            <td width="50%" style="padding-top: 4px;height:93px;">
	            <table cellspacing="0" cellpadding="0"   border="0" >
	                <tr>
	                <td style="padding-top: 4px;line-height:1.5;"><b>Consignee (Billed To)</b><br><b>'. $customer_data[0]->customer_name .'</b><br>' . $customer_data[0]->billing_address . '
	                </td>
	                </tr>
	            </table>
	            </td>
	            <td width="50%" style="padding-top: 4px;height:50px;">
	            <table cellspacing="0" cellpadding="0"   border="0" >
	                <tr>
	                <td style="padding-top: 4px;line-height:1.5;"><b>Shipped to</b><br><b>' . $consignee[0]->consignee_name . '</b><br>' . $consignee_address[0]->address . '
	                </td>
	                </tr>
	            </table>
	            </td>
	         </tr>
	         
	         </tbody>
	        </table>
	       <table cellspacing="0" cellpadding="1" border="1">
		    <tbody>
		        <tr style="font-size:10.59px;">
		        	<td colspan="3" style="text-align:left;" width="25%;">
		            	<b>Pre carriage By</b>
		            	<br>
		            	'.$new_sales_data[0]->precarriage_by.'
		            </td>
		        	<td colspan="3" style="text-align:left;" width="25%;">
		            	<b>Place of receipt by Pre Carrier</b>
		            	<br>
						  '.$new_sales_data[0]->place_receipt_by_precarrier.'
		            </td>
		            <td colspan="3" style="text-align:left;" width="25%;">
		            	<b>Country of Origin of goods</b>
		            	<br>
		            	'.$country_of_origin.'
		            </td>
		            
		            
		            <td colspan="2" style="text-align:left" width="25%">
		            	<b>Country of Final Destination</b>
		            	<br>
		            	'.$country_of_destination.'
		            </td>
		        </tr>
		        <tr style="font-size:11.5px">
		        	<td colspan="3" style="text-align:left;" width="25%;">
		            	<b>Mode of Shipment</b>
		            	<br>
		            	'.$new_sales_data[0]->mode_of_shipment.'
		            </td>
		            <td colspan="3" style="text-align:left;" width="25%;">
		            	<b>Port of Loading</b>
		            	<br>
		            	'.$port_of_loading.'
		            </td>
		            <td colspan="3" style="text-align:left;margin-left:10px;">
		            	<b>Port of Discharge</b>
		            	<br>
		            	'.$port_of_discharge.'
		            </td>
		            <td colspan="2" style="text-align:left">
		            	<b>Final of Destination</b>
		            	<br>
		            	'.$final_destination.'
		            </td>
		        </tr>
		         
		         <tr style="font-size:11.5px">
		            <td colspan="3" style="text-align:left;margin-left:10px;" width="100%;" colspan="4">
		            	<b>CONTENTS :</b>'.$packing_slip['contents'].'<br>
		            	<b>MATERIAL USED  :</b>'.$packing_slip['material_used'].'
		            </td>
		        </tr>

		         <tr style="font-size:10.5px;text-align:center;" width="100%">
		          <td width="12%" style="line-height:1.5;"><b>Package Details</b></td>
		          <td width="3.5%"><b>Sr No</b></td>
		          <td width="16%" style="line-height:3.5;"><b>PO. No.</b></td>
		          <td width="5%"><b>Item No</b></td>
		          <td width="37.7%" style="text-align:center;line-height:3.5;"><b>&nbsp;Description of Goods</b></td>
		          <td width="8.33%" style="line-height:3.5;"><b>Qty/Pallet</b></td>
		          <td width="7%" style="line-height:3.5;"><b>UOM</b></td>
		          <td width="10.5%" style="line-height:3.5;"><b>NET WT. KG</b></td>
	        </tr>
		    </tbody>
		</table>
         
        ' ;
        
        $heder_html = $html_content;
        


        
        $footer_content = '
         <table cellspacing="0" cellpadding="4" border="1">
	        <tbody>
	        <tr>
	           <th style="text-align:left;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> Private Marks  :</b> '.$new_sales_data[0]->sales_number.' / BOX 1 To '.count($packing_slip_boxes).'
	           </th>
	        </tr>
	        <tr>
	           <th style="text-align:left;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> Gross Weight (In Kg.): </b> '.$new_sales_data[0]->gross_weight.'
	           </th>
	        </tr>
	        <tr>
	           <th style="text-align:left;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> Declaration :  </b> We declare that this invoice shows the actual price of the goods description and that paticluars are true and correct.
	           </th>
	        </tr>
	        <tr>
	           <td style="text-align:center; font-size:13px;padding:6px;border-bottom: 0px solid black;line-height:2.2" >
	              <br>
	              <br>
	              <br>
	              Receivers Name & SIgnature
	           </td>
	           <td style="text-align:center; font-size:13px;padding:6px;line-height:2.2" >
	              <b>For, '.$client_data[0]->client_name.'</b>
	              <br>
	              <br>
	              Authorised Signatory
	           </td>
	        </tr>
	        <tr>
	           <th style="text-align:center;font-size:11px;padding:0px;border-bottom: 1px solid black;" colspan="2"><b> 
"THIS IS SYSTEM GENERATED DOCUMENT HENCE SIGNATURE NOT REQUIRE." </b> 
	           </th>
	        </tr>
	       <tbody>
	    </table>
        ';
        // $return_arr = [
        //     "heder_content" => $heder_html,
        //     "footer_content" => $footer_content,
        //     "middle_Content" => $parts_html
        // ];
        // return $return_arr;

        $meddle_content =128;
        $footer_content1 =-55.8;
        $top_margin = 6.8;
        // pr("ok",1);
        // $header = $this->smarty->fetch('sales/sales_pdf_generate.tpl', $data, TRUE);
            // pr($html_content,1);
            // $pdf = new Pdf1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false,'',$heder_html,$footer_content,$top_margin, $footer_content1);

            $pdf->SetMargins(10, $meddle_content, 8, 5);

        // set document information

        $pdf->SetCreator(PDF_CREATOR);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        // $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT,0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        // set some text to print
        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

        // output the HTML content
        $pdf->writeHTML($parts_html, true, false, true, false, '');

         $pdf->Output($fileAbsolutePath, 'I');
             ob_end_flush();
        
        
    }
}