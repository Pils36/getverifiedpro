<?php
require "config.php";
//require "mailer.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
	$rows = $dbh->query("SELECT firstname, lastname, email,description as brief, requirement, deadline as submission_deadline, date_added as date  FROM `tbl_opportunity` JOIN tbl_account_individual WHERE tbl_account_individual.industry = tbl_opportunity.industry AND tbl_opportunity.deadline >=NOW() ORDER BY tbl_opportunity.date_added DESC")->fetchAll(PDO::FETCH_ASSOC);
	
// 	SELECT firstname, lastname, email,description as brief, requirement, deadline as submission_deadline, date_added as date FROM `tbl_opportunity` JOIN tbl_account_individual WHERE tbl_account_individual.industry = tbl_opportunity.industry AND tbl_opportunity.status = 'open'
	

	

	$body = file_get_contents('../templates/Complete/opportunity.html');
	$subject = "A new opportunity relating to your area of specialization";
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
	    

		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";

        // $email = "supports@pro-filr.com";
        $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_brief_', '_submission_deadline_', '_date_', '_requirement_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member['brief'], date("d-M-Y",strtotime($member['submission_deadline'])), date("d-m-Y", strtotime($member['date'])), $member['requirement']),
            file_get_contents('../templates/Complete/opportunity.html')
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