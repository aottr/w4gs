<?php

class AccountController extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new AccountModel();
	}

	function index()
	{
		$this->view->render('account/index');
	}
    
    function dashboard()
    {
        @Session::init();
        if(!Session::get('loggedin')) {
            
            session_destroy();
            header('Location: ' . BASE_URL . 'account/login');
            exit;
        }
        $this->model->dashboard(Session::get('userid'));
        $this->view->name = $this->model->name;
        $this->view->id = Session::get('userid');
        $this->view->events = $this->model->events;
        $this->view->render('account/dashboard');
    }
    
    function register($step = 'index')
    {
        switch($step)
        {
            case 'index':
                $this->view->js = array('forms.js');
                $this->view->render('account/register');
                break;
            case 'do':
            try {
    $form = new Form();

    $form   ->post('name')
            ->val('minlength', 3)
        
            ->post('age')
            ->val('minlength', 2)
            ->val('digit')
        
            ->post('gender');
    
            $form   ->submit();

    print_r($form);
}
 catch (Exception $e)
 {
    echo $e->getMessage();
 }
                break;
        }
    }
    
    function login($step = 'index')
    {
        switch($step)
        {
            case 'index':
                $this->view->js = array('forms.js');
                $this->view->render('account/login');
                break;
            case 'do':
                
                if($this->model->login())
			        header('location: ' . BASE_URL . 'account/dashboard');
                else
                    header('location: ' . BASE_URL . 'account/login');
                break;
        }
    }
    
    function logout()
    {
        Session::destroy();
        header('location: ' . BASE_URL);
    }
    
    function paymentinfo($id)
    {
        
    }
}