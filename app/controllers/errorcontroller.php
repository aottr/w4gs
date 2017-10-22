<?php

/**
 * Class ErrorController
 * MVC Controller to display common Errorpages
 * @author staubrein <me@staubrein.com>
 * @todo Add more Error pages/separate function for E404
 */
class ErrorController extends Controller {

    /**
     * ErrorController constructor.
     * Generates a Error 404 Page
     * @param bool $real Flag to ensure an internal run of the controller
     */
    function __construct($real = false) {
        if (!$real)
            header('Location: ' . BASE_URL . 'index');

        $this->_view->title = 'Error 404!';
        $this->_view->msg = 'This page does not exist.';
        $this->_view->render('error/index');
    }

}