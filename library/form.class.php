<?php

/**
 * 
 * - Fill out a Form
 *  - POST to PHP
 *  - Sanitize
 *  - Validate
 *  - Return Data
 *  - Write to Database
 */

/**
 * Description of form
 *
 * @author Dustin Kröger
 */
class Form {
    
    /**
     *
     * @var array $_currentItem The immediately posted item 
     */
    private $_currentItem = null;

    /**
     * postdata
     * @var array $_postData Sores the Posted Data
     */
    private $_postData = array();
    
    /**
     * val
     * @var object $_val validator object
     */
    private $_val = array();
    
    /**
     * error
     * @var array $_error Holds the current forms errors
     */
    private $_error = array();
    
    /**
     * __construct - Instantiates the validator class
     */
    public function __construct() {
        
        $this->_val = new Validate();
    }
    
    /**
     * post - This is to run $_POST
     * 
     * @param string $field - The HTML fieldname to post
     * @return \Form
     */
    public function post($field = FALSE) {
        
        if(!$field)
            return FALSE;
            
        $this->_postData[$field] = $_POST[$field];
        $this->_currentItem = $field;
        return $this;
    }
    
    /**
     * fetch - Return the posted data
     * @param mixed $fieldName
     * @return mixed String or array
     */
    public function fetch($fieldName = false) {
        
        if($fieldName)
        {
            if(isset($this->_postData[$fieldName]))
                return $this->_postData[$fieldName];
            else 
                return FALSE;
        }
        else
            return $this->_postData;
    }

     /**
      * 
      * @param string $typeOfValidator A method from the Form/Val class
      * @param string $arg A property to validate against
      * @return \Form
      */
    public function val($typeOfValidator, $arg = NULL) {
        
        if($arg == NULL)
            $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
        else
            $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
        
        if($error) {
            
            $this->_error[$this->_currentItem] = $error;
        }
        
        return $this;
    }
    
    /**
     * submit - Handles the forms, and throws an exception upon error.
     * @return boolean
     * @throws Exception
     */
    public function submit() {
        
        if(empty($this->_error))
            return TRUE;
        else 
        {
            $str = '';
            foreach ($this->_error as $key => $value) {
                $str .= $key . ' => ' . $value . "\n";
            }
            
            throw new Exception($str);
        }
    }
}

