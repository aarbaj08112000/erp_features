<?php 

function pr($data,$exit = 0)
{
        echo("<pre>");

        print_r($data);
        echo("</pre>");

        if($exit == 1){
        	exit;
        }
}
function convertDateTime($value =''){
	return new DateTime($value);
}

function display_no_character($value = ''){
	if($value == "" ||  $value == null ){
		$value = "--";
	}
	return $value;
}


function is_valid_array($data = []){
	if( is_array($data) && count($data) > 0){
		return true;
	}
	return false;
}
function defaultDateFormat($date = "") {
    // Define an array of possible input date formats
    $formats = [
    	'd/m/Y',
    	'd/Y/m',  // Format like 12-2024-02
        'Y/m/d',
        'Y/d/m',
        'd-m-Y',  // Format like 12-02-2024
        'd-Y-m',  // Format like 12-2024-02
        'Y-m-d',
        'Y-d-m'  // Format like 2024-12-02
    ];
    
    foreach ($formats as $format) {
        $dateTime = DateTime::createFromFormat($format, $date);
        if ($dateTime) {
            // Return the date in the desired format
            return $dateTime->format('d/m/Y');
        }
    }

    $date = $date == "" || $date == null ? display_no_character() : display_no_character();
    
    // Return false if none of the formats match
    return $date;
}

function digitalSignature($file_path = '',$location = '',$signer = '',$certpwd ='',$certid='',$customerPrefix='',$digital_signature_url = ''){
	// checksum = sha256 (APIKEY + timestamp)
	// uuid = generate unique in your system
	// signloc = location for signature
	// signannotation = approved ny name  
	// uploadfile = upload pdf
	// certid = certificate id (Shared by Truecopy once it’s configured on your domain
	// certpwd = corresponding certificate password
	// timestamp = The time at the instant of signing expressed as: DDMMYYYYHH:mm:ss NOTE: The timestamp should be in sync with IST
	// signer = identifier of the signer account that is being used to sign. Shared by Truecopy

	// Endpoint URL
	$url = $digital_signature_url;
	// Parameters to be sent in the request

	// $file_path = "/var/www/html/extra_work/true_copy/salary_slip.pdf";
	$absolute_path = realpath($file_path);

	$file = new CURLFile($absolute_path, mime_content_type($absolute_path), basename($absolute_path));

	/*
	Production System details:
	$api_key = "NN3W33MCOH2YNAG3CC6J1RF5NZINU3G1";
	Domian = arominfotech.truecopy.in
	URL: https: //arominfotech.truecopy.in/api/tsm/v3/signpdfdoc
	certid:  sunita_kisan_gaikwad - AMEYA
	certpwd: Tc%9pxL7cXBiRLkWL38raYgKsUXTOA==
	Signer: helpdesk+arominfotechapiuser@truecopy.com
	*/

	$api_key = "NN3W33MCOH2YNAG3CC6J1RF5NZINU3G1";
	
	/*
	Test System details:
	$api_key = "72ACC113118AA458"; //Test System
	Domian = usgwstage.truecopy.in
	URL: https://usgwstage.truecopy.in/api/tsm/v3/signpdfdoc
	certid:  john_doe_test_2_gcp
	certpwd: Tc%9pxL7qYeGXW/KjN7GpkofKy22PQ==
	Signer: helpdesk+pocarominfotechapiuser@truecopy.com
	*/
	$time = (int) date("i");
	//$current_timestamp = date("dmYH").":".($time).date(":s"); -- this is for local
	$current_timestamp = date("dmYH") . ":" . ($time + 30) . date(":s"); //-- this is for production
	// pr($current_timestamp,1);
	$checksum = hash('sha256', $api_key.$current_timestamp);
	$uuid = "AROM".mt_rand(1000000000, 9999999999);
	$fields = array(
	    'certid' => $certid,
	    'certpwd' => $certpwd,
	    'uuid' => $uuid,
	    'timestamp' => $current_timestamp,
	    'checksum' => $checksum,
	    'signer' => $signer,
	    'uploadfile' => $file,
	    'signloc' => $location,
	    'signannotation' => 'Approved',
	    'hidetick' => 'true',
	    'signsize' => ''
	);
	// Initialize cURL session
	$ch = curl_init();

	// Set the cURL options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Execute the cURL session
	$response = curl_exec($ch);

	// Check for errors
	if(curl_errno($ch)) {
	    echo 'Error while doing digital signature : ' . curl_error($ch);
	    exit();
	}

	// Close cURL session
	curl_close($ch);
	// Print the response from the server
	//echo $response;	
	//exit();
	$myfile = fopen($file_path, "w") or die("Unable to open file!");
	fwrite($myfile, $response);
	fclose($myfile);
	// exit();
}
function formateFormDate($date =''){
	$date=date_create($date);
	$date = date_format($date,"Y-m-d");
	return $date;
}
function dbFormDate($date ='',$format = ""){
	$date=date_create($date);
	$date = date_format($date,$format);
	return $date;
}

 function getDefaultDateTime($str = ''){
	$formats = [
        'Y-m-d H:i:s',
        'd-m-Y H:i:s',
        'm/d/Y H:i:s', 
        'Y/m/d H:i:s', 
        'd/m/Y H:i:s',
        
    ];

    foreach ($formats as $format) {
        $dateTime = DateTime::createFromFormat($format, $str);
        if ($dateTime !== false) {
            return $dateTime->format('d/m/Y H:i:s');
        }
    }
}

function checkGroupAccess($page_url = "",$type = "",$redirect ="Yes"){
	$CI = &get_instance();
	$CI->load->model('GlobalConfigModel');
	$acces = $CI->GlobalConfigModel->check_group_access($page_url,$type);
	// return true;
	if(!$acces && $redirect == "Yes"){
		$previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No previous page';
		$forbidden_page = base_url('forbidden_page');
		$CI->session->set_userdata('previous_page', $previous_page);
		header("Location: $forbidden_page");
		die();
	}
	return $acces;
}
function numberToWords(float $number)
    {
        $ones = array(
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
            18 => 'Eighteen', 19 => 'Nineteen',
        );
        $tens = array(
            0 => 'Twenty', 1 => 'Thirty', 2 => 'Forty', 3 => 'Fifty', 4 => 'Sixty', 5 => 'Seventy', 6 => 'Eighty', 7 => 'Ninety',
        );

        $number = number_format($number, 2, '.', '');
        $parts = explode('.', $number);
        $wholeNumber = (int) $parts[0];
        $fraction = isset($parts[1]) ? (int) $parts[1] : 0;

        $wholeNumberInWords = '';
        if ($wholeNumber >= 10000000) {
            $wholeNumberInWords .= numberToWords(floor($wholeNumber / 10000000)) . ' Crore ';
            $wholeNumber %= 10000000;
        }
        if ($wholeNumber >= 100000) {
            $wholeNumberInWords .= numberToWords(floor($wholeNumber / 100000)) . ' Lakh ';
            $wholeNumber %= 100000;
        }
        if ($wholeNumber >= 1000) {
            $wholeNumberInWords .= numberToWords(floor($wholeNumber / 1000)) . ' Thousand ';
            $wholeNumber %= 1000;
        }
        if ($wholeNumber >= 100) {
            $wholeNumberInWords .= numberToWords(floor($wholeNumber / 100)) . ' Hundred ';
            $wholeNumber %= 100;
        }
        if ($wholeNumber >= 20) {
            $wholeNumberInWords .= $tens[floor($wholeNumber / 10) - 2] . ' ';
            $wholeNumber %= 10;
        }
        if ($wholeNumber > 0) {
            $wholeNumberInWords .= $ones[$wholeNumber];
        }

        $fractionInWords = '';
        if ($fraction > 0) {
            $fractionInWords = ' Rupees ';
            if ($fraction >= 20) {
                $fractionInWords .= $tens[floor($fraction / 10) - 2] . ' ';
                $fraction %= 10;
            }
            if ($fraction > 0) {
                $fractionInWords .= $ones[$fraction];
            }
            $fractionInWords .= ' Paise';
        }

        return $wholeNumberInWords . $fractionInWords;
    }
    function roundUpNumber($number = 0){
		$number = number_format($number,2,".","");
		return $number;
	}


?>