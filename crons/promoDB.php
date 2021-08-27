<?php
require "config.php";
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
try {

// 	Get user information from tbl_account_individual:::
 $user = $dbh->query("SELECT login_id, firstname, lastname, email from tbl_account_individual")->fetchAll(PDO::FETCH_ASSOC);
 
 foreach($user as $key){
    // Loop through all users to fetch report
	   $login_id = $key['login_id'];
	   $firstname = $key['firstname'];
	   $lastname = $key['lastname'];
	   $email = $key['email'];
	   
	   
// 	industry xperience
	$ind = $dbh->query("SELECT COUNT(*) AS indcount, login_id FROM `tbl_industry_experience` WHERE login_id = '".$login_id."' ")->fetchAll(PDO::FETCH_ASSOC);
	
// 	education qualification
$edu = $dbh->query("SELECT COUNT(*) AS educount, login_id FROM `tbl_educational_qualification` WHERE login_id = '".$login_id."' ")->fetchAll(PDO::FETCH_ASSOC);

// Professional cert
$pro = $dbh->query("SELECT COUNT(*) AS procount, login_id FROM `tbl_professional_certification` WHERE login_id = '".$login_id."' ")->fetchAll(PDO::FETCH_ASSOC);

// Religion
$rel = $dbh->query("SELECT COUNT(*) AS relcount, login_id FROM `tbl_affiliation` WHERE login_id = '".$login_id."' ")->fetchAll(PDO::FETCH_ASSOC);

// Executed project
$exe = $dbh->query("SELECT COUNT(*) AS execount, login_id FROM `tbl_executed_project` WHERE login_id = '".$login_id."' ")->fetchAll(PDO::FETCH_ASSOC);


// Profile Picture
$propic = $dbh->query("SELECT COUNT(*) as pro_count FROM `tbl_account_individual` WHERE login_id = '".$login_id."' AND photo = 'profile-placeholder.png' OR photo IS null")->fetchAll(PDO::FETCH_ASSOC);

// Company Profile

$coyprof = $dbh->query("SELECT COUNT(*) as coy_count FROM `tbl_company` WHERE login_id = '".$login_id."'")->fetchAll(PDO::FETCH_ASSOC);

// print_r($coyprof);

// Subscribed Users

$sub = $dbh->query("SELECT COUNT(*) AS subcount, login_id FROM `tbl_subscription` WHERE expiry_date >=NOW() AND login_id = '".$login_id."' ")->fetchAll(PDO::FETCH_ASSOC);

// If active user
 $acct_state = $dbh->query("SELECT acct_state from tbl_account_individual WHERE login_id = '".$login_id."'")->fetchAll(PDO::FETCH_ASSOC);
 
$numacct = count($acct_state);
    
    $indcol = $ind[0]['indcount'];
    $educol = $edu[0]['educount'];
    $procol = $pro[0]['procount'];
    $relcol = $rel[0]['relcount'];
    if($relcol > 0){$relcol = 1;}else{$relcol = 0;}
    $execol = $exe[0]['execount'];
    $propiccol = $propic[0]['pro_count'];
    if($propiccol == 0){$propiccol = 1;}else{$propiccol = 0;}
    $coyprofcol = $coyprof[0]['coy_count'];
    if($coyprofcol > 0){$coyprofcol = 1;}else{$coyprofcol = 0;}
    
    $subcol = $sub[0]['subcount'];
    $acctcol = $acct_state[0]['acct_state'];
    
    $tot = $indcol+$educol+$procol+$relcol+$execol+$propiccol+$coyprofcol;
    
    if($tot >= 14){
        $percent = 100;
    }
    elseif($tot == 13){
        $percent = 92.8;
        
    }
    elseif($tot == 12){
        $percent = 85.7;
        
    }
    elseif($tot == 11){
        $percent = 78.6;
        
    }
    elseif($tot == 10){
        $percent = 71.4;
        
    }
    elseif($tot == 9){
        $percent = 64.3;
        
    }
    elseif($tot == 8){
        $percent = 57.1;
        
    }
    elseif($tot == 7){
        $percent = 50;
       
    }
    elseif($tot == 6){
        $percent = 42.8;
        
    }
    elseif($tot == 5){
        $percent = 35.7;
        
    }
    elseif($tot == 4){
        $percent = 28.6;
        
    }
    elseif($tot == 3){
        $percent = 21.4;
       
    }
    elseif($tot == 2){
        $percent = 14.3;
        
    }
    elseif($tot == 1){
        $percent = 7.1;
    }
    else{
        $percent = 0;
    }
 
    
    // Check users in tbl_promo table
    
    $promo = $dbh->query("SELECT * FROM `tbl_promo` WHERE login_id = $login_id;")->fetchAll(PDO::FETCH_ASSOC);
    
    $numrows = count($promo);
    
    

    
// If there is a new promo record
if ($numrows == 0) {
    
        
        $ins = $dbh->prepare('INSERT INTO `tbl_promo` (`login_id`, `firstname`, `lastname`, `email`,`indcount`, `educount`, `procount`, `relcount`, `execount`,`propic_count`,`coy_count`,`totcount`, `percent`, `sub_status`,`acct_state`) VALUES ("'.$login_id.'", "'.$firstname.'", "'.$lastname.'", "'.$email.'", "'.$indcol.'", "'.$educol.'", "'.$procol.'", "'.$relcol.'", "'.$execol.'","'.$propiccol.'","'.$coyprofcol.'", "'.$tot.'", "'.$percent.'", "'.$subcol.'", "'.$acctcol.'");');
        
        $ins->execute();
        
        echo "For new <br>";
        print_r($ins);
        echo "<hr>";
        
}


elseif($numrows > 0){
    
    $updt = $dbh->prepare('UPDATE `tbl_promo` SET `login_id`="'.$login_id.'",`firstname`="'.$firstname.'",`lastname`="'.$lastname.'",`email`="'.$email.'",`indcount`="'.$indcol.'",`educount`="'.$educol.'",`procount`="'.$procol.'",`relcount`="'.$relcol.'",`execount`="'.$execol.'",`propic_count`="'.$propiccol.'",`coy_count`="'.$coyprofcol.'",`totcount`="'.$tot.'",`percent`="'.$percent.'",`sub_status`="'.$subcol.'",`state`=1,`acct_state`="'.$acctcol.'" WHERE login_id = "'.$login_id.'" AND percent > 24');
    
    $updt->execute();
    
    echo "For update <br>";
    print_r($updt);
    echo "<hr>";
    
}


// print_r($acct_state);


}

	
	
	echo "Done";
	
} catch (Exception $ex) {
	echo $ex->getMessage();
}



?>