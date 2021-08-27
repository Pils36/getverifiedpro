<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 24/03/2018
 * Time: 04:52 AM
 */

class AccountIndividual
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function fetchMember($member_id){
		return $this->dbh->query("select * from tbl_account_individual where login_id = {$member_id}")->fetch(PDO::FETCH_ASSOC);
	} 
	
	public function updatePictureAndCompany($login_id, $picture_name, $company)
	{
		try {
			$stmt = $this->dbh->prepare("UPDATE tbl_account_individual SET photo = :picture_name, company = :company WHERE login_id = :login_id");
			$stmt->execute(array(
				":picture_name" => $picture_name,
				":company" => $company,
				":login_id" => $login_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function searchIndividualAccount($keyword)
	{
		try {
			$members = $this->dbh->query("SELECT tbl_account_individual.*
			FROM tbl_account_individual
			LEFT JOIN tbl_affiliation ON tbl_affiliation.login_id = tbl_account_individual.login_id
			LEFT JOIN tbl_educational_qualification ON tbl_educational_qualification.login_id = tbl_account_individual.login_id
			LEFT JOIN tbl_industry_experience ON tbl_industry_experience.login_id = tbl_account_individual.login_id
			LEFT JOIN tbl_professional_certification ON tbl_professional_certification.login_id = tbl_account_individual.login_id
			WHERE
			tbl_account_individual.lastname LIKE '%$keyword%' OR
			tbl_account_individual.firstname LIKE '%$keyword%' OR
			tbl_account_individual.country LIKE '%$keyword%' OR
			tbl_account_individual.city LIKE '%$keyword%' OR
			tbl_account_individual.website LIKE '%$keyword%' OR
			tbl_account_individual.industry LIKE '%$keyword%' OR
			tbl_account_individual.company LIKE '%$keyword%' OR
			tbl_account_individual.position LIKE '%$keyword%' OR
			tbl_account_individual.profession LIKE '%$keyword%' OR
			tbl_affiliation.organisation LIKE '%$keyword%' OR
			tbl_affiliation.`group` LIKE '%$keyword%' OR
			tbl_educational_qualification.school LIKE '%$keyword%' OR
			tbl_educational_qualification.degree LIKE '%$keyword%' OR
			tbl_educational_qualification.field_of_study LIKE '%$keyword%' OR
			tbl_industry_experience.position LIKE '%$keyword%' OR
			tbl_industry_experience.company	 LIKE '%$keyword%' OR
			tbl_industry_experience.specialisation	 LIKE '%$keyword%' OR
			tbl_professional_certification.institution	 LIKE '%$keyword%' OR
			tbl_professional_certification.certification	 LIKE '%$keyword%' OR
			tbl_professional_certification.specialization	 LIKE '%$keyword%'
			GROUP BY tbl_account_individual.login_id
			ORDER BY lastname")->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getAllAccounts()
	{
		try {
			$members = $this->dbh->query("SELECT * FROM tbl_account_individual ORDER BY lastname")->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getValidationItems($table, $member_id)
	{
		switch ($table) {
			case 'industry_experience':
				$sql = "SELECT company AS item_title FROM tbl_industry_experience WHERE login_id = {$member_id} GROUP BY item_title";
				break;
			case 'executed_project':
				$sql = "SELECT project_employer AS item_title FROM tbl_executed_project WHERE login_id = {$member_id} GROUP BY item_title";
				break;
			case 'educational_qualification':
				$sql = "SELECT school AS item_title FROM tbl_educational_qualification WHERE login_id = {$member_id} GROUP BY item_title";
				break;
			case 'professional_certification':
				$sql = "SELECT institution AS item_title FROM tbl_professional_certification WHERE login_id = {$member_id} GROUP BY item_title";
				break;
			case 'affiliation':
				$sql = "SELECT organisation AS item_title FROM tbl_affiliation WHERE login_id = {$member_id} GROUP BY item_title";
				break;
			default:
				return false;
		}
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function updateOnlineStatus($login_id, $status)
	{
		try {
			$stmt = $this->dbh->prepare("UPDATE tbl_account_individual SET online_status = :login_status WHERE login_id = :login_id");
			$stmt->execute(array(
				":login_id" => $login_id,
				":login_status" => $status
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getFilteredUserEmails($filter_by)
	{
		try {
			switch ($filter_by['email_verify']) {
				case 'All':
					$email_verify_sql = '';
					break;
				case 'Verified Emails':
					$email_verify_sql = ' tbl_account_individual.email_verified != 0';
					break;
				case 'Unverified Emails':
					$email_verify_sql = ' tbl_account_individual.email_verified = 0';
					break;
				default:
					$email_verify_sql = '';
					break;
			}
			
			if(!empty($countries = $filter_by['country'])){
				$country_sql = " ( ";
				$i = count($countries);
				
				foreach ($countries as $country){
					$i--;
					$country_sql .= "tbl_account_individual.country = '".$country."'";
					if($i){
						$country_sql .= " OR ";
					}
				}
				$country_sql .= ' )';
			}else{
				$country_sql = '';
			}
			
			
			if(!empty($filter_by['min_profile_views'])){
				$profile_view_sql = ' profile_views_count >= '.$filter_by['min_profile_views'].' ';
			}elseif(!empty($filter_by['max_profile_views'])){
				$profile_view_sql = ' profile_views_count <= '.$filter_by['max_profile_views'].'';
				
			}else{
				$profile_view_sql = '';
				
			}
			$extra_sql = $append_sql = '';
			if($email_verify_sql) $append_sql .= $email_verify_sql;
//			if(!empty($email_verify_sql)) $append_sql .= ' AND ';
			if($country_sql) $append_sql .= ' AND '.$country_sql;
//			if(!empty($country_sql)) $append_sql .= ' AND ';
			if($profile_view_sql) $append_sql .= ' AND '.$profile_view_sql;
			if(!empty($append_sql)) $extra_sql = ' WHERE '.$append_sql;
			
			// get all users
			$sql = "SELECT tbl_account_individual.email, (SELECT COUNT(*) FROM tbl_profile_views WHERE tbl_profile_views.member_login_id = tbl_account_individual.login_id) AS profile_views_count FROM tbl_account_individual".$extra_sql." ";
			
//			echo $sql;
			
			$all = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			
			$all_members_emails = [];
			if(!empty($all)){
				foreach ($all as $item){
					$all_members_emails[] = $item['email'];
				}
			}
			if($filter_by['user_group'] === 'Completed Profiles' || $filter_by['user_group'] === 'Uncompleted Profiles'){
				
				// get all completed profiles
				
				$sql = "SELECT tbl_account_individual.email WHERE tbl_account_individual.email_verified = 1 ".$extra_sql." GROUP BY tbl_account_individual.login_id";
				$completed = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
				
				$completed_members_emails = [];
				if(!empty($completed)){
					foreach ($completed as $item){
						$completed_members_emails[] = $item['email'];
					}
				}
			}elseif ($filter_by['user_group'] === 'Classic Profiles' || $filter_by['user_group'] === 'Non Classic Profiles')
			{
				// get all classic profiles
				
				$sql = "SELECT tbl_account_individual.email, (SELECT COUNT(*) FROM tbl_profile_views WHERE tbl_profile_views.member_login_id = tbl_account_individual.login_id) AS profile_views_count FROM tbl_account_individual JOIN tbl_subscription ON tbl_account_individual.login_id = tbl_subscription.login_id".$extra_sql." AND plan != 1 GROUP BY tbl_account_individual.login_id";
				$classic = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
				
				$classic_members_emails = [];
				if(!empty($classic)){
					foreach ($classic as $item){
						$classic_members_emails[] = $item['email'];
					}
				}
				
			}
			switch ($filter_by['user_group']) {
				case 'All Users':
					// get all users
					$members = $all_members_emails;
					break;
				case 'Completed Profiles':
					//get completed profiles
					$members = $completed_members_emails;
					break;
				case 'Classic Profiles':
					//get classic profiles
					$members = $classic_members_emails;
					break;
				case 'Uncompleted Profiles':
					//all users - completed profiles
					$members = [];
					if (!empty($all_members_emails)) {
//						var_dump($all_members_emails);
						foreach ($all_members_emails as $email) {
//							echo $email;
							if (!in_array($email, $completed_members_emails)) {
								$members[] = $email;
							}
						}
					}
					break;
				case 'Non Classic Profiles':
					$members = [];
					if (!empty($all_members_emails)) {
						foreach ($all_members_emails as $email) {
							if (!in_array($email, $classic_members_emails)) {
								$members[] = $email;
							}
						}
					}
					break;
				default:
					return false;
			}
			
//			var_dump($members);
//			exit;
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
}