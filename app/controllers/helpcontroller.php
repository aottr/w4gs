<?php

class HelpController extends Controller
{

	function index()
	{
		$this->_view->render('help/index');
	}
}