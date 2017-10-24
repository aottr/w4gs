<?php

class IndexController extends Controller
{
	function index()
	{
		$this->set("doctitle", "Welcome");
		$this->set("content", "Status OK");
	}

	function github() {

		require_once ROOT . DS . 'utilities' . DS . 'GithubAPI.php';

		$client = new GithubAPI('staubrein');
		// save the assoc array
		$this->set("repositories", $client->getRepositories());

	}
}