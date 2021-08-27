<?php
function getBlog($dbh)
{
	$myResponse = new response();
	
	try {
		$rows = $dbh->query("SELECT * FROM tbl_blog_post WHERE `status` = 'online' ORDER BY date_posted DESC")->fetchAll(PDO::FETCH_ASSOC);
		
		$myResponse->status = "success";
		$myResponse->message = "Blog posts retrieved successfully ";
		$myResponse->data = $rows;
		
	} catch (PDOException $ex) {
		$myResponse->status = "failed";
		//$myResponse->message = "Blog posts cannot be retrieved at the moment. Please retry";
		$myResponse->message = $ex->getMessage();
	}
	return json_encode($myResponse);
}

?>