<?php
require "config.php";
require "mailer.php";
//require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
	$rows = $dbh->query("SELECT sent_to AS email, firstname,lastname FROM tbl_invites JOIN tbl_account_individual ON tbl_invites.login_id = tbl_account_individual.login_id WHERE sent_to NOT IN (SELECT email FROM tbl_login)")->fetchAll(PDO::FETCH_ASSOC);
	
	$body = file_get_contents('../templates/Invitation/Invitation.html');
	$subject = "sent you an invite.";
	$resp = cron($rows, $subject, $body);
	echo $resp;
	
} catch (Exception $ex) {
	echo $ex->getMessage();
}


function cron($data, $subject, $body)
{
	$notSent = "";
	$mail = new PHPMailer;
	$mail->isSMTP();
	
	$mail->Host = 'pro-filr.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
	$mail->Port = 465;
	$mail->Username = 'subscription@pro-filr.com';
	$mail->Password = 'portFOLIO_2015';
	$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr Inc.');
	$mail->msgHTML($body);
	$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
	
	foreach ($data as $key => $member) {
// 		$email = $member['email'];
		//ucwords(strtolower($member['firstname']))
		$mail->Subject = ucwords(strtolower($member['firstname'])) . " " . ucwords(strtolower($member['lastname'])) . " " . $subject;
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$mail->clearAllRecipients();
			$mail->addAddress($email);
			if (!$mail->send()) {
				$notSent .= $email . " | ";
				break; //Abandon sending
			}
		}
	}
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;
}

?>