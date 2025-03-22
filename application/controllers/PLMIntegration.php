<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class PLMIntegration extends CommonController
{
	
	const VIEW_PATH = "plm/";
	

	function _construct()
    {
        parent::_construct();
    }

	private function getViewPath(){
		return self::VIEW_PATH;
	}

	private function getPage($viewPage,$viewData){
		$this->getHeaderPage();
		$this->load->view($this->getViewPath().$viewPage,$viewData);
		$this->load->view('footer.php');
	}
	
	public function customer_part_drawing()
	{
		$customer_id = $this->uri->segment('2');
		$data['customer_id'] = $customer_id;
		$search_part_id = $this->input->post('search_part_id');
		
		$data['customer_data'] = $this->Crud->get_data_by_id("customer",$customer_id,"id");

		/*$criteria = array(
			'customer_id' => $customer_id
		);*/
		$data['customer_part'] = $this->Crud->get_data_by_id("customer_part", $customer_id,"customer_id");
		
		$custom_query = 'SELECT DISTINCT drawing.customer_master_id FROM `customer_part_drawing` as drawing, `customer_part` as
				part  where part.customer_id = '.$customer_id.' AND part.id = drawing.customer_master_id  ORDER BY drawing.id DESC';
		$data['customer_part_drawing'] = $this->Crud->customQuery($custom_query);

		
		$data['search_part_id'] = $search_part_id;

		if ($data['customer_part_drawing']) {
			foreach ($data['customer_part_drawing'] as $key => $poo) {
				$data['customer_part_drawing_data'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part_drawing", $poo->customer_master_id, "customer_master_id");
				$data['po'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
				$data['customer_part_drawing'][$key]->encoded_data = base64_encode(json_encode(array_merge($data['customer_part_drawing_data'][$poo->customer_master_id],$data['po'][$poo->customer_master_id])));
				}
		}
		
		// $this->getPage('customer_part_drawing_by_id', $data);
		$data['entitlements'] = $this->session->userdata('entitlements');
		$this->loadView('customer/customer_part_drawing_by_id',$data);
	}
	

	public function customer_part_documents_by_id()
	{
		$search_part_id = $this->input->post('search_part_id');
		$customer_id = $this->uri->segment('2');
		$data['customer_id'] = $this->uri->segment('2');

		//$data['customers'] = $this->Crud->read_data("customer");
		//old
		//$data['customer_part'] = $this->Crud->read_data("customer_part");

		//new 
		$criteria = array(
			'customer_id' => $customer_id
		);
		$data['customer_part'] = $this->Crud->get_data_by_id_multiple_condition("customer_part", $criteria);
	
				$uniqueCheck = array(
					'customer_id' => $customer_id
				);
			$data['search_customer_part'] = $this->Crud->get_data_by_id_multiple_condition("customer_part", $uniqueCheck);


		
		if ($data['customer_part']) {
			foreach ($data['customer_part'] as $c) {
				if ($customer_id == $c->customer_id) {                                                                       
					$data['customer'][$c->customer_id] = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
				}
			}
		}
		//$data['search_customer_part'] = $this->Crud->get_data_by_id_multiple_condition("customer_part", $uniqueCheck);
		$data['search_part_id']=$search_part_id;
		$data['entitlements'] = $this->session->userdata('entitlements');
		// $this->getPage('customer_part_documents_by_id', $data);
		$this->loadView('customer/customer_part_documents_by_id', $data);

	}

	public function add_customer_drawing()
	{
		$customer_master_id = $this->input->post('customer_master_id');
		// $rate = $this->input->post('rate');
		$revision_no = $this->input->post('revision_no');
		$revision_date = $this->input->post('revision_date');
		$revision_remark = $this->input->post('revision_remark');
		$cad = $this->input->post('cad');
		$model = $this->input->post('model');
		// $uploading_document = $this->input->post('uploading_document');
		// $customer_part_id = $this->input->post('customer_part_id');
		$data = array(
			"customer_master_id" => $customer_master_id,
			// "revision_no" => $revision_no,
		);
		$check = $this->Crud->read_data_where("customer_part_drawing", $data);
		$success = 0;
        $messages = "Something went wrong.";
		if ($check != 0) {
			$messages = "Record already exists.";
			// $this->addErrorMessage('Record already exists.');
			// $this->redirectMessage();
		} else {

			if (!empty($_FILES['drawing']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['drawing']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('drawing')) {
					$uploadData = $this->upload->data();
					$drawing = $uploadData['file_name'];
				} else {
					$drawing = '';
					//echo "no 1";
				}
			} else {
				$drawing = '';
				//echo "no 2";
			}
			if (!empty($_FILES['cad']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['cad']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('cad')) {
					$uploadData = $this->upload->data();
					$cad = $uploadData['file_name'];
				} else {
					$cad = '';
			//		echo "no 1";
				}
			} else {
				$cad = '';
			//	echo "no 2";
			}
			if (!empty($_FILES['model']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['model']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('model')) {
					$uploadData = $this->upload->data();
					$model = $uploadData['file_name'];
				} else {
					$model = '';
			//		echo "no 1";
				}
			} else {
				$model = '';
			//	echo "no 2";
			}

			$data = array(
				"customer_master_id" => $customer_master_id,
				"revision_no" => $revision_no,
				"revision_date" => $revision_date,
				"revision_remark" => $revision_remark,
				"drawing" => $drawing,
				"cad" => $cad,
				"model" => $model,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);

			$result = $this->Crud->insert_data("customer_part_drawing", $data);
			if ($result) {
				$messages = "Record added.";
				$success = 1;
				// $this->addSuccessMessage('Record added.');
			} else {
				$messages  ="Failed to add record.";
				// $this->addErrorMessage('Failed to add record.');
			}
			// $this->redirectMessage();
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	
	public function add_customer_document()
	{
		$customer_master_id = $this->input->post('customer_master_id');
		$customer_id = $this->input->post('customer_id');
		$type = $this->input->post('type');
		$document_name = $this->input->post('document_name');
		$success = 0;
        $messages = "Something went wrong.";
		$check = 0;
		if ($check != 0) {
			$messages = "Record already exists.";
			// $this->addErrorMessage('Record already exists.');
			// $this->redirectMessage();
		} else {

			if (!empty($_FILES['document']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['document']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('document')) {
					$uploadData = $this->upload->data();
					$document = $uploadData['file_name'];
				} else {
					$document = '';
//					echo "no 1";
				}
			} else {
				$document = '';
//				echo "no 2";
			}


			$data = array(
				"customer_master_id" => $customer_master_id,
				"customer_id" => $customer_id,
				"type" => $type,
				"document_name" => $document_name,
				"document" => $document,

				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);
			// pr($data,1);
			$result = $this->Crud->insert_data("customer_part_documents", $data);
			if ($result) {
				$messages = "Record added.";
				$success = 1;
				// $this->addSuccessMessage('Record added.');
			} else {
				$messages = "Failed to add record.";
				// $this->addErrorMessage('Failed to add record.');
			}
			// $this->redirectMessage();
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function view_part_drawing_history()
	{
		$customer_master_id = $this->uri->segment('2');
		$customerid  = $this->uri->segment('3');
		$data['customerid'] = $customerid;
	
		$data['customer_data'] = $this->Crud->get_data_by_id("customer",$customerid,"id");
		$data['customer_part'] = $this->Crud->get_data_by_id("customer_part", $customer_master_id, "id");
		$data['customer_part_rate'] = $this->Crud->get_data_by_id("customer_part_drawing", $customer_master_id, "customer_master_id");
		$data['entitlements'] = $this->session->userdata('entitlements');
		// $this->getPage('view_part_drawing_history', $data);
		$this->loadView('customer/view_part_drawing_history',$data);
	}

	public function updatecustomerpartdrwing()
	{
		$customer_master_id = $this->input->post('customer_master_id');
		$revision_no = $this->input->post('revision_no');
		$revision_date = $this->input->post('revision_date');
		$revision_remark = $this->input->post('revision_remark');
		$cad = $this->input->post('cad');
		$model = $this->input->post('model');
		$data = array(
			"customer_master_id" => $customer_master_id,
			"revision_no" => $revision_no,
		);
		$success = 0;
        $messages = "Something went wrong.";
		$check = $this->Crud->read_data_where("customer_part_drawing", $data);
		if ($check != 0) {
			$messages = "Record already exists.";
			// $this->addErrorMessage('Record already exists.');
			// $this->redirectMessage();
		} else {

			if (!empty($_FILES['drawing']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['drawing']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('drawing')) {
					$uploadData = $this->upload->data();
					$drawing = $uploadData['file_name'];
				} else {
					$drawing = '';
					//echo "no 1";
				}
			} else {
				$drawing = '';
				//echo "no 2";
			}

			if (!empty($_FILES['cad']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['cad']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('cad')) {
					$uploadData = $this->upload->data();
					$cad = $uploadData['file_name'];
				} else {
					$cad = '';
					//echo "no 1";
				}
			} else {
				$cad = '';
				//echo "no 2";
			}


			if (!empty($_FILES['model']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['model']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('model')) {
					$uploadData = $this->upload->data();
					$model = $uploadData['file_name'];
				} else {
					$model = '';
					//echo "no 1";
				}
			} else {
				$model = '';
				//echo "no 2";
			}
		
			$data = array(
				"customer_master_id" => $customer_master_id,
				"revision_no" => $revision_no,
				"revision_date" => $revision_date,
				"revision_remark" => $revision_remark,
				"drawing" => $drawing,
				"cad" => $cad,
				"model" => $model,
				"created_id" => $this->user_id,
				"date" => $this->current_date,
				"time" => $this->current_time,
			);

			$result = $this->Crud->insert_data("customer_part_drawing", $data);
			if ($result) {
				$messages = "Record updated.";
				$success = 1;
				// $this->addSuccessMessage('Record updated.');
			} else {
				$messages = "Failed to update record.";
				// $this->addErrorMessage('Failed to update record.');
			}
			// $this->redirectMessage();
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function update_drawing()
	{
		$id = $this->input->post('id');

		$type = $this->input->post('type');
		$success = 0;
        $messages = "Something went wrong.";
		if (!empty($_FILES['file']['name'])) {
			$image_path = "./documents/";
			$config['allowed_types'] = '*';
			$config['upload_path'] = $image_path;
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) {
				$uploadData = $this->upload->data();
				$drawing = $uploadData['file_name'];
			} else {
				$drawing = '';
				//echo "no 1";
			}
		} else {
			$drawing = '';
			//echo "no 2";
		}

		$data = array(
			$type => $drawing,
		);

		
		$result = $this->Crud->update_data("customer_part_drawing", $data, $id);
		if ($result) {
			$messages = "Record updated.";
			$success = 1;
			// $this->addSuccessMessage('Record updated.');
		} else {
			$messages = "Failed to update record.";
			// $this->addErrorMessage('Failed to update record.');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		// $this->redirectMessage();
	}

	public function part_document_by_name() 
	{
		$customer_id = $this->uri->segment('2');
		$data['customer_id'] = $this->uri->segment('2');
		$part_id = $this->uri->segment('3');
		$data['part_id'] = $this->uri->segment('3');
		$type = $this->uri->segment('4');
		$data['type'] = $this->uri->segment('4');

		$data['customer_data'] = $this->Crud->get_data_by_id("customer", $customer_id, "id");

		$role_management_data = $this->db->query('SELECT * FROM `customer_part_documents` WHERE customer_id = ' . $customer_id . 
		' AND customer_master_id = ' . $part_id . ' AND type = "'.$type.'" ');
		$data['customer_part_doc'] = $role_management_data->result();
		$data['customer_part'] = $customer_part = $this->Crud->get_data_by_id("customer_part", $part_id, "id");
		$customer_arr = [];
		$key = 0;
		if ($customer_part) {
			foreach ($customer_part as $c) {
            	if ($customer_id == $c->customer_id) {
                	$customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                    if ($part_id == $c->id) {
                    	$customer_arr[$key] = $customer[0];
                    	$customer_arr[$key]->part_number = $c->part_number;
                    	$customer_arr[$key]->part_description = $c->part_description;
                    }
                }
            }
		}
		$data['entitlements'] = $this->session->userdata('entitlements');
		$data['customer_arr'] = $customer_arr;                                                                
		$this->loadView('sales/part_document_by_name', $data);
	}

	public function update_part_document_individual()
	{
		if (!empty($_FILES['document']['name'])) {
			$image_path = "./documents/";
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['document']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('document')) {
				$uploadData = $this->upload->data();
				$document = $uploadData['file_name'];
			} else {
				$document = '';
			}
		} else {
			$document = $this->input->post('old_img');
		}

		$id = $this->input->post('id');
		$document_name = $this->input->post('document_name');
	
		$data = array(
			"document" => $document,
			"document_name" => $document_name
		);
		$success = 0;
        $messages = "Something went wrong.";
		$query = $this->Common_admin_model->update("customer_part_documents", $data, "id", $id);

		if ($query) {
			$messages = "Document updated.";
			$success = 1;
			// $this->addSuccessMessage('Document updated.');
		} else {
			$messages = "Failed to update document.";
			// $this->addErrorMessage('Failed to update document.');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


}