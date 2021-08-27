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
    // if ($_SESSION['subscription'] != 'active') {
        
    //     header('Location: home');
    //     exit;
    // }

    // print_r();
    ?>

    <?php 
    $hostname='localhost';
    $username='profilr_user';
    $password='portFOLIO_2015';

    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=profilr_beta",$username,$password);

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
        // echo 'Connected to Database<br/>';
        
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
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


    <!DOCTYPE html>
    <html>
    <?php include("partials/b_head.html"); ?>
    <link rel="stylesheet" href="assets/lib/bootstrap-select/css/bootstrap-select.min.css">

    <?php //echo "token:".$_SESSION['token']; ?>
    <body>
    <?php include("partials/b_profile_nav.html"); ?>

    <style>
        
        .changePassword, #subSection{
            margin-bottom: 5px;
        }
    </style>

    <div class="container sections-wrapper">
        
        
        
        
        <div class="row">
            <div class="secondary col-md-3 col-sm-12 col-xs-12">
                <aside class="info aside section">
                    <div class="section-inner">
                        <div class="content quote">
                            <div id="contacts">
                                <div class='wrap'>Projects

                                    <a href="#" style="padding: 0 10px;" data-toggle="modal" class="pull-right"
                                    data-target="#createProject"><i class="fa fa-plus"></i> Create Project</a>

                                </div>
                                <br>
                                <div id='search'><input
                                            type='search' class="form-control" id='projectTableSearch'
                                            placeholder='Search Projects...'/></div>
                            </div>
                            <br>
                            <div class="clearfix"></div>

                            <ul id="project_table_list" class="list-unstyled">

                            </ul>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//aside-->

            </div><!--//secondary-->

            <div class="primary col-md-6 col-sm-12 col-xs-12">
                <div id="frame">
                    <div id="sidepanel">
                        <div id="task_body" class="hidden">
                            <div id='profile'>
                                <div class='wrap'><p>Tasks</p>
                                    <a href="#" style="padding: 0 10px;" data-toggle="modal" class="pull-right" id="create_task"
                                    data-target="#createTask"><i class="fa fa-plus"></i> Create Task</a>
                                </div>
                            </div>
                            <div id='search'><label for=''><i class='fa fa-search' aria-hidden='true'></i></label><input
                                        type='text' id='taskTableSearch' placeholder='Search Tasks...'/></div>
                            <div id="contacts">
                                <ul id="task_table_list">

                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="content">
                        <div id="project-info">

                        </div>
                        <div class="messages">
                            <ul id="message-outlet">

                            </ul>
                        </div>

                        <div class="message-input">
                            <form class="wrap hidden" id="message_project_form" method="post" action="controller/app.php">
                                <div class="upload">
                                    <div class="drop">
                                        <ul id="file_upload_list">

                                        </ul>
                                    </div>
                                </div>
                                <input type="text" id="project_message_text" class="form-control"
                                    placeholder="Write your message..."/>
                                <input type="hidden" id="project_id">
                                <input type="hidden" id="attachedFiles">
                                <button class="submit" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                                <div class="clearfix"></div>
                                <div id="upload" class="upload">
                                    <div id="drop" class="drop">
                                        <a><span>Attach File <i class="fa fa-paperclip attachment"
                                                                aria-hidden="true"></i></span></a>
                                        <input type="file" name="attachment" multiple/>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--//masonry-->
            </div><!--//primary-->
            <div class="secondary col-md-3 col-sm-12 col-xs-12">
                <aside class="info aside section">
                    <div class="section-inner" id="third-row-data-outlet">

                    </div>
                </aside>
                
                <aside class="info aside section">
                    <div class="section-inner" id="files-row-data-outlet">

                    </div>
                </aside>
            </div>
        </div>
        <!-- Create Project Modal -->
        <div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="createProjectLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="createProjectLabel">Create Project</h4>
                    </div>
                    <div class="modal-body">
                        <div id="project_response"></div>
                        <form id="create_project_form" autocomplete="off">
                            <div class="form-project">
                                <label for="title">Project Title</label>
                                <input type="text" class="form-control" id="project_title" placeholder="Project Name">
                            </div>
                            <BR>
                            <button type="submit" class="btn btn-default" style="padding: 10px 15px; width: 20%">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
    <!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Create Task Modal -->
        
        
        <div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="createTaskLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createTaskLabel">Create Task</h4>
                </div>
                <div class="modal-body">
                    <div id="task_response"></div>
                    <form id="create_task_form" autocomplete="off">
                        <div class="form-group">
                            <label for="task_title">Task Title</label>
                            <input type="text" class="form-control" id="task_title" placeholder="Task Name">
                        </div>
                        <input type="hidden" name="project_id" id="project_id">
                        <div class="form-group">
                            
                            <label for="task_owners">Assign Members</label>
                            <select id="task_owners" class="form-control" style="display:none;">
                                
                            </select>
                            <select id="task_owners" class="form-control selectpicker" data-live-search="true">
                                
<?php 
 
 // Fetch Memebers in connection to assign task
    $login_id = $_SESSION['login_id'];
    $sth = $dbh->prepare("SELECT tbl_connection.login_id, tbl_connection.member_id, firstname, lastname FROM tbl_connection JOIN tbl_account_individual WHERE tbl_connection.member_id = tbl_account_individual.login_id AND tbl_connection.login_id = $login_id");
    $sth->execute();
    
    /* Fetch all of the remaining rows in the result set */
    $result = $sth->fetchAll();
    $i = 0;
    foreach($result as $key){  $i=$i+1; ?>
        <option value="<?php echo $key['member_id'] ?>"><?php echo $key['firstname']." ".$key['lastname']?></option>
    <?php }?>
                            </select>
                            
    <input type="number" id="max" value="<?php echo count($result); ?>" style="display:none;" />
                        </div>

                       
                    <div class="modal-footer"> 
                    <button type="submit" class="btn btn-default">Submit</button>
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
     <!-- Send Private Message -->
    <div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessageLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createTaskLabel">Compose A Message</h4>
                </div>
                <div class="modal-body">
                    <div id="message_response"></div>
                    <form id="message_member_form" autocomplete="off">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                        </div>
                        <input type="hidden" name="member_id" id="member_id">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message_text" class="form-control" placeholder="Write Message"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
                
                <!--<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
                <form method="post" action="projects">
                
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
        <a type="button" id="profile" class="btn btn-warning form-control" style="color:#fff !important" onclick="window.location.replace('https://www.pro-filr.com/profile')">Edit Profile</a>
        </div>
        <hr>
        <?php
        $login_id = $_SESSION['login_id'];
        
        $stmt = $dbh->query("SELECT login_id FROM tbl_subscribe WHERE login_id= '".$login_id."'");
        $stmt->execute();
        $res = $stmt->fetchAll();
        $numRow = $stmt->rowCount();
        

        if($numRow == 1)?>
            <!--Change Plan-->
        <div class="changePlan">
            <button id="plan" class="btn btn-success form-control" style="color:#fff !important">Change Plan</button>
             
            <div id="subSection">
            <!--<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
                <form method="post" action="projects">
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
        else{?>
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
    
	<?php include("partials/scripts.html"); ?>
    <script type="text/javascript" src="assets/lib/bootstrap-select/js/bootstrap-select.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
     <script type="text/javascript" src="assets/js/project.js"></script>

    <script src="assets/upload/js/jquery.knob.js"></script>
    <script src="assets/upload/js/jquery.ui.widget.js"></script>
    <script src="assets/upload/js/jquery.iframe-transport.js"></script>
    <script src="assets/upload/js/jquery.fileupload.js"></script>
    <script src="assets/upload/js/script.js"></script>
</body>
</html>
        
