<?php
class ExportImportModel extends CI_Model {
    
    public function __construct() {
    }

    public function batchInsert($insert_arr = [],$table_name =""){
        $this->db->insert_batch($table_name, $insert_arr);
        return $this->db->insert_id();
    }

}
?>