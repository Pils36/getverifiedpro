    <!--FOOTER AREA-->
<script>
    function message(color, title, res){
        iziToast.show({
            icon: 'fa fa-info-circle',
            iconText: '',
            iconColor: color,
            iconUrl: null,
            drag: true,
            balloon: true,
            position: 'topCenter',
            color: color,
            title: title,
            message: res
        });
     }
</script>


    <div class="footer-area white">
            <div class="footer-top-area padding-100-50 foot">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="col-md-4" style="padding-bottom: 15px">
                                <div class="content-info">
                                    <article>
                                            Have you ever been involved in an organization or business that never seems to accomplish very much? 
                                            Regardless of how hard you work, you just go in circles. The problem may be that you have not decided where you want to go and have not created a roadmap of how to get there. 
                                    </article>
                                    <div class="foot-icon">
                                        <ul class="foot-bookmark">
                                            <li><a href="https://www.facebook.com/profilr2016/"><i class="fa fa-facebook-f text-primary"></i></a></li>
                                            <li><a href="https://twitter.com/pro_filr"><i class="fa fa-twitter" style="color: #39bde9"></i></a></li>
                                            {{-- <li><a href="#"><i class="fa fa-google-plus text-danger"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin" style="color: cornflowerblue"></i></a></li> --}}
                                        </ul>
                                    </div>
                                    <article>You can visit our media platform today, or subscribe to our channel. We are always available for clients.</article>
                                </div>
                            </div>
                            <div class="col-md-2 footy" style="padding-bottom: 15px">
                                <h4>Site map</h4>
                                    <ul class="foot-nav">
                                        <li>
                                            <a href="{{ url('/') }}">
                                                Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('service') }}">
                                                Service
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('about') }}">
                                                About us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('join') }}">
                                                Get Started
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('login') }}">
                                                Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('contact') }}">
                                                Contact us
                                            </a>
                                        </li>
                                        <li>
                                            <a data-izimodal-open="#modal" data-izimodal-transitionin="fadeInDown" data-iziModal-width="800" data-iziModal-top="120" data-iziModal-padding="30" role="button" type="button">Donate</a>
                                        </li>
                                    </ul>    
                            </div>

                            <div class="col-md-2 footy" style="padding-bottom: 15px">
                                <div class="content-info">
                                    <h4>Our Policies</h4>
                                    <ul class="foot-nav">
                                        <li>
                                            <a href="{{ url('render/copy') }}">Copyright Policy</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('render/cookie') }}">Cookie Policy</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('render/privacy') }}">Privacy and Terms</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('render/terms') }}">Terms of Use</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4 footy" style="padding-bottom: 15px">
                                <div class="content-info">
                                    <div class="content-form">
                                        <div class="row">
                                            {{-- E-mail Subscription --}}
                                            
                                            <form action="{{ url('subscribes') }}" method="POST" id="form">
                                                <div class="col-md-12">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                    {{-- <input name="_token" type="hidden" value="{{ csrf_token() }}"/> --}}
                                                    <input type="email" name="email" class="form-control{{ $errors->has('subscribe') ? ' is-invalid' : '' }} subscribe-input" id="subscribe" placeholder="E-mail subscription">
                                                    {{ csrf_field() }}
                                                    <button type="submit" id="btn" style="width: 100%" class="btn btn-success submit-btn" onclick="subscriber(event)">Subscribe now</button>
                                                </div>
                                            </form>

                                            <script>
                                               function subscriber(event){
                                                event.preventDefault();
                                                //
                                                    // $(document).ready(function(){
                                                        var form = document.getElementById('form');
                                                        var subscribe = $('#subscribe').val();
                                                        // console.log(subscribe);

                                                        jQuery.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                                            }
                                                        });

                                                        jQuery.ajax({
                                                            url: "{{ url('subscribes') }}",
                                                            method: "POST",
                                                            data: {
                                                                email : subscribe,
                                                            },
                                                            success: function(result){
                                                                console.log(result.res);
                                                                form.reset();
                                                                message(result.color, result.title, result.res);

                                                            
                                                            }
                                                        });
                                                   // });
                                               }                                                 
                                            </script>


                                        </div>
                                    </div>
                                    <article>By subscribing, we get to communicate with you on daily updates and feeds. Thanks for choosing Pro-EXECUTES.</article>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-area deep-dark-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="footer-copyright text-center wow fadeIn">
                                <p>
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Pro-EXECUTES</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </div>
    <!--FOOTER AREA END-->