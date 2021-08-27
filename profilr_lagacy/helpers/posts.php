<?php
//set number of results per page

function fetchPosts($dbh)
{
	$results = 30;
	$myResponse = new response();
	$type = $_POST['type'];
	$pageno = $_POST['pageno'];
	$limitStr = " limit " . ($pageno - 1) * $results . ", " . $results;
	
	try {
		$query = "";
		if ($type == "mine") {
			$query = "select *,(select count(*) from tbl_interest where post_id = tbl_opportunity.id) as interests from tbl_opportunity where login_id = {$_SESSION['login_id']} order by date_added desc";
		} else if ($type == "others") {
			$query = "select * from tbl_opportunity where login_id <> {$_SESSION['login_id']} and {$_SESSION['login_id']} not in (select interest_id from tbl_interest where post_id = tbl_opportunity.id) and `status` = 'open' and pub_status = 'published' order by date_added desc";
		} else {
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


function pubStatus($dbh)
{
	$pub_status = $_POST['status'] . "ed";
	$myResponse = new response();
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

?>