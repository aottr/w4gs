<?php
/**
 * Description of log
 *
 * @author me@staubrein.com
 */
class Log {
   
    public $path;

    function __construct($name) {
        $this->path = ROOT . DS . 'tmp' . DS . 'logs' . DS . $name . ".log";
    }
    
    function write($message) {
        $fp = fopen($this->path, "a+") or die 
                ("Error opening file in write mode!");
        
        $message = date("Y-m-d H:i:s: ") . $message . "\n";
        
        fputs($fp, $message);
        fclose($fp) or die ("Error closing file!");
    }
}

?>
