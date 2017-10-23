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
        $fstream = fopen($this->path, "a+") or exit(50);
        
        $message = date("Y-m-d H:i:s: ") . $message . "\n";
        
        fputs($fstream, $message);
        fclose($fstream) or exit(52);
    }
}