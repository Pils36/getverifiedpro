<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (empty($_SESSION['admin_login'])) {
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}
?>

<?php 

$hostname='localhost';
$username='profilr_user';
$password='portFOLIO_2015';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=profilr_beta",$username,$password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
    // echo 'Connected to Database<br/>';
    
    
    // Registered Members
    
    $sth = $dbh->query("SELECT tbl_account_individual.login_id AS no, tbl_account_individual.email AS email, tbl_account_individual.online_status AS status, firstname,lastname,country, date_created FROM tbl_account_individual JOIN tbl_login ON tbl_account_individual.login_id = tbl_login.login_id ORDER BY date_created DESC");
    $sth->execute();
    
    $regMem = $sth->fetchAll();
    $countRegMem = count($regMem);
    
    
    // Trigger Already registered
    $sth = $dbh->query("SELECT tbl_account_individual.login_id AS no, tbl_account_individual.email AS email, tbl_account_individual.online_status AS status, tbl_invites_trigger.firstname AS firstname,tbl_invites_trigger.lastname AS lastname FROM tbl_invites_trigger JOIN tbl_account_individual ON tbl_account_individual.email = tbl_invites_trigger.email ORDER BY tbl_invites_trigger.id DESC");
    $sth->execute();
    
    $countTriggerReg =$sth->rowCount();
    // print_r($countTriggerReg);

$direct = $countRegMem - $countTriggerReg;


// Admin members not registered
$sth = $dbh->query("SELECT DISTINCT email, other_email FROM `tbl_invites_trigger` WHERE tbl_invites_trigger.email NOT IN (SELECT email FROM tbl_account_individual) ORDER BY tbl_invites_trigger.id ASC");
$sth->execute();
$countAd = $sth->rowCount();
    
    
    // Subscribed users
    
    $sth = $dbh->query("SELECT expiry_date, 'active' as `status`,firstname,lastname,email,subscription_date, online_status as state FROM tbl_subscription JOIN tbl_account_individual ON tbl_subscription.login_id = tbl_account_individual.login_id AND tbl_subscription.expiry_date IS NOT NULL AND date(expiry_date) >= NOW()");
    $sth->execute();
    $subMem = $sth->fetchAll();
    $countsubMem = count($subMem);
    
    
    // Awaiting Registration
    $sth = $dbh->query("select firstname,company,concat(firstname, ' ',lastname) as `name`,sent_to from tbl_invites join tbl_account_individual on tbl_invites.login_id = tbl_account_individual.login_id where sent_to not in (select email from tbl_account_individual) group by sent_to");
    $sth->execute();
    $await = $sth->fetchAll();
    $countAwait = count($await);
    
    
    
    // Admin trigger member
    $sth = $dbh->query("SELECT DISTINCT email FROM `tbl_invites_trigger` WHERE tbl_invites_trigger.email NOT IN (SELECT email FROM tbl_account_individual) ORDER BY tbl_invites_trigger.id ASC");
    $sth->execute();
    $countAdmin = $sth->rowCount();
    
    // Total users
     $sth = $dbh->query("SELECT * FROM tbl_promo WHERE acct_state = 0");
    $sth->execute();
    $counttotPromo = $sth->rowCount();
    // Promo Users
    $sth = $dbh->query("SELECT * FROM tbl_promo WHERE percent > 24 AND sub_status = 0");
    $sth->execute();
    $countPromo = $sth->rowCount();
    
    // Deactivated users
    $sth1 = $dbh->query("SELECT * FROM tbl_deactivate WHERE state = 1");
    $sth1->execute();
    $countDeactivated = $sth1->rowCount();
    
    // Qualified 25% users
    
    $sth = $dbh->query("SELECT * FROM tbl_promo WHERE percent > 24 AND sub_status = 0");
    $sth->execute();
    $countupPercent = $sth->rowCount();
    
    // Not Qualified 25% users
    
    $sth = $dbh->query("SELECT * FROM tbl_promo WHERE percent <= 24");
    $sth->execute();
    $countlowPercent = $sth->rowCount();
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }




?>

<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>

<!--<link rel="stylesheet" href="assets/lib/bootstrap-select/css/bootstrap-select.min.css">-->
<body class="Site">

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important;">
    <div id="nav_row" class="ui fixed secondary large menu header" style="border-bottom: 2px solid #79af76; background-color: white">
        <div class="ui container">
            <a href="home" class="header item">
                <img class="logo" style="width: 100%" src="assets/images/prologo.png">
            </a>
            

            <div class="right menu profile_menu">
<!--                <span class="item"> <a href="upgrade" class="ui positive button">Upgrade</a></span>-->
                <a href="dashboard" class="active item">Home</a>
                <a href="reports" class="item">Reports</a>
                <a href="emails" class="item">Email Templates</a>
                <a class="item profile_link" data-view="landing"><i class="sign out icon"></i>Logout</a>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 30px;"></div>


    <!-- content row -->

    <div class="row">


        <div class="ui sixteen wide column" id="middle-column">


            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical fluid tabular menu">
                        <a class="active item admin_link" data-type="blogs">Blogs</a>
                        <a class="item admin_link" data-type="members">Users <span style="cursor: pointer"><img src="https://img.icons8.com/color/48/000000/spinner-frame-1.png" style="width: 20px; height: 20px; cursor: pointer" class="fa fa-spin"></span> <span style="font-size: 12px; color: darkorange; font-weight: 600"><?php echo $countRegMem;?></span> <br>
                            <span style="font-size: 10px; color: green; font-weight: 600">Direct: <?php echo $direct;?> <br>
                                Admin: <?php echo $countTriggerReg;?>
                            </span> 
                        </a>
                        
                        
                        <!--Promo Users-->
                        
                        <a class="item admin_link" data-type="promo">Promo Users <span style="cursor: pointer"><img src="https://img.icons8.com/color/48/000000/spinner-frame-1.png" style="width: 20px; height: 20px; cursor: pointer" class="fa fa-spin"></span> <span style="font-size: 12px; color: darkorange; font-weight: 600"><?php echo $countPromo;?></span> <br>
                            <span style="font-size: 10px; color: green; font-weight: 600">Total: <?php echo $counttotPromo?><br>25% above: <?php echo $countupPercent;?> <br>
                                Below 25%: <?php echo $countlowPercent;?>
                            </span> 
                        </a>
                        
                        <!--End Promo Users-->
                        
                        
                        <!--Deactivated Users-->
                        
                        <a class="item admin_link" data-type="deactive">Deactivated Users <span style="cursor: pointer"><img src="https://img.icons8.com/color/48/000000/spinner-frame-1.png" style="width: 20px; height: 20px; cursor: pointer" class="fa fa-spin"></span> <span style="font-size: 12px; color: darkorange; font-weight: 600"><?php echo $countDeactivated;?></span>
                        </a>
                        
                        <!--End Deactivated Users-->
                        
                        
                        <a class="item admin_link" data-type="subscriptions">Subscriptions <span style="cursor: pointer"><img src="https://img.icons8.com/color/48/000000/renew-subscription.png" style="width: 20px; height: 20px; cursor: pointer" class=""></span> <span style="font-size: 12px; color: green; font-weight: 600"><?php echo $countsubMem;?></span></a>
                        <a class="item admin_link" data-type="invites">Invite from Excel <span style="cursor: pointer"><img src="https://img.icons8.com/office/16/000000/download.png" style="width: 20px; height: 20px; cursor: pointer" class=""></span></a>
                        <a class="item admin_link" data-type="sent">Users' Invites <span style="cursor: pointer"><img src="https://img.icons8.com/cotton/48/000000/sent.png" style="width: 20px; height: 20px; cursor: pointer" class=""></span> <span style="font-size: 12px; color: red; font-weight: 600"><?php echo $countAwait;?></span></a>
                        
                        <!--Admin Members / Use user mimick for "SENT" and "MEMBERS"-->
                        <a class="item admin link" style="cursor: disabled">Admin Invites <span style="cursor: pointer"><img src="https://img.icons8.com/color/100/000000/invite.png" style="width: 20px; height: 20px; cursor: pointer" class=""></span> <span style="font-size: 12px; color: blue; font-weight: 600"><?php echo $countAdmin;?></span></a>

                    </div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment admin_segment" id="blogs_segment">
                        <div class="ui top attached right menu">
                            <div class="item">
                                <div class="ui negative button" id="new_blog_btn">New Blog Post</div>
                            </div>

                        </div>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="blog_content"></div>

                    </div>


                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;" id="members_segment">
                        
                        <h3 class="ui top attached red header">
                            Registered Members
                            </h3>
                        
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="members_content">
                            
                        </div>
                        

                    </div>
                    
                    
                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;"
                         id="promo_segment">
                        <h3 class="ui top attached red header">Promo Users</h3>
                       
                        <div class="ui bottom attached segment" style="height: 75vh; overflow-y: auto;"
                             id="promo_content"></div>
                    </div>
                    
                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;"
                         id="deactive_segment">
                        <h3 class="ui top attached red header">Deactivate Users</h3>
                       
                        <div class="ui bottom attached segment" style="height: 75vh; overflow-y: auto;"
                             id="deactive_content"></div>
                    </div>
                    
                    
                    
                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;"
                         id="subscriptions_segment">
                        <h3 class="ui top attached red header">Subscriptions</h3>
                       
                        <div class="ui bottom attached segment" style="height: 75vh; overflow-y: auto;"
                             id="subscriptions_content"></div>
                    </div>

                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;"
                         id="sent_segment">
                         <div class="ui top attached right menu">
                            <div class="item">
                                <div class="ui negative button" id="resend_all_btn">Resend Invites</div>
                            </div>
                            <div class="item">
                                <h3 class="green">Sent Invites</h3>
                            </div>


                        </div>
                        <div class="ui bottom attached loading segment" style="height: 75vh; overflow-y: auto;"
                             id="sent_content"></div>
                    </div>


                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;"
                         id="invites_segment">
                        <h3 class="ui top attached red header">Send Invites</h3>
                        <div class="ui bottom attached segment" style="height: 75vh; overflow-y: auto;"
                             id="invites_content">
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
                                    <div class="ui visible message">
                                        <p>Click <a href="assets/resources/sample.xls" target="_blank" style="text-decoration: underline;">here</a> to see sample excel file</p>
                                    </div>
                                    <div class="ui positive right labeled icon button" id="admin_upload_csv">Send Invitations<i class="checkmark icon"></i></div>
                             </div>
                    </div>


                </div>
            </div>


        </div>

    </div>
</div>
    <!-- content row -->

<!-- <footer></footer> -->

<!-- indicate interest modal -->
<div class="ui long modal" id="subscription_modal">
    <i class="close icon"></i>
    <div class="header" id="subscription_modal_header"></div>
    <div class="content" id="subscription_modal_content">

        <div class="description" id="subscription_modal_description">
            <form class="ui form" name="subscription_form" id="subscription_form">
                <input type="hidden" name="email_addy" id="email_addy">
                <input type="hidden" name="member" id="member">
                <div class="field">
                    <select name="subscription_plan" id="subscription_plan">
                        <option value="Monthly Plan">Monthly Plan : $10.00 CAD - monthly</option>
                        <option value="Annual Plan">Annual Plan : $100.00 CAD - yearly</option>
                    </select>
                </div>
            </form>
        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui positive right labeled icon button" id="sub_btn">Add Subscription<i class="checkmark icon"></i>
        </div>
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
<div class="ui tiny modal" id="blog_modal">
    <i class="close icon"></i>
    <div class="header" id="blog_modal_header">New Blog Post</div>
    <div class="scrolling content">

        <div class="description" id="blog_modal_description">
            <form class="ui form" id="blog_form">
                <div class="field">
                    <label>Status*</label>
                    <select name="blog_status" id="blog_status">
                        <option selected="" value=""></option>
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="field">
                    <label>Subject*</label>
                    <input name="blog_subject" id="blog_subject" placeholder="Title" type="text">
                </div>
                <div class="field">
                    <label>Content*</label>
                    <div class="ui segment" style="height: 50vh; overflow-y: auto;" contenteditable="true"
                         id="blog_form_content"></div>
                </div>
            </form>

        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui primary right labeled icon button" id="blog_update_btn">Update<i class="checkmark icon"></i>
        </div>
        <div class="ui positive right labeled icon button" id="blog_add_btn">Create<i class="checkmark icon"></i></div>
    </div>
</div>

<!-- form modal -->


<!-- CSV modal -->
<div class="ui tiny modal" id="csv_modal">
    <i class="close icon"></i>
    <div class="header" id="csv_modal_header">Import CSV</div>
    <div class="content">

        <div class="description" id="csv_modal_description">
            <!-- <div class="ui segment" style="height: 50vh;overflow-y: auto;" id="interest_segment"></div> -->
            <form class="ui form" id="upload_csv" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="function" id="function" value="sendCSV"/>
                <div class="field">
                    <label>Select CSV File</label>
                    <input type="file" name="file" id="file"/>
                </div>
            </form>

        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui positive right labeled icon button">Proceed<i class="checkmark icon"></i></div>
    </div>
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


<footer>
    <!--	--><?php //include("partials/s_footer.html"); ?>
</footer>
<?php include("partials/scripts.html"); ?>

<!--<script type="text/javascript">-->
<!--    $(document).ready(function () {-->
<!--        $('.selectpicker').selectpicker();-->
<!--    });-->
<!--</script>-->
<script type="text/javascript" src="assets/js/invites.js"></script>
<script type="text/javascript" src="assets/js/admin.js"></script>

</body>