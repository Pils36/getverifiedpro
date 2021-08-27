<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 24/03/2018
 * Time: 04:52 AM
 */

class IndustryExperience
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function create($login_id, $position, $company, $location, $from_month, $from_year, $to_month, $to_year, $description, $award, $specialisation)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_industry_experience (login_id, position, company, location, from_month, from_year, to_month, to_year, description, award, specialisation) VALUES (:login_id, :position, :company, :location, :from_month, :from_year, :to_month, :to_year, :description, :award, :specialisation)");
			$stmt->execute(array(
				":login_id" => $login_id,
				":position" => $position,
				":company" => $company,
				":location" => $location,
				":from_month" => $from_month,
				":from_year" => $from_year,
				":to_month" => $to_month,
				":to_year" => $to_year,
				":description" => $description,
				":award" => $award,
				":specialisation" => $specialisation,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function ifUserExistInCompany($login_id, $company)
	{
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM tbl_industry_experience WHERE company =:company AND login_id = :login_id");
			$stmt->execute(array(
				"company" => $company,
				":login_id" => $login_id
			));
			$row_count = $stmt->rowCount();
			//return $row_count;
			if ($row_count > 0) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
}