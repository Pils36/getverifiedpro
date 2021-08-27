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

        <div class="ui three wide column" id="left-column"></div>


        <div class="ui ten wide column" id="middle-column">
            <div class="ui segments">
                <div class="ui loading segment" style="min-height: 40vh;" id="opportunity-segment">
                    

                </div>
                


            </div>

        </div>

        <div class="ui three wide column" id="right-column"></div>

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


<!-- confirm modal -->

<!-- message modal -->

<!-- industry experience modal -->


<!-- validation modal -->


<!-- group modal -->

<!-- industry experience modal -->


<?php include("partials/scripts.html"); ?>
<script type="text/javascript" src="assets/js/opportunity.js"></script>

</body>
</html>