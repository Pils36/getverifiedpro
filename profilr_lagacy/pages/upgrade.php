<?php

// error_reporting(E_ERROR | E_PARSE);

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');

header('Cache-Control: no-store, no-cache, must-revalidate');

header('Cache-Control: post-check=0, pre-check=0', FALSE);

header('Pragma: no-cache');

// session_start();

// if(!isset($_SESSION['token'])){

//     session_unset();

//     session_destroy();

//     header('Location: login.php');

// exit;

// }

// include("../views/head.html");



?>

<body class="Site">

<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 30px;">

	

    <!-- content row -->



    <div class="row" id="content_row">

        <div class="ui four wide column"></div>

        <div class="ui eight wide column">

            <div class="ui  vertical segment">



                <spcontent>

                    <h3 class="ui header">Upgrade to Classic, Get Profiled</h3>

                    <div class="ui vertical segment" style="height: 60vh;overflow-y: auto">

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

                        </p>



                    </div>



                </spcontent>



            </div>

        </div>

        <div class="ui two wide column"></div>

    </div>

    <!-- content row ends-->



</div>

<footer>

	<?php include("../views/footer.html"); ?>

</footer>

<?php include("../views/scripts.html"); ?>

</body>