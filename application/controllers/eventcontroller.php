<?php

class EventController extends Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->model = new EventModel();
	}

	function index()
	{
        $this->model->listall();
        $this->view->events = $this->model->eventlist;
		$this->view->render('event/index');
	}
    
    function show($id)
    {
        $this->model->load($id);
        $this->view->id = $id;
        $this->view->name = $this->model->name;
        $this->view->description = $this->model->description;
        $this->view->render('event/show');
    }
    
    function order($id, $step = 'index', $orderid = FALSE)
    {
        if(!Session::get('userid')) {
            header('Location: ' . BASE_URL . 'account/login');
            exit;
        }
        
        $this->model->load($id);
        switch($step)
        {
            case 'index':
                $this->model->orders($id);
                $this->view->orders = $this->model->orderdata;
                $this->view->render('event/order');
                break;
            case 'select':
                if(!$orderid) {
                    header('Location: ' . BASE_URL . 'event/order/' . $id . '/');
                    exit;
                }
                $this->model->order($id, Session::get('userid'), $orderid);
                
                header('Location: ' . BASE_URL . 'event/order/' . $id . '/billing/');
                exit;
                break;
            case 'billing':
                echo "ya";
                break;
        }
    }
}