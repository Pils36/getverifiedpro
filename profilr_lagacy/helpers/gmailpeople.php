<?php
//error_reporting(E_ALL);
require_once "google-api-php-client/vendor/autoload.php";
session_start();

// $data = $_POST['json'];
// $_GET = json_decode($data,true);
$client = new Google_Client();

// OAuth 2.0 settings
//
// Go to the Google API Console, open your application's
// credentials page, and copy the client ID, client secret,
// redirect URI, and API key. Then paste them into the
// following code.
$client->setClientId('89097082331-ndueuj81dat4goc09dqqo3oonvg1eg59.apps.googleusercontent.com');
$client->setClientSecret('fn9BO3X8zGTRSxy0LE_l0aio');
$client->setRedirectUri('https://pro-filr.com/helpers/gmailpeople.php');

$client->addScope('profile');
$client->addScope('https://www.googleapis.com/auth/contacts.readonly');

// if (isset($_GET['oauth'])) {
// 	  // Start auth flow by redirecting to Google's auth server
// 	  $auth_url = $client->createAuthUrl();
// 	  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
// }else if (isset($_GET['code'])){
// 	  // Receive auth code from Google, exchange it for an access token, and
// 	  // redirect to your base URL
// 	  $client->authenticate($_GET['code']);
// 	  $_SESSION['access_token'] = $client->getAccessToken();
// 	  unset($_SESSION['connections']);
// 	  if(isset($_SESSION['access_token']) && $_SESSION['access_token']){
// 	  		$client->setAccessToken($_SESSION['access_token']);
// 	  		$people_service = new Google_Service_PeopleService($client);
// 	  		$connections = $people_service->people_connections->listPeopleConnections('people/me', array('personFields' => 'names,emailAddresses','pageSize' => "2000"));
// 	  }
// 	  $_SESSION['connections'] = $connections;
// 	  echo json_encode($_SESSION['connections']);


// }


if (isset($_GET['oauth'])) {
	$auth_url = $client->createAuthUrl();
	header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	//exit;
} elseif (isset($_GET['code'])) {
	$client->authenticate($_GET['code']);
	
	unset($_SESSION['access_token']);
	unset($_SESSION['connections']);
	$_SESSION['fromGmail'] = "0";
	$_SESSION['access_token'] = $client->getAccessToken();
	//var_dump($_SESSION['access_token']);
	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$client->setAccessToken($_SESSION['access_token']);
		$people_service = new Google_Service_PeopleService($client);
		$connections = $people_service->people_connections->listPeopleConnections('people/me', array('personFields' => 'names,emailAddresses', 'pageSize' => "2000"));
		//var_dump($connections);
		
		//$_SESSION['connections'] = $connections;
		//$cookie_name = "connections";
		//$cookie_value = json_encode($connections);
		//setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		$emails = $connections['connections'][0]['emailAddresses'];
		$_SESSION['connections'] = $emails;
		$_SESSION['fromGmail'] = "1";
		
	}
	//echo json_encode($_SESSION['connections']);
	$invite_url = "https://pro-filr.com/pages/invites.php";
	header('Location: ' . filter_var($invite_url, FILTER_SANITIZE_URL));
	
}


//   $redirect_uri = 'https://pro-filr.com/helpers/gmailpeople.php';
//   header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
// } else if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
//   // You have an access token; use it to call the People API
//   $client->setAccessToken($_SESSION['access_token']);
//   $people_service = new Google_Service_People($client);
//   // TODO: Use service object to request People data
// } else {
//   $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/?oauth';
//   header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

// }


// function csvSend($dbh){


?>