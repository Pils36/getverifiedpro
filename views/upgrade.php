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
// $c = new Connection();
// $ifConnected = $c->ifConnected($_SESSION['login_id'], $_POST['id']);

header('Location: paypal');

?>


<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">
<div id="mem" style="display: none;"><?php echo $_POST['id']; ?></div>
<div id="src" style="display: none;"><?= (!empty($_POST['source'])) ? $_POST['source'] : '' ?></div>
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

        <div class="ui four wide column" id="left-column"></div>


        <div class="ui eight wide column" id="middle-column">
            <div class="ui segments">
                <div class="ui segment">
                    <h3 class="ui twelve wide column red header">Please select a plan to proceed</h3>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" 
    target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="KH2G3CLSE3H8N">
    <table>
    <tr><td><input type="hidden" name="on0" value="Subscription 
    Options">Subscription Options</td></tr><tr><td><select name="os0">
    <option value="Monthly Plan">Monthly Plan : $10.00 CAD - monthly</option>
    <option value="Annual Plan">Annual Plan : $100.00 CAD - yearly</option>
    </select> </td></tr>
    </table>
    <input type="hidden" name="currency_code" value="CAD">
    <input type="image" 
    src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" 
    border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
    width="1" height="1">
    </form>


                </div>
            </div>

        </div>
        <div class="ui four wide column" id="left-column"></div>

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