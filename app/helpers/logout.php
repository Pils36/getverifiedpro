<?php
function logout()
{
//	session_start();
	
	(new AccountIndividual())->updateOnlineStatus($_SESSION['login_id'], 0);
	session_unset();
	session_destroy();
	$message = new Response("success", array(), "successful");
	
	return json_encode($message);
}

