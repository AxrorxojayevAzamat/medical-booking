@extends('adminlte::master')

@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', 'login-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'admin') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )

@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif
@include('layouts.header')
@section('body')
    <main>
        <div class="bg_color_2">

            <div class="container margin_60_35">
                <div id="login">
                    <h1>Please login to Findoctor!</h1>
                    <div class="box_form">
                        <form  action="{{ $login_url}}" method="post">
                            {{ csrf_field() }}
                            <a href="#0" class="social_bt facebook">Login with Facebook</a>
                            <a href="#0" class="social_bt google">Login with Google</a>
                            <a href="#0" class="social_bt linkedin">Login with Linkedin</a>
                            <div class="divider"><span>Or</span></div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <a href="{{ $password_reset_url}}">{{ __('adminlte::adminlte.i_forgot_my_password') }}</a>
                            <div class="form-group text-center add_top_20">
                                <input class="btn_1 medium" type="submit" value="{{ __('adminlte::adminlte.sign_in') }}">
                            </div>
                        </form>
                    </div>
                    <p class="text-center link_bright"><a href="{{ $register_url }}">
                            {{ __('adminlte::adminlte.register_a_new_membership') }}
                        </a></p>
                </div>
                <!-- /login -->
            </div>
        </div>
    </main>
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('js')
@yield('js')
@stop
