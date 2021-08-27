<?php
require_once "google-api-php-client/vendor/autoload.php";
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (!validateLogin()) {
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}

if (!empty($_POST['fromNav']) && $_POST['fromNav'] == "1") {
	$_SESSION['fromGmail'] = "0";
}
?>

<?php

// error_reporting(1);

$user = 'exbcca_profilr_beta';
$pass = 'getverifiedpro2021!';

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



// All sent invites
$sth = $dbh->prepare('select id,max(date_sent) as date_sent,sent_to from tbl_invites where login_id = "'.$_SESSION['login_id'].'" group by sent_to order by date_sent desc');
$sth->execute();
$res = $sth->fetchAll();

$count=count($res);



// All pending invites
$rows = $dbh->query("select distinct(sent_to) as sent_to from tbl_invites where login_id = {$_SESSION['login_id']} and sent_to not in (select email from tbl_account_individual)");
$rows->execute();
$rowsTot = $rows->fetchAll();
$rowsCont = count($rowsTot);


// Get Connections
$connect = $dbh->query("SELECT tbl_account_individual.* FROM tbl_account_individual INNER JOIN tbl_connection ON tbl_account_individual.login_id = tbl_connection.login_id OR tbl_account_individual.login_id = tbl_connection.member_id WHERE (tbl_connection.login_id = '".$_SESSION['login_id']."' OR tbl_connection.member_id = '".$_SESSION['login_id']."') AND tbl_account_individual.login_id != '".$_SESSION['login_id']."'");

$connect->execute();
$connectTot = $connect->fetchAll();

$connectCount = count($connectTot);




// Suggested Connections

// $suggestions = $c->getConnectionSuggestions($member);

// print_r(count($suggestions));

// $suggest = $dbh->query("SELECT * FROM tbl_connection WHERE (member_id =  AND login_id = '".$_SESSION['login_id']."') OR (member_id =  AND login_id = '".$_SESSION['login_id']."')");
// $suggest->execute();
// $suggestTot = $suggest->fetchAll();

// $suggestCount = count($suggestTot);

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
        
        $sql = "UPDATE tbl_login SET password = :password WHERE EMAIL = '".$email."'";
    
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
    
    $stmt = $dbh->query("SELECT login_id FROM tbl_subscription WHERE login_id= '".$login_id."'");
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

<!DOCTYPE html>
<html>
    
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<?php include("partials/scripts.html"); ?>

    <script type="text/javascript" src="assets/js/invites.js"></script>

<?php include("partials/s_profile_nav.html"); ?>
<style>
    
    .changePassword, #subSection{
        margin-bottom: 5px;
    }
</style>


<!-- Settings Modal -->
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


<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">
    <div class="row" style="margin-top: 30px;"></div>
	<?php //var_dump($_SESSION['connections']); ?>
    <div class="ui four wide column">
        <aside class="info aside section">
            <div class="section-inner" style="background-color: white; padding: 20px;">
                <div class="content quote">
                    <ul class="list-unstyled" id="connect_tab">
                        <!--                        <li><a href="profile">Personal Profile</a></li>-->
                        <!--                        <li class="active">Send Invites</li>-->
                        <!--                        <li>Connections</li>-->
                        <li class="active item" data-tab="invite"><a>Send Invites</a></li>
                        <li class="item" data-tab="connect" id="connect_btn"><a>Connections</a></li>
                        <li><a href="company">Company Page</a></li>

                    </ul>
                </div><!--//content-->
            </div><!--//section-inner-->
        </aside><!--//aside-->
    </div>

    <div class="ui twelve wide column" id="middle-column" style="background-color: white">
        <div class="ui grid section">
            <div class="wide stretched column">

                <div class="ui  active tab segment" data-tab="invite">
                    <div class="ui grid">
                        <div class="four wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="active item invite_link" data-type="sent">Sent Invites <span><img src="https://img.icons8.com/flat_round/64/000000/synchronize.png" style="width: 15px; height: 15px; cursor: pointer" class="fa fa-spin"></span> <span style="font-size: 14px; color: blue"><?php echo $count;?></span> </a>
                                <a class="item invite_link" data-type="pend">Pending Invites <span><img src="https://img.icons8.com/color/48/000000/joining-queue.png" style="width: 20px; height: 20px; cursor: pointer" class=""></span> <span style="font-size: 14px; color: red"><?php echo $rowsCont;?></span> </a>
                                <a class="item invite_link pick_new" data-type="new">New Invite <span style="cursor: pointer"><img src="https://img.icons8.com/office/16/000000/download.png" style="width: 20px; height: 20px; cursor: pointer" class=""></span></a>
                                
                            </div>
                        </div>
                        <div class="twelve wide stretched column">
                            <div class="ui top attached right menu">
                                <div class="item">
                                    <div class="ui negative button" id="resend_btn">Resend Invites</div>
                                
                                </div>
                             
                            <!--<div class="text-center" style="margin: 10px;">-->
                            <!--    <p style="float: right">No of Invitees: -</p>-->
                            <!--    </div>-->
                            
                        </div>
                            <div class="ui attached segment invites_segment" style="height: 75vh; overflow-y: auto;"
                                 id="sent_invites"></div>
                            <div class="ui attached segment invites_segment" style="height: 75vh; overflow-y: auto;"
                                 id="pend_invites"></div>     
                            <div class="ui segment invites_segment"
                                 style="height: 75vh; overflow-y: auto; display: none;margin-top: 0;" id="new_invites">

                                <h3 class="ui header">Invite to Pro-Filr</h3>
                                <form class="ui form">
                                    <div class="field">
                                        <label>Enter email address (separate with commas if more than one)</label>
                                        <textarea rows=2 name="manual_emails" id="manual_emails"></textarea>
                                    </div>
                                    <div class="field">
                                    <label>Please select the basis of invitation*</label>
                                    <select name="manual_invite_type" id="manual_invite_type">
                                        <option value=""></option>
                                        <option value="executed_project">Worked on the same project</option>
                                        <option value="educational_qualification">Attended same instititon/school</option>
                                        <option value="professional_certification">Belong to same Professional Body</option>
                                        <option value="affiliation">Affliated to same social/charity/religious organisation</option>
                                    </select>
                                </div>
                                    <div class="field">
                                        <button class="ui positive right button" id="manual_btn">Invite</button>
                                    </div>
                                </form>
                                <div class="ui horizontal divider">OR</div>
                                <div class="ui two column grid">
                                    <div class="ui column" style="text-align: center;">
                                        <button class="ui vk button" id="csv_btn">Import from Excel</button>
                                        <div class="ui visible message">
                                            <p>Click <a href="assets/resources/sample.xls" target="_blank"
                                                        style="text-decoration: underline;">here</a> to see sample excel
                                                file</p>
                                        </div>
                                    </div>
                                    <div class="ui column" style="text-align: center;">
                                        <button class="ui google plus button" id="gmail_btn">Import from Gmail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ui tab segment" data-tab="connect">
                    <div class="ui grid">
                        <div class="four wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="active item connect_link" id="connected_tab" data-type="connected">My
                                    Connections <span><img src="https://img.icons8.com/flat_round/64/000000/synchronize.png" style="width: 15px; height: 15px; cursor: pointer" class="fa fa-spin"></span> <span style="font-size: 14px; color: blue"><?php echo $connectCount;?></span> </a>
                                <a class="item connect_link" id="suggested_tab" data-type="suggested">Suggested Connections</a>

                            </div>
                        </div>
                        <div class="twelve wide stretched column">
                            <div class="ui segment" style="height: 75vh; overflow-y: auto;" id="connect_segment">

                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- content row -->

        </div>
    </div>

    <!-- <footer></footer> -->

    <!-- indicate interest modal -->
    <div class="ui long modal" id="content_modal">
        <i class="close icon"></i>
        <div class="header" id="modal_header">Details</div>
        <div class="content" id="details_content">

            <div class="description" id="details_description"></div>

        </div>
        <div class="actions">
            <div class="ui black deny button">Close</div>
            <div class="ui positive right labeled icon button" id="save_btn_int">I'm Interested<i
                        class="checkmark icon"></i></div>
        </div>
    </div>

    <!-- indicate modal -->


    <!-- confirm modal -->
    <div class="ui small modal" id="message_modal">
        <div class="ui header">Message</div>
        <div class="content" id="message_content">
            <p>Remove Item?</p>
        </div>
        <div class="actions">
            <div class="ui negative  button">
                <i class="remove icon"></i>
                Close
            </div>

        </div>
    </div>

    <!-- confirm modal -->


    <!-- form modal -->
    <div class="ui tiny modal" id="gmail_modal">
        <i class="close icon"></i>
        <div class="header" id="gmail_modal_header">YOUR GMAIL CONTACTS</div>
        <div class="scrolling content">
            <div style="display: none;" id="confirmGmail"><?php echo $_SESSION['fromGmail']; ?></div>
            <div class="field">
                        <label>Please select the basis of invitation*</label>
                        <select name="gmail_invite_type" id="invite_type">
                            <option value=""></option>
                            <option value="executed_project">Worked on the same project</option>
                            <option value="educational_qualification">Attended same instititon/school</option>
                            <option value="professional_certification">Belong to same Professional Body</option>
                            <option value="affiliation">Affliated to same social/charity/religious organisation</option>
                        </select>
                    </div>
            <div class="description" id="gmail_modal_description">
				
            </div>

        </div>
        <div class="actions">
            <div class="ui black deny button">Cancel</div>
            <div class="ui positive right google plus labeled icon button" id="modal_invite_btn">Invite<i
                        class="checkmark icon"></i></div>
        </div>
    </div>

    <!-- form modal -->


    <!-- CSV modal -->
    <div class="ui tiny modal" id="csv_modal">
        <i class="close icon"></i>
        <div class="header" id="csv_modal_header">Import Excel</div>
        <div class="content">

            <div class="description" id="csv_modal_description">
                <!-- <div class="ui segment" style="height: 50vh;overflow-y: auto;" id="interest_segment"></div> -->
                <form class="ui form" id="upload_csv" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="function" id="function" value="sendCSV"/>
                    <div class="field">
                        <label>Please select the basis of invitation*</label>
                        <select name="csv_invite_type" id="invite_type">
                            <option value=""></option>
                            <option value="executed_project">Worked on the same project</option>
                            <option value="educational_qualification">Attended same instititon/school</option>
                            <option value="professional_certification">Belong to same Professional Body</option>
                            <option value="affiliation">Affliated to same social/charity/religious organisation</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Select Excel File</label>
                        <input type="file" name="file" id="file"/>
                    </div>
                </form>

            </div>

        </div>
        <div class="actions">
            <div class="ui black deny button">Close</div>
            <div class="ui positive right labeled icon button">Proceed<i class="checkmark icon"></i></div>
        </div>
        <p style="color: tomato; font-size: 12px; text-align: center; font-weight: bold"><sup>*</sup>Note: Upload MAX of 1000 emails at a time. Remove ambiguous emails from the list</p>
    </div>

    <!-- form modal -->





    <!-- message modal -->
    <div class="ui tiny modal" id="read_message_modal">
        <i class="close icon"></i>
        <div class="header" id="read_message_modal_header">Message</div>
        <div class="scrolling content">

            <div class="ui description grid" id="read_message_modal_description">
                <!-- <div class="ui segment grid" style="height: 50vh;overflow-y: auto;" id="read_message_segment"> -->
                <div class="row">
                    <div class="ui two wide column" style="font-weight: bold;">Date:</div>
                    <div class="ui fourteen wide column" id="msg_date"></div>
                </div>
                <div class="row">
                    <div class="ui two wide column" style="font-weight: bold;">Subject:</div>
                    <div class="ui fourteen wide column" id="msg_subject"></div>
                </div>
                <div class="row">
                    <div class="ui two wide column" style="font-weight: bold;">Sent By:</div>
                    <div class="ui fourteen wide column" id="msg_by"></div>
                </div>

                <div class="row">
                    <div class="ui two wide column" style="font-weight: bold;">Sent To:</div>
                    <div class="ui fourteen wide column" id="msg_to"></div>
                </div>
                <div class="row">
                    <div class="ui two wide column" style="font-weight: bold;">Message:</div>
                    <div class="ui fourteen wide column"><p id="msg_content"></p></div>
                </div>

            </div>

        </div>
        <div class="actions">
            <div class="ui black deny button">Close</div>
        </div>
    </div>


    <!-- message modal -->
	
	
	
    <script src="https://apis.google.com/js/client.js"></script>
    <script>
        <?php if(1>0){?>
            var url_string = window.location.href;
            var url = new URL(url_string);
            var c = url.searchParams.get("c");
            
            
            if(c == "excel"){
                $(".ui div > .menu > a.item.invite_link.pick_new").click();
                $(".ui > div > button.ui.vk").click();
            }
            if(c == "gmail"){
                $(".ui div > .menu > a.item.invite_link.pick_new").click();
                $("button#gmail_btn").click();
            }
        <?php }?>
    </script>
</body>
</html>