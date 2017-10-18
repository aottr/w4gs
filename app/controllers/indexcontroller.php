<?php

class IndexController extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new IndexModel();
	}

	function index()
	{
		$this->view->render('index/index', false);
	}

	function other($name = FALSE, $page = FALSE)
	{
            echo 'we are inside other';
            echo "<br>Name: $name";
            if($page)
                echo "<br>Page: $page";
	}
        
        function xd($p1 = FALSE,$p2 = FALSE,$p3 = FALSE,$p4 = FALSE,$p5 = FALSE )
        {
            echo "im indexcontroller->xd"  . "\n";
            
            if($p1)
                echo $p1 . "\n";
            if($p2)
                echo $p2 . "\n";
            if($p3)
                echo $p3 . "\n";
            if($p4)
                echo $p4 . "\n";
            if($p5)
                echo $p5 . "\n";
            
        }
}