<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class POTrackingController extends CommonController {
	
	const PO_TRACKING_PATH = "poTracking/";
	
	function _construct()
    {
        parent::_construct();
    }
	
	private function getPath(){
		return self::PO_TRACKING_PATH;
	}

	public function customer_po_tracking() {
		$data['customer_data'] = $this->Crud->read_data("customer");
		// $this->getPage('customer_po_tracking', $data);
		$this->loadView('customer/customer_po_tracking',$data);

	}
	
	
	public function generate_customer_po_tracking()
	{
		$po_start_date = $this->input->post('po_start_date');
		$po_end_date = $this->input->post('po_end_date');
		$po_number = $this->input->post('po_number');
		$po_amedment_number = $this->input->post('po_amedment_number');
		$customer_id = $this->input->post('customer_id');
		$po_amendment_date = $this->input->post('po_amendment_date');
		//$uploadedDoc = $this->input->post('uploadedDoc');
		
		$data = array(
			"po_number" => $po_number,
			"customer_id" => $customer_id
		);
		$ret_arr =[];
		$msg = '';
		$sucess = 1;
		
		$check = $this->Crud->read_data_where("customer_po_tracking", $data);

       	if(date("m") < 4){
       		$start_year = substr(date("Y", strtotime("-1 year")), -2);
       		$start_year_val = date("Y", strtotime("-1 year"));
        	$end_year = substr(date("Y"), -2);
        	$end_year_val = date("Y");
       	}else{
       		$start_year = substr(date("Y"), -2);
       		$start_year_val = date("Y");
        	$end_year = substr(date("Y", strtotime("+1 year")), -2);
        	$end_year_val = date("Y", strtotime("+1 year"));
       	}
		$role_management_data = $this->db->query('
			SELECT COUNT(cpt.id) as total_record
			FROM `customer_po_tracking` as cpt
			WHERE ((cpt.created_year = '.$start_year_val.' AND cpt.created_month >= 5) OR (cpt.created_year = '.$end_year_val.' AND cpt.created_month <= 4)) AND cpt.acceptance_number != ""
			ORDER BY `id` DESC
		');
		$parts_customer_trackings = $role_management_data->result();
		$total_records = $parts_customer_trackings[0]->total_record+1;
		$acceptance_number = "OA/".$start_year."-".$end_year."/".$total_records;
		

		if ($check != 0) {
			$msg = 'Record already exists for this customer. Enter different PO Number';
			$sucess = 0;
			// $this->addErrorMessage('Record already exists for this customer. Enter different PO Number');
			// $this->redirectMessage();
			//echo "<script>alert('Error 403 : PO Number  Already Exists , Enter Different PO Number ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
		} else {
			if (!empty($_FILES['uploadedDoc']['name'])) {
				$image_path = "./documents/";
				$config['allowed_types'] = '*';
				$config['upload_path'] = $image_path;
				$config['file_name'] = $_FILES['uploadedDoc']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('uploadedDoc')) {
					$uploadData = $this->upload->data();
					$uploadedDocument = $uploadData['file_name'];
					// echo "uploadedDocument: ".$uploadedDocument;
				} else {
					$uploadedDocument = '';
				}
			} else {
				$uploadedDocument = '';
			}
			
			$data = array(
				"po_start_date" => $po_start_date,
				"po_end_date" => $po_end_date,
				"po_number" => $po_number,
				"po_amedment_number" => $po_amedment_number,
				"po_amendment_date" => $po_amendment_date,
				"customer_id" => $customer_id,
				"created_by" => $this->user_id,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"created_by" => $this->current_date,
				"created_day" => $this->date,
				"created_month" => $this->month,
				"created_year" => $this->year,
				"uploadedDoc" => $uploadedDocument,
				"acceptance_number" => $acceptance_number
			);

			$result = $this->Crud->insert_data("customer_po_tracking", $data);
			if ($result) {
				// $this->addSuccessMessage('PO Successfully Added');
				// $this->redirectMessage('view_customer_tracking_id/'.$result);
				$msg = 'PO Successfully Added';
				$sucess = 1;
				$ret_arr['url'] = 'view_customer_tracking_id/'.$result;
				//echo "<script>alert('Successfully Added');document.location='" . base_url('view_customer_tracking_id/') . $result . "'</script>";
			} else {
				// $this->addErrorMessage('Failed to add PO');
				// $this->redirectMessage();
				$msg = 'Failed to add PO';
				$sucess = 0;
			}
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['sucess'] = $sucess;
		echo json_encode($ret_arr);
	}
	
	public function customer_po_tracking_all() {

		checkGroupAccess("customer_po_tracking_all","list","Yes");
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
		$column[] = [
            "data" => "customer_name",
            "title" => "Customer",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $order_acceptance_enable = "No";
        if(isset($configuration['order_acceptance_enable']) && $configuration['order_acceptance_enable'] == "Yes"){
        	$column[] = [
	            "data" => "acceptance_number",
	            "title" => "OA Number",
	            "width" => "10%",
	            "className" => "dt-left",
	        ];
	        $column[] = [
	            "data" => "acceptance_date",
	            "title" => "OA Date",
	            "width" => "10%",
	            "className" => "dt-left",
	        ];
	        $order_acceptance_enable = "Yes";
        }
        $column[] = [
            "data" => "po_number",
            "title" => "PO Number",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "po_start_date",
            "title" => "Start Date",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "po_end_date",
            "title" => "End Date",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "po_amedment_number",
            "title" => "Amendment No",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "view_details",
            "title" => "View Details",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "po_doc",
            "title" => "PO Document",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Actions",
            "width" => "20%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "id",
            "title" => "id",
            "width" => "0%",
            "className" => "dt-center",
            "visible" => false
        ];
       		
		// $data['customer_po_tracking'] = $this->Crud->read_data("customer_po_tracking");
		// if ($data['customer_po_tracking']) {
		// 	foreach ($data['customer_po_tracking'] as $s) {
		// 		$data['customer_data'][$s->customer_id] = $this->Crud->get_data_by_id("customer", $s->customer_id, "id");
		// 	}
		// }

		$data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = $order_acceptance_enable == "Yes" ? json_encode([[11, 'desc']]) : json_encode([[9, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
		$customer_data_raw = $this->CustomerPart->getPoTrakingView();
		$data['customer_data'] = array_column($customer_data_raw,'customer_name','customer_id');
		$data['order_acceptance_enable'] = $order_acceptance_enable;
		$data["left_fix_column"] = $order_acceptance_enable == "Yes" ? 3 : 2;
		// pr($data,1);
		$this->loadView('customer/customer_po_tracking_all', $data);
	}

	public function customerPoTrackingAjax(){

		$post_data = $this->input->post();
		
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
            if ($key == 0) {
                $order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
                $order_by .=
                    "," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
		$data = $this->CustomerPart->getPoTrakingView($condition_arr,$post_data["search"]);
		// pr($this->db->last_query(),1);
		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
		foreach ($data as $key => $val) {
			// pr($val,1);
			$dateToCheck = $val['po_end_date'];
			$currentDate = date('Y-m-d'); // Gets the current date in Y-m-d format

			// Convert both dates to timestamps
			$dateToCheckTimestamp = strtotime($dateToCheck);
			$currentDateTimestamp = strtotime($currentDate);

			if($val['status'] == "pending"){
				$data[$key]['status'] = "Open";
			}
			// Compare the timestamps
			if ($dateToCheckTimestamp < $currentDateTimestamp && $val['status'] != "closed") {
			    $data[$key]['status'] = "Expired";
			}
			$view_details = $po_doc = $action = '';
			$encode_data = base64_encode(json_encode($val));
			$view_details = '<a href="' . base_url('view_customer_tracking_id/' . $val['id']) . '" class="" title="PO Details"><i class="ti ti-eye"></i></a>';
			if ($val['uploadedDoc'] != '') {
				$po_doc = '<a download href="' . base_url('documents/' . $val['uploadedDoc']) . '" id="" class=" remove_hoverr"><i class="ti ti-download"></i></a>';
			}
		
			$po_doc .= '<a type="button" data-value = '.$encode_data.' class=" upload_doc" data-bs-toggle="modal"  data-bs-target="#upload_modal"><i class="ti ti-upload"></i></a>';
			$action = display_no_character("");
			if(checkGroupAccess("customer_po_tracking_all","update","No")){
				$action = '<a type="button" data-value = '.$encode_data.' class=" edit-part" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit"></i> </a>
					   <a type="button" data-value = '.$encode_data.' class="close-po" data-bs-toggle="modal" data-bs-target="#close_modal" title="Close PO"><i class="ti ti-circle-x"></i></a>';
				$parts_customer_trackings = $this->Crud->get_data_by_id("parts_customer_trackings", $val['id'], "customer_po_tracking_id");
				if($val['acceptance_number'] != "" && $val['acceptance_number'] != null && !empty($parts_customer_trackings) && isset($configuration['order_acceptance_enable']) && $configuration['order_acceptance_enable'] == "Yes"){
					$action .= '<a target="blanck" href="'.base_url("").'generateAOPdf/'.$val['id'].'" class="" title="Download AO Pdf"><i class="ti ti-file-download"></i> </a>
							<a type="button" class="send-sales-order-email"  title="Send Email" data-href="'.base_url("").'sendAOEmail/'.$val['id'].'"><i class="ti ti-mail-forward"></i> </a>';
				}
			}
			$data[$key]['acceptance_number'] = display_no_character($val['acceptance_number']);
			$data[$key]['view_details'] = $view_details;
			$data[$key]['po_doc'] = $po_doc;
			$data[$key]['action'] = $action;
			$data[$key]['po_start_date'] = defaultDateFormat($val['po_start_date']);
			$data[$key]['po_end_date'] = defaultDateFormat($val['po_end_date']);
			$data[$key]['acceptance_date'] = defaultDateFormat($val['created_date']);
		}
		
		$data["data"] = $data;
		
        $total_record = $this->CustomerPart->getPoTrakingViewCount([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();

	}
	public function sendAOEmail(){
		$customer_tracking_po_id = $this->uri->segment('2');
		$data = $this->generateAOPdf($customer_tracking_po_id);
		$customer_data = $data['customer_data'][0];
		$customer_po_tracking = $data['customer_po_tracking'][0];
		$pdf_file = $data['file_name'];
		$message = "Something went wrong";
		$sucess = 0;
		if(!empty($customer_data->emailId)){
			$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        	$configuration = array_column($configuration, "config_value","config_name");
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
			$mail->FromName = "Order Acceptance Note ";
			$mail->addAddress($customer_data->emailId);              			  // Name is optional
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = "Order Acceptance Note ".$customer_po_tracking->po_number;
			$mail->addAttachment($pdf_file, "accept_order.pdf"); // Attach the PDF
			$mail->Body = "Dear Sir/Madam,
		          <p> Please find attached Order acceptance note against your purchase order ".$customer_po_tracking->po_number;
			// if($this->config->item("email_notification") == "Yes" || $email_notification){
				if(!$mail->send()) {
					$message =  'Email could not be sent.';
					// echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$message =  'Email sent successfully.';
					$sucess = 1;
				}
			// }else{
			//    $message =  'notification turn off';
			// }
		}else{
			$message =  'Customer email not found!';
		}
		
		$ret_arr = [
			"messages" => $message,
			"success" => $sucess
		];
		echo json_encode($ret_arr);
		exit();
		
	}

	public function generateAOPdf($customer_tracking_po_id = 0){
		if($customer_tracking_po_id > 0){
			$type_pdf = "F";
		}else{
			$customer_tracking_po_id = $this->uri->segment('2');
			$type_pdf = "I";
		}
		$customer_po_tracking = $this->Crud->get_data_by_id("customer_po_tracking", $customer_tracking_po_id, "id");
		$customer_data = $customer = $this->Crud->get_data_by_id("customer", $customer_po_tracking[0]->customer_id , "id");
		$shipping_data = array(
					"shipping_name" => $customer[0]->customer_name,
					"ship_address" => $customer[0]->shifting_address,
					"location" => $customer[0]->location,
					"state" => $customer[0]->state,
					"state_no" => $customer[0]->state_no,
					"pin_code" => $customer[0]->pin,
					"gst_number" => $customer[0]->gst_number,
					"pan_no" => $customer[0]->pan_no,
					"phone_no" => ""
				);
		// pr($shipping_data,1);

		$parts_customer_trackings = $this->Crud->get_data_by_id("parts_customer_trackings", $customer_tracking_po_id, "customer_po_tracking_id");
		$role_management_data = $this->db->query('
			SELECT pct.*,cp.hsn_code,cp.part_number,cp.part_description,cp.uom,cp.id as customer_part_id
			FROM `parts_customer_trackings` as pct
			LEFT JOIN customer_part as cp ON cp.id = pct.part_id
			WHERE `customer_po_tracking_id` = '.$customer_tracking_po_id.'
			ORDER BY `id` DESC
		');
		$parts_customer_trackings = $role_management_data->result();

		$clientUnit = $this->session->userdata['clientUnit'];
		$client_data = $this->Crud->get_data_by_id("client", $clientUnit, "id");

		$configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
		$company_logo = "";
        $company_logo_enable = "No";
        $row_col_span = '100';
        if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                 $company_logo = $configuration['companyLogo'];
                $company_logo_enable = "Yes";

                $company_logo = '<th  rowspan="3" style="width:20%;text-align:right;font-size:9px;padding:0px;text-align: center;">
                <br><br>
              <img src="'.base_url('').'/dist/img/company_logo/'.$company_logo.'"  style="width: 80px;padding: 0px;height:55px;">
           </th>';
                $row_col_span = '80';
            }
        }
        // pr($customer_po_tracking,1);
		$header = '
				<style>
					   th, td ,b{ 
					   font-family: "Poppins", sans-serif;
					   line-height: 1.8;
					   padding: 10px;
					   margin: 10px;
					   }
					   table {
					   padding: 0px;
					   }
					</style>
					<table cellspacing="0" cellpadding="1" border="1">
					   <tbody>
					      <tr>
					         '.$company_logo.'
					         <th style="width:'.$row_col_span.'%;text-align:right;font-size:9px;padding:0px;border-bottom: 1px solid black;">
					            <b> ORIGINAL_FOR_RECIPIENT</b>
					         </th>
					      </tr>
					      <tr>
					         <th style="text-align:center; font-size:13px;padding:6px;border-bottom: 0px solid black;">
					            <b>ORDER ACCEPTANCE</b>
					         </th>
					      </tr>
					      <tr>
					         <!-- Company Details -->
					         <th style="font-size:9.4px;text-align:center;padding:5pxwidth:20%;border-top: 0px solid white;border-bottom: 1px solid black;">
					            <b style="font-size:20px;margin-top:-100px;">'.$client_data[0]->client_name.'</b><br>
					            <b><span>'.$client_data[0]->address1.'</span></b>
					         </th>
					      </tr>
					      <tr style="font-size:11.59px; ">
					         <td width="50%" style="height:90px;">
					            <b>PAN NO : </b> '.$customer[0]->pan_no.'<br>
					            <b>GST NO : </b>'.$customer[0]->gst_number.'<br>
					            <b>STATE : </b> '.$customer[0]->state.'<br>
					            <b>STATE CODE : </b> '.$customer[0]->state_no.'<br>
					            <b>VENDOR CODE : </b>'.$customer[0]->vendor_code.'
					         </td>
					         <td width="50%" style="height:90px;line-height:1.4;">
					            <b style="font-size:13px;">ORDER NO :&nbsp;&nbsp;'.$customer_po_tracking[0]->acceptance_number.'</b><br>
					            <b>ORDER DATE :</b> 16/02/2025<br>
					            <b>PO NUMBER : </b>'.$customer_po_tracking[0]->po_number.'<br>
					            <b>PO DATE : </b>'.defaultDateFormat($customer_po_tracking[0]->created_date).'
					         </td>
					      </tr>
					      <tr style="font-size:11.59px; " >
				            <td width="50%" style="padding-top: 4px;height:138px;">
				            <table cellspacing="0" cellpadding="0"   border="0" >
				                <tr>
				                <td style="padding-top: 4px;line-height:1.5;"><b>Details of Receiver (Billed To)</b><br><b>'. $customer_data[0]->customer_name .'</b><br>' . $customer_data[0]->billing_address . '<br><b>STATE :</b> ' . $customer_data[0]->state . '&nbsp;&nbsp;<b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STATE CODE :</b> ' . $customer_data[0]->state_no . '<br><b>PAN NO : </b>' . $customer_data[0]->pan_no . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>GST NO :</b> ' . $customer_data[0]->gst_number . '
				                </td>
				                </tr>
				            </table>
				            </td>
				            <td width="50%" style="padding-top: 4px;height:138px;">
				            <table cellspacing="0" cellpadding="0"   border="0" >
				                <tr>
				                <td style="padding-top: 4px;line-height:1.5;"><b>Details of Consignee (Shipped to)</b><br><b>' . $shipping_data['shipping_name'] . '</b><br>' . $shipping_data['ship_address'] . '<br><b>STATE : </b>' . $shipping_data['state'] . '&nbsp;&nbsp;<b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STATE CODE :</b> ' . $shipping_data['state_no'] . '<br><b>PAN NO : </b>' . $shipping_data['pan_no'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>GST NO : </b>' . $shipping_data['gst_number'] . '
				                </td>
				                </tr>
				            </table>
				            </td>
				         </tr>
					      <tr style="font-size:11.59px;text-align:center;" width="100%">
					         <td width="4%"><b>Sr No</b></td>
					         <td width="45.99%" style="text-align:left;"><b>&nbsp;Part Description</b></td>
					         <td width="9.6%"><b>HSN / SAC</b> </td>
					         <td width="7%"><b>UOM</b></td>
					         <td width="8.33%"><b>QTY</b></td>
					         <td width="12.5%"><b>Rate</b></td>
					         <td width="12.6%"><b>Amount (Rs)</b></td>
					      </tr>
					   </tbody>
					</table>
		';

		
		$height_of_each_row = 53.6;
		$page_row_count = 1;
        $page_count = 6;
        $parts_html = '<style>
			   .page-break { page-break-before: always; }
			   body {
			   line-height: 70px; /* Adjust this value for desired line spacing */
			   }
			</style><table cellspacing="0" cellpadding="1"   border="1">
			        <tbody>
		';
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		// $parts_customer_trackings[] = $parts_customer_trackings[0];
		$total_price = 0;
		// pr($parts_customer_trackings,1);
		$i = 1;
        foreach ($parts_customer_trackings as $p) {
        	$child_part_rate_criteria = array(
					'customer_master_id' => $p->customer_part_id
				);
        	$part_rate = $this->Crud->get_data_by_id_multiple_condition("customer_part_rate", $child_part_rate_criteria);

            $parts_html .= '
		        <tr style="font-size:11px;" class="part-box">
			         <td width="4%" style="text-align:center;line-height:40px;">'.$i.'</td>
			         <td width="45.99%" style="text-align:left;line-height:1.5;height:50.6px;font-size:10.5px;">
			             <table cellpadding="0">
		                <tr><td>'.$p->part_description .'<b style="width:800px !important;"><br> Part No - ' . wordwrap($p->part_number, 12, "\n", true) .'</b>
                		</td>
		                </tr>
		                </table>
			         </td>
			         <td width="9.6%" style="text-align:center;line-height:40px;font-size:11px;">'.$p->hsn_code.'</td>
			         <td width="7%" style="text-align:center;line-height:40px;font-size:11px;">'.$p->uom.'</td>
			         <td width="8.33%" style="text-align:center;line-height:40px;">'.number_format($p->qty, 2, '.', '').'</td>
			         <td width="12.5%" style="text-align:center;line-height:40px;">'.number_format($part_rate[0]->rate, 2, '.', '').'</td>
			         <td width="12.6%" colspan="2" style="text-align:center;line-height:40px;">'.number_format($p->qty*$part_rate[0]->rate, 2, '.', '').'</td>
			     </tr>
		     ';

		     $total_price += $p->qty*$part_rate[0]->rate;
     
        // pr(count($po_parts_data).":".$page_row_count);

         if(count($parts_customer_trackings) < $page_row_count+1){
            $parts_html .='</tbody></table><table cellspacing="0" cellpadding="1"   border="1">
            <tbody>';
         }else if($page_row_count%$page_count == 0 ){
                $parts_html .='</tbody></table><br pagebreak="true"/><table cellspacing="0" cellpadding="1"   border="1">
            <tbody>';
               
            }
         $page_row_count++;
         $i++;
        
          
        }
        $remaining_row = $page_count - count($parts_customer_trackings) % $page_count;
       	// pr($remaining_row,1);
        if( $remaining_row != 0 && (count($parts_customer_trackings) % $page_count != 0)){
            switch ($remaining_row) {
                    case '6':
                       $height = 259.4;
                        break;
                    case '5':
                       $height = 254;
                        break;
                    case '4':
                       $height = 202;
                        break;
                    case '3':
                       $height = 153;
                        break;
                    case '2':
                       $height = 102;
                        break;
                    case '1':
                       $height = 51;
                        break;
                    
                    default:
                        # code...
                        break;
                }

            // pr($type_pdf,1);
 
            $parts_html .='<tr style="font-size:11px;" class="part-box"><td style="height:'.$height.'px;">&nbsp;</td>
            </tr>';
            $parts_html .= '</tbody></table>';
        }


		$footer = '
			<style>
			   th, td ,b{ 
			   font-family: "Poppins", sans-serif;
			   line-height: 1.2;
			   }
			   table {
			   padding: 0px;
			   }
			</style>
			<table cellspacing="0" cellpadding="5" border="1">
			   <tbody>

			      <tr style="font-size:11.59px;">
			       <td rowspan="7" colspan="7" width="59.60%;" style="line-height:25px;">
			            <table cellspacing="0" cellpadding="0">
			               <tbody>
			                  <td style="line-height:1.4;"><b>Payment Terms : ' . $customer_data[0]->payment_terms . '</b> <br><span><b>Bank Details : </b> ' . $client_data[0]->bank_details . '</span><br><b>Electronic Reference No.</b> <br><span><b>GST Value (In Words) : </b> </span><br><span><b>Invoice Value (In Words) : </b> </span>
          
          </td>
			               </tbody>
			            </table>
			         </td>
			         <td colspan="3" style="text-align:left;margin-left:10px;" width="22.95%;">&nbsp;&nbsp;&nbsp;TAXABLE VALUE</td>
			         <td colspan="2" style="text-align:center" width="17.4%">'.number_format($total_price, 2, '.', '').'</td>
			      </tr>
			      <tr style="font-size:11.5px">
			         <td colspan="3" style="text-align:left">&nbsp;&nbsp;&nbsp;IGST 0%</td>
			         <td colspan="2" style="text-align:center">0.00</td>
			      </tr>
			      <tr style="font-size:11.5px">
			         <td colspan="3" style="text-align:left;margin-left:10px;">&nbsp;&nbsp;&nbsp;CGST 0%</td>
			         <td colspan="2" style="text-align:center">0.00</td>
			      </tr>
			      <tr style="font-size:11.5px">
			         <td colspan="3" style="text-align:left;margin-left:10px;">&nbsp;&nbsp;&nbsp;SGST  0%</td>
			         <td colspan="2" style="text-align:center">0.00</td>
			      </tr>
			      <tr style="font-size:11.5px">
			         <td colspan="3" style="text-align:left">&nbsp;&nbsp;&nbsp;TCS 0%</td>
			         <td colspan="2" style="text-align:center">0.00</td>
			      </tr>
			      <tr style="font-size:11.5px">
			         <td colspan="3" style="text-align:left;">&nbsp;&nbsp;&nbsp;P&amp;F Charges</td>
			         <td colspan="2" style="text-align:center">0.00</td>
			      </tr>
			      <tr style="font-size:11.5px">
			         <td colspan="3" style="text-align:left;font-weight: bold">&nbsp;&nbsp;&nbsp;GRAND TOTAL(Rs) </td>
			         <td colspan="2" style="text-align:center;font-weight: bold;">'.number_format($total_price, 2, '.', '').'</td>
			      </tr>
			      <tr style="font-size:9.5px">
			         <td colspan="5">
			            <table cellpadding="0">
			               <tbody>
			                  <tr>
			                     <td>We hereby certify that my/our registration certificate under the Goods and Service Tax
			                        Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
			                        invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
			                        been effected by me/us and it shall be accounted for in the turnover of sales while filling
			                        of return and the due tax. If any, payable on the sale has been paid or shall be paid
			                        <br>Certified that the particulars given above are true.Interest @24% P.A. will be charged on all overdue invoices.<br>Subject To Pune Jurisdiction
			                     </td>
			                  </tr>
			               </tbody>
			            </table>
			         </td>
			         <td colspan="2" style="text-align:center;vertical-align: bottom;font-weight: bold;font-size:11px">
			            Receiver Signature 
			         </td>
			         <td colspan="5" style="text-align:center;font-size:11px;min-width:100px;font-weight: bold;font-size:12px;">
                 For, '.$client_data[0]->client_name.' 
                <br><br><br><br><br>
                <h4 style="white-space:nowrap;"> Authorized Signatory</h4>
            </td>
			      </tr>
			   </tbody>
			</table>
		';
		// pr($parts_customer_trackings,1);
		$file_name = $this->generatePdf($parts_html,$header,$footer,$type_pdf,$customer_tracking_po_id);
		if($type_pdf == "F"){
			$return_data = [
				"file_name" => $file_name,
				"customer_data" => $customer_data,
				"customer_po_tracking" => $customer_po_tracking
			];
			return $return_data;
		}
		
	}


	public function generatePdf($html_content = "",$header="",$footer="",$pdf_download_type="",$id=0){
		 require_once APPPATH . 'libraries/Pdf1.php';
            $meddle_content =110.2;
            $footer_content =-101;
            $top_margin = 6.8;
        
        // pr("ok",1);
        // $header = $this->smarty->fetch('sales/sales_pdf_generate.tpl', $data, TRUE);
            // pr($html_content,1);
            // $pdf = new Pdf1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false,'',$header,$footer,$top_margin, $footer_content);

            $pdf->SetMargins(10, $meddle_content, 8, 5);

        // set document information

        $pdf->SetCreator(PDF_CREATOR);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        // $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT,0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        // set some text to print
        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

        // output the HTML content
        $pdf->writeHTML($html_content, true, false, true, false, '');
        if($pdf_download_type == "I"){
            $pdf->Output($fileAbsolutePath, 'I');
             ob_end_flush();
        }else{
        	$folderPath = "dist/uploads/accept_order";
        	if (!is_dir($folderPath) && $folderPath != "") {
		        mkdir($folderPath, 0777, true);
		    }
            //Close and output PDF document
            $fileName = $folderPath."/accept_order".$id.".pdf";
            $fileAbsolutePath = FCPATH.$fileName;
            // pr($fileAbsolutePath,1);
            $pdf->Output($fileAbsolutePath, 'F');
             ob_end_flush();
            return $fileName;
        }
        
       
    } 
	
	public function customer_po_tracking_all_closed() {
		$data['customer_data'] = $this->Crud->read_data("customer");
		// $role_management_data = $this->db->query('SELECT customer_part.part_number,customer_part.id, customer.customer_name
		// FROM customer_part
		// INNER JOIN customer ON customer_part.customer_id=customer.id;');
		// 		$data['customer_parts'] = $role_management_data->result();
		$data['customer_po_tracking'] = $this->Crud->read_data("customer_po_tracking");
		$data['customer_po_tracking'] = $this->Crud->get_data_by_id("customer_po_tracking", "closed", "status");
		if ($data['customer_po_tracking']) {
			foreach ($data['customer_po_tracking'] as $s) {
				$data['customer_data'][$s->customer_id] = $this->Crud->get_data_by_id("customer", $s->customer_id, "id");
			}
		}
		// $this->getPage('customer_po_tracking_all_closed', $data);
		$this->loadView('customer/customer_po_tracking_all_closed', $data);
	}
	
	public function view_customer_tracking_id()
	{
		$customer_tracking_po_id = $this->uri->segment('2');

		$data['customer_po_tracking'] = $this->Crud->get_data_by_id("customer_po_tracking", $customer_tracking_po_id, "id");
		$data['customer'] = $this->Crud->get_data_by_id("customer", $data['customer_po_tracking'][0]->customer_id , "id");
		$data['new_po'] = $this->Crud->get_data_by_id("customer_po_tracking", $customer_tracking_po_id, "id");
		
		$data['parts_customer_trackings'] = $this->Crud->get_data_by_id("parts_customer_trackings", $customer_tracking_po_id, "customer_po_tracking_id");
		$role_management_data = $this->db->query('SELECT part_number,id,part_description from `customer_part` WHERE customer_id = '. $data['customer_po_tracking'][0]->customer_id.' ORDER BY id DESC');
		$data['customer_part_data'] = $role_management_data->result();
		$global_configuration = $this->Crud->read_data("global_configuration");
		$global_configuration = array_column($global_configuration,"config_value","config_name");
		$data['exportSalesInvoive'] = isset($global_configuration['exportSalesInvoive']) && $global_configuration['exportSalesInvoive'] == "Yes";
		if ($data['parts_customer_trackings']) {
			$final_po_amount = 0;
			$i = 1;
			foreach ($data['parts_customer_trackings'] as $p) {
				$data_id = array(
					'id' => $p->part_id,
				);
				$data['child_part_data'][$p->part_id] = $this->Crud->get_data_by_id_multiple_condition("customer_part", $data_id);
				$child_part_rate_criteria = array(
					'customer_master_id' => $data['child_part_data'][$p->part_id][0]->id
				);
				$data['child_part_rate'][$data['child_part_data'][$p->part_id][0]->id] = $this->Crud->get_data_by_id_multiple_condition("customer_part_rate", $child_part_rate_criteria);
				//get the parts from sales parts whose sales invoice is locked only
				$role_management_data = $this->db->query('SELECT SUM(parts.qty) AS MAINSUM,parts.id from `sales_parts`as parts , 
				new_sales as sales WHERE  parts.part_id = ' . $p->part_id . ' 
				AND parts.po_number = \''.$data['customer_po_tracking'][0]->po_number.'\' 
				AND parts.sales_id = sales.id AND sales.status =\'lock\'');
				$data['sales_qty_data'][$p->part_id] = $role_management_data->result();
				if($data['exportSalesInvoive'] == "Yes"){
					$export_role_management_data = $this->db->query('SELECT SUM(parts.qty) AS MAINSUM,parts.id from `export_sales_parts`as parts , export_sales as sales WHERE  parts.part_id = ' . $p->part_id . ' 
					AND parts.po_number = \''.$data['customer_po_tracking'][0]->po_number.'\' 
					AND parts.sales_id = sales.id AND sales.status =\'lock\'');
					$data['export_sales_qty_data'][$p->part_id] = $export_role_management_data->result();
				}
				// pr($export_role_management_data->result(),1);
				
			}
		}
		
		
		// pr($data,1);
		// $this->getPage('view_customer_tracking_id', $data);
		$this->loadView('customer/view_customer_tracking_id', $data);
	}
	
	
	public function add_parts_customer_trackings()
	{
		$part_id = $this->input->post('part_id');
		$qty = $this->input->post('qty');
		$customer_po_tracking_id = $this->input->post('customer_po_tracking_id');
		$data = array(
			"part_id" => $part_id,
			"customer_po_tracking_id" => $customer_po_tracking_id,
		);
		$check = $this->Crud->read_data_where("parts_customer_trackings", $data);
		$ret_arr = [];
		$msg = '';
		$sucess = 1;
		if ($check != 0) {
			// echo "<script>alert('Part Number Already Exists , Please Select Different Part Number ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
			$msg = 'Part Number Already Exists , Please Select Different Part Number.';
			$sucess = 0;
		} else {
			$child_part_data = $this->Crud->get_data_by_id("customer_part", $part_id, "id");
			
			$data = array(
				"qty" => $qty,
				"customer_po_tracking_id" => $customer_po_tracking_id,
				"part_id" => $part_id,
				"created_by" => $this->user_id,
				"created_date" => $this->current_date,
				"created_time" => $this->current_time,
				"created_day" => $this->date,
				"created_month" => $this->month,
				"created_year" => $this->year,
			);

			$global_configuration = $this->Crud->read_data("global_configuration");
			$global_configuration = array_column($global_configuration,"config_value","config_name");
			$customer_id = $child_part_data[0]->customer_id;
			$customer_data_arr = $this->Crud->get_data_by_id("customer", $customer_id, "id");
			if(isset($global_configuration['exportSalesInvoive']) && $global_configuration['exportSalesInvoive'] == "Yes" && $customer_data_arr[0]->customerType == 'Expoter'){
				$data['drg_no'] = $child_part_data[0]->drg_no;
				$data['rev_no'] = $child_part_data[0]->rev_no;
				$data['moc'] = $child_part_data[0]->moc;
				$data['item_no'] = $this->input->post('item_no');
			}
			
			$result = $this->Crud->insert_data("parts_customer_trackings", $data);
			if ($result) {
				// echo "<script>alert('Successfully Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				$msg = 'Successfully Added';
				
			} else {
				// echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
				$msg = 'Unable to Add';
				$sucess = 0;
			}
		}
		$ret_arr['msg'] = $msg;
		$ret_arr['sucess'] = $sucess;
		echo json_encode($ret_arr);
	}

	private function getPage($viewPage,$viewData){
		$this->getHeaderPage();
		$this->load->view($this->getPath().$viewPage,$viewData);
		$this->load->view('footer.php');
	}
		
}