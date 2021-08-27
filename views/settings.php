<?php

// error_reporting(1);

$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


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
    
    $email = $res[0]["email"];
    
    if($password == $cpassword){
    
    if($numRow == 1){
        
        $sql = "UPDATE tbl_logins SET password = :password WHERE EMAIL = '".$email."'";
    
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        
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
    
    $stmt = $dbh->query("SELECT login_id FROM tbl_subscribe WHERE login_id= '".$login_id."'");
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
        $sqlA = "UPDATE tbl_subscribe SET state = 2 WHERE login_id = '".$login_id."'";
    
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
        $sqlB = "UPDATE tbl_subscribe SET state = 1 WHERE login_id = '".$login_id."'";
    
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
        
        $sqlC = "UPDATE tbl_subscribe SET state = 3 WHERE login_id = '".$login_id."'";
    
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
        
        $stmt = $dbh->query("SELECT login_id FROM tbl_subscribe WHERE login_id= '".$login_id."'");
        $stmt->execute();
        $res = $stmt->fetchAll();
        $numRow = $stmt->rowCount();
        
        
        if($numRow == 1)?>
            <!--Change Plan-->
        <div class="changePlan">
            <button id="plan" class="btn btn-success form-control" style="color:#fff !important">Change Plan</button>
            
            <div id="subSection">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                <div class="input-box">
                    
                    <select id="plans" class="form-control" name="plan">
                        <option value="Annual Plan">Classic Plan -- $100/Annum</option>
                        <option value="Monthly Plan">Classic Plan -- $10/Month</option>
                        <option value="NULL">Basic Plan -- Free</option>
                    </select>
                </div>
                
                <div id="btn-box">
                    <input type="submit" id="savePlan" class="form-control" name="changeplan" value="Save" style="width: 100% !important" />
                </div>
                <br>
            </form>
            </div>
        </div>
       
        <!--Change Plan-->
        <div class="changePlan">
            <button id="notplan" class="btn btn-success form-control" style="color:#fff !important">Change Plan</button>
           
        </div>
       
        
        
        
      </div>
      <div class="modal-footer text-danger" style="padding: 10px;">
        <p style="font-size: 14px; padding: 10px">
            Please note: Any request for Classic plan would take 24hrs to process</p>
      </div>
    </div>
  </div>
</div>

<!--End Settings-->