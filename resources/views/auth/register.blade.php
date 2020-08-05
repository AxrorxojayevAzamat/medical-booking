@extends('adminlte::master')

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', 'register-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'admin') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif
@include('layouts.header')
@section('body')
    <main>
        <div class="bg_color_2">
            <div class="container margin_10_35">
                <div id="register">
                    <h1>{{trans('auth.please_to_findoctor')}}</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <form action="{{ $register_url }}" method="post">
                                {{ csrf_field() }}
                                <div class="box_form">
                                    <div class="form-group">
                                        <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name') }}" placeholder="{{ __('Имя') }}" autofocus>
                                        @if ($errors->has('first_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}" placeholder="{{ __('Фамилия') }}" autofocus>

                                        @if ($errors->has('last_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="middle_name" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" value="{{ old('middle_name') }}" placeholder="{{ __('Отчество') }}" autofocus>

                                        @if ($errors->has('middle_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('middle_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" data-inputmask="&quot;mask&quot;: &quot;999999999&quot;" data-mask value="{{ old('phone') }}" placeholder="{{ __('Телефон') }}" autofocus>

                                        @if ($errors->has('phone'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="birth_date" class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" value="{{ old('birth_date') }}" placeholder="{{ __('Дата рождения') }}" autofocus>
                                        @if ($errors->has('birth_date'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <!--<input type="number" name="gender" min="0" max="1" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" value="{{ old('gender') }}" placeholder="{{ __('Пол') }}" autofocus>-->
                                        <select id="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                            <option value="" selected="">{{ trans('filter.sex') }}</option>>
                                            <option value="0" @if (old('gender') == '0') selected="selected" @endif>{{ trans('filter.female') }}</option>>
                                            <option value="1"@if (old('gender') == '1') selected="selected" @endif>{{ trans('filter.male') }}</option>>
                                        </select>

                                        @if ($errors->has('gender'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ trans('auth.address_email') }}">

                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email_confirmation" class="form-control {{ $errors->has('email_confirmation') ? 'is-invalid' : '' }}" value="{{ old('email_confirmation') }}" placeholder="{{ trans('auth.confirm_address_email') }}">
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{trans('adminlte.password') }}">

                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ trans('adminlte.retype_password') }}">

                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group text-center add_top_24">
                                        <button type="submit" class="btn_1 btn-primary medium"> {{ trans('adminlte.register') }} </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /register -->
            </div>
        </div>
    </main>
    <!-- /main -->
    @stop

    @section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
    @stop
