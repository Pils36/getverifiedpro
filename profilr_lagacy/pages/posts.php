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

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px; display: none;">
	<?php include("../views/profile_nav.html"); ?>

    <!-- content row -->

    <div class="row">


        <div class="ui sixteen wide column" id="middle-column">
            <div class="ui top attached pointing secondary menu" id="posts_tab">
                <a class="active item" data-tab="job"><i class="tasks icon"></i>JOB OPPORTUNITIES</a>
                <a class="item" data-tab="message" id="msg_btn"><i class="talk icon"></i>MESSAGES</a>

            </div>
            <div class="ui  active tab segment" data-tab="job">

                <div class="ui grid">
                    <div class="four wide column">
                        <div class="ui vertical fluid tabular menu">
                            <a class="active item post_link" data-type="others">Posted by Others</a>
                            <a class="item post_link" data-type="mine">My Posts</a>
                            <a class="item post_link" data-type="interests">My Interests</a>
                        </div>
                    </div>
                    <div class="twelve wide stretched column">
                        <div class="ui segment" style="height: 75vh; overflow-y: auto;" id="post_segment">

                        </div>
                    </div>
                </div>
            </div>
            <div class="ui tab segment" data-tab="message">
                <div class="ui grid">
                    <div class="four wide column">
                        <div class="ui vertical fluid tabular menu">
                            <a class="active item msg_link" id="inbox_tab" data-type="inbox">Inbox</a>
                            <a class="item msg_link" id="sent_tab" data-type="sent">Sent</a>

                        </div>
                    </div>
                    <div class="twelve wide stretched column">
                        <div class="ui segment" style="height: 75vh; overflow-y: auto;" id="message_segment">

                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>


    <!-- content row -->
</div>

<!-- <footer></footer> -->

<!-- indicate interest modal -->
<div class="ui long modal" id="content_modal">
    <i class="close icon"></i>
    <div class="header" id="modal_header">Details</div>
    <div class="content" id="details_content">

        <div class="description" id="details_description"></div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
        <div class="ui positive right labeled icon button" id="save_btn_int">I'm Interested<i
                    class="checkmark icon"></i></div>
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
<div class="ui long modal" id="post_modal">
    <i class="close icon"></i>
    <div class="header" id="post_modal_header">Profile Picture</div>
    <div class="content">

        <div class="description" id="post_modal_description"></div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Cancel</div>
        <div class="ui positive right labeled icon button" id="save_btn">Save<i class="checkmark icon"></i></div>
    </div>
</div>

<!-- form modal -->


<!-- form modal -->
<div class="ui long modal" id="interest_modal">
    <i class="close icon"></i>
    <div class="header" id="interest_modal_header">Interests</div>
    <div class="content">

        <div class="description" id="interest_modal_description">
            <div class="ui segment" style="height: 50vh;overflow-y: auto;" id="interest_segment"></div>
        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Close</div>
    </div>
</div>

<!-- form modal -->


<!-- message modal -->
<div class="ui long modal" id="read_message_modal">
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
<script type="text/javascript" src="../js/posts.js"></script>

</body>
</html>