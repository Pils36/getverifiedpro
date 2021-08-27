@extends('layouts.app')

@section('title', 'Home')
    
@show

@section('content')
    <!--WELCOME SLIDER AREA-->
    <div class="welcome-slider-area white">
            <div class="welcome-single-slide">
                <div class="slide-bg-one slide-bg-overlay"></div>
                <div class="welcome-area">
                    <div class="container">
                        <div class="row flex-v-center">
                            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                <div class="welcome-text">
                                    {{-- <h4>We are</h4> --}}
                                    <h1><span style="text-transform: capitalize;">WELCOME</span></h1>
                                    <span>
                                        <h1><span style="text-transform: capitalize; color: #30b2fd; font-weight: bold;">Pro</span>-<span style="color: #ff0000;border-bottom: 6px solid #30b2fd;">Executes</span></h1>
                                    <p style="text-transform: uppercase; text-decoration: blink;">
                                        Your professional leads and collaboration solution center
                                    </p>
                                    </span>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="welcome-single-slide">
                <div class="slide-bg-two slide-bg-overlay"></div>
                <div class="welcome-area">
                    <div class="container">
                        <div class="row flex-v-center">
                            <div class="col-md-7 col-lg-6 col-sm-12 col-xs-12">
                                <div class="welcome-text">
                                    {{-- <h4>We are</h4> --}}
                                    <h1><span style="text-transform: uppercase; color: #30b2fd; font-weight: bold;">Compe</span><span style="text-transform: uppercase; color: #ff0000; font-weight: bold;border-bottom: 6px solid #30b2fd;">tency</span></h1>
                                    <p>"Success demands a high level of logistical and organizational competence."
                                    <br /> ― George S. Patton</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="welcome-single-slide">
                <div class="slide-bg-three slide-bg-overlay"></div>
                <div class="welcome-area">
                    <div class="container">
                        <div class="row flex-v-center">
                            <div class="col-md-7 col-lg-6 col-sm-12 col-xs-12">
                                <div class="welcome-text">
                                    <h1><span style="text-transform: uppercase; color: #30b2fd; font-weight: bold;">Cred</span><span style="text-transform: uppercase; color: #ff0000; font-weight: bold; border-bottom: 6px solid #30b2fd;">ibility</span></h1>
                                    <p>"All credibility, all good conscience, all evidence of truth come only from the senses." 
                                        <br /> ― Friedrich Nietzsche</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="welcome-single-slide">
                    <div class="slide-bg-four slide-bg-overlay"></div>
                    <div class="welcome-area">
                        <div class="container">
                            <div class="row flex-v-center">
                                <div class="col-md-7 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="welcome-text">
                                        {{-- <h4>We are</h4> --}}
                                        <h1><span style="text-transform: uppercase; color: #30b2fd; font-weight: bold;">Capa</span><span style="text-transform: uppercase; color: #ff0000; font-weight: bold; border-bottom: 6px solid #30b2fd;">bility</span></h1>
                                        <p>“Life shouldn't be about the either/or. We're capable of more than that, you know?” 
<br /> ― Sarah Dessen, Along for the Ride</p>
                                        {{-- <div class="home-button">
                                            <a href="{{ url('join') }}">JOIN US</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!--WELCOME SLIDER AREA END-->
        
        <!--SERVICE TOP AREA-->
    <section class="service-top-area padding-100-50" id="features">
            <div class="container">
                    <div class="center">
                        <h2>HOW <span style="text-transform: capitalize;">Pro</span>-Executes WORKS</h2> 
                    </div><hr>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="single-service text-center wow fadeIn">
                            <div class="service-icon">
                                <div> 1 </div>
                                
                            </div>
                            <h3>Join Us</h3>
                            <p>You can become part of our collaboration system with ease. So you can trust we are with you all the way up</p>
                            {{-- <a href="#" class="read-more">Join us now</a> --}}
                            <img src="http://www.pngall.com/wp-content/uploads/2016/04/Join-Now-PNG-Clipart.png" alt="" class="img img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="single-service text-center wow fadeIn">
                            <div class="service-icon">
                                <div> 2 </div>
                                
                            </div>
                            <h3>Receive Leads</h3>
                            <p>Gain and turn your leads to clients with little or no effort at all. You find it easy here.</p>
                            {{-- <a href="#" class="read-more">Learn More</a> --}}
                            <img src="https://img.icons8.com/cotton/2x/receive-cash.png" alt="" class="img img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="single-service text-center wow fadeIn">
                            <div class="service-icon">
                                <div> 3 </div>
                                
                            </div>
                            <h3>Collaborate</h3>
                            <p>Connect and link up with your colleagues and clients in one rich tool. One for all your needs.</p>
                            {{-- <a href="#" class="read-more">Learn More</a> --}}
                            <img src="https://pngimage.net/wp-content/uploads/2018/05/collaborate-png-8.png" alt="" class="img img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--SERVICE TOP AREA END-->

        <!--ABOUT THE 3C's AREA-->
    <section class="about-area padding-100-50" id="about" style="padding-bottom: 0px; background: #f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="about-content mb50 wow fadeIn">
                            
                            <img src="https://www.hubshare.com/wp-content/uploads/2017/12/visual-easily-collaborate.png" alt="" class="img img-responsive">
{{--                             <p class="high-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <a href="#" class="read-more">Learn More</a> --}}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="waraper skills-member wow fadeInLeft mb50">
                            <br />
                            <br />
                            <h2>We are <span style="text-transform: capitalize;">Pro</span>-Executes</h2>
                            <br />
                            <div class="skillst5">
                                <div class="skillbar" data-percent="95%">
                                    <div class="title">Competency</div>
                                    <div class="count-bar color-1">
                                        <div class="count"></div>
                                    </div>
                                </div>
                                <div class="skillbar" data-percent="91%">
                                    <div class="title">Credibitlity</div>
                                    <div class="count-bar color-2">
                                        <div class="count"></div>
                                    </div>
                                </div>
                                <div class="skillbar" data-percent="98%">
                                    <div class="title">Capability</div>
                                    <div class="count-bar color-3">
                                        <div class="count"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--ABOUT AREA END-->


{{-- SERVICE RENDER PAGE --}}


<section class="wow fadeIn" id="services" style="padding-top: 20px">
      <div class="container top-services">
        <div class="row">
          <div class="col-lg-12 text-left">
            <h2 class="section-heading">Peep into Our Services</h2>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-md-3 servicebox wow fadeIn" style="background: #415483; border-radius: 10px; padding: 10px; background-repeat: no-repeat; background-position: bottom;">
                <ul class="service_list">
                    <li>Project Team Building</li>
                    <li>Project Consulting & Management</li>
                    <li>Project Contracting / Execution</li>
                </ul>
            </div>          
            <div class="col-md-9 wow fadeIn">
                <div class="servicecontent">
                    <div class="row services">
                      <div class="col-md-4 text-center wow fadeIn">
                        <div class="service-box mt-5 mx-auto">
                          <img src="{{ url("https://www.davidkennethgroup.com/-/media/images/24-rich-text/teaminteractiondiagramhandsplanningrichtext99809203.ashx?h=878&la=en&w=1440&hash=EC3575ADBEFABACF02A9F93CFC7F75F8C417FEEB") }}" class="img img-responsive team pics" alt="team" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.6s cubic-bezier(0.5, 0, 0, 1) 0.6s, transform 0.6s cubic-bezier(0.5, 0, 0, 1) 0.6s;">
                          <hr>
                          <h3 class="mb-3">Team <br> Building</h3>
                          <p class="text-muted mb-0">The project team at Pro-EXECUTES are carefully selected professionals that share the same purpose/goal...</p>
                          <hr>
                          <p><a href="{{ url('service?c=team') }}" class="btn btn-primary" style="background-color: #971a1a !important; border: 1px solid #971a1a">Read more</a></p>
                        </div>
                      </div>

                      <div class="col-md-4 text-center wow fadeIn">
                        <div class="service-box mt-5 mx-auto">
                            <img src="{{ url("https://kertus.in/wp-content/uploads/2017/10/consulting.jpg") }}" class="img img-responsive consult pics" alt="consulting" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.6s cubic-bezier(0.5, 0, 0, 1) 0.6s, transform 0.6s cubic-bezier(0.5, 0, 0, 1) 0.6s;">
                            <hr>
                          <h3 class="mb-3">Consulting & Management</h3>
                          <p class="text-muted mb-0">Pro-EXECUTES is excited to present a revolutionary approach to Project Management....</p>
                          <hr>
                          <p><a href="{{ url('service?c=consult') }}" class="btn btn-info">Read more</a></p>
                        </div>
                      </div>
                      <div class="col-md-4 text-center wow fadeIn">
                        <div class="service-box mt-5 mx-auto">
                            <img src="{{ url("https://blog.luz.vc/wp-content/uploads/2015/08/Consultoria-Financeira-Relat%C3%B3rio-financeiro.jpg") }}" class="img img-responsive contract pics" alt="contract" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.6s cubic-bezier(0.5, 0, 0, 1) 0.6s, transform 0.6s cubic-bezier(0.5, 0, 0, 1) 0.6s;">
                            <hr>
                          <h3 class="mb-3">Contracting / Execution</h3>
                          <p class="text-muted mb-0">We have an outstanding reputation for successfully delivering projects on time, on budget.....</p>
                          <hr>
                          <p><a href="{{ url('service?c=contract') }}" class="btn btn-danger">Read more</a></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

    </section>



@endsection