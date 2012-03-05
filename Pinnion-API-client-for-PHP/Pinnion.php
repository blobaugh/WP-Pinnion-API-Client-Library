<?php

define( 'PINNION_API_USER', 'asdf' );
define( 'PINNION_API_PASS', 'asdf' );
define( 'PINNION_API_URL', 'http://dev.pinnion.com' );




// API Endpoints
define('PINNION_ENDPOINT_PINNION', '/ws/v1/pinnion');
define('PINNION_ENDPOINT_CHANNEL', '/ws/v1/channel');
define('PINNION_ENDPOINT_AUTH', '/ws/v1/auth');

// Setup includes - this should be an autoloader soon
require_once('PinnionExceptions.class.php');
require_once('PinnionApiResponse.class.php');
require_once('PinnionApiRequest.class.php');

require_once('PinnionPinnions.class.php');