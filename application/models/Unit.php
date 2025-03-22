<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This is model to get details around Client Unit and supported activity.
 */
class Unit extends CI_Model
{


	//Multiple Client support check
	public function isMultiClientSupport() {
		$isMultipleClientUnit = $this->session->userdata['isMultipleClientUnits'];
		if(empty($isMultipleClientUnit) || $isMultipleClientUnit == '' ) {
			$isMultipleClientUnit = $this->readConfig("isMultipleClientUnits","false");
			$this->session->set_userdata('isMultipleClientUnits',$isMultipleClientUnit);
		}
		return $isMultipleClientUnit;
	}



	public function getSessionClientId() {
		$clientUnit = $this->session->userdata['clientUnit'];
		return $clientUnit;
	}

	
	public function getSessionClientUnitName() {
		$clientUnitName = $this->session->userdata['clientUnitName'];
		return $clientUnitName;
	}

	//Multiple Client support check
	public function getNoOfClients() {
		$clientCount = $this->session->userdata['noOfClients'];
		if(empty($clientCount) || $clientCount == '' ) {
			$clientCount = $this->Crud->record_count("client");
			$this->session->set_userdata('noOfClients',$clientCount); //Total no of client in DB
		}
		return $clientCount;
	}

	//Get current client details..
	public function getClientUnitDetails($clientUnit=null) {
		$client = null;
		if(empty($clientUnit)) {
			$clientUnit = $this->session->userdata['clientUnit'];
			
		}
		if(!empty($clientUnit)) {
			$data = array(
				"id" => $clientUnit
			);
			$client = $this->Crud->get_data_by_id_multiple("client", $data);
			$this->session->set_userdata('clientUnit', $client[0]->id); //set the clientUnit to session..
			$this->session->set_userdata('clientUnitName', $client[0]->client_unit); //set the clientUnit to session..
		}
		return $client;
	}


	/**
	 * Get stock or production db column name
	 */
	public function getStockDBColumnName($fieldName) {
		$clientUnit = $this->session->userdata['clientUnit'];
		$fieldNameDBName = $fieldName;
		if ($clientUnit > 1) {
			$fieldNameDBName = $fieldNameDBName . $clientUnit;
		}
		return $fieldNameDBName;
	}
	
	/**
	 * Common store stock
	 */
	public function getStockColNmForClientUnit($unitId='') {
		$stock_column_name = "stock"; //Need to get stock value from appropriate column...
		return $stock_column_name;

		/*if(empty($unitId)){
			$currentUnit = $this->session->userdata['clientUnit'];
			if($currentUnit > 1){
				$stock_column_name = "stock".$currentUnit; 
			}
		}else{
			if($unitId > 1){
				$stock_column_name = "stock".$unitId;
			}
		}
        return $stock_column_name;*/
	}

	/**
	 * Common FG stock
	 */
	public function getFGStockColNmForClientUnit($unitId='') {
		$stock_column_name = "fg_stock"; //Need to get stock value from appropriate column...
		return $stock_column_name;

		/*if(empty($unitId)){
			$currentUnit = $this->session->userdata['clientUnit'];
			if($currentUnit > 1){
				$stock_column_name = "fg_stock".$currentUnit; 
			}
		}else{
			if($unitId > 1){
				$stock_column_name = "fg_stock".$unitId;
			}
		}
        return $stock_column_name;*/
	}

	/**
	 * Sheet metal - Production qty table
	*/

	public function getProdColNmForClientUnit($unitId='') {
		$stock_column_name = "production_qty"; //Need to get stock value from appropriate column...
		return $stock_column_name;

		/*if(empty($unitId)){
			$currentUnit = $this->session->userdata['clientUnit'];
			if($currentUnit > 1){
				$stock_column_name = "production_qty".$currentUnit; 
			}
		}else{
			if($unitId > 1){
				$stock_column_name = "production_qty".$unitId;
			}
		}
        return $stock_column_name;*/
	}

	/**
	 * Plastic metal - Production qty table
	 */
	public function getPlasticProdColNmForClientUnit($unitId='') {
			$stock_column_name = "machine_mold_issue_stock"; //Need to get stock value from appropriate column...
			return $stock_column_name;
			/* if(empty($unitId)){
				$currentUnit = $this->session->userdata['clientUnit'];
				if($currentUnit > 1){
					$stock_column_name = "machine_mold_issue_stock".$currentUnit; 
				}
			}else{
				if($unitId > 1){
					$stock_column_name = "machine_mold_issue_stock".$unitId;
				}
			}
			return $stock_column_name;*/
		}


	/**
	 * Sharing Qty
	 */
	public function getSharingQtyColNmForClientUnit($unitId='') {
		$stock_column_name = "sharing_qty"; //Need to get stock value from appropriate column...
		return $stock_column_name;
		/* if(empty($unitId)){
			$currentUnit = $this->session->userdata['clientUnit'];
			if($currentUnit > 1){
				$stock_column_name = "sharing_qty".$currentUnit; 
			}
		}else{
			if($unitId > 1){
				$stock_column_name = "sharing_qty".$unitId;
			}
		}
        return $stock_column_name; */
	}
	
	/**
	 * Get stock or production db column name
	 */
	public function getClientToCustomerDistanceTbColName() {
		$clientUnit = $this->session->userdata['clientUnit'];
		$fieldNameDBName = "distncFrmClnt";
		if ($clientUnit) {
			$fieldNameDBName = $fieldNameDBName . $clientUnit;
		}
		return $fieldNameDBName;
	}

}