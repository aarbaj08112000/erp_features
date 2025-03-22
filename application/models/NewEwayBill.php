<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'NewGSTCommon.php';

class NewEwayBill extends NewGSTCommon
 {
	 
	/*
	 	Redirect for parent screen
	*/
	 function redirect($new_sales_id){
		 $newurl = base_url('view_e_invoice_by_id/').$new_sales_id;
		 echo "<script>window.location.href='$newurl';</script>";
	 }
	
	 /*
		Commom Code for API execution with appropriate data
	*/
    function execute($url,$data,$action,$Authorization,$XConnectorAuthToken=null) {
        // $this->echoToTriage('<br>----- Called execute Method -----');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$current_timestamp = time();
		$requestid = date("dmyHis", $current_timestamp);
		// echo "<br>requestid - " . $requestid;

	     curl_setopt($ch, CURLOPT_HTTPHEADER, 
			array( 'Content-Type:application/json',
					'username:' . $this->getEwayAuthUserName().'',
					'password:'.$this->getEwayAuthPaswd().'',
					'gstin:' . $this->getBaseEwayBillClientGSTNo().'',
					'Authorization:'.$Authorization.'',
					'requestid:'.$requestid));

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

	function getHSNTableData($unsortedHSNCodes){
		
			// Print the sorted array
			$previousHSN;
			$sameTotalAsst = 0;
			$totalTax = 0;
			$sameSgst = 0;
			$sameCgst = 0;
			$sameIgst = 0;
			
			foreach($unsortedHSNCodes as $item) {
				if(is_null($previousHSN)) {
						//echo "<br>previousHSN is null";
						$previousHSN = $item['hsn_code'];
						$sameTotalAsst = $item['assAmt'];
						$sameCgst = $item['cgstAmt'];
						$sameSgst = $item['sgstAmt'];
						$sameIgst = $item['igstAmt'];
						$totalTax = $sameCgst + $sameSgst + $sameIgst; //9
						//echo "<br>previousHSN is null: totalTax ".$totalTax.",for sameTotalAsst: ".$sameTotalAsst;
				} else {
					//echo "<br> previousHSN: ".$previousHSN;
					//echo "<br> item['hsn_code']: ".$item['hsn_code'];
					if(strcmp($previousHSN,$item['hsn_code'])==0){
						//echo "<br>previousHSN is SAME";
							$previousHSN = $item['hsn_code'];
							$sameTotalAsst = $sameTotalAsst + $item['assAmt'];
							$sameCgst = $sameCgst + $item['cgstAmt'];
							$sameSgst = $sameSgst + $item['sgstAmt'];
							$sameIgst = $sameIgst + $item['igstAmt'];
							$totalTax = $sameCgst + $sameSgst + $sameIgst;
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
								<td colspan="2">'.$totalTax.'</td>
							</tr>
							';
							$previousHSN = $item['hsn_code'];
							$sameTotalAsst = $item['assAmt'];;
							$sameSgst = $item['sgstAmt'];
							$sameCgst = $item['cgstAmt'];
							$sameIgst = $item['igstAmt'];
							$totalTax = $sameSgst + $sameCgst + $sameIgst;
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
							<td colspan="2">'.$totalTax.'</td>
						</tr>';
		
			return $hsn_code_table_html;
		}	
	}

?>