<?php

session_start();
ini_set('max_execution_time', 30);
error_reporting(E_ERROR | E_PARSE);
header("Content-type:application/json");
require_once("config.php");
require_once("signUp.php");
require_once("mailer.php");
require_once("login.php");
require_once("logout.php");
require_once("profile.php");
require_once("upload.php");
require_once("landing.php");
require_once("posts.php");
require_once("member.php");
require_once("opportunity.php");
require_once("contact.php");
require_once("search.php");
require_once("messages.php");
// require_once("google-api-php-client/vendor/autoload.php");
require_once("invites.php");
require_once("admin.php");
require_once("blog.php");

//var_dump($_FILES);exit;
//
if (isset($_POST["function"])) {
	$_POST = $_POST;
} else {
	$data = $_POST['json'];
	$_POST = json_decode($data, true);
}
if (is_callable($_POST['function'])) {
	echo $_POST['function']($dbh);
} else {

}
?>