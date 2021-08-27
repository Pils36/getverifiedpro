<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (empty($_SESSION['admin_login'])) {
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}
?>


<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>

<!--<link rel="stylesheet" href="assets/lib/bootstrap-select/css/bootstrap-select.min.css">-->
<style>
    .trumbowyg-box, .trumbowyg-editor {
        z-index: 0;
    }
</style>
<body class="Site">

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important;">
    <div id="nav_row" class="ui fixed secondary large menu header" style="border-bottom: 2px solid #79af76; background-color: white">
        <div class="ui container">
            <a href="home" class="header item">
                <img class="logo" style="width: 100%" src="assets/images/prologo.png">
            </a>


            <div class="right menu profile_menu">
                <!--                <span class="item"> <a href="upgrade" class="ui positive button">Upgrade</a></span>-->
                <a href="dashboard" class="item">Home</a>
                <a href="reports" class="item">Reports</a>
                <a href="emails" class="active item">Email Templates</a>
                <a class="item profile_link" data-view="landing"><i class="sign out icon"></i>Logout</a>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 30px;"></div>


    <!-- content row -->

    <div class="row">


        <div class="ui sixteen wide column" id="middle-column">


            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical fluid tabular menu">
                        <a class="active item admin_link" data-type="create">Create & Send Email Template</a>
                        <a class="item admin_link" data-type="saved">Saved Email Templates</a>
                    </div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment admin_segment" id="create_segment">
                        <h3 class="ui top attached red header">Create Email Template</h3>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="create_content">
                            <form class="ui form error" id="email_form">
                                <div class="field">
                                    <label for="template_content">Select Template</label>
                                    <select id="template_content">
                                        <option value="0">No Template</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="subject">Subject</label>
                                    <input type="text" placeholder="Enter Subject" id="subject">
                                </div>
                                <div class="field">
                                    <label for="message">Compose Message</label>
                                    <textarea class="textarea" id="message" placeholder="Enter Message" name="message">
                                    </textarea>
                                </div>

                                <div class="field">
                                    <label for="subject">Enter Test Email</label>
                                    <input type="email" placeholder="Enter Test Email" id="test_email">
                                </div>
                                
                                <div class="five fields">
                                 <span class="field">
                                <label for="user_group">By User Groups</label>
                                <select id="user_group">
                                    <option>All Users</option>
                                    <option>New Sign Ups</option>
                                    <option>Completed Profiles</option>
                                    <option>Uncompleted Profiles</option>
                                    <option>Classic Profiles</option>
                                    <option>Non Classic Profiles</option>
                                </select>
                            </span> <span class="field">
                                <label for="email_verify">By Email Verify Status</label>
                                <select id="email_verify">
                                    <option>All</option>
                                    <option>Verified Emails</option>
                                    <option>Unverified Emails</option>
                                </select>
                            </span>
                                    <span class="field">
                                <label for="country">By Countries</label>
                                <select multiple id="country" style="width: 100%">
                                    <option value="">All Countries</option>
	                                <?php require_once 'partials/countries.html'?>
                                </select>
                            </span>
                                    <span class="field">
                                <label for="min_profile_views">Min Profile Views</label>
                               <input type="number" min="0" value="0" id="min_profile_views">
                            </span>
                                    <span class="field">
                                <label for="max_profile_views">Max Profile Views</label>
                               <input type="number" min="0" id="max_profile_views">
                            </span>

                                </div>
                                <span>
                                    <input type="button" id="save_email" value="Save and Send Email to Test Email" class="ui default button right">
                                    <input type="submit" value="Save & Send Emails to Selected Users" class="ui positive button right">
                            </span>
                            </form>

                        </div>

                    </div>


                    <div class="ui segment admin_segment" id="saved_segment">
                        <h3 class="ui top attached red header">Saved Email Templates</h3>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="saved_content">
                            
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>
</div>
<!-- content row -->


<!-- <footer></footer> -->

<footer>
    <!--	--><?php //include("partials/s_footer.html"); ?>
</footer>
<?php include("partials/scripts.html"); ?>

<script src="assets/lib/Trumbowyg-master/dist/trumbowyg.min.js"></script>
<link rel="stylesheet" href="assets/lib/Trumbowyg-master/dist/ui/trumbowyg.min.css">
<script>
    $('.textarea').trumbowyg();
</script>


<link rel="stylesheet" type="text/css" href="assets/lib/DataTables/datatables.css">

<script type="text/javascript" charset="utf8" src="assets/lib/DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="assets/lib/DataTables/datatables.js"></script>


<script type="text/javascript">
    $(document).ready( function () {
        $('.report_data_table').DataTable();
    } );

</script>
<script type="text/javascript" src="assets/js/emails.js"></script>

</body>
</html>