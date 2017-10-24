<?php

/**
 * Class Hash
 * Simple class to generate Hashes
 * @author staubrein <me@staubrein.com>
 * @version 0.2
 * @todo add more functionality
 */
class Cache
{
	private $_view;
	private $_objects;

	function __construct($view, $objects)
	{
		$this->_view = $view;
		$this->_objects = $objects;
	}

	public function generate($content) {

		return file_put_contents(CACHE_PATH . $this->_view, $content);
	}

	private function checkActuality() {

		$latest = null;

		foreach ($this->_objects as $object) {

			$extension = array_values(array_slice(preg_split('/\./', $object), -1))[0];
        
        	if($extension != 'json')
           		$object .= '.json';
			
			if (file_exists(JSONDB_PATH . $object)) {

				$dtime = filemtime(JSONDB_PATH . $object);
		   		$latest = $latest == null || $latest < $dtime ? $dtime : $latest;
			}
		}

		if (file_exists(CACHE_PATH . $this->_view)) {
		    
		    if(filemtime(CACHE_PATH . $this->_view) > $latest)
		    	return true;
		}

		return false;
	}

	public function render() {

		if(!checkActuality())
			return false;

		if (file_exists(CACHE_PATH . $this->_view)) {
			ob_start();
			require_once CACHE_PATH . $this->_view;
			$output = ob_get_contents();

			ob_end_clean();
			echo $output;

			return true;
		}
		return false;
	}
}
