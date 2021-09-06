<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Pro-filr | Where ideas meet skills</title>
    <link rel="icon" type="image/png" href="https://www.pro-filr.com/assets/images/proslogo.png">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/site.css">

    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/container.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/grid.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/header.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/image.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/menu.css">

    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/divider.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/dropdown.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/segment.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/button.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/list.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/icon.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/sidebar.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/semantic/components/transition.css">

    <style type="text/css">
        /* width */
        body::-webkit-scrollbar {
            width: 6px;
        }

        /* Track */
        body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        body::-webkit-scrollbar-thumb {
            background: #139f5e;
        }

        /* Handle on hover */
        body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .duration {
            font-size: 12px;
            color: #5f6b77;
        }

        .hidden.menu {
            display: none;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .masthead.segment {
            min-height: 550px;
            padding: 1em 0em;
        }

        .masthead input {
            padding: 15px;
            min-width: 40em;
            border-radius: 12px;
            color: #000;
        }


        .masthead .logo.item img {
            margin-right: 1em;
        }

        .masthead .ui.menu .ui.button {
            margin-left: 0.5em;
        }

        .masthead h1.ui.header {
            margin-top: 2em;
            margin-bottom: 0em;
            font-size: 4em;
            font-weight: normal;
        }

        .masthead h2 {
            font-size: 1.7em;
            font-weight: normal;
        }

        .ui.vertical.push {
            height: 80px;
            background-color: rgba(49, 155, 2, 0.4);
        }

        .ui.vertical.push h2 {
            padding: 20px;
        }

        .ui.vertical.push h2 a {
            margin-left: 30px;
            background-color: #FFFFFF;
        }

        .ui.vertical.stripe {
            padding: 8em 0em;
        }

        .ui.vertical.stripe h3 {
            font-size: 2em;
        }

        .ui.vertical.stripe .button+h3,
        .ui.vertical.stripe p+h3 {
            margin-top: 3em;
        }

        .ui.vertical.stripe .floated.image {
            clear: both;
        }

        .ui.vertical.stripe p {
            /*font-size: 1.33em;*/
        }

        .ui.vertical.stripe .horizontal.divider {
            margin: 3em 0em;
        }

        .quote.stripe.segment {
            padding: 0em;
        }

        .quote.stripe.segment .grid .column {
            padding-top: 5em;
            padding-bottom: 5em;
        }

        .footer.segment {
            padding: 5em 0em;
        }

        .secondary.pointing.menu .toc.item {
            display: none;
        }

        @media only screen and (max-width: 700px) {
            .ui.fixed.menu {
                display: none !important;
            }

            .secondary.pointing.menu .item,
            .secondary.pointing.menu .menu {
                display: none;
            }

            .secondary.pointing.menu .toc.item {
                display: block;
            }

            .masthead.segment {
                min-height: 350px;
            }

            .masthead h1.ui.header {
                font-size: 2em;
                margin-top: 1.5em;
            }

            .masthead h2 {
                margin-top: 0.5em;
                font-size: 1.5em;
            }

            .secondary.pointing.menu .toc.item {
                display: none;
            }
        }

        @media only screen and (max-width: 375px) {
            .masthead input {
                padding: 15px;
                min-width: 20em;
                border-radius: 12px;
                color: #000;
            }

            .ui.vertical.push h2 {
                padding: 20px;
                font-size: 19px;
            }

            .secondary.pointing.menu .toc.item {
                display: none;
            }

        }

        @media only screen and (max-width: 425px) {
            .masthead input {
                padding: 15px;
                min-width: 20em;
                border-radius: 12px;
                color: #000;
            }

            .ui.vertical.push h2 {
                padding: 20px;
                font-size: 19px;
            }

            .secondary.pointing.menu .toc.item {
                display: none;
            }

        }

        .ui.secondary.pointing.menu .item {
            border-bottom-color: none;

        }

        .ui.secondary.inverted.pointing.menu {
            border-width: none !important;
            border-color: none !important;
        }
    </style>

    <script src="assets/lib/jquery.min.js"></script>
</head>

<body>




    <!-- Following Menu -->
    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            <a class="active item">Profilr</a>
            <div class="right menu">
                <div class="item">
                    <a class="ui button">Log in</a>
                </div>
                <div class="item">
                    <a class="ui primary button">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Contents -->
    <div class="pusher">
        <div class="ui inverted vertical masthead center aligned segment" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://image.freepik.com/free-photo/skyscraper-view-city-leader-window-frame_1134-1034.jpg);background-position: 70%;background-repeat: no-repeat;background-size: cover;/* background-color: #072902; */">

            <div class="ui container">
                <div class="ui large secondary inverted pointing menu">
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    <div>
                        <a class="active item" href="home" style="text-transform: uppercase;">
                            <img src="https://www.getverifiedpro.com/assets/images/proslogo.png" style="position: relative; ">
                            ro-Filr</a>
                    </div>
                    <div class="right item">
                        <a class="ui inverted button" href="home">HOME</a>
                        <a class="ui inverted button" href="plans">PLANS & PRICING</a>
                        <a class="ui inverted button" href="account">GET STARTED</a>
                    </div>
                </div>
            </div>

            <div class="ui text container search">
                <h1 class="ui inverted header">

                </h1>

                <h2>...where IDEAS meet <span style="font-style: italic; font-size: 32px"> Verified </span> SKILLS</h2>
                <div class="ui huge field">
                    <input type="text" class="searchTerm" placeholder="Search Opportunities, Professionals, Specialisations and much more..." id="search_input">
                    <button class="ui large inverted button search_link" style="margin-top: 20px;">Search</button>
                </div>

                <br><br>
                <a style="color: #fff" id="example" href="https://pro-executes.com" target="_blank"></a>

            </div>

        </div>
        <div class="ui vertical masthead center aligned push">
            <div class="ui text container center aligned column">
                <h2>Have a new opportunity?<a class="ui large floated button" href="account">Add here</a></h2>
            </div>

        </div>

        <div class="ui vertical stripe segment">
            <div class="ui middle aligned stackable grid container">
                <div class="row">
                    <div class="seven wide column">
                        <div class="ui green loading segment" id="post_segment" style="min-height: 320px">
                            <h4 class="ui header">Recently posted Opportunities</h4>
                            <div class="ui very relaxed list" id="post_list"></div>
                            <!-- <p class="duration">Sort by newest</p> -->
                            <!-- <hr> -->
                            <!--<div>-->
                            <!--<p>Project Title-->
                            <!--<a class="ui small right floated green button">3 Project Members</a>-->
                            <!--</p>-->
                            <!--<span class="duration">Posted 3 hrs ago</span>-->
                            <!--</div>-->
                            <!--<hr>-->
                        </div>
                    </div>
                    <div class="eight wide right floated column">
                        <div class="ui green loading segment" id="pro_segment" style="min-height: 320px">
                            <h4 class="ui header">Classified Business Directory <br> <small>20x More Visibility for your business</small></h4>

                            <!-- <hr> -->



                            <div class="ui very relaxed list" id="pro_list" style="height: 200px; overflow-y:auto;"></div>

                            <!--<p>Caterer</p>-->
                            <!--<p>Designers</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui inverted vertical footer segment" style="background-color: #072902;">
            <div class="ui container">
                <div class="ui stackable inverted divided equal height stackable center aligned grid">
                    <div class="three wide column">
                        <div class="ui inverted link list">
                            <a href="blog" class="item">Blog</a>
                            <a href="about" class="item">About Pro-Filr</a>
                            <a href="privacy" class="item">Privacy and Terms</a>
                        </div>
                    </div>
                    <div class="three wide column">
                        <div class="ui inverted link list">
                            <a href="agreement" class="item">Terms and Conditions</a>
                            <a href="copyright" class="item">Copyright Policy</a>
                            <a href="plans" class="item">Subscription Plans</a>
                        </div>
                    </div>
                    <div class="three wide column">
                        <div class="ui inverted link list">
                            <a href="forum" class="item">Forum Rules</a>
                            <a href="cookies" class="item">Cookies Policy</a>
                            <a href="contact" class="item">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include("partials/scripts.html"); ?>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".search_link").on("click", function() {
                var query = $("#search_input").val();
                if (query.length) {
                    $.redirect('search.php', {
                        'query': query
                    });
                }
            });
        });
    </script>
    <script type="text/javascript" src="assets/js/home.js"></script>

</body>

</html>