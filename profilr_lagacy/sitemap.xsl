<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:sm="http://www.sitemaps.org/schemas/sitemap/0.9"

                version="2.0">

    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>XML Sitemap</title>
                <meta name="description" content=""/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <meta name="mobile-web-app-capable" content="yes"/>
                <meta charset="utf-8"/>
                <meta http-equiv="cache-control" content="max-age=0"/>
                <meta http-equiv="cache-control" content="no-cache"/>
                <meta http-equiv="expires" content="0"/>
                <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
                <meta http-equiv="pragma" content="no-cache"/>


                <link rel="stylesheet" type="text/css" href="lib/semantic/semantic.css"></link>
                <link rel="stylesheet" type="text/css" href="css/style.css"></link>
                <script type="text/javascript" src="lib/jquery-3.1.1.js"></script>

            </head>

            <body class="Site">
                <div class="ui grid container Site-content" style="width: 90% !important;">
                    <div class="row" id="nav_row">

                        <div class="ui fixed inverted menu navbar" style="background-color: #40474a !important">
                            <div class="header item">
                                <img class="ui  image" src="images/prologo.png"/>
                            </div>


                        </div>


                    </div>
                    <!-- content row -->

                    <div class="row" id="content_row">
                        <div class="ui two wide column"></div>
                        <div class="ui twelve wide column">
                            <div class="ui  vertical segment">

                                <spcontent>
                                    <h2>Sitemap</h2>

                                    <ul>
                                        <xsl:for-each select="sm:urlset/sm:url/sm:loc">
                                            <li class="{@level}">
                                                <a href="{.}">
                                                    <xsl:value-of select="@title"/>
                                                </a>
                                            </li>
                                        </xsl:for-each>
                                    </ul>

                                </spcontent>

                            </div>
                        </div>
                        <div class="ui two wide column"></div>
                    </div>
                    <!-- content row ends-->

                </div>
                <div class="ui inverted vertical footer segment" style="background-color: #40474a !important">
                    <div class="ui center aligned container">
                        <div class="ui stackable inverted divided equal height stackable grid">
                            <div class="four wide column">
                                <h4 class="ui inverted header"></h4>
                                <div class="ui inverted link list">
                                    <a href="pages/about.php" class="item nav_link" data-page="index" data-view="about">
                                        About Pro-Filr
                                    </a>
                                    <a href="pages/agreement.php" class="item nav_link" data-page="index"
                                       data-view="agreement">User Agreement
                                    </a>


                                </div>
                            </div>
                            <div class="four wide column">
                                <h4 class="ui inverted header"></h4>
                                <div class="ui inverted link list">

                                    <a href="pages/privacy.php" class="item nav_link" data-page="index"
                                       data-view="privacy">Privacy &amp; Terms
                                    </a>

                                    <!-- <a href="relations.php" class="item nav_link" data-page="index" data-view="relations">Public Relations</a> -->
                                    <a href="pages/copyright.php" class="item nav_link" data-page="index"
                                       data-view="copyright">Copyright Policy
                                    </a>
                                </div>
                            </div>
                            <div class="four wide column">
                                <h4 class="ui inverted header"></h4>
                                <div class="ui inverted link list">
                                    <!-- <a href="advertise.php" class="item nav_link" data-page="index" data-view="advertise">Advertise with us</a> -->
                                    <!-- <a href="post.php" class="item nav_link" data-page="index" data-view="post">Post Opportunities</a> -->
                                    <a href="pages/upgrade.php" class="item nav_link" data-page="index"
                                       data-view="upgrade">Upgrade to Classic, Get Profiled
                                    </a>
                                    <a href="pages/forum.php" class="item nav_link" data-page="index" data-view="forum">
                                        Forum Rules
                                    </a>
                                    <!-- <a href="caq.php" class="item nav_link" data-page="index" data-view="caq">Commonly Asked Questions</a> -->
                                    <!-- <a href="adchoices.php" class="item nav_link" data-page="index" data-view="adchoices">Adchoices</a> -->
                                </div>
                            </div>
                            <div class="four wide column">
                                <h4 class="ui inverted header"></h4>
                                <div class="ui inverted link list">
                                    <a href="pages/cookies.php" class="item nav_link" data-page="index"
                                       data-view="cookies">Cookies Policy
                                    </a>
                                    <!-- <a href="help.php" class="item nav_link" data-page="index" data-view="help">Help &amp; Feedback</a> -->
                                    <a href="pages/contact.php" class="item nav_link" data-page="index"
                                       data-view="contact">Contact Us
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="ui inverted section divider"></div>
                        <div class="ui horizontal inverted small divided link list">
                            <a class="item" href="#" target="_blank">Site Map</a>
                            <a class="item" href="https://www.facebook.com/profilr2016/" target="_blank">Facebook</a>
                            <a class="item" href="https://twitter.com/pro_filr" target="_blank">Twitter</a>

                        </div>
                    </div>
                </div>
                <!-- <script type="text/javascript">

                myApp.onReady();

              </script> -->
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>