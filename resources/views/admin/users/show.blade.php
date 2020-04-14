@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Показать пользователя') }}</div>

        <div class="card-body">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

            <div class="col-md-6">
              <input id="name" type="text" readonly class="form-control" name="name" value="{{$user->name}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

            <div class="col-md-6">
              <input id="lastname" type="text" readonly class="form-control" name="lastname" value="{{$user->lastname}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="patronymic" class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

            <div class="col-md-6">
              <input id="patronymic" type="text" readonly class="form-control" name="patronymic" value="{{$user->patronymic}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>

            <div class="col-md-6">
              <input id="phone" type="text" readonly class="form-control" name="phone" value="{{$user->phone}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

            <div class="col-md-6">
              <input id="birth_date" type="text" readonly class="form-control" name="phone" value="{{$user->phone}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Пол') }}</label>

            <div class="col-md-6">
              <input id="gender" type="text" readonly class="form-control" name="phone" value="{{$user->phone}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Адрес электронной почты') }}</label>

            <div class="col-md-6">
              <input id="email" type="email" readonly class="form-control" name="email" value="{{$user->email}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль пользователя') }}</label>

            <div class="col-md-6">
              @foreach($user->roles()->pluck('name') as $role)
              <input id="role" type="text" readonly class="form-control" name="role" value="{{$role}}">
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection