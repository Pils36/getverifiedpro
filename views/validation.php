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

if (empty($_SESSION['state'])) {
	$_SESSION['state'] = generate_string(15);
}

if (empty($_SESSION['import_mode'])) {
	$_SESSION['import_mode'] = TRUE;
}
?>


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

<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<?php include("partials/s_profile_nav.html"); ?>

<style>
    .segment-count{
        border: 1px solid #f1f1f1;
        width: 100%;
        height: auto;
        padding: 15px;
    }
    .segment-count h4{
        background-color: #129d59;
        color: #fff;
        width: 100%;
        padding: 10px;
        margin: 10px auto;
        position: relative;
    }
</style>
<div class="ui grid container Site-content" style="padding-top: 50px;width: 95% !important; display: none;">
    <div class="row" style="margin-top: 30px;"></div>

    <!-- content row -->
    <div class="row">

        <div class="ui four wide column" id="left-column">
            <div class="ui card section">
                <div class="image">
                    <img class="profile_picture" src="assets/images/man.png">
                </div>
                <div class="content">
                    <a class="header" id="profile_name"></a>
                    <!-- <div class="meta"><span class="date">Joined in 2013</span></div> -->
                    <div class="description" id="profile_current_position"></div>
                    <!-- <div class="ui divider"></div> -->
                    <!-- <div class="description">Systems Engineer at Grace InfoTech Limited</div> -->
                </div>

                <div class="extra content section">
                    <a id="profile_validations">0 Validations</a>
                    <div class="ui divider"></div>
                    <a id="profile_validations">0 Profile Views</a>
                    <div class="ui divider"></div>
                    <a id="profile_validations">0 Messages</a>
                </div>
                <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=<?= LINKEDIN_CLIENT_ID ?>&redirect_uri=<?= LINKEDIN_REDIRECT_URL ?>&state=<?= $_SESSION['state'] ?>&scope=r_basicprofile r_emailaddress" class="ui button" style="background-color: #2663B7; color: #fff;">Import LinkedIn Profile</a>

            </div>
        </div>
        

        <div class="ui eight wide column" id="middle-column">
	
	        <?php
	        if (!empty($_SESSION['oauth_error'])) {
		        ?>
                <div class="ui error message">
			        <?= $_SESSION['oauth_error'] ?>
                </div>
		        <?php
		        unset($_SESSION['oauth_error']);
	        }
	        ?>
            
            <div class="ui">
                
                <div class="row">
                    <div class="col-md-12">
                        <table id="myTable1" class="table table-striped table-hover" width="inherit">
                            <thead>
                                <tr style="text-align: justify; color: #fff; background-color: #129d59">
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Basis of Validation</th>
                                    <th>Validation Details</th>
                                    <th>URL</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                  $sth = $dbh->query("SELECT * FROM `tbl_validation` JOIN tbl_account_individual ON tbl_validation.validated_by = tbl_account_individual.login_id AND tbl_validation.member_id = '".$_SESSION['login_id']."'");
                                    
                                    $sth->execute();
                                    $result = $sth->fetchAll();
                                    
                                    $i = 1;
                                    foreach($result as $key => $member)?>
                                        <tr style="text-align: justify">
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $member['lastname']." ".$member['firstname']; ?></td>
                                    <td style="text-transform: uppercase"><?php echo $member['validate_type']; ?></td>
                                    <td><?php echo $member['detail_validated']; ?></td>
                                    <td><?php echo $member['validate_url']; ?></td>
                                    <td><?php echo $member['comment']; ?></td>
                                    </tr>
                                    
                            </tbody>
                            
                        </table>
                    </div>
                    
                </div>
            </div>
            



        </div>
        <div class="ui four wide column" id="right-column">
            
            <!--Validation Count-->
            <div class=" card segment-count"  style="margin-left: 50px">
                <div class="card-title">
                <h4 style="text-align: center; text-transform: uppercase">Validation count :</h4>
                </div>
                <div class="card-body">
                <p style="font-size: 35px; text-align: center; font-weight: 700; color: #1cb947">
                    
                    <?php print_r(count($result));?>
                    
                    <?php 
                    if(count($result) > 0)?>
                    <img align:"right" src="assets/images/verifiedlogo.png" alt="verified" style="width: 50px; height: 50px; border-radius: 100%">
                    
                    else ?>
                        <img align:"right" src="https://img.icons8.com/color/48/000000/id-not-verified.png" alt="not_verified" style="width: 50px; height: 50px; border-radius: 100%">
                   <? 
                    ?>
                </p>
                </div>
                <div class="ui vertical segment">
                <p>
                    <button class="ui button grey fluid profile_btn add_btn" data-content="photo"><i
                                class="photo icon"></i> Update Profile Picture
                    </button>
                </p>
            </div>
            <div class="ui vertical segment">
                <p>
                    <button class="ui button orange fluid edit_btn" data-content="profile"><i class="write icon"></i>
                        Edit Profile
                    </button>
                </p>
            </div>
            <div class="ui vertical segment">
                <p>
                    <button class="ui button blue fluid profile_btn add_btn" data-content="company"><i
                                class="plus icon"></i> Create Company Page
                    </button>
                </p>
            </div>
            
            <div class="ui vertical segment">
                <p>
                    <button class="ui button grey fluid profile_btn" data-content="invite"><i class="mail icon"></i>
                        Send Invites
                    </button>
                </p>
            </div>


            <div class="ui vertical segment">
                <p>
                    <button class="ui button teal fluid profile_btn add_btn contains_industry"
                            data-content="opportunity" data-header="Post Opportunity"><i class="external icon"></i> Post
                        Opportunity
                    </button>
                </p>
            </div>
            </div>
            
            
            


        </div>
        
        
    </div>


    <!-- content row -->
</div>

<footer></footer>


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

<!-- industry experience modal -->
<div class="ui  coupled first modal" id="experience_modal">
    <div class="ui header">Industry Experience</div>
    <div class="content">
        <p>Remove Item?</p>
    </div>
    <div class="actions">
        <div class="ui primary project button">
            <i class="add icon"></i>
            Add Project
        </div>
        <div class="ui negative  button">
            <i class="remove icon"></i>
            Cancel
        </div>
        <div class="ui  positive  button">
            <i class="checkmark icon"></i>
            Save
        </div>
    </div>

</div>
<!-- industry experience modal -->


<!-- industry experience project modal -->
<div class="ui coupled second small modal" id="project_modal">
    <div class="ui header">Project Details</div>
    <div class="content">
        <p>Remove Item?</p>
    </div>
    <div class="actions">
        <div class="ui negative  button">
            <i class="remove icon"></i>
            Cancel
        </div>
        <div class="ui  positive  button">
            <i class="checkmark icon"></i>
            Add
        </div>
    </div>

</div>

<?php include("partials/scripts.html"); ?>
<script type="text/javascript" src="assets/js/profile.js"></script>

</body>
</html>