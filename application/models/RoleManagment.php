
<?php
class RoleManagment extends CI_Model {
	 
	const SHEET_METAL_COMMODITY = 1;
	const PLASTIC_COMMODITY = 2;
	const JOB_ROOT_COMMODITY = 3;

	/* define customer */
	const CURRENT_CUSTOMER = "TEST";
	const CURRENT_CUSTOMER_COMMODITY = sel::SHEET_METAL_COMMODITY;
	
	
	public function isEnabled($function){
		return true;
	}

	
	public function getAllCustomerCommodity(){
		$age = array(
			"TEST" => self:: SHEET_METAL_COMMODITY ,
			"TUSHAR" => self:: SHEET_METAL_COMMODITY,
			"MAYURESH" => self:: PLASTIC_COMMODITY,
			"PADMAVATI" => self:: JOB_ROOT_COMMODITY
			);
	}
	
	
	public function getCustomer() {
		return self::AROM_CUSTOMER ;
	}

	public function getCustomerCom() {
		return self::AROM_CUSTOMER_COMMODITY ;
	}
	
}
?>