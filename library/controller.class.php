<?php

/**
 * Class Controller
 * Abstract controller class with main functionality for all controllers.
 */
class Controller
{

    protected $_controller;
    protected $_action;
    protected $_model;
    protected $_view;

    /**
     * @var bool Specifies if the view should be rendered without header (std. false)
     */
    public $doNotRenderHeader;

    /**
     * @var bool Specifies if the view should be rendered. (std. true)
     */
    public $render;

    /**
     * Controller constructor.
     * Generates the Controller
     * doNotRenderHeader FALSE,
     * render TRUE
     * @param $controller
     * @param $action
     */
    function __construct($controller, $action)
	{
		$this->_controller = $controller;
		$this->_action = $action;
		
		$this->doNotRenderHeader = FALSE;
		$this->render = TRUE;
		
		$this->_view = new View($controller, $action);
	}

    /**
     * Export variables to the view
     * @example set('content', $some_text); generates a Variable named $content accessible in the view
     * @param string $name of the variable
     * @param mixed $value of the variable
     */
    function set($name, $value) {
		
		$this->_view->set($name, $value);
	}

    /**
     * Destructor renders the view automatically
     */
    function __destruct() {
		
		if($this->render)
			$this->_view->render($this->doNotRenderHeader);
	}
}
