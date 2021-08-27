<?php

// require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

define ('SITE_ROOT', realpath(dirname(__FILE__)));

// require_once '../app/Models/Database.php';
require_once '../app/Core/Database.php';
require_once '../app/Models/AccountIndividual.php';
require_once '../app/Core/Response.php';

function sentInvites()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$rows = $dbh->query("select id,max(date_sent) as date_sent,sent_to from tbl_invites where login_id = {$_SESSION['login_id']} group by sent_to order by date_sent desc")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Sent invites received successfully";
		
		$myResponse->count = count($rows);

		$myResponse->data = $rows;

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Sent invites cannot be retrived at this time. Please Retry";

	}

	return json_encode($myResponse);

}







function sendManual()

{

	// var_dump($_POST);

	$mail = new PHPMailer;

	$dbh = Database::getInstance();

	$myResponse = new Response();

	$body = file_get_contents(DOCUMENT_ROOT . 'templates/Invitation/Invitation.html');

	try {

		//get login name

		$member = $dbh->query("select concat(firstname,' ',lastname) as `name`,firstname,company, photo from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);

		$_name = $member['name'];

		$_company = $member['company'];
		
		$photo = $member['photo'];
		

			$_firstname = ucfirst($member['firstname']);

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

		$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr');
// 		$mail->setFrom('info@pro-executes.com', 'Pro-Filr');

		// $mail->addReplyTo('subscription@pro-filr.com', 'Pro-Filr.com');

		$mail->Subject = "You have received an invite from " . $_name;
		
		$mail->AddEmbeddedImage("../assets/resources/pics/".$photo, "photo");

		$body = str_replace("___First Name and Last Name___", $salutation, $body);
                
                
				$body = str_replace("___First Name___", $_firstname, $body);

				

		$mail->msgHTML($body);

		//msgHTML also sets AltBody, but if you want a custom one, set it afterwards

		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

		

		$emails = rtrim($_POST['emails'], ",");

		

		$emails = explode(",", $emails);

		$count = 0;

		mail("adenugaadebambo41@gmail.com", "Hello", "Try Pro-Filr");

		

		foreach ($emails as $key => $email) {

			

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$mail->clearAllRecipients();

				$mail->addAddress($email);

				if (!$mail->send()) {

					// echo $mail->ErrorInfo;

					echo "Mailer Error (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . '<br />';

					break; //Abandon sending

				} else {

					//echo "Message sent to :" . $row['full_name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';

					//insert into tbl_inivites

					// echo "insert into tbl_invites(login_id,sent_to) values (:id,:to)";

					$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to) VALUES (:id,:to)");

					$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $email));

					$count = $count + 1;

					

				}

			}

		}

		if ($count < 1) {

			$myResponse->status = "failed";

			$myResponse->message = "Invites cannot be sent at this time. Please Retry";

		} else {

			$myResponse->status = "success";

			$myResponse->message = "Invites sent successfully";

		}

		

		$myResponse->data = $member;

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Invites cannot be sent at this time. Please Retry";

	}

	return json_encode($myResponse);

}





function sendCSV(){

	//save file

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try{

		//if file is file has valid extention and mime type

		if(!empty($_FILES['file']['name'])){ //file upload successfull

			// verify extension and filetype

			$validExtensions = array("xls","xlsx");

			$validTypes = array("application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");



			$temporary = explode(".", $_FILES["file"]["name"]);

			$fileExtension = end($temporary);

			$fileType = $_FILES['file']['type'];



			if(!in_array($fileType, $validTypes) || !in_array($fileExtension, $validExtensions) || $_FILES["file"]["size"] > 10000000){

				// invalid file uploaded. return

				$myResponse->status = "failed";

				$myResponse->message = "Invalid file format selected";

				return json_encode($myResponse);

			}

			//valid file start proceessing

			include "PHPExcel/Classes/PHPExcel/IOFactory.php";

			$inputFileName = SITE_ROOT.'/uploads/' . $_FILES['file']['name'];	

			move_uploaded_file($_FILES['file']['tmp_name'],$inputFileName);

			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

			$objReader = PHPExcel_IOFactory::createReader($inputFileType);

			$objPHPExcel = $objReader->load($inputFileName);

			$data = array(1,$objPHPExcel->getActiveSheet()->toArray(null,true,true,true));

			//echo "<pre>".print_r($data)."</pre>";

			//send emails

			$mail = new PHPMailer;

			$body = file_get_contents(DOCUMENT_ROOT . 'templates/Invitation/Invitation.html');

			$salutation = $_name = $_company = $_firstname = "";

			if(!empty($_SESSION['admin_login']) && $_SESSION['admin_login']=='admin'){

				$_name = "Pro-Filr";

				$salutation = "Adebiyi Olusegun, FCA";

				$_firstname = "Olusegun";

			}else{

				$member = $dbh->query("select concat(firstname,' ',lastname) as `name`,firstname,company from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);

				$_name = $member['name'];

				$_company = $member['company'];

				$_firstname = ucfirst($member['firstname']);

				$salutation = "<span style='font-weight:bold;'>".strtoupper($_name)."</span>";

				if(!empty($_company)){

					$salutation .= " from ".strtoupper($_company);

				}

			}



				$mail->isSMTP();

				

				$mail->Host = 'pro-filr.com';

				$mail->SMTPAuth = true;

				$mail->SMTPSecure = 'ssl';

				$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead

				$mail->Port = 465;

				$mail->Username = 'subscription@pro-filr.com';

				$mail->Password = 'portFOLIO_2015';

				$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');

				//$mail->addReplyTo('subscription@pro-filr.com', 'Pro-Filr.com');

				$mail->Subject = "You have received an invite from " . $_name;

				$body = str_replace("___First Name and Last Name___", $salutation, $body);

				$body = str_replace("___First Name___", $_firstname, $body);

				$mail->msgHTML($body);

				//msgHTML also sets AltBody, but if you want a custom one, set it afterwards

				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';





			

			//echo $body;

			foreach ($data[1] as $key => $column) {

				//echo $column['A']."<br />";

				# code...

				$mail->clearAllRecipients();

					$mail->addAddress($column['A']);

					if (!$mail->send()) {

						//echo $mail->ErrorInfo;

						// echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';

						break; //Abandon sending

					} else {

						

						$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to) VALUES (:id,:to)");

						if(!empty($_SESSION['login_id'])){

							$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $column['A']));

						}else{

							$stmt->execute(array(":id" => "1234567890", ":to" => $column['A']));

						}

						$count = $count + 1;

					}

			}

			unlink($inputFileName);

			$myResponse->status = "success";

			$myResponse->message = "File imported and invites sent successfully";

			return json_encode($myResponse);

		}else{//file upload failed

			$myResponse->status = "failed";

			$myResponse->message = "File upload failed";

			return json_encode($myResponse);

		}

		

	}catch(Exception $ex){

		$myResponse->status = "failed";

		$myResponse->message = "The following error occured: ".$ex->getMesssage();

		return json_encode($myResponse);

	}



				



}



function sendCSV_()

{

	$dbh = Database::getInstance();

	$myResponse = new Response();

	try {

		$filename = $_FILES["file"]["tmp_name"];

		$tem = file_get_contents($filename);

		$tem = preg_replace('~\R~u', "\n", $tem);

		file_put_contents($filename, $tem);

		if (isset($_FILES["file"]["type"])) {

			$validextensions = array("csv");

			$temporary = explode(".", $_FILES["file"]["name"]);

			$file_extension = end($temporary);

			

			if ($_FILES["file"]["type"] == "text/csv" && $_FILES["file"]["size"] < 10000000 && in_array($file_extension, $validextensions)) { //valid file proceed

				$file = fopen($filename, "r");

				$mail = new PHPMailer;

				$body = file_get_contents(DOCUMENT_ROOT . 'templates/Invitation/Invitation.html');

				$member = $dbh->query("select concat(firstname,' ',lastname) as `name` from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);

				$_name = $member['name'];

				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

				//$mail->SMTPDebug = 2;

				$mail->isSMTP();

				

				$mail->Host = 'pro-filr.com';

				$mail->SMTPAuth = true;

				$mail->SMTPSecure = 'ssl';

				$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead

				$mail->Port = 465;

				$mail->Username = 'subscription@pro-filr.com';

				$mail->Password = 'portFOLIO_2015';

				$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');

				//$mail->addReplyTo('subscription@pro-filr.com', 'Pro-Filr.com');

				$mail->Subject = "You have received an invite from " . $_name;

				$mail->msgHTML($body);

				//msgHTML also sets AltBody, but if you want a custom one, set it afterwards

				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

				$count = 0;

				while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

					//echo $getData[0];

					$mail->clearAllRecipients();

					$mail->addAddress($getData[0]);

					if (!$mail->send()) {

						//echo $mail->ErrorInfo;

						// echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';

						break; //Abandon sending

					} else {

						

						$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to) VALUES (:id,:to)");

						$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $getData[0]));

						$count = $count + 1;

					}

					

				}

				

				fclose($file);

				if (!$count) {

					$myResponse->status = "failed";

					$myResponse->message = "Invites cannot be sent at this time. Please Retry";

				} else {

					$myResponse->status = "success";

					$myResponse->message = "File imported and invites sent successfully";

				}

				

				//$myResponse->data = $rows;

				

			} else { //invalid file format

				$myResponse->status = "failed";

				$myResponse->message = "Invalid file format selected";

			}

			

		}

	} catch (Exception $ex) {

		//echo $ex->message();

		$myResponse->status = "failed";

		$myResponse->message = "Invites cannot be sent at this time. Please Retry";

	}

	return json_encode($myResponse);

}


// Fetch Resend Invites
function fetchresendInvites(){
    $response = new Response();

	$dbh = Database::getInstance();
	
	try {

		$rows = $dbh->query("select distinct(sent_to) as sent_to from tbl_invites where login_id = {$_SESSION['login_id']} and sent_to not in (select email from tbl_account_individual)")->fetchAll(PDO::FETCH_ASSOC);

		$myResponse->status = "success";

		$myResponse->message = "Sent invites received successfully";
		
		$myResponse->count = count($rows);

		$myResponse->data = $rows;

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Sent invites cannot be retrived at this time. Please Retry";

	}

	return json_encode($myResponse);
}


function resendInvites(){

	$response = new Response();

	$dbh = Database::getInstance();

	try {

		$mail = new PHPMailer;

		$body = file_get_contents(DOCUMENT_ROOT . 'templates/Invitation/Invitation.html');



		$member = $dbh->query("select company,photo,firstname,concat(firstname,' ',lastname) as `name` from tbl_account_individual where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);



		$_name = $member['name'];

		$_company = $member['company'];
		
        $photo = $member['photo'];


		$_firstname = ucfirst($member['firstname']);

		$salutation = "<span style='font-weight:bold;'>".strtoupper($_name)."</span>";


		if(!empty($_company)){

			$salutation .= " from ".strtoupper($_company);

		}



		$mail->isSMTP();

		$mail->Host = 'pro-filr.com';

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'ssl';

		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead

		$mail->Port = 465;

		$mail->Username = 'subscription@pro-filr.com';

		$mail->Password = 'portFOLIO_2015';

		$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');

		$mail->Subject = "You have received an invite from " . $_name;
		
		$mail->AddEmbeddedImage("../assets/resources/pics/".$photo, "photo");


		$body = str_replace("___First Name and Last Name___", $salutation, $body);

		$body = str_replace("___First Name___", $_firstname, $body);
		
		

		$mail->msgHTML($body);

		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

		//echo "select * from tbl_invites where login_id = {$_SESSION['login_id']} and sent_to not in (select email from tbl_account_individual)";

		$recipients = $dbh->query("select distinct(sent_to) as sent_to from tbl_invites where login_id = {$_SESSION['login_id']} and sent_to not in (select email from tbl_account_individual)")->fetchAll(PDO::FETCH_ASSOC);

		//var_dump($recipients);



		$count = 0;

		foreach ($recipients as $key => $recipient) {

			$mail->clearAllRecipients();

			//echo $recipient['sent_to'];

			$mail->addAddress($recipient['sent_to']);

			if (!$mail->send()) {

				//echo $mail->ErrorInfo;
				
				$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to,state) VALUES (:id,:to,:state)");

				$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $recipient['sent_to'], ":state" => 0));
				
				$count = $count + 1;

				// break; //Abandon sending

			} else {

				

				$stmt = $dbh->prepare("INSERT INTO tbl_invites(login_id,sent_to,state) VALUES (:id,:to,:state)");

				$stmt->execute(array(":id" => $_SESSION['login_id'], ":to" => $recipient['sent_to'], ":state" => 1));

				$count = $count + 1;

			}

		}

		$myResponse->status = "success";

		$myResponse->message = $count. " re-invite(s) sent successfully";
		
		$myResponse->count = $count;
		

		return json_encode($myResponse);



	} catch (Exception $e) {

		$myResponse->status = "failed";

		$myResponse->message = "An error occured while sending re-invites. Please try later.";

		return json_encode($myResponse);

		

	}

}





