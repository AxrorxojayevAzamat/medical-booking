
@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.users.create") }}">
          Add Users
        </a>
    </div>
</div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Имя</td>
          <td>Фамилия</td>
          <td>Отчество</td>
          <td>Телефон</td>
          <td>Дата рождения</td>
          <td>Пол</td>
          <td>Адрес электронной почты</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->lastname}}</td>
            <td>{{$user->patronymic}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->birth_date}}</td>
            <td>{{$user->gender}}</td>
            <td>{{$user->email}}</td>
            <td><a href="{{ route('admin.users.edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('admin.users.show',$user->id)}}" class="btn btn-success">Show</a></td>
            <td>
                <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection