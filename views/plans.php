<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

?>


<!DOCTYPE html>
<html>
<?php include("partials/b_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body>
<?php
if (!isset($_SESSION['token'])) {
	include("partials/b_general_nav.html");
} else {
	include("partials/b_profile_nav.html");
}
?>
<div class="container sections-wrapper">
    <div class="row">
        <div class="col-md-10 " style="margin-left: 15%;">
        <table class="table" style="width: 70%; text-align: center;">
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col" style="background-color: #0AA64C; color: #ffffff; text-align: center; font-size: large;">Free Solution<br> Free Forever</th>
                <th scope="col" style="background-color: #1A531B; color: #ffffff; text-align: center; font-size: large;">Paid Solution<br>&#36;10/Month or &#36;100/Annum</th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th scope="col" style="text-align: center;"><a href='account'>Get Started</a></th>
                <th scope="col" style="text-align: center;"><a data-toggle="modal" data-target="#myClassic"><a href='upgrade'>Get Started</a></th>
            </tr>
            </thead>
            <tbody>
            <tr style="background-color: #4c4f52; color: #FFFFFF;">
                <th scope="row">Home</th>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <th scope="row">View Validation</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>

            </tr>
            <tr>
                <th scope="row">Profile View</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>

            </tr>
            <tr>
                <th scope="row">View Opportunities</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>

            </tr>
            <tr>
                <th scope="row">People You May Know</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>

            </tr>
            <tr>
                <th scope="row">Blog</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr style="background-color: #4c4f52; color: #FFFFFF;">
                <th scope="row">Connect</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Connection</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Send Invitation</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Upload & Invite Contacts</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Weekly Account Statistics</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Company Profile</th>
                <td><i class="glyphicon glyphicon-ok"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>

            <tr style="background-color: #4c4f52; color: #FFFFFF;">
                <th scope="row">Engage</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Access Opportunities</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Messaging</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Professional Group</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">My Industry Ranking (Local & Global)</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr style="background-color: #4c4f52; color: #FFFFFF;">
                <th scope="row">Project</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Create Project</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Virtual Project Meeting Room</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Project Documentation</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Cloud Storage</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Share Big Files</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">All Task View</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Web Chat</th>
                <td><i class="glyphicon glyphicon-remove"></i></td>
                <td><i class="glyphicon glyphicon-ok"></i></td>
            </tr>
            <tr>
                <th scope="row">Supports</th>
                <td>Email Customer Support</td>
                <td>Priority Customer Support</td>
            </tr>
            </tbody>
        </table>
        </div>
<!--        <div style="margin-left: 15%;" class="primary col-md-10 col-sm-12 col-xs-12">-->
<!--            <div class="col-sm-5">-->
<!--                <div class="upbox">-->
<!--                    <h3 class="title">Free Solution</h3>-->
<!--                </div>-->
<!--                <div class="upbox-content">-->
<!--                    <p>Connect</p>-->
<!---->
<!--                    <div class="upbox-submit">-->
<!--                        <p>Select Plan</p>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--            <div class="col-sm-5">-->
<!--                <div class="upbox1">-->
<!--                    <h3 class="title">Paid Solution</h3>-->
<!--                </div>-->
<!---->
<!--                <div class="upbox1-content">-->
<!--                    <p>Connect</p>-->
<!--                    <p>Engage</p>-->
<!--                    <p>Project</p>-->
<!---->
<!--                    <div class="upbox1-submit">-->
<!--                        <a data-toggle="modal" data-target="#myClassic">Select Plan</a>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->

<!--        </div>//primary-->

    </div><!--//row-->
</div><!--//masonry-->
<div class="modal fade" id="myClassic" tabindex="-1" role="dialog" aria-labelledby="createGroupLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createGroupLabel">Upgrade to Classic, Get Profiled</h4>
            </div>
            <div class="modal-body">

                <p>
                    Classic Plan offers awesome opportunities not available to free users. Classic Plan means:
                <ul>
                    <li>More business opportunities as you rank higher during the search for your
                        specialisations
                    </li>
                    <li>More profile views, recommendations and engagements</li>
                    <li>More visibility through targeted advertisement</li>
                </ul>
                </p>
                <div class="ui divider"></div>
                <p>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="KH2G3CLSE3H8N">
                    <table>
                        <tr>
                            <td><input type="hidden" name="on0" value="Subscription Options">Subscription
                                Options
                            </td>
                        </tr>
                        <tr>
                            <td><select name="os0">
                                    <option value="Monthly Plan">Monthly Plan : $10.00 CAD - monthly</option>
                                    <option value="Annual Plan">Annual Plan : $100.00 CAD - yearly</option>
                                </select></td>
                        </tr>
                    </table>
                    <input type="hidden" name="currency_code" value="CAD">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif"
                           border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                         height="1">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include("partials/scripts.html"); ?>

<footer>
	<?php include("partials/s_footer.html"); ?>
</footer>
<script type="text/javascript" src="assets/js/search.js"></script>
</body>
</html>