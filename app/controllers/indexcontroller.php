<?php

class IndexController extends Controller
{
	function index()
	{
		/*$this->view->render(true);
		$this->render = FALSE;*/
		$this->set("content", "Willkommen bei _wags :D");
	}
}