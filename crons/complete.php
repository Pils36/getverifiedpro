<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require "mailer.php";

try {
    
    
	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL OR company IS NULL or phone is NULL OR photo = 'profile-placeholder.png' OR position is NULL OR city IS NULL)")->fetchAll(PDO::FETCH_ASSOC);

	
	
	
    // print_r($rows);
    
	//$rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@hotmail.com"
	// ));
	
    
	$body = file_get_contents('../templates/Complete/Complete.html');

	$subject = "Win More Clients by Becoming a Verified Professional";

    // $resp = cron_($rows, $subject, $body);
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

	
	foreach ($data as $key => $member) {
	    
    // print_r($member);
        // $email = "bambo.adenuga@pro-filr.com";
        
        $email = $member['email'];
		$body = str_replace(
            array('_firstname_', '_lastname_', '_email_'),
            array($member['firstname'],    $member['lastname'], $member['email']),
            file_get_contents('../templates/Complete/Complete.html')
        );
        
		//ucwords(strtolower($member['firstname']))
		$mail->Subject = ucwords(strtolower($member['firstname'])) . " " . ucwords(strtolower($member['lastname'])) . ", " . $subject;
		$mail->msgHTML($body);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$mail->clearAllRecipients();
			$mail->addAddress($email);
			if (!$mail->send()) {
				$notSent .= $email . " | ";
				break; //Abandon sending
			}
		}
		
		print_r($mail->msgHTML($body));
	}
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;
}

?>

