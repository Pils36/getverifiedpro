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

<div class="ui grid container Site-content" style="width: 90% !important; display: none;">
	<?php include("../views/profile_nav.html"); ?>

    <!-- content row -->
    <div class="row">

        <div class="ui two wide column" id="left-column">

        </div>


        <div class="ui twelve wide column" id="middle-column">
            <div class="ui segments">
                <div class="ui segment">
                    <div class="ui top attached large black label" id="company_name">Company Details</div>
                    <div class="ui segment" id="company_detail"></div>
                </div>
                <div class="ui segment">
                    <button class="ui fluid secondary button" id="company_btn">Update Company Details</button>
                </div>
            </div>

        </div>
        <div class="ui two wide column" id="right-column"></div>
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
<script type="text/javascript" src="../js/company.js"></script>

</body>
</html>