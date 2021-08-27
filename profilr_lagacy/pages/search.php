<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start();
?>
<html>
<?php
if (!isset($_SESSION['token'])) {
	include("../views/head.html");
} else {
	include("../views/profile_head.html");
}
?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">
<div id="query" style="display: none;"><?php echo $_POST['query']; ?></div>
<div class="ui grid container Site-content" style="width: 90% !important;">
	
	<?php
	if (!isset($_SESSION['token'])) {
		include("../views/home_nav.html");
	} else {
		include("../views/profile_nav.html");
	}
	?>
    <div class="row" style="margin-top: 20px;">
        <div class="ui one column grid">

            <div class="ui sixteen wide column vertical segment" id="search_bar">

                <div class="ui fluid icon input">
                    <input placeholder="Search Professionals, Specialisations in Cities, Countries and much more..."
                           type="text" name="search_input" id="search_input">
                    <i class="circular search link icon search_main"></i>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="ui sixteen column segment">
            <div class="ui top attached blue label">Search Results</div>
            <div class="ui sixteen column vertical segment" id="search_results"
                 style="height: 75vh;overflow-y: auto;"></div>
        </div>


    </div>

</div>

<?php include("../views/scripts.html"); ?>

<script type="text/javascript" src="../js/profile.js"></script>
<script type="text/javascript" src="../js/search.js"></script>
</body>
</html>