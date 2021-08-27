<?php
function contactUs($dbh)
{
	$message = new response();
	$msg = $_POST['message'];
	$subject = $_POST['subject'];
	$email = $_POST['email'];
	$name = $_POST['firstname'] . " " . $_POST['lastname'];
	$type = $_POST['type'];
	
	$body = "Contact Us form was submitted by $name ($email)\n\rType: $type\n\rSubject: $subject\n\rMessage: $msg";
	$response = sendEmail("Contact-Us Form Submission", "support@pro-filr.com", "support@pro-filr.com", $body);
	if ($response) {
		$message->status = "success";
		$message->data = array("response" => "Thank you for contacting us. You message will be treated appropriately");
	} else {
		$message->status = "failed";
		$message->data = array("response" => "Something went wrong. Please retry");
	}
	return json_encode($message);
}

?>