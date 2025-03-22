<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');
require_once(APPPATH . 'libraries/PHPExcel/IOFactory.php');

class PartInspectionController extends CommonController
{

    const CUSTOMER_VIEW_PATH = "inspection/";

    function __construct()
    {
        parent::__construct();
    }

    private function getPath()
    {
        return self::CUSTOMER_VIEW_PATH;
    }

    private function getPage($viewPage, $viewData)
    {
        $this->loadView($this->getPath() . $viewPage, $viewData);
    }

    public function view_inspection_parm_details()
    {
        $data['customer_id'] = $this->uri->segment('2');
        $customer_part_id = $this->uri->segment('3');
        $data['customer_part_id'] = $customer_part_id;
        $data['customer_part']  = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
        $data['cust_part_inspection_master'] = $this->Crud->customQuery("SELECT * from cust_part_inspection_master where customer_partKy = " . $customer_part_id);
        $this->loadView('sales/view_inspection_parm_details', $data);
    }

    public function add_inspection_parm_details()
    {
        $customer_part_id = $this->input->post('customer_part_id');
        $parm = $this->input->post('parameter');
        $specification = $this->input->post('specification');
        $evaluation_technique = $this->input->post('evalution_mesaurement_technique');
        $lower_spec_limit = $this->input->post('lower_spec_limit');
        $upper_spec_limit = $this->input->post('upper_spec_limit');
        $critical_parm = $this->input->post('critical_parm');


        $is_PDI = $this->input->post('is_PDI');
        $is_setup = $this->input->post('is_setup');
        $is_layout = $this->input->post('is_layout');
        $is_inprocess_inspection = $this->input->post('is_inprocess_inspection');

        $data = array(
            "customer_partKy" => $customer_part_id,
            "parameter" => $parm,
            "specification" => $specification,
            "evalution_mesaurement_technique" => $evaluation_technique,
            "lower_spec_limit" => $lower_spec_limit,
            "upper_spec_limit" => $upper_spec_limit,
            "critical_parm" => $critical_parm,
            "is_PDI" => $is_PDI === "on" ? true : false,
            "is_setup" => $is_setup === "on" ? true : false,
            "is_layout" => $is_layout === "on" ? true : false,
            "is_inprocess_inspection" => $is_inprocess_inspection === "on" ? true : false

        );
        $success = 0;
        $messages = "Something went wrong.";
        $insert = $this->Crud->insert_data("cust_part_inspection_master", $data);
        if ($insert) {
            $messages = "Inspection Parameters added successfully.";
            $success = 1;
            // $this->addSuccessMessage('Inspection Parameters added successfully.');
        } else {
            if ($this->checkNoDuplicateEntryError()) {
                $messages = "Unable to add Inspection Parameters. Please try again.";
                // $this->addErrorMessage('Unable to add Inspection Parameters. Please try again.');
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }


    public function update_inspection_parm_details()
    {
        $id = $this->input->post('id');
        $customer_part_id = $this->input->post('customer_part_id');
        $parm = $this->input->post('parameter');
        $specification = $this->input->post('specification');
        $evaluation_technique = $this->input->post('evalution_mesaurement_technique');
        $lower_spec_limit = $this->input->post('lower_spec_limit');
        $upper_spec_limit = $this->input->post('upper_spec_limit');
        $critical_parm = $this->input->post('critical_parm');


        $is_PDI = $this->input->post('is_PDI');
        $is_setup = $this->input->post('is_setup');
        $is_layout = $this->input->post('is_layout');
        $is_inprocess_inspection = $this->input->post('is_inprocess_inspection');

        $data = array(
            "customer_partKy" => $customer_part_id,
            "parameter" => $parm,
            "specification" => $specification,
            "evalution_mesaurement_technique" => $evaluation_technique,
            "lower_spec_limit" => $lower_spec_limit,
            "upper_spec_limit" => $upper_spec_limit,
            "critical_parm" => $critical_parm,
            "is_PDI" => $is_PDI === "on" ? true : false,
            "is_setup" => $is_setup === "on" ? true : false,
            "is_layout" => $is_layout === "on" ? true : false,
            "is_inprocess_inspection" => $is_inprocess_inspection === "on" ? true : false

        );
        $success = 0;
        $messages = "Something went wrong.";
        $update = $this->Crud->update_data("cust_part_inspection_master", $data, $id);
        if ($update) {
            $messages = "Inspection Parameters updated successfully.";
            $success = 1;
            // $this->addSuccessMessage('Inspection Parameters updated successfully.');
        } else {
            if ($this->checkNoDuplicateEntryError()) {
                $messages = "Unable to update Inspection Parameters. Please try again.";
                // $this->addErrorMessage('Unable to update Inspection Parameters. Please try again.');
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }

    public function view_PDI_inspection_report()
    {
        $sales_id = $this->uri->segment('2');
        $data['sales_parts_for_PDI'] = $this->Crud->customQuery(
            "SELECT DISTINCT s.id as sales_part_id, c.customer_name, n.sales_number, n.created_date, 
                p.id as customer_part_id, p.part_number, p.part_description
         FROM new_sales n
         LEFT JOIN customer c ON n.customer_id = c.id
         LEFT JOIN sales_parts s ON n.id = s.sales_id
         LEFT JOIN customer_part p ON s.part_id = p.id
         LEFT JOIN cust_part_inspection_master m ON m.customer_partKy = p.id
         WHERE n.id = " . $sales_id . " 
         AND m.is_PDI = 1"
        );

        $this->getPage('view_PDI_inspection_report', $data);
        
    }

    public function auto_submit_inspection_report_observations()
    {
        $sales_part_id_customer_id = $this->input->post('sales_part_id_customer_id');
        list($sales_part_id, $customer_part_id) = explode(',', $sales_part_id_customer_id);

        $addNewPartParms = $this->input->post('addNewPartParms');

        //Check whether there is atleast 1 record for observation
        $hasObservations = $this->Crud->customQuery(
            "SELECT count(r.id) as count
					FROM  
					cust_part_inspection_report r 
					WHERE r.sales_partky = " . $sales_part_id . "
                    AND r.customer_partKy = " . $customer_part_id
        );
        if ($sales_part_id == null) {
            $alertCode = "<script>
							alert('\\n Please select Part Number.');
							</script>";
            echo $alertCode;
            exit();
        }

        if ($hasObservations[0]->count == 0) {
            //echo "<br> No records found so we are good to insert records";
            $result = $this->bulkObservationInsert($sales_part_id, $customer_part_id);
            if ($result == true) {
                $this->addSuccessMessage("Added records successfully.");
            } else {
                $alertCode = "<script>
							alert('\\n Failed to add records. Please try again.');
							</script>";
                echo $alertCode;
            }
        } else {
            if ($addNewPartParms == "true") {
                //echo "Add missing parameters only";
                $result = $this->bulkObservationInsert($sales_part_id, $customer_part_id);
                if ($result == true) {
                    $alertCode = "<script>
							alert('\\n New parameter observations added successfully.');
							</script>";
                } else {
                    $alertCode = "<script>
							alert('\\n No New Drawing parameters found for this part in master.');
							</script>";
                }
                echo $alertCode;
            }
        }

        //show respective PDI observations on UI...
        $data['cust_part_inspection_report'] = $this->Crud->customQuery(
            "SELECT * 
				FROM cust_part_inspection_report 
				WHERE sales_partky =" . $sales_part_id . "
				AND customer_partKy = " . $customer_part_id . " 
				ORDER BY id asc"
        );

        $data['sales_part_id'] = $sales_part_id;
        $this->load->view('inspection/load_inspection_report_table', $data);
    }

    /*
	 Insert bulk observations if there are no records or requested to add new records only 
	*/
    private function bulkObservationInsert($sales_part_id, $customer_part_id)
    {
        //if there are no observations recorded so far then only insert records.
        $new_cust_part_observation_insert = $this->Crud->customQuery(
            "SELECT m.id, m.parameter, m.specification, m.evalution_mesaurement_technique, m.critical_parm, m.lower_spec_limit, m.upper_spec_limit
					FROM cust_part_inspection_master m 
					LEFT JOIN cust_part_inspection_report r 
					ON (m.id = r.cust_part_inspection_masterKy AND sales_partky =" . $sales_part_id . ")
					WHERE m.customer_partKy = " . $customer_part_id . "   
					AND m.is_PDI = 1
					AND r.id is null
					ORDER BY m.id asc"
        );


        $data = array();
        if ($new_cust_part_observation_insert) {
            foreach ($new_cust_part_observation_insert as $d) { 
                if(strcasecmp($this->isPDIRandomGeneratorEnabled(),'true') == 0
                    && is_numeric($d->lower_spec_limit) && is_numeric($d->upper_spec_limit)) {
                        $random_num = $this->randomNumGenerator($d->lower_spec_limit, $d->upper_spec_limit);
                }else{
                    $random_num = array(null, null, null,null,null);
                }
                $data[] = array(
                    'cust_part_inspection_masterKy' => $d->id,
                    'sales_partky' => $sales_part_id,
                    'customer_partKy' => $customer_part_id,
                    'parameter' => $d->parameter,
                    'specification' => $d->specification,
                    'evalution_mesaurement_technique' => $d->evalution_mesaurement_technique,
                    'critical_parm' => $d->critical_parm,
                    'lower_spec_limit' => $d->lower_spec_limit,
                    'upper_spec_limit' => $d->upper_spec_limit,
                    'observation1' => $random_num[0],
                    'observation2' => $random_num[1],
                    'observation3' => $random_num[2],
                    'observation4' => $random_num[3],
                    'observation5' => $random_num[4],
                    'remark' => NULL,
                    'isManualLogObsrvtn' => 0
                );
            }
            $this->db->insert_batch('cust_part_inspection_report', $data);
            return true;
        } else {
            return false;
        }
    }

    private function randomNumGenerator($rangeStart, $rangeEnd)
    {
        $numbers = array();

        for ($i = 0; $i < 5; $i++) {
            $number = mt_rand($rangeStart * 10, $rangeEnd * 10) / 10;
            $numbers[] = number_format($number, 2);
        }

        // Ensure all numbers are within the range
        foreach ($numbers as &$number) {
            $number = min(max($number, $rangeStart), $rangeEnd);
        }
        return $numbers;
    }

    private function randomNumGeneratorWithSpecificFactor($rangeStart, $rangeEnd)
    {
        //echo "<br> executed: randomNumGenerator";
        $commonFactor = mt_rand(0, 100) / 100; // Generate a random factor between 0 and 1
        //$rangeStart = 5;
        //$rangeEnd = 10;
        $numbers = array();

        //echo "commonFactor: " . $commonFactor . "\n\n";
        // Generate the first number within the range
        $number = mt_rand($rangeStart * 10, $rangeEnd * 10) / 10;
        $numbers[] = number_format($number, 2);

        // Generate the second number by adding the common factor
        $number = $numbers[0] + $commonFactor;
        $numbers[] = number_format($number, 2);


        // Generate random increments for the remaining numbers
        for ($i = 2; $i < 5; $i++) {
            $randomIncrement = mt_rand(1, 5) / 10; // Adjust the range as needed
            $number = $numbers[$i - 1] + $randomIncrement;
            $numbers[] = number_format($number, 2);
        }

        // Ensure all numbers are within the range
        foreach ($numbers as &$number) {
            $number = min(max($number, $rangeStart), $rangeEnd);
        }
        return $numbers;
    }

    public function edit_inspection_parm_report_form()
    {
        $id = $this->input->post('id');
        $sales_part_id = $this->input->post('sales_part_id');
        //echo "m_id: " . $id;
        //echo "r_id: " . $r_id;
        //echo "sales_part_id: " . $sales_part_id;

        //$data['cust_part_inspection_report']  = $this->Crud->get_data_by_id("cust_part_inspection_report", $id, "id");
        $data['cust_part_inspection_report'] = $this->Crud->customQuery(
            "SELECT *
			FROM cust_part_inspection_report
			WHERE id = " . $id
        );
        $data["sales_part_id"] = $sales_part_id;
        $this->load->view('inspection/edit_inspection_parm_report_form', $data);
    }

    public function update_inspection_report_observations()
    {

        $record_id = $this->input->post('r_id');
        $sales_part_id = $this->input->post('sales_part_id');
        $sales_part_id = $this->input->post('sales_part_id');

        $observation1 = $this->input->post('observation1');
        $observation2 = $this->input->post('observation2');
        $observation3 = $this->input->post('observation3');
        $observation4 = $this->input->post('observation4');
        $observation5 = $this->input->post('observation5');
        $remark = $this->input->post('remark');
       
        $data=array("isManualLogObsrvtn" => '1',  "remark" => $remark);

        if($observation1!=null) {
            $data["observation1"] = $observation1;
        }
        if($observation2!=null) {
            $data["observation2"] = $observation2;
        }
        if($observation3!=null) {
            $data["observation3"] = $observation3;
        }
        if($observation4!=null) {
            $data["observation4"] = $observation4;
        }
        if($observation5!=null) {
            $data["observation5"] = $observation5;
        }
       $message = "Something went wrong";
       $success = 0;
        if ($record_id != null) {
            $update = $this->Crud->update_data("cust_part_inspection_report", $data, $record_id);
            if ($update) {
                $message ="Inspection observations submitted.";
                $success = 1;
       //          $alertCode = "<script>
							// alert('\\n Inspection observations submitted.');
							// </script>";
       //          echo $alertCode;
       //          exit();
                //$this->addSuccessMessage('Inspection observations updated successfully.');
            } else {
                if ($this->checkNoDuplicateEntryError()) {
                    $message = "Unable to update Inspection observations. Record already exists.";
                    // $alertCode = "<script>
                    //     alert('\\n Unable to update Inspection observations. Record already exists.');
                    //     </script>";
                    // echo $alertCode;
                    // exit();
                    //$this->addErrorMessage('Unable to update Inspection observations. Record already exists.');
                } else {
                    $message = "Unable to update Inspection observations. Please try again.";
                    // $alertCode = "<script>
                    //     alert('\\n Unable to update Inspection observations. Please try again.');
                    //     </script>";
                    // echo $alertCode;
                    // exit();
                    //$this->addErrorMessage('Unable to update Inspection observations. Please try again.');
                }
            }
        }
        $result = [];
        $result['message'] = $message;
        $result['success'] = $success;
        echo json_encode($result);
        exit(); 
    }

    public function view_PDI()
    {
        $sales_id = $this->uri->segment('2');

        $client_data  = $this->Unit->getClientUnitDetails();
        $sales_data = $this->Crud->customQuery(
            "SELECT c.customer_name, c.vendor_code, n.sales_number, n.created_date, p.part_number, 
			p.part_description, s.qty as quantity, n.customer_part_id 
			FROM new_sales n, sales_parts s, customer c, customer_part p
			WHERE s.id = " . $sales_id . " 
			AND s.sales_id = n.id
			AND s.part_id = p.id
			AND n.customer_id = c.id"
        );


        $PDIData = $this->Crud->customQuery(
            "SELECT * FROM cust_part_inspection_report WHERE sales_partky = " . $sales_id
        );

        $drawing = $this->Crud->customQuery("
			SELECT revision_date, revision_no
			FROM `customer_part_drawing`
			WHERE `customer_master_id` = " . $sales_data[0]->customer_part_id . "
			ORDER BY `id` DESC");

        $html_content_header = '
            <!DOCTYPE html>
              <style> 
                  html { margin: 10px }
                  th, td {
                    //border: 1px solid black;
                    border-collapse: collapse;
                    padding-top: 2px;
                    padding-bottom: 2px;
                    padding-left: 5px;
                    padding-right: 5px;
                }		
    
                @media print {
                    .container{ 
                      width: 95%; 
                      height: auto; 
                      margin: 50px auto; 
                    } 
    
                  @page 
                  {
                    size: auto;   /* auto is the initial value */
                    margin: 5mm;  /* this affects the margin in the printer settings */
                    size: landscape; /* Set the print layout to landscape */
                  }
                  body {
                    margin-top: 5mm; 
                    margin-left: 2mm;
                    margin-bottom: 5mm; 
                    margin-right: 2mm
                }
              }
    
             </style>
             <link rel="stylesheet" href="' . base_url('') . 'dist/css/arom.css">
          </head><body>
          <script>
            function printSection() {
                var printContent = document.getElementById("print-section").innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
            }
            </script>
        <style type="text/css">
		.arm .inspection a {
			color: inherit;
		}

    .arm .inspection .s10 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s19 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s16 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s20 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s8 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s23 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s0 {
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 25pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s22 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s6 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s12 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s1 {
        border-bottom: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 25pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s11 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s13 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s15 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s14 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s21 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s17 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s3 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 25pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s5 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s18 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s2 {
        border-bottom: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s4 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 25pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s7 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        //white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .arm .inspection .s9 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }
</style>
<div>
<button class="print-button" onclick="printSection()"><span class="print-icon"></span></button>
    </div>
<br>
<div id="print-section">
<div class="arm grid-container" dir="ltr"">
    <table class="inspection" cellspacing="0" cellpadding="0" border="1">
        <thead>
        </thead>
        <tbody>
            <tr style="height: 49px">
				<td class="s4" dir="ltr" colspan="12" style="font-family:Arial; font-size:25pt;text-align:center;font-weight:bold;">PRE-DESPATCH INSPECTION REPORT</td>
                <td class="s5" dir="ltr" colspan="3"><b>FORMAT NO: <span style="font-weight:normal;"></b>' . $this->getPDIFormat() . '</span></td>
            </tr>
            <tr style="height: 31px">
                <td class="s7" dir="ltr" colspan="2"><b>CUSTOMER</b></td>
                <td class="s8" dir="ltr" colspan="3">' . $sales_data[0]->customer_name . '</td>
                <td class="s7" dir="ltr" colspan="5"><b>SUPPLIER:</b> <span style="font-weight:normal;">' .
            $client_data[0]->client_name . '</span></td>
                <td class="s7" dir="ltr" colspan="2"><b>VENDOR CODE:</b> <span style="font-weight:normal;">' . $sales_data[0]->vendor_code . '</span></td>
                <td class="s5" dir="ltr" colspan="3"><b>REV NO:</b> <span style="font-weight:normal;">' . $this->getPDIRev() . '</span></td>
            </tr>
            <tr style="height: 31px">
                <td class="s7" dir="ltr" colspan="2">PART NAME</td>
                <td class="s9" dir="ltr" colspan="3">' . $sales_data[0]->part_description . '</td>
                <td class="s7" dir="ltr" colspan="7">SUPPLIER ADDRESS: <span style="font-weight:normal;">' . $client_data[0]->address1 . '</span></td>
                <td class="s5" dir="ltr" colspan="3">REV DATE: <span style="font-weight:normal;">' . $this->getPDIRevDate() . '</span></td>
            </tr>
            <tr style="height: 31px">
                <td class="s7" dir="ltr" colspan="2"><b>PART NUMBER</b></td>
                <td class="s8" dir="ltr" colspan="2">' . $sales_data[0]->part_number . '</td>
                <td class="s10" dir="ltr" colspan="5"><b>SUPPLIER INVOICE DETAILS</b></td>
                <td class="s11" dir="ltr" colspan="6"><b>CUSTOMER GIN DETAILS</b></td>
            </tr>
            <tr style="height: 31px">
                <td class="s7" dir="ltr" colspan="2"><b>REV NO/DATE</b></td>
                <td class="s8" dir="ltr" colspan="2">' . $drawing[0]->revision_no .' '.$drawing[0]->revision_date.'</td>
                <td class="s10" dir="ltr" colspan="2"><b>INVOICE NO</b></td>
                <td class="s10" dir="ltr" colspan="2"><b>INVOICE DATE</b></td>
                <td class="s10" dir="ltr"><b>QTY</b></td>
                <td class="s10" dir="ltr" colspan="5"><b>GIN NUMBER</b></td>
                <td class="s11" dir="ltr" colspan="2"><b>GIN DATE</b></td>
            </tr>
            <tr style="height: 31px">
                <td class="s12" dir="ltr" colspan="2"><b>Batch Number</b></td>
                <td class="s13" dir="ltr" colspan="2">' . ' ' . '</td>
                <td class="s14" dir="ltr" colspan="2">' . $sales_data[0]->sales_number . '</td>
                <td class="s14" dir="ltr" colspan="2">' . $sales_data[0]->created_date . '</td>
                <td class="s14" dir="ltr">' . $sales_data[0]->quantity . '</td>
                <td class="s15" dir="ltr" colspan="5"></td>
                <td class="s16" colspan="2"></td>
            </tr>
            <tr style="height: 31px">
                <td class="s18" dir="ltr" rowspan="2"><b>SR NO</b></td>
                <td class="s18" dir="ltr" rowspan="2"><b>PARAMETERS</b></td>
                <td class="s18" dir="ltr" rowspan="2"><b>SPECIFICATION</b></td>
                <td class="s18" dir="ltr" rowspan="2"><b>INSPECTION METHOD</b></td>
                <td class="s18" dir="ltr" colspan="5"><b>SUPPLIER OBSERVATIONS</b></td>
                <td class="s18" dir="ltr" colspan="5"><b>CUSTOMER OBSERVATIONS</b></td>
                <td class="s18" dir="ltr"><b>Remark</b></td>
            </tr>
			<tr style="height: 19px">
                <td class="s18" dir="ltr">&nbsp;&nbsp;1&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;2&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;3&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;4&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;5&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;1&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;2&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;3&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;4&nbsp;&nbsp;</td>
                <td class="s18" dir="ltr">&nbsp;&nbsp;5&nbsp;&nbsp;</td>
                <td class="s19"></td>
            </tr>';

        if ($PDIData) {
            $i = 1;
            foreach ($PDIData as $data) {
                $html_content_data .= '
            <tr style="height: 28px">
                <td class="s8" dir="ltr">' . $i . '</td>
                <td class="s9" dir="ltr">' . $data->parameter . '</td>
                <td class="s8" dir="ltr">' . $data->specification . '</td>
                <td class="s21" dir="ltr">' . $data->evalution_mesaurement_technique . '</td>
                <td class="s8" dir="ltr">' . $data->observation1 . '</td>
                <td class="s8" dir="ltr">' . $data->observation2 . '</td>
                <td class="s8" dir="ltr">' . $data->observation3 . '</td>
                <td class="s8" dir="ltr">' . $data->observation4 . '</td>
                <td class="s21" dir="ltr">' . $data->observation5 . '</td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s22" dir="ltr">'.$data->remark.'</td>
            </tr>
            ';
                $i++;
            }
        }

        $html_content_data .= '
		<tr style="height: 28px">
                <td class="s8" ></td>
                <td class="s9" ></td>
                <td class="s8" dir="ltr"></td>
                <td class="s21" dir="ltr"></td>
                <td class="s8" dir="ltr"></td>
                <td class="s8" dir="ltr"></td>
                <td class="s8" dir="ltr"></td>
                <td class="s8" dir="ltr"></td>
                <td class="s21" dir="ltr"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s8"></td>
                <td class="s22" dir="ltr"></td>
            </tr>
			</tbody>';

        $html_content_footer = '
		<tfoot>
            <tr style="height: 19px">
                <td class="s11" style="padding-bottom:30px; text-align:left;"  dir="ltr" colspan="7"><b>SUPPLIER REMARK</b>: <br></td>
                <td class="s11" style="padding-bottom:30px; text-align:left;"  dir="ltr" colspan="8"><b>CUSTOMER REMARK</b>: <br></td>
            </tr>
            <tr style="height: 28px">
                <td class="s5" style="padding-bottom:20px;" dir="ltr" height="40px" colspan="7"><b>ACCEPTED / REJECTED / CONDITIONALLY ACCEPTED:</b> <span style="font-style:italic">&nbsp;&nbsp;Accepted</span></td>
                <td class="s5" style="padding-bottom:20px;" dir="ltr"height="40px"  colspan="8"><b>ACCEPTED / REJECTED / CONDITIONALLY ACCEPTED:</b> </td>
            </tr>
            <tr style="height: 24px">
                <td class="s8" style="padding-bottom:20px;" colspan="2"></td>
                <td class="s8" style="padding-bottom:20px;" colspan="2"></td>
                <td class="s21"style="padding-bottom:20px;" colspan="3"></td>
                <td class="s8" style="padding-bottom:20px;" colspan="2"></td>
                <td class="s8" style="padding-bottom:20px;" colspan="3"></td>
                <td class="s21" style="padding-bottom:20px;"colspan="3"></td>
            </tr>
            <tr style="height: 19px">
                <td class="s15" dir="ltr" colspan="2"><b>DATE</b></td>
                <td class="s15" dir="ltr" colspan="2"><b>INSPECTOR</b></td>
                <td class="s18" dir="ltr" colspan="3"><b>QA INCHARGE</b></td>
                <td class="s15" dir="ltr" colspan="2"><b>DATE</b></td>
                <td class="s15" dir="ltr" colspan="3"><b>INSPECTOR</b></td>
                <td class="s18" dir="ltr" colspan="3"><b>QA INCHARGE</b></td>
            </tr>
		<tfoot>
    </table>
	<table cellspacing="0" cellpadding="0" border="0">	
		<tfoot>
				<tr>
                <td colspan="15" style="font-size:small; padding-top:5px;border: 0px solid black;" >
					&nbsp;&nbsp; Note: This is a computer-generated document. No signature is required.
				</td>
        </tr>
		</tfoot>
	</table>
	</div>
    </div>';

        $html_content = $html_content_header . $html_content_data . $html_content_footer;
        echo $html_content;
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();

        //$this->pdf->stream("PDI-".$sales_data[0]->part_number, array("Attachment" => 1));

    }
}
