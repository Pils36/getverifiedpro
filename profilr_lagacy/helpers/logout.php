<?php
function logout()
{
	session_start();
	session_unset();
	session_destroy();
	$message = new response("success", array(), "successful");
	return json_encode($message);
}

?>