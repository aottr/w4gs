<?php

/**
 * File: log.class.php
 *
 * Einfache Klasse zum Sichern von Log-Informationen
 * 
 * Dem Konstruktor wird der Name der Log-Datei übergeben, 
 * unter dem sie abgespeichert/ergänzt wird.
 * Der Pfad kann nachträglich geändert werden.
 *
 * @author staubrein <me@staubrein.com>
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