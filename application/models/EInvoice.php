<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('GSTCommon.php');

class EInvoice extends GSTCommon
 {
	 
	 /**
	  * Looks like open in new window so redirect to Parent and close the new window
	  */
	 function redirectToParent($new_sales_id){
		$newurl = base_url('view_e_invoice_by_id/').$new_sales_id;
		//echo "<script>window.location.href='$newurl';</script>";
		//echo "<script>window.close();</script>";
	}
	
	/**
	  * Close the current window
	  */
	 function closeWindow() {
			echo "<script>window.close();</script>";
	}

	/*
	 	Redirect for parent screen
	*/
	 function redirect($new_sales_id){
		 $newurl = base_url('view_e_invoice_by_id/').$new_sales_id;
		 echo "<script>window.location.href='$newurl';</script>";
	 }
	 
	/*
		Generate Token - First Call
	*/
	public function generateToken($new_sales_id) {
		//Start: This should be replaced with appropriate values for production
		//$this->echoToTriage("<br><u><b>Oauth Request</b></u>");
		$username = $this->getAROMUserName();
		$password = $this->getAROMPaswd();
		$client_id = $this->getClientId();

		$isProd = $this->isProduction();
		if($isProd==true){
			$tokenURL = 'https://gsthero.com/auth-server/oauth/token';
		}else{
			$tokenURL = 'https://qa.gsthero.com/auth-server/oauth/token';
		}
  
		unset($_SESSION["sessionOauthToken"]); //uncomment for generating token all the time without using session.
		
		$sessionOAuth = $_SESSION["sessionOauthToken"] ;
		if(isset($sessionOAuth)){
		    /* $this->echoToTriage("<br> Session token is present so get this token: ");
			$this->echoToTriage("<br> Oauth Token: " . $sessionOAuth['token']);
			$this->echoToTriage("<br> Time: " . $sessionOAuth['time']);
			$this->echoToTriage("<br> Current time: " .time());
			$this->echoToTriage("<br> expires_in: " .$sessionOAuth['expires_in']); */
			if(time() > ($sessionOAuth['time'] + $sessionOAuth['expires_in'] + 50) ){ //Check expiry before 5 seconds
				unset($_SESSION["sessionOauthToken"]);
				echo "<script>
                        alert('\\n GST Oauth Token expired');
						</script>";
			}else {
				return $sessionOAuth['token'];
			}
		  }
		  
		  $clientCredentials['grant_type']="password";
          $clientCredentials['username']=$username;
          $clientCredentials['password']=$password;
          $clientCredentials['client_id']=$client_id;
         // $clientCredentials['scope']="einvauth";
          $ch = curl_init();
		  $this->echoToTriage("<br>Result of curl- ch :" .  $ch);
          
		  curl_setopt($ch, CURLOPT_URL,$tokenURL); 
		  //curl_setopt($ch, CURLOPT_URL,'https://qa.gsthero.com/auth-server/oauth/token');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, true);
		  //curl_setopt($ch, CURLOPT_TIMEOUT,20);
		  //curl_setopt($ch, CURLOPT_TIMEOUT_MS,2000);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$clientCredentials);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json',
		  'gstin:' . $this->getBaseClientGSTNo().'',
		  'Authorization:Basic '.$this->getERPAuthCode().''));
          $restoken = json_decode(curl_exec($ch),true);
		  //$this->echoToTriage("<br> Result of curl :" .  $restoken);
          if ($out === false) {
              $this->echoToTriage('<br><b>Curl error : ' . curl_error($ch).'</b>');
          }
          curl_close($ch);

          //$var = json_decode($out, true); 
		 $oauthToken = $restoken['access_token'];
		 //$this->echoToTriage("<br>Response for generate Oauth token: " . $oauthToken);
		 
		 //Get the token and then set to session for further usage
		 if(isset($oauthToken)){
				$oauthTokenSessionData = array(
						"token" => $oauthToken,
						"time" => time(),
						"expires_in" => $restoken['expires_in']);
				$_SESSION["sessionOauthToken"] = $oauthTokenSessionData;
				//$this->echoToTriage("<br>Session OauthToken is set now: " .$oauthTokenSessionData['token']); 
				return $oauthToken;
         } else{
			  echo "<script>
                        alert('\\n GST Portal not rechable. Please try after sometime.');
						</script>";
			 $this->echoToTriage("Failed to generate token");
			 $this->redirectToParent($new_sales_id);
             //exit("Failed to generate token");
         }
      }  
	  
	  
	/*
		Generate authentication token - Second Call
	*/  
    public function authentication($new_sales_id) {
		//Start: This should be replaced with appropriate values for production
		$isProd = $this->isProduction();
		$username = $this->getCustomerUserName();
		$password = $this->getCustomerPaswd();
		$xConnector = $this->getXConnectorAuthToken();

		if($isProd==true){
			$authURL='https://gsthero.com/einvoice/v1.03/authentication';
		}else{
			$authURL='https://qa.gsthero.com/einvoice/v1.03/authentication';
		}

		//End
        //$validToken = false;
		unset($_SESSION["sessionAuthToken"]); //uncomment for generating token all the time without using session.
		
		$sessionAuth = $_SESSION["sessionAuthToken"] ;
		
		if(isset($sessionAuth)){
		    /* $this->echoToTriage("<br><b><u> Session Authentication token is present so get this token </b></u> <br>Details: ");
			$this->echoToTriage("<br> Auth Token: " . $sessionAuth['token']);
			$this->echoToTriage("<br> Time: " . $sessionAuth['time']);
			$this->echoToTriage("<br> Current time: " .time());
			$this->echoToTriage("<br> expires_in: " .$sessionAuth['expires_in'].'<br>'); */
			
			if(time()> ($sessionAuth['time'] + $sessionAuth['expires_in'] + 50)){ //Check expiry before 5 seconds
				unset($_SESSION["sessionAuthToken"]);
				echo "<script>
                        alert('\\n GST Auth Token expired');
						</script>";
				$this->echoToTriage("<br> Auth Token expired..");
			}else{
				return $sessionAuth['token'];
			}
			
		  }
		
		//as no valid information found so get the new auth token
		$token = $this-> generateToken($new_sales_id);
		//$this->echoToTriage("<br><br><b><u>Authentication Request</u></b><br> Oauth Token for authentication: ".$token);
        if(isset($token)){
		  $clientCredentials = array(
              "action"=> "ACCESSTOKEN",
              'username'=>$username, 
              'password'=>$password
          );   
          
          $body = json_encode($clientCredentials);
		  $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,$authURL); 
		  //curl_setopt($ch, CURLOPT_URL,'https://qa.gsthero.com/einvoice/v1.03/authentication');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, true);
		  //curl_setopt($ch, CURLOPT_TIMEOUT,30);
		  //curl_setopt($ch, CURLOPT_TIMEOUT_MS,3000);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
          curl_setopt($ch, CURLOPT_HTTPHEADER, 
		  array('Content-Type:application/json',
			  'Accept: application/json',
			  'action:ACCESSTOKEN',
			  'gstin:' . $this->getBaseClientGSTNo().'',
			  'Authorization:Bearer '.$token.'',
			  'X-Connector-Auth-Token:'.$xConnector)); //TO-DO : Need to check on this.
         
		 
          $res = json_decode(curl_exec($ch),true);
		  //echo "Response :" .var_dump($res);
          if ($out === false) {
              $this->echoToTriage('<br> Authentication : Curl error : ' . curl_error($ch));
           }
		  curl_close($ch); 
		  
		  $authToken = $res['access_token'];
		 //$this->echoToTriage("<br>Response for generate Authentication token: " . $authToken);
		 //Get the token and then set to session for further usage
		  if(isset($authToken)){
				$_SESSION["auth-Token1"] = $authToken;
				//$this->echoToTriage("<br>Session Authentication is set now: " . $authToken); 
				$authTokenSessionData = array(
						"token" => $authToken,
						"time" => time(),
						"expires_in" =>  $res['expires_in']);
				$_SESSION["sessionAuthToken"] = $authTokenSessionData;
				//$this->echoToTriage("<br> Auth Token : ".$authToken);
				return $authToken;
		   }else{
			   echo "<script>
                        alert('\\n GST Portal not rechable. Please try after sometime.');
						</script>";
				$this->echoToTriage("Failed to genrate authetication token");
				$this->redirectToParent($new_sales_id);
				//exit("Failed to genrate authetication token");
		   }
         }
      }
	
	
	/**
		Commom Code for API execution with appropriate data
	*/
    function execute($url,$data,$action,$Authorization,$XConnectorAuthToken) {
        $this->echoToTriage('<br>----- Called execute Method -----');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type:application/json',
        'Accept:application/json',
        'gstin:' . $this->getBaseClientGSTNo().'',
	    'action:'.$action.'',
        'Authorization:'.$Authorization.'',
        'X-Connector-Auth-Token:'.$XConnectorAuthToken.''));
        $array = json_decode(curl_exec($ch),true);
      
       
            if ($out === false) {              
            $this->echoToTriage('<br> Execute Curl error : ' . curl_error($ch));
            return 1;
            }
        
        curl_close($ch);
        if(isset($array['error']) && $array['error']=="invalid_token"){
			$this->echoToTriage('<br>----- error -----');
            return 1;
        }else if($array['errorMsg']=="Invalid auth token."){
			$this->echoToTriage('<br>----- Invalid auth token-----');
            return 2;
        }else{
            return $array;
        } 
       //return $var
    }
	
	/**
		Get - common code for API execution - so far mainly developed for GetInvoice
	*/
    function executeGetMethod($url,$action,$Authorization,$XConnectorAuthToken) {
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $Authorization);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, 
		array('Content-Type:application/json',
        'Accept:application/json',
        'gstin:' . $this->getBaseClientGSTNo().'',
	    'action:'.$action.'',
        'Authorization:'.$Authorization.'',
        'X-Connector-Auth-Token:'.$XConnectorAuthToken.''));
        $array = json_decode(curl_exec($ch),true);
       
            if ($out === false) {              
				$this->echoToTriage('<br> executeGetMethod Curl error : ' . curl_error($ch));
            }
        curl_close($ch);
        if(isset($array['error']) && $array['error']=="invalid_token"){
            return 1;
        }else if($array['errorMsg']=="Invalid auth token."){
            return 2;
        }else{
            return $array;
        } 
    }
	
	
	public function getModeOfTransport($mode){
		if($mode == '1') { 
			return 'Road'; 
		} elseif($mode == '2') { 
			return 'Rail'; 
		} elseif($mode == '3') { 
			return 'Air'; 
		} elseif($mode == '4') { 
			return 'Ship'; 
		}
		return $mode;
	}


	function getHSNTableData($unsortedHSNCodes) {
	
		// Print the sorted array
		$previousHSN;
		$sameTotalAsst = 0;
		$totalTax = 0;
		$sameSgst = 0;
		$sameCgst = 0;
		$sameIgst = 0;
		$sameTcs = 0;
		
		foreach($unsortedHSNCodes as $item) {
			if(is_null($previousHSN)){
					//echo "<br>previousHSN is null";
					$previousHSN = $item['hsn_code'];
					$sameTotalAsst = $item['assAmt'];
					$sameCgst = $item['cgstAmt'];
					$sameSgst = $item['sgstAmt'];
					$sameIgst = $item['igstAmt'];
					$sameTcs = $item['tcsAmt'];
					$totalTax = $sameCgst + $sameSgst + $sameIgst; //9
					//echo "<br>previousHSN is null: totalTax ".$totalTax.",for sameTotalAsst: ".$sameTotalAsst;
			 }else{
				//echo "<br> previousHSN: ".$previousHSN;
				//echo "<br> item['hsn_code']: ".$item['hsn_code'];
				  if(strcmp($previousHSN,$item['hsn_code'])==0){
					//echo "<br>previousHSN is SAME";
						$previousHSN = $item['hsn_code'];
						$sameTotalAsst = $sameTotalAsst + $item['assAmt'];
						$sameCgst = $sameCgst + $item['cgstAmt'];
						$sameSgst = $sameSgst + $item['sgstAmt'];
						$sameIgst = $sameIgst + $item['igstAmt'];
						$sameTcs =  $sameTcs + $item['tcsAmt'];
						$totalTax = $sameCgst + $sameSgst + $sameIgst + $sameTcs;
						//echo "<br>previousHSN is SAME: totalTax ".$totalTax.",for sameTotalAsst: ".$sameTotalAsst;
						//echo "<br>Values for previousHSN : ". $previousHSN." ,sameTotalAsst : ".$sameTotalAsst.", sameCgst :".$sameCgst.", sameSgst: ".$sameSgst.", sameTotal: ".$sameTotal;
				  }else{
					//echo "<br>previous and current one are not equal";
					  //previous and current one are not equal
						$hsn_code_table_html .= '
						<tr style="text-align:right">
							<td colspan="2" style="text-align:center">'.$previousHSN.'</td>
							<td colspan="2">'.$sameTotalAsst.'</td>
							<td>'.$item['cgstRate'].'%</td>
							<td>'.$sameCgst.'</td>
							<td>'.$item['sgstRate'].'%</td>
							<td>'.$sameSgst.'</td>
							<td>'.$item['igstRate'].'%</td>
							<td>'.$sameIgst.'</td>
							<td>'.$sameTcs.'</td>
							<td colspan="2">'.$totalTax.'</td>
						</tr>
						';
						$previousHSN = $item['hsn_code'];
						$sameTotalAsst = $item['assAmt'];;
						$sameSgst = $item['sgstAmt'];
						$sameCgst = $item['cgstAmt'];
						$sameIgst = $item['igstAmt'];
						$sameTcs = $item['tcsAmt'];
						$totalTax = $sameSgst + $sameCgst + $sameIgst + $sameTcs;
					}
				}
		 
			}
				//echo "Last time print";
					$hsn_code_table_html .= '
					<tr style="text-align:right">
						<td colspan="2" style="text-align:center">'.$previousHSN.'</td>
						<td colspan="2">'.$sameTotalAsst.'</td>
						<td>'.$item['cgstRate'].'%</td>
						<td>'.$sameCgst.'</td>
						<td>'.$item['sgstRate'].'%</td>
						<td>'.$sameSgst.'</td>
						<td>'.$item['igstRate'].'%</td>
						<td>'.$sameIgst.'</td>
						<td>'.$sameTcs.'</td>
						<td colspan="2">'.$totalTax.'</td>
					</tr>';
	
		return $hsn_code_table_html;
	}
	
}
?>