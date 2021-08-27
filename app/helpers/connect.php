<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 03/04/2018
 * Time: 05:59 PM
 */

require_once '../app/Models/Connection.php';
require_once '../app/Core/Response.php';

function fetchConnections()
{
	$c = new Connection();
	$myResponse = new Response();
	$type = $_POST['type'];
	$member = $_SESSION['login_id'];
	
	try {
		if ($type == "connected") {
			$result = $c->getMyConnections($member);
		} else {
			$result = $c->getConnectionSuggestions($member);
		}
		//echo $query.$limitStr;
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $result;
		return json_encode($myResponse);
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function newConnection(){
    
	$c = new Connection();
	$myResponse = new Response();
	try {
		$result = $c->createConnection($_SESSION['login_id'],$_POST['member']);
      
        $info = $_POST['info'];
        $sender = $_POST['sender'];
         // Mail
    		 
            $to = $info;
            // $to = "bambo.adenuga@pro-filr.com";
            $subject = "Someone just added you to their connection on Pro-filr";
            
            $message = "<html><head><title>Connection Added</title></head><body><div><img src='https://www.pro-filr.com/assets/images/prologo.png' style='width:100%; height:100px'></div><div style='padding: 10px;'><p>Hi,</p> <p>You have a new connection.</p><p> <span style='font-weight: bold; text-transform: uppercase'>$sender</span> just added you to connection on Pro-filr.<p>Click <a href='https://www.pro-filr.com/invites'>here</a> to view your connections</p></div></body></html>";
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
            // $headers .= 'Cc: bambo.adenuga@pro-filr.com' . "\r\n";
            
            mail($to,$subject,$message,$headers);
        

		
		//echo $query.$limitStr;
		$myResponse->status = "success";
		$myResponse->message = "Connection created successfully";
		$myResponse->data = $result;
		return json_encode($myResponse);
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

// function notifyConnection($recipient_id){
// 	$a = new AccountIndividual;
// 	$recipient = $a->fetchMember($recipient_id);
// 	$sender = $a->fetchMember($_SESSION['login_id']);
// 	$subject = 


// }