<?php include("partials/s_head.html"); ?>
<body class="Site">
<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important;">
	<?php include("partials/s_general_nav.html"); ?>

    <div class="row" id="content_row">
        <div class="sixteen wide column" style="margin-top: 30px;">
            <div class="ui  vertical segment" style="background-color: #fff; padding: 30px;">
                <!-- <?php //include("templates/right_rail.html");?> -->
                <spcontent>
                    <div class="ui grid">
                        <div class="row">
                            <div class="ui four wide column"></div>
                            <div class="ui eight wide column">
                                <div class="ui top attached segment">
                                    <h3 class="ui header">Contact Us</h3>
                                    <div id="contact_response"></div>
                                    <div class="ui vertical segment">
                                        <form class="ui form error" id="contact_form" autocomplete="off">

                                            <div class="field" id="individual_name" style="display: block;">
                                                <label>Name*</label>
                                                <div class="two fields">
                                                    <div class="field">
                                                        <input id="contact_firstname" name="first-name"
                                                               placeholder="First Name" type="text">
                                                    </div>
                                                    <div class="field">
                                                        <input id="contact_lastname" name="last-name"
                                                               placeholder="Last Name" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label>Email Address*</label>
                                                <div class="fields">
                                                    <div class="sixteen wide field">
                                                        <input id="contact_email" name="email"
                                                               placeholder="Email Address" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label>Select an option*</label>
                                                <select id="contact_type" name="contact_type">
                                                    <option value=''></option>
                                                    <option value='Inquiry'>Inquiry</option>
                                                    <option value='Help'>Help</option>
                                                    <option value='Feedback'>Feedback</option>
                                                </select>
                                            </div>
                                            <div class="field">
                                                <label>Subject*</label>
                                                <div class="fields">
                                                    <div class="sixteen wide field">
                                                        <input id="contact_subject" name="subject" placeholder="Subject"
                                                               type="text">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="field">
                                                <label>Message*</label>
                                                <textarea rows="2" name="message" id="contact_message"></textarea>
                                            </div>

                                            <div>
                                                <button class="ui button" id="contact_btn">Submit</button>

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
	<?php include("partials/s_footer.html"); ?>
</footer>
<?php include("partials/scripts.html"); ?>
<script type="text/javascript" src="assets/js/contact.js"></script>
</body>

