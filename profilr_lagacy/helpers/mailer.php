<?php
require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

function sendVerifyEmail($to, $link)
{
	$mail = new PHPMailer;
	$mail->isSMTP();
	// $mail->Host = 'mail.pro-filr.com';  
	$mail->Host = 'pro-filr.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = 'subscription@pro-filr.com';
	//$mail->Username = 'laloye.adesoye@gitlimited.com';  
	$mail->Password = 'portFOLIO_2015';
	//$mail->Password = 'proxy_git2007'; 
	// $mail->Port = 587;
	$mail->Port = 465;
	// $mail->setFrom('info@pro-filr.com', 'info@pro-filr.com');
	$mail->setFrom('subscription@pro-filr.com', 'subscription@pro-filr.com');
	$mail->addAddress($to);
	$mail->isHTML(true);
	//$mail->addReplyTo('info@pro-filr.com', 'Information');
	$mail->Subject = "Welcome To Pro-Filr Confirm Your Email";
	$mail->Body = "<h4>Thank you for signing up on Pro-Filr</h4>Please click <a href='$link'>here</a> to verify your email address and to proceed with the sign-up process. <br/> Note that this link will expire in 3 hours";
	$mail->AltBody = "Thank you for signing up on Pro-Filr.\n\r Please visit $link to verify your email address and to proceed with the sign-up process.\n\r Note that link expiries in 3 hours";
	if (!$mail->send()) {
		return "Application error. Please retry";
		
	} else {
		return "A verification email has been sent to you";
	}
}


function sendEmail($subject, $from, $to, $body)
{
	$mail = new PHPMailer;
	$mail->isSMTP();
	
	$mail->Host = 'mail.pro-filr.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'subscription@pro-filr.com';
	
	$mail->Password = 'portFOLIO_2015';
	
	$mail->Port = 25;
	
	$mail->setFrom('support@pro-filr.com', 'support@pro-filr.com');
	$mail->addAddress($to);
	$mail->isHTML(true);
	
	$mail->Subject = $subject;
	$mail->Body = $body;
	//$mail->AltBody = "Thank you for signing up on Pro-Filr.\n\r Please visit $link to verify your email address and to proceed with the sign-up process.\n\r Note that link expiries in 3 hours";
	//var_dump($mail);
	if (!$mail->send()) {
		//return $mail->ErrorInfo;
		return 0;
	} else {
		return 1;
	}
}


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

// Set mailer to use SMTP
// Specify main and backup SMTP servers
// Enable SMTP authentication
// SMTP username
// SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
// TCP port to connect to

// $mail->isSMTP();
// $mail->Host = 'mail.pro-filr.com';
// $mail->Port = 25;
// $mail->SMTPAuth = false;
// $mail->SMTPSecure = false;


// Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional

//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
// Set email format to HTML


?>