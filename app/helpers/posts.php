<?php
//set number of results per page

function fetchPosts()
{
	$results = 30;
	$dbh = Database::getInstance();
	$myResponse = new Response();
	$type = $_POST['type'];
	$pageno = $_POST['pageno'];
	$limitStr = " limit " . ($pageno - 1) * $results . ", " . $results;

	try {
		$result = getSubscription($_SESSION['login_id']);
		if(!$result['active']){
			$myResponse->status = "inactive";
			$myResponse->message = "This feature is available to paid subscriptions only. Please upgrade your account";
			return json_encode($myResponse);
		}
		if ($type == "mine") {
			$query = "select *,(select count(*) from tbl_interest where post_id = tbl_opportunity.id) as interests from tbl_opportunity where login_id = {$_SESSION['login_id']} order by date_added desc";
		} 
		else if ($type == "others") {
			$query = "select * from tbl_opportunity where login_id <> {$_SESSION['login_id']} and {$_SESSION['login_id']} not in (select interest_id from tbl_interest where post_id = tbl_opportunity.id) and `status` = 'open' and pub_status = 'published' and deadline >= now() order by date_added desc";
		} 
		else {
			$query = "select * from tbl_opportunity where login_id <> {$_SESSION['login_id']} and {$_SESSION['login_id']} in (select interest_id from tbl_interest where post_id = tbl_opportunity.id) order by date_added desc";
		}
		//echo $query.$limitStr;
		$rows = $dbh->query($query . $limitStr)->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $rows;
		
		
		return json_encode($myResponse);
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
	
}





function pubStatus()
{
	$pub_status = $_POST['status'] . "ed";
	$dbh = Database::getInstance();
	$myResponse = new Response();
	try {
		$dbh->exec("update tbl_opportunity set pub_status = '{$pub_status}' where login_id={$_SESSION['login_id']} and id = {$_POST['id']}");
		$myResponse->status = "success";
		$myResponse->message = "Post {$_POST['status']}ed successfully";
		return json_encode($myResponse);
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}



