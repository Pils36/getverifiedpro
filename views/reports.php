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
                <a href="reports" class="active item">Reports</a>
                <a href="emails" class="item">Email Templates</a>
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
                        <a class="active item admin_link" data-type="users">Users</a>
                        <a class="item admin_link" data-type="profiles">Profiles</a>
                        <a class="item admin_link" data-type="growth">Growth</a>
                        <a class="item admin_link" data-type="validation">Validation</a>
                        <a class="item admin_link" data-type="utilisation">Utilisation</a>
                        <a class="item admin_link" data-type="imported">Imported contacts</a>
                    </div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment admin_segment" id="users_segment">
                        <h3 class="ui top attached red header">Users</h3>

                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="users_content">
                            
                        </div>

                    </div>
                    <div class="ui segment admin_segment" id="profiles_segment">
                        <h3 class="ui top attached red header">Profiles</h3>

                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="profiles_content"></div>

                    </div>
                    <div class="ui segment admin_segment" id="growth_segment">
                        <h3 class="ui top attached red header">Growth</h3>

                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="growth_content"></div>

                    </div>
                    <div class="ui segment admin_segment" id="validation_segment">
                        <h3 class="ui top attached red header">Validation</h3>

                        <form id="validation_date_range_form" class="ui form">
                            <div class="two fields">
                                <div class="required field">
                                    <label>Start Date</label>
                                    <input placeholder="Start Date" type="date" id="v_start_date">
                                </div>
                                <div class="required field">
                                    <label>End Date</label>
                                    <input placeholder="End Date" type="date" id="v_end_date">
                                </div>
                            </div>
                            <div class="ui submit positive button">Apply Range Filter</div>
                        </form>
                        <br>
                        <br>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="validation_content"></div>
                        
                    </div>
                    <div class="ui segment admin_segment" id="utilisation_segment">
                        <h3 class="ui top attached red header">Utilisation</h3>
                        <form id="utilisation_date_range_form" class="ui form">
                            <div class="two fields">
                                <div class="required field">
                                    <label>Start Date</label>
                                    <input placeholder="Start Date" type="date" id="u_start_date">
                                </div>
                                <div class="required field">
                                    <label>End Date</label>
                                    <input placeholder="End Date" type="date" id="u_end_date">
                                </div>
                            </div>
                            <div class="ui submit positive button">Apply Range Filter</div>
                        </form>
                        <br>
                        <br>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="utilisation_content"></div>

                    </div>

                </div>
            </div>


        </div>

    </div>
</div>
<!-- content row -->

<!-- <footer></footer> -->

<!-- indicate interest modal -->
<div class="ui long modal" id="subscription_modal">
    <i class="close icon"></i>
    <div class="header" id="subscription_modal_header"></div>
    <div class="content" id="subscription_modal_content">

        <div class="description" id="subscription_modal_description">
            <form class="ui form" name="subscription_form" id="subscription_form">
                <input type="hidden" name="email_addy" id="email_addy">
                <input type="hidden" name="member" id="member">
                <div class="field">
                    <select name="subscription_plan" id="subscription_plan">
                        <option value="Monthly Plan">Monthly Plan : $10.00 CAD - monthly</option>
                        <option value="Annual Plan">Annual Plan : $100.00 CAD - yearly</option>
                    </select>
                </div>
            </form>
        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui positive right labeled icon button" id="sub_btn">Add Subscription<i class="checkmark icon"></i>
        </div>
    </div>
</div>

<!-- indicate modal -->


<!-- confirm modal -->
<div class="ui small modal" id="message_modal">
    <div class="ui header">Message</div>
    <div class="content" id="message_content">
        <p>Remove Item?</p>
    </div>
    <div class="actions">
        <div class="ui negative  button">
            <i class="remove icon"></i>
            Close
        </div>

    </div>
</div>

<!-- confirm modal -->


<!-- form modal -->
<div class="ui tiny modal" id="blog_modal">
    <i class="close icon"></i>
    <div class="header" id="blog_modal_header">New Blog Post</div>
    <div class="scrolling content">

        <div class="description" id="blog_modal_description">
            <form class="ui form" id="blog_form">
                <div class="field">
                    <label>Status*</label>
                    <select name="blog_status" id="blog_status">
                        <option selected="" value=""></option>
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="field">
                    <label>Subject*</label>
                    <input name="blog_subject" id="blog_subject" placeholder="Title" type="text">
                </div>
                <div class="field">
                    <label>Content*</label>
                    <div class="ui segment" style="height: 50vh; overflow-y: auto;" contenteditable="true"
                         id="blog_form_content"></div>
                </div>
            </form>

        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui primary right labeled icon button" id="blog_update_btn">Update<i class="checkmark icon"></i>
        </div>
        <div class="ui positive right labeled icon button" id="blog_add_btn">Create<i class="checkmark icon"></i></div>
    </div>
</div>

<!-- form modal -->


<!-- CSV modal -->
<div class="ui tiny modal" id="csv_modal">
    <i class="close icon"></i>
    <div class="header" id="csv_modal_header">Import CSV</div>
    <div class="content">

        <div class="description" id="csv_modal_description">
            <!-- <div class="ui segment" style="height: 50vh;overflow-y: auto;" id="interest_segment"></div> -->
            <form class="ui form" id="upload_csv" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="function" id="function" value="sendCSV"/>
                <div class="field">
                    <label>Select CSV File</label>
                    <input type="file" name="file" id="file"/>
                </div>
            </form>

        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui positive right labeled icon button">Proceed<i class="checkmark icon"></i></div>
    </div>
</div>

<!-- form modal -->


<!-- message modal -->
<div class="ui tiny modal" id="read_message_modal">
    <i class="close icon"></i>
    <div class="header" id="read_message_modal_header">Message</div>
    <div class="scrolling content">

        <div class="ui description grid" id="read_message_modal_description">
            <!-- <div class="ui segment grid" style="height: 50vh;overflow-y: auto;" id="read_message_segment"> -->
            <div class="row">
                <div class="ui two wide column" style="font-weight: bold;">Date:</div>
                <div class="ui fourteen wide column" id="msg_date"></div>
            </div>
            <div class="row">
                <div class="ui two wide column" style="font-weight: bold;">Subject:</div>
                <div class="ui fourteen wide column" id="msg_subject"></div>
            </div>
            <div class="row">
                <div class="ui two wide column" style="font-weight: bold;">Sent By:</div>
                <div class="ui fourteen wide column" id="msg_by"></div>
            </div>

            <div class="row">
                <div class="ui two wide column" style="font-weight: bold;">Sent To:</div>
                <div class="ui fourteen wide column" id="msg_to"></div>
            </div>
            <div class="row">
                <div class="ui two wide column" style="font-weight: bold;">Message:</div>
                <div class="ui fourteen wide column"><p id="msg_content"></p></div>
            </div>

        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
    </div>
</div>


<!-- message modal -->


<footer>
    <!--	--><?php //include("partials/s_footer.html"); ?>
</footer>
<?php include("partials/scripts.html"); ?>

<link rel="stylesheet" type="text/css" href="assets/lib/DataTables/datatables.css">

<script type="text/javascript" charset="utf8" src="assets/lib/DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="assets/lib/DataTables/datatables.js"></script>


<script type="text/javascript">
    $(document).ready( function () {
        $('.report_data_table').DataTable();
    } );

</script>
<script type="text/javascript" src="assets/js/reports.js"></script>

</body>