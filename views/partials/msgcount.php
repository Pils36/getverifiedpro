<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (!validateLogin()) {
    
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}


?>

<?php


$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);
    
    $login_id = $_SESSION['login_id'];
    
    print_r(json_encode($login_id));

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>

