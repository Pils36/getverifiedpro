<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require "mailer.php";

try {
	//$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
// 	$rows = array(array(
// 				"lastname"=>"Adebambo",
// 				"firstname"=>"Adenuga",
// 				"email"=>"adenugaadebambo41@gmail.com"
// 	));
	
	
	// $rows = $dbh->query("select upper(lastname) as lastname,upper(firstname) as firstname,email from tbl_account_individual where email in ('oladesoye@yahoo.com','oladesoye@gmail.com')")->fetchAll(PDO::FETCH_ASSOC);
	$body = file_get_contents('../templates/Complete/Complete.php');
	$subject = "complete your profile on Pro-Filr to improve your ranking";
	$resp = cron_($rows, $subject, $body);
	echo $resp;
	
} catch (Exception $ex) {
	echo $ex->getMessage();
}

function cron_($data, $subject, $body)
{
	$notSent = "";
	$mail = new PHPMailer;
	$mail->isSMTP();
	
	$mail->Host = 'pro-filr.com';
	$mail->isHTML(true);
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
        // $email = "adenugaadebambo41@gmail.com";
		//ucwords(strtolower($member['firstname']))
		$mail->Subject = ucwords(strtolower($member['firstname'])) . " " . ucwords(strtolower($member['lastname'])) . ", " . $subject;
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

