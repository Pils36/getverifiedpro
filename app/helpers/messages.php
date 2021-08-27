<?php
function getMessages()
{
	// var_dump($_POST);
	$dbh = Database::getInstance();
	$myResponse = new Response();
	$query = "";
	try {
		$result = getSubscription($_SESSION['login_id']);
		if(!$result['active']){
			$myResponse->status = "inactive";
			$myResponse->message = "This feature is available to paid subscriptions only. Please upgrade your account";
			return json_encode($myResponse);
		}
		switch ($_POST['type']) {
			case 'inbox':
				$query = "select tbl_message.*,upper(concat(firstname,' ',lastname)) as `member` from tbl_message 
							join tbl_account_individual on tbl_message.sent_by = tbl_account_individual.login_id where sent_to = {$_SESSION['login_id']} ORDER BY date_sent desc";
				break;
			case 'sent':
				$query = "select tbl_message.*,upper(concat(firstname,' ',lastname)) as `member` from tbl_message 
							join tbl_account_individual on tbl_message.sent_to = tbl_account_individual.login_id where sent_by = {$_SESSION['login_id']} ORDER BY date_sent desc";
				break;
			default:
				# code...
				break;
			
		}
		// echo $query;
		$rows = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Messages retrieved successfully";
		$myResponse->data = $rows;
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "Messages not available this time. Please retry";
		return json_encode($myResponse);
		
	}
	
}

function readMessage()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
	try {
		$query = "select *,(select concat(firstname,' ',lastname) from tbl_account_individual where login_id = tbl_message.sent_by) as sentBy,(select concat(firstname,' ',lastname) from tbl_account_individual where login_id = tbl_message.sent_to) as sentTo from tbl_message where id = {$_POST['id']}";
		$rows = $dbh->query($query)->fetch(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Messages retrieved successfully";
		$myResponse->data = $rows;
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "Messages not available this time. Please retry";
		return json_encode($myResponse);
		
	}
}

function sendMessageRevised()
{
	$m = new Message();
	$myResponse = new Response();
	$member = $_SESSION['login_id'];
	
	if (empty($_POST['message']) && empty($_POST['attached_files'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please enter a message";
		return json_encode($myResponse);
	}
	if (empty($_POST['sent_to'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select a receiver";
		return json_encode($myResponse);
	}
	try {
		$attached_files = $_POST['attached_files'];
		if (!empty($attached_files)) {
			foreach ($attached_files as $file) {
				// todo come and use google url shortener
				$message = 'sent an attachment <a style="color: black" href="' . APP_DOMAIN . 'assets/resources/msg_attachments/' . $file . '" target="_blank">View</a>';
				$m->createFile($file, $_POST['sent_to'], $_POST['message_type']);
				$insertId = $m->create($member, $_POST['sent_to'], $message, $_POST['message_type']);
			}
		} else {
			$subject =  !empty($_POST['message_type']) ? $_POST['message_type'] : '';
			$insertId = $m->create($member, $_POST['sent_to'], $_POST['message'], $_POST['message_type'], $subject);
		}
		$myResponse->status = "success";
		$myResponse->message = "Message Sent Successfully";
		$myResponse->data = ['message_id' => $insertId];
		return json_encode($myResponse);
	} catch (PDOException $ex) {
		$myResponse = new Response("error", array(), $ex->getMessage());
		return json_encode($myResponse);
	}
}

function uploadFileAttachment()
{
	$myResponse = new Response();
	$path = DOCUMENT_ROOT . 'assets/resources/msg_attachments/';
	
	try {
		$file_array = $_FILES['attachment'];
		
		if (!$file_array['error']) {
			$filename = $file_array['name'];
			$filepath = $path . $filename;
			move_uploaded_file($file_array['tmp_name'], $filepath);
			
			$myResponse->status = "success";
			$myResponse->message = "File Uploaded";
			$myResponse->data = $filename;
			return json_encode($myResponse);
		} else {
			$myResponse->status = "error";
			$myResponse->message = "File Not Uploaded";
			return json_encode($myResponse);
		}
	} catch (Exception $ex) {
		$myResponse = new Response("error", array(), $ex->getMessage());
		return json_encode($myResponse);
	}
}


function getProjectMessages()
{
	$g = new Message();
	$myResponse = new Response();
	
	if (empty($_POST['project_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select a project";
		return json_encode($myResponse);
	}
	
	$myResponse = new Response();
	try {
		$groupMessages = $g->getProjectMessages($_POST['project_id']);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groupMessages;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function getProjectFiles()
{
	$g = new Message();
	$myResponse = new Response();
	
	if (empty($_POST['project_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select a project";
		return json_encode($myResponse);
	}
	
	$myResponse = new Response();
	try {
		$groupMessages = $g->getProjectFiles($_POST['project_id']);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groupMessages;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function getGroupMessages()
{
	$g = new Message();
	$myResponse = new Response();
	
	if (empty($_POST['group_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select a group";
		return json_encode($myResponse);
	}
	
	$myResponse = new Response();
	try {
		$groupMessages = $g->getGroupMessages($_POST['group_id']);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groupMessages;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function getGroupFiles()
{
	$g = new Message();
	$myResponse = new Response();
	
	if (empty($_POST['group_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select a group";
		return json_encode($myResponse);
	}
	
	$myResponse = new Response();
	try {
		$groupMessages = $g->getGroupFiles($_POST['group_id']);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groupMessages;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}