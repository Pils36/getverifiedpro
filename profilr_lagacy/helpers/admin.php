<?php


function adminLogin($dbh)
{
	$myResponse = new response();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	if (empty($username) || empty($password)) {
		$myResponse->status = "failed";
		$myResponse->message = "All fields are required";
		return json_encode($myResponse);
	}
	
	$stmt = $dbh->prepare("SELECT * FROM tbl_admin WHERE username = :user AND `password` = md5(:pass)");
	$stmt->execute(array(
		":user" => $username,
		":pass" => $password
	));
	$count = $stmt->rowCount();
	if ($count < 1) {
		$myResponse->status = "failed";
		$myResponse->message = "Invalid Login";
		return json_encode($myResponse);
	} else {
		$myResponse->status = "success";
		$myResponse->message = "Login successful";
		//$myResponse->data = $count;
		$_SESSION['login'] = "admin";
		return json_encode($myResponse);
	}
	
	
}


function getBlogs($dbh)
{
	$myResponse = new response();
	try {
		$rows = $dbh->query("SELECT id,date_posted,title,summary,content,`status` FROM tbl_blog_post ORDER BY date_posted DESC")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Blog posts retrieved successfully";
		$myResponse->data = $rows;
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Posted blogs cannot be displayed at the moment. Please retry";
	}
	return json_encode($myResponse);
}


function getMembers($dbh)
{
	$myResponse = new response();
	try {
		$rows = $dbh->query("SELECT tbl_account_individual.login_id AS no, tbl_account_individual.email AS email, firstname,lastname,country, date_created FROM tbl_account_individual JOIN tbl_login ON tbl_account_individual.login_id = tbl_login.login_id ORDER BY date_created DESC;")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Blog posts retrieved successfully";
		$myResponse->data = $rows;
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Posted blogs cannot  be displayed at the moment. Please retry";
	}
	return json_encode($myResponse);
	
}

function getSubscriptions($dbh)
{
	
	
	$myResponse = new response();
	try {
		$rows = $dbh->query("SELECT IF(date(expiry_date) >=NOW(),'active','expired') AS `status`,firstname,lastname,email,subscription_date FROM tbl_subscription JOIN tbl_account_individual ON tbl_subscription.login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Blog posts retrieved successfully";
		$myResponse->data = $rows;
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Posted blogs cannot be displayed at the moment. Please retry";
	}
	return json_encode($myResponse);
}

function newBlog($dbh)
{
	$myResponse = new response();
	try {
		$title = $_POST['title'];
		$content = $_POST['content'];
		$status = $_POST['status'];
		if (empty($title) || empty(strip_tags($content)) || empty($status)) {
			$myResponse->status = "failed";
			$myResponse->message = "Some required fields are missing";
			return json_encode($myResponse);
		}
		$stmt = $dbh->prepare("INSERT INTO tbl_blog_post(`title`,`content`,`status`) VALUES(:title,:content,:status)");
		$stmt->execute(array(
			":title" => $title,
			":content" => $content,
			":status" => $status
		));
		$myResponse->status = "success";
		$myResponse->message = "Blog posted successfully";
		$myResponse->data = $rows;
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Blogs cannot be posted at the moment. Please retry";
	}
	return json_encode($myResponse);
}

function viewBlog($dbh)
{
	$myResponse = new response();
	try {
		$id = $_POST['id'];
		$rows = $dbh->query("select * from tbl_blog_post where id = {$id}")->fetch(PDO::FETCH_ASSOC);
		
		$myResponse->status = "success";
		$myResponse->message = "Blog post retrieved successfully";
		$myResponse->data = $rows;
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Blogs cannot be retrieved at the moment. Please retry";
	}
	return json_encode($myResponse);
}

function updateBlog($dbh)
{
	$myResponse = new response();
	try {
		$title = $_POST['title'];
		$content = $_POST['content'];
		$status = $_POST['status'];
		if (empty($title) || empty(strip_tags($content)) || empty($status)) {
			$myResponse->status = "failed";
			$myResponse->message = "Some required fields are missing";
			return json_encode($myResponse);
		}
		$stmt = $dbh->prepare("update tbl_blog_post set `title` = :title ,`content` = :content,`status` = :status where id = {$_POST['id']}");
		$stmt->execute(array(
			":title" => $title,
			":content" => $content,
			":status" => $status
		));
		$myResponse->status = "success";
		$myResponse->message = "Blog updated successfully";
		$myResponse->data = $rows;
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Blog cannot be updated at the moment. Please retry";
	}
	return json_encode($myResponse);
}

function newSubscription($dbh)
{
	$myResponse = new response();
	$expiry;
	try {
		$plan = $_POST['plan'];
		if ($plan == 'Monthly Plan') {
			$expiry = date('Y-m-d', mktime(0, 0, 0, date("m") + 1, date("d") - 1, date("Y")));
		} else {
			$expiry = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y") + 1));
		}
		
		$dbh->exec("insert into tbl_subscription (login_id,plan,expiry_date) values({$_POST['member']},'{$plan}','{$expiry}')");
		
		$myResponse->status = "success";
		$myResponse->message = "Subscription added successfully";
		// $myResponse->data = $rows;
		
	} catch (PDOException $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Subscriptions cannot be added at the moment. Please retry";
		//$myResponse->message = $ex->getMessage();
	}
	return json_encode($myResponse);
}

?>