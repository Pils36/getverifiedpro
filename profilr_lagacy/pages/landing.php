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
    <div class="row" style="margin-top: 20px;">
        <div class="ui one column grid">

            <div class="ui sixteen wide column vertical segment" id="search_bar">

                <div class="ui fluid icon input">
                    <input placeholder="Search Professionals, Specialisations in Cities, Countries and much more..."
                           type="text" name="search_input" id="search_input">
                    <i class="circular search link icon search_link"></i>
                </div>
            </div>
        </div>

    </div>
    <!-- content row -->
    <div class="row">

        <div class="ui four wide column" id="left-column">
            <div class="ui card">
                <div class="image">
                    <img id="profile_picture" src="../resources/pics/profile-placeholder.png">
                </div>
                <div class="content">
                    <a class="header" id="profile_name"></a>
                    <!-- <div class="meta"><span class="date">Joined in 2013</span></div> -->
                    <div class="description" id="profile_current_position"></div>
                    <!-- <div class="ui divider"></div> -->
                    <!-- <div class="description">Systems Engineer at Grace InfoTech Limited</div> -->
                </div>

                <div class="extra content">
                    <a id="profile_validations">0 Validations</a>
                    <div class="ui divider"></div>
                    <a id="profile_validations">0 Profile Views</a>
                    <div class="ui divider"></div>
                    <a id="profile_validations">0 Messages</a>
                </div>
            </div>
        </div>


        <div class="ui eight wide column" id="middle-column">

            <div class="row">
                <div class="ui column">

                    <div class="ui attached teal piled segment">
                        <h3 class="ui top header">RECENTLY POSTED OPPORTUNITIES</h3>
                        <div style="height: 35vh; overflow-y: auto;" id="opportunity_list">

                        </div>

                    </div>
                    <div class="ui bottom attached  message">

                        <a href="#">See All</a>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="ui column">

                    <div class="ui attached piled teal segment">
                        <h3 class="ui top header">BLOG POSTS</h3>
                        <div style="height: 35vh; overflow-y: auto;" id="blog_list">


                        </div>

                    </div>
                    <div class="ui bottom attached message">

                        <a href="#">See All</a>
                    </div>
                </div>
            </div>


        </div>


        <div class="ui four wide column" id="right-column">

            <div class="row">

                <div class="ui card">
                    <div class="content">
                        <div class="header">PEOPLE YOU MAY KNOW</div>

                        <div class="description" style="height: 30vh; overflow-y: auto;">

                        </div>
                    </div>
                    <div class="extra content">
                        <a class="right floated author">
                            View All
                        </a>
                    </div>
                </div>


            </div>

            <div class="row" style="margin-top: 10px;">


                <!--                   <div class="ui segment">
				
				
									  <div class="ui top attached label"><h4>RECOMMENDED TOOLS TO BUILD YOUR PRACTICE</h4></div>
									  <div class="ui vertical segment" style="height: 30vh; overflow-y: auto;" id="tools_segment">
									  <div class="ui bulleted list">
										  <a class="item" href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a98921891941b51de01d9cebbbb77d3b7325&locale=en" target="_blank">PROJECTS</a>
										  <a class="item" href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a9898c421e8391d663486578149be73e4b59&locale=en" target="_blank">CRM</a>
										  <a class="item" href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a98941a2f83b349f288438f9ecc8084d9c16&locale=en" target="_blank">SURVEYS</a>
										  <a class="item" href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a98906274bf1671bba42c532eb7c268019b7&locale=en" target="_blank">CAMPAIGNS</a>
										  <a class="item" href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a989ba40161ac0ae15ee179a83c9b1ab7dcf&locale=en" target="_blank">SUBSCRIPTIONS</a>
										  <a class="item" href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a9899ceaef239b1b06f4a897b083d8ebcaa8&locale=en" target="_blank">BOOKS</a>
									  </div>
				
									  </div>
								  </div> -->


                <!-- opipiip -->
                <div class="ui card">
                    <div class="content">
                        <div class="header">RECOMMENDED TOOLS TO BUILD YOUR PRACTICE</div>
                    </div>
                    <div class="content">

                        <div class="ui small feed">
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a class="item"
                                           href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a98921891941b51de01d9cebbbb77d3b7325&locale=en"
                                           target="_blank">PROJECTS</a>
                                    </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a class="item"
                                           href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a9898c421e8391d663486578149be73e4b59&locale=en"
                                           target="_blank">CRM</a>
                                    </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a class="item"
                                           href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a98941a2f83b349f288438f9ecc8084d9c16&locale=en"
                                           target="_blank">SURVEYS</a>
                                    </div>
                                </div>
                            </div>

                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a class="item"
                                           href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a98906274bf1671bba42c532eb7c268019b7&locale=en"
                                           target="_blank">CAMPAIGNS</a>
                                    </div>
                                </div>
                            </div>

                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a class="item"
                                           href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a989ba40161ac0ae15ee179a83c9b1ab7dcf&locale=en"
                                           target="_blank">SUBSCRIPTIONS</a>
                                    </div>
                                </div>
                            </div>

                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a class="item"
                                           href="https://payments.zoho.com/ResellerCustomerSignUp.do?id=26ea8ad5f635094a3d40394e07c4a9899ceaef239b1b06f4a897b083d8ebcaa8&locale=en"
                                           target="_blank">BOOKS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- uiuouoo -->


            </div>
        </div>
    </div>


    <!-- content row -->
</div>

<footer></footer>


<!-- form modal -->


<!-- confirm modal -->

<!-- industry experience modal -->

<!-- industry experience modal -->


<!-- industry experience project modal -->

<!-- industry experience modal -->


<?php include("../views/scripts.html"); ?>

<script type="text/javascript" src="../js/profile.js"></script>
<script type="text/javascript" src="../js/landing.js"></script>

</body>
</html>