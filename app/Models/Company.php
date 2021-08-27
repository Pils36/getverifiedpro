<?php

class Company
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function getUserCompany($user_id)
	{
		$sql = "SELECT * FROM tbl_company WHERE login_id = {$user_id}";
		try {
			$company = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $company;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
}