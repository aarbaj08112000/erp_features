
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');

class FGStockController extends CommonController
{

    const PATH = "";
    function __construct() {
        parent::__construct();
        $this->load->model('InhouseParts');
        $this->load->model('CustomerPart');
    }

    private function getPath() {
        return self::PATH;
    }

    private function getPage($viewPage, $viewData) {
        $this->loadView($this->getPath() . $viewPage, $viewData);
    }

    public function fg_stock()
    {
        checkGroupAccess("fw_stock","list","Yes");
        $entitlements = $this->session->userdata("entitlements");
        $isSheetMetal = isset($entitlements['isSheetMetal']) && $entitlements['isSheetMetal'] != null ? "Yes" : "No";

        $part_id = $this->input->post("part_id");
        $data['inhouse_parts'] = $this->InhouseParts->getUniquePartNumber();
        $data['customer_parts'] = $this->CustomerPart->readCustomerParts();
        /* datatable */
        $column[] = [
            "data" => "customer_parts_master_id",
            "title" => "customer_parts_master_id",
            "width" => "15%",
            "className" => "dt-left",
            "visible" => false
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "Part Number",
            "width" => "15%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "Part Description",
            "width" => "15%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "fg_stock",
            "title" => "FG STOCK",
            "width" => "10%",
            "className" => "dt-center",
        ];
        if($isSheetMetal == "Yes"){
            $column[] = [
                "data" => "transfer_to_inhouse_part",
                "title" => "FG Stock Transfer",
                "width" => "20%",
                "className" => "dt-center status-row",
                'orderable' => false
            ];
        }

        if($isSheetMetal != "Yes"){
            $column[] = [
                "data" => "molding_production_qty",
                "title" => "Molding Production Qty",
                "width" => "10%",
                "className" => "dt-center",
            ];
            $column[] = [
                "data" => "production_rejection",
                "title" => "Production Rejection",
                "width" => "10%",
                "className" => "dt-center",
            ];
        }
        $column[] = [
            "data" => "final_inspection_location",
            "title" => "Final Inspection Location",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "production_scrap",
            "title" => "Production Scrap",
            "width" => "10%",
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
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[0, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200], [10,50,100,200]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $data['isSheetMetal'] = $isSheetMetal;
        // $ajax_json['teacher_data'] = $this->session->userdata();
        // pr($ajax_json['designation'],1);
        $this->loadView('store/fw_stock', $data,"Yes","Yes");

        // $this->loadView('store/fw_stock', $data);

    }
    public function get_fg_stock_view()
    {
        $post_data = $this->input->post();
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        // pr($post_data,1);
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
        $data = $this->CustomerPart->get_fg_stock_view(
            $condition_arr,
            $post_data["search"]
        );
        // pr($data,1);
        foreach ($data as $key => $value) {
            
            if(checkGroupAccess("fw_stock","update","No") && $value['fg_stock'] > 0){
                $data[$key]['transfer_to_inhouse_part'] = "<button type='button' class='btn btn-primary fg-transfer me-2'  data-stock='".$value['fg_stock']."' data-customer-part-id='".$value['customer_parts_master_id']."' data-part-number='".$value['part_number']."'>
                    Transfer To Inhouse
                  </button>";
                $data[$key]['transfer_to_inhouse_part'] .= "<button type='button' class='btn btn-primary fg-to-fg-transfer'  data-stock='".$value['fg_stock']."' data-customer-part-id='".$value['customer_parts_master_id']."' data-part-number='".$value['part_number']."'>
                    Transfer To FG
                  </button>";
            }else{
                $data[$key]['transfer_to_inhouse_part'] = display_no_character();
            }
        }
        $data["data"] = $data;
        $total_record = $this->CustomerPart->get_fg_stock_view_count([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
        
    }

    public function transfer_fg_stock_to_inhouse_stock()
    {
        $inhouse_part_number  = $this->input->post('inhouse_part_number');
        $part_number  = $this->input->post('part_number');
        $customer_parts_master_id  = $this->input->post('customer_parts_master_id');
        $stock  = (float)$this->input->post('stock');

        $customer_parts_master_data = $this->CustomerPart->getCustomerPartById($customer_parts_master_id);
        $inhouse_parts_data = $this->InhouseParts->getInhousePartByPartNumber($inhouse_part_number);

        $customer_parts_master_data_old_fg_stock = (float)$customer_parts_master_data[0]->fg_stock;
        $new_stock = $customer_parts_master_data_old_fg_stock - $stock;
        $new_stock_inhouse_part = $inhouse_parts_data[0]->production_qty + $stock;

        $data_update_child_part = array(
            "production_qty" => $new_stock_inhouse_part,
        );
        $data_update_new_stock_customer_partt = array(
            "fg_stock" => $new_stock
        );

        $query = $this->InhouseParts->updateStockById($data_update_child_part, $inhouse_parts_data[0]->id);
        $query = $this->CustomerPart->updateStockById($data_update_new_stock_customer_partt, $customer_parts_master_id);

        // if ($query) {
        //  $this->Crud->stock_report($customer_parts_master_data[0]->part_number, $inhouse_part_number, "fg_stock", "inhouse_parts", $customer_parts_master_data_old_fg_stock, $stock);
        //  $this->addSuccessMessage('Stock transferred successfully.');
        // } else {
        //  $this->addErrorMessage('Unable to transfer stock');
        // }
        // $this->redirectMessage();
        if ($query) {
            $this->Crud->stock_report($customer_parts_master_data[0]->part_number, $inhouse_part_number, "fg_stock", "inhouse_parts", $customer_parts_master_data_old_fg_stock, $stock);
            $success = 1;
            $messages = "Stock transferred successfully.";
        } else {
            $success = 0;
            $messages = "Unable to transfer stock";
        }

        $return_arr['success']=$success;
        $return_arr['messages']=$messages;
        echo json_encode($return_arr);
        exit;
    }

    public function transfer_fg_stock_to_fg_stock()
    {

        
        $to_transfer_part_id  = $this->input->post('fg_part_id');
        $part_number  = $this->input->post('part_number');
        $customer_parts_master_id  = $this->input->post('customer_parts_master_id');
        $stock  = (float)$this->input->post('stock');

        $customer_parts_master_data = $this->CustomerPart->getCustomerPartById($customer_parts_master_id);
        $to_transfer_part_data = $this->CustomerPart->getCustomerPartById($to_transfer_part_id);


        $customer_parts_master_data_old_fg_stock = (float)$customer_parts_master_data[0]->fg_stock;
        $new_stock = $customer_parts_master_data_old_fg_stock - $stock;
        $new_stock_fg_part = (float)$to_transfer_part_data[0]->fg_stock + $stock;

        $data_update_child_part = array(
            "fg_stock" => $new_stock_fg_part,
        );
        $data_update_new_stock_customer_partt = array(
            "fg_stock" => $new_stock
        );

        $query = $this->CustomerPart->updateStockById($data_update_child_part, $to_transfer_part_id);
        $query = $this->CustomerPart->updateStockById($data_update_new_stock_customer_partt, $customer_parts_master_id);

        // if ($query) {
        //  $this->Crud->stock_report($customer_parts_master_data[0]->part_number, $inhouse_part_number, "fg_stock", "inhouse_parts", $customer_parts_master_data_old_fg_stock, $stock);
        //  $this->addSuccessMessage('Stock transferred successfully.');
        // } else {
        //  $this->addErrorMessage('Unable to transfer stock');
        // }
        // $this->redirectMessage();
        if ($query) {
            $this->Crud->stock_report($customer_parts_master_data[0]->part_number, $to_transfer_part_data[0]->part_number, "fg_stock", "fg_stock", $customer_parts_master_data_old_fg_stock, $new_stock);
            $success = 1;
            $messages = "Stock transferred successfully.";
        } else {
            $success = 0;
            $messages = "Unable to transfer stock";
        }

        $return_arr['success']=$success;
        $return_arr['messages']=$messages;
        echo json_encode($return_arr);
        exit;
    }

    public function customer_parts_admin($part_id_selected = null)
    {
        checkGroupAccess("customer_parts_admin","list","Yes");
        $data['child_parts_list_distinct']  = $this->CustomerPart->getUniquePartNumber();
        if(empty($part_id_selected)){
            $part_id_selected = $this->input->post("part_id_selected");
        }

        $part_id_selected =1;
        $data['child_part'] = $this->CustomerPart->getCustomerPartdata($part_id_selected);
        
        $data['enableStockUpdate'] = $this->isEnableStockUpdate();
        $this->loadView('admin/customer_parts_admin', $data);
    }

    public function update_customer_parts_master_fg_stock() {
        $id = $this->input->post('id');
        $stock = $this->input->post('stock');

        $data = array(
            "fg_stock" => $stock
        );
        $success = 0;
        $messages = "Something went wrong.";
        $result = $this->CustomerPart->updateStockById($data, $id);
        if ($result) {
            $messages = "Stock updated successfully.";
            $success = 1;
            // $this->addSuccessMessage('Stock updated successfully.');
        } else {
            $messages = "Unable to update stock. Please try again.";
            // $this->addErrorMessage('Unable to update stock. Please try again.');
        }
        $result = [];
        $result['msg'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
    }

}
