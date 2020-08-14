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
@php( $password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'admin') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@php( $password_email_url = $password_email_url ? route($password_email_url) : '' )

@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@php( $password_email_url = $password_email_url ? url($password_email_url) : '' )
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif
@include('layouts.header')
@section('body')
<main>
    <div class="bg_color_2">

        <div class="container margin_60_35">
            <div id="login">
                <h1>{{ __('adminlte.send_password_reset_link') }}</h1>
                <div class="box_form pb-4">
                    <form method="POST" action="{{ $password_email_url}}" >
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('adminlte.email') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn_1 btn-primary">
                                    {{ __('adminlte.send_reset_link') }}
                                </button>
                            </div>
                        </div>                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('js')
@yield('js')
@stop

