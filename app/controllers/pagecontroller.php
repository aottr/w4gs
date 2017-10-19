<?php

class PageController extends Controller
{
	function index()
	{
		$this->set("content", "Status OK");
	}

	function imprint() {

		$storage = new JSONStorage();
		$page_data = $storage->select("page", ["title" => "Imprint"]);

		$this->set("name", $page_data["name"]);
		$this->set("street", $page_data["street"]);
		$this->set("postalcode", $page_data["postalcode"]);
		$this->set("city", $page_data["city"]);
	}
}