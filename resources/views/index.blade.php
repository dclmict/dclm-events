<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- The above 3 meta tags *must* come first in the head -->

    <!-- SITE TITLE -->
    <title>Events || @if($program) {{ ($program->name) }}@endif</title>
    <meta name="description" content="Event Registration for DCLM Programs"/>
    <meta name="keywords" content="Event,  Conference, Registration, Kumuyi, GCK, Event @if($program)| {{ strtoupper($program->name) }}@endif"/>
    <meta name="author" content="dclm.org"/>

    <!-- twitter card starts from here, if you don't need remove this section -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@pastorwf_kumuyi"/>
    <meta name="twitter:creator" content="@pastorwf_kumuyi"/>
    <meta name="twitter:url" content="https://events.dclm.org/"/>
    <meta name="twitter:title" content="@if($program)| {{ strtoupper($program->name) }}@endif"/>
    <!-- maximum 140 char -->
    <meta name="twitter:description" content="Registration of participant for @if($program)| {{ strtoupper($program->name) }}@endif"/>
    <!-- maximum 140 char -->
    <meta name="twitter:image" content="assets/img/twittercardimg/twittercard-280-150.jpg"/>
    <!-- when you post this page url in twitter , this image will be shown -->
    <!-- twitter card ends from here -->

    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="@if($program)| {{ strtoupper($program->name) }}@endif"/>
    <meta property="og:url" content="https://events.dclm.org"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="DCLM Events Registration Form"/>
    <!--meta property="fb:admins" content="" /-->  <!-- use this if you have  -->
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="assets/img/opengraph/fbphoto.jpg"/>
    <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends from here -->

    <!--  FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon/dclm.png"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/dclm.png"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="apple-touch-icon" href="assets/img/favicon/dclm.png">
    <link rel="icon" type="image/png" href="assets/img/favicon/dclm.png">
    
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="assets/libs/fontawesome/css/font-awesome.min.css" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="assets/libs/maginificpopup/magnific-popup.css" media="all"/>

    <!-- Time Circle -->
    <link rel="stylesheet" href="assets/libs/timer/TimeCircles.css" media="all"/>

    <!-- OWL CAROUSEL CSS -->
    <link rel="stylesheet" href="assets/libs/owlcarousel/owl.carousel.min.css" media="all" />
    <link rel="stylesheet" href="assets/libs/owlcarousel/owl.theme.default.min.css" media="all" />

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald:400,700%7cRaleway:300,400,400i,500,600,700,900"/>

    <!-- MASTER  STYLESHEET  -->
    <link id="lgx-master-style" rel="stylesheet" href="assets/css/style-default.min.css" media="all"/>

    <!-- MODERNIZER CSS  -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="home">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="lgx-container lgx-box-layout">
<!-- ***  ADD YOUR SITE CONTENT HERE *** -->

<!--HEADER-->
<header>
    <div id="lgx-header" class="lgx-header">
        <div class="lgx-header-position">
            <div class="lgx-container-fluid">
                <nav class="navbar navbar-default lgx-navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> 
                    <div id="navbar" class="navbar-collapse collapse">
                        <div class="lgx-nav-right navbar-right">
                            <div class="lgx-cart-area">
                                <a class="lgx-btn lgx-btn-red" href="#registration-form">Register Now</a>
                            </div>
                        </div>
                        <ul class="nav navbar-nav lgx-nav navbar-right">
                            <li>
                                <a class="lgx-scroll" href="/">Home </a>
                            </li>
                            <li>
                                <a class="lgx-scroll" href="personalizedflyer/">Personalyzed Flyer</a>
                            </li>
                            <li>
                                <a class="lgx-scroll" href="#lgx-news">Testimonies</a>
                            </li>
                            <li>
                                <a class="lgx-scroll" href="login">Login</a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </nav>
            </div>
            <!-- //.CONTAINER -->
        </div>
    </div>
</header>
<!--HEADER END-->


<!--BANNER-->
<section>
    <div @if($program) style="background: url({{ asset('storage/'.$program->image_location) }}) top center no-repeat !important; -webkit-background-size: contain !important; -o-background-size: contain !important; -moz-background-size: contain !important; background-size: contain !important;" @endif class="lgx-banner lgx-banner16">
        <div class="lgx-banner-style">
            <div class="lgx-inner lgx-inner-fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-banner-info"> <!--lgx-banner-info-center lgx-banner-info-black lgx-banner-info-big lgx-banner-info-bg--> <!--banner-info-margin-->
                                <h2 class="title"> </h2>
                                <h3 class="location"></h3>
                                <div class="action-area">
                                    <div class="lgx-video-area">
                                        <p class="video-area"><a id="myModalLabel" class="icon" href="#" data-toggle="modal" data-target="#lgx-modal">

                                        <!-- </a> Watch Promo Video</p><h3 class="subtitle">You can learn anything</h3> -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//.ROW-->
                </div>
                <!-- //.CONTAINER -->
            </div>
            <!-- //.INNER -->
        </div>
    </div>
</section>
<!--BANNER END-->

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '663155374846887');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=663155374846887&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!--countdown-->
<section>
    <div class="lgx-countdown">
        <div class="lgx-inner-countdown">
            <div class="countdown-left-info">
                <h2 class="title">Global Workers Conference
                    {{-- GCK: November Edition --}}
                    {{-- Global Workers Conference --}}
                </h2>
                <h3 class="subtitle">Triumphing Ministry Even In Troublous Times</h3>
                <p class="date">November 17 - 20th, 2022.</p>
            </div>
            <div class="countdown-right">
                <div class="lgx-countdown-area lgx-countdown-simple">
                    <!-- Date Format :"Y/m/d" || For Example: 1017/10/5  -->
                    <div id="lgx-countdown" data-date="2022/11/17"></div>
                </div>
            </div>
        </div><!-- //.INNER -->
    </div>
</section>
<!--countdown END-->

{{-- @include("layouts.form") --}}


<!--SCHEDULE
<section>
    <div id="lgx-schedule" class="lgx-schedule lgx-schedule-white">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h2 class="heading">Event Schedule</h2>
                            <!- <h3 class="subheading">Welcome to the dedicated to building remarkable Schedule!</h3> -
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-tab lgx-tab-vertical">
                            <ul class="nav nav-pills lgx-nav lgx-nav-nogap lgx-nav-colorful">
                                <li class="active"><a data-toggle="pill" href="#home"><h3>First <span>Day</span></h3> <p><span>24 </span>May, 2022</p></a></li>
                                <li><h3>Second <span>Day</span></h3> <p><span>25 </span>May, 2022</p></a></li>
                                <li><a data-toggle="pill" href="#"><h3>Third <span>Day</span></h3> <p><span>26 </span>May, 2022</p></a></li>
                                <li><a data-toggle="pill" href="#"><h3>Fourth <span>Day</span></h3> <p><span>27 </span>May, 2022</p></a></li>
                                <li><a data-toggle="pill" href="#"><h3>Fifth <span>Day</span></h3> <p><span>28 </span>May, 2022</p></a></li>
                                <li><a data-toggle="pill" href="#"><h3>Final <span>Day</span></h3> <p><span>29 </span>May, 2022</p></a></li>
                            </ul>
                            <div class="tab-content lgx-tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <div class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="lgx-single-schedule">
                                                            <div class="schedule-info">
                                                                <h4 class="time">1600 <span>GMT</span> </h4>
                                                                <h3 class="title">Day One</h3>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <div class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                        <div class="lgx-single-schedule">
                                                           
                                                            <div class="schedule-info">
                                                                <h4 class="time">1600 <span>GMT</span> </h4>
                                                                <h3 class="title">Day Two</h3>
                                                               
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <div class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                        <div class="lgx-single-schedule">
                                                            <div class="schedule-info">
                                                                <h4 class="time">1600 <span>GMT</span> </h4>
                                                                <h3 class="title">Day Three</h3>
                                                                
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingfour">
                                                <div class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                                        <div class="lgx-single-schedule">
                                                            
                                                            <div class="schedule-info">
                                                            <h4 class="time">700 AND 1600 <span>GMT</span></h4>
                                                                <h3 class="title">Day Four</h3>
                                                                
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingfive">
                                                <div class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                                        <div class="lgx-single-schedule">
                                                            
                                                            <div class="schedule-info">
                                                                <h4 class="time">1600 <span>GMT</span> </h4>
                                                                <h3 class="title">Day Five</h3>
                                                               
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingfour">
                                                <div class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                                        <div class="lgx-single-schedule">
                                                            
                                                            <div class="schedule-info">
                                                                <h4 class="time">1600 <span>GMT</span></h4>
                                                                <h3 class="title">Final Day</h3>
                                                                
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <-//.ROW-
                <!-<div class="section-btn-area schedule-btn-area">
                    <a class="lgx-btn lgx-btn-big" href="speakers.html"><span>Download Schedule (PDF)</span></a>
                    <a class="lgx-btn lgx-btn-red lgx-btn-big" href="speakers.html"><span>Connect via facebook</span></a>
                </div>-
            </div>
            <!- //.CONTAINER -
        </div>
        <!- //.INNER -
    </div>
</section> -->
<!--SCHEDULE END-->


    <!--News-->
    <section>
        <div id="lgx-news" class="lgx-news">
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading">
                                <h2 class="heading">Remarkable Testimonies</h2>
                                <!-- <h3 class="subheading">Conferences dedicated to building remarkable events.</h3> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="lgx-single-news">
                                <figure>
                                    <a href="#"><img src="assets/img/news/news1.jpg" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>June 25, 2021</span>
                                        <span>by <a href="#">Bro David Oladipo</a></span>
                                    </div>
                                    <h3 class="title"><a href="#">Prostrate Enlargment Healed</a></h3>
                                    <!-- <a class="lgx-btn lgx-btn-white lgx-btn-sm" href="testimony1.html"><span>Read More</span></a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="lgx-single-news">
                                <figure>
                                    <a href="#"><img src="assets/img/news/news3.jpg" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>June 26, 2021</span>
                                        <span>by <a href="#">OJOMA SHARON MERCY</a></span>

                                    </div>
                                    <h3 class="title"><a href="#">HOW GOD SAVED ME FROM THE HANDS OF KIDNAPPERS</a></h3>
                                    <!-- <a class="lgx-btn lgx-btn-white lgx-btn-sm" href="testimony2.html"><span>Read More</span></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- //.CONTAINER -->
            </div><!-- //.INNER -->
        </div>
    </section>
    <!--News END-->

    <!--FOOTER-->
    <footer>
        <div id="lgx-footer" class="lgx-footer lgx-footer-black"> <!--lgx-footer-white-->
            <div class="lgx-inner-footer">
                <!--<div class="lgx-subscriber-area"> 
                    <div class="container">
                        <div class="lgx-subscriber-inner"> 
                            <h3 class="subscriber-title">Join Newsletter</h3>
                            <form class="lgx-subscribe-form" >
                                <div class="form-group form-group-email">
                                    <input type="email" id="subscribe" placeholder="Enter your email Address  ..." class="form-control lgx-input-form form-control"  />
                                </div>
                                <div class="form-group form-group-submit">
                                    <button type="submit" name="lgx-submit" id="lgx-submit" class="lgx-btn lgx-submit"><span>Subscribe</span></button>
                                </div>
                            </form> <-//.SUBSCRIBE-
                        </div>
                    </div>
                </div> -->
                <div class="container">
                    <div class="lgx-footer-area lgx-footer-area-center">
                        <div class="lgx-footer-single">
                            <h3 class="footer-title">Social Connection</h3>
                            <p class="text">
                                You should connect social area <br> for Any update
                            </p>
                            <ul class="list-inline lgx-social-footer">
                                <li><a href="https://www.facebook.com/pastorkumuyiofficial/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.twitter.com/pastorkumuyiofficial/"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/pastorkumuyiofficial/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.youtube.com/pastorkumuyiofficial/"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="lgx-footer-single">
                            <h3 class="footer-title">Venue Location </h3>
                            <h4 class="date">
                                DeeperLife Headquarters
                            </h4>
                            <address>
                                2 – 10 Ayodele Oke-Owo Street, Gbagada, Lagos, Nigeria.
                            </address>
                            <a id="myModalLabel2" data-toggle="modal" data-target="#lgx-modal-map" class="map-link" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> View Map location</a>
                        </div>
                        <!-- <div class="lgx-footer-single">
                            <h2 class="footer-title">Instagram Feed</h2>
                            <div id="instafeed">
                            </div>
                        </div> -->
                    </div>
                    <!-- Modal-->
                    <div id="lgx-modal-map" class="modal fade lgx-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="lgxmapcanvas map-canvas-default" id="map_canvas"> </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- //.Modal-->

                    <div class="lgx-footer-bottom">
                        <div class="lgx-copyright">
                            <p> <span>©</span> 2022 Worldwide Crusade is powered by <a href="#">Deeper Life Bible Church</a> </p>
                        </div>
                    </div>

                </div>
                <!-- //.CONTAINER -->
            </div>
            <!-- //.footer Middle -->
        </div>
    </footer>
    <!--FOOTER END-->
</div>
<!--//.LGX SITE CONTAINER-->
<!-- *** ADD YOUR SITE SCRIPT HERE *** -->
<!-- JQUERY  -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

<!-- BOOTSTRAP JS  -->
<script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>

<!-- Smooth Scroll  -->
<script src="assets/libs/jquery.smooth-scroll.js"></script>

<!-- SKILLS SCRIPT  -->
<script src="assets/libs/jquery.validate.js"></script>

<!-- if load google maps then load this api, change api key as it may expire for limit cross as this is provided with any theme 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIKbFTvAyZuB8CuFqSIEVEHmbqfDm6UD8"></script>-->

<!-- CUSTOM GOOGLE MAP
<script type="text/javascript" src="assets/libs/gmap/jquery.googlemap.js"></script> -->

<!-- adding magnific popup js library -->
<script type="text/javascript" src="assets/libs/maginificpopup/jquery.magnific-popup.min.js"></script>

<!-- Owl Carousel  -->
<script src="assets/libs/owlcarousel/owl.carousel.min.js"></script>

<!-- COUNTDOWN   -->
<script src="assets/libs/countdown.js"></script>
<script src="assets/libs/timer/TimeCircles.js"></script>

<!-- Counter JS -->
<script src="assets/libs/waypoints.min.js"></script>
<script src="assets/libs/counterup/jquery.counterup.min.js"></script>

<!-- SMOTH SCROLL -->
<script src="assets/libs/jquery.smooth-scroll.min.js"></script>
<script src="assets/libs/jquery.easing.min.js"></script>

<!-- type js -->
<script src="assets/libs/typed/typed.min.js"></script>

<!-- header parallax js -->
<script src="assets/libs/header-parallax.js"></script>

<!-- instafeed js -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>-->
<script src="assets/libs/instafeed.min.js"></script>

<!-- CUSTOM SCRIPT  -->
<script src="assets/js/custom.script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

<script src="{{ asset('scripts/form.js') }}"></script>

<!-- <div class="lgx-switcher-loader"></div> -->
<!-- For Demo Purpose Only// Remove From Live --
<script src="switcher/js/switcherd41d.js?"></script>
For Demo Purpose Only //Remove From Live-->


</body>

<!-- Mirrored from themearth.com/demo/html/emeet/view/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Jul 2021 15:08:47 GMT -->
</html>
