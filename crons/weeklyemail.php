<?php
require "config.php";
//require "mailer.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
// 	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE login_id NOT IN (SELECT login_id FROM tbl_invites) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
// 	Get user information from tbl_account_individual:::
 $user = $dbh->query("SELECT login_id, firstname, lastname, email from tbl_account_individual")->fetchAll(PDO::FETCH_ASSOC);

// print_r($user);	
	
	$res = array();
	$firstname = array();
	$lastname = array();
	$email = array();
	foreach($user as $key){
	   // Loop through all users to fetch report
	   $login_id = $key['login_id'];
	   $firstname['firstname'] = $key['firstname'];
	   $lastname['lastname'] = $key['lastname'];
	   $email['email'] = $key['email'];
	   
	   //echo "Information for : " .$firstname. " ".$lastname;
	   //echo "<br /> <br/>";
	   //Get count for reports for each user
	   
	   //For specialization count:::
	   
	   $spec = $dbh->query("SELECT COUNT(*) speccount FROM tbl_opportunity JOIN tbl_account_individual WHERE tbl_account_individual.profession = tbl_opportunity.specialisation AND tbl_account_individual.email = '.$email.'")->fetchAll(PDO::FETCH_ASSOC);
	   
	   
	   // echo "Specs: ";
	   // print_r($spec);
	   // echo "<br/><br/>";
	   
	   // For Profile view
	   $view = $dbh->query("SELECT COUNT(*)as profileviewcount, member_login_id FROM tbl_profile_views WHERE member_login_id = ".$login_id)->fetchAll(PDO::FETCH_ASSOC);
	   
	   //echo "Views: ";
	   //print_r($view);
	   //echo "<br/><br/>";
	   
	   
	   //Imported contact
	   $import = $dbh->query("SELECT COUNT(*) importedcount FROM tbl_invites WHERE login_id = ".$login_id)->fetchAll(PDO::FETCH_ASSOC);
	   
	   //echo "Import: ";
	   //print_r($import);
	   //echo "<br/><br/>";
	   
	   //Connection count
	   $connect = $dbh->query("SELECT COUNT(*) connectioncount FROM `tbl_connection` WHERE login_id = ".$login_id)->fetchAll(PDO::FETCH_ASSOC);
	   
	   //echo "Connection: ";
	   //print_r($connect);
	   //echo "<br/><br/>";
	   
	   //Opportunity count
	   
	   $opport = $dbh->query("SELECT COUNT(*) opportunitycount FROM `tbl_opportunity` JOIN tbl_account_individual WHERE tbl_account_individual.industry = tbl_opportunity.industry AND tbl_account_individual.login_id = ".$login_id)->fetchAll(PDO::FETCH_ASSOC);
	   
	   //echo "Opportunity: ";
	   //print_r($opport);
	  
	   
	   
	   $res[] = array_merge($spec,$view,$import,$connect,$opport, $firstname, $lastname, $email);

	}
    
    $rows = $res;
   
	// $rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@yahoo.com"
	// ));
	$body = file_get_contents('../templates/Complete/weeklyemail.html');
	$subject = "Here is your weekly report on Pro-filr";
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

		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
        $body = str_replace(
            array('_firstname_', '_email_', '_profileviewcount_','_speccount_', '_importedcount_', '_connectioncount_', '_opportunitycount_'),
            array($member['firstname'], $member['email'], $member[1]['profileviewcount'], $member[0]['speccount'], $member[2]['importedcount'], $member[3]['connectioncount'], $member[4]['opportunitycount']),
            file_get_contents('../templates/Complete/weeklyemail.html')
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