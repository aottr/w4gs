<?php

class View {

    function __construct() {
        
    }

    public function render($name, $noInclude = false) {
        
        ob_start();
        if ($noInclude)
            require_once ( ROOT . DS . 'application' . DS . 'views' . DS . $name . ".tpl");
        else {
            require_once ( ROOT . DS . 'application' . DS . 'views' . DS . "overall_header.tpl");
            require_once ( ROOT . DS . 'application' . DS . 'views' . DS . $name . ".tpl");
            require_once ( ROOT . DS . 'application' . DS . 'views' . DS . "overall_footer.tpl");
        }
        
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

}