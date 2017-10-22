<?php

class JSONStorage {

    protected $_path;

    public function __construct() {
        
       $this->_path = ROOT . DS . 'app/db/';
    }

    public function setPath($path) {

        $this->_path = $path;
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $bindParams Parameters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    function select($object, $attributes = array()) {

        $data = $this->json_object_to_assoc_array($object);

        if(empty($attributes))
            return $data;

        $solution = array();
         
        foreach ($data as $entry_key => $entry) {

            $add_entry = false;

            foreach ($attributes as $key => $value) {
                
                if($entry[$key] == $value)
                    $add_entry = true;
                else
                    $add_entry = false;

            }

            if($add_entry)
                $solution[$entry_key] = $entry;
        }

        if(count($solution) == 1)
            $solution = array_values($solution)[0];;

        return $solution;
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($object, $data) {
        
        if(empty($data))
            return FALSE;

        $object_array = $this->json_object_to_assoc_array($object);

        array_push($object_array, $data);

        return $this->assoc_array_to_json_object($object, $object_array);
    }

    /**
     * update
     * @param string $table A name of table to update
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        
       
    }
    
    /**
     * delete
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return Affected rows
     */
    public function delete($table, $where, $limit = 1) {
        
       
    }

    private function json_object_to_assoc_array($object) {

        // get the file extension
        $extension = array_values(array_slice(preg_split('/\./', $object), -1))[0];
        
        if($extension != 'json')
            $object .= '.json';

        if(!file_exists($this->_path . $object))
            return [];
        
        return json_decode(file_get_contents( $this->_path . $object), true);
    }

    private function assoc_array_to_json_object($object_name, $assoc_array) {

        // get the file extension
        $extension = array_values(array_slice(preg_split('/\./', $object_name), -1))[0];
        
        if($extension != 'json')
            $object_name .= '.json';

        return file_put_contents($this->_path . $object_name, json_encode($assoc_array));
    }

}