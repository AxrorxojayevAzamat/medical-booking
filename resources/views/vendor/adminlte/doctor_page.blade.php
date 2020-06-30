<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Find easily a doctor and book online an appointment">
    <meta name="author" content="Ansonika">
    <title>FINDOCTOR - Find easily a doctor and book online an appointment</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/vendors.css" rel="stylesheet">
    <link href="css/icon_fonts/css/all_icons_min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Modernizr -->
    <script src="js/modernizr.js"></script>

</head>

<body>

<div id="preloader" class="Fixed">
    <div data-loader="circle-side"></div>
</div>
<!-- /Preload-->

<div id="page">
    <header class="header_sticky">
        <a href="#menu" class="btn_mobile">
            <div class="hamburger hamburger--spin" id="hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <!-- /btn_mobile-->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div id="logo_home">
                        <h1>{{Auth::user()->role}}</h1>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <ul id="top_access">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        <li><a href="{{ url('admin') }}"><i class="pe-7s-user"></i></a></li>
                                    @elseif(Auth::user()->isPatient())
                                        <li><a href="{{ route('patient.profile') }}"><i class="pe-7s-user"></i></a></li>
                                    @elseif(Auth::user()->isDoctor())
                                        <li><a href="{{ route('doctor.profile') }}"><i class="pe-7s-user"></i></a></li>

                                    @endif
                                    {{-- <a href="{{ url('admin') }}">Dashboard</a> --}}
                                    {{-- <li><a href="{{ url('admin') }}"><i class="pe-7s-user"></i></a></li> --}}

                                @else
                                    {{-- <a href="{{ route('login') }}">Login</a> --}}
                                    <li><a href="{{ route('login') }}"><i class="pe-7s-user"></i></a></li>
                                    @if (Route::has('register'))
                                        {{-- <a href="{{ route('register' ) }}">Register</a> --}}
                                        <li><a href="{{ route('register') }}"><i class="pe-7s-add-user"></i></a></li>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </ul>
                    <nav id="menu" class="main-menu">
                        <ul>
                            <li>
                                <span><a href="#0">Home</a></span>
                                <ul>
                                    <li><a href="index.html">Home Default</a></li>
                                    <li><a href="index-2.html">Home Version 2</a></li>
                                    <li><a href="index-3.html">Home Version 3</a></li>
                                    <li><a href="index-4.html">Home Version 4</a></li>
                                    <li><a href="index-7.html">Home with Map</a></li>
                                    <li><a href="index-6.html">Revolution Slider</a></li>
                                    <li><a href="index-5.html">With Cookie Bar (EU law)</a></li>
                                </ul>
                            </li>
                            <li>
                                <span><a href="#0">Pages</a></span>
                                <ul>
                                    <li>
                                        <span><a href="#0">List pages</a></span>
                                        <ul>
                                            <li><a href="list.html">List page</a></li>
                                            <li><a href="grid-list.html">List grid page</a></li>
                                            <li><a href="list-map.html">List map page</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span><a href="#0">Detail pages</a></span>
                                        <ul>
                                            <li><a href="detail-page.html">Detail page</a></li>
                                            <li><a href="detail-page-2.html">Detail page 2</a></li>
                                            <li><a href="detail-page-3.html">Detail page 3</a></li>
                                            <li><a href="detail-page-working-booking.html">Detail working booking</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="submit-review.html">Submit Review</a></li>
                                    <li><a href="blog-1.html">Blog</a></li>
                                    <li><a href="badges.html">Badges</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="login-2.html">Login 2</a></li>
                                    <li><a href="register-doctor.html">Register Doctor</a></li>
                                    <li><a href="register-doctor-working.html">Working doctor register</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="contacts.html">Contacts</a></li>
                                </ul>
                            </li>
                            <li>
                                <span><a href="#0">Extra Elements</a></span>
                                <ul>
                                    <li><a href="booking-page.html">Booking page</a></li>
                                    <li><a href="confirm.html">Confirm page</a></li>
                                    <li><a href="faq.html">Faq page</a></li>
                                    <li><a href="coming_soon/index.html">Coming soon</a></li>
                                    <li>
                                        <span><a href="#0">Pricing tables</a></span>
                                        <ul>
                                            <li><a href="pricing-tables-3.html">Pricing tables 1</a></li>
                                            <li><a href="pricing-tables.html">Pricing tables 2</a></li>
                                            <li><a href="pricing-tables-2.html">Pricing tables 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="icon-pack-1.html">Icon pack 1</a></li>
                                    <li><a href="icon-pack-2.html">Icon pack 2</a></li>
                                    <li><a href="icon-pack-3.html">Icon pack 3</a></li>
                                    <li><a href="404.html">404 page</a></li>
                                </ul>
                            </li>
                            <li><span><a href="#0">Buy this template</a></span></li>
                        </ul>
                    </nav>
                    <!-- /main-menu -->
                </div>
            </div>
        </div>
        <!-- /container -->
    </header>
    <!-- /header -->

    <main>
        <div class="header-video">
            <div id="hero_video">
                <div class="content">
                    <h3>Find a Doctor!</h3>
                    <p>
                        Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
                    </p>
                    <form method="post" action="list.html">
                        <div id="custom-search-input">
                            <div class="input-group">
                                <input type="text" class=" search-query" placeholder="Ex. Name, Specialization ....">
                                <input type="submit" class="btn_search" value="Search">
                            </div>
                            <ul>
                                <li>
                                    <input type="radio" id="all" name="radio_search" value="all" checked>
                                    <label for="all">All</label>
                                </li>
                                <li>
                                    <input type="radio" id="doctor" name="radio_search" value="doctor">
                                    <label for="doctor">Doctor</label>
                                </li>
                                <li>
                                    <input type="radio" id="clinic" name="radio_search" value="clinic">
                                    <label for="clinic">Clinic</label>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <img src="img/video_fix.png" alt="" class="header-video--media" data-video-src="video/intro" data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="750">
        </div>
        <!-- /Header video -->

        <div class="container margin_120_95">
            <div class="main_title">
                <h2>Find by specialization</h2>
                <p>Nec graeci sadipscing disputationi ne, mea ea nonumes percipitur. Nonumy ponderum oporteat cu mel, pro movet cetero at.</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_1.svg" width="60" height="60" alt="">
                        <h3>Primary Care</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_2.svg" width="60" height="60" alt="">
                        <h3>Cardiology</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_3.svg" width="60" height="60" alt="">
                        <h3>MRI Resonance</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_4.svg" width="60" height="60" alt="">
                        <h3>Blood test</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_7.svg" width="60" height="60" alt="">
                        <h3>Laboratory</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_5.svg" width="60" height="60" alt="">
                        <h3>Dentistry</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_6.svg" width="60" height="60" alt="">
                        <h3>X - Ray</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#0" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="img/icon_cat_8.svg" width="60" height="60" alt="">
                        <h3>Piscologist</h3>
                        <ul class="clearfix">
                            <li><strong>124</strong>Doctors</li>
                            <li><strong>60</strong>Clinics</li>
                        </ul>
                    </a>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="bg_color_1">
            <div class="container margin_120_95">
                <div class="main_title">
                    <h2>Most Viewed doctors</h2>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri.</p>
                </div>
                <div id="reccomended" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="detail-page.html">
                            <div class="views"><i class="icon-eye-7"></i>140</div>
                            <div class="title">
                                <h4>Dr. Julia Holmes<em>Pediatrician - Cardiologist</em></h4>
                            </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="detail-page.html">
                            <div class="views"><i class="icon-eye-7"></i>120</div>
                            <div class="title">
                                <h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
                            </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="detail-page.html">
                            <div class="views"><i class="icon-eye-7"></i>115</div>
                            <div class="title">
                                <h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
                            </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="detail-page.html">
                            <div class="views"><i class="icon-eye-7"></i>98</div>
                            <div class="title">
                                <h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
                            </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="detail-page.html">
                            <div class="views"><i class="icon-eye-7"></i>98</div>
                            <div class="title">
                                <h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
                            </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
                        </a>
                    </div>
                </div>
                <!-- /carousel -->
            </div>
            <!-- /container -->
        </div>
        <!-- /white_bg -->

        <div class="container margin_120_95">
            <div class="main_title">
                <h2>Discover the <strong>online</strong> appointment!</h2>
                <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p>
            </div>
            <div class="row add_bottom_30">
                <div class="col-lg-4">
                    <div class="box_feat" id="icon_1">
                        <span></span>
                        <h3>Find a Doctor</h3>
                        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_feat" id="icon_2">
                        <span></span>
                        <h3>View profile</h3>
                        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_feat" id="icon_3">
                        <h3>Book a visit</h3>
                        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                    </div>
                </div>
            </div>
            <!-- /row -->
            <p class="text-center"><a href="list.html" class="btn_1 medium">Find Doctor</a></p>
        </div>
        <!-- /container -->

        <div id="app_section">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-md-5">
                        <p><img src="img/app_img.svg" alt="" class="img-fluid" width="500" height="433"></p>
                    </div>
                    <div class="col-md-6">
                        <small>Application</small>
                        <h3>Download <strong>Findoctor App</strong> Now!</h3>
                        <p class="lead">Tota omittantur necessitatibus mei ei. Quo paulo perfecto eu, errem percipit ponderum no eos. Has eu mazim sensibus. Ad nonumes dissentiunt qui, ei menandri electram eos. Nam iisque consequuntur cu.</p>
                        <div class="app_buttons wow" data-wow-offset="100">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
							<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow" d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1" />
                                <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58" />
                                <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9" />
						</svg>
                            <a href="#0" class="fadeIn"><img src="img/apple_app.png" alt="" width="150" height="50" data-retina="true"></a>
                            <a href="#0" class="fadeIn"><img src="img/google_play_app.png" alt="" width="150" height="50" data-retina="true"></a>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /app_section -->
    </main>
    <!-- /main content -->

    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <p>
                        <a href="index.html" title="Findoctor">
                            <img src="img/logo.png" data-retina="true" alt="" width="163" height="36" class="img-fluid">
                        </a>
                    </p>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5>About</h5>
                    <ul class="links">
                        <li><a href="#0">About us</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="#0">FAQ</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5>Useful links</h5>
                    <ul class="links">
                        <li><a href="#0">Doctors</a></li>
                        <li><a href="#0">Clinics</a></li>
                        <li><a href="#0">Specialization</a></li>
                        <li><a href="#0">Join as a Doctor</a></li>
                        <li><a href="#0">Download App</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5>Contact with Us</h5>
                    <ul class="contacts">
                        <li><a href="tel://61280932400"><i class="icon_mobile"></i> + 61 23 8093 3400</a></li>
                        <li><a href="mailto:info@findoctor.com"><i class="icon_mail_alt"></i> help@findoctor.com</a></li>
                    </ul>
                    <div class="follow_us">
                        <h5>Follow us</h5>
                        <ul>
                            <li><a href="#0"><i class="social_facebook"></i></a></li>
                            <li><a href="#0"><i class="social_twitter"></i></a></li>
                            <li><a href="#0"><i class="social_linkedin"></i></a></li>
                            <li><a href="#0"><i class="social_instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/row-->
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <ul id="additional_links">
                        <li><a href="#0">Terms and conditions</a></li>
                        <li><a href="#0">Privacy</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div id="copy">© 2017 Findoctor</div>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div>
<!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts.min.js"></script>
<script src="js/functions.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/video_header.js"></script>
<script>
    'use strict';
    HeaderVideo.init({
        container: $('.header-video'),
        header: $('.header-video--media'),
        videoTrigger: $("#video-trigger"),
        autoPlayVideo: true
    });
</script>

</body>

</html>