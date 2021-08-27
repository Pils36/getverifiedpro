<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require "mailer.php";

try {
	//$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
// 	$rows = $dbh->query("SELECT title,member_login_id AS '', lastname,firstname,email FROM tbl_project_tasks JOIN tbl_account_individual WHERE tbl_project_tasks.member_login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);
	
    $rows = $dbh->query("SELECT * FROM tbl_project_tasks,tbl_projects JOIN tbl_account_individual WHERE tbl_projects.owner_login_id = tbl_account_individual.login_id AND tbl_project_tasks.if_completed = 1")->fetchAll(PDO::FETCH_ASSOC);
    // $sql = $dbh->query("SELECT title, firstname, lastname FROM `tbl_projects` JOIN tbl_account_individual WHERE tbl_projects.owner_login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);

	foreach($rows as $key => $member){
	    $body = str_replace(
            array('_taskfirstname_', '_tasklastname_', '_tasktitle_', '_taskemail_', '_memberfirstname_', '_memberlastname_', '_membertitle_'),
            array($member['firstname'], $member['lastname'], $member['title'], $member['email']),
            file_get_contents('../templates/Complete/projectemail.html')
        );
        
        print_r($body);
	}
	
	
	//$rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@hotmail.com"
	// ));
	
	
	// $rows = $dbh->query("select upper(lastname) as lastname,upper(firstname) as firstname,email from tbl_account_individual where email in ('oladesoye@yahoo.com','oladesoye@gmail.com')")->fetchAll(PDO::FETCH_ASSOC);
	$body = file_get_contents('../templates/Complete/projectemail.html');
	$subject = "Your project notification on pro-filr.com";
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
	$mail->msgHTML($body);
	$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
	
	foreach ($data as $key => $member) {
// 		$email = $member['email'];
        $email = "bambo.adenuga@pro-filr.com";
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

