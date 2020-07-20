@extends('layouts.app')

@section('content')

<h1 align="center">Contact list</h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Message</th>
      <th scope="col">Created_at</th>
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