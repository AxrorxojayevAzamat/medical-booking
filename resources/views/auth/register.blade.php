@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
<<<<<<< HEAD
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">{{ __('adminlte::adminlte.register_message') }}</p>
                <form action="{{ $register_url }}" method="post">
                    {{ csrf_field() }}

                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                               placeholder="{{ __('Имя') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="lastname" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" value="{{ old('lastname') }}"
                               placeholder="{{ __('Фамилия') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('lastname'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="patronymic" class="form-control {{ $errors->has('patronymic') ? 'is-invalid' : '' }}" value="{{ old('patronymic') }}"
                               placeholder="{{ __('Отчество') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('patronymic'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('patronymic') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}"
                               placeholder="{{ __('Телефон') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="date" name="birth_date" class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" value="{{ old('birth_date') }}"
                               placeholder="{{ __('Дата рождения') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('birth_date'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="gender" min="0" max="1" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" value="{{ old('gender') }}"
                               placeholder="{{ __('Пол') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('gender'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                               placeholder="{{ __('Адрес электронной почты') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="{{ __('Пароль') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                               placeholder="{{ __('Подтвердите пароль') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ __('adminlte::adminlte.register') }}
                    </button>
                </form>
                <p class="mt-2 mb-1">
                    <a href="{{ $login_url }}">
                        {{ __('adminlte::adminlte.i_already_have_a_membership') }}
                    </a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.register-box -->
        @stop
=======
<div class="register-box">
    <div class="register-logo">
        <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">{{ __('Зарегистрировать нового пользователя') }}</p>
            <form action="{{ $register_url }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{ __('Имя') }}" autofocus>

                    @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" value="{{ old('lastname') }}" placeholder="{{ __('Фамилия') }}" autofocus>

                    @if ($errors->has('lastname'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="patronymic" class="form-control {{ $errors->has('patronymic') ? 'is-invalid' : '' }}" value="{{ old('patronymic') }}" placeholder="{{ __('Отчество') }}" autofocus>

                    @if ($errors->has('patronymic'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('patronymic') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask value="{{ old('phone') }}" placeholder="{{ __('Телефон') }}" autofocus>

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
                        <option value="" selected="">{{ __('Пол') }}</option>>
                        <option value="0">Женский</option>>
                        <option value="1">Мужской</option>>
                    </select>

                    @if ($errors->has('gender'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </div>
                    @endif 
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Адрес электронной почты') }}">

                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="email" name="email_confirmation" class="form-control {{ $errors->has('email_confirmation') ? 'is-invalid' : '' }}" value="{{ old('email_confirmation') }}" placeholder="{{ __('Подтвердите адрес электронной почты') }}">
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Пароль') }}">

                    @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('Подтвердите пароль') }}">

                    @if ($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ __('Зарегистрироваться') }} </button>
            </form>
            <p class="mt-2 mb-1">
                <a href="{{ $login_url }}"> {{ __('У меня уже есть пользователь') }}  </a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
    @stop
>>>>>>> 313b2d78cc24a4b639c9c9159b2d61ccd88db5bc

        @section('adminlte_js')
            <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
