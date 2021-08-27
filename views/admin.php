<?php include("partials/s_head.html"); ?>
<body class="Site">

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important;">
	<?php include("partials/s_general_nav.html"); ?>
    <div class="row" style="margin-top: 30px;"></div>

    <!-- content row -->

    <div class="row" id="content_row">
        <div class="sixteen wide column">
            <div class="ui  vertical segment">
                <!-- <?php //include("templates/right_rail.html");?> -->
                <spcontent>
                    <div class="ui grid">
                        <div class="row" style="height: 65vh;">
                            <div class="ui four wide column"></div>
                            <div class="ui eight wide column">
                                <div class="ui top attached segment">
                                    <form class="ui error form" id="login_form"
                                          style="margin-top: 15px;margin-bottom: 20px;" autocomplete="off">
                                        <div class="field">
                                            <label>Username</label>
                                            <input type="text" id="login_email" name="login_email" placeholder="Username">
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
                                        <button class="ui button" id="login_btn">Login</button>
                                        <div class="ui error message"></div>
                                    </form>
                                    <div class="ui top attached label">LOGIN FORM</div>

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
<!--	--><?php //include("partials/s_footer.html"); ?>
</footer>
<?php include("partials/scripts.html"); ?>
<script type="text/javascript" src="assets/js/admin.js"></script>

</body>