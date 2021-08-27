<?php

/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 24/03/2018
 * Time: 07:10 AM
 */
class Message
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function create($sent_by, $sent_to, $content, $message_type = 'private', $subject = '', $status = 'not-read', $post_id = 0)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_message(sent_by, sent_to, subject, content, post_id, status, message_type) VALUES (:sent_by, :sent_to, :subject, :content, :post_id, :status, :message_type)");
			$stmt->execute(array(
				":sent_by" => $sent_by,
				":sent_to" => $sent_to,
				":subject" => $subject,
				":content" => $content,
				":post_id" => $post_id,
				":status" => $status,
				":message_type" => $message_type,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getGroupMessages($group_id)
	{
		try {
			$groups = $this->dbh->query("SELECT tbl_message.*, tbl_groups.title, tbl_groups.id AS group_id, tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.photo FROM tbl_message JOIN tbl_groups ON tbl_message.sent_to = tbl_groups.id JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_message.sent_by WHERE tbl_groups.id = {$group_id} AND tbl_message.message_type = 'group' ORDER BY tbl_message.date_sent ASC")->fetchAll(PDO::FETCH_ASSOC);
			
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function createFile($filename, $owner_id, $message_type)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_files(owner_id, filename, message_type) VALUES (:owner_id, :filename, :message_type)");
			$stmt->execute(array(
				":owner_id" => $owner_id,
				":filename" => $filename,
				":message_type" => $message_type,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getGroupFiles($group_id)
	{
		try {
			$groups = $this->dbh->query("SELECT tbl_files.*, tbl_groups.title FROM tbl_files JOIN tbl_groups ON tbl_groups.id = tbl_files.owner_id WHERE tbl_files.owner_id = {$group_id} AND tbl_files.message_type = 'group' ORDER BY tbl_files.created_at ASC")->fetchAll(PDO::FETCH_ASSOC);
			
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getProjectMessages($project_id)
	{
		try {
			$projects = $this->dbh->query("SELECT tbl_message.*, tbl_projects.title, tbl_projects.id AS project_id, tbl_account_individual.firstname, tbl_account_individual.lastname, tbl_account_individual.photo FROM tbl_message JOIN tbl_projects ON tbl_message.sent_to = tbl_projects.id JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_message.sent_by WHERE tbl_projects.id = {$project_id} AND tbl_message.message_type = 'project' ORDER BY tbl_message.date_sent ASC")->fetchAll(PDO::FETCH_ASSOC);
			
			return $projects;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	
	public function getProjectFiles($project_id)
	{
		try {
			$groups = $this->dbh->query("SELECT tbl_files.*, tbl_projects.title FROM tbl_files JOIN tbl_projects ON tbl_projects.id = tbl_files.owner_id WHERE tbl_files.owner_id = {$project_id} AND tbl_files.message_type = 'project' ORDER BY tbl_files.created_at ASC")->fetchAll(PDO::FETCH_ASSOC);
			
			return $groups;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
}