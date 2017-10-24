<?php

class View {

	protected $variables = array();
	protected $controller;
	protected $action;

    function __construct($controller, $action) {
    
    	$this->controller = $controller;
    	$this->action = $action;
    }
    
    /**
     * Funktion zum Setzen von Variablen
     * @param $name Name der Variable
     * @param $value Wert der Variable
     */
    function set($name, $value) {
	    
	    $this->variables[$name] = $value;
    }

    public function render($doNotRenderHeader = false, $return = false) {
    
    	if($this->variables != NULL)
    		extract($this->variables);
        
        ob_start();
        if ($doNotRenderHeader)
            require_once ( ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . $this->action . ".tpl");
        else {
            require_once ( ROOT . DS . 'app' . DS . 'views' . DS . "overall_header.tpl");
            require_once ( ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . $this->action . ".tpl");
            require_once ( ROOT . DS . 'app' . DS . 'views' . DS . "overall_footer.tpl");
        }
        
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;

        if($return)
            return $output;
    }

}