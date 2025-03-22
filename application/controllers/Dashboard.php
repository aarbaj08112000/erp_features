<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('CommonController.php');

class Dashboard extends CommonController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->unit = '';
        
    }
    public function dashboard(){
       checkGroupAccess("dashboard","list");
       $data['selected_unit'] = $this->session->userdata('clientUnit');
       $data['unit_data'] = $this->dashboard_model->get_unit();
       $current_year = date("Y");
       if(date("m") < 4){
        $current_year--;
       }
      
       $start_year = 2018;
       $year = [];
       for ($i= $current_year; $i >= $start_year; $i--) { 
           array_push($year, ['id'=>$i,'val'=>$i]);
       }
       $data['year'] = $year;
       $data['month_arr'] = [['id'=>'4','val'=>'Apr'],['id'=>'5','val'=>'May'],['id'=>'6','val'=>'Jun'],['id'=>'7','val'=>'Jul'],['id'=>'8','val'=>'Aug'],['id'=>'9','val'=>'Sep'],['id'=>'10','val'=>'Oct'],['id'=>'11','val'=>'Nov'],['id'=>'12','val'=>'Dec'],['id'=>'1','val'=>'Jan'],['id'=>'2','val'=>'Feb'],['id'=>'3','val'=>'Mar']];
       $data['customer_type'] = $this->session->userdata("AROMCustomerType");

       // get active menu
       $selected_menu = "";
       if(checkGroupAccess("dashboard_ba","list",false)){
            $selected_menu = "dashboard_ba";
       }else if(checkGroupAccess("dashboard_sales","list",false)){
            $selected_menu = "dashboard_sales";
       }else if(checkGroupAccess("dashboard_account","list",false)){
            $selected_menu = "dashboard_account";
       }else if(checkGroupAccess("dashboard_purchase_grn","list",false)){
            $selected_menu = "dashboard_purchase_grn";
       }else if(checkGroupAccess("dashboard_store","list",false)){
            $selected_menu = "dashboard_store";
       }else if(checkGroupAccess("dashboard_subcon","list",false)){
            $selected_menu = "dashboard_subcon";
       }else if(checkGroupAccess("dashboard_production","list",false)){
            $selected_menu = "dashboard_production";
       }else if(checkGroupAccess("dashboard_quality","list",false)){
            $selected_menu = "dashboard_quality";
       }
       $data['selected_menu'] = $selected_menu;
       $data['isMultipleClientUnits'] = $this->session->userdata("isMultipleClientUnits");
       $this->loadView("dashboard/dashboard",$data);
    }
     public function get_dashboard_widget_data()
    {
        $post_data = $this->input->post(); 
        $widget_name = $post_data['widget_name'];
        $tab_name = $post_data['tab_name'];
        $year = $post_data['year'];
        $month = $post_data['month'] == 'All' ? '' : $post_data['month'];
        $this->unit = $post_data['unit'] == 'All' ? '' : $post_data['unit'];
        $widgets = $this->dashboard_model->get_widgets($tab_name,$widget_name);
        $widget_data_arr = [];
        // finatial year condition
            // month wise filter 
            if($month > 0){
                if($month >0 && $month <= 3){
                    $month_arr = ["year"=>$year+1,"month"=>$month];
                }else{
                    $month_arr = ["year"=>$year,"month"=>$month];
                }
            }else{
                $month_arr = ["start_year"=>$year,"start_month"=>4,"end_year"=>$year+1,"end_month"=>3];
            }
        // pr($month_arr,1);
        foreach ($widgets as $key => $value) {
            $function_name = $value['widget_funtion'];
            // pr($function_name,1);
            $widget_data = $this->$function_name($year,$month_arr,$unit);

            $return_arr['widget_name'] = $value['widget_name'];
            $return_arr['widget_type'] = $value['widget_type'];
            $return_arr['widget_data'] = $widget_data;
            array_push($widget_data_arr, $return_arr);
        }
        // pr($widget_data_arr);
        // pr("ok1",1);
        echo json_encode($widget_data_arr);
        exit();
    }

    // Sales Tab

    public function get_today_sales($year = '',$month_arr = []){
        $date = date("d-m-Y");
        $sales_data = $this->dashboard_model->get_sales_sum($date,'');
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "basic_total"));
           // $total_discount = array_sum(array_column($sales_data, "total_discount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;// - $total_discount;
        return $count_arr;
    }
    public function get_yesterdays_sales($year = '',$month_arr = []){
        $yesterday = new DateTime('yesterday');
        $date = $yesterday->format('d-m-Y');
        $sales_data = $this->dashboard_model->get_sales_sum($date,'');
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "basic_total"));
            //$total_discount = array_sum(array_column($sales_data, "total_discount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;//- $total_discount;

        return $count_arr;
    }
    public function get_fy_total_sales($year = '',$month_arr = []){

        $sales_data = $this->dashboard_model->get_sales_sum('','',$year,$month_arr);
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "basic_total"));
            //$total_discount = array_sum(array_column($sales_data, "total_discount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;// - $total_discount;

        return $count_arr;
    }
    public function get_current_month_sale($year = '',$month_arr = []){
        $current_month = date("m");
        $sales_data = $this->dashboard_model->get_sales_sum('',$current_month);
        // pr($sales_data,1);
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "basic_total"));
            //$total_discount = array_sum(array_column($sales_data, "total_discount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount; //- $total_discount;
        return $count_arr;
    }
    public function get_current_month_plan($year = '',$month_arr = []){
        
        $month_array = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
        // $start_month = [];
        // for ($i=$month_arr['start_month']-1; $i < 12; $i++) { 
        //     array_push($start_month, $month_arr1[$i]);
        // }
        // $month_arr['start_year'] = 'FY-'.$month_arr['start_year'];
        // $month_arr['start_month'] = $start_month;
        // $end_month = [];
        // for ($i=0; $i < $month_arr['end_month']; $i++) { 
        //     array_push($end_month, $month_arr1[$i]);
        // }
        // $month_arr['end_year'] = 'FY-'.$month_arr['end_year'];
        // $month_arr['end_month'] = $end_month;
        
        $current_month = (int) date('m');
        $current_year = (int) date('Y');
        $month_arr['month'] = $month_array[$current_month-1];
        $month_arr['year'] = "FY-".$current_year;
        $current_month_plan_data = $this->dashboard_model->get_current_month_plan($month_arr);
        if(count($current_month_plan_data) >0){
            $total_amount = array_sum(array_column($current_month_plan_data, "total_amount"));
        }else{
            $total_amount = 0;
        }
        $return_arr = [
            "total_qty" => "₹ ".number_format($total_amount,2),
            "total_amount" => "" 
        ];
        return $return_arr;
    }
    /* pie chart */
    public function get_customer_sales($year = '',$month = []){
        $sales_data = $this->dashboard_model->get_customer_sales($year,$month);
        $total_amount_arr = array_sum(array_column($sales_data, "basic_total"));// - array_sum(array_column($sales_data, "total_discount"));
        $return_arr = [];
        foreach ($sales_data as $key => $value) {
            $percentage = (($value['basic_total']) / $total_amount_arr)*100;
            $return_arr[] = ['name'=>$value['customer'],'y'=>$percentage,'x'=>$percentage,'drilldown'=>$value['customer']];
        }
        
        $return_arr = [
            "series_data"=>$return_arr,
            "show_legend" => false
        ];
        return $return_arr;
    }

    public function get_cutomer_sales_amount($year = '',$month_arr = []){
         $sales_data = $this->dashboard_model->get_customer_sales($year,$month_arr);
         $return_arr = [];
         foreach ($sales_data as $key => $value) {
             array_push($return_arr,[$value['customer'],number_format(($value['basic_total']) ,2)]);
         }
        // $return_arr = [];
        return $return_arr;
    }
    /* single bar chart chart */
    public function get_month_wise_sales($year = '',$month_arr = []){
        $sales_data = $this->dashboard_model->get_sales_sum('','',$year,$month_arr);
        $month_wise_sales_data = [];
        if(is_array($sales_data) && count($sales_data) > 0){
            foreach ($sales_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_data[$month_name] += $value['basic_total'];
                //$month_wise_sales_data[$month_name] -= $value['total_discount'];
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_sales_material_request_data = [];
        if(count($month_wise_sales_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_sales_data[$val])){
                    $sales_value = $month_wise_sales_data[$val];
                 }
                 
                 array_push($series_sales_material_request_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Sales (INR)",
            "series_data"=>$series_sales_material_request_data
        ];
        return $return_arr;
    }
    /* double bar chart chart */
    public function get_paln_sales_data($year = '',$month_arr = []){
        $sales_data = $this->dashboard_model->get_sales_sum('','',$year,$month_arr);
        $month_wise_sales_data = [];
        if(is_array($sales_data) && count($sales_data) > 0){
            foreach ($sales_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_data[$month_name] += $value['basic_total'];
                //$month_wise_sales_data[$month_name] -= $value['total_discount'];
            }
        }

        $month_arr1 = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
        $start_month = [];
        for ($i=$month_arr['start_month']-1; $i < 12; $i++) { 
            array_push($start_month, $month_arr1[$i]);
        }
        $month_arr['start_year'] = 'FY-'.$month_arr['start_year'];
        $month_arr['start_month'] = $start_month;
        $end_month = [];
        for ($i=0; $i < $month_arr['end_month']; $i++) { 
            array_push($end_month, $month_arr1[$i]);
        }
        $month_arr['end_year'] = 'FY-'.$month_arr['end_year'];
        $month_arr['end_month'] = $end_month;
        $current_month_plan_data = $this->dashboard_model->get_paln_sales_data($month_arr);
        $month_wise_plane_data = [];
        if(is_array($current_month_plan_data) && count($current_month_plan_data) > 0){
            foreach ($current_month_plan_data as $key => $value) {
                $month_name = ucfirst(strtolower($value['month']));
                $month_wise_plane_data[$month_name] += $value['total_amount'];
            }
        }
        
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_planing_data = [];
        $series_sales_data = [];
        if(count($month_wise_sales_data) > 0 || count($month_wise_plane_data)>0){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_sales_data[$val])){
                    $sales_value = $month_wise_sales_data[$val];
                 }
                 array_push($series_sales_data, $sales_value);
                 $planing_value = 0;
                 if(isset($month_wise_plane_data[$val])){
                    $planing_value = $month_wise_plane_data[$val];
                 }
                 array_push($series_planing_data, $planing_value);
            } 
        }

        $series_data = [];
        if(count($series_planing_data) > 0 || count($series_sales_data) > 0){
            $series_data = [
                ['name'=> 'Plan','data'=> $series_planing_data], 
                ['name'=> 'Sale','data'=> $series_sales_data]
            ]; 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Amount (INR)",
            "catergories" => $month_arr,
            "series_data" => $series_data
        ];

        // pr($series_data,1);
        return $return_arr;
    }
    /* semi circle chart */
    public function get_production_product(){
        $return_arr = [
            'data' =>[['Chrome', 73.86],['Edge', 11.97]],
            'label_data' => [["label"=>"del_qty","val"=>"5,191,780"],["label"=>"pend_qty","val"=>"2,016,833"]],
            "color_lengend" =>['#e4ad16', '#3F4957']
        ];
        return $return_arr;
    }
    /* single colum bar chart */
    public function get_production_stock(){
        $return_arr = [
            'series_data' =>[['name'=> "Completed",'data'=> [12000],'color'=> '#e4ad16'],['name'=> "Pending",'data'=> [2000],'color'=> '#3F4957']],
            'label_data' => [["label"=>"del_qty","val"=>"12,000"],["label"=>"pend_qty","val"=>"2,000"]]
        ];
        return $return_arr;
    }



    /* account tab */
    public function get_total_payable_due($year = '',$month_arr = []){
        $count_arr['count'] = 0;
        return $count_arr;
    }
    public function get_total_payable_paid($year = '',$month_arr = []){
        $count_arr['count'] = 0;
        return $count_arr;
    }
    public function get_total_receivable_due($year = '',$month_arr = []){
        $sales_data = $this->dashboard_model->get_total_receivable_due_gst($year,$month_arr);
        // pr($sales_data,1);
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "ttlrt"));
            $gstamnt = array_sum(array_column($sales_data, "gstamnt"));
            $total_amount = $total_amount - $gstamnt;
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;// - $total_discount;
        return $count_arr;
    }
    public function get_total_receivable_due_gst($year = '',$month_arr = []){
        $sales_data = $this->dashboard_model->get_total_receivable_due_gst($year,$month_arr);
        // pr($sales_data,1);
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "bal_amnt"));
        }else{
            $total_amount = 0;
        }
        //amount received so far should be deducted from sales... there is no provision to have one single call to get all data 
        //as of now so added this for that calculation
        $received_data = $this->dashboard_model->get_total_receivable_paid('','',$year,$month_arr);
         if(count($received_data) >0){
            $total_tds = array_sum(array_column($received_data, "tds_amount"));
            $total_amount_recvd = array_sum(array_column($received_data, "amount_received")) + $total_tds;

        }else{
            $total_amount_recvd = 0;
        }
        // pr($received_data,1);
        $count_arr['count'] = $total_amount ;
        return $count_arr;
    }
    public function get_total_receivable_paid($year = '',$month_arr = []){
        $sales_data = $this->dashboard_model->get_total_receivable_paid($year,$month_arr);
        if(count($sales_data) >0){
            $total_amount = array_sum(array_column($sales_data, "amount_received"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;
        return $count_arr;
    }
    public function get_customer_receiver_due($year = '',$month_arr = []){
        $customer_receiver_due_data = $this->dashboard_model->get_sales_block($year,$month_arr);
        // pr($customer_receiver_due_data,1);
        $customer_arr_1  = array_column($customer_receiver_due_data,"customer_name","customer_id");
        $customer_receiver_due = [];
        if(is_array($customer_receiver_due_data) && count($customer_receiver_due_data) > 0){
            foreach ($customer_receiver_due_data as $key => $value) {
                $customer_name = $value['customer_id'];
                $customer_receiver_due[$customer_name] += $value['basic_total'];
                //$customer_receiver_due[$customer_name] -= $value['total_discount'];
            }
        }
        $total_amount_arr = array_sum($customer_receiver_due);
        $return_arr = [];
        foreach ($customer_receiver_due as $key => $value) {
            $percentage = ($value/$total_amount_arr)*100;
            $return_arr[] = ['name'=>$customer_arr_1[$key],'y'=>$percentage,'x'=>$percentage,'drilldown'=>$customer_arr_1[$key]];
        }
        $return_arr = [
            "series_data"=>$return_arr,
            "show_legend" => false
        ];
        return $return_arr;
    }
    public function get_sales_plane_amount_gst($year = '',$month_arr = []){
        // gete sales data
        $sales_data = $this->dashboard_model->get_sales_purchase_grn_gst($year,$month_arr);
        $month_wise_sales_data = [];
        if(is_array($sales_data) && count($sales_data) > 0){
            foreach ($sales_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_data[$month_name] += $value['total_gst_amount'];
            }
        }

        // gete purchase data
        $purchase_grn_data = $this->dashboard_model->get_purchase_grn_gst_data($year,$month_arr);  
        $month_wise_purchase_data = [];
        if(is_array($purchase_grn_data) && count($purchase_grn_data) > 0){
            foreach ($purchase_grn_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $total = $value['sgst_amount'] + $value['cgst_amount'] + $value['igst_amount'] + $value['tcs_amount'];
                $month_wise_purchase_data[$month_name] += $total;
            }
        } 

        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_purchase_data = [];
        $series_sales_data = [];
        if(count($month_wise_sales_data) > 0 || count($month_wise_purchase_data)>0){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_sales_data[$val])){
                    $sales_value = $month_wise_sales_data[$val];
                 }
                 array_push($series_sales_data, $sales_value);
                 $purchase_value = 0;
                 if(isset($month_wise_purchase_data[$val])){
                    $purchase_value = $month_wise_purchase_data[$val];
                 }
                 array_push($series_purchase_data, $purchase_value);
            } 
        }
        $series_data = [];
        if(count($series_purchase_data) > 0 || count($series_sales_data) > 0){
            $series_data = [
                ['name'=> 'Purchase','data'=> $series_purchase_data], 
                ['name'=> 'Sale','data'=> $series_sales_data]
            ]; 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Amount (INR)",
            "catergories" => $month_arr,
            "series_data" => $series_data
        ];
        return $return_arr;
    }

    
    /* table   */
    public function get_cutomer_receiver_due_list($year = '',$month_arr = []){
        $customer_receiver_due_data = $this->dashboard_model->get_sales_block($year,$month_arr);
        $return_arr = [];
        foreach ($customer_receiver_due_data as $key => $value) {
                $found = false;
                foreach ($return_arr as &$item) {
                    if ($item[0] === $value['customer_name']) {
                        // If customer is already in the array, add the basic_total to the existing total
                        $item[1] += $value['basic_total'];
                        $found = true;
                        break;
                    }
                }

                // If the customer is not found, push a new array
                if (!$found) {
                    array_push($return_arr, [$value['customer_name'], $value['basic_total']]);
                }
        }

        // Optionally, format the numbers once all totals are calculated
        foreach ($return_arr as &$item) {
            $item[1] = number_format($item[1], 2);
        }

        return $return_arr;
    }

    /* Purchase GRN Tab */
    public function get_caterory_purchse_amount($year = '',$month_arr = []){
        $customer_receiver_due_data = $this->dashboard_model->get_caterory_purchse_amount($year,$month_arr);
        
        $total_amount_arr = array_sum(array_column($customer_receiver_due_data, "base_amount"));
        $catergories_arr = ["direct"=>0,"consumable"=>0,"asset"=>0];
        foreach ($customer_receiver_due_data as $key => $value) {
            if(in_array($value['sub_type'], ["Regular grn","RM","Subcon grn","Subcon Regular"])){
                $catergories_arr['direct'] += $value['base_amount'];
            }
            if(in_array($value['sub_type'], ["consumable"])){
                $catergories_arr['consumable'] += $value['base_amount'];
            }
            if(in_array($value['sub_type'], ["asset"])){
                $catergories_arr['asset'] += $value['base_amount'];
            }
        }
        $total_amount_arr = $total_amount_arr == 0 ? 1 : $total_amount_arr; 
        $return_arr = [];
        $flag = 0;
        if(count($customer_receiver_due_data) > 0){
            foreach ($catergories_arr as $key => $value) {
                $percentage = ($value/$total_amount_arr)*100;
                if($percentage >0){
                    $flag = 1;
                }
                $return_arr[] = ['name'=>$key,'y'=>$percentage,'x'=>$value,'drilldown'=>$key];
            }
        }
        if($flag == 0){
            $return_arr = [];
        }
        // pr($return_arr,1);
        $return_arr = [
            "series_data"=>$return_arr,
            "show_legend" => false,
            "delemeter" => ""
        ];
        return $return_arr;
    }
    public function get_cash_purchase_amount(){
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Amount",
            "series_data"=>[
                [ 'name'=> 'Jan',  'y'=> 12,  'drilldown'=> 'Jan'],
                [  'name'=> 'Feb',  'y'=> 15.84,  'drilldown'=> 'Feb'], 
                [  'name'=> 'March',  'y'=> 14.18,  'drilldown'=> 'March'], 
                [ 'name'=> 'April',  'y'=> 8.12,  'drilldown'=> 'April'], 
                [  'name'=> 'May',  'y'=>14.33,  'drilldown'=> 'May'], 
                [ 'name'=> 'June',  'y'=> 1.45,  'drilldown'=> 'June'], 
                [ 'name'=> 'July',  'y'=> 1.582,  'drilldown'=> 'July']
            ]
        ];
        return $return_arr;
    }
    /* Image Block */
    public function get_purchase_grn($year = '',$month_arr = []){
        // gete purchase data
        $purchase_grn_data = $this->dashboard_model->get_purchase_grn_details($year,$month_arr); 
        if(count($purchase_grn_data) >0){
            $total_amount = array_sum(array_column($purchase_grn_data, "base_amount"));
        }else{
            $total_amount = 0;
        }
        $return_arr = [
            "total_qty" => "₹ ".number_format($total_amount,2),
            "total_amount" => "" 
        ];
        return $return_arr;
    }
    public function get_purchase_grn_amount($year = '',$month_arr = []){
        // gete purchase data
        $purchase_grn_data = $this->dashboard_model->get_purchase_grn_details($year,$month_arr); 
        $month_wise_purchase_data = [];
        if(is_array($purchase_grn_data) && count($purchase_grn_data) > 0){
            foreach ($purchase_grn_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_purchase_data[$month_name] += $value['base_amount'];
            }
        } 
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_purchase_grn_data = [];
        if(count($month_wise_purchase_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_purchase_data[$val])){
                    $sales_value = $month_wise_purchase_data[$val];
                 }
                 
                 array_push($series_purchase_grn_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Amount (INR)",
            "series_data"=>$series_purchase_grn_data
        ];
        return $return_arr;
    }

    /* store tab */
    public function get_purchase_stock_amount($year = '',$month_arr = []){
        $purchase_stock = $this->dashboard_model->get_purchase_stock($year,$month_arr); 
        if(count($purchase_stock) >0){
            $total_amount = array_sum(array_column($purchase_stock, "total_stock_amount"));
        }else{
            $total_amount = 0;
        }
        
        $count_arr['count'] = $total_amount;
        return $count_arr;
    }
    public function get_in_house_parts_stock($year = '',$month_arr = []){
        $in_house_parts = $this->dashboard_model->get_in_house_parts($year,$month_arr); 
        if(count($in_house_parts) >0){
            $total_amount = array_sum(array_column($in_house_parts, "total_stock_amount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;
        return $count_arr;
    }
    public function get_fg_stock($year = '',$month_arr = []){
        $fg_stock = $this->dashboard_model->get_fg_stock($year,$month_arr); 
        if(count($fg_stock) >0){
            $total_amount = array_sum(array_column($fg_stock, "total_stock_amount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;
        return $count_arr;
    }
    public function get_store_subcon_stock($year = '',$month_arr = []){ 
        $store_subcon_stock = $this->dashboard_model->get_store_subcon_stock($year,$month_arr);
        if(count($store_subcon_stock) >0){
            $total_amount = array_sum(array_column($store_subcon_stock, "base_amount"));
        }else{
            $total_amount = 0;
        }
        
        $count_arr['count'] = $total_amount;
        return $count_arr; 
    }
    public function get_purchase_stock_amount_bar($year = '',$month_arr = []){
        $store_purchase_grn_data = $this->dashboard_model->get_store_purchase_grn_data($year,$month_arr);
        $month_wise_purchase_data = [];
        if(is_array($store_purchase_grn_data) && count($store_purchase_grn_data) > 0){
            foreach ($store_purchase_grn_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_purchase_data[$month_name] += $value['base_amount'];
            }
        } 
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_purchase_grn_data = [];
        if(count($month_wise_purchase_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_purchase_data[$val])){
                    $sales_value = $month_wise_purchase_data[$val];
                 }
                 
                 array_push($series_purchase_grn_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Amount (INR)",
            "series_data"=>$series_purchase_grn_data
        ];
        return $return_arr;
    }

    /* Production Tab */
    public function get_yesterdays_molding_production($year = '',$month_arr = []){
        $yesterday = new DateTime('yesterday');
        $date = $yesterday->format('Y-m-d');
        // pr($date,1);
        $molding_production_data = $this->dashboard_model->get_molding_production_data($date);
        if(count($molding_production_data) >0){
            $total_amount = array_sum(array_column($molding_production_data, "qty_amount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;
        return $count_arr;
    }
    public function get_yesterdays_rejection($year = '',$month_arr = []){
        $yesterday = new DateTime('yesterday');
        $date = $yesterday->format('Y-m-d');
        $yeaster_day_rejection = $this->dashboard_model->get_yeaster_day_rejection_data($date);
        if(count($yeaster_day_rejection) >0){
            $total_amount = array_sum(array_column($yeaster_day_rejection, "qty_amount"));
        }else{
            $total_amount = 0;
        }
        $count_arr['count'] = $total_amount;
        return $count_arr;
    }
    public function get_yesterday_oee($year = '',$month_arr = []){
        $yesterday = new DateTime('yesterday');
        $date = $yesterday->format('Y-m-d');
        $yesterday_oee = $this->dashboard_model->get_yesterday_molding_data($date);
        $oee = 0;
        foreach ($yesterday_oee as $key => $value) {
            $planned_pt  = ($value['production_hours'] - $value['ppt']);
            $runtime = $planned_pt - ($value['downtime_in_min']  + $value['setup_time_in_min']);
            $availbility = $planned_pt == 0 ? 0 : ($runtime / $planned_pt);
            $total_prod_qty = $value['rejection_qty'] + $value['qty'];
            $performance = $runtime == 0 ? 0 : ($value['cycle_time'] * $total_prod_qty ) / ($runtime * 60);
            $quality =  $total_prod_qty == 0 ? 0 : ($value['accepted_qty'] / $total_prod_qty);
            $oee += $availbility * $performance * $quality * 100;
        }
        $count_arr['count'] = $oee;
        return $count_arr;
    }
    public function get_yesterdays_ppm($year = '',$month_arr = []){
        $yesterday = new DateTime('yesterday');
        $date = $yesterday->format('Y-m-d');
        $yesterdays_ppm = $this->dashboard_model->get_yesterday_molding_data($date);
        $ppm = 0;
        foreach ($yesterdays_ppm as $key => $value) {
           $ppm += ($value['rejection_qty']+$value['qty']) == 0 ? 0 : (($value['rejection_qty']+$value['rejected_qty']) /($value['rejection_qty']+$value['qty'])) * 1000000;
        }
        $count_arr['count'] = $ppm;
        return $count_arr;
    }
    public function get_production_data($year = '',$month_arr = []){

        /* added for feedback */
        $yesterday = new DateTime('yesterday');
        $date = $yesterday->format('Y-m-d');
        /* added for feedback */
        $production_data = $this->dashboard_model->get_production_data($year,$month_arr,$date);
        $shift_arr = array_column($production_data, "shift_type","shift_id");
        $spline_chart_data = [];
        foreach ($shift_arr as $key => $value) {
            $spline_chart_data[$key]['production'] = 0;
            $spline_chart_data[$key]['rejection'] = 0;
            $spline_chart_data[$key]['oee'] = 0;
            $spline_chart_data[$key]['ppm'] = 0;
        }

        foreach ($production_data as $key => $value) {
            $production_value = $value['qty'] ; //* $value['part_stock_rate']
            $rejection_value = ($value['rejected_qty']+$value['rejection_qty']) ; //* $value['part_stock_rate']

            $planned_pt  = ($value['production_hours'] - $value['ppt']);
            $runtime = $planned_pt - ($value['downtime_in_min']  + $value['setup_time_in_min']);
            $availbility = $planned_pt == 0 ? 0 : ($runtime / $planned_pt);
            $total_prod_qty = $value['rejection_qty'] + $value['qty'];
            $performance = $runtime == 0 ? 0 : ($value['cycle_time'] * $total_prod_qty ) / ($runtime * 60);
            $quality =  $total_prod_qty == 0 ? 0 : ($value['accepted_qty'] / $total_prod_qty);
            $oee = $availbility * $performance * $quality * 100;

            $ppm = ($value['rejection_qty']+$value['qty']) == 0 ? 0 : (($value['rejection_qty']+$value['rejected_qty']) /($value['rejection_qty']+$value['qty'])) * 1000000;

            $spline_chart_data[$value['shift_id']]['production'] += $production_value;
            $spline_chart_data[$value['shift_id']]['rejection'] += $rejection_value;
            $spline_chart_data[$value['shift_id']]['oee'] += $oee;
            $spline_chart_data[$value['shift_id']]['ppm'] += $ppm;
            
        }


        $series_data_arr = [];
        foreach ($spline_chart_data as $key => $value) {
            $value['production'] = round($value['production']);
            $value['ppm'] = round($value['ppm']);
            $value['rejection'] = round($value['rejection']);
            array_push($series_data_arr, [ 'name'=> $shift_arr[$key], 'data'=> [$value['production'],$value['rejection'],$value['oee'],$value['ppm']] ]);
        }

        $return_arr = [
            "catergories"=>["Production", "Rejection","OEE","PPM"],
            "series_data"=> $series_data_arr
        ];

        // for no data show pass series_data => [] like below
        // $return_arr = ["series_data" =>[]];
        return $return_arr;
    }
    public function get_production_rejection_month_wise($year = '',$month_arr = []){
        $molding_data = $this->dashboard_model->get_rejection_data_data($year,$month_arr,$unit);
        $month_wise_production_rejection_data = [];
        if(is_array($molding_data) && count($molding_data) > 0){
            foreach ($molding_data as $key => $value) {

                $date = $value['date'];
                $month_name = date("F", strtotime($value['date']));
                $month_name = substr($month_name, 0, 3);
                $rejection_val = ($value['rejection_qty']+$value['rejected_qty']) * $value['part_stock_rate'];
                $month_wise_production_rejection_data[$month_name] += $rejection_val;
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $production_rejection_month_wise_data = [];
        if(count($month_wise_production_rejection_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_production_rejection_data[$val])){
                    $sales_value = $month_wise_production_rejection_data[$val];
                 }
                 
                 array_push($production_rejection_month_wise_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Production Rejection(Amount) (INR)",
            "series_data"=>$production_rejection_month_wise_data
        ];
        return $return_arr;
    }
    public function get_production_lumbs_month_wise($year = '',$month_arr = []){
        $molding_data = $this->dashboard_model->get_yesterday_oee_data($year,$month_arr,$unit);
        // pr($molding_data,1);
        $month_wise_production_lumbs_data = [];
        if(is_array($molding_data) && count($molding_data) > 0){
            foreach ($molding_data as $key => $value) {
                $date = $value['date'];
                $month_name = date("F", strtotime($value['date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_production_lumbs_data[$month_name] += $value['wastage'];
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $production_rejection_month_wise_data = [];
        if(count($month_wise_production_lumbs_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_production_lumbs_data[$val])){
                    $sales_value = $month_wise_production_lumbs_data[$val];
                 }
                 
                 array_push($production_rejection_month_wise_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Production lumps(Gattha) (KG)",
            "series_data"=>$production_rejection_month_wise_data
        ];
        return $return_arr;
    }
    public function get_machime_down_time($year = '',$month_arr = []){
        $molding_data = $this->dashboard_model->get_yesterday_oee_data($year,$month_arr,$unit);
        $month_wise_production_lumbs_data = [];
        if(is_array($molding_data) && count($molding_data) > 0){
            foreach ($molding_data as $key => $value) {
                $date = $value['date'];
                $month_name = date("F", strtotime($value['date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_production_lumbs_data[$month_name] += $value['downtime_in_min'];
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $production_rejection_month_wise_data = [];
        if(count($month_wise_production_lumbs_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_production_lumbs_data[$val])){
                    $sales_value = $month_wise_production_lumbs_data[$val];
                 }
                 
                 array_push($production_rejection_month_wise_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Machine Down Time (Min)",
            "series_data"=>$production_rejection_month_wise_data
        ];
        return $return_arr;
    }

    public function get_machine_wise_oee($year = '',$month_arr = []){
        $molding_data = $this->dashboard_model->get_machine_wise_oee($year,$month_arr,$unit);
        // pr($molding_data,1);
        $machine_wise_oee = [];
        $machine_arr = [];
        if(is_array($molding_data) && count($molding_data) > 0){
            $machine_arr = array_column($molding_data, "machine_name","machine_id");
            foreach ($molding_data as $key => $value) {
                $planned_pt  = ($value['production_hours'] - $value['ppt']);
                $runtime = $planned_pt - ($value['downtime_in_min']  + $value['setup_time_in_min']);
                $availbility = $planned_pt == 0 ? 0 : ($runtime / $planned_pt);
                $total_prod_qty = $value['rejection_qty'] + $value['qty'];
                $performance = $runtime == 0 ? 0 : ($value['cycle_time'] * $total_prod_qty ) / ($runtime * 60);
                $quality =  $total_prod_qty == 0 ? 0 : ($value['accepted_qty'] / $total_prod_qty);
                $oee = $availbility * $performance * $quality * 100;
                $machine_wise_oee[$value['machine_id']] += $oee;
            }
        }
        // pr($machine_wise_oee,1);
        // get month wise data
        $production_machine_wise_oee_data = [];
        if(count($machine_wise_oee) > 0 ){
            foreach ($machine_wise_oee as $key => $val) {
                 array_push($production_machine_wise_oee_data,['name'=>$machine_arr[$key],"y"=>$val,'drilldown'=>$machine_arr[$key]]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Machines",
            "yAxisLabel"=>"OEE",
            "series_data"=>$production_machine_wise_oee_data
        ];
        return $return_arr;
    }

    public function get_date_wise_oee($year = '',$month_arr = []){
        $molding_data = $this->dashboard_model->get_yesterday_oee_data($year,$month_arr,$unit);
        
        $return_arr = [];
        $date_wise_data = [];
        foreach ($molding_data as $key => $value) {
            $planned_pt  = ($value['production_hours'] - $value['ppt']);
            $runtime = $planned_pt - ($value['downtime_in_min']  + $value['setup_time_in_min']);
            $availbility = $planned_pt == 0 ? 0 : ($runtime / $planned_pt);
            $total_prod_qty = $value['rejection_qty'] + $value['qty'];
            $performance = $runtime == 0 ? 0 : ($value['cycle_time'] * $total_prod_qty ) / ($runtime * 60);
            $quality =  $total_prod_qty == 0 ? 0 : ($value['accepted_qty'] / $total_prod_qty);
            $oee = $availbility * $performance * $quality * 100;
            $date_wise_data[$value['date']][] = $oee;
            // array_push($date_wise_data,[$value['date'],number_format($oee,2)]);
        }

        foreach ($date_wise_data as $key => $value) {
            
            $oee =  array_sum($value)/count($value);
            array_push($return_arr,[$key,number_format($oee,2)]);
        }
        return $return_arr;
    }

    public function get_month_wise_oee_data($year = '',$month_arr = []){
        $molding_data = $this->dashboard_model->get_yesterday_oee_data($year,$month_arr,$unit);
        $month_wise_oee_data = [];
        if(is_array($molding_data) && count($molding_data) > 0){
            foreach ($molding_data as $key => $value) {
                $planned_pt  = ($value['production_hours'] - $value['ppt']);
                $runtime = $planned_pt - ($value['downtime_in_min']  + $value['setup_time_in_min']);
                $availbility = $planned_pt == 0 ? 0 : ($runtime / $planned_pt);
                $total_prod_qty = $value['rejection_qty'] + $value['qty'];
                $performance = $runtime == 0 ? 0 : ($value['cycle_time'] * $total_prod_qty ) / ($runtime * 60);
                $quality =  $total_prod_qty == 0 ? 0 : ($value['accepted_qty'] / $total_prod_qty);
                $oee = $availbility * $performance * $quality * 100;
                $date = $value['date'];
                $month_name = date("F", strtotime($value['date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_oee_data[$month_name] += $oee;
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $production_oee_month_wise_data = [];
        if(count($month_wise_oee_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_oee_data[$val])){
                    $sales_value = $month_wise_oee_data[$val];
                 }
                 
                 array_push($production_oee_month_wise_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"OEE",
            "series_data"=>$production_oee_month_wise_data
        ];
        return $return_arr;
    }

    /* Business Analytics */

    public function get_receivable_due_data($year = '',$month_arr = [],$unit = ''){
        $receivable_due = $this->dashboard_model->get_receivable_due_data($year,$month_arr,$unit);
        $total_amount_arr = array_sum(array_column($receivable_due, "basic_total"));
        $count_arr['count'] = $total_amount_arr > 0 ? $total_amount_arr : 0;
        return $count_arr;
    }

    public function get_payable_due_data($year = '',$month_arr = [],$unit = ''){

        $total_payable_record = $this->dashboard_model->get_payable_report($year,$month_arr,$unit);
        $total_pay_amount = 0;
        foreach ($total_payable_record as $key => $val) {
                $gst_amount = (float)($val['sgst_amount'] + $val['cgst_amount'] + $val['igst_amount'] + $val['tcs_amount']);
                $total_with_gst = $gst_amount + $val['base_amount'];  
                $bal_amnt = $total_with_gst - $val['amount_received'] - $val['tds_amount'];
                if($val['bal_amnt'] > 0){
                    if(array_key_exists($val['supplier_id'], $payable_data)){
                        $payable_data[$val['supplier_id']]['payable_amount'] += $bal_amnt;
                    }else{
                        $payable_data[$val['supplier_id']] = [
                            "customer_name" => $val['customer_name'],
                            "payable_amount" => $bal_amnt,
                            "receivable_amount" => 0
                        ];
                    }
                }
                $total_pay_amount += $bal_amnt;
            }
        $count_arr['count'] = $total_pay_amount;
        return $count_arr;
    }

    /* double bar chart chart */
    public function get_sales_purchase_grn($year = '',$month_arr = []){
        // gete sales data
        $sales_data = $this->dashboard_model->get_sales_purchase_grn($year,$month_arr);
        $month_wise_sales_data = [];
        if(is_array($sales_data) && count($sales_data) > 0){
            foreach ($sales_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_data[$month_name] += $value['basic_total'];
                //$month_wise_sales_data[$month_name] -= $value['total_discount'];
            }
        }
        // gete purchase data
        $purchase_grn_data = $this->dashboard_model->get_purchase_grn_data($year,$month_arr);  
        $month_wise_purchase_data = [];
        if(is_array($purchase_grn_data) && count($purchase_grn_data) > 0){
            foreach ($purchase_grn_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_purchase_data[$month_name] += $value['base_amount'];
            }
        } 

        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_purchase_data = [];
        $series_sales_data = [];
        if(count($month_wise_sales_data) > 0 || count($month_wise_purchase_data)>0){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_sales_data[$val])){
                    $sales_value = $month_wise_sales_data[$val];
                 }
                 array_push($series_sales_data, $sales_value);
                 $purchase_value = 0;
                 if(isset($month_wise_purchase_data[$val])){
                    $purchase_value = $month_wise_purchase_data[$val];
                 }
                 array_push($series_purchase_data, $purchase_value);
            } 
        }

        $series_data = [];
        if(count($series_purchase_data) > 0 || count($series_sales_data) > 0){
            $series_data = [
                ['name'=> 'Purchase','data'=> $series_purchase_data], 
                ['name'=> 'Sale','data'=> $series_sales_data]
            ]; 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Amount",
            "catergories" => $month_arr,
            "series_data" => $series_data
        ];
        return $return_arr;
    }

    public function get_rmsp($year = '',$month_arr = []){

        /* 
        Logic 
        Sales amount/material issue to production
            (Sales report basic amount)/(Material Request Report (Issued Qty*price))
            - price (child_part -> store_stock_rate)(in db) */
        $config_data = $this->session->userdata('entitlements');
        // gete sales data
        $sales_data = $this->dashboard_model->get_sales_purchase_grn($year,$month_arr);
        $month_wise_sales_data = [];
        if(is_array($sales_data) && count($sales_data) > 0){
            foreach ($sales_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_data[$month_name] += $value['basic_total'];
                //$month_wise_sales_data[$month_name] -= $value['total_discount'];
            }
        }
        // gete Material Request data
        if($config_data['isSheetMetal'] == 1){
            $material_request_data = $this->dashboard_model->get_material_request_data_sheet_metal($year,$month_arr);
            $month_wise_material_request_data = [];
            if(is_array($material_request_data) && count($material_request_data) > 0){
                foreach ($material_request_data as $key => $value) {
                    $date = $value['created_date'];
                    $month_name = date("F", strtotime($value['created_date']));
                    $month_name = substr($month_name, 0, 3);
                    $month_wise_material_request_data[$month_name] += $value['total_amount'];
                }
            }
        }else{
            $material_request_data = $this->dashboard_model->get_material_request_data($year,$month_arr);
            // pr($month_wise_sales_data);
           
            $month_wise_material_request_data = [];
            if(is_array($material_request_data) && count($material_request_data) > 0){
                foreach ($material_request_data as $key => $value) {
                    $date = $value['created_date'];
                    $month_name = date("F", strtotime($value['created_date']));
                    $month_name = substr($month_name, 0, 3);
                    $month_wise_material_request_data[$month_name] += $value['total_amount'];
                }
            }
        }
         // pr($month_wise_material_request_data,1);
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $series_sales_material_request_data = [];
        if(count($month_wise_sales_data) > 0 || count($month_wise_material_request_data)>0){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_sales_data[$val])){
                    $sales_value = $month_wise_sales_data[$val];
                 }
                 $purchase_value = 0;
                 if(isset($month_wise_material_request_data[$val])){
                    $purchase_value = $month_wise_material_request_data[$val];
                 }
                 $rmsp_value = 0;
                 if($sales_value > 0 && $purchase_value > 0){
                    $rmsp_value = ($sales_value/$purchase_value)*100;
                 }

                 
                 array_push($series_sales_material_request_data,['name'=>$val,"y"=>$rmsp_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"RMSP(%)",
            "series_data"=>$series_sales_material_request_data
        ];
        return $return_arr;
    }

    /* Subcon Tab */
    public function get_supplier_subcon_stocks($year = '',$month_arr = []){
        $supplier_subcon_stocks = $this->dashboard_model->get_supplier_subcon_stocks($year,$month_arr);
        $total_amount_arr = array_sum(array_column($supplier_subcon_stocks, "remaning_qty_amount"));
        $return_arr = [];
        foreach ($supplier_subcon_stocks as $key => $value) {
            $percentage = ($value['remaning_qty_amount']/$total_amount_arr)*100;
            $return_arr[] = ['name'=>$value['supplier_name'],'y'=>$percentage,'x'=>$percentage,'drilldown'=>$value['supplier_name']];
        }
        $return_arr = [
            "series_data"=>$return_arr,
            "show_legend" => false,
        ];

        return $return_arr;
    }
    public function get_supplier_subcon_total_stock($year = '',$month_arr = []){
        $supplier_subcon_stocks = $this->dashboard_model->get_supplier_subcon_stocks_new($year,$month_arr);
        $total_amount = 0;
        foreach ($supplier_subcon_stocks as $key => $value) {
            if($value['invoice_amount'] == $value['inwarding_price']){
                $total_amount += $value['required_qty'] * $value['store_stock_rate'];
            }
        }

        // if(count($supplier_subcon_stocks) >0){
        //     $total_amount = array_sum(array_column($supplier_subcon_stocks, "remaning_qty_amount"));
        // }else{
        //     $total_amount = 0;
        // }
        $return_arr = [
            "total_qty" => "₹ ".number_format($total_amount,2),
            "total_amount" => "" 
        ];
        return $return_arr;
    }

    public function get_supplier_subcon_month_wise($year = '',$month_arr = []){
        $supplier_subcon_month_wise = $this->dashboard_model->get_supplier_subcon_month_wise($year,$month_arr);
        $month_wise_sales_data = [];
        if(is_array($supplier_subcon_month_wise) && count($supplier_subcon_month_wise) > 0){
            foreach ($supplier_subcon_month_wise as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_data[$month_name] += $value['remaning_qty_amount'];
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $supplier_subcon_month_wise_data = [];
        if(count($month_wise_sales_data) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_sales_data[$val])){
                    $sales_value = $month_wise_sales_data[$val];
                 }
                 
                 array_push($supplier_subcon_month_wise_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Supplier Subcon(Amount) (INR)",
            "series_data"=>$supplier_subcon_month_wise_data
        ];
        return $return_arr;
    }

    public function get_customer_subcon_stock_amount($year = '',$month_arr = []){
        $supplier_subcon_stocks = $this->dashboard_model->get_supplier_subcon_stocks($year,$month_arr);
        $return_arr = [];
        foreach ($supplier_subcon_stocks as $key => $value) {
            array_push($return_arr,[$value['supplier_name'],number_format($value['remaning_qty_amount'],2)]);
        }
        return $return_arr;
    }

    /* Quality Tab */
    public function get_in_house_ppm($year = '',$month_arr = []){
        $in_house_ppm = $this->dashboard_model->get_in_house_ppm($year,$month_arr);
        $month_wise_in_house_ppm = [];
        if(is_array($in_house_ppm) && count($in_house_ppm) > 0){
            foreach ($in_house_ppm as $key => $value) {
                $date = $value['date'];
                $month_name = date("F", strtotime($value['date']));
                $month_name = substr($month_name, 0, 3);
                $ppm = ($value['rejection_qty']+$value['qty']) == 0 ? 0 : (($value['rejection_qty']+$value['rejected_qty']) /($value['rejection_qty']+$value['qty'])) * 1000000;
                $month_wise_in_house_ppm[$month_name] += $ppm;
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $in_house_ppm_month_wise_data = [];
        if(count($month_wise_in_house_ppm) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $ppm_value = 0;
                 if(isset($month_wise_in_house_ppm[$val])){
                    $ppm_value = $month_wise_in_house_ppm[$val];
                 }
                 
                 array_push($in_house_ppm_month_wise_data,['name'=>$val,"y"=>$ppm_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"In House PPM",
            "series_data"=>$in_house_ppm_month_wise_data
        ];
        return $return_arr;
    }
    public function get_in_house_rejection(){
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Rejection (NOS)",
            "series_data"=>[]
        ];
        return $return_arr;
    }
    public function get_inward_ppm($year = '',$month_arr = []){
        $inward_ppm = $this->dashboard_model->get_inward_inspection_ppm($year,$month_arr);
        $month_wise_inward_ppm = [];
        if(is_array($inward_ppm) && count($inward_ppm) > 0){
            foreach ($inward_ppm as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $ppm = $value['accept_qty'] > 0 ? ($value['reject_qty']/$value['accept_qty']) * 1000000 : 0;
                $month_wise_inward_ppm[$month_name] += $ppm;
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $inward_ppm_month_wise_data = [];
        if(count($month_wise_inward_ppm) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $ppm_value = 0;
                 if(isset($month_wise_inward_ppm[$val])){
                    $ppm_value = $month_wise_inward_ppm[$val];
                 }
                 
                 array_push($inward_ppm_month_wise_data,['name'=>$val,"y"=>$ppm_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Inward Inspection PPM",
            "series_data"=>$inward_ppm_month_wise_data
        ];
        return $return_arr;
    }
    public function get_customer_ppm($year = '',$month_arr = []){
        $rejection_invoice_data = $this->dashboard_model->get_rejection_invoice_data($year,$month_arr);
        $month_wise_rejection_invoice_data = [];
        if(is_array($rejection_invoice_data) && count($rejection_invoice_data) > 0){
            foreach ($rejection_invoice_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_rejection_invoice_data[$month_name] += $value['qty'];
            }
        }
        $sales_quality_data = $this->dashboard_model->get_sales_quality_data($year,$month_arr);
        $month_wise_sales_quality_data = [];
        if(is_array($sales_quality_data) && count($sales_quality_data) > 0){
            foreach ($sales_quality_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_sales_quality_data[$month_name] += $value['qty'];
            }
        }
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $customer_ppm_data = [];
        if(count($month_wise_rejection_invoice_data) > 0 && count($month_wise_sales_quality_data) > 0){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_rejection_invoice_data[$val]) && isset($month_wise_sales_quality_data[$val])){
                    $qty1 = $month_wise_rejection_invoice_data[$val];
                    $qty2 = $month_wise_sales_quality_data[$val];
                    if($qty2 > 0){
                        $sales_value = $qty1/$qty2;
                    }
                 }
                 
                 array_push($customer_ppm_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"PPM",
            "series_data"=>$customer_ppm_data
        ];
        return $return_arr;
    }
    public function get_customer_complaint($year = '',$month_arr = []){

        // for show no data pass data =>[]
        $return_arr = [
            'data' =>[['Chrome', 73.86],['Edge', 11.97]],
            'label_data' => [["label"=>"del_qty","val"=>"5,191,780"],["label"=>"pend_qty","val"=>"2,016,833"]],
            "color_lengend" =>['#e4ad16', '#3F4957']
        ];
        return $return_arr;
    }
    public function get_customer_ppm_percentage($year = '',$month_arr = []){
        $rejection_invoice_data = $this->dashboard_model->get_rejection_invoice_data($year,$month_arr);
        $customer_arr_1  = array_column($rejection_invoice_data,"customer_name","customer_id");
        $month_wise_rejection_invoice_data = [];
        if(is_array($rejection_invoice_data) && count($rejection_invoice_data) > 0){
            foreach ($rejection_invoice_data as $key => $value) {
                $customer_name = $value['customer_id'];
                $month_wise_rejection_invoice_data[$customer_name] += $value['qty'];
            }
        }
        $sales_quality_data = $this->dashboard_model->get_sales_quality_data($year,$month_arr);
        $customer_arr_2 = array_column($sales_quality_data,"customer_name","customer_id_val");
        $month_wise_sales_quality_data = [];
        if(is_array($sales_quality_data) && count($sales_quality_data) > 0){
            foreach ($sales_quality_data as $key => $value) {
                $customer_name = $value['customer_id_val'];
                $month_wise_sales_quality_data[$customer_name] += $value['qty'];
            }
        }

        $return_arr = [];
        if(count($month_wise_rejection_invoice_data) > 0 && count($month_wise_sales_quality_data) > 0){
            $customer_arr = [];
            $total_value = 0;
            foreach ($customer_arr_1 as $key => $value) {
                if(array_key_exists($key, $customer_arr_2)){
                    $qty1 = $month_wise_rejection_invoice_data[$key];
                    $qty2 = $month_wise_sales_quality_data[$key];
                    $sales_value = 0;
                    if($qty2 > 0){
                        $sales_value = $qty1/$qty2;
                        $total_value += $sales_value;
                    }
                    array_push($customer_arr, ["customer"=>$value,"per_value"=>$sales_value]);
                }
                
            }
            if($total_value > 0){
                foreach ($customer_arr as $key => $value) {
                    $percentage = ($value['per_value']/$total_value)*100;
                    $return_arr[] = ['name'=>$value['customer'],'y'=>$percentage,'x'=>$percentage,'drilldown'=>$value['customer']];
                }
            }

            
        }
        $return_arr = [
            "series_data"=>$return_arr,
            "show_legend" => false
        ];

        // pr($)
        return $return_arr;
    }

    public function get_cutomer_rejection_quality($year = '',$month_arr = []){
        $cutomer_rejection_quality_data = $this->dashboard_model->get_cutomer_rejection_quality($year,$month_arr);
        $month_wise_rejection_quality = [];
        if(is_array($cutomer_rejection_quality_data) && count($cutomer_rejection_quality_data) > 0){
            foreach ($cutomer_rejection_quality_data as $key => $value) {
                $date = $value['created_date'];
                $month_name = date("F", strtotime($value['created_date']));
                $month_name = substr($month_name, 0, 3);
                $month_wise_rejection_quality[$month_name] += $value['debit_basic_amt'];
            }
        }
        // get month wise data
        $month_arr = ['Apr',"May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",'Jan','Feb','Mar'];
        $rejection_quality_month_wise_data = [];
        if(count($month_wise_rejection_quality) > 0 ){
            foreach ($month_arr as $key => $val) {
                 $sales_value = 0;
                 if(isset($month_wise_rejection_quality[$val])){
                    $sales_value = $month_wise_rejection_quality[$val];
                 }
                 
                 array_push($rejection_quality_month_wise_data,['name'=>$val,"y"=>$sales_value,'drilldown'=>$val]);
            } 
        }
        $return_arr = [
            "delemeter" => "",
            "xAxisLabel"=>"Month(s)",
            "yAxisLabel"=>"Customer Rejection(Amount) (INR)",
            "series_data"=>$rejection_quality_month_wise_data
        ];
        return $return_arr;
    }


}