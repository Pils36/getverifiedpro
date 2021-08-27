<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 31/03/2018
 * Time: 03:18 PM
 */

class Connection
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function getConnectionSuggestions($login_id)
	{
		$sql0 = "SELECT my_account.*, CONCAT('Friends with ', f_account.firstname,' ', f_account.lastname) AS in_common, COUNT(*) as relevance, GROUP_CONCAT(a.login_id ORDER BY a.login_id) as mutual_friends FROM tbl_connection a JOIN tbl_connection b ON  (b.member_id = a.login_id AND b.login_id = {$login_id}) LEFT JOIN tbl_connection c ON (c.member_id = a.member_id AND c.login_id = {$login_id}) JOIN tbl_account_individual my_account ON my_account.login_id = a.member_id JOIN tbl_account_individual f_account ON f_account.login_id = a.login_id WHERE c.login_id IS NULL AND a.member_id != {$login_id} GROUP BY a.member_id ORDER BY relevance DESC;";
		
		$sql1 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_company.name) AS in_common FROM tbl_company AS the_company JOIN tbl_company AS my_company ON my_company.name = the_company.name JOIN tbl_account_individual ON tbl_account_individual.login_id = the_company.login_id WHERE my_company.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql2 = "SELECT tbl_account_individual.*, CONCAT('Worked with ',the_project.project_employer) AS in_common FROM tbl_executed_project AS the_project JOIN tbl_executed_project AS my_project ON my_project.project_employer = the_project.project_employer JOIN tbl_account_individual ON tbl_account_individual.login_id = the_project.login_id WHERE my_project.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql3 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_experience.company) AS in_common FROM tbl_industry_experience AS the_experience JOIN tbl_industry_experience AS my_experience ON my_experience.company = the_experience.company JOIN tbl_account_individual ON tbl_account_individual.login_id = the_experience.login_id WHERE my_experience.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql4 = "SELECT tbl_account_individual.*, CONCAT('Member of ',the_affiliation.organisation) AS in_common FROM tbl_affiliation AS the_affiliation JOIN tbl_affiliation AS my_affiliation ON my_affiliation.organisation = the_affiliation.organisation JOIN tbl_account_individual ON tbl_account_individual.login_id = the_affiliation.login_id WHERE my_affiliation.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql5 = "SELECT tbl_account_individual.*, CONCAT('Has ',the_professional_certification.certification) AS in_common FROM tbl_professional_certification AS the_professional_certification JOIN tbl_professional_certification AS my_professional_certification ON my_professional_certification.certification = the_professional_certification.certification JOIN tbl_account_individual ON tbl_account_individual.login_id = the_professional_certification.login_id WHERE my_professional_certification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql6 = "SELECT tbl_account_individual.*, CONCAT('Schooled at ',the_educational_qualification.school) AS in_common FROM tbl_educational_qualification AS the_educational_qualification JOIN tbl_educational_qualification AS my_educational_qualification ON my_educational_qualification.school = the_educational_qualification.school JOIN tbl_account_individual ON tbl_account_individual.login_id = the_educational_qualification.login_id WHERE my_educational_qualification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";

		$sql7 = "select tbl_account_individual.*,concat('Lives in ',country) as in_common from tbl_account_individual where country = (select country from tbl_account_individual where login_id = {$login_id}) and login_id <> {$login_id} order by RAND() limit 3";
		
		try {
			$result0 = $this->dbh->query($sql0)->fetchAll(PDO::FETCH_ASSOC);
			$result1 = $this->dbh->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
			$result2 = $this->dbh->query($sql2)->fetchAll(PDO::FETCH_ASSOC);
			$result3 = $this->dbh->query($sql3)->fetchAll(PDO::FETCH_ASSOC);
			$result4 = $this->dbh->query($sql4)->fetchAll(PDO::FETCH_ASSOC);
			$result5 = $this->dbh->query($sql5)->fetchAll(PDO::FETCH_ASSOC);
			$result6 = $this->dbh->query($sql6)->fetchAll(PDO::FETCH_ASSOC);
			$result7 = $this->dbh->query($sql7)->fetchAll(PDO::FETCH_ASSOC);

			if (empty($result0)) $result0 = array();
			if (empty($result1)) $result1 = array();
			if (empty($result2)) $result2 = array();
			if (empty($result3)) $result3 = array();
			if (empty($result4)) $result4 = array();
			if (empty($result5)) $result5 = array();
			if (empty($result6)) $result6 = array();
			if (empty($result7)) $result7 = array();

			$results = array_merge($result1, $result2, $result3, $result4, $result5, $result6,$result7);
			$remove = $this->getMyConnections($login_id);
			// todo find a better implementation, or a better way to determine this
			$connected_login_ids = [];
			if(!empty($remove)){
				foreach ($remove as $item){
					$connected_login_ids[] = $item['login_id'];
				}
			}
			$the_filtered = [];
			if(!empty($results)){
				foreach ($results as $result) {
					$l = $result['login_id'];
					if(!in_array($l, $connected_login_ids)){
						$the_filtered[] = $result;
					}
				}
			}
			$results = make_array_unique($the_filtered, 'login_id');
			return $results;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
		
		
	}
	
	public function getMyConnections($login_id)
	{
		$sql1 = "SELECT tbl_account_individual.* FROM tbl_account_individual INNER JOIN tbl_connection ON
(tbl_account_individual.login_id = tbl_connection.login_id OR tbl_account_individual.login_id = tbl_connection.member_id)
WHERE (tbl_connection.login_id = {$login_id} OR tbl_connection.member_id = {$login_id}) AND tbl_account_individual.login_id != {$login_id};";
		
		try {
			$result = $this->dbh->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function ifConnected($user_id1, $user_id2)
	{
		$sql = "SELECT * FROM tbl_connection WHERE (member_id = {$user_id1} AND login_id = {$user_id2}) OR (member_id = {$user_id2} AND login_id = {$user_id1})";
		try {
			$result = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $result ? true : false;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}

	public function createConnection($login_id,$member_id){
		$sql = "insert ignore into tbl_connection values({$login_id},{$member_id},now())";
		$result = $this->dbh->exec($sql);
		return $result;
	}
	
// 	public function getSender($login_id){
// 		$sql = "SELECT firstname, lastname from tbl_account_individual WHERE login_id = {$login_id}";
// 		$result1 = $this->dbh->exec($sql);
// 		return $result1;
// 	}
	
// 	public function getReceiver($member_id){
// 		$sql = "SELECT firstname, lastname, email from tbl_account_individual WHERE login_id = {$member_id}";
// 		$result2 = $this->dbh->exec($sql);
// 		return $result2;
// 	}
	
}