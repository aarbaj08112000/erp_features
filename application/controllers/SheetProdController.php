<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('ProductionController.php');

class SheetProdController extends ProductionController
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('InhouseParts');
		$this->load->model('SupplierParts');

	}
	
	/**
	 * Sheet metal Production to Store.. DONE FOR STOCK
	 */
	public function update_production_qty_child_part_production_qty() {
		$child_part_id  = $this->input->post('child_part_id');
		$part_number  = $this->input->post('part_number');
		$production_qty = $this->input->post('production_qty');

		$child_part = $this->SupplierParts->getSupplierPartById($child_part_id);
		$stockColName = $this->Unit->getStockColNmForClientUnit();
		$prodColName = $this->Unit->getProdColNmForClientUnit();

		$old_stock = (float)$child_part[0]->$stockColName;
		$new_stock = $old_stock + $production_qty;

		$old_production_qty = (float)$child_part[0]->$prodColName;
		$new_production_qty = (float)$old_production_qty - (float)$production_qty;

		
		$data_update_child_part = array(
			$stockColName => $new_stock,
			$prodColName => $new_production_qty
		);
	
		$query = $this->SupplierParts->updateStockById($data_update_child_part, $child_part[0]->id);
		$success = 0;
        $messages = "Something went wrong.";
		if ($query) {
			$this->Crud->stock_report($child_part[0]->part_number, $child_part[0]->part_number, "production_stock", "store_stock", $old_stock, $production_qty);
			$messages = "Stock transferred successfully.";
			$success = 1;
			// $this->addSuccessMessage('Stock transferred successfully.');
		} else {
			$messages = "Unable to transfer the Production stock to Store stock";
			// $this->addErrorMessage('Unable to transfer the Production stock to Store stock');
		}

		// $this->_part_stocks($child_part_id,null);
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


	/**
	 * Production QTY
	 */
	public function p_q()
	{

		$clientId = $this->Unit->getSessionClientId();
		$data['p_q'] = $this->Crud->customQuery('SELECT 
					p.*, 
					o.name AS op_name, 
					m.name AS machine_name, 
					s.shift_type AS shift_type, 
					s.name AS shift_name
				FROM 
					`p_q` p
				JOIN 
					machine m ON p.machine_id = m.id
				JOIN 
					operator o ON p.operator_id = o.id
				JOIN 
					shifts s ON p.shift_id = s.id
				WHERE 
					m.clientId = '.$clientId.'
				ORDER BY 
					p.date DESC 
				');
		
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$CI =& get_instance();
	   	// Load the model
	    $CI->load->model('InhouseParts');
		foreach ($data['p_q'] as $key => $u) {
			if ($u->output_part_table_name == "inhouse_parts") {
				$output_part_data = $this->InhouseParts->getInhousePartOnlyById($u->output_part_id);
            } else {
            	$output_part_data = $this->Crud->get_data_by_id("customer_part", $u->output_part_id, "id");
            }
            $data['p_q'][$key]->output_part_data = $output_part_data;

		}
		$data['inhouse_parts'] = $this->InhouseParts->readInhousePartsOnly();
		$data['machine_data'] = $this->Crud->read_data("machine", true);
		$this->loadView('store/p_q', $data);
	}


	public function production_qty_add(){

		$data['shifts'] = $this->Crud->read_data("shifts",true);
		$data['operator'] = $this->Crud->read_data("operator",true);
		$data['machine'] = $this->Crud->read_data("machine",true);

		$data['operations_bom'] = $this->Crud->customQuery("WITH distinct_bom AS (
			SELECT bom.*
			FROM operations_bom bom
			WHERE bom.id IN (
				SELECT A.id
				FROM operations_bom AS A
				LEFT JOIN operations_bom AS B
					ON A.output_part_id = B.output_part_id
					AND A.output_part_table_name = B.output_part_table_name
					AND A.customer_part_number = B.customer_part_number
					AND A.id < B.id
				WHERE B.id IS NULL
				AND EXISTS (SELECT 1 FROM operations_bom_inputs bi WHERE bom.id = bi.operations_bom_id)
			)
		)

		SELECT 
			bom.*,
			COALESCE(ip.part_number, cp.part_number) AS part_number,
			COALESCE(ip.part_description, cp.part_description) AS part_description
		FROM 
			distinct_bom bom
		LEFT JOIN 
			inhouse_parts ip
			ON bom.output_part_table_name = 'inhouse_parts' 
			AND bom.output_part_id = ip.id
		LEFT JOIN 
			customer_part cp
			ON bom.output_part_table_name = 'customer_part' 
			AND bom.output_part_id = cp.id
		ORDER BY 
			bom.id DESC");

		$this->load->view('child_pages/sheet_productionQty_add', $data);	//this page is same as that of final inspection qty except machine data filter
	}


	public function final_inspection_qty_add(){

		$data['shifts'] = $this->Crud->read_data("shifts",true);
		$data['operator'] = $this->Crud->read_data("operator",true);
		$crit = array(
			"name" => 'FINAL INSPECTION',
			"clientId" => $this->Unit->getSessionClientId()
		);
		$data['machine'] = $this->Crud->read_data_where_result("machine",$crit)->result();

		$data['operations_bom'] = $this->Crud->customQuery("WITH distinct_bom AS (
			SELECT bom.*
			FROM operations_bom bom
			WHERE bom.id IN (
				SELECT A.id
				FROM operations_bom AS A
				LEFT JOIN operations_bom AS B
					ON A.output_part_id = B.output_part_id
					AND A.output_part_table_name = B.output_part_table_name
					AND A.customer_part_number = B.customer_part_number
					AND A.id < B.id
				WHERE B.id IS NULL
				AND EXISTS (SELECT 1 FROM operations_bom_inputs bi WHERE bom.id = bi.operations_bom_id)
			)
		)

		SELECT 
			bom.*,
			COALESCE(ip.part_number, cp.part_number) AS part_number,
			COALESCE(ip.part_description, cp.part_description) AS part_description
		FROM 
			distinct_bom bom
		LEFT JOIN 
			inhouse_parts ip
			ON bom.output_part_table_name = 'inhouse_parts' 
			AND bom.output_part_id = ip.id
		LEFT JOIN 
			customer_part cp
			ON bom.output_part_table_name = 'customer_part' 
			AND bom.output_part_id = cp.id
		ORDER BY 
			bom.id DESC");

		
		$this->load->view('child_pages/sheet_productionQty_add', $data);
	}


	// DONE: FOR STOCK CHECK
	public function update_p_q_onhold()
	{

		$id = $this->input->post('id');
		$qty = (float)$this->input->post('qty');
		$accepted_qty = $this->input->post('accepted_qty');
		$rejection_reason = $this->input->post('rejection_reason');
		$rejection_remark = $this->input->post('rejection_remark');
		$output_part_id = $this->input->post('output_part_id');
		$accepted_qty_old = (float)$this->input->post('accepted_qty_old');
		$rejected_qty_old = (float)$this->input->post('rejected_qty_old');

		$operations_bom = $this->Crud->get_data_by_id("operations_bom", $output_part_id, "output_part_id");
		$success = 0;
        $messages = "Something went wrong.";
		$operations_bom_inputs = $this->Crud->get_data_by_id("operations_bom_inputs", $operations_bom[0]->id, "operations_bom_id");
		if ($operations_bom_inputs) {
			$rejected_qty = $qty - $accepted_qty;


			$data23333 = array(
				'accepted_qty' => $accepted_qty + $accepted_qty_old,
				'rejected_qty' => $rejected_qty + $rejected_qty_old,
				'onhold_qty' => 0,
				'rejection_reason' => $rejection_reason,
				'rejection_remark' => $rejection_remark,
				"status" => "completed"

			);
			$update = $this->Crud->update_data("p_q", $data23333, $id);

			if ($update) {
				if ($operations_bom[0]->output_part_table_name == "inhouse_parts") {
					$output_part_data = $this->InhouseParts->getInhousePartById($output_part_id);
					$prodQtyColName = $this->Unit->getProdColNmForClientUnit();
					$previous_production_qty = $output_part_data[0]->$prodQtyColName;
					$new_production_qty = $previous_production_qty + $accepted_qty;
					$update_data = array(
						$prodQtyColName => $new_production_qty,
					);
					$update = $this->InhouseParts->updateStockById($update_data, $output_part_data[0]->id);
				} else {
					$fgStockColName = $this->Unit->getFGStockColNmForClientUnit();

					$output_part_data = $this->Crud->get_data_by_id("customer_part", $output_part_id, "id");
					$previous_production_qty = $output_part_data[0]->$fgStockColName;
					$new_fg_stock = $previous_production_qty + $accepted_qty;
					$update_data_2 = array(
						$fgStockColName => $new_fg_stock,
					);
					$update = $this->Crud->update_data("customer_part", $update_data_2, $output_part_data[0]->id);
				}
				$messages = "Updated Successfully ";
				$success = 1;
				// echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages =  "error while updating";
			}
		} else {
			$messages =  "Operations BOM Not Found";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	/**
	 * View production qty details
	 */
	public function details_production_qty() {

		$data['p_q_id'] = $this->uri->segment('2');
		$p_q_id = $this->uri->segment('2');

		$data['p_q_data'] = $this->Crud->get_data_by_id("p_q", $p_q_id, "id");
		$data['p_q_history'] = $this->Crud->get_data_by_id("p_q_history", $p_q_id, "p_q_id");
		foreach ($data['p_q_history'] as $key => $u) {
			if ($u->input_part_number_table_name == "inhouse_parts") {
                $output_part_data = $this->InhouseParts->getInhousePartOnlyById($u->input_part_number);
            } else {
                $output_part_data = $this->Crud->get_data_by_id("child_part", $u->input_part_number, "id");
            }
            $data['p_q_history'][$key]->output_part_data = $output_part_data;
		}
		$data['sharingQtyColName'] = $this->Unit->getSharingQtyColNmForClientUnit();
		$this->loadView('store/details_production_qty', $data);
	}

	/**
 	* Production QTY View
 	*/

	public function view_p_q()
	{
		checkGroupAccess("view_p_q","list","Yes");

		// pr($_POST,1);	
		$post_data = $_POST;
		$clientId = $this->Unit->getSessionClientId();
		$machin_name = $post_data['search_machine_name'] > 0 ? "AND m.id = ".$post_data['search_machine_name'] : "";
		$selected_machin_name = $post_data['search_machine_name'];

		if($post_data['datetimes'] != ""){
			$date_filter = $post_data['datetimes'];
	        $date_filter =  explode((" - "),$date_filter);
	        $data['start_date'] = $date_filter[0];
	        $data['end_date'] = $date_filter[1];
		}else{
			$date_filter = date("Y/m/d", strtotime("-8 days")) ." - ". date("Y/m/d");
	        $date_filter =  explode((" - "),$date_filter);
	        $data['start_date'] = $date_filter[0];
	        $data['end_date'] = $date_filter[1];
		}
		
		$part_id_val = explode("|", $post_data['part_id']);
		$part_condition = "";
		if($post_data['part_id'] != null){
			if($part_id_val[1] == "custom_part"){
				$part_condition = " AND p.output_part_table_name ='customer_part' AND p.output_part_id = ".$part_id_val[0];
			}else{
				$part_condition = " AND p.output_part_table_name ='inhouse_parts' AND p.output_part_id = ".$part_id_val[0];
			}
		}

		$status = "pending";
		if(isset($post_data['status'])){
			$status = $post_data['status'];
		}
		
		$status_con = $status != "" ? "AND status = '$status'" : "";
		

	
		
		$data['p_q'] = $this->Crud->customQuery('SELECT 
					p.*, 
					o.name AS op_name, 
					m.name AS machine_name, 
					s.shift_type AS shift_type, 
					s.name AS shift_name
				FROM 
					`p_q` p
				JOIN 
					machine m ON p.machine_id = m.id
				JOIN 
					operator o ON p.operator_id = o.id
				JOIN 
					shifts s ON p.shift_id = s.id
				WHERE 
					m.clientId = '.$clientId.'
					AND STR_TO_DATE(p.created_date, "%d-%m-%Y") BETWEEN "'.$date_filter[0].'" AND "'.$date_filter[1].'"
					'.$machin_name.' '.$part_condition.' '.$status_con.'
				ORDER BY 
					p.date DESC 
				');
		// pr($data['p_q'],1);

		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$CI =& get_instance();
	   	// Load the model
	    $CI->load->model('InhouseParts');
		foreach ($data['p_q'] as $key => $u) {
			if ($u->output_part_table_name == "inhouse_parts") {
				$output_part_data = $this->InhouseParts->getInhousePartOnlyById($u->output_part_id);
            } else {
            	$output_part_data = $this->Crud->get_data_by_id("customer_part", $u->output_part_id, "id");
            }
            $data['p_q'][$key]->output_part_data = $output_part_data;
		}
		// pr($data['p_q'],1);

		$inhouse_parts = $this->InhouseParts->readInhousePartsOnly();
		$customer_part = $this->Crud->read_data("customer_part");
		foreach ($customer_part as $key => $value) {
			$value->id = $value->id."|custom_part";
			$inhouse_parts[] = $value;
		}
		// pr($inhouse_parts,1);
		$data['status'] = $status;
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$data['inhouse_parts'] = $inhouse_parts;
		$data['inhouse_parts'] = $inhouse_parts;
		$data['selected_machin_name'] = $selected_machin_name;
		$data['selected_part_id'] = $post_data['part_id'];
		$data['machine_data'] = $this->Crud->read_data("machine", true);
		$this->loadView('store/p_q', $data);
	}


	// DONE: FOR STOCK CHECK
	public function add_production_qty()
	{
		
		$shift_id = $this->input->post('shift_id');
		$machine_id = $this->input->post('machine_id');
		$operator_id = $this->input->post('operator_id');
		$date = $this->input->post('date');
		$qty = $this->input->post('qty');
		$output_part_id = $this->input->post('output_part_id');
		
		$operations_bom_data = $this->Crud->get_data_by_id("operations_bom", $output_part_id, "id");
		$output_part_id =  $operations_bom_data[0]->output_part_id;

		$output_part_table_name = $operations_bom_data[0]->output_part_table_name;

		$data_to_check = array(
			'shift_id' => $shift_id,
			'date' => $date,
			'output_part_id' => $operations_bom_data[0]->output_part_id,
			"output_part_table_name" => $output_part_table_name,
			"machine_id" => $machine_id,
		);
		// pr($data_to_check,1);

		$routing_data = $this->Common_admin_model->get_data_by_id_multiple_condition_count_new("p_q", $data_to_check);
		$success = 0;
        $messages = "Something went wrong.";
		if ($routing_data > 0) {
			$messages = "already present"; 
			// echo "<script>alert('already present');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {

			if (true) {
				$p_q_molding_production =  $operations_bom_data[0]->output_part_id;
				$operations_bom_inputs_data = $this->Crud->get_data_by_id("operations_bom_inputs", $this->input->post('output_part_id'), "operations_bom_id");
				$req_qty = 0;
				$flag = 0;

				if ($operations_bom_inputs_data) {
					foreach ($operations_bom_inputs_data as $oib) {
						if ($oib->input_part_table_name == "inhouse_parts") {
							$output_part_data = $this->InhouseParts->getInhousePartById($oib->input_part_id);
						} else {
							$output_part_data = $this->SupplierParts->getSupplierPartById($oib->input_part_id);
						}

						if ($output_part_data) {
							$prodQtyColName = $this->Unit->getProdColNmForClientUnit();
							$actual_stock = $output_part_data[0]->$prodQtyColName;
							$req_qty = $qty * $oib->qty;

							if ($req_qty > $actual_stock) {
								$flag = $flag + 1;
								$messages = "Part Production Qty Not Found : " . $output_part_data[0]->part_number . " on " . $oib->input_part_table_name . ", actual production stock is " . $actual_stock . ",and required stock is " . $req_qty . "<br>";
							}
						} else {
							$messages = "part Not Found <br>";
						}
					}
					
					if ($flag == 0) {

						foreach ($operations_bom_inputs_data as $oib) {
							if ($oib->input_part_table_name == "inhouse_parts") {
								$output_part_data = $this->InhouseParts->getInhousePartById($oib->input_part_id);
							} else {
								$output_part_data = $this->SupplierParts->getSupplierPartById($oib->input_part_id);
							}

							$prodQtyCol = $this->Unit->getProdColNmForClientUnit();
							if ($output_part_data) {
								$actual_stock = $output_part_data[0]->$prodQtyCol;

								$req_qty = $qty * $oib->qty;

								$new_production_qty = $actual_stock - $req_qty;
								$update_data = array(
									$prodQtyCol => $new_production_qty,
								);
								if ($oib->input_part_table_name == "inhouse_parts") {
									// echo "updated 1";
									$update = $this->InhouseParts->updateStockById($update_data, $output_part_data[0]->id);
								} else {
									// echo "updated 2";
									$update = $this->SupplierParts->updateStockById($update_data, $output_part_data[0]->id);
								}
								// echo "<br>id :" . $output_part_data[0]->id;
								// echo "<br>";
								// echo "<br>output_part_data " . $output_part_data[0]->part_number;;
								// echo "<br>$oib->input_part_table_name  " . $output_part_data[0]->part_number;;
							} else {
								$messages = "part Not Found <br>";
							}
						}

						$data_insert = array(
							'shift_id' => $shift_id,
							'machine_id' => $machine_id,
							'date' => $date,
							'output_part_id' => $output_part_id,
							'output_part_table_name' => $output_part_table_name,
							'operator_id' => $operator_id,
							'qty' => $qty,
							'scrap_factor' => $qty * $operations_bom_data[0]->scrap_factor,
							"created_by" => $this->input->post('output_part_id'),
							"created_date" => $this->current_date,
							"created_time" => $this->current_time,
							"day" => $this->date,
							"month" => $this->month,
							"year" => $this->year,
						);
						
						$inser_query = $this->Crud->insert_data("p_q", $data_insert);
						// pr($inser_query,1);
						if ((int) $inser_query > 0) {
							$messages = "successfully added";
							$success = 1;
							// echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
						} else {
							$messages = "Error While  Adding ,try again";
							// echo "<script>alert('Error While  Adding ,try again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
						}
					} else {
						$messages .= "<br> Please add all above production qty";
						// echo "<br><br><br><br><br><a href=" . $_SERVER['HTTP_REFERER'] . "> < Go Back</a>";
					}
				} else {
					$messages = "Input parts not found";
				}
			} else {
				$messages = "Error";
			}
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	/**
	 * ---------------------------- sharing_p_q ----------------
	 */

	 public function sharing_p_q()
	{
		checkGroupAccess("sharing_p_q","list","Yes");
		$clientId = $this->Unit->getSessionClientId();

		//Get the details per unit using machine id reference
		$data['sharing_p_q'] = $this->Crud->customQuery("
			SELECT pq.*,o.name AS op_name, 
					m.name AS machine_name, 
					s.shift_type AS shift_type, 
					s.name AS shift_name
			FROM sharing_p_q pq
				JOIN 
					machine m ON pq.machine_id = m.id
				JOIN 
					operator o ON pq.operator_id = o.id
				JOIN 
					shifts s ON pq.shift_id = s.id 
				WHERE EXISTS ( SELECT 1 FROM machine m WHERE clientId = ".$clientId." AND m.id = pq.machine_id )
				ORDER BY pq.date desc

		
		");
		
		$data['shifts'] = $this->Crud->read_data("shifts",true);
		$data['operator'] = $this->Crud->read_data("operator",true);
		$data['machine'] = $this->Crud->read_data("machine",true);
		$data['operations_bom'] = $this->Crud->read_data("operations_bom");
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");
		$data['sharing_bom'] = $this->Crud->read_data("sharing_bom"); //TO-DO Not sure where this is being used.
		
		$this->loadView('store/sharing_p_q', $data);
	}

	public function add_production_qty_sharing()
	{
		$success = 0;
        $messages = "Something went wrong.";
		$shift_id = $this->input->post('shift_id');
		$machine_id = $this->input->post('machine_id');
		$operator_id = $this->input->post('operator_id');
		$date = $this->input->post('date');
		$qty = $this->input->post('qty');

		$data = array(
			'shift_id' => $shift_id,
			'date' => $date,
		);

		$routing_data = $this->Crud->read_data_where("sharing_p_q", $data);

		if ($routing_data) {
			$messages = "already present";
			// echo "<script>alert('already present');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {

			$data_insert = array(
				'shift_id' => $shift_id,
				'machine_id' => $machine_id,
				'operator_id' => $operator_id,
				'date' => $date,
				"created_by" => $this->user_id,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"day" => $this->date,
				"month" => $this->month,
				"year" => $this->year,
			);

			$inser_query = $this->Crud->insert_data("sharing_p_q", $data_insert);
			if ($inser_query) {
				$success = 1;
				$messages = "successfully added";
				// echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Error IN User  Adding ,try again";
				// echo "<script>alert('Error IN User  Adding ,try again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}

		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	
	public function sharing_issue_request()
	{
		checkGroupAccess("sharing_issue_request","list","Yes");

		/* datatable */
		$column[] = [
            "data" => "id",
            "title" => "id",
            "width" => "24%",
            "className" => "dt-left",
            "visible" => false
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "24%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "24%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_thickness",
            "title" => "Thickness",
            "width" => "9%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "weight",
            "title" => "Weight",
            "width" => "9%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "Qty(Kg)",
            "width" => "12%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "12%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "date_time",
            "title" => "Date & Time",
            "width" => "14%",
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
        $data["sorting_column"] = json_encode([0, 'desc']);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        // $ajax_json['teacher_data'] = $this->session->userdata();
        // pr($ajax_json['designation'],1);
        $date_filter = date("Y/m/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
		$this->loadView('store/sharing_issue_request', $data,"Yes","Yes");

		$created_month  = $this->input->post("created_month");
		$created_year  = $this->input->post("created_year");
		
		if (empty($created_year)) {
			$created_year = $this->year;
		}
		if (empty($created_month)) {
			$created_month = $this->month;
		}
		
				

		$data['child_part'] = $this->SupplierParts->readSupplierPartsOnly();
		$month_arr = [];
		for ($i = 1; $i <= 12; $i++) {
            $month_data = $this->Common_admin_model->get_month($i);
            $month_number = $this->Common_admin_model->get_month_number($month_data);
            $month_arr[$i]['month_data'] = $month_data;
            $month_arr[$i]['month_number'] = $month_number;
        }
        $data['month_arr'] = $month_arr;
		$this->loadView('store/sharing_issue_request', $data);
	}

	public function get_sharing_issue_request_data()
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
		
		$data = $this->SupplierParts->get_sharing_issue_request_data(
            $condition_arr,
            $post_data["search"]
        );
		

		foreach ($data as $key => $value) {
			// $edit_data = base64_encode(json_encode($value)); 
			$data[$key]['po_number'] = '<a href="'.base_url().'inwarding_invoice/'.$value['id'].'"  class="po-number">'.$value['po_number'].'</a>';
			$data[$key]['download_po'] = '<a href="'.base_url().'download_my_pdf/'.$value['id'].'" class="btn btn-primary">Download</a>';
			$data[$key]['action'] = '<a data-id="'.$value['id'].'" href="javascript:void(0)" class="btn btn-danger close-po">Close</a>';
		}
		$data["data"] = $data;
        $total_record = $this->SupplierParts->get_sharing_issue_request_data_Count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
		
	}

	public function add_sharing_issue_request()
	{
		$success = 0;
        $messages = "Something went wrong.";
		$child_part_id = $this->input->post('child_part_id');
		$data = array(
			'child_part_id' => $this->input->post('child_part_id'),
			'qty' => (float)$this->input->post('qty'),
			'sharing_strip' => $this->input->post('sharing_strip'),
			"created_by" => $this->user_id,
			"created_date" => $this->current_date,
			"created_time" => $this->current_time,
			"day" => $this->date,
			"month" => $this->month,
			"year" => $this->year,
		);

		$inser_query = $this->Crud->insert_data("sharing_issue_request", $data);
		if ($inser_query) {
			if ($inser_query) {
				$messages = "Added Successfully";
				$success = 1;
				// echo "<script>alert('Added Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages = "Error IN User  Adding ,try again";
				// echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
			}
		} else {
			echo "Error";
		}

		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function accept_sharing_request()
	{
		$success = 0;
		$messages = "Something went wrong.";
		$id = $this->input->post('id');
		$accepted_qty = (float)$this->input->post('accepted_qty');
		$child_part_id = $this->input->post('child_part_id');
		$actual_stock = (float)$this->input->post('actual_stock');
		$sharing_qty = (float)$this->input->post('sharing_qty');
		$data23333 = array(
			'accepted_qty' => $accepted_qty,
			"status" => "completed"
		);

		$unit_id = $this->Unit->getSessionClientId();
		$get_previous_qty = $this->Crud->customQuery("SELECT *FROM child_part_stock WHERE childPartId = ".$child_part_id." AND clientId = $unit_id");
		$get_previous_qty = isset($get_previous_qty[0]->sharing_qty) && $get_previous_qty[0]->sharing_qty > 0 ? $get_previous_qty[0]->sharing_qty : 0;
		
		$update = $this->Crud->update_data("sharing_issue_request", $data23333, $id);
		if ($update) {
			$new_stock = $actual_stock - $accepted_qty;
			$new_sharing_qty = $get_previous_qty + $accepted_qty;
			$stockColName = $this->Unit->getStockColNmForClientUnit();
			$sharingQtyColName = $this->Unit->getSharingQtyColNmForClientUnit();

			$data2 = array(
				$stockColName => $new_stock,
				$sharingQtyColName => $new_sharing_qty,
			);

			$result2 = $this->SupplierParts->updateStockById($data2, $child_part_id);
			// echo "<script>alert('Updated Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			$messages = "Updated Successfully";
			$success  =1;
		} else {
			$messages = "Error While Updating";
			// echo "<script>alert('Error While Updating ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
		$result['messages'] = $messages;
		$result['success'] = $success;
		echo json_encode($result);
		exit();
	}


	public function add_sharing_p_q_history()
	{
		$name = $this->input->post('name');
		$output_part_id = $this->input->post('output_part_id');
		$sharing_p_q_id = $this->input->post('sharing_p_q_id');
		$input_part_id = $this->input->post('input_part_id');
		$number = $this->input->post('contractorCode');
		$qty = (float)$this->input->post('qty');
		$scrap_factor = $this->input->post('scrap_factor');
		$price = $this->input->post('price');
		$out_part_table_name = "";
		$input_part_table_name = "";
		$customer_id = "";
		$data = array(
			"name" => $name,
			"output_part_id" => $output_part_id,
		);

		$child_part_data_new = $this->SupplierParts->getSupplierPartById($input_part_id);
		$sharingQtyColName = $this->Unit->getSharingQtyColNmForClientUnit();
		$input_sharing_qty = (float)$child_part_data_new[0]->$sharingQtyColName;
		$input_part_id_details = $this->SupplierParts->getSupplierPartById($output_part_id);
		$weight = (float)$input_part_id_details[0]->weight;
		$success = 0;
        $messages = "Something went wrong.";
		if (($qty) <= $input_sharing_qty) {
			$check = $this->Crud->read_data_where("sharing_bom", $data);
			if (false && $check != 0) {
				$messages = "Already Exists";
				// echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {

				$data = array(
					"output_part_id" => $output_part_id,
					"input_part_id" => $input_part_id,
					"qty" => $qty,
					"qty_in_kg" => ($qty * $weight),
					"output_part_table_name" => "child_part",
					"scrap_factor" => $scrap_factor,
					"input_part_table_name" => "child_part",
					"sharing_p_q_id" => $sharing_p_q_id,
					"created_date" => $this->current_date,
					"created_time" => $this->current_time,
					"day" => $this->date,
					"month" => $this->month,
					"year" => $this->year,
					"created_by" => $this->user_id,
				);

				$result = $this->Crud->insert_data("sharing_p_q_history", $data);

				$new_sharing_qty = $input_sharing_qty - ($qty);
				$updateStockData = array(
					$sharingQtyColName => $new_sharing_qty,
				);
				$result2 = $this->SupplierParts->updateStockById($updateStockData, $input_part_id);

				if ($result2) {
					$messages = "Added Sucessfully";
					$success = 1;
					// echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$messages  = "Unable to Add";
					// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
		} else {
			$messages  =  "Sharing Stock Of " . $child_part_data_new[0]->part_number . " is " . $input_sharing_qty . ", and required qty is " . ($qty * $weight) . "";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function details_production_qty_sharing()
	{
		$sharing_p_q_id = $this->uri->segment('2');
		$data['sharing_p_q_id']	= $sharing_p_q_id;	

		$data['sharing_p_q'] = $this->Crud->customQuery("SELECT pq.*,o.name AS op_name, 
					m.name AS machine_name, 
					s.shift_type AS shift_type, 
					s.name AS shift_name
			FROM sharing_p_q pq
				JOIN 
					machine m ON pq.machine_id = m.id
				JOIN 
					operator o ON pq.operator_id = o.id
				JOIN 
					shifts s ON pq.shift_id = s.id 
			WHERE pq.id = ".$sharing_p_q_id);
			

		$data['sharing_p_q_history'] = $this->Crud->customQuery("SELECT h.*, 
		c.part_number as output_part_no, c.part_description as output_part_desc,
		cp.part_number as input_part_no, c.part_description as input_part_desc
		FROM sharing_p_q_history h 
			JOIN child_part c ON c.id = h.output_part_id 
			JOIN child_part cp ON cp.id = h.input_part_id 
			WHERE h.sharing_p_q_id = ".$sharing_p_q_id."
			ORDER BY h.id DESC");
		
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");

		$data['child_part_list']  = $this->SupplierParts->readSupplierParts();
		$data['sharingQtyColName']  =  $this->Unit->getSharingQtyColNmForClientUnit();
		$this->loadView('store/details_production_qty_sharing', $data);
	}

	/**
	 * Accept/Reject qty
	 */
	public function update_p_q_sharing()
	{

		$id = $this->input->post('id');
		$qty = (float)$this->input->post('qty');
		$accepted_qty = (float)$this->input->post('accepted_qty');
		$rejection_reason = $this->input->post('rejection_reason');
		$rejection_remark = $this->input->post('rejection_remark');
		$output_part_id = $this->input->post('output_part_id');
		$onhold_qty = (float)$this->input->post('onhold_qty');
		$scrap_factor = (float)$this->input->post('scrap_factor');
		$input_part_id = (float)$this->input->post('input_part_id');
		$qty_in_kg = (float)$this->input->post('qty_in_kg');

		$input_part_id_details = $this->SupplierParts->getSupplierPartOnlyById($input_part_id);
		$weight = (float)$input_part_id_details[0]->weight;
		$sum = (float)$accepted_qty + $onhold_qty;
		$success = 0;
        $messages = "Something went wrong.";
		if ($sum <= $qty) {
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
				'rejection_reason' => $rejection_reason,
				'rejection_remark' => $rejection_remark,
				"status" => "completed"
			);

			$update = $this->Crud->update_data("sharing_p_q_history", $data23333, $id);
			if ($update) {
			    $output_part_data = $this->SupplierParts->getSupplierPartById($output_part_id);
				$stockColName = $this->Unit->getStockColNmForClientUnit();
				$previous_stock = $output_part_data[0]->$stockColName;
				$new_stock = $previous_stock + $accepted_qty;
				$update_data_output_part_id = array(
					$stockColName => $new_stock
				);
				$update = $this->SupplierParts->updateStockById($update_data_output_part_id, $output_part_id);
				$messages = "Updated Successfully";
				$success = 1;
				// echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages =  "error while updating";
			}
		} else {
			$messages =  "Qty Mismtach, Please try again";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


	public function update_p_q_onhold_sharing()
	{

		$id = $this->input->post('id');
		$qty = (float)$this->input->post('qty');
		$accepted_qty = (float)$this->input->post('accepted_qty');
		$rejection_reason = $this->input->post('rejection_reason');
		$rejection_remark = $this->input->post('rejection_remark');
		$output_part_id = $this->input->post('output_part_id');
		$onhold_qty = (float)$this->input->post('onhold_qty');
		$scrap_factor = (float)$this->input->post('scrap_factor');
		$input_part_id = (float)$this->input->post('input_part_id');
		$qty_in_kg = (float)$this->input->post('qty_in_kg');

		$input_part_id_details = $this->SupplierParts->getSupplierPartOnlyById($input_part_id);

		$weight = (float)$input_part_id_details[0]->weight;
		$sum = (float)$accepted_qty + $onhold_qty;
		$success = 0;
        $messages = "Something went wrong.";
		if ($sum <= $qty) {
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
				'rejection_reason' => $rejection_reason,
				'rejection_remark' => $rejection_remark,
				"status" => "completed"

			);
			$update = $this->Crud->update_data("sharing_p_q_history", $data23333, $id);

			if ($update) {
				$output_part_data = $this->SupplierParts->getSupplierPartById($output_part_id);
				$stockColName = $this->Unit->getStockColNmForClientUnit();
				$previous_stock = $output_part_data[0]->$stockColName;
				$new_stock = $previous_stock + $accepted_qty;
				$update_data_output_part_id = array(
					$stockColName => $new_stock,
				);

				$update = $this->SupplierParts->updateStockById($update_data_output_part_id, $output_part_id);
				$messages = "Updated Successfully";
				$success = 1;
				// echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				$messages =  "error while updating";
			}
		} else {
			$messages =  "mismtach qty, please try again";
			// echo "<script>alert('Qty Mis Matched please add again ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
}
