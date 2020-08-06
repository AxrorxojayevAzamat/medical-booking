@extends('layouts.app')
@section('breadcrumbs', null)

{{-- @section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop --}}

{{-- @section('adminlte_css')
@stack('css')
@yield('css')
@stop --}}

{{-- @section('classes_body', 'login-page') --}}

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
{{-- @include('layouts.header') --}}

@section('content')
        <div class="bg_color_2">

            <div class="container margin_60_35">
                <div id="login">
                <h1>{{trans('auth.please_to_findoctor')}}</h1>
                    <div class="box_form">
                        <form  action="{{ route('login')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ trans('adminlte.email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ trans('adminlte.password') }}">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            {{-- <a href="{{ route('password/reset')}}" class="d-block text-center">{{ trans('adminlte.i_forgot_my_password') }}</a> --}}
                            <div class="form-group text-center add_top_20 d-flex justify-content-center">
                                <input class="btn_1 medium" type="submit" value="{{ trans('adminlte.sign_in') }}">
                            </div>
                        </form>
                    </div>
                    <p class="text-center link_bright"><a href="{{ route('register') }}">
                            {{ trans('adminlte.register_a_new_membership') }}
                        </a></p>
                </div>
                <!-- /login -->
            </div>
        </div>
@stop

{{-- @section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('js')
@yield('js')
@stop --}}
