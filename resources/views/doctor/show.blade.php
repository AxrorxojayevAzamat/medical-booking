@extends('layouts.app')

@section('content')

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
                    <div id="logo">
                        <a href="index.html" title="Findoctor"><img src="img/logo.png" data-retina="true" alt="" width="163" height="36"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <ul id="top_access">
                        <li><a href="login.html"><i class="pe-7s-user"></i></a></li>
                        <li><a href="register-doctor.html"><i class="pe-7s-add-user"></i></a></li>
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
        <div id="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="container margin_60">
            <div class="row">
                <aside class="col-xl-3 col-lg-4" id="sidebar">
                    <div class="box_profile">
                        <figure>
                            <img src="http://via.placeholder.com/565x565.jpg" alt="" class="img-fluid">
                        </figure>
                        <small>Primary care - Internist</small>
                        <h1>DR. Julia Jhones</h1>
                        <span class="rating">
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star"></i>
                            <small>(145)</small>
                            <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                        </span>
                        <ul class="statistic">
                            <li>854 Views</li>
                            <li>124 Patients</li>
                        </ul>
                        <ul class="contacts">
                            <li><h6>Address</h6>859 60th, Brooklyn, NY, 11220</li>
                            <li><h6>Phone</h6><a href="tel://000434323342">+00043 4323342</a></li>
                        </ul>
                        <div class="text-center"><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" class="btn_1 outline" target="_blank"><i class="icon_pin"></i> View on map</a></div>
                    </div>
                </aside>
                <!-- /asdide -->

                <div class="col-xl-9 col-lg-8">

                    <div class="box_general_2 add_bottom_45">
                        <div class="main_title_4">
                            <h3><i class="icon_circle-slelected"></i>Select your date and time</h3>
                        </div>

                        <div class="row add_bottom_45">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div id="calendar"></div>
                                    <input type="hidden" id="my_hidden_input">
                                    <ul class="legend">
                                        <li><strong></strong>Available</li>
                                        <li><strong></strong>Not available</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <ul class="time_select version_2 add_top_20">
                                    <li>
                                        <input type="radio" id="radio1" name="radio_time" value="09.30am">
                                        <label for="radio1">09.30am</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio2" name="radio_time" value="10.00am">
                                        <label for="radio2">10.00am</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio3" name="radio_time" value="10.30am">
                                        <label for="radio3">10.30am</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio4" name="radio_time" value="11.00am">
                                        <label for="radio4">11.00am</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio5" name="radio_time" value="11.30am">
                                        <label for="radio5">11.30am</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio6" name="radio_time" value="12.00am">
                                        <label for="radio6">12.00am</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio7" name="radio_time" value="01.30pm">
                                        <label for="radio7">01.30pm</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio8" name="radio_time" value="02.00pm">
                                        <label for="radio8">02.00pm</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio9" name="radio_time" value="02.30pm">
                                        <label for="radio9">02.30pm</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio10" name="radio_time" value="03.00pm">
                                        <label for="radio10">03.00pm</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio11" name="radio_time" value="03.30pm">
                                        <label for="radio11">03.30pm</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="radio12" name="radio_time" value="04.00pm">
                                        <label for="radio12">04.00pm</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /row -->

                        <div class="main_title_4">
                            <h3><i class="icon_circle-slelected"></i>Select visit - treatment</h3>
                        </div>
                        <ul class="treatments clearfix">
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit1" name="visit1">
                                    <label for="visit1" class="css-label">Back Pain visit <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit2" name="visit2">
                                    <label for="visit2" class="css-label">Cardiovascular screen <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit3" name="visit3">
                                    <label for="visit3" class="css-label">Diabetes consultation <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit4" name="visit4">
                                    <label for="visit4" class="css-label">Icontinence visit <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit5" name="visit5">
                                    <label for="visit5" class="css-label">Foot Pain visit <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit6" name="visit6">
                                    <label for="visit6" class="css-label">Food intollerance visit <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit7" name="visit7">
                                    <label for="visit7" class="css-label">Neck Pain visit <strong>$55</strong></label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" class="css-checkbox" id="visit8" name="visit8">
                                    <label for="visit8" class="css-label">Back Pain visit <strong>$55</strong></label>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <div class="text-center"><a href="booking-page.html" class="btn_1 medium">Book Now</a></div>
                    </div>
                    <!-- /box_general -->

                    <div class="tabs_styled_2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">General info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">Reviews</a>
                            </li>
                        </ul>
                        <!--/nav-tabs -->

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                                <p class="lead add_bottom_30">Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                <div class="indent_title_in">
                                    <i class="pe-7s-user"></i>
                                    <h3>Professional statement</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi.</p>
                                    <h6>Specializations</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="bullets">
                                                <li>Abdominal Radiology</li>
                                                <li>Addiction Psychiatry</li>
                                                <li>Adolescent Medicine</li>
                                                <li>Cardiothoracic Radiology </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="bullets">
                                                <li>Abdominal Radiology</li>
                                                <li>Addiction Psychiatry</li>
                                                <li>Adolescent Medicine</li>
                                                <li>Cardiothoracic Radiology </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /row-->
                                </div>
                                <!-- /wrapper indent -->

                                <hr>

                                <div class="indent_title_in">
                                    <i class="pe-7s-news-paper"></i>
                                    <h3>Education</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi.</p>
                                    <h6>Curriculum</h6>
                                    <ul class="list_edu">
                                        <li><strong>New York Medical College</strong> - Doctor of Medicine</li>
                                        <li><strong>Montefiore Medical Center</strong> - Residency in Internal Medicine</li>
                                        <li><strong>New York Medical College</strong> - Master Internal Medicine</li>
                                    </ul>
                                </div>
                                <!--  End wrapper indent -->

                                <hr>

                                <div class="indent_title_in">
                                    <i class="pe-7s-cash"></i>
                                    <h3>Prices &amp; Payments</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>Zril causae ancillae sit ea. Dicam veritus mediocritatem sea ex, nec id agam eius. Te pri facete latine salutandi, scripta mediocrem et sed, cum ne mundi vulputate. Ne his sint graeco detraxit, posse exerci volutpat has in.</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Service - Visit</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>New patient visit</td>
                                                    <td>$34</td>
                                                </tr>
                                                <tr>
                                                    <td>General consultation</td>
                                                    <td>$60</td>
                                                </tr>
                                                <tr>
                                                    <td>Back Pain</td>
                                                    <td>$40</td>
                                                </tr>
                                                <tr>
                                                    <td>Diabetes Consultation</td>
                                                    <td>$55</td>
                                                </tr>
                                                <tr>
                                                    <td>Eating disorder</td>
                                                    <td>$60</td>
                                                </tr>
                                                <tr>
                                                    <td>Foot Pain</td>
                                                    <td>$35</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  End wrapper_indent -->

                            </div>
                            <!-- /tab_2 -->

                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="reviews-container">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div id="review_summary">
                                                <strong>4.7</strong>
                                                <div class="rating">
                                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                                </div>
                                                <small>Based on 4 reviews</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                        </div>
                                    </div>
                                    <!-- /row -->

                                    <hr>

                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                Admin – April 03, 2016:
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->

                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                Ahsan – April 01, 2016
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->

                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                Sara – March 31, 2016
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->
                                </div>
                                <!-- End review-container -->
                                <hr>
                                <div class="text-right"><a href="submit-review.html" class="btn_1 add_bottom_15">Submit review</a></div>
                            </div>
                            <!-- /tab_3 -->
                        </div>
                        <!-- /tab-content -->
                    </div>
                    <!-- /tabs_styled -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->         
</div>
@endsection
