<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{trans('extra_info.description')}}">
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
    <link href="{{asset('css/baguetteBox.min.css')}}" rel="stylesheet">

    @stack('css')
    @yield('css')
</head>

<body>

<div class="layer"></div>

{{-- <div id="preloader">
    <div data-loader="circle-side"></div>
</div> --}}

<header class="header_sticky" style='-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"'>
    <div class="container">
        <div class="row">

            <div class="col-lg-2 col-6">
                <div id="logo_home">
                    <h1><a href="/" title="Findoctor">Findoctor</a></h1>
                </div>
            </div>

            <nav class="col-lg-10 col-6">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                <ul id="top_access">
                    <div class="dropdown">
                        @if (Route::has('login'))
                        @auth
                            <button class="btn auth_btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php($user = Auth::user())
                                {{ $user && $user->profile ? $user->profile->first_name : $user->email }}
                            </button>
                            <div class="dropdown-menu auth_menu" aria-labelledby="dropdownMenuButton">
                                @if(Auth::user()->isAdmin())
                                <a class="dropdown-item auth_item" href="{{ url('admin') }}">{{trans('auth.profile')}}</a>
                                @elseif(Auth::user()->isPatient())
                                <a class="dropdown-item auth_item" href="{{ url('patient')  }}">{{trans('auth.profile')}}</a>
                                @elseif(Auth::user()->isDoctor())
                                <a class="dropdown-item auth_item" href="{{ url('doctor/profile')  }}">{{trans('auth.profile')}}</a>
                                @endif

                                {{-- <a class="dropdown-item auth_item"  href="{{ route('logout') }}" method="POST">{{trans('auth.log_out')}}</a> --}}

                                <a class="dropdown-item auth_item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{trans('auth.log_out')}}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </div>
                        @else

                            <button class="btn auth_btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans('auth.log_in')}} / {{trans('auth.sign_up')}}
                            </button>
                            <div class="dropdown-menu auth_menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item auth_item" href="{{ route('login') }}">{{trans('auth.log_in')}}</a>
                                <a class="dropdown-item auth_item" href="{{ route('register') }}">{{trans('auth.sign_up')}}</a>
                            </div>
                            @endauth
                        @endif
                        </div>

                          @if (Route::has('login'))
                        <div class="top-right links"  style="display: none">
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
                        <a href="#" class="show-submenu">{{trans('menu.service')}}<i class="icon-down-open-mini"></i></a>
                            <ul>
                                @foreach($serviceIds as $value => $label)
                                    <li><a href="{{ route('clinics.index') . '?service=' .  $value }}">{{ $label }}</a></li>
                                @endforeach
                                <li><a href="{{ route('clinics.index') }}">{{trans('home.more')}}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('contacts.contacts')}}">{{ trans('contacts.title') }}</a>
                        </li>
                        <li>
                            <a href="{{route('news.index')}}">{{ trans('breadcrumb_fe.news') }}</a>
                        </li>
                        <li class="submenu">
                            <a href="#" class="show-submenu">{{ trans('menu.language') }}<i class="icon-down-open-mini"></i></a>
                            <ul>
                                @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                           href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @if (Route::has('login'))
                        @auth
                                @if(Auth::user()->isAdmin())
                                <li class="submenu ext_auth">
                                    <a class="dropdown-item  auth-menu-item" href="{{ url('admin') }}">{{trans('auth.profile')}}</a>
                                </li>
                                @elseif(Auth::user()->isPatient())
                                <li class="submenu ext_auth">
                                    <a class="dropdown-item  auth-menu-item" href="{{ url('patient')  }}">{{trans('auth.profile')}}</a>
                                </li>
                                @elseif(Auth::user()->isDoctor())
                                <li class="submenu ext_auth">
                                    <a class="dropdown-item  auth-menu-item" href="{{ url('doctor/profile')  }}">{{trans('auth.profile')}}</a>
                                </li>
                                @endif

                                <li class="submenu ext_auth">
                                    <a class="dropdown-item  auth-menu-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{trans('auth.log_out')}}</a>
                                </li>
                        @else
                            <li class="submenu ext_auth">
                                <a class="dropdown-item  auth-menu-item" href="{{ route('login') }}">{{trans('auth.log_in')}}</a>
                            </li>
                            <li class="submenu ext_auth">
                                <a class="dropdown-item  auth-menu-item" href="{{ route('register') }}">{{trans('auth.sign_up')}}</a>
                            </li>

                            @endauth
                        @endif
                        <li class="float-right">
                            <a href="tel: 4411"><i class="icon_phone"></i> 4411</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<style>
    body {
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"!important;
    }
</style>