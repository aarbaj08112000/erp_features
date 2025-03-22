<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class GlobalConfigController extends CommonController
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Kolkata');

		// $this->current_date = date('Y-m-d');
		// $this->current_time = date('h:i:s');

		$this->user_name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
		$this->role = $this->session->userdata('role');
		$this->current_date = date('d-m-Y');
		$this->current_time = date('h:i:s');
		$this->isAromAdmin = ($this->role=='AROM') ? 'true' : 'false';
		$date = new DateTime($this->current_date);

		$date->modify('-1 day');
		$this->yesterday_date = $date->format('d-m-Y');
		$this->yesterday_date_new = $date->format('Y-m-d');
		$d = date_parse_from_format("d-m-Y", $this->current_date);
		$this->date = $d["day"];
		$this->month = $d["month"];
		$this->year = $d["year"];
		$this->load->model('GlobalConfigModel');
	}
	
	private function getPage($viewPage,$viewData){
        //$this->loadView($this->getPath().$viewPage,$viewData);
		$this->loadView($viewPage,$viewData);
	}

	public function listconfigs()
	{
		checkGroupAccess("configs","list","Yes");

		if($this->isAromAdmin == 'false'){
			$criteria = array("ARMUserOnly" => 0);//get only those fields which can be edited by Customers
			$data['configurations'] = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
		}else { //get all those fields which ERP admin can configure.
			$data['configurations'] = $this->Crud->read_data("global_configuration");
		}

		$data['config_category'] = array_unique(array_column($data['configurations'], "category"));

		$data['isAromAdmin'] = $this->isAromAdmin;
		$this->loadView('admin/global_configuration', $data);
	}

	public function addConfig()
	{


		$label =$this->input->post('display_label');
		$name = $this->input->post('config_name');
		$value = $this->input->post('config_value');
		$note = $this->input->post('note');
		$forArom = $this->input->post('forAromOnly');
		$canModify = $this->input->post('canCustomerModify');
		$category = $this->input->post('config_category');
		
		if($forArom=='on') { $forArom = 1; } else { $forArom = 0;}
		if($canModify=='on') { $canModify = 1; } else { $canModify = 0;}
		
		$data = array(
			"displayLabel" => $label,
			"config_name" => $name,
			"config_value" => $value,
			"note" => $note,
			"updated_user" => $this->user_name,
			"ARMUserOnly" => $forArom,
			"canModify" => $canModify,
			"category" => $category
		);
		$success = 0;
        $messages = "Something went wrong.";
		$result = $this->Crud->insert_data("global_configuration", $data);
		if ($result) {
			$messages = "Configuration added successfully.";
			$success = 1;
			// $this->addSuccessMessage('Configuration added successfully.');
		} else {
			$messages = "Unable to add configuration. Please try again.";
			// $this->addErrorMessage('Unable to add configuration. Please try again.');
		}
		// $this->redirectMessage();
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}


	public function editConfig()
	{
		$upload_error = 0;
        $upload_data = [];
		$ret_arr = [];
		$msg = '';
		$success = 1;
        $id = $this->input->post('configID');
		$label =$this->input->post('display_label');
		$value = $this->input->post('config_value');
		$note = $this->input->post('note');
		$forArom = $this->input->post('forAromOnly');
		$canModify = $this->input->post('canCustomerModify');
		$category = $this->input->post('config_category');
		if($this->input->post("config_name") == "companyLogo"){
			if($_FILES['companyLogo']['name'] != ""){
	            $profileImageData =
	                $_FILES["companyLogo"]["name"] != ""
	                    ? $_FILES["companyLogo"]
	                    : [];
	            $config["upload_path"] = "dist/img/company_logo/";
	            $config["allowed_types"] = "jpg|png|jpeg|png";
	            $this->load->library("upload", $config);
	            $upload_error_msg = "";
	            if (!empty($profileImageData)) {
	                if (!$this->upload->do_upload("companyLogo")) {
	                    $upload_error_msg = $error = [
	                        "error" => $this->upload->display_errors(),
	                    ];
	                    $upload_error = 1;
	                } else {
	                    $upload_data = $this->upload->data();
	                }
	            }

	        }

	        if($upload_error == 0){
	        	$value = $upload_data['file_name'];
	        }else{
	        	$value = $this->input->post("old_val");
	        }

	        
		}

		
		if($this->input->post("config_type") == "file"){
			$folderPath = "dist/img/config_img/";
			if (!is_dir($folderPath) && $folderPath != "") {
				mkdir($folderPath, 0777, true);
			}
			if($_FILES['config_value']['name'] != ""){
	            $profileImageData =
	                $_FILES["config_value"]["name"] != ""
	                    ? $_FILES["config_value"]
	                    : [];
	            $config["upload_path"] = $folderPath;
	            $config["allowed_types"] = "jpg|png|jpeg|png";
	            $this->load->library("upload", $config);
	            $upload_error_msg = "";
	            if (!empty($profileImageData)) {
	                if (!$this->upload->do_upload("config_value")) {
	                    $upload_error_msg = $error = [
	                        "error" => $this->upload->display_errors(),
	                    ];
	                    $upload_error = 1;
	                } else {
	                    $upload_data = $this->upload->data();
	                }
	            }

	        }

	        if($upload_error == 0){
	        	$value = $upload_data['file_name'];
	        }

	        
		}
		if($this->input->post("config_name") == "SignatureImage"){

				if($_FILES['SignatureImage']['name'] != ""){
		            $profileImageData =
		                $_FILES["SignatureImage"]["name"] != ""
		                    ? $_FILES["SignatureImage"]
		                    : [];
		            $config["upload_path"] = "dist/img/signature_image/";
		            $config["allowed_types"] = "jpg|png|jpeg|png";
		            $this->load->library("upload", $config);
		            $upload_error_msg = "";
		            if (!empty($profileImageData)) {
		                if (!$this->upload->do_upload("SignatureImage")) {
		                    $upload_error_msg = $error = [
		                        "error" => $this->upload->display_errors(),
		                    ];
		                    $upload_error = 1;
		                } else {
		                    $upload_data = $this->upload->data();
		                }
		            }

		        }

		        if($upload_error == 0){
		        	$value = $upload_data['file_name'];
		        }else{
		        	$value = $this->input->post("old_val");
		        }
		    }
        	
        if($upload_error == 0){
			if($forArom=='on' || $forArom==1) { $forArom = 1; } else { $forArom = 0;}
			if($canModify=='on' || $canModify==1) { $canModify = 1; } else { $canModify = 0;}

			$data = array(
				"displayLabel" => $label,
				"config_value" => $value,
				"note" => $note,
				"updated_user" => $this->user_name,
				"ARMUserOnly" => $forArom,
				"canModify" => $canModify,
				"category" => $category
			);
			

			$result = $this->Crud->update_data_column("global_configuration", $data, $id, "id");
			if ($result) {
				// $this->addSuccessMessage('Configuration updated successfully.');
				$msg = 'Configuration updated successfully.';
			} else {
				// $this->addErrorMessage('Unable to update configuration. Please try again.');
				$msg = 'Unable to update configuration. Please try again.';
				$success = 0;
			}
			$data['isAromAdmin'] = $this->isAromAdmin;
		}else{
			$msg = "File type not valid.";
			$success = 0;
		}
		$ret_arr['messages'] = $msg;
		$ret_arr['success'] = $success;
		// $this->redirectMessage();
		echo json_encode($ret_arr);
		exit();
	}
	
	public function groupMaster(){
		checkGroupAccess("group_master","list","Yes");;
		$data['groups'] = $this->GlobalConfigModel->getGroupData();
		// pr($data,1);
		$this->loadView('admin/group_master', $data);
	}
	public function groupMenu(){
		$get_data = $this->input->get();
		$group_id = $get_data['id'];
		$data['group_id'] = $group_id;
		$group_details = $this->GlobalConfigModel->getGroupData($group_id);
		$data['group_details'] = $group_details[0];
		$data['groups_menu'] = $this->GlobalConfigModel->getGroupRightsData($group_id);
		$exist_menu_access_arr = [];
		foreach ($data['groups_menu'] as $key => $value) {
			$exist_menu_access_arr[$value['menu_master_id']] = $value;
		}
		$menu_data = $this->GlobalConfigModel->getAllMenuData();
		$data['groups_menu'] = [];

		foreach ($menu_data as $key => $value) {
			if(array_key_exists($value['menu_master_id'], $exist_menu_access_arr)){
				$groups_menu[$value['menu_category_id']][] = $exist_menu_access_arr[$value['menu_master_id']];
			}else{
				$groups_menu[$value['menu_category_id']][] = [
					"group_rights_id" => 0,
					"group_master_id" => $group_id,
					"menu_master_id" => $value['menu_master_id'],
					"list" => "No",
					"add" => "No",
					"update" => "No",
					"delete" => "No",
					"export" => "No",
					"import" => "No",
					"diaplay_name" => $value['diaplay_name'],
					"category_name" => $value['category_name'],
					"menu_category_id" => $value['menu_category_id']
				];
			}
		}
		// pr($groups_menu,1);
		$data['groups_menu'] = $groups_menu;
		$this->loadView('admin/group_master_menu', $data);
	}
	public function updateGroupMenuRight(){
		$post_data = $this->input->post();
		// pr($post_data,1);
		$menu_data = $post_data['menu'];
		$group_id = $post_data['group_id'];
		$access_data = ["list","add","update","export","delete",'import'];
		$group_menu_right = [];
		foreach ($menu_data as $key => $value) {
			$group_master_id = $value['group_master_id'];
			$menu_master_id = $value['menu_master_id'];
			$access_arr = array_keys($value['access']);
			$missing_access = (isset($value['access'])) ? array_diff($access_data, $access_arr) : $access_data;
			$update_arr = [];
			if(is_valid_array($value['access'])){
				$update_arr['group_master_id'] = $group_master_id;
				$update_arr['menu_master_id'] = $menu_master_id;
				foreach ($value['access'] as $key_val => $val) {
					$update_arr[$key_val] = $val;
				}
				foreach ($missing_access as $key_val => $val) {
					$update_arr[$val] = "No";
				}
				$group_menu_right[] = $update_arr;
			}
			
		}
		
		$success = 0;
        $messages = "Something went wrong.";
        // pr($group_menu_right,1);
		if(is_array($group_menu_right) && count($group_menu_right)){
			$this->GlobalConfigModel->deleteGroupRights($group_id);
			$affected_rows = $this->GlobalConfigModel->insertGroupRights($group_menu_right);
			if($affected_rows > 0){
				$group_ids = $this->session->userdata("groups");
				$group_ids = explode(",",$group_ids);
				if(in_array($group_id,$group_ids)){
					$group_rights = $this->GlobalConfigModel->getGroupRightData($group_ids,"");
					$this->session->set_userdata('group_rights_arr', base64_encode(json_encode($group_rights)));
				}
				$success = 1;
				$messages = "Group Right updated successfully.";
			}
		}else{
			$messages = "Please select group rights.";
		}
        $result['message'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function updateGroupMaster(){
		$post_data = $this->input->post();

		$update_arr = [
			"group_name" => $post_data['group_name'],
			"status" => $post_data['status']
		];
		$group_master_id = $post_data['group_master_id'];
		$affected_rows = $this->GlobalConfigModel->updateGroupMasterData($update_arr,$group_master_id);
		if($affected_rows > 0){
			$success = 1;
			$messages = "Group data updated successfully.";
			$menu_data = $this->GlobalConfigModel->getAllMenuData();
			$menu_arr = array_column($menu_data, "menu_master_id");
			$group_rights_data = $this->GlobalConfigModel->getGroupRightsData($group_master_id);
			$group_rights_arr = array_column($group_rights_data, "menu_master_id");
			$pending_menu = array_diff($menu_arr, $group_rights_arr);
			$group_rights_insert_arr = [];
			foreach ($pending_menu as $key => $value) {
				$group_rights_insert_arr[] = [
						"group_master_id" => $group_master_id,
						"menu_master_id" => $value,
						"list" => "No",
						"add" => "No",
						"update" => "No",
						"delete" => "No",
						"export" => "No"

					];
			}
			if(is_valid_array($group_rights_insert_arr)){
				$this->GlobalConfigModel->insertGroupRights($group_rights_insert_arr);
			}
			
		}
		$result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		
	}
	public function addGroupMaster(){
		$post_data = $this->input->post();
		$group_name = $post_data['group_name'];
		$group_code = $post_data['group_code'];
		$status = $post_data['status'];

		$dublicate_group_code = $this->GlobalConfigModel->checkGroupCodeExist($group_code);
		$dublicate_group_name = $this->GlobalConfigModel->checkGroupNameExist($group_name);
		$success = 0;
        $messages = "Something went wrong.";
		if(count($dublicate_group_code) > 0){
			$messages = "Group code already exist.";
		}else if(count($dublicate_group_name) > 0){
			$messages = "Group name already exist.";
		}else{
			$insert_date = [
				"group_name" => $group_name,
				"group_code" => $group_code,
				"status" => $status
			];
			$insert_id = $this->GlobalConfigModel->insertGroup($insert_date);
			if($insert_id > 0){
				// $menu_data = $this->GlobalConfigModel->getAllMenuData();
				// $group_rights_arr = [];
				// foreach ($menu_data as $key => $value) {
				// 	$group_rights_arr[] = [
				// 		"group_master_id" => $insert_id,
				// 		"menu_master_id" => $value['menu_master_id'],
				// 		"list" => "No",
				// 		"add" => "No",
				// 		"update" => "No",
				// 		"delete" => "No",
				// 		"export" => "No"

				// 	];
				// }
				// if(count($group_rights_arr) > 0){
				// 	$this->GlobalConfigModel->insertGroupRights($group_rights_arr);
				// }
				$messages = "Group added successfully.";
				$success = 1;
			}
		}
		$result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	/* Global Formate */
	public function globalFormateConfig(){
		checkGroupAccess("global_formate_config","list","Yes");
		$data['configurations'] = $this->Crud->read_data("global_formate_configuration");
		$data['isAromAdmin'] = $this->isAromAdmin;
		// pr($data,1);
		$this->loadView('admin/global_formate_configuration', $data);
	}
	public function edit_formate_config(){
		$success = 0;
        $messages = "Something went wrong.";
		$post_data = $this->input->post();
		$update_arr = [
			"display_label"=>$post_data['display_label'],
			"is_year_enable" => $post_data['is_year_enable'],
			"count_start_from" => $post_data['count_start_from'],
			"formate"=>$post_data['formate'],
			"formate_structure" => $post_data['formate_structure'],
			"status"=> $post_data['status'],
			"updated_by" => $this->user_id ,
			"updated_date" => date("Y-m-d H:i:s")
		];
		$update_id = $post_data['configID'];
		$result = $this->Crud->update_data_column("global_formate_configuration", $update_arr, $update_id, "id");
		if ($result) {
			$success = 1;
			$messages = "Formate Configuration updated successfully.";
			// $this->addSuccessMessage('Formate Configuration updated successfully.');
		} else {
			$messages = "Unable to update configuration. Please try again.";
			// $this->addErrorMessage('Unable to update configuration. Please try again.');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
	public function add_formate_config(){
		$success = 0;
        $messages = "Something went wrong.";
		$post_data = $this->input->post();
		$insert_arr = [
			"display_label"=>$post_data['display_label'],
			"config_name" => $post_data['config_name'],
			"is_year_enable" => $post_data['is_year_enable'],
			"count_start_from" => $post_data['count_start_from'],
			"formate"=>$post_data['formate'],
			"formate_structure" => $post_data['formate_structure'],
			"status"=> $post_data['status'],
			"arom_user_only"=>$post_data['forAromOnly'] == "on" ? 1 : 0 ,
			"acces_to_modify"=> $post_data['canCustomerModify'] == "on" ? 1 : 0,
			"added_by" => $this->user_id ,
			"added_date" => date("Y-m-d H:i:s")
		];
		// pr($insert_arr,1);
		$result = $this->Crud->insert_data("global_formate_configuration", $insert_arr);
		if ($result) {
			$messages = "Formate Configuration added successfully.";
			$success =1;
			// $this->addSuccessMessage('Formate Configuration added successfully.');
		} else {
			$messages = "Unable to update configuration. Please try again.";
			// $this->addErrorMessage('Unable to update configuration. Please try again.');
		}
		
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();

	}


}