<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require "mailer.php";

try {

$rows = $dbh->query("SELECT title, firstname, lastname, email FROM tbl_account_individual JOIN tbl_blog_post WHERE tbl_account_individual.online_status = tbl_blog_post.status ORDER BY tbl_blog_post.id DESC")->fetchAll(PDO::FETCH_ASSOC);	
	//$rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@hotmail.com"
	// ));
	
	
	// $rows = $dbh->query("select upper(lastname) as lastname,upper(firstname) as firstname,email from tbl_account_individual where email in ('oladesoye@yahoo.com','oladesoye@gmail.com')")->fetchAll(PDO::FETCH_ASSOC);
	$body = file_get_contents('../templates/Complete/blogemail.html');
	$subject = "You have new Blog to Read  on Pro-Filr";
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
	    $body = str_replace(
            array('_firstname_', '_lastname_', '_title_', '_email_', '_count_'),
            array($member['firstname'], $member['lastname'], $member['title'], $member['email'], count($key)),
            file_get_contents('../templates/Complete/blogemail.html')
        );

        // $email = "bambo.adenuga@pro-filr.com";
        $email = $member['email'];
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
// 		print_r($mail->msgHTML($body));
	}
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;
}

?>

