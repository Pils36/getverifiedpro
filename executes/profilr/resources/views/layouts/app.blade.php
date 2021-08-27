<html lang="{{ app()->getLocale() }}" id="home">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pro-Filr') }} | @yield('title')</title>

    {{-- Link icon --}}
    <link rel="shortcut icon" href="{{ asset('img/pro_exec.png') }}" type="image/x-icon">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--====== STYLESHEETS ======-->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stellarnav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />



    <!--====== MAIN STYLESHEETS ======-->
    <link href="{{ asset('design.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/spin.css') }}">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.css">
    <link rel="stylesheet" href="{{ asset('load_indicator/src/css/preloader.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    

    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<body data-spy="scroll" data-target=".mainmenu-area" data-offset="90" onload="trigger()">
    <div id="app">
        @include('inc.navbar')
        <!--- PRELOADER -->
        <div class="preeloader">
            <div class="preloader-spinner"></div>
        </div>
    
        <!--SCROLL TO TOP-->
        <a href="#home" class="scrolltotop"><i class="fa fa-long-arrow-up"></i></a>

            {{-- Donate modal --}}
            <div id="modal" class="modal box-modal">
                
                <div class="modal-box">
                    <div class="row">

                        <div class="col-md-12 img">
                            <p>As a not-for-profit organisation, our focus is on the project success, delivery to time and costs. Our guarantee for project success is our ability to build optimal project team and also work with professionals that have successfully delivered similar projects. 
                                <br><br>
                                As an organisation with global membership from different industries and specialisations, we have the required capability and credibility in addition to competency to deliver on any project. 
                                <br><br>
                                Our operations are funded through donations, members’ subscriptions and access grants from governments and governmental organisations/agencies. 
                                <br><br>
                                Support US. <img src="https://www.rawshorts.com/freeicons/wp-content/uploads/2017/01/orange_spacepict12_1484336631.png" style="width: 50px; height: 50px">
                            </p>
                        </div>
                    </div>
                    
                    <p style="text-align: center;">
                    <button>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick" />
                            <input type="hidden" name="hosted_button_id" value="C82P7AHK7QEQ6" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                            <img alt="" border="0" src="https://www.wpblog.com/wp-content/uploads/2017/08/image1-2.png" width="1" height="1" class="img img-responsive" />
                        </form>
                        <!-- <img src="https://mightywriters.org/wp-content/uploads/2016/12/button-PayPal-donate.png"> -->
                    </button>
                     </p>
                </div>    

                
            </div>

        @yield('content')
        @include('inc.footer')
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!--====== SCRIPTS JS ======-->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>

    <!--====== PLUGINS JS ======-->
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="{{ asset('js/spin.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.appear.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/stellar.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/stellarnav.min.js') }}"></script>
    <script src="{{ asset('js/contact-form.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.min.js"></script>
    <script src="{{ asset('load_indicator/src/js/jquery.preloader.js') }}"></script>
    

    <!--===== ACTIVE JS=====-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTS_KEDfHXYBslFTI_qPJIybDP3eceE-A&sensor=false"></script>
    <script src="{{ asset('js/maps.active.js') }}"></script>
<!-- izi -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha256-321PxS+POvbvWcIVoRZeRmf32q7fTFQJ21bXwTNWREY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js" integrity="sha256-vVnwgKyq3pIb4XdL91l1EC8j7URqDRK8BAWvSnKX0U8=" crossorigin="anonymous"></script>
<script>

$(function(){
           $(".modal").iziModal({
                width: 800,
                top: 120,
                padding: 30,
                title: 'Pro-EXECUTES',
                subtitle: 'Competency, Credibility, Capability',
                headerColor: '#38a965',
            });
                   servicePage();
            
        });

        $(".scrolltotop").on('click', function(){
            scroll('home');
        });

        // IziPop up
        function popUp(){
            $(".modal").iziModal('open', {
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeInLeft',
            });
        }

        function interval(){
            setInterval(func);
        }
   
        // On load 
        function trigger(){
            morphText();
            setTimeout(function(){
                popUp();
            }, 10000);
        };


function morphText(){
    $("#js-rotating").Morphext({
        // The [in] animation type. Refer to Animate.css for a list of available animations.
        animation: "lightSpeedIn",
        // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
        separator: "|",
        // The delay between the changing of each phrase in milliseconds.
        speed: 7000,
        complete: function () {
            // Called after the entrance animation is executed.
        }
    });
}

        // Service Redirect
        function servicePage(){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var c = url.searchParams.get("c");
            //scroll
            scroll(c);
        }

        function scroll(loc){
            $('html, body').animate({
                scrollTop: $("#"+loc).offset().top,
            }, 2000);    
        }

function goscroll(next, currentNowprev){
    if(next != "null"){
        //Ajax Action
        post(currentNowprev, next);
    }
}

function proceed(currentNowprev, next){
    //Scroll
    scroll(next);

    //Remove background Ash
    $("#"+next+" > div").removeClass('bg-ash');

    //Enable State Fields
    $("."+next+"_field").each(function(i, obj) {
        //loop through each class and activate field
        $(this).prop('disabled', false);
    });     

    $("."+next+"_myloader").hide();

    // Replace loader
    $("."+currentNowprev+"_myloader").show();

    $("."+currentNowprev+"_field").each(function(i, obj) {
        //loop through each class and deactivate field
        // Replace loader
        $(this).prop('disabled', true);
        $("."+currentNowprev+"_def").addClass('bg-ash');
    });

    $("."+next+"_myloader").toggleClass('load-complete');
    $("."+currentNowprev+"_checkmark.draw").each(function(i, obj){
        $(this).css("display", "block");
    }); 
}

//Ajax Receive and Set Data
 function post(val, next){
    event.preventDefault();
    //Source
    if(val == "corporate-top"){
        var route = "{{ route('AjaxCorporate') }}";
        var thisdata = {
            execid: $("#"+val+"_id").val(),
            first_name: $("#"+val+"_first_name").val(),
            last_name: $("#"+val+"_last_name").val(),
            profession: $("#"+val+"_profession").val(),
            email: $("#"+val+"_email").val(),
            city: $("#"+val+"_city").val(),
            industry: $("#"+val+"_industry").val(),
            country: $("#"+val+"_country").val(),
            terms: $("#"+val+"_terms").val(),
      }
    }   
    else if(val == "account-top"){
        var route = "{{ route('AjaxUser') }}";
        var thisdata = {
            execid: $("#corporate-top_id").val(),
            first_name: $("#"+val+"_first_name").val(),
            last_name: $("#"+val+"_last_name").val(),
            email: $("#"+val+"_email").val(),
            username: $("#"+val+"_username").val(),
            password: $("#"+val+"_password").val()
      }
    }
    postData(thisdata, route, val, next);
 }

 //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });
 }     

 //Parse data
 function postData(thisdata, route, currentNowprev, next){
    setHeaders();
    jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        success: function(result){
            console.log(result);

            //izi MessageEvent
            message(result.color, result.title, result.res)

            //Trigger Action
            if(result.res && (result.state != "0")){
               //Proceed
               proceed(currentNowprev, next);
             }

        }});

    //Reset Forms
    // $("#"+form).reset();
 }

 //Output MessageEvent
 function message(color, title, msg){
    iziToast.show({
        icon: 'fa fa-info-circle',
        iconText: '',
        iconColor: color,
        iconUrl: null,
        drag: true,
        balloon: false,
        position: 'bottomLeft',
        color: color,
        title: title,
        message: msg
    });
 }


function download(area){
    event.preventDefault();

    //Set Placeholders
    $("#company").html($("#corporate-top_profession").val());
    $("#companyname").html($("#corporate-top_first_name").val()+" "+$("#corporate-top_last_name").val());
    $("#address").html($("#corporate-top_city").val()+", "+$("#corporate-top_country").val());

    //Remove no prints
    $(".noprint").hide();

    var prtContent = document.getElementById(area);
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();

    //Return Items During Print
    setTimeout(function(){ 
        $(".noprint").show(); 
        //unSet Placeholders
        $("#company").html("");
        $("#companyname").html("");
        $("#address").html("");
    }, 100);

    //Scroll
    proceed('agreement-top', 'account-top');
}
</script>
</body>
</html>


