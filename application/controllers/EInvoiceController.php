<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('CommonController.php');

class EInvoiceController extends CommonController {

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
		 $this->GSTCommon->echoToTriage($str);
	 }
	  
	/*
	   Get E-Invoice method invoke
	  */
	public function generate_E_invoice() {
		$this->echoToTriage("<br><u><b>generate_E_invoice</b></u>");
		
		$isDynamic = true;
		$downloadPDF = false;
		
		$new_sales_id = $this->uri->segment('2');
		$copy = $this->uri->segment('3');
		$new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
		$customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

		//get client data based on unit selection
		$client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
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
		$total_tcsAmt = 0;
		$total_totItemVal = 0;
		
		$unsortedHSNCodes = array();
		$sortedHSNCodesAssAmt = 0;
		$sortedHSNCodesCgstAmt = 0;
		$sortedHSNCodesSgstAmt = 0;
		$sortedHSNCodesIgstAmt = 0;
		$sortedHSNCodesTCSAmt = 0;
		$previousHSNCode;
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
						$igstAmt = $ps->igst_amount; 	//number_format((($actual_indv_totalAmt * $igsts) / 100), 2, '.', '');
						$cgstAmt = $ps->cgst_amount; 	//number_format((($actual_indv_totalAmt * $cgsts) / 100), 2, '.', '');
						$sgstAmt = $ps->sgst_amount;	//number_format((($actual_indv_totalAmt * $sgsts) / 100), 2, '.', '');	
						$tcsAmt = $ps->tcs_amount; 		//number_format((($actual_indv_totalAmt * $sgsts) / 100), 2, '.', '');	
						
						$total_assAmt = $total_assAmt + $assAmt;
						$total_igstAmt = $total_igstAmt + $igstAmt;
						$total_cgstAmt = $total_cgstAmt + $cgstAmt;
						$total_sgstAmt = $total_sgstAmt + $sgstAmt;
						$total_tcsAmt = $total_tcsAmt + $tcsAmt;
						
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
						//$actualIemsArr['othChrg'] = $tcsAmt;
						
						//NOTE: We don't need to pass individual other charges but that should be added to totalvalue 
						
						$totItemVal = number_format(($assAmt + $igstAmt + $cgstAmt + $sgstAmt), 2, '.', '');
						$total_totItemVal = $total_totItemVal + $totItemVal + $tcsAmt; //adding other charges(tcs) here to totalvalue
						$actualIemsArr['totItemVal'] = $totItemVal; 
						$actualIemsArr['orgCntry'] = "IN";
						
						//get this for HSN sorting
						$unsortedHSN['hsn_code'] = $hsn_codes;
						$unsortedHSN['assAmt'] = $assAmt;
						$unsortedHSN['cgstRate'] = $cgsts;
						$unsortedHSN['cgstAmt'] = $cgstAmt;
						$unsortedHSN['sgstRate'] = $sgsts;
						$unsortedHSN['sgstAmt'] = $sgstAmt;
						$unsortedHSN['igstRate'] = $igsts;
						$unsortedHSN['igstAmt'] = $igstAmt;
						//$unsortedHSN['othChrg'] = $tcsAmt;
						//$unsortedHSN['total'] = $totItemVal;
						//echo var_dump($unsortedHSN);
						$sortedHSNCodesAssAmt = $sortedHSNCodesAssAmt +  $assAmt;
						$sortedHSNCodesCgstAmt = $sortedHSNCodesCgstAmt +  $cgstAmt;
						$sortedHSNCodesSgstAmt = $sortedHSNCodesSgstAmt +  $sgstAmt;
						$sortedHSNCodesIgstAmt = $sortedHSNCodesIgstAmt +  $igstAmt;
						$sortedHSNCodesTCSAmt =  $sortedHSNCodesTCSAmt +  $tcsAmt;
						$sortedHSNCodesTCSAmt = number_format((float)$sortedHSNCodesTCSAmt, 2, '.', '');
						
						array_push($unsortedHSNCodes,$unsortedHSN);
						array_push($actualAllItemsArr,$actualIemsArr);
			
			$heights = "150px";
			
			$parts_html .= '
				<tr style="font-size:14px;text-align:right;">
				<td style="width:20px;">' . $i . '</td>
				<td >' . $child_part_datas[0]->part_number .  '</td>
				<td colspan="3" style="width:200px;text-align:left">' . $child_part_datas[0]->part_description . '</td>
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
				<td colspan="6" style="text-align:left;" >'.$child_part_datas[0]->part_description.'</td>
				<td>' . $ps->qty . ' '.$ps->uom_id.'</td>
				<td>' . number_format((float)$actual_indv_totalAmt, 2, '.', '') . '</td>
				<td colspan="2"> SGST: '.$sgsts .'%<br> CGST: ' .$cgsts .'</td>
			</tr>';
			}
		
			$i++;
		}
	
	$final_final_amount = $all_final_totals + $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;
	/* echo "Amount details : final_final_amount: ".$final_final_amount. "<br> all_final_totals: ".$all_final_totals."<br>all_cgst_amounts: ".$all_cgst_amounts."<br>all_sgst_amounts: ".$all_sgst_amounts."<br> all_igst_amounts: ".$all_igst_amounts."<br>all_tcs_amounts :".$all_tcs_amounts.'"'; */
	//API details:
	$this -> load-> model('EInvoice');
	if($isDynamic == true){
		$token = $this-> EInvoice -> authentication($new_sales_id);
	}else{
		$token = "asfad-sfasd-fasdfa-fsad1@"; //HardCoded for unit-testing	
	}
	
	
	if($token){
		$Authorization='Bearer '.$token;
		$action="GENERATEIRN";
		if($this->isProduction()==true){
			$url = "https://gsthero.com/einvoice/v1.03/invoice";
       }else{
			$url = "https://qa.gsthero.com/einvoice/v1.03/invoice";
    	}
	    
		//Actual Data
		$dynamicData=array(
		"action"=>"GENERATEIRN",
		"data"=>array(
			"version"=>"1.01", 								//HardCoded 
			"tranDtls"=>array(
					"taxSch"=> "GST",						//HardCoded
					"supTyp"=> "B2B",						//HardCoded
					"regRev"=> "N"							//HardCoded - as customer doesn't support this
					//"igstOnIntra"=>"N"					//For time being commented-not sure whether this needs to be configured or not
				),
			"docDtls"=>array(
					"typ"=> "INV",								//HardCoded : As we don't support other types in ERP as of now
					"no"=> $new_sales_data[0]->sales_number, 	//$this->getCustomerPrefix()."/3-4/001",	//CHECK THIS --> $new_sales_data[0]->sales_number
																
												
					"dt"=>	$new_sales_data[0]->created_date    // "21/02/2023", 
				  ),
			"sellerDtls"=>array(
					"gstin"=> $client_data[0]->gst_number, 		//"05AALFP1139Q003"		
					"lglNm"=> $client_data[0]->client_name,	  	//client table - client_name
																//"trdNm"=> "Panchshil Techpark Private Limited", 
					"addr1"=> $client_data[0]->address1,											//client table - address1
					//"addr2"=> "Pune",
					"loc"=> $client_data[0]->location,			//client table - location
					"pin"=> $client_data[0]->pin,				//client table - pin
					"stcd"=> $client_data[0]->state_no,			//client table - state_no
					"ph"=> $client_data[0]->phone_no			//client table - phone_no
				   // "em"=> "test@einv.com"					// not required		  
				),
			"buyerDtls"=>array(
					"gstin"=> $customer_data[0]->gst_number,	
																// new_sales -> customer-id 	ref to customer.gst_number
					"lglNm"=> $customer_data[0]->customer_name,	// as customer name 
																// new_sales -> customer-id references to customer.customer_name
					"trdNm"=> $customer_data[0]->customer_name,	
																//new_sales -> customer-id references to customer.customer_name
					"addr1"=> $customer_data[0]->address1,		
																// new_sales -> customer-id references to customer.address1
				    // "addr2"=> "PUNE",	
					"loc"=> $customer_data[0]->location, 		
																// new_sales -> customer-id references to customer.location
					"pin"=>  $customer_data[0]->pin,				// Done - added
					"stcd"=> $customer_data[0]->state_no,		
																// new_sales -> customer-id references to customer.state_no
					"pos"=> $customer_data[0]->pos				
																// new_sales -> customer-id references to customer.pos
				   // "ph"=> "02066854600",
				   // "em"=> "test@einv.com"
			  ),
			"dispDtls"=>array(									
					"nm"=> $client_data[0]->client_name,			// client table - client_name
					"addr1"=>$client_data[0]->address1,				// client table - address1
					// "addr2"=> "Pune",
					"loc"=> $client_data[0]->location,				// client table - location
					"pin"=> $client_data[0]->pin,					// client table - pin
					"stcd"=> $client_data[0]->state_no,				// client table - state_no
			  ),
			"shipDtls"=>array(								  
					"gstin"=> $shipping_data['gst_number'],			// new_sales -> customer_id references to customer.gst_number
					"lglNm"=> $shipping_data['shipping_name'],		// new_sales -> customer_id references to customer.customer_name
					"addr1"=> $shipping_data['ship_address'],			// new_sales -> customer_id references to customer.address1
					//"addr2"=>"PUNE",
					"loc"=> $shipping_data['location'],				// new_sales -> customer_id references to customer.location
					"pin"=> $shipping_data['pin_code'],				// Added field into Customer.pin
					"stcd"=> $shipping_data['state_no'],			// new_sales -> customer_id references to customer.state_no
			  ),
			"valDtls"=>array(								 	
					"assVal"=> number_format((float)$total_assAmt, 2, '.', ''),					  	
					"cgstVal"=> number_format((float)$total_cgstAmt, 2, '.', ''),				  	
					"sgstVal"=> number_format((float)$total_sgstAmt, 2, '.', ''),
					"igstVal"=> number_format((float)$total_igstAmt, 2, '.', ''), 
					"OthChrg"=> number_format((float)$total_tcsAmt, 2, '.', ''), 
				    // "cesVal"=> 0,								 
				    // "stCesVal"=> 0,							
					"totInvVal"=> number_format((float)$total_totItemVal, 2, '.', ''),					
					//$tcs_amount,
				    // "rndOffAmt"=> 0,
				    // "totInvValFc"=> 0
			  ),
			"itemList"=> $actualAllItemsArr,						//$itemsarr,
			"EwbDtls"=>array(
					"VehType"=>"R",									// HardCoded - R
					"VehNo"=>$new_sales_data[0]->vehicle_number,	
					"TransMode"=>$new_sales_data[0]->mode,			
					"Distance"=>$new_sales_data[0]->distance		
			)
        )
        );
		


		$this->echoToTriage("<br><br><b>Dynamic Request Data: </b><br>" . json_encode($dynamicData) ."<br><br>");
		$requestData = json_encode($dynamicData);    
		
		//echo "requestData: ".$requestData;
		//exit();

		$result = null;
	    if($isDynamic == true){
			$XConnectorAuthToken = $this->getXConnectorAuthToken();
			
			$this->load->model('EInvoice');
			$result=$this->EInvoice->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero :</b><br>" .json_encode($result) . "<br>");
		}else {
			//****************** HardCoded Response for WAGH TO TEST PDF REPORT ************************* :
		 	$ToWagh_HardCodedResponse = 
				array(
					"data" => 
						array(
							"Status"=> "ACT",
							"EwbNo"=> 341009190177,
							"data" => array(
								"QRdata"=> "{\"SellerGstin\":\"05AALFP1139Q003\",\"BuyerGstin\":\"27AABCM8432E1ZL\",\"DocNo\":\"test/3-4/00151\",\"DocTyp\":\"INV\",\"DocDt\":\"25/02/2023\",\"TotInvVal\":100.00,\"ItemCnt\":2,\"MainHsnCode\":\"7214\",\"Irn\":\"99e849a0ec617d34af5c00b38f7cd209cfdd70259ae24cc6e62dde47bf02adeb\",\"IrnDt\":\"2023-03-07 21:00:54\"}",
								"iss"=> "NIC Sandbox"
							),
							"EwbDt"=> "2023-03-07 21:01:00",
							"Irn"=> "99e849a0ec617d34af5c00b38f7cd209cfdd70259ae24cc6e62dde47bf02adeb",
							"EwbValidTill"=> "2023-03-08 23:59:00",
							"SignedQRCode"=> "eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1MTNCODIxRUU0NkM3NDlBNjNCODZFMzE4QkY3MTEwOTkyODdEMUYiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJGUk80SWU1R3gwbW1PNGJqR0w5eEVKa29mUjgifQ.eyJkYXRhIjoie1wiU2VsbGVyR3N0aW5cIjpcIjA1QUFMRlAxMTM5UTAwM1wiLFwiQnV5ZXJHc3RpblwiOlwiMjdBQUJDTTg0MzJFMVpMXCIsXCJEb2NOb1wiOlwiWVAvMjAyMi0yMy8wMDE1MVwiLFwiRG9jVHlwXCI6XCJJTlZcIixcIkRvY0R0XCI6XCIyNS8wMi8yMDIzXCIsXCJUb3RJbnZWYWxcIjoxMDAuMDAsXCJJdGVtQ250XCI6MixcIk1haW5Ic25Db2RlXCI6XCI3MjE0XCIsXCJJcm5cIjpcIjk5ZTg0OWEwZWM2MTdkMzRhZjVjMDBiMzhmN2NkMjA5Y2ZkZDcwMjU5YWUyNGNjNmU2MmRkZTQ3YmYwMmFkZWJcIixcIklybkR0XCI6XCIyMDIzLTAzLTA3IDIxOjAwOjU0XCJ9IiwiaXNzIjoiTklDIFNhbmRib3gifQ.uG6s3oI1egq2uK0XreW-fYhGXD2N3R1O4k_7w_fX13Q6ylkah_VRBED5b9g_91IjJxjCHTPVtT664hwWdt51rMlSSz66DnLxyC8wXjIsvvA2srm0uxh40DoPBo5A_4muELzHr35Wmu7mseQY8MEbwbxZz5AnQZWoh8QBb_92q4F80sad172wI4yiAwv95e8KT4T820pIGV5QBjTEIKeTGHE8A_MeAp2Gvyo8H5wVNcXhQHquenp4E1alnkjNrgx--3VAITwJI3NXXRRVR41Q1GgoKB2GKm8ymchi13bgzfP6sgeLplkY2_3Fs03H3A_vbi7LPSFvHGh1R1vMlGyd2A",
							"AckNo"=> 132310037223919,
							"AckDt"=> "2023-03-07 21:00:54",
							"SignedInvoice"=> "eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1MTNCODIxRUU0NkM3NDlBNjNCODZFMzE4QkY3MTEwOTkyODdEMUYiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJGUk80SWU1R3gwbW1PNGJqR0w5eEVKa29mUjgifQ.eyJkYXRhIjoie1wiQWNrTm9cIjoxMzIzMTAwMzcyMjM5MTksXCJBY2tEdFwiOlwiMjAyMy0wMy0wNyAyMTowMDo1NFwiLFwiSXJuXCI6XCI5OWU4NDlhMGVjNjE3ZDM0YWY1YzAwYjM4ZjdjZDIwOWNmZGQ3MDI1OWFlMjRjYzZlNjJkZGU0N2JmMDJhZGViXCIsXCJWZXJzaW9uXCI6XCIxLjFcIixcIlRyYW5EdGxzXCI6e1wiVGF4U2NoXCI6XCJHU1RcIixcIlN1cFR5cFwiOlwiQjJCXCIsXCJSZWdSZXZcIjpcIk5cIixcIklnc3RPbkludHJhXCI6XCJOXCJ9LFwiRG9jRHRsc1wiOntcIlR5cFwiOlwiSU5WXCIsXCJOb1wiOlwiWVAvMjAyMi0yMy8wMDE1MVwiLFwiRHRcIjpcIjI1LzAyLzIwMjNcIn0sXCJTZWxsZXJEdGxzXCI6e1wiR3N0aW5cIjpcIjA1QUFMRlAxMTM5UTAwM1wiLFwiTGdsTm1cIjpcIlBhbmNoc2hpbCBUZWNocGFyayBQcml2YXRlIExpbWl0ZWRcIixcIlRyZE5tXCI6XCJQYW5jaHNoaWwgVGVjaHBhcmsgUHJpdmF0ZSBMaW1pdGVkXCIsXCJBZGRyMVwiOlwiUHVuZVwiLFwiTG9jXCI6XCJQdW5lXCIsXCJQaW5cIjoyNjMwMDEsXCJTdGNkXCI6XCIwNVwiLFwiRW1cIjpcInRlc3RAZWludi5jb21cIn0sXCJCdXllckR0bHNcIjp7XCJHc3RpblwiOlwiMjdBQUJDTTg0MzJFMVpMXCIsXCJMZ2xObVwiOlwiTUlMTEVOTklVTSBFTkdJTkVFUlMgQU5EXCIsXCJUcmRObVwiOlwiTUlMTEVOTklVTSBFTkdJTkVFUlMgQU5EXCIsXCJQb3NcIjpcIjI3XCIsXCJBZGRyMVwiOlwiUFVORVwiLFwiQWRkcjJcIjpcIlBVTkVcIixcIkxvY1wiOlwiUFVORVwiLFwiUGluXCI6NDExMDQ1LFwiUGhcIjpcIjAyMDY2ODU0NjAwXCIsXCJFbVwiOlwidGVzdEBlaW52LmNvbVwiLFwiU3RjZFwiOlwiMjdcIn0sXCJEaXNwRHRsc1wiOntcIk5tXCI6XCJQYW5jaHNoaWwgVGVjaHBhcmsgUHJpdmF0ZSBMaW1pdGVkXCIsXCJBZGRyMVwiOlwiUHVuZVwiLFwiQWRkcjJcIjpcIlB1bmVcIixcIkxvY1wiOlwiUHVuZVwiLFwiUGluXCI6NDExMDM4LFwiU3RjZFwiOlwiMjdcIn0sXCJTaGlwRHRsc1wiOntcIkdzdGluXCI6XCIyN0FBQkNNODQzMkUxWkxcIixcIkxnbE5tXCI6XCJNSUxMRU5OSVVNIEVOR0lORUVSUyBBTkRcIixcIkFkZHIxXCI6XCJQVU5FXCIsXCJBZGRyMlwiOlwiUFVORVwiLFwiTG9jXCI6XCJQVU5FXCIsXCJQaW5cIjo0MTEwNDUsXCJTdGNkXCI6XCIyN1wifSxcIkl0ZW1MaXN0XCI6W3tcIkl0ZW1Ob1wiOjAsXCJTbE5vXCI6XCIxXCIsXCJJc1NlcnZjXCI6XCJOXCIsXCJQcmREZXNjXCI6XCJTVEVFTCAxMCBtbSBGZTUwMCAoSVMgMTc4NilcIixcIkhzbkNkXCI6XCI3MjE0XCIsXCJCYXJjZGVcIjpcIjEwMTAwODAyMDAxMlwiLFwiUXR5XCI6MS4wLFwiRnJlZVF0eVwiOjAuMCxcIlVuaXRcIjpcIlRPTlwiLFwiVW5pdFByaWNlXCI6MTAwLjAsXCJUb3RBbXRcIjoxMDAuMDAsXCJBc3NBbXRcIjoxMDAuMDAsXCJHc3RSdFwiOjAuMCxcIklnc3RBbXRcIjowLjAwLFwiQ2dzdEFtdFwiOjAuMDAsXCJTZ3N0QW10XCI6MC4wMCxcIlRvdEl0ZW1WYWxcIjoxMDAuMDAsXCJPcmdDbnRyeVwiOlwiSU5cIn0se1wiSXRlbU5vXCI6MCxcIlNsTm9cIjpcIjJcIixcIklzU2VydmNcIjpcIk5cIixcIlByZERlc2NcIjpcIlNURUVMIDEwIG1tIEZlNTAwIChJUyAxNzg2KS0xXCIsXCJIc25DZFwiOlwiNzIxNFwiLFwiQmFyY2RlXCI6XCIxMDEwMDgwMjAwMTJcIixcIlF0eVwiOjEuMCxcIkZyZWVRdHlcIjowLjAsXCJVbml0XCI6XCJUT05cIixcIlVuaXRQcmljZVwiOjEwMC4wLFwiVG90QW10XCI6MC4wMCxcIkFzc0FtdFwiOjAuMDAsXCJHc3RSdFwiOjAuMCxcIklnc3RBbXRcIjowLjAwLFwiQ2dzdEFtdFwiOjAuMDAsXCJTZ3N0QW10XCI6MC4wMCxcIlRvdEl0ZW1WYWxcIjowLjAwLFwiT3JnQ250cnlcIjpcIklOXCJ9XSxcIlZhbER0bHNcIjp7XCJBc3NWYWxcIjoxMDAuMDAsXCJDZ3N0VmFsXCI6MC4wMCxcIlNnc3RWYWxcIjowLjAwLFwiSWdzdFZhbFwiOjAuMDAsXCJUb3RJbnZWYWxcIjoxMDAuMDB9LFwiRXdiRHRsc1wiOntcIlRyYW5zTW9kZVwiOlwiMVwiLFwiRGlzdGFuY2VcIjoxMCxcIlZlaE5vXCI6XCJNSDExQUsyMDIyXCIsXCJWZWhUeXBlXCI6XCJSXCJ9fSIsImlzcyI6Ik5JQyBTYW5kYm94In0.hV8sVpnpfghWKro3MRO_pWwLp1-JU_6AD9Tb1yRQq6_EmcdafWUxDEuTPhLQv85nK5J5Ii5o7Z3LprAu787Cv5GGJsycngAI-YpNbGmaP7JU-pVrGGzFy8-WXQXi3GDZkwxJ04aodLKZ0HMaLPBMdkjM-QnRRM1tEOf5f8uduVoBdDAqPp2ZeTodN7pY7BUldT3XgIhpubakRziPf2CZ1zEx_qt__xHppMqlsfXnGbCj0CucszsmiVsYlaDS2YIRu3ewz0u2btORITK06T--5n4rlUlkavfOVTQ8lp7daXE33rJ4M5NQxd1OFiKAI4My6mtE1EzfGMUcVZl6V2KZvQ"
						),
						"info"=> null,
						"status"=> "1"
					);
			 $result = $ToWagh_HardCodedResponse;
			 $this->echoToTriage("<b><br><br>Hard Coded Response for testing : <br></b>" . json_encode($ToWagh_HardCodedResponse) . "<br>");
		}
			 
		$isSuccess = false;
		$isDuplicateIRNError = false;
		if(isset($result['status']) && $result['status'] == 0) {
			$this->echoToTriage("API error occured...");
			$errorDet = $result['error'];
			$this->echoToTriage( "<br><br><u>Errors:</u><br>");
			foreach($errorDet as $error) {
					if($error['errorCodes']=="2150"){
						$isDuplicateIRNError = true;
						$alertCode = "<script>
							alert('\\n Einvoice is already generated so refresh View Einvoice page and use Get E-invoice Details button to get Einvoce details. Close this window');
							</script>";
						echo $alertCode;
						$this->addWarningMessage("GST Error Response: <br> ErrorCode: ".$error['errorCodes']." ErrorMsg: " .$error['errorMsg']." <br>Use 'Get E-invoice Details' button to refresh Einvoice details");
					} else {
						$this->echoToTriage("\n GST Error Response: 
							   \n ErrorCode: ".$error['errorCodes']."
							   \n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						echo $alertCode;
					}   
			}
			$this->load->model('EInvoice');
			
			//TO-DO: Future scope for more details
			$infoDet = $result['info'];
			$this->echoToTriage( "<br><br><u>More Details:</u><br>");
			foreach($infoDet as $info) {
				if(isset($info)){
					$this->echoToTriage('<ul><b>IRN Number:</b> ' . $info['Desc']['Irn'] . '</ul>');
					$this->echoToTriage('<ul><b>Information Code:</b> ' . $info['InfCd'] . '</ul>');
					if($isDuplicateIRNError && $info['InfCd']=="DUPIRN"){
						//insert record so this can be used to retrieve Einvoice details
						$response_data = array(
							'new_sales_id' => $new_sales_id,
							'Irn' => $info['Desc']['Irn']
						);
						$insert = $this->Common_admin_model->insert('einvoice_res', $response_data);
					}
					
				}
			}
			
		$this->EInvoice->redirectToParent($new_sales_id); 
				
		}else if(isset($result['status']) && $result['status'] == 1) {
			$isSuccess = true;
			//TO-DO: If there are any more errors for example : EWAY
			$infoDet = $result['info'];
			$this->echoToTriage("EInvoice generated successfully.");
			$alertCode = "<script>alert('EInvoice generated successfully.');</script>";
			echo $alertCode;

			foreach($infoDet as $info) {
				$descDet = $info['Desc'];
				foreach($descDet as $desc) {
					if(isset($info['InfCd']) && isset($info['InfCd']) == "EWBERR") {
							$this->echoToTriage("\n EWAY BILL ERROR: 
									\n ErrorCode: ".$desc['ErrorCode']."
									\n ErrorMsg: " .$desc['ErrorMessage']);
							$alertCode = "<script>
								alert('\\n EWAY BILL ERROR : \\n ErrorCode: ".$desc['ErrorCode']."\\n ErrorMsg: " .$desc['ErrorMessage']."');
								</script>";
							
							echo $alertCode;
						}
					}
				}
			} 
		}	
    //}
	
	if($isSuccess == true) {
		  $gstResponse = $result['data'];
		  //print_r($data); exit;
		  $QRdata = $gstResponse['data'];
		  $issdata = $QRdata['iss'];
		  $QRsdata = $QRdata['QRdata'];
		  $IrnNo=$gstResponse['Irn'];
		  $AckNo=$gstResponse['AckNo'];
		  $AckDt=$gstResponse['AckDt'];
		  $EwbNo= $gstResponse['EwbNo'];
		  $EwbDt= $gstResponse['EwbDt'];
		  $SignedQRCode= $gstResponse['SignedQRCode'];
		  $EwbValidTill = $gstResponse['EwbValidTill'];
		  if(!empty($EwbNo)){
			$ewbStatus = 'ACTIVE';
		  }
		 
		//foreach($QRdata as $QRCodedata)
		//{ Was adding duplicate data 
    
			$QRCodedata_json_decode = json_decode($QRdata);
			$sellrgstn=$QRCodedata_json_decode->SellerGstin;
			$buyergstin=$QRCodedata_json_decode->BuyerGstin;
			$DocNo=$QRCodedata_json_decode->DocNo;
			$DocTyp=$QRCodedata_json_decode->DocTyp;
			$DocDt=$QRCodedata_json_decode->DocDt;
			$TotInvVal=$QRCodedata_json_decode->TotInvVal;
			$ItemCnt=$QRCodedata_json_decode->ItemCnt;
			$MainHsnCode=$QRCodedata_json_decode->MainHsnCode;
			$IrnDt=$QRCodedata_json_decode->IrnDt; 
    
			// Response Insert
			$response_data = array(
				'Status' => $gstResponse['Status'],
				'new_sales_id' => $new_sales_id,
				'EwbNo' => $EwbNo,
				'ack_date' => $gstResponse['AckDt'],
				'AckDt' => $gstResponse['AckDt'],
				'Irn' => $IrnNo,
				'EwbDt' => $gstResponse['EwbDt'],
				'EwbValidTill' => $EwbValidTill,
				'EwbStatus' => $ewbStatus,
				'SignedQRCode' => $SignedQRCode,
				'AckNo' => $AckNo,
				'SignedInvoice' => $gstResponse['SignedInvoice'],
				'info' => $gstResponse['info'],
				'statuscode' => $gstResponse['status']
				//'SellerGstin' => $sellrgstn,
				//'BuyerGstin' => $buyergstin,
				//'DocNo' => $DocNo,
				//'DocTyp' => $DocTyp,
				//'DocDt' => $DocDt,
				//'TotInvVal' => $TotInvVal,
				//'ItemCnt' => $ItemCnt,
				//'MainHsnCode' => $MainHsnCode,
				//'IrnDt' => $IrnDt,
				//'iss' => $issdata,
			);

			$insert = $this->Common_admin_model->insert('einvoice_res', $response_data);
    	//} Was adding duplicate data
 			
		$this->echoToTriage("<br><br>IRN information from Response: <br><b>IRN: ". $IrnNo ." ,<br>Ack No: " .$AckNo ." ,<br>AckDt: " . $AckDt."<br><br>");

		$final_total = 0;
		$cgst_amount = 0;
		$sgst_amount = 0;
		$igst_amount = 0;
		$tcs_amount = 0;
		$height = "350px";

    if ($i == 2) {
      $height = "200px";
    }
    if ($i == 3) {
      $height = "200px";
    }
    if ($i == 4) {
      $height = "200px";
    }
    if ($i == 5) {
      $height = "200px";
    }
    if ($i >= 6) {
      $height = "200px";
    }
    if ($i >= 7) {
      $height = "200px";
    }
    if ($i >= 8) {
      $height = "200px";
    }
    if ($i >= 9) {
      $height = "200px";
    }
    if ($i >= 10) {
      $height = "200px";
    }
    if ($i >= 11) {
      $height = "30px";
    }
    if ($i >= 12) {
      $height = "0px";
    }
    if ($i >= 13) {
      $height = "0px";
    }
    if ($i >= 14) {
      $height = "0px";
    }
    if ($i >= 15) {
      $height = "0px";
    }

	$all_totalOther = $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;
    $final_final_amount = $all_final_totals + $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;
   
    // Sort the multidimensional array by the 'hsn_code' column in ascending order
	$this->Crud->sort_by_column($unsortedHSNCodes, 'hsn_code');
	$hsn_code_table_html = $this-> EInvoice -> getHSNTableData($unsortedHSNCodes);
    
	//$all_final_final_amount = $all_final_totals + $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;

	$transportMode = $this-> EInvoice -> getModeOfTransport ($new_sales_data[0]->mode);
    $html_content = '
	    <!DOCTYPE html>
        <head>
			<style> html { margin: 1px}
			@media print {
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
		<div style>
		<button style="color: white;background-color: red;"onclick="printSection()">Print E-Invoice</button>
		</div>
		<br>
		<div id="print-section">
		<table padding="2" cellspacing="0" border="1px">
			<tr>
				<th colspan="12" style="text-align:center; font-size:16px">EInvoice</th>
			</tr>
			<tr>
				<td colspan="6" align="bottom">
					IRN No :<b>'.$IrnNo.'</b><br>
					Ack No :<b>'.$AckNo.'</b><br>
					Act Date :<b>'.$AckDt.'</b><br><br>
					e-Way Bill No :<b>'.$EwbNo.'</b><br>
					e-Way Bill Date :<b>'.$EwbDt.'</b>
				  </td>
				<td colspan="6" style="padding-top: 5px;padding-bottom: 5px;">    
					<span class="qrcode"></span>
			  </td>
			  <script>
				var qrData ="'.$SignedQRCode.'"; 
				var qrcode = new QRCode(document.querySelector(".qrcode"), {
					text: qrData,
					width: 128,
					height: 128,
					colorDark : "#000000",
					colorLight : "#ffffff",
					correctLevel : QRCode.CorrectLevel.H
				});
			  </script>
			</tr>
			
			<!-- <tr> 
				  <td colspan="6" >IRN No.'.$IrnNo.'</td>      
				  <td colspan="6" rowspan="3" ><img colspan="" src="' . base_url('Logo.jpg') . '" style="float:left;" "></td> 
			</tr> -->    
			<tr style="font-size:14px">
				<td colspan="6"  width="60%">
					<b>'.$client_data[0]->client_name.'</b><br>
					'.$client_data[0]->address1.'<br>
					STATE : ' . $client_data[0]->state . ', STATE CODE : ' . $client_data[0]->state_no . '<br>
					GSTIN/UIN : '  . $client_data[0]->gst_number . '<br>
					PAN NO : ' . $client_data[0]->pan_no . '<br>
				</td>
				<td colspan="6" align="left" width="40%">
					Invoice NO. <b> ' . $new_sales_data[0]->sales_number . '</b><br>
					Invoice Date . <b>' . $po_parts_data[0]->created_date . '</b><br>
					Time of Supply <b> . ' . $po_parts_data[0]->created_time . '</b><br>
					WHETHER TAX ON REVERSE CHARGE  : <b>No</b><br>
				</td>
			</tr>
            <tr style="font-size:14px">
			<td colspan="6">
				<b> Details of Consignee (Shipped to)</b> ,<br>
				<b>' . $shipping_data['shipping_name'] . '</b><br>
				' . $shipping_data['ship_address'] . ' <br>
				STATE : </b>' . $shipping_data['state'] . '<br>
				STATE CODE : ' . $shipping_data['state_no'] . '<br>
				PAN NO : ' . $shipping_data['pan_no'] . '<br>
				GSTIN/UIN : ' . $shipping_data['gst_number'] . '
			</td>
			<td colspan="6">
				<b>Details of Receiver (Billed To)</b><br> 
				<b>' . $customer_data[0]->customer_name . '</b><br>
				' . $customer_data[0]->billing_address . '<br>
				STATE : ' . $customer_data[0]->state . '<br>
				STATE CODE : ' . $customer_data[0]->state_no . '<br>
				PAN NO : ' . $customer_data[0]->pan_no . '<br>
				GSTIN/UIN : ' . $customer_data[0]->gst_number . '
			</td>
        </tr>
        <tr  style="font-size:14px">
        <td colspan="6">
        
        <b>PO Number  :</b>' . $po_parts_data[0]->po_number . '     
        

        <b style="margin-left:10px">PO Date  :</b>' . $po_parts_data[0]->po_date . '
        </td>
        <td colspan="6">
        <b>Vendor Code  . :</b>' . $customer_data[0]->vendor_code . '<br>
        </td>
        </tr>
        <tr style="font-size:12px;text-align:center">
          <th style="width:20px;">Sr No</th>
		  <th style="width:70px;" >Part Number </th>
		  <th colspan="3" style="width:200px;">Part Description </th>
		  <th style="width:50px;" >HSN / SAC </th>
		  <th style="width:20px;">UOM </th>
		  <th style="width:20px;">QTY </th>
		  <th style="width:20px;">Rate/Unit  </th>
		  <th style="width:20px;">Disc. %</th>
		  <th colspan="2">Amount</th>
        </tr>
          ' . $parts_html . '
          <tr>
            <td colspan="12" style="height:' . $height . '"></td>
          </tr>

          <tr style="font-size:12px">
            <td rowspan="3" colspan="7">

            <b>
            Mode Of Transport : ' . $transportMode . ' <br> <br> 
            Transporter : ' . $transporter_data[0]->transporter_id . ' <br> <br>
            Vehicle No : ' . $new_sales_data[0]->vehicle_number . ' <br> <br>
            L.R No : ' . $new_sales_data[0]->lr_number . ' <br> <br>
            </b>

            </td>
          
            <th colspan="3" style="text-align:right">SUB TOTAL </th>
            <th colspan="2">'  . number_format((float)$all_final_totals, 2, '.', '') . '</th>
          </tr>

          <tr style="font-size:12px">
            <th colspan="3" style="text-align:right">CGST Amt' . $cgst . '</th>
            <th colspan="2">' .  number_format((float)$all_cgst_amounts, 2, '.', '') . '</th>
          </tr>
          
          <tr style="font-size:12px">
            <th colspan="3" style="text-align:right">SGST Amt' . $sgst . '</th>
            <th colspan="2">'  . number_format((float)$all_sgst_amounts, 2, '.', '') . '</th>
          </tr>
          <tr style="font-size:12px">
          <td rowspan="3" colspan="7">
            <b>Payment Terms : ' . $customer_data[0]->payment_terms . '</b> <br><br>
            <span><b>Bank Details :</b> ' . $client_data[0]->bank_details . '</span><br> <br>
            <b>Electronic Reference No.</b> <br> <br>
            <span> <b>Invoice Value (In Words):</b> ' . strtoupper($this->getIndianCurrency(number_format((float)$final_final_amount, 2, '.', ''))) . '</span> 
          </td>
		    <th colspan="3" style="text-align:right">IGST Amt' . $igst . '</th>
            <th colspan="2">' .  number_format((float)$all_igst_amounts, 2, '.', '') . '</th>
          </tr>
		  <tr style="font-size:12px">
            <th colspan="3" style="text-align:right">TCS Amt' . $tcs . '</th>
            <th colspan="2">' .  number_format((float)$all_tcs_amounts, 2, '.', '') . '</th>
          </tr>
          
          <tr style="font-size:12px">
            <th colspan="3" style="text-align:right">GRAND TOTAL (Rs) </th>
            <th colspan="2">' . number_format((float)$final_final_amount, 2, '.', '') . '</th>
          </tr>
		  </table>
		  <!-- <div style="page-break-inside:avoid;page-break-after:always"></div> -->
		  <table padding="0" cellspacing="0" border="1px">
			<tr>
			<th colspan="12" style="text-align:center; font-size:16px"></th>
			</tr>
			<tr style="font-size:12px;text-align:center">
				<th colspan="2" width="30%" rowspan="2">HSN/SAC</th>
				<th colspan="2" width="30%" rowspan="2">Taxable</th>
				<th colspan="2" width="10%">Central Tax</th>
				<th colspan="2" width="10%">State Tax</th>
				<th colspan="2" width="10%">IGST</th>
				<th colspan="1" width="10%">TCS</th>
				<th colspan="2" rowspan="2" width="10%">Total Tax Amount</th>
			</tr>
			<tr style="font-size:12px;text-align:center">
				<th>Rate</th>
				<th>Amount</th>
				<th>Rate</th>
				<th>Amount</th>
				<th>Rate</th>
				<th>Amount</th>
				<th>Amount</th>
			</tr>'		
			.$hsn_code_table_html.'
			<tr style="font-size:15px;text-align:right">
			
				<td colspan="2"><b>Total</b></td>
				<td colspan="2"><b>Rs.'.$sortedHSNCodesAssAmt.'</b></td>
				<td colspan="2"><b>Rs.'.$sortedHSNCodesCgstAmt.'</b></td>
				<td colspan="2"><b>Rs.'.$sortedHSNCodesSgstAmt.'</b></td>
				<td colspan="2"><b>Rs.'.$sortedHSNCodesIgstAmt.'</b></td>
				<td colspan="1"><b>Rs.'.$sortedHSNCodesTCSAmt.'</b></td>
				<td colspan="2"><b>Rs.'.($sortedHSNCodesCgstAmt + $sortedHSNCodesSgstAmt +$sortedHSNCodesIgstAmt + $sortedHSNCodesTCSAmt).'</b></td>
			</tr>
	      <tr style="font-size:9px">
            <td colspan="6">
			<p>We hereby certify that my/our registration certificate under the Goods and Service Tax
                Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
                invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
                been effected by me/us and it shall be accounted for in the turnover of sales while filling
                of return and the due tax. If any, payable on the sale has been paid or shall be paid.
                <br>
                Certified that the particulars given above are true and correct and the amount indicated
                represents the price actully charged and that there is no flow of additional consideration
    directly or indirectly from byuer.
    Interest @24% P.A. will be charged on all overdue invoices.<br>
    Subject To Pune Jurisdiction.</p>
          </td>
          <td colspan="3" >
          <br>
          <br>
          <br>
          <br>  
          <br>
          <br>

          <h4 style="text-align: left;margin-left:25px; font-size:11px"> Receiver Signature </h4>
          </td>
          <td colspan="3" >
          
          <h4 style="text-align: right;margin-right:25px; font-size:12px"> For, '.$this->getCustomerNameDetails().' </h4>
          <h6 style="text-align: right">  </h6>
          <h6 style="text-align: right">  </h6>
          <h6 style="text-align: right">  </h6>
          <br>
          <br>
          <h4 style="text-align: right;margin-right:25px; font-size:11px"> Authorized Signatory </h4>
         
          <h6 style="text-align: right">  </h6>
          <h6 style="text-align: right">  </h6>

          </td>
        </tr>
        </table>
		<p><p>
		<div style="page-break-inside:avoid;page-break-after:always"></div>
		<table padding="2" cellspacing="0" border="1px">
			<tr>
				<th colspan="12" style="width:500px; text-align:center; font-size:16px">e-Way Bill</th>
			</tr>
			<tr>
				<td colspan="8" align="bottom">
					Doc No :<b> '.$new_sales_data[0]->sales_number.'</b><br>
					Date   :<b> '.$new_sales_data[0]->created_date.'</b><br>
					IRN    :<b> '.$IrnNo.'</b><br><br>
					Ack No :<b> '.$AckNo.'</b><br>
					Ack Date :<b>'.$AckDt.'</b>
				 </td>
				 <td colspan="4" align="bottom">
					<span class="ewayQRcode"></span>
				 </td>
				  <script>
					var qrData ="'.$EwbNo.'"; 
					var qrcode = new QRCode(document.querySelector(".ewayQRcode"), {
						text: qrData,
						width: 128,
						height: 128,
						colorDark : "#000000",
						colorLight : "#ffffff",
						correctLevel : QRCode.CorrectLevel.H
					});
				</script>
			</tr>
			<tr>
				<td colspan="12" style="text-align:left; font-size:16px" ><b>1. e-Way Bill Details</b><br></th>
			</tr>
			<tr>
				<td colspan="6" align="top">
					e-Way Bill No :<b> '.$EwbNo.'</b><br>
					Generated By   :<b> '.$client_data[0]->gst_number.'</b><br>
					Supply Type    :<b> Outward-Supply</b><br><br>
					Ack No :<b> '.$AckNo.'</b><br>
					Ack Date :<b>'.$AckDt.'</b>
				  </td>
				  <td colspan="4" align="top">
					Mode :<b> '.$new_sales_data[0]->mode.'- Road</b><br>
					Approximate Distance   :<b>'.$new_sales_data[0]->distance.'</b><br>
					Transaction Type    :<b> Regular</b><br><br>
					Ack No :<b> '.$AckNo.'</b><br>
					Ack Date :<b>'.$AckDt.'</b>
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
					'.$customer_data[0]->customer_name.'<br>
					'.$customer_data[0]->billing_address.','.$customer_data[0]->state.' '.$customer_data[0]->pin.'<br>
					GSTIN : '.$customer_data[0]->gst_number .'<br>
				  </td>
			</tr>
			<tr>
				<td colspan="8" align="top">
					<b>Dispatched From :</b><br>
					'.$client_data[0]->client_name.'<br>
					'.$client_data[0]->address1.','.$client_data[0]->state.' '.$client_data[0]->pin.'<br>
					GSTIN : '.$client_data[0]->gst_number.'<br>
				  </td>
				  <td colspan="4" align="top">
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
			    CGST Amt : <b>'.number_format((float)$all_cgst_amounts, 2, '.', '').'</b><br>
				SGST Amt : <b>'.number_format((float)$all_sgst_amounts, 2, '.', '').'</b><br>
				IGST Amt : <b>'.number_format((float)$all_igst_amounts, 2, '.', '').'</b><br>
				TCS Amt  : <b>'.number_format((float)$all_tcs_amounts, 2, '.', '').'</b>
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
				<!-- <td colspan="6" align="top">
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
			$this->pdf->stream("E-Invoice-Details.pdf", array("Attachment" => 1));
		}else{
			echo $html_content;
			die;
		}
	  }
  }

	public function view_e_invoice_by_id() {
		
		$sales_id = $this->uri->segment('2');
		$new_sales = $this->Crud->get_data_by_id("new_sales", $sales_id, "id");
									 
		$data['new_sales'] = $this->Crud->get_data_by_id("new_sales", $sales_id, "id");
		$data['customer'] = $this->Crud->get_data_by_id("customer", $data['new_sales'][0]->customer_id, "id");
		// $data['gst_structure'] = $this->Crud->read_data("gst_structure");
		// $data['uom'] = $this->Crud->read_data("uom");
		$data['transporter'] = $this->Crud->read_data("transporter");
		$sales=array("new_sales_id"=> $sales_id);
        $data['einvoice_res_data'] = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $sales); 
									 
		$data['$new_sales'] = $this->Crud->get_data_by_id("new_sales", $sales_id, "id");
		$this->load->view('header');
		$this->load->view('view_e_invoice_by_id', $data);
		$this->load->view('footer');
	}
	
  /**
   * Cancel E-Invoice
   */
  public function cancel_E_invoice_update()
	{
		$new_sales_id = $this->input->post('new_sales_id');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		  );

		$einvoice_res_data = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $new_sales);
	
		$issdata = $einvoice_res_data[0]->iss; //TO-DO : what to do with this ?
		$IrnNo=$einvoice_res_data[0]->Irn;

		$CancelReason = $this->input->post('CancelReason');
		$CancelRemark = $this->input->post('CancelRemark');

		$this->echoToTriage("<br> CancelReason : ".$CancelReason." <br>CancelRemark : ". $CancelRemark. " <br>IRN No: ".$IrnNo);

		$data = array(
			"Status" => 'CANCELLED',
			"CancelReason" => $CancelReason,
			"CancelRemark" => $CancelRemark,
		);

		$this -> load-> model('EInvoice');
		$token = $this-> EInvoice -> authentication($new_sales_id);
		
		if($token) {
			
			$XConnectorAuthToken = $this->getXConnectorAuthToken();

			if($this->isProduction()==true){
				$url="https://gsthero.com/einvoice/v1.03/invoice/cancel";			
			}else{
				$url="https://qa.gsthero.com/einvoice/v1.03/invoice/cancel";
			}

			$Authorization='Bearer '.$token;         
			$action='CANCELIRN';
			
			$jsondata=array(
				"action"=>"CANCELIRN",
					"data"=>array(
						"Irn"=> $IrnNo,
						"CnlRsn"=> $CancelReason,
						"CnlRem"=> $CancelRemark
					)
			);

			$requestData = json_encode($jsondata);

			//echo "requestData: ".$requestData;
			//exit();

			$cancelResult=$this->EInvoice->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero For Cancel :</b><br>" .json_encode($cancelResult) . "<br>");

			if(isset($cancelResult['status']) && $cancelResult['status'] == 0) {
				$this->echoToTriage("API error occured for Cancel Request...");
				$errorDet = $cancelResult['error'];
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
				$this->load->model('EInvoice');
				$this->EInvoice->redirect($new_sales_id); 

			} else if(isset($cancelResult['status']) && $cancelResult['status'] == 1) {
				$resultUpdate = $this->Common_admin_model->update("einvoice_res", $data, "new_sales_id", $new_sales_id);
				if ($resultUpdate) {
					echo "<script>alert('Envoice Canceled Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					echo "<script>alert('Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
        }      
	}
	
	
	/**
   * Get E-Invoice
   */
   
  public function get_E_invoice()
	{
		$new_sales_id = $this->uri->segment('2');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		  );

		$einvoice_res_data = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $new_sales);
		$IrnNo=$einvoice_res_data[0]->Irn;
		$this -> load-> model('EInvoice');
		$token = $this-> EInvoice -> authentication($new_sales_id);
		
		if($token) {
			$XConnectorAuthToken = $this->getXConnectorAuthToken();

			if($this->isProduction()==true){
				$url= "https://gsthero.com/einvoice/v1.03/invoice/getEinvoice?irn=".$IrnNo;
			}else{
				$url="https://qa.gsthero.com/einvoice/v1.03/invoice/getEinvoice?irn=".$IrnNo;
			}
			$Authorization='Bearer '.$token;         
			$action='FETCHIRNDTL';
		
			$getEinvoiceResult =$this->EInvoice->executeGetMethod($url,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero For GetEinvoice :</b><br>" .json_encode($getEinvoiceResult) . "<br>");
			if(isset($getEinvoiceResult['status']) && $getEinvoiceResult['status'] == 0) {
				$this->echoToTriage("API error occured for GetEinvoice Request...");
				$errorDet = $getEinvoiceResult['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for GetEinvoice Request:</u><br>");
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response for GetEinvoice Request: 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						echo $alertCode;
				}
				$this->load->model('EInvoice');
				$this->EInvoice->redirect($new_sales_id); 

			} else if(isset($getEinvoiceResult['status']) && $getEinvoiceResult['status'] == 1) {
		  
			  $getResponse = $getEinvoiceResult['data'];
			  $IrnNo=$getResponse['Irn'];
			  $ackNo=$getResponse['AckNo'];
			  $EwbNo= $getResponse['EwbNo'];
			  $EwbDt= $getResponse['EwbDt'];
			  $SignedQRCode= $getResponse['SignedQRCode'];
			  $EwbValidTill = $getResponse['EwbValidTill'];
			  if(!empty($EwbNo)){
				$ewbStatus = 'ACTIVE';
			  }
			
			$this->echoToTriage("<br><br>Got Einvoice respone details.<br><b>IRN: ". $IrnNo ." ,<br>Ack No: " .$ackNo ." ,<br>AckDt: " . $ackDt.", EwbNo: ".$EwbNo." , EwbDt: ".$EwbDt."<br><br>");
			
			// Response Insert
			$response_data = array(
				'Status' => $getResponse['Status'],
				'ack_date' => $getResponse['AckDt'],
				'AckDt' => $getResponse['AckDt'],
				'Irn' => $getResponse['Irn'],
				'EwbDt' => $getResponse['EwbDt'],
				'SignedQRCode' => $getResponse['SignedQRCode'],
				'AckNo' => $getResponse['AckNo'],
				'SignedInvoice' => $getResponse['SignedInvoice'],
				'EwbNo' => $getResponse['EwbNo'],
				'EwbValidTill' => $getResponse['EwbValidTill'],
				'EwbStatus' => $ewbStatus
			);

			$resultUpdate = $this->Common_admin_model->update("einvoice_res", $response_data, "new_sales_id", $new_sales_id);
			if ($resultUpdate) {
					echo "<script>alert('Envoice details are fetched sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					echo "<script>alert('Couldn't get Einvoice details please try again.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
        }    
		$this->EInvoice->redirectToParent($new_sales_id); 		
	}


  /**
   * Cancel E-Way Bill
   */
  public function cancel_EWay_Bill_update() {
		$new_sales_id = $this->uri->segment('2');
		// $new_sales_id = $this->input->post('new_sales_id');
		$new_sales=array(
			"new_sales_id"=>$new_sales_id,
		  );

		$einvoice_res_data = $this->Crud->get_data_by_id_multiple_condition("einvoice_res", $new_sales);
	
		$issdata = $einvoice_res_data[0]->iss; //TO-DO : what to do with this ?
		$EwbNo=$einvoice_res_data[0]->EwbNo;
		$IrnNo=$einvoice_res_data[0]->Irn;
		
		$CancelReason = 2;
		$CancelRemark = "Cancelled the order";

		$this->echoToTriage("<br> Cancelled the order for EwbNo: ".$EwbNo);

		$data = array(
			"Status" => 'EWAYBCANCELLED',
			"CancelReason" => 2,
			"CancelRemark" => "Cancelled the order"
		);

		$this -> load-> model('EInvoice');
		$token = $this-> EInvoice -> authentication($new_sales_id);
		
		if($token) {

			$XConnectorAuthToken=$this->getXConnectorAuthToken();
			if($this->isProduction()==true){
				$url="https://gsthero.com/einvoice/v1.03/invoice/cancelewb";
			}else{
				$url="https://qa.gsthero.com/einvoice/v1.03/invoice/cancelewb";
			}
			
			$Authorization='Bearer '.$token;         
			$action='CANCELEWB';
			
			$jsondata=array(
				"action"=>"CANCELEWB",
					"data"=>array(
						"ewbNo"=> $EwbNo,
						"cancelRsnCode"=> $CancelReason,
						"cancelRmrk"=> $CancelRemark
					)
			);

			$requestData = json_encode($jsondata);
			$this->echoToTriage("<br><br><b>Dynamic Request For Cancel EWAY Bill :</b><br>" . json_encode($requestData) . "<br>");
			//echo "requestData: " . $requestData;
			//exit();


			$cancelResult=$this->EInvoice->execute($url,$requestData,$action,$Authorization,$XConnectorAuthToken); 
			$this->echoToTriage("<br><br><b>Response from GSTHero For Cancel EWAY Bill :</b><br>" .json_encode($cancelResult) . "<br>");

			if(isset($cancelResult['status']) && $cancelResult['status'] == 0) {
				$this->echoToTriage("API error occured for Cancel Request...");
				$errorDet = $cancelResult['error'];
				$this->echoToTriage( "<br><br><u>GST Errors for Cancel EWAY Bill Request:</u><br>");
				foreach($errorDet as $error) {
						$this->echoToTriage("\n GST Error Response for Cancel EWAY Bill Request: 
								\n ErrorCode: ".$error['errorCodes']."
								\n ErrorMsg: " .$error['errorMsg']);
						$alertCode = "<script>
							alert('\\n GST Error Response: \\n ErrorCode: ".$error['errorCodes']."\\n ErrorMsg: " .$error['errorMsg']."');
							</script>";
						
						echo $alertCode;
				}
			} else if(isset($cancelResult['status']) && $cancelResult['status'] == 1) {
				$resultUpdate = $this->Common_admin_model->update("einvoice_res", $data, "new_sales_id", $new_sales_id);
				if ($resultUpdate) {
					echo "<script>alert('EWAY Bill Canceled Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				} else {
					echo "<script>alert('Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				}
			}
			//echo "<script>window.close();</script>";
			$this->EInvoice->redirectToParent($new_sales_id); 
        }      
	}


  /**
   * Get EInvoice - from Local DB
   */
  public function view_E_invoice() {
		$this->echoToTriage("<br><u><b>view_E_invoice</b></u>");
		
		$isDynamic = true;
		$downloadPDF = false;
		
		$new_sales_id = $this->uri->segment('2');
		$new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
		$customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");
		
		//get client data based on unit selection
		$client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
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
		$total_tcsAmt = 0;
		$total_totItemVal = 0;

		$unsortedHSNCodes = array();
		$sortedHSNCodesAssAmt = 0;
		$sortedHSNCodesIgstAmt =0;
		$sortedHSNCodesCgstAmt = 0;
		$sortedHSNCodesSgstAmt = 0;
		$sortedHSNCodesTCSAmt = 0;
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
						$sgstAmt = $ps->sgst_amount; //number_format((($actual_indv_totalAmt * $sgsts) / 100), 2, '.', '');	
						$tcsAmt = $ps->tcs_amount; 	 //number_format((($actual_indv_totalAmt * $sgsts) / 100), 2, '.', '');
						
						$total_assAmt = $total_assAmt + $assAmt;
						$total_igstAmt = $total_igstAmt + $igstAmt;
						$total_cgstAmt = $total_cgstAmt + $cgstAmt;
						$total_sgstAmt = $total_sgstAmt + $sgstAmt;
						$total_tcsAmt = $total_tcsAmt + $tcsAmt;
						
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
						//$actualIemsArr['othChrg'] = $tcsAmt;  
						
						//NOTE: We don't need to pass individual other charges but that should be added to totalvalue 
						
						$totItemVal = number_format(($assAmt + $igstAmt + $cgstAmt + $sgstAmt ), 2, '.', ''); 
						$total_totItemVal = $total_totItemVal + $totItemVal + $tcsAmt; //adding other charges(tcs) here to totalvalue 
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
						$unsortedHSN['igstAmt'] = $igstAmt;
						//$unsortedHSN['othChrg'] = $tcsAmt;
						
						//$unsortedHSN['total'] = $totItemVal;
						//echo var_dump($unsortedHSN);
						$sortedHSNCodesAssAmt = $sortedHSNCodesAssAmt +  $assAmt;
						$sortedHSNCodesCgstAmt = $sortedHSNCodesCgstAmt +  $cgstAmt;
						$sortedHSNCodesSgstAmt = $sortedHSNCodesSgstAmt +  $sgstAmt;
						$sortedHSNCodesIgstAmt = $sortedHSNCodesIgstAmt +  $igstAmt;
						$sortedHSNCodesTCSAmt = $sortedHSNCodesTCSAmt +  $tcsAmt;
						$sortedHSNCodesTCSAmt  = number_format((float)$sortedHSNCodesTCSAmt, 2, '.', '');
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
	$this -> load-> model('EInvoice');

	$einvoice_res_id = $this->uri->segment('2');
	$einvoice_res_data = $this->Crud->get_data_by_id("einvoice_res", $einvoice_res_id, "new_sales_id");

		$issdata = $einvoice_res_data[0]->iss; //TO-DO : what to do with this ?

		$IrnNo=$einvoice_res_data[0]->Irn;
		$AckNo=$einvoice_res_data[0]->AckNo;
		$AckDt=$einvoice_res_data[0]->AckDt;
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
		$MainHsnCode=$einvoice_res_data[0]->MainHsnCode;
		$IrnDt=$einvoice_res_data[0]->IrnDt; 
    
		$this->echoToTriage("<br><br>IRN information from Get Invoice: <br><b>IRN: ". $IrnNo ." ,<br>Ack No: " .$AckNo ." ,<br>AckDt: " . $AckDt."<br><br>");

		$final_total = 0;
		$cgst_amount = 0;
		$sgst_amount = 0;
		$igst_amount = 0;
		$tcs_amount = 0;
		$height = "350px";

    if ($i == 2) {
      $height = "200px";
    }
    if ($i == 3) {
      $height = "200px";
    }
    if ($i == 4) {
      $height = "200px";
    }
    if ($i == 5) {
      $height = "200px";
    }
    if ($i >= 6) {
      $height = "200px";
    }
    if ($i >= 7) {
      $height = "200px";
    }
    if ($i >= 8) {
      $height = "200px";
    }
    if ($i >= 9) {
      $height = "200px";
    }
    if ($i >= 10) {
      $height = "200px";
    }
    if ($i >= 11) {
      $height = "30px";
    }
    if ($i >= 12) {
      $height = "0px";
    }
    if ($i >= 13) {
      $height = "0px";
    }
    if ($i >= 14) {
      $height = "0px";
    }
    if ($i >= 15) {
      $height = "0px";
    }


    $all_totalOther = $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;
    $final_final_amount = $all_final_totals + $all_cgst_amounts + $all_sgst_amounts + $all_igst_amounts + $all_tcs_amounts;

	// Sort the multidimensional array by the 'hsn_code' column in ascending order
	$this->Crud->sort_by_column($unsortedHSNCodes, 'hsn_code');
	$hsn_code_table_html = $this-> EInvoice -> getHSNTableData($unsortedHSNCodes);
	$transportMode = $this-> EInvoice -> getModeOfTransport ($new_sales_data[0]->mode);

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
		<button style="color: white;background-color: red;"onclick="printSection()">Print E-Invoice</button>
		</div>
		<br>
		<div id="print-section">
		<table cellspacing="0" border="1px">
		<tr>
			<th colspan="12" style="text-align:center; font-size:16px">EInvoice</th>
		</tr>
		<tr>
			<td colspan="6" align="bottom">
				IRN No :<b>'.$IrnNo.'</b><br>
				Ack No :<b>'.$AckNo.'</b><br>
				Act Date :<b>'.$AckDt.'</b><br><br>
				e-Way Bill No :<b>'.$EwbNo.'</b><br>
				e-Way Bill Date :<b>'.$EwbDt.'</b>
			  </td>
			<td colspan="6" style="padding-top: 5px;padding-bottom: 5px;"> 
				<span class="qrcode"></span>
		  </td>
		  <script>
			var qrData ="'.$SignedQRCode.'"; 
			var qrcode = new QRCode(document.querySelector(".qrcode"), {
				text: qrData,
				width: 128,
				height: 128,
				colorDark : "#000000",
				colorLight : "#ffffff",
				correctLevel : QRCode.CorrectLevel.H
			});
		  </script>
		</tr>
		
		<!-- <tr> 
			  <td colspan="6" >IRN No.'.$IrnNo.'</td>      
			  <td colspan="6" rowspan="3" ><img colspan="" src="' . base_url('Logo.jpg') . '" style="float:left;" "></td> 
		</tr> -->    
		<tr style="font-size:14px">
			<td colspan="6" width="60%">
					<b>'.$client_data[0]->client_name.'</b><br>
					'.$client_data[0]->address1.'<br>
					STATE : ' . $client_data[0]->state . ', STATE CODE : ' . $client_data[0]->state_no . '<br>
					GSTIN/UIN : '  . $client_data[0]->gst_number . '<br>
					PAN NO : ' . $client_data[0]->pan_no . '<br>
			</td>
			<td colspan="6" align="left" width="40%">
				Invoice NO. <b> ' . $new_sales_data[0]->sales_number . '</b><br>
				Invoice Date . <b>' . $po_parts_data[0]->created_date . '</b><br>
				Time of Supply <b> . ' . $po_parts_data[0]->created_time . '</b><br>
				WHETHER TAX ON REVERSE CHARGE  : <b>No</b><br>
			</td>
		</tr>
		<tr style="font-size:14px">
		<td colspan="6">
			<b> Details of Consignee (Shipped to)</b> ,<br>
			<b>' . $shipping_data['shipping_name'] . '</b><br>
			' . $shipping_data['ship_address'] . '<br>
			STATE : ' . $shipping_data['state'] . '<br>
			STATE CODE : ' . $shipping_data['state_no'] . '<br>
			PAN NO : ' . $shipping_data['pan_no'] . '<br>
			GSTIN/UIN : ' . $shipping_data['gst_number']. '
		</td>
		<td colspan="6">
			<b>Details of Receiver (Billed To)</b><br> 
			' . $customer_data[0]->customer_name . '<br>
			' . $customer_data[0]->billing_address . '<br>
			STATE : ' . $customer_data[0]->state . '<br>
			STATE CODE : ' . $customer_data[0]->state_no . '<br>
			PAN NO : ' . $customer_data[0]->pan_no . '<br>
			GSTIN/UIN : ' . $customer_data[0]->gst_number . '
		</td>
	</tr>
	<tr  style="font-size:14px">
	<td colspan="6">
	
	<b>PO Number  :</b>' . $po_parts_data[0]->po_number . '        
	

	<b style="margin-left:10px">PO Date  :</b>' . $po_parts_data[0]->po_date . '
	</td>
	<td colspan="6">
	<b>Vendor Code  . :</b>' . $customer_data[0]->vendor_code . '<br>

	</td>

	
	</tr>
	
	<tr style="font-size:12px;text-align:center">
		  <th style="width:20px;">Sr No</th>
		  <th style="width:70px;">Part Number </th>
		  <th colspan="3" style="width:200px;">Part Description </th>
		  <th style="width:50px;" >HSN / SAC </th>
		  <th style="width:20px;">UOM </th>
		  <th style="width:20px;">QTY </th>
		  <th style="width:20px;">Rate/Unit  </th>
		  <th style="width:20px;">Disc. %</th>
		  <th colspan="2">Amount</th>
	</tr>
	  ' . $parts_html . '
	  <tr>
		<td colspan="12" style="height:' . $height . '"></td>
	  </tr>

	  <tr style="font-size:12px">
		<td rowspan="3" colspan="7">
		<b>Mode Of Transport : ' . $transportMode . ' <br> <br> 
		Transporter : ' . $transporter_data[0]->transporter_id . ' <br> <br>
		Vehicle No : ' . $new_sales_data[0]->vehicle_number . ' <br> <br>
		L.R No : ' . $new_sales_data[0]->lr_number . ' <br> <br>
		</b>
		</td>
		<th colspan="3" style="text-align:right">SUB TOTAL </th>
		<th colspan="2">'  . number_format((float)$all_final_totals, 2, '.', '') . '</th>
	  </tr>

	  <tr style="font-size:12px">
		<th colspan="3" style="text-align:right">CGST Amt' . $cgst . '</th>
		<th colspan="2">' .  number_format((float)$all_cgst_amounts, 2, '.', '') . '</th>
	  </tr>
	  
	  <tr style="font-size:12px">
		<th colspan="3" style="text-align:right">SGST Amt' . $sgst . '</th>
		<th colspan="2">'  . number_format((float)$all_sgst_amounts, 2, '.', '') . '</th>
	  </tr>
	  <tr style="font-size:12px">
	  <td rowspan="3" colspan="7">
		
		<b>Payment Terms : ' . $customer_data[0]->payment_terms . '</b> <br><br>
		<span><b>Bank Details :</b> ' . $client_data[0]->bank_details . '</span><br> <br>
		<b>Electronic Reference No.</b> <br> <br>
		<span> <b>Invoice Value (In Words):</b> ' . strtoupper($this->getIndianCurrency(number_format((float)$final_final_amount, 2, '.', ''))) . '</span> 
	</td>
		<th colspan="3" style="text-align:right">IGST Amt' . $igst . '</th>
		<th colspan="2">' .  number_format((float)$all_igst_amounts, 2, '.', '') . '</th>
	  </tr>
	  <tr style="font-size:12px">
		<th colspan="3" style="text-align:right">TCS Amt' . $tcs . '</th>
		<th colspan="2">' .  number_format((float)$all_tcs_amounts, 2, '.', '') . '</th>
	  </tr>
	  
	  <tr style="font-size:12px">
		<th colspan="3" style="text-align:right">GRAND TOTAL (Rs) </th>
		<th colspan="2">' . number_format((float)$final_final_amount, 2, '.', '') . '</th>
	  </tr>
	  
	  </table>
		  <!-- <div style="page-break-inside:avoid;page-break-after:always"></div> -->
		  <table padding="0" cellspacing="0" border="1px">
			<tr>
				<th colspan="12" style="text-align:center; font-size:16px"></th>
			</tr>
			<tr style="font-size:12px;text-align:center">
			  <th colspan="2" width="30%" rowspan="2">HSN/SAC</th>
			  <th colspan="2" width="30%" rowspan="2">Taxable</th>
			  <th colspan="2" width="10%">Central Tax</th>
			  <th colspan="2" width="10%">State Tax</th>
			  <th colspan="2" width="10%">IGST</th>
			  <th colspan="1" width="10%">TCS</th>
			  <th colspan="2" rowspan="2" width="10%">Total Tax Amount</th>
			</tr>
			<tr style="font-size:12px;text-align:center">
			  <th>Rate</th>
			  <th>Amount</th>
			  <th>Rate</th>
			  <th>Amount</th>
			  <th>Rate</th>
			  <th>Amount</th>
			  <th>Amount</th>
			</tr>
			
			'
			
			.$hsn_code_table_html.'
			<tr style="font-size:15px;text-align:right">
			
			  <td colspan="2"><b>Total</b></td>
			  <td colspan="2"><b>Rs.'.$sortedHSNCodesAssAmt.'</b></td>
			  <td colspan="2"><b>Rs.'.$sortedHSNCodesCgstAmt.'</b></td>
			  <td colspan="2"><b>Rs.'.$sortedHSNCodesSgstAmt.'</b></td>
			  <td colspan="2"><b>Rs.'.$sortedHSNCodesIgstAmt.'</b></td>
			  <td colspan="1"><b>Rs.'.$sortedHSNCodesTCSAmt.'</b></td>
			  <td colspan="2"><b>Rs.'.($sortedHSNCodesCgstAmt + $sortedHSNCodesSgstAmt +$sortedHSNCodesIgstAmt + $sortedHSNCodesTCSAmt).'</b></td>
			</tr>
			
	  <tr style="font-size:9px">
		<td colspan="6">
		<p>We hereby certify that my/our registration certificate under the Goods and Service Tax
			Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
			invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
			been effected by me/us and it shall be accounted for in the turnover of sales while filling
			of return and the due tax. If any, payable on the sale has been paid or shall be paid.
			<br>
			Certified that the particulars given above are true and correct and the amount indicated
			represents the price actully charged and that there is no flow of additional consideration
directly or indirectly from byuer.
Interest @24% P.A. will be charged on all overdue invoices.<br>
Subject To Pune Jurisdiction</p>
	  </td>
	  <td colspan="3" >
	  <br>
	  <br>
	  <br>
	  <br>  
	  <br>
	  <br>

	  <h4 style="text-align: left;margin-left:25px; font-size:11px"> Receiver Signature </h4>
	  </td>
	  <td colspan="3" >
	  
	  <h4 style="text-align: right;margin-right:25px; font-size:12px"> For, '.$this->getCustomerNameDetails().' </h4>
	  <h6 style="text-align: right">  </h6>
	  <h6 style="text-align: right">  </h6>
	  <h6 style="text-align: right">  </h6>
	  <br>
	  <br>
	  <h4 style="text-align: right;margin-right:25px; font-size:11px"> Authorized Signatory </h4>
	 
	  <h6 style="text-align: right">  </h6>
	  <h6 style="text-align: right">  </h6>

	  </td>
	</tr>
	</table>
	<div style="page-break-inside:avoid;page-break-after:always"></div>
	<table padding="2" cellspacing="0" border="1px">
		<tr>
			<th colspan="12" style="width:600px; text-align:center; font-size:16px">e-Way Bill</th>
		</tr>
		<tr>
				<td colspan="8" align="bottom">
					Doc No :<b> '.$new_sales_data[0]->sales_number.'</b><br>
					Date   :<b> '.$new_sales_data[0]->created_date.'</b><br>
					IRN    :<b> '.$IrnNo.'</b><br><br>
					Ack No :<b> '.$AckNo.'</b><br>
					Ack Date :<b>'.$AckDt.'</b>
				 </td>
				 <td colspan="4" align="bottom">
					<span class="ewayQRcode"></span>
				 </td>
				  <script>
					var qrData ="'.$EwbNo.'"; 
					var qrcode = new QRCode(document.querySelector(".ewayQRcode"), {
						text: qrData,
						width: 128,
						height: 128,
						colorDark : "#000000",
						colorLight : "#ffffff",
						correctLevel : QRCode.CorrectLevel.H
					});
				</script>
			</tr>
		<tr>
			<td colspan="12" style="text-align:left; font-size:16px"><b>1. e-Way Bill Details</b><br></th>
		</tr>
		<tr>
			<td colspan="6" align="top">
				e-Way Bill No :<b> '.$EwbNo.'</b><br>
				Generated By   :<b> '.$client_data[0]->gst_number.'</b><br>
				Supply Type    :<b> Outward-Supply</b><br><br>
				Ack No :<b> '.$AckNo.'</b><br>
				Ack Date :<b>'.$AckDt.'</b>
			  </td>
			  <td colspan="4" align="top">
				Mode :<b> '.$new_sales_data[0]->mode.'- Road</b><br>
				Approximate Distance   :<b>'.$new_sales_data[0]->distance.'</b><br>
				Transaction Type    :<b> Regular</b><br><br>
				Ack No :<b> '.$AckNo.'</b><br>
				Ack Date :<b>'.$AckDt.'</b>
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
				'.$customer_data[0]->customer_name.'<br>
				'.$customer_data[0]->billing_address.','.$customer_data[0]->state.' '.$customer_data[0]->pin.'<br>
				GSTIN : '.$customer_data[0]->gst_number .'<br>
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
					GSTIN : '. $shipping_data['gst_number'] .'<br>
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
			    CGST Amt : <b>'.number_format((float)$all_cgst_amounts, 2, '.', '').'</b><br>
				SGST Amt : <b>'.number_format((float)$all_sgst_amounts, 2, '.', '').'</b><br>
				IGST Amt : <b>'.number_format((float)$all_igst_amounts, 2, '.', '').'</b><br>
				TCS Amt  : <b>'.number_format((float)$all_tcs_amounts, 2, '.', '').'</b>
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
	  
}

