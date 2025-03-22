<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');
require_once(APPPATH . 'libraries/PHPExcel/IOFactory.php');

class PlanningController extends CommonController
{

	const GRN_VIEW_PATH = "";

	function __construct()
	{
		parent::__construct();
		$this->load->model('SupplierParts');
		$this->load->model('CustomerPart');

	}

	private function getPath()
	{
		return self::GRN_VIEW_PATH;
	}

	private function getPage($viewPage, $viewData)
	{
		$this->loadView($this->getPath() . $viewPage, $viewData);
	}

	public function planing_data_month()
	{

		$data['financial_year'] = $this->uri->segment('2');
		$financial_year = $this->uri->segment('2');
		// $this->load->view('header');
		$this->loadView('customer/planing_data_month', $data);
		// $this->load->view('footer');
	}

	public function planing_data()
	{

		$customer_id = $this->input->post('customer_id');
		if (!empty($this->input->post('customer_id'))) {
			$data['customer_id'] = $this->input->post('customer_id');
			$customer_id = $this->input->post('customer_id');
		} else {
			//default list once page is loaded...
			$data['customer_id'] = $this->uri->segment('4');
			$customer_id = $this->uri->segment('4');
		}

		$financial_year = $this->uri->segment('2');
		$month = $this->uri->segment('3');
		$data['financial_year'] = $financial_year;
		$data['month'] = $month;
		$data['customer'] = $this->Crud->read_data("customer");
		if($customer_id === "ALL") {
			$arr = array(
				"financial_year" => $financial_year,
				"month" => $month,
				"clientId" =>  $this->Unit->getSessionClientId()
			);
			$data['planing_data'] = $this->Crud->get_data_by_id_multiple("planing", $arr);
		} else {
			$data['planing_data'] = $this->Crud->customQuery("SELECT p.* FROM planing p, customer_part cp
			WHERE p.clientId = ".$this->Unit->getSessionClientId()."
			AND cp.customer_id = ".$customer_id." 
			AND cp.id = p.customer_part_id AND p.financial_year = '".$financial_year."' AND p.month = '".$month."'");
		}
		
		$data['customer_id'] = $customer_id;

		if ($data['planing_data']) {
			foreach ($data['planing_data'] as $key => $t) {
				if ($data['month'] == $t->month) {

					$data['customer_part_data'][$t->customer_part_id] = $this->Crud->get_data_by_id("customer_part", $t->customer_part_id, "id");
					$data['customers_data'][$t->customer_part_id] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][$t->customer_part_id][0]->customer_id, "id");
					// pr($data['customers_data'][$t->customer_part_id],1);
					$data['customer_part_rate'][$t->customer_part_id] = $this->Crud->get_data_by_id("customer_part_rate", $t->customer_part_id, "customer_master_id");
					$customers_data[$customer_part_data[0]->customer_id] = $this->Crud->get_data_by_id("customer", $customer_part_data[$t->customer_part_id][0]->customer_id, "id");
					$planing_data_val= $this->Crud->get_data_by_id("planing_data", $t->id, "planing_id");
					// pr($planing_data_val[count($planing_data_val)-1]);
					$data['planing_data'][$key]->planing_data[0] = $planing_data_val[0];
					$month_number = $this->Common_admin_model->get_month_number($month);
					$year_number = (int) substr($financial_year, 3, strlen($financial_year));
					
					// $data['sales_invoice'][$t->customer_part_id] = $this->Crud->customQuery('SELECT sum(p.qty) as dispatched_qty FROM new_sales s, sales_parts p
					// 		WHERE s.clientId = '.$this->Unit->getSessionClientId().' 
					// 		 AND ((s.created_year = "'.$year_number.'" AND s.created_month > "4") 
     //     					OR (s.created_year = "'.$year_number.'" AND s.created_month < "3"))
					// 		AND s.status = "lock"
					// 		AND p.part_id = '.$t->customer_part_id.'
					// 		AND s.id = p.sales_id
					// 		GROUP BY s.customer_part_id');
						$sales_invoice_data = $this->Crud->customQuery('SELECT s.*,p.qty as dispatched_qty FROM new_sales s, sales_parts p
							WHERE s.clientId = '.$this->Unit->getSessionClientId().' 
							 AND ((s.created_year = "'.$year_number.'" AND s.created_month > "4") 
         					OR (s.created_year = "'.($year_number+1).'" AND s.created_month < "3"))
							AND s.status = "lock"
							AND p.part_id = '.$t->customer_part_id.'
							AND s.id = p.sales_id
							');
						foreach ($sales_invoice_data as $key => $value) {
							if($value->created_month == $month_number){
								$data['sales_invoice'][$t->customer_part_id][] = $value;
							}
						}

					}

					

				
			}
		}
		$data['segment_2'] =$this->uri->segment('2');
		$data['segment_3'] =$this->uri->segment('3');
		// pr($data['planing_data'],1);
		// $this->load- >view('header');
		// $this->load->view('planing_data', $data);
		// $this->load->view('footer');
		$this->loadView('customer/planing_data', $data);

	}

	public function get_customer_parts_for_planning()
	{
		$customer_id = $this->input->post('id');
		$customer_parts = $this->Crud->get_data_by_id("customer_part", $customer_id, 'customer_id');
		echo '<select>Select Part Number / Description';
		if ($customer_parts) {
			foreach ($customer_parts as $value) {
					echo '<option value="' . $value->id . '">' . $value->part_number. ' / ' . $value->part_description . '</option>';
			}
		} else {
			echo '<option value="">Select</option>';
		}
		echo '</select>';
	}

	public function add_planning_data()
	{
		$customer_part_id = $this->input->post('customer_part_id');
		$month_id = $this->input->post('month_id');
		$schedule_qty = $this->input->post('schedule_qty');
		$financial_year = $this->input->post('financial_year');
		$data1 = array(
			"financial_year" => $financial_year,
			"month" => $month_id,
			"customer_part_id" => $customer_part_id,
			"clientId" => $this->Unit->getSessionClientId()
		);
		$success = 0;
		$message = 'Something went wrong.';
		$planing_data = $this->Crud->get_data_by_id_multiple("planing", $data1);
		if ($planing_data) {
			$this->addWarningMessage('<br>Plan already added for this month and year, please try with another part.');
			$this->redirectMessage();
		} else {
			$data222 = array(
				"financial_year" => $financial_year,
				"month" => $month_id,
				"customer_part_id" => $customer_part_id,
				"shortage_qty" => $this->date //what is this ??????????????
			);

			$arr = array(
				'customer_part_id' => $customer_part_id
			);

			$bom_data = $this->Crud->get_data_by_id_multiple("bom", $arr);
			if ($bom_data) {
				$result_data_main = $this->Crud->insert_data("planing", $data222);
				foreach ($bom_data as $b) {
					$child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
					$actual_stock = $child_part_data[0]->stock;
					$bom_qty = $b->quantity;
					$required_qty = $schedule_qty * $bom_qty;
					$shortage_qty = $required_qty - $actual_stock;
					$data = array(
						"planing_id" => $result_data_main,
						"child_part_id" => $b->child_part_id,
						"bom_qty" => $bom_qty,
						"schedule_qty" => $schedule_qty,
						"required_qty" => $required_qty,
						"shortage_qty" => $shortage_qty,
						"actual_stock" => $actual_stock,
						"financial_year" => $financial_year,
						"month" => $month_id,
					);

					$result = $this->Crud->insert_data("planing_data", $data);
				}
				if ($result) {
					$success = 1;
					$message = 'Plan sucessfully added.';
				} else {
					$message = 'Unable to Add,please check bom and price data';
				}
			} else {
				$message = 'Unable to Add, please check bom and price data';
			}
			// $this->redirectMessage();
		}
		$return_arr = array(
	        'message' => $message,
	        'success' => $success
	    );

	    echo json_encode($return_arr);
	    exit();
	}
	
	public function add_planning_fg_stock()
	{
		$customer_part_id = $this->input->post('customer_part_id1');
		$fg_stock = $this->input->post('fg_stock');
		// $production_date = $this->input->post('production_date');
		// $month = $this->input->post('month');
		
		$customer_data = $this->CustomerPart->getCustomerPartById($customer_part_id);
		
		$data = array(
			"fg_stock" => $fg_stock + $customer_data[0]->fg_stock,
		);
		
		$result = $this->CustomerPart->updateStockById($data, $customer_part_id);
		if ($result) {
			$this->addSuccessMessage('Updated Sucessfully');
		} else {
			$this->addErrorMessage('Failed to add FG details.');
		}
		$this->redirectMessage();
	}

	public function view_planing_data()
	{

		$planing_id = $this->uri->segment('2');
		$data['planing_id'] = $planing_id;
		$data['customer_id'] = $this->uri->segment('3');
		
		$planning_data =  $this->SupplierParts->getPlanningViewData($planing_id);
		
		$data['planing_data'] = $planning_data;
		$data['financial_year'] = $planning_data[0]->financial_year;
		$data['month'] = $planning_data[0]->month;
		// pr($data,1);
		$this->loadView('reports/view_planning_data',$data);
	}

	public function update_planning_data()
	{
		$customer_part_id = $this->input->post('cust_part_id');
		$customer_id = $this->input->post('customer_id');
		$month_id = $this->input->post('month_id');
		$schedule_qty = $this->input->post('schedule_qty');
		$financial_year = $this->input->post('financial_year');
		$planing_id = $this->input->post('planing_id');
		$data1 = array(
			"financial_year" => $financial_year,
			"month" => $month_id,
			"customer_part_id" => $customer_part_id,
			"clientId" =>  $this->Unit->getSessionClientId()
		);
		$planing_data = $this->Crud->get_data_by_id_multiple("planing", $data1);
		$success = 0;
        $messages = "Something went wrong.";
		if ($planing_data) {
			$arr = array(
				'customer_part_id' => $customer_part_id
			);

			$bom_data = $this->Crud->get_data_by_id_multiple("bom", $arr);
			if ($bom_data) {
				foreach ($bom_data as $b) {
					$child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
					$actual_stock = $child_part_data[0]->stock;
					$bom_qty = $b->quantity;
					$required_qty = $schedule_qty * $bom_qty;
					$shortage_qty = $required_qty - $actual_stock;
					$data = array(
						"planing_id" => $planing_data[0]->id,
						"child_part_id" => $b->child_part_id,
						"bom_qty" => $bom_qty,
						"schedule_qty" => $schedule_qty,
						"required_qty" => $required_qty,
						"shortage_qty" => $shortage_qty,
						"actual_stock" => $actual_stock,
						"financial_year" => $financial_year,
						"month" => $month_id,
					);
					$result = $this->Crud->update_data("planing_data", $data, $planing_id);
					
				}
				if ($result) {
					$messages = "Plan sucessfully updated.";
					$success = 1;
					// $this->addSuccessMessage('Plan sucessfully updated.');
				} else {
					$messages = "Unable to update,please check bom and price data";
					// $this->addErrorMessage('Unable to update,please check bom and price data');
				}
			} else {
				$messages = "Unable to update, please check bom and price data";
				// $this->addErrorMessage('Unable to update, please check bom and price data');
			}
			
		}else{
			$messages = "No details found to update. Please try again.";
			// $this->addWarningMessage('No details found to update. Please try again.');
		}
		$result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		// $this->redirectMessage('planing_data/'.$financial_year.'/'.$month_id.'/'.$customer_id);
	}

	public function view_all_child_parts_schedule()
	{
		if (!empty($this->input->post('customer_id'))) {
			$data['customer_id'] = $this->input->post('customer_id');
			$customer_id = $this->input->post('customer_id');
		} else {
			$data['customer_id'] = $this->uri->segment('4');
			$customer_id = $this->uri->segment('4');
		}
		$financial_year = $this->uri->segment('2');
		$month = $this->uri->segment('3');
		$data['financial_year'] = $financial_year;
		$data['month'] = $month;
		
		/*		-- Make sure these indexes are in place
				-- CREATE INDEX idx_child_part_master ON child_part_master(child_part_id, id);
				-- CREATE INDEX idx_child_part_stock ON child_part_stock(childPartId, clientId);
		*/
		$role_management_data = $this->db->query('
				SELECT cp.id, cpm.id as cpm_id, cp.part_number, cp.part_description, cps.stock, cpm.part_rate
				FROM child_part cp
				INNER JOIN child_part_master cpm ON cp.id = cpm.child_part_id
				LEFT JOIN child_part_stock cps ON cp.id = cps.childPartId AND cps.clientId = '.$this->Unit->getSessionClientId().'
				INNER JOIN (
					SELECT child_part_id, MAX(id) AS max_id
					FROM child_part_master
					GROUP BY child_part_id
				) max_cpm 
					ON cpm.child_part_id = max_cpm.child_part_id 
					AND cpm.id = max_cpm.max_id
				ORDER BY cpm.id DESC');

		$data['child_part_master'] = $role_management_data->result();
		// pr($this->db->last_query(),1);
		$child_part_master = $data['child_part_master'];
		foreach ($child_part_master as $key=>$t) {
		    $subtotal=0;
		    $array = array("child_part_id" => $t->id, "financial_year" => $financial_year, "month" => $month);
		    $planing_data = $this->Crud->get_data_by_id_multiple_condition("planing_data", $array);
		    $req_qty = 0;
		    if ($planing_data) {
		        foreach ($planing_data as $pd) {
		            $schedule_qty_2 = $pd->schedule_qty_2;
		            $schedule_qty = $pd->schedule_qty;
		            $net_schedule = 0;

		            if ($schedule_qty_2 != 0) {
		                $net_schedule = $schedule_qty_2 - $schedule_qty;
		                $req_qty = $req_qty + $pd->required_qty + ($net_schedule * $pd->bom_qty);
		            }
		            else {
		                $req_qty = $req_qty + ($pd->schedule_qty * $pd->bom_qty);
		            }
		        }
		    }
		    $child_part_master[$key]->req_qty = $req_qty;
		    $child_part_master[$key]->subtotal = $subtotal = $t->part_rate * $req_qty;
		    $child_part_master[$key]->total = $total + $subtotal;
		    $child_part_master[$key]->net_mrp_req = $req_qty - $t->stock;
		}
		$data['child_part_master'] = $child_part_master ;
		// pr($data['planing_data'],1);
		// $this->load->view('header');
		// $this->load->view('view_all_child_parts_schedule', $data);
		// $this->load->view('footer');
		// pr($data,1);
		$this->loadView('customer/view_all_child_parts_schedule', $data);

	}

	function planning_export_customer_part()
    {
        $this->load->library("excel");
        $customer_id = $this->input->post('customer_id');
        $financial_year =  $this->input->post('financial_year');
        $month =  $this->input->post('month');

		$object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("Sr No", "Financial Year", "Month", "Customer", "Part Number", "Part Description", "Qty");
        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $role_management_data = $this->db->query('SELECT *   FROM `customer_part` WHERE customer_id = ' . $customer_id . '  ');
        $customer_parts = $role_management_data->result();

        $customer = $this->Crud->get_data_by_id("customer", $customer_id, "id");

        if ($customer_parts) {
            $excel_row = 2;
            $ii = 1;
            foreach ($customer_parts as $p) {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $financial_year);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $month);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $customer[0]->customer_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $p->part_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $p->part_description);
                $excel_row++;
                $ii++;
            }
            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$customer[0]->customer_name."_Plan_".$month.".xls");
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {
			$this->addWarningMessage('No Customer Parts found.');
			$this->redirectMessage();
        }
    }

	public function import_customer_planning(){
		$customer_id = $this->input->post('customer_id');
		$uploadedDoc = $this->input->post('uploadedDoc');
 		$success = 0;
	    $message = 'Something went wrong.';
		//only valid types are allowed.

		if($this->isValidUploadFileType()=="false"){
			$message = "Only Excel sheets are allowed.";
			 // $this->addErrorMessage("Only Excel sheets are allowed.");
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
						 $i=1;
 
						 foreach ($allDataInSheet as $value) {						
							 // Check if the row is empty
								 if (!empty(array_filter($value))) {
								 if($flag) {
									 $flag =false;
									 continue;
								 }
 
								 $rowNum = $i+1;
								 $errorThisRow=null; 
								 $errorCount;

								 $srNo = empty($value['A']) ? $errorThisRow =$errorThisRow." Sr. No. ,": trim($value['A']);
								 $financialYear_data = empty($value['B']) ? $errorThisRow =$errorThisRow." Financial Year ,": trim($value['B']);
								 $month_data = empty($value['C']) ? $errorThisRow = $errorThisRow." Month ," : trim($value['C']);
								 $customer_data = empty($value['D']) ? $errorThisRow = $errorThisRow." Customer ,": trim($value['D']);
								 $part_num_data = empty($value['E']) ? $errorThisRow =$errorThisRow." Part Number ,": trim($value['E']);
								 $part_desc_data = empty($value['F']) ? $errorThisRow =$errorThisRow." Part Description ,": trim($value['F']);
								 $schedule_qty_data = !is_numeric($value['G']) ? $errorThisRow =$errorThisRow." Qty " : $value['G'];
								
								if(!empty($errorThisRow)){
									$error = $error."<br>Sr.No.".$srNo." - Required Fields : ".$errorThisRow;
								}
								 $inserdata[$i]['srNo'] = $srNo;
							 	 $inserdata[$i]['financialYear_data'] = $financialYear_data;
							 	 $inserdata[$i]['month_data'] = $month_data;
								 $inserdata[$i]['customer_data'] = $customer_data;
								 $inserdata[$i]['part_num_data'] = $part_num_data;
								 $inserdata[$i]['part_desc_data'] = $part_desc_data;
								 $inserdata[$i]['schedule_qty_data'] = $schedule_qty_data;
								
								 $i++;
							 }
						 }
						 if(empty($error)){
							 //there are no errors so lets move ahead with executing the file.
							 foreach($inserdata as $po_item) {
											 // use the po number and see whether it exists if yes use it 
											 $part_check = array(
												"customer_id" => $customer_id,
												"part_number" => $po_item['part_num_data'],
												"part_description" => $po_item['part_desc_data']
											);

											$customer_part = $this->Crud->customQuery(
												"SELECT p.id FROM `customer_part` p , `customer` c
													where p.customer_id =  ".$customer_id."
													AND c.customer_name = '".$po_item['customer_data']."'
													AND p.customer_id = c.id
													AND p.part_number = '".$po_item['part_num_data']."'");
													//AND p.part_description = '".$po_item['part_desc_data']."'");
											
											if(empty($customer_part)) {
												$partMessage = "<br>Part No ".$po_item['part_num_data']." not available, refer record Sr.No. : ".$po_item['srNo'];
											}else {
												//got the part and all the details..
												$plan_update = array(
													"financial_year" => $po_item['financialYear_data'],
													"month" => $po_item['month_data'],
													"customer_part_id" => $customer_part[0]->id,
													"clientId" =>  $this->Unit->getSessionClientId()
												);
												
												$planing_data = $this->Crud->get_data_by_id_multiple("planing", $plan_update);
												if ($planing_data) {
													$partMessage = $this->planning_data_exists($po_item,$customer_part,$planing_data);
												}else{
													$partMessage = $this->planning_data_create($po_item,$customer_part);
												}

											}
											 if(!empty($partMessage)){
												 $error = $error.$partMessage;
											 }
							 }
							 if($error){
							 	$message = $error;
								 // $this->addErrorMessage($error);
							 }else{
							 	$success = 1;
							 	$message = "Data imported successfully.";
								 // $this->addSuccessMessage("Data imported successfully.");
							 }
 
						 } else {
						 	$message = $error;
							 // $this->addErrorMessage($error);
						 }   
 
					 } catch (Exception $e) {
						//  die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					 // . '": ' .$e->getMessage());
						 $message = $e->getMessage();
					 }
				 
				 }
			 }
		$return_arr = array(
	        'message' => $message,
	        'success' => $success
	    );

	    echo json_encode($return_arr);
	    exit();
		 
			
	}

	public function planning_data_exists($po_item, $customer_part,$planing_data) {
			//plan data already present so let's update the records...
			$arr = array('customer_part_id' => $customer_part[0]->id);
			$bom_data = $this->Crud->get_data_by_id_multiple("bom", $arr);
			$schedule_qty = $po_item['schedule_qty_data'];

		if ($bom_data) {
			foreach ($bom_data as $b) {
				$child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
				$actual_stock = $child_part_data[0]->stock;
				$bom_qty = $b->quantity;
				$required_qty = $schedule_qty * $bom_qty;
				$shortage_qty = $required_qty - $actual_stock;
				$data = array(
					//"planing_id" => $planing_data[0]->id,
					"child_part_id" => $b->child_part_id,
					"bom_qty" => $bom_qty,
					"schedule_qty" => $schedule_qty,
					"required_qty" => $required_qty,
					"shortage_qty" => $shortage_qty,
					"actual_stock" => $actual_stock,
					"financial_year" => $po_item['financialYear_data'],
					"month" => $po_item['month_data']
				);
				//$result = $this->Crud->update_data("planing_data", $data, $planing_data[0]->id);
				$result = $this->Crud->update_data_column("planing_data", $data, $planing_data[0]->id, "planing_id");
			}
			if (!$result) {
				$partMessage = '<br>Unable to update,please check bom and price data for record Sr.No. :'.$po_item['srNo'];
			}
		} else {
			$partMessage = '<br>Unable to update, bom not avaialble for record Sr.No. :'.$po_item['srNo'];
		}
		return $partMessage;
	}

	public function planning_data_create($po_item, $customer_part) {
		// add new planning data as record is not present...
		$plan_add = array(
			"financial_year" => $po_item['financialYear_data'],
			"month" => $po_item['month_data'],
			"customer_part_id" => $customer_part[0]->id,
			"shortage_qty" => $this->date //what is this ??????????????
		);
		$schedule_qty = $po_item['schedule_qty_data'];
		$arr = array('customer_part_id' => $customer_part[0]->id);
		$bom_data = $this->Crud->get_data_by_id_multiple("bom", $arr);
		if ($bom_data) {
					$result_data_main = $this->Crud->insert_data("planing", $plan_add);
					foreach ($bom_data as $b) {
						$child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
						$actual_stock = $child_part_data[0]->stock;
						$bom_qty = $b->quantity;
						$required_qty = $schedule_qty * $bom_qty;
						$shortage_qty = $required_qty - $actual_stock;
						$data = array(
							"planing_id" => $result_data_main,
							"child_part_id" => $b->child_part_id,
							"bom_qty" => $bom_qty,
							"schedule_qty" => $schedule_qty,
							"required_qty" => $required_qty,
							"shortage_qty" => $shortage_qty,
							"actual_stock" => $actual_stock,
							"financial_year" => $po_item['financialYear_data'],
							"month" => $po_item['month_data'],
						);
		
						$result = $this->Crud->insert_data("planing_data", $data);
					}
					if (!$result) {
						$partMessage = '<br>Unable to add, please check bom and price data for record Sr.No. :'.$po_item['srNo'];
					}
				} else {
					$partMessage = '<br>Unable to add, bom not avaialble for record Sr.No. :'.$po_item['srNo'];
				}
		return $partMessage;
	}

	/* 
	Update schedule qty 2 
	public function update_schedule_qty()
	{
		$id = $this->input->post('id');
		$schedule_qty_2 = $this->input->post('schedule_qty_2');


		// 	"contractor_code" => $number,
		// );
		// $check = $this->Crud->read_data_where("contractor", $data);
		// if ($check != 0) {
		// 	echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		// } else {
		$data = array(
			"schedule_qty_2" => $schedule_qty_2,

		);
		$result = $this->Crud->update_data_column("planing_data", $data, $id, "planing_id");
		if ($result) {
			echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			echo "<script>alert('Error 410 :  Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		//}
	} */


	public function planning_shop_order_details()
	{
		checkGroupAccess("planning_shop_order_details","list","Yes");
		$filter_month = $this->input->post('filter_month');
		$filter_year = $this->input->post('filter_year');
		$selected_customer = $this->input->post('selected_customer');
		
		if (empty($filter_month)) {
			$filter_month = $this->month;
		}
		if (empty($filter_year)) {
			$filter_year = $this->year;
		}

		if (!empty($selected_customer)) {
			if($selected_customer === "ALL") {
				$data['planing_data'] = $this->Crud->customQuery("SELECT c.customer_name, cp.part_number, cp.part_description, p.*, EXTRACT(MONTH FROM shop_date) as shop_month, 
				EXTRACT(YEAR FROM shop_date) as shop_year
				FROM planning_shop_order p, 
					customer_part cp, customer c
					WHERE cp.id = p.customer_part_id
					AND cp.customer_id = c.id
					AND p.clientId = ".$this->Unit->getSessionClientId()." 
					AND EXTRACT(MONTH FROM shop_date) = ".$filter_month."
					AND EXTRACT(YEAR FROM shop_date) = ".$filter_year);

			} else {
				$data['planing_data'] = $this->Crud->customQuery("SELECT c.customer_name, cp.part_number, cp.part_description, p.*, EXTRACT(MONTH FROM shop_date) as shop_month, 
				EXTRACT(YEAR FROM shop_date) as shop_year
				FROM planning_shop_order p, 
					customer_part cp, customer c
					WHERE cp.customer_id = ".$selected_customer." 
					AND cp.id = p.customer_part_id
					AND cp.customer_id = c.id
					AND p.clientId = ".$this->Unit->getSessionClientId()." 
					AND EXTRACT(MONTH FROM shop_date) = ".$filter_month."
					AND EXTRACT(YEAR FROM shop_date) = ".$filter_year);
			}
		}

		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
		
		$data['customer'] = $this->Crud->read_data("customer");
		$data['selected_customer'] = $selected_customer;
		$data['filter_year'] = $filter_year;
		$data['filter_month'] = $filter_month;
		// $this->load->view('header');
		// $this->load->view('planning_shop_order_list', $data);
		// $this->load->view('footer');
		$this->loadView('customer/planning_shop_order_list',$data);
	}

	public function add_planning_shop_order()
	{
		$customer_part_id = $this->input->post('customerPartId');
		$schQty = $this->input->post('scheduleQty');
		$shopDate = $this->input->post('shop_date');
		
		//Get the total quantity for shop order month,year to cross check it.
		$total_consumed_qty = $this->Crud->customQuery("SELECT sum(scheduleQty) as total FROM 
			`planning_shop_order`
			WHERE customer_part_id = ".$customer_part_id."
			AND shop_month = date_format('".$shopDate."','%c')
			AND shop_year = EXTRACT(YEAR FROM '".$shopDate."')
			GROUP BY customer_part_id");

		//Get the planned schedule qty for specific year-month
		$month_planned_qty = $this->Crud->customQuery("SELECT pd.schedule_qty 
		FROM planing_data pd, planing p
		WHERE p.customer_part_id = ".$customer_part_id."
		AND pd.planing_id = p.id
		AND pd.month = UPPER(date_format('".$shopDate."','%b'))
		AND pd.financial_year = CONCAT('FY-',EXTRACT(YEAR FROM '".$shopDate."'))
		GROUP BY p.customer_part_id");
		
		$pending_qty = $month_planned_qty[0]->schedule_qty - $total_consumed_qty[0]->total;
		
		if($schQty > $pending_qty) {
			$this->addErrorMessage('Shop order quantity can not be more than months schedule quantity. Pending quantity is '.$pending_qty);
		}else{
			$sql = "SELECT shop_no FROM planning_shop_order WHERE shop_no like '" . $this->getShopOrderSerialNo() . "%' order by id desc LIMIT 1";
			$latestSeqFormat = $this->Crud->customQuery($sql);
			foreach ($latestSeqFormat as $p) {
				$currentSaleNo = $p->shop_no;
			}

			$count_1 = substr($currentSaleNo, strlen($this->getShopOrderSerialNo())) + 1;
			$so_number = $this->getShopOrderSerialNo() . $count_1;

			/* 
			old code 
			$count = $this->db->query('SELECT MAX(id) AS MAINSUM FROM planning_shop_order
			 WHERE shop_month >= 04 and shop_year = '.$this->getStartYear().' || shop_month >=1 and shop_year = '..$this->getEndYear())->result();
			$count_1 = ($count[0]->MAINSUM + 1);		
			$so_number = $this->getShopOrderSerialNo().$count_1;
			*/

			$insert_data = array(
				"shop_no" => $so_number,
				"customer_part_id" => $customer_part_id,
				"shop_date" => $shopDate,
				"shop_month" => date('m', strtotime($shopDate)),
				"shop_year" => date('Y', strtotime($shopDate)),
				"scheduleQty" => $schQty
			);
		
			$result = $this->Crud->insert_data("planning_shop_order", $insert_data);
			if ($result) {
				$this->addSuccessMessage('Shop order added sucessfully.');
			} else {
				$this->addErrorMessage('Failed to add Shop order. Please try again.');
			}
		}

		
		$this->redirectMessage();
	}


	

}
