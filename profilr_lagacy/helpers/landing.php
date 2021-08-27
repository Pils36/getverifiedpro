<?php
function fetchLanding($dbh)
{
	$data = array();
	$myResponse = new response();
	//fetch blogposts
	try {
		$blogPosts = $dbh->query("SELECT `tbl_blog_post`.`id`,`tbl_blog_post`.`title`,ifnull(concat(firstname,' ',lastname),'Pro-Filr') AS `name`,date_format(date_posted,'%d %b %Y %r') AS date_posted,concat(SUBSTRING_INDEX(content,' ',20),'...') AS summary, (SELECT count(*) FROM tbl_blog_comment WHERE blog_id = `tbl_blog_post`.`id`) AS comments FROM tbl_blog_post LEFT JOIN tbl_account_individual ON tbl_blog_post.login_id = tbl_account_individual.login_id ORDER BY date_posted DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
		
		//fetch oppurtunities
		
		$opportunities = $dbh->query("SELECT `id`, `subject`,`location`,date_added,deadline,concat(SUBSTRING_INDEX(description,' ',20),'...') AS description FROM tbl_opportunity WHERE `status` = 'open' ORDER BY date_added DESC")->fetchAll(PDO::FETCH_ASSOC);
		
		
		//fetch people for validation
		//people with same educational background
		
		
		$data['blogposts'] = $blogPosts;
		$data['opportunities'] = $opportunities;
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = $data;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
	}
}

?>