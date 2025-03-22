<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('CommonController.php');

class EWayBillController extends CommonController {

 function _construct()
    {
        parent::_construct();
    }
	  
    function index() {     
        $this->load->view('test');   
    }
	 
	function getBaseClientGSTNo(){
		$this->load->model('GSTCommon');
		return $this->GSTCommon->getBaseClientGSTNo();
	}
	
	function isProduction(){
		$this->load->model('GSTCommon');
		return $this->GSTCommon->isProduction();
	}
	
  function getEwayBillURL() {
		$this->load->model('GSTCommon');
		return $this->GSTCommon->getEwayBillURL();
	}
	
	function getXConnectorAuthToken() {
		$this->load->model('GSTCommon');
    	return $this->GSTCommon->getXConnectorAuthToken();
	}

	function echoToTriage($str){
		 $this->load->model('GSTCommon');
		 // $this->GSTCommon->echoToTriage($str);
	 }

	/**
   * Generate Eway Bill
   */
  public function generate_EwayBill()	{
		$this->echoToTriage("<br> Generate Eway Bill Request");
		$new_sales_id = $this->input->post('new_sales_id');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		);
	
		$new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
		$customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

		//get client data based on unit selection
        $client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
        //get shipping details based on new sales data like customer or consignee address..
        $shipping_data = $this->getShippingDetails($new_sales_data,$customer_data);

		$einvoice_res_data = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $new_sales);
		
		$po_parts_data = $this->Crud->get_data_by_id("sales_parts", $new_sales_id, "sales_id");
		$transporter_data = $this->Crud->get_data_by_id("transporter", $new_sales_data[0]->transporter_id, "id");
	
		
		$issdata = $einvoice_res_data[0]->iss; //TO-DO : what to do with this ?
		
		$transMode	= $this->input->post('transMode');
		$transporterId = $this->input->post('transporterId');
		$vehicleNo = $this->input->post('vehicleNo');
		$distance = $this->input->post('distance');
		$transporter = $this->Crud->get_data_by_id("transporter", $transporterId, "id");
		
		$this->echoToTriage("<br>TransMode : ". $transMode. " <br>vehicleNo: ".$vehicleNo."<br>distance : ". $distance. " <br>transDocNo: ".$transDocNo.'<br>Transporter ID: '.$transporter[0]->transporter_id);
		
		$this -> load-> model('EwayBill');
		$token = $this-> EwayBill -> authentication($new_sales_id);
		
		if($token) {
			
			$url=$this->getEwayBillURL();
			$XConnectorAuthToken=$this->getXConnectorAuthToken();
			
			$Authorization='Bearer '.$token;         
			$action='GENEWAYBILL';
			
			
			$actualAllItemsArr = array();
			$all_final_totals = 0;
			$all_cgst_amounts = 0;
			$all_sgst_amounts = 0;
			$all_igst_amounts = 0;
			$all_tcs_amounts = 0;
			$total_assAmt = 0;
			$total_igstAmt = 0;
			$total_cgstAmt = 0;
			$total_sgstAmt = 0;
			$total_totItemVal = 0;
		
				$i = 1;
				foreach ($po_parts_data as $ps) {
							  $actualIemsArr = array();
							 
							  $child_part_datas = $this->Crud->get_data_by_id("customer_part", $ps->part_id, "id");
							  $gst_structure_datas = $this->Crud->get_data_by_id("gst_structure", $ps->tax_id, "id");
							  
							  $unsortedHSN = array();
							  $hsn_codes = $child_part_datas[0]->hsn_code;
							  $isServc = $child_part_datas[0]->isservice;
							  $isInterState = false; //means only IGST is applicable so show it accordingly
							  
							  if ((int)$gst_structure_datas[0]->igst === 0) {
									$gsts = (int)$gst_structure_datas[0]->cgst + (int)$gst_structure_datas[0]->sgst;
									$cgsts = (int)$gst_structure_datas[0]->cgst;
									$sgsts = (int)$gst_structure_datas[0]->sgst;
									$tcss = (float)$gst_structure_datas[0]->tcs;
									$igsts = 0;
									$total_gst_percentages = $cgsts + $sgsts;
							  } else {
									$gsts = (int)$gst_structure_datas[0]->igst;
									$tcss = (float)$gst_structure_datas[0]->tcs;
									$cgsts = 0; 
									$sgsts = 0;
									$igsts = $gsts;
									$total_gst_percentages = $igsts;
									$isInterState = true;
							  }

							  $subtotal =  $ps->total_rate - $ps->gst_amount;
							  
							  $total_rate_old = $rate;
							  $rate = round($subtotal / $ps->qty,2);
							  $row_total =(float) $ps->total_rate+(float)$ps->tcs_amount;
							  $final_po_amount = (float)$final_po_amount + (float)$row_total;

							  $gst_amounts = ($gsts * $rate) / 100;
							  $final_amounts = $gst_amounts + $rate;
							  $final_row_amounts = $final_amounts * $ps->qty;

							  // $final_total = $final_total + $final_row_amount;
							  $actual_indv_totalAmt = $ps->qty * $rate;
							  $all_final_totals = $all_final_totals + $actual_indv_totalAmt;
							
							  $all_cgst_amounts = $all_cgst_amounts + $ps->cgst_amount;
							  $all_sgst_amounts = $all_sgst_amounts + $ps->sgst_amount;
							  $all_igst_amounts = $all_igst_amounts + $ps->igst_amount;
							  $all_tcs_amounts = $all_tcs_amounts + $ps->tcs_amount;
							
							  /*if ($gst_structure_datas[0]->tcs_on_tax == "no") {
									$all_tcs_amounts =  $all_tcs_amounts + (($actual_indv_totalAmt * $tcss) / 100);
							  } else {
									//$all_tcs_amounts =  $all_tcs_amounts + ((($all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $actual_indv_totalAmt) * $tcss) / 100);
									$all_tcs_amounts =  $all_tcs_amounts + ((((float)(($actual_indv_totalAmt * $cgsts) / 100) + (float)(($actual_indv_totalAmt * $sgsts) / 100) + (float)$all_igst_amounts + (float)$actual_indv_totalAmt) * $tcss) / 100);
							  }*/
							  
								$discount = 0; //Not defined as of now
								$totAmt = number_format((float)$actual_indv_totalAmt, 2, '.', '');	
								//AssAmt: Taxable Value (Total Amount -Discount)
								$assAmt =  number_format((float)($actual_indv_totalAmt - $discount), 2, '.', '');
								$igstAmt = $ps->igst_amount; //number_format((($actual_indv_totalAmt * $igsts) / 100), 2, '.', '');
								$cgstAmt = $ps->cgst_amount; //number_format((($actual_indv_totalAmt * $cgsts) / 100), 2, '.', '');
								$sgstAmt = $ps->sgst_amount;//number_format((($actual_indv_totalAmt * $sgsts) / 100), 2, '.', '');	
								
								$total_assAmt = $total_assAmt + $assAmt;
								$total_igstAmt = $total_igstAmt + $igstAmt;
								$total_cgstAmt = $total_cgstAmt + $cgstAmt;
								$total_sgstAmt = $total_sgstAmt + $sgstAmt;
								
								//$actualIemsArr['slNo'] = $i;
								$actualIemsArr['productName'] = $child_part_datas[0]->part_number;
								$actualIemsArr['productDesc'] = $child_part_datas[0]->part_description;
								$actualIemsArr['hsnCode'] = $child_part_datas[0]->hsn_code; 		
								$actualIemsArr['quantity'] = $ps->qty;								
								$actualIemsArr['qtyUnit'] = $ps->uom_id;							
								//$actualIemsArr['unitPrice'] = $rate;
								//$actualIemsArr['discount'] = $discount;				
								//$actualIemsArr['preTaxVal'] = 0;
								//$actualIemsArr['assAmt'] = $assAmt;
								$actualIemsArr['gstRt'] = $total_gst_percentages; 
								$actualIemsArr['igstRate'] = $igsts;				
								$actualIemsArr['cgstRate'] = $cgsts;					
								$actualIemsArr['sgstRate'] = $sgsts;
								$actualIemsArr['cessRate'] = 0;
								$actualIemsArr['cessNonAdvol'] = 0;
								$actualIemsArr['taxableAmount'] = $assAmt;
								
								//$totItemVal = number_format(($assAmt + $igstAmt + $cgstAmt + $sgstAmt), 2, '.', '');
								$total_totItemVal = $total_totItemVal + $totItemVal;
								//$actualIemsArr['totItemVal'] = $totItemVal; 
								//$actualIemsArr['orgCntry'] = "IN";
								array_push($actualAllItemsArr,$actualIemsArr);
						$i++;
				}
				
			
			$dynamicData=
			array (
				  'action' => 'GENEWAYBILL',
				  'data' => 
				  array (
					'supplyType' => 'O',								//HardCoded	 - Outward
					'subSupplyType' => '1',								//HardCoded  - Supply 
					'subSupplyDesc' => '',								//HardCoded  - Needed if subSupplyType is of Others type
					'docType' => 'INV',									//HardCoded	 - Tax Invoice
					'docNo' => $new_sales_data[0]->sales_number,
					'docDate' => $new_sales_data[0]->created_date, 		//'17/04/2023',	
					
					'fromGstin' => $this->getBaseClientGSTNo(),				//$client_data[0]->gst_number,
					'fromTrdName' => $client_data[0]->client_name,
					'fromAddr1' => $client_data[0]->address1,
					'fromAddr2' => '',									//NA
					'fromPlace' => $client_data[0]->location,
					'fromPincode' => $client_data[0]->pin, 				//'263665',
					'actFromStateCode' => $client_data[0]->state_no, 	//'05',
					'fromStateCode' => $client_data[0]->state_no,		//'05',
					
					'toGstin' => $shipping_data['gst_number'], 		//'05AAACG4414B1ZE'
					'toTrdName' => $shipping_data['shipping_name'],
					'toAddr1' => $shipping_data['ship_address'],
					'toAddr2' => '',									//NA
					'toPlace' => $shipping_data['location'],
					'toPincode' => $shipping_data['pin_code'],				//'263646',
					'actToStateCode' => $shipping_data['state_no'],	//'05',
					'toStateCode' => $shipping_data['state_no'],		//'05',				
					
					'transactionType' => '1',							//HardCoded - 1 - 'Regular', 'Bill From-Dispatch From', 'Bill To Ship To', and combination of both
					'dispatchFromGSTIN' =>$client_data[0]->gst_number,	// '05AAACG5686M1Z7',		
					'dispatchFromTradeName' => $client_data[0]->client_name,
					'shipToGSTIN' => $shipping_data['gst_number'],		//'05AAACG6366L2ZD',			
					'shipToTradeName' => $shipping_data['shipping_name'],
					
					'otherValue' => '0',			
					'totalValue' => number_format((float)$total_assAmt, 2, '.', ''),	
					'cgstValue' => number_format((float)$total_cgstAmt, 2, '.', ''),	
					'sgstValue' => number_format((float)$total_sgstAmt, 2, '.', ''),
					'igstValue' => number_format((float)$total_igstAmt, 2, '.', ''), 
					'cessValue' => '0',									// HardCoded
					'cessNonAdvolValue' => '0',							// HardCoded
					'totInvValue' => $total_totItemVal,
					
					'transporterId' => $transporter_data[0]->transporter_id,
					'transporterName' => $transporter_data[0]->name, 
					'transDocNo' => '',									//NA - Only applicable if there is other than Road
					'transMode' => $transMode,
					'transDistance' => $distance,
					'transDocDate' => '',								//NA - Only applicable if there is other than Road
					'vehicleNo' => $vehicleNo,
					'vehicleType' => 'R',
					"itemList"=> $actualAllItemsArr,
				  ),
				);
							
				//Hard coded data
				//$hardCodedJsondata = $this->getHardCodedDataForCreate();
				//$requestData = json_encode($hardCodedJsondata);
				//dyanmic data
				$requestData = json_encode($dynamicData);
			
				
				$this->echoToTriage("<br><br><b>Dynamic Request For GENEWAYBILL :</b><br>" .$requestData . "<br>");
				//echo "<br> requestData: ".$requestData;
				//exit();

			$result=$this->EwayBill->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero For GENEWAYBILL :</b><br>" .json_encode($result) . "<br>");

			if(isset($result['status']) && $result['status'] == 0) {
				$this->echoToTriage("API error occured for GENEWAYBILL...");
				$errorDet = $result['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for GENEWAYBILL Request:</u><br>");
				$errorMsg = "GST Error Response: ";
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response for GENEWAYBILL Request: 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
								
					    $errorMsg = $errorMsg. "<br> ErrorCode: ".$error['errorCodes']." , ErrorMsg: " .$error['errorMsg'];
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						//echo $alertCode;
				}
				    $this->addErrorMessage($errorMsg);
					$this->redirectMessage();
					
			} else if(isset($result['status']) && $result['status'] == 1) {
				$this->echoToTriage( "Eway Bill Created sucessfully");
				$gstResponse = $result['data'];
				
				$this->echoToTriage( "gstResponse: ".$gstResponse);
				$this->echoToTriage( "new_sales_id: ".$new_sales_id);
				$this->echoToTriage( "EwbNo: ".$gstResponse['ewayBillNo']);
				$this->echoToTriage( "EwbDt: ".$gstResponse['ewayBillDate']);
				$this->echoToTriage( "EwbValidTill: ".$gstResponse['validUpto']);
				
				
				$response_data = array(
					'new_sales_id' => $new_sales_id,
					'EwbStatus' => 'ACTIVE',
					'EwbNo' => $gstResponse['ewayBillNo'],
					'EwbDt' => $gstResponse['ewayBillDate'],
					'EwbValidTill' => $gstResponse['validUpto']
				);
				
				//Store the status in our DB...
				$this->echoToTriage( "response_data: ".json_decode($response_data));
				$hasEinvoice = $einvoice_res_data[0]->Status;
				$this->echoToTriage("hasEinvoice : ".$hasEinvoice);
				if(isset($hasEinvoice)){
					$dbresult = $this->Common_admin_model->update("einvoice_res", $response_data, "new_sales_id", $new_sales_id);
				}else{
					$dbresult = $this->Common_admin_model->insert('einvoice_res', $response_data);
				}
				if ($dbresult) {
					$new_sales_update = array(
							'id' => $new_sales_id,
							'vehicle_number' => $vehicleNo,
							'distance' => $distance,
							'transporter' => $transporter_data[0]->transporter_id,
							'transporter_id' => $transporter_data[0]->id
						);
					$dbresult = $this->Common_admin_model->update("new_sales", $new_sales_update, "id", $new_sales_id);
					echo "<script>alert('EWAY Bill created successfully.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$this->echoToTriage("<br>EWAY Bill DB Not Updated for EwayBill generate.");
				}
			}
			//echo "<script>window.close();</script>";
			$this->EwayBill->redirect($new_sales_id); 
        }      
	}
	
 /**
   * Get EWay - from Local DB
   */
  public function view_EwayBill() {
		//$this->echoToTriage("<br><u><b>view_EwayBill</b></u>");
		
		$isDynamic = true;
		$downloadPDF = false;
		
		$new_sales_id = $this->uri->segment('2');
		$new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
		
		//get client data based on unit selection
		$client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
		$customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

		//get shipping details based on new sales data like customer or consignee address..
		$shipping_data = $this->getShippingDetails($new_sales_data, $customer_data);

		$po_parts_data = $this->Crud->get_data_by_id("sales_parts", $new_sales_id, "sales_id");
		$transporter_data = $this->Crud->get_data_by_id("transporter", $new_sales_data[0]->transporter_id, "id");
	    
		$actualAllItemsArr = array();
		$all_final_totals = 0;
		$all_cgst_amounts = 0;
		$all_sgst_amounts = 0;
		$all_igst_amounts = 0;
		$all_tcs_amounts = 0;
		$total_assAmt = 0;
		$total_igstAmt = 0;
		$total_cgstAmt = 0;
		$total_sgstAmt = 0;
		$total_totItemVal = 0;

		$unsortedHSNCodes = array();
		$sortedHSNCodesAssAmt = 0;
		$sortedHSNCodesIgstAmt =0;
		$sortedHSNCodesCgstAmt = 0;
		$sortedHSNCodesSgstAmt = 0;
		$previousHSNCode;

		$i = 1;
		foreach ($po_parts_data as $ps) {
					  $actualIemsArr = array();
					 
					  $child_part_datas = $this->Crud->get_data_by_id("customer_part", $ps->part_id, "id");
					  $gst_structure_datas = $this->Crud->get_data_by_id("gst_structure", $ps->tax_id, "id");
					  $hsn_codes = $child_part_datas[0]->hsn_code;
					  
					  $unsortedHSN = array();
					  $hsn_codes = $child_part_datas[0]->hsn_code;
					  $isServc = $child_part_datas[0]->isservice;
					  $isInterState = false; //means only IGST is applicable so show it accordingly
					  if ((int)$gst_structure_datas[0]->igst === 0) {
							$gsts = (int)$gst_structure_datas[0]->cgst + (int)$gst_structure_datas[0]->sgst;
							$cgsts = (int)$gst_structure_datas[0]->cgst;
							$sgsts = (int)$gst_structure_datas[0]->sgst;
							$tcss = (float)$gst_structure_datas[0]->tcs;
							$igsts = 0;
							$total_gst_percentages = $cgsts + $sgsts;
					  } else {
							$gsts = (int)$gst_structure_datas[0]->igst;
							$tcss = (float)$gst_structure_datas[0]->tcs;
							$cgsts = 0; 
							$sgsts = 0;
							$igsts = $gsts;
							$total_gst_percentages = $igsts;
							$isInterState = true;
					  }

					  $subtotal =  $ps->total_rate - $ps->gst_amount;
					 
	                  $total_rate_old = $rate;
					  $rate = round($subtotal / $ps->qty,2);
					  $row_total =(float) $ps->total_rate+(float)$ps->tcs_amount;
					  $final_po_amount = (float)$final_po_amount + (float)$row_total;

					  $gst_amounts = ($gsts * $rate) / 100;
					  $final_amounts = $gst_amounts + $rate;
					  $final_row_amounts = $final_amounts * $ps->qty;

					  // $final_total = $final_total + $final_row_amount;
					  $actual_indv_totalAmt = $ps->qty * $rate;
					  $all_final_totals = $all_final_totals + $actual_indv_totalAmt;
				
					  $all_cgst_amounts = $all_cgst_amounts + $ps->cgst_amount;
					  $all_sgst_amounts = $all_sgst_amounts + $ps->sgst_amount;
					  $all_igst_amounts = $all_igst_amounts + $ps->igst_amount;
					  $all_tcs_amounts = $all_tcs_amounts + $ps->tcs_amount;
					
					  
					    $discount = 0; //Not defined as of now
						$totAmt = number_format((float)$actual_indv_totalAmt, 2, '.', '');	
						//AssAmt: Taxable Value (Total Amount -Discount)
						$assAmt =  number_format((float)($actual_indv_totalAmt - $discount), 2, '.', '');
						$igstAmt = $ps->igst_amount; //number_format((($actual_indv_totalAmt * $igsts) / 100), 2, '.', '');
						$cgstAmt = $ps->cgst_amount; //number_format((($actual_indv_totalAmt * $cgsts) / 100), 2, '.', '');
						$sgstAmt = $ps->sgst_amount;//number_format((($actual_indv_totalAmt * $sgsts) / 100), 2, '.', '');	
						
						$total_assAmt = $total_assAmt + $assAmt;
						$total_igstAmt = $total_igstAmt + $igstAmt;
						$total_cgstAmt = $total_cgstAmt + $cgstAmt;
						$total_sgstAmt = $total_sgstAmt + $sgstAmt;

						$actualIemsArr['slNo'] = $i;
						$actualIemsArr['prdDesc'] = $child_part_datas[0]->part_description;
						$actualIemsArr['isServc'] = $isServc;
						$actualIemsArr['hsnCd'] = $child_part_datas[0]->hsn_code; 		
						$actualIemsArr['qty'] = $ps->qty;								
						$actualIemsArr['unit'] = $ps->uom_id;							
						$actualIemsArr['unitPrice'] = $rate;
						$actualIemsArr['totAmt'] = $totAmt;
						$actualIemsArr['discount'] = $discount;				
						$actualIemsArr['preTaxVal'] = 0;
						$actualIemsArr['assAmt'] = $assAmt;
						$actualIemsArr['gstRt'] = $total_gst_percentages;
						//gstRt: The GST rate, represented as percentage that applies to the invoiced item. It will IGST rate only
						$actualIemsArr['igstAmt'] = $igstAmt;				
						$actualIemsArr['cgstAmt'] = $cgstAmt;					
						$actualIemsArr['sgstAmt'] = $sgstAmt;
						
						$totItemVal = number_format(($assAmt + $igstAmt + $cgstAmt + $sgstAmt), 2, '.', '');
						$total_totItemVal = $total_totItemVal + $totItemVal;
						$actualIemsArr['totItemVal'] = $totItemVal; 
						$actualIemsArr['orgCntry'] = "IN";
						
						//get this for HSN sorting
						$unsortedHSN['hsn_code'] = $hsn_codes;
						$unsortedHSN['assAmt'] = $assAmt;
						$unsortedHSN['cgstRate'] = $cgsts;
						$unsortedHSN['cgstAmt'] = $cgstAmt;
						$unsortedHSN['sgstRate'] = $sgsts;
						$unsortedHSN['sgstAmt'] = $sgstAmt;
						$unsortedHSN['igstAmt'] = $igstAmt;
						$unsortedHSN['igstRate'] = $igsts;
						//$unsortedHSN['total'] = $totItemVal;
						//echo var_dump($unsortedHSN);
						$sortedHSNCodesAssAmt = $sortedHSNCodesAssAmt +  $assAmt;
						$sortedHSNCodesCgstAmt = $sortedHSNCodesCgstAmt +  $cgstAmt;
						$sortedHSNCodesSgstAmt = $sortedHSNCodesSgstAmt +  $sgstAmt;
						$sortedHSNCodesIgstAmt = $sortedHSNCodesIgstAmt +  $igstAmt;
						//$sortedHSNCodesTotal = $sortedHSNCodesTotal +  $totItemVal;
						
						array_push($unsortedHSNCodes,$unsortedHSN);
						array_push($actualAllItemsArr,$actualIemsArr);

						$heights = "150px";
			
						$parts_html .= '
							<tr style="font-size:14px;text-align:right;"">
								<td style="width:20px;">' . $i . '</td>
							<td>' . $child_part_datas[0]->part_number .  '</td>
							<td colspan="3" style="width:200px;text-align:left;">' . $child_part_datas[0]->part_description . '</td>
							<td>' .  $hsn_codes . '</td>
							<td>' . $ps->uom_id . '</td>
							<td>' . $ps->qty . '</td>
							<td>' . $rate . '</td>
							<td></td>
							<td colspan="2" style="text-align:center;">' . number_format((float)$actual_indv_totalAmt, 2, '.', '') . '</td>
						</tr>
						';
						
						if($isInterState==true) {
							$eway_parts_html .= '
							<tr style="font-size:14px;text-align:center;">
							<td>' .  $hsn_codes . '</td>
							<td>' .  $child_part_datas[0]->part_number.'</td>
							<td colspan="6" style="text-align:left;" >'.$child_part_datas[0]->part_description.'</td>
							<td>' . $ps->qty . ' '.$ps->uom_id.'</td>
							<td>' . number_format((float)$actual_indv_totalAmt, 2, '.', '') . '</td>
							<td colspan="2"> IGST: '.$igsts.'%</td>
						</tr>';
						}else{
							$eway_parts_html .= '
							<tr style="font-size:14px;text-align:center;">
							<td>' .  $hsn_codes . '</td>
							<td>' .  $child_part_datas[0]->part_number.'</td>
							<td colspan="6" style="text-align:left;">'.$child_part_datas[0]->part_description.'</td>
							<td>' . $ps->qty . ' '.$ps->uom_id.'</td>
							<td>' . number_format((float)$actual_indv_totalAmt, 2, '.', '') . '</td>
							<td colspan="2"> SGST: '.$sgsts .'%<br> CGST: ' .$cgsts .'</td>
						</tr>';
						}
						
			 $i++;
		}
	
	//API details:
	$this -> load-> model('EwayBill');

	$einvoice_res_id = $this->uri->segment('2');
	$einvoice_res_data = $this->Crud->get_data_by_id("einvoice_res", $einvoice_res_id, "new_sales_id");

	$issdata = $einvoice_res_data[0]->iss; //TO-DO : what to do with this ?
	$EwbNo= $einvoice_res_data[0]->EwbNo;
	$EwbDt= $einvoice_res_data[0]->EwbDt;
	$SignedQRCode= $einvoice_res_data[0]->SignedQRCode;
	$EwbValidTill = $einvoice_res_data[0]->EwbValidTill;

	$sellrgstn=$einvoice_res_data[0]->SellerGstin;
	$buyergstin=$einvoice_res_data[0]->BuyerGstin;
	$DocNo= $einvoice_res_data[0]->DocNo;
	$DocTyp=$einvoice_res_data[0]->DocTyp;
	$DocDt=$einvoice_res_data[0]->DocDt;
	$TotInvVal=$einvoice_res_data[0]->TotInvVal;
	$ItemCnt=$einvoice_res_data[0]->ItemCnt;
	
	$all_totalOther = $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;
    $final_final_amount = $all_final_totals + $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;

	// Sort the multidimensional array by the 'hsn_code' column in ascending order
	$this->Crud->sort_by_column($unsortedHSNCodes, 'hsn_code');
	$hsn_code_table_html = $this-> EwayBill -> getHSNTableData($unsortedHSNCodes);
	$transportMode = $this-> EwayBill -> getModeOfTransport ($new_sales_data[0]->mode);

	$html_content = '
    
	<!DOCTYPE html>
	<head>
			<style> html { margin: 1px}
			@media print {

				.container{ 
					width: 95%; 
					height: auto; 
					margin: 50px auto; 
				} 

				  .article { page-break-after: always; }
				  a[href]:after {
					content: none !important;
				  }
				  
				  table { /* Or specify a table class */
					max-height: 100%;
					overflow: hidden;
					page-break-after: always;
					 border: 1px solid black;
					 border-collapse: collapse;
				  }
				  @page 
					{
						size: auto;   /* auto is the initial value */
						margin: 2mm;  /* this affects the margin in the printer settings */
					}
				  body {
					   margin-top: 5mm; 
					   margin-left: 2mm;
					   margin-bottom: 5mm; 
					   margin-right: 2mm
				 }
				}
			
			th, td {
			  border: 1px solid black;
			  border-collapse: collapse;	
			  padding-top: 3px;
			  padding-bottom: 3px;
			  padding-left: 8px;
			  padding-right: 8px;
			}
			
			</style>
			<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
	</head>	
	<body>
	<script>
		function printSection() {
			var printContent = document.getElementById("print-section").innerHTML;
			var originalContent = document.body.innerHTML;
			document.body.innerHTML = printContent;
			window.print();
			document.body.innerHTML = originalContent;
		}
		</script>
		<div>
		<button style="color: white;background-color: red;"onclick="printSection()">Print</button>
		</div>
		<br>
		<div id="print-section">
		<table padding="2" cellspacing="0" border="1px">
		<tr>
			<th colspan="12" style="width:600px; text-align:center; font-size:16px">e-Way Bill</th>
		</tr>
		<tr>
				<td colspan="8" align="bottom">
					Doc No :<b> '.$new_sales_data[0]->sales_number.'</b><br>
					Date   :<b> '.$new_sales_data[0]->created_date.'</b><br>
				</td>
				 <td colspan="4" align="bottom">
					<span class="ewayQRcode"></span>
				 </td>
			</tr>
		<tr>
			<td colspan="12" style="text-align:left; font-size:16px"><b>1. e-Way Bill Details</b><br></th>
		</tr>
		<tr>
			<td colspan="6" align="top">
				e-Way Bill No :<b> '.$EwbNo.'</b><br>
				Generated By   :<b> '.$client_data[0]->gst_number.'</b><br>
				Supply Type    :<b> Outward-Supply</b><br><br>
			  </td>
			  <td colspan="4" align="top">
				Mode :<b> '.$new_sales_data[0]->mode.'- Road</b><br>
				Approximate Distance   :<b>'.$new_sales_data[0]->distance.'</b><br>
				Transaction Type    :<b> Regular</b><br><br>
			  </td>
			  <td colspan="2" align="top">
				  Generated Date:<b>   '.$EwbDt.'</b><br>
				  Valid Upto	:<b>   '.$EwbValidTill.'</b><br>
			  </td>
		</tr>
		<tr>
			<td colspan="12" style="text-align:left; font-size:16px"><b>2. Address Details</b></th>
		</tr>
		<tr>
			<td colspan="6" align="top">
				<b>From :</b><br>
				'.$client_data[0]->client_name.'<br>
				'.$client_data[0]->address1.','.$client_data[0]->state.' '.$client_data[0]->pin.'<br>
				GSTIN : '.$client_data[0]->gst_number.'<br>
			  </td>
			  <td colspan="6" align="top">
			  <b>To :</b><br>
				'.$shipping_data['shipping_name'].'<br>
				'.$shipping_data['ship_address'].','.$shipping_data['state'].' '.$shipping_data['pin_code'].'<br>
				GSTIN : '.$shipping_data['gst_number'] .'<br>
			  </td>
		</tr>
		<tr>
			<td colspan="6" align="top">
					<b>Dispatched From :</b><br>
					'.$client_data[0]->client_name.'<br>
					'.$client_data[0]->address1.','.$client_data[0]->state.' '.$client_data[0]->pin.'<br>
					GSTIN : '.$client_data[0]->gst_number.'<br>
				  </td>
				  <td colspan="6" align="top">
				  <b>Ship To :</b><br>
					'.$shipping_data['shipping_name'].'<br>
					'.$shipping_data['ship_address'].','.$shipping_data['state'].' '.$shipping_data['pin_code'].'<br>
					GSTIN : '.$shipping_data['gst_number'] .'<br>
		  	</td>
		</tr>
		<tr>
			<td colspan="12" style="text-align:left; font-size:16px"><b>3. Goods Details</b></th>
		</tr>
		<tr style="font-size:14px;text-align:center;">
		  <th>HSN Code</th>
		  <th>Product Name</th>
		  <td colspan="6" style="text-align:left;">Product Description</th>
		  <th>Quantity </th>
		  <th>Taxable Amt</th>
		  <th colspan="2">Rate</th>
		</tr>
		' . $eway_parts_html . '
		<tr>
			<td colspan="12" style="height:25px"></td>
		</tr>
		<tr>
			  <td colspan="4" width="33%"> 
				Tot.Taxable Amt: <b>'.number_format((float)$all_final_totals, 2, '.', '').'</b><br>
				Other Amt :<b>'.number_format((float)$all_totalOther, 2, '.', '').'</b><br>
				
			  </td>
              <td colspan="4" width="33%">
			    CGST Amt: <b>'.number_format((float)$all_cgst_amounts, 2, '.', '').'</b><br>
				SGST Amt : <b>'.number_format((float)$all_sgst_amounts, 2, '.', '').'</b><br>
				IGST Amt : <b>'.number_format((float)$all_igst_amounts, 2, '.', '').'</b>
			  </td>
			  <td colspan="4" width="33%"><br>
				Total Inv Amt :<b>'.number_format((float)$final_final_amount, 2, '.', '').'</b><br>
			  </td>
			</tr>
		<tr>
			<td colspan="12" style="text-align:left; font-size:16px"><b>4. Transportation Details</b></th>
		</tr>
		<tr>
			<td colspan="12" align="top">
				Transporter ID :'.$transporter_data[0]->transporter_id.'<br>
				Name :'.$transporter_data[0]->name.'<br>
			</td>
			<!--  <td colspan="6" align="top">
				Doc No:<br>
				Date<br>
			  </td> -->
		</tr>
		
		<tr>
			<td colspan="12" style="text-align:left; font-size:16px"><b>5. Vehicle Details</b></th>
		</tr>
		<tr>
		<td colspan="4" align="top">
			Vehicle No : <b>'.$new_sales_data[0]->vehicle_number.'</b><br>
		</td>
		<td colspan="4" align="top">
			From : <br>
		</td>
		<td colspan="4" align="top">
			CEWB No : <br>
		</td>
		</tr>
	</table>
	</div>
	</body>
  </html>
 ';

		if($downloadPDF == true){
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("View-E-Invoice-Details.pdf", array("Attachment" => 1));
		}else{
			echo $html_content;
			die;
		}
  }
	
  /**
   * Update E-Way Bill for vehicle details
   */
	public function update_e_way_bill()	{
		
		$new_sales_id = $this->input->post('new_sales_id');
		$new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");

		//get client data based on unit selection
        $client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
		
		$this->echoToTriage("<br><b> Update EwayBill Vehicle details</b>");
		
		$new_sales=array(
			"new_sales_id"=>$new_sales_id
		  );
		

		//Get data from Einvoice response table 
		//$einvoice_res_data = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $new_sales);
		$eWayBillNo 	= $this->input->post('eWayBillNo');
		$transMode 		= $this->input->post('transMode');
		$vehicleNo 		= $this->input->post('vehicleNo');
		$reasonCode 	= $this->input->post('reasonCode');
		$reasonRem 		= $this->input->post('reasonRem');
		$transDocNo 	= $this->input->post('transDocNo');
		$transDocDate	= $this->input->post('transDocDate');

		$this->echoToTriage("<br> eWayBillNo : ".$eWayBillNo." <br>transMode : ". $transMode. " <br>vehicleNo: ".$vehicleNo."<br>reasonCode : "
		.$reasonCode." <br>reasonRem : ". $reasonRem. " <br>transDocNo: ".$transDocNo.'<br>transDocDate: '.$transDocDate);

		
		//get the token and all
		$this -> load-> model('EwayBill');
		$token = $this-> EwayBill -> authentication($new_sales_id);
		
		if($token) {
			$url = $this->getEwayBillURL();
			$XConnectorAuthToken = $this->getXConnectorAuthToken();
			$Authorization='Bearer '.$token;         
			$action='VEHEWB';
			
			$jsondata=array(
				  'action' => 'VEHEWB',
				  'data' => 
					  array (
						'ewbNo' => $eWayBillNo,			//'341009195804',
						'fromPlace' => $client_data[0]->location,			//$client_data[0]->location,
						'fromState' => $client_data[0]->state_no,			//$client_data[0]->state_no;
						'reasonCode' => $reasonCode,	//'1',
						'reasonRem' => $reasonRem, 		//'vehicle broke down'
						'transDocDate' => '', 			//'20/04/2023',	//$transDocNo,
						'transDocNo' => '',				//$transDocNo,
						'transMode' => $transMode, 		//'1',				,
						'vehicleNo' => $vehicleNo,		//'KA12AX1234',
					  )
				);

			$requestData = json_encode($jsondata);
			$this->echoToTriage("<br><br><b>Dynamic Request Data  : </b><br>" . $requestData ."<br><br>");

			//echo "requestData: " . $requestData;
			//exit();

			$result=$this->EwayBill->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero  :</b><br>" .json_encode($result) . "<br>");

			if(isset($result['status']) && $result['status'] == 0) {
				$this->echoToTriage("API error occured for Request...");
				$errorDet = $result['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for Request:</u><br>");
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response : 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						echo $alertCode;
				}
				$this->load->model('EwayBill');
				//$this->EwayBill->redirect($new_sales_id); 

			} else if(isset($result['status']) && $result['status'] == 1) {
				
				$this->echoToTriage("<br>Eway Bill Updated sucessfully");
				$gstResponse = $result['data'];
				
				$this->echoToTriage( "EwbValidTill: ".$gstResponse['validUpto']);
				$this->echoToTriage( "vehUpdDate: ".$gstResponse['vehUpdDate']);
				
				$response_data = array(
					'new_sales_id' => $new_sales_id,
					'EwbNo' => $eWayBillNo,
					'EwbValidTill' => $gstResponse['validUpto'],
					'EwbVehUpdDate'=> $gstResponse['vehUpdDate']
				);
				
				$new_sales_update = array(
					'id' => $new_sales_id,
					'vehicle_number' => $vehicleNo,
					'mode' => $transMode,
				);
				
				//Store the status in our DB...
				$dbresult = $this->Common_admin_model->update("einvoice_res", $response_data, "new_sales_id", $new_sales_id);
				if ($dbresult) {
					$dbresult = $this->Common_admin_model->update("new_sales", $new_sales_update, "id", $new_sales_id);
					$this->echoToTriage( "<br>EWAY Bill DB updated");
					echo "<script>alert('EWAY Bill updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$this->echoToTriage( "<br>EWAY Bill DB Not Updated");
					echo "<script>alert('EWAY Bill not updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
			
			$this->EwayBill->redirect($new_sales_id); 
        }      
	}	 
	
  /*
   * Update E-Way Bill for transporter details
   */
	public function update_EWayBill_transporter()	{
		$this->echoToTriage("<br> Update Transporter details for EwayBill");
		$new_sales_id = $this->input->post('new_sales_id');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		  );
		//get the values from user
		$eWayBillNo = $this->input->post('eWayBillNo');
		$transporterId = $this->input->post('transporterId');

		$transporter = $this->Crud->get_data_by_id("transporter", $transporterId, "id");
		$this->echoToTriage("<br> new_sales_id :".$new_sales_id." <br>eWayBillNo : ".$eWayBillNo." <br>Transporter ID : ". $transporter[0]->transporter_id);
		
		//get the token and all
		$this -> load-> model('EwayBill');
		$token = $this-> EwayBill -> authentication($new_sales_id);
		
		if($token) {
			$url = $this->getEwayBillURL();
			$XConnectorAuthToken = $this->getXConnectorAuthToken();
			$Authorization='Bearer '.$token;         
			$action='UPDATETRANSPORTER';
			
			$jsondata=array(
				  'action' => 'UPDATETRANSPORTER',
				  'data' => 
					  array (
						'ewbNo' => 	$eWayBillNo,								//	"371009197218" ,
						'transporterId' =>  $transporter[0]->transporter_id		//	"05AAACG5969R1ZV"
					  )
				);

			$requestData = json_encode($jsondata);
			$this->echoToTriage("<br><br><b>Dynamic Request Data  : </b><br>" . $requestData ."<br><br>");
			//echo "requestData: ".$requestData;
			//exit();

			$result=$this->EwayBill->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero  :</b><br>" .json_encode($result) . "<br>");

			if(isset($result['status']) && $result['status'] == 0) {
				$this->echoToTriage("API error occured for Request...");
				$errorDet = $result['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for Request:</u><br>");
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response : 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						echo $alertCode;
				}
				$this->load->model('EwayBill');
				//$this->EwayBill->redirect($new_sales_id); 

			} else if(isset($result['status']) && $result['status'] == 1) {
				$this->echoToTriage("<br>Eway Bill Updated for transporter");
				$gstResponse = $result['data'];
				
				//{"data":{"transporterId":"27AAACM2890D1ZM","transUpdateDate":"27\/04\/2023 04:47:00 PM","ewayBillNo":"361009197736"},"status":"1"}
				
				$new_sales_update = array(
					'id' => $new_sales_id,
					"transporter"  => $transporter[0]->transporter_id,
					'transporter_id' => $transporter[0]->id
				);
				
				//Store the status in our DB...
				$dbresult = $this->Common_admin_model->update("new_sales", $new_sales_update, "id" , $new_sales_id);
				if ($dbresult) {
					$this->echoToTriage("<br>EWAY Bill DB updated");
					echo "<script>alert('EWAY Bill updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$this->echoToTriage("<br>EWAY Bill DB Not Updated");
					echo "<script>alert('EWAY Bill not updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
			$this->EwayBill->redirect($new_sales_id); 
        }      
	}	 
	
	
 /**
   * Cancel eWayBill
   */
  public function cancel_eWayBill()	{
		$new_sales_id = $this->input->post('new_sales_id');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		  );

		//get the values from user
		$eWayBillNo = $this->input->post('eWayBillNo');
		$cancelReason = $this->input->post('cancelReason');
		$cancelRemark = $this->input->post('cancelRemark');

		$this->echoToTriage("<br> CancelReason : ".$cancelReason." <br>CancelRemark : ". $cancelRemark);

		//get the token and all
		$this -> load-> model('EwayBill');
		$token = $this-> EwayBill -> authentication($new_sales_id);
		
		if($token) {
			$url = $this->getEwayBillURL();
			$XConnectorAuthToken = $this->getXConnectorAuthToken();		
			$Authorization='Bearer '.$token;         
			$action='CANEWB';
			
			$jsondata=array(
				"action"=>"CANEWB",
					"data"=>array(
						"ewbNo"=> $eWayBillNo,
						"cancelRsnCode"=> $cancelReason,
						"cancelRmrk"=> $cancelRemark
					)
			);

			$requestData = json_encode($jsondata);
			$this->echoToTriage("<br><br><b>Dynamic Request Data: </b><br>" . $requestData ."<br><br>");
			//echo "requestData: ".$requestData;
			//exit();

			$result=$this->EwayBill->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero For Cancel Eway Bill :</b><br>" .json_encode($result) . "<br>");

			if(isset($result['status']) && $result['status'] == 0) {
				$this->echoToTriage("API error occured for Cancel Request...");
				$errorDet = $result['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for Cancel Request:</u><br>");
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response for Cancel Request: 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						echo $alertCode;
				}
				$this->load->model('EwayBill');
			} else if(isset($result['status']) && $result['status'] == 1) {
				
				$responseData = array(
					'new_sales_id' => $new_sales_id,
					'EwbStatus' => 'CANCELLED',
					'EwbCancelReason' => $cancelReason,
					'EwbCancelRemark' => $cancelRemark
				);
				
				$this->echoToTriage("<br>Eway Bill cancelled sucessfully");
				$resultUpdate = $this->Common_admin_model->update("einvoice_res", $responseData, "new_sales_id", $new_sales_id);
				if ($resultUpdate) {
					echo "<script>alert('Eway Bill cancelled sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					$this->echoToTriage("<br>EWAY Bill DB Not Updated for cancelled");
				}
			}
			
			$this->EwayBill->redirect($new_sales_id); 
        }      
	}
	
  /**
   *  Generate EWB Print
   */
	public function generate_EWayBillPrint()	{
		$this->echoToTriage("<br> Generate EWB Print Request");
		$new_sales_id = $this->input->post('new_sales_id');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		  );

		//Get data from Einvoice response table 
		$einvoice_res_data = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $new_sales);
		$issdata = $einvoice_res_data[0]->iss; //TO-DO : what to do with this ?
	
		//get the values from user
		$CancelReason = $this->input->post('CancelReason');
		$CancelRemark = $this->input->post('CancelRemark');

		$this->echoToTriage("<br> CancelReason : ".$CancelReason." <br>CancelRemark : ". $CancelRemark);
		
		$eWayBillNo = 371009195887;
		
		//get the token and all
		$this -> load-> model('EwayBill');
		$token = $this-> EwayBill -> authentication($new_sales_id);
		
		if($token) {
			$XConnectorAuthToken = $this->getXConnectorAuthToken();

			if($this->isProduction()==true){
				$url="http://35.154.208.8:8080/ewb/enc/v1.03/generateEwayBillPrintPdf?ewbNo=".$eWayBillNo;
			}else{
				$url="http://35.154.208.8:8080/ewb/enc/v1.03/generateEwayBillPrintPdf?ewbNo=".$eWayBillNo;
			}
			$Authorization='Bearer '.$token;         
			$action='GENERATEEWAYBILLPRINT';
			
			$this->echoToTriage("<br><br><b>Dynamic Request Data URL : </b><br>" . $url ."<br><br>");
			$result=$this->EwayBill->executeGetMehtod($url,'',$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero  :</b><br>" .json_encode($result) . "<br>");

			if(isset($result['status']) && $result['status'] == 0) {
				$this->echoToTriage("API error occured for Request...");
				$errorDet = $result['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for Request:</u><br>");
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response : 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						echo $alertCode;
				}
				$this->load->model('EwayBill');
				//$this->EwayBill->redirect($new_sales_id); 

			} else if(isset($result['status']) && $result['status'] == 1) {
				echo $result;
			}
        }      
	}	 
	
	/**
   * Get Currency
   */
  function getIndianCurrency(float $number)
	  {
		$decimal = round($number - ($no = floor($number)), 2) * 100;
		$hundred = null;
		$digits_length = strlen($no);
		$i = 0;
		$str = array();
		$words = array(
		  0 => '', 1 => 'one', 2 => 'two',
		  3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
		  7 => 'seven', 8 => 'eight', 9 => 'nine',
		  10 => 'ten', 11 => 'eleven', 12 => 'twelve',
		  13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
		  16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
		  19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
		  40 => 'forty', 50 => 'fifty', 60 => 'sixty',
		  70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
		);
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_length) {
		  $divider = ($i == 2) ? 10 : 100;
		  $number = floor($no % $divider);
		  $no = floor($no / $divider);
		  $i += $divider == 10 ? 1 : 2;
		  if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
		  } else $str[] = null;
		}
		$Rupees = implode('', array_reverse($str));
		$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
		return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
	  
	  }

	public function getHardCodedDataForCreate(){
		$hardCodedJsondata =
			array (
				  'action' => 'GENEWAYBILL',
				  'data' => 
				  array (
					'supplyType' => 'O',	//HardCoded	 - Outward
					'subSupplyType' => '1',	//HardCoded  - Supply 
					'subSupplyDesc' => '',	//HardCoded  - Needed if subSupplyType is of Others type
					'docType' => 'INV',		//HardCoded	 - Tax Invoice
					'docNo' => '14070',		//$einvoice_res_data[0]->DocNo,
					'docDate' => '17/04/2023',	//$einvoice_res_data[0]->DocDt,
					
					'fromGstin' => '05AAACG5222D1ZA',	//$client_data[0]->gst_number,
					'fromTrdName' => '',				//$client_data[0]->client_name,
					'fromAddr1' => '',					//$client_data[0]->address1,
					'fromAddr2' => '',					//NA
					'fromPlace' => '',					//$client_data[0]->location,
					'fromPincode' => '263665',			//$client_data[0]->pin,
					'actFromStateCode' => '05',			//$client_data[0]->state_no,
					'fromStateCode' => '05',			//$client_data[0]->state_no,
					
					'toGstin' => '05AAACG4414B1ZE',		//$customer_data[0]->gst_number,
					'toTrdName' => '',					//$customer_data[0]->customer_name,
					'toAddr1' => '',					//$customer_data[0]->address1,
					'toAddr2' => '',					//NA
					'toPlace' => '',					//$customer_data[0]->location,
					'toPincode' => '263646',			//$customer_data[0]->pin,
					'actToStateCode' => '05',			//$customer_data[0]->state_no,
					'toStateCode' => '05',				//$customer_data[0]->state_no,
					
					'transactionType' => '1',			//HardCoded - 1 - 'Regular', 'Bill From-Dispatch From', 'Bill To Ship To', and combination of both
					'dispatchFromGSTIN' => '05AAACG5686M1Z7',		//$client_data[0]->gst_number,
					'dispatchFromTradeName' => 'Perennial system',	//$client_data[0]->client_name,
					'shipToGSTIN' => '05AAACG6366L2ZD',			//$customer_data[0]->gst_number,
					'shipToTradeName' => 'TATA STEEL',			//$customer_data[0]->customer_name,
					
					'otherValue' => '0',			
					'totalValue' => '1000',	//number_format((float)$total_assAmt, 2, '.', ''),	
					'cgstValue' => '60',	//number_format((float)$total_cgstAmt, 2, '.', ''),	
					'sgstValue' => '60',	// number_format((float)$total_sgstAmt, 2, '.', ''),
					'igstValue' => '0',		// number_format((float)$total_igstAmt, 2, '.', ''), 
					'cessValue' => '0',			// HardCoded
					'cessNonAdvolValue' => '0',	// HardCoded
					'totInvValue' => '1120',	//$total_totItemVal,
					
					'transporterId' => '',		//$transporter_data[0]->transporter_id,
					'transporterName' => 'Sai Transporter',	//$transporter_data[0]->name, 
					'transDocNo' => '',				//NA - Only applicable if there is other than Road
					'transMode' => '1',				//$new_sales_data[0]->mode,
					'transDistance' => '1',			//$new_sales_data[0]->distance,
					'transDocDate' => '',			//NA - Only applicable if there is other than Road
					'vehicleNo' => 'MH04GR3288',	//$new_sales_data[0]->vehicle_number,
					'vehicleType' => 'R',
					"itemList"=> $actualAllItemsArr,
					
					
					'itemList' => 
						array (
						  0 => 
						  array (
							'productName' => 'Mobile',
							'productDesc' => 'Mobile',
							'hsnCode' => '7222',
							'quantity' => '1',
							'qtyUnit' => 'BOX',
							'cgstRate' => '6',
							'sgstRate' => '6',
							'igstRate' => '0',
							'cessRate' => '0',
							'cessNonAdvol' => '0',
							'taxableAmount' => '1000',
						  ),
						),
				  ),
				); 
	
	return $hardCodedJsondata;
	
	}
}

