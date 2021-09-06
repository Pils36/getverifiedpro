<?php


session_start();


/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
 
 
require_once '../config/config.php';
error_reporting(E_ERROR);





/*
 * ------------------------------------------------------
 *  Should we use a Composer autoloader?
 * ------------------------------------------------------
 */

if (COMPOSER_AUTOLOAD === TRUE) {
	file_exists(ROOT . '/vendor/autoload.php')
		? require_once(ROOT . '/vendor/autoload.php') 
		: exit('Composer Autoload is set to TRUE but vendor/autoload.php was not found.');
}



require_once '../app/spl_autoload.php';
require_once '../app/Common.php';
require_once '../app/Core/Security.php';




header("Content-type:application/json");

require_once("../app/helpers/linkedin_oauth.php");

require_once("../app/helpers/signUp.php");



require_once("../app/helpers/mailer.php");
require_once("../app/helpers/logout.php");


require_once("../app/helpers/profile.php");
require_once("../app/helpers/upload.php");
require_once("../app/helpers/landing.php");


require_once("../app/helpers/posts.php");
require_once("../app/helpers/member.php");
require_once("../app/helpers/opportunity.php");
require_once("../app/helpers/contact.php");

// require_once("../app/helpers/search.php");



require_once("../app/helpers/searches.php");

require_once("../app/helpers/messages.php");


require_once("../app/helpers/invites.php");

require_once("../app/helpers/admin.php");

require_once("../app/helpers/blog.php");

require_once("../app/helpers/login.php");



require_once("../app/helpers/groups.php");
require_once("../app/helpers/projects.php");


require_once("../app/helpers/connect.php");
require_once("../app/helpers/download.php");
require_once("../app/helpers/reports.php");
require_once("../app/helpers/emails.php");
require_once("../app/helpers/notification.php");


//
$s = new Security();




if (!empty($_POST)) {
	
	if (!isset($_POST["function"])) {
		$data = $_POST['json'];
		$_POST = json_decode($data, true);
	}
	if (is_callable($_POST['function'])) {
		$_POST = $s->xss_clean($_POST);

	// print_r($_POST);
// 	exit;
// 	echo "jijojk";
// 	exit;
		echo $_POST['function']();
	}
	
// 	var_dump($_POST);
	
} elseif (!empty($_GET)) {
	$_GET = $s->xss_clean($_GET);
	if (!empty($_GET['code'])) {
	    echo 1;
exit;
		$response = linkedinAuth();
		$response = json_decode($response);
		
		if(!empty($_SESSION['import_mode'])){
			$_SESSION['oauth_error'] = $response->message;
			header('location: ../profile');
		}else{
			
			if ($response->status !== 'success') {
				$_SESSION['oauth_error'] = $response->message;
				header('location: ../account');
			} else {
				header('location: ../home');
			}
		}
	}elseif (isset($_GET['oauth'])) {
		$response = getGmailConnections();
		$response = json_decode($response);
		
	}elseif (!empty($_GET['data_id'])){
		downloadMessage();
	}
	
	
	
}elseif (!empty($_FILES['attachment'])){
	// chat file attachment
	echo uploadFileAttachment();
}

