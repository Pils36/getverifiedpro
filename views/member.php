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

// error_reporting(1);

$user = 'exbcca_profilr_beta';
$pass = 'getverifiedpro2021!';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=exbcca_profilr_beta', $user, $pass);
    
    
    

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>


<!--Goto Member Page-->

<?php

if(isset($_GET['submit'])){
    echo $id;
}

?>
<!DOCTYPE html>
<html>
<?php include("partials/b_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body>
<?php include("partials/b_profile_nav.html"); ?>

<style>
    .m-div > p{
        font-size: 13px;
    }
    .professional-box ul{
        list-style: none;
    }
    
    .professional-box{
        border: 1px solid #159f5c;
        background-color: #fff;
        border-radius: 5px;
        padding: 15px;
    }
    .img-prof img{
        width: 70px; height: 70px;
        padding: 10px;
        border-radius: 100%;
        position: relative;
    }
    .btn-check{
        padding: 5px;
        border: 1px solid #159f5c;
        background-color: #fff;
        color: #159f5c;
        text-align: center;
    }
    .btn-check:hover{
        background-color: #159f5c;
        color: #fff;
    
    }



    .navi-list{
        text-align: justify;
        font-size: 13px;
        padding: 15px;
    }

    
</style>
<div class="container sections-wrapper">
    <div class="row">

        <div class="secondary col-md-3 col-sm-12 col-xs-12">
            <aside class="info aside section">
                <div class="section-inner">
                    <img class="profile_picture img-thumbnail" style="width: 100%" src="assets/images/man.png"/>
                </div>
                <div class="section-inner">
                    <!--          Button trigger modal -->
                    <?php 
        $sth = $dbh->prepare("SELECT * FROM `tbl_validation` WHERE member_id ='".$_SESSION['login_id']."'");
        $sth->execute();
        
        $res = $sth->fetchAll();
        $count = count($res);
        
        if($count > 0)?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" style="color:#fff; width: 100%; font-size: 13px;">
     
        VERIFIED
</button>
        
        
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg" style="color:#fff; width: 100%; font-size: 13px;">
     
        NOT YET VERIFIED
</button>
        <?
     ?>     
      <h4 class="header" id="profile_name"></h4>
                    <div class="description" id="profile_current_position"></div>
                    <br>
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
                                if($count > 0)?>
                                    <li><a href="validation">Validations</a><span class="label label-success pull-right"
                                                 id="profile_validations">0</span></li>
                            <li><a href="profile_view">Profile Views</a><span class="label label-danger pull-right"
                                                   id="profile_views">0</span></li>
                               
                               else ?>
                                   <li><a id="validations" style="cursor: pointer">Validations</a><span class="label label-success pull-right"
                                                 id="profile_validations">0</span></li>
                            <li><a id="views" style="cursor: pointer">Profile Views</a><span class="label label-danger pull-right"
                                                   id="profile_views">0</span></li>
                               <?
                            ?>  
                            <li><a href="posts"> Messages</a><span class="label label-warning pull-right" id="profile_messages">0</span>
                            </li>
                            <li><a href="invites"> Connections</a><span class="label label-primary pull-right" id="profile_connections">0</span>
                            </li>
                            <li><a href="groups"> Groups</a><span class="label label-default pull-right" id="profile_groups">0</span>
                            </li>
                        </ul>
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//aside-->

        </div><!--//secondary-->
        <div class="primary col-md-9 col-sm-12 col-xs-12">
            <div class="professional-box">
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <div>
                            
                    <h4 style="background-color: #159f5c; color: #fff; text-align: center; padding: auto; width: 100%; border-radius: 10px 10px 0px 0px;"> <img src="https://img.icons8.com/color/48/000000/groups.png"> Professional Group(s) on Pro-filr</h4>
                        </div>
                        
                <div class="divider">
                <ul class="navi table-responsive">
                    <table id="myTable1" class="table table-hover">
                <thead>
                  <tr>
                    <th>Owners Image</th>
                    <th>Company</th>
                    <th>Profession</th>  
                    <th>Group name</th>
                    <th>Date created</th>
                    <th>View profile</th>
                  </tr>
                </thead>
                <tbody>
                    
                <?php
 $login_id = $_SESSION['login_id'];
 
    $group = $dbh->query("SELECT tbl_groups.title as title,tbl_groups.date_created as date_created, tbl_account_individual.login_id AS login_id, tbl_account_individual.firstname as firstname, tbl_account_individual.lastname as lastname, tbl_account_individual.company AS company, tbl_account_individual.profession AS profession, tbl_account_individual.photo AS photo FROM tbl_groups, tbl_account_individual WHERE tbl_account_individual.login_id = tbl_groups.owner_login_id")->fetchAll(PDO::FETCH_ASSOC);
 
			foreach($group as $key)
			    $login_id = $key['login_id'];
			    $title = $key['title'];
			    $date_created = $key['date_created'];
			    $lastname = $key['lastname'];
			    $firstname = $key['firstname'];
			    $company = $key['company'];
			    $profession = $key['profession'];
			    $photo = $key['photo'];
			    
			?>
            
			 
                  <tr>
                    <td>
                        <img src=https://getverifiedpro.com/resources/pics/<?php echo $photo ?> align="left" style="width:50px; height: 50px; border-radius: 100%">
                    </td>
                    
                    <td style="text-transform: capitalize ;text-align: justify">
                        <?php echo $company ?>
                    </td>
                    
                    <td style="text-transform: capitalize ;text-align: justify">
                        <?php echo $profession ?>
                    </td>
                    <td style="font-size: 12px; text-align: justify">
                        
                        <?php echo substr($title, 0, 20); ?>
                        
                    </td>
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
$c = new Connection();
$ifConnected = $c->ifConnected($_SESSION['login_id'], $_POST['id']);

?>

<?php

// error_reporting(1);

$user = 'exbcca_profilr_beta';
$pass = 'getverifiedpro2021!';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=exbcca_profilr_beta', $user, $pass);
    

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>


<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">
<div id="mem" style="display: none;"><?php echo $_POST['id']; ?></div>
<div id="src" style="display: none;"><?= (!empty($_POST['source'])) ? $_POST['source'] : '' ?></div>

<div id="info" style="display: none;">
    <?php
        $sql = "SELECT * FROM tbl_account_individual WHERE login_id = '".$_POST['id']."'";
        $sql = $dbh->prepare($sql);
        $res = $sql->execute();
        $info = $sql->fetchAll();
        
        foreach($info as $key){
            $firstname = $key['firstname'];
            $lastname = $key['lastname'];
            $email = $key['email'];
            // echo $email;
        }
    ?>
    
    <?php echo $email?>
</div>


<div id="sender" style="display: none;">
    <?php
        $sql = "SELECT * FROM tbl_account_individual WHERE login_id = '".$_SESSION['login_id']."'";
        $sql = $dbh->prepare($sql);
        $res = $sql->execute();
        $info = $sql->fetchAll();
        
        foreach($info as $key){
            $firstname = $key['firstname'];
            $lastname = $key['lastname'];
            $email = $key['email'];
            // echo $email;
        }
    ?>
    
    <?php echo $firstname?>
</div>


<?php include("partials/s_profile_nav.html");
?>

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">
    <div class="row" style="margin-top: 30px;"></div>

    <!-- content row -->
    <div class="row">
        <div class="ui one column grid">

            <div class="ui sixteen wide column vertical segment" id="search_bar">

                <div class="ui fluid icon input">
                    <input placeholder="Search Professionals, Specialisations in Cities, Countries and much more..."
                           type="text" name="search_input" id="search_input">
                    <i class="circular search link icon search_link"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="ui four wide column" id="left-column">
            <div class="ui card">
                <div class="image">
                    <img id="profile_picture" src="../resources/pics/profile-placeholder.png">
                </div>
                <div class="content">
                    <a class="header" id="profile_name"></a>
                    <!-- <div class="meta"><span class="date">Joined in 2013</span></div> -->
                    <div class="description" id="profile_current_position"></div>
                    <!-- <div class="ui divider"></div> -->
                    <!-- <div class="description">Systems Engineer at Grace InfoTech Limited</div> -->
                </div>

                <div class="extra content">
                    
                    <?php
                    $sth = $dbh->prepare("SELECT * FROM `tbl_subscription` WHERE expiry_date >= NOW() AND login_id = '".$_SESSION['login_id']."'");
                                $sth->execute();
                                $result = $sth->fetchAll();
                                
                                $count = count($result);
                                
                                if($count > 0)?>
                                    <a id="profile_validations" style="cursor: pointer"href="validation">0 Validations</a>
                                    <div class="ui divider"></div>
                                    <a id="profile_views" style="cursor: pointer">0 Profile Views</a>
                                    <div class="ui divider"></div>
                               
                               else{?>
                                   <a id="profile_validations" class="valMem" style="cursor: pointer">0 Validations</a>
                    <div class="ui divider"></div>
                    <a id="profile_views" class="viewMem" style="cursor: pointer">0 Profile Views</a>
                    <div class="ui divider"></div>
                               

                    
                    <!--<a id="profile_messages">0 Messages</a>-->
                    <!--<div class="ui divider"></div>-->

                    <?php
                        if($_SESSION['login_id'] == $_POST['id'])?>
                            <button class="ui primary fluid button" id="msg_btn" disabled>MESSAGE THIS USER</button>
                            <div class="ui divider"></div>
                            
                            <div>
                        <button class="ui red fluid button" id="connect_btn" disabled>ADD TO MY CONNECTIONS</button>
                        <div class="ui divider"></div>
                    </div>
                    
                    <button class="ui positive fluid button" id="validate_btn" disabled>VALIDATE THIS USER</button>
                        

                        elseif($ifConnected)?>
                            <button class="ui primary fluid button" id="msg_btn">MESSAGE THIS USER</button>
                    <div class="ui divider"></div>
                    
                    <div>
                        <button class="ui yellow fluid button" id="group_btn">ADD TO GROUP</button>
                        <div class="ui divider"></div>
                    </div>
                    <button class="ui positive fluid button" id="validate_btn">VALIDATE THIS USER</button>
                        
                        
                        elseif(!$ifConnected)?>
                            <button class="ui primary fluid button" id="msg_btn">MESSAGE THIS USER</button>
                    <div class="ui divider"></div>
                    <div>
                        <button class="ui red fluid button" id="connect_btn">ADD TO MY CONNECTIONS</button>
                        <div class="ui divider"></div>
                    </div>
                     <button class="ui positive fluid button" id="validate_btn">VALIDATE THIS USER</button>
                        


                </div>
            </div>
        </div>
 <div class="ui twelve wide column" id="middle-column">
            <div class="ui segments">
                <div class="ui segment" id="industry_experience">
                    <h2 class="ui twelve wide column red header">Industry Experience</h2>
                </div>
                <div class="ui segment" id="executed_projects">
                    <h2 class="ui twelve wide column red header">Executed Projects/Engagements</h2>
                </div>

                <div class="ui segment" id="educational_qualifications">
                    <h2 class="ui twelve wide column red header">Educational Qualifications</h2>
                </div>

                <div class="ui segment" id="professional_certifications">
                    <h2 class="ui twelve wide column red header">Professional Certifications</h2>
                </div>

                <div class="ui segment" id="affiliations">
                    <h2 class="ui twelve wide column red header">Religious/Social/Charitable Affiliations</h2>
                </div>


                <div class="ui segment" id="company">
                    <h2 class="ui twelve wide column red header">Company</h2>
                </div>


            </div>

        </div>

    </div>


    <!-- content row -->
</div>

footer></footer>


<!-- form modal -->
<div class="ui long modal" id="profile_modal">
    <i class="close icon"></i>
    <div class="header" id="modal_header">Profile Picture</div>
    <div class="content">

        <div class="description" id="modal_description"></div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Cancel</div>
        <div class="ui positive right labeled icon button" id="save_btn">Save<i class="checkmark icon"></i></div>
    </div>
</div>

<!-- form modal -->

<!-- confirm modal -->
<div class="ui small modal" id="confirm_modal">
    <div class="ui header">Confirmation</div>
    <div class="content">
        <p>Remove Item?</p>
    </div>
    <div class="actions">
        <div class="ui negative  button">
            <i class="remove icon"></i>
            No
        </div>
        <div class="ui  positive  button">
            <i class="checkmark icon"></i>
            Yes
        </div>
    </div>
</div>

<!-- confirm modal -->

<!-- message modal -->
<div class="ui modal" id="message_modal">
    <div class="ui header">Compose A Message</div>
    <div class="content">
        <form class="ui form" id="msg_form">
            <div class="field">
                <label>Subject*</label>
                <input name="msg_subject" id="msg_subject" placeholder="Subject" type="text">
            </div>
            <div class="field">
                <label>Message*</label>
                <textarea name="msg_body" id="msg_body"></textarea>
            </div>

            <!--  <button class="ui button" type="submit">Submit</button> -->
        </form>
    </div>
    <div class="actions">

        <div class="ui negative  button">
            <i class="remove icon"></i>
            Cancel
        </div>
        <div class="ui  positive  button" id="msg_send_btn">
            <i class="checkmark icon"></i>
            Send
        </div>
    </div>

</div>
<!-- industry experience modal -->


<!-- validation modal -->
<div class="ui  modal" id="validation_modal">
    <div class="ui header">Validate User</div>
    <div class="content">
        <form class="ui form" id="validate_form">
            <div class="field">
                <label>Please select type of detail to validate*</label>
                <select name="validate_type" id="validate_type">
                    <option value="industry_experience">Industry Experience</option>
                    <option value="executed_project">Executed Projects/Engagements</option>
                    <option value="educational_qualification">Educational Qualifications</option>
                    <option value="professional_certification">Professional Certifications</option>
                    <option value="affiliation">Religious/Social/Charitable Affiliations
                    </option>
                </select>
            </div>
            <div class="field">
                <label>Add Item*</label>
                <select name="validate_select" id="validate_select">
                    <option value=""></option>

                </select>
            </div>
            
            <div class="field">
                <label>URL*</label>
                <input type="text" name="validate_url" id="validate_url" required>
            </div>
            
            <div class="field">
                <label>Add a comment*</label>
                <textarea name="validate_comment" id="validate_comment"></textarea>
            </div>

            <!--  <button class="ui button" type="submit">Submit</button> -->
        </form>
    </div>
    <div class="actions">
        <div class="ui negative  button">
            <i class="remove icon"></i>
            Cancel
        </div>
        <div class="ui  positive  button" id="validate_send_btn">
            <i class="checkmark icon"></i>
            Validate
        </div>
    </div>

</div>

<!-- group modal -->
<div class="ui  modal" id="group_modal">
    <div class="ui header">Add user to group</div>
    <div class="content">
        <form class="ui form" id="group_form">
            <div class="field">
                <label>Please select group*</label>
                <select name="group_select" id="group_select">

                </select>
            </div>
            <!--  <button class="ui button" type="submit">Submit</button> -->
        </form>
        <h3>OR CREATE GROUP</h3>
        <form class="ui form" id="create_group_form">
            <div class="field">
                <label>Enter Group Name*</label>
                <input type="text" placeholder="Enter Group Name" id="group_title">
            </div>
            <!--  <button class="ui button" type="submit">Submit</button> -->
        </form>
    </div>
    <div class="actions">
        <div class="ui negative  button">
            <i class="remove icon"></i>
            Cancel
        </div>
        <div class="ui  positive  button" id="group_send_btn">
            <i class="checkmark icon"></i>
            Add
        </div>
    </div>

</div>
<!-- industry experience modal -->


<?php include("partials/scripts.html"); ?>
<script type="text/javascript" src="assets/js/member.js"></script>

</body>
</html>

                        
                    
                    