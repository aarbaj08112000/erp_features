<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');
require_once(APPPATH.'libraries/PHPExcel/IOFactory.php');
class ExportImportController extends CommonController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ExportImportModel');
        $this->unit = '';
        
    }

    // export 
    public function global_export()
	{

		$post_data = $this->input->post();

		$type = $post_data['export_type'];
		$export_data_arr = [];
		if($type == "customer_part_price"){
			$export_data_arr = $this->customerPartPriceExport($post_data);
		}


		if($export_data_arr['success'] == 1){
			$export_data_arr['file_name'] = strtoupper(str_replace(" ","_",trim($export_data_arr['export_data'][0][0]))."_PART_PRICE");
			$this->export_file($export_data_arr);
		}else{
			$this->session->set_userdata('export_message', $export_data_arr['message']);
			redirect('customer_master');
		}
		
	}

	function export_file($export_data = []) {
        $this->load->library("excel");
       
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        foreach ($export_data['export_columns'] as $key => $value) {
        	// pr($key);
        	$column = 0;
        	foreach ($value as $field) {
	            $object->getActiveSheet()->setCellValueByColumnAndRow($column, $key+1, $field);
	            $column++;
	        }
        }
        
        // pr($export_data['export_columns'],1);
        $highestColumn = $object->getActiveSheet()->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // Convert column letter to index

		for ($i = 0; $i < $highestColumnIndex; $i++) {
		    $column = PHPExcel_Cell::stringFromColumnIndex($i); // Convert index back to letter
		    $object->getActiveSheet()->getColumnDimension($column)->setAutoSize(TRUE);
		}
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$export_data['file_name'].".xls");
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        ob_end_clean();
        ob_start();
        $objWriter->save('php://output');


    }

	public function customerPartPriceExport($post_data = []){
		$customer_id = $post_data['customer_id_export'];
		$this->db->where("id",$customer_id);
		$customers = $this->Crud->read_data("customer");
		$customers = $customers[0];
		$this->db->where("customer_id",$customer_id);
		$customer_part = $this->Crud->read_data("customer_part");
		$role_management_data = $this->db->query('SELECT DISTINCT customer_master_id FROM `customer_part_rate`  ORDER BY `id` DESC');
		$data['customer_part_rate'] = $role_management_data->result();

		$customer_part_revision = [];
		foreach ($data['customer_part_rate'] as $poo ) {
			$data['customer_part_rate_data'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part_rate", $poo->customer_master_id, "customer_master_id");
			$data['po'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
			$data['customer_data'][$data['po'][$poo->customer_master_id][0]->customer_id] = $this->Crud->get_data_by_id("customer", $data['po'][$poo->customer_master_id][0]->customer_id, "id");
			$data['customer_part_data'][$data['po'][$poo->customer_master_id][0]->customer_part_id] = $this->Crud->get_data_by_id("customer_part_type", $data['po'][$poo->customer_master_id][0]->customer_part_id, "id");
			$data['customer_part_rate'][$poo->customer_master_id]->encoded_data = base64_encode(json_encode($data['po'][$poo->customer_master_id][0]));
            // $data['customer_part_rate_data'][$poo->customer_master_id]
            $data['customer_part_rate_data'][$poo->customer_master_id][0]->part_number = $data['po'][$poo->customer_master_id][0]->part_number;
            $data['customer_part_rate_data'][$poo->customer_master_id][0]->part_description = $data['po'][$poo->customer_master_id][0]->part_description;
            if ($data['customer_data'][$data['po'][$poo->customer_master_id][0]->customer_id][0]->id == $customer_id ){
        		$customer_part_revision[$data['po'][$poo->customer_master_id][0]->part_number] = [
        			"revision_no" => $data['customer_part_rate_data'][$poo->customer_master_id][0]->revision_no,
        			"revision_rate" => $data['customer_part_rate_data'][$poo->customer_master_id][0]->rate,
        			"part_number" => $data['po'][$poo->customer_master_id][0]->part_number,
        			"part_description" => $data['po'][$poo->customer_master_id][0]->part_description
        		];
        		
        	}
            
		}                         
		$export_data = [];
		$export_columns[] = array("Customer Name", "Part Number","Part Description","Part Rate","Revision Number","Revision Date", "Revision Remark","Old Revision Number","Old Revision Rate",);
		// pr($customer_part,1);
		foreach ($customer_part as $key => $value) {
			$revision_rate = $customer_part_revision[$value->part_number] != null ? $customer_part_revision[$value->part_number]['revision_rate'] : "";
			$revision_no = $customer_part_revision[$value->part_number] != null ? $customer_part_revision[$value->part_number]['revision_no']: "";
			$export_data_row = [$customers->customer_name,$value->part_number,$value->part_description,"","",date("d/m/Y"),"",$revision_no,$revision_rate];
			$export_data[] = $export_data_row;
			$export_columns[] = $export_data_row;
		}
		$success = 0;
		$message = "Customer part not found";
		if(count($export_data) > 0){
			$success = 1;
			$message = "Data found successfully";
		}

		$return_arr = [
			"success" => $success,
			"message" => $message,
			"export_columns" => $export_columns,
			"export_data" => $export_data 
		];

		return $return_arr;
	}


	// import
	public function global_import(){
		$post_data = $this->input->post();
		$type = $post_data['export_type'];

		if($type == "customer_part_price"){
			$return_arr = $this->import_customer_part_price($post_data);
		}
		echo json_encode($return_arr);
        exit();
	}

	public function import_customer_part_price($post_data){
	   $customer_id = $this->input->post('customer_id');
       $uploadedDoc = $this->input->post('uploadedDoc');

       //only valid types are allowed.
       $success = 0;
       $messages = "Something went wrong";
       if($this->isValidUploadFileType()=="false"){
            $message = "Only Excel sheets are allowed.";
       } else {
      		if (!empty($_FILES["uploadedDoc"]["name"])) {
        		$error;
				$inputFileName = $_FILES["uploadedDoc"]["tmp_name"];
					try {
						$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
						$objReader = PHPExcel_IOFactory::createReader($inputFileType);
						$objPHPExcel = $objReader->load($inputFileName);
						$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
						$flag = true;
						$i=0;

                        $EXCEL_IMPORT_CUSTOMER_NAME_COLUMN = 'A';
                        $EXCEL_IMPORT_ITEM_COLUMN = 'B';
                        $EXCEL_IMPORT_ITEM_DESC_COLUMN = 'C';
                        $EXCEL_IMPORT_PART_RATE = 'D';
                        $EXCEL_IMPORT_REVISION_NUMBER = 'E';
                        $EXCEL_IMPORT_REVISION_DATE = 'F';
                        $EXCEL_IMPORT_REVISION_REMARK = 'G';
                        $dublicate_item = [];
                        $item_arr = [];
                        foreach ($allDataInSheet as $key => $value) {
                        		if($key == 1){
                        			continue;
                        		}
                        		$rowNum = $key;
                                $errorThisRow=null; 
                                $errorCount;
                                $customer = empty($value[$EXCEL_IMPORT_CUSTOMER_NAME_COLUMN]) ? "" : trim($value[$EXCEL_IMPORT_CUSTOMER_NAME_COLUMN]);
                                $part_name = empty($value[$EXCEL_IMPORT_ITEM_COLUMN]) ? "": trim($value[$EXCEL_IMPORT_ITEM_COLUMN]);
                                $part_description = empty($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]) ? "" : trim($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]);
                                $part_rate = empty($value[$EXCEL_IMPORT_PART_RATE]) ?  "" : (float) $value[$EXCEL_IMPORT_PART_RATE];
                                $revision_number= empty($value[$EXCEL_IMPORT_REVISION_NUMBER]) ? "": trim($value[$EXCEL_IMPORT_REVISION_NUMBER]);
                                $revision_date = empty($value[$EXCEL_IMPORT_REVISION_DATE]) ? "": trim($value[$EXCEL_IMPORT_REVISION_DATE]);

                                $customer_val = empty($value[$EXCEL_IMPORT_CUSTOMER_NAME_COLUMN]) ? $errorThisRow =$errorThisRow." Customer": "";
                                $part_name_val = empty($value[$EXCEL_IMPORT_ITEM_COLUMN]) ? $errorThisRow = $errorThisRow." Part Number ," : "";
                                $part_description_val = empty($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]) ? $errorThisRow = $errorThisRow." Part description ,": "";
                                $part_rate_val = empty($value[$EXCEL_IMPORT_PART_RATE]) || !((float) $value[$EXCEL_IMPORT_PART_RATE] > 0) ? $errorThisRow =$errorThisRow." Part Rate should be greater than 0 ,": "";
                                $revision_number_val= empty($value[$EXCEL_IMPORT_REVISION_NUMBER]) ? $errorThisRow =$errorThisRow." Revision Number ,": "";

                                $format = "d/m/Y";
                                $inputDate = $value[$EXCEL_IMPORT_REVISION_DATE];
                                $dateTime = DateTime::createFromFormat($format, $inputDate);

                                $revision_date_val = empty($value[$EXCEL_IMPORT_REVISION_DATE]) ||  !($dateTime && $dateTime->format($format) === $inputDate) ? $errorThisRow =$errorThisRow." Revision Date format should be dd/mm/yyyy ,": "";

                                if($customer != "" && $customer != null && $part_name != "" && $part_name != null && $part_description != "" && $part_description != null && $part_rate > 0 && $part_rate != null && $revision_number != "" && $revision_number != null && $revision_date != "" && $revision_date != null){

                                	if(!in_array($part_name,$item_arr)){
	                                    //Start Date
	                                    $revision_date = $formattedDate = DateTime::createFromFormat('d/m/Y', $revision_date)->format('Y-m-d');

	                                    $inserdata[$i]['customer'] = $customer;
	                                    $inserdata[$i]['part_name'] = $part_name;
	                                    $inserdata[$i]['part_description'] = $part_description;
	                                    $inserdata[$i]['part_rate'] = $part_rate;
	                                    $inserdata[$i]['revision_number'] = $revision_number;
	                                    $inserdata[$i]['revision_date'] = $revision_date;
	                                    $inserdata[$i]['remark'] = $value[$EXCEL_IMPORT_REVISION_REMARK];
	                                    $i++;
	                                    $item_arr[] = $part_name;
                                    }else{
                                    	$dublicate_item[] = $part_name;
                                    }
                                }

                                if(!empty($errorThisRow)){
                                    $error = $error."<br>Row Number ".$rowNum." - Required Fields : ".$errorThisRow;
                                }
                                $dublicate_part_message = count($dublicate_item) > 0 ? "Dublicate Part : ".implode(",", array_unique($dublicate_item))."<br>" : "";
                        }
                        if(empty($error)){
                        	if(count($inserdata) > 0){
                        		$invalid_part = [];
                        		$part_revision_date = [];
                        		foreach ($inserdata as $key => $value) {

                        			$part_master_data = $this->db->query('
	                                    SELECT cp.part_number,cp.id as customer_part_id
	                                    FROM `customer_part` as cp
	                                    WHERE cp.customer_id = '.$customer_id.' AND cp.part_number = "'.$value['part_name'].'"'
	                                );
	                                $part_master_data= $part_master_data->result();
	                                if(!empty($part_master_data)){
	                                	$part_master_data = $part_master_data[0];
		                        		$part_revision_date[] = array(
											"rate" => $value['part_rate'],
											"customer_master_id" => $part_master_data->customer_part_id,
											"revision_no" => $value['revision_number'],
											"revision_date" => $value['revision_date'],
											"revision_remark" => $value['remark'],
											"uploading_document" => "",
											"created_id" => $this->user_id,
											"date" => $this->current_date,
											"time" => $this->current_time,
										);
	                                }else{
	                                	$invalid_part[] = $value['part_name'];
	                                }
                        			
	                        	}

                            	$invalid_item_message = count($invalid_part) > 0 ? "Invalid Part : ".implode(",", array_unique($invalid_part))."<br>" : "";
                            	$error_message = $dublicate_part_message.$invalid_item_message != "" ? "<br>".$dublicate_part_message.$invalid_item_message : "";
	                        	if(is_valid_array($part_revision_date)){
	                        		$check_insert = $this->ExportImportModel->batchInsert($part_revision_date,"customer_part_rate");
	                        		if($check_insert){
	                        			$success = 1;
	                        			$messages = "Part revison imported successfully ".$error_message;
	                        		}
	                        	}else{
	                        		$messages = "No data for Import".$error_message;
	                        	}
	                        	
                        	}else{
                        		$messages = "Please add data for import".$error_message;
                        	}
                        	

                        }else {
                            $messages = $error;
                        }  						  

					} catch (Exception $e) {
					//     die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					// . '": ' .$e->getMessage());
					}
				
			}         
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        return $result;
    }


   	


}