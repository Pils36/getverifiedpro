<?php
$o = array(
	"hostname" => "localhost",
	"dbname" => "profilr_data",
//	"dbname" => "profilr_data",
	"password" => "portFOLIO_2015",
//	"password" => "",
	"username" => "profilr_user",
//	"username" => "root",
	"port" => "3306"
);
$db = (object)$o;
//$dbh = new PDO('mysql:host=$db->hostname;dbname=$db->dbname;charset=utf8mb4', 'username', 'password');
try {
	$dbh = new PDO("mysql:host=$db->hostname;port=$db->port;dbname=$db->dbname;charset=utf8", $db->username, $db->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $ex) {
	$myMessage = new response("error", array(), $ex->getMessage());
	echo json_encode($myMessage);
	
}

class response
{
	public $status;
	public $data = array();
	public $message;
	
	function __construct($status='', $data='', $message='')
	{
		$this->status = $status;
		$this->data = $data;
		$this->message = $message;
	}
	
	
}

;
?>