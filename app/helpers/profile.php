<?php
function editProfile()
{
	
}

function fetchUserInfo()
{
	$myResponse = new Response();
	
	$member = !empty($_SESSION['login_id']) ? $_SESSION['login_id'] : '';
	if (!empty($_POST['member'])) {
		$member = $_POST['member'];
		
		
		$p = new ProfileView();
		$p->createUserProfileViews($_SESSION['login_id'], $member);
	}
	if (empty($member)) {
		$myResponse->status = "failed";
		$myResponse->message = "Please Login";
		return json_encode($myResponse);
	}
	$_education = fetchEducation($member);
	$_profile = fetchProfile($member);
	$_certification = fetchCertification($member);
	$_experience = fetchExperience($member);
	$_affiliation = fetchAffiliation($member);
	$_subscription = getSubscription($member);
	$_project = fetchProject($member);
	$_stats = fetchStats($member);

	$c = new Company();
	$_company = $c->getUserCompany($member);
	
	$myResponse->status = "success";
	$myResponse->message = "Operation Successful";
	$data = array(
		"education" => $_education,
		"profile" => $_profile,
		"certification" => $_certification,
		"experience" => $_experience,
		"affiliation" => $_affiliation,
		"project" => $_project,
		"company" => $_company,
		"subscription" => $_subscription,
		"stats" => $_stats,
	);
	$myResponse->data = $data;
	return json_encode($myResponse);
}


function fetchStats($member){
	$dbh = Database::getInstance();
	$views = $dbh->query("select count(member_login_id) as `views` from tbl_profile_views where member_login_id = {$member}")->fetch(PDO::FETCH_ASSOC);
	$vals = $dbh->query("select count(member_id) as `vals` from tbl_validation where member_id = {$member}")->fetch(PDO::FETCH_ASSOC);
	$msgs = $dbh->query("select count(sent_to) as `msgs` from tbl_message where sent_to = {$member}")->fetch(PDO::FETCH_ASSOC);
	$groups = $dbh->query("select count(owner_login_id) as `groups` from tbl_groups where owner_login_id = {$member}")->fetch(PDO::FETCH_ASSOC);
	$cons = $dbh->query("select count(member_id) as `cons` from tbl_connection where login_id = {$member}")->fetch(PDO::FETCH_ASSOC);

	return array(
			"views"=> $views['views'],
			"vals" => $vals['vals'],
			"msgs" => $msgs['msgs'],
			"groups" => $groups['groups'],
			"cons" => $cons['cons'],
		);
}

function fetchProfile($member)
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select * from tbl_account_individual where login_id = {$member}")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
	
}

function fetchProject($member)
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select * from tbl_executed_project where login_id = {$member} order by `project_to_year`")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
	
}

function fetchEducation($member)
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select * from tbl_educational_qualification where login_id = {$member} order by to_year desc")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
}

function fetchCertification($member)
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select * from tbl_professional_certification where login_id = {$member}  order by year_obtained desc")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
}

function fetchExperience($member)
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select * from tbl_industry_experience where login_id = {$member}  order by to_year desc,to_month desc")->fetchAll(PDO::FETCH_ASSOC);
	unset($rows["login_id"]);
	return $rows;
}


function fetchAffiliation($member)
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select * from tbl_affiliation where login_id = {$member}  order by year_joined desc")->fetchAll(PDO::FETCH_ASSOC);
	
	return $rows;
}

function insertRecord()
{
	//var_dump($_POST);exit;
//	$model = $_POST["model"];
	$dbh = Database::getInstance();
	$myResponse = new Response();
	$requiredFields = array(
		"affiliation" => array("organisation", "year_joined"),
		"educational_qualification" => array("school", "degree", "field_of_study", "from_year", "to_year"),
		"industry_experience" => array("position", "company", "specialisation", "location", "from_month", "to_month", "from_year", "to_year"),
		"oppurtunity" => array("subject", "industry", "specialisation", "description", "location", "deadline"),
		"professional_certification" => array("institution", "certification", "year_obtained", "specialization"),
		"account_individual" => array("firstname", "lastname", "profession", "country"),
		"executed_project" => array("project_employer", "project_nature", "project_description", "project_from_year", "project_to_year", "project_location"),
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
			
// 			mail for Opportunity in area of specialization

$opport = "SELECT tbl_opportunity.specialisation, tbl_opportunity.description, tbl_opportunity.date_added,tbl_account_individual.login_id, tbl_account_individual.firstname AS firstname, tbl_account_individual.lastname AS lastname, tbl_account_individual.email AS email FROM `tbl_opportunity`, tbl_account_individual WHERE tbl_opportunity.specialisation = tbl_account_individual.profession AND tbl_account_individual.login_id != '".$_SESSION['login_id']."' ORDER BY tbl_opportunity.date_added DESC";

$opports = $dbh->query($opport);

$opports->execute();

$resopport = $opports->fetchAll();

foreach($resopport as $key){
    $firstname = $key['firstname'];
    $lastname = $key['lastname'];
    $email = $key['email'];
    
    $to = "bambo.adenuga@pro-filr.com";
$subject = "$firstname $lastname, check recent opportunity posts in your area of specialisation";


$message = '


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Recent Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 20px;background-color: #DEE0E2;">
 <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;background-color: #F4F4F4; font-family: verdana; font-size: 12px; text-align: justify; line-height: 1.5">
    <tr>
        <td style="padding: 20px 20px 20px 20px;">
            <table width="100%">
                <tr>
                    <td style="font-size: 10px;"><a href="https://pro-filr.com" target="_blank">www.pro-filr.com</a></td>
                    <td style="font-size: 10px;" align="right">Email not displaying correctly?<br/><a href="htttps://www.pro-filr.com/templates/Complete/Complete.html">View in your browser</a></td>
                </tr>
            </table>
        </td>
    </tr>
 <tr>
   <td align="center" style="padding: 10px 10px 10px 10px; font-weight: bold; text-transform: italic">
    Pro-Filr.com, Worlds #1 Platform for Verified Professionals to Collaborate
   </td>
  </tr>
 <tr>
  <td style="padding: 20px 30px 20px 30px;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">

  <tr>
   <td style="padding: 10px 10px 10px 10px;">
    Hi '.$firstname.',
   </td>
  </tr>
  <tr>
   <td style="padding: 10px 10px 10px 10px;">
   There are recent opportunities posted on Pro-filr.com relating to your area of specialisation
</td>
  </tr>
  <tr>
   <td align="center" style="padding: 10px;">
    <a href="https://www.pro-filr.com/posts" style="background-color: #139f5e; color: #fff; padding: 7px; text-decoration: none; font-size: 14px">Click to view post</a>
</td>
  </tr>


 </table>
</td>
 </tr>
 <tr>
    <td style="padding: 20px 30px 20px 30px;">
        <p style="font-style: italic;font-weight: bold; color: #980000;">Upgrade to Classic Membership.</p>
<p>Classic Membership on Pro-filr.com provides you with awesome opportunities. With the upgraded membership, you can engage other professionals, access opportunities, create unlimited professional groups and unlimited projects. Click <a href="https://pro-filr.com/paypal" target="_blank">here</a> to Upgrade. </p>
    </td>
 </tr>
 <tr>
  <td style="padding: 10px 30px 30px 30px;">
    <hr/>
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #139f5e; padding: 15px">
 <tr>
<td width="65%" style="color: #fff;font-family: Helvetica;font-size: 10px;line-height: 150%;text-align: left;font-style: italic;">
    
 This email was intended for '.$firstname.' '.$lastname.' '.$email.'. Copyright &copy; <script>new Date().getFullYear()>document.write(""+new Date().getFullYear());</script> Professionals File Inc. 10 George St. North. Ontario. L6X 1R2. Canada.
</td>
  <td align="right">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td>
    <a href="https://twitter.com/pro_filr" target="_blank"><img src="https://pro-filr.com/images/twitter.png" width="30" height="30" style="background: #fff; border-radius:100%"></a>
   </td>
   <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
   <td>
    <a href="https://www.facebook.com/profilr2016/" target="_blank"><img src="https://pro-filr.com/images/facebook.png" width="30" height="30" style="background: #fff; border-radius:100%"></a>
   </td>
  </tr>
 </table>
</td>
 </tr>
</table>
</td>
 </tr>
</table>


</body>
</html>


';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
}			
			
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

function deleteRecord()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
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
			case 'affiliation':
				$table = "tbl_affiliation";
				break;
			case 'experience':
				$table = "tbl_industry_experience";
				break;
			case 'project':
				$table = "tbl_executed_project";
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

function editRecord()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
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
			case 'affiliation':
				$table = "tbl_affiliation";
				break;
			case 'experience':
				$table = "tbl_industry_experience";
				break;
			case 'project':
				$table = "tbl_executed_project";
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
		$employers = json_decode(fetchEmployer(), true);
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
			"years" => fetchYears(),
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

function fetchIndustries()
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("SELECT * FROM tbl_industry ORDER BY industry")->fetchAll(PDO::FETCH_ASSOC);
	return json_encode(array(
		"data" => $rows
	));
}

function fetchEmployer()
{
	$dbh = Database::getInstance();
	
	$rows = $dbh->query("select distinct company from tbl_industry_experience where login_id = {$_SESSION['login_id']}")->fetchAll(PDO::FETCH_ASSOC);
	return json_encode(array(
		"data" => $rows,
		// "years" => fetchYears()
	));
}

function getActiveSubscription(){
	$myResponse = new Response();
	// $paidFeatures = array("posts","projects");
	$paidFeatures = array();
	if(!in_array($_POST['view'], $paidFeatures)){
		$myResponse->message = "free";
	}else{
	
		$result = getSubscription($_SESSION['login_id']);
		if($result['active']){
			$myResponse->status = "successful";
			$myResponse->message = "active";
		}else{
			$myResponse->status = "failed";
			$myResponse->message = "inactive";
		}
	}

	return json_encode($myResponse);
}

function getSubscription($member='')
{
	$dbh = Database::getInstance();
	
	if(empty($member)){
		$member = $_SESSION['login_id'];
	}
	
	// echo "select * from tbl_subscription where login_id = {$_SESSION['login_id']} and expiry_date >= now() sort by expiry_date desc";exit;
	if (empty($_SESSION['login_id'])) {
		$_SESSION["subscription"] = "inactive";
		return array("active" => "0");
	}
	$stmt = $dbh->query("select * from tbl_subscription where login_id = {$member} and expiry_date >= now() order by expiry_date desc limit 1");
	// echo "select * from tbl_subscription where login_id = {$_SESSION['login_id']} and expiry_date >= now() order by expiry_date desc";exit;
	//echo $stmt->rowCount();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($stmt->rowCount() == 0) {
		$_SESSION["subscription"] = "inactive";
		return array("active" => "0");
	} else {
		$_SESSION["subscription"] = "active";
		return array("active" => "1");
		
	}
}

function changePassword()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
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

