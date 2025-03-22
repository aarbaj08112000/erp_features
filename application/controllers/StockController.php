<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');

class StockController extends CommonController
{

	const PATH = "";

	function __construct()
	{
		parent::__construct();
		$this->load->model('InhouseParts');
		$this->load->model('SupplierParts');
	}

	private function getPath()
	{
		return self::PATH;
	}

	private function getPage($viewPage, $viewData)
	{
		$this->loadView($this->getPath() . $viewPage, $viewData);
	}

	public function part_stocks() {
		$this->_part_stocks('');
	}

	public function view_part_stocks() {
		$this->_part_stocks($this->input->post('part_id'),$this->input->post('clientUnit'));
	}

	public function part_stocks_view($filter_part_id = 0, $filter_client='') {
		
		$entitlements = $this->session->userdata("entitlements");
		$isSheetMetal = isset($entitlements['isSheetMetal']) && $entitlements['isSheetMetal'] != null ? "Yes" : "No";
		

		checkGroupAccess("part_stocks","list","Yes");
		$data['child_part_list'] = $this->SupplierParts->readSupplierParts();
			
		$stock_column_name = $this->Unit->getStockColNmForClientUnit();

		//FOR SHEET ONLY
        $sheet_prod_column_name = $this->Unit->getProdColNmForClientUnit();
		
		//FOR PLASTIC ONLY
		$plastic_prod_column_name = $this->Unit->getPlasticProdColNmForClientUnit();
		
		//Sharing_qty
		$sharingQtyColName = $this->Unit->getSharingQtyColNmForClientUnit();

        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "uom_name",
            "title" => "UOM",
            "width" => "10%",
            "className" => "dt-center"
        ];
        $column[] = [
            "data" => "safty_buffer_stk_val",
            "title" => "Minimum Stock Level",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "stock_html",
            "title" => "Purchase item Stock",
            "width" => "17%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "underinspection_stock",
            "title" => "Under Inspection Qty",
            "width" => "7%",
            "className" => "dt-center"
        ];

        if($isSheetMetal == "Yes"){
	        $column[] = [
	            "data" => $sheet_prod_column_name,
	            "title" => "Production Stock",
	            "width" => "17%",
	            "className" => "dt-center",
				
	        ];
        }

        if($isSheetMetal != "Yes"){
	        $column[] = [
	            "data" => "$plastic_prod_column_name",
	            "title" => "Machine Mold Stock",
	            "width" => "7%",
	            "className" => "dt-center",
	        ];
	        $column[] = [
	            "data" => "deflashing_stock",
	            "title" => "Deflashing Location",
	            "width" => "7%",
	            "className" => "dt-center",
				'orderable' => false
	        ];
	    }

		$column[] = [
            "data" => "transfer_fg",
            "title" => "Transfer To FG",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];

        if($isSheetMetal == "Yes"){
	        $column[] = [
	            "data" => "$sharingQtyColName",
	            "title" => "Shearing Stock",
	            "width" => "7%",
	            "className" => "dt-center",
	            'orderable' => false
	        ];
	    }


        $column[] = [
            "data" => "sub_con_stock",
            "title" => "Subcon Stock",
            "width" => "7%",
            "className" => "dt-center",
        ];

        $column[] = [
            "data" => "scrap_stock",
            "title" => "GRN Rejection Stock",
            "width" => "7%",
            "className" => "dt-center"
        ];

        $column[] = [
            "data" => "store_rack_location",
            "title" => "Store Rack Location",
            "width" => "7%",
            "className" => "dt-center"
        ];	


        $column[] = [
            "data" => "store_stock_rate",
            "title" => "Store Stock Rate",
            "width" => "7%",
            "className" => "dt-center",
        ];

        $column[] = [
            "data" => "stock_value",
            "title" => "Store Stock Value",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
			
        ];








        
   //      $column[] = [
   //          "data" => "onhold_stock",
   //          "title" => "Stock Reserve against Job order",
   //          "width" => "7%",
   //          "className" => "dt-center status-row",
			// 'orderable' => false
   //      ];
        $column[] = [
            "data" => "store_scrap",
            "title" => "Production Rejection Stock",
            "width" => "17%",
            "className" => "dt-center",
			
        ];
       
        $column[] = [
            "data" => "rejection_stock_val",
            "title" => "Store Rejection Stock",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "rejection_prodcution_qty",
            "title" => "Production Stock",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        		

		// pr($plastic_prod_column_name,1);			

        $column[] = [
            "data" => "plastic_prod_details",
            "title" => "Production Scrap",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "production_rejection",
            "title" => "Production Rejection",
            "width" => "7%",
            "className" => "dt-center",
			'orderable' => false
        ];
        
        
        
        
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["sheet_prod_column_name"] = $sheet_prod_column_name;
        $data["stock_column_name"] = $stock_column_name;
        $data["plastic_prod_column_name"] = $plastic_prod_column_name;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        
       

		// pr($this->db->last_query(),1);
		
		
		
		$data['customer_part_data_new_updated'] = $this->Crud->customQuery('SELECT DISTINCT part_number, id FROM `customer_parts_master` ');
		
		$data['supplier_part_select_list']  = $data['child_part_list'];
		

		
		$this->loadView('store/part_stocks', $data);
	}

	public function getPartStockReportData(){
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
		
		$data = $this->SupplierParts->getPartStockReportView($condition_arr,$post_data["search"]);
		$stock_column_name = $this->Unit->getStockColNmForClientUnit();
		$sheet_prod_column_name = $this->Unit->getProdColNmForClientUnit();
		$plastic_prod_column_name = $this->Unit->getPlasticProdColNmForClientUnit();
		$sharingQtyColName = $this->Unit->getSharingQtyColNmForClientUnit();
		$role = $this->session->userdata('type');
		// pr($data,1);
		foreach ($data as $key => $value) {
			// pr($value,1);
			// $edit_data = base64_encode(json_encode($value)); 
			// $data[$key]['action'] = "<i class='ti ti-edit edit-part' title='Edit' data-value='$edit_data'></i>";
			$stock_val = $value['stock'] * $value['store_stock_rate'];
			$transfer_fg = $value[$stock_column_name];
			$production_stocks = $value[$sheet_prod_column_name];
			$plastic_prod_details = $value[$plastic_prod_column_name];
			// pr($plastic_prod_details,1);
			// if($value['stock'] > 0){
				$stock_temp = base64_encode(json_encode($value)); 
				if(checkGroupAccess("part_stocks","update","No") && $value['stock'] > 0){
					$stock_temp_html = '<button type="button" class="btn btn-primary edit-fg" data-bs-toggle="modal"  data-value='.$stock_temp.' data-bs-target="#storeToStore">
											'.$value['stock'].'
											</button>';
				}else{
					$stock_temp_html = $value['stock'];
				}
			// }else{
			// 	$stock_temp_html = 0;
			// }
			// if($value[$stock_column_name] > 0 && ($role == "Admin" || $role=="stores")){
				$fg_data = base64_encode(json_encode($value)); 
				if(checkGroupAccess("part_stocks","update","No")){
					$transfer_fg = '<button type="button" class="btn btn-primary fg_data_edit" data-bs-toggle="modal"  data-value='.$fg_data.' data-bs-target="#fgtransfer">
											Transfer To FG
											</button>';
				}else{
					$transfer_fg = display_no_character();
				}
			// }else{
			// 	$transfer_fg = display_no_character();
			// }
			// if($value[$sheet_prod_column_name] > 0 && ($role == "Admin")){
				$product__data = base64_encode(json_encode($value)); 
				if(checkGroupAccess("part_stocks","update","No")){
					$production_stocks = '<button type="button" class="btn btn-primary product-store" data-bs-toggle="modal" data-bs-target="#prodToStore" data-value='.$product__data.'>
										  '.$value[$sheet_prod_column_name].'
										  </button>';
				}else{
					$production_stocks = $value[$sheet_prod_column_name];
				}
			// }
			// if($value[$plastic_prod_column_name] > 0 && ($role == "Admin")){
				$plastic_prod_column_name_data = base64_encode(json_encode($value)); 
				if(checkGroupAccess("part_stocks","update","No")){
					$plastic_prod_details = '<button type="button" class="btn btn-primary product-store-plas" data-bs-toggle="modal" data-bs-target="#prodToStorePlastic" data-value='.$plastic_prod_column_name_data.'>
										'.$value[$plastic_prod_column_name].'
										</button>';
				}else{
					$plastic_prod_details = $value[$plastic_prod_column_name];
				}
			// }
			$data[$key][$sheet_prod_column_name] = $production_stocks;
			$data[$key]['stock_html'] = $stock_temp_html;
			$data[$key]['transfer_fg'] = $transfer_fg;
			$data[$key]['stock_value'] = number_format($stock_val,2,".","");
			$data[$key][$plastic_prod_column_name] = $plastic_prod_details;
			$data[$key]['plastic_prod_details'] = $value['production_rejection'];
			
		}
		// pr($data,1);
		$data["data"] = $data;
        $total_record = $this->SupplierParts->getPartStockReportViewCount($condition_arr, $post_data["search"]);
		
        $data["recordsTotal"] = count($total_record);
        $data["recordsFiltered"] = count($total_record);
        echo json_encode($data);
	}

	/**
	 * FG Stock transfer
	 */
	public function transfer_child_part_to_fg_stock()	{
		$customer_part_number  = $this->input->post('customer_part_number');
		
		$child_part_id  = $this->input->post('child_part_id');
		$stock  = (float)$this->input->post('stock');

		$child_part = $this->SupplierParts->getSupplierPartById($child_part_id);
		$customer_part_data = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_number);
		$customer_part_id = $customer_part_data[0]->part_id;
		$FGStockColName = $this->Unit->getFGStockColNmForClientUnit();
		$old_fg_stock = (float)$customer_part_data[0]->$FGStockColName;
		$new_stock_customer_part = $old_fg_stock + $stock;

		$stockColName = $this->Unit->getStockColNmForClientUnit();
		$old_stock = (float)$child_part[0]->$stockColName;
		$new_stock = $old_stock - $stock;
		
		$data_update_child_part = array(
			$stockColName => $new_stock,
		);


		$data_update_new_stock_customer_part = array(
			$FGStockColName => $new_stock_customer_part
		);

		$query = $this->SupplierParts->updateStockById($data_update_child_part, $child_part[0]->id);
		$customerPartDetails = $this->CustomerPart->getCustomerPartOnlyById($customer_part_id);
		$query = $this->CustomerPart->updateStockById($data_update_new_stock_customer_part, $customerPartDetails[0]->id);
		$success = 0;
        $messages = "Something went wrong.";
		if ($query) {
			$this->Crud->stock_report($child_part[0]->part_number, $customer_part_number, "child_part", "customer_parts_master", $old_stock, $stock);
			$messages = "Stock transferred successfully.";
			$success = 1;
			// $this->addSuccessMessage('Stock transferred successfully.');
		} else {
			$messages = "Unable to transfer to FG stock";
			// $this->addErrorMessage('Unable to transfer to FG stock');
		}
		// $this->_part_stocks($child_part_id, null);
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();

	}

	/**
	 * Transfer Store to Store
	 */

	public function transfer_child_store_to_store_stock()
	{
		$child_part_to  = $this->input->post('customer_part_number');//transferred to location
		$child_part_id  = $this->input->post('child_part_id');
		$stock  = (float)$this->input->post('stock');

		$stock_column_name = $this->Crud->getStockColNmForClientUnit();
		
		$child_part = $this->SupplierParts->getSupplierPartById($child_part_id);
		$old_stock = (float)$child_part[0]->$stock_column_name;
		$new_stock = $old_stock - $stock;

		$part_to_data = $this->SupplierParts->getSupplierPartById($child_part_to);
		$new_stock_part_to_data =(float)$part_to_data[0]->$stock_column_name + $stock;

		$data_update_child_part = array(
			$stock_column_name => $new_stock
		);
		$data_update_child_part_to = array(
			$stock_column_name => $new_stock_part_to_data
		);

		// pr($data_update_child_part_to,1);
		$query = $this->SupplierParts->updateStockById($data_update_child_part, $child_part_id);
		$query = $this->SupplierParts->updateStockById($data_update_child_part_to, $child_part_to);
		$success = 0;
        $messages = "Something went wrong.";
		if ($query) {
			$this->Crud->stock_report($child_part[0]->part_number, $part_to_data[0]->part_number, "child_part", "child_part", $old_stock, $stock);
			$success = 1;
			$messages = "Stock transferred successfully.";
			// $this->addSuccessMessage('Stock transferred successfully.';);
		} else {
			$messages = "Unable to transfer store stock.";
			// $this->addErrorMessage('Unable to transfer store stock.');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		// $this->_part_stocks($child_part_id, null);
	}


	/**
	 * Plastic Production to Store
	 */
	public function update_production_qty_child_part()
	{
		$child_part_id  = $this->input->post('child_part_id');
		$part_number  = $this->input->post('part_number');
		$machine_mold_issue_stock  = (float)$this->input->post('machine_mold_issue_stock');

		$child_part = $this->SupplierParts->getSupplierPartById($child_part_id);
		
		$stockColName = $this->Unit->getStockColNmForClientUnit();
		$prodColName = $this->Unit->getPlasticProdColNmForClientUnit();

		$old_stock = (float)$child_part[0]->$stockColName;
		$new_stock = $old_stock + $machine_mold_issue_stock;

		$old_machine_mold_issue_stock = (float)$child_part[0]->$prodColName;		
		$new_machine_mold_issue_stock = (float)$old_machine_mold_issue_stock - (float)$machine_mold_issue_stock;

		$data_update_child_part = array(
			$stockColName => $new_stock,
			$prodColName => $new_machine_mold_issue_stock
		);
		$query = $this->SupplierParts->updateStockById($data_update_child_part, $child_part[0]->id);
		$success = 0;
        $messages = "Something went wrong.";
		if ($query) {
			$this->Crud->stock_report($child_part[0]->part_number, $child_part[0]->part_number, "machine_mold_issue_stock", "store_stock", $old_stock, $production_qty);
			// $this->addSuccessMessage('Stock transferred successfully.');
			$messages = "Stock transferred successfully.";
			$success =1;
		} else {
			$messages = "Unable to transfer the Production stock to Store stock";
			// $this->addErrorMessage('Unable to transfer the Production stock to Store stock');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


	public function transfer_child_part_to_fg_stock_inhouse()
	{

		$customer_part_number  = strval($this->input->post('customer_part_number'));
		$child_part_id  = $this->input->post('child_part_id');
		$part_number  = $this->input->post('part_number');
		$stock  = (float)$this->input->post('stock');
		$child_part = $this->InhouseParts->getInhousePartById($child_part_id);
		$customer_part_data = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_number);
		// pr($customer_part_data,1);
		$customer_part_id = 
		$prodQtyColName = $this->Unit->getProdColNmForClientUnit();
		$fgStockColName = $this->Unit->getFGStockColNmForClientUnit();

		$customer_part_data_old_fg_stock = (float)$customer_part_data[0]->$fgStockColName;
		$old_stock = (float)$child_part[0]->$prodQtyColName;
		$new_stock = $old_stock - $stock;
		$new_stock_customer_part = $customer_part_data_old_fg_stock + $stock;
		$data_update_child_part = array(
			$prodQtyColName => $new_stock,
		);
		$data_update_new_stock_customer_partt = array(
			$fgStockColName => $new_stock_customer_part
		);

		$query = $this->InhouseParts->updateStockById($data_update_child_part, $child_part[0]->id);
		$customerPartDetails = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_number);
		$query2 = $this->CustomerPart->updateStockById($data_update_new_stock_customer_partt, $customerPartDetails[0]->id);
		$success = 0;
        $messages = "Something went wrong.";
		if ($query) {
			$this->Crud->stock_report($child_part[0]->part_number, $customer_part_number, "production_qty", "fg_stock", $old_stock, $stock);
			$messages = "Stock transferred successfully.";
			$success = 1;
			// $this->addSuccessMessage('Stock transferred successfully.');
		} else {
			$messages = "Unable to transfer to stock";
			// $this->addErrorMessage('Unable to transfer to stock');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function sharing_issue_request_pending()
	{
		checkGroupAccess("sharing_issue_request_store","list","Yes");
		$unit_id = $this->Unit->getSessionClientId();
		$unit_where = "";
		$stock_unit_where = "";
		if($unit_id > 0){
			$unit_where = " and s.clientId = ".$unit_id;
			$stock_unit_where = "AND stock.clientId = " . $unit_id;
		}
		$data['sharing_issue_request'] = $this->Crud->customQuery("
			SELECT s.* ,cp.part_number as part_number,cp.part_description as part_description,stock.stock as stock,cp.thickness as thickness,cp.weight as weight,cp.sharing_qty as sharing_qty
			FROM sharing_issue_request  s
			LEFT JOIN child_part cp ON cp.id = s.child_part_id
			LEFT JOIN child_part_stock stock ON cp.id = stock.childPartId  ".$stock_unit_where."
			WHERE s.status = 'pending'  ".$unit_where."
			ORDER BY s.id DESC;"
		);
 		$data['child_part'] = $this->SupplierParts->readSupplierPartsOnly();
 		$date_filter = date("01/m/Y") ." - ". date("d/m/Y");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];

		$this->loadView('store/sharing_issue_request_store', $data);
	}

	public function sharing_issue_request_store_completed()
	{
		checkGroupAccess("sharing_issue_request_store_completed","list","Yes");
		$unit_id = $this->Unit->getSessionClientId();
		$unit_where = "";
		$stock_unit_where = "";
		if($unit_id > 0){
			$unit_where = " and s.clientId = ".$unit_id;
			$stock_unit_where = "AND stock.clientId = " . $unit_id;
		}
		//$data['operations_bom'] = $this->Crud->read_data("operations_bom");
		$data['sharing_issue_request'] = $this->Crud->customQuery("
			SELECT s.* ,cp.part_number as part_number,cp.part_description as part_description,stock.stock as stock,cp.thickness as thickness,cp.weight as weight,cp.sharing_qty as sharing_qty
			FROM sharing_issue_request  s
			LEFT JOIN child_part cp ON cp.id = s.child_part_id
			LEFT JOIN child_part_stock stock ON cp.id = stock.childPartId ".$stock_unit_where."
			WHERE s.status = 'completed'  ".$unit_where."
			ORDER BY s.id DESC;"
		);
		$date_filter = date("01/m/Y") ." - ". date("d/m/Y");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];

		//$data['child_part'] = $this->SupplierParts->readSupplierPartsOnly();
		$this->loadView('store/sharing_issue_request_store_completed', $data);
	}
}
