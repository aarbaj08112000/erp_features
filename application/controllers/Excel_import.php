<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

#require_once('libraries/PHPExcel/IOFactory.php');
require_once(APPPATH.'libraries/PHPExcel/IOFactory.php');
//require 'PHPExcel/PHPExcel.php';
//require_once(APP. ‘Vendor’.DS.‘PHPExcel’.DS.‘IOFactory.php’);

class Excel_import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('excel_import_model');
        // $this->load->    ('excel');
        $this->sales_tracking_id = $this->session->userdata('sales_tracking_id');
        $this->sales_tracking_email = $this->session->userdata('sales_tracking_email');


        $this->current_date = date('Y-m-d');
        $this->current_time = date('h:i:s');
        $this->date_time = date('Y-m-d H:i:s');

        $d = date_parse_from_format("Y-m-d", $this->current_date);
        $this->date = $d["day"];
        $this->month = $d["month"];
        $this->year = $d["year"];
    }

    function index()
    {
        $this->load->view('excel_import');
    }

    function import_shedule_part()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $insert = "";
            foreach ($object->getWorksheetIterator() as $worksheet) {
                // echo "hi22";
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $part_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $process_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $segment_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $sub_segment_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $part_no = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $net_sale_price = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $cast_weight  = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $q1  = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $q2 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $q3 = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $q4 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

                    if ($part_id != ""  || $cast_weight || "" &&  $part_no || "" ||  $process_id != "" || $segment_id != "" ||  $sub_segment_id != "" || $part_no != "" || $net_sale_price != "" || $q1 != "" || $q2 != "" || $q3 != "" || $q4 != "") {
                        // $data = array(
                        // 	'year'=>$this->input->post('year'),
                        // 	'customer_id'=>$this->input->post('customer_id'),
                        // 	'part_id'=>$part_id,
                        // 	'part_no'=>$part_no,
                        // 	'net_sale_price'=>$net_sale_price,
                        // 	'process_id'=>$process_id,
                        // 	'segment_id'=>$segment_id,
                        // 	'sub_segment_id '=>$sub_segment_id,
                        // 	'cast_weight'=>$cast_weight,
                        // 	'q1'=>$q1,
                        // 	'q2'=>$q2,
                        // 	'q3'=>$q3,
                        // 	'q4'=>$q4,
                        // 	'created_at'=>$this->current_date,
                        // 	'created_time'=>$this->current_time,
                        // 	'created_user'=>$this->sales_tracking_id,
                        // 	);

                        // 	$insert = $this->Common_admin_model->insert("schedule_main",$data);

                        if (true) {
                            echo "hi";
                            $month = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

                            $data22 = array(
                                array(
                                    'month'  => "4",
                                    'budget_quantity' => $q1 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "5",
                                    'budget_quantity' => $q1 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "6",
                                    'budget_quantity' => $q1 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "7",
                                    'budget_quantity' => $q2 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "8",
                                    'budget_quantity' => $q2 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "9",
                                    'budget_quantity' => $q2 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "10",
                                    'budget_quantity' => $q3 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "11",
                                    'budget_quantity' => $q3 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                                array(
                                    'month'  => "12",
                                    'budget_quantity' => $q3 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),


                                ),
                                array(
                                    'month'  => "1",
                                    'budget_quantity' => $q4 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),


                                ),
                                array(
                                    'month'  => "2",
                                    'budget_quantity' => $q4 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),


                                ),
                                array(
                                    'month'  => "3",
                                    'budget_quantity' => $q4 / 3,
                                    'created_at' => $this->current_date,
                                    'created_time' => $this->current_time,
                                    'created_user' => $this->sales_tracking_id,
                                    'main_id' => $insert,
                                    'customer_id' => $this->input->post('customer_id'),

                                ),
                            );
                            $insert =  $this->db->insert_batch('sheduling', $data22);
                        } else {
                            echo "error";
                        }
                    } else {
                        //echo "not blank";
                    }
                }
            }
            if ($insert) {
                echo "<script>alert(' Added Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Added Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
            ///}
        }
    }


    
	
    function download_stock_variance()
    {

        $this->load->library("excel");
        $customer_id = $this->input->post('customer_id');
        $financial_year =  $this->input->post('financial_year');
        $month =  $this->input->post('month');
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("Sr No", "Part Number", "Part Description", "System Stock QTY", "Store Rate", "Total Value", "physical stock", "diff in stock qty", "difference in value");
        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $customer_parts = $this->Crud->customQuery('SELECT *   FROM `customer_part` WHERE customer_id = ' . $customer_id . '  ');
        $customer = $this->Crud->get_data_by_id("customer", $customer_id, "id");
        if ($customer_parts) {
            $excel_row = 2;
            $ii = 1;
            foreach ($customer_parts as $p) {
                // $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $financial_year);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $month);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $p->id);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $customer[0]->customer_name);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $p->part_number);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $p->part_description);
                $excel_row++;
                $ii++;
            }
            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="stock_variance.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {
            echo "<script>alert('No Customer Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }


    function import_shedule_part_all_customer()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $insert = "";
            $insert2 = "";
            foreach ($object->getWorksheetIterator() as $worksheet) {
                // echo "hi22";
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $part_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $customer_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $process_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $segment_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $sub_segment_id = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $part_no = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $net_sale_price = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $finish_wegiht  = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $year_id  = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                    $april = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $may = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $june = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $july = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $aug = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $sep = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $oct = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $nov = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $dec = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $jan  = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $feb = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $mar = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $part_revision_id = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    // $business_mt = $finish_wegiht*$budget_quantity/1000;

                    $array2_check_count = array(
                        "part_id" => $part_id,
                        "customer_id" => $customer_id,
                        "year" => $year_id


                    );
                    // echo $part_id;
                    // echo "<br>";

                    $sheduling_count = $this->Common_admin_model->get_data_by_id_multiple_condition_count("sheduling", $array2_check_count);
                    $a = array();
                    if ($sheduling_count == 0) {
                        if ($part_id != ""  || $finish_wegiht || "" ||  $part_no || "" ||  $process_id != "" || $segment_id != "" ||  $sub_segment_id != "" || $part_no != "" || $net_sale_price != "" || $part_revision_id != "") {



                            $insert222 = 1;
                            if ($insert222 == 1) {
                                // echo "hi";
                                $month = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

                                $data22 = array(
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "1",
                                        'budget_quantity' => $april,
                                        'business_mt' => $finish_wegiht * $april / 1000,
                                        'business_plan' => $net_sale_price * $april,

                                        'main_id' => $insert,
                                        'part_revision_id' => $part_revision_id,

                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "2",
                                        'budget_quantity' => $may,
                                        'business_mt' => $finish_wegiht * $may / 1000,
                                        'business_plan' => $net_sale_price * $may,

                                        'main_id' => $insert,
                                        'part_revision_id' => $part_revision_id,


                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "3",
                                        'budget_quantity' => $june,
                                        'business_mt' => $finish_wegiht * $june / 1000,
                                        'business_plan' => $net_sale_price * $june,


                                        'part_revision_id' => $part_revision_id,
                                        'main_id' => $insert,
                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,

                                        'month'  => "4",
                                        'budget_quantity' => $july,
                                        'part_revision_id' => $part_revision_id,
                                        'business_mt' => $finish_wegiht * $july / 1000,
                                        'business_plan' => $net_sale_price * $july,


                                        'main_id' => $insert,
                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,

                                        'month'  => "5",
                                        'budget_quantity' => $aug,
                                        'part_revision_id' => $part_revision_id,
                                        'business_mt' => $finish_wegiht * $aug / 1000,
                                        'business_plan' => $net_sale_price * $aug,


                                        'main_id' => $insert,
                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "6",
                                        'budget_quantity' => $sep,
                                        'part_revision_id' => $part_revision_id,
                                        'business_mt' => $finish_wegiht * $sep / 1000,
                                        'business_plan' => $net_sale_price * $sep,


                                        'main_id' => $insert,

                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "7",
                                        'budget_quantity' => $oct,
                                        'part_revision_id' => $part_revision_id,
                                        'business_mt' => $finish_wegiht * $oct / 1000,
                                        'business_plan' => $net_sale_price * $oct,


                                        'main_id' => $insert,

                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "8",
                                        'budget_quantity' => $nov,
                                        'part_revision_id' => $part_revision_id,
                                        'business_mt' => $finish_wegiht * $nov / 1000,
                                        'business_plan' => $net_sale_price * $nov,


                                        'main_id' => $insert,

                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "9",
                                        'budget_quantity' => $dec,
                                        'business_mt' => $finish_wegiht * $dec / 1000,
                                        'business_plan' => $net_sale_price * $dec,


                                        'part_revision_id' => $part_revision_id,
                                        'main_id' => $insert,

                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "10",
                                        'budget_quantity' => $jan,
                                        'business_mt' => $finish_wegiht * $jan / 1000,
                                        'business_plan' => $net_sale_price * $jan,


                                        'part_revision_id' => $part_revision_id,
                                        'main_id' => $insert,

                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "11",
                                        'budget_quantity' => $feb,
                                        'business_mt' => $finish_wegiht * $feb / 1000,
                                        'business_plan' => $net_sale_price * $feb,


                                        'part_revision_id' => $part_revision_id,
                                        'main_id' => $insert,


                                    ),
                                    array(
                                        'year' => $year_id,
                                        'customer_id' => $customer_id,
                                        'part_id' => $part_id,
                                        'part_no' => $part_no,
                                        'net_sale_price' => $net_sale_price,
                                        'process_id' => $process_id,
                                        'segment_id' => $segment_id,
                                        'sub_segment_id ' => $sub_segment_id,
                                        'finish_wegiht' => $finish_wegiht,
                                        'created_date' => $this->current_date,
                                        'created_time' => $this->current_time,
                                        'created_day' => $this->date,
                                        'created_year' => $this->year,
                                        'created_month' => $this->month,
                                        'created_user' => $this->sales_tracking_id,
                                        'created_user' => $this->sales_tracking_id,
                                        'month'  => "12",
                                        'budget_quantity' => $mar,
                                        'business_mt' => $finish_wegiht * $mar / 1000,
                                        'business_plan' => $net_sale_price * $mar,


                                        'part_revision_id' => $part_revision_id,
                                        'main_id' => $insert,


                                    ),
                                );

                                $insert2 =  $this->db->insert_batch('sheduling', $data22);
                            } else {
                                echo "error";
                            }
                        } else {
                            //echo "not blank";
                        }
                    } else {
                        array_push($a, $part_id);
                    }
                }
            }

            if (empty($a)) {
                if ($insert2) {
                    echo "<script>alert('Shedule added Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    echo "<script>alert('Shedule added Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            } else {

                echo "<h1 style='color:red;font-weight:bold;text-align:center'>Following Parts Are Already Entered :</h1>";
                echo "<a href='" . base_url('customer_wise_budget') . "' style='background-color:red;color:white;width:100px;height:20px;padding:10px'>< Go Back</a>";

                echo "<ul style='font-size:40px;'>";
                foreach ($a as $b) {
                    $part_costings_data = $this->Common_admin_model->get_data_by_id("part_costings", $b, "id");

                    echo "<li>" . $part_costings_data[0]->part_no . " / " . $part_costings_data[0]->part_name . "</li>";
                }
                echo "</ul>";
            }

            //}



        }
    }

    function my_import_test()
    {
		if (isset($_FILES["uploadedDoc"]["name"])) {
            echo "....Got the file...";
			$path = $_FILES["uploadedDoc"]["tmp_name"];
			
			$object = PHPExcel_IOFactory::load($path);
			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
				echo "<br> highestRow: ".$highestRow;
				echo "<br> highestColumn: ".$highestColumn;
			    for ($row = 2; $row <= $highestRow; $row++) {
                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					echo "<br> Sr No: ".$row." => ".$id;
				    $shedule_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					echo "<br> Financial Year: ".$row." => ".$shedule_id;
                    
					// print_r($sheduling[0]->net_sale_price);
                    // echo "<br>";
					// $budget_quantity = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    // $monthly_shedule_value = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    // $actual_value = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    // echo "<br>";

					/*
                    if ($id != "" && $shedule_id != "") {
                        $sheduling = $this->Common_admin_model->get_data_by_id("sheduling", $shedule_id, "id");
                        $net_sale_price = $sheduling[0]->net_sale_price;
                        $finish_wegiht = $sheduling[0]->finish_wegiht;
                        //	$business_mt = $finish_wegiht*$budget_quantity/1000;
                        $monthly_mt = ($finish_wegiht * $monthly_shedule_value) / 1000;
                        //	$actual_mt = $finish_wegiht*$actual_value/1000;



                        // $business_plan = round($net_sale_price*$budget_quantity);
                        $monthly_plan = round($net_sale_price * $monthly_shedule_value);
                        // $actual_plan = round($net_sale_price*$actual_value);	
                        $data = array(
                            // 'budget_quantity'=>$budget_quantity,
                            'monthly_shedule_value' => $monthly_shedule_value,
                            // 'actual_value'=>$actual_value,
                            // 'business_mt'=>$business_mt,
                            'monthly_mt' => $monthly_mt,
                            // 'actual_mt'=>$actual_mt,
                            // 'business_plan'=>$business_plan,
                            'monthly_plan' => $monthly_plan,
                            // 'actual_plan'=>$actual_plan,



                        );
                        // print_r($data);
                        // echo "<br>";
                        $update = $this->Common_admin_model->update("sheduling", $data, "id", $shedule_id);
                    } else {
                        // echo "no";
                        // echo "<br>";

                    } */
                }
            }
			exit();
            if ($update) {
                echo "<script>alert('Shedule Updated Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }


    function import_shedule_part_update()
    {
        if (isset($_FILES["file"]["name"])) {



            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $shedule_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

                    // print_r($sheduling[0]->net_sale_price);
                    // echo "<br>";




                    // $budget_quantity = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $monthly_shedule_value = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    // $actual_value = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    // echo "<br>";


                    if ($id != "" && $shedule_id != "") {
                        $sheduling = $this->Common_admin_model->get_data_by_id("sheduling", $shedule_id, "id");
                        $net_sale_price = $sheduling[0]->net_sale_price;
                        $finish_wegiht = $sheduling[0]->finish_wegiht;
                        //	$business_mt = $finish_wegiht*$budget_quantity/1000;
                        $monthly_mt = ($finish_wegiht * $monthly_shedule_value) / 1000;
                        //	$actual_mt = $finish_wegiht*$actual_value/1000;



                        // $business_plan = round($net_sale_price*$budget_quantity);
                        $monthly_plan = round($net_sale_price * $monthly_shedule_value);
                        // $actual_plan = round($net_sale_price*$actual_value);	
                        $data = array(
                            // 'budget_quantity'=>$budget_quantity,
                            'monthly_shedule_value' => $monthly_shedule_value,
                            // 'actual_value'=>$actual_value,
                            // 'business_mt'=>$business_mt,
                            'monthly_mt' => $monthly_mt,
                            // 'actual_mt'=>$actual_mt,
                            // 'business_plan'=>$business_plan,
                            'monthly_plan' => $monthly_plan,
                            // 'actual_plan'=>$actual_plan,



                        );
                        // print_r($data);
                        // echo "<br>";
                        $update = $this->Common_admin_model->update("sheduling", $data, "id", $shedule_id);
                    } else {
                        // echo "no";
                        // echo "<br>";

                    }
                }
            }
            if ($update) {
                echo "<script>alert('Shedule Updated Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }


    function import_shedule_part_update_actual_plan()
    {
        if (isset($_FILES["file"]["name"])) {



            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $shedule_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

                    // print_r($sheduling[0]->net_sale_price);
                    // echo "<br>";




                    // $budget_quantity = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    //$monthly_shedule_value = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $actual_value = $worksheet->getCellByColumnAndRow(6, $row)->getValue();



                    if ($id != "" && $shedule_id != "") {
                        $sheduling = $this->Common_admin_model->get_data_by_id("sheduling", $shedule_id, "id");
                        $net_sale_price = $sheduling[0]->net_sale_price;
                        $finish_wegiht = $sheduling[0]->finish_wegiht;
                        //	$business_mt = $finish_wegiht*$budget_quantity/1000;
                        //	$monthly_mt = $finish_wegiht*$monthly_shedule_value/1000;
                        $actual_mt = $finish_wegiht * $actual_value / 1000;



                        // $business_plan = round($net_sale_price*$budget_quantity);
                        //$monthly_plan = round($net_sale_price*$monthly_shedule_value);
                        $actual_plan = round($net_sale_price * $actual_value);
                        $data = array(
                            // 'budget_quantity'=>$budget_quantity,
                            //'monthly_shedule_value'=>$monthly_shedule_value,
                            'actual_value' => $actual_value,
                            // 'business_mt'=>$business_mt,
                            //'monthly_mt'=>$monthly_mt,
                            'actual_mt' => $actual_mt,
                            // 'business_plan'=>$business_plan,
                            //'monthly_plan'=>$monthly_plan,
                            'actual_plan' => $actual_plan,



                        );
                        //print_r($data);
                        $update = $this->Common_admin_model->update("sheduling", $data, "id", $shedule_id);
                    }
                }
            }
            if ($update) {
                echo "<script>alert('Actual Updated Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }


    function import_shedule_part_update_business_plan()
    {
        $a = 0;
        if (isset($_FILES["file"]["name"])) {




            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $shedule_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

                    // print_r($sheduling[0]->net_sale_price);
                    // echo "<br>";




                    $part_revision_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $budget_quantity = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    // $monthly_shedule_value = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    // $actual_value = $worksheet->getCellByColumnAndRow(7, $row)->getValue();





                    if ($id != "" && $shedule_id != "") {




                        $sheduling = $this->Common_admin_model->get_data_by_id("sheduling", $shedule_id, "id");

                        $array_check_latest_revision = array(
                            "revision_number" => trim($part_revision_id),
                            "part_no" => trim($sheduling[0]->part_no),
                            "customer_id" => trim($sheduling[0]->customer_id),
                        );

                        $latest_part_data  = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array_check_latest_revision);

                        if ($latest_part_data) {

                            $net_sale_price = $latest_part_data[0]->net_sale_price;
                            $finish_wegiht = $latest_part_data[0]->finish_weight;
                            $business_mt = $finish_wegiht * $budget_quantity / 1000;
                            // $monthly_mt = $finish_wegiht*$monthly_shedule_value/1000;
                            // $actual_mt = $finish_wegiht*$actual_value/1000;



                            $business_plan = round($net_sale_price * $budget_quantity);
                            // $monthly_plan = round($net_sale_price*$monthly_shedule_value);
                            // $actual_plan = round($net_sale_price*$actual_value);	
                            $data = array(
                                'part_revision_id' => $part_revision_id,
                                'net_sale_price ' => $net_sale_price,
                                'finish_wegiht ' => $finish_wegiht,
                                'budget_quantity' => $budget_quantity,
                                "part_id" => $latest_part_data[0]->id,
                                // 'monthly_shedule_value'=>$monthly_shedule_value,
                                // 'actual_value'=>$actual_value,
                                'business_mt' => $business_mt,
                                // 'monthly_mt'=>$monthly_mt,
                                // 'actual_mt'=>$actual_mt,
                                'business_plan' => $business_plan,
                                // 'monthly_plan'=>$monthly_plan,
                                // 'actual_plan'=>$actual_plan,




                            );
                            //print_r($data);
                            // echo $latest_part_data[0]->id;
                            // echo "<br>";
                            $update = $this->Common_admin_model->update("sheduling", $data, "id", $shedule_id);
                        } else {
                            $a = 1;
                            $customer_data = $this->Common_admin_model->get_data_by_id("customers", $sheduling[0]->customer_id, "id");

                            echo " Part No : " . $sheduling[0]->part_no . "  AND Revision Num  :" . $part_revision_id . "   With Customer ID : " . $sheduling[0]->customer_id . " (" . $customer_data[0]->customer_name . " )  NOT FOUND , plese check revision number agian<br><br>";


                            //array_push($a,$sheduling[0]->part_no);
                            // echo "NO : ".$sheduling[0]->part_no;
                            // echo "<br>";
                        }
                    }
                }
            }


            if ($a == 0) {
                if ($update) {
                    echo "<script>alert('Shedule Updated Successfully !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    echo "<script>alert('Error ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            } else {
                // echo "All Other Parts Are Updated Following "

                // foreach ($a as $bb)
                // {

                // }
            }
        }
    }


    function export_shedule_part()
    {

        $this->load->library("excel");
        $customer_id = $this->uri->segment('2');
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Sr No", "Part ID", "Process ID", "Segment ID", "Sub-Segment ID", "Part Number", "Net Sale Price", "Cast Weight", "Budget Plan Q1", "Budget Plan Q2", "Budget Plan Q3", "Budget Plan Q4");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $role_management_data = $this->db->query('SELECT DISTINCT part_no,drawing_r_n FROM `part_costings` WHERE customer_id = ' . $customer_id . '  ');
        $part_costings2 = $role_management_data->result();


        if ($part_costings2) {




            $excel_row = 2;
            $ii = 1;
            foreach ($part_costings2 as $p) {
                $array = array(
                    "part_no" => $p->part_no,
                    "drawing_r_n" => $p->drawing_r_n,

                );

                $part_costings = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array);
                $array2 = array(
                    "id" => $part_costings[0]->customer_id,

                );
                $customers = $this->Common_admin_model->get_data_by_id_multiple_condition("customers", $array2);

                // $part_costings = $this->Common_admin_model->get_all_data("part_costings");

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $part_costings[0]->id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $part_costings[0]->process_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $customers[0]->segment_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $part_costings[0]->sub_segment_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $part_costings[0]->part_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $part_costings[0]->net_sale_price);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $part_costings[0]->cast_weight);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, '0');
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, '0');
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '0');
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, '0');


                $excel_row++;
                $ii++;
            }
            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="All Parts.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {
            echo "<script>alert('No Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    function download_all()
    {

        //echo "hi";
        $from_year = $this->input->post('year_id');

        if (!empty($from_year)) {
            $inputFileName = 'final_march_2.xlsx';

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                // $objPHPExcel2 = $objReader->load($inputFileName);

            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                    $e->getMessage());
            }


            $excel_row = 14;


            $objPHPExcel->setActiveSheetIndex(0);




            $customer_id = $this->input->post('customer_id');
            if ($customer_id == 0) {
                $sheduling = $this->Common_admin_model->select_one_with_where("sheduling", "part_id", " WHERE year = '" . $year_id . "' ");
                $table_name = "all_data";

                $customer_name = "All";

                $part_name = "All";
            } else {
                // $sheduling = $this->Common_admin_model->select_one_with_where("sheduling", "part_id", " WHERE year = '" . $year_id . "' and customer_id = '" . $cusomter_id . "' ");
                $cusomter_data = $this->Common_admin_model->get_data_by_id("customers", $customer_id, "id");
                $table_name = "customer_" . $cusomter_data[0]->id;

                $customer_name = $cusomter_data[0]->customer_name;

                $part_name = "All";
            }

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, $customer_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, $from_year);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, $part_name);

            $all_data = $this->Common_admin_model->get_data_by_id_asc($table_name, $from_year, "year");




            $excel_row = 14;
            foreach ($all_data as $so) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row,     $so->name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,     $so->APR);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,     $so->MAY);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,     $so->JUN);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,     $so->JUL);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,     $so->AUG);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,  $so->SEP);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,  $so->AUG);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $so->NOV);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $so->DEC);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $so->JAN);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $so->FEB);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $so->MAR);


                $excel_row++;
            }

            $objPHPExcel->setActiveSheetIndex(1);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, $customer_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, $from_year);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, $part_name);

            $excel_row = 14;
            foreach ($all_data as $so) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row,     $so->name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,     $so->APR_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,     $so->MAY_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,     $so->JUN_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,     $so->JUL_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,     $so->AUG_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,     $so->SEP_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,  $so->OCT_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,  $so->NOV_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $so->DEC_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $so->JAN_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $so->FEB_shedule);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $so->MAR_shedule);


                $excel_row++;
            }

            $objPHPExcel->setActiveSheetIndex(2);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, $customer_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, $from_year);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, $part_name);

            $excel_row = 14;
            foreach ($all_data as $so) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row,     $so->name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,     $so->APR_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,     $so->MAY_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,     $so->JUN_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,     $so->JUL_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,     $so->AUG_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,  $so->SEP_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,  $so->OCT_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $so->NOV_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $so->DEC_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $so->JAN_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $so->FEB_actual);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $so->MAR_actual);


                $excel_row++;
            }

            $objPHPExcel->setActiveSheetIndex(0);









            // for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
            // 	$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            // }
            // echo "hi";
            //print_r($objPHPExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="All Data.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            ob_start();
            // $objWriter->setPreCalculateFormulas(); 
            $objWriter->save('php://output');

            // header('Content-Type: application/vnd.ms-excel'); 
            // header('Content-Disposition: attachment;filename="testing.xls"'); 
            // header('Cache-Control: max-age=0'); 
            // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
            // ob_end_clean();
            // ob_start();
            // // $objWriter->setPreCalculateFormulas(); 
            // $objWriter->save('php://output');

        } else {
            echo "Year not found";
        }
    }


    function testing()
    {

        $inputFileName = 'budget_report_test.xlsx';

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray(
                'A' . $row . ':' . $highestColumn . $row,
                null,
                true,
                false
            );


            for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }

            $this->load->library("excel");
            $customer_id = 8;
            // $object = new PHPExcel();

            $objPHPExcel->setActiveSheetIndex(1);

            // $table_columns = array("Sr No","part_no ","part_name ","r_m_cost","icc_cost", "scrap_recovery ","core_cost","decoring_cost","business","monthly","actual");

            $column = 0;

            // foreach($table_columns as $field)
            // {
            // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            // $column++;
            // }
            $role_management_data = $this->db->query('SELECT DISTINCT part_no FROM `part_costings` ');
            $part_costings2 = $role_management_data->result();


            if ($part_costings2) {




                $excel_row = 2;
                $ii = 1;
                foreach ($part_costings2 as $p) {
                    $array = array(
                        "part_no" => $p->part_no,
                        // "drawing_r_n"=>$p->drawing_r_n,

                    );

                    $part_costings = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array);
                    $sheduling = $this->Common_admin_model->get_data_by_id("sheduling", $part_costings[0]->id, "id");



                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $part_costings[0]->part_no);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $part_costings[0]->part_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $part_costings[0]->r_m_cost);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $part_costings[0]->icc_cost);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $part_costings[0]->scrap_recovery);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $part_costings[0]->core_cost);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $part_costings[0]->decoring_cost);


                    $iit = 8;
                    foreach ($sheduling as $s) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iit, $excel_row, $s->budget_quantity);
                        $ii++;
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iit, $excel_row, $s->monthly_shedule_value);
                        $ii++;
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iit, $excel_row, $s->actual_value);
                    }


                    $excel_row++;
                    $ii++;
                }
                for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
                    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }
            } else {
                echo "<script>alert('No Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="testing.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        ob_start();
        // $objWriter->setPreCalculateFormulas(); 
        $objWriter->save('php://output');

        // $objWriter->setIncludeCharts(TRUE);
        // $objWriter->setIncludeCharts(TRUE);
        // $ContentType = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";


    }


    function testing_new()
    {

        $inputFileName = 'budget_format.xlsx';

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray(
                'A' . $row . ':' . $highestColumn . $row,
                null,
                true,
                false
            );


            for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }

            $this->load->library("excel");
            $customer_id = 8;
            // $object = new PHPExcel();

            $objPHPExcel->setActiveSheetIndex(0);

            $table_columns = array("Sr No", "part_no ", "part_name ", "r_m_cost", "icc_cost", "scrap_recovery ", "core_cost", "decoring_cost", "business", "monthly", "actual");

            $column = 0;

            foreach ($table_columns as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
            $role_management_data = $this->db->query('SELECT DISTINCT part_no FROM `part_costings` ');
            $part_costings2 = $role_management_data->result();


            if ($part_costings2) {




                $excel_row = 2;
                $ii = 1;
                foreach ($part_costings2 as $p) {
                    $array = array(
                        "part_no" => $p->part_no,
                        // "drawing_r_n"=>$p->drawing_r_n,

                    );

                    $part_costings = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array);
                    $sheduling = $this->Common_admin_model->get_data_by_id("sheduling", $part_costings[0]->id, "id");



                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $part_costings[0]->part_no);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $part_costings[0]->part_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $part_costings[0]->r_m_cost);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $part_costings[0]->icc_cost);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $part_costings[0]->scrap_recovery);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $part_costings[0]->core_cost);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $part_costings[0]->decoring_cost);


                    $iit = 8;
                    foreach ($sheduling as $s) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iit, $excel_row, $s->budget_quantity);
                        $ii++;
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iit, $excel_row, $s->monthly_shedule_value);
                        $ii++;
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iit, $excel_row, $s->actual_value);
                    }


                    $excel_row++;
                    $ii++;
                }
                for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
                    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }
            } else {
                echo "<script>alert('No Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="testing.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        ob_start();
        // $objWriter->setPreCalculateFormulas(); 
        $objWriter->save('php://output');

        // $objWriter->setIncludeCharts(TRUE);
        // $objWriter->setIncludeCharts(TRUE);
        // $ContentType = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";


    }



    //new export budget  start
    function export_shedule_part_all()
    {
        $this->load->library("excel");
        $year_id = $this->input->post('year_id');
        // $customer_id = $this->uri->segment('2');
        $object = new PHPExcel();
        // $object->getActiveSheet()->getProtection()->setSheet(true);
        // $object->getActiveSheet()->getStyle('A1:Z400')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

        $object->setActiveSheetIndex(0);


        // $object->protectCells('A1:B1', 'PHP');
        // $object->protectCells('O4:O10', 'password');
        $table_columns = array("Sr No", "Part ID", "Customer ID", "Process ID", "Segment ID", "Sub-Segment ID", "Part Number", "Net Sale Price", "Finish Weight", "Year ID", "APR QTY", "MAY QTY", "JUN QTY", "JUL QTY", "AUG QTY", "SEP QTY", "OCT QTY", "NOV QTY", "DEC QTY", "JAN QTY", "FEB QTY", "MAR QTY", "Customer Name", "Part Revision Number");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $role_management_data = $this->db->query('SELECT DISTINCT part_no,customer_id FROM `part_costings` ');
        $part_costings2 = $role_management_data->result();


        if ($part_costings2) {

            $excel_row = 2;
            $ii = 1;
            foreach ($part_costings2 as $p) {
                $array = array(
                    "part_no" => $p->part_no,
                    "customer_id" => $p->customer_id,

                );

                $part_costings = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array);

                $array2_check = array(
                    // "part_id" => $part_costings[0]->id,
                    "part_no" => $part_costings[0]->part_no,
                    "year" => $year_id,
                    "customer_id" => $p->customer_id,


                );

                $sheduling = $this->Common_admin_model->get_data_by_id_multiple_condition_count("sheduling", $array2_check);

                if ($sheduling == 0) {
                    $array2 = array(
                        "id" => $part_costings[0]->customer_id,

                    );
                    $customers = $this->Common_admin_model->get_data_by_id_multiple_condition("customers", $array2);

                    // $part_costings = $this->Common_admin_model->get_all_data("part_costings");

                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $part_costings[0]->id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $part_costings[0]->customer_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $part_costings[0]->process_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $customers[0]->segment_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $part_costings[0]->sub_segment_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $part_costings[0]->part_no);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $part_costings[0]->net_sale_price);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $part_costings[0]->finish_weight);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $year_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, '0');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $customers[0]->customer_name);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $part_costings[0]->revision_number);


                    $excel_row++;
                    $ii++;
                }
            }
            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }

            // for ($row = 1; $row <= 10; $row++) {
            // 	$object->getActiveSheet()
            // 		->setCellValue(
            // 			'X' . $row,
            // 			'=SUM(H'.$row.':H'.$row.')/10 + SUM(H'.$row.':H'.$row.')/20 + SUM(H'.$row.':H'.$row.')/60'
            // 		);
            // }

            // $object->getActiveSheet()->setCellValue(
            // 	'X5',
            // 	'=SUM(H2:19)'
            // );





            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="All Customers Parts.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            // $objWriter->setPreCalculateFormulas(); 
            $objWriter->save('php://output');

            echo "<script>alert('Downloaded');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('No Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    // new export budget end
    function export_new_schedule()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Sr No", "Part ID", "Process ID", "Segment ID", "Sub-Segment ID", "Part Number", "Net Sale Price", "Budget Plan Q1", "Budget Plan Q2", "Budget Plan Q3", "Budget Plan Q4");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $role_management_data = $this->db->query('SELECT DISTINCT part_no,drawing_r_n FROM `part_costings`  ');
        $part_costings2 = $role_management_data->result();


        if ($part_costings2) {




            $excel_row = 2;
            $ii = 1;
            foreach ($part_costings2 as $p) {
                $array = array(
                    "part_no" => $p->part_no,
                    "drawing_r_n" => $p->drawing_r_n,

                );

                $part_costings = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array);
                $array2 = array(
                    "id" => $part_costings[0]->customer_id,

                );
                $customers = $this->Common_admin_model->get_data_by_id_multiple_condition("customers", $array2);

                // $part_costings = $this->Common_admin_model->get_all_data("part_costings");

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $ii);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $part_costings[0]->id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $part_costings[0]->process_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $customers[0]->segment_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $part_costings[0]->sub_segment_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $part_costings[0]->part_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $part_costings[0]->net_sale_price);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '0');
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, '0');
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, '0');
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '0');


                $excel_row++;
                $ii++;
            }
            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="All Parts.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {
            echo "<script>alert('No Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    function download_schedule_by_customer()
    {

        // $customer_id = $this->input->post('customer_id');
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        if ($this->input->post('customer_id')) {
            $customer_id = $this->input->post('customer_id');
            $array = array(
                // "customer_id"=>$customer_id,
                "year" => $year,
                "month" => $month,
                "customer_id" => $customer_id

            );
        } else {
            $array = array(
                // "customer_id"=>$customer_id,
                "year" => $year,
                "month" => $month

            );
        }




        $count1 = $this->Common_admin_model->get_data_by_id_multiple_condition_count("sheduling", $array);

        if ($count1 == 0) {
            echo "<script>alert('No Data Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            // $schedule_main = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling",$array);
            // $array23 = array(
            // 	"year"=>$year,
            // 	"month"=>$month,

            //   );

            $sheduling = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling", $array);


            $table_columns = array("SR NO", "Schedule ID", "Customer Name", "Part Number", "Part Name", "Month", "Monthly Schedule Quantity", "Part Revision Number", "Year");


            $i = 0;
            $column = 0;


            if ($sheduling) {
                $this->load->library("excel");
                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);


                foreach ($table_columns as $field) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;
                }




                $excel_row = 2;
                $ii = 1;
                $sr = 1;
                foreach ($sheduling as $p) {
                    $customers = $this->Common_admin_model->get_data_by_id("customers", $p->customer_id, "id");
                    $part_costings = $this->Common_admin_model->get_data_by_id("part_costings", $p->part_id, "id");
                    $month = $this->Common_admin_model->get_month($p->month);



                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sr);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $p->id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $customers[0]->customer_name);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $p->part_no);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $part_costings[0]->part_name);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $month);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, round($p->monthly_shedule_value));
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $p->part_revision_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $year);


                    $excel_row++;
                    $ii++;
                    $i++;
                    $sr++;
                }
                // print_r($sheduling);
                for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                    $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }


                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Update Schedule .xls"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                ob_end_clean();
                ob_start();
                $objWriter->save('php://output');
            }
        }
    }
    function download_schedule_by_customer_actual()
    {

        // $customer_id = $this->input->post('customer_id');
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        if ($this->input->post('customer_id')) {
            $customer_id = $this->input->post('customer_id');
            $array = array(
                // "customer_id"=>$customer_id,
                "year" => $year,
                "month" => $month,
                "customer_id" => $customer_id

            );
        } else {
            $array = array(
                // "customer_id"=>$customer_id,
                "year" => $year,
                "month" => $month

            );
        }




        $count1 = $this->Common_admin_model->get_data_by_id_multiple_condition_count("sheduling", $array);

        if ($count1 == 0) {
            echo "<script>alert('No Data Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            // $schedule_main = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling",$array);
            // $array23 = array(
            // 	"year"=>$year,
            // 	"month"=>$month,

            //   );

            $sheduling = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling", $array);


            $table_columns = array("SR NO", "Schedule ID", "Customer Name", "Part Number", "Part Name", "Month", "Actual Value");


            $i = 0;
            $column = 0;


            if ($sheduling) {
                $this->load->library("excel");
                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);


                foreach ($table_columns as $field) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;
                }




                $excel_row = 2;
                $ii = 1;
                $sr = 1;
                foreach ($sheduling as $p) {
                    $customers = $this->Common_admin_model->get_data_by_id("customers", $p->customer_id, "id");
                    $part_costings = $this->Common_admin_model->get_data_by_id("part_costings", $p->part_id, "id");
                    $month = $this->Common_admin_model->get_month($p->month);



                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sr);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $p->id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $customers[0]->customer_name);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $p->part_no);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $part_costings[0]->part_name);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $month);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, round($p->actual_value));


                    $excel_row++;
                    $ii++;
                    $i++;
                    $sr++;
                }
                // print_r($sheduling);
                for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                    $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }


                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Update Actual .xls"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                ob_end_clean();
                ob_start();
                $objWriter->save('php://output');
            }
        }
    }
    function download_schedule_by_customer_busniess()
    {

        // $customer_id = $this->input->post('customer_id');
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        if ($this->input->post('customer_id')) {
            $customer_id = $this->input->post('customer_id');
            $array = array(
                // "customer_id"=>$customer_id,
                "year" => $year,
                "month" => $month,
                "customer_id" => $customer_id

            );
        } else {
            $array = array(
                // "customer_id"=>$customer_id,
                "year" => $year,
                "month" => $month

            );
        }




        $count1 = $this->Common_admin_model->get_data_by_id_multiple_condition_count("sheduling", $array);

        if ($count1 == 0) {
            echo "<script>alert('No Data Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            // $schedule_main = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling",$array);
            // $array23 = array(
            // 	"year"=>$year,
            // 	"month"=>$month,

            //   );

            $sheduling = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling", $array);


            $table_columns = array("SR NO", "Schedule ID", "Customer Name", "Part Revision Number", "Part Number", "Part Name", "Month", "Budget Quantity");


            $i = 0;
            $column = 0;


            if ($sheduling) {
                $this->load->library("excel");
                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);


                foreach ($table_columns as $field) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;
                }




                $excel_row = 2;
                $ii = 1;
                $sr = 1;
                foreach ($sheduling as $p) {
                    $customers = $this->Common_admin_model->get_data_by_id("customers", $p->customer_id, "id");
                    $part_costings = $this->Common_admin_model->get_data_by_id("part_costings", $p->part_id, "id");
                    $month = $this->Common_admin_model->get_month($p->month);



                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sr);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $p->id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $customers[0]->customer_name);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $p->part_revision_id);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $p->part_no);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $part_costings[0]->part_name);

                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $month);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, round($p->budget_quantity));



                    $excel_row++;
                    $ii++;
                    $i++;
                    $sr++;
                }
                // print_r($sheduling);
                for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                    $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }


                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Busniess Plan Update.xls"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                ob_end_clean();
                ob_start();
                $objWriter->save('php://output');
            }
        }
    }

















    function export_shedule_part_customer()
    {
        $main_id = $this->uri->segment('2');


        $array = array(
            "main_id" => $main_id,

        );
        $shedule  = $this->Common_admin_model->get_data_by_id_multiple_condition("sheduling", $array);


        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Id", "Part ID", "Process ID", "Segment ID", "Sub-Segment ID", "Part Number", "Net Sale Price", "Budget Plan Quantity", "Monthly Shedule Quantity ", "Actual Quantity");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }


        // $array = array(
        // 	"customer_id"=>$customer_id,
        // 	"alloy_id"=>$alloy_id
        // );
        // $data['raw_material'] = $this->Common_admin_model->get_data_by_id_multiple_condition("raw_material",$array);


        // $role_management_data = $this->db->query('SELECT DISTINCT part_no,drawing_r_n FROM `sheduling`  ');
        // $part_costings2= $role_management_data->result();


        if ($shedule) {




            $excel_row = 2;
            $ii = 1;
            foreach ($shedule as $p) {
                $array = array(
                    "id" => $p->part_id,
                    "customer_id" => $p->customer_id,
                    // "customer_id"=>$customer_id			
                );
                $part_costings = $this->Common_admin_model->get_data_by_id_multiple_condition("part_costings", $array);

                // $part_costings = $this->Common_admin_model->get_all_data("part_costings");

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $p->id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $p->part_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $p->process_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $p->segment_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $p->sub_segment_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $p->part_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, round($p->net_sale_price));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, round($p->budget_quantity));
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, round($p->monthly_shedule_value));
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, round($p->actual_value));
                // $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->discounted_price);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->created_date);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->delivery_days);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->manufacturer);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->brand);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->material);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->handling_tint);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->uv_Protection);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->usage_instructions);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->description);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->purchase_price);
                $excel_row++;
                $ii++;
            }

            // print_r($object);
            //   $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            //   header('Content-Type: application/vnd.ms-excel');
            //   header('Content-Disposition: attachment;filename="product_name.xls"');
            //   $object_writer->save('php://output');
            // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
            // header('Content-Type: application/vnd.ms-excel');
            // header('Content-Disposition: attachment;filename="quoatation22.xlsx"');
            // ob_end_clean();
            // $object_writer->save('php://output');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="All Parts.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {
            echo "<script>alert('No Parts Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }


    function export_customer()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("First Name", "Middle Name", "Last Name", "email", "Mobile Number", "Alternate Mobile Code", "Alternate Mobile", "city", "area", "building_no", "zone", "street", "email Verified", "Company Name");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $product_code = $this->Common_admin_model->get_all_data("user");

        $excel_row = 2;

        foreach ($product_code as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->first_name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->middle_name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->last_name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->email);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->mobile_number);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->a_mobile_number_code);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->a_mobile_number);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->city);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->aera);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->building_no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->zone);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->street);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->email_verified);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->company_name);
            $excel_row++;
        }

        // print_r($object);
        //   $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        //   header('Content-Type: application/vnd.ms-excel');
        //   header('Content-Disposition: attachment;filename="product_name.xls"');
        //   $object_writer->save('php://output');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="quoatation22.xlsx"');
        // ob_end_clean();
        // $object_writer->save('php://output');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="All Customer.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $objWriter->save('php://output');
    }
    function export_promocode()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("name", "type", "amount", "expiry_date", "created_at");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $product_code = $this->Common_admin_model->get_all_data("promo_codes");

        $excel_row = 2;

        foreach ($product_code as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->type);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->amount);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->expiry_date);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->created_at);

            $excel_row++;
        }

        // print_r($object);
        //   $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        //   header('Content-Type: application/vnd.ms-excel');
        //   header('Content-Disposition: attachment;filename="product_name.xls"');
        //   $object_writer->save('php://output');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="quoatation22.xlsx"');
        // ob_end_clean();
        // $object_writer->save('php://output');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="All Promocode.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $objWriter->save('php://output');
    }
    function export_track_my_order()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("order_id", "request_date", "timestamp");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $product_code = $this->Common_admin_model->get_all_data("track_order");

        $excel_row = 2;

        foreach ($product_code as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->order_id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->tracked_at);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->timestamp);

            $excel_row++;
        }

        // print_r($object);
        //   $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        //   header('Content-Type: application/vnd.ms-excel');
        //   header('Content-Disposition: attachment;filename="product_name.xls"');
        //   $object_writer->save('php://output');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="quoatation22.xlsx"');
        // ob_end_clean();
        // $object_writer->save('php://output');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="All Track orders.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $objWriter->save('php://output');
    }
    function export_return_order()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("order_id", "request_date", "timestamp");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $product_code = $this->Common_admin_model->get_all_data_without_delete("return_order");

        $excel_row = 2;

        foreach ($product_code as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->order_id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->request_date);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->time_stamp);

            $excel_row++;
        }

        // print_r($object);
        //   $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        //   header('Content-Type: application/vnd.ms-excel');
        //   header('Content-Disposition: attachment;filename="product_name.xls"');
        //   $object_writer->save('php://output');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="quoatation22.xlsx"');
        // ob_end_clean();
        // $object_writer->save('php://output');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="All Return Order.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $objWriter->save('php://output');
    }

    function export_child_products()
    {
        $this->load->library("excel");
        $object = new PHPExcel();
        $product_id =  $this->uri->segment('2');


        $object->setActiveSheetIndex(0);

        $table_columns = array("diameter", "base_curve", "power", "cylinder", "axis", "colour", "sku", "stock_count", "delivery_days", "created_date");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $product_code = $this->Common_admin_model->get_data_by_id("new_product_options", $product_id, "product_id");


        $excel_row = 2;

        foreach ($product_code as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->diameter);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->base_curve);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->power);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->cylinder);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->axis);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->colour);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->sku);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->stock_count);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->delivery_days);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->created_date);
            $excel_row++;
        }

        // print_r($object);
        //   $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        //   header('Content-Type: application/vnd.ms-excel');
        //   header('Content-Disposition: attachment;filename="product_name.xls"');
        //   $object_writer->save('php://output');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="quoatation22.xlsx"');
        // ob_end_clean();
        // $object_writer->save('php://output');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Child Products.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $objWriter->save('php://output');
    }
}
