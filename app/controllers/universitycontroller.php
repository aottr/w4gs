<?php

class UniversityController extends Controller
{
	private $_storage;

	/**
	 * Creates a new instance with a JSONStorage
	 */
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

	/**
	 * Show information about a specific module
	 * @param string $module module abbreviation
	 */
	function module($module = '') {

		$module_data = $this->_storage->select('university', ['abbr' => $module]);

		if(!count($module_data) || empty($module)) {

			header('Location: ' . BASE_URL . 'university');
            exit(44);
		}

		$this->set('module', $module_data);
	}
}
