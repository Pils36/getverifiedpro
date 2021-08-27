@extends('layouts.app')

@section('title', 'About us')
    
@show

<style type="text/css" media="screen">
    .genbreadcrumb{
        height: 200px;
        width: 100%;
        background: url('http://canprevent.com/wp-content/uploads/2013/08/about-us-header.jpg');
        background-size: cover;
        background-repeat: no-repeat; 
    }
</style>
@section('content')
<!--WELCOME SLIDER AREA-->
<div class="welcome-slider-area white genbreadcrumb">
</div>
<!--WELCOME SLIDER AREA END-->
    
    <!--SERVICE TOP AREA-->
<section class="service-top-area" id="features">

    {{-- Project Team Building --}}

    <div class="container feature wow fadeIn" style="padding-bottom: 30px">
        <div class="service-area">
        <div class="project" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <article id="team" class="text-justify text-muted">
<br />
We are a Not-for-Profit project consulting and contracting firm operating globally from Toronto, Canada.
Our objective is to be the driving force for prompt project delivery irrespective of the nature and size using our unique project delivery model.
<br />
<br />
As a not-for-profit organisation, our focus is on the project success, delivery to time and costs. Our guarantee for project success is our ability to build optimal project team and also work with professionals that have successfully delivered similar projects.
As an organisation with global membership from different industries and specialisations, we have the required capability and credibility in addition to competency to deliver on any project.
<br />
<br />
Our operations are funded through donations, members’ subscriptions and grants from governments and governmental organisations/agencies.
<br />
<br />
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <b style="text-transform: uppercase;">Our Strategic Advantages</b>
            <ul style="list-style: decimal;">
                <li>Global Expertise</li>
                <li>Global Experience & Local Advantage</li>
                <li>Least costs Project Execution Model</li>
                <li>Quality Delivered</li>
                <li>Global Best Practices and Standards</li>
            </ul>            
        </div>
    </div>    
    <hr />
    <div class="row">       
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <b style="text-transform: uppercase;">Our Core Values (ICTQ)</b>
            <ul style="list-style: decimal;">
                <li>Integrity</li>
                <li>Credibility</li>
                <li>Transparency</li>
                <li>Quality</li>
            </ul>            
        </div>
    </div>
</div>
            </article>                
        </div>
</div>
    </div>

    </section>
    <!--SERVICE TOP AREA END-->

@endsection