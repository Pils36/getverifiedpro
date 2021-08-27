<?php

/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 24/03/2018
 * Time: 07:10 AM
 */
class Group
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function fetchGroup($group_id){
		return $this->dbh->query("select * from tbl_groups where id = {$group_id}")->fetch(PDO::FETCH_ASSOC);
	}
	public function create($title, $owner_login_id)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_groups(title, owner_login_id) VALUES (:title, :owner_login_id)");
			$stmt->execute(array(
				":title" => $title,
				":owner_login_id" => $owner_login_id,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function createGroupMember($group_id, $login_id)
	{
		try {
			
			$stmt = $this->dbh->prepare("INSERT INTO tbl_group_members (group_id, login_id) VALUES (:group_id, :login_id)");
			$stmt->execute(array(
				":group_id" => $group_id,
				":login_id" => $login_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function checkIfGroupMember($group_id, $login_id)
	{
		try {
			$groups = $this->dbh->query("SELECT id FROM tbl_group_members WHERE group_id = $group_id AND login_id = $login_id ORDER BY date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			return !empty($groups) ? true : false;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getAllGroups()
	{
		try {
			$groups = $this->dbh->query("SELECT * FROM tbl_groups ORDER BY date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getAGroup($group_id)
	{
		try {
			$groups = $this->dbh->query("SELECT * FROM tbl_groups WHERE id = {$group_id} ORDER BY date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			return $groups;
			
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getGroupMembers($group_id)
	{
		try {
			$groups = $this->dbh->query("SELECT tbl_group_members.*, tbl_groups.owner_login_id, tbl_groups.title, tbl_groups.id AS group_id, tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.photo, tbl_account_individual.online_status, tbl_account_individual.last_seen FROM tbl_group_members JOIN tbl_groups ON tbl_group_members.group_id = tbl_groups.id JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_group_members.login_id WHERE tbl_group_members.group_id = {$group_id} ORDER BY tbl_group_members.date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getUserGroups($user_id)
	{
		try {
			$groups = $this->dbh->query("SELECT tbl_groups.* FROM tbl_groups LEFT JOIN tbl_group_members ON tbl_group_members.group_id = tbl_groups.id WHERE tbl_group_members.login_id = {$user_id} ORDER BY tbl_group_members.date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getAllMyGroupMembers($login_id)
	{
		try {
			$groups = $this->dbh->query("SELECT tbl_group_members.*, tbl_groups.owner_login_id, tbl_groups.title, tbl_groups.id AS group_id, tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.photo FROM tbl_group_members JOIN tbl_groups ON tbl_group_members.group_id = tbl_groups.id JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_group_members.login_id WHERE tbl_groups.owner_login_id = {$login_id} AND tbl_group_members.login_id != {$login_id} ORDER BY tbl_group_members.date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function updateGroup($group_id, $title)
	{
		try {
			$stmt = $this->dbh->prepare("UPDATE tbl_groups SET title = :title WHERE id = :id");
			$stmt->execute(array(
				":title" => $title,
				":id" => $group_id,
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteGroupMember($group_id, $login_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_group_members WHERE group_id = :group_id AND login_id = :login_id");
			$stmt->execute(array(
				":group_id" => $group_id,
				":login_id" => $login_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteAllGroupMembers($group_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_group_members WHERE group_id = :group_id");
			$stmt->execute(array(
				":group_id" => $group_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteGroup($group_id, $owner_login_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_groups WHERE id = :group_id AND owner_login_id = :login_id");
			$stmt->execute(array(
				":group_id" => $group_id,
				":login_id" => $owner_login_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
}