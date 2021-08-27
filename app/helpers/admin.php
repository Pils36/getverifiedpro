<?php

require_once '../app/Core/Database.php';
require_once '../app/Core/Response.php';

function adminLogin()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	

	$username = $_POST['username'];

	$password = $_POST['password'];

	if (empty($username) || empty($password)) {

		$myResponse->status = "failed";

		$myResponse->message = "All fields are required";

		return json_encode($myResponse);

	}

	

	$stmt = $dbh->prepare("SELECT * FROM tbl_admin WHERE username = :user AND `password` = md5(:pass)");

	$stmt->execute(array(

		":user" => $username,

		":pass" => $password

	));

	$count = $stmt->rowCount();

	if ($count < 1) {

		$myResponse->status = "failed";

		$myResponse->message = "Invalid Login";

		return json_encode($myResponse);

	} else {

		$myResponse->status = "success";

		$myResponse->message = "Login successful";

		//$myResponse->data = $count;

		$_SESSION['admin_login'] = "admin";

		return json_encode($myResponse);

	}

	

	

}





function getBlogs()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$rows = $dbh->query("SELECT id,date_posted,title,summary,content,`status` FROM tbl_blog_post ORDER BY date_posted DESC")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Blog posts retrieved successfully";

		$myResponse->data = $rows;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Posted blogs cannot be displayed at the moment. Please retry";

	}

	return json_encode($myResponse);

}




// GEt Promo
function getPromo()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$rows = $dbh->query("SELECT * FROM tbl_promo WHERE percent > 24 AND sub_status = 0")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Blog posts retrieved successfully";

		$myResponse->data = $rows;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Posted blogs cannot  be displayed at the moment. Please retry";

	}

	return json_encode($myResponse);

	

}

// Fetch Deactivated Users
function getDeactivate(){
    $dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$rowDeactivate = $dbh->query("SELECT * FROM tbl_deactivate WHERE state = 1")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "List retrieved successfully";

		$myResponse->data = $rowDeactivate;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Deactivated users cannot be displayed at the moment. Please retry";

	}

	return json_encode($myResponse);
}


function updateLogin(){
    $dbh = Database::getInstance();

	$myResponse = new Response();

	try {
        
        $login_id = $_POST['thislogid'];
        
        $rowdeactive = $dbh->prepare("UPDATE tbl_account_individual SET acct_state = 0 WHERE login_id =$login_id");
		        $rowdeactive->execute();
        
        $rowdeactiveUpdt = $dbh->prepare("UPDATE tbl_deactivate SET state = 0 WHERE login_id =$login_id");
		        $rowdeactiveUpdt->execute(); 
        
		$rowDeactivate = $dbh->query("SELECT * FROM tbl_deactivate WHERE login_id =$login_id")->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($rowDeactivate as $key){
		    $username = $key['username'];
		    $password = $key['password'];
		    $login_id = $key['login_id'];
		    $email = $key['email'];
		    $date_created = $key['date_created'];
		    $verify_date = $key['verification_date'];
		    $verify_link = $key['verification_link'];
		    $account_type = $key['account_type'];
		    
		    
		    $rowActivate = $dbh->prepare("REPLACE INTO `tbl_login`(`username`, `password`, `login_id`, `email`,`date_created`, `verification_date`, `verification_link`, `account_type`) VALUES (:username,:password,:login_id,:email,:date_created,:verification_date,:verification_link,:account_type)");
		    
		    $rowActivate->execute(array(
		            ":username" => $username,
		            ":password" => $password,
		            ":login_id" => $login_id,
		            ":email" => $email,
		            ":date_created" => $date_created,
		            ":verification_date" => $verify_date,
		            ":verification_link" => $verify_link,
		            ":account_type" => $account_type,
		        ));
		    
		}
		

		$myResponse->status = "success";

		$myResponse->message = "User is now activated";

		$myResponse->data = $rowActivate;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "User not activated. Please try again".$ex;

	}

	return json_encode($myResponse);
}


// Deactivate User
function deactivateLogin(){
    $dbh = Database::getInstance();

	$myResponse = new Response();

	try {
        
        $login_id = $_POST['thisuserid'];
        
        $rowdeactive = $dbh->prepare("UPDATE tbl_account_individual SET acct_state = 1 WHERE login_id =$login_id");
		        $rowdeactive->execute();
        
        $row1 = $dbh->query("SELECT * FROM tbl_logins WHERE login_id = '".$login_id."'")->fetchAll(PDO::FETCH_ASSOC);
        
        $rowCheck = $dbh->query("SELECT COUNT(*) FROM tbl_deactivate WHERE login_id = '".$login_id."'")->fetchAll(PDO::FETCH_ASSOC);
 	    
		
		foreach($row1 as $key){
		    $username = $key['username'];
		    $password = $key['password'];
		    $login_id = $key['login_id'];
		    $email = $key['email'];
		    $date_created = $key['date_created'];
		    $verify_date = $key['verification_date'];
		    $verify_link = $key['verification_link'];
		    $account_type = $key['account_type'];
		    
		    

		  
		  $row2 = $dbh->prepare("REPLACE INTO `tbl_deactivate`(`username`, `password`, `login_id`, `email`,`date_created`, `verification_date`, `verification_link`, `account_type`, `state`) VALUES ('".$username."','".$password."','".$login_id."','".$email."','".$date_created."','".$verify_date."','".$verify_link."','".$account_type."', 1)");
		    
		    $resp = $row2->execute();
		  
		  $row3 = $dbh->prepare("DELETE FROM tbl_login WHERE login_id ='".$login_id."'");
		        $row3->execute();
   
		}
		

		$myResponse->status = "success";

		$myResponse->message = "User is now de-activated";

		$myResponse->data = $row2;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "User cannot be de-activated. Please try again".$ex;

	}

	return json_encode($myResponse);
}




function getMembers()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$rows = $dbh->query("SELECT tbl_account_individual.login_id AS no, tbl_account_individual.email AS email, tbl_account_individual.industry AS industry, tbl_account_individual.profession AS specialization, tbl_account_individual.online_status AS status,tbl_account_individual.last_seen AS last, firstname,lastname,country, date_created FROM tbl_account_individual JOIN tbl_login ON tbl_account_individual.login_id = tbl_login.login_id WHERE acct_state = 0 ORDER BY date_created DESC;")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Blog posts retrieved successfully";

		$myResponse->data = $rows;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Posted blogs cannot  be displayed at the moment. Please retry";

	}

	return json_encode($myResponse);

	

}



function getSubscriptions()

{

	

	

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {


		$rows = $dbh->query("SELECT expiry_date, 'active' as `status`,plan ,tbl_subscription.login_id as no,firstname,lastname,email,subscription_date, state AS options, online_status as state, last_seen as last FROM tbl_subscription JOIN tbl_account_individual ON tbl_subscription.login_id = tbl_account_individual.login_id AND tbl_subscription.expiry_date IS NOT NULL AND date(expiry_date) >= NOW()")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Blog posts retrieved successfully";

		$myResponse->data = $rows;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Posted blogs cannot be displayed at the moment. Please retry";

	}

	return json_encode($myResponse);

}

// Remove subscriber
function removeSubscriber()

{

	

	

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {


		$rows = $dbh->query("SELECT login_id FROM tbl_account_individual WHERE email= '".$_POST['thisemail']."'")->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($rows as $row){
		    $id = $row['login_id'];
		    
		    $del = $dbh->query("DELETE FROM tbl_subscription WHERE login_id =$id");
		    $del->execute();
		    
		    $myResponse->status = "deleted";

    		$myResponse->message = "Blog posts retrieved successfully";
    
    		$myResponse->data = $del;
		}

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Posted blogs cannot be displayed at the moment. Please retry";

	}

	return json_encode($myResponse);

}



// Update subscriber
function updateSubscriber()

{

	

	

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {
    
        $state = $_POST['thisoption'];
        $expiry = date('Y-m-d', mktime(0, 0, 0, date("m") + 1, date("d") - 1, date("Y")));
        
        $expiry2 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y") + 1));

		$rows = $dbh->query("SELECT * FROM tbl_account_individual WHERE login_id= '".$_POST['thisid']."'")->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($rows as $row){
		    $id = $row['login_id'];
		    
		    if($state == 3){
		        $update = $dbh->query("UPDATE tbl_subscription SET plan = 'NULL', expiry_date = 'NULL', state = 0 WHERE login_id =$id");
		        $update->execute();
		    }
		    elseif($state == 2){
		        $update = $dbh->query("UPDATE tbl_subscription SET plan = 'Annual Plan', expiry_date = '".$expiry2."', state = 0 WHERE login_id =$id");
		        $update->execute();
		    }
		    elseif($state == 1){
		        $update = $dbh->query("UPDATE tbl_subscription SET plan = 'Monthly Plan', expiry_date = '".$expiry."', state = 0 WHERE login_id =$id");
		        $update->execute();
		    }

		    $myResponse->status = "updated";

    		$myResponse->message = "Updated successfully";
    
    		$myResponse->data = $update;
		}

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Updates cannot be done at the moment. Please retry";

	}

	return json_encode($myResponse);

}




function newBlog()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$title = $_POST['title'];

		$content = $_POST['content'];

		$status = $_POST['status'];

		if (empty($title) || empty(strip_tags($content)) || empty($status)) {

			$myResponse->status = "failed";

			$myResponse->message = "Some required fields are missing";

			return json_encode($myResponse);

		}

		$stmt = $dbh->prepare("INSERT INTO tbl_blog_post(`title`,`content`,`status`) VALUES(:title,:content,:status)");

		$stmt->execute(array(

			":title" => $title,

			":content" => $content,

			":status" => $status

		));

		$myResponse->status = "success";

		$myResponse->message = "Blog posted successfully";

//		$myResponse->data = $rows;

		

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Blogs cannot be posted at the moment. Please retry";

	}

	return json_encode($myResponse);

}



function viewBlog()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$id = $_POST['id'];

		$rows = $dbh->query("select * from tbl_blog_post where id = {$id}")->fetch(PDO::FETCH_ASSOC);

		

		$myResponse->status = "success";

		$myResponse->message = "Blog post retrieved successfully";

		$myResponse->data = $rows;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Blogs cannot be retrieved at the moment. Please retry";

	}

	return json_encode($myResponse);

}



function updateBlog()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$title = $_POST['title'];

		$content = $_POST['content'];

		$status = $_POST['status'];

		if (empty($title) || empty(strip_tags($content)) || empty($status)) {

			$myResponse->status = "failed";

			$myResponse->message = "Some required fields are missing";

			return json_encode($myResponse);

		}

		$stmt = $dbh->prepare("update tbl_blog_post set `title` = :title ,`content` = :content,`status` = :status where id = {$_POST['id']}");

		$stmt->execute(array(

			":title" => $title,

			":content" => $content,

			":status" => $status

		));

		$myResponse->status = "success";

		$myResponse->message = "Blog updated successfully";

//		$myResponse->data = $rows;

		

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Blog cannot be updated at the moment. Please retry";

	}

	return json_encode($myResponse);

}



function newSubscription()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

//	$expiry;

	try {

		$plan = $_POST['plan'];

		if ($plan == 'Monthly Plan') {

			$expiry = date('Y-m-d', mktime(0, 0, 0, date("m") + 1, date("d") - 1, date("Y")));

		} else {

			$expiry = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y") + 1));

		}

		

		$dbh->exec("insert into tbl_subscription (login_id,plan,expiry_date) values({$_POST['member']},'{$plan}','{$expiry}')");

		

		$myResponse->status = "success";

		$myResponse->message = "Subscription added successfully";

		// $myResponse->data = $rows;

		

	} catch (PDOException $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Subscriptions cannot be added at the moment. Please retry";

		//$myResponse->message = $ex->getMessage();

	}

	return json_encode($myResponse);

}





function allSentInvites(){

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$sent = $dbh->query("select concat(firstname, ' ',lastname) as `sent_by`,sent_to,date_sent,count(sent_to) as count from tbl_invites join tbl_account_individual on tbl_invites.login_id = tbl_account_individual.login_id where sent_to not in (select email from tbl_account_individual) group by sent_to")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Records fetched successfully";

		$myResponse->data = $sent;

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Records fetching failed";

		return json_encode($myResponse);

	}

}



function resendAllInvites(){

	$response = new Response();

	$dbh = Database::getInstance();

	try{

		$mail = new PHPMailer;

		$mail->isSMTP();

		$mail->Host = 'pro-filr.com';

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'ssl';

		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead

		$mail->Port = 465;

		$mail->Username = 'subscription@pro-filr.com';

		$mail->Password = 'portFOLIO_2015';

		$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');

		$body = file_get_contents(DOCUMENT_ROOT . 'templates/Invitation/Invitation.html');



		$members = $dbh->query("select firstname,company,concat(firstname, ' ',lastname) as `name`,sent_to from tbl_invites join tbl_account_individual on tbl_invites.login_id = tbl_account_individual.login_id where sent_to not in (select email from tbl_account_individual) group by sent_to")->fetchAll(PDO::FETCH_ASSOC);



		// $members = $dbh->query("select firstname,company,concat(firstname, ' ',lastname) as `name`,email as sent_to from tbl_account_individual where email = 'oladesoye@yahoo.com'")->fetchAll(PDO::FETCH_ASSOC);

		

			$count = 0;

		foreach ($members as $key => $member) {

			$_name = $member['name'];

			$_company = $member['company'];

			$_firstname = ucfirst($member['firstname']);

			$salutation = "<span style='font-weight:bold;'>".strtoupper($_name)."</span>";

			if(!empty($_company)){

				$salutation .= " from ".strtoupper($_company);

			}

			



			$subject = "You have received an invite from " . $_name;

			$body = str_replace("___First Name and Last Name___", $salutation, $body);

			$body = str_replace("___First Name___", $_firstname, $body);

			$mail->msgHTML($body);

			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

			$response = sendNotification($member['sent_to'],$subject,$body);



			if($response){

				$count += 1;

			}

		}

		$myResponse->status = "success";

		$myResponse->message = "A total of {$count} Invitation(s) sent";

		return json_encode($myResponse);



	}catch(Exception $ex){

		$myResponse->status = "failed ".$ex->getMessage();

		$myResponse->message = "Email notifications cannot be sent at the moment. Please retry";

		return json_encode($myResponse);



	}



}

