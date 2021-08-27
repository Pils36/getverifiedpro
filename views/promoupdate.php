<?php

// error_reporting(1);

$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);
    
    $promo_state = $_POST['promo_state'];
    $login_id = $_POST['login_id'];
    
    $updt = $dbh->prepare('UPDATE `tbl_promo` SET `promo_state`= 2 WHERE login_id = "'.$login_id.'"');
    
    $res = $updt->execute();
    
    $success = json_encode($res);
    
    

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>