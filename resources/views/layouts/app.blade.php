<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Find easily a doctor and book online an appointment">
    <meta name="author" content="Ansonika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Medical Booking</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/menu.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendors.css')}}" rel="stylesheet">
    <link href="{{asset('css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">

    <link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('css/date_picker.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    @stack('css')
    @yield('css')
</head>

<body>

<div class="layer"></div>

<div id="preloader">
    <div data-loader="circle-side"></div>
</div>

<header class="header_sticky">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-6">
                <div id="logo_home">
                    <h1><a href="/" title="Findoctor">Findoctor</a></h1>
                </div>
            </div>

            <nav class="col-lg-9 col-6">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                <ul id="top_access">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <li><a href="{{ url('admin') }}"><i class="pe-7s-user"></i></a></li>
                                @elseif(Auth::user()->isPatient())
                                    <li><a href="{{ url('patient')  }}"><i class="pe-7s-user"></i></a></li>
                                @elseif(Auth::user()->isDoctor())
                                    <li><a href="{{ url('doctor/profile')  }}"><i class="pe-7s-user"></i></a></li>


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

                <div class="main-menu">
                    <ul>
                        <li class="submenu">
                            <a href="{{ route('doctors.index') }}" class="show-submenu">{{ trans('menu.doctors') }}</a>
                        </li>
                        <li class="submenu">
                            <a href="{{ route('clinics.index') }}" class="show-submenu">{{ trans('menu.clinics') }}</a>
                        </li>
                        <li>
                            <a href="{{route('specializations')}}">{{ trans('menu.specialization') }}</a>
                        </li>
                        <li class="submenu">
                            @php($name = 'name_' . \App\Helpers\LanguageHelper::getCurrentLanguagePrefix())
                            @php($serviceIds = \App\Entity\Clinic\Service::orderBy($name)->limit(10)->pluck($name, 'id'))
                            <a href="#" class="show-submenu">Сервисы<i class="icon-down-open-mini"></i></a>
                            <ul>
                                @foreach($serviceIds as $value => $label)
                                    <li><a href="{{ route('clinics.index') . '?service=' .  $value }}">{{ $label }}</a></li>
                                @endforeach
                                <li><a href="{{ route('clinics.index') }}">Больше</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('contacts.contacts')}}">{{ trans('contacts.title') }}</a>
                        </li>
                        <li>
                            <a href="{{route('news.index')}}">Новости</a>
                        </li>
                        <li class="submenu">
                            <a href="#" class="show-submenu">{{ trans('menu.language') }}<i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="/locale/uz">Uz</a></li>
                                <li><a href="/locale/ru">Ру</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>

<div id="page">
    <main>
        @section('breadcrumbs', Breadcrumbs::render())
        @yield('breadcrumbs')
        @yield('content')
    </main>
</div>

<footer>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <p>
                    <a href="/" title="Findoctor">
                        <img src="/img/logo.png" data-retina="true" alt="" width="163" height="36" class="img-fluid">
                    </a>
                </p>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Компани</h5>
                <ul class="links">
                    <li><a href="#0">О нас</a></li>
                    <li><a href="blog.html">Блог</a></li>
                    <li><a href="#0">ЧАВО</a></li>
                    @if (Auth::guest())
                        <li><a href="/login">Войти</a></li>
                        <li><a href="/register">Регистрироваться</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Полезные ссылки</h5>
                <ul class="links">
                    <li><a href="{{ route('doctors.index') }}">Докторы</a></li>
                    <li><a href="{{ route('clinics.index') }}">Клиники</a></li>
                    <li><a href="#0">Специализации</a></li>
                    <li><a href="#0">Присоедиться как Доктор</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Свяжитесь с нами</h5>
                <ul class="contacts">
                    <li><a href="tel://61280932400"><i class="icon_mobile"></i> + 61 23 8093 3400</a></li>
                    <li><a href="mailto:info@findoctor.com"><i class="icon_mail_alt"></i> help@findoctor.com</a></li>
                </ul>
                <div class="follow_us">
                    <h5>Подписывайтесь</h5>
                    <ul>
                        <li><a href="#0"><i class="social_facebook"></i></a></li>
                        <li><a href="#0"><i class="social_twitter"></i></a></li>
                        <li><a href="#0"><i class="social_linkedin"></i></a></li>
                        <li><a href="#0"><i class="social_instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-8">
                <ul id="additional_links">
                    <li><a href="#0">Правила и условия</a></li>
                    <li><a href="#0">Конфиденциальность</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <div id="copy">© 2020 Findoctor</div>
            </div>
        </div>
    </div>
</footer>

<div id="toTop"></div>

<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('js/common_scripts.min.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendor/select2/js/select2.min.js')}}"></script>
{{-- <script src="{{asset('js/payme.js')}}"></script> --}}

<script src="{{asset('http://maps.googleapis.com/maps/api/js')}}"></script>
<script src="{{asset('js/markerclusterer.js')}}"></script>
{{-- <script src="{{asset('js/map_listing.js')}}"></script> --}}
<script src="{{asset('js/map.js')}}"></script>
<script src="{{asset('js/infobox.js')}}"></script>
@stack('scripts')
@yield('scripts')

</body>

</html>
