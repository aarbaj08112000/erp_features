<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');
require_once(APPPATH.'libraries/PHPExcel/IOFactory.php');

class P_Deflashing extends CommonController
{
   
    const PLASTIC_DEFLASHING = "plastic/deflashing/";
	
	function __construct() {
		parent::__construct();
		$this->load->model('SupplierParts');
		$this->load->model('CustomerPart');
   }
	
	private function getPath(){
		return self::PLASTIC_DEFLASHING;
	}

	private function getPage($viewPage,$viewData){
        $this->loadView($this->getPath().$viewPage,$viewData);
	}

	public function p_q_deflashing()
	{
		$data['deflashing_production'] = $this->Crud->read_data("deflashing_production");
		$data['shifts'] = $this->Crud->read_data("shifts");
		$data['operator'] = $this->Crud->read_data("operator");
		$data['machine'] = $this->Crud->read_data("machine");
		$data['deflashing_operation'] = $this->Crud->read_data("deflashing_operation");

		$role_management_data = $this->db->query('SELECT *  FROM `customer_part` WHERE `molding_production_qty` > 0 ');
		$data['customer_part'] = $role_management_data->result();
		
		$this->getPage('p_q_deflashing',$data);
	}

	public function add_production_qty_deflashing()
	{
		$deflashing_operation_id = $this->input->post('deflashing_operation_id');
		$deflashing_operation_data = $this->Crud->get_data_by_id("deflashing_operation", $deflashing_operation_id, "id");

		$customer_part_id = $deflashing_operation_data[0]->customer_part_id;
		$shift_id = $this->input->post('shift_id');
		$date = $this->input->post('date');
		$operator_id = $this->input->post('operator_id');
		$production_hours = $this->input->post('production_hours');
		$qty = (float)$this->input->post('qty');
		$qty = $qty;

		$bom_data = $this->Crud->get_data_by_id("bom", $customer_part_id, "customer_part_id");
		if ($bom_data || true) {
			$flag = 0;
			$customer_parts = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
			if ($customer_parts) {
				$current_deflashing_assembly_location = (float)$customer_parts[0]->deflashing_assembly_location;
				$required_bom_qty =  $qty;

				if ($required_bom_qty > $current_deflashing_assembly_location) {
					$flag = 1;
					echo "Please add Deflashing  stock of Customer Part number : " . $customer_parts[0]->part_number . " , Required Qty :" . $required_bom_qty . "  and current Deflashing  stock is :" . $current_deflashing_assembly_location;
					echo "<br>";
				}
			} else {
				echo "Customer part not found in customer parts table: " . $customer_part_id;
				echo "<br>";
			}

			if ($flag != 0) {
			} else {


				$data = array(
					'shift_id' => $shift_id,
					"date" => $date,
					'customer_part_id' => $customer_part_id,
				);


				$routing_data = $this->Crud->read_data_where("deflashing_production", $data);

				if ($routing_data) {
					echo "<script>alert('already present');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {


					$data_insert = array(
						'shift_id' => $shift_id,
						'operator_id' => $operator_id,
						'qty' => $qty,
						'customer_part_id' => $customer_part_id,
						'production_hours' => $production_hours,

						'deflashing_operation_id' => $deflashing_operation_id,
						'date' => $date,


						"created_by" => $this->user_id,
						"created_date" => $this->current_date,
						"created_time" => $this->current_time,
						"day" => $this->date,
						"month" => $this->month,
						"year" => $this->year,
					);

					$inser_query = $this->Crud->insert_data("deflashing_production", $data_insert);

					if ($inser_query) {
						echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
					} else {
						echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
					}
				}
			}
		} else {
			echo "please add BOM data ";
		}
	}

	public function update_p_q_deflashing()
	{

		$id = $this->input->post('id');
		$qty = (int)$this->input->post('qty');
		$accepted_qty = $this->input->post('accepted_qty');
		$rejection_reason = $this->input->post('rejection_reason');
		$rejection_remark = $this->input->post('rejection_remark');
		$onhold_qty = (int)$this->input->post('onhold_qty');
		$customer_part_id = (int)$this->input->post('customer_part_id');


		$sum = (int)$accepted_qty + $onhold_qty;



		if ($sum <= $qty) {

			$customer_part_data = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
			$current_final_inspection_location = $customer_part_data[0]->final_inspection_location;
			$current_deflashing_assembly_location = $customer_part_data[0]->deflashing_assembly_location;
			$new_current_final_inspection_location = $accepted_qty + $current_final_inspection_location;
			$new_deflashing_assembly_location = $current_deflashing_assembly_location - $accepted_qty;

			if ($accepted_qty == 0 && $onhold_qty == 0) {
				$rejected_qty = $qty;
			} else if ($accepted_qty == 0 && $onhold_qty > 0) {
				$rejected_qty = $qty - $onhold_qty;
			} else if ($accepted_qty > 0 && $onhold_qty == 0) {
				$rejected_qty = $qty - $accepted_qty;
			} else {
				$rejected_qty = $qty - ($accepted_qty + $onhold_qty);
			}

			$customer_part  = $this->Crud->get_data_by_id("customer_part", "production_rejection", "part_number");
			$old_production_rejection = $customer_part[0]->production_rejection;
			$new_production_rejection = $old_production_rejection + $rejected_qty;
			$data_update_prodcutin = array(
				"production_rejection" => $new_production_rejection,
			);
			// print_r($data_update_prodcutin);
			$result1 = $this->Crud->update_data_column("customer_part", $data_update_prodcutin, "production_rejection", "part_number");

			$data23333 = array(
				'accepted_qty' => $accepted_qty,
				'rejected_qty' => $rejected_qty,
				'onhold_qty' => $onhold_qty,
				'rejection_reason' => $rejection_reason,
				'rejection_remark' => $rejection_remark,
				"status" => "completed"

			);
			$update = $this->Crud->update_data("deflashing_production", $data23333, $id);

			if ($update) {
				$update_data = array(
					'final_inspection_location' => $new_current_final_inspection_location,
					'deflashing_assembly_location' => $new_deflashing_assembly_location,
				);
				$update = $this->Crud->update_data("customer_part", $update_data, $customer_part_id);

				echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "error while updating";
			}
		} else {
			echo "miss matched qty";
			// echo "<script>alert('Qty Mis Matched please add again ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
	}


	public function add_deflashing_operation()
	{

		$data = array(
			'operation_id' => $this->input->post('operation_id'),
			'production_trg_qty' => $this->input->post('production_trg_qty'),
			'customer_part_id' => $this->input->post('customer_part_id'),
		);

		$inser_query = $this->Crud->insert_data("deflashing_operation", $data);

		if ($inser_query) {


			if ($inser_query) {
				echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Error while  Adding ,try again');document.location='" . $_SERVER['HTTP_REFERER'] . "s'</script>";
			}
		} else {
			echo "Error";
		}
	}

	public function add_molding_deflashing_assembly_location()
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

		$inser_query = $this->Crud->insert_data("deflashing_rqeust", $data);
		if ($inser_query) {
			echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
		}
		// echo "<script>alert('Added Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
	}

	
	public function deflashing_operation()
	{
		$data['deflashing_operation'] = $this->Crud->read_data("deflashing_operation");
		$data['operations'] = $this->Crud->read_data("operations");
		// $data['customer_part'] = $this->Crud->read_data("customer_part");
		$data['customer_parts_master'] = $this->CustomerPart->readCustomerParts();
		$this->getPage('deflashing_operation',$data);
	}


	public function deflashing_stock_transfer_click()
	{


		$molding_stock_transfer_id  = $this->uri->segment('2');
		$molding_stock_transfer_data = $this->Crud->get_data_by_id("deflashing_rqeust", $molding_stock_transfer_id, "id");
		$customer_part_data = $this->Crud->get_data_by_id("customer_part", $molding_stock_transfer_data[0]->customer_part_id, "id");
		if ($customer_part_data) {
			$customer_part_id = $customer_part_data[0]->id;
			$qty = (float)$molding_stock_transfer_data[0]->qty;
			$current_semi_finished_location = (float)$customer_part_data[0]->semi_finished_location;
			$current_deflashing_assembly_location = (float)$customer_part_data[0]->deflashing_assembly_location;

			$deflashing_assembly_location = (float)$molding_stock_transfer_data[0]->qty;
			$new_semi_finished_location =  $current_semi_finished_location - $deflashing_assembly_location;


			$new_deflashing_assembly_location = $deflashing_assembly_location + $current_deflashing_assembly_location;
			$data_update_child_part = array(
				"semi_finished_location" => $new_semi_finished_location,
				"deflashing_assembly_location" => $new_deflashing_assembly_location,
			);
			$data_update_child_part_molding_stock_transfer = array(
				"status" => "completed",
			);

			$result2 = $this->Crud->update_data("customer_part", $data_update_child_part, $molding_stock_transfer_data[0]->customer_part_id);

			$result3 = $this->Crud->update_data("deflashing_rqeust", $data_update_child_part_molding_stock_transfer, $molding_stock_transfer_id);
			$deflashing_bom_data = $this->Crud->get_data_by_id("deflashing_bom", $customer_part_id, "customer_part_id");
			$req_qty = 0;
			$flag = 0;
			if ($deflashing_bom_data) {
				foreach ($deflashing_bom_data as $oib) {
					$output_part_data = $this->SupplierParts->getSupplierPartById($oib->child_part_id);

					if ($output_part_data) {
						$actual_stock = $output_part_data[0]->stock;
						$req_qty = $qty * $oib->quantity;
						if ($req_qty > $actual_stock) {
							// $flag = $flag + 1;
							echo "Store Stock is less than require qty of : " . $output_part_data[0]->part_number . " on  child_part table , required " . $req_qty . ", and having " . $actual_stock . " qty in store stock <br>";
						}
					} else {
						echo "child part Not Found " . $oib->input_part_id . "<br>";
					}
				}

				if ($flag == 0) {

					foreach ($deflashing_bom_data as $oib) {
						$output_part_data = $this->SupplierParts->getSupplierPartById($oib->child_part_id);

						if ($output_part_data) {
							$actual_stock = $output_part_data[0]->stock;
							$current_deflashing_stock = $output_part_data[0]->deflashing_stock;

							$req_qty = $qty * $oib->quantity;

							$new_store_stock = $actual_stock - $req_qty;
							$new_deflashing_stock = $current_deflashing_stock + $req_qty;
							$update_data = array(
								'stock' => $new_store_stock,
								'deflashing_stock' => $new_deflashing_stock,
							);
							$update = $this->SupplierParts->updateStockById($update_data, $output_part_data[0]->id);
						} else {
							echo "part Not Found " . $$oib->child_part_id . "<br>";
						}
					}



					if ($result3) {
						echo "<script>alert('Stock Transfered successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
					}
				} else {
					echo "<br> Please add all above production qty";
					echo "<br><br><br><br><br><a href=" . $_SERVER['HTTP_REFERER'] . "> < Go Back</a>";
				}
			} else {
				echo "<script>alert('Stock Transfered successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		} else {
			echo "item part  id : " . $customer_part_data[0]->part_number . "Not Found in customer_part table Please try again ";
		}

		// $onhold_stock = $req_qty;
		// $data22 = array(
		// 	"stock" => $new_stock,
		// 	"onhold_stock" => $onhold_stock,
		// 	// "return_qty" => $return_qty,

		// );
	}

	public function deflashing_rqeust()
	{

		$role_management_data = $this->db->query('SELECT *  FROM `customer_parts_master` ');
		$data['customer_part'] = $role_management_data->result();
		$data['deflashing_rqeust'] = $this->Crud->read_data("deflashing_rqeust");

		// print_r($data['customer_part']);

		$this->getPage('deflashing_rqeust',$data);
	}

	public function addbom_deflashing()
	{

		$customer_part_id = $this->input->post('customer_part_id');
		$child_part_id = $this->input->post('child_part_id');
		$quantity = $this->input->post('quantity');
		$data = array(

			"customer_part_id" => $customer_part_id,
			"child_part_id" => $child_part_id,


		);
		$check = $this->Crud->read_data_where("deflashing_bom", $data);
		if ($check != 0) {
			echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$data = array(

				"customer_part_id" => $customer_part_id,
				"child_part_id" => $child_part_id,
				"quantity" => $quantity,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,

			);
			$result = $this->Crud->insert_data("deflashing_bom", $data);
			if ($result) {
				echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			} else {
				echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
	}


	public function deflashing_bom()
	{
		$data['customer_part_id'] = $this->uri->segment('2');
		$data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['customer_part_id'], "id");

		$data['child_part_list'] = $this->SupplierParts->readSupplierParts();
		$data['customer_part_list'] = $this->Crud->read_data("customer_part");
		// $data['bom_list'] = $this->Crud->read_data("bom");
		$data['bom_list'] = $this->Crud->get_data_by_id("deflashing_bom", $data['customer_part_id'], "customer_part_id");

		$this->getPage('deflashing_bom',$data);
	}
}
