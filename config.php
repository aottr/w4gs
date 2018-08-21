<?php

/** Configuration Variables **/

define ( 'DEVELOPMENT_ENVIRONMENT', TRUE );

define('BASE_URL', '');
define('CACHE_PATH', ROOT . DS . 'tmp' . DS . 'cache' . DS);
define('JSONDB_PATH', ROOT . DS . 'app' . DS . 'db' . DS);

define( 'DB_TYPE', 'mysql' );
define( 'DB_HOST', '' );
define( 'DB_NAME', '' );
define( 'DB_USER', '' );
define( 'DB_PASS', '' );
define( 'DB_PREF', '' );

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

date_default_timezone_set ('Europe/Berlin');
