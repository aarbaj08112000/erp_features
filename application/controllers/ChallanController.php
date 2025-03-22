<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class ChallanController extends CommonController {

	const VIEW_CHALLAN_PATH = "challan/";

	function _construct()
    {
        parent::_construct();
		$this->load->model('SupplierParts');
    }

	private function getPath(){
		return self::VIEW_CHALLAN_PATH;
	}

	private function test()	{
	$this->getPage('sales_reports.php', $data);

	}

	public function view_add_challan()
	{
		$this->challan_search();
	}

	public function challan_search()
	{
		checkGroupAccess("view_add_challan","list","Yes");
		$challanId = $this->input->post('challan_id');
		$supplierId = $this->input->post('supplier_id');

		$queryList = "SELECT c.id, c.challan_number FROM `challan` as c WHERE c.clientId =  ".$this->Unit->getSessionClientId()." order by c.id desc";
		$data['challanNo_list'] = $this->Crud->customQuery($queryList);
		$data['supplier'] = $this->Crud->read_data("supplier");
		
		
		$data['consignee_list'] = $this->Crud->read_data_acc("consignee");
		//set search selection
		$data['challan_id']=$challanId;
		$data['supplier_id']=$supplierId;

		$column[] = [
            "data" => "challan_number",
            "title" => "Challan Number",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "remark",
            "title" => "Remark",
            "width" => "13%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "vechical_number",
            "title" => "Vechical Number",
            "width" => "12%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "mode",
            "title" => "Mode Of Transport",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "transpoter",
            "title" => "Transporter",
            "width" => "8%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "l_r_number",
            "title" => "L.R number",
            "width" => "8%",
            "className" => "dt-center",
        ];
		$column[] = [
				"data" => "created_date",
				"title" => "Date",
				"width" => "7%",
				"className" => "dt-center",
		];
		
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];

		$column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];

		$column[] = [
            "data" => "view_details",
            "title" => "View Details",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "id",
            "title" => "Id",
            "width" => "7%",
            "className" => "dt-center ",
            "visible" => false
        ];
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No GRN Validation data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[10, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();

		$this->loadView('store/view_add_challan', $data);
	}
	public function get_challan_search_data()
	{
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
		$data = $this->SupplierParts->get_challan_search_view_data(
            $condition_arr,
            $post_data["search"]
        );
		// pr($data,1);
		foreach ($data as $key => $value) {
			$edit_data = base64_encode(json_encode($value)); 
			$data[$key]['view_details'] = '<a href="'.base_url("view_challan_by_id/").$value['id'].'" class="" title="View"><i class="ti ti-eye"></i></a>';
		}	
		// pr($data,1);
		$data["data"] = $data;
        $total_record = $this->SupplierParts->get_challan_search_data_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
		
	}

	public function view_challan_by_id()
	{
		$challan_id = $this->uri->segment('2');
		$data['challan_id'] = $challan_id;
		$data['challan_data'] = $this->Crud->get_data_by_id("challan", $challan_id, "id");
		if($data['challan_data'][0]->status !='completed'){
			$data['child_part']  = $this->SupplierParts->readSupplierPartsNotSubcon();
			$data['process'] = $this->Crud->read_data("process");
		}
		$data['challan_parts'] = $this->Crud->get_data_by_id("challan_parts", $challan_id, "challan_id");
		foreach ($data['challan_parts'] as $key => $p) {
			$child_part_data = $this->Crud->get_data_by_id("child_part", $p->part_id, "id");
			$data['challan_parts'][$key]->child_part_data = $child_part_data;
			$data2 = array(
                'challan_id' => $challan_id,
                'part_id' => $p->part_id,
            );
            $challan_parts_history_data = $this->Crud->get_data_by_id_multiple_condition("challan_parts_history", $data2);
            $data['challan_parts'][$key]->challan_parts_history_data = $challan_parts_history_data;
		}
		// pr($data['challan_parts'],1);
		$data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['challan_data'][0]->supplier_id, "id");

		$this->loadView('store/view_challan_by_id', $data);
	}


	public function add_challan_parts()
	{
		
		$challan_id = $this->input->post('challan_id');
		$client_id = $this->Unit->getSessionClientId();
		$challanPartCount = $this->db->query('SELECT COUNT(*) as count FROM `challan_parts` where challan_id = ' . $challan_id)->row();
		if($challanPartCount->count >= 7) {
			$this->addWarningMessage("Already 7 parts added. No more parts are allowed.");
			$this->redirectMessage();
			exit();
		}

		$qty = $this->input->post('qty');
		$part_id = $this->input->post('part_id');
		$process = $this->input->post('process');

		$uniqueCheck = array(
			'challan_id' => $challan_id,
			'part_id' => $this->input->post('part_id'),

		);

		$challan_parts = $this->Crud->get_data_by_id_multiple_condition("challan_parts", $uniqueCheck);
		$success = 0;
		$messages = "Somthing went Wrong";
		if ($challan_parts) {
			$messages = "Part already present.";
			// $this->addWarningMessage("Part already present.");
			// $this->redirectMessage();
		} else {
			$child_part_data = $this->SupplierParts->getSupplierPartById($this->input->post('part_id'));
			$data = array(
				'challan_id' => $challan_id,
				'part_id' => $this->input->post('part_id'),
				'qty' => $this->input->post('qty'),
				'remaning_qty' => $this->input->post('qty'),
				'process' => $process,
				'value' => $child_part_data[0]->store_stock_rate * $qty,
				'hsn' => $child_part_data[0]->hsn_code,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"day" => $this->date,
				"month" => $this->month,
				"year" => $this->year,
			);

			$current_stock = $child_part_data[0]->stock;

			if ((float)$qty > (float)$current_stock) {
				$messages = "Store stock quantity is less than entered quantity.";
				// $this->addWarningMessage("Store stock quantity is less than entered quantity.");
				// $this->redirectMessage();
			} else {
				$inser_query = $this->Crud->insert_data("challan_parts", $data);
				if ($inser_query) {
					$updateResult = $this->db->query("update child_part_stock set stock = COALESCE(stock, 0) - ".$qty.", sub_con_stock = COALESCE(sub_con_stock, 0) + ".$qty."
					where childPartId =".$part_id." AND clientId=".$client_id);
					if($updateResult){
						$messages = "Part added.";
						$success = 1;
						// $this->addSuccessMessage("Part added.");
					}else{
						$messages = "Error while adding quantity to stock.";
						// $this->addErrorMessage("Error while adding quantity to stock.");
					}
					// $this->redirectMessage();

						/*
						$current_stock = $child_part_data[0]->stock;
						old code $new_stock = $current_stock - $qty;
						$oldSubcon = $child_part_data[0]->sub_con_stock;
						$newsubcon = $oldSubcon + $qty;

						$stockUpdate = array(
							'stock' => $new_stock,
							'sub_con_stock' => $newsubcon,
						);

						$update = $this->Crud->update_data("child_part", $stockUpdate, $part_id);
						if ($update) {
							$this->addSuccessMessage("Part added successfully");
						} else {
							$this->addErrorMessage("Error while updating Qty to stock");
						}*/

				} else {
					$messages = "Error while adding quantity.";
					// $this->addErrorMessage("Error while adding quantity.");
					// $this->redirectMessage();
				}
			}
		}

		$return_arr = [];
		$return_arr['success'] = $success;
		$return_arr['messages'] = $messages;
		echo json_encode($return_arr);

		exit();
	}

	public function delete_challan_part()
	{

		// pr("ok",1);
		$id = $this->input->post('id');
		$partQty = $this->input->post('partQty');
		$part_id = $this->input->post('part_id');

		$table_name = $this->input->post('table_name');

		$data = array(
			"id" => $id
		);
		$result = $this->Crud->delete_data($table_name, $data);
		$success = 0;
		$messages = "Somthing went Wrong";
		if ($result) {
			//select stock,sub_con_stock from child_part where id = 1
			//97,1003
			$updateResult = $this->db->query("update child_part_stock set stock = stock + ".$partQty.", sub_con_stock = sub_con_stock - ".$partQty."
			where childPartId =".$part_id);
			if($updateResult){
				$success = 1;
				$messages = "Part successfully deleted.";
				// $this->addSuccessMessage("Part successfully deleted.");
			}else{
				$messages = "Error while updating Qty to stock.";
				// $this->addErrorMessage("Error while updating Qty to stock.");
			}
		} else {
			$messages = "Failed to delete part.";
			// $this->addErrorMessage("Failed to delete part.");
		}
		$return_arr = [];
		$return_arr['success'] = $success;
		$return_arr['messages'] = $messages;
		echo json_encode($return_arr);

		exit();
	}

	private function getPage($viewPage,$viewData){
		$this->getHeaderPage();
		$this->load->view($this->getPath().$viewPage,$viewData);
		$this->load->view('footer.php');
	}


	public function generate_challan()
	{
		$sub_po_id = $this->input->post('sub_po_id');
		$supplier_id = $this->input->post('supplier_id');
		$sub_po_id = $this->input->post('sub_po_id');
		$supplier_id = $this->input->post('supplier_id');
		$vechical_number = $this->input->post("vechical_number");
		$remark = $this->input->post("remark");
		$mode = $this->input->post("mode");
		$transpoter = $this->input->post("transpoter");
		$l_r_number = $this->input->post("l_r_number");

		$ship_addressType = $this->input->post('ship_addressType');
		$consignee_id = $this->input->post('consignee');

		$latestSeqFormat = $this->Crud->customQuery("SELECT challan_number FROM challan WHERE challan_number like '" . $this->getChallanSerialNo() . "%' order by id desc LIMIT 1");
		foreach ($latestSeqFormat as $p) {
			$currentChallanNo = $p->challan_number;
		}

		$challan_num = substr($currentChallanNo, strlen($this->getChallanSerialNo())) + 1;
		$challan_number = $this->getChallanSerialNo() . $challan_num;

		$data = array(
				"clientId" => $this->Unit->getSessionClientId(),
				"challan_number" => $challan_number,
				"supplier_id" => $supplier_id,
				"shipping_addressType" => $ship_addressType,
				"consignee_id" => $consignee_id,
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
			);

			$result = $this->Crud->insert_data("challan", $data);
			// if ($result) {
			// 	echo "<script>alert('Successfully Added');document.location='" . base_url('view_challan_by_id/') . $result . "'</script>";
			// } else {
			// 	echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			// }
			if ($result) {
					$success = 1;
					$messages = "Successfully Added";
			} else {
					$success = 0;
					$messages = "Unable to Add.";
			}

			$return_arr['success'] = $success;
			$return_arr['messages'] = $messages;
			echo json_encode($return_arr);
			exit;
	}
	public function customerChallanRN()  
	{
		checkGroupAccess("challan_inward","list","Yes");
		$data['customer'] = $this->Crud->read_data("customer");
		// $data['rejection_sales_invoice'] = $this->Crud->read_data("rejection_sales_invoice");
		$sql = "
			SELECT ch.*,c.customer_name as customer_name
			FROM customer_challan_return as ch
			LEFT JOIN customer as c On c.id = ch.customer_id";
		$data['customer_challan_return'] = $this->Crud->customQuery($sql);
		// pr($data['customer_challan_return'],1);
		// $this->load->view('header');
		$this->loadView('store/customer_return_challana', $data);
		// $this->load->view('footer');	
	}
	public function generate_customer_challan_return(){
		$post_data =  $this->input->post();
		$customer_return_challan_count = $this->SupplierParts->checkCustomerChallanReturn();
		$count = count($customer_return_challan_count);
		$current_year = date('y');
		$next_year = date('y')+1;
		$count_number = (int) $count+1;
		$grn_code = "CCN/".$current_year."-".$next_year."/".$count_number;
		$success = 0;
        $messages = "Something went wrong.";
		$insert_arr = [
			"customer_id" => $post_data['customer_id'],
			"grn_code" => $grn_code,
			"client_id" =>$this->Unit->getSessionClientId(),
			"customer_challan_no" => $post_data['customer_challan_no'],
			"customer_challan_data" => $post_data['customer_date'],
			"type" => $post_data['type'],
			"status"=>"Pending",
			"created_date" => date("Y-m-d H:i:s"),
			"created_by" => $this->session->userdata('user_id')
		];
		$insert_id = $this->SupplierParts->saveCustomerChallanReturn($insert_arr);
		if ($insert_id > 0) {
			$messages = "Successfully Added";
			$success = 1;
			// echo "<script>alert('Successfully Added');document.location='" . base_url('view_challan_return/') . $insert_id . "'</script>";
		} else {
			$messages = "Unable to Add";
			// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
			
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function view_challan_return()  
	{

		$customer_challan_return_id = $this->uri->segment(2);
		$sql = "
			SELECT ch.*,c.customer_name as customer_name
			FROM customer_challan_return as ch
			LEFT JOIN customer as c On c.id = ch.customer_id
			WHERE ch.customer_challan_return_id = ".$customer_challan_return_id;
		$data['customer_challan_return_details'] = $this->Crud->customQuery($sql);
		$child_part_list = $this->db->query('SELECT DISTINCT part_number,part_description,id FROM `customer_part` where customer_id = ' . $data['customer_challan_return_details'][0]->customer_id . '');
		$data['customer_part'] = $child_part_list->result();
		$data['customer'] = $this->Crud->read_data("customer");

		$sql = "
			SELECT chp.*,cp.uom as uom,gs.code as gst_code
			FROM customer_challan_return_part as chp
			LEFT JOIN customer_part as cp ON cp.id = chp.part_id
			LEFT JOIN gst_structure as gs ON gs.id = cp.gst_id
			WHERE chp.customer_challan_return_id = ".$customer_challan_return_id;
		$data['customer_challan_return_part_details'] = $this->Crud->customQuery($sql);
		foreach ($data['customer_challan_return_part_details'] as $key => $p) {
			$child_part_data = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
			$data['customer_challan_return_part_details'][$key]->part_number = $child_part_data[0]->part_number;
			$data['customer_challan_return_part_details'][$key]->part_description = $child_part_data[0]->part_description;
		}
		$this->loadView('store/customer_return_challana_view', $data);
	}
	public function add_parts_customer_challan_return()
	{
		// pr($this->input->post(),1);
		$customer_id = $this->input->post('customer_id');
		$part_id = $this->input->post('part_id');
		$customer_challan_return_id = $this->input->post('customer_challan_return_id');
		$qty = $this->input->post('qty');
		$data_check = array(
				"customer_id" => $customer_id,
				"part_id" => $part_id,
				"customer_challan_return_id" => $customer_challan_return_id,
			);	
		$customer_challan_return_part = $this->Crud->get_data_by_id_multiple("customer_challan_return_part", $data_check);
		$success = 0;
        $messages = "Something went wrong.";
		if(count($customer_challan_return_part) > 0)
		{
			$messages = "Error : Part Already Present, please try again "; 
			// echo "<script>alert('Error : Part Already Present, please try again ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";

		}
		else
		{	
			// pr($customer_challan_return_part,1);
			$sql = "SELECT cp.*,t.*,cpr.* FROM customer_part as cp 
			LEFT JOIN customer_part_rate as cpr ON cpr.customer_master_id = cp.id
			LEFT JOIN gst_structure as t ON t.id = cp.gst_id 
			WHERE cp.id = ".$part_id."
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
				"customer_id" => $customer_id,
				"customer_challan_return_id" => $customer_challan_return_id,
				"part_id" => $part_id,
				"qty" => $qty,
				"created_by" => $this->user_id,
				"created_date" => date("Y-m-d H:i:s"),
				'part_price' => $value->rate,
				"basic_total" => $basic_total,
				'total_rate' =>$total_rate,
				'cgst_amount' =>$cgst_amount,
				'sgst_amount' =>$sgst_amount ,
				'igst_amount' => $igst_amount,
				'tcs_amount' =>$tcs_amount,
				'gst_amount'=>$gst_amount
		
			);

			$result = $this->Crud->insert_data("customer_challan_return_part", $data);
			if ($result) {
				$messages = "Successfully Part Added";
				$success =1;
				// echo "<script>alert('Successfully Part Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
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
	public function update_customer_challan_return(){
		// pr($this->input->post(),1);
		$post_data = $this->input->post();
		$customer_challan_return_id = $post_data['customer_challan_return_id'];
		$update_arr = [
			"customer_challan_no" => $post_data['customer_challan_no'],
			"customer_challan_data" => $post_data['customer_date'],
			"type" => $post_data['type'],
			"updated_date" => date("Y-m-d H:i:s"),
			"updated_by" => $this->session->userdata('user_id')
		];
		$afftected_row = $this->SupplierParts->updateCustomerChallanReturn($update_arr,$customer_challan_return_id);
		$success = 0;
        $messages = "Something went wrong.";
		if ($afftected_row > 0) {
			$messages = "Successfully Updated";
			$success = 1;
			// echo "<script>alert('Successfully Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Unab le to Add";
			// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function update_parts_customer_challan_return(){
		$customer_challan_return_part_id = $this->input->post("customer_challan_return_part_id");
		$part_id = $this->input->post("part_id");
		$qty = $this->input->post("qty");
		$success = 0;
        $messages = "Something went wrong.";
		$sql = "SELECT cp.*,t.*,cpr.* FROM customer_part as cp 
			LEFT JOIN customer_part_rate as cpr ON cpr.customer_master_id = cp.id
			LEFT JOIN gst_structure as t ON t.id = cp.gst_id 
			WHERE cp.id = ".$part_id."
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
				"part_id" => $part_id,
				"qty" => $qty,
				"updated_by" => $this->user_id,
				"updated_date" => date("Y-m-d H:i:s"),
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

			$afftected_row = $this->SupplierParts->updateCustomerChallanReturnPart($data,$customer_challan_return_part_id);
			if ($afftected_row > 0) {
				$messages = "Successfully Part Updated";
				$success =1 ;
				// echo "<script>alert('Successfully Part Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Unab le to Add";
				// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function delete_customer_challan_inward(){
		$customer_challan_return_part_id = $this->input->post('customer_challan_return_part_id');
		$this->SupplierParts->deleteCustomerChallanInwardPart($customer_challan_return_part_id);
		// echo "<script>alert('Successfully Delete Part');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		$result = [];
        $result['messages'] = "Successfully Delete Part";
        $result['success'] = 1;
        echo json_encode($result);
        exit();
	}
	public function lock_challan_return(){
		$customer_challan_return_id = $this->input->post("id");
		$update_arr = [
			"status" => "Lock"
		];
		$success = 0;
        $messages = "Something went wrong.";
		$afftected_row = $this->SupplierParts->updateCustomerChallanReturn($update_arr,$customer_challan_return_id);
		if ($afftected_row > 0) {
			$success =1;
			$messages = "Lock Successfully";
		// echo "<script>alert('Lock Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}else {
			$messages = "Unab le to Add";
		// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function challan_part_return(){
		checkGroupAccess("challan_part_return","list","Yes");
		$data['customer'] = $this->Crud->read_data("customer");
		// $data['rejection_sales_invoice'] = $this->Crud->read_data("rejection_sales_invoice");
		$sql = "
			SELECT ch.*,c.customer_name as customer_name,DATE(ch.created_date) as created_date
			FROM customer_challan_part_return as ch
			LEFT JOIN customer as c On c.id = ch.customer_id ORDER BY ch.customer_challan_part_return_id DESC ";
		$data['customer_challan_part_return'] = $this->Crud->customQuery($sql);
		// pr($data['customer_challan_return'],1);
		$data['transporter'] = $this->Crud->read_data("transporter");
		// pr($data,1);
		// $this->load->view('header');
		$this->loadView('store/customer_return_challan_part', $data);
		// $this->load->view('footer');
	}
	public function get_customer_challan_part(){
		$customer_id = $this->input->post("customer_id");
		$already_exit_data = $this->SupplierParts->getCustomerChallanPartReturnPart($customer_id);
		$already_exit_data = array_column($already_exit_data, "qty","part_id");
		$part_data = $this->SupplierParts->getCustomerChallanReturnPartQty($customer_id);
		if(count($part_data) > 0){
			$html = "";
			foreach ($part_data as $key => $value) {
				$exit_qty = isset($already_exit_data[$value['part_id']]) ? $already_exit_data[$value['part_id']] : 0 ;
				$qty = $value['qty'] - $exit_qty;
				if($qty > 0){
					$html .= "
					<tr>
						<td >".$value['part_number']."/".$value['part_description']."</td>
						<td class='text-center'>".number_format($qty)."</td>
						<td class='text-center'>
						<input type='hidden'  value='".$value['part_id']."' name='part_id[]' />
						<input type='text' class='part_qty_input form-control w-50 m-auto onlyNumericInput' value='".$qty."' data-value='".$qty."' name='part_qty[]' />
						</td>
					</tr>";
				}
			}
			if($html === ""){

				$html = '<tr class="text-center"><td colspan="3">No Part Found</td></tr>';
			}
		}else{
			$html = '<tr class="text-center"><td colspan="3">No Part Found</td></tr>';
		}
		
		
		$return_arr['html'] = $html;
		echo json_encode($return_arr);
	}

	public function generate_customer_challan_return_part(){
		$post_data = $this->input->post();
		// 
		$part_id_arr = $this->input->post("part_id");
		$customer_id = $this->input->post("customer_id");
		$success = 0;
        $messages = "Something went wrong.";
        $part_qty_arr = $this->input->post("part_qty");
        $falg = 0;
        foreach ($part_qty_arr as $key => $value) {
        	if($value > 0){
        		$falg = 1;
        	}
        }
		if(isset($post_data["part_id"]) && isset($post_data["part_qty"]) && count($part_id_arr) <= 8 && $falg == 1){
			$customer_return_challan_count = $this->SupplierParts->checkCustomerChallanPartReturn();
			$count = count($customer_return_challan_count);
			$current_year = date('y');
			$next_year = date('y')+1;
			$count_number = (int) $count+1;
			$grn_code = $this->getCustomerReturnPartNUmber().$count_number;
			$insert_arr = [
				"customer_id" => $customer_id,
				"grn_code" => $grn_code,
				"client_id" =>$this->Unit->getSessionClientId(),
				"customer_challan_no"=>$post_data['customer_challan_no'],
				"transportor_id"=>$post_data['transportor_id'],
				"vehicle_number"=>$post_data['vehicle_number'],
				"status"=>"Pending",
				"created_date" => date("Y-m-d H:i:s"),
				"created_by" => $this->session->userdata('user_id')
			];
			$insert_id = $this->SupplierParts->saveCustomerChallanPartReturn($insert_arr);

			if($insert_id > 0){
				$return_part_data = [];
				foreach ($part_id_arr as $key => $value) {
					$customer_part_data = $this->SupplierParts->getCustomerPartDetails($value);
					$part_id = $value;
					$qty = $part_qty_arr[$key];
					$value = $customer_part_data[0];
					$basic_total = $qty *  $value['rate'];
					if ($value['igst'] <= 0) {
				                $gst = (float) $value['cgst'] + (float) $value['sgst'];
				                $cgst = (float) $value['cgst'];
				                $sgst = (float) $value['sgst'];
				                $tcs = (float) $value['tcs'];
				                $igst = 0;
				                $total_gst_percentage = $cgst + $sgst;
				    } else {
				                $gst = (float) $value['igst'];
				                $tcs = (float) $value['tcs'];
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
					if ($value['tcs_on_tax'] == "no") {
						$tcs_amount =   (($total_amount * $tcs) / 100);
					} else {
						$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);	
					}
					$total_rate = $total_amount + $gst_amount;	

					if($qty > 0){
						$return_part_data[] = array(
							"customer_id" => $customer_id,
							"customer_challan_part_return_id" => $insert_id,
							"part_id" => $part_id,
							"qty" => $qty,
							"created_by" => $this->user_id,
							"created_date" => date("Y-m-d H:i:s"),
							'part_price' => $value['rate'],
							"basic_total" => $basic_total,
							'total_rate' =>$total_rate,
							'cgst_amount' =>$cgst_amount,
							'sgst_amount' =>$sgst_amount ,
							'igst_amount' => $igst_amount,
							'tcs_amount' =>$tcs_amount,
							'gst_amount'=>$gst_amount
					
						);
					}
				}

				$part_insert_id = $this->SupplierParts->saveCustomerChallanPartReturnPart($return_part_data);
				if($part_insert_id > 0){
					$messages = "Successfully Added";
					$success =1;
					// echo "<script>alert('Successfully Added');document.location='" . base_url('challan_part_return_details/').$insert_id."'</script>";
				} else {
					$messages = "Unable to Add";
					// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
		}else{
			if(count($part_id_arr) > 0 && $falg == 1){
				$messages = "Please add part less than or equals to 8";
				// echo "<script>alert('Please add part less than or equals to 8');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}else if(count($part_id_arr) == 0){
				$messages = "Please add part";
				// echo "<script>alert('Please add part');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}else if($falg == 0){
				$messages = "Please add part qty";
			}
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function challan_part_return_details(){
		$customer_challan_return_part_id = $this->uri->segment(2);
		$challan_part_return_details = $this->SupplierParts->getCustomerChallanPartReturn($customer_challan_return_part_id);
		$date = new DateTime($challan_part_return_details['created_date']);
        $formattedDate = $date->format('d-m-Y');
		$challan_part_return_details['created_date'] = $formattedDate;
		$challan_part_return_part_details = $this->SupplierParts->getCustomerChallanPartReturnPartDetails($customer_challan_return_part_id);
		// pr($challan_part_return_details,1);
		$data['challan_part_return_details'] = $challan_part_return_details;
		$data['challan_part_return_part_details'] = $challan_part_return_part_details;
		$data['user_type'] = $this->session->userdata['type'];
		$this->loadView('store/customer_challan_part_return_view', $data);
		// pr($data,1);
	}
	public function update_customer_challan_part_return(){
		$post_data = $this->input->post();
		$qty = $post_data['qty'];
		$part_id = $post_data['part_id'];
		$customer_id = $post_data['customer_id'];
		$customer_challan_part_return_part_id = $post_data['customer_challan_part_return_part_id'];
		$total_customer_qty = $this->SupplierParts->getCustomerChallanPartReturnData($customer_id,$part_id);
		$total_customer_qty = $total_customer_qty['qty'] != "" ? $total_customer_qty['qty'] : 0;
		$existing_qty = $this->SupplierParts->getCustomerChallanPartReturnPartData($customer_id,$part_id,$customer_challan_part_return_part_id);
		$existing_qty = isset($existing_qty['qty']) != "" ? $existing_qty['qty'] : 0;
		$pending_qty = $total_customer_qty - $existing_qty;
		$success = 0;
        $messages = "Something went wrong.";
		if($qty <= $pending_qty){

		$qty = $this->input->post("qty");
		$sql = "SELECT cp.*,t.*,cpr.* FROM customer_part as cp 
			LEFT JOIN customer_part_rate as cpr ON cpr.customer_master_id = cp.id
			LEFT JOIN gst_structure as t ON t.id = cp.gst_id 
			WHERE cp.id = ".$part_id."
			ORDER BY cpr.revision_no DESC";
			$customer_parts = $this->Crud->customQuery($sql);	
			$value = $customer_parts[0];
			$basic_total = $qty *  $value->rate;
			if ($value->igst <= 0) {
		                $gst = $value->cgst + $value->sgst;
		                $cgst = $value->cgst;
		                $sgst = $value->sgst;
		                $tcs = $value->tcs;
		                $igst = 0;
		                $total_gst_percentage = $cgst + $sgst;
		    } else {
		                $gst = $value->igst;
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

			$update_arr = array(
				"part_id" => $part_id,
				"qty" => $qty,
				"updated_by" => $this->user_id,
				"updated_date" => date("Y-m-d H:i:s"),
				'part_price' => $value->rate,
				"basic_total" => $basic_total,
				'total_rate' =>$total_rate,
				'cgst_amount' =>$cgst_amount,
				'sgst_amount' =>$sgst_amount ,
				'igst_amount' => $igst_amount,
				'tcs_amount' =>$tcs_amount,
				'gst_amount'=>$gst_amount
			);

			$afftected_row = $this->SupplierParts->updateCustomerChallanPartReturn($update_arr,$customer_challan_part_return_part_id);
			if ($afftected_row > 0) {
				$messages = "Successfully Updated";
				$success = 1;
				// echo "<script>alert('Successfully Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Unab le to Add";
				// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}else{
			$messages = "Please add part qty less then $pending_qty";
			// echo "<script>alert('Please add part qty less then $pending_qty');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		
		
	}
	public function lock_customer_challan_return_part(){
		$customer_challan_return_id = $this->input->post("id");
		$update_arr = [
			"status" => "Lock"
		];
		$success = 0;
        $messages = "Something went wrong.";
		$afftected_row = $this->SupplierParts->lockCustomerChallanPartReturn($update_arr,$customer_challan_return_id);
		if ($afftected_row > 0) {
			$messages = "Lock Successfully";
			$success =1 ;
				// echo "<script>alert('Lock Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}else {
			$messages = "Unab le to Add";
				// echo "<script>alert('Unab le to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		
	}
	public function customer_challan_report(){
		checkGroupAccess("customer_challan_report","list","Yes");
		$customer_wise_qty = $this->SupplierParts->getCustomerWiseChallanQty();
		$customer_name_arr = array_unique(array_column($customer_wise_qty,"customer_name"));
		if(count($customer_wise_qty) > 0){
			$customer_wise_return_qty = $this->SupplierParts->getCustomerWiseReturnChallanQty();
			$customer_wise_return_qty_arr =  array_column($customer_wise_return_qty,"qty","part_id");
			$customer_wise_return_price_arr =  array_column($customer_wise_return_qty,"total_rate","part_id");
			foreach ($customer_wise_qty as $key => $value) {
				$return_qty = isset($customer_wise_return_qty_arr[$value['part_id']]) ? $customer_wise_return_qty_arr[$value['part_id']] : 0 ;
				$qty = $value['qty'] - $return_qty;

				$return_price = isset($customer_wise_return_price_arr[$value['part_id']]) ? $customer_wise_return_price_arr[$value['part_id']] : 0;
				$price = $value['total_rate'] - $return_price;
				$customer_wise_qty[$key]['qty'] = $qty > 0  ? $qty : 0;
				$customer_wise_qty[$key]['total_rate'] = $price > 0  ? $price : 0;;
				
			}
		}
		$data['customer_name_arr'] = $customer_name_arr;
		$data['customer_wise_qty'] = $customer_wise_qty;
		// $this->load->view('header');
		// pr($data,1);
		$this->loadView('reports/customer_challan_report', $data);
		// $this->load->view('footer');
		
	}
	public function generate_customer_challan_part_return_pdf(){
		$customer_challan_part_return_id = $this->uri->segment(2);
		$type = $this->uri->segment(3);
		$customer_challan_return_part = $this->SupplierParts->getCustomerChallanPartReturn($customer_challan_part_return_id);
		$client_data = $this->SupplierParts->getClientData($customer_challan_return_part['client_id']);
		$customer_data = $this->SupplierParts->getCustomerDetails($customer_challan_return_part['customer_id']);
		$customer_challan_return_part_details = $this->SupplierParts->getCustomerChallanPartReturnPartDetails($customer_challan_part_return_id);


		$data['customer_challan_return_part'] = $customer_challan_return_part;
		$data['client_data'] = $client_data;
		$data['customer_data'] = $customer_data;
		$data['customer_challan_return_part_details'] = $customer_challan_return_part_details;
		$data['type'] = $type;
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
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
        $data['signatureImageEnable'] =$signatureImageEnable;
        $data['signatureImageUrl'] =$signatureImageUrl;
        $data['digitalSignature'] =$digitalSignature;
        $date = new DateTime($customer_challan_return_part['created_date']);
        $data['customer_challan_return_part']['created_date'] = $date->format('d-m-Y');
        $data['customer_challan_return_part']['created_time'] = $date->format('H:i:s');
		$html_content = $this->smarty->fetch('store/return_challan_pdf.tpl', $data, TRUE);
		// pr($html_content,1);
		$this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $pdfName = $customer_challan_part_return_id.'-Delivery-Challan-'. $type . '.pdf';
        if($digitalSignature== "Yes" ){
        	   
                $output = $this->pdf->output();
                $fileName = "dist/uploads/challan_return_part_print/".$pdfName;
                $fileAbsolutePath = FCPATH.$fileName;
                // pr($pdfName,1);
                // upload pdf
                file_put_contents($fileAbsolutePath, $output);
                // generate digital signature
                $signer = $configuration['signer'];
                $certpwd = $configuration['certpwd'];
                $certid = $configuration['certid'];
                $customerPrefix = $configuration['customerPrefix'];
                $digital_signature_url = $configuration['digital_signature_url'];
                $SignaturePostion = '[440:40]';
                
                // pr("ok",1);
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

	public function generate_customer_challan_part_return_multiple_pdf(){
		// pr($this->input->post(),1);

		$customer_challan_part_return_id = $this->uri->segment(2);
		$post_data = $this->input->post();
		$copies = array_values($post_data['interests']);
		
		$type = $this->uri->segment(3);
		$customer_challan_return_part = $this->SupplierParts->getCustomerChallanPartReturn($customer_challan_part_return_id);
		$client_data = $this->SupplierParts->getClientData($customer_challan_return_part['client_id']);
		$customer_data = $this->SupplierParts->getCustomerDetails($customer_challan_return_part['customer_id']);
		$customer_challan_return_part_details = $this->SupplierParts->getCustomerChallanPartReturnPartDetails($customer_challan_part_return_id);


		$data['customer_challan_return_part'] = $customer_challan_return_part;
		$data['client_data'] = $client_data;
		$data['customer_data'] = $customer_data;
		$data['customer_challan_return_part_details'] = $customer_challan_return_part_details;
		$data['type'] = $type;
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
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

        /* added because its not aplicable */
        $digitalSignature = "No";

        $data['signatureImageEnable'] =$signatureImageEnable;
        $data['signatureImageUrl'] =$signatureImageUrl;
        $data['digitalSignature'] =$digitalSignature;
        $data['copies'] = $copies;
        
		$html_content = $this->smarty->fetch('store/return_challan_miltiple_pdf.tpl', $data, TRUE);
		
		$this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $pdfName = $customer_challan_part_return_id.'-Delivery-Challan-'. $type . '.pdf';
        if($digitalSignature== "Yes"){
                $output = $this->pdf->output();
                $fileName = "dist/uploads/challan_return_part_print/".$pdfName;
                $fileAbsolutePath = FCPATH.$fileName;
                // pr($pdfName,1);
                // upload pdf
                file_put_contents($fileAbsolutePath, $output);
                // generate digital signature
                $signer = $configuration['signer'];
                $certpwd = $configuration['certpwd'];
                $certid = $configuration['certid'];
                $customerPrefix = $configuration['customerPrefix'];
                $digital_signature_url = $configuration['digital_signature_url'];
                $SignaturePostion = '[440:40]';
                if($isEinvoicePresent){
                    $SignaturePostion = '[440:55]';
                }
                // pr("ok",1);
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
}
