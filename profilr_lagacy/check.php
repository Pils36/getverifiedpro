<?php
include "vendor/phpmailer/phpmailer/PHPMailerAutoload.php";

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "pro-filr.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "subscription@pro-filr.com";
$mail->Password = "portFOLIO_2015";
$mail->SetFrom("subscription@pro-filr.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("oladesoye@gmail.com");

if (!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo "Message has been sent";
}


?>