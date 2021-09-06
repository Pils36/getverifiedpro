<?php
require_once "google-api-php-client/vendor/autoload.php";
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (!validateLogin()) {
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}

if (!empty($_POST['fromNav']) && $_POST['fromNav'] == "1") {
	$_SESSION['fromGmail'] = "0";
}
?>


<!DOCTYPE html>
<html>
<?php include("/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<?php include("partials/s_profile_nav.html"); ?>

<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">
    <div class="row" style="margin-top: 30px;"></div>
	<?php //var_dump($_SESSION['connections']); ?>
    <div class="ui four wide column">
        <aside class="info aside section">
            <div class="section-inner" style="background-color: white; padding: 20px;">
                <div class="content quote">
                    <ul class="list-unstyled" id="connect_tab">
                        <!--                        <li><a href="profile">Personal Profile</a></li>-->
                        <!--                        <li class="active">Send Invites</li>-->
                        <!--                        <li>Connections</li>-->
                        <li class="active item" data-tab="invite"><a>Send Invites</a></li>
                        <li class="item" data-tab="connect" id="connect_btn"><a>Connections</a></li>
                        <li><a href="company">Company Page</a></li>

                    </ul>
                </div><!--//content-->
            </div><!--//section-inner-->
        </aside><!--//aside-->
    </div>

    <div class="ui twelve wide column" id="middle-column" style="background-color: white">
        <div class="ui grid section">
            <div class="wide stretched column">

                <div class="ui  active tab segment" data-tab="invite">
                    <div class="ui grid">
                        <div class="four wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="active item invite_link" data-type="sent">Sent Invites</a>
                                <a class="item invite_link" data-type="new">New Invite</a>
                            </div>
                        </div>
                        <div class="twelve wide stretched column">
                            <div class="ui segment invites_segment" style="height: 75vh; overflow-y: auto;"
                                 id="sent_invites"></div>
                            <div class="ui segment invites_segment"
                                 style="height: 75vh; overflow-y: auto; display: none;margin-top: 0;" id="new_invites">

                                <h3 class="ui header">Invite to Pro-Filr</h3>
                                <form class="ui form">
                                    <div class="field">
                                        <label>Enter email address (separate with commas if more than one)</label>
                                        <textarea rows=2 name="manual_emails" id="manual_emails"></textarea>
                                    </div>
                                    <div class="field">
                                        <button class="ui positive right button" id="manual_btn">Invite</button>
                                    </div>
                                </form>
                                <div class="ui horizontal divider">OR</div>
                                <div class="ui two column grid">
                                    <div class="ui column" style="text-align: center;">
                                        <button class="ui vk button" id="csv_btn">Import from CSV</button>
                                        <div class="ui visible message">
                                            <p>Click <a href="../resources/sample.csv" target="_blank"
                                                        style="text-decoration: underline;">here</a> to see sample csv
                                                file</p>
                                        </div>
                                    </div>
                                    <div class="ui column" style="text-align: center;">
                                        <button class="ui google plus button" id="gmail_btn">Import from Gmail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ui tab segment" data-tab="connect">
                    <div class="ui grid">
                        <div class="four wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="active item connect_link" id="connected_tab" data-type="connected">My
                                    Connections</a>
                                <a class="item connect_link" id="suggested_tab" data-type="suggested">Suggested Connections</a>

                            </div>
                        </div>
                        <div class="twelve wide stretched column">
                            <div class="ui segment" style="height: 75vh; overflow-y: auto;" id="connect_segment">

                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- content row -->

        </div>
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
	
	
	<?php include("partials/scripts.html"); ?>

    <script type="text/javascript" src="assets/js/invites.js"></script>
    <script src="https://apis.google.com/js/client.js"></script>
</body>
</html>