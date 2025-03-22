<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('CommonController.php');

class CustomerPartController extends CommonController
{

	const PART_VIEW_PATH = "";

	function __construct()
	{
		parent::__construct();
		$this->load->model('CustomerPart');
		$this->load->model('InhouseParts');

	}

	private function getPath()
	{
		return self::PART_VIEW_PATH;
	}

	private function getPage($viewPage, $viewData)
	{
		$this->loadView($this->getPath() . $viewPage, $viewData);
	}


	/*
	public function customer_part()
	{
		// $data['customer_part_list'] = $this->Crud->read_data("customer_part");
		$data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
		$data['customers'] = $this->Crud->read_data("customer");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$data['part_family'] = $this->Crud->read_data("part_family");

		$role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
		$data['customer_part_list'] = $role_management_data->result();

		// print_r($data['customer_part_list']);
		$this->load->view('header');
		// $this->load->view('customer_part', $data);
		$this->load->view('footer');
	}*/

	public function customer_part_by_id()
	{
		$customer_id = $this->uri->segment('2');
		$data['customer_id'] = $this->uri->segment('2');

		$data['customer_parts_master'] = $this->CustomerPart->readCustomerParts();
		$data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
		$data['customers'] = $this->Crud->read_data("customer");
		$data['gst_structure'] = $this->Crud->read_data("gst_structure");
		$data['part_family'] = $this->Crud->read_data("part_family");
		$data['uom'] = $this->Crud->read_data("uom");
		$role_management_data = $this->db->query('SELECT DISTINCT part_number,id,customer_id 
				FROM `customer_part` WHERE customer_id = ' . $customer_id . ' ');
		$data['customer_part_list'] = $role_management_data->result();

		$data['p_q'] = $this->Crud->read_data("p_q");
		$data['shifts'] = $this->Crud->read_data("shifts");
		$data['operator'] = $this->Crud->read_data("operator");
		$data['machine'] = $this->Crud->read_data("machine");
		$data['p_q'] = $this->Crud->read_data("p_q");

		$data['operations_bom'] = $this->Crud->read_data("operations_bom");
		$data['reject_remark'] = $this->Crud->read_data("reject_remark");

		if (self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()) {
			$data['TusharEngg'] = true; //show additional fields for Tushar
		}
		// pr($data['customer_part_list']);
		// pr($data['operations_bom']);
		if($data['customer_part_list']){
			foreach ($data['customer_part_list'] as $poo) {
				$data['po'][$poo->id] = $this->Crud->get_data_by_id("customer_part", $poo->id, "id");
				$data['gst_structure2'][$data['po'][$poo->id][0]->gst_id] = $this->Crud->get_data_by_id("gst_structure", $data['po'][$poo->id][0]->gst_id, "id");
				if ($data['operations_bom']) {
					foreach ($data['operations_bom'] as $s) {
						if ($s->customer_part_number == $data['po'][$poo->id][0]->part_number) {
							if ($s->output_part_table_name == "inhouse_parts") {
								$data['output_part_data'][$s->output_part_id] = $this->InhouseParts->getInhousePartOnlyById($s->output_part_id);
							} else {
								$data['output_part_data'][$s->output_part_id] = $this->Crud->get_data_by_id("customer_part", $s->output_part_id, "id");
							}
		
							$data['operations_bom_inputs_data'][$s->id] = $this->Crud->get_data_by_id("operations_bom_inputs", $s->id, "operations_bom_id");

							// pr($data['operations_bom_inputs_data'],1);
		
						}
					}
				}
			}
		}

	

		

		$data['customer_data'] = $this->Crud->get_data_by_id("customer", $customer_id, "id");
		$data['entitlements'] = $this->session->userdata['entitlements'];
		$global_configuration = $this->Crud->read_data("global_configuration");
		$global_configuration = array_column($global_configuration,"config_value","config_name");
		$data['exportSalesInvoive'] = isset($global_configuration['exportSalesInvoive']) && $global_configuration['exportSalesInvoive'] == "Yes";
		$this->getPage('customer/customer_part_by_id', $data);
	}


	public function addcustomerpart()
	{

		$customer_parts_master_id = $this->input->post('customer_parts_master_id');
		$customer_parts_master_data = $this->Crud->get_data_by_id('customer_parts_master', $customer_parts_master_id, 'id');

		$type = $this->input->post('type');
		$part_number = $customer_parts_master_data[0]->part_number;
		$part_desc = $customer_parts_master_data[0]->part_description;
		$revision_date = $this->input->post('revision_date');
		$revision_no = $this->input->post('revision_no');
		$revision_remark = $this->input->post('revision_remark');

		$customer_id = $this->input->post('customer_id');
		$customer_part_id = $this->input->post('customer_part_id');
		$hsn_code = trim($this->input->post('hsn_code'));
		$uom = $this->input->post('uom');
		$packaging_qty = $this->input->post('packaging_qty');
		$safety_stock = $this->input->post('safety_stock');
		$part_family = $this->input->post('part_family');
		$gst_id = $this->input->post('gst_id');
		$gross_weight = $this->input->post('gross_weight');
		$finish_weight = $this->input->post('finish_weight');
		$runner_weight = $this->input->post('runner_weight');
		$cycyle_time = $this->input->post('cycyle_time');
		$production_target_per_shift = $this->input->post('production_target_per_shift');
		$rm_grade = $this->input->post('rm_grade');
		$thickness = $this->input->post('thickness');
		$passivationType = $this->input->post('passivationType');
		$isservice = $this->input->post('isservice');
		$itemCode = $this->input->post('itemCd');

		$data = array(
			"part_number" => $part_number,
			"customer_id" => $customer_id,
		);
		$success = 0;
        $messages = "Something went wrong.";
		$check = $this->Crud->read_data_where("customer_part", $data);

		$customer_data_arr = $this->Crud->get_data_by_id("customer", $customer_id, "id");

		if ($check != 0) {
			// $data = array(
			// 	'errors' => $part_number . ' : This Part Number Already Present With This Customer, Please Enter Different Part Number',
			// );
			$messages = "This Part Number Already Present With This Customer, Please Enter Different Part Number";
			// $this->session->set_flashdata($data);
			// redirect($_SERVER['HTTP_REFERER']);
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
					// echo "no 1";
				}
			} else {
				$picture4 = '';
				// echo "no 2";
			}
			$data = array(
				"customer_parts_master_id" => $customer_parts_master_id,
				"part_number" => $part_number,
				"part_description" => $part_desc,
				"customer_id" => $customer_id,
				"revision_no" => $revision_no,
				"customer_part_id" => $customer_part_id,
				"revision_date" => $revision_date,
				"revision_remark" => $revision_remark,
				"revision_remark" => $picture4,
				"part_family" => $part_family,
				"hsn_code" => $hsn_code,
				"uom" => $uom,
				"packaging_qty" => $packaging_qty,
				"safety_stock" => $safety_stock,
				"gst_id" => $gst_id,
				"isservice" => $isservice,
				"type" => $type,
				"gross_weight" => $gross_weight,
				"finish_weight" => $finish_weight,
				"runner_weight" => $runner_weight,
				"cycyle_time" => $cycyle_time,
				"production_target_per_shift" => $production_target_per_shift,
				"rm_grade" => $rm_grade,
				"thickness" => $thickness,
				"passivationType" => $passivationType,
				"itemCode" => $itemCode,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);
			$global_configuration = $this->Crud->read_data("global_configuration");
			$global_configuration = array_column($global_configuration,"config_value","config_name");
			if(isset($global_configuration['exportSalesInvoive']) && $global_configuration['exportSalesInvoive'] == "Yes" && $customer_data_arr[0]->customerType == 'Expoter'){
				$data['drg_no'] = $this->input->post('drg_no');
				$data['rev_no'] = $this->input->post('rev_no');
				$data['moc'] = $this->input->post('moc');
			}

			$result = $this->Crud->insert_data("customer_part", $data);
			if ($result) {
				// $data = array(
				// 	'success' => $part_number . ' : This Part Number Added successfully',
				// );
				$success = 1;
				$messages = "This Part Number Added successfully";
				// $this->session->set_flashdata($data);
				// redirect($_SERVER['HTTP_REFERER']);
			} else {
				$messages = "Unable to Add";
				// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			}
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function updatecustomerpart_new()
	{


		$id = $this->input->post('id');

		$type = $this->input->post('type');
		$part_family = $this->input->post('part_family');
		$gst_id = $this->input->post('gst_id');
		$uom = $this->input->post('uom');
		$packaging_qty = $this->input->post('packaging_qty');
		$safety_stock = $this->input->post('safety_stock');
		$gross_weight = $this->input->post('gross_weight');
		$finish_weight = $this->input->post('finish_weight');
		$runner_weight = $this->input->post('runner_weight');
		$cycyle_time = $this->input->post('cycyle_time');
		$production_target_per_shift = $this->input->post('production_target_per_shift');
		$rm_grade = $this->input->post('rm_grade');

		$thickness = $this->input->post('thickness');
		$passivationType = $this->input->post('passivationType');
		$part_description = $this->input->post('upart_description');
		$hsn_code = trim($this->input->post('hsn_code'));
		$safety_stock = $this->input->post('safety_stock');
		$gst_id = $this->input->post('gst_id');

		$customer_id = $this->input->post('ucustomer_id');
		$customer_part_id = $this->input->post('ucustomer_part_id');
		$isservice = $this->input->post('isservice');
		$itemCode = $this->input->post('itemCd');
		$success = 0;
        $messages = "Something went wrong.";
        $data = array(
			"id" => $id,
		);
        $customer_part_arr = $this->Crud->get_data_by_id("customer_part", $id, "id");
        $customer_id = $customer_part_arr[0]->customer_id;
		if (false) {
			$messages = "Already Exists";
			// echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$data = array(
				"part_description" => $part_description,
				"type" => $type,
				"uom" => $uom,
				"packaging_qty" => $packaging_qty,
				"part_family" => $part_family,
				"gst_id" => $gst_id,
				"safety_stock" => $safety_stock,
				"gross_weight" => $gross_weight,
				"finish_weight" => $finish_weight,
				"runner_weight" => $runner_weight,
				"cycyle_time" => $cycyle_time,
				"production_target_per_shift" => $production_target_per_shift,
				"rm_grade" => $rm_grade,
				"thickness" => $thickness,
				"passivationType" => $passivationType,
				"hsn_code" => $hsn_code,
				"gst_id" => $gst_id,
				"isservice" => $isservice,
				"itemCode" => $itemCode
			);
			$global_configuration = $this->Crud->read_data("global_configuration");
			$global_configuration = array_column($global_configuration,"config_value","config_name");
			$customer_data_arr = $this->Crud->get_data_by_id("customer", $customer_id, "id");
			if(isset($global_configuration['exportSalesInvoive']) && $global_configuration['exportSalesInvoive'] == "Yes" && $customer_data_arr[0]->customerType == 'Expoter'){
				$data['drg_no'] = $this->input->post('drg_no');
				$data['rev_no'] = $this->input->post('rev_no');
				$data['moc'] = $this->input->post('moc');
			}
			$result = $this->Crud->update_data("customer_part", $data, $id);
			if ($result) {
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
	

}
