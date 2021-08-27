<?php
function editProfile($dbh)
{
	
}

function fetchUserInfo($dbh)
{
	$member = $_SESSION['login_id'];
	if ($_POST['member']) {
		$member = $_POST['member'];
	}
	$myResponse = new  response();
	$_education = fetchEducation($dbh, $member);
	$_profile = fetchProfile($dbh, $member);
	$_certification = fetchCertification($dbh, $member);
	$_experience = fetchExperience($dbh, $member);
	$_affliation = fetchAffliation($dbh, $member);
	$_subscription = getSubscription($dbh, $member);
	$_project = fetchProject($dbh, $member);
	$myResponse->status = "success";
	$myResponse->message = "Operation Successfull";
	$data = array(
		"education" => $_education,
		"profile" => $_profile,
		"certification" => $_certification,
		"experience" => $_experience,
		"affliation" => $_affliation,
		"project" => $_project,
		"subscription" => $_subscription
	);
	$myResponse->data = $data;
	return json_encode($myResponse);
}

function fetchProfile($dbh, $member)
{
	$rows = $dbh->query("select * from tbl_account_individual where login_id = {$member}")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
	
}

function fetchProject($dbh, $member)
{
	$rows = $dbh->query("select * from tbl_project where login_id = {$member} order by `project_to_year`")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
	
}

function fetchEducation($dbh, $member)
{
	$rows = $dbh->query("select * from tbl_educational_qualification where login_id = {$member} order by to_year desc")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
}

function fetchCertification($dbh, $member)
{
	$rows = $dbh->query("select * from tbl_professional_certification where login_id = {$member}  order by year_obtained desc")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
}

function fetchExperience($dbh, $member)
{
	$rows = $dbh->query("select * from tbl_industry_experience where login_id = {$member}  order by to_year desc,to_month desc")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
}


function fetchAffliation($dbh, $member)
{
	$rows = $dbh->query("select * from tbl_affliation where login_id = {$member}  order by year_joined desc")->fetchAll(PDO::FETCH_ASSOC);
	
	return $rows;
}

function insertRecord($dbh)
{
	//var_dump($_POST);exit;
	$model = $_POST["model"];
	$myResponse = new response();
	$requiredFields = array(
		"affliation" => array("organisation", "year_joined"),
		"educational_qualification" => array("school", "degree", "field_of_study", "from_year", "to_year"),
		"industry_experience" => array("position", "company", "specialisation", "location", "from_month", "to_month", "from_year", "to_year"),
		"oppurtunity" => array("subject", "industry", "specialisation", "description", "location", "deadline"),
		"professional_certification" => array("institution", "certification", "year_obtained", "specialization"),
		"account_individual" => array("firstname", "lastname", "profession", "country"),
		"project" => array("project_employer", "project_nature", "project_description", "project_from_year", "project_to_year", "project_location"),
		"company" => array("name", "description", "address1", "country", "company_size", "industry")
	);
	//var_dump($requiredFields[$model]);exit;
	try {
		//return json_encode($_POST);
		$action = "";
		$table = "tbl_" . $_POST['model'];
		$strColumns = "`login_id`,";
		$strValues = "?,";
		$arrayValues = array($_SESSION['login_id']);
		$data = $_POST['data'];
		//var_dump($data);
		foreach ($data as $key => $array) {
			foreach ($array as $fKey => $value) {
				if ($fKey == "name") {
					//check if name is required
					
					if (in_array($value, $requiredFields[$_POST['model']]) && empty($data[$key]['value'])) {
						//echo $value.": ". $data[$key]['value']."\n\r";
						$myResponse->status = "failed";
						$myResponse->message = "Fields with asterisks are required";
						return json_encode($myResponse);
					}
					if ($value == "id") {
						$action = "replace";
					}
					$strColumns .= "`$value`,";
					$strValues .= "?,";
				} else {
					//field is value
					$arrayValues[] = $value;
				}
			}
		}
		$strColumns = rtrim($strColumns, ",");
		$strValues = rtrim($strValues, ",");
		$pic_loc = "";
		
		//var_dump($arrayValues);
		//echo "insert into $table($strColumns) values($strValues)";exit;
		if ($action == "replace") {
			if ($table == "tbl_account_individual") {
				//echo "select photo from $table where login_id = {$_SESSION['login_id']}";exit;
				$row = $dbh->query("select photo from $table where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);
				$pic_loc = $row["photo"];
				//echo $pic_loc;exit;
			}
			$stmt = $dbh->prepare("replace into $table($strColumns) values($strValues)");
			//echo "replace into $table($strColumns) values($strValues)";exit;
		} else {
			$stmt = $dbh->prepare("insert into $table($strColumns) values($strValues)");
		}
		
		
		$stmt->execute($arrayValues);
		
		if ($table == "tbl_account_individual" && $action == "replace") {
			$stmt = $dbh->prepare("update $table  set photo =:photo where login_id = {$_SESSION['login_id']}");
			$stmt->execute(array(
				":photo" => $pic_loc
			));
		}
		
		$rows = $dbh->query("select * from $table where login_id = {$_SESSION['login_id']}")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Your information was updated successfully";
		$myResponse->data = array("table" => $table, "rows" => $rows);
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
		
	}
	
}

function deleteRecord($dbh)
{
	$myResponse = new response();
	$table = "";
	try {
		//return json_encode($_POST);
		
		switch ($_POST['content']) {
			case 'education':
				$table = "tbl_educational_qualification";
				break;
			case 'certification':
				$table = "tbl_professional_certification";
				break;
			case 'affliation':
				$table = "tbl_affliation";
				break;
			case 'experience':
				$table = "tbl_industry_experience";
				break;
			case 'project':
				$table = "tbl_project";
				break;
			default:
				# code...
				break;
		}
		//echo "delete from $table where login_id = {$_SESSION['login_id']} and id = {$_POST['ref']}";exit;
		$dbh->exec("delete from $table where login_id = {$_SESSION['login_id']} and id = {$_POST['ref']}");
		$rows = $dbh->query("select * from $table where login_id = {$_SESSION['login_id']}")->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = array("table" => $table, "rows" => $rows);
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
		
	}
	
}

function editRecord($dbh)
{
	$myResponse = new response();
	$table = "";
	try {
		//return json_encode($_POST);
		
		switch ($_POST['content']) {
			case 'education':
				$table = "tbl_educational_qualification";
				break;
			case 'certification':
				$table = "tbl_professional_certification";
				break;
			case 'affliation':
				$table = "tbl_affliation";
				break;
			case 'experience':
				$table = "tbl_industry_experience";
				break;
			case 'project':
				$table = "tbl_project";
				break;
			case 'profile':
				$table = "tbl_account_individual";
				break;
			case 'company':
				$table = "tbl_company";
				break;
			case 'opportunity':
				$table = "tbl_opportunity";
				break;
			default:
				# code...
				break;
		}
		//echo "select * from $table where login_id = {$_SESSION['login_id']} and id = {$_POST['ref']}";exit;
		//echo "select * from $table where login_id = {$_SESSION['login_id']} and id = {$_POST['ref']}";exit;
		if ($table == "tbl_account_individual" || $table == "tbl_company") {
			$rows = $dbh->query("select * from $table where login_id = {$_SESSION['login_id']}")->fetch(PDO::FETCH_ASSOC);
		} else {
			$rows = $dbh->query("select * from $table where login_id = {$_SESSION['login_id']} and id = {$_POST['ref']}")->fetch(PDO::FETCH_ASSOC);
		}
		$employers = json_decode(fetchEmployer($dbh), true);
		$employers = $employers["data"];
		//print_r($employers);exit;
		//$employers = $employers["data"];exit;
		unset($rows['login_id']);
		$myResponse->status = "success";
		$myResponse->message = "Operation Successful";
		$myResponse->data = array(
			"table" => $_POST['content'],
			"rows" => $rows,
			"employers" => $employers,
			"years" => fetchYears()
		);
		return json_encode($myResponse);
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = $ex->getMessage();
		return json_encode($myResponse);
		
	}
}

function fetchYears()
{
	$years = array();
	$base = 1940;
	$current = date("Y");
	while ($base <= $current) {
		$years[] = array("year" => $base);
		$base += 1;
	}
	
	return $years;
	
}

function getYears()
{
	return json_encode(fetchYears());
}

function fetchIndustries($dbh)
{
	$rows = $dbh->query("SELECT * FROM tbl_industry ORDER BY industry")->fetchAll(PDO::FETCH_ASSOC);
	return json_encode(array(
		"data" => $rows
	));
}

function fetchEmployer($dbh)
{
	$rows = $dbh->query("select distinct company from tbl_industry_experience where login_id = {$_SESSION['login_id']}")->fetchAll(PDO::FETCH_ASSOC);
	return json_encode(array(
		"data" => $rows,
		// "years" => fetchYears()
	));
}

function getSubscription($dbh)
{
	// echo "select * from tbl_subscription where login_id = {$_SESSION['login_id']} and expiry_date >= now() sort by expiry_date desc";exit;
	if (empty($_SESSION['login_id'])) {
		$_SESSION["subscription"] = "inactive";
		return array("active" => "0");
	}
	$stmt = $dbh->query("select * from tbl_subscription where login_id = {$_SESSION['login_id']} and expiry_date >= now() order by expiry_date desc");
	// echo "select * from tbl_subscription where login_id = {$_SESSION['login_id']} and expiry_date >= now() order by expiry_date desc";exit;
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($stmt->rowCount() == 0) {
		$_SESSION["subscription"] = "inactive";
		return array("active" => "0");
	} else {
		$_SESSION["subscription"] = "active";
		return array("active" => "1");
		
	}
}

function changePassword($dbh)
{
	$myResponse = new response();
	$current = $_POST['current'];
	$new = $_POST['new'];
	$confirm = $_POST['confirm'];
	
	// check if password is correct
	$stmt = $dbh->prepare("select * from tbl_login where `password` = md5(:current) and login_id={$_SESSION['login_id']}");
	$stmt->execute(array(":current" => $current));
	$count = $stmt->rowCount();
	if ($count < 1) {
		$myResponse->status = "failed";
		$myResponse->message = "Password Incorrect";
		return json_encode($myResponse);
	}
	
	if (empty($confirm) || empty($new) || empty($current)) {
		$myResponse->status = "failed";
		$myResponse->message = "All fields are required";
		return json_encode($myResponse);
	}
	if ($confirm != $new) {
		$myResponse->status = "failed";
		$myResponse->message = "Passwords do not match";
		return json_encode($myResponse);
	}
	
	try {
		$stmt = $dbh->prepare("update tbl_login set `password` = md5(:new) where login_id={$_SESSION['login_id']}");
		$stmt->execute(array(
			":new" => $new
		));
		$myResponse->status = "success";
		$myResponse->message = "Password changed successfully";
		return json_encode($myResponse);
	} catch (PDOException $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Password cannot be changed at the moment";
		return json_encode($myResponse);
		
	}
	
}

?>