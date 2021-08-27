<?php

define ('LOGS', realpath(dirname(__FILE__)));

function sendNotification($email,$subject,$body){
	$mail = new PHPMailer;
	$myResponse = new Response();
	$mail->isSMTP();		
	$mail->Host = 'pro-filr.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
	$mail->Port = 465;
	$mail->Username = 'subscription@pro-filr.com';
	$mail->Password = 'portFOLIO_2015';
	$mail->setFrom('subscription@pro-filr.com', 'Pro-Filr.com');
	$mail->Subject = $subject;
	$mail->msgHTML($body);
	$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; 
	$mail->clearAllRecipients();
	$mail->addAddress($email);
	if(!$mail->send()){
		//log error and return failed
		file_put_contents(LOGS."/logs/email.log","\r\n ".date("Y-m-d H:i:s",time())." | Email: ".$email." | Subject: ".$subject." | Error: ".$mail->ErrorInfo,FILE_APPEND);
		return 0; 
	}else{
		//log mail sent successfully
		file_put_contents(LOGS."/logs/email.log","\r\n ".date("Y-m-d H:i:s",time())." | Email: ".$email." | Subject: ".$subject." | Email sent successfully ",FILE_APPEND);
		return 1; 
	}

}

?>