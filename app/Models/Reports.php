<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 12/04/2018
 * Time: 03:50 AM
 */

class Reports
{
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	// users
	// used
	public function getTotalUsers($region = 'all'){
		
		$region_sql = '';
		if($region != 'all' && !empty($region)) {
			$region_sql .= " WHERE tbl_account_individual.country = '".$region."' ";
		}
		
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email, tbl_account_individual.country, tbl_company.specialisation FROM tbl_account_individual LEFT JOIN tbl_company ON tbl_company.login_id = tbl_account_individual.login_id ".$region_sql." GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	// used
	
	public function getBasicUsers(){
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email FROM tbl_account_individual JOIN tbl_subscription ON tbl_account_individual.login_id = tbl_subscription.login_id WHERE plan = 1 OR tbl_subscription.expiry_date < CURRENT_TIMESTAMP GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	// used
	
	public function getWeeklyClassicUsers()
	{
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email FROM tbl_account_individual JOIN tbl_subscription ON tbl_account_individual.login_id = tbl_subscription.login_id WHERE plan != 1 AND tbl_subscription.expiry_date >= CURRENT_TIMESTAMP AND YEARWEEK(tbl_subscription.subscription_date, 1) = YEARWEEK(CURDATE(), 1) GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getClassicUsers()
	{
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email FROM tbl_account_individual JOIN tbl_subscription ON tbl_account_individual.login_id = tbl_subscription.login_id WHERE plan != 1 AND tbl_subscription.expiry_date >= CURRENT_TIMESTAMP GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	
	// profiles
	// used
	
	public function getCompletedProfiles($region = 'all'){
		$region_sql = '';
		if($region != 'all' && !empty($region)) {
			$region_sql .= " AND tbl_account_individual.country = '".$region."' ";
		}
		
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email FROM tbl_account_individual WHERE tbl_account_individual.email_verified = 1 ".$region_sql." GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	// used
	
	public function getUncompletedProfiles($region = 'all')
	{
		$region_sql = '';
		if($region != 'all' && !empty($region)) {
			$region_sql .= " AND tbl_account_individual.country = '".$region."' ";
		}
		
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email FROM tbl_account_individual WHERE tbl_account_individual.email_verified = 0 ".$region_sql." GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return ($members);
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	// growth
	
	// used
	
	public function getTotalImportedContacts()
	{
		
		$sql = "SELECT imported.firstname, imported.lastname, imported.email, CONCAT(importer.firstname, ' ', importer.lastname) AS importer_fullname FROM tbl_account_individual AS imported JOIN tbl_invites ON tbl_invites.sent_to = imported.email JOIN tbl_account_individual AS importer ON importer.login_id = tbl_invites.login_id GROUP BY imported.login_id";
		
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	// used
	
	public function getWeeklyImportedContacts()
	{
	
		$sql = "SELECT imported.firstname, imported.lastname, imported.email, CONCAT(importer.firstname, ' ', importer.lastname) AS importer_fullname FROM tbl_account_individual AS imported JOIN tbl_invites ON tbl_invites.sent_to = imported.email JOIN tbl_account_individual AS importer ON importer.login_id = tbl_invites.login_id WHERE YEARWEEK(tbl_invites.date_sent, 1) = YEARWEEK(CURDATE(), 1) GROUP BY imported.login_id";
		
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	// used
	
	public function getWeeklyCompletedProfiles()
	{
		
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email FROM tbl_account_individual WHERE tbl_account_individual.email_verified = 0 AND YEARWEEK(tbl_account_individual.date_verified, 1) = YEARWEEK(CURDATE(), 1) GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	// used
	
	public function getWeeklyNewSignUps(){
	
		$sql = "SELECT tbl_account_individual.id FROM tbl_account_individual JOIN tbl_login ON tbl_account_individual.login_id = tbl_login.login_id WHERE YEARWEEK(tbl_login.date_created, 1) = YEARWEEK(CURDATE(), 1) GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	// validations
	
	// used
	
	public function getValidationsOverDateRange($start_date = '', $end_date = ''){
		
		if(empty($start_date) || empty($end_date)) {
			$date_range_q = '';
		}else{
			$date_range_q = " WHERE tbl_validation.date_validated BETWEEN '{$start_date}' AND '{$end_date}' ";
		}
		
		$sql = "SELECT tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.email, (SELECT COUNT(*) FROM tbl_validation WHERE member_id = tbl_account_individual.login_id) AS num_of_validations FROM tbl_validation JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_validation.member_id".$date_range_q." GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	
	public function  getUsersOverDateRange($start_date = '', $end_date = ''){
		
		if(empty($start_date) || empty($end_date)) {
			$date_range_q = '';
		}else{
			$date_range_q = " WHERE tbl_login.date_created BETWEEN '{$start_date}' AND '{$end_date}' ";
		}
		
		
		$sql = "SELECT tbl_account_individual.id FROM tbl_account_individual JOIN tbl_login ON tbl_account_individual.login_id = tbl_login.login_id ".$date_range_q." GROUP BY tbl_account_individual.login_id";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	
	public function getImportedContactsOverDateRange($start_date = '', $end_date = ''){
		
		if(empty($start_date) || empty($end_date)) {
			$date_range_q = '';
		}else{
			$date_range_q = " WHERE tbl_login.date_created BETWEEN '{$start_date}' AND '{$end_date}' ";
		}
		
		$sql = "SELECT imported.firstname, imported.lastname, imported.email, CONCAT(importer.firstname, ' ', importer.lastname) AS importer_fullname FROM tbl_account_individual AS imported JOIN tbl_invites ON tbl_invites.sent_to = imported.email JOIN tbl_account_individual AS importer ON importer.login_id = tbl_invites.login_id JOIN tbl_login ON tbl_login.login_id = imported.login_id ".$date_range_q." GROUP BY tbl_account_individual.login_id";
		
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	// utilisation
	// used
	
	public function getProfileViewed($start_date = '', $end_date = ''){
		
		if(empty($start_date) || empty($end_date)) {
			$date_range_q = '';
		}else{
			$date_range_q = " WHERE tbl_profile_views.date_viewed BETWEEN '{$start_date}' AND '{$end_date}' ";
		}
		
		$sql = "SELECT tbl_account_individual.firstname, lastname, email, (SELECT COUNT(*) FROM tbl_profile_views WHERE member_login_id = tbl_account_individual.login_id) AS num_of_views FROM tbl_profile_views JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_profile_views.member_login_id".$date_range_q." ORDER BY num_of_views ASC";
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	// used
	
	public function getActiveOpportunities($start_date = '', $end_date = ''){
		
		if(empty($start_date) || empty($end_date)) {
			$date_range_q = '';
		}else{
			$date_range_q = " AND tbl_opportunity.date_added BETWEEN '{$start_date}' AND '{$end_date}' ";
		}
		
		$sql = "SELECT tbl_opportunity.subject, tbl_opportunity.description, tbl_opportunity.deadline FROM tbl_opportunity WHERE tbl_opportunity.status = 'open'".$date_range_q;
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	// used
	
	public function getExpiredOpportunities($start_date = '', $end_date = ''){
		
		if(empty($start_date) || empty($end_date)) {
			$date_range_q = '';
		}else{
			$date_range_q = " AND tbl_opportunity.date_added BETWEEN '{$start_date}' AND '{$end_date}' ";
		}
		
		$sql = "SELECT tbl_opportunity.subject, tbl_opportunity.description, tbl_opportunity.deadline FROM tbl_opportunity WHERE tbl_opportunity.status = 'closed'".$date_range_q;
		try {
			$members = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
}