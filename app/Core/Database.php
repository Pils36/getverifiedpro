<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 10/03/2018
 * Time: 10:38 PM
 */

class Database
{
	private static $_instance;
	private $connection;
	
	/*
	Get an instance of the Database
	@return Instance
	*/
	
	protected function __construct()
	{
		$this->connection = new PDO("mysql:host=" . DB_HOSTNAME . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8", DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//		$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$tz = (new DateTime('now', new DateTimeZone('Africa/Lagos')))->format('P');
		$this->connection->query("SET time_zone='$tz';");
		// $this->connection->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
		// Error handling
		if (mysqli_connect_error()) {
			trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(),
				E_USER_ERROR);
		}
	}
	
	
	// Constructor
	
	public static function getInstance()
	{
		if (!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance->connection;
	}
	
	// Magic method clone is empty to prevent duplication of connection
	public function __clone()
	{
	}
	
}