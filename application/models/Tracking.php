<?php
class Tracking extends CI_Model {
    
    public function __construct() {
    }
    
    /**
     * Get by specific details
     */
    public function getPOTracking($data) {
        $list = $this->Crud->get_data_by_id_multiple_condition("customer_po_tracking", $data);
        return $list;
    }
    
    /**
     * Check whether record exists
     */

    public function isRecordExists($data){
        $rows = $this->Crud->read_data_where("customer_po_tracking",$data);
        if($rows!=0){
             return true;
        }
         return false;
    }

    public function createPO_tracking($po_item, $customer_id) {
        $po_insert = array(
            //"po_start_date" => $this->current_date, //current_date ?
            //"po_end_date" => null,       //po_end_date ?? null ?
            "po_number" => $po_item['po_number'],           //PO Number
            //"po_amedment_number" => $po_amedment_number, //null
            //"po_amendment_date" => $po_amendment_date,    //null
            "customer_id" => $customer_id,      // customer id
            "created_by" => $this->user_id,      
            "created_date" => $this->current_date,  
            "created_time" => $this->current_time,
            "created_by" => $this->current_date,
            "created_day" => $this->date,
            "created_month" => $this->month,
            "created_year" => $this->year,
           // "uploadedDoc" => $uploadedDocument    //null
        );
        $po_tracking = $this->Crud->insert_data("customer_po_tracking", $po_insert);
        return $po_tracking;

    }


    public function addUpdate_customerParts($po_item,$customer_id,$po_trackingId,$addFlow=true) {
        //need to get part_id details
        $part_queryData = array(
            "part_number" => $po_item['part_name'],
        //    "part_description" => $po_item['part_description'],
            "customer_id" => $customer_id
        );
        
        //var_dump($part_queryData);
        $customerParts = $this->Crud->get_data_by_id_multiple_condition("customer_part", $part_queryData);
       
        if(empty($customerParts)) {
            $errorMessage = "<br>Invalid part for PO: ".$po_item['part_name'].", Part Number : ".$po_item['part_name']." , Part Description: ".$po_item['part_description'];
            return $errorMessage;
        }
    

        $data = array(
            "qty" => $po_item['part_quantity'],
            "customer_po_tracking_id" => $po_trackingId,
            "part_id" => $customerParts[0]->id,
            "status" => $po_item['part_status'],
            "remark" => $po_item['part_remark'],
            "warehouse" => $po_item['part_warehouse'],
            "due_date" => $po_item['part_due_date'],
            "imported_price" =>$po_item['part_price'],
            "created_by" => $this->user_id,
            "created_date" => $this->current_date,
            "created_time" => $this->current_time,
            "created_day" => $this->date,
            "created_month" => $this->month,
            "created_year" => $this->year,
        );
        
        if($addFlow){
            $insertParts = $this->Crud->insert_data("parts_customer_trackings", $data);
            
            if($insertParts){
            } else {
                $errorMessage = "Failed to add part: ".$po_item['part_name']." for PO: ".$po_item['po_number'].". Please try again.";
            }
        } else {
            $part_queryData = array(
                "part_id" => $customerParts[0]->id,
                "customer_po_tracking_id" => $po_trackingId
            );
            
            $customerParts = $this->Crud->get_data_by_id_multiple_condition("parts_customer_trackings", $part_queryData);
            if(empty($customerParts)){
                // we need to check and update if it is already present or insert new record...
                $insertParts = $this->Crud->insert_data("parts_customer_trackings", $data);
                
                if($insertParts){
                } else {
                    $errorMessage = "Failed to add part: ".$po_item['part_name']." for PO: ".$po_item['po_number']."Please try again.";
                }
            }else{
                $updateParts = $this->Crud->update_data("parts_customer_trackings", $data, $customerParts[0]->id);
                if($updateParts){
                } else {
                    $errorMessage = "Failed to update part: ".$po_item['part_name']." for PO: ".$po_item['po_number'].". Please try again.";
                }
            }
        
        }
        return $errorMessage;
        
    }

    public function batchInsert($insert_arr = [],$table_name =""){
        $this->db->insert_batch($table_name, $insert_arr);
    }

}
?>