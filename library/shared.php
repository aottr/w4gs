<?php

/** Check if environment is developed and display errors **/
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

	// SessionHandler starten
    Session::init();

    global $url;
    
    // ErrorLogHandler starten
    $errorlog = new Log("application_error");
	
    // wenn '/'am Ende des Strings vorhanden, entferne diese
    $url = rtrim($url, '/');

	// Remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // splitte die URL in Teile, getrennt durch '/'
    $urlArray = array();
    $urlArray = explode('/', $url);
   
	/**
	 *	Aufbau der URL
	 *	/ Controller / Funktion / Parameter1 / Parameter2
	 */
	 
	$controller = $urlArray[0];
	
	// entfernt erstes Element (Controller)
    array_shift($urlArray);

	// wenn das Array nun leer ist, setze action (Funktion) auf index, ansonsten übergebener Wert
    $action = !empty($urlArray) ? $urlArray[0] : 'index';

    // entfernt erstes Element (Funktion)
    array_shift($urlArray);
    $queryString = $urlArray;
    
	$controllerName = $controller;
	// Ersten Buchstaben vergrößern: main -> MainController
    $controller = ucfirst($controller);
    $controller .= 'Controller';
    

	/* Dispatcher ist der ErrorController (norm 404) wenn Controller nicht vorhanden
    if (!class_exists($controller)) {
        $dispatch = new ErrorController(true);
        return false;
    }*/

	// Ansonsten ist Dispatcher neues Objekt des Controllers
    $dispatch = new $controller($controllerName, $action);

    if (method_exists($controller, $action)) {
        // calls the $dispatch->$action method with $queryString as arguments
        call_user_func_array(array($dispatch, $action), $queryString);
    } else {
        //echo Language::$not_found_error['action'];
        $errorlog->write("Action not found.");
        exit;
    }
}

/** Autoload any classes that are required * */
function __autoload($className) {

    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
    
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
        
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
    
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php');
        
    } else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php')) {
    
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php');
        
    } else {
    
        /* Error Generation Code Here */
    }
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();