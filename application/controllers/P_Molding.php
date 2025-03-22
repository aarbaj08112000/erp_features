<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');
require_once(APPPATH . 'libraries/PHPExcel/IOFactory.php');

class P_Molding extends CommonController
{

	const PLASTIC_MOLDING = "plastic/molding/";

	function __construct()
	{
		parent::__construct();
		$this->load->model('SupplierParts');
		$this->load->model('CustomerPart');
		$this->load->model('P_molding_model');
	}

	private function getPath()
	{
		return self::PLASTIC_MOLDING;
	}

	private function getPage($viewPage, $viewData)
	{
		$this->loadView($this->getPath() . $viewPage, $viewData);
	}

	public function grades()
	{
		checkGroupAccess("grades","list","Yes");
		$data['grades'] = $this->Common_admin_model->get_all_data("grades");
		$this->loadView('admin/molding/grades', $data);
	}

	public function add_grades()
	{
		$ret_arr = [];
		$success = 1;
		$msg = '';
		$customer_count = $this->Common_admin_model->get_data_by_id_count("grades", $this->input->post('name'), "name");
		if ($customer_count > 0) {
			$msg = 'Error : already Present!!!!';
			$success = 0;
			// echo "<script>alert('Error : already Present!!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$data = array(
				'name' => $this->input->post('name')
			);

			$insert = $this->Common_admin_model->insert('grades', $data);
			
			if ($insert) {
				// echo "<script>alert('Data Added  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				$msg = 'Grade added successfully.';
			} else {
				$msg = 'Error While operations  !!!!';
				$success = 0;
				// echo "<script>alert('Error While operations  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		
		echo json_encode($ret_arr);
	}

	public function get_filtered_clientUnit() {

		$clientFrom = $this->input->post("clientUnitFrom");
		$clientFrom_values = explode("/", $clientFrom);
		$client_id = $clientFrom_values[0];
		
		$other_units = $this->Crud->customQuery('SELECT DISTINCT id, client_unit FROM `client`');
		echo '<select>Transfer To Unit';
		echo '<option value="">Select</option>';
		if ($other_units) {		
			foreach ($other_units as $value) {
				if($value->id == $client_id) { //as unit is same so need to show production unit for same
					$optValue = "production_qty"."/".$value->id;
					echo '<option value='.$optValue.'>' . $value->client_unit."- Production".'</option>';
				}else{
					$stockOptValue = "stock"."/".$value->id;
					$prodOptValue = "production_qty"."/".$value->id;
					echo '<option value='.$stockOptValue.'>' . $value->client_unit."- Stock".'</option>';
					echo '<option value='.$prodOptValue.'>' . $value->client_unit."- Production".'</option>';
				}
			}
		}
		echo '</select>';
	}

	/**
	 * New Material Transfer Requests
	 */
	public function add_stock_up()
	{

		$name = $this->input->post('parttypeName');
		$type = $this->input->post('type');
		$reason = $this->input->post('reason');
		$qty = $this->input->post('qty');
		$part_id = $this->input->post('part_id');
		$toUnit = $this->input->post('clientUnitTo');
		$stock_up_type = $this->input->post('stock_up_type');
		$old_qty = $this->input->post('old_qty') > 0 ? $this->input->post('old_qty') : 0;

		$clientId = $this->Unit->getSessionClientId();
		$success = 0;
		$messages = "Something went wrong.";
		if (strpos($toUnit, "/") == true) {
			$clientTo_values = explode("/", $toUnit);
			$toStockType = $clientTo_values[0];
			$toUnit = $clientTo_values[1];
		}else{ 
			$toStockType = $toUnit;
			$toUnit = $clientId;
		}

		$toStockType = $stock_up_type;

		if(empty($toStockType)){
			$toStockType = "production_qty";
		}

		
		
		if (empty($type)) {
			$type = "addition";
		}
		if (empty($type)) {
			$type = "stock_rejection";
		}

		if (!empty($_FILES['uploading_document']['name'])) {
			$image_path = "./documents/";
			$config['allowed_types'] = '*';
			$config['upload_path'] = $image_path;
			$config['file_name'] = $_FILES['uploading_document']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('uploading_document')) {
				$uploadData = $this->upload->data();
				$picture4 = $uploadData['file_name'];
			} else {
				$picture4 = '';
				// echo "no 1";
			}
		} else {
			$picture4 = '';
			// echo "no 2";
		}
	
		$data_history = array(
			"clientId"=> $clientId,
			"part_id" => $part_id,
			"reason" => $reason,
			"uploading_document" => $picture4,
			"qty" => $qty,
			"old_qty" => $old_qty,
			"fromStockType" => "stock",
			"fromUnit" => $clientId,
			"toStockType" => $toStockType,
			"toUnit" => $toUnit,
			"type" => $type,
			"created_by" => $this->user_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
		);
		// pr($data_history,1);

		$result = $this->Crud->insert_data("stock_changes", $data_history);
		
		if ($result) {
			$messages = "Request created successfully.";
			$success = 1;
			// $this->addSuccessMessage('Request created successfully.');
		} else {
			$messages = "Failed to create new material request. Please try again.";
			// $this->addErrorMessage('Failed to create new material request. Please try again.');
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
		// $this->redirectMessage();	
	}

	public function remove_stock($id = 0)
	{

		$stock_changes_id  = $id;

		$stock_changes_data = $this->Crud->get_data_by_id("stock_changes", $stock_changes_id, "id");
		$stockFromCol = $stock_changes_data[0]->fromStockType;
		$stockFromUnit = $stock_changes_data[0]->fromUnit;
		
		$stockToCol = $stock_changes_data[0]->toStockType;
		$stockToUnit = $stock_changes_data[0]->toUnit;

		$success = 0;
		$messages = "Something went wrong.";
		//if transfer is within same unit
		if($stockFromUnit == $stockToUnit) {
			$child_part_from_unit = $this->SupplierParts->getSupplierPartById($stock_changes_data[0]->part_id, $stockFromUnit);
			$child_part_to_unit = $child_part_from_unit;
		}else {
			$child_part_from_unit = $this->SupplierParts->getSupplierPartById($stock_changes_data[0]->part_id, $stockFromUnit);
			$child_part_to_unit = $this->SupplierParts->getSupplierPartById($stock_changes_data[0]->part_id, $stockToUnit);
		}

		
		if ($child_part_from_unit && $child_part_to_unit) {
				$qty = $stock_changes_data[0]->accepted_qty;
				//$toProdCol_index = stripos($stockToCol, "production_qty");
				//if to column is not  having production it means we are transferring stocks to stock
					$current_stock_from_unit = $child_part_from_unit[0]->$stockFromCol;
					$current_stock_to_unit = $child_part_to_unit[0]->$stockToCol;

					if ($qty > $current_stock_from_unit) {
						// $this->addWarningMessage("Stock transfer request qty : ".$qty." is greater than actual stock : ".$current_stock_from_unit);
						$messages = "Stock transfer request qty : ".$qty." is greater than actual stock : ".$current_stock_from_unit;
						
					} else {
						if ($stock_changes_data[0]->type == "addition") {
							$new_stock_from = $current_stock_from_unit + $qty;
						} else {
							$new_stock_from = $current_stock_from_unit - $qty;
						}
						$new_stock_to = $current_stock_to_unit + $qty;
		
						$fromStockUpdate = array(
							$stockFromCol => $new_stock_from,
							"clientId"   => $child_part_from_unit[0]->clientId
						);

						$toStockUpdate = array(
							$stockToCol   => $new_stock_to,
							"clientId"   => $child_part_to_unit[0]->clientId
						);

					}

					$result2 = $this->SupplierParts->updateStockById($fromStockUpdate, $stock_changes_data[0]->part_id, $child_part_from_unit[0]->clientId);
					$result2 = $this->SupplierParts->updateStockById($toStockUpdate, $stock_changes_data[0]->part_id, $child_part_to_unit[0]->clientId);

					if ($result2) {
						$data_update_rejection_flow = array(
							"status" => "stock_transfered",
						);
						$result3 = $this->Crud->update_data("stock_changes", $data_update_rejection_flow, $stock_changes_id);
						if ($result3) {
							// $this->addSuccessMessage("Stock Transfered successfully.");
							$messages = "Stock Transfered successfully.";
							$success = 1; 
							
						}
				}
		} else {
			$messages = "Item part id : " . $stock_changes_data[0]->part_id . "Not Found in child_part table Please try again.";
			// $this->addErrorMessage("Item part id : " . $stock_changes_data[0]->part_id . "Not Found in child_part table Please try again.");
		}

		// $result = [];
		// $result['messages'] = $messages;
		// $result['success'] = $success;
		// echo json_encode($result);
		// exit();
	}

	public function accept_material_request_qty()
	{

		$post_data  = $this->input->post();
		$success = 0;
		$messages = "Something went wrong.";
		
		$id = $post_data['id_val']; 
		$accepted_qty = $post_data['accepted_qty'];
		if ($accepted_qty > 0 && $id > 0) {
			$data = array(
				'accepted_qty' => $accepted_qty,
				'status' => "accepted"
			);
			$update = $this->Crud->update_data("stock_changes", $data, $id);
			if($update){
				$this->remove_stock($id);
				$success = 1;
				$messages = "Material transfer request qty accepted successfully";
			}
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}
	public function delete_material_request()
	{

		$post_data  = $this->input->post();
		$success = 0;
		$messages = "Something went wrong.";
		
		$id = $post_data['id_val'];
		if ($id > 0) {
			$data = array(
				"id" => $id
			);
			$result = $this->Crud->delete_data("stock_changes", $data);
			if ($result) {
				$messages ="Material transfer request deleted successfully.";
				$success = 1;
			}
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}
	public function get_store_stock_material_request()
	{

		$post_data  = $this->input->post();
	
		$success = 0;
		$messages = "Something went wrong.";
		$id = $post_data['part_id'];
		$stock = 0;
		if ($id > 0) {
			$stock_data = $this->Crud->customQuery('
				SELECT
				    `stock`.stock
				FROM
				    `child_part` `parts`
				LEFT JOIN `child_part_stock` `stock` ON
				    `parts`.`id` = `stock`.`childPartId` AND `stock`.`clientId` = '.$this->Unit->getSessionClientId().'
				WHERE `parts`.`id` = '.$id.''													
			);
			$stock_data = $stock_data[0]->stock > 0 ? $stock_data[0]->stock : 0;
			$stock = $stock_data;
			$success = 1;
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		$result['stock'] = $stock;
		echo json_encode($result);
		exit();
	}
	
	public function p_q_molding_production()

	{
		checkGroupAccess("p_q_molding_production","list","Yes");
		$data['molding_production'] = $this->Crud->customQuery("SELECT mp.*,s.shift_type as shift_type,s.name as name,m.name as machine_name,op.name as operator_name,cp.part_number as part_number,cp.part_description as part_description,cp.production_target_per_shift as production_target_per_shift,mm.mold_name as mold_name
			FROM molding_production as mp
			LEFT JOIN shifts as s ON s.id = mp.shift_id 
			LEFT JOIN machine as m ON m.id = mp.machine_id
			LEFT JOIN operator as op ON op.id = mp.operator_id
			LEFT JOIN customer_part as cp ON cp.id = mp.customer_part_id
			LEFT JOIN mold_maintenance as mm ON mm.id = mp.mold_id
			WHERE mp.status = 'pending'
			AND mp.clientId = '".$this->Unit->getSessionClientId()	."' "
		);
		
		foreach ($data['molding_production'] as $key => $u) {
			$shifts_data = $this->Crud->get_data_by_id("shifts", $u->shift_id, "id");
			$machine_data = $this->Crud->get_data_by_id("machine", $u->machine_id, "id");
            $operator_data = $this->Crud->get_data_by_id("operator", $u->operator_id, "id");
            $customer_part_data = $this->Crud->get_data_by_id("customer_part", $u->customer_part_id, "id");
            $mold_master = $this->Crud->get_data_by_id("mold_maintenance", $u->mold_id, "id");
		}


		$data['shifts'] = $this->Crud->read_data("shifts");

		$data['operator'] = $this->Crud->read_data("operator");

		$data['machine'] = $this->Crud->read_data("machine");

		$data['mold_maintenance'] = $this->Crud->customQuery("SELECT m.*, p.part_number,p.part_description 

			FROM mold_maintenance m, customer_part p

			WHERE m.customer_part_id = p.id group by customer_part_id, mold_name order by id asc");

		$data['customer_part_new'] = $this->Crud->customQuery("SELECT p.id, p.part_number,p.part_description,c.customer_name 

			FROM customer_part p, customer c WHERE p.customer_id = c.id");

		//$data['downtime_master'] = $this->Crud->read_data("downtime_master");

		$data['reject_remark'] = $this->Crud->read_data("reject_remark");


		$data['start_date'] = date("Y/m/01");
		$data['end_date'] = date("Y/m/d");
		$this->loadView('admin/molding/p_q_molding_production', $data);

	}

	public function view_p_q_molding_production()
	{
		checkGroupAccess("view_p_q_molding_production","list","Yes");
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$created_month = $this->input->post('created_month');
		$created_year = $this->input->post('created_year');

		if (empty($created_month)) {
			$created_month = $this->month;
		}

		if (empty($created_year)) {
			$created_year = $this->year;
		}
		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;
		$month_arr = [];
		$data['month_arr'] = $month_arr;
       	$data['start_date'] = date("Y/m/01");
		$data['end_date'] = date("Y/m/d");
		$start_date = date("Y-m-01");
		$end_date = date("Y-m-d");
		
		$data['molding_production'] = $this->view_p_q_molding_production_data($start_date,$end_date);
		// AND  STR_TO_DATE(mp.created_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$start_date."', '%d-%m-%Y') AND STR_TO_DATE('".$end_date."', '%d-%m-%Y')
			// AND mp.month = ". $created_month . " AND mp.year = " . $created_year
		for ($i = 1; $i <= 12; $i++) {
			$month_data = $this->Common_admin_model->get_month($i);
            $month_number = $this->Common_admin_model->get_month_number($month_data);
            array_push($month_arr,['month_data'=>$month_data,'month_number'=>$month_number]);
        }
        
       	
		$this->loadView('admin/molding/view_p_q_molding_production', $data);
	}
	public function filter_p_q_molding_production_data(){
		$post_data = $this->input->post();
		$date_range = explode(" - ", $post_data['date_filter_val']);
		$start_date = str_replace("/","-",trim($date_range[0]));
		$end_date = str_replace("/","-",trim($date_range[1]));
		$data['molding_production'] = $this->view_p_q_molding_production_data($start_date,$end_date);
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$html = $this->smarty->fetch("molding/molding_production_view.tpl",$data);
		$return['html'] = $html;
		echo json_encode($return);
		exit();
	}

	public function view_p_q_molding_production_data($start_date = "",$end_date = ""){
		$data = $this->Crud->customQuery("
			SELECT mp.*,s.name as name,s.name as name,s.ppt as ppt,s.shift_type as shift_type,m.name as machine_name,op.name as operator_name,cp.production_target_per_shift as production_target_per_shift,cp.part_number as part_number,cp.part_description as part_description
			from molding_production as mp
			LEFT JOIN shifts as s ON s.id = mp.shift_id
			LEFT JOIN machine as m ON m.id = mp.machine_id
			LEFT JOIN operator as op ON op.id = mp.operator_id
			LEFT JOIN customer_part as cp ON cp.id = mp.customer_part_id
			WHERE mp.clientId  = ".$this->Unit->getSessionClientId()." 
			AND mp.status = 'completed' AND STR_TO_DATE(mp.created_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$start_date', '%Y-%m-%d') AND STR_TO_DATE('$end_date', '%Y-%m-%d')");
		return $data;
	}



	public function add_production_qty_molding_production()
	{
		$customer_part_id = $this->input->post('customer_part_id');
		$shift_id = $this->input->post('shift_id');
		$machine_id = $this->input->post('machine_id');
		$operator_id = $this->input->post('operator_id');
		$date = $this->input->post('date');
		$qty = (float)$this->input->post('qty');
		$qty = $qty;
		$rejection_qty = (float)$this->input->post('rejection_qty');
		$mold_id = $this->input->post('mold_id');
		$production_hours = $this->input->post('production_hours');
		$downtime_in_min = $this->input->post('downtime_in_min');
		$setup_time_in_min = $this->input->post('setup_time_in_min');
		$cycle_time = $this->input->post('cycle_time');
		$finish_part_weight = $this->input->post('finish_part_weight');
		$runner_weight = $this->input->post('runner_weight');
		$remark = $this->input->post('remark');
		$downtime_reason = $this->input->post('downtime_reason');
		$wastage = $this->input->post('wastage');
		$success = 0;
		$messages = "Something went wrong.";
		$bom_data = $this->Crud->get_data_by_id("bom", $customer_part_id, "customer_part_id");
		if ($bom_data) {
			$flag = 0;
			foreach ($bom_data as $b) {
				$child_part = $this->SupplierParts->getSupplierPartById($b->child_part_id);
				if ($child_part) {
					$current_machine_mold_issue_stock = (float)$child_part[0]->machine_mold_issue_stock;
					$required_bom_qty = (float)$b->quantity * $qty;

					if ($required_bom_qty > $current_machine_mold_issue_stock) {
						$flag = 1;
						$messages = "Please add machine mold stock of Child Part number : " . $child_part[0]->part_number . " , Required Qty :" . $required_bom_qty . "  and current machine mold stock is :" . $current_machine_mold_issue_stock;
					}
				} else {
					$messages = "child part not found: " . $b->child_part_id;
				}
			}

			if ($flag != 0) {
			} else {
				foreach ($bom_data as $b) {
					$child_part = $this->SupplierParts->getSupplierPartById($b->child_part_id);
					if ($child_part) {
						$current_machine_mold_issue_stock = (float)$child_part[0]->machine_mold_issue_stock;
						$required_bom_qty = (float)$b->quantity * $qty;

						$new_machine_mold_issue_stock = $current_machine_mold_issue_stock - $required_bom_qty;

						$update_data = array("machine_mold_issue_stock" => $new_machine_mold_issue_stock);
						$update = $this->SupplierParts->updateStockById($update_data, $b->child_part_id);
					} else {
						$messages = "child part not found: " . $b->child_part_id;
					}
				}

				$data = array(
					'shift_id' => $shift_id,
					'date' => $date,
					'customer_part_id' => $customer_part_id,
				);


				$routing_data = $this->Crud->read_data_where("molding_production", $data);

				if ($routing_data && false) {
					$messages = 'already present';
					// echo "<script>alert('already present');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {


					$data_insert = array(
						'shift_id' => $shift_id,
						'machine_id' => $machine_id,
						'date' => $date,
						'operator_id' => $operator_id,
						'qty' => $qty,
						'rejection_qty' => $rejection_qty,
						'wastage' => $wastage,
						'mold_id' => $mold_id,
						'customer_part_id' => $customer_part_id,
						'production_hours' => $production_hours,
						'downtime_in_min' => $downtime_in_min,
						'setup_time_in_min' => $setup_time_in_min,
						'cycle_time' => $cycle_time,
						'finish_part_weight' => $finish_part_weight,
						'runner_weight' => $runner_weight,
						'remark' => $remark,
						'downtime_reason' => $downtime_reason,
						"created_by" => $this->user_id,
						"created_date" => $this->current_date,
						"created_time" => $this->current_time,
						"day" => $this->date,
						"month" => $this->month,
						"year" => $this->year,
					);

					$inser_query = $this->Crud->insert_data("molding_production", $data_insert);

					$customer_part_data = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
					$customer_master = $this->CustomerPart->getCustomerPartById($customer_part_data[0]->customer_parts_master_id);

					/** Update customer parts master used for FG stock  */
					$update_fg_stock_details = array(
						"molding_production_qty" =>  $customer_master[0]->molding_production_qty + $qty,
						"production_rejection" =>  $customer_master[0]->production_rejection + $rejection_qty
					);

					$customer_master_update = $this->CustomerPart->updateStockById($update_fg_stock_details, $customer_master[0]->id);

					if ($customer_master_update) {
						$success = 1;
						$messages = "successfully added";
						// echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
					} else {
						$messages = "'Error IN User  Adding ,try again";
						// echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
					}
				}
			}
		} else {
			$messages = "please add BOM data ";
		}

		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}


	public function update_p_q_onhold_molding()
	{


		echo $customer_part_id = (int)$this->input->post('customer_part_id');

		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$accepted_qty = $this->input->post('accepted_qty');
		$rejection_reason = $this->input->post('rejection_reason');
		$rejection_remark = $this->input->post('rejection_remark');
		$accepted_qty_old = $this->input->post('accepted_qty_old');
		$rejected_qty_old = $this->input->post('rejected_qty_old');
		$rejected_qty = $qty - $accepted_qty;


		$data23333 = array(
			'accepted_qty' => $accepted_qty_old + $accepted_qty,
			'rejected_qty' => $rejected_qty_old + $rejected_qty,
			'onhold_qty' => 0,
			'rejection_reason' => $rejection_reason,
			'rejection_remark' => $rejection_remark,
			"status" => "completed"

		);
		$update = $this->Crud->update_data("molding_production", $data23333, $id);

		if ($update) {
			$customer_part_data = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
			$customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_data[0]->part_number);
			$molding_production_data = $this->Crud->get_data_by_id("molding_production", $id, "id");
			$old_molding_production_qty = $customer_parts_master_data[0]->molding_production_qty;
			$new_molding_production_qty = $accepted_qty + $old_molding_production_qty;
			$update_data = array(
				'molding_production_qty' => $new_molding_production_qty,
			);
			$update = $this->CustomerPart->updateStockById($update_data, $customer_parts_master_data[0]->part_id);
			echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "error while updating";
		}
	}

	/**
	 * Accept/Reject molding production
	 */
	public function update_p_q_molding_production()
	{

		
		$id = $this->input->post('id');
		$qty = (int)$this->input->post('qty');
		// $accepted_qty = $this->input->post('accepted_qty');
		//$rejection_reason = $this->input->post('rejection_reason');
		$rejection_remark = $this->input->post('rejection_remark');
		$onhold_qty = (int)$this->input->post('onhold_qty');

		$semi_finished_location = 0; //(int)$this->input->post('semi_finished_location');
		$deflashing_assembly_location = 0; // (int)$this->input->post('deflashing_assembly_location');
		$final_inspection_location = (int)$this->input->post('final_inspection_location');
		$rejection_qty = (int)$this->input->post('rejection_qty');


		$customer_part_id = (int)$this->input->post('customer_part_id');
		$accepted_qty = $semi_finished_location + $deflashing_assembly_location + $final_inspection_location;
		$sum = (int)$accepted_qty + $onhold_qty;
		$success = 0;
		$messages = "Something went wrong.";
		if ($sum <= $qty) {

			$customer_part_data = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
			$customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_data[0]->part_number);
			$old_molding_production_qty = $customer_parts_master_data[0]->molding_production_qty;
			$old_production_rejection = $customer_parts_master_data[0]->production_rejection;
			$old_final_inspection_location = $customer_parts_master_data[0]->final_inspection_location;

			$new_molding_production_qty = $accepted_qty + $old_molding_production_qty;

			if ($accepted_qty == 0 && $onhold_qty == 0) {
				$rejected_qty = $qty;
			} else if ($accepted_qty == 0 && $onhold_qty > 0) {
				$rejected_qty = $qty - $onhold_qty;
			} else if ($accepted_qty > 0 && $onhold_qty == 0) {
				$rejected_qty = $qty - $accepted_qty;
			} else {
				$rejected_qty = $qty - ($accepted_qty + $onhold_qty);
			}

			$data23333 = array(
				'accepted_qty' => $accepted_qty,
				'rejected_qty' => $rejected_qty,
				'onhold_qty' => $onhold_qty,
				//'rejection_reason' => $rejection_reason,
				'rejection_remark' => $rejection_remark,
				"status" => "completed"

			);
			$update = $this->Crud->update_data("molding_production", $data23333, $id);

			if ($update) {
				$grade_id = $customer_parts_master_data[0]->grade_id;
				$grades_data = $this->Crud->get_data_by_id("grades", $grade_id, "id");
				if ($grades_data) {
					if ($rejected_qty > 0) {
						$old_rejection_count = $grades_data[0]->rejection_qty;
						$new_rejection_qty = $old_rejection_count + $rejected_qty;
						$grades_update = array(
							'rejection_qty' => $new_rejection_qty,
						);

						$update_new = $this->Crud->update_data("grades", $grades_update, $grade_id);
					};
				}

				$data = array(
					'customer_part_id' => $customer_part_id,
					'semi_finished_location' => $semi_finished_location,
					'deflashing_assembly_location' => $deflashing_assembly_location,
					'final_inspection_location' => $final_inspection_location,
					"created_by" => $this->user_id,
					"created_date" => $this->current_date,
					"created_time" => $this->current_time,
					"day" => $this->date,
					"month" => $this->month,
					"year" => $this->year,
				);

				$inser_query = $this->Crud->insert_data("molding_stock_transfer", $data);

				$molding_stock_transfer_id = $inser_query;
				$molding_stock_transfer_data = $this->Crud->get_data_by_id("molding_stock_transfer", $molding_stock_transfer_id, "id");
				$customer_part_data = $this->CustomerPart->getCustomerPartById($customer_parts_master_data[0]->part_id);

				if ($customer_part_data) {
					$current_molding_production_qty = (float)$customer_part_data[0]->molding_production_qty;
					$current_semi_finished_location = (float)$customer_part_data[0]->semi_finished_location;
					$current_deflashing_assembly_location = (float)$customer_part_data[0]->deflashing_assembly_location;
					$current_final_inspection_location = (float)$customer_part_data[0]->final_inspection_location;

					$semi_finished_location = (float)$molding_stock_transfer_data[0]->semi_finished_location;
					$deflashing_assembly_location = (float)$molding_stock_transfer_data[0]->deflashing_assembly_location;
					$final_inspection_location  = (float)$molding_stock_transfer_data[0]->final_inspection_location;

					$addition = (float) ($qty - ($semi_finished_location + $deflashing_assembly_location + $final_inspection_location));
					if ($current_molding_production_qty >= $addition) {
						$new_semi_finished_location = $current_semi_finished_location + $semi_finished_location;
						$new_deflashing_assembly_location = $current_deflashing_assembly_location + $deflashing_assembly_location;
						$new_final_inspection_location = $current_final_inspection_location + $final_inspection_location;

						$new_molding_production_qty = $current_molding_production_qty - $final_inspection_location - $rejected_qty;

						/**
						 * Need to check once on final, molding and production rejection
						 */
						$update_fg_stock = array(
							"semi_finished_location" => $new_semi_finished_location,
							"deflashing_assembly_location" => $new_deflashing_assembly_location,
							"final_inspection_location" => $new_final_inspection_location,
							"molding_production_qty" => $new_molding_production_qty,
							'production_rejection' => $old_production_rejection + $rejection_qty + $rejected_qty,
						);

						$result2 = $this->CustomerPart->updateStockById($update_fg_stock, $customer_parts_master_data[0]->part_id);
						$data_update_child_part_molding_stock_transfer = array(
							"status" => "completed",
						);
						$result3 = $this->Crud->update_data("molding_stock_transfer", $data_update_child_part_molding_stock_transfer, $molding_stock_transfer_id);
						if ($result3) {
							$messages  = "Stock Transfered successfully";
							$success = 1;
							// echo "<script>alert('Stock Transfered successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
						}
					} else {
						$messages  =  "Out Of molding_production_qty Sotck  in customer part: " . $customer_part_data[0]->part_number . "<br> current Molding Production Qty: " . $current_molding_production_qty . "<br> 
						 <br> required Molding Production Qty  : " . $addition ;
					}
				} else {
					$messages =  "item part  id : " . $customer_part_data[0]->part_number . "Not Found in customer_part table Please try again ";
				}
				$messages = "Updated Successfully";
				$success = 1;
				// echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages =  "error while updating";
			}
		} else {
			$messages =  "miss matched qty";
			// echo "<script>alert('Qty Mis Matched please add again ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}

		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}

	public function add_mold_maintenance()
	{
		$ret_arr = [];
		$msg = '';
		$success = 1;
		$data2 = array(
			'customer_part_id' => $this->input->post('customer_part_id'),
			'mold_name' => $this->input->post('mold_name')
		);
		$check = $this->Crud->read_data_where("mold_maintenance", $data2);
		if ($check != 0) {
			$msg = 'Customer Part and Mold Name already exists';
			$success = 0;
			// echo "<script>alert('Customer Part and Mold Name already exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$data = array(
				'no_of_cavity' => $this->input->post('no_of_cavity'),
				'mold_name' => $this->input->post('mold_name'),
				'ownership' => $this->input->post('ownership'),
				'customer_part_id' => $this->input->post('customer_part_id'),
				'target_life' => $this->input->post('target_life'),
				'target_over_life' => $this->input->post('target_over_life'),
			);

			$inser_query = $this->Crud->insert_data("mold_maintenance", $data);

			if ($inser_query) {
				// $this->addSuccessMessage('Added Successfully.');
				$msg = 'Added Successfully.';
			} else {
				$this->addErrorMessage('Failed to add record.Try again.');
				$msg = 'Failed to add record.Try again.';
				$success = 0;
				// $this->redirectMessage();
			}
			$data['filter_child_part_id'] = $this->input->post('customer_part_id');
			// $this->mold_maintenance($this->input->post('customer_part_id'));
			
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
	}


	public function add_machine_mold()
	{
		$data = array(
			'mold_maintenance_id' => $this->input->post('mold_maintenance_id'),
			'machine_id' => $this->input->post('machine_id'),
		);
		$inser_query = $this->Crud->insert_data("machine_mold", $data);

		if ($inser_query) {
			if ($inser_query) {
				echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
			}
		} else {
			echo "Error";
		}
	}


	public function add_machine_request()
	{

	
		$clientUnit = $this->session->userdata['clientUnit'];

		$data = array(
			'machine_id' => $this->input->post('machine_id'),
			'operator_id' => $this->input->post('operator_id'),
			'customer_part_id' => $this->input->post('customer_part_id'),
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"day" => $this->date,
			"month" => $this->month,
			"year" => $this->year,
			"created_by" => $this->user_id,
			"delivery_unit" => $clientUnit
		);

		$inser_query = $this->Crud->insert_data("machine_request", $data);
		$success = 0;
		$messages = "Something went wrong.";
		if ($inser_query) {
			$success = 1;
			$messages = "Added Successfully.";
				// $this->addSuccessMessage('Added Successfully.');
		} else {
			$messages = "AFailed to add record.Try again.";
				// $this->addErrorMessage('Failed to add record.Try again.');
		}
			// $this->redirectMessage();
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();

	}


	public function add_machine_request_details()
	{
		$machine_request_id = $this->input->post('machine_request_id');

		$data = array(
			'remark' => $this->input->post('remark'),
			'machine_request_id' => $machine_request_id,
			'child_part_id' => $this->input->post('child_part_id'),
			'qty' => $this->input->post('qty'),
		);
		$inser_query = $this->Crud->insert_data("machine_request_parts", $data);

		$custom_query = "select count(*) as pendingItems from machine_request_parts 
				where machine_request_id = " . $machine_request_id . " and status ='pending'";
		$result = $this->Crud->customQuery($custom_query);
		$isPending = $result[0]->pendingItems;

		$status = "pending";
		if ($isPending == 0) {
			$status = "Completed";
		}
		$update_machine_request = array(
			"status" => $status
		);
		$success = 0;
        $messages = "Something went wrong.";
		$machine_status_update_result = $this->Crud->update_data("machine_request", $update_machine_request, $machine_request_id);
	
		if ($machine_status_update_result) {
			$messages = "Added Successfully";
			$success = 1;
			// echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Error IN User  Adding ,try again";
			// echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function issue_material_request_qty()

	{
		
		$id = $this->input->post('id');
		$machine_request_id = $this->input->post('machine_request_id');

		$qty = $this->input->post('qty');
		$accepted_qty = $this->input->post('accepted_qty');
		$part_number = $this->input->post('part_number');
		$rejected_qty = $qty - $accepted_qty;

		$data = array(
			'accepted_qty' => $accepted_qty,
			'rejected_qty' => $rejected_qty,
			'status' => "Completed",
		);
		$success = 0;
        $messages = "Something went wrong.";
		$update = $this->Crud->update_data("machine_request_parts", $data, $id);
		if (false && $update != 0) {
			$messages = "Already Exists";
			// echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			if ($update) {
				$child_part = $this->SupplierParts->getSupplierPartByPartNumber($part_number);
				$old_stock = $child_part[0]->stock;

				$old_machine_mold_issue_stock = $child_part[0]->machine_mold_issue_stock;
				$new_stock = $old_stock - $accepted_qty;

				$new_machine_mold_issue_stock = $old_machine_mold_issue_stock + $accepted_qty;

				$data23333 = array(
					"stock" => $new_stock,
					"machine_mold_issue_stock" => $new_machine_mold_issue_stock
				);

				$update = $this->SupplierParts->updateStockById($data23333, $child_part[0]->id);
				$child_part[0]->id;

				//update the status
				$custom_query = "select count(*) as pendingItems from machine_request_parts where machine_request_id = " . $machine_request_id . " and status ='pending'";
				$result = $this->Crud->customQuery($custom_query);
				$isPending = $result[0]->pendingItems;

				$status = "pending";
				if ($isPending == 0) {
					$status = "Completed";
				}
				$update_machine_request = array(
					"status" => $status,
				);

				$machine_status_update_result = $this->Crud->update_data("machine_request", $update_machine_request, $machine_request_id);
				$messages = "Updated Sucessfully";
				$success = 1;
				// echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Not Updated";
				// echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();

	}

	public function add_molding_stock_transfer()
	{
		$semi_finished_location =  $this->input->post('semi_finished_location');
		$deflashing_assembly_location =  0; //$this->input->post('deflashing_assembly_location');
		$final_inspection_location =  0; //$this->input->post('final_inspection_location');

		$data = array(
			'customer_part_id' => $this->input->post('customer_part_id'),
			'semi_finished_location' => $semi_finished_location,
			'deflashing_assembly_location' => $deflashing_assembly_location,
			'final_inspection_location' => $final_inspection_location,
			"created_by" => $this->user_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"day" => $this->date,
			"month" => $this->month,
			"year" => $this->year,
		);

		$inser_query = $this->Crud->insert_data("molding_stock_transfer", $data);

		if ($inser_query) {


			if ($inser_query) {
				echo "<script>alert('Added Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
			}
		} else {
			echo "Error";
		}
	}


	public function add_molding_final_inspection_location()
	{

		$customer_part_id =  $this->input->post('customer_part_id');
		$qty =  $this->input->post('qty');

		$data = array(
			'customer_part_id' => $this->input->post('customer_part_id'),
			'qty' => $this->input->post('qty'),
			"created_by" => $this->user_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"day" => $this->date,
			"month" => $this->month,
			"year" => $this->year,
		);
		$success = 0;
        $messages = "Something went wrong.";
		$inser_query = $this->Crud->insert_data("final_inspection_request", $data);
		if ($inser_query) {
			$messages = "successfully added";
			$success = 1;
			// echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$messages = "Error In User Adding ,try again";
			// echo "<script>alert('Error In User Adding ,try again');document.location='erp_users'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		// echo "<script>alert('Added Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	}


	public function mold_maintenance($filter_part=null)
	{
		checkGroupAccess("mold_maintenance","list","Yes");
		// $this->db->group_by('customer_part_id');
	 //    $this->db->group_by('mold_name');
		$data['filter_child_part_id'] = $filter_part;
		$data['part_selection'] = $this->Crud->customQuery("SELECT DISTINCT part.id, part.part_number, part.part_description, cust.customer_name FROM
		customer_part part, customer cust, mold_maintenance mold
		WHERE mold.customer_part_id = part.id
		AND cust.id = part.customer_id");
		
		//echo "filter_part: ".$filter_part;
		if($filter_part == '' || $filter_part == null){
			$filter_part = 'All';
		}
		if(!empty($filter_part) && $filter_part == 'All'){
				$data['mold_maintenance_results'] = $this->Crud->customQuery("SELECT mold.id as id, mold.*, part.id as customer_part_id, part.part_number, part.part_description, cust.customer_name FROM
				customer_part part, customer cust, mold_maintenance mold
				WHERE mold.customer_part_id = part.id
				AND cust.id = part.customer_id
				group by mold.customer_part_id, mold.mold_name
				order by mold.id desc");
		} else if (!empty($filter_part)){
			$data['mold_maintenance_results'] = $this->Crud->customQuery("SELECT mold.id as id, mold.*, part.id as customer_part_id, part.part_number, part.part_description, cust.customer_name FROM
			customer_part part, customer cust, mold_maintenance mold
			WHERE mold.customer_part_id =" . $filter_part . "
			AND mold.customer_part_id = part.id
			AND cust.id = part.customer_id
			group by mold.customer_part_id, mold.mold_name
			order by mold.id desc");
		}	
		
		
		//echo "<br> DONE ====>";

		$data['new_part_selection'] = $this->Crud->customQuery("SELECT DISTINCT part.id, part.part_number, part.part_description, cust.customer_name FROM
		customer_part part, customer cust WHERE cust.id = part.customer_id");
		$data['filter_child_part_id'] = $filter_part; 

		$this->loadView('admin/molding/mold_maintenance', $data);
	}


	public function machine_mold()
	{
		$data['machine_mold'] = $this->Crud->read_data("machine_mold");
		$data['machine'] = $this->Crud->read_data("machine");
		$data['mold_maintenance'] = $this->Crud->read_data("mold_maintenance");

		$this->getPage('machine_mold', $data);
	}

	public function machine_request_client_unit() {
		$clientUnit = $this->input->post('clientUnit');
		$this->session->set_userdata('clientUnit', $clientUnit); //set the clientUnit to session..
		$clientDetails = $this->getClientUnitDetails($clientUnit);
		$this->session->set_userdata('clientUnitName', $clientDetails[0]->client_unit);
		$this->machine_request($clientUnit);
	}

	
	public function machine_request()
	{
		checkGroupAccess("machine_request","list","Yes");
		$clientUnit = $this->Unit->getSessionClientId();
		$data['filter_client'] = $clientUnit;
		$data['operator'] = $this->Crud->read_data("operator");
		$data['machine'] = $this->Crud->read_data("machine");
		
		//get the customer parts for which boms are already defined...
		$data['customer_part'] = $this->Crud->customQuery("SELECT distinct cust.customer_name, part.id , part.part_number, part.part_description 
		FROM bom b, customer_part part, customer cust
		where b.customer_part_id = part.id
		AND part.customer_id = cust.id");

		$data['showDocRequestDetails'] = $this->showMaterialRequestDetails();
		$data['isMultiClient'] = $this->session->userdata['isMultipleClientUnits'];
		/* datatable */
        $column[] = [
            "data" => "request_no",
            "title" => "Request No",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "machine_name",
            "title" => "Machine Mold",
            "width" => "20%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "operator_name",
            "title" => "Operator",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "customer_part",
            "title" => "Customer Part",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "created_date",
            "title" => "Created Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Actions",
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
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Part GRN data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data["start_date"] = date('01/m/Y');
		 $data["end_date"] = date('d/m/Y');
		$this->loadView('admin/molding/machine_request', $data,"Yes","Yes");
		// $this->getPage('purchase/test', $data,"NO","NO");
	}
	public function get_machine_request_view()
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
		
		$data = $this->CustomerPart->get_machine_request_view_data(
            $condition_arr,
            $post_data["search"]
        );
		// pr($data,1);

		foreach ($data as $key => $value) {
			// $edit_data = base64_encode(json_encode($value)); 
			$value['request_no'] = "MR-".$value['request_no'];
			$data[$key]['request_no'] = '<a href="'.base_url("machine_request_details/").$value['id'].'" title="'.$value['request_no'].'">'.$value['request_no'].'</a>';
			$data[$key]['action'] = display_no_character("");
			if(checkGroupAccess("machine_request","delete","No")){
				$data[$key]['action'] = '<i class="ti ti-trash delete-request" data-id="'.$value['id'].'" data-request-code="'.$value['request_no'].'" title="delete"></i>';
			}
			if($value['req_parts']){
				$data[$key]['action'] = display_no_character();
			}
			
		}
		$data["data"] = $data;
        $total_record = $this->CustomerPart->get_machine_request_view_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'] != null ? $total_record['total_record'] : 0 ;
        $data["recordsFiltered"] = $total_record['total_record'] != null ? $total_record['total_record'] : 0 ;
        echo json_encode($data);
        exit();
		
	}


	/* public function getBOM_customer_parts()
	{
		$customer_id = $this->input->post('id');
		$customer_parts = $this->Crud->customQuery("SELECT distinct part.id , part.part_number, part.part_description 
				FROM bom b, customer_part part, customer cust
				where b.customer_part_id = part.id
				AND part.customer_id = ".$customer_id);
		//$customer_parts = $this->Crud->get_data_by_id("customer_part", $customer_id, 'customer_id');
		echo '<select>Select Part Number // Description';
		if ($customer_parts) {
			foreach ($customer_parts as $value) {
					echo '<option value="' . $value->id . '">' . $value->part_number . ' // ' . $value->part_description .'</option>';
			}
		} else {
			echo '<option value="">-- NO BOM defined for this customer --- </option>';
		}
		echo '</select>';
	} */

	public function machine_request_completed1()
	{
		$filter_by_status = $this->input->post('filter_by_status');
		$clientUnit = $this->session->userdata['clientUnit'];

		if(empty($filter_by_status)){
			$filter_by_status = "pending";
		}
		
		$data['machine_request_parts'] = $this->Crud->customQuery("SELECT 
		m_req.id as id, m.name as machine_name, o.name as operator_name, 
		COALESCE(part_master.part_number, part.part_number) as part_no, 
		COALESCE(part_master.part_description, part.part_description) as part_description, child.part_number as child_part_no, 
		child.part_description as child_desc, u.uom_name, req_parts.qty, req_parts.status, 
		req_parts.accepted_qty, req_parts.remark, m_req.created_date, m_req.created_time, m_req.status
		FROM machine_request m_req
		JOIN machine m ON m_req.machine_id = m.id
		JOIN operator o ON m_req.operator_id = o.id
		LEFT JOIN customer_parts_master part_master ON m_req.customer_parts_master_id = part_master.id
		LEFT JOIN customer_part part ON m_req.customer_part_id = part.id
		JOIN machine_request_parts req_parts ON m_req.id = req_parts.machine_request_id
		JOIN child_part child ON req_parts.child_part_id = child.id
		JOIN uom u ON child.uom_id = u.id
		WHERE m_req.delivery_unit = '".$clientUnit."' 
			AND m_req.status = '".$filter_by_status."' 
			ORDER BY m_req.id DESC");

		
		$data['filter_by_status'] = $filter_by_status;
		$this->loadView('admin/molding/machine_request_completed', $data);
	}
	public function machine_request_completed()
	{
		
		checkGroupAccess("machine_request_completed","list","Yes");
		$data['filter_by_status'] = "pending";
		/* datatable */
        $column[] = [
            "data" => "request_no",
            "title" => "Request No",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "machine_name",
            "title" => "Machine",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "operator_name",
            "title" => "Operator",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "customer_part",
            "title" => "Customer Part",
            "width" => "15%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "child_part",
            "title" => "Child Part",
            "width" => "15%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "uom_name",
            "title" => "UOM",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "Requested Qty",
            "width" => "17%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "accepted_qty",
            "title" => "Issued Qty",
            "width" => "17%",
            "className" => "dt-center",
        ];
		
		$column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "17%",
            "className" => "dt-center",
        ];
        // $column[] = [
        //     "data" => "action",
        //     "title" => "Actions",
        //     "width" => "7%",
        //     "className" => "dt-center",
        // ];
		$column[] = [
            "data" => "remark",
            "title" => "Remark",
            "width" => "17%",
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
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Part GRN data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data["start_date"] = date('01/m/Y');
		 $data["end_date"] = date('d/m/Y');
		$this->loadView('admin/molding/machine_request_completed', $data,"Yes","Yes");
		// $this->getPage('purchase/test', $data,"NO","NO");
	}
	public function get_machine_request_completed_view()
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
		
		$data = $this->CustomerPart->get_machine_request_completed_view_data(
            $condition_arr,
            $post_data["search"]
        );
		// pr($data,1);

		foreach ($data as $key => $value) {
			// $edit_data = base64_encode(json_encode($value)); 
			$value['request_no'] = "MR-".$value['request_no'];
			$data[$key]['request_no'] = '<a href="'.base_url("machine_request_details/").$value['id'].'" title="'.$value['request_no'].'">'.$value['request_no'].'</a>';
			$data[$key]['remark'] = display_no_character($value['remark']);
			$data[$key]['child_part'] = display_no_character($value['child_part']);
			$data[$key]['customer_part'] = display_no_character($value['customer_part']);
			
			
		}
		
		$data["data"] = $data;
        $total_record = $this->CustomerPart->get_machine_request_completed_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'] != null ? $total_record['total_record'] : 0 ;
        $data["recordsFiltered"] = $total_record['total_record'] != null ? $total_record['total_record'] : 0 ;
        echo json_encode($data);
        exit();
		
	}


	public function machine_request_details()

	{



		$machine_request_id = $this->uri->segment('2');
		$data['child_part'] = $this->Crud->customQuery("SELECT c.id,c.part_number, c.part_description 
		FROM bom b, machine_request m,child_part c 
		WHERE m.customer_part_id = b.customer_part_id 
		AND m.id = ".$machine_request_id."
		AND b.child_part_id = c.id");

		$data['machine_request_parts'] = $this->Crud->customQuery("SELECT parts.id,c.part_number,c.part_description, u.uom_name,parts.qty, s.machine_mold_issue_stock, parts.status, parts.remark, s.stock, parts.accepted_qty, req.status as request_status FROM machine_request req
				INNER JOIN machine_request_parts parts ON parts.machine_request_id = req.id
				INNER JOIN child_part c ON parts.child_part_id = c.id
				INNER JOIN child_part_stock s ON s.childPartId = c.id
				INNER JOIN uom u ON c.uom_id = u.id
				WHERE req.id = ".$machine_request_id." 
				AND s.clientId = ".$this->Unit->getSessionClientId()." order by parts.id desc");
		$data['machine_request_id'] = $this->uri->segment('2');  
		$this->loadView('admin/molding/machine_request_details', $data);

	}


	public function molding_stock_transfer_click()
	{
		$molding_stock_transfer_id  = $this->uri->segment('2');
		$molding_stock_transfer_data = $this->Crud->get_data_by_id("molding_stock_transfer", $molding_stock_transfer_id, "id");
		$customer_part_data = $this->Crud->get_data_by_id("customer_part", $molding_stock_transfer_data[0]->customer_part_id, "id");
		if ($customer_part_data) {
			$current_molding_production_qty = (float)$customer_part_data[0]->molding_production_qty;
			$current_semi_finished_location = (float)$customer_part_data[0]->semi_finished_location;
			$current_deflashing_assembly_location = (float)$customer_part_data[0]->deflashing_assembly_location;
			$current_final_inspection_location = (float)$customer_part_data[0]->final_inspection_location;

			$semi_finished_location = (float)$molding_stock_transfer_data[0]->semi_finished_location;
			$deflashing_assembly_location = (float)$molding_stock_transfer_data[0]->deflashing_assembly_location;
			$final_inspection_location  = (float)$molding_stock_transfer_data[0]->final_inspection_location;

			$addition = (float)$semi_finished_location + $deflashing_assembly_location + $final_inspection_location;


			if ($current_molding_production_qty >= $addition) {
				$new_semi_finished_location = $current_semi_finished_location + $semi_finished_location;
				$new_deflashing_assembly_location = $current_deflashing_assembly_location + $deflashing_assembly_location;
				$new_final_inspection_location = $current_final_inspection_location + $final_inspection_location;

				$new_molding_production_qty = $current_molding_production_qty - $addition;


				$data_update_child_part = array(
					"semi_finished_location" => $new_semi_finished_location,
					"deflashing_assembly_location" => $new_deflashing_assembly_location,
					"final_inspection_location" => $new_final_inspection_location,
					"molding_production_qty" => $new_molding_production_qty,
				);
				// print_r($data_update_child_part);
				$result2 = $this->Crud->update_data("customer_part", $data_update_child_part, $molding_stock_transfer_data[0]->customer_part_id);
				$data_update_child_part_molding_stock_transfer = array(
					"status" => "completed",
				);
				$result3 = $this->Crud->update_data("molding_stock_transfer", $data_update_child_part_molding_stock_transfer, $molding_stock_transfer_id);
				if ($result3) {
					echo "<script>alert('Stock Transfered successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			} else {
				echo "Out Of molding_production_qty Sotck  in customer part: " . $customer_part_data[0]->part_number;
				echo "<br>";
				echo "<br>";
				echo "current Molding Production Qty: " . $current_molding_production_qty . "<br>";
				echo "<br>";
				echo "<br>";
				echo "required Molding Production Qty  : " . $addition . "<br>";
				echo "<br>";
				echo "<br>";
			}
		} else {
			echo "item part  id : " . $customer_part_data[0]->part_number . "Not Found in customer_part table Please try again ";
		}
	}

	public function molding_stock_transfer1()
	{

		$role_management_data = $this->db->query('SELECT *  FROM `customer_parts_master` WHERE molding_production_qty >= 1 ');
		$data['customer_part'] = $role_management_data->result();
		// print_r($data['customer_part']);
		$data['molding_stock_transfer'] = $this->Crud->customQuery("
			SELECT ms.*,c.part_number as part_number,c.part_description as part_description
			FROM molding_stock_transfer as ms
			LEFT JOIN customer_part as c ON c.id = ms.customer_part_id
			WHERE ms.clientId = '".$this->Unit->getSessionClientId()."' 
			ORDER BY ms.id DESC
		");
		$this->loadView('admin/molding/molding_stock_transfer', $data);
	}
	public function molding_stock_transfer()
	{
		
		checkGroupAccess("molding_stock_transfer","list","Yes");
		$data['filter_by_status'] = "pending";
		/* datatable */
      
		$column[] = [
            "data" => "child_part",
            "title" => "Child Part",
            "width" => "15%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "final_inspection_location",
            "title" => "Final Inspection Qty",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "17%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "transfer",
            "title" => "Transfer",
            "width" => "17%",
            "className" => "dt-center",
        ];
		
		$column[] = [
            "data" => "date",
            "title" => "Date & Time",
            "width" => "17%",
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
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Part GRN data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data["start_date"] = date('01/m/Y');
		 $data["end_date"] = date('d/m/Y');
		$this->loadView('admin/molding/molding_stock_transfer', $data,"Yes","Yes");
		// $this->getPage('purchase/test', $data,"NO","NO");
	}
	public function get_molding_stock_transfer_view()
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
		
		$data = $this->CustomerPart->get_molding_stock_transfer_view_data(
            $condition_arr,
            $post_data["search"]
        );
		

		foreach ($data as $key => $value) {
			$data[$key]['transfer'] = "Stock Transferred";
			if($value['status'] == "pending"){
				if(checkGroupAccess("molding_stock_transfer","update","No")){
					$data[$key]['transfer'] = '<a class="btn btn-warning" href="'.base_url('molding_stock_transfer_click/').$value['id'].'">Click To Transfer Stock</a>';
				}else{
					$data[$key]['transfer'] = display_no_character("");
				}
			}
			
			$data[$key]['date'] = getDefaultDateTime($value['date']);
			
		}
		$data["data"] = $data;
        $total_record = $this->CustomerPart->get_molding_stock_transfer_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'] != null ? $total_record['total_record'] : 0 ;
        $data["recordsFiltered"] = $total_record['total_record'] != null ? $total_record['total_record'] : 0 ;
        echo json_encode($data);
        exit();
		
	}


	public function view_mold_by_filter()
	{
		$this->mold_maintenance($this->input->post('child_part_id'));
	}

	public function update_mold_maintenance()
	{
		$id = $this->input->post('id');
		$ret_arr = [];
		$msg = '';
		$success = 1;
		$data = array(
				'no_of_cavity' => $this->input->post('no_of_cavity'),
				'mold_name' => $this->input->post('mold_name'),
				'ownership' => $this->input->post('ownership'),
				'target_life' => $this->input->post('target_life'),
				'target_over_life' => $this->input->post('target_over_life'),
			);

			$inser_query = $this->Crud->update_data("mold_maintenance", $data, $id, "id");
			if ($inser_query) {
				if ($inser_query) {
					// $this->addSuccessMessage('Record updated successfully.');
					$msg = 'Mold Maintenance updated successfully.';
				} else {
					// $this->addErrorMessage('Failed to update. Try again.');
					$msg = 'Failed to update. Try again.';
					$success = 0;
				}
			} else {
				$this->addErrorMessage('Failed to update. Try again.');
				$msg = 'Failed to update. Try again.';
				$success = 0;
			}
		// $this->mold_maintenance($this->input->post('filter_child_part_id'));
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
	}

	public function view_rejection_details()
	{
		$molding_production_id = $this->uri->segment('2');
		$customer_part_id = $this->uri->segment('3');
		$view_page = $this->uri->segment('4');

		$data['molding_production_id'] = $molding_production_id;

		$data['customer_part_details'] = $this->Crud->customQuery("SELECT c.customer_name,cp.part_number,
		cp.part_description FROM customer_part cp, customer c WHERE cp.id = " . $customer_part_id . " AND cp.customer_id =  c.id");

		$data['molding_prod_details'] = $this->Crud->customQuery("SELECT p.date, m.name, s.shift_type, s.name as shift_name
		from machine m, shifts s, molding_production p where m.id = p.machine_id AND s.id = p.shift_id AND p.id = " . $molding_production_id . " ");

		$data['reject_remark'] = $this->Crud->read_data_acc("reject_remark");
		$role_management_data = $this->Crud->customQuery('SELECT d.id, d.molding_productionKy,d.rejection_reasonKy,d.rejection_qty,d.cavity,r.name 
		FROM mold_production_rejection_details d, reject_remark r 
		where d.molding_productionKy = ' . $molding_production_id . ' AND r.id = d.rejection_reasonKy');
		$data['rejection_details'] = $role_management_data; //$role_management_data->result();
		$data['view_page'] = $view_page;
		$this->loadView('admin/molding/rejection_details', $data);
	}

	public function add_rejection_details()
	{
		$molding_production_id = $this->input->post('molding_production_id');
		$reason_id = $this->input->post('rejection_reason');
		$rejection_qty = $this->input->post('rejection_qty');
		$cavity = $this->input->post('cavity');

		$data = array(
			"molding_productionKy" => $molding_production_id,
			"rejection_reasonKy" => $reason_id,
			"rejection_qty" => $rejection_qty,
			"cavity" => $cavity
		);
		$success = 0;
        $messages = "Something went wrong.";
		$insert = $this->Crud->insert_data("mold_production_rejection_details", $data);
		if ($insert) {
			$messages = "Rejection details added successfully.";
			$success = 1;
		} else {
			
			if ($this->checkNoDuplicateEntryError()) {
				$messages = "Unable to add rejection details. Please try again.";
				// $this->addErrorMessage('Unable to add rejection details. Please try again.');
			}
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function update_rejection_details()
	{
		$molding_production_id = $this->input->post('molding_production_id');
		$id = $this->input->post('id');
		$rejection_reason = $this->input->post('rejection_reason');
		$rejection_qty = $this->input->post('rejection_qty');
		$cavity = $this->input->post('cavity');

		$data = array(
			'molding_productionKy' => $molding_production_id,
			'rejection_qty' => $rejection_qty,
			'rejection_reasonKy' => $rejection_reason,
			"cavity" => $cavity
		);

		$update = $this->Crud->update_data("mold_production_rejection_details", $data, $id);
		$success = 0;
        $messages = "Something went wrong.";
		if ($update) {
			$messages = "Rejection details updated successfully.";
			$success = 1;
			// $this->addSuccessMessage('Rejection details updated successfully.');
		} else {
			if ($this->checkNoDuplicateEntryError()) {
				$messages = "Unable to updated rejection details. Please try again.";
				// $this->addErrorMessage('Unable to updated rejection details. Please try again.');
			}
		}
		// $this->redirectMessage();
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function view_downtime_details()
	{
		$molding_production_id = $this->uri->segment('2');
		$customer_part_id = $this->uri->segment('3');
		$view_page = $this->uri->segment('4');

		$data['molding_production_id'] = $molding_production_id;
		$data['customer_part_details'] = $this->Crud->customQuery("SELECT c.customer_name,cp.part_number,cp.part_description FROM customer_part cp, customer c WHERE cp.id = " . $customer_part_id . " AND cp.customer_id =  c.id");

		$data['molding_prod_details'] = $this->Crud->customQuery("SELECT p.date, m.name, s.shift_type, s.name as shift_name
		from machine m, shifts s, molding_production p where m.id = p.machine_id AND s.id = p.shift_id AND p.id = " . $molding_production_id . " ");

		$data['downtime_master'] = $this->Crud->read_data("downtime_master");
		$role_management_data = $this->db->query('SELECT d.id, d.molding_productionKy,d.downtime_reasonKy,d.downtime,m.name 
		FROM mold_production_downtime_details d, downtime_master m 
		where d.molding_productionKy = ' . $molding_production_id . ' AND m.id = d.downtime_reasonKy');
		$data['downtime_details'] = $role_management_data->result();
		$data['view_page'] = $view_page;

		$this->loadView('admin/molding/downtime_details', $data);
	}

	public function add_downtime_details()
	{
		$molding_production_id = $this->input->post('molding_production_id');
		$reason_id = $this->input->post('downtime_reason');
		$downtime = $this->input->post('downtime');

		$data = array(
			"molding_productionKy" => $molding_production_id,
			"downtime_reasonKy" => $reason_id,
			"downtime" => $downtime,
		);
		$insert = $this->Crud->insert_data("mold_production_downtime_details", $data);
		if ($insert) {
			$this->addSuccessMessage('Downtime details added successfully.');
		} else {
			if ($this->checkNoDuplicateEntryError()) {
				$this->addErrorMessage('Unable to add downtime details. Please try again.');
			}
		}
		$this->redirectMessage();
	}

	public function update_downtime_details()
	{
		$molding_production_id = $this->input->post('molding_production_id');
		$id = $this->input->post('id');
		$downtime_reason = $this->input->post('downtime_reason');
		$downtime = $this->input->post('downtime');

		$data = array(
			'molding_productionKy' => $molding_production_id,
			'downtime_reasonKy' => $downtime_reason,
			'downtime' => $downtime
		);

		$update = $this->Crud->update_data("mold_production_downtime_details", $data, $id);
		if ($update) {
			$this->addSuccessMessage('Downtime details updated successfully.');
		} else {
			if ($this->checkNoDuplicateEntryError()) {
				$this->addErrorMessage('Unable to update downtime details. Please try again.');
			}
		}
		$this->redirectMessage();
	}

	public function report_prod_rejection()
	{
		checkGroupAccess("report_prod_rejection","list","Yes");
		$created_month  = $this->input->post("created_month");
		$created_year  = $this->input->post("created_year");

		if (empty($created_year)) {
			$created_year = $this->year;
		}
		if (empty($created_month)) {
			$created_month = $this->month;
		}

		/*$role_management_data = $this->db->query('
		SELECT * FROM `grn_details` WHERE created_month = ' . $created_month . ' AND created_year = ' . $created_year . 
		' ORDER BY id DESC ');
		$data['grn_details'] = $role_management_data->result();
		*/

		$data['report_prod_rejection'] = $this->Crud->customQuery("SELECT 
		c.customer_name, cp.part_number , r.name as rejection_reason, d.rejection_qty,
		p.date as prod_date, s.shift_type, s.name as shift_name, 
		m.name as machine_name, o.name as operator_name
		FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
		, customer_part cp, customer c, operator o
		WHERE p.clientId = ".$this->Unit->getSessionClientId()."
		AND d.molding_productionKy = p.id
		AND r.id = d.rejection_reasonKy
		AND p.customer_part_id = cp.id
		AND c.id =  cp.customer_id
		AND p.machine_id = m.id 
		AND p.shift_id = s.id
		AND p.operator_id = o.id 
		order by d.rejection_qty desc, c.customer_name asc");

		//total rejection quantity
		$data['total_rejection'] = $this->Crud->customQuery("select sum(d.rejection_qty) as total_rejection_qty
		FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
		, customer_part cp, customer c, operator o
		WHERE 
		p.clientId = ".$this->Unit->getSessionClientId()."
		AND d.molding_productionKy = p.id
		AND r.id = d.rejection_reasonKy
		AND p.customer_part_id = cp.id
		AND c.id =  cp.customer_id
		AND p.machine_id = m.id 
		AND p.shift_id = s.id
		AND p.operator_id = o.id 
		group by p.customer_part_id");

		//max Rejection Qty by reason
		$data['max_rejection_reason'] = $this->Crud->customQuery("SELECT r.name, sum(d.rejection_qty) as total_rejection_qty
		FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
		, customer_part cp, customer c, operator o
		WHERE 
		p.clientId = ".$this->Unit->getSessionClientId()."
		AND d.molding_productionKy = p.id
		AND r.id = d.rejection_reasonKy
		AND p.customer_part_id = cp.id
		AND c.id =  cp.customer_id
		AND p.machine_id = m.id 
		AND p.shift_id = s.id
		AND p.operator_id = o.id 
		group by r.name
		order by total_rejection_qty desc limit 3");

		//Issue on machine:
		$data['machine_analysis'] = $this->Crud->customQuery("SELECT m.name as machine_name, r.name, sum(d.rejection_qty) as total_rejection_qty
		FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
		, customer_part cp, customer c, operator o
		WHERE 
		p.clientId = ".$this->Unit->getSessionClientId()." 
		AND d.molding_productionKy = p.id
		AND r.id = d.rejection_reasonKy
		AND p.customer_part_id = cp.id
		AND c.id =  cp.customer_id
		AND p.machine_id = m.id 
		AND p.shift_id = s.id
		AND p.operator_id = o.id 
		group by m.name, r.name
		order by total_rejection_qty desc limit 3");

		/* Total Rejection Qty by Operator
		$data['operator_analysis'] = $this->Crud->customQuery('SELECT o.name as operator_name, r.name, sum(d.rejection_qty) as total_rejection_qty
		FROM molding_production p, mold_production_rejection_details d, reject_remark r, machine m, shifts s
		, customer_part cp, customer c, operator o
		WHERE d.molding_productionKy = p.id
		AND r.id = d.rejection_reasonKy
		AND p.customer_part_id = cp.id
		AND c.id =  cp.customer_id
		AND p.machine_id = m.id 
		AND p.shift_id = s.id
		AND p.operator_id = o.id 
		group by r.name, o.name
		order by total_rejection_qty desc'); */

		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;

		// $this->load->view('header.php');
		$this->loadView('admin/molding/report_prod_rejection', $data);
		// $this->load->view('footer.php');
	}

	public function upload_mold_maintenance_doc()
	{
		$id = $this->input->post('id');
		$ctrid = $this->input->post('customer_part_id');
		
		if (!empty($_FILES['doc']['name'])) {
		          
			$image_path = "./documents/";
			$config['allowed_types'] = '*';
			$config['upload_path'] = $image_path;
			$config['file_name'] = $_FILES['doc']['name'];
            
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('doc')) {
				$uploadData = $this->upload->data();
				$picture4 = $uploadData['file_name'];
			}
		} 


			$data = array(
				"pm_date" => $this->input->post('pm_date'),
				"no_of_cavity" => $this->input->post('no_of_cavity'),
				"mold_name" => $this->input->post('mold_name'),
				"customer_part_id" => $this->input->post('customer_part_id'),
				"target_life" => $this->input->post('target_life'),
				"target_over_life" => $this->input->post('target_over_life'),
				"current_molding_prod_qty" => $this->input->post('current_molding_prod_qty'),
				"doc" => $picture4,
			);
			$result = $this->Crud->insert_data("mold_maintenance", $data, $id);
			if ($result) {
			    
			    	$data_qty_update = array(
								"qty" => '0',
							);
							
							$up_qty = $this->db->query("update molding_production set qty='0' where mold_id='$id' and customer_part_id='$ctrid'");
							
				echo "<script>alert('Uploaded Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Not Uploaded');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
	
	}
	
	public function mold_maintenance_report()
	{
		checkGroupAccess("mold_maintenance_report","list","Yes");
		$mold_maintenance_docs = [];
		$data['mold_maintenance']  = $this->CustomerPart->getCustomerPartsMolding();
		// pr($data);
		foreach($data['mold_maintenance'] as $key => $val){
			$mold_maintenance_docs[$val['mold_name']] = $this->Crud->get_data_by_id("mold_maintenance", $val['mold_name'], "mold_name");
			$data['customer_part_filter_data'][] = $val['customer_name']. '/'.$val['part_number'].'/'.$val['part_description'];
			$data['mold_maintenance'][$key]['encrpted_data'] = base64_encode(json_encode($val));
		}
		// pr($data['mold_maintenance'],1);
		$data['current_date'] = date("Y-m-d");
		$data['mold_maintenance_docs'] = $mold_maintenance_docs;
		// pr($mold_maintenance_docs,1);
		
		$this->loadView('molding/mold_maintenance_report',$data);

	}
	
	public function view_mold_by_filter_report()
	{
		$this->_mold_maintenance_report($this->input->post('child_part_id'));
	}
	
	public function _mold_maintenance_report($filter_child_part_id)
	{
		$data['filter_child_part_id'] = $filter_child_part_id;
		$data['mold_maintenance'] = $this->Crud->read_data("mold_maintenance");
		$data['customer_part'] = $this->Crud->read_data("customer_part");

		$this->load->view('header');
		$this->load->view('mold_maintenance_report', $data);
		$this->load->view('footer');
	}
	
	public function mold_maintenance_history()
	{
	    $mold_maintenance_id = str_replace('_', ' ', $this->uri->segment('2'));
	    $cstmr_id = str_replace('_', ' ', $this->uri->segment('3'));
		$mold_maintenance_data = $this->Crud->get_data_by_id("mold_maintenance", $mold_maintenance_id, "mold_name");
		// pr($mold_maintenance_data,1);
	  	$data_old = array(
			'mold_name' => $mold_maintenance_id,
			'customer_part_id' => $cstmr_id,
		);
		$data['mold_maintenance_data'] = $mold_maintenance_data;
		$data['mold_maintenance_history'] = $this->Common_admin_model->get_data_by_id_multiple_condition("mold_maintenance", $data_old);
		$data['mld_data'] = $this->Crud->get_data_by_id("mold_maintenance", $data['mold_maintenance_data'][0]->id, "id");
		$data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['mold_maintenance_data'][0]->customer_part_id, "id");;
		$data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
		foreach($data['mold_maintenance_history'] as $p){
			$totalQuantity = 0;
			$tot_qty_arr = [];
			$conditions_data = ['customer_part_id' => $p->customer_part_id, 'mold_id' => $p->id];
			$molding_production_quantity_data = $this->Common_admin_model->get_data_by_id_multiple_condition("molding_production", $conditions_data);
			foreach ($molding_production_quantity_data as $molding_data){
				$qty = $molding_data->qty;
				$totalQuantity += $totalQuantity + $qty;
			}
			$tot_qty_arr[$p->id] = $totalQuantity;
		};
		$data['tot_qty_arr'] = $tot_qty_arr;
		// $this->load->view('header');
		$this->loadview('molding/mold_maintenance_history', $data);
		// $this->load->view('footer');\
	}

	/* erp improvement points */
	public function downtime_report(){
		checkGroupAccess("downtime_report","list","Yes");
		$current_year = date("Y");
		$date_filter = [
			"start_date" => $current_year."-04-01",
			"end_date" =>($current_year+1)."-3-31"
		];
		$down_time_data = $this->P_molding_model->get_down_time_data($date_filter);
		$data = $this->get_filter_data($down_time_data);
		$date_filter = [
			"start_date" => "01/04/".$current_year,
			"end_date" =>"31/03/".($current_year+1)
		];
		$data['date_filter'] = $date_filter;
		$this->loadView('reports/down_time_report', $data);
		// pr($data,1);
	}
	public function filter_downtime_report(){
		$post_data = $this->input->post();
		$date_arr = explode("-",$post_data['date_range']);
		$start_date = explode("/",trim($date_arr[0]));
		$end_date = explode("/",trim($date_arr[1]));
		$start_date = $start_date[2]."/".$start_date[1]."/".$start_date[0];
		$end_date =  $end_date[2]."/".$end_date[1]."/".$end_date[0];
		$date_filter = [
			"start_date" => $start_date,
			"end_date" =>$end_date
		];
		$down_time_data = $this->P_molding_model->get_down_time_data($date_filter);
		$data = $this->get_filter_data($down_time_data);

		$top_5_down_time_html = '';
		if(count($data['top_5_down_time']) > 0){
			foreach ($data['top_5_down_time'] as $key => $value) {
				$top_5_down_time_html .= "<tr><td>".$value['reason']."</td><td>".$value['down_time']."</td></tr>";
			}
		}
		$return_arr['top_5_down_time_html'] = $top_5_down_time_html;
		$down_time_data_html = '';
		if(count($data['down_time_data']) > 0){
			foreach ($data['down_time_data'] as $key => $value) {
				$reason  = $value['reason'] != "" ? $value['reason'] : 'N/A';
				$down_time_data_html .= "<tr>
				<td class='text-center'>".$value['date']."</td>
				<td class='text-center'>".$value['shift_type']."/".$value['name']."</td>
				<td >".$value['machine_name']."</td>
				<td class='text-center'>".$value['downtime']."</td>
				<td >".$reason."</td>
				 </tr>";
			}
		}
		$return_arr['down_time_data_html'] = $down_time_data_html;
		$return_arr['total_down_time'] = $data['total_down_time'] > 0 ? $data['total_down_time'] : 0; 
		$return_arr['max_down_time_machine'] = $data['max_down_time_machine'] !='' && $data['max_down_time_machine'] != null ? $data['max_down_time_machine'] : "N/A"; 
		$return_arr['max_down_time_reason'] = $data['max_down_time_reason'] != '' && $data['max_down_time_reason'] != null ? $data['max_down_time_reason']: "N/A"; 
		echo json_encode($return_arr);
		exit();
	}
	public function get_filter_data($data_arr = []){
		$down_time_data = $data_arr;
		$data['down_time_data'] =$down_time_data;
		$data['total_down_time'] = array_sum(array_column($down_time_data, 'downtime'));

		// get max downtime machine
		$machine_data = array_column($down_time_data, 'machine_name','machine_id');
		$machine_wise_down_time = [];
		foreach ($down_time_data as $key => $value) {
			$machine_wise_down_time[$value['machine_id']] += $value['downtime'];
		}
		$max_value = max($machine_wise_down_time);
		$max_key = array_search($max_value, $machine_wise_down_time);
		$data['max_down_time_machine'] = $machine_data[$max_key];

		// get max downtime reason
		$reason_data = array_column($down_time_data, 'reason','downtime_reasonKy');
		$reason_wise_down_time = [];
		foreach ($down_time_data as $key => $value) {
			$reason_wise_down_time[$value['downtime_reasonKy']] += $value['downtime'];
		}
		$max_value = max($reason_wise_down_time);
		$max_key = array_search($max_value, $reason_wise_down_time);
		$data['max_down_time_reason'] = $reason_data[$max_key] != "" ? $reason_data[$max_key] : "N/A";

		// get top 5 down time 
		$top_5_down_time = [];
		foreach ($reason_wise_down_time as $key => $value) {
			$reason = $reason_data[$key] != '' ? $reason_data[$key] : "N/A";
			array_push($top_5_down_time, ["reason"=>$reason,"down_time" => $value]);
		}
		$data['top_5_down_time'] = $top_5_down_time;
		return $data;
	}
	
}
