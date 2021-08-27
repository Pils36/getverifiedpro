<?php

require_once '../app/Core/Database.php';
require_once '../app/Core/Response.php';
require_once '../app/Models/Connection.php';

function fetchLanding()
{
	$data = array();
	$dbh = Database::getInstance();
	$c = new Connection();
	$myResponse = new Response();
	
	$member = $_SESSION['login_id'];

	
	
	//fetch blogposts
	try {
		$blogPosts = $dbh->query("SELECT `tbl_blog_post`.`id`,`tbl_blog_post`.`title`,ifnull(concat(firstname,' ',lastname),'Pro-Filr') AS `name`,date_format(date_posted,'%d %b %Y %r') AS date_posted,concat(SUBSTRING_INDEX(content,' ',20),'...') AS summary, (SELECT count(*) FROM tbl_blog_comment WHERE blog_id = `tbl_blog_post`.`id`) AS comments FROM tbl_blog_post LEFT JOIN tbl_account_individual ON tbl_blog_post.login_id = tbl_account_individual.login_id ORDER BY RAND() ASC LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
		
		//fetch oppurtunities
		
		$opportunities = $dbh->query("SELECT `id`, `subject`,`location`,date_added,deadline,concat(SUBSTRING_INDEX(description,' ',20),'...') AS description FROM tbl_opportunity WHERE `status` = 'open' and deadline >= now() ORDER BY date_added DESC")->fetchAll(PDO::FETCH_ASSOC);
		
		$suggestions = $c->getConnectionSuggestions($member);
		
        //fetch online connection
		$onlineConnection = $dbh->query("SELECT * FROM `tbl_connection` JOIN tbl_account_individual WHERE tbl_account_individual.login_id = tbl_connection.member_id AND tbl_connection.login_id = $member")->fetchAll(PDO::FETCH_ASSOC);
		
    //fetch profile view now
    $profileviewnow = $dbh->query("SELECT * FROM `tbl_profile_views` JOIN tbl_account_individual WHERE tbl_profile_views.viewed_by_login_id = tbl_account_individual.login_id AND tbl_profile_views.member_login_id = $member AND date_viewed =  CURDATE()")->fetchAll(PDO::FETCH_ASSOC);
    
    // Profile view prev
    $profileview = $dbh->query("SELECT * FROM `tbl_profile_views` JOIN tbl_account_individual WHERE tbl_profile_views.viewed_by_login_id = tbl_account_individual.login_id AND tbl_profile_views.member_login_id = $member")->fetchAll(PDO::FETCH_ASSOC);
    
    $subscriber = $dbh->query("SELECT expiry_date >=NOW() FROM `tbl_subscription` WHERE login_id = $member ")->fetchAll(PDO::FETCH_ASSOC);
    
    // Groups
    $group = $dbh->query("SELECT tbl_groups.title as title,tbl_groups.owner_login_id as my_id, tbl_account_individual.login_id AS login_id, tbl_account_individual.firstname as firstname, tbl_account_individual.lastname as lastname, tbl_account_individual.email AS email FROM tbl_groups, tbl_account_individual WHERE tbl_account_individual.login_id = tbl_groups.owner_login_id ORDER BY RAND() DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
    
    // On going projects
    $project = $dbh->query("SELECT * from tbl_projects ORDER BY RAND() DESC LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
		
		
		
		
		
		//fetch people for validation
		//people with same educational background
		
		
		$data['blogposts'] = $blogPosts;
		$data['opportunities'] = $opportunities;
		$data['suggestions'] = $suggestions;
		$data['onlineConnection'] = $onlineConnection;
		$data['profileviewnow'] = $profileviewnow;
		$data['profileview'] = $profileview;
		$data['subscriber'] = $subscriber;
		$data['group'] = $group;
		$data['project'] = $project;
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $data;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}


function projectJoin()

{

	// var_dump($_POST);

	$mail = new PHPMailer;

	$dbh = Database::getInstance();

	$myResponse = new Response();

	$body = file_get_contents(DOCUMENT_ROOT . 'templates/Invitation/Joinproject.html');

	try {
	    
	    
	   // Get Group owner_id
	   
	   $adminId = $dbh->query("SELECT DISTINCT tbl_groups.owner_login_id as ID FROM `tbl_groups`, tbl_account_individual WHERE tbl_groups.owner_login_id = tbl_account_individual.login_id AND tbl_account_individual.email = '".$_POST['email']."'")->fetchAll(PDO::FETC_ASSOC);
	   
	   $owner_id = $adminId['ID'];

		//get login name

		$memberJoin = $dbh->query("select concat(firstname,' ',lastname) as `name`,firstname,company from tbl_account_individual where login_id = $member")->fetch(PDO::FETCH_ASSOC);

		$_name = $memberJoin['name'];

		$_company = $memberJoin['company'];


			$_firstname = ucfirst($memberJoin['firstname']);

			$salutation = "<span style='font-weight:bold;'>".strtoupper($_name)."</span>";


			if(!empty($_company)){

				$salutation .= " from ".strtoupper($_company);

			}

		$mail->isSMTP();
		// $mail -> SMTPDebug = 1;
		

		$mail->Host = 'pro-filr.com';

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'ssl';

		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead

		$mail->Port = 465;

		$mail->Username = 'subscription@pro-filr.com';

		$mail->Password = 'portFOLIO_2015';

		$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');

		// $mail->addReplyTo('subscription@pro-filr.com', 'Pro-Filr.com');

		$mail->Subject = "You have a project request " . $_name;

		$body = str_replace("___First Name and Last Name___", $salutation, $body);
                
                
				$body = str_replace("___First Name___", $_firstname, $body);

				

		$mail->msgHTML($body);

		//msgHTML also sets AltBody, but if you want a custom one, set it afterwards

		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

		

		$emails = rtrim($_POST['emails'], ",");

		

		$emails = explode(",", $emails);

		$count = 0;

// 		mail("adenugaadebambo41@gmail.com", "Hello", "Try Pro-Filr");

		

		foreach ($emails as $key => $email) {

			

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$mail->clearAllRecipients();

				// $mail->addAddress($email);
				
				$mail->addAddress('bambo.adenuga@pro-filr.com');

				if (!$mail->send()) {

					// echo $mail->ErrorInfo;

					echo "Mailer Error (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . '<br />';

					break; //Abandon sending

				} else {

					//echo "Message sent to :" . $row['full_name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';

					//insert into tbl_inivites

					// echo "insert into tbl_invites(login_id,sent_to) values (:id,:to)";

					$stmt = $dbh->prepare("INSERT INTO tbl_connection(login_id,member_id) VALUES (:id,:adminId)");

					$stmt->execute(array(":id" => $_SESSION['login_id'], ":adminId" => $owner_id));

					$count = $count + 1;

					

				}

			}

		}

		if ($count < 1) {

			$myResponse->status = "failed";

			$myResponse->message = "Request cannot be sent at this time. Please Retry";

		} else {

			$myResponse->status = "success";

			$myResponse->message = "Request sent successfully";

		}

		

		$myResponse->data = $memberJoin;

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Request cannot be sent at this time. Please Retry";

	}

	return json_encode($myResponse);

}

