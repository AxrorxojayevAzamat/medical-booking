
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
        <a class="btn btn-success" href="{{ route("admin.specializations.create") }}">
          Add Specializations
        </a>
    </div>
</div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Наименование(ru)</td>
          <td>Наименование(uz)</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($specializations as $specialization)
        <tr>
            <td>{{$specialization->id}}</td>
            <td>{{$specialization->name_ru}}</td>
            <td>{{$specialization->name_uz}}</td>
            <td><a href="{{ route('admin.specializations.edit',$specialization->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('admin.specializations.show',$specialization->id)}}" class="btn btn-success">Show</a></td>
            <td>
                <form action="{{ route('admin.specializations.destroy', $specialization->id)}}" method="post">
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