@extends('layouts.admin.page')

@section('content')

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Почта</th>
      <th scope="col">Телефон</th>
      <th scope="col">Сообщения</th>
      <th scope="col">Отправлено</th>
    </tr>
  </thead>
  <tbody>

@foreach($lists as $list)
    <tr>
      <th scope="row">{{ $list->id }}</th>
      <td>{{ $list->name }}</td>
      <td>{{ $list->lastname }}</td>
      <td>{{ $list->email }}</td>
      <td>{{ $list->phone }}</td>
      <td>{{ $list->message}}</td>
      <td>{{ $list->created_at }}</td>
    </tr>
@endforeach
 
  </tbody>
</table>

@endsection