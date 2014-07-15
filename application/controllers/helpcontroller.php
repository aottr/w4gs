<?php

class HelpController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->render('help/index');
	}

	function other($arg = false)
	{
		echo 'we are inside other';
		echo "<br>Optional: $arg";
	}

	function crpassword($arg = false)
	{
		echo 'we are inside other';
		echo "<br>Optional: $arg";
	}
}