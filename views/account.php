<?php

if (validateLogin()) {
	header('Location: home');
    // header('Location: paypal');
	exit;
}
if (empty($_SESSION['state'])) {
	$_SESSION['state'] = generate_string(15);
}
?>
<!DOCTYPE html>
<htmL>
<head>
    <title>Pro-filr | Where ideas meet skills</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>

    <link rel="shortcut icon" href="assets/images/proicon.png">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/semantic.css">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="loginWrapper">

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

                <!--<span class="pull-right">Forgot Password?</span>-->
                <ul class="tabs">
                    <li class="active">Login</li>
                    <li>Sign Up</li>
                </ul>

                <div class="clearfix"></div>

                <ul class="tab__content">

                    <li class="active">
                        <div class="content__wrapper">
                            <form id="login_form" class="ui error form">
                                <div class="ui error message"></div>

                                <div class="form-group">
                                    <input type="email" id="login_email" name="login_email" placeholder="email"
                                           class="form-control" required = "">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="login_password" name="login_password"
                                           placeholder="Password" class="form-control" required = "">
                                </div>

                                <input type="submit" value="Login" id="login_btn" name="login" style="width: 100%">

                            </form>
                        </div>
                    </li>

                    <li>
                        <div class="content__wrapper">
                            <form class="ui form error" id="signup_form" autocomplete="off">
                                <div class="ui error message"></div>

                                <div class="row" id="individual_name" style="display: block;">
                                    <div class="form-group col-md-6">
                                        <input id="signup_firstname" class="form-control" name="first-name"
                                               placeholder="First Name" type="text" required = "">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input id="signup_lastname" class="form-control" name="last-name"
                                               placeholder="Last Name" type="text" required = "">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
<!--                                        <label>Email Address*</label>-->
                                        <input id="signup_email" name="email"
                                               placeholder="Email Address" type="text" class="form-control" required = "">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input id="signup_password" name="create-password"
                                               placeholder="Create a password" type="password" class="form-control" required = "">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input name="confirm-password" placeholder="Confirm password"
                                               type="password" class="form-control" required = "">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                
                                        <input id="company" name="company"
                                               placeholder="Company" type="text" class="form-control" required = "">
                                    </div>
                                </div>    

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input id="signup_profession" name="signup_profession"
                                               placeholder="Profession" type="text" class="form-control" required = "">
                                    </div>
                                    <div class="form-group col-md-6">
										<?php include "modals/industries.html"; ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input id="signup_city" name="signup_city" placeholder="City"
                                               type="text" class="form-control" required = "">
                                    </div>
                                    <div class="form-group col-md-6">
										<?php include "modals/country.html"; ?>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <input type="checkbox" name="terms" required>
                                    <label>I agree to the <a>Terms and Conditions</a></label>
                                </div>


                                <input type="submit" value="Sign Up" id="signup_btn" name="sign_up" style="width: 100%">

                            </form>
                        </div>
                    </li>

                </ul>
                <span class="text-center"><a href="https://www.pro-filr.com/forgotpassword">Forgot Password?</a></span>
                <div class="clearfix"></div>

                <h4 class="text-center">OR</h4>

                <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=<?= LINKEDIN_CLIENT_ID ?>&redirect_uri=<?= LINKEDIN_REDIRECT_URL ?>&state=<?= $_SESSION['state'] ?>&scope=r_basicprofile r_emailaddress">
                    <img src="assets/images/linkedin.png" alt="linkedin">
                </a>

            </div>

            <div class="login100-more" style="background-image: url('assets/images/idea.jpg');">
            </div>
        </div>
    </div>
</div>

<?php include("partials/scripts.html"); ?>
<script type="text/javascript">
    $(document).ready(function () {

        // Variables
        var clickedTab = $(".tabs > .active");
        var tabWrapper = $(".tab__content");
        var activeTab = tabWrapper.find(".active");
        var activeTabHeight = activeTab.outerHeight();

        // Show tab on page load
        activeTab.show();

        // Set height of wrapper on page load
        tabWrapper.height(activeTabHeight);

        $(".tabs > li").on("click", function () {

            // Remove class from active tab
            $(".tabs > li").removeClass("active");

            // Add class active to clicked tab
            $(this).addClass("active");

            // Update clickedTab variable
            clickedTab = $(".tabs .active");

            // fade out active tab
            activeTab.fadeOut(250, function () {

                // Remove active class all tabs
                $(".tab__content > li").removeClass("active");

                // Get index of clicked tab
                var clickedTabIndex = clickedTab.index();

                // Add class active to corresponding tab
                $(".tab__content > li").eq(clickedTabIndex).addClass("active");

                // update new active tab
                activeTab = $(".tab__content > .active");

                // Update variable
                activeTabHeight = activeTab.outerHeight();

                // Animate height of wrapper to new tab height
                tabWrapper.stop().delay(50).animate({
                    height: activeTabHeight
                }, 500, function () {

                    // Fade in active tab
                    activeTab.delay(50).fadeIn(250);

                });
            });
        });
    });
</script>

<script type="text/javascript" src="assets/js/login.js"></script>
<script type="text/javascript" src="assets/js/signup.js"></script>
</body>
</html>