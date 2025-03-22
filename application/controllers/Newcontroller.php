<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class Newcontroller extends CommonController
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Kolkata');

		$this->user_name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
		$this->current_date = date('d-m-Y');
		$this->current_time = date('h:i:s');


		$d = date_parse_from_format("d-m-Y", $this->current_date);
		$this->date = $d["day"];
		$this->month = $d["month"];
		$this->year = $d["year"];

		$d = date_parse_from_format("d-m-Y", $this->current_date);
		$this->date = $d["day"];
		$this->month = $d["month"];
		$this->year = $d["year"];
		$this->load->model('SupplierParts');
		$this->load->model('CustomerPart');
	}

	public function view_new_sales_by_id_rejection()
	{
		$sales_id = $this->uri->segment('2');

		$data['new_sales'] = $this->Crud->get_data_by_id("new_sales_rejection", $sales_id, "id");
		$data['customer'] = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$data['uom'] = $this->Crud->read_data("uom");

		$this->load->view('header');
		$this->load->view('view_new_sales_by_id_rejection', $data);
		$this->load->view('footer');
	}

	public function view_rejection_flow()
	{
		$sales_id = $this->uri->segment('2');

		$data['new_sales'] = $this->Crud->get_data_by_id("rejection_flow_new", $sales_id, "id");
		$data['new_rejection_flow_parts'] = $this->Crud->get_data_by_id("new_rejection_flow_parts", $sales_id, "rejection_flow_new_id");
		$data['customer'] = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$data['uom'] = $this->Crud->read_data("uom");
		$child_part_list = $this->db->query('SELECT DISTINCT part_number FROM `child_part`');
		$data['child_part_list'] = $child_part_list->result();
		$child_part_list = $this->db->query('SELECT DISTINCT part_number FROM `customer_part`');
		$data['customer_part_list'] = $child_part_list->result();
		$this->load->view('header');
		$this->load->view('view_rejection_flow', $data);
		$this->load->view('footer');
	}

	public function generate_new_po()
	{
		
		$po_discount_type = $this->input->post("discount_type");
		$notes = $this->input->post('notes');
		$shipping_address = $this->input->post('shipping_address');
		$billing_address = $this->input->post('billing_address');
		$supplier_id = $this->input->post('supplier_id');
		$po_date = $this->input->post('po_date');
		$expiry_po_date = $this->input->post('expiry_po_date');
		$remark = $this->input->post('remark');
		$process_id = $this->input->post('process_id');
		$loading_unloading = $this->input->post('loading_unloading');
		$loading_unloading_gst = $this->input->post('loading_unloading_gst');
		$freight_amount = $this->input->post('freight_amount');
		$freight_amount_gst = $this->input->post('freight_amount_gst');
		//$data['new_po'] = $this->Crud->read_data("new_po");
		$supplier_data = $this->Crud->get_data_by_id("supplier", $supplier_id, "id");
		
		$discount_type_blanck = "No";
		$discount_type = "";
		$discount = "";
		if($po_discount_type == "PO Level"){
			$discount_type = $supplier_data[0]->discount_type;
			$discount = $supplier_data[0]->discount;
			if($supplier_data[0]->discount_type == "" || $supplier_data[0]->discount == "" ||$supplier_data[0]->discount_type == null || $supplier_data[0]->discount == null){
				$discount_type_blanck = "Yes";
			}
		}
		$success = 0;
		$message = "Something went wrong";
		$redirect_url = "";
		if($discount_type_blanck == "No"){
			if (empty($process_id)) {
				$sql = "SELECT po_number FROM new_po WHERE po_number like '" . $this->getPOSerialNo() . "%' order by id desc LIMIT 1";
				$latestSeqFormat = $this->Crud->customQuery($sql);
				foreach ($latestSeqFormat as $p) {
					$currentPONo = $p->po_number;
				}

				$po_number = substr($currentPONo, strlen($this->getPOSerialNo())) + 1;
				$po_number = $this->getPOSerialNo() . $po_number;

			} else {
				$isSubPO = true; // we don't have other loading, unloading or freight amount there..
				$sql = "SELECT po_number FROM new_po WHERE po_number like '" . $this->getSUBPOSerialNo() . "%' order by id desc LIMIT 1";
				$latestSeqFormat = $this->Crud->customQuery($sql);
				foreach ($latestSeqFormat as $p) {
					$currentSubPONo = $p->po_number;
				}
				$po_number = substr($currentSubPONo, strlen($this->getSUBPOSerialNo())) + 1;
				$po_number = $this->getSUBPOSerialNo() . $po_number;
			}

			if($isSubPO == false) { // needed only for regular PO
				$loading_unloading_gst_data = $this->Crud->get_data_by_id("gst_structure", $loading_unloading_gst, "id");
				$freight_amount_gst_data = $this->Crud->get_data_by_id("gst_structure", $freight_amount_gst, "id");

				$cgst_amount = 0;
				$sgst_amount = 0;
				$igst_amount = 0;

				if (!empty($loading_unloading_gst_data)) {
					$loading_cgst_amount = ($loading_unloading_gst_data[0]->cgst * $loading_unloading) / 100;
					$loading_sgst_amount = ($loading_unloading_gst_data[0]->sgst * $loading_unloading) / 100;
					$loading_igst_amount = ($loading_unloading_gst_data[0]->igst * $loading_unloading) / 100;

					$cgst_amount = $loading_cgst_amount;
					$sgst_amount = $loading_sgst_amount;
					$igst_amount = $loading_igst_amount;
				}
				if (!empty($freight_amount_gst_data)) {
					$freight_cgst_amount_ = ($freight_amount_gst_data[0]->cgst * $freight_amount) / 100;

					$freight_sgst_cgst = ($freight_amount_gst_data[0]->sgst * $freight_amount) / 100;

					$freight_igst_cgst = ($freight_amount_gst_data[0]->igst * $freight_amount) / 100;

					$cgst_amount = $cgst_amount + $freight_cgst_amount_;
					$sgst_amount = $sgst_amount + $freight_sgst_cgst;
					$igst_amount = $igst_amount + $freight_igst_cgst;
				}
				$final_amount = $loading_unloading + $freight_amount + $cgst_amount + $sgst_amount + $igst_amount;
			}

			$data = array(
				"final_amount" => $final_amount,
				"supplier_id" => $supplier_id,
				"po_number" => $po_number,
				"loading_unloading_gst" => $loading_unloading_gst,
				"loading_unloading" => $loading_unloading,
				"freight_amount" => $freight_amount,
				"freight_amount_gst" => $freight_amount_gst,
				"po_date" => $po_date,
				"expiry_po_date" => $expiry_po_date,
				"remark" => $remark,
				"created_by" => $this->user_id,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"created_by" => $this->current_date,
				"created_day" => $this->date,
				"created_month" => $this->month,
				"created_year" => $this->year,
				"process_id" => $process_id,
				"notes" => $notes,
				"billing_address" => $billing_address,
				"shipping_address" => $shipping_address,
				"clientId" => $this->Unit->getSessionClientId(),
				"po_discount_type" => $po_discount_type,
				"discount_type" => $discount_type,
				"discount" => $discount
			);


			$result = $this->Crud->insert_data("new_po", $data);
			if ($result) {
				$success = 1;
				$message = "PO generated successfully.";
				$redirect_url =  base_url('view_new_po_by_id/'). $result;
				// echo "<script>alert('Successfully Added');document.location='" . base_url('view_new_po_by_id/') . $result . "'</script>";
			} else {
				$message = "Unable to Add";
				// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}else{
			$message = "Add discount in supplier master";
			// echo "<script>alert('Add discount in supplier master');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$return_arr = [
			"message" => $message,
			"success" => $success,
			"redirect_url" => $redirect_url
		];
		echo json_encode($return_arr);
		exit();
	}



	public function generate_challan_subcon()
	{
		// $challan_number = $this->input->post('challan_number');
		$sub_po_id = $this->input->post('sub_po_id');
		$customer_id = $this->input->post('customer_id');
		// $challan_number = $this->input->post('challan_number');
		$sub_po_id = $this->input->post('sub_po_id');
		$supplier_id = $this->input->post('supplier_id');
		$vechical_number = $this->input->post("vechical_number");
		$remark = $this->input->post("remark");
		$mode = $this->input->post("mode");
		$transpoter = $this->input->post("transpoter");
		$l_r_number = $this->input->post("l_r_number");


		$latestSeqFormat = $this->Crud->customQuery("SELECT challan_number FROM challan_subcon WHERE challan_number like '" . $this->getChallanSerialNo() . "%' order by id desc LIMIT 1");
		foreach ($latestSeqFormat as $p) {
			$currentChallanNo = $p->challan_number;
		}

		// $challan_num = substr($currentChallanNo, strlen($this->getChallanSerialNo())) + 1;
		$challan_num = substr($currentChallanNo, strlen($this->getChallanSerialNo()));
		$challan_num = (int)$challan_num + 1;
		$challan_number = $this->getChallanSerialNo() . $challan_num;
		// pr($challan_num,1);
		$data = array(
			"challan_number" => $challan_number,
			"customer_id" => $customer_id,
			"remark" => $remark,
			"vechical_number" => $vechical_number,
			"mode" => $mode,
			"transpoter" => $transpoter,
			"l_r_number" => $l_r_number,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"day" => $this->date,
			"month" => $this->month,
			"year" => $this->year,
			"clientId" => $this->Unit->getSessionClientId()
		);

		$result = $this->Crud->insert_data("challan_subcon", $data);
		// if ($result) {
		// 	echo "<script>alert('Successfully Added');document.location='" . base_url('view_challan_by_id_subcon/') . $result . "'</script>";
		// } else {
		// 	echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		// }
		if ($result) {
						$success = 1;
						$messages = "Successfully Added.";
											} else {
						$success = 0;
						$messages = "Unable to Add.";
											}

					$return_arr['success']=$success;
					$return_arr['messages']=$messages;
					echo json_encode($return_arr);
					exit;


	}
	public function generate_new_po_sub()
	{
		$supplier_id = $this->input->post('supplier_id');
		$po_date = $this->input->post('po_date');
		$expiry_po_date = $this->input->post('expiry_po_date');
		$process_id = $this->input->post('process_id');
		$remark = $this->input->post('remark');
		$data['new_po'] = $this->Crud->read_data("new_po");

		$sql = "SELECT po_number FROM new_po_sub WHERE po_number like '" . $this->getSUBPOSerialNo() . "%' order by id desc LIMIT 1";
		$latestSeqFormat = $this->Crud->customQuery($sql);
		foreach ($latestSeqFormat as $p) {
			$currentPONo = $p->po_number;
		}

		$po_number = substr($currentPONo, strlen($this->getSUBPOSerialNo())) + 1;
		$po_number = $this->getSUBPOSerialNo() . $po_number;

		$data = array(
			"supplier_id" => $supplier_id,
			"po_number" => $po_number,
			"po_date" => $po_date,
			"expiry_po_date" => $expiry_po_date,
			"remark" => $remark,
			"created_by" => $this->user_id,
			"process_id" => $this->process_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"created_by" => $this->current_date,
			"created_day" => $this->date,
			"created_month" => $this->month,
			"created_year" => $this->year,
		);
		$result = $this->Crud->insert_data("new_po_sub", $data);
		if ($result) {
			echo "<script>alert('Successfully Added');document.location='" . base_url('view_new_po_by_id_sub/') . $result . "'</script>";
		} else {
			echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}


	public function generate_new_sales_subcon()
	{
		$customer_id = $this->input->post('customer_id');

		$remark = $this->input->post('remark');
		$po_date = $this->input->post('po_date');

		$mode = $this->input->post('mode');
		$transporter = $this->input->post('transporter');
		$vehicle_number = $this->input->post('vehicle_number');
		$lr_number = $this->input->post('lr_number');
		$po_number = $this->input->post('po_number');

		$expiry_po_date = $this->input->post('expiry_po_date');
		$data['new_sales'] = $this->Crud->read_data("new_sales");
		/* $count = $this->Crud->read_data_num("new_sales_subcon") + 1;
		$po_number = $this->getCustomerPrefix()."/".$this->getFinancialYear()."/" . $count;*/

		$sql = "SELECT sales_number FROM new_sales_subcon WHERE sales_number like '" . $this->getSUBCON_SerialNo() . "%' order by id desc LIMIT 1";
		$latestSeqFormat = $this->Crud->customQuery($sql);
		foreach ($latestSeqFormat as $p) {
			$currentSaleNo = $p->sales_number;
		}
		$po_number = substr($currentSaleNo, strlen($this->getSUBCON_SerialNo())) + 1;
		$po_number = $this->getSUBCON_SerialNo() . $po_number;

		$data = array(
			"customer_id" => $customer_id,
			"sales_number" => $po_number,
			"remark" => $remark,
			"mode" => $mode,
			"transporter" => $transporter,
			"vehicle_number" => $vehicle_number,
			"lr_number" => $lr_number,
			"po_number" => $po_number,
			"expiry_po_date" => $expiry_po_date,
			"po_date" => $po_date,
			"created_by" => $this->user_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"created_by" => $this->current_date,
			"created_day" => $this->date,
			"created_month" => $this->month,
			"created_year" => $this->year,
		);

		$result = $this->Crud->insert_data("new_sales_subcon", $data);
		if ($result) {
			echo "<script>alert('Successfully Added');document.location='" . base_url('view_new_sales_by_id_subcon/') . $result . "'</script>";
		} else {
			echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}


	public function update_customer_po_tracking_all()
	{
		$id = $this->input->post('id');
		$end_date = $this->input->post('end_date');


		// 	"contractor_code" => $number,
		// );
		// $check = $this->Crud->read_data_where("contractor", $data);
		// if ($check != 0) {
		// 	echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		// } else {
		$data = array(
			"po_end_date" => $end_date,

		);
		$result = $this->Crud->update_data_column("customer_po_tracking", $data, $id, "id");
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		//}
	}

	//View PO
	public function view_new_po_by_id()
	{
		$new_po_id = $this->uri->segment('2');
		$data['process'] = $this->Crud->read_data("process");

		$new_po = $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
		$supplier = $data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
		$data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");
		$po_parts = array_column($data['po_parts'], "id");
		$grn_part_arr = [];
		if(count($po_parts) > 0){
			$po_parts = implode(",",$po_parts);
			$grn_details = $this->Crud->customQuery('
				SELECT  g.id, g.po_part_id
				FROM `inwarding` as i 
				LEFT JOIN grn_details as g ON i.id = g.inwarding_id 
				where  g.po_part_id in (' . $po_parts . ') AND i.status != "pending" AND i.status != ""  AND g.po_number = '.$new_po_id);
			// pr($,1);
			$grn_part_arr = array_column($grn_details,"po_part_id");
		}
		$data['grn_part_arr'] = $grn_part_arr;
		// pr($grn_part_arr,1);
		$data['child_part'] = $this->Crud->customQuery('SELECT DISTINCT part_number, supplier_id FROM `child_part_master` where supplier_id = ' . $data['supplier'][0]->id . '');

		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$process_id = $data['new_po'][0]->process_id;
		if (empty($process_id)) {
			$isSubPO = false;
		}else{
			$isSubPO = true;
		}
		$data['isSubPO'] = $isSubPO;
		$final_po_amount = 0;
		$po_part = $data['po_parts'];

		foreach ($po_part as $key=>$p) {
			$data_arr = array(
            	'supplier_id' => $supplier[0]->id,
                "child_part_id" => $p->part_id,
            );
            $child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data_arr);
            $po_part[$key]->child_part_data = $child_part_data;               
            $part_rate_new = 0;
            if (empty($p->rate)) {
            	$part_rate_new = $child_part_data[0]->part_rate;
            } else {
            	$part_rate_new = $p->rate;
            }
            $po_part[$key]->part_rate_new = $part_rate_new;
            $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
            $po_part[$key]->uom_data = $uom_data;  
            $total_rate_old = $part_rate_new * $p->qty;
            
            if ($new_po[0]->po_discount_type == "Part Level"){
            	$part_rate_discount_amount = ($part_rate_new*$p->discount)/100;
				$after_dicount_part_rate = $part_rate_new-$part_rate_discount_amount;
				$total_rate_old = $after_dicount_part_rate*$p->qty;
            }
            $gst_structure = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");

            $po_part[$key]->gst_structure = $gst_structure;  
            $po_part[$key]->total_rate_old = $total_rate_old;  
            $po_part[$key]->cgst_amount = $cgst_amount = ($total_rate_old * $gst_structure[0]->cgst) / 100;
            $po_part[$key]->sgst_amount= $sgst_amount  = ($total_rate_old * $gst_structure[0]->sgst) / 100;
            $po_part[$key]->igst_amount= $igst_amount  = ($total_rate_old * $gst_structure[0]->igst) / 100;
            $po_part[$key]->gst_amount= $gst_amount  = $cgst_amount + $sgst_amount + $igst_amount;
            $po_part[$key]->total_rate = $total_rate = $total_rate_old + $cgst_amount + $sgst_amount + $igst_amount;
            $final_po_amount = $final_po_amount + $total_rate;
        }
        // pr($new_po,1);

        $data['po_parts'] = $po_part;
        $data['final_po_amount'] = $final_po_amount;
        $po_parts_opt = '';
        foreach ($data['child_part'] as $c) {
			$array = array(
			"part_number" => $c->part_number,
			"supplier_id" =>  $supplier[0]->id,
			"admin_approve" => "accept"
			);
			$array23 = array(
			"part_number" => $c->part_number,
			);
			$c = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array);
			if ($c) {
				$c2 = $this->Crud->get_data_by_id_multiple_condition("child_part", $array23);
				$gst_structure = $this->Crud->get_data_by_id("gst_structure", $c[0]->gst_id, "id");
				if (empty($new_po[0]->process_id)) {
					$type = "normal";
				} else {
					$type = "Subcon grn";
				}
				if ($type == "normal") {
					if ($c2[0]->sub_type != "Subcon grn") {
						$po_parts_opt .= "
					<option value='".$c2[0]->id."'> ".$c2[0]->part_number . " // " . $c2[0]->part_description . " // " . $supplier[0]->supplier_name . "//" . $c[0]->part_rate . " // " . $gst_structure[0]->code . "//" . $c2[0]->max_uom ."
					</option>";
					}
				} else {
				   if ($c2[0]->sub_type == "Subcon grn" || $c2[0]->sub_type == "Subcon Regular") {
				   	$po_parts_opt .= "
					<option value='".$c2[0]->id."'>
					 ".$c2[0]->part_number . " // " . $c2[0]->part_description . " // " . $supplier[0]->supplier_name . "//" . $c[0]->part_rate . " // " . $gst_structure[0]->code . "//" . $c2[0]->max_uom ."
					</option>";
					}
				}
			}
		}
		$data['po_parts_opt'] = $po_parts_opt;
		$data['user_type'] = $this->session->userdata['type'];
		$expired = "no";
        if ($new_po[0]->expiry_po_date > date('Y-m-d')) {
        	$expired =  "yes";
       	}
        if (empty($new_po[0]->process_id)) {
        	$type = "normal";
        } else {
        	$type = "Subcon grn";
        }
        $data['type'] = $type;
        $data['expired'] = $expired;
        $statusNew = "";
        $status_value = "";
        if ($expired == "no") {
        	$status_value = $statusNew  = "Expired";
        } else if ($new_po[0]->status == "accept") {
        	$status_value = $statusNew  = "Released";
        } else {
        	$status_value = $new_po[0]->status;
        }
        $data['status_value'] = $status_value;
        $data['statusNew'] = $statusNew;
		// pr($data,1);
		// $this->load->view('header');
		// $this->load->view('view_new_po_by_id', $data);
		// $this->load->view('footer');
		$this->loadView('purchase/view_new_po_by_id', $data);
	}
	public function view_new_po_by_id1()
	{
		$new_po_id = $this->uri->segment('2');
		$data['process'] = $this->Crud->read_data("process");

		$data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
		$data['expired'] = 'no';
		if (isset($data['new_po'][0]->expiry_po_date) && strtotime($data['new_po'][0]->expiry_po_date) < time()) {
		    $data['expired'] = 'yes';
		}
		// pr($data['expired'],1);
		
		$data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");

		$data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");
		$data['child_part'] = $this->Crud->customQuery('SELECT DISTINCT part_number, supplier_id FROM `child_part_master` where supplier_id = ' . $data['supplier'][0]->id . '');

		foreach ($data['child_part'] as $key => $c) {
			$array = array("part_number" => $c->part_number,"supplier_id" =>  $data['supplier'][0]->id,"admin_approve" => "accept");
			$array23 = array("part_number" => $c->part_number);
			$c = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array);
			$data['child_part'][$key]->c = $c;
			$data['child_part'][$key]->c2 = [];
			$data['child_part'][$key]->gst_structure = [];
			if ($c) {
				$c2 = $this->Crud->get_data_by_id_multiple_condition("child_part", $array23);
				$data['child_part'][$key]->c2 = $c2;
				$gst_structure = $this->Crud->get_data_by_id("gst_structure", $c[0]->gst_id, "id");
				$data['child_part'][$key]->gst_structure = $gst_structure;
				if (empty($data['new_po'][0]->process_id)) {
					$type = "normal";
				} else {
					$type = "Subcon grn";
				}
			}
		}


		// table data
		foreach ($data['po_parts'] as $key => $p) {
			$data_con = array('supplier_id' => $data['supplier'][0]->id,"child_part_id" => $p->part_id);
			$child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data_con);
			$data['po_parts'][$key]->child_part_data = $child_part_data;
			$uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
			$data['po_parts'][$key]->uom_data = $uom_data;
			$gst_structure = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
			$data['po_parts'][$key]->gst_structure = $gst_structure;

		}
		// pr($data,1);
		// $this->load->view('header');
		// $this->load->view('view_new_po_by_id',$data);
		$this->loadView('purchase/view_new_po_by_id', $data);
		// $this->load->view('footer');
	}


	public function view_new_po_by_id_sub()
	{
		$new_po_id = $this->uri->segment('2');

		$data['new_po'] = $this->Crud->get_data_by_id("new_po_sub", $new_po_id, "id");
		$data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$data['uom'] = $this->Crud->read_data("uom");

		$arr = array(
			'supplier_id' => $data['supplier'][0]->id,
		);

		$data['po_parts'] = $this->Crud->get_data_by_id("po_parts_sub", $new_po_id, "po_id");

		$child_part_list = $this->db->query('SELECT DISTINCT part_number,supplier_id FROM `child_part_master` where supplier_id = ' . $data['supplier'][0]->id . '');
		$data['child_part'] = $child_part_list->result();


		$this->load->view('header');
		$this->load->view('view_new_po_by_id_sub', $data);
		$this->load->view('footer');
	}

	public function view_challan_by_id_subcon()
	{
		$CI =& get_instance();

		// Load the model
		$CI->load->model('SupplierParts');
		$challan_id = $this->uri->segment('2');
		$data['challan_id'] = $challan_id;
		$data['challan_data'] = $this->Crud->get_data_by_id("challan_subcon", $challan_id, "id");
		$data['child_part']  = $this->Crud->customQuery("SELECT * FROM `child_part` WHERE sub_type = 'customer_bom' ");
		foreach ($data['child_part'] as $key => $c) {
			$data['child_part'][$key]->child_part_data = [];
			if ($c->sub_type == "customer_bom") {
				$data['child_part'][$key]->child_part_data = $this->SupplierParts->getSupplierPartByPartNumber($c->part_number);
			}
		}
		$data['process'] = $this->Crud->read_data("process");

		$role_management_data = $this->db->query('SELECT id,sub_type,part_number,part_description FROM `child_part` ');
		$data['challan_parts'] = $this->Crud->customQuery("
		SELECT cps.*,cph.status as challan_parts_history_status,cph.qty as challan_parts_history_qty,cph.id as challan_parts_history_id,cph.accepeted_qty as challan_parts_history_accepeted_qty ,cp.part_number as part_number,cp.part_description as part_description
		FROM `challan_parts_subcon` as cps
		LEFT JOIN challan_parts_history as cph ON cph.part_id = cps.part_id
		LEFT JOIN child_part as cp ON cp.id = cps.part_id
		WHERE cps.challan_id = '$challan_id' ORDER BY cps.id DESC"
	);
	// pr($data['challan_parts'],1);
	$data['customer'] = $this->Crud->get_data_by_id("customer", $data['challan_data'][0]->customer_id, "id");

	// $this->load->view('header');
	$this->loadView('store/view_challan_by_id_subcon', $data);
	// $this->load->view('footer');
}
public function get_po_sales_parts()
{
	$po_id = $this->input->post('id');
	$salesno = $this->input->post('salesno');
	
	$customer_tracking_parts = $this->Crud->get_data_by_id("parts_customer_trackings", $po_id, 'customer_po_tracking_id');
	//$customer_part = $this->Crud->get_data_by_id("customer_part", $customer_tracking_parts[0]->part_id,'id');

	echo '';
	if ($customer_tracking_parts) {
		foreach ($customer_tracking_parts  as $val) {
			$query = "SELECT * FROM customer_part WHERE id = " . $val->part_id . "";

				$result = $this->db->query($query);
				if (count($result->result_array()) > 0) {
					//$data=$result->result_array();		

				// $html.='<option value="">Select State</option>';
				foreach ($result->result_array() as $key => $value) {

					$customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($value['part_number']);
					//$gst_structure = $this->Crud->get_data_by_id("gst_structure", $value['gst_id'], 'id');
					$customer_part  = $this->Crud->get_data_by_id("customer_part", $val->part_id, 'id');
					$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $val->part_id, 'customer_master_id');
					//$sales_parts = $this->Crud->get_data_by_id("sales_parts", $val->part_id, 'part_id');
					//$sales = $this->Crud->get_data_by_id("new_sales", $salesno, 'sales_number');
					/*if ($sales[0]->status == 'lock') {
					$balance_qty = (int) $val->qty - (int) $sales_parts[0]->qty;
				} else {
				$balance_qty = (int) $val->qty;
			}*/
			if(!empty($customer_part_rate[0]->rate))
			{
				echo '<option value="' . $value['id'] . '">' . $value['part_number'] . '//' . $value['part_description'] . '//' . $customer_parts_master_data[0]->fg_stock. '//' . $customer_part_rate[0]->rate .'//'. $customer_part[0]->packaging_qty .'</option>';

			}
		}

		//echo $html;
	}
}
} else {

	echo '<option value=""></option>';
}
echo '';
}


public function view_new_sales_by_id_subcon()
{
	$sales_id = $this->uri->segment('2');

	$data['new_sales'] = $this->Crud->get_data_by_id("new_sales_subcon", $sales_id, "id");
	$data['customer'] = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
	$data['gst_structure'] = $this->Crud->read_data("gst_structure");
	$data['uom'] = $this->Crud->read_data("uom");



	$data['po_parts'] = $this->Crud->get_data_by_id("sales_parts_subcon", $sales_id, "sales_id");

	$role_management_data2 = $this->db->query('SELECT * FROM `customer_part` WHERE type ="subcon_po"  ');
	$data['child_part'] = $role_management_data2->result();

	$this->load->view('header');
	$this->load->view('view_new_sales_by_id_subcon', $data);
	$this->load->view('footer');
}

public function view_po_by_supplier_id_sub()
{
	$supplier_id = $this->uri->segment('2');

		// $this->load->view('header');
		$this->loadView('purchase/view_po_by_supplier_id', $data);
		// $this->load->view('footer');
}
public function view_po_by_supplier_id()
	{
		$supplier_id = $this->uri->segment('2');
		$data['supplier_data'] = $this->Crud->get_data_by_id("supplier", $supplier_id, "id");
		$data['new_po'] = $this->Crud->customQuery("SELECT * FROM new_po WHERE clientId = ".$this->Unit->getSessionClientId()." AND supplier_id = ".$supplier_id);
		
		foreach ($data['new_po'] as $key => $value) {
			$data['new_po'][$key]->expired = "no";
			if($value->expiry_po_date < date('Y-m-d')){
				$data['new_po'][$key]->expired = "yes";
			}
		}
		$data['current_date'] = date("Y-m-d");
		// $this->load->view('header');
		$this->loadView('purchase/view_po_by_supplier_id', $data);
		// $this->load->view('footer');
	}
	public function pending_po()
	{
		checkGroupAccess("pending_po","list","Yes");
		$data['new_po'] = $this->Crud->customQuery("
			SELECT np.*,s.supplier_name as supplier_name FROM new_po as np
			LEFT JOIN supplier as s ON s.id = np.supplier_id 
			WHERE np.clientId = ".$this->Unit->getSessionClientId()." AND np.status ='pending'");
		$data['base_url'] = base_url();
		// $this->load->view('header');
		$this->loadView('purchase/pending_po', $data);
		// $this->load->view('footer');
	}
	
	public function expired_po()
	{
		checkGroupAccess("expired_po","list","Yes");
		$data['new_po'] = $this->Crud->customQuery("SELECT * FROM new_po WHERE clientId = " . $this->Unit->getSessionClientId() . " AND status in ('pending','expired','accept')");
		foreach ($data['new_po'] as $key => $s) {
			if ($s->status=='expired' || $s->expiry_po_date < date('Y-m-d')) {    
                if($s->status=='pending'){
                    $data = array("status" => "expired");
                    $result = $this->Crud->update_data("new_po", $data, $s->id);
                }
            }
		}
	
	// $this->load->view('header');
	$this->loadView('purchase/expired_po', $data);
	// $this->load->view('footer');
}

public function closed_po()
{
	checkGroupAccess("closed_po","list","Yes");
	$data['new_po'] = $this->Crud->customQuery("SELECT * FROM new_po WHERE clientId = " . $this->Unit->getSessionClientId() . " AND status = 'accept_closed' ");

	// $this->load->view('header');
	$this->loadView('purchase/closed_po', $data);
	// $this->load->view('footer');
}
public function rejected_po()
{
	checkGroupAccess("rejected_po","list","Yes");
	$data['new_po'] = $this->Crud->customQuery("SELECT * FROM new_po WHERE clientId =
		" . $this->Unit->getSessionClientId() . " AND status = 'pending' AND expiry_po_date < '".date('Y-m-d')."'");
		// $this->load->view('header');
		$this->loadView('purchase/rejected_po', $data);
		// $this->load->view('footer');
	}
	public function new_po_list_supplier()
	{
		checkGroupAccess("new_po_list_supplier","list","Yes");
		$new_po_id = $this->uri->segment('2');
		$data['supplier_list'] = $this->Crud->read_data("supplier");
		// $this->load->view('header');
		// $this->load->view('new_po_list_supplier', $data);
		$this->loadView('purchase/new_po_list_supplier', $data);
		// $this->load->view('footer');
	}
	public function new_po_list_supplier_sub()
	{
		$new_po_id = $this->uri->segment('2');
		$data['supplier_list'] = $this->Crud->read_data("supplier");
		$this->load->view('header');
		$this->load->view('new_po_list_supplier_sub', $data);
		$this->load->view('footer');
	}


	//update

	public function update_po_parts()
	{
		$id = $this->input->post('id');
		$discount_value = $this->input->post("discount_value") > 0 ? $this->input->post("discount_value") : 0;
		$uom_id = $this->input->post('uom_id');
		$delivery_date = $this->input->post('delivery_date');
		$qty = $this->input->post('qty');
		$tax_id = $this->input->post('tax_id');
		$part_number = $this->input->post('part_number');
		$child_part_data = $this->SupplierParts->getSupplierPartByPartNumber($part_number);
		$max_po_qty = $child_part_data[0]->max_uom;

		$message ="Something went wrong!";
		$success = 0;
			if($max_po_qty < $qty)
			{
			// echo "<script>alert('Max PO Qty must be less than actual qty , please enter diff qty');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				$message = "Max PO Qty must be less than actual qty , please enter diff qty";

			}
			else
			{
			$data = array(
				"qty" => $qty,
				"pending_qty" => $qty,
				"discount" => $discount_value
			);
			$result = $this->Crud->update_data("po_parts", $data, $id);
			if ($result) {
				$message = "Updated Sucessfully";
				$success = 1;
				// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$message = "Error 410 :  Not Updated'";
				// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
		$return_arr = [
			"messages" =>$message,
			"success" => $success
		];
		echo json_encode($return_arr);
		exit();
	}
	public function update_parts_customer_trackings()
	{
		$id = $this->input->post('id');

		$qty = $this->input->post('qty');
		$customerType = $this->input->post("customerType");
		$data = array(
			"qty" => $qty,
		);
		$global_configuration = $this->Crud->read_data("global_configuration");
		$global_configuration = array_column($global_configuration,"config_value","config_name");
		if(isset($global_configuration['exportSalesInvoive']) && $global_configuration['exportSalesInvoive'] == "Yes" && $customerType == "Expoter"){
			$data['drg_no'] = $this->input->post('drg_no');
			$data['rev_no'] = $this->input->post('rev_no');
			$data['moc'] = $this->input->post('moc');
			$data['item_no'] = $this->input->post('item_no');
		}

		$ret_arr = [];
		$msg = '';
		$success = 1;
		
		$result = $this->Crud->update_data("parts_customer_trackings", $data, $id);
		if ($result) {
			// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			$msg = 'Updated Sucessfully';
		} else {
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			$msg = 'Updated Sucessfully';
			$success = 0;
		}
		$ret_arr['messages'] = $msg;
		$ret_arr['success'] =  $success;
		echo json_encode($ret_arr);
		//}
	}
	public function update_po_parts_amendment_approve()
	{
		$id = $this->input->post('id');

		$new_qty = $this->input->post('new_qty');
		$po_a_number = $this->input->post('po_a_number');
		$new_po_id = $this->input->post('new_po_id');

		// $data = array(
		// 	"contractor_code" => $number,
		// );
		// $check = $this->Crud->read_data_where("contractor", $data);
		// if ($check != 0) {
		// 	echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		// } else {
		$data = array(
			"qty" => $new_qty,
			"pending_qty" => $new_qty,
			"po_approved_updated" => "approved",
			"po_a_number" => $po_a_number,
			"date" => $this->current_date,

		);
		$message ="Something went wrong!";
		$success = 0;
		$result = $this->Crud->update_data("po_parts", $data, $id);
		if ($result) {
			$data2 = array(

				"amendment_no" => $po_a_number,
				"amendment_date" => $this->current_date,

			);
			$result2 = $this->Crud->update_data("new_po", $data2, $new_po_id);
			if ($result2) {
				$message = "Updated Sucessfully";
				$success =1;
			}
		}
		//}

		$return_arr = [
			"messages" =>$message,
			"success" => $success
		];
		echo json_encode($return_arr);
		exit();
	}
	public function update_po_parts_amendment_approve_sub()
	{
		$id = $this->input->post('id');

		$new_qty = $this->input->post('new_qty');
		$po_a_number = $this->input->post('po_a_number');

		// $data = array(
		// 	"contractor_code" => $number,
		// );
		// $check = $this->Crud->read_data_where("contractor", $data);
		// if ($check != 0) {
		// 	echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		// } else {
		$data = array(
			"qty" => $new_qty,
			"po_approved_updated" => "approved",
			"po_a_number" => $po_a_number,
			"date" => $this->current_date,

		);
		$result = $this->Crud->update_data("po_parts_sub", $data, $id);
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		//}
	}
	public function update_po_parts_amendment()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$data = array(
			"new_po_qty" => $qty,
			"po_approved_updated" => "pending",
		);
		$message ="Something went wrong!";
		$success = 0;
		$result = $this->Crud->update_data("po_parts", $data, $id);
		if ($result) {
			$success = 1;
			$message ="Updated Sucessfully";
		}
		$return_arr = [
			"messages" =>$message,
			"success" => $success
		];
		echo json_encode($return_arr);
		exit();
	}
	public function update_po_parts_amendment_sub()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$data = array(
			"new_po_qty" => $qty,
			"po_approved_updated" => "pending",
		);
		$result = $this->Crud->update_data("po_parts_sub", $data, $id);
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}


	public function update_sales_parts_subcon()
	{
		$id = $this->input->post('id');

		$uom_id = $this->input->post('uom_id');
		$delivery_date = $this->input->post('delivery_date');
		$qty = $this->input->post('qty');
		$tax_id = $this->input->post('tax_id');

		$sales_parts_data = $this->Crud->get_data_by_id("sales_parts", $id, "id");
		$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $sales_parts_data[0]->part_id, "customer_master_id");

		$total_rate_old = $customer_part_rate[0]->rate * $qty;

		$gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");

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
		$data = array(
			"tax_id" => $tax_id,
			"uom_id" => $uom_id,
			"qty" => $qty,
			"pending_qty" => $qty,
			"total_rate" => $total_rate,
			"gst_amount" => $gst_amount,
			"tcs_amount" => $tcs_amount,
			"cgst_amount" => $cgst_amount,
			"sgst_amount" => $sgst_amount,
			"igst_amount" => $igst_amount,
		);
		$result = $this->Crud->update_data("sales_parts_subcon", $data, $id);
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		//}
	}
	public function update_parts_rejection_sales_invoice()
	{

		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$messages = "Something went wrong.";
		$success = 0;
		$sql = "SELECT cp.*,t.*,cpr.* FROM parts_rejection_sales_invoice as rp 
		LEFT JOIN customer_part as cp ON cp.id = rp.part_id
		LEFT JOIN customer_part_rate as cpr ON cpr.customer_master_id = cp.id
		LEFT JOIN gst_structure as t ON t.id = cp.gst_id 
		WHERE rp.id = ".$id."
		ORDER BY cpr.revision_no DESC";
		$customer_parts = $this->Crud->customQuery($sql);	
		$value = $customer_parts[0];
		$basic_total = $qty *  $value->rate;
			if ((float) $value->igst == 0) {
		                $gst = (float) $value->cgst + (float) $value->sgst;
		                $cgst = (float) $value->cgst;
		                $sgst = (float) $value->sgst;
		                $tcs = (float) $value->tcs;
		                $igst = 0;
		                $total_gst_percentage = $cgst + $sgst;
		    } else {
		                $gst = (float) $value->igst;
		                $tcs = (float) $value->tcs;
		                $cgst = 0;
		                $sgst = 0;
		                $igst = $gst;
		                $total_gst_percentage = $igst;
		    }
		    $gst_amount = ($gst * $basic_total) / 100;
		    $total_amount = $basic_total;
		    $cgst_amount = ($total_amount * $cgst) / 100;
			$sgst_amount = ($total_amount * $sgst) / 100;
			$igst_amount = ($total_amount * $igst) / 100;
			if ($gst_structure2[0]->tcs_on_tax == "no") {
				$tcs_amount =   (($total_amount * $tcs) / 100);
			} else {
				$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);	
			}
			$total_rate = $total_amount + $gst_amount;		
		$data = array(
			"qty" => $qty,
			"basic_total" => $basic_total,
			'total_rate' =>$total_rate,
			'cgst_amount' =>$cgst_amount,
			'sgst_amount' =>$sgst_amount ,
			'igst_amount' => $igst_amount,
			'tcs_amount' =>$tcs_amount,
			'gst_amount'=>$gst_amount
		);
		$result = $this->Crud->update_data("parts_rejection_sales_invoice", $data, $id);
		if ($result) {
			$messages = "Updated Sucessfully";
			$success = 1;
			// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
		//}
	}
	public function update_challan_parts()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$sales_parts_data = $this->Crud->get_data_by_id("challan_parts", $id, "id");

		$data = array(
			"qty" => $qty,

		);
		$result = $this->Crud->update_data("challan_parts", $data, $id);
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		//}
	}
	public function update_challan_parts_subcon()
	{
		
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$sales_parts_data = $this->Crud->get_data_by_id("challan_parts_subcon", $id, "id");
		$data = array(
			"qty" => $qty,

		);
		$success = 0;
		$messages = "Something went wrong.";
		$result = $this->Crud->update_data("challan_parts_subcon", $data, $id);
		if ($result) {
			$messages = "Updated Sucessfully";
			$success = 1;
			// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "'Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}

	public function validate_invoice_amount()
	{
		
		$inwarding_id = $this->input->post('inwarding_id');
		$invoice_amount = $this->input->post('invoice_amount');
		$status = $this->input->post('status');
		$actual_price = $this->input->post('actual_price');
		$plus_price = $this->input->post('plus_price');
		$minus_price = $this->input->post('minus_price');
		$msg = "";
		$success = 0;
		$messages = "Something went wrong.";
		if ($invoice_amount >= $minus_price && $invoice_amount <= $plus_price) {
			$success = 1;
			// $msg = "<script>alert('Updated Sucessfully.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			$messages = "Updated Sucessfully";
		} else {
			$success = 0;
			$messages = "Invoice amount does not match, Please verify.";
			// echo "<script>alert('Invoice amount does not match, Please verify.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}

		$data = array(
			"invoice_amount" => round($invoice_amount,2),
			"status" => $status,
		);

		$result = $this->Crud->update_data("inwarding", $data, $inwarding_id);
		if ($result) {
			// $success = 1;
			// echo $msg;
		} else {
			$success = 0;
			$messages = "Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}


	public function accept_inwarding_data()
	{

		$inwarding_id = $this->input->post('inwarding_id');
		$invoice_number = $this->input->post('invoice_number');

		$arr = array(
			'id' => $inwarding_id,
		);

		$inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
		$arr2 = array(
			'inwarding_id' => $inwarding_id,
			'invoice_number' => $invoice_number,
		);
		$success = 0;
        $messages = "Something went wrong.";
        $deliveryUnit = $inwarding_data[0]->delivery_unit;
		$client_data = $this->Crud->get_data_by_id("client", $deliveryUnit, "client_unit");
		$grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr2);

		if ($grn_details_data) {
			if (true) {
				$data_update_inwarding = array(
					"status" => "accept"
				);

				$result2 = $this->Crud->update_data("inwarding", $data_update_inwarding, $inwarding_id);
				if ($result2) {
					$part_ids = array_column($grn_details_data,"part_id");
					$part_wise_qty = array_column($grn_details_data,"accept_qty","part_id");
					$child_part_master_data_new = $this->SupplierParts->getSupplierPartByIds($part_ids,$client_data[0]->id);
					$stockColName = $this->Crud->getStockColNmForClientUnit($client_data[0]->id);
					$update_arr = [];
					foreach ($child_part_master_data_new as $key => $value) {
						$grn_qty = $part_wise_qty[$value->id] > 0 ? $part_wise_qty[$value->id] : 0;
						if($grn_qty > 0){
							$update_arr[] = [
								"childPartStockId" => $value->childPartStockId,
								$stockColName => $value->$stockColName + $grn_qty
							];
						}
						
					}

					if(is_array($update_arr) && count($update_arr) > 0){
						$affected_row = $this->SupplierParts->updateBatchSupplierPartByIds($update_arr);
					}

					$messages = "Updated Sucessfully";
					$success = 1;
					// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$messages = "Error 410 :  Not Updated";
					// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			} else {
				$messages = "Error 410 :  Not Updated";
				// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		} else {
			$messages = "Error 410 :  Not Updated, No inwarding found.";
			// echo "<script>alert('Error 410 :  Not Updated, No inwarding found.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function accept_po()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$new_po_data = $this->Crud->get_data_by_id("new_po", $id, "id");
		$supplier_data = $this->Crud->get_data_by_id("supplier", $new_po_data[0]->supplier_id, "id");
        $po_parts_data = $this->Crud->get_data_by_id("po_parts", $new_po_data[0]->id, "po_id");
        $parts_html = "";
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        $with_in_state = "";
        $i = 1;

        $loading_unloading_gst = $this->Crud->get_data_by_id("gst_structure", $new_po_data[0]->loading_unloading_gst, "id");
        $freight_amount_gst = $this->Crud->get_data_by_id("gst_structure", $new_po_data[0]->freight_amount_gst, "id");

        if (!empty($loading_unloading_gst)) {
            $loading_cgst_amount = ($loading_unloading_gst[0]->cgst * $new_po_data[0]->loading_unloading) / 100;
            $loading_sgst_amount = ($loading_unloading_gst[0]->sgst * $new_po_data[0]->loading_unloading) / 100;
            $loading_igst_amount = ($loading_unloading_gst[0]->igst * $new_po_data[0]->loading_unloading) / 100;

            $cgst_amount = $loading_cgst_amount;
            $sgst_amount = $loading_sgst_amount;
            $igst_amount = $loading_igst_amount;
        }
        if (!empty($freight_amount_gst)) {
            $freight_cgst_amount_ = ($freight_amount_gst[0]->cgst * $new_po_data[0]->freight_amount) / 100;
            $freight_sgst_cgst = ($freight_amount_gst[0]->sgst * $new_po_data[0]->freight_amount) / 100;
            $freight_igst_cgst = ($freight_amount_gst[0]->igst * $new_po_data[0]->freight_amount) / 100;
            $cgst_amount = $cgst_amount + $freight_cgst_amount_;
            $sgst_amount = $sgst_amount + $freight_sgst_cgst;
            $igst_amount = $igst_amount + $freight_igst_cgst;
        }
        $messages = "Something went wrong!";
		$success = 0;
        $part_arr = [];
        foreach ($po_parts_data as $p) {
            $data = array(
                'supplier_id' => $supplier_data[0]->id,
                "child_part_id" => $p->part_id,
            );

            $part_data_new = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data);
            $with_in_state = $supplier_data[0]->with_in_state;
            $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");

            $part_data_new2 = $this->SupplierParts->getSupplierPartOnlyById($p->part_id);

            $payment_terms = "";
            $payment_days = 0;
            if ($supplier_data) {
                $payment_terms = $supplier_data[0]->payment_terms;
                $payment_days = $supplier_data[0]->payment_days;
            }

            if ($part_data_new2) {
                $hsn_code = $part_data_new2[0]->hsn_code;
            } else {
                $hsn_code = "";
            }

            if ((int) $gst_structure_data[0]->igst === 0) {
                $gst = (int) $gst_structure_data[0]->cgst + (int) $gst_structure_data[0]->sgst;
                $cgst = (int) $gst_structure_data[0]->cgst;
                $sgst = (int) $gst_structure_data[0]->sgst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = 0;
            } else {
                $gst = (int) $gst_structure_data[0]->igst;
                $cgst = 0;
                $sgst = 0;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = $gst;
            }

            $part_rate_new = 0;
            if (empty($p->rate)) {
                $part_rate_new = $part_data_new[0]->part_rate;
            } else {
                $part_rate_new = $p->rate;
            }
            $gst_amount = ($gst * $part_rate_new) / 100;
            $final_amount = $gst_amount + $part_rate_new;
            $final_row_amount = $final_amount * $p->qty;

            // $final_total = $final_total + $final_row_amount;
            $total_amount = $p->qty * $part_rate_new;
            /* discount amount minus */
            $discount = $p->discount != "" && $p->discount != null ? $p->discount : 0;
            $discount_amount = $total_amount*$p->discount/100;
            $total_amount = $total_amount - $discount_amount;
			/* discount amount minus */            

            $final_total = $final_total + $total_amount;
            $cgst_amount = $cgst_amount + (($total_amount * $cgst) / 100);
            $sgst_amount = $sgst_amount + (($total_amount * $sgst) / 100);
            $igst_amount = $igst_amount + (($total_amount * $igst) / 100);

            if ($gst_structure_data[0]->tcs_on_tax == "no") {
                $tcs_amount = $tcs_amount + (($total_amount * $tcs) / 100);
            } else {
                //$tcs_amount =  $tcs_amount + ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);
                $tcs_amount = $tcs_amount + ((((float) (($total_amount * $cgst) / 100) + (float) (($total_amount * $sgst) / 100) + (float) $igst_amount + (float) $total_amount) * $tcs) / 100);
            }

        }
        $final_total = $final_total + $new_po_data[0]->loading_unloading + $new_po_data[0]->freight_amount;
        $discount = $new_po_data[0]->discount;
        $discount_type = $new_po_data[0]->discount_type;
        if($discount != "" && $new_po_data[0]->po_discount_type == "PO Level"){
            if($discount_type == "Percentage"){
                $discount_amount = $final_total * $discount/100;
                $discount .="%"; 
            }else{
                $discount_amount = $discount;
                $discount = number_format((float) $discount, 2, '.', '');
            }
        }
       	
        if($discount_amount > $final_total){
        	$messages = "Discount amount should not be greater than Subtotal";
        	// echo "<script>alert('Discount amount should not be greater than Subtotal');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }else{
        	
        	$data = array(
				"status" => $status
			);
			$result = $this->Crud->update_data("new_po", $data, $id);
			if ($result) {
				$messages = "Updated Sucessfully";
				$success = 1;
				// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Error 410 :  Not Updated";
				// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		
	}
	public function update_po()
	{
		$post_data = $this->input->post();
		// pr($post_data,1);
		$loading_unloading_gst = $post_data['loading_unloading_gst'];
		$loading_unloading = $post_data['loading_unloading'];
		$freight_amount_gst = $post_data['freight_amount_gst'];
		$freight_amount = $post_data['freight_amount'];
		$loading_unloading_gst_data = $this->Crud->get_data_by_id("gst_structure", $loading_unloading_gst, "id");
		$freight_amount_gst_data = $this->Crud->get_data_by_id("gst_structure", $freight_amount_gst, "id");
		$cgst_amount = 0;
		$sgst_amount = 0;
		$igst_amount = 0;
		$message = "Something went wrong!";
		$success = 0;
		if (!empty($loading_unloading_gst_data)) {
			$loading_cgst_amount = ($loading_unloading_gst_data[0]->cgst * $loading_unloading) / 100;
			$loading_sgst_amount = ($loading_unloading_gst_data[0]->sgst * $loading_unloading) / 100;
			$loading_igst_amount = ($loading_unloading_gst_data[0]->igst * $loading_unloading) / 100;

			$cgst_amount = $loading_cgst_amount;
			$sgst_amount = $loading_sgst_amount;
			$igst_amount = $loading_igst_amount;
		}
		if (!empty($freight_amount_gst_data)) {
			$freight_cgst_amount_ = ($freight_amount_gst_data[0]->cgst * $freight_amount) / 100;

			$freight_sgst_cgst = ($freight_amount_gst_data[0]->sgst * $freight_amount) / 100;

			$freight_igst_cgst = ($freight_amount_gst_data[0]->igst * $freight_amount) / 100;

			$cgst_amount = $cgst_amount + $freight_cgst_amount_;
			$sgst_amount = $sgst_amount + $freight_sgst_cgst;
			$igst_amount = $igst_amount + $freight_igst_cgst;
		}
		$final_amount = $loading_unloading + $freight_amount + $cgst_amount + $sgst_amount + $igst_amount;
		$discount_value = $this->input->post('discount_value');
		
		$data = array(
			"final_amount" => $final_amount,
			"freight_amount" => $freight_amount,
			"freight_amount_gst" => $freight_amount_gst,
			"loading_unloading" => $loading_unloading,
			"loading_unloading_gst" => $loading_unloading_gst,
			"discount" => $discount_value
		);
		$result = $this->Crud->update_data("new_po", $data, $post_data['po_id']);
		if ($result) {
			$message = "Updated Sucessfully";
			$success = 1;
			// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$message = "Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $message;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function unlock_po()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data = array(
			"status" => $status,
			"is_unlock" => "Yes"
		);
		$messages = "Something went wrong!";
		$success = 0;
		$result = $this->Crud->update_data("new_po", $data, $id);
		if ($result) {
			$messages = "Po Unlock Sucessfully";
			$success = 1;
			// echo "<script>alert('Po Unlock Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function AmendQty()
	{
		$part_id = $this->input->post("id");
		$po_parts = $this->Crud->get_data_by_id("po_parts", $part_id, "id");
		$child_part = $this->Crud->customQuery('
			SELECT DISTINCT gst_id, part_rate,child_part_id
			FROM `child_part_master` 
			where supplier_id = ' .$po_parts[0]->supplier_id. ' AND child_part_id = '.$po_parts[0]->part_id.'
			ORDER BY id desc LIMIT 1'
		);
		$message = "Something went wrong!";
		$success = 0;
		$update_arr = [
			"rate" => $child_part[0]->part_rate > 0 ?  $child_part[0]->part_rate : 0,
			"tax_id" => $child_part[0]->gst_id > 0 ?  $child_part[0]->gst_id : 0
		];
		$result = $this->Crud->update_data("po_parts", $update_arr, $part_id);
		if ($result) {
			$message = "Amend Price/tax successfully";
			$success = 1;
			// echo "<script>alert('Amend Price/tax successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$message = "Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$return_arr = [
			"messages" =>$message,
			"success" => $success
		];


		echo json_encode($return_arr);
		exit();
	}
	public function accept_customer_po_tracking()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data = array(
			"status" => $status
		);
		$result = $this->Crud->update_data("customer_po_tracking", $data, $id);
		$message = "Something went wrong!";
		$success = 0;
		if ($result) {
			$message = "Updated Sucessfully";
			$success = 1;
		} else {
			$message ="Error 410 :  Not Updated";
		}
		$return_arr = [
			"message" =>$message,
			"success" => $success
		];


		echo json_encode($return_arr);
		exit();
	}

	public function accept_po_sub()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$data = array(
			"status" => $status,
		);

		$result = $this->Crud->update_data("new_po_sub", $data, $id);
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}

	public function lock_invoice_subcon()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$po_parts  = $this->Crud->get_data_by_id("sales_parts_subcon", $id, "sales_id");

		$data = array(
			"status" => $status,

		);
		$result = $this->Crud->update_data("new_sales_subcon", $data, $id);
		if ($result) {
			if ($po_parts) {
				foreach ($po_parts as $p) {
					$customer_part_id = $p->part_id;
					$customer_part_data  = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
					$old_fg_stock = $customer_part_data[0]->fg_stock;

					$new_fg_stock = $old_fg_stock - ($p->qty);

					$data_update = array(
						"fg_stock" => $new_fg_stock,
					);
					$result2 = $this->Crud->update_data("customer_part", $data_update, $customer_part_id);
				}
			}

			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}
	public function lock_invoice_rejection()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$accepted_qty = $this->input->post('accepted_qty');
		$actual_qty = $this->input->post('actual_qty');
		$part_number = $this->input->post('part_number');

		$po_parts  = $this->Crud->get_data_by_id("sales_parts", $id, "sales_id");

		$data = array(
			"status" => "completed",

		);
		$result = $this->Crud->update_data("new_sales_rejection", $data, $id);
		if ($result) {
			if ($part_number == "production_rejection") {
				$customer_part  = $this->Crud->get_data_by_id("customer_part", "production_rejection", "part_number");
				$old_production_rejection = $customer_part[0]->production_rejection;
				$new_production_rejection = $old_production_rejection - $accepted_qty;
				$data_update_prodcutin = array(
					"production_rejection" => $new_production_rejection,
				);
				$result1 = $this->Crud->update_data_column("customer_part", $data_update_prodcutin, "production_rejection", "part_number");
			} else {
				$customer_part  = $this->Crud->get_data_by_id("customer_part", "production_scrap", "part_number");
				$old_production_scrap = $customer_part[0]->production_scrap;
				$new_production_scrap = $old_production_scrap - $accepted_qty;
				$data_update_prodcutin = array(
					"production_scrap" => $new_production_scrap,
				);
				$result1 = $this->Crud->update_data_column("customer_part", $data_update_prodcutin, "production_scrap", "part_number");
			}

			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}
	public function lock_parts_rejection_sales_invoice()
	{
		$id = $this->input->post('id');
		$sql = "SELECT r.* FROM rejection_sales_invoice as r WHERE r.id = ".$id;
		$rejection_invoice_data = $this->Crud->customQuery($sql);
		$type = $rejection_invoice_data[0]->type;
		if($type == "CreditNote"){
			$structure_type = "credit_note";
		}else if($type == "DebitNote"){
			$structure_type = "debit_note";
		}else if($type == "ProformaInvoice"){
			$structure_type = "performa_invoice";
		}
		$data = $this->Crud->get_data_by_id("global_formate_configuration", $structure_type, "config_name");
		$patter = $data[0]->formate;
		$current_year = $this->getFinancialYear();
		$current_year_arr = explode("-", $current_year);
		$start_data = $this->createFinatialStartEndDate("start_date",$current_year_arr[0]);
		$end_data = $this->createFinatialStartEndDate("end_date",$current_year_arr[1]);
		
		if($patter != " "){

			$sql = "SELECT count(rejection_invoice_no) as count FROM rejection_sales_invoice WHERE rejection_invoice_no like '%".$patter."%' AND (
		        STR_TO_DATE(created_date, '%d-%m-%Y') BETWEEN '".$start_data['start']."' AND '".$start_data['end']."'
		        OR
		        STR_TO_DATE(created_date, '%d-%m-%Y') BETWEEN '".$end_data['start']."' AND '".$end_data['end']."'
		    )";
		    $latestSeqFormat = $this->Crud->customQuery($sql);
		}else{
			$sql = "SELECT r.* FROM global_formate_configuration as r WHERE r.config_name IN ('credit_note','debit_note','performa_invoice')";
			$formate_sample_val = $this->Crud->customQuery($sql);
			$whreCondition = "";
			foreach ($formate_sample_val as $key => $value) {
				# code...
				if($value->formate != " "){
					$whreCondition .= "rejection_invoice_no not like '%".$value->formate."%'";
				}else{
					$whreCondition .= "rejection_invoice_no not like '%TEMP%'";
				}
				if($key < count($formate_sample_val) - 1){
					$whreCondition .=" AND ";
				}
			}
			
			$sql = "SELECT count(rejection_invoice_no) as count FROM rejection_sales_invoice WHERE $whreCondition AND (
		        STR_TO_DATE(created_date, '%d-%m-%Y') BETWEEN '".$start_data['start']."' AND '".$start_data['end']."'
		        OR
		        STR_TO_DATE(created_date, '%d-%m-%Y') BETWEEN '".$end_data['start']."' AND '".$end_data['end']."'
		    )";
		    $latestSeqFormat = $this->Crud->customQuery($sql);
		}
		$count_number = $latestSeqFormat[0]->count+1;
		// pr($count_number,1);
		$rejection_invoice_no = $this->getCreditNoteCode($type,$count_number);
		// pr($rejection_invoice_no,1);
		$data = array(
			"rejection_invoice_no" => $rejection_invoice_no,
			"status" => "completed",

		);
		$result = $this->Crud->update_data("rejection_sales_invoice", $data, $id);
		$success = 0;
        $messages = "Something went wrong.";
		$result = $this->Crud->update_data("rejection_sales_invoice", $data, $id);
		if ($result) {

			$messages = "Updated Sucessfully";
			$success = 1;
			// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Error 410 :  Not Updated";
			// echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function lock_invoice_rejection_new()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$accepted_qty = $this->input->post('accepted_qty');
		$actual_qty = $this->input->post('actual_qty');
		$part_number = $this->input->post('part_number');

		$po_parts  = $this->Crud->get_data_by_id("sales_parts", $id, "sales_id");
		$new_rejection_flow_parts_data  = $this->Crud->get_data_by_id("new_rejection_flow_parts", $id, "rejection_flow_new_id");

		$data = array(
			"status" => "completed",

		);
		$result = $this->Crud->update_data("rejection_flow_new", $data, $id);
		if ($result) {
			$customer_part  = $this->Crud->get_data_by_id("customer_part", "production_rejection", "part_number");
			$old_production_rejection = $customer_part[0]->production_rejection;
			if ($new_rejection_flow_parts_data) {
				foreach ($new_rejection_flow_parts_data as $n) {
					if ($n->type == "store_stock") {
						$po_parts  = $this->SupplierParts->getSupplierPartByPartNumber($n->part_number);
						$old_store_stock = $po_parts[0]->stock;
						$new_store_stock = $old_store_stock + $n->qty;
						$data = array(
							"stock" => $new_store_stock,

						);
						$result = $this->SupplierParts->updateStockById($data, $po_parts[0]->id);
						$new_production_rejection = $old_production_rejection - $n->qty;
						$data_update_prodcutin = array(
							"production_rejection" => $new_production_rejection,
						);
						$result1 = $this->Crud->update_data_column("customer_part", $data_update_prodcutin, "production_rejection", "part_number");
					} else {
						$po_parts  = $this->Crud->get_data_by_id("customer_part", $n->part_number, "part_number");
						$old_fg_stock = $po_parts[0]->fg_stock;
						$new_fg_stock = $old_fg_stock + $n->qty;
						$data = array(
							"fg_stock" => $new_fg_stock,

						);
						$result = $this->Crud->update_data("customer_part", $data, $po_parts[0]->fg_stock);
						$new_production_rejection = $old_production_rejection - $n->qty;
						$data_update_prodcutin = array(
							"production_rejection" => $new_production_rejection,
						);
						$result1 = $this->Crud->update_data_column("customer_part", $data_update_prodcutin, "production_rejection", "part_number");
					}
				}
			}

			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}


	// add new
	public function add_po_parts()
	{
		// pr("ok",1);
		$supplier_id = $this->input->post('supplier_id');
		$process = $this->input->post('process');
		$po_date = $this->input->post('po_date');
		$po_id = $this->input->post('po_id');
		$po_number = $this->input->post('po_number');
		$part_id = $this->input->post('part_id');
		$invoice_number = $this->input->post('invoice_number');
		$qty = $this->input->post('qty');
		$type = $this->input->post('type');
		$message = "Something went wrong";
		$success = 0;
		$discount_value = $this->input->post('discount_value') != "" && $this->input->post('discount_value') != null ? $this->input->post('discount_value')  : 0;
		$array_main = array(
			"supplier_id" => $supplier_id,
			"child_part_id" => $part_id,
		);

		$child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array_main);
		$child_part_from_master = $this->SupplierParts->getSupplierPartOnlyById($part_id);
		$max_uom = $child_part_from_master[0]->max_uom;

		$data = array(
			"part_id" => $child_part_from_master[0]->id,
			"po_number" => $po_number,
		);
		$check = $this->Crud->read_data_where("po_parts", $data);
		$routing_data = $this->Crud->get_data_by_id("routing", $part_id, "part_id");
		$po_discount_type = $this->input->post("po_discount_type");
		$tax_diff = "No";
		if($po_discount_type != "N/A"){
			$po_parts = $this->Crud->get_data_by_id("po_parts", $po_id, "po_id");
			$po_parts_tax = $po_parts[0]->tax_id;
			if($po_parts_tax != "" || $po_parts_tax != null){
				if($po_parts_tax != $child_part_data[0]->gst_id){
					$tax_diff = "Yes";
				}
			}
		}

		if ($type != "normal" && empty($routing_data)) {
			$message = "Error 403 : Routing Not Found please Add Routing for this part !!!  ";
			// echo "<script>alert('Error 403 : Routing Not Found please Add Routing for this part !!!  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else if ($qty > $max_uom) {
			$message = "Error 401 : Quantity should be less than MAX PO QTY. Please check  ";
			// echo "<script>alert('Error 401 : Quantity should be less than MAX PO QTY. Please check  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else if ($check) {
			$message = "Error 403 : Part  Already Exists To This PO Number , Enter Different Part";
			// echo "<script>alert('Error 403 : Part  Already Exists To This PO Number , Enter Different Part ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else if ($tax_diff == "Yes") {
			$message = "Please add same tax structure parts";
			// echo "<script>alert('Please add same tax structure parts');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {



			$data = array(
				"po_id" => $po_id,
				"po_number" => $po_number,
				"supplier_id" => $supplier_id,
				"part_id" => $child_part_from_master[0]->id,
				"tax_id" => $child_part_data[0]->gst_id,
				"uom_id" => $child_part_from_master[0]->uom_id,
				"delivery_date" => $this->input->post('delivery_date'),
				"expiry_date" => $this->input->post('expiry_date'),
				"qty" => $this->input->post('qty'),
				"pending_qty" => $this->input->post('qty'),
				"rate" => $child_part_data[0]->part_rate,
				"invoice_number" => $this->input->post('invoice_number'),
				"created_by" => $this->user_id,
				"process" => $process,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"created_day" => $this->date,
				"created_month" => $this->month,
				"created_year" => $this->year,
				"discount" => $discount_value
			);

			// pr($data,1);

			$result = $this->Crud->insert_data("po_parts", $data);
			if ($result) {
				$message = "Successfully Added";
				$success = 1;
				// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$message = "Unab le to Add";
				// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
		$return_arr = [
			"messages" =>$message,
			"success" => $success
		];
		echo json_encode($return_arr);
		exit();
	}

	public function add_challan_parts_history()
	{

		$child_part_id = $this->input->post('child_part_id');
		$subcon_po_inwarding_parts_id = $this->input->post('subcon_po_inwarding_parts_id');
		$challan_id = $this->input->post('challan_id');
		$message = "Something went wrong";
		$success = 0;
		if($challan_id == 0)
		{
			$message = "please select challan Id";
			// echo "<script>alert('please select challan Id');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";

		}
		$challan_part_id = $this->input->post('challan_part_id');
		$previous_qty = $this->input->post('previous_qty');
		$new_qty = $this->input->post('new_qty');
		$type = $this->input->post('type');
		$part_id = $this->input->post('part_id');
		$req_qty = $this->input->post('req_qty');
		$rec_qty = ($this->input->post('rec_qty'));
		$grn_number = ($this->input->post('grn_number'));
		$invoice_number = ($this->input->post('invoice_number'));
		$po_id = $this->input->post('po_id');
		$inwarding_id = ($this->input->post('inwarding_id'));
		$new_po_id = ($this->input->post('new_po_id'));

		//echo "<br>main required qty: " . $req_qty;
		//echo "<br>main recevied qty: " . $rec_qty;
		$role_management_data2 = $this->db->query('SELECT * FROM `challan_parts` WHERE part_id = ' . $part_id . ' AND challan_id = ' . $challan_id . '  ');
		$challan_parts_data = $role_management_data2->result();

		if ($challan_parts_data) {

			$challan_master = $this->Crud->get_data_by_id("challan", $challan_id, "id");
			$child_part_master = $this->SupplierParts->getSupplierPartById($challan_parts_data[0]->part_id);
			$sub_con_stock = $child_part_master[0]->sub_con_stock;

			$req_qty = $req_qty - $rec_qty;
			$challan_qty = $challan_parts_data[0]->remaning_qty;
			// echo "<br>challan_qty: " . $challan_qty;

			$challan_diff = $challan_qty - $req_qty;

			if ($rec_qty == 0) {
				// echo "<br>rec is zero";
				if ($challan_diff >= 0) {
					$rec_qty = $req_qty;
					$challan_history = $challan_qty - $req_qty;
					$new_sub_con = $sub_con_stock - $rec_qty;
				} else {
					$rec_qty = $challan_qty;
					$challan_history = $challan_qty - $rec_qty;
					$new_sub_con = $sub_con_stock - $rec_qty;
				}
				$history = $rec_qty;
			} else {
				// echo "<br>challan Diff :" . $challan_diff;
				if ($challan_diff >= 0) {
					// echo "<br>received is not zero dif >= 0";
					$new_req_qty = $req_qty;
					// echo "<br>new_req_qty :" . $new_req_qty;
					$rec_qty = $rec_qty + $new_req_qty;
					// echo "<br>rec_qty :" . $rec_qty;
					$challan_history = $challan_qty - $new_req_qty;
					// echo "<br>challan_history :" . $challan_history;
					$new_sub_con = $sub_con_stock - $new_req_qty;
					// echo "<br>new_sub_con :" . $new_sub_con;
				} else {
					$new_req_qty = $challan_qty;
					$rec_qty = $new_req_qty + $rec_qty;
					// echo "<br> new_req_qty: ".$new_req_qty;
					// echo "<br> rec_qty: " . $rec_qty;
					$challan_history = $challan_qty - $new_req_qty;
					$new_sub_con = $sub_con_stock - $new_req_qty;
				}
				$history = $new_req_qty;
			}

			$subcon_po_inwarding_parts_update_array = array(
				"recevied_req_qty" => $rec_qty,
			);

			$challan_parts_update_array = array(
				"remaning_qty" => $challan_history,
			);

			$child_part_update_array = array(
				"sub_con_stock" => $new_sub_con,
			);

			$subcon_po_inwarding_history_array  = array(
				"subcon_po_inwarding_parts_id" => $subcon_po_inwarding_parts_id,
				"challan_id" => $challan_id,
				"challan_part_id" => $challan_parts_data[0]->id,
				"previous_qty" => $challan_parts_data[0]->remaning_qty,
				"new_qty" => $history,
				"po_id" => $po_id,
				"invoice_number" => $invoice_number,
				"grn_number" => $grn_number,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"day" => $this->date,
				"month" => $this->month,
				"year" => $this->year
			);

			$result = $this->Crud->insert_data("subcon_po_inwarding_history", $subcon_po_inwarding_history_array);

			if ($result) {
				$result1 = $this->Crud->update_data("subcon_po_inwarding_parts", $subcon_po_inwarding_parts_update_array, $subcon_po_inwarding_parts_id);
				$result2 = $this->Crud->update_data("challan_parts", $challan_parts_update_array, $challan_parts_data[0]->id);
				$result3 = $this->SupplierParts->updateStockById($child_part_update_array, $part_id);
				// echo "<script>alert('Successfully Added');document.location='" . base_url('grn_subcon_view/') . $child_part_id . "/" . $new_po_id ."/" .$inwarding_id. "/" .$child_part_id."'</script>";
				$message = "Successfully Added";
				$success = 1;

			} else {
				$message = "Unable to Add";
				// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		} else {
			$message = "challan parts not found !";
			// echo "challan parts not found !";
		}
		$return_arr = [
			"messages" =>$message,
			"success" => $success
		];
		echo json_encode($return_arr);
		exit();
	}
	public function add_challan_parts_history_subcon()
	{
		$subcon_po_inwarding_parts_id = $this->input->post('subcon_po_inwarding_parts_id');
		$challan_id = $this->input->post('challan_id');
		$challan_part_id = $this->input->post('challan_part_id');
		$previous_qty = $this->input->post('previous_qty');
		$new_qty = $this->input->post('new_qty');
		$type = $this->input->post('type');
		$part_id = $this->input->post('part_id');
		$req_qty = $this->input->post('req_qty');
		$rec_qty = $this->input->post('rec_qty');
		$grn_number = ($this->input->post('grn_number'));
		$invoice_number = ($this->input->post('invoice_number'));
		$po_id = ($this->input->post('po_id'));

		echo "main required qty: " . $req_qty;
		echo "<br>";
		echo "<br>";
		echo "main recevied qty: " . $rec_qty;
		echo "<br>";
		echo "<br>";
		$role_management_data2 = $this->db->query('SELECT * FROM `challan_parts` WHERE part_id = ' . $part_id . ' AND challan_id = ' . $challan_id . '  ');
		$challan_parts_data = $role_management_data2->result();

		if ($challan_parts_data) {

			$challan_master = $this->Crud->get_data_by_id("challan", $challan_id, "id");
			$child_part_from_master = $this->SupplierParts->getSupplierPartById($challan_parts_data[0]->child_part_id);
			$child_part_master = $this->SupplierParts->getSupplierPartById($challan_parts_data[0]->part_id);
			$sub_con_stock = $child_part_master[0]->sub_con_stock;



			$req_qty = $req_qty - $rec_qty;
			$challan_qty = $challan_parts_data[0]->remaning_qty;
			echo "<br>challan_qty: " . $challan_qty;

			$challan_diff = $challan_qty - $req_qty;

			if ($rec_qty == 0) {
				echo "<br>rec is zero";
				if ($challan_diff >= 0) {
					$rec_qty = $req_qty;
					$challan_history = $challan_qty - $req_qty;
					$new_sub_con = $sub_con_stock - $rec_qty;
				} else {
					$rec_qty = $challan_qty;
					$challan_history = $challan_qty - $rec_qty;
					$new_sub_con = $sub_con_stock - $rec_qty;
				}
				$history = $rec_qty;
			} else {

				echo "<br>challan Diff :" . $challan_diff;
				if ($challan_diff >= 0) {
					echo "<br>received is not zero dif >= 0";

					$new_req_qty = $req_qty;
					echo "<br>new_req_qty :" . $new_req_qty;

					$rec_qty = $rec_qty + $new_req_qty;
					echo "<br>rec_qty :" . $rec_qty;

					$challan_history = $challan_qty - $new_req_qty;
					echo "<br>challan_history :" . $challan_history;

					$new_sub_con = $sub_con_stock - $new_req_qty;
					echo "<br>new_sub_con :" . $new_sub_con;
				} else {
					$new_req_qty = $challan_qty;
					$rec_qty = $new_req_qty + $rec_qty;
					$challan_history = $challan_qty - $new_req_qty;
					$new_sub_con = $sub_con_stock - $new_req_qty;
				}

				$history = $new_req_qty;
			}

			$subcon_po_inwarding_parts_update_array = array(
				"recevied_req_qty" => $rec_qty,
			);

			$challan_parts_update_array = array(
				"remaning_qty" => $challan_history,
			);

			$child_part_update_array = array(
				"sub_con_stock" => $new_sub_con,
			);

			$subcon_po_inwarding_history_array  = array(
				"subcon_po_inwarding_parts_id" => $subcon_po_inwarding_parts_id,
				"challan_id" => $challan_id,
				"challan_part_id" => $challan_parts_data[0]->id,
				"previous_qty" => $challan_parts_data[0]->remaning_qty,
				"new_qty" => $history,
				"po_id" => $po_id,
				"invoice_number" => $invoice_number,
				"grn_number" => $grn_number,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"day" => $this->date,
				"month" => $this->month,
				"year" => $this->year,
			);
			$result = $this->Crud->insert_data("subcon_po_inwarding_history_subcon", $subcon_po_inwarding_history_array);
			if ($result) {
				$result1 = $this->Crud->update_data("subcon_po_inwarding_history_subcon", $subcon_po_inwarding_parts_update_array, $subcon_po_inwarding_parts_id);
				$result2 = $this->Crud->update_data("challan_parts_subcon", $challan_parts_update_array, $challan_parts_data[0]->id);
				$result3 = $this->SupplierParts->updateStockById($child_part_update_array, $part_id);
				echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		} else {
			echo "challan parts not found !";
		}
	}
	public function add_challan_parts_history_challan()
	{
		
		$qty = $this->input->post('qty');
		$supplier_challan_number = $this->input->post('supplier_challan_number');
		$challan_id = $this->input->post('challan_id');
		$part_id = $this->input->post('part_id');

		$challan_parts_history_insert_array  = array(
			"challan_id" => $challan_id,
			"supplier_challan_number" => $supplier_challan_number,
			"part_id" => $part_id,
			"qty" => $qty,
			"status" => "requested",
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"day" => $this->date,
			"month" => $this->month,
			"year" => $this->year,
		);
		$result = $this->Crud->insert_data("challan_parts_history", $challan_parts_history_insert_array);
		$success = 0;
		$messages = "Somthing went Wrong";
		if ($result) {
			$success = 1;
			$messages = "Successfully Added";
			// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Unab le to Add";
			// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$return_arr = [];
		$return_arr['success'] = $success;
		$return_arr['message'] = $messages;
		echo json_encode($return_arr);

		exit();
	}
	// add new
	public function add_po_parts_sub()
	{
		$supplier_id = $this->input->post('supplier_id');
		$po_date = $this->input->post('po_date');
		$po_id = $this->input->post('po_id');
		$po_number = $this->input->post('po_number');
		$part_id = $this->input->post('part_id');
		$invoice_number = $this->input->post('invoice_number');
		$qty = $this->input->post('qty');


		$child_part_data = $this->Crud->get_data_by_id("child_part_master", $part_id, "id");
		$child_part_from_master = $this->SupplierParts->getSupplierPartById($child_part_data[0]->child_part_id);
		$max_uom = $child_part_from_master[0]->max_uom;

		$data = array(
			"part_id" => $part_id,
			"po_number" => $po_number,
		);
		// print_r($data);
		$check = $this->Crud->read_data_where("po_parts_sub", $data);

		if ($qty > $max_uom) {
			echo "<script>alert('Error 401 : Max UOM Qty is less than entered qty, please try again , Enter Different Part ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else if ($check) {
			echo "<script>alert('Error 403 : Part  Already Exists To This PO Number , Enter Different Part ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {



			$data = array(
				"po_id" => $po_id,
				"po_number" => $po_number,
				"supplier_id" => $supplier_id,
				"part_id" => $part_id,
				"tax_id" => $child_part_data[0]->gst_id,
				"uom_id" => $child_part_data[0]->uom_id,
				"delivery_date" => $this->input->post('delivery_date'),
				"expiry_date" => $this->input->post('expiry_date'),
				"qty" => $this->input->post('qty'),
				"pending_qty" => $this->input->post('qty'),
				"invoice_number" => $this->input->post('invoice_number'),
				"rate" => $child_part_data[0]->part_rate,
				"created_by" => $this->user_id,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"created_day" => $this->date,
				"created_month" => $this->month,
				"created_year" => $this->year,
			);


			$result = $this->Crud->insert_data("po_parts_sub", $data);
			if ($result) {
				echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
	}

	public function add_sales_parts_subcon()
	{
		$customer_id = $this->input->post('customer_id');
		// $po_date = $this->input->post('po_date');
		$sales_id = $this->input->post('sales_id');
		$po_number = $this->input->post('po_number');
		$part_id = $this->input->post('part_id');
		$sales_number = $this->input->post('sales_number');
		$qty = $this->input->post('qty');



		$customer_part = $this->Crud->get_data_by_id("customer_part", $part_id, "id");


		$job_card_data = $this->Crud->get_data_by_id("job_card", $part_id, "customer_part_id");

		$prod_qty_new = 0;
		if ($job_card_data) {
			foreach ($job_card_data as $j) {
				// echo $j->id;
				// echo "<br>";
				// $job_card_data = $this->Crud->get_data_by_id("job_card_prod_qty", $j->id, "job_card_id");

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
					// $prod_qty_new;
				} else {
					// $prod_qty_new = 0;
				}
			}
		}
		// echo $prod_qty_new;




		if ($qty > $customer_part[0]->fg_stock) {
			echo "<script>alert('Error 403 : Please check FG stock');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {



			$customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $part_id, "customer_master_id");

			$total_rate_old = $customer_part_rate[0]->rate * $qty;

			$gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $customer_part[0]->gst_id, "id");

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
			$data = array(
				"part_id" => $part_id,
				"sales_number" => $sales_number,
			);
			$check = $this->Crud->read_data_where("sales_parts_subcon", $data);
			if ($check) {
				echo "<script>alert('Error 403 : Part  Already Exists To This Invoice Number , Enter Different Part ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$data = array(
					"sales_id" => $sales_id,
					"sales_number" => $sales_number,
					"customer_id" => $customer_id,
					"part_id" => $part_id,
					"tax_id" => $customer_part[0]->gst_id,
					"uom_id" => $customer_part[0]->uom,
					"total_rate" => $total_rate,
					"gst_amount" => $gst_amount,
					"tcs_amount" => $tcs_amount,
					"cgst_amount" => $cgst_amount,
					"sgst_amount" => $sgst_amount,
					"igst_amount" => $igst_amount,
					"qty" => $this->input->post('qty'),
					"pending_qty" => $this->input->post('qty'),
					"invoice_number" => $this->input->post('invoice_number'),
					"created_by" => $this->user_id,
					"created_date" => $this->current_date,
					"created_time" => $this->current_time,
					"created_day" => $this->date,
					"created_month" => $this->month,
					"created_year" => $this->year,
				);


				$result = $this->Crud->insert_data("sales_parts_subcon", $data);
				if ($result) {
					echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
		}
	}
	public function add_parts_rejection_sales_invoice()
	{
		$customer_id = $this->input->post('customer_id');
		$part_id = $this->input->post('part_id');
		$sales_id = $this->input->post('sales_id');
		$qty = $this->input->post('qty');
		// pr($this->input->post());
		$data_check = array(
				"customer_id" => $customer_id,
				"part_id" => $part_id,
				"rejection_sales_id" => $sales_id,
			);	
		$messages = "Something went wrong.";
        $success = 0;
		$parts_rejection_sales_invoice_data = $this->Crud->get_data_by_id_multiple("parts_rejection_sales_invoice", $data_check);
		if($parts_rejection_sales_invoice_data)
		{
			$messages = "data Already Present, please try again";
			// echo "<script>alert('Error : data Already Present, please try again ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";

		}
		else
		{	
			$sql = "SELECT cp.*,t.*,cpr.* FROM customer_part as cp 
			LEFT JOIN customer_part_rate as cpr ON cpr.customer_master_id = cp.id
			LEFT JOIN gst_structure as t ON t.id = cp.gst_id 
			WHERE cp.id = ".$part_id."
			ORDER BY cpr.revision_no DESC";
			$customer_parts = $this->Crud->customQuery($sql);	
			$value = $customer_parts[0];
			$value = $customer_parts[0];
			$basic_total = $qty *  $value->rate;
			// pr($customer_parts,1	);
			if ((float) $value->igst == 0) {
		                $gst = (float) $value->cgst + (float) $value->sgst;
		                $cgst = (float) $value->cgst;
		                $sgst = (float) $value->sgst;
		                $tcs = (float) $value->tcs;
		                $igst = 0;
		                $total_gst_percentage = $cgst + $sgst;
		    } else {
		                $gst = (float) $value->igst;
		                $tcs = (float) $value->tcs;
		                $cgst = 0;
		                $sgst = 0;
		                $igst = $gst;
		                $total_gst_percentage = $igst;
		    }
		    $gst_amount = ($gst * $basic_total) / 100;
		    $total_amount = $basic_total;
		    $cgst_amount = ($total_amount * $cgst) / 100;
			$sgst_amount = ($total_amount * $sgst) / 100;
			$igst_amount = ($total_amount * $igst) / 100;
			if ($gst_structure2[0]->tcs_on_tax == "no") {
				$tcs_amount =   (($total_amount * $tcs) / 100);
			} else {
				$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);	
			}
			$total_rate = $total_amount + $gst_amount;	

			$data = array(
				"customer_id" => $customer_id,
				"rejection_sales_id" => $sales_id,
				"part_id" => $part_id,
				"qty" => $qty,
				"created_by" => $this->user_id,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"created_day" => $this->date,
				"created_month" => $this->month,
				"created_year" => $this->year,
				'part_price' => $value->rate,
				"basic_total" => $basic_total,
				'total_rate' =>$total_rate,
				'cgst_amount' =>$cgst_amount,
				'sgst_amount' =>$sgst_amount ,
				'igst_amount' => $igst_amount,
				'tcs_amount' =>$tcs_amount,
				'gst_amount'=>$gst_amount
		
			);
			// pr($data,1);
			$result = $this->Crud->insert_data("parts_rejection_sales_invoice", $data);
			if ($result) {
				$messages = "Successfully Added";
				$success = 1;
				// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Unab le to Add";
				// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();

	}


	public function close_po()
	{
		
		$id = $this->input->post('id');
		$closed_remark = $this->input->post('remark');
		$po_number = $this->input->post('po_number');
		$new_po_Data = $this->Crud->get_data_by_id("new_po", $po_number, "po_number");
		
		$data = array(
			"status" => "accept_closed",
			"closed_remark" => $closed_remark,
		);
		
		$success = 0;
		$message = "Something went wrong!";
		$result = $this->Crud->update_data("new_po", $data, $new_po_Data[0]->id);
		if ($result) {
			$success = 1;
			$message = "PO successfully closed.";
			//  $this->addSuccessMessage('PO successfully closed.');
			//  $this->redirectMessage();
		} else {
			$message = "Error po_parts not found.";
			// $this->addErrorMessage('Error po_parts not found.');
			//  $this->redirectMessage();

		}
		$return_arr = [
			"success" => $success,
			"message" => $message
		];

		echo json_encode($return_arr);
		exit;
	}


	public function close_po_customer_po_tracking()
	{
		$id = $this->input->post('id');
		$remark = $this->input->post('remark');
		$reason = $this->input->post('reason');

		$data = array(
			"status" => "closed",
			"remark" => $remark,
			"reason" => $reason
		);
		
		$result = $this->Crud->update_data("customer_po_tracking", $data, $id);

		if ($result) {
			 $this->addSuccessMessage('PO successfully closed.');
			 $this->redirectMessage();
		} else {
			$this->addErrorMessage('Error po_parts not found.');
			$this->redirectMessage();
		}
	}
	public function close_po_new()
	{
		$id = $this->input->post('id');
		$closed_remark = $this->input->post('remark');

		$data = array(
			"status" => "accept_closed",
			"closed_remark" => $closed_remark,
		);


		$result = $this->Crud->update_data("new_po", $data, $id);

		if ($result) {
			echo "<script>alert('po closed');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "none error po_parts update not found";
		}
	}
	public function update_challan_parts_history_challan()
	{
		// pr("ok",1);
		$id = $this->input->post('challan_parts_history_id');
		$accepeted_qty = $this->input->post('accepeted_qty');
		$part_id = $this->input->post('part_id');
		$qty = $this->input->post('qty_main');
		$challan_id = $this->input->post('challan_id');
		$reject_qty = $qty - $accepeted_qty;

		$update_data = array(
			"reject_qty" => $reject_qty,
			"accepeted_qty" => $accepeted_qty,
			"status" => "completed",
		);

		$child_part_master_data_new = $this->SupplierParts->getSupplierPartById($part_id);
		$exsisting_qty = $child_part_master_data_new[0]->stock;
		$exsisting_qty_rejection_stock = $child_part_master_data_new[0]->rejection_stock;
		$exsisting_qty_subcon = $child_part_master_data_new[0]->sub_con_stock;
		$new_sub = $exsisting_qty_subcon - $qty;
		$success = 0;
		$messages = "Somthing went Wrong";
		if (!empty($accepeted_qty)) {
			$new_qty = $exsisting_qty + $accepeted_qty;
			$update_child_part_array = array(
				"stock" => $new_qty,
			);
			$result_update_child_part = $this->SupplierParts->updateStockById($update_child_part_array, $part_id);
		}
		if (!empty($reject_qty)) {
			$new_qty = $exsisting_qty_rejection_stock + $reject_qty;

			$update_child_part_array = array(
				"rejection_stock" => $new_qty,
			);
			$result_update_child_part = $this->SupplierParts->updateStockById($update_child_part_array, $part_id);
		}

		$update_child_part_array_sb = array(
			"sub_con_stock" => $new_sub,
		);
		$result_update_child_part = $this->SupplierParts->updateStockById($update_child_part_array_sb, $part_id);

		$result = $this->Crud->update_data("challan_parts_history", $update_data, $id);

		if ($result) {
			$challan_parts_get_array = array(
				'challan_id' => $challan_id,
				'part_id' => $part_id,
			);
			// print_r($arr);
			$challan_parts_data = $this->Crud->get_data_by_id_multiple("challan_parts", $challan_parts_get_array);
			$exsisting_rem_qty = $challan_parts_data[0]->remaning_qty;
			$update_challan_parts_array = array(
				"remaning_qty" => $exsisting_rem_qty - $qty,
			);
			$result2 = $this->Crud->update_data("challan_parts", $update_challan_parts_array, $challan_parts_data[0]->id);
			if ($result2) {
				$success = 1;
				$messages = "Updated Added";
				// echo "<script>alert('Updated Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages ="none error po_parts update not found";
				// echo "none error po_parts update not found";
			}
		} else {
			$messages = "Unable to Add";
			// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$return_arr = [];
		$return_arr['success'] = $success;
		$return_arr['messages'] = $messages;
		echo json_encode($return_arr);

		exit();
	}
	/* public function add_grn_qty_subcon_view()
	{
	$inwarding_id = $this->input->post('inwarding_id');
	$po_number = $this->input->post('new_po_id');
	$grn_number = $this->input->post('grn_number');
	$invoice_number = $this->input->post('invoice_number');
	$part_id = $this->input->post('part_id');
	$qty = $this->input->post('qty');
	$po_part_id = $this->input->post('po_part_id');
	$part_rate = $this->input->post('part_rate');
	$tax_id = $this->input->post('tax_id');
	$pending_qty = $this->input->post('pending_qty');
	$challan_number = $this->input->post('challan_number');

	$inwarding_price = $part_rate * $qty;

	$gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");

	$cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
	$sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
	$igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;

	$inwarding_price = $inwarding_price + $cgst_amount + $sgst_amount + $igst_amount;
	$data = array(
	"inwarding_id" => $inwarding_id,
	"po_number" => $po_number,
	"grn_number" => $grn_number,
	"invoice_number" => $invoice_number,
	"part_id" => $part_id,
	"qty" => $qty,
	"po_part_id" => $po_part_id,
	"inwarding_price" => $inwarding_price,
	"created_by" => $this->user_id,
	"created_date" => $this->current_date,
	"created_time" => $this->current_time,
	"created_day" => $this->date,
	"created_month" => $this->month,
	"created_year" => $this->year,
);
$result = $this->Crud->insert_data("grn_details", $data);
if ($result) {
$pending_qty =
$data = array(
"pending_qty" => $pending_qty - $qty,
);
$result = $this->Crud->update_data("po_parts", $data, $po_part_id);

if ($result) {

if (!empty($challan_number)) {
$challan_data = $this->Crud->get_data_by_id("challan", $challan_number, "id");
if ($challan_data) {
$arr = array(
'challan_id' => $challan_data[0]->id,
'part_id' => $part_id,
);
// print_r($arr);
$challan_parts_data = $this->Crud->get_data_by_id_multiple("challan_parts", $arr);
if ($challan_parts_data) {
foreach ($challan_parts_data as $cc) {
$challan_parts_qty = $cc->qty;
$challan_parts_remaning_qty = $cc->remaning_qty;


if ($qty > $challan_parts_qty) {
echo "Entered Qty is grater than challan qty";
} else {
$challan_id = $challan_data[0]->id;
$new_challan_qty = $challan_parts_remaning_qty - $qty;
$challan_parts_history_data = array(
"challan_id" => $challan_id,
"challan_parts_id" => $cc->id,
"po_id" => $po_number,
"previois_qty" => $challan_parts_remaning_qty,
"remaning_qty" => $new_challan_qty,
);
$result_challan_parts_history = $this->Crud->insert_data("challan_parts_history", $challan_parts_history_data);
if ($result_challan_parts_history) {
$data_update_challan_parts = array(
"remaning_qty" => $new_challan_qty,
);
$update_challan_parts = $this->Crud->update_data("challan_parts", $data_update_challan_parts, $cc->id);
if ($update_challan_parts) {
$arr = array(
'part_id' => $part_id,
);
// print_r($arr);
$routing_data = $this->Crud->get_data_by_id_multiple("routing", $arr);
if ($routing_data) {
foreach ($routing_data as $rr) {
$routing_part_id = $rr->routing_part_id;

$routing_qty = $rr->qty;

$new_sub_con_remove_qty = $qty * $routing_qty;


$routing_part_detail_data = $this->SupplierParts->getSupplierPartById($routing_part_id);
if ($routing_part_detail_data) {
$exsisting_sub_con_stock = $routing_part_detail_data[0]->sub_con_stock;

$sub_con_stock = $exsisting_sub_con_stock - $new_sub_con_remove_qty;
$data_update_child_part = array(
"sub_con_stock" => $sub_con_stock,
);
$update_challan_parts = $this->SupplierParts->updateStockById($data_update_child_part, $routing_part_id);
if ($update_challan_parts) {
echo "Success";
} else {
echo "Error while update routing_part_id data in child part";
}
} else {
echo "routing child part not found in db";
}
}
} else {
echo "Routing Data Not Found!!!!";
}
} else {
echo "Error While Updating challan_parts";
}
} else {
echo "Error while adding data into challan_parts_history";
}
}
}
} else {
echo "Challan Parts Data  Not Found !";
// echo "<script>alert('Challan Parts Data  Not Found !');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
}
} else {
echo "Challan Number Not Found !";
// echo "<script>alert('Challan Number Not Found !');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
}
} else {
echo "Successfully Added";
echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
}
} else {
echo "none error po_parts update not found";
}
} else {
echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
}
}*/

public function update_grn_qty()
{
	$verified_qty = $this->input->post('verified_qty');
	$privious_qty = $this->input->post('privious_qty');
	$grn_details_id = $this->input->post('grn_details_id');

	$tax_id = $this->input->post('tax_id');
	$part_rate = $this->input->post('part_rate');
	$inwarding_price = $part_rate * $verified_qty;
	$gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");

	$cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
	$sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
	$igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;

	$inwarding_price = $inwarding_price + $cgst_amount + $sgst_amount + $igst_amount;
	if ($verified_qty == $privious_qty) {
		$verified_status = "verified";
	} else {
		$verified_status = "not-verified";
	}
	$data = array(
		"verified_qty" => $verified_qty,
		"verfified_price" => round($inwarding_price,2),
		"verified_status" => $verified_status,

	);
	$result = $this->Crud->update_data("grn_details", $data, $grn_details_id);
	$success = 0;
	$messages = "Something went wrong";
	if ($result) {
		$success = 1;
		$messages = "Successfully Added";
		// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	} else {
		$messages = "Unable to Add";
		// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	}
	$return_arr = [];
	$return_arr['success'] = $success;
	$return_arr['messages'] = $messages;
	echo json_encode($return_arr);
	exit();
}
public function edit_grn_qty(){
	$verified_qty = $this->input->post('grn_details_validate_qty');
	$grn_details_id = $this->input->post('grn_details_id');
	$data = array(
		"verified_qty" => $verified_qty
	);
	$success = 0;
	$messages = "Something went wrong";
	$result = $this->Crud->update_data("grn_details", $data, $grn_details_id);
	if ($result) {
		$messages = "Successfully updated";
		$success = 1;
		// echo "<script>alert('Successfully updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	} else {
		$messages = "Unable to update";
		// echo "<script>alert('Unable to update');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	}
	$return_arr = [];
	$return_arr['success'] = $success;
	$return_arr['messages'] = $messages;
	echo json_encode($return_arr);
	exit();
}

public function update_grn_qty_accept_reject()
{
	
	$success = 0;
    $messages = "Something went wrong.";
	$accept_qty = $this->input->post('accept_qty');
	$grn_details_id = $this->input->post('grn_details_id');
	$verified_qty = $this->input->post('verified_qty');
	$remark = $this->input->post('remark');
	$part_id = $this->input->post('part_id');
	$deliveryUnit = $this->input->post('deliveryUnit');
	$client_data = $this->Crud->get_data_by_id("client", $deliveryUnit, "client_unit");
	// $reject_qty = $verified_qty - $accept_qty;
	$reject_qty = $this->input->post('reject_qty') != "" && $this->input->post('reject_qty') != null ? $this->input->post('reject_qty') : 0;
	//$child_part_master_data = $this->Crud->get_data_by_id("child_part_master", $part_id, "id");
	$child_part_master_data_new = $this->SupplierParts->getSupplierPartById($part_id);
	$stockColName = $this->Crud->getStockColNmForClientUnit($client_data[0]->id);
	$prev_stock = $child_part_master_data_new[0]->$stockColName;
	$new_stock = (float)$prev_stock + (float)$accept_qty;
	$total_qty = $accept_qty+ $reject_qty;
	if($total_qty == $verified_qty){
			// pr($new_stock,1);
			$data = array(
				"accept_qty" => $accept_qty,
				"reject_qty" => $reject_qty,
				"remark" => $remark,
			);

			// pr($data,1);

			$result = $this->Crud->update_data("grn_details", $data, $grn_details_id);

			if ($result) {
				$data22 = array(
					$stockColName => $new_stock,
				);

				// $result22 = $this->SupplierParts->updateStockById($data22, $part_id);
				// if ($result22) {
					$success = 1;
					$messages = "Successfully Added";
					// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				// } else {
					// $messages = "Unable to Add2";
					// echo "<script>alert('Unable to Add2');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				// }
			} else {
				$messages = "Unable to Add";
				// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
	}else{
		$messages = "The sum of Accept Qty. and Reject Qty must be equal to GRN Validation Qty";
	}
	$result = [];
	$result['messages'] = $messages;
    $result['success'] = $success;
    echo json_encode($result);
    exit();
}
}
