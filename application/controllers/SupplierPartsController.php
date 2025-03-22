<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');

class SupplierPartsController extends CommonController
{

	const PATH = "";

	function __construct()
	{
		parent::__construct();
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


	public function addchildpart()
	{
		$part_number = $this->input->post('part_number');
		$part_desc = $this->input->post('part_desc');
		$part_rate = $this->input->post('part_rate');
		$safty_buffer_stk = $this->input->post('safty_buffer_stk');
		$revision_date = $this->input->post('revision_date');
		$revision_no = $this->input->post('revision_no');
		$supplier_id = $this->input->post('supplier_id');
		$uom_id = $this->input->post('uom_id');
		$child_part_id = $this->input->post('child_part_id');
		$hsn_code = $this->input->post('hsn_code');
		$store_rack_location = $this->input->post('store_rack_location');
		$store_stock_rate = $this->input->post('store_stock_rate');
		$revision_remark = $this->input->post('revision_remark');
		$gst_id = $this->input->post('gst_id');
		$sub_type = $this->input->post('sub_type');
		$asset = $this->input->post('asset');
		$max_uom = $this->input->post('max_uom');
		$min_uom = $this->input->post('min_uom');
		$sub_category_type = $this->input->post('sub_category_type');

		$weight = $this->input->post('weight');
		$grade = $this->input->post('grade');
		$size = $this->input->post('size');
		$thickness = $this->input->post('thickness');

		if ($sub_type == "RM" && empty($weight)) {
			$success = 0;
			$messages = "Please add weight for RM parts";
		} else {
			$data = array(
				"part_number" => $part_number,
				"supplier_id" => $supplier_id,
			);
			$check = $this->SupplierParts->isRecordExists($data);
			if ($check != 0) {
				$success = 0;
				$messages = "Record already exists";
			} else {
				if (!empty($_FILES['part_drawing']['name'])) {
					$image_path = "./documents/";
					$config['allowed_types'] = '*';
					$config['upload_path'] = $image_path;
					$config['file_name'] = $_FILES['part_drawing']['name'];

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('part_drawing')) {
						$uploadData = $this->upload->data();
						$picture4 = $uploadData['file_name'];
					} else {
						$picture4 = '';
					}
				} else {
					$picture4 = '';
				}

				if (!empty($_FILES['modal']['name'])) {
					$image_path = "./documents/";
					$config['allowed_types'] = '*';
					$config['upload_path'] = $image_path;
					$config['file_name'] = $_FILES['modal']['name'];

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('modal')) {
						$uploadData = $this->upload->data();
						$picture5 = $uploadData['file_name'];
					} else {
						$picture5 = '';
					}
				} else {
					$picture5 = '';
				}

				if (!empty($_FILES['cad_file']['name'])) {
					$image_path = "./documents/";
					$config['allowed_types'] = '*';
					$config['upload_path'] = $image_path;
					$config['file_name'] = $_FILES['cad_file']['name'];

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('cad_file')) {
						$uploadData = $this->upload->data();
						$picture6 = $uploadData['file_name'];
					} else {
						$picture6 = '';
					}
				} else {
					$picture6 = '';
				}

				$data = array(
					"part_number" => $part_number,
					"part_description" => $part_desc,
					"supplier_id" => $supplier_id,
					"part_rate" => $part_rate,
					"uom_id" => $uom_id,
					"revision_no" => $revision_no,
					"child_part_id" => $child_part_id,
					"hsn_code" => $hsn_code,
					"store_rack_location" => $store_rack_location,
					"store_stock_rate" => $store_stock_rate,
					"safty_buffer_stk" => $safty_buffer_stk,
					"revision_remark" => $revision_remark,
					"part_drawing" => $picture4,
					"grade" => $grade,
					"modal_document" => $picture5,
					"cad_file" => $picture6,
					"gst_id" => $gst_id,
					"weight" => $weight,
					"size" => $size,
					"thickness" => $thickness,
					"revision_date" => $revision_date,
					"sub_type" => $sub_type,
					"max_uom" => $max_uom,
					"min_uom" => $min_uom,
					"created_id" => $this->user_id,
					"date" => $this->current_date,
					"time" => $this->current_time,
					"sub_category" => $sub_category_type
				);
				$result = $this->SupplierParts->createSupplierPart($data);
				if ($result) {
					$success = 1;
					$messages = "Record added successfully";
					$this->addSuccessMessage('Record updated successfully');
				} else {
					$success = 0;
					$messages = "Unable to add record. Please try again.";
				}
			}
		}

		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
	}


	public function child_part_view()
	{
		$this->_child_part_view('');
	}

	public function view_child_part_view_by_filter()
	{
		$this->_child_part_view($this->input->post('child_part_id'));
	}

	public function _child_part_view($filter_child_part_id)
	{
		checkGroupAccess("child_part_view","list","Yes");
		if (isset($filter_child_part_id)) {
			$data['filter_child_part_id'] = $filter_child_part_id;
		} else {
			$data['filter_child_part_id'] = '';
		}

			if ($filter_child_part_id !='ALL' && $filter_child_part_id != '') {
				$data['child_part_master'] = $this->SupplierParts->getSupplierPartById($filter_child_part_id);
			} else if ($filter_child_part_id == 'ALL' || $filter_child_part_id == '') {
				$data['child_part_master'] = $this->SupplierParts->readSupplierParts();
			}

		
		$data['supplier_part_list'] = $this->SupplierParts->readSupplierPartsOnly();
		$data['uom'] = $this->Crud->read_data("uom");
		$data['cparttypelist'] = $this->Crud->read_data("part_type");
		$data['supplier_list'] = $this->Crud->read_data("supplier");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$session_data = $this->session->userdata('entitlements');
		/* datatable */
		$column[] = [
            "data" => "part_id",
            "title" => "Part Id",
            "width" => "7%",
            "className" => "dt-center",
            "visible"=> false,
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "17%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "buffer_stock",
            "title" => "Safety/buffer <br>Stock",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "hsn_code",
            "title" => "HSN Code",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "sub_type",
            "title" => "Category",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "sub_category",
            "title" => "Sub Category",
            "width" => "12%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "store_rack_location",
            "title" => "Store Rack Location",
            "width" => "15%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "uom_name",
            "title" => "UOM",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "max_uom",
            "title" => "Max PO QTY",
            "width" => "80px",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "store_stock_rate",
            "title" => "Stock Rate",
            "width" => "17%",
            "className" => "dt-center",
        ];
        if($session_data['isSheetMetal'] == 1){
        $column[] = [
            "data" => "weight",
            "title" => "Weight",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "size",
            "title" => "Size",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "thickness",
            "title" => "Thickness",
            "width" => "7%",
            "className" => "dt-center",
        ];
        }
        $column[] = [
            "data" => "grade",
            "title" => "Grade",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "7%",
            "className" => "dt-center",
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
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[0, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        // $ajax_json['teacher_data'] = $this->session->userdata();
        // pr($ajax_json['designation'],1);
        $category_list = $this->db->query("SELECT * FROM `category` ");
		$data['category_list'] = $category_list->result();
		$this->getPage('purchase/child_part_view', $data,"Yes","Yes");
		// $this->getPage('purchase/test', $data,"NO","NO");
	}
	public function get_child_part_view()
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
		$data = $this->SupplierParts->get_child_part_view_data(
            $condition_arr,
            $post_data["search"]
        );

		foreach ($data as $key => $value) {
			$edit_data = base64_encode(json_encode($value));
			if(checkGroupAccess("child_part_view","update",false)){
				$data[$key]['action'] = "<i class='ti ti-edit edit-part' title='Edit' data-value='$edit_data'></i>";
			} 
			$data[$key]['action'] .= "<a href=".base_url('raw_material_inspection/').$value['part_id']."><i class='ti ti-eye ' title='View Inward Inspection' ></i></a>
			";
			$data[$key]['sub_category'] = display_no_character($value['sub_category']);
			
		}
		$data["data"] = $data;
        $total_record = $this->SupplierParts->get_child_part_view_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
		
	}

	public function update_child_part_view()
	{

		
		$id = $this->input->post('part_id');
		$data['child_part_id'] = $this->input->post('filter_child_part_id');
		$data['filter_child_part_id'] = $this->input->post('filter_child_part_id');

		$part_number = $this->input->post('part_number');
		$part_description = $this->input->post('part_description');
		// $part_specification = $this->input->post('part_specification');
		// $part_family = $this->input->post('part_family');
		$hsn_code = $this->input->post('hsn_code');
		$sub_type = $this->input->post('sub_type');
		$store_rack_location = $this->input->post('store_rack_location');
		$safty_buffer_stk = $this->input->post('safty_buffer_stk');
		$add_to_child_part = $this->input->post('add_to_child_part');

		// $uom_id = $this->input->post('uom_name');
		$max_uom = $this->input->post('max_uom');
		$store_stock_rate = $this->input->post('store_stock_rate');

		$weight = $this->input->post('weight');
		$size = $this->input->post('size');
		$thickness = $this->input->post('thickness');
		$table_id = $this->input->post('table_id');
		$grade = $this->input->post('grade');
		$safty_buffer_stk = $this->input->post('saft__stk');
		$sub_category_type = $this->input->post('sub_category_type');

			$data = array(
				"part_description" => $part_description,
				"uom_id" => $this->input->post('uom_id'),
				"safty_buffer_stk" => $safty_buffer_stk,
				"hsn_code" => $hsn_code,
				"store_rack_location" => $store_rack_location,
				"store_stock_rate" => $store_stock_rate,
				"revision_remark" => "1st",
				"weight" => $weight,
				"size" => $size,
				"thickness" => $thickness,
				"grade" => $grade,
				"sub_type" => $sub_type,
				"max_uom" => $max_uom,
				"min_uom" => $child_part_data[0]->min_uom,
				"sub_category" => $sub_category_type
			);
			
		$message = "";
		$success = 0;
			$result = $this->SupplierParts->updatePartById($data , $id);
			if ($result) {
				$stockData = array(
					"safty_buffer_stk" => $safty_buffer_stk,
				);
				$resultStock = $this->SupplierParts->updateStockById($stockData, $id);
				if ($resultStock) {
					$message = 'Record updated successfully';
					$success =1;
				} else {
					$message = 'Unable to update safty buffer stock record. Please try again.';
				}
			} else {
				$message = 'Unable to update record. Please try again.';
			}

		$return_arr = [];
		$return_arr['message'] = $message;
		$return_arr['success'] = $success;
		echo json_encode($return_arr);
		exit();


	}


	/**
	 * Update supplier stock page
	 */
	public function child_parts($part_id_selected = null)
	{

		// pr($this->session->userdata(),1);
		checkGroupAccess("child_parts","list","Yes");
		$data['part_select_list'] = $this->SupplierParts->readSupplierPartsOnly();
		if(empty($part_id_selected)){
			$part_id_selected = $this->input->post("part_id_selected");
		}

		$message= "";
		if($this->session->userdata("child_part_message") != ""){
			$message = $this->session->userdata("child_part_message");
			// pr($message,1);
			$this->session->set_userdata('child_part_message',"") ;
		}

		
		
		// if (!empty($part_id_selected)) {
		// 	$data['child_part'] = $this->SupplierParts->getSupplierPartById($part_id_selected);
		// } else {
			$data['child_part'] = $this->SupplierParts->getchildPart();
		// }
		$data['enableStockUpdate'] = $this->isEnableStockUpdate();
		$data['message'] = $message;
		
		$this->loadView('admin/child_parts', $data);
	}

	/**
	 * Update supplier stock
	 */
	public function update_child_stock()
	{
		$id = $this->input->post('id');
		$stock = $this->input->post('stock');
		$check = 0;
		
			$stockField = $this->Crud->getStockDBColumnName("stock");
			$data = array(
				$stockField => $stock
			);
			
			$result = $this->SupplierParts->updateStockById($data, $id);
			if ($result) {
				$message = 'Record updated successfully';
				// $this->addSuccessMessage('Record updated successfully');
			} else {
				$message = 'Unable to update record. Please try again.';
				// $this->addErrorMessage('Unable to update record. Please try again.');
			}
		$this->session->set_userdata('child_part_message',$message) ;
		// $this->child_parts($id);
		redirect('child_parts');
	}


	/**
	 * Material request
	 */
	public function stock_down()
	{
		checkGroupAccess("stock_down","list","Yes");
		$data['child_part'] = $this->SupplierParts->readSupplierParts();
		$data['supplier'] = $this->Crud->read_data("supplier");
		$data['rejection_flow'] = $this->Crud->read_data("rejection_flow");
		$clientId = $this->Unit->getSessionClientId();
		$data['stock_changes'] = $this->Crud->customQuery("SELECT sc.*,cp.part_number as part_number,cp.part_description as part_description,u.uom_name as uom_name
			FROM `stock_changes` sc
			LEFT JOIN child_part  cp ON cp.id = sc.part_id
			LEFT JOIN uom  u ON u.id = cp.uom_id
			WHERE sc.clientId = '".$clientId."'
			ORDER BY sc.id DESC"
		);
		foreach ($data['stock_changes'] as $key => $value) {
			$stock_data = $this->Crud->customQuery('
				SELECT
				    `stock`.stock
				FROM
				    `child_part` `parts`
				LEFT JOIN `child_part_stock` `stock` ON
				    `parts`.`id` = `stock`.`childPartId` AND `stock`.`clientId` = '.$this->Unit->getSessionClientId().'
				WHERE `parts`.`id` = '.$value->part_id.''													
			);
			$stock_data = $stock_data[0]->stock > 0 ? $stock_data[0]->stock : 0;
			$data['stock_changes'][$key]->stock = $stock_data;
		}
		$data['client_list'] = $this->Crud->read_data_acc("client");
		$data['clintUnitId'] = $this->Unit->getSessionClientId();
		$data['role'] = $this->session->userdata("role");
		$date_filter = date("01/m/Y") ." - ". date("d/m/Y");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
		$this->loadView('store/stock_down', $data);
	}

	/**
	 * Stock UP/Return
	 */
	public function stock_up()
	{
		checkGroupAccess("stock_up","list","Yes");
		// pr($this->db->last_query(),1);
		$data['child_part'] = $this->SupplierParts->readSupplierParts();
		$unit_id = $this->Unit->getSessionClientId();
		$data['stock_changes'] = $this->Crud->customQuery("
			SELECT s.*,cp.part_number as part_number,cp.part_description as part_description,stock.stock as stock,u.uom_name as uom_name
			FROM stock_changes s
			LEFT JOIN child_part cp ON cp.id = s.part_id
			LEFT JOIN child_part_stock stock ON cp.id = stock.childPartId AND stock.clientId = " . $unit_id. "
			LEFT JOIN uom u ON u.id = cp.uom_id
			WHERE s.clientId = ".$unit_id." AND s.type='addition' 
			ORDER BY s.id DESC");

		$inhouse_parts_list  = $this->Crud->customQuery("SELECT parts.*, stock.* 
            FROM  inhouse_parts parts
            LEFT JOIN inhouse_parts_stock stock
            ON parts.id = stock.inhouse_parts_id
            AND stock.clientId = " . $this->Unit->getSessionClientId() . "
            ORDER BY parts.id desc");
		$transformed_array = [];
		foreach ($inhouse_parts_list as $item) {
		    $transformed_array[$item->id] = $item;
		}
		$inhouse_parts_list = $transformed_array;

		$customer_parts_list = $this->CustomerPart->getCustomerPartdata();
		$transformed_array = [];
		foreach ($customer_parts_list as $item) {
		    $transformed_array[$item->id] = $item;
		}
		$customer_parts_list = $transformed_array;
		

		foreach ($data['stock_changes'] as $key => $value) {
			if($value->toStockType == "inhouse_qty"){
				$part_data = $inhouse_parts_list[$value->part_id] != null ? $inhouse_parts_list[$value->part_id] : [];
				$data['stock_changes'][$key]->part_number = $part_data->part_number;
				$data['stock_changes'][$key]->part_description = $part_data->part_description;
			}else if($value->toStockType == "customer_part"){
				$part_data = $customer_parts_list[$value->part_id] != null ? $customer_parts_list[$value->part_id] : [];
				$data['stock_changes'][$key]->part_number = $part_data->part_number;
				$data['stock_changes'][$key]->part_description = $part_data->part_description;
			}
			
		}
		$data['supplier'] = $this->Crud->read_data("supplier");
		$data['rejection_flow'] = $this->Crud->read_data("rejection_flow");
		$this->loadView('store/stock_up', $data);
	}


	public function delete_stock_up(){
		$post_data = $this->input->post();
		$stock_up_id = $post_data['stock_up_id'];
		$message = "Something went wrong";
		$success = 0;
		if($stock_up_id > 0){
			$data = array(
				"id" => $stock_up_id
			);
			$result = $this->Crud->delete_data("stock_changes", $data);
			if($result){
				$message = "Record deleted successfully.";
				$success = 1;
			}
		}
		$return_arr = [];
		$return_arr['messages'] = $message;
		$return_arr['success'] = $success;
		echo json_encode($return_arr);
		exit();
	}

	/**
	 * Stock UP/Return Parts
	 */
	public function stock_up_product_list()
	{
		$this->load->model('InhouseParts');
		$this->load->model('CustomerPart');
		$post_data = $this->input->post();	
		// pr($post_data,1);
		$part_arr = "<option value=''>Select Part Number / Description / Stock</option>";
		if($post_data['type'] == "production_qty"){
			$child_part = $this->SupplierParts->readSupplierParts();
			foreach ($child_part as $key => $value) {
				$part_arr .= "<option value='".$value->id."' data-qty='".$value->stock."'>".$value->part_number." / ".$value->part_description." / ".$value->stock."</option>";
			}
		}else if($post_data['type'] == "inhouse_qty"){
			$inhouse_parts_list = $this->Crud->customQuery("SELECT parts.*, stock.* 
            FROM  inhouse_parts parts
            LEFT JOIN inhouse_parts_stock stock
            ON parts.id = stock.inhouse_parts_id
            AND stock.clientId = " . $this->Unit->getSessionClientId() . " 
           $where
            ORDER BY parts.id desc");
			foreach ($inhouse_parts_list as $key => $value) {
				$part_arr .= "<option value='".$value->id."' data-qty='".$value->production_qty."'>".$value->part_number." / ".$value->part_description." / ".$value->production_qty."</option>";
			}
		}else if($post_data['type'] == "customer_part"){
			$customer_parts_list = $this->CustomerPart->getCustomerPartdata();
			foreach ($customer_parts_list as $key => $value) {
				$part_arr .= "<option value='".$value->id."' data-qty='".$value->fg_stock."'>".$value->part_number." / ".$value->part_description." / ".$value->fg_stock."</option>";
			}
		}

		$return_arr['part_arr'] = $part_arr;
		echo json_encode($return_arr);
		exit();
	}


	public function add_stock()
	{
		$stock_changes_id  = $this->uri->segment('2');
		$stock_changes_data = $this->Crud->get_data_by_id("stock_changes", $stock_changes_id, "id");
		$message = "Something went wrong";
		$success = 0;
		if($stock_changes_data[0]->toStockType == "production_qty"){
			$child_part_data = $this->SupplierParts->getSupplierPartById($stock_changes_data[0]->part_id);
			if ($child_part_data) {
				$qty = $stock_changes_data[0]->qty;
				$current_stock = $child_part_data[0]->stock;

				if (false && $qty > $current_stock) {
					$message =  "Entered Qty is greater than actual stock please try again";
				} else {
					if ($stock_changes_data[0]->type == "addition") {
						$new_stock = $qty;
					} else {
						$new_stock = $current_stock - $qty;
					}

					$data_update_child_part = array(
						"stock" => $new_stock,
					);
					$result2 = $this->SupplierParts->updateStockById($data_update_child_part, $stock_changes_data[0]->part_id);
					if ($result2) {
						$data_update_rejection_flow = array(
							"status" => "stock_transfered"
						);
						$result3 = $this->Crud->update_data("stock_changes", $data_update_rejection_flow, $stock_changes_id);
						if ($result3) {
							$success = 1;
							$message = "Stock updated successfully'";
						}
					}
				}
			} else {
				$message = "Item Part Id : " . $stock_changes_data[0]->part_id . " not found. Please try again ";
			}
		}else if($stock_changes_data[0]->toStockType == "inhouse_qty"){
			$id = $stock_changes_data[0]->part_id;
			$stock = $stock_changes_data[0]->qty;
			$result = $this->InhouseParts->getInhousePartDetails($id);
			$production_qty = $result[0]->production_qty > 0 ? $result[0]->production_qty : 0;
			$data = array(
				"production_qty" =>  $stock,
			);
			
			$ret_arr = [];
			$success = 1;
			$msg = '';
			$result = $this->InhouseParts->updateStockById($data, $id);
			if ($result) {
				$data_update_rejection_flow = array(
					"status" => "stock_transfered"
				);
				$success = 1;
				$this->Crud->update_data("stock_changes", $data_update_rejection_flow, $stock_changes_id);
				// $this->addSuccessMessage('Record updated successfully');
				$message = 'Stock updated successfully';

			} else {
				// $this->addErrorMessage('Unable to update record. Please try again.');
				$message = 'Unable to update record. Please try again.';
			}
		}else if($stock_changes_data[0]->toStockType == "customer_part"){
			$id = $stock_changes_data[0]->part_id;
			$stock = $stock_changes_data[0]->qty;
			$result = $this->CustomerPart->getCustomerPartById($id);
			$fg_stock = $result[0]->fg_stock > 0 ? $result[0]->fg_stock : 0;
			$data = array(
				"fg_stock" => $stock
			);
			$result = $this->CustomerPart->updateStockById($data, $id);
			if ($result) {
				$data_update_rejection_flow = array(
					"status" => "stock_transfered"
				);
				$this->Crud->update_data("stock_changes", $data_update_rejection_flow, $stock_changes_id);
				$message = "Stock updated successfully.";
				$success = 1;
				// $this->addSuccessMessage('Stock updated successfully.');
			} else {
				$message = "Unable to update stock. Please try again.";
				// $this->addErrorMessage('Unable to update stock. Please try again.');
			}
		}
		$return_arr = [];
		$return_arr['messages'] = $message;
		$return_arr['success'] = $success;
		echo json_encode($return_arr);
		exit();
	}

}
