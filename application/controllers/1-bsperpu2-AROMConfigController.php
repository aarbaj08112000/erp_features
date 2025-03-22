<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AROMConfigController extends CI_Controller {
	
	/**
	 * Configure current financial year
	 */
	public function getFinancialYear() {
		return "24-25";
	}
	
	public function getCustomerPrefix() {
		return "BSP-II";
	}

	/**
	 * Configure customer name for invoice etc.
	 */
	public function getCustomerNameDetails() {
		return "BSP METATECH LLP";
	}

	//---------------- PDI Details to be taken from Master once defined ---
	public function getPDIRev() {
		return "01";
	}

	public function getPDIRevDate() {
		return "11.08.2021";
	}
	
	public function getPDIFormat() {
		return "F/QA/08";
	}

	public function isPDIRandomGeneratorEnabled() {
			return true;
		}

	/**
	 * Configure current customer
	 */
	public function getAROMCustomerName() {
		return "BSP";
	}
	

}