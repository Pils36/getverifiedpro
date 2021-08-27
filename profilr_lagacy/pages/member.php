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
// $_POST['id'] = 16;
?>
<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION['token'])) {
	include("../views/head.html");
} else {
	include("../views/profile_head.html");
}
?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">
<div id="mem" style="display: none;"><?php echo $_POST['id']; ?></div>
<div class="ui grid container Site-content" style="width: 90% !important;">
	
	<?php
	if (!isset($_SESSION['token'])) {
		include("../views/home_nav.html");
	} else {
		include("../views/profile_nav.html");
	}
	?>

    <!-- content row -->
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
                    <div class="ui divider"></div>
                    <button class="ui primary fluid button" id="msg_btn">MESSAGE THIS USER</button>
                    <div class="ui divider"></div>
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

                <div class="ui segment" id="affliations">
                    <h2 class="ui twelve wide column red header">Religious/Social/Charitable Affliations</h2>
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
                <select name="validate_select" id="validate_select">
                    <option value=""></option>
                    <option value="Industry Experience">Industry Experience</option>
                    <option value="Executed Projects/Engagements">Executed Projects/Engagements</option>
                    <option value="Educational Qualifications">Educational Qualifications</option>
                    <option value="Professional Certifications">Professional Certifications</option>
                    <option value="Religious/Social/Charitable Affliations">Religious/Social/Charitable Affliations
                    </option>

                </select>


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
<!-- industry experience modal -->


<?php include("../views/scripts.html"); ?>

<!-- <script type="text/javascript" src="../js/profile.js"></script> -->
<script type="text/javascript" src="../js/member.js"></script>

</body>
</html>