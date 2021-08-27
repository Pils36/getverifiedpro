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

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px;">
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

        </div>


        <div class="ui eight wide column" id="middle-column">

            <div class="row">
                <div class="ui column">

                    <div class="ui attached teal piled segment">
                        <h3 class="ui top header">CHANGE PASSWORD</h3>
                        <div id="opportunity_list">
                            <form class="ui form">
                                <div class="field">
                                    <label>Current Password</label>
                                    <input type="password" name="current" id="current">
                                </div>
                                <div class="field">
                                    <label>New Password</label>
                                    <input type="password" name="new" id="new">
                                </div>
                                <div class="field">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm" id="confirm">
                                </div>

                            </form>

                        </div>

                    </div>
                    <div class="ui bottom attached clearfix message">
                        <a href="#" id="forgot_link">Forgot your password?</button>
                            <button class="ui right floated button positive" id="change_btn">Change</button>
                    </div>
                </div>
            </div>


        </div>


    </div>


    <!-- content row -->
</div>

<footer></footer>


<!-- form modal -->


<!-- confirm modal -->

<!-- industry experience modal -->

<!-- industry experience modal -->


<!-- industry experience project modal -->

<!-- industry experience modal -->


<?php include("../views/scripts.html"); ?>

<script type="text/javascript" src="../js/profile.js"></script>
<script type="text/javascript" src="../js/change.js"></script>

</body>
</html>