<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 12/04/2018
 * Time: 05:17 PM
 */

// can be where all emails are sent


require_once '../app/Models/EmailTemplate.php';
require_once '../app/Models/AccountIndividual.php';
require_once '../app/Core/Response.php';

function saveAdminEmails()
{
	$e = new EmailTemplate();
	$myResponse = new Response();
	
	try {
		$subject = $_POST['subject'];
		$template_content = $_POST['template_content'];
		$message = $_POST['message'];
		$test_email = $_POST['test_email'];
		
		if(empty($subject) || empty($message)){
			$myResponse->status = "failed";
			$myResponse->message = 'Empty Content Not Allowed';
			return json_encode($myResponse);
		}
		if($template_content){
			$e->edit($template_content, $subject, $message);
		}else{
			$e->create($subject, $message);
		}
		
		$message = '<!DOCTYPE html><head></head><title></title><body>'.$message.'</body></html>';
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
		$mail->msgHTML($message);
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->Subject = $subject;
		$mail->AddAddress($test_email);
		
		
		$mail->send();
		
		$myResponse->status = "success";
		$myResponse->message = "Saved and Sent to Test Email successfully";

		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function sendAdminEmails()
{
	$a = new AccountIndividual();
	$e = new EmailTemplate();
	$myResponse = new Response();
	
	try {
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$test_email = $_POST['test_email'];
		$template_content = $_POST['template_content'];
		
		if(empty($subject) || empty($message)){
			$myResponse->status = "failed";
			$myResponse->message = 'Empty Content Not Allowed';
			return json_encode($myResponse);
		}
		
		if($template_content){
			$e->edit($template_content, $subject, $message);
		}else{
			$e->create($subject, $message);
		}
		
		$message = '<!DOCTYPE html><head></head><title></title><body>'.$message.'</body></html>';
		
		$user_group = $_POST['user_group'];
		$email_verify = $_POST['email_verify'];
		$country = $_POST['country'];
		$min_profile_views = $_POST['min_profile_views'];
		$max_profile_views = $_POST['max_profile_views'];
		
		$filter_by = [
			'user_group' => $user_group,
			'email_verify' => $email_verify,
			'country' => $country,
			'min_profile_views' => $min_profile_views,
			'max_profile_views' => $max_profile_views,
		];
		
		$emails = $a->getFilteredUserEmails($filter_by);
		
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
		$mail->msgHTML($message);
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->Subject = $subject;
		
		if(!empty($emails)){
			$mail->AddAddress($test_email); // send the mail to the test
			foreach ($emails as $email){
				$mail->AddBCC($email);
			}
		}
		$mail->send();
		$mail->ClearAllRecipients();
		
		$myResponse->status = "success";
		$myResponse->message = "Sent successfully";
//		$myResponse->data = $emails;
		return json_encode($myResponse);
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function getEmailTemplates()
{
	$e = new EmailTemplate();
	$myResponse = new Response();
	try {
		$result = $e->getEmailTemplates();
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $result;
		return json_encode($myResponse);
	}catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function fetchEmailTemplate()
{
	$e = new EmailTemplate();
	$myResponse = new Response();
	try {
		$result = $e->getAnEmailTemplate($_POST['template_id']);
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $result;
		return json_encode($myResponse);
	}catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function removeEmail() 
{
	$g = new EmailTemplate();
	$myResponse = new Response();
	try {
		$emails = $g->deleteEmail($_POST['email_id']);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $emails;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}