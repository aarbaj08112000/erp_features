<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('C_PLASTIC','C_PLASTIC');
define('C_JOB_ROOT','C_JOB_ROOT');
define('C_SHEET_METAL','C_SHEET_METAL');
require_once('AROMConfigController.php');

/**
 * This has all the configurations around serial number and customer entitlments.
 */
class ConfigController extends AROMConfigController {

	 const TUSHAR_ENGG_SMF = 'TusharEngg';
	 const SHRI_ENGG_SMF = 'SHRI_ENGG_SMF';
	 const TECH_INN_ENGG_SMF = 'TECH_INN_ENGG_SMF';

	 const COMMON_SHEET_METAL = 'COMMON_SHEET_METAL';
	 const COMMON_PLASTIC = 'COMMON_PLASTIC';
	 const BSP_SMF = 'BSP';
	 const BUDHALE_SMF = 'BUDHALE_SMF';
	
	 const MAYURESH_PLASTIC = 'Mayuresh';
	 const SP_PLASTIC = "SUPER_POLYMER";
	 const ARMS_PLASTIC = "ARMS_PLASTIC";
	 const AIMS_PLASTIC = "AIMS_PLASTIC";
	 const SIDHANT_PLASTIC = 'SIDHANT_PLASTIC';


	 const C_SHEET_METAL = C_SHEET_METAL;
	 const C_PLASTIC = C_PLASTIC;
	 const C_JOB_ROOT = C_JOB_ROOT;

	/**
	 *  ================================================================================================
	 *  									DON'T CHANGE/CONFIGURE BELOW ITEMS
	 *  =================================================================================================
	 */

	 //Used for lock scenario...
	public function getLockSalesNumber($saleNo) {
		/*if(self::SP_PLASTIC == $this->getAROMCustomerName() ||
			self::ARMS_PLASTIC == $this->getAROMCustomerName() ||
				self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			return $this->getCustomizedLockSalesNumber($saleNo);
		} else { */

		if(self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()
				|| self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName()
				|| self::SIDHANT_PLASTIC == $this->getAROMCustomerName()
				|| self::SHRI_ENGG_SMF == $this->getAROMCustomerName()
				|| self::BUDHALE_SMF == $this->getAROMCustomerName()
				|| self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			return $this->getCustomizedLockSalesNumber($saleNo);
		}else { 
			return $this->getCustomerSerialNo().$saleNo;
		}
	}

	public function getSalesNoFormat($isTemp=true,$withLike=false) {
		/*if(self::SP_PLASTIC == $this->getAROMCustomerName() ||
				self::ARMS_PLASTIC == $this->getAROMCustomerName() ||
					self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
				return $this->getCustomizedSalesNoFormat($isTemp,$withLike);
		} else { */
			

		if(self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName() 
			|| self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName() 
			|| self::SIDHANT_PLASTIC == $this->getAROMCustomerName() 
			|| self::SHRI_ENGG_SMF == $this->getAROMCustomerName() 
			|| self::BUDHALE_SMF == $this->getAROMCustomerName()
			|| self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
				return $this->getCustomizedSalesNoFormat($isTemp,$withLike);
		} else {
			if($isTemp == true) {
				return $withLike==true ? $this->getCustomerTempSerialNo()."%" : $this->getCustomerTempSerialNo();
			} else {
				return $withLike==true ? $this->getCustomerSerialNo()."%" : $this->getCustomerSerialNo();
			}
		}
	}

	//Used for temporarily mainly
	public function getCompleteSalesNumber($isTemp, $currentSaleNo) {
		/*if(self::SP_PLASTIC == $this->getAROMCustomerName() ||
				self::ARMS_PLASTIC == $this->getAROMCustomerName()||
				self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
				return $this->getCustomizedSalesNumber($currentSaleNo);
		} else { */
		
		if(self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName() 
			|| self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName() 
			|| self::SIDHANT_PLASTIC == $this->getAROMCustomerName()
			|| self::SHRI_ENGG_SMF == $this->getAROMCustomerName()
			|| self::BUDHALE_SMF == $this->getAROMCustomerName()
			|| self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
				return $this->getCustomizedSalesNumber($currentSaleNo);
		} else { 
				$sales_num = substr($currentSaleNo, strlen($this->getSalesNoFormat($isTemp)));
				$new_sale_num =  $this->getSalesNoFormat($isTemp) . ($sales_num + 1);
				return $new_sale_num;
		}
	}

	/**
	 * CUSTOMIZATION FOR SPERP AND AIMS 
	 * DO NOT CHANGE ANYTHING BELOW AS IT HAS IMPACT TO SALES REPORT, SALES INVOICE 
	 */
	public function getCustomizedLockSalesNumber($saleNo) {
		if (self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()
			|| self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName()) {
    		return $saleNo;
		} else if(self::SIDHANT_PLASTIC == $this->getAROMCustomerName()) {
			return $this->getFinancialYear()."/".$saleNo;
		} else if(self::SHRI_ENGG_SMF == $this->getAROMCustomerName()) {
			return $this->getCustomerPrefix()."/2425/".$saleNo;
		} else if(self::BUDHALE_SMF == $this->getAROMCustomerName()) {
			return $saleNo."/".$this->getFinancialYear();
		} else if (self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			return $this->getCustomerPrefix().$saleNo;
		}

		/*else if(self::SP_PLASTIC == $this->getAROMCustomerName()) {
			return $saleNo."/".$this->getFinancialYear();
		} else if (self::ARMS_PLASTIC == $this->getAROMCustomerName()) {
			return $saleNo;
		}else if (self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			return $this->getCustomerPrefix().$saleNo;
		}*/

	}

	public function getCustomizedSalesNumber($currentSaleNo) {
		if (self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()
			|| self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName()
			|| self::SIDHANT_PLASTIC == $this->getAROMCustomerName()
			|| self::SHRI_ENGG_SMF == $this->getAROMCustomerName()
			|| self::BUDHALE_SMF == $this->getAROMCustomerName()
			|| self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			$sales_num = substr($currentSaleNo, strlen($this->getCustomizedSalesNoFormat(true)."/")); // Format is TEMP/23-24/1 ;
			$nextSalesNo = $sales_num + 1;
			return "TEMP/".$this->getFinancialYear()."/".$nextSalesNo;	// Format is TEMP/23-24/1 ;
		}

		/*else if(self::SP_PLASTIC == $this->getAROMCustomerName()) {
			// Get the substring before the first '/' in this case we have sales number as 2 from format 2/TEMP/23-24
			$currentSaleNo = strstr($currentSaleNo, '/', true); 
			$nextSalesNo = $currentSaleNo + 1;
			return $nextSalesNo."/TEMP/".$this->getFinancialYear();
		} else if (self::ARMS_PLASTIC == $this->getAROMCustomerName()) {
			$sales_num = substr($currentSaleNo, strlen($this->getCustomizedSalesNoFormat(true)."/")); // Format is TEMP/23-24/1 ;
			$nextSalesNo = $sales_num + 1;
			return "TEMP/".$this->getFinancialYear()."/".$nextSalesNo;	// Format is TEMP/23-24/1 ;
		} else if (self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			$sales_num = substr($currentSaleNo, strlen($this->getCustomizedSalesNoFormat(true))); // Format is TEMP/1 ;
			$nextSalesNo = $sales_num + 1;
			return "TEMP/".$nextSalesNo;	// Main lock Format is AP/1 TEMP/1
		} */

	}

	public function getCustomizedSalesNoFormat($isTemp,$withLike=false) {
		if (self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName() ||
			self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName() ) {
			if($isTemp==true) {
				return $withLike==true ? "TEMP/".$this->getFinancialYear()."/"."%" : "TEMP/".$this->getFinancialYear();
			}else {
				return $withLike==true ? "%" : "";
			}
		}
		if (self::SIDHANT_PLASTIC == $this->getAROMCustomerName()) {
			if ($isTemp == true) {
				return $withLike == true ? "TEMP/" . $this->getFinancialYear() . "/" . "%" : "TEMP/" . $this->getFinancialYear();
			} else {
				return $withLike == true ? $this->getFinancialYear()."/"."%" : $this->getFinancialYear()."/";
			}
		}

		if (self::BUDHALE_SMF == $this->getAROMCustomerName()) {
			if ($isTemp == true) {
				return $withLike == true ? "TEMP/" . $this->getFinancialYear() . "/" . "%" : "TEMP/" . $this->getFinancialYear();
			} else {
				return $withLike == true ? "%"."/".$this->getFinancialYear(): "/".$this->getFinancialYear();
			}
		}

		if (self::SHRI_ENGG_SMF == $this->getAROMCustomerName()) {
			if ($isTemp == true) {
				return $withLike == true ? "TEMP/" . $this->getFinancialYear() . "/" . "%" : "TEMP/" . $this->getFinancialYear();
			} else {
				return $withLike == true ? $this->getCustomerPrefix(). "/" . "2425/"."%" : $this->getCustomerPrefix()."/2425";
			}
		}else if (self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			if($isTemp==true) {
				return $withLike == true ? "TEMP/" . $this->getFinancialYear() . "/" . "%" : "TEMP/" . $this->getFinancialYear();
			} else {
				return $withLike==true ? "%" : "";
			}
		}



		/* else if(self::SP_PLASTIC == $this->getAROMCustomerName()) {
			if($isTemp==true) {
				return $withLike==true ? "%"."/TEMP/".$this->getFinancialYear() : "/TEMP/".$this->getFinancialYear();
			}else {
				return $withLike==true ? "%"."/".$this->getFinancialYear() : "/".$this->getFinancialYear();
			}
		}else if (self::ARMS_PLASTIC == $this->getAROMCustomerName()) {
			if($isTemp==true) {
				return $withLike==true ? "TEMP/".$this->getFinancialYear()."/"."%" : "TEMP/".$this->getFinancialYear();
			}else {
				return $withLike==true ? "%" : "";
			}
		}else if (self::AIMS_PLASTIC == $this->getAROMCustomerName()) {
			if($isTemp==true) {
				return $withLike==true ? "TEMP/%" : "TEMP/";
			}else {
				return $withLike==true ? "%" : "";
			}
		} */
	
	}

	public function getCustomerTempSerialNo() {
		return "TEMP-".$this->getFinancialYear()."/";
	}

	public function getCustomerSerialNo() {
		return $this->getCustomerPrefix()."/".$this->getFinancialYear()."/";
	}

	public function getSalesRejectionSerialNo() {
		return $this->getCustomerPrefix()."/SI-REJ/".$this->getFinancialYear()."/";
	}

	public function getChallanSerialNo() {
		return $this->getCustomerPrefix()."/CH/" . $this->getFinancialYear()."/";
	}

	public function getPOSerialNo() {
		return $this->getCustomerPrefix()."/PUR/".$this->getFinancialYear()."/";
	}

	public function getSUBPOSerialNo() {
		return $this->getCustomerPrefix()."/SUB/".$this->getFinancialYear()."/";
	}

	public function getSUBCON_SerialNo() {
		return $this->getCustomerPrefix()."/".$this->getFinancialYear()."/";		
	}

	public function getGrnSerialNo() {
		return $this->getFinancialYear()."/";		
	}

	public function getShopOrderSerialNo() {
		return "SO/".$this->getFinancialYear()."/";	
	}

	//Not sure whether this is being really used or not..
	public function getSalesRejectionTestSerialNo() {
		return $this->getCustomerPrefix()."/".$this->getFinancialYear()."/";		
	}


	/**
	 *  ================================================================================================
	 *  		ENTITLEMENTS -  DON'T CHANGE/CONFIGURE BELOW ITEMS
	 *  =================================================================================================
	 */

	/**
	 * Check for appropriate commodity
	 */
	public function getCommodity(){
		if(self::BSP_SMF == $this->getAROMCustomerName()
			|| self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()
			|| self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName()
			|| self::COMMON_SHEET_METAL == $this->getAROMCustomerName()
			|| self::SHRI_ENGG_SMF == $this->getAROMCustomerName()
			|| self::BUDHALE_SMF == $this->getAROMCustomerName()) {
			return C_SHEET_METAL;
		}else if(self::MAYURESH_PLASTIC == $this->getAROMCustomerName()
		    || self::SP_PLASTIC == $this->getAROMCustomerName()
			|| self::ARMS_PLASTIC == $this->getAROMCustomerName()
			|| self::COMMON_PLASTIC == $this->getAROMCustomerName()
			|| self::AIMS_PLASTIC == $this->getAROMCustomerName()
			|| self::SIDHANT_PLASTIC == $this->getAROMCustomerName()){
			return C_PLASTIC;
		}else{
			return C_JOB_ROOT;
		}	
	}

	/**
	 * Get entitlements
	 */
	public function getEntitlements() {	
		if(self::C_SHEET_METAL == $this->getCommodity()) {
			if(self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()){
				$tushar_engg_entitlements = array(
					"po_import_export"=> true,
					"isGrade"=> false,
					"isPLMEnabled" => true,
					"itemCode" => true,
					"Commodity" => C_SHEET_METAL,
					"isSheetMetal" => true
				);
				return $tushar_engg_entitlements;
			} else if(self::BSP_SMF == $this->getAROMCustomerName()){
					$bsp_entitlements = array(
						"po_import_export"=> false,
						"isGrade"=> false,
						"isPLMEnabled" => false,
						"Commodity" => C_SHEET_METAL,
						"isSheetMetal" => true
					); 
					return $bsp_entitlements;
			} else if (self::BUDHALE_SMF == $this->getAROMCustomerName()) {
					$bsp_entitlements = array(
						"po_import_export" => false,
						"isGrade" => false,
						"isPLMEnabled" => true,
						"itemCode" => true,
						"Commodity" => C_SHEET_METAL,
						"isSheetMetal" => true,
					);
					return $bsp_entitlements;
			} else if(self::COMMON_SHEET_METAL == $this->getAROMCustomerName()) {
				$entitlements = array(
					"po_import_export"=> false,
					"isGrade"=> false,
					"isPLMEnabled" => true,
					"Commodity" => C_SHEET_METAL,
					"isSheetMetal" => true
				);
				return $entitlements;
			} else if (self::TECH_INN_ENGG_SMF == $this->getAROMCustomerName()) {
				$tech_inn_entitlements = array(
					"po_import_export" => true,
					"isGrade" => false,
					"isPLMEnabled" => true,
					"Commodity" => C_SHEET_METAL,
					"isSheetMetal" => true,
				);
				return $tech_inn_entitlements;
			} else if(self::SHRI_ENGG_SMF == $this->getAROMCustomerName()){
				$shri_engg_entitlements = array(
					"po_import_export"=> true,
					"isGrade"=> false,
					"isPLMEnabled" => false,
					"itemCode" => false,
					"Commodity" => C_SHEET_METAL,
					"isSheetMetal" => true
				);
				return $shri_engg_entitlements;
			}

		}
		
		//Plastic ->
		if(self::C_PLASTIC == $this->getCommodity()) {
			if(self::MAYURESH_PLASTIC == $this->getAROMCustomerName()){
				$mayuresh_entitlements = array(
					"po_import_export"=> false,
					"isGrade"=> true,
					"isPLMEnabled" => true,
					"Commodity" => C_PLASTIC,
					"isPlastic" => true
				);
				return $mayuresh_entitlements;
			}
			
			if(self::SP_PLASTIC == $this->getAROMCustomerName()	|| 
				self::ARMS_PLASTIC == $this->getAROMCustomerName() ||
				self::AIMS_PLASTIC == $this->getAROMCustomerName() ||
				self::SIDHANT_PLASTIC == $this->getAROMCustomerName()){
				$sp_plastic = array(
					"po_import_export"=> false,
					"isGrade"=> true,
					"isPLMEnabled" => true,
					"Commodity" => C_PLASTIC,
					"isPlastic" => true
				);
				return $sp_plastic;
			} else if(self::COMMON_PLASTIC == $this->getAROMCustomerName()){
				$entitlements = array(
					"po_import_export"=> false,
					"isGrade"=> true,
					"isPLMEnabled" => true,
					"Commodity" => C_PLASTIC,
					"isPlastic" => true
				);
				return $entitlements;
			}
		}
	}	

	//Multiple Client support check
	public function isMultiClientSupport() {
		
		$isMultipleClientUnit = isset($this->session->userdata['isMultipleClientUnits']) ? $this->session->userdata['isMultipleClientUnits'] : '';
		if(empty($isMultipleClientUnit) || $isMultipleClientUnit == '' ) {
			$isMultipleClientUnit = $this->readConfig("isMultipleClientUnits","false");
			$this->session->set_userdata('isMultipleClientUnits',$isMultipleClientUnit);
		}
		return $isMultipleClientUnit;
	}

	//Multiple Client support check
	public function getNoOfClients() {
		$clientCount = $this->session->userdata['noOfClients'];
		if(empty($clientCount) || $clientCount == '' ) {
			$clientCount = $this->Crud->record_count("client");
			$this->session->set_userdata('noOfClients',$clientCount); //Total no of client in DB
		}
		return $clientCount;
	}

	//Get current client details..
	public function getClientUnitDetails($clientUnit=null) {
		$client = null;
		if(empty($clientUnit)) {
			$clientUnit = $this->session->userdata['clientUnit'];
			
		}
		if(!empty($clientUnit)) {
			$data = array(
				"id" => $clientUnit
			);
			$client = $this->Crud->get_data_by_id_multiple("client", $data);
			$this->session->set_userdata('clientUnit', $client[0]->id); //set the clientUnit to session..
			$this->session->set_userdata('clientUnitName', $client[0]->client_unit); //set the clientUnit to session..
		}
		return $client;
	}


	/* get credit note/debit note / performa invice code */
	public function getFomrmateData($type = "",$prifix = "",$is_temp = "No") {

		$data = $this->Crud->get_data_by_id("global_formate_configuration", $type, "config_name");
		$cleanedString = str_replace(['{', '}'], '', $data[0]->formate_structure);
		$formate_arr = explode("/", $cleanedString); 
		if($data[0]->is_year_enable == "No"){
			$arr_key = array_search('FY', $formate_arr);
			if($arr_key > -1){
				unset($formate_arr[$arr_key]);
			}
		}
		if($is_temp != "Yes"){
			if($data[0]->formate == "" || $data[0]->formate == " "){
				$arr_key = array_search('PREFIX', $formate_arr);
				if($arr_key > -1){
					unset($formate_arr[$arr_key]);
				}
			}
		}
		
		$formate_arr = array_values($formate_arr);
		$prifix_num = 0;
		foreach ($formate_arr as $key => $value) {
			if($value == $prifix){
				$prifix_num = $key;
			}
		}

		$data_arr['prifix_num'] = $prifix_num;
		$data_arr['formate_arr'] = $formate_arr;

		return $data_arr;
		
	}
	public function getCustomerTempSerialNUmber($type = "",$count=0) {
		$structure_type = "";
		if($type == "CreditNote"){
			$structure_type = "credit_note";
		}else if($type == "DebitNote"){
			$structure_type = "debit_note";
		}else if($type == "ProformaInvoice"){
			$structure_type = "performa_invoice";
		}
		$data = $this->Crud->get_data_by_id("global_formate_configuration", $structure_type, "config_name");
		$cleanedString = str_replace(['{', '}'], '', $data[0]->formate_structure);
		$formate_arr = explode("/", $cleanedString); 
		$formate_data["FY"] = $this->getFinancialYear();
		$formate_data["PREFIX"] = $data[0]->formate;
		$formate_data["start_count"] = $data[0]->count_start_from;
		$formate_code = "";
		if(!in_array("PREFIX", $formate_arr)){
			$formate_code = "TEMP/";
		}
		
		
		foreach ($formate_arr as $key => $value) {
			if($value == "FY" && $data[0]->is_year_enable == "Yes"){
				$formate_code .= $formate_data["FY"];
			}else if($value == "PREFIX" ){
				$formate_code .= "TEMP";
			}else if($value == "NUM"){
				$formate_code .= $count;
			}
			if($key < count($formate_arr) -1 && $formate_code != ""){
				$formate_code .= "/";
			}
		}

		return $formate_code;
	}
	public function getCustomerReturnPartNUmber() {
		return "CR/".$this->getFinancialYear()."/";
	}

	public function getCreditNoteCode($type = "",$count = 0){
		$structure_type = "";
		if($type == "CreditNote"){
			$structure_type = "credit_note";
		}else if($type == "DebitNote"){
			$structure_type = "debit_note";
		}else if($type == "ProformaInvoice"){
			$structure_type = "performa_invoice";
		}
		$data = $this->Crud->get_data_by_id("global_formate_configuration", $structure_type, "config_name");
		$cleanedString = str_replace(['{', '}'], '', $data[0]->formate_structure);
		$formate_arr = explode("/", $cleanedString); 
		$formate_data["FY"] = $this->getFinancialYear();
		$formate_data["PREFIX"] = $data[0]->formate;
		$formate_data["start_count"] = $data[0]->count_start_from;
		$formate_code = "";
		foreach ($formate_arr as $key => $value) {
			if($value == "FY" && $data[0]->is_year_enable == "Yes"){
				$formate_code .= $formate_data["FY"];
			}else if($value == "PREFIX" && $data[0]->formate != "" && $data[0]->formate != ""){
				$formate_code .= $formate_data["PREFIX"];
			}else if($value == "NUM"){
				$formate_code .= $count+(int) $formate_data["start_count"];
			}

			if($key < count($formate_arr) -1 && $formate_code != ""){	
				$formate_code .= "/";
			}
		}
		
		return $formate_code;	
	}

	public function convertToFullYear($twoDigitYear) {
	    // Get the current year
	    $currentYear = date('Y');
	    
	    // Get the current century
	    $currentCentury = (int)($currentYear / 100);
	    
	    // Determine if the two-digit year is in the current century or the previous one
	    if ($twoDigitYear > (date('y') - 50)) {
	        $fullYear = $currentCentury * 100 + $twoDigitYear;
	    } else {
	        $fullYear = ($currentCentury - 1) * 100 + $twoDigitYear;
	    }
	    
	    return $fullYear;
	}
	public function createFinatialStartEndDate($type = "",$year = ''){
		$date = "";

		if($type == "start_date"){
			$start_year = $this->convertToFullYear($year);
			$date['start'] = $start_year."-"."04"."-01";
			$date['end'] = $start_year."-"."12"."-31";
		}else{
			$end_year = $this->convertToFullYear($year);
			$date['start'] = $end_year."-"."01"."-01";
			$date['end'] = $end_year."-"."03"."-31";
		}
		return $date;
	}
	public function getLockExportSalesNumber($saleNo) {
		if(self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()
			|| self::SIDHANT_PLASTIC == $this->getAROMCustomerName()
				|| self::BUDHALE_SMF == $this->getAROMCustomerName()) {
			return $this->getCustomizedLockSalesNumber($saleNo);
		}else { 
			return $this->getCustomerSerialNoExportSale().$saleNo;
		}
	}

	public function getCustomizedLockExportSalesNumber($saleNo) {
		if (self::TUSHAR_ENGG_SMF == $this->getAROMCustomerName()) {
    		return $saleNo;
		} else if(self::SIDHANT_PLASTIC == $this->getAROMCustomerName()) {
			return $this->getFinancialYear()."/".$saleNo;
		} else if(self::BUDHALE_SMF == $this->getAROMCustomerName()) {
			return $saleNo."/".$this->getFinancialYear();
		}

	}
	public function getCustomerSerialNoExportSale() {
		return "EX/".$this->getFinancialYear()."/";
	}
}