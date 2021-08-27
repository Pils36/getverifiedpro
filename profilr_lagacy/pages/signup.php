<?php include("../views/head.html"); ?>
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
                        <div class="row">
                            <div class="ui four wide column"></div>
                            <div class="ui eight wide column">
                                <div class="ui top attached segment">
                                    <h3 class="ui header">Sign Up</h3>
                                    <div id="signup_response"></div>
                                    <div class="ui vertical segment">
                                        <form class="ui form error" id="signup_form" autocomplete="off">

                                            <div class="field" id="individual_name" style="display: block;">
                                                <label>Name*</label>
                                                <div class="two fields">
                                                    <div class="field">
                                                        <input id="signup_firstname" name="first-name"
                                                               placeholder="First Name" type="text">
                                                    </div>
                                                    <div class="field">
                                                        <input id="signup_lastname" name="last-name"
                                                               placeholder="Last Name" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label>Email Address*</label>
                                                <div class="fields">
                                                    <div class="sixteen wide field">
                                                        <input id="signup_email" name="email"
                                                               placeholder="Email Address" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label>Password*</label>
                                                <div class="two fields">
                                                    <div class="field">
                                                        <input id="signup_password" name="create-password"
                                                               placeholder="Create a password" type="password">
                                                    </div>
                                                    <div class="field">
                                                        <input name="confirm-password" placeholder="Confirm password"
                                                               type="password">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="field">

                                                <div class="two fields">
                                                    <div class="field">
                                                        <label>Profession*</label>
                                                        <input id="signup_profession" name="signup_profession"
                                                               placeholder="Profession" type="text">
                                                    </div>
                                                    <div class="field">
                                                        <label>Industry/Area of Specialisation*</label>
														<?php include "../modals/industries.html"; ?>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="field">

                                                <div class="two fields">
                                                    <div class="field">
                                                        <label>City*</label>
                                                        <input id="signup_city" name="signup_city" placeholder="City"
                                                               type="text">
                                                    </div>
                                                    <div class="field">
                                                        <label>Country*</label>
														<?php include "../modals/country.html"; ?>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input type="checkbox" name="terms">
                                                    <label>I agree to the <a>Terms and Conditions</a></label>
                                                </div>
                                            </div>

                                            <div>
                                                <button class="ui button" id="signup_btn">Submit</button>

                                                <div class="ui error message"></div>
                                            </div>


                                        </form>
                                    </div>
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
<script type="text/javascript" src="../js/signup.js"></script>
</body>


<script type="text/javascript">

</script>