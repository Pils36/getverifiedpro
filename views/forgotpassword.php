<?php
error_reporting(1);
session_start();
if (validateLogin()) {
	header('Location: home');
    // header('Location: paypal');
	exit;
}
if (empty($_SESSION['state'])) {
	$_SESSION['state'] = generate_string(15);
	
}
?>

<?php


require './config/dataconfig.php';
// // $user = 'profilr_user';
// // $pass = 'portFOLIO_2015';

// try {
//     //connect DB
//     // $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);
//     $passkey = $_SESSION['state'];
// } catch (PDOException $e) {
// echo 0;
//     print "Error!: " . $e->getMessage() . "<br/>";
//     die();
// }


?>

    
    <?php
    if(isset($_POST['forgot_password'])){
        $stmt = $dbh->prepare("SELECT email,password FROM tbl_login WHERE email = '".$_POST['password_reset']."'");
            $stmt->execute();
            $res = $stmt->fetchAll();
            
            // print_r($_POST['password_reset']);
     $to = $_POST['password_reset'];
$subject = "Password Reset";
$password = $passkey;

// print_r($password);

$personalinfo = array(
    'to' => $to);

$message = '
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="https://www.pro-filr.com/assets/images/prologo.png">

    <meta name="format-detection" content="telephone=no"> 
    <title>Pro-filr</title>
    <style type="text/css">
      
      html { background-color:#E1E1E1; margin:0; padding:0; }
      body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, "Lucida Grande", sans-serif;}
      table{border-collapse:collapse;}
      table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
      img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
      a {text-decoration:none !important;border-bottom: 1px solid;}
      h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal; font-family:Helvetica; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}
      
      .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} 
      .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} 
      table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} 
      #outlook a{padding:0;}
      img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} 
      body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;}
      .ExternalClass td[class="ecxflexibleContainerBox"] h3 {padding-top: 10px !important;}
      h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
      h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
      h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
      h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
      .flexibleImage{height:auto;}
      .linkRemoveBorder{border-bottom:0 !important;}
      table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}
      body, #bodyTable{background-color:#E1E1E1;}
      #emailHeader{background-color:#E1E1E1;}
      #emailBody{background-color:#FFFFFF;}
      #emailFooter{background-color:#E1E1E1;}
      .nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
      .emailButton{background-color:#205478; border-collapse:separate;}
      .buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
      .buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
      .emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
      .emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
      .emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
      .imageContentText {margin-top: 10px;line-height:0;}
      .imageContentText a {line-height:0;}
      #invisibleIntroduction {display:none !important;} 
      span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} 
      span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
      span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
      
      @media only screen and (max-width: 480px){
        body{width:100% !important; min-width:100% !important;} 
 
        table[id="emailHeader"],
        table[id="emailBody"],
        table[id="emailFooter"],
        table[class="flexibleContainer"],
        td[class="flexibleContainerCell"] {width:100% !important;}
        td[class="flexibleContainerBox"], td[class="flexibleContainerBox"] table {display: block;width: 100%;text-align: left;}
       
        td[class="imageContent"] img {height:auto !important; width:100% !important; max-width:100% !important; }
        img[class="flexibleImage"]{height:auto !important; width:100% !important;max-width:100% !important;}
        img[class="flexibleImageSmall"]{height:auto !important; width:auto !important;}
        
        table[class="flexibleContainerBoxNext"]{padding-top: 10px !important;}
        
        table[class="emailButton"]{width:100% !important;}
        td[class="buttonContent"]{padding:0 !important;}
        td[class="buttonContent"] a{padding:15px !important;}
      }
     
      @media only screen and (-webkit-device-pixel-ratio:.75){
      @media only screen and (-webkit-device-pixel-ratio:1){
      }
      @media only screen and (-webkit-device-pixel-ratio:1.5){
      }
      @media only screen and (min-device-width : 320px) and (max-device-width:568px) {
      }
    </style>
   
  </head>
  <body bgcolor="#E1E1E1" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="
    text-align: justify !important;
">

    <center style="background-color:#E1E1E1;">
      <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;">
        <tbody><tr>
          <td align="center" valign="top" id="bodyCell">

    
            <table bgcolor="#E1E1E1" border="0" cellpadding="0" cellspacing="0" width="500" id="emailHeader">

              <!-- HEADER ROW // -->
              <tbody><tr>
                <td align="center" valign="top">
                  <!-- CENTERING TABLE // -->
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                      <td align="center" valign="top">
                        <!-- FLEXIBLE CONTAINER // -->
                        <table border="0" cellpadding="10" cellspacing="0" width="500" class="flexibleContainer">
                          <tbody><tr>
                            <td valign="top" width="500" class="flexibleContainerCell">

                              <!-- CONTENT TABLE // -->
                              <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr>
                                 
                                  <td align="left" valign="middle" id="invisibleIntroduction" class="flexibleContainerBox" style="display:none !important; mso-hide:all;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;">
                                      <tbody><tr>
                                        <td align="left" class="textContent">
                                          <div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
                                            Pro-filr
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                  <td align="right" valign="middle" class="flexibleContainerBox">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;">
                                      <tbody><tr>
                                        <td align="left" class="textContent">
                                          <!-- CONTENT // -->
                                          <div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
                                            If you cant see this message, <a href="#" target="_blank" style="text-decoration:none;border-bottom:1px solid #828282;color:#828282;"><span style="color:#828282;">view&nbsp;it&nbsp;in&nbsp;your&nbsp;browser</span></a>.
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                        <!-- // FLEXIBLE CONTAINER -->
                      </td>
                    </tr>
                  </tbody></table>
                  <!-- // CENTERING TABLE -->
                </td>
              </tr>
              <!-- // END -->

            </tbody></table>
            
            <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">

              
              <tbody><tr>
                <td align="center" valign="top">
                  
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;" bgcolor="#159f5c">
                    <tbody><tr>
                      <td align="center" valign="top">
                        
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                          <tbody><tr>
                            <td align="center" valign="top" width="500" class="flexibleContainerCell">
                              <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                <tbody><tr>
                                  <td align="center" valign="top" class="textContent">
                                    <h1 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">PRO-FILR</h1>
                                    <h2 style="text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color: #ffe069c9;line-height:135%;font-weight: bold;">Password Reset</h2>
                                    <div style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color: #ffffffcf;line-height:135%;">...Where IDEAS meet SKILLS </div>
                                  </td>
                                </tr>
                              </tbody></table>
                              <!-- // CONTENT TABLE -->

                            </td>
                          </tr>
                        </tbody></table>
                        <!-- // FLEXIBLE CONTAINER -->
                      </td>
                    </tr>
                  </tbody></table>
                  <!-- // CENTERING TABLE -->
                </td>
              </tr>

              <tr>
                <td align="center" valign="top">
                  <!-- CENTERING TABLE // -->
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F8F8F8">
                    <tbody><tr>
                      <td align="center" valign="top">
                        <!-- FLEXIBLE CONTAINER // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                          <tbody><tr>
                            <td align="center" valign="top" width="500" class="flexibleContainerCell">
                              <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                <tbody><tr>
                                  <td align="center" valign="top">

                                    <!-- CONTENT TABLE // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                      <tbody><tr>
                                        <td valign="top" class="textContent">
                                          <h3 mc:edit="header" style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Hello,</h3>
                                          <div mc:edit="body" style="text-align:justify;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">It appears you have forgotten your login credentials and have requested for a reset link on our platform.
                                            <br />
                                            <br />
                                          Click the reset link to proceed. If you did not make this request, do ignore this message
                                          </div> 
                                          <br/>                                
                                          <hr>                               
                                          <br>

                                            <a href=https://www.pro-filr.com/reset?link='.$password.'>
                                                    Follow this link to reset your password.
                                                </a>
                                            
                                               
                                                

                                          </td>
                                      </tr>
                                    </tbody></table>
                                    <!-- // CONTENT TABLE -->

                                  </td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                        <!-- // FLEXIBLE CONTAINER -->
                      </td>
                    </tr>
                  </tbody></table>
                  <!-- // CENTERING TABLE -->
                </td>
              </tr>

              <tr>
                <td align="center" valign="top" style="padding: 20px;">
                  <table>
                    <tbody>                     
                      <tr>
                        <td style="font-style: italic;">
                          <br />
                          Regards,<br/>
                          Pro-Filr Support Team<br />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
             
              <tr>
                <td align="center" valign="top" style="
padding: 20px;">
<hr>
                  <div style="margin: 0 auto; width: auto">
                    <img src="https://www.pro-filr.com/assets/images/prologo.png" alt="" width="100%" align="left" style="
                      width: 150px;
                  ">
                  </div>
                  <!-- // CENTERING TABLE -->
                </td>
              </tr>


            </tbody></table>
            
            <table bgcolor="#E1E1E1" border="0" cellpadding="0" cellspacing="0" width="500" id="emailFooter">

              
              <tbody><tr>
                <td align="center" valign="top">
                  <!-- CENTERING TABLE // -->
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                      <td align="center" valign="top">
                        <!-- FLEXIBLE CONTAINER // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                          <tbody><tr>
                            <td align="center" valign="top" width="500" class="flexibleContainerCell">
                              <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                <tbody><tr>
                                  <td valign="top" bgcolor="#E1E1E1">

                                    <div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
                                      <div>Copyright © 2019 <a href="#" target="_blank" style="text-decoration:none;color:#828282;"><span style="color:#828282;">Pro-filr</span></a>. <br>All&nbsp;rights&nbsp;reserved.</div>
                                      <div>Thanks for connecting with us.</div>
                                    </div>

                                  </td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                        <!-- // FLEXIBLE CONTAINER -->
                      </td>
                    </tr>
                  </tbody></table>
                  <!-- // CENTERING TABLE -->
                </td>
              </tr>

            </tbody></table>
            <!-- // END -->

          </td>
        </tr>
      </tbody></table>
    </center>
</body></html>
';
$message = wordwrap($message, 70, "\r\n");

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: subscription@pro-filr.com' . "\r\n";
$headers .= "Organization: Pro-filr\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n";


mail($to,$subject,$message,$headers);


$_SESSION['personalinfo'] = $personalinfo;
header("Location: https://www.pro-filr.com/reset");

    }
    ?>




<!DOCTYPE html>
<htmL>
<head>
    <title>GetVerified Pro | Where ideas meet skills</title>
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

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/semantic.css">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
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
                <ul class="tabs">
                    <li class="active">Forgot Password 
<img src="https://img.icons8.com/flat_round/64/000000/question-mark.png" style="width:20px; height:20px">
</li>
                    <!--<li>Sign Up</li>-->
                </ul>

                <div class="clearfix"></div>

                <ul class="tab__content">

                    <li class="active">
                        <div class="content__wrapper">
                            
                            
                             
                            
                            
                            <form method="POST" action="forgotpassword" id="forgotten_password" class="ui error form">
                                <div class="ui error message"></div>
                            
                                <div class="form-group">
                                    
                                    <input type="email" id="pass_email" name="password_reset" placeholder="Enter email address"
                                           class="form-control" style="padding: 20px; font-size: 14px">
                                </div>
                                

                                <input type="submit" value="Reset Password" id="forgot_password" name="forgot_password" style="width: 100%; border-radius: 0px 0px 10px 10px; font-size: 14px; font-family: candara">

                            </form>
                        </div>
                    </li>
                    
                        

                </ul>
<span><a href="https://www.Getverified Pro.com/account" style="text-decoration: none; text-align: center">Back</a></span>
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