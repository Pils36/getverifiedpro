<?php
function othersQualify($dbh)
{
	$myResponse = new  response();
	//check if subscription is active and return details of post
	try {
		getSubscription($dbh);
		if (isset($_SESSION["subscription"]) && $_SESSION["subscription"] == "active") {
			// sellect post details from posts table and return 
			$rows = $dbh->query("select tbl_opportunity.id as id,
								tbl_opportunity.`subject`,
								tbl_opportunity.description,
								tbl_opportunity.location,
								tbl_opportunity.zip,
								tbl_opportunity.deadline,
								date_format(tbl_opportunity.date_added,'%D %b, %Y') as date_added,
								tbl_opportunity.requirement,
								tbl_opportunity.specialisation,
								tbl_opportunity.industry,
								concat(firstname,' ',lastname) as `owner`,
								tbl_account_individual.country as owner_country 
								from tbl_opportunity join tbl_account_individual 
								on tbl_opportunity.login_id = tbl_account_individual.login_id where tbl_opportunity.id = {$_POST['post_id']}")->fetch(PDO::FETCH_ASSOC);
			$myResponse->status = "success";
			$myResponse->message = "Data fetched successfully";
			$myResponse->data = $rows;
			return json_encode($myResponse);
		} else {
			$myResponse->status = "failed";
			$myResponse->message = "Please upgrade your account to view details of this post";
			return json_encode($myResponse);
		}
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "An error was encountered. Please re-try";
		return json_encode($myResponse);
	}
}

function postInterest($dbh)
{
	$myResponse = new  response();
	//var_dump($_POST);
	try {
		$stmt = $dbh->prepare("INSERT INTO tbl_interest(post_id,interest_id) VALUES(:post_id,:int_id)");
		$stmt->execute(array(
			":post_id" => $_POST['post_id'],
			":int_id" => $_SESSION['login_id']
		));
		$myResponse->status = "success";
		$myResponse->message = "Your interest was registered succesfully.";
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "You interest cannot be registered at this time. Please retry.";
		return json_encode($myResponse);
	}
	
	
}

function getInterestList($dbh)
{
	$myResponse = new  response();
	try {
		$rows = $dbh->query("select login_id,firstname,lastname,profession,photo,country from tbl_account_individual where login_id in (select interest_id from tbl_interest where post_id = {$_POST['id']} order by date_created desc)")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Records retrived successfully";
		$myResponse->data = $rows;
		return json_encode($myResponse);
		
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Error retrieving interests. Please retry.";
		return json_encode($myResponse);
	}
}

?>