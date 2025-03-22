<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('CommonController.php');

class ProductionController extends CommonController
{

	const PATH = "";

	function __construct()
	{
		parent::__construct();
	}

	private function getPath()
	{
		return self::PATH;
	}

	private function getPage($viewPage, $viewData)
	{
		$this->loadView($this->getPath() . $viewPage, $viewData);
	}


}
