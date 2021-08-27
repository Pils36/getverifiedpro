<?php
require "config.php";
//require "mailer.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
// 	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE login_id NOT IN (SELECT login_id FROM tbl_invites) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
	$rows2 = $dbh->query("SELECT COUNT(*) AS count, firstname, lastname, email, MAX(date_validated) as date FROM `tbl_validation` JOIN `tbl_account_individual` WHERE `tbl_validation`.member_id = `tbl_account_individual`.login_id GROUP BY member_id ORDER BY date_validated DESC")->fetchAll(PDO::FETCH_ASSOC);
	
// 	$row = array_merge($rows, $rows2);
	
	// $rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@yahoo.com"
	// ));
	$body = file_get_contents('../templates/Complete/Upload.html');
	$subject = "Find Other Professionals You May Know by Importing your contacts";
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
	    
	   // $count = count($member['member_id']);
	    
	   // if($count == 0){
	   //     print_r($count + 1);
	   // }
	    
	   // print_r($data);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_count_', '_date_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member['count'], date('d-m-Y', strtotime($member['date']))),
            file_get_contents('../templates/Complete/Upload.html')
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
		print_r($mail->msgHTML($body));
	}
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;
}

?>