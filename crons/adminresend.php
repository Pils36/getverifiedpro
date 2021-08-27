<?php
require "config.php";
//require "mailer.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
// 	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE login_id NOT IN (SELECT login_id FROM tbl_invites) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
	$rows = $dbh->query("SELECT concat(firstname, ' ',lastname) as `sent_by`,sent_to,date_sent,count(sent_to) as count from tbl_invites join tbl_account_individual on tbl_invites.login_id = tbl_account_individual.login_id where sent_to not in (SELECT email from tbl_account_individual) group by sent_to")->fetchAll(PDO::FETCH_ASSOC);
	
// 	print_r($rows);
	

	
	// $rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@yahoo.com"
	// ));
	$body = file_get_contents('../templates/Complete/adminresend.html');
	$subject = "You have received an invite from ";
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
	    
	   // $count = count($member['member_id']);
	    
	   // if($count == 0){
	   //     print_r($count + 1);
	   // }
	    
	   // print_r($data);
		$email = $member['sent_to'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
        $body = str_replace(
            array('_sentBy_', '_firstname_', '_email_'),
            array($member['sent_by'],    $member['firstname'], $member['sent_to']),
            file_get_contents('../templates/Complete/adminresend.html')
        );
        
        $mail->msgHTML($body);
		//ucwords(strtolower($member['firstname']))
		$mail->Subject = $subject . " ".ucwords(strtolower($member['sent_by']));
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
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;
}

?>