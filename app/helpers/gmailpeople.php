<?php


require_once '../views/google-api-php-client/src/Google/Client.php';
require_once '../app/Core/Response.php';


function getGmailAuthUrl()
{

}

function getGmailConnections()
{
	
	$client = new Google_Client();
	$myResponse = new Response();
	
	$client->setClientId(GOOGLE_CLIENT_ID);
	$client->setClientSecret(GOOGLE_CLIENT_SECRET);
	$client->setRedirectUri(GOOGLE_REDIRECT_URL);
	
	$client->addScope('profile');
	$client->addScope('https://www.googleapis.com/auth/contacts.readonly');
	
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
			
			$emails = $connections['connections'][0]['emailAddresses'];
			$_SESSION['connections'] = $emails;
			$_SESSION['fromGmail'] = "1";
			
		}
		$invite_url = "https://getverifiedpro.com/views/invites.php";
		header('Location: ' . filter_var($invite_url, FILTER_SANITIZE_URL));
		
	}
}