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

    require './config/dataconfig.php';
?>

<?php

if(isset($_POST['submit'])){
    
     $table=$dbh->query("
    ALTER TABLE tbl_login 
    AUTO_INCREMENT = 1");
    $table->execute();
    
    $login_id = $_SESSION['login_id'];
    
    $hash_password = $_POST['password'];
    $hash_cpassword = $_POST['cpassword'];
    
    $password = md5($hash_password);
    $cpassword = md5($hash_cpassword);
    
    $stmt = $dbh->query("SELECT email FROM tbl_login WHERE login_id= '".$login_id."'");
    $stmt->execute();
    $res = $stmt->fetchAll();
    $numRow = $stmt->rowCount();
    
    
    if($password == $cpassword){
        
        $user = "SELECT firstname, lastname, email FROM tbl_account_individual WHERE login_id = '".$login_id."'";
        $getUser = $dbh->prepare($user);
        
        $getUser->execute();
        
        $result = $getUser->fetchAll();
        
        $email = $result[0]["email"];
        $firstname = $result[0]["firstname"];
        $lastname = $result[0]["lastname"];
        // print_r($result[0]["email"]);
    
    if($numRow == 1){
        
        $sql = "UPDATE tbl_login SET password = :password WHERE EMAIL = '".$email."'";
    
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        
         // Mail
        $to = $email;
        // $to = "bambo.adenuga@pro-filr.com";
        $subject = "Change Password on Pro-filr";
        
        $message = "<html><head><title>Change Password</title></head><body><div><img src='https://modplus.org/images/News/Subscribe/Subscribe.png' style='width:100%; height:100px'></div><div><p>Hi <span style='font-weight: bold; text-transform: uppercase'>$firstname $lastname</span>,</p><p>You have successfully changed your password.<p>Thank you for choosing Pro-filr</p></div></body></html>";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
        // $headers .= 'Cc: bambo.adenuga@pro-filr.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
        
        
        echo "<script>swal('Good Job!', 'Password Changed', 'success')</script>";
    }
    else{
        echo "<script>swal('Oops!', 'Something went wrong. Try Again', 'error')</script>";
    }
    }
    else
    {
        echo "<script>swal('Oops!', 'Password does not match', 'warning')</script>";
    }
    
    
    
    

    

}


if(isset($_POST['changeplan'])){
    
    $table=$dbh->query("
    ALTER TABLE tbl_subscription 
    AUTO_INCREMENT = 1");
    $table->execute();
    
    $login_id = $_SESSION['login_id'];
    
    $plan = $_POST['plan'];
    
    // var_dump($plan);
    
    $stmt = $dbh->query("SELECT DISTINCT login_id, expiry_date FROM tbl_subscription WHERE login_id= '".$login_id."' AND expiry_date >=NOW()");
    $stmt->execute();
    $res = $stmt->fetchAll();
    $numRow = $stmt->rowCount();
    
    

    if($numRow == 1){
        
        $user = "SELECT firstname, lastname, email FROM tbl_account_individual WHERE login_id = '".$login_id."'";
        $getUser = $dbh->prepare($user);
        
        $getUser->execute();
        
        $result = $getUser->fetchAll();
        
        $email = $result[0]["email"];
        $firstname = $result[0]["firstname"];
        $lastname = $result[0]["lastname"];
        // print_r($result[0]["email"]);

    if($plan === "Annual Plan"){
        
        $amount = "$100";
        $sqlA = "UPDATE tbl_subscription SET state = 2 WHERE login_id = '".$login_id."'";
    
        $stmt = $dbh->prepare($sqlA);
        $stmt->execute();
        
        // Mail
        $to = $email;
        // $to = "bambo.adenuga@pro-filr.com";
        $subject = "Request to change subscription plan on Pro-filr";
        
        $message = "<html><head><title>Request to change subscription plan</title></head><body><div><img src='https://modplus.org/images/News/Subscribe/Subscribe.png' style='width:100%; height:100px'></div><div><p>Hi <span style='font-weight: bold; text-transform: uppercase'>$firstname $lastname</span>,</p><p>We have received a request from you to change your subscription plan on Pro-filr to <span style='color: red; font-weight: bold; text-transform: uppercase'>$amount $plan</span>.<p>Your request is in process and would be available within 24hrs.</p><p>Thank you for choosing Pro-filr</p></div></body></html>";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
        $headers .= 'Cc: bambo.adenuga@pro-filr.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
        
        
        echo "<script>swal('Thank You!', 'Your request has been submitted', 'success')</script>";
    }
    elseif($plan === "Monthly Plan"){
       $amount = "$10";
        $sqlB = "UPDATE tbl_subscription SET state = 1 WHERE login_id = '".$login_id."'";
    
        $stmt = $dbh->prepare($sqlB);
        $stmt->execute();
        
        
        // Mail
        $to = $email;
        // $to = "bambo.adenuga@pro-filr.com";
        $subject = "Request to change subscription plan on Pro-filr";
        
        $message = "<html><head><title>Request to change subscription plan</title></head><body><div><img src='https://modplus.org/images/News/Subscribe/Subscribe.png' style='width:100%; height:100px'></div><div><p>Hi <span style='font-weight: bold; text-transform: uppercase'>$firstname $lastname</span>,</p><p>We have received a request from you to change your subscription plan on Pro-filr to <span style='color: red; font-weight: bold; text-transform: uppercase'>$amount $plan</span>.<p>Your request is in process and would be available within 24hrs.</p><p>Thank you for choosing Pro-filr</p></div></body></html>";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
        $headers .= 'Cc: bambo.adenuga@pro-filr.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
        
        echo "<script>swal('Thank You!', 'Your request has been submitted', 'success')</script>";
    }
    elseif($plan === "NULL"){
        
        $sqlC = "UPDATE tbl_subscription SET state = 3 WHERE login_id = '".$login_id."'";
    
        $stmt = $dbh->prepare($sqlC);
        $stmt->execute();
        
        // Mail
        $to = $email;
        // $to = "bambo.adenuga@pro-filr.com";
        $subject = "Request to change subscription plan on Pro-filr";
        
        $message = "<html><head><title>Request to change subscription plan</title></head><body><div><img src='https://modplus.org/images/News/Subscribe/Subscribe.png' style='width:100%; height:100px'></div><div><p>Hi <span style='font-weight: bold; text-transform: uppercase'>$firstname $lastname</span>,</p><p>We have received a request from you to change your subscription plan on Pro-filr to <span style='color: red; font-weight: bold; text-transform: uppercase'>basic free plan</span>.<p>Your request is in process and would be available within 24hrs.</p><p>Thank you for choosing Pro-filr</p></div></body></html>";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
        $headers .= 'Cc: bambo.adenuga@pro-filr.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
        
        echo "<script>swal('Thank You!', 'Your request has been submitted', 'success')</script>";
    }
    }
    else{
        
        echo "<script>alert('You can only change plan when you Upgrade account')</script>";
    }
    
}

?>

<!--Count professionals you may know-->
<?php
 $login_id = $_SESSION['login_id'];
 
		$sql0 = "SELECT my_account.*, CONCAT('Friends with ', f_account.firstname,' ', f_account.lastname) AS in_common, COUNT(*) as relevance, GROUP_CONCAT(a.login_id ORDER BY a.login_id) as mutual_friends FROM tbl_connection a JOIN tbl_connection b ON  (b.member_id = a.login_id AND b.login_id = {$login_id}) LEFT JOIN tbl_connection c ON (c.member_id = a.member_id AND c.login_id = {$login_id}) JOIN tbl_account_individual my_account ON my_account.login_id = a.member_id JOIN tbl_account_individual f_account ON f_account.login_id = a.login_id WHERE c.login_id IS NULL AND a.member_id != {$login_id} GROUP BY a.member_id ORDER BY relevance DESC;";
		
		$sql1 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_company.name) AS in_common FROM tbl_company AS the_company JOIN tbl_company AS my_company ON my_company.name = the_company.name JOIN tbl_account_individual ON tbl_account_individual.login_id = the_company.login_id WHERE my_company.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql2 = "SELECT tbl_account_individual.*, CONCAT('Worked with ',the_project.project_employer) AS in_common FROM tbl_executed_project AS the_project JOIN tbl_executed_project AS my_project ON my_project.project_employer = the_project.project_employer JOIN tbl_account_individual ON tbl_account_individual.login_id = the_project.login_id WHERE my_project.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql3 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_experience.company) AS in_common FROM tbl_industry_experience AS the_experience JOIN tbl_industry_experience AS my_experience ON my_experience.company = the_experience.company JOIN tbl_account_individual ON tbl_account_individual.login_id = the_experience.login_id WHERE my_experience.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql4 = "SELECT tbl_account_individual.*, CONCAT('Member of ',the_affiliation.organisation) AS in_common FROM tbl_affiliation AS the_affiliation JOIN tbl_affiliation AS my_affiliation ON my_affiliation.organisation = the_affiliation.organisation JOIN tbl_account_individual ON tbl_account_individual.login_id = the_affiliation.login_id WHERE my_affiliation.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql5 = "SELECT tbl_account_individual.*, CONCAT('Has ',the_professional_certification.certification) AS in_common FROM tbl_professional_certification AS the_professional_certification JOIN tbl_professional_certification AS my_professional_certification ON my_professional_certification.certification = the_professional_certification.certification JOIN tbl_account_individual ON tbl_account_individual.login_id = the_professional_certification.login_id WHERE my_professional_certification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
		
		$sql6 = "SELECT tbl_account_individual.*, CONCAT('Schooled at ',the_educational_qualification.school) AS in_common FROM tbl_educational_qualification AS the_educational_qualification JOIN tbl_educational_qualification AS my_educational_qualification ON my_educational_qualification.school = the_educational_qualification.school JOIN tbl_account_individual ON tbl_account_individual.login_id = the_educational_qualification.login_id WHERE my_educational_qualification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND()";

		$sql7 = "select tbl_account_individual.*,concat('Lives in ',country) as in_common from tbl_account_individual where country = (select country from tbl_account_individual where login_id = {$login_id}) and login_id <> {$login_id}";

// First fetch
    $sth = $dbh->prepare($sql0);
    $sth->execute();
    $result0 = $sth->fetchAll();
    $count0 = count($result0);
    
// Second Fetch
    $sth = $dbh->prepare($sql1);
    $sth->execute();
    $result1 = $sth->fetchAll();
    $count1 = count($result1);
    
    // Third Fetch
    $sth = $dbh->prepare($sql2);
    $sth->execute();
    $result2 = $sth->fetchAll();
    $count2 = count($result2);
    
    // Forth Fetch
    $sth = $dbh->prepare($sql3);
    $sth->execute();
    $result3 = $sth->fetchAll();
    $count3 = count($result3);
    
    // Five Fetch
    $sth = $dbh->prepare($sql4);
    $sth->execute();
    $result4 = $sth->fetchAll();
    $count4 = count($result4);
    
    // Sixth Fetch
    $sth = $dbh->prepare($sql5);
    $sth->execute();
    $result5 = $sth->fetchAll();
    $count5 = count($result5);
    
    // Seventh Fetch
    $sth = $dbh->prepare($sql6);
    $sth->execute();
    $result6 = $sth->fetchAll();
    $count6 = count($result6);
    
    // Eight Fetch
    $sth = $dbh->prepare($sql7);
    $sth->execute();
    $result7 = $sth->fetchAll();
    $count7 = count($result7);
    

			$results = array_merge($result0, $result1, $result2, $result3, $result4, $result5, $result6, $result7);
			
		$total_count = $count0+$count1+$count2+$count3+$count4+$count5+$count6+$count7;
		

			
?>


<!DOCTYPE html>
<html lang="en">
<?php include("partials/b_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body>

<?php include("partials/scripts.html"); ?>

<script type="text/javascript" src="assets/js/landing.js"></script>
    
<?php include("partials/b_profile_nav.html"); ?>

<style>
    .m-div > p{
        font-size: 13px;
    }
    
    .changePassword, #subSection{
        margin-bottom: 5px;
    }
    .flashit{
		  color:#f2f;
			-webkit-animation: flash linear 1s infinite;
			animation: flash linear 1s infinite;
		}
		@-webkit-keyframes flash {
			0% { opacity: 1; } 
			50% { opacity: .1; } 
			100% { opacity: 1; }
		}
		@keyframes flash {
			0% { opacity: 1; } 
			50% { opacity: .1; } 
			100% { opacity: 1; }
		}
</style>

<?php
$sths = $dbh->prepare("SELECT * FROM tbl_promo WHERE percent > 24 AND login_id='".$_SESSION['login_id']."'" );

$sths->execute();
$result = $sths->fetchAll();

foreach($result as $key){
    $promo_state = $key['promo_state'];
    $login_id = $key['login_id'];

    if($promo_state == 0){
        $myform = '<form method="post"><input type="hidden" id="promoId" name="login_id" value="'.$login_id.'"><input type="hidden" id="promoState" name="promo_state" value="'.$promo_state.'"><a href="#" type="submit" onclick="post();" class="btn btn-primary flashit" style="background-color: #dd5043; width:100%; color: #fff">Click to Enjoy Classic Plan for FREE for 30days</a></form>';
    }
    else{
        $myform = '<a href="#" class="btn btn-primary" style="background-color: #dd5043; width:100%; color: #fff; display: none">Click to Enjoy for 30 days</a>';
    }
}


echo $myform;

?>

<div class="container sections-wrapper">
    <div class="row">

        <div class="secondary col-md-3 col-sm-12 col-xs-12">
            
            <aside class="info aside section">
                <div class="section-inner">
                    <img class="profile_picture img-thumbnail" style="width: 100%" src="assets/images/man.png"/>
                </div>
                <div class="section-inner">
                    <h4 class="header" id="profile_name"></h4>
                    <div class="description" id="profile_current_position"></div>
                    <br>
                </div>

                                <!--          Button trigger modal -->
 <button type="button" class="btn btn-success verif animated bounceInDown" data-toggle="modal" data-target=".bd-example-modal-lg" style="color:#fff; width: 100%; font-size: 13px; background-color: #3CB371 !important"><span class="fa fa-spin" style="background-color:green"><img src="https://img.icons8.com/dusk/64/000000/verified-account.png" style="width:20px; height:20px; background-color: #fff; border-radius: 100%" ></span>
        Become A Verified Professional
</button><br><br
                <!--Import Linked In-->
                <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=<?= LINKEDIN_CLIENT_ID ?>&redirect_uri=<?= LINKEDIN_REDIRECT_URL ?>&state=<?= $_SESSION['state'] ?>&scope=r_basicprofile r_emailaddress" class="btn btn-info ui button animated fadeInDown" style="background-color: #2663B7; width: 100%; color: #fff;"><img src="https://img.icons8.com/color/48/000000/linkedin.png" style="width:20px; height:20px"> Import LinkedIn Profile</a> <br><br>
               
               <!--Invite-->
               <a href="/invites?c=gmail" class="btn btn-info ui button animated fadeInDown" style="background-color: #3CB371; width: 100%; color: #fff;"><img src="https://img.icons8.com/color/48/000000/invite.png" style="width:20px; height:20px">  Invite Professionals</a><br><br>
               
               <!--Post opportunity-->
               <a href="/profile?c=post" class="btn btn-warning ui button animated fadeInDown" style="background-color: #00b5ad; width: 100%; color: #fff; font-size: 18px"><img src="https://img.icons8.com/office/16/000000/mailbox-opened-flag-down.png" style="width:20px; height:20px">  Post Opportunity</a> <br><br>
                
                
                <!--Company Page-->
               <a href="/company" class="btn btn-secondary ui button animated fadeInDown" style="background-color: #2185d0; width: 100%; color: #fff; font-size: 18px"><img src="https://img.icons8.com/cotton/64/000000/plus--v1.png" class='flashit' style="width:20px; height:20px">  Create Company Page</a><br><br>
               

               <div class="section-inner">
                        
                    
                    
                        <div class="clearfix"></div>
                        <!--                    <hr>-->
                        <div class="content quote">
    
    
                            <ul class="list-unstyled">


                            <?php

$sth = $dbh->prepare("SELECT * FROM `tbl_subscription` WHERE expiry_date >= NOW() AND login_id = '".$_SESSION['login_id']."'");
$sth->execute();
$result = $sth->fetchAll();

$count = count($result);
// print_r($count);

if($count > 0){
    $mymenu = '<li><a href="validation" style="font-size: 15px">Validations</a><span class="label label-success pull-right" id="profile_validations">0</span></li><li><a href="profile_view" style="font-size: 15px">Profile Views</a><span class="label label-danger pull-right" id="profile_views">0</span></li>';
}else{
    $mymenu = '<li><a id="validations" style="cursor: pointer; font-size: 15px">Validations</a><span class="label label-success pull-right" id="profile_validations">0</span></li><li><a id="views" style="cursor: pointer; font-size: 15px">Profile Views</a><span class="label label-danger pull-right" id="profile_views">0</span></li>';
}

echo $mymenu;
?>

<li><a href="posts" style="font-size: 15px"> Messages</a><span class="label label-warning pull-right" id="profile_messages">0</span>
                            </li>
                            <li><a href="invites" style="font-size: 15px"> Connections</a><span class="label label-primary pull-right" id="profile_connections">0</span>
                            </li>
                            <li><a href="groups" style="font-size: 15px"> Groups</a><span class="label label-default pull-right" id="profile_groups">0</span>
                            </li>
                        </ul>
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//aside-->

            </div><!--//secondary-->
        <div class="primary col-md-6 col-sm-12 col-xs-12">
            <h3 class="heading" style="background-color: #3CB371; color: #fff; padding: 5px">Opportunity Post</h3>



            <div id="opportunity_list">

            </div>
        </div><!--//primary-->


        <!-- Modal -->
 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg animated fadeInRight">
           <div class="modal-content">
             <div class="modal-header" style="background-color: #429c45; color: #fff">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none !important">
                    <span aria-hidden="true" style="color:red; font-size: 24px;">&times;</span>
                </button>
               <h5 class="modal-title" id="exampleModalLabel" style="color: #fff; font-size: 16px; text-transform: uppercase">Becoming A Verified Professional</h5>
               
                </div>
             <div class="modal-body">
               <div class="row">
                   <div class="col-md-4">
                        <div class="m-div">
                                <p><span style="border: 1px solid none; font-weight: bold; font-size: 18px; width: 15px; height: 15px; padding: 10px; color:#fff; background-color: #d8534e; border-radius: 10px">1.</span> Complete Your Profile</p>
                           <hr>
                           
                           <!--Industry Experience-->
                           
                           
                           <p>

<?php

$sth = $dbh->prepare("SELECT login_id FROM `tbl_industry_experience` WHERE login_id = '".$_SESSION['login_id']."' ");
        
        $sth->execute();
        $result = $sth->fetchAll();
        $count = count($result);
        
        $indCount = $count;

        if($count >= 2){
            $myexperience = '<p style="color: green; font-weight: bold; font-size: 12px">Industry Experience = 25</p>';
        }elseif($count == 1){
            $myexperience = '<p style="color: darkorange; font-weight: bold; font-size: 12px">Industry Experience = 12.5</p>';
        }
        else{
            $myexperience = '<p style="color: red; font-weight: bold; font-size: 12px">Industry Experience = 0</p>';
        }


        echo $myexperience;
?>


</p>

 <!--Executed Projects-->
 <p>

 <?php 

$sth = $dbh->prepare("SELECT login_id FROM `tbl_executed_project` WHERE login_id = '".$_SESSION['login_id']."' ");
        
$sth->execute();
$result = $sth->fetchAll();
$count = count($result);

$execCount = $count;

if($count > 1){
    $myexecProject = '<p style="color: green; font-weight: bold; font-size: 12px">Executed Projects = 25</p>';
}
elseif($count == 1){
    $myexecProject = '<p style="color: darkorange; font-weight: bold; font-size: 12px">Executed Projects = 12.5</p>';
}
else{
    $myexecProject = '<p style="color: red; font-weight: bold; font-size: 12px">Executed Projects = 0</p>';
}
 
 echo $myexecProject;
 ?>

</p>

 <!--Education Qualification-->
 <p>

<?php

$sth = $dbh->prepare("SELECT login_id FROM `tbl_educational_qualification` WHERE login_id = '".$_SESSION['login_id']."' ");
        
$sth->execute();
$result = $sth->fetchAll();
$count = count($result);

$eduCount = $count;

if($count > 1){
    $educationQual = '<p style="color: green; font-weight: bold; font-size: 12px">Education Qualification = 20</p>';
}
elseif($count == 1){
    $educationQual = '<p style="color: darkorange; font-weight: bold; font-size: 12px">Education Qualification = 10</p>';
}
else{
    $educationQual = '<p style="color: red; font-weight: bold; font-size: 12px">Education Qualification = 0</p>';
}


echo $educationQual;

?>

 </p>


  <!--Professional Certification-->
  <p>
 
 <?php

$sth = $dbh->prepare("SELECT login_id FROM `tbl_professional_certification` WHERE login_id = '".$_SESSION['login_id']."' ");
        
$sth->execute();
$result = $sth->fetchAll();
$count = count($result);

$profCount = $count;

if($count > 1){
    $myprofCert = '<p style="color: green; font-weight: bold; font-size: 12px">Professional Certificate = 15</p>';
}
elseif($count == 1){
    $myprofCert = '<p style="color: darkorange; font-weight: bold; font-size: 12px">Professional Certificate = 7.5</p>';
}
else{
    $myprofCert = '<p style="color: red; font-weight: bold; font-size: 12px">Professional Certificate = 0</p>';
}

 echo $myprofCert;
 ?>
 
 
 </p>


 <!--Religion/Affiliation-->
  <p>
 
 <?php

$sth = $dbh->prepare("SELECT login_id FROM `tbl_affiliation` WHERE login_id = '".$_SESSION['login_id']."' ");
        
$sth->execute();
$result = $sth->fetchAll();
$count = count($result);

$afflCount = $count;

if($count > 1){
    $myreligion = '<p style="color: green; font-weight: bold; font-size: 12px">Religion/Affiliation = 5</p>';
}
else{
    $myreligion = '<p style="color: red; font-weight: bold; font-size: 12px">Religion/Affiliation = 0</p>';
}

 echo $myreligion;
 ?>
 
 
 </p>

 <!--Profile Picture-->
  <p>
 
 <?php

$sth = $dbh->prepare("SELECT * FROM `tbl_account_individual` WHERE login_id = '".$_SESSION['login_id']."' AND photo = 'profile-placeholder.png' OR photo IS null");
        
$sth->execute();
$result = $sth->fetchAll();
$count = count($result);

$profilepic = $count;

if($count > 1){
    $myprofilepix = '<p style="color: green; font-weight: bold; font-size: 12px">Profile Picture = 0</p>';
}
else{
    $myprofilepix = '<p style="color: red; font-weight: bold; font-size: 12px">Profile Picture = 5</p>';
}

 echo $myprofilepix;
 ?>
 
 
 </p>



 <p>
 
 <?php
 
 $sth = $dbh->prepare("SELECT * FROM `tbl_company` WHERE login_id = '".$_SESSION['login_id']."'");
        
 $sth->execute();
 $result = $sth->fetchAll();
 $counter = count($result);
 
 $comps = $counter;

 if($counter > 0){
    $mycompdet = '<p style="color: green; font-weight: bold; font-size: 12px">Company Detail = 5</p>';
 }
 else{

    $mycompdet = '<p style="color: red; font-weight: bold; font-size: 12px">Company Detail = 0</p>';

 }

 echo $mycompdet;

 ?>
 
 </p>


 <p>
 
 <?php
 
 $sumCount = $indCount+$eduCount+$profCount+$afflCount+$execCount+$profilepic+$comps;

 if($sumCount >= 14){
    $percentComplete = '<p class="animated fadeInDown" style="color: #18a05e;font-weight: bold; font-size: 25px; text-align: center"> 
    100% Completed!
</p>';
 }
 elseif($sumCount == 13){
    $percentComplete = '<p class="animated fadeInDown" style="color: #2a7aca;font-weight: bold; font-size: 25px; text-align: center"> 
    92.8% Complete
</p>';
 }
 elseif($sumCount == 12){
    $percentComplete = '<p class="animated fadeInDown" style="color: #2a7aca;font-weight: bold; font-size: 25px; text-align: center"> 
    85.7% Complete
</p>';
 }
 elseif($sumCount == 11){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #ff9800;font-weight: bold; font-size: 25px; text-align: center"> 
    78.6% Complete
</p>';
 }
 elseif($sumCount == 10){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #ff9800;font-weight: bold; font-size: 25px; text-align: center"> 
    71.4% Complete
</p>';
 }
 elseif($sumCount == 9){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #ff9800;font-weight: bold; font-size: 25px; text-align: center"> 
    64.3% Complete
</p>';
 }
 elseif($sumCount == 8){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #ff9800;font-weight: bold; font-size: 25px; text-align: center"> 
    57.1% Complete
    </p>';
 }
 elseif($sumCount == 7){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #ff9800;font-weight: bold; font-size: 25px; text-align: center"> 
    50% Complete
    </p>';
 }
 elseif($sumCount == 6){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #d0631a;font-weight: bold; font-size: 25px; text-align: center"> 
    42.8% Complete
    </p>';
 }
 elseif($sumCount == 5){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #dd5145;font-weight: bold; font-size: 25px; text-align: center"> 
        35.7% Complete
        </p>';
 }
 elseif($sumCount == 4){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #dd5145;font-weight: bold; font-size: 25px; text-align: center"> 
        28.6% Complete
        </p>';
 }
 elseif($sumCount == 3){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #dd5145;font-weight: bold; font-size: 25px; text-align: center"> 
        21.4% Complete
        </p>';
 }
 elseif($sumCount == 2){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #dd5145;font-weight: bold; font-size: 25px; text-align: center"> 
        14.3% Complete
        </p>';
 }
 elseif($sumCount == 1){
    $percentComplete = '<p class="animated fadeInDown"  style="color: #dd5145;font-weight: bold; font-size: 25px; text-align: center"> 
        7.1% Complete
        </p>';
 }
 else{
    $percentComplete = '<p class="animated fadeInDown"  style="color: red;font-weight: bold; font-size: 25px; text-align: center"> 
        0% Complete
        </p>';
 }


 echo $percentComplete;
 
 ?>
 
 
 </p>

 <hr>
                           
                               <a href="/profile" class="btn btn-primary" style="background-color: #139f5e; width:100%; color: #fff">Add Information to your Profile</a> <br><br>
                               <!--<a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&amp;client_id=77g9qzxthk6iob&amp;redirect_uri=https://pro-filr.com/controller/app.php&amp;state=MnDlr_WZx2QlWlA&amp;scope=r_basicprofile r_emailaddress" class="btn btn-info" style="background-color: #2763b5; width:100%; color: #fff">Import LinkedIn Profile</a>-->
                               <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=<?= LINKEDIN_CLIENT_ID ?>&redirect_uri=<?= LINKEDIN_REDIRECT_URL ?>&state=<?= $_SESSION['state'] ?>&scope=r_basicprofile r_emailaddress" class="btn btn-info ui button" style="background-color: #2663B7; width: 100%; color: #fff;">Import LinkedIn Profile</a>
                               
                               <br><br>
                               
                               
                                            

                                   
                               
                           
                        </div>
                        <hr>
                   </div>

                   <div class="col-md-4">
                       <div class="m-div">
                           <p><span style="border: 1px solid none; font-weight: bold; font-size: 18px; width: 15px; height: 15px; padding: 10px; color:#fff; background-color: darkorange; border-radius: 10px">2.</span> Upload your Contacts</p>
                           <hr>
                           
                           <p class="animated fadeInRight">
                               <?php
                               $sth = $dbh->prepare("SELECT * FROM `tbl_validation` WHERE member_id = '".$_SESSION['login_id']."' ORDER BY date_validated DESC ");
        
                                    $sth->execute();
                                    $result = $sth->fetchAll();
                                    $count = count($result);
                                    
                                    ?><span style="text-align: right">Number of validation: <b style="color: #429c45; font-size: 24px; text-indent: 50px"><?php echo $count;?></b></span> <br><br>
                                    <?if($count  ){?>
                                        <span style="text-align: right">Last validated: <b style="color: #337ab5; text-indent: 50px"><?php echo date("d-m-Y" ,strtotime($result[0]['date_validated']))?></b></span>
                                    <?}else{?>
                                        <span style="text-align: right">Last validated: <b style="color: red; text-indent: 50px; font-weight: 600">------</b></span>
                                   <? }
                                    ?>
                           </p>
                           <hr>
                           <p>
                               <span style="color: red; font-size: 12px;">*</span> Get more validation & become a verified Professional
                           </p>
                           <hr>
                            <p>
                                <a id="btn_excel" type="button" class="btn btn-primary" style="color: #fff;font-size: 12px; cursor: pointer">Import from Excel</a>
                                
                               <a id="btn_gmail" type="button" class="btn btn-danger" style="color: #fff; font-size: 12px; cursor: pointer">Import from Gmail</a>
                            </p>
                            
                       </div>
                       <hr>
                       
                   </div>
                   <div class="col-md-4">
                       <div class="m-div">
                           <p><span style="border: 1px solid none; font-weight: bold; font-size: 18px; width: 15px; height: 15px; padding: 10px; color:#fff; background-color: #3CB371; border-radius: 10px">3.</span> Upgrade Account</p>
                           <hr>
                           
                           <p>
                               <span style="color: red; font-size: 12px;">-</span> Engage with other Professionals
                           </p>
                           <p>
                               <span style="color: red; font-size: 12px;">-</span> Access Opportunities
                           </p>
                           <p>
                               <span style="color: red; font-size: 12px;">-</span> Manage Projects Effectively
                           </p>
                           
                           <hr>
                           <p class="text-center">
                               <a href="/paypal">
                                   <img class="animated infinite bounce delay-5s" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" style="width: inherit" alt="paypal" />
                               </a>
                           </p>
                       </div>
                       <hr>
                   </div>
               </div>
             </div>
             
           </div>
         </div>
       </div>

       <div class="secondary col-md-3 col-sm-12 col-xs-12">

            
<aside class="info aside section" id="people_list">
    <div class="section-inner">
        <h2 class="heading" style="background-color: #3CB371; color: #fff; padding: 7px">Professional(s) You May Know </h2>
        <div class="content quote">
            <ul class="list-unstyled" id="suggestion_list">

            </ul>
        </div><!--//content-->

        <?php 
            if($total_count > 2){
                $myprofessionalnearme = '<a href="professional" type="button" class="btn btn-success" style="width: 100%; text-align: center; margin-top: 10px; color: #f2f2f2; background-color: #3CB371 !important">See other Professionals</a>';
            }
            elseif($total_count < 3){
                $myprofessionalnearme = '<a style="display:none" href="professional" type="button" class="btn btn-success" style="width: 100%; text-align: center; margin-top: 10px; color: #f2f2f2; background-color: #3CB371 !important">See other Professionals</a>';
            }
            else{
                $myprofessionalnearme = '<a style="display:none" href="professional" type="button" class="btn btn-success" style="width: 100%; text-align: center; margin-top: 10px; color: #f2f2f2; background-color: #3CB371 !important">See other Professionals</a>';
            }


            echo $myprofessionalnearme;
        
        ?>

                            <!--<a href="professional" type="button" class="btn btn-success" style="width: 100%; text-align: center; margin-top: 10px; color: #f2f2f2">See more...</a>-->
                            </div><!--//section-inner-->
            </aside><!--//aside-->

            <!--Request to Join A Professional Group-->
            <aside class="group aside section">
                <div class="section-inner">
                    <h2 class="heading" style="background-color: #3CB371; color: #fff; padding: 7px">Professional Group(s) on Pro-filr</h2>
                    <div class="content quote">
                        <ul class="list-unstyled" id="group_list">
                            
                        </ul>
                    </div>
                    
                    <a href="moregroups" type="button" class="btn btn-success text-white" style="width: 100%; text-align: center; margin-top: 10px; color: #f2f2f2; background-color: #3CB371 !important">See more...</a> 
                </div>
                
            </aside>
            
            <!--Active Projects-->
            <aside class="project aside section">
                <div class="section-inner">
                    <h2 class="heading" style="background-color: #3CB371; color: #fff; padding: 7px">Current project(s) on Pro-filr</h2>
                    <div class="content quote">
                        <ul class="list-unstyled" id="project_list">
                            
                        </ul>
                    </div>
                </div>

            </aside>

            <aside class="blog aside section">
                <div class="section-inner">
                    <h2 class="heading" style="background-color: #3CB371; color: #fff; padding: 7px">Blog</h2>
                    <div class="content quote">
                        <ul class="list-unstyled" id="blog_list">
                            
                        </ul>
                    </div>
                </div>

            </aside><!--//section-->
            <!--<aside class="info aside section">-->
            <!--    <div class="section-inner">-->
            <!--        <h2 class="heading">Recommendations</h2>-->
            <!--        <div class="content quote">-->
            <!--            <ul class="list-unstyled">-->
                            <!--                                    <li><span class="sr-only">Location:</span>San Francisco, US</li>-->
            <!--            </ul>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</aside>-->
            
            
            
            <!--Settings Modal-->
 

<!-- Button trigger modal -->
<!--<a type="button" data-toggle="modal" data-target="#setting">-->
<!--  ...-->
<!--</a>-->

<!-- Modal -->
<div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <div class="modal-header" style="background-color: #429c45; color: #fff">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none !important">
            <span aria-hidden="true" style="color:red; font-size: 24px;">&times;</span>
        </button>
       <h5 class="modal-title" id="exampleModalLabel" style="color: #fff; font-size: 16px; text-transform: uppercase"><img src="https://img.icons8.com/cotton/64/000000/gears.png" style="width: 20px; height: 20px"> Settings</h5>
       </div>
       
      <div class="modal-body">
        <!--Change Password-->
        
        <div class="changePassword">
            <button id="passkey" class="btn btn-info form-control" style="color:#fff !important">Change Password</button>
            <div id="changeForm">
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                <div class="input-box">
                    
                    <input id="key1" type="password" class="form-control" name="password" placeholder="Password" />
                    
                    <input id="key2" type="password" class="form-control" name="cpassword" placeholder="Confirm Password" /> 
                </div>
                
                <div id="btn-box">
                    <input type="submit" id="sub" class="form-control" name="submit" value="Submit" style="width: 100% !important" />
                </div>
                <br>
            </form>
            </div>
            
        </div>
        
       <hr>
        
        
        <!--Edit Profile-->
        <div class="profileGo">
        <a type="button" id="profile" class="btn btn-warning form-control" style="color:#fff !important">Edit Profile</a>
        </div>
        <hr>

        <?php 

        error_reporting(0);

$stmt = $dbh->query("SELECT login_id FROM tbl_subscribe WHERE login_id= '".$login_id."'");
// print_r($stmt);
$stmt->execute();
$res = $stmt->fetchAll();
$numRow = $stmt->rowCount();


if($numRow == 1){
    $myplanchange = '<div class="changePlan"><button id="plan" class="btn btn-success form-control" style="color:#fff !important">Change Plan</button><div id="subSection"><form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"><div class="input-box"><select id="plans" class="form-control" name="plan"><option value="Annual Plan">Classic Plan -- $100/Annum</option><option value="Monthly Plan">Classic Plan -- $10/Month</option><option value="NULL">Basic Plan -- Free</option></select></div><div id="btn-box"><input type="submit" id="savePlan" class="form-control" name="changeplan" value="Save" style="width: 100% !important" /></div><br></form></div></div>';
}
else{
    $myplanchange = '<!--Change Plan--><div class="changePlan"><button id="notplan" class="btn btn-success form-control" style="color:#fff !important">Change Plan</button></div>';
}

// echo $myplanchange;
        
        
        ?>
            
            
            </div>
      <div class="modal-footer text-danger" style="padding: 10px;">
        <p style="font-size: 14px; padding: 10px">
            Please note: Request to upgrage account to classic plan would take 24hrs to process</p>
      </div>
    </div>
  </div>
</div>

<!--End Settings-->


        </div><!--//secondary-->
    </div><!--//row-->
</div><!--//masonry-->

        
<!-- form modal -->


<!-- confirm modal -->

<!-- industry experience modal -->

<!-- industry experience modal -->


<!-- industry experience project modal -->

<!-- industry experience modal -->







<script>
    function post(){
        var addr = 'promoupdate.php';
        var promoId = $("#promoId").val();
        var promoState = $("#promoState").val();
        
         $.post({
            url: addr,
            type: "POST",
            data: {login_id: promoId, promo_state: promoState},
            cache: false,
            success: function(){
                swal('Good Job!', 'You now have access to Classic Plan for 30 days. You will be activated shortly', 'success');
                
                setTimeout(function(){ window.location.replace('https://getverifiedpro.com/home')}, 3000);
            }

           });
           

        
    }
</script>







    
</body>
</html>
