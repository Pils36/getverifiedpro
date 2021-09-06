<?php


// $user = 'root';
// $pass = '';
// $database = 'profilr_beta';
 $user = 'exbcca_profilr_beta';
 $pass = 'getverifiedpro2021!';
 $database = 'exbcca_profilr_beta';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname='.$database, $user, $pass);

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

