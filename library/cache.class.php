<?php
/**
 * Class Hash
 * Simple class to generate Hashes
 * @author staubrein <me@staubrein.com>
 * @version 0.3
 * @todo add more functionality
 */
class Cache
{
    protected $view;
    protected $objects;
    function __construct($view, $objects = array())
    {
        $this->view = $view;
        $this->objects = $objects;
    }
    public function generate($content) {
        return file_put_contents(CACHE_PATH . $this->view, base64_encode($content));
    }
    public function valid() {
        return $this->checkActuality();
    }
    protected function checkActuality() {
        $latest = null;
        foreach ($this->objects as $object) {
            $extension = array_values(array_slice(preg_split('/\./', $object), -1))[0];

            if($extension != 'json')
                $object .= '.json';

            if (file_exists(JSONDB_PATH . $object)) {
                $dtime = filemtime(JSONDB_PATH . $object);
                $latest = $latest == null || $latest < $dtime ? $dtime : $latest;
            }
        }
        if (file_exists(CACHE_PATH . $this->view)) {

            if(filemtime(CACHE_PATH . $this->view) > $latest || $latest == null)
                return true;
        }
        return false;
    }
    public function clear() {
        foreach (glob( CACHE_PATH .'*' ) as $file) {

            unlink($file);
        }
    }
    public function render() {
        if(!$this->checkActuality())
            return false;
        if (file_exists(CACHE_PATH . $this->view)) {
            ob_start();
            require_once CACHE_PATH . $this->view;
            $output = ob_get_contents();
            ob_end_clean();
            echo base64_decode ($output);
            return true;
        }
        return false;
    }
}