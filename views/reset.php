<?php
error_reporting(1);

if (validateLogin()) {
	// header('Location: home');
    header('Location: paypal');
	exit;
}
if (empty($_SESSION['state'])) {
	$_SESSION['state'] = generate_string(15);
	
}
?>

<?php
session_start();
if(isset($_SESSION['personalinfo'])){
    $personalinfo = $_SESSION['personalinfo'];
    // print_r($personalinfo);
}
?>

<?php



$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);


} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>

<?php
    // $key = $_SESSION['state'];
    // print_r($key);
    // print_r($_GET);
    if(isset($_GET['link']) == $key){
    $table=$dbh->query("
    ALTER TABLE tbl_login 
    AUTO_INCREMENT = 1");
    $table->execute();
    
    $newPass0 = $_POST['new_password_reset'];
    
    $newPass = md5($newPass0);
    
    // print_r($newPass);

   
    
    
        $sql = "UPDATE tbl_login SET password = :password WHERE EMAIL = '".$personalinfo['to']."'";
    
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':password', $newPass, PDO::PARAM_STR);
        $stmt->execute(); 
        
 
    }
    else{
        echo "<script>swal('Oops', 'You session key already used. Kindly go back to regenerate', 'warning')</script>";
    }
    
    ?>


<!DOCTYPE html>
<htmL>
<head>
    <title>Pro-filr | Where ideas meet skills</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>

    <link rel="shortcut icon" href="assets/images/proicon.png">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/semantic.css">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    
    
    <style>
        .form-inputs{
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    
    
    
    
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="loginWrapper">

				<?php
				if (!empty($_SESSION['oauth_error'])) {
					?>
                    <div class="ui error message">
						<?= $_SESSION['oauth_error'] ?>
                    </div>
					<?php
					unset($_SESSION['oauth_error']);
				}
				?>

                <!--<span class="pull-right">Forgot Password?</span>-->
                <span><img src="https://img.icons8.com/plasticine/64/000000/password.png"></span>
                <ul class="tabs">
                    
                    <li class="active">Password Reset
<img src="https://img.icons8.com/nolan/64/000000/available-updates.png" style="width:20px; height:20px">
</li>
                    <!--<li>Sign Up</li>-->
                </ul>

                <div class="clearfix"></div>

                <ul class="tab__content">

                    <li class="active">
                        <div class="content__wrapper">
                            
                           
                            
                            
                            
                            <form method="POST" action="reset.php" id="forgotten_password" class="ui error form">
                                <div class="ui error message"></div>
                            
                                <div class="form-group">
                                    
                                    
                                    <div class="form-inputs">
                                    <input type="password" id="reset_pass" name="new_password_reset" placeholder="Enter new password"
                                           class="form-control" style="padding: 20px; font-size: 13px">
                                           
                                           </div>
                                    <div class="form-inputs">
                                       <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Re-type Password"
                                       class="form-control" style="padding: 20px; font-size: 13px">
                                       </div>
                                </div>
                                

                                <input type="submit" value="Submit" id="new_password" name="new_password" style="width: 100%; border-radius: 0px 0px 10px 10px; font-size: 14px; font-family: candara"> <br>
                                
                                <a href="https://www.pro-filr.com/account" style="font-size: 13px">Click here to login</a>
                                

                            </form>
                        </div>
                    </li>


                </ul>

            </div>

            <div class="login100-more" style="background-image: url('assets/images/idea.jpg');">
            </div>
        </div>
    </div>
</div>

<?php include("partials/scripts.html"); ?>
<script type="text/javascript">
    $(document).ready(function () {

        // Variables
        var clickedTab = $(".tabs > .active");
        var tabWrapper = $(".tab__content");
        var activeTab = tabWrapper.find(".active");
        var activeTabHeight = activeTab.outerHeight();

        // Show tab on page load
        activeTab.show();

        // Set height of wrapper on page load
        tabWrapper.height(activeTabHeight);

        $(".tabs > li").on("click", function () {

            // Remove class from active tab
            $(".tabs > li").removeClass("active");

            // Add class active to clicked tab
            $(this).addClass("active");

            // Update clickedTab variable
            clickedTab = $(".tabs .active");

            // fade out active tab
            activeTab.fadeOut(250, function () {

                // Remove active class all tabs
                $(".tab__content > li").removeClass("active");

                // Get index of clicked tab
                var clickedTabIndex = clickedTab.index();

                // Add class active to corresponding tab
                $(".tab__content > li").eq(clickedTabIndex).addClass("active");

                // update new active tab
                activeTab = $(".tab__content > .active");

                // Update variable
                activeTabHeight = activeTab.outerHeight();

                // Animate height of wrapper to new tab height
                tabWrapper.stop().delay(50).animate({
                    height: activeTabHeight
                }, 500, function () {

                    // Fade in active tab
                    activeTab.delay(50).fadeIn(250);

                });
            });
        });
    });
</script>

<?php include("partials/scripts.html"); ?>

<script type="text/javascript" src="assets/js/login.js"></script>
<script type="text/javascript" src="assets/js/signup.js"></script>
</body>
</html>