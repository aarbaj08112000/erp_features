<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

#require_once('libraries/PHPExcel/IOFactory.php');
require_once('CommonController.php');
require_once(APPPATH.'libraries/PHPExcel/IOFactory.php');
//require 'PHPExcel/PHPExcel.php';
//require_once(APP. ‘Vendor’.DS.‘PHPExcel’.DS.‘IOFactory.php’);

class Tushar_Controller extends CommonController
{
   
    const TUSHAR_TRACKING_PATH = "tushar/";
    
    function __construct() {
        parent::__construct();
        $this->load->model('Tracking');
    }
    
    private function getPath(){
        return self::TUSHAR_TRACKING_PATH;
    }


    public function customer_po_tracking_importExport() {
        $data['customer_data'] = $this->Crud->read_data("customer");
        $customer_id = $this->input->post('customer_id');

        $fileter_customer = $this->session->userdata("customer_id");
        if($fileter_customer > 0 && !($customer_id > 0)){
            $customer_id = $fileter_customer;
            $this->session->set_userdata('customer_id', '');
        }

        $data['po_message'] = $this->session->userdata("po_message");
        if( $this->session->userdata("po_message") != ""){
            $this->session->set_userdata('po_message', '');
        }
         $data['po_message_su'] = $this->session->userdata("po_message_su");
        if( $this->session->userdata("po_message_su") != ""){
            $this->session->set_userdata('po_message_su', '');
        }
        
        $sql =  "SELECT po.po_number, masterParts.part_number, masterParts.part_description, 
                custPart.imported_price AS imported_price, custPart.qty, custPart.status, custPart.due_date,
                custPart.warehouse,custPart.remark, masterParts.thickness, masterParts.passivationType,masterParts.rm_grade,
                masterParts.id AS masterParts_id, masterParts.customer_id, rate_query.rate 
                FROM customer_po_tracking AS po
                JOIN parts_customer_trackings AS custPart ON custPart.customer_po_tracking_id = po.id
                JOIN customer_part AS masterParts ON custPart.part_id = masterParts.id
                LEFT JOIN (
                    SELECT cpr.id, cpr.customer_master_id, cpr.rate
                    FROM customer_part_rate AS cpr
                    LEFT JOIN customer_part_rate AS cpr2
                        ON cpr.customer_master_id = cpr2.customer_master_id
                        AND cpr.id < cpr2.id
                    WHERE cpr2.id IS NULL
                ) AS rate_query ON rate_query.customer_master_id = masterParts.id"; 



        //$ old_working_sql = "SELECT R.rate as rate, I.* FROM view_po_import_export I, customer_part_rate R WHERE I.rate_id = R.id ";

        /*$sql = "select po.po_number, masterParts.part_number, masterParts.part_description, 
            custPart.imported_price as po_price, partRate.rate as rate, masterParts.thickness, masterParts.passivationType,masterParts.rm_grade, 
            custPart.qty, masterParts.uom, custPart.status, 
            custPart.due_date,custPart.warehouse,custPart.remark
            from customer_po_tracking as po, parts_customer_trackings as custPart,customer_part as masterParts, customer_part_rate as partRate
            where custPart.customer_po_tracking_id = po.id AND custPart.part_id = masterParts.id 
            AND masterParts.id = partRate.customer_master_id"; */

        // if($customer_id!=null){
            if($customer_id != "ALL" && $customer_id!=null){
                    //$old_working_sql = $old_working_sql." AND I.customer_id = ".$customer_id." group by I.masterParts_id";
                    //$query = $this->db->query($old_working_sql);
                    $sql = $sql." WHERE masterParts.customer_id = ".$customer_id." ORDER BY custPart.id DESC";
                    $data['export_data'] = $this->Crud->customQuery($sql);
            }else if($customer_id == ""){
                    //$old_working_sql = $old_working_sql." group by I.masterParts_id";
                    //$query = $this->db->query($old_working_sql);
                    $sql = $sql." ORDER BY custPart.id DESC";
                    $data['export_data'] = $this->Crud->customQuery($sql);
            }
        // }
        /*if($query!=null){
            $data['export_data'] = $query->result();
        }*/

        /* 
        Older query
        $query = $this->db->query("select po.po_number, masterParts.part_number, masterParts.part_description, custPart.imported_price as po_price, partRate.rate as rate, custPart.qty, custPart.status, custPart.due_date,custPart.warehouse,custPart.remark
        from customer_po_tracking as po, parts_customer_trackings as custPart,customer_part as masterParts, customer_part_rate as partRate
        where custPart.customer_po_tracking_id = po.id AND custPart.part_id = masterParts.id AND masterParts.id = partRate.customer_master_id order by custPart.id desc limit 50");
        */

        //$data['export_data'] = $query->result();
        
        /*select po.po_number, masterParts.part_number, masterParts.part_description, partRate.rate, custPart.qty, custPart.status 
        from customer_po_tracking as po, parts_customer_trackings as custPart,customer_part as masterParts, customer_part_rate as partRate
        where 
        po.created_date = "14-06-2023"                  -- get today's PO
        AND custPart.customer_po_tracking_id = po.id    -- get PO specific part details like qty and status
        AND custPart.part_id = masterParts.id           -- get part specific details like number and description
        AND masterParts.id = partRate.customer_master_id -- get rate details for specific customer part
        506, 507
        */
        
        $data['customer_id']=$customer_id;
        // pr($data,1);
        $data['segment_2']=$this->uri->segment('2');
        $data['segment_3']=$this->uri->segment('3');
        $this->loadView('customer/po_tracking_import_export', $data);
    }

    /**
     *  Import format per Tushar ERP
     */
    public function import_customer_po_tracking(){
       $customer_id = $this->input->post('customer_id');
       $uploadedDoc = $this->input->post('uploadedDoc');



       //only valid types are allowed.
       if($this->isValidUploadFileType()=="false"){
            $data['po_message'] = "Only Excel sheets are allowed.";
            $this->session->set_userdata('po_message', $data['po_message']);
       } else {

        if (!empty($_FILES["uploadedDoc"]["name"])) {
                $error;

                $inputFileName = $_FILES["uploadedDoc"]["tmp_name"];
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $flag = true;
                        $i=1;

                        $EXCEL_IMPORT_CUSTOMER_NAME_COLUMN = 'A';
                        $EXCEL_IMPORT_PO_COLUMN = 'B';
                        $EXCEL_IMPORT_PO_START_COLUMN = 'C';
                        $EXCEL_IMPORT_PO_END_COLUMN = 'D';
                        $EXCEL_IMPORT_ITEM_CODE = 'F';
                        $EXCEL_IMPORT_ITEM_COLUMN = 'F';
                        $EXCEL_IMPORT_ITEM_DESC_COLUMN = 'G';
                        $EXCEL_IMPORT_QUANTITY_COLUMN = 'H';
                        $EXCEL_IMPORT_WAREHOUSE_COLUMN = 'I';
                        $EXCEL_IMPORT_REMARK_COLUMN = 'J';

                        foreach ($allDataInSheet as $value) {
                            // Check if the row is empty
                                if (!empty(array_filter($value))) {
                                if($flag) {
                                    $flag =false;
                                    continue;
                                }

                                $rowNum = $i+1;
                                $errorThisRow=null; 
                                $errorCount;

                                $customer = empty($value[$EXCEL_IMPORT_CUSTOMER_NAME_COLUMN]) ? $errorThisRow =$errorThisRow." Customer": trim($value[$EXCEL_IMPORT_CUSTOMER_NAME_COLUMN]);
                                $po_number = empty($value[$EXCEL_IMPORT_PO_COLUMN]) ? $errorThisRow =$errorThisRow." PO ,": trim($value[$EXCEL_IMPORT_PO_COLUMN]);

                                $format = "d/m/Y";
                                $startDate = $inputDate = $value[$EXCEL_IMPORT_PO_START_COLUMN];
                                $startDateTime = $dateTime = DateTime::createFromFormat($format, $inputDate);
                                $po_start_date = empty($value[$EXCEL_IMPORT_PO_START_COLUMN]) || !($dateTime && $dateTime->format($format) === $inputDate) ? $errorThisRow =$errorThisRow." PO Start Date format should be dd/mm/yyyy,": trim($value[$EXCEL_IMPORT_PO_START_COLUMN]);

                                $endDate = $inputDate = $value[$EXCEL_IMPORT_PO_END_COLUMN];
                                $endDateTime = $dateTime = DateTime::createFromFormat($format, $inputDate);

                                $po_end_date = empty($value[$EXCEL_IMPORT_PO_END_COLUMN]) || !($dateTime && $dateTime->format($format) === $inputDate) ? $errorThisRow =$errorThisRow."PO End Date format should be dd/mm/yyyy ,": trim($value[$EXCEL_IMPORT_PO_END_COLUMN]);
                                $part_name = empty($value[$EXCEL_IMPORT_ITEM_COLUMN]) ? $errorThisRow = $errorThisRow." Part Number ," : trim($value[$EXCEL_IMPORT_ITEM_COLUMN]);
                                $part_description = empty($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]) ? $errorThisRow = $errorThisRow." Part description ,": trim($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]);
                                $part_quantity = !((float) $value[$EXCEL_IMPORT_QUANTITY_COLUMN] > 0) ? $errorThisRow =$errorThisRow." Quantity Should be greater than 0,": trim($value[$EXCEL_IMPORT_QUANTITY_COLUMN]);
                                $warehouse = $value[$EXCEL_IMPORT_WAREHOUSE_COLUMN];
                                $remark = $value[$EXCEL_IMPORT_REMARK_COLUMN];


                                if($value[$EXCEL_IMPORT_PO_COLUMN] != "" && $value[$EXCEL_IMPORT_PO_COLUMN] != NULL && !empty($value[$EXCEL_IMPORT_PO_END_COLUMN]) && !empty($value[$EXCEL_IMPORT_PO_START_COLUMN]) && ($startDateTime && $startDateTime->format($format) === $startDate) && ($endDateTime && $endDateTime->format($format) === $endDate)){
                                    //Start Date
                                    $po_start_date = $formattedDate = DateTime::createFromFormat('d/m/Y', $po_start_date)->format('Y-m-d');
                                    // End Date
                                    $po_end_date = $formattedDate = DateTime::createFromFormat('d/m/Y', $po_end_date)->format('Y-m-d');
                                    $inserdata[$i]['po_number'] = $po_number;
                                    $inserdata[$i]['po_start_date'] = $po_start_date;
                                    $inserdata[$i]['po_end_date'] = $po_end_date;
                                    $inserdata[$i]['part_name'] = $part_name;
                                    $inserdata[$i]['part_description'] = $part_description;
                                    $inserdata[$i]['part_quantity'] = $part_quantity;
                                    $inserdata[$i]['warehouse'] = $warehouse;
                                    $inserdata[$i]['remark'] = $remark;
                                }
                                if(!empty($errorThisRow)){
                                    $error = $error."<br>Row Number ".$rowNum." - Required Fields : ".$errorThisRow;
                                }
                                $i++;
                                    
                               
                            }
                        }


                        $clientId = $this->Unit->getSessionClientId();
                        if(empty($error)){

                            // check validation for po unique 
                            $po_item_arr = [];
                            $po_arr = [];
                            $po_data_arr = [];
                            $invalid_part = [];
                            $dublicat_po = [];
                            $custom_err = false;
                            $po_Key = 0;
                            foreach ($inserdata as $key => $value) {
                                if(!in_array($value['po_number'] ,$po_arr)){
                                    $data = array(
                                        "po_number" => $value['po_number'],
                                        "customer_id" => $customer_id
                                    );
                                    $check_poNo = $this->Tracking->getPOTracking($data);
                                    if(empty($check_poNo)){
                                        $po_arr[] = $value['po_number'];
                                        $po_data_arr[$po_Key] = [
                                            "po_number" => $value['po_number'],
                                            "po_start_date" => $value['po_start_date'],
                                            "po_end_date" => $value['po_end_date']
                                        ];
                                        $po_Key++;
                                    }else{
                                        $custom_err = true;
                                        $dublicat_po[] = $value['po_number'];
                                    }
                                }


                                // 
                                $part_master_data = $this->db->query('
                                    SELECT cp.part_number,cp.id as customer_part_id
                                    FROM `customer_part` as cp
                                    WHERE cp.customer_id = '.$customer_id.' AND cp.part_number = "'.$value['part_name'].'"'
                                );
                                $part_master_data= $part_master_data->result();
                                if(!empty($part_master_data)){
                                    $part_rate_data = $this->db->query('
                                        SELECT *
                                        FROM `customer_part_rate` 
                                        WHERE customer_master_id="'.$part_master_data[0]->customer_part_id.'" 
                                        ORDER BY `id` DESC');
                                    $part_rate_data= $part_rate_data->result();
                                    $part_rate_data = $part_rate_data[0];
                                    if(!empty($part_rate_data)){
                                        $po_item_arr[$value['po_number']][] = [
                                            "part_id" => $part_master_data[0]->customer_part_id,
                                            "part_name" => $value['part_name'],
                                            "part_description" => $value['part_description'],
                                            "part_rate" => $part_rate_data->rate,
                                            "part_qty" => $value['part_quantity'],
                                            "warehouse" => $value['warehouse'],
                                            "remark" => $value['remark'],
                                            "due_date" => $value['po_end_date']
                                        ];
                                    }
                                }else{
                                    unset($po_data_arr[$po_Key-1]);
                                    $custom_err = true;
                                    $invalid_part[] = $value['part_name'];
                                }
                                
                            }
                            // pr($po_item_arr,1);



                            /* insert po */
                            $insert_po_data = [];
                            $import_data = false;
                            $dublicate_items = [];
                            if(date("m") < 4){
                                $start_year = substr(date("Y", strtotime("-1 year")), -2);
                                $start_year_val = date("Y", strtotime("-1 year"));
                                $end_year = substr(date("Y", strtotime("-1 year")), -2);
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
                            $total_records = $parts_customer_trackings[0]->total_record;
                            foreach ($po_data_arr as $key => $value) {
                                $dublicate_items_row = [];
                                $data = array(
                                    "po_start_date" => $value['po_start_date'],
                                    "po_end_date" => $value['po_end_date'],
                                    "po_number" => $value['po_number'],
                                    "po_amedment_number" => "",
                                    "po_amendment_date" => "",
                                    "customer_id" => $customer_id,
                                    "created_by" => $this->user_id,
                                    "created_date" => $this->current_date,
                                    "created_time" => $this->current_time,
                                    "created_by" => $this->current_date,
                                    "created_day" => $this->date,
                                    "created_month" => $this->month,
                                    "created_year" => $this->year,
                                    "uploadedDoc" => ""
                                );
                                $import_data = true;
                                    $insert_po_data[$value['po_number']] = $result;
                                    $po_parts = $po_item_arr[$value['po_number']];
                                    $po_tracking_parts = [];
                                    $item_used_arr = [];
                                    foreach ($po_parts as $key1 => $val) {
                                        if(!in_array($val['part_name'], $item_used_arr)){
                                            $po_tracking_parts[] = array(
                                                "qty" => $val['part_qty'],
                                                "customer_po_tracking_id" => "",
                                                "part_id" => $val['part_id'],
                                                "status" => "pending",
                                                "remark" => $val['remark'],
                                                "warehouse" => $val['warehouse'],
                                                "due_date" => $val['due_date'],
                                                "imported_price" =>$val['part_rate'],
                                                "created_by" => $this->user_id,
                                                "created_date" => $this->current_date,
                                                "created_time" => $this->current_time,
                                                "created_day" => $this->date,
                                                "created_month" => $this->month,
                                                "created_year" => $this->year,
                                            );
                                            $item_used_arr[] = $val['part_name'];
                                        }else{
                                            $dublicate_items[] = $val['part_name'];
                                            $dublicate_items_row[] = $val['part_name'];
                                        }
                                }

                                if(is_valid_array($dublicate_items_row)){
                                    unset($po_data_arr[$key]);
                                    continue;
                                }else{
                                    $total_records++;
                                    $acceptance_number = "OA/".$start_year."-".$end_year."/".$total_records;
                                    $data['acceptance_number'] = $acceptance_number;
                                    $result = $this->Crud->insert_data("customer_po_tracking", $data);
                                    if($result){
                                        foreach ($po_tracking_parts as $key => $value) {
                                            $po_tracking_parts[$key]['customer_po_tracking_id'] = $result;
                                        }
                                        if(is_array($po_tracking_parts) &&count($po_tracking_parts) > 0){
                                            $check_poNo = $this->Tracking->batchInsert($po_tracking_parts,"parts_customer_trackings");
                                        }
                                        
                                    }
                                }

                                
                            }
                            
                            $dublicate_po_message = count($dublicat_po) > 0 ? "Dublicate Po numbers : ".implode(",", array_unique($dublicat_po))."<br>" : "";
                            $invalid_item_message = count($invalid_part) > 0 ? "Invalid Item : ".implode(",", array_unique($invalid_part))."<br>" : "";
                            $dublicate_po_item = count($dublicate_items) > 0 ? "Dublicate Item : ".implode(",", array_unique($dublicate_items)) : "";
                            

                            if($error){
                                $data['po_message'] = $error;
                                $this->session->set_userdata('po_message', $data['po_message']);
                            }else if(($custom_err && !$import_data) || !is_valid_array($po_data_arr)){
                                 $data['po_message'] = $dublicate_po_message.$invalid_item_message.$dublicate_po_item;
                                 $this->session->set_userdata('po_message', $data['po_message']);
                            }else{
                                $added_po = implode(",", array_column($po_data_arr,"po_number"));
                                $data['po_message'] = $dublicate_po_message.$invalid_item_message.$dublicate_po_item;
                                $this->session->set_userdata('po_message', $data['po_message']);
                                $data['po_message_su'] = "Po Data imported successfully for ".$added_po.".";
                                $this->session->set_userdata('po_message_su', $data['po_message_su']);
                            }


                        } else {
                            //echo "<br><br>All Errors : ".$error;
                            //echo "<br>ERROR !";
                            // $this->addErrorMessage($error);
                            $data['po_message'] = $error;
                            $this->session->set_userdata('po_message', $data['po_message']);
                        }   

                    } catch (Exception $e) {
                    //     die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    // . '": ' .$e->getMessage());
                    }
                
                }
                //for view pages
                $data['customer_data'] = $this->Crud->read_data("customer");              
            }

            // pr($data,1);
            // pr($data,1);
            $this->session->set_userdata('customer_id', $customer_id);
            // pr($_SESSION,1);
            redirect('customer_po_tracking_importExport');
    }


function po_export_customer_part() {
        $this->load->library("excel");
        $customer_id = $this->input->post('customer_id');
       
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        $table_columns = array("Customer Name", "PO","Start Date","End Date", "Item Code", "Part No", "Part Description","Quantity","Warehouse","Remark");

        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        
        $customer = $this->Crud->get_data_by_id("customer", $customer_id, "id");
        $customerParts = $this->db->query('SELECT * FROM `customer_part` WHERE customer_id = ' . $customer_id . '  ');
        $customer_parts = $customerParts->result();
        if ($customer_parts) {
            $excel_row = 2;
            $rowNo = 1;
            foreach ($customer_parts as $p) {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $customer[0]->customer_name."[".$customer[0]->customer_code."]");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $p->itemCode);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $p->part_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $p->part_description);
                $excel_row++;
                $rowNo++;
            }
            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$customer[0]->customer_name."_Parts.xls");
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
            $this->session->set_userdata('po_message', '');
        } else {
            echo "<script>document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            $this->session->set_userdata('po_message', 'No Customer Parts Found');
        }
    }
    
    private function getPage($viewPage,$viewData){
        $this->loadView($this->getPath().$viewPage,$viewData);
    }
}
