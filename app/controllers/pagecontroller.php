<?php

/**
 * Class PageController
 * Controller to generate 'static' pages.
 * @author staubrein <me@staubrein.com>
 */
class PageController extends Controller
{
    /**
     *  Index Page for route: /page/
     * @todo Maybe Table od Contents?
     */
    function index()
	{
		$this->set("content", "Status OK");
	}

    function github() {

        $this->cache = TRUE;
        $this->_cache = new Cache($this->_controller . '_' . $this->_action); 

        if(!$this->_cache->valid()) {

            require_once ROOT . DS . 'utilities' . DS . 'GithubAPI.php';

            $client = new GithubAPI('staubrein');
            // save the assoc array
            $this->set("repositories", $client->getRepositories());
            $this->set("avatar_url", $client->getAvatar());
        }
    }

    /**
     *  Generates an Imprint Page
     *  uses address data stored in a json db
     */
    function imprint() {

    	$this->cache = TRUE;
    	$this->_cache = new Cache($this->_controller . '_' . $this->_action, ['page']); 	 

		$storage = new JSONStorage();
		$page_data = $storage->select("page", ["title" => "Imprint"]);

		$this->set("name", $page_data["name"]);
		$this->set("street", $page_data["street"]);
		$this->set("postalcode", $page_data["postalcode"]);
		$this->set("city", $page_data["city"]);
	}
}