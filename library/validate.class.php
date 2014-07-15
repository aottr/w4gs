<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of val
 *
 * @author Dustin Kröger
 */
class Validate {
    
    public function __construct() {
        ;
    }
    
    public function minlength($data, $arg) {
        
        if(strlen($data) < $arg) {
            
            return "Your string can only be $arg long.";
        }
    }
    public function maxlength($data, $arg) {
        
        if(strlen($data) > $arg) {
            
            return "Your string can only be $arg long.";
        }
    }
    
    public function digit($data) {
        
        if(!ctype_digit($data)) {
            
            return "Your string must be a digit.";
        }
    }
    
    public function __call($name, $arguments) {
        
        throw new Exception("$name does not exist inside of: " . __CLASS__);
    }
}

?>
