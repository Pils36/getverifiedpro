<?php include("../views/head.html"); ?>
<body class="Site">
<div class="ui grid container Site-content" style="width: 90% !important;">
	<?php include("../views/home_nav.html"); ?>
    <!-- content row -->

    <div class="row" id="content_row" style="margin-bottom:200px;">
        <div class="sixteen wide column">
            <div class="ui  vertical segment">
                <spcontent>
                    <home>

                        <div class="row">
                            <div class="ui vertical stripe quote segment" style="">
                                <div class="ui equal width stackable  grid">
                                    <div class="center aligned four wide column"><img src="../images/where.png"/></div>
                                    <div class="ui twelve wide column"></div>


                                </div>

                            </div>

                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="ui grid">
                                <div class="ui four wide column"></div>
                                <div class="ui eight wide column vertical segment" id="search_bar">

                                    <div class="ui fluid icon input">
                                        <input placeholder="Search Professionals, Specialisations in Cities, Countries and much more..."
                                               type="text" name="search_input" id="search_input">
                                        <i class="circular search link icon search_link"></i>
                                    </div>
                                </div>
                                <div class="ui four wide column"></div>
                            </div>

                        </div>


                        <div class="row" style="margin-top: 20px; ">
                            <div class="ui vertical stripe quote segment" style="">
                                <div class="ui equal width stackable  grid">
                                    <div class="ui four wide column"></div>
                                    <div class="center aligned eight wide column"><img src="../images/connect.png"/>
                                    </div>
                                    <div class="ui four wide column"></div>


                                </div>

                            </div>

                        </div>

                    </home>
                </spcontent>

            </div>
        </div>
    </div>
    <!-- content row ends-->

</div>
<footer>
	<?php include("../views/footer.html"); ?>
</footer>
<?php include("../views/scripts.html"); ?>
</body>