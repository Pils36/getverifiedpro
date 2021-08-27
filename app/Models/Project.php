<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 27/03/2018
 * Time: 09:18 AM
 */

class Project
{
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function create($user_id, $title)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_projects(title, owner_login_id) VALUES (:title, :owner_login_id)");
			$stmt->execute(array(
				":title" => $title,
				":owner_login_id" => $user_id,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function createProjectTask($project_id, $user_id, $title, $if_completed)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_project_tasks(project_id, member_login_id, title, if_completed) VALUES (:project_id, :member_login_id, :title, :if_completed)");
			$stmt->execute(array(
				":title" => $title,
				":project_id" => $project_id,
				":if_completed" => $if_completed,
				":member_login_id" => $user_id,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getAProject($project_id)
	{
		return $this->dbh->query("select * from tbl_projects where id = {$project_id}")->fetch(PDO::FETCH_ASSOC);
	}
	
	public function getUserProjects($user_id)
	{
		try {
			$projects = $this->dbh->query("SELECT DISTINCT tbl_projects.* FROM tbl_projects LEFT JOIN tbl_project_tasks ON tbl_project_tasks.project_id = tbl_projects.id WHERE tbl_project_tasks.member_login_id = {$user_id} OR tbl_projects.owner_login_id = {$user_id} ORDER BY tbl_projects.date_created DESC ")->fetchAll(PDO::FETCH_ASSOC);
			return $projects;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getProjectTasks($project_id)
	{
		try {
			$projects = $this->dbh->query("SELECT tbl_project_tasks.*, tbl_projects.title AS project_title, tbl_projects.owner_login_id, tbl_projects.id AS project_id, tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.photo FROM tbl_project_tasks JOIN tbl_projects ON tbl_project_tasks.project_id = tbl_projects.id JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_project_tasks.member_login_id WHERE tbl_projects.id = {$project_id} ORDER BY tbl_project_tasks.date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
			
			return $projects;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getProjectMembers($project_id)
	{
		try {
			$sql1 = "SELECT tbl_account_individual.*, tbl_projects.owner_login_id, tbl_projects.title, tbl_projects.id AS project_id FROM tbl_account_individual JOIN tbl_projects ON tbl_projects.owner_login_id = tbl_account_individual.login_id WHERE tbl_projects.id = {$project_id}";
			
			$sql2 = "SELECT tbl_account_individual.*, tbl_projects.owner_login_id, tbl_projects.title, tbl_projects.id AS project_id FROM tbl_account_individual LEFT JOIN tbl_project_tasks ON tbl_account_individual.login_id = tbl_project_tasks.member_login_id LEFT JOIN tbl_projects ON tbl_projects.id = tbl_project_tasks.project_id WHERE tbl_project_tasks.project_id = {$project_id}";
			$member = $this->dbh->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
			$members = $this->dbh->query($sql2)->fetchAll(PDO::FETCH_ASSOC);
			
			$members = array_merge($members, $member);
			$members = make_array_unique($members, 'login_id');
			return (array) $members;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function update($project_id, $title)
	{
		
	}
	
	public function deleteAllProjectTasks($project_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_project_tasks WHERE project_id = :project_id");
			$stmt->execute(array(
				":project_id" => $project_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteAllProjectComments($project_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_project_comments WHERE project_id = :project_id");
			$stmt->execute(array(
				":project_id" => $project_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteProject($project_id, $owner_login_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_projects WHERE id = :project_id AND owner_login_id = :login_id");
			$stmt->execute(array(
				":project_id" => $project_id,
				":login_id" => $owner_login_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteProjectTask($project_id, $task_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_project_tasks WHERE id = :task_id AND project_id = :project_id");
			$stmt->execute(array(
				":project_id" => $project_id,
				":task_id" => $task_id
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
}
