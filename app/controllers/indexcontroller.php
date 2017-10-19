<?php

class IndexController extends Controller
{
	function index()
	{
		$this->set("doctitle", "Welcome");
		$this->set("content", "Status OK");
	}
}