<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 23/03/2018
 * Time: 10:50 AM
 */

require_once '../app/Models/Group.php';
require_once '../app/Models/AccountIndividual.php';
require_once '../app/Core/Response.php';

function createGroup()
{
	$g = new Group();
	$myResponse = new Response();
	$member = $_SESSION['login_id'];
	$result = getSubscription($_SESSION['login_id']);
		if(!$result['active']){
			$myResponse->status = "inactive";
			$myResponse->message = "This feature is available to paid subscriptions only. Please upgrade your account";
			return json_encode($myResponse);
		}
	if (empty($_POST['title'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please enter a valid title";
		return json_encode($myResponse);
	}
	
	try {
		$insertId = $g->create($_POST['title'], $member);
		$g->createGroupMember($insertId, $member);
		
		$myResponse->status = "success";
		$myResponse->message = "Group Created Successfully";
		$myResponse->data = ['group_id' => $insertId];
		return json_encode($myResponse);
	} catch (PDOException $ex) {
		$myResponse = new Response("error", array(), $ex->getMessage());
		return json_encode($myResponse);
	}
}

function addMembers()
{
	$g = new Group();
	$myResponse = new Response();
	$group_id = $_POST['group_id'];
	
	if (empty($_POST['members_login_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select members";
		return json_encode($myResponse);
	}
	
	try {
		$members_login = $_POST['members_login_id'];
		if (!empty($members_login)) {
			foreach ($members_login as $login_id) {
				if ($g->checkIfGroupMember($group_id, $login_id) !== true) {
					$g->createGroupMember($group_id, $login_id);

				}
			}
		}

		$myResponse->status = "success";
		$myResponse->message = "Members Added";
		$myResponse->data = ['group_id' => $group_id];
		return json_encode($myResponse);
	} catch (PDOException $ex) {
		$myResponse = new Response("error", array(), $ex->getMessage());
		return json_encode($myResponse);
	}
}

function getAllGroups()
{
	$g = new Group();
	$myResponse = new Response();
	try {
		$groups = $g->getAllGroups();
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groups;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}


function fetchGroups()
{
	$g = new Group();
	$myResponse = new Response();
	$member = $_SESSION['login_id'];
	
	try {
		$groups = $g->getUserGroups($member);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groups;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function getGroupMembers()
{
	$g = new Group();
	$myResponse = new Response();
	
	if (empty($_POST['group_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select a group";
		return json_encode($myResponse);
	}
	
	$myResponse = new Response();
	try {
		$groupMembers = $g->getGroupMembers($_POST['group_id']);
		
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groupMembers;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function getAllMyGroupMembers()
{
	$g = new Group();
	$myResponse = new Response();
	$member = $_SESSION['login_id'];
	
	try {
		$groupMembers = $g->getAllMyGroupMembers($member);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groupMembers;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function groupUser()
{
	$g = new Group();
	$myResponse = new Response();
	
	if (empty($_POST['group_id'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please select group";
		return json_encode($myResponse);
	}
	try {
		
		if ($g->checkIfGroupMember($_POST['group_id'], $_POST['member_id']) !== true) {
			$g->createGroupMember($_POST['group_id'], $_POST['member_id']);
			
		}
		$notify = notifyGroupMember($_POST['group_id'],$_POST['member_id']);
		//return $notify;
		$myResponse->status = "success";
		$myResponse->message = "Group Member Added";
		return json_encode($myResponse);
	} catch (PDOException $ex) {
		$myResponse = new Response("error", array(), $ex->getMessage());
		return json_encode($myResponse);
	}
}

function updateGroupName()
{
	$g = new Group();
	$myResponse = new Response();
	
	if (empty($_POST['title'])) {
		$myResponse->status = "failed";
		$myResponse->message = "Please enter a valid title";
		return json_encode($myResponse);
	}
	try {
		$g->updateGroup($_POST['group_id'], $_POST['title']);
		$myResponse->status = "success";
		$myResponse->message = "Group Updated";
		return json_encode($myResponse);
	} catch (PDOException $ex) {
		$myResponse = new Response("error", array(), $ex->getMessage());
		return json_encode($myResponse);
	}
}

function removeGroupMember()
{
	$g = new Group();
	$myResponse = new Response();
	try {
		$groups = $g->deleteGroupMember($_POST['group_id'], $_POST['login_id']);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groups;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function removeGroup()
{
	$g = new Group();
	$member = $_SESSION['login_id'];
	$myResponse = new Response();
	try {
		$groups = $g->deleteGroup($_POST['group_id'], $member);
		$g->deleteAllGroupMembers($_POST['group_id']);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $groups;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

function notifyGroupMember($group_id,$recipient_id){
	$a = new AccountIndividual();
	$g = new Group();
	$group = $g->fetchGroup($group_id);
	$recipient = $a->fetchMember($recipient_id);
	$sender = $a->fetchMember($_SESSION['login_id']);
	$email = $recipient['email'];
	$subject = ucfirst($sender['firstname']." ".$sender['lastname'])." has invited to a Professional Group on Pro-Filr";
	$body = file_get_contents(DOCUMENT_ROOT . 'templates/others/group.html');
	$body = str_replace("[First Name]", ucfirst($recipient['firstname']), $body);
	$body = str_replace("[First Name Last Name]", ucfirst($sender['firstname'].", ".$sender['lastname']), $body);
	$body = str_replace("[Group Name]", ucfirst($group['title']), $body);
	return sendNotification($email,$subject,$body);

}
