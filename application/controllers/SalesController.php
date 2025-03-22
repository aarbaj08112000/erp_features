<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class SalesController extends CommonController
{

	const VIEW_PATH = "sales/";

	function __construct()
	{
		parent::__construct();
		$this->load->model('CustomerPart');
		$this->load->model('SalesModel');
		require_once APPPATH . 'libraries/Pdf1.php';
		ini_set('max_execution_time', 0); // Set unlimited execution time
		set_time_limit(0);
		ini_set('memory_limit', '-1');
	}

	private function getViewPath()
	{
		return self::VIEW_PATH;
	}

	public function sales_invoice_released()
	{
		/* 
	 Pagination code
	 //http://localhost/bsperp/bsp-gsthero-dev/sales_invoice_released12/10
		
	   $config = array();
       $config["base_url"] = base_url() . "sales_invoice_released";
       $config["total_rows"] = $this->Crud->record_count("new_sales");
       $config["per_page"] = 10;
       $config["uri_segment"] = 2;
       $this->pagination->initialize($config);
       $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
	   
	   $data['new_sales'] = $this->Crud->read_data_with_limit("new_sales",$config["per_page"], $page);
	   $data["links"] = $this->pagination->create_links();
	*/
	    checkGroupAccess("sales_invoice_released","list","Yes");
		$created_month = $this->input->post('created_month');
		$created_year = $this->input->post('created_year');

		if (empty($created_month)) {
			$created_month = $this->month;
		}

		if (empty($created_year)) {
			$created_year = $this->year;
		}

		//print_r("created_month: ".$created_month);
		//print_r("created_year: ".$created_year);

		// $data['customer_part_list'] = $this->Crud->read_data("customer_part");
		//$data['job_card'] = $this->Crud->read_data("job_card");
		$data['customer_part'] = $this->Crud->read_data("customer_part");
		//$data['new_sales'] = $this->Crud->read_data("new_sales");

		$sql = "SELECT cus.customer_name,eres.Status,eres.EwbStatus,rs.id as rejection_invoice_id,new_sales.*  FROM new_sales 
		left join customer cus on new_sales.customer_id = cus.id
		left join einvoice_res eres on new_sales.id = eres.new_sales_id 
		left join rejection_sales_invoice as rs ON rs.sales_invoice_number = new_sales.sales_number 
		WHERE new_sales.clientId = ".$this->Unit->getSessionClientId()." AND new_sales.created_month = " . $created_month . " AND new_sales.created_year = " . $created_year . " order by new_sales.id desc";
		$data['new_sales']  = $this->Crud->customQuery($sql);
		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;
		
		// $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
		// $data['customer_part_list'] = $role_management_data->result();

		
		if($data['new_sales']){
			foreach ($data['new_sales'] as $key=>$c) {
				$sales_id = $c->id;
				$po_parts = $this->Crud->get_data_by_id("sales_parts", $sales_id, "sales_id");
				$final_po_amount = 0;
				$gst_structure ;
				$final_basic_total = 0;
				if ($po_parts) {
					foreach ($po_parts as $p) {
						$subtotal +=  $p->total_rate - $p->gst_amount;
						$row_total =(float) $p->total_rate+(float)$p->tcs_amount;
						$final_basic_total = $final_basic_total + $subtotal;
						$final_po_amount = (float)$final_po_amount + (float)$row_total;
						if(empty($gst_structure)){
		                    $gst_structure = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
		                }
					}
				}
				$data['subtotal'][$sales_id] = $subtotal;
				$data['row_total'][$sales_id] = $row_total;
				$discountValue = 0;
				if($c->discountType!='NA') {
					if (isset($c->discount) && is_numeric($c->discount) && $c->discount > 0) {
						$discountValue = $c->discount;
						if ($c->discountType != 'Amount') {
						$discountValue = number_format($final_basic_total * ($c->discount / 100),2);
						}
					}
				}
				$sales_total = $this->Crud->tax_calcuation($gst_structure[0], $final_basic_total, $discountValue);
				// pr($sales_total);
				$data['new_sales'][$key]->sales_total = $final_po_amount;
	
			}
		}
		
		
		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
		// pr($data,1);
		$this->loadView('sales/sales_invoice_released', $data);
	}

	public function new_sales($reused_sales_no=null)
	{
		checkGroupAccess("new_sales","list","Yes");
		if(!empty($reused_sales_no)){
			$data['reused_sales_no'] = $reused_sales_no;
		}else{
			$data['reused_sales_no'] = $this->input->post('reused_sales_no');
		}

		$data['id'] = $this->uri->segment('2');
		// $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");

		// $data['supplier'] = $this->Crud->read_data("supplier");
		// $data['customer'] = $this->Crud->read_data("customer");
		$customer = $this->db->query("
			SELECT *
			from customer 
			WHERE  customerType = 'Domestic'");
		$data['customer'] = $customer->result();
		
		$data['transporter'] = $this->Crud->read_data("transporter");

		// $data['customer_part_list'] = $this->Crud->read_data("customer_part");
		// $data['bom_list'] = $this->Crud->read_data("bom");
		// $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");
		//$child_part_list = $this->db->query('SELECT DISTINCT po_number,po_end_date FROM `customer_po_tracking`');
		//$data['new_po'] = $child_part_list->result();
		$data['distanceCol'] = $this->Unit->getClientToCustomerDistanceTbColName();
		$data['consignee_list'] = $this->Crud->read_data_acc("consignee");
		$this->loadView('sales/new_sales', $data);
	}

	public function generate_new_sales()
	{
		
		$customer_id = $this->input->post('customer_id');
		$remark = $this->input->post('remark');
		$clientUnit = $this->Unit->getSessionClientId();
		$mode = $this->input->post('mode');
		$transporter = $this->input->post('transporter');
		$vehicle_number = $this->input->post('vehicle_number');
		$lr_number = $this->input->post('lr_number');
		$part_id = $this->input->post('part_id');
		$distance = $this->input->post('distance');

		$ship_addressType = $this->input->post('ship_addressType');
		$consignee_id = $this->input->post('consignee');
		if(!empty($this->input->post('reused_sales_no'))){
			$reused_sales_no = $this->input->post('reused_sales_no');
		}
	
		$cretd_dt = date('d/m/Y', strtotime($this->current_date));
		$customer_data = $this->Crud->get_data_by_id("customer", $customer_id, "id");

		//if we don't have reused id then generate the new sales number
		if(empty($reused_sales_no)){
			$sql = "SELECT sales_number FROM new_sales WHERE sales_number like '" . $this->getSalesNoFormat(true, true) . "'
				 order by id desc LIMIT 1";
			$latestTempSeqFormat = $this->Crud->customQuery($sql);
			foreach ($latestTempSeqFormat as $p) {
				$currentSaleNo = $p->sales_number;
			}
			$sales_num = $this->getCompleteSalesNumber(true, $currentSaleNo);
		}else{
			$sales_num = $reused_sales_no;
		}

		$data = array(
			"clientId" => $clientUnit,
			"sales_number" => $sales_num,
			"customer_id" => $customer_id,
			"consignee_id" => $consignee_id,
			"shipping_addressType" => $ship_addressType,
			"customer_part_id" => $part_id,
			"remark" => $remark,
			"distance" => $distance,
			"mode" => $mode,
			"transporter_id" => $transporter,
			"vehicle_number" => $vehicle_number,
			"discount" => $customer_data[0]->discount,
			"discountType" => $customer_data[0]->discountType,
			"lr_number" => $lr_number,
			"created_by" => $this->user_id,
			"created_date" => $cretd_dt,
			"created_time" => $this->current_time,
			"created_by" => $this->current_date,
			"created_day" => $this->date,
			"created_month" => $this->month,
			"created_year" => $this->year
		);

		if(empty($reused_sales_no)){
			$result = $this->Crud->insert_data("new_sales", $data);
			if ($result) {
				$new_sales_id = $result;
			}
		} else {
			$result = $this->Crud->update_data_column("new_sales", $data, $sales_num, "sales_number");
			if ($result) {
				$sales_data = $this->Crud->get_data_by_id("new_sales", $sales_num, "sales_number");
				$new_sales_id = $sales_data[0]->id;
			}	
		}

		if ($new_sales_id) {
			// $this->addSuccessMessage('Sales invoice created.');
			// $this->redirectMessage('view_new_sales_by_id/' . $result);
			$ret_arr['url'] = 'view_new_sales_by_id/' . $new_sales_id;
			$ret_arr['sucess'] = 1;
		} else {
			// $this->addErrorMessage('Unable to create sales invoice.');
			// $this->redirectMessage();
			$ret_arr['sucess'] = 0;
		}
		echo json_encode($ret_arr);
	}


	public function generate_new_sales_update()
	{
		
		$id = $this->input->post('id');
		$remark = $this->input->post('remark');
		$mode = $this->input->post('mode');
		$transporter_id = $this->input->post('transporter');
		$vehicle_number = $this->input->post('vehicle_number');
		$lr_number = $this->input->post('lr_number');
		$distance = $this->input->post('distance');
		
		$final_basic_total = $this->input->post('final_basic_total');
		$discountType = $this->input->post('discountType');
		$discount = $this->input->post('discount');
		$isDiscount = $this->input->post('isDiscount');
		$discountValue = $this->input->post('discount_amount');
		
		if($isDiscount === "Yes"){
			$discountType = $this->input->post('discountType');
			$discount = $this->input->post('discount');
        	if (isset($discount) && is_numeric($discount) && $discount > 0) {
                $discountValue = $discount;
                if ($discountType != 'Amount') {
                		$discountValue = number_format($final_basic_total * ($discount / 100),2);
			    }
            }
		}else if($isDiscount === "No"){
			$discountType = 'NA';
			$discount = '0';
		}
		
		$data = array(
			"remark" => $remark,
			//"mode" => $mode,
			"vehicle_number" => $vehicle_number,
			"transporter_id" => $transporter_id,
			"discountType" => $discountType,
			"discount" => $discount,
			"discount_amount" => $discountValue,
			"lr_number" => $lr_number,
			"distance" => $distance,
		);

		$result = $this->Crud->update_data_column("new_sales", $data, $id, "id");
		if ($result) {
			//if($isDiscount === "Yes"){
				//need to update the tax and other amount details based on discount applied. 
				$this->load->model('Sales');
				$this->Sales->update_sales_parts_amountsForDiscounts($id);
			///}
			$this->addSuccessMessage('Sales invoice updated.');
		} else {
			$this->addErrorMessage('Sales invoice not updated.');
		}
		$this->redirectMessage('view_new_sales_by_id/' . $id);
	}


	public function get_customer_parts_for_sale()
	{
		$customer_id = $this->input->post('id');
	    $customer_parts = $this->Crud->get_data_by_id("customer_part", $customer_id, 'customer_id');
		
		if ($customer_parts) {
			$response1 = '';
			$response1 .= '<option value="">Select</option>';
			foreach ($customer_parts as $value) {
				$customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($value->part_number);
				$gst_structure = $this->Crud->get_data_by_id("gst_structure", $value->gst_id, 'id');
				$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $value->id, 'customer_master_id');
				if (!empty($customer_part_rate[0]->rate)) {
					$response1.='<option value="' . $value->id . '">'.$value->part_number . ' // ' . $value->part_description . ' // ' . $customer_parts_master_data[0]->fg_stock . ' // ' . $customer_part_rate[0]->rate . ' // ' . $gst_structure[0]->code . '</option>';
				}
			}
		} else {
			$response1 .= '<option value="">No Parts Defined</option>';
		}
		
		echo $response1;
	}


	public function get_customer_parts_using_po_details_for_sale()
	{
		$po_id = $this->input->post('id');
		//$salesno = $this->input->post('salesno');
		$customer_tracking_parts = $this->Crud->get_data_by_id("parts_customer_trackings", $po_id, 'customer_po_tracking_id');
		//$customer_part = $this->Crud->get_data_by_id("customer_part", $customer_tracking_parts[0]->part_id,'id');

		echo '<select>Select Part Number // Description // FG Stock // Rate // Tax Structure';
		if ($customer_tracking_parts) {
			foreach ($customer_tracking_parts  as $val) {
				$query = "SELECT * FROM customer_part WHERE id = " . $val->part_id . "";
				$result = $this->db->query($query);
				if (count($result) > 0) {
					foreach ($result->result_array() as $key => $value) {
						$customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($value['part_number']);
						$gst_structure = $this->Crud->get_data_by_id("gst_structure", $value['gst_id'], 'id');
						$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $val->part_id, 'customer_master_id');
						$sales_parts = $this->Crud->get_data_by_id("sales_parts", $val->part_id, 'part_id');
						if (!empty($customer_part_rate[0]->rate)) {
							echo '<option value="' . $value['id'] . '">' . $po_id . "-" . $value['part_number'] . ' // ' . $value['part_description'] . ' // ' . $customer_parts_master_data[0]->fg_stock . ' // ' . $customer_part_rate[0]->rate . ' // ' . $gst_structure[0]->code . '</option>';
						}
					}
				}
			}
		} else {
			echo '<option value=""></option>';
		}
		echo '</select>';
	}


	public function view_new_sales_by_id()
	{
		$sales_id = $this->uri->segment('2');
		$data['uri_segment_2'] = $sales_id;
		$data['new_sales'] = $this->Crud->get_data_by_id("new_sales", $sales_id, "id");
		
		$data['customer'] = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		$data['customer_part_details'] = $this->Crud->get_data_by_id("customer_part", $data['new_sales'][0]->customer_part_id, "id");
		$data['session_type'] = $this->session->userdata['type'];
		//$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		//$data['uom'] = $this->Crud->read_data("uom");
		$data['customer_tracking'] = $this->Crud->customQuery('SELECT po.* FROM customer_po_tracking as po, 
		parts_customer_trackings as po_parts 
		WHERE po.po_end_date > CURDATE() AND po.status = "pending" AND po.customer_id =' . $data['new_sales'][0]->customer_id . '
		 AND po.id = po_parts.customer_po_tracking_id AND po_parts.part_id = ' . $data['new_sales'][0]->customer_part_id);


		// pr($data['customer_tracking'],1);
		//old -> $data['customer_tracking'] = $this->Crud->get_data_by_id("customer_po_tracking", $data['new_sales'][0]->customer_id, 'customer_id');

		
		$data['einvoice_res_data'] = $this->Crud->get_data_by_id("einvoice_res", $sales_id, "new_sales_id");
		$data['po_parts'] = $this->Crud->get_data_by_id("sales_parts", $sales_id, "sales_id");
		
		$data['child_part'] = $this->Crud->get_data_by_id("customer_part", $data['new_sales'][0]->customer_id, "customer_id");
		$data['transporter'] = $this->Crud->read_data("transporter");
		// $child_part_list = $this->db->query('SELECT DISTINCT part_number,supplier_id FROM `customer_part` where supplier_id = ' . $data['supplier'][0]->id . '');
		// $data['child_part'] = $child_part_list->result();
		$data['e_invoice_status'] = $this->Crud->get_data_by_id("einvoice_res", $this->uri->segment('2'), "new_sales_id");
		
		
		foreach ($data['po_parts']  as $p) {
			$data['child_part_data'][$p->part_id] = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
			$data['gst_structure2'][$p->part_id] = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
		}
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration", $criteria);
		$data['configuration'] = array_column($configuration, "config_value", "config_name");
		

		$this->loadView('sales/view_new_sales_by_id', $data);
	}

	public function add_sales_parts()
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
		$salesdata = $this->db->query('SELECT * FROM `sales_parts` where sales_id = ' . $sales_id . ' ');
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
		if(isset($config_data['salesPdfSetup'])){
			if($config_data['salesPdfSetup'] == "Single" && $added_saled_count >= 5){
				$msg = "Already 5 Parts Added.";
				$ret_arr['msg'] = $msg;
				$ret_arr['sucess'] = $sucess;
				echo json_encode($ret_arr);
				exit();
			}
		}
		// pr($config_data,1);
		
		$data = array(
			"part_id" => $part_id,
			"sales_number" => $sales_number,
		);
		$check = $this->Crud->read_data_where("sales_parts", $data);
		if ($check) {
				$msg = "Part Already Exists To This Invoice Number , Enter Different Part";
				// $this->addErrorMessage("Part Already Exists To This Invoice Number , Enter Different Part");
				// $this->redirectMessage();
				// exit();
			} else {
			
			$customer_part = $this->Crud->get_data_by_id("customer_part", $part_id, "id");
			if($added_saled_count > 0){
				$tax_val = $salesdata_result[0]->tax_id;
				if($customer_part[0]->gst_id != $tax_val){
					$msg = "Part tax structure should be same.";
					$sucess = 0;
					$ret_arr['msg'] = $msg;
					$ret_arr['sucess'] = $sucess;
					
					echo json_encode($ret_arr);
					exit();
				}
				// pr($tax_val,1);
			}
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
			$customer_po_tracking_data = $this->Crud->get_data_by_id("customer_po_tracking", $po_id, "id");
			$role_management_data = $this->db->query("SELECT SUM(parts.qty) AS MAINSUM from `sales_parts`as parts , 
				new_sales as sales WHERE  parts.part_id = ".$part_id." 
				AND parts.po_number = '".$customer_po_tracking_data[0]->po_number."' 
				AND parts.sales_id = sales.id");
			$used_qty = $role_management_data->row();
			$used_qty = $used_qty->MAINSUM > 0 ? $used_qty->MAINSUM  : 0;
			$total_available_qty = $po_part_details[0]->qty - $used_qty;
			$falg = 0;
			if ($qty > $total_available_qty) {
				$msg = "Insufficient Sales Order balance qty. Sales Order balance qty is " . $total_available_qty;
				// $this->addErrorMessage("Insufficient PO Part balance qty. PO Part balance qty is " . $po_part_details[0]->qty);
				// $this->redirectMessage();
				// exit();
				$falg = 1;
			}
			if($falg == 0){
				$prod_qty_new = 0;
				if ($job_card_data) {
					foreach ($job_card_data as $j) {
						$job_card_prod_qty_ = $this->db->query('SELECT DISTINCT operation_id FROM `job_card_prod_qty` where job_card_id = ' . $j->id . ' ORDER BY operation_id ASC ');
						$job_card_prod_qty_data = $job_card_prod_qty_->result();
						if ($job_card_prod_qty_data) {
							$array_count = count($job_card_prod_qty_data);

							$operation_id_prod = $job_card_prod_qty_data[$array_count - 1]->operation_id;
							$array_main = array(
								"operation_id" => $operation_id_prod,
								"job_card_id" => $j->id,
							);

							$job_card_prod_qty_prod = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $array_main);

							if ($job_card_prod_qty_prod) {
								foreach ($job_card_prod_qty_prod as $jcp) {
									$prod_qty_new = $prod_qty_new + $jcp->production_qty;
								}
							}
						
						} 
					}
				}
				
				if ($qty > $customer_parts_master_data[0]->fg_stock) {
					// $this->addErrorMessage("Please check FG stock");
					// $this->redirectMessage();
					// exit();
					$msg = "Please check FG stock";
				} else {
					$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $part_id, "customer_master_id");
					$total_rate_old = $customer_part_rate[0]->rate * $qty;
					$this->load->model('Sales');
					$discountValue = $this->Sales->isSalesItemDiscount($total_rate_old, $discountType, $discount);
					if($discountValue > 0) {
						$total_rate_old = $total_rate_old - $discountValue;
					}
					$gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $customer_part[0]->gst_id, "id");
					$taxData = $this->Sales->getSalesPartTaxDetails($total_rate_old, $gst_structure2[0]);
					
					/*
						$cgst_amount = ($total_rate_old * $gst_structure2[0]->cgst) / 100;
						$sgst_amount = ($total_rate_old * $gst_structure2[0]->sgst) / 100;
						$igst_amount = ($total_rate_old * $gst_structure2[0]->igst) / 100;

						if ($gst_structure2[0]->tcs_on_tax == "no") {
							$tcs_amount =   (($total_rate_old * $gst_structure2[0]->tcs) / 100);
						} else {
							$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_rate_old) * $gst_structure2[0]->tcs) / 100);
						}
						$gst_amount = $cgst_amount + $sgst_amount + $igst_amount;
						$total_rate = $total_rate_old + $cgst_amount + $sgst_amount + $igst_amount;
					*/
			
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
						"total_rate" => $taxData['total_rate'],
						"gst_amount" => $taxData['gst_amount'],
						"tcs_amount" => $taxData['tcs_amount'],
						"cgst_amount" => $taxData['cgst_amount'],
						"sgst_amount" => $taxData['sgst_amount'],
						"igst_amount" => $taxData['igst_amount'],
						"discounted_amount" => $discountValue,
						"qty" => $this->input->post('qty'),
						"pending_qty" => $this->input->post('qty'),
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

					$result = $this->Crud->insert_data("sales_parts", $data);
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

	public function lock_invoice()
	{

		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$po_parts  = $this->Crud->get_data_by_id("sales_parts", $id, "sales_id");
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
				$sales_data = $this->Crud->get_data_by_id("new_sales", $po_parts[0]->sales_number, "sales_number");
				if ($sales_data[0]->status == 'lock') {
					$isLocked = true;
				} if ($sales_data[0]->status == 'unlocked') {
					$isUnLocked = true;
				}
				 if ($sales_data[0]->status == 'pending') {
					$isReusedInvoice = true;
				}
			// } 
		}
		$messages = "Something went wrong!.";
		$success =0;
		if ($isLocked == false && $isUnLocked == false) {
			if($isReusedInvoice == false) {

				$sql = "SELECT actualSalesNo FROM new_sales WHERE status!='pending' AND sales_number like'" . $this->getSalesNoFormat(false,true) . "' order by actualSalesNo  desc LIMIT 1";
				$latestSalesNo = $this->Crud->customQuery($sql);

				$currentSaleNo = $latestSalesNo[0]->actualSalesNo;
				
				$unique_sales_number  = false;
				$count = 0;
				$new_sales_number = "";
				while (!$unique_sales_number) {
					$new_lockCount = $currentSaleNo + 1;
					$new_sales_number = $this->getLockSalesNumber($new_lockCount);
					$sql = "SELECT * FROM new_sales WHERE sales_number ='" .$new_sales_number. "' LIMIT 1";
					$dublicate_record = $this->Crud->customQuery($sql);
					if(count($dublicate_record[0]) == 0){
						$unique_sales_number = true;
					}else{
						$currentSaleNo += 1;
					}
					$count++;
					if($count > 10){
						$unique_sales_number = true;
					}
				}
			}
			//updated created date when the invoice is locked..
			$cretd_dt = date('d/m/Y', strtotime($this->current_date));

			$data = array(
				"actualSalesNo" => $new_lockCount,
				"status" => $status,
				"total_sales_amount" => $total_sales_amount,
				"total_gst_amount" => $total_gst_amount,
				"discount_amount" => $discount_amount,
				"sales_number" => $new_sales_number,
				"created_date" => $cretd_dt
			);

			//transaction management - as of now not working
			$this->db->trans_start();
			$result = $this->Crud->update_data("new_sales", $data, $id);
			$sale_part_data = array(
				"sales_number" => $new_sales_number,
				"created_date" => $this->current_date
			);
			if ($result) {
				//update sales_parts with new sales number 
				$result = $this->Crud->update_data_column("sales_parts", $sale_part_data, $id, "sales_id");
			}
			$this->db->trans_complete();

			//check if transaction status TRUE or FALSE
			if ($this->db->trans_status() === FALSE) {
				//if something went wrong, rollback everything
				$this->db->trans_rollback();
				// $this->addErrorMessage('Error 410 :  Not Updated');
				// $this->redirectMessage();
				$messages = "Error 410 :  Not Updated";
			} else {
				//if everything went right, commit the data to the database
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
		}else if($isUnLocked) { 
			$cretd_dt = date('d/m/Y', strtotime($this->current_date));
			$sales_data = array(
						"status" => 'lock',
						"total_sales_amount" => $total_sales_amount,
						"total_gst_amount" => $total_gst_amount,
						"discount_amount" => $discount_amount,
						"created_date" => $cretd_dt,
					);
			$result = $this->Crud->update_data("new_sales", $sales_data, $id);
			if ($result) {
					$sale_part_data = array(
						"created_date" => $this->current_date,
					);
					$result = $this->Crud->update_data_column("sales_parts", $sale_part_data, $id, "sales_id");
					if ($po_parts) {
						$this->load->model('Sales');
						$this->Sales->updateFGStockForSales($id, $this->Unit->getSessionClientId(), "lock");
					}
			}
			$success = 1;
			$messages = "Updated Sucessfully.";
			// $this->addSuccessMessage('Updated Sucessfully');
			// $this->redirectMessage();
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

	public function invoice_unlock(){
		$messages = "Something went wrong.";
		$success = 0;
		$id = $this->input->post('sales_id');
		$sales_number = $this->input->post('sales_number');
		$unlock_data = array(
			"status" => 'unlocked'
		);
		$result = $this->Crud->update_data("new_sales", $unlock_data, $id);
		if ($result) {
			$this->load->model('Sales');
			$this->Sales->updateFGStockForSales($id, $this->Unit->getSessionClientId(), "unlock");
			// $this->addSuccessMessage('Sales invoice unlocked.');
			$messages = "Sales invoice unlocked.";
			$success = 1;
		} else {
			$messages = 'Failed to unlock Sales invoice ' . $sales_number;
			// $this->addErrorMessage('Failed to unlock Sales invoice ' . $sales_number);
		}
		// $this->redirectMessage();
		$ret_arr['messages'] = $messages;
		$ret_arr['success'] = $success;
		
		echo json_encode($ret_arr);
		exit();
	}

	public function reuse_invoice() {
		$sales_id = $this->input->post('sales_id');
		$sales_number = $this->input->post('sales_number');

		$removeData = array(
			"status" => 'pending',
			"customer_part_id" => 0,
			"customer_id" => 0,
			"consignee_id" => 0,
			"mode" => NULL,
			"transporter" => NULL,
			"transporter_id" => 0,
			"vehicle_number" => NULL,
			"discount_amount" => 0,
			"discount" => 0,
			"discountType" => 'NA',
			"total_sales_amount" => 0,
			"total_gst_amount" => 0,
			"lr_number" => NULL,
			"remark" => NULL,
			"distance" => NULL
		);
		$messages = "Something went wrong.";
		$success = 0;
		$result = $this->Crud->update_data("new_sales", $removeData, $sales_id);
		if ($result) {
			$sales_part_data = array("sales_id" => $sales_id);
			$result = $this->Crud->delete_data("sales_parts", $sales_part_data);
			if ($result) {
				$messages = 'Sales invoice details removed from '.$sales_number.'. You may reuse sales invoice by using View Details icon.';
				$success = 1;
				// $this->addSuccessMessage('Sales invoice details removed from '.$sales_number.'. You may reuse sales invoice by using View Details icon.');
			}else{
				$messages = 'Failed to remove part details from Sales invoice ' . $sales_number;
				// $this->addErrorMessage('Failed to remove part details from Sales invoice ' . $sales_number);	
			}
		} else {
			$messages = 'Failed to remove details from Sales invoice ' . $sales_number;
			// $this->addErrorMessage('Failed to remove details from Sales invoice ' . $sales_number);
		}
		// $this->redirectMessage("sales_invoice_released");
		$ret_arr['messages'] = $messages;
		$ret_arr['success'] = $success;
		$ret_arr['redirect_url'] = base_url("sales_invoice_released");
		
		echo json_encode($ret_arr);
		exit();
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
			"gst_amount" => 0,
			"discounted_amount" => 0
			
		);

		$cancel_parts = $this->Crud->update_data_column("sales_parts", $sales_part_data, $sales_id,"sales_id");
		$messages = "Something went wrong.";
		$success = 0;
		if($cancel_parts){
			$cancel_data = array(
				"status" => 'Cancelled',
				"total_sales_amount" => 0,
				"total_gst_amount" => 0,
				"discount_amount" => 0
			);

			$result = $this->Crud->update_data("new_sales", $cancel_data, $sales_id);
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
		$result = $this->Crud->delete_data("sales_parts", $sales_part_data);
		$result = $this->Crud->delete_data("new_sales", $data);
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
		$ret_arr['redirect_url'] = base_url("sales_invoice_released");
		
		echo json_encode($ret_arr);
	}

	public function sales_report()
	{
		checkGroupAccess("sales_report","list","Yes");
		if (isset($_POST['export'])) {
			$success = 0;
	        $message = '';

			$searchYear = $this->input->post('search_year');
			$searchMonth = $this->input->post('search_month');
			$sales_ids = $this->input->post('sale_numbers');
			$where_condition = "AND sales.clientId = ".$this->Unit->getSessionClientId()."  ";

			if(!empty($searchYear)) {
					$where_condition = $where_condition."
					AND ((sales.created_year = ".$searchYear." AND sales.created_month >= 4)
					OR
					(sales.created_year = ".($searchYear + 1)." AND sales.created_month <= 3)) ";
			}

			if(empty($sales_ids) && !empty($searchMonth)) {
				$where_condition = $where_condition." AND sales.created_month = ".$searchMonth." ";
			}


			if(!empty($sales_ids)) {
				if(strpos($sales_ids, '-')!== false) { //range selection
					//echo "<br>range selection";
					$serial_range = explode("-", $sales_ids);
					$saleNo_condition = " AND sales.actualSalesNo between ".$serial_range[0]." AND ".$serial_range[1];
				} else if(strpos($sales_ids, ',')!== false) { //specific search
					//echo "<br>list search";
					$serial_list = explode("-", $sales_ids);
					$saleNo_condition = " AND sales.actualSalesNo in ( ".$sales_ids." )";
					/*foreach($serial_list as $list){
						$list_in = $list.",";	
					}*/
					//$where_condition = $where_condition.$list_in.")";
				} else if (strpos($sales_ids, '-')!== false && strpos($sales_ids, ',')!== false ){
					$message = "Incorrect sales number criteria. Can't have both list and range.";
					// echo "<script>alert('Incorrect sales number criteria. Can't have both list and range.');</script>";
					// exit();
	
				} else { //individual sales no
					$saleNo_condition = " AND sales.actualSalesNo = ".$sales_ids;
				}
			}

			
			//combine all the conditions
			$where_condition = $where_condition.$saleNo_condition;
		
			$xmlstr = "<ENVELOPE xmlns:UDF='TallyUDF'></ENVELOPE>";
            // optionally you can specify a xml-stylesheet for presenting the results. just uncoment the following line and change the stylesheet name.
            /* "<?xml-stylesheet type='text/xsl' href='xml_style.xsl' ?>\n". */
			$xml = new SimpleXMLElement($xmlstr);
			// Add the HEADER section
			$header = $xml->addChild('HEADER');
			
			$header->addChild('TALLYREQUEST', 'Export Data');
			//$header->addChild('TYPE', 'Data');
			//$header->addChild('ID', 'YourID'); // Replace with your ID

			// Add the BODY section
			$body = $xml->addChild('BODY');
			$data = $body->addChild('EXPORTDATA');
			$data1 = $data->addChild('REQUESTDESC');
			$data1->addChild('REPORTNAME', 'Vouchers');
			$data2 = $data1->addChild("STATICVARIABLES");
			$data2->addChild('SVCURRENTCOMPANY', "TESTING");	//$this->getCustomerNameDetails()
			$request = $data->addChild('REQUESTDATA');

            $sales_details = $this->Crud->customQuery('SELECT parts.sales_id, parts.sales_number, sales.created_date, customer_name, payment_terms,
			ROUND(sum(total_rate),2) as Total, ROUND(sum(cgst_amount),2) as CGST_AMT, ROUND(sum(sgst_amount),2) as SGST_AMT,
			ROUND(sum(igst_amount),2) as IGST_AMT ,ROUND(sum(tcs_amount),2) as TCS_AMT, ROUND(sum(gst_amount),2) as GST_AMT,
			tax.cgst, tax.sgst, tax.igst, tax.tcs, tax.tcs_on_tax, sales.status,sales.discount_amount,sales.discount, 
            sc.category_name as tally_category
            FROM  sales_parts as parts, gst_structure tax, customer, new_sales as sales
            LEFT JOIN sales_category as sc ON sc.sales_category_id = sales.tally_category
            WHERE sales.status in ("lock")
			AND parts.sales_id =  sales.id
			AND parts.tax_id = tax.id
			AND customer.id = parts.customer_id ' .
                $where_condition .
                ' GROUP BY parts.sales_id '
            );
			// pr($this->db->last_query(),1);
			if(empty($sales_details)){
				$message = "No records found for this export criteria.";
			}
			if ($sales_details) {
					foreach ($sales_details as $sale_details) {
						$this->requestSalesXML($request, $sale_details);
					}
			}

			if($message != ""){

				$return_arr = array(
			        'message' => $message,
			        'success' => 0
			    );

			    echo json_encode($return_arr);
			    exit();
			}
		
			// Set the Content-Type header to specify XML
			//header('Content-Type: text/xml');
			
			// Convert the XML to a string
			//$xmlString = $xml->asXML();
			// Remove the XML declaration manually
			

			$dom = dom_import_simplexml($xml)->ownerDocument;
			// Format the output with indentation and newlines
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			//$dom->loadXML($dom->saveXML(), LIBXML_NOXMLDECL);
			$xmlString = $dom->saveXML();	
			$xmlStringWithoutDeclaration = preg_replace('/<\?xml version="1.0"\?>/', '', $xmlString);

			$filename = $filename = 'dist/uploads/sales_export_tally/tally_sales_'.date(d_m_Y).'.xml';

			file_put_contents($filename, $xmlStringWithoutDeclaration);
			
			$return_arr = array(
			        'pdf_utl' => $this->config->item("base_url").$filename,
			        'message' => "Export successfully.",
			        'pdf_url_file' => 'tally_sales_'.date(d_m_Y).'.xml',
			        'success' => 1
			);

			echo json_encode($return_arr);
			exit();
			
			// Output the XML
			//echo $xml->asXML();
			// Define the file path where you want to save the XML
			//echo "XML file has been saved as $filename";
			exit(); 
		}else{

		$created_month  = $this->input->post("created_month");
		$created_year  = $this->input->post("created_year");

		if (empty($created_year)) {
			$created_year = $this->year;
		}
		if (empty($created_month)) {
			$created_month = $this->month;
		}

		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;
		$data['fincYears'] = $this->Common_admin_model->getFinancialYears();
		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
		
		$column[] = [
            "data" => "customer_name",
            "title" => "CUSTOMER NAME",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "po_number",
            "title" => "Customer PO No",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "salesNumber",
            "title" => "SALES INV NO",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "sales_date",
            "title" => "SALES INV DATE",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "SALES STATUS",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "PART NO",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "PART NAME",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "hsn_code",
            "title" => "HSN",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "QTY",
            "width" => "17%",
            "className" => "dt-center",
        ];
       
        $column[] = [
            "data" => "uom_id",
            "title" => "UOM",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "rate",
            "title" => "Part Price",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "sales_discount",
            "title" => "Discount",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "subtotal",
            "title" => "Taxable Amount",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];
        
        $column[] = [
            "data" => "sgst_amount",
            "title" => "SGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "cgst_amount",
            "title" => "CGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "igst_amount",
            "title" => "IGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		
		$column[] = [
            "data" => "tcs_amount",
            "title" => "TCS",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "gst_amount",
            "title" => "TOTAL GST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "row_total",
            "title" => "TOTAL WITH GS",
            "width" => "7%",
            "className" => "dt-center",
        ];
		
		$date_filter = date("Y/m/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[2, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();

        $current_year = (int) date("Y");
        if(!((int) date("m",1) > 3)){
        	$current_year--;
        }
		$date_filter = date("$current_year/04/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['export_start_date'] = $date_filter[0];
        $data['export_end_date'] = $date_filter[1];
        $data['client_data'] = $this->Crud->read_data("client");
        $config_data = $this->Crud->read_data("global_configuration");
        $config_data = array_column($config_data,"config_value","config_name");
        $data['selected_unit'] = $config_data['allUnitExport'] == "Yes" ? "" : $this->Unit->getSessionClientId();
        $data['all_unit_export'] = $config_data['allUnitExport'];
		$this->loadView('reports/sales_reports', $data);
		}
	}

	public function salesReportsAjax()
	{
		$post_data = $this->input->post();
		// pr($post_data,1);
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
            if ($key == 0) {
                $order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
                $order_by .=
                    "," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
		$data = $this->SalesModel->getSalesReportViewData($condition_arr,$post_data["search"]);
		// pr($data,1);
		$total_balance_amount = 0;
		foreach ($data as $key => $val) {
			if ($val['basic_total'] > 0) {
				$subtotal = $val['basic_total'];
			} else {
				$subtotal = round($val['total_rate'] - $val['gst_amount'], 2);
			}
			$total_balance_amount += $subtotal;
			
			if ($val['part_price'] > 0) {
				$rate = $val['part_price'];
			} else {
				$rate = round($subtotal / $val['qty'], 2);
			}
			if($val['status'] == "Cancelled"){
				$data[$key]['qty'] = 0;
			}
			$row_total =  round($val['total_rate'], 2) + round($val['tcs_amount'], 2);
			$data[$key]['subtotal'] = $subtotal;
			$data[$key]['rate'] =  $rate;
			$data[$key]['sales_discount'] =  ($val['sales_discount'] > 0) ? $val['sales_discount']." %": display_no_character();
			$data[$key]['row_total'] = number_format($row_total, 2);
			
		}
		$data["data"] = $data;
		
        $total_record = $this->SalesModel->getSalesReportViewCount([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();	
	}

	public function generateSalesReportPdf(){
		// pr("ok",1);
		$post_data = $this->input->get();
		// pr($post_data,1);
		$export_data = $this->export_column($post_data);
		$sales_data = $export_data['result_data'];
		$column = $export_data['column'];
		$file_name = $export_data['file_name'];
		$title = $data['title'] = $export_data['title'];
		$data['sales_data'] = $sales_data;
        if($post_data['type'] == 'pdf'){
	        $data['column'] = $column;
	        $data['date'] = $post_data['date'];
	        // pr($data['column'],1);
	        $html_content = $this->smarty->fetch('sales/sales_report_export.tpl', $data, TRUE);
	         // pr($html_content,1);
	        $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false);

	        // Set margins (adjust as needed)
	        $pdf->SetMargins(7, 7, 7, 7);

	        // Set document information
	        $pdf->SetCreator(PDF_CREATOR);

	        // Disable header and footer
	        $pdf->setPrintHeader(false);
	        $pdf->setPrintFooter(false);

	        // Set default monospaced font
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	        // Enable auto page breaks (optional)
	        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	        // Set image scale factor
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	        // Add a page
	        $pdf->AddPage();

	        // set some text to print
	        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

	        // output the HTML content
	        $pdf->writeHTML($html_content, true, false, true, false, '');

	        $pdf->Output("$file_name.pdf", 'D');
	        ob_end_flush();
	    }else{
	        $csv_column = [];
	        foreach ($column as $key => $value) {
	        	array_push($csv_column, $value['title']);
	        }
	        $csv_output = [];
	        foreach ($sales_data as $key => $value) {
	        	$row_data = [];
	        	foreach ($column as $key_val => $val) {
	        		array_push($row_data, $value[$val['data']]);
	        	}
	        	array_push($csv_output, $row_data);
	        }
	        
	      	
	        // Set headers to force download
	        header('Content-Type: text/csv');
	        header('Content-Disposition: attachment; filename="'.$file_name.'.csv"');
	        header('Pragma: no-cache');
	        header('Expires: 0');

	        // Open PHP output stream for the CSV file
	        $output = fopen('php://output', 'w');
	        
	        $extra_row = ['Date : '.$post_data['date']];  // Customize as needed
			fputcsv($output, $extra_row);
	        // Optional: Add column headers to the CSV file
	        fputcsv($output, $csv_column);

	        // Loop through the data and write to the CSV file
	        foreach ($csv_output as $row) {
	            fputcsv($output, $row);  // Each $row should be an array
	        }

	        // Close the output stream
	        fclose($output);
        }
	}

	public function export_column($post_data = []){
		$return_arr = [];
		$type = $post_data['report_type'];
		if($type == "sales"){
			$return_arr['column'] = [
				[
		            "data" => "client_name",
		            "title" => "Unit",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
				[
		            "data" => "customer_name",
		            "title" => "CUSTOMER NAME",
		            "width" => "14%",
		            "className" => "dt-left",
		        ],
		        [
		            "data" => "po_number",
		            "title" => "Customer PO No",
		            "width" => "16%",
		            "className" => "dt-left",
		        ],
		        [
		            "data" => "salesNumber",
		            "title" => "SALES INV NO",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "sales_date",
		            "title" => "SALES INV DATE",
		            "width" => "10%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "status",
		            "title" => "SALES STATUS",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "part_number",
		            "title" => "PART NO",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "part_description",
		            "title" => "PART NAME",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "hsn_code",
		            "title" => "HSN",
		            "width" => "7%",
		            "className" => "dt-center status-row",
		        ],
		        [
		            "data" => "qty",
		            "title" => "QTY",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "uom_id",
		            "title" => "UOM",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "rate",
		            "title" => "Part Price",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "sales_discount",
		            "title" => "Discount",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "subtotal",
		            "title" => "Taxable Amount",
		            "width" => "7%",
		            "className" => "dt-center",
		            'orderable' => false
		        ],
		        [
		            "data" => "sgst_amount",
		            "title" => "SGST",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "cgst_amount",
		            "title" => "CGST",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "igst_amount",
		            "title" => "IGST",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "tcs_amount",
		            "title" => "TCS",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "gst_amount",
		            "title" => "TOTAL GST",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "row_total",
		            "title" => "TOTAL WITH GS",
		            "width" => "7%",
		            "className" => "dt-center",
		        ]
	        ];
	        $sales_data = $this->SalesModel->getSalesReportExportData($post_data);
	        foreach ($sales_data as $key => $val) {
				if ($val['basic_total'] > 0) {
					$subtotal = $val['basic_total'];
				} else {
					$subtotal = round($val['total_rate'] - $val['gst_amount'], 2);
				}
				$total_balance_amount += $subtotal;
				
				if ($val['part_price'] > 0) {
					$rate = $val['part_price'];
				} else {
					$rate = round($subtotal / $val['qty'], 2);
				}
				if($val['status'] == "Cancelled"){
					$sales_data[$key]['qty'] = 0;
				}
				$row_total =  round($val['total_rate'], 2) + round($val['tcs_amount'], 2);
				$sales_data[$key]['subtotal'] = $subtotal;
				$sales_data[$key]['rate'] =  $rate;
				$sales_data[$key]['sales_discount'] =  ($val['sales_discount'] > 0) ? $val['sales_discount']." %": display_no_character();
				$sales_data[$key]['row_total'] = $row_total;	
			}
			$return_arr['result_data'] = $sales_data;
			$return_arr['file_name'] = "sales_report";
			$return_arr['title'] = "Sales Report";

	    }else if($type == "grn"){
	    	$return_arr['column'] = [
	    		[
		            "data" => "client_name",
		            "title" => "Unit",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
				[
		            "data" => "supplier_name",
		            "title" => "Supplier name",
		            "width" => "14%",
		            "className" => "dt-left",
		        ],
		        [
		            "data" => "part_number",
		            "title" => "Part No",
		            "width" => "16%",
		            "className" => "dt-left",
		        ],
		        [
		            "data" => "part_description",
		            "title" => "Part Description",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "rate",
		            "title" => "Part Rate",
		            "width" => "10%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "hsn_code",
		            "title" => "HSN",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "uom_name",
		            "title" => "UOM",
		            "width" => "17%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "poNumber",
		            "title" => "PO No",
		            "width" => "7%",
		            "className" => "dt-center text-nowrap",
		        ],
		        [
		            "data" => "po_date",
		            "title" => "PO Date",
		            "width" => "7%",
		            "className" => "dt-center text-nowrap",
		        ],
		        [
		            "data" => "grn_number",
		            "title" => "GRN No",
		            "width" => "17%",
		            "className" => "dt-center text-nowrap",
					
		        ],
		        [
		            "data" => "grn_created_date",
		            "title" => "GRN Date",
		            "width" => "7%",
		            "className" => "dt-center text-nowrap",
		        ],
		        [
		            "data" => "invoice_number",
		            "title" => "Invoice Number",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "invoice_date",
		            "title" => "Invoice Date",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "po_qty",
		            "title" => "PO Qty",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "total_accept_qty",
		            "title" => "Accepted QTY",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "base_amount",
		            "title" => "Basic Amount",
		            "width" => "7%",
		            "className" => "dt-center status-row",
		        ],
		        [
		            "data" => "sgst_amount",
		            "title" => "SGST",
		            "width" => "17%",
		            "className" => "dt-center",
					
		        ],
		        [
		            "data" => "cgst_amount",
		            "title" => "CGST",
		            "width" => "7%",
		            "className" => "dt-center",
		        ],
		        [
		            "data" => "igst_amount",
		            "title" => "IGST",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "tcs_amount",
		            "title" => "TCS",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "gst_amount",
		            "title" => "GST Total",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ],
		        [
		            "data" => "total_with_gst",
		            "title" => "Total Amount With GST",
		            "width" => "7%",
		            "className" => "dt-center",
					'orderable' => false
		        ]
		    ];
		    $data = $this->SalesModel->getGNRepotExportData($post_data);
			foreach($data as $k=>$v){
				$data[$k]['po_date']= defaultDateFormat($v['po_date']);
				$data[$k]['invoice_date'] = defaultDateFormat($v['invoice_date']);
				$data[$k]['grn_created_date'] = defaultDateFormat($v['grn_created_date']);
				$gst_amount = $v['sgst_amount'] + $v['cgst_amount'] + $v['igst_amount'] + $v['tcs_amount'];
				// Calculate total_with_gst
				$total_with_gst = $gst_amount + $v['base_amount'];
				// Initialize tcs_amount
				$tcs_amount = 0;
				// Check if tcs_amount is not empty and assign its value
				if (!empty($v['tcs_amount'])) {
					$tcs_amount = $g->tcs_amount;
				}
				$data[$k]['gst_amount'] = $gst_amount;
				$data[$k]['total_with_gst'] = number_format($total_with_gst,2,".","");
				$data[$k]['tcs_amount'] = $tcs_amount;
			}
			$return_arr['result_data'] = $data;
			$return_arr['file_name'] = "grn_report";
			$return_arr['title'] = "GRN Report";

	    }else if($type == "sales_summary"){
	    	$return_arr['column'] = [
	    		[
		            "data" => "client_name",
		            "title" => "Unit",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
			    [
			        "data" => "customer_name",
			        "title" => "Customer Name",
			        "width" => "25%",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "po_number",
			        "title" => "Customer PO NO",
			        "width" => "25%",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "salesNumber",
			        "title" => "Sales Inv No",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "sales_date",
			        "title" => "Sales Invoice Date",
			        "width" => "25%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "status",
			        "title" => "Sales Status",
			        "width" => "25%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "vehicle_number",
			        "title" => "Vehicle Number",
			        "width" => "25%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "qty",
			        "title" => "Total Qty",
			        "width" => "25%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "subtotal",
			        "title" => "Taxable Value",
			        "width" => "7%",
			        "className" => "dt-center status-row",
			    ],
			    [
			        "data" => "total_discount_amount",
			        "title" => "Discount(₹)",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "sgst_amount",
			        "title" => "SGST",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "cgst_amount",
			        "title" => "CGST",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "igst_amount",
			        "title" => "IGST",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "tcs_amount",
			        "title" => "TCS",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "total_gst_amount",
			        "title" => "TOTAL GST",
			        "width" => "17%",
			        "className" => "dt-center due_days_block",
			    ],
			    [
			        "data" => "row_total",
			        "title" => "Total With GST",
			        "width" => "7%",
			        "className" => "dt-center",
			    ]
			];

		    $data = $this->SalesModel->getSalesSummaryRepotExportData($post_data);
			foreach ($data as $key => $po) {
	            if($po['basic_total'] > 0 ) {
	                $subtotal = $po['basic_total'];
	            }else{
	                $subtotal =  $po['total_rate'] - $po['gst_amount'];
	            }
	            
	            $data[$key]['subtotal'] = $subtotal;
	            if ($po['part_price'] > 0) {
	                $rate = $po['part_price'];
	            }else{
	                $rate = round((float) $subtotal / (float) $po['qty'], 2);
	            }
	            $data[$key]['rate'] = $rate;
	            $row_total = $po['total_sales_amount'];
	            $data[$key]['row_total'] = $row_total;

	            $gst_structure = $this->Crud->get_data_by_id("gst_structure", $po['taxid'], "id");
	            $sales_total = $this->Crud->tax_calcuation($gst_structure[0], $subtotal, $po['total_discount_amount']);
	            $data[$key]['sgst_amount']  = $sales_total["sales_sgst"];
	            $data[$key]['cgst_amount'] = $sales_total["sales_cgst"];
	            $data[$key]['igst_amount']  = $sales_total["sales_igst"];
	            $data[$key]['tcs_amount'] = $sales_total["sales_tcs"];
	        } 

			$return_arr['result_data'] = $data;
			$return_arr['file_name'] = "sales_summary_report";
			$return_arr['title'] = "GRN Report";

	    }else if($type == "grn_summary"){
	    	$return_arr['column'] = [
	    		[
		            "data" => "client_name",
		            "title" => "Unit",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
			    [
			        "data" => "supplier_name",
			        "title" => "Supplier Name",
			        "width" => "150px",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "poNumber",
			        "title" => "PO No",
			        "width" => "25%",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "po_date",
			        "title" => "PO Date",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "grn_number",
			        "title" => "GRN No",
			        "width" => "80px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "grn_created_date",
			        "title" => "GRN Date",
			        "width" => "100px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "invoice_number",
			        "title" => "Invoice Number",
			        "width" => "150px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "invoice_date",
			        "title" => "Invoice Date",
			        "width" => "120px",
			        "className" => "dt-center status-row",
			    ],
			    [
			        "data" => "po_qty",
			        "title" => "PO Qty",
			        "width" => "80px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "accept_qty",
			        "title" => "Total QTY",
			        "width" => "100px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "base_amount",
			        "title" => "Basic Amount",
			        "width" => "120px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "sgst_amount",
			        "title" => "SGST",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "cgst_amount",
			        "title" => "CGST",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "igst_amount",
			        "title" => "IGST",
			        "width" => "17%",
			        "className" => "dt-center due_days_block",
			    ],
			    [
			        "data" => "tcs_amount",
			        "title" => "TCS",
			        "width" => "7%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "gst_amount",
			        "title" => "GST Total",
			        "width" => "90px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "total_with_gst",
			        "title" => "Total Amount With GST",
			        "width" => "160px",
			        "className" => "dt-center",
			        "orderable" => false,
			    ]
			];


		    $data = $this->SalesModel->getGrnSummaryReportExportData($post_data);
			foreach ($data as $key => $g) {
	            $gst_amount = (float)($g['sgst_amount'] + $g['cgst_amount'] + $g['igst_amount'] + $g['tcs_amount']);
	            $total_with_gst = $gst_amount + $g['base_amount'];
	            // $data[$key]['gst_amount'] = $gst_amount;
	            $data[$key]['total_with_gst']  = $total_with_gst;
	            $data[$key]['po_date']  = defaultDateFormat($g['po_date']);
	            $data[$key]['grn_created_date']  = defaultDateFormat($g['grn_created_date']);
	            $data[$key]['invoice_date']  = defaultDateFormat($g['invoice_date']);            
	        }  

			$return_arr['result_data'] = $data;
			$return_arr['file_name'] = "grn_summary_report";
			$return_arr['title'] = "GRN Report";

	    }else if($type == "payable"){
	    	$return_arr['column'] = [
	    		[
		            "data" => "client_name",
		            "title" => "Unit",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
			    [
			        "data" => "supplier_name",
			        "title" => "Supplier name",
			        "width" => "150px",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "grn_number",
			        "title" => "GRN No",
			        "width" => "100px",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "grn_created_date",
			        "title" => "GRN Date",
			        "width" => "100px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "invoice_number",
			        "title" => "Invoice Number",
			        "width" => "150px",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "invoice_date",
			        "title" => "Invoice Date",
			        "width" => "150px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "base_amount",
			        "title" => "Basic Amount",
			        "width" => "120px",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "sgst_amount",
			        "title" => "SGST",
			        "width" => "3%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "cgst_amount",
			        "title" => "CGST",
			        "width" => "3%",
			        "className" => "dt-center status-row",
			    ],
			    [
			        "data" => "igst_amount",
			        "title" => "IGST",
			        "width" => "3%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "tcs_amount",
			        "title" => "TCS",
			        "width" => "3%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "gst_amount",
			        "title" => "GST Total",
			        "width" => "120px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "total_with_gst",
			        "title" => "Total Amount With GST",
			        "width" => "150px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "payment_days",
			        "title" => "Payment Terms in Days",
			        "width" => "150px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "due_date",
			        "title" => "Due Date",
			        "width" => "10%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "due_days",
			        "title" => "Due Days",
			        "width" => "10%",
			        "className" => "dt-center due_days_block",
			        "orderable" => false,
			    ],
			    [
			        "data" => "amount_received",
			        "title" => "Amount Paid",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "tds_amount",
			        "title" => "TDS",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "bal_amnt",
			        "title" => "Balance Amount to Pay",
			        "width" => "150px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "payment_receipt_date",
			        "title" => "Payment Paid Date",
			        "width" => "150px",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "transaction_details",
			        "title" => "Transaction Details",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "remarks",
			        "title" => "Remark",
			        "width" => "17%",
			        "className" => "dt-center",
			    ]
			];



		    $data = $this->SalesModel->getPayableReportExportData($post_data);
			foreach ($data as $key => $objs) {
	            $gst_amount = (float)($objs['sgst_amount'] + $objs['cgst_amount'] + $objs['igst_amount'] + $objs['tcs_amount']);
	            $data[$key]['gst_amount'] = number_format($gst_amount,2,".","");
	            $created_date_str = $objs['grn_created_date'];  
	            $total_with_gst = $gst_amount + $objs['base_amount'];  
	            $data[$key]['total_with_gst'] = $total_with_gst;
	            $total_with_gst_val += $total_with_gst > 0 ? $total_with_gst : 0;
	            $total_paid_amount += $value['amount_received'] > 0 ? $value['amount_received'] : 0;
	            $total_balance_amount_to_pay += $value['bal_amnt'] > 0 ? $value['bal_amnt'] : 0;
	            $total_tds_amount += $value['tds_amount'] > 0 ? $value['tds_amount'] : 0;
	            $tcs_amount = 0;
	            if(!empty($objs['tcs_amount'])){
	                $tcs_amount = $objs['tcs_amount'];
	            }   
	            $data[$key]['tcs_amount'] = number_format($tcs_amount,2,".","");                          
	            // Create a DateTime object by specifying the format
	            $dateTime = DateTime::createFromFormat('d-m-Y', $created_date_str);
	            $due_date = display_no_character("");
	            if ($dateTime && is_numeric($objs['payment_days'])) {
	                // Convert payment_terms to an integer for days
	                $payment_terms_days = (int)$objs['payment_days'];
	                // Add payment_terms (in days) to the created date
	                $dateTime->add(new DateInterval('P' . $payment_terms_days . 'D'));
	                // Get the formatted due date
	                $due_date = $dateTime->format('d/m/Y');
	                $due_date = defaultDateFormat($due_date);
	            }
	            $data[$key]['due_date'] = $due_date;

	            $today = new DateTime();
	            // Convert due date string to a DateTime object
	            $due_days = display_no_character("");
	            if($due_date != display_no_character("")){
	                if(!empty($objs['payment_receipt_date'])){
	                    $sales_date = $objs['grn_created_date'];

	                    $sales_date = DateTime::createFromFormat("d-m-Y", $sales_date);
	                    // Format to the desired output
	                    $sales_date = $sales_date->format("Y-m-d");
	                    $payment_receipt_date = $objs['payment_receipt_date'];
	                    $sales_date = new DateTime($sales_date);
	                    $payment_receipt_date = new DateTime($payment_receipt_date);
	                    // Calculate the difference
	                    $interval = $sales_date->diff($payment_receipt_date);

	                    // Get the difference in days
	                    $due_days = $interval->days;
	                }else{
	                    $dueDateObject = DateTime::createFromFormat('d/m/Y', $due_date);
	                     // Calculate the interval between the due date and today's date
	                    $interval = $today->diff($dueDateObject);
	                    // Get the difference in days
	                    $due_days = $interval->format('%r%a'); // This will give the difference in days with respect to today's date
	                }
	                
	               
	                $due_days_status = "normal";
	                if($due_days <= 0 && empty($objs['payment_receipt_date']))
	                {
	                    $due_days_status = "danger";
	                }
	            }
	            
	            $data[$key]['due_days'] = $due_days;
	            $data[$key]['due_days_status'] = $due_days_status;

	            $bal_amnt = $total_with_gst - $objs['amount_received'] - $objs['tds_amount'];
	            $data[$key]['bal_amnt'] = number_format($bal_amnt, 2, '.', '');    
	            $data[$key]['action']= display_no_character("");
	            if($objs['total_accept_qty'] > 0 && checkGroupAccess("payable_report","update","No")){
	                $data[$key]['action'] = "<a href='javascript:void(0)' class='add-payable-report' data-grn-number='".$objs['grn_number']."' data-amount-paid='".$objs['amount_received']."' data-bal-amnt='".$bal_amnt."' data-transaction-details='".$objs['transaction_details']."' data-payment-receipt-date='".$objs['payment_receipt_date']."' data-tds='".$objs['tds_amount']."'><i class='ti ti-edit'></i></a>";
	            }

	            $data[$key]['grn_created_date'] = defaultDateFormat($objs['grn_created_date']);
	            $data[$key]['invoice_date'] = defaultDateFormat($objs['invoice_date']);
	            $data[$key]['payment_receipt_date'] = defaultDateFormat($objs['payment_receipt_date']);  
	             $data[$key]['base_amount'] = number_format($objs['base_amount'],2,".","");
	            $data[$key]['cgst_amount'] = number_format($objs['cgst_amount'],2,".","");
	            $data[$key]['sgst_amount'] = number_format($objs['sgst_amount'],2,".","");
	            $data[$key]['igst_amount'] = number_format($objs['igst_amount'],2,".","");                                
	                                                                                
	        }   
	        // pr(count($data),1);
			$return_arr['result_data'] = $data;
			$return_arr['file_name'] = "payable_report";
			$return_arr['title'] = "Payable Report";

	    }else if($type == "receivable"){
	    	$return_arr['column'] = [
	    		[
		            "data" => "client_name",
		            "title" => "Unit",
		            "width" => "17%",
		            "className" => "dt-center",
		        ],
			    [
			        "data" => "customer_name",
			        "title" => "CUSTOMER NAME",
			        "width" => "14%",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "sales_number",
			        "title" => "Sales Inv No",
			        "width" => "16%",
			        "className" => "dt-left",
			    ],
			    [
			        "data" => "created_date_val",
			        "title" => "Sales Inv Date",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "subtotal",
			        "title" => "Basic Amount Total",
			        "width" => "10%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "gst",
			        "title" => "GST Total Amount",
			        "width" => "17%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "row_total",
			        "title" => "Total Amount With GST",
			        "width" => "17%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "payment_terms",
			        "title" => "Payment Terms in Days",
			        "width" => "7%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "due_date",
			        "title" => "Due Date",
			        "width" => "7%",
			        "className" => "dt-center status-row",
			    ],
			    [
			        "data" => "due_days",
			        "title" => "Due Days",
			        "width" => "17%",
			        "className" => "dt-center due_days_block",
			    ],
			    [
			        "data" => "amount_received",
			        "title" => "Amount Received",
			        "width" => "7%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "tds_amount",
			        "title" => "TDS",
			        "width" => "7%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "bal_amnt",
			        "title" => "Balance Amount to Receive",
			        "width" => "7%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "payment_receipt_date_formated",
			        "title" => "Payment Receipt Date",
			        "width" => "7%",
			        "className" => "dt-center",
			    ],
			    [
			        "data" => "transaction_details",
			        "title" => "Transaction Details",
			        "width" => "7%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "remark_val",
			        "title" => "Remark",
			        "width" => "7%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ],
			    [
			        "data" => "action",
			        "title" => "Action",
			        "width" => "7%",
			        "className" => "dt-center",
			        "orderable" => false,
			    ]
			];




		    $data = $this->SalesModel->getReceivableReportExportData($post_data);
			foreach ($data as $key => $objs) {
				$date_convert = DateTime::createFromFormat('d-m-Y', $objs['created_date']);
				// Format the date to d/m/Y
				$objs['created_date'] = $date_convert->format('d/m/Y');

				$created_date_str = $objs['created_date'];
	            
				$payment_receipt_date_formated  = '';
				$subtotal = round($objs['ttlrt'] - $objs['gstamnt'], 2);
				$row_total = round($objs['ttlrt'], 2) + round($objs['tcsamnt'], 2);
				if (($objs['payment_receipt_date'] != '')) {
					$payment_receipt_date_formated =  date("d/m/Y", strtotime($objs['payment_receipt_date']));
				}
				$data[$key]['subtotal'] = $subtotal;
				$data[$key]['row_total'] = number_format($row_total,2,".","");
				$data[$key]['payment_receipt_date_formated'] = $payment_receipt_date_formated;
				$tds_amount = $data[$key]['tds_amount'] = $objs['tds_amount'] > 0 ? $objs['tds_amount'] : 0;

				// $data[$key]['bal_amnt'] = $row_total - $val['amount_received'] - $tds_amount;

				// Create a DateTime object by specifying the format
				$dateTime = DateTime::createFromFormat('d/m/Y', $created_date_str);
				$due_date = display_no_character("");
				
				if ($dateTime && is_numeric($objs['payment_terms'])) {
					// Convert payment_terms to an integer for days
					$payment_terms_days = (int)$objs['payment_terms'];
			
					// Add payment_terms (in days) to the created date
					$dateTime->add(new DateInterval('P' . $payment_terms_days . 'D'));
			
					// Get the formatted due date
					$due_date = $dateTime->format('d/m/Y');
			
					
				}

				$today = new DateTime();
	        
				$due_days_status = display_no_character("");

	            if($due_date != display_no_character("")){
	            	if(!empty($objs['payment_receipt_date']) && $objs['payment_receipt_date'] != "" && $objs['payment_receipt_date'] != NULL ){

	            		$sales_date = $objs['created_date'];
	            		$sales_date = DateTime::createFromFormat("d/m/Y", $sales_date);
						// Format to the desired output
						$sales_date = $sales_date->format("Y-m-d");
	            		$payment_receipt_date = $objs['payment_receipt_date'];
	            		$sales_date = new DateTime($sales_date);
						$payment_receipt_date = new DateTime($payment_receipt_date);
						// Calculate the difference
						$interval = $sales_date->diff($payment_receipt_date);

						// Get the difference in days
						$due_days = $interval->days;

	                }else{
	                    $dueDateObject = DateTime::createFromFormat('d/m/Y', $due_date);
	                    // Calculate the interval between the due date and today's date
						$interval = $today->diff($dueDateObject);
						
						// Get the difference in days
						$due_days = $interval->format('%r%a');
	                }
	            	

					$due_days_status = "normal";
	                if($due_days <= 0 && empty($objs['payment_receipt_date']))
	                {
	                    $due_days_status = "danger";
	                }

				}

				$data[$key]['due_date'] = $due_date;
				$data[$key]['due_days'] = $due_days;
				$data[$key]['due_days_status'] = $due_days_status;
			}   
	        // pr(count($data),1);
			$return_arr['result_data'] = $data;
			$return_arr['file_name'] = "receivalbe_report";
			$return_arr['title'] = "Receivable Report";

	    }
	    // pr($return_arr,1);
	    return $return_arr;
	}
	public function hsn_report()
	{
		checkGroupAccess("sales_report","list","Yes");

		$created_month  = $this->input->post("created_month");
		$created_year  = $this->input->post("created_year");

		if (empty($created_year)) {
			$created_year = $this->year;
		}
		if (empty($created_month)) {
			$created_month = $this->month;
		}

		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;
		$data['fincYears'] = $this->Common_admin_model->getFinancialYears();
		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
		
		$data['customer'] = $this->Crud->read_data("customer");
		// pr($data,1);
        $column[] = [
            "data" => "hsn_code",
            "title" => "HSN",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "customer_name",
            "title" => "CUSTOMER NAME",
            "width" => "14%",
            "className" => "dt-left",
            "visible" => false
        ];
        $column[] = [
            "data" => "qty",
            "title" => "Total Sales QTY",
            "width" => "17%",
            "className" => "dt-center",
        ];
       
        
        $column[] = [
            "data" => "subtotal",
            "title" => "Basic Amount",
            "width" => "15%",
            "className" => "dt-center",
            'orderable' => false
        ];
        
        $column[] = [
            "data" => "sgst_amount",
            "title" => "SGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "cgst_amount",
            "title" => "CGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "igst_amount",
            "title" => "IGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		
		$column[] = [
            "data" => "tcs_amount",
            "title" => "TCS",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "gst_amount",
            "title" => "TOTAL GST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "row_total",
            "title" => "TOTAL Amount",
            "width" => "7%",
            "className" => "dt-center",
        ];
		// pr(date('Y-m-d', strtotime('last month')),1);
		$date_filter = date('Y/m/01', strtotime('first day of last month')) . " - " . date('Y/m/t', strtotime('last day of last month'));
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[2, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
		$this->loadView('reports/hsn_reports', $data);
		
	}

	public function hsnReportsAjax()
	{
		$post_data = $this->input->post();
		// pr($post_data,1);
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
            if ($key == 0) {
                $order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
                $order_by .=
                    "," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
		$data = $this->SalesModel->getHsnReportViewData($condition_arr,$post_data["search"]);
		$unique_data = [];
		$total_balance_amount = 0;
		foreach ($data as $key => $val) {

			if ($val['basic_total'] > 0) {
				$subtotal = $val['basic_total'];
			} else {
				$subtotal = round($val['total_rate'] - $val['gst_amount'], 2);
			}
			$total_balance_amount += $subtotal;
			
			if ($val['part_price'] > 0) {
				$rate = $val['part_price'];
			} else {
				$rate = round($subtotal / $val['qty'], 2);
			}
			$row_total =  round($val['total_rate'], 2) + round($val['tcs_amount'], 2);
			$data[$key]['subtotal'] = $subtotal;
			$data[$key]['rate'] =  $rate;
			$data[$key]['sales_discount'] =  ($val['sales_discount'] > 0) ? $val['sales_discount']." %": display_no_character();
			$data[$key]['row_total'] = $row_total;
			$hsn_code = trim($val['hsn_code']);
			if(!array_key_exists($hsn_code, $unique_data)){
				$unique_data[$hsn_code] = [
					"hsn_code" => $val['hsn_code'],
					"customer_name" => $val['customer_name'],
					"qty" => $val['qty'],
					"subtotal" => $subtotal,
					"sgst_amount" => $val['sgst_amount'],
					"cgst_amount" => $val['cgst_amount'],
					"igst_amount" => $val['igst_amount'],
					"tcs_amount" => $val['tcs_amount'],
					"gst_amount" => $val['gst_amount'],
					"row_total" => number_format($row_total,2,".","")
				];
			}else{
				$unique_data[$hsn_code]['qty'] += $val['qty'];
				$unique_data[$hsn_code]['subtotal'] += $subtotal;
				$unique_data[$hsn_code]['customer_name'] .= ",".$val['customer_name'];
				$unique_data[$hsn_code]['sgst_amount'] += $val['sgst_amount'];
				$unique_data[$hsn_code]['cgst_amount'] += $val['cgst_amount'];
				$unique_data[$hsn_code]['igst_amount'] += $val['igst_amount'];
				$unique_data[$hsn_code]['tcs_amount'] += $val['tcs_amount'];
				$unique_data[$hsn_code]['gst_amount'] += $val['gst_amount'];
				$unique_data[$hsn_code]['row_total'] += number_format($row_total,2,".","");
			}
			

			
		}
		$data["data"] = array_values($unique_data);
		
        $total_record = $this->SalesModel->getHsnReportViewCount([], $post_data["search"]);
        $unique_data = [];
        foreach ($total_record as $key => $val) {
			$hsn_code = trim($val['hsn_code']);
			if(!array_key_exists($hsn_code, $unique_data)){
				$unique_data[$hsn_code] = [
					"hsn_code" => $val['hsn_code']
				];
			}			
		}
        $data["total_qty"] = number_format(array_sum(array_column($total_record, "qty")),2,".",",");
        $data["total_rate"] = number_format(array_sum(array_column($total_record, "total_rate"))+array_sum(array_column($total_record, "tcs_amount")),2,".",",");
        $data["recordsTotal"] = count($unique_data);
        $data["recordsTotal"] = count($unique_data);
        $data["recordsFiltered"] = count($unique_data);
        echo json_encode($data);
        exit();
		
	}



	private function getPage($viewPage, $viewData)
	{
		$this->getHeaderPage();
		$this->load->view($this->getViewPath() . $viewPage, $viewData);
		$this->load->view('footer.php');
	}

	public function rejection_invoices()  
	{
		checkGroupAccess("rejection_invoices","list","Yes");
		$sales_id = $this->uri->segment('2');

		$data['new_sales'] = $this->Crud->get_data_by_id("new_sales", $sales_id, "id");
		if(isset($data['new_sales'][0]->created_date)){
			$date = DateTime::createFromFormat('d/m/Y', $data['new_sales'][0]->created_date);
			$data['new_sales'][0]->created_date = $date->format('Y-m-d');
		}
		$data['new_sales'] = $data['new_sales'][0];
		$data['customer'] = $this->Crud->read_data("customer");
		// $data['rejection_sales_invoice'] = $this->Crud->read_data("rejection_sales_invoice");
		$sql = "
			SELECT r.*,CONCAT(t.name,'-' ,t.transporter_id) as transporter
			FROM rejection_sales_invoice as r
			LEFT JOIN transporter as t On t.id = r.transporter_id 
			LEFT JOIN customer as c On c.id = r.customer_id";
		$data['rejection_sales_invoice'] = $this->Crud->customQuery($sql);
		$data['reject_remark'] = $this->Crud->read_data_acc("reject_remark");
		$data['transporter'] = $this->Crud->read_data("transporter");
		$data['mode'] = ["N/A","Road","Rail","Air","Ship"];
		$this->loadView('quality/rejection_invoices', $data);
		// $this->load->view('footer');	

	}

	public function generate_credit_note(){
		$credit_note_id = $this->uri->segment('2');
		$copy = $this->uri->segment('3');
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        $company_logo = "";
        $company_logo_enable = "No";
        $row_col_span = '12';
        if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                 $company_logo = $configuration['companyLogo'];
                $company_logo_enable = "Yes";
                $company_logo = '<td width="10%" colspan="2" style="text-align:center;"><img src="'.base_url('').'/dist/img/company_logo/'.$company_logo.'"  style="width: 60px;padding: 0px;"></td>';
                $row_col_span = '10';
            }
        }
        $data['company_logo'] =$company_logo;
        $sql = "
			SELECT r.*,CONCAT(t.name,'-' ,t.transporter_id) as transporter,t.transporter_id as transporter_id
			FROM rejection_sales_invoice as r
			LEFT JOIN transporter as t On t.id = r.transporter_id
			WHERE r.id =".$credit_note_id;
		$rejection_sales_invoice = $this->Crud->customQuery($sql);
		$data['rejection_sales_invoice'] = $rejection_sales_invoice[0];
        $client_data = $this->Crud->get_data_by_id("client", $rejection_sales_invoice[0]->clientId, "id");
        $data['client_data'] = $client_data[0];
        $customer_data = $this->Crud->get_data_by_id("customer", $rejection_sales_invoice[0]->customer_id, "id");
        $data['customer_data'] = $customer_data[0];
        $credit_note[0]->shipping_addressType = "customer";
        $data['shipping_data'] = $this->getShippingDetails($credit_note, $customer_data);
		$sql = "
			SELECT pr.*,cp.part_number as part_number,cp.part_number as part_number,cp.part_description as part_description,cp.hsn_code as hsn_code,cp.uom as uom,cp.packaging_qty as packaging_qty,cpm.fg_rate as rate,gs.cgst as cgst,gs.sgst as sgst,gs.igst as igst,gs.tcs as tcs,gs.tcs_on_tax as tcs_on_tax
			FROM parts_rejection_sales_invoice as pr
			LEFT JOIN customer_part as cp On cp.id = pr.part_id
			LEFT JOIN gst_structure as gs On gs.id = cp.gst_id
			LEFT JOIN customer_parts_master as cpm On cpm.id = cp.customer_parts_master_id
			WHERE pr.rejection_sales_id = ".$credit_note_id;
		$data['parts_rejection_sales_invoice'] = $this->Crud->customQuery($sql);
		foreach ($data['parts_rejection_sales_invoice'] as $key => $value) {
			$packSize = $this->Common_admin_model->calculateAllFactorsForSticker($value->accepted_qty, $value->packaging_qty);
			$packagingQtyFactors = '';
            if ($value->packaging_qty > 0) {
                foreach ($packSize as $factor) {
                    $packagingQtyFactorsTemp = $factor['factor'] . ' X ' . $factor['count'] . '<br>';
                    $packagingQtyFactors = $packagingQtyFactors . $packagingQtyFactorsTemp;
                }
            }
            $data['parts_rejection_sales_invoice'][$key]->packagingQtyFactors = $packagingQtyFactors;
		}


		$po_parts_data = $this->Crud->get_data_by_id("sales_parts", $data['rejection_sales_invoice']->sales_invoice_number, "sales_number");
		$data['po_number'] =$po_parts_data[0]->po_number;
		$data['po_date'] =$po_parts_data[0]->po_date;
		$data['mode'] = ["N/A","Road","Rail","Air","Ship"];
		$digitalSignature = "No";
        $signatureImageEnable = "No";
        $signatureImageUrl= "";
        if(isset($configuration['digitalSignature']) && $configuration['digitalSignature'] == "Yes"){
               $digitalSignature = "Yes"; 
        }else if(isset($configuration['SignatureImageEnable'])){
            if($configuration['SignatureImageEnable'] == "Yes" && $configuration['SignatureImage'] != ""){
               $signatureImageEnable = "Yes"; 
               $signatureImageUrl = base_url("dist/img/signature_image/").$configuration['SignatureImage'];
            }
        }
        $i = count($data['parts_rejection_sales_invoice']);
        $height = "280px";
        if ($i == 2) {
            $height = "250px";
        } elseif ($i == 3) {
            $height = "210px";
        } elseif ($i == 4) {
            $height = "180px";
        } elseif ($i == 5) {
            $height = "140px";
        } elseif ($i == 6) {
            $height = "100px";
        } elseif ($i == 7) {
            $height = "80px";
        } elseif ($i == 8) {
            $height = "50px";
        }
        $data['height'] = $height;
        $data['footer_html'] = $this->getFooterWithSignatureForSales($digitalSignature,$signatureImageEnable,$signatureImageUrl);
        if($data['rejection_sales_invoice']->type == "ProformaInvoice"){
        	$data['pdf_title'] = "PROFORMA INVOICE";
        	$pdfName = $credit_note_id.'-Proforma-Invoice-'. $copy . '.pdf';
        }else if($data['rejection_sales_invoice']->type == "DebitNote"){
        	$pdfName = $credit_note_id.'-Debit-Note-'. $copy . '.pdf';
        	$data['pdf_title'] = "DEBIT NOTE";
        }else{	
        	$pdfName = $credit_note_id.'-Credit-Note-'. $copy . '.pdf';
        	$data['pdf_title'] = "CREDIT NOTE";
        }
        $pdfName = $credit_note_id.'-Credit-Note-'. $copy . '.pdf';
        $data['copies'] = ["ORIGINAL_FOR_RECIPIENT","DUPLICATE_FOR_TRANSPORTER","TRIPLICATE_FOR_SUPPLIER","ACKNOWLEDGEMENT_COPY","EXTRA_COPY"];
        $data['copy'] = $copy;
        // pr($data,1);
		$html_content = $this->smarty->fetch('quality/credit_node_pdf.tpl', $data, TRUE);
		// pr($html_content,1);
		$this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // pr("ok",1);
		if($digitalSignature== "Yes" ){
                $output = $this->pdf->output();
                $fileName = "dist/uploads/credit_note_print/".$pdfName;
                $fileAbsolutePath = FCPATH.$fileName;

                // upload pdf
                file_put_contents($fileAbsolutePath, $output);

                // generate digital signature
                $signer = $configuration['signer'];
                $certpwd = $configuration['certpwd'];
                $certid = $configuration['certid'];
                $customerPrefix = $configuration['customerPrefix'];
                $digital_signature_url = $configuration['digital_signature_url'];
                $SignaturePostion = '[440:72]';
                if($isEinvoicePresent){
                    $SignaturePostion = '[440:55]';
                }
                digitalSignature($fileName,$SignaturePostion,$signer,$certpwd,$certid,$customerPrefix,$digital_signature_url);
                
                $fileDownloadPath = base_url().$fileName;
                $pdf_content = file_get_contents($fileDownloadPath);
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=".$pdfName);
                header("Content-Length: " . strlen($pdf_content));
                echo $pdf_content;
                exit();
        }else{
            $this->pdf->stream($pdfName, array("Attachment" => 1));
        }
	}
	public function generate_credit_note_multiple(){
		
		$copies_arr = $this->input->post("interests");
		$credit_note_id = $this->uri->segment('2');
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        $company_logo = "";
        $company_logo_enable = "No";
        $row_col_span = '12';
        if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                 $company_logo = $configuration['companyLogo'];
                $company_logo_enable = "Yes";
                $company_logo = '<td width="10%" colspan="2" style="text-align:center;"><img src="'.base_url('').'/dist/img/company_logo/'.$company_logo.'"  style="width: 60px;padding: 0px;"></td>';
                $row_col_span = '10';
            }
        }
        $data['company_logo'] =$company_logo;
        $sql = "
			SELECT r.*,CONCAT(t.name,'-' ,t.transporter_id) as transporter,t.transporter_id as transporter_id
			FROM rejection_sales_invoice as r
			LEFT JOIN transporter as t On t.id = r.transporter_id
			WHERE r.id =".$credit_note_id;
		$rejection_sales_invoice = $this->Crud->customQuery($sql);
		$data['rejection_sales_invoice'] = $rejection_sales_invoice[0];
        $client_data = $this->Crud->get_data_by_id("client", $rejection_sales_invoice[0]->clientId, "id");
        $data['client_data'] = $client_data[0];
        $customer_data = $this->Crud->get_data_by_id("customer", $rejection_sales_invoice[0]->customer_id, "id");
        $data['customer_data'] = $customer_data[0];
        $credit_note[0]->shipping_addressType = "customer";
        $data['shipping_data'] = $this->getShippingDetails($credit_note, $customer_data);
		$sql = "
			SELECT pr.*,cp.part_number as part_number,cp.part_number as part_number,cp.part_description as part_description,cp.hsn_code as hsn_code,cp.uom as uom,cp.packaging_qty as packaging_qty,cpm.fg_rate as rate,gs.cgst as cgst,gs.sgst as sgst,gs.igst as igst,gs.tcs as tcs,gs.tcs_on_tax as tcs_on_tax
			FROM parts_rejection_sales_invoice as pr
			LEFT JOIN customer_part as cp On cp.id = pr.part_id
			LEFT JOIN gst_structure as gs On gs.id = cp.gst_id
			LEFT JOIN customer_parts_master as cpm On cpm.id = cp.customer_parts_master_id
			WHERE pr.rejection_sales_id = ".$credit_note_id;
		$data['parts_rejection_sales_invoice'] = $this->Crud->customQuery($sql);
		foreach ($data['parts_rejection_sales_invoice'] as $key => $value) {
			$packSize = $this->Common_admin_model->calculateAllFactorsForSticker($value->accepted_qty, $value->packaging_qty);
			$packagingQtyFactors = '';
            if ($value->packaging_qty > 0) {
                foreach ($packSize as $factor) {
                    $packagingQtyFactorsTemp = $factor['factor'] . ' X ' . $factor['count'] . '<br>';
                    $packagingQtyFactors = $packagingQtyFactors . $packagingQtyFactorsTemp;
                }
            }
            $data['parts_rejection_sales_invoice'][$key]->packagingQtyFactors = $packagingQtyFactors;
		}
		$po_parts_data = $this->Crud->get_data_by_id("sales_parts", $data['rejection_sales_invoice']->sales_invoice_number, "sales_number");
		$data['po_number'] =$po_parts_data[0]->po_number;
		$data['po_date'] =$po_parts_data[0]->po_date;
		$data['mode'] = ["N/A","Road","Rail","Air","Ship"];
		$digitalSignature = "No";
        $signatureImageEnable = "No";
        $signatureImageUrl= "";
        if(isset($configuration['digitalSignature']) && $configuration['digitalSignature'] == "Yes"){
               $digitalSignature = "Yes"; 
        }else if(isset($configuration['SignatureImageEnable'])){
            if($configuration['SignatureImageEnable'] == "Yes" && $configuration['SignatureImage'] != ""){
               $signatureImageEnable = "Yes"; 
               $signatureImageUrl = base_url("dist/img/signature_image/").$configuration['SignatureImage'];
            }
        }
        $i = count($data['parts_rejection_sales_invoice']);
        $height = "280px";
        if ($i == 2) {
            $height = "250px";
        } elseif ($i == 3) {
            $height = "210px";
        } elseif ($i == 4) {
            $height = "180px";
        } elseif ($i == 5) {
            $height = "140px";
        } elseif ($i == 6) {
            $height = "100px";
        } elseif ($i == 7) {
            $height = "80px";
        } elseif ($i == 8) {
            $height = "50px";
        }
        $data['height'] = $height;
        $data['footer_html'] = $this->getFooterWithSignatureForSales($digitalSignature,$signatureImageEnable,$signatureImageUrl);
        if($data['rejection_sales_invoice']->type == "ProformaInvoice"){
        	$data['pdf_title'] = "PROFORMA INVOICE";
        	$pdfName = $credit_note_id.'-Proforma-Invoice-.pdf';
        }else if($data['rejection_sales_invoice']->type == "DebitNote"){
        	$pdfName = $credit_note_id.'-Debit-Note-.pdf';
        	$data['pdf_title'] = "DEBIT NOTE";
        }else{	
        	$pdfName = $credit_note_id.'-Credit-Note-.pdf';
        	$data['pdf_title'] = "CREDIT NOTE";
        }
        $data['copies'] = $copies_arr;
		$html_content = $this->smarty->fetch('quality/credit_node_pdf_mltiple.tpl', $data, TRUE);
		// pr($html_content,1);
		$this->pdf->loadHtml($html_content);
        $this->pdf->render();
		if($digitalSignature== "Yes" ){
                $output = $this->pdf->output();
                $fileName = "dist/uploads/credit_note_print/".$pdfName;
                $fileAbsolutePath = FCPATH.$fileName;

                // upload pdf
                file_put_contents($fileAbsolutePath, $output);

                // generate digital signature
                $signer = $configuration['signer'];
                $certpwd = $configuration['certpwd'];
                $certid = $configuration['certid'];
                $customerPrefix = $configuration['customerPrefix'];
                $digital_signature_url = $configuration['digital_signature_url'];
                $SignaturePostion = '[440:72]';
                if($isEinvoicePresent){
                    $SignaturePostion = '[440:55]';
                }
                digitalSignature($fileName,$SignaturePostion,$signer,$certpwd,$certid,$customerPrefix,$digital_signature_url);
                
                $fileDownloadPath = base_url().$fileName;
                $pdf_content = file_get_contents($fileDownloadPath);
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=".$pdfName);
                header("Content-Length: " . strlen($pdf_content));
                echo $pdf_content;
                exit();
        }else{
            $this->pdf->stream($pdfName, array("Attachment" => 1));
        }
	}

	public function getFooterWithSignatureForSales($digitalSignature =  'No',$signatureImageEnable='No',$signatureImageUrl = '')
    {
        $rowspan = "2";
        
        
        $footerDetails =
        '<tr style="font-size:8px">
            <td colspan="5">
                <span style="padding-left:5px"><p>We hereby certify that my/our registration certificate under the Goods and Service Tax
                Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
                invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
                been effected by me/us and it shall be accounted for in the turnover of sales while filling
                of return and the due tax. If any, payable on the sale has been paid or shall be paid
                <br>
                Certified that the particulars given above are true.Interest @24% P.A. will be charged on all overdue invoices.<br>
                Subject To Pune Jurisdiction
                </p><p>
                <b>This is computer generated document. No signature required.</b></p></span>
            </td>
            <td colspan="'.$rowspan.'" style="text-align:center;vertical-align: bottom;">
             <h4 style="font-size:11px"> Receiver Signature </h4>
            </td>';

        if($digitalSignature == 'Yes'){
            $footerDetails .= '<td colspan="5" style="text-align:center;font-size:11px;min-width:100px;"></td>';
        }else if($signatureImageEnable == 'Yes' && $signatureImageUrl != ''){
            $footerDetails .= '<td colspan="5" style="text-align:center;font-size:11px;min-width:100px;background: white;">
                <h4> For, ' . $this->getCustomerNameDetails() . ' </h4>
                <br>
                <img src="'.$signatureImageUrl.'" height="100" width="170" style="background: white;">
                <h4 style="white-space:nowrap;"> Authorized Signatory</h4>
            </td>';
        }else{
            $footerDetails .= '<td colspan="5" style="text-align:center;font-size:11px;min-width:100px;">
                <h4> For, ' . $this->getCustomerNameDetails() . ' </h4>
                <br><br><br><br>
                <h4 style="white-space:nowrap;"> Authorized Signatory</h4>
            </td>';
        }
            
        $footerDetails.='</tr>
            ' ;

            // . $this->getFooter()
        return $footerDetails;
    }
	public function generate_rejection_sales_invoice()
	{
		$sales_id = $this->input->post("sales_id");
		if($sales_id > 0){
			$sales_parts = [];
			$sql = "SELECT sp.*,t.* FROM sales_parts as sp LEFT JOIN gst_structure as t ON t.id = sp.tax_id WHERE sp.sales_id = ".$sales_id."";
			$sales_parts = $this->Crud->customQuery($sql);
		// pr($sales_parts,1);
		}
		$customer_id = $this->input->post('customer_id');
		$customer_debit_note_no = $this->input->post('customer_debit_note_no');
		$customer_debit_note_date = $this->input->post('customer_debit_note_date');
		$client_sales_invoice_no = $this->input->post('client_sales_invoice_no');
		$client_invoice_date = $this->input->post('client_invoice_date');
		$debit_basic_amt = $this->input->post('debit_basic_amt');
		$debit_gst_amt = $this->input->post('debit_gst_amt');
		$rejection_reason = $this->input->post('rejection_reason');
		$remark = $this->input->post('remark');

		$mode = $this->input->post('mode');
		$transporter = $this->input->post('transporter');
        $vehicle_number = $this->input->post('vehicle_number');
        $lr_number = $this->input->post('lr_number');
        $freight_charges = $this->input->post('freight_charges');
        $current_year = $this->getFinancialYear();
        $current_year_arr = explode("-", $current_year);
        $start_data = $this->createFinatialStartEndDate("start_date",$current_year_arr[0]);
		$end_data = $this->createFinatialStartEndDate("end_date",$current_year_arr[1]);
		$sql = "
			SELECT
		    rejection_sales_invoice.*
			FROM
			    rejection_sales_invoice
			WHERE
			    rejection_invoice_no LIKE '%TEMP%' 
			    AND (
		        STR_TO_DATE(created_date, '%d-%m-%Y') BETWEEN '".$start_data['start']."' AND '".$start_data['end']."'
		        OR
		        STR_TO_DATE(created_date, '%d-%m-%Y') BETWEEN '".$end_data['start']."' AND '".$end_data['end']."'
		    ) 
			ORDER BY `rejection_sales_invoice`.`id`  DESC
		";
		$latestSeqFormat = $this->Crud->customQuery($sql);
		
		$sales_invoice_data = [];
		if($client_sales_invoice_no != ""){
		$sql = "SELECT count(rejection_invoice_no) as count FROM rejection_sales_invoice WHERE sales_invoice_number = '".$client_sales_invoice_no."'";
		$sales_invoice_data = $this->Crud->customQuery($sql);
		}
		$success = 0;
        $messages = "Something went wrong.";
		if(strlen($remark) < 280)	
			if($sales_invoice_data[0]->count == 0){
				if($latestSeqFormat[0]->rejection_invoice_no != ""){
					$structure_type = "";
					// pr($this->input->post(),1);
					if($this->input->post("form_type") == "CreditNote"){
						$structure_type = "credit_note";
					}else if($this->input->post("form_type") == "DebitNote"){
						$structure_type = "debit_note";
					}else if($this->input->post("form_type") == "ProformaInvoice"){
						$structure_type = "performa_invoice";
					}
					$prifix_number = $this->getFomrmateData($structure_type,"NUM","Yes");
					$formae_data_val = $prifix_number;
					$Structure_arr['PREFIX'] = "TEMP";
					$Structure_arr['FY'] = $current_year;
					$code_key = '';

					foreach ($latestSeqFormat as $key => $value) {

						$structure_sample = explode("/",$value->rejection_invoice_no);
						// pr($structure_sample);
						$flag = 0;
						$needle_count = count($formae_data_val['formate_arr']);
						// pr($formae_data_val);
						if(count($formae_data_val['formate_arr']) == count($structure_sample)){
							foreach ($formae_data_val['formate_arr'] as $key_val => $val) {
								
								if($Structure_arr[$val] == $structure_sample[$key_val] && $val == "PREFIX"){
									// $flag = 0;
								}else if($Structure_arr[$val] == $structure_sample[$key_val] && $val == "FY" ){
									// $flag = 0;
								}else if(stripos($structure_sample[$key_val],"-") == 0 && $val == "NUM" ){
									// $flag = 0;
								}else{
									$flag = 1;
								}

							}
							if($flag == 0 && $code_key == ''){
								$code_key = $key;
								// pr($value,1);
								break;
							}
						}
						
					}

					$last_count = explode("/",$latestSeqFormat[$code_key]->rejection_invoice_no);
					$last_count = $last_count[$prifix_number['prifix_num']];
				}else{
					$last_count = 0;
				}
				$count_number = $last_count+1;
				$rejection_invoice_no = $this->getCustomerTempSerialNUmber($this->input->post("form_type"),$count_number);
				// pr($rejection_invoice_no,1);
				if($rejection_invoice_no != ""){
					$data = array(
						"customer_id" => $customer_id,
						"rejection_invoice_no" => $rejection_invoice_no,
						"document_number" => $customer_debit_note_no,
						"debit_note_date" => $customer_debit_note_date,
						"sales_invoice_number" => $client_sales_invoice_no,
						"client_invoice_date" => $client_invoice_date,
						"debit_basic_amt" => $debit_basic_amt,
						"debit_gst_amt" => $debit_gst_amt,
						"rejection_reasonky" => $rejection_reason,
						"remark" => $remark,
						"mode"=>$mode,
						"transporter_id"=>$transporter,
						"vehicle_number"=>$vehicle_number,
						"lr_number"=>$lr_number,
						"freight_charges"=>$freight_charges,
						"type" => $this->input->post("form_type"),
						"created_by" => $this->user_id,
						"created_date" => $this->current_date,
						"created_time" => $this->current_time,
					);
					$result = $inserted_id = $this->Crud->insert_data("rejection_sales_invoice", $data);
					if ($result) {
						if(is_array($sales_parts) && count($sales_parts) > 0){
						$data = [];
						foreach ($sales_parts as $key => $value) {
							if ($value->igst <= 0) {
					                $gst = $value->cgst + $value->sgst;
					                $cgst = $value->cgst;
					                $sgst = $value->sgst;
					                $tcs = $value->tcs;
					                $igst = 0;
					                $total_gst_percentage = $cgst + $sgst;
					        } else {
					                $gst =  $value->igst;
					                $tcs =  $value->tcs;
					                $cgst = 0;
					                $sgst = 0;
					                $igst = $gst;
					                $total_gst_percentage = $igst;
					        }
					        $gst_amount = ($gst * $value->basic_total) / 100;
					        $total_amount = $value->basic_total;
					        $cgst_amount = ($total_amount * $cgst) / 100;
							$sgst_amount = ($total_amount * $sgst) / 100;
							$igst_amount = ($total_amount * $igst) / 100;
							if ($gst_structure2[0]->tcs_on_tax == "no") {
								$tcs_amount =   (($total_amount * $tcs) / 100);
							} else {
								$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);	
							}
							$total_rate = $total_amount + $gst_amount;
							$data[] = array(
								"customer_id" => $value->customer_id,
								"rejection_sales_id" => $result,
								"part_id" => $value->part_id,
								"qty" => $value->qty,
								"created_by" => $this->user_id,
								"created_date" => $this->current_date,
								"created_time" => $this->current_time,
								"created_day" => $this->date,
								"created_month" => $this->month,
								"created_year" => $this->year,
								"part_price" =>  $value->part_price,
								"basic_total" => $value->basic_total,
								"total_rate" =>  $total_rate,
								"cgst_amount" =>  $value->cgst_amount,
								"sgst_amount" => $value->sgst_amount,
								"igst_amount" => $value->igst_amount,
								"tcs_amount" =>  $value->tcs_amount,
								"gst_amount" =>  $value->gst_amount,
							);
						}
						if(is_array($data) && count($data) > 0){
							$this->db->insert_batch('parts_rejection_sales_invoice', $data); 
						}
						}
						if($this->input->post("form_type") == "DebitNote"){
							$success = 1;
							$messages = "Debit note successfully created.";
							// $this->addSuccessMessage('Debit note successfully created.');
						}else if($this->input->post("form_type") == "ProformaInvoice"){
							$success = 1;
							$messages = "Proforma Invoice successfully created.";
							// $this->addSuccessMessage('Proforma Invoice successfully created.');
						}else{
							$success = 1;
							$messages = "Credit note successfully created.";
							// $this->addSuccessMessage('Credit note successfully created.');
						}
						
						// $this->redirectMessage('view_rejection_sales_invoice_by_id/' . $result);
					} else {
						$messages  = "Failed to create credit note";
						// $this->addErrorMessage('Failed to create credit note ');
						// $this->redirectMessage('rejection_invoices');
					}
				}else{
					$messages = "Formate generation issue.";
					// $this->addErrorMessage('Formate generation issue.');
					// $this->redirectMessage('sales_invoice_released');
				}
			}else{
				$messages = "Credit note for this invoce already exist.";
				// $this->addErrorMessage('Credit note for this invoce already exist.');
				// $this->redirectMessage('sales_invoice_released');
			}
		else {
				$messages = "Please add remark less than 280 characters.";
				// $this->addErrorMessage('Please add remark less than 280 characters.');
				// $this->redirectMessage('rejection_invoices');
		}	
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        $result['redirect_url'] = base_url("view_rejection_sales_invoice_by_id/").$inserted_id;
        // pr($result,1);
        echo json_encode($result);
        exit();
	}


	
	public function view_rejection_sales_invoice_by_id()
	{
		$sales_id = $this->uri->segment('2');
		$data['sales_id'] = $sales_id;
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$data['new_sales'] = $this->Crud->get_data_by_id("rejection_sales_invoice", $sales_id, "id");
		$data['customer'] = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$data['uom'] = $this->Crud->read_data("uom");
		$child_part_list = $this->db->query('SELECT DISTINCT part_number,part_description,id FROM `customer_part` where customer_id = ' . $data['customer'][0]->id . '');
		$data['customer_part'] = $child_part_list->result();

		$arr = array(
			"rejection_sales_id" => $sales_id,
		);
		$parts_rejection_sales_invoice = $this->db->query('
			SELECT prs.*,cp.uom as uom,gs.code as gst_code,cp.*,prs.id as id
			FROM parts_rejection_sales_invoice as prs 
			LEFT JOIN customer_part as cp ON cp.id = prs.part_id
			LEFT JOIN gst_structure as gs ON gs.id = cp.gst_id
			where prs.rejection_sales_id = ' . $sales_id . '');
		$data['parts_rejection_sales_invoice'] = $parts_rejection_sales_invoice->result();
		// $data['parts_rejection_sales_invoice'] = $this->Crud->get_data_by_id_multiple("parts_rejection_sales_invoice", $arr);
		// pr($data['parts_rejection_sales_invoice']);
		$data['transporter'] = $this->Crud->read_data("transporter");
		$data['mode'] = ["N/A","Road","Rail","Air","Ship"];
		$data['user_type'] = $this->session->userdata['type'];
		
		// $this->load->view('header');
		$this->loadView('quality/view_rejection_sales_invoice_by_id', $data);
	}


	public function update_rejection_sales_invoice()
	{
		$id = $this->input->post('id');
		$invoice_type = $this->input->post('invoice_type');
		$rejection_invoice_no = $this->input->post('rejection_invoice_no');
		$customer_debit_note_no = $this->input->post('customer_debit_note_no');
		$customer_debit_note_date = $this->input->post('customer_debit_note_date');
		$client_sales_invoice_no = $this->input->post('client_sales_invoice_no');
		$client_invoice_date = $this->input->post('client_invoice_date');
		$debit_basic_amt = $this->input->post('debit_basic_amt');
		$debit_gst_amt = $this->input->post('debit_gst_amt');
		$rejection_reason = $this->input->post('rejection_reason');
		$remark = $this->input->post('remark');
		$mode = $this->input->post('mode');
		$transporter = $this->input->post('transporter');
        $vehicle_number = $this->input->post('vehicle_number');
        $lr_number = $this->input->post('lr_number');
        $freight_charges = $this->input->post('freight_charges');

		$data = array(
			"document_number" => $customer_debit_note_no,
			"debit_note_date" => $customer_debit_note_date,
			"sales_invoice_number" => $client_sales_invoice_no,
			"client_invoice_date" => $client_invoice_date,
			"debit_basic_amt" => $debit_basic_amt,
			"debit_gst_amt" => $debit_gst_amt,
			"rejection_reasonky" => $rejection_reason,
			"remark" => $remark,
			"mode"=>$mode,
			"transporter_id"=>$transporter,
			"vehicle_number"=>$vehicle_number,
			"lr_number"=>$lr_number,
			"freight_charges"=>$freight_charges,
			"created_by" => $this->user_id,
		);
		$messages = "";
        $success = 0;
		$result = $this->Crud->update_data("rejection_sales_invoice", $data, $id);
		if ($result) {
			$messages = $invoice_type." updated successfully.";
			$success = 1;
			// $this->addSuccessMessage('Rejection invoice updated successfully.');
			//$this->redirectMessage('view_rejection_sales_invoice_by_id/'. $result);
		} else {
			$messages = "Failed to update".$invoice_type;
			// $this->addErrorMessage('Failed to create rejection invoice ');
			//$this->redirectMessage('rejection_invoices');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function generate_new_sales_rejection_Test()
	{
		$customer_id = $this->input->post('customer_id');
		$remark = $this->input->post('remark');
		$po_date = $this->input->post('po_date');
		$qty = $this->input->post('qty');
		$mode = $this->input->post('mode');
		$transporter = $this->input->post('transporter');
		$vehicle_number = $this->input->post('vehicle_number');
		$lr_number = $this->input->post('lr_number');
		$price = $this->input->post('price');
		$hsn_code = $this->input->post('hsn_code');
		$customer_part_id = $this->input->post('customer_part_id');
		$part_number = $this->input->post('part_number');
		$expiry_po_date = $this->input->post('expiry_po_date');
		$data['new_sales'] = $this->Crud->read_data("new_sales");
		// $data['po_date'] = $this->Crud-	>read_data("po_date");
		// $data['expiry_po_date'] = $this->Crud->read_data("expiry_po_date");

		$sql = "SELECT sales_number FROM new_sales_rejection WHERE sales_number like '" . $this->getSalesRejectionTestSerialNo() . "%' order by id desc LIMIT 1";
		$latestSeqFormat = $this->Crud->customQuery($sql);
		foreach ($latestSeqFormat as $p) {
			$currentSaleNo = $p->sales_number;
		}
		$po_number = substr($currentSaleNo, strlen($this->getSalesRejectionTestSerialNo())) + 1;
		$po_number = $this->getSalesRejectionTestSerialNo() . $sales_num;

		$data = array(
			"customer_id" => $customer_id,
			"sales_number" => $po_number,
			"remark" => $remark,
			"part_number" => $part_number,
			"mode" => $mode,
			"transporter" => $transporter,
			"vehicle_number" => $vehicle_number,
			"lr_number" => $lr_number,
			"price" => $price,
			"hsn_code" => $hsn_code,
			"qty" => $qty,
			"created_by" => $this->user_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"created_by" => $this->current_date,
			"created_day" => $this->date,
			"created_month" => $this->month,
			"created_year" => $this->year,
		);


		$result = $this->Crud->insert_data("new_sales_rejection", $data);
		if ($result) {
			echo "<script>alert('Successfully Added');document.location='" . base_url('view_new_sales_by_id_rejection/') . $result . "'</script>";
		} else {
			echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}

	// Function to add sales data request
	public function xml_extension()
	{
		$this->load->view('xml_extension.php');
	}

	// Function to add sales data request
    public function requestSalesXML($data, $sales_details)
    {

		$isWithInventory = false;
		$isSalesExportWithInventory = $this->GlobalConfig->readConfiguration("isSalesExportWithInventory", "No");
		if (strcasecmp($isSalesExportWithInventory, "Yes") == 0) {
			$isWithInventory = true;
		}
		

        $isCreate = true;
        if ($sales_details->status == 'Cancelled') {
            $isCreate = false;
        }
        $voucher = $data->addChild('TALLYMESSAGE');
        // Encode special characters
        $customer_name = htmlspecialchars($sales_details->customer_name, ENT_XML1 | ENT_COMPAT, 'UTF-8');

        //$customer_name  = $sales_details->customer_name;
        $sales_number = $sales_details->sales_number;

		// Create a DateTime object using the input date and the specified format
        $dateTimeObject = DateTime::createFromFormat('d/m/Y', $sales_details->created_date);
        // Format the DateTime object to the desired output format "Ymd"
        $sales_date = $dateTimeObject->format('Ymd');

        //Get GUID and RANDOMID :
        $guid = str_replace("-", "0", $sales_number);
        $guid = str_replace("/", "0", $guid);

        $voucher_child = $voucher->addChild('VOUCHER');
        $voucher_child->addAttribute('REMOTEID', $guid); //Fixed pattern - with sales number etc as this can be used for cancel too.
        $voucher_child->addAttribute('VCHTYPE', 'Sales'); //Hard-Coded
        if ($isWithInventory) {
			if($isCreate){
				$voucher_child->addAttribute('ACTION', 'Create');
			}
			$voucher_child->addAttribute('OBJVIEW', 'Invoice Voucher View'); //Hard-Coded
	    }

        if ($isWithInventory && $isCreate) {

            //get the address details
            $addressDetails = $this->Crud->customQuery("SELECT 
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.shifting_address
                                WHEN sales.shipping_addressType = 'consignee' THEN adm.address
                            END AS shippingAddress,
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.customer_name
                                WHEN sales.shipping_addressType = 'consignee' THEN cons.consignee_name
                            END AS consigneeName,
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.state
                                WHEN sales.shipping_addressType = 'consignee' THEN adm.state
                            END AS consignee_state,
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.gst_number
                                WHEN sales.shipping_addressType = 'consignee' THEN cons.gst_number
                            END AS consignee_gst_number,
                            cust.billing_address as billing_address,
                            cust.state as billing_state,
                            cust.pan_no as cust_pan_no,
                            cust.gst_number as billing_GSTIN
                        FROM 
                            new_sales sales
                        INNER JOIN 
                            customer cust ON cust.id = sales.customer_id
                        LEFT JOIN 
                            consignee cons ON cons.id = sales.consignee_id
                        LEFT JOIN 
                            address_master adm ON adm.id = cons.address_id
                        WHERE 
                            sales.id = ".$sales_details->sales_id);

            if ($sales_details) {
               $shippingAddress = $addressDetails[0]->shippingAddress;
               $billingAddress = $addressDetails[0]->billing_address;
               $billing_GSTIN = $addressDetails[0]->billing_GSTIN;
               $billing_state = $addressDetails[0]->billing_state;
               $customer_pan_no = $addressDetails[0]->cust_pan_no;
               $consigneeName = $addressDetails[0]->consigneeName;
               $consignee_state = $addressDetails[0]->consignee_state;
               $consignee_gst_number = $addressDetails[0]->consignee_gst_number;
            }

            //client data 
            $client = $this->Unit->getClientUnitDetails();
            
            $addr_type = $voucher_child->addChild('ADDRESS.LIST'); //bill to address
            $addr_type->addAttribute('TYPE', 'String'); //Hard-Coded
            $addr_type->addChild('ADDRESS',$billingAddress);

            $basicbuyaddr_type = $voucher_child->addChild('BASICBUYERADDRESS.LIST');//ship to address
            $basicbuyaddr_type->addAttribute('TYPE', 'String'); //Hard-Coded
            $basicbuyaddr_type->addChild('BASICBUYERADDRESS', $shippingAddress);

            /** <BASICORDERTERMS.LIST TYPE="String">
             *  <BASICORDERTERMS>By Road</BASICORDERTERMS>
             *  </BASICORDERTERMS.LIST> */

            $voucher_child->addChild('DATE', $sales_date);
			$voucher_child->addChild('VCHSTATUSDATE', $sales_date);		
			$voucher_child->addChild('GUID', $guid);

            $voucher_child->addChild('GSTREGISTRATIONTYPE', 'Regular'); //Hard-Coded ?
            $voucher_child->addChild('VATDEALERTYPE', 'Regular'); //Hard-Coded ?
            $voucher_child->addChild('STATENAME', $billing_state); //TO-DO		- Customer state ?
            $voucher_child->addChild('ENTEREDBY', 'admin'); //TO-DO
			$voucher_child->addChild('COUNTRYOFRESIDENCE', 'India'); //TO-DO	
            $voucher_child->addChild('PARTYGSTIN', $billing_GSTIN);
			$voucher_child->addChild('PLACEOFSUPPLY', $billing_state); //TO-DO		- Customer state ?
			$voucher_child->addChild('PARTYNAME', $customer_name);
            
			$gst_registration = $voucher_child->addChild('GSTREGISTRATION',$client[0]->state); //TO-DO
			$gst_registration->addAttribute('TAXTYPE', 'GST');
			$gst_registration->addAttribute('TAXREGISTRATION', $client[0]->gst_number);
            $voucher_child->addChild('CMPGSTIN', $client[0]->gst_number);

			$voucher_child->addChild('VOUCHERTYPENAME', 'Sales'); //Hard coded
			$voucher_child->addChild('PARTYLEDGERNAME', $customer_name);

			$voucher_child->addChild('VOUCHERNUMBER', $sales_details->sales_number); 
            $voucher_child->addChild('BASICBUYERNAME',$consigneeName); //ship to buyer name
            $voucher_child->addChild('CMPGSTREGISTRATIONTYPE', 'Regular'); 
            $voucher_child->addChild('PARTYMAILINGNAME', $customer_name); 
            $voucher_child->addChild('CONSIGNEEGSTIN', $consignee_gst_number);
            $voucher_child->addChild('CONSIGNEEMAILINGNAME', $consigneeName);
            $voucher_child->addChild('CONSIGNEESTATENAME',$consignee_state);
            $voucher_child->addChild('CMPGSTSTATE', 'Maharashtra'); //TO-DO
            $voucher_child->addChild('CONSIGNEECOUNTRYNAME', 'India'); //TO-DO
            $voucher_child->addChild('BASICBASEPARTYNAME', $consigneeName);
            $voucher_child->addChild('NUMBERINGSTYLE', 'Auto Retain1'); //Hard Coded
            $voucher_child->addChild('CSTFORMISSUETYPE', 'Not Applicable'); //Hard Coded
            $voucher_child->addChild('CSTFORMRECVTYPE', 'Not Applicable'); //Hard Coded

            $voucher_child->addChild('FBTPAYMENTTYPE', 'Default'); //Hard Coded
            $voucher_child->addChild('PERSISTEDVIEW', 'Invoice Voucher View'); //Hard Coded
            $voucher_child->addChild('VCHSTATUSTAXADJUSTMENT', 'Default'); //Hard Coded
            $voucher_child->addChild('VCHSTATUSVOUCHERTYPE', 'Sales'); //Hard Coded
            $voucher_child->addChild('VCHSTATUSTAXUNIT', $billing_state); //TO-DO Maharashtra Registration
            $voucher_child->addChild('VCHGSTCLASS', 'Not Applicable'); //Hard Coded
            $voucher_child->addChild('CONSIGNEEPINNUMBER', $customer_pan_no); //TO-DO CUSTOMER PAN NO 
            $voucher_child->addChild('VCHENTRYMODE', 'Item Invoice'); //Hard Coded	
            $voucher_child->addChild('EFFECTIVEDATE', $sales_date); 
            $voucher_child->addChild('DIFFACTUALQTY', 'No'); // Hard Coded
            $voucher_child->addChild('ISMSTFROMSYNC', 'No'); // Hard Coded

            $voucher_child->addChild('HASDISCOUNTS', ($sales_details->discount_amount >0) ? 'Yes' :'No');

            $this->vocher_inventory_default_fields($voucher_child);
        }else{
			$voucher_child->addChild('ISOPTIONAL', 'No');
			$voucher_child->addChild('USEFORGAINLOSS', 'No');
			$voucher_child->addChild('USEFORCOMPOUND', 'No');
			$voucher_child->addChild('VOUCHERTYPENAME', 'Sales');
			$voucher_child->addChild('DATE', $sales_date);
			$voucher_child->addChild('EFFECTIVEDATE', $sales_date);

			$voucher_child->addChild('USETRACKINGNUMBER', 'No');
			$voucher_child->addChild('ISPOSTDATED', 'No');
			$voucher_child->addChild('ISINVOICE', 'No');

		}
        

        if ($isCreate == true) {
            //There would be multiple entries here for INVENTORYENTRIES
                $inventory_details = $this->Crud->customQuery("select cp.part_number, part.uom_id, part.hsn_code, part.qty, part.part_price,
												(part.total_rate - part.gst_amount) as part_amount, discounted_amount,
												part.sales_number, part.tax_id, part.total_rate as Total, part.basic_total ,part.cgst_amount, part.sgst_amount, part.igst_amount, 
												part.tcs_amount, part.gst_amount, tax.cgst, tax.sgst, tax.igst, tax.tcs, tax.tcs_on_tax
												FROM sales_parts part
												INNER JOIN customer_part cp ON cp.id = part.part_id
												INNER JOIN gst_structure tax ON tax.id = part.tax_id
												WHERE part.sales_id = " . $sales_details->sales_id);

			//vocher without inventory details
            if (!$isWithInventory) {			
				$voucher_child->addAttribute('ACTION', 'Create'); //Hard Coded
				$voucher_child->addChild('ISCANCELLED', 'No'); //Hard Coded
				$voucher_child->addChild('DIFFACTUALQTY', 'Yes'); //Hard Coded
				$voucher_child->addChild('VOUCHERNUMBER', $sales_details->sales_number);
				$voucher_child->addChild('REFERENCE', $sales_details->sales_number);
				$voucher_child->addChild('PARTYLEDGERNAME', $customer_name);
				$voucher_child->addChild('NARRATION', 'Invoice No. ' . $sales_details->sales_number);
				$voucher_child->addChild('ASPAYSLIP', 'No'); //Hard Coded
				$voucher_child->addChild('GUID', $guid);
				$voucher_child->addChild('ALTERID', '1'); //TO-D0 For isWithInventory ??

				//What is this ? Need TO-DO action
				$haryanavat_list = $voucher_child->addChild('HARYANAVAT.LIST'); //Hard Coded
				$haryanavat_list->addAttribute('DESC', '`HARYANAVAT`'); //Hard Coded

				$this->inoviceExportForCreate($voucher_child, $sales_details,$customer_name, $guid,$isWithInventory);

				/*if ($inventory_details) {
					foreach ($inventory_details as $inventory_part) {
						$inventory = $voucher_child->addChild('INVENTORYENTRIES.LIST');
						$inventory->addChild('STOCKITEMNAME', $inventory_part->part_number); 
						$inventory->addChild('ISDEEMEDPOSITIVE', 'No'); //Hard Coded
						$inventory->addChild('RATE', $inventory_part->part_price);
						$inventory->addChild('DISCOUNT', $sales_details->discount); //DISCOUNT IS IN PERCENTAGE
						$inventory->addChild('AMOUNT', $inventory_part->part_amount);
						$inventory->addChild('ACTUALQTY', $inventory_part->qty);
						$inventory->addChild('BILLEDQTY', $inventory_part->qty);
						$inventory->addChild('UOM', $inventory_part->uom_id);
					}
				}*/
			}else{
				//vocher with inventory details
                if ($inventory_details) {
                    foreach ($inventory_details as $inventory_part) {
                        $inventory = $voucher_child->addChild('ALLINVENTORYENTRIES.LIST');
                        $inventory->addChild('STOCKITEMNAME', $inventory_part->part_number);					
						$inventory->addChild('GSTOVRDNISREVCHARGEAPPL', 'Not Applicable'); //Hard Coded
						$inventory->addChild('GSTOVRDNTAXABILITY', 'Taxable'); //Hard Coded
						$inventory->addChild('GSTSOURCETYPE', 'Stock Item'); //Hard Coded
						$inventory->addChild('GSTITEMSOURCE', $inventory_part->part_number);
						$inventory->addChild('HSNSOURCETYPE', 'Stock Item'); //Hard Coded
						$inventory->addChild('HSNITEMSOURCE', $inventory_part->part_number);
						$inventory->addChild('GSTOVRDNSTOREDNATURE', ''); //Hard Coded

						$inventory->addChild('GSTOVRDNTYPEOFSUPPLY', 'Goods'); //Hard Coded
						$inventory->addChild('GSTRATEINFERAPPLICABILITY', 'As per Masters/Company'); //Hard Coded
						$inventory->addChild('GSTHSNNAME', $inventory_part->hsn_code); //TO-DO
						$inventory->addChild('GSTHSNINFERAPPLICABILITY', 'As per Masters/Company'); //Hard Coded
						$inventory->addChild('ISDEEMEDPOSITIVE', 'No'); //Hard Coded
						$inventory->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //Hard Coded
						$inventory->addChild('STRDISGSTAPPLICABLE', 'No'); //Hard Coded
						$inventory->addChild('CONTENTNEGISPOS', 'No'); //Hard Coded
						$inventory->addChild('ISLASTDEEMEDPOSITIVE', 'No'); //Hard Coded
						$inventory->addChild('ISAUTONEGATE', 'No'); //Hard Coded
						$inventory->addChild('ISCUSTOMSCLEARANCE', 'No'); //Hard Coded
						$inventory->addChild('ISTRACKCOMPONENT', 'No'); //Hard Coded
						$inventory->addChild('ISTRACKPRODUCTION', 'No'); //Hard Coded
						$inventory->addChild('ISPRIMARYITEM', 'No'); //Hard Coded
						$inventory->addChild('ISSCRAP', 'No'); //Hard Coded


                        $inventory->addChild('RATE', $inventory_part->part_price.'/'.$inventory_part->uom_id);
						$inventory->addChild('AMOUNT', $inventory_part->part_amount);
						$inventory->addChild('DISCOUNT', $sales_details->discount); //DISCOUNT IS IN PERCENTAGE
						$inventory->addChild('ACTUALQTY', $inventory_part->qty.' '.$inventory_part->uom_id);
						$inventory->addChild('BILLEDQTY', $inventory_part->qty.' '.$inventory_part->uom_id);
                        $inventory->addChild('UOM', $inventory_part->uom_id);

						$batchAllocations = $inventory->addChild('BATCHALLOCATIONS.LIST');
						$batchAllocations->addChild('GODOWNNAME', 'Main Location'); //Hard Coded
						$batchAllocations->addChild('BATCHNAME', 'Primary Batch'); //Hard Coded
                        $batchAllocations->addChild('DESTINATIONGODOWNNAME', 'Main Location'); //Hard Coded
						$batchAllocations->addChild('INDENTNO', 'Not Applicable'); //Hard Coded
						$batchAllocations->addChild('ORDERNO', 'Not Applicable'); //Hard Coded
						//$batchAllocations->addChild('TRACKINGNUMBER', 'Not Applicable'); //Hard Coded
						$batchAllocations->addChild('DYNAMICCSTISCLEARED', 'No'); //Hard Coded
						$batchAllocations->addChild('AMOUNT', $inventory_part->part_amount); //Hard Coded
						$batchAllocations->addChild('DISCOUNT', $sales_details->discount); 
						$batchAllocations->addChild('ACTUALQTY', $inventory_part->qty.' '.$inventory_part->uom_id); //Hard Coded
						$batchAllocations->addChild('BILLEDQTY', $inventory_part->qty.' '.$inventory_part->uom_id); //Hard Coded
						$batchAllocations->addChild('ADDITIONALDETAILS.LIST', ''); //Hard Coded
						$batchAllocations->addChild('VOUCHERCOMPONENTLIST.LIST', ''); //Hard Coded


						$acctingAllocations = $inventory->addChild('ACCOUNTINGALLOCATIONS.LIST');
                        $acctingAllocations->addChild('LEDGERNAME', $sales_details->tally_category); //tally category
                        $acctingAllocations->addChild('GSTCLASS', 'Not Applicable'); //Hard Coded
						$acctingAllocations->addChild('ISDEEMEDPOSITIVE', 'No'); //Hard Coded
						$acctingAllocations->addChild('LEDGERFROMITEM', 'No'); //Hard Coded
						$acctingAllocations->addChild('REMOVEZEROENTRIES', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISPARTYLEDGER', 'No'); //Hard Coded
						$acctingAllocations->addChild('GSTOVERRIDDEN', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //Hard Coded
						$acctingAllocations->addChild('STRDISGSTAPPLICABLE', 'No'); //Hard Coded
						$acctingAllocations->addChild('STRDGSTISPARTYLEDGER', 'No'); //Hard Coded
						$acctingAllocations->addChild('STRDGSTISDUTYLEDGER', 'No'); //Hard Coded
						$acctingAllocations->addChild('CONTENTNEGISPOS', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISLASTDEEMEDPOSITIVE', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISCAPVATTAXALTERED', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISCAPVATNOTCLAIMED', 'No'); //Hard Coded
						$acctingAllocations->addChild('AMOUNT', $inventory_part->part_amount);

                        $acctingAllocations->addChild('SERVICETAXDETAILS.LIST');
                        $acctingAllocations->addChild('BANKALLOCATIONS.LIST');
                        $acctingAllocations->addChild('BILLALLOCATIONS.LIST');
                        $acctingAllocations->addChild('INTERESTCOLLECTION.LIST');
                        $acctingAllocations->addChild('OLDAUDITENTRIES.LIST');
                        $acctingAllocations->addChild('ACCOUNTAUDITENTRIES.LIST');
                        $acctingAllocations->addChild('AUDITENTRIES.LIST');
                        $acctingAllocations->addChild('INPUTCRALLOCS.LIST');
                        $acctingAllocations->addChild('DUTYHEADDETAILS.LIST');
                        $acctingAllocations->addChild('EXCISEDUTYHEADDETAILS.LIST');
                        $acctingAllocations->addChild('RATEDETAILS.LIST');
                        $acctingAllocations->addChild('SUMMARYALLOCS.LIST');
                        $acctingAllocations->addChild('CENVATDUTYALLOCATIONS.LIST');
                        $acctingAllocations->addChild('STPYMTDETAILS.LIST');
                        $acctingAllocations->addChild('EXCISEPAYMENTALLOCATIONS.LIST');
                        $acctingAllocations->addChild('TAXBILLALLOCATIONS.LIST');
                        $acctingAllocations->addChild('TAXOBJECTALLOCATIONS.LIST');

                        $acctingAllocations->addChild('TDSEXPENSEALLOCATIONS.LIST');


                        $acctingAllocations->addChild('VATSTATUTORYDETAILS.LIST');
                        $acctingAllocations->addChild('COSTTRACKALLOCATIONS.LIST');
                        $acctingAllocations->addChild('REFVOUCHERDETAILS.LIST');
                        $acctingAllocations->addChild('INVOICEWISEDETAILS.LIST');
                        $acctingAllocations->addChild('VATITCDETAILS.LIST');
                        $acctingAllocations->addChild('ADVANCETAXDETAILS.LIST');
                        $acctingAllocations->addChild('TAXTYPEALLOCATIONS.LIST');


                        $inventory->addChild('DUTYHEADDETAILS.LIST');//Hard Coded

						//RATEDETAILS
						$this->inventoriesExportForCreate($inventory, $inventory_part, $customer_name, $guid,$isWithInventory);
                       
                        $inventory->addChild('SUPPLEMENTARYDUTYHEADDETAILS.LIST');//Hard Coded
                        $inventory->addChild('TAXOBJECTALLOCATIONS.LIST');//Hard Coded
                        $inventory->addChild('REFVOUCHERDETAILS.LIST');//Hard Coded
                        $inventory->addChild('EXCISEALLOCATIONS.LIST');//Hard Coded
                        $inventory->addChild('EXPENSEALLOCATIONS.LIST');//Hard Coded
				    }
                }

				//last part of vocher
				$this->vocher_withInventories_after_inventories_defaults($voucher_child);

				//ledger with Inventories
				$this->ledgerWithInventories($voucher_child,$sales_details,$leger_arr,$customer_name,$inventory_part->part_amount);

				$gst_list = $voucher_child->addChild('GST.LIST');
				$gst_list->addChild('PURPOSETYPE', 'GST'); //Hard Coded
				$stat_gst_list = $gst_list->addChild('STAT.LIST');
				$stat_gst_list->addChild('PURPOSETYPE', 'GST'); //Hard Coded
				$stat_gst_list->addChild('STATKEY', $sales_date.'Invoice'.$sales_number); //Hard Coded
				$stat_gst_list->addChild('ISFETCHEDONLY', 'No'); //Hard Coded
				$stat_gst_list->addChild('ISDELETED', 'No'); //Hard Coded
				$stat_gst_list->addChild('TALLYCONTENTUSER', ''); //Hard Coded
            }

        } else {
            $this->inoviceExportForCancel($voucher_child, $guid);
        }
    }

	private function vocher_withInventories_after_inventories_defaults($voucher_child){
		$voucher_child->addChild('CONTRITRANS.LIST', ''); //Hard Coded
		$voucher_child->addChild('EWAYBILLERRORLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('IRNERRORLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('HARYANAVAT.LIST', ''); //Hard Coded
		$voucher_child->addChild('SUPPLEMENTARYDUTYHEADDETAILS.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEDELNOTES.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEORDERLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEINDENTLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('ATTENDANCEENTRIES.LIST', ''); //Hard Coded
		$voucher_child->addChild('ORIGINVOICEDETAILS.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEEXPORTLIST.LIST', ''); //Hard Coded

	}
	
    /**
     * Cancel invoice specific fields
     */
    private function inoviceExportForCancel($voucher_child, $guid)
    {
        $voucher_child->addAttribute('ACTION', 'Cancel');
        $voucher_child->addChild('ISCANCELLED', 'Yes');
        $voucher_child->addChild('VOUCHERNUMBER');
        $voucher_child->addChild('REFERENCE');
        $voucher_child->addChild('ASPAYSLIP', 'No');
        $voucher_child->addChild('GUID', $guid);
        $voucher_child->addChild('ALTERID', '1');
        $haryanavat_list = $voucher_child->addChild('HARYANAVAT.LIST');
        $haryanavat_list->addAttribute('DESC', '`HARYANAVAT`');
    }

    /**
     * Create invoice specific fields
     */
    private function inoviceExportForCreate($voucher_child, $sales_details, $customer_name, $guid, $isWithInventory)
    {
        $gst_percntg = $sales_details->cgst + $sales_details->sgst + $sales_details->igst + $sales_details->tcs;
        $gst_all = $sales_details->CGST_AMT + $sales_details->SGST_AMT + $sales_details->IGST_AMT + $sales_details->TCS_AMT;
        $gst_on_amount = ($sales_details->Total - $gst_all);

		$leger_arr = array(
				"Total" => $sales_details->Total + $sales_details->TCS_AMT, // Entire amount
				"SALES GST @ " . $gst_percntg . "%" => $gst_on_amount, //<LEDGERNAME>SALES GST @ 28%</LEDGERNAME>
				"OUTPUT CGST @ " . $sales_details->cgst . "%" => $sales_details->CGST_AMT, //<LEDGERNAME>OUTPUT CGST @ 14%</LEDGERNAME>
				"OUTPUT SGST @ " . $sales_details->sgst . "%" => $sales_details->SGST_AMT, //<LEDGERNAME>OUTPUT SGST @ 14%</LEDGERNAME>
				"OUTPUT TCS @ " . $sales_details->tcs . "%" => $sales_details->TCS_AMT, //<LEDGERNAME>OUTPUT TCS @ 0%</LEDGERNAME>
				"OUTPUT IGST @ " . $sales_details->igst . "%" => $sales_details->IGST_AMT, //<LEDGERNAME>OUTPUT IGST @ 28%</LEDGERNAME>
		);

		//remove those items which are with 0 values.
        foreach ($leger_arr as $key => $value) {
            if ($value < 0.01) {
                unset($leger_arr[$key]);
            }
        }

        //There would be multiple entries here for ALLLEDGERENTRIES
        // Add ledger details for vocher without inventories
		$this->ledger_WithoutInventories($voucher_child, $sales_details, $leger_arr, $customer_name);
    }

	private function ledger_WithoutInventories($voucher_child,$sales_details,$leger_arr,$customer_name) {
	   foreach ($leger_arr as $key => $value) {
            $ledger_entries = $voucher_child->addChild('ALLLEDGERENTRIES.LIST');
            //Hard Coded
            $ledger_entries->addChild('REMOVEZEROENTRIES', 'No');

            //Should be replaced with appr values
            if ($key == "Total") {
                $ledger_entries->addChild('ISDEEMEDPOSITIVE', 'Yes'); // <!-- Specifies whether the ledger entry is positive or negative (e.g., "Yes" for positive). -->
                $ledger_entries->addChild('LEDGERFROMITEM', 'No');
                $ledger_entries->addChild('LEDGERNAME', $customer_name); // Replace with the customer's ledger name
                $ledger_entries->addChild('AMOUNT', "-" . $value);

                $bill_allocations = $ledger_entries->addChild('BILLALLOCATIONS.LIST');
                $bill_allocations->addChild('NAME', $sales_details->sales_number);
                $bill_allocations->addChild('BILLTYPE', $key);
                if (!empty($sales_details->payment_terms)) {
                    $bill_creditperiod = $bill_allocations->addChild('BILLCREDITPERIOD', $sales_details->payment_terms . " Days");
                    $bill_creditperiod->addAttribute('P', $sales_details->payment_terms . " Days");
                }
                $bill_allocations->addChild('AMOUNT', "-" . $value);
            } else {
                $ledger_entries->addChild('ISDEEMEDPOSITIVE', 'No');
                $ledger_entries->addChild('LEDGERFROMITEM', 'No');
                $ledger_entries->addChild('LEDGERNAME', $key); // Replace with the customer's ledger name
                $ledger_entries->addChild('AMOUNT', $value);
            }
        }
	}
	
	
	private function inventoriesExportForCreate($inventory, $inventory_part, $customer_name, $guid)
    {
		$leger_arr = array(
				"CGST" => $inventory_part->cgst, 
				"SGST/UTGST" => $inventory_part->sgst,
				//"TCS" => $inventory_part->tcs, 
				"IGST" => $inventory_part->igst
			);
	    
		//remove those items which are with 0 values.
        foreach ($leger_arr as $key => $value) {
            if ($value < 0.01) {
                unset($leger_arr[$key]);
            }
        }

        $this->ledger_Inventories($inventory, $leger_arr);
    }


    private function ledger_Inventories($inventory, $leger_arr) {
	   foreach ($leger_arr as $key => $value) {
			$rateDetails = $inventory->addChild('RATEDETAILS.LIST');
			$rateDetails->addChild('GSTRATEDUTYHEAD', $key); 
			$rateDetails->addChild('GSTRATEVALUATIONTYPE', 'Based on Value'); 
			$rateDetails->addChild('GSTRATE', $value);
	     }
         
        $rateDetails = $inventory->addChild('RATEDETAILS.LIST');
		$rateDetails->addChild('GSTRATEDUTYHEAD', 'Cess'); 
		$rateDetails->addChild('GSTRATEVALUATIONTYPE', 'Not Applicable'); 

        $rateDetails = $inventory->addChild('RATEDETAILS.LIST');
        $rateDetails->addChild('GSTRATEDUTYHEAD', 'State Cess');
        $rateDetails->addChild('GSTRATEVALUATIONTYPE', 'Based on Value');
    }

	/**
	 * Vocher with inventories ledger
	 */
	private function ledgerWithInventories($voucher_child,$sales_details,$leger_arr,$customer_name,$inventory_amount) {
		$gst_percntg = $sales_details->cgst + $sales_details->sgst + $sales_details->igst + $sales_details->tcs;
        $gst_all = $sales_details->CGST_AMT + $sales_details->SGST_AMT + $sales_details->IGST_AMT + $sales_details->TCS_AMT;
        $gst_on_amount = ($sales_details->Total - $gst_all);

		$leger_arr = array(
				"Total" => $sales_details->Total + $sales_details->TCS_AMT,
				"CGST"  => $sales_details->CGST_AMT,
				"SGST"  => $sales_details->SGST_AMT,
				"TCS"   => $sales_details->TCS_AMT, 
				"IGST"  => $sales_details->IGST_AMT,
		);

    
       //remove those items which are with 0 values.
        foreach ($leger_arr as $key => $value) {
            if ($value < 0.01) {
                unset($leger_arr[$key]);
            }
        }

        if($sales_details->TCS_AMT > 0.01){
            $tcsAmountPresent = true;
        }

       foreach ($leger_arr as $key => $value) {
            $ledger_entries = $voucher_child->addChild('LEDGERENTRIES.LIST');
            if ($key == "Total") {
                $ledger_entries->addChild('LEDGERNAME', $customer_name); 
				$this->legder_entries_defaults1($ledger_entries);

				$ledger_entries->addChild('AMOUNT', "-" . $value);
				$ledger_entries->addChild('SERVICETAXDETAILS.LIST', ''); //Hard Coded
				$ledger_entries->addChild('BANKALLOCATIONS.LIST', ''); //Hard Coded
              
                $bill_allocations = $ledger_entries->addChild('BILLALLOCATIONS.LIST');
                $bill_allocations->addChild('NAME', $sales_details->sales_number);
                if(!empty($sales_details->payment_terms)){
                    $bill_creditperiod = $bill_allocations->addChild('BILLCREDITPERIOD',$sales_details->payment_terms . " Days");
                    $bill_creditperiod->addAttribute('P', $sales_details->payment_terms . " Days");
                }
                $bill_allocations->addChild('BILLTYPE', 'New Ref');	//New Ref
                $bill_allocations->addChild('TDSDEDUCTEEISSPECIALRATE', 'No');
                $bill_allocations->addChild('AMOUNT', "-" . $value);
                $bill_allocations->addChild('INTERESTCOLLECTION.LIST', ''); //Hard Coded
                $bill_allocations->addChild('STBILLCATEGORIES.LIST', ''); //Hard Coded
                    
                if($tcsAmountPresent == true){
                    $ledger_entries->addChild('OLDAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('AUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INPUTCRALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('DUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('RATEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('SUMMARYALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('STPYMTDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXBILLALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //Hard Coded


                    $tax_obj_allocations = $ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST');
                    $tax_obj_allocations->addChild('CATEGORY','Sale of Goods');
                    $tax_obj_allocations->addChild('TAXTYPE','TCS');
                    $tax_obj_allocations->addChild('PARTYLEDGER',$customer_name);
                    //$tax_obj_allocations->addChild('EXPENSES','Central GST (CGST)');    //TODO  - WHAT IF THE IGST IS THERE ?
                    $tax_obj_allocations->addChild('REFTYPE','New Ref');
                    $tax_obj_allocations->addChild('ISOPTIONAL','No');
                    $tax_obj_allocations->addChild('ISBASEDONREALIZATION','No');
                    $tax_obj_allocations->addChild('ISPANVALID','No');
                    $tax_obj_allocations->addChild('ZERORATED', 'No');
                    $tax_obj_allocations->addChild('EXEMPTED','No');
                    $tax_obj_allocations->addChild('ISSPECIALRATE','No');
                    $tax_obj_allocations->addChild('ISDEDUCTNOW','No');
                    $tax_obj_allocations->addChild('ISPANNOTAVAILABLE','No');
                    $tax_obj_allocations->addChild('ISSUPPLEMENTARY','No');
                    $tax_obj_allocations->addChild('ISPUREAGENT','No');
                    $tax_obj_allocations->addChild('HASINPUTCREDIT','No');
                    $tax_obj_allocations->addChild('ISTDSDEDUCTED', 'No');

                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Income Tax');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $tax_value_for_this = $leger_arr['CGST'] + $leger_arr['SGST']  + $leger_arr['IGST'];
                    $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $tax_value_for_this);
                    
                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Surcharge');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Education Cess');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Secondary Education Cess');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $ledger_entries->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATSTATUTORYDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('COSTTRACKALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('REFVOUCHERDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INVOICEWISEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATITCDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ADVANCETAXDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXTYPEALLOCATIONS.LIST', ''); //Hard Coded
                }
				//$this->legder_entries_defaults2($ledger_entries);
				                
            } else {
                $ledger_entries->addChild('APPROPRIATEFOR', 'Not Applicable');

                if ($key === "TCS") {
                    $ledger_entries->addChild('ROUNDTYPE', 'Normal Rounding');
                    $ledger_entries->addChild('LEDGERNAME', 'TCS TAX');
                    $ledger_entries->addChild('METHODTYPE', 'TCS');
                    $ledger_entries->addChild('GSTCLASS', 'Not Applicable');
                }else{
                    $ledger_entries->addChild('ROUNDTYPE', 'Not Applicable');
                    $ledger_entries->addChild('LEDGERNAME', $key); // Replace with the customer's ledger name
                    $ledger_entries->addChild('METHODTYPE', 'GST');
                    $ledger_entries->addChild('GSTCLASS', 'Not Applicable');
                }
                    $ledger_entries->addChild('ISDEEMEDPOSITIVE', 'No');
                    $ledger_entries->addChild('LEDGERFROMITEM', 'No');
                    $ledger_entries->addChild('REMOVEZEROENTRIES', 'Yes');
                    $ledger_entries->addChild('ISPARTYLEDGER', 'No');
                    $ledger_entries->addChild('GSTOVERRIDDEN', 'No');
                    $ledger_entries->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No');
                    $ledger_entries->addChild('STRDISGSTAPPLICABLE', 'No');
                    $ledger_entries->addChild('STRDGSTISPARTYLEDGER', 'No');
                    $ledger_entries->addChild('STRDGSTISDUTYLEDGER', 'No');
                    $ledger_entries->addChild('CONTENTNEGISPOS', 'No');
                    $ledger_entries->addChild('ISLASTDEEMEDPOSITIVE', 'No');
                    $ledger_entries->addChild('ISCAPVATTAXALTERED', 'No');
                    $ledger_entries->addChild('ISCAPVATNOTCLAIMED', 'No');
                    $ledger_entries->addChild('AMOUNT', $value);
                    $ledger_entries->addChild('VATEXPAMOUNT', $value);

                    $ledger_entries->addChild('SERVICETAXDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('BANKALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('BILLALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INTERESTCOLLECTION.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('OLDAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('AUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INPUTCRALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('DUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('RATEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('SUMMARYALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('STPYMTDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXBILLALLOCATIONS.LIST', ''); //Hard Coded

                    $tax_obj_allocations_tcs = $ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST');

                    if ($key === "TCS") {
                        //tally import category - budhale uses this and other can also use it
                        $tax_obj_allocations_tcs->addChild('CATEGORY', $sales_details->tally_category);
                        $tax_obj_allocations_tcs->addChild('TAXTYPE','TCS');
                        $tax_obj_allocations_tcs->addChild('PARTYLEDGER', $customer_name);
                        $tax_obj_allocations_tcs->addChild('EXPENSES', $sales_details->tally_category);
                        $tax_obj_allocations_tcs->addChild('REFTYPE', 'New Ref');//Hard coded
                        $tax_obj_allocations_tcs->addChild('ISOPTIONAL', 'No');
                        $tax_obj_allocations_tcs->addChild('ISBASEDONREALIZATION', 'No');
                        $tax_obj_allocations_tcs->addChild('ISPANVALID', 'No');
                        $tax_obj_allocations_tcs->addChild('ZERORATED', 'No');
                        $tax_obj_allocations_tcs->addChild('EXEMPTED', 'No');
                        $tax_obj_allocations_tcs->addChild('ISSPECIALRATE','No');
                        $tax_obj_allocations_tcs->addChild('ISDEDUCTNOW', 'No');
                        $tax_obj_allocations_tcs->addChild('ISPANNOTAVAILABLE', 'No');
                        $tax_obj_allocations_tcs->addChild('ISSUPPLEMENTARY', 'No');
                        $tax_obj_allocations_tcs->addChild('ISPUREAGENT', 'No');
                        $tax_obj_allocations_tcs->addChild('HASINPUTCREDIT', 'No');
                        $tax_obj_allocations_tcs->addChild('ISTDSDEDUCTED', 'No');
                        $tax_obj_allocations_tcs->addChild('OLDAUDITENTRIES.LIST');
                        $tax_obj_allocations_tcs->addChild('ACCOUNTAUDITENTRIES.LIST');
                        $tax_obj_allocations_tcs->addChild('AUDITENTRIES.LIST');

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Income Tax');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                    
                        $sub_cate_allocations->addChild('TAXRATE', $sales_details->tcs);//TO-DO : TCS: tax rate should be added
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $inventory_amount);//TO-DO TOTAL TAXABLE VALUE 
                        $sub_cate_allocations->addChild('TAX', $value); //TCS VALUE

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Surcharge');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $value); //TO-DO: TCS: TOTAL TAXABLE VALUE

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Education Cess');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $value); //TO-DO: TCS: TOTAL TAXABLE VALUE

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Secondary Education Cess');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $value); //TO-DO: TCS: TOTAL TAXABLE VALUE
                    }

                    $ledger_entries->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATSTATUTORYDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('COSTTRACKALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('REFVOUCHERDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INVOICEWISEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATITCDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ADVANCETAXDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXTYPEALLOCATIONS.LIST', ''); //Hard Coded
                
            }
        }
	}

	private function legder_entries_defaults1($ledger_entries){
			$ledger_entries->addChild('GSTCLASS', 'Not Applicable'); //Hard Coded
			$ledger_entries->addChild('ISDEEMEDPOSITIVE', 'Yes'); // <!-- Specifies whether the ledger entry is positive or negative (e.g., "Yes" for positive). -->
			$ledger_entries->addChild('LEDGERFROMITEM', 'No'); //Hard Coded
			$ledger_entries->addChild('REMOVEZEROENTRIES', 'No'); //Hard Coded
			$ledger_entries->addChild('ISPARTYLEDGER', 'Yes'); //TO-DO
			$ledger_entries->addChild('GSTOVERRIDDEN', 'No'); //Hard Coded
			$ledger_entries->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //Hard Coded
			$ledger_entries->addChild('STRDISGSTAPPLICABLE', 'No'); //Hard Coded
			$ledger_entries->addChild('STRDGSTISPARTYLEDGER', 'No'); //Hard Coded
			$ledger_entries->addChild('STRDGSTISDUTYLEDGER', 'No'); //Hard Coded
			$ledger_entries->addChild('CONTENTNEGISPOS', 'No'); //Hard Coded
			$ledger_entries->addChild('ISLASTDEEMEDPOSITIVE', 'Yes'); //Hard Coded
			$ledger_entries->addChild('ISCAPVATTAXALTERED', 'No'); //Hard Coded
			$ledger_entries->addChild('ISCAPVATNOTCLAIMED', 'No'); //Hard Coded
	}

	private function legder_entries_defaults2($ledger_entries){
		$ledger_entries->addChild('INTERESTCOLLECTION.LIST', ''); //Hard Coded
		$ledger_entries->addChild('OLDAUDITENTRIES.LIST', ''); //Hard Coded
		$ledger_entries->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //Hard Coded
		$ledger_entries->addChild('AUDITENTRIES.LIST', ''); //Hard Coded
		$ledger_entries->addChild('INPUTCRALLOCS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('DUTYHEADDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('RATEDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('SUMMARYALLOCS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('STPYMTDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TAXBILLALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('VATSTATUTORYDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('COSTTRACKALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('REFVOUCHERDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('INVOICEWISEDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('VATITCDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('ADVANCETAXDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TAXTYPEALLOCATIONS.LIST', ''); //Hard Coded
	}

    /**
     * Inventory specific voucher child default fields
     */
    private function vocher_inventory_default_fields($voucher_child)
    {
        
        $voucher_child->addChild('ISDELETED', 'No'); //Hard Coded
        $voucher_child->addChild('ISSECURITYONWHENENTERED', 'No'); //Hard Coded
        $voucher_child->addChild('ASORIGINAL', 'No');//Hard Coded
        $voucher_child->addChild('AUDITED', 'No');//Hard Coded
        $voucher_child->addChild('ISCOMMONPARTY', 'No');//Hard Coded
        $voucher_child->addChild('FORJOBCOSTING', 'No');//Hard Coded
		$voucher_child->addChild('ISOPTIONAL', 'No');//Hard Coded

        $voucher_child->addChild('USEFOREXCISE', 'No');//Hard Coded
        $voucher_child->addChild('ISFORJOBWORKIN', 'No');//Hard Coded
        $voucher_child->addChild('ALLOWCONSUMPTION', 'No');//Hard Coded
        $voucher_child->addChild('USEFORINTEREST', 'No');//Hard Coded
		$voucher_child->addChild('USEFORGAINLOSS', 'No');//Hard Coded
        $voucher_child->addChild('USEFORGODOWNTRANSFER', 'No');//Hard Coded
		$voucher_child->addChild('USEFORCOMPOUND', 'No');//Hard Coded
        $voucher_child->addChild('USEFORSERVICETAX', 'No');//Hard Coded
        $voucher_child->addChild('ISREVERSECHARGEAPPLICABLE', 'No');//Hard Coded
        $voucher_child->addChild('ISSYSTEM', 'No');//Hard Coded
        $voucher_child->addChild('ISFETCHEDONLY', 'No');//Hard Coded
        $voucher_child->addChild('ISGSTOVERRIDDEN', 'No');//Hard Coded
		$voucher_child->addChild('ISCANCELLED', 'No');//Hard Coded
        $voucher_child->addChild('ISONHOLD', 'No');//Hard Coded
        $voucher_child->addChild('ISSUMMARY', 'No');//Hard Coded
        $voucher_child->addChild('ISECOMMERCESUPPLY', 'No');//Hard Coded
        $voucher_child->addChild('ISBOENOTAPPLICABLE', 'No');//Hard Coded
        $voucher_child->addChild('ISGSTSECSEVENAPPLICABLE', 'No');//Hard Coded
        $voucher_child->addChild('IGNOREEINVVALIDATION', 'No');//Hard Coded
        $voucher_child->addChild('CMPGSTISOTHTERRITORYASSESSEE', 'No');//Hard Coded

        $voucher_child->addChild('PARTYGSTISOTHTERRITORYASSESSEE', 'No');//Hard Coded
        $voucher_child->addChild('IRNJSONEXPORTED', 'No');//Hard Coded
		$voucher_child->addChild('IRNCANCELLED', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREGSTCONFLICTINMIG', 'No');//Hard Coded
        $voucher_child->addChild('ISOPBALTRANSACTION', 'No');//Hard Coded
        $voucher_child->addChild('IGNOREGSTFORMATVALIDATION', 'No');//Hard Coded
        $voucher_child->addChild('ISELIGIBLEFORITC', 'Yes'); //TO-DO

        $voucher_child->addChild('UPDATESUMMARYVALUES', 'No');//Hard Coded
		$voucher_child->addChild('ISEWAYBILLAPPLICABLE', 'No'); //Hard Coded

		$voucher_child->addChild('ISDELETEDRETAINED', 'No'); //Hard Coded
        $voucher_child->addChild('ISNULL', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISEVOUCHER', 'No'); //Hard Coded
        $voucher_child->addChild('EXCISETAXOVERRIDE', 'No'); //Hard Coded
        $voucher_child->addChild('USEFORTAXUNITTRANSFER', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXER1NOPOVERWRITE', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXF2NOPOVERWRITE', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXER3NOPOVERWRITE', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREPOSVALIDATION', 'No'); //Hard Coded
        $voucher_child->addChild('EXCISEOPENING', 'No'); //Hard Coded
        $voucher_child->addChild('USEFORFINALPRODUCTION', 'No'); //Hard Coded
        $voucher_child->addChild('ISTDSOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISTCSOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISTDSTCSCASHVCH', 'No'); //Hard Coded
        $voucher_child->addChild('INCLUDEADVPYMTVCH', 'No'); //Hard Coded
        $voucher_child->addChild('ISSUBWORKSCONTRACT', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREORIGVCHDATE', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATPAIDATCUSTOMS', 'No'); //Hard Coded
        $voucher_child->addChild('ISDECLAREDTOCUSTOMS', 'No'); //Hard Coded
        $voucher_child->addChild('VATADVANCEPAYMENT', 'No'); //Hard Coded
        $voucher_child->addChild('VATADVPAY', 'No'); //Hard Coded
        $voucher_child->addChild('ISCSTDELCAREDGOODSSALES', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATRESTAXINV', 'No'); //Hard Coded
        $voucher_child->addChild('ISSERVICETAXOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISISDVOUCHER', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISEOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISESUPPLYVCH', 'No'); //Hard Coded
        $voucher_child->addChild('GSTNOTEXPORTED', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREGSTINVALIDATION', 'No'); //Hard Coded
        $voucher_child->addChild('ISGSTREFUND', 'No'); //Hard Coded
        $voucher_child->addChild('OVRDNEWAYBILLAPPLICABILITY', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATPRINCIPALACCOUNT', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISVCHNUMUSED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISINCLUDED', 'Yes'); //TO-DO
		$voucher_child->addChild('VCHGSTSTATUSISUNCERTAIN', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISEXCLUDED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISAPPLICABLE', 'Yes'); //TO-DO
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BRECONCILED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BONLYINPORTAL', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BONLYINBOOKS', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BMISMATCH', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BINDIFFPERIOD', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISRETEFFDATEOVERRDN', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISOVERRDN', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISSTATINDIFFDATE', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISRETINDIFFDATE', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSMAINSECTIONEXCLUDED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISBRANCHTRANSFEROUT', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISSYSTEMSUMMARY', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISUNREGISTEREDRCM', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISOPTIONAL', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISCANCELLED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISDELETED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISOPENINGBALANCE', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISFETCHEDONLY', 'No'); //Hard Coded
        $voucher_child->addChild('PAYMENTLINKHASMULTIREF', 'No'); //Hard Coded
        $voucher_child->addChild('ISSHIPPINGWITHINSTATE', 'No'); //Hard Coded
        $voucher_child->addChild('ISOVERSEASTOURISTTRANS', 'No'); //Hard Coded
        $voucher_child->addChild('ISDESIGNATEDZONEPARTY', 'No'); //Hard Coded
        $voucher_child->addChild('HASCASHFLOW', 'No'); //Hard Coded
		
		$voucher_child->addChild('ISPOSTDATED', 'No'); //Hard Coded
		$voucher_child->addChild('USETRACKINGNUMBER', 'No'); //Hard Coded
		$voucher_child->addChild('ISINVOICE', 'Yes'); //TO-DO

        $voucher_child->addChild('MFGJOURNAL', 'No'); //Hard Coded
        $voucher_child->addChild('HASDISCOUNTS', 'No');  //Hard Coded
		$voucher_child->addChild('ASPAYSLIP', 'No'); //Hard Coded
		$voucher_child->addChild('ISCOSTCENTRE', 'No');  //Hard Coded
        $voucher_child->addChild('ISSTXNONREALIZEDVCH', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISEMANUFACTURERON', 'No');  //Hard Coded
        $voucher_child->addChild('ISBLANKCHEQUE', 'No');  //Hard Coded
        $voucher_child->addChild('ISVOID', 'No');  //Hard Coded
        $voucher_child->addChild('ORDERLINESTATUS', 'No');  //Hard Coded
        $voucher_child->addChild('VATISAGNSTCANCSALES', 'No');  //Hard Coded
        $voucher_child->addChild('VATISPURCEXEMPTED', 'No');  //Hard Coded
        $voucher_child->addChild('ISVATRESTAXINVOICE', 'No');  //Hard Coded
        $voucher_child->addChild('VATISASSESABLECALCVCH', 'No');  //Hard Coded
		$voucher_child->addChild('ISVATDUTYPAID', 'Yes'); //TO-DO
        $voucher_child->addChild('ISDELIVERYSAMEASCONSIGNEE', 'No');  //Hard Coded
        $voucher_child->addChild('ISDISPATCHSAMEASCONSIGNOR', 'No');  //Hard Coded
        $voucher_child->addChild('ISDELETEDVCHRETAINED', 'No');  //Hard Coded
        $voucher_child->addChild('CHANGEVCHMODE', 'No');  //Hard Coded
        $voucher_child->addChild('RESETIRNQRCODE', 'No');  //Hard Coded

		//$voucher_child->addChild('ALTERID', '5'); //TO-D0 For isWithInventory ??
		//$voucher_child->addChild('MASTERID', '1'); //TO-DO
		//$voucher_child->addChild('VOUCHERKEY', '194914205827080'); //TO-DO
		//$voucher_child->addChild('VOUCHERRETAINKEY', '1'); //TO-DO
		$voucher_child->addChild('VOUCHERNUMBERSERIES', 'Default'); //TO-DO

        $voucher_child->addChild('EWAYBILLDETAILS.LIST'); //Hard Coded
        $voucher_child->addChild('EXCLUDEDTAXATIONS.LIST'); //Hard Coded
        $voucher_child->addChild('OLDAUDITENTRIES.LIST'); //Hard Coded
        $voucher_child->addChild('ACCOUNTAUDITENTRIES.LIST'); //Hard Coded
        $voucher_child->addChild('AUDITENTRIES.LIST'); //Hard Coded
        $voucher_child->addChild('DUTYHEADDETAILS.LIST'); //Hard Coded
        $voucher_child->addChild('GSTADVADJDETAILS.LIST'); //Hard Coded
   }

    
	
	/* public function getFactorsForSticker($requiredQty,$defaultQty) {
		if($defaultQty > 1){
			$factors = array($defaultQty ,100, 50, 20, 10, 1);
		}else{
			$factors = array(100, 50, 20, 10, 1);
		}
		$result = array();

		foreach ($factors as $factor) {
			$count = intdiv($requiredQty, $factor);
			$result[$factor] = $count;
			$requiredQty -= $count * $factor;
		}

		//remove items with 0 
		foreach ($result as $factor => $count) {
			if($count==0) {
				unset($result[$factor]);
			}
		  }
		return $result;
	} */


	public function getSalesPartPackaging_details()
	{
		$sales_id = $this->input->post('salesId');
		$invoice_date = $this->input->post('invoice_date');
		$invoice_no = $this->input->post('invoice_no');
		//$data['sales_part_id'] = $sales_id;

		$data['sales_parts'] = $this->Crud->customQuery("select cp.id as cpid, parts.id, cp.part_number,cp.part_description, cp.packaging_qty, parts.qty as requiredQty
		FROM sales_parts parts, customer_part cp
		WHERE parts.sales_id = ".$sales_id."
		AND parts.part_id = cp.id");
		$data['sales_id'] = $sales_id;
		$data['invoice_no'] = $invoice_no;
		$data['invoice_date'] = $invoice_date;
		$html = $this->load->view('sales/print_stickers', $data,TRUE);
		$return_arr['html'] =$html;
        echo json_encode($return_arr);
        exit();
	}


	public function print_packing_sticker() {
		// Get the total number of items in the form
		$totalItems = $this->input->post('totalItems');
		$invoice_no = $this->input->post('invoice_no');
		$invoice_date = $this->input->post('invoice_date');
		// pr($this->input->post(),1);
		if($totalItems < 1){
			exit();
		}

		$stickerFrom = $this->input->post('stickerFrom');
		$dataSets[] = array();
		// Retrieve values for "requiredQty" fields
		for ($i = 1; $i <= $totalItems; $i++) {
			//UI field name is requiredQty
			$fieldRequiredQty = "requiredQty" . $i;
			$default_pack_qty = "default_pack_qty" . $i;
			$part_name = "part_name" . $i;
			$part_no = "part_no" . $i;
			
			$dataSets[] = array(
				'part_no' => $_POST[$part_no],
				'part_name' => $_POST[$part_name],
				'defaultQty' => $_POST[$default_pack_qty],
				'requiredQty' => $_POST[$fieldRequiredQty],
				'factors' => $this->Common_admin_model->calculateAllFactorsForSticker($_POST[$fieldRequiredQty],$_POST[$default_pack_qty])
			);
		}

		$printData[] = array();
		//iterate through all the factors for each individual
		foreach ($dataSets as $dataset) {
			//echo "<br>";
			$arr_data = $dataset['factors'];
			foreach ($arr_data as $factor) {
				for ($i = 1; $i <= $factor['count']; $i++) {
					$printData[] = array(
						'Invoice No' => $invoice_no,
						'Date' => $invoice_date,
						'Part No' => $dataset['part_no'],
						'Part Name' => $dataset['part_name'],
						'Invoice Qty' => $dataset['requiredQty'],
						'Packing Qty'=> $factor['factor'],
						'Checked By' => ''
					);
				}
			 }
		 } 

		 //print_r($printData);
		 
		$sales_id = $this->input->post("sales_id");
		$sales_data = $this->Crud->customQuery(
			"SELECT c.customer_name, c.vendor_code, n.sales_number, n.created_date, p.part_number, 
			p.part_description, s.qty as quantity, n.customer_part_id 
			FROM new_sales n, sales_parts s, customer c, customer_part p
			WHERE s.id = ".$sales_id." 
			AND s.sales_id = n.id
			AND s.part_id = p.id
			AND n.customer_id = c.id");
		 

		$html_content_header = '
            <!DOCTYPE html>
              <style> 
                  html { margin: 0px; }
                  td {
                    border: 0px solid black;
                    border-collapse: collapse;
                    padding-top: 0px;
                    padding-bottom: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }		
    
                @media print {
                    .container{ 
                      width: auto; 
                      height: auto; 
                      margin: 0px auto; 
                    } 
    
                  @page 
                  {
                    size: A4;   /* auto is the initial value */
					margin-top: 13mm; 
                    margin-left: 8mm;  /* this affects the margin in the printer settings */
					margin-right: 7mm;
					margin-bottom: 12mm; 
					padding: 0;
               //     size: landscape; /* Set the print layout to landscape */
                  }
                /*  body {
                    margin-top: 0px; 
                    margin-left: 0px;
                    margin-bottom: 0px; 
                    margin-right: 0px;
                }*/
              }
    
             </style>
             <link rel="stylesheet" href="'.base_url('').'dist/css/arom.css">
          </head><body>
          <script>
            function printSection() {
                var printContent = document.getElementById("print-section").innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
            }
            </script>
			<button class="print-button" onclick="printSection()"><span class="print-icon"></span></button>
    </div>
	<br>
	<div id="print-section" style="background-color: white; width:auto;margin-left: 8mm; ">
	<style type="text/css">

	.new_page {
		margin-top: 0px; 
		margin-left: 0px;
		margin-bottom: 0px; 
		margin-right: 0mm
		margin: 0;
		padding: 0;
		border : 0px solid;
		background-color: white;
		size: A4;
		}

	#sticker {
		height: 34mm;
		width: 65mm;
		border : 0px solid;
		//padding-right: 13.22px;
		background-color : white;
		
	}

	#stickerContent {
		border: 0px solid black;
		border-collapse: collapse;
		padding-top: 2px;
		padding-left: 5px;
		background-color : white;
	}		

	.ritz .waffle {
		color: inherit;
		background-color: #ffffff;
		text-align: left;
		color: #000000;
		font-family: "sans-serif";
		vertical-align: bottom;
		white-space: wrap;
		direction: ltr;
	}

	.ritz .waffle .s0 {
		font-weight: normal;
		font-size: 18px;
	}
	
	.ritz .waffle .s1 {
		font-size: 14px;
	}
	
	.small_container {
		display: flex;
	  }

	.row {
		width: 50%;
	  }

	</style>';


	$html_content_data .='<div class="ritz grid-container new_page" dir="ltr">
	<table border="0" style="padding-left:0px;">
	<tbody>';

	$returnArray = $this->getBlankStickers($stickerFrom,$html_content_data);
	$rowNo = $returnArray[0]; 
	$totalStickers = $returnArray[1]; 
	$totalCntBlank = $returnArray[2];
	$html_content_data = $returnArray[3];
	$j = $returnArray[4];

	$pagCount = 1;
	foreach ($dataSets as $dataset) {
		$arr_data = $dataset['factors'];
		foreach ($arr_data as $factor) {
			for ($i = 1; $i <= $factor['count']; $i++) {	
				if($rowNo == 1 && $j==3){ //new page
					if($pagCount > 1){//We don't need a page break for first page so...
						$html_content_data .='<div style="page-break-after: always;"></div>';
					}
					$html_content_data .='
							<div class="ritz grid-container new_page" dir="ltr">
							<table border="0" style="padding-left:15px;">
							<tbody>';
				}
				$returnArray1 = $this->gePageStickers($rowNo,$totalStickers,$html_content_data,$dataset,$factor,$invoice_no,$j,$invoice_date);
				$rowNo = $returnArray1[0]; 
				$totalStickers = $returnArray1[1]; 
				$html_content_data = $returnArray1[2];
				$j = $returnArray1[3];
			
				if($rowNo == 9 && $j==3){ //close the table if all the options are filled..
					$rowNo = 1;
					$pagCount++;
					$html_content_data .='</tbody></table></div>';
				}
			}	
		}
	}
	
	$html_content_footer = '<tbody></table></div></div>';
	$html_content = $html_content_header.$html_content_data.$html_content_footer;
	echo $html_content;

	//$this->pdf->setPaper('A4', 'landscape');
	//$this->pdf->loadHtml($html_content);
	//$this->pdf->render();
    //$this->pdf->stream("PDI-".$sales_data[0]->part_number, array("Attachment" => 1));
		
	}


	private function gePageStickers($rowNo,$totalStickers,$html_content_data,$dataset,$factor,$invoice_no,$j,$invoice_date) {
		if($totalStickers == 1 || $totalStickers % 3 == 1) {
			$html_content_data.= '<tr>';
			$j = 0;
		} 
	
		$html_content_data .='<td>';
		$html_content_data .='
					<div id="sticker">
						<div class="waffle" cellspacing="0" cellpadding="0" width="100px" style="border: 0px solid;">
							<div id="stickerTbody" width="100%">
								<div id="stickerContent">
									<div>
										<div class="s0" dir="ltr"><b>'.$this->getCustomerNameDetails().'</b></div>
									</div>
									<div>
										<div class="s1" dir="ltr">
											<span style="font-weight:normal;">Invoice No.</span>: '.$invoice_no.'</div>
									</div>
									<div>
										<div class="s1" dir="ltr">
											<span style="font-weight:normal;">Date</span>: '.$invoice_date.'
										</div>
									</div>
									<div>
										<div class="s1" dir="ltr">
											<span style="font-weight:normal;">Part No</span>.: '.$dataset['part_no'].'</div>
									</div>
									<div>
										<div class="s1" style="width:100%;overflow:hidden;white-space: nowrap;" dir="ltr">
											<span style="font-weight:normal;">Part Name</span>: '.$dataset['part_name'].'</div>
									</div>
									<div class="s1 small_container" dir="ltr"> 
											<div class="row">Invoice Qty: '.$dataset['requiredQty'].'</div>
											<div class="row">Packing Qty: '.$factor['factor'].'</div>
									</div>
									<div class="s1 small_container" dir="ltr"> 
											<div class="row">Gross WT:</div>
											<div class="row">Checked By:</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					</td>';
						$j++;
						$totalStickers++;
						
						if($j == 3) {
							$html_content_data.= '</tr>';
							$rowNo++;
						}
						
				
		return array($rowNo, $totalStickers, $html_content_data , $j);
	}

	private function getBlankStickers($stickerFrom,$html_content_data) {
		$rowNo = 1;
		$totalStickers = 1;
		$totalCntBlank = 1;
		for ($i = 1; $i < $stickerFrom; $i++) {
			if($totalCntBlank == 1 || $totalCntBlank % 3 == 1) {
				$html_content_data.= '<tr>';
				$j = 0;
			}

			$html_content_data .='<td>';
			$html_content_data .='
								<div id="sticker">
									<div class="waffle" cellspacing="0" cellpadding="0" width="100px" style="border: 0px solid;">
										<div id="stickerTbody" width="100%">1&nbsp;
										</div>
									</div>
								</div>
								</td>';
								$j++;
								$totalCntBlank++;
								$totalStickers++;
								
								if($j == 3) {
									$html_content_data.= '</tr>';
									$rowNo++;
								}
		}
		return array($rowNo, $totalStickers, $totalCntBlank,$html_content_data,$j);
	}

	public function receivable_report()
	{
		checkGroupAccess("receivable_report","list","Yes");
		$data['customers'] = $this->Crud->read_data("customer");
		$data['selected_customer_part_id'] = $customer_part_id;

		$column[] = [
            "data" => "customer_name",
            "title" => "CUSTOMER NAME",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "sales_number",
            "title" => "Sales Inv No",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "created_date_val",
            "title" => "Sales Inv Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "subtotal",
            "title" => "Basic Amount Total",
            "width" => "10%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "gst",
            "title" => "GST Total Amount",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "row_total",
            "title" => "Total Amount With GST",
            "width" => "17%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "payment_terms",
            "title" => "Payment Terms in Days",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "due_date",
            "title" => "Due Date",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "due_days",
            "title" => "Due Days",
            "width" => "17%",
            "className" => "dt-center due_days_block",
			
        ];
        $column[] = [
            "data" => "amount_received",
            "title" => "Amount Received",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "tds_amount",
            "title" => "TDS",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
       
       	$column[] = [
            "data" => "bal_amnt",
            "title" => "Balance Amount to Receive",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "payment_receipt_date_formated",
            "title" => "Payment Receipt Date",
            "width" => "7%",
            "className" => "dt-center",
        ];
        
        
        $column[] = [
            "data" => "transaction_details",
            "title" => "Transaction Details",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        
        
        $column[] = [
            "data" => "remark_val",
            "title" => "Remark",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];

		$column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "sales_id_val",
            "title" => "sales_id_val",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false,
			"visible" => false
        ];
		
		$date_filter = date("Y/m/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
		$data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[16,'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
		$current_year = (int) date("Y");
        if(!((int) date("m",1) > 3)){
            $current_year--;
        }
        $date_filter = date("$current_year/04/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['export_start_date'] = $date_filter[0];
        $data['export_end_date'] = $date_filter[1];
        $data['client_data'] = $this->Crud->read_data("client");
        $config_data = $this->Crud->read_data("global_configuration");
        $config_data = array_column($config_data,"config_value","config_name");
        $data['selected_unit'] = $config_data['allUnitExport'] == "Yes" ? "" : $this->Unit->getSessionClientId();
        $data['all_unit_export'] = $config_data['allUnitExport'];
		$this->loadView('reports/receivable_report',$data);
	}


	public function getReceivableReportData(){
		$customer_part_id  = $this->input->post("customer_part_id");
		$post_data = $this->input->post();

        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
			if ($key == 0) {
				$order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
				$order_by .=
				"," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
		
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
		
		$data = $this->SalesModel->getReceivableReportView($condition_arr,$post_data["search"]);
		
		// pr($this->db->last_query(),1);
		foreach ($data as $key => $objs) {
			$date_convert = DateTime::createFromFormat('d-m-Y', $objs['created_date']);
			// Format the date to d/m/Y
			$objs['created_date'] = $date_convert->format('d/m/Y');

			$created_date_str = $objs['created_date'];
            
			$payment_receipt_date_formated  = '';
			$subtotal = round($objs['ttlrt'] - $objs['gstamnt'], 2);
			$row_total = round($objs['ttlrt'], 2) + round($objs['tcsamnt'], 2);
			if (($objs['payment_receipt_date'] != '')) {
				$payment_receipt_date_formated =  date("d/m/Y", strtotime($objs['payment_receipt_date']));
			}
			$data[$key]['subtotal'] = $subtotal;
			$data[$key]['row_total'] = number_format($row_total,2,".","");
			$data[$key]['payment_receipt_date_formated'] = $payment_receipt_date_formated;
			$tds_amount = $data[$key]['tds_amount'] = $objs['tds_amount'] > 0 ? $objs['tds_amount'] : 0;

			// $data[$key]['bal_amnt'] = $row_total - $val['amount_received'] - $tds_amount;

			// Create a DateTime object by specifying the format
			$dateTime = DateTime::createFromFormat('d/m/Y', $created_date_str);
			$due_date = display_no_character("");
			
			if ($dateTime && is_numeric($objs['payment_terms'])) {
				// Convert payment_terms to an integer for days
				$payment_terms_days = (int)$objs['payment_terms'];
		
				// Add payment_terms (in days) to the created date
				$dateTime->add(new DateInterval('P' . $payment_terms_days . 'D'));
		
				// Get the formatted due date
				$due_date = $dateTime->format('d/m/Y');
		
				
			}

			$today = new DateTime();
        
			$due_days_status = display_no_character("");

            if($due_date != display_no_character("")){
            	if(!empty($objs['payment_receipt_date']) && $objs['payment_receipt_date'] != "" && $objs['payment_receipt_date'] != NULL ){

            		$sales_date = $objs['created_date'];
            		$sales_date = DateTime::createFromFormat("d/m/Y", $sales_date);
					// Format to the desired output
					$sales_date = $sales_date->format("Y-m-d");
            		$payment_receipt_date = $objs['payment_receipt_date'];
            		$sales_date = new DateTime($sales_date);
					$payment_receipt_date = new DateTime($payment_receipt_date);
					// Calculate the difference
					$interval = $sales_date->diff($payment_receipt_date);

					// Get the difference in days
					$due_days = $interval->days;

                }else{
                    $dueDateObject = DateTime::createFromFormat('d/m/Y', $due_date);
                    // Calculate the interval between the due date and today's date
					$interval = $today->diff($dueDateObject);
					
					// Get the difference in days
					$due_days = $interval->format('%r%a');
                }
            	

				$due_days_status = "normal";
                if($due_days <= 0 && empty($objs['payment_receipt_date']))
                {
                    $due_days_status = "danger";
                }

			}

			$data[$key]['due_date'] = $due_date;
			$data[$key]['due_days'] = $due_days;
			$data[$key]['due_days_status'] = $due_days_status;
		}
		// pr($data,1);
		foreach ($data as $key => $value) {
			$edit_data = base64_encode(json_encode($value)); 
			$data[$key]['action'] = display_no_character("");
			if(checkGroupAccess("receivable_report","update","No")){
				$data[$key]['action'] = "<i class='ti ti-edit edit-part' title='Edit' data-value='$edit_data'></i>";
			}
		}

		$data["data"] = $data;
        $total_record = $this->SalesModel->getReceivableReportCount([], $post_data["search"]);
        $total_with_gst_val = 0;
        $total_paid_amount = 0;
        $total_balance_amount_to_pay = 0;
        $total_tds_amount = 0;
		foreach ($total_record as $key => $value) {
			$row_total = round($value['ttlrt'],2) + round($value['tcsamnt'],2);
			$total_with_gst_val += $row_total;
			$total_paid_amount += $value['amount_received'];
			$total_tds_amount += $value['tds_amount'];
			if($value['bal_amnt'] > 0){
				$total_balance_amount_to_pay += $value['bal_amnt'];
			}
		}
        $data["recordsTotal"] = count($total_record);
        $data["recordsFiltered"] = count($total_record);
        $data["total_with_gst_val"] = number_format($total_with_gst_val,2);
        $data["total_paid_amount"] = number_format($total_paid_amount,2);
        $data["total_balance_amount_to_pay"] = number_format($total_balance_amount_to_pay,2);
        $data["total_tds_amount"] = number_format($total_tds_amount,2);
        echo json_encode($data);
	}

	public function outstanding_report()
	{
		
		checkGroupAccess("outstanding_report","list","Yes");
		$data['customers'] = $this->Crud->read_data("customer");
		$data['supplier'] = $this->Crud->read_data("supplier");

		$column[] = [
            "data" => "customer_name",
            "title" => "Party Name <br>(CUSTOMER/Supplier)",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "receivable_amount",
            "title" => "Receivable Amount Due<br>(With GST)",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "payable_amount",
            "title" => "Payable Amount Due<br>(With GST)",
            "width" => "17%",
            "className" => "dt-center",
        ];
        
        
        $current_year = (int) date("Y");
        if(!((int) date("m",1) > 3)){
        	$current_year--;
        }

		$date_filter = date("$current_year/04/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
		$data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[0, 'asc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500,5000], [10,50,100,200,500,1000,2500,5000]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
		$this->loadView('reports/outstanding_report',$data);
	}
	public function getOutstandingReportData(){
		$customer_part_id  = $this->input->post("customer_part_id");
		$post_data = $this->input->post();

        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
			if ($key == 0) {
				$order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
				$order_by .=
				"," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
		
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
		
		$outstanding_data = [];
		$recevivable_data = [];
		$total_paid_amount = 0;
		if(!($post_data["search"]['supplier_id'] > 0) || ($post_data["search"]['customer_id'] > 0)){
		$data = $this->SalesModel->getOutstandingReportView($condition_arr,$post_data["search"]);

			foreach ($data as $key => $val) {
				if(array_key_exists($val['customer_id'], $outstanding_data)){
					$outstanding_data[$val['customer_id']]['receivable_amount'] +=round($val['bal_amnt'],2);
				}else{
					$outstanding_data[$val['customer_id']] = [
						"customer_name" => $val['customer_name'],
						"receivable_amount" => round($val['bal_amnt']),
						"payable_amount" => ""
					];
				}
				
				
			}
			$recevivable_data =  array_values($outstanding_data);
		}

		$total_paid_amount = array_sum(array_column($outstanding_data, "receivable_amount"));

	


		$payable_data = [];
		if(!($post_data["search"]['customer_id'] > 0)|| ($post_data["search"]['supplier_id'] > 0)){
			$data = $this->SalesModel->getOutstandingPayableReportView($condition_arr,$post_data["search"]);
			// pr($data);
			foreach ($data as $key => $val) {
				$gst_amount = (float)($val['sgst_amount'] + $val['cgst_amount'] + $val['igst_amount'] + $val['tcs_amount']);
            	$total_with_gst = $gst_amount + $val['base_amount'];  
            	$bal_amnt = $total_with_gst - $val['amount_received'] - $val['tds_amount'];
            	if($val['bal_amnt'] > 0){
					if(array_key_exists($val['supplier_id'], $payable_data)){
						$payable_data[$val['supplier_id']]['payable_amount'] += round($bal_amnt,2);
					}else{
						$payable_data[$val['supplier_id']] = [
							"customer_name" => $val['customer_name'],
							"payable_amount" => round($bal_amnt,2),
							"receivable_amount" => ""
						];
					}
				}
				
			}
			$payable_data =  array_values($payable_data);
		}
		$total_pay_amount = array_sum(array_column($payable_data, "payable_amount"));
		$data = array_merge($recevivable_data,$payable_data);
		$data = array_merge($recevivable_data,$payable_data);
		$chunk_number = $post_data["start"]/$post_data["length"];
		$array_chunk = array_chunk($data,$post_data["length"]);
		$data = $array_chunk[($chunk_number)];
		// pr($data,1);
		$data["data"] = is_valid_array($data) ? $data : [];
	    
	    $payable_count_data = [];
	    $receivable_count_data = count($recevivable_data) + count($payable_data);
		
		
		// pr($total_paid_amount,1);
        $data["recordsTotal"] = count($outstanding_data);
        $data["recordsFiltered"] = count($outstanding_data);
        $data["total_paid_amount"] = number_format($total_paid_amount,2);
        $data["total_pay_amount"] = number_format($total_pay_amount,2);
        $data["total_diff"] = number_format($total_paid_amount - $total_pay_amount,2);
        echo json_encode($data);
	}

	public function generateOutsandingPdf($html_content = "",$header="",$footer="",$type="",$pdf_download_type="",$extra_condition ="normal"){
		$get_data = $this->input->get();

		$date_filter =  $get_data['date'];
		
		$pending_to_recived_data = $this->SalesModel->getOutstandingReportData($date_filter);
		$customer_wise_data = [];
		foreach ($pending_to_recived_data as $key => $objs) {
			$objs['type'] = "recive";
			$date = DateTime::createFromFormat('d-m-Y', $objs['created_date']);
			$objs['created_date'] = $date->format('d/m/Y');
			$created_date_str = $objs['created_date'];
			$dateTime = DateTime::createFromFormat('d/m/Y', $objs['created_date']);
			
			$due_date = display_no_character("");
			if ($dateTime && is_numeric($objs['payment_terms'])) {
				// Convert payment_terms to an integer for days
				$payment_terms_days = (int)$objs['payment_terms'];
		
				// Add payment_terms (in days) to the created date
				$dateTime->add(new DateInterval('P' . $payment_terms_days . 'D'));
		
				// Get the formatted due date
				$due_date = $dateTime->format('d/m/Y');
		
				
			}
			$due_days_status = display_no_character("");
			$today = new DateTime();
			$due_days = display_no_character("");
            if($due_date != display_no_character("")){
            	if(!empty($objs['payment_receipt_date']) && $objs['payment_receipt_date'] != "" && $objs['payment_receipt_date'] != NULL ){

            		$sales_date = $objs['created_date'];
            		$sales_date = DateTime::createFromFormat("d/m/Y", $sales_date);
					// Format to the desired output
					$sales_date = $sales_date->format("Y-m-d");
            		$payment_receipt_date = $objs['payment_receipt_date'];
            		$sales_date = new DateTime($sales_date);
					$payment_receipt_date = new DateTime($payment_receipt_date);
					// Calculate the difference
					$interval = $sales_date->diff($payment_receipt_date);

					// Get the difference in days
					$due_days = $interval->days;

                }else{
                    $dueDateObject = DateTime::createFromFormat('d/m/Y', $due_date);

                    // Calculate the interval between the due date and today's date
					$interval = $today->diff($dueDateObject);
					
					// Get the difference in days
					$due_days = $interval->format('%r%a');
                }
            	

				$due_days_status = "normal";
                if($due_days <= 0 && empty($objs['payment_receipt_date']))
                {
                    $due_days_status = "danger";
                }

			}
			$objs['due_days'] = $due_days;
			$objs['due_date'] = $due_date;
			if($objs['bal_amnt'] > 0){
				$customer_wise_data[$objs['customer_id']][] = $objs;
			}
		}
		$customer_wise_data = array_values($customer_wise_data);
		$formatted_date = $date->format('d-m-Y');
		$pending_to_payable_data = $this->SalesModel->getOutstandingPayableReportData($date_filter);
		
		$supplier_wise_data = [];
		foreach ($pending_to_payable_data as $key => $objs) {
			$objs['type'] = "pay";
			$dateTime = DateTime::createFromFormat('d-m-Y', $objs['created_date_val']);

            $due_date = display_no_character("");
            if ($dateTime && is_numeric($objs['payment_days'])) {
                // Convert payment_terms to an integer for days
                $payment_terms_days = (int)$objs['payment_days'];
                // Add payment_terms (in days) to the created date
                $dateTime->add(new DateInterval('P' . $payment_terms_days . 'D'));
                // Get the formatted due date
                $due_date = $dateTime->format('d/m/Y');
                $due_date = defaultDateFormat($due_date);
            }
            
           
            $today = new DateTime();
            // Convert due date string to a DateTime object
            $due_days = display_no_character("");
            if($due_date != display_no_character("")){
                if(!empty($objs['payment_receipt_date'])){
                    $sales_date = $objs['created_date_val'];

                    $sales_date = DateTime::createFromFormat("d-m-Y", $sales_date);
                    // Format to the desired output
                    $sales_date = $sales_date->format("Y-m-d");
                    $payment_receipt_date = $objs['payment_receipt_date'];
                    $sales_date = new DateTime($sales_date);
                    $payment_receipt_date = new DateTime($payment_receipt_date);
                    // Calculate the difference
                    $interval = $sales_date->diff($payment_receipt_date);

                    // Get the difference in days
                    $due_days = $interval->days;
                }else{
                    $dueDateObject = DateTime::createFromFormat('d/m/Y', $due_date);
                     // Calculate the interval between the due date and today's date
                    $interval = $today->diff($dueDateObject);
                    // Get the difference in days
                    $due_days = $interval->format('%r%a'); // This will give the difference in days with respect to today's date
                }
                
               
                $due_days_status = "normal";
                if($due_days <= 0 && empty($objs['payment_receipt_date']))
                {
                    $due_days_status = "danger";
                }
            }
            
            $objs['due_days'] = $due_days;
            $objs['due_date'] = $due_date;
            $gst_amount = (float)($objs['sgst_amount'] + $objs['cgst_amount'] + $objs['igst_amount'] + $objs['tcs_amount']);
 			$total_with_gst = $gst_amount + $objs['base_amount']; 
 			$bal_amnt = $total_with_gst - $objs['amount_received'] - $objs['tds_amount'];
 			$objs['bal_paybele_amnt'] = number_format($bal_amnt, 2, '.', ''); 
			$supplier_wise_data[$objs['id']][] = $objs;
		}
		
		$supplier_wise_data = array_values($supplier_wise_data);
		// pr($supplier_wise_data,1);
		$data['date_filter'] = $date_filter;
		$data['date'] = $get_data['date'];
		$data['merge_arr'] = array_merge($customer_wise_data,$supplier_wise_data);
		// pr($supplier_wise_data,1);
        $html_content = $this->smarty->fetch('sales/outstanding_report.tpl', $data, TRUE);
        $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set margins (adjust as needed)
        $pdf->SetMargins(7, 7, 7, 7);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);

        // Disable header and footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Enable auto page breaks (optional)
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Add a page
        $pdf->AddPage();

        // set some text to print
        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

        // output the HTML content
        $pdf->writeHTML($html_content, true, false, true, false, '');

        $pdf->Output("outstanding_report.pdf", 'D');
             ob_end_flush();
    } 



	public function update_receivable_report()
	{
		$message = "something went wrong.";
		$success = 0;
		$sales_number = $this->input->post('sales_number');
		$payment_receipt_date = $this->input->post('payment_receipt_date');
		$amount_received = $this->input->post('amount_received');
		$transaction_details = $this->input->post('transaction_details');
		$tds = $this->input->post('tds');
		$remark = $this->input->post('remark');
		$check = $this->Common_admin_model->get_data_by_id_count("receivable_report", $this->input->post('sales_number'), "sales_number");
		
		if ($check == 0) 
		{
		    $data = array(
						"sales_number" => $sales_number,
						"payment_receipt_date" => $payment_receipt_date,
						"amount_received" => $amount_received,
						"transaction_details" => $transaction_details,
						"tds_amount" => $tds,
						"remark" => $remark
					);
					$result = $this->Crud->insert_data("receivable_report", $data);
			$message = "Updated Sucessfully";
			$success = 1;
			// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} 
		else 
		{

			$data = array(
				"sales_number" => $sales_number,
				"payment_receipt_date" => $payment_receipt_date,
				"amount_received" => $amount_received,
				"transaction_details" => $transaction_details,
				"tds_amount" => $tds,
				"remark" => $remark
				
			);
			// pr($data,1);
			$result = $this->Crud->update_data_column("receivable_report", $data, $sales_number, "sales_number");
		// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			$message = "Updated Sucessfully";
			$success = 1;
		}
		$return_arr = array(
	        'message' => $message,
	        'success' => $success
	    );

	    echo json_encode($return_arr);
	    exit();
	}
}
