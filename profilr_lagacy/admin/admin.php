<?php

//$client = new Google_Client();
session_start();
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (!isset($_SESSION['login'])) {
	session_unset();
	session_destroy();
	header('Location: index.html');
	exit;
}

?>
<!DOCTYPE html>
<html>
<?php include("../views/profile_head.html"); ?>

<body class="Site">

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px;">
    <div class="row" id="nav_row">

        <div class="ui fixed inverted menu navbar" style="background-color: #40474a !important">
            <div class="header item">
                <img class="ui  image" src="../images/prologo.png">
            </div>
            <div class="right  menu profile_menu">
                <!-- <a class="item profile_link" data-page="index" data-view="home"><i class="university icon"></i>Home</a> -->

                <a class="item profile_link" data-view="landing"><i class="sign out icon"></i>Logout</a>


            </div>


        </div>


    </div>

    <!-- content row -->

    <div class="row">


        <div class="ui sixteen wide column" id="middle-column">


            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical fluid tabular menu">
                        <a class="active item admin_link" data-type="blogs">Blogs</a>
                        <a class="item admin_link" data-type="members">Registered Members</a>
                        <a class="item admin_link" data-type="subscriptions">Subscriptions</a>

                    </div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment admin_segment" id="blogs_segment">
                        <div class="ui top attached right menu">
                            <div class="item">
                                <div class="ui negative button" id="new_blog_btn">New Blog Post</div>
                            </div>

                        </div>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="blog_content"></div>

                    </div>


                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;" id="members_segment">
                        <h3 class="ui top attached red header">Registered Members</h3>
                        <div class="ui attached segment" style="height: 75vh; overflow-y: auto;"
                             id="members_content"></div>

                    </div>
                    <div class="ui segment admin_segment" style="margin-top: 0px; display: none;"
                         id="subscriptions_segment">
                        <h3 class="ui top attached red header">Subscriptions</h3>
                        <div class="ui bottom attached segment" style="height: 75vh; overflow-y: auto;"
                             id="subscriptions_content"></div>
                    </div>
                </div>
            </div>


        </div>

    </div>


    <!-- content row -->

</div>

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


<?php include("../views/scripts.html"); ?>

<script type="text/javascript" src="../js/profile.js"></script>
<!-- <script type="text/javascript" src="../js/posts.js"></script> -->
<script type="text/javascript" src="../js/admin.js"></script>

</body>
</html>