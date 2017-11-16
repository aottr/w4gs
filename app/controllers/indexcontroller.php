<?php

class IndexController extends Controller
{
	function index()
	{
		$this->set("doctitle", "Welcome");
		$this->set("content", "Status OK");
	}

	function clearcache() {

		foreach (glob( CACHE_PATH .'*' ) as $file) {
		    
		    unlink($file);
		}
	}
}