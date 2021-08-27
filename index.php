<?php


@session_start();

// echo md5('123');

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT) {
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
		ini_set('max_execution_time', 0);
		break;
	
	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		} else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;
	
	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}


// Check the Config file...

require_once('config/config.php');




if (COMPOSER_AUTOLOAD === TRUE) {
    
    
	file_exists(ROOT . '/vendor/autoload.php')
		? require_once(ROOT . '/vendor/autoload.php')
		: exit('Composer Autoload is set to TRUE but vendor/autoload.php was not found.');
}
require_once 'app/spl_autoload.php';

require 'app/Common.php';

require 'app/Core/Router.php';

/*
 * ------------------------------------------------------
 * Security procedures
 * ------------------------------------------------------
 */

if (!is_php('5.4')) {
	ini_set('magic_quotes_runtime', 0);
	
	if ((bool)ini_get('register_globals')) {
		$_protected = array(
			'_SERVER',
			'_GET',
			'_POST',
			'_FILES',
			'_REQUEST',
			'_SESSION',
			'_ENV',
			'_COOKIE',
			'GLOBALS',
			'HTTP_RAW_POST_DATA',
			'system_path',
			'application_folder',
			'view_folder',
			'_protected',
			'_registered'
		);
		
		$_registered = ini_get('variables_order');
		foreach (array('E' => '_ENV', 'G' => '_GET', 'P' => '_POST', 'C' => '_COOKIE', 'S' => '_SERVER') as $key => $superglobal) {
			if (strpos($_registered, $key) === FALSE) {
				continue;
			}
			
			foreach (array_keys($$superglobal) as $var) {
				if (isset($GLOBALS[$var]) && !in_array($var, $_protected, TRUE)) {
					$GLOBALS[$var] = NULL;
				}
			}
		}
	}
}




$route = new Router();


$page = $route->get_route();


$page = $page ? $page : 'home';

if ($page === 'home') {
	if (!empty($_SESSION['token'])) {
		$page = 'landing';
	} else {
		$page = 'home';
	}
}elseif ($page === 'admin')
{
	if (!empty($_SESSION['admin_login'])) {
		$page = 'dashboard';
	} else {
		$page = 'admin';
	}
}


if (!strstr($page, '.php')) {
	$page = $page . '.php';
}

if (file_exists(VIEWS . $page)) {
	require_once VIEWS . $page;
} else {
	set_status_header('404', 'not here');
	echo 'Not here, 404 '.VIEWS . $page;
}
exit;