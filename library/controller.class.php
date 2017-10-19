<?php

class Controller
{
	protected $controller;
	protected $action;
	protected $model;
	protected $view;
	
	public $doNotRenderHeader;
	public $render;
	
	function __construct($controller, $action)
	{
		$this->controller = $controller;
		$this->action = $action;
		
		$this->doNotRenderHeader = FALSE;
		$this->render = TRUE;
		
		$this->view = new View($controller, $action);
	}
	
	function set($name, $value) {
		
		$this->view->set($name, $value);
	}
	
	function __destruct() {
		
		if($this->render)
			$this->view->render($this->doNotRenderHeader);
	}
}