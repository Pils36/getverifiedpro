<?php
require "config.php";
//require "mailer.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {
// 	$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE login_id NOT IN (SELECT login_id FROM tbl_invites) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
//Get DISTINT Project
    $user = $dbh->query("SELECT login_id, firstname, lastname, email from tbl_account_individual")->fetchAll(PDO::FETCH_ASSOC);
        
        
    
    
    $sqlRes = array();
    $firstname = array();
	$lastname = array();
	$email = array();
	
	foreach($user as $key){
	     $login_id = $key['login_id'];
        $email['email'] = $key['email'];
         $firstname['firstname'] = $key['firstname'];
          $lastname['lastname'] = $key['lastname'];
          
          // Mutual Friends
        $sql0 = $dbh->query("SELECT my_account.*, CONCAT('Friends with ', f_account.firstname,' ', f_account.lastname) AS in_common, COUNT(*) as relevance, GROUP_CONCAT(a.login_id ORDER BY a.login_id) as mutual_friends FROM tbl_connection a JOIN tbl_connection b ON  (b.member_id = a.login_id AND b.login_id = {$login_id}) LEFT JOIN tbl_connection c ON (c.member_id = a.member_id AND c.login_id = {$login_id}) JOIN tbl_account_individual my_account ON my_account.login_id = a.member_id JOIN tbl_account_individual f_account ON f_account.login_id = a.login_id WHERE c.login_id IS NULL AND a.member_id != {$login_id} GROUP BY a.member_id ORDER BY relevance DESC LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);
        
        // Company related		
		$sql1 = $dbh->query("SELECT tbl_account_individual.*, CONCAT('Worked at ',the_company.name) AS the_companys FROM tbl_company AS the_company JOIN tbl_company AS my_company ON my_company.name = the_company.name JOIN tbl_account_individual ON tbl_account_individual.login_id = the_company.login_id WHERE my_company.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
		
		// Executed Projects
		$sql2 = $dbh->query("SELECT tbl_account_individual.*, CONCAT('Worked with ',the_project.project_employer) AS the_project FROM tbl_executed_project AS the_project JOIN tbl_executed_project AS my_project ON my_project.project_employer = the_project.project_employer JOIN tbl_account_individual ON tbl_account_individual.login_id = the_project.login_id WHERE my_project.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
		
		//Experience 		
		$sql3 = $dbh->query("SELECT tbl_account_individual.*, CONCAT('Worked at ',the_experience.company) AS my_experience FROM tbl_industry_experience AS the_experience JOIN tbl_industry_experience AS my_experience ON my_experience.company = the_experience.company JOIN tbl_account_individual ON tbl_account_individual.login_id = the_experience.login_id WHERE my_experience.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
		
		//Affiliation / Religion 		
		$sql4 = $dbh->query("SELECT tbl_account_individual.*, CONCAT('Member of ',the_affiliation.organisation) AS the_affiliations FROM tbl_affiliation AS the_affiliation JOIN tbl_affiliation AS my_affiliation ON my_affiliation.organisation = the_affiliation.organisation JOIN tbl_account_individual ON tbl_account_individual.login_id = the_affiliation.login_id WHERE my_affiliation.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
		
		//Professional Certs 		
		$sql5 = $dbh->query("SELECT tbl_account_individual.*, CONCAT('Has ',the_professional_certification.certification) AS the_professional_certifications FROM tbl_professional_certification AS the_professional_certification JOIN tbl_professional_certification AS my_professional_certification ON my_professional_certification.certification = the_professional_certification.certification JOIN tbl_account_individual ON tbl_account_individual.login_id = the_professional_certification.login_id WHERE my_professional_certification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
		
		//Educational Qualification 		
		$sql6 = $dbh->query("SELECT tbl_account_individual.*, CONCAT('Schooled at ',the_educational_qualification.school) AS the_educational_qualifications FROM tbl_educational_qualification AS the_educational_qualification JOIN tbl_educational_qualification AS my_educational_qualification ON my_educational_qualification.school = the_educational_qualification.school JOIN tbl_account_individual ON tbl_account_individual.login_id = the_educational_qualification.login_id WHERE my_educational_qualification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
		
		// Lives in
// 		$sql7 = $dbh->query("select tbl_account_individual.*,concat('Lives in ',country) as in_common from tbl_account_individual where country = (select country from tbl_account_individual where login_id = {$login_id}) and login_id <> {$login_id}")->fetchAll(PDO::FETCH_ASSOC);

// $sql7 = $dbh->query("select tbl_account_individual.*,concat('Lives in ',country) as live_in from tbl_account_individual where country = (select country from tbl_account_individual where login_id = {$login_id})")->fetchAll(PDO::FETCH_ASSOC);


        $sqlRes[] = array_merge($sql1,$sql2,$sql3,$sql4,$sql5,$sql6,$firstname, $lastname, $email);
	}
	$rows = $sqlRes;
	
// 	print_r($rows);
	
    // print_r($row);
    // echo "<hr>";

   
	// $rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@yahoo.com"
	// ));
	$body = file_get_contents('../templates/Complete/matchingsystem.html');
	$subject = " a Professional you may know is now on Pro-filr ";
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
    
    // print_r(count($member[0]['firstname']));
    
    if(count($member[0]['firstname']) == 1){
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_photo_','_otherfirstname_', '_otherlastname_', '_mutual_friends_', '_the_company_', '_the_project_', '_my_experience_', '_the_affiliation_', '_the_professional_certification_', '_the_educational_qualification_','_industry_', '_coy_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member[0]['photo'], $member[0]['firstname'],$member[0]['lastname'], $member[0]['in_common'], $member[0]['the_companys'], $member[0]['the_project'], $member[0]['my_experience'], $member[0]['the_affiliations'], $member[0]['the_professional_certifications'], $member[0]['the_educational_qualifications'], $member[0]['industry'], $member[0]['company']),
            file_get_contents('../templates/Complete/matchingsystem.html')
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
    
    elseif(count($member[1]['firstname']) == 1){
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_photo_','_otherfirstname_', '_otherlastname_', '_mutual_friends_', '_the_company_', '_the_project_', '_my_experience_', '_the_affiliation_', '_the_professional_certification_', '_the_educational_qualification_','_industry_', '_coy_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member[1]['photo'], $member[1]['firstname'],$member[1]['lastname'], $member[1]['in_common'], $member[1]['the_companys'], $member[1]['the_project'], $member[1]['my_experience'], $member[1]['the_affiliations'], $member[1]['the_professional_certifications'], $member[1]['the_educational_qualifications'], $member[1]['industry'], $member[1]['company']),
            file_get_contents('../templates/Complete/matchingsystem.html')
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
    elseif(count($member[2]['firstname']) == 1){
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_photo_','_otherfirstname_', '_otherlastname_', '_mutual_friends_', '_the_company_', '_the_project_', '_my_experience_', '_the_affiliation_', '_the_professional_certification_', '_the_educational_qualification_','_industry_', '_coy_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member[2]['photo'], $member[2]['firstname'],$member[2]['lastname'], $member[2]['in_common'], $member[2]['the_companys'], $member[2]['the_project'], $member[2]['my_experience'], $member[2]['the_affiliations'], $member[2]['the_professional_certifications'], $member[2]['the_educational_qualifications'], $member[2]['industry'], $member[2]['company']),
            file_get_contents('../templates/Complete/matchingsystem.html')
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
    elseif(count($member[3]['firstname']) == 1){
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_photo_','_otherfirstname_', '_otherlastname_', '_mutual_friends_', '_the_company_', '_the_project_', '_my_experience_', '_the_affiliation_', '_the_professional_certification_', '_the_educational_qualification_','_industry_', '_coy_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member[3]['photo'], $member[3]['firstname'],$member[3]['lastname'], $member[3]['in_common'], $member[3]['the_companys'], $member[3]['the_project'], $member[3]['my_experience'], $member[3]['the_affiliations'], $member[3]['the_professional_certifications'], $member[3]['the_educational_qualifications'], $member[3]['industry'], $member[3]['company']),
            file_get_contents('../templates/Complete/matchingsystem.html')
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
    
    elseif(count($member[4]['firstname']) == 1){
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_photo_','_otherfirstname_', '_otherlastname_', '_mutual_friends_', '_the_company_', '_the_project_', '_my_experience_', '_the_affiliation_', '_the_professional_certification_', '_the_educational_qualification_','_industry_', '_coy_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member[4]['photo'], $member[4]['firstname'],$member[4]['lastname'], $member[4]['in_common'], $member[4]['the_companys'], $member[4]['the_project'], $member[4]['my_experience'], $member[4]['the_affiliations'], $member[4]['the_professional_certifications'], $member[4]['the_educational_qualifications'], $member[4]['industry'], $member[4]['company']),
            file_get_contents('../templates/Complete/matchingsystem.html')
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
    
    elseif(count($member[5]['firstname']) == 1){
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_photo_','_otherfirstname_', '_otherlastname_', '_mutual_friends_', '_the_company_', '_the_project_', '_my_experience_', '_the_affiliation_', '_the_professional_certification_', '_the_educational_qualification_','_industry_', '_coy_'),
            array($member['firstname'],    $member['lastname'], $member['email'], $member[5]['photo'], $member[5]['firstname'],$member[5]['lastname'], $member[5]['in_common'], $member[5]['the_companys'], $member[5]['the_project'], $member[5]['my_experience'], $member[5]['the_affiliations'], $member[5]['the_professional_certifications'], $member[5]['the_educational_qualifications'], $member[5]['industry'], $member[5]['company']),
            file_get_contents('../templates/Complete/matchingsystem.html')
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
    
    else{
        // print_r($member['firstname']);

        // print_r($member[$i]);
		$email = $member['email'];
        // $email = "bambo.adenuga@pro-filr.com";
        // $email = "supports@pro-filr.com";
       $body = str_replace(
            array('_firstname_', '_lastname_', '_email_'),
            array($member['firstname'],    $member['lastname'], $member['email']),
            file_get_contents('../templates/Complete/nomatchingyet.html')
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