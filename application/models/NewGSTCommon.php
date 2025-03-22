
<?php
class NewGSTCommon extends CI_Model
 {
	 
	public function isProduction() {
		return $this->config->item('gst_api_production');
	}

	// Get Registered client GST Number 
	public function getBaseClientGSTNo(){
		if($this->isProduction()==true){
			return $this->config->item('gst_BaseClientGSTNo');
			//return "27BIZPB5715M1ZM";		//JJ
			//return "27AAFFL7327N1ZT";   	//BSP
			//return "27AEDPJ2153G1ZT";		//Annu
			//return "27AHOPG6886B1Z1"; 	//Ameya
			//return "27AABCT7132N1Z0";		//Tushar
			//return "27AAYPL3889Q1Z8";		//AIMPLAST
			//return "27AARFA2059E1ZG";		//ARMS
			//return "27ABXFS5493D1ZG";		//SP
		}else{
			return "02AMBPG7773M002"; 
		}
	}

	
	
	//Client user name - authentication
	public function getEinvoiceUserName() {
		if($this->isProduction()==true){
			return $this->config->item('gst_ClientAPIUserName');
			//return "API_jjplast";        //JJ
			//return "API_bspmeta";        //BSP
			//return "API_Annu@ent";        //Annu
			//return "API_27AHOPG6886B1Z1";      //Ameya
			//return "API_tepl@123";        //Tushar
			//return "";        //AIMPLAST
			//return "API_AIMplast";        //ARMS
			//return "";        //SP
		} else {
			return "adqgsphpusr1";
		}
	}

	//Client user's paswd - authentication
	public function getEinvoicePaswd() {
		if($this->isProduction()==true){
			return $this->config->item('gst_ClientAPIUserPswd');
			//return "Arom@1234";         //All
		} else {
			return "Gsp@1234";
		}
	}

	//---------------------------- EWAY BILL SPECIFIC ---------------------

	// Get Registered client GST Number 
	public function getBaseEwayBillClientGSTNo(){
		if($this->isProduction()==true){
			return $this->config->item('gst_BaseClientGSTNo');
			//return "27BIZPB5715M1ZM";        //JJ
			//return "27AAFFL7327N1ZT";       //BSP
			//return "27AEDPJ2153G1ZT";        //Annu
			//return "27AHOPG6886B1Z1";     //Ameya
			//return "27AABCT7132N1Z0";        //Tushar
			//return "27AAYPL3889Q1Z8";        //AIMPLAST
			//return "27AARFA2059E1ZG";        //ARMS
			//return "27ABXFS5493D1ZG";        //SP
		}else{
			return "05AAACG2115R1ZN"; 		//OR 05AAACG5222D1ZA
		}
	}

	//Eway Bill 
	public function getEwayAuthUserName() {
		if($this->isProduction()==true){
			return $this->config->item('gst_ClientAPIUserName');
			//return "API_jjplast";        	//JJ
			//return "API_bspmeta";        	//BSP
			//return "API_Annu@ent";        //Annu
			//return "API_27AHOPG6886B1Z1";      //Ameya
			//return "API_tepl@123";        //Tushar
			//return "";        //AIMPLAST
			//return "API_AIMplast";        //ARMS
			//return "";        //SP
		} else {
			return "05AAACG2115R1ZN";
		}
	}

	//Eway Bill 
	public function getEwayAuthPaswd() {
		if($this->isProduction()==true){
			return $this->config->item('gst_ClientAPIUserPswd');
			//return "Arom@1234";         //Common
		} else {
			return "abc123@@";
		}
	}
	
	//Client user name - Token
	public function getAROMUserName() {
		if($this->isProduction()==true){
			return $this->config->item('gst_ClientId');
			//return "93BE926922E04F3F8EF00038FD5055C8";		//JJ
			//return "0542E448250640D0815DDE3893C44AC5";          //BSP
			//return "A2E4A6D9924240C1A20598D9750A8634";		//Annu
			//return "C5249569D9444E22B60B88A943C10C37";      //Ameya
			//return "2702CDBB858444FA8B965FCDD181FC88";        //Tushar
			//return "B2D53642C689432799305BDC3E6D24DD";        //AIMPLAST
			//return "D85472623AB5440C9423B6AFB7A980EA";        //ARMS
			//return "569FEAA0A86B43C48787D94D02D17BFC";        //SP
		} else {
			return "C3D0123D942A428E85D4FA2EE1926596";
		}
	}

	//Client user's paswd - Token
	public function getAROMPaswd() {
		if($this->isProduction()==true){
			return $this->config->item('gst_ClientSecret');
			//return "66C1713CG84E4G413CGAD89GF96F241E36C5";        //JJ
			//return "9F87CD03GEAD9G412BG99C0G1D001596EEA0";        //BSP
			//return "CDB0C220GCA42G4C6EG8BDBG723C8708F27D";        //Annu
			//return "3D562463G84F1G4A29G87DDG714A345F1DB0";        //Ameya
			//return "6855ECD7G8738G4C8BG892BG21F69AEA0EF3";        //Tushar
			//return "2C04EA61G6A80G4616GA01FG9D01225D26B8";        //AIMPLAST
			//return "E90B068AG1D22G4F73GAD04G84C9077609D2";        //ARMS
			//return "52BDE653G1CF5G47FDG8B32G6B4C6500BF4D";        //SP
		} else {
			return "7EBBBFFEG4E8EG4377G9E70G0F7C58996C25";
		}
	}

	#-------------------- CUSTOMER SPECIFIC THINGS ENDS HERE ----------------
	//this is not going to change
	public function getEwayBillURL() {
		if($this->isProduction()==true){
			return "https://gsp.adaequare.com/enriched/ewb/ewayapi";
		} else {
			return "https://gsp.adaequare.com/test/enriched/ewb/ewayapi";
		}
	}

	function echoToTriage($str) {
		$triageEnabled = true;
		if ($triageEnabled) {
			echo $str;
		}
	}


	//Generate authentication token - Second Call
 	public function authentication($new_sales_id) {
		//Start: This should be replaced with appropriate values for production
		// $this->echoToTriage("<br><u><b>Authentication</b></u>");
		$isProd = $this->isProduction();
		if($isProd==true){
			$tokenURL='https://gsp.adaequare.com/gsp/authenticate?grant_type=token';
		}else{
			$tokenURL='https://gsp.adaequare.com/gsp/authenticate?grant_type=token';
		}
  
		unset($_SESSION["sessionOauthToken"]); //uncomment for generating token all the time without using session.
		$sessionOAuth = $_SESSION["sessionOauthToken"] ;
		if(isset($sessionOAuth)){
		   if(time() > ($sessionOAuth['time'] + $sessionOAuth['expires_in'] + 50) ){ //Check expiry before 5 seconds
				unset($_SESSION["sessionOauthToken"]);
				echo "<script>
                        alert('\\n GST Oauth Token expired');
						</script>";
			}else {
				return $sessionOAuth['access_token'];
			}
		  }
		  
		  $ch = curl_init();
		 // $this->echoToTriage("<br>Result of curl- ch :" .  $ch);
          curl_setopt($ch, CURLOPT_URL,$tokenURL); 
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, true);
		  curl_setopt($ch, CURLOPT_TIMEOUT,20);
		  curl_setopt($ch, CURLOPT_TIMEOUT_MS,2000);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json',
		  'gspappid:' . $this->getAROMUserName().'',
		  'gspappsecret: '.$this->getAROMPaswd().''));
          $restoken = json_decode(curl_exec($ch),true);
		  if ($out === false) {
              $this->echoToTriage('<br><b>Curl error : ' . curl_error($ch).'</b>');
          }
         curl_close($ch);
      	 $oauthToken = $restoken['access_token'];
		
		 //Get the token and then set to session for further usage
		 if(isset($oauthToken)){
				$oauthTokenSessionData = array(
						"access_token" => $oauthToken,
						"time" => time(),
						"expires_in" => $restoken['expires_in']);
				$_SESSION["sessionOauthToken"] = $oauthTokenSessionData;
				// $this->echoToTriage("<br>Session OauthToken is set now: " .$oauthTokenSessionData['access_token']); 
				return $oauthToken;
         } else{
			  echo "<script>
                        alert('\\n GST Portal not rechable. Please try after sometime.');
						</script>";
			 $this->echoToTriage("Failed to generate token");
			 $this->redirect($new_sales_id);
         }
      }

	  /*
    Redirect for parent screen
     */
    public function redirect($new_sales_id)
    {
        $newurl = base_url('view_e_invoice_by_id/') . $new_sales_id;
        echo "<script>window.location.href='$newurl';</script>";
    }
}
?>