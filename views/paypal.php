<?php

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');

header('Cache-Control: no-store, no-cache, must-revalidate');

header('Cache-Control: post-check=0, pre-check=0', FALSE);

header('Pragma: no-cache');

require_once('../vendor/firebase/php-jwt/src/JWT.php');

use Firebase\JWT\JWT;


function getLogin($dbh)
{
    $myResponse = new  response();
    $stmt = $dbh->prepare("SELECT * FROM tbl_login WHERE email=:email AND password=:pwd");
    $stmt->execute(array(
        ":email" => $_POST['email'],
        ":pwd" => md5($_POST['password'])
    ));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    //return json_encode(array("count"=>$stmt->rowCount()));
    if ($stmt->rowCount() < 1) {
        $myResponse->status = "success";
        $myResponse->message = "Invalid Login";
        return json_encode($myResponse);
        
    } else {
        $token = getToken($dbh, $rows["login_id"]);
        
        $myResponse->status = "success";
        $myResponse->message = "Login Successful";
        //populate SESSION
        $_SESSION['token'] = $token;
        $_SESSION['login_id'] = $rows["login_id"];
        // $_education = fetchEducation($dbh);
        // $_profile = fetchProfile($dbh);
        // $_certification = fetchCertification($dbh);
        // $_experience = fetchExperience($dbh);
        // $_affliation = fetchAffliation($dbh);
        $data = array(
            "token" => $token,
            // "education" => $_education,
            // "profile" => $_profile,
            // "certification" => $_certification,
            // "experience" => $_experience,
            // "affliation" => $_affliation
        );
        $myResponse->data = $data;
        return json_encode($myResponse);
    }
    
    
}

function getToken($dbh, $user)
{
    
    //valid login
    $tokenId = base64_encode(mcrypt_create_iv(32));
    $issuedAt = time();
    $notBefore = $issuedAt + 10;  //Adding 10 seconds
    $expire = $notBefore + 7200; // Adding 60 seconds
    $serverName = 'http://pro-filr.com/'; /// set your domain name
    
    
    /*
     * Create the token as an array
     */
    $data = array(
        'iat' => $issuedAt,         // Issued at: time when the token was generated
        'jti' => $tokenId,          // Json Token Id: an unique identifier for the token
        'iss' => $serverName,       // Issuer
        'nbf' => $notBefore,        // Not before
        'exp' => $expire,           // Expire
        'data' => array(                 // Data related to the logged user you can set your required data
            'id' => $user, // id from the users table
            //'name' => $row[0]['name'], //  name
        )
    );
    $secretKey = base64_decode(SECRET_KEY);
    /// Here we will transform this array into JWT:
    $jwt = JWT::encode(
        $data, //Data to be encoded in the JWT
        $secretKey, // The signing key
        ALGORITHM
    );
    
    return $jwt;
    
}

function isLoggedIn($dbh)
{
    $myResponse = new  response();
    if (!empty($_SESSION['login_id'])) {
        $myResponse->status = "success";
        $myResponse->message = "1";
        $subStat = getSubscription($dbh);
        if ($subStat['active'] == 1) {
            $myResponse->data = array("subscription" => "active");
        } else {
            $myResponse->data = array("subscription" => "inactive");
        }
    } else {
        $myResponse->status = "failed";
        $myResponse->message = "0";
    }
    return json_encode($myResponse);
}



if (!validateLogin()) {

	$_SESSION['oauth_error'] = 'Please Login';

	header('Location: account');

	exit;

}

?>



<?php

if (isset($_POST['submit'])) {
    
$plan = $_POST['os0'];
  
$vars = array(
            'cmd' => '_s-xclick',
            'hosted_button_id' => 'HRCBVECF4UA2S',
            'currency_code' => 'USD',
            'on0' => 'Subscription Plans',
      'os0' => $plan
);


$sql = "INSERT INTO `tbl_subscription`(
login_id,
plan,

)
VALUES(
:login_id,
:plan,
)
";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
':login_id' => $_SESSION['login_id'],
':plan' => $plan,
));


header('Location: https://www.paypal.com/cgi-bin/webscr?' . http_build_query($vars));
}


?>




<!DOCTYPE html>

<html>

<?php include("partials/s_head.html"); ?>

<?php //echo "token:".$_SESSION['token']; ?>


<body class="Site">
<style>
    body{
        background:linear-gradient(rgba(66,156,69,0.8),rgba(0,0,0,0.5));
    }
</style>


<?php include("partials/s_profile_nav.html"); ?>



<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">

    <div class="row" style="margin-top: 30px;"></div>

    <!-- content row -->

    <div class="row">



        <div class="ui four wide column" id="left-column"></div>





        <div class="ui eight wide column" id="middle-column">


<div style="background-color: #f1f1f1; width: 100%; border-radius: 10px; padding: 20px; text-align: center; font-weight: bold; font-size: 15px">YOUR ACCOUNT WOULD BE ACTIVATED 24HRS AFTER PAYMENT</div>
            <div class="ui segment">

<!--                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">-->
<!--<input type="hidden" name="cmd" value="_s-xclick">-->
<!--<input type="hidden" name="hosted_button_id" value="KH2G3CLSE3H8N">-->
<!--<table>-->
<!--<tr><td><input type="hidden" name="on0" value="Subscription Options">Subscription Options</td></tr><tr><td><select name="os0">-->
<!--    <option value="Monthly Plan">Monthly Plan : $10.00 CAD - monthly</option>-->
<!--    <option value="Annual Plan">Annual Plan : $100.00 CAD - yearly</option>-->
<!--</select> </td></tr>-->
<!--</table>-->
<!--<input type="hidden" name="currency_code" value="CAD">-->
<!--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<!--<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">-->
<!--</form>-->


<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KH2G3CLSE3H8N">
<table>
<tr><td><input type="hidden" name="on0" value="Subscription Options">Subscription Options</td></tr><tr><td><select name="os0">
	<option value="Monthly Plan">Monthly Plan : $10.00 CAD - monthly</option>
	<option value="Annual Plan">Annual Plan : $100.00 CAD - yearly</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="CAD">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<br>
<div style="background-color: #d3efe0; padding: 10px; font-size: 12px">Don't worry, you can upgrade, downgrade or cancel your plan at anytime</div>

            </div>

        </div>

        <div class="ui four wide column" id="right-column"></div>

    </div>





    <!-- content row -->

</div>



<footer></footer>





<?php include("partials/scripts.html"); ?>

<script>

    // paypal.Button.render({



    //     env: 'production', // Optional: specify 'sandbox' environment



    //     payment: function (resolve, reject) {



    //         var CREATE_PAYMENT_URL = 'https://my-store.com/paypal/create-payment';



    //         return paypal.request.post(CREATE_PAYMENT_URL)

    //             .then(function (data) {

    //                 resolve(data.paymentID);

    //             })

    //             .catch(function (err) {

    //                 reject(err);

    //             });

    //     },



    //     onAuthorize: function (data) {



    //         // Note: you can display a confirmation page before executing



    //         var EXECUTE_PAYMENT_URL = 'https://my-store.com/paypal/execute-payment';



    //         return paypal.request.post(EXECUTE_PAYMENT_URL,

    //             {paymentID: data.paymentID, payerID: data.payerID})



    //             .then(function (data) { /* Go to a success page */

    //             })

    //             .catch(function (err) { /* Go to an error page  */

    //             });

    //     }



    // }, '#paypal-button');

</script>





</body>

</html>