<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require "mailer.php";

try {
    
    // //Get DISTINT Project
    // $projects = "SELECT DISTINCT owner_login_id, id FROM tbl_projects";
    //     $project = $dbh->prepare($projects);
    //     $project->execute();
    //     $getproject = $project->fetchAll();

    // foreach($getproject as $thisproject)
    // {
    //     // print_r($thisproject['id']);
    //     // Get Tasks Attached to project
    //     $tasks = "SELECT DISTINCT(member_login_id) FROM tbl_project_tasks WHERE project_id = '".$thisproject['id']."'";
    //         $task = $dbh->prepare($tasks);
    //         $task->execute();
    //         $gettask = $task->fetchAll();
        
    //     if(count($gettask) <= 0){
    //         echo "No Match For: ".$thisproject['id']." ==> where Task.project_id =  projectTable.id";
    //     }
    //     else{
    //         echo count($gettask)."<hr />";
            
    //         $i = 0;
    //         $taskSet = array(); // ['1', '2']
    //         foreach($gettask as $receiveTaskDetails)
    //         {
    //             array_push($taskSet, $receiveTaskDetails['member_login_id']);
                
    //             echo "<br />";
    //             echo "Mailing: ". $receiveTaskDetails['member_login_id']. " :: with Title:: ";
    //         }

    //         echo "<br />All is now::";
    //         print_r($taskSet);
    //     }
    //     echo "<hr /><br /><br />";
    //     print_r($gettask);
    //     echo "<hr />";
    // }

    
    
	//$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL) AND email NOT IN(SELECT email FROM tbl_login WHERE verification_date IS NULL)")->fetchAll(PDO::FETCH_ASSOC);
	
		
// 	$row1 = $dbh->query("SELECT member_login_id, firstname, lastname, email FROM `tbl_project_tasks` JOIN tbl_account_individual, tbl_projects WHERE tbl_project_tasks.member_login_id = tbl_account_individual.login_id AND tbl_project_tasks.project_id = tbl_projects.id")->fetchAll(PDO::FETCH_ASSOC);
	
	
// 	GEt project owners details

	$owner = $dbh->query("SELECT tbl_groups.title AS project_group, tbl_groups.id AS groupId, tbl_account_individual.login_id AS owner_id, firstname AS ownerfirstname, lastname AS ownerlastname, company AS ownercompany, profession AS ownerprofession, photo FROM `tbl_groups` JOIN tbl_account_individual WHERE tbl_groups.owner_login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);

	
	$roll = array();
	$firstname = array();
	$lastname = array();
	$email = array();
	

	$container =  [];
	
	$i = 0;
	foreach($owner as $info){
	    $i = $i + 1;
	   
	    $container[$i] = array();
	    array_push($container[$i], $info);
	    
	    $owner_id = $info['owner_id'];
	    $groupId = $info['groupId'];
	    $firstname['ownerfirstname'] = $info['ownerfirstname'];
	    $lastname['ownerlastname'] = $info['ownerlastname'];
	    $company['ownercompany'] = $info['ownercompany'];
	    $profession['ownerprofession'] = $info['ownerprofession'];
	    $photo['photo'] = $info['photo'];
	    
	    
	    
	   // print_r($firstname);
	    
	   // Get Receiver or Added Members:::
	   
	   $member = $dbh->query("SELECT tbl_group_members.login_id, firstname, lastname, email FROM `tbl_group_members` JOIN tbl_account_individual WHERE tbl_group_members.group_id = '".$groupId."' AND tbl_group_members.login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);

        $container[$i][1] = array();
	    array_push($container[$i][1], $member);

  }
        $roll = $container;
	    
	   // print_r($roll);
	   // echo "<br>";
	
// 	$rows = $dbh->query("SELECT title,member_login_id AS '', lastname,firstname,email FROM tbl_project_tasks JOIN tbl_account_individual WHERE tbl_project_tasks.member_login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);

	
	
	
	//$rows = array(array(
	// 			"lastname"=>"Adesoye",
	// 			"firstname"=>"Olaloye",
	// 			"email"=>"oladesoye@hotmail.com"
	// ));
	
	
	
	// $rows = $dbh->query("select upper(lastname) as lastname,upper(firstname) as firstname,email from tbl_account_individual where email in ('oladesoye@yahoo.com','oladesoye@gmail.com')")->fetchAll(PDO::FETCH_ASSOC);
	$body = file_get_contents('../templates/Complete/professionalgroup.html');
	$subject = "Someone you know wants to add you to a professional group on Pro-Filr";
	$resp = cron_($roll, $subject, $body);
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

// print_r($data); // Total Result : Parent
// print_r($data[2][1][0][0]);
// print_r($data[2][1][0][0]);

// Owner : $data[2][0]
// Loop : $data[2][1][0]
// echo count($data[2][1][0]);
// 	$i = 0; 
foreach($data as $thisdata => $mainOwners)
{
    $owner = $mainOwners[0]; // owners
    $members = $mainOwners[1]; // Members
    
    // print_r($owner);
    // exit();
    
    //Member for owner
    $j = -1;
    foreach($members as $member)
    {
        $j = $j + 1;
        
        // print_r($member[$j]['firstname']);
        
        if($member[$j] != null)
        {
            // print_r($member[$j]['email']);
            //Mail
            
            
            $body = str_replace(
            array('_firstname_', '_lastname_', '_email_', '_projecttitle_', '_ownercompany_', '_ownerprofession_', ' _ownerfirstname_', ' _ownerlastname_', '_photo_'),
            
            array($member[$j]['firstname'], $member[$j]['lastname'], $member[$j]['email'], $owner['project_group'], $owner['ownercompany'], $owner['ownerprofession'], $owner['ownerfirstname'], $owner['ownerlastname'], $owner['photo']),
            file_get_contents('../templates/Complete/professionalgroup.html')
        );
		$email = $member[$j]['email'];
        // $email = "bambo.adenuga@pro-filr.com";
		$mail->Subject = ucwords(strtolower($member[$j]['firstname'])) . " " . ucwords(strtolower($member[$j]['lastname'])) . ", " . $subject;
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
    }
    echo "<hr />";
    // exit();
}
// 	foreach ($data as $key => $member) {
	   // $count = count($data);
    // $i+1;
    // $i < $count-1;
    // $i++;
    // print_r($i);

    
// echo "<br /><br />";
// print_r(sizeof($member[1], 1));
// print_r($data);
// echo "<hr />";
// 
// print_r($member['ownerfirstname']);
// 

// 	    $body = str_replace(
//             array('_firstname_', '_lastname_', '_email_', '_projecttitle_', '_ownercompany_', '_ownerprofession_', ' _ownerfirstname_', ' _ownerlastname_', '_photo_'),
            
//             array($member[0]['firstname'], $member[0]['lastname'], $member[0]['email'], $member['project_group'], $member['ownercompany'], $member['ownerprofession'], $member['ownerfirstname'], $member['ownerlastname'], $member['photo']),
//             file_get_contents('../templates/Complete/professionalgroup.html')
//         );
// // 		$email = $member['email'];
//         // $email = "bambo.adenuga@pro-filr.com";
// 		$mail->Subject = ucwords(strtolower($member['firstname'])) . " " . ucwords(strtolower($member['lastname'])) . ", " . $subject;
// 		$mail->msgHTML($body);
// 		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 			$mail->clearAllRecipients();
// 			$mail->addAddress($email);
// 			if (!$mail->send()) {
// 				$notSent .= $email . " | ";
// 				break; //Abandon sending
// 			}
// 		}
// // 		print_r($mail->msgHTML($body));
// 	}
	$mail->smtpClose;
	if ($notSent) {
		$notSent = "The following emails could not be reached:\n\r" . $notSent;
	}
	return "Done. \n\r" . $notSent;

}
?>

