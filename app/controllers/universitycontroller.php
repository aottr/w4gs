<?php

class UniversityController extends Controller
{
	private $_storage;

	function __construct($controller, $action)
	{
		$this->_storage = new JSONStorage();
		parent::__construct($controller, $action);
	}

	/**
	 *	Lists all active university modules 
	 */
	function index()
	{
		$modules = $this->_storage->select('university', ['status' => 'active']);
		$this->set('modules', $modules);
	}

	function module($module) {

		$module_data = $this->_storage->select('university', ['abbr' => $module]);
		$this->set('module', $module_data);
	}


}