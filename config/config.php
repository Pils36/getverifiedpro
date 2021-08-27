<?php


define('DB_HOSTNAME', 'localhost');

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'profilr_beta');

// define('DB_USERNAME', 'jscgloba_profilr_user');
// define('DB_PASSWORD', 'portFOLIO_2015');
// define('DB_NAME', 'jscgloba_profilr_beta');


define('DB_PORT', 3306);
define('APP_DOMAIN', 'https://getverifiedpro.com/');
// define('ROOT',  '/home/profilr/');
// define('ROOT',  '/home/vimfilec/getverifiedpro.com/');
define('ROOT',  $_SERVER['DOCUMENT_ROOT']);

//define('DB_HOSTNAME', 'localhost');
//define('DB_USERNAME', 'funsho');
//define('DB_PASSWORD', 'Laniyi55');
//define('DB_NAME', 'profilr');
//define('DB_PORT', 3306);
//define('APP_DOMAIN', 'http://localhost:8888/');
//define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/../');

// define('DOCUMENT_ROOT', ROOT . '/public_html/');


define('DOCUMENT_ROOT', ROOT);
define('COMPOSER_AUTOLOAD', TRUE);
define('VIEWS', DOCUMENT_ROOT.'/views/');

define('LINKEDIN_CLIENT_ID', '77g9qzxthk6iob');
define('LINKEDIN_CLIENT_SECRET', 'XucYpXzrUB0dBqfm');
define('LINKEDIN_REDIRECT_URL', APP_DOMAIN . 'controller/app.php');

define('GOOGLE_CLIENT_ID', '89097082331-ndueuj81dat4goc09dqqo3oonvg1eg59.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'fn9BO3X8zGTRSxy0LE_l0aio');
define('GOOGLE_REDIRECT_URL',  APP_DOMAIN . 'controller/app.php');


define('SECRET_KEY', 'Jimoh2016');
define('ALGORITHM', 'HS512');

ini_set('max_execution_time', 0);

