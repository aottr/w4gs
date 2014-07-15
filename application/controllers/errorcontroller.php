<?php

class ErrorController extends Controller {

    function __construct($real = false) {
        if (!$real)
            header('Location: ' . BASE_URL . 'index');

        parent::__construct();

        $this->view->title = 'Fehler!';
        $this->view->msg = 'This page does not exist.';
        $this->view->render('error/index');
    }

}