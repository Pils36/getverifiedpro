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

        <div class="ui four wide column" id="left-column"></div>


        <div class="ui eight wide column" id="middle-column">
            <div class="ui segment">
                <form class="ui form error">
                    <div class="field">
                        <label>Select Plan</label>
                        <select>

                        </select>
                    </div>
                    <div class="field">
                        <label>Description</label>
                        <input type="text" name="description" id="description" readonly="">
                    </div>
                    <div class="field">
                        <div id="paypal-button"></div>

                    </div>
                </form>
            </div>
        </div>
        <div class="ui four wide column" id="right-column"></div>
    </div>


    <!-- content row -->
</div>

<footer></footer>


<?php include("../views/scripts.html"); ?>

<script type="text/javascript" src="../js/profile.js"></script>
<
<script>
    paypal.Button.render({

        env: 'production', // Optional: specify 'sandbox' environment

        payment: function (resolve, reject) {

            var CREATE_PAYMENT_URL = 'https://my-store.com/paypal/create-payment';

            return paypal.request.post(CREATE_PAYMENT_URL)
                .then(function (data) {
                    resolve(data.paymentID);
                })
                .catch(function (err) {
                    reject(err);
                });
        },

        onAuthorize: function (data) {

            // Note: you can display a confirmation page before executing

            var EXECUTE_PAYMENT_URL = 'https://my-store.com/paypal/execute-payment';

            return paypal.request.post(EXECUTE_PAYMENT_URL,
                {paymentID: data.paymentID, payerID: data.payerID})

                .then(function (data) { /* Go to a success page */
                })
                .catch(function (err) { /* Go to an error page  */
                });
        }

    }, '#paypal-button');
</script>


</body>
</html>