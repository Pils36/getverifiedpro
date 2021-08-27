<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start();

// if(!isset($_POST["response"])){

//     header('Location: login.php');
// }
?>
<!DOCTYPE html>
<html>
<?php include("../views/profile_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Sites">
<div class="ui grid container Site-content" style="width: 90% !important;padding-top: 50px;">

    <div id="content">
		
		<?php
		if (!isset($_SESSION['token'])) {
			include("../views/home_nav.html");
		} else {
			include("../views/profile_nav.html");
		}
		?>
        <div class="ui vertical stripe segment">
            <div class="ui container">
                <h1 class="ui header">
                    Blog
                    <!-- <div class="sub header quote">The best way to predict future, is to create it.</div> -->
                </h1>
            </div>
        </div>
        <div class="ui vertical stripe segment">
            <div class="ui divided grid stackable container">
                <div class="row">
                    <article class="eleven wide column">


                    </article>
                    <aside class="five wide column">
                        <div class="ui small header">
                            Titles
                        </div>
                        <div class="ui small vertical fluid menu" id="blog_titles"></div>


                    </aside>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
include("../views/scripts.html");
if (isset($_SESSION['token'])) {
	echo '<script type="text/javascript" src="../js/profile.js"></script>';
}
?>
<script type="text/javascript" src="../js/blog.js"></script>
</body>
</html>