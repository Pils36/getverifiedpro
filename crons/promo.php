<?php
require "config.php";
//require "mailer.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
// 	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE login_id NOT IN (SELECT login_id FROM tbl_invites) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
	$rows2 = $dbh->query("SELECT * FROM tbl_promo WHERE state = 0")->fetchAll(PDO::FETCH_ASSOC);
	
// 	$row = array_merge($rows, $rows2);
	
	// $rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@yahoo.com"
	// ));
	$body = file_get_contents('../templates/Complete/promo.html');
	$subject = "you now have access to classic plan on Pro-filr";
	$resp = cron_($rows2, $subject, $body);
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
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
	$mail->Port = 465;
	$mail->Username = 'subscription@pro-filr.com';
	$mail->Password = 'portFOLIO_2015';
	$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr Inc.');
// 	$mail->msgHTML($body);
	$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
	
// 	$count = 0;
	foreach ($data as $key => $member) {
    
    // print_r($member['percent'] > 70);
    
    if($member['percent'] > 24 && $member['state']== 0){
        		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        $subject = " You now have access to classic plan on Pro-filr";
        $body = str_replace(
            array('_firstname_', '_lastname_', '_email_'),
            array($member['firstname'],    $member['lastname'], $member['email']),
            file_get_contents('../templates/Complete/promo.html')
        );
        
        $mail->msgHTML($body);
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
// 		print_r($mail->msgHTML($body));
    }
    elseif($member['percent'] <= 24){
        		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        $subject = "Enjoy classic plan on Pro-filr when you complete profile";
        $body = str_replace(
            array('_firstname_', '_lastname_', '_email_'),
            array($member['firstname'],    $member['lastname'], $member['email']),
            file_get_contents('../templates/Complete/approachpromo.html')
        );
        
        $mail->msgHTML($body);
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
// 		print_r($mail->msgHTML($body));
    }

// 		print_r($mail->msgHTML($body));
	}
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;
}

?>