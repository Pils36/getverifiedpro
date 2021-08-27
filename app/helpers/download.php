<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 04/04/2018
 * Time: 03:10 AM
 */


require_once '../app/Models/Message.php';
require_once '../app/Core/Response.php';

function downloadMessage()
{
	$data_id = $_GET['data_id'];
	$message_type = $_GET['type'];
	
	$g = new Message();
	$myResponse = new Response();
	
	if (empty($_GET['data_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select an item";
		return json_encode($myResponse);
	}
	
	try {
		if ($message_type === 'group') {
			$groupMessages = $g->getGroupMessages($data_id);
		} elseif ($message_type === 'project') {
			$groupMessages = $g->getProjectMessages($data_id);
		}
		
		$data = '';
		if (!empty($groupMessages)) {
			foreach ($groupMessages as $message) {
				$data .= $message['firstname'] . " " . $message['lastname'] . ": " . $message['content'] . " | " . $message['date_sent'] . ".";
				$data .= "\n\n";
			}
		}
		
		if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE) {
			header('Content-Type: "application/octet-stream"');
			header('Content-Disposition: attachment; filename="MessageBackup.txt"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
			header("Content-Length: " . strlen($data));
		} else {
			header('Content-Type: "application/octet-stream"');
			header('Content-Disposition: attachment; filename="MessageBackup.txt"');
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
			header("Content-Length: " . strlen($data));
		}
		
		exit($data);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

