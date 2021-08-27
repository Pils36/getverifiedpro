<!--START TOP AREA-->
<header class="top-area" id="home">
        <div class="top-bar-area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="call-to-action">
                            <p><i class="fa fa-globe fa-spin"></i> <a href="http://www.pro-filr.com">Visit main site: <span id="js-rotating"><b>PRO-FILR<b>|<b style="font-size: 18px;">www.pro-filr.com</b></span></a></p>

                            {{-- I am a <span id="js-rotating">So Simple, Very Doge, Much Wow, Such Cool</span> Text Rotator --}}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="header-social-bookmark">
                            <ul class="social-bookmark">
                                <li><a href="https://www.facebook.com/profilr2016/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/pro_filr"><i class="fa fa-twitter"></i></a></li>
                               {{--  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-top-area">
            <!--MAINMENU AREA-->
            <div class="mainmenu-area" id="mainmenu-area">
                <div class="mainmenu-area-bg"></div>
                <nav class="navbar" style="border-radius: 0px;">
                    <div class="container-full">

                        <div class="navbar-header">
                            <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('img/pro_exec.png') }}" alt="logo"></a>
                        </div>
                        <div id="main-nav" class="stellarnav">
                            <ul id="nav" class="nav navbar-nav">
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">home</a></li>
                                <li class="{{ Request::is('service') ? 'active' : '' }}"><a href="{{ url('service') }}">services</a></li>
                                <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ url('about') }}">about us</a></li>
                                <li class="{{ Request::is('join') ? 'active' : '' }}"><a href="{{ url('join') }}">get started</a></li>
                                <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ url('login') }}">login</a></li>
                                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}">contact us</a></li>
                                <li class="{{ Request::is('donate') ? 'active' : '' }} donate"><a data-izimodal-open="#modal" data-izimodal-transitionin="fadeInDown" data-iziModal-width="800" data-iziModal-top="120" data-iziModal-padding="30" role="button" type="button"><span style="visibility: hidden;">donate</span></a></li>
                            </ul>
                        </div>

                    </div>
                </nav>
            </div>
            <!--END MAINMENU AREA END-->
        </div>
    </header>
    <!--END TOP AREA