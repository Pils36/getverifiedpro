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

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <link id="theme-style" rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.min.css">


</head>

<body class="landing">
<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="alt">
        <h1><a href="home.html">Profilr</a></h1>
        <nav id="nav">
            <ul style="float: right;">
                <li class="btn btn-success"><a href="home">Home</a></li>
                <li><a href="account">GET STARTED</a></li>
            </ul>
        </nav>
    </header>

    <!-- Banner -->
    <section id="banner">
        <div class="inner">
            <div style="padding-bottom: 24px;">
                <img src="assets/images/prologo.png" class="logo" style="margin-bottom: 15px;">
                <p>where ideas meet skills</p>
            </div>
            <div class="wrap">
                <div id="search-form" class="search">
                    <input type="text" class="searchTerm" placeholder="Search Professionals, Specialisations in Cities, Countries and much more..." id="search_input">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            </form>

        </div>
        <div class="footer">
            <ul>
                <li><a href="blog">Blog</a></li>
                <li><a href="about">About Pro-Filr</a></li>
                <li><a href="privacy">Privacy and Terms</a></li>
                <li><a href="agreement">Terms and Conditions</a></li>
                <li><a href="copyright">Copyright Policy</a></li>
                <li><a href="upgrade">Upgrade to Classic, Get Profiled</a></li>
                <li><a href="forum">Forum Rules</a></li>
                <li><a href="cookies">Cookies Policy</a></li>
                <li><a href="contact">Contact Us</a></li>

            </ul>

        </div>
    </section>


</div>
<?php include("partials/scripts.html"); ?>


<script type="text/javascript">
    $(document).ready(function () {
        $(".search_link").on("click", function () {
            var query = $("#search_input").val();
            if (query.length) {
                $.redirect('search.php', {'query': query});
            }
        });
    });
</script>

</body>
</html>