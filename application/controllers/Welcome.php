<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class Welcome extends CommonController
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');

        $this->user_name = $this->session->userdata('user_name');
        $this->user_id = $this->session->userdata('user_id');
        $this->current_date = date('d-m-Y');
        $this->current_time = date('h:i:s');

        $date = new DateTime($this->current_date);

        $date->modify('-1 day');
        $this->yesterday_date = $date->format('d-m-Y');
        $this->yesterday_date_new = $date->format('Y-m-d');
        $d = date_parse_from_format("d-m-Y", $this->current_date);
        $this->date = $d["day"];
        $this->month = $d["month"];
        $this->year = $d["year"];
        $this->load->model('InhouseParts');
        $this->load->model('SupplierParts');
        $this->load->model('CustomerPart');
        $this->load->model("welcome_model");
        $this->load->model("crud");
    }
    public function test_tpl(){

        $data["test"] = "ok";

        $this->smarty->view("test.tpl",$data);
    }
    private function getPage($viewPage, $viewData)
    {
        //$this->loadView($this->getPath().$viewPage,$viewData);
        $this->loadView($viewPage, $viewData);
    }

    public function reports_po_balance_qty()

    {
        checkGroupAccess("reports_po_balance_qty","list","Yes");
        $created_month  = $this->input->post("created_month");
        $created_year  = $this->input->post("created_year");

        if (empty($created_year)) {
            $created_year = $this->year;
        }

        if (empty($created_month)) {
            $created_month = $this->month;
        }

        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier name",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part No",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "po_number",
            "title" => "PO Number",
            "width" => "10%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "created_date",
            "title" => "Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "expiry_po_date",
            "title" => "Expiry Date",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "Qty",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "received_qty",
            "title" => "Received Qty",
            "width" => "17%",
            "className" => "dt-center",

        ];

        $column[] = [
            "data" => "pending_qty",
            "title" => "Balance Qty",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "po_id",
            "title" => "PO ID",
            "width" => "7%",
            "className" => "dt-center",
            "visible" => false
        ];

        $data['created_year'] = $created_year;
        $data['created_month'] = $created_month;

        $data['title'] = "PO Summary Report";

        for ($i = 1; $i <= 12; $i++) {
            $data['month_data'][$i] = $this->Common_admin_model->get_month($i);
            $data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
        }
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
        $data["sorting_column"] = json_encode([[10, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        // $this->load->view('header.php',$data);
        // $this->load->view('reports_po_balance_qty.php', $data);
        // $this->load->view('footer.php');
        $this->loadView('reports/reports_po_balance_qty',$data);

    }

    public function reportPoBalanceData(){
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

        $data = $this->SupplierParts->getPoRepotData($condition_arr,$post_data["search"]);



        foreach ($data as $key => $value) {
            $data[$key]['received_qty'] = $value['qty'] - $value['pending_qty'];
            $data[$key]['created_date'] =defaultDateFormat($value['created_date']);
            $data[$key]['expiry_po_date'] =  defaultDateFormat($value['expiry_po_date']);
            $dateToCheck = strtotime($value['expiry_po_date']);
            $currentDate = time();
           
            if ($dateToCheck < $currentDate) {
                $data[$key]['status'] = "expired";
            }

        }

        
        $data["data"] = $data;
        $total_record = $this->SupplierParts->getPoRepotDataCount([], $post_data["search"]);

        $data["recordsTotal"] = count($total_record);
        $data["recordsFiltered"] = count($total_record);
        echo json_encode($data);
    }

    public function filter_date($first_date, $second_date, $table, $column)
    {
        $this->db->where("$column >=", $first_date);
        $this->db->where("$column <=", $second_date);
        return $this->db->get($table)->result();
    }

    public function reports_inspection()
    {
        checkGroupAccess("reports_inspection","list","Yes");
        $created_month  = $this->input->post("created_month");
        $created_year  = $this->input->post("created_year");

        for ($i = 1; $i <= 12; $i++) {

            $data['month_data'][$i] = $this->Common_admin_model->get_month($i);
            $data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
        }
        if (empty($created_year)) {
            $created_year = $this->year;
        }
        if (empty($created_month)) {
            $created_month = $this->month;
        }


        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier name",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part No",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "grn_number_val",
            "title" => "GRN No",
            "width" => "10%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "po_date",
            "title" => "GRN Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "Received QTY",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "verified_qty",
            "title" => "Validation QTY",
            "width" => "7%",
            "className" => "dt-center",
        ];


        // $role_management_data = $this->db->query("SELECT * FROM `grn_details` grn
        // INNER JOIN new_po po ON po.id = grn.po_number
        // WHERE po.clientId = ".$this->Unit->getSessionClientId()."
        // AND grn.created_month = " . $created_month . " AND grn.created_year = " . $created_year . " ORDER BY grn.id DESC ");
        // $data['grn_details'] = $role_management_data->result();
        // // pr($data,1);
        // if ($data['grn_details']) {
        //  foreach ($data['grn_details'] as $g) {
        //      $data['new_po'][$g->id] = $this->Crud->get_data_by_id("new_po", $g->po_number, "id");
        //      $data['inwarding'][$g->id] = $this->Crud->get_data_by_id("inwarding", $g->inwarding_id, "id");
        //      $data['supplier_data'][$g->id] = $this->Crud->get_data_by_id("supplier", $new_po[0]->supplier_id, "id");
        //      $data['child_part_data'][$g->id] = $this->Crud->get_data_by_id("child_part", $g->part_id, "id");
        //      $data['data_old'][$g->id] = array(
        //          'po_id' => $new_po[0]->id,
        //          'part_id' => $g->part_id,

        //      );

        //      $po_parts[$g->id] = $this->Common_admin_model->get_data_by_id_multiple_condition("po_parts", $data_old[$g->id]);
        //  }
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
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data['created_year'] = $created_year;
        $data['created_month'] = $created_month;
        // echo 'SELECT * FROM `po_parts` WHERE  created_date >= '.$from_date.' AND  created_date <= '.$to_date.'';
        // $this->load->view('header.php');
        // $this->load->view('reports_inspection.php', $data);
        // $this->load->view('footer.php');
        $this->loadView('reports/reports_inspection',$data);
    }


    public function getInspectionReportData(){
        $customer_part_id  = $this->input->post("customer_part_id");
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

        $data = $this->SupplierParts->getInspectionsReportView($condition_arr,$post_data["search"]);
        // pr($data,1);

        foreach ($data as $key => $value) {
            $data[$key]['po_date'] = defaultDateFormat($value['po_date']);
            $inwarding = $this->Crud->get_data_by_id("inwarding", $value['inwarding_id'], "id");
            // if($inwarding[0]->status != "validate_grn"){
            //     $data[$key]['verified_qty'] = 0;
            // }
            // $data[$key]['grn_number_val'] = $inwarding[0]->grn_number;
        }

        $data["data"] = $data;
        $total_record = $this->SupplierParts->getInspectionsReportViewCount($condition_arr, $post_data["search"]);

        $data["recordsTotal"] = $total_record['tot_record'];
        $data["recordsFiltered"] = $total_record['tot_record'];
        echo json_encode($data);
    }

    public function pei_chart_sales_values_in_rs()
    {

        $selected_year  = strtotime($this->input->post("selected_year"));



        if (empty($selected_year)) {
            $selected_year = $this->year;
        }


        $data['selected_year']  = $selected_year;
        $series = [];
        for ($i = 1; $i <= 12; $i++) {

            $month_data = $this->Common_admin_model->get_month($i);
            $month_number = $this->Common_admin_model->get_month_number($month_data);

            /* $main_sum = $this->db->query(
                'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
            );
            */


            $main_sum = $this->db->query('SELECT SUM(parts.total_rate) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND parts.created_month = ' . $month_number . ' AND parts.created_year = "' . $selected_year . '" ');


            $main_sum_result = $main_sum->result();
            $month_value = 0;
            $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM : 0;
            // echo $month_data . "<br>";
            $str =  [$month_data ,$month_value];
            $series [] = $str;

        }
        $data['series'] = json_encode($series);
        $this->getPage('reports/pei_chart_sales_values_in_rs',$data);
        // $this->load->view('header.php');
        // $this->load->view('pei_chart_sales_values_in_rs.php', $data);
        // $this->load->view('footer.php');
    }
    public function reports_incoming_quality()
    {
        checkGroupAccess("reports_incoming_quality","list","Yes");
        // $from_date_convert  = strtotime($this->input->post("from_date"));
        // $from_date = date("d-m-Y", $from_date_convert);
        // $to_date_convert  = strtotime($this->input->post("to_date"));
        // $to_date = date("d-m-Y", $to_date_convert);


        // if (empty($this->input->post("from_date"))) {

        //  $role_management_data = $this->db->query('SELECT * FROM `grn_details` LIMIT 20');
        //  $data['grn_details'] = $role_management_data->result();
        // } else {
        //  // echo "btee";

        //  $data['from_date'] = $this->input->post("from_date");
        //  // echo "<br>";
        //  $data['to_date'] = $this->input->post("to_date");
        //  $role_management_data = $this->db->query('SELECT * FROM `grn_details` WHERE  created_date >= "' . $from_date . '" AND  created_date <= "' . $to_date . '" ');
        //  $data['grn_details'] = $role_management_data->result();
        // }
        $created_month  = $this->input->post("created_month");
        $created_year  = $this->input->post("created_year");

        if (empty($created_year)) {
            $created_year = $this->year;
        }
        if (empty($created_month)) {
            $created_month = $this->month;
        }

        // $role_management_data = $this->db->query('SELECT * FROM `grn_details` WHERE created_month = ' . $created_month . ' AND created_year = ' . $created_year . ' ORDER BY id DESC ');
        // $data['grn_details'] = $role_management_data->result();

        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier name",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part No",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "grn_number",
            "title" => "GRN No",
            "width" => "10%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "created_date",
            "title" => "GRN Date",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "grn_qty",
            "title" => "Received Qty",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "verified_qty",
            "title" => "Validation QTY",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "accept_qty",
            "title" => "Accepted QTY",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "reject_qty",
            "title" => "Rejected QTY",
            "width" => "17%",
            "className" => "dt-center",

        ];

        $column[] = [
            "data" => "remark",
            "title" => "Rejection Remark",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "id_val",
            "title" => "Id",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false,
            "visible" => false
        ];




        $data['created_month'] = $created_month;
        $data['created_year'] = $created_year;
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
        $data["sorting_column"] = json_encode([[10, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();

        // $data['grn_details'] = $this->Crud->customQuery("SELECT * FROM `grn_details` grn
        // INNER JOIN new_po po ON po.id = grn.po_number
        // WHERE po.clientId = ".$this->Unit->getSessionClientId()." AND grn.created_month = " . $created_month . "
        // AND grn.created_year = " . $created_year . " ORDER BY grn.id DESC ");
        // $data['created_year'] = $created_year;
        // $data['created_month'] = $created_month;

        for ($i = 1; $i <= 12; $i++) {
            $data['month_data'][$i] = $this->Common_admin_model->get_month($i);
            $data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
        }
        foreach ($data['customer_part'] as $c) {
            if (true) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                $data['customer'][$c->id] = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
            }
        }
        // if ($data['grn_details']) {
        //  foreach ($data['grn_details'] as $g) {
        //      $data['new_po'][$g->id] = $this->Crud->get_data_by_id("new_po", $g->po_number, "id");
        //      $data['inwarding'][$g->inwarding_id] = $this->Crud->get_data_by_id("inwarding", $g->inwarding_id, "id");
        //      $data['supplier_data'][$g->supplier_id] = $this->Crud->get_data_by_id("supplier", $new_po[0]->supplier_id, "id");
        //      $data['child_part_data'][$g->part_id] = $this->Crud->get_data_by_id("child_part", $g->part_id, "id");
        //      $data['data_old'][$g->id] = array(
        //          'po_id' => $new_po[0]->id,
        //          'part_id' => $g->part_id,

        //      );

        //      $po_parts[$g->id] = $this->Common_admin_model->get_data_by_id_multiple_condition("po_parts", $data_old[$g->id]);
        //  }
        // }
        // pr($data['child_part_data'],1);
        // echo 'SELECT * FROM `po_parts` WHERE  created_date >= '.$from_date.' AND  created_date <= '.$to_date.'';
        // $this->load->view('header.php');
        // $this->load->view('reports_incoming_quality.php', $data);
        // $this->load->view('footer.php');
        $this->loadView('reports/reports_incoming_quality',$data);
    }


    public function getIncomegQtyReportData(){

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

        $data = $this->SupplierParts->getIncomeReportView($condition_arr,$post_data["search"]);
        foreach ($data as $key => $value) {
            if($value['status'] != "accept"){
                $data[$key]['accept_qty'] = 0;
                $data[$key]['reject_qty'] = 0;
            }
            $data[$key]['created_date'] = defaultDateFormat($value['created_date']);
        }
        $data["data"] = $data;
        $total_record = $this->SupplierParts->getIncomeReportViewCount($condition_arr, $post_data["search"]);
        $data["recordsTotal"] = $total_record['tot_records'];
        $data["recordsFiltered"] = $total_record['tot_records'];
        echo json_encode($data);
    }


    public function view_history_operation_parts()
    {
        $part_no = $this->uri->segment('2');
        $operation_id = $this->uri->segment('3');

        $data_old = array(
            'part_id' => $part_no,
            'operation_id' => $operation_id,

        );

        $data['part_operations'] = $this->Common_admin_model->get_data_by_id_multiple_condition("part_operations", $data_old);
        // $data['part_creation'] = $this->Common_admin_model->get_all_data("part_creation");
        // $data['part_creation'] = $this->Common_admin_model->get_data_by_id("part_creation",$part_no,"part_number");
        // print_r(($data['part_operations']));
        // $data['sub_group'] = $this->Common_admin_model->get_all_data("sub_group");
        // $data['groups'] = $this->Common_admin_model->get_all_data("groups");
        // $data['size'] = $this->Common_admin_model->get_all_data("size");
        // $data['operations'] = $this->Common_admin_model->get_all_data("operations");
        // $data['parts_type'] = $this->Common_admin_model->get_all_data("parts_type");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `part_creation` ');
        // $data['part_creation_revision'] = $role_management_data->result();
        // print_r($data['orders']);
        $this->load->view('header.php');
        $this->load->view('view_history_operation_parts.php', $data);

        // part_stocks
    }
    public function view_job_card_prod_qty_by_id()
    {
        $job_card_id = $this->uri->segment('2');
        $data['job_card_details_data'] = $this->Crud->get_data_by_id("job_card_details", $job_card_id, "job_card_id");
        $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        $data['job_card_prod_qty'] = $this->Crud->get_data_by_id("job_card_prod_qty", $job_card_id, "job_card_id");
        $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
        $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
        $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
        $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
        $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
        $data['bom_data'] = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");


        $data_old = array(
            'job_card_id' => $job_card_id,
            // 'operation_id' => $operation_id,

        );

        $data['job_card_prod_qty'] = $this->Common_admin_model->get_data_by_id_multiple_condition("job_card_prod_qty", $data_old);
        // $data['part_creation'] = $this->Common_admin_model->get_all_data("part_creation");
        // $data['part_creation'] = $this->Common_admin_model->get_data_by_id("part_creation",$part_no,"part_number");
        // print_r(($data['part_operations']));
        // $data['sub_group'] = $this->Common_admin_model->get_all_data("sub_group");
        // $data['groups'] = $this->Common_admin_model->get_all_data("groups");
        // $data['size'] = $this->Common_admin_model->get_all_data("size");
        // $data['operations'] = $this->Common_admin_model->get_all_data("operations");
        // $data['parts_type'] = $this->Common_admin_model->get_all_data("parts_type");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `part_creation` ');
        // $data['part_creation_revision'] = $role_management_data->result();
        // print_r($data['orders']);
        $this->load->view('header.php');
        $this->load->view('view_job_card_prod_qty_by_id.php', $data);
        $this->load->view('footer.php');

        // part_stocks
    }


    public function pdfg()
    {
        // $this->load->library('pdf');
        $html = $this->load->view('GeneratePdfView');
        $this->pdf->createPDF($html, 'mypdf', false);
    }

    public function contractor()
    {
        $data['contractor'] = $this->Crud->read_data("contractor");
        $this->load->view('header');
        $this->load->view('contractor', $data);
        $this->load->view('footer');
    }

    public function consumable()
    {
        $data['part_list'] = $this->Crud->read_data("consumable_item");
        $this->load->view('header');
        $this->load->view('consumable', $data);
        $this->load->view('footer');
    }


    public function hus_number()
    {
        $data['other_data'] = $this->Crud->get_data_by_id("other_data", "hus", "type");
        $this->load->view('header');
        $this->load->view('hus_number', $data);
        $this->load->view('footer');
    }

    public function store()
    {
        $data['store_list'] = $this->Crud->read_data("store");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['part_list'] = $this->Crud->read_data("consumable_item");
        $this->load->view('header');
        $this->load->view('store', $data);
        $this->load->view('footer');
    }
    public function issue()
    {
        $data['issue_list'] = $this->Crud->read_data("issue");
        $data['part_list'] = $this->Crud->read_data("consumable_item");

        $data['hus1'] = $this->Crud->get_data_by_id("other_data", "hus", "type");


        $data['oc1'] = $this->Crud->get_data_by_id("other_data", "oc", "type");
        $data['wbs1'] = $this->Crud->get_data_by_id("other_data", "wbs", "type");

        $data['contractor_new'] = $this->Crud->read_data("contractor");
        $this->load->view('header');
        $this->load->view('issue', $data);
        $this->load->view('footer');
    }
    public function oc_number()
    {
        $data['other_data'] = $this->Crud->get_data_by_id("other_data", "oc", "type");
        $this->load->view('header');
        $this->load->view('oc_number', $data);
        $this->load->view('footer');
    }
    public function wbs_number()
    {
        $data['other_data'] = $this->Crud->get_data_by_id("other_data", "wbs", "type");
        $this->load->view('header');
        $this->load->view('wbs_number', $data);
        $this->load->view('footer');
    }

    public function addSupplierDetails()
    {
        $get_data = $this->input->get();
        $mode ="Add";
        if(isset($get_data['id'])){
            if($get_data['id'] >0){
                $mode = "Update";
                $data = $this->welcome_model->get_supplier_details($get_data['id']);
                checkGroupAccess("approved_supplier","update","Yes");
            }

        }else{
            checkGroupAccess("approved_supplier","add","Yes");
        }
        $data['mode'] = $mode;
        // pr($data,1);
        $this->loadView('purchase/add_update_supplier', $data);
    }
    public function supplier()
    {
        checkGroupAccess("supplier","list","Yes");
        $supplier_list = $this->Crud->read_data_where_result("supplier", array("admin_approve" => "pending"));
        $data['supplier_list'] = $supplier_list->result();
        // $data['supplier_list'] = $this->Crud->read_data_with_admin("supplier");
        // $this->load->view('header');
        // $this->load->view('supplier', $data);
        // $this->load->view('footer');
        $this->loadView('purchase/supplier', $data);
    }

    // public function approved_supplier()
    // {

    //  $supplier_list = $this->Crud->read_data_where_result("supplier", array("admin_approve" => "accept"));
    //  $data['supplier_list'] = $supplier_list->result();
    //  $this->load->view('header');
    //  $this->load->view('approved_supplier', $data);
    //  $this->load->view('footer');
    // }

    public function po_details()
    {
        $data['customers'] = $this->Crud->read_data("customer");
        $data['po_details']  = $this->Crud->read_data("po_details");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['customer_name'] = $this->Crud->get_data_by_id("customer");


        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('po_details', $data);
        $this->load->view('footer');
    }

    public function loading_user()
    {
        $data['customers'] = $this->Crud->read_data("customer");
        $data['po_details']  = $this->Crud->read_data("po_details");

        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['customer_name'] = $this->Crud->get_data_by_id("customer");



        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('loading_user', $data);
        $this->load->view('footer');
    }

    public function dispatch_tracking()
    {
        $data['c_po_so'] = $this->Crud->read_data("c_po_so");
        $data['dispatch_tracking']  = $this->Crud->read_data("dispatch_tracking");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['customer_name'] = $this->Crud->get_data_by_id("customer");



        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('dispatch_tracking', $data);
        $this->load->view('footer');
    }
    public function billing_track()
    {
        $data['c_po_so_details'] = $this->Crud->read_data("c_po_so");
        $data['bill_tracking_details']  = $this->Crud->read_data("bill_tracking");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['customer_name'] = $this->Crud->get_data_by_id("customer");



        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('billing_track', $data);
        $this->load->view('footer');
    }
    public function subcon_po_inwarding_history()
    {
        $subcon_po_inwarding_history_id = $this->uri->segment('2');
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        $subcon_po_inwarding_history = $this->Crud->get_data_by_id("subcon_po_inwarding_history", $subcon_po_inwarding_history_id, 'subcon_po_inwarding_parts_id');
        foreach ($subcon_po_inwarding_history as $key=> $p) {
            $challan_data = $this->Crud->get_data_by_id("challan", $p->challan_id, "id");
            $subcon_po_inwarding_history[$key]->challan_data = $challan_data[0];
            
        }
        $data['subcon_po_inwarding_history'] = $subcon_po_inwarding_history;

        // $this->load->view('header');
        $this->loadView('store/subcon_po_inwarding_history', $data);
        // $this->load->view('footer');
    }
    public function billing()
    {
        $data['c_po_so_details'] = $this->Crud->read_data("c_po_so");
        $data['bill_tracking_details']  = $this->Crud->read_data("bill_tracking");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['customer_name'] = $this->Crud->get_data_by_id("customer");



        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('billing', $data);
        $this->load->view('footer');
    }

    public function customer()
    {
        checkGroupAccess("customer","list","Yes");
        $data['customers'] = $this->Crud->read_data("customer");
        // pr($this->db->last_query(),1);
        // $this->load->view('header');
        // $this->load->view('customer', $data);
        // $this->load->view('footer');
        foreach ($data['customers'] as $key => $val) {
            
            $data['customers'][$key]->encode_data = base64_encode(json_encode($val));
        }
        // pr($data,1);
        $data['currentUnit'] = $this->Unit->getNoOfClients();
        $this->loadView('customer/customer',$data);
    }
    public function customer_master()
    {
        checkGroupAccess("customer_master","list","Yes");
        $data['customers'] = $this->Crud->read_data("customer");

        $data['export_message'] = "";
        if($this->session->userdata('export_message') != "" && $this->session->userdata('export_message') != null){
            $data['export_message'] = $this->session->userdata('export_message');
            $this->session->set_userdata('export_message',"");
        }
        
        $data['entitlements'] = $this->session->userdata('entitlements');
        $this->loadView('customer/customer_master', $data);
    }
    public function inwarding1()
    {
        $current_date = date('Y-m-d');
        $data['new_po'] = $this->Crud->customQuery("SELECT p.*,s.supplier_name FROM `new_po` p
            INNER JOIN supplier s ON s.id = p.supplier_id
            WHERE p.clientId =".$this->Unit->getSessionClientId()."
            AND p.status in ('accept')
            AND p.expiry_po_date >=".$current_date." order by p.id desc");

        // $this->load->view('header');
        $this->loadView('store/inwarding', $data);
        // $this->load->view('footer');
    }
    public function inwarding()
    {
        checkGroupAccess("inwarding","list","Yes");
        /* datatable */
        $column[] = [
            "data" => "id",
            "title" => "Id",
            "width" => "7%",
            "className" => "dt-center",
            "visible" => false
        ];
        $column[] = [
            "data" => "po_number",
            "title" => "PO Number",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier Name",
            "width" => "20%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "po_date",
            "title" => "PO Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "created_date",
            "title" => "Created Date",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "expiry_po_date",
            "title" => "Expiry PO Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "download_po",
            "title" => "Download PDF PO",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Close PO",
            "width" => "100px",
            "className" => "dt-center",
        ];
        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Part GRN data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[0, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $date_filter = date("Y/m/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
        // $ajax_json['teacher_data'] = $this->session->userdata();
        // pr($ajax_json['designation'],1);
        $this->loadView('store/inwarding', $data,"Yes","Yes");
        // $this->getPage('purchase/test', $data,"NO","NO");
    }
    public function get_inwarding_view()
    {
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
        
        $data = $this->welcome_model->get_inwarding_view_data(
            $condition_arr,
            $post_data["search"]
        );
        // pr($data,1);

        foreach ($data as $key => $value) {
            // $edit_data = base64_encode(json_encode($value)); 
            $data[$key]['po_number'] = '<a href="'.base_url().'inwarding_invoice/'.$value['id'].'"  class="po-number">'.$value['po_number'].'</a>';
            $data[$key]['download_po'] = '<a href="'.base_url().'download_my_pdf/'.$value['id'].'" class="btn btn-primary">Download</a>';
            $data[$key]['po_date'] = defaultDateFormat($value['po_date']);
            $data[$key]['created_date'] = defaultDateFormat($value['created_date']);
            $data[$key]['expiry_po_date'] = defaultDateFormat($value['expiry_po_date']);
            $data[$key]['action'] = display_no_character();
            if(checkGroupAccess("inwarding","update","No")){
                $data[$key]['action'] = '<a data-id="'.$value['id'].'" href="javascript:void(0)" class="btn btn-danger close-po">Close</a>';
            }
        }
        $data["data"] = $data;
        $total_record = $this->welcome_model->get_inwarding_view_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
        
    }

    
    public function grn_validation()
    {
        checkGroupAccess("grn_validation","list","Yes");
        $new_po_id = $this->uri->segment('2');
        $data['new_po_id'] = $this->uri->segment('2');
        $session_data = $this->session->userdata();
        $isMultiClient = $session_data['isMultipleClientUnits'];
        
        /* datatable */
        $column[] = [
            "data" => "id",
            "title" => "Id",
            "width" => "7%",
            "className" => "",
            "visible" => false
        ];
        $column[] = [
            "data" => "po_number",
            "title" => "PO Number",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier Name",
            "width" => "13%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "invoice_number",
            "title" => "Invoice Number",
            "width" => "12%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "invoice_date",
            "title" => "Invoice Date",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "grn_number",
            "title" => "GRN Number",
            "width" => "8%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "grn_date",
            "title" => "GRN Date",
            "width" => "8%",
            "className" => "dt-center",
        ];
        if($isMultiClient == true){
            $column[] = [
                "data" => "delivery_unit",
                "title" => "Delivery Unit",
                "width" => "7%",
                "className" => "dt-center",
            ];
        }
        $column[] = [
            "data" => "view_details",
            "title" => "View Details",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No GRN Validation data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[0, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        // $ajax_json['teacher_data'] = $this->session->userdata();
        // pr($ajax_json['designation'],1);
        // $this->getPage('purchase/child_part_view', $data,"Yes","Yes");
        $this->loadView('store/grn_validation', $data);
        // $this->getPage('purchase/test', $data,"NO","NO");
    }

    public function get_grn_validation_data()
    {
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
        $data = $this->welcome_model->get_grn_validation_view_data(
            $condition_arr,
            $post_data["search"]
        );
        
        foreach ($data as $key => $value) {
            $edit_data = base64_encode(json_encode($value)); 
            $data[$key]['view_details'] = display_no_character();
            if(checkGroupAccess("grn_validation","update","No")){
                 $data[$key]['view_details'] = '<a href="'.base_url("inwarding_details_validation/").$value['id'].'/'.$value['po_id'].'" class="btn btn-danger">Validation Details</a></td>';
            }
            $data[$key]['grn_date'] = defaultDateFormat($value['grn_date']);
            $data[$key]['invoice_date'] = defaultDateFormat($value['invoice_date']);
        }
        // pr($data,1);
        $data["data"] = $data;
        $total_record = $this->welcome_model->get_grn_validation_data_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
        
    }
    public function accept_reject_validation()
    {
        checkGroupAccess("accept_reject_validation","list","Yes");
        $new_po_id = $this->uri->segment('2');
        $data['new_po_id'] = $this->uri->segment('2');
        $data['inwarding_data'] = $this->Crud->customQuery("
            SELECT i.* ,np.po_number as po_number,s.supplier_name as supplier_name
            FROM inwarding as i
            LEFT JOIN new_po as np ON  np.id  = i.po_id
            LEFT JOIN supplier as s ON  s.id  = np.supplier_id
            WHERE i.delivery_unit = '".$this->Unit->getSessionClientUnitName()."'"." 
            ORDER BY i.id DESC");
        
        // pr($this->db->last_query());
        $data['isMultiClient'] = $this->session->userdata['isMultipleClientUnits'];
        // $this->load->view('header');
        $this->loadView('quality/accept_reject_validation', $data);
        // $this->load->view('footer');
    }
    public function inwarding_details()
    {
        $new_po_id = $this->uri->segment('3');
        $data['new_po_id'] = $new_po_id;
        $inwarding_id = $this->uri->segment('2');
        $data['inwarding_id'] =$inwarding_id;
        $arr = array(
            'id' => $inwarding_id
        );
        $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        if(count($inwarding_data) == 0){
            $forbidden_page = base_url("404_override");
            header("Location: $forbidden_page");
        }
        
        $data['inwarding_data'] = $inwarding_data;
        $data['invoice_number'] = $inwarding_data[0]->invoice_number;
        $invoice_amount = $inwarding_data[0]->invoice_amount;

        $new_po = $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
        $data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
        $data['uom'] = $this->Crud->read_data("uom");
        $arr = array(
            'supplier_id' => $data['supplier'][0]->id
        );
        $po_parts = $data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");

        /* for part wise discount */
        $part_wise_dicount = array_column($po_parts,"discount","id");
        /* for part wise discount */

        foreach ($data['po_parts'] as $key => $p) {
            $data_where = array(
                "child_part_id" => $p->part_id,
                "supplier_id" =>  $data['supplier'][0]->id );
            $child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data_where);
            $data['po_parts'][$key]->child_part_data = $child_part_data;
            // $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
            $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
            $data['po_parts'][$key]->uom_data = $uom_data;
            $arr = array(
                'inwarding_id' => $inwarding_id,
                'part_id' => $p->part_id,
                'po_number' => $new_po_id,
                'invoice_number' => $inwarding_data[0]->invoice_number
                );
            $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
            $data['po_parts'][$key]->grn_details_data = $grn_details_data;

            $subcon_po_inwarding_data = array(
                'po_id' => $p->po_id,
                'main_sub_con_part_id' => $p->part_id,
                "invoice_number" => $inwarding_data[0]->invoice_number
            );
            $subcon_po_inwarding_master = $this->Crud->get_data_by_id_multiple("subcon_po_inwarding", $subcon_po_inwarding_data);
            $data['po_parts'][$key]->subcon_po_inwarding_master = $subcon_po_inwarding_master;
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $child_part_data[0]->gst_id, "id");
            $data['po_parts'][$key]->gst_structure_data = $gst_structure_data;
        }

        $arr = array(
           'inwarding_id' => $inwarding_data[0]->id,
           'invoice_number' => $inwarding_data[0]->invoice_number,
       );
        
        $invoice_amount = $inwarding_data[0]->invoice_amount;
        $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
        $actual_price = 0;
        foreach ($grn_details_data as $g) {
            $actual_price = $actual_price + $g->inwarding_price;
        }
        // pr($actual_price,1);
        if($new_po[0]->po_discount_type == "PO Level"){
            $discount_amount = 0;
            if($new_po[0]->discount_type == "Number"){
                $discount_amount = $new_po[0]->discount;
            }else{
                $discount_amount = $actual_price*$new_po[0]->discount/100;
            }
            $actual_price -= $discount_amount;
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $po_parts[0]->tax_id, "id");
            if ((int) $gst_structure_data[0]->igst === 0) {
                $gst = (float) $gst_structure_data[0]->cgst + (float) $gst_structure_data[0]->sgst;
                $cgst = (float) $gst_structure_data[0]->cgst;
                $sgst = (float) $gst_structure_data[0]->sgst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = 0;
            } else {

                $gst = (float) $gst_structure_data[0]->igst;
                $cgst = 0;
                $sgst = 0;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = $gst;
            }
            $cgst_amount +=  (($actual_price * $cgst) / 100);
            $sgst_amount += (($actual_price * $sgst) / 100);
            $igst_amount += (($actual_price * $igst) / 100);
            if ($gst_structure_data[0]->tcs_on_tax == "no") {
                $tcs_amount += (($actual_price * $tcs) / 100);
            } else {
                //$tcs_amount =  $tcs_amount + ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);
                $tcs_amount +=  ((((float) (($actual_price * $cgst) / 100) + (float) (($actual_price * $sgst) / 100) + (float) $igst_amount + (float) $actual_price) * $tcs) / 100);
            }
            $actual_price = $actual_price + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;

        }
        
        if($actual_price < 0){
            $actual_price = $new_po[0]->final_amount;
        }else{
            $actual_price = $actual_price + $new_po[0]->final_amount;
        }
        

    
        // pr($actual_price,1);

       $minus_price = $actual_price - 1;
       $plus_price = $actual_price + 1;

       if ($actual_price != 0) {
           if ($invoice_amount >= $minus_price) {
               if ($invoice_amount <= $plus_price) {
                   $status = "verifed";
               } else {
                   $status = "not-verifed";
               }
           } else {
               $status = "not-verifed";
           }
       } else {
           $status = "not-verifed";
       }
       $data['actual_price'] = number_format($actual_price,2,".","");
       $data['minus_price'] = $minus_price;
       $data['plus_price'] = $plus_price;
       $data['status'] = $status;
          // pr($data['po_parts'],1);
       // pr($status,1);
        // $this->load->view('header');
        $this->loadView('store/inwarding_details', $data);
        // $this->load->view('footer');
    }

    public function add_grn_qty_subcon_view()
    {
        // echo "hello add_grn_qty_subcon_view";
        $invoice_number = $this->input->post('invoice_number');
        $data['child_part_id'] = $this->input->post('part_id');
        $data['invoice_number'] = $this->input->post('invoice_number');
        $new_po_id = $this->input->post('new_po_id');
        $data['new_po_id'] = $this->input->post('new_po_id');
        $inwarding_id = $this->input->post('inwarding_id');
        $data['inwarding_id'] = $this->input->post('inwarding_id');
        $data['po_part_id'] = $this->input->post('po_part_id');
        $data['qty'] = $this->input->post('qty');
        $data['part_id_new'] = $this->input->post('part_id_new');
        $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");

        $subcon_po_inwarding = array(
            'po_id' => $new_po_id,
            'po_number' => $data['new_po'][0]->po_number,
            'inwarding_qty' => $data['qty'],
            'main_sub_con_part_id' => $data['part_id_new'],
            'invoice_number' => $data['invoice_number']
        );

        $subcon_po_inwarding_data_new = array(
            'po_id' => $new_po_id,
            'main_sub_con_part_id' => $data['part_id_new'],
            'invoice_number' => $data['invoice_number'],
        );
        $success = 0;
        $messages = "Something went wrong";
        $data['subcon_po_inwarding_master'] = $this->Crud->get_data_by_id_multiple("subcon_po_inwarding", $subcon_po_inwarding_data_new);

        if ($data['subcon_po_inwarding_master']) {
        } else {
            $subcon_po_inwarding_insert = $this->Common_admin_model->insert('subcon_po_inwarding', $subcon_po_inwarding);

            $po_parts_array = array(
                'po_id' => $new_po_id,
                'part_id' => $data['part_id_new'],

            );
            $data['po_parts'] = $this->Crud->get_data_by_id_multiple("po_parts", $po_parts_array);

            if ($subcon_po_inwarding_insert) {
                if ($data['po_parts']) {
                    foreach ($data['po_parts'] as $r) {
                        $routing_data = $this->Crud->get_data_by_id("routing", $r->part_id, "part_id");
                        if ($routing_data) {
                            foreach ($routing_data as $rout) {
                                $new_qty = $data['qty'] * $rout->qty;
                                $subcon_po_inwarding_parts_insert = array(
                                    'subcon_po_inwarding_id' => $subcon_po_inwarding_insert,
                                    'inwarding_qty' => $data['qty'],
                                    'main_sub_con_part_id' => $data['part_id_new'],
                                    'input_part_id' => $rout->routing_part_id,
                                    'input_part_req_qty' => $new_qty,
                                );

                                $subcon_po_inwarding_parts_insert = $this->Common_admin_model->insert('subcon_po_inwarding_parts', $subcon_po_inwarding_parts_insert);
                            }
                            $success = 1;
                            $messages = "Added successfully";
                        } else {
                            $messages = "no Routing Found";
                            // echo "no Routing Found";
                        }
                    }
                }
            }
        }


        $return_arr['success']=$success;
        $return_arr['messages']=$messages;
        echo json_encode($return_arr);
        exit;
    }
    public function add_grn_qty_subcon_view_customer_challan()
    {
        $sales_parts_subcon_id = $this->uri->segment('2');

        $sales_parts_subcon = array(
            'id' => $sales_parts_subcon_id,

        );
        $data['sales_parts_subcon_data'] = $this->Crud->get_data_by_id_multiple("sales_parts_subcon", $sales_parts_subcon);

        $new_sales_subcon = array(
            'id' => $data['sales_parts_subcon_data'][0]->sales_id,

        );

        $data['new_sales_subcon_data'] = $this->Crud->get_data_by_id_multiple("new_sales_subcon", $new_sales_subcon);



        $this->load->view('header');
        $this->load->view('add_grn_qty_subcon_view_customer_challan', $data);
        $this->load->view('footer');
    }

    public function grn_subcon_view()
    {
        $data['child_part_id'] = $this->uri->segment('2');
        $new_po_id = $this->uri->segment('3');
        $inwarding_id = $this->uri->segment('4');
        $data['part_id_new'] = $this->uri->segment('5');

        $data['new_po_id'] = $new_po_id;
        $data['inwarding_id'] = $inwarding_id;
        $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
        $data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");

        $arr = array(
            'id' => $inwarding_id
        );

        $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        if(count($inwarding_data) == 0){
            $forbidden_page = base_url("404_override");
            header("Location: $forbidden_page");
        }
        $data['inwarding_data'] = $inwarding_data;
        $data['invoice_number'] = $inwarding_data[0]->invoice_number;

        $invoice_amount = $inwarding_data[0]->invoice_amount;
        $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);

        $data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['uom'] = $this->Crud->read_data("uom");
        $data['challan'] = $this->Crud->read_data("challan");
        $data['challan_number'] = $this->input->post('challan_number');
        $data['challan_data'] = $this->Crud->get_data_by_id("challan", $data['challan_number'], "id");

        $arr = array(
            'supplier_id' => $data['supplier'][0]->id
        );

        $data['child_part'] = $this->Crud->get_data_by_id_multiple("child_part_master", $arr);
        $subcon_po_inwarding_data = array(
            'po_id' => $new_po_id,
            'main_sub_con_part_id' => $data['part_id_new'],
            'invoice_number' => $data['invoice_number']
        );

        $data['subcon_po_inwarding_master'] = $subcon_po_inwarding_master= $this->Crud->get_data_by_id_multiple("subcon_po_inwarding", $subcon_po_inwarding_data);
        $po_parts_array = array(
            'po_id' => $new_po_id,
            'part_id' => $data['part_id_new']
        );
        $client_id = $this->Unit->getSessionClientId();
        $data['po_parts'] = $this->Crud->get_data_by_id_multiple("po_parts", $po_parts_array);
        $po_parts = $data['po_parts'];
        foreach ($po_parts as $key=>$p) {
            $child_part_data = $this->Crud->get_data_by_id("child_part_master", $p->part_id, "child_part_id");
            $po_parts[$key]->child_part_data = $child_part_data;
            $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
            $po_parts[$key]->uom_data = $uom_data;

            $arr = array('inwarding_id' => $inwarding_id, 'part_id' => $p->part_id, 'po_number' => $new_po_id, 'invoice_number' => $inwarding_data[0]->invoice_number,);
            $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
            if ($grn_details_data) {
                $data_present = "yes";
            }
            else {
                $data_present = "no";
            }
            $po_parts[$key]->data_present = $data_present;
            if($subcon_po_inwarding_master){
                $subcon_po_inwarding_parts = $this->Crud->get_data_by_id("subcon_po_inwarding_parts", $subcon_po_inwarding_master[0]->id, "subcon_po_inwarding_id");
                foreach ($subcon_po_inwarding_parts as $key_val=>$r) {
                    $child_part_new_new = $this->Crud->get_data_by_id("child_part", $r->input_part_id, "id");
                    $subcon_po_inwarding_parts[$key_val]->child_part_new_new = $child_part_new_new;
                    $challan_parts_array = array(
                        'part_id' => $r->child_part_new_new[0]->id,
                        'qty' => 1,
                    );
                    $role_management_data2 = $this->db->query('
                        SELECT * 
                        FROM `challan_parts` as cp 
                        JOIN  challan as c On cp.challan_id = c.id AND c.clientId = '.$client_id.'
                        WHERE cp.part_id = ' . $r->child_part_new_new[0]->id . ' AND cp.remaning_qty > 0 ');
                    $challan_parts_data = $role_management_data2->result();
                    foreach ($challan_parts_data as $key_v=>$ch_parts) {
                        $challan_parts_data[$key_v]->challan_data = $this->Crud->customQuery("
                            SELECT * FROM `challan` WHERE `id` = '".$ch_parts->challan_id." AND clientid = $client_id' ORDER BY `id` DESC");
 
                    }
                   

                    $subcon_po_inwarding_history = $this->Crud->customQuery("SELECT pi.* FROM subcon_po_inwarding_history pi WHERE pi.subcon_po_inwarding_parts_id = '".$r->id."' AND pi.invoice_number = '".$data['invoice_number']."'");

                    $subcon_po_inwarding_parts[$key_val]->selected_challan = $subcon_po_inwarding_history[0]->challan_id;
                    $subcon_po_inwarding_parts[$key_val]->challan_parts_data = $challan_parts_data;
                }
                $po_parts[$key]->subcon_po_inwarding_parts = $subcon_po_inwarding_parts;
            }

        }

          $arr = array(
          'inwarding_id' => $inwarding_data[0]->id,
          'invoice_number' => $inwarding_data[0]->invoice_number,
          );
          
          $invoice_amount = $inwarding_data[0]->invoice_amount;
          $grn_details_data_main = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
          
          $actual_price = 0;
          foreach ($grn_details_data_main as $g) {
              $actual_price = $actual_price + $g->inwarding_price;
          }
          
          // $cgst_amount = ($actual_price*$gst_structure[0]->cgst)/100;
          // $sgst_amount = ($actual_price*$gst_structure[0]->sgst)/100;
          // $igst_amount = ($actual_price*$gst_structure[0]->igst)/100;
          
          // $actual_price = $actual_price + $cgst_amount +$sgst_amount+$igst_amount;
          $minus_price = $actual_price - 1;
          $plus_price = $actual_price + 1;
          
          if ($actual_price != 0) {
              if ($invoice_amount >= $minus_price) {
                  if ($invoice_amount <= $plus_price) {
                      $status = "verifed";
                  } else {
                      $status = "not-verifed";
                  }
              } else {
                  $status = "not-verifed";
              }
          } else {
              $status = "not-verifed";
          }
        $data['status'] = $status;
        $data['po_parts'] = $po_parts;
        $data['actual_price'] = $actual_price;

        // $this->load->view('header');
        $this->loadView('store/add_grn_qty_subcon_view', $data);
        // $this->load->view('footer');
    }


    public function update_challan_parts_history_challan()
    {
        $invoice_number = $this->uri->segment('2');
        $data['child_part_id'] = $this->uri->segment('3');
        $data['invoice_number'] = $this->uri->segment('2');
        $new_po_id = $this->uri->segment('4');
        $data['new_po_id'] = $this->uri->segment('4');
        $inwarding_id = $this->uri->segment('5');
        $data['inwarding_id'] = $this->uri->segment('5');
        $data['part_id_new'] = $this->uri->segment('6');

        $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");


        // $subcon_po_inwarding = array(
        //  'po_id' => $new_po_id,
        //  'po_number' => $data['new_po'][0]->po_number,
        //  'inwarding_qty' => $data['qty'],
        //  'main_sub_con_part_id' => $data['part_id_new'],
        // );

        // $subcon_po_inwarding_insert = $this->Common_admin_model->insert('subcon_po_inwarding', $subcon_po_inwarding);
        $data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");
        $arr = array(
            'id' => $inwarding_id,

        );
        $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        $data['inwarding_data'] = $this->Crud->get_data_by_id_multiple("inwarding", $arr);

        $ar2 = array(
            'inwarding_id' => $inwarding_id,
            'invoice_number' => $invoice_number,

        );
        $invoice_amount = $inwarding_data[0]->invoice_amount;


        $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);


        $arr = array(
            'id' => $new_po_id,
            'invoice_number' => $invoice_number,

        );

        // $data['gst_structure'] = $this->Crud->get_data_by_id("gst_structure", $data['new_po'][0]->tax_id, "id");
        $data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['uom'] = $this->Crud->read_data("uom");
        $data['challan'] = $this->Crud->read_data("challan");
        $data['challan_number'] = $this->input->post('challan_number');
        $data['challan_data'] = $this->Crud->get_data_by_id("challan", $data['challan_number'], "id");


        $arr = array(
            'supplier_id' => $data['supplier'][0]->id,
        );
        $data['child_part'] = $this->Crud->get_data_by_id_multiple("child_part_master", $arr);
        $subcon_po_inwarding_data = array(
            'po_id' => $new_po_id,
            'main_sub_con_part_id' => $data['part_id_new'],

        );
        $data['subcon_po_inwarding_master'] = $this->Crud->get_data_by_id_multiple("subcon_po_inwarding", $subcon_po_inwarding_data);

        $arr3123123123 = array(
            'po_id' => $new_po_id,
            'invoice_number' => $invoice_number,

        );
        // $data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");
        $po_parts_array = array(
            'po_id' => $new_po_id,
            'part_id' => $data['part_id_new'],

        );
        $data['po_parts'] = $this->Crud->get_data_by_id_multiple("po_parts", $po_parts_array);
        // $data['po_parts'] = $this->Crud->get_data_by_id_multiple("po_parts", $arr);


        // print_r($subcon_po_inwarding_data);
        // print_r($data['subcon_po_inwarding_master']);
        $this->load->view('header');
        $this->load->view('add_grn_qty_subcon_view', $data);
        $this->load->view('footer');
    }

    public function inwarding_details_validation() {
        $new_po_id = $this->uri->segment('3');
        $data['new_po_id'] = $new_po_id;
        $inwarding_id = $this->uri->segment('2');
        $data['inwarding_id'] = $inwarding_id;
        $arr = array(
            'id' => $inwarding_id
        );

        $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        $data['inwarding_data'] = $inwarding_data;
        $data['invoice_number'] = $inwarding_data[0]->invoice_number;

        //$invoice_amount = $inwarding_data[0]->invoice_amount;

        //$grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
        $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
        // $data['gst_structure'] = $this->Crud->get_data_by_id("gst_structure", $data['new_po'][0]->tax_id, "id");
        $data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['uom'] = $this->Crud->read_data("uom");

        $arr = array(
            'supplier_id' => $data['supplier'][0]->id
        );

        $data['po_parts'] = $this->Crud->get_data_by_id("po_parts", $new_po_id, "po_id");

        foreach ($data['po_parts'] as $key => $p) {
            $child_part = $this->Crud->get_data_by_id("child_part", $p->part_id, "id");
            $data['po_parts'][$key]->child_part = $child_part;
            $child_part_data = $this->Crud->get_data_by_id("child_part_master", $p->part_id, "child_part_id");
            $data['po_parts'][$key]->child_part_data = $child_part_data;
            // $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
            $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
            $data['po_parts'][$key]->uom_data = $uom_data;

            $arr1 = array(
                'inwarding_id' => $inwarding_id,
                'part_id' => $p->part_id,
                'po_number' => $new_po_id,
                'invoice_number' => $inwarding_data[0]->invoice_number,
                //         'grn_number' => $inwarding_data[0]->grn_number,
            );
            $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr1);
            $data['po_parts'][$key]->grn_details_data = $grn_details_data;

            $arr2 = array(
                'supplier_id' => $data['supplier'][0]->id,
                'part_id' => $p->part_id,
                'po_number' => $data['new_po'][0]->po_number,
                'type' => "MDR",
                'grn_number' => $inwarding_data[0]->grn_number,
            );
            $rejection_flow_data = $this->Crud->get_data_by_id_multiple("rejection_flow", $arr2);
            $data['po_parts'][$key]->rejection_flow_data = $rejection_flow_data;
        }

        $arr = array(
            'inwarding_id' => $inwarding_data[0]->id,
            'invoice_number' => $inwarding_data[0]->invoice_number,

        );
        $invoice_amount = $inwarding_data[0]->invoice_amount;
        // $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
        $actual_price = 0;
        foreach ($grn_details_data as $g) {
            $actual_price = $actual_price + $g->inwarding_price;
        }
        // $cgst_amount = ($actual_price*$gst_structure[0]->cgst)/100;
        // $sgst_amount = ($actual_price*$gst_structure[0]->sgst)/100;
        // $igst_amount = ($actual_price*$gst_structure[0]->igst)/100;
        // $actual_price = $actual_price + $cgst_amount +$sgst_amount+$igst_amount;
        $minus_price = $actual_price - 1;
        $plus_price = $actual_price + 1;

        if ($actual_price != 0) {
            if ($invoice_amount >= $minus_price) {
                if ($invoice_amount <= $plus_price) {
                    $status = "verifed";
                } else {
                    $status = "not-verifed";
                }
            } else {
                $status = "not-verifed";
            }
        } else {
            $status = "not-verifed";
        }
        $data['actual_price'] = $actual_price;
        $data['minus_price'] = $minus_price;
        $data['plus_price'] = $plus_price;
        $data['status'] = $status;
        // pr($data,1);
        // $this->load->view('header');
        $this->loadView('store/inwarding_details_validation', $data);
        // $this->load->view('footer');
    }

    public function inwarding_details_accept_reject()
    {
        $new_po_id = $this->uri->segment('3');
        $data['new_po_id'] = $new_po_id;
        $inwarding_id = $this->uri->segment('2');
        $data['inwarding_id'] = $inwarding_id;

        $arr = array(
            'id' => $inwarding_id,
        );

        $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        $data['inwarding_data'] = $inwarding_data;
        $data['invoice_number'] = $inwarding_data[0]->invoice_number;


        //$invoice_amount = $inwarding_data[0]->invoice_amount;
        //$grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);

        $data['new_po'] = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
        // $data['gst_structure'] = $this->Crud->get_data_by_id("gst_structure", $data['new_po'][0]->tax_id, "id");
        $data['supplier'] = $this->Crud->get_data_by_id("supplier", $data['new_po'][0]->supplier_id, "id");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['uom'] = $this->Crud->read_data("uom");

        $arr = array(
            'supplier_id' => $data['supplier'][0]->id
        );

        $invoice_number = $inwarding_data[0]->invoice_number;
        $supplier_id = $data['supplier'][0]->id;
        $data['po_parts'] = $this->Crud->customQuery("SELECT p.*,u.uom_name as uom_name,gd.qty as grn_qty,gd.verified_qty as verified_qty,gd.accept_qty as accept_qty,gd.reject_qty as reject_qty,gd.remark as remark,gd.rm_batch_no as rm_batch_no,gd.mtc_report as mtc_report,gd.id as grn_details_id
            FROM po_parts as p
            LEFT JOIN uom as u ON u.id = p.uom_id
            LEFT JOIN grn_details as gd ON gd.part_id = p.part_id AND gd.inwarding_id = $inwarding_id AND gd.po_number = $new_po_id AND gd.invoice_number = '$invoice_number'
            WHERE p.po_id = $new_po_id
            ORDER BY p.id DESC
        ");
        foreach ($data['po_parts'] as $key => $p) {
            $data_con = array(
                'supplier_id' => $supplier_id,
                "child_part_id" => $p->part_id,
            );
            $child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data_con);
            $data['po_parts'][$key]->child_part_data = $child_part_data[0];
            $arr2 = array(
                'supplier_id' => $supplier_id,
                'part_id' => $p->part_id,
                'po_number' => $new_po_id,
                'type' => "grn_rejection",
            );
            $rejection_flow_data = $this->Crud->get_data_by_id_multiple("rejection_flow", $arr2);
            $data['po_parts'][$key]->rejection_flow_data = $rejection_flow_data[0];
        }


        /* extra query */
        $arr = array(
            'inwarding_id' => $inwarding_data[0]->id,
            'invoice_number' => $inwarding_data[0]->invoice_number,

        );
        $invoice_amount = $inwarding_data[0]->invoice_amount;
        // pr($invoice_amount,1);
        // $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
        $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
        $actual_price = 0;
        foreach ($grn_details_data as $g) {
            $actual_price = $actual_price + $g->inwarding_price;
        }


        // $cgst_amount = ($actual_price*$gst_structure[0]->cgst)/100;
        // $sgst_amount = ($actual_price*$gst_structure[0]->sgst)/100;
        // $igst_amount = ($actual_price*$gst_structure[0]->igst)/100;
        // $actual_price = $actual_price + $cgst_amount +$sgst_amount+$igst_amount;
        $actual_price = $actual_price + $data['new_po'][0]->final_amount;
        $minus_price = $actual_price - 1;
        $plus_price = $actual_price + 1;
        if ($actual_price != 0) {
            if ($invoice_amount >= $minus_price) {
                if ($invoice_amount <= $plus_price) {
                    $status = "verifed";
                } else {
                    $status = "not-verifed";
                }
            } else {
                $status = "not-verifed";
            }
        } else {
            $status = "not-verifed";
        }
        $data['status'] = $status;
        $data['actual_price'] = $actual_price;
        $data['isMultiClient'] = $this->session->userdata['isMultipleClientUnits'];
        $is_accept_inwarding = false;
        if(count($data['po_parts']) > 0){
            $is_accept_inwarding = true;
        }
        $data['is_accept_inwarding'] = $is_accept_inwarding;
        // $this->load->view('header');
        $this->loadView('quality/inwarding_details_accept_reject', $data);
        // $this->load->view('footer');
    }


    public function update_rm_batch_mtc_report()
    {
        $rm_batch_no = $this->input->post('rm_batch_no');
        $mtc_report = $this->input->post('mtc_report');

        $grn_details_id = $this->input->post('grn_details_id');
        //echo "grn_details_id: ".$grn_details_id;


        if (!empty($_FILES['mtc_report']['name'])) {
            $image_path = "./documents/mtc";
            $config['upload_path'] = $image_path;
            $config['allowed_types'] = '*';
            $config['file_name'] = $_FILES['drawing']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('mtc_report')) {
                $uploadData = $this->upload->data();
                $fila_name = $uploadData['file_name'];
            } else {
                $fila_name = '';
                echo "no 1";
            }
        } else {
            $fila_name = '';
            echo "no 2";
        }

        $data = array(
            "rm_batch_no" => $rm_batch_no,
            "mtc_report" => $fila_name
        );

        $update_result = $this->Crud->update_data("grn_details", $data, $grn_details_id);

        // if ($update_result) {
        //  echo "<script>alert('Successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        // } else {
        //  echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        // }
        if ($update_result) {
                        $success = 1;
                        $messages = "Successfully added.";
                                            } else {
                        $success = 0;
                        $messages = "Something went wrong.";
                                            }

                    $return_arr['success']=$success;
                    $return_arr['messages']=$messages;
                    echo json_encode($return_arr);
                    exit;

    }


    public function inwarding_by_po()
    {
        $po_number = $this->input->post('po_number');
        $data['po_number'] = $this->input->post('po_number');
        $data['new_po'] = $this->Crud->get_data_by_id("new_po", $po_number, "po_number");
        $data['customers'] = $this->Crud->read_data("customer");

        $this->load->view('header');
        $this->load->view('inwarding_by_po', $data);
        $this->load->view('footer');
    }

    public function inwarding_po_check()
    {
        $po_number = $this->input->post('po_number');
        $data['po_number'] = $this->input->post('po_number');

        $data['purchase_order'] = $this->Crud->get_data_by_id("purchase_order", $po_number, "po_number");

        $data['customers'] = $this->Crud->read_data("customer");

        $this->load->view('header');
        $this->load->view('inwarding_po_check', $data);
        $this->load->view('footer');
    }

    public function part_type()
    {
        $data['part_type'] = $this->Crud->read_data("part_type");

        $this->load->view('header');
        $this->load->view('part_type', $data);
        $this->load->view('footer');
    }
    public function customer_part_type()
    {
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");

        $this->load->view('header');
        $this->load->view('customer_part_type', $data);
        $this->load->view('footer');
        
    }

    public function gst()
    {
        checkGroupAccess("gst","list","Yes");
        $data['gst'] = $this->Crud->read_data("gst_structure");

        // $this->load->view('header');
        $this->loadView('admin/gst', $data);
        // $this->load->view('footer');
    }
    public function customer_child_part()
    {

        $data['id'] = $this->uri->segment('2');
        $data['child_part_list'] = $this->SupplierParts->readSupplierParts();
        $data['uom'] = $this->Crud->read_data("uom");
        $data['supplier_list'] = $this->Crud->read_data("supplier");

        $this->load->view('header');
        $this->load->view('customer_child_part', $data);
        $this->load->view('footer');
    }
    public function child_part_documents()
    {

        $data['id'] = $this->uri->segment('2');

        $data['uom'] = $this->Crud->read_data("uom");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        // $data['part_creation_revision'] = $this->Crud->read_data("part_creation");
        $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `part_creation` ');
        $data['part_creation_revision'] = $role_management_data->result();

        $child_part_list = $this->db->query('SELECT DISTINCT part_number FROM `child_part`');
        $data['child_part_list'] = $child_part_list->result();

        $this->load->view('header');
        $this->load->view('child_part_documents', $data);
        $this->load->view('footer');
    }
    public function part_operations()
    {
        // $type = $this->uri->segment('2');
        // $data['type'] = $this->uri->segment('2');
        // $part_id = $this->uri->segment('3');
        // $data['part_id'] = $this->uri->segment('3');

        // $data['part_info'] = $this->Common_admin_model->get_data_by_id("part_creation", $part_id, "id");

        // // print_r($data['part_info']);
        // // print_r($data['part_info']);


        // $data['part_creation'] = $this->Common_admin_model->get_all_data("part_creation");
        // $data['part_operations'] = $this->Common_admin_model->get_all_data("part_operations");
        // $data['sub_group'] = $this->Common_admin_model->get_all_data("sub_group");
        // $data['groups'] = $this->Common_admin_model->get_all_data("groups");
        // $data['size'] = $this->Common_admin_model->get_all_data("size");
        // $data['operations'] = $this->Common_admin_model->get_all_data("operations");
        // $data['parts_type'] = $this->Common_admin_model->get_all_data("parts_type");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `part_creation` ');
        // $data['new_part'] = $role_management_data->result();
        // $role_management_data = $this->db->query('SELECT DISTINCT operation_id FROM `part_operations` WHERE part_id=' . $part_id . '  ');
        // $data['part_operations_revision'] = $role_management_data->result();
        // // print_r($data['part_operations_revision']);
        // $this->load->view('includes/header.php');
        // $this->load->view('part_operations.php', $data);
        // $this->load->view('includes/footer.php');
        $type = $this->uri->segment('2');
        $data['type'] = $this->uri->segment('2');
        $part_id = $this->uri->segment('3');
        $data['part_id'] = $this->uri->segment('3');

        $data['part_info'] = $this->Common_admin_model->get_data_by_id("part_creation", $part_id, "id");
        // print_r($data['part_info']);


        $data['part_creation'] = $this->Common_admin_model->get_all_data("part_creation");
        // $data['part_operations'] = $this->Common_admin_model->get_all_data("part_operations");
        // $data['sub_group'] = $this->Common_admin_model->get_all_data("sub_group");
        // $data['groups'] = $this->Common_admin_model->get_all_data("groups");
        // $data['size'] = $this->Common_admin_model->get_all_data("size");
        $data['operations'] = $this->Common_admin_model->get_all_data("operations");
        // $data['parts_type'] = $this->Common_admin_model->get_all_data("parts_type");

        $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `part_creation` ');
        $data['new_part'] = $role_management_data->result();
        $role_management_data = $this->db->query('SELECT DISTINCT part_id,operation_id FROM `part_operations` WHERE part_id=' . $part_id . ' ');
        $data['part_operations_revision'] = $role_management_data->result();
        // print_r($data['new_part']);
        $this->load->view('header.php');
        $this->load->view('part_operations.php', $data);

        $this->load->view('footer.php');
    }
    public function add_part_operations()
    {
        $data_old = array(
            'part_id' => $this->input->post('part_id'),
            'operation_id' => $this->input->post('operation_id'),
            'revision_number' => $this->input->post('revision_number'),

        );

        $customer_count = $this->Common_admin_model->get_data_by_id_multiple_condition_count("part_operations", $data_old);

        // // $customer_count = $this->Common_admin_model->get_data_by_id_count("part_operations",$this->input->post('part_id'),"part_id");



        if ($customer_count > 0) {
            echo "<script>alert('Error : Part Already Present!!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {



            if (!empty($_FILES['drawing']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['drawing']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('drawing')) {
                    $uploadData = $this->upload->data();
                    $picture1 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture1 = '';
                    echo "no 1";
                }
            } else {
                $picture1 = '';
                echo "no 2";
            }

            $data = array(
                'part_id' => $this->input->post('part_id'),
                'operation_id' => $this->input->post('operation_id'),
                'operation_description' => $this->input->post('operation_description'),
                'drawing' => $picture1,
                'revision_number' => $this->input->post('revision_number'),
                'revision_date' => $this->input->post('revision_date'),
                'revision_remark' => $this->input->post('revision_remark'),
                'created_date' => $this->current_date,
            );

            $insert = $this->Common_admin_model->insert('part_operations', $data);

            if ($insert) {





                echo "<script>alert(' Operations  Added  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error While Adding Operations Parts !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_operations()
    {
        $customer_count = $this->Common_admin_model->get_data_by_id_count("operations", $this->input->post('name'), "name");
        $ret_arr = [];
        $msg = '';
        $success = 1;
        if ($customer_count > 0) {
            // echo "<script>alert('Operations  already Present!!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            $msg = 'Operations  already Present!!!!';
            $success = 0;
        } else {
            
            $data = array(
                'name' => $this->input->post('namess'),
                'created_by' => $this->user_id,
                'created_date' => $this->current_date,
                'created_time' => $this->current_time,
            );

            $insert = $this->Common_admin_model->insert('operations', $data);

            if ($insert) {
                $msg = 'operations added successfully.';
                // echo "<script>alert('operations Added  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $msg = 'Error While operations  !!!!';
                $success = 0;
                // echo "<script>alert('Error While operations  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }

        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);

    }

    public function add_transporter()
    {
        $data = array(
            'name' => $this->input->post('namess'),
            'transporter_id' => $this->input->post('transporter_id'),
            'vehicle_number' => $this->input->post('vehicle_number'),
            'created_by' => $this->user_id,
            'created_date' => $this->current_date,
            'created_time' => $this->current_time
        );
        $ret_arr = [];
        $msg = '';
        $success = 1;
        $insert = $this->Crud->insert_data('transporter', $data);

        if ($insert) {
            // $this->addSuccessMessage('Transporter added successfully.');
            $msg = 'Transporter added successfully.';
        } else {
            if ($this->checkNoDuplicateEntryError()) {
                // $this->addErrorMessage('Unable to add transporter details. Please try again.');
                $msg = 'Unable to add transporter details. Please try again.';
                $success = 0;
            }
        }
        // $this->redirectMessage();
        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }


    public function update_transporter()
    {
        $id = $this->input->post('id');

        $data = array(
            'name' => $this->input->post('namess'),
            'transporter_id' => $this->input->post('transporter_id'),
            'vehicle_number' => $this->input->post('vehicle_number')
        );

        $update = $this->Crud->update_data('transporter', $data, $id);
        if ($update) {
            $success = 1;
            $msg = 'Transporter updated successfully.';
        } else {
            $msg = 'Unable to update transporter details. Please try again.';
                $success = 0;
        }
        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }


    public function add_raw_material_inspection_master()
    {

        $data = array(
            'parameter' => $this->input->post('parameter'),
            'specification' => $this->input->post('specification'),
            'evalution_mesaurement_technique' => $this->input->post('evalution_mesaurement_technique'),
            'child_part_id' => $this->input->post('child_part_id'),

        );
        $success = 0;
        $messages = "Something went wrong.";
        $insert = $this->Common_admin_model->insert('raw_material_inspection_master', $data);

        if ($insert) {
            $messages = "Added Successfully !!";
            $success = 1;
            // echo "<script>alert('Added Successfully !!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages = "Error While operations  !!!!";
            // echo "<script>alert('Error While operations  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }


    public function update_raw_material_inspection_master()
    {

        $id = $this->input->post("id");

        $data = array(
            'parameter' => $this->input->post('parameter'),
            'specification' => $this->input->post('specification'),
            'evalution_mesaurement_technique' => $this->input->post('evalution_mesaurement_technique'),

        );
        $success = 0;
        $messages = "Something went wrong.";
        // $insert = $this->Common_admin_model->insert('raw_material_inspection_report', $data);
        $insert = $this->Common_admin_model->update("raw_material_inspection_master", $data, "id", $id);

        if ($insert) {
            $success = 1;
            $messages  ="Updated Successfully !!";
            // echo "<script>alert('Updated Successfully !!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages = "Error While operations  !!!!";
            // echo "<script>alert('Error While operations  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }


    public function add_rejection_remark()
    {
        $name = $this->input->post('name');
        $data['name'] = $name;

        $customer_count = $this->Crud->read_data_where('reject_remark', $data);

        if ($customer_count > 0) {
            $success = 0;
            $message = 'Data already exists.';
        } else {
            $data = array(
                'name' => $name,
                'created_by' => $this->user_id,
                'created_date' => $this->current_date,
                'created_time' => $this->current_time,
            );

            $insert = $this->Crud->insert_data('reject_remark', $data);
            if ($insert) {
                $success = 1;
                $message = 'Added successfully.';
            } else {
                $success = 0;
                $message = 'Unable to add.';
            }
        }

        $return_arr = array(
            'message' => $message,
            'success' => $success
        );

        echo json_encode($return_arr);
        exit();
    }


    public function add_operations_data()
    {
        // $customer_count = $this->Common_admin_model->get_data_by_id_count("operations", $this->input->post('name'), "name");
        $customer_count = 0;
        $ret_arr = [];
        $msg = '';
        $success = 1;
        if ($customer_count > 0) {
            // echo "<script>alert('Operations  already Present!!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            $msg = 'Operations  already Present!!!!';
            $success = 0;
        } else {

            $data = array(
                'operation_name' => $this->input->post('operation_name'),
                'product' => $this->input->post('product'),
                'process' => $this->input->post('process'),
                'specification_tolerance' => $this->input->post('specification_tolerance'),
                'evalution' => $this->input->post('evalution'),
                'size' => $this->input->post('size'),
                'frequency' => $this->input->post('frequency'),
                // 'created_by' => $this->user_id,
                // 'created_date' => $this->current_date,
                // 'created_time' => $this->current_time,
            );

            $insert = $this->Common_admin_model->insert('operation_data', $data);

            if ($insert) {
                // echo "<script>alert('operations Added  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                $msg = 'operations added successfully.';
            } else {
                $msg = 'Error While operations  !!!!';
                $success = 0;
                // echo "<script>alert('Error While operations  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $ret_arr['success'] = $success;
        $ret_arr['msg'] = $msg;
        echo json_encode($ret_arr);
    }
    public function operations()
    {
        checkGroupAccess("operations","list","Yes");
        $data['operations'] = $this->Common_admin_model->get_all_data("operations");

        // print_r($data['orders']);
        // $this->load->view('header.php');
        $this->loadView('admin/operations', $data);
        // $this->load->view('footer.php');
    }
    public function transporter()
    {
        checkGroupAccess("transporter","list","Yes");
        $data['transporter'] = $this->Common_admin_model->get_all_data("transporter");
        // $this->load->view('header.php');
        $this->loadView('admin/transporter', $data);
        // $this->load->view('footer.php');
    }
    public function remarks()
    {
        checkGroupAccess("remarks","list","Yes");
        $data['operations'] = $this->Crud->read_data("reject_remark");
        $this->loadView('quality/remarks', $data);
    }
    public function operations_data()
    {
        checkGroupAccess("operations_data","list","Yes");
        $data['operation_data'] = $this->Common_admin_model->get_all_data("operation_data");

        // print_r($data['orders']);
        // $this->load->view('header.php');
        $this->loadView('admin/operations_data', $data);

        // $this->load->view('footer.php');
    }

    public function view_history_part()
    {
        $part_no = $this->uri->segment('2');

        // $data['part_creation'] = $this->Common_admin_model->get_all_data("part_creation");
        $data['part_creation'] = $this->Common_admin_model->get_data_by_id("part_creation", $part_no, "part_number");

        // $data['sub_group'] = $this->Common_admin_model->get_all_data("sub_group");
        // $data['groups'] = $this->Common_admin_model->get_all_data("groups");
        // $data['size'] = $this->Common_admin_model->get_all_data("size");
        // $data['operations'] = $this->Common_admin_model->get_all_data("operations");
        // $data['parts_type'] = $this->Common_admin_model->get_all_data("parts_type");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `part_creation` ');
        // $data['part_creation_revision'] = $role_management_data->result();
        // print_r($data['orders']);
        $this->load->view('header.php');
        $this->load->view('view_history_part.php', $data);

        $this->load->view('footer.php');
    }

    public function add_part_creation()
    {
        echo    $part_id = $this->input->post('part_id');
        echo "<br>";

        $array = array(
            "id" => $part_id,

        );

        $child_part_data = $this->SupplierParts->getSupplierPartOnlyById($part_id);

        $data_old = array(
            'part_number' => $child_part_data[0]->part_number,
            'revision_number' => $this->input->post('revision_number'),

        );

        $customer_count = $this->Common_admin_model->get_data_by_id_multiple_condition("part_creation", $data_old);




        if ($customer_count > 0) {
            echo "<script>alert('Error : Customer Part Number and Revision Number Must Be Unique');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            if (!empty($_FILES['cad_file']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['cad_file']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('cad_file')) {
                    $uploadData = $this->upload->data();
                    $picture4 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture4 = '';
                    echo "no 1";
                }
            } else {
                $picture4 = '';
                echo "no 2";
            }
            if (!empty($_FILES['part_drawing']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['part_drawing']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('part_drawing')) {
                    $uploadData = $this->upload->data();
                    $picture1 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture1 = '';
                    echo "no 1";
                }
            } else {
                $picture1 = '';
                echo "no 2";
            }


            if (!empty($_FILES['ppap_document']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['ppap_document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('ppap_document')) {
                    $uploadData = $this->upload->data();
                    $picture2 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture2 = '';
                    echo "no 1";
                }
            } else {
                $picture2 = '';
                echo "no 2";
            }
            if (!empty($_FILES['modal_document']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['modal_document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('modal_document')) {
                    $uploadData = $this->upload->data();
                    $picture3 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture3 = '';
                    echo "no 1";
                }
            } else {
                $picture3 = '';
                echo "no 2";
            }

            if (!empty($_FILES['q_d']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['q_d']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('q_d')) {
                    $uploadData = $this->upload->data();
                    $q_d = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $q_d = '';
                    echo "no 1";
                }
            } else {
                $q_d = '';
                echo "no 2";
            }
            if (!empty($_FILES['a_d']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['a_d']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('a_d')) {
                    $uploadData = $this->upload->data();
                    $a_d = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $a_d = '';
                    echo "no 1";
                }
            } else {
                $a_d = '';
                echo "no 2";
            }
            if (!empty($_FILES['c_d']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['c_d']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('c_d')) {
                    $uploadData = $this->upload->data();
                    $c_d = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $c_d = '';
                    echo "no 1";
                }
            } else {
                $c_d = '';
                echo "no 2";
            }

            // $sub_group_data = $this->Common_admin_model->get_data_by_id("sub_group", $this->input->post('sub_group_id'), "id");
            // $group_id = $sub_group_data[0]->group_id;






            $data = array(
                'part_number' => $child_part_data[0]->part_number,
                'part_description' =>  $child_part_data[0]->part_description,
                'internal_part_number' => "",
                'group_id' => "",
                'supplier_id' => $this->input->post('supplier_id'),
                'type_id' => "",
                'size_id' => "",
                'part_drawing' => $picture1,
                'ppap_document' => $picture2,
                'modal_document' => $picture3,
                'cad_file' => $picture4,
                'c_d' => $c_d,
                'a_d' => $a_d,
                'q_d' => $q_d,
                'revision_number' => $this->input->post('revision_number'),
                'revision_date' => $this->input->post('revision_date'),
                'revision_remark' => $this->input->post('revision_remark'),
                'created_date' => $this->current_date,
            );

            $insert = $this->Common_admin_model->insert('part_creation', $data);

            if ($insert) {





                echo "<script>alert('Parts Added  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error While Adding part_creation  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_part_creation2()
    {
        echo    $part_id = $this->input->post('part_number');
        echo "<br>";

        $array = array(
            "part_number" => $part_id,

        );

        $child_part_data = $this->SupplierParts->getSupplierPartByPartNumber($part_id);

        $data_old = array(
            'part_number' => $child_part_data[0]->part_number,
            'revision_number' => $this->input->post('revision_number'),

        );

        $customer_count = $this->Common_admin_model->get_data_by_id_multiple_condition("part_creation", $data_old);




        if ($customer_count > 0) {
            echo "<script>alert('Error : Customer Part Number and Revision Number Must Be Unique');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            if (!empty($_FILES['cad_file']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['cad_file']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('cad_file')) {
                    $uploadData = $this->upload->data();
                    $picture4 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture4 = '';
                    echo "no 1";
                }
            } else {
                $picture4 = '';
                echo "no 2";
            }
            if (!empty($_FILES['part_drawing']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['part_drawing']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('part_drawing')) {
                    $uploadData = $this->upload->data();
                    $picture1 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture1 = '';
                    echo "no 1";
                }
            } else {
                $picture1 = '';
                echo "no 2";
            }


            if (!empty($_FILES['ppap_document']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['ppap_document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('ppap_document')) {
                    $uploadData = $this->upload->data();
                    $picture2 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture2 = '';
                    echo "no 1";
                }
            } else {
                $picture2 = '';
                echo "no 2";
            }
            if (!empty($_FILES['modal_document']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['modal_document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('modal_document')) {
                    $uploadData = $this->upload->data();
                    $picture3 = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $picture3 = '';
                    echo "no 1";
                }
            } else {
                $picture3 = '';
                echo "no 2";
            }

            if (!empty($_FILES['q_d']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['q_d']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('q_d')) {
                    $uploadData = $this->upload->data();
                    $q_d = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $q_d = '';
                    echo "no 1";
                }
            } else {
                $q_d = '';
                echo "no 2";
            }
            if (!empty($_FILES['a_d']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['a_d']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('a_d')) {
                    $uploadData = $this->upload->data();
                    $a_d = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $a_d = '';
                    echo "no 1";
                }
            } else {
                $a_d = '';
                echo "no 2";
            }
            if (!empty($_FILES['c_d']['name'])) {
                $image_path = "./documents/";
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['c_d']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('c_d')) {
                    $uploadData = $this->upload->data();
                    $c_d = $uploadData['file_name'];
                    //echo "yes";
                } else {
                    $c_d = '';
                    echo "no 1";
                }
            } else {
                $c_d = '';
                echo "no 2";
            }

            // $sub_group_data = $this->Common_admin_model->get_data_by_id("sub_group", $this->input->post('sub_group_id'), "id");
            // $group_id = $sub_group_data[0]->group_id;






            $data = array(
                'part_number' => $child_part_data[0]->part_number,
                'part_description' =>  $child_part_data[0]->part_description,
                'internal_part_number' => "",
                'group_id' => "",
                'sub_group_id' => "",
                'type_id' => "",
                'size_id' => "",
                'part_drawing' => $picture1,
                'ppap_document' => $picture2,
                'modal_document' => $picture3,
                'cad_file' => $picture4,
                'c_d' => $c_d,
                'a_d' => $a_d,
                'q_d' => $q_d,
                'revision_number' => $this->input->post('revision_number'),
                'revision_date' => $this->input->post('revision_date'),
                'revision_remark' => $this->input->post('revision_remark'),
                'created_date' => $this->current_date,
            );

            $insert = $this->Common_admin_model->insert('part_creation', $data);

            if ($insert) {





                echo "<script>alert('Parts Added  ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error While Adding part_creation  !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }

    public function update_part_drawings()
    {
        if (!empty($_FILES['document']['name'])) {
            $image_path = "./documents/";
            $config['upload_path'] = $image_path;
            $config['allowed_types'] = '*';
            $config['file_name'] = $_FILES['document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('document')) {
                $uploadData = $this->upload->data();
                $picture1 = $uploadData['file_name'];
            } else {
                $picture1 = '';
            }
        } else {
            $picture1 = $this->input->post('old_img');
        }

        $id = $this->input->post('id');
        $document_name  = "a";

        if ($this->input->post('document_name') == "ppap_document") {
            $document_name  = "ppap_document";
        } else if ($this->input->post('document_name') == "cad_file") {
            $document_name  = "cad_file";
        } else if ($this->input->post('document_name') == "modal_document") {
            $document_name  = "modal_document";
        } else if ($this->input->post('document_name') == "a_d") {
            $document_name  = "a_d";
        } else if ($this->input->post('document_name') == "c_d") {
            $document_name  = "c_d";
        } else if ($this->input->post('document_name') == "q_d") {
            $document_name  = "q_d";
        }

        $data = array(
            $document_name => $picture1,
        );

        $document_name;
        $query = $this->Common_admin_model->update("part_creation", $data, "id", $id);

        if ($query) {

            echo "<script>alert(' Update Success !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Error While  Updating , Please try Again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }


    public function update_gst()
    {
        $ret_arr = [];
        $msg = '';
        $success = 1;

        $id = $this->input->post('id');

        $code = $this->input->post('code');
        $cgst = $this->input->post('cgst');
        $sgst = $this->input->post('sgst');
        $igst = $this->input->post('igst');
        $tcs = $this->input->post('tcs');
        $with_in_state = $this->input->post('with_in_state');
        $tcs_on_tax = $this->input->post('tcs_on_tax');

        $data = array(
            // "code" => $code,
            "cgst" => $cgst,
            "sgst" => $sgst,
            "igst" => $igst,
            "tcs" => $tcs,
            "tcs_on_tax" => $tcs_on_tax,
            "with_in_state" => $with_in_state,
            "created_by" => $this->user_id,
            "created_date" => $this->current_date,
        );

        $query = $this->Common_admin_model->update("gst_structure", $data, "id", $id);

        if ($query) {
            $msg = 'GST updated successully.';
            //echo "<script>alert(' Update Success !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $msg = 'Error While  Updating , Please try Again.';
            $success = 0;
            //echo "<script>alert('Error While  Updating , Please try Again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr); 
    }

    public function update_gst_report()
    {

        $id = $this->input->post('id');

        //$filter_child_part_id = $this->input->post('filter_child_part_id');
        //echo "filter_child_part_id: ".$filter_child_part_id;
        //$data['filter_child_part_id'] = $filter_child_part_id;
        //$data['child_part_id'] = $filter_child_part_id;

        $gst_id = (int) $this->input->post('gst_id');
        // $cgst = $this->input->post('cgst');
        // $sgst = $this->input->post('sgst');
        // $igst = $this->input->post('igst');
        // $tcs = $this->input->post('tcs');
        // $with_in_state = $this->input->post('with_in_state');
        // $tcs_on_tax = $this->input->post('tcs_on_tax');

        $data = array(
            "gst_id" => $gst_id,
            // "cgst" => $cgst,
            // "sgst" => $sgst,
            // "igst" => $igst,
            // "tcs" => $tcs,
            // "tcs_on_tax" => $tcs_on_tax,
            // "with_in_state" => $with_in_state,
            // "created_by" => $this->user_id,
            // "created_date" => $this->current_date,
        );

        $query = $this->Common_admin_model->update("child_part_master", $data, "id", $id);

        if ($query) {

            echo "<script>alert(' Update Success !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Error While  Updating , Please try Again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    public function child_part() {
        checkGroupAccess("child_part_view","add","Yes");
        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");
        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['asset'] = $this->Crud->read_data("asset");

        $child_part_list = $this->db->query('SELECT DISTINCT part_number FROM `child_part`');
        $data['child_part_list'] = "";
        $type = $this->uri->segment('2');
        $data['type'] = $type != '' && $type != null ? $type : 'direct';
        // $item_category = ['direct','subcon_item','subcon_regular','consumable_item','indirect_assets','customer_bom'];
        // if(!in_array($type, $item_category)){
        //  $data['type'] = 'direct';
        // }
        $category_list = $this->db->query("SELECT * FROM `category` ");
        $data['category_list'] = $category_list->result();

        // $this->load->view('header');
        $this->loadView('purchase/child_part', $data);
        // $this->load->view('footer');
    }

    public function inhouse_parts() {
        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['asset'] = $this->Crud->read_data("asset");

        $child_part_list = $this->db->query('SELECT DISTINCT part_number FROM `inhouse_parts`');
        $data['child_part_list'] = "";

        $this->load->view('header');
        $this->load->view('inhouse_parts', $data);
        $this->load->view('footer');
    }




    public function report_stock_transfer()
    {
        checkGroupAccess("report_stock_transfer","list","Yes");
        $child_part_list = $this->db->query("
            SELECT s.* ,u.user_name
            FROM `stock_report` as s
            LEFT JOIN userinfo as u ON u.id = s.updated_by
            WHERE s.clientId =".$this->Unit->getSessionClientId()
        );
        $data['stock_report'] = $child_part_list->result();
        $date_filter = date("01/m/Y") ." - ". date("d/m/Y");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
        $this->loadView('reports/report_stock_transfer', $data);
    }

    public function operation_bom_add()
    {

        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data['inhouse_parts'] = $this->InhouseParts->readInhouseParts();
        $child_part_list = $this->db->query('SELECT id,part_number,part_description FROM `child_part`');
        $data['child_parts_data'] = $child_part_list->result();

        $this->load->view('header');
        $this->load->view('operation_bom_add', $data);
        $this->load->view('footer');
    }





    public function _approved_supplier($filter_supplier_id = 0)
    {
        checkGroupAccess("approved_supplier","list","Yes");
        $supplier_list = $this->Crud->read_data_where_result("supplier", array("admin_approve" => "accept"));
        $data['supplier_list'] = $supplier_list->result();
        // $this->load->view('header');
        $data['supplier_part_list'] = $this->SupplierParts->readSupplierPartsOnly();
        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");
        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $session_data = $this->session->userdata('entitlements');
        /* datatable */
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier Name",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "supplier_number",
            "title" => "Supplier Number",
            "width" => "20%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "location",
            "title" => "Supplier Address",
            "width" => "50%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "email",
            "title" => "Supplier Email",
            "width" => "20%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "mobile_no",
            "title" => "Supplier Mobile Number",
            "width" => "50%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "pan_card",
            "title" => "PAN CARD",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "gst_number",
            "title" => "GST Number",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "state",
            "title" => "State",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "payment_terms",
            "title" => "Payment Terms",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "nda_document",
            "title" => "NDA Documents",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "registration_document",
            "title" => "Registration Documents",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "other_document_1",
            "title" => "Other Document 1",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "other_document_2",
            "title" => "Other Document 2",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "other_document_3",
            "title" => "Other Document 3",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "admin_approve",
            "title" => "Admin Approval",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "with_in_state",
            "title" => "With In State",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "2%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "id",
            "title" => "Id",
            "width" => "14%",
            "className" => "dt-left",
            "visible" => false
        ];
        // pr($column,1);
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Supplier data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[17, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        // $ajax_json['teacher_data'] = $this->session->userdata();
        // pr($ajax_json['designation'],1);
        $this->loadView('purchase/approved_supplier', $data,"Yes","Yes");
        // $this->load->view('footer');
    }
    public function get_supplier_view()
    {
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

        // pr($post_data["search"],1);
        $data = $this->welcome_model->get_supplier_data(
            $condition_arr,
            $post_data["search"]
        );


        $upload_path = $base_url."public/uploads/documents/";
        foreach ($data as $key => $value) {
            $edit_data = base64_encode(json_encode($value));

            if($value['nda_document'] != ""){
                $nda_path = $upload_path.$value['nda_document'];
                if(strpos($nda_path, '.pdf')!== false){
                    $data[$key]['nda_document'] ="<embed src='".$nda_path."' width='70' height='80'>";
                }else{
                    $data[$key]['nda_document'] ="<img src='".$nda_path."' width='70' height='80'>";
                }

            }else{
                $data[$key]['nda_document'] = display_no_character();
            }


            if($value['registration_document'] != ""){
                $nda_path = $upload_path.$value['registration_document'];
                if(strpos($nda_path, '.pdf')!== false){
                    $data[$key]['registration_document'] ="<embed src='".$nda_path."' width='70' height='80'>";
                }else{
                    $data[$key]['registration_document'] ="<img src='".$nda_path."' width='70' height='80'>";
                }

            }else{
                $data[$key]['registration_document'] = display_no_character();
            }


            if($value['other_document_1'] != ""){
                $nda_path = $upload_path.$value['other_document_1'];
                if(strpos($nda_path, '.pdf')!== false){
                    $data[$key]['other_document_1'] ="<embed src='".$nda_path."' width='70' height='80'>";
                }else{
                    $data[$key]['other_document_1'] ="<img src='".$nda_path."' width='70' height='80'>";
                }
            }else{
                $data[$key]['other_document_1'] = display_no_character();
            }

            if($value['other_document_2'] != ""){
                $nda_path = $upload_path.$value['other_document_2'];
                if(strpos($nda_path, '.pdf')!== false){
                    $data[$key]['other_document_2'] ="<embed src='".$nda_path."' width='70' height='80'>";
                }else{
                    $data[$key]['other_document_2'] ="<img src='".$nda_path."' width='70' height='80'>";
                }
            }else{
                $data[$key]['other_document_2'] = display_no_character();
            }

            if($value['other_document_3'] != ""){
                $nda_path = $upload_path.$value['other_document_3'];
                if(strpos($nda_path, '.pdf')!== false){
                    $data[$key]['other_document_3'] ="<embed src='".$nda_path."' width='70' height='80'>";
                }else{
                    $data[$key]['other_document_3'] ="<img src='".$nda_path."' width='70' height='80'>";
                }
            }else{
                $data[$key]['other_document_3'] = display_no_character();
            }
            $data[$key]['action'] = display_no_character();
            if(checkGroupAccess("approved_supplier","update","No")){    
                 $data[$key]['action'] = "<a href='".$base_url."add_supplier?id=".$value['id']."' title='Edit'><i class='ti ti-edit ' ></i></a>";
            }
        }

        $data["data"] = $data;
        $total_record = $this->welcome_model->get_supplier_data_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();

    }

    public function getApprovedSupplierData(){
        $post_data = $this->input->post();
        $column_index = array_column($post_data["columns"], "data");
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
        $data = $this->SupplierParts->getSupplierData($condition_arr,$post_data["search"]);
        // pr($post_data,1);
        if(!is_valid_array($data)) echo json_encode([]);
        foreach ($data as $k=> $val){
            $doc_nda = $register_doc = $other_doc_1 = $other_doc_2 = $other_doc_3 = '';
            if(!empty($val['nda_document'])){
                $tem_d_id = $val['nda_document'];
                $doc_nda = '<a href="' . base_url('documents/') . $tem_d_id . '" download>Download</a>';
            }
            if(!empty($val['registration_document'])){
                $tem_d_id = $val['registration_document'];
                $doc_reg = '<a href="' . base_url('documents/') . $tem_d_id . '" download>Download</a>';
            }
            if(!empty($val['other_document_1'])){
                $tem_d_id = $val['other_document_1'];
                $doc_other_1 = '<a href="' . base_url('documents/') . $tem_d_id . '" download>Download</a>';
            }
            if(!empty($val['other_document_2'])){
                $tem_d_id = $val['other_document_2'];
                $doc_other_2 = '<a href="' . base_url('documents/') . $tem_d_id . '" download>Download</a>';
            }
            if(!empty($val['other_document_3'])){
                $tem_d_id = $val['other_document_3'];
                $doc_other_3 = '<a href="' . base_url('documents/') . $tem_d_id . '" download>Download</a>';
            }
            $data[$k]['doc_nda'] = $doc_nda;
            $data[$k]['doc_reg'] = $doc_reg;
            $data[$k]['doc_other_1'] = $doc_other_1;
            $data[$k]['doc_other_2'] = $doc_other_2;
            $data[$k]['doc_other_3'] = $doc_other_3;
        }

        $data["data"] = $data;
        $total_record = $this->SupplierParts->getSupplierDataCount($condition_arr,$post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
    }

    public function approved_supplier()
    {
        $this->_approved_supplier('');
    }

    public function view_supplier_by_filter()
    {
        $this->_approved_supplier($this->input->post('supplier_id'));
    }


    public function routing()
    {
        checkGroupAccess("routing","list","Yes");
        $data['child_part_master']  = $this->Crud->customQuery("SELECT DISTINCT part_number, c.*
        FROM `child_part` c WHERE sub_type in ('Subcon grn','Subcon Regular') ");

        // $this->load->view('header');
        $this->loadView('purchase/routing', $data);
        // $this->load->view('footer');
    }
    public function routing_customer()
    {
        checkGroupAccess("routing_customer","list","Yes");
        $data['customer_part_master'] = $this->Crud->customQuery('SELECT DISTINCT part_number, part_description, id FROM `customer_part` WHERE type!="subcon_po" ');
        // $this->load->view('header');
        $this->loadView('purchase/routing_customer', $data);
        // $this->load->view('footer');
    }

    public function view_add_challan_subcon()
    {
        checkGroupAccess("view_add_challan_subcon","list","Yes");
        $data['challan'] = $this->Crud->read_data("challan_subcon");
        $data['customer'] = $this->Crud->read_data("customer");


        // $this->load->view('header');
        $this->loadView('store/view_add_challan_subcon', $data);
        // $this->load->view('footer');
    }
    public function view_supplier_challan()
    {

        checkGroupAccess("view_supplier_challan","list","Yes");
        $data['challan'] = $this->Crud->read_data("challan");
        $data['supplier'] = $this->Crud->read_data("supplier");


        // $this->load->view('header');
        $this->loadView('store/view_supplier_challan', $data);
        // $this->load->view('footer');
    }
    public function view_supplier_challan_subcon()
    {
        checkGroupAccess("view_supplier_challan_subcon","list","Yes");
        //$data['challan'] = $this->Crud->read_data("challan");
        $data['customer'] = $this->Crud->read_data("customer");
        // $this->load->view('header');
        $this->loadView('store/view_supplier_challan_subcon', $data);
        // $this->load->view('footer');
    }
    public function view_supplier_challan_details()
    {

        $supplier_id = $this->uri->segment('2');
        $data['challan_data'] = $this->Crud->customQuery("SELECT * FROM challan
            WHERE clientId = ".$this->Unit->getSessionClientId()."
            AND supplier_id =".$supplier_id);
        $data['supplier_id'] = $supplier_id;
        // $this->load->view('header');
        $this->loadView('store/view_supplier_challan_details', $data);
        // $this->load->view('footer');
    }
    public function view_supplier_challan_details_subcon()
    {

        $customer_id = $this->uri->segment('2');
        $data['challan_data'] = $this->Crud->customQuery("SELECT * FROM challan_subcon
        WHERE clientid = ".$this->Unit->getSessionClientId()." AND customer_id = ".$customer_id);

        // $this->load->view('header');
        $this->loadView('store/view_supplier_challan_details_subcon', $data);
        // $this->load->view('footer');
    }
    public function view_supplier_challan_details_part_wise()
    {

        $challan_id = $this->uri->segment('2');
        $data['challan_parts'] = $this->Crud->customQuery("SELECT ccp.* ,cp.part_number as part_number,cp.part_description as part_description FROM `challan_parts` as ccp
            LEFT JOIN child_part cp ON cp.id = ccp.part_id WHERE `challan_id` = '".$challan_id."' ORDER BY ccp.id DESC");
        // $this->load->view('header');
        $this->loadView('store/view_supplier_challan_details_part_wise', $data);
        // $this->load->view('footer');
    }
    public function view_supplier_challan_details_part_wise_subcon()
    {

        $challan_id = $this->uri->segment('2');
        $data['challan_data'] = $this->Crud->get_data_by_id("challan_subcon", $challan_id, "id");
        $data['subcon_po_inwarding_history'] = $this->Crud->get_data_by_id("subcon_po_inwarding_history_subcon", $challan_id, "challan_id");
        $data['subcon_po_inwarding_history'] = $this->Crud->customQuery("
            SELECT spi.*,cp.part_number as part_number,cp.part_description as part_description,u.uom_name as uom_name
            FROM
                `subcon_po_inwarding_history_subcon` spi
            LEFT JOIN child_part cp ON cp.id = spi.subcon_po_inwarding_parts_id
            LEFT JOIN uom u ON u.id = cp.uom_id
            WHERE
                spi.challan_id = '10'
            ORDER BY
                spi.id
            DESC
        ");

        // pr($data['subcon_po_inwarding_history'],1);
        // $this->load->view('header');
        $this->loadView('store/view_supplier_challan_details_part_wise_subcon', $data);
        // $this->load->view('footer');
    }

    public function addrouting()
    {
        $data['part_id'] = $this->uri->segment('2');
        $data['child_part_master'] = $this->Crud->customQuery('SELECT DISTINCT part_number, id FROM `child_part` WHERE sub_type !="Subcon grn"');
        $data['routing'] = $this->Crud->customQuery("
            SELECT  r.qty, o.part_number as out_partNumber, o.part_description as out_partDesc, i.part_number as in_partNumber, i.part_description as in_partDesc,r.id as id_val
            FROM `routing` r
            INNER JOIN child_part o ON o.id = r.part_id
            INNER JOIN child_part i ON i.id = r.routing_part_id
            WHERE r.part_id = ".$data['part_id']);

        // $this->load->view('header');
        // pr($data,1);
        $this->loadView('purchase/addrouting', $data);
        // $this->load->view('footer');
    }

    public function addrouting_customer_subcon()
    {
        $data['part_id'] = $this->uri->segment('2');
        $data['child_part_master'] = $this->Crud->customQuery('SELECT DISTINCT part_number, id FROM `child_part` WHERE sub_type ="customer_bom"');
        $item_arr = [];
        foreach($data['child_part_master']  as $key=>$val){
            $array = array(
                "part_number" => $val->part_number,
            );
            $po = $this->Crud->get_data_by_id_multiple_condition("child_part", $array);
            $item_arr[] =[
                "id" => $po[0]->id,
                "part_number" => $po[0]->part_number
            ];
        }
        $data['item_arr'] = $item_arr;
        // pr($item_arr,1);
        $data['routing'] = $this->Crud->customQuery("
            SELECT r.id, r.qty, o.part_number as out_partNumber, o.part_description as out_partDesc, i.part_number as in_partNumber, i.part_description as in_partDesc
            FROM `routing_subcon` r
            INNER JOIN child_part o ON o.id = r.part_id
            INNER JOIN child_part i ON i.id = r.routing_part_id
            WHERE r.part_id = " . $data['part_id']);

        $this->loadView('purchase/addrouting_customer_subcon', $data);
    }
    public function insert_challan_history()
    {
        $challan_number = $this->input->post('challan_number');
        //$part_id = $this->input->post('part_id');


        $required_qty_new = $this->input->post('required_qty');
        // $required_qty = $this->input->post('qty');

        $challan_data = $this->Crud->get_data_by_id("challan", $challan_number, "id");


        //$challan_parts_qty = $required_qty;
        // $challan_parts_remanding_qty = $required_qty;
        // $challan_id = $challan_data[0]->id;
        // $new_challan_qty = $challan_parts_qty - $required_qty;
        // $challan_parts_history_data = array(
        //  "challan_id" => $challan_id,
        //  "challan_parts_id" => $part_id,
        //  "po_id" => '2',
        //  "previois_qty" => $challan_id,
        //  "remaning_qty" => $new_challan_qty,
        // );


        $inwarding_id = $this->input->post('inwarding_id');
        $po_number = $this->input->post('new_po_id');
        $grn_number = $this->input->post('grn_number');
        $invoice_number = $this->input->post('invoice_number');
        $part_id = $this->input->post('part_id');
        $qty = $this->input->post('qty');
        $po_part_id = $this->input->post('po_part_id');
        $part_rate = $this->input->post('part_rate');
        $tax_id = $this->input->post('tax_id');
        $pending_qty2 = $this->input->post('pending_qty');
        $challan_number = $this->input->post('challan_number');
        //$child_part_id = $this->input->post('child_part_id');


        $inwarding_price = $part_rate * $qty;

        $gst_structure = $this->Crud->get_data_by_id("gst_structure", $tax_id, "id");


        $challan_parts_data = $this->Crud->get_data_by_id("challan_parts", $challan_number, "challan_id");
        if ($challan_parts_data) {
            // echo "challan parts data present";
            // echo "<Br>";
            foreach ($challan_parts_data as $c) {
                $routing_data = $this->Crud->get_data_by_id("routing", $c->part_id, "routing_part_id");

                // echo "foreach started";
                // echo "<Br>";

                if ($routing_data) {

                    foreach ($routing_data as $r) {
                        // echo "routing started";
                        // echo "<Br>";

                        if ($c->part_id == $r->routing_part_id) {
                            $child_part_data = $this->SupplierParts->getSupplierPartById($c->part_id);
                            $sub_con_stock_old = $child_part_data[0]->sub_con_stock;
                            //      echo "part Id Matched";
                            // echo "<Br>";
                            echo "routing_data : ";
                            echo "<br>";
                            print_r($routing_data);
                            echo "<br>";
                            echo "<br>";
                            echo "po_part_id : " . $po_part_id;
                            echo "<br>";
                            echo "<br>";
                            echo "part_id : " . $part_id;
                            echo "<br>";
                            echo "<br>";
                            echo "c->part_id : " . $c->part_id;
                            echo "<br>";
                            echo "<br>";
                            echo "sub_con_stock_old : " . $sub_con_stock_old;
                            echo "<br>";
                            echo "<br>";
                            echo "required_qty_new  : " . $required_qty_new;
                            echo "<br>";
                            echo "<br>";

                            echo "new_sub_con : " . $new_sub_con = $sub_con_stock_old - $required_qty_new;
                            echo "<br>";


                            $data_child_part_update = array(
                                "sub_con_stock" => $new_sub_con,
                            );
                            // echo "part id".$part_id."/".$po_part_id.'/'.$r->routing_part_id;
                            // echo "<br>";
                            // echo "<br>";
                            $resul22t = $this->SupplierParts->updateStockById($data_child_part_update, $r->routing_part_id);
                            if ($resul22t) {
                                echo "success";
                            } else {
                                echo "sub_con_stock updated not found";
                            }
                            // echo "yes";
                            // echo "<br>";
                        } else {
                            echo "part Id not Matched " . $c->part_id . "/" . $part_id;
                            echo "<Br>";
                        }
                    }
                } else {
                    echo "routing data not found";
                }
            }
        } else {
            echo "challan parts data not present";
            echo "<Br>";
        }


        $cgst_amount = ($inwarding_price * $gst_structure[0]->cgst) / 100;
        $sgst_amount = ($inwarding_price * $gst_structure[0]->sgst) / 100;
        $igst_amount = ($inwarding_price * $gst_structure[0]->igst) / 100;



        $inwarding_price = $inwarding_price + $cgst_amount + $sgst_amount + $igst_amount;


        $data = array(
            "inwarding_id" => $inwarding_id,
            "po_number" => $po_number,
            "grn_number" => $grn_number,
            "invoice_number" => $invoice_number,
            "part_id" => $part_id,
            "qty" => $qty,
            "po_part_id" => $po_part_id,
            "inwarding_price" => $inwarding_price,
            "created_by" => $this->user_id,
            "created_date" => $this->current_date,
            "created_time" => $this->current_time,
            "created_day" => $this->date,
            "created_month" => $this->month,
            "created_year" => $this->year,
        );
        $result = $this->Crud->insert_data("grn_details", $data);
        if ($result) {
            $pending_qty =
                $data = array(
                    "pending_qty" => $pending_qty2 - $qty,
                );
            echo "pending_qty :  " . $pending_qty2 . "/ Qty : " . $qty;
            $result = $this->Crud->update_data("po_parts", $data, $po_part_id);

            if ($result) {

                $data_challan_parts_history = array(
                    "challan_id" => $challan_data[0]->id,
                    "challan_parts_id" => $part_id,
                    "previois_qty" => $part_id,
                    "remaning_qty" => $part_id,
                );

                $inser_query = $this->Crud->insert_data("challan_parts_history", $data_challan_parts_history);
                if ($inser_query) {
                    // echo "<script>alert('Successfully Added');document.location='" . base_url('inwarding') . "'</script>";

                } else {
                    echo "challan_parts_history update error";
                }
            } else {
                echo "none error po_parts update not found";
            }
            // echo "Success";
        } else {
            echo "Error while update routing_part_id data in child part";
        }
    }

    public function child_part_supplier()
    {
        $get_data = $this->input->get();
        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['child_part_list'] = $this->Crud->customQuery("select c.id, c.part_number, c.part_description, u.uom_name from child_part c, uom u
        where c.uom_id = u.id ");

        $mode = "Add";
        $child_part_data = [];
        if(isset($get_data['id'])){
            if($get_data['id'] >0){
                $mode = "Update";
                $child_part_data = $this->welcome_model->get_child_part_details($get_data['id']);
                $child_part_data['revision_date'] = formateFormDate($child_part_data['revision_date']);
                checkGroupAccess("child_part_supplier_view","update","Yes");
            }
        }else{
            checkGroupAccess("child_part_supplier_view","add","Yes");
        }
        $data['child_part_data'] =$child_part_data;
        $data['mode'] =$mode;
        $this->loadView('purchase/child_part_supplier', $data);
    }


    private function _view_child_part_supplier($filter_supplier_id)
    {
        checkGroupAccess("child_part_supplier_report","list","Yes");
        $data['filter_supplier_id'] = $filter_supplier_id;
        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");

        $child_part_master = $this->Crud->read_data_where_result("child_part_master", array("admin_approve" => "accept"));
        $data['child_part_master'] = $child_part_master->result();



        // pr($data['child_part_master'],1);
        // if ($data['child_part_master']) {
        //  foreach($data['child_part_master'] as $poo){
        //      if (isset($filter_supplier_id) && $filter_supplier_id != "All" && $filter_supplier_id != $poo->supplier_id)
        //          continue;
        //          $array = array(
        //              "part_number" => $poo->part_number,
        //              "supplier_id" => $poo->supplier_id,
        //          );

        //      $data['po'][$poo->part_number][] = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array);
        //      $data['supplier_data'][$poo->supplier_id][] = $this->Crud->get_data_by_id("supplier", $poo->supplier_id, "id");
        //      $data['gst_structure2'][$poo->part_number][] = $this->Crud->get_data_by_id("gst_structure", $data['po'][$poo->part_number][0][0]->gst_id, "id");
        //  }
        // }
        // pr($data['po'],1);
        // $this->load->view('header');
        // $this->load->view('child_part_supplier_report', $data);
        // $this->load->view('footer');

        $column[] = [
            "data" => "admin_approve",
            "title" => "Approval Status",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "rev_history",
            "title" => "Rev. & History",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "revision_no",
            "title" => "Revision Number",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "revision_remark",
            "title" => "Revision Remark",
            "width" => "10%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "revision_date",
            "title" => "Revision Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "code",
            "title" => "Tax Structure",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier",
            "width" => "17%",
            "className" => "dt-center",

        ];

        $column[] = [
            "data" => "part_rate",
            "title" => "Part Price",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "quotation_doc",
            "title" => "Quotation Document ",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];




        $data["data"] = $column;
        $data["is_searching_enable"] = false;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $this->loadView('reports/child_part_supplier_report',$data);
    }

    public function getChildPartReportData(){
        $supplier_id  = $this->input->post("supplier_id");
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
        $data = $this->SupplierParts->getChildSupplierReportData($condition_arr,$post_data["search"]);
        foreach ($data as $key => $value) {
            $edit_data = base64_encode(json_encode($value));
            $data[$key]['rev_history'] = display_no_character(""); 
            if(checkGroupAccess("child_part_supplier_report","update","No")){
            $data[$key]['rev_history'] = '<a type="submit" data-toggle="modal" class="" data-target="#exampleModaledit2<%$i%>"> <i class="ti ti-edit" data-edit ='. $edit_data.'></i></a>  ' . "<a href='" . base_url() . "price_revision/" . $value['part_number'] . "/" . $value['supplier_id'] . "' class=''> <i class='ti ti-history'></i></a>";
            }
            $data[$key]['quotation_doc'] = "<a href='" . base_url('documents') . "/" . $value['part_number'] . $value['quotation_document'] . "' download><i class='ti ti-download'></i></a>";
            $data[$key]['revision_date'] = defaultDateFormat($value['revision_date']);
            $data[$key]['admin_approve'] = $value['admin_approve'] != "" ? $value['admin_approve'] : display_no_character("");
        }

        $data["data"] = $data;
        $total_record = $this->SupplierParts->getChildSupplierReportCount([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
    }

    public function child_part_supplier_report()
    {

        $this->_view_child_part_supplier('');
    }

    public function view_child_part_supplier_by_filter()
    {

        $this->_view_child_part_supplier($this->input->post("supplier_id"));
    }




    private function _view_view_child_part_supplier($filter_child_part_id)
    {
        checkGroupAccess("child_part_supplier_view","list","Yes");
        // if (isset($filter_child_part_id) && !$filter_child_part_id == '') {
            $data['filter_child_part_id'] = (int) $filter_child_part_id;
            $data['gst_structure'] = $this->Crud->read_data("gst_structure");
            $part_where = '';

            // $data['child_part_master']  = $this->Crud->customQuery("SELECT gs.id as gs_id,gs.code as gs_code,u.uom_name as uom_name,s.supplier_name as supplier_name,s.supplier_name as with_in_state,cpm.*
            //  FROM child_part_master AS cpm
            //  LEFT JOIN child_part AS child ON cpm.part_number = child.part_number
            //  LEFT JOIN supplier AS s ON s.id = cpm.supplier_id
            //  LEFT JOIN uom AS u ON u.id = cpm.uom_id
            //  LEFT JOIN gst_structure AS gs ON gs.id = cpm.gst_id
            //  LEFT JOIN child_part_master AS cpm2
            //  ON cpm.supplier_id = cpm2.supplier_id
            //  AND cpm.child_part_id = cpm2.child_part_id
            //  AND cpm.id < cpm2.id
            // WHERE cpm2.id IS NULL $part_where
         //   group by cpm.supplier_id, cpm.child_part_id order by id desc");
        // }

        $data['child_part_list_filter']  = $this->Crud->customQuery('SELECT master.part_number,master.child_part_id, child.part_description
                    FROM `child_part_master` master, child_part child
                    WHERE master.part_number = child.part_number
                    GROUP BY master.part_number,master.child_part_id
                    ORDER BY child_part_id asc');
        $data['supplier_list'] = $this->Crud->read_data("supplier");
        /* datatable */
        $column[] = [
            "data" => "id",
            "title" => "Id",
            "width" => "7%",
            "className" => "dt-center",
            "visible" => false
        ];
        $column[] = [
            "data" => "admin_approve",
            "title" => "Approval Status",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "rev_history",
            "title" => "Rev. & History",
            "width" => "16%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "revision_no",
            "title" => "Revision Number",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "revision_remark",
            "title" => "Revision Remark",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "revision_date",
            "title" => "Revision Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "uom_name",
            "title" => "UOM",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "gs_code",
            "title" => "Tax Structure",
            "width" => "17%",
            "className" => "dt-center",
        ];
        // $column[] = [
        //     "data" => "update_tax",
        //     "title" => "Update Tax",
        //     "width" => "7%",
        //     "className" => "dt-center",
        // ];
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_rate",
            "title" => "Part Price",
            "width" => "7%",
            "className" => "dt-center",
        ];

        $column[] = [
            "data" => "document",
            "title" => "Quotation Document",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "7%",
            "className" => "dt-center",
        ];

        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Supplier Part Price data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[0, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $this->loadView('purchase/child_part_supplier_view', $data);
    }

    public function view_child_part_supplier(){
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
        $data = $this->welcome_model->get_child_part_supplier(
            $condition_arr,
            $post_data["search"]
        );
        // pr($data,1);
        foreach ($data as $key => $value) {
            $document = display_no_character();
            if(!empty($value['quotation_document'])){
                $url = base_url('documents/').$value['quotation_document'];
                $document = "<a href='$url' download>Download </a>";
            }
            $data[$key]['document'] = $document;
            $edit_data = base64_encode(json_encode($value));
            $revision_history = $base_url."price_revision/".$value['part_number']."/".$value['supplier_id'];
            $rev_history ="<a href='".$revision_history."' title='History'><i class='ti ti-clock-cog' ></i></a>";
            if($value['admin_approve'] == 'accept'){
                $rev_history .= "<i class='ti ti-square-rounded-plus edit-supplier-part-price' title='Add Rev.' data-value='$edit_data'></i>";
            }
            $data[$key]['rev_history'] = $rev_history;
            $edit_url = $base_url."child_part_supplier?id=".$value['id'];
            $data[$key]['action'] = display_no_character();
            if(checkGroupAccess("child_part_supplier_view","update","No")){    
               $data[$key]['action'] = "<a href='".$edit_url."'><i class='ti ti-edit edit-part' title='Edit'></i></a>";
            }
            $data[$key]['revision_date'] = defaultDateFormat($value['revision_date']);
        }
        $data["data"] = $data;
        $total_record = $this->welcome_model->get_child_part_supplier_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();

    }


    public function child_part_supplier_view()
    {
        $this->_view_view_child_part_supplier('');
    }

    public function view_view_child_part_supplier_by_filter()
    {
        $this->_view_view_child_part_supplier($this->input->post("child_part_id"));
    }



    public function child_part_supplier_admin()
    {
        checkGroupAccess("child_part_supplier_admin","list","Yes");
        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");

        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");

        $child_part_list = $this->db->query('SELECT DISTINCT part_number,supplier_id FROM `child_part_master`');
        $data['child_part_list'] = $child_part_list->result();
        foreach ($data['child_part_list'] as $key => $poo) {
            $array = array(
                "part_number" => $poo->part_number,
                "supplier_id" => $poo->supplier_id,
            );
            $po = $this->Crud->get_data_by_id_multiple_condition_without("child_part_master", $array);
            $data['child_part_list'][$key]->po = $po;

            $supplier_data = $this->Crud->get_data_by_id("supplier", $poo->supplier_id, "id");
            $data['child_part_list'][$key]->supplier_data = $supplier_data;

            $uom_data = $this->Crud->get_data_by_id("uom", $po[0]->uom_id, "id");
            $data['child_part_list'][$key]->uom_data = $uom_data;

            // $child_part_id = $this->Crud->get_data_by_id("part_type", $po[0]->child_part_id, "id");
            // $data['child_part_list'][$key]->child_part_id = $child_part_id;

            $gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $po[0]->gst_id, "id");
            $data['child_part_list'][$key]->gst_structure2 = $gst_structure2;
        }
        // pr($data['child_part_list'],1);
        $child_part_list = $this->db->query('SELECT DISTINCT part_number FROM `child_part`');
        $data['child_part_master'] = $child_part_list->result();

        // $this->load->view('header');
        $this->loadView('admin/child_part_supplier_admin', $data);
        // $this->load->view('footer');
    }






    public function generate_sales_invoice()
    {

        // $data['id'] = $this->uri->segment('2');

        $data['child_part_list'] = $this->Crud->read_data("child_part_master");
        $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `child_part_master` ');
        $data['customer_part_list'] = $role_management_data->result();

        $data['uom'] = $this->Crud->read_data("uom");
        $data['cparttypelist'] = $this->Crud->read_data("part_type");

        $data['supplier_list'] = $this->Crud->read_data("supplier");



        $this->load->view('header');
        $this->load->view('part_stocks', $data);
        $this->load->view('footer');
    }
    public function planning_year_page()
    {
        checkGroupAccess("planning_year_page","list","Yes");
        // $this->load->view('header');
        // $this->load->view('planning_year_page', $data);
        // $this->load->view('footer');
        $this->loadView('customer/planning_year_page',$data);
    }

    public function planing_data_report_view()
    {
        if (!empty($this->input->post('customer_id'))) {
            $data['customer_id'] = $this->input->post('customer_id');
            $customer_id = $this->input->post('customer_id');
        } else {
            $data['customer_id'] = $this->input->post('customer_id');
            $customer_id = $this->input->post('customer_id');
        }
        $data['financial_year'] = $this->input->post('financial_year');
        $data['month'] = $this->input->post('month_id');
        $financial_year = $this->input->post('financial_year');
        $month = $this->input->post('month_id');
        $arr = array(
                "financial_year" => $financial_year,
                 "month" => $month,
                "clientId" =>  $this->Unit->getSessionClientId()
            );
        $data['planing_data'] = $this->Crud->get_data_by_id_multiple("planing", $arr);
        // pr($this->db->last_query());
        $data['customer'] = $this->Crud->read_data("customer");
        // pr($data,1);
            // pr($this->router->routes,1);

        foreach ($data['planing_data'] as $t) {

            if ($month == $t->month) {

                $data['customer_part_data'][$t->id] = $this->Crud->get_data_by_id("customer_part", $t->customer_part_id, "id");
                $data['customer_part_rate'][$t->id] = $this->Crud->get_data_by_id("customer_part_rate", $t->customer_part_id, "customer_master_id");
                $data['customers_data'][$t->id] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][$t->id][0]->customer_id, "id");

                if ($customer_id == 0) {

                    $data['job_card_data'][$t->id] = $this->Crud->get_data_by_id("job_card", $data['customer_part_data'][$t->id][0]->customer_id, "customer_part_id");


                    $data['planing_data_new'][$t->id] = $this->Crud->get_data_by_id("planing_data", $t->id, "planing_id");

                    $data['issued'][$t->id] = 0;
                    $data['closed'][$t->id] = 0;

                    if ($data['job_card_data']) {
                        $data['issued'][$t->id] = count($job_card_data);
                    }

                    $main_qty[$t->id] = $data['planing_data_new'][$t->id][0]->schedule_qty;
                    if ($data['planing_data_new'][$t->id][0]->schedule_qty_2) {
                        $data['main_qty'][$t->id] = $data['planing_data_new'][$t->id][0]->schedule_qty_2;
                    }


                    $data['rate'][$t->id] = 0;
                    $data['subtotal1'][$t->id] = 0;
                    $data['subtotal2'][$t->id] = 0;
                    if ($data['customer_part_rate'][$t->id]) {
                        $data['rate'][$t->id] = $data['customer_part_rate'][$t->id][0]->rate;
                        $data['subtotal1'][$t->id] = $data['customer_parplaning_data_report_viewt_rate'][$t->id][0]->rate * $data['planing_data_new'][$t->id][0]->schedule_qty;
                        $data['subtotal2'][$t->id] = $data['customer_part_rate'][$t->id][0]->rate * $data['planing_data_new'][$t->id][0]->schedule_qty_2;

                        $total1 = $total1 + $data['subtotal1'][$t->id];

                        $total2 = $total2 + $data['subtotal2'][$t->id];
                    } else {;
                    }
                    // $job_card_list = $this->db->query('SELECT SUM(req_qty) as MAINSUM FROM `job_card` where customer_part_id = '.$customer_part_data[0].'  ');
                    // $count_1 = $job_card_list->result();
                    $month_number = $this->Common_admin_model->get_month_number($month);
                    $year_number = substr($financial_year, 3, strlen($financial_year));
                    $role_management_data[$t->id] = $this->db->query('SELECT SUM(req_qty) as MAINSUM FROM `job_card` WHERE customer_part_id = ' . $t->customer_part_id . ' AND status = "released"');
                    $count_1[$t->id] = $role_management_data[$t->id]->result();
                    $count_1[$t->id] = $count1[0]->COUNTOFID;
                    $sales_invoice[$t->id] = $this->db->query('SELECT COUNT(id) as COUNTOFID FROM `new_sales` WHERE created_month = "' . $month_number . '" AND created_year = "' . $year_number . '"');
                    $count_1_sales_invoice[$t->id] = $sales_invoice[$t->id]->result();
                    // $sales_invoice = $this->db->query('SELECT COUNT(id) as COUNTOFID FROM `new_sales` WHERE created_month = "' . $month_number . '" AND created_year = "' . $year_number . '"');
                    // $count_1_sales_invoice = $sales_invoice->result();
                    // echo
                    // print_r($count_1_sales_invoice);
                    // $count_1_sales_invoice;
                    $job_card_qty = 0;

                    if ($count_1[$t->id]) {
                        $data['job_card_qty'][$t->id] = $count_1[$t->id][0]->MAINSUM;

                    }else{
                        $data['job_card_qty'][$t->id] = empty($data['job_card_qty'][$t->id]) ? 0 :  $data['job_card_qty'][$t->id];
                    }

                    if ($count_1_sales_invoice[$t->id][0]->COUNTOFID) {
                        $data['dispatch_sales_qty'][$t->id] = $count_1_sales_invoice[$t->id][0]->COUNTOFID;
                    } else {
                        $data['dispatch_sales_qty'][$t->id] = 0;
                    }

                    $data['balance_s_qty'][$t->id] = 0;

                }
            }
        }
        $data['total1'] = $total1;
        $data['total2'] = $total2;

        // pr($data,1);
        // $this->load->view('header');
        // $this->load->view('planing_data_report_view', $data);
        // $this->load->view('footer');
        $this->getPage('reports/planing_data_report_view',$data);
    }
    public function planing_data_report()
    {
        checkGroupAccess("planing_data_report","list","Yes");
        $column[] = [
            "data" => "part_number",
            "title" => "Customer Part Number",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Customer Part Description",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "customer_name",
            "title" => "Customer Name",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "month",
            "title" => "Month",
            "width" => "10%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "button_total",
            "title" => "Schedule Qty 1",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "schedule_qty_2",
            "title" => "Schedule Qty 2",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "job_card_qty",
            "title" => "Job Card Qumulative Qty",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "job_card_qty",
            "title" => "Job Card Balance Qty",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "issued",
            "title" => "Job Card Issued",
            "width" => "17%",
            "className" => "dt-center",

        ];

        $column[] = [
            "data" => "closed",
            "title" => "Job Card Closed",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "rate",
            "title" => "Customer Part Price",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];
        $column[] = [
            "data" => "dispatch_sales_qty",
            "title" => "Dispatch (sales qty)",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];

        $column[] = [
            "data" => "balance_s_qty",
            "title" => "Balance Schedule qty",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];

        $column[] = [
                "data" => "total1",
                "title" => "Subtotal Schedule",
                "width" => "7%",
                "className" => "dt-center",
                'orderable' => false
            ];
            $column[] = [
                "data" => "total2",
                "title" => "View Details",
                "width" => "7%",
                "className" => "dt-center",
                'orderable' => false
            ];

        //echo $this->input->post('customer_id');
        if (!empty($this->input->post('customer_id'))) {
            $data['customer_id'] = $this->input->post('customer_id');
            $customer_id = $this->input->post('customer_id');
        } else {
            $data['customer_id'] = $this->uri->segment('4');
            $customer_id = $this->uri->segment('4');
        }
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data["data"] = $column;
        $data['customer'] = $this->Crud->read_data("customer");
        $data["is_searching_enable"] = false;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data["current_year"] = date("Y");

        // $this->load->view('header');
        $this->getPage('reports/planing_data_report_view', $data);
        // $this->load->view('footer');
    }

    public function planningReportDataAjax(){
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

        $data = $this->welcome_model->getPlanningReportView($condition_arr,$post_data["search"]);

        // pr($data,1);

        foreach ($data as $key => $value) {
            $edit_data = base64_encode(json_encode($value));
            $url = base_url('view_planing_data').'/'.$value['planing_id'];
            $data[$key]['button_total'] = "<a href='$url'><button class='btn btn-primary'>View Details</button></a>";
            $subtotal_1 = $val['rate'] * $val['schedule_qty'];
            $subtotal_2 = $val['rate'] * $val['schedule_qty_2'];
            $data[$key]['subtotal1'] = $subtotal_1;
            $data[$key]['subtotal2'] = $subtotal_2;
            $data[$key]['issued'] = '';
            $data[$key]['closed'] = '';
            $data[$key]['balance_s_qty'] = '';
            $data[$key]['total1'] = '';
            $data[$key]['total2'] = '';


        }

        $data["data"] = $data;
        $total_record = $this->welcome_model->getPlanningReportViewCount([], $post_data["search"],$month = 'APR',$year = 'FY-2024');

        $data["recordsTotal"] = count($total_record);
        $data["recordsFiltered"] = count($total_record);
        echo json_encode($data);
    }


    /**
     * Stock Rejection transfer
     */
    public function transfer_stock()
    {
        $rejection_flow_id  = $this->uri->segment('2');
        $rejection_flow_data = $this->Crud->get_data_by_id("rejection_flow", $rejection_flow_id, "id");
        $child_part_data = $this->SupplierParts->getSupplierPartById($rejection_flow_data[0]->part_id);
        if ($child_part_data) {
            $qty = $rejection_flow_data[0]->qty;
            $current_stock = $child_part_data[0]->stock;
            $rejection_prodcution_qty = $child_part_data[0]->rejection_prodcution_qty;

            if ($qty > $current_stock) {
                $this->addErrorMessage("Entered Qty is greater than actual stock please try again");
            } else {
                $new_stock = $current_stock - $qty;
                $new_rejection_prodcution_qty = $rejection_prodcution_qty + $qty;
                $data_update_child_part = array(
                    "stock" => $new_stock,
                    "rejection_prodcution_qty" => $new_rejection_prodcution_qty,
                );
                $result2 = $this->SupplierParts->updateStockById($data_update_child_part, $rejection_flow_data[0]->part_id);
                if ($result2) {
                    $data_update_rejection_flow = array(
                        "status" => "stock_transfered",
                    );
                    $result3 = $this->Crud->update_data("rejection_flow", $data_update_rejection_flow, $rejection_flow_id);
                    if ($result3) {
                        $this->addSuccessMessage('Stock Transfered successfully.');
                    }
                }
            }
        } else {
            $this->addErrorMessage('Item part  id : ' . $rejection_flow_data[0]->part_id . 'Not Found in child_part table Please try again ');
        }
        $this->redirectMessage();

    }


    public function final_inspection_stock_transfer_click()
    {
        $final_inspection_request_id  = $this->uri->segment('2');
        $final_inspection_request_data = $this->Crud->get_data_by_id("final_inspection_request", $final_inspection_request_id, "id");
        $customer_part_data = $this->CustomerPart->getCustomerPartById($final_inspection_request_data[0]->customer_part_id);
        $customer_parts_master = $this->CustomerPart->getCustomerPartById($final_inspection_request_data[0]->customer_part_id);
        if ($customer_part_data) {
            $customer_part_id = $customer_part_data[0]->id;
            $qty = (float)$final_inspection_request_data[0]->qty;
            $current_final_inspection_location = (float)$customer_part_data[0]->final_inspection_location;
            $current_fg_stock = (float)$customer_part_data[0]->fg_stock;
            $new_fg_stock = $current_fg_stock + $qty;
            $new_final_inspection_location =  $current_final_inspection_location - $qty;


            $data_update_child_part = array(
                "final_inspection_location" => $new_final_inspection_location,
                "fg_stock" => $new_fg_stock,
            );
            $data_update_child_part_molding_stock_transfer = array(
                "status" => "completed",
            );
            $result2 = $this->Crud->update_data("customer_part", $data_update_child_part, $final_inspection_request_data[0]->customer_part_id);
            $result3 = $this->Crud->update_data("final_inspection_request", $data_update_child_part_molding_stock_transfer, $final_inspection_request_id);
            // print_r($data_update_child_part);
            // $result2 = $this->Crud->update_data("customer_part", $data_update_child_part, $molding_stock_transfer_data[0]->customer_part_id);

            /** Update customer parts master used for FG stock  */
            $update_customer_parts_master = array(
                "fg_stock" =>  $customer_parts_master[0]->fg_stock + $qty,
                "final_inspection_location" =>  $customer_parts_master[0]->final_inspection_location - $qty
            );
            $result4 = $this->CustomerPart->updateStockById($update_customer_parts_master, $customer_parts_master[0]->id);

            if ($result4) {
                echo "<script>alert('Stock Transfered successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "error";
                // echo "<br> Please add all above production qty";
                // echo "<br><br><br><br><br><a href=" . $_SERVER['HTTP_REFERER'] . "> < Go Back</a>";
            }
        } else {
            echo "item part  id : " . $customer_part_data[0]->part_number . "Not Found in customer_part table Please try again ";
        }
    }



    public function update_rejection_flow_status()
    {

        $rejection_flow_id  = $this->input->post('id');
        $status  = $this->input->post('status');
        $rejection_flow_data = $this->Crud->get_data_by_id("rejection_flow", $rejection_flow_id, "id");
        $child_part_data = $this->SupplierParts->getSupplierPartById($rejection_flow_data[0]->part_id);
        if ($child_part_data) {
            $qty = $rejection_flow_data[0]->qty;
            $current_stock = $child_part_data[0]->stock;
            $rejection_prodcution_qty = $child_part_data[0]->rejection_prodcution_qty;

            if ($status == "approved") {
                $new_rejection_prodcution_qty = $rejection_prodcution_qty - $qty;
                $data_update_child_part = array(
                    "rejection_prodcution_qty" => $new_rejection_prodcution_qty,
                );
                $result2 = $this->SupplierParts->updateStockById($data_update_child_part, $rejection_flow_data[0]->part_id);
                if ($result2) {
                    $data_update_rejection_flow = array(
                        "status" => "approved",
                    );
                    $result3 = $this->Crud->update_data("rejection_flow", $data_update_rejection_flow, $rejection_flow_id);
                    if ($result3) {
                        $this->addSuccessMessage('Stock changes Approved successfully.');
                    }
                }
            } else {
                $new_stock = $current_stock + $qty;
                $new_rejection_prodcution_qty = $rejection_prodcution_qty - $qty;
                $data_update_child_part = array(
                    "stock" => $new_stock,
                    "rejection_prodcution_qty" => $new_rejection_prodcution_qty,
                );
                $result2 = $this->SupplierParts->updateStockById($data_update_child_part, $rejection_flow_data[0]->part_id);
                if ($result2) {
                    $data_update_rejection_flow = array(
                        "status" => "rejected",
                    );
                    $result3 = $this->Crud->update_data("rejection_flow", $data_update_rejection_flow, $rejection_flow_id);
                    if ($result3) {
                        $this->addSuccessMessage('Stock Changed Rejected.');
                    }
                }
            }
        } else {
             $this->addErrorMessage('Item part  id : ' . $rejection_flow_data[0]->part_id . 'Not Found in child_part table Please try again');
        }
        $this->redirectMessage();
    }

    public function update_production_qty()
    {
        $part_number  = $this->input->post('part_number');
        $production_qty  = $this->input->post('production_qty');
        $child_part = $this->SupplierParts->getSupplierPartByPartNumber($part_number);
        $old_stock = $child_part[0]->stock;
        $new_stock = $old_stock + $production_qty;

        $data_update_child_part = array(
            "stock" => $new_stock,
        );

        $query = $this->SupplierParts->updateStockById($data_update_child_part, $child_part[0]->id);
        $inhouse_parts_data = $this->InhouseParts->getInhousePartByPartNumber($part_number);
        $old_stock_inhouse = $inhouse_parts_data[0]->production_qty;
        $new_stock_inhouse = $old_stock_inhouse - $production_qty;
        $data_update_child_part_inhouse = array(
            "production_qty" => $new_stock_inhouse,
        );
        $success = 0;
        $messages = "Something went wrong.";
        $query = $this->InhouseParts->updateStockById($data_update_child_part_inhouse, $inhouse_parts_data[0]->id);
        if ($query) {
            $this->Crud->stock_report($child_part[0]->part_number,$child_part[0]->part_number, "production_qty", "store_stock", $old_stock, $new_stock);
            $messages = "Updated Successfully";
            $success = 1;
            // echo "<script>alert('Updated Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages = "Error IN User  Adding ,try again";
            // echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }



    public function transfer_child_part_to_store_stock()
    {


        $customer_part_number  = $this->input->post('customer_part_number');

        $child_part_id  = $this->input->post('child_part_id');
        $child_part = $this->SupplierParts->getSupplierPartById($child_part_id);
        $customer_part_number_data = $this->SupplierParts->getSupplierPartByPartNumber($customer_part_number);



        echo $customer_part_number_data[0]->part_number;
        echo "<br>";
        echo $child_part[0]->part_number;
        echo "<br>";
        $stock  = (float)$this->input->post('stock');
        $old_stock = (float)$child_part[0]->stock;
        $new_stock = $old_stock - $stock;
        $old_stock_customer_part_number_data = (float)$customer_part_number_data[0]->stock;
        $new_stock_customer_part_number_data = (float)$old_stock_customer_part_number_data + $stock;


        $data_update_child_part = array(
            "stock" => $new_stock,
        );
        $data_update_child_part_customer_part_number_data = array(
            "stock" => $new_stock_customer_part_number_data,
        );
        print_r($data_update_child_part);
        echo "<br>";
        print_r($data_update_child_part_customer_part_number_data);

        $query = $this->SupplierParts->updateStockById($data_update_child_part, $child_part_id);
        $customer_part_number_quty = $this->SupplierParts->updateStockById($data_update_child_part_customer_part_number_data, $customer_part_number_data[0]->id);

        if ($query) {
            $this->stock_report($customer_part_number_data[0]->part_number, $customer_part_number_data[0]->part_number, "production_stock", "store_stock", $old_stock, $stock);
            echo "<script>alert('Updated Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
        }
    }




    public function view_challan_parts_history()
    {

        $challan_id = $this->uri->segment('2');
        $part_id = $this->uri->segment('3');
        $challan_parts_get_array = array(
            'challan_id' => $challan_id,
            'part_id' => $part_id,
        );
        $data['challan_id'] = $challan_id;
        // print_r($arr);
        $data['challan_parts_data'] = $this->Crud->get_data_by_id_multiple("challan_parts_history", $challan_parts_get_array);
        // $this->load->view('header');
        $this->loadView('store/view_challan_parts_history', $data);
        // $this->load->view('footer');
    }
    public function view_challan_parts_history_subcon()
    {

        $challan_id = $this->uri->segment('2');
        $part_id = $this->uri->segment('3');
        $challan_parts_get_array = array(
            'challan_id' => $challan_id,
            'part_id' => $part_id,
        );
        // print_r($arr);
        $data['challan_parts_data'] = $this->Crud->get_data_by_id_multiple("challan_parts_history_subcon", $challan_parts_get_array);



        $this->load->view('header');
        $this->load->view('view_challan_parts_history_subcon', $data);
        $this->load->view('footer');
    }

    public function erp_users()
    {
        checkGroupAccess("erp_users","list","Yes");
        // $criteria = array('AROM_ADMIN');
        $data['client'] = $this->Crud->read_data("client");
        $groups = $this->db->query('SELECT *  FROM `group_master` ');
        $data['groups'] = $groups->result();
        $data['user_info'] = $this->Crud->customQuery("SELECT * FROM `userinfo` WHERE `user_role` IS NULL OR `user_role` NOT IN ('AROM') ORDER BY `id` DESC");
        //earlier code --> $data['user_info'] = $this->Crud->get_data_by_id_multiple_condition("userinfo",$criteria);
        //working earlier - $data['user_info'] = $this->Crud->read_data("userinfo");
        // $this->load->view('header');
        // pr($data,1);
        $this->loadView('admin/erp_users', $data);
        // $this->load->view('footer');
    }

    public function asset()
    {
        checkGroupAccess("asset","list","Yes");
        $data['shifts'] = $this->Crud->read_data("shifts");
        // $this->load->view('header');
        $this->loadView('admin/shift', $data);
        // $this->load->view('footer');
    }

    public function final_inspection_qa()
    {
        checkGroupAccess("final_inspection_qa","list","Yes");
        $clientId = $this->Unit->getSessionClientId();
        $data['p_q'] = $this->Crud->customQuery('SELECT
                    p.*,
                    o.name AS op_name,
                    m.name AS machine_name,
                    s.shift_type AS shift_type,
                    s.name AS shift_name
                FROM
                    `p_q` p
                JOIN
                    machine m ON p.machine_id = m.id
                JOIN
                    operator o ON p.operator_id = o.id
                JOIN
                    shifts s ON p.shift_id = s.id
                WHERE
                    m.clientId = '.$clientId.'
                    AND m.name = "FINAL INSPECTION"
                ORDER BY
                    p.id DESC
                ');
        foreach ($data['p_q'] as $key => $u) {

            if ($u->output_part_table_name == "inhouse_parts1") {
                $output_part_data = $this->InhouseParts->getInhousePartOnlyById($u->output_part_id);
            } else {
                $output_part_data = $this->Crud->get_data_by_id("customer_part", $u->output_part_id, "id");
            }
            $data['p_q'][$key]->output_part_data = $output_part_data;

        }

        $data['reject_remark'] = $this->Crud->read_data("reject_remark");
        $this->loadView('quality/final_inspection_qa', $data);
    }

    public function final_inspection()
    {
        checkGroupAccess("final_inspection","list","Yes");
        $role_management_data = $this->db->query('SELECT *  FROM `customer_part` ');
        $data['customer_part'] = $role_management_data->result();
        $role_management_data = $this->db->query('
            SELECT c.*,cp.final_inspection_location as final_inspection_location
            FROM `customer_parts_master` as c 
            LEFT JOIN customer_parts_master_stock as cp ON c.id = cp.customer_parts_master_id
            WHERE cp.clientId = "'.$this->Unit->getSessionClientId().'"
            ');
        $data['customer_parts_master'] = $role_management_data->result();
        $data['final_inspection_request'] = $this->Crud->customQuery("
            SELECT fi.*,cp.part_number as part_number,cp.part_description as part_description,cp.final_inspection_location as final_inspection_location
            FROM final_inspection_request as fi
            LEFT JOIN customer_parts_master as cp ON cp.id = fi.customer_part_id
            WHERE fi.clientId = '".$this->Unit->getSessionClientId()."'
            ORDER BY fi.id DESC
        ");
        // $this->load->view('header');
        $this->loadView('admin/molding/final_inspection', $data);
        // $this->load->view('footer');
    }

    public function part_family()
    {
        checkGroupAccess("part_family","list","Yes");
        $data['part_family'] = $this->Crud->read_data("part_family");

        // $this->load->view('header');
        $this->loadView('admin/part_family', $data);
        // $this->load->view('footer');
    }
    public function process()
    {
        checkGroupAccess("process","list","Yes");
        $data['process'] = $this->Crud->read_data("process");

        // $this->load->view('header');
        $this->loadView('admin/process', $data);
        // $this->load->view('footer');
    }
    public function customer_parts_master()
    {
        checkGroupAccess("customer_parts_master","list","Yes");
        // $data['customer_parts_master'] = $this->CustomerPart->readCustomerParts();
        // $data['grades'] = $this->Crud->read_data("grades");
        // $data['flash_err'] = $this->session->flashdata('errors');
        // $data['flash_suc'] = $this->session->flashdata('success');
        // $data['entitlements'] = $this->session->userdata['entitlements'];
        $column[] = [
            "data" => "id",
            "title" => "id",
            "width" => "0%",
            "className" => "dt-left",
            "visible" => false
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "fg_stock",
            "title" => "FG Stock",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "stock_rate",
            "title" => "Rate",
            "width" => "10%",
            "className" => "dt-center",
            
        ];
        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "17%",
            "className" => "dt-center",
            'orderable' => false
        ];
       

        // foreach ($data['customer_parts_master'] as $u) {
        //  $data['grades_data'][$u->grade_id]  = $this->Crud->get_data_by_id("grades", $u->grade_id, "id");
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
        $data["sorting_column"] = json_encode([[0, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data['part_drop_data'] = $this->welcome_model->getCustomerPartNumber();
        $data['scrap_category'] =  $this->Crud->customQuery("SELECT s.* FROM scrap_category_master s");
        $this->getPage('customer/customer_parts_master', $data);
    }

    public function getCustomerpartsAjax(){

        $customer_part_id  = $this->input->post("customer_part_id");
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
        $customer_data = $this->welcome_model->getDataForCustomerParts($condition_arr, $post_data["search"]);

        foreach ($customer_data as $key => $value) {
            $edit_data = base64_encode(json_encode($value)); 
            $customer_data[$key]['action'] = display_no_character("");
            if(checkGroupAccess("customer_parts_master","update","No")){    
             $customer_data[$key]['action'] = "<a type='button' class=' edit-part' data-bs-toggle='modal' data-bs-target='#editpart' data-value = " . $edit_data . "><i class='ti ti-edit'></i></a>";
            }

        }

        $data["data"] = $customer_data;
        $total_record = $this->welcome_model->getDataForCustomerPartsCount([], $post_data["search"]);
        
        $data["recordsTotal"] = $total_record['total_count'];
        $data["recordsFiltered"] = $total_record['total_count'];
        echo json_encode($data);
    }

    public function downtime_master()
    {
        checkGroupAccess("downtime_master","list","Yes");
        $data['downtime_master'] = $this->Crud->read_data("downtime_master");

        // $this->load->view('header');
        $this->loadView('admin/downtime_master', $data);
        // $this->load->view('footer');
    }


    public function view_challan()
    {

        // $data['planing_id'] = $this->uri->segment('2');
        // $planing_id = $this->uri->segment('2');
        // $financial_year = $this->uri->segment('2');
        // $data['planing_data'] = $this->Crud->get_data_by_id("planing_data", $planing_id, "planing_id");
        $data['challan'] = $this->Crud->read_data("challan");




        $this->load->view('header');
        $this->load->view('view_challan', $data);
        $this->load->view('footer');
    }
    public function get_access_page()
    {
        $groups  = $this->input->post("groups");
        $access_list = $this->getGroupAccessList($groups,""); 
        $access_html = '';
        foreach ($access_list as $key => $value) {
            $is_list = $value['list'] == "Yes" ? "checked='true'" : "";
            $is_add = $value['add'] == "Yes" ? "checked='true'" : "";
            $is_update = $value['update'] == "Yes" ? "checked='true'" : "";
            $is_delete = $value['delete'] == "Yes" ? "checked='true'" : "";
            $label_name = $value['diaplay_name'];
            $access_html .= "
                <div class='col-lg-12 '>
                   <div class='menu-form-row'>
                      <label class='form-label ''>
                         <lable  class='right-label-inline'>$label_name</lable>
                      </label>
                      <div class='form-right-div'>
                         <div class='margin-equilize'>
                            <input type='checkbox'  class='regular-checkbox pointer-none'  $is_list>
                            <label class='right-label-inline' >List</label>
                         </div>
                         <div class='margin-equilize'>
                            <input type='checkbox'  class='regular-checkbox pointer-none'  $is_add>
                            <label class='right-label-inline' >Add</label>
                         </div>
                         <div class='margin-equilize'>
                            <input type='checkbox'  class='regular-checkbox pointer-none'  $is_update>
                            <label class='right-label-inline' >Update</label>
                         </div>
                         <div class='margin-equilize'>
                            <input type='checkbox'  class='regular-checkbox pointer-none'  $is_delete>
                            <label class='right-label-inline' >Delete</label>
                         </div>
                      </div>
                   </div>
                </div>";
        }
        if($access_html == ""){
            $access_html = "<div>Access page not found!.</div>";
        }

        $return['access_html'] = $access_html;

        echo json_encode($return);
        exit();    
    }
    public function getGroupAccessList($groups=[],$menu_url = ""){
        $group_rights = $this->welcome_model->getGroupRightsData($groups,$menu_url);
        $group_rights_arr = [];
        foreach ($group_rights as $key => $value) {
            if(!isset($group_rights_arr[$value['menu_master_id']]) ){
                $group_rights_arr[$value['menu_master_id']]['diaplay_name'] = $value['diaplay_name'];
                $group_rights_arr[$value['menu_master_id']]['url'] = $value['url'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['list']) || (isset($group_rights_arr[$value['menu_master_id']]['list']) && $group_rights_arr[$value['menu_master_id']]['list'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['list'] = $value['list'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['add']) || (isset($group_rights_arr[$value['menu_master_id']]['add']) && $group_rights_arr[$value['menu_master_id']]['add'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['add'] = $value['add'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['update']) || (isset($group_rights_arr[$value['menu_master_id']]['update']) && $group_rights_arr[$value['menu_master_id']]['update'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['update'] = $value['update'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['delete'])  || (isset($group_rights_arr[$value['menu_master_id']]['delete']) && $group_rights_arr[$value['menu_master_id']]['delete'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['delete'] = $value['delete'];
            }
        }
        return $group_rights_arr;
    }
    public function add_users_data()
    {
            
        $ret_arr = [];
        $msg ='';
        $success = 1;
        $client_arr  = $this->input->post("client");
        $groups  = $this->input->post("groups");
        if(is_valid_array($client_arr) && is_valid_array($groups)){
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'user_email' => $this->input->post('user_email'),
                'user_password' => $this->input->post('user_password'),
                'type' => $this->input->post('user_role'),
                'unit_ids' => implode(",", $client_arr),
                'groups' => implode(",", $groups),
            );

            $inser_query = $this->Crud->insert_data("userinfo", $data);
            if ($inser_query) {
                if ($inser_query) {
                    // echo "<script>alert('User  Added Successfully');document.location='erp_users'</script>";
                    $msg = 'User Added Successfully.';
                } else {
                    // echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
                    $msg = 'Error IN User Adding ,try again.';
                    $success = 0;
                }
            } else {
                
                $msg = 'Error occer while inserting data.';
                $success = 0;
            }
        }else if(!is_valid_array($client_arr)){
            $msg = 'Please select unit.';
            $success = 0;
        }else if(!is_valid_array($groups)){
            $msg = 'Please select groups.';
            $success = 0;
        }
        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }
    public function update_users_data()
    {
        $ret_arr = [];
        $msg ='';
        $success = 1;
        $client_arr  = $this->input->post("client");
        $groups  = $this->input->post("groups");
        if(is_valid_array($client_arr) && is_valid_array($groups)){
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'unit_ids' => implode(",", $client_arr),
                'groups' => implode(",", $groups),
            );
            $id = $this->input->post("user_id");
            $result = $this->Crud->update_data("userinfo", $data, $id);
            if ($result) {
                if ($result) {
                    // echo "<script>alert('User  Added Successfully');document.location='erp_users'</script>";
                    $msg = 'User Updated Successfully.';
                } else {
                    // echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
                    $msg = 'Error IN User Updating ,try again.';
                    $success = 0;
                }
            } else {
                $msg = 'Error occer while updateing data.';
                $success = 0;
            }
        }else if(!is_valid_array($client_arr)){
            $msg = 'Please select unit.';
            $success = 0;
        }else if(!is_valid_array($groups)){
            $msg = 'Please select groups.';
            $success = 0;
        }
        $ret_arr['messages'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }




    public function addRoutingParts()
    {
        $success = 0;
        $message = "Something went wrong!";
        $data = array(
            'part_id' => $this->input->post('part_id'),
            'routing_part_id' => $this->input->post('routing_part_id'),

        );

        $data2 = array(
            'part_id' => $this->input->post('part_id'),
            'routing_part_id' => $this->input->post('routing_part_id'),
            'qty' => $this->input->post('qty'),
        );

        $routing_data = $this->Crud->read_data_where("routing", $data);

        // print_r($data);
        // echo "<br>";
        // print_r($routing_data);
        if ($routing_data) {
            $message = "already present";
            // echo "<script>alert('already present');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $inser_query = $this->Crud->insert_data("routing", $data2);

            if ($inser_query) {
                if ($inser_query) {
                    $message = "successfully added";
                    $success = 1;
                    // echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    $message = "Error IN User  Adding ,try again";
                    // echo "<script>alert('Error IN User  Adding ,try again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            } else {
                $message = "Error";
                // echo "Error";
            }
        }
        $return_arr = [
            "success" => $success,
            "messages" => $message
        ];

        echo json_encode($return_arr);
        exit;
    }
    public function editRoutingParts()
    {
        $post_data = $this->input->post();
        $success = 0;
        $message = "Something went wrong!";
        $update_data = array(
            'qty' => $post_data['qty']
        );
        $update = $this->Crud->update_data("routing", $update_data, $post_data['id']);
        if ($update) {
            $message = "Updated successfully";
            $success = 1;
                    // echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $message = "Error,try again";
            // echo "<script>alert('Error IN User  Adding ,try again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $return_arr = [
            "success" => $success,
            "messages" => $message
        ];

        echo json_encode($return_arr);
        exit;
    }
    public function addRoutingParts_subcon()
    {
        $data = array(
            'part_id' => $this->input->post('part_id'),
            'routing_part_id' => $this->input->post('routing_part_id'),
        );

        $data2 = array(
            'part_id' => $this->input->post('part_id'),
            'routing_part_id' => $this->input->post('routing_part_id'),
            'qty' => $this->input->post('qty'),
        );

        $routing_data = $this->Crud->read_data_where("routing_subcon", $data);
        $success = 0;
        $message = "Something went wrong!";
        if ($routing_data) {
            $message = "Already present";
            // echo "<script>alert('already present');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $inser_query = $this->Crud->insert_data("routing_subcon", $data2);
            if ($inser_query) {
                if ($inser_query) {
                    $success = 1;
                    $message = "Successfully added.";
                    // echo "<script>alert('successfully added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    $message = "Error IN User  Adding ,try again.";
                    // echo "<script>alert('Error IN User  Adding ,try again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            } else {
                $message = "Error.";
                // echo "Error";
            }
        }

        $return_arr = [
            "success" => $success,
            "message" => $message
        ];

        echo json_encode($return_arr);
        exit;
    }

    public function add_challan_parts_subcon()
    {

        $qty = $this->input->post('qty');
        $part_id = $this->input->post('part_id');
        $process = $this->input->post('process');

        $child_part_data = $this->SupplierParts->getSupplierPartById($part_id);

        $data = array(
            'challan_id' => $this->input->post('challan_id'),
            'part_id' => $this->input->post('part_id'),
            'qty' => $this->input->post('qty'),
            'remaning_qty' => $this->input->post('qty'),
            'process' => $process,
            'value' => $child_part_data[0]->store_stock_rate * $qty,
            'hsn' => $child_part_data[0]->hsn_code,
            "created_date" => $this->current_date,
            "created_time" => $this->current_time,
            "day" => $this->date,
            "month" => $this->month,
            "year" => $this->year,
        );

        $data2 = array(
            'challan_id' => $this->input->post('challan_id'),
            'part_id' => $this->input->post('part_id'),

        );

        // print_r($data2);
        // get_data_by_id_multiple_condition
        $challan_parts = $this->Crud->get_data_by_id_multiple_condition("challan_parts_subcon", $data2);

        $message = "Something went wrong";
        $success = 0;
        if ($challan_parts) {
            $message = "Data Already Present";
        } else {
            $child_part_data = $this->SupplierParts->getSupplierPartById($part_id);
            $current_stock = $child_part_data[0]->stock;

            if ((float)$qty > (float)$current_stock) {
                $message = "Store Stock  Qty is Less than Entered Qty";
                // echo "<script>alert('error : Store Stock  Qty is Less than Entered Qty');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $inser_query = $this->Crud->insert_data("challan_parts_subcon", $data);

                if ($inser_query) {
                    if ($inser_query) {
                        $new_stock = $current_stock - $qty;
                        $oldSubcon = $child_part_data[0]->sub_con_stock;
                        $newsubcon = $oldSubcon + $qty;
                        $data23333 = array(
                            'stock' => $new_stock,
                            'sub_con_stock' => $newsubcon,

                        );
                        $update = $this->SupplierParts->updateStockById($data23333, $part_id);

                        if ($update) {
                            $message = "Added Successfully";
                            $success = 1;
                            // echo "<script>alert('Added Successfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                        } else {
                            $message = "Error While Update Qty";
                            // echo "<script>alert('Error While Update Qty');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                        }
                    } else {
                        $message = "Error";
                    }
                } else {
                    $message = "Error";
                }
            }
        }

        $return_arr = [
            "message" =>$message,
            "success" => $success
            ];
        echo json_encode($return_arr);
        exit();
    }
    public function update_p_q()
    {

        // pr("ok",1);
        $id = $this->input->post('id');
        $p_q_main_data = $this->Crud->get_data_by_id("p_q", $id, "id");

        $qty = $this->input->post('qty');
        $accepted_qty = $this->input->post('accepted_qty');
        $rejection_reason = $this->input->post('rejection_reason');
        $rejection_remark = $this->input->post('rejection_remark');
        $output_part_id = $this->input->post('output_part_id');

        $onhold_qty = $this->input->post('onhold_qty');
        $scrap_factor = $this->input->post('scrap_factor');

        $success = 0;
        $messages = "Something went wrong.";
        if ($sum <= $qty) {

            $operations_bom = $this->Crud->get_data_by_id("operations_bom", $p_q_main_data[0]->created_by, "id");
            $operations_bom_inputs = $this->Crud->get_data_by_id("operations_bom_inputs", $operations_bom[0]->id, "operations_bom_id");
            if ($operations_bom_inputs) {
                if ($accepted_qty == 0 && $onhold_qty == 0) {
                    $rejected_qty = $qty;
                } else if ($accepted_qty == 0 && $onhold_qty > 0) {
                    $rejected_qty = $qty - $onhold_qty;
                } else if ($accepted_qty > 0 && $onhold_qty == 0) {
                    $rejected_qty = $qty - $accepted_qty;
                } else {
                    $rejected_qty = $qty - ($accepted_qty + $onhold_qty);
                }

                $data23333 = array(
                    'accepted_qty' => $accepted_qty,
                    'rejected_qty' => $rejected_qty,
                    'onhold_qty' => $onhold_qty,
                    'rejection_reason' => $rejection_reason,
                    'rejection_remark' => $rejection_remark,
                    "status" => "completed"

                );
                $update = $this->Crud->update_data("p_q", $data23333, $id);
                $p_q_data = $this->Crud->get_data_by_id("p_q", $id, "id");
                // print_r($p_q_data);
                $p_q_output_part_id = $p_q_data[0]->output_part_id;
                $p_q_output_part_table_name = $p_q_data[0]->output_part_table_name;

                $production_rejection_data = $this->CustomerPart->getCustomerPartByPartNumber("production_rejection");
                $production_scrap_data = $this->CustomerPart->getCustomerPartByPartNumber("production_scrap");

                $old_production_scrap = $production_scrap_data[0]->production_scrap;
                $old_production_rejection = $production_rejection_data[0]->production_rejection;
                $new_production_scrap = $scrap_factor + $old_production_scrap;

                if ($p_q_output_part_table_name == "inhouse_parts") {
                    $output_part_data = $this->InhouseParts->getInhousePartById($p_q_output_part_id);
                    $new_production_rejection = $old_production_rejection + ((float)$output_part_data[0]->weight * (float)$rejected_qty);
                } else {
                    $output_part_data = $this->Crud->get_data_by_id("customer_part", $p_q_output_part_id, "id");
                    $new_production_rejection = $old_production_rejection + ((float)$output_part_data[0]->finish_weight * (float)$rejected_qty);
                }


                $update_data_2_rejection = array(
                    'production_rejection' => $new_production_rejection,
                );
                $update_data_2_scrap = array(
                    'production_scrap' => $new_production_scrap,
                );

                $result1 = $this->CustomerPart->updateStockById($update_data_2_rejection, $production_rejection_data[0]->part_id);
                $result2 = $this->CustomerPart->updateStockById($update_data_2_scrap, $production_scrap_data[0]->part_id);

                if ($update) {
                    foreach ($operations_bom_inputs as $o) {
                        $insert_data = array(
                            'p_q_id' => $id,
                            'input_part_number' => $o->input_part_id,
                            'input_part_number_table_name' => $o->input_part_table_name,
                            'req_qty' => $accepted_qty * $o->qty,
                            "created_date" => $this->current_date,
                            "created_time" => $this->current_time,
                            "day" => $this->date,
                            "month" => $this->month,
                            "year" => $this->year,
                        );
                        $inser_query = $this->Crud->insert_data("p_q_history", $insert_data);
                    }

                    $production_rejection_data = $this->CustomerPart->getCustomerPartByPartNumber("production_rejection");
                    $production_scrap_data = $this->CustomerPart->getCustomerPartByPartNumber("production_scrap");
                    $old_production_scrap = $production_scrap_data[0]->production_scrap;

                    $old_production_rejection = $production_rejection_data[0]->production_rejection;

                    $new_production_scrap = $scrap_factor + $old_production_scrap;



                    if ($operations_bom[0]->output_part_table_name == "inhouse_parts") {
                        $output_part_data = $this->InhouseParts->getInhousePartById($output_part_id);
                        $previous_production_qty = $output_part_data[0]->production_qty;
                        $new_production_qty = $previous_production_qty + $accepted_qty;
                        $update_data = array(
                            'production_qty' => $new_production_qty,
                        );
                        $new_production_rejection = $old_production_rejection + ((float)$output_part_data[0]->weight * (float)$rejected_qty);
                        $update = $this->InhouseParts->updateStockById($update_data, $output_part_data[0]->id);
                        // echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                        $messages = 'Updated Successfully';
                        $success = 1;
                    } else {

                        $output_part_data = $this->Crud->get_data_by_id("customer_part", $output_part_id, "id");
                        $customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($output_part_data[0]->part_number);
                        $previous_production_qty = $customer_parts_master_data[0]->fg_stock;
                        $new_fg_stock = $previous_production_qty + $accepted_qty;
                        $update_data_2 = array(
                            'fg_stock' => $new_fg_stock,

                        );
                        $new_production_rejection = $old_production_rejection + ((float)$output_part_data[0]->weight * (float)$rejected_qty);
                        $update = $this->CustomerPart->updateStockById($update_data_2, $customer_parts_master_data[0]->part_id);
                        $messages = "Updated Successfully ";
                        $success = 1;
                        // echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                    }
                } else {
                    $messages ="error while updating";
                }
            } else {
                $messages = "Operations BOM Not Found";
            }
        } else {
            $messages = "mismatvhe";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function update_parts_rejection_sales_invoice()
    {

        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $accepted_qty = $this->input->post('accepted_qty');
        $rejection_reason = $this->input->post('rejection_reason');
        $rejection_remark = $this->input->post('rejection_remark');
        $customer_part_id = $this->input->post('customer_part_id');


        $customer_part_id_data = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
        $old_stock = $customer_part_id_data[0]->fg_stock;
        $new_stock = $old_stock + $accepted_qty;

        if ($accepted_qty == 0) {
            $rejected_qty = $qty;
        } else {
            $rejected_qty = $qty - $accepted_qty;
        }

        $data23333 = array(
            'accepted_qty' => $accepted_qty,
            'rejected_qty' => $rejected_qty,
            'rejection_reason' => $rejection_reason,
            'rejection_remark' => $rejection_remark,
            "status" => "completed"

        );
        $update_customer_part = array(
            "fg_stock" => $new_stock,
        );
        $messages = "";
        $success = 0;
        $update = $this->Crud->update_data("parts_rejection_sales_invoice", $data23333, $id);
        $update2 = $this->Crud->update_data("customer_part", $update_customer_part, $customer_part_id);
        if ($update) {
            $messages = "Updated Successfully ";
            $success = 1;
            // echo "<script>alert('Updated Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages = "error";
            // echo "error";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }






    public function update_p_q_qty()
    {

        $id = $this->input->post('id');
        $qty = $this->input->post('qty');

        $data23333 = array(
            'qty' => $qty,

        );

        $update = $this->Crud->update_data("p_q", $data23333, $id);

        if ($update) {
            echo "<script>alert('Qty Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Error While Updating ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    public function add_process_name()
    {

        $data = array(
            'name' => $this->input->post('namess'),
        );
        
        $ret_arr = [];
        $success = 1;
        $msg = '';
        $inser_query = $this->Crud->insert_data("process", $data);

        if ($inser_query) {



            if ($inser_query) {
                // echo "<script>alert('Process added');document.location='process'</script>";
                $msg = 'Process added successfully.';
            } else {
                // echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
                $msg = 'Error IN User  Adding ,try again.';
                $success = 0;
            }
        } else {
            // echo "Error";
            $msg = 'Error.';
        }
        $ret_arr['success'] = $success;
        $ret_arr['msg'] = $msg;
        echo json_encode($ret_arr);
    }
    public function add_customer_parts_master()
    {
        // pr($this->input->post(),1);
        $part_number = trim($this->input->post('part_number'));
        $part_description = trim($this->input->post('part_description'));
        $fg_rate = $this->input->post('fg_rate');

        $data = array(
            "part_number" => $part_number,
        );
        $check = $this->Crud->read_data_where("customer_parts_master", $data);
        $success = 0;
        $message = "Somthing went wrong";
        if ($check != 0) {
            // $data = array(
            //  'errors' => $part_number . ' : This Part Number Already Present, Please Enter Different Part Number',
            // );
            $message = $part_number . ' : This Part Number Already Present, Please Enter Different Part Number';
            // $this->session->set_flashdata($data);
            // redirect($_SERVER['HTTP_REFERER']);
        } else {

            $data = array(
                'part_number' => trim($part_number),
                'part_description' => trim($part_description),
                'fg_rate' => $fg_rate,
                "part_type" => $this->input->post("part_type"),
                "scrap_category_id" => $this->input->post("scrap_category") > 0 ? $this->input->post("scrap_category"): 0,
            );
            
            $inser_query = $this->CustomerPart->createCustomerPart($data);
            if ($inser_query) {
               
                // $data = array(
                //  'success' => 'Data Added Successfully  !!',
                // );
                $success = 1;
                $message = "Data Added Successfully  !!";
                // $this->session->set_flashdata($data);
                // redirect($_SERVER['HTTP_REFERER']);
            } else {
                // $data = array(
                //  'errors' => 'Error While adding, please try again !',
                // );
                $message ="Error While adding, please try again !";
                // $this->session->set_flashdata($data);
                // redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $ret_arr['message'] = $message;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
        exit();
    }
    public function add_downtime_name()
    {

        $data = array(
            'name' => $this->input->post('namess'),
        );
        $ret_arr = [];
        $msg = '';
        $success = 1;
        $inser_query = $this->Crud->insert_data("downtime_master", $data);
        if ($inser_query) {
            if ($inser_query) {
                // echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                $msg = 'Downtime added Successfully';
            } else {
                // echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
                $msg = 'Error IN User  Adding ,try again';
                $success = 0;
            }
        } else {
            echo "Unable to add downtime";
            $success = 0;
        }
        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }





    public function _mold_maintenance($filter_child_part_id)
    {
        $data['filter_child_part_id'] = $filter_child_part_id;
        $data['mold_maintenance'] = $this->Crud->read_data("mold_maintenance");
        $data['customer_part'] = $this->Crud->read_data("customer_part");

        $this->load->view('header');
        $this->load->view('mold_maintenance', $data);
        $this->load->view('footer');
    }



    public function add_part_family()
    {

        $ret_arr = [];
        $success = 1;
        $msg = '';

        $data = array(
            'name' => $this->input->post('name'),
        );

        $inser_query = $this->Crud->insert_data("part_family", $data);

        if ($inser_query) {

            if ($inser_query) {
                // echo "<script>alert('Part Family added');document.location='part_family'</script>";
                $msg = 'Part Family added successfully.';
            } else {
                // echo "<script>alert('Error While  Adding ,try again');document.location='erp_users'</script>";
                $msg = 'Error While  Adding ,try again.';
                $success = 0;
            }
        } else {
            $msg = 'Unable to add part family.';
            $success = 0;
        }
        $ret_arr['msg'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }
    public function add_asset()
    {

        $data = array(
            'name' => $this->input->post('name'),
        );

        $inser_query = $this->Crud->insert_data("asset", $data);

        if ($inser_query) {
            if ($inser_query) {
                echo "<script>alert('Added Successfully ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";

                // echo "<script>alert('Added Successfully');document.location='erp_users'</script>";
            } else {
                echo "<script>alert('Error while Adding ,try again');document.location='erp_users'</script>";
            }
        } else {
            echo "Error";
        }
    }


    public function job_card()
    {
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['job_card'] = $this->Crud->read_data("job_card");
        $data['customer_part'] = $this->Crud->read_data("customer_part");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
        // $data['customer_part_list'] = $role_management_data->result();

        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('job_card', $data);
        $this->load->view('footer');
    }
    public function stock_rejection()
    {
        checkGroupAccess("stock_rejection","list","Yes");
        $data['child_part'] = $this->SupplierParts->readSupplierParts();
        $data['supplier'] = $this->Crud->read_data("supplier");
        $data['rejection_flow'] = $this->Crud->customQuery("SELECT r.*, c.part_number, c.part_description,s.supplier_name FROM rejection_flow r
        INNER JOIN supplier s ON r.supplier_id = s.id
        INNER JOIN child_part c ON r.part_id = c.id
        WHERE r.type = 'stock_rejection'
        AND clientId =".$this->Unit->getSessionClientId());
        $this->loadView('store/stock_rejection', $data);
    }


    public function grn_rejection()
    {
        checkGroupAccess("grn_rejection","list","Yes");
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        // $data['child_part'] = $this->SupplierParts->readSupplierParts();
        //$data['supplier'] = $this->Crud->read_data("supplier");
        $data['rejection_flow'] = $this->Crud->customQuery("SELECT *
                    FROM `rejection_flow` r
                    INNER JOIN supplier s ON r.supplier_id = s.id
                    INNER JOIN child_part p ON r.part_id = p.id
                    WHERE r.clientId = ".$this->Unit->getSessionClientId()."
                    AND r.type = 'grn_rejection'
                    ORDER BY r.id DESC");

        // $this->load->view('header');
        $this->loadView('quality/grn_rejection', $data);
        // $this->load->view('footer');
    }
    public function short_receipt_mdr()
    {
        checkGroupAccess("short_receipt","list","Yes");
        $data['child_part'] = $this->SupplierParts->readSupplierParts();
        // pr($data['child_part'],1);
        $data['supplier'] = $this->Crud->read_data("supplier");
        $data['rejection_flow'] = $this->Crud->customQuery("
            SELECT r.*,cp.part_number as part_number,cp.part_description as part_description,s.supplier_name as supplier_name
            FROM `rejection_flow` as r
            LEFT JOIN child_part as cp ON cp.id = r.part_id
            LEFT JOIN supplier as s ON s.id = r.supplier_id
            WHERE r.clientId = '1'
            ORDER BY `id` DESC
        ");
        // pr($data['rejection_flow'],1);

        // $this->load->view('header');
        $this->loadView('store/short_receipt_mdr', $data);
        // $this->load->view('footer');
    }
    public function job_card_released()
    {
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['job_card'] = $this->Crud->read_data("job_card");
        $data['customer_part'] = $this->Crud->read_data("customer_part");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
        // $data['customer_part_list'] = $role_management_data->result();

        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('job_card_released', $data);
        $this->load->view('footer');
    }

    public function sales_invoice_released_subcon()
    {
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        // $data['job_card'] = $this->Crud->read_data("job_card");
        // $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data['new_sales_subcon'] = $this->Crud->read_data("new_sales_subcon");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
        // $data['customer_part_list'] = $role_management_data->result();

        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('sales_invoice_released_subcon', $data);
        $this->load->view('footer');
    }
    public function job_card_closed()
    {
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['job_card'] = $this->Crud->read_data("job_card");
        $data['customer_part'] = $this->Crud->read_data("customer_part");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
        // $data['customer_part_list'] = $role_management_data->result();

        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('job_card_closed', $data);
        $this->load->view('footer');
    }
    public function job_card_issued()
    {
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['job_card'] = $this->Crud->read_data("job_card");
        $data['customer_part'] = $this->Crud->read_data("customer_part");

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM `customer_part` ');
        // $data['customer_part_list'] = $role_management_data->result();

        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('job_card_issued', $data);
        $this->load->view('footer');
    }


    public function view_job_card_details()
    {
        $job_card_id = $this->uri->segment('2');
        $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
        $data['job_card_details_operations'] = $this->Crud->get_data_by_id("job_card_details_operations", $data['job_card'][0]->id, "job_card_id");
        $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
        $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
        $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
        $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
        $data['bom_data'] = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");

        $role_management_data = $this->db->query('SELECT operation_id,id  FROM `customer_part_operation` WHERE customer_master_id = ' . $data['job_card'][0]->customer_part_id . ' ORDER BY `id` DESC');
        $data['customer_part_operation'] = $role_management_data->result();


        // print_r($data['customer_part_operation_forploop']);
        $this->load->view('header');
        $this->load->view('view_job_card_details', $data);
        $this->load->view('footer');
    }
    public function view_job_card_details_released()
    {
        $job_card_id = $this->uri->segment('2');
        //$data['job_card_details_operations'] = $this->Crud->get_data_by_id("job_card_details_operations", $job_card_id, "job_card_id");

        //$data['job_card_details_data'] = $this->Crud->get_data_by_id("job_card_details", $job_card_id, "job_card_id");
        $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        //$data['job_card_prod_qty'] = $this->Crud->get_data_by_id("job_card_prod_qty", $job_card_id, "job_card_id");
        $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
        //$data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
        //$data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
        //$data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
        $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
        $data['bom_data'] = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");

        // $data['operations'] = $this->Crud->read_data("operations");
        //$data['reject_remark'] = $this->Crud->read_data("reject_remark");
        $role_management_data = $this->db->query('SELECT  operation_id,id  FROM `customer_part_operation` WHERE customer_master_id = ' . $data['job_card'][0]->customer_part_id . ' ORDER BY `operation_id` ASC');
        // echo 'SELECT  operation_id,id  FROM `customer_part_operation` WHERE customer_master_id = ' . $data['job_card'][0]->customer_part_id . ' ORDER BY `operation_id` ASC';
        $data['customer_part_operation'] = $role_management_data->result();
        // print_r($data['customer_part_operation']);
        //print_r(($data['job_card'][0]->customer_part_id));
        $this->load->view('header');
        $this->load->view('view_job_card_details_released', $data);
        $this->load->view('footer');
    }

    public function view_job_card_details_issued()
    {
        $job_card_id = $this->uri->segment('2');
        $data['job_card_details_operations'] = $this->Crud->get_data_by_id("job_card_details_operations", $job_card_id, "job_card_id");

        $data['job_card_details_data'] = $this->Crud->get_data_by_id("job_card_details", $job_card_id, "job_card_id");
        $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        $data['job_card_prod_qty'] = $this->Crud->get_data_by_id("job_card_prod_qty", $job_card_id, "job_card_id");
        $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
        $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
        $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
        $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
        $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
        $data['bom_data'] = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");

        // $data['operations'] = $this->Crud->read_data("operations");
        $data['reject_remark'] = $this->Crud->read_data("reject_remark");
        $role_management_data = $this->db->query('SELECT DISTINCT operation_id,id  FROM `customer_part_operation` WHERE customer_master_id = ' . $data['job_card'][0]->customer_part_id . ' ORDER BY `operation_id` ASC');
        $data['operations_new'] = $role_management_data->result();
        // print_r($data['operations']);
        $this->load->view('header');
        $this->load->view('view_job_card_details_issued', $data);
        $this->load->view('footer');
    }
    public function view_job_card_details_issued_new()
    {
        $job_card_id = $this->uri->segment('2');
        $operation_id = $this->uri->segment('3');
        $data['operation_id'] = $this->uri->segment('3');
        $data['main_prod_qty'] = $this->uri->segment('4');
        $data['job_card_details_operations'] = $this->Crud->get_data_by_id("job_card_details_operations", $job_card_id, "job_card_id");

        $data['job_card_details_data'] = $this->Crud->get_data_by_id("job_card_details", $job_card_id, "job_card_id");
        $data['operations_data_new'] = $this->Crud->get_data_by_id("operations", $operation_id, "id");
        $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        $data['job_card_prod_qty'] = $this->Crud->get_data_by_id("job_card_prod_qty", $job_card_id, "job_card_id");
        $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
        $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
        $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
        $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
        $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
        $data['bom_data'] = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");

        // $data['operations'] = $this->Crud->read_data("operations");
        $data['reject_remark'] = $this->Crud->read_data("reject_remark");
        $role_management_data = $this->db->query('SELECT DISTINCT operation_id  FROM `customer_part_operation` WHERE customer_master_id = ' . $data['job_card'][0]->customer_part_id . ' ORDER BY `operation_id` ASC');
        $data['operations_new'] = $role_management_data->result();
        // print_r($data['operations']);
        $this->load->view('header');
        $this->load->view('view_job_card_details_issued_new', $data);
        $this->load->view('footer');
    }


    public function view_job_card_details_closed()
    {
        $job_card_id = $this->uri->segment('2');
        $data['job_card_details_data'] = $this->Crud->get_data_by_id("job_card_details", $job_card_id, "job_card_id");
        $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        $data['job_card_prod_qty'] = $this->Crud->get_data_by_id("job_card_prod_qty", $job_card_id, "job_card_id");
        $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
        $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
        $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
        $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
        $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
        $data['bom_data'] = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");

        $data['operations'] = $this->Crud->read_data("operations");

        // print_r($data['operations']);
        $this->load->view('header');
        $this->load->view('view_job_card_details_closed', $data);
        $this->load->view('footer');
    }


    public function customer_part_price_by_id()
    {

        $customer_id = $this->uri->segment('2');
        $data['customer_id'] = $this->uri->segment('2');
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        // $data['customer_part_list'] = "";

        $role_management_data = $this->db->query('SELECT DISTINCT customer_master_id FROM `customer_part_rate`  ORDER BY `id` DESC');
        $data['customer_part_rate'] = $role_management_data->result();

        // print_r($data['customer_part_list']);

        if ($data['customer_part']) {
            foreach ($data['customer_part'] as $c) {
                if ($customer_id == $c->customer_id) {
                    $data['customer'][$c->customer_id] = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                    // $data['customer_part_type'][$c->customer_part_id] = $this->Crud->get_data_by_id("customer_part_type", $c->customer_part_id, "id");
                }
            }
        }
        
        
        foreach ($data['customer_part_rate'] as $poo ) {

            $data['customer_part_rate_data'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part_rate", $poo->customer_master_id, "customer_master_id");
            $data['po'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
            $data['customer_data'][$data['po'][$poo->customer_master_id][0]->customer_id] = $this->Crud->get_data_by_id("customer", $data['po'][$poo->customer_master_id][0]->customer_id, "id");
            $data['customer_part_data'][$data['po'][$poo->customer_master_id][0]->customer_part_id] = $this->Crud->get_data_by_id("customer_part_type", $data['po'][$poo->customer_master_id][0]->customer_part_id, "id");
            $data['customer_part_rate'][$poo->customer_master_id]->encoded_data = base64_encode(json_encode($data['po'][$poo->customer_master_id][0]));
            // $data['customer_part_rate_data'][$poo->customer_master_id]
            $data['customer_part_rate_data'][$poo->customer_master_id][0]->part_number = $data['po'][$poo->customer_master_id][0]->part_number;
            $data['customer_part_rate_data'][$poo->customer_master_id][0]->part_description = $data['po'][$poo->customer_master_id][0]->part_description;
            
        }
        // pr($data['customer_part_rate'],1);
        
        // pr($data['customer_data'],1);
        // $this->load->view('header');
        // $this->load->view('customer_part_price_by_id', $data);
        // $this->load->view('footer');
        
        $this->loadView('customer/customer_part_price_by_id',$data);
    }
    public function customer_part_operation_by_id()
    {
        //$customer_id = $this->uri->segment('2');
        $part_id = $this->uri->segment('3');
        $data['customer_id'] = $this->uri->segment('2');
        //$data['part_number'] = $this->uri->segment('3');
        $data['part_id'] = $part_id;

        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        // $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data['operations'] = $this->Crud->read_data("operations");
        // $data['customer_part_list'] = "";

        // $role_management_data = $this->db->query('SELECT DISTINCT part_number FROM  `customer_part`  ORDER BY `id` DESC');
        // $data['customer_part_rate_new'] = $role_management_data->result();
        $role_management_data = $this->db->query('
            SELECT DISTINCT cpp.*,cpp.name as name_val,p.name,cp.customer_id,c.customer_name,cp.part_number,cp.part_description,cp.id as customer_part_id
            FROM `customer_part_operation` as cpp
            LEFT JOIN operations as p ON p.id = cpp.operation_id
            LEFT JOIN customer_part as cp ON cp.id = cpp.customer_master_id
            LEFT JOIN customer as c ON c.id = cp.customer_id
            WHERE cpp.customer_master_id =' . $part_id . '  ORDER BY `id` ASC
        ');
        $data['customer_part_rate'] = $role_management_data->result();
        // pr($data['customer_part_rate'],1);
        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['part_id'], "id");

        // print_r($data['customer_part']);
        // $this->load->view('header');
        $this->loadView('sales/customer_part_operation_by_id', $data);
        // $this->load->view('footer');
    }
    public function add_operation_details()
    {
        $customer_part_operation_id = $this->uri->segment('2');
        $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $customer_part_operation_id, "id");
        // echo $customer_part_operation_id;
        $data['customer_part_operation_data'] = $this->Crud->get_data_by_id_asc("customer_part_operation_data", $customer_part_operation_id, "customer_part_operation_id");
        $data['operation_data'] = $this->Crud->read_data("operation_data");

        // customer_part_operation_data
        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('add_operation_details', $data);
        $this->load->view('footer');
    }
    public function view_part_rate_history()
    {
        $customer_master_id = $this->uri->segment('2');
        $data['customer_master_id'] = $this->uri->segment('2');
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data['customer_part_rate'] = $this->Crud->get_data_by_id("customer_part_rate", $customer_master_id, "customer_master_id");

        if ($data['customer_part']) {
            foreach ($data['customer_part'] as $c) {
                if ($customer_id == $c->customer_id) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                    $data['customer'][$c->customer_id] = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                }
            }
        }

        if ($data['customer_part_rate']) {
            foreach ($data['customer_part_rate'] as $poo) {
                // echo $poo->part_number;
                $data['customer_part_rate_data'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part_rate", $poo->customer_master_id, "customer_master_id");
                $data['po'][$poo->customer_master_id] = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
                $data['customer_data'][$data['po'][$poo->customer_master_id][0]->customer_id] = $this->Crud->get_data_by_id("customer", $data['po'][$poo->customer_master_id][0]->customer_id, "id");
                $data['customer_part_data'][$data['po'][$poo->customer_master_id]] = $this->Crud->get_data_by_id("customer_part_type", [$data['po'][$poo->customer_master_id]][0]->customer_part_id, "id");
            }
        }

        // $this->load->view('header');
        // $this->load->view('view_part_rate_history', $data);
        // $this->load->view('footer');
        $this->loadView('customer/view_part_rate_history',$data);
    }

    public function view_part_operation_history()
    {
        $customer_master_id = $this->uri->segment('2');
        $data['customer_master_id'] = $this->uri->segment('2');
        $data['customer_id'] = $this->uri->segment('2');
        $data['operation_id'] = $this->uri->segment('3');

        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        // $data['customer_part_list'] = "";



        $role_management_data = $this->db->query('
            SELECT cpp.*,p.name as operation_name_val,cp.part_description,cp.part_number,c.customer_name
            FROM `customer_part_operation` as cpp
            LEFT JOIN operations as p ON p.id = cpp.operation_id
            LEFT JOIN customer_part as cp ON cp.id = cpp.customer_master_id
            LEFT JOIN customer as c ON c.id = cp.customer_id
            WHERE `customer_master_id` = 107
            ORDER BY `id` DESC
        ');
        $data['customer_part_rate'] = $role_management_data->result();

        // $this->load->view('header');
        $this->loadView('sales/view_part_operation_history', $data);
        // $this->load->view('footer');
    }
    public function customer_price()
    {
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        // $data['customer_part_list'] = "";

        $role_management_data = $this->db->query('SELECT DISTINCT customer_master_id FROM `customer_part_rate` ');
        $data['customer_part_rate'] = $role_management_data->result();

        // print_r($data['customer_part_list']);
        $this->load->view('header');
        $this->load->view('customer_price', $data);
        $this->load->view('footer');
    }



    public function insert()
    {
        $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");

        $this->load->view('header');
        $this->load->view('insert', $data);
        $this->load->view('footer');
    }

    public function tool_with_insert()
    {
        $data['toolList'] = $this->Crud->get_data_by_id("tools", "tool_with_insert", "type");

        $this->load->view('header');
        $this->load->view('tool_with_insert', $data);
        $this->load->view('footer');
    }
    public function singlerequesrreasons()
    {
        $data['requestList'] = $this->Crud->read_data("single_r_r");


        $this->load->view('header');
        $this->load->view('singlerequesrreasons', $data);
        $this->load->view('footer');
    }

    public function source_list()
    {
        $data['source_list'] = $this->Crud->get_data_by_id("c_source_supplier", "source", "type");
        $this->load->view('header');
        $this->load->view('source_list', $data);
        $this->load->view('footer');
    }

    public function store_stock()
    {
        // $data['consumable_item'] = $this->Crud->get_data_by_id("c_source_supplier", "source", "type");
        $data['consumable_item_details'] = $this->Crud->read_data("consumable_item");
        $data['inward_quantity'] = $this->Crud->read_data("store");
        $data['issue_quantity'] = $this->Crud->read_data("issue");
        $this->load->view('header');
        $this->load->view('store_stock', $data);
        $this->load->view('footer');
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $table_name = $this->input->post('table_name');

        $data = array(
            "id" => $id
        );
        $result = $this->Crud->delete_data($table_name, $data);
        $message ="Something went wrong!";
        $success = 0;
        if ($result) {
            $message ="Record deleted successfully.";
            $success = 1;
        }
        $return_arr = [
            "message" =>$message,
            "messages" =>$message,
            "success" => $success
            ];
        echo json_encode($return_arr);
        exit();
        /*if ($result) {
            echo "<script>alert(' Deleted Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert(' Not Deleted');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }*/
    }

    public function delete_po()
    {
        $id = $this->input->post('id');
        $table_name = $this->input->post('table_name');

        $data = array(
            "id" => $id
        );
        $result = $this->Crud->delete_data($table_name, $data);
        $messages = "";
        $success = 0;
        if ($result) {
            $data2 = array(
                "po_id" => $id
            );
            $result2 = $this->Crud->delete_data("po_parts", $data2);
            $messages = "Deleted Sucessfully";
            $success = 1;
            // echo "<script>alert(' Deleted Sucessfully');document.location='" . base_url('new_po_list_supplier') . "'</script>";
        } else {
            $messages = "Not Deleted";
            // echo "<script>alert(' Not Deleted');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $return_arr = [];
        $return_arr['messages'] = $messages;
        $return_arr['success'] = $success;

        echo json_encode($return_arr);

        exit();
    }


    public function addContractor()
    {
        $name = $this->input->post('contractorName');
        $number = $this->input->post('contractorCode');
        $data = array(
            "contractor_code" => $number,
        );
        $check = $this->Crud->read_data_where("contractor", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "contractor_name" => $name,
                "contractor_code" => $number,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("contractor", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_operation_bom_data()
    {
        $output_part_id = $this->input->post('output_part_id');
        $input_part_id = $this->input->post('input_part_id');
        $number = $this->input->post('contractorCode');
        $qty = $this->input->post('qty');
        $out_part_table_name = "";
        $input_part_table_name = "";
        $customer_id = "";
        $data = array(
            "contractor_code" => $number,
        );
        $check = $this->Crud->read_data_where("contractor", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "output_part_id" => $output_part_id,
                "out_part_table_name" => $out_part_table_name,
                "input_part_id" => $input_part_id,
                "input_part_table_name" => $input_part_table_name,
                "qty" => $qty,
                "customer_id" => $customer_id,
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
                "day" => $this->date,
                "month" => $this->month,
                "year" => $this->year,
            );

            $result = $this->Crud->insert_data("contractor", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_rejection_new()
    {
        $rejection_flow_new_id = $this->input->post('rejection_flow_new_id');
        $type = $this->input->post('type');
        $part_number = $this->input->post('part_number');
        $qty = $this->input->post('qty');

        $data = array(
            "rejection_flow_new_id" => $rejection_flow_new_id,
            "type" => $type,
            "part_number" => $part_number,
            "qty" => $qty,
        );

        $result = $this->Crud->insert_data("new_rejection_flow_parts", $data);
        if ($result) {
            echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }
    public function add_sharing_bom()
    {
        $name = $this->input->post('name');
        $output_part_id = $this->input->post('output_part_id');
        $input_part_id = $this->input->post('input_part_id');
        $number = $this->input->post('contractorCode');
        $qty = $this->input->post('qty');
        $scrap_factor = $this->input->post('scrap_factor');
        $out_part_table_name = "";
        $input_part_table_name = "";
        $customer_id = "";
        $data = array(
            "name" => $name,
            "output_part_id" => $output_part_id,
        );

        $check = $this->Crud->read_data_where("sharing_bom", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "name" => $name,
                "qty" => $qty,
                "output_part_id" => $output_part_id,
                "output_part_table_name" => "child_part",
                "input_part_id" => $input_part_id,
                "scrap_factor" => $scrap_factor,
                "input_part_table_name" => "child_part",
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
                "day" => $this->date,
                "month" => $this->month,
                "year" => $this->year,
                "created_id" => $this->user_id,

            );

            $result = $this->Crud->insert_data("sharing_bom", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }



    public function addpartType()
    {
        $name = $this->input->post('parttypeName');
        $data = array(
            "part_type_name" => $name,
        );
        $check = $this->Crud->read_data_where("part_type", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "part_type_name" => $name,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("part_type", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_rejection_flow()
    {
        $name = $this->input->post('parttypeName');
        $type = $this->input->post('type');
        $grn_number = $this->input->post('grn_number');
        $po_number = $this->input->post('po_number');
        if (empty($type)) {
            $type = "stock_rejection";
        }

        if (!empty($_FILES['uploading_document']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['uploading_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('uploading_document')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
            } else {
                $picture4 = '';
                // echo "no 1";
            }
        } else {
            $picture4 = '';
            // echo "no 2";
        }
        $qty = $this->input->post('qty');
        $supplier_id = $this->input->post('supplier_id');
        $part_id = $this->input->post('part_id');
        $data_old = array(
            'supplier_id' => $supplier_id,
            'child_part_id' => $part_id,
        );

        $child_part_data_new = $this->SupplierParts->getSupplierPartById($part_id);
        $data_old_po_number = array(
            'po_number' => $po_number,
            'part_id' => $part_id,
        );

        $grn_details_data = $this->Common_admin_model->get_data_by_id_multiple_condition("grn_details", $data_old_po_number);
        if ($grn_details_data) {
            $invoice_number = $grn_details_data[0]->invoice_number;
        } else {
            $invoice_number = "";
        }

        $new_po_data = $this->Crud->get_data_by_id("new_po", $po_number, "po_number");

        if ((float)$qty > (float)$child_part_data_new[0]->stock && $type == "stock_rejection") {
            $success = 0;
            $messages = " Error 401 : Entered Qty Is Greater Than Store Stock , Please Enter Less Qty !!!!";
            // echo "<script>alert('Error 401 : Entered Qty Is Greater Than Store Stock , Please Enter Less Qty !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $child_part_maste_data = $this->Common_admin_model->get_data_by_id_multiple_condition("child_part_master", $data_old);

            $rate = $child_part_maste_data[0]->part_rate;
            $gst_id = $child_part_maste_data[0]->gst_id;
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $gst_id, "id");
            if ((float)$gst_structure_data[0]->igst === 0) {
                $gst = (float)$gst_structure_data[0]->cgst + (float)$gst_structure_data[0]->sgst;
                $cgst = (float)$gst_structure_data[0]->cgst;
                $sgst = (float)$gst_structure_data[0]->sgst;
                $igst = 0;
                $tcs = (float)$gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $total_gst_percentage = $cgst + $sgst;
            } else {
                $gst = (float)$gst_structure_data[0]->igst;
                $cgst = 0;
                $sgst = 0;
                $igst = $gst;
                $tcs = (float)$gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $total_gst_percentage = $igst;
            }
            $gst_amount = ($gst * $rate) / 100;
            $final_amount = $gst_amount + $rate;
            $final_row_amount = $final_amount * $qty;
            $total_amount = $qty * $rate;
            $final_total = $total_amount;
            $cgst_amount = (($total_amount * $cgst) / 100);
            $sgst_amount =  (($total_amount * $sgst) / 100);
            $igst_amount = (($total_amount * $igst) / 100);

            if ($gst_structure_data[0]->tcs_on_tax == "no") {
                $tcs_amount =  (($total_amount * $tcs) / 100);
            } else {
                $tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);
            }

            $data = array(
                "type" => $type,
                "status" => "pending",
                "reason" => "",
                "reason" => "",
                "supplier_id" => $this->input->post('supplier_id'),
                "remark" => $this->input->post('remark'),
                "reason" => $this->input->post('reason'),
                "debit_note" => $picture4,
                "qty" => $this->input->post('qty'),
                "part_id" => $this->input->post('part_id'),
                "po_number" => $po_number,
                "po_date" => $new_po_data[0]->po_date,
                "invoice_number" => $invoice_number,
                "rate" => $rate,
                "cgst" => round($cgst_amount,2),
                "sgst" => round($sgst_amount,2),
                "igst" => round($igst_amount,2),
                "tcs" => round($tcs_amount,2),
                "grn_number" => $grn_number,
                "subtotal" => round($total_amount,2),
                "grandtotal" => round($final_total,2),
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
                "created_user" => $this->user_id,
                "clientId" => $this->Unit->getSessionClientId(),
            );

            if (false) {
                $success = 0;

                $messages = " Already Exists.";
                // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {

                $result = $this->Crud->insert_data("rejection_flow", $data);
                // if ($result) {
                //  echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                // } else {
                //  echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                // }
                if ($result) {
                    $success = 1;
                    $messages = " Added successfully.";
                } else {
                    $success = 0;
                    $messages = "Unable to add.";

                }
            }
        }
        $return_arr = [];
        $return_arr['messages'] = $messages;
        $return_arr['success'] = $success;

        echo json_encode($return_arr);

        exit();

    }

    public function add_stock_down()
    {
        $name = $this->input->post('parttypeName');
        $type = $this->input->post('type');
        $po_number = $this->input->post('po_number');
        if (empty($type)) {
            $type = "stock_rejection";
        }

        if (!empty($_FILES['uploading_document']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['uploading_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('uploading_document')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
            } else {
                $picture4 = '';
                echo "no 1";
            }
        } else {
            $picture4 = '';
            echo "no 2";
        }
        $qty = $this->input->post('qty');

        $part_id = $this->input->post('part_id');

        $data_new = array(
            "id" => $part_id,
        );

        if (false) {
            echo "<script>alert('Error 401 : Entered Qty Is Greater Than Store Stock , Please Enter Less Qty !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $child_part_maste_data = $this->SupplierParts->getSupplierPartById($part_id);

            $new_stock = $child_part_maste_data[0]->stock - $qty;


            $data = array(
                "stock" => $new_stock,
            );
            if (false) {
                echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {

                $result2 = $this->SupplierParts->updateStockById($data, $part_id);

                if ($result2) {
                    echo "<script>alert('Added Sucessfully..');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            }
        }
    }
    public function addCustomerType()
    {
        $name = $this->input->post('customerPartName');
        $data = array(
            "customer_type_name" => $name,
        );
        $check = $this->Crud->read_data_where("customer_part_type", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "customer_type_name" => $name,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("customer_part_type", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_customer_price()
    {

        $customer_master_id = $this->input->post('customer_master_id');
        $rate = $this->input->post('rate');
        $revision_no = $this->input->post('revision_no');
        $revision_date = $this->input->post('revision_date');
        $revision_remark = $this->input->post('revision_remark');
        $uploading_document = $this->input->post('uploading_document');
        $customer_part_id = $this->input->post('customer_master_id');
        $data = array(
            "customer_master_id" => $customer_part_id,
            "revision_no" => $revision_no,
        );
        $success = 0;
        $messages = "Something went wrong.";
        $check = $this->Crud->read_data_where("customer_part_rate", $data);
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            if (!empty($_FILES['uploading_document']['name'])) {
                $image_path = "./documents/";
                $config['allowed_types'] = '*';
                $config['upload_path'] = $image_path;
                $config['file_name'] = $_FILES['uploading_document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('uploading_document')) {
                    $uploadData = $this->upload->data();
                    $picture4 = $uploadData['file_name'];
                } else {
                    $picture4 = '';
                    // echo "no 1";
                }
            } else {
                $picture4 = '';
                // echo "no 2";
            }

            // echo "picture4: " . $picture4;

            $data = array(
                "rate" => $rate,
                "customer_master_id" => $customer_master_id,
                "revision_no" => $revision_no,
                "revision_date" => $revision_date,
                "revision_remark" => $revision_remark,
                "uploading_document" => $picture4,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("customer_part_rate", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success = 1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function add_customer_operation()
    {
        
        $customer_master_id = $this->input->post('customer_master_id');
        $operation_id = $this->input->post('operation_id');
        $revision_no = $this->input->post('revision_no');
        $revision_date = $this->input->post('revision_date');
        $revision_remark = $this->input->post('revision_remark');
        $uploading_document = $this->input->post('uploading_document');
        $customer_part_id = $this->input->post('customer_part_id');
        $mfg = $this->input->post('mfg');
        $name = $this->input->post('name');
        $data = array(
            "operation_id" => $operation_id,
            "customer_master_id" => $customer_master_id,
            // "revision_no" => $revision_no,
        );
        $success = 0;
        $messages = "Something went wrong.";
        $check = $this->Crud->read_data_where("customer_part_operation", $data);
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {



            $data = array(
                "operation_id" => $operation_id,
                "customer_master_id" => $customer_master_id,
                "revision_no" => $revision_no,
                "revision_date" => $revision_date,
                "revision_remark" => $revision_remark,
                "mfg" => $mfg,
                "name" => $name,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("customer_part_operation", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success  =1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function add_customer_operation_data()
    {
        // $customer_master_id = $this->input->post('customer_master_id');
        // $operation_id = $this->input->post('operation_id');
        // $revision_no = $this->input->post('revision_no');
        // $revision_date = $this->input->post('revision_date');
        // $revision_remark = $this->input->post('revision_remark');
        // $uploading_document = $this->input->post('uploading_document');
        // $customer_part_id = $this->input->post('customer_part_id');
        // $mfg = $this->input->post('mfg');
        // $name = $this->input->post('name');
        // $data = array(
        //  "customer_part_id" => $customer_part_id,
        //  // "revision_no" => $revision_no,
        // );
        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {



            $data = array(

                "customer_part_operation_id" => $this->input->post('customer_part_operation_id'),
                "product" => $this->input->post('product'),
                "operation_name" => $this->input->post('operation_name'),
                "process" => $this->input->post('process'),
                "specification_tolerance" => $this->input->post('specification_tolerance'),
                "evalution" => $this->input->post('evalution'),
                "size" => $this->input->post('size'),
                "frequency" => $this->input->post('frequency'),

            );

            $result = $this->Crud->insert_data("customer_part_operation_data", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function add_job_card()
    {

        $customer_part_id = $this->input->post('customer_part_id');
        $datacheck = array(
            "customer_master_id" => $customer_part_id,
        );

        $checustomer_part_operation_data = $this->Crud->read_data_where("customer_part_operation", $datacheck);

        $datacheckcustomer_part_drawing = array(
            "customer_master_id" => $customer_part_id,
        );

        $customer_part_drawing_data = $this->Crud->read_data_where("customer_part_drawing", $datacheckcustomer_part_drawing);

        $datacheckcustomer_part_rate = array(
            "customer_master_id" => $customer_part_id,
        );

        $customer_part_rate_data = $this->Crud->read_data_where("customer_part_rate", $datacheckcustomer_part_rate);

        $check = 0;
        if ($checustomer_part_operation_data == 0) {
            echo "<script>alert('Please Add Customer Part Operaions First, To Generate PDF');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        // else if ($customer_part_drawing_data == 0) {
        // echo "<script>alert('Please Add Customer Part Drawing First, To Generate PDF ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        // }
        else if ($customer_part_rate_data == 0) {
            echo "<script>alert('Please Add Customer Part Rate First, To Generate PDF ');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "customer_part_id" => $this->input->post('customer_part_id'),
                "req_qty" => $this->input->post('req_qty'),
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }




    public function updatecustomerpartprice()
    {
       
        $customer_master_id = $this->input->post('customer_master_id');
        $rate = $this->input->post('rate');
        $revision_no = $this->input->post('revision_no');
        $revision_date = $this->input->post('revision_date');
        $revision_remark = $this->input->post('revision_remark');
        $uploading_document = $this->input->post('uploading_document');
        $customer_part_id = $this->input->post('customer_part_id');
        $data = array(
            "customer_master_id" => $customer_master_id,
            "revision_no" => $revision_no,
        );
        // print_r($data);
        $check = $this->Crud->read_data_where("customer_part_rate", $data);
        $success = 0;
        $messages = "Something went wrong.";
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            if (!empty($_FILES['uploading_document']['name'])) {
                $image_path = "./documents/";
                $config['allowed_types'] = '*';
                $config['upload_path'] = $image_path;
                $config['file_name'] = $_FILES['uploading_document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('uploading_document')) {
                    $uploadData = $this->upload->data();
                    $picture4 = $uploadData['file_name'];
                } else {
                    $picture4 = '';
                    // echo "no 1";
                }
            } else {
                $picture4 = '';
                // echo "no 2";
            }

            $data = array(
                "rate" => $rate,
                "customer_master_id" => $customer_master_id,
                "revision_no" => $revision_no,
                "revision_date" => $revision_date,
                "revision_remark" => $revision_remark,
                "uploading_document" => $uploading_document,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );

            $result = $this->Crud->insert_data("customer_part_rate", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success = 1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }

    public function stock_report($part_number_from, $part_number_to, $from, $to, $transfer_stock, $actual_stock) {
        $data = array(
            "part_number_from" => $part_number_from,
            "part_number_to" => $part_number_to,
            "from" => $from,
            "to" => $to,
            "transfer_stock" => $transfer_stock,
            "actual_stock" => $actual_stock,
            "updated_by" => $this->user_id,
            "updated_time" => $this->current_date,
            "updated_date" => $this->current_time,
            "clientId" => $this->Unit->getSessionClientId()
        );

        $result = $this->Crud->insert_data("stock_report", $data);
    }
    public function change_challan_status()
    {
        
        $challan_id = $this->input->post('challan_id');
        $data = array(
            "status" => "completed",
        );
        $success = 0;
        $messages = "Somthing went Wrong";
        $result = $this->Crud->update_data("challan", $data, $challan_id);
        if ($result) {
            $success = 1;
            $messages = "Updated Sucessfully";
            // echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages ="Unable to Add";
            // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $return_arr = [];
        $return_arr['success'] = $success;
        $return_arr['messages'] = $messages;
        echo json_encode($return_arr);

        exit();
    }
    public function change_challan_status_subcon()
    {
        $challan_id = $this->input->post('challan_id');
        $data = array(
            "status" => "completed",
        );
        $success = 0;
        $messages = "Something went wrong.";
        $result = $this->Crud->update_data("challan_subcon", $data, $challan_id);
        if ($result) {
            $messages = "Updated Sucessfully";
            $success = 1;
            // echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages = "'Unable to Add";
            // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function update_job_card()
    {
        $req_qty = $this->input->post('req_qty');
        $id = $this->input->post('id');
        // $rate = $this->input->post('rate');
        // $revision_no = $this->input->post('revision_no');
        // $revision_date = $this->input->post('revision_date');
        // $revision_remark = $this->input->post('revision_remark');
        // $uploading_document = $this->input->post('uploading_document');
        // $customer_part_id = $this->input->post('customer_part_id');
        // $data = array(
        //  "customer_part_id" => $customer_part_id,
        //  "revision_no" => $revision_no,
        // );
        // $check = $this->Crud->read_data_where("customer_part_rate", $data);
        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            // if (!empty($_FILES['uploading_document']['name'])) {
            //  $image_path = "./documents/";
            //  $config['allowed_types'] = '*';
            //  $config['upload_path'] = $image_path;
            //  $config['file_name'] = $_FILES['uploading_document']['name'];

            //  //Load upload library and initialize configuration
            //  $this->load->library('upload', $config);
            //  $this->upload->initialize($config);

            //  if ($this->upload->do_upload('uploading_document')) {
            //      $uploadData = $this->upload->data();
            //      $picture4 = $uploadData['file_name'];
            //  } else {
            //      $picture4 = '';
            //      echo "no 1";
            //  }
            // } else {
            //  $picture4 = '';
            //  echo "no 2";
            // }

            $data = array(
                "req_qty" => $req_qty,

            );
            $result = $this->Crud->update_data("job_card", $data, $id);


            // $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {
                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function update_job_card_details()
    {
        $accept_qty = $this->input->post('accept_qty');
        $reject_qty = $this->input->post('reject_qty');
        $req_qty = $this->input->post('req_qty');
        $return_qty = $req_qty -  ($accept_qty + $reject_qty);
        $id = $this->input->post('id');
        $job_card_details_id = $this->input->post('job_card_details_id');
        $operation_id = $this->input->post('operation_id');
        $rejection_remark = $this->input->post('rejection_remark');

        $rejection_remark_data = "";
        if ($rejection_remark) {
            foreach ($rejection_remark as $r) {
                $rejection_remark_data .= $r . ",";
            }
        }
        // $rate = $this->input->post('rate');
        // $revision_no = $this->input->post('revision_no');
        // $revision_date = $this->input->post('revision_date');
        // $revision_remark = $this->input->post('revision_remark');
        // $uploading_document = $this->input->post('uploading_document');
        // $customer_part_id = $this->input->post('customer_part_id');
        // $data = array(
        //  "customer_part_id" => $customer_part_id,
        //  "revision_no" => $revision_no,
        // );
        // $check = $this->Crud->read_data_where("customer_part_rate", $data);
        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            // if (!empty($_FILES['uploading_document']['name'])) {
            //  $image_path = "./documents/";
            //  $config['allowed_types'] = '*';
            //  $config['upload_path'] = $image_path;
            //  $config['file_name'] = $_FILES['uploading_document']['name'];

            //  //Load upload library and initialize configuration
            //  $this->load->library('upload', $config);
            //  $this->upload->initialize($config);

            //  if ($this->upload->do_upload('uploading_document')) {
            //      $uploadData = $this->upload->data();
            //      $picture4 = $uploadData['file_name'];
            //  } else {
            //      $picture4 = '';
            //      echo "no 1";
            //  }
            // } else {
            //  $picture4 = '';
            //  echo "no 2";
            // }

            $data = array(
                "job_card_details_id" => $job_card_details_id,
                "operation_id" => $operation_id,
                "job_card_id" => $id,
                "accept_qty" => $accept_qty,
                "reject_qty" => $reject_qty,
                "return_qty" => $return_qty,
                "rejection_remark" => $rejection_remark_data,

            );
            $result = $this->Crud->insert_data("job_card_details_operations", $data);


            // $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {
                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function update_job_card_details_closed()
    {
        $accept_qty = $this->input->post('accept_qty');
        $reject_qty = $this->input->post('reject_qty');
        $return_qty = $this->input->post('return_qty');
        $item_number = $this->input->post('item_number');
        $child_part_master_data = $this->Crud->get_data_by_id("child_part_master", $item_number, "part_number");
        $prev_stock = $child_part_master_data[0]->stock;
        // $return_qty = $accept_qty - $reject_qty;
        $new_stock = $prev_stock + $return_qty;

        $id = $this->input->post('id');
        // $rate = $this->input->post('rate');
        // $revision_no = $this->input->post('revision_no');
        // $revision_date = $this->input->post('revision_date');
        // $revision_remark = $this->input->post('revision_remark');
        // $uploading_document = $this->input->post('uploading_document');
        // $customer_part_id = $this->input->post('customer_part_id');
        // $data = array(
        //  "customer_part_id" => $customer_part_id,
        //  "revision_no" => $revision_no,
        // );
        // $check = $this->Crud->read_data_where("customer_part_rate", $data);
        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            // if (!empty($_FILES['uploading_document']['name'])) {
            //  $image_path = "./documents/";
            //  $config['allowed_types'] = '*';
            //  $config['upload_path'] = $image_path;
            //  $config['file_name'] = $_FILES['uploading_document']['name'];

            //  //Load upload library and initialize configuration
            //  $this->load->library('upload', $config);
            //  $this->upload->initialize($config);

            //  if ($this->upload->do_upload('uploading_document')) {
            //      $uploadData = $this->upload->data();
            //      $picture4 = $uploadData['file_name'];
            //  } else {
            //      $picture4 = '';
            //      echo "no 1";
            //  }
            // } else {
            //  $picture4 = '';
            //  echo "no 2";
            // }

            $data = array(
                // "accept_qty" => $accept_qty,
                "accept_qty" => $accept_qty,
                "store_reject_qty" => $reject_qty,
                "store_return_qty" => $return_qty,

            );
            $result = $this->Crud->update_data("job_card_details", $data, $id);


            // $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {
                $data2 = array(
                    // "accept_qty" => $accept_qty,
                    "stock" => $new_stock,
                    // "store_return_qty" => $return_qty,

                );
                $result2 = $this->Crud->update_data("child_part_master", $data2, $child_part_master_data[0]->id);

                // print_r($data2);
                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function update_job_card_prod()
    {
        $req_qty = $this->input->post('req_qty');
        $last = $this->input->post('last');
        $customer_part_id = $this->input->post('customer_part_id');


        // $req_qty = $this->input->post('req_qty');
        $id = $this->input->post('id');
        $lot_qty = $this->input->post('lot_qty');
        $operation_id = $this->input->post('operation_id');
        $production_qty_calculated =  $this->input->post('qfinal_qty') + $req_qty;

        $max_qty = $this->input->post('max_qty');

        // echo "<br>" . $req_qty;
        if ($max_qty < $production_qty_calculated) {
            echo "<script>alert('Failed : Production / Assembly Qty must be less than Lot/Required Qty !!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {



            // $rate = $this->input->post('rate');
            // $revision_no = $this->input->post('revision_no');
            // $revision_date = $this->input->post('revision_date');
            // $revision_remark = $this->input->post('revision_remark');
            // $uploading_document = $this->input->post('uploading_document');
            // $customer_part_id = $this->input->post('customer_part_id');
            // $data = array(
            //  "customer_part_id" => $customer_part_id,
            //  "revision_no" => $revision_no,
            // );
            // $check = $this->Crud->read_data_where("customer_part_rate", $data);
            $check = 0;
            if ($check != 0) {
                echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {

                // if (!empty($_FILES['uploading_document']['name'])) {
                //  $image_path = "./documents/";
                //  $config['allowed_types'] = '*';
                //  $config['upload_path'] = $image_path;
                //  $config['file_name'] = $_FILES['uploading_document']['name'];

                //  //Load upload library and initialize configuration
                //  $this->load->library('upload', $config);
                //  $this->upload->initialize($config);

                //  if ($this->upload->do_upload('uploading_document')) {
                //      $uploadData = $this->upload->data();
                //      $picture4 = $uploadData['file_name'];
                //  } else {
                //      $picture4 = '';
                //      echo "no 1";
                //  }
                // } else {
                //  $picture4 = '';
                //  echo "no 2";
                // }

                $data = array(
                    "job_card_id" => $id,
                    "operation_id" => $operation_id,
                    "production_qty" => $req_qty,
                    "created_date" => $this->current_date,
                    "created_time" => $this->current_time,
                    "created_by" => $this->user_id,

                );
                $result = $this->Crud->insert_data("job_card_prod_qty", $data);

                if ($last == "yes") {
                    $customer_part_data_old = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
                    if ($customer_part_data_old) {
                        $old_fg_stock = $customer_part_data_old[0]->fg_stock;
                        $new_stock = $old_fg_stock + $req_qty;
                        $data_new = array(
                            "fg_stock" => $new_stock,

                        );
                        $result = $this->Crud->update_data("customer_part", $data_new, $customer_part_id);
                    }
                }


                // $result = $this->Crud->insert_data("job_card", $data);
                if ($result) {
                    echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            }
        }
    }
    public function update_job_card_operation()
    {
        // $req_qty = $this->input->post('req_qty');
        // $req_qty = $this->input->post('req_qty');
        $id = $this->input->post('id');
        $operation_id = $this->input->post('operation_id');
        // $lot_qty = $this->input->post('lot_qty');
        // $production_qty_calculated = $this->input->post('production_qty_calculated') + $req_qty;

        if (false) {
            echo "<script>alert('Failed : Production / Assembly Qty must be less than Lot/Required Qty !!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {



            // $rate = $this->input->post('rate');
            // $revision_no = $this->input->post('revision_no');
            // $revision_date = $this->input->post('revision_date');
            // $revision_remark = $this->input->post('revision_remark');
            // $uploading_document = $this->input->post('uploading_document');
            // $customer_part_id = $this->input->post('customer_part_id');
            // $data = array(
            //  "customer_part_id" => $customer_part_id,
            //  "revision_no" => $revision_no,
            // );
            // $check = $this->Crud->read_data_where("customer_part_rate", $data);
            $check = 0;
            if ($check != 0) {
                echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {

                // if (!empty($_FILES['uploading_document']['name'])) {
                //  $image_path = "./documents/";
                //  $config['allowed_types'] = '*';
                //  $config['upload_path'] = $image_path;
                //  $config['file_name'] = $_FILES['uploading_document']['name'];

                //  //Load upload library and initialize configuration
                //  $this->load->library('upload', $config);
                //  $this->upload->initialize($config);

                //  if ($this->upload->do_upload('uploading_document')) {
                //      $uploadData = $this->upload->data();
                //      $picture4 = $uploadData['file_name'];
                //  } else {
                //      $picture4 = '';
                //      echo "no 1";
                //  }
                // } else {
                //  $picture4 = '';
                //  echo "no 2";
                // }

                $data = array(
                    "operation_id" => $operation_id,
                    // "production_qty" => $req_qty,
                    // "created_date" => $this->current_date,
                    // "created_time" => $this->current_time,
                    // "created_by" => $this->user_id,

                );
                $result = $this->Crud->update_data("job_card", $data, $id);


                // $result = $this->Crud->insert_data("job_card", $data);
                if ($result) {
                    echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                } else {
                    echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            }
        }
    }
    public function update_job_card_status()
    {

        $req_qty = $this->input->post('req_qty');
        $id = $this->input->post('id');

        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {



            $data = array(
                "status" => "released"

            );
            $result = $this->Crud->update_data("job_card", $data, $id);


            // $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {
                $job_card_id = $id;
                $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
                $job_card = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
                $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
                $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
                $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
                $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
                $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
                $bom_data = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");
                if ($bom_data) {
                    foreach ($bom_data as $b) {


                        $child_part_data = $this->SupplierParts->getSupplierPartOnlyById($b->child_part_id);
                        $child_part_master = $this->Crud->get_data_by_id("child_part_master", $child_part_data[0]->part_number, "part_number");
                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                        $req_qty = 0;
                        $stock =  $child_part_master[0]->stock;
                        $req_qty = $job_card[0]->req_qty * $b->quantity;

                        $new_stock = $stock - $req_qty;
                        $onhold_stock = $req_qty;
                        $data22 = array(
                            "stock" => $new_stock,
                            "onhold_stock" => $onhold_stock,
                            // "return_qty" => $return_qty,

                        );
                        $result2 = $this->Crud->update_data("child_part_master", $data22, $child_part_master[0]->id);
                    }
                }
                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function update_job_card_status_lock()
    {
        $req_qty = $this->input->post('req_qty');
        $location = $this->input->post('location');
        $grn = $this->input->post('grn');
        $house_make = $this->input->post('house_make');
        $id = $this->input->post('id');
        $job_card_data = $this->Crud->get_data_by_id("job_card", $id, "id");


        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "status" => "issued",
                "location" => "issued",
                "location" => $location,
                "grn" => $grn,
                "house_make" => $house_make,
                "issue_date" => $this->current_date,

            );
            $result = $this->Crud->update_data("job_card", $data, $id);


            // $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {

                $bom_data = $this->Crud->get_data_by_id("bom", $job_card_data[0]->customer_part_id, "customer_part_id");

                foreach ($bom_data as $b) {
                    $child_part_data = $this->SupplierParts->getSupplierPartOnlyById($b->child_part_id);
                    $child_part_master = $this->Crud->get_data_by_id("child_part_master", $child_part_data[0]->part_number, "part_number");
                    $insert_data = array(
                        "item_number" => $child_part_data[0]->part_number,
                        "item_description" => $child_part_data[0]->part_description,
                        "child_part_id" => $b->child_part_id,
                        "store_location" => "",
                        "bom_qty" => $b->quantity,
                        "uom" => "",
                        "grn" => "",
                        "mgf" => "",
                        "job_card_id" => $id,
                    );

                    $result = $this->Crud->insert_data("job_card_details", $insert_data);
                }


                $job_card_id = $id;
                $data['job_card'] = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
                $job_card = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
                $data['customer_part_data'] = $this->Crud->get_data_by_id("customer_part", $data['job_card'][0]->customer_part_id, "id");
                $data['customer_part_operation'] = $this->Crud->get_data_by_id("customer_part_operation", $data['job_card'][0]->customer_part_id, "customer_master_id");
                $data['customer_part_operation_data'] = $this->Crud->get_data_by_id("customer_part_operation_data", $data['customer_part_operation'][0]->id, "customer_part_operation_id");
                $data['uom'] = $this->Crud->get_data_by_id("uom", $data['customer_part_data'][0]->uom, "id");
                $data['customer_data'] = $this->Crud->get_data_by_id("customer", $data['customer_part_data'][0]->customer_id, "id");
                $bom_data = $this->Crud->get_data_by_id("bom", $data['job_card'][0]->customer_part_id, "customer_part_id");
                if ($bom_data) {
                    foreach ($bom_data as $b) {


                        $child_part_data = $this->SupplierParts->getSupplierPartOnlyById($b->child_part_id);
                        $child_part_master = $this->Crud->get_data_by_id("child_part_master", $child_part_data[0]->part_number, "part_number");
                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                        $req_qty = 0;
                        $stock =  $child_part_master[0]->stock;
                        $prev_onhold =  $child_part_master[0]->onhold_stock;
                        $req_qty = $job_card[0]->req_qty * $b->quantity;
                        $new_onhold = $prev_onhold - $req_qty;

                        $new_stock = $stock - $req_qty;
                        $onhold_stock = $req_qty;
                        $production_qty = 0;
                        $data22 = array(
                            "onhold_stock" => $new_onhold,
                            "production_qty" => $req_qty,

                        );
                        $result2 = $this->Crud->update_data("child_part_master", $data22, $child_part_master[0]->id);
                    }
                }



                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function issueJobCard()
    {
        $req_qty = $this->input->post('req_qty');
        $id = $this->input->post('id');
        $job_card_data = $this->Crud->get_data_by_id("job_card", $id, "id");
        $bom_data = $this->Crud->get_data_by_id("bom", $job_card_data[0]->customer_part_id, "customer_part_id");

        if ($bom_data) {
            if ($bom_data) {
                foreach ($bom_data as $b) {


                    $child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
                    $stock =  $child_part_data[0]->stock;
                    $new_qty =   $stock - ($b->quantity * $req_qty);
                    $data22 = array(
                        "stock" => $new_qty,
                    );
                    $result2 = $this->SupplierParts->updateStockById($data22, $child_part_data[0]->id);
                }
            }

            if ($result2) {
                $data = array(
                    "status" => "issueJobCard",
                    "issue_date" => $this->current_date

                );
                $result = $this->Crud->update_data("job_card", $data, $id);
                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Error While Updating !!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        } else {
            echo "BOM Data Not Found !";
        }
    }
    public function update_job_card_status_close()
    {
        // $req_qty = $this->input->post('req_qty');
        $id = $this->input->post('id');
        $customer_part_id = $this->input->post('customer_part_id');
        $req_qty = $this->input->post('req_qty');
        // $job_card_data = $this->Crud->get_data_by_id("job_card", $id, "id");


        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "status" => "close"

            );
            $result = $this->Crud->update_data("job_card", $data, $id);
            // $result = $this->Crud->insert_data("job_card", $data);
            if ($result) {


                $customer_part_data_old = $this->Crud->get_data_by_id("customer_part", $customer_part_id, "id");
                $customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($customer_part_data_old[0]->part_number);
                if ($customer_parts_master_data) {
                    $old_fg_stock = $customer_parts_master_data[0]->fg_stock;
                    $new_stock = $old_fg_stock + $req_qty;
                    $data_new = array(
                        "fg_stock" => $new_stock,

                    );
                    $result = $this->CustomerPart->updateStockById($data_new, $customer_parts_master_data[0]->part_id);
                }


                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function update_prod_qty()
    {
        $production_qty = $this->input->post('production_qty');
        $child_part_master_id = $this->input->post('child_part_master_id');
        $req_qty = $this->input->post('req_qty');
        $datacheck = array(
            "id" => $child_part_master_id,
            // "revision_no" => $revision_no,
        );
        $child_part_master_data = $this->Crud->get_data_by_id('child_part_master', $child_part_master_id, 'id');

        // $child_part_master_data = $this->Crud->read_data_where("child_part_master", $datacheck);
        // print_r($child_part_master_data);
        $check = 0;
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {

            $prev_stock = $child_part_master_data[0]->stock;
            $prev_production_qty = $child_part_master_data[0]->production_qty;
            $prev_rejection_qty = $req_qty;


            $new_rejection_caluclated_qty = $production_qty - $req_qty;

            $new_stock = $prev_stock - $production_qty;
            $production_qty = $prev_production_qty + $production_qty;
            $new_rejection_qty = $prev_rejection_qty + $new_rejection_caluclated_qty;


            $data = array(
                "stock" => $new_stock,
                "production_qty" => $production_qty,
                "rejection_prodcution_qty" => $new_rejection_qty,

            );



            $result = $this->Crud->update_data("child_part_master", $data, $child_part_master_id);
            if ($result) {
                echo "<script>alert('Update Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }

    public function addStore()
    {
        $supplier_name = $this->input->post('supplier_name');
        $part = $this->input->post('part');
        $entered_date = $this->input->post('dateee');
        $invoice_amount = $this->input->post('invoice_amount');
        $po_number = $this->input->post('po_number');
        $quantity = $this->input->post('quantity');
        $invoice_number = $this->input->post('invoice_number');
        $rate = $this->input->post('rate');
        $s = "store";
        $this->db->from("store");
        $this->db->order_by("id", "desc");
        $query = $this->db->get()->result();
        $date = $this->current_date;
        $q = explode("-", $date);
        $year = $q[0];
        $year = $year . $q[1] . $q[2];
        if ($query == NULL) {
            $grn_number = $year . "-" . '1';
        } else {
            // $des =  $query->limit(1)->result();
            // print_r($des);
            $grn_number = $year . "-" . ($query[0]->id + 1);
        }
        $data = array(
            "supplier_id" => $supplier_name,
            "po_number" => $po_number,
            "supplier_invoice_number" => $invoice_number,
            "part_id" => $part,
            "quantity" => $quantity,
            "rate" => $rate,
            "grn_number" => $grn_number,
            "invoice_amount" => $invoice_amount,
            "entered_date" => $entered_date,
            "created_id" => $this->user_id,
            "date" => $this->current_date,
            "time" => $this->current_time,

        );

        $result = $this->Crud->insert_data("store", $data);
        if ($result) {
            echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }
    public function addissue()
    {
        $contractor = $this->input->post('contractor');
        $parttt = $this->input->post('parttt');
        $issue_date = $this->input->post('issue_date');
        $oc = $this->input->post('oc');
        $slip_details = $this->input->post('slip_details');
        $wbs = $this->input->post('wbs');
        $hus = $this->input->post('hus');
        $quantity = $this->input->post('quantity');

        $data = array(
            "contractor_id" => $contractor,
            "part_id" => $parttt,
            "oc_id" => $oc,
            "hus_id" => $hus,
            "wbs_id" => $wbs,
            "item_quantity" => $quantity,
            "slip_details" => $slip_details,
            "issue_date" => $issue_date,
            "created_id" => $this->user_id,
            "date" => $this->current_date,
            "time" => $this->current_time,

        );

        $result = $this->Crud->insert_data("issue", $data);
        if ($result) {
            echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }


    public function updateContractor()
    {
        $id = $this->input->post('id');

        $name = $this->input->post('ucontractorName');
        $number = $this->input->post('ucontractorCode');

        $data = array(
            "contractor_code" => $number,
        );
        $check = $this->Crud->read_data_where("contractor", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "contractor_name" => $name,
                "contractor_code" => $number,
            );
            $result = $this->Crud->update_data("contractor", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }

    public function updatepartType()
    {
        $id = $this->input->post('id');

        $name = $this->input->post('uparttypeName');

        $data = array(
            "part_type_name" => $name,
        );
        $check = $this->Crud->read_data_where("part_type", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "part_type_name" => $name,

            );
            $result = $this->Crud->update_data("part_type", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateCustomerType()
    {
        $id = $this->input->post('id');

        $name = $this->input->post('ucustomerPartName');

        $data = array(
            "customer_type_name" => $name,
        );
        $check = $this->Crud->read_data_where("customer_part_type", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "customer_type_name" => $name,

            );
            $result = $this->Crud->update_data("customer_part_type", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateStore()
    {
        $id = $this->input->post('id');

        $supplier_name = $this->input->post('usupplier_name');
        $part = $this->input->post('upart');
        $dateee = $this->input->post('udateee');
        $invoice_amount = $this->input->post('uinvoice_amount');
        $po_number = $this->input->post('upo_number');
        $quantity = $this->input->post('uquantity');
        $invoice_number = $this->input->post('uinvoice_number');
        $rate = $this->input->post('urate');

        $data = array(
            "supplier_id" => $supplier_name,
            "po_number" => $po_number,
            "entered_date" => $dateee,
            "supplier_invoice_number" => $invoice_number,
            "part_id" => $part,
            "quantity" => $quantity,
            "rate" => $rate,
            "invoice_amount" => $invoice_amount,


        );
        $result = $this->Crud->update_data("store", $data, $id);
        if ($result) {
            echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Update');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }
    public function updateissue()
    {
        $id = $this->input->post('id');
        $contractor = $this->input->post('ucontractor');
        $part_id = $this->input->post('upart');
        $uissue_date = $this->input->post('uissue_date');
        $hus = $this->input->post('uhus');
        $oc = $this->input->post('uoc');
        $slip_details = $this->input->post('uslip_details');
        $wbs = $this->input->post('uwbs');
        $quantity = $this->input->post('uquantity');

        $data = array(
            "contractor_id" => $contractor,
            "oc_id" => $oc,
            "part_id" => $part_id,
            "hus_id" => $hus,
            "issue_date" => $uissue_date,
            "wbs_id" => $wbs,
            "item_quantity" => $quantity,
            "slip_details" => $slip_details,
        );
        $result = $this->Crud->update_data("issue", $data, $id);
        if ($result) {
            echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Update');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }


    public function addConsumable()
    {
        $number = $this->input->post('partNumber');
        $description = $this->input->post('description');
        $data = array(
            "part_number" => $number,
        );
        $check = $this->Crud->read_data_where("consumable_item", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "part_number" => $number,
                "part_description" => $description,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            $result = $this->Crud->insert_data("consumable_item", $data);
            if ($result) {
                echo "<script>alert(' Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateConsumable()
    {
        $id = $this->input->post('id');
        $number = $this->input->post('upartNumber');
        $description = $this->input->post('udescription');
        $data = array(
            "part_number" => $number,
            "part_description" => $description,
        );
        $check = $this->Crud->read_data_where("consumable_item", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "part_number" => $number,
                "part_description" => $description,

            );
            $result = $this->Crud->update_data("consumable_item", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function addOtherData()
    {

        $husnumber = $this->input->post('hus_num');
        $type = $this->input->post('type');
        // if ($type == 'hus') {
        //  $col = 'hus_number';
        // } elseif ($type == 'oc') {
        //  $col = 'oc_number';
        // } else {
        //  $col = 'wbs_number';
        // }

        $data = array(
            "type" => $type,
            "number" => $husnumber,
        );
        $check = $this->Crud->read_data_where("other_data", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "type" => $type,
                "number" => $husnumber,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            $result = $this->Crud->insert_data("other_data", $data);
            if ($result) {
                echo "<script>alert(' Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function addTransport()
    {

        $weight = $this->input->post('weight');
        $c_po_so_id = $this->input->post('id');
        $transporter_name = $this->input->post('transporter_name');
        $vehicle_number = $this->input->post('vehicle_number');
        $lr_number = $this->input->post('lr_number');
        $dispatch_date = $this->input->post('dispatch_date');


        $data = array(
            "weight" => $weight,
            "c_po_so_id" => $c_po_so_id,
            "transporter_name" => $transporter_name,
            "vehicle_number" => $vehicle_number,
            "lr_number" => $lr_number,
            "dispatch_date" => $dispatch_date,
        );
        $check = $this->Crud->read_data_where("dispatch_tracking", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "weight" => $weight,
                "c_po_so_id" => $c_po_so_id,
                "transporter_name" => $transporter_name,
                "vehicle_number" => $vehicle_number,
                "lr_number" => $lr_number,
                "dispatch_date" => $dispatch_date,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            $result = $this->Crud->insert_data("dispatch_tracking", $data);
            if ($result) {
                echo "<script>alert(' Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateTransport()
    {

        $weight = $this->input->post('uweight');
        $id = $this->input->post('uid');
        $transporter_name = $this->input->post('utransporter_name');
        $vehicle_number = $this->input->post('uvehicle_number');
        $lr_number = $this->input->post('ulr_number');
        $dispatch_date = $this->input->post('udispatch_date');


        $data = array(
            "weight" => $weight,
            "transporter_name" => $transporter_name,
            "vehicle_number" => $vehicle_number,
            "lr_number" => $lr_number,
            "dispatch_date" => $dispatch_date,
        );
        $check = $this->Crud->read_data_where("dispatch_tracking", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "weight" => $weight,
                "transporter_name" => $transporter_name,
                "vehicle_number" => $vehicle_number,
                "lr_number" => $lr_number,
                "dispatch_date" => $dispatch_date,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            // $result = $this->Crud->insert_data("dispatch_tracking", $data);
            $result = $this->Crud->update_data("dispatch_tracking", $data, $id);

            if ($result) {
                echo "<script>alert(' Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateCompletedDate()
    {

        $id = $this->input->post('comoleted_id');
        $completed_date = $this->input->post('completed_date');



        $data = array(
            "completed_date" => $completed_date,

        );
        // $result = $this->Crud->insert_data("dispatch_tracking", $data);
        $result = $this->Crud->update_data("dispatch_tracking", $data, $id);

        if ($result) {
            echo "<script>alert(' Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert(' Not Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }
    public function updateOtherData()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $husnumber = $this->input->post('uhus_num');

        $data = array(
            "type" => $type,
            "number" => $husnumber,
        );

        $check = $this->Crud->read_data_where("other_data", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $result = $this->Crud->update_data("other_data", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }




    public function addchildpart_supplier()
    {



        $part_desc = $this->input->post('part_desc');
        $part_rate = $this->input->post('upart_rate');
        // $saft_stk = $this->input->post('saft_stk');
        $revision_date = $this->current_date;
        $revision_no = 1;
        $supplier_id = $this->input->post('supplier_id');
        // $uom_id = $this->input->post('uom_id');
        $child_part_id = $this->input->post('child_part_id');
        $gst_id = $this->input->post('gst_id');
        $with_in_state = $this->input->post('with_in_state');
        // $gst_id = $this->input->post('hsn_code');
        $revision_remark = $this->input->post('revision_remark');

        $message = '';
        $success = 0;
        $mode = $this->input->post('mode');
        if($mode == 'Add'){
            $child_part_id = $this->input->post('child_part_id');
            $array = array(
                "id" => $child_part_id,
            );
            $child_part_data = $this->SupplierParts->getSupplierPartById($child_part_id);
            $data2 = array(
                "id" => $supplier_id,
            );
            $supplier_data = $this->Crud->get_data_by_id_multiple_condition("supplier", $data2);
            $data3 = array(
                "id" => $gst_id,
            );

            $gst_structure_data = $this->Crud->get_data_by_id_multiple_condition("gst_structure", $data3);
            if ($gst_structure_data[0]->with_in_state == $supplier_data[0]->with_in_state) {
                $data = array(
                    "part_number" => $child_part_data[0]->part_number,
                    "supplier_id" => $supplier_id,
                );
                $check = $this->Crud->read_data_where("child_part_master", $data);
                if ($check != 0) {
                    $message ="Record already exists with selected Supplier and Part Number.";
                } else {


                    if (!empty($_FILES['quotation_document']['name'])) {
                        $image_path = "./documents/";
                        $config['allowed_types'] = '*';
                        $config['upload_path'] = $image_path;
                        $config['file_name'] = $_FILES['quotation_document']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('quotation_document')) {
                            $uploadData = $this->upload->data();
                            $picture4 = $uploadData['file_name'];
                        } else {
                            $picture4 = 'no 1';
                            // echo "no 1";
                        }
                    } else {
                        $picture4 = '';
                        // echo "no 2";
                    }

                    // echo $picture4;

                    $data = array(
                        "part_number" => $child_part_data[0]->part_number,
                        "part_description" => $child_part_data[0]->part_description,
                        "supplier_id" => $supplier_id,
                        "part_rate" => $part_rate,
                        "uom_id" => $child_part_data[0]->uom_id,
                        "revision_no" => $revision_no,
                        "child_part_id" => $child_part_id,
                        "revision_remark" => $revision_remark,
                        "revision_date" => $revision_date,
                        "created_id" => $this->user_id,
                        "date" => $this->current_date,
                        "time" => $this->current_time,
                        "quotation_document" => $picture4,
                        "gst_id" => $gst_id,
                        "with_in_state" => $with_in_state,
                    );
                    $result = $this->Crud->insert_data("child_part_master", $data);
                    if ($result) {
                        $success = 1;
                        $message ="Supplier part price added Sucessfully";
                    } else {
                        $message ="'Unable to Add";
                    }
                }
            } else {
                $message = "Error 405: Supplier With In state and Tax Strucutre With In State Does Not Matched, Please select another tax Strucutre";
            }
        }else if($mode == 'Update'){

            $data = array(
                "part_rate" => $part_rate,
                // "uom_id" => $child_part_data[0]->uom_id,
                "revision_remark" => $revision_remark,
                "gst_id" => $gst_id
            );
            $supplier_child_part_id = $this->input->post('supplier_child_part_id');
            $child_part_master  = $this->Crud->customQuery("
            SELECT s.with_in_state as with_in_state_val
            FROM `child_part_master` c 
            JOIN supplier as s ON s.id = c.supplier_id 
            WHERE c.id = $supplier_child_part_id");
            $with_in_state = $child_part_master[0]->with_in_state_val;
            $data3 = array(
                "id" => $gst_id,
            );
            $gst_structure_data = $this->Crud->get_data_by_id_multiple_condition("gst_structure", $data3);
            if ($gst_structure_data[0]->with_in_state == $with_in_state) {
                $result = $this->welcome_model->update_child_part_data($data, $supplier_child_part_id);
                if ($result) {
                    $success = 1;
                    $message ="Supplier part price updated Sucessfully";
                }else {
                    $message ="'Unable to update";
                }
            }else{
                $message = "Error 405: Supplier With In state and Tax Strucutre With In State Does Not Matched, Please select another tax Strucutre";
            }
        }



        $return_arr = [
            "message"=>$message,
            "success" => $success
        ];
        // pr($return_arr,1);
        echo json_encode($return_arr);
        exit();
    }
    public function updatechildpart()
    {
        $id = $this->input->post('id');

        $part_number = $this->input->post('upart_number');
        $part_desc = $this->input->post('upart_desc');
        $part_rate = $this->input->post('upart_rate');
        $saft_stk = $this->input->post('usaft_stk');
        $revision_date = $this->input->post('urevision_date');
        $revision_no = $this->input->post('urevision_no');
        $supplier_id = $this->input->post('usupplier_id');
        $uom_id = $this->input->post('uuom_id');
        $child_part_id = $this->input->post('child_part_id');
        $revision_remark = $this->input->post('revision_remark');
        $hsn_code = $this->input->post('hsn_code');
        $gst_id = $this->input->post('gst_id');
        $sub_type = $this->input->post('sub_type');
        $asset = $this->input->post('asset');
        $max_uom = $this->input->post('max_uom');
        $min_uom = $this->input->post('min_uom');

        $data = array(
            "part_number" => $part_number,
            "supplier_id" => $supplier_id,
        );
        if (!empty($_FILES['part_drawing']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['part_drawing']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('part_drawing')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
            } else {
                $picture4 = '';
                echo "no 1";
            }
        } else {
            $picture4 = '';
            echo "no 2";
        }

        if (!empty($_FILES['modal']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['modal']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('modal')) {
                $uploadData = $this->upload->data();
                $picture5 = $uploadData['file_name'];
            } else {
                $picture5 = '';
                echo "no 1";
            }
        } else {
            $picture5 = '';
            echo "no 2";
        }

        if (!empty($_FILES['cad_file']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['cad_file']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('cad_file')) {
                $uploadData = $this->upload->data();
                $picture6 = $uploadData['file_name'];
            } else {
                $picture6 = '';
                echo "no 1";
            }
        } else {
            $picture6 = '';
            echo "no 2";
        }

        $data = array(
            "part_number" => $part_number,
            "part_description" => $part_desc,
            "supplier_id" => $supplier_id,
            "part_rate" => $part_rate,
            "uom_id" => $uom_id,
            "safty_buffer_stk" => $saft_stk,
            "revision_no" => $revision_no,
            "child_part_id" => $child_part_id,
            "hsn_code" => $hsn_code,
            "revision_remark" => $revision_remark,
            "part_drawing" => $picture4,
            "modal_document" => $picture5,
            "cad_file" => $picture6,
            "sub_type" => $sub_type,
            "max_uom" => $max_uom,
            "min_uom" => $min_uom,
            "gst_id" => $gst_id,
            "revision_date" => $revision_date,
            "created_id" => $this->user_id,
            "date" => $this->current_date,
            "time" => $this->current_time,
        );

        $result = $this->SupplierParts->createSupplierPart($data);
        if ($result) {
            echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }

        //}
    }
    public function updatechildpart_supplier()
    {

        $id = $this->input->post('id');
        $array = array(
            "id" => $id,

        );

        $child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array);

        // print_r($child_part_data);
        $part_number = $child_part_data[0]->part_number;
        $part_desc = $child_part_data[0]->part_description;
        $part_rate = $this->input->post('upart_rate');
        $revision_date = $this->input->post('urevision_date');
        // $gst_id = $child_part_data[0]->gst_id;
        $gst_id = $this->input->post('gst_id');

        $revision_no = $this->input->post('urevision_no');
        $supplier_id = $this->input->post('supplier_id');
        $uom_id = $child_part_data[0]->uom_id;
        $child_part_id = $child_part_data[0]->child_part_id;
        $revision_remark = $this->input->post('revision_remark');
        $with_in_state = $this->input->post('with_in_state');
        $hsn_code = $child_part_data[0]->hsn_code;
        $saft_stk = $child_part_data[0]->safty_buffer_stk;

        if (!empty($_FILES['quotation_document']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['quotation_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('quotation_document')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
            } else {
                $picture4 = '';
                // echo "no 1";
            }
        } else {
            $picture4 = '';
            // echo "no 2";
        }
        $message = 0;
        $success = 0;
        $data = array(
            "part_number" => $part_number,
            "part_description" => $part_desc,
            "supplier_id" => $supplier_id,
            "part_rate" => $part_rate,
            "uom_id" => $uom_id,
            "safty_buffer_stk" => $saft_stk,
            "revision_no" => $revision_no,
            "child_part_id" => $child_part_id,
            "hsn_code" => $hsn_code,
            "revision_remark" => $revision_remark,
            "quotation_document" => $picture4,
            "with_in_state" => $with_in_state,
            "revision_date" => $revision_date,
            "gst_id" => (int) $gst_id,
            "created_id" => $this->user_id,
            "date" => $this->current_date,
            "time" => $this->current_time,


        );

        $result = $this->Crud->insert_data("child_part_master", $data);
        if ($result) {
            $success = 1;
            $message = "Part revision added Sucessfully";
        } else {
            $message ="Something went wrong";
        }

        $return_arr = [
            "success"=>$success,
            "message"=>$message
        ];

        echo json_encode($return_arr);
        exit();
        //}
    }
    public function updatechildpart_supplier_admin()
    {
        $id = $this->input->post('id');

        $part_rate = $this->input->post('upart_desc');


        $data = array(
            "admin_approve" => "accept",
            "part_rate" => $part_rate,

        );
        
        $sucess = 1;
        $msg = '';
        
        $result = $this->Crud->update_data("child_part_master", $data, $id);
        
        if ($result) {
            $msg = 'Price Update successfully.';
        } else {
            $sucess = 0;
            $msg = 'unable to upload';
        }
        $ret_arr = [];
        $ret_arr['success'] = $sucess;
        $ret_arr['msg'] = $msg;

        echo json_encode($ret_arr);
    }


    public function updatecustomerpart()
    {
        $id = $this->input->post('id');

        $part_number = $this->input->post('upart_number');
        $part_desc = $this->input->post('upart_desc');
        $revision_date = $this->input->post('urevision_date');
        $revision_no = $this->input->post('urevision_no');

        $customer_id = $this->input->post('ucustomer_id');
        $customer_part_id = $this->input->post('ucustomer_part_id');
        // $customer_id = $this->Crud->get_data_by_id('customer', $customerName, 'id');
        // $customer_id = $customer_id[0]->id;

        $data = array(
            "part_number" => $part_number,
            "customer_id" => $customer_id,
        );

        $check = $this->Crud->read_data_where("customer_part", $data);
        if ($check > 1) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "part_number" => $part_number,
                "part_description" => $part_desc,
                "customer_id" => $customer_id,
                "revision_no" => $revision_no,
                "customer_part_id" => $customer_part_id,
                "revision_date" => $revision_date,
            );

            $result = $this->Crud->update_data("customer_part", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }

    public function updatechildpartNew()
    {
        $id = $this->input->post('id');

        $safty_buffer_stk = $this->input->post('usaft_stk');
        $hsn_code = $this->input->post('hsn_code');
        $child_part_id = $this->input->post('child_part_id');
        $uuom_id = $this->input->post('uuom_id');
        $part_desc = $this->input->post('part_desc');
        $gst_id = $this->input->post('gst_id');


        $data = array(
            "uom_id" => $uuom_id,
            "hsn_code" => $hsn_code,
            "safty_buffer_stk" => $safty_buffer_stk,
            "child_part_id" => $child_part_id,
            "part_description" => $part_desc,
            "gst_id" => $gst_id,
        );

        $result = $this->SupplierParts->updatePartById($data, $id);

        if ($result) {
            $dataStock = array("safty_buffer_stk" => $safty_buffer_stk);
            $result = $this->SupplierParts->updatePartById($dataStock, $id);
            echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    public function addCustomer()
    {
        $customerName = trim($this->input->post('customerName'));
        $customerLocation = trim($this->input->post('customerLocation'));
        $customerSaddress = $this->input->post('customerSaddress');
        $paymentTerms = $this->input->post('paymentTerms');
        $customerCode = trim($this->input->post('customerCode'));
        $state = $this->input->post('state');
        $gst_no = trim($this->input->post('gst_no'));
        $state_no = $this->input->post('state_no');
        $vendor_code = $this->input->post('vendor_code');
        // $bank_details = $this->input->post('bank_details');
        $pan_no = $this->input->post('pan_no');
        $pos = $this->input->post('pos');
        $address1 = $this->input->post('address1');
        $location = $this->input->post('location');
        $pin = $this->input->post('pin');
        $distance1 = trim($this->input->post('distncFrmClnt1'));
        $distance2 = trim($this->input->post('distncFrmClnt2'));
        $distance3 = trim($this->input->post('distncFrmClnt3'));
        $customerType = $this->input->post('customerType');

        $emailId = trim($this->input->post('emailId'));
        $discount = $this->input->post('discount');
        $discountType = $this->input->post('discountType');

        $data = array(
            "customer_code" => $customerCode,
        );
        $check = $this->Crud->read_data_where("customer", $data);
        $message = "Something went wrong";
        $success = 0;
        if(count(str_split($state_no)) > 2 || count(str_split($pos)) > 2 || count(str_split($paymentTerms)) > 2){
            $message = count(str_split($paymentTerms)) > 2 ? "Payment terms must be 2 digit" : (count(str_split($state_no)) > 2 ? "State no must be 2 digit" : "Pos must be 2 digit");
        }else{
            if ($check != 0) {
                $data = array(
                    "customer_name" => $customerName,
                );

                $check = $this->Crud->read_data_where("customer", $data);
                if ($check != 0) {
                    $message = "Customer Code should be unique. Customer with customer name already exists.";
                    // $this->addErrorMessage('Customer Code should be unique. Customer with customer name already exists.');
                }else {
                    $message = "Customer Code should be unique.";
                    // $this->addErrorMessage('Customer Code should be unique.');
                }
                // $this->redirectMessage('customer');
                // exit();
            } else {
                $data = array(
                    "gst_number" => $gst_no
                );
                $check = $this->Crud->read_data_where("customer", $data);
               
                if($check == 0){
                    $data = array(
                        "customer_name" => $customerName,
                        "customer_code" => $customerCode,
                        "billing_address" => $customerLocation,
                        "shifting_address" => $customerSaddress,
                        "state" => $state,
                        "gst_number" => $gst_no,
                        "state_no" => $state_no,
                        "vendor_code" => $vendor_code,
                        "pan_no" => $pan_no,
                        "pos" => $pos,
                        "address1" => $address1,
                        "location" => $location,
                        "pin" => $pin,
                        "distncFrmClnt1"=> $distance1,
                        "distncFrmClnt2"=> $distance2,
                        "distncFrmClnt3"=> $distance3,
                        "emailId" => $emailId,
                        "discount" => $discount,
                        "discountType" => $discountType,
                        // "bank_details" => $bank_details,
                        "payment_terms" => $paymentTerms,
                        "created_id" => $this->user_id,
                        "date" => $this->current_date,
                        "time" => $this->current_time,
                        "customerType" => $customerType
                    );
                    $result = $this->Crud->insert_data("customer", $data);
                    if ($result) {
                        $success = 1;
                        $message = "Customer added sucessfully.";
                        // $this->addSuccessMessage('Customer added sucessfully.');
                        // $this->redirectMessage('customer');
                    } else {
                        $message = "Unable to add customer.";
                        // $this->addErrorMessage('Unable to add customer.');
                        // $this->redirectMessage('customer');
                    }
                }else{
                    $message = "GST number already exist";
                }
            }
        }
        $return_arr =[
            "success" =>$success,
            "message" =>$message
        ];
        echo json_encode($return_arr);
        exit();

    }
    public function updateCustomer()
    {
        $id = $this->input->post('id');

        $customerName = trim($this->input->post('ucustomerName'));
        $customerCode = trim($this->input->post('ucustomerCode'));
        $shiftingAddress = trim($this->input->post('ushiftingAddress'));
        $billingaddress = trim($this->input->post('ubillingaddress'));
        $paymentTerms = trim($this->input->post('upaymentTerms'));
        $state = trim($this->input->post('ustate'));
        $gst_no = trim($this->input->post('ugst_no'));
        $state_no = trim($this->input->post('state_no'));
        $vendor_code = trim($this->input->post('vendor_code'));
        $pan_no = trim($this->input->post('pan_no'));
        $bank_details = trim($this->input->post('bank_details'));
        $pos = trim($this->input->post('pos'));
        $address1 = trim($this->input->post('address1'));
        $location = trim($this->input->post('location'));
        $pin = trim($this->input->post('pin'));
        $distance1 = trim($this->input->post('distncFrmClnt1'));
        $distance2 = trim($this->input->post('distncFrmClnt2'));
        $distance3 = trim($this->input->post('distncFrmClnt3'));
        $emailId = trim($this->input->post('emailId'));
        $discount = trim($this->input->post('discount'));
        $discountType = trim($this->input->post('discountType'));
        $customerType = $this->input->post('ucustomerType');
        
        $data = array(  
            "customer_name" => $customerName,
            "customer_code" => $customerCode,
            "billing_address" => $billingaddress,
            "shifting_address" => $shiftingAddress,
            "state" => $state,
            "gst_number" => $gst_no,
            "payment_terms" => $paymentTerms,
            "state_no" => $state_no,
            "vendor_code" => $vendor_code,
            "pan_no" => $pan_no,
            "bank_details" => $bank_details,
            "pos" => $pos,
            "address1" => $address1,
            "location" => $location,
            "pin" => $pin,
            "distncFrmClnt1"=> $distance1,
            "distncFrmClnt2"=> $distance2,
            "distncFrmClnt3"=> $distance3,
            "emailId" => $emailId,
            "discount" => $discount,
            "discountType" => $discountType,
            "customerType" => $customerType
        );
        // pr($data,1); 
        if(count(str_split($state_no)) > 2 || count(str_split($pos)) > 2 || count(str_split($paymentTerms)) > 2){
            $message = count(str_split($paymentTerms)) > 2 ? "Payment terms must be 2 digit" : (count(str_split($state_no)) > 2 ? "State no must be 2 digit" : "Pos must be 2 digit");
        }else{
        
            $result = $this->Crud->update_data("customer", $data, $id);
            if ($result) {
                $success = 1;
                $message = "Customer updated sucessfully.";
                // $this->addSuccessMessage('Customer updated sucessfully.');
                // $this->redirectMessage('customer');
            } else {
                $success = 0;
                $message = "Unable to update customer. Please try again.";
                // $this->addErrorMessage('Unable to update customer. Please try again.');
                // $this->redirectMessage('customer');
            }
        }
        $return_arr =[
            "success" =>$success,
            "message" =>$message
        ];
        echo json_encode($return_arr);
        exit();
    }


    public function checkDublicateGstNumber(){
        
        $gst_number = $this->input->get("gst_no");
        $id =  $this->input->get("id");
        $where = "";
        if($id > 0){
            $where = " AND id != $id";
        }
        $supplier = $this->db->query("SELECT id FROM `supplier`  WHERE gst_number = '$gst_number' $where");
        $supplier = $supplier->result();
        $return = true;
        if(count($supplier) > 0){
            $return = false;
        }
        echo json_encode($return);
        exit;
    }
    public function addSupplier()
    {

        $name = $this->input->post('supplierName');
        $number = $this->input->post('supplierNumber');
        $email = $this->input->post('supplierEmail');
        $mobile_no = $this->input->post('supplierMnumber');
        $location = $this->input->post('supplierlocation');
        $state = $this->input->post('state');
        $pan_card = $this->input->post('pan_card');
        $gst_no = $this->input->post('gst_no');
        $paymentTerms = $this->input->post('paymentTerms');
        $paymentDays = $this->input->post('paymentDays');
        $with_in_state = $this->input->post('with_in_state');
        $discount_type = $this->input->post('discount_type');
        $discount = $this->input->post('discount');
        $supplier = $this->Crud->read_data("supplier");
        $supplier_count = $this->Crud->read_data_num("supplier") + 1;
        // print_r($supplier);
        // $number = "THS00000" . $supplier_count;


        // $data = array(
        //  'supplier_name' => $name,
        //  'supplier_number' => $number,
        // );
        // $check = $this->Crud->read_data_where("supplier", $data);

        if (!empty($_FILES['nda_document']['name'])) {
            $image_path = "./public/uploads/documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['nda_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('nda_document')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
            } else {
                $picture4 = '';
                // echo "no 1";
            }
        } else {
            $picture4 = '';
            // echo "no 2";
        }
        if (!empty($_FILES['registration_document']['name'])) {
            $image_path = "./public/uploads/documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['registration_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('registration_document')) {
                $uploadData = $this->upload->data();
                $picture5 = $uploadData['file_name'];
            } else {
                $picture5 = '';
                // echo "no 1";
            }
        } else {
            $picture5 = '';
            // echo "no 2";
        }
        if (!empty($_FILES['other_document_1']['name'])) {
            $image_path = "./public/uploads/documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['other_document_1']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('other_document_1')) {
                $uploadData = $this->upload->data();
                $picture6 = $uploadData['file_name'];
            } else {
                $picture6 = '';
                // echo "no 1";
            }
        } else {
            $picture6 = '';
            // echo "no 2";
        }
        if (!empty($_FILES['other_document_2']['name'])) {
            $image_path = "./public/uploads/documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['other_document_2']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('other_document_2')) {
                $uploadData = $this->upload->data();
                $picture7 = $uploadData['file_name'];
            } else {
                $picture7 = '';
                // echo "no 1";
            }
        } else {
            $picture7 = '';
            // echo "no 2";
        }
        if (!empty($_FILES['other_document_3']['name'])) {
            $image_path = "./public/uploads/documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['other_document_3']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('other_document_3')) {
                $uploadData = $this->upload->data();
                $picture8 = $uploadData['file_name'];
            } else {
                $picture7 = '';
                // echo "no 1";
            }
        } else {
            $picture8 = '';
            // echo "no 2";
        }


        $success = 0;
        $message = "Something went wrong";
        $mode =  $this->input->post('mode');
        if($mode == "Add"){
            $data = array(
                'supplier_name' => $name,
                'supplier_number' => $number,
                'email' => $email,
                "payment_terms" => $paymentTerms,
                "payment_days" => $paymentDays,
                "state" => $state,
                "gst_number" => $gst_no,
                'location' => $location,
                'mobile_no' => $mobile_no,
                'pan_card' => $pan_card,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
                "registration_document" => $picture5,
                "nda_document" => $picture4,
                "other_document_1" => $picture6,
                "other_document_2" => $picture7,
                "other_document_3" => $picture8,
                "with_in_state" => $with_in_state,
                "discount" => $discount,
                "discount_type" => $discount_type
            );

            $result = $this->Crud->insert_data("supplier", $data);
            if ($result) {
                $success = 1;
                $message = "Supplier added Sucessfully";
            } else {
                $message = "Something went wrong";
            }
        }else if ($mode == "Update"){
            $data = array(
                'supplier_name' => $name,
                'email' => $email,
                "payment_terms" => $paymentTerms,
                "payment_days" => $paymentDays,
                "state" => $state,
                "gst_number" => $gst_no,
                'location' => $location,
                'mobile_no' => $mobile_no,
                'pan_card' => $pan_card,
                "registration_document" => $picture5,
                "nda_document" => $picture4,
                "other_document_1" => $picture6,
                "other_document_2" => $picture7,
                "other_document_3" => $picture8,
                "with_in_state" => $with_in_state,
                // "admin_approve"=>$admin_approve,
                "discount" => $discount,
                "discount_type" => $discount_type
            );
            $supplier_id = $this->input->post('supplier_id');
            $result = $this->welcome_model->update_supplier_data($data,$supplier_id);
            if ($result) {
                $success = 1;
                $message = "Supplier updated Sucessfully";
            } else {
                $message = "Something went wrong";
            }
        }
        $return_arr =[
            "success" =>$success,
            "message" =>$message
        ];
        echo json_encode($return_arr);
        exit();

    }

    public function updateSupplier()
    {
        $id = $this->input->post('id');

        $name = $this->input->post('updateName');
        $number = $this->input->post('updateNumber');
        $email = $this->input->post('updatesupplierEmail');
        $mobile_no = $this->input->post('updatesupplierMnumber');
        $location = $this->input->post('updatesupplierlocation');
        $paymentTerms = $this->input->post('upaymentTerms');
        $state = $this->input->post('ustate');
        $gst_no = $this->input->post('ugst_no');
        $admin_approve = $this->input->post('admin_approve');
        $with_in_state = $this->input->post('with_in_state');
        $success = 0;
        $message = "Something went wrong";
        if (!empty($_FILES['nda_document']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['nda_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('nda_document')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
            } else {
                $picture4 = $this->input->post('nda_document_old');
                // echo "no 1";
            }
        } else {
            $picture4 = $this->input->post('nda_document_old');
            // echo "no 2";
        }
        if (!empty($_FILES['registration_document']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['registration_document']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('registration_document')) {
                $uploadData = $this->upload->data();
                $picture5 = $uploadData['file_name'];
            } else {
                $picture5 = $this->input->post('registration_document_old');
                // echo $this->input->post('registration_document_old');
            }
        } else {
            $picture5 = $this->input->post('registration_document_old');
            // echo $this->input->post('registration_document_old');
        }

        if (!empty($_FILES['other_document_1']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['other_document_1']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('other_document_1')) {
                $uploadData = $this->upload->data();
                $picture6 = $uploadData['file_name'];
            } else {
                $picture6 = $this->input->post('other_document_1_old');
                // echo "no 1";
            }
        } else {
            $picture6 = $this->input->post('other_document_1_old');
            // echo "no 2";
        }
        if (!empty($_FILES['other_document_2']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['other_document_2']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('other_document_2')) {
                $uploadData = $this->upload->data();
                $picture7 = $uploadData['file_name'];
            } else {
                $picture7 = $this->input->post('other_document_2_old');
                // echo "no 1";
            }
        } else {
            $picture7 = $this->input->post('other_document_2_old');
            // echo "no 2";
        }
        if (!empty($_FILES['other_document_3']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['other_document_3']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('other_document_3')) {
                $uploadData = $this->upload->data();
                $picture8 = $uploadData['file_name'];
            } else {
                $picture7 = $this->input->post('other_document_3_old');
                // echo "no 1";
            }
        } else {
            $picture8 = $this->input->post('other_document_3_old');
            // echo "no 2";
        }

        $data = array(
            'supplier_number' => $number,
            'supplier_name' => $name,
            'supplier_number' => $number,
            'email' => $email,
            'location' => $location,
            'mobile_no' => $mobile_no,
            "state" => $state,
            "gst_number" => $gst_no,
            "payment_terms" => $paymentTerms,

        );
        $check = false;
        if ($check == true) {
            $message = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                'supplier_name' => $name,
                'supplier_number' => $number,
                'email' => $email,
                'location' => $location,
                'mobile_no' => $mobile_no,
                "state" => $state,
                "gst_number" => $gst_no,
                "payment_terms" => $paymentTerms,
                "registration_document" => $picture5,
                "nda_document" => $picture4,
                "other_document_1" => $picture6,
                "other_document_2" => $picture7,
                "other_document_3" => $picture8,
                "admin_approve" => $admin_approve,
                "with_in_state" => $with_in_state,

            );
            $result = $this->Crud->update_data("supplier", $data, $id);
            if ($result) {
                $message = "Updated Sucessfully";
                $success = 1;
                // echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $message = "Not Updated";
                // echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $return_arr =[
            "success" =>$success,
            "message" =>$message
        ];
        echo json_encode($return_arr);
        exit();
    }
    public function updateloading_user()
    {
        $id = $this->input->post('id');

        $so_number = $this->input->post('uso_num');
        $contractor = $this->input->post('ucontractor');
        $project_number = $this->input->post('uproject_number');
        $start_date = $this->input->post('ustart_date');
        $wbs_number = $this->input->post('uwbs_number');
        $target_date = $this->input->post('utarget_date');

        $data = array(
            'so_number' => $so_number,
            'contractor' => $contractor,
            "contractor" => $contractor,
            "so_number" => $so_number,
            "project_number" => $project_number,
            "start_date" => $start_date,
            "target_date" => $target_date,
            "wbs_id" => $wbs_number,
        );
        $check = $this->Crud->read_data_where("loading_user", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $result = $this->Crud->update_data("loading_user", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert(' Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }

    public function po()
    {
        $part_id = $this->uri->segment('2');
        $data['po_details'] = $this->Crud->get_data_by_id('po_details', $part_id, 'id');
        $cust_id = $data['po_details'][0]->customer_id;
        // print_r($cust_id);
        $data['po_id'] = $this->uri->segment('2');
        $data['po_list'] = $this->Crud->read_data("po_details");
        $data['cust'] = $this->Crud->get_data_by_id('customer', $cust_id, 'id');
        // $data['list'] = $this->Crud->read_data("c_po_so");
        $data['list'] = $this->Crud->get_data_by_id('c_po_so', $part_id, 'po_id');



        // $data['operations']  = $this->Crud->read_data("operations");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['partNumber'] = $this->Crud->get_data_by_id("parts");

        // $data['operations'] = $this->Crud->get_data_by_id("operations", $part_id, "part_number");

        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('po_detailed_details', $data);
        $this->load->view('footer');
    }
    public function drawing_history()
    {
        $part_number = $this->uri->segment('2');
        $data['child_part_list'] = $this->Crud->get_data_by_id('child_part', $part_number, 'part_number');



        // $data['operations']  = $this->Crud->read_data("operations");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['partNumber'] = $this->Crud->get_data_by_id("parts");

        // $data['operations'] = $this->Crud->get_data_by_id("operations", $part_id, "part_number");

        // print_r($data['tool_list']);
        $this->load->view('header');
        $this->load->view('drawing_history', $data);
        $this->load->view('footer');
    }
    public function price_revision()
    {
        $part_number = $this->uri->segment('2');
        $supplier_id = $this->uri->segment('3');

        $array = array(
            "part_number" => $part_number,
            "supplier_id" => $supplier_id,

        );

        // $data['child_part_list'] = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array);
        $child_part_list = $this->db->query("
            SELECT cp.*,s.supplier_name as supplier_name
            FROM child_part_master as cp
            LEFT JOIN supplier as s ON s.id = cp.supplier_id
            WHERE cp.part_number = '$part_number'
            AND cp.supplier_id  = $supplier_id
            ORDER BY cp.id DESC
        ");
        $data['child_part_list'] = $child_part_list->result();
        // pr($data['child_part_list'],1);
        // $data['child_part_list'] = $this->Crud->get_data_by_id('child_part_master', $part_number, 'part_number');



        // $data['operations']  = $this->Crud->read_data("operations");
        // $data['tool_list'] =  $this->Crud->read_data("tools");
        // $data['partNumber'] = $this->Crud->get_data_by_id("parts");

        // $data['operations'] = $this->Crud->get_data_by_id("operations", $part_id, "part_number");

        // print_r($data['tool_list']);
        // $this->load->view('header');
        // $this->load->view('price_revision', $data);
        $this->loadView('purchase/price_revision',$data);
        // $this->load->view('footer');

        // can use this query to get data for report for datatable

    //  $this->db->select('cpm.*, s.*, u.*, pt.*');
    // $this->db->from('child_part_master cpm');
    // $this->db->join('supplier s', 'cpm.supplier_id = s.id', 'left');
    // $this->db->join('uom u', 'cpm.uom_id = u.id', 'left');
    // $this->db->join('part_type pt', 'cpm.child_part_id = pt.id', 'left');
    // $this->db->where('cpm.part_number', $part_number);
    // $this->db->where('cpm.supplier_id', $supplier_id);
    // $this->db->order_by('cpm.id', 'desc');
    // $query = $this->db->get();
    // return $query->result();


    }



    public function loading()
    {
        $part_id = $this->uri->segment('2');
        $data['contractor'] = $this->Crud->read_data("contractor");
        $data['po_details'] = $this->Crud->get_data_by_id('po_details', $part_id, 'id');
        $g = $data['po_details'][0]->customer_id;
        $data['cust'] = $this->Crud->get_data_by_id('customer', $g, 'id');
        $data['wbs_num'] = $this->Crud->get_data_by_id('other_data', 'wbs', 'type');
        $data['details'] = $this->Crud->get_data_by_id('loading_user', $part_id, 'po_number');

        $data['loading_details'] = $this->Crud->get_data_by_id('c_po_so', $part_id, 'po_id');
        // $cust_id = $data['po_details'][0]->customer_id;
        $data['po_id'] = $this->uri->segment('2');
        $data['po_list'] = $this->Crud->read_data("po_details");
        // $data['cust'] = $this->Crud->get_data_by_id('customer', $cust_id, 'id');
        $data['list'] = $this->Crud->get_data_by_id('c_po_so', $part_id, 'po_id');

        $this->load->view('header');
        $this->load->view('loading_detail', $data);
        $this->load->view('footer');
    }
    public function addSO()
    {
        $PO = $this->input->post('PO');
        $id = $this->input->post('pid');
        $custname = $this->input->post('custname');
        $so_number = $this->input->post('so_number');
        $so_amt = $this->input->post('so_amt');
        $so_desc = $this->input->post('so_desc');
        $so_line = $this->input->post('so_line');
        $advance_amt = $this->input->post('advance_amt');
        $advance_amt = $advance_amt;
        $bank_name = null;
        $cheque_date = null;
        $payment_mode = null;
        $rtgs_cheque_number = null;



        if ($advance_amt > 0) {
            $bank_name = $this->input->post('bank_name');
            $cheque_date = $this->input->post('cheque_date');
            $payment_mode = $this->input->post('payment_mode');
            $rtgs_cheque_number = $this->input->post('rtgs_cheque_number');
        } else {
            $advance_amt = 0;
        }



        $data = array(
            "po_id" => $id,
            "so_number" => $so_number,
            "so_amt" => $so_amt,
            "so_desc" => $so_desc,
            "advance_amt" => $advance_amt,
            "so_line" => $so_line,

            "mode_of_payment" => $payment_mode,
            "bank_name" => $bank_name,
            "cheque_rtgs_number" => $rtgs_cheque_number,
            "date_of_cheque_rtgs" => $cheque_date,

        );
        $check = $this->Crud->read_data_where("c_po_so", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "po_id" => $id,
                "so_number" => $so_number,
                "so_amt" => $so_amt,
                "so_desc" => $so_desc,
                "so_line" => $so_line,
                "advance_amt" => $advance_amt,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
                "mode_of_payment" => $payment_mode,
                "bank_name" => $bank_name,
                "cheque_rtgs_number" => $rtgs_cheque_number,
                "date_of_cheque_rtgs" => $cheque_date,
            );
            $result = $this->Crud->insert_data("c_po_so", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateSO()
    {
        $PO = $this->input->post('PO');
        $id = $this->input->post('id');
        $so_number = $this->input->post('uso_number');
        $so_amt = $this->input->post('uso_amt');
        $so_desc = $this->input->post('uso_desc');
        $so_line = $this->input->post('uso_line');
        $advance_amt = $this->input->post('uadvance_amt');
        $advance_amt = $advance_amt;
        $bank_name = null;
        $cheque_date = null;
        $payment_mode = null;
        $rtgs_cheque_number = null;



        if ($advance_amt > 0) {
            $bank_name = $this->input->post('ubank_name');
            $cheque_date = $this->input->post('ucheque_date');
            $payment_mode = $this->input->post('upayment_mode');
            $rtgs_cheque_number = $this->input->post('urtgs_cheque_number');
        } else {
            $advance_amt = 0;
        }



        $data = array(
            "so_number" => $so_number,
            "so_amt" => $so_amt,
            "so_desc" => $so_desc,
            "advance_amt" => $advance_amt,
            "so_line" => $so_line,

            "mode_of_payment" => $payment_mode,
            "bank_name" => $bank_name,
            "cheque_rtgs_number" => $rtgs_cheque_number,
            "date_of_cheque_rtgs" => $cheque_date,

        );
        $check = $this->Crud->read_data_where("c_po_so", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "so_number" => $so_number,
                "so_amt" => $so_amt,
                "so_desc" => $so_desc,
                "so_line" => $so_line,
                "advance_amt" => $advance_amt,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
                "mode_of_payment" => $payment_mode,
                "bank_name" => $bank_name,
                "cheque_rtgs_number" => $rtgs_cheque_number,
                "date_of_cheque_rtgs" => $cheque_date,
            );
            $result = $this->Crud->update_data("c_po_so", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Update');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateBankDetails()
    {
        $id = $this->input->post('idd');

        $advance_amt = $this->input->post('uadvance_amt');
        $advance_amt = $advance_amt;
        $bank_name = null;
        $cheque_date = null;
        $payment_mode = null;
        $rtgs_cheque_number = null;



        if ($advance_amt > 0) {
            $bank_name = $this->input->post('ubank_name');
            $cheque_date = $this->input->post('ucheque_date');
            $payment_mode = $this->input->post('upayment_mode');
            $rtgs_cheque_number = $this->input->post('urtgs_cheque_number');
        } else {
            $advance_amt = 0;
        }



        $data = array(

            "advance_amt" => $advance_amt,
            "mode_of_payment" => $payment_mode,
            "bank_name" => $bank_name,
            "cheque_rtgs_number" => $rtgs_cheque_number,
            "date_of_cheque_rtgs" => $cheque_date,

        );
        $check = $this->Crud->read_data_where("c_po_so", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "advance_amt" => $advance_amt,

                "mode_of_payment" => $payment_mode,
                "bank_name" => $bank_name,
                "cheque_rtgs_number" => $rtgs_cheque_number,
                "date_of_cheque_rtgs" => $cheque_date,
            );
            $result = $this->Crud->update_data("c_po_so", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Update');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updateBankDetails2()
    {
        $id = $this->input->post('idd');
        $id_balance = $this->input->post('balance_idd');


        $bank_name = $this->input->post('ubank_name');
        $balance_amount = $this->input->post('balance_amount');
        $cheque_date = $this->input->post('ucheque_date');
        $payment_mode = $this->input->post('upayment_mode');
        $balanceee_amountt = $this->input->post('balanceee_amountt');
        $rtgs_cheque_number = $this->input->post('urtgs_cheque_number');


        $chengee = $balanceee_amountt - $balance_amount;
        $tata = array(
            'balance_amount' => $chengee,
        );
        $data = array(

            //      "advance_amt" => $advance_amt,

            "mode_payment_final" => $payment_mode,
            "amount_paid" => $balance_amount,
            "bank_name_final_payment" => $bank_name,
            "cheque_rtgs_number_final_pay" => $rtgs_cheque_number,
            "date_of_cheque_rtgs_final_pay" => $cheque_date,
        );
        $result = $this->Crud->update_data("c_po_so", $data, $id);
        if ($result) {
            $result11 = $this->Crud->update_data("bill_tracking", $tata, $id_balance);

            echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Unable to Update');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }

    public function addLoadingUser()
    {
        $contractor = $this->input->post('contractor');
        $po_id = $this->input->post('PO');
        $so_number = $this->input->post('so_number');
        $project_number = $this->input->post('project_number');
        $start_date = $this->input->post('start_date');
        $wbs_number = $this->input->post('wbs_number');
        $target_date = $this->input->post('target_date');



        // $customer_id = $this->Crud->get_data_by_id('customer', $customerName, 'id');

        // $customer_id = $customer_id[0]->id;

        $data = array(
            "contractor" => $contractor,
            "so_number" => $so_number,
            "po_number" => $po_id,
            "project_number" => $project_number,
            "start_date" => $start_date,
            "target_date" => $target_date,
            "wbs_id" => $wbs_number,

        );
        $check = $this->Crud->read_data_where("loading_user", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "contractor" => $contractor,
                "so_number" => $so_number,
                "po_number" => $po_id,
                "project_number" => $project_number,
                "start_date" => $start_date,
                "target_date" => $target_date,
                "wbs_id" => $wbs_number,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            $result = $this->Crud->insert_data("loading_user", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function addbilling_track()
    {
        $po_so_num = $this->input->post('po_so_num');
        $advance_amt = $this->input->post('advance_amt');
        $invoice_number = $this->input->post('invoice_number');
        $invoice_amount = $this->input->post('invoice_amt');
        $invoice_date = $this->input->post('invoice_date');
        $tds_amount = $this->input->post('tds_amount');
        $less_tds_amount = $this->input->post('less_tds_amount');
        $stv_number = $this->input->post('stv_number');
        $stv_amount = $this->input->post('stv_amount');
        $datee = $this->input->post('datee');
        $statement_of_booking = $this->input->post('statement_of_booking');
        $payment_due_date_mk = $this->input->post('payment_due_date_mk');
        $payment_due_date_customer = $this->input->post('payment_due_date_customer');

        $balance_amount = $invoice_amount - $advance_amt;


        // $customer_id = $this->Crud->get_data_by_id('customer', $customerName, 'id');

        // $customer_id = $customer_id[0]->id;

        $data = array(

            "c_po_so_id" => $po_so_num,
            "invoice_number" => $invoice_number,
            "invoice_date" => $invoice_date,
            "invoice_amount" => $invoice_amount,
            "tds_amount" => $tds_amount,
            "less_tds_amount" => $less_tds_amount,
            "stv_number" => $stv_number,
            "balance_amount" => $balance_amount,
            "date" => $datee,
            "statement_booking_amount" => $statement_of_booking,
            "payment_due_date_mk" => $payment_due_date_mk,
            "stv_amount" => $stv_amount,
            "payment_due_date_customer" => $payment_due_date_customer,

        );
        $check = $this->Crud->read_data_where("bill_tracking", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "c_po_so_id" => $po_so_num,
                "invoice_number" => $invoice_number,
                "invoice_date" => $invoice_date,
                "invoice_amount" => $invoice_amount,
                "tds_amount" => $tds_amount,
                "less_tds_amount" => $less_tds_amount,
                "stv_number" => $stv_number,
                "balance_amount" => $balance_amount,
                "date" => $datee,
                "statement_booking_amount" => $statement_of_booking,
                "payment_due_date_mk" => $payment_due_date_mk,
                "stv_amount" => $stv_amount,
                "payment_due_date_customer" => $payment_due_date_customer,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            $result = $this->Crud->insert_data("bill_tracking", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function updatebilling_track()
    {
        $id = $this->input->post('update_id');
        $po_so_num = $this->input->post('upo_so_num');
        $invoice_number = $this->input->post('uinvoice_number');
        $invoice_amount = $this->input->post('uinvoice_amt');
        $invoice_date = $this->input->post('uinvoice_date');
        $tds_amount = $this->input->post('utds_amount');
        $less_tds_amount = $this->input->post('uless_tds_amount');
        $stv_number = $this->input->post('ustv_number');
        $stv_amount = $this->input->post('ustv_amount');
        $datee = $this->input->post('udatee');
        $statement_of_booking = $this->input->post('ustatement_of_booking');
        $payment_due_date_mk = $this->input->post('upayment_due_date_mk');
        $payment_due_date_customer = $this->input->post('upayment_due_date_customer');




        // $customer_id = $this->Crud->get_data_by_id('customer', $customerName, 'id');

        // $customer_id = $customer_id[0]->id;

        $data = array(

            "c_po_so_id" => $po_so_num,
            "invoice_number" => $invoice_number,
            "invoice_date" => $invoice_date,
            "invoice_amount" => $invoice_amount,
            "tds_amount" => $tds_amount,
            "less_tds_amount" => $less_tds_amount,
            "stv_number" => $stv_number,
            "date" => $datee,
            "statement_booking_amount" => $statement_of_booking,
            "payment_due_date_mk" => $payment_due_date_mk,
            "stv_amount" => $stv_amount,
            "payment_due_date_customer" => $payment_due_date_customer,

        );
        $check = $this->Crud->read_data_where("bill_tracking", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "c_po_so_id" => $po_so_num,
                "invoice_number" => $invoice_number,
                "invoice_date" => $invoice_date,
                "invoice_amount" => $invoice_amount,
                "tds_amount" => $tds_amount,
                "less_tds_amount" => $less_tds_amount,
                "stv_number" => $stv_number,
                "date" => $datee,
                "statement_booking_amount" => $statement_of_booking,
                "payment_due_date_mk" => $payment_due_date_mk,
                "stv_amount" => $stv_amount,
                "payment_due_date_customer" => $payment_due_date_customer,

            );
            $result = $this->Crud->update_data("bill_tracking", $data, $id);
            if ($result) {
                echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Not Updated');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }
    public function get_id()
    {
        // echo "hi";
        // echo "<script>alert('Added Sucessfully');</script>";

        $c_po_so_id = $this->input->post('iddd');
        //  echo "<script>alert($c_po_so_id);</script>";

        $so_po_id = $this->SupplierParts->getSupplierPartOnlyById($c_po_so_id);
        // $po_id = $this->Crud->get_data_by_id("po_details", $so_po_id[0]->po_id, "id");
        // $customer = $this->Crud->get_data_by_id("customer", $po_id[0]->customer_id, "id");

        $result_name = array(
            "part_name" => $so_po_id[0]->part_description,
            "revision_date" => $so_po_id[0]->revision_date,
            "revision_no" => $so_po_id[0]->revision_no,
            "price" => $so_po_id[0]->part_rate,
        );
        $json = json_encode($result_name);
        echo $json;
    }
    public function get_id_supplier()
    {
        // echo "hi";
        // echo "<script>alert('Added Sucessfully');</script>";

        $supplier_ajax_id = $this->input->post('idd1');
        //  echo "<script>alert($supplier_ajax_id);</script>";

        $supplier_ajax_id1 = $this->Crud->get_data_by_id("supplier", $supplier_ajax_id, "id");
        // $po_id = $this->Crud->get_data_by_id("po_details", $so_po_id[0]->po_id, "id");
        // $customer = $this->Crud->get_data_by_id("customer", $po_id[0]->customer_id, "id");

        $result_name1 = array(
            "payment_terms" => $supplier_ajax_id1[0]->payment_terms,
            "gstn" => $supplier_ajax_id1[0]->gst_number,
            "location" => $supplier_ajax_id1[0]->location,
            // "revision_no" => $supplier_ajax_id[0]->revision_no,
            // "price" => $supplier_ajax_id[0]->part_rate,
        );
        $json = json_encode($result_name1);
        echo $json;
    }



    public function bom()
    {
        $customer_id = $this->uri->segment('2');
        $data['id'] = $customer_id;
        $data['customer_id'] = $customer_id;

        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data['operations'] = $this->Crud->read_data("operations");
        // $data['customer_part_list'] = "";

        $role_management_data = $this->db->query('SELECT DISTINCT customer_master_id, operation_id FROM `customer_part_operation`  ORDER BY `id` DESC');
        $data['customer_part_rate'] = $role_management_data->result();
        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");
        $data['child_part_list'] = $this->SupplierParts->readSupplierParts();
        $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");

        // if ($data['customer_part']) {
        //  $i = 1;
        //  foreach ($data['customer_part'] as $c) {
        //      if ($customer_id == $c->customer_id) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
        //          $data['customer'][$c->customer_id] = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
        //      }
        //  }
        // }

        // $this->load->view('header');
        // $this->load->view('bom', $data);
        // $this->load->view('footer');
        $data['entitlements'] = $this->session->userdata['entitlements'];
        
        $this->loadView('customer/bom',$data);
    }
    public function customer_part_main()
    {

        $data['id'] = $this->uri->segment('2');
        $customer_id = $this->uri->segment('2');
        $data['customer_id'] = $this->uri->segment('2');

        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['customers_part_type'] = $this->Crud->read_data("customer_part_type");
        $data['customers'] = $this->Crud->read_data("customer");
        $data['customer_part'] = $this->Crud->read_data("customer_part");
        $data['operations'] = $this->Crud->read_data("operations");
        // $data['customer_part_list'] = "";

        $role_management_data = $this->db->query('SELECT DISTINCT customer_master_id,operation_id FROM `customer_part_operation`  ORDER BY `id` DESC');
        $data['customer_part_rate'] = $role_management_data->result();

        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");

        $data['child_part_list'] = $this->SupplierParts->readSupplierParts();
        $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        // $data['bom_list'] = $this->Crud->read_data("bom");
        $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");

        // $this->load->view('header');
        // $this->load->view('customer_part_main', $data);
        // $this->load->view('footer');
        $this->loadView('customer/customer_part_main',$data);
    }
    public function bom_by_id()
    {
        $data['customer_part_id'] = $this->uri->segment('2');
        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['customer_part_id'], "id");
        $data['child_part_list'] = $this->SupplierParts->readSupplierParts();
        $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['customer_part_id'], "customer_part_id");
        $role_management_data = $this->db->query('
            SELECT b.*,u.uom_name,cp.part_number,cp.part_description
            FROM `bom` as b
            LEFT JOIN child_part as cp ON cp.id = b.child_part_id
            LEFT JOIN uom as u ON u.id = cp.uom_id 
            WHERE `customer_part_id` = '.$data['customer_part_id'].'
            ORDER BY `id` DESC
            ');
        $data['bom_list'] = $role_management_data->result();
        
        // $this->load->view('header');
        $this->loadView('sales/bom_by_id', $data);
        // $this->load->view('footer');
    }
    public function subcon_bom()
    {

        $data['customer_part_id'] = $this->uri->segment('2');


        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['customer_part_id'], "id");

        $data['child_part_list'] = $this->SupplierParts->readSupplierParts();
        $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        // $data['bom_list'] = $this->Crud->read_data("bom");
        // $data['bom_list'] = $this->Crud->get_data_by_id("subcon_bom", $data['customer_part_id'], "customer_part_id");
        $role_management_data = $this->db->query('
            SELECT b.*,u.uom_name,cp.part_number,cp.part_description
            FROM `subcon_bom` as b
            LEFT JOIN child_part as cp ON cp.id = b.child_part_id
            LEFT JOIN uom as u ON u.id = cp.uom_id 
            WHERE `customer_part_id` = '.$data['customer_part_id'].'
            ORDER BY `id` DESC
            ');
        $data['bom_list'] = $role_management_data->result();


        // pr($data['bom_list'],1);


        // $this->load->view('header');
        $this->loadView('sales/subcon_bom', $data);
        // $this->load->view('footer');
    }
    public function raw_material_inspection()
    {

        $data['child_part_id'] = $this->uri->segment('2');
        $data['child_part'] = $this->SupplierParts->getSupplierPartById($data['child_part_id']);
        $data['raw_material_inspection_master'] = $this->Crud->get_data_by_id("raw_material_inspection_master", $data['child_part_id'], "child_part_id");
        // print_r($data['customer']);
        $this->loadView('purchase/raw_material_inspection', $data);
        // $this->load->view('header');
        // $this->load->view('raw_material_inspection', $data);
        // $this->load->view('footer');
    }
    public function raw_material_inspection_inwarding()
    {

        $data['child_part_id'] = $this->uri->segment('2');
        $data['po_id'] = $this->uri->segment('3');
        $data['supplier_id'] = $this->uri->segment('4');
        $data['inwarding_id'] = $this->uri->segment('5');
        $data['accepted_qty'] = $this->uri->segment('6');
        $data['rejected_qty'] = $this->uri->segment('7');
        $data['child_part_id_table'] = $this->uri->segment('8');

        $data['child_part_new'] = $this->SupplierParts->getSupplierPartById($data['child_part_id_table']);
        $data['child_part'] = $this->Crud->get_data_by_id("child_part_master", $data['child_part_id'], "id");
        $data['child_part_data'] = $this->SupplierParts->getSupplierPartById($data['child_part'][0]->child_part_id);
        $data['inwarding_data'] = $this->Crud->get_data_by_id("inwarding", $data['inwarding_id'], "id");

        // print_r($data['child_part_new']);
        $data['raw_material_inspection_master'] = $this->Crud->get_data_by_id("raw_material_inspection_master", $data['child_part_id_table'], "child_part_id");
        foreach ($data['raw_material_inspection_master'] as $key => $u) {
            $data_old_po_number = array(
                'child_part_id' => $data['child_part_id'],
                'raw_material_inspection_master_id' => $u->id,
                'invoice_number' => $data['inwarding_data'][0]->invoice_number,
            );
            $raw_material_inspection_report_data = $this->Common_admin_model->get_data_by_id_multiple_condition("raw_material_inspection_report", $data_old_po_number);
            $data['raw_material_inspection_master'][$key]->raw_material_inspection_report_data = $raw_material_inspection_report_data;
        }
        // pr($data['raw_material_inspection_master'],1);
        // $this->load->view('header');
        $this->loadView('quality/raw_material_inspection_inwarding', $data);
        // $this->load->view('footer');
    }
    public function operations_bom()
    {

        $data['customer_part_id'] = $this->uri->segment('2');
        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['customer_part_id'], "id");
        $customer = $data['customer'];

        $data['child_part_list'] = $this->InhouseParts->readInhouseParts();
        $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data_old = array(
            "customer_part_number" => $customer[0]->part_number,
            "customer_id" => $data['customer'][0]->customer_id

        );
        $data['operations_bom'] = $this->Crud->get_data_by_id_multiple_condition("operations_bom", $data_old);
        $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['customer_part_id'], "customer_part_id");
        $operations_bom = $data['operations_bom'];
        foreach ($operations_bom as $key => $po) {
            $current_stock = "";
            if ($po->output_part_table_name == "inhouse_parts") {
                $output_part_data = $this->InhouseParts->getInhousePartById($po->output_part_id);
                $operations_bom[$key]->output_part_data = $output_part_data;
                $operations_bom[$key]->current_stock = $output_part_data[0]->stock;
                $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                $operations_bom[$key]->uom = $uom_data[0]->uom_name;
                $operations_bom[$key]->part_type = "Inhouse Part";
            } else {
                $output_part_data  = $this->Crud->get_data_by_id("customer_part", $po->output_part_id, "id");
                $operations_bom[$key]->output_part_data = $output_part_data;
                $customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($output_part_data[0]->part_number);
                $operations_bom[$key]->current_stock = $customer_parts_master_data[0]->fg_stock;
                $operations_bom[$key]->uom = $output_part_data[0]->uom;
                $operations_bom[$key]->part_type = "Customer Part";
            }
        }
        // pr($operations_bom,1);
        // $this->load->view('header');
        $this->loadView('sales/operations_bom', $data);
        // $this->load->view('footer');
    }
    public function customer_part_wip_stock_report()
    {
        checkGroupAccess("customer_part_wip_stock_report","list","Yes");
        // $role_management_data = $this->db->query('SELECT id,customer_name FROM `customer`');
        // $data['customer_parts_data'] = $role_management_data->result();

        $role_management_data = $this->db->query('SELECT customer_part.part_number,customer_part.part_description,customer_part.id, customer.customer_name FROM customer_part INNER JOIN customer ON customer_part.customer_id=customer.id;');
        $data['customer_parts_data'] = $role_management_data->result();
        $selected_customer_part_number = $this->input->post("selected_customer_part_number");
        $data['selected_customer_part_number'] = $selected_customer_part_number;
        if (!empty($selected_customer_part_number)) {

            $data['operations_bom'] = $this->Crud->get_data_by_id("operations_bom", $selected_customer_part_number, "customer_part_number");
        } else {
            $data['operations_bom'] = array();
            // $role_management_data = $this->db->query('SELECT * FROM `operations_bom` ORDER BY id DESC  LIMIT 20');
            // $data['operations_bom'] = $role_management_data->result();

        }
        // pr($this->db->last_query(),1);
        $data['customer_data'] = [];
        foreach ($data['operations_bom'] as $po) {
            // pr($po);
            $current_stock = "";
            $type = "";

            $data['customer_data'][$po->id] = $this->Crud->get_data_by_id("customer", $po->customer_id, "id");
            // $customer_part_data = $this->Crud->get_data_by_id("customer_part", $po->customer_part_number, "id");

            if ($po->output_part_table_name == "inhouse_parts") {
                $data['type'][$po->id] = "inhouse_parts";
                $output_part_data = $data['output_part_data'][$po->id] = $this->InhouseParts->getInhousePartById($po->output_part_id);
                $data['current_stock'][$po->id] = $output_part_data[0]->production_qty;
                $data['uom_data'][$po->id] = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                $uom = $uom_data[0]->uom_name;
            } else {
                $data['type'][$po->id] = "customer_stock";
                // echo "s";
                // echo $po;
                $output_part_data = $data['output_part_data'][$po->id] = $this->Crud->get_data_by_id("customer_part", $po->output_part_id, "id");
                $customer_parts_master_data = $data['customer_parts_master_data'][$po->id] = $this->CustomerPart->getCustomerPartByPartNumber($output_part_data[0]->part_number);
                // print_r($customer_parts_master_data[0]->fg_stock);
                $data['current_stock'][$po->id]= $customer_parts_master_data[0]->fg_stock;
                // $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->upm, "id");
                $uom = $output_part_data[0]->uom;
                // print_r($output_part_data);
            }
        } 
        // pr($data['current_stock'],1);

        // print_r($data['operations_bom']);
        // $this->load->view('header');
        // $this->load->view('customer_part_wip_stock_report', $data);
        // $this->load->view('footer');
        $this->getPage('subcom_challan/customer_part_wip_stock_report',$data);
    }
    public function subcon_supplier_challan_part_report()
    {

        checkGroupAccess("subcon_supplier_challan_part_report","list","Yes");
        $column[] = [
            "data" => "supplier_name",
            "title" => "Supplier",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Child Part",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "challan_number",
            "title" => "Challan No",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "created_date",
            "title" => "Challan Date",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "aging",
            "title" => "Aging Date",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "Challan Qty",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "remaning_qty",
            "title" => "Remaning qty",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_rate",
            "title" => "Part Rate",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "process",
            "title" => "Process",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "value_qty",
            "title" => "Value (Challan Qty)",
            "width" => "17%",
            "className" => "dt-center",
            "orderable"=>false
        ];
       
        $column[] = [
            "data" => "value_qty_remaning",
            "title" => "Value (Remaining Qty)",
            "width" => "7%",
            "className" => "dt-center",
            "orderable"=>false
        ];
        
          
        $date_filter = date("Y/m/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
        // $data['box_data'] = $this->welcome_model->getSubConReportView();
        $data['display_arr'] = $display_arr;
        $data['child_part_data'] = $child_part_data;
        $data['customer_data'] = $customer_data;
        $data['challan_data'] = $challan_data;
        $data['supplier_data'] = $supplier_data;
        $data['main_total_2'] = $main_total_2;
        $data['main_total'] = $main_total;

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
        $data["sorting_column"] = json_encode([]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data['customer_parts_data'] = $this->Crud->customQuery('SELECT id,part_number, part_description FROM `child_part`');
        $data['supplier'] = $this->Crud->customQuery('SELECT * FROM `supplier`');
        
        // $this->load->view('header');
        // $this->load->view('subcon_supplier_challan_part_report', $data);
        // $this->load->view('footer');
        $this->getPage('subcom_challan/subcon_supplier_challan_part_report',$data);
    }

    public function getSubcomReportDataAjax(){
        
        $post_data = $this->input->post();
        $column_index = array_column($post_data["columns"], "data");
        // pr($post_data,1);
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
        
        $data = $this->welcome_model->getSubConReportView($condition_arr,$post_data["search"]);
        // pr($data,1);
        foreach ($data as $key => $val) {
            $data[$key]['value_qty'] = number_format($val['qty'] * $val['part_rate'],2,".","");
            $data[$key]['value_qty_remaning'] = number_format($val['remaning_qty'] * $val['part_rate'],2,".","");
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($val['created_date']);
            $diff = date_diff($date1, $date2);
            $data[$key]['aging'] = $diff->format("%R%a");
            $data[$key]['created_date'] = defaultDateFormat($val['created_date']);
        
        }
        
        $data["data"] = $data;
        
        $total_record = $this->welcome_model->getSubConReportViewCount([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['tot_count'];
        $data["recordsFiltered"] = $total_record['tot_count'];
        
        echo json_encode($data);
    }

    public function sharing_bom()
    {



        $child_part_list = $this->db->query('SELECT id,part_number,part_description FROM `child_part`');
        $data['child_part_list'] = $child_part_list->result();

        $data['sharing_bom'] = $this->Crud->read_data("sharing_bom");

        $this->load->view('header');
        $this->load->view('sharing_bom', $data);
        $this->load->view('footer');
    }
    public function operations_bom_inputs()
    {

        $data['operations_bom_id'] = $this->uri->segment('2');
        $data['output_part_id'] = $this->uri->segment('3');
        $data['output_part_id_new'] = $this->uri->segment('4');
        $data['output_part_data'] = $this->InhouseParts->getInhousePartById($data['output_part_id']);

        // output_part_data
        $data['operations_bom'] = $this->Crud->get_data_by_id("operations_bom", $data['operations_bom_id'], "id");
        $data['operations_bom_inputs'] = $this->Crud->get_data_by_id("operations_bom_inputs", $data['operations_bom_id'], "operations_bom_id");
        $data['supplier'] = $this->Crud->read_data("supplier");
        $child_part_list = $this->db->query('SELECT id,part_number,part_description FROM `child_part`');
        $data['child_parts_data'] = $child_part_list->result();
        $data['child_part_list'] = $this->InhouseParts->readInhouseParts();

        $operations_bom_inputs = $data['operations_bom_inputs'];
        $is_data = false;
        foreach ($operations_bom_inputs as $key=>$po) {
            if ($po->input_part_table_name == "inhouse_parts") {
                $is_data = true;
                $output_part_data = $this->InhouseParts->getInhousePartOnlyById($po->input_part_id);
                $operations_bom_inputs[$key]->output_part_data = $output_part_data;
                $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                $operations_bom_inputs[$key]->uom = $uom_data[0]->uom_name;
            } else {
                $is_data = true;
                $output_part_data = $this->Crud->get_data_by_id("child_part", $po->input_part_id, "id");
                $operations_bom_inputs[$key]->output_part_data = $output_part_data;
                $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                $operations_bom_inputs[$key]->uom = $uom_data[0]->uom_name;
            }
        }
        $data['is_data'] = $is_data;
        $data['operations_bom_inputs'] = $operations_bom_inputs;
        
        // $this->load->view('header');
        $this->loadView('sales/operations_bom_inputs', $data);
        // $this->load->view('footer');
    }
    public function new_po()
    {
        checkGroupAccess("new_po","list","Yes");
        $data['id'] = $this->uri->segment('2');
        $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");
        $data['supplier'] = $this->Crud->read_data("supplier");
        $data['client'] = $this->Crud->read_data("client");
        $data['gst_structure'] = $this->Crud->read_data("gst_structure");
        $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");
        // $this->load->view('header');
        $this->loadView('purchase/new_po', $data);
        // $this->load->view('footer');
    }

    public function new_po_sub()
    {
        checkGroupAccess("new_po_sub","list","Yes");
        $data['id'] = $this->uri->segment('2');
        //$data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");
        $data['supplier'] = $this->Crud->read_data("supplier");
        $data['client'] = $this->Crud->read_data("client");
        //$data['process'] = $this->Crud->read_data("process");
        //$data['customer_part_list'] = $this->Crud->read_data("customer_part");
        //$data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");
        // $this->load->view('header');
        $this->loadView('purchase/new_po_sub', $data);
        // $this->load->view('footer');
    }

    public function new_sales_subcon()
    {

        $data['id'] = $this->uri->segment('2');
        // $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");

        // $data['supplier'] = $this->Crud->read_data("supplier");
        $data['customer'] = $this->Crud->read_data("customer");
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        // $data['bom_list'] = $this->Crud->read_data("bom");
        // $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");


        // echo ":hi";



        $child_part_list = $this->db->query('SELECT DISTINCT po_number,po_end_date FROM `customer_po_tracking`');
        $data['new_po'] = $child_part_list->result();
        $this->load->view('header');
        $this->load->view('new_sales_subcon', $data);
        $this->load->view('footer');
    }


    public function generate_rejection_flow()
    {
        $customer_id = $this->input->post('customer_id');

        $remark = $this->input->post('remark');
        $po_date = $this->input->post('po_date');
        $qty = $this->input->post('qty');

        $mode = $this->input->post('mode');
        $transporter = $this->input->post('transporter');
        $vehicle_number = $this->input->post('vehicle_number');
        $lr_number = $this->input->post('lr_number');
        $price = $this->input->post('price');
        $hsn_code = $this->input->post('hsn_code');
        $customer_part_id = $this->input->post('customer_part_id');
        $part_number = $this->input->post('part_number');
        $type = $this->input->post('type');

        $expiry_po_date = $this->input->post('expiry_po_date');
        $data['new_sales'] = $this->Crud->read_data("new_sales");
        // $data['po_date'] = $this->Crud-  >read_data("po_date");
        // $data['expiry_po_date'] = $this->Crud->read_data("expiry_po_date");


        $sql = "SELECT sales_number FROM new_sales_rejection WHERE sales_number like '" . $this->getSalesRejectionTestSerialNo() . "%' order by id desc LIMIT 1";
        $latestSeqFormat = $this->Crud->customQuery($sql);
        foreach ($latestSeqFormat as $p) {
            $currentSaleNo = $p->sales_number;
        }
        $count = substr($currentSaleNo, strlen($this->getSalesRejectionTestSerialNo())) + 1;
        $po_number = $this->getSalesRejectionTestSerialNo() . $count;

        $data = array(
            "customer_id" => $customer_id,
            "sales_number" => $po_number,
            "remark" => $remark,
            "part_number" => $part_number,
            "type" => $type,
            "mode" => $mode,
            "transporter" => $transporter,
            "vehicle_number" => $vehicle_number,
            "lr_number" => $lr_number,
            "price" => $price,
            "hsn_code" => $hsn_code,
            "qty" => $qty,
            "created_by" => $this->user_id,
            "created_date" => $this->current_date,
            "created_time" => $this->current_time,
            "created_by" => $this->current_date,
            "created_day" => $this->date,
            "created_month" => $this->month,
            "created_year" => $this->year,
        );


        $result = $this->Crud->insert_data("rejection_flow_new", $data);
        if ($result) {
            echo "<script>alert('Successfully Added');document.location='" . base_url('view_rejection_flow/') . $result . "'</script>";
        } else {
            echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }
    public function new_sales_rejection()
    {

        $data['id'] = $this->uri->segment('2');
        // $data['customer'] = $this->Crud->get_data_by_id("customer_part", $data['id'], "id");

        // $data['supplier'] = $this->Crud->read_data("supplier");
        $data['customer'] = $this->Crud->read_data("customer");
        // $data['customer_part_list'] = $this->Crud->read_data("customer_part");
        // $data['bom_list'] = $this->Crud->read_data("bom");
        // $data['bom_list'] = $this->Crud->get_data_by_id("bom", $data['id'], "customer_part_id");


        // echo ":hi";



        $this->load->view('header');
        $this->load->view('new_sales_rejection', $data);
        $this->load->view('footer');
    }

    public function rejection_flow()
    {

        $data['id'] = $this->uri->segment('2');
        $data['customer'] = $this->Crud->read_data("customer");

        // $this->load->view('header');
        // $this->load->view('rejection_flow', $data);
        // $this->load->view('footer');
        $this->loadView('sales/rejection_flow',$data);
    }
    public function addbom()
    {

        $customer_part_id = $this->input->post('customer_part_id');
        $child_part_id = $this->input->post('child_part_id');
        $quantity = $this->input->post('quantity');
        $data = array(

            "customer_part_id" => $customer_part_id,
            "child_part_id" => $child_part_id,


        );
        $check = $this->Crud->read_data_where("bom", $data);
        $success = 0;
        $messages = "Something went wrong.";
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "customer_part_id" => $customer_part_id,
                "child_part_id" => $child_part_id,
                "quantity" => $quantity,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,

            );
            $result = $this->Crud->insert_data("bom", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success = 1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function add_subcon_bom()
    {

        $customer_part_id = $this->input->post('customer_part_id');
        $child_part_id = $this->input->post('child_part_id');
        $quantity = $this->input->post('quantity');
        $data = array(

            "customer_part_id" => $customer_part_id,
            "child_part_id" => $child_part_id,


        );
        $success = 0;
        $messages = "Something went wrong.";
        $check = $this->Crud->read_data_where("subcon_bom", $data);
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "customer_part_id" => $customer_part_id,
                "child_part_id" => $child_part_id,
                "quantity" => $quantity,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,

            );
            $result = $this->Crud->insert_data("subcon_bom", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success =1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }


    public function add_operations_bom()
    {

        $customer_part_number = $this->input->post('customer_part_number');
        $output_part_id = $this->input->post('output_part_id');
        $output_part_table_name = $this->input->post('output_part_table_name');
        $scrap_factor = $this->input->post('scrap_factor');
        $customer_id = $this->input->post('customer_id');
        $data = array(

            "customer_part_number" => $customer_part_number,
            "customer_id" => $customer_id,
            "output_part_id" => $output_part_id,
            "output_part_table_name" => $output_part_table_name,
        );
        $check = $this->Crud->read_data_where("operations_bom", $data);
        // print_r($check);
        $success = 0;
        $messages = "Something went wrong.";
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "customer_part_number" => $customer_part_number,
                "output_part_id" => $output_part_id,
                "output_part_table_name" => $output_part_table_name,
                "customer_id" => $customer_id,
                "created_id" => $this->user_id,
                "scrap_factor" => $scrap_factor,
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
                "day" => $this->date,
                "month" => $this->month,
                "year" => $this->year,

            );
            $result = $this->Crud->insert_data("operations_bom", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success =1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function add_operations_bom_inputs()
    {

        $operations_bom_id  = $this->input->post('operations_bom_id');
        $input_part_id = $this->input->post('input_part_id');
        $qty = $this->input->post('qty');
        $input_part_table_name = $this->input->post('input_part_table_name');
        $operation_number = $this->input->post('operation_number');
        $operation_description = $this->input->post('operation_description');
        $data = array(
            "operations_bom_id" => $operations_bom_id,
            "input_part_id" => $input_part_id,
            "input_part_table_name" => $input_part_table_name,
        );
        $success = 0;
        $messages = "Something went wrong.";
        $check = $this->Crud->read_data_where("operations_bom_inputs", $data);
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "operations_bom_id" => $operations_bom_id,
                "input_part_id" => $input_part_id,
                "input_part_table_name" => $input_part_table_name,
                "qty" => $qty,
                "operation_number" => $operation_number,
                "operation_description" => $operation_description,
                "created_id" => $this->user_id,
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
                "day" => $this->date,
                "month" => $this->month,
                "year" => $this->year,

            );
            $result = $this->Crud->insert_data("operations_bom_inputs", $data);
            if ($result) {
                $messages = "Added Sucessfully";
                $success = 1;
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();

    }

    public function update_operations_bom_output()
    {

        $record_id =  $this->input->post('record_id');
        $customer_part_number = $this->input->post('customer_part_number');
        $output_part_id = $this->input->post('output_part_id');
        $orig_output_part_id = $this->input->post('orig_output_part_id');
        $output_part_table_name = $this->input->post('output_part_table_name');
        $scrap_factor = $this->input->post('scrap_factor');
        $customer_id = $this->input->post('customer_id');
        $data = array(
            "customer_part_number" => $customer_part_number,
            "customer_id" => $customer_id,
            "output_part_id" => $output_part_id,
            "output_part_table_name" => $output_part_table_name,
        );
        $success = 0;
        $messages = "Something went wrong.";
        //if we are trying to update the same record then don't look for existing check.
        $isRecordExists = false;
        if ($orig_output_part_id != $output_part_id) {
            $check = $this->Crud->read_data_where("operations_bom", $data);
            if ($check != 0) {
                $isRecordExists = true;
                // $this->addErrorMessage('Record already exist.');
                // $this->redirectMessage();
                $messages = "Record already exist.";
            }
        }
        if (!$isRecordExists) {
            $data = array(
                "customer_part_number" => $customer_part_number,
                "output_part_id" => $output_part_id,
                "output_part_table_name" => $output_part_table_name,
                "customer_id" => $customer_id,
                "created_id" => $this->user_id,
                "scrap_factor" => $scrap_factor,
                "created_date" => $this->current_date,
                "created_time" => $this->current_time,
                "day" => $this->date,
                "month" => $this->month,
                "year" => $this->year,
            );

            $result = $this->Crud->update_data("operations_bom", $data, $record_id);
            if ($result) {
                $messages ="Record updated sucessfully.";
                $success = 1;
                // $this->addSuccessMessage('Record updated sucessfully.');
            } else {
                $messages = "Failed to update.";
                // $this->addErrorMessage('Failed to update.');
            }
            
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }

    public function update_operations_bom_inputs()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $operation_number = $this->input->post('operation_number');
        $operation_description = $this->input->post('operation_description');

        $data = array(

            "qty" => $qty,
            "operation_number" => $operation_number,
            "operation_description" => $operation_description,

        );
        $success = 0;
        $messages = "Something went wrong.";
        $result = $this->Crud->update_data("operations_bom_inputs", $data, $id);
        if ($result) {
            $messages = "Updated Sucessfully";
            $success = 1;
            // echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $messages = "Unable to Add";
            // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function updatebom()
    {
        $success = 0;
        $messages = "Something went wrong.";
        $id = $this->input->post('id');
        $customer_id = $this->input->post('customer_id');
        $customer_part_id = $this->input->post('customer_part_id');
        $child_part_id = $this->input->post('child_part_id');
        $quantity = $this->input->post('quantity');
        $data = array(

            "customer_part_id" => $customer_part_id,
            "child_part_id" => $child_part_id,

        );
        $check = $this->Crud->read_data_where("bom", $data);
        if ($check != 0) {
            $messages = "Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "customer_part_id" => $customer_id,
                "child_part_id" => $child_part_id,
                "quantity" => $quantity,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,

            );
            $result = $this->Crud->update_data("bom", $data, $id);
            if ($result) {
                $messages = "Updated Sucessfully";
                $success = 1;
                // echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function update_subcon_bom()
    {
        $id = $this->input->post('id');
        $customer_id = $this->input->post('customer_id');
        $customer_part_id = $this->input->post('customer_part_id');
        $child_part_id = $this->input->post('child_part_id');
        $quantity = $this->input->post('quantity');
        $data = array(

            "customer_part_id" => $customer_part_id,
            "child_part_id" => $child_part_id,

        );
        $success = 0;
        $messages = "Something went wrong.";
        $check = $this->Crud->read_data_where("subcon_bom", $data);
        if ($check != 0) {
            $messages  ="Already Exists";
            // echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(

                "customer_part_id" => $customer_id,
                "child_part_id" => $child_part_id,
                "quantity" => $quantity,
                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,

            );
            $result = $this->Crud->update_data("subcon_bom", $data, $id);
            if ($result) {
                $messages = "Updated Sucessfully";
                $success =1;
                // echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }


    public function add_part()
    {
        // echo 'yes';
        $id = $this->input->post('uid');
        $table = $this->input->post('table_name');
        $col_name = $this->input->post('column_name');
        // pr($_POST,1);
        if (!empty($_FILES['cad_file']['name'])) {
            $image_path = "./documents/";
            $config['allowed_types'] = '*';
            $config['upload_path'] = $image_path;
            $config['file_name'] = $_FILES['cad_file']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('cad_file')) {
                $uploadData = $this->upload->data();
                $picture4 = $uploadData['file_name'];
                $data = array(
                    $col_name => $picture4,
                );
                $result = $this->Crud->update_data($table, $data, $id);

                // echo "yes";
                if ($result) {
                    echo "<script>alert(' uploaded Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
                }
            } else {
                $picture4 = '';
                echo "no 1";
            }
        } else {
            $picture4 = '';
            echo "no 2";
        }
    }

    public function purchase_order()
    {
        $data['child_part_list'] = $this->SupplierParts->readSupplierParts();
        $data['purchase_order_list'] = $this->Crud->read_data("purchase_order");
        $data['uom'] = $this->Crud->read_data("uom");
        $data['client_list'] = $this->Crud->read_data("client");
        $data['gst_list'] = $this->Crud->read_data("gst_structure");


        $data['supplier_list'] = $this->Crud->read_data("supplier");
        $data['customer_list'] = $this->Crud->read_data("customer");
        $data['part_type_list'] = $this->Crud->read_data("part_type");



        $this->load->view('header');
        $this->load->view('purchase_order', $data);
        $this->load->view('footer');
    }



    public function addPurchaseOrder()
    {
        // $po_number = $this->input->post('po_number');
        $part_number = $this->input->post('part_number');
        $delivery_date = $this->input->post('delivery_date');
        $supplier_name = $this->input->post('supplier_name');
        $remark = $this->input->post('remark');
        $po_v_date = $this->input->post('po_v_date');
        $part_type = $this->input->post('part_type');
        $quantity = $this->input->post('quantity');
        $uom_id = $this->input->post('uom_id');
        $shipping = $this->input->post('shipping');
        $cgst = $this->input->post('cgst');
        $sgst = $this->input->post('sgst');
        $igst = $this->input->post('igst');
        $this->db->from("purchase_order");
        $this->db->order_by("id", "desc");

        $query = $this->db->get()->result();

        // print_r($query);
        $date = $this->current_date;
        $q = explode("-", $date);
        $year = $q[0];
        $year = $year . $q[1] . $q[2];
        if ($query == NULL) {
            $po_number = $year . "-" . '1';
        } else {

            $t = $query[0]->id;
            $t = $t + 1;
            // $des =  $query->limit(1)->result();
            // print_r($des);
            $po_number = $year . "-" . $t;
        }

        $data = array(

            "part_id" => $part_number,
            "supplier_id" => $supplier_name,

        );
        $check = $this->Crud->read_data_where("purchase_order", $data);
        if ($check != 0) {
            echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "po_number" => $po_number,
                "part_id" => $part_number,
                "supplier_id" => $supplier_name,
                "uom_id" => $uom_id,
                "quantity" => $quantity,
                "cgst_id" => $cgst,
                "sgst_id" => $sgst,
                "igst_id" => $igst,
                "delivery_date" => $delivery_date,
                "part_type_id" => $part_type,
                "po_validity_date" => $po_v_date,
                "remark" => $remark,
                "shipping_method" => $shipping,

                "created_id" => $this->user_id,
                "date" => $this->current_date,
                "time" => $this->current_time,
            );
            $result = $this->Crud->insert_data("purchase_order", $data);
            if ($result) {
                echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                echo "<script>alert('Not Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
    }



    public function updatePurchaseOrder()
    {
        $id = $this->input->post('id');
        $part_number = $this->input->post('upart_number');
        $delivery_date = $this->input->post('udelivery_date');
        $supplier_name = $this->input->post('usupplier_name');
        $remark = $this->input->post('uremark');
        $po_v_date = $this->input->post('upo_v_date');
        $part_type = $this->input->post('upart_type');
        $quantity = $this->input->post('uquantity');
        $uom_id = $this->input->post('uuom_id');
        $shipping = $this->input->post('ushipping');
        // $this->db->from("purchase_order");
        // $this->db->order_by("id", "desc");
        // $query = $this->db->get()->result();
        // $t = $query[0]->id;
        // $t = $t + 1;
        // // print_r($query);
        // $date = $this->current_date;
        // $q = explode("-", $date);
        // $year = $q[0];
        // $year = $year . $q[1] . $q[2];
        // if ($query == NULL) {
        //  $po_number = $year . "-" . '1';
        // } else {
        //  // $des =  $query->limit(1)->result();
        //  // print_r($des);
        //  $po_number = $year . "-" . $t;
        // }

        // $data = array(
        //  "po_number" => $po_number,

        // );
        // $check = $this->Crud->read_data_where("purchase_order", $data);
        // if ($check != 0) {
        //  echo "<script>alert('Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        // } else {
        $data = array(
            // "po_number" => $po_number,
            "part_id" => $part_number,
            "supplier_id" => $supplier_name,
            "uom_id" => $uom_id,
            "quantity" => $quantity,
            "delivery_date" => $delivery_date,
            "part_type_id" => $part_type,
            "po_validity_date" => $po_v_date,
            "remark" => $remark,
            "shipping_method" => $shipping,

            "created_id" => $this->user_id,
            "date" => $this->current_date,
            "time" => $this->current_time,
        );
        $result = $this->Crud->update_data("purchase_order", $data, $id);
        if ($result) {
            echo "<script>alert('Updated Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            echo "<script>alert('Not Added');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        // }
    }

    public function add_gst()
    {
        $code = $this->input->post('code');
        $cgst = $this->input->post('cgst');
        $sgst = $this->input->post('sgst');
        $igst = $this->input->post('igst');
        $tcs = $this->input->post('tcs');
        $tcs_on_tax = $this->input->post('tcs_on_tax');
        $with_in_state = $this->input->post('with_in_state');
        $data = array(
            "code" => $code,
        );
        $success = 0;
        $messages = "Something went wrong.";
        $check = $this->Crud->read_data_where("gst_structure", $data);
        if ($check != 0) {
            $messages = "TAX Code Already Exists";
            // echo "<script>alert('TAX Code Already Exists');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $data = array(
                "code" => $code,
                "cgst" => $cgst,
                "sgst" => $sgst,
                "igst" => $igst,
                "tcs" => $tcs,
                "tcs_on_tax" => $tcs_on_tax,
                "with_in_state" => $with_in_state,
                "created_by" => $this->user_id,
                "created_date" => $this->current_date,
            );

            $result = $this->Crud->insert_data("gst_structure", $data);
            if ($result) {
                $success = 1;
                $messages = "'Added Sucessfully";
                // echo "<script>alert('Added Sucessfully');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }

    public function update_customer_parts_master()
    {

        $id = $this->input->post('id');

        $part_description = $this->input->post('part_description');
        $fg_rate = $this->input->post('fg_rate');
        
        $data = array(
            "part_description" => trim($part_description),
            "scrap_category_id" => $this->input->post('scrap_category') > 0 ?  $this->input->post('scrap_category') : 0
        );

        $dataStock = array(
            "fg_rate" => $fg_rate
        );
        $message = "Something went wrong";
        $success = 0;
        $query = $this->CustomerPart->updatePartById($data, $id);
        $query = $this->CustomerPart->updateStockById($dataStock,$id);
        if ($query) {
            $message = "Update Success !!!!";
            $success = 1;
            // echo "<script>alert(' Update Success !!!!');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        } else {
            $message ="Error While  Updating , Please try Again";
            // echo "<script>alert('Error While  Updating , Please try Again');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $ret_arr['message'] = $message;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
        exit();
    }
    public function forbidden_page(){
     
        $previous_page = $this->session->userdata("previous_page");
        $data['previous_page'] = $previous_page != "" &&  $previous_page != null ? $previous_page : base_url('dashboard');
        $this->loadView('forbidden_page',$data);
    }
    public function page_not_found(){
        $data = [];
         $previous_page = $this->session->userdata("previous_page");
        $data['previous_page'] = $previous_page != "" &&  $previous_page != null ? $previous_page : base_url('dashboard');
        $this->loadView('page_not_found',$data);
    }
    public function category()
    {
        checkGroupAccess("category","list","Yes");
        $category_list = $this->db->query('SELECT c.* FROM `category` as c');
        $data['category_list'] = $category_list->result();
        $categories = $data['category_list'];
        $categories_by_id = array_column($categories, "category_name","category_id");
        foreach ($categories as $key => $value) {
           
            if($value->parent_id > 0){
                $value->parent_category = $categories_by_id[$value->parent_id];
            }else{
                $value->parent_category = display_no_character("");
            }

        }
        // $this->load->view('header');
        $this->loadView('admin/category', $data);
        // $this->load->view('footer');
    }
    public function add_category()
    {
        $post_data = $this->input->post();
        $category_name = trim($post_data['category_name']);
        $category_list = $this->db->query("SELECT * FROM `category` WHERE category_name = '".$category_name."'");
        $category_list = $category_list->result();
        $messages = "Something went wrong";
        $success = 0;
        if(count($category_list) == 0){
            $data = array(
                "parent_id" => $post_data['parent_id'],
                "category_name" => $category_name,
                "added_by" => $this->user_id,
                "added_date" => date("Y-m-d H:i:s") 
            );
            $result = $this->Crud->insert_data("category", $data);
            if ($result) {
                $messages = "Category added successfully.";
                $success = 1;
                // echo "<script>alert('Category added successfully.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }else{
            $messages = "Category already exist.";
            // echo "<script>alert('Category already exist');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $return_arr['success']=$success;
        $return_arr['messages']=$messages;
        echo json_encode($return_arr);
        exit;
    }
    public function update_category()
    {
        $post_data = $this->input->post();
        
        $category_id = $post_data['category_id'];
        $category_name = trim($post_data['category_name']);
        $category_list = $this->db->query("SELECT * FROM `category` WHERE category_name = '".$category_name."' AND category_id != $category_id");
        $category_list = $category_list->result();
        $messages = "Something went wrong";
        $success = 0;
        if(count($category_list) == 0){
            $data = array(
                "parent_id" => $post_data['parent_category_id'],
                "category_name" => $category_name 
            );
            $update_result = $this->welcome_model->update_category($data, $category_id);
            if ($update_result) {
                $messages = "Category updated successfully.";
                $success = 1;
                // echo "<script>alert('Category added successfully.');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            } else {
                $messages = "Unable to Add";
                // echo "<script>alert('Unable to Add');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            }
        }else{
            $messages = "Category already exist.";
            // echo "<script>alert('Category already exist');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
        $return_arr['success']=$success;
        $return_arr['messages']=$messages;
        echo json_encode($return_arr);
        exit;
    }
    public function getSubCategory(){
        $post_data = $this->input->post();
        $category_list = $this->db->query("
            SELECT c.* 
            FROM category as p
            JOIN category c ON c.parent_id = p.category_id
            WHERE p.category_name = '".$post_data['parent_category']."'");
        $category_list = $category_list->result();
        $html = '<option value="">Select Sub Item Category</option>';
        foreach ($category_list as $key => $value) {
            $selected = "";
            if(isset($post_data['sub_category'])){
                if($post_data['sub_category'] == $value->category_name){
                    $selected = "selected";
                }
                
            }
            $html .= '<option value="'.$value->category_name.'"  '.$selected.'>'.$value->category_name.'</option>';
        }

        $return = [
            "html" => $html
        ];
        echo json_encode($return);
        exit();
    }

    /* scrap category master */
    public function scrap_category(){
        checkGroupAccess("scrap_category","list","Yes");
        $data['scrap_category'] = $this->Crud->customQuery("SELECT s.* FROM scrap_category_master s" );
        $this->loadView('admin/scrap_category',$data);
        // pr($data,1);
    }
    public function add_update_scrap_category()
    {
        $post_data = $this->input->post();
        $scrap_category = trim($post_data['scrap_category']);
        if(isset($post_data['scrap_category_id'])){
            $scrap_category_id = $post_data['scrap_category_id'];
            $success = 0;
            $messages = "Something went wrong.";
            $customer_part_stock = $this->Crud->customQuery("SELECT sc.* FROM scrap_category_master sc WHERE sc.scrap_category = '$scrap_category' AND sc.scrap_category_master_id != $scrap_category_id" );
            if(!$customer_part_stock){
                $update_arr = [
                    "scrap_category" => $scrap_category,
                    "updated_by" => $this->session->userdata('user_id'),
                    "updated_date" => date("Y-m-d H:i:s")
                ];
                $updated_row = $this->Common_admin_model->update("scrap_category_master", $update_arr, "scrap_category_master_id", $scrap_category_id);
                if($updated_row > 0){
                    $messages = "Scrap category updated sucessfully";
                    $success = 1;
                }
            }else{
                $messages = "Scrap category already exist";
            }
        }else{
            $customer_part_stock = $this->Crud->customQuery("SELECT sc.* FROM scrap_category_master sc WHERE sc.scrap_category = '$scrap_category'" );
            if(!$customer_part_stock){
                $insert_data = [
                    "scrap_category" => $scrap_category,
                    "added_by" => $this->session->userdata('user_id'),
                    "added_date" => date("Y-m-d H:i:s")
                ];
                $insert_id = $this->Common_admin_model->insert('scrap_category_master', $insert_data);
                if($insert_id > 0){
                    $messages = "Scrap category added sucessfully";
                    $success = 1;
                }
            }else{
                $messages = "Scrap category already exist";
            }
        }
        $result = [];
        $result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }
    public function get_transportor_data()
    {
        $id = $this->input->post("id");
        $transporter = $this->Crud->get_data_by_id("transporter", $id, "id");
        $vehicle_number = $transporter[0]->vehicle_number != null ? $transporter[0]->vehicle_number : "";
        $return_arr['vehicle_number'] = $vehicle_number;
        echo json_encode($return_arr);
        exit();
    }

}
