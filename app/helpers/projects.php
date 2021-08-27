<?php

/**

 * Created by PhpStorm.

 * User: Funsho Olaniyi

 * Date: 27/03/2018

 * Time: 01:08 PM

 */



function createProject()

{

	$p = new Project();

	$myResponse = new Response();

	$member = $_SESSION['login_id'];

	$result = getSubscription($_SESSION['login_id']);

	if(!$result['active']){

		$myResponse->status = "failed";

		$myResponse->message = "This feature is available to paid subscriptions only. Please upgrade your account";

		return json_encode($myResponse);

	}

	if (empty($_POST['title'])) {

		$myResponse->status = "failed";

		$myResponse->message = "Please enter a valid title";

		return json_encode($myResponse);

	}

	try {

		$insertId = $p->create($member, $_POST['title']);

//		$p->createProjectTask($insertId, $member, 'Create Project ' . $_POST['title'], 1);

		$myResponse->status = "success";

		$myResponse->message = "Project Created Successfully";

		$myResponse->data = ['project_id' => $insertId];

		return json_encode($myResponse);

	} catch (PDOException $ex) {

		$myResponse = new Response("error", array(), $ex->getMessage());

		return json_encode($myResponse);

	}

}



function createProjectTask()

{

	$p = new Project();

	$myResponse = new Response();

	// $stmt = $pdo->prepare("SELECT * FROM tbl_account_individual WHERE login_id=?");
	// $stmt->execute([$id]); 
	// $user = $stmt->fetch();

	// print_r($user);

	if (empty($_POST['title'])) {

		$myResponse->status = "failed";

		$myResponse->message = "Please enter a valid title";

		return json_encode($myResponse);

	}

	

	

	if (empty($_POST['owner_login_id'])) {

		$myResponse->status = "failed";

		$myResponse->message = "Please select task owner";

		return json_encode($myResponse);

	}

	

	try {

		$p->createProjectTask($_POST['project_id'], $_POST['owner_login_id'], $_POST['title'], 1);
		// $p->createProjectTask($_POST['project_id'], $user, $_POST['title'], 1);

		$notify = notifyTaskOwner($_POST['project_id'], $_POST['owner_login_id'], $_POST['title']);
		// $notify = notifyTaskOwner($_POST['project_id'], $user, $_POST['title']);

		$myResponse->status = "success";

		$myResponse->message = "Project Task Created Successfully";

		return json_encode($myResponse);

	} catch (PDOException $ex) {

		$myResponse = new Response("error", array(), $ex->getMessage());

		return json_encode($myResponse);

	}

}



function fetchProjects()

{

	$g = new Project();

	$myResponse = new Response();

	$member = $_SESSION['login_id'];

	

	try {

		$projects = $g->getUserProjects($member);

		

		$myResponse->status = "success";

		$myResponse->message = "Operation Successful";

		$myResponse->data = $projects;

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = $ex->getMessage();

		return json_encode($myResponse);

	}

}



function getProjectTasks()

{

	$g = new Project();

	$myResponse = new Response();

	

	if (empty($_POST['project_id'])) {

		$myResponse->status = "failed";

		$myResponse->message = "Please select a project";

		return json_encode($myResponse);

	}

	

	$myResponse = new Response();

	try {

		$projectMessages = $g->getProjectTasks($_POST['project_id']);

		

		$myResponse->status = "success";

		$myResponse->message = "Operation Successful";

		$myResponse->data = $projectMessages;

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = $ex->getMessage();

		return json_encode($myResponse);

	}

}



function getProjectMembers()

{

	$g = new Project();

	$myResponse = new Response();

	

	if (empty($_POST['project_id'])) {

		$myResponse->status = "failed";

		$myResponse->message = "Please select a project";

		return json_encode($myResponse);

	}

	

	$myResponse = new Response();

	try {

		$projectMembers = $g->getProjectMembers($_POST['project_id']);

		

		$myResponse->status = "success";

		$myResponse->message = "Operation Successful";

		$myResponse->data = $projectMembers;

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = $ex->getMessage();

		return json_encode($myResponse);

	}

}





function removeProject()

{

	$g = new Project();

	$member = $_SESSION['login_id'];

	$myResponse = new Response();

	try {

		$projects = $g->deleteProject($_POST['project_id'], $member);

		$g->deleteAllProjectTasks($_POST['project_id']);

		$g->deleteAllProjectComments($_POST['project_id']);

		$myResponse->status = "success";

		$myResponse->message = "Operation Successful";

		$myResponse->data = $projects;

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = $ex->getMessage();

		return json_encode($myResponse);

	}

}



function removeProjectTask()

{

	$g = new Project();

	$myResponse = new Response();

	try {

		$projects = $g->deleteProjectTask($_POST['project_id'], $_POST['task_id']);

		$myResponse->status = "success";

		$myResponse->message = "Operation Successful";

		$myResponse->data = $projects;

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = $ex->getMessage();

		return json_encode($myResponse);

	}

}



function notifyTaskOwner($project_id, $owner, $title){

	$a = new AccountIndividual();

	$p = new Project();

	$project = $p->getAProject($project_id);

	$recipient = $a->fetchMember($owner);

	$sender = $a->fetchMember($_SESSION['login_id']);

	$email = $recipient['email'];

	$subject = ucfirst($sender['firstname']." ".$sender['lastname'])." has assigned a new task to you on Pro-Filr";

	$body = file_get_contents(DOCUMENT_ROOT . 'templates/others/task.html');

	$body = str_replace("[First Name]", ucfirst($recipient['firstname']), $body);

	$body = str_replace("[First Name Last Name]", ucfirst($sender['firstname'].", ".$sender['lastname']), $body);

	$body = str_replace("[Task Name]", ucfirst($title), $body);

	$body = str_replace("[Project Name]", ucfirst($project['title']), $body);

	return sendNotification($email,$subject,$body);



}

