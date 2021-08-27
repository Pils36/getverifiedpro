<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start();
if (!isset($_SESSION['token'])) {
	session_unset();
	session_destroy();
	header('Location: login.php');
	exit;
}
// if(!isset($_POST["response"])){

//     header('Location: login.php');
// }
?>
<!DOCTYPE html>
<html>
<?php include("../views/profile_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px; display: none;">
	<?php include("../views/profile_nav.html"); ?>
    <div class="row" style="margin-top: 20px;">
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

    <!-- content row -->
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
                    <a id="profile_validations">0 Validations</a>
                    <div class="ui divider"></div>
                    <a id="profile_validations">0 Profile Views</a>
                    <div class="ui divider"></div>
                    <a id="profile_validations">0 Messages</a>


                </div>
            </div>
        </div>


        <div class="ui eight wide column" id="middle-column">

            <div class="ui  grid segment" id="industry_experience_segment">
                <div class="row">
                    <h2 class="ui twelve wide column  header">Industry Experience</h2>
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


            <div class="ui  grid segment" id="affliation_segment">
                <div class="row">
                    <h2 class="ui twelve wide column  header">Religious/Social/Charitable Affliations</h2>
                    <div class="ui four wide column">
                        <button class="circular ui icon mini right floated button primary add_btn"
                                data-content="affliation" data-header="Religious/Social/Charitable Affliations">
                            <i class="icon plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row" id="affliation_row">
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
<!-- industry experience modal -->


<?php include("../views/scripts.html"); ?>

<script type="text/javascript" src="../js/profile.js"></script>

</body>
</html>