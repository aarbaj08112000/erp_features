<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');
require_once(APPPATH . 'libraries/PHPExcel/IOFactory.php');

class GRNController extends CommonController
{

	const GRN_VIEW_PATH = "grn/";

	function __construct()
	{
		parent::__construct();
		$this->load->model('SupplierParts');
	}

	private function getPath()
	{
		return self::GRN_VIEW_PATH;
	}

	private function getPage($viewPage, $viewData)
	{
		$this->loadView($this->getPath() . $viewPage, $viewData);
	}


	public function inwarding_invoice()
	{
		$new_po_id = $this->uri->segment('2');
		$data['new_po_id'] = $this->uri->segment('2');
		$data['inwarding_data'] = $this->Crud->get_data_by_id("inwarding", $new_po_id, "po_id");
		$data['po_parts'] = $this->Crud->customQuery("SELECT pp.* FROM po_parts pp WHERE pp.po_id = '".$new_po_id."'");
		// $this->Crud->customQuery("SELECT pp.* FROM po_parts pp WHERE pp.po_id = '".$new_po_id."'");
		foreach ($data['po_parts'] as $key => $p) {
			$child_part_data = $this->Crud->get_data_by_id("child_part_master", $p->part_id, "child_part_id");
			$data['po_parts'][$key]->child_part_data = $child_part_data[0];

		}
		
		$data['client_list'] = $this->Crud->read_data_acc("client");
		$flag = 0;
		if ($data['po_parts']) {
			$final_po_amount = 0;
			$i = 1;
			foreach($data['po_parts'] as $p) {
				$child_part_data = $this->Crud->get_data_by_id(
					"child_part_master",
					$p->part_id,
					"child_part_id"
				);
				$qty = 0;
				$qty = $p->pending_qty;;
				if (true) {
					$flag = $flag + $qty;
				}
			}
		}
		$data['flag'] = $flag;
		// pr($data,1);
		// $this->getPage('inwarding_invoice', $data);
		$this->loadView('store/inwarding_invoice', $data);
	}
	public function delete_invoice(){
		$invoice_id = $this->input->post('invoice_id');
		$new_po_id = $this->input->post('new_po_id');
		$invoice_number = $this->input->post('invoice_number');
		$table_name = 'inwarding';
		$data = array(
			"id" => $invoice_id
		);
		$success = 0;
		$messages = "Something went wrong.";

		/* check subcon po or not */
			$po_data = $this->Crud->customQuery("SELECT po.* FROM new_po po WHERE po.id = '".$new_po_id."'");
			$is_sub_con_po = isset($po_data[0]->process_id) && $po_data[0]->process_id > 0 ? "Yes" : "No";
		/* check subcon po or not  */

		$result = $this->Crud->delete_data($table_name, $data);
		if ($result || true) {
			$success  = 1;
			$messages = "Invoice deleted successfully.";
			$po_parts = $this->Crud->customQuery("SELECT pp.* FROM po_parts pp WHERE pp.po_id = '".$new_po_id."'");
			$po_parts  =array_column($po_parts, "pending_qty","id");
			$grn_details= $this->Crud->customQuery("SELECT g.* FROM grn_details g WHERE g.invoice_number = '".$invoice_number."' AND g.po_number = '".$new_po_id."'");
			$po_part_update_arr = [];
			foreach ($grn_details as $key => $value) {
				$po_part_update_arr[] = [
					"id" => $value->po_part_id,
					"pending_qty" => $po_parts[$value->po_part_id]+$value->qty
				];
			}

			if(is_valid_array($po_part_update_arr)){
				$this->SupplierParts->updateBatchPoPartQtyByIds($po_part_update_arr);
				$data = array(
					"invoice_number" => $invoice_number
				);
				$result = $this->Crud->delete_data("grn_details", $data);
				
			}
			/* delete suncon master parts */
			if($is_sub_con_po == "Yes"){

				$data = array(
					"invoice_number" => $invoice_number
				);
				$result = $this->Crud->delete_data("subcon_po_inwarding", $data);
			}
			// echo "<script>alert('Record deleted successfully.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			// $this->addSuccessMessage('Record deleted successfully.');
		} else {
			$messages = "Unable to delete. Please try again.";
			// echo "<script>alert('Unable to delete. Please try again.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		}
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
	}
	public function update_inwarding_details()
	{
		$invoice_number =trim($this->input->post('invoice_number'));
		$invoice_date = $this->input->post('invoice_date');
		$invoice_id = $this->input->post('invoice_id');
		$po_id = $this->input->post('new_po_id');
		// pr($this->input->post(),1);
		//check whether invoice exists and check for supplier id
		$po1 = $this->Crud->customQuery("SELECT po.supplier_id FROM inwarding inward, new_po po 
		WHERE inward.invoice_number = '".$invoice_number."' 
		AND inward.po_id = po.id AND inward.id != ".$invoice_id);

		// check the supplier id for selected po
		$po2 = $this->Crud->customQuery("SELECT supplier_id FROM new_po 
		WHERE id = ".$po_id);

		$dataExist = false;
		foreach($po1 as $podata){
			if($podata->supplier_id == $po2[0]->supplier_id) {
				$dataExist=true;
			}
		}
		$success = 0;
		$messages = "Something went wrong.";
		if($dataExist==true) {
			$messages = "Invoice Number already exists for this supplier. Enter different Invoice Number."; 
			// echo "<script>alert('Invoice Number already exists for this supplier. Enter different Invoice Number. ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			$data = [
				"invoice_number" => $invoice_number,
				"invoice_date" => $invoice_date
			];
           $result = $this->Crud->update_data("inwarding", $data, $invoice_id);
           $messages = "Invoice updated successfully.";
           // echo "<script>alert('Invoice updated successfully. ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
           $success = 1;
		}
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
	}

	public function add_invoice_number()
	{
		$invoice_number =trim($this->input->post('invoice_number'));
		$invoice_date = $this->input->post('invoice_date');
		$po_id = $this->input->post('new_po_id');
		$grn_date = $this->input->post('grn_date');
		$vehicle_number = $this->input->post('vehicle_number');
		$transporter = $this->input->post('transporter');
		$deliveryUnit = $this->Unit->getSessionClientUnitName(); //trim($this->input->post('deliveryUnit'));

		//check whether invoice exists and check for supplier id
		$po1 = $this->Crud->customQuery("SELECT po.supplier_id FROM inwarding inward, new_po po
			WHERE inward.invoice_number = '".$invoice_number."'
			AND inward.po_id = po.id ");

			// check the supplier id for selected po
			$po2 = $this->Crud->customQuery("SELECT supplier_id FROM new_po
				WHERE id = ".$po_id);

				$dataExist = false;
				foreach($po1 as $podata){
					if($podata->supplier_id == $po2[0]->supplier_id) {
						$dataExist=true;
					}
				}

				if($dataExist==true) {
					$success = 0;
					$messages = "Invoice Number already exists for this supplier. Enter different Invoice Number.";
					// echo "<script>alert('Invoice Number already exists for this supplier. Enter different Invoice Number. ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$data = array(
						"invoice_number" => $invoice_number,
						"po_id" => $po_id,
						"invoice_date" => $invoice_date,
						"grn_date" => $grn_date,
						"vehicle_number" => $vehicle_number,
						"transporter" => $transporter,
						"delivery_unit" => $deliveryUnit,
						"created_dttm" => $this->current_dttm,
						"created_date" => $this->current_date,
						"created_month" => $this->month,
						"created_day" => $this->date,
						"created_year" => $this->year,
						"status" => "pending"
					);


					$result = $this->Crud->insert_data("inwarding", $data);
					if ($result) {
						$success = 1;
						$messages = "Invoice Number added successfully.";
						// $this->addSuccessMessage('Invoice Number added successfully.');
					} else {
						$success = 0;
						$messages = "Unable to add Invoice Number.";
						// $this->addErrorMessage('Unable to add Invoice Number.');
					}
					// $this->redirectMessage();
					
				}
				$return_arr['success']=$success;
					$return_arr['messages']=$messages;
					echo json_encode($return_arr);
					exit;


			}


			// public function add_invoice_number()
			// {
			//
			//     $invoice_number = trim($this->input->post('invoice_number'));
			//     $invoice_date = $this->input->post('invoice_date');
			//     $po_id = $this->input->post('new_po_id');
			//     $grn_date = $this->input->post('grn_date');
			//     $vehicle_number = $this->input->post('vehicle_number');
			//     $transporter = $this->input->post('transporter');
			//     $deliveryUnit = $this->Unit->getSessionClientUnitName();
			//
			//     // Check whether the invoice exists and check for supplier id
			//     $po1 = $this->Crud->customQuery("SELECT po.supplier_id FROM inwarding inward, new_po po
			//         WHERE inward.invoice_number = $invoice_number
			//         AND inward.po_id = po.id", array($invoice_number));
			//
			//     // Check the supplier id for selected po
			//     $po2 = $this->Crud->customQuery("SELECT supplier_id FROM new_po
			//         WHERE id = ?", array($po_id));
			//
			//     $dataExist = false;
			//     foreach ($po1 as $podata) {
			//         if ($podata->supplier_id == $po2[0]->supplier_id) {
			//             $dataExist = true;
			//             break;
			//         }
			//     }
			//
			//     if ($dataExist) {
			// 			$success = 0;
			// 			$messages = "Invoice Number already exists for this supplier. Enter a different Invoice Number.";
			//         // echo "<script>alert('Invoice Number already exists for this supplier. Enter a different Invoice Number.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			//     } else {
			//         $data = array(
			//             "invoice_number" => $invoice_number,
			//             "po_id" => $po_id,
			//             "invoice_date" => $invoice_date,
			//             "grn_date" => $grn_date,
			//             "vehicle_number" => $vehicle_number,
			//             "transporter" => $transporter,
			//             "delivery_unit" => $deliveryUnit,
			//             "created_dttm" => $this->current_dttm,
			//             "created_date" => $this->current_date,
			//             "created_month" => $this->month,
			//             "created_day" => $this->date,
			//             "created_year" => $this->year,
			//             "status" => "pending"
			//         );
			// 				pr($data,1);
			//         $result = $this->Crud->insert_data("inwarding", $data);
			// 				print_r($result);
			//         if ($result) {
			//             $success = 1;
			//             $messages = "Invoice Number added successfully.";
			//         } else {
			//             $success = 0;
			//             $messages = "Unable to add Invoice Number.";
			//         }
			//
			//         $return_arr['success'] = $success;
			//         $return_arr['messages'] = $messages;
			//         echo json_encode($return_arr);
			//         exit;
			//     }
			// }



			public function add_raw_material_inspection_report()
			{


				$data = array(
					'raw_material_inspection_master_id' => $this->input->post('raw_material_inspection_master_id'),
					'child_part_id' => $this->input->post('child_part_id'),
					'observation' => $this->input->post('observation'),
					'observation2' => $this->input->post('observation2'),
					'observation3' => $this->input->post('observation3'),
					'observation4' => $this->input->post('observation4'),
					'observation5' => $this->input->post('observation5'),
					'remark' => $this->input->post('remark'),
					'rej_qty' => $this->input->post('rej_qty'),
					'lot_qty' => $this->input->post('lot_qty'),
					'accepted_qty' => $this->input->post('accepted_qty'),
					'invoice_date' => $this->input->post('invoice_date'),
					'invoice_number' => $this->input->post('invoice_number'),
				);

				$insert = $this->Crud->insert_data("raw_material_inspection_report", $data);

				// if ($insert) {
				// 	$this->addSuccessMessage('Added Successfully.');
				// } else {
				// 	$this->addErrorMessage('Unable to perform operation.');
				// }
				// $this->redirectMessage();
				if ($insert) {
						$success = 1;
						$messages = "Added successfully.";
											} else {
						$success = 0;
						$messages = "Something went wrong.";
											}

					$return_arr['success']=$success;
					$return_arr['messages']=$messages;
					echo json_encode($return_arr);
					exit;


			}

			public function update_raw_material_inspection_master_new()
			{

				// pr("ok",1);
				$id = $this->input->post("id");
				$data = array(
					'observation' => $this->input->post('observation'),
					'observation2' => $this->input->post('observation2'),
					'observation3' => $this->input->post('observation3'),
					'observation4' => $this->input->post('observation4'),
					'observation5' => $this->input->post('observation5'),
					'remark' => $this->input->post('remark'),

				);

				$result = $this->Crud->update_data_column("raw_material_inspection_report", $data, $id, "id");

				if ($result) {
					$success = 1;
					$messages = "Updated Successfully.";
				} else {
					$success = 0;
					$messages = "Unable to perform operation.";
				}

				$return_arr['success']=$success;
				$return_arr['messages']=$messages;
				echo json_encode($return_arr);
				exit;


			}


			public function add_grn_qty()
			{
				$inwarding_id = $this->input->post('inwarding_id');
				$po_number = $this->input->post('new_po_id');
				$grn_number = $this->input->post('grn_number');
				$invoice_number = $this->input->post('invoice_number');
				$part_id = $this->input->post('part_id');
				$qty = $this->input->post('qty');
				$po_part_id = $this->input->post('po_part_id');
				$part_rate = $this->input->post('part_rate');
				$tax_id = $this->input->post('tax_id');
				$pending_qty = $this->input->post('pending_qty');
				$inwarding_price = ($part_rate * round($qty,2));
				$new_po_data = $this->Crud->get_data_by_id("new_po", $po_number, "id");
				if($new_po_data[0]->po_discount_type == "Part Level"){
					$part_data = $this->Crud->customQuery("
						SELECT part.*
						FROM po_parts part
						WHERE part.id = '".$po_part_id."' 
						AND part.po_id = ".$po_number);
					$part_discount = $part_data[0]->discount > 0 ? $part_data[0]->discount : 0; 
					$inwarding_price = $inwarding_price - $inwarding_price * $part_discount/100;
					$gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");
					$cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
					$sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
					$igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;
					if ($gst_structure[0]->tcs_on_tax == "no") {
						$tcs_amount =  (($inwarding_price * $gst_structure[0]->tcs) / 100);
					} else {
						$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $inwarding_price) * $gst_structure[0]->tcs) / 100);
					}
					$inwarding_price = (float)$inwarding_price + (float)$cgst_amount + (float)$sgst_amount + (float)$igst_amount + (float)$tcs_amount;
				}else if($new_po_data[0]->po_discount_type != "PO Level"){
					$gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");
					$cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
					$sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
					$igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;
					if ($gst_structure[0]->tcs_on_tax == "no") {
						$tcs_amount =  (($inwarding_price * $gst_structure[0]->tcs) / 100);
					} else {
						$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $inwarding_price) * $gst_structure[0]->tcs) / 100);
					}
					$inwarding_price = (float)$inwarding_price + (float)$cgst_amount + (float)$sgst_amount + (float)$igst_amount + (float)$tcs_amount;
				}
				
				
				
				

				$data = array(
					"inwarding_id" => $inwarding_id,
					"po_number" => $po_number,
					"invoice_number" => $invoice_number,
					"part_id" => $part_id,
					"qty" => round($qty,2),
					"po_part_id" => $po_part_id,
					"inwarding_price" => round($inwarding_price,2),
					"created_by" => $this->user_id,
					"created_date" => $this->current_date,
					"created_time" => $this->current_time,
					"created_day" => $this->date,
					"created_month" => $this->month,
					"created_year" => $this->year
				);

				$success = 0;
				$messages = "Somthing went wrong.";
				$result = $this->Crud->insert_data("grn_details", $data);
				if ($result) {
					$pending_qty =
					$data = array(
						"pending_qty" => $pending_qty - $qty,
					);
					$result = $this->Crud->update_data("po_parts", $data, $po_part_id);

					if ($result) {
						$success = 1;
						$messages = "Successfully Added";
					} else {
						// echo "none error po_parts update not found";
						$messages = "none error po_parts update not found";
					}
				} else {
					$messages = "Unable to Add";
					// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
				$result = [];
				$result['messages'] = $messages;
				$result['success'] = $success;
				echo json_encode($result);
				exit();
			}


			public function grn_complete_challan_process()
			{
				$inwarding_id = $this->input->post('inwarding_id');
				$po_number = $this->input->post('new_po_id');
				$grn_number = $this->input->post('grn_number');
				$invoice_number = $this->input->post('invoice_number');
				$part_id = $this->input->post('part_id');
				$qty = $this->input->post('qty');
				$po_part_id = $this->input->post('po_part_id');
				$part_rate = $this->input->post('part_rate');
				$tax_id = $this->input->post('tax_id');
				$pending_qty = $this->input->post('pending_qty');
				$inwarding_price = ($part_rate * round($qty,2));
				$gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");
				$cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
				$sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
				$igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;

				if ($gst_structure[0]->tcs_on_tax == "no") {
					$tcs_amount =  (($inwarding_price * $gst_structure[0]->tcs) / 100);
				} else {
					$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $inwarding_price) * $gst_structure[0]->tcs) / 100);
				}

				$inwarding_price = (float)$inwarding_price + (float)$cgst_amount + (float)$sgst_amount + (float)$igst_amount + (float)$tcs_amount;
				$success = 0;
        		$messages = "Something went wrong";
				$data = array(
					"inwarding_id" => $inwarding_id,
					"po_number" => $po_number,
					"invoice_number" => $invoice_number,
					"part_id" => $part_id,
					"qty" => round($qty,2),
					"po_part_id" => $po_part_id,
					"inwarding_price" => round($inwarding_price,2),
					"created_by" => $this->user_id,
					"created_date" => $this->current_date,
					"created_time" => $this->current_time,
					"created_day" => $this->date,
					"created_month" => $this->month,
					"created_year" => $this->year,
					"status" => "Challan_Completed"
				);
				$result = $this->Crud->insert_data("grn_details", $data);
				if ($result) {
					$pending_qty =
					$data = array(
						"pending_qty" => $pending_qty - $qty,
					);
					$result = $this->Crud->update_data("po_parts", $data, $po_part_id);

					if ($result) {
						$messages = "Successfully Added";
						$success = 1;
						// echo "<script>alert('Successfully Added');document.location='" . base_url('inwarding_details/') . $inwarding_id . "/" . $po_number . "'</script>";
					} else {
						$messages = "none error po_parts update not found";
					}
				} else {
					// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
					$messages = "Unable to Add";
				}
				$return_arr = [
					"messages" =>$messages,
					"success" => $success
				];
				echo json_encode($return_arr);
				exit();
			}

			public function edit_grn_qty()
			{
				$inwarding_id = $this->input->post('inwarding_id');
				$po_number = $this->input->post('new_po_id');
				$grn_number = $this->input->post('grn_number');
				$invoice_number = $this->input->post('invoice_number');
				$part_id = $this->input->post('part_id');
				$qty = $this->input->post('qty');
				$tax_id = $this->input->post('tax_id');
				$po_part_id = $this->input->post('po_part_id');
				$part_rate = $this->input->post('part_rate');
				$pending_qty = $this->input->post('pending_qty');

				$inwarding_price = (float)($part_rate * $qty);

				$gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");
				$cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
				$sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
				$igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;

				if ($gst_structure[0]->tcs_on_tax == "no") {
					$tcs_amount =  (($inwarding_price * $gst_structure[0]->tcs) / 100);
				} else {
					$tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $inwarding_price) * $gst_structure[0]->tcs) / 100);
				}

				$inwarding_price = (float)$inwarding_price + (float)$cgst_amount + (float)$sgst_amount + (float)$igst_amount + (float)$tcs_amount;

				$searchCriteria = array(
					"inwarding_id" => $inwarding_id,
					"po_number" => $po_number,
					"invoice_number" => $invoice_number,
					"part_id" => $part_id,
					"po_part_id" => $po_part_id,
				);

				$grn_details = $this->Crud->get_data_by_id_multiple("grn_details", $searchCriteria);

				if($grn_details){
					$old_qty = $grn_details[0]->qty;

					$update_data = array(
						"inwarding_id" => $inwarding_id,
						"po_number" => $po_number,
						"invoice_number" => $invoice_number,
						"part_id" => $part_id,
						"qty" => $qty,
						"po_part_id" => $po_part_id,
						"inwarding_price" => $inwarding_price,
						"created_by" => $this->user_id,
						"created_date" => $this->current_date,
						"created_time" => $this->current_time,
						"created_day" => $this->date,
						"created_month" => $this->month,
						"created_year" => $this->year,
					);

					$new_pending_qty = $pending_qty - ($qty - $old_qty );
					$success = 0;
					$messages = "Something went wrong.";
					$update_result = $this->Crud->update_data("grn_details", $update_data, $grn_details[0]->id);
					if ($update_result) {
						$data = array(
							"pending_qty" => $new_pending_qty,
						);

						$result = $this->Crud->update_data("po_parts", $data, $po_part_id);
						if ($result) {
							$success = 1;
							$messages = "Details updated.";
							// $this->addSuccessMessage('Details updated.');
						} else {
							$messages = "PO parts are not updated or not found.";
							//$this->addErrorMessage('PO parts are not updated or not found.');
						}
					} else {
						$messages = "Unable to update the details.";
						//$this->addErrorMessage('Unable to update the details.');
					}
				}else{
					$messages = "No GRN details found for this part.";
					// $this->addErrorMessage('No GRN details found for this part.');
				}

				$result = [];
				$result['messages'] = $messages;
				$result['success'] = $success;
				echo json_encode($result);
				exit();
			}


			public function generate_grn()
			{
				
				$inwarding_id = $this->input->post('inwarding_id');
				$status = $this->input->post('status');

				$latestSeqFormat = $this->Crud->customQuery("SELECT MAX(CAST(SUBSTRING_INDEX(grn_number, '/', -1) AS UNSIGNED)) AS max_grn_number
				FROM inwarding WHERE grn_number like '" . $this->getGrnSerialNo() . "%'");

				foreach ($latestSeqFormat as $p) {
					$currentSaleNo = $p->max_grn_number;
				}

				$inwarding_count = $currentSaleNo + 1;
				$grn_number = $this->getGrnSerialNo() . $inwarding_count;

				$data = array(
					"grn_number" => $grn_number,
					"status" => $status
				);


				$result = $this->Crud->update_data("inwarding", $data, $inwarding_id);
				$success = 0;
				$messages = "Something went wrong.";
				if ($result) {
					$success = 1;
					$messages = "Successfully Added";
					// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$messages = "Unable to Add";
					// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
				$result = [];
				$result['messages'] = $messages;
				$result['success'] = $success;
				echo json_encode($result);
				exit();
			}

			public function update_status_grn_inwarding()
			{
				$success = 0;
        		$messages = "Something went wrong.";
				$inwarding_id = $this->input->post('inwarding_id');
				$status = $this->input->post('status');
				// pr($this->input->post(),1);
				$data = array(
					"status" => $status
				);

				$result = $this->Crud->update_data("inwarding", $data, $inwarding_id);

				if ($result) {
					$success = 1;
					$messages = "Successfully updated.";
					// echo "<script>alert('Successfully updated.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$messages = "Unable to Add";
					// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
				// if ($result) {
				// 	$success = 1;
				// 	$messages = "Successfully updated.";
				// 	// $this->addSuccessMessage('Invoice Number added successfully.');
				// } else {
				// 	$success = 0;
				// 	$messages = "Unable to add Invoice Number.";
				// 	// $this->addErrorMessage('Unable to add Invoice Number.');
				// }
				// // $this->redirectMessage();
				$return_arr['success']=$success;
				$return_arr['messages']=$messages;
				echo json_encode($return_arr);
				exit;
			}

		}
