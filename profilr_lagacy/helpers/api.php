<?php
require_once("jwt_helper.php");
$userArray = array(
	"username" => "ola",
	"password" => "qwerty"
);
echo JWT::encode($userArray, 'secret_server_key');
?>