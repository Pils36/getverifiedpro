<?php

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

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px; display: none;">
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
		
		<?php //var_dump($_SESSION['connections']); ?>


        <div class="ui sixteen wide column" id="middle-column">


            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical fluid tabular menu">
                        <a class="active item invites_link" data-type="blogs">Blogs</a>
                        <a class="item invites_link" data-type="members">Members</a>
                        <a class="item invites_link" data-type="subscriptions">Subscriptions</a>

                    </div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment invites_segment" style="height: 75vh; overflow-y: auto;" id="blogs">
                        <div class="ui top attached menu">
                            <a class="active item">
                                Section 1
                            </a>
                            <a class="item">
                                Section 2
                            </a>
                        </div>
                        <div class="ui attached segment">
                            There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look
                            even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be
                            sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum
                            generators on the Internet tend to repeat predefined chunks as necessary, making this the
                            first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined
                            with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.
                            The generated Lorem Ipsum is therefore always free from repetition, injected humour, or
                            non-characteristic words etc.
                        </div>
                        <div class="ui bottom attached menu">
                            <a class="active item">
                                Section 1
                            </a>
                            <a class="item">
                                Section 2
                            </a>
                        </div>
                    </div>
                    <div class="ui segment invites_segment"
                         style="height: 75vh; overflow-y: auto; display: none;margin-top: 0px;" id="members">


                    </div>
                    <div class="ui segment invites_segment"
                         style="height: 75vh; overflow-y: auto; display: none;margin-top: 0px;"
                         id="subscriptions"></div>
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
<div class="ui tiny modal" id="gmail_modal">
    <i class="close icon"></i>
    <div class="header" id="gmail_modal_header">YOUR GMAIL CONTACTS</div>
    <div class="scrolling content">
        <div style="display: none;" id="confirmGmail"><?php echo $_SESSION['fromGmail']; ?></div>
        <div class="description" id="gmail_modal_description">
			<?php
			if (isset($_SESSION['connections']) && $_SESSION['connections']) {
				//echo ($_COOKIE['connections']);
				//$connections = json_decode($_COOKIE['connections'],1);
				
				//$emails = $connections['connections'][0]['emailAddresses'];
				$emails = $_SESSION['connections'];
				//var_dump($emails);
				//var_dump($connections['connections']);
				echo "<table class='ui celled striped table'>
              <thead>
                <tr>
                  <th></th><th>Email Address</th><th>Name</th>
                </tr>
              </thead>
              <tbody id='contacts_tbody'>";
				foreach ($emails as $key => $email) {
					echo "<tr><td><input type='checkbox' value=''></td><td>" . $email['value'] . "</td><td>" . $email['dispayName'] . "</td></tr>";
				}
				// foreach ($emailAddresses as $key => $addy) {
				//   echo "<tr><td><input type='checkbox' value=''></td><td>".$addy['value']."</td><td>".$addy['dispayName']."</td></tr>";
				// }
				echo "</tbody></table>";
			} else {
				echo "<p>No Contacts found</p>";
			}
			
			
			?>
        </div>

    </div>
    <div class="actions">
        <div class="ui black deny button">Cancel</div>
        <div class="ui positive right google plus labeled icon button" id="modal_invite_btn">Invite<i
                    class="checkmark icon"></i></div>
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
<script type="text/javascript" src="../js/admin.js"></script>

</body>
</html>