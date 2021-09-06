<?php
function othersQualify()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
	//check if subscription is active and return details of post
	try {
		getSubscription();
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

function postInterest()
{
	$dbh = Database::getInstance();

	$myResponse = new Response();
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



function getInterestList()
{
	$dbh = Database::getInstance();

	$myResponse = new Response();
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


function recentPosts()
{
	$dbh = Database::getInstance();

	$myResponse = new Response();
	try {

		// Run API Call here

		$cbd = doGet();

		$posts = $dbh->query("select id,`subject`,location,date_format(deadline,'%W, %D  %M, %Y') as deadline from tbl_opportunity where `status` = 'open' and pub_status='published' and deadline >= date(now()) order by date_added desc limit 5")->fetchAll(PDO::FETCH_ASSOC);

		$profiles = $dbh->query("select tbl_account_individual.*,count(member_login_id) as `count` from tbl_profile_views join tbl_account_individual on tbl_profile_views.member_login_id = tbl_account_individual.login_id GROUP BY member_login_id order by count(member_login_id) desc limit 5")->fetchAll(PDO::FETCH_ASSOC);

		// Influencers List
		$influencers = $dbh->query("SELECT COUNT(*) AS NO, tbl_invites.login_id AS id, tbl_account_individual.firstname AS firstname, tbl_account_individual.lastname AS lastname, tbl_account_individual.company AS company, tbl_account_individual.photo AS photo FROM `tbl_invites`, `tbl_account_individual` WHERE tbl_invites.login_id = tbl_account_individual.login_id GROUP BY tbl_invites.login_id HAVING NO > 1000 ORDER BY NO DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
		$data = array(
			"cbd" => $cbd,
			"posts" => $posts,
			"profiles" => $profiles,
			"influencers" => $influencers,
		);
		$myResponse->status = "success";
		$myResponse->message = "Records retrived successfully";
		$myResponse->data = $data;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Error retrieving recent posts. Please retry.";
		return json_encode($myResponse);
	}
}


function doGet()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost:9090/api/v1/classifiedbusinessdirectory',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer base64:JFM+PJaWD/pBypX+NhXudDrAmianZdGYZ41qz4WhXL0='
		),
	));

	$response = curl_exec($curl);


	curl_close($curl);

	return json_decode($response);
}

// Edit Posts

function editRecords()
{

	$dbh = Database::getInstance();

	$myResponse = new Response();
	//var_dump($_POST);



	try {
		$stmtUpdt = "UPDATE tbl_opportunity SET subject = '" . $_POST['thissubject'] . "', description = '" . $_POST['thisdescription'] . "', location = '" . $_POST['thislocation'] . "', zip = '" . $_POST['thiszip'] . "', deadline = '" . $_POST['thisdeadline'] . "', industry = '" . $_POST['thisindustry'] . "', specialisation = '" . $_POST['thisspecialisation'] . "', requirement = '" . $_POST['thisrequirement'] . "' WHERE login_id = '" . $_SESSION['login_id'] . "'";


		$stmt = $dbh->prepare($stmtUpdt);

		$res = $stmt->execute();

		$myResponse->status = "success";
		$myResponse->message = "Your post was updated succesfully.";
		$myResponse->data = $res;
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "You cannot update at this time. Please retry.";
		return json_encode($myResponse);
	}
}
