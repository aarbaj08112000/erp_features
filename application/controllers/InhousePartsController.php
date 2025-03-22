<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');

class InhousePartsController extends CommonController
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


	public function inhouse_parts_view() {
		checkGroupAccess("inhouse_parts_view","list","Yes");
		$data['uom'] = $this->Crud->read_data("uom");
		// $data['child_part_master'] = $this->Crud->customQuery("SELECT parts.*, stock.*, u.uom_name 
		// 	FROM `inhouse_parts` parts
		// 	LEFT JOIN inhouse_parts_stock stock
		// 		ON stock.inhouse_parts_id = parts.id 
  //   			AND stock.clientId = ".$this->Unit->getSessionClientId()." 
		// 	INNER JOIN uom u
		// 		ON u.id = parts.uom_id
		// 		ORDER BY parts.id desc LIMIT 20");

		 $column[] = [
            "data" => "id",
            "title" => "Id",
            "width" => "7%",
            "className" => "dt-center",
            "visible"=> false,
        ];
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
            "data" => "safty_buffer_stk",
            "title" => "Safety/buffer Stock",
            "width" => "10%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "hsn_code",
            "title" => "HSN Code",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "store_rack_location",
            "title" => "Store Rack Location",
            "width" => "17%",
            "className" => "dt-center",
			'orderable' => false
        ];
        $column[] = [
            "data" => "uom_name",
            "title" => "UOM",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "max_uom",
            "title" => "Max PO QTY ",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "store_stock_rate",
            "title" => "Stock Rate",
            "width" => "17%",
            "className" => "dt-center",

        ];
        $column[] = [
            "data" => "weight",
            "title" => "Weight",
            "width" => "17%",
            "className" => "dt-center",

        ];
        $column[] = [
            "data" => "size",
            "title" => "Size",
            "width" => "17%",
            "className" => "dt-center",

        ];
        $column[] = [
            "data" => "thickness",
            "title" => "Thickness",
            "width" => "17%",
            "className" => "dt-center",

        ];

        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "7%",
            "className" => "dt-center",
        ];
       

		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;

		$data['title'] = "PO Summary Report";

		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
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
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
		$this->loadView('sales/inhouse_parts_view', $data);
	}
	public function get_inhouse_parts_view_data(){
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

		$data = $this->InhouseParts->get_inhouse_parts_view_data($condition_arr,$post_data["search"]);
		// pr($data,1);


		foreach ($data as $key => $value) {
			$part_edit_data =  base64_encode(json_encode($value));
			$data[$key]['action'] = display_no_character("");
			if(checkGroupAccess("inhouse_parts_view","update","No")){
				$data[$key]['action'] = "<i class='ti ti-edit edit-parts-data' data-parts='".$part_edit_data."'></i>";
			}
		}
		$data["data"] = $data;
        $total_record = $this->InhouseParts->get_inhouse_parts_view_data_Count([], $post_data["search"]);

        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
	}

	public function add_inhouse_parts()
	{
		//$add_to_child_part = $this->input->post('add_to_child_part');
		$part_number = $this->input->post('part_number');
		$part_desc = $this->input->post('part_desc');
		//$part_rate = $this->input->post('part_rate');
		$safty_buffer_stk = $this->input->post('safty_buffer_stk');
		//$revision_date = $this->input->post('revision_date');
		//$revision_no = $this->input->post('revision_no');
		//$supplier_id = $this->input->post('supplier_id');
		$uom_id = $this->input->post('uom_id');
		//$child_part_id = $this->input->post('child_part_id');
		$hsn_code = $this->input->post('hsn_code');
		$store_rack_location = $this->input->post('store_rack_location');
		$store_stock_rate = $this->input->post('store_stock_rate');
		//$revision_remark = $this->input->post('revision_remark');
		//$gst_id = $this->input->post('gst_id');
		//$sub_type = $this->input->post('sub_type');
		//$asset = $this->input->post('asset');
		$max_uom = $this->input->post('max_uom');
		$min_uom = $this->input->post('min_uom');
		$weight = $this->input->post('weight');
		$size = $this->input->post('size');
		$thickness = $this->input->post('thickness');
		
		$data = array(
			"part_number" => $part_number
		);
		
		$check = $this->InhouseParts->isRecordExists($data);
		$success = 0;
        $messages = "Something went wrong.";
		if ($check != 0) {
			$success = "Already Exists";
			// echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {

			$data = array(
				"part_number" => $part_number,
				"part_description" => $part_desc,
				"uom_id" => $uom_id,
				"safty_buffer_stk" => $safty_buffer_stk,
				"hsn_code" => $hsn_code,
				"store_rack_location" => $store_rack_location,
				"store_stock_rate" => $store_stock_rate,
				"modal_document" => '',
				"weight" => $weight,
				"size" => $size,
				"thickness" => $thickness,
				"created_id" => $this->user_id,
				"date" => $this->Crud->getSQLDateFormatToStore(),
				"time" => $this->current_time,
				"max_uom" => $max_uom,
				"min_uom" => $min_uom,

			);
					
			$result = $this->InhouseParts->createInhousePart($data);
			
			if ($result) {
				$success = 1;
				$messages = "Record added successfully.";
				// $this->addSuccessMessage('Record added successfully.');
			} else {
				$messages = "Unable to add record.";
				// $this->addErrorMessage('Unable to add record.');
			}
			// $this->redirectMessage();
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


	public function update_child_part_view_inhouse()
	{

		$id = $this->input->post('part_id');
		$part_number = $this->input->post('part_number');
		$part_description = $this->input->post('part_description');
		$hsn_code = $this->input->post('hsn_code');
		$sub_type = $this->input->post('sub_type');
		$store_rack_location = $this->input->post('store_rack_location');
		$max_uom = $this->input->post('max_uom');
		$store_stock_rate = $this->input->post('store_stock_rate');
		$weight = $this->input->post('weight');
		$size = $this->input->post('size');
		$thickness = $this->input->post('thickness');

		$safty_buffer_stk = $this->input->post('saft_stk');
		$success = 0;
        $messages = "Something went wrong.";
		$data = array(
				"part_description" => $part_description,
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
			);

		
			$result = $this->InhouseParts->updatePartById($data, $id);
			if($result) {
				$stockData = array(
					"safty_buffer_stk" => $safty_buffer_stk
				);
				$resultStock = $this->InhouseParts->updateStockById($stockData, $id);
				if ($resultStock) {
					$messages = "Record updated successfully";
					$success = 1;
					// $this->addSuccessMessage('Record updated successfully');
				}else{ 
					$messages = "Unable to update safty buffer stock record. Please try again.";
					// $this->addErrorMessage('Unable to update safty buffer stock record. Please try again.');
				}
			} else {
				$messages = "Unable to update record. Please try again.";
				// $this->addErrorMessage('Unable to update record. Please try again.');
			}		
			

		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


	/**
	 * Used for inhouse as well as child parts
	 */
	public function update_uom_report()
	{

		$id = $this->input->post('id');
		$uom_id = $this->input->post('uom_id');
		$table_id = $this->input->post('table_id');

		$data = array(
			"uom_id" => $uom_id
		);

		if (empty($table_id)) {
			$query = $this->SupplierParts->updatePartById($data, $id);
		} else {
			$query = $this->InhouseParts->updatePartById($data, $id);
		}

		if ($query) {
			$this->addSuccessMessage('Record updated successfully');

		} else {
			$this->addErrorMessage('Unable to update record. Please try again.');
		}

		$this->redirectMessage();
	}


	/**
	 *  Update inhouse part stock - Approval
	 */
	public function inhouse_parts_admin($part_id_selected = null)
	{
		checkGroupAccess("inhouse_parts_admin","list","Yes");
		$data['child_parts_list_distinct'] = $this->Crud->customQuery('SELECT DISTINCT part_number,part_description,id FROM `inhouse_parts` ');
		
		if(empty($part_id_selected)){
			$part_id_selected = $this->input->post("part_id_selected");
		}	

		$data['child_part'] = $this->InhouseParts->getInhousePartById($part_id_selected);
		$data['enableStockUpdate'] = $this->isEnableStockUpdate();
		
		$this->loadView('admin/inhouse_parts_admin', $data);
	}


	/**
	 *  Update inhouse part stock - Actual update
	 */
	public function update_inhsoue_stock()
	{
		$id = $this->input->post('id');
		$stock = $this->input->post('stock');
			
		$data = array(
				"production_qty" => $stock,
		);
		
		$ret_arr = [];
		$success = 1;
		$msg = '';
		$result = $this->InhouseParts->updateStockById($data, $id);
		if ($result) {
			// $this->addSuccessMessage('Record updated successfully');
			$msg = 'Record updated successfully';

		} else {
			// $this->addErrorMessage('Unable to update record. Please try again.');
			$msg = 'Unable to update record. Please try again.';
		}
		// $this->inhouse_parts_admin($id);
		$ret_arr['success'] = $success;
		$ret_arr['messages'] = $msg;
		echo json_encode($ret_arr);
	}


	 public function part_stocks_inhouse()
	{

		$this->_part_stocks_inhouse('');
	}

	
	public function view_part_stocks_inhouse()
	{

		$this->_part_stocks_inhouse($this->input->post('part_id'));
	}

	public function _part_stocks_inhouse($filter_part_id)
	{
		checkGroupAccess("part_stocks_inhouse","list","Yes");
		$data['filter_part_id'] = $filter_part_id;
		$data['customer_part_list'] = $this->InhouseParts->getUniquePartNumber();
		// if(!empty($filter_part_id)){
		// 
			$data['filtered_cust_part'] = $this->InhouseParts->getInhousePartDetails($filter_part_id);
			foreach ($data['filtered_cust_part'] as $key => $po) {
				$stock = 0;
                $stockColName = $this->Unit->getStockColNmForClientUnit();
                $prodQtyColName = $this->Unit->getProdColNmForClientUnit();
                $stock = $stock + $po->$stockColName;
                $uom_data = $this->Crud->get_data_by_id("uom", $po->uom_id, "id");
                $grn_details_data = $this->Crud->get_data_by_id("grn_details", $po->id, "part_id");
                $store_stock = 0;
                $underinspection_stock = 0;
                $scrap_stock = 0;
                if ($grn_details_data) {
                	foreach ($grn_details_data as $d) {
                    	$scrap_stock = $scrap_stock + $d->reject_qty;
                        if ($d->accept_qty == 0) {
                        	$underinspection_stock = $underinspection_stock + $d->verified_qty;
                        } else {
                        }
                    }
                }

                $child_part_data = $this->Crud->get_data_by_id("child_part", $po->part_number, "part_number");
                if (!empty($child_part_data)) {
                	$child_part_present = "yes";
                } else {
                	$child_part_present = "no";
                }
                $data['filtered_cust_part'][$key]->stock = $stock;
                $data['filtered_cust_part'][$key]->prodQtyColName = $prodQtyColName;
                $data['filtered_cust_part'][$key]->uom_data = $uom_data; 
                $data['filtered_cust_part'][$key]->underinspection_stock = $underinspection_stock; 	
                $data['filtered_cust_part'][$key]->scrap_stock = $scrap_stock;
                $data['filtered_cust_part'][$key]->child_part_present = $child_part_present; 		
			}

			// pr($data['filtered_cust_part'],1);
		// }
		$data['transfer_part_list'] = $this->Crud->customQuery('
			SELECT DISTINCT customer_part.part_number, customer.customer_name 
			FROM customer_part
			INNER JOIN customer ON customer_part.customer_id = customer.id;
		');

		$this->loadView('store/part_stocks_inhouse', $data);
	}

}
