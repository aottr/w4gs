<?php

/**
 * Class JSONStorage
 * Class to easily store Data in json-files
 * @author staubrein <me@staubrein.com>
 * @todo add update
 * @todo add delete
 */
class JSONStorage {

    protected $path;

    /**
     * JSONStorage constructor.
     * Creates new instance and sets default path to app/db/
     */
    public function __construct() {
        
       $this->path = JSONDB_PATH;
    }


    /**
     * Set the Path to the storage directory (should be not accessible from the public)
     * @param string $path to the storage directory
     */
    public function setPath($path) {

        // adds the Directory Separator at the end of the path if not present
        $this->path = substr($path, -1) == DS ? $path : $path . DS;
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
     * Uptates data to a given JSON Object. Filter via attributes.
     * Error Codes:
     *              64: Key not found
     *              62: No Object found with given filter attributes
     * @param string $object Name of the JSON Object
     * @param array $attributes attributes for filtering
     * @param mixed $key key of the value to update (first level in Entry)
     * @param mixed $value value to insert
     * @return boolean true if success, false if failure 
     */ 
    public function update($object, $attributes, $key, $value) {

        $data = $this->select($object, $attributes);

        if (count($data) > 0) {

            $edited = false;
            foreach ($data as $entry_key => $entry) {

                foreach ($entry as $okey) {
                    
                    if($key === $okey) {
                        $data[$entry_key][$key] = $value;
                        $edited = true;
                    }
                }
            }
            if($edited) {

                $this->assoc_array_to_json_object($object, $data);
                return true;
            }
            exit(64); // Key not found
        }
        exit(62); // no object found
        return false;
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

        if(!file_exists($this->path . $object))
            return [];
        
        return json_decode(file_get_contents( $this->path . $object), true);
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

        return file_put_contents($this->path . $object, json_encode($data));
    }

}
