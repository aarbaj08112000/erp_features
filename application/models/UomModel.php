<?php
class UomModel extends CI_Model {
    	
    private $name;
    private $description;
    private $createdby;

	public function __construct() {
        $this->name = $name;
        $this->description = $description;
	}
	
   /** 
    * Get all UOM's
    */ 
   public function getAllUOM() {
		return $this->Crud->read_data("uom");
    }
    
    /**
     * Get by Id
     */
	public function getUOMById($id) {
        $list = $this->Crud->get_data_by_id_desc("uom", $id);
        return $list;
    }

    /**
     * Get by specific details
     */
	public function getUOM($data) {
        $list = $this->Crud->get_data_by_id_multiple_condition("uom", $data);
        return $list;
    }
	
    /**
     * Check whether record exists
     */

    public function isRecordExists($data){
        $rows = $this->Crud->read_data_where("uom",$data);
        if($rows!=0){
             return true;
        }
         return false;
    }

    /**
     * Create UOM
     */
   public function createUOM($data) {
        $newRecordId = $this->Crud->insert_data("uom", $data);
        return $newRecordId;
    }

    /**
     * Update UOM by Id
     */
    public function updateUOM($data,$id) {
        $result = $this->Crud->update_data("uom", $data, $id);
        if($result) {
            return true;
        }
         return false;
    }

    /**
     * Delete UOM by Id
     */
    public function deleteUOM($id) {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}
?>