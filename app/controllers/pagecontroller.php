<?php

class PageController extends Controller
{
	function index()
	{
		/*$this->view->render(true);
		$this->render = FALSE;*/
		$this->set("content", "Willkommen bei _wags :D");
	}

	function imprint() {

		$this->set("name", "Dustin Kr&ouml;ger");
		$this->set("street", "Heinrichstr.");
		$this->set("streetnumber", "51");
		$this->set("postalcode", "04317");
		$this->set("city", "Leipzig");
	}
}