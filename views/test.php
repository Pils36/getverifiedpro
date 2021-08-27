<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (!validateLogin()) {
    
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}


?>

<?php

// error_reporting(1);

$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>


<!--Count professionals you may know-->
 <?php
//  $login_id = 257;
 $login_id = 229;
 
		$sql0 = "SELECT my_account.*, CONCAT('Friends with ', f_account.firstname,' ', f_account.lastname) AS in_common, COUNT(*) as relevance, GROUP_CONCAT(a.login_id ORDER BY a.login_id) as mutual_friends FROM tbl_connection a JOIN tbl_connection b ON  (b.member_id = a.login_id AND b.login_id = {$login_id}) LEFT JOIN tbl_connection c ON (c.member_id = a.member_id AND c.login_id = {$login_id}) JOIN tbl_account_individual my_account ON my_account.login_id = a.member_id JOIN tbl_account_individual f_account ON f_account.login_id = a.login_id WHERE c.login_id IS NULL AND a.member_id != {$login_id} GROUP BY a.member_id ORDER BY relevance DESC;";
		
		$sql1 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_company.name) AS in_common FROM tbl_company AS the_company JOIN tbl_company AS my_company ON my_company.name = the_company.name JOIN tbl_account_individual ON tbl_account_individual.login_id = the_company.login_id WHERE my_company.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql2 = "SELECT tbl_account_individual.*, CONCAT('Worked with ',the_project.project_employer) AS in_common FROM tbl_executed_project AS the_project JOIN tbl_executed_project AS my_project ON my_project.project_employer = the_project.project_employer JOIN tbl_account_individual ON tbl_account_individual.login_id = the_project.login_id WHERE my_project.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql3 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_experience.company) AS in_common FROM tbl_industry_experience AS the_experience JOIN tbl_industry_experience AS my_experience ON my_experience.company = the_experience.company JOIN tbl_account_individual ON tbl_account_individual.login_id = the_experience.login_id WHERE my_experience.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql4 = "SELECT tbl_account_individual.*, CONCAT('Member of ',the_affiliation.organisation) AS in_common FROM tbl_affiliation AS the_affiliation JOIN tbl_affiliation AS my_affiliation ON my_affiliation.organisation = the_affiliation.organisation JOIN tbl_account_individual ON tbl_account_individual.login_id = the_affiliation.login_id WHERE my_affiliation.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql5 = "SELECT tbl_account_individual.*, CONCAT('Has ',the_professional_certification.certification) AS in_common FROM tbl_professional_certification AS the_professional_certification JOIN tbl_professional_certification AS my_professional_certification ON my_professional_certification.certification = the_professional_certification.certification JOIN tbl_account_individual ON tbl_account_individual.login_id = the_professional_certification.login_id WHERE my_professional_certification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql6 = "SELECT tbl_account_individual.*, CONCAT('Schooled at ',the_educational_qualification.school) AS in_common FROM tbl_educational_qualification AS the_educational_qualification JOIN tbl_educational_qualification AS my_educational_qualification ON my_educational_qualification.school = the_educational_qualification.school JOIN tbl_account_individual ON tbl_account_individual.login_id = the_educational_qualification.login_id WHERE my_educational_qualification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND()";

		$sql7 = "select tbl_account_individual.*,concat('Lives in ',country) as in_common from tbl_account_individual where country = (select country from tbl_account_individual where login_id = {$login_id}) and login_id <> {$login_id}";

// First fetch
    $sth = $dbh->prepare($sql0);
    $sth->execute();
    $result0 = $sth->fetchAll();
    $count0 = count($result0);
    
// Second Fetch
    $sth = $dbh->prepare($sql1);
    $sth->execute();
    $result1 = $sth->fetchAll();
    $count1 = count($result1);
    
    // Third Fetch
    $sth = $dbh->prepare($sql2);
    $sth->execute();
    $result2 = $sth->fetchAll();
    $count2 = count($result2);
    
    // Forth Fetch
    $sth = $dbh->prepare($sql3);
    $sth->execute();
    $result3 = $sth->fetchAll();
    $count3 = count($result3);
    
    // Five Fetch
    $sth = $dbh->prepare($sql4);
    $sth->execute();
    $result4 = $sth->fetchAll();
    $count4 = count($result4);
    
    // Sixth Fetch
    $sth = $dbh->prepare($sql5);
    $sth->execute();
    $result5 = $sth->fetchAll();
    $count5 = count($result5);
    
    // Seventh Fetch
    $sth = $dbh->prepare($sql6);
    $sth->execute();
    $result6 = $sth->fetchAll();
    $count6 = count($result6);
    
    // Eight Fetch
    $sth = $dbh->prepare($sql7);
    $sth->execute();
    $result7 = $sth->fetchAll();
    $count7 = count($result7);
    

			$results = array_merge($result0, $result1, $result2, $result3, $result4, $result5, $result6, $result7);
			
		$total_count = $count0+$count1+$count2+$count3+$count4+$count5+$count6+$count7;
		
		print_r($total_count);
			
			
?>
