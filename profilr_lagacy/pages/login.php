<?php
session_start();
if (isset($_SESSION['token'])) {
	header("Location: profile.php");
	exit;
}
include("../views/head.html");

?>

<body class="Site">

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px;">
	<?php include("../views/home_nav.html"); ?>
    <!-- content row -->

    <div class="row" id="content_row">
        <div class="sixteen wide column">
            <div class="ui  vertical segment">
                <!-- <?php //include("../views/right_rail.html");?> -->
                <spcontent>
                    <div class="ui grid">
                        <div class="row" style="height: 65vh;">
                            <div class="ui four wide column"></div>
                            <div class="ui eight wide column">
                                <div class="ui top attached segment">
                                    <form class="ui error form" id="login_form"
                                          style="margin-top: 15px;margin-bottom: 20px;" autocomplete="off">
                                        <div class="field">
                                            <label>Email</label>
                                            <input type="text" id="login_email" name="login_email" placeholder="Email">
                                        </div>
                                        <div class="field">
                                            <label>Password</label>
                                            <input type="password" id="login_password" name="login_password"
                                                   placeholder="Password">
                                        </div>
                                        <!--                 <div class="field">
															<div class="ui checkbox">
															  <input type="checkbox" tabindex="0" class="hidden">
															  <label>I agree to the Terms and Conditions</label>
															</div>
														</div>
														<div> -->
                                        <button class="ui button" id="login_btn">Submit</button>
                                        <div class="ui error message"></div>
                                    </form>
                                    <div class="ui top attached label">LOGIN FORM</div>
                                    <div class="ui bottom attached label"><a style="color: red; font-weight: normal;">Reset
                                            your password</a>| <a style="color: blue; font-weight: normal;">Not yet a
                                            Member?</a></div>
                                </div>
                            </div>
                            <div class="ui four wide column">

                            </div>

                        </div>


                    </div>
                </spcontent>

            </div>
        </div>
    </div>
    <!-- content row ends-->

</div>
<footer>
	<?php include("../views/footer.html"); ?>
</footer>
<?php include("../views/scripts.html"); ?>
<script type="text/javascript" src="../js/login.js"></script>
</body>


<script type="text/javascript">
    // myApp.onReady();


    // $("#login_btn").on("click",function(event){
    //   event.preventDefault();

    //   myApp.onLogin();
    // });

    $('#login_form').form({
        fields: {

            email: {
                identifier: "login_email",
                rules: [
                    {
                        type: 'email',
                        promt: 'Please enter a valid email address'
                    }
                ]
            },
            password: {
                identifier: "login_password",
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter you password'
                    }
                ]
            }
        },
        onSuccess: function (event, fields) {
            event.preventDefault();
            login.onLogin();
        }
    });
</script>







