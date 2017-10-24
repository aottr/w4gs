<?php

/** Configuration Variables **/

define ( 'DEVELOPMENT_ENVIRONMENT', TRUE );

define('BASE_URL', '/_pg11/');

define( 'DB_TYPE', 'mysql' );
define( 'DB_HOST', '' );
define( 'DB_NAME', '' );
define( 'DB_USER', '' );
define( 'DB_PASS', '' );
define( 'DB_PREF', '' );

// The sidewide hashkey, do not change this because its used for passwords!
// This is for other hash keys...
define( 'HASH_GENERAL_KEY', 'h&7nb;3NL');

// This is for database passwords only
define( 'HASH_PASSWORD_KEY', '@82ch%62Hd$');


define( 'ADMIN_LEVEL', 1);
define( 'SUPERVISOR_LEVEL', 2);
define( 'MODERATOR_LEVEL', 3);

date_default_timezone_set ('Europe/Berlin');
