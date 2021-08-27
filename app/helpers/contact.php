<?php

require_once '../app/Core/Response.php';

function contactUs()
{
	$myResponse = new Response();
	
	$msg = $_POST['message'];
	$subject = $_POST['subject'];
	$email = $_POST['email'];
	$name = $_POST['firstname'] . " " . $_POST['lastname'];
	$type = $_POST['type'];
	
	$body = "Contact Us form was submitted by $name ($email)\n\rType: $type\n\rSubject: $subject\n\rMessage: $msg";
	$response = sendEmail("Contact-Us Form Submission", "support@pro-filr.com", "support@pro-filr.com", $body);
	if ($response) {
		$myResponse->status = "success";
		$myResponse->message = "Thank you for contacting us. You message will be treated appropriately";
	} else {
		$myResponse->status = "failed";
		$myResponse->message = "Something went wrong. Please retry";
	}
	return json_encode($myResponse);
}

