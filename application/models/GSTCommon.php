
<?php
class GSTCommon extends CI_Model
 {
	 
	public function isProduction() {
		return false;
	}

	// Get Registered client GST Number 
	public function getBaseClientGSTNo(){
		if($this->isProduction()==true){
			//return "27ABXFS5493D1ZG";		//SPERP
			//return "27AAYPL3889Q1Z8";		//AIMPLAST
			//return "27AARFA2059E1ZG"; 	//ARMS
			//return "27AAFFL7327N1ZT";		//BSP
			//return "05AALFP1139Q003";		//Default
		}else{
			return "05AALFP1139Q003"; 		//OR 05AAACG5222D1ZA
		}
	}
	
	//Client user name - authentication
	public function getCustomerUserName() {
		if($this->isProduction()==true){
			//return "API_super_polymer@";	//SPERP
			//return "API_aimplast@";		//AIMPLAST
			//return "API_arms@";			//ARMS
			//return "bspmetatec_API_123";	//BSP
			//return "perennialsys_UK";		//Default
		} else {
			return "perennialsys_UK";
		}
	}

	//Client user's paswd - authentication
	public function getCustomerPaswd() {
		if($this->isProduction()==true){
			//return "Arom@123"; 			//AIMPLAST + ARMS + SPERP
			//return "Gsthero@12345";		//BSP
			//return "Pere@123";			//Default
		} else {
			return "Pere@123";
		}
	}

// ------------------------------ CUSTOMER SPECIFIC CHANGES ENDS HERE -----------------------

	public function getXConnectorAuthToken() {
		if($this->isProduction()==true){
			return "ff7e61ccc48667d70b2c61536faf88fc:20240101104244:" . $this->getBaseClientGSTNo(); //common
			//return "testerpclient:20230123104244:20240101104244:" . $this->getBaseClientGSTNo();	 //Default
		} else {		
			return "testerpclient:20230123104244:20240101104244:" . $this->getBaseClientGSTNo();
		}
	}

	// Get ERP registered basic authorization code
	public function getERPAuthCode() {
		if($this->isProduction()==true){
			return "ZmY3ZTYxY2NjNDg2NjdkNzBiMmM2MTUzNmZhZjg4ZmM6ZWtKVU5USHpZSw=="; //common
			//return "dGVzdGVycGNsaWVudDpBZG1pbkAxMjM=";
		}else{
			return "dGVzdGVycGNsaWVudDpBZG1pbkAxMjM=";
		}
	}

	//Client user name - Token
	public function getAROMUserName() {
		if($this->isProduction()==true){
			return "arominfotech@gmail.com";
			//return "erp1@perennialsys.com";			//Default
		} else {
			return "erp1@perennialsys.com";
		}
	}

	//Client user's paswd - Token
	public function getAROMPaswd() {
		if($this->isProduction()==true){
			return "rrd12345";
			//return "einv12345";		//Default
		} else {
			return "einv12345";
		}
	}

	//Client ID - Token
	public function getClientId() {
		if($this->isProduction()==true){
			return "ff7e61ccc48667d70b2c61536faf88fc";
			//return "testerpclient";	//Default
		} else {
			return "testerpclient";
		}
	}

	//this is not going to change
	public function getEwayBillURL() {
		if($this->isProduction()==true){
			return "https://gsthero.com/ewb/enc/v1.03/ewayapi";
		} else {
			return "http://35.154.208.8:8080/ewb/enc/v1.03/ewayapi";
		}
	}

	function echoToTriage($str) {
		$triageEnabled = true;
		if ($triageEnabled) {
			echo $str;
		}
	}

}
?>