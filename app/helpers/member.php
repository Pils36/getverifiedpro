<?php
// require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
function sendMessage()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
	if (empty($_POST["member_id"])) {
		$myResponse->status = "failed";
		$myResponse->message = "Your message cannot be sent at this time. Please retry.";
		return json_encode($myResponse);
	}
	if (empty($_POST['subject']) || empty($_POST['message'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Some fields are missing.";
		return json_encode($myResponse);
	}
	try {
		$stmt = $dbh->prepare("INSERT INTO tbl_message(sent_by,sent_to,`subject`,`content`) VALUES (:by,:to,:sub,:cont)");
		$stmt->execute(array(
			":by" => $_SESSION['login_id'],
			":to" => $_POST['member_id'],
			":sub" => $_POST['subject'],
			":cont" => $_POST['message']
		));
		sendMail($_POST['subject'], $_POST['member_id']);
		$myResponse->status = "success";
		$myResponse->message = "Message sent successfully";
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "An error has occured.";
		return json_encode($myResponse);
	}
	
	
}

function getValidationItems()
{
	
	$myResponse = new Response();
	$a = new AccountIndividual();
	if (empty($_POST["member_id"])) {
		$myResponse->status = "failed";
		$myResponse->message = "Validation cannot be done this time. Please retry.";
		return json_encode($myResponse);
	}
	if (empty($_POST['table'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Some fields are missing.";
		return json_encode($myResponse);
	}
	try {
		$items = $a->getValidationItems($_POST['table'], $_POST['member_id']);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $items;
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "An error has occurred.";
		return json_encode($myResponse);
	}
}

function doValidate()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
	if (empty($_POST["member_id"])) {
		$myResponse->status = "failed";
		$myResponse->message = "Validation cannot be done this time. Please retry.";
		return json_encode($myResponse);
	}
	if (empty($_POST['detail']) || empty($_POST['comment'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Some fields are missing.";
		return json_encode($myResponse);
	}
	try {
		$stmt = $dbh->prepare("INSERT INTO tbl_validation(member_id,validated_by,validate_type,detail_validated,validate_url,`comment`) VALUES (:mem_id,:by,:validate_type,:detail,:validate_url, :comm)");
		$stmt->execute(array(
			":mem_id" => $_POST['member_id'],
			":by" => $_SESSION['login_id'],
			":validate_type" => $_POST['validate_type'],
			":detail" => $_POST['detail'],
			":validate_url" => $_POST['validate_url'],
			":comm" => $_POST['comment']
		));
		$myResponse->status = "success";
		$myResponse->message = "Validation done successfully";
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "An error has occured.";
		return json_encode($myResponse);
	}
}

function sendMail($subject, $to)
{
	$dbh = Database::getInstance();
	
	//fetch login details
	$user = $dbh->query("select firstname, lastname from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);
	$sender = ucwords(strtolower($user['firstname'] . " " . $user['lastname']));
	
	$user = $dbh->query("select email from tbl_account_individual where login_id = {$to}")->fetch(PDO::FETCH_ASSOC);
	$to = $user['email'];
	
	
	
	$mail = new PHPMailer;
	$mail->isSMTP();
	
	$mail->Host = 'pro-filr.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = 'subscription@pro-filr.com';
	
	$mail->Password = 'portFOLIO_2015';
	
	$mail->Port = 465;
	
	try {
		$mail->setFrom('subscription@pro-filr.com', 'subscription@pro-filr.com');
		$mail->addAddress($to);
	$mail->isHTML(true);
	
	$mail->Subject = "A message was sent to you by $sender on Pro-Filr";
	$mail->Body = "<h4>Message Subject: $subject </h4>Please click <a href='https://pro-filr.com/posts.php' target='_blank'>here</a> to read the message.";
	$mail->AltBody = "Message Subject: $subject.\n\r Please sign in to your account to read the message.";
	try {
		if (!$mail->send()) {
			$mail->smtpClose();
			return "0";
			
		} else {
			$mail->smtpClose();
			return "1";
			
			
		}
	} catch (phpmailerException $e) {
		return "0";
		
	}
	
	}
	catch (phpmailerException $e) {
	}
	
}

function searchMember()
{
	$a = new AccountIndividual();
	$myResponse = new Response();
	try {
		$members = $a->searchIndividualAccount($_POST['keyword']);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $members;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function fetchMembers()
{
	$a = new AccountIndividual();
	$myResponse = new Response();
	try {
		$members = $a->getAllAccounts();
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $members;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function fetchAllAccountsConnected()
{
	$a = new Connection();
	$myResponse = new Response();
	$member = $_SESSION['login_id'];
	
	try {
		$members = $a->getMyConnections($member);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $members;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

