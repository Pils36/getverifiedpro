<?php
//create new account
function signUp($dbh)
{
	//check is email is already signed up and if verified
	
	$message = new response();
	
	if ($_POST['email'] == "") {
		$message->status = "success";
		$message->data = array("response" => "Please enter a valid email address");
		return json_encode($message);
		
	}
	
	if ($_POST['password'] == "") {
		$message->status = "success";
		$message->data = array("response" => "Please use a password");
		return json_encode($message);
		
	}
	
	if ($_POST['profession'] == "" || $_POST['industry'] == "" || $_POST['city'] == "" || $_POST['country'] == "") {
		$message->status = "success";
		$message->data = array("response" => "Some required fields are missing");
		return json_encode($message);
		
	}
	
	$stmt = $dbh->prepare("SELECT * FROM tbl_login WHERE email =:email");
	$stmt->execute(array("email" => $_POST['email']));
	$row_count = $stmt->rowCount();
	//return $row_count;
	if ($row_count > 0) {
		$message->status = "success";
		$message->data = array("response" => "This email has already been used");
		return json_encode($message);
		
	} else {
		$link = verifyLinkGenerator($_POST['email']);
		//insert into tbl_login table
		// $acctType = "";
		// switch ($_POST['type']) {
		//   		case "1" : $acctType = 'individual'; break;
		//   		case "2" : $acctType = 'company'; break;
		//   		default : $acctType = ''; break;
		// }
		
		try {
			$dbh->beginTransaction();
			$stmt = $dbh->prepare("INSERT INTO tbl_login(`username`,`password`,`date_created`,`email`,`verification_link`,`account_type`) VALUES (:username,:password,now(),:email,:link,:type)");
			$stmt->execute(array(
				":username" => $_POST['email'],
				":password" => md5($_POST['password']),
				":email" => $_POST['email'],
				":link" => $link,
				":type" => $acctType
			));
			$insertId = $dbh->lastInsertId();
			//insert into tbl_account table
			//if($_POST['type'] == 1){
			$stmt = $dbh->prepare("INSERT INTO tbl_account_individual(login_id,lastname,firstname,email,type_id,company,profession,industry,country,city) VALUES(:id,:lastname,:firstname,:email,:type,:company,:prof,:ind,:count,:city)");
			$stmt->execute(array(
				":id" => $insertId,
				":firstname" => $_POST['firstname'],
				":lastname" => $_POST['lastname'],
				":email" => $_POST['email'],
				":type" => "1",
				":company" => $_POST['company'],
				":prof" => $_POST['profession'],
				":ind" => $_POST['industry'],
				":count" => $_POST['country'],
				":city" => $_POST['city']
			));
			
			$stmt = $dbh->prepare("INSERT INTO tbl_subscription(login_id,plan,subscription_date) VALUES(:id,:plan,:sub_date)");
			$stmt->execute(array(
				":id" => $insertId,
				":plan" => "1",
				":sub_date" => date("Y-m-d H:i:s")
			));
			
			// }else{
			// 	$stmt=$dbh->prepare("insert into tbl_company(company_name,login_id) values(:name,:id)");
			// 	$stmt->execute(array(
			// 		":name"=>$_POST['business'],
			// 		":id"=>$insertId
			// 		));
			// 	$companyID = $dbh->lastInsertId();
			// 	$stmt = $dbh->prepare("insert into tbl_account_company(login_id,lastname,firstname,email,type_id,company_id) values(:id,:lastname,:firstname,:email,:type,:comp)");
			// 	$stmt->execute(array(
			// 		":id"=>$insertId,
			// 		":firstname"=>$_POST['firstname'],
			// 		":lastname"=>$_POST['lastname'],
			// 		":email"=>$_POST['email'],
			// 		":type"=>$_POST['type'],
			// 		":comp"=> $companyID 
			// 		));
			// }
			
			//$dbh->exec("insert into tbl_account(account_id) values($insertId)");
			
			// //insert into tbl_profile table
			// $stmt = $dbh->prepare("insert into tbl_profile(account_id,firstname,lastname,email) values(:id,:firstname,:lastname,:email)");
			// $stmt->execute(array(
			// 	":id"=>$insertId,
			// 	"firstname"=>$_POST['firstname'],
			// 	"lastname"=>$_POST['lastname'],
			// 	"email"=>$_POST['email']
			// 	));
			$dbh->commit();
			$response = sendVerifyEmail($_POST['email'], $link);
			$message->status = "success";
			$message->data = array("response" => $response);
			return json_encode($message);
		} catch (PDOException $ex) {
			$dbh->rollBack();
			$myMessage = new response("error", array(), $ex->getMessage());
			return json_encode($message);
		}
	}
}

function resendVerification($dbh)
{
	
}

function verifyEmail($dbh)
{
	$message = new response();
	
	$link = $_POST['link'];
	$link = "http://pro-filr.com/pages/verifyemail.php?link=" . $link;
	//$link = "http://localhost/profilr/pages/verifyemail.php?link=".$link;
	try {
		$dbh->beginTransaction();
		$stmt = $dbh->prepare("UPDATE tbl_login SET verification_date = now() WHERE verification_link = :link");
		$stmt->execute(array(
			":link" => $link
		));
		$affected_rows = $stmt->rowCount();
		if ($affected_rows < 1) {
			$message->status = "success";
			$message->data = array("response" => "This link is no longer valid. Please <a class='nav_link' data-page='index' data-view='signup'>signup</a> again to receive a fresh email verification link");
			return json_encode($message);
		}
		
		$lastInsertId = $dbh->lastInsertId();
		//$dbh->exec("update tbl_account set email_verified = 1, date_verified=now() where  acoount_id=$lastInsertId");
		$dbh->commit();
		$message->status = "success";
		$message->data = array("response" => "<h3>Your email was successfully verified.</h3> Please <a class='nav_link' data-page='index' data-view='login' href='login.php'>login</a> to complete your profile");
		//send welcome email
		$resp = sendWelcome($dbh, $link);
		
		return json_encode($message);
	} catch (PDOException $ex) {
		$dbh->rollback();
		$message->status = "error";
		$message->message = $ex->getMessage();
	}
	
}

function verifyLinkGenerator($email)
{
	//$link = password_hash($email.date('Y-m-d H:i:s'),PASSWORD_DEFAULT);
	$link = md5($email . date('Y-m-d H:i:s'));
	//return "http://pro-filr.com/verifyemail.html?link=$link";
	return "http://pro-filr.com/pages/verifyemail.php?link=$link";
	
}


function sendWelcome($dbh, $link)
{
	//return $link;
	$stmt = $dbh->prepare("SELECT upper(firstname) AS firstname,upper(lastname) AS lastname,tbl_account_individual.email AS email FROM tbl_login JOIN tbl_account_individual ON tbl_login.login_id = tbl_account_individual.login_id WHERE verification_link =:link ");
	
	$stmt->execute(array(":link" => $link));
	$count = $stmt->rowCount();
	if (!$count) {
		return;
	}
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$name = $row['firstname'] . " " . $row['lastname'];
	$email = $row['email'];
	$body = file_get_contents('templates/Welcome/Welcome.html');
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
	$mail->Subject = $name . ", welcome to Pro-Filr!";
	$mail->msgHTML($body);
	$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$mail->addAddress($email);
		if (!$mail->send()) {
			return "Sending failed";
		} else {
			return "Email sent";
			
		}
	} else {
		return "Invalid email";
	}
}

?>