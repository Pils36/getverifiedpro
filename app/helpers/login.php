<?php

use Firebase\JWT\JWT;

require_once '../app/Core/Database.php';
require_once '../app/Core/Response.php';
require_once '../app/Models/AccountIndividual.php';

function getLogin()
{

	
	$dbh = Database::getInstance();
	$myResponse = new Response();
	
	$stmt = $dbh->prepare("SELECT * FROM tbl_login WHERE email=:email AND password=:pwd");
	$stmt->execute(array(
		":email" => $_POST['email'],
		":pwd" => md5($_POST['password'])
	));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	//return json_encode(array("count"=>$stmt->rowCount()));
	
	
	if ($stmt->rowCount() < 1) {
		$myResponse->status = "failed";
		$myResponse->message = "Invalid Login";
		return json_encode($myResponse);
	} else {
		$token = getToken($rows["login_id"]);
		
		$myResponse->status = "success";
		$myResponse->message = "Login Successful";
		//populate SESSION
		$_SESSION['token'] = $token;
//		$_SESSION['login_id'] = $rows["login_id"];
		// $_education = fetchEducation();
		// $_profile = fetchProfile();
		// $_certification = fetchCertification();
		// $_experience = fetchExperience();
		// $_affiliation = fetchAffiliation();
		$data = array(
			"token" => $token,
			// "education" => $_education,
			// "profile" => $_profile,
			// "certification" => $_certification,
			// "experience" => $_experience,
			// "affiliation" => $_affiliation
		);
		$myResponse->data = $data;
		
		(new AccountIndividual())->updateOnlineStatus($rows["login_id"], 1);
		return json_encode($myResponse);
	}
}

function getToken($user)
{
//	require_once('../../vendor/firebase/php-jwt/src/JWT.php');
//
	//valid login
	$tokenId = base64_encode(32);
	$issuedAt = time();
	$notBefore = $issuedAt + 10;  //Adding 10 seconds
	$expire = $notBefore + 7200; // Adding 60 seconds
	$serverName = 'http://getverifiedpro.com/'; /// set your domain name
	
	
	/*
	 * Create the token as an array
	 */
	$data = array(
		'iat' => $issuedAt,         // Issued at: time when the token was generated
		'jti' => $tokenId,          // Json Token Id: an unique identifier for the token
		'iss' => $serverName,       // Issuer
		'nbf' => $notBefore,        // Not before
		'exp' => $expire,           // Expire
		'data' => array(                 // Data related to the logged user you can set your required data
			'id' => $user, // id from the users table
			//'name' => $row[0]['name'], //  name
		)
	);
	$secretKey = base64_decode(SECRET_KEY);
	// Here we will transform this array into JWT:
	$jwt = JWT::encode(
		$data, //Data to be encoded in the JWT
		$secretKey, // The signing key
		ALGORITHM
	);
	
	return $jwt;
	
}


function isLoggedIn()
{
	$myResponse = new Response();
	if (!empty($_SESSION['login_id'])) {
		$myResponse->status = "success";
		$myResponse->message = "1";
		$subStat = getSubscription();
		if ($subStat['active'] == 1) {
			$myResponse->data = array("subscription" => "active");
		} else {
			$myResponse->data = array("subscription" => "inactive");
		}
	} else {
		$myResponse->status = "failed";
		$myResponse->message = "0";
	}
	return json_encode($myResponse);
}
