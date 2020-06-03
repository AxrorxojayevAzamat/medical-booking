<!doctype html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Find easily a doctor and book online an appointment">
	<meta name="author" content="Ansonika">
	<title>Medical Booking</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
    
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    
	<!-- BASE CSS -->
	<link href="{{('css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{('css/style.css')}}" rel="stylesheet">
	<link href="{{('css/menu.css')}}" rel="stylesheet">
	<link href="{{('css/vendors.css')}}" rel="stylesheet">
	<link href="{{('css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
    
	<!-- YOUR CUSTOM CSS -->
	<link href="{{('css/custom.css')}}" rel="stylesheet">

</head>   

<body>

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
    
	<header class="header_sticky">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-6">
					<div id="logo_home">
						<h1><a href="index.html" title="Findoctor">Findoctor</a></h1>
					</div>
				</div>
				<nav class="col-lg-9 col-6">
					<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
					<ul id="top_access">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
								{{-- <a href="{{ url('admin') }}">Dashboard</a> --}}
								{{-- <li><a href="{{ url('admin') }}"><i class="pe-7s-user"></i></a></li> --}}
								<li><a href="{{ url('admin') }}"><i class="pe-7s-user"></i></a></li>
                            @else
                                {{-- <a href="{{ route('login', app()->getLocale() ) }}">Login</a> --}}
                                <li><a href="{{ route('login', app()->getLocale() ) }}"><i class="pe-7s-user"></i></a></li>
                                @if (Route::has('register'))
                                    {{-- <a href="{{ route('register', app()->getLocale() ) }}">Register</a> --}}
                                    <li><a href="{{ route('register', app()->getLocale() ) }}"><i class="pe-7s-add-user"></i></a></li>
                                @endif
                            @endauth
                        </div>
                    @endif
					</ul>
					<div class="main-menu">
						<ul>
							<li class="submenu">
								<a href="#0" class="show-submenu">Home<i class="icon-down-open-mini"></i></a>
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
							<li class="submenu">
								<a href="#0" class="show-submenu">Pages<i class="icon-down-open-mini"></i></a>
								<ul>
									<li class="third-level"><a href="#0">List pages</a>
										<ul>
                                            <li><a href="list.html">List page</a></li>
											<li><a href="grid-list.html">List grid page</a></li>
											<li><a href="list-map.html">List map page</a></li>
                                        </ul>
									</li>
									<li class="third-level"><a href="#0">Detail pages</a>
										<ul>
                                            <li><a href="detail-page.html">Detail page 1</a></li>
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
							<li class="submenu">
								<a href="#0" class="show-submenu">Extra Elements<i class="icon-down-open-mini"></i></a>
								<ul>
                                    <li><a href="booking-page.html">Booking page</a></li>
                                    <li><a href="confirm.html">Confirm page</a></li>
                                	<li><a href="faq.html">Faq page</a></li>
                                    <li><a href="coming_soon/index.html">Coming soon</a></li>
									<li class="third-level"><a href="#0">Pricing tables</a>
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
						</ul>
					</div>
					<!-- /main-menu -->
				</nav>
			</div>
		</div>
		<!-- /container -->
	</header>

	<!-- /header --> 

    