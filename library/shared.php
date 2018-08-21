<?php

/** Check if environment is developed and display errors **/
function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        return;
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'apache_error.log');
}

/** Check for Magic Quotes and remove them * */
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
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

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

/** Main Call Function * */
function callHook() {

    // SessionHandler starten
    sec_session_start();

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
        exit(44);
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