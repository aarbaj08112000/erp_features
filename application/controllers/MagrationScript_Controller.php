<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

#require_once('libraries/PHPExcel/IOFactory.php');
require_once('CommonController.php');
require_once(APPPATH.'libraries/PHPExcel/IOFactory.php');
//require 'PHPExcel/PHPExcel.php';
//require_once(APP. ‘Vendor’.DS.‘PHPExcel’.DS.‘IOFactory.php’);

class MagrationScript_Controller extends CommonController
{
   
	
	function __construct() {
		parent::__construct();
		$this->load->model('MagrationScript_Model');
	}

	public function yesterdays_sales_for_mail(){
		$yesterday = new DateTime('yesterday');
        $date = $yesterday->format('d/m/Y');
        $yesterday_sales_data = $this->MagrationScript_Model->get_sales($date);
        $customer_arr = array_column($yesterday_sales_data, "customer_name","customer_id");
        $yesterday_sales_arr = array_column($yesterday_sales_data,"basic_total","customer_id");

        $current_month = date("n");
        $current_monthsales_data = $this->MagrationScript_Model->get_current_month_sales_block($current_month);
        $current_monthsales_arr = array_column($current_monthsales_data,"basic_total","customer_id");
        $customer_array = array_column($current_monthsales_data, "customer_name","customer_id");
        // pr($current_monthsales_data,1);
        foreach ($customer_array as $key => $value) {
        	if(!array_key_exists($key,$customer_arr)){
        		$customer_arr[$key] = $value;
        	}
        }
        $total_yeaster_day_sales = 0;
        $total_current_month_sales = 0;
        $customer_report_data = [];
        foreach ($customer_arr as $key => $value) {
        	$yeaster_day_sales = isset($yesterday_sales_arr[$key]) ? $yesterday_sales_arr[$key] : 0.00;
        	$current_month_sales = isset($current_monthsales_arr[$key]) ? $current_monthsales_arr[$key] : 0.00;
        	$customer_report_data[] =[
        		"customer_name" => $value,
        		"yeaster_day_sales" => number_format($yeaster_day_sales,2),
        		"current_month_sales" => number_format($current_month_sales,2),
        	];
        	$total_yeaster_day_sales += $yeaster_day_sales;
        	$total_current_month_sales += $current_month_sales;
        }
        $data['total_current_month_sales'] = number_format($total_current_month_sales,2);
        $data['total_yeaster_day_sales'] = number_format($total_yeaster_day_sales,2);
        $data['customer_report_data'] = $customer_report_data;
       	// ini_set('display_errors', 1);
        // error_reporting(E_ALL );
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        $SalesReportSenderEmail = $configuration['SalesReportSenderEmail'];
        if($SalesReportSenderEmail != "" && $SalesReportSenderEmail != null && $configuration['SMTPUserPassword'] != "" && $configuration['SMTPUserName'] != "" && $configuration['EnableSalesReportEmail'] == "Yes"){
        	$SalesReportSenderEmail =  explode(",",$SalesReportSenderEmail);
        	foreach ($SalesReportSenderEmail as $key => $value) {
		        $email = $value;
		        $this->email_sender($data,$email,$configuration);
		    }
        	
        }else{
        	echo "Email Send Disable";
        }
        exit();
        // return $count_arr;
    }

    public function email_sender($data = array(),$email = "",$configuration = []){
    	// pr($configuration);
		$data['base_url']  = $this->config->item('base_url');
		$mail = $this->phpmailer_lib->load();
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; 					  // 'smtp.gmail.com'; //'smtpout.secureserver.net';          // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $configuration['SMTPUserName']; 	  // SMTP username
		$mail->Password = $configuration['SMTPUserPassword']; // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; //465; //587;                       // TCP port to connect to
		$mail->From = $configuration['SMTPUserName'];
		$mail->FromName = "Sales Report";
		$mail->addAddress($email);              			  // Name is optional
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = "Sales report details";
		$html = $this->smarty->fetch("reports/sales_report_email.tpl",$data);;
		$mail->Body    = $html;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		// if($this->config->item("email_notification") == "Yes" || $email_notification){
			if(!$mail->send()) {
				$message =  '\n Message could not be sent.';
				// echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$message =  '\n Message has been sent';
			}
		// }else{
		//    $message =  'notification turn off';
		// }
		echo $message;	

  }
  public function credit_note_migration_script(){
        $sql = "
            SELECT prsi.*,cpm.fg_rate as fg_rate,gs.cgst as cgst,gs.sgst as sgst,gs.igst as igst,gs.tcs as tcs
            FROM parts_rejection_sales_invoice as prsi
            LEFT JOIN customer_part as cp On cp.id = prsi.part_id
            LEFT JOIN customer_parts_master as cpm On cpm.id = cp.customer_parts_master_id
            LEFT JOIN gst_structure as gs On gs.id = cp.gst_id
            WHERE prsi.part_price = 0.00 || prsi.basic_total = 0.00 || prsi.cgst_amount = 0.00";
        $part_data = $this->Crud->customQuery($sql);    
        if(count($part_data) > 0){
            $update_arr = [];
            foreach ($part_data as $key => $value) {
                $basic_total = $value->qty * $value->fg_rate;
                if ($value->igst <= 0) {
                        $gst = $value->cgst + $value->sgst;
                        $cgst = $value->cgst;
                        $sgst = $value->sgst;
                        $tcs = $value->tcs;
                        $igst = 0;
                        $total_gst_percentage = $cgst + $sgst;
                } else {
                            $gst = $value->igst;
                            $tcs = $value->tcs;
                            $cgst = 0;
                            $sgst = 0;
                            $igst = $gst;
                            $total_gst_percentage = $igst;
                }
                $gst_amount = ($gst * $basic_total) / 100;
                $total_amount = $basic_total;
                $cgst_amount = ($total_amount * $cgst) / 100;
                $sgst_amount = ($total_amount * $sgst) / 100;
                $igst_amount = ($total_amount * $igst) / 100;
                if ($gst_structure2[0]->tcs_on_tax == "no") {
                    $tcs_amount =   (($total_amount * $tcs) / 100);
                } else {
                    $tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);   
                }
                $total_rate = $total_amount + $gst_amount;  
                $update_arr[] =[
                    "id" => $value->id,
                    "part_price" => $value->fg_rate,
                    "basic_total" => $basic_total,
                    "total_rate" => $total_rate,
                    "cgst_amount" => $gst_amount,
                    "sgst_amount" => $sgst_amount,
                    "igst_amount" => $igst_amount,
                    "tcs_amount" => $tcs_amount

                ];
            }
        }

        if(count($update_arr) > 0){
            $this->db->update_batch('parts_rejection_sales_invoice',$update_arr, 'id'); 
            $afftectedRows=$this->db->affected_rows();
            echo "<pre>";
            echo "Afftected Rows :".$afftectedRows;
        }
    }
    public function store_stock(){
        
        $entitlements = $this->session->userdata['entitlements'];
        $current_date = date("Y-m-d");
        $stock_entry = $this->MagrationScript_Model->checkStockEntry($current_date);
        if(count($stock_entry) == 0){
            $data = $this->MagrationScript_Model->getCurrentStockData();
            // pr($data,1);
            $isSheetMetal = $entitlements['isSheetMetal']!=null && $entitlements['isSheetMetal'] == 1 ? "Yes" : "No";
            $isPlastic = $entitlements['isPlastic']!=null && $entitlements['isPlastic'] == 1 ? "Yes" : "No";

            foreach ($data as $key => $value) {
                if($isSheetMetal == "Yes"){
                    $data[$key]['production_stock'] = $value['production_qty'];
                }else if($isPlastic == "Yes"){
                    $data[$key]['production_stock'] = $value['machine_mold_issue_stock'];
                }
                unset($data[$key]['production_qty'],$data[$key]['machine_mold_issue_stock']);
            }
            // pr($data,1);
            $stock_data = json_encode($data,TRUE);
            $daily_stock_arr = [
                "stock_date" => $current_date,
                "stock_json" => $stock_data
            ];
            // pr($daily_stock_arr,1);
            $data = $this->MagrationScript_Model->insertDailyStock($daily_stock_arr );
            echo "Daily stock added successfully.";
        }else{
            echo "Daily stock already exist for ".$current_date;
        }
        
    }
    public function payment_days_dump_script(){
         $supplier_data = $this->MagrationScript_Model->getSupplierPaymetTermsData();
         $magration_data = [];
         foreach ($supplier_data as $key => $value) {
            if($value['payment_days'] == '' || $value['payment_days'] == null){
                // $value['payment_terms'] = 

                $magration_data[] = [
                    "id" => $value['id'],
                    "payment_days" => (int) $value['payment_terms']
                ];
            }
         }

         if(count($magration_data) > 0){
            $supplier_data = $this->MagrationScript_Model->UpdateSupplierPaymetDaysData($magration_data);
            echo "payment days updated successfully.";
         }else{
            echo "No changes found to update.";
         }
         
  }
 
  

	
	
}
