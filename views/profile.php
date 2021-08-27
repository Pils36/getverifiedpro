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


<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<?php include("partials/s_profile_nav.html"); ?>
<style>
    .ui.grid > .column:not(.row), .ui.grid > .row > .column{
        padding-left: 2rem;
        padding-right: 2rem;
    }

    .content{
        max-height: 400px !important;
        overflow-y: auto !important;
    }
    #profile_modal{
         /*position: fixed !important;*/
        top: 0 !important;
        /*margin-top: 0 !important;*/
        /*max-height: 400px;*/
    }
    #confirm_modal{
        /*top: 0 !important;*/
        height: auto;
        top: 0;
        /*max-height: 300px;*/
        /*margin-top: 20%;*/
    }
</style>

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">
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

            <div class="ui  grid segment section" id="industry_experience_segment">
                <div class="row">
                    <h2 class="ui twelve wide column  header">Professional Experience</h2>
                    <div class="ui four wide column">
                        <button class="circular ui icon mini right floated button primary add_btn experiences_btn"
                                data-content="industry" data-header="Industry Experience (Previous)">
                            <i class="icon plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row" id="industry_experience_row">
                    <!-- <p></p> -->
                </div>
            </div>
            
            
            <div class="ui  grid segment" id="past_project_segment">
                <div class="row">
                    <h2 class="ui twelve wide column header">Executed Projects</h2>
                    <div class="ui four wide column">
                        <button class="circular ui icon mini right floated button primary add_btn project_add_btn"
                                data-content="project" data-header="Past Projects">
                            <i class="icon plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row" id="project_row">
                    <p></p>
                </div>
            </div>
            

            <div class="ui  grid segment" id="educational_qualification_segment">
                <div class="row">
                    <h2 class="ui twelve wide column  header">Educational Qualifications</h2>
                    <div class="ui four wide column">
                        <button class="circular ui icon mini right floated button primary add_btn"
                                data-content="education" data-header="Educational Qualification">
                            <i class="icon plus"></i>
                        </button>
                    </div>
                </div>

                <div class="row" id="educational_qualification_row">
                    <!-- <p></p> -->
                </div>
            </div>


            <div class="ui  grid segment" id="professional_certification_segment">
                <div class="row">
                    <h2 class="ui twelve wide column  header">Professional Certifications</h2>
                    <div class="ui four wide column">
                        <button class="circular ui icon mini right floated button primary add_btn"
                                data-content="professional" data-header="Professional Certification">
                            <i class="icon plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row" id="professional_certification_row">
                    <!-- <p></p> -->
                </div>
            </div>


            <div class="ui  grid segment" id="affiliation_segment">
                <div class="row">
                    <h2 class="ui twelve wide column  header">Religious/Social/Charitable Affiliations</h2>
                    <div class="ui four wide column">
                        <button class="circular ui icon mini right floated button primary add_btn"
                                data-content="affiliation" data-header="Religious/Social/Charitable Affiliations">
                            <i class="icon plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row" id="affiliation_row">
                    <!-- <p></p> -->
                </div>
            </div>


            


        </div>
        <div class="ui four wide column" id="right-column">
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
<script>
        <?php if(1>0){?>
            var url_string = window.location.href;
            var url = new URL(url_string);
            var c = url.searchParams.get("c");

            if(c == "post"){
                $("div.ui.vertical.segment > p > button.ui.button.teal.fluid").click();
            }
        <?php }?>
    </script>
</body>
</html>