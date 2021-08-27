<?php
// require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
function sentInvites($dbh)
{
	$myResponse = new response();
	try {
		$rows = $dbh->query("select id,date_sent,sent_to from tbl_invites where login_id = {$_SESSION['login_id']} order by date_sent desc")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Sent invites received successfully";
		$myResponse->data = $rows;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Sent invites cannot be retrived at this time. Please Retry";
	}
	return json_encode($myResponse);
}

function sendManual($dbh)
{
	// var_dump($_POST);
	$mail = new PHPMailer;
	$myResponse = new response();
	$body = file_get_contents('templates/Invitation/Invitation.html');
	try {
		//get login name
		$member = $dbh->query("select concat(firstname,' ',lastname) as `name` from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);
		$_name = $member['name'];
		$mail->isSMTP();
		
		$mail->Host = 'pro-filr.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
		$mail->Port = 465;
		$mail->Username = 'subscription@pro-filr.com';
		$mail->Password = 'portFOLIO_2015';
		$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');
		// $mail->addReplyTo('subscription@pro-filr.com', 'Pro-Filr.com');
		$mail->Subject = "You have received an invite from " . $_name;
		$mail->msgHTML($body);
		//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		
		$emails = rtrim($_POST['emails'], ",");
		
		$emails = explode(",", $emails);
		$count = 0;
		
		foreach ($emails as $key => $email) {
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$mail->clearAllRecipients();
				$mail->addAddress($email);
				if (!$mail->send()) {
					// echo $mail->ErrorInfo;
					echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';
					break; //Abandon sending
				} else {
					//echo "Message sent to :" . $row['full_name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';
					//insert into tbl_inivites
					// echo "insert into tbl_invites(login_id,sent_to) values (:id,:to)";
					$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to) VALUES (:id,:to)");
					$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $email));
					$count = $count + 1;
					
				}
			}
		}
		if ($count < 1) {
			$myResponse->status = "failed";
			$myResponse->message = "Invites cannot be sent at this time. Please Retry";
		} else {
			$myResponse->status = "success";
			$myResponse->message = "Invites sent successfully";
		}
		
		$myResponse->data = $rows;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Invites cannot be sent at this time. Please Retry";
	}
	return json_encode($myResponse);
}

function sendCSV($dbh)
{
	$myResponse = new response();
	try {
		$filename = $_FILES["file"]["tmp_name"];
		$tem = file_get_contents($filename);
		$tem = preg_replace('~\R~u', "\n", $tem);
		file_put_contents($filename, $tem);
		if (isset($_FILES["file"]["type"])) {
			$validextensions = array("csv");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			
			if ($_FILES["file"]["type"] == "text/csv" && $_FILES["file"]["size"] < 10000000 && in_array($file_extension, $validextensions)) { //valid file proceed
				$file = fopen($filename, "r");
				$mail = new PHPMailer;
				$body = file_get_contents('templates/Invitation/Invitation.html');
				$member = $dbh->query("select concat(firstname,' ',lastname) as `name` from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);
				$_name = $member['name'];
				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				//$mail->SMTPDebug = 2;
				$mail->isSMTP();
				
				$mail->Host = 'pro-filr.com';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
				$mail->Port = 465;
				$mail->Username = 'subscription@pro-filr.com';
				$mail->Password = 'portFOLIO_2015';
				$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');
				//$mail->addReplyTo('subscription@pro-filr.com', 'Pro-Filr.com');
				$mail->Subject = "You have received an invite from " . $_name;
				$mail->msgHTML($body);
				//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
				$count = 0;
				while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
					//echo $getData[0];
					$mail->clearAllRecipients();
					$mail->addAddress($getData[0]);
					if (!$mail->send()) {
						//echo $mail->ErrorInfo;
						// echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';
						break; //Abandon sending
					} else {
						
						$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to) VALUES (:id,:to)");
						$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $getData[0]));
						$count = $count + 1;
					}
					
				}
				
				fclose($file);
				if (!$count) {
					$myResponse->status = "failed";
					$myResponse->message = "Invites cannot be sent at this time. Please Retry";
				} else {
					$myResponse->status = "success";
					$myResponse->message = "File imported and invites sent successfully";
				}
				
				//$myResponse->data = $rows;
				
			} else { //invalid file format
				$myResponse->status = "failed";
				$myResponse->message = "Invalid file format selected";
			}
			
		}
	} catch (Exception $ex) {
		//echo $ex->message();
		$myResponse->status = "failed";
		$myResponse->message = "Invites cannot be sent at this time. Please Retry";
	}
	return json_encode($myResponse);
}


function sendGmail($dbh)
{
	
}

?>