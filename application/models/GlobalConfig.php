<?php
class GlobalConfig extends CI_Model {
    	
    public function __construct() {
    }
	
    
    public function readConfiguration($configName,$defaultValue) {
		$configValue  = $this->Crud->customQuery("SELECT config_value FROM global_configuration WHERE config_name = '".$configName."'");
		if(empty($configValue[0]->config_value)) {
			return $defaultValue;
		}else{
			return trim($configValue[0]->config_value);
		}
	}

    


}
?>