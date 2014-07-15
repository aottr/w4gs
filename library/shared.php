<?php

/** Check if environment is developed and display errors * */
function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'apache_error.log');
    }
}

/** Check for Magic Quotes and remove them * */
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes() {
    if (get_magic_quotes_gpc()) {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them * */
function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');

        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function * */
function callHook() {
    Session::init();

    global $url;
    
    $errorlog = new Log("application_error");
	
    $url = rtrim($url, '/');

    $urlArray = array();

    $url = filter_var($url, FILTER_SANITIZE_URL);

    $urlArray = explode("/", $url);
   
	
	$controller = $urlArray[0];

    array_shift($urlArray);

    $action = !empty($urlArray) ? $urlArray[0] : 'index';

    array_shift($urlArray);
    $queryString = $urlArray;

    $controllerName = $controller;
    $controller = ucwords($controller);

    $controller .= 'Controller';

    if (!class_exists($controller)) {
        $dispatch = new ErrorController(true);
        return false;
    }

    $dispatch = new $controller();

    if (method_exists($controller, $action)) {
        // calls the $dispatch->$action method with $queryString as arguments
        call_user_func_array(array($dispatch, $action), $queryString);
    } else {
        echo Language::$not_found_error['action'];
        $errorlog->write("Action not found.");
        exit;
    }
}

/** Autoload any classes that are required * */
function __autoload($className) {

    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();