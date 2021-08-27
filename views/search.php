<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">
<div id="query" style="display: none;"><?php echo $q = !empty($_POST['query']) ? $_POST['query'] : ''; ?></div>
<div class="ui grid container Site-content" style="width: 90% !important;">
	
	<?php
	if (!isset($_SESSION['token'])) {
		include("partials/s_general_nav.html");
	} else {
		include("partials/s_profile_nav.html");
	}
	?>
    <div class="row" style="margin-top: 70px;"></div>

    <div class="row">

        <div class="ui sixteen  column segment">
            <div class="ui top green attached label">Search Results</div>

            <div class="ui sixteen column vertical segment" id="search_results"
                 style="height: 75vh;overflow-y: auto;"></div>
        </div>


    </div>

</div>

<?php
include("partials/scripts.html");
?>
<script type="text/javascript" src="assets/js/search.js"></script>
</body>
</html>