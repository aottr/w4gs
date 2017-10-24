<?php

/**
 * Class JSONStorage
 * Class to easily store Data in json-files
 * @author staubrein <me@staubrein.com>
 * @todo add update
 * @todo add delete
 */
class JSONStorage {

    protected $_path;

    /**
     * JSONStorage constructor.
     * Creates new instance and sets default path to app/db/
     */
    public function __construct() {
        
       $this->_path = JSONDB_PATH;
    }


    /**
     * Set the Path to the storage directory (should be not accessible from the public)
     * @param string $path to the storage directory
     */
    public function setPath($path) {

        // adds the Directory Separator at the end of the path if not present
        $this->_path = substr($path, -1) == DS ? $path : $path . DS;
    }

    /**
     * select Data from a specific Data Object
     * Results can be filtered by adding attributes
     * Returns one-dimensional assoc array if only one Result is present
     * @example $attributes = ['name' => 'Max', 'age' => '24']; returns all Persons with the name Max and the age 24
     * @param string $object Name of the Data Object
     * @param array $attributes attributes for filtering
     * @return mixed solution
     */
    function select($object, $attributes = array()) {

        $data = $this->json_object_to_assoc_array($object);

        // if no filtering return all data
        if(empty($attributes))
            return $data;

        $solution = array();

        // filter through all entries
        foreach ($data as $entry_key => $entry) {

            $add_entry = false;

            // if all filter match, keep flag to add the entry to solution
            foreach ($attributes as $key => $value) {
                
                if($entry[$key] == $value)
                    $add_entry = true;
                else
                    $add_entry = false;

            }

            // if flag is set add entry to solution
            if($add_entry)
                $solution[$entry_key] = $entry;
        }

        // if only one result is present, generate one-dimensional array
        if(count($solution) == 1)
            $solution = array_values($solution)[0];

        return $solution;
    }

    /**
     * Appends data to a given JSON Object or creates it
     * @param string $object A name of table to insert into
     * @param array $data An associative array
     * @return bool|int FALSE or written Bytes from the JSON file
     */
    public function insert($object, $data) {
        
        if(empty($data))
            return FALSE;

        // get the data from the existing Object (empty array if not existing!)
        $object_array = $this->json_object_to_assoc_array($object);

        // append Data
        array_push($object_array, $data);

        return $this->assoc_array_to_json_object($object, $object_array);
    }


    /**
     * Private function to read json files and export the content into an assoc array
     * @param string $object Name of the JSON Object
     * @return array|mixed assoc array with the data or empty array if the JSON Object didn't exist
     */
    private function json_object_to_assoc_array($object) {

        // get the file extension
        $extension = array_values(array_slice(preg_split('/\./', $object), -1))[0];
        
        if($extension != 'json')
            $object .= '.json';

        if(!file_exists($this->_path . $object))
            return [];
        
        return json_decode(file_get_contents( $this->_path . $object), true);
    }

    /**
     * Private function to write data into json files
     * @param string $object Name of the Object
     * @param array $data expects an assoc array with the data
     * @return bool|int FALSE or written Bytes from the JSON file
     */
    private function assoc_array_to_json_object($object, $data) {

        // get the file extension
        $extension = array_values(array_slice(preg_split('/\./', $object), -1))[0];
        
        if($extension != 'json')
            $object .= '.json';

        return file_put_contents($this->_path . $object, json_encode($data));
    }

}
