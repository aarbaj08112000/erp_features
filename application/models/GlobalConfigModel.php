<?php
class GlobalConfigModel extends CI_Model {

	public function __construct() {
        
	}
    public function getGroupData($group_id = 0){
        $this->db->select('g.*');
        $this->db->from('group_master as g');
        if($group_id > 0){
             $this->db->where("g.group_master_id",$group_id);
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getGroupRightsData($group_id = 0){
        $this->db->select('g.*,m.diaplay_name,m.menu_category_id,mc.category_name');
        $this->db->from('group_rights as g');
        $this->db->join("menu_master as m","m.menu_master_id = g.menu_master_id");
        $this->db->join("menu_category as mc","mc.menu_category_id = m.menu_category_id");
        $this->db->where("g.group_master_id",$group_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function updateGroupRightsData($update_data = array()) {
        $affected_rows = $this->db->update_batch("group_rights", $update_data, "group_rights_id");
        $affected_rows = $affected_rows == 0 ? 1 : $affected_rows;
        return $affected_rows;
    }
    public function checkGroupCodeExist($group_code = 0){
        $this->db->select('g.*');
        $this->db->from('group_master as g');
        $this->db->where("g.group_code",$group_code);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function checkGroupNameExist($group_name= 0){
        $this->db->select('g.*');
        $this->db->from('group_master as g');
        $this->db->where("g.group_name",$group_name);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function insertGroup($insert_date = array()){
        $this->db->insert("group_master", $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function insertGroupRights($insert_date = array()){
        $this->db->insert_batch('group_rights', $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function updateGroupMasterData($update_date = array(),$group_master_id = 0){
        $this->db->where('group_master_id', $group_master_id);
        $this->db->update('group_master', $update_date);
        $affected_rows = $this->db->affected_rows() == 0 ? 1 : $this->db->affected_rows();
        return $affected_rows;
    }
    public function getAllMenuData(){
        $this->db->select('m.*,mc.category_name');
        $this->db->from('menu_master as m');
        $this->db->join("menu_category as mc","mc.menu_category_id = m.menu_category_id");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }

    public function deleteGroupRights($group_id = 0){
        $this->db->where('group_master_id', $group_id);
        $this->db->delete('group_rights');
    }
    /* check access for groups */
    public function check_group_access($page_url = "",$type = ''){
        $access = false;
        $session = $this->session->userdata();
        $groups = explode(",",$session['groups']);
        if(is_valid_array($groups)){
            $group_rights_data = $this->getGroupAccessList($groups,$page_url);
            if(is_valid_array($group_rights_data)){
                $group_rights = array_values($group_rights_data);
                $group_rights = $group_rights[0];

                if($group_rights[$type] == "Yes"){
                    $access = true;
                }
            }
            
        }
        
        // $user_role = $session['role'];
        // $group_data = $this->checkGroupCodeExist($user_role);
        // if(is_valid_array($group_data)){
        //     $group_master_id = $group_data[0]['group_master_id'];
        //     $page_menu_data = $this->getMenuDetails($page_url);
        //     if(is_valid_array($page_menu_data)){
        //         $page_menu_id = $page_menu_data['menu_master_id'];
        //         $group_access_data = $this->checkGroupAccess($group_master_id,$page_menu_id);
        //         if(is_valid_array($group_access_data)){
        //             if($group_access_data[$type] == "Yes"){
        //                 $access = true;
        //             }
        //         }
        //     }
        // }
        return $access;
    }
    public function getMenuDetails($page_url = ""){
        $this->db->select('m.*');
        $this->db->from('menu_master as m');
        $this->db->where("m.url",$page_url);
        $this->db->where("m.status","Active");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function checkGroupAccess($group_master_id = 0,$page_menu_id = 0){
        $this->db->select('gr.*');
        $this->db->from('group_rights as gr');
        $this->db->where("gr.group_master_id",$group_master_id);
        $this->db->where("gr.menu_master_id",$page_menu_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function getGroupAccessList($groups=[],$menu_url = ""){
        $group_rights = $this->getGroupRightsDataList($groups,$menu_url);
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
            if(!isset($group_rights_arr[$value['menu_master_id']]['export'])  || (isset($group_rights_arr[$value['menu_master_id']]['export']) && $group_rights_arr[$value['menu_master_id']]['export'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['export'] = $value['export'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['import'])  || (isset($group_rights_arr[$value['menu_master_id']]['import']) && $group_rights_arr[$value['menu_master_id']]['import'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['import'] = $value['import'];
            }
        }
        // pr($group_rights_arr,1);
        return $group_rights_arr;
    }
    public function getGroupRightsDataList($group_id = [],$menu_url = ''){
        $group_rights_arr = $this->session->userdata('group_rights_arr');
        $group_rights_arr =  $group_rights_arr != "" ? json_decode(base64_decode($group_rights_arr),TRUE) : '';
        $ret_data = [];
        if(is_valid_array($group_rights_arr)){ 
            foreach ($group_rights_arr as $key => $value) {
                if($value['url'] == $menu_url){
                   $ret_data[] = $value;
                }
            }
        }
        // pr($ret_data,1);
        // pr($ret_data,1);
        // $group_id = explode(",",$group_id);
        // $this->db->select('g.*,m.diaplay_name,m.url');
        // $this->db->from('group_rights as g');
        // $this->db->join("menu_master as m","m.menu_master_id = g.menu_master_id");
        // $this->db->where_in("g.group_master_id",$group_id);
        // if($menu_url != ""){
        //     $this->db->where("m.url",$menu_url);
        // }
        // $result_obj = $this->db->get();
        // $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getGroupRightData($group_id = [],$menu_url = ''){
        $group_id = explode(",",$group_id);
        $this->db->select('g.*,m.diaplay_name,m.url');
        $this->db->from('group_rights as g');
        $this->db->join("menu_master as m","m.menu_master_id = g.menu_master_id");
        $this->db->where_in("g.group_master_id",$group_id);
        if($menu_url != ""){
            $this->db->where("m.url",$menu_url);
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }


	
   
}
?>