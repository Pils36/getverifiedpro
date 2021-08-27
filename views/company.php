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

if (!empty($_POST['fromNav']) && $_POST['fromNav'] == "1") {
	$_SESSION['fromGmail'] = "0";
}
?>


<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<?php include("partials/s_profile_nav.html"); ?>

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">
    <div class="row" style="margin-top: 30px;"></div>
	<?php //var_dump($_SESSION['connections']); ?>
    <div class="ui four wide column">
        <aside class="info aside section">
            <div class="section-inner" style="background-color: white; padding: 20px;">
                <div class="content quote">
                    <ul class="list-unstyled">
                        <li><a href="invites">Send Invites</a></li>
                        <li><a href="invites">Connections</a></li>
                        <li class="active">Company Page</li>
                    </ul>
                </div><!--//content-->
            </div><!--//section-inner-->
        </aside><!--//aside-->
    </div>
    <div class="ui twelve wide column" id="middle-column" style="background-color: white">
        <div class="ui segments section">
            <div class="ui segment">
                <div class="ui top attached large green label" id="company_name">Company Details</div>
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


<?php include("partials/scripts.html"); ?>


<script type="text/javascript" src="assets/js/company.js"></script>

</body>
</html>