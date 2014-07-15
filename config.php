<?php

/** Configuration Variables **/

define ( 'DEVELOPMENT_ENVIRONMENT', TRUE );

define('BASE_URL', 'http://localhost/mvc/');

define( 'DB_TYPE', 'mysql' );
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'ems' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_PREF', '' );

// The sidewide hashkey, do not change this because its used for passwords!
// This is for other hash keys...
define('HASH_GENERAL_KEY', 'abcd100');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'abcd100');