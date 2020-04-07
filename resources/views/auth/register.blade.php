@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name_ru" class="col-md-4 col-form-label text-md-right">{{ __('Name_ru') }}</label>

                            <div class="col-md-6">
                                <input id="name_ru" type="text" class="form-control @error('name_ru') is-invalid @enderror" name="name_ru" value="{{ old('name_ru') }}" required autocomplete="name_ru" autofocus>

                                @error('name_ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name_uz" class="col-md-4 col-form-label text-md-right">{{ __('Name_uz') }}</label>

                            <div class="col-md-6">
                                <input id="name_uz" type="text" class="form-control @error('name_uz') is-invalid @enderror" name="name_uz" value="{{ old('name_uz') }}" required autocomplete="name_uz" autofocus>

                                @error('name_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname_ru" class="col-md-4 col-form-label text-md-right">{{ __('Lastname_ru') }}</label>

                            <div class="col-md-6">
                                <input id="lastname_ru" type="text" class="form-control @error('lastname_ru') is-invalid @enderror" name="lastname_ru" value="{{ old('lastname_ru') }}" required autocomplete="lastname_ru" autofocus>

                                @error('lastname_ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="lastname_uz" class="col-md-4 col-form-label text-md-right">{{ __('Lastname_uz') }}</label>

                            <div class="col-md-6">
                                <input id="lastname_uz" type="text" class="form-control @error('lastname_uz') is-invalid @enderror" name="lastname_uz" value="{{ old('lastname_uz') }}" required autocomplete="lastname_uz" autofocus>

                                @error('lastname_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patronymic_ru" class="col-md-4 col-form-label text-md-right">{{ __('Patronymic_ru') }}</label>

                            <div class="col-md-6">
                                <input id="patronymic_ru" type="text" class="form-control @error('patronymic_ru') is-invalid @enderror" name="patronymic_ru" value="{{ old('patronymic_ru') }}" required autocomplete="patronymic_ru" autofocus>

                                @error('patronymic_ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="patronymic_uz" class="col-md-4 col-form-label text-md-right">{{ __('Patronymic_uz') }}</label>

                            <div class="col-md-6">
                                <input id="patronymic_uz" type="text" class="form-control @error('patronymic_uz') is-invalid @enderror" name="patronymic_uz" value="{{ old('patronymic_uz') }}" required autocomplete="patronymic_uz" autofocus>

                                @error('patronymic_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus>

                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <input id="gender" type="number" class="form-control @error('gender') is-invalid @enderror" min="0" max="1" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection