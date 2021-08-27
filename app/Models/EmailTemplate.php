<?php

class EmailTemplate
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function create($subject, $body)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_email_templates(subject, body_text) VALUES (:subject, :body_text)");
			$stmt->execute(array(
				":subject" => $subject,
				":body_text" => $body,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function edit($template_id, $subject, $body)
	{
		try {
			$stmt = $this->dbh->prepare("UPDATE tbl_email_templates SET subject = :subject, body_text = :body_text WHERE id = :id");
			$stmt->execute(array(
				":subject" => $subject,
				":body_text" => $body,
				":id" => $template_id,
			));
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getEmailTemplates()
	{
		$sql = "SELECT subject, id FROM tbl_email_templates ORDER BY created_at";
		try {
			$company = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $company;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getAnEmailTemplate($template_id)
	{
		$sql = "SELECT * FROM tbl_email_templates WHERE id = {$template_id}";
		try {
			$company = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $company;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	public function deleteEmail($email_id)
	{
		try {
			$stmt = $this->dbh->prepare("DELETE FROM tbl_email_templates WHERE id = :email_id");
			$stmt->execute(array(
				":email_id" => $email_id,
			));
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
}