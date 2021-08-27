<?php
ini_set('max_execution_time', 0);
// error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL);
$o = array(
	"hostname" => "localhost",
//	"dbname"=>"profilr_data",
	"dbname" => "profilr",
//	"password"=>"portFOLIO_2015",
	"password" => "",
//	"username"=>"profilr_user",
	"username" => "root",
	"port" => "3306"
);
$db = (object)$o;

try {
	$dbh = new PDO("mysql:host=$db->hostname;port=$db->port;dbname=$db->dbname;charset=utf8", $db->username, $db->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $ex) {
	// $myMessage = new response("error",array(),$ex->getMessage());
	// echo json_encode($myMessage);
	
}
?>