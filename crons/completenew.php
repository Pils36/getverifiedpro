<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require "mailer.php";

try {
    
    
// 	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);

	
//Get DISTINT Project
    $user = $dbh->query("SELECT login_id, firstname, lastname, email from tbl_account_individual")->fetchAll(PDO::FETCH_ASSOC);
        
        
    
    
    $res = array();
    $firstname = array();
	$lastname = array();
	$email = array();
	
	
	foreach($user as $key){
	$login_id = $key['login_id'];
        $email['email'] = $key['email'];
         $firstname['firstname'] = $key['firstname'];
          $lastname['lastname'] = $key['lastname'];
	
	$industry = $dbh->query("SELECT COUNT(*) as indcount, firstname, lastname, email FROM `tbl_industry_experience` JOIN tbl_account_individual WHERE tbl_industry_experience.login_id = tbl_account_individual.login_id GROUP BY firstname")->fetchAll(PDO::FETCH_ASSOC);

    $education = $dbh->query("SELECT COUNT(*) as educount, firstname, lastname, email FROM `tbl_educational_qualification` JOIN tbl_account_individual WHERE tbl_educational_qualification.login_id = tbl_account_individual.login_id GROUP BY firstname")->fetchAll(PDO::FETCH_ASSOC);
    
    $professional = $dbh->query("SELECT COUNT(*) as procount, firstname, lastname, email FROM `tbl_professional_certification` JOIN tbl_account_individual WHERE tbl_professional_certification.login_id = tbl_account_individual.login_id GROUP BY firstname")->fetchAll(PDO::FETCH_ASSOC);
    
    $affiliation = $dbh->query("SELECT COUNT(*) as relcount, firstname, lastname, email FROM tbl_affiliation JOIN tbl_account_individual WHERE tbl_affiliation.login_id = tbl_account_individual.login_id GROUP BY firstname")->fetchAll(PDO::FETCH_ASSOC);
    
    $executed = $dbh->query("SELECT COUNT(*) as execount, firstname, lastname, email FROM tbl_educational_qualification JOIN tbl_account_individual WHERE tbl_educational_qualification.login_id = tbl_account_individual.login_id GROUP BY firstname")->fetchAll(PDO::FETCH_ASSOC);

    
    // print_r(json_encode($allRow));


    $res = array_merge_recursive($industry,$education,$professional,$affiliation,$executed);
    
	}
    print_r($res[0]['indcount']);
    
	//$rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@hotmail.com"
	// ));
	
    
	$body = file_get_contents('../templates/Complete/Complete.html');

	$subject = "complete your profile on Pro-Filr to improve your ranking";

    // $resp = cron_($rows, $subject, $body);
    $resp = cron_($res, $subject, $body);
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
	    //WHERE login_id = current $member->login
	    
	    $sql = "SELECT * FROM tbl_industry_experience";
	    
	    print_r($sql);
// 	$ind = $dbh->query("SELECT * FROM tbl_industry_experience ")->fetchAll(PDO::FETCH_ASSOC);

    // $education = $dbh->query("SELECT COUNT(*) as educount FROM `tbl_educational_qualification` WHERE tbl_educational_qualification.login_id = '".$member['login_id']."'")->fetchAll(PDO::FETCH_ASSOC);
    
    // $professional = $dbh->query("SELECT COUNT(*) as procount FROM `tbl_professional_certification` WHERE tbl_professional_certification.login_id = '".$member['login_id']."'")->fetchAll(PDO::FETCH_ASSOC);
    
    // $affiliation = $dbh->query("SELECT COUNT(*) as relcount FROM tbl_affiliation WHERE tbl_affiliation.login_id = '".$member['login_id']."'")->fetchAll(PDO::FETCH_ASSOC);
    
    // $executed = $dbh->query("SELECT COUNT(*) as execount FROM tbl_educational_qualification WHERE tbl_educational_qualification.login_id = '".$member['login_id']."'")->fetchAll(PDO::FETCH_ASSOC);
    
    // print_r($ind);
    
    // if($industry >= 2){
    //     $indcount = 100;
        
    // }elseif($industry == 1){
    //     $indcount = 50;
        
    // }else{
    //     $indcount = 0;
    // } //for 5 tables
    
    //500%/5 === $total
    
    // print_r($member);
        // $email = "bambo.adenuga@pro-filr.com";
        
        // $email = $member['email'];
		$body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_indcount_', '_educount_', '_procount_', '_relcount_', '_execount_', '_totcount_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member['indcount'], $member['educount'], $member['procount'], $member['relcount'], $member['execount'], ),
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

